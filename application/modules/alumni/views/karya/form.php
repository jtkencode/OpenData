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
										<label for="karya" class="col-sm-2 control-label">Judul Karya Ilmiah</label>
										<div class="col-sm-9">
											<select name="karya" id="karya" class="form-control select2" style="width: 100%;">
												<?php if(empty($karya)): ?>
												<option value="0">-Tidak ada karya ilmiah-</option>
												<?php endif;?>
												<?php foreach ($karya as $resP): ?>
												<option value="<?php echo $resP['ID_KARYA_ILMIAH'];?>"<?php echo (!empty($datana['ID_KARYA_ILMIAH'])) ? ($resP['ID_KARYA_ILMIAH']==$datana['ID_KARYA_ILMIAH']) ? ' selected' : '' : '';?>>
													<?php echo $resP['JUDUL_KARYA_ILMIAH'];?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-sm-1">
											<a class="btn btn-default btn-md" onclick="addKarya()">
												<i class="fa fa-plus"></i>
											</a>
										</div>
									</div>

									<div class="form-group">
										<label for="thn_selesai" class="col-sm-2 control-label">Tahun Pembuatan Karya</label>
										<div class="col-sm-10">
											<select name="thn_selesai" id="thn_selesai" class="form-control">
												<?php $thn_selesai = (!empty($datana['TAHUN_PEMBUATAN'])) ? $datana['TAHUN_PEMBUATAN'] : '';?>
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
	function addKarya() {
		$('#modalKarya').modal('show'); // show bootstrap modal
	}

	function add(){

		var judul = $("#judul").val();
		var tujuan = $("#tujuan").val();
		var thn_selesai = $("div#thn_selesai select").val();

		$.post("<?php echo site_url('api/tambahKarya');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			judul: judul,
			tujuan: tujuan,
			thn_selesai: thn_selesai
		}, function(res, status) {
			if(res.status){
				$('#karya').append($('<option>', {
				    value: res.id,
				    text: judul,
				}));
				$('#karya').val(res.id).change();

				$("#judul").val("");
				$("#tujuan").val("");
				$("#alert").html("");

				$('#modalKarya').modal('hide');
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

<div id="modalKarya" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Karya Ilmiah</h3>
			</div>

			<div class="modal-body">
				<div id="alert"></div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Judul Karya Ilmiah
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" id="judul" class="form-control" />
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
							<textarea id="tujuan" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Tahun Selesai
							</label>
						</div>
						<div class="col-sm-12" id="thn_selesai">
							<select class="form-control">
								<?php for ($a=1991;$a<=date('Y');$a++): ?>
								<option value="<?php echo $a;?>"><?php echo $a;?></option>
								<?php endfor; ?>
							</select>
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