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
$t_evaluasifas_delete = new t_evaluasifas_delete();

// Run the page
$t_evaluasifas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_evaluasifas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_evaluasifasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_evaluasifasdelete = currentForm = new ew.Form("ft_evaluasifasdelete", "delete");
	loadjs.done("ft_evaluasifasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_evaluasifas_delete->showPageHeader(); ?>
<?php
$t_evaluasifas_delete->showMessage();
?>
<form name="ft_evaluasifasdelete" id="ft_evaluasifasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_evaluasifas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_evaluasifas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_evaluasifas_delete->bioid->Visible) { // bioid ?>
		<th class="<?php echo $t_evaluasifas_delete->bioid->headerCellClass() ?>"><span id="elh_t_evaluasifas_bioid" class="t_evaluasifas_bioid"><?php echo $t_evaluasifas_delete->bioid->caption() ?></span></th>
<?php } ?>
<?php if ($t_evaluasifas_delete->idpelat->Visible) { // idpelat ?>
		<th class="<?php echo $t_evaluasifas_delete->idpelat->headerCellClass() ?>"><span id="elh_t_evaluasifas_idpelat" class="t_evaluasifas_idpelat"><?php echo $t_evaluasifas_delete->idpelat->caption() ?></span></th>
<?php } ?>
<?php if ($t_evaluasifas_delete->kurikulumid->Visible) { // kurikulumid ?>
		<th class="<?php echo $t_evaluasifas_delete->kurikulumid->headerCellClass() ?>"><span id="elh_t_evaluasifas_kurikulumid" class="t_evaluasifas_kurikulumid"><?php echo $t_evaluasifas_delete->kurikulumid->caption() ?></span></th>
<?php } ?>
<?php if ($t_evaluasifas_delete->nilai->Visible) { // nilai ?>
		<th class="<?php echo $t_evaluasifas_delete->nilai->headerCellClass() ?>"><span id="elh_t_evaluasifas_nilai" class="t_evaluasifas_nilai"><?php echo $t_evaluasifas_delete->nilai->caption() ?></span></th>
<?php } ?>
<?php if ($t_evaluasifas_delete->komentar->Visible) { // komentar ?>
		<th class="<?php echo $t_evaluasifas_delete->komentar->headerCellClass() ?>"><span id="elh_t_evaluasifas_komentar" class="t_evaluasifas_komentar"><?php echo $t_evaluasifas_delete->komentar->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_evaluasifas_delete->RecordCount = 0;
$i = 0;
while (!$t_evaluasifas_delete->Recordset->EOF) {
	$t_evaluasifas_delete->RecordCount++;
	$t_evaluasifas_delete->RowCount++;

	// Set row properties
	$t_evaluasifas->resetAttributes();
	$t_evaluasifas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_evaluasifas_delete->loadRowValues($t_evaluasifas_delete->Recordset);

	// Render row
	$t_evaluasifas_delete->renderRow();
?>
	<tr <?php echo $t_evaluasifas->rowAttributes() ?>>
<?php if ($t_evaluasifas_delete->bioid->Visible) { // bioid ?>
		<td <?php echo $t_evaluasifas_delete->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_delete->RowCount ?>_t_evaluasifas_bioid" class="t_evaluasifas_bioid">
<span<?php echo $t_evaluasifas_delete->bioid->viewAttributes() ?>><?php echo $t_evaluasifas_delete->bioid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_evaluasifas_delete->idpelat->Visible) { // idpelat ?>
		<td <?php echo $t_evaluasifas_delete->idpelat->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_delete->RowCount ?>_t_evaluasifas_idpelat" class="t_evaluasifas_idpelat">
<span<?php echo $t_evaluasifas_delete->idpelat->viewAttributes() ?>><?php echo $t_evaluasifas_delete->idpelat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_evaluasifas_delete->kurikulumid->Visible) { // kurikulumid ?>
		<td <?php echo $t_evaluasifas_delete->kurikulumid->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_delete->RowCount ?>_t_evaluasifas_kurikulumid" class="t_evaluasifas_kurikulumid">
<span<?php echo $t_evaluasifas_delete->kurikulumid->viewAttributes() ?>><?php echo $t_evaluasifas_delete->kurikulumid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_evaluasifas_delete->nilai->Visible) { // nilai ?>
		<td <?php echo $t_evaluasifas_delete->nilai->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_delete->RowCount ?>_t_evaluasifas_nilai" class="t_evaluasifas_nilai">
<span<?php echo $t_evaluasifas_delete->nilai->viewAttributes() ?>><?php echo $t_evaluasifas_delete->nilai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_evaluasifas_delete->komentar->Visible) { // komentar ?>
		<td <?php echo $t_evaluasifas_delete->komentar->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_delete->RowCount ?>_t_evaluasifas_komentar" class="t_evaluasifas_komentar">
<span<?php echo $t_evaluasifas_delete->komentar->viewAttributes() ?>><?php echo $t_evaluasifas_delete->komentar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_evaluasifas_delete->Recordset->moveNext();
}
$t_evaluasifas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_evaluasifas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_evaluasifas_delete->showPageFooter();
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
$t_evaluasifas_delete->terminate();
?>