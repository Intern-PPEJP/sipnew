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
$elast = new elast();

// Run the page
$elast->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>


<?php
	if (!isset($_SESSION['sbt_elast'])) {
		$_SESSION['sbt_elast'] = true;
    }
	
	if (!$_SESSION['sbt_elast']) //false
	{
		echo "ERROR: form sudah disubmit sebelumnya!";
		$_SESSION['submit'] = true;
		
	} 
	else {
		
		echo "Berhasil!";
		$_SESSION['sbt_elast'] = false;
	}
	
//unset($_SESSION['sbt_elast']);
?>



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

<form name="felast" id="felast" action="elast.php" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>

<!--
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
-->
<form>
  <div class="form-group">
	<label>1. Pelatihan ini secara keseluruhan ?</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_1" id="ea_1_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_1_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_1" id="ea_1_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_1_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_1" id="ea_1_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_1_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_1" id="ea_1_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_1_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_1" id="ea_1_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_1_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label>2. Kesesuaian materi yang disajikan dengan kebutuhan :</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_2" id="ea_2_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_2_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_2" id="ea_2_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_2_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_2" id="ea_2_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_2_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_2" id="ea_2_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_2_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_2" id="ea_2_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_2_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label for="ea_mtr_1">Sebutkan materinya, bila menurut Anda kurang / tidak sesuai</label> 
	<input id="ea_mtr_1" name="ea_mtr_1" type="text" class="form-control">
  </div>
  <div class="form-group">
	<label for="ea_alasan_2">Sebutkan alasan</label> 
	<input id="ea_alasan_2" name="ea_alasan_2" type="text" class="form-control">
  </div>
  <div class="form-group">
	<label>3. Porsi waktu tiap-tiap materi pelatihan secara umum ?</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_3" id="ea_3_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_3_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_3" id="ea_3_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_3_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_3" id="ea_3_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_3_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_3" id="ea_3_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_3_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_3" id="ea_3_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_3_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label>4. Cara penyampaian materi oleh para fasilitator ?</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_4" id="ea_4_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_4_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_4" id="ea_4_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_4_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_4" id="ea_4_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_4_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_4" id="ea_4_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_4_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_4" id="ea_4_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_4_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label>5. Lamanya Pelatihan ?</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_5" id="ea_5_0" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_5_0" class="custom-control-label">Lama</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_5" id="ea_5_1" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_5_1" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_5" id="ea_5_2" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_5_2" class="custom-control-label">Singkat</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label for="ea_6a">6.a. Menurut Anda, topik apa yang sebaiknya ditambahi ?</label> 
	<input id="ea_6a" name="ea_6a" type="text" class="form-control">
  </div>
  <div class="form-group">
	<label for="ea_6b">6.b. Menurut Anda, topik apa yang sebaiknya dikurangi ?</label> 
	<input id="ea_6b" name="ea_6b" type="text" class="form-control">
  </div>
  <div class="form-group">
	<label>7. Kondisi ruang belajar (dari segi kenyamanan dan kebersihan) :</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_7" id="ea_7_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_7_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_7" id="ea_7_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_7_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_7" id="ea_7_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_7_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_7" id="ea_7_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_7_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_7" id="ea_7_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_7_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label>8. Pengaturan Kursi :</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_8" id="ea_8_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_8_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_8" id="ea_8_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_8_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_8" id="ea_8_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_8_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_8" id="ea_8_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_8_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_8" id="ea_8_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_8_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label>9. Perlengkapan Pelatihan :</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_9" id="ea_9_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_9_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_9" id="ea_9_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_9_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_9" id="ea_9_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_9_2" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_9" id="ea_9_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_9_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_9" id="ea_9_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_9_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label>10. Konsumsi (Snack)</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_10" id="ea_10_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_10_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_10" id="ea_10_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_10_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_10" id="ea_10_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_10_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_10" id="ea_10_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_10_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_10" id="ea_10_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_10_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label>11. Pelayanan Panitia Penyelenggara :</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_11" id="ea_11_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_11_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_11" id="ea_11_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_11_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_11" id="ea_11_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_11_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_11" id="ea_11_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_11_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_11" id="ea_11_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_11_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label>12. Dari mana Anda mendapatkan informasi mengenai pelatihan ini :</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_12" id="ea_12_0" type="radio" class="custom-control-input" value="3" required="required"> 
		  <label for="ea_12_0" class="custom-control-label">Surat penawaran/leaflet PPEI</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_12" id="ea_12_1" type="radio" class="custom-control-input" value="2" required="required"> 
		  <label for="ea_12_1" class="custom-control-label">Media cetak</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_12" id="ea_12_2" type="radio" class="custom-control-input" value="1" required="required"> 
		  <label for="ea_12_2" class="custom-control-label">Lainnya</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label for="ea_12a">Lainnya</label> 
	<input id="ea_12a" name="ea_12a" type="text" class="form-control">
  </div>
  <div class="form-group">
	<label>13. Bagaimana pendapat Anda tentang pelayanan pada saat Anda mendaftar menjadi peserta ?</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_13" id="ea_13_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_13_0" class="custom-control-label">Sangat Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_13" id="ea_13_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_13_1" class="custom-control-label">Baik</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_13" id="ea_13_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_13_2" class="custom-control-label">Cukup</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_13" id="ea_13_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_13_3" class="custom-control-label">Kurang</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_13" id="ea_13_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_13_4" class="custom-control-label">Sangat Kurang</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label for="ea_13a">Bila menurut Anda kurang atau sangat kurang, mohon disebutkan dalam hal apa :</label> 
	<input id="ea_13a" name="ea_13a" type="text" class="form-control">
  </div>
  <div class="form-group">
	<label>14. Bagaimana pendapat Anda mengenai tarif pelatihan ini ?</label> 
	<div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_14" id="ea_14_0" type="radio" required="required" class="custom-control-input" value="5"> 
		  <label for="ea_14_0" class="custom-control-label">Sangat Mahal</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_14" id="ea_14_1" type="radio" required="required" class="custom-control-input" value="4"> 
		  <label for="ea_14_1" class="custom-control-label">Mahal</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_14" id="ea_14_2" type="radio" required="required" class="custom-control-input" value="3"> 
		  <label for="ea_14_2" class="custom-control-label">Cukup Sesuai</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_14" id="ea_14_3" type="radio" required="required" class="custom-control-input" value="2"> 
		  <label for="ea_14_3" class="custom-control-label">Murah</label>
		</div>
	  </div>
	  <div class="custom-controls-stacked">
		<div class="custom-control custom-radio">
		  <input name="ea_14" id="ea_14_4" type="radio" required="required" class="custom-control-input" value="1"> 
		  <label for="ea_14_4" class="custom-control-label">Sangat Murah</label>
		</div>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label for="ea_15">15. Pelatihan yang ingin diikuti :</label> 
	<input id="ea_15" name="ea_15" type="text" class="form-control" required="required">
  </div>
  <div class="form-group">
	<label for="ea_16">16. Komentar dan saran-saran :</label> 
	 <textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control" required="required"></textarea>
  </div> 
  <div class="form-group">
	<button name="submit" type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>



 </td></tr>
  </tbody>
  <!--Table body-->
</table>
<!--Table-->

 

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$elast->terminate();
?>