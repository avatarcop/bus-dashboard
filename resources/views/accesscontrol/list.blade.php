@extends('layouts.master')
@section('content')
<?php $acl_filter = Auth::user()->acl; ?>

<style type="text/css">
    tfoot {
        display: table-header-group;
    }
</style>
<script type="text/javascript">
function KonfirmasiDelete()
    {
       var x = confirm("Apakah anda yakin ?");
       if(x)
        { return true; }  
      else { return false; }
          
    }
</script>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Access control list</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
        <ol class="breadcrumb">
            <li><a href="#">Access control</a></li>
            <li class="active">List</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Access control list</h3>
            
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
            @if(strpos($acl_filter, 'accesscontrol.create') !== false)
            <a class="btn btn-primary" href="{{ url('accesscontrol/create') }}">Add access control</a><br><br>
            @endif
            <div class="table-responsive">
                <table id="myTable" width="100%" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role code</th>
                            <th>Role name</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Role code</th>
                            <th>Role name</th>
                            <th>Action</th>
                            
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $x=1; ?>
                        @if(isset($data))
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>{{ $row->role_code }}</td>
                                    <td>{{ $row->role_name }}</td>
                                    <td>
                                      @if(strpos($acl_filter, 'accesscontrol.edit') !== false)
                                      <a class="btn btn-primary" href="{{ url('accesscontrol/edit') }}/{{ $row->id }}">Edit</a>
                                      @endif
                                      &nbsp;&nbsp;&nbsp;
                                      @if(strpos($acl_filter, 'accesscontrol.delete') !== false)
                                      <a onclick="return KonfirmasiDelete()" class="btn btn-danger" href="{{ url('accesscontrol/delete') }}/{{ $row->id }}">Hapus</a></td>
                                      @endif
                                </tr>
                                <?php $x++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td>Data tidak ditemukan</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- javascript -->
<script type="text/javascript"> //reload page ajax

  $(document).ready(function () {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();

      if(dd<10) {
          dd = '0'+dd
      } 

      if(mm<10) {
          mm = '0'+mm
      } 

      today = yyyy + '-' + mm + '-' + dd;

      var table = $('#myTable').DataTable({
          "aLengthMenu": [10, 25, 50, 100],
          "order": [0,"asc"],
          // "columnDefs": [
          //     {
          //         "targets": [[2, "desc"]],
          //         "visible": false,
          //         "hidden": true,
          //         "sort": 'timestamp'
          //     }
          // ],
          "dom": 'Bfrtip',
          "buttons": [
              // 'copy',
              {
                  extend: 'excel',
                  messageTop: "Date: "+today,
                  title: 'Daftar access control'
              },
              {
                  extend: 'pdf',
                  messageBottom: null,
                  messageTop: "Date: "+today,
                  title: 'Daftar access control'
              },
              {
                  extend: 'print',
                  messageTop: function () {
                      printCounter++;
   
                      if ( printCounter === 1 ) {
                          return 'This is the first time you have printed this document.';
                      }
                      else {
                          return 'You have printed this document '+printCounter+' times';
                      }
                  },
                  messageBottom: null,
                  messageTop: "Date: "+today,
                  title: 'Daftar access control'
              }
            ]
          
      });


      $('#myTable tfoot th').each(function () {
          var title = $(this).text();
          $(this).html('<input type="text" placeholder="" />');
          var table = $('#myTable').DataTable();
          table.columns().every(function () {
              var that = this;

              $('input', this.footer()).on('keyup change', function () {
                  if (that.search() !== this.value) {
                      that
                              .search(this.value)
                              .draw();
                  }
              });
          });


      });


});

</script>


@endpush

@endsection