@extends('master.master')
@section('title')
    {{ __('add') }}
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="pc-container">
        <div class="pc-content">



            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div id="basicwizard" class="form-wizard row justify-content-center">
                        <div class="col-12">

                            <div class="card">
                                <form id="createForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="tab-content">


                                            <div class="tab-pane show active" id="contactDetail">
                                                <div id="contactForm">
                                                    <div class="text-center">
                                                        <h3 class="mb-2">
                                                            Create
                                                            Ticket
                                                        </h3>

                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col">
                                                            <div class="row">

                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <?php
                                                                        $s = $sl + 1;
                                                                        $p = date('Ymd') . $s;
                                                                        $no = $p;
                                                                        ?>


                                                                        <div class="col-lg-12  mt-2">
                                                                            <input type="hidden" name="ticket_no"
                                                                                class="form-control ticket_no"
                                                                                value="#{{ $no }}" readonly>
                                                                            <input type="text"
                                                                                class="form-control subject" name="subject"
                                                                                id="name"
                                                                                placeholder="Enter your subject">
                                                                            <input type="hidden" name="id"
                                                                                class="id">
                                                                            <span class="text-danger error-message"
                                                                                id="subjectError"></span>
                                                                        </div>
                                                                        <div class="col-lg-6 mt-2">
                                                                            <select
                                                                                class="form-select department @error('department') is-invalid @enderror"
                                                                                name="department">
                                                                                <option value="">
                                                                                    Select
                                                                                    Department
                                                                                </option>
                                                                                @foreach ($department as $item)
                                                                                    <option
                                                                                        value="{{ $item->department_name }}">
                                                                                        {{ $item->department_name }}
                                                                                    </option>
                                                                                @endforeach


                                                                            </select>
                                                                            <span class="text-danger error-message"
                                                                                id="departmentError"></span>
                                                                        </div>

                                                                        <div class="col-lg-6 mt-2">
                                                                            <select
                                                                                class="form-select priority @error('priority') is-invalid @enderror"
                                                                                name="priority">
                                                                                <option value="">
                                                                                    Select
                                                                                    Priority
                                                                                </option>
                                                                                <option value="High">High </option>
                                                                                <option value="Medium">Medium </option>
                                                                                <option value="Low">Low </option>
                                                                            </select>
                                                                            <span class="text-danger error-message"
                                                                                id="priorityError"></span>
                                                                        </div>
                                                                        <div class="col-lg-12 mt-2">

                                                                            <textarea class="form-control mt-2 message" name="message" placeholder="Enter your message" rows="4"></textarea>

                                                                            <span class="text-danger error-message"
                                                                                id="messageError"></span>

                                                                        </div>
                                                                        <div class="col-lg-6">

                                                                            <input type="file" accept="image/*"
                                                                                class="form-control mt-2"
                                                                                id="product_image_input"
                                                                                onchange="previewImage(event)"
                                                                                name="attachment">

                                                                            <!-- Image Preview -->
                                                                            <img src="" id="product_image_preview"
                                                                                class="mt-2"
                                                                                style="width: 120px; height: 120px; display: none;">

                                                                            <span class="text-danger error-message"
                                                                                id="attachmentError"></span>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer mt-2 p-10  gap-2">
                                                                    <a href="{{ route('ticket.ticket_list') }}"
                                                                        class="btn btn-danger">Back</a>

                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end tab content-->
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>





        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('product_image_preview');

            if (input.files && input.files[0]) {
                preview.src = URL.createObjectURL(input.files[0]);
                preview.style.display = 'block';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            // Clear error on input for text fields
            $('#createForm input, #createForm textarea').on('input', function() {
                const name = $(this).attr('name');
                $('#' + name + 'Error').text('');
            });

            // Clear error on select change
            $('#createForm select').on('change', function() {
                const name = $(this).attr('name');
                $('#' + name + 'Error').text('');
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#createForm').on('submit', function(e) {
                e.preventDefault(); // prevent form from submitting normally

                let formData = new FormData(this);

                // Clear previous error messages
                $('.error-message').text('');

                $.ajax({
                    url: "{{ route('ticket.customer_ticket_store') }}", // Change this to your store route
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {

                    },
                    success: function(response) {
                        // Success logic here
                        $('#createForm')[0].reset(); // clear the form
                        $('#product_image_input').val('');
                        $('#product_image_preview').attr('src', '').hide();
                        toastr.success('Ticket created successfully!');

                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + 'Error').text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#customer').on('change', function() {
                var id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('ticket.user_info') }}",
                    data: {
                        customer_id: id,
                    },
                    success: function(data) {
                        $('.name').val(data.name);
                        $('.phone').val(data.mobile);
                    }
                });
            });
        });
    </script>
@endsection
