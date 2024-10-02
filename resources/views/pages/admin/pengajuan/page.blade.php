<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Pengajuan</h4>
                    <span>data pengajuan</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Pengajuan</a></li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('pengajuan.buat') }}" class="btn btn-primary">Buat</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="align-middle">No</th>
                                        <th class="align-middle" style="min-width: 12.5rem;">Nama Pasien</th>
                                        <th class="align-middle pr-7">Jenis Kelamin</th>
                                        <th class="align-middle text-right">Umur</th>
                                        <th class="align-middle text-right">Rumah Sakit</th>
                                        <th class="align-middle text-right">Jenis Rawat</th>
                                        <th class="align-middle text-right">Status</th>
                                        <th class="align-middle">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="orders">
                                    @php
                                    $no = 1;

                                    @endphp
                                    @foreach ($pasien as $row)
                                    {{-- @dd($row) --}}
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->nama_pasien }}</td>
                                        <td>{{ $row->jenis_kelamin }}</td>
                                        <td>{{ $row->tanggal_lahir->isoFormat('D MMMM Y') }}</td>
                                        <td>{{ $row->rumahsakit->nama }}</td>
                                        <td>{{ $row->jenis_rawat }}</td>
                                        <td>
                                            @if ($row->status == 'Diterima')
                                            <a href="{{ route('jamkesda.download.diterima', ['id' => $row->pasien_id]) }}"
                                                class="btn btn-success" target="_blank">{{ $row->status }}</a>
                                            {{-- <button class="btn btn-success">{{ $row->status }}</button> --}}
                                            @elseif ($row->status == 'Ditolak')
                                            <button class="btn btn-danger">{{ $row->status }}</button>

                                            @elseif ($row->status == 'Dikembalikan')
                                            <button class="btn btn-secondary">{{ $row->status }}</button>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-secondary mt-1" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $row->pasien_id }}">Lihat
                                                Keterangan</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter{{ $row->pasien_id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Keterangan</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $row->keterangan_status }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger light"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @else
                                            <button class="btn btn-secondary">{{ $row->status }}</button>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($row->status == 'Draft')
                                                <form
                                                    action="{{ route('pengajuan.destroy', ['id' => $row->pasien_id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" href="" class="btn btn-danger"
                                                        onclick="return confirm('apakah anda yakin ingin menghapus data?')">Hapus</button>
                                                </form>
                                                <a href="#" class="btn btn-success mx-2"
                                                    onclick="submitPengajuan(event, '{{ route('pengajuan.ajukan', ['id' => $row->pasien_id]) }}')">Ajukan</a>
                                                @elseif ($row->status == 'Ditolak')
                                                <form
                                                    action="{{ route('pengajuan.destroy', ['id' => $row->pasien_id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" href="" class="btn btn-danger mx-2"
                                                        onclick="return confirm('apakah anda yakin ingin menghapus data?')">Hapus</button>
                                                </form>
                                                @elseif ($row->status == 'Dikembalikan')
                                                <a href="{{ route('pengajuan.getUpdate', ['id' => $row->pasien_id]) }}"
                                                    class="btn btn-success  mx-2">Ajukan Ulang</a>
                                                @endif
                                                <a href="{{ route('pengajuan.lihat', ['id' => $row->pasien_id]) }}"
                                                    class="btn btn-primary">Lihat</a>
                                            </div>
                                            {{-- <a href="{{ route('pengajuan.download', ['id' => $row->pasien_id]) }}"
                                                class="badge badge-warning text-white my-2 py-2"
                                                target="_blank">Download Tanda Terima</a> --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        (function($) {
                "use strict"
                //example 1
                var table = $('#example').DataTable();
            })(jQuery);

            function submitPengajuan(event, url) {
        event.preventDefault(); // Mencegah tindakan default dari elemen <a>
        
        // Menggunakan fetch API untuk mengirim pengajuan
        fetch(url, {
            method: 'GET', // Ubah metode ini sesuai dengan metode HTTP yang Anda gunakan (GET, POST, dll)
            headers: {
                'Content-Type': 'application/json',
                // Tambahkan header lain jika diperlukan
            },
        })
        .then(response => {
            if (response.ok) {
                // Jika pengajuan berhasil, buka halaman survei di tab baru
                window.open('https://bit.ly/SurveiDinkesKotaBogor', '_blank');
                 // Refresh the current page after opening the new tab
                window.location.reload();
            } else {
                // Jika pengajuan gagal, tampilkan pesan kesalahan
                alert('Pengajuan gagal. Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }
    </script>

    @endpush
</x-app-layout>