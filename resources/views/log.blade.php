<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 col-xxl-12">
                <div class="row">
                    @if (session()->get('status'))
                        <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                            <div class="card bg-primary overflow-hidden">
                                <div class="card-body pb-2 pt-2">
                                    <div class="row">
                                        <div class="col text-white">
                                            <h1 class="text-white">{{ session()->get('status') }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Log Aktifitas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th><strong>NO.</strong></th>
                                        <th><strong>Aktivitas</strong></th>
                                        <th><strong>Waktu</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $log->aktivitas }}</td>
                                            <td>{{ $log->waktu->isoFormat('D MMMM Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if (auth()->user()->level != 'user')
                <div class="col-xl-6 col-xxl-12 col-lg-12 col-md-12">
                    <div id="user-activity" class="card">
                        <div class="card-header border-0 pb-0 d-sm-flex d-block">
                            <div>
                                <h4 class="card-title">Grafik</h4>
                                <p class="mb-1">Pengajuan Jamkesda</p>
                            </div>
                            <div class="card-action">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#user" role="tab">
                                            Draft
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#bounce" role="tab">
                                            Diproses
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#session-duration" role="tab">
                                            Diterima
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#session-duration" role="tab">
                                            Ditolak
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="user" role="tabpanel">
                                    <canvas id="activitys" class="chartjs"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('before-styles')
        <!-- Datatable -->
        <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @endpush

    @push('after-scripts')
        <!-- Datatable -->
        <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script>
            (function($) {
                "use strict"
                //example 1
                var table = $('#example').DataTable({
                    createdRow: function(row, data, index) {
                        $(row).addClass('selected')
                    }
                });

                var activity = document.getElementById("activitys");
                if (activity !== null) {
                    var dataDraft = [
                        @foreach ($draft as $dr)
                            {{ $dr->count }},
                        @endforeach
                    ]
                    var dataDiproses = [
                        @foreach ($proses as $pr)
                            {{ $pr->count }},
                        @endforeach
                    ]
                    var dataDiterima = [
                        @foreach ($diterima as $dt)
                            {{ $dt->count }},
                        @endforeach
                    ]
                    var dataDitolak = [
                        @foreach ($ditolak as $dto)
                            {{ $dto->count }},
                        @endforeach
                    ]

                    var namaDraft = [
                        @foreach ($draft as $dr)
                            "{{ $dr->rumahsakit->nama ?? 'Rumah Sakit Tidak Diketahui' }}",
                        @endforeach
                    ]
                    var namaDiproses = [
                        @foreach ($proses as $pr)
                            "{{ $pr->rumahsakit->nama ?? 'Rumah Sakit Tidak Diketahui' }}",
                        @endforeach
                    ]
                    var namaDiterima = [
                        @foreach ($diterima as $dt)
                            "{{ $dt->rumahsakit->nama ?? 'Rumah Sakit Tidak Diketahui' }}",
                        @endforeach
                    ]
                    var namaDitolak = [
                        @foreach ($ditolak as $dto)
                            "{{ $dto->rumahsakit->nama ?? 'Rumah Sakit Tidak Diketahui' }}",
                        @endforeach
                    ]

                    var activityData = [{
                            first: dataDraft
                        },
                        {
                            first: dataDiproses
                        },
                        {
                            first: dataDiterima
                        },
                        {
                            first: dataDitolak
                        }
                    ];
                    var activityNama = [{
                            first: namaDraft
                        },
                        {
                            first: namaDiproses
                        },
                        {
                            first: namaDiterima
                        },
                        {
                            first: namaDitolak
                        }
                    ];
                    activity.height = 300;

                    var config = {
                        type: "bar",
                        data: {
                            labels: namaDraft,
                            datasets: [{
                                label: "Jumlah",
                                data: dataDraft,
                                borderColor: 'rgba(26, 51, 213, 1)',
                                borderWidth: "0",
                                backgroundColor: 'rgba(58, 122, 254, 1)'

                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,

                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    gridLines: {
                                        color: "rgba(89, 59, 219,0.1)",
                                        drawBorder: true
                                    },
                                    ticks: {
                                        fontColor: "#999",
                                    },
                                }],
                                xAxes: [{
                                    gridLines: {
                                        display: false,
                                        zeroLineColor: "transparent"
                                    },
                                    ticks: {
                                        stepSize: 5,
                                        fontColor: "#999",
                                        fontFamily: "Nunito, sans-serif"
                                    }
                                }]
                            },
                            tooltips: {
                                mode: "index",
                                intersect: false,
                                titleFontColor: "#888",
                                bodyFontColor: "#555",
                                titleFontSize: 12,
                                bodyFontSize: 15,
                                backgroundColor: "rgba(256,256,256,0.95)",
                                displayColors: true,
                                xPadding: 10,
                                yPadding: 7,
                                borderColor: "rgba(220, 220, 220, 0.9)",
                                borderWidth: 2,
                                caretSize: 6,
                                caretPadding: 10
                            }
                        }
                    };

                    var ctx = document.getElementById("activitys").getContext("2d");
                    var myLine = new Chart(ctx, config);

                    var items = document.querySelectorAll("#user-activity .nav-tabs .nav-item");
                    items.forEach(function(item, index) {
                        item.addEventListener("click", function() {
                            config.data.datasets[0].data = activityData[index].first;
                            config.data.labels = activityNama[index].first;
                            myLine.update();
                        });
                    });
                }

            })(jQuery);
        </script>
    @endpush
</x-app-layout>
