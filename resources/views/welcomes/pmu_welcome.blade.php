@extends('layouts.master')

@section('content')
<br>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $assets }}</h3>

                <p>Available Assets</p>
              </div>
              <div class="icon">
                <i class="fas fa-dolly" style="color:white"></i>
              </div>
              <a href="{{ route('asset.index')}}" class="small-box-footer">Asset info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$receives}}<sup style="font-size: 20px"></sup></h3>

                <p>All Receivings</p>
              </div>
              <div class="icon">
                <i class="fas fa-cloud-download-alt" style="color:white"></i>
              </div>
              <a href="{{ route('receiving.index')}}" class="small-box-footer">Receiving info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$counting}}</h3>

                <p>Received assets</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('asset.index')}}" class="small-box-footer">Asset info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$dispose}}</h3>

                <p>Disposed Assets</p>
              </div>
              <div class="icon">
                
              <i class="fas fa-recycle" style="color:white"></i>
              </div>
              <a href="{{ route('disposal.index')}}" class="small-box-footer">Disposal info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
  

        <!-- Main content -->
        <div class="content">

            <div class="container-fluid">
                  <div class="row">
                          <!-- /.col-md-6 -->
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
                                          
                                            <span class="text-muted">Receivings this year <span class="text-success"><i class="fas fa-arrow-up"></i> {{$tatalRec}}</span></span>
                                        </p>
                                        </div>
                                        <!-- /.d-flex -->

                                        <div class="position-relative mb-4">
                                        <canvas id="barChart1" height="200"></canvas>
                                        </div>

                                        <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square " style="color:#3c8dbc;opacity: 0.9;"></i> This year
                                        </span>
                                          
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col-md-6 -->


                            <!-- /.col-md-6 -->
                            <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header border-0 bg-success">
                                              <div class="d-flex justify-content-between">
                                                  <h3 class="card-title">Assets per Month</h3>
                                              
                                              </div>
                                        </div>
                                        <div class="card-body">
                                                <div class="d-flex">
                                                    <p class="ml-auto d-flex flex-column text-right">
                                                        
                                                        <span class="text-muted">Asset Recived This Year <span class="text-success">
                                                        <i class="fas fa-arrow-up"></i> {{$tatalAsse}}
                                                        </span></span>
                                                    </p>
                                                </div>
                                                <!-- /.d-flex -->

                                                  <div class="position-relative mb-4">
                                                    <canvas id="barChat2" height="200"></canvas>
                                                  </div>

                                                  <div class="d-flex flex-row justify-content-end">
                                                    <span class="mr-2">
                                                        <i class="fas fa-square " style="color:#58e493;opacity: 1;"></i> This year
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
         var arrayREC = {{@json_encode($dataArrRec) }};
         var arrayAsset = {{@json_encode($dataArrAsset)}};
        


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
               data                : arrayREC
             },
           ] 
         }


         //-------------
         //- BAR CHART -
         //-------------
         var barChartCanvas = $('#barChart1').get(0).getContext('2d')
         var barChartData = $.extend(true, {}, areaChartData)
         var temp0 = areaChartData.datasets[0]
         barChartData.datasets[0] = temp0

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
         //- Bar CHART Asset-
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
             data                : arrayAsset
           },
         ]
         }

         var barChartCanvas1 = $('#barChat2').get(0).getContext('2d')
         var barChartData1 = $.extend(true, {}, areaChartData1)
         var temp01 = areaChartData1.datasets[0]
        
         barChartData1.datasets[0] = temp01

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