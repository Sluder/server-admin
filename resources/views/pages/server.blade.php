@extends('layouts.base')

@section('content')
    <div class="server">
        <div class="details">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="sub-header">System</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <table class="info-table">
                        <tr>
                            <td class="info">OS : </td>
                            <td class="info-data">{{ $info['software']['distro'] }}</td>
                        </tr>
                        <tr>
                            <td class="info">CPU : </td>
                            <td class="info-data">{{ $info['hardware']['cpu'] }}</td>
                        </tr>
                        <tr>
                            <td class="info">Disk : </td>
                            <td class="info-data">{{ ($info['hardware']['disk_total'] - $info['hardware']['disk_free']) . "GB / " . $info['hardware']['disk_total'] . "GB" }} used</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="info-table">
                        <tr>
                            <td class="info">NGINX: </td>
                            <td class="info-data">{{ explode('/', $info['software']['webserver'])[1] }}</td>
                        </tr>
                        <tr>
                            <td class="info">PHP : </td>
                            <td class="info-data">{{ explode('-', $info['software']['php'])[0] }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="info-table">
                        <tr>
                            <td class="info">Last Reboot : </td>
                            <td class="info-data">
                                {{ date('M j, Y', strtotime($info['uptime']['booted_at'])) }}

                                {{-- Use form to prevent direct URL --}}
                                <form action="{{ route('server.reboot') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn custom-btn reboot-btn">Reboot</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="charts">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="sub-header">CPU Usage</h4>
                    <canvas id="cpu-canvas" class="chart" width="600" height="150"></canvas>
                </div>
                <div class="col-md-6">
                    <h4 class="sub-header">RAM Usage</h4>
                    <canvas id="ram-canvas" class="chart" width="600" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    <?php $cores = (int) shell_exec("cat /proc/cpuinfo | grep processor | wc -l"); ?>
@endsection

@section('scripts')
    <script type="text/javascript">
        // Default data (15 data points)
        var defaultLabels = ["", "", "", "", "", "", "", "", "", "", "", "", "", "", ""];
        var options = {
            animation : false,
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            scales: {
                xAxes : [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes : [{
                    ticks : {
                        fontColor: "#808080",
                        min : 0,
                        max : 100,
                        stepSize: 20
                    },
                    gridLines: {
                        display: true,
                        color: "#444444",
                        zeroLineColor: "#444444"
                    }
                }]
            },
            elements: {
                line: {
                    tension: 0
                }
            }
        };

        // CPU usage chart
        var cpuCtx = document.getElementById("cpu-canvas").getContext("2d");
        var cpuChart = new Chart(cpuCtx, {
            type: 'line',
            data: {
                labels: defaultLabels,
                datasets: [{
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    fill: false,
                    borderColor: "#f6a821",
                    pointRadius: 0
                }]
            },
            options: options
        });

        // RAM usage chart
        var ramCtx = document.getElementById("ram-canvas").getContext("2d");
        var ramChart = new Chart(ramCtx, {
            type: 'line',
            data: {
                labels: defaultLabels,
                datasets: [{
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    fill: false,
                    borderColor: "#f6a821",
                    pointRadius: 0
                }]
            },
            options: options
        });

        // Update loop for chart stats
        window.setInterval(function()
        {
            $.ajax({
                type: "GET",
                url: "/server/usage",
                success: function(stats){
                    cpuChart.data.datasets[0].data.shift();
                    cpuChart.data.datasets[0].data.push(stats['cpuUsage']);
                    ramChart.data.datasets[0].data.shift();
                    ramChart.data.datasets[0].data.push(stats['ramUsage']);
console.log(stats['ramUsage']);
                    ramChart.update();
                    cpuChart.update();
                }
            });
        }, 4000);
    </script>
@endsection