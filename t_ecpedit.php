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
$t_ecp_edit = new t_ecp_edit();

// Run the page
$t_ecp_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_ecp_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_ecpedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_ecpedit = currentForm = new ew.Form("ft_ecpedit", "edit");

	// Validate form
	ft_ecpedit.validate = function() {
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
			<?php if ($t_ecp_edit->ID_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->ID_ECP->caption(), $t_ecp_edit->ID_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_edit->Peserta_ID->Required) { ?>
				elm = this.getElements("x" + infix + "_Peserta_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Peserta_ID->caption(), $t_ecp_edit->Peserta_ID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Peserta_ID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_edit->Peserta_ID->errorMessage()) ?>");
			<?php if ($t_ecp_edit->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Nama->caption(), $t_ecp_edit->Nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_edit->Perusahaan_ID->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Perusahaan_ID->caption(), $t_ecp_edit->Perusahaan_ID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Perusahaan_ID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_edit->Perusahaan_ID->errorMessage()) ?>");
			<?php if ($t_ecp_edit->Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Perusahaan->caption(), $t_ecp_edit->Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_edit->Daerah->Required) { ?>
				elm = this.getElements("x" + infix + "_Daerah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Daerah->caption(), $t_ecp_edit->Daerah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_edit->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Produk->caption(), $t_ecp_edit->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_edit->Tgl_Bln_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tgl_Bln_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Tgl_Bln_Ekspor->caption(), $t_ecp_edit->Tgl_Bln_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_edit->Tahun_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Tahun_Ekspor->caption(), $t_ecp_edit->Tahun_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_edit->Negara_Tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_Negara_Tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Negara_Tujuan->caption(), $t_ecp_edit->Negara_Tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_edit->Nilai_Ekspor_USD->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Nilai_Ekspor_USD->caption(), $t_ecp_edit->Nilai_Ekspor_USD->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_edit->Nilai_Ekspor_USD->errorMessage()) ?>");
			<?php if ($t_ecp_edit->Nilai_Ekspor_Rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Nilai_Ekspor_Rupiah->caption(), $t_ecp_edit->Nilai_Ekspor_Rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_edit->Nilai_Ekspor_Rupiah->errorMessage()) ?>");
			<?php if ($t_ecp_edit->Keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_Keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_edit->Keterangan->caption(), $t_ecp_edit->Keterangan->RequiredErrorMessage)) ?>");
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
	ft_ecpedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_ecpedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_ecpedit.lists["x_Tahun_Ekspor"] = <?php echo $t_ecp_edit->Tahun_Ekspor->Lookup->toClientList($t_ecp_edit) ?>;
	ft_ecpedit.lists["x_Tahun_Ekspor"].options = <?php echo JsonEncode($t_ecp_edit->Tahun_Ekspor->lookupOptions()) ?>;
	ft_ecpedit.lists["x_Negara_Tujuan"] = <?php echo $t_ecp_edit->Negara_Tujuan->Lookup->toClientList($t_ecp_edit) ?>;
	ft_ecpedit.lists["x_Negara_Tujuan"].options = <?php echo JsonEncode($t_ecp_edit->Negara_Tujuan->lookupOptions()) ?>;
	loadjs.done("ft_ecpedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_ecp_edit->showPageHeader(); ?>
<?php
$t_ecp_edit->showMessage();
?>
<form name="ft_ecpedit" id="ft_ecpedit" class="<?php echo $t_ecp_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_ecp">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_ecp_edit->IsModal ?>">
<?php if ($t_ecp->getCurrentMasterTable() == "t_pcp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pcp">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($t_ecp_edit->Peserta_ID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_ecp_edit->ID_ECP->Visible) { // ID_ECP ?>
	<div id="r_ID_ECP" class="form-group row">
		<label id="elh_t_ecp_ID_ECP" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->ID_ECP->caption() ?><?php echo $t_ecp_edit->ID_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->ID_ECP->cellAttributes() ?>>
<span id="el_t_ecp_ID_ECP">
<span<?php echo $t_ecp_edit->ID_ECP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_edit->ID_ECP->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_ID_ECP" name="x_ID_ECP" id="x_ID_ECP" value="<?php echo HtmlEncode($t_ecp_edit->ID_ECP->CurrentValue) ?>">
<?php echo $t_ecp_edit->ID_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Peserta_ID->Visible) { // Peserta_ID ?>
	<div id="r_Peserta_ID" class="form-group row">
		<label id="elh_t_ecp_Peserta_ID" for="x_Peserta_ID" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Peserta_ID->caption() ?><?php echo $t_ecp_edit->Peserta_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Peserta_ID->cellAttributes() ?>>
<?php if ($t_ecp_edit->Peserta_ID->getSessionValue() != "") { ?>
<span id="el_t_ecp_Peserta_ID">
<span<?php echo $t_ecp_edit->Peserta_ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_edit->Peserta_ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_Peserta_ID" name="x_Peserta_ID" value="<?php echo HtmlEncode($t_ecp_edit->Peserta_ID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_ecp_Peserta_ID">
<input type="text" data-table="t_ecp" data-field="x_Peserta_ID" name="x_Peserta_ID" id="x_Peserta_ID" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($t_ecp_edit->Peserta_ID->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Peserta_ID->EditValue ?>"<?php echo $t_ecp_edit->Peserta_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_ecp_edit->Peserta_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group row">
		<label id="elh_t_ecp_Nama" for="x_Nama" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Nama->caption() ?><?php echo $t_ecp_edit->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Nama->cellAttributes() ?>>
<span id="el_t_ecp_Nama">
<input type="text" data-table="t_ecp" data-field="x_Nama" name="x_Nama" id="x_Nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_ecp_edit->Nama->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Nama->EditValue ?>"<?php echo $t_ecp_edit->Nama->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Perusahaan_ID->Visible) { // Perusahaan_ID ?>
	<div id="r_Perusahaan_ID" class="form-group row">
		<label id="elh_t_ecp_Perusahaan_ID" for="x_Perusahaan_ID" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Perusahaan_ID->caption() ?><?php echo $t_ecp_edit->Perusahaan_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Perusahaan_ID->cellAttributes() ?>>
<span id="el_t_ecp_Perusahaan_ID">
<input type="text" data-table="t_ecp" data-field="x_Perusahaan_ID" name="x_Perusahaan_ID" id="x_Perusahaan_ID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($t_ecp_edit->Perusahaan_ID->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Perusahaan_ID->EditValue ?>"<?php echo $t_ecp_edit->Perusahaan_ID->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Perusahaan_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Perusahaan->Visible) { // Perusahaan ?>
	<div id="r_Perusahaan" class="form-group row">
		<label id="elh_t_ecp_Perusahaan" for="x_Perusahaan" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Perusahaan->caption() ?><?php echo $t_ecp_edit->Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Perusahaan->cellAttributes() ?>>
<span id="el_t_ecp_Perusahaan">
<input type="text" data-table="t_ecp" data-field="x_Perusahaan" name="x_Perusahaan" id="x_Perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_edit->Perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Perusahaan->EditValue ?>"<?php echo $t_ecp_edit->Perusahaan->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Daerah->Visible) { // Daerah ?>
	<div id="r_Daerah" class="form-group row">
		<label id="elh_t_ecp_Daerah" for="x_Daerah" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Daerah->caption() ?><?php echo $t_ecp_edit->Daerah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Daerah->cellAttributes() ?>>
<span id="el_t_ecp_Daerah">
<input type="text" data-table="t_ecp" data-field="x_Daerah" name="x_Daerah" id="x_Daerah" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($t_ecp_edit->Daerah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Daerah->EditValue ?>"<?php echo $t_ecp_edit->Daerah->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Daerah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Produk->Visible) { // Produk ?>
	<div id="r_Produk" class="form-group row">
		<label id="elh_t_ecp_Produk" for="x_Produk" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Produk->caption() ?><?php echo $t_ecp_edit->Produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Produk->cellAttributes() ?>>
<span id="el_t_ecp_Produk">
<input type="text" data-table="t_ecp" data-field="x_Produk" name="x_Produk" id="x_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_edit->Produk->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Produk->EditValue ?>"<?php echo $t_ecp_edit->Produk->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<div id="r_Tgl_Bln_Ekspor" class="form-group row">
		<label id="elh_t_ecp_Tgl_Bln_Ekspor" for="x_Tgl_Bln_Ekspor" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Tgl_Bln_Ekspor->caption() ?><?php echo $t_ecp_edit->Tgl_Bln_Ekspor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el_t_ecp_Tgl_Bln_Ekspor">
<input type="text" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="x_Tgl_Bln_Ekspor" id="x_Tgl_Bln_Ekspor" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($t_ecp_edit->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $t_ecp_edit->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Tgl_Bln_Ekspor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
	<div id="r_Tahun_Ekspor" class="form-group row">
		<label id="elh_t_ecp_Tahun_Ekspor" for="x_Tahun_Ekspor" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Tahun_Ekspor->caption() ?><?php echo $t_ecp_edit->Tahun_Ekspor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Tahun_Ekspor->cellAttributes() ?>>
<span id="el_t_ecp_Tahun_Ekspor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Tahun_Ekspor" data-value-separator="<?php echo $t_ecp_edit->Tahun_Ekspor->displayValueSeparatorAttribute() ?>" id="x_Tahun_Ekspor" name="x_Tahun_Ekspor"<?php echo $t_ecp_edit->Tahun_Ekspor->editAttributes() ?>>
			<?php echo $t_ecp_edit->Tahun_Ekspor->selectOptionListHtml("x_Tahun_Ekspor") ?>
		</select>
</div>
<?php echo $t_ecp_edit->Tahun_Ekspor->Lookup->getParamTag($t_ecp_edit, "p_x_Tahun_Ekspor") ?>
</span>
<?php echo $t_ecp_edit->Tahun_Ekspor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<div id="r_Negara_Tujuan" class="form-group row">
		<label id="elh_t_ecp_Negara_Tujuan" for="x_Negara_Tujuan" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Negara_Tujuan->caption() ?><?php echo $t_ecp_edit->Negara_Tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Negara_Tujuan->cellAttributes() ?>>
<span id="el_t_ecp_Negara_Tujuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Negara_Tujuan" data-value-separator="<?php echo $t_ecp_edit->Negara_Tujuan->displayValueSeparatorAttribute() ?>" id="x_Negara_Tujuan" name="x_Negara_Tujuan"<?php echo $t_ecp_edit->Negara_Tujuan->editAttributes() ?>>
			<?php echo $t_ecp_edit->Negara_Tujuan->selectOptionListHtml("x_Negara_Tujuan") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_negara") && !$t_ecp_edit->Negara_Tujuan->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_Negara_Tujuan" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_ecp_edit->Negara_Tujuan->caption() ?>" data-title="<?php echo $t_ecp_edit->Negara_Tujuan->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_Negara_Tujuan',url:'t_negaraaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_ecp_edit->Negara_Tujuan->Lookup->getParamTag($t_ecp_edit, "p_x_Negara_Tujuan") ?>
</span>
<?php echo $t_ecp_edit->Negara_Tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<div id="r_Nilai_Ekspor_USD" class="form-group row">
		<label id="elh_t_ecp_Nilai_Ekspor_USD" for="x_Nilai_Ekspor_USD" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Nilai_Ekspor_USD->caption() ?><?php echo $t_ecp_edit->Nilai_Ekspor_USD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el_t_ecp_Nilai_Ekspor_USD">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="x_Nilai_Ekspor_USD" id="x_Nilai_Ekspor_USD" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_edit->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Nilai_Ekspor_USD->EditValue ?>"<?php echo $t_ecp_edit->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Nilai_Ekspor_USD->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<div id="r_Nilai_Ekspor_Rupiah" class="form-group row">
		<label id="elh_t_ecp_Nilai_Ekspor_Rupiah" for="x_Nilai_Ekspor_Rupiah" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Nilai_Ekspor_Rupiah->caption() ?><?php echo $t_ecp_edit->Nilai_Ekspor_Rupiah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el_t_ecp_Nilai_Ekspor_Rupiah">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x_Nilai_Ekspor_Rupiah" id="x_Nilai_Ekspor_Rupiah" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_edit->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $t_ecp_edit->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Nilai_Ekspor_Rupiah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_edit->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group row">
		<label id="elh_t_ecp_Keterangan" for="x_Keterangan" class="<?php echo $t_ecp_edit->LeftColumnClass ?>"><?php echo $t_ecp_edit->Keterangan->caption() ?><?php echo $t_ecp_edit->Keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_edit->RightColumnClass ?>"><div <?php echo $t_ecp_edit->Keterangan->cellAttributes() ?>>
<span id="el_t_ecp_Keterangan">
<input type="text" data-table="t_ecp" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" size="15" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_edit->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t_ecp_edit->Keterangan->EditValue ?>"<?php echo $t_ecp_edit->Keterangan->editAttributes() ?>>
</span>
<?php echo $t_ecp_edit->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_ecp_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_ecp_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_ecp_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_ecp_edit->showPageFooter();
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
$t_ecp_edit->terminate();
?>