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

					<a class="btn btn-default btn-md" href="<?php echo site_url('alumni/riwayat_kompetisi/add');?>">
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
									<th>Nama Kompetisi</th>
									<th>Prestasi</th>
									<th>Tahun Kompetisi</th>
									<th style="width: 10%">Aksi</th>
								</tr>
								<?php
									if(!empty($data)):
										foreach ($data as $data):
								?>
								<tr id="riwayat<?php echo $data['id_riwayat'];?>">
									<td>
										<?php echo $data['no'];?>
									</td>
									<td>
										<a onclick="view(<?php echo $data['id_kompetisi'];?>)"  style="cursor:pointer">
											<?php echo $data['nama_kompetisi'];?>
										</a>
									</td>
									<td>
										<?php echo $data['prestasi'];?>
									</td>
									<td>
										<?php echo $data['tahun'];?>
									</td>
									<td style="width: 20%">
										<a class="btn btn-default btn-xs" href="<?php echo $data['href_edit'];?>">
											<i class="fa fa-pencil"></i> Ubah
										</a>
										<a class="btn btn-danger btn-xs" onclick="mdlHapus(<?php echo $data['id_riwayat'];?>)" title="Hapus">
											<i class="glyphicon glyphicon-trash"></i> Delete
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
			url:"<?php echo site_url('api/ambilSatuKompetisi')?>/"+id,
			type:'get',
			dataType: 'json',
			success: function(data) {
				$("#nama").val(data.NAMA_KOMPETISI);
				$("#penyelenggara").val(data.PENYELENGGARA_KOMPETISI);
			},
			error: function(err){
				console.log(err);
			}
		});
		$('#modalKompetisi').modal('show'); // show bootstrap modal
	}

	function mdlHapus(id){
		$("#delIDPek").val(id);
		$('#mdlHapus').modal('show'); // show bootstrap modal
	}

	function hapus(){
		var id = $("#delIDPek").val();
		console.log(id);
		$.post("<?php echo site_url('api/hapusRiwayatKompetisi');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			id: id
		}, function(res, status) {
			console.log(res);
			if(res.status){
				$("#riwayat"+id).remove();

				var textAlert;
				textAlert = "<div class=\"alert alert-success alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-check\"></i> Success!</h4>";
				textAlert += "	Pesan : "+res.message;
				textAlert += "</div>";

				$("#alert").append(textAlert);
			}else{
				var textAlert;
				textAlert = "<div class=\"alert alert-warning alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-warning\"></i> Perhatian!</h4>";
				textAlert += "	Pesan : "+res.message;
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
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
				<button class="btn btn-sm btn-danger pull-right" onclick="hapus()" data-dismiss="modal">
					<i class="ace-icon fa fa-trash"></i>
					Delete
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div id="modalKompetisi" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Kompetisi</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Nama Kompetisi
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" readonly id="nama" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Penyelenggara Kompetisi
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" readonly id="penyelenggara" class="form-control" />
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