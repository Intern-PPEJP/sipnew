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
$t_perusahaan_delete = new t_perusahaan_delete();

// Run the page
$t_perusahaan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_perusahaan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_perusahaandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_perusahaandelete = currentForm = new ew.Form("ft_perusahaandelete", "delete");
	loadjs.done("ft_perusahaandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_perusahaan_delete->showPageHeader(); ?>
<?php
$t_perusahaan_delete->showMessage();
?>
<form name="ft_perusahaandelete" id="ft_perusahaandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_perusahaan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_perusahaan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_perusahaan_delete->namap->Visible) { // namap ?>
		<th class="<?php echo $t_perusahaan_delete->namap->headerCellClass() ?>"><span id="elh_t_perusahaan_namap" class="t_perusahaan_namap"><?php echo $t_perusahaan_delete->namap->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->idp->Visible) { // idp ?>
		<th class="<?php echo $t_perusahaan_delete->idp->headerCellClass() ?>"><span id="elh_t_perusahaan_idp" class="t_perusahaan_idp"><?php echo $t_perusahaan_delete->idp->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kontak->Visible) { // kontak ?>
		<th class="<?php echo $t_perusahaan_delete->kontak->headerCellClass() ?>"><span id="elh_t_perusahaan_kontak" class="t_perusahaan_kontak"><?php echo $t_perusahaan_delete->kontak->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdlokasi->Visible) { // kdlokasi ?>
		<th class="<?php echo $t_perusahaan_delete->kdlokasi->headerCellClass() ?>"><span id="elh_t_perusahaan_kdlokasi" class="t_perusahaan_kdlokasi"><?php echo $t_perusahaan_delete->kdlokasi->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdprop->Visible) { // kdprop ?>
		<th class="<?php echo $t_perusahaan_delete->kdprop->headerCellClass() ?>"><span id="elh_t_perusahaan_kdprop" class="t_perusahaan_kdprop"><?php echo $t_perusahaan_delete->kdprop->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdkota->Visible) { // kdkota ?>
		<th class="<?php echo $t_perusahaan_delete->kdkota->headerCellClass() ?>"><span id="elh_t_perusahaan_kdkota" class="t_perusahaan_kdkota"><?php echo $t_perusahaan_delete->kdkota->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdkec->Visible) { // kdkec ?>
		<th class="<?php echo $t_perusahaan_delete->kdkec->headerCellClass() ?>"><span id="elh_t_perusahaan_kdkec" class="t_perusahaan_kdkec"><?php echo $t_perusahaan_delete->kdkec->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->alamatp->Visible) { // alamatp ?>
		<th class="<?php echo $t_perusahaan_delete->alamatp->headerCellClass() ?>"><span id="elh_t_perusahaan_alamatp" class="t_perusahaan_alamatp"><?php echo $t_perusahaan_delete->alamatp->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->telpp->Visible) { // telpp ?>
		<th class="<?php echo $t_perusahaan_delete->telpp->headerCellClass() ?>"><span id="elh_t_perusahaan_telpp" class="t_perusahaan_telpp"><?php echo $t_perusahaan_delete->telpp->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->faxp->Visible) { // faxp ?>
		<th class="<?php echo $t_perusahaan_delete->faxp->headerCellClass() ?>"><span id="elh_t_perusahaan_faxp" class="t_perusahaan_faxp"><?php echo $t_perusahaan_delete->faxp->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->emailp->Visible) { // emailp ?>
		<th class="<?php echo $t_perusahaan_delete->emailp->headerCellClass() ?>"><span id="elh_t_perusahaan_emailp" class="t_perusahaan_emailp"><?php echo $t_perusahaan_delete->emailp->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->webp->Visible) { // webp ?>
		<th class="<?php echo $t_perusahaan_delete->webp->headerCellClass() ?>"><span id="elh_t_perusahaan_webp" class="t_perusahaan_webp"><?php echo $t_perusahaan_delete->webp->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->medsos->Visible) { // medsos ?>
		<th class="<?php echo $t_perusahaan_delete->medsos->headerCellClass() ?>"><span id="elh_t_perusahaan_medsos" class="t_perusahaan_medsos"><?php echo $t_perusahaan_delete->medsos->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdjenis->Visible) { // kdjenis ?>
		<th class="<?php echo $t_perusahaan_delete->kdjenis->headerCellClass() ?>"><span id="elh_t_perusahaan_kdjenis" class="t_perusahaan_kdjenis"><?php echo $t_perusahaan_delete->kdjenis->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdproduknafed->Visible) { // kdproduknafed ?>
		<th class="<?php echo $t_perusahaan_delete->kdproduknafed->headerCellClass() ?>"><span id="elh_t_perusahaan_kdproduknafed" class="t_perusahaan_kdproduknafed"><?php echo $t_perusahaan_delete->kdproduknafed->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdproduknafed2->Visible) { // kdproduknafed2 ?>
		<th class="<?php echo $t_perusahaan_delete->kdproduknafed2->headerCellClass() ?>"><span id="elh_t_perusahaan_kdproduknafed2" class="t_perusahaan_kdproduknafed2"><?php echo $t_perusahaan_delete->kdproduknafed2->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdproduknafed3->Visible) { // kdproduknafed3 ?>
		<th class="<?php echo $t_perusahaan_delete->kdproduknafed3->headerCellClass() ?>"><span id="elh_t_perusahaan_kdproduknafed3" class="t_perusahaan_kdproduknafed3"><?php echo $t_perusahaan_delete->kdproduknafed3->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->pproduk->Visible) { // pproduk ?>
		<th class="<?php echo $t_perusahaan_delete->pproduk->headerCellClass() ?>"><span id="elh_t_perusahaan_pproduk" class="t_perusahaan_pproduk"><?php echo $t_perusahaan_delete->pproduk->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdexport->Visible) { // kdexport ?>
		<th class="<?php echo $t_perusahaan_delete->kdexport->headerCellClass() ?>"><span id="elh_t_perusahaan_kdexport" class="t_perusahaan_kdexport"><?php echo $t_perusahaan_delete->kdexport->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->nexport->Visible) { // nexport ?>
		<th class="<?php echo $t_perusahaan_delete->nexport->headerCellClass() ?>"><span id="elh_t_perusahaan_nexport" class="t_perusahaan_nexport"><?php echo $t_perusahaan_delete->nexport->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdskala->Visible) { // kdskala ?>
		<th class="<?php echo $t_perusahaan_delete->kdskala->headerCellClass() ?>"><span id="elh_t_perusahaan_kdskala" class="t_perusahaan_kdskala"><?php echo $t_perusahaan_delete->kdskala->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->kdkategori->Visible) { // kdkategori ?>
		<th class="<?php echo $t_perusahaan_delete->kdkategori->headerCellClass() ?>"><span id="elh_t_perusahaan_kdkategori" class="t_perusahaan_kdkategori"><?php echo $t_perusahaan_delete->kdkategori->caption() ?></span></th>
<?php } ?>
<?php if ($t_perusahaan_delete->jpeserta->Visible) { // jpeserta ?>
		<th class="<?php echo $t_perusahaan_delete->jpeserta->headerCellClass() ?>"><span id="elh_t_perusahaan_jpeserta" class="t_perusahaan_jpeserta"><?php echo $t_perusahaan_delete->jpeserta->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_perusahaan_delete->RecordCount = 0;
$i = 0;
while (!$t_perusahaan_delete->Recordset->EOF) {
	$t_perusahaan_delete->RecordCount++;
	$t_perusahaan_delete->RowCount++;

	// Set row properties
	$t_perusahaan->resetAttributes();
	$t_perusahaan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_perusahaan_delete->loadRowValues($t_perusahaan_delete->Recordset);

	// Render row
	$t_perusahaan_delete->renderRow();
?>
	<tr <?php echo $t_perusahaan->rowAttributes() ?>>
<?php if ($t_perusahaan_delete->namap->Visible) { // namap ?>
		<td <?php echo $t_perusahaan_delete->namap->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_namap" class="t_perusahaan_namap">
<span<?php echo $t_perusahaan_delete->namap->viewAttributes() ?>><?php echo $t_perusahaan_delete->namap->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->idp->Visible) { // idp ?>
		<td <?php echo $t_perusahaan_delete->idp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_idp" class="t_perusahaan_idp">
<span<?php echo $t_perusahaan_delete->idp->viewAttributes() ?>><?php echo $t_perusahaan_delete->idp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kontak->Visible) { // kontak ?>
		<td <?php echo $t_perusahaan_delete->kontak->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kontak" class="t_perusahaan_kontak">
<span<?php echo $t_perusahaan_delete->kontak->viewAttributes() ?>><?php echo $t_perusahaan_delete->kontak->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdlokasi->Visible) { // kdlokasi ?>
		<td <?php echo $t_perusahaan_delete->kdlokasi->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdlokasi" class="t_perusahaan_kdlokasi">
<span<?php echo $t_perusahaan_delete->kdlokasi->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdlokasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdprop->Visible) { // kdprop ?>
		<td <?php echo $t_perusahaan_delete->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdprop" class="t_perusahaan_kdprop">
<span<?php echo $t_perusahaan_delete->kdprop->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdprop->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdkota->Visible) { // kdkota ?>
		<td <?php echo $t_perusahaan_delete->kdkota->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdkota" class="t_perusahaan_kdkota">
<span<?php echo $t_perusahaan_delete->kdkota->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdkota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdkec->Visible) { // kdkec ?>
		<td <?php echo $t_perusahaan_delete->kdkec->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdkec" class="t_perusahaan_kdkec">
<span<?php echo $t_perusahaan_delete->kdkec->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdkec->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->alamatp->Visible) { // alamatp ?>
		<td <?php echo $t_perusahaan_delete->alamatp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_alamatp" class="t_perusahaan_alamatp">
<span<?php echo $t_perusahaan_delete->alamatp->viewAttributes() ?>><?php echo $t_perusahaan_delete->alamatp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->telpp->Visible) { // telpp ?>
		<td <?php echo $t_perusahaan_delete->telpp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_telpp" class="t_perusahaan_telpp">
<span<?php echo $t_perusahaan_delete->telpp->viewAttributes() ?>><?php echo $t_perusahaan_delete->telpp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->faxp->Visible) { // faxp ?>
		<td <?php echo $t_perusahaan_delete->faxp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_faxp" class="t_perusahaan_faxp">
<span<?php echo $t_perusahaan_delete->faxp->viewAttributes() ?>><?php echo $t_perusahaan_delete->faxp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->emailp->Visible) { // emailp ?>
		<td <?php echo $t_perusahaan_delete->emailp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_emailp" class="t_perusahaan_emailp">
<span<?php echo $t_perusahaan_delete->emailp->viewAttributes() ?>><?php echo $t_perusahaan_delete->emailp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->webp->Visible) { // webp ?>
		<td <?php echo $t_perusahaan_delete->webp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_webp" class="t_perusahaan_webp">
<span<?php echo $t_perusahaan_delete->webp->viewAttributes() ?>><?php echo $t_perusahaan_delete->webp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->medsos->Visible) { // medsos ?>
		<td <?php echo $t_perusahaan_delete->medsos->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_medsos" class="t_perusahaan_medsos">
<span<?php echo $t_perusahaan_delete->medsos->viewAttributes() ?>><?php echo $t_perusahaan_delete->medsos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdjenis->Visible) { // kdjenis ?>
		<td <?php echo $t_perusahaan_delete->kdjenis->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdjenis" class="t_perusahaan_kdjenis">
<span<?php echo $t_perusahaan_delete->kdjenis->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdjenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdproduknafed->Visible) { // kdproduknafed ?>
		<td <?php echo $t_perusahaan_delete->kdproduknafed->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdproduknafed" class="t_perusahaan_kdproduknafed">
<span<?php echo $t_perusahaan_delete->kdproduknafed->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdproduknafed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdproduknafed2->Visible) { // kdproduknafed2 ?>
		<td <?php echo $t_perusahaan_delete->kdproduknafed2->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdproduknafed2" class="t_perusahaan_kdproduknafed2">
<span<?php echo $t_perusahaan_delete->kdproduknafed2->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdproduknafed2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdproduknafed3->Visible) { // kdproduknafed3 ?>
		<td <?php echo $t_perusahaan_delete->kdproduknafed3->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdproduknafed3" class="t_perusahaan_kdproduknafed3">
<span<?php echo $t_perusahaan_delete->kdproduknafed3->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdproduknafed3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->pproduk->Visible) { // pproduk ?>
		<td <?php echo $t_perusahaan_delete->pproduk->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_pproduk" class="t_perusahaan_pproduk">
<span<?php echo $t_perusahaan_delete->pproduk->viewAttributes() ?>><?php echo $t_perusahaan_delete->pproduk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdexport->Visible) { // kdexport ?>
		<td <?php echo $t_perusahaan_delete->kdexport->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdexport" class="t_perusahaan_kdexport">
<span<?php echo $t_perusahaan_delete->kdexport->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdexport->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->nexport->Visible) { // nexport ?>
		<td <?php echo $t_perusahaan_delete->nexport->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_nexport" class="t_perusahaan_nexport">
<span<?php echo $t_perusahaan_delete->nexport->viewAttributes() ?>><?php echo $t_perusahaan_delete->nexport->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdskala->Visible) { // kdskala ?>
		<td <?php echo $t_perusahaan_delete->kdskala->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdskala" class="t_perusahaan_kdskala">
<span<?php echo $t_perusahaan_delete->kdskala->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdskala->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->kdkategori->Visible) { // kdkategori ?>
		<td <?php echo $t_perusahaan_delete->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_kdkategori" class="t_perusahaan_kdkategori">
<span<?php echo $t_perusahaan_delete->kdkategori->viewAttributes() ?>><?php echo $t_perusahaan_delete->kdkategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_perusahaan_delete->jpeserta->Visible) { // jpeserta ?>
		<td <?php echo $t_perusahaan_delete->jpeserta->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_delete->RowCount ?>_t_perusahaan_jpeserta" class="t_perusahaan_jpeserta">
<span<?php echo $t_perusahaan_delete->jpeserta->viewAttributes() ?>><?php echo $t_perusahaan_delete->jpeserta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_perusahaan_delete->Recordset->moveNext();
}
$t_perusahaan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_perusahaan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_perusahaan_delete->showPageFooter();
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
$t_perusahaan_delete->terminate();
?>