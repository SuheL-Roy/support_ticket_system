@extends('master.master')
@section('title')
    {{ __('Ticket List') }}
@endsection
@section('content')
    <div class="pc-container">

        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Ticket List</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card table-card">
                        <div class="card-body">
                            <div class="text-end p-sm-4 pb-sm-2">
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('ticket.create_ticket') }}" class="btn btn-primary">
                                        Add Ticket
                                    </a>
                                @else
                                    <a href="{{ route('ticket.create_customer_ticket') }}" class="btn btn-primary">
                                        Add Ticket
                                    </a>
                                @endif

                            </div>
                            <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLiveLabel">Ticket Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>


                                        <form id="registerForm" action="" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" required
                                                            class="form-control mt-2 ticket-no font-bold" name="name"
                                                            id="name" placeholder="Enter your name">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" required
                                                            class="form-control mt-2 customer-name font-bold" name="name"
                                                            id="name" placeholder="Enter your name" readonly>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" required
                                                            class="form-control mt-2 phone font-bold" name="name"
                                                            id="name" placeholder="Enter your name" readonly>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <input type="text" required
                                                            class="form-control mt-2 department font-bold" name="name"
                                                            id="name" placeholder="Enter your name" readonly>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" required
                                                            class="form-control mt-2 priority font-bold" name="name"
                                                            id="name" placeholder="Enter your name" readonly>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" required
                                                            class="form-control mt-2 subject font-bold" name="name"
                                                            id="name" placeholder="Enter your name" readonly>

                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control mt-2 message font-bold" name="message" placeholder="Enter your message" rows="4"
                                                            readonly></textarea>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input type="text" required
                                                            class="form-control mt-2 status font-bold" name="name"
                                                            id="name" placeholder="Enter your name" readonly>

                                                    </div>


                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover tbl-product" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ticket No</th>
                                            <th>Customer Name</th>
                                            <th>Contact No</th>
                                            <th>Department</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            @if (Auth::user()->role === 'customer')
                                                <th>Status</th>
                                            @endif
                                            <th>Attach File</th>
                                            @if (Auth::user()->role === 'customer')
                                                <th>Action</th>
                                            @endif
                                           
                                            @if (Auth::user()->role === 'admin')
                                                <th>Choose Status to Update</th>
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ticket as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a
                                                   target="_blank" href="{{ route('ticket.ticket_history', ['id' => $item->ticket_no]) }}">{{ $item->ticket_no }}</a></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->department }}</td>
                                                <td>{{ $item->subject }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($item->message, 20) }}</td>
                                                @if (Auth::user()->role === 'customer')
                                                    <td style="font-size: 18px;">{{ $item->status }}</td>
                                                @endif

                                                <td>
                                                    @if ($item->attachment)
                                                        <a href="{{ asset('public/' . $item->attachment) }}" download>
                                                            <img src="{{ asset('public/' . $item->attachment) }}"
                                                                alt="Post Image" width="80" height="80">
                                                        </a>
                                                    @else
                                                        <span>No Attachment</span>
                                                    @endif
                                                </td>
                                                @if (Auth::user()->role === 'customer')
                                                    <td>
                                                        <button type="button" class="btn btn-primary ediT"
                                                            value="{{ $item->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalLive">Details</button>

                                                    </td>
                                                @endif
                                                @if (Auth::user()->role === 'admin')
                                                    <td><select title="{{ $item->id }}" class="form-control STU">
                                                            <option value="">{{ $item->status }}</option>
                                                            <option value="Working">Working</option>
                                                            <option value="Solved">Solved</option>
                                                            <option value="L-3 Support">L-3 Support</option>
                                                            <option value="L-4 Support">L-4 Support</option>
                                                            <option value="L-5 Support">L-5 Support</option>
                                                            <option value="Canceled">Canceled</option>
                                                        </select></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary ediT"
                                                            value="{{ $item->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalLive">Details</button>

                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.ediT').on('click', function() {
                var id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('ticket.ticket_details') }}",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('.ticket-no').val(data.ticket_no);
                        $('.customer-name').val(data.name);
                        $('.phone').val(data.mobile);
                        $('.message').val(data.message);
                        $('.subject').val(data.subject);
                        $('.priority').val(data.priority);
                        $('.department').val(data.department);
                        $('.status').val(data.status);
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.STU').on('change', function() {
                var id = $(this).attr("title");
                var value = $(this).val();

                // Confirmation dialog
                var confirmChange = confirm('Are you sure you want to change the status to "' + value +
                    '"?');

                if (confirmChange) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('ticket.status_update') }}",
                        data: {
                            id: id,
                            status: value
                        },
                        success: function(data) {
                            location.reload();
                            toastr.success('Ticket Status Updated successfully!');
                        }
                    });
                } else {
                    // Optional: revert selection if canceled
                    $(this).val($(this).data("original"));
                }
            });
        });
    </script>
@endsection
