@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All disposed assets </h3>
                <!-- <a href="{{route('printReportDisposal')}}" target="_blank">
                <button type="button" class="btn btn-success btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button>
              </a> -->
                <a href="{{ route('asset.index') }}">
                    <button type="button" class="btn btn-warning btn-sm" style="float:right;margin-right:5px;">Dispose asset </button>
                </a>
            
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
                    <th>Serial number</th>
                    <th>Reason </th>
                    <th>Price </th>
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($assets as $asset)
                  @foreach($disposals as $disposal)
                  @if($asset->id == $disposal->asset_id)
                  <tr>
                    <td>
                        <a href="{{ route('disposal.show', $disposal->id)}}" >
                            <u> {{$asset->name}} </u>
                        </a>
                    </td>
                    <td>{{$asset->serial_number}}</td>
                    <td>{{$disposal->reason}}</td>
                    <td>{{$disposal->price}}</td>
                    <td>
                        <a href="{{ route('disposal.edit', $disposal->id) }}">
                            <button type="button" class="btn btn-success btn-sm" >Edit</button>
                        </a>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-sm{{$asset->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$asset->name}} </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete <b> {{$asset->name}} </b> with serial number <b> {{$asset->serial_number}} </b> permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('asset.destroy', $asset->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                  
                  @endif
                  @endforeach
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <div class="modal fade" id="modal-lg">
                <form role="form" method="post" action="{{ route('asset.store') }}" id="receivingForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Add available asset</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="assetNameId">Asset name</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Asset name" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Date bought</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Date bought" name="purchased_date">
                                        </div>

                                        <div class="form-group">
                                            <label>Condition</label>
                                            <select class="form-control select2" style="width: 100%;" name="condition">
                                                <option selected="selected" disabled>Select a condition...</option>
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                                <option value="Refurbished">Refurbished</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Received items</label>
                                            <select class="form-control select2" style="width: 100%;" name="receiving_id">
                                                @foreach($receivings as $received)
                                                    <option selected="selected" disabled>Select a received item...</option>
                                                    <option value="{{$received->id}}">{{$received->item}} of {{$received->ledger_number}}</option>
                                                    <!-- <option value="Used">Used</option>
                                                    <option value="Refurbished">Refurbished</option> -->
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="AssetSerialId">Asset serial number</label>
                                            <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter asset serial number" name="serial_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="productionId">Asset product number</label>
                                            <input type="text" class="form-control" id="serialId" placeholder="Enter Product number" name="product_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="locationId">Location</label>
                                            <input type="text" class="form-control" id="locationId" placeholder="Enter Asset Location" name="location">
                                        </div>

                                        <div class="form-group">
                                            <label for="activityId">Activity</label>
                                            <input type="text" class="form-control" id="activityId" placeholder="Enter Activity" name="activity">
                                        </div>

                                        
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add item</button>
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
