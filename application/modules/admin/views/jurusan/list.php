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
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Daftar <?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<th>Nama Jurusan</th>
									<th style="width: 10%">Aksi</th>
								</tr>
								<?php
									if(!empty($dataJurusan)):
										foreach ($dataJurusan as $dataJurusan):
								?>
								<tr>
									<td>
										<?php echo $dataJurusan['no'];?>
									</td>
									<td>
										<?php echo $dataJurusan['nama'];?>
									</td>
									<td style="width: 20%">
										<a class="btn btn-xs btn-primary" href="<?php echo $dataJurusan['href_view'];?>">
											<i class="fa fa-eye"></i> Lihat
										</a>
										<a class="btn btn-default btn-xs" href="<?php echo $dataJurusan['href_edit'];?>">
											<i class="fa fa-pencil"></i> Ubah
										</a>
										<button class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Hapus</button>
									</td>
								</tr>
								<?php
										endforeach;
									else:
								?>
								<tr>
									<td colspan="3">Tidak ada data.</td>
								</tr>
								<?php
									endif;
								?>
							</table>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix">
							<?php echo $halaman;?>
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->