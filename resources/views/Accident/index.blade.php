@extends('layouts.master')

@section('content')

<div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success" id="success_element">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" >
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Vehicle number</th>
                    <th>Accident Location</th>
                    <th>Description</th>
                    <th>date</th>
                    <th>Number of Passengers</th>
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($accidents as $accident)
                  <tr>
                    <td>
                    @foreach($vehicles as $vehicle)
                    @if($vehicle->id == $accident->vehicle_id)
                        <a href="{{ route('accident.show', $accident->id)}}" >
                            <u> {{$vehicle->reg_number}} </u>
                        </a>
                        @endif
                    @endforeach
                    </td>
                    <td>{{$accident->location}}</td>
                    <td>{{$accident->description}}</td>
                    <td>{{$accident->date}}</td>
                    <td>{{$accident->passenger}}</td>
                    <td>

                          <a href="{{ route('accident.edit', $accident->id) }}">
                                <button type="button" class="btn btn-success btn-sm" >Edit</button>
                            </a>
                            
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$accident->id}}">Delete</button>
                                
                           
                  </tr>
                    <!-- delete modal -->
                    <div class="modal fade" id="modal-sm{{$accident->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$accident->name}} </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete <b> {{$accident->name}} </b> with descrption <b> {{$accident->description}} </b> permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('accident.destroy', $accident->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- disposal model -->
                    

                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- create new asset modal -->
            

@endsection

@section('pagescripts')

<!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

        $(function () {
            $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            });
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });

            //Initialize Select2 Elements
            $('.select2').select2()
            setTimeout(function(){$("#success_element").hide();}, 5000);
        });     

        $(document).ready(function () {
            $.validator.setDefaults({
                // submitHandler: function () {
                // alert( "Form successful submitted!" );
                // }
            });
            $('#receivingForm').validate({
            rules: {
                name: {
                        required: true,
                    },
                    purchased_date: {
                        required: true,
                    },
                    condition: {
                        required: true,
                    },
                    serial_number: {
                        required: true,
                    },
                    product_number: {
                        required: true,
                    },
                    location: {
                        required: true,
                    },
                    activity: {
                        required: true,
                    },
            },
            messages: {
                name: {
                    required: "Please enter asset name",
                    
                },
                purchased_date: {
                        required: "Please enter date bought",
                },
                condition: {
                    required: "Please enter condition",
                },
                serial_number: {
                    required: "Please enter serial number",
                },
                product_number: {
                    required: "Please enter production number",
                },
                location: {
                    required: "Please select a condition",
                },
                activity: {
                    required: "Please select a activity",
                },
            },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }   
            });         
        });

        $(document).ready(function () {
            $.validator.setDefaults({
                // submitHandler: function () {
                // alert( "Form successful submitted!" );
                // }
            });
            $('#disposingForm').validate({
                rules: {
                    reason: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                },
                messages: {
                    reason: {
                        required: "Please specify a reason",
                    },
                    date: {
                        required: "Please enter a date",
                    },
                    price: {
                        required: "Please enter a price",
                    },
                },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    }
            });
        });
    </script>
    
@endsection
