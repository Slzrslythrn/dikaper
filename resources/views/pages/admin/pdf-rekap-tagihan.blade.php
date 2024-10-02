<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Tagihan</title>
</head>

<style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
    }

    .container {
        margin: 4px 2px 3px 2px;
    }

    th {
        font-size: 12px
    }
</style>

<body>
    <div class="container">
        <div style="text-align: center; font-weight: 700;">REKAPITULASI TAGIHAN PASIEN JAMKESDA
            KOTA BOGOR</div>

        <div style="margin: 25px 0 25px 0;">
            <table>
                <tr>
                    <td>NAMA RS/PKM</td>
                    <td>:</td>
                    <td>{{ $rumahSakit->nama }}</td>
                </tr>
                <tr>
                    <td>JENIS RAWAT</td>
                    <td>:</td>
                    <td>{{ $jenis_rawat }}</td>
                </tr>

                <tr>
                    <td>BULAN RAWAT</td>
                    <td>:</td>
                    <td>{{ $bulan[0] }}</td>
                </tr>
                <tr>
                    <td>TAHUN</td>
                    <td>:</td>
                    <td>{{ $tahun[0] }}</td>
                </tr>
            </table>
        </div>

        <div>
            <table border='1' style="border-collapse: collapse">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NIK</th>
                        <th>NAMA PASIEN</th>
                        <th>NO. SKTM</th>
                        <th>RUJUKAN/IGD</th>
                        <th>NO. RM</th>
                        <th>TGL. MASUK</th>
                        <th>TGL. KELUAR</th>
                        <th>LOS</th>
                        <th>KODE DIAGNOSA</th>
                        <th>TARIF INA CBG'S</th>
                        <th>TARIF RS/PKM</th>
                        <th>BIAYA LAINNYA</th>
                        <th>TOTAL BIAYA</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($pasien as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->no_ktp }}</td>
                        <td>{{ $row->nama_pasien }}</td>
                        <td>{{ $row->no_sktm }}</td>
                        <td>{{ $row->no_rujuk_igd }}</td>
                        <td>{{ $row->pembayaran->no_rm }}</td>
                        <td>{{ $row->tgl_mulairawat }}</td>
                        <td>{{ $row->pembayaran->tgl_keluar }}</td>
                        <td>{{ $row->pembayaran->los }}</td>
                        <td>{{ $row->pembayaranInacbgs->inacbgs->kode }}</td>
                        <td>{{ $row->pembayaran->tarif_inacbgs }}</td>
                        <td>{{ $row->pembayaran->tarif_rs }}</td>
                        <td>{{ $row->pembayaran->biaya_lainnya }}</td>
                        <td>{{ $row->pembayaran->total_biaya}}</td>
                    </tr>
                    @endforeach
                    {{-- @dd( $row->pembayaranInacbgs->inacbgs->kode) --}}
                    <tr>
                        <td colspan='10' style="text-align: center">JUMLAH</td>
                        <td>{{ number_format($totalTarifInacbgs, 0, '.', ',') }}</td>
                        <td>{{ number_format($totalTarifRs, 0, '.', ',') }}</td>
                        <td>{{ number_format($totalBiayaLainnya, 0, '.', ',') }}</td>
                        <td>{{ number_format($jumlahTotalBiaya, 0, '.', ',') }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div style="float: right; margin: 50px 15px 0 0">
            <p>Bogor, ...................</p>
            <p>Pejabat berwenang, RS / PKM</p>
            <p style="margin-top: 65px">NAMA : </p>
            <p>NIP : </p>
        </div>

    </div>
</body>

</html>