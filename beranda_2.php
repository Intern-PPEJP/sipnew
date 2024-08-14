<?php
namespace PHPMaker2020\ppei_20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$beranda = new beranda();

// Run the page
$beranda->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>


<form name="fberanda" id="fberanda" class="myform" action="beranda.php" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>


<div class="col-xl-12 col-lg-12"><center>
	<select id="tahun" name="tahun" class="form-control"  onchange="this.form.submit();">
	<option value="" disabled="">Pilih tahun</option>
		<?php 
		$thn = date("Y");
		$jmin = 2010; // tahun terlama
		$jmax = date("Y") + 1; // 1 tahun kedepan
		$selc = "";
		if(!isset($_POST["tahun"])){
			$tahun_sekarang = date("Y");
		} else {
			$tahun_sekarang = $_POST["tahun"];
		}
		
		for ($x = $jmax; $x>= $jmin; $x--) {
			if($x == $tahun_sekarang){
				$selc = " selected=\"\"";
			} else {
				$selc = "";
			}
			echo "<option value=\"".$x."\"".$selc.">".$x."</option>";
		}
		?>
	</select><hr>
			
</div>


</form>


<?php
	if(!isset($_POST["tahun"])){
		$tahun_sekarang = date("Y");
	} else {
		$tahun_sekarang = $_POST["tahun"];
	}
	
	$filter_tahun = "AND YEAR(a.tawal) = ".$tahun_sekarang;

	$user = CurrentUserName();//ExecuteScalar("SELECT username FROM `t_users`");

	$count_peserta = ExecuteScalar("SELECT COUNT(1) FROM `t_peserta` WHERE 1");
	$count_pelatihan = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE 1");
	$count_perusahaan = ExecuteScalar("SELECT COUNT(1) FROM `t_perusahaan` WHERE 1");
	$count_fasilitator = ExecuteScalar("SELECT COUNT(1) FROM `t_biointruktur` WHERE 1");
	
	$count_repeserta = ExecuteScalar("SELECT COUNT(1) FROM `t_repeserta` WHERE 1");

	
	$count_A = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` a WHERE LEFT(a.kdjudul,1) = 'A' ".$filter_tahun);
	$count_B = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` a WHERE LEFT(a.kdjudul,1) = 'B' ".$filter_tahun);
	$count_C = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` a WHERE LEFT(a.kdjudul,1) = 'C' ".$filter_tahun);
	$count_D = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` a WHERE LEFT(a.kdjudul,1) = 'D' ".$filter_tahun);
	
	$count_rpd = ExecuteScalar("SELECT COUNT(1) FROM `t_rpdiklat` WHERE `tahun_rencana` = ".$tahun_sekarang);
	$count_rpk = ExecuteScalar("SELECT COUNT(1) FROM `t_rpkerjasama` WHERE `tahun_rencana` = ".$tahun_sekarang);
	$count_rkc = ExecuteScalar("SELECT COUNT(1) FROM `t_rkcoaching` WHERE `tahun_keg` = ".$tahun_sekarang);
	$count_rkw = ExecuteScalar("SELECT COUNT(1) FROM `t_rkwebinar` WHERE `tahun` = ".$tahun_sekarang);
