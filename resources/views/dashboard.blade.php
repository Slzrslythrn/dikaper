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
                            Persyaratan Jamkesda
                            </h3>
                    </div>
                    <div class="card-body ">
                        <p>Sasaran melampirkan berkas persyaratan sebagai berikut : </p>
                        <ul>
                            <li>a. Persyaratan Rawat Jalan Tingkat Lanjut (RJTL) bagi pengguna Surat Keterangan Tidak
                                Mampu (SKTM) untuk mendapatkan pelayanan kesehatan adalah sebagai berikut:</li>
                            <li class="mx-5 mb-3">
                                <ul>
                                    <li>1. Sasaran mengurus Surat Jaminan Pelayanan (SJP) sebelum berobat ke Fasilitas
                                        Pelayanan;</li>
                                    <li>2. SKTM dari kelurahan, masa berlaku SKTM adalah 1 bulan;</li>
                                    <li>3. Fotokopi KK Kota Bogor;</li>
                                    <li>4. Fotokopi KTP Kota Bogor;</li>
                                    <li>5. Surat Rujukan dari Puskesmas ke Rumah Sakit Strata II (diagnosis, nama
                                        dokter, tandatangan dokter, cap Puskesmas); </li>
                                    <li>6. SJP dari Dinas Kesehatan.</li>
                                </ul>
                            </li>
                            <li>b. Persyaratan Rawat Inap Tingkat Lanjut (RITL) bagi pengguna Jamkesda untuk mendapatkan
                                pelayanan kesehatan adalah sebagai berikut:</li>
                            <li class="mx-5 mb-3">
                                <ul>
                                    <li>1. Sasaran diberikan waktu paling lama 5 x 24 jam hari kerja sejak masuk atau
                                        sebelum pulang dari RS untuk mengurus dan mendapatkan Surat Jaminan Pelayanan
                                        (SJP) dari Dinas Kesehatan, kecuali pada kasus KLB yang disesuaikan dengan
                                        kondisi di lapangan;</li>
                                    <li>2. SKTM dari kelurahan. Masa berlaku SKTM adalah 1 bulan;</li>
                                    <li>3. Fotokopi KK Kota Bogor;</li>
                                    <li>3. Fotokopi KK Kota Bogor;</li>
                                    <li>5. Surat Rujukan dari Puskesmas ke Rumah Sakit Rujukan atau Surat Rujukan antar
                                        RS atau Surat Keterangan Instalasi Gawat Darurat (IGD) dari Rumah Sakit pada
                                        kasus gawat darurat yang memuat informasi diagnosis, nama dokter, tandatangan
                                        dokter, cap RS;</li>
                                    <li>6. Surat Keterangan Rawat Inap dari Rumah Sakit yang memuat informasi kelas
                                        III/kelas khusus, nama ruangan, nama dokter, tanda tangan dokter, cap RS;</li>
                                    <li>7. Persetujuan penjaminan SKTM dari Rumah Sakit yang memuat informasi nama,
                                        tanda tangan, cap RS;</li>
                                    <li>8. Bukti pendaftaran BPJS Kesehatan bagi pasien yang belum terdaftar sebagai
                                        peserta aktif JKN; </li>
                                    <li>9. Surat Jaminan Pelayanan (SJP) dari Dinas Kesehatan. </li>
                                </ul>
                            </li>
                            <li>c. Tambahan persyaratan poin a dan b pada kondisi khusus yaitu: </li>
                            <li class="mx-5 mb-3">
                                <ul>
                                    <li>1. Diagnosa akibat kekerasan: </br>
                                        <span class="mx-3"> Surat Tanda Bukti Lapor dari Kepolisian</span>
                                    </li>
                                    <li>2. PPKS atau PMKS: </br>
                                        <span class="mx-3"> Surat Keterangan dari Kelurahan/Surat Rujukan dari
                                            Puskesmas/Surat Keterangan
                                            dari Kepolisian dan Surat Keterangan dari Dinas Sosial.</span>

                                    </li>
                                    <li>
                                        3. Bencana / wabah / krisis Kesehatan: </br>
                                        <span class="mx-3"> Surat Keterangan dari Kelurahan </span>

                                    </li>
                                    <li>4. Efek samping akibat tindakan medis: </br>
                                        <span class="mx-3"> Resume Medis </span>
                                    </li>
                                    <li>
                                        5. Bayi baru lahir: </br>
                                        <span class="mx-3"> Surat Kelahiran dari RS atau Bidan</span>

                                    </li>
                                    <li>6. Pelayanan di luar paket INA-CBG’s/FORNAS: </br>
                                        <span class="mx-3"> Surat Pernyataan dari Ketua Komite Medik/Direktur</span>
                                    </li>
                                </ul>
                            </li>
                            <li>d. Persyaratan pemeriksaan laboratorium yang tidak dijamin JKN:</li>
                            <li class="mx-5 mb-3">
                                <ul>
                                    <li>1. SKTM dari kelurahan. Masa berlaku SKTM adalah 1 bulan;</li>
                                    <li>2. Fotokopi KK Kota Bogor;</li>
                                    <li>3. Fotokopi KTP Kota Bogor pada pasien dewasa;</li>
                                    <li>4. Fotokopi Surat Pengantar Laboratorium dari RS;</li>
                                    <li>5. Surat Jaminan Pelayanan (SJP) dari Dinas Kesehatan.</li>
                                </ul>
                            </li>
                        </ul>
                        {{-- <p>Pastikan semua dokumen diunggah secara lengkap agar proses pengajuan dapat berjalan
                            dengan
                            lancar.</p> --}}
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

</x-app-layout>