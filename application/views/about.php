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

</head>
<body>

<div class="container-fluid" style="position: relative; margin-top: 40px">
	<div class="container">
		<div style="margin-top: 70px; margin-bottom:-20px">
			<ol class="breadcrumb">
			  <li><?php echo anchor('home_index', 'Home', 'title=""'); ?></li>
			  <li class="active">About</li>
			</ol>
		</div>
		<div class="col-md-12 page-header"><h2 style="margin-bottom: 7px;">Tentang POLBAN Open Data</h2></div>
		<div class="col-md-12" style="margin-bottom: 70px">
		
		<p style="text-align : justify">&emsp;&emsp;&emsp; POLBAN Open Data adalah salah satu  perwujudan dari Smart Campus yang didambakan oleh setiap mahasiswa dimana aplikasi 
		ini menjadi pangkalan data yang mencatat riwayat. Open Data adalah suatu konsep tentang data yang tersedia secara bebas untuk diakses dan 
		dimanfaatkan oleh masyarakat. </p>

		<p style="text-align : justify">&emsp;&emsp;&emsp; POLBAN Open Data sendiri merupakan aplikasi web yang menjadi pengolahan data alumni meliputi Data Pribadi dan dimana mahasiswa tersebut 
		bekerja. Harapannya mahasiswa nantinya mempunyai gambaran lulusan-lulusan dari Jurusannya. Untuk kedepannya tidak hanya mengolah data alumni, 
		tetapi mengolah data skripsi, data perpustakaan dsb. Inti dari sistem Open Data yang kami buat nantinya adalah bagaimana data alumni nantinya 
		diolah dan dimanfaatkan oleh Mahasiswa nantinya.</p>

		<p style="text-align : justify">&emsp;&emsp;&emsp; Program ini diinisiasi oleh DEV dan Himpunan Mahasiswa Komputer (HIMAKOM) sejak Mei 2016. Pengembangan Program terus berlanjut hingga pihak 
		manajemen kampus melirik proyek ini dan mendapatkan sambutan positif. Proyek ini dikembangkan sebagai respon terhadap masih minimnya sistem 
		informasi yang memadai untuk mengakses data kealumnian. Oleh karenanya DEV dan Himakom berusaha mengembangkan kembali Sistem Informasi yang 
		jauh lebih informatif, menarik dan mudah diakses bagi sivitas akademik Polban.</p>
		</div>
		<div class="col-md-6" style="margin-bottom: 100px">
		<table>
			<tr>
				<th>Pelindung</th>
				<td>:</td>
				<td style="padding: 10px">Dr. Omar Dhani</td>
			</tr>
			<tr>
				<th>Koordinator Proyek </th>
				<td>:</td>
				<td style="padding: 10px">Maulana Ilham</td>
			</tr>
			<tr>
				<th>Pengawas Proyek </th>
				<td>:</td>
				<td style="padding: 10px">Dani Finata Pratama & Arifin</td>
			</tr>
			<tr>
				<th>Manajer Proyek</th>
				<td>:</td>
				<td style="padding: 10px">Muhammad Husain Fadhlullah</td>
			</tr>
			<tr>
				<th>Anggota Tim Teknis</th>
				<td>:</td>
				<td style="padding: 5px 10px 5px 10px">Andre Febrianto</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td style="padding: 5px 10px 5px 10px">Eki Fauzi Firdaus</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td style="padding: 5px 10px 5px 10px">Ibnu Ali Muktarom</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td style="padding: 5px 10px 5px 10px">Fadhlan Ridhwanallah</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td style="padding: 5px 10px 5px 10px">Nita Amelia Wijaya</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td style="padding: 5px 10px 5px 10px">Novia Sukmasari Putri</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td style="padding: 5px 10px 5px 10px">Ferdhika Yudira Diputra</td>
			</tr>
		</table>
		</div>
		<div class="col-md-6" style="text-align:center;">
			<img src="<?php echo base_url('assets/img/logo_polban.png'); ?>" width="130px" style="margin-right: 30px">
			<img src="<?php echo base_url('assets/img/dev.png'); ?>" width="150px" style="margin-right: 30px">
			<img src="<?php echo base_url('assets/img/himakom.png'); ?>" width="150px">
		</div>
	</div>
</div>

</body>
</html>