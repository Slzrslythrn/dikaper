<x-guest-layout>
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Silahkan Login</h4>
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" class="form-control" autofocus name="email"
                                            value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>


                                    <div class="form-group">
                                        <label class="mb-1"><strong>Tahun</strong></label>

                                        <select name="tahun" class="plain"
                                            style="width: 100%; border: 1px solid #d7dae3; border-radius: 0.375rem; padding: 8px 2px">
                                            @for ($i = date('Y'); $i >= 2000; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="captcha mb-2 mt-6">
                                            <span>{!! captcha_img() !!}</span>
                                        </div>
                                        <input type="text" class="form-control" name="captcha" required
                                            placeholder="Masukkan hasil penjumlahan">
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" class="custom-control-input" id="remember_me"
                                                    name="remember">
                                                <label class="custom-control-label" for="remember_me">Ingat Saya</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('password.request') }}">Lupa Password?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
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