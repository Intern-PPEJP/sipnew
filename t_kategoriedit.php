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
$t_kategori_edit = new t_kategori_edit();

// Run the page
$t_kategori_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kategori_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_kategoriedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_kategoriedit = currentForm = new ew.Form("ft_kategoriedit", "edit");

	// Validate form
	ft_kategoriedit.validate = function() {
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
			<?php if ($t_kategori_edit->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kategori_edit->kdkategori->caption(), $t_kategori_edit->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kategori_edit->kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kategori_edit->kategori->caption(), $t_kategori_edit->kategori->RequiredErrorMessage)) ?>");
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
	ft_kategoriedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_kategoriedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_kategoriedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_kategori_edit->showPageHeader(); ?>
<?php
$t_kategori_edit->showMessage();
?>
<form name="ft_kategoriedit" id="ft_kategoriedit" class="<?php echo $t_kategori_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kategori">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_kategori_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_kategori_edit->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_t_kategori_kdkategori" class="<?php echo $t_kategori_edit->LeftColumnClass ?>"><?php echo $t_kategori_edit->kdkategori->caption() ?><?php echo $t_kategori_edit->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kategori_edit->RightColumnClass ?>"><div <?php echo $t_kategori_edit->kdkategori->cellAttributes() ?>>
<span id="el_t_kategori_kdkategori">
<span<?php echo $t_kategori_edit->kdkategori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kategori_edit->kdkategori->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kategori" data-field="x_kdkategori" name="x_kdkategori" id="x_kdkategori" value="<?php echo HtmlEncode($t_kategori_edit->kdkategori->CurrentValue) ?>">
<?php echo $t_kategori_edit->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kategori_edit->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label id="elh_t_kategori_kategori" for="x_kategori" class="<?php echo $t_kategori_edit->LeftColumnClass ?>"><?php echo $t_kategori_edit->kategori->caption() ?><?php echo $t_kategori_edit->kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kategori_edit->RightColumnClass ?>"><div <?php echo $t_kategori_edit->kategori->cellAttributes() ?>>
<span id="el_t_kategori_kategori">
<input type="text" data-table="t_kategori" data-field="x_kategori" name="x_kategori" id="x_kategori" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($t_kategori_edit->kategori->getPlaceHolder()) ?>" value="<?php echo $t_kategori_edit->kategori->EditValue ?>"<?php echo $t_kategori_edit->kategori->editAttributes() ?>>
</span>
<?php echo $t_kategori_edit->kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_kategori_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_kategori_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_kategori_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_kategori_edit->showPageFooter();
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
$t_kategori_edit->terminate();
?>