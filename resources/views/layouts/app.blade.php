<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Flow+Rounded&family=Varela+Round&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/flowbite.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/button.datatables.css')}}">

    <!-- Script -->
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/flowbite.js')}}"></script>
    <script src="{{asset('assets/js/datepicker.js')}}"></script>
    <script src="{{asset('assets/js/datatables.js')}}"></script>
    <script src="{{asset('assets/js/button.datatables.js')}}"></script>

    <!-- Styles -->
    <style>
        *{
            font-family: 'Varela Round', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
      
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px grey; 
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #4B5563; 
            border-radius: 10px;
        }
      
        ::-webkit-scrollbar-thumb:hover {
            background: rgb(95, 95, 110);
        }

        .dt-buttons button{
            width: 100px;
            background-color: rgb(59,130,246);
            background:  rgb(59,130,246) !important;
            color: white !important;
            font-weight: 900;
            border: 0 !important;
            border-radius: 0.5rem !important;
        }

        .dt-buttons button:hover{
            --tw-scale-x: 1.05;
            --tw-scale-y: 1.05;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }


    </style>
</head>
<body>
    <div class="w-screen h-screen overflow-x-hidden">
        @if(Auth::user())
            @if(Auth::user()->first_time_login == '0')
                @include('layouts.navigation')
            @endif
        @endif
        
        @yield('content')
    </div>
</body>
</html>