@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All GST Drivers </h3>
                <button type="button" class="btn btn-primary btn-sm" style="float:right" data-toggle="modal" data-target="#modal-lg">Add new Driver</button>
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
                
                    <th>Driver Full name</th>
                    <th>Driver License number</th>
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($drivers as $drive)
                  <tr>
                    <td>{{$drive->fullname}}</td>
                    <td>{{$drive->license}}</td>
                
                    
                    <td>
                        
                        <a href="{{ route('driver.edit', $drive->id) }}">
                             <button type="button" class="btn btn-success btn-sm" >Edit</button>
                        </a>
                            
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$drive->id}}">Delete</button>
                                
                            
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-sm{{$drive->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting Driver {{$drive->fullname}} </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete Driver <b> {{$drive->fullname}} </b> with License number <b> {{$drive->license}} </b> permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('driver.destroy', $drive->id)}}" method="post">
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

            <div class="modal fade" id="modal-lg">
                <form role="form" method="post" action="{{ route('driver.store') }}" id="driverForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header" style="background-color:#f7d26c;">
                                <h4 class="modal-title">Add new Driver</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ledgerNumberId">Driver Full Name</label>
                                            <input type="text" class="form-control" id="driverId" placeholder="Enter Driver Full Name" name="fullname">
                                        </div>
                                        
                                    </div>

                                    <div class="col-6">

                                            <div class="form-group">
                                                <label for="supplierId">Driving License Number</label>
                                                <input type="text" class="form-control" id="supplierId" placeholder="Enter Driving license" name="license">
                                            </div>

                                        
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add New Driver</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
                <!-- /.modal-dialog -->
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
            setTimeout(function(){$("#success_element").hide();}, 5000);
        });     

        $(document).ready(function () {
            $.validator.setDefaults({
                // submitHandler: function () {
                // alert( "Form successful submitted!" );
                // }
            });
            $('#driverForm').validate({
            rules: {
                    fullname: {
                        required: true,
                    },
                    license: {
                        required: true,
                    },
                   
                    
            },
            messages: {
                fullname: {
                    required: "Please enter  driver full name",
                    
                },
                license: {
                    required: "Please enter a driving license",
                    
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
