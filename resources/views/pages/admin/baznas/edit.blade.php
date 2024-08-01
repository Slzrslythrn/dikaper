<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Edit</h4>
                    <span>Edit Baznas</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('baznas') }}">Baznas</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('baznas.edit', ['id' => $baznas->id]) }}">Edit
                            Baznas</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 order-md-1">
                                <form class="needs-validation" novalidate=""
                                    action="{{ route('baznas.update', ['id' => $baznas->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstName">No Surat</label>
                                                <input type="text" name="no_surat"
                                                    class="form-control @error('no_surat') is-invalid @enderror"
                                                    id="firstno_surat" placeholder=""
                                                    value="{{ old('no_surat') ?? $baznas->no_surat }}">
                                                @error('no_surat')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="firstName">Tanggal Surat</label>
                                                <input type="date" name="tgl_surat"
                                                    class="form-control @error('tgl_surat') is-invalid @enderror"
                                                    id="firsttgl_surat" placeholder=""
                                                    value="{{ old('tgl_surat') ?? date('Y-m-d', strtotime($baznas->tgl_surat)) }}">
                                                @error('tgl_surat')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="firstName">Keterangan</label>
                                                <input type="text" name="ket"
                                                    class="form-control @error('ket') is-invalid @enderror"
                                                    id="firstket" placeholder=""
                                                    value="{{ old('ket') }}">
                                                @error('ket')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- <div class="mb-3">
                                                <label for="firstName">Denda Layanan Rumah Sakit</label>
                                                <input type="text" name="denda_layanan"
                                                    class="form-control @error('denda_layanan') is-invalid @enderror"
                                                    id="masking2" placeholder=""
                                                    value="{{ old('denda_layanan') ?? $baznas->denda_layanan }}">
                                                @error('denda_layanan')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div> --}}

                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstName">Nama</label>
                                                <input type="text" name="nama"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    id="firstnama" placeholder=""
                                                    value="{{ old('nama') ?? $baznas->nama }}">
                                                @error('nama')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="firstName">Tanggal Lahir</label>
                                                <input type="date" name="tgl_lahir"
                                                    class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                    id="firsttgl_lahir" placeholder=""
                                                    value="{{ old('tgl_lahir') ?? date('Y-m-d', strtotime($baznas->tgl_lahir)) }}">
                                                @error('tgl_lahir')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="firstName">Alamat</label>
                                                <input type="text" name="alamat"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    id="firstalamat" placeholder=""
                                                    value="{{ old('alamat') ?? $baznas->alamat }}">
                                                @error('alamat')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="firstName">Kelurahan</label>
                                                <input type="text" name="kelurahan"
                                                    class="form-control @error('kelurahan') is-invalid @enderror"
                                                    id="firstkelurahan" placeholder=""
                                                    value="{{ old('kelurahan') ?? $baznas->kelurahan }}">
                                                @error('kelurahan')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="firstName">RT</label>
                                                    <input type="text" name="rt"
                                                        class="form-control @error('rt') is-invalid @enderror"
                                                        id="firstrt" placeholder=""
                                                        value="{{ old('rt') ?? $baznas->rt }}">
                                                    @error('rt')
                                                        <div class="invalid-feedback" style="width: 100%;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="firstName">RW</label>
                                                    <input type="text" name="rw"
                                                        class="form-control @error('rw') is-invalid @enderror"
                                                        id="firstrw" placeholder=""
                                                        value="{{ old('rw') ?? $baznas->rw }}">
                                                    @error('rw')
                                                        <div class="invalid-feedback" style="width: 100%;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">
                                    <div class="d-flex">
                                        <button class="btn btn-primary btn-lg btn-block"
                                            type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-styles')
        <link rel="stylesheet" href="{{ asset('assets/pswStrange/passtrength.css') }}" media="screen" title="no title">
    @endpush
    @push('after-scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/pswStrange/jquery.passtrength.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function($) {
                $('#myPassword').passtrength({
                    minChars: 4,
                    passwordToggle: true,
                    tooltip: true,
                    textWeak: "Lemah",
                    textMedium: "Lumayan",
                    textStrong: "Kuat",
                    textVeryStrong: "Kuat Sekali",
                    eyeImg: "{{ asset('assets/pswStrange/img/eye.svg') }}"
                });
            });
        </script>
    @endpush

</x-app-layout>
