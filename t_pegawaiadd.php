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
$t_pegawai_add = new t_pegawai_add();

// Run the page
$t_pegawai_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pegawai_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pegawaiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_pegawaiadd = currentForm = new ew.Form("ft_pegawaiadd", "add");

	// Validate form
	ft_pegawaiadd.validate = function() {
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
			<?php if ($t_pegawai_add->nip->Required) { ?>
				elm = this.getElements("x" + infix + "_nip");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_add->nip->caption(), $t_pegawai_add->nip->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_add->nama->caption(), $t_pegawai_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_add->bagian->Required) { ?>
				elm = this.getElements("x" + infix + "_bagian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_add->bagian->caption(), $t_pegawai_add->bagian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_add->created_at->caption(), $t_pegawai_add->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_add->user_created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_add->user_created_by->caption(), $t_pegawai_add->user_created_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_add->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_add->aktif->caption(), $t_pegawai_add->aktif->RequiredErrorMessage)) ?>");
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
	ft_pegawaiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pegawaiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pegawaiadd.lists["x_bagian"] = <?php echo $t_pegawai_add->bagian->Lookup->toClientList($t_pegawai_add) ?>;
	ft_pegawaiadd.lists["x_bagian"].options = <?php echo JsonEncode($t_pegawai_add->bagian->lookupOptions()) ?>;
	ft_pegawaiadd.lists["x_aktif[]"] = <?php echo $t_pegawai_add->aktif->Lookup->toClientList($t_pegawai_add) ?>;
	ft_pegawaiadd.lists["x_aktif[]"].options = <?php echo JsonEncode($t_pegawai_add->aktif->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_pegawaiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pegawai_add->showPageHeader(); ?>
<?php
$t_pegawai_add->showMessage();
?>
<form name="ft_pegawaiadd" id="ft_pegawaiadd" class="<?php echo $t_pegawai_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pegawai">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_pegawai_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pegawai_add->nip->Visible) { // nip ?>
	<div id="r_nip" class="form-group row">
		<label id="elh_t_pegawai_nip" for="x_nip" class="<?php echo $t_pegawai_add->LeftColumnClass ?>"><?php echo $t_pegawai_add->nip->caption() ?><?php echo $t_pegawai_add->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pegawai_add->RightColumnClass ?>"><div <?php echo $t_pegawai_add->nip->cellAttributes() ?>>
<span id="el_t_pegawai_nip">
<input type="text" data-table="t_pegawai" data-field="x_nip" name="x_nip" id="x_nip" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_pegawai_add->nip->getPlaceHolder()) ?>" value="<?php echo $t_pegawai_add->nip->EditValue ?>"<?php echo $t_pegawai_add->nip->editAttributes() ?>>
</span>
<?php echo $t_pegawai_add->nip->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pegawai_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_t_pegawai_nama" for="x_nama" class="<?php echo $t_pegawai_add->LeftColumnClass ?>"><?php echo $t_pegawai_add->nama->caption() ?><?php echo $t_pegawai_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pegawai_add->RightColumnClass ?>"><div <?php echo $t_pegawai_add->nama->cellAttributes() ?>>
<span id="el_t_pegawai_nama">
<input type="text" data-table="t_pegawai" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pegawai_add->nama->getPlaceHolder()) ?>" value="<?php echo $t_pegawai_add->nama->EditValue ?>"<?php echo $t_pegawai_add->nama->editAttributes() ?>>
</span>
<?php echo $t_pegawai_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pegawai_add->bagian->Visible) { // bagian ?>
	<div id="r_bagian" class="form-group row">
		<label id="elh_t_pegawai_bagian" for="x_bagian" class="<?php echo $t_pegawai_add->LeftColumnClass ?>"><?php echo $t_pegawai_add->bagian->caption() ?><?php echo $t_pegawai_add->bagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pegawai_add->RightColumnClass ?>"><div <?php echo $t_pegawai_add->bagian->cellAttributes() ?>>
<span id="el_t_pegawai_bagian">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pegawai" data-field="x_bagian" data-value-separator="<?php echo $t_pegawai_add->bagian->displayValueSeparatorAttribute() ?>" id="x_bagian" name="x_bagian"<?php echo $t_pegawai_add->bagian->editAttributes() ?>>
			<?php echo $t_pegawai_add->bagian->selectOptionListHtml("x_bagian") ?>
		</select>
</div>
<?php echo $t_pegawai_add->bagian->Lookup->getParamTag($t_pegawai_add, "p_x_bagian") ?>
</span>
<?php echo $t_pegawai_add->bagian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pegawai_add->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_t_pegawai_aktif" class="<?php echo $t_pegawai_add->LeftColumnClass ?>"><?php echo $t_pegawai_add->aktif->caption() ?><?php echo $t_pegawai_add->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pegawai_add->RightColumnClass ?>"><div <?php echo $t_pegawai_add->aktif->cellAttributes() ?>>
<span id="el_t_pegawai_aktif">
<?php
$selwrk = ConvertToBool($t_pegawai_add->aktif->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="t_pegawai" data-field="x_aktif" name="x_aktif[]" id="x_aktif[]_306619" value="1"<?php echo $selwrk ?><?php echo $t_pegawai_add->aktif->editAttributes() ?>>
	<label class="custom-control-label" for="x_aktif[]_306619"></label>
</div>
</span>
<?php echo $t_pegawai_add->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_pegawai_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pegawai_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pegawai_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pegawai_add->showPageFooter();
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
$t_pegawai_add->terminate();
?>