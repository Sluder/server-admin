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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar">
                        <div class="header">
                            <p>
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                <a href="{{ route('home') }}">Admin Panel</a>
                            </p>
                        </div>
                        <div class="navigation">
                            <a href="{{ route('server') }}">
                                <div class="row link">
                                    <i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Hosting Server
                                </div>
                            </a>
                            <a href="{{ route('server') }}">
                                <div class="row link">
                                    <i class="fa fa-desktop" aria-hidden="true"></i> Websites
                                </div>
                            </a>
                            <div class="website-list">
                                @forelse (\App\Website::all() as $website)
                                    <a href="{{ route('website', ['website' => $website->id]) }}">
                                        <div class="row website">
                                            {{ $website->name }}
                                        </div>
                                    </a>
                                @empty
                                    <div class="row empty">
                                        No websites to show
                                    </div>
                                @endforelse
                            </div>
                        </div>
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
