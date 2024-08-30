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
                                    <input type="hidden" name="pasien_id" value="{{ $pasien->pasien_id ?? null }}">
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
                                            <input type="text" name="no_kk" value="{{$pasien->no_kk }}"
                                                class="form-control @error('no_kk') is-invalid @enderror" id="lastName"
                                                placeholder="" required="" min="16" max="16">
                                            @error('no_kk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--
                                    <div class="mb-3">
                                        <label for="username">No SJP</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control @error('no_sjp') is-invalid @enderror" id="no_sjp"
                                                name="no_sjp" value="{{ $pasien->no_sjp }}">>
                                            @error('va')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="username">Nama Kepala Keluarga</label>
                                        <div class="input-group">
                                            <input type="text" name="nama_kepala" value="{{ $pasien->nama_kepala }}"
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
                                            <input type="text" name="nama_pasien" value="{{ $pasien->nama_pasien }}"
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
                                            <option value="Laki-Laki" {{ $pasien->jenis_kelamin == 'Laki-Laki' ?
                                                'selected'
                                                : '' }}>
                                                Laki - Laki</option>
                                            <option value="Perempuan" {{ $pasien->jenis_kelamin=='Perempuan' ?
                                                'selected'
                                                : '' }}>
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
                                                    $kel->kelurahan_id ? 'selected' : '' }}>
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
                                                <input type="text" name="alamat" value="{{ $pasien->alamat }}"
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
                                                <option value="Kepala Keluarga" {{ $pasien->hubungan_kk == 'Kepala
                                                    Keluarga'
                                                    ? 'selected' : '' }}>
                                                    Kepala Keluarga</option>
                                                <option value="Istri / Suami" {{$pasien->hubungan_kk == 'Istri / Suami'
                                                    ? 'selected' : '' }}>
                                                    Istri / Suami</option>
                                                <option value="Anak / Cucu / Menantu" {{ $pasien->hubungan_kk == 'Anak /
                                                    Cucu / Menantu' ? 'selected' : '' }}>
                                                    Anak / Cucu / Menantu</option>
                                                <option value="Ayah / Ibu / Mertua" {{ $pasien->hubungan_kk =='Ayah /
                                                    Ibu / Mertua' ? 'selected' : '' }}>
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
                                            <option value="kekerasan" {{ $pasien->ket_jamkesda =='kekerasan' ?
                                                'selected'
                                                : '' }}>
                                                Pasien Kekerasan</option>
                                            <option value="meninggal" {{ $pasien->ket_jamkesda =='meninggal' ?
                                                'selected'
                                                : '' }}>
                                                Pasien Meninggal</option>
                                            <option value="bencana" {{ $pasien->ket_jamkesda =='bencana' ? 'selected' :
                                                ''
                                                }}>
                                                Pasien Bencana</option>
                                            <option value="pmks" {{ $pasien->ket_jamkesda =='pmks' ? 'selected' : '' }}>
                                                Pasien PMKS (Penyandang Masalah Kesejahteraan Sosial)</option>
                                            <option value="lain-lain" {{ $pasien->
                                                ket_jamkesda == 'lain-lain' ? 'selected' : '' }}>
                                                Lain - lain</option>
                                        </select>
                                        @error('ket_jamkesda')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="country">Nama Puskesmas</label>
                                        <select class="d-block form-control @error('nama_pkm') is-invalid @enderror"
                                            name="nama_pkm">
                                            @foreach ($puskesmas as $pus)
                                            <option value="{{ $pus }}" {{ $pasien->nama_pkm == $pus ? 'selected' : ''
                                                }}>{{ $pus }}</option>
                                            @endforeach
                                        </select>
                                        @error('nama_pkm')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">No Rujuk</label>
                                        <input type="text" name="no_rujuk_igd"
                                            class="form-control @error('no_rujuk_igd') is-invalid @enderror"
                                            id="firstName" placeholder="" value="{{ $pasien->no_rujuk_igd}}">
                                        @error('no_rujuk_igd')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Diagnosa</label>
                                        <input type="text" name="diagnosa"
                                            class="form-control @error('diagnosa') is-invalid @enderror" id="firstName"
                                            placeholder="" value="{{ $pasien->diagnosa }}">
                                        @error('diagnosa')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="country">Rumah Sakit</label>
                                        <select class="d-block form-control @error('kode_rs') is-invalid @enderror"
                                            name="kode_rs">
                                            @foreach ($rumas as $rum)
                                            <option value="{{ $rum->kode }}" {{ $pasien->kode_rs == $rum->kode ?
                                                'selected' : '' }}>
                                                {{ $rum->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kode_rs')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Tanggal Mulai Rawat</label>
                                        <input type="date"
                                            class="form-control @error('tgl_mulairawat') is-invalid @enderror"
                                            name="tgl_mulairawat" value="{{ $pasien->tgl_mulairawat }}">
                                        @error('tgl_mulairawat')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="country">Jenis Rawat</label>
                                        <select
                                            class="d-block w-100 form-control @error('jenis_rawat') is-invalid @enderror"
                                            name="jenis_rawat">
                                            <option value="">Pilih...</option>
                                            <option value="Rawat Inap" {{ $pasien->jenis_rawat == 'Rawat Inap' ?
                                                'selected' : '' }}>Rawat Inap</option>
                                            <option value="Rawat Jalan" {{ $pasien->jenis_rawat == 'Rawat Jalan' ?
                                                'selected' : '' }}>Rawat Jalan</option>
                                        </select>
                                        @error('jenis_rawat')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Kelas Rawat</label>
                                        <input type="text" class="form-control @error('dikelas') is-invalid @enderror"
                                            name="dikelas" value="{{ $pasien->dikelas }}" />
                                        @error('dikelas')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Dijamin Sejak</label>
                                        <input type="date"
                                            class="form-control @error('dijamin_sejak') is-invalid @enderror"
                                            name="dijamin_sejak"
                                            value="{{ date('Y-m-d', strtotime($pasien->dijamin_sejak)) }}">
                                        @error('dijamin_sejak')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    {{-- <div class="mb-3">
                                        <label for="firstName">Tanggal Aktif VA BPJS</label>
                                        <input type="date"
                                            class="form-control @error('tgl_aktif_va') is-invalid @enderror"
                                            name="tgl_aktif_va" value="{{ $pasien->tgl_aktif_va }}">
                                        @error('tgl_aktif_va')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="firstName">Status kepesertaan JKN sebelumnya</label>
                                        {{-- <input type="text"
                                            class="form-control @error('status_kepersertaan') is-invalid @enderror"
                                            name="status_kepersertaan" value="{{ $pasien->status_kepersertaan }}"> --}}

                                        <select
                                            class="d-block w-100 form-control @error('status_kepersertaan') is-invalid @enderror"
                                            name="status_kepersertaan">
                                            <option value="">Pilih...</option>
                                            <option value="PBI APBN AKTIF" {{ $pasien->status_kepersertaan == 'PBI APBN
                                                AKTIF' ?
                                                'selected' : '' }}>PBI APBN AKTIF</option>

                                            <option value="PBI APBN NON AKTIF" {{ $pasien->status_kepersertaan == 'PBI
                                                APBN NON AKTIF' ?
                                                'selected' : '' }}>PBI APBN NON AKTIF</option>

                                            <option value="PBI APBD AKTIF" {{ $pasien->status_kepersertaan == 'PBI APBD
                                                AKTIF' ?
                                                'selected' : '' }}>PBI APBD AKTIF</option>

                                            <option value="PBI APBD NON AKTIF" {{ $pasien->status_kepersertaan == 'PBI
                                                APBD NON AKTIF' ?
                                                'selected' : '' }}>PBI APBD NON AKTIF</option>

                                            <option value="BPJS NON AKTIF/MENUNGGAK" {{ $pasien->status_kepersertaan ==
                                                'BPJS NON AKTIF/MENUNGGAK' ?
                                                'selected' : '' }}>BPJS NON AKTIF/MENUNGGAK</option>

                                            <option value="PENANGGUHAN PEMBAYARAAN" {{ $pasien->status_kepersertaan ==
                                                'PENANGGUHAN PEMBAYARAAN' ?
                                                'selected' : '' }}>PENANGGUHAN PEMBAYARAAN</option>

                                            <option value="BELUM BERJKN" {{ $pasien->status_kepersertaan ==
                                                'BELUM BERJKN' ?
                                                'selected' : '' }}>BELUM BERJKN</option>


                                        </select>

                                        @error('status_kepersertaan')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


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
                                        <label for="username">SKTM / DINSOS / Surat Kepolisian <span
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