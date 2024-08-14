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
$t_judul_delete = new t_judul_delete();

// Run the page
$t_judul_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_judul_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_juduldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_juduldelete = currentForm = new ew.Form("ft_juduldelete", "delete");
	loadjs.done("ft_juduldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_judul_delete->showPageHeader(); ?>
<?php
$t_judul_delete->showMessage();
?>
<form name="ft_juduldelete" id="ft_juduldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_judul">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_judul_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_judul_delete->kdjudul->Visible) { // kdjudul ?>
		<th class="<?php echo $t_judul_delete->kdjudul->headerCellClass() ?>"><span id="elh_t_judul_kdjudul" class="t_judul_kdjudul"><?php echo $t_judul_delete->kdjudul->caption() ?></span></th>
<?php } ?>
<?php if ($t_judul_delete->kdbidang->Visible) { // kdbidang ?>
		<th class="<?php echo $t_judul_delete->kdbidang->headerCellClass() ?>"><span id="elh_t_judul_kdbidang" class="t_judul_kdbidang"><?php echo $t_judul_delete->kdbidang->caption() ?></span></th>
<?php } ?>
<?php if ($t_judul_delete->judul->Visible) { // judul ?>
		<th class="<?php echo $t_judul_delete->judul->headerCellClass() ?>"><span id="elh_t_judul_judul" class="t_judul_judul"><?php echo $t_judul_delete->judul->caption() ?></span></th>
<?php } ?>
<?php if ($t_judul_delete->singkatan->Visible) { // singkatan ?>
		<th class="<?php echo $t_judul_delete->singkatan->headerCellClass() ?>"><span id="elh_t_judul_singkatan" class="t_judul_singkatan"><?php echo $t_judul_delete->singkatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_judul_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $t_judul_delete->created_at->headerCellClass() ?>"><span id="elh_t_judul_created_at" class="t_judul_created_at"><?php echo $t_judul_delete->created_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_judul_delete->RecordCount = 0;
$i = 0;
while (!$t_judul_delete->Recordset->EOF) {
	$t_judul_delete->RecordCount++;
	$t_judul_delete->RowCount++;

	// Set row properties
	$t_judul->resetAttributes();
	$t_judul->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_judul_delete->loadRowValues($t_judul_delete->Recordset);

	// Render row
	$t_judul_delete->renderRow();
?>
	<tr <?php echo $t_judul->rowAttributes() ?>>
<?php if ($t_judul_delete->kdjudul->Visible) { // kdjudul ?>
		<td <?php echo $t_judul_delete->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $t_judul_delete->RowCount ?>_t_judul_kdjudul" class="t_judul_kdjudul">
<span<?php echo $t_judul_delete->kdjudul->viewAttributes() ?>><?php echo $t_judul_delete->kdjudul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_judul_delete->kdbidang->Visible) { // kdbidang ?>
		<td <?php echo $t_judul_delete->kdbidang->cellAttributes() ?>>
<span id="el<?php echo $t_judul_delete->RowCount ?>_t_judul_kdbidang" class="t_judul_kdbidang">
<span<?php echo $t_judul_delete->kdbidang->viewAttributes() ?>><?php echo $t_judul_delete->kdbidang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_judul_delete->judul->Visible) { // judul ?>
		<td <?php echo $t_judul_delete->judul->cellAttributes() ?>>
<span id="el<?php echo $t_judul_delete->RowCount ?>_t_judul_judul" class="t_judul_judul">
<span<?php echo $t_judul_delete->judul->viewAttributes() ?>><?php echo $t_judul_delete->judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_judul_delete->singkatan->Visible) { // singkatan ?>
		<td <?php echo $t_judul_delete->singkatan->cellAttributes() ?>>
<span id="el<?php echo $t_judul_delete->RowCount ?>_t_judul_singkatan" class="t_judul_singkatan">
<span<?php echo $t_judul_delete->singkatan->viewAttributes() ?>><?php echo $t_judul_delete->singkatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_judul_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $t_judul_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $t_judul_delete->RowCount ?>_t_judul_created_at" class="t_judul_created_at">
<span<?php echo $t_judul_delete->created_at->viewAttributes() ?>><?php echo $t_judul_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_judul_delete->Recordset->moveNext();
}
$t_judul_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_judul_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_judul_delete->showPageFooter();
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
$t_judul_delete->terminate();
?>