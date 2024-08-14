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


<?php
	if(!isset($_POST["tahun"])){
		$tahun_sekarang = "";
	} else {
		$tahun_sekarang = $_POST["tahun"];
	}
	
	$filter_tahun = "AND YEAR(a.tawal) = ".$tahun_sekarang;

?>
<style>
.lhome { color: #000; }
.lhome:hover { text-decoration: none; color: #000;}
.bhome:hover {transform: scale(1.1); z-index: 99;}

.mb-0 {display:none;}

.sidebar-collapse .content-header .text-dark{display:none;}


.nav-tabs {
	font-size: 15px;
	margin-bottom: 0;
	-webkit-align-items: center; 
	align-items: center; 
	font-weight: bold;
}
.nav-tabs .nav-link {
	
	border-color: #dee2e6 #dee2e6 #fff;
}



.modal {
  padding: 0 !important; // override inline padding-right added from js
}
.modal .modal-dialog {
  width: 100%;
  max-width: none;
  height: 100%;
  margin: 0;
}
.modal .modal-content {
  height: 100%;
  border: 0;
  border-radius: 0;
}
.modal .modal-body {
  overflow-y: auto;
}
</style>




<ul class="nav nav-tabs" id="beranda-tab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="beranda-ecp-tab" data-toggle="pill" href="#beranda-ecp" role="tab" aria-controls="beranda-ecp" aria-selected="false">ECP</a>
</li>
<li class="nav-item">
<a class="nav-link" id="beranda-profile-tab" data-toggle="pill" href="#beranda-profile" role="tab" aria-controls="beranda-profile" aria-selected="true">PELATIHAN</a>
</li>
<li class="nav-item">
<a class="nav-link" id="beranda-messages-tab" data-toggle="pill" href="#beranda-messages" role="tab" aria-controls="beranda-messages" aria-selected="false">FASILITATOR</a>
</li>
<li class="nav-item">
<a class="nav-link" id="beranda-settings-tab" data-toggle="pill" href="#beranda-settings" role="tab" aria-controls="beranda-settings" aria-selected="false">WEBINAR</a>
</li>

<!-- START DROPDOWN TAHUN -->
<li class="ml-auto">
<select id="tahun" name="tahun" class="form-control"  onchange="this.form.submit();">
	<option value="">Semua tahun</option>
		<?php 
		$thn = date("Y");
		$jmin = 2010; // tahun terlama
		$jmax = date("Y") + 1; // 1 tahun kedepan
		$selc = "";
		if(!isset($_POST["tahun"])){
			$tahun_sekarang = "";
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
	</select>
</li>
<!-- END DROPDOWN TAHUN -->

</ul>


<div class="tab-content" id="beranda-tabContent">

<!-- START HALAMAN ECP -->
<div class="tab-pane fade active show" id="beranda-ecp" role="tabpanel" aria-labelledby="beranda-ecp-tab">

<!-- START CHART UTAMA -->
<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body"  class="table-responsive" style="overflow-x:auto;">

		<a id="download" download="chart_ecp.jpg" href="" class="btn btn-primary float-right bg-flat-color-1" title="Download chart"><i class="fa fa-download"></i></a>
		<canvas id="chart_ecp" class="table" ></canvas>

			</div> <!-- end card-body-->
		</div> <!-- end card-->

	</div>
</div>
<!-- END CHART UTAMA -->

<!-- START ANGKA -->
<?php
	$caritahun = "";
	$caritahun_cp = "";
	$caritahun_cpx = "";
	if($tahun_sekarang>0){
		$caritahun = " WHERE `Tahun_ECP` =".$tahun_sekarang;
		$caritahun_cp = " WHERE `tahun_keg` = ".$tahun_sekarang;
		$caritahun_cpx = " WHERE `tahun_ecp` = ".$tahun_sekarang;
	}
	$jangkatanecp = ExecuteScalar("SELECT COUNT(1) FROM `t_rkcoaching`".$caritahun_cp.""); 
	$jpes_ecp = ExecuteScalar("SELECT COUNT(1) FROM `t_pcp`".$caritahun_cpx."");
	$jpes_berhasil = ExecuteScalar("SELECT SUM(cc) FROM (SELECT Wilayah_ECP, COUNT(DISTINCT Nama) cc FROM `t_ecp`".$caritahun." GROUP BY Wilayah_ECP) x"); 
	$tnil = ExecuteScalar("SELECT SUM(Nilai_Ekspor_USD) FROM `t_ecp`".$caritahun." LIMIT 1"); 
	$jnte = ExecuteScalar("SELECT COUNT(1) FROM (SELECT COUNT(Negara_Tujuan) FROM `t_ecp`".$caritahun." GROUP BY Negara_Tujuan) x");

?>

<div class="row">
	<div class="col-lg col-md-4 col-sm-12 col-xs-12 rev5"><a href="#<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
		<div class="info-box bhome">
			  <span class="info-box-icon elevation-1"><img src="images/icons/map.png" width="50px"></img></span>
		<div class="info-box-content">
			<h6 class="text-muted font-weight-normal mt-0" title="Jumlah Angkatan ECP">JUMLAH ANGKATAN ECP</h6>
			<h4><?php echo $jangkatanecp; ?></h4>
			</div>
		</div>
	</a>
	</div> <!-- end col-->
	<div class="col-lg col-md-4 col-sm-12 col-xs-12 rev5"><a href="#<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
		<div class="info-box bhome">
			  <span class="info-box-icon elevation-1"><img src="images/icons/group.png" width="50px"></img></span>
		<div class="info-box-content">
			<h6 class="text-muted font-weight-normal mt-0" title="Jumlah Wilayah ECP">JUMLAH PESERTA ECP</h6>
			<h4><?php echo $jpes_ecp; ?></h4>
			</div>
		</div>
	</a>
	</div> <!-- end col-->
	<div class="col-lg col-md-4 col-sm-12 col-xs-12 rev4"><a href="#<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
		<div class="info-box bhome">
			  <span class="info-box-icon elevation-1"><img src="images/icons/user.png" width="50px"></img></span>
		<div class="info-box-content">
			<h6 class="text-muted font-weight-normal mt-0" title="Jumlah Peserta Berhasil Ekspor">JUMLAH PESERTA BERHASIL EKSPOR</h6>
			<h4><?php echo $jpes_berhasil; ?></h4>
			</div>
		</div>
	</a>
	</div> <!-- end col-->
	<div class="col-lg col-md-6 col-sm-12 col-xs-12 rev4"><a href="#<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
		<div class="info-box bhome">
			  <span class="info-box-icon elevation-1"><img src="images/icons/dollar.png" width="50px"></img></span>
		<div class="info-box-content">
			<h6 class="text-muted font-weight-normal mt-0" title="Total Nilai Ekspor (USD)">TOTAL NILAI EKSPOR (USD)</h6>
			<h4><?php echo number_format($tnil,2); ?></h4>
			</div>
		</div>
	</a>
	</div> <!-- end col-->
	<div class="col-lg col-md-6 col-sm-12 col-xs-12 rev3"><a href="#<?php echo $tahun_sekarang; ?>&l=ref" class="lhome">
		<div class="info-box bhome">
			  <span class="info-box-icon elevation-1"><img src="images/icons/destination.png" width="50px"></img></span>
		<div class="info-box-content">
			<h6 class="text-muted font-weight-normal mt-0" title="Jumlah Negara Tujuan Ekspor">JUMLAH NEGARA TUJUAN EKSPOR</h6>
			<h4><?php echo $jnte; ?></h4>
			</div>
		</div>
	</a>
	</div> <!-- end col-->
</div>
<!-- END ANGKA -->

<!-- START CHART ANGKA -->
<div class="row">
	<div class="col-12 col-lg-6 rev4">
	 <div class="card card-danger">
	  <div class="card-header" style="background:#225994">
		<h3 class="card-title">JUMLAH PESERTA BERHASIL EKSPOR PER WILAYAH <span class="badge badge-info float-right" style=""><?php echo $tahun_sekarang; ?></span></h3>

	  </div>
	  <div class="card-body" style="" >
		
			  <canvas id="piechart_1"  style="height:60vh; width:55vw" class="chartjs-render-monitor"></canvas>
	  </div>
	  </div>
	</div> <!-- end col-->

	<div class="col-12 col-lg-6 rev4">
	 <div class="card card-danger">
	  <div class="card-header" style="background:#225994">
		<h3 class="card-title">NILAI EKSPOR (USD) PER WILAYAH <span class="badge badge-info float-right" style=""><?php echo $tahun_sekarang; ?></span></h3>

	  </div>
	  <div class="card-body" style="" >
		
			  <canvas id="piechart_2"  style="height:60vh; width:55vw" class="chartjs-render-monitor"></canvas>
	  </div>
	  </div>
	</div> <!-- end col-->



	<div class="col-12 col-lg-6 rev3">
	 <div class="card card-danger">
	  <div class="card-header" style="background:#225994">
		<h3 class="card-title">NEGARA TUJUAN EKSPOR<span class="badge badge-info float-right" style=""><?php echo $tahun_sekarang; ?></span></h3>

	  </div>
	  <div class="card-body" style="" >
		
			  <canvas id="piechart_3"  style="height:60vh; width:55vw" class="chartjs-render-monitor"></canvas>
	  </div>
	  </div>
	</div> <!-- end col-->

	<div class="col-12 col-lg-6 rev5">
	 <div class="card card-danger">
	  <div class="card-header" style="background:#225994">
		<h3 class="card-title">JUMLAH PESERTA ECP PER WILAYAH <span class="badge badge-info float-right" style=""><?php echo $tahun_sekarang; ?></span></h3>

	  </div>
	  <div class="card-body" style="" >
	  <center>
			  <canvas id="piechart_4"  style="height:60vh; width:55vw" class="chartjs-render-monitor"></canvas>
	  </center>
	  </div>
	  </div>
	</div> <!-- end col-->

</div>
<!-- END CHART ANGKA-->

<!-- START TOP FIVE -->
<div class="row">
  <div class="col-6">
	<!-- PIE CHART -->
	<div class="card card-danger">
	  <div class="card-header" style="background:#225994">
		<h3 class="card-title">TOP 5 : NILAI EKSPOR PER DAERAH <span class="badge badge-info float-right" style=""><?php echo $tahun_sekarang; ?></span></h3>
	  </div>
	  <div class="card-body" style="min-height: 100%; max-width: 100%; display: block;" >
				<div class="table-responsive" style="overflow-x:scroll">
				  <table class="table table-borderless">
					<thead>
					  <tr>
						<th scope="col"></th>
						<th scope="col">DAERAH</th>
						<th scope="col">TAHUN</th>
						<th scope="col">TOTAL</th>
					  </tr>
					</thead>
					<tbody>
					<?php 
					$caritahun = "";
					if($tahun_sekarang>0){
						$caritahun = " WHERE Tahun_ECP =".$tahun_sekarang;
					}
					$rs = Execute("SELECT Wilayah_ECP, SUM(Nilai_Ekspor_USD) Nilai_Ekspor_USD, Tahun_ECP FROM `t_ecp`".$caritahun." GROUP BY Wilayah_ECP ORDER BY Nilai_Ekspor_USD DESC LIMIT 5"); // baca data dari tabel
					if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
						$rs->MoveFirst(); // mulai dari record pertama
						$no=1;
						while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset
							//echo $rs->fields("Theme_ID")." - " .$rs->fields("Theme_Name"). "<br>";  // tampilkan hasilnya
					?>
					  <tr>
						<th scope="row"><?php echo $no; ?></th>
						<td nowrap><?php echo $rs->fields("Wilayah_ECP"); ?></td>
						<td nowrap><?php echo $rs->fields("Tahun_ECP"); ?></td>
						<td nowrap><?php echo number_format($rs->fields("Nilai_Ekspor_USD"),2); ?> USD</td>
					  </tr>
					 <?php
							$no++;
							$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
						} // akhir loop
						$rs->Close(); // tutup recordset jika sudah selesai
					} else { // jika jumlah record tidak lebih besar dari nol
						echo "Tidak ada data ditemukan."; // tampilkan pesan tidak ada record
					} // akhir pemeriksaan record
					?>
					</tbody>

				  </table>
				</div>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->

  </div>
  <!-- /.col (LEFT) -->
	<div class="col-6">
	
	<div class="card card-danger">
	  <div class="card-header" style="background:#225994">
		<h3 class="card-title">TOP 5 : NILAI EKSPOR PER PESERTA <span class="badge badge-info float-right" style=""><?php echo $tahun_sekarang; ?></span></h3>

	  </div>
	  <div class="card-body" style="min-height: 100%; max-width: 100%; display: block;" >
				<div class="table-responsive" style="overflow-x:scroll">
				  <table class="table table-borderless">
					<thead>
					  <tr>
						<th scope="col"></th>
						<th scope="col">PESERTA</th>
						<th scope="col">WILAYAH</th>
						<th scope="col">TAHUN</th>
						<th scope="col">TOTAL</th>
						<th scope="col">PRODUK EKSPOR</th>
					  </tr>
					</thead>
					<tbody>
					 <?php 
					$caritahun = "";
					if($tahun_sekarang>0){
						$caritahun = " WHERE Tahun_ECP =".$tahun_sekarang;
					}
					$rs = Execute("SELECT Perusahaan, SUM(Nilai_Ekspor_USD) Nilai_Ekspor_USD, Wilayah_ECP, Tahun_ECP, Produk FROM `t_ecp`".$caritahun." GROUP BY Nama ORDER BY Nilai_Ekspor_USD DESC LIMIT 5"); // baca data dari tabel
					if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
						$rs->MoveFirst(); // mulai dari record pertama
						$no=1;
						while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset
							//echo $rs->fields("Theme_ID")." - " .$rs->fields("Theme_Name"). "<br>";  // tampilkan hasilnya
					?>
					  <tr>
						<th scope="row"><?php echo $no; ?></th>
						<td nowrap><?php echo $rs->fields("Perusahaan"); ?></td>
						<td nowrap><?php echo $rs->fields("Wilayah_ECP"); ?></td>
						<td nowrap><?php echo $rs->fields("Tahun_ECP"); ?></td>
						<td nowrap><?php echo number_format($rs->fields("Nilai_Ekspor_USD"),2); ?> USD</td>
						<td nowrap><?php echo $rs->fields("Produk"); ?></td>
					  </tr>
					 <?php
							$no++;
							$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
						} // akhir loop
						$rs->Close(); // tutup recordset jika sudah selesai
					} else { // jika jumlah record tidak lebih besar dari nol
						echo "Tidak ada data ditemukan."; // tampilkan pesan tidak ada record
					} // akhir pemeriksaan record
					?>
					</tbody>

				  </table>
				</div>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->

  </div>
  <!-- /.col (LEFT) -->