?>
<style>
.lhome { color: #000; }
.lhome:hover { text-decoration: none; color: #000;}
.bhome:hover {transform: scale(1.1); z-index: 99;}

.mb-0 {display:none;}
</style>

<div id="pageone">
<div class="row">
			<div class="col-lg-3"><a href="t_rpdiklatlist.php?cmd=search&x_tahun_rencana=<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
				<div class="info-box bhome">
					  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-table"></i><span class="badge badge-info float-right" style="font-size: 9px"><?php echo $tahun_sekarang; ?></span></span>
				<div class="info-box-content">
					<h5 class="text-muted font-weight-normal mt-0" title="Rencana Program Diklat">Rencana <br>Program Diklat</h5>
					<h3 class="mt-3 mb-3"><?php echo $count_rpd; ?></h3>
					<p class="mb-0 text-muted">
						<span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> 
						<?php 
						if($count_rpd > 0){
							$p1 = (1/$count_rpd)*100;
							echo FormatNumber($p1, 1, -2, -2, -2);
						}
						?>
						%</span>
						<span class="text-nowrap">Terealisasi</span>  
					</p>
					</div>
				</div>
			</a>
			</div> <!-- end col-->

			<div class="col-lg-3"><a href="t_rpkerjasamalist.php?cmd=search&x_tahun_rencana=<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
				<div class="info-box bhome">
					  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-table"></i><span class="badge badge-success float-right" style="font-size: 9px"><?php echo $tahun_sekarang; ?></span></span>
				<div class="info-box-content">
					<h5 class="text-muted font-weight-normal mt-0" title="Rencana Program Kerjasama">Rencana <br>Program Kerjasama</h5>
					<h3 class="mt-3 mb-3"><?php echo $count_rpk; ?></h3>
					<p class="mb-0 text-muted">
						<span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> 
						<?php 
						if($count_rpk > 0){
							$p1 = (1/$count_rpk)*100;
							echo FormatNumber($p1, 1, -2, -2, -2);
						}
						?>%</span>
						<span class="text-nowrap">Terealisasi</span>  
					</p>
					</div>
				</div>
			</a>
			</div> <!-- end col-->

			<div class="col-lg-3"><a href="t_rkcoachinglist.php?cmd=search&x_tahun_rencana=<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
				<div class="info-box bhome">
					  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-table"></i><span class="badge badge-warning float-right" style="font-size: 9px"><?php echo $tahun_sekarang; ?></span></span>
				<div class="info-box-content">
					<h5 class="text-muted font-weight-normal mt-0" title="Rencana Kegiatan ECP">Rencana <br>Kegiatan ECP</h5>
					<h3 class="mt-3 mb-3"><?php echo $count_rkc; ?></h3>
					<p class="mb-0 text-muted">
						<span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> %</span>
						<span class="text-nowrap">Terealisasi</span>  
					</p>
					</div>
				</div>
			</a>
			</div> <!-- end col-->

			<div class="col-lg-3"><a href="t_rkwebinarlist.php?cmd=search&x_tahun=<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
				<div class="info-box bhome">
					  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-table"></i><span class="badge badge-failure float-right" style="font-size: 9px"><?php echo $tahun_sekarang; ?></span></span>
				<div class="info-box-content">
					<h5 class="text-muted font-weight-normal mt-0" title="Rencana Kegiatan Webinar">Rencana <br>Kegiatan Webinar</h5>
					<h3 class="mt-3 mb-3"><?php echo $count_rkw; ?></h3>
					<p class="mb-0 text-muted">
						<span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> %</span>
						<span class="text-nowrap">Terealisasi</span>  
					</p>
					</div>
				</div>
			</a>
			</div> <!-- end col-->


</div>



<div class="row">
	<div class="col-xl-7 col-lg-6">
		<div class="card">
			<div class="card-body" style="position: relative;">

		<a id="download" download="chart_jumlah_angkatan.jpg" href="" class="btn btn-primary float-right bg-flat-color-1" title="Download chart"><i class="fa fa-download"></i></a>
		<canvas id="chart_jumlah_angkatan" width="800" height="320"></canvas>

			</div> <!-- end card-body-->
		</div> <!-- end card-->


	</div>
	<div class="col-xl-5  col-lg-6">
		<div class="card">
			<div class="card-body" style="position: relative;">
				<a id="download_chart_jumlah_fasilitator" download="chart_jumlah_fasilitator.jpg" href="" class="btn btn-primary float-right bg-flat-color-1" title="Download chart"><i class="fa fa-download"></i></a>
				<canvas id="chart_jumlah_fasilitator" width="800" height="460"></canvas>

			</div> <!-- end card-body-->
		</div> <!-- end card-->

	</div> <!-- end col -->
</div>



<div class="row">
  <div class="col-md-5">
	<!-- PIE CHART -->
	<div class="card card-danger">
	  <div class="card-header" style="background:#225994">
		<h3 class="card-title">Bidang Pelatihan <span class="badge badge-info float-right" style="font-size: 9px"><?php echo $tahun_sekarang; ?></span></h3>

		<div class="card-tools">
		  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
		  </button>
		  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
		</div>
	  </div>
	  <div class="card-body" style="min-height: 300px; height: 300px; max-width: 100%; display: block; width: 487px;" >
	  <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
	  <?php
		$jpel = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `statuspel` = 4 AND  YEAR(`tawal`) = ".$tahun_sekarang.""); // baca data dari tabel
		if ($jpel > 1) {
	  ?>
		<canvas id="bidangChart" width="487" height="250" class="chartjs-render-monitor"></canvas>
		<?php } else {
			echo "Tidak ada data ditemukan.";
		}
		?>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->

  </div>
  <!-- /.col (LEFT) -->
  <div class="col-md-4">
	<!-- LINE CHART -->
	<div class="card card-info">
	  <div class="card-header" style="background:#0a651f">
		<h3 class="card-title">Pelatihan Teratas <span class="badge badge-info float-right" style="font-size: 9px"><?php echo $tahun_sekarang; ?></span></h3>

		<div class="card-tools">
		  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
		  </button>
		  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
		</div>
	  </div>
	  <div class="card-body" style="min-height: 300px; height: 300px; max-width: 100%; display: block; width: 487px;" >
	  
		<?php
		$jpel = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `statuspel` = 4 AND  YEAR(`tawal`) = ".$tahun_sekarang.""); // baca data dari tabel
		if ($jpel > 5) {
	  ?>
			
			<canvas id="pelatihan_unggulan" width="400" height="260"></canvas>

		<?php } else {
			echo "Tidak ada data ditemukan.";
		}
		?>
		
		
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->

  </div>
  <!-- /.col (RIGHT) -->
  
   <div class="col-md-3">
	<!-- LINE CHART -->
	<div class="card card-info">
	  <div class="card-header" style="background:#8c1420">
		<h3 class="card-title">Tempat Pelatihan <span class="badge badge-info float-right" style="font-size: 9px"><?php echo $tahun_sekarang; ?></span> </h3>

		<div class="card-tools">
		  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
		  </button>
		  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
		</div>
	  </div>
	  <div class="card-body" style="min-height: 300px; height: 300px; max-width: 100%; display: block; width: 487px;" >
		<div class="card-body p-0">
				<ul class="products-list product-list-in-card pl-2 pr-2">
				 <?php 
					
					$rs = Execute("SELECT b.kota, COUNT(a.idpelat) c FROM `t_pelatihan` a INNER JOIN `t_kota` b ON a.kdkota = b.kdkota ".$filter_tahun." GROUP BY a.kdkota ORDER BY COUNT(a.idpelat) DESC LIMIT 0,5"); // baca data dari tabel
					if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
						$rs->MoveFirst(); // mulai dari record pertama
						while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset
							//echo $rs->fields("Theme_ID")." - " .$rs->fields("Theme_Name"). "<br>";  // tampilkan hasilnya
				?>
								<li class="item">
									<div class="product-img">
									  <i class="fa fa-square pelatihan_top"></i>
									</div>
									<div class="product-info" style="margin-left: 20px;">
									  <a href="javascript:void(0)" class="product-title"><?php echo str_replace("Kota ","",$rs->fields("kota")); ?>
										<span class="badge badge-warning float-right"><?php echo $rs->fields("c"); ?></span></a>
									  <span class="product-description">
										<!--Samsung 32" 1080p 60Hz LED Smart HDTV.-->
									  </span>
									</div>
								</li>
								<!-- /.item -->
				<?php
							$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
						} // akhir loop
						$rs->Close(); // tutup recordset jika sudah selesai
					} else { // jika jumlah record tidak lebih besar dari nol
						echo "Tidak ada data ditemukan."; // tampilkan pesan tidak ada record
					} // akhir pemeriksaan record
				?>
				</ul>
			  </div>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->

  </div>
  <!-- /.col (RIGHT) -->
