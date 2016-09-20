<script src="<?php echo $asset;?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$("#uploadBtn").change(function(event){
			var tmppath = URL.createObjectURL(event.target.files[0]);
			$("#uploadFile").attr("src", tmppath); 
		});

		$("#clear").click(function(){
			$("#uploadFile").attr("src", "<?php echo base_url('assets/upload/alumni/default.png');?>"); 
		});
	});

	function loadProdi(){
        var jurusan = $("#jurusan").val();
        $.ajax({
            type:'GET',
            url:"<?php echo site_url('api/getProdi'); ?>",
            data:"id=" + jurusan,
            success: function(html){ 
               $("#prodi").html(html);
            }
        }); 
    }

</script>

<style>
.fileUpload {
  position: relative;
  overflow: hidden;
  margin: 10px;
}
.fileUpload input.upload {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
}
</style>
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
			    	<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-warning"></i> Alert!</h4>
						<?php echo $message;?>
					</div>
					<?php endif;?>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#profil" data-toggle="tab">Info</a></li>
							<li><a href="#password" data-toggle="tab">Ubah Password</a></li>
						</ul>

						<div class="tab-content">
                  
							<div class="active tab-pane" id="profil">
								<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Foto</label>
										<div class="col-sm-10">
											<img height="100px" width="100px" id="uploadFile" src="<?php echo (!empty($akunInfo['FOTO']))? base_url('assets/'.$akunInfo['FOTO']) : base_url('assets/upload/alumni/default.png');?>">
											<div class="fileUpload btn btn-primary">
												<span>Choose Photo</span>
												<input id="uploadBtn" accept="image/*" type="file" name="userfile" class="upload" />
											</div>
											<!-- <div class="btn btn-danger" id="clear">Clear</div> -->
										</div>
									</div>
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>
										<div class="col-sm-10">
											<input type="text" name="nama" class="form-control" value="<?php echo (!empty($akunInfo['NAMA_ALUMNI'])) ? $akunInfo['NAMA_ALUMNI'] : '';?>" id="inputName" placeholder="Full Name">
										</div>
									</div>
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Jurusan</label>
										<div class="col-sm-4">
											<select name="jurusan" id="jurusan" onchange="loadProdi()" class="form-control">
												<?php foreach ($jurusan as $jurusan): ?>
												<option<?php echo ($akunInfo['idJurusan']==$jurusan['ID_JURUSAN'])?' selected':'';?> value="<?php echo $jurusan['ID_JURUSAN'];?>">
													<?php echo $jurusan['NAMA_JURUSAN'];?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Program Studi</label>
										<div class="col-sm-4" id="prodi">
											<select name="prodi" class="form-control">
												<?php foreach ($prodi as $prodi): ?>
												<option<?php echo ($akunInfo['idProdi']==$prodi['ID_PRODI'])?' selected':'';?> value="<?php echo $prodi['ID_PRODI'];?>">
													<?php echo $prodi['NAMA_PRODI'];?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Tugas Akhir</label>
										<div class="col-sm-4" id="ta">
											<select name="ta" id="tana" class="form-control select2">
												<?php foreach ($ta as $ta): ?>
												<option<?php echo ($akunInfo['idTA']==$ta['ID_TUGAS_AKHIR'])?' selected':'';?> value="<?php echo $ta['ID_TUGAS_AKHIR'];?>">
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
									<div class="form-group">
										<label for="inputEmail" class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
											<input type="email" name="email" value="<?php echo (!empty($akunInfo['EMAIL_ALUMNI'])) ? $akunInfo['EMAIL_ALUMNI'] : '';?>" class="form-control" id="inputEmail" placeholder="Email">
										</div>
									</div>
									<div class="form-group">
										<label for="inputHp" class="col-sm-2 control-label">No HP</label>
										<div class="col-sm-10">
											<input type="text" name="telp" value="<?php echo (!empty($akunInfo['NO_HP'])) ? $akunInfo['NO_HP'] : '';?>" class="form-control" id="inputHp" placeholder="No. HP">
										</div>
									</div>
									<div class="form-group">
										<label for="inputTahun" class="col-sm-2 control-label">Tahun Masuk</label>
										<div class="col-sm-2">
											<select name="thnMasuk" class="form-control">
												<?php for ($a=1991;$a<=date('Y');$a++): ?>
												<option<?php echo ($akunInfo['TAHUN_MASUK']==$a)?' selected':'';?> value="<?php echo $a;?>"><?php echo $a;?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputTahunK" class="col-sm-2 control-label">Tahun Keluar</label>
										<div class="col-sm-2">
											<select name="thnKeluar" class="form-control">
												<?php for ($a=1991;$a<=date('Y');$a++): ?>
												<option<?php echo ($akunInfo['TAHUN_KELUAR']==$a)?' selected':'';?> value="<?php echo $a;?>"><?php echo $a;?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputAlamat" class="col-sm-2 control-label">Alamat</label>
										<div class="col-sm-10">
											<textarea class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat"><?php echo (!empty($akunInfo['ALAMAT_ALUMNI'])) ? $akunInfo['ALAMAT_ALUMNI'] : '';?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="iPek" class="col-sm-2 control-label">Pekerjaan</label>
										<div class="col-sm-10">
											<input type="text" name="pekerjaan" value="<?php echo (!empty($akunInfo['PEKERJAAN'])) ? $akunInfo['PEKERJAAN'] : '';?>" class="form-control" id="iPek" placeholder="Pekerjaan">
										</div>
									</div>
								
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input type="submit" class="btn btn-success btn-md" name="simpan" value="Simpan">
										</div>
									</div>
								</form>
							</div><!-- /.tab-pane -->

							<div class="tab-pane" id="password">
								<form class="form-horizontal" method="post" action="<?php echo site_url('alumni/profile/ubahPassword');?>">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Password Baru</label>
										<div class="col-sm-10">
											<input type="password" name="password" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Konfirmasi Password Baru</label>
										<div class="col-sm-10">
											<input type="password" name="passconf" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input type="submit" class="btn btn-success btn-md" name="ubah" value="Ubah">
										</div>
									</div>
								</form>
							</div>

						</div><!-- /.tab-content -->
					</div><!-- /.nav-tabs-custom -->
					
				</div><!-- /.col -->
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

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
				$('#tana').append($('<option>', {
				    value: res.id,
				    text: judul,
				}));
				$('#tana').val(res.id).change();
				$("#tana").select2("val", res.id);

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