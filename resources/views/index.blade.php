@extends('layouts.master')
@section('content')
<?php
$user = \App\Models\Login::where('ipaddress', $_SERVER['REMOTE_ADDR'])->first();

if(!$user)
{
  echo "<h3 align='center'>Sorry, You don't have access permission to this page !</h3>";
//    echo "<h3 align='center'>Sorry, You don't have access permission to this page !</h3>";
}else{
?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Register</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
        <ol class="breadcrumb">
            <li><a href="#">User</a></li>
            <li class="active">Register</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Registered user</h3>
            <hr>
            <div class="table-responsive">
                WELCOME {{ $user->email }}
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
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- javascript -->
@endpush

<?php    
}
?>

@endsection
