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
        <center><h2><b>ASSET MANAGEMENT SYSTEM</b></h2></center>
     
         <center><h2><b>ACTIVITY LOGS REPORT</b></h2></center>
         <table width="100%" border='1' style="width:100%; border-collapse:collapse" >
                  <thead>
                  <tr>
                    <th>User </th>
                    <th>Activity</th>
                    <th>Date</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_logs as $all_log)
                      @foreach($all_user as $user)
                        @if ($all_log->causer_id == $user->id)
                          <tr>
                              <td>{{$user->first_name}} {{$user->last_name}}, <i>{{$user->email}}</i> </td>
                              <td>{{$all_log->description}}</td>
                              <td>{{$all_log->created_at}}</td>
                          </tr>
                        @endif
                      @endforeach
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


