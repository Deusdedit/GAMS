@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit services information</h3>
            <a href="{{ route('service.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all services Information</button>
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

        <form role="form" method="post" action="{{ route('service.update', $serviced->id) }}" id="editForm" enctype="multipart/form-data" >
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Information</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @foreach($vehicles as $vehicle)
                                                @if ($vehicle->id == $serviced->vehicle_id)
                                                    <label for="AssetName">Vehicle details</label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter ledger number" value="{{$vehicle->model}}  {{$vehicle->reg_number}} " disabled>
                                                     
                                                @endif
                                            @endforeach
                                            @foreach($generators as $generator)
                                                @if ($generator->id == $serviced->generator_id)
                                                    <label for="AssetName">Generator details</label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter ledger number" value="{{$generator->model}}  {{$generator->capacity}}cc " disabled>
                                                @endif
                                            @endforeach
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="quantityId">Service Date</label>
                                            <input type="date" class="form-control" id="quantityId" placeholder="Enter service date" value="{{$serviced->date}}" name="date">
                                        </div>               
                                        
                                        <div class="form-group">
                                            <label for="dateId">Current odometer reading</label>
                                            <input type="number" class="form-control" id="assetId" placeholder="Enter Current odometer reading" value="{{$serviced->current_odometer}}" name="current_odometer">
                                        </div>    
                                        <div class="form-group">
                                            <label for="dateId">Next Odometer reading</label>
                                            <input type="number" class="form-control" id="assetId" placeholder="Enter Next odometer reading" value="{{$serviced->next_odometer}}" name="next_odometer">
                                        </div>                     
                                        <div class="form-group">
                                                    <label for="dateId">Service receipt </label>
                                                    <input type="file" class="form-control" id="dateId" placeholder="Enter service receipt" value="{{$serviced->attachments}}" name="attachments">
                                                </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="AssetName">Garage</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Garage name" value="{{$serviced->garage}}" name="garage">
                                        </div>
                                        <div class="form-group">
                                            <label for="AssetName">Supervisor</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter supervisor name" value="{{$serviced->supervisor}}" name="supervisor">
                                        </div>
                                        <div class="form-group">
                                            <label for="AssetName">Descriptions</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter decription" value="{{$serviced->description}}" name="description">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Cost</label>
                                            <input type="number" class="form-control" id="costId" placeholder="Enter Asset cost" value="{{$serviced->cost}}" name="cost" onkeyup="sumsev()" >
                                        </div>
                                        <div class="form-group">
                                            <label for="dateId">Total Cost + VAT</label>
                                            <input type="number" class="form-control" id="totalId" placeholder="Enter total VAT" value="{{$serviced->total_vat}}" name="total_vat" >
                                        </div>
                                        
                                    </div>   
                                </div>    
                                <div class="row">
                                    <label for="locationId">Material</label>
                                    <input type="text" class="form-control" id="odometerId" placeholder="Enter service material" value="{{$serviced->material}}" name="material">
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
            $('#editForm').validate({
            rules: {
                    next_odometer: {
                        required: true,
                    },
                    current_odometer: {
                        required: true,
                    },
                   
                    date: {
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
                    material: {
                        required: true,
                    },
                
            },
            messages: {
                next_odometer: {
                    required: "Please enter next odometer reading",
                    
                },
                current_odometer: {
                        required: "Please enter current odometer reading",
                },
                date: {
                    required: "Please enter date",
                },
                garage: {
                    required: "Please enter garage name",
                },
                supervisor: {
                    required: "Please enter supervisor name",
                },
                description: {
                    required: "Please enter descriptions",
                },
                cost: {
                    required: "Please enter cost",
                },
                material: {
                    required: "Please enter materials",
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

    <script>
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

<script>
     function sumsev()
    {
        var textcost1 = document.getElementById('costId').value;

        var result = parseInt(textcost1)*0.18 + parseInt(textcost1);
        if(!isNaN(result))
        {
            document.getElementById('totalId').value = result;
        }
    }

    </script>
    
@endsection
