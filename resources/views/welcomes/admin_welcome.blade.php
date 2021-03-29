@extends('layouts.master')

@section('content')
<br>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$log}}</h3>

                <p>User Logs</p> 
              </div>
              <div class="icon">
                <i class="fas fa-history" style="color:white"></i>
              </div>
              <a href="" class="small-box-footer">Display logs <i class="fas fa-arrow-circle-right" ></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$active}}<sup style="font-size: 20px"></sup></h3>

                <p>Active users</p>
              </div>
              <div class="icon">
                <i class="fas fa-star" style="color:white"></i>
              </div>
              <a href="#" class="small-box-footer">Display Activated users  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$userCount}}</h3>

                <p>All Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add" style="color:white"></i>
              </div>
              <a href="{{ route('user.index')}}" class="small-box-footer">Display users <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><h3>{{$deactivated}}<sup style="font-size: 20px"></sup></h3></h3>

                <p>Deactivated Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-ban" style="color:white"></i>
              </div>
              <a href="#" class="small-box-footer">Display Deactivated users <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <!-- BAR CHART -->
        <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">All activity logs</h3>

                <div class="card-tools">
                  
                  <a href="{{route('printReportLogs')}}" target="_blank">
                <button type="button" class="btn btn-light btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button>
              </a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
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
              </div>
              <!-- /.card-body -->
            </div>

          
          
@endsection
@section('pagescripts')

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    
    
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "order": [[ 2, "desc" ]]
    });
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
    
@endsection




