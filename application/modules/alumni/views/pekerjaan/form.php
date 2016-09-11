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
										<label for="perusahaan" class="col-sm-2 control-label">Perusahaan</label>
										<div class="col-sm-10">
											<select name="perusahaan" id="perusahaan" class="form-control select2" style="width: 100%;">
												<?php if(empty($perusahaan)): ?>
												<option value="0">-No Company-</option>
												<?php endif;?>
												<?php foreach ($perusahaan as $resP): ?>
												<option value="<?php echo $resP['ID_PERUSAHAAN'];?>">
													<?php echo $resP['NAMA_PERUSAHAAN'];?>
												</option>
												<?php endforeach; ?>
												<?php if (!empty($datana['ID_PERUSAHAAN'])):?>
												<option value="<?php echo $datana['ID_PERUSAHAAN'];?>" selected>
													<?php echo $datana['NAMA_PERUSAHAAN'];?>
												</option>
												<?php endif;?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<a class="btn btn-default btn-md" onclick="addPerusahaan()">
												<i class="fa fa-plus"></i> Perusahaan
											</a>
										</div>
									</div>

									<div class="form-group">
										<label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
										<div class="col-sm-10">
											<input type="text" name="jabatan" class="form-control" value="<?php echo (!empty($datana['JABATAN_PEKERJAAN'])) ? $datana['JABATAN_PEKERJAAN'] : '';?>" id="jabatan" placeholder="Admin">
										</div>
									</div>

									<div class="form-group">
										<label for="thn_mulai" class="col-sm-2 control-label">Tahun Mulai</label>
										<div class="col-sm-10">
											<select name="thn_mulai" id="thn_mulai" class="form-control">
												<?php for ($a=1991;$a<date('Y');$a++): ?>
												<option value="<?php echo $a;?>"<?php echo (!empty($datana['TAHUN_MULAI'])) ? ($a==$datana['TAHUN_MULAI']) ? ' selected' : '' : '';?>><?php echo $a;?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="thn_berhenti" class="col-sm-2 control-label">Tahun Berhenti</label>
										<div class="col-sm-10">
											<select name="thn_berhenti" id="thn_berhenti" class="form-control">
												<?php $thn_berhenti = (!empty($datana['TAHUN_BERHENTI'])) ? $datana['TAHUN_BERHENTI'] : '';?>
												<?php for ($a=1991;$a<date('Y')-1;$a++): ?>
												<option value="<?php echo $a;?>"<?php echo ($thn_berhenti==$a) ? ' selected' : '';?>><?php echo $a;?></option>
												<?php endfor; ?>
												<option value="0"<?php echo ($thn_berhenti==0) ? ' selected' : '';?>>-Sekarang-</option>
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
	function addPerusahaan() {
		$('#modalPerusahaan').modal('show'); // show bootstrap modal
	}

	function addP(){

		var nama = $("#namaPerusahaan").val();
		var email = $("#emailPerusahaan").val();
		var alamat = $("#alamatPerusahaan").val();
		var notelp = $("#telpPerusahaan").val();
		var bidang = $("#bidangPerusahaan").val();

		$.post("<?php echo site_url('api/tambahPerusahaan');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			nama: nama,
			email: email,
			alamat: alamat,
			notelp: notelp,
			bidang: bidang
		}, function(res, status) {
			if(res.status){
				$('#perusahaan').append($('<option>', {
				    value: res.id,
				    text: nama,
				}));
				$('#perusahaan').val(res.id).change();

				$("#namaPerusahaan").val("");
				$("#emailPerusahaan").val("");
				$("#alamatPerusahaan").val("");
				$("#telpPerusahaan").val("");
				$("#bidangPerusahaan").val("");
				$("#alert").html("");

				$('#modalPerusahaan').modal('hide');
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

<div id="modalPerusahaan" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Perusahaan</h3>
			</div>

			<div class="modal-body">
				<div id="alert"></div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Nama Perusahaan
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" id="namaPerusahaan" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Email Perusahaan
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" id="emailPerusahaan" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								No Telp Perusahaan
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" id="telpPerusahaan" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Alamat Perusahaan
							</label>
						</div>

						<div class="col-md-12">
							<textarea id="alamatPerusahaan" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Bidang Perusahaan
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" id="bidangPerusahaan" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-success" onclick="addP()">
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