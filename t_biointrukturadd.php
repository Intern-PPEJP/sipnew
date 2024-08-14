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
$t_biointruktur_add = new t_biointruktur_add();

// Run the page
$t_biointruktur_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_biointruktur_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_biointrukturadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_biointrukturadd = currentForm = new ew.Form("ft_biointrukturadd", "add");

	// Validate form
	ft_biointrukturadd.validate = function() {
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
			<?php if ($t_biointruktur_add->kdinstruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinstruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->kdinstruktur->caption(), $t_biointruktur_add->kdinstruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->revisi->Required) { ?>
				elm = this.getElements("x" + infix + "_revisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->revisi->caption(), $t_biointruktur_add->revisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->tglterbit->Required) { ?>
				elm = this.getElements("x" + infix + "_tglterbit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->tglterbit->caption(), $t_biointruktur_add->tglterbit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tglterbit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_biointruktur_add->tglterbit->errorMessage()) ?>");
			<?php if ($t_biointruktur_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->nama->caption(), $t_biointruktur_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->komp_materi->Required) { ?>
				elm = this.getElements("x" + infix + "_komp_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->komp_materi->caption(), $t_biointruktur_add->komp_materi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_komp_materi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_biointruktur_add->komp_materi->errorMessage()) ?>");
			<?php if ($t_biointruktur_add->tmplahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tmplahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->tmplahir->caption(), $t_biointruktur_add->tmplahir->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->tgllahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgllahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->tgllahir->caption(), $t_biointruktur_add->tgllahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgllahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_biointruktur_add->tgllahir->errorMessage()) ?>");
			<?php if ($t_biointruktur_add->agama->Required) { ?>
				elm = this.getElements("x" + infix + "_agama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->agama->caption(), $t_biointruktur_add->agama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->kategori->caption(), $t_biointruktur_add->kategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->instansi->caption(), $t_biointruktur_add->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->pekerjaan->Required) { ?>
				elm = this.getElements("x" + infix + "_pekerjaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->pekerjaan->caption(), $t_biointruktur_add->pekerjaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->alamatkantor->Required) { ?>
				elm = this.getElements("x" + infix + "_alamatkantor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->alamatkantor->caption(), $t_biointruktur_add->alamatkantor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->alamatrumah->Required) { ?>
				elm = this.getElements("x" + infix + "_alamatrumah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->alamatrumah->caption(), $t_biointruktur_add->alamatrumah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->telepon->Required) { ?>
				elm = this.getElements("x" + infix + "_telepon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->telepon->caption(), $t_biointruktur_add->telepon->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->hp->caption(), $t_biointruktur_add->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->_email->caption(), $t_biointruktur_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_biointruktur_add->_email->errorMessage()) ?>");
			<?php if ($t_biointruktur_add->fax->Required) { ?>
				elm = this.getElements("x" + infix + "_fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->fax->caption(), $t_biointruktur_add->fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->created_by->caption(), $t_biointruktur_add->created_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_add->created_at->caption(), $t_biointruktur_add->created_at->RequiredErrorMessage)) ?>");
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
	ft_biointrukturadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_biointrukturadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_biointrukturadd.lists["x_komp_materi"] = <?php echo $t_biointruktur_add->komp_materi->Lookup->toClientList($t_biointruktur_add) ?>;
	ft_biointrukturadd.lists["x_komp_materi"].options = <?php echo JsonEncode($t_biointruktur_add->komp_materi->lookupOptions()) ?>;
	ft_biointrukturadd.autoSuggests["x_komp_materi"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_biointrukturadd.lists["x_agama"] = <?php echo $t_biointruktur_add->agama->Lookup->toClientList($t_biointruktur_add) ?>;
	ft_biointrukturadd.lists["x_agama"].options = <?php echo JsonEncode($t_biointruktur_add->agama->lookupOptions()) ?>;
	ft_biointrukturadd.lists["x_kategori"] = <?php echo $t_biointruktur_add->kategori->Lookup->toClientList($t_biointruktur_add) ?>;
	ft_biointrukturadd.lists["x_kategori"].options = <?php echo JsonEncode($t_biointruktur_add->kategori->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_biointrukturadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_biointruktur_add->showPageHeader(); ?>
<?php
$t_biointruktur_add->showMessage();
?>
<form name="ft_biointrukturadd" id="ft_biointrukturadd" class="<?php echo $t_biointruktur_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_biointruktur">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_biointruktur_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_biointruktur_add->kdinstruktur->Visible) { // kdinstruktur ?>
	<div id="r_kdinstruktur" class="form-group row">
		<label id="elh_t_biointruktur_kdinstruktur" for="x_kdinstruktur" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->kdinstruktur->caption() ?><?php echo $t_biointruktur_add->kdinstruktur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->kdinstruktur->cellAttributes() ?>>
<span id="el_t_biointruktur_kdinstruktur">
<input type="text" data-table="t_biointruktur" data-field="x_kdinstruktur" name="x_kdinstruktur" id="x_kdinstruktur" size="6" maxlength="6" placeholder="<?php echo HtmlEncode($t_biointruktur_add->kdinstruktur->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->kdinstruktur->EditValue ?>"<?php echo $t_biointruktur_add->kdinstruktur->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->kdinstruktur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label id="elh_t_biointruktur_revisi" for="x_revisi" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->revisi->caption() ?><?php echo $t_biointruktur_add->revisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->revisi->cellAttributes() ?>>
<span id="el_t_biointruktur_revisi">
<input type="text" data-table="t_biointruktur" data-field="x_revisi" name="x_revisi" id="x_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($t_biointruktur_add->revisi->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->revisi->EditValue ?>"<?php echo $t_biointruktur_add->revisi->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->revisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->tglterbit->Visible) { // tglterbit ?>
	<div id="r_tglterbit" class="form-group row">
		<label id="elh_t_biointruktur_tglterbit" for="x_tglterbit" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->tglterbit->caption() ?><?php echo $t_biointruktur_add->tglterbit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->tglterbit->cellAttributes() ?>>
<span id="el_t_biointruktur_tglterbit">
<input type="text" data-table="t_biointruktur" data-field="x_tglterbit" name="x_tglterbit" id="x_tglterbit" size="7" placeholder="<?php echo HtmlEncode($t_biointruktur_add->tglterbit->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->tglterbit->EditValue ?>"<?php echo $t_biointruktur_add->tglterbit->editAttributes() ?>>
<?php if (!$t_biointruktur_add->tglterbit->ReadOnly && !$t_biointruktur_add->tglterbit->Disabled && !isset($t_biointruktur_add->tglterbit->EditAttrs["readonly"]) && !isset($t_biointruktur_add->tglterbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_biointrukturadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_biointrukturadd", "x_tglterbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_biointruktur_add->tglterbit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_t_biointruktur_nama" for="x_nama" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->nama->caption() ?><?php echo $t_biointruktur_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->nama->cellAttributes() ?>>
<span id="el_t_biointruktur_nama">
<input type="text" data-table="t_biointruktur" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_biointruktur_add->nama->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->nama->EditValue ?>"<?php echo $t_biointruktur_add->nama->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->komp_materi->Visible) { // komp_materi ?>
	<div id="r_komp_materi" class="form-group row">
		<label id="elh_t_biointruktur_komp_materi" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->komp_materi->caption() ?><?php echo $t_biointruktur_add->komp_materi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->komp_materi->cellAttributes() ?>>
<span id="el_t_biointruktur_komp_materi">
<?php
$onchange = $t_biointruktur_add->komp_materi->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_biointruktur_add->komp_materi->EditAttrs["onchange"] = "";
?>
<span id="as_x_komp_materi">
	<input type="text" class="form-control" name="sv_x_komp_materi" id="sv_x_komp_materi" value="<?php echo RemoveHtml($t_biointruktur_add->komp_materi->EditValue) ?>" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_biointruktur_add->komp_materi->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_biointruktur_add->komp_materi->getPlaceHolder()) ?>"<?php echo $t_biointruktur_add->komp_materi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_biointruktur" data-field="x_komp_materi" data-value-separator="<?php echo $t_biointruktur_add->komp_materi->displayValueSeparatorAttribute() ?>" name="x_komp_materi" id="x_komp_materi" value="<?php echo HtmlEncode($t_biointruktur_add->komp_materi->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_biointrukturadd"], function() {
	ft_biointrukturadd.createAutoSuggest({"id":"x_komp_materi","forceSelect":true});
});
</script>
<?php echo $t_biointruktur_add->komp_materi->Lookup->getParamTag($t_biointruktur_add, "p_x_komp_materi") ?>
</span>
<?php echo $t_biointruktur_add->komp_materi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->tmplahir->Visible) { // tmplahir ?>
	<div id="r_tmplahir" class="form-group row">
		<label id="elh_t_biointruktur_tmplahir" for="x_tmplahir" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->tmplahir->caption() ?><?php echo $t_biointruktur_add->tmplahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->tmplahir->cellAttributes() ?>>
<span id="el_t_biointruktur_tmplahir">
<input type="text" data-table="t_biointruktur" data-field="x_tmplahir" name="x_tmplahir" id="x_tmplahir" size="30" placeholder="<?php echo HtmlEncode($t_biointruktur_add->tmplahir->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->tmplahir->EditValue ?>"<?php echo $t_biointruktur_add->tmplahir->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->tmplahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->tgllahir->Visible) { // tgllahir ?>
	<div id="r_tgllahir" class="form-group row">
		<label id="elh_t_biointruktur_tgllahir" for="x_tgllahir" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->tgllahir->caption() ?><?php echo $t_biointruktur_add->tgllahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->tgllahir->cellAttributes() ?>>
<span id="el_t_biointruktur_tgllahir">
<input type="text" data-table="t_biointruktur" data-field="x_tgllahir" name="x_tgllahir" id="x_tgllahir" size="7" placeholder="<?php echo HtmlEncode($t_biointruktur_add->tgllahir->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->tgllahir->EditValue ?>"<?php echo $t_biointruktur_add->tgllahir->editAttributes() ?>>
<?php if (!$t_biointruktur_add->tgllahir->ReadOnly && !$t_biointruktur_add->tgllahir->Disabled && !isset($t_biointruktur_add->tgllahir->EditAttrs["readonly"]) && !isset($t_biointruktur_add->tgllahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_biointrukturadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_biointrukturadd", "x_tgllahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_biointruktur_add->tgllahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->agama->Visible) { // agama ?>
	<div id="r_agama" class="form-group row">
		<label id="elh_t_biointruktur_agama" for="x_agama" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->agama->caption() ?><?php echo $t_biointruktur_add->agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->agama->cellAttributes() ?>>
<span id="el_t_biointruktur_agama">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_biointruktur" data-field="x_agama" data-value-separator="<?php echo $t_biointruktur_add->agama->displayValueSeparatorAttribute() ?>" id="x_agama" name="x_agama"<?php echo $t_biointruktur_add->agama->editAttributes() ?>>
			<?php echo $t_biointruktur_add->agama->selectOptionListHtml("x_agama") ?>
		</select>
</div>
<?php echo $t_biointruktur_add->agama->Lookup->getParamTag($t_biointruktur_add, "p_x_agama") ?>
</span>
<?php echo $t_biointruktur_add->agama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label id="elh_t_biointruktur_kategori" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->kategori->caption() ?><?php echo $t_biointruktur_add->kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->kategori->cellAttributes() ?>>
<span id="el_t_biointruktur_kategori">
<div id="tp_x_kategori" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_biointruktur" data-field="x_kategori" data-value-separator="<?php echo $t_biointruktur_add->kategori->displayValueSeparatorAttribute() ?>" name="x_kategori" id="x_kategori" value="{value}"<?php echo $t_biointruktur_add->kategori->editAttributes() ?>></div>
<div id="dsl_x_kategori" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_biointruktur_add->kategori->radioButtonListHtml(FALSE, "x_kategori") ?>
</div></div>
</span>
<?php echo $t_biointruktur_add->kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->instansi->Visible) { // instansi ?>
	<div id="r_instansi" class="form-group row">
		<label id="elh_t_biointruktur_instansi" for="x_instansi" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->instansi->caption() ?><?php echo $t_biointruktur_add->instansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->instansi->cellAttributes() ?>>
<span id="el_t_biointruktur_instansi">
<input type="text" data-table="t_biointruktur" data-field="x_instansi" name="x_instansi" id="x_instansi" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($t_biointruktur_add->instansi->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->instansi->EditValue ?>"<?php echo $t_biointruktur_add->instansi->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->instansi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->pekerjaan->Visible) { // pekerjaan ?>
	<div id="r_pekerjaan" class="form-group row">
		<label id="elh_t_biointruktur_pekerjaan" for="x_pekerjaan" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->pekerjaan->caption() ?><?php echo $t_biointruktur_add->pekerjaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->pekerjaan->cellAttributes() ?>>
<span id="el_t_biointruktur_pekerjaan">
<input type="text" data-table="t_biointruktur" data-field="x_pekerjaan" name="x_pekerjaan" id="x_pekerjaan" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($t_biointruktur_add->pekerjaan->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->pekerjaan->EditValue ?>"<?php echo $t_biointruktur_add->pekerjaan->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->pekerjaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->alamatkantor->Visible) { // alamatkantor ?>
	<div id="r_alamatkantor" class="form-group row">
		<label id="elh_t_biointruktur_alamatkantor" for="x_alamatkantor" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->alamatkantor->caption() ?><?php echo $t_biointruktur_add->alamatkantor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->alamatkantor->cellAttributes() ?>>
<span id="el_t_biointruktur_alamatkantor">
<textarea data-table="t_biointruktur" data-field="x_alamatkantor" name="x_alamatkantor" id="x_alamatkantor" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_biointruktur_add->alamatkantor->getPlaceHolder()) ?>"<?php echo $t_biointruktur_add->alamatkantor->editAttributes() ?>><?php echo $t_biointruktur_add->alamatkantor->EditValue ?></textarea>
</span>
<?php echo $t_biointruktur_add->alamatkantor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->alamatrumah->Visible) { // alamatrumah ?>
	<div id="r_alamatrumah" class="form-group row">
		<label id="elh_t_biointruktur_alamatrumah" for="x_alamatrumah" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->alamatrumah->caption() ?><?php echo $t_biointruktur_add->alamatrumah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->alamatrumah->cellAttributes() ?>>
<span id="el_t_biointruktur_alamatrumah">
<textarea data-table="t_biointruktur" data-field="x_alamatrumah" name="x_alamatrumah" id="x_alamatrumah" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_biointruktur_add->alamatrumah->getPlaceHolder()) ?>"<?php echo $t_biointruktur_add->alamatrumah->editAttributes() ?>><?php echo $t_biointruktur_add->alamatrumah->EditValue ?></textarea>
</span>
<?php echo $t_biointruktur_add->alamatrumah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->telepon->Visible) { // telepon ?>
	<div id="r_telepon" class="form-group row">
		<label id="elh_t_biointruktur_telepon" for="x_telepon" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->telepon->caption() ?><?php echo $t_biointruktur_add->telepon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->telepon->cellAttributes() ?>>
<span id="el_t_biointruktur_telepon">
<input type="text" data-table="t_biointruktur" data-field="x_telepon" name="x_telepon" id="x_telepon" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_biointruktur_add->telepon->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->telepon->EditValue ?>"<?php echo $t_biointruktur_add->telepon->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->telepon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_t_biointruktur_hp" for="x_hp" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->hp->caption() ?><?php echo $t_biointruktur_add->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->hp->cellAttributes() ?>>
<span id="el_t_biointruktur_hp">
<input type="text" data-table="t_biointruktur" data-field="x_hp" name="x_hp" id="x_hp" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_biointruktur_add->hp->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->hp->EditValue ?>"<?php echo $t_biointruktur_add->hp->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_t_biointruktur__email" for="x__email" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->_email->caption() ?><?php echo $t_biointruktur_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->_email->cellAttributes() ?>>
<span id="el_t_biointruktur__email">
<input type="text" data-table="t_biointruktur" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_biointruktur_add->_email->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->_email->EditValue ?>"<?php echo $t_biointruktur_add->_email->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_add->fax->Visible) { // fax ?>
	<div id="r_fax" class="form-group row">
		<label id="elh_t_biointruktur_fax" for="x_fax" class="<?php echo $t_biointruktur_add->LeftColumnClass ?>"><?php echo $t_biointruktur_add->fax->caption() ?><?php echo $t_biointruktur_add->fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_add->RightColumnClass ?>"><div <?php echo $t_biointruktur_add->fax->cellAttributes() ?>>
<span id="el_t_biointruktur_fax">
<input type="text" data-table="t_biointruktur" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_biointruktur_add->fax->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_add->fax->EditValue ?>"<?php echo $t_biointruktur_add->fax->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_add->fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($t_biointruktur->getCurrentDetailTable() != "") { ?>
<?php
	$t_biointruktur_add->DetailPages->ValidKeys = explode(",", $t_biointruktur->getCurrentDetailTable());
	$firstActiveDetailTable = $t_biointruktur_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="t_biointruktur_add_details"><!-- tabs -->
	<ul class="<?php echo $t_biointruktur_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("t_rwpendd", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpendd->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpendd") {
			$firstActiveDetailTable = "t_rwpendd";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_rwpendd") ?>" href="#tab_t_rwpendd" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwpendd", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_rwpekerjaan", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpekerjaan->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpekerjaan") {
			$firstActiveDetailTable = "t_rwpekerjaan";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_rwpekerjaan") ?>" href="#tab_t_rwpekerjaan" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwpekerjaan", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_rwtraining", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwtraining->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwtraining") {
			$firstActiveDetailTable = "t_rwtraining";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_rwtraining") ?>" href="#tab_t_rwtraining" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwtraining", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_faskur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_faskur->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_faskur") {
			$firstActiveDetailTable = "t_faskur";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_faskur") ?>" href="#tab_t_faskur" data-toggle="tab"><?php echo $Language->tablePhrase("t_faskur", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("cv_rwipelatihaninstruktur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $cv_rwipelatihaninstruktur->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "cv_rwipelatihaninstruktur") {
			$firstActiveDetailTable = "cv_rwipelatihaninstruktur";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_add->DetailPages->pageStyle("cv_rwipelatihaninstruktur") ?>" href="#tab_cv_rwipelatihaninstruktur" data-toggle="tab"><?php echo $Language->tablePhrase("cv_rwipelatihaninstruktur", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_evaluasifas", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_evaluasifas->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_evaluasifas") {
			$firstActiveDetailTable = "t_evaluasifas";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_evaluasifas") ?>" href="#tab_t_evaluasifas" data-toggle="tab"><?php echo $Language->tablePhrase("t_evaluasifas", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("t_rwpendd", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpendd->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpendd")
			$firstActiveDetailTable = "t_rwpendd";
?>
		<div class="tab-pane <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_rwpendd") ?>" id="tab_t_rwpendd"><!-- page* -->
<?php include_once "t_rwpenddgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_rwpekerjaan", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpekerjaan->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpekerjaan")
			$firstActiveDetailTable = "t_rwpekerjaan";
?>
		<div class="tab-pane <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_rwpekerjaan") ?>" id="tab_t_rwpekerjaan"><!-- page* -->
<?php include_once "t_rwpekerjaangrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_rwtraining", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwtraining->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwtraining")
			$firstActiveDetailTable = "t_rwtraining";
?>
		<div class="tab-pane <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_rwtraining") ?>" id="tab_t_rwtraining"><!-- page* -->
<?php include_once "t_rwtraininggrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_faskur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_faskur->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_faskur")
			$firstActiveDetailTable = "t_faskur";
?>
		<div class="tab-pane <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_faskur") ?>" id="tab_t_faskur"><!-- page* -->
<?php include_once "t_faskurgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("cv_rwipelatihaninstruktur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $cv_rwipelatihaninstruktur->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "cv_rwipelatihaninstruktur")
			$firstActiveDetailTable = "cv_rwipelatihaninstruktur";
?>
		<div class="tab-pane <?php echo $t_biointruktur_add->DetailPages->pageStyle("cv_rwipelatihaninstruktur") ?>" id="tab_cv_rwipelatihaninstruktur"><!-- page* -->
<?php include_once "cv_rwipelatihaninstrukturgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_evaluasifas", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_evaluasifas->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_evaluasifas")
			$firstActiveDetailTable = "t_evaluasifas";
?>
		<div class="tab-pane <?php echo $t_biointruktur_add->DetailPages->pageStyle("t_evaluasifas") ?>" id="tab_t_evaluasifas"><!-- page* -->
<?php include_once "t_evaluasifasgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$t_biointruktur_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_biointruktur_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_biointruktur_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_biointruktur_add->showPageFooter();
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
$t_biointruktur_add->terminate();
?>