</div>

<!-- END TOP FIVE -->



</div> 
<!-- END HALAMAN ECP -->

<!-- START HALAMAN PELATIHAN -->
<div class="tab-pane fade" id="beranda-profile" role="tabpanel" aria-labelledby="beranda-profile-tab">

<!-- START CHART UTAMA PELATIHAN-->
<div class="row">
	<div class="col-xl-12 col-lg-6">
		<div class="card">
			<div class="card-body" style="position: relative;">

		<a id="download_pelat" download="chart_pelat.jpg" href="" class="btn btn-primary float-right bg-flat-color-1" title="Download chart"><i class="fa fa-download"></i></a>
		<canvas id="chart_pelat" width="800" height="320"></canvas>

			</div> <!-- end card-body-->
		</div> <!-- end card-->

	</div>
</div>
<!-- END CHART UTAMA -->


</div>
<!-- END HALAMAN PELATIHAN -->


<div class="tab-pane fade" id="beranda-messages" role="tabpanel" aria-labelledby="beranda-messages-tab">
	HALAMAN FASILITATOR
</div>
<div class="tab-pane fade" id="beranda-settings" role="tabpanel" aria-labelledby="beranda-settings-tab">
	HALAMAN WEBINAR
</div>

</div>
<!-- END TAB HALAMAN -->


