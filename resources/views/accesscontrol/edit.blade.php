@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Access control edit</h3>

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
           
        	<form class="form-material form-horizontal" id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('accesscontrol/update')}}">
              {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Role code</span></label>
                    <div class="col-md-12">
                        <input type="text" value="{{ $data->role_code }}" required="" maxlength="45" required="" id="role_code" name="role_code" class="form-control" placeholder="Role code">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Role name</span></label>
                    <div class="col-md-12">
                        <input type="text" value="{{ $data->role_name }}" required="" maxlength="45" required="" id="role_name" name="role_name" class="form-control" placeholder="Role name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Access Information</span></label>
                    <div class="col-md-12">
                        <?php 
                            $routeCollection = Route::getRoutes();
                            $new             = [];
                            $groups          = [];
                            foreach ($routeCollection as $value) {

                                if(($value->getName() != '') or (!$value)){
                                    if(strpos($value->getName(), 'front-user') === false){
                                        
                                        if (in_array(explode(".",$value->getName())[0], $groups)) {
                                            
                                        } else {

                                            array_push($groups, explode(".",$value->getName())[0]);
                                        }                            
                                        array_push($new, $value->getName());
                                    }
                                }                            
                            } 
                            asort($groups);
                            foreach ($groups as $key => $group) {
                                if($group != 'login' && $group != 'logout' && $group != 'password' && $group != 'register' && $group != 'dashboard')
                                {

                                  echo '<label class="switch"><input type="checkbox" class="skip" onclick="checkclass(\''.$group.'\')" id="'.$group.'"/><span></span><em> '.$group.'</em> </label></br>';
                                  foreach ($routeCollection as $row) {
                                      if(explode(".",$row->getName())[0] == $group)
                                      {
                                          if(strpos($data->route_access_list, $row->getName()))
                                          {
                                              $checked = 'checked';
                                          }else{
                                              $checked = '';
                                          }
                                          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch" style="margin-left:25px;"><input '.$checked.' type="checkbox" name="routelist[]" class="'.$group.' skip" value="'.$row->getName().'"/><span></span> '.$row->getName().'</label></br>';
                                          
                                      }
                                  }
                                  echo '</br>';
                                }
                            }
                            
                        ?> 
                    </div>
                </div>

                <input type="hidden" value="{{ $data->id }}" id="id" name="id">                        
                
                <a href="{{url('user')}}" class="btn btn-info waves-effect waves-light m-r-10">Cancel</a>
                <button type="submit" class="btn btn-inverse waves-effect waves-light">Submit</button>
            </form>    
        </div>
    </div>
</div>


@push('scripts')
<!-- javascript -->
<script type="text/javascript">
  function checkclass(data)
    {   
        if($( "#"+data ).is(':checked'))
        {                    
            $( "."+data ).not(this).prop( "checked", true );        
        } 
        else 
        {                    
            $( "."+data ).not(this).prop( "checked", false );        
        }        

    }

</script>
@endpush

@endsection