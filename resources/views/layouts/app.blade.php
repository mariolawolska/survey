<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Survey System HTML 5 demo">
        <meta name="author" content="Victor Spinei">
        <title>Survey, Quotation, Review and Register HTML form</title>

        <!-- Favicons-->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

        <!-- GOOGLE WEB FONT -->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

        <!-- BASE CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/vendors.css') }}" rel="stylesheet">

        <!-- YOUR CUSTOM CSS -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <!-- MODERNIZR MENU -->
        <script src="{{ asset('js/modernizr.js') }}"></script>

    </head>

    <body>
        @auth
        @include('layouts.frame.content.circleSide')
        @endauth

        @auth
        @include('layouts.frame.content.primaryNav')
        @endauth

        @yield('content')

        @auth
        @include('layouts.frame.content.cdOverlay')
        @endauth

        <!-- COMMON SCRIPTS -->
        <script src="{{ asset('js/modernizr.js') }}"></script>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/common_scripts.min.js') }}"></script>
        <script src="{{ asset('js/velocity.min.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
        <script src="{{ asset('js/pw_strenght.js') }}"></script>

        <!-- Wizard script -->
        <script src="{{ asset('js/registration_func.js') }}"></script>

    </body>
</html>