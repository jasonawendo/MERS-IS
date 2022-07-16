<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MERS</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">

    </style>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Scripts -->
        <!---@vite(['resources/css/app.css', 'resources/js/app.js'])---->


    </head>


    <div class="wrapper">
    <nav class="fixed-top">
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      <div class="logo"><a href="#">ME<span style="color: #E30613;">RS</span></a></div>
        <ul class="links">
          <li><a href="{{URL('/')}}">Home</a></li>

          @if (Route::has('login'))
                            @auth
                            <x-app-layout>
                                
                            </x-app-layout>
                   
                        
                    @else
                    
                      

                        @if (Route::has('register'))

                        <li>
            <a href="{{ route('register') }}" class="desktop-link">Register</a>
 
          </li>
          <li><a href="{{ route('login') }}">Login</a></li>
                       
                        @endif
                    @endauth
              
            @endif

         
        </ul>
      </div>
</div>



    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
