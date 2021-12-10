@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Bus edit</h3>

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
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('bus/update')}}">
              {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Perusahaan Otobus (PO)</span></label>
                    <div class="col-md-12">
                        <select name="po_id" class="form-control" required="">
                          <option value="" selected="">Select</option>
                          @if($data_po)
                            @foreach($data_po as $row)
                                @if($row->id == $data->po_id)
                                  <option value="{{ $row->id }}" selected="">{{ $row->nama_po }}</option>
                                @else
                                  <option value="{{ $row->id }}">{{ $row->nama_po }}</option>
                                @endif
                                
                            @endforeach
                          @endif
                      </select>
                    </div>
                </div>
               
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Tipe kursi</span></label>
                    <div class="col-md-12">
                        <select name="tipekursi_id" class="form-control" required="">
                          <option value="" selected="">Select</option>
                          @if($data_tipekursi)
                            @foreach($data_tipekursi as $row)
                                @if($row->id == $data->tipekursi_id)
                                  <option value="{{ $row->id }}" selected="">{{ $row->nama_tipekursi }}</option>
                                @else
                                  <option value="{{ $row->id }}">{{ $row->nama_tipekursi }}</option>
                                @endif
                            @endforeach
                          @endif
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Kode bus</span></label>
                    <div class="col-md-12">
                        <input class="form-control" value="{{ $data->kode_bus }}" type="text" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Nama bus</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->nama_bus }}" type="text" required="" maxlength="45" required="" id="nama_bus" name="nama_bus" class="form-control" placeholder="Nama bus">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Terminal berangkat</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->terminal_berangkat }}" type="text" required="" maxlength="45" required="" id="terminal_berangkat" name="terminal_berangkat" class="form-control" placeholder="Terminal berangkat">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Terminal tujuan</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->terminal_tujuan }}" type="text" required="" maxlength="45" required="" id="terminal_tujuan" name="terminal_tujuan" class="form-control" placeholder="Terminal tujuan">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Harga tiket</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->harga_tiket }}" type="number" required="" id="harga_tiket" name="harga_tiket" class="form-control" placeholder="Harga tiket" maxlength="9" min="0" max="999999999" oninput="maxLengthCheck(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Kursi sisa</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->kursi_sisa }}" type="text" id="kursi_sisa" name="kursi_sisa" class="form-control" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Kursi booking</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->kursi_booking }}" type="text" id="kursi_booking" name="kursi_booking" class="form-control" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Kursi terjual</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->kursi_terjual }}" type="text" id="kursi_terjual" name="kursi_terjual" class="form-control" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Jumlah kursi</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->jumlah_kursi }}" type="number" required="" id="jumlah_kursi" name="jumlah_kursi" class="form-control" placeholder="Jumlah kursi" maxlength="2" min="0" max="99" oninput="maxLengthCheckKursi(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Waktu berangkat</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->waktu_berangkat }}" type="text" required="" maxlength="45" required="" id="filter-date" name="waktu_berangkat" class="form-control" placeholder="Waktu berangkat">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Estimasi tiba</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->estimasi_tiba }}" type="text" required="" maxlength="45" required="" id="filter-date" name="estimasi_tiba" class="form-control" placeholder="Estimasi tiba">
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
                
                <a href="{{url('bus')}}" class="btn btn-info waves-effect waves-light m-r-10">Cancel</a>
                <button type="submit" class="btn btn-inverse waves-effect waves-light">Submit</button>
            </form>    
        </div>
    </div>
</div>


@push('scripts')
<!-- javascript -->

@endpush

@endsection