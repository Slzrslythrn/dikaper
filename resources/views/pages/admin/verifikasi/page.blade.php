<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Verifikasi</h4>
                    <span>data verifikasi</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('verifikasi') }}">verifikasi</a></li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('verifikasi.getBuatBap') }}" class="btn btn-primary">Buat</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="align-middle">No</th>
                                        <th class="align-middle ">Rumah Sakit</th>
                                        <th class="align-middle ">Tanggal</th>
                                        <th class="align-middle ">Draft BAP</th>
                                        <th class="align-middle">BAP</th>
                                        @if (Auth::user()->level == 'superadmin' || Auth::user()->level == 'admin')
                                        <th class="align-middle">Aksi</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody id="orders">
                                    @php
                                    $no = 1;

                                    @endphp
                                    @foreach ($bap as $row)
                                    {{-- @dd($row) --}}
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->rumahsakit->nama }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->tanggal))}}</td>
                                        <td><a href="{{ asset('uploads/draft_bap/' . $row->draft_bap) }}"
                                                target="_blank" class="btn btn-secondary">File Draft
                                                BAP</a>
                                        </td>
                                        <td>
                                            @if ($row->bap)
                                            <a href="{{ asset('uploads/bap/' . $row->bap) }}" target="_blank"
                                                class="btn btn-primary">File BAP</a>
                                            @else
                                            <div class="btn btn-danger">Kosong</div>
                                            @endif
                                        </td>
                                        @if (Auth::user()->level == 'superadmin' || Auth::user()->level == 'admin')
                                        <td>
                                            <a href="{{  route('verifikasi.getVerifBap', ['bapId' => $row->id])}}"
                                                class="btn btn-success">Verifikasi</a>
                                        </td>
                                        @endif


                                        {{-- <td>{{ $row->tanggal_lahir->isoFormat('D MMMM Y') }}</td> --}}
                                        {{-- <td>{{ $row->jenis_rawat }}</td> --}}

                                        {{-- <td>
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

                                        </td> --}}
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

    {{--
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
    </script> --}}

    @endpush
</x-app-layout>