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
$dm_ecp_add = new dm_ecp_add();

// Run the page
$dm_ecp_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_ecp_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdm_ecpadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdm_ecpadd = currentForm = new ew.Form("fdm_ecpadd", "add");

	// Validate form
	fdm_ecpadd.validate = function() {
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
			<?php if ($dm_ecp_add->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Nama->caption(), $dm_ecp_add->Nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_add->Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Perusahaan->caption(), $dm_ecp_add->Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_add->Daerah->Required) { ?>
				elm = this.getElements("x" + infix + "_Daerah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Daerah->caption(), $dm_ecp_add->Daerah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_add->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Produk->caption(), $dm_ecp_add->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_add->Tgl_Bln_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tgl_Bln_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Tgl_Bln_Ekspor->caption(), $dm_ecp_add->Tgl_Bln_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_add->Negara_Tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_Negara_Tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Negara_Tujuan->caption(), $dm_ecp_add->Negara_Tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_add->Nilai_Ekspor_USD->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Nilai_Ekspor_USD->caption(), $dm_ecp_add->Nilai_Ekspor_USD->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_add->Nilai_Ekspor_USD->errorMessage()) ?>");
			<?php if ($dm_ecp_add->Nilai_Ekspor_Rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Nilai_Ekspor_Rupiah->caption(), $dm_ecp_add->Nilai_Ekspor_Rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_add->Nilai_Ekspor_Rupiah->errorMessage()) ?>");
			<?php if ($dm_ecp_add->Keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_Keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Keterangan->caption(), $dm_ecp_add->Keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_add->Wilayah_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Wilayah_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Wilayah_ECP->caption(), $dm_ecp_add->Wilayah_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_add->Tahun_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_add->Tahun_ECP->caption(), $dm_ecp_add->Tahun_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_add->Tahun_ECP->errorMessage()) ?>");

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
	fdm_ecpadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdm_ecpadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdm_ecpadd.lists["x_Nama"] = <?php echo $dm_ecp_add->Nama->Lookup->toClientList($dm_ecp_add) ?>;
	fdm_ecpadd.lists["x_Nama"].options = <?php echo JsonEncode($dm_ecp_add->Nama->lookupOptions()) ?>;
	fdm_ecpadd.autoSuggests["x_Nama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdm_ecpadd.lists["x_Perusahaan"] = <?php echo $dm_ecp_add->Perusahaan->Lookup->toClientList($dm_ecp_add) ?>;
	fdm_ecpadd.lists["x_Perusahaan"].options = <?php echo JsonEncode($dm_ecp_add->Perusahaan->lookupOptions()) ?>;
	fdm_ecpadd.autoSuggests["x_Perusahaan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdm_ecpadd.lists["x_Wilayah_ECP"] = <?php echo $dm_ecp_add->Wilayah_ECP->Lookup->toClientList($dm_ecp_add) ?>;
	fdm_ecpadd.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($dm_ecp_add->Wilayah_ECP->lookupOptions()) ?>;
	loadjs.done("fdm_ecpadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dm_ecp_add->showPageHeader(); ?>
<?php
$dm_ecp_add->showMessage();
?>
<form name="fdm_ecpadd" id="fdm_ecpadd" class="<?php echo $dm_ecp_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_ecp">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$dm_ecp_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($dm_ecp_add->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group row">
		<label id="elh_dm_ecp_Nama" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Nama->caption() ?><?php echo $dm_ecp_add->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Nama->cellAttributes() ?>>
<span id="el_dm_ecp_Nama">
<?php
$onchange = $dm_ecp_add->Nama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_add->Nama->EditAttrs["onchange"] = "";
?>
<span id="as_x_Nama">
	<input type="text" class="form-control" name="sv_x_Nama" id="sv_x_Nama" value="<?php echo RemoveHtml($dm_ecp_add->Nama->EditValue) ?>" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_ecp_add->Nama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_add->Nama->getPlaceHolder()) ?>"<?php echo $dm_ecp_add->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nama" data-value-separator="<?php echo $dm_ecp_add->Nama->displayValueSeparatorAttribute() ?>" name="x_Nama" id="x_Nama" value="<?php echo HtmlEncode($dm_ecp_add->Nama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecpadd"], function() {
	fdm_ecpadd.createAutoSuggest({"id":"x_Nama","forceSelect":false});
});
</script>
<?php echo $dm_ecp_add->Nama->Lookup->getParamTag($dm_ecp_add, "p_x_Nama") ?>
</span>
<?php echo $dm_ecp_add->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Perusahaan->Visible) { // Perusahaan ?>
	<div id="r_Perusahaan" class="form-group row">
		<label id="elh_dm_ecp_Perusahaan" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Perusahaan->caption() ?><?php echo $dm_ecp_add->Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Perusahaan->cellAttributes() ?>>
<span id="el_dm_ecp_Perusahaan">
<?php
$onchange = $dm_ecp_add->Perusahaan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_add->Perusahaan->EditAttrs["onchange"] = "";
?>
<span id="as_x_Perusahaan">
	<input type="text" class="form-control" name="sv_x_Perusahaan" id="sv_x_Perusahaan" value="<?php echo RemoveHtml($dm_ecp_add->Perusahaan->EditValue) ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_add->Perusahaan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_add->Perusahaan->getPlaceHolder()) ?>"<?php echo $dm_ecp_add->Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Perusahaan" data-value-separator="<?php echo $dm_ecp_add->Perusahaan->displayValueSeparatorAttribute() ?>" name="x_Perusahaan" id="x_Perusahaan" value="<?php echo HtmlEncode($dm_ecp_add->Perusahaan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecpadd"], function() {
	fdm_ecpadd.createAutoSuggest({"id":"x_Perusahaan","forceSelect":false});
});
</script>
<?php echo $dm_ecp_add->Perusahaan->Lookup->getParamTag($dm_ecp_add, "p_x_Perusahaan") ?>
</span>
<?php echo $dm_ecp_add->Perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Daerah->Visible) { // Daerah ?>
	<div id="r_Daerah" class="form-group row">
		<label id="elh_dm_ecp_Daerah" for="x_Daerah" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Daerah->caption() ?><?php echo $dm_ecp_add->Daerah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Daerah->cellAttributes() ?>>
<span id="el_dm_ecp_Daerah">
<input type="text" data-table="dm_ecp" data-field="x_Daerah" name="x_Daerah" id="x_Daerah" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_add->Daerah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_add->Daerah->EditValue ?>"<?php echo $dm_ecp_add->Daerah->editAttributes() ?>>
</span>
<?php echo $dm_ecp_add->Daerah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Produk->Visible) { // Produk ?>
	<div id="r_Produk" class="form-group row">
		<label id="elh_dm_ecp_Produk" for="x_Produk" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Produk->caption() ?><?php echo $dm_ecp_add->Produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Produk->cellAttributes() ?>>
<span id="el_dm_ecp_Produk">
<input type="text" data-table="dm_ecp" data-field="x_Produk" name="x_Produk" id="x_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_add->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_add->Produk->EditValue ?>"<?php echo $dm_ecp_add->Produk->editAttributes() ?>>
</span>
<?php echo $dm_ecp_add->Produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<div id="r_Tgl_Bln_Ekspor" class="form-group row">
		<label id="elh_dm_ecp_Tgl_Bln_Ekspor" for="x_Tgl_Bln_Ekspor" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Tgl_Bln_Ekspor->caption() ?><?php echo $dm_ecp_add->Tgl_Bln_Ekspor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el_dm_ecp_Tgl_Bln_Ekspor">
<input type="text" data-table="dm_ecp" data-field="x_Tgl_Bln_Ekspor" name="x_Tgl_Bln_Ekspor" id="x_Tgl_Bln_Ekspor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dm_ecp_add->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_add->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $dm_ecp_add->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<?php echo $dm_ecp_add->Tgl_Bln_Ekspor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<div id="r_Negara_Tujuan" class="form-group row">
		<label id="elh_dm_ecp_Negara_Tujuan" for="x_Negara_Tujuan" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Negara_Tujuan->caption() ?><?php echo $dm_ecp_add->Negara_Tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Negara_Tujuan->cellAttributes() ?>>
<span id="el_dm_ecp_Negara_Tujuan">
<input type="text" data-table="dm_ecp" data-field="x_Negara_Tujuan" name="x_Negara_Tujuan" id="x_Negara_Tujuan" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_add->Negara_Tujuan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_add->Negara_Tujuan->EditValue ?>"<?php echo $dm_ecp_add->Negara_Tujuan->editAttributes() ?>>
</span>
<?php echo $dm_ecp_add->Negara_Tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<div id="r_Nilai_Ekspor_USD" class="form-group row">
		<label id="elh_dm_ecp_Nilai_Ekspor_USD" for="x_Nilai_Ekspor_USD" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Nilai_Ekspor_USD->caption() ?><?php echo $dm_ecp_add->Nilai_Ekspor_USD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el_dm_ecp_Nilai_Ekspor_USD">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_USD" name="x_Nilai_Ekspor_USD" id="x_Nilai_Ekspor_USD" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_add->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_add->Nilai_Ekspor_USD->EditValue ?>"<?php echo $dm_ecp_add->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<?php echo $dm_ecp_add->Nilai_Ekspor_USD->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<div id="r_Nilai_Ekspor_Rupiah" class="form-group row">
		<label id="elh_dm_ecp_Nilai_Ekspor_Rupiah" for="x_Nilai_Ekspor_Rupiah" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Nilai_Ekspor_Rupiah->caption() ?><?php echo $dm_ecp_add->Nilai_Ekspor_Rupiah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el_dm_ecp_Nilai_Ekspor_Rupiah">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x_Nilai_Ekspor_Rupiah" id="x_Nilai_Ekspor_Rupiah" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_add->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_add->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $dm_ecp_add->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<?php echo $dm_ecp_add->Nilai_Ekspor_Rupiah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group row">
		<label id="elh_dm_ecp_Keterangan" for="x_Keterangan" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Keterangan->caption() ?><?php echo $dm_ecp_add->Keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Keterangan->cellAttributes() ?>>
<span id="el_dm_ecp_Keterangan">
<input type="text" data-table="dm_ecp" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_add->Keterangan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_add->Keterangan->EditValue ?>"<?php echo $dm_ecp_add->Keterangan->editAttributes() ?>>
</span>
<?php echo $dm_ecp_add->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<div id="r_Wilayah_ECP" class="form-group row">
		<label id="elh_dm_ecp_Wilayah_ECP" for="x_Wilayah_ECP" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Wilayah_ECP->caption() ?><?php echo $dm_ecp_add->Wilayah_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Wilayah_ECP->cellAttributes() ?>>
<span id="el_dm_ecp_Wilayah_ECP">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_ecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_ecp_add->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x_Wilayah_ECP" name="x_Wilayah_ECP"<?php echo $dm_ecp_add->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_ecp_add->Wilayah_ECP->selectOptionListHtml("x_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_ecp_add->Wilayah_ECP->Lookup->getParamTag($dm_ecp_add, "p_x_Wilayah_ECP") ?>
</span>
<?php echo $dm_ecp_add->Wilayah_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_ecp_add->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<div id="r_Tahun_ECP" class="form-group row">
		<label id="elh_dm_ecp_Tahun_ECP" for="x_Tahun_ECP" class="<?php echo $dm_ecp_add->LeftColumnClass ?>"><?php echo $dm_ecp_add->Tahun_ECP->caption() ?><?php echo $dm_ecp_add->Tahun_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_ecp_add->RightColumnClass ?>"><div <?php echo $dm_ecp_add->Tahun_ECP->cellAttributes() ?>>
<span id="el_dm_ecp_Tahun_ECP">
<input type="text" data-table="dm_ecp" data-field="x_Tahun_ECP" name="x_Tahun_ECP" id="x_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_ecp_add->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_add->Tahun_ECP->EditValue ?>"<?php echo $dm_ecp_add->Tahun_ECP->editAttributes() ?>>
</span>
<?php echo $dm_ecp_add->Tahun_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$dm_ecp_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dm_ecp_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dm_ecp_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$dm_ecp_add->showPageFooter();
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
$dm_ecp_add->terminate();
?>