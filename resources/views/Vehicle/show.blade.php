@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying <b> {{$vehicles->reg_number}} </b>informations </h3>
                <a href="{{ route('vehicle.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all vehicles </button>
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
                      <td><b>Vehicle registration number</b></td>
                      <td>{{$vehicles->reg_number}}</td>
                    </tr>
                    <tr>
                      <td><b>Vehicle model </b></td>
                      <td>{{$vehicles->model}}</td>
                    </tr>
                    <tr>
                      <td><b>Vehicle capacity </b></td>
                      <td>{{$vehicles->capacity}}</td>
                    </tr>
                    <tr>
                      <td><b>Vehicle engine number</b></td>
                      <td>{{$vehicles->engine_number}}</td>
                    </tr>
                    <tr>
                      <td><b>Vehicle chassis number</b></td>
                      <td>{{$vehicles->chassis_number}}</td>
                    </tr>
                    <tr>
                      <td><b>Manufacturing Date</b></td>
                      <td>{{$vehicles->manufacturing_date}}</td>
                    </tr>
                    <tr>
                      <td><b>First used date</b></td>
                      <td>{{$vehicles->first_used_date}}</td>
                    </tr>
                    <tr>
                      <td><b>First Odometer</b></td>
                      <td>{{$vehicles->first_odometer}}</td>
                    </tr>
                    @foreach($receivings as $receiving)
                        @if(($receiving->id) == ($vehicles->receiving_id) )
                            <tr>
                                <td><b>Vehicle was received as</b></td>
                                <td>{{$receiving->item}}</td>
                            </tr>
                            <tr>
                                <td><b>Receiving ledger number was</b></td>
                                <td>{{$receiving->ledger_number}}</td>
                            </tr>
                            <tr>
                                <td><b>Receiving cost was</b></td>
                                <td>{{$receiving->cost}}</td>
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
