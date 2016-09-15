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

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#timeline" data-toggle="tab">Riwayat Pekerjaan</a></li>
                        </ul>
                        

                        <div class="tab-content">
                  
                            <div class="active tab-pane" id="timeline">
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
                                            <h3 class="timeline-header">
                                                <div id="jabatan<?php echo $resultJob['ID_BEKERJA'];?>">
                                                    <?php echo (!empty($resultJob['JABATAN_PEKERJAAN'])) ? strip_tags($resultJob['JABATAN_PEKERJAAN']) : '-';?>
                                                    di 
                                                    <?php echo (!empty($resultJob['NAMA_PERUSAHAAN'])) ? strip_tags($resultJob['NAMA_PERUSAHAAN']) : '-';?> 
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
                                                        <td id="bp<?php echo $resultJob['ID_BEKERJA'];?>">
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
            </div>

		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->