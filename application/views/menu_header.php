<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.css'); ?>">
	<script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>

</head>
<body>

<!-- MENU HEADER -->
<nav class="navbar navbar-default" style="box-shadow: 0px -5px 10px #000000; margin-bottom: 2px">
  <div class="container-fluid">
    <div class="container">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?php base_url()?>home" style="height: 110px!important;"><img src="<?php echo base_url('/assets/img/logo_polban.png'); ?>" width="70px" align="left" style="margin-right: 5px;" /></a>
		<span class="navbar-brand" style="text-align: center; margin-top: 20px;">
		<?php echo anchor('home', 'POLBAN<br>OPEN DATA', 'title=""'); ?></span>
    </div>
    <ul class="nav navbar-nav navbar-right" style="margin-top: 30px;">
      <li><?php echo anchor('home/about', 'Tentang Open Data', 'title=""'); ?></li>
      <li><?php echo anchor('home/chart', 'Grafik', 'title=""'); ?></li>
			<li>
				<div class="dropdown" style="margin:8px 10px">
				  <button class="btn btn-primary dropdown-toggle " type="button" id="logindown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				    LoginA
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="logindown">
				    <li><a href="<?php echo site_url('mahasiswa');?>">Mhs Polban</a></li>
						<li role="separator" class="divider"></li>
				    <li><a href="<?php echo site_url('master');?>">Alumni</a></li>
				  </ul>
				</div>
		</li>
    </ul>
  </div>
  </div>
</nav>

</body>
