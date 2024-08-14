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
$coba = new coba();

// Run the page
$coba->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
	$db =& DbHelper(); // Create instance of the database helper class by DbHelper() or by name c<database>_db where <database> is database name of the project
?>


<?php CurrentPage()->ShowMessage(); ?>
<table id="tablePreview" class="table table-bordered" style="background:#fff">
  <!--Table body-->
  <tbody>
    <tr>
      <td width="35%">Nama Pelatihan:</td>
      <td width="65%">Agribisnis Tingkat Dasar</td>
    </tr>
    <tr>
      <td>Tempat, Tanggal Pelatihan:</td>
      <td>Jakarta, 29 sampai dengan 31 Januari 2019</td>
    </tr>
    <tr>
      <td colspan="2" style="background:#f4f6f9"></td>
    </tr>
    <tr>
      <td>Hari</td>
      <td>Senin</td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td>29 Januari 2019</td>
    </tr>
    <tr>
      <td>Nama Fasilitator</td>
      <td>Agus Burhan A.F.</td>
    </tr>
    <tr>
      <td>Materi Pelajaran</td>
      <td>Overview Kegiatan Ekspor</td>
    </tr>
	<tr>
	  <td colspan="2">

<form name="fcoba" id="fcoba" action="laporanrealisasi.php" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
  <?php 
  if (!isset($_SESSION['submit'])) {
	$_SESSION['submit'] = true;
  }
  
  if($_SESSION['submit'] == true){ // ganti false
	//  echo "Terimakasih Anda telah mengisi evaluasi.";
  //} else {
	
  $count = 7;
  $kriteria_penilaian = array("0", "Materi yang diberikan mencapai sasaran", "Sistematika Penyajian", "Metode Penyajian", "Gaya dan sikap Fasilitator", "Kemampuan memotivasi peserta", "Penggunaan bahasa", "Manajemen Waktu");
  for( $i=0; $i < $count; $i++ ) { 
  $no= $i+1;
  $bg = 'style="margin:0;padding:10px 10px 10px 0"';
  if($i % 2 == 0){
	  $bg = 'style="background:#f4f6f9;margin:0;padding:10px 10px 10px 0"';
  }
  ?>
  <div class="form-group row" <?php echo $bg; ?>>
    <label class="col-4"><?php echo $no.". ".$kriteria_penilaian[$no]; ?></label> 
    <div class="col-8">
      <div class="custom-control custom-radio custom-control-inline">
        <input name="nifas_<?php echo $no; ?>" id="nifas_<?php echo $no; ?>0" type="radio" required="required" class="custom-control-input" value="1"> 
        <label for="nifas_<?php echo $no; ?>0" class="custom-control-label">1</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="nifas_<?php echo $no; ?>" id="nifas_<?php echo $no; ?>1" type="radio" required="required" class="custom-control-input" value="2"> 
        <label for="nifas_<?php echo $no; ?>1" class="custom-control-label">2</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="nifas_<?php echo $no; ?>" id="nifas_<?php echo $no; ?>2" type="radio" required="required" class="custom-control-input" value="3"> 
        <label for="nifas_<?php echo $no; ?>2" class="custom-control-label">3</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="nifas_<?php echo $no; ?>" id="nifas_<?php echo $no; ?>3" type="radio" required="required" class="custom-control-input" value="4"> 
        <label for="nifas_<?php echo $no; ?>3" class="custom-control-label">4</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="nifas_<?php echo $no; ?>" id="nifas_<?php echo $no; ?>4" type="radio" required="required" class="custom-control-input" value="5"> 
        <label for="nifas_<?php echo $no; ?>4" class="custom-control-label">5</label>
      </div>
    </div>
  </div> 
 <?php
  }
 ?>
  <div class="form-group">
    <label for="saran">Saran kepada Fasilitator :</label> 
    <textarea id="saran" name="saran" cols="40" rows="5" required="required" class="form-control"></textarea>
	<input type="hidden" id="pelat" name="pelat" value="11111">
	<input type="hidden" id="fas" name="fas" value="22222">
	<input type="hidden" id="kur" name="kur" value="33333">
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
<?php } ?>
 
 </td></tr>
  </tbody>
  <!--Table body-->
</table>
<!--Table-->

 
<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$coba->terminate();
?>