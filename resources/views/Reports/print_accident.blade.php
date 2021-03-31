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
        <h3><u>ACCIDENTS REPORT {{$heading}} PRINTED {{Carbon\Carbon::parse($today)->toFormattedDateString()}}.</u></h3></center>
      
        <table width="100%" border='1' style="width:100%; border-collapse:collapse" >
            <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Vehicle model</th>
                    <th>Registration number</th>
                    <th>Status</th>
                    <th>Location </th>
                    <th>Passengers</th>
                    <th>Driver </th>
                    <th>Accident Date</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  @php
                  $i=0;
                  @endphp
                    @foreach($accidents as $accident)
                        
                        <tr>
                            <td align="center">
                               {{++$i}}
                            </td>
                            <td>
                                @foreach($vehicles as $vehicle)
                                    @if($accident->vehicle_id == $vehicle->id)
                                        {{$vehicle->model}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($vehicles as $vehicle)
                                    @if($accident->vehicle_id == $vehicle->id)
                                        {{$vehicle->reg_number}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$accident->vehicle_status}}</td>
                            <td>{{$accident->location}}</td>
                            <td>{{$accident->passenger}}</td>
                            <td>
                              @foreach($drivers as $driver)
                                    @if($accident->driver_id == $driver->id)
                                        {{$driver->fullname}}
                                    @endif
                              @endforeach
                            </td>
                            <td>{{$accident->date}}</td>
                        </tr>
                    @endforeach
                
                  </tbody>
            </table>

      
    </body>
</html>


