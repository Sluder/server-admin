@extends('layouts.base')

@section('content')
    <div class="website">
        <div class="details">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="sub-header">{{ $website->name }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <table class="info-table">
                        <tr>
                            <td class="info">Domain : </td>
                            <td class="info-data">{{ $website->domain }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="info-table">
                        <tr>
                            <td class="info">Last Updated : </td>
                            <td class="info-data">{{ $website->updated_at->diffForHumans() }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="deployment">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="sub-header">Deployment</h4>
                    <button class="btn custom-btn update-btn" onclick="deploy()">Deploy</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://js.pusher.com/3.1/pusher.min.js"></script>

    <script type="text/javascript">
        var pusher = new Pusher('4462fe93b06d03e412be', {
            cluster: 'us2',
            encrypted: true
        });

        var channel = pusher.subscribe('deploy-output');
        channel.bind('deploy-event', function(data) {
            alert(data);
            // append data to screen
        });

        function deploy()
        {
            $.ajax({
                type: 'GET',
                url: '/deploy',
                success: function(data) {

                }
            });
        }
    </script>
@endsection




{{--exec( 'cd ' . $environment . $domain . '; git pull origin master 2>&1', $output);--}}
{{--//        exec( 'cd ' . $environment . $domain . '; composer install', $output);--}}
{{--//        exec( 'cd ' . $environment . $domain . '; npm i install', $output);--}}
{{--exec( 'cd ' . $environment . $domain . '; php artisan migrate', $output);--}}
{{--exec( 'cd ' . $environment . $domain . '; php artisan config:cache', $output);--}}
{{--exec( 'cd ' . $environment . $domain . '; php artisan route:cache ', $output);--}}