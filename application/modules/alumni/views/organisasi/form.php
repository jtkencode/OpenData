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
				<div class="col-md-12">
					<?php if(!empty($message)): ?>
						<?php echo $message;?>
					<?php endif;?>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#profil" data-toggle="tab">Info</a></li>
						</ul>

						<div class="tab-content">
                  
							<div class="active tab-pane" id="profil">
								<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									
									<div class="form-group">
										<label for="organisasi" class="col-sm-2 control-label">Organisasi</label>
										<div class="col-sm-10">
											<select name="organisasi" id="organisasi" class="form-control select2" style="width: 100%;">
												<?php if(empty($organisasi)): ?>
												<option value="0">-Tidak ada organisasi-</option>
												<?php endif;?>
												<?php foreach ($organisasi as $resP): ?>
												<option value="<?php echo $resP['ID_ORGANISASI'];?>"<?php echo (!empty($datana['ID_ORGANISASI'])) ? ($resP['ID_ORGANISASI']==$datana['ID_ORGANISASI']) ? ' selected' : '' : '';?>>
													<?php echo $resP['NAMA_ORGANISASI'];?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<a class="btn btn-default btn-md" onclick="addOrganisasi()">
												<i class="fa fa-plus"></i> Organisasi
											</a>
										</div>
									</div>

									<div class="form-group">
										<label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
										<div class="col-sm-10">
											<input type="text" name="jabatan" class="form-control" value="<?php echo (!empty($datana['JABATAN_DI_ORGANISASI'])) ? $datana['JABATAN_DI_ORGANISASI'] : '';?>" id="jabatan" placeholder="Admin">
										</div>
									</div>

									<div class="form-group">
										<label for="thn_mulai" class="col-sm-2 control-label">Tahun Mulai</label>
										<div class="col-sm-10">
											<select name="thn_mulai" id="thn_mulai" class="form-control">
												<?php for ($a=1991;$a<=date('Y');$a++): ?>
												<option value="<?php echo $a;?>"<?php echo (!empty($datana['TAHUN_MULAI_JABATAN'])) ? ($a==$datana['TAHUN_MULAI_JABATAN']) ? ' selected' : '' : '';?>><?php echo $a;?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="thn_selesai" class="col-sm-2 control-label">Tahun Selesai</label>
										<div class="col-sm-10">
											<select name="thn_selesai" id="thn_selesai" class="form-control">
												<?php $thn_selesai = (!empty($datana['TAHUN_SELESAI_JABATAN'])) ? $datana['TAHUN_SELESAI_JABATAN'] : '';?>
												<?php for ($a=1991;$a<=date('Y')-1;$a++): ?>
												<option value="<?php echo $a;?>"<?php echo ($thn_selesai==$a) ? ' selected' : '';?>><?php echo $a;?></option>
												<?php endfor; ?>
												<option value="0"<?php echo ($thn_selesai==0) ? ' selected' : '';?>>-Sekarang-</option>
											</select>
										</div>
									</div>									
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input type="submit" class="btn btn-success btn-md" name="simpan" value="Simpan">
										</div>
									</div>
								</form>
							</div><!-- /.tab-pane -->

						</div><!-- /.tab-content -->
					</div><!-- /.nav-tabs-custom -->
					
				</div><!-- /.col -->
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

<script type="text/javascript">
	function addOrganisasi() {
		$('#modalorganisasi').modal('show'); // show bootstrap modal
	}

	function add(){

		var nama = $("#namaorganisasi").val();

		$.post("<?php echo site_url('api/tambahOrganisasi');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			nama: nama
		}, function(res, status) {
			if(res.status){
				$('#organisasi').append($('<option>', {
				    value: res.id,
				    text: nama,
				}));
				$('#organisasi').val(res.id).change();

				$("#namaorganisasi").val("");
				$("#alert").html("");

				$('#modalorganisasi').modal('hide');
			}else{
				var textAlert;
				textAlert = "<div class=\"alert alert-warning alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-warning\"></i> Perhatian!</h4>";
				textAlert += "	"+res.message;
				textAlert += "</div>";
				$("#alert").html(textAlert);
			}

			console.log(res);
			console.log(status);
			
		}, 'json');

		
	}
</script>

<div id="modalorganisasi" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Organisasi</h3>
			</div>

			<div class="modal-body">
				<div id="alert"></div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Nama organisasi
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" id="namaorganisasi" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-success" onclick="add()">
					<i class="ace-icon fa fa-check"></i>
					Save & Set
				</button>
				<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>