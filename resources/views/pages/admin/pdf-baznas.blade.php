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
        <img src="{{ public_path('assets/logokotabogor.gif') }}" width="75px">
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
        <img src="{{ public_path('assets/dikaper.jpeg') }}" width="120px">
    </div>
    <br>
    <br>
    <br>
    <div style="display: block; margin-top: 14px;">
        <img src="{{ public_path('assets/line.png') }}" width="100%">
    </div>

    <table width="100%" border="0" style="font-size: 14px">
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td>
                Bogor, {{ $baznas->tgl_surat }}
            </td>
        </tr>
        <tr>
            <td width="60">Nomor</td>
            <td colspan="2" width="299"> : 460/{{ $baznas->no_surat }}/R-BAZ/2023</td>
            <td>&nbsp;Kepada Yth,</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td colspan="2"> : 1 Berkas</td>
            <td rowspan="2">
                Kepala BAZNAS Kota Bogor
            </td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td colspan="2"> : Rekomendasi Bantuan BAZNAS</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"> </td>
            <td>&nbsp;&nbsp;di Bogor</td>
        </tr>
    </table>

    <p style="font-size: 14px">Dengan hormat,<br>
        Bersama ini kami sampaikan Rekomendasi Bantuan BAZNAS (Badan Amil Zakat Nasional) Kota Bogor untuk mengatasi
        kendala pembiayaan atas :</p>
    <table width="700px" style="font-size: 14px">
        <tr>
            <td>Nama</td>
            <td width="20">:</td>
            <td>{{ $baznas->nama }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $baznas->tgl_lahir }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $baznas->alamat }}</td>
        </tr>
        <tr>
            <td>RT/RW</td>
            <td>:</td>
            <td>{{ $baznas->rt }}/ {{ $baznas->rw }}</td>
        </tr>
        <tr>
            <td>Kelurahan</td>
            <td>:</td>
            <td>{{ $baznas->kelurahan }}</td>
        </tr>
    </table>
    <p style="font-size: 14px">Permasalahan tidak mampu bayar :</p>
    <table width="700px" style="font-size: 14px">
        <tr>
            <td>- Tunggakan BPJS Kesehatan</td>
            <td width="20">:</td>
            <td>{{ $baznas->tunggakan_bpjs }}</td>
        </tr>
        <tr>
            <td>- Denda Layanan Rumah Sakit</td>
            <td>:</td>
            <td>{{ $baznas->denda_layanan }}</td>
        </tr>
    </table>
    <p style="font-size: 14px">Demikian Surat Rekomendasi ini kami sampaikan. Kami mohon BAZNAS Kota Bogor dapat
        memberikan bantuan sesuai ketentuan yang berlaku. Atas bantuan dan kerja samanya kami ucapkan terima kasih.
    </p>
    <table width="100%" style="text-align: center; font-size: 14px" border="0">
        <tr>
            <td width="300"></td>
            <td>
                <b>An. Kepala Dinas Kesehatan <br>Kota Bogor<br>
                    Kepala Seksi Pelayanan Kesehatan Rujukan <br>dan Jaminan Kesehatan</b>
                <br><br><br><br><br><br>
                <b><u>dr. Tri Yuliani. M.Kes</u></b><br>
                NIP. 19751124 200701 2018 <br>
            </td>
        </tr>
    </table>

    <footer>
        <img src="data:image/png;base64, {!! $qrcode !!}" style="float: right;  margin-top: 40px">
        <ol style="margin-top: -40px">
        </ol>
    </footer>

</body>

</html>
