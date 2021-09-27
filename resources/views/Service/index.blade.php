@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Services  </h3>
            
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
                    <th>Date</th>
                    <th>Current Odometer </th>
                    <th>Cost </th>
                    <!-- <th>Total VAT</th> -->
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($services as $service)
                  <tr>
                    @foreach($vehicles as $vehicle)
                        @if ($vehicle->id == $service->vehicle_id)
                            <td>
                                <a href="{{ route('service.show', $service->id)}}" >
                                    <u> {{$vehicle->reg_number}} </u>
                                </a>
                            </td>   
                            <td>{{$vehicle->model}}</td> 
                        @endif
                    @endforeach
                    @foreach($generators as $generator)
                        @if ($generator->id == $service->generator_id)
                            <td>
                                <a href="{{ route('service.show', $service->id)}}" >
                                    <u> {{$generator->model}} </u>
                                </a>
                            </td>   
                            <td>{{$generator->capacity}}cc</td>
                        @endif
                    @endforeach
                    
                    <td>{{$service->date}}</td>
                    <td>{{$service->current_odometer}}</td>
                    <td>{{$service->cost}}</td>
                    <!-- <td>{{$service->total_vat}}</td> -->
                    <td>
                        <a href="{{ route('service.edit', $service->id) }}">
                            <button type="button" class="btn btn-success btn-sm" >Edit</button>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$service->id}}">Delete</button>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-sm{{$service->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$service->date}} service</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete maintenance details of <b> {{$service->date}} </b> done at permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('service.destroy', $service->id)}}" method="post">
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
                date: {
                        required: true,
                    },
                    current_odometer: {
                        required: true,
                    },
                    cost: {
                        required: true,
                    },
                    total_cost: {
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
                date: {
                    required: "Please enter asset name",
                    
                },
                current_odometer: {
                        required: "Please enter date bought",
                },
                cost: {
                    required: "Please enter condition",
                },
                total_cost: {
                    required: "Please enter serial number",
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
