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
						<a class="btn btn-default btn-md" href="<?php echo base_url();?>admin/alumni/addAlumni">
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
									<th>Nama Alumni</th>
									<th>Prodi</th>
									<th>Tahun Masuk</th>
									<th>Tahun Keluar</th>
									<th>Email Alumni</th>
									<th>NO HP</th>
									<th>Alamat</th>
									<th>Pekerjaan</th>
									<th style="width: 10%">Aksi</th>
								</tr>
								<?php
									if(!empty($dataAlumni)):
										foreach ($dataAlumni as $dataAlumni):
								?>
								<tr>
									<td>
										<?php echo $dataAlumni['no'];?>
									</td>
									<td>
										<?php echo $dataAlumni['namaAlumni'];?>
									</td>
									<td>
										<?php echo $dataAlumni['namaProdi'];?>
									</td>
									<td>
										<?php echo $dataAlumni['tahunMasuk'];?>
									</td>
									<td>
										<?php echo $dataAlumni['tahunKeluar'];?>
									</td>
									<td>
										<?php echo $dataAlumni['emailAlumni'];?>
									</td>
									<td>
										<?php echo $dataAlumni['noHP'];?>
									</td>
									<td>
										<?php echo $dataAlumni['alamatAlumni'];?>
									</td>
									<td>
										<?php echo $dataAlumni['pekerjaan'];?>
									</td>
									<td style="width: 20%">
										<a class="btn btn-xs btn-primary" href="<?php echo $dataAlumni['href_view'];?>">
											<i class="fa fa-eye"></i> Lihat
										</a>
										<a class="btn btn-default btn-xs" href="<?php echo $dataAlumni['href_edit'];?>">
											<i class="fa fa-pencil"></i> Ubah
										</a>
										<a class="btn btn-danger btn-xs" href="<?php echo $dataAlumni['href_delete'];?>"title="Hapus">
											<i class="glyphicon glyphicon-trash"></i> Delete
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
