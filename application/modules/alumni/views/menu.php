<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo (!empty($akunInfo['FOTO'])) ? base_url('assets/'.$akunInfo['FOTO']) : base_url('assets/upload/alumni/default.png');?>" class="img-circle" alt="User Image">
				</div>

				<div class="pull-left info">
					<p><?php echo $akunInfo['NAMA_ALUMNI'];?></p>
					<!-- Status -->
					<a href="<?php echo site_url('alumni/profile');?>"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>

			<!-- search form (Optional) 
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form> -->

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu">
				<li class="header">Main Navigation</li>
				<!-- Optionally, you can add icons to the links -->
				<li<?php echo($active_menu=='dashboard')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('alumni');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
				</li>
				
				<li<?php echo($active_menu=='profil')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('alumni/profile');?>"><i class="fa fa-user"></i> <span>Profil</span></a>
				</li>

				<li<?php echo($active_menu=='pekerjaan')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('alumni/pekerjaan');?>"><i class="fa fa-briefcase"></i> <span>Pekerjaan</span></a>
				</li>

				<li<?php echo($active_menu=='karya_ilmiah')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('alumni/karya');?>"><i class="glyphicon glyphicon-glass"></i> <span>Karya Ilmiah</span></a>
				</li>

				<li<?php echo($active_menu=='beasiswa')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('alumni/beasiswa');?>"><i class="fa fa-graduation-cap"></i> <span>Beasiswa</span></a>
				</li>

				<li class="treeview<?php echo($active_menu=='organisasi' || $active_menu=='kompetisi' || $active_menu=='beasiswa')? " active": "";?>">
					<a href="#"><i class="fa fa-history"></i> <span>Riwayat</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li<?php echo($active_menu=='organisasi')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('alumni/riwayat_organisasi');?>"><i class="fa fa-circle-o"></i> Organisasi</a>
						</li>
						<li<?php echo($active_menu=='kompetisi')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('alumni/riwayat_kompetisi');?>"><i class="fa fa-circle-o"></i> Kompetisi</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="<?php echo site_url('alumni/keluar');?>"><i class="fa fa-sign-out"></i> <span>Keluar</span></a>
				</li>
			</ul><!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>