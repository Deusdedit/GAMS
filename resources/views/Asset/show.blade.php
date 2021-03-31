@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying {{$assets->name}} informations </h3>
                <a href="{{ route('asset.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all assets </button>
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
                      <td><b>Ledger Folio Number</b></td>
                      <td>{{$assets->ledger_folio}}</td>
                    </tr>
                    <tr>
                      <td><b>Asset name</b></td>
                      <td>{{$assets->name}}</td>
                    </tr>
                    <tr>
                      <td><b>Asset category</b></td>
                      <td>{{$assets->category}}</td>
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
                      <td><b>Code number</b></td>
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
                    <tr>
                      <td><b>Unit cost</b></td>
                      <td>{{$assets->cost}}</td>
                    </tr>
                    @foreach($receivings as $receiving)
                        @if(($receiving->id) == ($assets->receiving_id) )
                            <tr>
                                <td><b>Item was received as</b></td>
                                <td>{{$receiving->item}}</td>
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
