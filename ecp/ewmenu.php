<?php
namespace PHPMaker2020\input_ecp;

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
$topMenu->addMenuItem(3, "mi_dm_pesertaecp", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "dm_pesertaecplist.php", -1, "", IsLoggedIn() || AllowListMenu('{9B9A621D-5170-4F08-8852-72A13BB88C54}dm_pesertaecp'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(2, "mi_dm_ecp", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "dm_ecplist.php", -1, "", IsLoggedIn() || AllowListMenu('{9B9A621D-5170-4F08-8852-72A13BB88C54}dm_ecp'), FALSE, FALSE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(3, "mi_dm_pesertaecp", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "dm_pesertaecplist.php", -1, "", IsLoggedIn() || AllowListMenu('{9B9A621D-5170-4F08-8852-72A13BB88C54}dm_pesertaecp'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(2, "mi_dm_ecp", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "dm_ecplist.php", -1, "", IsLoggedIn() || AllowListMenu('{9B9A621D-5170-4F08-8852-72A13BB88C54}dm_ecp'), FALSE, FALSE, "", "", TRUE);
echo $sideMenu->toScript();
?>