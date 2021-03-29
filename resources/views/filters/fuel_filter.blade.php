@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
           <!--  <h3 class="card-title">Fuel Details</h3> -->
            <a href="{{ route('asset.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all items</button>
            </a>
        </div>
        <form role="form" method="post" action="" id="receivingForm">
                    @csrf

                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Fuel Report filter</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="AssetName">Asset type</label>
                                            <select class="form-control select2" style="width: 100%;" name="assetType" id="assetType">
                                                <option value='0' >Select asset....</option>
                                                <option  value='1' >Motor Vehicle</options>
                                                <option  value='2' >Motor Bike</options>
                                                <option  value='3' >Generator</options>
                                            </select>
                                        </div>
                                           
                                        <div class="form-group" style="margin-top:25px;">
                                            <label for="itemNameId">from date</label>
                                            <input type="date" class="form-control" id="AssetSerialId" name="from">
                                        </div>

                                      

                                    </div>  
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="AssetName">Asset name</label>
                                            <select class="form-control select2" style="width: 100%;" name="assetId" id="assetId">
                                                <option value='0'>-- Select asset --</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="itemNameId">To date</label>
                                            <input type="date" class="form-control" id="AssetSerialId"   name="to">
                                        </div>
                                    </div> 
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success" style="float:right;">Search</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>

                </div>
@endsection
@section('pagescripts')

<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script> -->
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
          
                    $('#assetType').change(function(){
                            var id = $(this).val();
                          $('#assetId').find('option').not(':first').remove();

                            $.ajax({{

                                url: 'fuelAssetData/'+id,
                                type: 'get',
                                dataType: 'json',
                                success: function(response){

                                var len = 0;
                                if(response['data'] != null){
                                len = response['data'].length;
                                }
                                if(len > 0){

                                        // Read data and create <option >
                                    for(var i=0; i<len; i++){

                                            var id = response['data'][i].id;
                                            var name = response['data'][i].model;

                                            var option = "<option value='"+id+"'>"+name+"</option>"; 

                                            $("#assetId").append(option); 
                                    }
                                }

                            });

                      }); 

         });
    </script>
    
@endsection
