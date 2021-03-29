@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit selected vehicle</h3>
            <a href="{{ route('vehicle.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all vehicles</button>
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

        <form role="form" method="post" action="{{ route('vehicle.update', $vehicle->id) }}" id="EditVehicleForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Asset item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="assetNameId">Registration Number</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Registration number" value="{{$vehicle->reg_number}}" name="reg_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="productionId">Capacity</label>
                                            <input type="number" class="form-control" id="serialId" placeholder="Enter vehicle capacity" name="capacity" value="{{$vehicle->capacity}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Manufacturing date</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Manufacturing Date " name="manufacturing_date" value="{{$vehicle->manufacturing_date}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="dateId">The first date vehicle was used</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Date" name="first_used_date" value="{{$vehicle->first_used_date}}">
                                        </div>

                                        <div class="form-group">
                                            <label>Select assets related</label>
                                            <select class="form-control select2" style="width: 100%;" name="asset_id" placeholder="Select asset...." value="{{$vehicle->asset_id}}">
                                            
                                            <option value="{{$vehicled_asset->name}}" selected="{{$vehicled_asset->name}}" disabled>
                                            <!-- @if($vehicle->asset_id == '')
                                            @else -->
                                            {{$vehicled_asset->name}}
                                           <!--  @endif -->
                                            </option>
                                            
                                                @foreach($assets as $asset)
                                                    <option value="{{$asset->id}}">{{$asset->name}} of {{$asset->serial_number}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="AssetSerialId">Model</label>
                                            <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter vehicle model" name="model" value="{{$vehicle->model}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="AssetSerialengineId">Engine number</label>
                                            <input type="text" class="form-control" id="AssetSerialengineId" placeholder="Enter vehicle engine" name="engine_number" value="{{$vehicle->engine_number}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="serialChassisId">Chassis number</label>
                                            <input type="text" class="form-control" id="serialChassisId" placeholder="Enter Chassis number" name="chassis_number" value="{{$vehicle->chassis_number}}">
                                        </div>

                                        <div class="form-group">
                                            <label>Select a driver name</label>
                                            <select class="form-control select2" style="width: 100%;" name="driver_id" value="{{$vehicle->driver_id}}">
                                            <option value="{{$vehicle->driver_id}}" selected disabled>
                                              <!--   @if ($vehicled_driver == '')
                                                   
                                                   
                                                @else -->
                                                {{$vehicled_driver->fullname}} 
                                                <!-- @endif -->
                                                </option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{$driver->id}}">{{$driver->fullname}} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="locationId">First odometer reading</label>
                                            <input type="number" class="form-control" id="odometerId" placeholder="Enter odometer reading" name="first_odometer" value="{{$vehicle->first_odometer}}">
                                        </div>
                                    </div> 
 
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-success">Edit item</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
    </div>
@endsection
@section('pagescripts')

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

    
    
        $(function () {
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
            $('#EditVehicleForm').validate({
            rules: {
                    name: {
                        required: true,
                    },
                    purchased_date: {
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
                    required: "Please enter a Asset Name",
                },
                purchased_date: {
                        required: "Please enter purchased date",
                },
                serial_number: {
                    required: "Please enter serial number",
                },
                product_number: {
                    required: "Please enter product number",
                },

                location: {
                    required: "Please enter location",
                },

                activity: {
                    required: "Please enter activity",
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
