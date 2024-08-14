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
$t_bahasa_edit = new t_bahasa_edit();

// Run the page
$t_bahasa_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_bahasa_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_bahasaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_bahasaedit = currentForm = new ew.Form("ft_bahasaedit", "edit");

	// Validate form
	ft_bahasaedit.validate = function() {
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
			<?php if ($t_bahasa_edit->kdbahasa->Required) { ?>
				elm = this.getElements("x" + infix + "_kdbahasa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_bahasa_edit->kdbahasa->caption(), $t_bahasa_edit->kdbahasa->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_bahasa_edit->bahasa->Required) { ?>
				elm = this.getElements("x" + infix + "_bahasa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_bahasa_edit->bahasa->caption(), $t_bahasa_edit->bahasa->RequiredErrorMessage)) ?>");
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
	ft_bahasaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_bahasaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_bahasaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_bahasa_edit->showPageHeader(); ?>
<?php
$t_bahasa_edit->showMessage();
?>
<form name="ft_bahasaedit" id="ft_bahasaedit" class="<?php echo $t_bahasa_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_bahasa">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_bahasa_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_bahasa_edit->kdbahasa->Visible) { // kdbahasa ?>
	<div id="r_kdbahasa" class="form-group row">
		<label id="elh_t_bahasa_kdbahasa" class="<?php echo $t_bahasa_edit->LeftColumnClass ?>"><?php echo $t_bahasa_edit->kdbahasa->caption() ?><?php echo $t_bahasa_edit->kdbahasa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_bahasa_edit->RightColumnClass ?>"><div <?php echo $t_bahasa_edit->kdbahasa->cellAttributes() ?>>
<span id="el_t_bahasa_kdbahasa">
<span<?php echo $t_bahasa_edit->kdbahasa->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_bahasa_edit->kdbahasa->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_bahasa" data-field="x_kdbahasa" name="x_kdbahasa" id="x_kdbahasa" value="<?php echo HtmlEncode($t_bahasa_edit->kdbahasa->CurrentValue) ?>">
<?php echo $t_bahasa_edit->kdbahasa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_bahasa_edit->bahasa->Visible) { // bahasa ?>
	<div id="r_bahasa" class="form-group row">
		<label id="elh_t_bahasa_bahasa" for="x_bahasa" class="<?php echo $t_bahasa_edit->LeftColumnClass ?>"><?php echo $t_bahasa_edit->bahasa->caption() ?><?php echo $t_bahasa_edit->bahasa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_bahasa_edit->RightColumnClass ?>"><div <?php echo $t_bahasa_edit->bahasa->cellAttributes() ?>>
<span id="el_t_bahasa_bahasa">
<input type="text" data-table="t_bahasa" data-field="x_bahasa" name="x_bahasa" id="x_bahasa" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($t_bahasa_edit->bahasa->getPlaceHolder()) ?>" value="<?php echo $t_bahasa_edit->bahasa->EditValue ?>"<?php echo $t_bahasa_edit->bahasa->editAttributes() ?>>
</span>
<?php echo $t_bahasa_edit->bahasa->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_bahasa_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_bahasa_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_bahasa_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_bahasa_edit->showPageFooter();
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
$t_bahasa_edit->terminate();
?>