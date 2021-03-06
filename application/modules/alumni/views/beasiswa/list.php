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
					<div id="alert"></div>
					<?php if(!empty($message)): ?>
						<?php echo $message;?>
					<?php endif;?>

					<a class="btn btn-default btn-md" href="<?php echo site_url('alumni/beasiswa/add');?>">
						<i class="fa fa-plus"></i> Tambah
					</a> <br></br>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Daftar <?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">No</th>
									<th>Nama Beasiswa</th>
									<th>Penyelenggara Beasiswa</th>
									<th>Tahun Mulai</th>
									<th>Tahun Selesai</th>
									<th style="width: 10%">Aksi</th>
								</tr>
								<?php
									if(!empty($data)):
										foreach ($data as $data):
								?>
								<tr id="histori<?php echo $data['id_mendapat'];?>">
									<td>
										<?php echo $data['no'];?>
									</td>
									<td>
										<?php echo $data['nama'];?>
									</td>
									<td>
										<?php echo $data['penyelenggara'];?>
									</td>
									<td>
										<?php echo $data['tahun_mulai'];?>
									</td> 
									<td>
										<?php echo $data['tahun_selesai'];?>
									</td> 
									<td style="width: 20%">
										<a class="btn btn-default btn-xs" href="<?php echo $data['href_edit'];?>">
											<i class="fa fa-pencil"></i> Ubah
										</a>
										<a class="btn btn-danger btn-xs" onclick="mdlhapus(<?php echo $data['id_mendapat'];?>)" title="Hapus">
											<i class="glyphicon glyphicon-trash"></i> Hapus
										</a>
									</td>
								</tr>
								<?php
										endforeach;
									else:
								?>
								<tr>
									<td colspan="5">Tidak ada data.</td>
								</tr>
								<?php
									endif;
								?>
							</table>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix">
							<?php echo (!empty($halaman)) ? $halaman : '';?>
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

<script type="text/javascript">
	function view(obj){
		var id = obj;

		$.ajax({
			url:"<?php echo site_url('api/ambilSatuKarya')?>/"+id,
			type:'get',
			dataType: 'json',
			success: function(data) {
				$("#judul").val(data.JUDUL_KARYA_ILMIAH);
				$("#tujuan").val(data.TUJUAN_PEMBUATAN_KARYA);
				$("#thn_selesai").val(data.TAHUN_SELESAI_KARYA);
			}
		});
		$('#modalDetail').modal('show'); // show bootstrap modal
	}

	function mdlhapus(id){
		$("#delIDPek").val(id);
		$('#mdlHapus').modal('show'); // show bootstrap modal
	}

	function hapus(){
		var id = $("#delIDPek").val();
		console.log(id);
		$.post("<?php echo site_url('api/hapusPendapatanBeasiswa');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			id: id
		}, function(res, status) {
			console.log(res);
			if(res.status){
				$("#histori"+id).remove();

				var textAlert;
				textAlert = "<div class=\"alert alert-success alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-check\"></i> Sukses!</h4>";
				textAlert += "	"+res.message;
				textAlert += "</div>";

				$("#alert").append(textAlert);
			}else{
				var textAlert;
				textAlert = "<div class=\"alert alert-warning alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-warning\"></i> Pesan!</h4>";
				textAlert += "	"+res.message;
				textAlert += "</div>";

				$("#alert").append(textAlert);
			}
			console.log(status);
		}, "json");
	}
</script>


<div id="mdlHapus" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<input class="form-control" id="delIDPek" type="hidden" value="0">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Konfirmasi</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						Apakah benar akan di hapus?
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Batal</button>
				<button class="btn btn-sm btn-danger pull-right" onclick="hapus()" data-dismiss="modal">
					<i class="ace-icon fa fa-trash"></i>
					Hapus
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div id="modalDetail" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Karya Ilmiah</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Judul Karya Ilmiah
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" readonly id="judul" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Tujuan Pembuatan Karya
							</label>
						</div>

						<div class="col-md-12">
							<textarea readonly id="tujuan" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Tahun Selesai Karya Ilmiah
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" readonly id="thn_selesai" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>