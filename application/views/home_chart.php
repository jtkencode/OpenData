<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery-1.8.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/modules/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/themes/skies.js'); ?>"></script>
<script type="text/javascript">
jQuery(function(){
    new Highcharts.Chart({
        chart: {
            renderTo: 'chart', //id di divnya --> <div id="chart">
            type: 'column', //jenis chart: spline or column or line or pie
        },
        title: {
            text: 'Jumlah Lulusan Setiap Angkatan',
            x: 0 //posisi tulisan
        },
        subtitle: {
            text: 'Jumlah lulusan setiap angkatan',
            x: 0 //posisi tulisan
        },
        xAxis: {
            categories: <?php echo json_encode($data_kategori); ?>
        },
        yAxis: {
            title: {
                text: 'Jumlah'
            }
        },
        series: [{
            name: 'Jumlah',
            data: <?php echo json_encode($data); ?>
        }]
    });

	new Highcharts.Chart({
        chart: {
            renderTo: 'chart_jurusan', //id di divnya --> <div id="chart">
            type: 'column', //jenis chart: spline or column or line or pie
        },
        title: {
            text: 'Jumlah Lulusan Setiap Jurusan',
            x: -20 //posisi tulisan
        },
        subtitle: {
            text: 'Jumlah lulusan setiap jurusan',
            x: -20 //posisi tulisan
        },
        xAxis: {
			categories: [
			<?php foreach($result as $p){ ?>
				'<?php echo $p->NAMA_JURUSAN; ?>',
			<?php } ?>]
        },
        yAxis: {
            title: {
                text: 'Jumlah'
            }
        },
        series: [{
            name: 'Jumlah',
            data: <?php echo json_encode($data2); ?>
        }]
    });
});
</script>
<?php /*foreach($show as $p){
	echo $p->NAMA_PRODI;
} */?>
</body>
</html>
