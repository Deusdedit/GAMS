@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying fuel details of 
                  @foreach($vehicles as $vehicle)
                    @if(($fuels->vehicle_id) == ($vehicle->id))
                      {{$vehicle->model}}  {{$vehicle->reg_number}}
                    @endif
                  @endforeach

                  @foreach($generators as $generator)
                    @if(($fuels->generator_id) == ($generator->id) )
                      {{$generator->model}} with capacity of {{$generator->capacity}}
                    @endif
                  @endforeach
                </h3>
                <a href="{{ route('fuel.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all fuel information </button>
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
                      <td><b>Fuel Previous odometer</b></td>
                      <td>{{$fuels->previous_odometer}}</td>
                    </tr>
                    <tr>
                      <td><b>Fuel current odometer</b></td>
                      <td>{{$fuels->current_odometer}}</td>
                    </tr>
                    <tr>
                      <td><b>Fuels issued</b></td> 
                      <td>{{$fuels->issued}}</td>
                    </tr>
                    <tr>
                      <td><b>Fuels requested</b></td>
                      <td>{{$fuels->requested}}</td>
                    </tr>
                    <tr>
                      <td><b>Fuel's activity</b></td>
                      <td>{{$fuels->activity}}</td>
                    </tr>
                    <tr>
                      <td><b>Fuel's Date issued</b></td>
                      <td>{{$fuels->date}}</td>
                    </tr>
                    <tr>
                      <td><b>Fuel's cost</b></td>
                      <td>{{$fuels->cost}}</td>
                    </tr>
                    <tr>
                      <td><b>Fuel's cost + VAT</b></td>
                      <td>{{$fuels->total_vat}}</td>
                    </tr>
                    
                    
                    @foreach($vehicles as $vehicle)
                        @if(($vehicle->id) == ($fuels->vehicle_id) )
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
                        @if(($generator->id) == ($fuels->generator_id) )
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
                      <td><b>Fuel's Attachment</b></td>
                      <td><img src="{{ URL::to('/') }}/image/{{ $fuels->attachments }}" class="img-thumbnail" width="150" /></td>
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
