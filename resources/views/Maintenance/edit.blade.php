@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit maintenance information</h3>
            <a href="{{ route('maintenance.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all maintenance Information</button>
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

        <form role="form" method="post" action="{{ route('maintenance.update', $mainted->id) }}" id="editForm" enctype="multipart/form-data" >
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
                                                @if ($vehicle->id == $mainted->vehicle_id)
                                                    <label for="AssetName">Vehicle details</label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter ledger number" value="{{$vehicle->model}}  {{$vehicle->reg_number}} " disabled>
                                                     
                                                @endif
                                            @endforeach
                                            @foreach($generators as $generator)
                                                @if ($generator->id == $mainted->generator_id)
                                                    <label for="AssetName">Generator details</label>
                                                    <input type="text" class="form-control" id="assetNameId" placeholder="Enter ledger number" value="{{$generator->model}}  {{$generator->capacity}}cc " disabled>
                                                @endif
                                            @endforeach
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="quantityId">Maintenance Date</label>
                                            <input type="date" class="form-control" id="quantityId" placeholder="Enter Maintenance Date" value="{{$mainted->date}}" name="date">
                                        </div>               
                                        <div class="form-group">
                                            <label for="dateId">Previous Odometer reading</label>
                                            <input type="number" class="form-control" id="assetId" placeholder="Enter Previous reading" value="{{$mainted->previous_odometer}}" name="previous_odometer">
                                        </div>
                                        <div class="form-group">
                                            <label for="dateId">Current odometer reading</label>
                                            <input type="number" class="form-control" id="assetId" placeholder="Enter Current odometer" value="{{$mainted->current_odometer}}" name="current_odometer">
                                        </div>                         
                                        <div class="form-group">
                                                    <label for="dateId">Material Used </label>
                                                    <input type="text" class="form-control" id="dateId" placeholder="Enter material used" value="{{$mainted->material}}" name="material">
                                                </div>

                                                <div class="form-group">
                                                    <label for="dateId">Maintenance receipt </label>
                                                    <input type="file" class="form-control" id="dateId" placeholder="Enter maintenance receipt" value="{{$mainted->attachments}}" name="attachments">
                                                </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="AssetName">Garage</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Garage Name" value="{{$mainted->garage}}" name="garage">
                                        </div>
                                        <div class="form-group">
                                            <label for="AssetName">Supervisor</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Supervisor name" value="{{$mainted->supervisor}}" name="supervisor">
                                        </div>
                                        <div class="form-group">
                                            <label for="AssetName">Descriptions</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter descrption" value="{{$mainted->description}}" name="description">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Total Cost</label>
                                            <input type="number" class="form-control" id="txtcost" placeholder="Enter Asset cost" value="{{$mainted->cost}}" name="cost" onkeyup="summain()"  >
                                        </div>
                                        <div class="form-group">
                                                    <label for="locationId">Total Cost + VAT</label>
                                                    <input type="number" class="form-control" id="txttotal" placeholder="Enter total cost" value="{{$mainted->total_vat}}" name="total_vat">
                                                </div>
                                        
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-success">Update Information</button>
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
                    previous_odometer: {
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
                
            },
            messages: {
                previous_odometer: {
                    required: "Please enter previous odometer reading",
                    
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
     function summain()
    {
        var textcost1 = document.getElementById('txtcost').value;

        var result = parseInt(textcost1)*0.18 + parseInt(textcost1);
        if(!isNaN(result))
        {
            document.getElementById('txttotal').value = result;
        }
    }

    </script>
    
@endsection
