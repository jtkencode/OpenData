<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POLBAN Open Data - Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="<?php echo base_url('assets/vendor/magnific-popup/magnific-popup.css'); ?>" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?php echo base_url('assets/css/creative.min.css'); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<style>
		.btn-none a:hover{
			text-decoration:none;
		}
		.lk a{
			color: #fff!important;
		}
	</style>
</head>

<body id="page-top">

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">POLBAN Open Data</h1>
                <hr>
                <p style="color:#fff"><strong><i>"Assuring Your Future when we united and connected"</i></strong><br><br>
				Jelajahi informasi seputar kemahasiswaan & Alumni yang mungkin belum kamu ketahui Disini!</p>
				
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Explore!</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">POLBAN Open Data</h2>
                    <hr class="light">
                    <p class="text-faded">
					Polban Open Data adalah salah satu  perwujudan dari Smart Campus yang didambakan oleh setiap mahasiswa 
					dimana aplikasi ini menjadi pangkalan data yang mencatat riwayat. Open Data adalah suatu konsep tentang 
					data yang tersedia secara bebas untuk diakses dan dimanfaatkan oleh masyarakat. 
					</p><br>
                    <span class="page-scroll btn btn-default btn-xl sr-button btn-none">
					<?php echo anchor('home_index/about', 'Baca Selengkapnya', 'title=""'); ?></span>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-max fa-bar-chart text-primary sr-icons"></i>
                        <h3>Grafik Alumni</h3>
                        <p class="text-muted">Data jumlah alumni yang disajikan dalam bentuk grafik.</p>
                        <span class="btn btn-primary btn-xl btn-none lk page-scroll" style="margin-top: 50px; color: #fff">
              					<?php echo anchor('home_index/chart', 'Lihat Data', 'title=""'); ?></span>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-max fa-list-alt text-primary sr-icons"></i>
                        <h3>Data Alumni</h3>
                        <p class="text-muted">Menampilkan list data alumni.</p>
                        <span class="btn btn-primary btn-xl btn-none lk page-scroll" style="margin-top: 74px; color: #fff">
              					<?php echo anchor('/mahasiswa', 'Lihat Data', 'title=""'); ?></span>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-max fa-user text-primary sr-icons"></i>
                        <h3>Profile Alumni</h3>
                        <p class="text-muted">Menampilkan profile lengkap alumni</p>
                        <span class="btn btn-primary btn-xl btn-none lk page-scroll" style="margin-top: 74px; color: #fff">
              					<?php echo anchor('/alumni', 'Lihat Data', 'title=""'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<section id="testimonials" style="background-image: url('<?php echo base_url('assets/img/section.jpg'); ?>'); position:relative; width:100%;">
        <div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2 class="section-heading" style="color: #fff">Testimonials</h2>
					<hr class="primary">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
			<?php
			{ ?>

				<div class="col-md-4" style="padding-right: 40px">
					<img class="img-circle" src="<?php echo base_url('assets/img/logo_polban.jpg'); ?>" width="90px" align="left" style="margin-right: 20px; margin-bottom: 5px;">
					<span style="color: #fff; font-weight: bold; font-size: 13pt;">Dr. Iwan Mulyawan</span><br>
					<span style="color: #fff; font-style: italic;">(Ketua Jurusan Administrasi Niaga POLBAN)</span><br><br>
					<p style="color: #fff; font-size: 10pt; text-align: justify"></br>Open Data POLBAN, menurut saya adalah salah satu hal luar biasa yang 
					dimiliki oleh POLBAN terlebih lagi karya ini diciptakan oleh Mahasiswa yang sangat peduli dengan perkembangan civitas akademika 
					POLBAN. Open Data yang saya lihat disini juga akan memberikan manfaat bukan hanya bagi Mahasiswa saja, namun bagi civitas 
					akademika secara umumnya. Semoga Open Data dapat terus  dikembangkan menjadi lebih baik lagi</p>
				</div>
				<div class="col-md-4" style="padding-right: 40px">
					<img class="img-circle" src="<?php echo base_url('assets/img/logo_polban.jpg'); ?>" width="90px" align="left" style="margin-right: 20px; margin-bottom: 5px;">
					<span style="color: #fff; font-weight: bold; font-size: 13pt;">Dr. Omar Dani Sopandi, S.Sos., M.Pd.</span><br>
					<span style="color: #fff; font-style: italic;">(Pelindung  DEV Community, Ketua Kearsipan POLBAN)</span><br><br>
					<p style="color: #fff; font-size: 10pt; text-align: justify">&emsp;&emsp;&emsp;&emsp;Jarang Sekali saya menemukan organisasi atau mahasiswa yang ingin 
					mengabdi untuk kepentingan dan kemajuan kampusnya sendiri, saat ini mahasiswa kadang hanya sekedar ingin menikmati fasilitas saja, 
					tidak ingin untuk menciptakan bahkan merawat fasilitas tersebut. Namun beda halnya dengan DEV Community, suatu kumpulan mahasiswa 
					yang inigin memajukkan kampusnya, tapi saya melihat ini adalah suatu kerjasama bukan hanya dari satu organisasi saja, tetapi 
					didukung pula oleh JTK POLBAN. Harapannya Open Data ini bisa memberikan manfaat bagi para mahasiswa yang mencari tempat PKL 
					ataupun link untuk bekerja saat mereka telah lulus kuliah</p>
				</div>
				<div class="col-md-4" style="padding-right: 40px">
					<img class="img-circle" src="<?php echo base_url('assets/img/logo_polban.jpg'); ?>" width="90px" align="left" style="margin-right: 20px; margin-bottom: 5px;">
					<span style="color: #fff; font-weight: bold; font-size: 13pt;">Aldi Pahlevi</span><br>
					<span style="color: #fff; font-style: italic;">(Ketua BEM KEMA POLBAN 2015-2016)</span><br><br>
					<p style="color: #fff; font-size: 10pt; text-align: justify"></br>Mahasiswa seharusnya memang bekerjasama melakukan hal yang luar biasa,
					contohnya seperti DEV bekerjasama dengan HIMAKOM POLBAN berbahubahu mengembangkan Open Data yang nantinya untuk konsumsi semua 
					pihak, kegiatan ini harus selalu didukung oleh KEMA POLBAN dan Manajemen POLBAN.</p>
				</div>
				
			<?php } ?>
			</div>
		</div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <hr class="primary">
                    <p>Jl. Gegerkalong Hilir, Desa Ciwaruga, Parongpong, Kabupaten Bandung Barat, Jawa Barat 40012, Indonesia</p>
                </div>
                <div class="col-md-6 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>0878 2574 3154</p>
                </div>
                <div class="col-md-6 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:your-email@your-domain.com">bersamadev@gmail.com</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php echo base_url('assets/vendor/scrollreveal/scrollreveal.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>

    <!-- Theme JavaScript -->
    <script src="<?php echo base_url('assets/js/creative.min.js'); ?>"></script>

</body>

</html>
