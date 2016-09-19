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
						<a class="btn btn-primary btn-md" href="<?php echo base_url();?>master/perusahaan/addPerusahaan">
							<i class="fa fa-plus"></i> Tambah
						</a> <br></br>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Daftar <?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<th>Nama Perusahaan</th>
									<th>Email Perusahaan</th>
									<th>No Telepon</th>
									<th>Alamat Perusahaan</th>
									<th>Bidang Pekerjaan</th>
									<th style="width: 10%">Aksi</th>
								</tr>
								<?php
									if(!empty($dataPerusahaan)):
										foreach ($dataPerusahaan as $dataPerusahaan):
								?>
								<tr>
									<td>
										<?php echo $dataPerusahaan['no'];?>
									</td>
									<td>
										<?php echo $dataPerusahaan['nama'];?>
									</td>
									<td>
										<?php echo $dataPerusahaan['email'];?>
									</td>
									<td>
										<?php echo $dataPerusahaan['notelp'];?>
									</td>
									<td>
										<?php echo $dataPerusahaan['alamat'];?>
									</td>
									<td>
										<?php echo $dataPerusahaan['bidang'];?>
									</td>
									<td style="width: 20%">
										<a class="btn btn-default btn-xs" href="<?php echo $dataPerusahaan['href_edit'];?>">
											<i class="fa fa-pencil"></i> Ubah
										</a>
										<a class="btn btn-danger btn-xs" href="<?php echo $dataPerusahaan['href_delete'];?>"title="Hapus">
											<i class="glyphicon glyphicon-trash"></i> Hapus
										</a>
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


</body>
</html>
