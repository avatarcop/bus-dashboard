@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">PO edit</h3>

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
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('po/update')}}">
              {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Logo PO</span></label>
                    <div class="col-md-12">
                        <input name="logo_po" type="file" id="input-file-now-custom-1" class="dropify" data-default-file="{{ asset('storage/images') }}/{{ $data->logo_po }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Nama PO</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->nama_po }}" type="text" required="" maxlength="45" required="" id="nama_po" name="nama_po" class="form-control" placeholder="Nama PO">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Status</span></label>
                    <div class="col-md-12">
                        <select name="status" class="form-control" required="">
                          @if($data->status==1)
                            <option value="">Select</option>
                            <option value="1" selected="">Aktif</option>
                            <option value="0">Tidak aktif</option>
                          @else
                            <option value="" selected="">Select</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak aktif</option>
                          @endif
                          
                       
                      </select>
                    </div>
                </div>    

                <input type="hidden" value="{{ $data->id }}" id="id" name="id">                      
                
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