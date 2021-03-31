@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Items Received </h3>
                <!-- <a href="{{route('printReportReceiving')}}" target="_blank">
                <button type="button" class="btn btn-success btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button>
              </a> -->
                <button type="button" class="btn btn-primary btn-sm" style="float:right;margin-right:5px;" data-toggle="modal" data-target="#modal-lg">Add new item received</button>
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
                    <th>Ledger Number</th>
                    <th>Receipt Voucher Number</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Condition</th>
                    <th>Unit cost </th>
                    <th>Total cost </th>
                    <th>Date </th>
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($receivings as $receiving)
                  <tr>
                    <td>
                        {{$receiving->ledger_number}}
                        &nbsp
                        @if ( $receiving->reason != NULL )
                            <i class="fas fa-info-circle " style="color:green;" data-placement="top" title="{{$receiving->reason}}"></i>
                        @endif 
                    </td>
                    <td>{{$receiving->receipt_vocher}}</td>
                    <td>{{$receiving->item}}</td>
                    <td>{{$receiving->quantity}}</td>
                    <td>{{$receiving->supplier}}</td>
                    <td>{{$receiving->condition}}</td>
                    <td>{{ number_format($receiving->cost, 2, '.' , ',') }}</td>
                    <td>{{ number_format($receiving->total_cost, 2, '.' , ',') }}</td>
                    <td>{{$receiving->date}}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                               
                                <!-- <a href="{{ route('receiving.edit', $receiving->id) }}"> -->
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-smm{{$receiving->id}}"><i class="fas fa-pen"></i></button>
                                <!-- </a> -->
                            </div>
                            <div class="col-md-6">
                                <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$receiving->id}}">
                                    <i class="fas fa-trash-alt"></i>
                                </button> -->
                            </div>
                        </div>
                    </td>
                  </tr>

                    <!-- reason to edit modal -->
                    <div class="modal fade" id="modal-smm{{$receiving->id}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('editReasonRec', $receiving->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-header bg-success">
                                        <h4 class="modal-title">Editing {{$receiving->item}} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="ledgerNumberId">Reason to edit <i> {{$receiving->item}} </i></label>
                                            <textarea class="form-control" rows="3" id="ledgerNumberId" placeholder="Enter Reason why are you editing..." name="reason"></textarea>
                                        </div> 
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-success">Continue Editing</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- deleting modal -->
                  <div class="modal fade" id="modal-sm{{$receiving->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$receiving->item}} </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete <b> {{$receiving->item}} </b> with ledger number <b> {{$receiving->ledger_number}} </b> permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('receiving.destroy', $receiving->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- new receiving -->
            <div class="modal fade" id="modal-lg">
                <form role="form" method="post" action="{{ route('receiving.store') }}" id="receivingForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Add new receivings</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="ledgerNumberId">Receipt Voucher Number *</label>
                                            <input type="text" class="form-control" id="ledgerNumberId" placeholder="Enter receipt vocher number" name="receipt_vocher">
                                        </div>
                                        <div class="form-group">
                                            <label for="itemNameId">Item Name  *</label>
                                            <input type="text" class="form-control" id="itemNameId" placeholder="Enter item name" name="item">
                                        </div>

                                        <div class="form-group">
                                            <label for="quantityId">Quantity  *</label>
                                            <input type="number" class="form-control" id="quantityId" placeholder="Enter quantity" name="quantity" onkeyup="receiving()">
                                        </div>
                                    </div>

                                    <div class="col-6">

                                        <div class="form-group">
                                            <label for="costId">Date Received  *</label>
                                            <input type="date" class="form-control" id="costId" placeholder="Enter received date" name="date"  >

                                        </div>

                                        <div class="form-group">
                                            <label for="supplierId">Supplier Name  *</label>
                                            <input type="text" class="form-control" id="supplierId" placeholder="Enter Suppliers name" name="supplier">
                                        </div>

                                        <div class="form-group">
                                            <label>Condition  *</label>
                                            <select class="form-control select2" style="width: 100%;" name="condition">
                                                <option selected="selected" disabled>Select a condition...</option>
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                                <option value="Refurbished">Refurbished</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="totalcostId">Total Cost</label>
                                            <input type="number" class="form-control" id="totalcostId" placeholder="Enter total cost" name="total_cost">
                                        </div>
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add item</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
                <!-- /.modal-dialog -->
            </div>
@endsection

@section('pagescripts')
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

<!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {

            $(document).ready(function(){
            $('[class="fas fa-info-circle "]').tooltip();   
            });

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
                    receipt_vocher: {
                        required: true,
                    },
                    quantity: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    item: {
                        required: true,
                    },
                    supplier: {
                        required: true,
                    },
                    condition: {
                        required: true,
                    },
            },
            messages: {
                receipt_vocher: {
                    required: "Please enter a Receipt voucher Number",
                    receipt_vocher: "Please enter a vaild Receipt voucher Number"
                },
                quantity: {
                        required: "Please enter quantity",
                },
                date: {
                    required: "Please enter received date",
                },
                item: {
                    required: "Please enter item",
                },
                supplier: {
                    required: "Please enter supplier name",
                },
                condition: {
                    required: "Please select item condition",
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
