<!-- Content Wrapper. Contains page content -->

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php echo $title;?>
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
								<form class="form-horizontal" action="<?php echo base_url() ?>admin/alumni/simpan" method="POST">
										<fieldset>

										<!-- Form Name -->
										<legend>Tambah Alumni</legend>

										<!-- Text input-->
										<div class="form-group">
										<label class="col-md-4 control-label" for="namaalumni">Nama Alumni</label>
										<div class="col-md-5">
										<input id="namaalumni" name="namaalumni" type="text" placeholder="Nama" class="form-control input-md" required="" value="<?php echo $namaalumni ?>">

										</div>
										</div>

										<!-- Select Basic -->
										<div class="form-group">
										<label class="col-md-4 control-label" for="PRODI">Prodi</label>
										<div class="col-md-5">
											<select name="namaprodi" class="form-control">
												<option value="" disabled selected></option>
												 <?php foreach($Prodi as $rows){?>
												 <option value="<?=$rows->ID_PRODI?>"><?=$rows->NAMA_PRODI?></option>
												 <?php }?>
											</select>
										</div>
										</div>

										 <!-- Select Basic -->
										<div class="form-group">
										<label class="col-md-4 control-label" for="tahunmasuk">Tahun Masuk</label>
										<div class="col-md-2">
											<select id="tahunmasuk" name="tahunmasuk" class="form-control">
												<option value="2016">--- Pilih Tahun ---</option>
												<?php
													for ($i=2000;$i<=2016;$i++){?>
													<option value="<?=$i?>"><?=$i?></option>
													<?php } ?>
											</select>
										</div>
										</div>

										<!-- Select Basic -->
										<div class="form-group">
										<label class="col-md-4 control-label" for="tahunkeluar">Tahun Keluar</label>
										<div class="col-md-2">
											<select id="tahunkeluar" name="tahunkeluar" class="form-control">
												<option value="2016">--- Pilih Tahun ---</option>
												<?php
													for ($i=2000;$i<=2016;$i++){?>
													<option value="<?=$i?>"><?=$i?></option>
													<?php
												} ?>
											</select>
										</div>
										</div>

										<!-- Text input-->
										<div class="form-group">
											<label class="col-md-4 control-label" for="emailalumni">Email</label>
											<div class="col-md-3">
											<input id="emailalumni" name="emailalumni" type="text" placeholder="Email" class="form-control input-md" required="" value="<?php $emailalumni ?>">

											</div>
										</div>

										<!-- Text input-->
										<div class="form-group">
											<label class="col-md-4 control-label" for="nohp">No HP</label>
											<div class="col-md-2">
											<input id="nohp" name="nohp" type="text" placeholder="nomor HP" class="form-control input-md" required="">

											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 control-label" for="pekerjaan">pekerjaan</label>
											<div class="col-md-2">
											<input id="pekerjaan" name="pekerjaan" type="text" placeholder="pekerjaan" class="form-control input-md" required="">

											</div>
										</div>

										<!-- Textarea -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="alamatalumni">Alamat Alumni</label>
											<div class="col-md-4">
												<textarea class="form-control" id="alamatalumni" name="alamatalumni"></textarea>
											</div>
										</div>
										<input id="idalumni" name="idalumni" type="hidden" placeholder="Nama" class="form-control input-md" required="">

										<div class="form-group" align="center">
												<input type="submit" class="btn btn-success"  value="Submit">
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
