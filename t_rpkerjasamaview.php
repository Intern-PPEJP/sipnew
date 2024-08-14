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
$t_rpkerjasama_view = new t_rpkerjasama_view();

// Run the page
$t_rpkerjasama_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpkerjasama_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rpkerjasama_view->isExport()) { ?>
<script>
var ft_rpkerjasamaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_rpkerjasamaview = currentForm = new ew.Form("ft_rpkerjasamaview", "view");
	loadjs.done("ft_rpkerjasamaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rpkerjasama_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_rpkerjasama_view->ExportOptions->render("body") ?>
<?php $t_rpkerjasama_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_rpkerjasama_view->showPageHeader(); ?>
<?php
$t_rpkerjasama_view->showMessage();
?>
<form name="ft_rpkerjasamaview" id="ft_rpkerjasamaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpkerjasama">
<input type="hidden" name="modal" value="<?php echo (int)$t_rpkerjasama_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_rpkerjasama_view->jenispel->Visible) { // jenispel ?>
	<tr id="r_jenispel">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_jenispel"><?php echo $t_rpkerjasama_view->jenispel->caption() ?></span></td>
		<td data-name="jenispel" <?php echo $t_rpkerjasama_view->jenispel->cellAttributes() ?>>
<span id="el_t_rpkerjasama_jenispel">
<span<?php echo $t_rpkerjasama_view->jenispel->viewAttributes() ?>><?php echo $t_rpkerjasama_view->jenispel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->kdkategori->Visible) { // kdkategori ?>
	<tr id="r_kdkategori">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_kdkategori"><?php echo $t_rpkerjasama_view->kdkategori->caption() ?></span></td>
		<td data-name="kdkategori" <?php echo $t_rpkerjasama_view->kdkategori->cellAttributes() ?>>
<span id="el_t_rpkerjasama_kdkategori">
<span<?php echo $t_rpkerjasama_view->kdkategori->viewAttributes() ?>><?php echo $t_rpkerjasama_view->kdkategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->kerjasama->Visible) { // kerjasama ?>
	<tr id="r_kerjasama">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_kerjasama"><?php echo $t_rpkerjasama_view->kerjasama->caption() ?></span></td>
		<td data-name="kerjasama" <?php echo $t_rpkerjasama_view->kerjasama->cellAttributes() ?>>
<span id="el_t_rpkerjasama_kerjasama">
<span<?php echo $t_rpkerjasama_view->kerjasama->viewAttributes() ?>><?php echo $t_rpkerjasama_view->kerjasama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->angkatan->Visible) { // angkatan ?>
	<tr id="r_angkatan">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_angkatan"><?php echo $t_rpkerjasama_view->angkatan->caption() ?></span></td>
		<td data-name="angkatan" <?php echo $t_rpkerjasama_view->angkatan->cellAttributes() ?>>
<span id="el_t_rpkerjasama_angkatan">
<span<?php echo $t_rpkerjasama_view->angkatan->viewAttributes() ?>><?php echo $t_rpkerjasama_view->angkatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->sisa_angkatan->Visible) { // sisa_angkatan ?>
	<tr id="r_sisa_angkatan">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_sisa_angkatan"><?php echo $t_rpkerjasama_view->sisa_angkatan->caption() ?></span></td>
		<td data-name="sisa_angkatan" <?php echo $t_rpkerjasama_view->sisa_angkatan->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sisa_angkatan">
<span<?php echo $t_rpkerjasama_view->sisa_angkatan->viewAttributes() ?>><?php echo $t_rpkerjasama_view->sisa_angkatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->targetpes->Visible) { // targetpes ?>
	<tr id="r_targetpes">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_targetpes"><?php echo $t_rpkerjasama_view->targetpes->caption() ?></span></td>
		<td data-name="targetpes" <?php echo $t_rpkerjasama_view->targetpes->cellAttributes() ?>>
<span id="el_t_rpkerjasama_targetpes">
<span<?php echo $t_rpkerjasama_view->targetpes->viewAttributes() ?>><?php echo $t_rpkerjasama_view->targetpes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->kontak_person->Visible) { // kontak_person ?>
	<tr id="r_kontak_person">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_kontak_person"><?php echo $t_rpkerjasama_view->kontak_person->caption() ?></span></td>
		<td data-name="kontak_person" <?php echo $t_rpkerjasama_view->kontak_person->cellAttributes() ?>>
<span id="el_t_rpkerjasama_kontak_person">
<span<?php echo $t_rpkerjasama_view->kontak_person->viewAttributes() ?>><?php echo $t_rpkerjasama_view->kontak_person->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->tglrevisi->Visible) { // tglrevisi ?>
	<tr id="r_tglrevisi">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_tglrevisi"><?php echo $t_rpkerjasama_view->tglrevisi->caption() ?></span></td>
		<td data-name="tglrevisi" <?php echo $t_rpkerjasama_view->tglrevisi->cellAttributes() ?>>
<span id="el_t_rpkerjasama_tglrevisi">
<span<?php echo $t_rpkerjasama_view->tglrevisi->viewAttributes() ?>><?php echo $t_rpkerjasama_view->tglrevisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->tahun_rencana->Visible) { // tahun_rencana ?>
	<tr id="r_tahun_rencana">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_tahun_rencana"><?php echo $t_rpkerjasama_view->tahun_rencana->caption() ?></span></td>
		<td data-name="tahun_rencana" <?php echo $t_rpkerjasama_view->tahun_rencana->cellAttributes() ?>>
<span id="el_t_rpkerjasama_tahun_rencana">
<span<?php echo $t_rpkerjasama_view->tahun_rencana->viewAttributes() ?>><?php echo $t_rpkerjasama_view->tahun_rencana->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->mou->Visible) { // mou ?>
	<tr id="r_mou">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_mou"><?php echo $t_rpkerjasama_view->mou->caption() ?></span></td>
		<td data-name="mou" <?php echo $t_rpkerjasama_view->mou->cellAttributes() ?>>
<span id="el_t_rpkerjasama_mou">
<span<?php echo $t_rpkerjasama_view->mou->viewAttributes() ?>><?php echo GetFileViewTag($t_rpkerjasama_view->mou, $t_rpkerjasama_view->mou->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->mou2->Visible) { // mou2 ?>
	<tr id="r_mou2">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_mou2"><?php echo $t_rpkerjasama_view->mou2->caption() ?></span></td>
		<td data-name="mou2" <?php echo $t_rpkerjasama_view->mou2->cellAttributes() ?>>
<span id="el_t_rpkerjasama_mou2">
<span<?php echo $t_rpkerjasama_view->mou2->viewAttributes() ?>><?php echo GetFileViewTag($t_rpkerjasama_view->mou2, $t_rpkerjasama_view->mou2->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->mou3->Visible) { // mou3 ?>
	<tr id="r_mou3">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_mou3"><?php echo $t_rpkerjasama_view->mou3->caption() ?></span></td>
		<td data-name="mou3" <?php echo $t_rpkerjasama_view->mou3->cellAttributes() ?>>
<span id="el_t_rpkerjasama_mou3">
<span<?php echo $t_rpkerjasama_view->mou3->viewAttributes() ?>><?php echo GetFileViewTag($t_rpkerjasama_view->mou3, $t_rpkerjasama_view->mou3->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->sk->Visible) { // sk ?>
	<tr id="r_sk">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_sk"><?php echo $t_rpkerjasama_view->sk->caption() ?></span></td>
		<td data-name="sk" <?php echo $t_rpkerjasama_view->sk->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk">
<span<?php echo $t_rpkerjasama_view->sk->viewAttributes() ?>><?php echo GetFileViewTag($t_rpkerjasama_view->sk, $t_rpkerjasama_view->sk->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->sk2->Visible) { // sk2 ?>
	<tr id="r_sk2">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_sk2"><?php echo $t_rpkerjasama_view->sk2->caption() ?></span></td>
		<td data-name="sk2" <?php echo $t_rpkerjasama_view->sk2->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk2">
<span<?php echo $t_rpkerjasama_view->sk2->viewAttributes() ?>><?php echo GetFileViewTag($t_rpkerjasama_view->sk2, $t_rpkerjasama_view->sk2->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->sk3->Visible) { // sk3 ?>
	<tr id="r_sk3">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_sk3"><?php echo $t_rpkerjasama_view->sk3->caption() ?></span></td>
		<td data-name="sk3" <?php echo $t_rpkerjasama_view->sk3->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk3">
<span<?php echo $t_rpkerjasama_view->sk3->viewAttributes() ?>><?php echo GetFileViewTag($t_rpkerjasama_view->sk3, $t_rpkerjasama_view->sk3->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->sk4->Visible) { // sk4 ?>
	<tr id="r_sk4">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_sk4"><?php echo $t_rpkerjasama_view->sk4->caption() ?></span></td>
		<td data-name="sk4" <?php echo $t_rpkerjasama_view->sk4->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk4">
<span<?php echo $t_rpkerjasama_view->sk4->viewAttributes() ?>><?php echo GetFileViewTag($t_rpkerjasama_view->sk4, $t_rpkerjasama_view->sk4->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->sk5->Visible) { // sk5 ?>
	<tr id="r_sk5">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_sk5"><?php echo $t_rpkerjasama_view->sk5->caption() ?></span></td>
		<td data-name="sk5" <?php echo $t_rpkerjasama_view->sk5->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk5">
<span<?php echo $t_rpkerjasama_view->sk5->viewAttributes() ?>><?php echo GetFileViewTag($t_rpkerjasama_view->sk5, $t_rpkerjasama_view->sk5->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpkerjasama_view->jml_hari->Visible) { // jml_hari ?>
	<tr id="r_jml_hari">
		<td class="<?php echo $t_rpkerjasama_view->TableLeftColumnClass ?>"><span id="elh_t_rpkerjasama_jml_hari"><?php echo $t_rpkerjasama_view->jml_hari->caption() ?></span></td>
		<td data-name="jml_hari" <?php echo $t_rpkerjasama_view->jml_hari->cellAttributes() ?>>
<span id="el_t_rpkerjasama_jml_hari">
<span<?php echo $t_rpkerjasama_view->jml_hari->viewAttributes() ?>><?php echo $t_rpkerjasama_view->jml_hari->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("diklatkerjasama", explode(",", $t_rpkerjasama->getCurrentDetailTable())) && $diklatkerjasama->DetailView) {
?>
<?php if ($t_rpkerjasama->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("diklatkerjasama", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "diklatkerjasamagrid.php" ?>
<?php } ?>
</form>
<?php
$t_rpkerjasama_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rpkerjasama_view->isExport()) { ?>
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
$t_rpkerjasama_view->terminate();
?>