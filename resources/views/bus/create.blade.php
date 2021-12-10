@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Add Bus</h3>

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
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('bus/insert')}}">
              {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Perusahaan Otobus (PO)</span></label>
                    <div class="col-md-12">
                        <select name="po_id" class="form-control" required="">
                          <option value="" selected="">Select</option>
                          @if($data)
                            @foreach($data as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_po }}</option>
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
                                <option value="{{ $row->id }}">{{ $row->nama_tipekursi }}</option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Nama bus</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" maxlength="45" required="" id="nama_bus" name="nama_bus" class="form-control" placeholder="Nama bus">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Terminal berangkat</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" maxlength="45" required="" id="terminal_berangkat" name="terminal_berangkat" class="form-control" placeholder="Terminal berangkat">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Terminal tujuan</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" maxlength="45" required="" id="terminal_tujuan" name="terminal_tujuan" class="form-control" placeholder="Terminal tujuan">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Harga tiket</span></label>
                    <div class="col-md-12">
                        <input type="number" required="" id="harga_tiket" name="harga_tiket" class="form-control" placeholder="Harga tiket" maxlength="9" min="0" max="999999999" oninput="maxLengthCheck(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Jumlah kursi</span></label>
                    <div class="col-md-12">
                        <input type="number" required="" id="jumlah_kursi" name="jumlah_kursi" class="form-control" placeholder="Jumlah kursi" maxlength="2" min="0" max="99" oninput="maxLengthCheckKursi(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Waktu berangkat</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" maxlength="45" required="" id="filter-date" name="waktu_berangkat" class="form-control" placeholder="Waktu berangkat">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Estimasi tiba</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" maxlength="45" required="" id="filter-date" name="estimasi_tiba" class="form-control" placeholder="Estimasi tiba">
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
                
                <a href="{{url('bus')}}" class="btn btn-info waves-effect waves-light m-r-10">Cancel</a>
                <button type="submit" class="btn btn-inverse waves-effect waves-light">Submit</button>
            </form>    
        </div>
    </div>
</div>


@push('scripts')
<!-- javascript -->
<script type="text/javascript">
  function maxLengthCheck(object)
  {
    if (object.value.length > object.maxLength)
    {
        object.value = object.value.slice(0, object.maxLength)

        if(object.value > object.max)
        {
           object.value = 999999999
        }
    }
  }

  function maxLengthCheckKursi(object)
  {
    if (object.value.length > object.maxLength)
    {
        object.value = object.value.slice(0, object.maxLength)

        if(object.value > object.max)
        {
           object.value = 99
        }
    }
  }

  
</script>
@endpush

@endsection