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
                    <form method="POST">
                        <input class="btn custom-btn update-btn" onclick="deploy()">Deploy</input>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection




{{--exec( 'cd ' . $environment . $domain . '; git pull origin master 2>&1', $output);--}}
{{--//        exec( 'cd ' . $environment . $domain . '; composer install', $output);--}}
{{--//        exec( 'cd ' . $environment . $domain . '; npm i install', $output);--}}
{{--exec( 'cd ' . $environment . $domain . '; php artisan migrate', $output);--}}
{{--exec( 'cd ' . $environment . $domain . '; php artisan config:cache', $output);--}}
{{--exec( 'cd ' . $environment . $domain . '; php artisan route:cache ', $output);--}}