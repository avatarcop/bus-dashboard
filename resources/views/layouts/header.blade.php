<a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
<div class="top-left-part">
    <a class="logo" href="{{ url('/') }}"><b><img src="{{ asset('public/plugins/images/eliteadmin-logo.png') }}" alt="home" /></b><span class="hidden-xs"><strong>elite</strong>university</span></a>
</div>
<!-- <ul class="nav navbar-top-links navbar-left hidden-xs">
    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
    <li>
        <form role="search" class="app-search hidden-xs">
            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
    </li>
</ul> -->
<ul class="nav navbar-top-links navbar-right pull-right">
    <li class="dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-envelope"></i>
    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
    </a>
        <ul class="dropdown-menu mailbox animated bounceInDown">
            <li>
                <div class="drop-title">You have 4 new messages</div>
            </li>
            <li>
                <div id="notif" class="message-center">
            
                </div>
            </li>
            @if(strpos($acl_filter, 'transaksi.list') !== false)
            <li>
                <a class="text-center" href="{{ url('transaksi') }}"> <strong>Lihat semua transaksi</strong> <i class="fa fa-angle-right"></i> </a>
            </li>
            @endif
        </ul>
        <!-- /.dropdown-messages
    <!-- </li> -->
    <!-- /.dropdown -->
    <!-- <li class="dropdown"> 
        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-note"></i>
    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
    </a>
        <ul class="dropdown-menu dropdown-tasks animated slideInUp">
            <li>
                <a href="#">
                    <div>
                        <p> <strong>Task 1</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <p> <strong>Task 2</strong> <span class="pull-right text-muted">20% Complete</span> </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <p> <strong>Task 3</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a>
            </li>
        </ul> -->
        <!-- /.dropdown-tasks
    </li> -->
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{ asset('public/plugins/images/users/1.jpg') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->name }}</b> </a>
        <ul class="dropdown-menu dropdown-user animated flipInY">
            <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i>  Logout</a></li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
    <!-- /.dropdown -->
</ul>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "{{ url('transaksi_notif') }}",

            success: function(data)
            {   
                $('#notif').html('')
 // console.log('data '+data);
                $.each(JSON.parse(data),function(index,trx_data){
                    // console.log('1 '+trx_data.masterpo.logo_po);
                    // console.log('1 '+trx_data.customer.nama);
                    // console.log('1 '+trx_data.masterbus.terminal_tujuan);
                    // console.log('1 '+trx_data.created_at);  
                    $('#notif').append('\
                        <a href="#">\
                            <div class="user-img"> \
                            <img src="{{ asset("storage/images") }}/'+trx_data.masterpo.logo_po+'" class="img-circle"> <span class="profile-status online pull-right"></span> </div>\
                            <div class="mail-contnet"><h5>'+trx_data.customer.nama+'</h5><span class="mail-desc">Tujuan '+trx_data.masterbus.terminal_tujuan+'</span></div>\
                        </a>\
                    ');
                });

                   
            }
        });
    });
</script>
@endpush