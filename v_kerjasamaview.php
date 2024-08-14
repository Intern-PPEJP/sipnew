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
$v_kerjasama_view = new v_kerjasama_view();

// Run the page
$v_kerjasama_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_kerjasama_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_kerjasama_view->isExport()) { ?>
<script>
var fv_kerjasamaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fv_kerjasamaview = currentForm = new ew.Form("fv_kerjasamaview", "view");
	loadjs.done("fv_kerjasamaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("view","Kerjasama : View Data");?>');

});
</script>
<?php } ?>
<?php if (!$v_kerjasama_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $v_kerjasama_view->ExportOptions->render("body") ?>
<?php $v_kerjasama_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $v_kerjasama_view->showPageHeader(); ?>
<?php
$v_kerjasama_view->showMessage();
?>
<form name="fv_kerjasamaview" id="fv_kerjasamaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_kerjasama">
<input type="hidden" name="modal" value="<?php echo (int)$v_kerjasama_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($v_kerjasama_view->kdpelat->Visible) { // kdpelat ?>
	<tr id="r_kdpelat">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_kdpelat"><?php echo $v_kerjasama_view->kdpelat->caption() ?></span></td>
		<td data-name="kdpelat" <?php echo $v_kerjasama_view->kdpelat->cellAttributes() ?>>
<span id="el_v_kerjasama_kdpelat">
<span<?php echo $v_kerjasama_view->kdpelat->viewAttributes() ?>><?php echo $v_kerjasama_view->kdpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->kdjudul->Visible) { // kdjudul ?>
	<tr id="r_kdjudul">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_kdjudul"><?php echo $v_kerjasama_view->kdjudul->caption() ?></span></td>
		<td data-name="kdjudul" <?php echo $v_kerjasama_view->kdjudul->cellAttributes() ?>>
<span id="el_v_kerjasama_kdjudul">
<span<?php echo $v_kerjasama_view->kdjudul->viewAttributes() ?>><?php echo $v_kerjasama_view->kdjudul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->kdkursil->Visible) { // kdkursil ?>
	<tr id="r_kdkursil">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_kdkursil"><?php echo $v_kerjasama_view->kdkursil->caption() ?></span></td>
		<td data-name="kdkursil" <?php echo $v_kerjasama_view->kdkursil->cellAttributes() ?>>
<span id="el_v_kerjasama_kdkursil">
<span<?php echo $v_kerjasama_view->kdkursil->viewAttributes() ?>><?php echo $v_kerjasama_view->kdkursil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->revisi->Visible) { // revisi ?>
	<tr id="r_revisi">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_revisi"><?php echo $v_kerjasama_view->revisi->caption() ?></span></td>
		<td data-name="revisi" <?php echo $v_kerjasama_view->revisi->cellAttributes() ?>>
<span id="el_v_kerjasama_revisi">
<span<?php echo $v_kerjasama_view->revisi->viewAttributes() ?>><?php echo $v_kerjasama_view->revisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->tgl_terbit->Visible) { // tgl_terbit ?>
	<tr id="r_tgl_terbit">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_tgl_terbit"><?php echo $v_kerjasama_view->tgl_terbit->caption() ?></span></td>
		<td data-name="tgl_terbit" <?php echo $v_kerjasama_view->tgl_terbit->cellAttributes() ?>>
<span id="el_v_kerjasama_tgl_terbit">
<span<?php echo $v_kerjasama_view->tgl_terbit->viewAttributes() ?>><?php echo $v_kerjasama_view->tgl_terbit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->tawal->Visible) { // tawal ?>
	<tr id="r_tawal">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_tawal"><?php echo $v_kerjasama_view->tawal->caption() ?></span></td>
		<td data-name="tawal" <?php echo $v_kerjasama_view->tawal->cellAttributes() ?>>
<span id="el_v_kerjasama_tawal">
<span<?php echo $v_kerjasama_view->tawal->viewAttributes() ?>><?php echo $v_kerjasama_view->tawal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->takhir->Visible) { // takhir ?>
	<tr id="r_takhir">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_takhir"><?php echo $v_kerjasama_view->takhir->caption() ?></span></td>
		<td data-name="takhir" <?php echo $v_kerjasama_view->takhir->cellAttributes() ?>>
<span id="el_v_kerjasama_takhir">
<span<?php echo $v_kerjasama_view->takhir->viewAttributes() ?>><?php echo $v_kerjasama_view->takhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->jenispel->Visible) { // jenispel ?>
	<tr id="r_jenispel">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_jenispel"><?php echo $v_kerjasama_view->jenispel->caption() ?></span></td>
		<td data-name="jenispel" <?php echo $v_kerjasama_view->jenispel->cellAttributes() ?>>
<span id="el_v_kerjasama_jenispel">
<span<?php echo $v_kerjasama_view->jenispel->viewAttributes() ?>><?php echo $v_kerjasama_view->jenispel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->kdkategori->Visible) { // kdkategori ?>
	<tr id="r_kdkategori">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_kdkategori"><?php echo $v_kerjasama_view->kdkategori->caption() ?></span></td>
		<td data-name="kdkategori" <?php echo $v_kerjasama_view->kdkategori->cellAttributes() ?>>
<span id="el_v_kerjasama_kdkategori">
<span<?php echo $v_kerjasama_view->kdkategori->viewAttributes() ?>><?php echo $v_kerjasama_view->kdkategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->kerjasama->Visible) { // kerjasama ?>
	<tr id="r_kerjasama">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_kerjasama"><?php echo $v_kerjasama_view->kerjasama->caption() ?></span></td>
		<td data-name="kerjasama" <?php echo $v_kerjasama_view->kerjasama->cellAttributes() ?>>
<span id="el_v_kerjasama_kerjasama">
<span<?php echo $v_kerjasama_view->kerjasama->viewAttributes() ?>><?php echo $v_kerjasama_view->kerjasama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->biaya->Visible) { // biaya ?>
	<tr id="r_biaya">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_biaya"><?php echo $v_kerjasama_view->biaya->caption() ?></span></td>
		<td data-name="biaya" <?php echo $v_kerjasama_view->biaya->cellAttributes() ?>>
<span id="el_v_kerjasama_biaya">
<span<?php echo $v_kerjasama_view->biaya->viewAttributes() ?>><?php echo $v_kerjasama_view->biaya->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->tempat->Visible) { // tempat ?>
	<tr id="r_tempat">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_tempat"><?php echo $v_kerjasama_view->tempat->caption() ?></span></td>
		<td data-name="tempat" <?php echo $v_kerjasama_view->tempat->cellAttributes() ?>>
<span id="el_v_kerjasama_tempat">
<span<?php echo $v_kerjasama_view->tempat->viewAttributes() ?>><?php echo $v_kerjasama_view->tempat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->target_peserta->Visible) { // target_peserta ?>
	<tr id="r_target_peserta">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_target_peserta"><?php echo $v_kerjasama_view->target_peserta->caption() ?></span></td>
		<td data-name="target_peserta" <?php echo $v_kerjasama_view->target_peserta->cellAttributes() ?>>
<span id="el_v_kerjasama_target_peserta">
<span<?php echo $v_kerjasama_view->target_peserta->viewAttributes() ?>><?php echo $v_kerjasama_view->target_peserta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->durasi1->Visible) { // durasi1 ?>
	<tr id="r_durasi1">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_durasi1"><?php echo $v_kerjasama_view->durasi1->caption() ?></span></td>
		<td data-name="durasi1" <?php echo $v_kerjasama_view->durasi1->cellAttributes() ?>>
<span id="el_v_kerjasama_durasi1">
<span<?php echo $v_kerjasama_view->durasi1->viewAttributes() ?>><?php echo $v_kerjasama_view->durasi1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->durasi2->Visible) { // durasi2 ?>
	<tr id="r_durasi2">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_durasi2"><?php echo $v_kerjasama_view->durasi2->caption() ?></span></td>
		<td data-name="durasi2" <?php echo $v_kerjasama_view->durasi2->cellAttributes() ?>>
<span id="el_v_kerjasama_durasi2">
<span<?php echo $v_kerjasama_view->durasi2->viewAttributes() ?>><?php echo $v_kerjasama_view->durasi2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->nmou->Visible) { // nmou ?>
	<tr id="r_nmou">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_nmou"><?php echo $v_kerjasama_view->nmou->caption() ?></span></td>
		<td data-name="nmou" <?php echo $v_kerjasama_view->nmou->cellAttributes() ?>>
<span id="el_v_kerjasama_nmou">
<span<?php echo $v_kerjasama_view->nmou->viewAttributes() ?>><?php echo GetFileViewTag($v_kerjasama_view->nmou, $v_kerjasama_view->nmou->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->nmou2->Visible) { // nmou2 ?>
	<tr id="r_nmou2">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_nmou2"><?php echo $v_kerjasama_view->nmou2->caption() ?></span></td>
		<td data-name="nmou2" <?php echo $v_kerjasama_view->nmou2->cellAttributes() ?>>
<span id="el_v_kerjasama_nmou2">
<span<?php echo $v_kerjasama_view->nmou2->viewAttributes() ?>><?php echo GetFileViewTag($v_kerjasama_view->nmou2, $v_kerjasama_view->nmou2->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($v_kerjasama_view->statuspel->Visible) { // statuspel ?>
	<tr id="r_statuspel">
		<td class="<?php echo $v_kerjasama_view->TableLeftColumnClass ?>"><span id="elh_v_kerjasama_statuspel"><?php echo $v_kerjasama_view->statuspel->caption() ?></span></td>
		<td data-name="statuspel" <?php echo $v_kerjasama_view->statuspel->cellAttributes() ?>>
<span id="el_v_kerjasama_statuspel">
<span<?php echo $v_kerjasama_view->statuspel->viewAttributes() ?>><?php echo $v_kerjasama_view->statuspel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$v_kerjasama_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_kerjasama_view->isExport()) { ?>
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
$v_kerjasama_view->terminate();
?>