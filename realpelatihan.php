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
$realpelatihan = new realpelatihan();

// Run the page
$realpelatihan->run();

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
?>

<style>
	.form-group {
  margin-bottom: 5px;
}

select.form-control {
  width: 100%; /* Pastikan elemen select memiliki lebar penuh */
}

.card-footer {
  margin-top: 20px;
}

</style>

<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Pencarian</h3>
  </div>
  <form role="form">
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="tahun">TAHUN</label>
          <select id="tahun" name="tahun" class="form-control">
            <option value="" disabled>Pilih tahun</option>
            <?php 
            $jmin = 2010; // tahun terlama
            $jmax = date("Y") + 1; // 1 tahun kedepan
            $selc = "";
            for ($x = $jmin; $x <= $jmax; $x++) {
              if($x == $thn){
                $selc = " selected";
              } else {
                $selc = "";
              }
              echo "<option value=\"".$x."\"".$selc.">".$x."</option>";
            }
            ?>
          </select>
        </div>
        
        <div class="form-group col-md-4">
          <label for="bulan">BULAN</label>
          <select id="bulan" name="bulan" class="form-control">
            <option value="" disabled>Pilih bulan</option>
            <?php
            for ($b = 1; $b <= 12; $b++) {
              if($b == $bln){
                $selc = " selected";
              } else {
                $selc = "";
              }
              echo "<option value=\"".$b."\"".$selc.">".$bln_indo[$b]."</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group col-md-4">
          <label for="bulan2">SAMPAI DENGAN</label>
          <select id="bulan2" name="bulan2" class="form-control">
            <option value="" disabled>Pilih bulan</option>
            <?php
            for ($sb = 1; $sb <= 12; $sb++) {
              if($sb == $blnakhir){
                $selc2 = " selected";
              } else {
                $selc2 = "";
              }
              echo "<option value=\"".$sb."\"".$selc2.">".$bln_indo[$sb]."</option>";
            }
            ?>
          </select>
        </div>
      </div>
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cari</button>
    </div>
  </form>
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
					  <td>Real Program</td>
					  <td><a href="real_proglist.php?rpt=1&export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>2.</td>
					  <td>Real Keuangan</td>
					  <td><a href="real_keu_pelatihanlist.php?export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>3.</td>
					  <td>Real Peserta Diklat PT, Jenis Kelamin</td>
					  <td><a href="real_pst_jklist.php?export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>4.</td>
					  <td>Real Peserta Diklat Propinsi</td>
					  <td><a href="t_proplist.php?export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>5.</td>
					  <td>Target</td>
					  <td><a href="v_targetreallist.php?export=excel<?php echo $linktime; ?>" class="btn-default"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>6.</td>
					  <td>Real peserta menurut kelompok</td>
					  <td><a href="t_bidanglist.php?export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>7.</td>
					  <td>Realisais P3ED</td>
					  <td><a href="t_kotalist.php?h=rptgroup<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>8.</td>
					  <td>Realisasi Universitas</td>
					  <td><a href="v_realunivlist.php?export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>9.</td>
					  <td>Pelatihan Tunda</td>
					  <td><a href="t_pelatihanlist.php?h=rpt&export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>10.</td>
					  <td>Prosentase</td>
					  <td><a href="customexportlist.php?export=excel<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>11.</td>
					  <td>Real TOX</td>
					  <td><a href="javascript:AlertIt();" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
					</tr>
					<tr>
					  <td>12.</td>
					  <td>Memorandum</td>
					  <td><a href="customexportlist.php?export=word<?php echo $linktime; ?>" class="btn-default ew-export-link"><i style=" color: #28a745; font-size: 14pt; " aria-hidden="true" class="fa fa-file-excel-o"></i> Cetak Excel</a></td>
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
$realpelatihan->terminate();
?>