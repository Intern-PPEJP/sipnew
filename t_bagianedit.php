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
$t_bagian_edit = new t_bagian_edit();

// Run the page
$t_bagian_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_bagian_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_bagianedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_bagianedit = currentForm = new ew.Form("ft_bagianedit", "edit");

	// Validate form
	ft_bagianedit.validate = function() {
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
			<?php if ($t_bagian_edit->kdbagian->Required) { ?>
				elm = this.getElements("x" + infix + "_kdbagian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_bagian_edit->kdbagian->caption(), $t_bagian_edit->kdbagian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_bagian_edit->namabagian->Required) { ?>
				elm = this.getElements("x" + infix + "_namabagian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_bagian_edit->namabagian->caption(), $t_bagian_edit->namabagian->RequiredErrorMessage)) ?>");
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
	ft_bagianedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_bagianedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_bagianedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_bagian_edit->showPageHeader(); ?>
<?php
$t_bagian_edit->showMessage();
?>
<form name="ft_bagianedit" id="ft_bagianedit" class="<?php echo $t_bagian_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_bagian">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_bagian_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_bagian_edit->kdbagian->Visible) { // kdbagian ?>
	<div id="r_kdbagian" class="form-group row">
		<label id="elh_t_bagian_kdbagian" class="<?php echo $t_bagian_edit->LeftColumnClass ?>"><?php echo $t_bagian_edit->kdbagian->caption() ?><?php echo $t_bagian_edit->kdbagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_bagian_edit->RightColumnClass ?>"><div <?php echo $t_bagian_edit->kdbagian->cellAttributes() ?>>
<span id="el_t_bagian_kdbagian">
<span<?php echo $t_bagian_edit->kdbagian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_bagian_edit->kdbagian->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_bagian" data-field="x_kdbagian" name="x_kdbagian" id="x_kdbagian" value="<?php echo HtmlEncode($t_bagian_edit->kdbagian->CurrentValue) ?>">
<?php echo $t_bagian_edit->kdbagian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_bagian_edit->namabagian->Visible) { // namabagian ?>
	<div id="r_namabagian" class="form-group row">
		<label id="elh_t_bagian_namabagian" for="x_namabagian" class="<?php echo $t_bagian_edit->LeftColumnClass ?>"><?php echo $t_bagian_edit->namabagian->caption() ?><?php echo $t_bagian_edit->namabagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_bagian_edit->RightColumnClass ?>"><div <?php echo $t_bagian_edit->namabagian->cellAttributes() ?>>
<span id="el_t_bagian_namabagian">
<input type="text" data-table="t_bagian" data-field="x_namabagian" name="x_namabagian" id="x_namabagian" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_bagian_edit->namabagian->getPlaceHolder()) ?>" value="<?php echo $t_bagian_edit->namabagian->EditValue ?>"<?php echo $t_bagian_edit->namabagian->editAttributes() ?>>
</span>
<?php echo $t_bagian_edit->namabagian->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_bagian_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_bagian_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_bagian_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_bagian_edit->showPageFooter();
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
$t_bagian_edit->terminate();
?>