@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying services details of 
                  @foreach($vehicles as $vehicle)
                    @if(($serviced->vehicle_id) == ($vehicle->id))
                      {{$vehicle->model}}  {{$vehicle->reg_number}}
                    @endif
                  @endforeach

                  @foreach($generators as $generator)
                    @if(($serviced->generator_id) == ($generator->id) )
                      {{$generator->model}} with capacity of {{$generator->capacity}}
                    @endif
                  @endforeach
                </h3>
                <a href="{{ route('service.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all services </button>
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
                      <td><b>Garage</b></td>
                      <td>{{$serviced->garage}}</td>
                    </tr>
                    <tr>
                      <td><b>Supervisor</b></td>
                      <td>{{$serviced->supervisor}}</td>
                    </tr>
                    <tr>
                      <td><b>Date</b></td>
                      <td>{{$serviced->date}}</td>
                    </tr>
                    <tr>
                      <td><b>Current Odometer</b></td>
                      <td>{{$serviced->current_odometer}}</td>
                    </tr>
                    <tr>
                      <td><b>Next Odometer</b></td>
                      <td>{{$serviced->next_odometer}}</td>
                    </tr>
                    <tr>
                      <td><b>Description</b></td>
                      <td>{{$serviced->description}}</td>
                    </tr>
                    <tr>
                      <td><b>Material</b></td>
                      <td>{{$serviced->material}}</td>
                    </tr>
                    <tr>
                      <td><b>Cost </b></td>
                      <td>{{$serviced->cost}}</td>
                    </tr>
                    
                    @foreach($vehicles as $vehicle)
                        @if(($vehicle->id) == ($serviced->vehicle_id) )
                            <tr>
                                <td><b>Vehicle Registration Number</b></td>
                                <td>{{$vehicle->reg_number}}</td>
                            </tr>
                            <tr>
                                <td><b>Vehicle model</b></td>
                                <td>{{$vehicle->model}}</td>
                            </tr>
                            <tr>
                                <td><b>Vehicle capacity</b></td>
                                <td>{{$vehicle->capacity}}</td>
                            </tr>
                            <tr>
                                <td><b>Vehicle engine number</b></td>
                                <td>{{$vehicle->engine_number}}</td>
                            </tr>
                            <tr>
                                <td><b>Chassis number</b></td>
                                <td>{{$vehicle->chassis_number}}</td>
                            </tr>
                            <tr>
                                <td><b>Vehicle manufacturing date</b></td>
                                <td>{{$vehicle->manufacturing_date}}</td>
                            </tr>
                            <tr>
                                <td><b>First used date</b></td>
                                <td>{{$vehicle->first_used_date}}</td>
                            </tr>
                            <tr>
                                <td><b>First odometer reading</b></td>
                                <td>{{$vehicle->first_odometer}}</td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach($generators as $generator)
                        @if(($generator->id) == ($serviced->generator_id) )
                            <tr>
                                <td><b>Generator Model</b></td>
                                <td>{{$generator->model}}</td>
                            </tr>
                            <tr>
                                <td><b>Generator capacity</b></td>
                                <td>{{$generator->capacity}}</td>
                            </tr>
                            <tr>
                                <td><b>Generator manufacturing date</b></td>
                                <td>{{$generator->manufacturing_date}}</td>
                            </tr>
                            <tr>
                                <td><b>First used date</b></td>
                                <td>{{$generator->first_used_date}}</td>
                            </tr>
                            <tr>
                                <td><b>First odometer reading</b></td>
                                <td>{{$generator->first_odometer}}</td>
                            </tr>
                            
                        @endif
                    @endforeach

                    <tr>
                      <td><b>Fuel's Receipts</b></td>
                      <td><img src="{{ URL::to('/') }}/image/{{ $serviced->attachments }}" class="img-thumbnail" width="150" /></td>
                    </tr>
                    
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
