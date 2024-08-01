<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 col-xxl-12">
                <div class="row">
                    @if (session()->get('status'))
                        <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                            <div class="card bg-primary overflow-hidden">
                                <div class="card-body pb-2 pt-2">
                                    <div class="row">
                                        <div class="col text-white">
                                            <h1 class="text-white">{{ session()->get('status') }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if (auth()->user()->level == 'user' || auth()->user()->level == 'rumahsakit')
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card bg-primary">
                        <div class="card-body d-flex align-items-center">
                            <div class="new-arrival-product">
                                <div class="new-arrival-content">
                                    <h4 class="text-white">Pengajuan Baru</h4>
                                    <a href="{{ route('pengajuan.buat') }}" class="btn btn-secondary shadow-lg">BUAT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card bg-success">
                        <div class="card-body d-flex align-items-center">
                            <div class="new-arrival-product ">
                                <div class="new-arrival-content ">
                                    <h4 class="text-white">Data Pengajuan</h4>
                                    <a href="{{ route('pengajuan') }}" class="btn btn-secondary shadow-lg">LIHAT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

</x-app-layout>
