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
$cv_historiinstruktur_list = new cv_historiinstruktur_list();

// Run the page
$cv_historiinstruktur_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historiinstruktur_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cv_historiinstruktur_list->isExport()) { ?>
<script>
var fcv_historiinstrukturlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcv_historiinstrukturlist = currentForm = new ew.Form("fcv_historiinstrukturlist", "list");
	fcv_historiinstrukturlist.formKeyCountName = '<?php echo $cv_historiinstruktur_list->FormKeyCountName ?>';
	loadjs.done("fcv_historiinstrukturlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cv_historiinstruktur_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cv_historiinstruktur_list->TotalRecords > 0 && $cv_historiinstruktur_list->ExportOptions->visible()) { ?>
<?php $cv_historiinstruktur_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_historiinstruktur_list->ImportOptions->visible()) { ?>
<?php $cv_historiinstruktur_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$cv_historiinstruktur_list->isExport() || Config("EXPORT_MASTER_RECORD") && $cv_historiinstruktur_list->isExport("print")) { ?>
<?php
if ($cv_historiinstruktur_list->DbMasterFilter != "" && $cv_historiinstruktur->getCurrentMasterTable() == "t_pelatihan") {
	if ($cv_historiinstruktur_list->MasterRecordExists) {
		include_once "t_pelatihanmaster.php";
	}
}
?>
<?php } ?>
<?php
$cv_historiinstruktur_list->renderOtherOptions();
?>
<?php $cv_historiinstruktur_list->showPageHeader(); ?>
<?php
$cv_historiinstruktur_list->showMessage();
?>
<?php if ($cv_historiinstruktur_list->TotalRecords > 0 || $cv_historiinstruktur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_historiinstruktur_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_historiinstruktur">
<?php if (!$cv_historiinstruktur_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cv_historiinstruktur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_historiinstruktur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_historiinstruktur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcv_historiinstrukturlist" id="fcv_historiinstrukturlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historiinstruktur">
<?php if ($cv_historiinstruktur->getCurrentMasterTable() == "t_pelatihan" && $cv_historiinstruktur->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pelatihan">
<input type="hidden" name="fk_kdpelat" value="<?php echo HtmlEncode($cv_historiinstruktur_list->kdpelat->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_cv_historiinstruktur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cv_historiinstruktur_list->TotalRecords > 0 || $cv_historiinstruktur_list->isGridEdit()) { ?>
<table id="tbl_cv_historiinstrukturlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_historiinstruktur->RowType = ROWTYPE_HEADER;

// Render list options
$cv_historiinstruktur_list->renderListOptions();

// Render list options (header, left)
$cv_historiinstruktur_list->ListOptions->render("header", "left");
?>
<?php if ($cv_historiinstruktur_list->bioid->Visible) { // bioid ?>
	<?php if ($cv_historiinstruktur_list->SortUrl($cv_historiinstruktur_list->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $cv_historiinstruktur_list->bioid->headerCellClass() ?>"><div id="elh_cv_historiinstruktur_bioid" class="cv_historiinstruktur_bioid"><div class="ew-table-header-caption"><?php echo $cv_historiinstruktur_list->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $cv_historiinstruktur_list->bioid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historiinstruktur_list->SortUrl($cv_historiinstruktur_list->bioid) ?>', 1);"><div id="elh_cv_historiinstruktur_bioid" class="cv_historiinstruktur_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historiinstruktur_list->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historiinstruktur_list->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historiinstruktur_list->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_historiinstruktur_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cv_historiinstruktur_list->ExportAll && $cv_historiinstruktur_list->isExport()) {
	$cv_historiinstruktur_list->StopRecord = $cv_historiinstruktur_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cv_historiinstruktur_list->TotalRecords > $cv_historiinstruktur_list->StartRecord + $cv_historiinstruktur_list->DisplayRecords - 1)
		$cv_historiinstruktur_list->StopRecord = $cv_historiinstruktur_list->StartRecord + $cv_historiinstruktur_list->DisplayRecords - 1;
	else
		$cv_historiinstruktur_list->StopRecord = $cv_historiinstruktur_list->TotalRecords;
}
$cv_historiinstruktur_list->RecordCount = $cv_historiinstruktur_list->StartRecord - 1;
if ($cv_historiinstruktur_list->Recordset && !$cv_historiinstruktur_list->Recordset->EOF) {
	$cv_historiinstruktur_list->Recordset->moveFirst();
	$selectLimit = $cv_historiinstruktur_list->UseSelectLimit;
	if (!$selectLimit && $cv_historiinstruktur_list->StartRecord > 1)
		$cv_historiinstruktur_list->Recordset->move($cv_historiinstruktur_list->StartRecord - 1);
} elseif (!$cv_historiinstruktur->AllowAddDeleteRow && $cv_historiinstruktur_list->StopRecord == 0) {
	$cv_historiinstruktur_list->StopRecord = $cv_historiinstruktur->GridAddRowCount;
}

// Initialize aggregate
$cv_historiinstruktur->RowType = ROWTYPE_AGGREGATEINIT;
$cv_historiinstruktur->resetAttributes();
$cv_historiinstruktur_list->renderRow();
while ($cv_historiinstruktur_list->RecordCount < $cv_historiinstruktur_list->StopRecord) {
	$cv_historiinstruktur_list->RecordCount++;
	if ($cv_historiinstruktur_list->RecordCount >= $cv_historiinstruktur_list->StartRecord) {
		$cv_historiinstruktur_list->RowCount++;

		// Set up key count
		$cv_historiinstruktur_list->KeyCount = $cv_historiinstruktur_list->RowIndex;

		// Init row class and style
		$cv_historiinstruktur->resetAttributes();
		$cv_historiinstruktur->CssClass = "";
		if ($cv_historiinstruktur_list->isGridAdd()) {
		} else {
			$cv_historiinstruktur_list->loadRowValues($cv_historiinstruktur_list->Recordset); // Load row values
		}
		$cv_historiinstruktur->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cv_historiinstruktur->RowAttrs->merge(["data-rowindex" => $cv_historiinstruktur_list->RowCount, "id" => "r" . $cv_historiinstruktur_list->RowCount . "_cv_historiinstruktur", "data-rowtype" => $cv_historiinstruktur->RowType]);

		// Render row
		$cv_historiinstruktur_list->renderRow();

		// Render list options
		$cv_historiinstruktur_list->renderListOptions();
?>
	<tr <?php echo $cv_historiinstruktur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historiinstruktur_list->ListOptions->render("body", "left", $cv_historiinstruktur_list->RowCount);
?>
	<?php if ($cv_historiinstruktur_list->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $cv_historiinstruktur_list->bioid->cellAttributes() ?>>
<span id="el<?php echo $cv_historiinstruktur_list->RowCount ?>_cv_historiinstruktur_bioid">
<span<?php echo $cv_historiinstruktur_list->bioid->viewAttributes() ?>><?php echo $cv_historiinstruktur_list->bioid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historiinstruktur_list->ListOptions->render("body", "right", $cv_historiinstruktur_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cv_historiinstruktur_list->isGridAdd())
		$cv_historiinstruktur_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cv_historiinstruktur->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_historiinstruktur_list->Recordset)
	$cv_historiinstruktur_list->Recordset->Close();
?>
<?php if (!$cv_historiinstruktur_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cv_historiinstruktur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_historiinstruktur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_historiinstruktur_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_historiinstruktur_list->TotalRecords == 0 && !$cv_historiinstruktur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_historiinstruktur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cv_historiinstruktur_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cv_historiinstruktur_list->isExport()) { ?>
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
$cv_historiinstruktur_list->terminate();
?>