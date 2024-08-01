<x-guest-layout>
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Lupa Password</h4>

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <form action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label><strong>lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email
                                                Anda dan kami akan mengirimi Anda tautan setel ulang kata sandi melalui
                                                email yang memungkinkan Anda memilih yang baru.</strong></label>
                                        <input type="email" class="form-control" value="{{ old('email') }}"
                                            name="email" required autofocus>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Email Password Reset
                                            Link</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
