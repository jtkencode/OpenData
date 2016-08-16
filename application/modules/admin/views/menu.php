<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo base_url('assets/img/logo_polban.png');?>" class="img-circle" alt="User Image">
				</div>

				<div class="pull-left info">
					<p><?php echo $akunInfo['USERNAME'];?></p>
					<!-- Status -->
					<a href="<?php echo site_url('admin/profile');?>"><i class="fa fa-circle text-success"></i> Online</a>
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
					<a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
				</li>

				<?php if($this->session->userdata('hak')=='admin'): ?>
				<li class="treeview<?php echo($active_menu=='jurusan' || $active_menu=='prodi')? " active": "";?>">
					<a href="#"><i class="fa fa-graduation-cap"></i> <span>Jurusan</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li<?php echo($active_menu=='jurusan')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('admin/jurusan');?>">Daftar Jurusan</a>
						</li>
						<li<?php echo($active_menu=='prodi')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('admin/prodi');?>">Daftar Prodi</a>
						</li>
					</ul>
				</li>
				<?php endif; ?>

				<li<?php echo($active_menu=='alumni')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('admin/alumni');?>"><i class="fa fa-user"></i> <span>Alumni</span></a>
				</li>

				<?php if($this->session->userdata('hak')=='admin'): ?>
				<li<?php echo($active_menu=='perusahaan')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('admin/perusahaan');?>"><i class="fa fa-briefcase"></i> <span>Perusahaan</span></a>
				</li>

				<li<?php echo($active_menu=='user' || $active_menu=='user_ubah' || $active_menu=='user_tambah')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('admin/user');?>"><i class="fa fa-user"></i> <span>Pengguna</span></a>
				</li>
				<?php endif; ?>
				<!-- <li class="treeview">
					<a href="#"><i class="fa fa-link"></i> <span>Shop</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li>
							<a href="#">Link in level 2</a>
						</li>
						<li>
							<a href="#">Link in level 2</a>
						</li>
					</ul>
				</li> -->

				<li>
					<a href="<?php echo site_url('admin/keluar');?>"><i class="fa fa-sign-out"></i> <span>Keluar</span></a>
				</li>
			</ul><!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>