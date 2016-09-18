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

	<style>
	#nav-home a:hover{
		text-decoration:none;
	}
	</style>
	
</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="background-color: #222222">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <span class="navbar-brand page-scroll" id="nav-home">
				<?php echo anchor('home_index', 'POLBAN Open Data', 'title=""'); ?></span>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php echo anchor('home_index/about', 'About', 'title=""'); ?>
                    </li>
                    <li>
                        <?php echo anchor('home_index#services', 'Services', 'title=""'); ?>
                    </li>
                    <li>
                        <?php echo anchor('home_index#testimonials', 'Testimonials', 'title=""'); ?>
                    </li>
                    <li>
                        <?php echo anchor('home_index#contact', 'Contact', 'title=""'); ?>
                    </li>
					<li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login
                      <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo site_url('alumni');?>">Alumni</a></li>
                          <li><a href="<?php echo site_url('admin');?>">Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</body>
</html>