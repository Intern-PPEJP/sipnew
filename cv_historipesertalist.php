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
$cv_historipeserta_list = new cv_historipeserta_list();

// Run the page
$cv_historipeserta_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipeserta_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cv_historipeserta_list->isExport()) { ?>
<script>
var fcv_historipesertalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcv_historipesertalist = currentForm = new ew.Form("fcv_historipesertalist", "list");
	fcv_historipesertalist.formKeyCountName = '<?php echo $cv_historipeserta_list->FormKeyCountName ?>';

	// Validate form
	fcv_historipesertalist.validate = function() {
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
			<?php if ($cv_historipeserta_list->kdhistori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdhistori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_list->kdhistori->caption(), $cv_historipeserta_list->kdhistori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_list->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_list->kdpelat->caption(), $cv_historipeserta_list->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_list->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_list->id->caption(), $cv_historipeserta_list->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipeserta_list->id->errorMessage()) ?>");
			<?php if ($cv_historipeserta_list->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_list->tahun->caption(), $cv_historipeserta_list->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipeserta_list->tahun->errorMessage()) ?>");
			<?php if ($cv_historipeserta_list->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_list->kdinformasi->caption(), $cv_historipeserta_list->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_list->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_list->harapan->caption(), $cv_historipeserta_list->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_list->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_list->sertifikat->caption(), $cv_historipeserta_list->sertifikat->RequiredErrorMessage)) ?>");
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
	fcv_historipesertalist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kdpelat", false)) return false;
		if (ew.valueChanged(fobj, infix, "id", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdinformasi", false)) return false;
		if (ew.valueChanged(fobj, infix, "harapan", false)) return false;
		if (ew.valueChanged(fobj, infix, "sertifikat", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcv_historipesertalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_historipesertalist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_historipesertalist.lists["x_id"] = <?php echo $cv_historipeserta_list->id->Lookup->toClientList($cv_historipeserta_list) ?>;
	fcv_historipesertalist.lists["x_id"].options = <?php echo JsonEncode($cv_historipeserta_list->id->lookupOptions()) ?>;
	fcv_historipesertalist.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_historipesertalist.lists["x_kdinformasi"] = <?php echo $cv_historipeserta_list->kdinformasi->Lookup->toClientList($cv_historipeserta_list) ?>;
	fcv_historipesertalist.lists["x_kdinformasi"].options = <?php echo JsonEncode($cv_historipeserta_list->kdinformasi->lookupOptions()) ?>;
	loadjs.done("fcv_historipesertalist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cv_historipeserta_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cv_historipeserta_list->TotalRecords > 0 && $cv_historipeserta_list->ExportOptions->visible()) { ?>
<?php $cv_historipeserta_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_historipeserta_list->ImportOptions->visible()) { ?>
<?php $cv_historipeserta_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$cv_historipeserta_list->isExport() || Config("EXPORT_MASTER_RECORD") && $cv_historipeserta_list->isExport("print")) { ?>
<?php
if ($cv_historipeserta_list->DbMasterFilter != "" && $cv_historipeserta->getCurrentMasterTable() == "t_pelatihan") {
	if ($cv_historipeserta_list->MasterRecordExists) {
		include_once "t_pelatihanmaster.php";
	}
}
?>
<?php } ?>
<?php
$cv_historipeserta_list->renderOtherOptions();
?>
<?php $cv_historipeserta_list->showPageHeader(); ?>
<?php
$cv_historipeserta_list->showMessage();
?>
<?php if ($cv_historipeserta_list->TotalRecords > 0 || $cv_historipeserta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_historipeserta_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_historipeserta">
<?php if (!$cv_historipeserta_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cv_historipeserta_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_historipeserta_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_historipeserta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcv_historipesertalist" id="fcv_historipesertalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historipeserta">
<?php if ($cv_historipeserta->getCurrentMasterTable() == "t_pelatihan" && $cv_historipeserta->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pelatihan">
<input type="hidden" name="fk_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_list->kdpelat->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_cv_historipeserta" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cv_historipeserta_list->TotalRecords > 0 || $cv_historipeserta_list->isGridEdit()) { ?>
<table id="tbl_cv_historipesertalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_historipeserta->RowType = ROWTYPE_HEADER;

// Render list options
$cv_historipeserta_list->renderListOptions();

// Render list options (header, left)
$cv_historipeserta_list->ListOptions->render("header", "left");
?>
<?php if ($cv_historipeserta_list->kdhistori->Visible) { // kdhistori ?>
	<?php if ($cv_historipeserta_list->SortUrl($cv_historipeserta_list->kdhistori) == "") { ?>
		<th data-name="kdhistori" class="<?php echo $cv_historipeserta_list->kdhistori->headerCellClass() ?>"><div id="elh_cv_historipeserta_kdhistori" class="cv_historipeserta_kdhistori"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_list->kdhistori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdhistori" class="<?php echo $cv_historipeserta_list->kdhistori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipeserta_list->SortUrl($cv_historipeserta_list->kdhistori) ?>', 1);"><div id="elh_cv_historipeserta_kdhistori" class="cv_historipeserta_kdhistori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_list->kdhistori->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_list->kdhistori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_list->kdhistori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($cv_historipeserta_list->SortUrl($cv_historipeserta_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $cv_historipeserta_list->kdpelat->headerCellClass() ?>"><div id="elh_cv_historipeserta_kdpelat" class="cv_historipeserta_kdpelat"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $cv_historipeserta_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipeserta_list->SortUrl($cv_historipeserta_list->kdpelat) ?>', 1);"><div id="elh_cv_historipeserta_kdpelat" class="cv_historipeserta_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_list->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_list->id->Visible) { // id ?>
	<?php if ($cv_historipeserta_list->SortUrl($cv_historipeserta_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $cv_historipeserta_list->id->headerCellClass() ?>"><div id="elh_cv_historipeserta_id" class="cv_historipeserta_id"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $cv_historipeserta_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipeserta_list->SortUrl($cv_historipeserta_list->id) ?>', 1);"><div id="elh_cv_historipeserta_id" class="cv_historipeserta_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_list->tahun->Visible) { // tahun ?>
	<?php if ($cv_historipeserta_list->SortUrl($cv_historipeserta_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $cv_historipeserta_list->tahun->headerCellClass() ?>"><div id="elh_cv_historipeserta_tahun" class="cv_historipeserta_tahun"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $cv_historipeserta_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipeserta_list->SortUrl($cv_historipeserta_list->tahun) ?>', 1);"><div id="elh_cv_historipeserta_tahun" class="cv_historipeserta_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_list->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($cv_historipeserta_list->SortUrl($cv_historipeserta_list->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $cv_historipeserta_list->kdinformasi->headerCellClass() ?>"><div id="elh_cv_historipeserta_kdinformasi" class="cv_historipeserta_kdinformasi"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_list->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $cv_historipeserta_list->kdinformasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipeserta_list->SortUrl($cv_historipeserta_list->kdinformasi) ?>', 1);"><div id="elh_cv_historipeserta_kdinformasi" class="cv_historipeserta_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_list->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_list->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_list->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_list->harapan->Visible) { // harapan ?>
	<?php if ($cv_historipeserta_list->SortUrl($cv_historipeserta_list->harapan) == "") { ?>
		<th data-name="harapan" class="<?php echo $cv_historipeserta_list->harapan->headerCellClass() ?>"><div id="elh_cv_historipeserta_harapan" class="cv_historipeserta_harapan"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_list->harapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harapan" class="<?php echo $cv_historipeserta_list->harapan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipeserta_list->SortUrl($cv_historipeserta_list->harapan) ?>', 1);"><div id="elh_cv_historipeserta_harapan" class="cv_historipeserta_harapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_list->harapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_list->harapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_list->harapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_list->sertifikat->Visible) { // sertifikat ?>
	<?php if ($cv_historipeserta_list->SortUrl($cv_historipeserta_list->sertifikat) == "") { ?>
		<th data-name="sertifikat" class="<?php echo $cv_historipeserta_list->sertifikat->headerCellClass() ?>"><div id="elh_cv_historipeserta_sertifikat" class="cv_historipeserta_sertifikat"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_list->sertifikat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat" class="<?php echo $cv_historipeserta_list->sertifikat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipeserta_list->SortUrl($cv_historipeserta_list->sertifikat) ?>', 1);"><div id="elh_cv_historipeserta_sertifikat" class="cv_historipeserta_sertifikat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_list->sertifikat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_list->sertifikat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_list->sertifikat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_historipeserta_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cv_historipeserta_list->ExportAll && $cv_historipeserta_list->isExport()) {
	$cv_historipeserta_list->StopRecord = $cv_historipeserta_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cv_historipeserta_list->TotalRecords > $cv_historipeserta_list->StartRecord + $cv_historipeserta_list->DisplayRecords - 1)
		$cv_historipeserta_list->StopRecord = $cv_historipeserta_list->StartRecord + $cv_historipeserta_list->DisplayRecords - 1;
	else
		$cv_historipeserta_list->StopRecord = $cv_historipeserta_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($cv_historipeserta->isConfirm() || $cv_historipeserta_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($cv_historipeserta_list->FormKeyCountName) && ($cv_historipeserta_list->isGridAdd() || $cv_historipeserta_list->isGridEdit() || $cv_historipeserta->isConfirm())) {
		$cv_historipeserta_list->KeyCount = $CurrentForm->getValue($cv_historipeserta_list->FormKeyCountName);
		$cv_historipeserta_list->StopRecord = $cv_historipeserta_list->StartRecord + $cv_historipeserta_list->KeyCount - 1;
	}
}
$cv_historipeserta_list->RecordCount = $cv_historipeserta_list->StartRecord - 1;
if ($cv_historipeserta_list->Recordset && !$cv_historipeserta_list->Recordset->EOF) {
	$cv_historipeserta_list->Recordset->moveFirst();
	$selectLimit = $cv_historipeserta_list->UseSelectLimit;
	if (!$selectLimit && $cv_historipeserta_list->StartRecord > 1)
		$cv_historipeserta_list->Recordset->move($cv_historipeserta_list->StartRecord - 1);
} elseif (!$cv_historipeserta->AllowAddDeleteRow && $cv_historipeserta_list->StopRecord == 0) {
	$cv_historipeserta_list->StopRecord = $cv_historipeserta->GridAddRowCount;
}

// Initialize aggregate
$cv_historipeserta->RowType = ROWTYPE_AGGREGATEINIT;
$cv_historipeserta->resetAttributes();
$cv_historipeserta_list->renderRow();
if ($cv_historipeserta_list->isGridAdd())
	$cv_historipeserta_list->RowIndex = 0;
while ($cv_historipeserta_list->RecordCount < $cv_historipeserta_list->StopRecord) {
	$cv_historipeserta_list->RecordCount++;
	if ($cv_historipeserta_list->RecordCount >= $cv_historipeserta_list->StartRecord) {
		$cv_historipeserta_list->RowCount++;
		if ($cv_historipeserta_list->isGridAdd() || $cv_historipeserta_list->isGridEdit() || $cv_historipeserta->isConfirm()) {
			$cv_historipeserta_list->RowIndex++;
			$CurrentForm->Index = $cv_historipeserta_list->RowIndex;
			if ($CurrentForm->hasValue($cv_historipeserta_list->FormActionName) && ($cv_historipeserta->isConfirm() || $cv_historipeserta_list->EventCancelled))
				$cv_historipeserta_list->RowAction = strval($CurrentForm->getValue($cv_historipeserta_list->FormActionName));
			elseif ($cv_historipeserta_list->isGridAdd())
				$cv_historipeserta_list->RowAction = "insert";
			else
				$cv_historipeserta_list->RowAction = "";
		}

		// Set up key count
		$cv_historipeserta_list->KeyCount = $cv_historipeserta_list->RowIndex;

		// Init row class and style
		$cv_historipeserta->resetAttributes();
		$cv_historipeserta->CssClass = "";
		if ($cv_historipeserta_list->isGridAdd()) {
			$cv_historipeserta_list->loadRowValues(); // Load default values
		} else {
			$cv_historipeserta_list->loadRowValues($cv_historipeserta_list->Recordset); // Load row values
		}
		$cv_historipeserta->RowType = ROWTYPE_VIEW; // Render view
		if ($cv_historipeserta_list->isGridAdd()) // Grid add
			$cv_historipeserta->RowType = ROWTYPE_ADD; // Render add
		if ($cv_historipeserta_list->isGridAdd() && $cv_historipeserta->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$cv_historipeserta_list->restoreCurrentRowFormValues($cv_historipeserta_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cv_historipeserta->RowAttrs->merge(["data-rowindex" => $cv_historipeserta_list->RowCount, "id" => "r" . $cv_historipeserta_list->RowCount . "_cv_historipeserta", "data-rowtype" => $cv_historipeserta->RowType]);

		// Render row
		$cv_historipeserta_list->renderRow();

		// Render list options
		$cv_historipeserta_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cv_historipeserta_list->RowAction != "delete" && $cv_historipeserta_list->RowAction != "insertdelete" && !($cv_historipeserta_list->RowAction == "insert" && $cv_historipeserta->isConfirm() && $cv_historipeserta_list->emptyRow())) {
?>
	<tr <?php echo $cv_historipeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historipeserta_list->ListOptions->render("body", "left", $cv_historipeserta_list->RowCount);
?>
	<?php if ($cv_historipeserta_list->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori" <?php echo $cv_historipeserta_list->kdhistori->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_kdhistori" class="form-group"></span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdhistori" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_list->kdhistori->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_kdhistori">
<span<?php echo $cv_historipeserta_list->kdhistori->viewAttributes() ?>><?php echo $cv_historipeserta_list->kdhistori->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $cv_historipeserta_list->kdpelat->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($cv_historipeserta_list->kdpelat->getSessionValue() != "") { ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_kdpelat" class="form-group">
<span<?php echo $cv_historipeserta_list->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_list->kdpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_list->kdpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_kdpelat" class="form-group">
<input type="text" data-table="cv_historipeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->kdpelat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_list->kdpelat->EditValue ?>"<?php echo $cv_historipeserta_list->kdpelat->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_list->kdpelat->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_kdpelat">
<span<?php echo $cv_historipeserta_list->kdpelat->viewAttributes() ?>><?php echo $cv_historipeserta_list->kdpelat->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $cv_historipeserta_list->id->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_id" class="form-group">
<?php
$onchange = $cv_historipeserta_list->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipeserta_list->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipeserta_list->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $cv_historipeserta_list->RowIndex ?>_id" id="sv_x<?php echo $cv_historipeserta_list->RowIndex ?>_id" value="<?php echo RemoveHtml($cv_historipeserta_list->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipeserta_list->id->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_list->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipeserta_list->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $cv_historipeserta_list->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipeserta_list->id->ReadOnly || $cv_historipeserta_list->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipeserta_list->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_id" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_list->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipesertalist"], function() {
	fcv_historipesertalist.createAutoSuggest({"id":"x<?php echo $cv_historipeserta_list->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $cv_historipeserta_list->id->Lookup->getParamTag($cv_historipeserta_list, "p_x" . $cv_historipeserta_list->RowIndex . "_id") ?>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_id" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_list->id->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_id">
<span<?php echo $cv_historipeserta_list->id->viewAttributes() ?>><?php echo $cv_historipeserta_list->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $cv_historipeserta_list->tahun->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_tahun" class="form-group">
<input type="text" data-table="cv_historipeserta" data-field="x_tahun" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_tahun" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_list->tahun->EditValue ?>"<?php echo $cv_historipeserta_list->tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_tahun" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_list->tahun->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_tahun">
<span<?php echo $cv_historipeserta_list->tahun->viewAttributes() ?>><?php echo $cv_historipeserta_list->tahun->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $cv_historipeserta_list->kdinformasi->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipeserta_list->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdinformasi" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdinformasi"<?php echo $cv_historipeserta_list->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipeserta_list->kdinformasi->selectOptionListHtml("x{$cv_historipeserta_list->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipeserta_list->kdinformasi->Lookup->getParamTag($cv_historipeserta_list, "p_x" . $cv_historipeserta_list->RowIndex . "_kdinformasi") ?>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdinformasi" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_list->kdinformasi->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_kdinformasi">
<span<?php echo $cv_historipeserta_list->kdinformasi->viewAttributes() ?>><?php echo $cv_historipeserta_list->kdinformasi->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->harapan->Visible) { // harapan ?>
		<td data-name="harapan" <?php echo $cv_historipeserta_list->harapan->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_harapan" class="form-group">
<textarea data-table="cv_historipeserta" data-field="x_harapan" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_harapan" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_list->harapan->editAttributes() ?>><?php echo $cv_historipeserta_list->harapan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_harapan" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_list->harapan->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_harapan">
<span<?php echo $cv_historipeserta_list->harapan->viewAttributes() ?>><?php echo $cv_historipeserta_list->harapan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat" <?php echo $cv_historipeserta_list->sertifikat->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_sertifikat" class="form-group">
<input type="text" data-table="cv_historipeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_list->sertifikat->EditValue ?>"<?php echo $cv_historipeserta_list->sertifikat->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_sertifikat" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_list->sertifikat->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_list->RowCount ?>_cv_historipeserta_sertifikat">
<span<?php echo $cv_historipeserta_list->sertifikat->viewAttributes() ?>><?php echo $cv_historipeserta_list->sertifikat->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historipeserta_list->ListOptions->render("body", "right", $cv_historipeserta_list->RowCount);
?>
	</tr>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD || $cv_historipeserta->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcv_historipesertalist", "load"], function() {
	fcv_historipesertalist.updateLists(<?php echo $cv_historipeserta_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$cv_historipeserta_list->isGridAdd())
		if (!$cv_historipeserta_list->Recordset->EOF)
			$cv_historipeserta_list->Recordset->moveNext();
}
?>
<?php
	if ($cv_historipeserta_list->isGridAdd() || $cv_historipeserta_list->isGridEdit()) {
		$cv_historipeserta_list->RowIndex = '$rowindex$';
		$cv_historipeserta_list->loadRowValues();

		// Set row properties
		$cv_historipeserta->resetAttributes();
		$cv_historipeserta->RowAttrs->merge(["data-rowindex" => $cv_historipeserta_list->RowIndex, "id" => "r0_cv_historipeserta", "data-rowtype" => ROWTYPE_ADD]);
		$cv_historipeserta->RowAttrs->appendClass("ew-template");
		$cv_historipeserta->RowType = ROWTYPE_ADD;

		// Render row
		$cv_historipeserta_list->renderRow();

		// Render list options
		$cv_historipeserta_list->renderListOptions();
		$cv_historipeserta_list->StartRowCount = 0;
?>
	<tr <?php echo $cv_historipeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historipeserta_list->ListOptions->render("body", "left", $cv_historipeserta_list->RowIndex);
?>
	<?php if ($cv_historipeserta_list->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori">
<span id="el$rowindex$_cv_historipeserta_kdhistori" class="form-group cv_historipeserta_kdhistori"></span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdhistori" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_list->kdhistori->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat">
<?php if ($cv_historipeserta_list->kdpelat->getSessionValue() != "") { ?>
<span id="el$rowindex$_cv_historipeserta_kdpelat" class="form-group cv_historipeserta_kdpelat">
<span<?php echo $cv_historipeserta_list->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_list->kdpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_list->kdpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_kdpelat" class="form-group cv_historipeserta_kdpelat">
<input type="text" data-table="cv_historipeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->kdpelat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_list->kdpelat->EditValue ?>"<?php echo $cv_historipeserta_list->kdpelat->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_list->kdpelat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->id->Visible) { // id ?>
		<td data-name="id">
<span id="el$rowindex$_cv_historipeserta_id" class="form-group cv_historipeserta_id">
<?php
$onchange = $cv_historipeserta_list->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipeserta_list->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipeserta_list->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $cv_historipeserta_list->RowIndex ?>_id" id="sv_x<?php echo $cv_historipeserta_list->RowIndex ?>_id" value="<?php echo RemoveHtml($cv_historipeserta_list->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipeserta_list->id->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_list->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipeserta_list->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $cv_historipeserta_list->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipeserta_list->id->ReadOnly || $cv_historipeserta_list->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipeserta_list->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_id" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_list->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipesertalist"], function() {
	fcv_historipesertalist.createAutoSuggest({"id":"x<?php echo $cv_historipeserta_list->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $cv_historipeserta_list->id->Lookup->getParamTag($cv_historipeserta_list, "p_x" . $cv_historipeserta_list->RowIndex . "_id") ?>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_id" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_list->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun">
<span id="el$rowindex$_cv_historipeserta_tahun" class="form-group cv_historipeserta_tahun">
<input type="text" data-table="cv_historipeserta" data-field="x_tahun" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_tahun" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_list->tahun->EditValue ?>"<?php echo $cv_historipeserta_list->tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_tahun" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_list->tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi">
<span id="el$rowindex$_cv_historipeserta_kdinformasi" class="form-group cv_historipeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipeserta_list->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdinformasi" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_kdinformasi"<?php echo $cv_historipeserta_list->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipeserta_list->kdinformasi->selectOptionListHtml("x{$cv_historipeserta_list->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipeserta_list->kdinformasi->Lookup->getParamTag($cv_historipeserta_list, "p_x" . $cv_historipeserta_list->RowIndex . "_kdinformasi") ?>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdinformasi" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_list->kdinformasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->harapan->Visible) { // harapan ?>
		<td data-name="harapan">
<span id="el$rowindex$_cv_historipeserta_harapan" class="form-group cv_historipeserta_harapan">
<textarea data-table="cv_historipeserta" data-field="x_harapan" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_harapan" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_list->harapan->editAttributes() ?>><?php echo $cv_historipeserta_list->harapan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_harapan" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_list->harapan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_list->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat">
<span id="el$rowindex$_cv_historipeserta_sertifikat" class="form-group cv_historipeserta_sertifikat">
<input type="text" data-table="cv_historipeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipeserta_list->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipeserta_list->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipeserta_list->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_list->sertifikat->EditValue ?>"<?php echo $cv_historipeserta_list->sertifikat->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="o<?php echo $cv_historipeserta_list->RowIndex ?>_sertifikat" id="o<?php echo $cv_historipeserta_list->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_list->sertifikat->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historipeserta_list->ListOptions->render("body", "right", $cv_historipeserta_list->RowIndex);
?>
<script>
loadjs.ready(["fcv_historipesertalist", "load"], function() {
	fcv_historipesertalist.updateLists(<?php echo $cv_historipeserta_list->RowIndex ?>);
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
<?php if ($cv_historipeserta_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $cv_historipeserta_list->FormKeyCountName ?>" id="<?php echo $cv_historipeserta_list->FormKeyCountName ?>" value="<?php echo $cv_historipeserta_list->KeyCount ?>">
<?php echo $cv_historipeserta_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$cv_historipeserta->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_historipeserta_list->Recordset)
	$cv_historipeserta_list->Recordset->Close();
?>
<?php if (!$cv_historipeserta_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cv_historipeserta_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_historipeserta_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_historipeserta_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_historipeserta_list->TotalRecords == 0 && !$cv_historipeserta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_historipeserta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cv_historipeserta_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cv_historipeserta_list->isExport()) { ?>
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
$cv_historipeserta_list->terminate();
?>