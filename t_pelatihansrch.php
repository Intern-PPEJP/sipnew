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
$t_pelatihan_search = new t_pelatihan_search();

// Run the page
$t_pelatihan_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pelatihan_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pelatihansearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($t_pelatihan_search->IsModal) { ?>
	ft_pelatihansearch = currentAdvancedSearchForm = new ew.Form("ft_pelatihansearch", "search");
	<?php } else { ?>
	ft_pelatihansearch = currentForm = new ew.Form("ft_pelatihansearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ft_pelatihansearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tgl_terbit");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->tgl_terbit->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tawal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->tawal->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_takhir");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->takhir->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_widyaiswara");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->widyaiswara->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jenisevaluasi");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->jenisevaluasi->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kerjasama");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->kerjasama->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_biaya");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->biaya->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_periode_akhir");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->periode_akhir->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jpeserta");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->jpeserta->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_search->Tahun->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_pelatihansearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pelatihansearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pelatihansearch.lists["x_kdjudul"] = <?php echo $t_pelatihan_search->kdjudul->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_kdjudul"].options = <?php echo JsonEncode($t_pelatihan_search->kdjudul->lookupOptions()) ?>;
	ft_pelatihansearch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihansearch.lists["x_kdkursil"] = <?php echo $t_pelatihan_search->kdkursil->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_kdkursil"].options = <?php echo JsonEncode($t_pelatihan_search->kdkursil->lookupOptions()) ?>;
	ft_pelatihansearch.autoSuggests["x_kdkursil"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihansearch.lists["x_pilihan_iso"] = <?php echo $t_pelatihan_search->pilihan_iso->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_pilihan_iso"].options = <?php echo JsonEncode($t_pelatihan_search->pilihan_iso->options(FALSE, TRUE)) ?>;
	ft_pelatihansearch.lists["x_kdprop"] = <?php echo $t_pelatihan_search->kdprop->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_kdprop"].options = <?php echo JsonEncode($t_pelatihan_search->kdprop->lookupOptions()) ?>;
	ft_pelatihansearch.lists["x_kdkota"] = <?php echo $t_pelatihan_search->kdkota->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_kdkota"].options = <?php echo JsonEncode($t_pelatihan_search->kdkota->lookupOptions()) ?>;
	ft_pelatihansearch.lists["x_kdkec"] = <?php echo $t_pelatihan_search->kdkec->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_kdkec"].options = <?php echo JsonEncode($t_pelatihan_search->kdkec->lookupOptions()) ?>;
	ft_pelatihansearch.lists["x_ketua"] = <?php echo $t_pelatihan_search->ketua->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_ketua"].options = <?php echo JsonEncode($t_pelatihan_search->ketua->lookupOptions()) ?>;
	ft_pelatihansearch.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihansearch.lists["x_sekretaris"] = <?php echo $t_pelatihan_search->sekretaris->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_sekretaris"].options = <?php echo JsonEncode($t_pelatihan_search->sekretaris->lookupOptions()) ?>;
	ft_pelatihansearch.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihansearch.lists["x_bendahara"] = <?php echo $t_pelatihan_search->bendahara->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_bendahara"].options = <?php echo JsonEncode($t_pelatihan_search->bendahara->lookupOptions()) ?>;
	ft_pelatihansearch.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihansearch.lists["x_anggota2"] = <?php echo $t_pelatihan_search->anggota2->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_anggota2"].options = <?php echo JsonEncode($t_pelatihan_search->anggota2->lookupOptions()) ?>;
	ft_pelatihansearch.autoSuggests["x_anggota2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihansearch.lists["x_widyaiswara"] = <?php echo $t_pelatihan_search->widyaiswara->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_widyaiswara"].options = <?php echo JsonEncode($t_pelatihan_search->widyaiswara->lookupOptions()) ?>;
	ft_pelatihansearch.autoSuggests["x_widyaiswara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihansearch.lists["x_jenispel"] = <?php echo $t_pelatihan_search->jenispel->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_jenispel"].options = <?php echo JsonEncode($t_pelatihan_search->jenispel->options(FALSE, TRUE)) ?>;
	ft_pelatihansearch.lists["x_kdkategori"] = <?php echo $t_pelatihan_search->kdkategori->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_kdkategori"].options = <?php echo JsonEncode($t_pelatihan_search->kdkategori->lookupOptions()) ?>;
	ft_pelatihansearch.lists["x_kerjasama"] = <?php echo $t_pelatihan_search->kerjasama->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_kerjasama"].options = <?php echo JsonEncode($t_pelatihan_search->kerjasama->lookupOptions()) ?>;
	ft_pelatihansearch.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihansearch.lists["x_coachingprogr"] = <?php echo $t_pelatihan_search->coachingprogr->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_coachingprogr"].options = <?php echo JsonEncode($t_pelatihan_search->coachingprogr->options(FALSE, TRUE)) ?>;
	ft_pelatihansearch.lists["x_tahapan"] = <?php echo $t_pelatihan_search->tahapan->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_tahapan"].options = <?php echo JsonEncode($t_pelatihan_search->tahapan->lookupOptions()) ?>;
	ft_pelatihansearch.lists["x_statuspel"] = <?php echo $t_pelatihan_search->statuspel->Lookup->toClientList($t_pelatihan_search) ?>;
	ft_pelatihansearch.lists["x_statuspel"].options = <?php echo JsonEncode($t_pelatihan_search->statuspel->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_pelatihansearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pelatihan_search->showPageHeader(); ?>
<?php
$t_pelatihan_search->showMessage();
?>
<form name="ft_pelatihansearch" id="ft_pelatihansearch" class="<?php echo $t_pelatihan_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pelatihan">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$t_pelatihan_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($t_pelatihan_search->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label for="x_kdpelat" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_kdpelat"><?php echo $t_pelatihan_search->kdpelat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdpelat" id="z_kdpelat" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->kdpelat->cellAttributes() ?>>
			<span id="el_t_pelatihan_kdpelat" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($t_pelatihan_search->kdpelat->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->kdpelat->EditValue ?>"<?php echo $t_pelatihan_search->kdpelat->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_kdjudul"><?php echo $t_pelatihan_search->kdjudul->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->kdjudul->cellAttributes() ?>>
			<span id="el_t_pelatihan_kdjudul" class="ew-search-field">
<?php
$onchange = $t_pelatihan_search->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_search->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_pelatihan_search->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($t_pelatihan_search->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_search->kdjudul->getPlaceHolder()) ?>"<?php echo $t_pelatihan_search->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" data-value-separator="<?php echo $t_pelatihan_search->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_search->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihansearch"], function() {
	ft_pelatihansearch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_search->kdjudul->Lookup->getParamTag($t_pelatihan_search, "p_x_kdjudul") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_kdkursil"><?php echo $t_pelatihan_search->kdkursil->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kdkursil" id="z_kdkursil" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->kdkursil->cellAttributes() ?>>
			<span id="el_t_pelatihan_kdkursil" class="ew-search-field">
<?php
$onchange = $t_pelatihan_search->kdkursil->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_search->kdkursil->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdkursil">
	<input type="text" class="form-control" name="sv_x_kdkursil" id="sv_x_kdkursil" value="<?php echo RemoveHtml($t_pelatihan_search->kdkursil->EditValue) ?>" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_pelatihan_search->kdkursil->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_search->kdkursil->getPlaceHolder()) ?>"<?php echo $t_pelatihan_search->kdkursil->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdkursil" data-value-separator="<?php echo $t_pelatihan_search->kdkursil->displayValueSeparatorAttribute() ?>" name="x_kdkursil" id="x_kdkursil" value="<?php echo HtmlEncode($t_pelatihan_search->kdkursil->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihansearch"], function() {
	ft_pelatihansearch.createAutoSuggest({"id":"x_kdkursil","forceSelect":true});
});
</script>
<?php echo $t_pelatihan_search->kdkursil->Lookup->getParamTag($t_pelatihan_search, "p_x_kdkursil") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label for="x_revisi" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_revisi"><?php echo $t_pelatihan_search->revisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_revisi" id="z_revisi" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->revisi->cellAttributes() ?>>
			<span id="el_t_pelatihan_revisi" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_revisi" name="x_revisi" id="x_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($t_pelatihan_search->revisi->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->revisi->EditValue ?>"<?php echo $t_pelatihan_search->revisi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->tgl_terbit->Visible) { // tgl_terbit ?>
	<div id="r_tgl_terbit" class="form-group row">
		<label for="x_tgl_terbit" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_tgl_terbit"><?php echo $t_pelatihan_search->tgl_terbit->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_terbit" id="z_tgl_terbit" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->tgl_terbit->cellAttributes() ?>>
			<span id="el_t_pelatihan_tgl_terbit" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_tgl_terbit" name="x_tgl_terbit" id="x_tgl_terbit" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_pelatihan_search->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->tgl_terbit->EditValue ?>"<?php echo $t_pelatihan_search->tgl_terbit->editAttributes() ?>>
<?php if (!$t_pelatihan_search->tgl_terbit->ReadOnly && !$t_pelatihan_search->tgl_terbit->Disabled && !isset($t_pelatihan_search->tgl_terbit->EditAttrs["readonly"]) && !isset($t_pelatihan_search->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihansearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihansearch", "x_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->pilihan_iso->Visible) { // pilihan_iso ?>
	<div id="r_pilihan_iso" class="form-group row">
		<label for="x_pilihan_iso" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_pilihan_iso"><?php echo $t_pelatihan_search->pilihan_iso->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pilihan_iso" id="z_pilihan_iso" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->pilihan_iso->cellAttributes() ?>>
			<span id="el_t_pelatihan_pilihan_iso" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_pilihan_iso" data-value-separator="<?php echo $t_pelatihan_search->pilihan_iso->displayValueSeparatorAttribute() ?>" id="x_pilihan_iso" name="x_pilihan_iso"<?php echo $t_pelatihan_search->pilihan_iso->editAttributes() ?>>
			<?php echo $t_pelatihan_search->pilihan_iso->selectOptionListHtml("x_pilihan_iso") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label for="x_tawal" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_tawal"><?php echo $t_pelatihan_search->tawal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase(">=") ?>
<input type="hidden" name="z_tawal" id="z_tawal" value=">=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->tawal->cellAttributes() ?>>
			<span id="el_t_pelatihan_tawal" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_tawal" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($t_pelatihan_search->tawal->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->tawal->EditValue ?>"<?php echo $t_pelatihan_search->tawal->editAttributes() ?>>
<?php if (!$t_pelatihan_search->tawal->ReadOnly && !$t_pelatihan_search->tawal->Disabled && !isset($t_pelatihan_search->tawal->EditAttrs["readonly"]) && !isset($t_pelatihan_search->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihansearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihansearch", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label for="x_takhir" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_takhir"><?php echo $t_pelatihan_search->takhir->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("<=") ?>
<input type="hidden" name="z_takhir" id="z_takhir" value="<=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->takhir->cellAttributes() ?>>
			<span id="el_t_pelatihan_takhir" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_takhir" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($t_pelatihan_search->takhir->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->takhir->EditValue ?>"<?php echo $t_pelatihan_search->takhir->editAttributes() ?>>
<?php if (!$t_pelatihan_search->takhir->ReadOnly && !$t_pelatihan_search->takhir->Disabled && !isset($t_pelatihan_search->takhir->EditAttrs["readonly"]) && !isset($t_pelatihan_search->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihansearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihansearch", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->tglpel->Visible) { // tglpel ?>
	<div id="r_tglpel" class="form-group row">
		<label for="x_tglpel" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_tglpel"><?php echo $t_pelatihan_search->tglpel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tglpel" id="z_tglpel" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->tglpel->cellAttributes() ?>>
			<span id="el_t_pelatihan_tglpel" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_tglpel" name="x_tglpel" id="x_tglpel" size="30" maxlength="65530" placeholder="<?php echo HtmlEncode($t_pelatihan_search->tglpel->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->tglpel->EditValue ?>"<?php echo $t_pelatihan_search->tglpel->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label for="x_kdprop" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_kdprop"><?php echo $t_pelatihan_search->kdprop->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop" id="z_kdprop" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->kdprop->cellAttributes() ?>>
			<span id="el_t_pelatihan_kdprop" class="ew-search-field">
<?php $t_pelatihan_search->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_kdprop" data-value-separator="<?php echo $t_pelatihan_search->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_pelatihan_search->kdprop->editAttributes() ?>>
			<?php echo $t_pelatihan_search->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_pelatihan_search->kdprop->Lookup->getParamTag($t_pelatihan_search, "p_x_kdprop") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label for="x_kdkota" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_kdkota"><?php echo $t_pelatihan_search->kdkota->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota" id="z_kdkota" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->kdkota->cellAttributes() ?>>
			<span id="el_t_pelatihan_kdkota" class="ew-search-field">
<?php $t_pelatihan_search->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_kdkota" data-value-separator="<?php echo $t_pelatihan_search->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $t_pelatihan_search->kdkota->editAttributes() ?>>
			<?php echo $t_pelatihan_search->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $t_pelatihan_search->kdkota->Lookup->getParamTag($t_pelatihan_search, "p_x_kdkota") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->kdkec->Visible) { // kdkec ?>
	<div id="r_kdkec" class="form-group row">
		<label for="x_kdkec" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_kdkec"><?php echo $t_pelatihan_search->kdkec->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkec" id="z_kdkec" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->kdkec->cellAttributes() ?>>
			<span id="el_t_pelatihan_kdkec" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_kdkec" name="x_kdkec" id="x_kdkec" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_search->kdkec->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->kdkec->EditValue ?>"<?php echo $t_pelatihan_search->kdkec->editAttributes() ?>>
<?php echo $t_pelatihan_search->kdkec->Lookup->getParamTag($t_pelatihan_search, "p_x_kdkec") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->ketua->Visible) { // ketua ?>
	<div id="r_ketua" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_ketua"><?php echo $t_pelatihan_search->ketua->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ketua" id="z_ketua" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->ketua->cellAttributes() ?>>
			<span id="el_t_pelatihan_ketua" class="ew-search-field">
<?php
$onchange = $t_pelatihan_search->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_search->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x_ketua">
	<input type="text" class="form-control" name="sv_x_ketua" id="sv_x_ketua" value="<?php echo RemoveHtml($t_pelatihan_search->ketua->EditValue) ?>" size="80" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_search->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_search->ketua->getPlaceHolder()) ?>"<?php echo $t_pelatihan_search->ketua->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_ketua" data-value-separator="<?php echo $t_pelatihan_search->ketua->displayValueSeparatorAttribute() ?>" name="x_ketua" id="x_ketua" value="<?php echo HtmlEncode($t_pelatihan_search->ketua->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihansearch"], function() {
	ft_pelatihansearch.createAutoSuggest({"id":"x_ketua","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_search->ketua->Lookup->getParamTag($t_pelatihan_search, "p_x_ketua") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->sekretaris->Visible) { // sekretaris ?>
	<div id="r_sekretaris" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_sekretaris"><?php echo $t_pelatihan_search->sekretaris->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_sekretaris" id="z_sekretaris" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->sekretaris->cellAttributes() ?>>
			<span id="el_t_pelatihan_sekretaris" class="ew-search-field">
<?php
$onchange = $t_pelatihan_search->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_search->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x_sekretaris">
	<input type="text" class="form-control" name="sv_x_sekretaris" id="sv_x_sekretaris" value="<?php echo RemoveHtml($t_pelatihan_search->sekretaris->EditValue) ?>" size="80" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_search->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_search->sekretaris->getPlaceHolder()) ?>"<?php echo $t_pelatihan_search->sekretaris->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_sekretaris" data-value-separator="<?php echo $t_pelatihan_search->sekretaris->displayValueSeparatorAttribute() ?>" name="x_sekretaris" id="x_sekretaris" value="<?php echo HtmlEncode($t_pelatihan_search->sekretaris->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihansearch"], function() {
	ft_pelatihansearch.createAutoSuggest({"id":"x_sekretaris","forceSelect":true,"minWidth":"505px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_search->sekretaris->Lookup->getParamTag($t_pelatihan_search, "p_x_sekretaris") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->bendahara->Visible) { // bendahara ?>
	<div id="r_bendahara" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_bendahara"><?php echo $t_pelatihan_search->bendahara->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_bendahara" id="z_bendahara" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->bendahara->cellAttributes() ?>>
			<span id="el_t_pelatihan_bendahara" class="ew-search-field">
<?php
$onchange = $t_pelatihan_search->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_search->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x_bendahara">
	<input type="text" class="form-control" name="sv_x_bendahara" id="sv_x_bendahara" value="<?php echo RemoveHtml($t_pelatihan_search->bendahara->EditValue) ?>" size="80" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_search->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_search->bendahara->getPlaceHolder()) ?>"<?php echo $t_pelatihan_search->bendahara->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_bendahara" data-value-separator="<?php echo $t_pelatihan_search->bendahara->displayValueSeparatorAttribute() ?>" name="x_bendahara" id="x_bendahara" value="<?php echo HtmlEncode($t_pelatihan_search->bendahara->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihansearch"], function() {
	ft_pelatihansearch.createAutoSuggest({"id":"x_bendahara","forceSelect":false,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_search->bendahara->Lookup->getParamTag($t_pelatihan_search, "p_x_bendahara") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->anggota2->Visible) { // anggota2 ?>
	<div id="r_anggota2" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_anggota2"><?php echo $t_pelatihan_search->anggota2->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_anggota2" id="z_anggota2" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->anggota2->cellAttributes() ?>>
			<span id="el_t_pelatihan_anggota2" class="ew-search-field">
<?php
$onchange = $t_pelatihan_search->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_search->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x_anggota2">
	<input type="text" class="form-control" name="sv_x_anggota2" id="sv_x_anggota2" value="<?php echo RemoveHtml($t_pelatihan_search->anggota2->EditValue) ?>" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_search->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_search->anggota2->getPlaceHolder()) ?>"<?php echo $t_pelatihan_search->anggota2->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_anggota2" data-value-separator="<?php echo $t_pelatihan_search->anggota2->displayValueSeparatorAttribute() ?>" name="x_anggota2" id="x_anggota2" value="<?php echo HtmlEncode($t_pelatihan_search->anggota2->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihansearch"], function() {
	ft_pelatihansearch.createAutoSuggest({"id":"x_anggota2","forceSelect":false});
});
</script>
<?php echo $t_pelatihan_search->anggota2->Lookup->getParamTag($t_pelatihan_search, "p_x_anggota2") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->widyaiswara->Visible) { // widyaiswara ?>
	<div id="r_widyaiswara" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_widyaiswara"><?php echo $t_pelatihan_search->widyaiswara->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_widyaiswara" id="z_widyaiswara" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->widyaiswara->cellAttributes() ?>>
			<span id="el_t_pelatihan_widyaiswara" class="ew-search-field">
<?php
$onchange = $t_pelatihan_search->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_search->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x_widyaiswara">
	<input type="text" class="form-control" name="sv_x_widyaiswara" id="sv_x_widyaiswara" value="<?php echo RemoveHtml($t_pelatihan_search->widyaiswara->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_search->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_search->widyaiswara->getPlaceHolder()) ?>"<?php echo $t_pelatihan_search->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_widyaiswara" data-value-separator="<?php echo $t_pelatihan_search->widyaiswara->displayValueSeparatorAttribute() ?>" name="x_widyaiswara" id="x_widyaiswara" value="<?php echo HtmlEncode($t_pelatihan_search->widyaiswara->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihansearch"], function() {
	ft_pelatihansearch.createAutoSuggest({"id":"x_widyaiswara","forceSelect":true});
});
</script>
<?php echo $t_pelatihan_search->widyaiswara->Lookup->getParamTag($t_pelatihan_search, "p_x_widyaiswara") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<div id="r_jenisevaluasi" class="form-group row">
		<label for="x_jenisevaluasi" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_jenisevaluasi"><?php echo $t_pelatihan_search->jenisevaluasi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenisevaluasi" id="z_jenisevaluasi" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->jenisevaluasi->cellAttributes() ?>>
			<span id="el_t_pelatihan_jenisevaluasi" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_jenisevaluasi" name="x_jenisevaluasi" id="x_jenisevaluasi" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_search->jenisevaluasi->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->jenisevaluasi->EditValue ?>"<?php echo $t_pelatihan_search->jenisevaluasi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->jenispel->Visible) { // jenispel ?>
	<div id="r_jenispel" class="form-group row">
		<label for="x_jenispel" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_jenispel"><?php echo $t_pelatihan_search->jenispel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenispel" id="z_jenispel" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->jenispel->cellAttributes() ?>>
			<span id="el_t_pelatihan_jenispel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_jenispel" data-value-separator="<?php echo $t_pelatihan_search->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $t_pelatihan_search->jenispel->editAttributes() ?>>
			<?php echo $t_pelatihan_search->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label for="x_kdkategori" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_kdkategori"><?php echo $t_pelatihan_search->kdkategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkategori" id="z_kdkategori" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->kdkategori->cellAttributes() ?>>
			<span id="el_t_pelatihan_kdkategori" class="ew-search-field">
<?php $t_pelatihan_search->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_kdkategori" data-value-separator="<?php echo $t_pelatihan_search->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $t_pelatihan_search->kdkategori->editAttributes() ?>>
			<?php echo $t_pelatihan_search->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $t_pelatihan_search->kdkategori->Lookup->getParamTag($t_pelatihan_search, "p_x_kdkategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_kerjasama"><?php echo $t_pelatihan_search->kerjasama->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kerjasama" id="z_kerjasama" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->kerjasama->cellAttributes() ?>>
			<span id="el_t_pelatihan_kerjasama" class="ew-search-field">
<?php
$onchange = $t_pelatihan_search->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_search->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($t_pelatihan_search->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_pelatihan_search->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_search->kerjasama->getPlaceHolder()) ?>"<?php echo $t_pelatihan_search->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" data-value-separator="<?php echo $t_pelatihan_search->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_search->kerjasama->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihansearch"], function() {
	ft_pelatihansearch.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_search->kerjasama->Lookup->getParamTag($t_pelatihan_search, "p_x_kerjasama") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->biaya->Visible) { // biaya ?>
	<div id="r_biaya" class="form-group row">
		<label for="x_biaya" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_biaya"><?php echo $t_pelatihan_search->biaya->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_biaya" id="z_biaya" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->biaya->cellAttributes() ?>>
			<span id="el_t_pelatihan_biaya" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_biaya" name="x_biaya" id="x_biaya" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($t_pelatihan_search->biaya->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->biaya->EditValue ?>"<?php echo $t_pelatihan_search->biaya->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->coachingprogr->Visible) { // coachingprogr ?>
	<div id="r_coachingprogr" class="form-group row">
		<label for="x_coachingprogr" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_coachingprogr"><?php echo $t_pelatihan_search->coachingprogr->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_coachingprogr" id="z_coachingprogr" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->coachingprogr->cellAttributes() ?>>
			<span id="el_t_pelatihan_coachingprogr" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_coachingprogr" data-value-separator="<?php echo $t_pelatihan_search->coachingprogr->displayValueSeparatorAttribute() ?>" id="x_coachingprogr" name="x_coachingprogr"<?php echo $t_pelatihan_search->coachingprogr->editAttributes() ?>>
			<?php echo $t_pelatihan_search->coachingprogr->selectOptionListHtml("x_coachingprogr") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->area->Visible) { // area ?>
	<div id="r_area" class="form-group row">
		<label for="x_area" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_area"><?php echo $t_pelatihan_search->area->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_area" id="z_area" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->area->cellAttributes() ?>>
			<span id="el_t_pelatihan_area" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_area" name="x_area" id="x_area" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pelatihan_search->area->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->area->EditValue ?>"<?php echo $t_pelatihan_search->area->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->periode_awal->Visible) { // periode_awal ?>
	<div id="r_periode_awal" class="form-group row">
		<label for="x_periode_awal" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_periode_awal"><?php echo $t_pelatihan_search->periode_awal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_periode_awal" id="z_periode_awal" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->periode_awal->cellAttributes() ?>>
			<span id="el_t_pelatihan_periode_awal" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_periode_awal" name="x_periode_awal" id="x_periode_awal" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_search->periode_awal->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->periode_awal->EditValue ?>"<?php echo $t_pelatihan_search->periode_awal->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->periode_akhir->Visible) { // periode_akhir ?>
	<div id="r_periode_akhir" class="form-group row">
		<label for="x_periode_akhir" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_periode_akhir"><?php echo $t_pelatihan_search->periode_akhir->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_periode_akhir" id="z_periode_akhir" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->periode_akhir->cellAttributes() ?>>
			<span id="el_t_pelatihan_periode_akhir" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_periode_akhir" name="x_periode_akhir" id="x_periode_akhir" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_search->periode_akhir->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->periode_akhir->EditValue ?>"<?php echo $t_pelatihan_search->periode_akhir->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->tahapan->Visible) { // tahapan ?>
	<div id="r_tahapan" class="form-group row">
		<label for="x_tahapan" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_tahapan"><?php echo $t_pelatihan_search->tahapan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_tahapan" id="z_tahapan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->tahapan->cellAttributes() ?>>
			<span id="el_t_pelatihan_tahapan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_tahapan" data-value-separator="<?php echo $t_pelatihan_search->tahapan->displayValueSeparatorAttribute() ?>" id="x_tahapan" name="x_tahapan"<?php echo $t_pelatihan_search->tahapan->editAttributes() ?>>
			<?php echo $t_pelatihan_search->tahapan->selectOptionListHtml("x_tahapan") ?>
		</select>
</div>
<?php echo $t_pelatihan_search->tahapan->Lookup->getParamTag($t_pelatihan_search, "p_x_tahapan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->namaberkas->Visible) { // namaberkas ?>
	<div id="r_namaberkas" class="form-group row">
		<label class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_namaberkas"><?php echo $t_pelatihan_search->namaberkas->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_namaberkas" id="z_namaberkas" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->namaberkas->cellAttributes() ?>>
			<span id="el_t_pelatihan_namaberkas" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_namaberkas" name="x_namaberkas" id="x_namaberkas" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pelatihan_search->namaberkas->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->namaberkas->EditValue ?>"<?php echo $t_pelatihan_search->namaberkas->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->instruktur->Visible) { // instruktur ?>
	<div id="r_instruktur" class="form-group row">
		<label for="x_instruktur" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_instruktur"><?php echo $t_pelatihan_search->instruktur->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_instruktur" id="z_instruktur" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->instruktur->cellAttributes() ?>>
			<span id="el_t_pelatihan_instruktur" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_instruktur" name="x_instruktur" id="x_instruktur" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_pelatihan_search->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->instruktur->EditValue ?>"<?php echo $t_pelatihan_search->instruktur->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label for="x_statuspel" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_statuspel"><?php echo $t_pelatihan_search->statuspel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_statuspel" id="z_statuspel" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->statuspel->cellAttributes() ?>>
			<span id="el_t_pelatihan_statuspel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_statuspel" data-value-separator="<?php echo $t_pelatihan_search->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $t_pelatihan_search->statuspel->editAttributes() ?>>
			<?php echo $t_pelatihan_search->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label for="x_ket" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_ket"><?php echo $t_pelatihan_search->ket->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ket" id="z_ket" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->ket->cellAttributes() ?>>
			<span id="el_t_pelatihan_ket" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_ket" name="x_ket" id="x_ket" size="35" placeholder="<?php echo HtmlEncode($t_pelatihan_search->ket->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->ket->EditValue ?>"<?php echo $t_pelatihan_search->ket->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->jpeserta->Visible) { // jpeserta ?>
	<div id="r_jpeserta" class="form-group row">
		<label for="x_jpeserta" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_jpeserta"><?php echo $t_pelatihan_search->jpeserta->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jpeserta" id="z_jpeserta" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->jpeserta->cellAttributes() ?>>
			<span id="el_t_pelatihan_jpeserta" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_jpeserta" name="x_jpeserta" id="x_jpeserta" size="30" maxlength="21" placeholder="<?php echo HtmlEncode($t_pelatihan_search->jpeserta->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->jpeserta->EditValue ?>"<?php echo $t_pelatihan_search->jpeserta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_search->Tahun->Visible) { // Tahun ?>
	<div id="r_Tahun" class="form-group row">
		<label for="x_Tahun" class="<?php echo $t_pelatihan_search->LeftColumnClass ?>"><span id="elh_t_pelatihan_Tahun"><?php echo $t_pelatihan_search->Tahun->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Tahun" id="z_Tahun" value="=">
</span>
		</label>
		<div class="<?php echo $t_pelatihan_search->RightColumnClass ?>"><div <?php echo $t_pelatihan_search->Tahun->cellAttributes() ?>>
			<span id="el_t_pelatihan_Tahun" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_Tahun" name="x_Tahun" id="x_Tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_search->Tahun->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_search->Tahun->EditValue ?>"<?php echo $t_pelatihan_search->Tahun->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_pelatihan_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pelatihan_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pelatihan_search->showPageFooter();
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
$t_pelatihan_search->terminate();
?>