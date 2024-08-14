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
$t_jadwalpel_add = new t_jadwalpel_add();

// Run the page
$t_jadwalpel_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jadwalpel_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_jadwalpeladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_jadwalpeladd = currentForm = new ew.Form("ft_jadwalpeladd", "add");

	// Validate form
	ft_jadwalpeladd.validate = function() {
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
			<?php if ($t_jadwalpel_add->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->idpelat->caption(), $t_jadwalpel_add->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_add->idpelat->errorMessage()) ?>");
			<?php if ($t_jadwalpel_add->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->kdjudul->caption(), $t_jadwalpel_add->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->tgl->caption(), $t_jadwalpel_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_add->tgl->errorMessage()) ?>");
			<?php if ($t_jadwalpel_add->jam->Required) { ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->jam->caption(), $t_jadwalpel_add->jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_add->jam->errorMessage()) ?>");
			<?php if ($t_jadwalpel_add->jam_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->jam_akhir->caption(), $t_jadwalpel_add->jam_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_add->jam_akhir->errorMessage()) ?>");
			<?php if ($t_jadwalpel_add->materi->Required) { ?>
				elm = this.getElements("x" + infix + "_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->materi->caption(), $t_jadwalpel_add->materi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_add->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->instruktur->caption(), $t_jadwalpel_add->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_add->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->instansi->caption(), $t_jadwalpel_add->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_add->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_add->ket->caption(), $t_jadwalpel_add->ket->RequiredErrorMessage)) ?>");
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
	ft_jadwalpeladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jadwalpeladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	ft_jadwalpeladd.multiPage = new ew.MultiPage("ft_jadwalpeladd");

	// Dynamic selection lists
	ft_jadwalpeladd.lists["x_kdjudul"] = <?php echo $t_jadwalpel_add->kdjudul->Lookup->toClientList($t_jadwalpel_add) ?>;
	ft_jadwalpeladd.lists["x_kdjudul"].options = <?php echo JsonEncode($t_jadwalpel_add->kdjudul->lookupOptions()) ?>;
	ft_jadwalpeladd.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_jadwalpeladd.lists["x_materi"] = <?php echo $t_jadwalpel_add->materi->Lookup->toClientList($t_jadwalpel_add) ?>;
	ft_jadwalpeladd.lists["x_materi"].options = <?php echo JsonEncode($t_jadwalpel_add->materi->lookupOptions()) ?>;
	ft_jadwalpeladd.lists["x_instruktur"] = <?php echo $t_jadwalpel_add->instruktur->Lookup->toClientList($t_jadwalpel_add) ?>;
	ft_jadwalpeladd.lists["x_instruktur"].options = <?php echo JsonEncode($t_jadwalpel_add->instruktur->lookupOptions()) ?>;
	loadjs.done("ft_jadwalpeladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_jadwalpel_add->showPageHeader(); ?>
<?php
$t_jadwalpel_add->showMessage();
?>
<form name="ft_jadwalpeladd" id="ft_jadwalpeladd" class="<?php echo $t_jadwalpel_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jadwalpel">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_jadwalpel_add->IsModal ?>">
<?php if ($t_jadwalpel->getCurrentMasterTable() == "t_pelatihan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pelatihan">
<input type="hidden" name="fk_idpelat" value="<?php echo HtmlEncode($t_jadwalpel_add->idpelat->getSessionValue()) ?>">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_jadwalpel_add->kdjudul->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="t_jadwalpel_add"><!-- multi-page tabs -->
	<ul class="<?php echo $t_jadwalpel_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $t_jadwalpel_add->MultiPages->pageStyle(1) ?>" href="#tab_t_jadwalpel1" data-toggle="tab"><?php echo $t_jadwalpel->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_jadwalpel_add->MultiPages->pageStyle(2) ?>" href="#tab_t_jadwalpel2" data-toggle="tab"><?php echo $t_jadwalpel->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $t_jadwalpel_add->MultiPages->pageStyle(1) ?>" id="tab_t_jadwalpel1"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_jadwalpel_add->idpelat->Visible) { // idpelat ?>
	<div id="r_idpelat" class="form-group row">
		<label id="elh_t_jadwalpel_idpelat" for="x_idpelat" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->idpelat->caption() ?><?php echo $t_jadwalpel_add->idpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->idpelat->cellAttributes() ?>>
<?php if ($t_jadwalpel_add->idpelat->getSessionValue() != "") { ?>
<span id="el_t_jadwalpel_idpelat">
<span<?php echo $t_jadwalpel_add->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_add->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_idpelat" name="x_idpelat" value="<?php echo HtmlEncode($t_jadwalpel_add->idpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_jadwalpel_idpelat">
<input type="text" data-table="t_jadwalpel" data-field="x_idpelat" data-page="1" name="x_idpelat" id="x_idpelat" size="30" placeholder="<?php echo HtmlEncode($t_jadwalpel_add->idpelat->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_add->idpelat->EditValue ?>"<?php echo $t_jadwalpel_add->idpelat->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_jadwalpel_add->idpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_add->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_jadwalpel_kdjudul" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->kdjudul->caption() ?><?php echo $t_jadwalpel_add->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->kdjudul->cellAttributes() ?>>
<?php if ($t_jadwalpel_add->kdjudul->getSessionValue() != "") { ?>
<span id="el_t_jadwalpel_kdjudul">
<span<?php echo $t_jadwalpel_add->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_add->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdjudul" name="x_kdjudul" value="<?php echo HtmlEncode($t_jadwalpel_add->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_jadwalpel_kdjudul">
<?php
$onchange = $t_jadwalpel_add->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_jadwalpel_add->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_jadwalpel_add->kdjudul->EditValue) ?>" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($t_jadwalpel_add->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_jadwalpel_add->kdjudul->getPlaceHolder()) ?>"<?php echo $t_jadwalpel_add->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_kdjudul" data-page="1" data-value-separator="<?php echo $t_jadwalpel_add->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_jadwalpel_add->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_jadwalpeladd"], function() {
	ft_jadwalpeladd.createAutoSuggest({"id":"x_kdjudul","forceSelect":false});
});
</script>
<?php echo $t_jadwalpel_add->kdjudul->Lookup->getParamTag($t_jadwalpel_add, "p_x_kdjudul") ?>
</span>
<?php } ?>
<?php echo $t_jadwalpel_add->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_add->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_t_jadwalpel_tgl" for="x_tgl" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->tgl->caption() ?><?php echo $t_jadwalpel_add->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->tgl->cellAttributes() ?>>
<span id="el_t_jadwalpel_tgl">
<input type="text" data-table="t_jadwalpel" data-field="x_tgl" data-page="1" name="x_tgl" id="x_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalpel_add->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_add->tgl->EditValue ?>"<?php echo $t_jadwalpel_add->tgl->editAttributes() ?>>
<?php if (!$t_jadwalpel_add->tgl->ReadOnly && !$t_jadwalpel_add->tgl->Disabled && !isset($t_jadwalpel_add->tgl->EditAttrs["readonly"]) && !isset($t_jadwalpel_add->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpeladd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalpeladd", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalpel_add->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_add->jam->Visible) { // jam ?>
	<div id="r_jam" class="form-group row">
		<label id="elh_t_jadwalpel_jam" for="x_jam" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->jam->caption() ?><?php echo $t_jadwalpel_add->jam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->jam->cellAttributes() ?>>
<span id="el_t_jadwalpel_jam">
<input type="text" data-table="t_jadwalpel" data-field="x_jam" data-page="1" name="x_jam" id="x_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_add->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_add->jam->EditValue ?>"<?php echo $t_jadwalpel_add->jam->editAttributes() ?>>
<?php if (!$t_jadwalpel_add->jam->ReadOnly && !$t_jadwalpel_add->jam->Disabled && !isset($t_jadwalpel_add->jam->EditAttrs["readonly"]) && !isset($t_jadwalpel_add->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpeladd", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpeladd", "x_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalpel_add->jam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_add->jam_akhir->Visible) { // jam_akhir ?>
	<div id="r_jam_akhir" class="form-group row">
		<label id="elh_t_jadwalpel_jam_akhir" for="x_jam_akhir" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->jam_akhir->caption() ?><?php echo $t_jadwalpel_add->jam_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->jam_akhir->cellAttributes() ?>>
<span id="el_t_jadwalpel_jam_akhir">
<input type="text" data-table="t_jadwalpel" data-field="x_jam_akhir" data-page="1" name="x_jam_akhir" id="x_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_add->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_add->jam_akhir->EditValue ?>"<?php echo $t_jadwalpel_add->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalpel_add->jam_akhir->ReadOnly && !$t_jadwalpel_add->jam_akhir->Disabled && !isset($t_jadwalpel_add->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalpel_add->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpeladd", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpeladd", "x_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalpel_add->jam_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_add->materi->Visible) { // materi ?>
	<div id="r_materi" class="form-group row">
		<label id="elh_t_jadwalpel_materi" for="x_materi" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->materi->caption() ?><?php echo $t_jadwalpel_add->materi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->materi->cellAttributes() ?>>
<span id="el_t_jadwalpel_materi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_materi" data-page="1" data-value-separator="<?php echo $t_jadwalpel_add->materi->displayValueSeparatorAttribute() ?>" id="x_materi" name="x_materi"<?php echo $t_jadwalpel_add->materi->editAttributes() ?>>
			<?php echo $t_jadwalpel_add->materi->selectOptionListHtml("x_materi") ?>
		</select>
</div>
<?php echo $t_jadwalpel_add->materi->Lookup->getParamTag($t_jadwalpel_add, "p_x_materi") ?>
</span>
<?php echo $t_jadwalpel_add->materi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_add->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_jadwalpel_ket" for="x_ket" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->ket->caption() ?><?php echo $t_jadwalpel_add->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->ket->cellAttributes() ?>>
<span id="el_t_jadwalpel_ket">
<input type="text" data-table="t_jadwalpel" data-field="x_ket" data-page="1" name="x_ket" id="x_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalpel_add->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_add->ket->EditValue ?>"<?php echo $t_jadwalpel_add->ket->editAttributes() ?>>
</span>
<?php echo $t_jadwalpel_add->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_jadwalpel_add->MultiPages->pageStyle(2) ?>" id="tab_t_jadwalpel2"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_jadwalpel_add->instruktur->Visible) { // instruktur ?>
	<div id="r_instruktur" class="form-group row">
		<label id="elh_t_jadwalpel_instruktur" for="x_instruktur" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->instruktur->caption() ?><?php echo $t_jadwalpel_add->instruktur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->instruktur->cellAttributes() ?>>
<span id="el_t_jadwalpel_instruktur">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_instruktur" data-page="2" data-value-separator="<?php echo $t_jadwalpel_add->instruktur->displayValueSeparatorAttribute() ?>" id="x_instruktur" name="x_instruktur"<?php echo $t_jadwalpel_add->instruktur->editAttributes() ?>>
			<?php echo $t_jadwalpel_add->instruktur->selectOptionListHtml("x_instruktur") ?>
		</select>
</div>
<?php echo $t_jadwalpel_add->instruktur->Lookup->getParamTag($t_jadwalpel_add, "p_x_instruktur") ?>
</span>
<?php echo $t_jadwalpel_add->instruktur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_add->instansi->Visible) { // instansi ?>
	<div id="r_instansi" class="form-group row">
		<label id="elh_t_jadwalpel_instansi" for="x_instansi" class="<?php echo $t_jadwalpel_add->LeftColumnClass ?>"><?php echo $t_jadwalpel_add->instansi->caption() ?><?php echo $t_jadwalpel_add->instansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_add->RightColumnClass ?>"><div <?php echo $t_jadwalpel_add->instansi->cellAttributes() ?>>
<span id="el_t_jadwalpel_instansi">
<input type="text" data-table="t_jadwalpel" data-field="x_instansi" data-page="2" name="x_instansi" id="x_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalpel_add->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_add->instansi->EditValue ?>"<?php echo $t_jadwalpel_add->instansi->editAttributes() ?>>
</span>
<?php echo $t_jadwalpel_add->instansi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$t_jadwalpel_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_jadwalpel_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_jadwalpel_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_jadwalpel_add->showPageFooter();
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
$t_jadwalpel_add->terminate();
?>