<?php

namespace PHPMaker2021\simtrial;

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
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(5, "mi_produk", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "ProdukList", -1, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}produk'), false, false, "fa-cubes", "", false);
$sideMenu->addMenuItem(3, "mi_penjualan", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "PenjualanList", -1, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}penjualan'), false, false, "fa-shopping-cart", "", false);
$sideMenu->addMenuItem(6, "mi_produksi", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "ProduksiList", -1, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}produksi'), false, false, "fa-truck-loading", "", false);
$sideMenu->addMenuItem(8, "mi_tiket", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "TiketList", -1, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}tiket'), false, false, "fa-ticket-alt", "", false);
$sideMenu->addMenuItem(1, "mi_departemen", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "DepartemenList?cmd=resetall", -1, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}departemen'), false, false, "fa-building", "", false);
$sideMenu->addMenuItem(16, "mci_User_Manajemen", $MenuLanguage->MenuPhrase("16", "MenuText"), "", -1, "", true, false, true, "fa-users", "", false);
$sideMenu->addMenuItem(13, "mi_users", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "UsersList", 16, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}users'), false, false, "fa-circle", "", false);
$sideMenu->addMenuItem(12, "mi_userlevels", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "UserlevelsList", 16, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}userlevels'), false, false, "fa-circle", "", false);
$sideMenu->addMenuItem(14, "mci_Konfigurasi", $MenuLanguage->MenuPhrase("14", "MenuText"), "", -1, "", true, false, true, "fa-cog", "", false);
$sideMenu->addMenuItem(10, "mi_tiket_subjek", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "TiketSubjekList", 14, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}tiket_subjek'), false, false, "fa-circle", "", false);
$sideMenu->addMenuItem(2, "mi_kode_tabel", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "KodeTabelList", 14, "", AllowListMenu('{C2F42D94-7991-477D-B0C4-781634B7775A}kode_tabel'), false, false, "fa-circle", "", false);
echo $sideMenu->toScript();