</form>



<div class="modal fade" id="ppejp_modal" tabindex="-1" role="dialog" aria-labelledby="ppejp_modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ppejp_modalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        no data!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<!--<script src="<?php echo $RELATIVE_PATH ?>js/charts2.0.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>

<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>

<!-- CHART UTAMA ECP -->
<?php 
	$jmin = 2010; // tahun terlama
	$jmax = date("Y");
	$tahun_ecp = "";
	$jumlah_ecp = "";
	$tahun_ekspor = "";
	$jumlah_ekspor = "";	
	
	for ($x = $jmin; $x<= $jmax; $x++) {
		
		
		$ROW_ecp = ExecuteRow("SELECT tahun_ecp, COUNT(1) cc FROM `t_pcp` GROUP BY tahun_ecp HAVING tahun_ecp = ".$x);
		$ROW_ekspor = ExecuteRow("SELECT SUM(nn) cc FROM (SELECT Tahun_ECP, COUNT(DISTINCT Nama) nn FROM `t_ecp` GROUP BY Tahun_ECP HAVING Tahun_ECP = ".$x.") x");
		
		if($ROW_ecp["cc"] == 0){
			$ROW_ecp["tahun_ecp"] = $x;
			$ROW_ecp["cc"] = 0;
		}
		
		if($ROW_ekspor["cc"] == 0){
			$ROW_ekspor["cc"] = 0;
		}
		
		$tahun_ecp .= $ROW_ecp["tahun_ecp"].",";
		$jumlah_ecp .= $ROW_ecp["cc"].",";
		
		
		$jumlah_ekspor .= $ROW_ekspor["cc"].",";
		
		
	}
	
