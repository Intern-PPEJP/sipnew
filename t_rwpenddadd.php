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
$t_rwpendd_add = new t_rwpendd_add();

// Run the page
$t_rwpendd_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpendd_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rwpenddadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_rwpenddadd = currentForm = new ew.Form("ft_rwpenddadd", "add");

	// Validate form
	ft_rwpenddadd.validate = function() {
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
			<?php if ($t_rwpendd_add->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_add->bioid->caption(), $t_rwpendd_add->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpendd_add->bioid->errorMessage()) ?>");
			<?php if ($t_rwpendd_add->sekolah->Required) { ?>
				elm = this.getElements("x" + infix + "_sekolah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_add->sekolah->caption(), $t_rwpendd_add->sekolah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpendd_add->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_add->tempat->caption(), $t_rwpendd_add->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpendd_add->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_add->tahun->caption(), $t_rwpendd_add->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpendd_add->tahun->errorMessage()) ?>");
			<?php if ($t_rwpendd_add->created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_add->created_by->caption(), $t_rwpendd_add->created_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpendd_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_add->created_at->caption(), $t_rwpendd_add->created_at->RequiredErrorMessage)) ?>");
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
	ft_rwpenddadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rwpenddadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_rwpenddadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rwpendd_add->showPageHeader(); ?>
<?php
$t_rwpendd_add->showMessage();
?>
<form name="ft_rwpenddadd" id="ft_rwpenddadd" class="<?php echo $t_rwpendd_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwpendd">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_rwpendd_add->IsModal ?>">
<?php if ($t_rwpendd->getCurrentMasterTable() == "t_biointruktur") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_rwpendd_add->bioid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_rwpendd_add->bioid->Visible) { // bioid ?>
	<div id="r_bioid" class="form-group row">
		<label id="elh_t_rwpendd_bioid" for="x_bioid" class="<?php echo $t_rwpendd_add->LeftColumnClass ?>"><?php echo $t_rwpendd_add->bioid->caption() ?><?php echo $t_rwpendd_add->bioid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpendd_add->RightColumnClass ?>"><div <?php echo $t_rwpendd_add->bioid->cellAttributes() ?>>
<?php if ($t_rwpendd_add->bioid->getSessionValue() != "") { ?>
<span id="el_t_rwpendd_bioid">
<span<?php echo $t_rwpendd_add->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_add->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_bioid" name="x_bioid" value="<?php echo HtmlEncode($t_rwpendd_add->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_rwpendd_bioid">
<input type="text" data-table="t_rwpendd" data-field="x_bioid" name="x_bioid" id="x_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwpendd_add->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_add->bioid->EditValue ?>"<?php echo $t_rwpendd_add->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_rwpendd_add->bioid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwpendd_add->sekolah->Visible) { // sekolah ?>
	<div id="r_sekolah" class="form-group row">
		<label id="elh_t_rwpendd_sekolah" for="x_sekolah" class="<?php echo $t_rwpendd_add->LeftColumnClass ?>"><?php echo $t_rwpendd_add->sekolah->caption() ?><?php echo $t_rwpendd_add->sekolah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpendd_add->RightColumnClass ?>"><div <?php echo $t_rwpendd_add->sekolah->cellAttributes() ?>>
<span id="el_t_rwpendd_sekolah">
<textarea data-table="t_rwpendd" data-field="x_sekolah" name="x_sekolah" id="x_sekolah" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rwpendd_add->sekolah->getPlaceHolder()) ?>"<?php echo $t_rwpendd_add->sekolah->editAttributes() ?>><?php echo $t_rwpendd_add->sekolah->EditValue ?></textarea>
</span>
<?php echo $t_rwpendd_add->sekolah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwpendd_add->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_t_rwpendd_tempat" for="x_tempat" class="<?php echo $t_rwpendd_add->LeftColumnClass ?>"><?php echo $t_rwpendd_add->tempat->caption() ?><?php echo $t_rwpendd_add->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpendd_add->RightColumnClass ?>"><div <?php echo $t_rwpendd_add->tempat->cellAttributes() ?>>
<span id="el_t_rwpendd_tempat">
<input type="text" data-table="t_rwpendd" data-field="x_tempat" name="x_tempat" id="x_tempat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpendd_add->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_add->tempat->EditValue ?>"<?php echo $t_rwpendd_add->tempat->editAttributes() ?>>
</span>
<?php echo $t_rwpendd_add->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rwpendd_add->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_t_rwpendd_tahun" for="x_tahun" class="<?php echo $t_rwpendd_add->LeftColumnClass ?>"><?php echo $t_rwpendd_add->tahun->caption() ?><?php echo $t_rwpendd_add->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rwpendd_add->RightColumnClass ?>"><div <?php echo $t_rwpendd_add->tahun->cellAttributes() ?>>
<span id="el_t_rwpendd_tahun">
<input type="text" data-table="t_rwpendd" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpendd_add->tahun->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_add->tahun->EditValue ?>"<?php echo $t_rwpendd_add->tahun->editAttributes() ?>>
</span>
<?php echo $t_rwpendd_add->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_rwpendd_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_rwpendd_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rwpendd_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_rwpendd_add->showPageFooter();
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
$t_rwpendd_add->terminate();
?>