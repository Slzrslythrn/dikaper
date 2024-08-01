<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Pengajuan</h4>
                    <span>buat pengajuan baru</span>
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
                            <div class="col-md-12 order-md-1">
                                <form class="needs-validation" novalidate="" action="{{ route('jamkesda.buat') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstName">No KTP (Kartu Tanda Penduduk)</label>
                                            <input type="text" name="no_ktp"
                                                class="form-control @error('no_ktp') is-invalid @enderror"
                                                id="firstName" placeholder="" value="{{ old('no_ktp') }}"
                                                required="">
                                            @error('no_ktp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lastName">No KK (Kartu Keluarga)</label>
                                            <input type="text" name="no_kk" value="{{ old('no_kk') }}"
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
                                        <label for="username">Nama Kepala Keluarga</label>
                                        <div class="input-group">
                                            <input type="text" name="nama_kepala" value="{{ old('nama_kepala') }}"
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
                                            <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}"
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
                                            <option value="Laki-Laki"
                                                {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                                Laki - Laki</option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
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
                                                    value="{{ old('tempat_lahir') }}"
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
                                                    value="{{ old('tanggal_lahir') }}"
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
                                                    <option value="{{ $kel->kelurahan_id }}"
                                                        {{ old('kelurahan_id') == $kel->kelurahan_id ? 'selected' : '' }}>
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
                                                <input type="text" name="alamat" value="{{ old('alamat') }}"
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
                                                <option value="Kepala Keluarga"
                                                    {{ old('hubungan_kk') == 'Kepala Keluarga' ? 'selected' : '' }}>
                                                    Kepala Keluarga</option>
                                                <option value="Istri / Suami"
                                                    {{ old('hubungan_kk') == 'Istri / Suami' ? 'selected' : '' }}>
                                                    Istri / Suami</option>
                                                <option value="Anak / Cucu / Menantu"
                                                    {{ old('hubungan_kk') == 'Anak / Cucu / Menantu' ? 'selected' : '' }}>
                                                    Anak / Cucu / Menantu</option>
                                                <option value="Ayah / Ibu / Mertua"
                                                    {{ old('hubungan_kk') == 'Ayah / Ibu / Mertua' ? 'selected' : '' }}>
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
                                            <option value="kekerasan"
                                                {{ old('ket_jamkesda') == 'kekerasan' ? 'selected' : '' }}>
                                                Pasien Kekerasan</option>
                                            <option value="meninggal"
                                                {{ old('ket_jamkesda') == 'meninggal' ? 'selected' : '' }}>
                                                Pasien Meninggal</option>
                                            <option value="bencana"
                                                {{ old('ket_jamkesda') == 'bencana' ? 'selected' : '' }}>
                                                Pasien Bencana</option>
                                            <option value="pmks"
                                                {{ old('ket_jamkesda') == 'pmks' ? 'selected' : '' }}>
                                                Pasien PMKS (Penyandang Masalah Kesejahteraan Sosial)</option>
                                        </select>
                                        @error('ket_jamkesda')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="ktp_kk">KTP dan Kartu Keluarga</label>
                                        <div class="input-group">
                                            <input type="file"
                                                   class="form-control @error('ktp_kk') is-invalid @enderror"
                                                   id="ktp_kk" name="ktp_kk[]" multiple>
                                            @error('ktp_kk')
                                                <div class="invalid-feedback" style="width: 100%;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    

                                    <div class="mb-3">
                                        <label for="username">Document Lainya </label>
                                        <div class="input-group">
                                            <input type="file"
                                                class="form-control @error('doc') is-invalid @enderror"
                                                id="doc" name="doc[]">
                                            @error('doc')
                                                <div class="invalid-feedback" style="width: 100%;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr class="mb-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('after-styles')
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}"> --}}
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