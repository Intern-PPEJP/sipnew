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
$t_kurikulum_add = new t_kurikulum_add();

// Run the page
$t_kurikulum_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kurikulum_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_kurikulumadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_kurikulumadd = currentForm = new ew.Form("ft_kurikulumadd", "add");

	// Validate form
	ft_kurikulumadd.validate = function() {
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
			<?php if ($t_kurikulum_add->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_add->kdkursil->caption(), $t_kurikulum_add->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_add->hari->Required) { ?>
				elm = this.getElements("x" + infix + "_hari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_add->hari->caption(), $t_kurikulum_add->hari->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_add->kurikulum->Required) { ?>
				elm = this.getElements("x" + infix + "_kurikulum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_add->kurikulum->caption(), $t_kurikulum_add->kurikulum->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_add->silabus->Required) { ?>
				elm = this.getElements("x" + infix + "_silabus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_add->silabus->caption(), $t_kurikulum_add->silabus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_add->tujuan_instruksional->Required) { ?>
				elm = this.getElements("x" + infix + "_tujuan_instruksional");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_add->tujuan_instruksional->caption(), $t_kurikulum_add->tujuan_instruksional->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_add->sesi->Required) { ?>
				elm = this.getElements("x" + infix + "_sesi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_add->sesi->caption(), $t_kurikulum_add->sesi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sesi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kurikulum_add->sesi->errorMessage()) ?>");
			<?php if ($t_kurikulum_add->created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_add->created_by->caption(), $t_kurikulum_add->created_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_add->created_at->caption(), $t_kurikulum_add->created_at->RequiredErrorMessage)) ?>");
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
	ft_kurikulumadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_kurikulumadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_kurikulumadd.lists["x_hari"] = <?php echo $t_kurikulum_add->hari->Lookup->toClientList($t_kurikulum_add) ?>;
	ft_kurikulumadd.lists["x_hari"].options = <?php echo JsonEncode($t_kurikulum_add->hari->lookupOptions()) ?>;
	loadjs.done("ft_kurikulumadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_kurikulum_add->showPageHeader(); ?>
<?php
$t_kurikulum_add->showMessage();
?>
<form name="ft_kurikulumadd" id="ft_kurikulumadd" class="<?php echo $t_kurikulum_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kurikulum">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_kurikulum_add->IsModal ?>">
<?php if ($t_kurikulum->getCurrentMasterTable() == "t_juduldetail") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_juduldetail">
<input type="hidden" name="fk_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_add->kdkursil->getSessionValue()) ?>">
<input type="hidden" name="fk_jpel" value="<?php echo HtmlEncode($t_kurikulum_add->jpel->getSessionValue()) ?>">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_kurikulum_add->kdjudul->getSessionValue()) ?>">
<input type="hidden" name="fk_revisi" value="<?php echo HtmlEncode($t_kurikulum_add->revisi->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_kurikulum_add->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_t_kurikulum_kdkursil" for="x_kdkursil" class="<?php echo $t_kurikulum_add->LeftColumnClass ?>"><?php echo $t_kurikulum_add->kdkursil->caption() ?><?php echo $t_kurikulum_add->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kurikulum_add->RightColumnClass ?>"><div <?php echo $t_kurikulum_add->kdkursil->cellAttributes() ?>>
<?php if ($t_kurikulum_add->kdkursil->getSessionValue() != "") { ?>
<span id="el_t_kurikulum_kdkursil">
<span<?php echo $t_kurikulum_add->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kurikulum_add->kdkursil->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdkursil" name="x_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_add->kdkursil->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_kurikulum_kdkursil">
<input type="text" data-table="t_kurikulum" data-field="x_kdkursil" name="x_kdkursil" id="x_kdkursil" size="12" maxlength="12" placeholder="<?php echo HtmlEncode($t_kurikulum_add->kdkursil->getPlaceHolder()) ?>" value="<?php echo $t_kurikulum_add->kdkursil->EditValue ?>"<?php echo $t_kurikulum_add->kdkursil->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_kurikulum_add->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kurikulum_add->hari->Visible) { // hari ?>
	<div id="r_hari" class="form-group row">
		<label id="elh_t_kurikulum_hari" for="x_hari" class="<?php echo $t_kurikulum_add->LeftColumnClass ?>"><?php echo $t_kurikulum_add->hari->caption() ?><?php echo $t_kurikulum_add->hari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kurikulum_add->RightColumnClass ?>"><div <?php echo $t_kurikulum_add->hari->cellAttributes() ?>>
<span id="el_t_kurikulum_hari">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_kurikulum" data-field="x_hari" data-value-separator="<?php echo $t_kurikulum_add->hari->displayValueSeparatorAttribute() ?>" id="x_hari" name="x_hari"<?php echo $t_kurikulum_add->hari->editAttributes() ?>>
			<?php echo $t_kurikulum_add->hari->selectOptionListHtml("x_hari") ?>
		</select>
</div>
<?php echo $t_kurikulum_add->hari->Lookup->getParamTag($t_kurikulum_add, "p_x_hari") ?>
</span>
<?php echo $t_kurikulum_add->hari->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kurikulum_add->kurikulum->Visible) { // kurikulum ?>
	<div id="r_kurikulum" class="form-group row">
		<label id="elh_t_kurikulum_kurikulum" for="x_kurikulum" class="<?php echo $t_kurikulum_add->LeftColumnClass ?>"><?php echo $t_kurikulum_add->kurikulum->caption() ?><?php echo $t_kurikulum_add->kurikulum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kurikulum_add->RightColumnClass ?>"><div <?php echo $t_kurikulum_add->kurikulum->cellAttributes() ?>>
<span id="el_t_kurikulum_kurikulum">
<textarea data-table="t_kurikulum" data-field="x_kurikulum" name="x_kurikulum" id="x_kurikulum" cols="10" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_add->kurikulum->getPlaceHolder()) ?>"<?php echo $t_kurikulum_add->kurikulum->editAttributes() ?>><?php echo $t_kurikulum_add->kurikulum->EditValue ?></textarea>
</span>
<?php echo $t_kurikulum_add->kurikulum->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kurikulum_add->silabus->Visible) { // silabus ?>
	<div id="r_silabus" class="form-group row">
		<label id="elh_t_kurikulum_silabus" class="<?php echo $t_kurikulum_add->LeftColumnClass ?>"><?php echo $t_kurikulum_add->silabus->caption() ?><?php echo $t_kurikulum_add->silabus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kurikulum_add->RightColumnClass ?>"><div <?php echo $t_kurikulum_add->silabus->cellAttributes() ?>>
<span id="el_t_kurikulum_silabus">
<?php $t_kurikulum_add->silabus->EditAttrs->appendClass("editor"); ?>
<textarea data-table="t_kurikulum" data-field="x_silabus" name="x_silabus" id="x_silabus" cols="95" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_add->silabus->getPlaceHolder()) ?>"<?php echo $t_kurikulum_add->silabus->editAttributes() ?>><?php echo $t_kurikulum_add->silabus->EditValue ?></textarea>
<script>
loadjs.ready(["ft_kurikulumadd", "editor"], function() {
	ew.createEditor("ft_kurikulumadd", "x_silabus", 95, 4, <?php echo $t_kurikulum_add->silabus->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $t_kurikulum_add->silabus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kurikulum_add->tujuan_instruksional->Visible) { // tujuan_instruksional ?>
	<div id="r_tujuan_instruksional" class="form-group row">
		<label id="elh_t_kurikulum_tujuan_instruksional" for="x_tujuan_instruksional" class="<?php echo $t_kurikulum_add->LeftColumnClass ?>"><?php echo $t_kurikulum_add->tujuan_instruksional->caption() ?><?php echo $t_kurikulum_add->tujuan_instruksional->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kurikulum_add->RightColumnClass ?>"><div <?php echo $t_kurikulum_add->tujuan_instruksional->cellAttributes() ?>>
<span id="el_t_kurikulum_tujuan_instruksional">
<textarea data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="x_tujuan_instruksional" id="x_tujuan_instruksional" cols="10" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_add->tujuan_instruksional->getPlaceHolder()) ?>"<?php echo $t_kurikulum_add->tujuan_instruksional->editAttributes() ?>><?php echo $t_kurikulum_add->tujuan_instruksional->EditValue ?></textarea>
</span>
<?php echo $t_kurikulum_add->tujuan_instruksional->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kurikulum_add->sesi->Visible) { // sesi ?>
	<div id="r_sesi" class="form-group row">
		<label id="elh_t_kurikulum_sesi" for="x_sesi" class="<?php echo $t_kurikulum_add->LeftColumnClass ?>"><?php echo $t_kurikulum_add->sesi->caption() ?><?php echo $t_kurikulum_add->sesi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kurikulum_add->RightColumnClass ?>"><div <?php echo $t_kurikulum_add->sesi->cellAttributes() ?>>
<span id="el_t_kurikulum_sesi">
<input type="text" data-table="t_kurikulum" data-field="x_sesi" name="x_sesi" id="x_sesi" size="1" maxlength="2" placeholder="<?php echo HtmlEncode($t_kurikulum_add->sesi->getPlaceHolder()) ?>" value="<?php echo $t_kurikulum_add->sesi->EditValue ?>"<?php echo $t_kurikulum_add->sesi->editAttributes() ?>>
</span>
<?php echo $t_kurikulum_add->sesi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($t_kurikulum_add->jpel->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_jpel" id="x_jpel" value="<?php echo HtmlEncode(strval($t_kurikulum_add->jpel->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($t_kurikulum_add->kdjudul->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode(strval($t_kurikulum_add->kdjudul->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($t_kurikulum_add->revisi->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_revisi" id="x_revisi" value="<?php echo HtmlEncode(strval($t_kurikulum_add->revisi->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$t_kurikulum_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_kurikulum_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_kurikulum_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_kurikulum_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#x_lama_pelatihan").after(" hari");
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_kurikulum_add->terminate();
?>