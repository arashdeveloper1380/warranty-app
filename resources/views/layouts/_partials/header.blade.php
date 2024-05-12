<!DOCTYPE html>
<html lang="IR-fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Roxo Administrator">
    <meta name="author" content="Masoud Salehi">
    <meta name="keyword" content="Bootstrap Data">
    <title>@yield('title') | سجاد ملک</title>
    <link href="{{ asset('admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dest/style.css') }}" rel="stylesheet">

    @yield('header')
</head>
<body class="navbar-fixed sidebar-nav fixed-nav" style="background-color: #fbf7f7">
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>
                <span style="color: red">{{ auth()->user()->name }}</span> عزیز خوش آمدید :)
                <li class="nav-item" style="float: left; margin-left: 20px !important">
                    <form action="{{  route('logout') }}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="خروج">
                    </form>
                </li>
            </ul>
        </div>
    </header>