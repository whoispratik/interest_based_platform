<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="dark:bg-gray-900 bg-white text-gray-800 dark:text-gray-300">
        @inertia
    </body>
</html>
