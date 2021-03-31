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
        <h3><u>DISPOSAL REPORT {{$heading}} PRINTED {{Carbon\Carbon::parse($today)->toFormattedDateString()}}.</u></h3></center>
       
        <table width="100%" border='1' style="width:100%; border-collapse:collapse" >
            <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Asset name</th>
                    <th>Serial number</th>
                    <th>Disposed price</th>
                    <th>Reason </th>
                    <th>Disposed date</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $i=0;
                    @endphp
                    @foreach($disposals as $disposal)
                        <tr>
                             <td align="center">
                                {{++$i}}
                            </td>
                            <td>
                                @foreach($assets as $asset)
                                    @if($disposal->asset_id == $asset->id)
                                        {{$asset->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($assets as $asset)
                                    @if($disposal->asset_id == $asset->id)
                                        {{$asset->serial_number}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ number_format($disposal->price, 2, '.' , ',') }}</td>
                            <td>{{$disposal->reason}}</td>
                            <td>{{$disposal->date}}</td>
                            
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


