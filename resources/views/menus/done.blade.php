<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrainingMenus</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="title">
            <h2>
                {{ __('WellDone!!') }}
            </h2>
        </x-slot>
        <h1>WellDone</h1>
        
        <a href="/menus/{{$menu->id}}">continue</a>
    </x-app-layout>
    
    <style>
        
    </style>
    
    </body>
</html>
