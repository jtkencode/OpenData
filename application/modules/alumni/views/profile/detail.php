<!--Content Wrapper. Contains page content -->
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
            	<div class="col-md-3">
					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile">
							<img class="profile-user-img img-responsive" src="<?php echo (!empty($akunInfo['FOTO'])) ? base_url('assets/'.$akunInfo['FOTO']) : base_url('assets/upload/alumni/default.png');?>" alt="User profile picture">
							<h3 class="profile-username text-center"><?php echo (!empty($akunInfo['NAMA_ALUMNI'])) ? $akunInfo['NAMA_ALUMNI'] : '-';?></h3>
							<p class="text-muted text-center"><?php echo (!empty($akunInfo['PEKERJAAN'])) ? $akunInfo['PEKERJAAN'] : '-';?></p>

							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>Tahun Masuk</b> 
									<a class="pull-right">
										<?php echo (!empty($akunInfo['TAHUN_MASUK'])) ? $akunInfo['TAHUN_MASUK'] : '-';?>
									</a>
								</li>
								<li class="list-group-item">
									<b>Tahun Keluar</b>
									<a class="pull-right">
										<?php echo (!empty($akunInfo['TAHUN_KELUAR'])) ? $akunInfo['TAHUN_KELUAR'] : '-';?>
									</a>
								</li>
							</ul>
							<a href="<?php echo site_url('alumni/profile/ubah');?>" class="btn btn-primary btn-block">
								<b>Ubah Profil</b>
							</a>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->

				<div class="col-md-9">
					<div id="alert"></div>

					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#info" data-toggle="tab">
									Info
								</a>
							</li>
							<li>
								<a href="#timeline" data-toggle="tab">
									Riwayat Pekerjaan
								</a>
							</li>
							<li>
								<a href="#karya" data-toggle="tab">
									Karya Ilmiah
								</a>
							</li>
							<li>
								<a href="#r_organisasi" data-toggle="tab">
									Riwayat Organisasi
								</a>
							</li>
							<li>
								<a href="#r_kompetisi" data-toggle="tab">
									Riwayat Kompetisi
								</a>
							</li>

							<li>
								<a href="#r_beasiswa" data-toggle="tab">
									Riwayat Beasiswa
								</a>
							</li>
						</ul>
						<!-- <a class="btn btn-xs bg-green" style="margin-left:10px;" onclick="tambahPekerjaan()">
							<i class="fa fa-plus"></i>
							Tambah
						</a> -->

						<div class="tab-content">
							<div class="active tab-pane" id="info">
								<div class="box-body">
							<strong><i class="fa fa-graduation-cap margin-r-5"></i>  Jurusan</strong>
							<p class="text-muted">
								<?php echo (!empty($akunInfo['NAMA_JURUSAN'])) ? $akunInfo['NAMA_JURUSAN'] : '-';?> - 
								<?php echo (!empty($akunInfo['NAMA_PRODI'])) ? $akunInfo['NAMA_PRODI'] : '-';?>
							</p>

							<hr>

							<strong><i class="fa fa-inbox margin-r-5"></i>  Email</strong>
							<p class="text-muted">
								<?php echo (!empty($akunInfo['EMAIL_ALUMNI'])) ? $akunInfo['EMAIL_ALUMNI'] : '-';?>
							</p>

							<hr>

							<strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
							<p class="text-muted">
								<?php echo (!empty($akunInfo['ALAMAT_ALUMNI'])) ? strip_tags($akunInfo['ALAMAT_ALUMNI']) : '-';?>
							</p>

							<hr>

							<strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
							<p class="text-muted">
								<?php echo (!empty($akunInfo['NO_HP'])) ? strip_tags($akunInfo['NO_HP']) : '-';?>
							</p>
						</div><!-- /.box-body -->
							</div>
                  
							<div class="tab-pane" id="timeline">
								<!-- The timeline -->
								<ul class="timeline timeline-inverse" id="gawe">
									<!-- timeline item -->
									<?php
									if(!empty($historiPekerjaan)):
										$no=1;
										foreach ($historiPekerjaan as $resultJob):
									?>
									<li id="pagawean<?php echo $resultJob['ID_BEKERJA'];?>">
										<i class="fa fa-briefcase bg-blue"></i>
										<div class="timeline-item">
											<span class="time">
												<!-- <a onclick="ubahPekerjaan(<?php echo $resultJob['ID_BEKERJA'];?>)" class="btn btn-info btn-xs" title="Ubah">
													<i class="ace-icon fa fa-pencil"></i>
												</a> -->
												<a onclick="mdlhapusPerusahaan(<?php echo $resultJob['ID_BEKERJA'];?>)" class="btn btn-danger btn-xs" title="Hapus">
													<i class="ace-icon fa fa-trash"></i>
												</a>
											</span>
											<h3 class="timeline-header">
												<div id="jabatan<?php echo $resultJob['ID_BEKERJA'];?>">
													<?php echo (!empty($resultJob['JABATAN_PEKERJAAN'])) ? strip_tags($resultJob['JABATAN_PEKERJAAN']) : '-';?>
													di 
													<a onclick="infoPerusahaan(<?php echo $resultJob['ID_PERUSAHAAN'];?>)" style="cursor:pointer">
														<?php echo (!empty($resultJob['NAMA_PERUSAHAAN'])) ? strip_tags($resultJob['NAMA_PERUSAHAAN']) : '-';?> 
													</a>
												</div>
											</h3>
											<div class="timeline-body">
												<table style="width:100%;">
													<tr>
														<td style="width:200px;">
															<strong><i class="fa fa-circle-o margin-r-5"></i>  Periode Kerja</strong>
														</td>
														<td>
															:
														</td>
														<td id="periode<?php echo $resultJob['ID_BEKERJA'];?>">
															<?php echo (!empty($resultJob['TAHUN_MULAI'])) ? strip_tags($resultJob['TAHUN_MULAI']) : '-';?> 
															- 
															<?php echo (!empty($resultJob['TAHUN_BERHENTI'])) ? strip_tags($resultJob['TAHUN_BERHENTI']) : 'Sekarang';?> 
														</td>
													</tr>
													<tr>
														<td style="width:200px;">
															<strong><i class="fa fa-circle-o margin-r-5"></i>  Bidang Pekerjaan</strong>
														</td>
														<td>
															:
														</td>
														<td id="bidang<?php echo $resultJob['ID_BEKERJA'];?>">
															<?php echo (!empty($resultJob['BIDANG_PEKERJAAN'])) ? strip_tags($resultJob['BIDANG_PEKERJAAN']) : '-';?> 
														</td>
													</tr>
												</table>
											</div>
										</div>
									</li>
									<?php
										$no++;
										endforeach;
									else:
									?>
									<!-- END timeline item -->
									<!-- timeline item -->
									<li id="pagaweanKosong">
										<i class="fa fa-briefcase bg-red"></i>
										<div class="timeline-item">
											<h3 class="timeline-header no-border">
												Belum pernah bekerja.
											</h3>
										</div>
									</li>  
									<?php
									endif;
									?>
									<li>
										<i class="fa fa-clock-o bg-gray"></i>
									</li>
								</ul>
							</div><!-- /.tab-pane -->
						</div><!-- /.tab-content -->
					</div><!-- /.nav-tabs-custom -->
					
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

