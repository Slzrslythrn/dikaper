<x-app-layout>
    <div class="container-fluid">
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
                    @if (Auth::user()->level == 'admin' || Auth::user()->level == 'superadmin' || Auth::user()->level ==
                    'verifikator')
                    <li class="breadcrumb-item"><a href="{{ route('jamkesda') }}">Jamkesda</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('jamkesda.diagnosa.tambah', ['id' => $pasien->pasien_id, 'ket' => $keterangan]) }}">Tambah
                            Diagnosa</a></li>
                    @else
                    <li class="breadcrumb-item"><a href="{{ route('jamkesda') }}">Pengajuan</a></li>
                    @if ($pasien->status == 'Dikembalikan')
                    <li class="breadcrumb-item active"><a
                            href="{{ route('pengajuan.diagnosa.tambah', ['id' => $pasien->pasien_id, 'ket' => $keterangan]) }}">Update
                            Diagnosa</a></li>
                    @else
                    <li class="breadcrumb-item active"><a
                            href="{{ route('pengajuan.diagnosa.tambah', ['id' => $pasien->pasien_id, 'ket' => $keterangan ]) }}">Tambah
                            Diagnosa</a></li>
                    @endif

                    @endif

                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">

                        <div class="basic-list-group ">
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
            @if (Auth::user()->level != 'admin' && Auth::user()->level != 'superadmin' && Auth::user()->level !=
            'verifikator')

            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Tahapan</span>
                    <span class="badge badge-primary badge-pill">2</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed ">
                        <div>
                            <h6 class="my-0 ">Pengisian Formulir</h6>
                            <small class="text-muted">Biodata</small>
                        </div>
                        <span class="text-muted">1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed active">
                        <div class="text-white">
                            <h6 class="my-0 text-white">Pengisian Formulir</h6>
                            <small class="">Diagnosa</small>
                        </div>
                        <span class="text-white">2</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Upload / Kirim File</h6>
                            <small>upload file kelengkapan</small>
                        </div>
                        <span class="text-muted">3</span>
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

            @endif

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 order-md-1">
                                <form class="needs-validation" novalidate=""
                                    action="{{ route('pengajuan.diagnosa.update', ['id' => $pasien->pasien_id, 'ket' => $keterangan]) }}"
                                    method="post">
                                    @method('PUT')
                                    @csrf
                                    {{-- <div class="mb-3">
                                        <label for="firstname">No SKTM</label>
                                        <input type="text" name="no_sktm"
                                            class="form-control @error('no_sktm') is-invalid @enderror" id="firstname"
                                            placeholder="" value="{{  $pasien->no_sktm }}" disabled>
                                        @error('no_sktm')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="country">Nama Puskesmas</label>
                                        <select class="d-block form-control @error('nama_pkm') is-invalid @enderror"
                                            name="nama_pkm">
                                            <option value="">Pilih Puskesmas...</option>
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
                                            @if (Auth::user()->level != 'rumahsakit')

                                            <option value="">Pilih Rumah Sakit...</option>
                                            @foreach ($rumahsakit as $rum)
                                            <option value="{{ $rum->kode }}" {{ $pasien->kode_rs == $rum->kode ?
                                                'selected' : '' }}>
                                                {{ $rum->nama }}</option>
                                            @endforeach

                                            @else
                                            <option value="{{ $rumahsakit->kode }}">{{ $rumahsakit->nama }}</option>
                                            @endif

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
                                            value="{{ date('Y-m-d', strtotime($pasien->dijamin_sejak))}}">
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

                                    <hr class="mb-4">

                                    @if ($keterangan == 'baru')
                                    <div class="d-flex">
                                        <a href="{{ route('pengajuan.buatById', ['id' => $pasien->pasien_id ]) }}"
                                            class="btn btn-danger mx-2">Kembali</a>
                                        <button class="btn btn-primary btn-lg btn-block"
                                            type="submit">Selanjutnya</button>

                                    </div>
                                    @else
                                    <div class="d-flex">

                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                                        @endif


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>