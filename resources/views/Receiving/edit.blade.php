@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit selected item</h3>
            <a href="{{ route('receiving.index') }}">
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

        <form role="form" method="post" action="{{ route('receiving.update', $received->id) }}" id="receivingForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Edit received item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ledgerNumberId">Receipt Voucher Number</label>
                                            <input type="text" class="form-control" id="ledgerNumberId" placeholder="Enter receipt voucher number" name="receipt_vocher" value="{{$received->receipt_vocher}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="itemNameId">Item Name</label>
                                            <input type="text" class="form-control" id="itemNameId" placeholder="Enter item name" value="{{$received->item }}" name="item">
                                        </div>

                                        <div class="form-group">
                                            <label for="quantityId">Quantity</label>
                                            <input type="number" class="form-control" id="quantityId" placeholder="Enter quantity" value="{{$received->quantity}}" name="quantity" onkeyup="receiving()">
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="costId">Date received</label>
                                            <input type="date" class="form-control" id="dateId" placeholder="Enter date received" value="{{$received->date}}" name="date">
                                        </div>
                                      
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="supplierId">Supplier Name</label>
                                            <input type="text" class="form-control" id="supplierId" placeholder="Enter Suppliers name" value="{{$received->supplier}}" name="supplier">
                                        </div>

                                        <div class="form-group">
                                            <label>Condition</label>
                                            <select class="form-control select2" style="width: 100%;" name="condition" value="{{$received->condition}}">
                                                <option value="{{$received->condition}}" selected="{{$received->condition}}" readonly>{{$received->condition}}</option>
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                                <option value="Refurbished">Refurbished</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="costId">Total Cost</label>
                                            <input type="number" class="form-control" id="totalcostId" placeholder="Enter total cost" value="{{$received->total_cost}}" name="total_cost" >
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
    <script type="text/javascript">
        $(function () {
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
                    ledger_number: {
                        required: true,
                    },
                    quantity: {
                        required: true,
                    },
                    cost: {
                        required: true,
                    },
                    item: {
                        required: true,
                    },
                    supplier: {
                        required: true,
                    },
                
          
            messages: {
                ledger_number: {
                    required: "Please enter a ledger Number",
                    ledger_number: "Please enter a vaild ledger Number"
                },
                quantity: {
                        required: "Please enter quantity",
                },
                cost: {
                    required: "Please enter cost",
                },
                item: {
                    required: "Please enter item",
                },
                supplier: {
                    required: "Please enter supplier",
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
function receiving()
    {
        var textquantity = document.getElementById('quantityId').value;
        var textcost = document.getElementById('costId').value;
        var checkBox = document.getElementById("vatId");

        if(checkBox.checked == true)
          {
                var total = parseInt(textquantity) * parseInt(textcost)*1.18;
                if(!isNaN(total))
                 {
                      document.getElementById('totalcostId').value = total;
                 }
         }else{
                  var total = parseInt(textquantity) * parseInt(textcost);
                  if(!isNaN(total))
                 {
                     document.getElementById('totalcostId').value = total;
                 }
              }
    }
</script>
    
@endsection