?>

<style>
1canvas#chart_ecp {
  background-color: rgb(244 246 249);
  padding: 10px;
}
</style>
<script>
function square_data(chart){
    var c = document.createElement("canvas");
    var ctx = c.getContext("2d");
	ctx.font = "bold 14px serif";
    ctx.fillStyle = "rgb(244 246 249 / 55%)";
   // ctx.rect(140, 55, 20, 15);
    ctx.fill()
    ctx.fillStyle = "#000";
    ctx.fillText(chart.dataset.data[chart.dataIndex], 142, 72, 15);
	
    ctx.stroke();
    return c
}

var ctx = document.getElementById('chart_ecp').getContext('2d');
var tahun_ecp = [<?php echo $tahun_ecp; ?>];
var jumlah_ecp = [<?php echo $jumlah_ecp; ?>];
var tahun_ekspor = [<?php echo $tahun_ekspor; ?>];
var jumlah_ekspor = [<?php echo $jumlah_ekspor; ?>];

var myChart = new Chart(ctx, {
			type: 'line',
    data: {
        labels: tahun_ecp,
		
        datasets: [{
            
	    label: 'JUMLAH PESERTA ECP',
            data: jumlah_ecp,
            backgroundColor: [
                'rgb(25 85 157)'
            ],
           fill: false,
		   tension: 0,
            borderColor: [
                'rgb(25 85 157)'
            ],
            borderWidth: 2
        },{
            
	    label: 'JUMLAH PESERTA EKSPOR',
            data: jumlah_ekspor,
            backgroundColor: [
                'rgb(40 167 69)'
            ],
           fill: false,
		   tension: 0,
            borderColor: [
                '#28a745'
            ],
            borderWidth: 2
        }],
    },
    options: {
		legend: {
            labels: {
				 fontSize: 18
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false
                }
            }]
        },
		
        elements:{
        	"point":{"pointStyle":square_data},
        },
    }
});

	
	//Download Chart Image
