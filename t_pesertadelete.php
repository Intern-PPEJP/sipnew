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
$t_peserta_delete = new t_peserta_delete();

// Run the page
$t_peserta_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_peserta_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pesertadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_pesertadelete = currentForm = new ew.Form("ft_pesertadelete", "delete");
	loadjs.done("ft_pesertadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_peserta_delete->showPageHeader(); ?>
<?php
$t_peserta_delete->showMessage();
?>
<form name="ft_pesertadelete" id="ft_pesertadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_peserta">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_peserta_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_peserta_delete->id->Visible) { // id ?>
		<th class="<?php echo $t_peserta_delete->id->headerCellClass() ?>"><span id="elh_t_peserta_id" class="t_peserta_id"><?php echo $t_peserta_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $t_peserta_delete->nama->headerCellClass() ?>"><span id="elh_t_peserta_nama" class="t_peserta_nama"><?php echo $t_peserta_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->idp->Visible) { // idp ?>
		<th class="<?php echo $t_peserta_delete->idp->headerCellClass() ?>"><span id="elh_t_peserta_idp" class="t_peserta_idp"><?php echo $t_peserta_delete->idp->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->tempat->Visible) { // tempat ?>
		<th class="<?php echo $t_peserta_delete->tempat->headerCellClass() ?>"><span id="elh_t_peserta_tempat" class="t_peserta_tempat"><?php echo $t_peserta_delete->tempat->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->kdagama->Visible) { // kdagama ?>
		<th class="<?php echo $t_peserta_delete->kdagama->headerCellClass() ?>"><span id="elh_t_peserta_kdagama" class="t_peserta_kdagama"><?php echo $t_peserta_delete->kdagama->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->kdsex->Visible) { // kdsex ?>
		<th class="<?php echo $t_peserta_delete->kdsex->headerCellClass() ?>"><span id="elh_t_peserta_kdsex" class="t_peserta_kdsex"><?php echo $t_peserta_delete->kdsex->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->kdprop->Visible) { // kdprop ?>
		<th class="<?php echo $t_peserta_delete->kdprop->headerCellClass() ?>"><span id="elh_t_peserta_kdprop" class="t_peserta_kdprop"><?php echo $t_peserta_delete->kdprop->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->kdkota->Visible) { // kdkota ?>
		<th class="<?php echo $t_peserta_delete->kdkota->headerCellClass() ?>"><span id="elh_t_peserta_kdkota" class="t_peserta_kdkota"><?php echo $t_peserta_delete->kdkota->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->kdkec->Visible) { // kdkec ?>
		<th class="<?php echo $t_peserta_delete->kdkec->headerCellClass() ?>"><span id="elh_t_peserta_kdkec" class="t_peserta_kdkec"><?php echo $t_peserta_delete->kdkec->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->alamat->Visible) { // alamat ?>
		<th class="<?php echo $t_peserta_delete->alamat->headerCellClass() ?>"><span id="elh_t_peserta_alamat" class="t_peserta_alamat"><?php echo $t_peserta_delete->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->telp->Visible) { // telp ?>
		<th class="<?php echo $t_peserta_delete->telp->headerCellClass() ?>"><span id="elh_t_peserta_telp" class="t_peserta_telp"><?php echo $t_peserta_delete->telp->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->hp->Visible) { // hp ?>
		<th class="<?php echo $t_peserta_delete->hp->headerCellClass() ?>"><span id="elh_t_peserta_hp" class="t_peserta_hp"><?php echo $t_peserta_delete->hp->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->kdjabat->Visible) { // kdjabat ?>
		<th class="<?php echo $t_peserta_delete->kdjabat->headerCellClass() ?>"><span id="elh_t_peserta_kdjabat" class="t_peserta_kdjabat"><?php echo $t_peserta_delete->kdjabat->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->kdpend->Visible) { // kdpend ?>
		<th class="<?php echo $t_peserta_delete->kdpend->headerCellClass() ?>"><span id="elh_t_peserta_kdpend" class="t_peserta_kdpend"><?php echo $t_peserta_delete->kdpend->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->kdbahasa->Visible) { // kdbahasa ?>
		<th class="<?php echo $t_peserta_delete->kdbahasa->headerCellClass() ?>"><span id="elh_t_peserta_kdbahasa" class="t_peserta_kdbahasa"><?php echo $t_peserta_delete->kdbahasa->caption() ?></span></th>
<?php } ?>
<?php if ($t_peserta_delete->jpelatihan->Visible) { // jpelatihan ?>
		<th class="<?php echo $t_peserta_delete->jpelatihan->headerCellClass() ?>"><span id="elh_t_peserta_jpelatihan" class="t_peserta_jpelatihan"><?php echo $t_peserta_delete->jpelatihan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_peserta_delete->RecordCount = 0;
$i = 0;
while (!$t_peserta_delete->Recordset->EOF) {
	$t_peserta_delete->RecordCount++;
	$t_peserta_delete->RowCount++;

	// Set row properties
	$t_peserta->resetAttributes();
	$t_peserta->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_peserta_delete->loadRowValues($t_peserta_delete->Recordset);

	// Render row
	$t_peserta_delete->renderRow();
?>
	<tr <?php echo $t_peserta->rowAttributes() ?>>
<?php if ($t_peserta_delete->id->Visible) { // id ?>
		<td <?php echo $t_peserta_delete->id->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_id" class="t_peserta_id">
<span<?php echo $t_peserta_delete->id->viewAttributes() ?>><?php echo $t_peserta_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->nama->Visible) { // nama ?>
		<td <?php echo $t_peserta_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_nama" class="t_peserta_nama">
<span<?php echo $t_peserta_delete->nama->viewAttributes() ?>><?php echo $t_peserta_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->idp->Visible) { // idp ?>
		<td <?php echo $t_peserta_delete->idp->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_idp" class="t_peserta_idp">
<span<?php echo $t_peserta_delete->idp->viewAttributes() ?>><?php echo $t_peserta_delete->idp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->tempat->Visible) { // tempat ?>
		<td <?php echo $t_peserta_delete->tempat->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_tempat" class="t_peserta_tempat">
<span<?php echo $t_peserta_delete->tempat->viewAttributes() ?>><?php echo $t_peserta_delete->tempat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->kdagama->Visible) { // kdagama ?>
		<td <?php echo $t_peserta_delete->kdagama->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_kdagama" class="t_peserta_kdagama">
<span<?php echo $t_peserta_delete->kdagama->viewAttributes() ?>><?php echo $t_peserta_delete->kdagama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->kdsex->Visible) { // kdsex ?>
		<td <?php echo $t_peserta_delete->kdsex->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_kdsex" class="t_peserta_kdsex">
<span<?php echo $t_peserta_delete->kdsex->viewAttributes() ?>><?php echo $t_peserta_delete->kdsex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->kdprop->Visible) { // kdprop ?>
		<td <?php echo $t_peserta_delete->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_kdprop" class="t_peserta_kdprop">
<span<?php echo $t_peserta_delete->kdprop->viewAttributes() ?>><?php echo $t_peserta_delete->kdprop->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->kdkota->Visible) { // kdkota ?>
		<td <?php echo $t_peserta_delete->kdkota->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_kdkota" class="t_peserta_kdkota">
<span<?php echo $t_peserta_delete->kdkota->viewAttributes() ?>><?php echo $t_peserta_delete->kdkota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->kdkec->Visible) { // kdkec ?>
		<td <?php echo $t_peserta_delete->kdkec->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_kdkec" class="t_peserta_kdkec">
<span<?php echo $t_peserta_delete->kdkec->viewAttributes() ?>><?php echo $t_peserta_delete->kdkec->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->alamat->Visible) { // alamat ?>
		<td <?php echo $t_peserta_delete->alamat->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_alamat" class="t_peserta_alamat">
<span<?php echo $t_peserta_delete->alamat->viewAttributes() ?>><?php echo $t_peserta_delete->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->telp->Visible) { // telp ?>
		<td <?php echo $t_peserta_delete->telp->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_telp" class="t_peserta_telp">
<span<?php echo $t_peserta_delete->telp->viewAttributes() ?>><?php echo $t_peserta_delete->telp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->hp->Visible) { // hp ?>
		<td <?php echo $t_peserta_delete->hp->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_hp" class="t_peserta_hp">
<span<?php echo $t_peserta_delete->hp->viewAttributes() ?>><?php echo $t_peserta_delete->hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->kdjabat->Visible) { // kdjabat ?>
		<td <?php echo $t_peserta_delete->kdjabat->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_kdjabat" class="t_peserta_kdjabat">
<span<?php echo $t_peserta_delete->kdjabat->viewAttributes() ?>><?php echo $t_peserta_delete->kdjabat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->kdpend->Visible) { // kdpend ?>
		<td <?php echo $t_peserta_delete->kdpend->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_kdpend" class="t_peserta_kdpend">
<span<?php echo $t_peserta_delete->kdpend->viewAttributes() ?>><?php echo $t_peserta_delete->kdpend->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->kdbahasa->Visible) { // kdbahasa ?>
		<td <?php echo $t_peserta_delete->kdbahasa->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_kdbahasa" class="t_peserta_kdbahasa">
<span<?php echo $t_peserta_delete->kdbahasa->viewAttributes() ?>><?php echo $t_peserta_delete->kdbahasa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_peserta_delete->jpelatihan->Visible) { // jpelatihan ?>
		<td <?php echo $t_peserta_delete->jpelatihan->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_delete->RowCount ?>_t_peserta_jpelatihan" class="t_peserta_jpelatihan">
<span<?php echo $t_peserta_delete->jpelatihan->viewAttributes() ?>><?php echo $t_peserta_delete->jpelatihan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_peserta_delete->Recordset->moveNext();
}
$t_peserta_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_peserta_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_peserta_delete->showPageFooter();
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
$t_peserta_delete->terminate();
?>