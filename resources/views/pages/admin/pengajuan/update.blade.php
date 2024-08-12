<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Pengajuan </h4>
                    <span>Pengajuan Ulang</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Pengajuan</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('pengajuan.buat') }}">Buat</a></li>
                </ol>
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
                                    <span class="badge badge-primary badge-pill">1</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed active">
                                        <div class="text-white">
                                            <h6 class="my-0 text-white">Pengisian Formulir</h6>
                                            <small class="">Biodata</small>
                                        </div>
                                        <span class="text-white">1</span>
                                    </li>
                                    {{-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Pengisian Formulir</h6>
                                            <small class="text-muted">Diagnosa</small>
                                        </div>
                                        <span class="text-muted">2</span>
                                    </li> --}}
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Upload / Kirim File</h6>
                                            <small>upload file kelengkapan</small>
                                        </div>
                                        <span class="text-muted">2</span>
                                    </li>
                                </ul>

                                <div>
                                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted">Keterangan</span>
                                    </h4>
                                    <textarea rows="10" disabled readonly
                                        class="form-control">{{ $pasien->keterangan_status }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-8 order-md-1">
                                <form class="needs-validation" novalidate="" action="{{ route('pengajuan.tambah') }}"
                                    method="post">
                                    @csrf
                                    <input type="hidden" name="pasien_id" value="{{ $pasien->pasien_id  }}">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstName">No KTP (Kartu Tanda Penduduk)</label>
                                            <input type="text" name="no_ktp"
                                                class="form-control @error('no_ktp') is-invalid @enderror"
                                                id="firstName" placeholder="" value="{{ $pasien->no_ktp}}" required="">
                                            @error('no_ktp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lastName">No KK (Kartu Keluarga)</label>
                                            <input type="text" name="no_kk" value="{{  $pasien->no_kk }}"
                                                class="form-control @error('no_kk') is-invalid @enderror" id="lastName"
                                                placeholder="" required="" min="16" max="16">
                                            @error('no_kk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username">No SJP</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control @error('no_sjp') is-invalid @enderror" id="no_sjp"
                                                name="no_sjp" value="{{ $pasien->no_sjp }}">
                                            @error('va')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username">Nama Kepala Keluarga</label>
                                        <div class="input-group">
                                            <input type="text" name="nama_kepala" value="{{  $pasien->nama_kepala }}"
                                                class="form-control @error('nama_kepala') is-invalid @enderror"
                                                id="username" required="">
                                            @error('nama_kepala')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username">Nama Pasien</label>
                                        <div class="input-group">
                                            <input type="text" name="nama_pasien" value="{{  $pasien->nama_pasien }}"
                                                class="form-control @error('nama_pasien') is-invalid @enderror"
                                                id="username" required="">
                                            @error('nama_pasien')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="country">Jenis Kelamin</label>
                                        <select name="jenis_kelamin"
                                            class="d-block w-100 form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="country" required="">
                                            <option value="">Pilih...</option>
                                            <option value="Laki-Laki" {{ $pasien->
                                                jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                                Laki - Laki</option>
                                            <option value="Perempuan" {{ $pasien->
                                                jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="username">Tempat Lahir</label>
                                            <div class="input-group">
                                                <input type="text" name="tempat_lahir"
                                                    value="{{ $pasien->tempat_lahir }}"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    id="username" required="">
                                                @error('tempat_lahir')
                                                <div class="invalid-feedback" style="width: 100%;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="username">Tanggal Lahir</label>
                                            <div class="input-group">
                                                <input type="date" name="tanggal_lahir"
                                                    value="{{ date('Y-m-d', strtotime($pasien->tanggal_lahir)) }}"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    id="username" required="">
                                                @error('tanggal_lahir')
                                                <div class="invalid-feedback" style="width: 100%;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="username">Kelurahan</label>
                                            <select name="kelurahan_id"
                                                class="js-example-basic-single d-block form-control @error('kelurahan_id') is-invalid @enderror"
                                                id="single-select" required="">
                                                <option value="">Pilih...</option>
                                                @foreach ($kelurahan as $kel)
                                                <option value="{{ $kel->kelurahan_id }}" {{ $pasien->kelurahan_id ==
                                                    $kel->kelurahan_id ?
                                                    'selected' : '' }}>
                                                    {{ $kel->kelurahan_nama }} |
                                                    {{ $kel->kecamatan->kecamatan_nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelurahan_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="username">Alamat</label>
                                            <div class="input-group">
                                                <input type="text" name="alamat" value="{{  $pasien->alamat }}"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    id="username" required="">
                                                @error('alamat')
                                                <div class="invalid-feedback" style="width: 100%;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username">Hubungan Dengan Keluarga</label>
                                        <div class="input-group">
                                            <select name="hubungan_kk"
                                                class="d-block w-100 form-control @error('hubungan_kk') is-invalid @enderror"
                                                id="country" required="">
                                                <option value="">Pilih...</option>
                                                <option value="Kepala Keluarga" {{$pasien->hubungan_kk == 'Kepala
                                                    Keluarga' ? 'selected' : '' }}>
                                                    Kepala Keluarga</option>
                                                <option value="Istri / Suami" {{$pasien->hubungan_kk == 'Istri / Suami'
                                                    ? 'selected' : '' }}>
                                                    Istri / Suami</option>
                                                <option value="Anak / Cucu / Menantu" {{ $pasien->hubungan_kk
                                                    == 'Anak / Cucu / Menantu' ? 'selected' : '' }}>
                                                    Anak / Cucu / Menantu</option>
                                                <option value="Ayah / Ibu / Mertua" {{$pasien->hubungan_kk ==
                                                    'Ayah / Ibu / Mertua' ? 'selected' : '' }}>
                                                    Ayah / Ibu / Mertua</option>
                                            </select>
                                            @error('hubungan_kk')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="country">Keterangan Pasien Jamkesda</label>
                                        <select name="ket_jamkesda"
                                            class="d-block w-100 form-control @error('ket_jamkesda') is-invalid @enderror"
                                            id="country" required="">
                                            <option value="">Pilih...</option>
                                            <option value="kekerasan" {{ $pasien->
                                                ket_jamkesda == 'kekerasan' ? 'selected' : '' }}>
                                                Pasien Kekerasan</option>
                                            <option value="meninggal" {{ $pasien->
                                                ket_jamkesda == 'meninggal' ? 'selected' : '' }}>
                                                Pasien Meninggal</option>
                                            <option value="bencana" {{$pasien->
                                                ket_jamkesda == 'bencana' ? 'selected' : '' }}>
                                                Pasien Bencana</option>
                                            <option value="pmks" {{ $pasien->ket_jamkesda
                                                == 'pmks' ? 'selected' : '' }}>
                                                Pasien PMKS (Penyandang Masalah Kesejahteraan Sosial)</option>
                                        </select>
                                        @error('ket_jamkesda')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <hr class="mb-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Selanjutnya</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('after-styles')
    {{--
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $("#single-select").select2();
    </script> --}}
    <script>
        $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
    </script>
    @endpush
</x-app-layout>