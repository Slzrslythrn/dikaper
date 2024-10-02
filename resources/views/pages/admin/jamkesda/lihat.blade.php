<x-app-layout>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Jamkesda</h4>
                    <span>data jamkesda</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jamkesda') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('jamkesda.lihat', ['id' => $pasien->pasien_id]) }}">Lihat</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="center">No KTP</td>
                                                <td class="left strong">{{ $pasien->no_ktp }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">No KK</td>
                                                <td class="left strong">{{ $pasien->no_kk }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Nama Pasien</td>
                                                <td class="left strong">{{ $pasien->nama_pasien }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Jenis Kelamin</td>
                                                <td class="left strong">{{ $pasien->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Tempat Lahir</td>
                                                <td class="left strong">{{ $pasien->tempat_lahir }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Tanggal Lahir</td>
                                                <td class="left strong">{{ $pasien->tanggal_lahir }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Kelurahan</td>
                                                <td class="left strong">{{ $pasien->kelurahan->kelurahan_nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Alamat</td>
                                                <td class="left strong">{{ $pasien->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Nama Kepala Keluarga</td>
                                                <td class="left strong">{{ $pasien->nama_kepala }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Hubungan dengan Keluarga</td>
                                                <td class="left strong">{{ $pasien->hubungan_kk }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">


                                {{-- @if ($pasien->no_sktm && $pasien->no_rujuk_igd != 0) --}}
                                @if ($pasien->no_rujuk_igd != 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="center">No</td>
                                                <td class="left strong">{{ $pasien->no_peserta }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">No SKTM</td>
                                                <td class="left strong">{{ $pasien->no_sktm }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">No Rujuk</td>
                                                <td class="left strong">{{ $pasien->no_rujuk_igd }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Nama Puskesmas</td>
                                                <td class="left strong">{{ $pasien->nama_pkm }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Diagnosa</td>
                                                <td class="left strong">{{ $pasien->diagnosa }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Rumah Sakit</td>
                                                <td class="left strong">{{ $pasien->rumahsakit->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Tanggal Mulai Rawat</td>
                                                <td class="left strong">{{ $pasien->tgl_mulairawat }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Jenis Rawat</td>
                                                <td class="left strong">{{ $pasien->jenis_rawat }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Dikelas</td>
                                                <td class="left strong">{{ $pasien->dikelas }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">Dijamin Sejak Tanggal</td>
                                                <td class="left strong">{{ $pasien->dijamin_sejak }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                                @if (auth()->user()->level != 'user' && auth()->user()->level != 'verifikator')
                                <a href="{{ route('pengajuan.diagnosa.tambah', ['id' => $pasien->pasien_id, 'ket' => 'lengkapi']) }}"
                                    class="btn btn-secondary">
                                    Lengkapi Data Diagnosa
                                </a>
                                @endif
                            </div>
                        </div>
                        <h3 class="mt-4">File Persyaratan</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="center">Kartu Keluarga & KTP</td>
                                                <td class="left strong">
                                                    @if ($pasien->persyaratan)
                                                    {{-- @if ($pasien->persyaratan->va)
                                                    <a href="{{ asset('uploads/buktiPendaftaranBpjs/' . $pasien->persyaratan->va) }}"
                                                        class="badge badge-secondary mr-2">LIHAT KK</a>
                                                    @endif --}}
                                                    @if ($pasien->persyaratan->ktp_kk)
                                                    <a href="{{ asset('uploads/ktpKk/' . $pasien->persyaratan->ktp_kk) }}"
                                                        target="_blank" class="badge badge-secondary">LIHAT</a>
                                                    @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="center">SKTM / DINSOS dan Surat Kepolisian</td>
                                                <td class="left strong">
                                                    @if ($pasien->persyaratan && $pasien->persyaratan->sktm)
                                                    <a href="{{ asset('uploads/sktm/' . $pasien->persyaratan->sktm) }}"
                                                        target="_blank" class="badge badge-secondary">LIHAT</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="center">Surat RS (IGD, RANAP, dan ACC RS)</td>
                                                <td class="left strong">
                                                    @if ($pasien->persyaratan && $pasien->persyaratan->doc)
                                                    <a href="{{ asset('uploads/doc/' . $pasien->persyaratan->doc) }}"
                                                        target="_blank" class="badge badge-secondary">LIHAT</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if (auth()->user()->level == 'verifikator' && $pasien->status == 'Diterima')
                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="center">File SJP</td>
                                                <td class="left strong">

                                                    <a href="{{ route('jamkesda.download.diterima', ['id' => $pasien->pasien_id]) }}"
                                                        target="_blank" class="badge badge-secondary">LIHAT</a>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="center">Berkas Pasien Pulang</td>
                                                <td class="left strong">
                                                    @if ($pasien->persyaratan && $pasien->persyaratan->pasien_pulang)
                                                    <a href="{{ asset('uploads/pasien_pulang/' . $pasien->persyaratan->pasien_pulang) }}"
                                                        target="_blank" class="badge badge-secondary">LIHAT</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif

                        </div>
                        @if (auth()->user()->level != 'user' && auth()->user()->level != 'rumahsakit' )
                        {{-- @if ($pasien->no_sktm && $pasien->no_rujuk_igd != 0) --}}
                        @if ( $pasien->no_rujuk_igd != 0)
                        @if ($pasien->status != 'Diterima')
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-danger mx-2" data-toggle="modal"
                                data-target="#exampleModalCenter">Ditolak</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tolak Pengajuan</h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal"><span>&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('jamkesda.proses.ditolak') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="pasien_id" value="{{ $pasien->pasien_id }}">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea required name="keterangan_status" id="" cols="30"
                                                        rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secaondary light"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary mx-2" data-toggle="modal"
                                data-target="#returnModal">Dikembalikan</button>

                            <div class="modal fade" id="returnModal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Pengembalian Pengajuan</h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal"><span>&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('jamkesda.proses.dikembalikan') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="pasien_id" value="{{ $pasien->pasien_id }}">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea required name="keterangan_status" id="" cols="30"
                                                        rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secaondary light"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn  btn-secondary">Dikembalikan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('jamkesda.proses.diterima', ['id' => $pasien->pasien_id]) }}"
                                class="btn btn-primary">Diterima</a>
                        </div>
                        @endif
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>