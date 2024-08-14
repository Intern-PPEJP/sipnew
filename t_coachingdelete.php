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
$t_coaching_delete = new t_coaching_delete();

// Run the page
$t_coaching_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coaching_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_coachingdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_coachingdelete = currentForm = new ew.Form("ft_coachingdelete", "delete");
	loadjs.done("ft_coachingdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_coaching_delete->showPageHeader(); ?>
<?php
$t_coaching_delete->showMessage();
?>
<form name="ft_coachingdelete" id="ft_coachingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_coaching">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_coaching_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_coaching_delete->kdtahapan->Visible) { // kdtahapan ?>
		<th class="<?php echo $t_coaching_delete->kdtahapan->headerCellClass() ?>"><span id="elh_t_coaching_kdtahapan" class="t_coaching_kdtahapan"><?php echo $t_coaching_delete->kdtahapan->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->kdkursil->Visible) { // kdkursil ?>
		<th class="<?php echo $t_coaching_delete->kdkursil->headerCellClass() ?>"><span id="elh_t_coaching_kdkursil" class="t_coaching_kdkursil"><?php echo $t_coaching_delete->kdkursil->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->tawal->Visible) { // tawal ?>
		<th class="<?php echo $t_coaching_delete->tawal->headerCellClass() ?>"><span id="elh_t_coaching_tawal" class="t_coaching_tawal"><?php echo $t_coaching_delete->tawal->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->takhir->Visible) { // takhir ?>
		<th class="<?php echo $t_coaching_delete->takhir->headerCellClass() ?>"><span id="elh_t_coaching_takhir" class="t_coaching_takhir"><?php echo $t_coaching_delete->takhir->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->jmlhari->Visible) { // jmlhari ?>
		<th class="<?php echo $t_coaching_delete->jmlhari->headerCellClass() ?>"><span id="elh_t_coaching_jmlhari" class="t_coaching_jmlhari"><?php echo $t_coaching_delete->jmlhari->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->kdprop->Visible) { // kdprop ?>
		<th class="<?php echo $t_coaching_delete->kdprop->headerCellClass() ?>"><span id="elh_t_coaching_kdprop" class="t_coaching_kdprop"><?php echo $t_coaching_delete->kdprop->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->ketua->Visible) { // ketua ?>
		<th class="<?php echo $t_coaching_delete->ketua->headerCellClass() ?>"><span id="elh_t_coaching_ketua" class="t_coaching_ketua"><?php echo $t_coaching_delete->ketua->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->sekretaris->Visible) { // sekretaris ?>
		<th class="<?php echo $t_coaching_delete->sekretaris->headerCellClass() ?>"><span id="elh_t_coaching_sekretaris" class="t_coaching_sekretaris"><?php echo $t_coaching_delete->sekretaris->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->bendahara->Visible) { // bendahara ?>
		<th class="<?php echo $t_coaching_delete->bendahara->headerCellClass() ?>"><span id="elh_t_coaching_bendahara" class="t_coaching_bendahara"><?php echo $t_coaching_delete->bendahara->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->status->Visible) { // status ?>
		<th class="<?php echo $t_coaching_delete->status->headerCellClass() ?>"><span id="elh_t_coaching_status" class="t_coaching_status"><?php echo $t_coaching_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($t_coaching_delete->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<th class="<?php echo $t_coaching_delete->jenisevaluasi->headerCellClass() ?>"><span id="elh_t_coaching_jenisevaluasi" class="t_coaching_jenisevaluasi"><?php echo $t_coaching_delete->jenisevaluasi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_coaching_delete->RecordCount = 0;
$i = 0;
while (!$t_coaching_delete->Recordset->EOF) {
	$t_coaching_delete->RecordCount++;
	$t_coaching_delete->RowCount++;

	// Set row properties
	$t_coaching->resetAttributes();
	$t_coaching->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_coaching_delete->loadRowValues($t_coaching_delete->Recordset);

	// Render row
	$t_coaching_delete->renderRow();
?>
	<tr <?php echo $t_coaching->rowAttributes() ?>>
<?php if ($t_coaching_delete->kdtahapan->Visible) { // kdtahapan ?>
		<td <?php echo $t_coaching_delete->kdtahapan->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_kdtahapan" class="t_coaching_kdtahapan">
<span<?php echo $t_coaching_delete->kdtahapan->viewAttributes() ?>><?php echo $t_coaching_delete->kdtahapan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->kdkursil->Visible) { // kdkursil ?>
		<td <?php echo $t_coaching_delete->kdkursil->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_kdkursil" class="t_coaching_kdkursil">
<span<?php echo $t_coaching_delete->kdkursil->viewAttributes() ?>><?php echo $t_coaching_delete->kdkursil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->tawal->Visible) { // tawal ?>
		<td <?php echo $t_coaching_delete->tawal->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_tawal" class="t_coaching_tawal">
<span<?php echo $t_coaching_delete->tawal->viewAttributes() ?>><?php echo $t_coaching_delete->tawal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->takhir->Visible) { // takhir ?>
		<td <?php echo $t_coaching_delete->takhir->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_takhir" class="t_coaching_takhir">
<span<?php echo $t_coaching_delete->takhir->viewAttributes() ?>><?php echo $t_coaching_delete->takhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->jmlhari->Visible) { // jmlhari ?>
		<td <?php echo $t_coaching_delete->jmlhari->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_jmlhari" class="t_coaching_jmlhari">
<span<?php echo $t_coaching_delete->jmlhari->viewAttributes() ?>><?php echo $t_coaching_delete->jmlhari->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->kdprop->Visible) { // kdprop ?>
		<td <?php echo $t_coaching_delete->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_kdprop" class="t_coaching_kdprop">
<span<?php echo $t_coaching_delete->kdprop->viewAttributes() ?>><?php echo $t_coaching_delete->kdprop->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->ketua->Visible) { // ketua ?>
		<td <?php echo $t_coaching_delete->ketua->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_ketua" class="t_coaching_ketua">
<span<?php echo $t_coaching_delete->ketua->viewAttributes() ?>><?php echo $t_coaching_delete->ketua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->sekretaris->Visible) { // sekretaris ?>
		<td <?php echo $t_coaching_delete->sekretaris->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_sekretaris" class="t_coaching_sekretaris">
<span<?php echo $t_coaching_delete->sekretaris->viewAttributes() ?>><?php echo $t_coaching_delete->sekretaris->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->bendahara->Visible) { // bendahara ?>
		<td <?php echo $t_coaching_delete->bendahara->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_bendahara" class="t_coaching_bendahara">
<span<?php echo $t_coaching_delete->bendahara->viewAttributes() ?>><?php echo $t_coaching_delete->bendahara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->status->Visible) { // status ?>
		<td <?php echo $t_coaching_delete->status->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_status" class="t_coaching_status">
<span<?php echo $t_coaching_delete->status->viewAttributes() ?>><?php echo $t_coaching_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coaching_delete->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td <?php echo $t_coaching_delete->jenisevaluasi->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_delete->RowCount ?>_t_coaching_jenisevaluasi" class="t_coaching_jenisevaluasi">
<span<?php echo $t_coaching_delete->jenisevaluasi->viewAttributes() ?>><?php echo $t_coaching_delete->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_coaching_delete->Recordset->moveNext();
}
$t_coaching_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_coaching_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_coaching_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_coaching_delete->terminate();
?>