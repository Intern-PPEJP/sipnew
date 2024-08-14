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
$t_rkwebinar_edit = new t_rkwebinar_edit();

// Run the page
$t_rkwebinar_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rkwebinar_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rkwebinaredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_rkwebinaredit = currentForm = new ew.Form("ft_rkwebinaredit", "edit");

	// Validate form
	ft_rkwebinaredit.validate = function() {
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
			<?php if ($t_rkwebinar_edit->kegiatan->Required) { ?>
				elm = this.getElements("x" + infix + "_kegiatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkwebinar_edit->kegiatan->caption(), $t_rkwebinar_edit->kegiatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rkwebinar_edit->tanggal_kegiatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_kegiatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkwebinar_edit->tanggal_kegiatan->caption(), $t_rkwebinar_edit->tanggal_kegiatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_kegiatan");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rkwebinar_edit->tanggal_kegiatan->errorMessage()) ?>");
			<?php if ($t_rkwebinar_edit->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rkwebinar_edit->tahun->caption(), $t_rkwebinar_edit->tahun->RequiredErrorMessage)) ?>");
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
	ft_rkwebinaredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rkwebinaredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rkwebinaredit.lists["x_tahun"] = <?php echo $t_rkwebinar_edit->tahun->Lookup->toClientList($t_rkwebinar_edit) ?>;
	ft_rkwebinaredit.lists["x_tahun"].options = <?php echo JsonEncode($t_rkwebinar_edit->tahun->lookupOptions()) ?>;
	loadjs.done("ft_rkwebinaredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rkwebinar_edit->showPageHeader(); ?>
<?php
$t_rkwebinar_edit->showMessage();
?>
<form name="ft_rkwebinaredit" id="ft_rkwebinaredit" class="<?php echo $t_rkwebinar_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rkwebinar">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_rkwebinar_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_rkwebinar_edit->kegiatan->Visible) { // kegiatan ?>
	<div id="r_kegiatan" class="form-group row">
		<label id="elh_t_rkwebinar_kegiatan" for="x_kegiatan" class="<?php echo $t_rkwebinar_edit->LeftColumnClass ?>"><?php echo $t_rkwebinar_edit->kegiatan->caption() ?><?php echo $t_rkwebinar_edit->kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkwebinar_edit->RightColumnClass ?>"><div <?php echo $t_rkwebinar_edit->kegiatan->cellAttributes() ?>>
<span id="el_t_rkwebinar_kegiatan">
<input type="text" data-table="t_rkwebinar" data-field="x_kegiatan" name="x_kegiatan" id="x_kegiatan" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($t_rkwebinar_edit->kegiatan->getPlaceHolder()) ?>" value="<?php echo $t_rkwebinar_edit->kegiatan->EditValue ?>"<?php echo $t_rkwebinar_edit->kegiatan->editAttributes() ?>>
</span>
<?php echo $t_rkwebinar_edit->kegiatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkwebinar_edit->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
	<div id="r_tanggal_kegiatan" class="form-group row">
		<label id="elh_t_rkwebinar_tanggal_kegiatan" for="x_tanggal_kegiatan" class="<?php echo $t_rkwebinar_edit->LeftColumnClass ?>"><?php echo $t_rkwebinar_edit->tanggal_kegiatan->caption() ?><?php echo $t_rkwebinar_edit->tanggal_kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkwebinar_edit->RightColumnClass ?>"><div <?php echo $t_rkwebinar_edit->tanggal_kegiatan->cellAttributes() ?>>
<span id="el_t_rkwebinar_tanggal_kegiatan">
<input type="text" data-table="t_rkwebinar" data-field="x_tanggal_kegiatan" name="x_tanggal_kegiatan" id="x_tanggal_kegiatan" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_rkwebinar_edit->tanggal_kegiatan->getPlaceHolder()) ?>" value="<?php echo $t_rkwebinar_edit->tanggal_kegiatan->EditValue ?>"<?php echo $t_rkwebinar_edit->tanggal_kegiatan->editAttributes() ?>>
<?php if (!$t_rkwebinar_edit->tanggal_kegiatan->ReadOnly && !$t_rkwebinar_edit->tanggal_kegiatan->Disabled && !isset($t_rkwebinar_edit->tanggal_kegiatan->EditAttrs["readonly"]) && !isset($t_rkwebinar_edit->tanggal_kegiatan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_rkwebinaredit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_rkwebinaredit", "x_tanggal_kegiatan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_rkwebinar_edit->tanggal_kegiatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rkwebinar_edit->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_t_rkwebinar_tahun" for="x_tahun" class="<?php echo $t_rkwebinar_edit->LeftColumnClass ?>"><?php echo $t_rkwebinar_edit->tahun->caption() ?><?php echo $t_rkwebinar_edit->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rkwebinar_edit->RightColumnClass ?>"><div <?php echo $t_rkwebinar_edit->tahun->cellAttributes() ?>>
<span id="el_t_rkwebinar_tahun">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rkwebinar" data-field="x_tahun" data-value-separator="<?php echo $t_rkwebinar_edit->tahun->displayValueSeparatorAttribute() ?>" id="x_tahun" name="x_tahun"<?php echo $t_rkwebinar_edit->tahun->editAttributes() ?>>
			<?php echo $t_rkwebinar_edit->tahun->selectOptionListHtml("x_tahun") ?>
		</select>
</div>
<?php echo $t_rkwebinar_edit->tahun->Lookup->getParamTag($t_rkwebinar_edit, "p_x_tahun") ?>
</span>
<?php echo $t_rkwebinar_edit->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_rkwebinar" data-field="x_rkwid" name="x_rkwid" id="x_rkwid" value="<?php echo HtmlEncode($t_rkwebinar_edit->rkwid->CurrentValue) ?>">
<?php if (!$t_rkwebinar_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_rkwebinar_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rkwebinar_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_rkwebinar_edit->showPageFooter();
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
$t_rkwebinar_edit->terminate();
?>