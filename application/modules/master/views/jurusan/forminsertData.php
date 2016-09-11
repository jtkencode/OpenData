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
                  <form class="form-inline" role="form" id="frmadd" action="<?php echo base_url() ?>master/jurusan/simpan" method="POST">
											<div class="form-group">
													<input type="text" name="namajurusan" class="form-control" placeholder="nama jurusan" value="<?php echo $namajurusan;?>">
											</div>
											<div class="form-group">
                          <input type="hidden" name="idjurusan" class="form-control" placeholder="id Jurusan" value="<?php echo $idjurusan; ?>">
                      </div><br></br>

                      <div class="form-group">
                          <input type="submit" class="btn btn-success"  value="Submit">
                      </div>
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
