<x-guest-layout>
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Daftarkan akun anda</h4>
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Nama</strong></label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>NIK (Nomor Induk KTP)</strong></label>
                                        <input type="text" class="form-control" name="nik" max="16" min="16"
                                            value="{{ old('nik') }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" placeholder="contoh@example.com" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" name="password" class="form-control" id="myPassword">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Konfirmasi Password</strong></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            required>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Sudah punya akun? <a class="text-primary" href="{{ route('login') }}">Login</a>
                                    </p>
                                </div>
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
</x-guest-layout>
