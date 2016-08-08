<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<!-- <img src="<?php echo base_url('assets/upload/user/'.$akunInfo['photo']);?>" class="img-circle" alt="User Image"> -->
				</div>

				<div class="pull-left info">
					<!-- <p><?php echo $akunInfo['first_name'].' '.$akunInfo['last_name'];?></p> -->
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
				
				<li<?php echo($active_menu=='jurusan')? " class=\"active\"": "";?>>
					<a href="<?php echo site_url('admin/jurusan');?>"><i class="fa fa-film"></i> <span>Jurusan</span></a>
				</li>

				<li class="treeview<?php echo($active_menu=='akun' || $active_menu=='grup')? " active": "";?>">
					<a href="#"><i class="fa fa-user"></i> <span>Akun</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li<?php echo($active_menu=='akun')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('admin/akun');?>">Daftar Akun</a>
						</li>
						<li<?php echo($active_menu=='gruo')? " class=\"active\"": "";?>>
							<a href="<?php echo site_url('admin/grup');?>">Grup</a>
						</li>
					</ul>
				</li>

				<li class="treeview">
					<a href="#"><i class="fa fa-link"></i> <span>Shop</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li>
							<a href="#">Link in level 2</a>
						</li>
						<li>
							<a href="#">Link in level 2</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="<?php echo site_url('admin/pengaturan');?>"><i class="fa fa-gear"></i> <span>Pengaturan</span></a>
				</li>
			</ul><!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>