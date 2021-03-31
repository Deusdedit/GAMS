@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All available assets </h3>
                
                <!-- <a href="{{route('printReportasset')}}" target="_blank"> -->
                    <!-- <button type="button" class="btn btn-success btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button> -->
                <!-- </a> -->
                @if ( Auth::user()->role_id == '5')
                <button type="button" class="btn btn-primary btn-sm" style="float:right; margin-right:5px;" data-toggle="modal" data-target="#modal-lg">Add new asset </button>
                @endif

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
                    <th>Purchased date</th>
                    <th>Condition</th>
                    <th>Serial number</th>
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($assets as $asset)
                  <tr>
                    <td>
                        <a href="{{ route('asset.show', $asset->id)}}" >
                            <u> {{$asset->name}} </u>
                        </a>
                    </td>
                    <td>{{$asset->purchased_date}}</td>
                    <td>{{$asset->condition}}</td>
                    <td>{{$asset->serial_number}}</td>
                    <td>
                    
                        <div class="row">

                        
                        @if ( Auth::user()->role_id == '5')
                            <div class="col-md-3">
                                <!-- <a href="{{ route('asset.edit', $asset->id) }}"> -->
                                <!-- <a href="{{ route('editReason', $asset->id) }}"> -->
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-smm{{$asset->id}}">Edit</button>
                                <!-- </a> -->
                            </div>
                            <div class="col-md-3">
                                <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$asset->id}}">Delete</button> -->
                                
                            </div>
                            
                            @elseif ( Auth::user()->role_id == '3')
                            
                            <div class="col-md-3">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-lgg{{$asset->id}}">Dispose </button>
                                @if ( $asset->reason != NULL )
                                    <i class="fas fa-info-circle " style="color:green;" data-placement="top" title="{{$asset->reason}}"></i>
                                @endif
                                
                            </div>
                            
                            @endif
                            
                        </div>
                        
                        
                    </td>
                    
                  </tr>
                    

                    <!-- reason to edit modal -->
                    <div class="modal fade" id="modal-smm{{$asset->id}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('editReason', $asset->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-header bg-success">
                                        <h4 class="modal-title">Editing {{$asset->name}} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="ledgerNumberId">Reason to edit <i> {{$asset->name}} </i></label>
                                            <textarea class="form-control" rows="3" id="ledgerNumberId" placeholder="Enter Reason why are you editing..." name="reason"></textarea>
                                        </div> 
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-success">Continue Editing</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- delete modal -->
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
                    <!-- disposal model -->
                    <div class="modal fade" id="modal-lgg{{$asset->id}}">
                        <form role="form" method="post" action="{{ route('disposal.store') }}" id="disposingForm">
                            @csrf
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                
                                    <div class="modal-header bg-warning">
                                        <h4 class="modal-title">Dispose {{$asset->name}} with serial number {{$asset->serial_number}} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="assetNameId">Asset name */</label>
                                                    <input type="text" class="form-control" id="assetNameId" value="{{$asset->id}}" name="asset_id" hidden >
                                                    <input type="text" class="form-control" id="assetNameId" value="{{$asset->name}}" disabled >
                                                </div>

                                               

                                                <div class="form-group">
                                                    <label for="dateId">Reason */</label>
                                                    <input type="text" class="form-control" id="statusId" placeholder="Enter Reason" name="reason">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="dateId">Disposal Date */</label>
                                                    <input type="date" class="form-control" id="disposalId" placeholder="Enter Disposal Date" name="date">
                                                </div>

                                                <div class="form-group">
                                                    <label for="dateId">Price */</label>
                                                    <input type="number" min="0" class="form-control" id="assetId" placeholder="Enter Asset price" name="price">
                                                </div>
                                            </div>   
                                        </div>    
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Dispose</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- create new asset modal -->
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
                                            <label for="AssetSerialId">Ledger Folio Number *</label>
                                            <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter asset serial number" name="ledger_folio">
                                        </div>
                                    <div class="form-group">
                                            <label>Asset condition *</label>
                                            <select class="form-control select2" style="width: 100%;" name="condition">
                                                <option selected="selected" disabled>Select a condition...</option>
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                                <option value="Refurbished">Refurbished</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Asset was received as</label>
                                            <select class="form-control select2" style="width: 100%;" name="receiving_id">
                                            <option selected="selected" disabled>Select a received item...</option>
                                                @foreach($receivings as $received)
                                                    <option value="{{$received->id}}">{{$received->item}} of {{$received->ledger_number}} on {{$received->date}}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                        <div class="form-group">
                                            <label for="assetNameId">Asset name *</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Asset name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="AssetSerialId">Asset serial number</label>
                                            <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter asset serial number" name="serial_number">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Category *</label>
                                            <select class="form-control select2" style="width: 100%;" name="category">
                                                <option selected="selected" disabled>Select asset category...</option>
                                                <option value="Furniture and fitting">Funiture and Fitings</option>
                                                <option value=" office Equipments">Office Equipments</option>
                                                <option value=" Vehicle">Vehicle</option>
                                                <option value="Motor Bycle ">Motor Bike</option>
                                                <option value="Goods">Goods</option>
                                            </select>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="productionId">Asset code number</label>
                                            <input type="text" class="form-control" id="serialId" placeholder="Enter code number" name="product_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="locationId">Location *</label>
                                            <input type="text" class="form-control" id="locationId" placeholder="Enter Asset Location" name="location">
                                        </div>

                                        <div class="form-group">
                                            <label for="activityId">Activity *</label>
                                            <input type="text" class="form-control" id="activityId" placeholder="Enter Activity" name="activity" >
                                        </div>
                                        <div class="form-group">
                                            <label for="AssetSerialId">Unit cost *</label>
                                            <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter asset serial number" name="cost">
                                        </div>
                                        
                                    </div>   
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="dateId">Date bought *</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Date bought" name="purchased_date">
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
           
            $(document).ready(function(){
            $('[class="fas fa-info-circle "]').tooltip();   
            });

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
                category: {
                    required: true,
                },
                
                purchased_date: {
                    required: true,
                },
                condition: {
                    required: true,
                },
                
                location: {
                    required: true,
                },
                ledger_folio: {
                    required: true,
                },
                activity: {
                    required: true,
                },
                receiving_id: {
                    required: 
                        function(){
                            return $('select[name="condition"]').val() == 'New';  
                        }
                },
            },
            messages: {
                name: {
                    required: "Please enter asset name",
                    
                },
                category: {
                        required: "Please please choose asset category ",
                },
                purchased_date: {
                    required: "Please enter purchased date",
                },
                condition: {
                    required: "Please enter asset condition",
                },
                
                location: {
                    required: "Please select a location",
                },
                activity: {
                    required: "Please select a activity",
                },
                ledger_folio: {
                    required: "Please select a ledger folio number",
                },
                receiving_id: {
                    required: "Please choose received as",
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
