<script type="text/javascript">
	function loadProdi(){
        var jurusan = $("#jurusan").val();
        $.ajax({
            type:'GET',
            url:"<?php echo site_url('api/getProdi'); ?>",
            data:"id=" + jurusan,
            success: function(html){ 
		    	$(".prodina").css( "display", "inherit" );
				$("#prodi").html(html);
            }
        }); 
    }

</script>

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
					<?php if(!empty($message)): ?>
			    	<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-warning"></i> Alert!</h4>
						<?php echo $message;?>
					</div>
					<?php endif;?>
					<div class="well">
						<form class="form-horizontal" action="" method="POST">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<fieldset>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nim">NIM</label>
									<div class="col-md-5">
										<input id="nim" name="nim" type="text" placeholder="Nim" class="form-control input-md" required="" value="<?php echo (!empty($datana['USERNAME'])) ? $datana['USERNAME'] : ''; ?>">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="namaalumni">Nama Alumni</label>
									<div class="col-md-5">
										<input id="namaalumni" name="namaalumni" type="text" placeholder="Nama" class="form-control input-md" required="" value="<?php echo (!empty($datana['NAMA_ALUMNI'])) ? $datana['NAMA_ALUMNI'] : ''; ?>">
									</div>
								</div>

								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="jurusan">Jurusan</label>
									<div class="col-md-5">
										<select name="jurusan" id="jurusan" onchange="loadProdi()" class="form-control select2">
											<?php foreach ($jurusan as $jurusan): ?>
											<option<?php echo (!empty($datana['idJurusan'])) ? ($datana['idJurusan']==$jurusan['ID_JURUSAN'])?' selected':'' : '';?> value="<?php echo $jurusan['ID_JURUSAN'];?>">
												<?php echo $jurusan['NAMA_JURUSAN'];?>
											</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group prodina" <?php echo (empty($datana['ID_PRODI'])) ? "style=\"display:none;\"" : '';?>>
									<label for="prodi" class="col-sm-4 control-label">Program Studi</label>
									<div class="col-sm-5" id="prodi">
										<select name="prodi" class="form-control select2">
											<?php foreach ($prodi as $prodi): ?>
											<option<?php echo (!empty($datana['idProdi'])) ? ($datana['ID_PRODI']==$prodi['ID_PRODI'])?' selected':'' : '';?> value="<?php echo $prodi['ID_PRODI'];?>">
												<?php echo $prodi['NAMA_PRODI'];?>
											</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								 <!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="thn_masuk">Tahun Masuk</label>
									<div class="col-md-2">
										<select name="thn_masuk" id="thn_masuk" class="form-control">
											<?php for ($a=1991;$a<=date('Y');$a++): ?>
											<option value="<?php echo $a;?>"<?php echo (!empty($datana['TAHUN_MASUK'])) ? ($a==$datana['TAHUN_MASUK']) ? ' selected' : '' : '';?>><?php echo $a;?></option>
											<?php endfor; ?>
										</select>
									</div>
								</div>

								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="thn_keluar">Tahun Keluar</label>
									<div class="col-md-2">
										<select name="thn_keluar" id="thn_keluar" class="form-control">
											<?php for ($a=1991;$a<=date('Y');$a++): ?>
											<option value="<?php echo $a;?>"<?php echo (!empty($datana['TAHUN_KELUAR'])) ? ($a==$datana['TAHUN_KELUAR']) ? ' selected' : '' : '';?>><?php echo $a;?></option>
											<?php endfor; ?>
										</select>
									</div>
								</div>

								<div class="form-group">
										<label class="col-md-4 control-label" for="ta">Judul Tugas Akhir</label>
										<div class="col-md-4">
											<select name="ta" id="ta" class="form-control select2">
												<?php foreach ($ta as $ta): ?>
												<option<?php echo (!empty($datana['ID_TUGAS_AKHIR'])) ? ($datana['ID_TUGAS_AKHIR']==$ta['ID_TUGAS_AKHIR'])?' selected':'' : '';?> value="<?php echo $ta['ID_TUGAS_AKHIR'];?>">
													<?php echo $ta['JUDUL_TUGAS_AKHIR'];?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-sm-1">
											<a class="btn btn-default btn-md" onclick="addTA()">
												<i class="fa fa-plus"></i> 
											</a>
										</div>
									</div>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="email">Email</label>
									<div class="col-md-3">
										<input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" required="" value="<?php echo (!empty($datana['EMAIL_ALUMNI'])) ? $datana['EMAIL_ALUMNI'] : ''; ?>">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nohp">No HP</label>
									<div class="col-md-2">
									<input id="nohp" name="nohp" type="text" placeholder="Nomor HP" class="form-control input-md" required="" value="<?php echo (!empty($datana['NO_HP'])) ? $datana['NO_HP'] : ''; ?>">

									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label" for="pekerjaan">Pekerjaan</label>
									<div class="col-md-2">
									<input id="pekerjaan" name="pekerjaan" type="text" placeholder="Pekerjaan" class="form-control input-md" required="" value="<?php echo (!empty($datana['PEKERJAAN'])) ? $datana['PEKERJAAN'] : ''; ?>">
									</div>
								</div>

								<!-- Textarea -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="alamat">Alamat Alumni</label>
									<div class="col-md-4">
										<textarea class="form-control" id="alamat" name="alamat"><?php echo (!empty($datana['ALAMAT_ALUMNI'])) ? $datana['ALAMAT_ALUMNI'] : ''; ?></textarea>
									</div>
								</div>


								<div class="form-group" align="center">
									<input type="submit" class="btn btn-success"  value="Submit">
									<a href="<?php echo site_url('master/alumni');?>" class="btn btn-primary" role="button">Batal</a>
								</div>
							</fieldset>

						</form>
					</div>
				</div>
			</div>
		</section>
	</div>

<script type="text/javascript">
	function addTA() {
		$('#moadlTA').modal('show'); // show bootstrap modal
	}

	function add(){

		var judul = $("#judul").val();

		$.post("<?php echo site_url('api/tambahTA');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			judul: judul
		}, function(res, status) {
			if(res.status){
				$('#ta').append($('<option>', {
				    value: res.id,
				    text: judul,
				}));
				$('#ta').val(res.id).change();
				$("#ta").select2("val", res.id);

				$("#alert").html("");

				$('#moadlTA').modal('hide');
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

<div id="moadlTA" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Tugas Akhir</h3>
			</div>

			<div class="modal-body">
				<div id="alert"></div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Judul Tugas Akhir
							</label>
						</div>
						<div class="col-md-12">
							<input type="text" id="judul" class="form-control" />
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