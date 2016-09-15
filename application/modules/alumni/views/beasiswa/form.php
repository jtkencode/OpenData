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
										<label for="beasiswa" class="col-sm-2 control-label">Beasiswa</label>
										<div class="col-sm-9">
											<select name="beasiswa" id="beasiswa" class="form-control select2" style="width: 100%;">
												<?php if(empty($beasiswa)): ?>
												<option value="0">-Tidak ada beasiswa ilmiah-</option>
												<?php endif;?>
												<?php foreach ($beasiswa as $resP): ?>
												<option value="<?php echo $resP['ID_BEASISWA'];?>"<?php echo (!empty($datana['ID_BEASISWA'])) ? ($resP['ID_BEASISWA']==$datana['ID_BEASISWA']) ? ' selected' : '' : '';?>>
													<?php echo $resP['NAMA_BEASISWA'];?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-sm-1">
											<a class="btn btn-default btn-md" onclick="addBeasiswa()">
												<i class="fa fa-plus"></i>
											</a>
										</div>
									</div>

									<div class="form-group">
										<label for="thn_mulai" class="col-sm-2 control-label">Tahun Mulai</label>
										<div class="col-sm-2">
											<select name="thn_mulai" id="thn_mulai" class="form-control">
												<?php $thn_mulai = (!empty($datana['TAHUN_MULAI_BEASISWA'])) ? $datana['TAHUN_MULAI_BEASISWA'] : '';?>
												<?php for ($a=1991;$a<=date('Y');$a++): ?>
												<option value="<?php echo $a;?>"<?php echo ($thn_mulai==$a) ? ' selected' : '';?>><?php echo $a;?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>	

									<div class="form-group">
										<label for="thn_selesai" class="col-sm-2 control-label">Tahun Selesai</label>
										<div class="col-sm-2">
											<select name="thn_selesai" id="thn_selesai" class="form-control">
												<?php $thn_selesai = (!empty($datana['TAHUN_SELESAI_BEASISWA'])) ? $datana['TAHUN_SELESAI_BEASISWA'] : '';?>
												<?php for ($a=1991;$a<=date('Y');$a++): ?>
												<option value="<?php echo $a;?>"<?php echo ($thn_selesai==$a) ? ' selected' : '';?>><?php echo $a;?></option>
												<?php endfor; ?>
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
	function addBeasiswa() {
		$('#modelForm').modal('show'); // show bootstrap modal
	}

	function add(){

		var nama = $("#nama").val();
		var penyelenggara = $("#penyelenggara").val();

		$.post("<?php echo site_url('api/tambahBeasiswa');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			nama: nama,
			penyelenggara: penyelenggara
		}, function(res, status) {
			if(res.status){
				$('#beasiswa').append($('<option>', {
				    value: res.id,
				    text: nama,
				}));
				$('#beasiswa').val(res.id).change();

				$("#nama").val("");
				$("#penyelenggara").val("");
				$("#alert").html("");

				$('#modelForm').modal('hide');
			}else{
				var textAlert;
				textAlert = "<div class=\"alert alert-warning alert-dismissable\">";
				textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				textAlert += "	<h4><i class=\"icon fa fa-warning\"></i> Pesan!</h4>";
				textAlert += "	"+res.message;
				textAlert += "</div>";
				$("#alert").html(textAlert);
			}

			console.log(res);
			console.log(status);
			
		}, 'json');

		
	}
</script>

<div id="modelForm" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Beasiswa</h3>
			</div>

			<div class="modal-body">
				<div id="alert"></div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Nama Beasiswa
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" id="nama" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Penyelenggara Beasiswa
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" id="penyelenggara" class="form-control" />
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