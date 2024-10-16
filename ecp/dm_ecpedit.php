<?php
namespace PHPMaker2020\input_ecp;

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
$dm_ecp_edit = new dm_ecp_edit();

// Run the page
$dm_ecp_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_ecp_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdm_ecpedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdm_ecpedit = currentForm = new ew.Form("fdm_ecpedit", "edit");

	// Validate form
	fdm_ecpedit.validate = function() {
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
			<?php if ($dm_ecp_edit->ID_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->ID_ECP->caption(), $dm_ecp_edit->ID_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Nama->caption(), $dm_ecp_edit->Nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Perusahaan->caption(), $dm_ecp_edit->Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Daerah->Required) { ?>
				elm = this.getElements("x" + infix + "_Daerah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Daerah->caption(), $dm_ecp_edit->Daerah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Produk->caption(), $dm_ecp_edit->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Tgl_Bln_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tgl_Bln_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Tgl_Bln_Ekspor->caption(), $dm_ecp_edit->Tgl_Bln_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Negara_Tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_Negara_Tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Negara_Tujuan->caption(), $dm_ecp_edit->Negara_Tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Nilai_Ekspor_USD->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Nilai_Ekspor_USD->caption(), $dm_ecp_edit->Nilai_Ekspor_USD->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_edit->Nilai_Ekspor_USD->errorMessage()) ?>");
			<?php if ($dm_ecp_edit->Nilai_Ekspor_Rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Nilai_Ekspor_Rupiah->caption(), $dm_ecp_edit->Nilai_Ekspor_Rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_edit->Nilai_Ekspor_Rupiah->errorMessage()) ?>");
			<?php if ($dm_ecp_edit->Keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_Keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Keterangan->caption(), $dm_ecp_edit->Keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Wilayah_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Wilayah_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Wilayah_ECP->caption(), $dm_ecp_edit->Wilayah_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_edit->Tahun_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_edit->Tahun_ECP->caption(), $dm_ecp_edit->Tahun_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_edit->Tahun_ECP->errorMessage()) ?>");

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
	fdm_ecpedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdm_ecpedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdm_ecpedit.lists["x_Nama"] = <?php echo $dm_ecp_edit->Nama->Lookup->toClientList($dm_ecp_edit) ?>;
	fdm_ecpedit.lists["x_Nama"].options = <?php echo JsonEncode($dm_ecp_edit->Nama->lookupOptions()) ?>;
	fdm_ecpedit.autoSuggests["x_Nama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdm_ecpedit.lists["x_Perusahaan"] = <?php echo $dm_ecp_edit->Perusahaan->Lookup->toClientList($dm_ecp_edit) ?>;
	fdm_ecpedit.lists["x_Perusahaan"].options = <?php echo JsonEncode($dm_ecp_edit->Perusahaan->lookupOptions()) ?>;
	fdm_ecpedit.autoSuggests["x_Perusahaan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdm_ecpedit.lists["x_Wilayah_ECP"] = <?php echo $dm_ecp_edit->Wilayah_ECP->Lookup->toClientList($dm_ecp_edit) ?>;
	fdm_ecpedit.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($dm_ecp_edit->Wilayah_ECP->lookupOptions()) ?>;
	loadjs.done("fdm_ecpedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dm_ecp_edit->showPageHeader(); ?>
<?php
$dm_ecp_edit->showMessage();
?>
<form name="fdm_ecpedit" id="fdm_ecpedit" class="<?php echo $dm_ecp_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_ecp">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$dm_ecp_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($dm_ecp_edit->ID_ECP->Visible) { // ID_ECP ?>
	<div id="r_ID_ECP" class="form-group row">
		<label id="elh_dm_ecp_ID_ECP" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->ID_ECP->caption() ?><?php echo $dm_ecp_edit->ID_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->ID_ECP->cellAttributes() ?>>
<span id="el_dm_ecp_ID_ECP">
<span<?php echo $dm_ecp_edit->ID_ECP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dm_ecp_edit->ID_ECP->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_ID_ECP" name="x_ID_ECP" id="x_ID_ECP" value="<?php echo HtmlEncode($dm_ecp_edit->ID_ECP->CurrentValue) ?>">
<?php echo $dm_ecp_edit->ID_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group row">
		<label id="elh_dm_ecp_Nama" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Nama->caption() ?><?php echo $dm_ecp_edit->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Nama->cellAttributes() ?>>
<span id="el_dm_ecp_Nama">
<?php
$onchange = $dm_ecp_edit->Nama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_edit->Nama->EditAttrs["onchange"] = "";
?>
<span id="as_x_Nama">
	<input type="text" class="form-control" name="sv_x_Nama" id="sv_x_Nama" value="<?php echo RemoveHtml($dm_ecp_edit->Nama->EditValue) ?>" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Nama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_edit->Nama->getPlaceHolder()) ?>"<?php echo $dm_ecp_edit->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nama" data-value-separator="<?php echo $dm_ecp_edit->Nama->displayValueSeparatorAttribute() ?>" name="x_Nama" id="x_Nama" value="<?php echo HtmlEncode($dm_ecp_edit->Nama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecpedit"], function() {
	fdm_ecpedit.createAutoSuggest({"id":"x_Nama","forceSelect":false});
});
</script>
<?php echo $dm_ecp_edit->Nama->Lookup->getParamTag($dm_ecp_edit, "p_x_Nama") ?>
</span>
<?php echo $dm_ecp_edit->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Perusahaan->Visible) { // Perusahaan ?>
	<div id="r_Perusahaan" class="form-group row">
		<label id="elh_dm_ecp_Perusahaan" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Perusahaan->caption() ?><?php echo $dm_ecp_edit->Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Perusahaan->cellAttributes() ?>>
<span id="el_dm_ecp_Perusahaan">
<?php
$onchange = $dm_ecp_edit->Perusahaan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_edit->Perusahaan->EditAttrs["onchange"] = "";
?>
<span id="as_x_Perusahaan">
	<input type="text" class="form-control" name="sv_x_Perusahaan" id="sv_x_Perusahaan" value="<?php echo RemoveHtml($dm_ecp_edit->Perusahaan->EditValue) ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Perusahaan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_edit->Perusahaan->getPlaceHolder()) ?>"<?php echo $dm_ecp_edit->Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Perusahaan" data-value-separator="<?php echo $dm_ecp_edit->Perusahaan->displayValueSeparatorAttribute() ?>" name="x_Perusahaan" id="x_Perusahaan" value="<?php echo HtmlEncode($dm_ecp_edit->Perusahaan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecpedit"], function() {
	fdm_ecpedit.createAutoSuggest({"id":"x_Perusahaan","forceSelect":false});
});
</script>
<?php echo $dm_ecp_edit->Perusahaan->Lookup->getParamTag($dm_ecp_edit, "p_x_Perusahaan") ?>
</span>
<?php echo $dm_ecp_edit->Perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Daerah->Visible) { // Daerah ?>
	<div id="r_Daerah" class="form-group row">
		<label id="elh_dm_ecp_Daerah" for="x_Daerah" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Daerah->caption() ?><?php echo $dm_ecp_edit->Daerah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Daerah->cellAttributes() ?>>
<span id="el_dm_ecp_Daerah">
<input type="text" data-table="dm_ecp" data-field="x_Daerah" name="x_Daerah" id="x_Daerah" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Daerah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_edit->Daerah->EditValue ?>"<?php echo $dm_ecp_edit->Daerah->editAttributes() ?>>
</span>
<?php echo $dm_ecp_edit->Daerah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Produk->Visible) { // Produk ?>
	<div id="r_Produk" class="form-group row">
		<label id="elh_dm_ecp_Produk" for="x_Produk" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Produk->caption() ?><?php echo $dm_ecp_edit->Produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Produk->cellAttributes() ?>>
<span id="el_dm_ecp_Produk">
<input type="text" data-table="dm_ecp" data-field="x_Produk" name="x_Produk" id="x_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_edit->Produk->EditValue ?>"<?php echo $dm_ecp_edit->Produk->editAttributes() ?>>
</span>
<?php echo $dm_ecp_edit->Produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<div id="r_Tgl_Bln_Ekspor" class="form-group row">
		<label id="elh_dm_ecp_Tgl_Bln_Ekspor" for="x_Tgl_Bln_Ekspor" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Tgl_Bln_Ekspor->caption() ?><?php echo $dm_ecp_edit->Tgl_Bln_Ekspor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el_dm_ecp_Tgl_Bln_Ekspor">
<input type="text" data-table="dm_ecp" data-field="x_Tgl_Bln_Ekspor" name="x_Tgl_Bln_Ekspor" id="x_Tgl_Bln_Ekspor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_edit->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $dm_ecp_edit->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<?php echo $dm_ecp_edit->Tgl_Bln_Ekspor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<div id="r_Negara_Tujuan" class="form-group row">
		<label id="elh_dm_ecp_Negara_Tujuan" for="x_Negara_Tujuan" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Negara_Tujuan->caption() ?><?php echo $dm_ecp_edit->Negara_Tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Negara_Tujuan->cellAttributes() ?>>
<span id="el_dm_ecp_Negara_Tujuan">
<input type="text" data-table="dm_ecp" data-field="x_Negara_Tujuan" name="x_Negara_Tujuan" id="x_Negara_Tujuan" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Negara_Tujuan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_edit->Negara_Tujuan->EditValue ?>"<?php echo $dm_ecp_edit->Negara_Tujuan->editAttributes() ?>>
</span>
<?php echo $dm_ecp_edit->Negara_Tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<div id="r_Nilai_Ekspor_USD" class="form-group row">
		<label id="elh_dm_ecp_Nilai_Ekspor_USD" for="x_Nilai_Ekspor_USD" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Nilai_Ekspor_USD->caption() ?><?php echo $dm_ecp_edit->Nilai_Ekspor_USD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el_dm_ecp_Nilai_Ekspor_USD">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_USD" name="x_Nilai_Ekspor_USD" id="x_Nilai_Ekspor_USD" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_edit->Nilai_Ekspor_USD->EditValue ?>"<?php echo $dm_ecp_edit->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<?php echo $dm_ecp_edit->Nilai_Ekspor_USD->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<div id="r_Nilai_Ekspor_Rupiah" class="form-group row">
		<label id="elh_dm_ecp_Nilai_Ekspor_Rupiah" for="x_Nilai_Ekspor_Rupiah" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Nilai_Ekspor_Rupiah->caption() ?><?php echo $dm_ecp_edit->Nilai_Ekspor_Rupiah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el_dm_ecp_Nilai_Ekspor_Rupiah">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x_Nilai_Ekspor_Rupiah" id="x_Nilai_Ekspor_Rupiah" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_edit->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $dm_ecp_edit->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<?php echo $dm_ecp_edit->Nilai_Ekspor_Rupiah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group row">
		<label id="elh_dm_ecp_Keterangan" for="x_Keterangan" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Keterangan->caption() ?><?php echo $dm_ecp_edit->Keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Keterangan->cellAttributes() ?>>
<span id="el_dm_ecp_Keterangan">
<input type="text" data-table="dm_ecp" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Keterangan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_edit->Keterangan->EditValue ?>"<?php echo $dm_ecp_edit->Keterangan->editAttributes() ?>>
</span>
<?php echo $dm_ecp_edit->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<div id="r_Wilayah_ECP" class="form-group row">
		<label id="elh_dm_ecp_Wilayah_ECP" for="x_Wilayah_ECP" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Wilayah_ECP->caption() ?><?php echo $dm_ecp_edit->Wilayah_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Wilayah_ECP->cellAttributes() ?>>
<span id="el_dm_ecp_Wilayah_ECP">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_ecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_ecp_edit->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x_Wilayah_ECP" name="x_Wilayah_ECP"<?php echo $dm_ecp_edit->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_ecp_edit->Wilayah_ECP->selectOptionListHtml("x_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_ecp_edit->Wilayah_ECP->Lookup->getParamTag($dm_ecp_edit, "p_x_Wilayah_ECP") ?>
</span>
<?php echo $dm_ecp_edit->Wilayah_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_edit->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<div id="r_Tahun_ECP" class="form-group row">
		<label id="elh_dm_ecp_Tahun_ECP" for="x_Tahun_ECP" class="<?php echo $dm_ecp_edit->LeftColumnClass ?>"><?php echo $dm_ecp_edit->Tahun_ECP->caption() ?><?php echo $dm_ecp_edit->Tahun_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_edit->RightColumnClass ?>"><div <?php echo $dm_ecp_edit->Tahun_ECP->cellAttributes() ?>>
<span id="el_dm_ecp_Tahun_ECP">
<input type="text" data-table="dm_ecp" data-field="x_Tahun_ECP" name="x_Tahun_ECP" id="x_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_ecp_edit->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_edit->Tahun_ECP->EditValue ?>"<?php echo $dm_ecp_edit->Tahun_ECP->editAttributes() ?>>
</span>
<?php echo $dm_ecp_edit->Tahun_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$dm_ecp_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dm_ecp_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dm_ecp_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$dm_ecp_edit->showPageFooter();
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
$dm_ecp_edit->terminate();
?>