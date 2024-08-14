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
$master_ecp_list = new master_ecp_list();

// Run the page
$master_ecp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_ecp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_ecp_list->isExport()) { ?>
<script>
var fmaster_ecplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmaster_ecplist = currentForm = new ew.Form("fmaster_ecplist", "list");
	fmaster_ecplist.formKeyCountName = '<?php echo $master_ecp_list->FormKeyCountName ?>';
	loadjs.done("fmaster_ecplist");
});
var fmaster_ecplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmaster_ecplistsrch = currentSearchForm = new ew.Form("fmaster_ecplistsrch");

	// Validate function for search
	fmaster_ecplistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun_ecp");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_ecp_list->tahun_ecp->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmaster_ecplistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_ecplistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_ecplistsrch.lists["x_wilayah_ecp"] = <?php echo $master_ecp_list->wilayah_ecp->Lookup->toClientList($master_ecp_list) ?>;
	fmaster_ecplistsrch.lists["x_wilayah_ecp"].options = <?php echo JsonEncode($master_ecp_list->wilayah_ecp->lookupOptions()) ?>;

	// Filters
	fmaster_ecplistsrch.filterList = <?php echo $master_ecp_list->getFilterList() ?>;
	loadjs.done("fmaster_ecplistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$master_ecp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($master_ecp_list->TotalRecords > 0 && $master_ecp_list->ExportOptions->visible()) { ?>
<?php $master_ecp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($master_ecp_list->ImportOptions->visible()) { ?>
<?php $master_ecp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($master_ecp_list->SearchOptions->visible()) { ?>
<?php $master_ecp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($master_ecp_list->FilterOptions->visible()) { ?>
<?php $master_ecp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$master_ecp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$master_ecp_list->isExport() && !$master_ecp->CurrentAction) { ?>
<form name="fmaster_ecplistsrch" id="fmaster_ecplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmaster_ecplistsrch-search-panel" class="<?php echo $master_ecp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="master_ecp">
	<div class="ew-extended-search">
<?php

// Render search row
$master_ecp->RowType = ROWTYPE_SEARCH;
$master_ecp->resetAttributes();
$master_ecp_list->renderRow();
?>
<?php if ($master_ecp_list->wilayah_ecp->Visible) { // wilayah_ecp ?>
	<?php
		$master_ecp_list->SearchColumnCount++;
		if (($master_ecp_list->SearchColumnCount - 1) % $master_ecp_list->SearchFieldsPerRow == 0) {
			$master_ecp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_ecp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_wilayah_ecp" class="ew-cell form-group">
		<label for="x_wilayah_ecp" class="ew-search-caption ew-label"><?php echo $master_ecp_list->wilayah_ecp->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_wilayah_ecp" id="z_wilayah_ecp" value="LIKE">
</span>
		<span id="el_master_ecp_wilayah_ecp" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_ecp" data-field="x_wilayah_ecp" data-value-separator="<?php echo $master_ecp_list->wilayah_ecp->displayValueSeparatorAttribute() ?>" id="x_wilayah_ecp" name="x_wilayah_ecp"<?php echo $master_ecp_list->wilayah_ecp->editAttributes() ?>>
			<?php echo $master_ecp_list->wilayah_ecp->selectOptionListHtml("x_wilayah_ecp") ?>
		</select>
</div>
<?php echo $master_ecp_list->wilayah_ecp->Lookup->getParamTag($master_ecp_list, "p_x_wilayah_ecp") ?>
</span>
	</div>
	<?php if ($master_ecp_list->SearchColumnCount % $master_ecp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_ecp_list->tahun_ecp->Visible) { // tahun_ecp ?>
	<?php
		$master_ecp_list->SearchColumnCount++;
		if (($master_ecp_list->SearchColumnCount - 1) % $master_ecp_list->SearchFieldsPerRow == 0) {
			$master_ecp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_ecp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_ecp" class="ew-cell form-group">
		<label for="x_tahun_ecp" class="ew-search-caption ew-label"><?php echo $master_ecp_list->tahun_ecp->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_ecp" id="z_tahun_ecp" value="=">
</span>
		<span id="el_master_ecp_tahun_ecp" class="ew-search-field">
<input type="text" data-table="master_ecp" data-field="x_tahun_ecp" name="x_tahun_ecp" id="x_tahun_ecp" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($master_ecp_list->tahun_ecp->getPlaceHolder()) ?>" value="<?php echo $master_ecp_list->tahun_ecp->EditValue ?>"<?php echo $master_ecp_list->tahun_ecp->editAttributes() ?>>
</span>
	</div>
	<?php if ($master_ecp_list->SearchColumnCount % $master_ecp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($master_ecp_list->SearchColumnCount % $master_ecp_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $master_ecp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $master_ecp_list->showPageHeader(); ?>
<?php
$master_ecp_list->showMessage();
?>
<?php if ($master_ecp_list->TotalRecords > 0 || $master_ecp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($master_ecp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> master_ecp">
<?php if (!$master_ecp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$master_ecp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_ecp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_ecp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmaster_ecplist" id="fmaster_ecplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_ecp">
<div id="gmp_master_ecp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($master_ecp_list->TotalRecords > 0 || $master_ecp_list->isGridEdit()) { ?>
<table id="tbl_master_ecplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$master_ecp->RowType = ROWTYPE_HEADER;

// Render list options
$master_ecp_list->renderListOptions();

// Render list options (header, left)
$master_ecp_list->ListOptions->render("header", "left");
?>
<?php if ($master_ecp_list->wilayah_ecp->Visible) { // wilayah_ecp ?>
	<?php if ($master_ecp_list->SortUrl($master_ecp_list->wilayah_ecp) == "") { ?>
		<th data-name="wilayah_ecp" class="<?php echo $master_ecp_list->wilayah_ecp->headerCellClass() ?>"><div id="elh_master_ecp_wilayah_ecp" class="master_ecp_wilayah_ecp"><div class="ew-table-header-caption"><?php echo $master_ecp_list->wilayah_ecp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="wilayah_ecp" class="<?php echo $master_ecp_list->wilayah_ecp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_ecp_list->SortUrl($master_ecp_list->wilayah_ecp) ?>', 1);"><div id="elh_master_ecp_wilayah_ecp" class="master_ecp_wilayah_ecp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_ecp_list->wilayah_ecp->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_ecp_list->wilayah_ecp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_ecp_list->wilayah_ecp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_ecp_list->tahun_ecp->Visible) { // tahun_ecp ?>
	<?php if ($master_ecp_list->SortUrl($master_ecp_list->tahun_ecp) == "") { ?>
		<th data-name="tahun_ecp" class="<?php echo $master_ecp_list->tahun_ecp->headerCellClass() ?>"><div id="elh_master_ecp_tahun_ecp" class="master_ecp_tahun_ecp"><div class="ew-table-header-caption"><?php echo $master_ecp_list->tahun_ecp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_ecp" class="<?php echo $master_ecp_list->tahun_ecp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_ecp_list->SortUrl($master_ecp_list->tahun_ecp) ?>', 1);"><div id="elh_master_ecp_tahun_ecp" class="master_ecp_tahun_ecp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_ecp_list->tahun_ecp->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_ecp_list->tahun_ecp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_ecp_list->tahun_ecp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_ecp_list->nama_peserta->Visible) { // nama_peserta ?>
	<?php if ($master_ecp_list->SortUrl($master_ecp_list->nama_peserta) == "") { ?>
		<th data-name="nama_peserta" class="<?php echo $master_ecp_list->nama_peserta->headerCellClass() ?>"><div id="elh_master_ecp_nama_peserta" class="master_ecp_nama_peserta"><div class="ew-table-header-caption"><?php echo $master_ecp_list->nama_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_peserta" class="<?php echo $master_ecp_list->nama_peserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_ecp_list->SortUrl($master_ecp_list->nama_peserta) ?>', 1);"><div id="elh_master_ecp_nama_peserta" class="master_ecp_nama_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_ecp_list->nama_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_ecp_list->nama_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_ecp_list->nama_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_ecp_list->namap->Visible) { // namap ?>
	<?php if ($master_ecp_list->SortUrl($master_ecp_list->namap) == "") { ?>
		<th data-name="namap" class="<?php echo $master_ecp_list->namap->headerCellClass() ?>"><div id="elh_master_ecp_namap" class="master_ecp_namap"><div class="ew-table-header-caption"><?php echo $master_ecp_list->namap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namap" class="<?php echo $master_ecp_list->namap->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_ecp_list->SortUrl($master_ecp_list->namap) ?>', 1);"><div id="elh_master_ecp_namap" class="master_ecp_namap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_ecp_list->namap->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_ecp_list->namap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_ecp_list->namap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_ecp_list->produk->Visible) { // produk ?>
	<?php if ($master_ecp_list->SortUrl($master_ecp_list->produk) == "") { ?>
		<th data-name="produk" class="<?php echo $master_ecp_list->produk->headerCellClass() ?>"><div id="elh_master_ecp_produk" class="master_ecp_produk"><div class="ew-table-header-caption"><?php echo $master_ecp_list->produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="produk" class="<?php echo $master_ecp_list->produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_ecp_list->SortUrl($master_ecp_list->produk) ?>', 1);"><div id="elh_master_ecp_produk" class="master_ecp_produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_ecp_list->produk->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_ecp_list->produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_ecp_list->produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$master_ecp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($master_ecp_list->ExportAll && $master_ecp_list->isExport()) {
	$master_ecp_list->StopRecord = $master_ecp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($master_ecp_list->TotalRecords > $master_ecp_list->StartRecord + $master_ecp_list->DisplayRecords - 1)
		$master_ecp_list->StopRecord = $master_ecp_list->StartRecord + $master_ecp_list->DisplayRecords - 1;
	else
		$master_ecp_list->StopRecord = $master_ecp_list->TotalRecords;
}
$master_ecp_list->RecordCount = $master_ecp_list->StartRecord - 1;
if ($master_ecp_list->Recordset && !$master_ecp_list->Recordset->EOF) {
	$master_ecp_list->Recordset->moveFirst();
	$selectLimit = $master_ecp_list->UseSelectLimit;
	if (!$selectLimit && $master_ecp_list->StartRecord > 1)
		$master_ecp_list->Recordset->move($master_ecp_list->StartRecord - 1);
} elseif (!$master_ecp->AllowAddDeleteRow && $master_ecp_list->StopRecord == 0) {
	$master_ecp_list->StopRecord = $master_ecp->GridAddRowCount;
}

// Initialize aggregate
$master_ecp->RowType = ROWTYPE_AGGREGATEINIT;
$master_ecp->resetAttributes();
$master_ecp_list->renderRow();
while ($master_ecp_list->RecordCount < $master_ecp_list->StopRecord) {
	$master_ecp_list->RecordCount++;
	if ($master_ecp_list->RecordCount >= $master_ecp_list->StartRecord) {
		$master_ecp_list->RowCount++;

		// Set up key count
		$master_ecp_list->KeyCount = $master_ecp_list->RowIndex;

		// Init row class and style
		$master_ecp->resetAttributes();
		$master_ecp->CssClass = "";
		if ($master_ecp_list->isGridAdd()) {
		} else {
			$master_ecp_list->loadRowValues($master_ecp_list->Recordset); // Load row values
		}
		$master_ecp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$master_ecp->RowAttrs->merge(["data-rowindex" => $master_ecp_list->RowCount, "id" => "r" . $master_ecp_list->RowCount . "_master_ecp", "data-rowtype" => $master_ecp->RowType]);

		// Render row
		$master_ecp_list->renderRow();

		// Render list options
		$master_ecp_list->renderListOptions();
?>
	<tr <?php echo $master_ecp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$master_ecp_list->ListOptions->render("body", "left", $master_ecp_list->RowCount);
?>
	<?php if ($master_ecp_list->wilayah_ecp->Visible) { // wilayah_ecp ?>
		<td data-name="wilayah_ecp" <?php echo $master_ecp_list->wilayah_ecp->cellAttributes() ?>>
<span id="el<?php echo $master_ecp_list->RowCount ?>_master_ecp_wilayah_ecp">
<span<?php echo $master_ecp_list->wilayah_ecp->viewAttributes() ?>><?php echo $master_ecp_list->wilayah_ecp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_ecp_list->tahun_ecp->Visible) { // tahun_ecp ?>
		<td data-name="tahun_ecp" <?php echo $master_ecp_list->tahun_ecp->cellAttributes() ?>>
<span id="el<?php echo $master_ecp_list->RowCount ?>_master_ecp_tahun_ecp">
<span<?php echo $master_ecp_list->tahun_ecp->viewAttributes() ?>><?php echo $master_ecp_list->tahun_ecp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_ecp_list->nama_peserta->Visible) { // nama_peserta ?>
		<td data-name="nama_peserta" <?php echo $master_ecp_list->nama_peserta->cellAttributes() ?>>
<span id="el<?php echo $master_ecp_list->RowCount ?>_master_ecp_nama_peserta">
<span<?php echo $master_ecp_list->nama_peserta->viewAttributes() ?>><?php echo $master_ecp_list->nama_peserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_ecp_list->namap->Visible) { // namap ?>
		<td data-name="namap" <?php echo $master_ecp_list->namap->cellAttributes() ?>>
<span id="el<?php echo $master_ecp_list->RowCount ?>_master_ecp_namap">
<span<?php echo $master_ecp_list->namap->viewAttributes() ?>><?php echo $master_ecp_list->namap->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_ecp_list->produk->Visible) { // produk ?>
		<td data-name="produk" <?php echo $master_ecp_list->produk->cellAttributes() ?>>
<span id="el<?php echo $master_ecp_list->RowCount ?>_master_ecp_produk">
<span<?php echo $master_ecp_list->produk->viewAttributes() ?>><?php echo $master_ecp_list->produk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_ecp_list->ListOptions->render("body", "right", $master_ecp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$master_ecp_list->isGridAdd())
		$master_ecp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$master_ecp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($master_ecp_list->Recordset)
	$master_ecp_list->Recordset->Close();
?>
<?php if (!$master_ecp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$master_ecp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_ecp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_ecp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($master_ecp_list->TotalRecords == 0 && !$master_ecp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $master_ecp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$master_ecp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_ecp_list->isExport()) { ?>
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
$master_ecp_list->terminate();
?>