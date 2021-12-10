@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Add tipe kursi</h3>

            <div class="box box-primary">
                 <div class="box-body">
                     @if (Session::has('gagal'))
                      <div class="alert alert-danger alert-dismissable">{{ Session::get('gagal') }} 
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      </div>
                      @endif

                  </div >
                  <div class="box-body">

                       @if (Session::has('sukses'))
                      <div class="alert alert-success alert-dismissable">{{ Session::get('sukses') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      </div>
                      @endif
                  </div >
            </div>
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('tipekursi/insert')}}">
              {{ csrf_field() }}
      
              <div class="form-group">
                  <label class="col-md-12" for="example-text">Nama tipe kursi</span></label>
                  <div class="col-md-12">
                      <input type="text" required="" maxlength="45" id="nama_tipekursi" name="nama_tipekursi" class="form-control" placeholder="Nama tipe kursi">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-12" for="example-text">Total kursi</span></label>
                  <div class="col-md-12">
                      <input type="number" required="" maxlength="2" id="total_kursi" name="total_kursi" class="form-control" placeholder="Total kursi">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-12" for="example-text">Denah kursi</span></label>
                  <div class="col-md-12">
                      <input name="denah_kursi" required="" type="file" id="input-file-now-custom-1" class="dropify" data-default-file="{{ asset('public/plugins/bower_components/dropify/src/images/test-image-1.jpg') }}" />
                  </div>
              </div>
                
                <a href="{{url('tipekursi')}}" class="btn btn-info waves-effect waves-light m-r-10">Cancel</a>
                <button type="submit" class="btn btn-inverse waves-effect waves-light">Submit</button>
            </form>    
        </div>
    </div>
</div>


@push('scripts')
<!-- javascript -->

@endpush

@endsection