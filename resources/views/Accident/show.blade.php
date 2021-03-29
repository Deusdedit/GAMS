@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying {{$acciden->description}} informations </h3>
                <a href="{{ route('accident.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all aciident information </button>
                </a>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Column name</th>
                      <th>Detailed Information</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>Location</b></td>
                      <td>{{$acciden->location}}</td>
                    </tr>
                    <tr>
                      <td><b>Decription </b></td>
                      <td>{{$acciden->description}}</td>
                    </tr>
                    <tr>
                      <td><b>date</b></td>
                      <td>{{$acciden->date}}</td>
                    </tr>
                    <tr>
                      <td><b>Passenger</b></td>
                      <td>{{$acciden->passenger}}</td>
                    </tr>
                    <tr>
                      <td><b>Type</b></td>
                      <td>{{$acciden->type}}</td>
                    </tr>
                    <tr>
                      <td><b>Vehicle status</b></td>
                      <td>{{$acciden->vehicle_status}}</td>
                    </tr>
                    
                    @foreach($drivers as $driver)
                        @if(($driver->id) == ($acciden->driver_id) )
                            <tr>
                                <td><b>Driver full name</b></td>
                                <td>{{$driver->fullname}}</td>
                            </tr>
                            <tr>
                                <td><b>Driver License</b></td>
                                <td>{{$driver->license}}</td>
                            </tr>
                           
                        @endif
                    @endforeach

                    @foreach($vehicles as $vehicle)
                        @if(($vehicle->id) == ($acciden->vehicle_id) )
                            <tr>
                                <td><b>Vehicle Registration number</b></td>
                                <td>{{$vehicle->reg_number}}</td>
                            </tr>
                            <tr>
                                <td><b>Vehicle capacity</b></td>
                                <td>{{$vehicle->capacity}}</td>
                            </tr>

                            <tr>
                                <td><b>Vehicle model</b></td>
                                <td>{{$vehicle->model}}</td>
                            </tr>
                           
                        @endif
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
@endsection
@section('pagescripts')

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

    </script>
    
@endsection
