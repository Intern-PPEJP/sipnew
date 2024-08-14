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
$t_pweb_list = new t_pweb_list();

// Run the page
$t_pweb_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pweb_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_pweb_list->isExport()) { ?>
<script>
var ft_pweblist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_pweblist = currentForm = new ew.Form("ft_pweblist", "list");
	ft_pweblist.formKeyCountName = '<?php echo $t_pweb_list->FormKeyCountName ?>';

	// Validate form
	ft_pweblist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($t_pweb_list->kdhistori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdhistori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_list->kdhistori->caption(), $t_pweb_list->kdhistori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_list->rkwid->Required) { ?>
				elm = this.getElements("x" + infix + "_rkwid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_list->rkwid->caption(), $t_pweb_list->rkwid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_list->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_list->id->caption(), $t_pweb_list->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pweb_list->id->errorMessage()) ?>");
			<?php if ($t_pweb_list->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_list->tahun->caption(), $t_pweb_list->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_list->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_list->kdinformasi->caption(), $t_pweb_list->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_list->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_list->harapan->caption(), $t_pweb_list->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_list->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_list->sertifikat->caption(), $t_pweb_list->sertifikat->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	ft_pweblist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "rkwid", false)) return false;
		if (ew.valueChanged(fobj, infix, "id", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdinformasi", false)) return false;
		if (ew.valueChanged(fobj, infix, "harapan", false)) return false;
		if (ew.valueChanged(fobj, infix, "sertifikat", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_pweblist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pweblist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pweblist.lists["x_rkwid"] = <?php echo $t_pweb_list->rkwid->Lookup->toClientList($t_pweb_list) ?>;
	ft_pweblist.lists["x_rkwid"].options = <?php echo JsonEncode($t_pweb_list->rkwid->lookupOptions()) ?>;
	ft_pweblist.autoSuggests["x_rkwid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pweblist.lists["x_id"] = <?php echo $t_pweb_list->id->Lookup->toClientList($t_pweb_list) ?>;
	ft_pweblist.lists["x_id"].options = <?php echo JsonEncode($t_pweb_list->id->lookupOptions()) ?>;
	ft_pweblist.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pweblist.lists["x_kdinformasi"] = <?php echo $t_pweb_list->kdinformasi->Lookup->toClientList($t_pweb_list) ?>;
	ft_pweblist.lists["x_kdinformasi"].options = <?php echo JsonEncode($t_pweb_list->kdinformasi->lookupOptions()) ?>;
	loadjs.done("ft_pweblist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_pweb_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_pweb_list->TotalRecords > 0 && $t_pweb_list->ExportOptions->visible()) { ?>
<?php $t_pweb_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_pweb_list->ImportOptions->visible()) { ?>
<?php $t_pweb_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_pweb_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_pweb_list->isExport("print")) { ?>
<?php
if ($t_pweb_list->DbMasterFilter != "" && $t_pweb->getCurrentMasterTable() == "webinar") {
	if ($t_pweb_list->MasterRecordExists) {
		include_once "webinarmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_pweb_list->renderOtherOptions();
?>
<?php $t_pweb_list->showPageHeader(); ?>
<?php
$t_pweb_list->showMessage();
?>
<?php if ($t_pweb_list->TotalRecords > 0 || $t_pweb->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_pweb_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_pweb">
<?php if (!$t_pweb_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_pweb_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pweb_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pweb_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_pweblist" id="ft_pweblist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pweb">
<?php if ($t_pweb->getCurrentMasterTable() == "webinar" && $t_pweb->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="webinar">
<input type="hidden" name="fk_rkwid" value="<?php echo HtmlEncode($t_pweb_list->rkwid->getSessionValue()) ?>">
<input type="hidden" name="fk_tahun" value="<?php echo HtmlEncode($t_pweb_list->tahun->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_pweb" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_pweb_list->TotalRecords > 0 || $t_pweb_list->isGridEdit()) { ?>
<table id="tbl_t_pweblist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_pweb->RowType = ROWTYPE_HEADER;

// Render list options
$t_pweb_list->renderListOptions();

// Render list options (header, left)
$t_pweb_list->ListOptions->render("header", "left");
?>
<?php if ($t_pweb_list->kdhistori->Visible) { // kdhistori ?>
	<?php if ($t_pweb_list->SortUrl($t_pweb_list->kdhistori) == "") { ?>
		<th data-name="kdhistori" class="<?php echo $t_pweb_list->kdhistori->headerCellClass() ?>"><div id="elh_t_pweb_kdhistori" class="t_pweb_kdhistori"><div class="ew-table-header-caption"><?php echo $t_pweb_list->kdhistori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdhistori" class="<?php echo $t_pweb_list->kdhistori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pweb_list->SortUrl($t_pweb_list->kdhistori) ?>', 1);"><div id="elh_t_pweb_kdhistori" class="t_pweb_kdhistori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_list->kdhistori->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_list->kdhistori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_list->kdhistori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_list->rkwid->Visible) { // rkwid ?>
	<?php if ($t_pweb_list->SortUrl($t_pweb_list->rkwid) == "") { ?>
		<th data-name="rkwid" class="<?php echo $t_pweb_list->rkwid->headerCellClass() ?>"><div id="elh_t_pweb_rkwid" class="t_pweb_rkwid"><div class="ew-table-header-caption"><?php echo $t_pweb_list->rkwid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rkwid" class="<?php echo $t_pweb_list->rkwid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pweb_list->SortUrl($t_pweb_list->rkwid) ?>', 1);"><div id="elh_t_pweb_rkwid" class="t_pweb_rkwid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_list->rkwid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_list->rkwid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_list->rkwid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_list->id->Visible) { // id ?>
	<?php if ($t_pweb_list->SortUrl($t_pweb_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $t_pweb_list->id->headerCellClass() ?>"><div id="elh_t_pweb_id" class="t_pweb_id"><div class="ew-table-header-caption"><?php echo $t_pweb_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $t_pweb_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pweb_list->SortUrl($t_pweb_list->id) ?>', 1);"><div id="elh_t_pweb_id" class="t_pweb_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_list->tahun->Visible) { // tahun ?>
	<?php if ($t_pweb_list->SortUrl($t_pweb_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $t_pweb_list->tahun->headerCellClass() ?>"><div id="elh_t_pweb_tahun" class="t_pweb_tahun"><div class="ew-table-header-caption"><?php echo $t_pweb_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $t_pweb_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pweb_list->SortUrl($t_pweb_list->tahun) ?>', 1);"><div id="elh_t_pweb_tahun" class="t_pweb_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_list->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($t_pweb_list->SortUrl($t_pweb_list->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $t_pweb_list->kdinformasi->headerCellClass() ?>"><div id="elh_t_pweb_kdinformasi" class="t_pweb_kdinformasi"><div class="ew-table-header-caption"><?php echo $t_pweb_list->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $t_pweb_list->kdinformasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pweb_list->SortUrl($t_pweb_list->kdinformasi) ?>', 1);"><div id="elh_t_pweb_kdinformasi" class="t_pweb_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_list->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_list->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_list->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_list->harapan->Visible) { // harapan ?>
	<?php if ($t_pweb_list->SortUrl($t_pweb_list->harapan) == "") { ?>
		<th data-name="harapan" class="<?php echo $t_pweb_list->harapan->headerCellClass() ?>"><div id="elh_t_pweb_harapan" class="t_pweb_harapan"><div class="ew-table-header-caption"><?php echo $t_pweb_list->harapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harapan" class="<?php echo $t_pweb_list->harapan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pweb_list->SortUrl($t_pweb_list->harapan) ?>', 1);"><div id="elh_t_pweb_harapan" class="t_pweb_harapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_list->harapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_list->harapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_list->harapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_list->sertifikat->Visible) { // sertifikat ?>
	<?php if ($t_pweb_list->SortUrl($t_pweb_list->sertifikat) == "") { ?>
		<th data-name="sertifikat" class="<?php echo $t_pweb_list->sertifikat->headerCellClass() ?>"><div id="elh_t_pweb_sertifikat" class="t_pweb_sertifikat"><div class="ew-table-header-caption"><?php echo $t_pweb_list->sertifikat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat" class="<?php echo $t_pweb_list->sertifikat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pweb_list->SortUrl($t_pweb_list->sertifikat) ?>', 1);"><div id="elh_t_pweb_sertifikat" class="t_pweb_sertifikat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_list->sertifikat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_list->sertifikat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_list->sertifikat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_pweb_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_pweb_list->ExportAll && $t_pweb_list->isExport()) {
	$t_pweb_list->StopRecord = $t_pweb_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_pweb_list->TotalRecords > $t_pweb_list->StartRecord + $t_pweb_list->DisplayRecords - 1)
		$t_pweb_list->StopRecord = $t_pweb_list->StartRecord + $t_pweb_list->DisplayRecords - 1;
	else
		$t_pweb_list->StopRecord = $t_pweb_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($t_pweb->isConfirm() || $t_pweb_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_pweb_list->FormKeyCountName) && ($t_pweb_list->isGridAdd() || $t_pweb_list->isGridEdit() || $t_pweb->isConfirm())) {
		$t_pweb_list->KeyCount = $CurrentForm->getValue($t_pweb_list->FormKeyCountName);
		$t_pweb_list->StopRecord = $t_pweb_list->StartRecord + $t_pweb_list->KeyCount - 1;
	}
}
$t_pweb_list->RecordCount = $t_pweb_list->StartRecord - 1;
if ($t_pweb_list->Recordset && !$t_pweb_list->Recordset->EOF) {
	$t_pweb_list->Recordset->moveFirst();
	$selectLimit = $t_pweb_list->UseSelectLimit;
	if (!$selectLimit && $t_pweb_list->StartRecord > 1)
		$t_pweb_list->Recordset->move($t_pweb_list->StartRecord - 1);
} elseif (!$t_pweb->AllowAddDeleteRow && $t_pweb_list->StopRecord == 0) {
	$t_pweb_list->StopRecord = $t_pweb->GridAddRowCount;
}

// Initialize aggregate
$t_pweb->RowType = ROWTYPE_AGGREGATEINIT;
$t_pweb->resetAttributes();
$t_pweb_list->renderRow();
if ($t_pweb_list->isGridAdd())
	$t_pweb_list->RowIndex = 0;
while ($t_pweb_list->RecordCount < $t_pweb_list->StopRecord) {
	$t_pweb_list->RecordCount++;
	if ($t_pweb_list->RecordCount >= $t_pweb_list->StartRecord) {
		$t_pweb_list->RowCount++;
		if ($t_pweb_list->isGridAdd() || $t_pweb_list->isGridEdit() || $t_pweb->isConfirm()) {
			$t_pweb_list->RowIndex++;
			$CurrentForm->Index = $t_pweb_list->RowIndex;
			if ($CurrentForm->hasValue($t_pweb_list->FormActionName) && ($t_pweb->isConfirm() || $t_pweb_list->EventCancelled))
				$t_pweb_list->RowAction = strval($CurrentForm->getValue($t_pweb_list->FormActionName));
			elseif ($t_pweb_list->isGridAdd())
				$t_pweb_list->RowAction = "insert";
			else
				$t_pweb_list->RowAction = "";
		}

		// Set up key count
		$t_pweb_list->KeyCount = $t_pweb_list->RowIndex;

		// Init row class and style
		$t_pweb->resetAttributes();
		$t_pweb->CssClass = "";
		if ($t_pweb_list->isGridAdd()) {
			$t_pweb_list->loadRowValues(); // Load default values
		} else {
			$t_pweb_list->loadRowValues($t_pweb_list->Recordset); // Load row values
		}
		$t_pweb->RowType = ROWTYPE_VIEW; // Render view
		if ($t_pweb_list->isGridAdd()) // Grid add
			$t_pweb->RowType = ROWTYPE_ADD; // Render add
		if ($t_pweb_list->isGridAdd() && $t_pweb->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_pweb_list->restoreCurrentRowFormValues($t_pweb_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_pweb->RowAttrs->merge(["data-rowindex" => $t_pweb_list->RowCount, "id" => "r" . $t_pweb_list->RowCount . "_t_pweb", "data-rowtype" => $t_pweb->RowType]);

		// Render row
		$t_pweb_list->renderRow();

		// Render list options
		$t_pweb_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_pweb_list->RowAction != "delete" && $t_pweb_list->RowAction != "insertdelete" && !($t_pweb_list->RowAction == "insert" && $t_pweb->isConfirm() && $t_pweb_list->emptyRow())) {
?>
	<tr <?php echo $t_pweb->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pweb_list->ListOptions->render("body", "left", $t_pweb_list->RowCount);
?>
	<?php if ($t_pweb_list->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori" <?php echo $t_pweb_list->kdhistori->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_kdhistori" class="form-group"></span>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="o<?php echo $t_pweb_list->RowIndex ?>_kdhistori" id="o<?php echo $t_pweb_list->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_list->kdhistori->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_kdhistori">
<span<?php echo $t_pweb_list->kdhistori->viewAttributes() ?>><?php echo $t_pweb_list->kdhistori->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_list->rkwid->Visible) { // rkwid ?>
		<td data-name="rkwid" <?php echo $t_pweb_list->rkwid->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_pweb_list->rkwid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_rkwid" class="form-group">
<span<?php echo $t_pweb_list->rkwid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_list->rkwid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pweb_list->RowIndex ?>_rkwid" name="x<?php echo $t_pweb_list->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_list->rkwid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_rkwid" class="form-group">
<?php
$onchange = $t_pweb_list->rkwid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_list->rkwid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_list->RowIndex ?>_rkwid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_list->RowIndex ?>_rkwid" id="sv_x<?php echo $t_pweb_list->RowIndex ?>_rkwid" value="<?php echo RemoveHtml($t_pweb_list->rkwid->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($t_pweb_list->rkwid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_list->rkwid->getPlaceHolder()) ?>"<?php echo $t_pweb_list->rkwid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" data-value-separator="<?php echo $t_pweb_list->rkwid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_list->RowIndex ?>_rkwid" id="x<?php echo $t_pweb_list->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_list->rkwid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pweblist"], function() {
	ft_pweblist.createAutoSuggest({"id":"x<?php echo $t_pweb_list->RowIndex ?>_rkwid","forceSelect":false});
});
</script>
<?php echo $t_pweb_list->rkwid->Lookup->getParamTag($t_pweb_list, "p_x" . $t_pweb_list->RowIndex . "_rkwid") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="o<?php echo $t_pweb_list->RowIndex ?>_rkwid" id="o<?php echo $t_pweb_list->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_list->rkwid->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_rkwid">
<span<?php echo $t_pweb_list->rkwid->viewAttributes() ?>><?php echo $t_pweb_list->rkwid->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $t_pweb_list->id->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_id" class="form-group">
<?php
$onchange = $t_pweb_list->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_list->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_list->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_list->RowIndex ?>_id" id="sv_x<?php echo $t_pweb_list->RowIndex ?>_id" value="<?php echo RemoveHtml($t_pweb_list->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_pweb_list->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_list->id->getPlaceHolder()) ?>"<?php echo $t_pweb_list->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_pweb_list->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_pweb_list->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($t_pweb_list->id->ReadOnly || $t_pweb_list->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_pweb_list->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_list->RowIndex ?>_id" id="x<?php echo $t_pweb_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_list->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pweblist"], function() {
	ft_pweblist.createAutoSuggest({"id":"x<?php echo $t_pweb_list->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $t_pweb_list->id->Lookup->getParamTag($t_pweb_list, "p_x" . $t_pweb_list->RowIndex . "_id") ?>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" name="o<?php echo $t_pweb_list->RowIndex ?>_id" id="o<?php echo $t_pweb_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_list->id->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_id">
<span<?php echo $t_pweb_list->id->viewAttributes() ?>><?php echo $t_pweb_list->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $t_pweb_list->tahun->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_pweb_list->tahun->getSessionValue() != "") { ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_tahun" class="form-group">
<span<?php echo $t_pweb_list->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_list->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pweb_list->RowIndex ?>_tahun" name="x<?php echo $t_pweb_list->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_list->tahun->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_tahun" class="form-group">
<input type="text" data-table="t_pweb" data-field="x_tahun" name="x<?php echo $t_pweb_list->RowIndex ?>_tahun" id="x<?php echo $t_pweb_list->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pweb_list->tahun->getPlaceHolder()) ?>" value="<?php echo $t_pweb_list->tahun->EditValue ?>"<?php echo $t_pweb_list->tahun->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="o<?php echo $t_pweb_list->RowIndex ?>_tahun" id="o<?php echo $t_pweb_list->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_list->tahun->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_tahun">
<span<?php echo $t_pweb_list->tahun->viewAttributes() ?>><?php echo $t_pweb_list->tahun->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_list->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $t_pweb_list->kdinformasi->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pweb" data-field="x_kdinformasi" data-value-separator="<?php echo $t_pweb_list->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pweb_list->RowIndex ?>_kdinformasi" name="x<?php echo $t_pweb_list->RowIndex ?>_kdinformasi"<?php echo $t_pweb_list->kdinformasi->editAttributes() ?>>
			<?php echo $t_pweb_list->kdinformasi->selectOptionListHtml("x{$t_pweb_list->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $t_pweb_list->kdinformasi->Lookup->getParamTag($t_pweb_list, "p_x" . $t_pweb_list->RowIndex . "_kdinformasi") ?>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="o<?php echo $t_pweb_list->RowIndex ?>_kdinformasi" id="o<?php echo $t_pweb_list->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_list->kdinformasi->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_kdinformasi">
<span<?php echo $t_pweb_list->kdinformasi->viewAttributes() ?>><?php echo $t_pweb_list->kdinformasi->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_list->harapan->Visible) { // harapan ?>
		<td data-name="harapan" <?php echo $t_pweb_list->harapan->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_harapan" class="form-group">
<textarea data-table="t_pweb" data-field="x_harapan" name="x<?php echo $t_pweb_list->RowIndex ?>_harapan" id="x<?php echo $t_pweb_list->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_pweb_list->harapan->getPlaceHolder()) ?>"<?php echo $t_pweb_list->harapan->editAttributes() ?>><?php echo $t_pweb_list->harapan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="o<?php echo $t_pweb_list->RowIndex ?>_harapan" id="o<?php echo $t_pweb_list->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_list->harapan->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_harapan">
<span<?php echo $t_pweb_list->harapan->viewAttributes() ?>><?php echo $t_pweb_list->harapan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_list->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat" <?php echo $t_pweb_list->sertifikat->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_sertifikat" class="form-group">
<input type="text" data-table="t_pweb" data-field="x_sertifikat" name="x<?php echo $t_pweb_list->RowIndex ?>_sertifikat" id="x<?php echo $t_pweb_list->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pweb_list->sertifikat->getPlaceHolder()) ?>" value="<?php echo $t_pweb_list->sertifikat->EditValue ?>"<?php echo $t_pweb_list->sertifikat->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="o<?php echo $t_pweb_list->RowIndex ?>_sertifikat" id="o<?php echo $t_pweb_list->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_list->sertifikat->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_list->RowCount ?>_t_pweb_sertifikat">
<span<?php echo $t_pweb_list->sertifikat->viewAttributes() ?>><?php echo $t_pweb_list->sertifikat->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pweb_list->ListOptions->render("body", "right", $t_pweb_list->RowCount);
?>
	</tr>
<?php if ($t_pweb->RowType == ROWTYPE_ADD || $t_pweb->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_pweblist", "load"], function() {
	ft_pweblist.updateLists(<?php echo $t_pweb_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_pweb_list->isGridAdd())
		if (!$t_pweb_list->Recordset->EOF)
			$t_pweb_list->Recordset->moveNext();
}
?>
<?php
	if ($t_pweb_list->isGridAdd() || $t_pweb_list->isGridEdit()) {
		$t_pweb_list->RowIndex = '$rowindex$';
		$t_pweb_list->loadRowValues();

		// Set row properties
		$t_pweb->resetAttributes();
		$t_pweb->RowAttrs->merge(["data-rowindex" => $t_pweb_list->RowIndex, "id" => "r0_t_pweb", "data-rowtype" => ROWTYPE_ADD]);
		$t_pweb->RowAttrs->appendClass("ew-template");
		$t_pweb->RowType = ROWTYPE_ADD;

		// Render row
		$t_pweb_list->renderRow();

		// Render list options
		$t_pweb_list->renderListOptions();
		$t_pweb_list->StartRowCount = 0;
?>
	<tr <?php echo $t_pweb->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pweb_list->ListOptions->render("body", "left", $t_pweb_list->RowIndex);
?>
	<?php if ($t_pweb_list->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori">
<span id="el$rowindex$_t_pweb_kdhistori" class="form-group t_pweb_kdhistori"></span>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="o<?php echo $t_pweb_list->RowIndex ?>_kdhistori" id="o<?php echo $t_pweb_list->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_list->kdhistori->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_list->rkwid->Visible) { // rkwid ?>
		<td data-name="rkwid">
<?php if ($t_pweb_list->rkwid->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_pweb_rkwid" class="form-group t_pweb_rkwid">
<span<?php echo $t_pweb_list->rkwid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_list->rkwid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pweb_list->RowIndex ?>_rkwid" name="x<?php echo $t_pweb_list->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_list->rkwid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_pweb_rkwid" class="form-group t_pweb_rkwid">
<?php
$onchange = $t_pweb_list->rkwid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_list->rkwid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_list->RowIndex ?>_rkwid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_list->RowIndex ?>_rkwid" id="sv_x<?php echo $t_pweb_list->RowIndex ?>_rkwid" value="<?php echo RemoveHtml($t_pweb_list->rkwid->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($t_pweb_list->rkwid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_list->rkwid->getPlaceHolder()) ?>"<?php echo $t_pweb_list->rkwid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" data-value-separator="<?php echo $t_pweb_list->rkwid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_list->RowIndex ?>_rkwid" id="x<?php echo $t_pweb_list->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_list->rkwid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pweblist"], function() {
	ft_pweblist.createAutoSuggest({"id":"x<?php echo $t_pweb_list->RowIndex ?>_rkwid","forceSelect":false});
});
</script>
<?php echo $t_pweb_list->rkwid->Lookup->getParamTag($t_pweb_list, "p_x" . $t_pweb_list->RowIndex . "_rkwid") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="o<?php echo $t_pweb_list->RowIndex ?>_rkwid" id="o<?php echo $t_pweb_list->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_list->rkwid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_list->id->Visible) { // id ?>
		<td data-name="id">
<span id="el$rowindex$_t_pweb_id" class="form-group t_pweb_id">
<?php
$onchange = $t_pweb_list->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_list->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_list->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_list->RowIndex ?>_id" id="sv_x<?php echo $t_pweb_list->RowIndex ?>_id" value="<?php echo RemoveHtml($t_pweb_list->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_pweb_list->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_list->id->getPlaceHolder()) ?>"<?php echo $t_pweb_list->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_pweb_list->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_pweb_list->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($t_pweb_list->id->ReadOnly || $t_pweb_list->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_pweb_list->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_list->RowIndex ?>_id" id="x<?php echo $t_pweb_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_list->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pweblist"], function() {
	ft_pweblist.createAutoSuggest({"id":"x<?php echo $t_pweb_list->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $t_pweb_list->id->Lookup->getParamTag($t_pweb_list, "p_x" . $t_pweb_list->RowIndex . "_id") ?>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" name="o<?php echo $t_pweb_list->RowIndex ?>_id" id="o<?php echo $t_pweb_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_list->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun">
<?php if ($t_pweb_list->tahun->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_pweb_tahun" class="form-group t_pweb_tahun">
<span<?php echo $t_pweb_list->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_list->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pweb_list->RowIndex ?>_tahun" name="x<?php echo $t_pweb_list->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_list->tahun->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_pweb_tahun" class="form-group t_pweb_tahun">
<input type="text" data-table="t_pweb" data-field="x_tahun" name="x<?php echo $t_pweb_list->RowIndex ?>_tahun" id="x<?php echo $t_pweb_list->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pweb_list->tahun->getPlaceHolder()) ?>" value="<?php echo $t_pweb_list->tahun->EditValue ?>"<?php echo $t_pweb_list->tahun->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="o<?php echo $t_pweb_list->RowIndex ?>_tahun" id="o<?php echo $t_pweb_list->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_list->tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_list->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi">
<span id="el$rowindex$_t_pweb_kdinformasi" class="form-group t_pweb_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pweb" data-field="x_kdinformasi" data-value-separator="<?php echo $t_pweb_list->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pweb_list->RowIndex ?>_kdinformasi" name="x<?php echo $t_pweb_list->RowIndex ?>_kdinformasi"<?php echo $t_pweb_list->kdinformasi->editAttributes() ?>>
			<?php echo $t_pweb_list->kdinformasi->selectOptionListHtml("x{$t_pweb_list->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $t_pweb_list->kdinformasi->Lookup->getParamTag($t_pweb_list, "p_x" . $t_pweb_list->RowIndex . "_kdinformasi") ?>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="o<?php echo $t_pweb_list->RowIndex ?>_kdinformasi" id="o<?php echo $t_pweb_list->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_list->kdinformasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_list->harapan->Visible) { // harapan ?>
		<td data-name="harapan">
<span id="el$rowindex$_t_pweb_harapan" class="form-group t_pweb_harapan">
<textarea data-table="t_pweb" data-field="x_harapan" name="x<?php echo $t_pweb_list->RowIndex ?>_harapan" id="x<?php echo $t_pweb_list->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_pweb_list->harapan->getPlaceHolder()) ?>"<?php echo $t_pweb_list->harapan->editAttributes() ?>><?php echo $t_pweb_list->harapan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="o<?php echo $t_pweb_list->RowIndex ?>_harapan" id="o<?php echo $t_pweb_list->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_list->harapan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_list->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat">
<span id="el$rowindex$_t_pweb_sertifikat" class="form-group t_pweb_sertifikat">
<input type="text" data-table="t_pweb" data-field="x_sertifikat" name="x<?php echo $t_pweb_list->RowIndex ?>_sertifikat" id="x<?php echo $t_pweb_list->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pweb_list->sertifikat->getPlaceHolder()) ?>" value="<?php echo $t_pweb_list->sertifikat->EditValue ?>"<?php echo $t_pweb_list->sertifikat->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="o<?php echo $t_pweb_list->RowIndex ?>_sertifikat" id="o<?php echo $t_pweb_list->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_list->sertifikat->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pweb_list->ListOptions->render("body", "right", $t_pweb_list->RowIndex);
?>
<script>
loadjs.ready(["ft_pweblist", "load"], function() {
	ft_pweblist.updateLists(<?php echo $t_pweb_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_pweb_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $t_pweb_list->FormKeyCountName ?>" id="<?php echo $t_pweb_list->FormKeyCountName ?>" value="<?php echo $t_pweb_list->KeyCount ?>">
<?php echo $t_pweb_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$t_pweb->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_pweb_list->Recordset)
	$t_pweb_list->Recordset->Close();
?>
<?php if (!$t_pweb_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_pweb_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pweb_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pweb_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_pweb_list->TotalRecords == 0 && !$t_pweb->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_pweb_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_pweb_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_pweb_list->isExport()) { ?>
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
$t_pweb_list->terminate();
?>