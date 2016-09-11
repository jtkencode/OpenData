<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->config->item('title');?><?php echo (@$title)? ' | '.$title : '';?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo $asset;?>css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo $asset;?>css/font-awesome.min.css">

        <?php
            if(isset($style)):
                foreach ($style as $style):
        ?>
        <link rel="stylesheet" href="<?php echo $style;?>">
        <?php
                endforeach;
            endif;
        ?>
        
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo $asset;?>/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="<?php echo $asset;?>/css/style.css">

        <link rel="stylesheet" href="<?php echo $asset;?>js/jquery.autocomplete.css">

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo $asset;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?php echo $asset;?>js/jquery.autocomplete.js"></script>

        <?php
            if(isset($scriptUp)):
                foreach ($scriptUp as $scriptUp):
        ?>
        <script src="<?php echo $scriptUp;?>"></script>
        <?php
                endforeach;
            endif;
        ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">