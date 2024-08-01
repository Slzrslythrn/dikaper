<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Tanda Terima</title>

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
        <img src="{{ public_path("assets/logokotabogor.gif") }}" width="75px">
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
        <img src="{{ public_path("assets/dikaper.jpeg") }}" width="120px">
    </div>
    <br>
    <br>
    <br>
    <div style="display: block; margin-top: 12px;">
        <img src="{{ public_path("assets/line.png") }}" width="100%">
    </div>
    <div class="invoice-box">
        <div>
            <h2><b>Data Pasien</b></h2>
            <hr style="margin-top: -10px;">
            <div>
                <span>Nama Pasien : {{ $pasien->nama_pasien }}</span> <br>
                <span>No KTP : {{ $pasien->no_ktp }}</span> <br>
                <span>No Kartu Keluarga : {{ $pasien->no_kk }}</span>
            </div>
            <br>
            <br>
            @if ($pasien->ket_jamkesda == 'kekerasan')
                <h4 style="margin-top: -15px">SYARAT PENJAMINAN JAMKESDA PASIEN KEKERASAN</h4>
                <hr style="margin-top: -10px;">
                <ol>
                    <li> Fotocopy KTP (Warga Kota Bogor)</li>
                    <li> Fotocopy Kartu Keluarga (Warga Kota Bogor)</li>
                    <li> SKTM di tandatangani kelurahan (asli)</li>
                    <li> Surat Rujukan rawat inap dari Puskesmas atau IGD RS (asli)</li>
                    <li> Surat Keterangan rawat inap kelas 3 dari RS (asli)</li>
                    <li> Persetujuan dari pihak RS menggunakan jaminan SKTM di tandatangani oleh pihak RS (asli)</li>
                    <li> Mendaftarkan BPJS Kesehatan kelas 3 dan usulan PBI APBD Kota Bogor</li>
                    <li> Membawa materai untuk mengisi surat pernyataan bahwa jamkesda hanya 1 kali</li>
                    <li> Membuat surat tanda bukti lapor dari kepolisian (asli) ( khusus Pasien kekerasan )</li>
                    <li> Pengurusan Jamkesda maksimal 3x24 jam, jika pengurusan belum selesai maka di tambahkan 2x24
                        jam,
                        berkoordinasi dengan pihak Rumah Sakit dan Dinas Kesehatan</li>
                    <li> Pengurusan Jamkesda lebih dari waktu yang telah di tetapkan maka jamkesda tidak bisa dicover /
                        dijamin</li>
                    <li> Kepengurusan jamkesda wajib di urus oleh keluarga inti di dalam kartu keluarga pasien.</li>
                </ol>
            @elseif ($pasien->ket_jamkesda == 'meninggal')
                <h4 style="margin-top: -15px">SYARAT PENJAMINAN JAMKESDA PASIEN MENINGGAL</h4>
                <hr style="margin-top: -10px;">
                <ol>
                    <li>Fotocopy KTP (Warga Kota Bogor)</li>
                    <li> Fotocopy Kartu Keluarga (Warga Kota Bogor)</li>
                    <li>SKTM di tandatangani kelurahan (asli)</li>
                    <li>Surat Rujukan rawat inap dari Puskesmas atau IGD RS (asli)</li>
                    <li> Surat Keterangan rawat inap kelas 3 dari RS (asli)</li>
                    <li>Persetujuan dari pihak RS menggunakan jaminan SKTM di tandatangani oleh pihak RS (asli)</li>
                    <li> Mendaftarkan BPJS Kesehatan kelas 3 dan usulan PBI APBD Kota Bogor</li>
                    <li> Membawa materai untuk mengisi surat pernyataan bahwa jamkesda hanya 1 kali</li>
                    <li> Melampirkan surat keterangan kematian (khusus pasien meninggal)</li>
                    <li>Pengurusan Jamkesda maksimal 3x24 jam, jika pengurusan belum selesai maka di tambahkan 2x24 jam,
                        berkoordinasi dengan pihak Rumah Sakit dan Dinas Kesehatan</li>
                    <li> Pengurusan Jamkesda lebih dari waktu yang telah di tetapkan maka jamkesda tidak bisa dicover /
                        dijamin</li>
                    <li> Kepengurusan jamkesda wajib di urus oleh keluarga inti di dalam kartu keluarga pasien.</li>
                </ol>
            @elseif ($pasien->ket_jamkesda == 'bencana')
                <h4 style="margin-top: -15px">SYARAT PENJAMINAN JAMKESDA PASIEN BENCANA</h4>
                <hr style="margin-top: -10px;">
                <ol>
                    <li>Fotocopy KTP (Warga Kota Bogor)</li>
                    <li> Fotocopy Kartu Keluarga (Warga Kota Bogor)</li>
                    <li> Surat keterangan korban beencana di tandatangani kelurahan (asli)</li>
                    <li> Surat Rujukan rawat inap dari Puskesmas atau IGD RS (asli)</li>
                    <li> Surat Keterangan rawat inap kelas 3 dari RS (asli)</li>
                    <li> Persetujuan dari pihak RS menggunakan jaminan SKTM di tandatangani oleh pihak RS (asli)</li>
                    <li> Mendaftarkan BPJS Kesehatan kelas 3 dan usulan PBI APBD Kota Bogor</li>
                    <li> Membawa materai untuk mengisi surat pernyataan bahwa jamkesda hanya 1 kali</li>
                    <li> Pengurusan Jamkesda maksimal 3x24 jam, jika pengurusan belum selesai maka di tambahkan 2x24
                        jam,
                        berkoordinasi dengan pihak Rumah Sakit dan Dinas Kesehatan</li>
                    <li>Pengurusan Jamkesda lebih dari waktu yang telah di tetapkan maka jamkesda tidak bisa dicover /
                        dijamin</li>
                    <li> Kepengurusan jamkesda wajib di urus oleh keluarga inti di dalam kartu keluarga pasien.</li>
                </ol>
            @elseif ($pasien->ket_jamkesda == 'pmks')
                <h4 style="margin-top: -15px">SYARAT PENJAMINAN JAMKESDA PASIEN PMKS</h4>
                <hr style="margin-top: -10px;">
                <ol>
                    <li>Surat keterangan dari kelurahan (asli)</li>
                    <li> Surat Rujukan rawat inap dari Puskesmas atau IGD RS (asli)</li>
                    <li>Surat Keterangan rawat inap kelas 3 dari RS (asli)</li>
                    <li>Persetujuan dari pihak RS menggunakan jaminan SKTM di tandatangani oleh pihak RS (asli)</li>
                    <li> Melampirkan surat keterangan dari Dinas Sosial ( khusus Pasien PMKS )</li>
                    <li> Pengurusan Jamkesda maksimal 3x24 jam, jika pengurusan belum selesai maka di tambahkan 2x24
                        jam,
                        berkoordinasi dengan pihak Rumah Sakit dan Dinas Kesehatan</li>
                    <li> Pengurusan Jamkesda lebih dari waktu yang telah di tetapkan maka jamkesda tidak bisa dicover /
                        dijamin</li>
                    <li> Kepengurusan jamkesda di urus oleh tagana dari Dinas Sosial</li>
                </ol>
            @endif

        </div>
    </div>
    <footer>
        <img src="data:image/png;base64, {!! $qrcode !!}" style="float: right;  margin-top: 40px">
        <h5><b>* Catatan</b></h5>
        <ol style="margin-top: -40px">
            <li>Silahkan datang ke Dinas Kesehatan Untuk Proses Verifikasi dengan Membawa Tanda Terima </li>
            <li style="margin-top: -10px">Dokumen kelengkapan persyaratan harap dibawa saat verifikasi</li>
        </ol>
    </footer>
    {{-- <div class="page-break"></div>
    <div>
        <h2><b>* Catatan</b></h2>
        <hr style="margin-top: -10px;">
        <ol>
            <li>Silahkan datang ke Dinas Kesehatan Untuk Proses Verifikasi dengan Membawa Tanda Terima </li>
            <li>Dokumen kelengkapan persyaratan harap dibawa saat verifikasi</li>
        </ol>
    </div> --}}
</body>

</html>
