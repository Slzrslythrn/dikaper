<x-app-layout>
    <div class="container-fluid">
        <script>
            function handleSubmitAndOpenTab(event) {
                event.preventDefault(); // Mencegah pengiriman form default
                
                const form = document.getElementById('myForm');
                const formData = new FormData(form);
                
                // Buat window baru tetapi jangan buka URL dulu
                const newWindow = window.open('', '_blank');
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (response.ok) {
                        // Jika pengiriman form berhasil, setel URL pada window baru
                        newWindow.location = 'https://bit.ly/SurveiDinkesKotaBogor';
                    } else {
                        // Tangani kesalahan pengiriman form
                        alert('Gagal menyimpan data.');
                        // Tutup window baru jika ada kesalahan
                        newWindow.close();
                    }
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data.');
                    // Tutup window baru jika ada kesalahan
                    newWindow.close();
                });
            }
        </script>
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">

                    @if ($pasien->status == 'Dikembalikan')
                    <h4>Form Update Pengajuan</h4>
                    <span>Buat pengajuan ulang</span>
                    @else
                    <h4>Form Pengajuan</h4>
                    <span>Buat pengajuan baru</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Pengajuan</a></li>
                    @if ($pasien->status == 'Dikembalikan')
                    <li class="breadcrumb-item active"><a
                            href="{{ route('pengajuan.getUpdate', ['id' => $pasien->pasien_id]) }}">Update</a></li>

                    @else
                    <li class="breadcrumb-item active"><a href="{{ route('pengajuan.buat') }}">Buat</a></li>
                    @endif
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-list-group">
                            <div class="list-group">
                                <a href="javascript:void(0)"
                                    class="list-group-item list-group-item-action flex-column align-items-start active">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-3 text-white">Detail Biodata</h5>
                                    </div>
                                    <p class="mb-1">
                                        <ul>
                                            <li>No KK : <b>{{ $pasien->no_kk }}</b></li>
                                            <li>No KTP : <b>{{ $pasien->no_ktp }}</b></li>
                                            <li>No SJP : <b>{{ $pasien->no_sjp}}</b></li>
                                            <li>Nama Kepala Keluarga : <b>{{ $pasien->nama_kepala }}</b></li>
                                            <li>Nama Pasien : <b>{{ $pasien->nama_pasien }}</b></li>
                                            <li>Jenis Kelamin : <b>{{ $pasien->jenis_kelamin }}</b></li>
                                            <li>Tempat Lahir : <b>{{ $pasien->tempat_lahir }}</b></li>
                                            <li>Tanggal Lahir :
                                                <b>{{ $pasien->tanggal_lahir->isoFormat('D MMMM Y') }}</b>
                                            </li>
                                            <li>Kelurahan : <b>{{ $pasien->kelurahan->kelurahan_nama }} |
                                                    {{ $pasien->kelurahan->kecamatan->kecamatan_nama }}</b></li>
                                            <li>Alamat : <b>{{ $pasien->alamat }}</b></li>
                                            <li>Hubungan Dengan Keluarga : <b>{{ $pasien->hubungan_kk }}</b></li>
                                        </ul>
                                    </p>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 order-md-2 mb-4">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Tahapan</span>
                                    <span class="badge badge-primary badge-pill">3</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Pengisian Formulir</h6>
                                            <small class="text-muted">Biodata</small>
                                        </div>
                                        <span class="text-muted">1</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Pengisian Formulir</h6>
                                            <small class="text-muted">Diagnosa</small>
                                        </div>
                                        <span class="text-muted">2</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed active">
                                        <div class="text-white">
                                            <h6 class="my-0 text-white">Upload / Kirim File</h6>
                                            <small>upload file kelengkapan</small>
                                        </div>
                                        <span class="text-white">3</span>
                                    </li>
                                </ul>

                                @if ($pasien->keterangan_status)

                                <div>
                                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted">Keterangan</span>
                                    </h4>
                                    <textarea rows="10" disabled readonly
                                        class="form-control">{{ $pasien->keterangan_status }}</textarea>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-8 order-md-1">
                                <form id="uploadForm" class="needs-validation" novalidate=""
                                    action="{{ route('pengajuan.tambah.upload') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="pasien_id" id="pasien_id"
                                        value="{{ $pasien->pasien_id }}">

                                    <div class="mb-3">
                                        <label for="username">KTP dan KK <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file"
                                                class="form-control @error('ktp_kk') is-invalid @enderror" id="ktp_kk"
                                                name="ktp_kk">
                                            @error('ktp_kk')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username">SKTM / DINSOS dan Surat Kepolisian <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('sktm') is-invalid @enderror"
                                                id="sktm" name="sktm">
                                            @error('sktm')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ktp_kk">Surat RS (IGD, RANAP dan ACC RS) <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('doc') is-invalid @enderror"
                                                id="doc" name="doc">
                                            @error('doc')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>



                                    {{-- <div class="mb-3">
                                        <label for="username">Surat Pernyataan</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="surat_pernyataan"
                                                name="surat_pernyataan">
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username">Surat Rekomendasi</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="rekomendasi" name="rekomendasi">
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username">Surat Rujukan Puskesmas</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="rujukan_pkm" name="rujukan_pkm">
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username">Surat Keterangan Rawat Inap</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="rawat_inap" name="rawat_inap">
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username">Surat Keterangan Tidak Mampu</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="sktm" name="sktm">
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username">KTP dan KK</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="ktp_kk" name="ktp_kk">
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username">Catatan Kepolisian/ Surat Kematian/ Surat Kelahiran/
                                            Surat Kronologis / Surat Dinsos</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="catatan" name="catatan">
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                        <span class="text-muted">Isi Jika Pasien Tidak Tercover oleh BPJS</span>
                                    </div> --}}

                                    <hr class="mb-4">
                                    <div class="d-flex">
                                        {{-- @if ($keterangan == 'Pengajuan Ulang')
                                        <a href="{{  route('pengajuan.getUpdate', ['id' => $pasien->pasien_id]) }}"
                                            class="btn btn-danger mx-2">Kembali</a>
                                        @else
                                        <a href="{{ route('pengajuan.diagnosa.tambah', ['id' => $pasien->pasien_id]) }}"
                                            class="btn btn-danger mx-2">Kembali</a>
                                        @endif --}}
                                        <a href="{{ route('pengajuan.diagnosa.tambah', ['id' => $pasien->pasien_id, 'ket' => 'baru']) }}"
                                            class="btn btn-danger mx-2">Kembali</a>
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Selesai</button>
                                    </div>
                                </form>

                                <!-- Form terpisah untuk survei -->
                                <form id="myForm" action="https://bit.ly/SurveiDinkesKotaBogor" method="POST"
                                    onsubmit="handleSubmitAndOpenTab(event)">
                                    <!-- Elemen input form Anda di sini -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>