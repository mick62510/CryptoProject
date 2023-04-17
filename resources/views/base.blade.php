<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Trading Journal, intègre tous les tradings que tu as fait et possède des graphiques, des exports.">
    <meta name="keywords"
          content="crypto, cryto journal, journal crypto, dashboard crypto, crypto dashboard, journal">
    <meta name="author" content="TradingJournal">

    <title>Trading-Journal</title>
    <link rel="apple-touch-icon" href="{{Vite::asset('resources/images/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{Vite::asset('resources/images/favicon.ico')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    @vite(['resources/css/app.scss',])
    @stack('css')
</head>


@yield('body')
