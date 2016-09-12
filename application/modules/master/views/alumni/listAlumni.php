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
											<i class="fa fa-eye"> Detail</i>
										</button>
										<?php if($this->session->userdata('hak')=='admin'): ?>
										<a class="btn btn-default btn-xs" title="Ubah" href="<?php echo $dataAlumni['href_edit'];?>">
											<i class="fa fa-pencil"></i>
										</a>
										<a class="btn btn-danger btn-xs" title="Delete" href="<?php echo $dataAlumni['href_delete'];?>"title="Hapus">
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
				$("#karyaIlmiah").val(data.karya_ilmiah);
				$("textarea[name='alamat']").val(data.alamat_alumni);

				var htmlKerja;

				htmlKerja = "<div class=\"row\">";
				htmlKerja += "	<div class=\"col-md-12\">";
				htmlKerja += "		Riwayat Bekerja :";
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

				var beasiswa;

				htmlbeasiswa = "<div class=\"row\">";
				htmlbeasiswa += "	<div class=\"col-md-12\">";
				htmlbeasiswa += "		Riwayat Beasiswa :";
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
				<div class="row">
					<div class="col-md-12" style="text-align:center;">
						<img src="<?php echo base_url('assets/upload/alumni/default.png'); ?>" id="fotona" width="120px" height="120px">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Nama Lengkap :
						<input type="text" id="nama" disabled readonly="true" class="form-control" value="" />
					</div>
					<div class="col-md-6">
						Email :
						<input type="text" id="email" disabled readonly="true" class="form-control" value="" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Jurusan :
						<input type="text" id="jurusan" disabled readonly="true" class="form-control" value="" />
					</div>
					<div class="col-md-6">
						Program Studi :
						<input type="text" id="prodi" disabled readonly="true" class="form-control" value="" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Tahun Masuk :
						<input type="text" id="thnMasuk" disabled readonly="true" class="form-control" value="" />
					</div>
					<div class="col-md-6">
						Tahun Keluar :
						<input type="text" id="thnKeluar" disabled readonly="true" class="form-control" value="" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						No Hp :
						<input type="text" id="nohp" disabled readonly="true" class="form-control" value="" />
					</div>
					<div class="col-md-6">
						Pekerjaan :
						<input type="text" id="pekerjaan" disabled readonly="true" class="form-control" value="" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Tugas Akhir :
						<input type="text" id="tugasakhir" disabled readonly="true" class="form-control" value="" />
					</div>
					<div class="col-md-6">
						Karya Ilmiah:
						<input type="text" id="karyaIlmiah" disabled readonly="true" class="form-control" value="" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						Alamat :
						<textarea id="alamat" name="alamat" disabled readonly="true" class="form-control"></textarea>
					</div>
				</div>
				<div id="riwayatKerja"></div>
				<div id="dapetBeasiswa"></div>
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
