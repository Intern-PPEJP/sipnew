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
$t_coachingtahapan_delete = new t_coachingtahapan_delete();

// Run the page
$t_coachingtahapan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coachingtahapan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_coachingtahapandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_coachingtahapandelete = currentForm = new ew.Form("ft_coachingtahapandelete", "delete");
	loadjs.done("ft_coachingtahapandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_coachingtahapan_delete->showPageHeader(); ?>
<?php
$t_coachingtahapan_delete->showMessage();
?>
<form name="ft_coachingtahapandelete" id="ft_coachingtahapandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_coachingtahapan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_coachingtahapan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_coachingtahapan_delete->area->Visible) { // area ?>
		<th class="<?php echo $t_coachingtahapan_delete->area->headerCellClass() ?>"><span id="elh_t_coachingtahapan_area" class="t_coachingtahapan_area"><?php echo $t_coachingtahapan_delete->area->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->jenispel->Visible) { // jenispel ?>
		<th class="<?php echo $t_coachingtahapan_delete->jenispel->headerCellClass() ?>"><span id="elh_t_coachingtahapan_jenispel" class="t_coachingtahapan_jenispel"><?php echo $t_coachingtahapan_delete->jenispel->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->kdkategori->Visible) { // kdkategori ?>
		<th class="<?php echo $t_coachingtahapan_delete->kdkategori->headerCellClass() ?>"><span id="elh_t_coachingtahapan_kdkategori" class="t_coachingtahapan_kdkategori"><?php echo $t_coachingtahapan_delete->kdkategori->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->kerjasama->Visible) { // kerjasama ?>
		<th class="<?php echo $t_coachingtahapan_delete->kerjasama->headerCellClass() ?>"><span id="elh_t_coachingtahapan_kerjasama" class="t_coachingtahapan_kerjasama"><?php echo $t_coachingtahapan_delete->kerjasama->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak1->Visible) { // tglpelak1 ?>
		<th class="<?php echo $t_coachingtahapan_delete->tglpelak1->headerCellClass() ?>"><span id="elh_t_coachingtahapan_tglpelak1" class="t_coachingtahapan_tglpelak1"><?php echo $t_coachingtahapan_delete->tglpelak1->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes1->Visible) { // targetpes1 ?>
		<th class="<?php echo $t_coachingtahapan_delete->targetpes1->headerCellClass() ?>"><span id="elh_t_coachingtahapan_targetpes1" class="t_coachingtahapan_targetpes1"><?php echo $t_coachingtahapan_delete->targetpes1->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak2->Visible) { // tglpelak2 ?>
		<th class="<?php echo $t_coachingtahapan_delete->tglpelak2->headerCellClass() ?>"><span id="elh_t_coachingtahapan_tglpelak2" class="t_coachingtahapan_tglpelak2"><?php echo $t_coachingtahapan_delete->tglpelak2->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes2->Visible) { // targetpes2 ?>
		<th class="<?php echo $t_coachingtahapan_delete->targetpes2->headerCellClass() ?>"><span id="elh_t_coachingtahapan_targetpes2" class="t_coachingtahapan_targetpes2"><?php echo $t_coachingtahapan_delete->targetpes2->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak3->Visible) { // tglpelak3 ?>
		<th class="<?php echo $t_coachingtahapan_delete->tglpelak3->headerCellClass() ?>"><span id="elh_t_coachingtahapan_tglpelak3" class="t_coachingtahapan_tglpelak3"><?php echo $t_coachingtahapan_delete->tglpelak3->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes3->Visible) { // targetpes3 ?>
		<th class="<?php echo $t_coachingtahapan_delete->targetpes3->headerCellClass() ?>"><span id="elh_t_coachingtahapan_targetpes3" class="t_coachingtahapan_targetpes3"><?php echo $t_coachingtahapan_delete->targetpes3->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak4->Visible) { // tglpelak4 ?>
		<th class="<?php echo $t_coachingtahapan_delete->tglpelak4->headerCellClass() ?>"><span id="elh_t_coachingtahapan_tglpelak4" class="t_coachingtahapan_tglpelak4"><?php echo $t_coachingtahapan_delete->tglpelak4->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes4->Visible) { // targetpes4 ?>
		<th class="<?php echo $t_coachingtahapan_delete->targetpes4->headerCellClass() ?>"><span id="elh_t_coachingtahapan_targetpes4" class="t_coachingtahapan_targetpes4"><?php echo $t_coachingtahapan_delete->targetpes4->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak5->Visible) { // tglpelak5 ?>
		<th class="<?php echo $t_coachingtahapan_delete->tglpelak5->headerCellClass() ?>"><span id="elh_t_coachingtahapan_tglpelak5" class="t_coachingtahapan_tglpelak5"><?php echo $t_coachingtahapan_delete->tglpelak5->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes5->Visible) { // targetpes5 ?>
		<th class="<?php echo $t_coachingtahapan_delete->targetpes5->headerCellClass() ?>"><span id="elh_t_coachingtahapan_targetpes5" class="t_coachingtahapan_targetpes5"><?php echo $t_coachingtahapan_delete->targetpes5->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak6->Visible) { // tglpelak6 ?>
		<th class="<?php echo $t_coachingtahapan_delete->tglpelak6->headerCellClass() ?>"><span id="elh_t_coachingtahapan_tglpelak6" class="t_coachingtahapan_tglpelak6"><?php echo $t_coachingtahapan_delete->tglpelak6->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes6->Visible) { // targetpes6 ?>
		<th class="<?php echo $t_coachingtahapan_delete->targetpes6->headerCellClass() ?>"><span id="elh_t_coachingtahapan_targetpes6" class="t_coachingtahapan_targetpes6"><?php echo $t_coachingtahapan_delete->targetpes6->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak7->Visible) { // tglpelak7 ?>
		<th class="<?php echo $t_coachingtahapan_delete->tglpelak7->headerCellClass() ?>"><span id="elh_t_coachingtahapan_tglpelak7" class="t_coachingtahapan_tglpelak7"><?php echo $t_coachingtahapan_delete->tglpelak7->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes7->Visible) { // targetpes7 ?>
		<th class="<?php echo $t_coachingtahapan_delete->targetpes7->headerCellClass() ?>"><span id="elh_t_coachingtahapan_targetpes7" class="t_coachingtahapan_targetpes7"><?php echo $t_coachingtahapan_delete->targetpes7->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak8->Visible) { // tglpelak8 ?>
		<th class="<?php echo $t_coachingtahapan_delete->tglpelak8->headerCellClass() ?>"><span id="elh_t_coachingtahapan_tglpelak8" class="t_coachingtahapan_tglpelak8"><?php echo $t_coachingtahapan_delete->tglpelak8->caption() ?></span></th>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes8->Visible) { // targetpes8 ?>
		<th class="<?php echo $t_coachingtahapan_delete->targetpes8->headerCellClass() ?>"><span id="elh_t_coachingtahapan_targetpes8" class="t_coachingtahapan_targetpes8"><?php echo $t_coachingtahapan_delete->targetpes8->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_coachingtahapan_delete->RecordCount = 0;
$i = 0;
while (!$t_coachingtahapan_delete->Recordset->EOF) {
	$t_coachingtahapan_delete->RecordCount++;
	$t_coachingtahapan_delete->RowCount++;

	// Set row properties
	$t_coachingtahapan->resetAttributes();
	$t_coachingtahapan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_coachingtahapan_delete->loadRowValues($t_coachingtahapan_delete->Recordset);

	// Render row
	$t_coachingtahapan_delete->renderRow();
?>
	<tr <?php echo $t_coachingtahapan->rowAttributes() ?>>
<?php if ($t_coachingtahapan_delete->area->Visible) { // area ?>
		<td <?php echo $t_coachingtahapan_delete->area->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_area" class="t_coachingtahapan_area">
<span<?php echo $t_coachingtahapan_delete->area->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->jenispel->Visible) { // jenispel ?>
		<td <?php echo $t_coachingtahapan_delete->jenispel->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_jenispel" class="t_coachingtahapan_jenispel">
<span<?php echo $t_coachingtahapan_delete->jenispel->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->jenispel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->kdkategori->Visible) { // kdkategori ?>
		<td <?php echo $t_coachingtahapan_delete->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_kdkategori" class="t_coachingtahapan_kdkategori">
<span<?php echo $t_coachingtahapan_delete->kdkategori->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->kdkategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->kerjasama->Visible) { // kerjasama ?>
		<td <?php echo $t_coachingtahapan_delete->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_kerjasama" class="t_coachingtahapan_kerjasama">
<span<?php echo $t_coachingtahapan_delete->kerjasama->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->kerjasama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak1->Visible) { // tglpelak1 ?>
		<td <?php echo $t_coachingtahapan_delete->tglpelak1->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_tglpelak1" class="t_coachingtahapan_tglpelak1">
<span<?php echo $t_coachingtahapan_delete->tglpelak1->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->tglpelak1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes1->Visible) { // targetpes1 ?>
		<td <?php echo $t_coachingtahapan_delete->targetpes1->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_targetpes1" class="t_coachingtahapan_targetpes1">
<span<?php echo $t_coachingtahapan_delete->targetpes1->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->targetpes1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak2->Visible) { // tglpelak2 ?>
		<td <?php echo $t_coachingtahapan_delete->tglpelak2->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_tglpelak2" class="t_coachingtahapan_tglpelak2">
<span<?php echo $t_coachingtahapan_delete->tglpelak2->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->tglpelak2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes2->Visible) { // targetpes2 ?>
		<td <?php echo $t_coachingtahapan_delete->targetpes2->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_targetpes2" class="t_coachingtahapan_targetpes2">
<span<?php echo $t_coachingtahapan_delete->targetpes2->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->targetpes2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak3->Visible) { // tglpelak3 ?>
		<td <?php echo $t_coachingtahapan_delete->tglpelak3->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_tglpelak3" class="t_coachingtahapan_tglpelak3">
<span<?php echo $t_coachingtahapan_delete->tglpelak3->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->tglpelak3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes3->Visible) { // targetpes3 ?>
		<td <?php echo $t_coachingtahapan_delete->targetpes3->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_targetpes3" class="t_coachingtahapan_targetpes3">
<span<?php echo $t_coachingtahapan_delete->targetpes3->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->targetpes3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak4->Visible) { // tglpelak4 ?>
		<td <?php echo $t_coachingtahapan_delete->tglpelak4->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_tglpelak4" class="t_coachingtahapan_tglpelak4">
<span<?php echo $t_coachingtahapan_delete->tglpelak4->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->tglpelak4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes4->Visible) { // targetpes4 ?>
		<td <?php echo $t_coachingtahapan_delete->targetpes4->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_targetpes4" class="t_coachingtahapan_targetpes4">
<span<?php echo $t_coachingtahapan_delete->targetpes4->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->targetpes4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak5->Visible) { // tglpelak5 ?>
		<td <?php echo $t_coachingtahapan_delete->tglpelak5->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_tglpelak5" class="t_coachingtahapan_tglpelak5">
<span<?php echo $t_coachingtahapan_delete->tglpelak5->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->tglpelak5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes5->Visible) { // targetpes5 ?>
		<td <?php echo $t_coachingtahapan_delete->targetpes5->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_targetpes5" class="t_coachingtahapan_targetpes5">
<span<?php echo $t_coachingtahapan_delete->targetpes5->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->targetpes5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak6->Visible) { // tglpelak6 ?>
		<td <?php echo $t_coachingtahapan_delete->tglpelak6->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_tglpelak6" class="t_coachingtahapan_tglpelak6">
<span<?php echo $t_coachingtahapan_delete->tglpelak6->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->tglpelak6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes6->Visible) { // targetpes6 ?>
		<td <?php echo $t_coachingtahapan_delete->targetpes6->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_targetpes6" class="t_coachingtahapan_targetpes6">
<span<?php echo $t_coachingtahapan_delete->targetpes6->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->targetpes6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak7->Visible) { // tglpelak7 ?>
		<td <?php echo $t_coachingtahapan_delete->tglpelak7->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_tglpelak7" class="t_coachingtahapan_tglpelak7">
<span<?php echo $t_coachingtahapan_delete->tglpelak7->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->tglpelak7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes7->Visible) { // targetpes7 ?>
		<td <?php echo $t_coachingtahapan_delete->targetpes7->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_targetpes7" class="t_coachingtahapan_targetpes7">
<span<?php echo $t_coachingtahapan_delete->targetpes7->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->targetpes7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->tglpelak8->Visible) { // tglpelak8 ?>
		<td <?php echo $t_coachingtahapan_delete->tglpelak8->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_tglpelak8" class="t_coachingtahapan_tglpelak8">
<span<?php echo $t_coachingtahapan_delete->tglpelak8->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->tglpelak8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_coachingtahapan_delete->targetpes8->Visible) { // targetpes8 ?>
		<td <?php echo $t_coachingtahapan_delete->targetpes8->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_delete->RowCount ?>_t_coachingtahapan_targetpes8" class="t_coachingtahapan_targetpes8">
<span<?php echo $t_coachingtahapan_delete->targetpes8->viewAttributes() ?>><?php echo $t_coachingtahapan_delete->targetpes8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_coachingtahapan_delete->Recordset->moveNext();
}
$t_coachingtahapan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_coachingtahapan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_coachingtahapan_delete->showPageFooter();
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
$t_coachingtahapan_delete->terminate();
?>