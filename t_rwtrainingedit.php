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
$t_rwtraining_edit = new t_rwtraining_edit();

// Run the page
$t_rwtraining_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwtraining_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rwtrainingedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_rwtrainingedit = currentForm = new ew.Form("ft_rwtrainingedit", "edit");

	// Validate form
	ft_rwtrainingedit.validate = function() {
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
			<?php if ($t_rwtraining_edit->rwtrainingid->Required) { ?>
				elm = this.getElements("x" + infix + "_rwtrainingid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_edit->rwtrainingid->caption(), $t_rwtraining_edit->rwtrainingid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwtraining_edit->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_edit->bioid->caption(), $t_rwtraining_edit->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwtraining_edit->bioid->errorMessage()) ?>");
			<?php if ($t_rwtraining_edit->training->Required) { ?>
				elm = this.getElements("x" + infix + "_training");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_edit->training->caption(), $t_rwtraining_edit->training->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwtraining_edit->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_edit->tempat->caption(), $t_rwtraining_edit->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwtraining_edit->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_edit->tahun->caption(), $t_rwtraining_edit->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwtraining_edit->tahun->errorMessage()) ?>");
			<?php if ($t_rwtraining_edit->updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_edit->updated_by->caption(), $t_rwtraining_edit->updated_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwtraining_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_edit->updated_at->caption(), $t_rwtraining_edit->updated_at->RequiredErrorMessage)) ?>");
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
	ft_rwtrainingedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rwtrainingedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_rwtrainingedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rwtraining_edit->showPageHeader(); ?>
<?php
$t_rwtraining_edit->showMessage();
?>
<form name="ft_rwtrainingedit" id="ft_rwtrainingedit" class="<?php echo $t_rwtraining_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwtraining">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_rwtraining_edit->IsModal ?>">
<?php if ($t_rwtraining->getCurrentMasterTable() == "t_biointruktur") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_rwtraining_edit->bioid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_rwtraining_edit->rwtrainingid->Visible) { // rwtrainingid ?>
	<div id="r_rwtrainingid" class="form-group row">
		<label id="elh_t_rwtraining_rwtrainingid" class="<?php echo $t_rwtraining_edit->LeftColumnClass ?>"><?php echo $t_rwtraining_edit->rwtrainingid->caption() ?><?php echo $t_rwtraining_edit->rwtrainingid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwtraining_edit->RightColumnClass ?>"><div <?php echo $t_rwtraining_edit->rwtrainingid->cellAttributes() ?>>
<span id="el_t_rwtraining_rwtrainingid">
<span<?php echo $t_rwtraining_edit->rwtrainingid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_edit->rwtrainingid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="x_rwtrainingid" id="x_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_edit->rwtrainingid->CurrentValue) ?>">
<?php echo $t_rwtraining_edit->rwtrainingid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwtraining_edit->bioid->Visible) { // bioid ?>
	<div id="r_bioid" class="form-group row">
		<label id="elh_t_rwtraining_bioid" for="x_bioid" class="<?php echo $t_rwtraining_edit->LeftColumnClass ?>"><?php echo $t_rwtraining_edit->bioid->caption() ?><?php echo $t_rwtraining_edit->bioid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwtraining_edit->RightColumnClass ?>"><div <?php echo $t_rwtraining_edit->bioid->cellAttributes() ?>>
<?php if ($t_rwtraining_edit->bioid->getSessionValue() != "") { ?>
<span id="el_t_rwtraining_bioid">
<span<?php echo $t_rwtraining_edit->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_edit->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_bioid" name="x_bioid" value="<?php echo HtmlEncode($t_rwtraining_edit->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_rwtraining_bioid">
<input type="text" data-table="t_rwtraining" data-field="x_bioid" name="x_bioid" id="x_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwtraining_edit->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_edit->bioid->EditValue ?>"<?php echo $t_rwtraining_edit->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_rwtraining_edit->bioid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwtraining_edit->training->Visible) { // training ?>
	<div id="r_training" class="form-group row">
		<label id="elh_t_rwtraining_training" for="x_training" class="<?php echo $t_rwtraining_edit->LeftColumnClass ?>"><?php echo $t_rwtraining_edit->training->caption() ?><?php echo $t_rwtraining_edit->training->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwtraining_edit->RightColumnClass ?>"><div <?php echo $t_rwtraining_edit->training->cellAttributes() ?>>
<span id="el_t_rwtraining_training">
<textarea data-table="t_rwtraining" data-field="x_training" name="x_training" id="x_training" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rwtraining_edit->training->getPlaceHolder()) ?>"<?php echo $t_rwtraining_edit->training->editAttributes() ?>><?php echo $t_rwtraining_edit->training->EditValue ?></textarea>
</span>
<?php echo $t_rwtraining_edit->training->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwtraining_edit->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_t_rwtraining_tempat" for="x_tempat" class="<?php echo $t_rwtraining_edit->LeftColumnClass ?>"><?php echo $t_rwtraining_edit->tempat->caption() ?><?php echo $t_rwtraining_edit->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwtraining_edit->RightColumnClass ?>"><div <?php echo $t_rwtraining_edit->tempat->cellAttributes() ?>>
<span id="el_t_rwtraining_tempat">
<input type="text" data-table="t_rwtraining" data-field="x_tempat" name="x_tempat" id="x_tempat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_rwtraining_edit->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_edit->tempat->EditValue ?>"<?php echo $t_rwtraining_edit->tempat->editAttributes() ?>>
</span>
<?php echo $t_rwtraining_edit->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwtraining_edit->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_t_rwtraining_tahun" for="x_tahun" class="<?php echo $t_rwtraining_edit->LeftColumnClass ?>"><?php echo $t_rwtraining_edit->tahun->caption() ?><?php echo $t_rwtraining_edit->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwtraining_edit->RightColumnClass ?>"><div <?php echo $t_rwtraining_edit->tahun->cellAttributes() ?>>
<span id="el_t_rwtraining_tahun">
<input type="text" data-table="t_rwtraining" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" placeholder="<?php echo HtmlEncode($t_rwtraining_edit->tahun->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_edit->tahun->EditValue ?>"<?php echo $t_rwtraining_edit->tahun->editAttributes() ?>>
</span>
<?php echo $t_rwtraining_edit->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_rwtraining_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_rwtraining_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rwtraining_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_rwtraining_edit->showPageFooter();
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
$t_rwtraining_edit->terminate();
?>