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
$t_pweb_add = new t_pweb_add();

// Run the page
$t_pweb_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pweb_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pwebadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_pwebadd = currentForm = new ew.Form("ft_pwebadd", "add");

	// Validate form
	ft_pwebadd.validate = function() {
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
			<?php if ($t_pweb_add->rkwid->Required) { ?>
				elm = this.getElements("x" + infix + "_rkwid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_add->rkwid->caption(), $t_pweb_add->rkwid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_rkwid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pweb_add->rkwid->errorMessage()) ?>");
			<?php if ($t_pweb_add->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_add->id->caption(), $t_pweb_add->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pweb_add->id->errorMessage()) ?>");
			<?php if ($t_pweb_add->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_add->tahun->caption(), $t_pweb_add->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pweb_add->tahun->errorMessage()) ?>");
			<?php if ($t_pweb_add->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_add->kdinformasi->caption(), $t_pweb_add->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_add->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_add->harapan->caption(), $t_pweb_add->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_add->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_add->sertifikat->caption(), $t_pweb_add->sertifikat->RequiredErrorMessage)) ?>");
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
	ft_pwebadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pwebadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pwebadd.lists["x_rkwid"] = <?php echo $t_pweb_add->rkwid->Lookup->toClientList($t_pweb_add) ?>;
	ft_pwebadd.lists["x_rkwid"].options = <?php echo JsonEncode($t_pweb_add->rkwid->lookupOptions()) ?>;
	ft_pwebadd.autoSuggests["x_rkwid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pwebadd.lists["x_id"] = <?php echo $t_pweb_add->id->Lookup->toClientList($t_pweb_add) ?>;
	ft_pwebadd.lists["x_id"].options = <?php echo JsonEncode($t_pweb_add->id->lookupOptions()) ?>;
	ft_pwebadd.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pwebadd.lists["x_kdinformasi"] = <?php echo $t_pweb_add->kdinformasi->Lookup->toClientList($t_pweb_add) ?>;
	ft_pwebadd.lists["x_kdinformasi"].options = <?php echo JsonEncode($t_pweb_add->kdinformasi->lookupOptions()) ?>;
	loadjs.done("ft_pwebadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pweb_add->showPageHeader(); ?>
<?php
$t_pweb_add->showMessage();
?>
<form name="ft_pwebadd" id="ft_pwebadd" class="<?php echo $t_pweb_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pweb">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_pweb_add->IsModal ?>">
<?php if ($t_pweb->getCurrentMasterTable() == "webinar") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="webinar">
<input type="hidden" name="fk_rkwid" value="<?php echo HtmlEncode($t_pweb_add->rkwid->getSessionValue()) ?>">
<input type="hidden" name="fk_tahun" value="<?php echo HtmlEncode($t_pweb_add->tahun->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pweb_add->rkwid->Visible) { // rkwid ?>
	<div id="r_rkwid" class="form-group row">
		<label id="elh_t_pweb_rkwid" class="<?php echo $t_pweb_add->LeftColumnClass ?>"><?php echo $t_pweb_add->rkwid->caption() ?><?php echo $t_pweb_add->rkwid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_add->RightColumnClass ?>"><div <?php echo $t_pweb_add->rkwid->cellAttributes() ?>>
<?php if ($t_pweb_add->rkwid->getSessionValue() != "") { ?>
<span id="el_t_pweb_rkwid">
<span<?php echo $t_pweb_add->rkwid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_add->rkwid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_rkwid" name="x_rkwid" value="<?php echo HtmlEncode($t_pweb_add->rkwid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_pweb_rkwid">
<?php
$onchange = $t_pweb_add->rkwid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_add->rkwid->EditAttrs["onchange"] = "";
?>
<span id="as_x_rkwid">
	<input type="text" class="form-control" name="sv_x_rkwid" id="sv_x_rkwid" value="<?php echo RemoveHtml($t_pweb_add->rkwid->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($t_pweb_add->rkwid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_add->rkwid->getPlaceHolder()) ?>"<?php echo $t_pweb_add->rkwid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" data-value-separator="<?php echo $t_pweb_add->rkwid->displayValueSeparatorAttribute() ?>" name="x_rkwid" id="x_rkwid" value="<?php echo HtmlEncode($t_pweb_add->rkwid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pwebadd"], function() {
	ft_pwebadd.createAutoSuggest({"id":"x_rkwid","forceSelect":false});
});
</script>
<?php echo $t_pweb_add->rkwid->Lookup->getParamTag($t_pweb_add, "p_x_rkwid") ?>
</span>
<?php } ?>
<?php echo $t_pweb_add->rkwid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_add->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_t_pweb_id" class="<?php echo $t_pweb_add->LeftColumnClass ?>"><?php echo $t_pweb_add->id->caption() ?><?php echo $t_pweb_add->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_add->RightColumnClass ?>"><div <?php echo $t_pweb_add->id->cellAttributes() ?>>
<span id="el_t_pweb_id">
<?php
$onchange = $t_pweb_add->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_add->id->EditAttrs["onchange"] = "";
?>
<span id="as_x_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id" id="sv_x_id" value="<?php echo RemoveHtml($t_pweb_add->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_pweb_add->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_add->id->getPlaceHolder()) ?>"<?php echo $t_pweb_add->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_pweb_add->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($t_pweb_add->id->ReadOnly || $t_pweb_add->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_pweb_add->id->displayValueSeparatorAttribute() ?>" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_pweb_add->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pwebadd"], function() {
	ft_pwebadd.createAutoSuggest({"id":"x_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $t_pweb_add->id->Lookup->getParamTag($t_pweb_add, "p_x_id") ?>
</span>
<?php echo $t_pweb_add->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_add->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_t_pweb_tahun" for="x_tahun" class="<?php echo $t_pweb_add->LeftColumnClass ?>"><?php echo $t_pweb_add->tahun->caption() ?><?php echo $t_pweb_add->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_add->RightColumnClass ?>"><div <?php echo $t_pweb_add->tahun->cellAttributes() ?>>
<?php if ($t_pweb_add->tahun->getSessionValue() != "") { ?>
<span id="el_t_pweb_tahun">
<span<?php echo $t_pweb_add->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_add->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_tahun" name="x_tahun" value="<?php echo HtmlEncode($t_pweb_add->tahun->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_pweb_tahun">
<input type="text" data-table="t_pweb" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pweb_add->tahun->getPlaceHolder()) ?>" value="<?php echo $t_pweb_add->tahun->EditValue ?>"<?php echo $t_pweb_add->tahun->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_pweb_add->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_add->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label id="elh_t_pweb_kdinformasi" for="x_kdinformasi" class="<?php echo $t_pweb_add->LeftColumnClass ?>"><?php echo $t_pweb_add->kdinformasi->caption() ?><?php echo $t_pweb_add->kdinformasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_add->RightColumnClass ?>"><div <?php echo $t_pweb_add->kdinformasi->cellAttributes() ?>>
<span id="el_t_pweb_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pweb" data-field="x_kdinformasi" data-value-separator="<?php echo $t_pweb_add->kdinformasi->displayValueSeparatorAttribute() ?>" id="x_kdinformasi" name="x_kdinformasi"<?php echo $t_pweb_add->kdinformasi->editAttributes() ?>>
			<?php echo $t_pweb_add->kdinformasi->selectOptionListHtml("x_kdinformasi") ?>
		</select>
</div>
<?php echo $t_pweb_add->kdinformasi->Lookup->getParamTag($t_pweb_add, "p_x_kdinformasi") ?>
</span>
<?php echo $t_pweb_add->kdinformasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_add->harapan->Visible) { // harapan ?>
	<div id="r_harapan" class="form-group row">
		<label id="elh_t_pweb_harapan" for="x_harapan" class="<?php echo $t_pweb_add->LeftColumnClass ?>"><?php echo $t_pweb_add->harapan->caption() ?><?php echo $t_pweb_add->harapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_add->RightColumnClass ?>"><div <?php echo $t_pweb_add->harapan->cellAttributes() ?>>
<span id="el_t_pweb_harapan">
<textarea data-table="t_pweb" data-field="x_harapan" name="x_harapan" id="x_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_pweb_add->harapan->getPlaceHolder()) ?>"<?php echo $t_pweb_add->harapan->editAttributes() ?>><?php echo $t_pweb_add->harapan->EditValue ?></textarea>
</span>
<?php echo $t_pweb_add->harapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pweb_add->sertifikat->Visible) { // sertifikat ?>
	<div id="r_sertifikat" class="form-group row">
		<label id="elh_t_pweb_sertifikat" for="x_sertifikat" class="<?php echo $t_pweb_add->LeftColumnClass ?>"><?php echo $t_pweb_add->sertifikat->caption() ?><?php echo $t_pweb_add->sertifikat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pweb_add->RightColumnClass ?>"><div <?php echo $t_pweb_add->sertifikat->cellAttributes() ?>>
<span id="el_t_pweb_sertifikat">
<input type="text" data-table="t_pweb" data-field="x_sertifikat" name="x_sertifikat" id="x_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pweb_add->sertifikat->getPlaceHolder()) ?>" value="<?php echo $t_pweb_add->sertifikat->EditValue ?>"<?php echo $t_pweb_add->sertifikat->editAttributes() ?>>
</span>
<?php echo $t_pweb_add->sertifikat->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_pweb_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pweb_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pweb_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pweb_add->showPageFooter();
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
$t_pweb_add->terminate();
?>