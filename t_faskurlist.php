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
$t_faskur_list = new t_faskur_list();

// Run the page
$t_faskur_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_faskur_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_faskur_list->isExport()) { ?>
<script>
var ft_faskurlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_faskurlist = currentForm = new ew.Form("ft_faskurlist", "list");
	ft_faskurlist.formKeyCountName = '<?php echo $t_faskur_list->FormKeyCountName ?>';
	loadjs.done("ft_faskurlist");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_faskur_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_faskur_list->TotalRecords > 0 && $t_faskur_list->ExportOptions->visible()) { ?>
<?php $t_faskur_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_faskur_list->ImportOptions->visible()) { ?>
<?php $t_faskur_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_faskur_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_faskur_list->isExport("print")) { ?>
<?php
if ($t_faskur_list->DbMasterFilter != "" && $t_faskur->getCurrentMasterTable() == "t_biointruktur") {
	if ($t_faskur_list->MasterRecordExists) {
		include_once "t_biointrukturmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_faskur_list->renderOtherOptions();
?>
<?php $t_faskur_list->showPageHeader(); ?>
<?php
$t_faskur_list->showMessage();
?>
<?php if ($t_faskur_list->TotalRecords > 0 || $t_faskur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_faskur_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_faskur">
<?php if (!$t_faskur_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_faskur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_faskur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_faskur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_faskurlist" id="ft_faskurlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_faskur">
<?php if ($t_faskur->getCurrentMasterTable() == "t_biointruktur" && $t_faskur->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_faskur_list->bioid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_faskur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_faskur_list->TotalRecords > 0 || $t_faskur_list->isGridEdit()) { ?>
<table id="tbl_t_faskurlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_faskur->RowType = ROWTYPE_HEADER;

// Render list options
$t_faskur_list->renderListOptions();

// Render list options (header, left)
$t_faskur_list->ListOptions->render("header", "left");
?>
<?php if ($t_faskur_list->bioid->Visible) { // bioid ?>
	<?php if ($t_faskur_list->SortUrl($t_faskur_list->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_faskur_list->bioid->headerCellClass() ?>"><div id="elh_t_faskur_bioid" class="t_faskur_bioid"><div class="ew-table-header-caption"><?php echo $t_faskur_list->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_faskur_list->bioid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_faskur_list->SortUrl($t_faskur_list->bioid) ?>', 1);"><div id="elh_t_faskur_bioid" class="t_faskur_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_faskur_list->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_faskur_list->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_faskur_list->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_faskur_list->kurikulumid->Visible) { // kurikulumid ?>
	<?php if ($t_faskur_list->SortUrl($t_faskur_list->kurikulumid) == "") { ?>
		<th data-name="kurikulumid" class="<?php echo $t_faskur_list->kurikulumid->headerCellClass() ?>"><div id="elh_t_faskur_kurikulumid" class="t_faskur_kurikulumid"><div class="ew-table-header-caption"><?php echo $t_faskur_list->kurikulumid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulumid" class="<?php echo $t_faskur_list->kurikulumid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_faskur_list->SortUrl($t_faskur_list->kurikulumid) ?>', 1);"><div id="elh_t_faskur_kurikulumid" class="t_faskur_kurikulumid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_faskur_list->kurikulumid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_faskur_list->kurikulumid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_faskur_list->kurikulumid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_faskur_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_faskur_list->ExportAll && $t_faskur_list->isExport()) {
	$t_faskur_list->StopRecord = $t_faskur_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_faskur_list->TotalRecords > $t_faskur_list->StartRecord + $t_faskur_list->DisplayRecords - 1)
		$t_faskur_list->StopRecord = $t_faskur_list->StartRecord + $t_faskur_list->DisplayRecords - 1;
	else
		$t_faskur_list->StopRecord = $t_faskur_list->TotalRecords;
}
$t_faskur_list->RecordCount = $t_faskur_list->StartRecord - 1;
if ($t_faskur_list->Recordset && !$t_faskur_list->Recordset->EOF) {
	$t_faskur_list->Recordset->moveFirst();
	$selectLimit = $t_faskur_list->UseSelectLimit;
	if (!$selectLimit && $t_faskur_list->StartRecord > 1)
		$t_faskur_list->Recordset->move($t_faskur_list->StartRecord - 1);
} elseif (!$t_faskur->AllowAddDeleteRow && $t_faskur_list->StopRecord == 0) {
	$t_faskur_list->StopRecord = $t_faskur->GridAddRowCount;
}

// Initialize aggregate
$t_faskur->RowType = ROWTYPE_AGGREGATEINIT;
$t_faskur->resetAttributes();
$t_faskur_list->renderRow();
while ($t_faskur_list->RecordCount < $t_faskur_list->StopRecord) {
	$t_faskur_list->RecordCount++;
	if ($t_faskur_list->RecordCount >= $t_faskur_list->StartRecord) {
		$t_faskur_list->RowCount++;

		// Set up key count
		$t_faskur_list->KeyCount = $t_faskur_list->RowIndex;

		// Init row class and style
		$t_faskur->resetAttributes();
		$t_faskur->CssClass = "";
		if ($t_faskur_list->isGridAdd()) {
		} else {
			$t_faskur_list->loadRowValues($t_faskur_list->Recordset); // Load row values
		}
		$t_faskur->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_faskur->RowAttrs->merge(["data-rowindex" => $t_faskur_list->RowCount, "id" => "r" . $t_faskur_list->RowCount . "_t_faskur", "data-rowtype" => $t_faskur->RowType]);

		// Render row
		$t_faskur_list->renderRow();

		// Render list options
		$t_faskur_list->renderListOptions();
?>
	<tr <?php echo $t_faskur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_faskur_list->ListOptions->render("body", "left", $t_faskur_list->RowCount);
?>
	<?php if ($t_faskur_list->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_faskur_list->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_faskur_list->RowCount ?>_t_faskur_bioid">
<span<?php echo $t_faskur_list->bioid->viewAttributes() ?>><?php echo $t_faskur_list->bioid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_faskur_list->kurikulumid->Visible) { // kurikulumid ?>
		<td data-name="kurikulumid" <?php echo $t_faskur_list->kurikulumid->cellAttributes() ?>>
<span id="el<?php echo $t_faskur_list->RowCount ?>_t_faskur_kurikulumid">
<span<?php echo $t_faskur_list->kurikulumid->viewAttributes() ?>><?php echo $t_faskur_list->kurikulumid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_faskur_list->ListOptions->render("body", "right", $t_faskur_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_faskur_list->isGridAdd())
		$t_faskur_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_faskur->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_faskur_list->Recordset)
	$t_faskur_list->Recordset->Close();
?>
<?php if (!$t_faskur_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_faskur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_faskur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_faskur_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_faskur_list->TotalRecords == 0 && !$t_faskur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_faskur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_faskur_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_faskur_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$t_faskur->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_faskur",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_faskur_list->terminate();
?>