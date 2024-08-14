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
$t_peserta_search = new t_peserta_search();

// Run the page
$t_peserta_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_peserta_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pesertasearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($t_peserta_search->IsModal) { ?>
	ft_pesertasearch = currentAdvancedSearchForm = new ew.Form("ft_pesertasearch", "search");
	<?php } else { ?>
	ft_pesertasearch = currentForm = new ew.Form("ft_pesertasearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ft_pesertasearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_peserta_search->id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tlahir");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_peserta_search->tlahir->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_usia");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_peserta_search->usia->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_pesertasearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pesertasearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pesertasearch.lists["x_id"] = <?php echo $t_peserta_search->id->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_id"].options = <?php echo JsonEncode($t_peserta_search->id->lookupOptions()) ?>;
	ft_pesertasearch.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pesertasearch.lists["x_idp"] = <?php echo $t_peserta_search->idp->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_idp"].options = <?php echo JsonEncode($t_peserta_search->idp->lookupOptions()) ?>;
	ft_pesertasearch.autoSuggests["x_idp"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pesertasearch.lists["x_kdagama"] = <?php echo $t_peserta_search->kdagama->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_kdagama"].options = <?php echo JsonEncode($t_peserta_search->kdagama->lookupOptions()) ?>;
	ft_pesertasearch.lists["x_kdsex"] = <?php echo $t_peserta_search->kdsex->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_kdsex"].options = <?php echo JsonEncode($t_peserta_search->kdsex->options(FALSE, TRUE)) ?>;
	ft_pesertasearch.lists["x_kdprop"] = <?php echo $t_peserta_search->kdprop->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_kdprop"].options = <?php echo JsonEncode($t_peserta_search->kdprop->lookupOptions()) ?>;
	ft_pesertasearch.lists["x_kdkota"] = <?php echo $t_peserta_search->kdkota->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_kdkota"].options = <?php echo JsonEncode($t_peserta_search->kdkota->lookupOptions()) ?>;
	ft_pesertasearch.lists["x_kdkec"] = <?php echo $t_peserta_search->kdkec->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_kdkec"].options = <?php echo JsonEncode($t_peserta_search->kdkec->lookupOptions()) ?>;
	ft_pesertasearch.lists["x_kdjabat"] = <?php echo $t_peserta_search->kdjabat->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_kdjabat"].options = <?php echo JsonEncode($t_peserta_search->kdjabat->lookupOptions()) ?>;
	ft_pesertasearch.lists["x_kdpend"] = <?php echo $t_peserta_search->kdpend->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_kdpend"].options = <?php echo JsonEncode($t_peserta_search->kdpend->lookupOptions()) ?>;
	ft_pesertasearch.lists["x_kdbahasa"] = <?php echo $t_peserta_search->kdbahasa->Lookup->toClientList($t_peserta_search) ?>;
	ft_pesertasearch.lists["x_kdbahasa"].options = <?php echo JsonEncode($t_peserta_search->kdbahasa->lookupOptions()) ?>;
	loadjs.done("ft_pesertasearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_peserta_search->showPageHeader(); ?>
<?php
$t_peserta_search->showMessage();
?>
<form name="ft_pesertasearch" id="ft_pesertasearch" class="<?php echo $t_peserta_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_peserta">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$t_peserta_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($t_peserta_search->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label for="x_nama" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_nama"><?php echo $t_peserta_search->nama->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->nama->cellAttributes() ?>>
			<span id="el_t_peserta_nama" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_search->nama->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->nama->EditValue ?>"<?php echo $t_peserta_search->nama->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->idp->Visible) { // idp ?>
	<div id="r_idp" class="form-group row">
		<label class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_idp"><?php echo $t_peserta_search->idp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_idp" id="z_idp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->idp->cellAttributes() ?>>
			<span id="el_t_peserta_idp" class="ew-search-field">
<?php
$onchange = $t_peserta_search->idp->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_peserta_search->idp->EditAttrs["onchange"] = "";
?>
<span id="as_x_idp">
	<input type="text" class="form-control" name="sv_x_idp" id="sv_x_idp" value="<?php echo RemoveHtml($t_peserta_search->idp->EditValue) ?>" size="75" placeholder="<?php echo HtmlEncode($t_peserta_search->idp->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_peserta_search->idp->getPlaceHolder()) ?>"<?php echo $t_peserta_search->idp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_idp" data-value-separator="<?php echo $t_peserta_search->idp->displayValueSeparatorAttribute() ?>" name="x_idp" id="x_idp" value="<?php echo HtmlEncode($t_peserta_search->idp->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pesertasearch"], function() {
	ft_pesertasearch.createAutoSuggest({"id":"x_idp","forceSelect":false,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_peserta_search->idp->Lookup->getParamTag($t_peserta_search, "p_x_idp") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label for="x_tempat" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_tempat"><?php echo $t_peserta_search->tempat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_tempat" id="z_tempat" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->tempat->cellAttributes() ?>>
			<span id="el_t_peserta_tempat" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_tempat" name="x_tempat" id="x_tempat" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_peserta_search->tempat->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->tempat->EditValue ?>"<?php echo $t_peserta_search->tempat->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->tlahir->Visible) { // tlahir ?>
	<div id="r_tlahir" class="form-group row">
		<label for="x_tlahir" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_tlahir"><?php echo $t_peserta_search->tlahir->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tlahir" id="z_tlahir" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->tlahir->cellAttributes() ?>>
			<span id="el_t_peserta_tlahir" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_tlahir" name="x_tlahir" id="x_tlahir" size="10" placeholder="<?php echo HtmlEncode($t_peserta_search->tlahir->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->tlahir->EditValue ?>"<?php echo $t_peserta_search->tlahir->editAttributes() ?>>
<?php if (!$t_peserta_search->tlahir->ReadOnly && !$t_peserta_search->tlahir->Disabled && !isset($t_peserta_search->tlahir->EditAttrs["readonly"]) && !isset($t_peserta_search->tlahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pesertasearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pesertasearch", "x_tlahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->usia->Visible) { // usia ?>
	<div id="r_usia" class="form-group row">
		<label for="x_usia" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_usia"><?php echo $t_peserta_search->usia->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_usia" id="z_usia" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->usia->cellAttributes() ?>>
			<span id="el_t_peserta_usia" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_usia" name="x_usia" id="x_usia" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_peserta_search->usia->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->usia->EditValue ?>"<?php echo $t_peserta_search->usia->editAttributes() ?>>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_t_peserta_usia" class="ew-search-field2">
<input type="text" data-table="t_peserta" data-field="x_usia" name="y_usia" id="y_usia" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_peserta_search->usia->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->usia->EditValue2 ?>"<?php echo $t_peserta_search->usia->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdagama->Visible) { // kdagama ?>
	<div id="r_kdagama" class="form-group row">
		<label for="x_kdagama" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdagama"><?php echo $t_peserta_search->kdagama->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdagama" id="z_kdagama" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdagama->cellAttributes() ?>>
			<span id="el_t_peserta_kdagama" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdagama" data-value-separator="<?php echo $t_peserta_search->kdagama->displayValueSeparatorAttribute() ?>" id="x_kdagama" name="x_kdagama"<?php echo $t_peserta_search->kdagama->editAttributes() ?>>
			<?php echo $t_peserta_search->kdagama->selectOptionListHtml("x_kdagama") ?>
		</select>
</div>
<?php echo $t_peserta_search->kdagama->Lookup->getParamTag($t_peserta_search, "p_x_kdagama") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdsex->Visible) { // kdsex ?>
	<div id="r_kdsex" class="form-group row">
		<label class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdsex"><?php echo $t_peserta_search->kdsex->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdsex" id="z_kdsex" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdsex->cellAttributes() ?>>
			<span id="el_t_peserta_kdsex" class="ew-search-field">
<div id="tp_x_kdsex" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_peserta" data-field="x_kdsex" data-value-separator="<?php echo $t_peserta_search->kdsex->displayValueSeparatorAttribute() ?>" name="x_kdsex" id="x_kdsex" value="{value}"<?php echo $t_peserta_search->kdsex->editAttributes() ?>></div>
<div id="dsl_x_kdsex" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_peserta_search->kdsex->radioButtonListHtml(FALSE, "x_kdsex") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label for="x_kdprop" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdprop"><?php echo $t_peserta_search->kdprop->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop" id="z_kdprop" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdprop->cellAttributes() ?>>
			<span id="el_t_peserta_kdprop" class="ew-search-field">
<?php $t_peserta_search->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdprop" data-value-separator="<?php echo $t_peserta_search->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_peserta_search->kdprop->editAttributes() ?>>
			<?php echo $t_peserta_search->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_peserta_search->kdprop->Lookup->getParamTag($t_peserta_search, "p_x_kdprop") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label for="x_kdkota" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdkota"><?php echo $t_peserta_search->kdkota->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota" id="z_kdkota" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdkota->cellAttributes() ?>>
			<span id="el_t_peserta_kdkota" class="ew-search-field">
<?php $t_peserta_search->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkota" data-value-separator="<?php echo $t_peserta_search->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $t_peserta_search->kdkota->editAttributes() ?>>
			<?php echo $t_peserta_search->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $t_peserta_search->kdkota->Lookup->getParamTag($t_peserta_search, "p_x_kdkota") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdkec->Visible) { // kdkec ?>
	<div id="r_kdkec" class="form-group row">
		<label for="x_kdkec" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdkec"><?php echo $t_peserta_search->kdkec->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkec" id="z_kdkec" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdkec->cellAttributes() ?>>
			<span id="el_t_peserta_kdkec" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkec" data-value-separator="<?php echo $t_peserta_search->kdkec->displayValueSeparatorAttribute() ?>" id="x_kdkec" name="x_kdkec"<?php echo $t_peserta_search->kdkec->editAttributes() ?>>
			<?php echo $t_peserta_search->kdkec->selectOptionListHtml("x_kdkec") ?>
		</select>
</div>
<?php echo $t_peserta_search->kdkec->Lookup->getParamTag($t_peserta_search, "p_x_kdkec") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->alamat->Visible) { // alamat ?>
	<div id="r_alamat" class="form-group row">
		<label for="x_alamat" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_alamat"><?php echo $t_peserta_search->alamat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_alamat" id="z_alamat" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->alamat->cellAttributes() ?>>
			<span id="el_t_peserta_alamat" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_alamat" name="x_alamat" id="x_alamat" size="50" placeholder="<?php echo HtmlEncode($t_peserta_search->alamat->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->alamat->EditValue ?>"<?php echo $t_peserta_search->alamat->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdpos->Visible) { // kdpos ?>
	<div id="r_kdpos" class="form-group row">
		<label for="x_kdpos" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdpos"><?php echo $t_peserta_search->kdpos->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kdpos" id="z_kdpos" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdpos->cellAttributes() ?>>
			<span id="el_t_peserta_kdpos" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_kdpos" name="x_kdpos" id="x_kdpos" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_peserta_search->kdpos->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->kdpos->EditValue ?>"<?php echo $t_peserta_search->kdpos->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->telp->Visible) { // telp ?>
	<div id="r_telp" class="form-group row">
		<label for="x_telp" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_telp"><?php echo $t_peserta_search->telp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_telp" id="z_telp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->telp->cellAttributes() ?>>
			<span id="el_t_peserta_telp" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_telp" name="x_telp" id="x_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_search->telp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->telp->EditValue ?>"<?php echo $t_peserta_search->telp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label for="x_hp" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_hp"><?php echo $t_peserta_search->hp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_hp" id="z_hp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->hp->cellAttributes() ?>>
			<span id="el_t_peserta_hp" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_hp" name="x_hp" id="x_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_search->hp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->hp->EditValue ?>"<?php echo $t_peserta_search->hp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label for="x__email" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta__email"><?php echo $t_peserta_search->_email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__email" id="z__email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->_email->cellAttributes() ?>>
			<span id="el_t_peserta__email" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x__email" name="x__email" id="x__email" size="50" maxlength="80" placeholder="<?php echo HtmlEncode($t_peserta_search->_email->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->_email->EditValue ?>"<?php echo $t_peserta_search->_email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdjabat->Visible) { // kdjabat ?>
	<div id="r_kdjabat" class="form-group row">
		<label for="x_kdjabat" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdjabat"><?php echo $t_peserta_search->kdjabat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjabat" id="z_kdjabat" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdjabat->cellAttributes() ?>>
			<span id="el_t_peserta_kdjabat" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdjabat" data-value-separator="<?php echo $t_peserta_search->kdjabat->displayValueSeparatorAttribute() ?>" id="x_kdjabat" name="x_kdjabat"<?php echo $t_peserta_search->kdjabat->editAttributes() ?>>
			<?php echo $t_peserta_search->kdjabat->selectOptionListHtml("x_kdjabat") ?>
		</select>
</div>
<?php echo $t_peserta_search->kdjabat->Lookup->getParamTag($t_peserta_search, "p_x_kdjabat") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdpend->Visible) { // kdpend ?>
	<div id="r_kdpend" class="form-group row">
		<label for="x_kdpend" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdpend"><?php echo $t_peserta_search->kdpend->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdpend" id="z_kdpend" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdpend->cellAttributes() ?>>
			<span id="el_t_peserta_kdpend" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdpend" data-value-separator="<?php echo $t_peserta_search->kdpend->displayValueSeparatorAttribute() ?>" id="x_kdpend" name="x_kdpend"<?php echo $t_peserta_search->kdpend->editAttributes() ?>>
			<?php echo $t_peserta_search->kdpend->selectOptionListHtml("x_kdpend") ?>
		</select>
</div>
<?php echo $t_peserta_search->kdpend->Lookup->getParamTag($t_peserta_search, "p_x_kdpend") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->kdbahasa->Visible) { // kdbahasa ?>
	<div id="r_kdbahasa" class="form-group row">
		<label for="x_kdbahasa" class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_kdbahasa"><?php echo $t_peserta_search->kdbahasa->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdbahasa" id="z_kdbahasa" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->kdbahasa->cellAttributes() ?>>
			<span id="el_t_peserta_kdbahasa" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdbahasa" data-value-separator="<?php echo $t_peserta_search->kdbahasa->displayValueSeparatorAttribute() ?>" id="x_kdbahasa" name="x_kdbahasa"<?php echo $t_peserta_search->kdbahasa->editAttributes() ?>>
			<?php echo $t_peserta_search->kdbahasa->selectOptionListHtml("x_kdbahasa") ?>
		</select>
</div>
<?php echo $t_peserta_search->kdbahasa->Lookup->getParamTag($t_peserta_search, "p_x_kdbahasa") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_search->jpelatihan->Visible) { // jpelatihan ?>
	<div id="r_jpelatihan" class="form-group row">
		<label class="<?php echo $t_peserta_search->LeftColumnClass ?>"><span id="elh_t_peserta_jpelatihan"><?php echo $t_peserta_search->jpelatihan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jpelatihan" id="z_jpelatihan" value="=">
</span>
		</label>
		<div class="<?php echo $t_peserta_search->RightColumnClass ?>"><div <?php echo $t_peserta_search->jpelatihan->cellAttributes() ?>>
			<span id="el_t_peserta_jpelatihan" class="ew-search-field">
<input type="text" data-table="t_peserta" data-field="x_jpelatihan" name="x_jpelatihan" id="x_jpelatihan" size="30" placeholder="<?php echo HtmlEncode($t_peserta_search->jpelatihan->getPlaceHolder()) ?>" value="<?php echo $t_peserta_search->jpelatihan->EditValue ?>"<?php echo $t_peserta_search->jpelatihan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_peserta_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_peserta_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_peserta_search->showPageFooter();
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
$t_peserta_search->terminate();
?>