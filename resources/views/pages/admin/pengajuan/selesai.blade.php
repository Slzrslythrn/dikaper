<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Pengajuan Selesai</h4>
                    <span>data pengajuan selesai</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('jamkesda') }}">pengajuan Selesai</a></li>

                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('jamkesda.export') }}" method="POST">
                    <div class="row">
                        @csrf

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Tanggal awal</label>
                                <input id="min" type="date" name="tgl_diterima1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Tanggal akhir</label>
                                <input id="max" type="date" name="tgl_diterima2" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Rumah Sakit</label>
                                <select name="rs" id="rs" class="form-control">
                                    <option value="all">Semua</option>
                                    @foreach ($rumahsakit as $rs)
                                    <option value="{{ $rs->kode }}">{{ $rs->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="keterangan">Status Pembayaran</label>
                                <select class="form-control" id="keterangan" id="keterangan" name="keterangan">
                                    <option selected disabled>- pilih -</option>
                                    <option value="3">Semua</option>
                                    <option value="1">Sudah Dibayar</option>
                                    <option value="0">Belum Dibayar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success mt-4">Cetak</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0" id="example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pasien</th>
                                            <th>NIK</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Umur</th>
                                            <th>Rumah Sakit</th>
                                            <th>Jenis Rawat</th>
                                            <th>Status</th>
                                            <th>Status Pembayaran</th>
                                            <th>Tarif INA CBG's</th>
                                            <th>Tarif RS</th>
                                            <th>Tanggal Diterima</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">
                                        @php
                                        $no = 1;
                                        @endphp
                                        @foreach ($pasien as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->nama_pasien }}</td>
                                            <td>{{ $row->no_ktp }}</td>
                                            <td>{{ $row->jenis_kelamin }}</td>
                                            <td>{{ $row->tanggal_lahir->isoFormat('D MMMM Y') }}</td>
                                            <td>{{ $row->rumahsakit->nama ?? 'Data Telah Dihapus' }}</td>
                                            <td>{{ $row->jenis_rawat }}</td>
                                            <td>
                                                @if ($row->status == 'Diterima')
                                                <a href="{{ route('jamkesda.download.diterima', ['id' => $row->pasien_id]) }}"
                                                    class="btn btn-success" target="_blank">{{ $row->status }}</a>
                                                @elseif ($row->status == 'Ditolak')
                                                <button class="btn btn-danger">{{ $row->status }}</button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-secondary mt-1" data-toggle="modal"
                                                    data-target="#exampleModalCenter{{ $row->pasien_id }}">Lihat
                                                    Keterangan</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter{{ $row->pasien_id }}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Keterangan</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{ $row->keterangan_status }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light"
                                                                    data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->pembayaran)
                                                @if ($row->pembayaran->keterangan == 1)
                                                Sudah Dibayar
                                                @else
                                                Belum Dibayar
                                                @endif
                                                @else
                                                Belum Dibayar
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->pembayaran)
                                                {{ $row->pembayaran->tarif_inacbgs }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->pembayaran)
                                                {{ $row->pembayaran->tarif_rs }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $row->tgl_diterima }}
                                            </td>
                                            <td>
                                                {{-- <div class="d-flex"> --}}
                                                    <a href="{{ route('pengajuan.lihat', ['id' => $row->pasien_id]) }}"
                                                        class="btn btn-secondary mr-1">Lihat</a>
                                                    @if ($row->status == 'Diterima')
                                                    @if (auth()->user()->level != 'verifikator')
                                                    @if ($row->pembayaran)
                                                    @if ($row->pembayaran->tarif_inacbgs == null)
                                                    <!-- Button trigger modal -->
                                                    <a
                                                        href="{{ route('pembayaran.buat',  ['id' => $row->pasien_id] )}}">
                                                        <button type="button" class="btn btn-primary modalpasienid" {{--
                                                            data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                            data-target="#modalTagihan" --}}>Pembayaran </button>
                                                    </a>
                                                    @else

                                                    <a href="{{ route('jamkesda.tagihan.hapus', ['id' => $row->pasien_id]) }}"
                                                        class="btn btn-danger my-2"
                                                        onclick="return confirm('Yakin untuk membatalkan data ?')">Batal</a>

                                                    <a href="{{ route('jamkesda.tagihan.edit', ['id' => $row->pasien_id]) }}"
                                                        class="btn btn-warning text-white">Edit
                                                        Pembayaran</a>
                                                    @endif

                                                    @else

                                                    <!-- Button trigger modal -->
                                                    <a
                                                        href="{{ route('pembayaran.buat',  ['id' => $row->pasien_id] )}}">
                                                        <button type="button" class="btn btn-primary modalpasienid" {{--
                                                            data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                            data-target="#modalTagihan" --}}>Pembayaran </button>
                                                    </a>
                                                    {{-- <button type="button"
                                                        class="btn btn-primary modalpasienid my-2"
                                                        data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                        data-target="#modalTagihan">Pembayaran </button> --}}
                                                    @endif
                                                    @else
                                                    @if ($row->pembayaran)
                                                    @if ($row->pembayaran->total_pembayaran == null)
                                                    @if (auth()->user()->level == 'verifikator')
                                                    {{-- <button type="button"
                                                        class="btn btn-primary modalpasienid_pembayaran my-2"
                                                        data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                        data-target="#modalPembayaran">Pembayaran</button> --}}
                                                    @else
                                                    <button type="button" class="btn btn-primary modalpasienid"
                                                        data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                        data-target="#modalTagihan">Pembayaran </button>
                                                    @endif
                                                    @else
                                                    <button type="button" class="btn btn-primary modalpasienid"
                                                        data-item="{{ $row->pasien_id }}" data-toggle="modal"
                                                        data-target="#modalTagihan">Pembayaran </button>
                                                    @endif
                                                    @endif
                                                    @endif
                                                    @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tagihan -->
                    {{-- <div class="modal fade" id="modalTagihan" tabindex="-1" role="dialog"
                        aria-labelledby="modalTagihanTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTagihanTitle">Data Tagihan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('jamkesda.tagihan.simpan') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="pasien_id" id="pasien_id">
                                        <div class="form-group">
                                            <label for="total_tagihan">Total Tagihan</label>
                                            <input type="text" class="form-control" name="total_tagihan"
                                                id="total_tagihan" required>
                                        </div> --}}
                                        {{-- <div class="form-group">
                                            <label for="total_tagihan">Tanggal Pembayaran Tagihan</label>
                                            <input type="date" class="form-control" name="tgl_pembayaran_tagihan"
                                                id="tgl_pembayaran_tagihan" required>
                                        </div> --}}
                                        {{-- <div class="form-group">
                                            <label for="total_pembayaran">Total Pembayaran</label>
                                            <input type="text" class="form-control" name="total_pembayaran"
                                                id="total_pembayaran" required>
                                        </div> --}}
                                        {{-- <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <select class="form-control" id="keterangan" name="keterangan" required>
                                                <option value="1">Sudah Dibayar</option>
                                                <option value="0">Belum Dibayar</option>
                                            </select>
                                        </div>

                                        <h5>Inacbgs</h5> --}}
                                        {{-- <div class="form-group">
                                            <label for="keterangan">Jenis RS</label>
                                            <select class="form-control" id="jenis_rs" name="jenis_rs" required>
                                                <option value="">Pilih Jenis RS</option>
                                                @foreach ($inacbgs->unique('jenis_rs') as $item)
                                                <option value="{{ $item->jenis_rs }}">{{ $item->jenis_rs }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}

                                        {{-- <div class="form-group">
                                            <label for="keterangan">Diagnosa</label>
                                            <select class="form-control" id="diagnosa" name="diagnosa" required
                                                disabled>
                                                <option value="">Pilih Diagnosa</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Tarif</label>
                                            <select class="form-control" id="tarif" name="tarif" required disabled>
                                                <option value="">Pilih Tarif</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Modal Pembayaran -->
                    {{-- <div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog"
                        aria-labelledby="modalPembayaranTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalPembayaranTitle">Data Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('jamkesda.pembayaran.simpan') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="pasien_id_pembayaran" id="pasien_id_pembayaran">
                                        <div class="form-group">
                                            <label for="total_pembayaran">Total Pembayaran</label>
                                            <input type="text" class="form-control" name="total_pembayaran"
                                                id="total_pembayaran" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                                            <input type="date" class="form-control" name="tgl_pembayaran"
                                                id="tgl_pembayaran" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                                required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).on("click", ".modalpasienid", function () {
        var pasienId = $(this).data('item');
        $("#pasien_id").val(pasienId);
    });

    $(document).on("click", ".modalpasienid_pembayaran", function () {
        var pasienIdPembayaran = $(this).data('item');
        $("#pasien_id_pembayaran").val(pasienIdPembayaran);
    });
</script>
{{--
<script>
    $(document).ready(function() {
    $('#jenis_rs').change(function() {
        var jenis_rs = $(this).val();
        $('#diagnosa').prop('disabled', true);
        $('#tarif').prop('disabled', true);
        $('#diagnosa').html('<option value="">Pilih Diagnosa</option>');
        $('#tarif').html('<option value="">Pilih Tarif</option>');
        
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
        $('#tarif').prop('disabled', true);
        $('#tarif').html('<option value="">Pilih Tarif</option>');
        
        if (id) {
            $.ajax({
                url: '{{ route("getTarifByDiagnosa") }}', // Route untuk mengambil tarif berdasarkan diagnosa
                type: 'GET',
                data: { id: id },
                success: function(data) {
                    $('#tarif').prop('disabled', false);
                    $('#tarif').append('<option value="' + data.tarif + '" selected >' + data.tarif + '</option>');
                }
            });
        }
    });
});

</script> --}}