<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin Panel</title>

        {{-- Styles --}}
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('styles')
    </head>

    <body>
        <div class="container-fluid no-padding">
            <div class="row">
                <div class="col-md-2">
                    <div class="navbar navbar-fixed-left">
                        <div class="header">
                            <p><i class="fa fa-cogs" aria-hidden="true"></i> <a href="{{ route('home') }}">Admin Panel</a></p>
                        </div>
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('server') }}"><i class="fa fa-bars" aria-hidden="true"></i> Hosting Server</a>
                            </li>
                            <li>
                                <a href="{{ route('server') }}"><i class="fa fa-desktop" aria-hidden="true"></i> Websites</a>
                                <ul class="website-list">
                                    @forelse (\App\Website::all() as $website)
                                        <a href="" class="website"><li>Music</li></a>
                                    @empty
                                        <div class="website empty"><li>No websites to show</li></div>
                                    @endforelse
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
        </div>

        {{-- Scripts --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        @yield('scripts')
    </body>
</html>
