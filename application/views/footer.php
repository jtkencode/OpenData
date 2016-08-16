<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/styleF.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/bootstrap.css'); ?>">
	<script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>

</head>
<body>

<!-- FOOTER -->
<div class="container-fluid" style="background-color: #212121">
	<div class="container">
		<div class="col-md-12" style="padding: 20px 20px 20px 0px; color: #fff">
			<span class="pull-right"><?php echo $this->config->item('footer');?> | <?php echo $this->config->item('title');?></span>
		</div>
	</div>
</div>

</body>
</html>
