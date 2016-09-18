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
						<?php if($this->session->userdata('hak')=='admin'): ?>
						<a class="btn btn-default btn-md" href="<?php echo base_url();?>master/alumni/addAlumni">
							<i class="fa fa-plus"></i> Tambah
						</a> <br></br>
						<?php endif;?>
					<?php if(!empty($message)): ?>
			    	<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Alert!</h4>
						<?php echo $message;?>
					</div>
					<?php endif;?>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Daftar <?php echo $title;?></h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 20px">#</th>
									<th>Nama Alumni</th>
									<th>Prodi</th>
									<th>Pekerjaan</th>
									<th style="width: 10%">Aksi</th>
								</tr>
								<?php
									if(!empty($dataAlumni)):
										foreach ($dataAlumni as $dataAlumni):
								?>
								<tr>
									<td>
										<?php echo $dataAlumni['no'];?>
									</td>
									<td>
										<?php echo $dataAlumni['namaAlumni'];?>
									</td>
									<td>
										<?php echo $dataAlumni['namaProdi'];?>
									</td>
									<td>
										<?php echo $dataAlumni['pekerjaan'];?>
									</td>

									<td style="width: 20%">
										<button class="btn btn-xs btn-primary" title="Lihat" onclick="view(<?php echo $dataAlumni['id'];?>)">
											<i class="fa fa-eye"></i>
										</button>
										<?php if($this->session->userdata('hak')=='admin'): ?>
										<a class="btn btn-default btn-xs" title="Ubah" href="<?php echo $dataAlumni['href_edit'];?>">
											<i class="fa fa-pencil"></i>
										</a>
										<a class="btn btn-danger btn-xs" title="Hapus" href="<?php echo $dataAlumni['href_delete'];?>"title="Hapus">
											<i class="glyphicon glyphicon-trash"></i>
										</a>
										<?php endif;?>
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
			url:"<?php echo site_url('api/ambilSatuAlumni')?>/"+id,
			type:'get',
			dataType: 'json',
			success: function(data) {
				$("#fotona").attr("src", data.foto);
				$("#nama").val(data.nama_alumni);
				$("#email").val(data.email_alumni);
				$("#jurusan").val(data.jurusan);
				$("#prodi").val(data.prodi);
				$("#thnMasuk").val(data.thn_masuk);
				$("#thnKeluar").val(data.thn_keluar);
				$("#nohp").val(data.no_hp);
				$("#pekerjaan").val(data.pekerjaan);
				$("#tugasakhir").val(data.tugasAkhir);
				$("textarea[name='alamat']").val(data.alamat_alumni);


				var htmlKerja;

				htmlKerja = "<div class=\"row\">";
				htmlKerja += "	<div class=\"col-md-12\">";
				htmlKerja += "		<table class=\"table table-bordered\" id=\"gawe\">";
				htmlKerja += "			<tr>";
				htmlKerja += "				<th>No</th>";
				htmlKerja += "				<th>Nama Perusahaan</th>";
				htmlKerja += "				<th>Jabatan</th>";
				htmlKerja += "				<th>Tahun Bekerja</th>	";
				htmlKerja += "				<th>Tahun Berhenti</th>";
				htmlKerja += "			</tr>";
				htmlKerja += "		</table>";
				htmlKerja += "	</div>";
				htmlKerja += "</div>";

				$("#riwayatKerja").html(htmlKerja);

				for(var i=0;i<data.riwayatKerja.length;i++){
					var thnBerhenti = (data.riwayatKerja[i].TAHUN_BERHENTI==0) ? 'Sekarang' : data.riwayatKerja[i].TAHUN_BERHENTI;
					html = "<tr>";
					html +=	"	<td>"+parseInt(i+1)+"</td>";
					html +=	"	<td>"+data.riwayatKerja[i].NAMA_PERUSAHAAN+"</td>";
					html +=	"	<td>"+data.riwayatKerja[i].JABATAN_PEKERJAAN+"</td>";
					html +=	"	<td>"+data.riwayatKerja[i].TAHUN_MULAI+"</td>";
					html +=	"	<td>"+thnBerhenti+"</td>";
					html +=	"</tr>";
					$("#gawe").append(html);
				}
				if(data.riwayatKerja.length==0){
					html = "<tr>";
					html +=	"	<td colspan=\"5\"> Belum pernah bekerja.</td>";
					html +=	"</tr>";
					$("#gawe").append(html);
				}

				var htmlbeasiswa;

				htmlbeasiswa = "<div class=\"row\">";
				htmlbeasiswa += "	<div class=\"col-md-12\">";
				htmlbeasiswa += "		<table class=\"table table-bordered\" id=\"beasiswana\">";
				htmlbeasiswa += "			<tr>";
				htmlbeasiswa += "				<th>No</th>";
				htmlbeasiswa += "				<th>Nama Beasiswa</th>";
				htmlbeasiswa += "				<th>Penyelenggara Beasiswa</th>";
				htmlbeasiswa += "				<th>Tahun Mulai</th>	";
				htmlbeasiswa += "				<th>Tahun Selesai</th>";
				htmlbeasiswa += "			</tr>";
				htmlbeasiswa += "		</table>";
				htmlbeasiswa += "	</div>";
				htmlbeasiswa += "</div>";

				$("#dapetBeasiswa").html(htmlbeasiswa);


				for(var i=0;i<data.dapetBeasiswa.length;i++){
					var thnselesaiBeasiswa = (data.dapetBeasiswa[i].TAHUN_SELESAI_BEASISWA==0) ? 'Sekarang' : data.dapetBeasiswa[i].TAHUN_SELESAI_BEASISWA;
					html = "<tr>";
					html +=	"	<td>"+parseInt(i+1)+"</td>";
					html +=	"	<td>"+data.dapetBeasiswa[i].NAMA_BEASISWA+"</td>";
					html +=	"	<td>"+data.dapetBeasiswa[i].PENYELENGGARA_BEASISWA+"</td>";
					html +=	"	<td>"+data.dapetBeasiswa[i].TAHUN_MULAI_BEASISWA+"</td>";
					html +=	"	<td>"+thnselesaiBeasiswa+"</td>";
					html +=	"</tr>";
					$("#beasiswana").append(html);
				}
				if(data.dapetBeasiswa.length==0){
					html = "<tr>";
					html +=	"	<td colspan=\"5\"> Belum Pernah Dapat Beasiswa.</td>";
					html +=	"</tr>";
					$("#beasiswana").append(html);
				}

				var htmlorganisasi;

				htmlorganisasi = "<div class=\"row\">";
				htmlorganisasi += "	<div class=\"col-md-12\">";
				htmlorganisasi += "		<table class=\"table table-bordered\" id=\"row_organisasi\">";
				htmlorganisasi += "			<tr>";
				htmlorganisasi += "				<th>No</th>";
				htmlorganisasi += "				<th>Nama Organisasi</th>";
				htmlorganisasi += "				<th>Jabatan Organisasi</th>";
				htmlorganisasi += "				<th>Tahun Mulai Menjabat</th>	";
				htmlorganisasi += "				<th>Tahun Selesai Menjabat</th>";
				htmlorganisasi += "			</tr>";
				htmlorganisasi += "		</table>";
				htmlorganisasi += "	</div>";
				htmlorganisasi += "</div>";

				$("#riwayat_org").html(htmlorganisasi);


				for(var i=0;i<data.riwayat_org.length;i++){
				  var thnselesaiJabatan = (data.riwayat_org[i].TAHUN_SELESAI_JABATAN==0) ? 'Sekarang' : data.riwayat_org[i].TAHUN_SELESAI_JABATAN;
				  html = "<tr>";
				  html +=	"	<td>"+parseInt(i+1)+"</td>";
				  html +=	"	<td>"+data.riwayat_org[i].NAMA_ORGANISASI+"</td>";
				  html +=	"	<td>"+data.riwayat_org[i].JABATAN_DI_ORGANISASI+"</td>";
				  html +=	"	<td>"+data.riwayat_org[i].TAHUN_MULAI_JABATAN+"</td>";
				  html +=	"	<td>"+thnselesaiJabatan+"</td>";
				  html +=	"</tr>";
				  $("#row_organisasi").append(html);
				}
				if(data.riwayat_org.length==0){
				  html = "<tr>";
				  html +=	"	<td colspan=\"5\"> Belum Pernah Berorganisasi.</td>";
				  html +=	"</tr>";
				  $("#row_organisasi").append(html);
				}

				var htmlkaryailmiah;

				htmlkaryailmiah = "<div class=\"row\">";
				htmlkaryailmiah += "	<div class=\"col-md-12\">";
				htmlkaryailmiah += "		<table class=\"table table-bordered\" id=\"karya\">";
				htmlkaryailmiah += "			<tr>";
				htmlkaryailmiah += "				<th>No</th>";
				htmlkaryailmiah += "				<th>Judul Karya Ilmiah</th>";
				htmlkaryailmiah += "				<th>Tujuan Pembuatan karya</th>";
				htmlkaryailmiah += "				<th>Tahun Selesai</th>";
				htmlkaryailmiah += "			</tr>";
				htmlkaryailmiah += "		</table>";
				htmlkaryailmiah += "	</div>";
				htmlkaryailmiah += "</div>";

				$("#karya_ilmiah").html(htmlkaryailmiah);


				for(var i=0;i<data.karya_ilmiah.length;i++){
					html = "<tr>";
					html +=	"	<td>"+parseInt(i+1)+"</td>";
					html +=	"	<td>"+data.karya_ilmiah[i].JUDUL_KARYA_ILMIAH+"</td>";
					html +=	"	<td>"+data.karya_ilmiah[i].TUJUAN_PEMBUATAN_KARYA+"</td>";
					html +=	"	<td>"+data.karya_ilmiah[i].TAHUN_SELESAI_KARYA+"</td>";
					html +=	"</tr>";
					$("#karya").append(html);
				}
				if(data.karya_ilmiah.length==0){
					html = "<tr>";
					html +=	"	<td colspan=\"5\"> Belum Pernah membuat karya ilmiah.</td>";
					html +=	"</tr>";
					$("#karya").append(html);
				}

				var htmlKompetisi;

				htmlKompetisi = "<div class=\"row\">";
				htmlKompetisi += "	<div class=\"col-md-12\">";
				htmlKompetisi += "		<table class=\"table table-bordered\" id=\"kompetisi\">";
				htmlKompetisi += "			<tr>";
				htmlKompetisi += "				<th>No</th>";
				htmlKompetisi += "				<th>Nama Kompetisi</th>";
				htmlKompetisi += "				<th>Penyelenggara</th>";
				htmlKompetisi += "				<th>Prestasi</th>";
				htmlKompetisi += "				<th>Tahun Kompetisi</th>";
				htmlKompetisi += "			</tr>";
				htmlKompetisi += "		</table>";
				htmlKompetisi += "	</div>";
				htmlKompetisi += "</div>";

				$("#riwayat_kompetisi").html(htmlKompetisi);


				for(var i=0;i<data.riwayat_kompetisi.length;i++){
					html = "<tr>";
					html +=	"	<td>"+parseInt(i+1)+"</td>";
					html +=	"	<td>"+data.riwayat_kompetisi[i].NAMA_KOMPETISI+"</td>";
					html +=	"	<td>"+data.riwayat_kompetisi[i].PENYELENGGARA_KOMPETISI+"</td>";
					html +=	"	<td>"+data.riwayat_kompetisi[i].PRESTASI+"</td>";
					html +=	"	<td>"+data.riwayat_kompetisi[i].TAHUN_KOMPETISI+"</td>";
					html +=	"</tr>";
					$("#kompetisi").append(html);
				}
				if(data.riwayat_kompetisi.length==0){
					html = "<tr>";
					html +=	"	<td colspan=\"5\"> Belum Pernah membuat karya ilmiah.</td>";
					html +=	"</tr>";
					$("#kompetisi").append(html);
				}
			}
		});
		$('#modalAlumni').modal('show'); // show bootstrap modal
	}
