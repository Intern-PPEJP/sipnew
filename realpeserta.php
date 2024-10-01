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
$realpeserta = new realpeserta();

// Run the page
$realpeserta->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php

	// SET PENCARIAN
	$thn = isset($_GET["tahun"]) ? $_GET["tahun"] : date("Y");
	$bln = isset($_GET["bulan"]) ? $_GET["bulan"] : 1;
	$blnakhir = isset($_GET["bulan2"]) ? $_GET["bulan2"] : date("m");
	
	$bln_indo = array (1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember' );
	$linktime = "&bulan=".$bln."&bulan2=".$blnakhir."&tahun=".$thn;
	$oldy = $thn - 4;
	$yerfiv = "(" . $oldy . " - " . $thn . ")";
?>

<style>
	select.form-control{
		margin-left: 30px;
	}
</style>

<div class="row">
<div class="col-md-12">
<div class="card card-default">
  <div class="card-header">
	<h3 class="card-title">Pencarian</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form">
	<div class="card-body">
	  <div class="form-group">
		<label for="tahun">TAHUN</label>
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
		  </div><!--
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
	  </div>-->
	 
	</div>
	<!-- /.card-body -->

	<div class="card-footer">
	  <button type="cari" class="btn btn-primary">Cari</button>
	</div>
  </form>
</div>
</div>

<div class="col-md-12">
	<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Laporan Realisasi</h3>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<table class="table table-striped">
				  <thead>
				   
				  </thead>
				  <tbody>
					<tr>
					  <td>1.</td>
					  <td>Realisasi Diklat Ekspor (Per Bulan)</td>
					  <td><a href="http://localhost/ppei20/cv_pelatcpermonthlist.php?&export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>2.</td>
					  <td>Mitra Kerja Sama</td>
					  <td><a href="xprintlist.php?pg=a2&tahun=<?php echo $thn; ?>&export=excel"  class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>3.</td>
					  <td>Realisasi ECP</td>
					  <td><a href="berkas/a3.%20Realisasi%20ECP.xlsx" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>4.</td>
					  <td>Year-on-Year <?php echo $yerfiv; ?></td>
					  <td><a href="xprintlist.php?pg=a4&tahun=<?php echo $thn; ?>&export=excel" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>5.</td>
					  <td>Kota <?php echo $thn; ?></td>
					  <td><a href="xprintlist.php?pg=a5&tahun=<?php echo $thn; ?>&export=excel" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>6.</td>
					  <td>Provinsi <?php echo $thn; ?></td>
					  <td><a href="xprintlist.php?pg=a51&tahun=<?php echo $thn; ?>&export=excel" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>7.</td>
					  <td>Rekap Mitra Kerja Sama</td>
					  <td><a href="xprintlist.php?pg=a6&tahun=<?php echo $thn; ?>&export=excel" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>8.</td>
					  <td>Kota Lokasi ECP</td>
					  <td><a href="xprintlist.php?pg=a8&tahun=<?php echo $thn; ?>&export=excel" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					
				  </tbody>
				</table>
			  </div>
			  <!-- /.card-body -->
			</div>
</div>

</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$realpeserta->terminate();
?>