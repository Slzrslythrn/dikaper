<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Tambah</h4>
                    <span>Tambah Diagnosa</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jamkesda') }}">Jamkesda</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('jamkesda.diagnosa.tambah', ['id' => $pasien->pasien_id]) }}">Tambah
                            Diagnosa</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-list-group">
                            <div class="list-group">
                                <a href="javascript:void()"
                                    class="list-group-item list-group-item-action flex-column align-items-start active">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-3 text-white">Detail Biodata</h5>
                                    </div>
                                    <p class="mb-1">
                                        <ul>
                                            <li>No KK : <b>{{ $pasien->no_kk }}</b></li>
                                            <li>No KTP : <b>{{ $pasien->no_ktp }}</b></li>
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
                            <div class="col-md-12 order-md-1">
                                <form class="needs-validation" novalidate=""
                                    action="{{ route('jamkesda.diagnosa.update', ['id' => $pasien->pasien_id]) }}"
                                    method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="firstname">No SKTM</label>
                                        <input type="text" name="no_sktm" class="form-control @error('no_sktm') is-invalid @enderror" id="firstname" placeholder="" value="{{ old('no_sktm') ?? $pasien->no_sktm }}" disabled >
                                        @error('no_sktm')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="country">Nama Puskesmas</label>
                                        <select class="d-block form-control @error('nama_pkm') is-invalid @enderror"
                                            name="nama_pkm">
                                            @foreach ($puskesmas as $pus)
                                                <option value="{{ $pus }}">{{ $pus }}</option>
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
                                            id="firstName" placeholder="" value="{{ old('no_rujuk_igd') }}">
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
                                            placeholder="" value="{{ old('diagnosa') }}">
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
                                            @foreach ($rumahsakit as $rum)
                                                <option value="{{ $rum->kode }}">{{ $rum->nama }}</option>
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
                                            name="tgl_mulairawat" value="{{ old('tgl_mulairawat') }}">
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
                                            <option value="Rawat Inap">Rawat Inap</option>
                                            <option value="Rawat Jalan">Rawat Jalan</option>
                                        </select>
                                        @error('jenis_rawat')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Kelas Rawat</label>
                                        <input type="text"
                                            class="form-control @error('dikelas') is-invalid @enderror" name="dikelas"
                                            value="{{ old('dikelas') }}" />
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
                                            name="dijamin_sejak" value="{{ old('dijamin_sejak') }}">
                                        @error('dijamin_sejak')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Tanggal Aktif VA BPJS</label>
                                        <input type="date"
                                            class="form-control @error('tgl_aktif_va') is-invalid @enderror"
                                            name="tgl_aktif_va" value="{{ old('tgl_aktif_va') }}">
                                        @error('tgl_aktif_va')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Status kepesertaan JKN sebelumnya</label>
                                        <input type="text"
                                            class="form-control @error('status_kepersertaan') is-invalid @enderror"
                                            name="status_kepersertaan" value="{{ old('status_kepersertaan') }}">
                                        @error('status_kepersertaan')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <hr class="mb-4">
                                    <div class="d-flex">
                                        <button class="btn btn-primary btn-lg btn-block"
                                            type="submit">Update</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
