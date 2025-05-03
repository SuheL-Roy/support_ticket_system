<?php

namespace App\Http\Controllers;

use App\Models\DepartMent;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function department_list()
    {
        $departments = DepartMent::latest()->get();
        return view('Department.department_list', compact('departments'));
    }

    public function department_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = new DepartMent();
        $data->department_name = $request->name;
        $data->save();

        return back()->with('success', 'Department created Successfully');
    }

    public function destroy(Request $request)
    {

        DepartMent::where('id', $request->id)->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
