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
        <h3><u>ASSETS REPORT {{$heading}} PRINTED {{Carbon\Carbon::parse($today)->toFormattedDateString()}}.</u></h3></center>
     
        <table width="100%" border='1' style="width:100%; border-collapse:collapse" >
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Ledger Folio Number</th>
                    <th>Asset name</th>
                    <th>Serial number</th>
                    <th>Unit cost</th>
                    <th>Condition </th>
                    <th>Purchased date</th>
                    <th>Received as</th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                  $i=0;
                @endphp
            @foreach($assets as $asset)
            <tr>
                <td align="center">
                     {{++$i}}
                </td>
                <td>{{$asset->ledger_folio}}</td>
                <td>{{$asset->name}}</td>
                <td>{{$asset->serial_number}}</td>
                <td style="text-align: right;">{{ number_format($asset->cost, 2, '.' , ',')}}</td>
                <td>{{$asset->condition}}</td>
                <td>{{$asset->purchased_date}}</td>
                <td>
                    @foreach($receivings as $received)
                        @if($asset->receiving_id == $received->id)
                            {{$received->item}}
                        @endif
                    @endforeach
                </td>
                               
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


