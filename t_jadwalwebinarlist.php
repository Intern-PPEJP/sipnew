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
$t_jadwalwebinar_list = new t_jadwalwebinar_list();

// Run the page
$t_jadwalwebinar_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jadwalwebinar_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_jadwalwebinar_list->isExport()) { ?>
<script>
var ft_jadwalwebinarlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_jadwalwebinarlist = currentForm = new ew.Form("ft_jadwalwebinarlist", "list");
	ft_jadwalwebinarlist.formKeyCountName = '<?php echo $t_jadwalwebinar_list->FormKeyCountName ?>';

	// Validate form
	ft_jadwalwebinarlist.validate = function() {
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
			<?php if ($t_jadwalwebinar_list->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_list->tgl->caption(), $t_jadwalwebinar_list->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_list->tgl->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_list->jam->Required) { ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_list->jam->caption(), $t_jadwalwebinar_list->jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_list->jam->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_list->jam_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_list->jam_akhir->caption(), $t_jadwalwebinar_list->jam_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_list->jam_akhir->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_list->materi->Required) { ?>
				elm = this.getElements("x" + infix + "_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_list->materi->caption(), $t_jadwalwebinar_list->materi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_list->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_list->instruktur->caption(), $t_jadwalwebinar_list->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_list->instruktur->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_list->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_list->instansi->caption(), $t_jadwalwebinar_list->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_list->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_list->ket->caption(), $t_jadwalwebinar_list->ket->RequiredErrorMessage)) ?>");
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
	ft_jadwalwebinarlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "tgl", false)) return false;
		if (ew.valueChanged(fobj, infix, "jam", false)) return false;
		if (ew.valueChanged(fobj, infix, "jam_akhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "materi", false)) return false;
		if (ew.valueChanged(fobj, infix, "instruktur", false)) return false;
		if (ew.valueChanged(fobj, infix, "instansi", false)) return false;
		if (ew.valueChanged(fobj, infix, "ket", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_jadwalwebinarlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jadwalwebinarlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_jadwalwebinarlist");
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
<?php if (!$t_jadwalwebinar_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_jadwalwebinar_list->TotalRecords > 0 && $t_jadwalwebinar_list->ExportOptions->visible()) { ?>
<?php $t_jadwalwebinar_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_jadwalwebinar_list->ImportOptions->visible()) { ?>
<?php $t_jadwalwebinar_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_jadwalwebinar_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_jadwalwebinar_list->isExport("print")) { ?>
<?php
if ($t_jadwalwebinar_list->DbMasterFilter != "" && $t_jadwalwebinar->getCurrentMasterTable() == "webinar") {
	if ($t_jadwalwebinar_list->MasterRecordExists) {
		include_once "webinarmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_jadwalwebinar_list->renderOtherOptions();
?>
<?php $t_jadwalwebinar_list->showPageHeader(); ?>
<?php
$t_jadwalwebinar_list->showMessage();
?>
<?php if ($t_jadwalwebinar_list->TotalRecords > 0 || $t_jadwalwebinar->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_jadwalwebinar_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_jadwalwebinar">
<?php if (!$t_jadwalwebinar_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_jadwalwebinar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jadwalwebinar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jadwalwebinar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_jadwalwebinarlist" id="ft_jadwalwebinarlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jadwalwebinar">
<?php if ($t_jadwalwebinar->getCurrentMasterTable() == "webinar" && $t_jadwalwebinar->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="webinar">
<input type="hidden" name="fk_rkwid" value="<?php echo HtmlEncode($t_jadwalwebinar_list->idpelat->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_jadwalwebinar" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_jadwalwebinar_list->TotalRecords > 0 || $t_jadwalwebinar_list->isGridEdit()) { ?>
<table id="tbl_t_jadwalwebinarlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_jadwalwebinar->RowType = ROWTYPE_HEADER;

// Render list options
$t_jadwalwebinar_list->renderListOptions();

// Render list options (header, left)
$t_jadwalwebinar_list->ListOptions->render("header", "left");
?>
<?php if ($t_jadwalwebinar_list->tgl->Visible) { // tgl ?>
	<?php if ($t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $t_jadwalwebinar_list->tgl->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_tgl" class="t_jadwalwebinar_tgl"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $t_jadwalwebinar_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->tgl) ?>', 1);"><div id="elh_t_jadwalwebinar_tgl" class="t_jadwalwebinar_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_list->jam->Visible) { // jam ?>
	<?php if ($t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->jam) == "") { ?>
		<th data-name="jam" class="<?php echo $t_jadwalwebinar_list->jam->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_jam" class="t_jadwalwebinar_jam"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->jam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam" class="<?php echo $t_jadwalwebinar_list->jam->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->jam) ?>', 1);"><div id="elh_t_jadwalwebinar_jam" class="t_jadwalwebinar_jam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->jam->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_list->jam->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_list->jam->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_list->jam_akhir->Visible) { // jam_akhir ?>
	<?php if ($t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->jam_akhir) == "") { ?>
		<th data-name="jam_akhir" class="<?php echo $t_jadwalwebinar_list->jam_akhir->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_jam_akhir" class="t_jadwalwebinar_jam_akhir"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->jam_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_akhir" class="<?php echo $t_jadwalwebinar_list->jam_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->jam_akhir) ?>', 1);"><div id="elh_t_jadwalwebinar_jam_akhir" class="t_jadwalwebinar_jam_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->jam_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_list->jam_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_list->jam_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_list->materi->Visible) { // materi ?>
	<?php if ($t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->materi) == "") { ?>
		<th data-name="materi" class="<?php echo $t_jadwalwebinar_list->materi->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_materi" class="t_jadwalwebinar_materi"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->materi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="materi" class="<?php echo $t_jadwalwebinar_list->materi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->materi) ?>', 1);"><div id="elh_t_jadwalwebinar_materi" class="t_jadwalwebinar_materi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->materi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_list->materi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_list->materi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_list->instruktur->Visible) { // instruktur ?>
	<?php if ($t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->instruktur) == "") { ?>
		<th data-name="instruktur" class="<?php echo $t_jadwalwebinar_list->instruktur->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_instruktur" class="t_jadwalwebinar_instruktur"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->instruktur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instruktur" class="<?php echo $t_jadwalwebinar_list->instruktur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->instruktur) ?>', 1);"><div id="elh_t_jadwalwebinar_instruktur" class="t_jadwalwebinar_instruktur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->instruktur->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_list->instruktur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_list->instruktur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_list->instansi->Visible) { // instansi ?>
	<?php if ($t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->instansi) == "") { ?>
		<th data-name="instansi" class="<?php echo $t_jadwalwebinar_list->instansi->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_instansi" class="t_jadwalwebinar_instansi"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->instansi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instansi" class="<?php echo $t_jadwalwebinar_list->instansi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->instansi) ?>', 1);"><div id="elh_t_jadwalwebinar_instansi" class="t_jadwalwebinar_instansi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->instansi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_list->instansi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_list->instansi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_list->ket->Visible) { // ket ?>
	<?php if ($t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $t_jadwalwebinar_list->ket->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_ket" class="t_jadwalwebinar_ket"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $t_jadwalwebinar_list->ket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalwebinar_list->SortUrl($t_jadwalwebinar_list->ket) ?>', 1);"><div id="elh_t_jadwalwebinar_ket" class="t_jadwalwebinar_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_list->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_list->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_list->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_jadwalwebinar_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_jadwalwebinar_list->ExportAll && $t_jadwalwebinar_list->isExport()) {
	$t_jadwalwebinar_list->StopRecord = $t_jadwalwebinar_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_jadwalwebinar_list->TotalRecords > $t_jadwalwebinar_list->StartRecord + $t_jadwalwebinar_list->DisplayRecords - 1)
		$t_jadwalwebinar_list->StopRecord = $t_jadwalwebinar_list->StartRecord + $t_jadwalwebinar_list->DisplayRecords - 1;
	else
		$t_jadwalwebinar_list->StopRecord = $t_jadwalwebinar_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($t_jadwalwebinar->isConfirm() || $t_jadwalwebinar_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_jadwalwebinar_list->FormKeyCountName) && ($t_jadwalwebinar_list->isGridAdd() || $t_jadwalwebinar_list->isGridEdit() || $t_jadwalwebinar->isConfirm())) {
		$t_jadwalwebinar_list->KeyCount = $CurrentForm->getValue($t_jadwalwebinar_list->FormKeyCountName);
		$t_jadwalwebinar_list->StopRecord = $t_jadwalwebinar_list->StartRecord + $t_jadwalwebinar_list->KeyCount - 1;
	}
}
$t_jadwalwebinar_list->RecordCount = $t_jadwalwebinar_list->StartRecord - 1;
if ($t_jadwalwebinar_list->Recordset && !$t_jadwalwebinar_list->Recordset->EOF) {
	$t_jadwalwebinar_list->Recordset->moveFirst();
	$selectLimit = $t_jadwalwebinar_list->UseSelectLimit;
	if (!$selectLimit && $t_jadwalwebinar_list->StartRecord > 1)
		$t_jadwalwebinar_list->Recordset->move($t_jadwalwebinar_list->StartRecord - 1);
} elseif (!$t_jadwalwebinar->AllowAddDeleteRow && $t_jadwalwebinar_list->StopRecord == 0) {
	$t_jadwalwebinar_list->StopRecord = $t_jadwalwebinar->GridAddRowCount;
}

// Initialize aggregate
$t_jadwalwebinar->RowType = ROWTYPE_AGGREGATEINIT;
$t_jadwalwebinar->resetAttributes();
$t_jadwalwebinar_list->renderRow();
if ($t_jadwalwebinar_list->isGridAdd())
	$t_jadwalwebinar_list->RowIndex = 0;
while ($t_jadwalwebinar_list->RecordCount < $t_jadwalwebinar_list->StopRecord) {
	$t_jadwalwebinar_list->RecordCount++;
	if ($t_jadwalwebinar_list->RecordCount >= $t_jadwalwebinar_list->StartRecord) {
		$t_jadwalwebinar_list->RowCount++;
		if ($t_jadwalwebinar_list->isGridAdd() || $t_jadwalwebinar_list->isGridEdit() || $t_jadwalwebinar->isConfirm()) {
			$t_jadwalwebinar_list->RowIndex++;
			$CurrentForm->Index = $t_jadwalwebinar_list->RowIndex;
			if ($CurrentForm->hasValue($t_jadwalwebinar_list->FormActionName) && ($t_jadwalwebinar->isConfirm() || $t_jadwalwebinar_list->EventCancelled))
				$t_jadwalwebinar_list->RowAction = strval($CurrentForm->getValue($t_jadwalwebinar_list->FormActionName));
			elseif ($t_jadwalwebinar_list->isGridAdd())
				$t_jadwalwebinar_list->RowAction = "insert";
			else
				$t_jadwalwebinar_list->RowAction = "";
		}

		// Set up key count
		$t_jadwalwebinar_list->KeyCount = $t_jadwalwebinar_list->RowIndex;

		// Init row class and style
		$t_jadwalwebinar->resetAttributes();
		$t_jadwalwebinar->CssClass = "";
		if ($t_jadwalwebinar_list->isGridAdd()) {
			$t_jadwalwebinar_list->loadRowValues(); // Load default values
		} else {
			$t_jadwalwebinar_list->loadRowValues($t_jadwalwebinar_list->Recordset); // Load row values
		}
		$t_jadwalwebinar->RowType = ROWTYPE_VIEW; // Render view
		if ($t_jadwalwebinar_list->isGridAdd()) // Grid add
			$t_jadwalwebinar->RowType = ROWTYPE_ADD; // Render add
		if ($t_jadwalwebinar_list->isGridAdd() && $t_jadwalwebinar->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_jadwalwebinar_list->restoreCurrentRowFormValues($t_jadwalwebinar_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_jadwalwebinar->RowAttrs->merge(["data-rowindex" => $t_jadwalwebinar_list->RowCount, "id" => "r" . $t_jadwalwebinar_list->RowCount . "_t_jadwalwebinar", "data-rowtype" => $t_jadwalwebinar->RowType]);

		// Render row
		$t_jadwalwebinar_list->renderRow();

		// Render list options
		$t_jadwalwebinar_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_jadwalwebinar_list->RowAction != "delete" && $t_jadwalwebinar_list->RowAction != "insertdelete" && !($t_jadwalwebinar_list->RowAction == "insert" && $t_jadwalwebinar->isConfirm() && $t_jadwalwebinar_list->emptyRow())) {
?>
	<tr <?php echo $t_jadwalwebinar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalwebinar_list->ListOptions->render("body", "left", $t_jadwalwebinar_list->RowCount);
?>
	<?php if ($t_jadwalwebinar_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $t_jadwalwebinar_list->tgl->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_tgl" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_tgl" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->tgl->EditValue ?>"<?php echo $t_jadwalwebinar_list->tgl->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_list->tgl->ReadOnly && !$t_jadwalwebinar_list->tgl->Disabled && !isset($t_jadwalwebinar_list->tgl->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_list->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinarlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalwebinarlist", "x<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_list->tgl->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_tgl">
<span<?php echo $t_jadwalwebinar_list->tgl->viewAttributes() ?>><?php echo $t_jadwalwebinar_list->tgl->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->jam->Visible) { // jam ?>
		<td data-name="jam" <?php echo $t_jadwalwebinar_list->jam->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_jam" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->jam->EditValue ?>"<?php echo $t_jadwalwebinar_list->jam->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_list->jam->ReadOnly && !$t_jadwalwebinar_list->jam->Disabled && !isset($t_jadwalwebinar_list->jam->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_list->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinarlist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinarlist", "x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_list->jam->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_jam">
<span<?php echo $t_jadwalwebinar_list->jam->viewAttributes() ?>><?php echo $t_jadwalwebinar_list->jam->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir" <?php echo $t_jadwalwebinar_list->jam_akhir->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_jam_akhir" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->jam_akhir->EditValue ?>"<?php echo $t_jadwalwebinar_list->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_list->jam_akhir->ReadOnly && !$t_jadwalwebinar_list->jam_akhir->Disabled && !isset($t_jadwalwebinar_list->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_list->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinarlist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinarlist", "x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_list->jam_akhir->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_jam_akhir">
<span<?php echo $t_jadwalwebinar_list->jam_akhir->viewAttributes() ?>><?php echo $t_jadwalwebinar_list->jam_akhir->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->materi->Visible) { // materi ?>
		<td data-name="materi" <?php echo $t_jadwalwebinar_list->materi->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_materi" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_materi" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_materi" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_materi" size="50" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->materi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->materi->EditValue ?>"<?php echo $t_jadwalwebinar_list->materi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_materi" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_list->materi->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_materi">
<span<?php echo $t_jadwalwebinar_list->materi->viewAttributes() ?>><?php echo $t_jadwalwebinar_list->materi->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur" <?php echo $t_jadwalwebinar_list->instruktur->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_instruktur" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instruktur" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_instruktur" size="30" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->instruktur->EditValue ?>"<?php echo $t_jadwalwebinar_list->instruktur->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_list->instruktur->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_instruktur">
<span<?php echo $t_jadwalwebinar_list->instruktur->viewAttributes() ?>><?php echo $t_jadwalwebinar_list->instruktur->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->instansi->Visible) { // instansi ?>
		<td data-name="instansi" <?php echo $t_jadwalwebinar_list->instansi->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_instansi" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instansi" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_instansi" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->instansi->EditValue ?>"<?php echo $t_jadwalwebinar_list->instansi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_instansi" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_list->instansi->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_instansi">
<span<?php echo $t_jadwalwebinar_list->instansi->viewAttributes() ?>><?php echo $t_jadwalwebinar_list->instansi->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $t_jadwalwebinar_list->ket->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_ket" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_ket" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_ket" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->ket->EditValue ?>"<?php echo $t_jadwalwebinar_list->ket->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_ket" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_list->ket->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_list->RowCount ?>_t_jadwalwebinar_ket">
<span<?php echo $t_jadwalwebinar_list->ket->viewAttributes() ?>><?php echo $t_jadwalwebinar_list->ket->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalwebinar_list->ListOptions->render("body", "right", $t_jadwalwebinar_list->RowCount);
?>
	</tr>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD || $t_jadwalwebinar->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_jadwalwebinarlist", "load"], function() {
	ft_jadwalwebinarlist.updateLists(<?php echo $t_jadwalwebinar_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_jadwalwebinar_list->isGridAdd())
		if (!$t_jadwalwebinar_list->Recordset->EOF)
			$t_jadwalwebinar_list->Recordset->moveNext();
}
?>
<?php
	if ($t_jadwalwebinar_list->isGridAdd() || $t_jadwalwebinar_list->isGridEdit()) {
		$t_jadwalwebinar_list->RowIndex = '$rowindex$';
		$t_jadwalwebinar_list->loadRowValues();

		// Set row properties
		$t_jadwalwebinar->resetAttributes();
		$t_jadwalwebinar->RowAttrs->merge(["data-rowindex" => $t_jadwalwebinar_list->RowIndex, "id" => "r0_t_jadwalwebinar", "data-rowtype" => ROWTYPE_ADD]);
		$t_jadwalwebinar->RowAttrs->appendClass("ew-template");
		$t_jadwalwebinar->RowType = ROWTYPE_ADD;

		// Render row
		$t_jadwalwebinar_list->renderRow();

		// Render list options
		$t_jadwalwebinar_list->renderListOptions();
		$t_jadwalwebinar_list->StartRowCount = 0;
?>
	<tr <?php echo $t_jadwalwebinar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalwebinar_list->ListOptions->render("body", "left", $t_jadwalwebinar_list->RowIndex);
?>
	<?php if ($t_jadwalwebinar_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<span id="el$rowindex$_t_jadwalwebinar_tgl" class="form-group t_jadwalwebinar_tgl">
<input type="text" data-table="t_jadwalwebinar" data-field="x_tgl" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->tgl->EditValue ?>"<?php echo $t_jadwalwebinar_list->tgl->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_list->tgl->ReadOnly && !$t_jadwalwebinar_list->tgl->Disabled && !isset($t_jadwalwebinar_list->tgl->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_list->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinarlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalwebinarlist", "x<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_list->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->jam->Visible) { // jam ?>
		<td data-name="jam">
<span id="el$rowindex$_t_jadwalwebinar_jam" class="form-group t_jadwalwebinar_jam">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->jam->EditValue ?>"<?php echo $t_jadwalwebinar_list->jam->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_list->jam->ReadOnly && !$t_jadwalwebinar_list->jam->Disabled && !isset($t_jadwalwebinar_list->jam->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_list->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinarlist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinarlist", "x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_list->jam->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir">
<span id="el$rowindex$_t_jadwalwebinar_jam_akhir" class="form-group t_jadwalwebinar_jam_akhir">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->jam_akhir->EditValue ?>"<?php echo $t_jadwalwebinar_list->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_list->jam_akhir->ReadOnly && !$t_jadwalwebinar_list->jam_akhir->Disabled && !isset($t_jadwalwebinar_list->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_list->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinarlist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinarlist", "x<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_list->jam_akhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->materi->Visible) { // materi ?>
		<td data-name="materi">
<span id="el$rowindex$_t_jadwalwebinar_materi" class="form-group t_jadwalwebinar_materi">
<input type="text" data-table="t_jadwalwebinar" data-field="x_materi" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_materi" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_materi" size="50" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->materi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->materi->EditValue ?>"<?php echo $t_jadwalwebinar_list->materi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_materi" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_list->materi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur">
<span id="el$rowindex$_t_jadwalwebinar_instruktur" class="form-group t_jadwalwebinar_instruktur">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instruktur" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_instruktur" size="30" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->instruktur->EditValue ?>"<?php echo $t_jadwalwebinar_list->instruktur->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_list->instruktur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->instansi->Visible) { // instansi ?>
		<td data-name="instansi">
<span id="el$rowindex$_t_jadwalwebinar_instansi" class="form-group t_jadwalwebinar_instansi">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instansi" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_instansi" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->instansi->EditValue ?>"<?php echo $t_jadwalwebinar_list->instansi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_instansi" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_list->instansi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_list->ket->Visible) { // ket ?>
		<td data-name="ket">
<span id="el$rowindex$_t_jadwalwebinar_ket" class="form-group t_jadwalwebinar_ket">
<input type="text" data-table="t_jadwalwebinar" data-field="x_ket" name="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_ket" id="x<?php echo $t_jadwalwebinar_list->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_list->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_list->ket->EditValue ?>"<?php echo $t_jadwalwebinar_list->ket->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_ket" id="o<?php echo $t_jadwalwebinar_list->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_list->ket->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalwebinar_list->ListOptions->render("body", "right", $t_jadwalwebinar_list->RowIndex);
?>
<script>
loadjs.ready(["ft_jadwalwebinarlist", "load"], function() {
	ft_jadwalwebinarlist.updateLists(<?php echo $t_jadwalwebinar_list->RowIndex ?>);
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
<?php if ($t_jadwalwebinar_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $t_jadwalwebinar_list->FormKeyCountName ?>" id="<?php echo $t_jadwalwebinar_list->FormKeyCountName ?>" value="<?php echo $t_jadwalwebinar_list->KeyCount ?>">
<?php echo $t_jadwalwebinar_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$t_jadwalwebinar->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_jadwalwebinar_list->Recordset)
	$t_jadwalwebinar_list->Recordset->Close();
?>
<?php if (!$t_jadwalwebinar_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_jadwalwebinar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jadwalwebinar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jadwalwebinar_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_jadwalwebinar_list->TotalRecords == 0 && !$t_jadwalwebinar->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_jadwalwebinar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_jadwalwebinar_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_jadwalwebinar_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$t_jadwalwebinar->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_jadwalwebinar",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_jadwalwebinar_list->terminate();
?>