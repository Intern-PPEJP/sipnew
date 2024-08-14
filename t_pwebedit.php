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
$t_pweb_edit = new t_pweb_edit();

// Run the page
$t_pweb_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pweb_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pwebedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_pwebedit = currentForm = new ew.Form("ft_pwebedit", "edit");

	// Validate form
	ft_pwebedit.validate = function() {
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
			<?php if ($t_pweb_edit->kdhistori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdhistori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_edit->kdhistori->caption(), $t_pweb_edit->kdhistori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_edit->rkwid->Required) { ?>
				elm = this.getElements("x" + infix + "_rkwid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_edit->rkwid->caption(), $t_pweb_edit->rkwid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_edit->id->caption(), $t_pweb_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pweb_edit->id->errorMessage()) ?>");
			<?php if ($t_pweb_edit->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_edit->tahun->caption(), $t_pweb_edit->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_edit->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_edit->kdinformasi->caption(), $t_pweb_edit->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_edit->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_edit->harapan->caption(), $t_pweb_edit->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_edit->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_edit->sertifikat->caption(), $t_pweb_edit->sertifikat->RequiredErrorMessage)) ?>");
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
	ft_pwebedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pwebedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pwebedit.lists["x_id"] = <?php echo $t_pweb_edit->id->Lookup->toClientList($t_pweb_edit) ?>;
	ft_pwebedit.lists["x_id"].options = <?php echo JsonEncode($t_pweb_edit->id->lookupOptions()) ?>;
	ft_pwebedit.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pwebedit.lists["x_kdinformasi"] = <?php echo $t_pweb_edit->kdinformasi->Lookup->toClientList($t_pweb_edit) ?>;
	ft_pwebedit.lists["x_kdinformasi"].options = <?php echo JsonEncode($t_pweb_edit->kdinformasi->lookupOptions()) ?>;
	loadjs.done("ft_pwebedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pweb_edit->showPageHeader(); ?>
<?php
$t_pweb_edit->showMessage();
?>
<form name="ft_pwebedit" id="ft_pwebedit" class="<?php echo $t_pweb_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pweb">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_pweb_edit->IsModal ?>">
<?php if ($t_pweb->getCurrentMasterTable() == "webinar") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="webinar">
<input type="hidden" name="fk_rkwid" value="<?php echo HtmlEncode($t_pweb_edit->rkwid->getSessionValue()) ?>">
<input type="hidden" name="fk_tahun" value="<?php echo HtmlEncode($t_pweb_edit->tahun->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_pweb_edit->kdhistori->Visible) { // kdhistori ?>
	<div id="r_kdhistori" class="form-group row">
		<label id="elh_t_pweb_kdhistori" class="<?php echo $t_pweb_edit->LeftColumnClass ?>"><?php echo $t_pweb_edit->kdhistori->caption() ?><?php echo $t_pweb_edit->kdhistori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_edit->RightColumnClass ?>"><div <?php echo $t_pweb_edit->kdhistori->cellAttributes() ?>>
<span id="el_t_pweb_kdhistori">
<span<?php echo $t_pweb_edit->kdhistori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_edit->kdhistori->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="x_kdhistori" id="x_kdhistori" value="<?php echo HtmlEncode($t_pweb_edit->kdhistori->CurrentValue) ?>">
<?php echo $t_pweb_edit->kdhistori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_edit->rkwid->Visible) { // rkwid ?>
	<div id="r_rkwid" class="form-group row">
		<label id="elh_t_pweb_rkwid" class="<?php echo $t_pweb_edit->LeftColumnClass ?>"><?php echo $t_pweb_edit->rkwid->caption() ?><?php echo $t_pweb_edit->rkwid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_edit->RightColumnClass ?>"><div <?php echo $t_pweb_edit->rkwid->cellAttributes() ?>>
<span id="el_t_pweb_rkwid">
<span<?php echo $t_pweb_edit->rkwid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_edit->rkwid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="x_rkwid" id="x_rkwid" value="<?php echo HtmlEncode($t_pweb_edit->rkwid->CurrentValue) ?>">
<?php echo $t_pweb_edit->rkwid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_t_pweb_id" class="<?php echo $t_pweb_edit->LeftColumnClass ?>"><?php echo $t_pweb_edit->id->caption() ?><?php echo $t_pweb_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_edit->RightColumnClass ?>"><div <?php echo $t_pweb_edit->id->cellAttributes() ?>>
<span id="el_t_pweb_id">
<?php
$onchange = $t_pweb_edit->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_edit->id->EditAttrs["onchange"] = "";
?>
<span id="as_x_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id" id="sv_x_id" value="<?php echo RemoveHtml($t_pweb_edit->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_pweb_edit->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_edit->id->getPlaceHolder()) ?>"<?php echo $t_pweb_edit->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_pweb_edit->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($t_pweb_edit->id->ReadOnly || $t_pweb_edit->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_pweb_edit->id->displayValueSeparatorAttribute() ?>" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_pweb_edit->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pwebedit"], function() {
	ft_pwebedit.createAutoSuggest({"id":"x_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $t_pweb_edit->id->Lookup->getParamTag($t_pweb_edit, "p_x_id") ?>
</span>
<?php echo $t_pweb_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_edit->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_t_pweb_tahun" for="x_tahun" class="<?php echo $t_pweb_edit->LeftColumnClass ?>"><?php echo $t_pweb_edit->tahun->caption() ?><?php echo $t_pweb_edit->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_edit->RightColumnClass ?>"><div <?php echo $t_pweb_edit->tahun->cellAttributes() ?>>
<span id="el_t_pweb_tahun">
<span<?php echo $t_pweb_edit->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_edit->tahun->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="x_tahun" id="x_tahun" value="<?php echo HtmlEncode($t_pweb_edit->tahun->CurrentValue) ?>">
<?php echo $t_pweb_edit->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_edit->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label id="elh_t_pweb_kdinformasi" for="x_kdinformasi" class="<?php echo $t_pweb_edit->LeftColumnClass ?>"><?php echo $t_pweb_edit->kdinformasi->caption() ?><?php echo $t_pweb_edit->kdinformasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_edit->RightColumnClass ?>"><div <?php echo $t_pweb_edit->kdinformasi->cellAttributes() ?>>
<span id="el_t_pweb_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pweb" data-field="x_kdinformasi" data-value-separator="<?php echo $t_pweb_edit->kdinformasi->displayValueSeparatorAttribute() ?>" id="x_kdinformasi" name="x_kdinformasi"<?php echo $t_pweb_edit->kdinformasi->editAttributes() ?>>
			<?php echo $t_pweb_edit->kdinformasi->selectOptionListHtml("x_kdinformasi") ?>
		</select>
</div>
<?php echo $t_pweb_edit->kdinformasi->Lookup->getParamTag($t_pweb_edit, "p_x_kdinformasi") ?>
</span>
<?php echo $t_pweb_edit->kdinformasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_edit->harapan->Visible) { // harapan ?>
	<div id="r_harapan" class="form-group row">
		<label id="elh_t_pweb_harapan" for="x_harapan" class="<?php echo $t_pweb_edit->LeftColumnClass ?>"><?php echo $t_pweb_edit->harapan->caption() ?><?php echo $t_pweb_edit->harapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_edit->RightColumnClass ?>"><div <?php echo $t_pweb_edit->harapan->cellAttributes() ?>>
<span id="el_t_pweb_harapan">
<textarea data-table="t_pweb" data-field="x_harapan" name="x_harapan" id="x_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_pweb_edit->harapan->getPlaceHolder()) ?>"<?php echo $t_pweb_edit->harapan->editAttributes() ?>><?php echo $t_pweb_edit->harapan->EditValue ?></textarea>
</span>
<?php echo $t_pweb_edit->harapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_edit->sertifikat->Visible) { // sertifikat ?>
	<div id="r_sertifikat" class="form-group row">
		<label id="elh_t_pweb_sertifikat" for="x_sertifikat" class="<?php echo $t_pweb_edit->LeftColumnClass ?>"><?php echo $t_pweb_edit->sertifikat->caption() ?><?php echo $t_pweb_edit->sertifikat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_edit->RightColumnClass ?>"><div <?php echo $t_pweb_edit->sertifikat->cellAttributes() ?>>
<span id="el_t_pweb_sertifikat">
<input type="text" data-table="t_pweb" data-field="x_sertifikat" name="x_sertifikat" id="x_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pweb_edit->sertifikat->getPlaceHolder()) ?>" value="<?php echo $t_pweb_edit->sertifikat->EditValue ?>"<?php echo $t_pweb_edit->sertifikat->editAttributes() ?>>
</span>
<?php echo $t_pweb_edit->sertifikat->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_pweb_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pweb_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pweb_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pweb_edit->showPageFooter();
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
$t_pweb_edit->terminate();
?>