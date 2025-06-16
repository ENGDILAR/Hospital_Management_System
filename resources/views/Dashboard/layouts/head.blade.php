<!-- Title -->
<title> @yield('title') </title>
<!-- livewire extends we need it in every page for style so we put it here insted of extend it in every pages-->
@livewireStyles
@yield('css')
<!--- Style css -->

@if (App::getLocale() == 'ar')
<!-- return rtl style cause the direct of arabic the sntax  -->
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('Dashboard/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('Dashboard/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('Dashboard/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('Dashboard/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('Dashboard/css-rtl/sidemenu.css')}}">
<link href="{{URL::asset('Dashboard/css-rtl/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{URL::asset('Dashboard/css-rtl/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('Dashboard/css-rtl/skin-modes.css')}}" rel="stylesheet">


@else
<!--get the style for ltr-->

<!-- Favicon -->
<link rel="icon" href="{{URL::asset('Dashboard/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('Dashboard/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('Dashboard/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Right-sidemenu css -->
<link href="{{URL::asset('Dashboard/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('Dashboard/css/sidemenu.css')}}">
<link href="{{URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<!-- style css -->
<link href="{{URL::asset('Dashboard/css/style.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/css/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('Dashboard/css/skin-modes.css')}}" rel="stylesheet" />

@endif