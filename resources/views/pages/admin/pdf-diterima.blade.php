<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Diterima</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            /* color: #555; */
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(4) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice-box table tr.total td:nth-child(3) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

        #gambar {
            float: left;
        }

        /* #gambar2 {
            float: right;
        } */

        #content {
            margin-left: 30px;
            margin-right: 20px;
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }

        .tatacara {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        footer {
            position: fixed;
            bottom: 30px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            color: black;
            /* text-align: center; */
            line-height: 35px;
        }
    </style>
</head>

<body>
    <div id="gambar">
        {{-- <img src="{{ public_path(" assets/logokotabogor.gif") }}" width="75px"> --}}
        <img src="data:image/gif;base64,{{ $logoKotaBogor }}" width="75px">
    </div>
    <div id="content" style="margin-top: 20px" style="float: left">
        <div style="font-size: 18px; font-weight: bold">PEMERINTAH DAERAH KOTA BOGOR</div>
        <div style="font-size: 18px; font-weight: bold">DINAS KESEHATAN
        </div>
        <div style=" font-size: 14px;">
            JALAN R.M. TIRTO ADHI SOERJO NO.04, RT.02/RW.02, TANAH SAREAL, <br> KEC. TANAH SEREAL, KOTA BOGOR, JAWA
            BARAT 16161<br>
        </div>
    </div>
    <div id="gambar2">
        <img src="data:image/jpeg;base64,{{ $logoDikaper }}" width="120px">
    </div>
    <br>
    <br>
    <br>
    <div style="display: block; margin-top: 14px;">
        <img src="data:image/png;base64,{{ $lineImage }}" width="100%">
    </div>

    <table width="100%" border="0" style="font-size: 14px">
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td>
                Bogor, {{ $pasien->tgl_diterima }}
            </td>
        </tr>
        <tr>
            <td width="60">No</td>
            <td colspan="2" width="299"> : {{ $pasien->no_peserta }}</td>
            <td>&nbsp;Kepada Yth,</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td colspan="2">: 1 (Satu) Bendel</td>
            <td rowspan="2">
                Direktur {{ $pasien->rumahsakit->nama ?? '' }}<br> &nbsp;{{ $pasien->rumahsakit->alamat ?? '' }}
            </td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td colspan="2"> : Surat Jaminan Pelayanan</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"> </td>
            <td>&nbsp;&nbsp;di Bogor</td>
        </tr>
    </table>

    <p style="font-size: 14px">Dengan hormat,<br>
        Dari hasil penelitian kami atas surat-surat dari :</p>
    <table width="700px" style="font-size: 14px">
        <tr>
            <td>Nama Pasien</td>
            <td width="20">:</td>
            <td>{{ $pasien->nama_pasien }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $pasien->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>No. SKTM</td>
            <td>:</td>
            <td>{{ $pasien->no_sktm }}</td>
        </tr>
        <tr>
            <td>Tempat, Tanggal lahir</td>
            <td>:</td>
            <td>{{ $pasien->tempat_lahir }}, {{ $pasien->tanggal_lahir->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td>Tanggal Mulai Rawat</td>
            <td>:</td>
            <td>{{ $pasien->tgl_mulairawat }}</td>
        </tr>
        <tr>
            <td>Alamat Rumah</td>
            <td>:</td>
            <td>{{ $pasien->alamat }} KELURAHAN: {{ $pasien->kelurahan->kelurahan_nama }} </td>
        </tr>
        <tr>
            <td>Puskesmas</td>
            <td>:</td>
            <td>{{ $pasien->nama_pkm }}</td>
        </tr>
    </table>
    <p style="font-size: 14px">Ternyata pasien tersebut memenuhi syarat :</p>
    <table width="700px" style="font-size: 14px">
        <tr>
            <td>Dirawat di kelas</td>
            <td width="20">:</td>
            <td>{{ $pasien->dikelas }} {{ $pasien->nama_pkm }}</td>
        </tr>
        <tr>
            <td>Diagnosa</td>
            <td>:</td>
            <td>{{ $pasien->diagnosa }}</td>
        </tr>
        <tr>
            <td>Diberikan jaminan terhitung sejak</td>
            <td>:</td>
            <td width="200"><u>{{ $pasien->dijamin_sejak->isoFormat('D MMMM Y') }} s/d Selesai perawatan</u></td>
        </tr>
    </table>
    <p style="font-size: 14px; text-align: justify; text-justify: inter-word;">Untuk mendapatkan jaminan pelayanan
        kesehatan selama dalam pemeriksaan / perawatan /
        pengobatan lebih lanjut. Mohon biaya <u>{{ $pasien->jenis_rawat }}</u> ditagihkan ke
        Dinas Kesehatan Kota
        Bogor
        dengan menggunakan tarif INA-CBG. Biaya tersebut diajukan oleh Rumah Sakit melalui klaim kolektif sebelum
        tanggal 10 bulan berikutnya.
    </p>
    <p style="font-size: 14px">Atas perhatian serta kerjasama Saudara, kami ucapkan terima kasih.</p>
    <table width="100%" style="text-align: center; font-size: 14px" border="0">
        <tr>
            <td width="300"></td>
            <td>
                <img src="data:image/jpg;base64,{{ $ttdImage }}" width="100%" />
                {{-- <b>An. Kepala Dinas Kesehatan <br>Kota Bogor<br>
                    Kepala Seksi Pelayanan Kesehatan Rujukan <br>dan Jaminan Kesehatan</b>
                <br><br><br><br><br><br>
                <b><u>dr. Tri Yuliani. M.Kes</u></b><br>
                NIP. 19751124 200701 2018 <br> --}}
            </td>
        </tr>
    </table>

    <p><u>Tembusan</u> : Yth. Walikota Bogor (Sebagai Laporan)</p>

    <footer>
        <img src="data:image/png;base64, {!! $qrcode !!}" style="float: right;  margin-top: 40px">
        <ol style="margin-top: -40px">
        </ol>
    </footer>

</body>

</html>