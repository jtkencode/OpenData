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
								<form class="form-horizontal" action="<?php echo base_url() ?>master/prodi/simpan" method="POST">
										<fieldset>

											<!-- Select Basic -->
											<div class="form-group">
											<label class="col-md-4 control-label" for="PRODI">Jurusan</label>
											<div class="col-md-4">
												<select name="namajurusan" class="form-control">
													<option value="<?php echo $idjurusan?>"><?php echo $namajurusan ?></option>
													 <?php foreach($Jurusan as $rows){?>
													 <option value="<?=$rows->ID_JURUSAN?>"><?=$rows->NAMA_JURUSAN?></option>
													 <?php }?>
												</select>
											</div>
											</div>

										<!-- Text input-->
										<div class="form-group">
										<label class="col-md-4 control-label" for="namaalumni">Nama Prodi</label>
											<div class="col-md-4">
											<input id="namaprodi" name="namaprodi" type="text" placeholder="Nama" class="form-control input-md" required="" value="<?php echo $namaprodi ?>" >
											<input id="idjurusan" name="idjurusan" type="hidden" placeholder="Nama" class="form-control input-md" required="" value="<?php echo $idjurusan ?>">
											<input id="idprodi" name="idprodi" type="hidden" placeholder="Nama" class="form-control input-md" required="" value="<?php echo $idprodi ?>">
											</div>
										</div>

										<div class="form-group" align="center">
												<input type="submit" class="btn btn-success"  value="Submit">
												<a href="<?php echo site_url('master/prodi');?>" class="btn btn-primary" role="button">Batal</a>
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