document.getElementById("download").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp = document.getElementById("chart_ecp").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a =  document.getElementById("download");
  /*insert chart image url to download button (tag: <a></a>) */
  a.href = url_base64jp;
});


</script>


<?php
	$sqlku = "SELECT Wilayah_ECP,COUNT(DISTINCT Nama) cc FROM `t_ecp`".$caritahun." GROUP BY Wilayah_ECP ORDER BY cc DESC LIMIT 10";
	
	$rs = LoadRecordset($sqlku);
	$ROWS = $rs->GetRows();
	if(count($ROWS) > 0){
		$val_wil = "";
		$val_pes = "";
		foreach($ROWS AS $ROW){
			$val_wil .= "'".$ROW["Wilayah_ECP"]."',";
			$val_pes .= $ROW["cc"].",";
		}
	}
	$not_in1 = substr_replace($val_wil ,"", -1);
	$sql_others1 = "SELECT COUNT(DISTINCT Nama) cc FROM `t_ecp` WHERE Wilayah_ECP NOT IN (".$not_in1.")";
	$other1 = ExecuteScalar($sql_others1);
?>
<?php
	$rs_a = LoadRecordset("SELECT Wilayah_ECP, SUM(Nilai_Ekspor_USD) cc FROM `t_ecp`".$caritahun." GROUP BY Wilayah_ECP ORDER BY cc DESC LIMIT 10");
	$ROWS_a = $rs_a->GetRows();
	if(count($ROWS_a) > 0){
		$wil = "";
		$nilai = "";
		foreach($ROWS_a AS $ROW_a){
			$wil .= "'".$ROW_a["Wilayah_ECP"]."',";
			$nilai .= $ROW_a["cc"].",";
		}
	}
	$not_in2 = substr_replace($wil ,"", -1);
	$sql_others2 = "SELECT SUM(Nilai_Ekspor_USD) cc FROM `t_ecp` WHERE Wilayah_ECP NOT IN (".$not_in2.")";
	$other2 = ExecuteScalar($sql_others2);
?>

<?php
	$rs_b = LoadRecordset("SELECT Negara_Tujuan, COUNT(1) cc FROM `t_ecp`".$caritahun." GROUP BY Negara_Tujuan ORDER BY cc DESC, Negara_Tujuan ASC LIMIT 10");
	$ROWS_b = $rs_b->GetRows();
	if(count($ROWS_b) > 0){
		$wil_b = "";
		$nilai_b = "";
		foreach($ROWS_b AS $ROW_b){
			$wil_b .= "'".$ROW_b["Negara_Tujuan"]."',";
			$nilai_b .= $ROW_b["cc"].",";
		}
	}
	$not_in3 = substr_replace($wil_b ,"", -1);
	$sql_others3 = "SELECT COUNT(1) cc FROM `t_ecp` WHERE Negara_Tujuan NOT IN (".$not_in3.")";
	$other3 = ExecuteScalar($sql_others3);
?>
<?php
	$rs_c = LoadRecordset("SELECT wilayah_ecp,COUNT(1) cc FROM `t_pcp`".$caritahun." GROUP BY wilayah_ecp ORDER BY cc DESC LIMIT 10");
	$ROWS_c = $rs_c->GetRows();
	if(count($ROWS_c) > 0){
		$wil_c = "";
		$nilai_c = "";
		foreach($ROWS_c AS $ROW_c){
			$wil_c .= "'".$ROW_c["wilayah_ecp"]."',";
			$nilai_c .= $ROW_c["cc"].",";
		}
	}
	$not_in4 = substr_replace($wil_c ,"", -1);
	$sql_others4 = "SELECT COUNT(1) cc FROM `t_pcp` WHERE wilayah_ecp NOT IN (".$not_in4.")";
	$other4 = ExecuteScalar($sql_others4);
