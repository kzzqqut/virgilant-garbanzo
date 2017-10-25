<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Rostra') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="https://use.fontawesome.com/9712be8772.js"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Rostra') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (!Auth::guest())
                        <li><a href="{{ route('objects.manage') }}">New Object</a></li>
                        <li><a href="{{ route('objects.index') }}">My objects</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    @if (!Auth::guest())
                        <li style="padding-top: 12px;">
                            Hello  {{ Auth::user()->name }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline">
                                {{ csrf_field() }}
                                <button type="submit" class="btn-link">Logout</button>
                            </form>
                        </li>

                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>

    @if(Session::has('success'))
        <div class="container">
            <div class="alert alert-success"><em> {!! session('success') !!}</em>
            </div>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="container">
            <div class="alert alert-danger"><em> {!! session('error') !!}</em>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include ('errors.list') {{-- Including error file --}}
            </div>
        </div>
    </div>

    <div class="container">

        @yield('content')

    </div>

</div>

</body>
</html>