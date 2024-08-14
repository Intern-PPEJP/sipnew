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
$t_jadwalpel_list = new t_jadwalpel_list();

// Run the page
$t_jadwalpel_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jadwalpel_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_jadwalpel_list->isExport()) { ?>
<script>
var ft_jadwalpellist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_jadwalpellist = currentForm = new ew.Form("ft_jadwalpellist", "list");
	ft_jadwalpellist.formKeyCountName = '<?php echo $t_jadwalpel_list->FormKeyCountName ?>';

	// Validate form
	ft_jadwalpellist.validate = function() {
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
			<?php if ($t_jadwalpel_list->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_list->tgl->caption(), $t_jadwalpel_list->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_list->tgl->errorMessage()) ?>");
			<?php if ($t_jadwalpel_list->jam->Required) { ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_list->jam->caption(), $t_jadwalpel_list->jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_list->jam->errorMessage()) ?>");
			<?php if ($t_jadwalpel_list->jam_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_list->jam_akhir->caption(), $t_jadwalpel_list->jam_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_list->jam_akhir->errorMessage()) ?>");
			<?php if ($t_jadwalpel_list->materi->Required) { ?>
				elm = this.getElements("x" + infix + "_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_list->materi->caption(), $t_jadwalpel_list->materi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_list->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_list->instruktur->caption(), $t_jadwalpel_list->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_list->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_list->instansi->caption(), $t_jadwalpel_list->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_list->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_list->ket->caption(), $t_jadwalpel_list->ket->RequiredErrorMessage)) ?>");
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
	ft_jadwalpellist.emptyRow = function(infix) {
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
	ft_jadwalpellist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jadwalpellist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_jadwalpellist.lists["x_materi"] = <?php echo $t_jadwalpel_list->materi->Lookup->toClientList($t_jadwalpel_list) ?>;
	ft_jadwalpellist.lists["x_materi"].options = <?php echo JsonEncode($t_jadwalpel_list->materi->lookupOptions()) ?>;
	ft_jadwalpellist.lists["x_instruktur"] = <?php echo $t_jadwalpel_list->instruktur->Lookup->toClientList($t_jadwalpel_list) ?>;
	ft_jadwalpellist.lists["x_instruktur"].options = <?php echo JsonEncode($t_jadwalpel_list->instruktur->lookupOptions()) ?>;
	loadjs.done("ft_jadwalpellist");
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
<?php if (!$t_jadwalpel_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_jadwalpel_list->TotalRecords > 0 && $t_jadwalpel_list->ExportOptions->visible()) { ?>
<?php $t_jadwalpel_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_jadwalpel_list->ImportOptions->visible()) { ?>
<?php $t_jadwalpel_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_jadwalpel_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_jadwalpel_list->isExport("print")) { ?>
<?php
if ($t_jadwalpel_list->DbMasterFilter != "" && $t_jadwalpel->getCurrentMasterTable() == "t_pelatihan") {
	if ($t_jadwalpel_list->MasterRecordExists) {
		include_once "t_pelatihanmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_jadwalpel_list->renderOtherOptions();
?>
<?php $t_jadwalpel_list->showPageHeader(); ?>
<?php
$t_jadwalpel_list->showMessage();
?>
<?php if ($t_jadwalpel_list->TotalRecords > 0 || $t_jadwalpel->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_jadwalpel_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_jadwalpel">
<?php if (!$t_jadwalpel_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_jadwalpel_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jadwalpel_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jadwalpel_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_jadwalpellist" id="ft_jadwalpellist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jadwalpel">
<?php if ($t_jadwalpel->getCurrentMasterTable() == "t_pelatihan" && $t_jadwalpel->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pelatihan">
<input type="hidden" name="fk_idpelat" value="<?php echo HtmlEncode($t_jadwalpel_list->idpelat->getSessionValue()) ?>">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_jadwalpel_list->kdjudul->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_jadwalpel" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_jadwalpel_list->TotalRecords > 0 || $t_jadwalpel_list->isAdd() || $t_jadwalpel_list->isCopy() || $t_jadwalpel_list->isGridEdit()) { ?>
<table id="tbl_t_jadwalpellist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_jadwalpel->RowType = ROWTYPE_HEADER;

// Render list options
$t_jadwalpel_list->renderListOptions();

// Render list options (header, left)
$t_jadwalpel_list->ListOptions->render("header", "left");
?>
<?php if ($t_jadwalpel_list->tgl->Visible) { // tgl ?>
	<?php if ($t_jadwalpel_list->SortUrl($t_jadwalpel_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $t_jadwalpel_list->tgl->headerCellClass() ?>"><div id="elh_t_jadwalpel_tgl" class="t_jadwalpel_tgl"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $t_jadwalpel_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalpel_list->SortUrl($t_jadwalpel_list->tgl) ?>', 1);"><div id="elh_t_jadwalpel_tgl" class="t_jadwalpel_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_list->jam->Visible) { // jam ?>
	<?php if ($t_jadwalpel_list->SortUrl($t_jadwalpel_list->jam) == "") { ?>
		<th data-name="jam" class="<?php echo $t_jadwalpel_list->jam->headerCellClass() ?>"><div id="elh_t_jadwalpel_jam" class="t_jadwalpel_jam"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_list->jam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam" class="<?php echo $t_jadwalpel_list->jam->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalpel_list->SortUrl($t_jadwalpel_list->jam) ?>', 1);"><div id="elh_t_jadwalpel_jam" class="t_jadwalpel_jam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_list->jam->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_list->jam->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_list->jam->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_list->jam_akhir->Visible) { // jam_akhir ?>
	<?php if ($t_jadwalpel_list->SortUrl($t_jadwalpel_list->jam_akhir) == "") { ?>
		<th data-name="jam_akhir" class="<?php echo $t_jadwalpel_list->jam_akhir->headerCellClass() ?>"><div id="elh_t_jadwalpel_jam_akhir" class="t_jadwalpel_jam_akhir"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_list->jam_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_akhir" class="<?php echo $t_jadwalpel_list->jam_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalpel_list->SortUrl($t_jadwalpel_list->jam_akhir) ?>', 1);"><div id="elh_t_jadwalpel_jam_akhir" class="t_jadwalpel_jam_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_list->jam_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_list->jam_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_list->jam_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_list->materi->Visible) { // materi ?>
	<?php if ($t_jadwalpel_list->SortUrl($t_jadwalpel_list->materi) == "") { ?>
		<th data-name="materi" class="<?php echo $t_jadwalpel_list->materi->headerCellClass() ?>"><div id="elh_t_jadwalpel_materi" class="t_jadwalpel_materi"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_list->materi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="materi" class="<?php echo $t_jadwalpel_list->materi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalpel_list->SortUrl($t_jadwalpel_list->materi) ?>', 1);"><div id="elh_t_jadwalpel_materi" class="t_jadwalpel_materi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_list->materi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_list->materi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_list->materi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_list->instruktur->Visible) { // instruktur ?>
	<?php if ($t_jadwalpel_list->SortUrl($t_jadwalpel_list->instruktur) == "") { ?>
		<th data-name="instruktur" class="<?php echo $t_jadwalpel_list->instruktur->headerCellClass() ?>"><div id="elh_t_jadwalpel_instruktur" class="t_jadwalpel_instruktur"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_list->instruktur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instruktur" class="<?php echo $t_jadwalpel_list->instruktur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalpel_list->SortUrl($t_jadwalpel_list->instruktur) ?>', 1);"><div id="elh_t_jadwalpel_instruktur" class="t_jadwalpel_instruktur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_list->instruktur->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_list->instruktur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_list->instruktur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_list->instansi->Visible) { // instansi ?>
	<?php if ($t_jadwalpel_list->SortUrl($t_jadwalpel_list->instansi) == "") { ?>
		<th data-name="instansi" class="<?php echo $t_jadwalpel_list->instansi->headerCellClass() ?>"><div id="elh_t_jadwalpel_instansi" class="t_jadwalpel_instansi"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_list->instansi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instansi" class="<?php echo $t_jadwalpel_list->instansi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalpel_list->SortUrl($t_jadwalpel_list->instansi) ?>', 1);"><div id="elh_t_jadwalpel_instansi" class="t_jadwalpel_instansi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_list->instansi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_list->instansi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_list->instansi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_list->ket->Visible) { // ket ?>
	<?php if ($t_jadwalpel_list->SortUrl($t_jadwalpel_list->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $t_jadwalpel_list->ket->headerCellClass() ?>"><div id="elh_t_jadwalpel_ket" class="t_jadwalpel_ket"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_list->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $t_jadwalpel_list->ket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jadwalpel_list->SortUrl($t_jadwalpel_list->ket) ?>', 1);"><div id="elh_t_jadwalpel_ket" class="t_jadwalpel_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_list->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_list->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_list->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_jadwalpel_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($t_jadwalpel_list->isAdd() || $t_jadwalpel_list->isCopy()) {
		$t_jadwalpel_list->RowIndex = 0;
		$t_jadwalpel_list->KeyCount = $t_jadwalpel_list->RowIndex;
		if ($t_jadwalpel_list->isAdd())
			$t_jadwalpel_list->loadRowValues();
		if ($t_jadwalpel->EventCancelled) // Insert failed
			$t_jadwalpel_list->restoreFormValues(); // Restore form values

		// Set row properties
		$t_jadwalpel->resetAttributes();
		$t_jadwalpel->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_t_jadwalpel", "data-rowtype" => ROWTYPE_ADD]);
		$t_jadwalpel->RowType = ROWTYPE_ADD;

		// Render row
		$t_jadwalpel_list->renderRow();

		// Render list options
		$t_jadwalpel_list->renderListOptions();
		$t_jadwalpel_list->StartRowCount = 0;
?>
	<tr <?php echo $t_jadwalpel->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalpel_list->ListOptions->render("body", "left", $t_jadwalpel_list->RowCount);
?>
	<?php if ($t_jadwalpel_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_tgl" class="form-group t_jadwalpel_tgl">
<input type="text" data-table="t_jadwalpel" data-field="x_tgl" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->tgl->EditValue ?>"<?php echo $t_jadwalpel_list->tgl->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->tgl->ReadOnly && !$t_jadwalpel_list->tgl->Disabled && !isset($t_jadwalpel_list->tgl->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_list->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->jam->Visible) { // jam ?>
		<td data-name="jam">
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_jam" class="form-group t_jadwalpel_jam">
<input type="text" data-table="t_jadwalpel" data-field="x_jam" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->jam->EditValue ?>"<?php echo $t_jadwalpel_list->jam->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->jam->ReadOnly && !$t_jadwalpel_list->jam->Disabled && !isset($t_jadwalpel_list->jam->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_list->jam->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir">
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_jam_akhir" class="form-group t_jadwalpel_jam_akhir">
<input type="text" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->jam_akhir->EditValue ?>"<?php echo $t_jadwalpel_list->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->jam_akhir->ReadOnly && !$t_jadwalpel_list->jam_akhir->Disabled && !isset($t_jadwalpel_list->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_list->jam_akhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->materi->Visible) { // materi ?>
		<td data-name="materi">
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_materi" class="form-group t_jadwalpel_materi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_materi" data-value-separator="<?php echo $t_jadwalpel_list->materi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_materi" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_materi"<?php echo $t_jadwalpel_list->materi->editAttributes() ?>>
			<?php echo $t_jadwalpel_list->materi->selectOptionListHtml("x{$t_jadwalpel_list->RowIndex}_materi") ?>
		</select>
</div>
<?php echo $t_jadwalpel_list->materi->Lookup->getParamTag($t_jadwalpel_list, "p_x" . $t_jadwalpel_list->RowIndex . "_materi") ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_materi" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_list->materi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur">
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_instruktur" class="form-group t_jadwalpel_instruktur">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_instruktur" data-value-separator="<?php echo $t_jadwalpel_list->instruktur->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur"<?php echo $t_jadwalpel_list->instruktur->editAttributes() ?>>
			<?php echo $t_jadwalpel_list->instruktur->selectOptionListHtml("x{$t_jadwalpel_list->RowIndex}_instruktur") ?>
		</select>
</div>
<?php echo $t_jadwalpel_list->instruktur->Lookup->getParamTag($t_jadwalpel_list, "p_x" . $t_jadwalpel_list->RowIndex . "_instruktur") ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_list->instruktur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->instansi->Visible) { // instansi ?>
		<td data-name="instansi">
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_instansi" class="form-group t_jadwalpel_instansi">
<input type="text" data-table="t_jadwalpel" data-field="x_instansi" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->instansi->EditValue ?>"<?php echo $t_jadwalpel_list->instansi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_list->instansi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->ket->Visible) { // ket ?>
		<td data-name="ket">
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_ket" class="form-group t_jadwalpel_ket">
<input type="text" data-table="t_jadwalpel" data-field="x_ket" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_ket" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->ket->EditValue ?>"<?php echo $t_jadwalpel_list->ket->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_ket" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_list->ket->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalpel_list->ListOptions->render("body", "right", $t_jadwalpel_list->RowCount);
?>
<script>
loadjs.ready(["ft_jadwalpellist", "load"], function() {
	ft_jadwalpellist.updateLists(<?php echo $t_jadwalpel_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($t_jadwalpel_list->ExportAll && $t_jadwalpel_list->isExport()) {
	$t_jadwalpel_list->StopRecord = $t_jadwalpel_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_jadwalpel_list->TotalRecords > $t_jadwalpel_list->StartRecord + $t_jadwalpel_list->DisplayRecords - 1)
		$t_jadwalpel_list->StopRecord = $t_jadwalpel_list->StartRecord + $t_jadwalpel_list->DisplayRecords - 1;
	else
		$t_jadwalpel_list->StopRecord = $t_jadwalpel_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($t_jadwalpel->isConfirm() || $t_jadwalpel_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_jadwalpel_list->FormKeyCountName) && ($t_jadwalpel_list->isGridAdd() || $t_jadwalpel_list->isGridEdit() || $t_jadwalpel->isConfirm())) {
		$t_jadwalpel_list->KeyCount = $CurrentForm->getValue($t_jadwalpel_list->FormKeyCountName);
		$t_jadwalpel_list->StopRecord = $t_jadwalpel_list->StartRecord + $t_jadwalpel_list->KeyCount - 1;
	}
}
$t_jadwalpel_list->RecordCount = $t_jadwalpel_list->StartRecord - 1;
if ($t_jadwalpel_list->Recordset && !$t_jadwalpel_list->Recordset->EOF) {
	$t_jadwalpel_list->Recordset->moveFirst();
	$selectLimit = $t_jadwalpel_list->UseSelectLimit;
	if (!$selectLimit && $t_jadwalpel_list->StartRecord > 1)
		$t_jadwalpel_list->Recordset->move($t_jadwalpel_list->StartRecord - 1);
} elseif (!$t_jadwalpel->AllowAddDeleteRow && $t_jadwalpel_list->StopRecord == 0) {
	$t_jadwalpel_list->StopRecord = $t_jadwalpel->GridAddRowCount;
}

// Initialize aggregate
$t_jadwalpel->RowType = ROWTYPE_AGGREGATEINIT;
$t_jadwalpel->resetAttributes();
$t_jadwalpel_list->renderRow();
if ($t_jadwalpel_list->isGridAdd())
	$t_jadwalpel_list->RowIndex = 0;
while ($t_jadwalpel_list->RecordCount < $t_jadwalpel_list->StopRecord) {
	$t_jadwalpel_list->RecordCount++;
	if ($t_jadwalpel_list->RecordCount >= $t_jadwalpel_list->StartRecord) {
		$t_jadwalpel_list->RowCount++;
		if ($t_jadwalpel_list->isGridAdd() || $t_jadwalpel_list->isGridEdit() || $t_jadwalpel->isConfirm()) {
			$t_jadwalpel_list->RowIndex++;
			$CurrentForm->Index = $t_jadwalpel_list->RowIndex;
			if ($CurrentForm->hasValue($t_jadwalpel_list->FormActionName) && ($t_jadwalpel->isConfirm() || $t_jadwalpel_list->EventCancelled))
				$t_jadwalpel_list->RowAction = strval($CurrentForm->getValue($t_jadwalpel_list->FormActionName));
			elseif ($t_jadwalpel_list->isGridAdd())
				$t_jadwalpel_list->RowAction = "insert";
			else
				$t_jadwalpel_list->RowAction = "";
		}

		// Set up key count
		$t_jadwalpel_list->KeyCount = $t_jadwalpel_list->RowIndex;

		// Init row class and style
		$t_jadwalpel->resetAttributes();
		$t_jadwalpel->CssClass = "";
		if ($t_jadwalpel_list->isGridAdd()) {
			$t_jadwalpel_list->loadRowValues(); // Load default values
		} else {
			$t_jadwalpel_list->loadRowValues($t_jadwalpel_list->Recordset); // Load row values
		}
		$t_jadwalpel->RowType = ROWTYPE_VIEW; // Render view
		if ($t_jadwalpel_list->isGridAdd()) // Grid add
			$t_jadwalpel->RowType = ROWTYPE_ADD; // Render add
		if ($t_jadwalpel_list->isGridAdd() && $t_jadwalpel->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_jadwalpel_list->restoreCurrentRowFormValues($t_jadwalpel_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_jadwalpel->RowAttrs->merge(["data-rowindex" => $t_jadwalpel_list->RowCount, "id" => "r" . $t_jadwalpel_list->RowCount . "_t_jadwalpel", "data-rowtype" => $t_jadwalpel->RowType]);

		// Render row
		$t_jadwalpel_list->renderRow();

		// Render list options
		$t_jadwalpel_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_jadwalpel_list->RowAction != "delete" && $t_jadwalpel_list->RowAction != "insertdelete" && !($t_jadwalpel_list->RowAction == "insert" && $t_jadwalpel->isConfirm() && $t_jadwalpel_list->emptyRow())) {
?>
	<tr <?php echo $t_jadwalpel->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalpel_list->ListOptions->render("body", "left", $t_jadwalpel_list->RowCount);
?>
	<?php if ($t_jadwalpel_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $t_jadwalpel_list->tgl->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_tgl" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_tgl" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->tgl->EditValue ?>"<?php echo $t_jadwalpel_list->tgl->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->tgl->ReadOnly && !$t_jadwalpel_list->tgl->Disabled && !isset($t_jadwalpel_list->tgl->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_list->tgl->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_tgl">
<span<?php echo $t_jadwalpel_list->tgl->viewAttributes() ?>><?php echo $t_jadwalpel_list->tgl->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->jam->Visible) { // jam ?>
		<td data-name="jam" <?php echo $t_jadwalpel_list->jam->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_jam" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_jam" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->jam->EditValue ?>"<?php echo $t_jadwalpel_list->jam->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->jam->ReadOnly && !$t_jadwalpel_list->jam->Disabled && !isset($t_jadwalpel_list->jam->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_list->jam->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_jam">
<span<?php echo $t_jadwalpel_list->jam->viewAttributes() ?>><?php echo $t_jadwalpel_list->jam->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir" <?php echo $t_jadwalpel_list->jam_akhir->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_jam_akhir" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->jam_akhir->EditValue ?>"<?php echo $t_jadwalpel_list->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->jam_akhir->ReadOnly && !$t_jadwalpel_list->jam_akhir->Disabled && !isset($t_jadwalpel_list->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_list->jam_akhir->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_jam_akhir">
<span<?php echo $t_jadwalpel_list->jam_akhir->viewAttributes() ?>><?php echo $t_jadwalpel_list->jam_akhir->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->materi->Visible) { // materi ?>
		<td data-name="materi" <?php echo $t_jadwalpel_list->materi->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_materi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_materi" data-value-separator="<?php echo $t_jadwalpel_list->materi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_materi" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_materi"<?php echo $t_jadwalpel_list->materi->editAttributes() ?>>
			<?php echo $t_jadwalpel_list->materi->selectOptionListHtml("x{$t_jadwalpel_list->RowIndex}_materi") ?>
		</select>
</div>
<?php echo $t_jadwalpel_list->materi->Lookup->getParamTag($t_jadwalpel_list, "p_x" . $t_jadwalpel_list->RowIndex . "_materi") ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_materi" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_list->materi->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_materi">
<span<?php echo $t_jadwalpel_list->materi->viewAttributes() ?>><?php echo $t_jadwalpel_list->materi->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur" <?php echo $t_jadwalpel_list->instruktur->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_instruktur" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_instruktur" data-value-separator="<?php echo $t_jadwalpel_list->instruktur->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur"<?php echo $t_jadwalpel_list->instruktur->editAttributes() ?>>
			<?php echo $t_jadwalpel_list->instruktur->selectOptionListHtml("x{$t_jadwalpel_list->RowIndex}_instruktur") ?>
		</select>
</div>
<?php echo $t_jadwalpel_list->instruktur->Lookup->getParamTag($t_jadwalpel_list, "p_x" . $t_jadwalpel_list->RowIndex . "_instruktur") ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_list->instruktur->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_instruktur">
<span<?php echo $t_jadwalpel_list->instruktur->viewAttributes() ?>><?php echo $t_jadwalpel_list->instruktur->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->instansi->Visible) { // instansi ?>
		<td data-name="instansi" <?php echo $t_jadwalpel_list->instansi->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_instansi" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_instansi" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->instansi->EditValue ?>"<?php echo $t_jadwalpel_list->instansi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_list->instansi->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_instansi">
<span<?php echo $t_jadwalpel_list->instansi->viewAttributes() ?>><?php echo $t_jadwalpel_list->instansi->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $t_jadwalpel_list->ket->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_ket" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_ket" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_ket" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->ket->EditValue ?>"<?php echo $t_jadwalpel_list->ket->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_ket" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_list->ket->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_list->RowCount ?>_t_jadwalpel_ket">
<span<?php echo $t_jadwalpel_list->ket->viewAttributes() ?>><?php echo $t_jadwalpel_list->ket->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalpel_list->ListOptions->render("body", "right", $t_jadwalpel_list->RowCount);
?>
	</tr>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD || $t_jadwalpel->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "load"], function() {
	ft_jadwalpellist.updateLists(<?php echo $t_jadwalpel_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_jadwalpel_list->isGridAdd())
		if (!$t_jadwalpel_list->Recordset->EOF)
			$t_jadwalpel_list->Recordset->moveNext();
}
?>
<?php
	if ($t_jadwalpel_list->isGridAdd() || $t_jadwalpel_list->isGridEdit()) {
		$t_jadwalpel_list->RowIndex = '$rowindex$';
		$t_jadwalpel_list->loadRowValues();

		// Set row properties
		$t_jadwalpel->resetAttributes();
		$t_jadwalpel->RowAttrs->merge(["data-rowindex" => $t_jadwalpel_list->RowIndex, "id" => "r0_t_jadwalpel", "data-rowtype" => ROWTYPE_ADD]);
		$t_jadwalpel->RowAttrs->appendClass("ew-template");
		$t_jadwalpel->RowType = ROWTYPE_ADD;

		// Render row
		$t_jadwalpel_list->renderRow();

		// Render list options
		$t_jadwalpel_list->renderListOptions();
		$t_jadwalpel_list->StartRowCount = 0;
?>
	<tr <?php echo $t_jadwalpel->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalpel_list->ListOptions->render("body", "left", $t_jadwalpel_list->RowIndex);
?>
	<?php if ($t_jadwalpel_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<span id="el$rowindex$_t_jadwalpel_tgl" class="form-group t_jadwalpel_tgl">
<input type="text" data-table="t_jadwalpel" data-field="x_tgl" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->tgl->EditValue ?>"<?php echo $t_jadwalpel_list->tgl->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->tgl->ReadOnly && !$t_jadwalpel_list->tgl->Disabled && !isset($t_jadwalpel_list->tgl->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_list->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->jam->Visible) { // jam ?>
		<td data-name="jam">
<span id="el$rowindex$_t_jadwalpel_jam" class="form-group t_jadwalpel_jam">
<input type="text" data-table="t_jadwalpel" data-field="x_jam" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->jam->EditValue ?>"<?php echo $t_jadwalpel_list->jam->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->jam->ReadOnly && !$t_jadwalpel_list->jam->Disabled && !isset($t_jadwalpel_list->jam->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_list->jam->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir">
<span id="el$rowindex$_t_jadwalpel_jam_akhir" class="form-group t_jadwalpel_jam_akhir">
<input type="text" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->jam_akhir->EditValue ?>"<?php echo $t_jadwalpel_list->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalpel_list->jam_akhir->ReadOnly && !$t_jadwalpel_list->jam_akhir->Disabled && !isset($t_jadwalpel_list->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalpel_list->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpellist", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpellist", "x<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_list->jam_akhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->materi->Visible) { // materi ?>
		<td data-name="materi">
<span id="el$rowindex$_t_jadwalpel_materi" class="form-group t_jadwalpel_materi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_materi" data-value-separator="<?php echo $t_jadwalpel_list->materi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_materi" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_materi"<?php echo $t_jadwalpel_list->materi->editAttributes() ?>>
			<?php echo $t_jadwalpel_list->materi->selectOptionListHtml("x{$t_jadwalpel_list->RowIndex}_materi") ?>
		</select>
</div>
<?php echo $t_jadwalpel_list->materi->Lookup->getParamTag($t_jadwalpel_list, "p_x" . $t_jadwalpel_list->RowIndex . "_materi") ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_materi" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_list->materi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur">
<span id="el$rowindex$_t_jadwalpel_instruktur" class="form-group t_jadwalpel_instruktur">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_instruktur" data-value-separator="<?php echo $t_jadwalpel_list->instruktur->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur"<?php echo $t_jadwalpel_list->instruktur->editAttributes() ?>>
			<?php echo $t_jadwalpel_list->instruktur->selectOptionListHtml("x{$t_jadwalpel_list->RowIndex}_instruktur") ?>
		</select>
</div>
<?php echo $t_jadwalpel_list->instruktur->Lookup->getParamTag($t_jadwalpel_list, "p_x" . $t_jadwalpel_list->RowIndex . "_instruktur") ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_list->instruktur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->instansi->Visible) { // instansi ?>
		<td data-name="instansi">
<span id="el$rowindex$_t_jadwalpel_instansi" class="form-group t_jadwalpel_instansi">
<input type="text" data-table="t_jadwalpel" data-field="x_instansi" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->instansi->EditValue ?>"<?php echo $t_jadwalpel_list->instansi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_list->instansi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_list->ket->Visible) { // ket ?>
		<td data-name="ket">
<span id="el$rowindex$_t_jadwalpel_ket" class="form-group t_jadwalpel_ket">
<input type="text" data-table="t_jadwalpel" data-field="x_ket" name="x<?php echo $t_jadwalpel_list->RowIndex ?>_ket" id="x<?php echo $t_jadwalpel_list->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalpel_list->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_list->ket->EditValue ?>"<?php echo $t_jadwalpel_list->ket->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="o<?php echo $t_jadwalpel_list->RowIndex ?>_ket" id="o<?php echo $t_jadwalpel_list->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_list->ket->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalpel_list->ListOptions->render("body", "right", $t_jadwalpel_list->RowIndex);
?>
<script>
loadjs.ready(["ft_jadwalpellist", "load"], function() {
	ft_jadwalpellist.updateLists(<?php echo $t_jadwalpel_list->RowIndex ?>);
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
<?php if ($t_jadwalpel_list->isAdd() || $t_jadwalpel_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $t_jadwalpel_list->FormKeyCountName ?>" id="<?php echo $t_jadwalpel_list->FormKeyCountName ?>" value="<?php echo $t_jadwalpel_list->KeyCount ?>">
<?php } ?>
<?php if ($t_jadwalpel_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $t_jadwalpel_list->FormKeyCountName ?>" id="<?php echo $t_jadwalpel_list->FormKeyCountName ?>" value="<?php echo $t_jadwalpel_list->KeyCount ?>">
<?php echo $t_jadwalpel_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$t_jadwalpel->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_jadwalpel_list->Recordset)
	$t_jadwalpel_list->Recordset->Close();
?>
<?php if (!$t_jadwalpel_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_jadwalpel_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jadwalpel_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jadwalpel_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_jadwalpel_list->TotalRecords == 0 && !$t_jadwalpel->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_jadwalpel_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_jadwalpel_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_jadwalpel_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("th[data-name='tgl'],th[data-name='jam']").css("width","100px"),$(".ewAdd").hide(),$("#r_real_peserta td").hide(),$("#r_independen td").hide(),$("#r_swasta_k td").hide(),$("#r_swasta_m td").hide(),$("#r_swasta_b td").hide(),$("#r_bumn td").hide(),$("#r_koperasi td").hide(),$("#r_pns td").hide(),$("#r_pt_dosen td").hide(),$("#r_pt_mhs td").hide(),$("#r_jk_l td").hide(),$("#r_jk_p td").hide(),$("#r_usia_k45 td").hide(),$("#r_usia_b45 td").hide(),$("#r_produk td").hide(),$("#tab_t_pelatihan2").click(function(){$("#r_kdkec td").hide("slow"),$("#r_ketua td").hide("slow"),$("#r_sekretaris td").hide("slow"),$("#r_bendahara td").hide("slow"),$("#r_jenispel td").hide("slow"),$("#r_kdkategori td").hide("slow"),$("#r_kerjasama td").hide("slow"),$("#r_biaya td").hide("slow"),$("#r_coachingprogr td").hide("slow"),$("#r_area td").hide("slow"),$("#r_periode_awal td").hide("slow"),$("#r_periode_akhir td").hide("slow"),$("#r_tahapan td").hide("slow"),$("#r_namaberkas td").hide("slow"),$("#r_instruktur td").hide("slow"),$("#r_jpeserta td").hide("slow"),$("#r_bbio td").hide("slow"),$("#r_real_peserta td").show("slow"),$("#r_independen td").show("slow"),$("#r_swasta_k td").show("slow"),$("#r_swasta_m td").show("slow"),$("#r_swasta_b td").show("slow"),$("#r_bumn td").show("slow"),$("#r_koperasi td").show("slow"),$("#r_pns td").show("slow"),$("#r_pt_dosen td").show("slow"),$("#r_pt_mhs td").show("slow"),$("#r_jk_l td").show("slow"),$("#r_jk_p td").show("slow"),$("#r_usia_k45 td").show("slow"),$("#r_usia_b45 td").show("slow"),$("#r_produk td").show("slow")}),$("#tab_t_pelatihan1").click(function(){$("#r_real_peserta td").hide("slow"),$("#r_independen td").hide("slow"),$("#r_swasta_k td").hide("slow"),$("#r_swasta_m td").hide("slow"),$("#r_swasta_b td").hide("slow"),$("#r_bumn td").hide("slow"),$("#r_koperasi td").hide("slow"),$("#r_pns td").hide("slow"),$("#r_pt_dosen td").hide("slow"),$("#r_pt_mhs td").hide("slow"),$("#r_jk_l td").hide("slow"),$("#r_jk_p td").hide("slow"),$("#r_usia_k45 td").hide("slow"),$("#r_usia_b45 td").hide("slow"),$("#r_produk td").hide("slow"),$("#r_kdkec td").show("slow"),$("#r_ketua td").show("slow"),$("#r_sekretaris td").show("slow"),$("#r_bendahara td").show("slow"),$("#r_jenispel td").show("slow"),$("#r_kdkategori td").show("slow"),$("#r_kerjasama td").show("slow"),$("#r_biaya td").show("slow"),$("#r_coachingprogr td").show("slow"),$("#r_area td").show("slow"),$("#r_periode_awal td").show("slow"),$("#r_periode_akhir td").show("slow"),$("#r_tahapan td").show("slow"),$("#r_namaberkas td").show("slow"),$("#r_instruktur td").show("slow"),$("#r_jpeserta td").show("slow"),$("#r_bbio td").show("slow")}),$("body").mouseover(function(){$(".ui-timepicker-input").css("width","100px")}),$("#el0_t_jadwalpel_materi").after("<div class='badge badge-secondary'>Kosongkan jika diluar materi</div?"),$("#el0_t_jadwalpel_instruktur").after("<div class='badge badge-secondary'>Kosongkan jika diluar materi</div?"),$("#el0_t_jadwalpel_instansi").after("<div class='badge badge-secondary'>Kosongkan jika diluar materi</div?");
});
</script>
<?php if (!$t_jadwalpel->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_jadwalpel",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_jadwalpel_list->terminate();
?>