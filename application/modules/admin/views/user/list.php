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
						<a class="btn btn-primary btn-md" href="<?php echo site_url('admin/user/add');?>">
							<i class="fa fa-plus"></i> Tambah
						</a> <br></br>
						<div id="alert"></div>
					<div class="box">
						
						<div class="box-header with-border">
							<h3 class="box-title">Daftar <?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<th>Username</th>
									<th>Jurusan</th>
									<th>Program Studi</th>
									<th>Status</th>
									<th style="width: 10%">Aksi</th>
								</tr>
								<?php
									if(!empty($dataUser)):
										foreach ($dataUser as $dataUser):
								?>
								<tr id="userna<?php echo $dataUser['id'];?>">
									<td>
										<?php echo $dataUser['no'];?>
									</td>
									<td>
										<?php echo $dataUser['username'];?>
									</td>
									<td>
										<?php echo $dataUser['jurusan'];?>
									</td>
									<td>
										<?php echo $dataUser['prodi'];?>
									</td>
									<td>
										<span class="label label-success">
										<?php echo $dataUser['status'];?>
										</span>
									</td>
									<td style="width: 20%">
										<button class="btn btn-xs btn-primary" title="Lihat" onclick="view(<?php echo $dataUser['id'];?>)">
											<i class="fa fa-eye"></i>
										</button>
										<a class="btn btn-default btn-xs" title="Ubah" href="<?php echo $dataUser['href_edit'];?>">
											<i class="fa fa-pencil"></i>
										</a>
										<button class="btn btn-danger btn-xs" title="Hapus" onclick="deleteUser(<?php echo $dataUser['id'];?>)">
											<i class="glyphicon glyphicon-trash"></i> 
										</button>
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


<script type="text/javascript">
	function view(obj){
		var id = obj;

		$.ajax({
			url:"<?php echo site_url('api/ambilSatuUser')?>/"+id,
			type:'get',
			dataType: 'json',
			success: function(data) {
				var stt = (data.STATUS==1)?'Admin':'Mahasiswa';
				$("#username").val(data.USERNAME);
				$("#status").val(stt);
				$("#jurusan").val(data.NAMA_JURUSAN);
				$("#prodi").val(data.NAMA_PRODI);
			}
		});
		$('#modalUser').modal('show'); // show bootstrap modal
	}

	function deleteUser(id){
		$('#delID').val(id);
		$('#mdlHapus').modal('show'); // show bootstrap modal
	}

	function hapusUser(){
		var id = $("#delID").val();

		$.post("<?php echo site_url('api/hapusUser');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			id: id
		}, function(res) {
			if(res.status){
				$("#userna"+id).remove();

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
		}, "json");
	}
</script>

<div id="mdlHapus" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<input class="form-control" id="delID" type="hidden" value="0">
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
				<button class="btn btn-sm btn-danger pull-right" onclick="hapusUser()" data-dismiss="modal">
					<i class="ace-icon fa fa-trash"></i>
					Delete
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div id="modalUser" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<input class="form-control" id="bIDPek" type="hidden" value="0">
			<input class="form-control" id="bStatus" type="hidden" value="null">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Pengguna</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						Username : 
						<input type="text" id="username" disabled readonly="true" class="form-control" value="" />
					</div>
					<div class="col-md-6">
						Status : 
						<input type="text" id="status" disabled readonly="true" class="form-control" value="" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" id="pilihThnmulai">
						Jurusan : 
						<input type="text" id="jurusan" disabled readonly="true" class="form-control" value="" />
					</div>
					<div class="col-md-6" id="pilihThnkeluar">
						Program Studi : 
						<input type="text" id="prodi" disabled readonly="true" class="form-control" value="" />
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