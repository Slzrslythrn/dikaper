<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Edit</h4>
                    <span>Edit Rumah Sakit</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-user') }}">Rumah Sakit</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('data-rumahSakit.edit', ['id' => $rumahsakit->kode]) }}">Edit
                            Rumah Sakit</a></li>
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
                                    action="{{ route('data-rumahSakit.update', ['id' => $rumahsakit->kode]) }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="firstName">Kode</label>
                                        <input type="text" name="kode"
                                            class="form-control @error('kode') is-invalid @enderror" id="firstkode"
                                            placeholder="" value="{{ old('kode') ?? $rumahsakit->kode }}">
                                        @error('kode')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Nama</label>
                                        <input type="text" name="nama"
                                            class="form-control @error('nama') is-invalid @enderror" id="firstnama"
                                            placeholder="" value="{{ old('nama') ?? $rumahsakit->nama }}">
                                        @error('nama')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Alamat</label>
                                        <input type="text" name="alamat"
                                            class="form-control @error('alamat') is-invalid @enderror" id="firstalamat"
                                            placeholder="" value="{{ old('alamat') ?? $rumahsakit->alamat }}">
                                        @error('alamat')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Kode Jenis</label>
                                        <input type="text" name="kode_jenis"
                                            class="form-control @error('kode_jenis') is-invalid @enderror"
                                            id="firstkode_jenis" placeholder=""
                                            value="{{ old('kode_jenis') ?? $rumahsakit->kode_jenis }}">
                                        @error('kode_jenis')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Kelas</label>
                                        <input type="text" name="kelas"
                                            class="form-control @error('kelas') is-invalid @enderror" id="firstkelas"
                                            placeholder="" value="{{ old('kelas') ?? $rumahsakit->kelas }}">
                                        @error('kelas')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Strata</label>
                                        <input type="text" name="strata"
                                            class="form-control @error('strata') is-invalid @enderror" id="firststrata"
                                            placeholder="" value="{{ old('strata') ?? $rumahsakit->strata }}">
                                        @error('strata')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Ref Tarif Jamkesda</label>
                                        <input type="text" name="ref_tarif_jamkesda"
                                            class="form-control @error('ref_tarif_jamkesda') is-invalid @enderror"
                                            id="firstref_tarif_jamkesda" placeholder=""
                                            value="{{ old('ref_tarif_jamkesda') ?? $rumahsakit->ref_tarif_jamkesda }}">
                                        @error('ref_tarif_jamkesda')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="firstName">Ref Tarif Jamkesmas</label>
                                        <input type="text" name="ref_tarif_jamkesmas"
                                            class="form-control @error('ref_tarif_jamkesmas') is-invalid @enderror"
                                            id="firstref_tarif_jamkesmas" placeholder=""
                                            value="{{ old('ref_tarif_jamkesmas') ?? $rumahsakit->ref_tarif_jamkesmas }}">
                                        @error('ref_tarif_jamkesmas')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="country">User</label>
                                        <select class="d-block form-control @error('users_id') is-invalid @enderror"
                                            name="users_id">
                                            <option value="">Pilih User...</option>
                                            @foreach ($user as $item)
                                            <option
                                                value="{{ $item->id }} {{ $rumahsakit->user_id == $item->id ? 'selected' : '' }}">
                                                {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('users_id')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <hr class="mb-4">
                                    <div class="d-flex">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Edit</button>
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