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
$t_juduldetail_view = new t_juduldetail_view();

// Run the page
$t_juduldetail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_juduldetail_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_juduldetail_view->isExport()) { ?>
<script>
var ft_juduldetailview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_juduldetailview = currentForm = new ew.Form("ft_juduldetailview", "view");
	loadjs.done("ft_juduldetailview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_juduldetail_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_juduldetail_view->ExportOptions->render("body") ?>
<?php $t_juduldetail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_juduldetail_view->showPageHeader(); ?>
<?php
$t_juduldetail_view->showMessage();
?>
<form name="ft_juduldetailview" id="ft_juduldetailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_juduldetail">
<input type="hidden" name="modal" value="<?php echo (int)$t_juduldetail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_juduldetail_view->singbagian->Visible) { // singbagian ?>
	<tr id="r_singbagian">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_singbagian"><?php echo $t_juduldetail_view->singbagian->caption() ?></span></td>
		<td data-name="singbagian" <?php echo $t_juduldetail_view->singbagian->cellAttributes() ?>>
<span id="el_t_juduldetail_singbagian">
<span<?php echo $t_juduldetail_view->singbagian->viewAttributes() ?>><?php echo $t_juduldetail_view->singbagian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->jpel->Visible) { // jpel ?>
	<tr id="r_jpel">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_jpel"><?php echo $t_juduldetail_view->jpel->caption() ?></span></td>
		<td data-name="jpel" <?php echo $t_juduldetail_view->jpel->cellAttributes() ?>>
<span id="el_t_juduldetail_jpel">
<span<?php echo $t_juduldetail_view->jpel->viewAttributes() ?>><?php echo $t_juduldetail_view->jpel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->kdjudul->Visible) { // kdjudul ?>
	<tr id="r_kdjudul">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_kdjudul"><?php echo $t_juduldetail_view->kdjudul->caption() ?></span></td>
		<td data-name="kdjudul" <?php echo $t_juduldetail_view->kdjudul->cellAttributes() ?>>
<span id="el_t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail_view->kdjudul->viewAttributes() ?>><?php echo $t_juduldetail_view->kdjudul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->kdkursil->Visible) { // kdkursil ?>
	<tr id="r_kdkursil">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_kdkursil"><?php echo $t_juduldetail_view->kdkursil->caption() ?></span></td>
		<td data-name="kdkursil" <?php echo $t_juduldetail_view->kdkursil->cellAttributes() ?>>
<span id="el_t_juduldetail_kdkursil">
<span<?php echo $t_juduldetail_view->kdkursil->viewAttributes() ?>><?php echo $t_juduldetail_view->kdkursil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->revisi->Visible) { // revisi ?>
	<tr id="r_revisi">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_revisi"><?php echo $t_juduldetail_view->revisi->caption() ?></span></td>
		<td data-name="revisi" <?php echo $t_juduldetail_view->revisi->cellAttributes() ?>>
<span id="el_t_juduldetail_revisi">
<span<?php echo $t_juduldetail_view->revisi->viewAttributes() ?>><?php echo $t_juduldetail_view->revisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->tgl_terbit->Visible) { // tgl_terbit ?>
	<tr id="r_tgl_terbit">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_tgl_terbit"><?php echo $t_juduldetail_view->tgl_terbit->caption() ?></span></td>
		<td data-name="tgl_terbit" <?php echo $t_juduldetail_view->tgl_terbit->cellAttributes() ?>>
<span id="el_t_juduldetail_tgl_terbit">
<span<?php echo $t_juduldetail_view->tgl_terbit->viewAttributes() ?>><?php echo $t_juduldetail_view->tgl_terbit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
	<tr id="r_deskripsi_singkat">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_deskripsi_singkat"><?php echo $t_juduldetail_view->deskripsi_singkat->caption() ?></span></td>
		<td data-name="deskripsi_singkat" <?php echo $t_juduldetail_view->deskripsi_singkat->cellAttributes() ?>>
<span id="el_t_juduldetail_deskripsi_singkat">
<span<?php echo $t_juduldetail_view->deskripsi_singkat->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_view->deskripsi_singkat->TooltipValue) && $t_juduldetail_view->deskripsi_singkat->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_view->deskripsi_singkat->linkAttributes() ?>><?php echo $t_juduldetail_view->deskripsi_singkat->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_view->deskripsi_singkat->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_deskripsi_singkat" class="d-none">
<?php echo $t_juduldetail_view->deskripsi_singkat->TooltipValue ?>
</span></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->tujuan->Visible) { // tujuan ?>
	<tr id="r_tujuan">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_tujuan"><?php echo $t_juduldetail_view->tujuan->caption() ?></span></td>
		<td data-name="tujuan" <?php echo $t_juduldetail_view->tujuan->cellAttributes() ?>>
<span id="el_t_juduldetail_tujuan">
<span<?php echo $t_juduldetail_view->tujuan->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_view->tujuan->TooltipValue) && $t_juduldetail_view->tujuan->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_view->tujuan->linkAttributes() ?>><?php echo $t_juduldetail_view->tujuan->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_view->tujuan->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_tujuan" class="d-none">
<?php echo $t_juduldetail_view->tujuan->TooltipValue ?>
</span></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->target_peserta->Visible) { // target_peserta ?>
	<tr id="r_target_peserta">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_target_peserta"><?php echo $t_juduldetail_view->target_peserta->caption() ?></span></td>
		<td data-name="target_peserta" <?php echo $t_juduldetail_view->target_peserta->cellAttributes() ?>>
<span id="el_t_juduldetail_target_peserta">
<span<?php echo $t_juduldetail_view->target_peserta->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_view->target_peserta->TooltipValue) && $t_juduldetail_view->target_peserta->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_view->target_peserta->linkAttributes() ?>><?php echo $t_juduldetail_view->target_peserta->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_view->target_peserta->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_target_peserta" class="d-none">
<?php echo $t_juduldetail_view->target_peserta->TooltipValue ?>
</span></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->lama_pelatihan->Visible) { // lama_pelatihan ?>
	<tr id="r_lama_pelatihan">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_lama_pelatihan"><?php echo $t_juduldetail_view->lama_pelatihan->caption() ?></span></td>
		<td data-name="lama_pelatihan" <?php echo $t_juduldetail_view->lama_pelatihan->cellAttributes() ?>>
<span id="el_t_juduldetail_lama_pelatihan">
<span<?php echo $t_juduldetail_view->lama_pelatihan->viewAttributes() ?>><?php echo $t_juduldetail_view->lama_pelatihan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_juduldetail_view->catatan->Visible) { // catatan ?>
	<tr id="r_catatan">
		<td class="<?php echo $t_juduldetail_view->TableLeftColumnClass ?>"><span id="elh_t_juduldetail_catatan"><?php echo $t_juduldetail_view->catatan->caption() ?></span></td>
		<td data-name="catatan" <?php echo $t_juduldetail_view->catatan->cellAttributes() ?>>
<span id="el_t_juduldetail_catatan">
<span<?php echo $t_juduldetail_view->catatan->viewAttributes() ?>><?php echo $t_juduldetail_view->catatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("t_kurikulum", explode(",", $t_juduldetail->getCurrentDetailTable())) && $t_kurikulum->DetailView) {
?>
<?php if ($t_juduldetail->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_kurikulum", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_juduldetail_view->t_kurikulum_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "t_kurikulumgrid.php" ?>
<?php } ?>
</form>
<?php
$t_juduldetail_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_juduldetail_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	<?php if(@$_GET["pop"] == 1) { ?>
	$("#ewSearchDialog .ewToolbar, .modal #ewHeaderRow, .modal #ewMenuColumn").hide();
	$("#ewSearchDialog #ewSearchDialogTitle").text("KURIKULUM");
	$("#ewSearchDialog .modal-body").css({"height": "500px", "overflow-y": "auto"});
	$("#ewSearchDialog .modal-footer").html('<button type="button" class="btn btn-default ewButton" data-dismiss="modal">Tutup</button>');
	<?php } ?>
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_juduldetail_view->terminate();
?>