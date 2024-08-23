<!DOCTYPE html>
<html lang="id" dir="ltr">
<head>

    <meta charset="utf-8" />
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Point Of Sale By Junaris Alfianto" name="description" />
    <meta content="" name="Themesbrand" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    <link href="{{asset('mania/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="{{asset('mania/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">
    <link rel="stylesheet" href="{{asset('mania/css/icons.css')}}" />
    <link rel="stylesheet" href="{{asset('mania/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('css/tailwind.css')}}" />
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{asset('css/custome.css')}}" />
    @yield('page_css')
    @livewireStyles

</head>

<body id='body' data-mode="light" data-sidebar-size="sm" class="sidebar-enabled">
