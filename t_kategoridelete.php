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
$t_kategori_delete = new t_kategori_delete();

// Run the page
$t_kategori_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kategori_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_kategoridelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_kategoridelete = currentForm = new ew.Form("ft_kategoridelete", "delete");
	loadjs.done("ft_kategoridelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_kategori_delete->showPageHeader(); ?>
<?php
$t_kategori_delete->showMessage();
?>
<form name="ft_kategoridelete" id="ft_kategoridelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kategori">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_kategori_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_kategori_delete->kdkategori->Visible) { // kdkategori ?>
		<th class="<?php echo $t_kategori_delete->kdkategori->headerCellClass() ?>"><span id="elh_t_kategori_kdkategori" class="t_kategori_kdkategori"><?php echo $t_kategori_delete->kdkategori->caption() ?></span></th>
<?php } ?>
<?php if ($t_kategori_delete->kategori->Visible) { // kategori ?>
		<th class="<?php echo $t_kategori_delete->kategori->headerCellClass() ?>"><span id="elh_t_kategori_kategori" class="t_kategori_kategori"><?php echo $t_kategori_delete->kategori->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_kategori_delete->RecordCount = 0;
$i = 0;
while (!$t_kategori_delete->Recordset->EOF) {
	$t_kategori_delete->RecordCount++;
	$t_kategori_delete->RowCount++;

	// Set row properties
	$t_kategori->resetAttributes();
	$t_kategori->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_kategori_delete->loadRowValues($t_kategori_delete->Recordset);

	// Render row
	$t_kategori_delete->renderRow();
?>
	<tr <?php echo $t_kategori->rowAttributes() ?>>
<?php if ($t_kategori_delete->kdkategori->Visible) { // kdkategori ?>
		<td <?php echo $t_kategori_delete->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $t_kategori_delete->RowCount ?>_t_kategori_kdkategori" class="t_kategori_kdkategori">
<span<?php echo $t_kategori_delete->kdkategori->viewAttributes() ?>><?php echo $t_kategori_delete->kdkategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_kategori_delete->kategori->Visible) { // kategori ?>
		<td <?php echo $t_kategori_delete->kategori->cellAttributes() ?>>
<span id="el<?php echo $t_kategori_delete->RowCount ?>_t_kategori_kategori" class="t_kategori_kategori">
<span<?php echo $t_kategori_delete->kategori->viewAttributes() ?>><?php echo $t_kategori_delete->kategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_kategori_delete->Recordset->moveNext();
}
$t_kategori_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_kategori_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_kategori_delete->showPageFooter();
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
$t_kategori_delete->terminate();
?>