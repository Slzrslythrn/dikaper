<x-guest-layout>
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h6 class="text-center mb-4">Terima kasih telah mendaftar! Sebelum memulai, dapatkah
                                    Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami
                                    kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami
                                    dengan senang hati akan mengirimkan email yang lain kepada Anda.</h6>
                                @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 font-medium text-sm text-success">
                                        Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat
                                        pendaftaran.
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Kirim ulang verifikasi
                                            email</button>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="text-center my-3">
                                        <button type="submit" class="btn btn-danger btn-block">Logout</button>
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
