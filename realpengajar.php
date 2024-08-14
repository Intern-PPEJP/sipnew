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
$realpengajar = new realpengajar();

// Run the page
$realpengajar->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<script>
</script>


<?php

	// SET PENCARIAN
	$thn = isset($_GET["tahun"]) ? $_GET["tahun"] : date("Y");
	$bln = isset($_GET["bulan"]) ? $_GET["bulan"] : 1;
	$blnakhir = isset($_GET["bulan2"]) ? $_GET["bulan2"] : date("m");
	
	$bln_indo = array (1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember' );
	$linktime = "&bulan=".$bln."&bulan2=".$blnakhir."&tahun=".$thn;
?>


<div class="card card-default">
  <div class="card-header">
	<h3 class="card-title">Pencarian</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form">
	<div class="card-body">
	  <div class="form-group">
		<label for="tahun">Tahun</label>
		<select id="tahun" name="tahun" class="form-control">
			<option value="" disabled="">
				Pilih tahun</option>
				<?php 
				$jmin = 2010; // tahun terlama
				$jmax = date("Y") + 1; // 1 tahun kedepan
				$selc = "";
				for ($x = $jmin; $x<= $jmax; $x++) {
					if($x == $thn){
						$selc = " selected=\"\"";
					} else {
						$selc = "";
					}
					echo "<option value=\"".$x."\"".$selc.">".$x."</option>";
				}
				?>
		</select>
	  </div>
	  <div class="form-group">
		<label for="bulan">Bulan</label>
		<select id="bulan" name="bulan" class="form-control">
			<option value="" disabled="">Pilih bulan</option>
			<?php
			$bmin = 1;
			$bmax = 12;
			
			for ($b = $bmin; $b<= $bmax; $b++) {
					if($b == $bln){
						$selc = " selected=\"\"";
					} else {
						$selc = "";
					}
					echo "<option value=\"".$b."\"".$selc.">".$bln_indo[$b]."</option>";
				}
			?>
		</select>
		Sampai Dengan
		<select id="bulan2" name="bulan2" class="form-control">
			<option value="" disabled="">Pilih bulan</option>
			<?php
			$sbmin = 1;
			$sbmax = 12;
			for ($sb = $sbmin; $sb<= $sbmax; $sb++) {
					if($sb == $blnakhir){
						$selc2 = " selected=\"\"";
					} else {
						$selc2 = "";
					}
					echo "<option value=\"".$sb."\"".$selc2.">".$bln_indo[$sb]."</option>";
				}
			?>
		</select>
	  </div>
	 
	</div>
	<!-- /.card-body -->

	<div class="card-footer">
	  <button type="cari" class="btn btn-primary">Cari</button>
	</div>
  </form>
</div>

<?php

	//$c = ExecuteScalar("SELECT COUNT(1) FROM t_biointruktur WHERE ");

?>

<div class="row">
		  <div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
			  <div class="inner">
				<!--<h3>150</h3>-->

				<p>Jumlah Mengajar Pengajar Internal</p>
			  </div>
			  <div class="icon">
				<i class="ion ion-person-stalker"></i>
			  </div>
			  <a href="t_biointrukturlist.php?h=rpt2&rp=1&export=excel<?php echo $linktime; ?>" class="small-box-footer ew-export-link">Cetak Excel <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		  </div>
		  <!-- ./col -->
		  <div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
			  <div class="inner">
				<!--<h3>53<sup style="font-size: 20px">%</sup></h3>-->

				<p>Jumlah Mengajar Pengajar Eksternal</p>
			  </div>
			  <div class="icon">
				<i class="ion ion-ios-people"></i>
			  </div>
			  <a href="t_biointrukturlist.php?h=rpt2&rp=2&export=excel<?php echo $linktime; ?>" class="small-box-footer ew-export-link">Cetak Excel <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		  </div>
		  <!-- ./col -->
		  <div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-warning">
			  <div class="inner">
				<!--<h3>44</h3>-->

				<p>Jadwal Mengajar Pengajar Internal</p>
			  </div>
			  <div class="icon">
				<i class="ion ion-person"></i>
			  </div>
			  <a href="t_biointrukturlist.php?h=rpt1&rp=1&export=excel<?php echo $linktime; ?>" class="small-box-footer ew-export-link">Cetak Excel <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		  </div>
		  <!-- ./col -->
		  <div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-danger">
			  <div class="inner">
				<!--<h3>65</h3>-->

				<p>Jadwal Mengajar Pengajar Eskternal</p>
			  </div>
			  <div class="icon">
				<i class="ion ion-person-add"></i>
			  </div>
			  <a href="t_biointrukturlist.php?h=rpt1&rp=2&export=excel<?php echo $linktime; ?>" class="small-box-footer ew-export-link">Cetak Excel <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		  </div>
		  <!-- ./col -->
		</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$realpengajar->terminate();
?>