<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Form Pembayaran</h4>
                    <span>Input Data Pembayaran</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jamkesda.selesai') }}">Jamkesda Selesai</a></li>
                    {{-- <li class="breadcrumb-item active"><a
                            href="{{ route('jamkesda.tagihan.edit', ['id' => $pembayaran->pasien_id]) }}">Input
                            Pembayaran</a></li> --}}
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
                                    action="{{ route('jamkesda.tagihan.simpan') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="pasien_id" id="pasien_id"
                                        value="{{ $pasien->pasien_id }}">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">No. RM</label>
                                            <input type="text" name="no_rm" id="no_rm"
                                                class="form-control @error('no_rm') is-invalid @enderror" ">
                                             {{-- value=" {{ old('total_pembayaran') ?? $pembayaran->total_pembayaran
                                            }} --}}
                                            @error('no_rm')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for=""> Tanggal Mulai Rawat</label>

                                            <input type="date"
                                                class="form-control @error('tgl_mulairawat') is-invalid @enderror"
                                                name="tgl_mulairawat" value="{{ $pasien->tgl_mulairawat }}" disabled>
                                            @error('tgl_mulairawat')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            {{-- <input type="date" name="tgl_mulairawat" id="tgl_mulairawat"
                                                class="form-control @error('tgl_mulairawat') is-invalid @enderror"
                                                value="{{ $pasien->tgl_mulairawat}}">

                                            @error('tgl_mulairawat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror --}}
                                        </div>
                                    </div>

                                    {{-- @dd( $pasien->tgl_mulairawat) --}}

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for=""> Tanggal Keluar</label>
                                            <input type="date" name="tgl_keluar" id="tgl_keluar"
                                                class="form-control @error('tgl_keluar') is-invalid @enderror" ">
                                               {{-- value=" {{ old('tgl_pembayaran') ?? date('Y-m-d',
                                                strtotime($pembayaran->tgl_pembayaran)) }} --}}
                                            @error('tgl_keluar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">Los</label>
                                            <input type="text" name="los" id="los"
                                                class="form-control @error('los') is-invalid @enderror" ">
                                             {{-- value=" {{ old('total_pembayaran') ?? $pembayaran->total_pembayaran
                                            }} --}}
                                            @error('los')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">Jenis RS</label>
                                            <select class="form-control" id="jenis_rs" name="jenis_rs" required>
                                                <option value="">Pilih Jenis RS</option>
                                                @foreach ($inacbgs->unique('jenis_rs') as $item)
                                                <option value="{{ $item->jenis_rs }}">{{ $item->jenis_rs }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" name="jenis_rs" id="jenis_rs"
                                                class="form-control @error('jenis_rs') is-invalid @enderror" "> --}}
                                             {{-- value=" {{ old('total_pembayaran') ?? $pembayaran->total_pembayaran
                                            }} --}}
                                            @error('jenis_rs')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">Diagnosa</label>

                                            <select class="form-control" id="diagnosa" name="diagnosa" required
                                                disabled>
                                                <option value="">Pilih Diagnosa</option>
                                            </select>
                                            {{-- <input type="text" name="diagnosa" id="diagnosa"
                                                class="form-control @error('diagnosa') is-invalid @enderror"> --}}
                                            {{-- value=" {{ old('total_pembayaran') ?? $pembayaran->total_pembayaran
                                            }} --}}
                                            @error('diagnosa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">Tarif INA CBG'S</label>

                                            <select class="form-control" id="tarif_inacbgs" name="tarif_inacbgs"
                                                required disabled>
                                                <option value="">Pilih Tarif</option>
                                            </select>
                                            {{-- <input type="text" name="tarif_inacbgs" id="tarif_inacbgs"
                                                class="form-control @error('tarif_inacbgs') is-invalid @enderror"> --}}
                                            {{-- value=" {{ old('total_pembayaran') ?? $pembayaran->total_pembayaran
                                            }} --}}
                                            @error('tarif_inacbgs')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">Tarif RS / PKM</label>
                                            <input type="text" name="tarif_rs" id="tarif_rs"
                                                class="form-control @error('tarif_rs') is-invalid @enderror" ">
                                             {{-- value=" {{ old('total_pembayaran') ?? $pembayaran->total_pembayaran
                                            }} --}}
                                            @error('tarif_rs')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">Biaya Lainnya</label>
                                            <input type="text" name="biaya_lainnya" id="biaya_lainnya"
                                                class="form-control @error('biaya_lainnya') is-invalid @enderror" ">
                                             {{-- value=" {{ old('total_pembayaran') ?? $pembayaran->total_pembayaran
                                            }} --}}
                                            @error('biaya_lainnya')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="total">Total Biaya</label>
                                            <input type="text" name="total_biaya" id="total_biaya"
                                                class="form-control @error('total_biaya') is-invalid @enderror" ">
                                             {{-- value=" {{ old('total_pembayaran') ?? $pembayaran->total_pembayaran
                                            }} --}}
                                            @error('total_biaya')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label for="username">Berkas Pasien Pulang<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file"
                                                class="form-control @error('pasien_pulang') is-invalid @enderror"
                                                id="pasien_pulang" name="pasien_pulang">
                                            @error('pasien_pulang')
                                            <div class="invalid-feedback" style="width: 100%;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
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

    <script>
        $(document).ready(function() {
    $('#jenis_rs').change(function() {
        var jenis_rs = $(this).val();
        $('#diagnosa').prop('disabled', true);
        $('#tarif_inacbgs').prop('disabled', true);
        $('#diagnosa').html('<option value="">Pilih Diagnosa</option>');
        $('#tarif_inacbgs').html('<option value="">Pilih Tarif</option>');
        
        if (jenis_rs) {
            $.ajax({
                url: '{{ route("getDiagnosaByJenisRs") }}', // Route untuk mengambil data berdasarkan jenis_rs
                type: 'GET',
                data: { jenis_rs: jenis_rs },
                success: function(data) {
                    if (data.length > 0) {
                        $('#diagnosa').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('#diagnosa').append('<option value="' + value.id + '">' + value.kode + ' || ' + value.deskrpsi + '</option>');
                        });
                    }
                }
            });
        }
    });

    $('#diagnosa').change(function() {
        var id = $(this).val();
        $('#tarif_inacbgs').prop('disabled', true);
        $('#tarif_inacbgs').html('<option value="">Pilih Tarif</option>');
        
        if (id) {
            $.ajax({
                url: '{{ route("getTarifByDiagnosa") }}', // Route untuk mengambil tarif berdasarkan diagnosa
                type: 'GET',
                data: { id: id },
                success: function(data) {
                    $('#tarif_inacbgs').prop('disabled', false);
                    $('#tarif_inacbgs').append('<option value="' + data.tarif + '" selected >' + data.tarif + '</option>');
                }
            });
        }
    });
});

    </script>

    @endpush
</x-app-layout>