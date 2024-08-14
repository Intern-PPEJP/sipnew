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
$t_peserta_view = new t_peserta_view();

// Run the page
$t_peserta_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_peserta_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_peserta_view->isExport()) { ?>
<script>
var ft_pesertaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_pesertaview = currentForm = new ew.Form("ft_pesertaview", "view");
	loadjs.done("ft_pesertaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("view","Peserta : View Data");?>');

});
</script>
<?php } ?>
<?php if (!$t_peserta_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_peserta_view->ExportOptions->render("body") ?>
<?php $t_peserta_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_peserta_view->showPageHeader(); ?>
<?php
$t_peserta_view->showMessage();
?>
<form name="ft_pesertaview" id="ft_pesertaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_peserta">
<input type="hidden" name="modal" value="<?php echo (int)$t_peserta_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_peserta_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_nama"><?php echo $t_peserta_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $t_peserta_view->nama->cellAttributes() ?>>
<span id="el_t_peserta_nama">
<span<?php echo $t_peserta_view->nama->viewAttributes() ?>><?php echo $t_peserta_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->idp->Visible) { // idp ?>
	<tr id="r_idp">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_idp"><?php echo $t_peserta_view->idp->caption() ?></span></td>
		<td data-name="idp" <?php echo $t_peserta_view->idp->cellAttributes() ?>>
<span id="el_t_peserta_idp">
<span<?php echo $t_peserta_view->idp->viewAttributes() ?>><?php echo $t_peserta_view->idp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->tempat->Visible) { // tempat ?>
	<tr id="r_tempat">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_tempat"><?php echo $t_peserta_view->tempat->caption() ?></span></td>
		<td data-name="tempat" <?php echo $t_peserta_view->tempat->cellAttributes() ?>>
<span id="el_t_peserta_tempat">
<span<?php echo $t_peserta_view->tempat->viewAttributes() ?>><?php echo $t_peserta_view->tempat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->tlahir->Visible) { // tlahir ?>
	<tr id="r_tlahir">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_tlahir"><?php echo $t_peserta_view->tlahir->caption() ?></span></td>
		<td data-name="tlahir" <?php echo $t_peserta_view->tlahir->cellAttributes() ?>>
<span id="el_t_peserta_tlahir">
<span<?php echo $t_peserta_view->tlahir->viewAttributes() ?>><?php echo $t_peserta_view->tlahir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdagama->Visible) { // kdagama ?>
	<tr id="r_kdagama">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdagama"><?php echo $t_peserta_view->kdagama->caption() ?></span></td>
		<td data-name="kdagama" <?php echo $t_peserta_view->kdagama->cellAttributes() ?>>
<span id="el_t_peserta_kdagama">
<span<?php echo $t_peserta_view->kdagama->viewAttributes() ?>><?php echo $t_peserta_view->kdagama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdsex->Visible) { // kdsex ?>
	<tr id="r_kdsex">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdsex"><?php echo $t_peserta_view->kdsex->caption() ?></span></td>
		<td data-name="kdsex" <?php echo $t_peserta_view->kdsex->cellAttributes() ?>>
<span id="el_t_peserta_kdsex">
<span<?php echo $t_peserta_view->kdsex->viewAttributes() ?>><?php echo $t_peserta_view->kdsex->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdprop->Visible) { // kdprop ?>
	<tr id="r_kdprop">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdprop"><?php echo $t_peserta_view->kdprop->caption() ?></span></td>
		<td data-name="kdprop" <?php echo $t_peserta_view->kdprop->cellAttributes() ?>>
<span id="el_t_peserta_kdprop">
<span<?php echo $t_peserta_view->kdprop->viewAttributes() ?>><?php echo $t_peserta_view->kdprop->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdkota->Visible) { // kdkota ?>
	<tr id="r_kdkota">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdkota"><?php echo $t_peserta_view->kdkota->caption() ?></span></td>
		<td data-name="kdkota" <?php echo $t_peserta_view->kdkota->cellAttributes() ?>>
<span id="el_t_peserta_kdkota">
<span<?php echo $t_peserta_view->kdkota->viewAttributes() ?>><?php echo $t_peserta_view->kdkota->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdkec->Visible) { // kdkec ?>
	<tr id="r_kdkec">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdkec"><?php echo $t_peserta_view->kdkec->caption() ?></span></td>
		<td data-name="kdkec" <?php echo $t_peserta_view->kdkec->cellAttributes() ?>>
<span id="el_t_peserta_kdkec">
<span<?php echo $t_peserta_view->kdkec->viewAttributes() ?>><?php echo $t_peserta_view->kdkec->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->alamat->Visible) { // alamat ?>
	<tr id="r_alamat">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_alamat"><?php echo $t_peserta_view->alamat->caption() ?></span></td>
		<td data-name="alamat" <?php echo $t_peserta_view->alamat->cellAttributes() ?>>
<span id="el_t_peserta_alamat">
<span<?php echo $t_peserta_view->alamat->viewAttributes() ?>><?php echo $t_peserta_view->alamat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdpos->Visible) { // kdpos ?>
	<tr id="r_kdpos">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdpos"><?php echo $t_peserta_view->kdpos->caption() ?></span></td>
		<td data-name="kdpos" <?php echo $t_peserta_view->kdpos->cellAttributes() ?>>
<span id="el_t_peserta_kdpos">
<span<?php echo $t_peserta_view->kdpos->viewAttributes() ?>><?php echo $t_peserta_view->kdpos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->telp->Visible) { // telp ?>
	<tr id="r_telp">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_telp"><?php echo $t_peserta_view->telp->caption() ?></span></td>
		<td data-name="telp" <?php echo $t_peserta_view->telp->cellAttributes() ?>>
<span id="el_t_peserta_telp">
<span<?php echo $t_peserta_view->telp->viewAttributes() ?>><?php echo $t_peserta_view->telp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->hp->Visible) { // hp ?>
	<tr id="r_hp">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_hp"><?php echo $t_peserta_view->hp->caption() ?></span></td>
		<td data-name="hp" <?php echo $t_peserta_view->hp->cellAttributes() ?>>
<span id="el_t_peserta_hp">
<span<?php echo $t_peserta_view->hp->viewAttributes() ?>><?php echo $t_peserta_view->hp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta__email"><?php echo $t_peserta_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $t_peserta_view->_email->cellAttributes() ?>>
<span id="el_t_peserta__email">
<span<?php echo $t_peserta_view->_email->viewAttributes() ?>><?php echo $t_peserta_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdjabat->Visible) { // kdjabat ?>
	<tr id="r_kdjabat">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdjabat"><?php echo $t_peserta_view->kdjabat->caption() ?></span></td>
		<td data-name="kdjabat" <?php echo $t_peserta_view->kdjabat->cellAttributes() ?>>
<span id="el_t_peserta_kdjabat">
<span<?php echo $t_peserta_view->kdjabat->viewAttributes() ?>><?php echo $t_peserta_view->kdjabat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdpend->Visible) { // kdpend ?>
	<tr id="r_kdpend">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdpend"><?php echo $t_peserta_view->kdpend->caption() ?></span></td>
		<td data-name="kdpend" <?php echo $t_peserta_view->kdpend->cellAttributes() ?>>
<span id="el_t_peserta_kdpend">
<span<?php echo $t_peserta_view->kdpend->viewAttributes() ?>><?php echo $t_peserta_view->kdpend->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->kdbahasa->Visible) { // kdbahasa ?>
	<tr id="r_kdbahasa">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_kdbahasa"><?php echo $t_peserta_view->kdbahasa->caption() ?></span></td>
		<td data-name="kdbahasa" <?php echo $t_peserta_view->kdbahasa->cellAttributes() ?>>
<span id="el_t_peserta_kdbahasa">
<span<?php echo $t_peserta_view->kdbahasa->viewAttributes() ?>><?php echo $t_peserta_view->kdbahasa->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_created_at"><?php echo $t_peserta_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $t_peserta_view->created_at->cellAttributes() ?>>
<span id="el_t_peserta_created_at">
<span<?php echo $t_peserta_view->created_at->viewAttributes() ?>><?php echo $t_peserta_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_updated_at"><?php echo $t_peserta_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $t_peserta_view->updated_at->cellAttributes() ?>>
<span id="el_t_peserta_updated_at">
<span<?php echo $t_peserta_view->updated_at->viewAttributes() ?>><?php echo $t_peserta_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_peserta_view->jpelatihan->Visible) { // jpelatihan ?>
	<tr id="r_jpelatihan">
		<td class="<?php echo $t_peserta_view->TableLeftColumnClass ?>"><span id="elh_t_peserta_jpelatihan"><?php echo $t_peserta_view->jpelatihan->caption() ?></span></td>
		<td data-name="jpelatihan" <?php echo $t_peserta_view->jpelatihan->cellAttributes() ?>>
<span id="el_t_peserta_jpelatihan">
<span<?php echo $t_peserta_view->jpelatihan->viewAttributes() ?>><?php echo $t_peserta_view->jpelatihan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("cv_historipelatihanpeserta", explode(",", $t_peserta->getCurrentDetailTable())) && $cv_historipelatihanpeserta->DetailView) {
?>
<?php if ($t_peserta->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("cv_historipelatihanpeserta", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_peserta_view->cv_historipelatihanpeserta_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "cv_historipelatihanpesertagrid.php" ?>
<?php } ?>
</form>
<?php
$t_peserta_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_peserta_view->isExport()) { ?>
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
$t_peserta_view->terminate();
?>