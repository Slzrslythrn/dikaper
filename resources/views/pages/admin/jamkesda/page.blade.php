<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Jamkesda</h4>
                    <span>data jamkesda tahun</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('jamkesda') }}">Jamkesda</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('jamkesda.tambah') }}" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th class="align-middle">No</th>
                                        <th class="align-middle" style="min-width: 12.5rem;">Nama Pasien</th>
                                        <th class="align-middle pr-7">Jenis Kelamin</th>
                                        <th class="align-middle text-left">Tanggal Lahir</th>
                                        <th class="align-middle text-left">Tahun Diterima</th>
                                        <th class="align-middle text-left">Rumah Sakit</th>
                                        <th class="align-middle text-left">Jenis Rawat</th>
                                        <th class="align-middle text-left">Status</th>
                                        <th class="align-middle">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="orders">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pasien as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->nama_pasien }}</td>
                                            <td>{{ $row->jenis_kelamin }}</td>
                                            <td>{{ $row->tanggal_lahir->isoFormat('D MMM Y') }}</td>
                                            <td>{{ $row->tgl_diterima}}</td>
                                            <td>{{ $row->rumahsakit ? $row->rumahsakit->nama : '' }}</td>
                                            <td>{{ $row->jenis_rawat }}</td>
                                            <td>{{ $row->status }}</td>
                                            <td>
                                                <a href="{{ route('jamkesda.lihat', ['id' => $row->pasien_id]) }}"
                                                    class="btn btn-primary">Lihat</a>
                                                <form action="{{ route('jamkesda.destroy', ['id' => $row->pasien_id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger mt-2"
                                                        onclick="return confirm('apakah anda yakin ingin menghapus data?')">Hapus Data</button>
                                                </form>
                                            </td>
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
        <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <!-- Custom Stylesheet -->
        <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    @endpush

    @push('after-scripts')
        <!-- Datatable -->
        <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script>
            (function($) {
                "use strict"
                //example 1
                var table = $('#example').DataTable();
            })(jQuery);
        </script>
    @endpush
</x-app-layout>
