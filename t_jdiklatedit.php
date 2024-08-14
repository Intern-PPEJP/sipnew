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
$t_jdiklat_edit = new t_jdiklat_edit();

// Run the page
$t_jdiklat_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jdiklat_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_jdiklatedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_jdiklatedit = currentForm = new ew.Form("ft_jdiklatedit", "edit");

	// Validate form
	ft_jdiklatedit.validate = function() {
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
			<?php if ($t_jdiklat_edit->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_edit->tahun->caption(), $t_jdiklat_edit->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_edit->tahun->errorMessage()) ?>");
			<?php if ($t_jdiklat_edit->angkatan_reg->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan_reg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_edit->angkatan_reg->caption(), $t_jdiklat_edit->angkatan_reg->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan_reg");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_edit->angkatan_reg->errorMessage()) ?>");
			<?php if ($t_jdiklat_edit->angkatan_kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_edit->angkatan_kerjasama->caption(), $t_jdiklat_edit->angkatan_kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_edit->angkatan_kerjasama->errorMessage()) ?>");
			<?php if ($t_jdiklat_edit->angkatan_web->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan_web");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_edit->angkatan_web->caption(), $t_jdiklat_edit->angkatan_web->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan_web");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_edit->angkatan_web->errorMessage()) ?>");
			<?php if ($t_jdiklat_edit->angkatan_cp->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan_cp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_edit->angkatan_cp->caption(), $t_jdiklat_edit->angkatan_cp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan_cp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_edit->angkatan_cp->errorMessage()) ?>");
			<?php if ($t_jdiklat_edit->tgl_ubah->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_ubah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_edit->tgl_ubah->caption(), $t_jdiklat_edit->tgl_ubah->RequiredErrorMessage)) ?>");
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
	ft_jdiklatedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jdiklatedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_jdiklatedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_jdiklat_edit->showPageHeader(); ?>
<?php
$t_jdiklat_edit->showMessage();
?>
<form name="ft_jdiklatedit" id="ft_jdiklatedit" class="<?php echo $t_jdiklat_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jdiklat">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_jdiklat_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_jdiklat_edit->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_t_jdiklat_tahun" for="x_tahun" class="<?php echo $t_jdiklat_edit->LeftColumnClass ?>"><?php echo $t_jdiklat_edit->tahun->caption() ?><?php echo $t_jdiklat_edit->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_edit->RightColumnClass ?>"><div <?php echo $t_jdiklat_edit->tahun->cellAttributes() ?>>
<input type="text" data-table="t_jdiklat" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_jdiklat_edit->tahun->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_edit->tahun->EditValue ?>"<?php echo $t_jdiklat_edit->tahun->editAttributes() ?>>
<input type="hidden" data-table="t_jdiklat" data-field="x_tahun" name="o_tahun" id="o_tahun" value="<?php echo HtmlEncode($t_jdiklat_edit->tahun->OldValue != null ? $t_jdiklat_edit->tahun->OldValue : $t_jdiklat_edit->tahun->CurrentValue) ?>">
<?php echo $t_jdiklat_edit->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jdiklat_edit->angkatan_reg->Visible) { // angkatan_reg ?>
	<div id="r_angkatan_reg" class="form-group row">
		<label id="elh_t_jdiklat_angkatan_reg" for="x_angkatan_reg" class="<?php echo $t_jdiklat_edit->LeftColumnClass ?>"><?php echo $t_jdiklat_edit->angkatan_reg->caption() ?><?php echo $t_jdiklat_edit->angkatan_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_edit->RightColumnClass ?>"><div <?php echo $t_jdiklat_edit->angkatan_reg->cellAttributes() ?>>
<span id="el_t_jdiklat_angkatan_reg">
<input type="text" data-table="t_jdiklat" data-field="x_angkatan_reg" name="x_angkatan_reg" id="x_angkatan_reg" size="4" maxlength="6" placeholder="<?php echo HtmlEncode($t_jdiklat_edit->angkatan_reg->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_edit->angkatan_reg->EditValue ?>"<?php echo $t_jdiklat_edit->angkatan_reg->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_edit->angkatan_reg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jdiklat_edit->angkatan_kerjasama->Visible) { // angkatan_kerjasama ?>
	<div id="r_angkatan_kerjasama" class="form-group row">
		<label id="elh_t_jdiklat_angkatan_kerjasama" for="x_angkatan_kerjasama" class="<?php echo $t_jdiklat_edit->LeftColumnClass ?>"><?php echo $t_jdiklat_edit->angkatan_kerjasama->caption() ?><?php echo $t_jdiklat_edit->angkatan_kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_edit->RightColumnClass ?>"><div <?php echo $t_jdiklat_edit->angkatan_kerjasama->cellAttributes() ?>>
<span id="el_t_jdiklat_angkatan_kerjasama">
<input type="text" data-table="t_jdiklat" data-field="x_angkatan_kerjasama" name="x_angkatan_kerjasama" id="x_angkatan_kerjasama" size="4" maxlength="6" placeholder="<?php echo HtmlEncode($t_jdiklat_edit->angkatan_kerjasama->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_edit->angkatan_kerjasama->EditValue ?>"<?php echo $t_jdiklat_edit->angkatan_kerjasama->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_edit->angkatan_kerjasama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jdiklat_edit->angkatan_web->Visible) { // angkatan_web ?>
	<div id="r_angkatan_web" class="form-group row">
		<label id="elh_t_jdiklat_angkatan_web" for="x_angkatan_web" class="<?php echo $t_jdiklat_edit->LeftColumnClass ?>"><?php echo $t_jdiklat_edit->angkatan_web->caption() ?><?php echo $t_jdiklat_edit->angkatan_web->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_edit->RightColumnClass ?>"><div <?php echo $t_jdiklat_edit->angkatan_web->cellAttributes() ?>>
<span id="el_t_jdiklat_angkatan_web">
<input type="text" data-table="t_jdiklat" data-field="x_angkatan_web" name="x_angkatan_web" id="x_angkatan_web" size="4" maxlength="6" placeholder="<?php echo HtmlEncode($t_jdiklat_edit->angkatan_web->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_edit->angkatan_web->EditValue ?>"<?php echo $t_jdiklat_edit->angkatan_web->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_edit->angkatan_web->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jdiklat_edit->angkatan_cp->Visible) { // angkatan_cp ?>
	<div id="r_angkatan_cp" class="form-group row">
		<label id="elh_t_jdiklat_angkatan_cp" for="x_angkatan_cp" class="<?php echo $t_jdiklat_edit->LeftColumnClass ?>"><?php echo $t_jdiklat_edit->angkatan_cp->caption() ?><?php echo $t_jdiklat_edit->angkatan_cp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_edit->RightColumnClass ?>"><div <?php echo $t_jdiklat_edit->angkatan_cp->cellAttributes() ?>>
<span id="el_t_jdiklat_angkatan_cp">
<input type="text" data-table="t_jdiklat" data-field="x_angkatan_cp" name="x_angkatan_cp" id="x_angkatan_cp" size="4" maxlength="6" placeholder="<?php echo HtmlEncode($t_jdiklat_edit->angkatan_cp->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_edit->angkatan_cp->EditValue ?>"<?php echo $t_jdiklat_edit->angkatan_cp->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_edit->angkatan_cp->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_jdiklat_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_jdiklat_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_jdiklat_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_jdiklat_edit->showPageFooter();
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
$t_jdiklat_edit->terminate();
?>