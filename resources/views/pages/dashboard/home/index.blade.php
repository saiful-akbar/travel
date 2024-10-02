<x-layout.dashboard title="Home">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-sm-center mb-4">
                <div class="col-12 mb-3">
                    <div class="d-flex align-items-center">
                        <span class="h1 mb-0">Grafik Pesanan {{ date('Y') }}</span>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row font-size-sm">
                        <div class="col-auto">
                            <span class="legend-indicator bg-secondary"></span> Menunggu Pembayaran
                        </div>
                        <div class="col-auto">
                            <span class="legend-indicator bg-info"></span> Dibayar (Menunggu Konfirmasi)
                        </div>
                        <div class="col-auto">
                            <span class="legend-indicator bg-primary"></span> Dikonfirmasi
                        </div>
                        <div class="col-auto">
                            <span class="legend-indicator bg-success"></span> Selesai
                        </div>
                        <div class="col-auto">
                            <span class="legend-indicator bg-danger"></span> Dibatalkan
                        </div>
                    </div>
                    <!-- End Legend Indicators -->
                </div>
            </div>

            <!-- Line Chart -->
            
            <div class="chartjs-custom" style="height: 18rem;">
                <canvas id="project" class="js-chart"
                    data-hs-chartjs-options='{
                        "type": "line",
                        "data": {
                            "labels": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            "datasets": [
                                {
                                    "data": [{{ implode(',', $data[0]['value']) }}],
                                    "backgroundColor": "transparent",
                                    "borderColor": "#6D747B",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "hoverBorderColor": "#6D747B",
                                    "pointBackgroundColor": "#6D747B",
                                    "pointBorderColor": "#fff",
                                    "pointHoverRadius": 0,
                                    "tension": 0.4
                                },
                                {
                                    "data": [{{ implode(',', $data[1]['value']) }}],
                                    "backgroundColor": "transparent",
                                    "borderColor": "#09A5BE",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "hoverBorderColor": "#09A5BE",
                                    "pointBackgroundColor": "#09A5BE",
                                    "pointBorderColor": "#fff",
                                    "pointHoverRadius": 0,
                                    "tension": 0.4
                                },
                                {
                                    "data": [{{ implode(',', $data[2]['value']) }}],
                                    "backgroundColor": "transparent",
                                    "borderColor": "#377DFF",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "hoverBorderColor": "#377DFF",
                                    "pointBackgroundColor": "#377DFF",
                                    "pointBorderColor": "#fff",
                                    "pointHoverRadius": 0,
                                    "tension": 0.4
                                },
                                {
                                    "data": [{{ implode(',', $data[3]['value']) }}],
                                    "backgroundColor": "transparent",
                                    "borderColor": "#00C9A7",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "hoverBorderColor": "#00C9A7",
                                    "pointBackgroundColor": "#00C9A7",
                                    "pointBorderColor": "#fff",
                                    "pointHoverRadius": 0,
                                    "tension": 0.4
                                },
                                {
                                    "data": [{{ implode(',', $data[3]['value']) }}],
                                    "backgroundColor": "transparent",
                                    "borderColor": "#ED4C78",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "hoverBorderColor": "#ED4C78",
                                    "pointBackgroundColor": "#ED4C78",
                                    "pointBorderColor": "#fff",
                                    "pointHoverRadius": 0,
                                    "tension": 0.4
                                }
                            ]
                        },
                        "options": {
                            "scales": {
                                "y": {
                                    "grid": {
                                        "color": "#e7eaf3",
                                        "drawBorder": false,
                                        "zeroLineColor": "#e7eaf3"
                                    },
                                    "ticks": {
                                        "min": 0,
                                        "max": 100,
                                        "stepSize": 20,
                                        "color": "#97a4af",
                                        "font": {
                                            "family": "Open Sans, sans-serif"
                                        },
                                        "padding": 10,
                                        "postfix": "k"
                                    }
                                },
                                "x": {
                                    "grid": {
                                        "display": false,
                                        "drawBorder": false
                                    },
                                    "ticks": {
                                        "color": "#97a4af",
                                        "font": {
                                        "size": 12,
                                            "family": "Open Sans, sans-serif"
                                        },
                                        "padding": 5
                                    }
                                }
                            },
                            "plugins": {
                                "tooltip": {
                                    "hasIndicator": true,
                                    "mode": "index",
                                    "intersect": false,
                                    "lineMode": true,
                                    "lineWithLineColor": "rgba(19, 33, 68, 0.075)"
                                }
                            },
                            "hover": {
                                "mode": "nearest",
                                "intersect": true
                            }
                        }
                    }'
                ></canvas>
            </div>
        </div>
    </div>
</x-layout.dashboard>
