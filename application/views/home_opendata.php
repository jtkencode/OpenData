<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.css'); ?>">
	<script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
	
	<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
</head>
<body>

<!-- MENU HEADER -->
<nav class="navbar navbar-default" style="box-shadow: 0px -5px 10px #000000; margin-bottom: 0px;">
  <div class="container-fluid">
    <div class="container">
	<div class="navbar-header">
		<a class="navbar-brand" href="#" style="height: 110px!important;"><img src="<?php echo base_url('/assets/img/logo_polban.png'); ?>" width="70px" align="left" style="margin-right: 5px;" /></a>
		<a class="navbar-brand" href="#" style="text-align: center; margin-top: 20px;">POLBAN</br>OPEN DATA</a>
    </div>
    <ul class="nav navbar-nav navbar-right" style="margin-top: 30px;">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>
  </div>
</nav>

<!-- CAROUSEL HEADER -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="container">
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo base_url('/assets/img/img001.jpg'); ?>" alt="Chania">
	  <div class="carousel-caption">
        <h3>POLBAN</h3>
        <p>Sebuah kampus Politeknik yang berlokasi di Desa Ciwaruga.</p>
      </div>
    </div>

    <div class="item">
      <img src="<?php echo base_url('/assets/img/img002.jpg'); ?>" alt="Chania">
	  <div class="carousel-caption">
        <h3>POLBAN Open Data</h3>
        <p>Website untuk data alumni. Masih dalam tahap pengembangan.</p>
      </div>
    </div>
  </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</body>
</html>