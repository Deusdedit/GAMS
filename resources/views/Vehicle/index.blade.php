@extends('layouts.master')

@section('content')
<!-- 0f749d -->
<div class="card">
              <div class="card-header">
                <h3 class="card-title">All available vehicles </h3>
                <button type="button" class="btn btn-primary btn-sm" style="float:right" data-toggle="modal" data-target="#modal-lg">Add new Vehicle </button>
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
                    <th>Registration number</th>
                    <th>Model</th>
                    <th>Capacity</th>
                    <th>Manufacturing date</th>
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($vehicles as $vehicle)
                  <tr>
                    <td>
                        <a href="{{ route('vehicle.show', $vehicle->id)}}" >
                            <u> {{$vehicle->reg_number}} </u>
                        </a>
                    </td>
                    <td>{{$vehicle->model}}</td>
                    <td>{{$vehicle->capacity}}</td>
                    <td>{{$vehicle->manufacturing_date}}</td>
                    <td style="float:right">
                        <a href="{{ route('vehicle.edit', $vehicle->id) }}">
                            <button type="button" class="btn btn-success btn-sm" >Edit</button>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$vehicle->id}}"> 
                            Delete
                        </button>

                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-fuel{{$vehicle->id}}"  data-placement="top" title="Add fuel" ><i class="fas fa-gas-pump"></i></button>

                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-main{{$vehicle->id}}" data-placement="top" title="Maintanance"><i class="fas fa-tools"></i></button>

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-mainservice{{$vehicle->id}}" data-placement="top" title="Service"><i class="fas fa-cogs"></i></button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-accident{{$vehicle->id}}" data-placement="top" title="Add Accident"><i class="fas fa-ambulance" ></i></button>

                    </td>
                  </tr>
                    <!-- delete modal -->
                    <div class="modal fade" id="modal-sm{{$vehicle->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$vehicle->reg_number}} </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete <b> {{$vehicle->reg_number}} </b> permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">

                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('vehicle.destroy', $vehicle->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- add maintenance modal -->
                    <div class="modal fade" id="modal-main{{$vehicle->id}}">
                        <form role="form" method="post" action="{{ route('maintenance.store') }}" id="maintenanceForm" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header" style="background-color:#a86801;color:white;">
                                        <h4 class="modal-title">Take vehicle to maintenance</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="assetNameId">Vehicle details </label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter Registration number" name="vehicle_id" value="{{$vehicle->id}}" hidden >

                                                    <input type="text" class="form-control" id="assetNameId" value="{{$vehicle->model}}  {{$vehicle->reg_number}}" disabled >

                                                </div>

                                                <div class="form-group">
                                                    <label for="productionId">Previous Odometer reading</label>
                                                    <input type="number" class="form-control" id="serialId" placeholder="Previous Odometer reading" name="previous_odometer">
                                                </div>

                                                <div class="form-group">
                                                    <label for="dateId">Current Odometer reading</label>
                                                    <input type="number" class="form-control" id="dateId" placeholder="Enter Current Odometer reading" name="current_odometer">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dateId">Maintenance date </label>
                                                    <input type="date" class="form-control" id="dateId" placeholder="Enter maintenance date Date" name="date">
                                                </div>

                                                <div class="form-group">
                                                    <label for="dateId">Material Used </label>
                                                    <input type="text" class="form-control" id="dateId" placeholder="Enter material used" name="material">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dateId">Maintenance Receipt</label>
                                                     <input type="file" class="form-control" id="fuelId" placeholder="Enter Maintenance Attachments " name="attachments">
                                                   </div>

                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="AssetSerialId">Garage</label>
                                                    <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter Garage name" name="garage">
                                                </div>

                                                <div class="form-group">
                                                    <label for="AssetSerialengineId">Supervisor name</label>
                                                    <input type="text" class="form-control" id="AssetSerialengineId" placeholder="Enter Supervisor name" name="supervisor">
                                                </div>

                                                <div class="form-group">
                                                    <label for="serialChassisId">Maintenance Description</label>
                                                    <input type="text" class="form-control" id="serialChassisId" placeholder="Enter descriptions" name="description">
                                                </div>

                                                <div class="form-group">
                                                    <label for="locationId">Cost</label>
                                                    <input type="number" class="form-control" id="txtcost" placeholder="Enter maitenance cost" name="cost" onkeyup="sum()" >
                                                </div>
                                                <div class="form-group">  
                                                <label for="locationId">Total Cost + VAT</label>            
                                                   
                                                  <input type="number" class="form-control" id="txtresult" placeholder="Enter total cost" name="total_vat" readonly >
                                            
                                                     </div>


                                                               

                                                            
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between" style="background-color:#a86801;">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Add item</button>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </form>
                        <!-- /.modal-dialog -->
                    </div>

                    <!-- add Service modal -->
                    <div class="modal fade" id="modal-mainservice{{$vehicle->id}}">
                        <form role="form" method="post" action="{{ route('service.store') }}" id="serviceForm" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header" style="background-color:#356aa0;color:white;">
                                        <h4 class="modal-title">Take vehicle to service</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="assetNameId">Vehicle details </label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter Registration number" name="vehicle_id" value="{{$vehicle->id}}" hidden >

                                                    <input type="text" class="form-control" id="assetNameId" value="{{$vehicle->model}}  {{$vehicle->reg_number}}" disabled >

                                                </div>

                                                <div class="form-group">
                                                    <label for="dateId">Current Odometer reading</label>
                                                    <input type="number" class="form-control" id="dateId" placeholder="Enter Current Odometer reading" name="current_odometer">
                                                </div>

                                                <div class="form-group">
                                                    <label for="productionId">Next Odometer reading</label>
                                                    <input type="number" class="form-control" id="serialId" placeholder="Next Odometer reading" name="next_odometer">
                                                </div>

                                                <div class="form-group">
                                                    <label for="dateId">Service date </label>
                                                    <input type="date" class="form-control" id="dateId" placeholder="Enter Service Date" name="date">
                                                </div>
                                                <div class="row">
                                            <label for="locationId">Material</label>
                                            <input type="text" class="form-control" id="odometerId" placeholder="Enter service material" name="material">
                                        </div>

                                        <div class="form-group">
                                                    <label for="dateId">Service's Receipt</label>
                                                     <input type="file" class="form-control" id="fuelId" placeholder="Enter services Attachments " name="attachments">
                                          </div>


                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="AssetSerialId">Garage</label>
                                                    <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter Garage name" name="garage">
                                                </div>

                                                <div class="form-group">
                                                    <label for="AssetSerialengineId">Supervisor name</label>
                                                    <input type="text" class="form-control" id="AssetSerialengineId" placeholder="Enter Supervisor name" name="supervisor">
                                                </div>

                                                <div class="form-group">
                                                    <label for="serialChassisId">Service Description</label>
                                                    <input type="text" class="form-control" id="serialChassisId" placeholder="Enter descriptions" name="description">
                                                </div>

                                                <div class="form-group">
                                                    <label for="locationId">Cost</label>
                                                    <input type="number" class="form-control" id="txtcosts" placeholder="Enter maitenance cost" name="cost" onkeyup="sumservice()">
                                                </div>
                                                <div class="form-group">
                                                    <label for="locationId">Total VAT</label>
                                                    <input type="number" class="form-control" id="txtresults" placeholder="Enter total VAT" name="total_vat" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer justify-content-between" style="background-color:#356aa0;">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Add item</button>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </form>
                        <!-- /.modal-dialog -->
                    </div>

                     <!-- create new accident-vehicle modal -->
                <div class="modal fade" id="modal-accident{{$vehicle->id}}">
                    <form role="form" method="post" action="{{ route('accident.store') }}" id="accidentForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header" style="background-color:#f7d26c;">
                                <h4 class="modal-title">Add accident information to vehicle {{$vehicle->reg_number}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                                    <label for="assetNameId">Vehicle details </label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter Registration number" name="vehicle_id" value="{{$vehicle->id}}" hidden >
                                                                                                
                                                    <input type="text" class="form-control" id="assetNameId" value="{{$vehicle->model}}  of {{$vehicle->reg_number}}" disabled >

                                                </div>


                                                <div class="form-group">
                                            <label>Select Driver involved</label>
                                            <select class="form-control select2" style="width: 100%;" name="driver_id" value="{{$vehicle->driver_id}}">
                                            <option value="{{$vehicle->driver_id}}" selected disabled>
                                           
                                            </option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{$driver->id}}">{{$driver->fullname}} of {{$driver->license}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    


                                        <div class="form-group">
                                            <label for="assetNameId">Accident Location</label>
                                            <input type="text" class="form-control" id="locationId" placeholder="Enter Accident Location" name="location">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Accident Description</label>
                                            <input type="text" class="form-control" id="descriptionId" placeholder="Enter Accident Description" name="description">
                                        </div>
                                       
                                    </div>

                                    <div class="col-6">

                                    <div class="form-group">
                                            <label for="dateId">Accident Date</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Accident Date " name="date">
                                        </div>

                                    <div class="form-group">
                                            <label for="productionId">Number of Passenger involved</label>
                                            <input type="number" class="form-control" id="passengerId" placeholder="Enter number of passsenger involved" name="passenger">
                                        </div>

                                        <div class="form-group">
                                            <label for="productionId">Accident Type</label>
                                            <input type="text" class="form-control" id="typeId" placeholder="Enter Accident Type" name="type">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Vehicle status</label>
                                            <input type="text" class="form-control" id="statusId" placeholder="Enter Vehicle Status " name="vehicle_status">
                                        </div>

                                    

                                        

                                        
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between" style="background-color:#f7d26c;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Add New Accident Information</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
                <!-- /.modal-dialog -->
            </div>



                 <!-- create new fuel-vehicle modal -->
                    <!-- create new fuel modal -->
            <div class="modal fade" id="modal-fuel{{$vehicle->id}}">
                <form role="form" method="post" action="{{ route('fuel.store') }}" id="fuelForm"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header" style="background-color:#f7d26c;">
                                <h4 class="modal-title">Add fuel information to vehicle {{$vehicle->reg_number}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                                    <label for="assetNameId">Vehicle details </label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter Registration number" name="vehicle_id" value="{{$vehicle->id}}" hidden >

                                                    <input type="text" class="form-control" id="assetNameId" value="{{$vehicle->model}}  {{$vehicle->reg_number}}" disabled >

                                                </div>


                                        <div class="form-group">
                                            <label for="assetNameId">Previous Odometer Reading</label>
                                            <input type="number" class="form-control" id="previousId" placeholder="Enter Previous Odometer Reading" name="previous_odometer">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Fuel Requested</label>
                                            <input type="number" class="form-control" id="dateId" placeholder="Enter Fuel Requested " name="requested">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Date Fuel Issued</label>
                                            <input type="date" class="form-control" id="fuelId" placeholder="Enter Fuel Issued date " name="date">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Fuel Receipt</label>
                                            <input type="file" class="form-control" id="fuelId" placeholder="Enter Fuel Attachments " name="attachments">
                                        </div>

                                       

                                    </div>

                                    <div class="col-6">

                                    <div class="form-group">
                                            <label for="productionId">Fuel issued</label>
                                            <input type="number" class="form-control" id="issuedId" placeholder="Enter Fuel issued" name="issued">
                                        </div>

                                        <div class="form-group">
                                            <label for="productionId">Current odometer</label>
                                            <input type="text" class="form-control" id="currentId" placeholder="Enter current Odometer reading" name="current_odometer">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Fuel activity</label>
                                            <input type="text" class="form-control" id="fuelId" placeholder="Enter Fuel activity " name="activity">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Fuel's cost</label>
                                            <input type="text" class="form-control" id="txtcostfuel" placeholder="Enter Fuel cost " name="cost" onkeyup="sumfuel()">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtvatfuel">Fuel cost + VAT</label>
                                            <input type="text" class="form-control" id="txtvatfuel" placeholder="Enter Fuel cost + VAT " name="total_vat" readonly>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between" style="background-color:#f7d26c;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add New Fuel Information</button>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
                <!-- /.modal-dialog -->
            </div>

                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- create new vehicle modal -->
            <div class="modal fade" id="modal-lg">
                <form role="form" method="post" action="{{ route('vehicle.store') }}" id="vehicleForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header" style="background-color:#f7d26c;">
                                <h4 class="modal-title">Add Vehicle</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="assetNameId">Registration Number</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Registration number" name="reg_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="productionId">Capacity</label>
                                            <input type="number" class="form-control" id="serialId" placeholder="Enter vehicle capacity" name="capacity">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Manufacturing date</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Manufacturing Date " name="manufacturing_date">
                                        </div>
                                        <div class="form-group">
                                            <label for="dateId">The first date vehicle was used</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter first Date vehicle used" name="first_used_date">
                                        </div>

                                        <div class="form-group">
                                            <label>Select assets related</label>
                                            <select class="form-control select2" style="width: 100%;" name="asset_id" placeholder="Select asset....">
                                            <option selected="selected" disabled>Select asset...</option>
                                                @foreach($assets as $asset)
                                                    <option value="{{$asset->id}}">{{$asset->name}} of {{$asset->serial_number}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="AssetSerialId">Model</label>
                                            <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter vehicle model" name="model">
                                        </div>

                                        <div class="form-group">
                                            <label for="AssetSerialengineId">Engine number</label>
                                            <input type="text" class="form-control" id="AssetSerialengineId" placeholder="Enter vehicle engine" name="engine_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="serialChassisId">Chassis number</label>
                                            <input type="text" class="form-control" id="serialChassisId" placeholder="Enter Chassis number" name="chassis_number">
                                        </div>

                                        <div class="form-group">
                                            <label>Select a driver name</label>
                                            <select class="form-control select2" style="width: 100%;" name="driver_id">
                                                <option selected="selected" disabled>Select a driver...</option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{$driver->id}}">{{$driver->fullname}} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="locationId">First odometer reading</label>
                                            <input type="number" class="form-control" id="odometerId" placeholder="Enter first odometer reading" name="first_odometer">
                                        </div>
                                    </div>   
                                </div>    
                                    
                            </div>
                            <div class="modal-footer justify-content-between" style="background-color:#f7d26c;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Add item</button>
                            </div>
                            </div>
                                </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>

                <!-- /.modal-dialog -->
            </div>

            </div>
                        <!-- /.modal-content -->
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

        $(document).ready(function(){
            $('[data-toggle="modal"]').tooltip();   
            });

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
            $('#vehicleForm').validate({
            rules: {
                reg_number: {
                        required: true,
                    },
                    model: {
                        required: true,
                    },
                    capacity: {
                        required: true,
                    },
                    engine_number: {
                        required: true,
                    },
                    chassis_number: {
                        required: true,
                    },
                    manufacturing_date: {
                        required: true,
                    },
                    first_used_date: {
                        required: true,
                    },
                    first_odometer: {
                        required: true,
                    },
                    asset_id: {
                        required: true,
                    },
            },
            messages: {
                reg_number: {
                    required: "Please enter registration number",

                },
                model: {
                        required: "Please enter vehicle model",
                },
                capacity: {
                    required: "Please enter capacity",
                },
                engine_number: {
                    required: "Please enter engine number",
                },
                chassis_number: {
                    required: "Please enter chassis number",
                },
                manufacturing_date: {
                    required: "Please select manufacturing date",
                },
                first_used_date: {
                    required: "Please select first used date",
                },
                first_odometer: {
                    required: "Please enter first odometer reading",
                },
                asset_id: {
                    required: "Please select asset",
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

        $(document).ready(function () {
            $.validator.setDefaults({
                // submitHandler: function () {
                // alert( "Form successful submitted!" );
                // }
            });
            $('#maintenanceForm').validate({
            rules: {
                
                    previous_odometer: {
                        required: true,
                    },
                    current_odometer: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    material: {
                        required: true,
                    },
                    garage: {
                        required: true,
                    },
                    supervisor: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    cost: {
                        required: true,
                    },
                    total_vat: {
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
                previous_odometer: {
                    required: "Please enter registration number",
                    
                },
                current_odometer: {
                        required: "Please enter mode",
                },
                date: {
                    required: "Please enter date",
                },
                material: {
                    required: "Please enter current odometer",
                },
                garage: {
                    required: "Please enter cost",
                },
                supervisor: {
                    required: "Please enter total VAT",
                },
                description: {
                    required: "Please enter material",
                },
                cost: {
                    required: "Please enter material",
                },
                total_vat: {
                    required: "Please enter material",
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
                },
        });
    });
    </script>
    <script>
    function sum()
    {
        var textcost = document.getElementById('txtcost').value;

        var result = parseInt(textcost)*0.18 + parseInt(textcost);
        if(!isNaN(result))
        {
            document.getElementById('txtresult').value = result;
        }
    }

    function sumservice()
    {
        var textcost = document.getElementById('txtcosts').value;

        var result = parseInt(textcost)*0.18 + parseInt(textcost);
        if(!isNaN(result))
        {
            document.getElementById('txtresults').value = result;
        }
    }

    function sumfuel()
    {
        var textcost = document.getElementById('txtcostfuel').value;

        var result = parseInt(textcost)*0.18 + parseInt(textcost);
        if(!isNaN(result))
        {
            document.getElementById('txtvatfuel').value = result;
        }
    }

    </script>

@endsection
