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

<div class="container-fluid" style="position: relative; margin-top: 60px;">
	<div class="container">
		<div style="margin-top: 70px; margin-bottom:-20px">
			<ol class="breadcrumb">
			  <li><?php echo anchor('home_index', 'Home', 'title=""'); ?></li>
			  <li class="active">Chart</li>
			</ol>
		</div>
		<div class="col-md-12 page-header"><h2 style="margin-bottom: 7px;">Grafik Lulusan POLBAN</h2></div>
		
		<div class="col-md-12" style="margin-bottom: 40px;">
			<p style="text-align: center">Pada POLBAN Open Data ini kami menyediakan grafik lulusan POLBAN yang disajikan berdasarkan kategori tertentu.</p>
		</div>
		
		<div class="col-md-6" style="margin-bottom: 40px;">
			<div id="chart_jurusan"></div>
		</div>
		
		<div class="col-md-6" style="margin-bottom: 90px">
			<div id="chart"></div>
		</div>
		
		<div class="col-md-12" style="margin-bottom: 20px">
		<p style="text-align: center;">Berikut merupakan grafik yang dapat menampilkan grafik mengenai pekerjaan dari lulusan POLBAN berdasarkan jurusan tertentu.
		Silakan pilih tahun angkatan dan jurusan untuk menampilkan grafik.</p>
		</div>
		
		<div class="col-md-12" style="margin-bottom: 30px; background-color:#eeeeee; padding: 30px 20px 30px 20px">
		<?php echo form_open(''); ?>
		<form action="" method="POST">
		<div class="col-md-4">
		Pilih Angkatan: 
			<select name="angkatan" class="form-control input-sm">
				<?php foreach($angk as $angkatan){ ?>
				<option value="<?php echo $angkatan->TAHUN_MASUK; ?>"><?php echo $angkatan->TAHUN_MASUK; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-4">
		Pilih Jurusan:
			<select name="jurusan" class="form-control input-sm">
				<?php foreach($gjur as $jurusan){ ?>
				<option value="<?php echo $jurusan->ID_JURUSAN; ?>"><?php echo $jurusan->NAMA_JURUSAN; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-4">
		<br>
			<input type="submit" value="Tampilkan Chart" class="btn btn-primary" style="border-radius: 0!important">
		</div>
		</form>
		</div>
		<div class="col-md-12" style="margin-bottom: 70px">
			<div id="chart_pekerjaan"></div>
		</div>
	</div>
</div>
</body>
</html>