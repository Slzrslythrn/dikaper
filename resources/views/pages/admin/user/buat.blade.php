<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Tambah</h4>
                    <span>Tambah User</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-user') }}">User</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('data-user.buat') }}">Tambah
                            User</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 order-md-1">
                                <form class="needs-validation" novalidate="" action="{{ route('data-user.simpan') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="firstName">Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="firstName"
                                            placeholder="" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">NIK</label>
                                        <input type="text" name="nik"
                                            class="form-control @error('nik') is-invalid @enderror" id="firstnik"
                                            placeholder="" value="{{ old('nik') }}">
                                        @error('nik')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Email</label>
                                        <input type="text" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="firstemail"
                                            placeholder="" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstName">Level</label>
                                        <select name="level" id="level"
                                            class="form-control @error('level') is-invalid @enderror">
                                            <option value="superadmin">Superadmin</option>
                                            <option value="admin">Admin</option>
                                            <option value="rumahsakit">Rumah Sakit</option>
                                            <option value="verifaktor">Verifikator</option>
                                            <option value="user">User (Masyarakat)</option>
                                        </select>
                                        @error('level')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="myPassword">
                                        @error('password')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label class="mb-1"><strong>Konfirmasi Password</strong></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            required>
                                    </div>

                                    <hr class="mb-4">
                                    <div class="d-flex">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
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
