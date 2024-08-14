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
$diklatpusat_view = new diklatpusat_view();

// Run the page
$diklatpusat_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatpusat_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$diklatpusat_view->isExport()) { ?>
<script>
var fdiklatpusatview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdiklatpusatview = currentForm = new ew.Form("fdiklatpusatview", "view");
	loadjs.done("fdiklatpusatview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$diklatpusat_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $diklatpusat_view->ExportOptions->render("body") ?>
<?php $diklatpusat_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $diklatpusat_view->showPageHeader(); ?>
<?php
$diklatpusat_view->showMessage();
?>
<form name="fdiklatpusatview" id="fdiklatpusatview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="diklatpusat">
<input type="hidden" name="modal" value="<?php echo (int)$diklatpusat_view->IsModal ?>">
<?php if (!$diklatpusat_view->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="diklatpusat_view"><!-- multi-page tabs -->
	<ul class="<?php echo $diklatpusat_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $diklatpusat_view->MultiPages->pageStyle(1) ?>" href="#tab_diklatpusat1" data-toggle="tab"><?php echo $diklatpusat->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $diklatpusat_view->MultiPages->pageStyle(2) ?>" href="#tab_diklatpusat2" data-toggle="tab"><?php echo $diklatpusat->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$diklatpusat_view->isExport()) { ?>
		<div class="tab-pane<?php echo $diklatpusat_view->MultiPages->pageStyle(1) ?>" id="tab_diklatpusat1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($diklatpusat_view->idpelat->Visible) { // idpelat ?>
	<tr id="r_idpelat">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_idpelat"><?php echo $diklatpusat_view->idpelat->caption() ?></span></td>
		<td data-name="idpelat" <?php echo $diklatpusat_view->idpelat->cellAttributes() ?>>
<span id="el_diklatpusat_idpelat" data-page="1">
<span<?php echo $diklatpusat_view->idpelat->viewAttributes() ?>><?php echo $diklatpusat_view->idpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->kdpelat->Visible) { // kdpelat ?>
	<tr id="r_kdpelat">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_kdpelat"><?php echo $diklatpusat_view->kdpelat->caption() ?></span></td>
		<td data-name="kdpelat" <?php echo $diklatpusat_view->kdpelat->cellAttributes() ?>>
<span id="el_diklatpusat_kdpelat" data-page="1">
<span<?php echo $diklatpusat_view->kdpelat->viewAttributes() ?>><?php echo $diklatpusat_view->kdpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->kdjudul->Visible) { // kdjudul ?>
	<tr id="r_kdjudul">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_kdjudul"><?php echo $diklatpusat_view->kdjudul->caption() ?></span></td>
		<td data-name="kdjudul" <?php echo $diklatpusat_view->kdjudul->cellAttributes() ?>>
<span id="el_diklatpusat_kdjudul" data-page="1">
<span<?php echo $diklatpusat_view->kdjudul->viewAttributes() ?>><?php echo $diklatpusat_view->kdjudul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->tawal->Visible) { // tawal ?>
	<tr id="r_tawal">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_tawal"><?php echo $diklatpusat_view->tawal->caption() ?></span></td>
		<td data-name="tawal" <?php echo $diklatpusat_view->tawal->cellAttributes() ?>>
<span id="el_diklatpusat_tawal" data-page="1">
<span<?php echo $diklatpusat_view->tawal->viewAttributes() ?>><?php echo $diklatpusat_view->tawal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->takhir->Visible) { // takhir ?>
	<tr id="r_takhir">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_takhir"><?php echo $diklatpusat_view->takhir->caption() ?></span></td>
		<td data-name="takhir" <?php echo $diklatpusat_view->takhir->cellAttributes() ?>>
<span id="el_diklatpusat_takhir" data-page="1">
<span<?php echo $diklatpusat_view->takhir->viewAttributes() ?>><?php echo $diklatpusat_view->takhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->dana->Visible) { // dana ?>
	<tr id="r_dana">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_dana"><?php echo $diklatpusat_view->dana->caption() ?></span></td>
		<td data-name="dana" <?php echo $diklatpusat_view->dana->cellAttributes() ?>>
<span id="el_diklatpusat_dana" data-page="1">
<span<?php echo $diklatpusat_view->dana->viewAttributes() ?>><?php echo $diklatpusat_view->dana->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->anggota2->Visible) { // anggota2 ?>
	<tr id="r_anggota2">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_anggota2"><?php echo $diklatpusat_view->anggota2->caption() ?></span></td>
		<td data-name="anggota2" <?php echo $diklatpusat_view->anggota2->cellAttributes() ?>>
<span id="el_diklatpusat_anggota2" data-page="1">
<span<?php echo $diklatpusat_view->anggota2->viewAttributes() ?>><?php echo $diklatpusat_view->anggota2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->widyaiswara->Visible) { // widyaiswara ?>
	<tr id="r_widyaiswara">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_widyaiswara"><?php echo $diklatpusat_view->widyaiswara->caption() ?></span></td>
		<td data-name="widyaiswara" <?php echo $diklatpusat_view->widyaiswara->cellAttributes() ?>>
<span id="el_diklatpusat_widyaiswara" data-page="1">
<span<?php echo $diklatpusat_view->widyaiswara->viewAttributes() ?>><?php echo $diklatpusat_view->widyaiswara->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->statuspel->Visible) { // statuspel ?>
	<tr id="r_statuspel">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_statuspel"><?php echo $diklatpusat_view->statuspel->caption() ?></span></td>
		<td data-name="statuspel" <?php echo $diklatpusat_view->statuspel->cellAttributes() ?>>
<span id="el_diklatpusat_statuspel" data-page="1">
<span<?php echo $diklatpusat_view->statuspel->viewAttributes() ?>><?php echo $diklatpusat_view->statuspel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->ket->Visible) { // ket ?>
	<tr id="r_ket">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_ket"><?php echo $diklatpusat_view->ket->caption() ?></span></td>
		<td data-name="ket" <?php echo $diklatpusat_view->ket->cellAttributes() ?>>
<span id="el_diklatpusat_ket" data-page="1">
<span<?php echo $diklatpusat_view->ket->viewAttributes() ?>><?php echo $diklatpusat_view->ket->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<tr id="r_jenisevaluasi">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_jenisevaluasi"><?php echo $diklatpusat_view->jenisevaluasi->caption() ?></span></td>
		<td data-name="jenisevaluasi" <?php echo $diklatpusat_view->jenisevaluasi->cellAttributes() ?>>
<span id="el_diklatpusat_jenisevaluasi" data-page="1">
<span<?php echo $diklatpusat_view->jenisevaluasi->viewAttributes() ?>><?php echo $diklatpusat_view->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$diklatpusat_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$diklatpusat_view->isExport()) { ?>
		<div class="tab-pane<?php echo $diklatpusat_view->MultiPages->pageStyle(2) ?>" id="tab_diklatpusat2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($diklatpusat_view->ketua->Visible) { // ketua ?>
	<tr id="r_ketua">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_ketua"><?php echo $diklatpusat_view->ketua->caption() ?></span></td>
		<td data-name="ketua" <?php echo $diklatpusat_view->ketua->cellAttributes() ?>>
<span id="el_diklatpusat_ketua" data-page="2">
<span<?php echo $diklatpusat_view->ketua->viewAttributes() ?>><?php echo $diklatpusat_view->ketua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->sekretaris->Visible) { // sekretaris ?>
	<tr id="r_sekretaris">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_sekretaris"><?php echo $diklatpusat_view->sekretaris->caption() ?></span></td>
		<td data-name="sekretaris" <?php echo $diklatpusat_view->sekretaris->cellAttributes() ?>>
<span id="el_diklatpusat_sekretaris" data-page="2">
<span<?php echo $diklatpusat_view->sekretaris->viewAttributes() ?>><?php echo $diklatpusat_view->sekretaris->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatpusat_view->bendahara->Visible) { // bendahara ?>
	<tr id="r_bendahara">
		<td class="<?php echo $diklatpusat_view->TableLeftColumnClass ?>"><span id="elh_diklatpusat_bendahara"><?php echo $diklatpusat_view->bendahara->caption() ?></span></td>
		<td data-name="bendahara" <?php echo $diklatpusat_view->bendahara->cellAttributes() ?>>
<span id="el_diklatpusat_bendahara" data-page="2">
<span<?php echo $diklatpusat_view->bendahara->viewAttributes() ?>><?php echo $diklatpusat_view->bendahara->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$diklatpusat_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$diklatpusat_view->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php
$diklatpusat_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$diklatpusat_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$diklatpusat_view->terminate();
?>