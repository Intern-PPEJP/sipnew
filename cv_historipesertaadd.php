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
$cv_historipeserta_add = new cv_historipeserta_add();

// Run the page
$cv_historipeserta_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipeserta_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcv_historipesertaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcv_historipesertaadd = currentForm = new ew.Form("fcv_historipesertaadd", "add");

	// Validate form
	fcv_historipesertaadd.validate = function() {
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
			<?php if ($cv_historipeserta_add->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_add->kdpelat->caption(), $cv_historipeserta_add->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_add->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_add->id->caption(), $cv_historipeserta_add->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipeserta_add->id->errorMessage()) ?>");
			<?php if ($cv_historipeserta_add->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_add->tahun->caption(), $cv_historipeserta_add->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipeserta_add->tahun->errorMessage()) ?>");
			<?php if ($cv_historipeserta_add->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_add->kdinformasi->caption(), $cv_historipeserta_add->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_add->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_add->harapan->caption(), $cv_historipeserta_add->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_add->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_add->sertifikat->caption(), $cv_historipeserta_add->sertifikat->RequiredErrorMessage)) ?>");
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
	fcv_historipesertaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_historipesertaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_historipesertaadd.lists["x_id"] = <?php echo $cv_historipeserta_add->id->Lookup->toClientList($cv_historipeserta_add) ?>;
	fcv_historipesertaadd.lists["x_id"].options = <?php echo JsonEncode($cv_historipeserta_add->id->lookupOptions()) ?>;
	fcv_historipesertaadd.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_historipesertaadd.lists["x_kdinformasi"] = <?php echo $cv_historipeserta_add->kdinformasi->Lookup->toClientList($cv_historipeserta_add) ?>;
	fcv_historipesertaadd.lists["x_kdinformasi"].options = <?php echo JsonEncode($cv_historipeserta_add->kdinformasi->lookupOptions()) ?>;
	loadjs.done("fcv_historipesertaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cv_historipeserta_add->showPageHeader(); ?>
<?php
$cv_historipeserta_add->showMessage();
?>
<form name="fcv_historipesertaadd" id="fcv_historipesertaadd" class="<?php echo $cv_historipeserta_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historipeserta">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$cv_historipeserta_add->IsModal ?>">
<?php if ($cv_historipeserta->getCurrentMasterTable() == "t_pelatihan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pelatihan">
<input type="hidden" name="fk_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_add->kdpelat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($cv_historipeserta_add->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_cv_historipeserta_kdpelat" for="x_kdpelat" class="<?php echo $cv_historipeserta_add->LeftColumnClass ?>"><?php echo $cv_historipeserta_add->kdpelat->caption() ?><?php echo $cv_historipeserta_add->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipeserta_add->kdpelat->cellAttributes() ?>>
<?php if ($cv_historipeserta_add->kdpelat->getSessionValue() != "") { ?>
<span id="el_cv_historipeserta_kdpelat">
<span<?php echo $cv_historipeserta_add->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_add->kdpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdpelat" name="x_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_add->kdpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cv_historipeserta_kdpelat">
<input type="text" data-table="cv_historipeserta" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($cv_historipeserta_add->kdpelat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_add->kdpelat->EditValue ?>"<?php echo $cv_historipeserta_add->kdpelat->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $cv_historipeserta_add->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_add->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_cv_historipeserta_id" class="<?php echo $cv_historipeserta_add->LeftColumnClass ?>"><?php echo $cv_historipeserta_add->id->caption() ?><?php echo $cv_historipeserta_add->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipeserta_add->id->cellAttributes() ?>>
<span id="el_cv_historipeserta_id">
<?php
$onchange = $cv_historipeserta_add->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipeserta_add->id->EditAttrs["onchange"] = "";
?>
<span id="as_x_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id" id="sv_x_id" value="<?php echo RemoveHtml($cv_historipeserta_add->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipeserta_add->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipeserta_add->id->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_add->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipeserta_add->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipeserta_add->id->ReadOnly || $cv_historipeserta_add->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipeserta_add->id->displayValueSeparatorAttribute() ?>" name="x_id" id="x_id" value="<?php echo HtmlEncode($cv_historipeserta_add->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipesertaadd"], function() {
	fcv_historipesertaadd.createAutoSuggest({"id":"x_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $cv_historipeserta_add->id->Lookup->getParamTag($cv_historipeserta_add, "p_x_id") ?>
</span>
<?php echo $cv_historipeserta_add->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_add->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_cv_historipeserta_tahun" for="x_tahun" class="<?php echo $cv_historipeserta_add->LeftColumnClass ?>"><?php echo $cv_historipeserta_add->tahun->caption() ?><?php echo $cv_historipeserta_add->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipeserta_add->tahun->cellAttributes() ?>>
<span id="el_cv_historipeserta_tahun">
<input type="text" data-table="cv_historipeserta" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_add->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_add->tahun->EditValue ?>"<?php echo $cv_historipeserta_add->tahun->editAttributes() ?>>
</span>
<?php echo $cv_historipeserta_add->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_add->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label id="elh_cv_historipeserta_kdinformasi" for="x_kdinformasi" class="<?php echo $cv_historipeserta_add->LeftColumnClass ?>"><?php echo $cv_historipeserta_add->kdinformasi->caption() ?><?php echo $cv_historipeserta_add->kdinformasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipeserta_add->kdinformasi->cellAttributes() ?>>
<span id="el_cv_historipeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipeserta_add->kdinformasi->displayValueSeparatorAttribute() ?>" id="x_kdinformasi" name="x_kdinformasi"<?php echo $cv_historipeserta_add->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipeserta_add->kdinformasi->selectOptionListHtml("x_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipeserta_add->kdinformasi->Lookup->getParamTag($cv_historipeserta_add, "p_x_kdinformasi") ?>
</span>
<?php echo $cv_historipeserta_add->kdinformasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_add->harapan->Visible) { // harapan ?>
	<div id="r_harapan" class="form-group row">
		<label id="elh_cv_historipeserta_harapan" for="x_harapan" class="<?php echo $cv_historipeserta_add->LeftColumnClass ?>"><?php echo $cv_historipeserta_add->harapan->caption() ?><?php echo $cv_historipeserta_add->harapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipeserta_add->harapan->cellAttributes() ?>>
<span id="el_cv_historipeserta_harapan">
<textarea data-table="cv_historipeserta" data-field="x_harapan" name="x_harapan" id="x_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_add->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_add->harapan->editAttributes() ?>><?php echo $cv_historipeserta_add->harapan->EditValue ?></textarea>
</span>
<?php echo $cv_historipeserta_add->harapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_add->sertifikat->Visible) { // sertifikat ?>
	<div id="r_sertifikat" class="form-group row">
		<label id="elh_cv_historipeserta_sertifikat" for="x_sertifikat" class="<?php echo $cv_historipeserta_add->LeftColumnClass ?>"><?php echo $cv_historipeserta_add->sertifikat->caption() ?><?php echo $cv_historipeserta_add->sertifikat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipeserta_add->sertifikat->cellAttributes() ?>>
<span id="el_cv_historipeserta_sertifikat">
<input type="text" data-table="cv_historipeserta" data-field="x_sertifikat" name="x_sertifikat" id="x_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipeserta_add->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_add->sertifikat->EditValue ?>"<?php echo $cv_historipeserta_add->sertifikat->editAttributes() ?>>
</span>
<?php echo $cv_historipeserta_add->sertifikat->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cv_historipeserta_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cv_historipeserta_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cv_historipeserta_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cv_historipeserta_add->showPageFooter();
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
$cv_historipeserta_add->terminate();
?>