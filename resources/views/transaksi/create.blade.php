@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Add transaksi</h3>

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
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('transaksi/insert')}}">
              {{ csrf_field() }}

              <div class="form-group">
                    <label class="col-md-12" for="example-text">Pilih Customer</span></label>
                    <div class="col-md-12">
                        <select name="cust_id" class="form-control" required="">
                          <option value="" selected="">Select</option>
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
                          @if($data)
                            @foreach($data as $row)
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
                        <input type="text" value="" id="harga_tiket" name="harga_tiket" class="form-control" placeholder="Harga_tiket" maxlength="16" readonly="">
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Terminal berangkat</span></label>
                    <div class="col-md-12">
                        <input type="text" value="" id="terminal_berangkat" name="terminal_berangkat" class="form-control" placeholder="Terminal berangkat" maxlength="16" readonly="">
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Terminal tujuan</span></label>
                    <div class="col-md-12">
                        <input type="text" value="" id="terminal_tujuan" name="terminal_tujuan" class="form-control" placeholder="Terminal tujuan" maxlength="16" readonly="">
                    </div>
              </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text">Denah kursi</span></label>
                    <div class="col-md-12">
                        <table border="1" style="border-color:#FFF">
                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k1" width="30px">1</td>
                            <td id="k2" width="30px">2</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k3" width="30px">3</td>
                            <td id="k4" width="30px">4</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k5" width="30px">5</td>
                            <td id="k6" width="30px">6</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k7" width="30px">7</td>
                            <td id="k8" width="30px">8</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k9" width="30px">9</td>
                            <td id="k10" width="30px">10</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k11" width="30px">11</td>
                            <td id="k12" width="30px">12</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k13" width="30px">13</td>
                            <td id="k14" width="30px">14</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k15" width="30px">15</td>
                            <td id="k16" width="30px">16</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k17" width="30px">17</td>
                            <td id="k18" width="30px">18</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k19" width="30px">19</td>
                            <td id="k20" width="30px">20</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k21" width="30px">21</td>
                            <td id="k22" width="30px">22</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k23" width="30px">23</td>
                            <td id="k24" width="30px">24</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k25" width="30px">25</td>
                            <td id="k26" width="30px">26</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k27" width="30px">27</td>
                            <td id="k28" width="30px">28</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k29" width="30px">29</td>
                            <td id="k30" width="30px">30</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k31" width="30px">31</td>
                            <td id="k32" width="30px">32</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k33" width="30px">33</td>
                            <td id="k34" width="30px">34</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k35" width="30px">35</td>
                            <td id="k36" width="30px">36</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k37" width="30px">37</td>
                            <td id="k38" width="30px">2</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k39" width="30px">39</td>
                            <td id="k40" width="30px">40</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k41" width="30px">41</td>
                            <td id="k42" width="30px">42</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k43" width="30px">43</td>
                            <td id="k44" width="30px">44</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td style="background-color:#FFF" width="30px"></td>
                            <td style="background-color:#FFF" width="30px"></td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k45" width="30px">45</td>
                            <td id="k46" width="30px">46</td>
                            
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k47" width="30px">47</td>
                            <td id="k48" width="30px">48</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k49" width="30px">49</td>
                            <td id="k50" width="30px">50</td>
                          </tr>

                          <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k51" width="30px">51</td>
                            <td id="k52" width="30px">52</td>
                            <td id="k53" width="30px">53</td>
                            <td id="k54" width="30px">54</td>
                            <td id="k55" width="30px">55</td>
                          </tr>

<!--                           <tr valign="middle" align="center" style="height: 30px;background-color:#7fed64;color: #000">
                            <td id="k57" width="30px">57</td>
                            <td id="k58" width="30px">58</td>
                            <td id="" width="30px" style="background-color:#FFF">&nbsp;</td>
                            <td id="k59" width="30px">59</td>
                            <td id="k60" width="30px">60</td>
                          </tr>-->                        
                        </table>
                        <!-- <a id="denahLink" href="" target="blank">
                            <img id="denahImg" src="" style="width: auto;max-height: 400px">
                        </a> -->
                    </div>
                </div>
              <!-- <div class="form-group">
                    <label class="col-md-12" for="example-text">Nomor Kursi Tersedia</span></label>
                    <div class="col-md-12">
                        <input type="text" value="" id="kursi_sisa" name="kursi_sisa" class="form-control" readonly="">

                    </div>
              </div> -->
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Pilih nomor kursi (tekan enter setelah isi)</span></label>
                    <div class="col-md-12">
                        <input type="text" value="" data-role="tagsinput" required="" id="nomor_kursi" name="nomor_kursi" class="form-control"/>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">Nama penumpang</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" id="penumpang" name="penumpang" class="form-control" placeholder="Nama penumpang" maxlength="45">
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-md-12" for="example-text">No Handphone</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" id="no_hp" name="no_hp" class="form-control" placeholder="No Handphone" maxlength="16">
                    </div>
              </div>
                
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

    var data = {!!json_encode($data)!!}
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
        // document.getElementById("kursi_sisa").value=bus_data.kursi_sisa;
        // document.getElementById("kursi_booking").value=bus_data.kursi_booking;
        // document.getElementById("kursi_terjual").value=bus_data.kursi_terjual;
          
        var booking = bus_data.kursi_booking;  
        var booking = booking.split(',');
        var terjual = bus_data.kursi_terjual; 
        var terjual = terjual.split(',');

        if(booking.length>0 && booking!= '')
        {
            for(var i=0; i< booking.length;i++)
            {
                document.getElementById("k"+booking[i]).style.backgroundColor = 'red';
            }
        }

        if(terjual.length>0 && terjual!= '')
        {
            for(var i=0; i< terjual.length;i++)
            { 
                document.getElementById("k"+terjual[i]).style.backgroundColor = 'red';
            }
        }

        // var data_tp = {!!json_encode($data_tipekursi)!!}           
        
        // $.each(data_tp,function(index,tp_data){
        //   if (tp_data.id == bus_data.tipekursi_id) 
        //   {

        //       document.getElementById("denahImg").src="../storage/images/"+tp_data.denah_kursi;
        //       document.getElementById("denahLink").href="../storage/images/"+tp_data.denah_kursi;

              
        //   }
        // });
        
      }
    });
}

function maxLengthCheckKursi(object)
  {console.log(object)
    if(isNaN(object))
    {
      console.log(object)
       $('#nomor_kursi').val('')
    }
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