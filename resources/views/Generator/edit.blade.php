@extends('layouts.master')

@section('content')
<p>


</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit selected generator</h3>
            <a href="{{ route('generator.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all generators</button>
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


        <form role="form" method="post" action="{{ route('generator.update', $generator->id) }}" id="EditGeneratorForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Generator item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="assetNameId">Model</label>
                                            <input type="text" class="form-control" id="modelId" placeholder="Enter Model number" value="{{$generator->model}}" name="model">
                                        </div>

                                        

                                        <div class="form-group">
                                            <label for="dateId">Manufacturing date</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Manufacturing Date " name="manufacturing_date" value="{{$generator->manufacturing_date}}">
                                        </div>
                                        

                                        <div class="form-group">
                                            <label>Select assets related</label>
                                            <select class="form-control select2" style="width: 100%;" name="asset_id" placeholder="Select asset...." value="{{$generator->asset_id}}">
                                            
                                                <option value="{{$generator_asset->name}}" selected="{{$generator_asset->name}}" disabled>{{$generator_asset->name}}</option>
                                                @foreach($assets as $asset)
                                                    <option value="{{$asset->id}}">{{$asset->name}} of {{$asset->serial_number}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">

                                    <div class="form-group">
                                            <label for="capacityId">Capacity</label>
                                            <input type="number" class="form-control" id="serialId" placeholder="Enter generator capacity" name="capacity" value="{{$generator->capacity}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">The first date generator was used</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter Date" name="first_used_date" value="{{$generator->first_used_date}}">
                                        </div>
                            
                                            <div class="form-group">
                                                <label for="locationId">First odometer reading</label>
                                                <input type="number" class="form-control" id="odometerId" placeholder="Enter odometer reading" name="first_odometer" value="{{$generator->first_odometer}}">
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
            $('#EditGeneratorForm').validate({
            rules: {
                    model: {
                        required: true,
                    },
                    capacity: {
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

                /*     asset_id: {
                        required: true,
                    },
                 */
                    // password: {
                    //     required: true,
                    //     minlength: 5
                    // },
                    // terms: {
                    //     required: true
                    // },
            },
            messages: {
                model: {
                    required: "Please enter a Generator model number",
                },
                capacity: {
                        required: "Please enter capacity",
                },
                manufacturing_date: {
                    required: "Please enter manufacturing date",
                },
                first_used_date: {
                    required: "Please enter first used date",
                },

                first_odometer: {
                    required: "Please First odometer reading",
                },

                /* asset_id: {
                    required: "Please asset activity",
                },
                 */
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
