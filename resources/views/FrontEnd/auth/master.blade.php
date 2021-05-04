<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>@yield('title') </title>
        <link rel="icon" type="image/x-icon" href="{{ asset('/Back') }}/assets/img/favicon.ico"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href="{{ asset('/Back') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/Back') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/Back') }}/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/assets/css/forms/theme-checkbox-radio.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/assets/css/forms/switches.css">

    </head>
    <body class="form">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/Back') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('/Back') }}/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('/Back') }}/bootstrap/js/bootstrap.min.js"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/Back') }}/assets/js/authentication/form-2.js"></script>

    </body>
</html>
