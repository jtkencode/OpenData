Content Wrapper. Contains page content -->
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
						</div><!-- /.box-body -->
					</div><!-- /.box -->

					<!-- About Me Box -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Info</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
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

							<strong><i class="fa fa-map-marker margin-r-5"></i> No HP</strong>
							<p class="text-muted">
								<?php echo (!empty($akunInfo['NO_HP'])) ? strip_tags($akunInfo['NO_HP']) : '-';?>
							</p>

							<a href="#" class="btn btn-primary btn-block"><b>Ubah Profil</b></a>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->

				<div class="col-md-9">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#timeline" data-toggle="tab">Histori Pekerjaan</a></li>
						</ul>

						<div class="tab-content">
                  
							<div class="active tab-pane" id="timeline">
								<!-- The timeline -->
								<ul class="timeline timeline-inverse" id="gawe">
									<!-- /.timeline-label -->
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
												<a onclick="hapusPerusahaan(<?php echo $resultJob['ID_BEKERJA'];?>)" class="btn btn-danger btn-xs">Delete</a>
											</span>
											<h3 class="timeline-header">
												<?php echo (!empty($resultJob['JABATAN_PEKERJAAN'])) ? strip_tags($resultJob['JABATAN_PEKERJAAN']) : '-';?> 
												di 
												<a onclick="infoPerusahaan(<?php echo $resultJob['ID_PERUSAHAAN'];?>)" href="#">
													<?php echo (!empty($resultJob['NAMA_PERUSAHAAN'])) ? strip_tags($resultJob['NAMA_PERUSAHAAN']) : '-';?> 
												</a>
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
														<td>
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
														<td>
															IT Industri
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
					<a onclick="cek()" class="btn btn-danger btn-xs">Tambah</a>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

<script type="text/javascript">
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

	function hapusPerusahaan(id){
		$("#pagawean"+id).remove();
	}

	function cek(){
		var html;

		html = "<li id=\"pagawean<?php echo $resultJob['ID_BEKERJA'];?>\">";
		html += "<i class=\"fa fa-briefcase bg-blue\"></i>";
		html += "<div class=\"timeline-item\">";
		html += "	<span class=\"time\">";
		html += "		<a onclick=\"hapusPerusahaan(<?php echo $resultJob['ID_BEKERJA'];?>)\" class=\"btn btn-danger btn-xs\">Delete</a>";
		html += "	</span>";
		html += "	<h3 class=\"timeline-header\">";
		html += "		<?php echo (!empty($resultJob['JABATAN_PEKERJAAN'])) ? strip_tags($resultJob['JABATAN_PEKERJAAN']) : '-';?>"; 
		html += "		di ";
		html += "		<a onclick=\"infoPerusahaan(<?php echo $resultJob['ID_PERUSAHAAN'];?>)\" href=\"#\">";
		html += "			<?php echo (!empty($resultJob['NAMA_PERUSAHAAN'])) ? strip_tags($resultJob['NAMA_PERUSAHAAN']) : '-';?> ";
		html += "		</a>";
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
		html += "				<td>";
		html += "					<?php echo (!empty($resultJob['TAHUN_MULAI'])) ? strip_tags($resultJob['TAHUN_MULAI']) : '-';?> ";
		html += "					- ";
		html += "					<?php echo (!empty($resultJob['TAHUN_BERHENTI'])) ? strip_tags($resultJob['TAHUN_BERHENTI']) : 'Sekarang';?> ";
		html += "				</td>";
		html += "			</tr>";
		html += "			<tr>";
		html += "				<td style=\"width:200px;\">";
		html += "					<strong><i class=\"fa fa-circle-o margin-r-5\"></i>  Bidang Pekerjaan</strong>";
		html += "				</td>";
		html += "				<td>";
		html += "					:";
		html += "				</td>";
		html += "				<td>";
		html += "					IT Industri";
		html += "				</td>";
		html += "			</tr>";
		html += "		</table>";
		html += "	</div>";
		html += "</div>";
		html += "</li>";

		$("#gawe").prepend(html);
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