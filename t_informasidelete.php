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
$t_informasi_delete = new t_informasi_delete();

// Run the page
$t_informasi_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_informasi_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_informasidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_informasidelete = currentForm = new ew.Form("ft_informasidelete", "delete");
	loadjs.done("ft_informasidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_informasi_delete->showPageHeader(); ?>
<?php
$t_informasi_delete->showMessage();
?>
<form name="ft_informasidelete" id="ft_informasidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_informasi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_informasi_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_informasi_delete->kdinformasi->Visible) { // kdinformasi ?>
		<th class="<?php echo $t_informasi_delete->kdinformasi->headerCellClass() ?>"><span id="elh_t_informasi_kdinformasi" class="t_informasi_kdinformasi"><?php echo $t_informasi_delete->kdinformasi->caption() ?></span></th>
<?php } ?>
<?php if ($t_informasi_delete->informasi->Visible) { // informasi ?>
		<th class="<?php echo $t_informasi_delete->informasi->headerCellClass() ?>"><span id="elh_t_informasi_informasi" class="t_informasi_informasi"><?php echo $t_informasi_delete->informasi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_informasi_delete->RecordCount = 0;
$i = 0;
while (!$t_informasi_delete->Recordset->EOF) {
	$t_informasi_delete->RecordCount++;
	$t_informasi_delete->RowCount++;

	// Set row properties
	$t_informasi->resetAttributes();
	$t_informasi->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_informasi_delete->loadRowValues($t_informasi_delete->Recordset);

	// Render row
	$t_informasi_delete->renderRow();
?>
	<tr <?php echo $t_informasi->rowAttributes() ?>>
<?php if ($t_informasi_delete->kdinformasi->Visible) { // kdinformasi ?>
		<td <?php echo $t_informasi_delete->kdinformasi->cellAttributes() ?>>
<span id="el<?php echo $t_informasi_delete->RowCount ?>_t_informasi_kdinformasi" class="t_informasi_kdinformasi">
<span<?php echo $t_informasi_delete->kdinformasi->viewAttributes() ?>><?php echo $t_informasi_delete->kdinformasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_informasi_delete->informasi->Visible) { // informasi ?>
		<td <?php echo $t_informasi_delete->informasi->cellAttributes() ?>>
<span id="el<?php echo $t_informasi_delete->RowCount ?>_t_informasi_informasi" class="t_informasi_informasi">
<span<?php echo $t_informasi_delete->informasi->viewAttributes() ?>><?php echo $t_informasi_delete->informasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_informasi_delete->Recordset->moveNext();
}
$t_informasi_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_informasi_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_informasi_delete->showPageFooter();
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
$t_informasi_delete->terminate();
?>