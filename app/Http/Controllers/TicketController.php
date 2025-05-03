<?php

namespace App\Http\Controllers;

use App\Models\DepartMent;
use App\Models\Ticket;
use App\Models\TicketHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function create_ticket()
    {
        $customer = User::where('role', 'customer')->latest()->get();
        $department = DepartMent::latest()->get();
        if ($last = Ticket::all()->last()) {
            $sl = $last->id;
        } else {
            $sl = 0;
        }
        return view('Ticket.create_ticket', compact('customer', 'department', 'sl'));
    }

    public function create_customer_ticket(Request $request)
    {
        $customer = User::where('role', 'customer')->latest()->get();
        $department = DepartMent::latest()->get();
        if ($last = Ticket::all()->last()) {
            $sl = $last->id;
        } else {
            $sl = 0;
        }
        return view('Ticket.customer_create_ticket', compact('customer', 'department', 'sl'));
    }

    public function status_update(Request $request)
    {
        $data = Ticket::where('id', $request->id)->first();
        $data->status   = $request->status;
        $data->save();


        $history = new TicketHistory();
        $history->ticket_no = $data->ticket_no;
        $history->user_id = Auth::user()->id;
        $history->status = $request->status;
        $history->save();
        return response()->json(['success' => true]);
    }

    public function ticket_list()
    {
        if (auth()->user()->role == 'admin') {

            $ticket = Ticket::join('users', 'tickets.customer_id', '=', 'users.id')->select('tickets.*', 'users.name','users.mobile')->orderBy('id', 'Desc')->get();
            $customer = User::where('role', 'customer')->latest()->get();
            return view('Ticket.ticket_list', compact('customer', 'ticket'));
        } else {
            $ticket = Ticket::join('users', 'tickets.customer_id', '=', 'users.id')
                ->where('tickets.customer_id', auth()->user()->id)
                ->select('tickets.*', 'users.name','users.mobile')->orderBy('id', 'Desc')->get();
            $customer = User::where('role', 'customer')->latest()->get();
            return view('Ticket.ticket_list', compact('customer', 'ticket'));
        }
    }
    public function user_info(Request $request)
    {
        $customer = User::where('id', $request->customer_id)->first();
        return response()->json($customer);
    }

    public function ticket_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'department' => 'required|string',
            'subject' => 'required|string',
            'priority' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'customer_id.required' => 'Please select a customer.',
            'department.required' => 'Please select a department.',
            'priority.required' => 'Please select a priority.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file upload
        $imagePath = null;

        if ($request->hasFile('attachment')) {
            $imagePath = Storage::put('ticket', $request->file('attachment'));
        }


        // Save the ticket
        Ticket::create([
            'ticket_no' => $request->ticket_no,
            'customer_id' => $request->customer_id,
            'subject' => $request->subject,
            'status' => 'Ticket assigned',
            'department' => $request->department,
            'priority' => $request->priority,
            'message' => $request->message,
            'attachment' => $imagePath,
        ]);


        $history = new TicketHistory();
        $history->ticket_no =  $request->ticket_no;
        $history->user_id = Auth::user()->id;
        $history->status =  'Ticket Assigned';
        $history->save();


        return response()->json(['success' => true]);
    }

    public function customer_ticket_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'required|string',
            'subject' => 'required|string',
            'priority' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'department.required' => 'Please select a department.',
            'priority.required' => 'Please select a priority.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file upload
        $imagePath = null;

        if ($request->hasFile('attachment')) {
            $imagePath = Storage::put('ticket', $request->file('attachment'));
        }



        // Save the ticket
        Ticket::create([
            'ticket_no' => $request->ticket_no,
            'customer_id' => auth()->user()->id,
            'subject' => $request->subject,
            'status' => 'Ticket assigned',
            'department' => $request->department,
            'priority' => $request->priority,
            'message' => $request->message,
            'attachment' => $imagePath,
        ]);

        $history = new TicketHistory();
        $history->ticket_no =  $request->ticket_no;
        $history->user_id = Auth::user()->id;
        $history->status =  'Ticket Assigned';
        $history->save();

        return response()->json(['success' => true]);
    }

    public function ticket_details(Request $request)
    {
        $ticket = Ticket::join('users', 'tickets.customer_id', '=', 'users.id')
            ->where('tickets.id', $request->id)
            ->select('tickets.*', 'users.name','users.mobile')->first();
        return response()->json($ticket);
    }

    public function ticket_history(Request $request)
    {
        $data = TicketHistory::where('ticket_no', $request->id)->first();


        $order_status =  TicketHistory::join('users', 'ticket_histories.user_id', '=', 'users.id')
            ->where('ticket_no', $request->id)
            ->latest('ticket_histories.id')
            ->select('ticket_histories.*', 'users.name as creator_name')
            ->get();

        $new_array = array();
        foreach ($order_status as $key => $value) {

            if (!isset($new_array[$value['status']])) {
                $new_array[$value['status']] = $value;
            }
        }

        $order_statuses  = $new_array = array_values($new_array);

        return view('Ticket.ticket_history', compact('order_statuses', 'data'));
       
    }
}
