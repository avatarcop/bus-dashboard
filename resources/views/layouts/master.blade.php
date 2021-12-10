<!DOCTYPE html>
<html lang="en">

<head>
    <?php $acl_filter = Auth::user()->acl; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/plugins/images/favicon.png') }}">
    <title>BUS</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('public/assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{ asset('public/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <!-- Morris CSS -->
    <link href="{{ asset('public/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('public/assets/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('public/assets/css/colors/blue.css') }}" id="theme" rel="stylesheet">


    <!-- new -->
    <link href="{{ asset('public/assets/datatable/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="{{ asset('public/assets/datatable/datatable/jquery-ui.css') }}">

    <!-- datetime -->
    <link href="{{ asset('public/assets/datatable/js/datetime/jquery.datetimepicker.css') }}" rel="stylesheet">

    <!-- upload gambar -->
    <link rel="stylesheet" href="{{ asset('public/plugins/bower_components/dropify/dist/css/dropify.min.css') }}">

    <!-- checkbox -->
    <link href="{{ asset('public/plugins/bower_components/icheck/skins/all.css') }}" rel="stylesheet">

    <!-- tags -->
    <link href="{{ asset('public/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script>
        // (function (i, s, o, g, r, a, m) {
        //     i['GoogleAnalyticsObject'] = r;
        //     i[r] = i[r] || function () {
        //         (i[r].q = i[r].q || []).push(arguments)
        //     }, i[r].l = 1 * new Date();
        //     a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        //     a.async = 1;
        //     a.src = g;
        //     m.parentNode.insertBefore(a, m)
        // })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        // ga('create', 'UA-19175540-9', 'auto');
        // ga('send', 'pageview');
    </script>
</head>

<body>
    
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> 
                @include('layouts.header')
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
               @include('layouts.menu_sidebar')
                
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('content')
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            @include('layouts.footer')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('public/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('public/assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{ asset('public/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ asset('public/assets/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('public/assets/js/waves.js') }}"></script>
    <!--Morris JavaScript -->
    <script src="{{ asset('public/plugins/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('public/plugins/bower_components/morrisjs/morris.js') }}"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="{{ asset('public/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('public/assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/dashboard1.js') }}"></script>
    
    <!--Style Switcher -->
    <script src="{{ asset('public/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>


    <!-- datatable -->
    <script src="{{ asset('public/assets/datatable/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/datatable/datatable/jquery.validate.js') }}"></script>
    <script src="{{ asset('public/assets/datatable/datatable/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/assets/datatable/datatable/additional-methods.js') }}"></script>

    <!-- export -->
 <!--    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>  -->

     <script src="{{ asset('public/assets/datatable/export/dataTables.buttons.min.js') }}"></script>
     <script src="{{ asset('public/assets/datatable/export//buttons.flash.min.js') }}"></script>
     <script src="{{ asset('public/assets/datatable/export/jszip.min.js') }}"></script>
     <script src="{{ asset('public/assets/datatable/export/pdfmake.min.js') }}"></script>
     <script src="{{ asset('public/assets/datatable/export/vfs_fonts.js') }}"></script>
     <script src="{{ asset('public/assets/datatable/export/buttons.html5.min.js') }}"></script>
     <script src="{{ asset('public/assets/datatable/export/buttons.print.min.js') }}"></script>

    <!-- Datepicker -->
     <script src="{{ asset('public/assets/datatable/js/datetime/jquery.datetimepicker.full.js') }}"></script>

     <!-- upload gambar -->
     <script src="{{ asset('public/plugins/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

     <!-- checkbox -->
     <script src="{{ asset('public/plugins/bower_components/icheck/icheck.min.js') }}"></script>
     <script src="{{ asset('public/plugins/bower_components/icheck/icheck.init.js') }}"></script>

     <!-- tags -->
     <script src="{{ asset('public/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove:  'Supprimer',
                    error:   'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element){
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element){
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element){
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e){
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });

        jQuery(document).ready(function () {
              'use strict';

              jQuery('#filter-date, #search-from-date, #search-to-date').datetimepicker();
          });
    </script>

    @stack('scripts')
</body>

</html>