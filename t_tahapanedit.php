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
$t_tahapan_edit = new t_tahapan_edit();

// Run the page
$t_tahapan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_tahapan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_tahapanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_tahapanedit = currentForm = new ew.Form("ft_tahapanedit", "edit");

	// Validate form
	ft_tahapanedit.validate = function() {
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
			<?php if ($t_tahapan_edit->Tahapan->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_tahapan_edit->Tahapan->caption(), $t_tahapan_edit->Tahapan->RequiredErrorMessage)) ?>");
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
	ft_tahapanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_tahapanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_tahapanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_tahapan_edit->showPageHeader(); ?>
<?php
$t_tahapan_edit->showMessage();
?>
<form name="ft_tahapanedit" id="ft_tahapanedit" class="<?php echo $t_tahapan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_tahapan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_tahapan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_tahapan_edit->Tahapan->Visible) { // Tahapan ?>
	<div id="r_Tahapan" class="form-group row">
		<label id="elh_t_tahapan_Tahapan" for="x_Tahapan" class="<?php echo $t_tahapan_edit->LeftColumnClass ?>"><?php echo $t_tahapan_edit->Tahapan->caption() ?><?php echo $t_tahapan_edit->Tahapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_tahapan_edit->RightColumnClass ?>"><div <?php echo $t_tahapan_edit->Tahapan->cellAttributes() ?>>
<span id="el_t_tahapan_Tahapan">
<input type="text" data-table="t_tahapan" data-field="x_Tahapan" name="x_Tahapan" id="x_Tahapan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_tahapan_edit->Tahapan->getPlaceHolder()) ?>" value="<?php echo $t_tahapan_edit->Tahapan->EditValue ?>"<?php echo $t_tahapan_edit->Tahapan->editAttributes() ?>>
</span>
<?php echo $t_tahapan_edit->Tahapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_tahapan" data-field="x_kdtahapan" name="x_kdtahapan" id="x_kdtahapan" value="<?php echo HtmlEncode($t_tahapan_edit->kdtahapan->CurrentValue) ?>">
<?php if (!$t_tahapan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_tahapan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_tahapan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_tahapan_edit->showPageFooter();
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
$t_tahapan_edit->terminate();
?>