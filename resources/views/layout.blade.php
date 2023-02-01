<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{URL::asset('/images/favicon.ico')}}" type="image/x-icon"/>
    <title>Pokemon Tournament</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="antialiased bg-green-800  min-h-screen">

@yield('content')

</body>
</html>