?>
<script>
function square_data_pie(chart){
    var c = document.createElement("canvas");
    var ctxP = c.getContext("2d");
	
    ctxP.fillStyle = "red";
    
    return c
}

var myData = [<?php echo $val_wil."'Others'"; ?>];
var myLabels = [<?php echo $val_pes.$other1; ?>];
var bgColor = ["#878BB6", "#FFEA88", "#FF8153", "#4ACAB4", "#c0504d", "#8064a2", "#772c2a", "#f2ab71", "#2ab881", "#4f81bd", "#2c4d75", "#ec46f7", "#62e967", "#2debe2", "#ff6da3", "#893fff", "#444444", "#625511", "#95c2f3"];

var canvasP = document.getElementById("piechart_1");
var ctxP = canvasP.getContext('2d');
var myPieChart = new Chart(ctxP, {
   type: 'doughnut',
   data: {
      labels: myData,
      datasets: [{
         data: myLabels,
         backgroundColor: bgColor,
         //hoverBackgroundColor: ["#B2EBF2", "#FFCCBC", "#4DD0E1", "#FF8A65", "#00BCD4", "#FF5722", "#0097A7"]
      }]
   },
   options: {
      legend: {
         display: true,
         position: "right",
		 labels: {
			 usePointStyle: true  
		  }
      },
		
        elements:{
        	"point":{"pointStyle":square_data_pie},
        },
	  responsive: true,
      maintainAspectRatio: true,
      plugins: {
        labels: [{
          render: 'percentage',
          fontColor: bgColor,
          precision: 2,
		  fontSize: 14,fontStyle: "normal",

          // font family, default is defaultFontFamily
          fontFamily:
            "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

          // draw text shadows under labels, default is false
          // textShadow: true,

          // text shadow intensity, default is 6
          shadowBlur: 10,

          // text shadow X offset, default is 3
          shadowOffsetX: -5,

          // text shadow Y offset, default is 3
          shadowOffsetY: 5,

          // text shadow color, default is 'rgba(0,0,0,0.3)'
          // shadowColor: "rgba(255,0,0,0.75)",

          // draw label in arc, default is false
          // bar chart ignores this
          arc: false,

          // position to draw label, available value is 'default', 'border' and 'outside'
          // bar chart ignores this
          // default is 'default'
          position: "outside",

          // draw label even it's overlap, default is true
          // bar chart ignores this
          overlap: true,

          // show the real calculated percentages from the values and don't apply the additional logic to fit the percentages to 100 in total, default is false
          showActualPercentages: true,

          // add padding when position is `outside`
          // default is 2
          outsidePadding: 10,

          // add margin of text when position is `outside` or `border`
          // default is 2
          textMargin: 4
        },{
		  render: 'value',
		  position: 'default',
          arc: false,
		  fontSize: 10,
		  fontColor: '#fff',
	    }
		
		]
      },	
   }
});

/*

canvasP.onclick = function(e) {
  var slice = myPieChart.getElementAtEvent(e);
    
   if (!slice.length) return; // return if not clicked on slice
   var label = slice[0]._model.label;
   
   $('#ppejp_modal').modal('show');
   
   $('.modal-title').html('Data');
   
   switch (label) {
      // add case for each label/slice
	 
     <?php
	 $dataq=explode(",", $val_wil);
	 $val = explode(",", $val_pes);
	 
	 $datax=explode(",", $val_wil);
	  foreach ($dataq as $key => $data) {
		if($data=='') continue;
		echo "
			case ".$data.":";
		?>
		
		
   var mvalue = <?php echo $datax[$key]; ?>;
   var url = ew.API_URL, action = "getWilayahECP", id = encodeURIComponent( mvalue );
    //$.get(url + "/" + action + "?ProductID=" + id, function(res) { // URL format if URL Rewrite enabled
    $.get(url + "?action=" + action + "&wilayah=" + id + "&tahun= <?php echo $tahun_sekarang; ?>", function(res) { // Get response from custom API action
        if (res)
            $('.modal-body').html(res); // Set the result (manipulate it first if necessary) to the target field
    });


		<?php
        echo "break;";

    }

	?>
   }
	
}

*/
</script>

