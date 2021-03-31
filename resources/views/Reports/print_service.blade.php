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
        <h3><u>SERVICES REPORT {{$heading}} PRINTED {{Carbon\Carbon::parse($today)->toFormattedDateString()}}.</u></h3></center>
        
        <table width="100%" border='1' style="width:100%; border-collapse:collapse" >
            <thead>
                  <tr>
                  <th>S/N</th>
                    <th>Asset model</th>
                    <th>Materials</th>
                    <th>Service Cost</th>
                    <th>Garage</th>
                    <th>Current odometer</th>
                    <th>Next odometer </th>
                    <th>Supervisor </th> 
                    <th>Service Date</th>                   
                  </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach($services as $service)
                        <tr>
                            <td align="center">
                                {{++$i}}
                            </td>
                            <td>
                              @foreach($vehicles as $vehicle)
                                @if($service->vehicle_id == $vehicle->id)
                                    {{$vehicle->model}} {{$vehicle->reg_number}}
                                @endif
                              @endforeach
                              @foreach($generators as $generator)
                                  @if($service->generator_id == $generator->id)
                                      {{$generator->model}} {{$generator->capacity}}cc
                                  @endif
                              @endforeach
                            </td>
                            <td>{{$service->material}}</td>
                            <td>{{ number_format($service->cost, 2, '.' , ',')}}</td>
                            <td>{{$service->garage}}</td>
                            <td>{{$service->current_odometer}}</td>
                            <td>{{$service->next_odometer}}</td>
                            <td>{{$service->supervisor}}</td>
                            <td>{{$service->date}}</td>
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


