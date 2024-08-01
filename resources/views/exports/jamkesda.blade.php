<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Peserta</th>
                <th>Nomor SKTM</th>
                <th>Nama Pasien</th>
                <th>Nama Puskesmas</th>
                <th>Nomor Rujuk IGD</th>
                <th>Nomor KTP</th>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Hubungan KK</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Diagnosa</th>
                <th>Kode RS</th>
                <th>Tanggal Mulai Rawat</th>
                <th>Jenis Rawat</th>
                <th>Kelas</th>
                <th>Dijamin Sejak</th>
                <th>Status</th>
                <th>Keterangan Status</th>
                <th>Tanggal diterima</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kode</th>
                <th>Nama Rumah Sakit</th>
                <th>Kode Jenis</th>
                <th>Kelas</th>
                <th>Strata</th>
                <th>Ref tarif jamkesda</th>
                <th>Ref tarif jamkesmas</th>
                <th>Tagihan</th>
                <th>Pembayaran</th>
                <th>Selisih Pembayaran</th>
                <th>Keterangan</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($data as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->no_peserta }}</td>
                    <td>{{ $row->no_sktm }}</td>
                    <td>{{ $row->nama_pasien }}</td>
                    <td>{{ $row->nama_pkm }}</td>
                    <td>{{ $row->no_rujuk_igd }}</td>
                    <td>'{{ $row->no_ktp }}</td>
                    <td>'{{ $row->no_kk }}</td>
                    <td>{{ $row->nama_kepala }}</td>
                    <td>{{ $row->hubungan_kk }}</td>
                    <td>{{ $row->jenis_kelamin }}</td>
                    <td>{{ $row->tempat_lahir }}</td>
                    <td>{{ $row->tanggal_lahir }}</td>
                    <td>{{ $row->alamat_pasien }}</td>
                    <td>{{ $row->diagnosa }}</td>
                    <td>{{ $row->kode_rs }}</td>
                    <td>{{ $row->tgl_mulairawat }}</td>
                    <td>{{ $row->jenis_rawat }}</td>
                    <td>{{ $row->dikelas }}</td>
                    <td>{{ $row->dijamin_sejak }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->keterangan_status }}</td>
                    <td>{{ $row->tgl_diterima }}</td>
                    <td>{{ $row->kelurahan->kelurahan_nama }}</td>
                    <td>{{ $row->kelurahan->kecamatan->kecamatan_nama }}</td>
                    <td>{{ $row->rumahsakit->kode }}</td>
                    <td>{{ $row->rumahsakit->nama }}</td>
                    <td>{{ $row->rumahsakit->kode_jenis }}</td>
                    <td>{{ $row->rumahsakit->kelas }}</td>
                    <td>{{ $row->rumahsakit->strata }}</td>
                    <td>{{ $row->rumahsakit->ref_tarif_jamkesda }}</td>
                    <td>{{ $row->rumahsakit->ref_tarif_jamkesmas }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        {{ $row->total_tagihan ? $row->total_tagihan : 0 }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        {{ $row->total_pembayaran ? $row->total_pembayaran : 0 }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        {{ $row->total_pembayaran ? $row->total_tagihan - $row->total_pembayaran : $row->total_tagihan }}
                    </td>
                    <td>
                        @if ($row->pembayaran)
                            @if ($row->pembayaran->keterangan == 1)
                                Sudah Lunas
                            @elseif ($row->pembayaran->keterangan == 0)
                                Belum Lunas
                            @else
                                Belum Lunas
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($row->pembayaran)
                            {{ $row->pembayaran->tgl_pembayaran_tagihan ? date('d-m-Y', strtotime($row->pembayaran->tgl_pembayaran_tagihan)) : '' }}
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="32" style="text-align: center; vertical-align: middle;">Total</td>
                <td style="text-align: center; vertical-align: middle;">{{ $jmlh_tagihan . '.' . '000' }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $jmlh_pembayaran . '.' . '000' }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
