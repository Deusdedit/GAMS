<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body style="font-size:10;">    
        <img  style="width:100%;" src="{{ public_path('assets/img/barner.png')}}"></img>
         <br>
        <!--  <br> -->
        <center><h2><b>ASSET MANAGEMENT SYSTEM</b></h2>
        <h3><u>RECEIVINGS REPORT {{$heading}} PRINTED {{Carbon\Carbon::parse($today)->toFormattedDateString()}}.</u></h3></center>
      
         <table width="100%" border='1' style="width:100%; border-collapse:collapse" >
                  <thead>
                  <tr>
                    <th>Ledger Number</th>
                    <th>Receipt Voucher Number</th>
                    <th>Received Item</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Condition</th>
                    <th>Date received </th>
                    <th>Unit cost </th>
                    <th>Total cost </th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($receivings as $receiving)
                  <tr>
                    <td>{{$receiving->ledger_number}}</td>
                    <td>{{$receiving->receipt_vocher}}</td>
                    <td>{{$receiving->item}}</td>
                    <td>{{$receiving->quantity}}</td>
                    <td>{{$receiving->supplier}}</td>
                    <td>{{$receiving->condition}}</td>
                    <td>{{$receiving->date}}</td>
                    <td>{{ number_format($receiving->cost, 2, '.' , ',')}}</td>
                    <td>{{ number_format($receiving->total_cost, 2, '.' , ',')}}</td>
                    
                  </tr>

                 
                  
                  @endforeach
                  </tbody>
                </table>
        <!-- <footer style="background-color:#F5B041;">
            <strong>Copyright &copy; 2021 <a href="https://www.gst.go.tz/">GST</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
            </div>
        </footer> -->
    </body>
</html>


