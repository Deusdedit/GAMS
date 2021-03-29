@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit selected item</h3>
            <a href="{{ route('asset.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all items</button>
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

        <form role="form" method="post" action="{{ route('asset.update', $assets->id) }}" id="receivingForm">
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
                                            <label for="AssetName">Asset name</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Asset name" value="{{$assets->name}}" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="itemNameId">Asset serial number</label>
                                            <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter Asset serial number" value="{{$assets->serial_number}}" name="serial_number">
                                        </div>

                                        <div class="form-group"> 
                                            <label for="quantityId">Date bought</label>
                                            <input type="date" class="form-control" id="quantityId" placeholder="Enter Date Bought" value="{{$assets->purchased_date}}" name="purchased_date">
                                        </div>

                                        <div class="form-group">
                                            <label>Condition</label>
                                            <select class="form-control select2" style="width: 100%;" name="condition" value="{{$assets->condition}}">
                                                <option value="{{$assets->condition}}" selected="{{$assets->condition}}" disabled>{{$assets->condition}}</option>
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                                <option value="Refurbished">Refurbished</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Received items </label>
                                            <select class="form-control select2" style="width: 100%;" name="receiving_id" value="{{$assets->receiving_id}}">
                                                <option value="{{$assets->receiving_id}}" selected="{{$assets->receiving_id}}" disabled>
                                               <!--  @if ($received_asset == '')
                                                @else -->
                                                {{$received_asset->item}} of {{$received_asset->ledger_number}}
                                                <!-- @endif -->
                                                </option>
                                                @foreach($receivings as $received)
                                                    <!-- <option selected="selected" disabled>Select a received item...</option> -->
                                                    <option value="{{$received->id}}">{{$received->item}} of {{$received->ledger_number}}</option>
                                                    <!-- <option value="Used">Used</option>
                                                    <option value="Refurbished">Refurbished</option> -->
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-6">

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control select2" style="width: 100%;" name="category" value="{{$assets->category}}">
                                        <option value="{{$assets->category}}" selected="{{$assets->category}}" readonly>{{$assets->category}}</option>
                                                    <option value="Furniture and fitting">Funiture and Fitings</option>
                                                    <option value=" office Equipments">Office Equipments</option>
                                                    <option value=" Vehicle and Motor Bike">Vehicle and Motor bike</option>
                                                    <option value="Goods">Goods</option>        
                                        </select>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="supplierId">Asset production number</label>
                                            <input type="text" class="form-control" id="serialId" placeholder="Enter asset production number" value="{{$assets->product_number}}" name="product_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="supplierId">Location</label>
                                            <input type="text" class="form-control" id="locationId" placeholder="Enter Location" value="{{$assets->location}}" name="location">
                                        </div>

                                        <div class="form-group">
                                            <label for="supplierId">Activity</label>
                                            <input type="text" class="form-control" id="activityId" placeholder="Enter Activity" value="{{$assets->activity}}" name="activity">
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
            $('#receivingForm').validate({
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
