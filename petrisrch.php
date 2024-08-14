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
$petri_search = new petri_search();

// Run the page
$petri_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$petri_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpetrisearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($petri_search->IsModal) { ?>
	fpetrisearch = currentAdvancedSearchForm = new ew.Form("fpetrisearch", "search");
	<?php } else { ?>
	fpetrisearch = currentForm = new ew.Form("fpetrisearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpetrisearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tawal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($petri_search->tawal->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_takhir");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($petri_search->takhir->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpetrisearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpetrisearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpetrisearch.lists["x_kdjudul"] = <?php echo $petri_search->kdjudul->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdjudul"].options = <?php echo JsonEncode($petri_search->kdjudul->lookupOptions()) ?>;
	fpetrisearch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpetrisearch.lists["x_kdprop"] = <?php echo $petri_search->kdprop->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdprop"].options = <?php echo JsonEncode($petri_search->kdprop->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdkota"] = <?php echo $petri_search->kdkota->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdkota"].options = <?php echo JsonEncode($petri_search->kdkota->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdsex"] = <?php echo $petri_search->kdsex->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdsex"].options = <?php echo JsonEncode($petri_search->kdsex->options(FALSE, TRUE)) ?>;
	fpetrisearch.lists["x_kdjabat"] = <?php echo $petri_search->kdjabat->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdjabat"].options = <?php echo JsonEncode($petri_search->kdjabat->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdprop_perusahaan"] = <?php echo $petri_search->kdprop_perusahaan->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdprop_perusahaan"].options = <?php echo JsonEncode($petri_search->kdprop_perusahaan->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdkota_perusahaan"] = <?php echo $petri_search->kdkota_perusahaan->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdkota_perusahaan"].options = <?php echo JsonEncode($petri_search->kdkota_perusahaan->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdkategori"] = <?php echo $petri_search->kdkategori->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdkategori"].options = <?php echo JsonEncode($petri_search->kdkategori->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdjenis"] = <?php echo $petri_search->kdjenis->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdjenis"].options = <?php echo JsonEncode($petri_search->kdjenis->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdskala"] = <?php echo $petri_search->kdskala->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdskala"].options = <?php echo JsonEncode($petri_search->kdskala->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdexport"] = <?php echo $petri_search->kdexport->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdexport"].options = <?php echo JsonEncode($petri_search->kdexport->lookupOptions()) ?>;
	fpetrisearch.lists["x_independen"] = <?php echo $petri_search->independen->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_independen"].options = <?php echo JsonEncode($petri_search->independen->options(FALSE, TRUE)) ?>;
	fpetrisearch.lists["x_kdproduknafed"] = <?php echo $petri_search->kdproduknafed->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdproduknafed"].options = <?php echo JsonEncode($petri_search->kdproduknafed->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdproduknafed2"] = <?php echo $petri_search->kdproduknafed2->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdproduknafed2"].options = <?php echo JsonEncode($petri_search->kdproduknafed2->lookupOptions()) ?>;
	fpetrisearch.lists["x_kdproduknafed3"] = <?php echo $petri_search->kdproduknafed3->Lookup->toClientList($petri_search) ?>;
	fpetrisearch.lists["x_kdproduknafed3"].options = <?php echo JsonEncode($petri_search->kdproduknafed3->lookupOptions()) ?>;
	loadjs.done("fpetrisearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $petri_search->showPageHeader(); ?>
<?php
$petri_search->showMessage();
?>
<form name="fpetrisearch" id="fpetrisearch" class="<?php echo $petri_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="petri">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$petri_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($petri_search->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdjudul"><?php echo $petri_search->kdjudul->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdjudul->cellAttributes() ?>>
			<span id="el_petri_kdjudul" class="ew-search-field">
<?php
$onchange = $petri_search->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$petri_search->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($petri_search->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($petri_search->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($petri_search->kdjudul->getPlaceHolder()) ?>"<?php echo $petri_search->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="petri" data-field="x_kdjudul" data-value-separator="<?php echo $petri_search->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($petri_search->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpetrisearch"], function() {
	fpetrisearch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $petri_search->kdjudul->Lookup->getParamTag($petri_search, "p_x_kdjudul") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label for="x_tawal" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_tawal"><?php echo $petri_search->tawal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase(">=") ?>
<input type="hidden" name="z_tawal" id="z_tawal" value=">=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->tawal->cellAttributes() ?>>
			<span id="el_petri_tawal" class="ew-search-field">
<input type="text" data-table="petri" data-field="x_tawal" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($petri_search->tawal->getPlaceHolder()) ?>" value="<?php echo $petri_search->tawal->EditValue ?>"<?php echo $petri_search->tawal->editAttributes() ?>>
<?php if (!$petri_search->tawal->ReadOnly && !$petri_search->tawal->Disabled && !isset($petri_search->tawal->EditAttrs["readonly"]) && !isset($petri_search->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpetrisearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpetrisearch", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label for="x_takhir" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_takhir"><?php echo $petri_search->takhir->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("<=") ?>
<input type="hidden" name="z_takhir" id="z_takhir" value="<=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->takhir->cellAttributes() ?>>
			<span id="el_petri_takhir" class="ew-search-field">
<input type="text" data-table="petri" data-field="x_takhir" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($petri_search->takhir->getPlaceHolder()) ?>" value="<?php echo $petri_search->takhir->EditValue ?>"<?php echo $petri_search->takhir->editAttributes() ?>>
<?php if (!$petri_search->takhir->ReadOnly && !$petri_search->takhir->Disabled && !isset($petri_search->takhir->EditAttrs["readonly"]) && !isset($petri_search->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpetrisearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpetrisearch", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label for="x_nama" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_nama"><?php echo $petri_search->nama->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->nama->cellAttributes() ?>>
			<span id="el_petri_nama" class="ew-search-field">
<input type="text" data-table="petri" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($petri_search->nama->getPlaceHolder()) ?>" value="<?php echo $petri_search->nama->EditValue ?>"<?php echo $petri_search->nama->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label for="x_kdprop" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdprop"><?php echo $petri_search->kdprop->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop" id="z_kdprop" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdprop->cellAttributes() ?>>
			<span id="el_petri_kdprop" class="ew-search-field">
<?php $petri_search->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdprop" data-value-separator="<?php echo $petri_search->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $petri_search->kdprop->editAttributes() ?>>
			<?php echo $petri_search->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $petri_search->kdprop->Lookup->getParamTag($petri_search, "p_x_kdprop") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label for="x_kdkota" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdkota"><?php echo $petri_search->kdkota->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota" id="z_kdkota" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdkota->cellAttributes() ?>>
			<span id="el_petri_kdkota" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdkota" data-value-separator="<?php echo $petri_search->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $petri_search->kdkota->editAttributes() ?>>
			<?php echo $petri_search->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $petri_search->kdkota->Lookup->getParamTag($petri_search, "p_x_kdkota") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdsex->Visible) { // kdsex ?>
	<div id="r_kdsex" class="form-group row">
		<label class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdsex"><?php echo $petri_search->kdsex->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdsex" id="z_kdsex" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdsex->cellAttributes() ?>>
			<span id="el_petri_kdsex" class="ew-search-field">
<div id="tp_x_kdsex" class="ew-template"><input type="radio" class="custom-control-input" data-table="petri" data-field="x_kdsex" data-value-separator="<?php echo $petri_search->kdsex->displayValueSeparatorAttribute() ?>" name="x_kdsex" id="x_kdsex" value="{value}"<?php echo $petri_search->kdsex->editAttributes() ?>></div>
<div id="dsl_x_kdsex" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $petri_search->kdsex->radioButtonListHtml(FALSE, "x_kdsex") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdjabat->Visible) { // kdjabat ?>
	<div id="r_kdjabat" class="form-group row">
		<label for="x_kdjabat" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdjabat"><?php echo $petri_search->kdjabat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjabat" id="z_kdjabat" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdjabat->cellAttributes() ?>>
			<span id="el_petri_kdjabat" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdjabat" data-value-separator="<?php echo $petri_search->kdjabat->displayValueSeparatorAttribute() ?>" id="x_kdjabat" name="x_kdjabat"<?php echo $petri_search->kdjabat->editAttributes() ?>>
			<?php echo $petri_search->kdjabat->selectOptionListHtml("x_kdjabat") ?>
		</select>
</div>
<?php echo $petri_search->kdjabat->Lookup->getParamTag($petri_search, "p_x_kdjabat") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->namap->Visible) { // namap ?>
	<div id="r_namap" class="form-group row">
		<label for="x_namap" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_namap"><?php echo $petri_search->namap->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_namap" id="z_namap" value="LIKE">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->namap->cellAttributes() ?>>
			<span id="el_petri_namap" class="ew-search-field">
<input type="text" data-table="petri" data-field="x_namap" name="x_namap" id="x_namap" size="75" maxlength="150" placeholder="<?php echo HtmlEncode($petri_search->namap->getPlaceHolder()) ?>" value="<?php echo $petri_search->namap->EditValue ?>"<?php echo $petri_search->namap->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdprop_perusahaan->Visible) { // kdprop_perusahaan ?>
	<div id="r_kdprop_perusahaan" class="form-group row">
		<label for="x_kdprop_perusahaan" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdprop_perusahaan"><?php echo $petri_search->kdprop_perusahaan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop_perusahaan" id="z_kdprop_perusahaan" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdprop_perusahaan->cellAttributes() ?>>
			<span id="el_petri_kdprop_perusahaan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdprop_perusahaan" data-value-separator="<?php echo $petri_search->kdprop_perusahaan->displayValueSeparatorAttribute() ?>" id="x_kdprop_perusahaan" name="x_kdprop_perusahaan"<?php echo $petri_search->kdprop_perusahaan->editAttributes() ?>>
			<?php echo $petri_search->kdprop_perusahaan->selectOptionListHtml("x_kdprop_perusahaan") ?>
		</select>
</div>
<?php echo $petri_search->kdprop_perusahaan->Lookup->getParamTag($petri_search, "p_x_kdprop_perusahaan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdkota_perusahaan->Visible) { // kdkota_perusahaan ?>
	<div id="r_kdkota_perusahaan" class="form-group row">
		<label for="x_kdkota_perusahaan" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdkota_perusahaan"><?php echo $petri_search->kdkota_perusahaan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota_perusahaan" id="z_kdkota_perusahaan" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdkota_perusahaan->cellAttributes() ?>>
			<span id="el_petri_kdkota_perusahaan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdkota_perusahaan" data-value-separator="<?php echo $petri_search->kdkota_perusahaan->displayValueSeparatorAttribute() ?>" id="x_kdkota_perusahaan" name="x_kdkota_perusahaan"<?php echo $petri_search->kdkota_perusahaan->editAttributes() ?>>
			<?php echo $petri_search->kdkota_perusahaan->selectOptionListHtml("x_kdkota_perusahaan") ?>
		</select>
</div>
<?php echo $petri_search->kdkota_perusahaan->Lookup->getParamTag($petri_search, "p_x_kdkota_perusahaan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label for="x_kdkategori" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdkategori"><?php echo $petri_search->kdkategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkategori" id="z_kdkategori" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdkategori->cellAttributes() ?>>
			<span id="el_petri_kdkategori" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdkategori" data-value-separator="<?php echo $petri_search->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $petri_search->kdkategori->editAttributes() ?>>
			<?php echo $petri_search->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $petri_search->kdkategori->Lookup->getParamTag($petri_search, "p_x_kdkategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdjenis->Visible) { // kdjenis ?>
	<div id="r_kdjenis" class="form-group row">
		<label for="x_kdjenis" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdjenis"><?php echo $petri_search->kdjenis->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjenis" id="z_kdjenis" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdjenis->cellAttributes() ?>>
			<span id="el_petri_kdjenis" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdjenis" data-value-separator="<?php echo $petri_search->kdjenis->displayValueSeparatorAttribute() ?>" id="x_kdjenis" name="x_kdjenis"<?php echo $petri_search->kdjenis->editAttributes() ?>>
			<?php echo $petri_search->kdjenis->selectOptionListHtml("x_kdjenis") ?>
		</select>
</div>
<?php echo $petri_search->kdjenis->Lookup->getParamTag($petri_search, "p_x_kdjenis") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdskala->Visible) { // kdskala ?>
	<div id="r_kdskala" class="form-group row">
		<label for="x_kdskala" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdskala"><?php echo $petri_search->kdskala->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdskala" id="z_kdskala" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdskala->cellAttributes() ?>>
			<span id="el_petri_kdskala" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdskala" data-value-separator="<?php echo $petri_search->kdskala->displayValueSeparatorAttribute() ?>" id="x_kdskala" name="x_kdskala"<?php echo $petri_search->kdskala->editAttributes() ?>>
			<?php echo $petri_search->kdskala->selectOptionListHtml("x_kdskala") ?>
		</select>
</div>
<?php echo $petri_search->kdskala->Lookup->getParamTag($petri_search, "p_x_kdskala") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdexport->Visible) { // kdexport ?>
	<div id="r_kdexport" class="form-group row">
		<label for="x_kdexport" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdexport"><?php echo $petri_search->kdexport->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdexport" id="z_kdexport" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdexport->cellAttributes() ?>>
			<span id="el_petri_kdexport" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdexport" data-value-separator="<?php echo $petri_search->kdexport->displayValueSeparatorAttribute() ?>" id="x_kdexport" name="x_kdexport"<?php echo $petri_search->kdexport->editAttributes() ?>>
			<?php echo $petri_search->kdexport->selectOptionListHtml("x_kdexport") ?>
		</select>
</div>
<?php echo $petri_search->kdexport->Lookup->getParamTag($petri_search, "p_x_kdexport") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->nexport->Visible) { // nexport ?>
	<div id="r_nexport" class="form-group row">
		<label for="x_nexport" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_nexport"><?php echo $petri_search->nexport->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nexport" id="z_nexport" value="LIKE">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->nexport->cellAttributes() ?>>
			<span id="el_petri_nexport" class="ew-search-field">
<input type="text" data-table="petri" data-field="x_nexport" name="x_nexport" id="x_nexport" size="50" placeholder="<?php echo HtmlEncode($petri_search->nexport->getPlaceHolder()) ?>" value="<?php echo $petri_search->nexport->EditValue ?>"<?php echo $petri_search->nexport->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->independen->Visible) { // independen ?>
	<div id="r_independen" class="form-group row">
		<label for="x_independen" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_independen"><?php echo $petri_search->independen->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_independen" id="z_independen" value="LIKE">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->independen->cellAttributes() ?>>
			<span id="el_petri_independen" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_independen" data-value-separator="<?php echo $petri_search->independen->displayValueSeparatorAttribute() ?>" id="x_independen" name="x_independen"<?php echo $petri_search->independen->editAttributes() ?>>
			<?php echo $petri_search->independen->selectOptionListHtml("x_independen") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdproduknafed->Visible) { // kdproduknafed ?>
	<div id="r_kdproduknafed" class="form-group row">
		<label for="x_kdproduknafed" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdproduknafed"><?php echo $petri_search->kdproduknafed->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdproduknafed" id="z_kdproduknafed" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdproduknafed->cellAttributes() ?>>
			<span id="el_petri_kdproduknafed" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdproduknafed" data-value-separator="<?php echo $petri_search->kdproduknafed->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed" name="x_kdproduknafed"<?php echo $petri_search->kdproduknafed->editAttributes() ?>>
			<?php echo $petri_search->kdproduknafed->selectOptionListHtml("x_kdproduknafed") ?>
		</select>
</div>
<?php echo $petri_search->kdproduknafed->Lookup->getParamTag($petri_search, "p_x_kdproduknafed") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdproduknafed2->Visible) { // kdproduknafed2 ?>
	<div id="r_kdproduknafed2" class="form-group row">
		<label for="x_kdproduknafed2" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdproduknafed2"><?php echo $petri_search->kdproduknafed2->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdproduknafed2" id="z_kdproduknafed2" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdproduknafed2->cellAttributes() ?>>
			<span id="el_petri_kdproduknafed2" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdproduknafed2" data-value-separator="<?php echo $petri_search->kdproduknafed2->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed2" name="x_kdproduknafed2"<?php echo $petri_search->kdproduknafed2->editAttributes() ?>>
			<?php echo $petri_search->kdproduknafed2->selectOptionListHtml("x_kdproduknafed2") ?>
		</select>
</div>
<?php echo $petri_search->kdproduknafed2->Lookup->getParamTag($petri_search, "p_x_kdproduknafed2") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->kdproduknafed3->Visible) { // kdproduknafed3 ?>
	<div id="r_kdproduknafed3" class="form-group row">
		<label for="x_kdproduknafed3" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_kdproduknafed3"><?php echo $petri_search->kdproduknafed3->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdproduknafed3" id="z_kdproduknafed3" value="=">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->kdproduknafed3->cellAttributes() ?>>
			<span id="el_petri_kdproduknafed3" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdproduknafed3" data-value-separator="<?php echo $petri_search->kdproduknafed3->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed3" name="x_kdproduknafed3"<?php echo $petri_search->kdproduknafed3->editAttributes() ?>>
			<?php echo $petri_search->kdproduknafed3->selectOptionListHtml("x_kdproduknafed3") ?>
		</select>
</div>
<?php echo $petri_search->kdproduknafed3->Lookup->getParamTag($petri_search, "p_x_kdproduknafed3") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->pproduk->Visible) { // pproduk ?>
	<div id="r_pproduk" class="form-group row">
		<label for="x_pproduk" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_pproduk"><?php echo $petri_search->pproduk->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pproduk" id="z_pproduk" value="LIKE">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->pproduk->cellAttributes() ?>>
			<span id="el_petri_pproduk" class="ew-search-field">
<input type="text" data-table="petri" data-field="x_pproduk" name="x_pproduk" id="x_pproduk" size="50" placeholder="<?php echo HtmlEncode($petri_search->pproduk->getPlaceHolder()) ?>" value="<?php echo $petri_search->pproduk->EditValue ?>"<?php echo $petri_search->pproduk->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($petri_search->alamatp->Visible) { // alamatp ?>
	<div id="r_alamatp" class="form-group row">
		<label for="x_alamatp" class="<?php echo $petri_search->LeftColumnClass ?>"><span id="elh_petri_alamatp"><?php echo $petri_search->alamatp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_alamatp" id="z_alamatp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $petri_search->RightColumnClass ?>"><div <?php echo $petri_search->alamatp->cellAttributes() ?>>
			<span id="el_petri_alamatp" class="ew-search-field">
<input type="text" data-table="petri" data-field="x_alamatp" name="x_alamatp" id="x_alamatp" size="75" maxlength="150" placeholder="<?php echo HtmlEncode($petri_search->alamatp->getPlaceHolder()) ?>" value="<?php echo $petri_search->alamatp->EditValue ?>"<?php echo $petri_search->alamatp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$petri_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $petri_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$petri_search->showPageFooter();
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
$petri_search->terminate();
?>