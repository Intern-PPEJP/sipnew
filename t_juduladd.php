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
$t_judul_add = new t_judul_add();

// Run the page
$t_judul_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_judul_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_juduladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_juduladd = currentForm = new ew.Form("ft_juduladd", "add");

	// Validate form
	ft_juduladd.validate = function() {
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
			<?php if ($t_judul_add->kdbidang->Required) { ?>
				elm = this.getElements("x" + infix + "_kdbidang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_add->kdbidang->caption(), $t_judul_add->kdbidang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_add->judul->Required) { ?>
				elm = this.getElements("x" + infix + "_judul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_add->judul->caption(), $t_judul_add->judul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_add->singkatan->Required) { ?>
				elm = this.getElements("x" + infix + "_singkatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_add->singkatan->caption(), $t_judul_add->singkatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_add->created_at->caption(), $t_judul_add->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_add->user_created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_add->user_created_by->caption(), $t_judul_add->user_created_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_add->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_add->updated_at->caption(), $t_judul_add->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_add->user_updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_add->user_updated_by->caption(), $t_judul_add->user_updated_by->RequiredErrorMessage)) ?>");
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
	ft_juduladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_juduladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_juduladd.lists["x_kdbidang"] = <?php echo $t_judul_add->kdbidang->Lookup->toClientList($t_judul_add) ?>;
	ft_juduladd.lists["x_kdbidang"].options = <?php echo JsonEncode($t_judul_add->kdbidang->lookupOptions()) ?>;
	loadjs.done("ft_juduladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("add","Menambah Data Judul");?>');

});
</script>
<?php $t_judul_add->showPageHeader(); ?>
<?php
$t_judul_add->showMessage();
?>
<form name="ft_juduladd" id="ft_juduladd" class="<?php echo $t_judul_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_judul">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_judul_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_judul_add->kdbidang->Visible) { // kdbidang ?>
	<div id="r_kdbidang" class="form-group row">
		<label id="elh_t_judul_kdbidang" for="x_kdbidang" class="<?php echo $t_judul_add->LeftColumnClass ?>"><?php echo $t_judul_add->kdbidang->caption() ?><?php echo $t_judul_add->kdbidang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_judul_add->RightColumnClass ?>"><div <?php echo $t_judul_add->kdbidang->cellAttributes() ?>>
<span id="el_t_judul_kdbidang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_judul" data-field="x_kdbidang" data-value-separator="<?php echo $t_judul_add->kdbidang->displayValueSeparatorAttribute() ?>" id="x_kdbidang" name="x_kdbidang"<?php echo $t_judul_add->kdbidang->editAttributes() ?>>
			<?php echo $t_judul_add->kdbidang->selectOptionListHtml("x_kdbidang") ?>
		</select>
</div>
<?php echo $t_judul_add->kdbidang->Lookup->getParamTag($t_judul_add, "p_x_kdbidang") ?>
</span>
<?php echo $t_judul_add->kdbidang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_judul_add->judul->Visible) { // judul ?>
	<div id="r_judul" class="form-group row">
		<label id="elh_t_judul_judul" for="x_judul" class="<?php echo $t_judul_add->LeftColumnClass ?>"><?php echo $t_judul_add->judul->caption() ?><?php echo $t_judul_add->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_judul_add->RightColumnClass ?>"><div <?php echo $t_judul_add->judul->cellAttributes() ?>>
<span id="el_t_judul_judul">
<input type="text" data-table="t_judul" data-field="x_judul" name="x_judul" id="x_judul" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_judul_add->judul->getPlaceHolder()) ?>" value="<?php echo $t_judul_add->judul->EditValue ?>"<?php echo $t_judul_add->judul->editAttributes() ?>>
</span>
<?php echo $t_judul_add->judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_judul_add->singkatan->Visible) { // singkatan ?>
	<div id="r_singkatan" class="form-group row">
		<label id="elh_t_judul_singkatan" for="x_singkatan" class="<?php echo $t_judul_add->LeftColumnClass ?>"><?php echo $t_judul_add->singkatan->caption() ?><?php echo $t_judul_add->singkatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_judul_add->RightColumnClass ?>"><div <?php echo $t_judul_add->singkatan->cellAttributes() ?>>
<span id="el_t_judul_singkatan">
<input type="text" data-table="t_judul" data-field="x_singkatan" name="x_singkatan" id="x_singkatan" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_judul_add->singkatan->getPlaceHolder()) ?>" value="<?php echo $t_judul_add->singkatan->EditValue ?>"<?php echo $t_judul_add->singkatan->editAttributes() ?>>
</span>
<?php echo $t_judul_add->singkatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("t_juduldetail", explode(",", $t_judul->getCurrentDetailTable())) && $t_juduldetail->DetailAdd) {
?>
<?php if ($t_judul->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_juduldetail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_juduldetailgrid.php" ?>
<?php } ?>
<?php if (!$t_judul_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_judul_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_judul_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_judul_add->showPageFooter();
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
$t_judul_add->terminate();
?>