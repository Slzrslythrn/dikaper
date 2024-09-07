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
            @if (auth()->user()->level == 'user' || auth()->user()->level == 'rumahsakit')
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <div class="card bg-primary">
                    <div class="card-body d-flex align-items-center">
                        <div class="new-arrival-product">
                            <div class="new-arrival-content">
                                <h4 class="text-white">Pengajuan Baru</h4>
                                <a href="{{ route('pengajuan.buat') }}" class="btn btn-secondary shadow-lg">BUAT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <div class="card bg-success">
                    <div class="card-body d-flex align-items-center">
                        <div class="new-arrival-product ">
                            <div class="new-arrival-content ">
                                <h4 class="text-white">Data Pengajuan</h4>
                                <a href="{{ route('pengajuan') }}" class="btn btn-secondary shadow-lg">LIHAT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card bg-white">
                    <div class="card-header">
                        <h5>
                            Informasi Data Pengajuan
                            </h3>
                    </div>
                    <div class="card-body d-flex  justify-content-around">
                        <div>
                            <table>
                                <tr>
                                    <th>Jumlah Pengajuan</th>
                                    <td class="px-3">:</td>
                                    <td>{{ $totalPasien }}</td>
                                </tr>
                                <tr>
                                    <th>Pengajuan Diterima</th>
                                    <td class="px-3">:</td>
                                    <td>{{ $totalDiterima }}</td>
                                </tr>
                                <tr>
                                    <th>Pengajuan Ditolak</th>
                                    <td class="px-3">:</td>
                                    <td>{{ $totalDitolak }}</td>
                                </tr>

                            </table>
                        </div>
                        <div>
                            <table>
                                <tr>
                                    <th>Pengajuan Dikembalikan</th>
                                    <td class="px-3">:</td>
                                    <td>{{ $totalDikembalikan }}</td>
                                </tr>
                                <tr>
                                    <th>Pengajuan Diproses</th>
                                    <td class="px-3">:</td>
                                    <td>{{ $totalDiproses }}</td>
                                </tr>
                                <tr>
                                    <th>Pengajuan Draft</th>
                                    <td class="px-3">:</td>
                                    <td>{{ $totalDraft }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card bg-white">
                    <div class="card-header">
                        <h5>
                            Syarat Penjaminan Pengajuan Baru
                            </h3>
                    </div>
                    <div class="card-body ">
                        <p>Untuk mengajukan penjaminan, pastikan Anda telah melengkapi dokumen-dokumen berikut:</p>
                        <ul>
                            <li>1. KTP dan Kartu Keluarga (KK)</li>
                            <li>2. SKTM/DINSOS dan Surat Kepolisian</li>
                            <li>3. Surat dari Rumah Sakit (IGD, RANAP, dan ACC RS)</li>
                        </ul>
                        <p>Pastikan semua dokumen diunggah secara lengkap agar proses pengajuan dapat berjalan dengan
                            lancar.</p>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

</x-app-layout>