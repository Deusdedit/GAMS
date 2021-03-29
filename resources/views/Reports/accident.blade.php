@extends('layouts.master')

@section('content')
<p>

</p>

<div class="card">
              <div class="card-header">
                <h3 class="card-title">Accident report </h3>
                <a href="#" data-toggle="modal" data-target="#modal-print">
                <button type="button" class="btn btn-primary btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button>
              </a>
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
                    <th>Vehicle model</th>
                    <th>Registration number</th>
                    <th>Status</th>
                    <th>Location </th>
                    <th>Passengers</th>
                    <th>Driver </th>
                    <th>Date</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($accidents as $accident)
                        <tr>
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
              </div>
              <!-- /.card-body -->
            </div>
              </div>
            </div>
<!-- generate report modal   -->
    <div class="modal fade" id="modal-print">
        <form role="form" method="post" action="{{ route('printReportAccidentsc', ['days'=>'custom']) }}" target="_blank" id="vehicleForm">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" >
                        <h4 class="modal-title">Generate accident Report</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                    <a href="{{ route('printReportAccidents', ['days'=>'today']) }}" target="_blank" class="nav-link">
                                        <i class="far fa-circle text-info"></i>
                                        Today
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{ route('printReportAccidents', ['days'=>'yesterday']) }}" target="_blank" class="nav-link">
                                        <i class="far fa-circle text-info"></i> Yesterday
                                    </a>
                                    </li>
                                    <li>
                                    <a href="{{ route('printReportAccidents', ['days'=>'thisweek']) }}" target="_blank" class="nav-link">
                                        <i class="far fa-circle text-info"></i>
                                        This Week
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{ route('printReportAccidents', ['days'=>'thismonth']) }}" target="_blank" class="nav-link">
                                        <i class="far fa-circle text-info"></i>
                                        This Month
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{ route('printReportAccidents', ['days'=>'thisyear']) }}" target="_blank" class="nav-link">
                                        <i class="far fa-circle text-info"></i>
                                        This Year
                                    </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9"> 
                                <div id="accordion">
                                    <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                Custom Date
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="card-body">
                                                <div class="row">
                                                    <form role="form" method="post" action="" id="dateForm">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="dateId">Start Date</label>
                                                                <input type="date" class="form-control" id="dateId" placeholder="Enter start Date " name="start_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="dateId">End date Date</label>
                                                                <input type="date" class="form-control" id="dateId" placeholder="Enter end Date " name="end_date">
                                                            </div>
                                                        </div>
                                                        <div class="justify-content-between" style="float:right;">
                                                            <button type="submit" class="btn btn-primary">Generate</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between" style="float:right;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    });
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
    
@endsection
