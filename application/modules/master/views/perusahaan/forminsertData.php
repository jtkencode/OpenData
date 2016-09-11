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
				<div class="col-xs-12">
              <div class="well">
								<form class="form-horizontal" action="<?php echo base_url() ?>master/perusahaan/simpan" method="POST">
										<fieldset>
										<!-- Text input-->
										<div class="form-group">
										<label class="col-md-4 control-label" for="namaalumni">Nama Perusahaan</label>
											<div class="col-md-4">
											<input id="namaperusahaan" name="namaperusahaan" type="text" placeholder="Nama" class="form-control input-md" required="" value="<?php echo $namaperusahaan ?>" >
											<input id="idperusahaan" name="idperusahaan" type="hidden" placeholder="Nama" class="form-control input-md" required="" value="<?php echo $idperusahaan ?>">
											</div>
										</div>

										<div class="form-group">
										<label class="col-md-4 control-label" for="namaalumni">Email Perusahaan</label>
											<div class="col-md-4">
											<input id="emailperusahaan" name="emailperusahaan" type="email" placeholder="Email" class="form-control input-md" required="" value="<?php echo $emailperusahaan ?>" >
											</div>
										</div>

										<div class="form-group">
										<label class="col-md-4 control-label" for="namaalumni">No Telepon</label>
											<div class="col-md-4">
											<input id="notelepon" name="notelepon" type="text" placeholder="No Telp" class="form-control input-md" required="" value="<?php echo $notelepon ?>" >
											</div>
										</div>

										<div class="form-group">
										<label class="col-md-4 control-label" for="namaalumni">Alamat Perusahaan</label>
											<div class="col-md-4">
											<input id="alamatperusahaan" name="alamatperusahaan" type="text" placeholder="Alamat" class="form-control input-md" required="" value="<?php echo $alamatperusahaan?>" >
											</div>
										</div>

										<div class="form-group">
										<label class="col-md-4 control-label" for="namaalumni">Bidang Pekerjaan</label>
											<div class="col-md-4">
											<input id="bidangpekerjaan" name="bidangpekerjaan" type="text" placeholder="Bidang" class="form-control input-md" required="" value="<?php echo $bidangpekerjaan ?>" >
											</div>
										</div>

										<div class="form-group" align="center">
												<input type="submit" class="btn btn-success"  value="Submit">
												<a href="OpenData" class="btn btn-primary" role="button">Batal</a>
										</div>
									</fieldset>
									<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</body>
</html>