<script type="text/javascript">

	var site = "<?php echo site_url();?>";
        $(function(){
            $('#perusahaana').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/api/searchPerusahaan',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (data) {
                	console.log(data);
                	$("#id_perusahaan").val(data.id);
                }
            }).val('Bara Enterprise');
        });

	function infoPerusahaan(obj){
		var id = obj;

		$.ajax({
			url:"<?php echo site_url('api/ambilSatuPerusahaan')?>/"+id,
			type:'get',
			dataType: 'json',
			success: function(data) {
				$("#namaPerusahaan").val(data.NAMA_PERUSAHAAN);
				$("#emailPerusahaan").val(data.EMAIL_PERUSAHAAN);
				$("#telpPerusahaan").val(data.NOMOR_TELEPON_PERUSAHAAN);
				$("#alamatPerusahaan").val(data.ALAMAT_PERUSAHAAN);
				$("#bidangPerusahaan").val(data.BIDANG_PEKERJAAN);
			}
		});
		$('#modalPerusahaan').modal('show'); // show bootstrap modal
	}

	function savePerusahaan(){
		var id = $("div#pilihPerusahaan select").val();
		var stt = $("#bStatus").val();

		if(stt=='ubah'){
			$.ajax({
				url:"<?php echo site_url('api/ambilSatuPerusahaan')?>/"+id,
				type:'get',
				dataType: 'json',
				success: function(data) {
					var jabatan = $("#bJabatan").val();
					var thnMulai = $("div#pilihThnmulai select").val();
					var thnBerhenti = ($("div#pilihThnkeluar select").val()==0)?'Sekarang': $("div#pilihThnkeluar select").val();
					var namaPerusahaan = data.NAMA_PERUSAHAAN;
					var htmlText;

					if(thnMulai <= thnBerhenti || thnBerhenti==0){

						$.post("<?php echo site_url('api/ubahPekerjaan');?>", { 
							<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
							id: $("#bIDPek").val(),
							id_perusahaan: id,
							jabatan: jabatan,
							thn_mulai: thnMulai,
							thn_berhenti: thnBerhenti
						}, function( res ) {
							if(res.status){
								htmlText = jabatan+" di ";
								htmlText += "<a onclick=\"infoPerusahaan("+data.ID_PERUSAHAAN+")\">";
								htmlText += namaPerusahaan;
								htmlText += "</a>";
								$("#jabatan"+$("#bIDPek").val()).html(htmlText);

								htmlText = thnMulai+" - "+thnBerhenti;
								$("#periode"+$("#bIDPek").val()).html(htmlText);

								$("#bidang"+$("#bIDPek").val()).html(data.BIDANG_PEKERJAAN);

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

						
					}else{
						var textAlert;
						textAlert = "<div class=\"alert alert-warning alert-dismissable\">";
						textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
						textAlert += "	<h4><i class=\"icon fa fa-warning\"></i> Perhatian!</h4>";
						textAlert += "	Periode tahun bekerja tidak sahih.";
						textAlert += "</div>";

						$("#alert").append(textAlert);
					}
					

				}
			});
		}else{
			var jabatan = $("#bJabatan").val();
			var perusahaan = $("div#pilihPerusahaan select").val();
			var thnMulai = $("div#pilihThnmulai select").val();
			var thnBerhenti = ($("div#pilihThnkeluar select").val()==0)?'Sekarang': $("div#pilihThnkeluar select").val();

			$.post("<?php echo site_url('api/tambahPekerjaan');?>", { 
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
				id_perusahaan: perusahaan,
				jabatan: jabatan,
				thn_mulai: thnMulai,
				thn_berhenti: thnBerhenti
			}, function(res) {
				if(res.status){
					$.ajax({
						url:"<?php echo site_url('api/ambilSatuPerusahaan')?>/"+perusahaan,
						type:'get',
						dataType: 'json',
						success: function(data) {
							var html;

							html = "<li id=\"pagawean"+res.id+"\">";
							html += "<i class=\"fa fa-briefcase bg-blue\"></i>";
							html += "<div class=\"timeline-item\">";
							html += "	<span class=\"time\">";
							html += "		<a onclick=\"ubahPekerjaan("+res.id+")\" class=\"btn btn-info btn-xs\" title=\"Ubah\">";
							html += "			<i class=\"ace-icon fa fa-pencil\"></i>";
							html += "		</a>";
							html += "		<a onclick=\"mdlhapusPerusahaan("+res.id+")\" class=\"btn btn-danger btn-xs\" title=\"Hapus\">";
							html += "			<i class=\"ace-icon fa fa-trash\"></i>";
							html += "		</a>";
							html += "	</span>";
							html += "	<h3 class=\"timeline-header\">";
							html += "		<div id=\"jabatan"+res.id+"\">";
							html += "			"+jabatan; 
							html += "			di ";
							html += "			<a onclick=\"infoPerusahaan("+data.ID_PERUSAHAAN+")\" href=\"#\">";
							html += "				"+data.NAMA_PERUSAHAAN;
							html += "			</a>";
							html += "		</div>";
							html += "	</h3>";
							html += "	<div class=\"timeline-body\">";
							html += "		<table style=\"width:100%;\">";
							html += "			<tr>";
							html += "				<td style=\"width:200px;\">";
							html += "					<strong><i class=\"fa fa-circle-o margin-r-5\"></i>  Periode Kerja</strong>";
							html += "				</td>";
							html += "				<td>";
							html += "					:";
							html += "				</td>";
							html += "				<td id=\"periode"+res.id+"\">";
							html += "					"+thnMulai;
							html += "					- ";
							html += "					"+thnBerhenti;
							html += "				</td>";
							html += "			</tr>";
							html += "			<tr>";
							html += "				<td style=\"width:200px;\">";
							html += "					<strong><i class=\"fa fa-circle-o margin-r-5\"></i>  Bidang Pekerjaan</strong>";
							html += "				</td>";
							html += "				<td>";
							html += "					:";
							html += "				</td>";
							html += "				<td id=\"bidang"+res.id+"\">";
							html += "					"+data.BIDANG_PEKERJAAN;
							html += "				</td>";
							html += "			</tr>";
							html += "		</table>";
							html += "	</div>";
							html += "</div>";
							html += "</li>";

							$("#gawe").prepend(html);

							var textAlert;
							textAlert = "<div class=\"alert alert-success alert-dismissable\">";
							textAlert += "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
							textAlert += "	<h4><i class=\"icon fa fa-check\"></i> Success!</h4>";
							textAlert += "	Pesan : "+res.message;
							textAlert += "</div>";

							$("#alert").append(textAlert);
						}
					});
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
		
		
	}

	function tambahPekerjaan(){
		$("#bStatus").val("tambah");

		$('#modalfrmPerusahaan').modal('show'); // show bootstrap modal
	}

	function ubahPekerjaan(id){
		$("#bIDPek").val(id);
		$("#bStatus").val("ubah");
		$.ajax({
			url:"<?php echo site_url('api/ambilSatuPekerjaan')?>/"+id,
			type:'get',
			dataType: 'json',
			success: function(data) {
				$("div#pilihPerusahaan select").val(data.ID_PERUSAHAAN);
				$("div#pilihThnmulai select").val(data.TAHUN_MULAI);
				$("div#pilihThnkeluar select").val(data.TAHUN_BERHENTI);
				$("#perusahaana").val(data.NAMA_PERUSAHAAN);
				$("#id_perusahaan").val(data.ID_PERUSAHAAN);

				console.log($("#perusahaana").val());
				
				$("#bJabatan").val(data.JABATAN_PEKERJAAN);
			}
		});
		
		$('#modalfrmPerusahaan').modal('show'); // show bootstrap modal
	}

	function mdlhapusPerusahaan(id){
		$("#delIDPek").val(id);
		$('#mdlHapus').modal('show'); // show bootstrap modal
	}

	function hapusPerusahaan(){
		var id = $("#delIDPek").val();

		$.post("<?php echo site_url('alumni/pekerjaan/hapusPekerjaan');?>", { 
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			id: id
		}, function(res) {
			if(res.status){
				$("#pagawean"+id).remove();

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
				<button class="btn btn-sm btn-danger pull-right" onclick="hapusPerusahaan()" data-dismiss="modal">
					<i class="ace-icon fa fa-trash"></i>
					Delete
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div id="modalfrmPerusahaan" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<input class="form-control" id="bIDPek" type="hidden" value="0">
			<input class="form-control" id="bStatus" type="hidden" value="null">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Pekerjaan</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-6" id="pilihPerusahaan">
						Perusahaan : 
						<select class="form-control">
							<?php if(empty($perusahaan)): ?>
							<option value="0">-No Company-</option>
							<?php endif;?>
							<?php foreach ($perusahaan as $resP): ?>
							<option value="<?php echo $resP['ID_PERUSAHAAN'];?>"><?php echo $resP['NAMA_PERUSAHAAN'];?></option>
							<?php endforeach; ?>
						</select>
						<!-- Autocomplete harusnya -->
						<!-- <input type="text" autocomplete="on" class='autocomplete form-control' id="perusahaana"/>
						<input type="hidden" id="id_perusahaan" value="0" /> -->
					</div>
					<div class="col-md-6">
						Jabatan : <input class="form-control" id="bJabatan" placeholder="Jabatan" type="text">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" id="pilihThnmulai">
						Tahun Mulai : 
						<select class="form-control">
							<?php for ($a=1991;$a<date('Y');$a++): ?>
							<option value="<?php echo $a;?>"><?php echo $a;?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-md-6" id="pilihThnkeluar">
						Tahun Berhenti : 
						<select class="form-control">
							<?php for ($a=1991;$a<date('Y')-1;$a++): ?>
							<option value="<?php echo $a;?>"><?php echo $a;?></option>
							<?php endfor; ?>
							<option value="0">-Sekarang-</option>
						</select>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="savePerusahaan()">Save changes</button>
				<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div id="modalPerusahaan" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Perusahaan</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label no-padding-left" for="form-field-1-1"> 
								Nama Perusahaan
							</label>
						</div>

						<div class="col-md-12">
							<input type="text" readonly id="namaPerusahaan" class="form-control" />
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
							<input type="text" readonly id="emailPerusahaan" class="form-control" />
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
							<input type="text" readonly id="telpPerusahaan" class="form-control" />
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
							<textarea readonly id="alamatPerusahaan" class="form-control"></textarea>
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
							<input type="text" readonly id="bidangPerusahaan" class="form-control" />
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