@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Fuels Infos  </h3>
                <!-- <a href="{{ route('maintenance.index') }}">
                    <button type="button" class="btn btn-warning btn-sm" style="float:right">Dispose asset </button>
                </a> -->
            
              </div>
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
                    <th>Asset name</th>
                    <th>Model</th>
                    <th>Previous Odometer</th>
                    <th>Current Odometer </th>
                    <th>Activity</th>
                    <th>Cost</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($fuels as $fuel)
                  <tr>
                    @foreach($vehicles as $vehicle)
                        @if ($vehicle->id == $fuel->vehicle_id)
                            <td>
                                <a href="{{ route('fuel.show', $fuel->id)}}" >
                                    <u> {{$vehicle->reg_number}} </u>
                                </a>
                            </td>   
                            <td>{{$vehicle->model}}</td> 
                        @endif
                    @endforeach
                    @foreach($generators as $generator)
                        @if ($generator->id == $fuel->generator_id)
                            <td>
                                <a href="{{ route('fuel.show', $fuel->id)}}" >
                                    <u> {{$generator->model}} </u>
                                </a>
                            </td>   
                            <td>{{$generator->capacity}}cc</td>
                        @endif
                    @endforeach
                    
                    <td>{{$fuel->previous_odometer}}</td>
                    <td>{{$fuel->current_odometer}}</td>
                    <td>{{$fuel->activity}}</td>
                    <td>{{$fuel->cost}}</td>
                    <td>
                        <a href="{{ route('fuel.edit', $fuel->id) }}">
                            <button type="button" class="btn btn-success btn-sm" >Edit</button>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$fuel->id}}">Delete</button>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-sm{{$fuel->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$fuel->date}} fuel Information</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete fuels details of <b> {{$fuel->date}} </b> for activity at <b> {{$fuel->activity}} </b> permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('fuel.destroy', $fuel->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

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
                    // password: {
                    //     required: true,
                    //     minlength: 5
                    // },
                    // terms: {
                    //     required: true
                    // },
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
                // password: {
                //     required: "Please provide a password",
                //     minlength: "Your password must be at least 5 characters long"
                // },
                // terms: "Please accept our terms"
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
