<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> Grafik </title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.css'); ?>">
	<script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
	
</head>
<body>

<div class="container-fluid">
	<div class="container">
		<div class="col-md-12 page-header"><h2 style="margin-bottom: 7px;">Grafik Jumlah Alumni</h2></div>
		<div class="col-md-12" style="margin-bottom: 40px;">
			<div id="chart_jurusan"></div>
		</div>
		<div class="col-md-12" style="margin-bottom: 70px">
			<div id="chart"></div>
		</div>
	</div>
</div>

</body>
</html>