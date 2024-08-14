<?php
namespace PHPMaker2020\ppei_20;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(77, "mi_beranda", $MenuLanguage->MenuPhrase("77", "MenuText"), $MenuRelativePath . "beranda.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}beranda.php'), FALSE, FALSE, "fa-home", "", FALSE);
$sideMenu->addMenuItem(98, "mi_cv_pelrepes", $MenuLanguage->MenuPhrase("98", "MenuText"), $MenuRelativePath . "cv_pelrepeslist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}cv_pelrepes'), FALSE, FALSE, "fa-user", "", FALSE);
$sideMenu->addMenuItem(19, "mi_t_peserta", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "t_pesertalist.php?cmd=resetall", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_peserta'), FALSE, FALSE, "fa-user", "", FALSE);
$sideMenu->addMenuItem(18, "mi_t_perusahaan", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "t_perusahaanlist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_perusahaan'), FALSE, FALSE, "fa-industry", "", FALSE);
$sideMenu->addMenuItem(280, "mi_t_cp", $MenuLanguage->MenuPhrase("280", "MenuText"), $MenuRelativePath . "t_cplist.php", 18, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_cp'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(69, "mi_t_biointruktur", $MenuLanguage->MenuPhrase("69", "MenuText"), $MenuRelativePath . "t_biointrukturlist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_biointruktur'), FALSE, FALSE, "fa-address-card", "", FALSE);
$sideMenu->addMenuItem(532, "mi_t_jdiklat", $MenuLanguage->MenuPhrase("532", "MenuText"), $MenuRelativePath . "t_jdiklatlist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_jdiklat'), FALSE, FALSE, "fa fa-newspaper-o", "", FALSE);
$sideMenu->addMenuItem(279, "mci_Rencana_Program", $MenuLanguage->MenuPhrase("279", "MenuText"), $MenuRelativePath . "javascript:void(0)", -1, "", IsLoggedIn(), FALSE, TRUE, "fa fa-newspaper-o", "", FALSE);
$sideMenu->addMenuItem(181, "mi_t_rpdiklat", $MenuLanguage->MenuPhrase("181", "MenuText"), $MenuRelativePath . "t_rpdiklatlist.php", 279, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_rpdiklat'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(183, "mi_t_rpkerjasama", $MenuLanguage->MenuPhrase("183", "MenuText"), $MenuRelativePath . "t_rpkerjasamalist.php", 279, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_rpkerjasama'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(187, "mi_t_rkcoaching", $MenuLanguage->MenuPhrase("187", "MenuText"), $MenuRelativePath . "t_rkcoachinglist.php", 279, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_rkcoaching'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(528, "mi_t_rkwebinar", $MenuLanguage->MenuPhrase("528", "MenuText"), $MenuRelativePath . "t_rkwebinarlist.php", 279, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_rkwebinar'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(533, "mi_panitia_pelat", $MenuLanguage->MenuPhrase("533", "MenuText"), $MenuRelativePath . "panitia_pelatlist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}panitia_pelat'), FALSE, FALSE, "fa-user", "", FALSE);
$sideMenu->addMenuItem(16, "mi_t_pelatihan", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "t_pelatihanlist.php?cmd=resetall", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_pelatihan'), FALSE, FALSE, "fa-table", "", FALSE);
$sideMenu->addMenuItem(636, "mi_webinar", $MenuLanguage->MenuPhrase("636", "MenuText"), $MenuRelativePath . "webinarlist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}webinar'), FALSE, FALSE, "fa fa-calendar-o", "", FALSE);
$sideMenu->addMenuItem(647, "mi_excp", $MenuLanguage->MenuPhrase("647", "MenuText"), $MenuRelativePath . "excplist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}excp'), FALSE, FALSE, "fa-list", "", FALSE);
$sideMenu->addMenuItem(10, "mi_t_judul", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "t_judullist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_judul'), FALSE, FALSE, "fa-list", "", FALSE);
$sideMenu->addMenuItem(73, "mi_t_juduldetail", $MenuLanguage->MenuPhrase("73", "MenuText"), $MenuRelativePath . "t_juduldetaillist.php?cmd=resetall", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_juduldetail'), FALSE, FALSE, "fa-list-alt", "", FALSE);
$sideMenu->addMenuItem(88, "mi_cv_coachingprogram", $MenuLanguage->MenuPhrase("88", "MenuText"), $MenuRelativePath . "cv_coachingprogramlist.php", -1, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}cv_coachingprogram'), FALSE, FALSE, "fa-list", "", FALSE);
$sideMenu->addMenuItem(450, "mci_Report", $MenuLanguage->MenuPhrase("450", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(639, "mi_evaluasi", $MenuLanguage->MenuPhrase("639", "MenuText"), $MenuRelativePath . "evaluasilist.php", 450, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}evaluasi'), FALSE, FALSE, "fa-list", "", FALSE);
$sideMenu->addMenuItem(526, "mi_realpengajar", $MenuLanguage->MenuPhrase("526", "MenuText"), $MenuRelativePath . "realpengajar.php", 450, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}realpengajar.php'), FALSE, FALSE, "fa-address-card", "", FALSE);
$sideMenu->addMenuItem(527, "mi_realpelatihan", $MenuLanguage->MenuPhrase("527", "MenuText"), $MenuRelativePath . "realpelatihan.php", 450, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}realpelatihan.php'), FALSE, FALSE, "fa-table", "", FALSE);
$sideMenu->addMenuItem(529, "mi_realpeserta", $MenuLanguage->MenuPhrase("529", "MenuText"), $MenuRelativePath . "realpeserta.php", 450, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}realpeserta.php'), FALSE, FALSE, "fa-user", "", FALSE);
$sideMenu->addMenuItem(109, "mi_petri", $MenuLanguage->MenuPhrase("109", "MenuText"), $MenuRelativePath . "petrilist.php", 450, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}petri'), FALSE, FALSE, "fa-list", "", FALSE);
$sideMenu->addMenuItem(387, "mci_Admin_Only", $MenuLanguage->MenuPhrase("387", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(68, "mi_t_pegawai", $MenuLanguage->MenuPhrase("68", "MenuText"), $MenuRelativePath . "t_pegawailist.php", 387, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_pegawai'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(29, "mi_t_users", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "t_userslist.php", 387, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_users'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(92, "mi_audittrail", $MenuLanguage->MenuPhrase("92", "MenuText"), $MenuRelativePath . "audittraillist.php", 387, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}audittrail'), FALSE, FALSE, "fa fa-list-alt", "", FALSE);
$sideMenu->addMenuItem(30, "mci_Lain-lain", $MenuLanguage->MenuPhrase("30", "MenuText"), "", 387, "", IsLoggedIn(), FALSE, TRUE, "fa-cubes", "", FALSE);
$sideMenu->addMenuItem(2, "mi_t_agama", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "t_agamalist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_agama'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(185, "mi_t_area", $MenuLanguage->MenuPhrase("185", "MenuText"), $MenuRelativePath . "t_arealist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_area'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(78, "mi_t_bagian", $MenuLanguage->MenuPhrase("78", "MenuText"), $MenuRelativePath . "t_bagianlist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_bagian'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(3, "mi_t_bahasa", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "t_bahasalist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_bahasa'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(4, "mi_t_bidang", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "t_bidanglist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_bidang'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(6, "mi_t_export", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "t_exportlist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_export'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(7, "mi_t_informasi", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "t_informasilist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_informasi'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(8, "mi_t_jabatan", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "t_jabatanlist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_jabatan'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(9, "mi_t_jenis", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "t_jenislist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_jenis'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(11, "mi_t_kategori", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "t_kategorilist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_kategori'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(84, "mi_t_kec", $MenuLanguage->MenuPhrase("84", "MenuText"), $MenuRelativePath . "t_keclist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_kec'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(12, "mi_t_kota", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "t_kotalist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_kota'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(14, "mi_t_lokasi", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "t_lokasilist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_lokasi'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(15, "mi_t_negara", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "t_negaralist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_negara'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(17, "mi_t_pendidikan", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "t_pendidikanlist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_pendidikan'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(21, "mi_t_produk", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "t_produklist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_produk'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(22, "mi_t_produknafed", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "t_produknafedlist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_produknafed'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(24, "mi_t_prop", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "t_proplist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_prop'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(27, "mi_t_skala", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "t_skalalist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_skala'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(80, "mi_t_tahapan", $MenuLanguage->MenuPhrase("80", "MenuText"), $MenuRelativePath . "t_tahapanlist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_tahapan'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(61, "mi_t_userlevels", $MenuLanguage->MenuPhrase("61", "MenuText"), $MenuRelativePath . "t_userlevelslist.php", 30, "", AllowListMenu('{046BD04F-8A8B-497E-98E3-47339F0B2FB6}t_userlevels'), FALSE, FALSE, "fa fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(635, "mci_Keluar_Aplikasi", $MenuLanguage->MenuPhrase("635", "MenuText"), $MenuRelativePath . "logout.php", -1, "", IsLoggedIn(), FALSE, TRUE, "fa fa-sign-out", "", FALSE);
echo $sideMenu->toScript();
?>