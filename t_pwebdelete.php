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
$t_pweb_delete = new t_pweb_delete();

// Run the page
$t_pweb_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pweb_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pwebdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_pwebdelete = currentForm = new ew.Form("ft_pwebdelete", "delete");
	loadjs.done("ft_pwebdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pweb_delete->showPageHeader(); ?>
<?php
$t_pweb_delete->showMessage();
?>
<form name="ft_pwebdelete" id="ft_pwebdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pweb">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_pweb_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_pweb_delete->kdhistori->Visible) { // kdhistori ?>
		<th class="<?php echo $t_pweb_delete->kdhistori->headerCellClass() ?>"><span id="elh_t_pweb_kdhistori" class="t_pweb_kdhistori"><?php echo $t_pweb_delete->kdhistori->caption() ?></span></th>
<?php } ?>
<?php if ($t_pweb_delete->rkwid->Visible) { // rkwid ?>
		<th class="<?php echo $t_pweb_delete->rkwid->headerCellClass() ?>"><span id="elh_t_pweb_rkwid" class="t_pweb_rkwid"><?php echo $t_pweb_delete->rkwid->caption() ?></span></th>
<?php } ?>
<?php if ($t_pweb_delete->id->Visible) { // id ?>
		<th class="<?php echo $t_pweb_delete->id->headerCellClass() ?>"><span id="elh_t_pweb_id" class="t_pweb_id"><?php echo $t_pweb_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($t_pweb_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $t_pweb_delete->tahun->headerCellClass() ?>"><span id="elh_t_pweb_tahun" class="t_pweb_tahun"><?php echo $t_pweb_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($t_pweb_delete->kdinformasi->Visible) { // kdinformasi ?>
		<th class="<?php echo $t_pweb_delete->kdinformasi->headerCellClass() ?>"><span id="elh_t_pweb_kdinformasi" class="t_pweb_kdinformasi"><?php echo $t_pweb_delete->kdinformasi->caption() ?></span></th>
<?php } ?>
<?php if ($t_pweb_delete->harapan->Visible) { // harapan ?>
		<th class="<?php echo $t_pweb_delete->harapan->headerCellClass() ?>"><span id="elh_t_pweb_harapan" class="t_pweb_harapan"><?php echo $t_pweb_delete->harapan->caption() ?></span></th>
<?php } ?>
<?php if ($t_pweb_delete->sertifikat->Visible) { // sertifikat ?>
		<th class="<?php echo $t_pweb_delete->sertifikat->headerCellClass() ?>"><span id="elh_t_pweb_sertifikat" class="t_pweb_sertifikat"><?php echo $t_pweb_delete->sertifikat->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_pweb_delete->RecordCount = 0;
$i = 0;
while (!$t_pweb_delete->Recordset->EOF) {
	$t_pweb_delete->RecordCount++;
	$t_pweb_delete->RowCount++;

	// Set row properties
	$t_pweb->resetAttributes();
	$t_pweb->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_pweb_delete->loadRowValues($t_pweb_delete->Recordset);

	// Render row
	$t_pweb_delete->renderRow();
?>
	<tr <?php echo $t_pweb->rowAttributes() ?>>
<?php if ($t_pweb_delete->kdhistori->Visible) { // kdhistori ?>
		<td <?php echo $t_pweb_delete->kdhistori->cellAttributes() ?>>
<span id="el<?php echo $t_pweb_delete->RowCount ?>_t_pweb_kdhistori" class="t_pweb_kdhistori">
<span<?php echo $t_pweb_delete->kdhistori->viewAttributes() ?>><?php echo $t_pweb_delete->kdhistori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pweb_delete->rkwid->Visible) { // rkwid ?>
		<td <?php echo $t_pweb_delete->rkwid->cellAttributes() ?>>
<span id="el<?php echo $t_pweb_delete->RowCount ?>_t_pweb_rkwid" class="t_pweb_rkwid">
<span<?php echo $t_pweb_delete->rkwid->viewAttributes() ?>><?php echo $t_pweb_delete->rkwid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pweb_delete->id->Visible) { // id ?>
		<td <?php echo $t_pweb_delete->id->cellAttributes() ?>>
<span id="el<?php echo $t_pweb_delete->RowCount ?>_t_pweb_id" class="t_pweb_id">
<span<?php echo $t_pweb_delete->id->viewAttributes() ?>><?php echo $t_pweb_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pweb_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $t_pweb_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $t_pweb_delete->RowCount ?>_t_pweb_tahun" class="t_pweb_tahun">
<span<?php echo $t_pweb_delete->tahun->viewAttributes() ?>><?php echo $t_pweb_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pweb_delete->kdinformasi->Visible) { // kdinformasi ?>
		<td <?php echo $t_pweb_delete->kdinformasi->cellAttributes() ?>>
<span id="el<?php echo $t_pweb_delete->RowCount ?>_t_pweb_kdinformasi" class="t_pweb_kdinformasi">
<span<?php echo $t_pweb_delete->kdinformasi->viewAttributes() ?>><?php echo $t_pweb_delete->kdinformasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pweb_delete->harapan->Visible) { // harapan ?>
		<td <?php echo $t_pweb_delete->harapan->cellAttributes() ?>>
<span id="el<?php echo $t_pweb_delete->RowCount ?>_t_pweb_harapan" class="t_pweb_harapan">
<span<?php echo $t_pweb_delete->harapan->viewAttributes() ?>><?php echo $t_pweb_delete->harapan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pweb_delete->sertifikat->Visible) { // sertifikat ?>
		<td <?php echo $t_pweb_delete->sertifikat->cellAttributes() ?>>
<span id="el<?php echo $t_pweb_delete->RowCount ?>_t_pweb_sertifikat" class="t_pweb_sertifikat">
<span<?php echo $t_pweb_delete->sertifikat->viewAttributes() ?>><?php echo $t_pweb_delete->sertifikat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_pweb_delete->Recordset->moveNext();
}
$t_pweb_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pweb_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_pweb_delete->showPageFooter();
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
$t_pweb_delete->terminate();
?>