</div>

		


<div class="card card-info">
	  <div class="card-header">
		<h3 class="card-title">Semua Data</h3>
	  </div>
	  <div class="card-body">
	  

<div class="row">
  <div class="col-12 col-sm-6 col-md-3 bhome">
	<div class="info-box">
	  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

	  <div class="info-box-content">
		<span class="info-box-text">Data Peserta</span>
		<span class="info-box-number">
		  <?php echo $count_peserta; ?>
		</span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	<!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3 bhome">
	<div class="info-box mb-3">
	  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-table"></i></span>

	  <div class="info-box-content">
		<span class="info-box-text">Data Pelatihan</span>
		<span class="info-box-number"><?php echo $count_pelatihan; ?></span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	<!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3 bhome">
	<div class="info-box mb-3">
	  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-industry"></i></span>

	  <div class="info-box-content">
		<span class="info-box-text">Data Perusahaan</span>
		<span class="info-box-number"><?php echo $count_perusahaan; ?></span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	<!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3 bhome">
	<div class="info-box mb-3">
	  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

	  <div class="info-box-content">
		<span class="info-box-text">Data Fasilitator</span>
		<span class="info-box-number"><?php echo $count_fasilitator; ?></span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	<!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
</div>

</div> <!-- tutup card -->		
		

