@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Add PO</h3>

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
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('po/insert')}}">
              {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Logo PO</span></label>
                    <div class="col-md-12">
                        <input name="logo_po" required="" type="file" id="input-file-now-custom-1" class="dropify" data-default-file="{{ asset('public/plugins/bower_components/dropify/src/images/test-image-1.jpg') }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Nama PO</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" maxlength="45" required="" id="nama_po" name="nama_po" class="form-control" placeholder="Nama PO">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Status</span></label>
                    <div class="col-md-12">
                        <select name="status" class="form-control" required="">
                          <option value="" selected="">Select</option>
                          <option value="1">Aktif</option>
                          <option value="0">Tidak aktif</option>
                       
                      </select>
                    </div>
                </div>         
                
                <a href="{{url('po')}}" class="btn btn-info waves-effect waves-light m-r-10">Cancel</a>
                <button type="submit" class="btn btn-inverse waves-effect waves-light">Submit</button>
            </form>    
        </div>
    </div>
</div>


@push('scripts')
<!-- javascript -->

@endpush

@endsection