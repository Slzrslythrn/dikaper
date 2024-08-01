<x-guest-layout>

    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Account Locked</h4>
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form action="{{ route('password.confirm') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label><strong>Ini adalah area aplikasi yang aman. Harap konfirmasi kata sandi
                                                Anda sebelum melanjutkan.</strong></label>
                                        <input type="password" name="password" required autocomplete="current-password"
                                            class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Konfirmasi</button>
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
