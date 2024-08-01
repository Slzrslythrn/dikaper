<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Pasien</h4>
                    <span>data pasien jamkesda sebelumnya</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('pasien') }}">Data Jamkesda Sebelumnya</a></li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th class="align-middle">
                                            No
                                        </th>
                                        <th class="align-middle">Tanggal</th>
                                        <th class="align-middle pr-7">Nama</th>
                                        <th class="align-middle" style="min-width: 12.5rem;">Alamat</th>
                                        <th class="align-middle text-right">NIK</th>
                                        <th class="align-middle text-right">Tanggal Lahir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jaminan as $no => $row)
                                        <tr>
                                            <td>{{ $no++ + 1 }}</td>
                                            <td>{{ $row->bulan . ' - ' . $row->bulan . ' - ' . $row->tahun }} </td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>{{ $row->no_ktp }}</td>
                                            <td>{{ $row->tgl_lahir }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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

                table.on('click', 'tbody tr', function() {
                    var $row = table.row(this).nodes().to$();
                    var hasClass = $row.hasClass('selected');
                    if (hasClass) {
                        $row.removeClass('selected')
                    } else {
                        $row.addClass('selected')
                    }
                })

                table.rows().every(function() {
                    this.nodes().to$().removeClass('selected')
                });



                //example 2
                var table2 = $('#example2').DataTable({
                    createdRow: function(row, data, index) {
                        $(row).addClass('selected')
                    },

                    "scrollY": "42vh",
                    "scrollCollapse": true,
                    "paging": false
                });

                table2.on('click', 'tbody tr', function() {
                    var $row = table2.row(this).nodes().to$();
                    var hasClass = $row.hasClass('selected');
                    if (hasClass) {
                        $row.removeClass('selected')
                    } else {
                        $row.addClass('selected')
                    }
                })

                table2.rows().every(function() {
                    this.nodes().to$().removeClass('selected')
                });

                //
                var table = $('#example3, #example4, #example5').DataTable();
                $('#example tbody').on('click', 'tr', function() {
                    var data = table.row(this).data();
                });

            })(jQuery);
        </script>
    @endpush
</x-app-layout>
