<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="{{asset('clients/img/fav.png')}}">
		<!-- Author Meta -->
		<meta name="author" content="CodePixar">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Karma Shop</title>
		<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="{{asset('clients/css/linearicons.css')}}">
			<link rel="stylesheet" href="{{asset('clients/css/owl.carousel.css')}}">
			<link rel="stylesheet" href="{{asset('clients/css/themify-icons.css')}}">
			<link rel="stylesheet" href="{{asset('clients/css/font-awesome.min.css')}}">
			<link rel="stylesheet" href="{{asset('clients/css/nice-select.css')}}">
			<link rel="stylesheet" href="{{asset('clients/css/nouislider.min.css')}}">
			<link rel="stylesheet" href="{{asset('clients/css/bootstrap.css')}}">
			<link rel="stylesheet" href="{{asset('clients/css/main.css')}}">
			<link rel="stylesheet" href="{{asset('clients/css/ion.rangeSlider.css')}}" />
			<link rel="stylesheet" href="{{asset('clients/css/ion.rangeSlider.skinFlat.css')}}" />
	</head>
	
	<body>
	<!-- Start Header Area -->
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{route('clients.lists')}}"><img src="{{asset('clients/img/logo.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item {{ active_link('clients.lists') }}">
                            <a class="nav-link" href="{{ route('clients.lists') }}">Home</a>
                        </li>
                        <li class="nav-item submenu dropdown {{ active_link('clients.products') }}">
                            <a href="{{ route('clients.products') }}" class="nav-link dropdown-toggle">Sản phẩm</a>
                        </li>
                        <li class="nav-item submenu dropdown {{ active_link('clients.blogs') }}">
                            <a href="{{ route('clients.blogs') }}" class="nav-link dropdown-toggle">Blog</a>
                        </li>
                        <li class="nav-item {{ active_link('clients.contacts') }}">
                            <a class="nav-link" href="{{ route('clients.contacts') }}">Liên hệ</a>
                        </li>
                        @if (!empty($user))
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle">Xin chào: {{$user->fullname}}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('clients.profile') }}">
                                    Thông tin cá nhân
                                 </a> 
                                </li>
                                <li><a class="dropdown-item" href="{{ route('clients.logout') }}"
                                    onclick="event.preventDefault(); if (confirm('Bạn có chắc chắn muốn đăng xuất?')) { document.getElementById('logout-form').submit(); }">
                                    Đăng xuất
                                 </a> 
                                </li>
                                 <form id="logout-form" action="{{ route('clients.logout') }}" method="POST" class="d-none">
                                    @csrf
                                 </form>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item submenu dropdown">
                            <a href="{{ route('clients.login') }}" class="nav-link dropdown-toggle">Đăng nhập</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{route('clients.register')}}">Đăng ký</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>

