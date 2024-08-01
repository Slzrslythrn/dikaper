<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Edit</h4>
                    <span>Edit Data Pembayaran</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jamkesda.selesai') }}">Jamkesda Selesai</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('jamkesda.tagihan.edit', ['id' => $pembayaran->pasien_id]) }}">Edit
                            Pembayaran</a></li>
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
                                    action="{{ route('jamkesda.pembayaran.update') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="pasien_id" id="pasien_id"
                                        value="{{ $pembayaran->pasien_id }}">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">Total tagihan</label>
                                            <input type="text" name="total_pembayaran" id="masking1"
                                                class="form-control @error('total_pembayaran') is-invalid @enderror"
                                                value="{{ old('total_pembayaran') ?? $pembayaran->total_pembayaran }}">
                                            @error('total_pembayaran')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for=""> Tanggal Pembayaran Tagihan</label>
                                            <input type="date" name="tgl_pembayaran" id="tgl_pembayaran"
                                                class="form-control @error('tgl_pembayaran') is-invalid @enderror"
                                                value="{{ old('tgl_pembayaran') ?? date('Y-m-d', strtotime($pembayaran->tgl_pembayaran)) }}">
                                            @error('tgl_pembayaran')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr class="mb-4">
                                    <div class="d-flex">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>

                                    </div>
                                </form>
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
