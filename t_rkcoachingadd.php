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
$t_rkcoaching_add = new t_rkcoaching_add();

// Run the page
$t_rkcoaching_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rkcoaching_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rkcoachingadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_rkcoachingadd = currentForm = new ew.Form("ft_rkcoachingadd", "add");

	// Validate form
	ft_rkcoachingadd.validate = function() {
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
			<?php if ($t_rkcoaching_add->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->kdkategori->caption(), $t_rkcoaching_add->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rkcoaching_add->kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->kerjasama->caption(), $t_rkcoaching_add->kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rkcoaching_add->area->Required) { ?>
				elm = this.getElements("x" + infix + "_area");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->area->caption(), $t_rkcoaching_add->area->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rkcoaching_add->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->tempat->caption(), $t_rkcoaching_add->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rkcoaching_add->jml_tahapan->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_tahapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->jml_tahapan->caption(), $t_rkcoaching_add->jml_tahapan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jml_tahapan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rkcoaching_add->jml_tahapan->errorMessage()) ?>");
			<?php if ($t_rkcoaching_add->jml_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->jml_peserta->caption(), $t_rkcoaching_add->jml_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jml_peserta");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rkcoaching_add->jml_peserta->errorMessage()) ?>");
			<?php if ($t_rkcoaching_add->tahun_keg->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_keg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->tahun_keg->caption(), $t_rkcoaching_add->tahun_keg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rkcoaching_add->tglrevisi->Required) { ?>
				elm = this.getElements("x" + infix + "_tglrevisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->tglrevisi->caption(), $t_rkcoaching_add->tglrevisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rkcoaching_add->mou->Required) { ?>
				felm = this.getElements("x" + infix + "_mou");
				elm = this.getElements("fn_x" + infix + "_mou");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rkcoaching_add->mou->caption(), $t_rkcoaching_add->mou->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	ft_rkcoachingadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rkcoachingadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rkcoachingadd.lists["x_kdkategori"] = <?php echo $t_rkcoaching_add->kdkategori->Lookup->toClientList($t_rkcoaching_add) ?>;
	ft_rkcoachingadd.lists["x_kdkategori"].options = <?php echo JsonEncode($t_rkcoaching_add->kdkategori->lookupOptions()) ?>;
	ft_rkcoachingadd.lists["x_kerjasama"] = <?php echo $t_rkcoaching_add->kerjasama->Lookup->toClientList($t_rkcoaching_add) ?>;
	ft_rkcoachingadd.lists["x_kerjasama"].options = <?php echo JsonEncode($t_rkcoaching_add->kerjasama->lookupOptions()) ?>;
	ft_rkcoachingadd.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_rkcoachingadd.lists["x_area"] = <?php echo $t_rkcoaching_add->area->Lookup->toClientList($t_rkcoaching_add) ?>;
	ft_rkcoachingadd.lists["x_area"].options = <?php echo JsonEncode($t_rkcoaching_add->area->lookupOptions()) ?>;
	ft_rkcoachingadd.lists["x_tahun_keg"] = <?php echo $t_rkcoaching_add->tahun_keg->Lookup->toClientList($t_rkcoaching_add) ?>;
	ft_rkcoachingadd.lists["x_tahun_keg"].options = <?php echo JsonEncode($t_rkcoaching_add->tahun_keg->lookupOptions()) ?>;
	loadjs.done("ft_rkcoachingadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rkcoaching_add->showPageHeader(); ?>
<?php
$t_rkcoaching_add->showMessage();
?>
<form name="ft_rkcoachingadd" id="ft_rkcoachingadd" class="<?php echo $t_rkcoaching_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rkcoaching">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_rkcoaching_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_rkcoaching_add->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_t_rkcoaching_kdkategori" for="x_kdkategori" class="<?php echo $t_rkcoaching_add->LeftColumnClass ?>"><?php echo $t_rkcoaching_add->kdkategori->caption() ?><?php echo $t_rkcoaching_add->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkcoaching_add->RightColumnClass ?>"><div <?php echo $t_rkcoaching_add->kdkategori->cellAttributes() ?>>
<span id="el_t_rkcoaching_kdkategori">
<?php $t_rkcoaching_add->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rkcoaching" data-field="x_kdkategori" data-value-separator="<?php echo $t_rkcoaching_add->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $t_rkcoaching_add->kdkategori->editAttributes() ?>>
			<?php echo $t_rkcoaching_add->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $t_rkcoaching_add->kdkategori->Lookup->getParamTag($t_rkcoaching_add, "p_x_kdkategori") ?>
</span>
<?php echo $t_rkcoaching_add->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkcoaching_add->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label id="elh_t_rkcoaching_kerjasama" class="<?php echo $t_rkcoaching_add->LeftColumnClass ?>"><?php echo $t_rkcoaching_add->kerjasama->caption() ?><?php echo $t_rkcoaching_add->kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkcoaching_add->RightColumnClass ?>"><div <?php echo $t_rkcoaching_add->kerjasama->cellAttributes() ?>>
<span id="el_t_rkcoaching_kerjasama">
<?php
$onchange = $t_rkcoaching_add->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_rkcoaching_add->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($t_rkcoaching_add->kerjasama->EditValue) ?>" size="60" placeholder="<?php echo HtmlEncode($t_rkcoaching_add->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_rkcoaching_add->kerjasama->getPlaceHolder()) ?>"<?php echo $t_rkcoaching_add->kerjasama->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_rkcoaching_add->kerjasama->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kerjasama',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_rkcoaching_add->kerjasama->ReadOnly || $t_rkcoaching_add->kerjasama->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_rkcoaching" data-field="x_kerjasama" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_rkcoaching_add->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($t_rkcoaching_add->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_rkcoachingadd"], function() {
	ft_rkcoachingadd.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_rkcoaching_add->kerjasama->Lookup->getParamTag($t_rkcoaching_add, "p_x_kerjasama") ?>
</span>
<?php echo $t_rkcoaching_add->kerjasama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkcoaching_add->area->Visible) { // area ?>
	<div id="r_area" class="form-group row">
		<label id="elh_t_rkcoaching_area" for="x_area" class="<?php echo $t_rkcoaching_add->LeftColumnClass ?>"><?php echo $t_rkcoaching_add->area->caption() ?><?php echo $t_rkcoaching_add->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkcoaching_add->RightColumnClass ?>"><div <?php echo $t_rkcoaching_add->area->cellAttributes() ?>>
<span id="el_t_rkcoaching_area">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rkcoaching" data-field="x_area" data-value-separator="<?php echo $t_rkcoaching_add->area->displayValueSeparatorAttribute() ?>" id="x_area" name="x_area"<?php echo $t_rkcoaching_add->area->editAttributes() ?>>
			<?php echo $t_rkcoaching_add->area->selectOptionListHtml("x_area") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_area") && !$t_rkcoaching_add->area->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_area" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_rkcoaching_add->area->caption() ?>" data-title="<?php echo $t_rkcoaching_add->area->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_area',url:'t_areaaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_rkcoaching_add->area->Lookup->getParamTag($t_rkcoaching_add, "p_x_area") ?>
</span>
<?php echo $t_rkcoaching_add->area->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkcoaching_add->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_t_rkcoaching_tempat" for="x_tempat" class="<?php echo $t_rkcoaching_add->LeftColumnClass ?>"><?php echo $t_rkcoaching_add->tempat->caption() ?><?php echo $t_rkcoaching_add->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkcoaching_add->RightColumnClass ?>"><div <?php echo $t_rkcoaching_add->tempat->cellAttributes() ?>>
<span id="el_t_rkcoaching_tempat">
<input type="text" data-table="t_rkcoaching" data-field="x_tempat" name="x_tempat" id="x_tempat" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_rkcoaching_add->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rkcoaching_add->tempat->EditValue ?>"<?php echo $t_rkcoaching_add->tempat->editAttributes() ?>>
</span>
<?php echo $t_rkcoaching_add->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkcoaching_add->jml_tahapan->Visible) { // jml_tahapan ?>
	<div id="r_jml_tahapan" class="form-group row">
		<label id="elh_t_rkcoaching_jml_tahapan" for="x_jml_tahapan" class="<?php echo $t_rkcoaching_add->LeftColumnClass ?>"><?php echo $t_rkcoaching_add->jml_tahapan->caption() ?><?php echo $t_rkcoaching_add->jml_tahapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkcoaching_add->RightColumnClass ?>"><div <?php echo $t_rkcoaching_add->jml_tahapan->cellAttributes() ?>>
<span id="el_t_rkcoaching_jml_tahapan">
<input type="text" data-table="t_rkcoaching" data-field="x_jml_tahapan" name="x_jml_tahapan" id="x_jml_tahapan" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($t_rkcoaching_add->jml_tahapan->getPlaceHolder()) ?>" value="<?php echo $t_rkcoaching_add->jml_tahapan->EditValue ?>"<?php echo $t_rkcoaching_add->jml_tahapan->editAttributes() ?>>
</span>
<?php echo $t_rkcoaching_add->jml_tahapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkcoaching_add->jml_peserta->Visible) { // jml_peserta ?>
	<div id="r_jml_peserta" class="form-group row">
		<label id="elh_t_rkcoaching_jml_peserta" for="x_jml_peserta" class="<?php echo $t_rkcoaching_add->LeftColumnClass ?>"><?php echo $t_rkcoaching_add->jml_peserta->caption() ?><?php echo $t_rkcoaching_add->jml_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkcoaching_add->RightColumnClass ?>"><div <?php echo $t_rkcoaching_add->jml_peserta->cellAttributes() ?>>
<span id="el_t_rkcoaching_jml_peserta">
<input type="text" data-table="t_rkcoaching" data-field="x_jml_peserta" name="x_jml_peserta" id="x_jml_peserta" size="2" maxlength="5" placeholder="<?php echo HtmlEncode($t_rkcoaching_add->jml_peserta->getPlaceHolder()) ?>" value="<?php echo $t_rkcoaching_add->jml_peserta->EditValue ?>"<?php echo $t_rkcoaching_add->jml_peserta->editAttributes() ?>>
</span>
<?php echo $t_rkcoaching_add->jml_peserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkcoaching_add->tahun_keg->Visible) { // tahun_keg ?>
	<div id="r_tahun_keg" class="form-group row">
		<label id="elh_t_rkcoaching_tahun_keg" for="x_tahun_keg" class="<?php echo $t_rkcoaching_add->LeftColumnClass ?>"><?php echo $t_rkcoaching_add->tahun_keg->caption() ?><?php echo $t_rkcoaching_add->tahun_keg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkcoaching_add->RightColumnClass ?>"><div <?php echo $t_rkcoaching_add->tahun_keg->cellAttributes() ?>>
<span id="el_t_rkcoaching_tahun_keg">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rkcoaching" data-field="x_tahun_keg" data-value-separator="<?php echo $t_rkcoaching_add->tahun_keg->displayValueSeparatorAttribute() ?>" id="x_tahun_keg" name="x_tahun_keg"<?php echo $t_rkcoaching_add->tahun_keg->editAttributes() ?>>
			<?php echo $t_rkcoaching_add->tahun_keg->selectOptionListHtml("x_tahun_keg") ?>
		</select>
</div>
<?php echo $t_rkcoaching_add->tahun_keg->Lookup->getParamTag($t_rkcoaching_add, "p_x_tahun_keg") ?>
</span>
<?php echo $t_rkcoaching_add->tahun_keg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkcoaching_add->mou->Visible) { // mou ?>
	<div id="r_mou" class="form-group row">
		<label id="elh_t_rkcoaching_mou" class="<?php echo $t_rkcoaching_add->LeftColumnClass ?>"><?php echo $t_rkcoaching_add->mou->caption() ?><?php echo $t_rkcoaching_add->mou->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkcoaching_add->RightColumnClass ?>"><div <?php echo $t_rkcoaching_add->mou->cellAttributes() ?>>
<span id="el_t_rkcoaching_mou">
<div id="fd_x_mou">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rkcoaching_add->mou->title() ?>" data-table="t_rkcoaching" data-field="x_mou" name="x_mou" id="x_mou" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rkcoaching_add->mou->editAttributes() ?><?php if ($t_rkcoaching_add->mou->ReadOnly || $t_rkcoaching_add->mou->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_mou"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_mou" id= "fn_x_mou" value="<?php echo $t_rkcoaching_add->mou->Upload->FileName ?>">
<input type="hidden" name="fa_x_mou" id= "fa_x_mou" value="0">
<input type="hidden" name="fs_x_mou" id= "fs_x_mou" value="255">
<input type="hidden" name="fx_x_mou" id= "fx_x_mou" value="<?php echo $t_rkcoaching_add->mou->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_mou" id= "fm_x_mou" value="<?php echo $t_rkcoaching_add->mou->UploadMaxFileSize ?>">
</div>
<table id="ft_x_mou" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rkcoaching_add->mou->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("t_coachingtahapan", explode(",", $t_rkcoaching->getCurrentDetailTable())) && $t_coachingtahapan->DetailAdd) {
?>
<?php if ($t_rkcoaching->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_coachingtahapan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_coachingtahapangrid.php" ?>
<?php } ?>
<?php
	if (in_array("t_coaching", explode(",", $t_rkcoaching->getCurrentDetailTable())) && $t_coaching->DetailAdd) {
?>
<?php if ($t_rkcoaching->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_coaching", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_coachinggrid.php" ?>
<?php } ?>
<?php if (!$t_rkcoaching_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_rkcoaching_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rkcoaching_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_rkcoaching_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	</script><style>#dsl_x_area{background-color:#fff;}</style><script>
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_rkcoaching_add->terminate();
?>