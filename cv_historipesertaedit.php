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
$cv_historipeserta_edit = new cv_historipeserta_edit();

// Run the page
$cv_historipeserta_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipeserta_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcv_historipesertaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcv_historipesertaedit = currentForm = new ew.Form("fcv_historipesertaedit", "edit");

	// Validate form
	fcv_historipesertaedit.validate = function() {
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
			<?php if ($cv_historipeserta_edit->kdhistori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdhistori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_edit->kdhistori->caption(), $cv_historipeserta_edit->kdhistori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_edit->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_edit->kdpelat->caption(), $cv_historipeserta_edit->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_edit->id->caption(), $cv_historipeserta_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipeserta_edit->id->errorMessage()) ?>");
			<?php if ($cv_historipeserta_edit->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_edit->tahun->caption(), $cv_historipeserta_edit->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipeserta_edit->tahun->errorMessage()) ?>");
			<?php if ($cv_historipeserta_edit->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_edit->kdinformasi->caption(), $cv_historipeserta_edit->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_edit->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_edit->harapan->caption(), $cv_historipeserta_edit->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_edit->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_edit->sertifikat->caption(), $cv_historipeserta_edit->sertifikat->RequiredErrorMessage)) ?>");
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
	fcv_historipesertaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_historipesertaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_historipesertaedit.lists["x_id"] = <?php echo $cv_historipeserta_edit->id->Lookup->toClientList($cv_historipeserta_edit) ?>;
	fcv_historipesertaedit.lists["x_id"].options = <?php echo JsonEncode($cv_historipeserta_edit->id->lookupOptions()) ?>;
	fcv_historipesertaedit.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_historipesertaedit.lists["x_kdinformasi"] = <?php echo $cv_historipeserta_edit->kdinformasi->Lookup->toClientList($cv_historipeserta_edit) ?>;
	fcv_historipesertaedit.lists["x_kdinformasi"].options = <?php echo JsonEncode($cv_historipeserta_edit->kdinformasi->lookupOptions()) ?>;
	loadjs.done("fcv_historipesertaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cv_historipeserta_edit->showPageHeader(); ?>
<?php
$cv_historipeserta_edit->showMessage();
?>
<form name="fcv_historipesertaedit" id="fcv_historipesertaedit" class="<?php echo $cv_historipeserta_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historipeserta">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cv_historipeserta_edit->IsModal ?>">
<?php if ($cv_historipeserta->getCurrentMasterTable() == "t_pelatihan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pelatihan">
<input type="hidden" name="fk_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_edit->kdpelat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($cv_historipeserta_edit->kdhistori->Visible) { // kdhistori ?>
	<div id="r_kdhistori" class="form-group row">
		<label id="elh_cv_historipeserta_kdhistori" class="<?php echo $cv_historipeserta_edit->LeftColumnClass ?>"><?php echo $cv_historipeserta_edit->kdhistori->caption() ?><?php echo $cv_historipeserta_edit->kdhistori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_edit->RightColumnClass ?>"><div <?php echo $cv_historipeserta_edit->kdhistori->cellAttributes() ?>>
<span id="el_cv_historipeserta_kdhistori">
<span<?php echo $cv_historipeserta_edit->kdhistori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_edit->kdhistori->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="x_kdhistori" id="x_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_edit->kdhistori->CurrentValue) ?>">
<?php echo $cv_historipeserta_edit->kdhistori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_edit->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_cv_historipeserta_kdpelat" for="x_kdpelat" class="<?php echo $cv_historipeserta_edit->LeftColumnClass ?>"><?php echo $cv_historipeserta_edit->kdpelat->caption() ?><?php echo $cv_historipeserta_edit->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_edit->RightColumnClass ?>"><div <?php echo $cv_historipeserta_edit->kdpelat->cellAttributes() ?>>
<span id="el_cv_historipeserta_kdpelat">
<span<?php echo $cv_historipeserta_edit->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_edit->kdpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_edit->kdpelat->CurrentValue) ?>">
<?php echo $cv_historipeserta_edit->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_cv_historipeserta_id" class="<?php echo $cv_historipeserta_edit->LeftColumnClass ?>"><?php echo $cv_historipeserta_edit->id->caption() ?><?php echo $cv_historipeserta_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_edit->RightColumnClass ?>"><div <?php echo $cv_historipeserta_edit->id->cellAttributes() ?>>
<span id="el_cv_historipeserta_id">
<?php
$onchange = $cv_historipeserta_edit->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipeserta_edit->id->EditAttrs["onchange"] = "";
?>
<span id="as_x_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id" id="sv_x_id" value="<?php echo RemoveHtml($cv_historipeserta_edit->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipeserta_edit->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipeserta_edit->id->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_edit->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipeserta_edit->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipeserta_edit->id->ReadOnly || $cv_historipeserta_edit->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipeserta_edit->id->displayValueSeparatorAttribute() ?>" name="x_id" id="x_id" value="<?php echo HtmlEncode($cv_historipeserta_edit->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipesertaedit"], function() {
	fcv_historipesertaedit.createAutoSuggest({"id":"x_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $cv_historipeserta_edit->id->Lookup->getParamTag($cv_historipeserta_edit, "p_x_id") ?>
</span>
<?php echo $cv_historipeserta_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_edit->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_cv_historipeserta_tahun" for="x_tahun" class="<?php echo $cv_historipeserta_edit->LeftColumnClass ?>"><?php echo $cv_historipeserta_edit->tahun->caption() ?><?php echo $cv_historipeserta_edit->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_edit->RightColumnClass ?>"><div <?php echo $cv_historipeserta_edit->tahun->cellAttributes() ?>>
<span id="el_cv_historipeserta_tahun">
<input type="text" data-table="cv_historipeserta" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_edit->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_edit->tahun->EditValue ?>"<?php echo $cv_historipeserta_edit->tahun->editAttributes() ?>>
</span>
<?php echo $cv_historipeserta_edit->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_edit->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label id="elh_cv_historipeserta_kdinformasi" for="x_kdinformasi" class="<?php echo $cv_historipeserta_edit->LeftColumnClass ?>"><?php echo $cv_historipeserta_edit->kdinformasi->caption() ?><?php echo $cv_historipeserta_edit->kdinformasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_edit->RightColumnClass ?>"><div <?php echo $cv_historipeserta_edit->kdinformasi->cellAttributes() ?>>
<span id="el_cv_historipeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipeserta_edit->kdinformasi->displayValueSeparatorAttribute() ?>" id="x_kdinformasi" name="x_kdinformasi"<?php echo $cv_historipeserta_edit->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipeserta_edit->kdinformasi->selectOptionListHtml("x_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipeserta_edit->kdinformasi->Lookup->getParamTag($cv_historipeserta_edit, "p_x_kdinformasi") ?>
</span>
<?php echo $cv_historipeserta_edit->kdinformasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_edit->harapan->Visible) { // harapan ?>
	<div id="r_harapan" class="form-group row">
		<label id="elh_cv_historipeserta_harapan" for="x_harapan" class="<?php echo $cv_historipeserta_edit->LeftColumnClass ?>"><?php echo $cv_historipeserta_edit->harapan->caption() ?><?php echo $cv_historipeserta_edit->harapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_edit->RightColumnClass ?>"><div <?php echo $cv_historipeserta_edit->harapan->cellAttributes() ?>>
<span id="el_cv_historipeserta_harapan">
<textarea data-table="cv_historipeserta" data-field="x_harapan" name="x_harapan" id="x_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_edit->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_edit->harapan->editAttributes() ?>><?php echo $cv_historipeserta_edit->harapan->EditValue ?></textarea>
</span>
<?php echo $cv_historipeserta_edit->harapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historipeserta_edit->sertifikat->Visible) { // sertifikat ?>
	<div id="r_sertifikat" class="form-group row">
		<label id="elh_cv_historipeserta_sertifikat" for="x_sertifikat" class="<?php echo $cv_historipeserta_edit->LeftColumnClass ?>"><?php echo $cv_historipeserta_edit->sertifikat->caption() ?><?php echo $cv_historipeserta_edit->sertifikat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historipeserta_edit->RightColumnClass ?>"><div <?php echo $cv_historipeserta_edit->sertifikat->cellAttributes() ?>>
<span id="el_cv_historipeserta_sertifikat">
<input type="text" data-table="cv_historipeserta" data-field="x_sertifikat" name="x_sertifikat" id="x_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipeserta_edit->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_edit->sertifikat->EditValue ?>"<?php echo $cv_historipeserta_edit->sertifikat->editAttributes() ?>>
</span>
<?php echo $cv_historipeserta_edit->sertifikat->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cv_historipeserta_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cv_historipeserta_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cv_historipeserta_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cv_historipeserta_edit->showPageFooter();
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
$cv_historipeserta_edit->terminate();
?>