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
							<div class="box-tools">
								<div class="input-group">
									<input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search by name">
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
						</div><!-- /.box-header -->
						<br>
						<div class="row" style="margin-left:5px;">
							<div class="col-xs-6">
								<select name="jurusan" class="form-control">
									<option value="all">Semua</option>
									<?php 
									if(!empty($dataJurusan)):
										foreach($dataJurusan as $dataJurusan): 
									?>
									<option value="<?php echo $dataJurusan['ID_JURUSAN'];?>">
										<?php echo $dataJurusan['NAMA_JURUSAN'];?>
									</option>
									<?php 
										endforeach;
									else:
									?>
									<option>-</option>
									<?php
									endif;
									?>
								</select>
							</div>
						</div>
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<th>Jurusan</th>
									<th>Nama Program Studi</th>
									<th style="width: 10%">Aksi</th>
								</tr>
								<?php
									if(!empty($dataProdi)):
										foreach ($dataProdi as $dataProdi):
								?>
								<tr>
									<td>
										<?php echo $dataProdi['no'];?>
									</td>
									<td>
										<?php echo $dataProdi['nama_jurusan'];?>
									</td>
									<td>
										<?php echo $dataProdi['nama'];?>
									</td>
									<td style="width: 20%">
										<!-- <a class="btn btn-xs btn-primary" href="<?php echo $dataProdi['href_view'];?>">
											<i class="fa fa-eye"></i> Lihat
										</a> -->
										<a class="btn btn-default btn-xs" href="<?php echo $dataProdi['href_edit'];?>">
											<i class="fa fa-pencil"></i> Ubah
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
						<center>
							<a class="btn btn-default" href="<?php echo $href_tambah;?>">
								<i class="fa fa-plus"></i> Tambah
							</a>
						</center>
						<div class="box-footer clearfix">
							<?php echo $halaman;?>
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->