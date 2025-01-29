<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">

                    <h4>Form Pengunggahan BAP </h4>
                    <span>Pengunggahan BAP Rumah Sakit</span>

                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('verifikasi') }}">Verifikasi</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('verifikasi.getBuatBap') }}">Pengunggahan draft
                            BAP</a></li>

                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-8 order-md-1">
                                <form class="needs-validation" novalidate=""
                                    action="{{ route('verifikasi.postBuatBap') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="username">Tanggal Verifikasi</label>
                                        <div class="input-group">
                                            <input type="date" name="tanggal"
                                                class="form-control @error('tanggal') is-invalid @enderror" required>
                                            @error('tanggal')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="mb-3">
                                        <label for="country">Rumah Sakit</label>
                                        <select
                                            class="d-block form-control @error('rumahsakit_id') is-invalid @enderror"
                                            name="rumahsakit_id">
                                            @foreach ($rumahsakit as $rum)
                                            <option value="{{ $rum->kode }}">
                                                {{ $rum->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('rumahsakit_id')
                                        <div class="invalid-feedback" style="width: 100%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="username">File Draft BAP <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file"
                                                class="form-control @error('draft_bap') is-invalid @enderror"
                                                name="draft_bap">
                                            @error('draft_bap')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <hr class="mb-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
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