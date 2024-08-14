<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_users_grid))
	$t_users_grid = new t_users_grid();

// Run the page
$t_users_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_users_grid->Page_Render();
?>
<?php if (!$t_users_grid->isExport()) { ?>
<script>
var ft_usersgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_usersgrid = new ew.Form("ft_usersgrid", "grid");
	ft_usersgrid.formKeyCountName = '<?php echo $t_users_grid->FormKeyCountName ?>';

	// Validate form
	ft_usersgrid.validate = function() {
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
			<?php if ($t_users_grid->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_grid->username->caption(), $t_users_grid->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_users_grid->pass->Required) { ?>
				elm = this.getElements("x" + infix + "_pass");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_grid->pass->caption(), $t_users_grid->pass->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_users_grid->_userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "__userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_grid->_userlevel->caption(), $t_users_grid->_userlevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_users_grid->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_grid->aktif->caption(), $t_users_grid->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_usersgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "username", false)) return false;
		if (ew.valueChanged(fobj, infix, "pass", false)) return false;
		if (ew.valueChanged(fobj, infix, "_userlevel", false)) return false;
		if (ew.valueChanged(fobj, infix, "aktif[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_usersgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_usersgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_usersgrid.lists["x_username"] = <?php echo $t_users_grid->username->Lookup->toClientList($t_users_grid) ?>;
	ft_usersgrid.lists["x_username"].options = <?php echo JsonEncode($t_users_grid->username->lookupOptions()) ?>;
	ft_usersgrid.autoSuggests["x_username"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_usersgrid.lists["x__userlevel"] = <?php echo $t_users_grid->_userlevel->Lookup->toClientList($t_users_grid) ?>;
	ft_usersgrid.lists["x__userlevel"].options = <?php echo JsonEncode($t_users_grid->_userlevel->lookupOptions()) ?>;
	ft_usersgrid.lists["x_aktif[]"] = <?php echo $t_users_grid->aktif->Lookup->toClientList($t_users_grid) ?>;
	ft_usersgrid.lists["x_aktif[]"].options = <?php echo JsonEncode($t_users_grid->aktif->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_usersgrid");
});
</script>
<?php } ?>
<?php
$t_users_grid->renderOtherOptions();
?>
<?php if ($t_users_grid->TotalRecords > 0 || $t_users->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_users_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_users">
<?php if ($t_users_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_users_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_usersgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_users" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_usersgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_users->RowType = ROWTYPE_HEADER;

// Render list options
$t_users_grid->renderListOptions();

// Render list options (header, left)
$t_users_grid->ListOptions->render("header", "left");
?>
<?php if ($t_users_grid->username->Visible) { // username ?>
	<?php if ($t_users_grid->SortUrl($t_users_grid->username) == "") { ?>
		<th data-name="username" class="<?php echo $t_users_grid->username->headerCellClass() ?>"><div id="elh_t_users_username" class="t_users_username"><div class="ew-table-header-caption"><?php echo $t_users_grid->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $t_users_grid->username->headerCellClass() ?>"><div><div id="elh_t_users_username" class="t_users_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_users_grid->username->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_users_grid->username->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_users_grid->username->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_users_grid->pass->Visible) { // pass ?>
	<?php if ($t_users_grid->SortUrl($t_users_grid->pass) == "") { ?>
		<th data-name="pass" class="<?php echo $t_users_grid->pass->headerCellClass() ?>"><div id="elh_t_users_pass" class="t_users_pass"><div class="ew-table-header-caption"><?php echo $t_users_grid->pass->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pass" class="<?php echo $t_users_grid->pass->headerCellClass() ?>"><div><div id="elh_t_users_pass" class="t_users_pass">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_users_grid->pass->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_users_grid->pass->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_users_grid->pass->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_users_grid->_userlevel->Visible) { // userlevel ?>
	<?php if ($t_users_grid->SortUrl($t_users_grid->_userlevel) == "") { ?>
		<th data-name="_userlevel" class="<?php echo $t_users_grid->_userlevel->headerCellClass() ?>"><div id="elh_t_users__userlevel" class="t_users__userlevel"><div class="ew-table-header-caption"><?php echo $t_users_grid->_userlevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userlevel" class="<?php echo $t_users_grid->_userlevel->headerCellClass() ?>"><div><div id="elh_t_users__userlevel" class="t_users__userlevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_users_grid->_userlevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_users_grid->_userlevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_users_grid->_userlevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_users_grid->aktif->Visible) { // aktif ?>
	<?php if ($t_users_grid->SortUrl($t_users_grid->aktif) == "") { ?>
		<th data-name="aktif" class="<?php echo $t_users_grid->aktif->headerCellClass() ?>"><div id="elh_t_users_aktif" class="t_users_aktif"><div class="ew-table-header-caption"><?php echo $t_users_grid->aktif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aktif" class="<?php echo $t_users_grid->aktif->headerCellClass() ?>"><div><div id="elh_t_users_aktif" class="t_users_aktif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_users_grid->aktif->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_users_grid->aktif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_users_grid->aktif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_users_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_users_grid->StartRecord = 1;
$t_users_grid->StopRecord = $t_users_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_users->isConfirm() || $t_users_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_users_grid->FormKeyCountName) && ($t_users_grid->isGridAdd() || $t_users_grid->isGridEdit() || $t_users->isConfirm())) {
		$t_users_grid->KeyCount = $CurrentForm->getValue($t_users_grid->FormKeyCountName);
		$t_users_grid->StopRecord = $t_users_grid->StartRecord + $t_users_grid->KeyCount - 1;
	}
}
$t_users_grid->RecordCount = $t_users_grid->StartRecord - 1;
if ($t_users_grid->Recordset && !$t_users_grid->Recordset->EOF) {
	$t_users_grid->Recordset->moveFirst();
	$selectLimit = $t_users_grid->UseSelectLimit;
	if (!$selectLimit && $t_users_grid->StartRecord > 1)
		$t_users_grid->Recordset->move($t_users_grid->StartRecord - 1);
} elseif (!$t_users->AllowAddDeleteRow && $t_users_grid->StopRecord == 0) {
	$t_users_grid->StopRecord = $t_users->GridAddRowCount;
}

// Initialize aggregate
$t_users->RowType = ROWTYPE_AGGREGATEINIT;
$t_users->resetAttributes();
$t_users_grid->renderRow();
if ($t_users_grid->isGridAdd())
	$t_users_grid->RowIndex = 0;
if ($t_users_grid->isGridEdit())
	$t_users_grid->RowIndex = 0;
while ($t_users_grid->RecordCount < $t_users_grid->StopRecord) {
	$t_users_grid->RecordCount++;
	if ($t_users_grid->RecordCount >= $t_users_grid->StartRecord) {
		$t_users_grid->RowCount++;
		if ($t_users_grid->isGridAdd() || $t_users_grid->isGridEdit() || $t_users->isConfirm()) {
			$t_users_grid->RowIndex++;
			$CurrentForm->Index = $t_users_grid->RowIndex;
			if ($CurrentForm->hasValue($t_users_grid->FormActionName) && ($t_users->isConfirm() || $t_users_grid->EventCancelled))
				$t_users_grid->RowAction = strval($CurrentForm->getValue($t_users_grid->FormActionName));
			elseif ($t_users_grid->isGridAdd())
				$t_users_grid->RowAction = "insert";
			else
				$t_users_grid->RowAction = "";
		}

		// Set up key count
		$t_users_grid->KeyCount = $t_users_grid->RowIndex;

		// Init row class and style
		$t_users->resetAttributes();
		$t_users->CssClass = "";
		if ($t_users_grid->isGridAdd()) {
			if ($t_users->CurrentMode == "copy") {
				$t_users_grid->loadRowValues($t_users_grid->Recordset); // Load row values
				$t_users_grid->setRecordKey($t_users_grid->RowOldKey, $t_users_grid->Recordset); // Set old record key
			} else {
				$t_users_grid->loadRowValues(); // Load default values
				$t_users_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_users_grid->loadRowValues($t_users_grid->Recordset); // Load row values
		}
		$t_users->RowType = ROWTYPE_VIEW; // Render view
		if ($t_users_grid->isGridAdd()) // Grid add
			$t_users->RowType = ROWTYPE_ADD; // Render add
		if ($t_users_grid->isGridAdd() && $t_users->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_users_grid->restoreCurrentRowFormValues($t_users_grid->RowIndex); // Restore form values
		if ($t_users_grid->isGridEdit()) { // Grid edit
			if ($t_users->EventCancelled)
				$t_users_grid->restoreCurrentRowFormValues($t_users_grid->RowIndex); // Restore form values
			if ($t_users_grid->RowAction == "insert")
				$t_users->RowType = ROWTYPE_ADD; // Render add
			else
				$t_users->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_users_grid->isGridEdit() && ($t_users->RowType == ROWTYPE_EDIT || $t_users->RowType == ROWTYPE_ADD) && $t_users->EventCancelled) // Update failed
			$t_users_grid->restoreCurrentRowFormValues($t_users_grid->RowIndex); // Restore form values
		if ($t_users->RowType == ROWTYPE_EDIT) // Edit row
			$t_users_grid->EditRowCount++;
		if ($t_users->isConfirm()) // Confirm row
			$t_users_grid->restoreCurrentRowFormValues($t_users_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_users->RowAttrs->merge(["data-rowindex" => $t_users_grid->RowCount, "id" => "r" . $t_users_grid->RowCount . "_t_users", "data-rowtype" => $t_users->RowType]);

		// Render row
		$t_users_grid->renderRow();

		// Render list options
		$t_users_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_users_grid->RowAction != "delete" && $t_users_grid->RowAction != "insertdelete" && !($t_users_grid->RowAction == "insert" && $t_users->isConfirm() && $t_users_grid->emptyRow())) {
?>
	<tr <?php echo $t_users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_users_grid->ListOptions->render("body", "left", $t_users_grid->RowCount);
?>
	<?php if ($t_users_grid->username->Visible) { // username ?>
		<td data-name="username" <?php echo $t_users_grid->username->cellAttributes() ?>>
<?php if ($t_users->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_users_grid->username->getSessionValue() != "") { ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_username" class="form-group">
<span<?php echo $t_users_grid->username->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->username->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_users_grid->RowIndex ?>_username" name="x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_username" class="form-group">
<?php
$onchange = $t_users_grid->username->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_users_grid->username->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_users_grid->RowIndex ?>_username">
	<input type="text" class="form-control" name="sv_x<?php echo $t_users_grid->RowIndex ?>_username" id="sv_x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo RemoveHtml($t_users_grid->username->EditValue) ?>" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_users_grid->username->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_users_grid->username->getPlaceHolder()) ?>"<?php echo $t_users_grid->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_users" data-field="x_username" data-value-separator="<?php echo $t_users_grid->username->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_users_grid->RowIndex ?>_username" id="x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_usersgrid"], function() {
	ft_usersgrid.createAutoSuggest({"id":"x<?php echo $t_users_grid->RowIndex ?>_username","forceSelect":true,"minWidth":"500px","maxHeight":"600px"});
});
</script>
<?php echo $t_users_grid->username->Lookup->getParamTag($t_users_grid, "p_x" . $t_users_grid->RowIndex . "_username") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_users" data-field="x_username" name="o<?php echo $t_users_grid->RowIndex ?>_username" id="o<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->OldValue) ?>">
<?php } ?>
<?php if ($t_users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_users_grid->username->getSessionValue() != "") { ?>

<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_username" class="form-group">
<span<?php echo $t_users_grid->username->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->username->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $t_users_grid->RowIndex ?>_username" name="x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->CurrentValue) ?>">
<?php } else { ?>

<?php
$onchange = $t_users_grid->username->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_users_grid->username->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_users_grid->RowIndex ?>_username">
	<input type="text" class="form-control" name="sv_x<?php echo $t_users_grid->RowIndex ?>_username" id="sv_x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo RemoveHtml($t_users_grid->username->EditValue) ?>" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_users_grid->username->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_users_grid->username->getPlaceHolder()) ?>"<?php echo $t_users_grid->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_users" data-field="x_username" data-value-separator="<?php echo $t_users_grid->username->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_users_grid->RowIndex ?>_username" id="x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_usersgrid"], function() {
	ft_usersgrid.createAutoSuggest({"id":"x<?php echo $t_users_grid->RowIndex ?>_username","forceSelect":true,"minWidth":"500px","maxHeight":"600px"});
});
</script>
<?php echo $t_users_grid->username->Lookup->getParamTag($t_users_grid, "p_x" . $t_users_grid->RowIndex . "_username") ?>

<?php } ?>

<input type="hidden" data-table="t_users" data-field="x_username" name="o<?php echo $t_users_grid->RowIndex ?>_username" id="o<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->OldValue != null ? $t_users_grid->username->OldValue : $t_users_grid->username->CurrentValue) ?>">
<?php } ?>
<?php if ($t_users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_username">
<span<?php echo $t_users_grid->username->viewAttributes() ?>><?php echo $t_users_grid->username->getViewValue() ?></span>
</span>
<?php if (!$t_users->isConfirm()) { ?>
<input type="hidden" data-table="t_users" data-field="x_username" name="x<?php echo $t_users_grid->RowIndex ?>_username" id="x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->FormValue) ?>">
<input type="hidden" data-table="t_users" data-field="x_username" name="o<?php echo $t_users_grid->RowIndex ?>_username" id="o<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_users" data-field="x_username" name="ft_usersgrid$x<?php echo $t_users_grid->RowIndex ?>_username" id="ft_usersgrid$x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->FormValue) ?>">
<input type="hidden" data-table="t_users" data-field="x_username" name="ft_usersgrid$o<?php echo $t_users_grid->RowIndex ?>_username" id="ft_usersgrid$o<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_users_grid->pass->Visible) { // pass ?>
		<td data-name="pass" <?php echo $t_users_grid->pass->cellAttributes() ?>>
<?php if ($t_users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_pass" class="form-group">
<div class="input-group" id="ig<?php echo $t_users_grid->RowIndex ?>_pass">
<input type="password" autocomplete="new-password" data-table="t_users" data-field="x_pass" name="x<?php echo $t_users_grid->RowIndex ?>_pass" id="x<?php echo $t_users_grid->RowIndex ?>_pass" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_users_grid->pass->getPlaceHolder()) ?>"<?php echo $t_users_grid->pass->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x<?php echo $t_users_grid->RowIndex ?>_pass" data-password-confirm="c<?php echo $t_users_grid->RowIndex ?>_pass"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
</span>
<input type="hidden" data-table="t_users" data-field="x_pass" name="o<?php echo $t_users_grid->RowIndex ?>_pass" id="o<?php echo $t_users_grid->RowIndex ?>_pass" value="<?php echo HtmlEncode($t_users_grid->pass->OldValue) ?>">
<?php } ?>
<?php if ($t_users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_pass" class="form-group">
<div class="input-group" id="ig<?php echo $t_users_grid->RowIndex ?>_pass">
<input type="password" autocomplete="new-password" data-table="t_users" data-field="x_pass" name="x<?php echo $t_users_grid->RowIndex ?>_pass" id="x<?php echo $t_users_grid->RowIndex ?>_pass" value="<?php echo $t_users_grid->pass->EditValue ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_users_grid->pass->getPlaceHolder()) ?>"<?php echo $t_users_grid->pass->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x<?php echo $t_users_grid->RowIndex ?>_pass" data-password-confirm="c<?php echo $t_users_grid->RowIndex ?>_pass"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
</span>
<?php } ?>
<?php if ($t_users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_pass">
<span<?php echo $t_users_grid->pass->viewAttributes() ?>><?php echo $t_users_grid->pass->getViewValue() ?></span>
</span>
<?php if (!$t_users->isConfirm()) { ?>
<input type="hidden" data-table="t_users" data-field="x_pass" name="x<?php echo $t_users_grid->RowIndex ?>_pass" id="x<?php echo $t_users_grid->RowIndex ?>_pass" value="<?php echo HtmlEncode($t_users_grid->pass->FormValue) ?>">
<input type="hidden" data-table="t_users" data-field="x_pass" name="o<?php echo $t_users_grid->RowIndex ?>_pass" id="o<?php echo $t_users_grid->RowIndex ?>_pass" value="<?php echo HtmlEncode($t_users_grid->pass->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_users" data-field="x_pass" name="ft_usersgrid$x<?php echo $t_users_grid->RowIndex ?>_pass" id="ft_usersgrid$x<?php echo $t_users_grid->RowIndex ?>_pass" value="<?php echo HtmlEncode($t_users_grid->pass->FormValue) ?>">
<input type="hidden" data-table="t_users" data-field="x_pass" name="ft_usersgrid$o<?php echo $t_users_grid->RowIndex ?>_pass" id="ft_usersgrid$o<?php echo $t_users_grid->RowIndex ?>_pass" value="<?php echo HtmlEncode($t_users_grid->pass->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_users_grid->_userlevel->Visible) { // userlevel ?>
		<td data-name="_userlevel" <?php echo $t_users_grid->_userlevel->cellAttributes() ?>>
<?php if ($t_users->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users__userlevel" class="form-group">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->_userlevel->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users__userlevel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_users" data-field="x__userlevel" data-value-separator="<?php echo $t_users_grid->_userlevel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_users_grid->RowIndex ?>__userlevel" name="x<?php echo $t_users_grid->RowIndex ?>__userlevel"<?php echo $t_users_grid->_userlevel->editAttributes() ?>>
			<?php echo $t_users_grid->_userlevel->selectOptionListHtml("x{$t_users_grid->RowIndex}__userlevel") ?>
		</select>
</div>
<?php echo $t_users_grid->_userlevel->Lookup->getParamTag($t_users_grid, "p_x" . $t_users_grid->RowIndex . "__userlevel") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_users" data-field="x__userlevel" name="o<?php echo $t_users_grid->RowIndex ?>__userlevel" id="o<?php echo $t_users_grid->RowIndex ?>__userlevel" value="<?php echo HtmlEncode($t_users_grid->_userlevel->OldValue) ?>">
<?php } ?>
<?php if ($t_users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users__userlevel" class="form-group">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->_userlevel->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users__userlevel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_users" data-field="x__userlevel" data-value-separator="<?php echo $t_users_grid->_userlevel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_users_grid->RowIndex ?>__userlevel" name="x<?php echo $t_users_grid->RowIndex ?>__userlevel"<?php echo $t_users_grid->_userlevel->editAttributes() ?>>
			<?php echo $t_users_grid->_userlevel->selectOptionListHtml("x{$t_users_grid->RowIndex}__userlevel") ?>
		</select>
</div>
<?php echo $t_users_grid->_userlevel->Lookup->getParamTag($t_users_grid, "p_x" . $t_users_grid->RowIndex . "__userlevel") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users__userlevel">
<span<?php echo $t_users_grid->_userlevel->viewAttributes() ?>><?php echo $t_users_grid->_userlevel->getViewValue() ?></span>
</span>
<?php if (!$t_users->isConfirm()) { ?>
<input type="hidden" data-table="t_users" data-field="x__userlevel" name="x<?php echo $t_users_grid->RowIndex ?>__userlevel" id="x<?php echo $t_users_grid->RowIndex ?>__userlevel" value="<?php echo HtmlEncode($t_users_grid->_userlevel->FormValue) ?>">
<input type="hidden" data-table="t_users" data-field="x__userlevel" name="o<?php echo $t_users_grid->RowIndex ?>__userlevel" id="o<?php echo $t_users_grid->RowIndex ?>__userlevel" value="<?php echo HtmlEncode($t_users_grid->_userlevel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_users" data-field="x__userlevel" name="ft_usersgrid$x<?php echo $t_users_grid->RowIndex ?>__userlevel" id="ft_usersgrid$x<?php echo $t_users_grid->RowIndex ?>__userlevel" value="<?php echo HtmlEncode($t_users_grid->_userlevel->FormValue) ?>">
<input type="hidden" data-table="t_users" data-field="x__userlevel" name="ft_usersgrid$o<?php echo $t_users_grid->RowIndex ?>__userlevel" id="ft_usersgrid$o<?php echo $t_users_grid->RowIndex ?>__userlevel" value="<?php echo HtmlEncode($t_users_grid->_userlevel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_users_grid->aktif->Visible) { // aktif ?>
		<td data-name="aktif" <?php echo $t_users_grid->aktif->cellAttributes() ?>>
<?php if ($t_users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_aktif" class="form-group">
<?php
$selwrk = ConvertToBool($t_users_grid->aktif->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="t_users" data-field="x_aktif" name="x<?php echo $t_users_grid->RowIndex ?>_aktif[]" id="x<?php echo $t_users_grid->RowIndex ?>_aktif[]_259230" value="1"<?php echo $selwrk ?><?php echo $t_users_grid->aktif->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $t_users_grid->RowIndex ?>_aktif[]_259230"></label>
</div>
</span>
<input type="hidden" data-table="t_users" data-field="x_aktif" name="o<?php echo $t_users_grid->RowIndex ?>_aktif[]" id="o<?php echo $t_users_grid->RowIndex ?>_aktif[]" value="<?php echo HtmlEncode($t_users_grid->aktif->OldValue) ?>">
<?php } ?>
<?php if ($t_users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_aktif" class="form-group">
<?php
$selwrk = ConvertToBool($t_users_grid->aktif->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="t_users" data-field="x_aktif" name="x<?php echo $t_users_grid->RowIndex ?>_aktif[]" id="x<?php echo $t_users_grid->RowIndex ?>_aktif[]_787843" value="1"<?php echo $selwrk ?><?php echo $t_users_grid->aktif->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $t_users_grid->RowIndex ?>_aktif[]_787843"></label>
</div>
</span>
<?php } ?>
<?php if ($t_users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_users_grid->RowCount ?>_t_users_aktif">
<span<?php echo $t_users_grid->aktif->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_aktif" class="custom-control-input" value="<?php echo $t_users_grid->aktif->getViewValue() ?>" disabled<?php if (ConvertToBool($t_users_grid->aktif->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_aktif"></label></div></span>
</span>
<?php if (!$t_users->isConfirm()) { ?>
<input type="hidden" data-table="t_users" data-field="x_aktif" name="x<?php echo $t_users_grid->RowIndex ?>_aktif" id="x<?php echo $t_users_grid->RowIndex ?>_aktif" value="<?php echo HtmlEncode($t_users_grid->aktif->FormValue) ?>">
<input type="hidden" data-table="t_users" data-field="x_aktif" name="o<?php echo $t_users_grid->RowIndex ?>_aktif[]" id="o<?php echo $t_users_grid->RowIndex ?>_aktif[]" value="<?php echo HtmlEncode($t_users_grid->aktif->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_users" data-field="x_aktif" name="ft_usersgrid$x<?php echo $t_users_grid->RowIndex ?>_aktif" id="ft_usersgrid$x<?php echo $t_users_grid->RowIndex ?>_aktif" value="<?php echo HtmlEncode($t_users_grid->aktif->FormValue) ?>">
<input type="hidden" data-table="t_users" data-field="x_aktif" name="ft_usersgrid$o<?php echo $t_users_grid->RowIndex ?>_aktif[]" id="ft_usersgrid$o<?php echo $t_users_grid->RowIndex ?>_aktif[]" value="<?php echo HtmlEncode($t_users_grid->aktif->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_users_grid->ListOptions->render("body", "right", $t_users_grid->RowCount);
?>
	</tr>
<?php if ($t_users->RowType == ROWTYPE_ADD || $t_users->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_usersgrid", "load"], function() {
	ft_usersgrid.updateLists(<?php echo $t_users_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_users_grid->isGridAdd() || $t_users->CurrentMode == "copy")
		if (!$t_users_grid->Recordset->EOF)
			$t_users_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_users->CurrentMode == "add" || $t_users->CurrentMode == "copy" || $t_users->CurrentMode == "edit") {
		$t_users_grid->RowIndex = '$rowindex$';
		$t_users_grid->loadRowValues();

		// Set row properties
		$t_users->resetAttributes();
		$t_users->RowAttrs->merge(["data-rowindex" => $t_users_grid->RowIndex, "id" => "r0_t_users", "data-rowtype" => ROWTYPE_ADD]);
		$t_users->RowAttrs->appendClass("ew-template");
		$t_users->RowType = ROWTYPE_ADD;

		// Render row
		$t_users_grid->renderRow();

		// Render list options
		$t_users_grid->renderListOptions();
		$t_users_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_users_grid->ListOptions->render("body", "left", $t_users_grid->RowIndex);
?>
	<?php if ($t_users_grid->username->Visible) { // username ?>
		<td data-name="username">
<?php if (!$t_users->isConfirm()) { ?>
<?php if ($t_users_grid->username->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_users_username" class="form-group t_users_username">
<span<?php echo $t_users_grid->username->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->username->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_users_grid->RowIndex ?>_username" name="x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_users_username" class="form-group t_users_username">
<?php
$onchange = $t_users_grid->username->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_users_grid->username->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_users_grid->RowIndex ?>_username">
	<input type="text" class="form-control" name="sv_x<?php echo $t_users_grid->RowIndex ?>_username" id="sv_x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo RemoveHtml($t_users_grid->username->EditValue) ?>" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_users_grid->username->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_users_grid->username->getPlaceHolder()) ?>"<?php echo $t_users_grid->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_users" data-field="x_username" data-value-separator="<?php echo $t_users_grid->username->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_users_grid->RowIndex ?>_username" id="x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_usersgrid"], function() {
	ft_usersgrid.createAutoSuggest({"id":"x<?php echo $t_users_grid->RowIndex ?>_username","forceSelect":true,"minWidth":"500px","maxHeight":"600px"});
});
</script>
<?php echo $t_users_grid->username->Lookup->getParamTag($t_users_grid, "p_x" . $t_users_grid->RowIndex . "_username") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_users_username" class="form-group t_users_username">
<span<?php echo $t_users_grid->username->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->username->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_users" data-field="x_username" name="x<?php echo $t_users_grid->RowIndex ?>_username" id="x<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_users" data-field="x_username" name="o<?php echo $t_users_grid->RowIndex ?>_username" id="o<?php echo $t_users_grid->RowIndex ?>_username" value="<?php echo HtmlEncode($t_users_grid->username->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_users_grid->pass->Visible) { // pass ?>
		<td data-name="pass">
<?php if (!$t_users->isConfirm()) { ?>
<span id="el$rowindex$_t_users_pass" class="form-group t_users_pass">
<div class="input-group" id="ig<?php echo $t_users_grid->RowIndex ?>_pass">
<input type="password" autocomplete="new-password" data-table="t_users" data-field="x_pass" name="x<?php echo $t_users_grid->RowIndex ?>_pass" id="x<?php echo $t_users_grid->RowIndex ?>_pass" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_users_grid->pass->getPlaceHolder()) ?>"<?php echo $t_users_grid->pass->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x<?php echo $t_users_grid->RowIndex ?>_pass" data-password-confirm="c<?php echo $t_users_grid->RowIndex ?>_pass"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_users_pass" class="form-group t_users_pass">
<span<?php echo $t_users_grid->pass->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->pass->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_users" data-field="x_pass" name="x<?php echo $t_users_grid->RowIndex ?>_pass" id="x<?php echo $t_users_grid->RowIndex ?>_pass" value="<?php echo HtmlEncode($t_users_grid->pass->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_users" data-field="x_pass" name="o<?php echo $t_users_grid->RowIndex ?>_pass" id="o<?php echo $t_users_grid->RowIndex ?>_pass" value="<?php echo HtmlEncode($t_users_grid->pass->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_users_grid->_userlevel->Visible) { // userlevel ?>
		<td data-name="_userlevel">
<?php if (!$t_users->isConfirm()) { ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el$rowindex$_t_users__userlevel" class="form-group t_users__userlevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->_userlevel->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t_users__userlevel" class="form-group t_users__userlevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_users" data-field="x__userlevel" data-value-separator="<?php echo $t_users_grid->_userlevel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_users_grid->RowIndex ?>__userlevel" name="x<?php echo $t_users_grid->RowIndex ?>__userlevel"<?php echo $t_users_grid->_userlevel->editAttributes() ?>>
			<?php echo $t_users_grid->_userlevel->selectOptionListHtml("x{$t_users_grid->RowIndex}__userlevel") ?>
		</select>
</div>
<?php echo $t_users_grid->_userlevel->Lookup->getParamTag($t_users_grid, "p_x" . $t_users_grid->RowIndex . "__userlevel") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_users__userlevel" class="form-group t_users__userlevel">
<span<?php echo $t_users_grid->_userlevel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_grid->_userlevel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_users" data-field="x__userlevel" name="x<?php echo $t_users_grid->RowIndex ?>__userlevel" id="x<?php echo $t_users_grid->RowIndex ?>__userlevel" value="<?php echo HtmlEncode($t_users_grid->_userlevel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_users" data-field="x__userlevel" name="o<?php echo $t_users_grid->RowIndex ?>__userlevel" id="o<?php echo $t_users_grid->RowIndex ?>__userlevel" value="<?php echo HtmlEncode($t_users_grid->_userlevel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_users_grid->aktif->Visible) { // aktif ?>
		<td data-name="aktif">
<?php if (!$t_users->isConfirm()) { ?>
<span id="el$rowindex$_t_users_aktif" class="form-group t_users_aktif">
<?php
$selwrk = ConvertToBool($t_users_grid->aktif->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="t_users" data-field="x_aktif" name="x<?php echo $t_users_grid->RowIndex ?>_aktif[]" id="x<?php echo $t_users_grid->RowIndex ?>_aktif[]_487414" value="1"<?php echo $selwrk ?><?php echo $t_users_grid->aktif->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $t_users_grid->RowIndex ?>_aktif[]_487414"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_users_aktif" class="form-group t_users_aktif">
<span<?php echo $t_users_grid->aktif->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_aktif" class="custom-control-input" value="<?php echo $t_users_grid->aktif->ViewValue ?>" disabled<?php if (ConvertToBool($t_users_grid->aktif->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_aktif"></label></div></span>
</span>
<input type="hidden" data-table="t_users" data-field="x_aktif" name="x<?php echo $t_users_grid->RowIndex ?>_aktif" id="x<?php echo $t_users_grid->RowIndex ?>_aktif" value="<?php echo HtmlEncode($t_users_grid->aktif->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_users" data-field="x_aktif" name="o<?php echo $t_users_grid->RowIndex ?>_aktif[]" id="o<?php echo $t_users_grid->RowIndex ?>_aktif[]" value="<?php echo HtmlEncode($t_users_grid->aktif->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_users_grid->ListOptions->render("body", "right", $t_users_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_usersgrid", "load"], function() {
	ft_usersgrid.updateLists(<?php echo $t_users_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_users->CurrentMode == "add" || $t_users->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_users_grid->FormKeyCountName ?>" id="<?php echo $t_users_grid->FormKeyCountName ?>" value="<?php echo $t_users_grid->KeyCount ?>">
<?php echo $t_users_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_users->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_users_grid->FormKeyCountName ?>" id="<?php echo $t_users_grid->FormKeyCountName ?>" value="<?php echo $t_users_grid->KeyCount ?>">
<?php echo $t_users_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_users->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_usersgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_users_grid->Recordset)
	$t_users_grid->Recordset->Close();
?>
<?php if ($t_users_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_users_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_users_grid->TotalRecords == 0 && !$t_users->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_users_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_users_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_users_grid->terminate();
?>