<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TurnoverBnB Vue Test</title>
    
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

</head>
<body class='bg-gray-200 text-gray-900 container mx-auto'>
<div id="app">
   <app></app>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>