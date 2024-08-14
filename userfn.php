<?php
namespace PHPMaker2020\ppei_20;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Filter for 'Last Month' (example)
function GetLastMonthFilter($FldExpression, $dbid = 0) {
	$today = getdate();
	$lastmonth = mktime(0, 0, 0, $today['mon']-1, 1, $today['year']);
	$val = date("Y|m", $lastmonth);
	$wrk = $FldExpression . " BETWEEN " .
		QuotedValue(DateValue("month", $val, 1, $dbid), DATATYPE_DATE, $dbid) .
		" AND " .
		QuotedValue(DateValue("month", $val, 2, $dbid), DATATYPE_DATE, $dbid);
	return $wrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter($FldExpression, $dbid = 0) {
	return $FldExpression . Like("'A%'", $dbid);
}

// Global user functions
// Database Connecting event
function Database_Connecting(&$info) {

	// Example:
	//var_dump($info);
	//if ($info["id"] == "DB" && CurrentUserIP() == "127.0.0.1") { // Testing on local PC
	//	$info["host"] = "locahost";
	//	$info["user"] = "root";
	//	$info["pass"] = "";
	//}

}

// Database Connected event
function Database_Connected(&$conn) {

	// Example:
	//if ($conn->info["id"] == "DB")
	//	$conn->Execute("Your SQL");

}

function MenuItem_Adding($item) {

	//var_dump($item);
	// Return FALSE if menu item not allowed

	if(CurrentUserLevel() == 30 || CurrentUserLevel() == 40){
		if ($item->Text == "Rencana Program") return FALSE;
	}
	if ($item->Text == "Audit Trail") return FALSE;
	return TRUE;
}

function Menu_Rendering($menu) {

	// Change menu items here
}

function Menu_Rendered($menu) {

	// Clean up here
}

// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

// AuditTrail Inserting event
function AuditTrail_Inserting(&$rsnew) {

	//var_dump($rsnew);
	return TRUE;
}

// Personal Data Downloading event
function PersonalData_Downloading(&$row) {

	//echo "PersonalData Downloading";
}

// Personal Data Deleted event
function PersonalData_Deleted($row) {

	//echo "PersonalData Deleted";
}

/*$host_name = "localhost";
$user_name = "root";
$password = "";
$database = "alumni_pmp"; 
mysql_connect($host_name, $user_name, $password);
mysql_select_db($database) or die("Tidak terhubung database!");
 */
function cs_judul($p,$teks) {
	if($p=="list"){

		//$simbol = '<span class="glyphicon glyphicon-th-list"></span>';
		$simbol = '';
	} else if($p=="add"){
		$simbol = '';
	} else if($p=="edit"){
		$simbol = '';
	} else if($p=="view"){
		$simbol = '';
	}

	//echo '<h4 class="CS_Judul">'.$simbol.$teks.'</h4><hr>';
}

function cs_geturl_ft(){
	$h = explode(".",basename($_SERVER['PHP_SELF']));
	$x = explode("_",basename($h[0]));
	$list = substr($x[2],-4);
	if($list == "list"){
		$output = "no";
	} else {
		$output = $x[2];
	}
	return $output;
}

function cs_panelbs($idpage,$vsql,$judul){
	$sql = mysql_query($vsql);
	$nom = 1;
	$mypageid = explode("#",$idpage);
	$panelstyle = "style='border:1px solid #333'";
	$titlestyle = "style='color:#333'";
?>
	<br>
	<div class="panel panel-info" <?php echo $panelstyle; ?>>
	  <div class="panel-heading">
		<h3 class="panel-title" <?php echo $titlestyle; ?>><?php echo $judul; ?></h3>
	  </div>
	  <div class="panel-body">
<?php
	while($data = mysql_fetch_array($sql)){
		if($mypageid[0] == "t_perusahaan"){
			echo $nom.". <a href='cs_t_pesertaedit.php?id=".$data["id"]."'>".$data["nama"]."</a><br>";
		}
		$nom++;
	}
?>			
	  </div>
	</div>
<?php
} // end cs_panelsbs

function cs_getNextKode($jenis,$bidang){
	$csNextKode = "";
	$csLastKode = "";
	if($jenis == "jp"){
		$count_bid = ExecuteScalar("SELECT COUNT(kdbidang) FROM t_judul WHERE kdbidang='".$bidang."'");
		$count_jdl = ExecuteScalar("SELECT COUNT(kdjudul) FROM `t_judul` ORDER BY kdjudul DESC LIMIT 1");
		$totbid = $count_bid+1;
		$value = $count_jdl + 1;
		if ($value != "") {

			//$sLastKode = intval(substr($value, 4, 3)); // ambil 3 digit terakhir
			//$sLastKode = intval($sLastKode) + 1; // konversi ke integer, lalu tambahkan satu

			$sNextKode = $bidang . $totbid. "-" . sprintf('%03s', $value); // format hasilnya dan tambahkan prefix
		}
	} 
	return $sNextKode;
}

function show_propinsi($kd){ // lookup propinsi
	if(empty($kd)){ $result = ""; }
	else { $result = ExecuteScalar("SELECT prop FROM `t_prop` WHERE `kdprop` = '".$kd."'"); }
	return $result;
}

function show_kota($kd){ // lookup kab/kota
	if(empty($kd)){ $result = ""; }
	else { $result = ExecuteScalar("SELECT kota FROM `t_kota` WHERE `kdkota` = '".$kd."'"); }
	return $result;
}

function show_kecamatan($kd){ // lookup kecamatan
	if(empty($kd)){ $result = ""; }
	else { $result = ExecuteScalar("SELECT kec FROM `t_kec` WHERE `kdkec` = '".$kd."'"); }
	return $result;
}

function CSFormatRupiah($angka)
{
	$jadi = $angka;//number_format($angka,0,',','.');
	return "Rp".$jadi;
}

function CSFormatTanggal($tanggal, $cetak_hari = false, $cetak_br = false, $singkatan_bulan = false)
{
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$bulan_singkatan = array (1 =>   'Januari',
				'Feb',
				'Mar',
				'Apr',
				'Mei',
				'Jun',
				'Jul',
				'Agu',
				'Sept',
				'Okt',
				'Nov',
				'Des'
			);
	$split 	  = explode('-', $tanggal);
	if ( !isset($split[0])) {
		$split[0] = null;
	}
	if ( !isset($split[1])) {
		$split[1] = null;
	}
	if ( !isset($split[2])) {
		$split[2] = null;
	}
	if ( !isset($bulan[ (int)$split[1] ])) {
		$bulan[ (int)$split[1] ] = null;
	}
	if ( !isset($bulan_singkatan[ (int)$split[1] ])) {
		$bulan_singkatan[ (int)$split[1] ] = null;
	}
	$bln = $bulan;
	if ($singkatan_bulan) {
		$bln = $bulan_singkatan; 
	}
	$tgl_indo = $split[0] . ' ' . $bln[ (int)$split[1] ] . ' ' . $split[2];
	if ($cetak_hari) { // Format: Kamis, 30 November 2017
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	if ($cetak_br) {
		$num = date('N', strtotime($tanggal)); // Format: Kamis,<br> 30 Nov 2017
		return $hari[$num] . ', <br>' . $split[0] . ' ' . $bln[ (int)$split[1] ] . ' ' . $split[2];;
	}
	return $tgl_indo;
}

function BulanIndo($bulan){ // BULAN INDONESIA
	if(empty($bulan)) { $setBulan = "";} 
	else { $bln = array(
				'1' => 'januari',
				'2' => 'februari',
				'3' => 'maret',
				'4' => 'april',
				'5' => 'mei',
				'6' => 'juni',
				'7' => 'juli',
				'8' => 'agustus',
				'9' => 'september',
				'10' => 'oktober',
				'11' => 'november',
				'12' => 'desember',
			);
	$setBulan = $bln[$bulan];
	}
	return $setBulan;
}

function Conv_Angka_Romawi($number) {
	$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
	$returnValue = '';
	while ($number > 0) {
		foreach ($map as $roman => $int) {
			if($number >= $int) {
				$number -= $int;
				$returnValue .= $roman;
				break;
			}
		}
	}
	return $returnValue;
}

function rupiah($angka) {
	$rupiah = number_format($angka ,0, ',' , '.' );
	return $rupiah;
}

function terbilang($angka) {
	$angka = (float)$angka;
	$bilangan = array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas');
	if ($angka < 12) {
		return $bilangan[$angka];
	} else if ($angka < 20) {
		return $bilangan[$angka - 10] . ' Belas';
	} else if ($angka < 100) {
		$hasil_bagi = (int)($angka / 10);
		$hasil_mod = $angka % 10;
		return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
	} else if ($angka < 200) { return sprintf('Seratus %s', terbilang($angka - 100));
	} else if ($angka < 1000) { $hasil_bagi = (int)($angka / 100); $hasil_mod = $angka % 100; return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
	} else if ($angka < 2000) { return trim(sprintf('Seribu %s', terbilang($angka - 1000)));
	} else if ($angka < 1000000) { $hasil_bagi = (int)($angka / 1000); $hasil_mod = $angka % 1000; return sprintf('%s Ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
	} else if ($angka < 1000000000) { $hasil_bagi = (int)($angka / 1000000); $hasil_mod = $angka % 1000000; return trim(sprintf('%s Juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
	} else if ($angka < 1000000000000) { $hasil_bagi = (int)($angka / 1000000000); $hasil_mod = fmod($angka, 1000000000); return trim(sprintf('%s Milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
	} else if ($angka < 1000000000000000) { $hasil_bagi = $angka / 1000000000000; $hasil_mod = fmod($angka, 1000000000000); return trim(sprintf('%s Triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
	} else {
		return 'Data Salah';
	}
}



$API_ACTIONS["getWilayahECP"] = function(Request $request, Response &$response) {
    $wilayah = Param("wilayah", Route(1)); // Get parameter from $_GET or $_POST
	$tahun = Param("tahun", Route(1)); // Get parameter from $_GET or $_POST
	
	$tahun_sekarang = "";
	if( $tahun > 0){
		$tahun_sekarang = " AND `Tahun_ECP` =".$tahun;
	}
	echo $tahun_sekarang."<br>";
    if ($wilayah !== NULL){
        $sql = "SELECT Wilayah_ECP 'Wilayah ECP',COUNT(DISTINCT Nama) * 100/(SELECT SUM(COUNT(DISTINCT Nama)) FROM `t_ecp`) as 'Persentase', COUNT(DISTINCT Nama) 'Jumlah Peserta' FROM `t_ecp` WHERE `Wilayah_ECP` LIKE '" . AdjustSql($wilayah) . "'".$tahun_sekarang." GROUP BY Wilayah_ECP ORDER BY COUNT(DISTINCT Nama) DESC";
		 echo ExecuteHtml($sql, ["fieldcaption" => TRUE, "tablename" => ["t_ecp","t_pcp"]]);
		 
		 $sql2 = "SELECT @no:=@no+1 AS No, `Wilayah_ECP`,`Tahun_ECP`, `Nama`,  `Perusahaan`, `Produk`, SUM(`Nilai_Ekspor_USD`) 'Nilai_Ekspor_USD', SUM(`Nilai_Ekspor_Rupiah`) 'Nilai_Ekspor_Rupiah', `Tgl_Bln_Ekspor`, `Negara_Tujuan` FROM `t_ecp` JOIN (SELECT @no:=0) r WHERE `Wilayah_ECP` LIKE '" . AdjustSql($wilayah) . "'".$tahun_sekarang."  GROUP BY Nama ORDER BY No,`Tahun_ECP`, Nama, ID_ECP ASC";
		 
		 echo ExecuteHtml($sql2, ["fieldcaption" => TRUE, "tablename" => ["t_ecp","t_pcp"]]);
	
	}
};



$API_ACTIONS["getNTE"] = function(Request $request, Response &$response) {
    $id = Param("id", Route(1)); // Get parameter from $_GET or $_POST
	$tahun = Param("tahun", Route(1)); // Get parameter from $_GET or $_POST
	
	$tahun_sekarang = "";
	if( $tahun > 0){
		$tahun_sekarang = " WHERE `Tahun_ECP` =".$tahun;
	}
	
	$rs_b = LoadRecordset("SELECT Negara_Tujuan, COUNT(1) cc, Tahun_Ekspor, Nilai_Ekspor_USD FROM `t_ecp`".$tahun_sekarang." GROUP BY Negara_Tujuan ORDER BY  cc DESC, Negara_Tujuan ASC");
	$ROWS_b = $rs_b->GetRows();
	
	$totpes = ExecuteScalar("SELECT COUNT(1) cc FROM `t_ecp`".$tahun_sekarang." ORDER BY  cc DESC, Negara_Tujuan ASC");
	
	//echo $totpes;
	echo "<table class='table table-bordered table-striped'><tr><th>No</th><th>Negara Tujuan Ekspor</th><th>Presentase</th><th>Jumlah Peserta Ekspor</th><th>Total Nilai Ekspor</th><th>Tahun Ekspor</th><th>Detail</th></tr>";
	
	
	if(count($ROWS_b) > 0){
		$no=1;
		foreach($ROWS_b AS $ROW_b){
			$presentase = ($ROW_b["cc"]/$totpes)*100;
			
			echo "<tr><td>".$no."</td><td>".$ROW_b["Negara_Tujuan"]."</td><td>". number_format($presentase, 2, ',', '.')."%</td><td>".$ROW_b["cc"]."</td><td>". number_format($ROW_b["Nilai_Ekspor_USD"], 2, ',', '.')." USD</td><td>".$ROW_b["Tahun_Ekspor"]."</td><td><a href='mastercp_eksporlist.php?cmd=search&t=mastercp_ekspor&z_Wilayah_ECP=LIKE&x_Wilayah_ECP=&z_Tahun_ECP=%3D&x_Tahun_ECP=&z_Negara_Tujuan=LIKE&x_Negara_Tujuan=".$ROW_b["Negara_Tujuan"]."' class='btn ew-add-edit ew-add btn-secondary'>Detail</a></td></tr>";
			$no++;
		}
	}
		 
	
};



$API_ACTIONS["getPesertaEkspor"] = function(Request $request, Response &$response) {
    $id = Param("id", Route(1)); // Get parameter from $_GET or $_POST
	$tahun = Param("tahun", Route(1)); // Get parameter from $_GET or $_POST
	
	$tahun_sekarang = "";
	if( $tahun > 0){
		$tahun_sekarang = " WHERE `Tahun_ECP` =".$tahun;
	}
	
	$rs_b = LoadRecordset("SELECT Wilayah_ECP,COUNT(DISTINCT Nama) cc, SUM(Nilai_Ekspor_USD) Nilai_Ekspor_USD,Tahun_ECP FROM `t_ecp`".$tahun_sekarang." GROUP BY Wilayah_ECP, Tahun_ECP ORDER BY Wilayah_ECP ASC,Tahun_ECP ASC");
	$ROWS_b = $rs_b->GetRows();
	echo "<table class='table table-bordered table-striped'><tr><th>No</th><th>Wilayah ECP</th><th>Presentase</th><th>Jumlah Peserta Ekspor</th><th class='ne'>Total Nilai Ekspor</th><th>Tahun ECP</th><th>Detail</th></tr>";
	if(count($ROWS_b) > 0){
		$no=1;
		
		foreach($ROWS_b AS $ROW_b){
			$totpes = ExecuteScalar("SELECT COUNT(1) FROM `t_ecp`".$tahun_sekarang."");
			$presentase = ($ROW_b["cc"]/$totpes)*100;
			
			echo "<tr><td>".$no."</td><td>".$ROW_b["Wilayah_ECP"]."</td><td>". number_format($presentase, 2, ',', '.')."%</td><td>".$ROW_b["cc"]."</td><td class='ne'>". number_format($ROW_b["Nilai_Ekspor_USD"], 2, ',', '.')." USD</td><td>".$ROW_b["Tahun_ECP"]."</td><td><a href='mastercp_eksporlist.php?cmd=search&t=mastercp_ekspor&z_Wilayah_ECP=LIKE&x_Wilayah_ECP=".$ROW_b["Wilayah_ECP"]."&z_Tahun_ECP=%3D&x_Tahun_ECP=".$ROW_b["Tahun_ECP"]."' class='btn ew-add-edit ew-add btn-secondary'>Detail</a></td></tr>";
			$no++;
		}
	}
		 
	
};


$API_ACTIONS["getPesertaECP"] = function(Request $request, Response &$response) {
    $id = Param("id", Route(1)); // Get parameter from $_GET or $_POST
	$tahun = Param("tahun", Route(1)); // Get parameter from $_GET or $_POST
	
	$tahun_sekarang = "";
	if( $tahun > 0){
		$tahun_sekarang = " WHERE `tahun_ecp` =".$tahun;
	}
	
	
	$rs_b = LoadRecordset("SELECT wilayah_ecp,tahun_ecp,COUNT(1) cc FROM `t_pcp`".$tahun_sekarang." GROUP BY wilayah_ecp,tahun_ecp ORDER BY COUNT(1) DESC");
	$ROWS_b = $rs_b->GetRows();
	echo "<table class='table table-bordered table-striped'><tr><th>No</th><th>Wilayah ECP</th><th>Presentase</th><th>Jumlah Peserta ECP</th><th>Tahun ECP</th><th>Detail</th></tr>";
	if(count($ROWS_b) > 0){
		$no=1;
		
		foreach($ROWS_b AS $ROW_b){
			$totpes = ExecuteScalar("SELECT COUNT(1) FROM `t_pcp`".$tahun_sekarang."");
			$presentase = ($ROW_b["cc"]/$totpes)*100;
			
			echo "<tr><td>".$no."</td><td>".$ROW_b["wilayah_ecp"]."</td><td>". number_format($presentase, 2, ',', '.')."%</td><td>".$ROW_b["cc"]."</td><td>".$ROW_b["tahun_ecp"]."</td><td><a href='master_ecplist.php?cmd=search&t=master_ecp&z_wilayah_ecp=LIKE&x_wilayah_ecp=".$ROW_b["wilayah_ecp"]."&z_tahun_ecp=%3D&x_tahun_ecp=".$ROW_b["tahun_ecp"]."' class='btn ew-add-edit ew-add btn-secondary'>Detail</a></td></tr>";
			$no++;
		}
	}
		 
	
}
?>