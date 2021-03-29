@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying disposing information of {{$assets->name}} </h3>
                <a href="{{ route('disposal.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all disposed assets </button>
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
                      <td><b>Disposing price</b></td>
                      <td>{{$disposed->price}}</td>
                    </tr>
                    <tr>
                      <td><b>Disposing reason</b></td>
                      <td>{{$disposed->reason}}</td>
                    </tr>
                    <tr>
                      <td><b>Disposed date</b></td>
                      <td>{{$disposed->date}}</td>
                    </tr>
                    <tr>
                      <td><b>Asset name</b></td>
                      <td>{{$assets->name}}</td>
                    </tr>
                    <tr>
                      <td><b>Purchased date </b></td>
                      <td>{{$assets->purchased_date}}</td>
                    </tr>
                    <tr>
                      <td><b>Serial number </b></td>
                      <td>{{$assets->serial_number}}</td>
                    </tr>
                    <tr>
                      <td><b>Asset condition</b></td>
                      <td>{{$assets->condition}}</td>
                    </tr>
                    <tr>
                      <td><b>Product number</b></td>
                      <td>{{$assets->product_number}}</td>
                    </tr>
                    <tr>
                      <td><b>Location</b></td>
                      <td>{{$assets->location}}</td>
                    </tr>
                    <tr>
                      <td><b>Activity</b></td>
                      <td>{{$assets->activity}}</td>
                    </tr>
                    @foreach($vehicles as $vehicle)
                        @if(($vehicle->asset_id) == ($assets->id) )
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
                        @if(($generator->asset_id) == ($assets->id) )
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
