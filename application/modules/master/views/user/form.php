<script type="text/javascript">
	function loadProdi(){
        var jurusan = $("#jurusan").val();
        $.ajax({
            type:'GET',
            url:"<?php echo site_url('api/getProdi'); ?>",
            data:"id=" + jurusan,
            success: function(html){ 
		    	$(".prodina").css( "display", "inherit" );
				$("#prodi").html(html);
            }
        }); 
    }

</script>

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php echo $title;?>
				<small><?php echo $description;?></small>
			</h1>
			<?php
                            if(!empty($breadcumb)):
                        ?>
                            <ol class="breadcrumb">
                        <?php
                                foreach ($breadcumb as $breadcumb):
                                    if(empty($breadcumb['link'])):
                        ?>
                                        <li class="active"><?php echo $breadcumb['judul'];?></li>
                        <?php
                                    else:
                        ?>
                                        <li>
                                            <a href="<?php echo $breadcumb['link'];?>">
                                                <?php echo $breadcumb['judul'];?>
                                            </a>
                                        </li>
                        <?php
                                    endif;
                                endforeach;
                        ?>
                            </ol>
                        <?php
                            endif;
                        ?>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<?php if(!empty($message)): ?>
			    	<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-warning"></i> Alert!</h4>
						<?php echo $message;?>
					</div>
					<?php endif;?>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#profil" data-toggle="tab">Info</a></li>
						</ul>

						<div class="tab-content">
                  
							<div class="active tab-pane" id="profil">
								<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									
									<div class="form-group">
										<label for="inputUsername" class="col-sm-2 control-label">Username</label>
										<div class="col-sm-10">
											<input type="text" name="username" class="form-control" value="<?php echo (!empty($datana['USERNAME'])) ? $datana['USERNAME'] : '';?>" id="inputUsername" placeholder="151524010">
										</div>
									</div>

									<div class="form-group">
										<label for="inputPass" class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="password" name="pass" class="form-control" value="<?php echo (!empty($datana['PASSWORD_USER'])) ? $datana['PASSWORD_USER'] : '';?>" id="inputPass" placeholder="151524010">
										</div>
									</div>

									<div class="form-group">
										<label for="inputPassConf" class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="password" name="passconf" class="form-control" value="<?php echo (!empty($datana['PASSWORD_USER'])) ? $datana['PASSWORD_USER'] : '';?>" id="inputPassConf" placeholder="151524010">
										</div>
									</div>

									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Jurusan</label>
										<div class="col-sm-10">
											<select name="jurusan" id="jurusan" onchange="loadProdi()" class="form-control">
												<?php foreach ($jurusan as $jurusan): ?>
												<option<?php echo (!empty($datana['idJurusan'])) ? ($datana['idJurusan']==$jurusan['ID_JURUSAN'])?' selected':'' : '';?> value="<?php echo $jurusan['ID_JURUSAN'];?>">
													<?php echo $jurusan['NAMA_JURUSAN'];?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group prodina" <?php echo (empty($datana['ID_PRODI'])) ? "style=\"display:none;\"" : '';?>>
										<label for="inputName" class="col-sm-2 control-label">Program Studi</label>
										<div class="col-sm-10" id="prodi">
											<select name="prodi" class="form-control">
												<?php foreach ($prodi as $prodi): ?>
												<option<?php echo (!empty($datana['idProdi'])) ? ($datana['idProdi']==$prodi['ID_PRODI'])?' selected':'' : '';?> value="<?php echo $prodi['ID_PRODI'];?>">
													<?php echo $prodi['NAMA_PRODI'];?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="inputTahun" class="col-sm-2 control-label">Status</label>
										<div class="col-sm-10">
											<select name="status" class="form-control">
												<option<?php echo (!empty($datana['STATUS'])) ? ($datana['STATUS']==1) ? ' selected':'' : ''; ?> value="1">Admin</option>
												<option<?php echo (!empty($datana['STATUS'])) ? ($datana['STATUS']==2) ? ' selected':'' : ''; ?> value="2">Mahasiswa</option>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input type="submit" class="btn btn-success btn-md" name="simpan" value="Simpan">
										</div>
									</div>
								</form>
							</div><!-- /.tab-pane -->

						</div><!-- /.tab-content -->
					</div><!-- /.nav-tabs-custom -->
					
				</div><!-- /.col -->
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->