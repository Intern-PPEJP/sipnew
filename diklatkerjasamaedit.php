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
$diklatkerjasama_edit = new diklatkerjasama_edit();

// Run the page
$diklatkerjasama_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatkerjasama_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdiklatkerjasamaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdiklatkerjasamaedit = currentForm = new ew.Form("fdiklatkerjasamaedit", "edit");

	// Validate form
	fdiklatkerjasamaedit.validate = function() {
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
			<?php if ($diklatkerjasama_edit->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->idpelat->caption(), $diklatkerjasama_edit->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->kdpelat->caption(), $diklatkerjasama_edit->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->kdjudul->caption(), $diklatkerjasama_edit->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->kdkursil->caption(), $diklatkerjasama_edit->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->tawal->caption(), $diklatkerjasama_edit->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_edit->tawal->errorMessage()) ?>");
			<?php if ($diklatkerjasama_edit->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->takhir->caption(), $diklatkerjasama_edit->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_edit->takhir->errorMessage()) ?>");
			<?php if ($diklatkerjasama_edit->jml_hari->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->jml_hari->caption(), $diklatkerjasama_edit->jml_hari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_edit->jml_hari->errorMessage()) ?>");
			<?php if ($diklatkerjasama_edit->targetpes->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->targetpes->caption(), $diklatkerjasama_edit->targetpes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_edit->targetpes->errorMessage()) ?>");
			<?php if ($diklatkerjasama_edit->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->ketua->caption(), $diklatkerjasama_edit->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->sekretaris->caption(), $diklatkerjasama_edit->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->bendahara->caption(), $diklatkerjasama_edit->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->anggota2->Required) { ?>
				elm = this.getElements("x" + infix + "_anggota2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->anggota2->caption(), $diklatkerjasama_edit->anggota2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->widyaiswara->Required) { ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->widyaiswara->caption(), $diklatkerjasama_edit->widyaiswara->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_edit->widyaiswara->errorMessage()) ?>");
			<?php if ($diklatkerjasama_edit->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->kdprop->caption(), $diklatkerjasama_edit->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->kdkota->caption(), $diklatkerjasama_edit->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->tempat->caption(), $diklatkerjasama_edit->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->biaya->Required) { ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->biaya->caption(), $diklatkerjasama_edit->biaya->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_edit->biaya->errorMessage()) ?>");
			<?php if ($diklatkerjasama_edit->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->statuspel->caption(), $diklatkerjasama_edit->statuspel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_edit->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_edit->jenisevaluasi->caption(), $diklatkerjasama_edit->jenisevaluasi->RequiredErrorMessage)) ?>");
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
	fdiklatkerjasamaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdiklatkerjasamaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	fdiklatkerjasamaedit.multiPage = new ew.MultiPage("fdiklatkerjasamaedit");

	// Dynamic selection lists
	fdiklatkerjasamaedit.lists["x_kdjudul"] = <?php echo $diklatkerjasama_edit->kdjudul->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_kdjudul"].options = <?php echo JsonEncode($diklatkerjasama_edit->kdjudul->lookupOptions()) ?>;
	fdiklatkerjasamaedit.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaedit.lists["x_kdkursil"] = <?php echo $diklatkerjasama_edit->kdkursil->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_kdkursil"].options = <?php echo JsonEncode($diklatkerjasama_edit->kdkursil->lookupOptions()) ?>;
	fdiklatkerjasamaedit.lists["x_ketua"] = <?php echo $diklatkerjasama_edit->ketua->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_ketua"].options = <?php echo JsonEncode($diklatkerjasama_edit->ketua->lookupOptions()) ?>;
	fdiklatkerjasamaedit.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaedit.lists["x_sekretaris"] = <?php echo $diklatkerjasama_edit->sekretaris->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_sekretaris"].options = <?php echo JsonEncode($diklatkerjasama_edit->sekretaris->lookupOptions()) ?>;
	fdiklatkerjasamaedit.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaedit.lists["x_bendahara"] = <?php echo $diklatkerjasama_edit->bendahara->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_bendahara"].options = <?php echo JsonEncode($diklatkerjasama_edit->bendahara->lookupOptions()) ?>;
	fdiklatkerjasamaedit.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaedit.lists["x_anggota2"] = <?php echo $diklatkerjasama_edit->anggota2->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_anggota2"].options = <?php echo JsonEncode($diklatkerjasama_edit->anggota2->lookupOptions()) ?>;
	fdiklatkerjasamaedit.autoSuggests["x_anggota2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaedit.lists["x_widyaiswara"] = <?php echo $diklatkerjasama_edit->widyaiswara->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_widyaiswara"].options = <?php echo JsonEncode($diklatkerjasama_edit->widyaiswara->lookupOptions()) ?>;
	fdiklatkerjasamaedit.autoSuggests["x_widyaiswara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaedit.lists["x_kdprop"] = <?php echo $diklatkerjasama_edit->kdprop->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_kdprop"].options = <?php echo JsonEncode($diklatkerjasama_edit->kdprop->lookupOptions()) ?>;
	fdiklatkerjasamaedit.lists["x_kdkota"] = <?php echo $diklatkerjasama_edit->kdkota->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_kdkota"].options = <?php echo JsonEncode($diklatkerjasama_edit->kdkota->lookupOptions()) ?>;
	fdiklatkerjasamaedit.lists["x_statuspel"] = <?php echo $diklatkerjasama_edit->statuspel->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_statuspel"].options = <?php echo JsonEncode($diklatkerjasama_edit->statuspel->options(FALSE, TRUE)) ?>;
	fdiklatkerjasamaedit.lists["x_jenisevaluasi[]"] = <?php echo $diklatkerjasama_edit->jenisevaluasi->Lookup->toClientList($diklatkerjasama_edit) ?>;
	fdiklatkerjasamaedit.lists["x_jenisevaluasi[]"].options = <?php echo JsonEncode($diklatkerjasama_edit->jenisevaluasi->lookupOptions()) ?>;
	loadjs.done("fdiklatkerjasamaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $diklatkerjasama_edit->showPageHeader(); ?>
<?php
$diklatkerjasama_edit->showMessage();
?>
<form name="fdiklatkerjasamaedit" id="fdiklatkerjasamaedit" class="<?php echo $diklatkerjasama_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="diklatkerjasama">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$diklatkerjasama_edit->IsModal ?>">
<?php if ($diklatkerjasama->getCurrentMasterTable() == "t_rpkerjasama") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rpkerjasama">
<input type="hidden" name="fk_rpkid" value="<?php echo HtmlEncode($diklatkerjasama_edit->rid->getSessionValue()) ?>">
<input type="hidden" name="fk_jenispel" value="<?php echo HtmlEncode($diklatkerjasama_edit->jenispel->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="diklatkerjasama_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $diklatkerjasama_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $diklatkerjasama_edit->MultiPages->pageStyle(1) ?>" href="#tab_diklatkerjasama1" data-toggle="tab"><?php echo $diklatkerjasama->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $diklatkerjasama_edit->MultiPages->pageStyle(2) ?>" href="#tab_diklatkerjasama2" data-toggle="tab"><?php echo $diklatkerjasama->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $diklatkerjasama_edit->MultiPages->pageStyle(1) ?>" id="tab_diklatkerjasama1"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($diklatkerjasama_edit->idpelat->Visible) { // idpelat ?>
	<div id="r_idpelat" class="form-group row">
		<label id="elh_diklatkerjasama_idpelat" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->idpelat->caption() ?><?php echo $diklatkerjasama_edit->idpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->idpelat->cellAttributes() ?>>
<span id="el_diklatkerjasama_idpelat">
<span<?php echo $diklatkerjasama_edit->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_edit->idpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_idpelat" data-page="1" name="x_idpelat" id="x_idpelat" value="<?php echo HtmlEncode($diklatkerjasama_edit->idpelat->CurrentValue) ?>">
<?php echo $diklatkerjasama_edit->idpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_diklatkerjasama_kdpelat" for="x_kdpelat" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->kdpelat->caption() ?><?php echo $diklatkerjasama_edit->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->kdpelat->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdpelat">
<span<?php echo $diklatkerjasama_edit->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_edit->kdpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdpelat" data-page="1" name="x_kdpelat" id="x_kdpelat" value="<?php echo HtmlEncode($diklatkerjasama_edit->kdpelat->CurrentValue) ?>">
<?php echo $diklatkerjasama_edit->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_diklatkerjasama_kdjudul" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->kdjudul->caption() ?><?php echo $diklatkerjasama_edit->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->kdjudul->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdjudul">
<?php
$onchange = $diklatkerjasama_edit->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_edit->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($diklatkerjasama_edit->kdjudul->EditValue) ?>" size="25" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->kdjudul->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_edit->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" data-page="1" data-value-separator="<?php echo $diklatkerjasama_edit->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_edit->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaedit"], function() {
	fdiklatkerjasamaedit.createAutoSuggest({"id":"x_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_edit->kdjudul->Lookup->getParamTag($diklatkerjasama_edit, "p_x_kdjudul") ?>
</span>
<?php echo $diklatkerjasama_edit->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_diklatkerjasama_kdkursil" for="x_kdkursil" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->kdkursil->caption() ?><?php echo $diklatkerjasama_edit->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->kdkursil->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdkursil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkursil" data-page="1" data-value-separator="<?php echo $diklatkerjasama_edit->kdkursil->displayValueSeparatorAttribute() ?>" id="x_kdkursil" name="x_kdkursil"<?php echo $diklatkerjasama_edit->kdkursil->editAttributes() ?>>
			<?php echo $diklatkerjasama_edit->kdkursil->selectOptionListHtml("x_kdkursil") ?>
		</select>
</div>
<?php echo $diklatkerjasama_edit->kdkursil->Lookup->getParamTag($diklatkerjasama_edit, "p_x_kdkursil") ?>
</span>
<?php echo $diklatkerjasama_edit->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_diklatkerjasama_tawal" for="x_tawal" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->tawal->caption() ?><?php echo $diklatkerjasama_edit->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->tawal->cellAttributes() ?>>
<span id="el_diklatkerjasama_tawal">
<input type="text" data-table="diklatkerjasama" data-field="x_tawal" data-page="1" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_edit->tawal->EditValue ?>"<?php echo $diklatkerjasama_edit->tawal->editAttributes() ?>>
<?php if (!$diklatkerjasama_edit->tawal->ReadOnly && !$diklatkerjasama_edit->tawal->Disabled && !isset($diklatkerjasama_edit->tawal->EditAttrs["readonly"]) && !isset($diklatkerjasama_edit->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamaedit", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $diklatkerjasama_edit->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_diklatkerjasama_takhir" for="x_takhir" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->takhir->caption() ?><?php echo $diklatkerjasama_edit->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->takhir->cellAttributes() ?>>
<span id="el_diklatkerjasama_takhir">
<input type="text" data-table="diklatkerjasama" data-field="x_takhir" data-page="1" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_edit->takhir->EditValue ?>"<?php echo $diklatkerjasama_edit->takhir->editAttributes() ?>>
<?php if (!$diklatkerjasama_edit->takhir->ReadOnly && !$diklatkerjasama_edit->takhir->Disabled && !isset($diklatkerjasama_edit->takhir->EditAttrs["readonly"]) && !isset($diklatkerjasama_edit->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamaedit", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $diklatkerjasama_edit->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->jml_hari->Visible) { // jml_hari ?>
	<div id="r_jml_hari" class="form-group row">
		<label id="elh_diklatkerjasama_jml_hari" for="x_jml_hari" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->jml_hari->caption() ?><?php echo $diklatkerjasama_edit->jml_hari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->jml_hari->cellAttributes() ?>>
<span id="el_diklatkerjasama_jml_hari">
<input type="text" data-table="diklatkerjasama" data-field="x_jml_hari" data-page="1" name="x_jml_hari" id="x_jml_hari" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->jml_hari->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_edit->jml_hari->EditValue ?>"<?php echo $diklatkerjasama_edit->jml_hari->editAttributes() ?>>
</span>
<?php echo $diklatkerjasama_edit->jml_hari->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->targetpes->Visible) { // targetpes ?>
	<div id="r_targetpes" class="form-group row">
		<label id="elh_diklatkerjasama_targetpes" for="x_targetpes" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->targetpes->caption() ?><?php echo $diklatkerjasama_edit->targetpes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->targetpes->cellAttributes() ?>>
<span id="el_diklatkerjasama_targetpes">
<input type="text" data-table="diklatkerjasama" data-field="x_targetpes" data-page="1" name="x_targetpes" id="x_targetpes" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->targetpes->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_edit->targetpes->EditValue ?>"<?php echo $diklatkerjasama_edit->targetpes->editAttributes() ?>>
</span>
<?php echo $diklatkerjasama_edit->targetpes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_diklatkerjasama_kdprop" for="x_kdprop" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->kdprop->caption() ?><?php echo $diklatkerjasama_edit->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->kdprop->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdprop">
<?php $diklatkerjasama_edit->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdprop" data-page="1" data-value-separator="<?php echo $diklatkerjasama_edit->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $diklatkerjasama_edit->kdprop->editAttributes() ?>>
			<?php echo $diklatkerjasama_edit->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $diklatkerjasama_edit->kdprop->Lookup->getParamTag($diklatkerjasama_edit, "p_x_kdprop") ?>
</span>
<?php echo $diklatkerjasama_edit->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label id="elh_diklatkerjasama_kdkota" for="x_kdkota" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->kdkota->caption() ?><?php echo $diklatkerjasama_edit->kdkota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->kdkota->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdkota">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkota" data-page="1" data-value-separator="<?php echo $diklatkerjasama_edit->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $diklatkerjasama_edit->kdkota->editAttributes() ?>>
			<?php echo $diklatkerjasama_edit->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $diklatkerjasama_edit->kdkota->Lookup->getParamTag($diklatkerjasama_edit, "p_x_kdkota") ?>
</span>
<?php echo $diklatkerjasama_edit->kdkota->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_diklatkerjasama_tempat" for="x_tempat" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->tempat->caption() ?><?php echo $diklatkerjasama_edit->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->tempat->cellAttributes() ?>>
<span id="el_diklatkerjasama_tempat">
<input type="text" data-table="diklatkerjasama" data-field="x_tempat" data-page="1" name="x_tempat" id="x_tempat" size="40" maxlength="255" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->tempat->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_edit->tempat->EditValue ?>"<?php echo $diklatkerjasama_edit->tempat->editAttributes() ?>>
</span>
<?php echo $diklatkerjasama_edit->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->biaya->Visible) { // biaya ?>
	<div id="r_biaya" class="form-group row">
		<label id="elh_diklatkerjasama_biaya" for="x_biaya" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->biaya->caption() ?><?php echo $diklatkerjasama_edit->biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->biaya->cellAttributes() ?>>
<span id="el_diklatkerjasama_biaya">
<input type="text" data-table="diklatkerjasama" data-field="x_biaya" data-page="1" name="x_biaya" id="x_biaya" size="15" maxlength="17" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->biaya->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_edit->biaya->EditValue ?>"<?php echo $diklatkerjasama_edit->biaya->editAttributes() ?>>
</span>
<?php echo $diklatkerjasama_edit->biaya->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label id="elh_diklatkerjasama_statuspel" for="x_statuspel" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->statuspel->caption() ?><?php echo $diklatkerjasama_edit->statuspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->statuspel->cellAttributes() ?>>
<span id="el_diklatkerjasama_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_statuspel" data-page="1" data-value-separator="<?php echo $diklatkerjasama_edit->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $diklatkerjasama_edit->statuspel->editAttributes() ?>>
			<?php echo $diklatkerjasama_edit->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
<?php echo $diklatkerjasama_edit->statuspel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<div id="r_jenisevaluasi" class="form-group row">
		<label id="elh_diklatkerjasama_jenisevaluasi" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->jenisevaluasi->caption() ?><?php echo $diklatkerjasama_edit->jenisevaluasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->jenisevaluasi->cellAttributes() ?>>
<span id="el_diklatkerjasama_jenisevaluasi">
<div id="tp_x_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatkerjasama" data-field="x_jenisevaluasi" data-page="1" data-value-separator="<?php echo $diklatkerjasama_edit->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x_jenisevaluasi[]" id="x_jenisevaluasi[]" value="{value}"<?php echo $diklatkerjasama_edit->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatkerjasama_edit->jenisevaluasi->checkBoxListHtml(FALSE, "x_jenisevaluasi[]", 1) ?>
</div></div>
<?php echo $diklatkerjasama_edit->jenisevaluasi->Lookup->getParamTag($diklatkerjasama_edit, "p_x_jenisevaluasi") ?>
</span>
<?php echo $diklatkerjasama_edit->jenisevaluasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $diklatkerjasama_edit->MultiPages->pageStyle(2) ?>" id="tab_diklatkerjasama2"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($diklatkerjasama_edit->ketua->Visible) { // ketua ?>
	<div id="r_ketua" class="form-group row">
		<label id="elh_diklatkerjasama_ketua" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->ketua->caption() ?><?php echo $diklatkerjasama_edit->ketua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->ketua->cellAttributes() ?>>
<span id="el_diklatkerjasama_ketua">
<?php
$onchange = $diklatkerjasama_edit->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_edit->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ketua" id="sv_x_ketua" value="<?php echo RemoveHtml($diklatkerjasama_edit->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->ketua->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_edit->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_edit->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_edit->ketua->ReadOnly || $diklatkerjasama_edit->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" data-page="2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_edit->ketua->displayValueSeparatorAttribute() ?>" name="x_ketua" id="x_ketua" value="<?php echo HtmlEncode($diklatkerjasama_edit->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaedit"], function() {
	fdiklatkerjasamaedit.createAutoSuggest({"id":"x_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_edit->ketua->Lookup->getParamTag($diklatkerjasama_edit, "p_x_ketua") ?>
</span>
<?php echo $diklatkerjasama_edit->ketua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->sekretaris->Visible) { // sekretaris ?>
	<div id="r_sekretaris" class="form-group row">
		<label id="elh_diklatkerjasama_sekretaris" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->sekretaris->caption() ?><?php echo $diklatkerjasama_edit->sekretaris->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->sekretaris->cellAttributes() ?>>
<span id="el_diklatkerjasama_sekretaris">
<?php
$onchange = $diklatkerjasama_edit->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_edit->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_sekretaris" id="sv_x_sekretaris" value="<?php echo RemoveHtml($diklatkerjasama_edit->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_edit->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_edit->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_edit->sekretaris->ReadOnly || $diklatkerjasama_edit->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" data-page="2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_edit->sekretaris->displayValueSeparatorAttribute() ?>" name="x_sekretaris" id="x_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_edit->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaedit"], function() {
	fdiklatkerjasamaedit.createAutoSuggest({"id":"x_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_edit->sekretaris->Lookup->getParamTag($diklatkerjasama_edit, "p_x_sekretaris") ?>
</span>
<?php echo $diklatkerjasama_edit->sekretaris->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->bendahara->Visible) { // bendahara ?>
	<div id="r_bendahara" class="form-group row">
		<label id="elh_diklatkerjasama_bendahara" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->bendahara->caption() ?><?php echo $diklatkerjasama_edit->bendahara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->bendahara->cellAttributes() ?>>
<span id="el_diklatkerjasama_bendahara">
<?php
$onchange = $diklatkerjasama_edit->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_edit->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_bendahara" id="sv_x_bendahara" value="<?php echo RemoveHtml($diklatkerjasama_edit->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->bendahara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_edit->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_edit->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_edit->bendahara->ReadOnly || $diklatkerjasama_edit->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" data-page="2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_edit->bendahara->displayValueSeparatorAttribute() ?>" name="x_bendahara" id="x_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_edit->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaedit"], function() {
	fdiklatkerjasamaedit.createAutoSuggest({"id":"x_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_edit->bendahara->Lookup->getParamTag($diklatkerjasama_edit, "p_x_bendahara") ?>
</span>
<?php echo $diklatkerjasama_edit->bendahara->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->anggota2->Visible) { // anggota2 ?>
	<div id="r_anggota2" class="form-group row">
		<label id="elh_diklatkerjasama_anggota2" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->anggota2->caption() ?><?php echo $diklatkerjasama_edit->anggota2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->anggota2->cellAttributes() ?>>
<span id="el_diklatkerjasama_anggota2">
<?php
$onchange = $diklatkerjasama_edit->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_edit->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x_anggota2">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_anggota2" id="sv_x_anggota2" value="<?php echo RemoveHtml($diklatkerjasama_edit->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->anggota2->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_edit->anggota2->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_edit->anggota2->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_anggota2',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_edit->anggota2->ReadOnly || $diklatkerjasama_edit->anggota2->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" data-page="2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_edit->anggota2->displayValueSeparatorAttribute() ?>" name="x_anggota2" id="x_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_edit->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaedit"], function() {
	fdiklatkerjasamaedit.createAutoSuggest({"id":"x_anggota2","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_edit->anggota2->Lookup->getParamTag($diklatkerjasama_edit, "p_x_anggota2") ?>
</span>
<?php echo $diklatkerjasama_edit->anggota2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_edit->widyaiswara->Visible) { // widyaiswara ?>
	<div id="r_widyaiswara" class="form-group row">
		<label id="elh_diklatkerjasama_widyaiswara" class="<?php echo $diklatkerjasama_edit->LeftColumnClass ?>"><?php echo $diklatkerjasama_edit->widyaiswara->caption() ?><?php echo $diklatkerjasama_edit->widyaiswara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_edit->RightColumnClass ?>"><div <?php echo $diklatkerjasama_edit->widyaiswara->cellAttributes() ?>>
<span id="el_diklatkerjasama_widyaiswara">
<?php
$onchange = $diklatkerjasama_edit->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_edit->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x_widyaiswara">
	<input type="text" class="form-control" name="sv_x_widyaiswara" id="sv_x_widyaiswara" value="<?php echo RemoveHtml($diklatkerjasama_edit->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_edit->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_edit->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" data-page="2" data-value-separator="<?php echo $diklatkerjasama_edit->widyaiswara->displayValueSeparatorAttribute() ?>" name="x_widyaiswara" id="x_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_edit->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaedit"], function() {
	fdiklatkerjasamaedit.createAutoSuggest({"id":"x_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatkerjasama_edit->widyaiswara->Lookup->getParamTag($diklatkerjasama_edit, "p_x_widyaiswara") ?>
</span>
<?php echo $diklatkerjasama_edit->widyaiswara->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$diklatkerjasama_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $diklatkerjasama_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $diklatkerjasama_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$diklatkerjasama_edit->showPageFooter();
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
$diklatkerjasama_edit->terminate();
?>