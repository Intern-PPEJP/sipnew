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
$laporanrealisasi = new laporanrealisasi();

// Run the page
$laporanrealisasi->run();

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
<?php
 
//if (!$_SESSION['submit']) //false
//{
//	echo "ERROR: form sudah disubmit sebelumnya!";
//} 
//else {
	$pelat = $_POST['pelat'];
	$fas = $_POST['fas'];
	$kur = $_POST['kur'];
	
	$nifas_1 = $_POST['nifas_1'];
	$nifas_2 = $_POST['nifas_2'];
	$nifas_3 = $_POST['nifas_3'];
	$nifas_4 = $_POST['nifas_4'];
	$nifas_5 = $_POST['nifas_5'];
	$nifas_6 = $_POST['nifas_6'];
	$nifas_7 = $_POST['nifas_7'];

	$nifas = $nifas_1.",".
			 $nifas_2.",".
			 $nifas_3.",".
			 $nifas_4.",".
			 $nifas_5.",".
			 $nifas_6.",".
			 $nifas_7;

	$saran = $_POST["saran"];
	
	$sql_insert_nifas   = "INSERT INTO `t_evafas`(`evafas_id`, `idpelat`, `bioid`, `kurikulumid`, `kriteria_nilai`, `nilai_fas`, `saran`)  VALUES  (NULL,".$pelat.",".$fas.",".$kur.",0,'".$nifas_1.",".$nifas_2.",".$nifas_3.",".$nifas_4.",".$nifas_5.",".$nifas_6.",".$nifas_7."','".$saran."');";
						 

	$insert_nifas = Execute($sql_insert_nifas);

	if( !$insert_nifas )
	{
		echo "Gagal mengisi evaluasi : error ";
		//echo $sql_insert_nifas;
		//$_SESSION['submit'] = true;
		header('location:coba.php');
		exit();
	}else{
		//echo $sql_insert_nifas."<br>";
		CurrentPage()->setSuccessMessage("Terimakasih telah mengisi evaluasi fasilitator.");
		//$_SESSION['submit'] = false;
		header('location:coba.php');
		exit();
	}
//}
?>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporanrealisasi->terminate();
?>