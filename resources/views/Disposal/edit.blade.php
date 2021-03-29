@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit disposing information</h3>
            <a href="{{ route('disposal.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to disposed assets</button>
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

        <form role="form" method="post" action="{{ route('disposal.update', $disposed->id) }}" id="editDisposalForm">
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
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Asset Name" value="{{$disposed_asset->name}} with serial number {{$disposed_asset->serial_number}} " disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="quantityId">Disposed Date</label>
                                            <input type="date" class="form-control" id="quantityId" placeholder="Enter Disposed Date" value="{{$disposed->date}}" name="date">
                                        </div>                                        

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="AssetName">Reason</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Reasons to disposal" value="{{$disposed->reason}}" name="reason">
                                        </div>

                                        <div class="form-group">
                                            <label for="dateId">Price</label>
                                            <input type="number" class="form-control" id="assetId" placeholder="Enter disposal price" value="{{$disposed->price}}" name="price">
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
