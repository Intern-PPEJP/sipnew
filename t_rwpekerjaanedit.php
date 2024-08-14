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
$t_rwpekerjaan_edit = new t_rwpekerjaan_edit();

// Run the page
$t_rwpekerjaan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpekerjaan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rwpekerjaanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_rwpekerjaanedit = currentForm = new ew.Form("ft_rwpekerjaanedit", "edit");

	// Validate form
	ft_rwpekerjaanedit.validate = function() {
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
			<?php if ($t_rwpekerjaan_edit->rwkerjaid->Required) { ?>
				elm = this.getElements("x" + infix + "_rwkerjaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_edit->rwkerjaid->caption(), $t_rwpekerjaan_edit->rwkerjaid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpekerjaan_edit->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_edit->bioid->caption(), $t_rwpekerjaan_edit->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpekerjaan_edit->bioid->errorMessage()) ?>");
			<?php if ($t_rwpekerjaan_edit->perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_edit->perusahaan->caption(), $t_rwpekerjaan_edit->perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpekerjaan_edit->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_edit->jabatan->caption(), $t_rwpekerjaan_edit->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpekerjaan_edit->mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_edit->mulai->caption(), $t_rwpekerjaan_edit->mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_mulai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpekerjaan_edit->mulai->errorMessage()) ?>");
			<?php if ($t_rwpekerjaan_edit->hingga->Required) { ?>
				elm = this.getElements("x" + infix + "_hingga");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_edit->hingga->caption(), $t_rwpekerjaan_edit->hingga->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_hingga");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpekerjaan_edit->hingga->errorMessage()) ?>");
			<?php if ($t_rwpekerjaan_edit->updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_edit->updated_by->caption(), $t_rwpekerjaan_edit->updated_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpekerjaan_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_edit->updated_at->caption(), $t_rwpekerjaan_edit->updated_at->RequiredErrorMessage)) ?>");
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
	ft_rwpekerjaanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rwpekerjaanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_rwpekerjaanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rwpekerjaan_edit->showPageHeader(); ?>
<?php
$t_rwpekerjaan_edit->showMessage();
?>
<form name="ft_rwpekerjaanedit" id="ft_rwpekerjaanedit" class="<?php echo $t_rwpekerjaan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwpekerjaan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_rwpekerjaan_edit->IsModal ?>">
<?php if ($t_rwpekerjaan->getCurrentMasterTable() == "t_biointruktur") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_edit->bioid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_rwpekerjaan_edit->rwkerjaid->Visible) { // rwkerjaid ?>
	<div id="r_rwkerjaid" class="form-group row">
		<label id="elh_t_rwpekerjaan_rwkerjaid" class="<?php echo $t_rwpekerjaan_edit->LeftColumnClass ?>"><?php echo $t_rwpekerjaan_edit->rwkerjaid->caption() ?><?php echo $t_rwpekerjaan_edit->rwkerjaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpekerjaan_edit->RightColumnClass ?>"><div <?php echo $t_rwpekerjaan_edit->rwkerjaid->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_rwkerjaid">
<span<?php echo $t_rwpekerjaan_edit->rwkerjaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_edit->rwkerjaid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="x_rwkerjaid" id="x_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_edit->rwkerjaid->CurrentValue) ?>">
<?php echo $t_rwpekerjaan_edit->rwkerjaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwpekerjaan_edit->bioid->Visible) { // bioid ?>
	<div id="r_bioid" class="form-group row">
		<label id="elh_t_rwpekerjaan_bioid" for="x_bioid" class="<?php echo $t_rwpekerjaan_edit->LeftColumnClass ?>"><?php echo $t_rwpekerjaan_edit->bioid->caption() ?><?php echo $t_rwpekerjaan_edit->bioid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpekerjaan_edit->RightColumnClass ?>"><div <?php echo $t_rwpekerjaan_edit->bioid->cellAttributes() ?>>
<?php if ($t_rwpekerjaan_edit->bioid->getSessionValue() != "") { ?>
<span id="el_t_rwpekerjaan_bioid">
<span<?php echo $t_rwpekerjaan_edit->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_edit->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_bioid" name="x_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_edit->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_rwpekerjaan_bioid">
<input type="text" data-table="t_rwpekerjaan" data-field="x_bioid" name="x_bioid" id="x_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_edit->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_edit->bioid->EditValue ?>"<?php echo $t_rwpekerjaan_edit->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_rwpekerjaan_edit->bioid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwpekerjaan_edit->perusahaan->Visible) { // perusahaan ?>
	<div id="r_perusahaan" class="form-group row">
		<label id="elh_t_rwpekerjaan_perusahaan" for="x_perusahaan" class="<?php echo $t_rwpekerjaan_edit->LeftColumnClass ?>"><?php echo $t_rwpekerjaan_edit->perusahaan->caption() ?><?php echo $t_rwpekerjaan_edit->perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpekerjaan_edit->RightColumnClass ?>"><div <?php echo $t_rwpekerjaan_edit->perusahaan->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_perusahaan">
<input type="text" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="x_perusahaan" id="x_perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_edit->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_edit->perusahaan->EditValue ?>"<?php echo $t_rwpekerjaan_edit->perusahaan->editAttributes() ?>>
</span>
<?php echo $t_rwpekerjaan_edit->perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwpekerjaan_edit->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_t_rwpekerjaan_jabatan" for="x_jabatan" class="<?php echo $t_rwpekerjaan_edit->LeftColumnClass ?>"><?php echo $t_rwpekerjaan_edit->jabatan->caption() ?><?php echo $t_rwpekerjaan_edit->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpekerjaan_edit->RightColumnClass ?>"><div <?php echo $t_rwpekerjaan_edit->jabatan->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_jabatan">
<input type="text" data-table="t_rwpekerjaan" data-field="x_jabatan" name="x_jabatan" id="x_jabatan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_edit->jabatan->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_edit->jabatan->EditValue ?>"<?php echo $t_rwpekerjaan_edit->jabatan->editAttributes() ?>>
</span>
<?php echo $t_rwpekerjaan_edit->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwpekerjaan_edit->mulai->Visible) { // mulai ?>
	<div id="r_mulai" class="form-group row">
		<label id="elh_t_rwpekerjaan_mulai" for="x_mulai" class="<?php echo $t_rwpekerjaan_edit->LeftColumnClass ?>"><?php echo $t_rwpekerjaan_edit->mulai->caption() ?><?php echo $t_rwpekerjaan_edit->mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpekerjaan_edit->RightColumnClass ?>"><div <?php echo $t_rwpekerjaan_edit->mulai->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_mulai">
<input type="text" data-table="t_rwpekerjaan" data-field="x_mulai" name="x_mulai" id="x_mulai" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_edit->mulai->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_edit->mulai->EditValue ?>"<?php echo $t_rwpekerjaan_edit->mulai->editAttributes() ?>>
</span>
<?php echo $t_rwpekerjaan_edit->mulai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwpekerjaan_edit->hingga->Visible) { // hingga ?>
	<div id="r_hingga" class="form-group row">
		<label id="elh_t_rwpekerjaan_hingga" for="x_hingga" class="<?php echo $t_rwpekerjaan_edit->LeftColumnClass ?>"><?php echo $t_rwpekerjaan_edit->hingga->caption() ?><?php echo $t_rwpekerjaan_edit->hingga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpekerjaan_edit->RightColumnClass ?>"><div <?php echo $t_rwpekerjaan_edit->hingga->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_hingga">
<input type="text" data-table="t_rwpekerjaan" data-field="x_hingga" name="x_hingga" id="x_hingga" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_edit->hingga->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_edit->hingga->EditValue ?>"<?php echo $t_rwpekerjaan_edit->hingga->editAttributes() ?>>
</span>
<?php echo $t_rwpekerjaan_edit->hingga->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_rwpekerjaan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_rwpekerjaan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rwpekerjaan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_rwpekerjaan_edit->showPageFooter();
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
$t_rwpekerjaan_edit->terminate();
?>