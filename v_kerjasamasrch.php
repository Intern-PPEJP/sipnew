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
$v_kerjasama_search = new v_kerjasama_search();

// Run the page
$v_kerjasama_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_kerjasama_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fv_kerjasamasearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($v_kerjasama_search->IsModal) { ?>
	fv_kerjasamasearch = currentAdvancedSearchForm = new ew.Form("fv_kerjasamasearch", "search");
	<?php } else { ?>
	fv_kerjasamasearch = currentForm = new ew.Form("fv_kerjasamasearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fv_kerjasamasearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tgl_terbit");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_kerjasama_search->tgl_terbit->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tawal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_kerjasama_search->tawal->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_takhir");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_kerjasama_search->takhir->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kerjasama");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_kerjasama_search->kerjasama->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_biaya");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_kerjasama_search->biaya->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fv_kerjasamasearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fv_kerjasamasearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fv_kerjasamasearch.lists["x_kdjudul"] = <?php echo $v_kerjasama_search->kdjudul->Lookup->toClientList($v_kerjasama_search) ?>;
	fv_kerjasamasearch.lists["x_kdjudul"].options = <?php echo JsonEncode($v_kerjasama_search->kdjudul->lookupOptions()) ?>;
	fv_kerjasamasearch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_kerjasamasearch.lists["x_kdkursil"] = <?php echo $v_kerjasama_search->kdkursil->Lookup->toClientList($v_kerjasama_search) ?>;
	fv_kerjasamasearch.lists["x_kdkursil"].options = <?php echo JsonEncode($v_kerjasama_search->kdkursil->lookupOptions()) ?>;
	fv_kerjasamasearch.autoSuggests["x_kdkursil"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_kerjasamasearch.lists["x_jenispel"] = <?php echo $v_kerjasama_search->jenispel->Lookup->toClientList($v_kerjasama_search) ?>;
	fv_kerjasamasearch.lists["x_jenispel"].options = <?php echo JsonEncode($v_kerjasama_search->jenispel->options(FALSE, TRUE)) ?>;
	fv_kerjasamasearch.lists["x_kdkategori"] = <?php echo $v_kerjasama_search->kdkategori->Lookup->toClientList($v_kerjasama_search) ?>;
	fv_kerjasamasearch.lists["x_kdkategori"].options = <?php echo JsonEncode($v_kerjasama_search->kdkategori->lookupOptions()) ?>;
	fv_kerjasamasearch.lists["x_kerjasama"] = <?php echo $v_kerjasama_search->kerjasama->Lookup->toClientList($v_kerjasama_search) ?>;
	fv_kerjasamasearch.lists["x_kerjasama"].options = <?php echo JsonEncode($v_kerjasama_search->kerjasama->lookupOptions()) ?>;
	fv_kerjasamasearch.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_kerjasamasearch.lists["x_statuspel"] = <?php echo $v_kerjasama_search->statuspel->Lookup->toClientList($v_kerjasama_search) ?>;
	fv_kerjasamasearch.lists["x_statuspel"].options = <?php echo JsonEncode($v_kerjasama_search->statuspel->options(FALSE, TRUE)) ?>;
	loadjs.done("fv_kerjasamasearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $v_kerjasama_search->showPageHeader(); ?>
<?php
$v_kerjasama_search->showMessage();
?>
<form name="fv_kerjasamasearch" id="fv_kerjasamasearch" class="<?php echo $v_kerjasama_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_kerjasama">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$v_kerjasama_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($v_kerjasama_search->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label for="x_kdpelat" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_kdpelat"><?php echo $v_kerjasama_search->kdpelat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdpelat" id="z_kdpelat" value="=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->kdpelat->cellAttributes() ?>>
			<span id="el_v_kerjasama_kdpelat" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($v_kerjasama_search->kdpelat->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->kdpelat->EditValue ?>"<?php echo $v_kerjasama_search->kdpelat->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_kdjudul"><?php echo $v_kerjasama_search->kdjudul->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->kdjudul->cellAttributes() ?>>
			<span id="el_v_kerjasama_kdjudul" class="ew-search-field">
<?php
$onchange = $v_kerjasama_search->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_search->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($v_kerjasama_search->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($v_kerjasama_search->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_search->kdjudul->getPlaceHolder()) ?>"<?php echo $v_kerjasama_search->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kdjudul" data-value-separator="<?php echo $v_kerjasama_search->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($v_kerjasama_search->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamasearch"], function() {
	fv_kerjasamasearch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $v_kerjasama_search->kdjudul->Lookup->getParamTag($v_kerjasama_search, "p_x_kdjudul") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_kdkursil"><?php echo $v_kerjasama_search->kdkursil->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kdkursil" id="z_kdkursil" value="LIKE">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->kdkursil->cellAttributes() ?>>
			<span id="el_v_kerjasama_kdkursil" class="ew-search-field">
<?php
$onchange = $v_kerjasama_search->kdkursil->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_search->kdkursil->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdkursil">
	<input type="text" class="form-control" name="sv_x_kdkursil" id="sv_x_kdkursil" value="<?php echo RemoveHtml($v_kerjasama_search->kdkursil->EditValue) ?>" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($v_kerjasama_search->kdkursil->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_search->kdkursil->getPlaceHolder()) ?>"<?php echo $v_kerjasama_search->kdkursil->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kdkursil" data-value-separator="<?php echo $v_kerjasama_search->kdkursil->displayValueSeparatorAttribute() ?>" name="x_kdkursil" id="x_kdkursil" value="<?php echo HtmlEncode($v_kerjasama_search->kdkursil->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamasearch"], function() {
	fv_kerjasamasearch.createAutoSuggest({"id":"x_kdkursil","forceSelect":true});
});
</script>
<?php echo $v_kerjasama_search->kdkursil->Lookup->getParamTag($v_kerjasama_search, "p_x_kdkursil") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label for="x_revisi" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_revisi"><?php echo $v_kerjasama_search->revisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_revisi" id="z_revisi" value="LIKE">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->revisi->cellAttributes() ?>>
			<span id="el_v_kerjasama_revisi" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_revisi" name="x_revisi" id="x_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($v_kerjasama_search->revisi->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->revisi->EditValue ?>"<?php echo $v_kerjasama_search->revisi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->tgl_terbit->Visible) { // tgl_terbit ?>
	<div id="r_tgl_terbit" class="form-group row">
		<label for="x_tgl_terbit" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_tgl_terbit"><?php echo $v_kerjasama_search->tgl_terbit->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_terbit" id="z_tgl_terbit" value="=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->tgl_terbit->cellAttributes() ?>>
			<span id="el_v_kerjasama_tgl_terbit" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_tgl_terbit" name="x_tgl_terbit" id="x_tgl_terbit" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($v_kerjasama_search->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->tgl_terbit->EditValue ?>"<?php echo $v_kerjasama_search->tgl_terbit->editAttributes() ?>>
<?php if (!$v_kerjasama_search->tgl_terbit->ReadOnly && !$v_kerjasama_search->tgl_terbit->Disabled && !isset($v_kerjasama_search->tgl_terbit->EditAttrs["readonly"]) && !isset($v_kerjasama_search->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamasearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamasearch", "x_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label for="x_tawal" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_tawal"><?php echo $v_kerjasama_search->tawal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase(">=") ?>
<input type="hidden" name="z_tawal" id="z_tawal" value=">=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->tawal->cellAttributes() ?>>
			<span id="el_v_kerjasama_tawal" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_tawal" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($v_kerjasama_search->tawal->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->tawal->EditValue ?>"<?php echo $v_kerjasama_search->tawal->editAttributes() ?>>
<?php if (!$v_kerjasama_search->tawal->ReadOnly && !$v_kerjasama_search->tawal->Disabled && !isset($v_kerjasama_search->tawal->EditAttrs["readonly"]) && !isset($v_kerjasama_search->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamasearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamasearch", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label for="x_takhir" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_takhir"><?php echo $v_kerjasama_search->takhir->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("<=") ?>
<input type="hidden" name="z_takhir" id="z_takhir" value="<=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->takhir->cellAttributes() ?>>
			<span id="el_v_kerjasama_takhir" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_takhir" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($v_kerjasama_search->takhir->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->takhir->EditValue ?>"<?php echo $v_kerjasama_search->takhir->editAttributes() ?>>
<?php if (!$v_kerjasama_search->takhir->ReadOnly && !$v_kerjasama_search->takhir->Disabled && !isset($v_kerjasama_search->takhir->EditAttrs["readonly"]) && !isset($v_kerjasama_search->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamasearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamasearch", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->jenispel->Visible) { // jenispel ?>
	<div id="r_jenispel" class="form-group row">
		<label for="x_jenispel" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_jenispel"><?php echo $v_kerjasama_search->jenispel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenispel" id="z_jenispel" value="=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->jenispel->cellAttributes() ?>>
			<span id="el_v_kerjasama_jenispel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_jenispel" data-value-separator="<?php echo $v_kerjasama_search->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $v_kerjasama_search->jenispel->editAttributes() ?>>
			<?php echo $v_kerjasama_search->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label for="x_kdkategori" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_kdkategori"><?php echo $v_kerjasama_search->kdkategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkategori" id="z_kdkategori" value="=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->kdkategori->cellAttributes() ?>>
			<span id="el_v_kerjasama_kdkategori" class="ew-search-field">
<?php $v_kerjasama_search->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_kdkategori" data-value-separator="<?php echo $v_kerjasama_search->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $v_kerjasama_search->kdkategori->editAttributes() ?>>
			<?php echo $v_kerjasama_search->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $v_kerjasama_search->kdkategori->Lookup->getParamTag($v_kerjasama_search, "p_x_kdkategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_kerjasama"><?php echo $v_kerjasama_search->kerjasama->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kerjasama" id="z_kerjasama" value="=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->kerjasama->cellAttributes() ?>>
			<span id="el_v_kerjasama_kerjasama" class="ew-search-field">
<?php
$onchange = $v_kerjasama_search->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_search->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($v_kerjasama_search->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($v_kerjasama_search->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_search->kerjasama->getPlaceHolder()) ?>"<?php echo $v_kerjasama_search->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kerjasama" data-value-separator="<?php echo $v_kerjasama_search->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($v_kerjasama_search->kerjasama->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamasearch"], function() {
	fv_kerjasamasearch.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $v_kerjasama_search->kerjasama->Lookup->getParamTag($v_kerjasama_search, "p_x_kerjasama") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->biaya->Visible) { // biaya ?>
	<div id="r_biaya" class="form-group row">
		<label for="x_biaya" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_biaya"><?php echo $v_kerjasama_search->biaya->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_biaya" id="z_biaya" value="=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->biaya->cellAttributes() ?>>
			<span id="el_v_kerjasama_biaya" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_biaya" name="x_biaya" id="x_biaya" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($v_kerjasama_search->biaya->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->biaya->EditValue ?>"<?php echo $v_kerjasama_search->biaya->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label for="x_tempat" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_tempat"><?php echo $v_kerjasama_search->tempat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_tempat" id="z_tempat" value="LIKE">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->tempat->cellAttributes() ?>>
			<span id="el_v_kerjasama_tempat" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_tempat" name="x_tempat" id="x_tempat" placeholder="<?php echo HtmlEncode($v_kerjasama_search->tempat->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->tempat->EditValue ?>"<?php echo $v_kerjasama_search->tempat->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->target_peserta->Visible) { // target_peserta ?>
	<div id="r_target_peserta" class="form-group row">
		<label for="x_target_peserta" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_target_peserta"><?php echo $v_kerjasama_search->target_peserta->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_target_peserta" id="z_target_peserta" value="LIKE">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->target_peserta->cellAttributes() ?>>
			<span id="el_v_kerjasama_target_peserta" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_target_peserta" name="x_target_peserta" id="x_target_peserta" placeholder="<?php echo HtmlEncode($v_kerjasama_search->target_peserta->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->target_peserta->EditValue ?>"<?php echo $v_kerjasama_search->target_peserta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->durasi1->Visible) { // durasi1 ?>
	<div id="r_durasi1" class="form-group row">
		<label for="x_durasi1" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_durasi1"><?php echo $v_kerjasama_search->durasi1->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_durasi1" id="z_durasi1" value="LIKE">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->durasi1->cellAttributes() ?>>
			<span id="el_v_kerjasama_durasi1" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_durasi1" name="x_durasi1" id="x_durasi1" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($v_kerjasama_search->durasi1->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->durasi1->EditValue ?>"<?php echo $v_kerjasama_search->durasi1->editAttributes() ?>>
<?php if (!$v_kerjasama_search->durasi1->ReadOnly && !$v_kerjasama_search->durasi1->Disabled && !isset($v_kerjasama_search->durasi1->EditAttrs["readonly"]) && !isset($v_kerjasama_search->durasi1->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamasearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamasearch", "x_durasi1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->durasi2->Visible) { // durasi2 ?>
	<div id="r_durasi2" class="form-group row">
		<label for="x_durasi2" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_durasi2"><?php echo $v_kerjasama_search->durasi2->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_durasi2" id="z_durasi2" value="LIKE">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->durasi2->cellAttributes() ?>>
			<span id="el_v_kerjasama_durasi2" class="ew-search-field">
<input type="text" data-table="v_kerjasama" data-field="x_durasi2" name="x_durasi2" id="x_durasi2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($v_kerjasama_search->durasi2->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_search->durasi2->EditValue ?>"<?php echo $v_kerjasama_search->durasi2->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_search->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label for="x_statuspel" class="<?php echo $v_kerjasama_search->LeftColumnClass ?>"><span id="elh_v_kerjasama_statuspel"><?php echo $v_kerjasama_search->statuspel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_statuspel" id="z_statuspel" value="=">
</span>
		</label>
		<div class="<?php echo $v_kerjasama_search->RightColumnClass ?>"><div <?php echo $v_kerjasama_search->statuspel->cellAttributes() ?>>
			<span id="el_v_kerjasama_statuspel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_statuspel" data-value-separator="<?php echo $v_kerjasama_search->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $v_kerjasama_search->statuspel->editAttributes() ?>>
			<?php echo $v_kerjasama_search->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$v_kerjasama_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $v_kerjasama_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$v_kerjasama_search->showPageFooter();
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
$v_kerjasama_search->terminate();
?>