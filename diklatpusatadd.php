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
$diklatpusat_add = new diklatpusat_add();

// Run the page
$diklatpusat_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatpusat_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdiklatpusatadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdiklatpusatadd = currentForm = new ew.Form("fdiklatpusatadd", "add");

	// Validate form
	fdiklatpusatadd.validate = function() {
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
			<?php if ($diklatpusat_add->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->kdpelat->caption(), $diklatpusat_add->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->kdjudul->caption(), $diklatpusat_add->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->tawal->caption(), $diklatpusat_add->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatpusat_add->tawal->errorMessage()) ?>");
			<?php if ($diklatpusat_add->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->takhir->caption(), $diklatpusat_add->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatpusat_add->takhir->errorMessage()) ?>");
			<?php if ($diklatpusat_add->dana->Required) { ?>
				elm = this.getElements("x" + infix + "_dana");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->dana->caption(), $diklatpusat_add->dana->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->ketua->caption(), $diklatpusat_add->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->sekretaris->caption(), $diklatpusat_add->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->bendahara->caption(), $diklatpusat_add->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->anggota2->Required) { ?>
				elm = this.getElements("x" + infix + "_anggota2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->anggota2->caption(), $diklatpusat_add->anggota2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->widyaiswara->Required) { ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->widyaiswara->caption(), $diklatpusat_add->widyaiswara->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatpusat_add->widyaiswara->errorMessage()) ?>");
			<?php if ($diklatpusat_add->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->statuspel->caption(), $diklatpusat_add->statuspel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->ket->caption(), $diklatpusat_add->ket->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_add->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_add->jenisevaluasi->caption(), $diklatpusat_add->jenisevaluasi->RequiredErrorMessage)) ?>");
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
	fdiklatpusatadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdiklatpusatadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	fdiklatpusatadd.multiPage = new ew.MultiPage("fdiklatpusatadd");

	// Dynamic selection lists
	fdiklatpusatadd.lists["x_kdjudul"] = <?php echo $diklatpusat_add->kdjudul->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_kdjudul"].options = <?php echo JsonEncode($diklatpusat_add->kdjudul->lookupOptions()) ?>;
	fdiklatpusatadd.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatadd.lists["x_dana"] = <?php echo $diklatpusat_add->dana->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_dana"].options = <?php echo JsonEncode($diklatpusat_add->dana->options(FALSE, TRUE)) ?>;
	fdiklatpusatadd.lists["x_ketua"] = <?php echo $diklatpusat_add->ketua->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_ketua"].options = <?php echo JsonEncode($diklatpusat_add->ketua->lookupOptions()) ?>;
	fdiklatpusatadd.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatadd.lists["x_sekretaris"] = <?php echo $diklatpusat_add->sekretaris->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_sekretaris"].options = <?php echo JsonEncode($diklatpusat_add->sekretaris->lookupOptions()) ?>;
	fdiklatpusatadd.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatadd.lists["x_bendahara"] = <?php echo $diklatpusat_add->bendahara->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_bendahara"].options = <?php echo JsonEncode($diklatpusat_add->bendahara->lookupOptions()) ?>;
	fdiklatpusatadd.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatadd.lists["x_anggota2"] = <?php echo $diklatpusat_add->anggota2->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_anggota2"].options = <?php echo JsonEncode($diklatpusat_add->anggota2->lookupOptions()) ?>;
	fdiklatpusatadd.autoSuggests["x_anggota2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatadd.lists["x_widyaiswara"] = <?php echo $diklatpusat_add->widyaiswara->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_widyaiswara"].options = <?php echo JsonEncode($diklatpusat_add->widyaiswara->lookupOptions()) ?>;
	fdiklatpusatadd.autoSuggests["x_widyaiswara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatadd.lists["x_statuspel"] = <?php echo $diklatpusat_add->statuspel->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_statuspel"].options = <?php echo JsonEncode($diklatpusat_add->statuspel->options(FALSE, TRUE)) ?>;
	fdiklatpusatadd.lists["x_jenisevaluasi[]"] = <?php echo $diklatpusat_add->jenisevaluasi->Lookup->toClientList($diklatpusat_add) ?>;
	fdiklatpusatadd.lists["x_jenisevaluasi[]"].options = <?php echo JsonEncode($diklatpusat_add->jenisevaluasi->lookupOptions()) ?>;
	loadjs.done("fdiklatpusatadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $diklatpusat_add->showPageHeader(); ?>
<?php
$diklatpusat_add->showMessage();
?>
<form name="fdiklatpusatadd" id="fdiklatpusatadd" class="<?php echo $diklatpusat_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="diklatpusat">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$diklatpusat_add->IsModal ?>">
<?php if ($diklatpusat->getCurrentMasterTable() == "t_rpdiklat") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rpdiklat">
<input type="hidden" name="fk_rpdid" value="<?php echo HtmlEncode($diklatpusat_add->rid->getSessionValue()) ?>">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($diklatpusat_add->kdjudul->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="diklatpusat_add"><!-- multi-page tabs -->
	<ul class="<?php echo $diklatpusat_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $diklatpusat_add->MultiPages->pageStyle(1) ?>" href="#tab_diklatpusat1" data-toggle="tab"><?php echo $diklatpusat->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $diklatpusat_add->MultiPages->pageStyle(2) ?>" href="#tab_diklatpusat2" data-toggle="tab"><?php echo $diklatpusat->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $diklatpusat_add->MultiPages->pageStyle(1) ?>" id="tab_diklatpusat1"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($diklatpusat_add->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_diklatpusat_kdpelat" for="x_kdpelat" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->kdpelat->caption() ?><?php echo $diklatpusat_add->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->kdpelat->cellAttributes() ?>>
<span id="el_diklatpusat_kdpelat">
<input type="text" data-table="diklatpusat" data-field="x_kdpelat" data-page="1" name="x_kdpelat" id="x_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($diklatpusat_add->kdpelat->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_add->kdpelat->EditValue ?>"<?php echo $diklatpusat_add->kdpelat->editAttributes() ?>>
</span>
<?php echo $diklatpusat_add->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_diklatpusat_kdjudul" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->kdjudul->caption() ?><?php echo $diklatpusat_add->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->kdjudul->cellAttributes() ?>>
<?php if ($diklatpusat_add->kdjudul->getSessionValue() != "") { ?>
<span id="el_diklatpusat_kdjudul">
<span<?php echo $diklatpusat_add->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_add->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdjudul" name="x_kdjudul" value="<?php echo HtmlEncode($diklatpusat_add->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el_diklatpusat_kdjudul">
<?php
$onchange = $diklatpusat_add->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_add->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($diklatpusat_add->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($diklatpusat_add->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_add->kdjudul->getPlaceHolder()) ?>"<?php echo $diklatpusat_add->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" data-page="1" data-value-separator="<?php echo $diklatpusat_add->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($diklatpusat_add->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatadd"], function() {
	fdiklatpusatadd.createAutoSuggest({"id":"x_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_add->kdjudul->Lookup->getParamTag($diklatpusat_add, "p_x_kdjudul") ?>
</span>
<?php } ?>
<?php echo $diklatpusat_add->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_diklatpusat_tawal" for="x_tawal" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->tawal->caption() ?><?php echo $diklatpusat_add->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->tawal->cellAttributes() ?>>
<span id="el_diklatpusat_tawal">
<input type="text" data-table="diklatpusat" data-field="x_tawal" data-page="1" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatpusat_add->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_add->tawal->EditValue ?>"<?php echo $diklatpusat_add->tawal->editAttributes() ?>>
<?php if (!$diklatpusat_add->tawal->ReadOnly && !$diklatpusat_add->tawal->Disabled && !isset($diklatpusat_add->tawal->EditAttrs["readonly"]) && !isset($diklatpusat_add->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatpusatadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatpusatadd", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $diklatpusat_add->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_diklatpusat_takhir" for="x_takhir" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->takhir->caption() ?><?php echo $diklatpusat_add->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->takhir->cellAttributes() ?>>
<span id="el_diklatpusat_takhir">
<input type="text" data-table="diklatpusat" data-field="x_takhir" data-page="1" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatpusat_add->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_add->takhir->EditValue ?>"<?php echo $diklatpusat_add->takhir->editAttributes() ?>>
<?php if (!$diklatpusat_add->takhir->ReadOnly && !$diklatpusat_add->takhir->Disabled && !isset($diklatpusat_add->takhir->EditAttrs["readonly"]) && !isset($diklatpusat_add->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatpusatadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatpusatadd", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $diklatpusat_add->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->dana->Visible) { // dana ?>
	<div id="r_dana" class="form-group row">
		<label id="elh_diklatpusat_dana" for="x_dana" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->dana->caption() ?><?php echo $diklatpusat_add->dana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->dana->cellAttributes() ?>>
<span id="el_diklatpusat_dana">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatpusat" data-field="x_dana" data-page="1" data-value-separator="<?php echo $diklatpusat_add->dana->displayValueSeparatorAttribute() ?>" id="x_dana" name="x_dana"<?php echo $diklatpusat_add->dana->editAttributes() ?>>
			<?php echo $diklatpusat_add->dana->selectOptionListHtml("x_dana") ?>
		</select>
</div>
</span>
<?php echo $diklatpusat_add->dana->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->anggota2->Visible) { // anggota2 ?>
	<div id="r_anggota2" class="form-group row">
		<label id="elh_diklatpusat_anggota2" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->anggota2->caption() ?><?php echo $diklatpusat_add->anggota2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->anggota2->cellAttributes() ?>>
<span id="el_diklatpusat_anggota2">
<?php
$onchange = $diklatpusat_add->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_add->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x_anggota2">
	<input type="text" class="form-control" name="sv_x_anggota2" id="sv_x_anggota2" value="<?php echo RemoveHtml($diklatpusat_add->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_add->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_add->anggota2->getPlaceHolder()) ?>"<?php echo $diklatpusat_add->anggota2->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" data-page="1" data-value-separator="<?php echo $diklatpusat_add->anggota2->displayValueSeparatorAttribute() ?>" name="x_anggota2" id="x_anggota2" value="<?php echo HtmlEncode($diklatpusat_add->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatadd"], function() {
	fdiklatpusatadd.createAutoSuggest({"id":"x_anggota2","forceSelect":true});
});
</script>
<?php echo $diklatpusat_add->anggota2->Lookup->getParamTag($diklatpusat_add, "p_x_anggota2") ?>
</span>
<?php echo $diklatpusat_add->anggota2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->widyaiswara->Visible) { // widyaiswara ?>
	<div id="r_widyaiswara" class="form-group row">
		<label id="elh_diklatpusat_widyaiswara" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->widyaiswara->caption() ?><?php echo $diklatpusat_add->widyaiswara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->widyaiswara->cellAttributes() ?>>
<span id="el_diklatpusat_widyaiswara">
<?php
$onchange = $diklatpusat_add->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_add->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x_widyaiswara">
	<input type="text" class="form-control" name="sv_x_widyaiswara" id="sv_x_widyaiswara" value="<?php echo RemoveHtml($diklatpusat_add->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_add->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_add->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatpusat_add->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" data-page="1" data-value-separator="<?php echo $diklatpusat_add->widyaiswara->displayValueSeparatorAttribute() ?>" name="x_widyaiswara" id="x_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_add->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatadd"], function() {
	fdiklatpusatadd.createAutoSuggest({"id":"x_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatpusat_add->widyaiswara->Lookup->getParamTag($diklatpusat_add, "p_x_widyaiswara") ?>
</span>
<?php echo $diklatpusat_add->widyaiswara->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label id="elh_diklatpusat_statuspel" for="x_statuspel" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->statuspel->caption() ?><?php echo $diklatpusat_add->statuspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->statuspel->cellAttributes() ?>>
<span id="el_diklatpusat_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatpusat" data-field="x_statuspel" data-page="1" data-value-separator="<?php echo $diklatpusat_add->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $diklatpusat_add->statuspel->editAttributes() ?>>
			<?php echo $diklatpusat_add->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
<?php echo $diklatpusat_add->statuspel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_diklatpusat_ket" for="x_ket" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->ket->caption() ?><?php echo $diklatpusat_add->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->ket->cellAttributes() ?>>
<span id="el_diklatpusat_ket">
<textarea data-table="diklatpusat" data-field="x_ket" data-page="1" name="x_ket" id="x_ket" cols="15" rows="2" placeholder="<?php echo HtmlEncode($diklatpusat_add->ket->getPlaceHolder()) ?>"<?php echo $diklatpusat_add->ket->editAttributes() ?>><?php echo $diklatpusat_add->ket->EditValue ?></textarea>
</span>
<?php echo $diklatpusat_add->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<div id="r_jenisevaluasi" class="form-group row">
		<label id="elh_diklatpusat_jenisevaluasi" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->jenisevaluasi->caption() ?><?php echo $diklatpusat_add->jenisevaluasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->jenisevaluasi->cellAttributes() ?>>
<span id="el_diklatpusat_jenisevaluasi">
<div id="tp_x_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatpusat" data-field="x_jenisevaluasi" data-page="1" data-value-separator="<?php echo $diklatpusat_add->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x_jenisevaluasi[]" id="x_jenisevaluasi[]" value="{value}"<?php echo $diklatpusat_add->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatpusat_add->jenisevaluasi->checkBoxListHtml(FALSE, "x_jenisevaluasi[]", 1) ?>
</div></div>
<?php echo $diklatpusat_add->jenisevaluasi->Lookup->getParamTag($diklatpusat_add, "p_x_jenisevaluasi") ?>
</span>
<?php echo $diklatpusat_add->jenisevaluasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $diklatpusat_add->MultiPages->pageStyle(2) ?>" id="tab_diklatpusat2"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($diklatpusat_add->ketua->Visible) { // ketua ?>
	<div id="r_ketua" class="form-group row">
		<label id="elh_diklatpusat_ketua" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->ketua->caption() ?><?php echo $diklatpusat_add->ketua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->ketua->cellAttributes() ?>>
<span id="el_diklatpusat_ketua">
<?php
$onchange = $diklatpusat_add->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_add->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x_ketua">
	<input type="text" class="form-control" name="sv_x_ketua" id="sv_x_ketua" value="<?php echo RemoveHtml($diklatpusat_add->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_add->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_add->ketua->getPlaceHolder()) ?>"<?php echo $diklatpusat_add->ketua->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" data-page="2" data-value-separator="<?php echo $diklatpusat_add->ketua->displayValueSeparatorAttribute() ?>" name="x_ketua" id="x_ketua" value="<?php echo HtmlEncode($diklatpusat_add->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatadd"], function() {
	fdiklatpusatadd.createAutoSuggest({"id":"x_ketua","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_add->ketua->Lookup->getParamTag($diklatpusat_add, "p_x_ketua") ?>
</span>
<?php echo $diklatpusat_add->ketua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->sekretaris->Visible) { // sekretaris ?>
	<div id="r_sekretaris" class="form-group row">
		<label id="elh_diklatpusat_sekretaris" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->sekretaris->caption() ?><?php echo $diklatpusat_add->sekretaris->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->sekretaris->cellAttributes() ?>>
<span id="el_diklatpusat_sekretaris">
<?php
$onchange = $diklatpusat_add->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_add->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x_sekretaris">
	<input type="text" class="form-control" name="sv_x_sekretaris" id="sv_x_sekretaris" value="<?php echo RemoveHtml($diklatpusat_add->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_add->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_add->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatpusat_add->sekretaris->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" data-page="2" data-value-separator="<?php echo $diklatpusat_add->sekretaris->displayValueSeparatorAttribute() ?>" name="x_sekretaris" id="x_sekretaris" value="<?php echo HtmlEncode($diklatpusat_add->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatadd"], function() {
	fdiklatpusatadd.createAutoSuggest({"id":"x_sekretaris","forceSelect":true,"minWidth":"505px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_add->sekretaris->Lookup->getParamTag($diklatpusat_add, "p_x_sekretaris") ?>
</span>
<?php echo $diklatpusat_add->sekretaris->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatpusat_add->bendahara->Visible) { // bendahara ?>
	<div id="r_bendahara" class="form-group row">
		<label id="elh_diklatpusat_bendahara" class="<?php echo $diklatpusat_add->LeftColumnClass ?>"><?php echo $diklatpusat_add->bendahara->caption() ?><?php echo $diklatpusat_add->bendahara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatpusat_add->RightColumnClass ?>"><div <?php echo $diklatpusat_add->bendahara->cellAttributes() ?>>
<span id="el_diklatpusat_bendahara">
<?php
$onchange = $diklatpusat_add->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_add->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x_bendahara">
	<input type="text" class="form-control" name="sv_x_bendahara" id="sv_x_bendahara" value="<?php echo RemoveHtml($diklatpusat_add->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_add->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_add->bendahara->getPlaceHolder()) ?>"<?php echo $diklatpusat_add->bendahara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" data-page="2" data-value-separator="<?php echo $diklatpusat_add->bendahara->displayValueSeparatorAttribute() ?>" name="x_bendahara" id="x_bendahara" value="<?php echo HtmlEncode($diklatpusat_add->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatadd"], function() {
	fdiklatpusatadd.createAutoSuggest({"id":"x_bendahara","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_add->bendahara->Lookup->getParamTag($diklatpusat_add, "p_x_bendahara") ?>
</span>
<?php echo $diklatpusat_add->bendahara->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
	<?php if (strval($diklatpusat_add->rid->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_rid" id="x_rid" value="<?php echo HtmlEncode(strval($diklatpusat_add->rid->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$diklatpusat_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $diklatpusat_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $diklatpusat_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$diklatpusat_add->showPageFooter();
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
$diklatpusat_add->terminate();
?>