</script>

<div id="modalAlumni" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<input class="form-control" id="bIDPek" type="hidden" value="0">
			<input class="form-control" id="bStatus" type="hidden" value="null">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Data Alumni</h3>
			</div>

			<div class="modal-body">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#info" data-toggle="tab">
								Profil
							</a>
						</li>
						<li>
							<a href="#kerja" data-toggle="tab">
								Pekerjaan
							</a>
						</li>
						<li>
							<a href="#riwayatbeasiswa" data-toggle="tab">
								Beasiswa
							</a>
						</li>
						<li>
							<a href="#t-karyaIlmiah" data-toggle="tab">
								Karya Ilmiah
							</a>
						</li>
						<li>
							<a href="#r_organisasi" data-toggle="tab">
								Organisasi
							</a>
						</li>
						<li>
							<a href="#t-kompetisi" data-toggle="tab">
								Kompetisi
							</a>
						</li>


					<div class="tab-content">
						<div class="active tab-pane" id="info">
							<div class="box-body">
								<div class="row">
									<div class="col-md-12" style="text-align:center;">
										<img src="<?php echo base_url('assets/upload/alumni/default.png'); ?>" id="fotona" width="120px" height="120px">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<strong><i class="fa fa-user margin-r-5"></i>  Nama Lengkap </strong>
										<input type="text" id="nama" disabled readonly="true" class="form-control" value="" />
									</div>
									<div class="col-md-6">
										<strong><i class="fa fa-envelope margin-r-5"></i>  Email</strong>
										<input type="text" id="email" disabled readonly="true" class="form-control" value="" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<strong><i class="fa fa-graduation-cap margin-r-5"></i>  Jurusan</strong>
										<input type="text" id="jurusan" disabled readonly="true" class="form-control" value="" />
									</div>
									<div class="col-md-6">
										<strong><i class="fa fa-graduation-cap margin-r-5"></i>  Prodi</strong>
										<input type="text" id="prodi" disabled readonly="true" class="form-control" value="" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<strong><i class="fa fa-level-up margin-r-5"></i> Tahun Masuk </strong>
										<input type="text" id="thnMasuk" disabled readonly="true" class="form-control" value="" />
									</div>
									<div class="col-md-6">
										<strong><i class="fa fa-level-down margin-r-5"></i> Tahun Keluar </strong>
										<input type="text" id="thnKeluar" disabled readonly="true" class="form-control" value="" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
										<input type="text" id="nohp" disabled readonly="true" class="form-control" value="" />
									</div>
									<div class="col-md-6">
										<strong><i class="fa fa-suitcase margin-r-5"></i> Pekerjaan </strong>
										<input type="text" id="pekerjaan" disabled readonly="true" class="form-control" value="" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<strong><i class="fa fa-book margin-r-5"></i>  Tugas Akhir</strong>
										<input type="text" id="tugasakhir" disabled readonly="true" class="form-control" value="" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
										<textarea id="alamat" name="alamat" disabled readonly="true" class="form-control"></textarea>
									</div>
								</div>

							</div>
						</div>

						<div class="tab-pane" id="kerja">
							<div id="riwayatKerja"></div>
						</div>

						<div class="tab-pane" id="riwayatbeasiswa">
							<div class="box-body">
								<div id="dapetBeasiswa"></div>
							</div>
						</div>

						<div class="tab-pane" id="r_organisasi">
							<div class="box-body">
								<div id="riwayat_org"></div>
							</div>
						</div>
						<div class="tab-pane" id="t-karyaIlmiah">
							<div class="box-body">
									<div id="karya_ilmiah"></div>
							</div>
					</div>
					<div class="tab-pane" id="t-kompetisi">
						<div class="box-body">
								<div id="riwayat_kompetisi"></div>
						</div>
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
