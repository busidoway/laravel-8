<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>@yield('meta-title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/fonts/font-awesome/css/all.min.css">
        <link type="text/css" href="/css/datepicker.min.css" rel="stylesheet">
        <link href="/css/style2.css" type="text/css"  rel="stylesheet" />
        <link href="/css/style1.css" type="text/css"  data-template-style="true" rel="stylesheet" />
        <link href="/css/style3.css" type="text/css"  rel="stylesheet" />
        <link href="/css/style.css" type="text/css"  rel="stylesheet" />
        <meta name="yandex-verification" content="" />
        <meta property="og:title" content="" />
        <meta property="og:image" content="" />
        <meta property="og:image:width" content="743" />
        <meta property="og:image:height" content="753" />
        <meta property="og:url" content="" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:locale" content="ru_RU" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link type="image/x-icon" sizes="120x120" rel="icon" href="./images/icons/favicon.ico">
        <link type="image/png" sizes="16x16" rel="icon" href="/images/icons/favicon_16.png">
		<link type="image/png" sizes="32x32" rel="icon" href="/images/icons/favicon_32.png">
		<link type="image/png" sizes="96x96" rel="icon" href="/images/icons/favicon_96.png">
		<link type="image/png" sizes="120x120" rel="icon" href="/images/icons/favicon.png">
        <meta name="theme-color" content="#273562">
    </head>
<body>
    @include('includes.header')
    @include('modules.menu')
    @yield('content')
    @include('includes.footer')
    @include('includes.scripts')
    {{-- @include('modules.events_script') --}}
</body>
</html>