</div> <!-- page one -->


<div id="pagetwo">



</div>
		
		


<script src="http://localhost/chartku/barline/charts2.0.js"></script>

<!--<script src="js/Chart.js"></script>-->
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
		
		
<script>
	


	var ctx = document.getElementById('bidangChart').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'doughnut',

		// The data for our dataset
		data: {
			labels: ['Membangun Strategi Ekspor', 'Persiapan Ekspor', 'Negosiasi Ekspor', 'Pendukung Proses Ekspor'],
			datasets: [{
				label: 'Bidang Pelatihan',
				backgroundColor: ['rgb(23, 162, 184)','rgb(220, 53, 69)','rgb(40, 167, 69)','rgb(255, 193, 7)'],
				
				data: [<?php echo $count_A; ?>, <?php echo $count_B; ?>, <?php echo $count_C; ?>, <?php echo $count_D; ?>,]
			}]
		},

		// Configuration options go here
		options: {}
	});
</script>	

<script>	
	
	
	// chart_jumlah_fasilitator
	
	new Chart(document.getElementById("chart_jumlah_fasilitator"), {
	type: 'bar',
	data: {
	  labels: ["Total"],
	  datasets: [
		{
		  label: "Internal",
		  backgroundColor: "#3e95cd",
		  data: [<?php
		  echo ExecuteScalar("SELECT COUNT(1) FROM `t_biointruktur` WHERE `kategori` = 1");
		  ?>]
		}, {
		  label: "Eksternal",
		  backgroundColor: "#8e5ea2",
		  data: [<?php
		  echo ExecuteScalar("SELECT COUNT(1) FROM `t_biointruktur` WHERE `kategori` = 2");
		  ?>]
		}
	  ]
	},
	options: {
	  title: {
		display: true,
		text: 'Jumlah Fasilitator'
	  }
	}
	});
	
	
function downloadImage() {
   /* set new title */
   chart_variable.options.title.text = 'New Chart Title';
   chart_variable.update({
	  duration: 0
   });
   // or, use
   // chart_variable.update(0);

   /* save as image */
   var link = document.createElement('a');
   link.href = chart_variable.toBase64Image();
   link.download = 'myImage.png';
   link.click();

   /* rollback to old title */
   chart_variable.options.title.text = 'Chart Title';
   chart_variable.update({
	  duration: 0
   });
   // or, use
   // chart_variable.update(0);
}

</script>
 
<?php 
	$rs = Execute("SELECT b.judul, COUNT(a.idpelat) c FROM `t_pelatihan` a INNER JOIN `t_judul` b ON a.kdjudul = b.kdjudul ".$filter_tahun." GROUP BY a.kdjudul ORDER BY COUNT(a.idpelat) DESC LIMIT 0,5"); 
	$no =1;
	if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
		$rs->MoveFirst(); // mulai dari record pertama
		while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset
			$judul[] = $rs->fields("judul");
			$jml_judul[] = $rs->fields("c");
			$no++;
		$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
		} // akhirdataku loop
	$rs->Close();
	}
	
