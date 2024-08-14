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
$excp_search = new excp_search();

// Run the page
$excp_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$excp_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fexcpsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($excp_search->IsModal) { ?>
	fexcpsearch = currentAdvancedSearchForm = new ew.Form("fexcpsearch", "search");
	<?php } else { ?>
	fexcpsearch = currentForm = new ew.Form("fexcpsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fexcpsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_kerjasama");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($excp_search->kerjasama->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jml_peserta");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($excp_search->jml_peserta->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fexcpsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fexcpsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fexcpsearch.lists["x_tahun_keg"] = <?php echo $excp_search->tahun_keg->Lookup->toClientList($excp_search) ?>;
	fexcpsearch.lists["x_tahun_keg"].options = <?php echo JsonEncode($excp_search->tahun_keg->lookupOptions()) ?>;
	fexcpsearch.lists["x_area"] = <?php echo $excp_search->area->Lookup->toClientList($excp_search) ?>;
	fexcpsearch.lists["x_area"].options = <?php echo JsonEncode($excp_search->area->lookupOptions()) ?>;
	fexcpsearch.lists["x_area2"] = <?php echo $excp_search->area2->Lookup->toClientList($excp_search) ?>;
	fexcpsearch.lists["x_area2"].options = <?php echo JsonEncode($excp_search->area2->lookupOptions()) ?>;
	fexcpsearch.lists["x_kerjasama"] = <?php echo $excp_search->kerjasama->Lookup->toClientList($excp_search) ?>;
	fexcpsearch.lists["x_kerjasama"].options = <?php echo JsonEncode($excp_search->kerjasama->lookupOptions()) ?>;
	fexcpsearch.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fexcpsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $excp_search->showPageHeader(); ?>
<?php
$excp_search->showMessage();
?>
<form name="fexcpsearch" id="fexcpsearch" class="<?php echo $excp_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="excp">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$excp_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($excp_search->tahun_keg->Visible) { // tahun_keg ?>
	<div id="r_tahun_keg" class="form-group row">
		<label for="x_tahun_keg" class="<?php echo $excp_search->LeftColumnClass ?>"><span id="elh_excp_tahun_keg"><?php echo $excp_search->tahun_keg->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_keg" id="z_tahun_keg" value="=">
</span>
		</label>
		<div class="<?php echo $excp_search->RightColumnClass ?>"><div <?php echo $excp_search->tahun_keg->cellAttributes() ?>>
			<span id="el_excp_tahun_keg" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="excp" data-field="x_tahun_keg" data-value-separator="<?php echo $excp_search->tahun_keg->displayValueSeparatorAttribute() ?>" id="x_tahun_keg" name="x_tahun_keg"<?php echo $excp_search->tahun_keg->editAttributes() ?>>
			<?php echo $excp_search->tahun_keg->selectOptionListHtml("x_tahun_keg") ?>
		</select>
</div>
<?php echo $excp_search->tahun_keg->Lookup->getParamTag($excp_search, "p_x_tahun_keg") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($excp_search->area->Visible) { // area ?>
	<div id="r_area" class="form-group row">
		<label for="x_area" class="<?php echo $excp_search->LeftColumnClass ?>"><span id="elh_excp_area"><?php echo $excp_search->area->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_area" id="z_area" value="=">
</span>
		</label>
		<div class="<?php echo $excp_search->RightColumnClass ?>"><div <?php echo $excp_search->area->cellAttributes() ?>>
			<span id="el_excp_area" class="ew-search-field">
<input type="text" data-table="excp" data-field="x_area" name="x_area" id="x_area" size="30" placeholder="<?php echo HtmlEncode($excp_search->area->getPlaceHolder()) ?>" value="<?php echo $excp_search->area->EditValue ?>"<?php echo $excp_search->area->editAttributes() ?>>
<?php echo $excp_search->area->Lookup->getParamTag($excp_search, "p_x_area") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($excp_search->area2->Visible) { // area2 ?>
	<div id="r_area2" class="form-group row">
		<label for="x_area2" class="<?php echo $excp_search->LeftColumnClass ?>"><span id="elh_excp_area2"><?php echo $excp_search->area2->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_area2" id="z_area2" value="=">
</span>
		</label>
		<div class="<?php echo $excp_search->RightColumnClass ?>"><div <?php echo $excp_search->area2->cellAttributes() ?>>
			<span id="el_excp_area2" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="excp" data-field="x_area2" data-value-separator="<?php echo $excp_search->area2->displayValueSeparatorAttribute() ?>" id="x_area2" name="x_area2"<?php echo $excp_search->area2->editAttributes() ?>>
			<?php echo $excp_search->area2->selectOptionListHtml("x_area2") ?>
		</select>
</div>
<?php echo $excp_search->area2->Lookup->getParamTag($excp_search, "p_x_area2") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($excp_search->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label class="<?php echo $excp_search->LeftColumnClass ?>"><span id="elh_excp_kerjasama"><?php echo $excp_search->kerjasama->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kerjasama" id="z_kerjasama" value="=">
</span>
		</label>
		<div class="<?php echo $excp_search->RightColumnClass ?>"><div <?php echo $excp_search->kerjasama->cellAttributes() ?>>
			<span id="el_excp_kerjasama" class="ew-search-field">
<?php
$onchange = $excp_search->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$excp_search->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($excp_search->kerjasama->EditValue) ?>" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($excp_search->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($excp_search->kerjasama->getPlaceHolder()) ?>"<?php echo $excp_search->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="excp" data-field="x_kerjasama" data-value-separator="<?php echo $excp_search->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($excp_search->kerjasama->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fexcpsearch"], function() {
	fexcpsearch.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $excp_search->kerjasama->Lookup->getParamTag($excp_search, "p_x_kerjasama") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($excp_search->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label for="x_tempat" class="<?php echo $excp_search->LeftColumnClass ?>"><span id="elh_excp_tempat"><?php echo $excp_search->tempat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tempat" id="z_tempat" value="=">
</span>
		</label>
		<div class="<?php echo $excp_search->RightColumnClass ?>"><div <?php echo $excp_search->tempat->cellAttributes() ?>>
			<span id="el_excp_tempat" class="ew-search-field">
<input type="text" data-table="excp" data-field="x_tempat" name="x_tempat" id="x_tempat" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($excp_search->tempat->getPlaceHolder()) ?>" value="<?php echo $excp_search->tempat->EditValue ?>"<?php echo $excp_search->tempat->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($excp_search->jml_peserta->Visible) { // jml_peserta ?>
	<div id="r_jml_peserta" class="form-group row">
		<label for="x_jml_peserta" class="<?php echo $excp_search->LeftColumnClass ?>"><span id="elh_excp_jml_peserta"><?php echo $excp_search->jml_peserta->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jml_peserta" id="z_jml_peserta" value="=">
</span>
		</label>
		<div class="<?php echo $excp_search->RightColumnClass ?>"><div <?php echo $excp_search->jml_peserta->cellAttributes() ?>>
			<span id="el_excp_jml_peserta" class="ew-search-field">
<input type="text" data-table="excp" data-field="x_jml_peserta" name="x_jml_peserta" id="x_jml_peserta" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($excp_search->jml_peserta->getPlaceHolder()) ?>" value="<?php echo $excp_search->jml_peserta->EditValue ?>"<?php echo $excp_search->jml_peserta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$excp_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $excp_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$excp_search->showPageFooter();
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
$excp_search->terminate();
?>