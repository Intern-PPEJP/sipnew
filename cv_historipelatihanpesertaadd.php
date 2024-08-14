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
$cv_historipelatihanpeserta_add = new cv_historipelatihanpeserta_add();

// Run the page
$cv_historipelatihanpeserta_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipelatihanpeserta_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcv_historipelatihanpesertaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcv_historipelatihanpesertaadd = currentForm = new ew.Form("fcv_historipelatihanpesertaadd", "add");

	// Validate form
	fcv_historipelatihanpesertaadd.validate = function() {
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
			<?php if ($cv_historipelatihanpeserta_add->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_add->id->caption(), $cv_historipelatihanpeserta_add->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipelatihanpeserta_add->id->errorMessage()) ?>");
			<?php if ($cv_historipelatihanpeserta_add->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_add->kdpelat->caption(), $cv_historipelatihanpeserta_add->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipelatihanpeserta_add->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_add->tahun->caption(), $cv_historipelatihanpeserta_add->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipelatihanpeserta_add->tahun->errorMessage()) ?>");
			<?php if ($cv_historipelatihanpeserta_add->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_add->kdinformasi->caption(), $cv_historipelatihanpeserta_add->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipelatihanpeserta_add->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_add->harapan->caption(), $cv_historipelatihanpeserta_add->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipelatihanpeserta_add->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_add->sertifikat->caption(), $cv_historipelatihanpeserta_add->sertifikat->RequiredErrorMessage)) ?>");
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
	fcv_historipelatihanpesertaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_historipelatihanpesertaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_historipelatihanpesertaadd.lists["x_id"] = <?php echo $cv_historipelatihanpeserta_add->id->Lookup->toClientList($cv_historipelatihanpeserta_add) ?>;
	fcv_historipelatihanpesertaadd.lists["x_id"].options = <?php echo JsonEncode($cv_historipelatihanpeserta_add->id->lookupOptions()) ?>;
	fcv_historipelatihanpesertaadd.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_historipelatihanpesertaadd.lists["x_kdpelat"] = <?php echo $cv_historipelatihanpeserta_add->kdpelat->Lookup->toClientList($cv_historipelatihanpeserta_add) ?>;
	fcv_historipelatihanpesertaadd.lists["x_kdpelat"].options = <?php echo JsonEncode($cv_historipelatihanpeserta_add->kdpelat->lookupOptions()) ?>;
	fcv_historipelatihanpesertaadd.autoSuggests["x_kdpelat"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_historipelatihanpesertaadd.lists["x_kdinformasi"] = <?php echo $cv_historipelatihanpeserta_add->kdinformasi->Lookup->toClientList($cv_historipelatihanpeserta_add) ?>;
	fcv_historipelatihanpesertaadd.lists["x_kdinformasi"].options = <?php echo JsonEncode($cv_historipelatihanpeserta_add->kdinformasi->lookupOptions()) ?>;
	loadjs.done("fcv_historipelatihanpesertaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cv_historipelatihanpeserta_add->showPageHeader(); ?>
<?php
$cv_historipelatihanpeserta_add->showMessage();
?>
<form name="fcv_historipelatihanpesertaadd" id="fcv_historipelatihanpesertaadd" class="<?php echo $cv_historipelatihanpeserta_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historipelatihanpeserta">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$cv_historipelatihanpeserta_add->IsModal ?>">
<?php if ($cv_historipelatihanpeserta->getCurrentMasterTable() == "t_peserta") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_peserta">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($cv_historipelatihanpeserta_add->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_cv_historipelatihanpeserta_id" class="<?php echo $cv_historipelatihanpeserta_add->LeftColumnClass ?>"><?php echo $cv_historipelatihanpeserta_add->id->caption() ?><?php echo $cv_historipelatihanpeserta_add->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipelatihanpeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipelatihanpeserta_add->id->cellAttributes() ?>>
<?php if ($cv_historipelatihanpeserta_add->id->getSessionValue() != "") { ?>
<span id="el_cv_historipelatihanpeserta_id">
<span<?php echo $cv_historipelatihanpeserta_add->id->viewAttributes() ?>><?php if (!EmptyString($cv_historipelatihanpeserta_add->id->ViewValue) && $cv_historipelatihanpeserta_add->id->linkAttributes() != "") { ?>
<a<?php echo $cv_historipelatihanpeserta_add->id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_add->id->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_add->id->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" id="x_id" name="x_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cv_historipelatihanpeserta_id">
<?php
$onchange = $cv_historipelatihanpeserta_add->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipelatihanpeserta_add->id->EditAttrs["onchange"] = "";
?>
<span id="as_x_id">
	<input type="text" class="form-control" name="sv_x_id" id="sv_x_id" value="<?php echo RemoveHtml($cv_historipelatihanpeserta_add->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->id->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_add->id->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" data-value-separator="<?php echo $cv_historipelatihanpeserta_add->id->displayValueSeparatorAttribute() ?>" name="x_id" id="x_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipelatihanpesertaadd"], function() {
	fcv_historipelatihanpesertaadd.createAutoSuggest({"id":"x_id","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $cv_historipelatihanpeserta_add->id->Lookup->getParamTag($cv_historipelatihanpeserta_add, "p_x_id") ?>
</span>
<?php } ?>
<?php echo $cv_historipelatihanpeserta_add->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_add->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_cv_historipelatihanpeserta_kdpelat" class="<?php echo $cv_historipelatihanpeserta_add->LeftColumnClass ?>"><?php echo $cv_historipelatihanpeserta_add->kdpelat->caption() ?><?php echo $cv_historipelatihanpeserta_add->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipelatihanpeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipelatihanpeserta_add->kdpelat->cellAttributes() ?>>
<span id="el_cv_historipelatihanpeserta_kdpelat">
<?php
$onchange = $cv_historipelatihanpeserta_add->kdpelat->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipelatihanpeserta_add->kdpelat->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdpelat">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kdpelat" id="sv_x_kdpelat" value="<?php echo RemoveHtml($cv_historipelatihanpeserta_add->kdpelat->EditValue) ?>" size="70" maxlength="19" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->kdpelat->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->kdpelat->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_add->kdpelat->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipelatihanpeserta_add->kdpelat->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kdpelat',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipelatihanpeserta_add->kdpelat->ReadOnly || $cv_historipelatihanpeserta_add->kdpelat->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipelatihanpeserta_add->kdpelat->displayValueSeparatorAttribute() ?>" name="x_kdpelat" id="x_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->kdpelat->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipelatihanpesertaadd"], function() {
	fcv_historipelatihanpesertaadd.createAutoSuggest({"id":"x_kdpelat","forceSelect":false,"minWidth":"100px","maxHeight":"120px"});
});
</script>
<?php echo $cv_historipelatihanpeserta_add->kdpelat->Lookup->getParamTag($cv_historipelatihanpeserta_add, "p_x_kdpelat") ?>
</span>
<?php echo $cv_historipelatihanpeserta_add->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_add->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_cv_historipelatihanpeserta_tahun" for="x_tahun" class="<?php echo $cv_historipelatihanpeserta_add->LeftColumnClass ?>"><?php echo $cv_historipelatihanpeserta_add->tahun->caption() ?><?php echo $cv_historipelatihanpeserta_add->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipelatihanpeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipelatihanpeserta_add->tahun->cellAttributes() ?>>
<span id="el_cv_historipelatihanpeserta_tahun">
<input type="text" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipelatihanpeserta_add->tahun->EditValue ?>"<?php echo $cv_historipelatihanpeserta_add->tahun->editAttributes() ?>>
</span>
<?php echo $cv_historipelatihanpeserta_add->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_add->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label id="elh_cv_historipelatihanpeserta_kdinformasi" for="x_kdinformasi" class="<?php echo $cv_historipelatihanpeserta_add->LeftColumnClass ?>"><?php echo $cv_historipelatihanpeserta_add->kdinformasi->caption() ?><?php echo $cv_historipelatihanpeserta_add->kdinformasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipelatihanpeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipelatihanpeserta_add->kdinformasi->cellAttributes() ?>>
<span id="el_cv_historipelatihanpeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipelatihanpeserta_add->kdinformasi->displayValueSeparatorAttribute() ?>" id="x_kdinformasi" name="x_kdinformasi"<?php echo $cv_historipelatihanpeserta_add->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipelatihanpeserta_add->kdinformasi->selectOptionListHtml("x_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipelatihanpeserta_add->kdinformasi->Lookup->getParamTag($cv_historipelatihanpeserta_add, "p_x_kdinformasi") ?>
</span>
<?php echo $cv_historipelatihanpeserta_add->kdinformasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_add->harapan->Visible) { // harapan ?>
	<div id="r_harapan" class="form-group row">
		<label id="elh_cv_historipelatihanpeserta_harapan" for="x_harapan" class="<?php echo $cv_historipelatihanpeserta_add->LeftColumnClass ?>"><?php echo $cv_historipelatihanpeserta_add->harapan->caption() ?><?php echo $cv_historipelatihanpeserta_add->harapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipelatihanpeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipelatihanpeserta_add->harapan->cellAttributes() ?>>
<span id="el_cv_historipelatihanpeserta_harapan">
<textarea data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="x_harapan" id="x_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_add->harapan->editAttributes() ?>><?php echo $cv_historipelatihanpeserta_add->harapan->EditValue ?></textarea>
</span>
<?php echo $cv_historipelatihanpeserta_add->harapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_add->sertifikat->Visible) { // sertifikat ?>
	<div id="r_sertifikat" class="form-group row">
		<label id="elh_cv_historipelatihanpeserta_sertifikat" for="x_sertifikat" class="<?php echo $cv_historipelatihanpeserta_add->LeftColumnClass ?>"><?php echo $cv_historipelatihanpeserta_add->sertifikat->caption() ?><?php echo $cv_historipelatihanpeserta_add->sertifikat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipelatihanpeserta_add->RightColumnClass ?>"><div <?php echo $cv_historipelatihanpeserta_add->sertifikat->cellAttributes() ?>>
<span id="el_cv_historipelatihanpeserta_sertifikat">
<input type="text" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="x_sertifikat" id="x_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_add->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipelatihanpeserta_add->sertifikat->EditValue ?>"<?php echo $cv_historipelatihanpeserta_add->sertifikat->editAttributes() ?>>
</span>
<?php echo $cv_historipelatihanpeserta_add->sertifikat->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cv_historipelatihanpeserta_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cv_historipelatihanpeserta_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cv_historipelatihanpeserta_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cv_historipelatihanpeserta_add->showPageFooter();
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
$cv_historipelatihanpeserta_add->terminate();
?>