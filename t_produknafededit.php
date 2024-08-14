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
$t_produknafed_edit = new t_produknafed_edit();

// Run the page
$t_produknafed_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_produknafed_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_produknafededit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_produknafededit = currentForm = new ew.Form("ft_produknafededit", "edit");

	// Validate form
	ft_produknafededit.validate = function() {
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
			<?php if ($t_produknafed_edit->kdproduknafed->Required) { ?>
				elm = this.getElements("x" + infix + "_kdproduknafed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_edit->kdproduknafed->caption(), $t_produknafed_edit->kdproduknafed->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_produknafed_edit->produknafed->Required) { ?>
				elm = this.getElements("x" + infix + "_produknafed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_edit->produknafed->caption(), $t_produknafed_edit->produknafed->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_produknafed_edit->produknafedid->Required) { ?>
				elm = this.getElements("x" + infix + "_produknafedid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_edit->produknafedid->caption(), $t_produknafed_edit->produknafedid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_produknafed_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_edit->updated_at->caption(), $t_produknafed_edit->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_produknafed_edit->user_updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_edit->user_updated_by->caption(), $t_produknafed_edit->user_updated_by->RequiredErrorMessage)) ?>");
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
	ft_produknafededit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_produknafededit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_produknafededit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_produknafed_edit->showPageHeader(); ?>
<?php
$t_produknafed_edit->showMessage();
?>
<form name="ft_produknafededit" id="ft_produknafededit" class="<?php echo $t_produknafed_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_produknafed">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_produknafed_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_produknafed_edit->kdproduknafed->Visible) { // kdproduknafed ?>
	<div id="r_kdproduknafed" class="form-group row">
		<label id="elh_t_produknafed_kdproduknafed" class="<?php echo $t_produknafed_edit->LeftColumnClass ?>"><?php echo $t_produknafed_edit->kdproduknafed->caption() ?><?php echo $t_produknafed_edit->kdproduknafed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_produknafed_edit->RightColumnClass ?>"><div <?php echo $t_produknafed_edit->kdproduknafed->cellAttributes() ?>>
<span id="el_t_produknafed_kdproduknafed">
<span<?php echo $t_produknafed_edit->kdproduknafed->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_produknafed_edit->kdproduknafed->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_produknafed" data-field="x_kdproduknafed" name="x_kdproduknafed" id="x_kdproduknafed" value="<?php echo HtmlEncode($t_produknafed_edit->kdproduknafed->CurrentValue) ?>">
<?php echo $t_produknafed_edit->kdproduknafed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_produknafed_edit->produknafed->Visible) { // produknafed ?>
	<div id="r_produknafed" class="form-group row">
		<label id="elh_t_produknafed_produknafed" for="x_produknafed" class="<?php echo $t_produknafed_edit->LeftColumnClass ?>"><?php echo $t_produknafed_edit->produknafed->caption() ?><?php echo $t_produknafed_edit->produknafed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_produknafed_edit->RightColumnClass ?>"><div <?php echo $t_produknafed_edit->produknafed->cellAttributes() ?>>
<span id="el_t_produknafed_produknafed">
<input type="text" data-table="t_produknafed" data-field="x_produknafed" name="x_produknafed" id="x_produknafed" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_produknafed_edit->produknafed->getPlaceHolder()) ?>" value="<?php echo $t_produknafed_edit->produknafed->EditValue ?>"<?php echo $t_produknafed_edit->produknafed->editAttributes() ?>>
</span>
<?php echo $t_produknafed_edit->produknafed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_produknafed_edit->produknafedid->Visible) { // produknafedid ?>
	<div id="r_produknafedid" class="form-group row">
		<label id="elh_t_produknafed_produknafedid" for="x_produknafedid" class="<?php echo $t_produknafed_edit->LeftColumnClass ?>"><?php echo $t_produknafed_edit->produknafedid->caption() ?><?php echo $t_produknafed_edit->produknafedid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_produknafed_edit->RightColumnClass ?>"><div <?php echo $t_produknafed_edit->produknafedid->cellAttributes() ?>>
<span id="el_t_produknafed_produknafedid">
<input type="text" data-table="t_produknafed" data-field="x_produknafedid" name="x_produknafedid" id="x_produknafedid" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_produknafed_edit->produknafedid->getPlaceHolder()) ?>" value="<?php echo $t_produknafed_edit->produknafedid->EditValue ?>"<?php echo $t_produknafed_edit->produknafedid->editAttributes() ?>>
</span>
<?php echo $t_produknafed_edit->produknafedid->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_produknafed_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_produknafed_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_produknafed_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_produknafed_edit->showPageFooter();
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
$t_produknafed_edit->terminate();
?>