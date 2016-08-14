<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>POLBAN Open Data</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.css'); ?>">
	<script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
	
</head>
<body>
<!-- BODY -->
<!-- HEAD BODY -->
<div class="container-fluid" style="background-image: url('<?php echo base_url('/assets/img/polban.jpg'); ?>');">
	<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
		<div class="col-md-12">
			<img src="<?php echo base_url('/assets/img/logo_polban.png'); ?>" width="300px" align="left" style="margin-right: 50px;">
			<h1 style="color: #FFFFFF; font-family: 'Britannic'; font-size: 30pt; margin-top: -10px;"> POLBAN OPEN DATA </h1>
			<hr style="margin-top: -3px">
			<p style="color: #FFFFFF"><strong>Deskripsi singkat..</strong><br><br><br><br><br><br><br><br><br><br><br><br></p>
			<span class="btn btn-primary btn-anchor pull-right" style="border-radius: 10px; width: 150px; font-weight: bold;">
				<?php echo anchor('home/chart', 'Lihat Data', 'title=""'); ?>
			</span>
		</div>
	</div>
</div>

<!-- TENTANG POLBAN OPEN DATA -->
<div class="container-fluid" style="background-color: #F2F2F2;">
	<div class="container">
		<div class="col-md-3">
			<img src="<?php echo base_url('assets/img/logo_polban.png'); ?>" width="200px" style="margin: 50px 20px 20px 0px;" align="left" />
			<p style="margin: 130px 0px 0px 0px">(gambar logo polban open data?)</p>
		</div>
		<div class="col-md-9" style="margin-top: 50px; margin-bottom: 30px">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">POLBAN Open Data</h3>
				</div>
				<div class="panel-body">
					Deskripsi tentang POLBAN Open Data. Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
					Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla Bla bla bla 
				</div>
			</div>
		</div>
	</div>
</div>

<!-- CHARTS -->
<div class="container-fluid" style="background-color: #FFFFFF;">
	<div class="container" style="margin-top: 20px;">
		<div class="col-md-12 page-header"><h2 style="margin-bottom: 7px;">Grafik Jumlah Lulusan</h2></div>
		<div class="col-md-6" style="border: 1px solid silver; border-radius: 20px;">
			<div id="chart"></div>
		</div>
		<div class="col-md-6" style="border: 1px solid silver; border-radius: 20px;">
			<div id="chart_jurusan"></div>
		</div>
		<div class="col-md-12 text-center">
			<span class="btn btn-primary btn-anchor" style="margin: 50px 0px 50px 0px;">
			<?php echo anchor('home/chart', 'Lihat Data Selengkapnya', 'title=""'); ?>
			</span>
			
		</div>
	</div>
</div>

<!-- TESTIMONIALS -->
<div class="container-fluid" style="background-color: #F2F2F2">
	<div class="container" style="margin-bottom: 50px;">
		<div class="col-md-12 page-header" style="border-bottom: 1px solid #D9D9D9;"><h2 style="margin-bottom: 3px;">Testimonial</h2></div>
		<div class="col-md-4">
			<img src="<?php echo base_url('/assets/img/jun1.jpg'); ?>" class="img-circle media-object" style="width: 80px; margin: 0px 30px 10px 0px;" align="left">
			<span style="font-size:13pt!important"><strong>Kangjun</strong></span><br>
			<span style="font-size:10pt!important">(Jabatan, Angkatan)</span><br><br><br><br>
			<blockquote style="border-left: 5px solid gray; font-size:13pt; font-stretch:condensed; font-style:italic">Isi testimonial.. </blockquote>
		</div>
		
		<div class="col-md-4">
			<img src="<?php echo base_url('/assets/img/jun2.jpg'); ?>" class="img-circle media-object" style="width: 80px; margin: 0px 30px 10px 0px;" align="left">
			<span style="font-size:13pt!important"><strong>Kangjun</strong></span><br>
			<span style="font-size:10pt!important">(Jabatan, Angkatan)</span><br><br><br><br>
			<blockquote style="border-left: 5px solid gray; font-size:13pt; font-stretch:condensed; font-style:italic">Isi testimonial.. </blockquote>
		</div>
		
		<div class="col-md-4">
			<img src="<?php echo base_url('/assets/img/jun1.jpg'); ?>" class="img-circle media-object" style="width: 80px; margin: 0px 30px 10px 0px;" align="left">
			<span style="font-size:13pt!important"><strong>Kangjun</strong></span><br>
			<span style="font-size:10pt!important">(Jabatan, Angkatan)</span><br><br><br><br>
			<blockquote style="border-left: 5px solid gray; font-size:13pt; font-stretch:condensed; font-style:italic">Isi testimonial.. </blockquote>
		</div>
	</div>
</div>

</body>
</html>