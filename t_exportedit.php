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
$t_export_edit = new t_export_edit();

// Run the page
$t_export_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_export_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_exportedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_exportedit = currentForm = new ew.Form("ft_exportedit", "edit");

	// Validate form
	ft_exportedit.validate = function() {
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
			<?php if ($t_export_edit->kdexport->Required) { ?>
				elm = this.getElements("x" + infix + "_kdexport");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_export_edit->kdexport->caption(), $t_export_edit->kdexport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_export_edit->_export->Required) { ?>
				elm = this.getElements("x" + infix + "__export");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_export_edit->_export->caption(), $t_export_edit->_export->RequiredErrorMessage)) ?>");
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
	ft_exportedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_exportedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_exportedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_export_edit->showPageHeader(); ?>
<?php
$t_export_edit->showMessage();
?>
<form name="ft_exportedit" id="ft_exportedit" class="<?php echo $t_export_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_export">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_export_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_export_edit->kdexport->Visible) { // kdexport ?>
	<div id="r_kdexport" class="form-group row">
		<label id="elh_t_export_kdexport" class="<?php echo $t_export_edit->LeftColumnClass ?>"><?php echo $t_export_edit->kdexport->caption() ?><?php echo $t_export_edit->kdexport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_export_edit->RightColumnClass ?>"><div <?php echo $t_export_edit->kdexport->cellAttributes() ?>>
<span id="el_t_export_kdexport">
<span<?php echo $t_export_edit->kdexport->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_export_edit->kdexport->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_export" data-field="x_kdexport" name="x_kdexport" id="x_kdexport" value="<?php echo HtmlEncode($t_export_edit->kdexport->CurrentValue) ?>">
<?php echo $t_export_edit->kdexport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_export_edit->_export->Visible) { // export ?>
	<div id="r__export" class="form-group row">
		<label id="elh_t_export__export" for="x__export" class="<?php echo $t_export_edit->LeftColumnClass ?>"><?php echo $t_export_edit->_export->caption() ?><?php echo $t_export_edit->_export->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_export_edit->RightColumnClass ?>"><div <?php echo $t_export_edit->_export->cellAttributes() ?>>
<span id="el_t_export__export">
<input type="text" data-table="t_export" data-field="x__export" name="x__export" id="x__export" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($t_export_edit->_export->getPlaceHolder()) ?>" value="<?php echo $t_export_edit->_export->EditValue ?>"<?php echo $t_export_edit->_export->editAttributes() ?>>
</span>
<?php echo $t_export_edit->_export->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_export_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_export_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_export_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_export_edit->showPageFooter();
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
$t_export_edit->terminate();
?>