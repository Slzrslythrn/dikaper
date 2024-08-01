<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dikaper Kota Bogor</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Favicons -->
    <link href="https://kotabogor.go.id/{{ asset('assets/front/img/landing_baru/logo.png') }}" rel="icon">
    <link href="https://kotabogor.go.id/{{ asset('assets/front/img/landing_baru/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/front/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">
</head>

<body>


    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">
           
            <h1 class="logo me-auto"> <img src="{{ asset('assets/dikaper.png') }}" alt="" class="img-fluid"> <img src="{{ asset('assets/logokotabogor.gif') }}" alt="" class="img-fluid"><a href="#">  DIKAPER KOTA BOGOR</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#services">Alur</a></li>
                    <li><a class="nav-link scrollto" href="#faq">Persyaratan</a></li>

                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <!--<h1>Pada  kondisi Universal Health Coverage (UHC) Jamkesda hanya  diperuntukkan pada kasus yang tidak dijamin oleh BPJS atau Penjamin Lainnya sesuai peraturan yang berlaku.</h1>-->
                    <h2>Pada  kondisi Universal Health Coverage (UHC) Jamkesda hanya  diperuntukkan pada kasus yang tidak dijamin oleh BPJS atau Penjamin Lainnya sesuai peraturan yang berlaku. Kota Bogor saat ini dalam Kondisi UHC </h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">

                        <a href="https://dikaper.kotabogor.go.id/login" class="glightbox btn-watch-video"><i
                                class="bi bi-play-circle"></i><span>Login / Daftar Akun</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('assets/uhc.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">


        <!-- ======= Skills Section ======= -->
        <section id="skills" class="skills">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{ asset('assets/front/img/skills.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                        <h3>Jamkesda Kota Bogor</h3>
                        <p class="fst-italic">
                            Data Total Jumlah Pengajuan Jaminan Kesehatan Daerah
                        </p>

                        <div class="skills-content">

                            <div class="progress">
                                <span class="skill">2021 <i class="val">100%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">2022 <i class="val">90%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">2023 <i class="val">75%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="75"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End Skills Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Alur JAMINAN KESEHATAN JAMKESDA</h2>
                    <p>ALUR PENGAJUAN JAMINAN KESEHATAN JAMKESDA / SKTM KOTA BOGOR .</p>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div class="icon-box">

                            <h4><a href="">Kelurahan</a></h4>
                            <p>Kelurahan Menerbitkan SKTM</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="icon-box">

                            <h4><a href="">Dinas Sosial</a></h4>
                            <p>Melakukan Verifikasi Lanjutan </p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div class="icon-box">

                            <h4><a href="">Dinas Kesehatan</a></h4>
                            <p>Melakukan Konsolidasi, Pengecekan Data Dan Menerbitkan Surat Ketarangan</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                        data-aos-delay="400">
                        <div class="icon-box">

                            <h4><a href="">Puskesmas atau Rumah Sakit</a></h4>
                            <p>Menerima Surat Keterangan</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">

                <div class="row">
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3>Dikaper Kota Bogor</h3>
                        <p> Jaminan Kesehatan Daerah yang selanjutnya disebut Jamkesda adalah sistem jaminan kesehatan
                            yang pembiayaannya, pengorganisasian dan pelayanan kesehatannya ditetapkan oleh Pemerintah daerah. <br>
                            dan diperuntukan bagi warga miskin kota bogor / korban bencana / orang terlantar.
                        </p>
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle" href="dinkes.kotabogor.go.id">Website</a>
                    </div>
                </div>

            </div>
        </section><!-- End Cta Section -->




        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>PENGAJUAN JAMINAN KESEHATAN JAMKESDA / SKTM KOTA BOGOR</h2>
                    <p>Syarat Pengajuan Jaminan Kesehatan Daerah Pemerintah Kota Bogor</p>
                </div>

                <div class="faq-list">
                    <ul>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">1. Fotocopy
                                Kartu Keluarga (KK) Kota Bogor</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">2. Fotocopy
                                Kartu Tanda Penduduk (KTP Pasien& KTP Kepala Keluarga) Kota Bogor yang masih berlaku</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">3. SKTM (untuk
                                bantuan biaya perawatan di RS) dari kelurahan mengetahui kecamatan</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">4. Surat
                                rujukan dari puskesmas/IGD rumah sakit wilayah bogor (ttd, nama dokter, &stempel)</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">5. Surat
                                keterangan rawat inap dari rumah sakit tempat dirawat (kelas, ruangan, jaminan,
                                diagnosa)</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">6. Surat
                                keterangan/ACC dari RS jaminan SKTM (ttd, nama, &stempel)</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">7. Jika kepala
                                keluarga/ pasien sebagai karyawan/ wiraswasta harus membuat surat penyataan bahwa sudah
                                tidak bekerja/ dijelaskan wiraswastanya apa (materai 10.000)</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">8. Bukti
                                pendaftaran BPJS Kesehatan Kelas 3</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">9. Jika
                                melahirkan: untuk bayi baru lahir dilampirkan surat kelahiran</a>

                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">10. Pada kasus
                                kekerasan dilampirkan laporan/surat kepolisian.</a>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">11. Korban
                                bencana dilampirkan surat keterangan dari kelurahan.</a>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">12. Pada kasus
                                orang terlantar dilampirkan surat keterangan dari dinas sosial dan kelurahan /
                                kepolisian</a>
                        </li>



                    </ul>
                </div>

            </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>

                </div>

                <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Lokasi :</h4>
                                <p>Jalan R.M. Tirto Adhi Soerjo No.04, RT.02/RW.02, Tanah Sareal, Kec. Tanah Sereal,
                                    Kota Bogor, Jawa Barat 16161 Telp:(0251) 8331753</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>dinkes@kotabogor.go.id</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>119</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Wa ESIR:</h4>
                                <p>08111116093</p>
                            </div>

                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6069.216470620241!2d106.799524!3d-6.575832!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x500b6c3db97f562e!2sDinas%20Kesehatan%20Kota%20Bogor!5e1!3m2!1sid!2sid!4v1652088234898!5m2!1sid!2sid"
                                frameborder="0" style="border:0; width: 100%; height: 290px;"
                                allowfullscreen></iframe>
                        </div>

                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Alamat Email Anda</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Subjek Pesan</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Pesan</label>
                                <textarea class="form-control" name="message" rows="10" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Pesan Terkirim kan. Terima Kasih!</div>
                            </div>
                            <div class="text-center"><button type="submit">Kirim Pesan</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">


        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span>Dinas Kesehatan</span></strong>. </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                Pemerintah Kota Bogor</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/front/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
</body>

</html>
