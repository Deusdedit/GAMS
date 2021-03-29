@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying <b> {{$generators->model}} </b>informations </h3>
                <a href="{{ route('generator.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all Generators </button>
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
                      <td><b>Generator Model number</b></td>
                      <td>{{$generators->model}}</td>
                    </tr>
                    <tr>
                      <td><b>Generator capacity </b></td>
                      <td>{{$generators->capacity}}</td>
                    </tr>
                    <tr>
                      <td><b>Generator manufacturing date </b></td>
                      <td>{{$generators->manufacturing_date}}</td>
                    </tr>
                    <tr>
                      <td><b>Generator first used date</b></td>
                      <td>{{$generators->first_used_date}}</td>
                    </tr>
                    <tr>
                      <td><b>Generator first odometer</b></td>
                      <td>{{$generators->first_odometer}}</td>
                    </tr>
                    
                    
                    
                    @foreach($receivings as $receiving)
                        @if(($receiving->id) == ($generators->receiving_id) )
                            <tr>
                                <td><b>Generator was received as</b></td>
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
