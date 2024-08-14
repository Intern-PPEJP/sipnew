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
$t_jdiklat_add = new t_jdiklat_add();

// Run the page
$t_jdiklat_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jdiklat_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_jdiklatadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_jdiklatadd = currentForm = new ew.Form("ft_jdiklatadd", "add");

	// Validate form
	ft_jdiklatadd.validate = function() {
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
			<?php if ($t_jdiklat_add->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_add->tahun->caption(), $t_jdiklat_add->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_add->tahun->errorMessage()) ?>");
			<?php if ($t_jdiklat_add->angkatan_reg->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan_reg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_add->angkatan_reg->caption(), $t_jdiklat_add->angkatan_reg->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan_reg");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_add->angkatan_reg->errorMessage()) ?>");
			<?php if ($t_jdiklat_add->angkatan_kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_add->angkatan_kerjasama->caption(), $t_jdiklat_add->angkatan_kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_add->angkatan_kerjasama->errorMessage()) ?>");
			<?php if ($t_jdiklat_add->angkatan_web->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan_web");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_add->angkatan_web->caption(), $t_jdiklat_add->angkatan_web->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan_web");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_add->angkatan_web->errorMessage()) ?>");
			<?php if ($t_jdiklat_add->angkatan_cp->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan_cp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_add->angkatan_cp->caption(), $t_jdiklat_add->angkatan_cp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan_cp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jdiklat_add->angkatan_cp->errorMessage()) ?>");
			<?php if ($t_jdiklat_add->tgl_tambah->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_tambah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jdiklat_add->tgl_tambah->caption(), $t_jdiklat_add->tgl_tambah->RequiredErrorMessage)) ?>");
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
	ft_jdiklatadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jdiklatadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_jdiklatadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_jdiklat_add->showPageHeader(); ?>
<?php
$t_jdiklat_add->showMessage();
?>
<form name="ft_jdiklatadd" id="ft_jdiklatadd" class="<?php echo $t_jdiklat_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jdiklat">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_jdiklat_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_jdiklat_add->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_t_jdiklat_tahun" for="x_tahun" class="<?php echo $t_jdiklat_add->LeftColumnClass ?>"><?php echo $t_jdiklat_add->tahun->caption() ?><?php echo $t_jdiklat_add->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_add->RightColumnClass ?>"><div <?php echo $t_jdiklat_add->tahun->cellAttributes() ?>>
<span id="el_t_jdiklat_tahun">
<input type="text" data-table="t_jdiklat" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_jdiklat_add->tahun->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_add->tahun->EditValue ?>"<?php echo $t_jdiklat_add->tahun->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_add->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jdiklat_add->angkatan_reg->Visible) { // angkatan_reg ?>
	<div id="r_angkatan_reg" class="form-group row">
		<label id="elh_t_jdiklat_angkatan_reg" for="x_angkatan_reg" class="<?php echo $t_jdiklat_add->LeftColumnClass ?>"><?php echo $t_jdiklat_add->angkatan_reg->caption() ?><?php echo $t_jdiklat_add->angkatan_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_add->RightColumnClass ?>"><div <?php echo $t_jdiklat_add->angkatan_reg->cellAttributes() ?>>
<span id="el_t_jdiklat_angkatan_reg">
<input type="text" data-table="t_jdiklat" data-field="x_angkatan_reg" name="x_angkatan_reg" id="x_angkatan_reg" size="4" maxlength="6" placeholder="<?php echo HtmlEncode($t_jdiklat_add->angkatan_reg->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_add->angkatan_reg->EditValue ?>"<?php echo $t_jdiklat_add->angkatan_reg->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_add->angkatan_reg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jdiklat_add->angkatan_kerjasama->Visible) { // angkatan_kerjasama ?>
	<div id="r_angkatan_kerjasama" class="form-group row">
		<label id="elh_t_jdiklat_angkatan_kerjasama" for="x_angkatan_kerjasama" class="<?php echo $t_jdiklat_add->LeftColumnClass ?>"><?php echo $t_jdiklat_add->angkatan_kerjasama->caption() ?><?php echo $t_jdiklat_add->angkatan_kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_add->RightColumnClass ?>"><div <?php echo $t_jdiklat_add->angkatan_kerjasama->cellAttributes() ?>>
<span id="el_t_jdiklat_angkatan_kerjasama">
<input type="text" data-table="t_jdiklat" data-field="x_angkatan_kerjasama" name="x_angkatan_kerjasama" id="x_angkatan_kerjasama" size="4" maxlength="6" placeholder="<?php echo HtmlEncode($t_jdiklat_add->angkatan_kerjasama->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_add->angkatan_kerjasama->EditValue ?>"<?php echo $t_jdiklat_add->angkatan_kerjasama->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_add->angkatan_kerjasama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jdiklat_add->angkatan_web->Visible) { // angkatan_web ?>
	<div id="r_angkatan_web" class="form-group row">
		<label id="elh_t_jdiklat_angkatan_web" for="x_angkatan_web" class="<?php echo $t_jdiklat_add->LeftColumnClass ?>"><?php echo $t_jdiklat_add->angkatan_web->caption() ?><?php echo $t_jdiklat_add->angkatan_web->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_add->RightColumnClass ?>"><div <?php echo $t_jdiklat_add->angkatan_web->cellAttributes() ?>>
<span id="el_t_jdiklat_angkatan_web">
<input type="text" data-table="t_jdiklat" data-field="x_angkatan_web" name="x_angkatan_web" id="x_angkatan_web" size="4" maxlength="6" placeholder="<?php echo HtmlEncode($t_jdiklat_add->angkatan_web->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_add->angkatan_web->EditValue ?>"<?php echo $t_jdiklat_add->angkatan_web->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_add->angkatan_web->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jdiklat_add->angkatan_cp->Visible) { // angkatan_cp ?>
	<div id="r_angkatan_cp" class="form-group row">
		<label id="elh_t_jdiklat_angkatan_cp" for="x_angkatan_cp" class="<?php echo $t_jdiklat_add->LeftColumnClass ?>"><?php echo $t_jdiklat_add->angkatan_cp->caption() ?><?php echo $t_jdiklat_add->angkatan_cp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jdiklat_add->RightColumnClass ?>"><div <?php echo $t_jdiklat_add->angkatan_cp->cellAttributes() ?>>
<span id="el_t_jdiklat_angkatan_cp">
<input type="text" data-table="t_jdiklat" data-field="x_angkatan_cp" name="x_angkatan_cp" id="x_angkatan_cp" size="4" maxlength="6" placeholder="<?php echo HtmlEncode($t_jdiklat_add->angkatan_cp->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_add->angkatan_cp->EditValue ?>"<?php echo $t_jdiklat_add->angkatan_cp->editAttributes() ?>>
</span>
<?php echo $t_jdiklat_add->angkatan_cp->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_jdiklat_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_jdiklat_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_jdiklat_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_jdiklat_add->showPageFooter();
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
$t_jdiklat_add->terminate();
?>