<script>
var myData_a = [<?php echo $wil."'Others'"; ?>];
var myLabels_a = [<?php echo $nilai.$other2; ?>];
var bgColor = ["#878BB6", "#FFEA88", "#FF8153", "#4ACAB4", "#c0504d", "#8064a2", "#772c2a", "#f2ab71", "#2ab881", "#4f81bd", "#2c4d75", "#ec46f7", "#62e967", "#2debe2", "#ff6da3", "#893fff", "#444444", "#625511", "#95c2f3"];


var canvas2 = document.getElementById("piechart_2");
var ctx2 = canvas2.getContext('2d');
var myPieChart2 = new Chart(ctx2, {"type":"doughnut",options: { title: { display: false, text: ' NILAI EKSPOR (USD) PER WILAYAH' }, legend: { display: true, position: "right", labels: { usePointStyle: true } }, elements:{ "point":{"pointStyle":square_data_pie}, }, responsive: true, maintainAspectRatio: true, plugins: { labels: [{ render: 'percentage', fontColor: bgColor, precision: 2, fontSize: 14,fontStyle: "normal", fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif", shadowBlur: 10, shadowOffsetX: -5, shadowOffsetY: 5, arc: false, position: "outside", overlap: true, showActualPercentages: true, outsidePadding: 10, textMargin: 4 },{ render: 'label', position: 'default', arc: false, fontSize: 10, fontColor: '#fff', } ] },},"data":{"labels":myData_a,"datasets":[{"label":"Total Nilai Ekspor","data":myLabels_a,"backgroundColor":bgColor}]}});





canvas2.onclick = function(e) {
  var slice = myPieChart.getElementAtEvent(e);
    
   if (!slice.length) return; // return if not clicked on slice
   var label = slice[0]._model.label;
   
   $('#ppejp_modal').modal('show');
   
   $('.modal-title').html('Data');
   
   switch (label) {
      // add case for each label/slice
	 
     <?php
	 $dataq2=explode(",", $wil);
	 
	 $datax2=explode(",", $wil);
	  foreach ($dataq2 as $key2 => $data2) {
		if($data2=='') continue;
		echo "
			case ".$data2.":";
		?>
		
		
   var mvalue2 = <?php echo $datax2[$key2]; ?>;
   var url = ew.API_URL, action = "getPesertaECP", id = encodeURIComponent( mvalue2 );
    //$.get(url + "/" + action + "?ProductID=" + id, function(res) { // URL format if URL Rewrite enabled
    $.get(url + "?action=" + action + "&wilayah=" + id + "&tahun= <?php echo $tahun_sekarang; ?>", function(res) { // Get response from custom API action
        if (res)
            $('.modal-body').html(res); // Set the result (manipulate it first if necessary) to the target field
    });


		<?php
        echo "break;";

    }

	?>
   }
	
}

</script>

<script>
var myData_b = [<?php echo $nilai_b.$other3; ?>];
var myLabels_b = [<?php echo $wil_b."'Others'"; ?>];
var bgColor = ["#878BB6", "#FFEA88", "#FF8153", "#4ACAB4", "#c0504d", "#8064a2", "#772c2a", "#f2ab71", "#2ab881", "#4f81bd", "#2c4d75", "#ec46f7", "#62e967", "#2debe2", "#ff6da3", "#893fff", "#444444", "#625511", "#95c2f3"];
new Chart(document.getElementById("piechart_3"),{"type":"doughnut",options: { title: { display: false, text: ' NEGARA TUJUAN EKSPOR PER WILAYAH' }, legend: { display: true, position: "right", labels: { usePointStyle: true } }, elements:{ "point":{"pointStyle":square_data_pie}, }, responsive: true, maintainAspectRatio: true, plugins: { labels: [{ render: 'percentage', fontColor: bgColor, precision: 2, fontSize: 14,fontStyle: "normal", fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif", shadowBlur: 10, shadowOffsetX: -5, shadowOffsetY: 5, arc: false, position: "outside", overlap: true, showActualPercentages: true, outsidePadding: 10, textMargin: 4 },{ render: 'value', position: 'default', arc: false, fontSize: 10, fontColor: '#fff', } ] }, },"data":{"labels":myLabels_b,"datasets":[{"label":"Total NTE","data":myData_b,"backgroundColor":bgColor}]}});
</script>

<script>
var myData_c = [<?php echo $nilai_c.$other4; ?>];
var myLabels_c = [<?php echo $wil_c."'Others'"; ?>];
var bgColor = ["#878BB6", "#FFEA88", "#FF8153", "#4ACAB4", "#c0504d", "#8064a2", "#772c2a", "#f2ab71", "#2ab881", "#4f81bd", "#2c4d75", "#ec46f7", "#62e967", "#2debe2", "#ff6da3", "#893fff", "#444444", "#625511", "#95c2f3"];
new Chart(document.getElementById("piechart_4"),{"type":"doughnut",options: { title: { display: false, text: ' ECP PER WILAYAH' }, legend: { display: true, position: "right", labels: { usePointStyle: true } }, elements:{ "point":{"pointStyle":square_data_pie}, }, responsive: true, maintainAspectRatio: true, plugins: { labels: [{ render: 'percentage', fontColor: bgColor, precision: 2, fontSize: 14,fontStyle: "normal", fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif", shadowBlur: 10, shadowOffsetX: -5, shadowOffsetY: 5, arc: false, position: "outside", overlap: true, showActualPercentages: true, outsidePadding: 10, textMargin: 4 },{ render: 'value', position: 'default', arc: false, fontSize: 10, fontColor: '#fff', } ] }, },"data":{"labels":myLabels_c,"datasets":[{"label":"Total Wilayah","data":myData_c,"backgroundColor":bgColor}]}});</script>



<!-- CHART UTAMA PELATIHAN -->
<?php
	$rs_pelat = LoadRecordset("SELECT YEAR(tawal) tahun_pelatihan, COUNT(1) cc FROM `t_pelatihan` GROUP BY YEAR(tawal)");
	$ROWS_pelat = $rs_pelat->GetRows();
	if(count($ROWS_pelat) > 0){
		$tahun_pelatihan = "";
		$jumlah_pelatihan = "";
		foreach($ROWS_pelat AS $ROW_pelat){
			$tahun_pelatihan .= "'".$ROW_pelat["tahun_pelatihan"]."',";
			$jumlah_pelatihan .= $ROW_pelat["cc"].",";
		}
	}
?>


<script>
var ctx = document.getElementById('chart_pelat').getContext('2d');
var tahun_pelatihan = [<?php echo $tahun_pelatihan; ?>];
var jumlah_pelatihan = [<?php echo $jumlah_pelatihan; ?>];

var myChart = new Chart(ctx, {
			type: 'line',
    data: {
        labels: tahun_pelatihan,
        datasets: [{
            
	    label: 'JUMLAH DATA PELATIHAN',
            data: jumlah_pelatihan,
            backgroundColor: [
                'rgb(25 85 157)'
            ],
           fill: false,
		   tension: 0,
            borderColor: [
                'rgb(25 85 157 / 65%)'
            ],
            borderWidth: 2
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false
                }
            }]
        }
    }
});

	
	//Download Chart Image
document.getElementById("download_pelat").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp = document.getElementById("chart_pelat").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a =  document.getElementById("download_pelat");
  /*insert chart image url to download button (tag: <a></a>) */
  a.href = url_base64jp;
});


</script>
<script>

$( ".rev3" ).click(function() {
	
   $('#ppejp_modal').modal('show');
   
   $('.modal-title').html('Data');
   
   var mvalue = 1;
   var url = ew.API_URL, action = "getNTE", id = encodeURIComponent( mvalue );
    //$.get(url + "/" + action + "?ProductID=" + id, function(res) { // URL format if URL Rewrite enabled
    $.get(url + "?action=" + action + "&id=" + id + "&tahun= <?php echo $tahun_sekarang; ?>", function(res) { // Get response from custom API action
        if (res)
            $('.modal-body').html(res); // Set the result (manipulate it first if necessary) to the target field
    });

});


$( ".rev4" ).click(function() {
	
   $('#ppejp_modal').modal('show');
   
   $('.modal-title').html('Data');
   
   var mvalue = 1;
   var url = ew.API_URL, action = "getPesertaEkspor", id = encodeURIComponent( mvalue );
    //$.get(url + "/" + action + "?ProductID=" + id, function(res) { // URL format if URL Rewrite enabled
    $.get(url + "?action=" + action + "&id=" + id + "&tahun= <?php echo $tahun_sekarang; ?>", function(res) { // Get response from custom API action
        if (res)
            $('.modal-body').html(res); // Set the result (manipulate it first if necessary) to the target field
    });

});


$( ".rev5" ).click(function() {
	
   $('#ppejp_modal').modal('show');
   
   $('.modal-title').html('Data');
   
   var mvalue = 1;
   var url = ew.API_URL, action = "getPesertaECP", id = encodeURIComponent( mvalue );
    //$.get(url + "/" + action + "?ProductID=" + id, function(res) { // URL format if URL Rewrite enabled
    $.get(url + "?action=" + action + "&id=" + id + "&tahun= <?php echo $tahun_sekarang; ?>&rev=rev5", function(res) { // Get response from custom API action
        if (res)
            $('.modal-body').html(res); // Set the result (manipulate it first if necessary) to the target field
    });

});


$("body").addClass("sidebar-collapse");
</script>
<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>

<?php
$beranda->terminate();
?>