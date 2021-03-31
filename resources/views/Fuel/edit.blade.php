@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Fuel Information</h3>
            <a href="{{ route('fuel.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all Fuel Information</button>
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

        <form role="form" method="post" action="{{ route('fuel.update', $fuel->id) }}" id="EditFuelForm" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Fuel Information</h4>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                    <div class="col-md-6">
                                    
                                    
                                        <div class="form-group"> 
                                            <label for="assetNameId">Previous Odometer Reading</label>
                                            <input type="number" class="form-control" id="previousId" placeholder="Enter Previous Odometer Reading" name="previous_odometer" value="{{$fuel->previous_odometer}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Fuel Requested</label>
                                            <input type="number" class="form-control" id="dateId" placeholder="Enter Fuel Requested " name="requested" value="{{$fuel->requested}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Date Fuel Issued</label>
                                            <input type="date" class="form-control" id="fuelId" placeholder="Enter Fuel Issued date " name="date"  value="{{$fuel->date}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Fuel activity</label>
                                            <input type="text" class="form-control" id="fuelId" placeholder="Enter Fuel activity " name="activity" value="{{$fuel->activity}}"  >
                                        </div>

                                        <div class="form-group">
                                                    <label for="dateId">Fuel Receipt</label>
                                                     <input type="file" class="form-control" id="fuelId" placeholder="Enter Maintenance Receipt " name="attachments" value="{{$fuel->attachments}}">
                                         </div>

                                         
                                       
                                    </div>

                                    <div class="col-6">

                                    <div class="form-group">
                                            <label for="productionId">Fuel issued</label>
                                            <input type="number" class="form-control" id="issuedId" placeholder="Enter Fuel issued" name="issued" value="{{$fuel->issued}}" >
                                        </div>

                                        <div class="form-group">
                                            <label for="productionId">Current odometer</label>
                                            <input type="text" class="form-control" id="currentId" placeholder="Enter current Odometer reading" name="current_odometer" value="{{$fuel->current_odometer}}" >
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Total cost</label>
                                            <input type="text" class="form-control" id="textcost" placeholder="Enter Fuel activity " name="cost" value="{{$fuel->cost}}" onkeyup="sumfuel()"  >
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Fuel cost + VAT</label>
                                            <input type="text" class="form-control" id="texttotal" placeholder="Enter Total VAT " name="total_vat" value="{{$fuel->total_vat}}" readonly >
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
            $('#EditFuelForm').validate({
            rules: {
                    previous_odometer: {
                        required: true,
                    },
                    current_odometer: {
                        required: true,
                    },
                    issued: {
                        required: true,
                    },
                    requested: {
                        required: true,
                    },

                    activity: {
                        required: true,
                    },

                    date: {
                        required: true,
                    },
                
                    
            },
            messages: {
                previous_odometer: {
                    required: "Please enter a Asset Name",
                },
                current_odometer: {
                        required: "Please enter purchased date",
                },
                issued: {
                    required: "Please enter serial number",
                },
                requested: {
                    required: "Please enter product number",
                },

                activity: {
                    required: "Please enter location",
                },

                date: {
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

    <script>
     function sumfuel()
    {
        var textcost1 = document.getElementById('textcost').value;

        var result = parseInt(textcost1)*0.18 + parseInt(textcost1);
        if(!isNaN(result))
        {
            document.getElementById('texttotal').value = result;
        }
    }

    </script>
    
@endsection
