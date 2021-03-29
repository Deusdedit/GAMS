@extends('layouts.master')

@section('content')
<br>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><i class="fas fa-envelope"></i></h3>

                <p>Service Reports</p>
              </div>
              <div class="icon">
                <i class="fas fa-tools" style="color:white"></i>
              </div>
              <a href="{{ route('serviceReport.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> <i class="fas fa-envelope " ></i><sup style="font-size: 20px"></sup></h3>

                <p>Asset Reports</p>
              </div>
              <div class="icon">
                <i class="fas fa-dolly" style="color:white"></i>
              </div>
              <a href="{{ route('assetReport.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3> <i class="fas fa-envelope"></i></h3>

                <p>Fuel Report </p>
              </div>
              <div class="icon">
                <i class="fas fa-gas-pump " style="color:white"></i>
              </div>
              <a href="{{ route('fuelReport.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3> <i class="fas fa-envelope"></i></h3>

                <p>Accident Reports</p>
              </div>
              <div class="icon">
                <i class="fas fa-ambulance" style="color:white"></i>
              </div>
              <a href="{{ route('accidentReport.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>



              <!-- Main content -->
              <div class="content">

<div class="container-fluid">
  <div class="row">
      <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0 bg-success">
                <div class="d-flex justify-content-between">
                <h3 class="card-title">Recieveings per Month</h3>
                </div>
            </div>
            <div class="card-body">
                  <div class="d-flex">
                      <p class="ml-auto d-flex flex-column text-right">
                          
                          <span class="text-muted">Total recievings This Year <span class="text-success">
                          <i class="fas fa-arrow-up"></i> {{$tatalRec}}
                          </span></span>
                      </p>
                  </div>
                <!-- /.d-flex -->
                  <div class="position-relative mb-4">
                

                    <canvas id="barChart" height="200"></canvas>
                
                  </div>

                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                      <i class="fas fa-square text-primary"></i> This Year
                    </span>

                    <span>
                        <i class="fas fa-square text-gray"></i> Last Year
                    </span>
                </div>
            </div>
          </div>
          <!-- /.card -->
      </div>


        <!-- /.col-md-6 -->
        <div class="col-lg-6">
            <div class="card">
            <div class="card-header border-0 bg-success">
                <div class="d-flex justify-content-between ">
                <h3 class="card-title">Assets per Month</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                <p class="ml-auto d-flex flex-column text-right">
                    
                    <span class="text-muted">Total assets this year <span class="text-success">
                    <i class="fas fa-arrow-up"></i> {{$totalAsse }} 
                    </span></span>
                </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                <canvas id="areachat" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                    <i class="fas fa-square " style="color:#58e493;opacity:1;"></i> This year
                </span>
                   
                <span>
                        <i class="fas fa-square text-gray"></i> Last Year
                    </span>
                </div>
            </div>
            </div>
            <!-- /.card -->

        
        </div>
        <!-- /.col-md-6 -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->


 <!-- jQuery -->
 <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
   
   <!-- ChartJS -->
   <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>

   <!-- AdminLTE for demo purposes -->
   <script src="{{asset('assets/dist/js/demo.js')}}"></script>
   <!-- Page specific script -->
   <script type="text/javascript">
        
         $(function () {
         /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */
         var arrayRec = {{@json_encode($dataRec) }};
         var arrayRecLast = {{@json_encode($dataRecLast)}};
         var arrayAsse = {{@json_encode($dataAsse) }};
         var arrayAsseLast = {{@json_encode($dataAsseLast)}};
       


         var areaChartData = {
           labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
           datasets: [
             {
               label               : 'This year',
               backgroundColor     : 'rgba(60,141,188,0.9)',
               borderColor         : 'rgba(60,141,188,0.8)',
               pointRadius          : false,
               pointColor          : '#3b8bba',
               pointStrokeColor    : 'rgba(60,141,188,1)',
               pointHighlightFill  : '#fff',
               pointHighlightStroke: 'rgba(60,141,188,1)',
               data                : arrayRec
             },
             {
               label               : 'Last year',
               backgroundColor     : 'rgba(210, 214, 222, 1)',
               borderColor         : 'rgba(210, 214, 222, 1)',
               pointRadius         : false,
               pointColor          : 'rgba(210, 214, 222, 1)',
               pointStrokeColor    : '#c1c7d1',
               pointHighlightFill  : '#fff',
               pointHighlightStroke: 'rgba(220,220,220,1)',
               data                : arrayRecLast
             },
           ]
         }


         //-------------
         //- BAR CHART -
         //-------------
         var barChartCanvas = $('#barChart').get(0).getContext('2d')
         var barChartData = $.extend(true, {}, areaChartData)
         var temp0 = areaChartData.datasets[0]
         var temp1 = areaChartData.datasets[1]
         barChartData.datasets[0] = temp1
         barChartData.datasets[1] = temp0

         var barChartOptions = {
         responsive              : true,
         maintainAspectRatio     : false,
         datasetFill             : false,
         legend: {
             display: false
           },
         }

         var barChart = new Chart(barChartCanvas, {
           type: 'bar',
           data: barChartData,
           options: barChartOptions
         })

         //--------------
         //- Bar CHART Fuel-
         //--------------

         // Get context with jQuery - using jQuery's .get() method.
        

       var areaChartData1 = {
         labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
         datasets: [
           {
             label               : 'This Year',
             backgroundColor     : 'rgba(88, 228, 147, 1)',
             borderColor         : 'rgba(60,141,188,0.8)',
             pointRadius          : false,
             pointColor          : '#3b8bba',
             pointStrokeColor    : 'rgba(88, 228, 147, 1)',
             pointHighlightFill  : '#fff',
             pointHighlightStroke: 'rgba(88, 228, 147, 1)',
             data                : arrayAsse
           },
           {
             label               : 'Last Year',
             backgroundColor     : 'rgba(210, 214, 222, 1)',
             borderColor         : 'rgba(210, 214, 222, 1)',
             pointRadius         : false,
             pointColor          : 'rgba(210, 214, 222, 1)',
             pointStrokeColor    : '#c1c7d1',
             pointHighlightFill  : '#fff',
             pointHighlightStroke: 'rgba(220,220,220,1)',
             data                : arrayAsseLast
           },
         ]
         }

         var barChartCanvas1 = $('#areachat').get(0).getContext('2d')
         var barChartData1 = $.extend(true, {}, areaChartData1)
         var temp01 = areaChartData1.datasets[0]
         var temp11 = areaChartData1.datasets[1]
         barChartData1.datasets[0] = temp11
         barChartData1.datasets[1] = temp01

       var barChartOptions1 = {
         responsive              : true,
         maintainAspectRatio     : false,
         datasetFill             : false,
         legend: {
             display: false
           },
         }

         var barChart1 = new Chart(barChartCanvas1, {
           type: 'bar',
           data: barChartData1,
           options: barChartOptions1
         })

     })
  </script>



@stop