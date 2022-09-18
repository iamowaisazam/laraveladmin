<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="#" />
        <meta name="author" content="#" />
        <title> @yield('title') </title>
    
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="#">
        <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/plugins/toast/toast.css')}}" rel="stylesheet" type="text/css" />
        
        @yield('css')
    </head>
<body>

    @yield('content')


   <!-- jQuery  -->
   <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
   <script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{asset('admin/assets/js/theme.js')}}"></script>
   <script src="{{asset('admin/plugins/toast/toast.js')}}"></script>
   <script src="{{asset('js/app.js')}}" ></script>
   
   @include('admin.components.notifications')

   <script>

    toastr.options = {
         "closeButton": true,
         "debug": false,
         "newestOnTop": false,
         "progressBar": false,
         "positionClass": "toast-top-right",
         "preventDuplicates": false,
         "onclick": null,
         "showDuration": "300",
         "hideDuration": "1000",
         "timeOut": "5000",
         "extendedTimeOut": "1000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
     }

   </script>

    @yield('js')
</body>
</html>