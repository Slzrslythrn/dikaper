<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Tambah</h4>
                    <span>Tambah Baznas</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('baznas') }}">Baznas</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('baznas.buat') }}">Tambah Baznas</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 order-md-1">
                                <form class="needs-validation" novalidate="" action="{{ route('baznas.simpan') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="noSurat">No Surat</label>
                                                <input type="text" name="no_surat"
                                                class="form-control @error('no_surat') is-invalid @enderror"
                                                id="noSurat" placeholder=""
                                                value="{{ old('no_surat') ?? $newCode }}" disabled>
                                                @error('no_surat')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="tglSurat">Tanggal Surat</label>
                                                <input type="date" name="tgl_surat"
                                                       class="form-control @error('tgl_surat') is-invalid @enderror"
                                                       id="tglSurat" placeholder="" value="{{ old('tgl_surat') }}">
                                                @error('tgl_surat')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="ket">Keterangan</label>
                                                <input type="text" name="ket"
                                                       class="form-control @error('ket') is-invalid @enderror"
                                                       id="ket" placeholder="" value="{{ old('ket') }}">
                                                @error('ket')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama"
                                                       class="form-control @error('nama') is-invalid @enderror"
                                                       id="nama" placeholder="" value="{{ old('nama') }}">
                                                @error('nama')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tglLahir">Tanggal Lahir</label>
                                                <input type="date" name="tgl_lahir"
                                                       class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                       id="tglLahir" placeholder="" value="{{ old('tgl_lahir') }}">
                                                @error('tgl_lahir')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" name="alamat"
                                                       class="form-control @error('alamat') is-invalid @enderror"
                                                       id="alamat" placeholder="" value="{{ old('alamat') }}">
                                                @error('alamat')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="kelurahan">Kelurahan</label>
                                                <input type="text" name="kelurahan"
                                                       class="form-control @error('kelurahan') is-invalid @enderror"
                                                       id="kelurahan" placeholder="" value="{{ old('kelurahan') }}">
                                                @error('kelurahan')
                                                    <div class="invalid-feedback" style="width: 100%;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="rt">RT</label>
                                                    <input type="text" name="rt"
                                                           class="form-control @error('rt') is-invalid @enderror"
                                                           id="rt" placeholder="" value="{{ old('rt') }}">
                                                    @error('rt')
                                                        <div class="invalid-feedback" style="width: 100%;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="rw">RW</label>
                                                    <input type="text" name="rw"
                                                           class="form-control @error('rw') is-invalid @enderror"
                                                           id="rw" placeholder="" value="{{ old('rw') }}">
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
</div>

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#masking1').mask('#.##0.000', {
                reverse: true
            });
            $('#masking2').mask('#.##0.000', {
                reverse: true
            });
            $('#uang').mask('#.##0.000', {
                reverse: true
            });
            $('#uangad').mask('#.##0,0', {
                reverse: true
            });
            $('#masking3').mask('#,##0.00', {
                reverse: true
            });
        })
    </script>
@endpush
</x-app-layout>