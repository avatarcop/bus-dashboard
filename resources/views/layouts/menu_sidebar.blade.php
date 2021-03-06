 <ul class="nav" id="side-menu">
    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
        <!-- input-group -->
        <div class="input-group custom-search-form">
            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
        <!-- /input-group -->
    </li>
    <li class="user-pro">
        <a href="#" class="waves-effect"><img src="{{ asset('public/plugins/images/users/1.jpg') }}" alt="user-img" class="img-circle"> <span class="hide-menu">{{ Auth::user()->name }}<span class="fa arrow"></span></span>
        </a>
        <ul class="nav nav-second-level">
            <li><a href='{{ route("logout") }}'><i class="fa fa-power-off"></i> Logout</a></li>
        </ul>
    </li>
    <li class="nav-small-cap m-t-10">--- Main Menu</li>
    <li> 
        <a href="{{ url('/') }}" class="waves-effect"><i class="ti-dashboard p-r-10"></i><span class="hide-menu">Dashboard</span></a> 
    </li>

    @if(strpos($acl_filter, 'bus.list') !== false)
    <li> 
        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-truck p-r-10" data-icon="7"></i><span class="hide-menu">Master bus <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="{{ url('bus') }}">Bus list</a></li>
        </ul>
    </li>
    @endif

    @if(strpos($acl_filter, 'transaksi.list') !== false)
    <li> 
        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-archive-o p-r-10" data-icon="7"></i><span class="hide-menu">Transaksi <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="{{ url('transaksi') }}">Transaksi list</a></li>
        </ul>
    </li>
    @endif

    @if(strpos($acl_filter, 'accesscontrol.list') !== false)
    <li> 
        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cogs p-r-10" data-icon="7"></i><span class="hide-menu">Access control <span class="fa arrow"></span> </span></a>
        <ul class="nav nav-second-level">
            <li> <a href="{{ url('accesscontrol') }}">Access control list</a> </li> 
            
        </ul>
    </li>
    @endif

    @if(strpos($acl_filter, 'user.list') !== false)
    <li> 
        <a href="javascript:void(0);" class="waves-effect"><i class="icon-people p-r-10" data-icon="7"></i><span class="hide-menu">User <span class="fa arrow"></span> </span></a>
        <ul class="nav nav-second-level">
            <li> <a href="{{ url('user') }}">User list</a> </li>
            
        </ul>
    </li>
    @endif

    @if(strpos($acl_filter, 'po.list') !== false)
    <li> 
        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-film p-r-10" data-icon="7"></i><span class="hide-menu">Master PO <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="{{ url('po') }}">PO list</a></li>
        </ul>
    </li>
    @endif

    @if(strpos($acl_filter, 'tipekursi.list') !== false)
    <li> 
        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cube p-r-10" data-icon="7"></i><span class="hide-menu">Master tipe kursi <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="{{ url('tipekursi') }}">Tipe kursi list</a></li>
        </ul>
    </li>
    @endif

    

    @if(strpos($acl_filter, 'customer.list') !== false)
    <li> 
        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-circle-thin p-r-10" data-icon="7"></i><span class="hide-menu">Customer <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="{{ url('customer') }}">Customer list</a></li>
        </ul>
    </li>
    @endif

    

    <!-- 
    <li class="nav-small-cap m-t-10">--- Professional</li>
    <li> <a href="events.html" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span class="hide-menu">Events</span></a> </li>
    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-people p-r-10"></i> <span class="hide-menu"> Professors <span class="fa arrow"></span></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="professors.html">All Professors</a> </li>
        </ul>
    </li>
    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-graduation-cap p-r-10"></i> <span class="hide-menu"> Students <span class="fa arrow"></span></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="students.html">All Students</a> </li>
        </ul>
    </li>
    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bars p-r-10"></i> <span class="hide-menu"> Courses <span class="fa arrow"></span></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="courses.html">All Courses</a> </li>
        </ul>
    </li>
    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-book p-r-10"></i> <span class="hide-menu"> Library <span class="fa arrow"></span></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="library-assets.html">Library Assets</a></li>
        </ul>
    </li>
    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-building p-r-10"></i> <span class="hide-menu"> Department <span class="fa arrow"></span></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="departments.html">Departments</a></li>
        </ul>
    </li>
    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-chart p-r-10"></i> <span class="hide-menu"> Reports <span class="fa arrow"></span></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="general-report.html">General Report</a></li>
        </ul>
    </li>
    <li class="nav-small-cap m-t-10">--- Support</li>
    <li> <a href="#" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">UI Elements<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">13</span> </span></a>
        <ul class="nav nav-second-level">
            <li><a href="panels-wells.html">Panels and Wells</a></li>
        </ul>
    </li>
    <li> 
        <a href="#" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Icons<span class="fa arrow"></span></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="fontawesome.html">Font awesome</a> </li>
        </ul>
    </li>
    <li> 
        <a href="widgets.html" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Widgets</span></a> 
    </li> -->
    <!-- <li><a href='{{ route("logout") }}' class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li> -->
    
</ul>