?>

<script>
//pelatihan_unggulan

new Chart(document.getElementById("pelatihan_unggulan"), {
	type: 'horizontalBar',
	data: {
	  labels: ["<?php echo $judul[0];?>","<?php echo $judul[1];?>","<?php echo $judul[2];?>","<?php echo $judul[3];?>","<?php echo $judul[4];?>"],
	  datasets: [
		{
		  label: "Angkatan",
		  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
		  data: ["<?php echo $jml_judul[0];?>","<?php echo $jml_judul[1];?>","<?php echo $jml_judul[2];?>","<?php echo $jml_judul[3];?>","<?php echo $jml_judul[4];?>"]
		}
	  ]
	},
	options: {
	  legend: { display: false },
	  title: {
		display: false,
		text: 'Predicted world population (millions) in 2050'
	  }
	}
});

</script>

<script>
//realisasi angkatan dan peserta
  var barChartData = {
		labels: [<?php 
				$jmin = $tahun_sekarang-4;
				$jmax = $tahun_sekarang; 
				for ($x = $jmin; $x<= $jmax; $x++) {
					echo $x.",";
				}
				?>],
		datasets: [{
			label: "Realisasi Peserta",
				type:'line',
				data: [<?php 
				$ajmin = $tahun_sekarang-4;
				$ajmax = $tahun_sekarang; 
				for ($ax = $ajmin; $ax<= $ajmax; $ax++) {
					echo ExecuteScalar("SELECT COUNT(1) FROM `t_pp` WHERE `tahun` = ".$ax).",";
				}
				?>],
				fill: false,
				borderColor: '#EC932F',
				backgroundColor: '#EC932F',
				pointBorderColor: '#EC932F',
				pointBackgroundColor: '#EC932F',
				pointHoverBackgroundColor: '#EC932F',
				pointHoverBorderColor: '#EC932F',
				yAxisID: 'y-axis-2'
		} ,{
			type: 'bar',
			  label: "Realisasi Angkatan",
				data: [<?php 
				$bjmin = $tahun_sekarang-4;
				$bjmax = $tahun_sekarang; 
				for ($bx = $bjmin; $bx<= $bjmax; $bx++) {
					echo ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `statuspel` = 4 AND YEAR(`tawal`) = ".$bx).",";
				}
				?>],
				fill: false,
				backgroundColor: '#71B37C',
				borderColor: '#71B37C',
				hoverBackgroundColor: '#28a745',
				hoverBorderColor: '#71B37C',
				yAxisID: 'y-axis-1'
		}]
	};
	
		var ctx = document.getElementById("chart_jumlah_angkatan").getContext("2d");
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
			  title: {
				display: true,
				text: 'Data Realisasi Jumlah Angkatan dan Jumlah Peserta'
			  },
			responsive: true,
			tooltips: {
			  mode: 'label'
		  },
		  elements: {
			line: {
				fill: false
			}
		},
		  scales: {
			xAxes: [{
				display: true,
				gridLines: {
					display: false
				},
				labels: {
					show: true,
				}
			}],
			yAxes: [{
				type: "linear",
				display: true,
				position: "left",
				id: "y-axis-1",
				gridLines:{
					display: true
				},
				labels: {
					show:true,
					
				}
			}, {
				type: "linear",
				display: true,
				position: "right",
				id: "y-axis-2",
				gridLines:{
					display: false
				},
				labels: {
					show:true,
					
				}
			}]
		}
		}
		});
	
	
	
	//Download Chart Image
document.getElementById("download").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp = document.getElementById("chart_jumlah_angkatan").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a =  document.getElementById("download");
  /*insert chart image url to download button (tag: <a></a>) */
  a.href = url_base64jp;
});
	//Download Chart Image
document.getElementById("download_chart_jumlah_fasilitator").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp1 = document.getElementById("chart_jumlah_fasilitator").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a1 =  document.getElementById("download_chart_jumlah_fasilitator");
  /*insert chart image url to download button (tag: <a></a>) */
  a1.href = url_base64jp1;
});

</script>


<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$beranda->terminate();
?>