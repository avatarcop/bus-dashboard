@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Register</h3>

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
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('user/insert')}}">
              {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Email</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" maxlength="45" required="" id="email_reg" name="email_reg" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Name</span></label>
                    <div class="col-md-12">
                        <input type="text" required="" maxlength="45" required="" id="name_reg" name="name_reg" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Access control</span></label>
                    <div class="col-md-12">
                        <select name="accesscontrol_id" class="form-control" required="">
                          <option value="" selected="">Select</option>
                        @if($data)
                          @foreach($data as $row)
                              <option value="{{ $row->id }}">{{ $row->role_name }}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Password</span></label>
                    <div class="col-md-12">
                        <input type="password" required="" maxlength="45" required="" id="password_reg" name="password_reg" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Password Confirmation</span></label>
                    <div class="col-md-12">
                        <input type="password" required="" maxlength="45" required="" id="c_password_reg" name="c_password_reg" class="form-control" placeholder="Password Confirmation">
                    </div>
                </div>                
                
                <a href="{{url('user')}}" class="btn btn-info waves-effect waves-light m-r-10">Cancel</a>
                <button type="submit" class="btn btn-inverse waves-effect waves-light">Submit</button>
            </form>    
        </div>
    </div>
</div>


@push('scripts')
<!-- javascript -->

@endpush

@endsection