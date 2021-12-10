@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Transaksi edit</h3>

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
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('transaksi/update')}}">
              {{ csrf_field() }}
      
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Pilih Customer</span></label>
                    <div class="col-md-12">
                        <select name="cust_id" class="form-control" required="">
                          <option value="">Select</option>
                          <option value="{{ $data->cust_id }}" selected="">{{ $data->customer->nama }}</option>
                          @if($data_customer)
                            @foreach($data_customer as $row)
                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                </div>
      
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Pilih Perusahaan Otobus (PO)</span></label>
                    <div class="col-md-12">
                        <select name="po_id" class="form-control" required="" onchange="po(this.value)">
                          <option value="" selected="">Select</option>
                          <option value="{{ $data->po_id }}" selected="">{{ $data->masterpo->nama_po }}</option>
                          @if($data_po)
                            @foreach($data_po as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_po }}</option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text">Pilih Bus</span></label>
                    <div class="col-md-12">
                        <select name="bus_id" class="form-control" required="" onchange="bus(this.value)">
                          <option value="" selected="">Select</option>
                          <option value="{{ $data->bus_id }}" selected="">{{ $data->masterbus->nama_bus }}</option>
                          @if($data_bus)
                            @foreach($data_bus as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_bus }}</option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                </div>

              <div class="form-group">
                    <label class="col-md-12" for="example-text">Harga Tiket</span></label>
                    <div class="col-md-12">
                        <input type="text" value="{{ $data->harga_tiket }}" id="harga_tiket" name="harga_tiket" class="form-control" placeholder="Harga_tiket" maxlength="16" readonly="">
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Terminal berangkat</span></label>
                    <div class="col-md-12">
                        <input type="text" value="{{ $data->terminal_berangkat }}" id="terminal_berangkat" name="terminal_berangkat" class="form-control" placeholder="Terminal berangkat" maxlength="16" readonly="">
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Terminal tujuan</span></label>
                    <div class="col-md-12">
                        <input type="text" value="{{ $data->masterbus->terminal_tujuan }}" id="terminal_tujuan" name="terminal_tujuan" class="form-control" placeholder="Terminal tujuan" maxlength="16" readonly="">
                    </div>
              </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text">Denah kursi</span></label>
                    <div class="col-md-12">
                        <a id="denahLink" href="{{ asset('storage/images') }}/{{ $data->masterbus->tipekursi->denah_kursi  }}" target="blank">
                            <img id="denahImg" src="{{ asset('storage/images') }}/{{ $data->masterbus->tipekursi->denah_kursi  }}" style="width: auto;max-height: 400px">
                        </a>
                    </div>
                </div>

              <div class="form-group">
                    <label class="col-md-12" for="example-text">Nomor Kursi Tersedia</span></label>
                    <div class="col-md-12">
                        <input type="text" value="{{ $data->data_kursisisa }}" id="kursi_sisa" name="kursi_sisa" class="form-control" readonly="">
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Pilih nomor kursi (tekan enter setelah isi)</span></label>
                    <div class="col-md-12">
                        <input type="text" value="{{ $data->nomor_kursi }}" data-role="tagsinput" required="" id="nomor_kursi" name="nomor_kursi" class="form-control"/>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Pilih nomor kursi</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->nomor_kursi }}" type="number" required="" id="nomor_kursi" name="nomor_kursi" class="form-control" placeholder="Pilih nomor kursi" maxlength="2" min="0" max="99" oninput="maxLengthCheckKursi(this)" readonly="">

                        <input name="nomor_kursi_lama" value="{{ $data->nomor_kursi }}" type="hidden">
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Nama penumpang</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->penumpang }}" type="text" required="" id="penumpang" name="penumpang" class="form-control" placeholder="Nama penumpang" maxlength="45">
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">No Handphone</span></label>
                    <div class="col-md-12">
                        <input value="{{ $data->no_hp }}" type="text" required="" id="no_hp" name="no_hp" class="form-control" placeholder="No Handphone" maxlength="16">
                    </div>
              </div>

                <input type="hidden" value="{{ $data->id }}" id="id" name="id">                      
                
                <a href="{{url('transaksi')}}" class="btn btn-info waves-effect waves-light m-r-10">Cancel</a>
                <button type="submit" class="btn btn-inverse waves-effect waves-light">Submit</button>
            </form>    
        </div>
    </div>
</div>


@push('scripts')
<!-- javascript -->
<script type="text/javascript">

function po(val)
{

    $('[name="bus_id"]').find('option').remove()
    var newState = new Option('Select Bus','',true,true);

    $('[name="bus_id"]').append(newState).trigger('change');

    var data = {!!json_encode($data_po)!!}
    $.each(data,function(index,po_data){
      
      if (po_data.id == val) 
      { 

        var bus = {!!json_encode($data_bus)!!}           
        
        $.each(bus,function(index,bus_data){
          if (bus_data.po_id == po_data.id) 
          {
            var newState = new Option(bus_data.nama_bus, bus_data.id, false,false);
            $('[name=bus_id]').append(newState).trigger('change');

            
          }
        });
      }
    });

}

function bus(val)
{
    var data_bus = {!!json_encode($data_bus)!!}
    $.each(data_bus,function(index,bus_data){
      
      if (bus_data.id == val) 
      { 
        document.getElementById("harga_tiket").value=bus_data.harga_tiket;
        document.getElementById("terminal_berangkat").value=bus_data.terminal_berangkat;
        document.getElementById("terminal_tujuan").value=bus_data.terminal_tujuan;
        var data_tp = {!!json_encode($data_tipekursi)!!}           
        
        $.each(data_tp,function(index,tp_data){
          if (tp_data.id == bus_data.tipekursi_id) 
          {
              document.getElementById("denahImg").src="../../storage/images/"+tp_data.denah_kursi;
              document.getElementById("denahLink").href="../../storage/images/"+tp_data.denah_kursi;

              
          }
        });
        
      }
    });
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