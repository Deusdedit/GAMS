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
        <h3><u>FUELS REPORT {{$heading}} PRINTED {{Carbon\Carbon::parse($today)->toFormattedDateString()}}.</u></h3></center>
      
        <table width="100%" border='1' style="width:100%; border-collapse:collapse" >
            <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Asset model</th>
                    <th>Fuel Issued</th>
                    <th>Activity </th>
                    <th>Date issued</th>
                    <th>Current odometer</th>
                    <th>Previous odometer</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $i=0;
                    @endphp
                  @foreach($fuels as $fuel)
                    <tr>
                            <td align="center">
                                {{++$i}}
                            </td>
                        <td>
                            @foreach($vehicles as $vehicle)
                                @if($fuel->vehicle_id == $vehicle->id)
                                    {{$vehicle->model}} {{$vehicle->reg_number}}
                                @endif
                            @endforeach
                            @foreach($generators as $generator)
                                @if($fuel->generator_id == $generator->id)
                                    {{$generator->model}} {{$generator->capacity}}cc
                                @endif
                            @endforeach
                        </td>
                        <td>{{$fuel->issued}}</td>
                        <td>{{$fuel->activity}}</td>
                        <td>{{$fuel->date}}</td>
                        <td>{{$fuel->current_odometer}}</td>
                        <td>{{$fuel->previous_odometer}}</td>
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


