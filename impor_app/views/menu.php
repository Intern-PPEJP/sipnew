<?php

namespace PHPMaker2021\import_ppei;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
$topMenu->addMenuItem(2, "mi_data_master", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "datamasterlist", -1, "", IsLoggedIn() || AllowListMenu('{E95D30EA-3801-4DEA-9521-573FFF071719}data_master'), false, false, "", "", true);
$topMenu->addMenuItem(18, "mi_Perusahaan", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "perusahaanlist", -1, "", IsLoggedIn() || AllowListMenu('{E95D30EA-3801-4DEA-9521-573FFF071719}Perusahaan'), false, false, "", "", true);
$topMenu->addMenuItem(14, "mi_Peserta", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "pesertalist", -1, "", IsLoggedIn() || AllowListMenu('{E95D30EA-3801-4DEA-9521-573FFF071719}Peserta'), false, false, "", "", true);
$topMenu->addMenuItem(21, "mi_pelpes", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "pelpeslist", -1, "", IsLoggedIn() || AllowListMenu('{E95D30EA-3801-4DEA-9521-573FFF071719}pelpes'), false, false, "", "", true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(2, "mi_data_master", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "datamasterlist", -1, "", IsLoggedIn() || AllowListMenu('{E95D30EA-3801-4DEA-9521-573FFF071719}data_master'), false, false, "", "", true);
$sideMenu->addMenuItem(18, "mi_Perusahaan", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "perusahaanlist", -1, "", IsLoggedIn() || AllowListMenu('{E95D30EA-3801-4DEA-9521-573FFF071719}Perusahaan'), false, false, "", "", true);
$sideMenu->addMenuItem(14, "mi_Peserta", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "pesertalist", -1, "", IsLoggedIn() || AllowListMenu('{E95D30EA-3801-4DEA-9521-573FFF071719}Peserta'), false, false, "", "", true);
$sideMenu->addMenuItem(21, "mi_pelpes", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "pelpeslist", -1, "", IsLoggedIn() || AllowListMenu('{E95D30EA-3801-4DEA-9521-573FFF071719}pelpes'), false, false, "", "", true);
echo $sideMenu->toScript();
