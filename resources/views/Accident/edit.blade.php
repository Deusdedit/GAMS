@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit disposing information</h3>
            <a href="{{ route('accident.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to Accident information</button>
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
        <form role="form" method="post" action="{{ route('accident.update',  $acciden->id) }}" id="accidentForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">

                                           


                                    
                                    @foreach($vehicles as $vehicle)
                                                @if ($vehicle->id == $acciden->vehicle_id)
                                                    <label for="assetNameId">Vehicle details </label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter Registration number" name="vehicle_id" value="{{$vehicle->id}}" hidden >
                                                                                                
                                                    <input type="text" class="form-control" id="assetNameId" value="{{$vehicle->model}}  of {{$vehicle->reg_number}}" disabled >
                                                    @endif
                                            @endforeach
                                                </div>

                                                <div class="form-group">
                                            <label>Select Driver involved</label>
                                            <select class="form-control select2" style="width: 100%;" name="driver_id" value="{{$vehicle->driver_id}}">
                                            <option value="{{$vehicle->driver_id}}" selected disabled>
                                            {{$vehicled_driver->fullname}} 
                                            </option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{$driver->id}}">{{$driver->fullname}} of {{$driver->license}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    


                                        <div class="form-group">
                                            <label for="assetNameId">Accident Location</label>
                                            <input type="text" class="form-control" id="locationId" placeholder="Enter Accident Location" name="location" value="{{$acciden->location}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Accident Description</label>
                                            <input type="text" class="form-control" id="descriptionId" placeholder="Enter Accident Description" name="description" value="{{$acciden->description}}">
                                        </div>

                                        

                                        


                                       
                                    </div>

                                    <div class="col-6">

                                    <div class="form-group">
                                            <label for="dateId">Accident Date</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Accident Date " name="date" value="{{$acciden->date}}" >
                                        </div>

                                    <div class="form-group">
                                            <label for="productionId">Number of Passenger involved</label>
                                            <input type="number" class="form-control" id="passengerId" placeholder="Enter Number of Passenger" name="passenger" value="{{$acciden->passenger}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="productionId">Accident Type</label>
                                            <input type="text" class="form-control" id="typeId" placeholder="Enter Accident Type" name="type" value="{{$acciden->type}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Vehicle status</label>
                                            <input type="text" class="form-control" id="statusId" placeholder="Enter Vehicle Status " name="vehicle_status" value="{{$acciden->vehicle_status}}">
                                        </div>

                                    

                                        

                                        
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Edit Accident Information</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
       
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
            $('#editDisposalForm').validate({
            rules: {
                    date: {
                        required: true,
                    },
                    reason: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                
            },
            messages: {
                date: {
                    required: "Please enter a Asset Name",
                },
                reason: {
                        required: "Please enter purchased date",
                },
                price: {
                    required: "Please enter serial number",
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
