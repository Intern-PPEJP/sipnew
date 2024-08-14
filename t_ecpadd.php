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
$t_ecp_add = new t_ecp_add();

// Run the page
$t_ecp_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_ecp_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_ecpadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_ecpadd = currentForm = new ew.Form("ft_ecpadd", "add");

	// Validate form
	ft_ecpadd.validate = function() {
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
			<?php if ($t_ecp_add->Peserta_ID->Required) { ?>
				elm = this.getElements("x" + infix + "_Peserta_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Peserta_ID->caption(), $t_ecp_add->Peserta_ID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Peserta_ID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_add->Peserta_ID->errorMessage()) ?>");
			<?php if ($t_ecp_add->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Nama->caption(), $t_ecp_add->Nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_add->Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Perusahaan->caption(), $t_ecp_add->Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_add->Daerah->Required) { ?>
				elm = this.getElements("x" + infix + "_Daerah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Daerah->caption(), $t_ecp_add->Daerah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_add->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Produk->caption(), $t_ecp_add->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_add->Tgl_Bln_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tgl_Bln_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Tgl_Bln_Ekspor->caption(), $t_ecp_add->Tgl_Bln_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_add->Tahun_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Tahun_Ekspor->caption(), $t_ecp_add->Tahun_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_add->Negara_Tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_Negara_Tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Negara_Tujuan->caption(), $t_ecp_add->Negara_Tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_add->Nilai_Ekspor_USD->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Nilai_Ekspor_USD->caption(), $t_ecp_add->Nilai_Ekspor_USD->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_add->Nilai_Ekspor_USD->errorMessage()) ?>");
			<?php if ($t_ecp_add->Nilai_Ekspor_Rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Nilai_Ekspor_Rupiah->caption(), $t_ecp_add->Nilai_Ekspor_Rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_add->Nilai_Ekspor_Rupiah->errorMessage()) ?>");
			<?php if ($t_ecp_add->Keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_Keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_add->Keterangan->caption(), $t_ecp_add->Keterangan->RequiredErrorMessage)) ?>");
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
	ft_ecpadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_ecpadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_ecpadd.lists["x_Tahun_Ekspor"] = <?php echo $t_ecp_add->Tahun_Ekspor->Lookup->toClientList($t_ecp_add) ?>;
	ft_ecpadd.lists["x_Tahun_Ekspor"].options = <?php echo JsonEncode($t_ecp_add->Tahun_Ekspor->lookupOptions()) ?>;
	ft_ecpadd.lists["x_Negara_Tujuan"] = <?php echo $t_ecp_add->Negara_Tujuan->Lookup->toClientList($t_ecp_add) ?>;
	ft_ecpadd.lists["x_Negara_Tujuan"].options = <?php echo JsonEncode($t_ecp_add->Negara_Tujuan->lookupOptions()) ?>;
	loadjs.done("ft_ecpadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_ecp_add->showPageHeader(); ?>
<?php
$t_ecp_add->showMessage();
?>
<form name="ft_ecpadd" id="ft_ecpadd" class="<?php echo $t_ecp_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_ecp">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_ecp_add->IsModal ?>">
<?php if ($t_ecp->getCurrentMasterTable() == "t_pcp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pcp">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($t_ecp_add->Peserta_ID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_ecp_add->Peserta_ID->Visible) { // Peserta_ID ?>
	<div id="r_Peserta_ID" class="form-group row">
		<label id="elh_t_ecp_Peserta_ID" for="x_Peserta_ID" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Peserta_ID->caption() ?><?php echo $t_ecp_add->Peserta_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Peserta_ID->cellAttributes() ?>>
<?php if ($t_ecp_add->Peserta_ID->getSessionValue() != "") { ?>
<span id="el_t_ecp_Peserta_ID">
<span<?php echo $t_ecp_add->Peserta_ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_add->Peserta_ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_Peserta_ID" name="x_Peserta_ID" value="<?php echo HtmlEncode($t_ecp_add->Peserta_ID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_ecp_Peserta_ID">
<input type="text" data-table="t_ecp" data-field="x_Peserta_ID" data-page="1" name="x_Peserta_ID" id="x_Peserta_ID" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($t_ecp_add->Peserta_ID->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Peserta_ID->EditValue ?>"<?php echo $t_ecp_add->Peserta_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_ecp_add->Peserta_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group row">
		<label id="elh_t_ecp_Nama" for="x_Nama" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Nama->caption() ?><?php echo $t_ecp_add->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Nama->cellAttributes() ?>>
<span id="el_t_ecp_Nama">
<input type="text" data-table="t_ecp" data-field="x_Nama" data-page="1" name="x_Nama" id="x_Nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_ecp_add->Nama->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Nama->EditValue ?>"<?php echo $t_ecp_add->Nama->editAttributes() ?>>
</span>
<?php echo $t_ecp_add->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Perusahaan->Visible) { // Perusahaan ?>
	<div id="r_Perusahaan" class="form-group row">
		<label id="elh_t_ecp_Perusahaan" for="x_Perusahaan" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Perusahaan->caption() ?><?php echo $t_ecp_add->Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Perusahaan->cellAttributes() ?>>
<span id="el_t_ecp_Perusahaan">
<input type="text" data-table="t_ecp" data-field="x_Perusahaan" data-page="1" name="x_Perusahaan" id="x_Perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_add->Perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Perusahaan->EditValue ?>"<?php echo $t_ecp_add->Perusahaan->editAttributes() ?>>
</span>
<?php echo $t_ecp_add->Perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Daerah->Visible) { // Daerah ?>
	<div id="r_Daerah" class="form-group row">
		<label id="elh_t_ecp_Daerah" for="x_Daerah" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Daerah->caption() ?><?php echo $t_ecp_add->Daerah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Daerah->cellAttributes() ?>>
<span id="el_t_ecp_Daerah">
<input type="text" data-table="t_ecp" data-field="x_Daerah" data-page="1" name="x_Daerah" id="x_Daerah" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($t_ecp_add->Daerah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Daerah->EditValue ?>"<?php echo $t_ecp_add->Daerah->editAttributes() ?>>
</span>
<?php echo $t_ecp_add->Daerah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Produk->Visible) { // Produk ?>
	<div id="r_Produk" class="form-group row">
		<label id="elh_t_ecp_Produk" for="x_Produk" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Produk->caption() ?><?php echo $t_ecp_add->Produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Produk->cellAttributes() ?>>
<span id="el_t_ecp_Produk">
<input type="text" data-table="t_ecp" data-field="x_Produk" data-page="1" name="x_Produk" id="x_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_add->Produk->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Produk->EditValue ?>"<?php echo $t_ecp_add->Produk->editAttributes() ?>>
</span>
<?php echo $t_ecp_add->Produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<div id="r_Tgl_Bln_Ekspor" class="form-group row">
		<label id="elh_t_ecp_Tgl_Bln_Ekspor" for="x_Tgl_Bln_Ekspor" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Tgl_Bln_Ekspor->caption() ?><?php echo $t_ecp_add->Tgl_Bln_Ekspor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el_t_ecp_Tgl_Bln_Ekspor">
<input type="text" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" data-page="1" name="x_Tgl_Bln_Ekspor" id="x_Tgl_Bln_Ekspor" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($t_ecp_add->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $t_ecp_add->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<?php echo $t_ecp_add->Tgl_Bln_Ekspor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
	<div id="r_Tahun_Ekspor" class="form-group row">
		<label id="elh_t_ecp_Tahun_Ekspor" for="x_Tahun_Ekspor" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Tahun_Ekspor->caption() ?><?php echo $t_ecp_add->Tahun_Ekspor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Tahun_Ekspor->cellAttributes() ?>>
<span id="el_t_ecp_Tahun_Ekspor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Tahun_Ekspor" data-page="1" data-value-separator="<?php echo $t_ecp_add->Tahun_Ekspor->displayValueSeparatorAttribute() ?>" id="x_Tahun_Ekspor" name="x_Tahun_Ekspor"<?php echo $t_ecp_add->Tahun_Ekspor->editAttributes() ?>>
			<?php echo $t_ecp_add->Tahun_Ekspor->selectOptionListHtml("x_Tahun_Ekspor") ?>
		</select>
</div>
<?php echo $t_ecp_add->Tahun_Ekspor->Lookup->getParamTag($t_ecp_add, "p_x_Tahun_Ekspor") ?>
</span>
<?php echo $t_ecp_add->Tahun_Ekspor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<div id="r_Negara_Tujuan" class="form-group row">
		<label id="elh_t_ecp_Negara_Tujuan" for="x_Negara_Tujuan" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Negara_Tujuan->caption() ?><?php echo $t_ecp_add->Negara_Tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Negara_Tujuan->cellAttributes() ?>>
<span id="el_t_ecp_Negara_Tujuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Negara_Tujuan" data-page="1" data-value-separator="<?php echo $t_ecp_add->Negara_Tujuan->displayValueSeparatorAttribute() ?>" id="x_Negara_Tujuan" name="x_Negara_Tujuan"<?php echo $t_ecp_add->Negara_Tujuan->editAttributes() ?>>
			<?php echo $t_ecp_add->Negara_Tujuan->selectOptionListHtml("x_Negara_Tujuan") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_negara") && !$t_ecp_add->Negara_Tujuan->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_Negara_Tujuan" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_ecp_add->Negara_Tujuan->caption() ?>" data-title="<?php echo $t_ecp_add->Negara_Tujuan->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_Negara_Tujuan',url:'t_negaraaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_ecp_add->Negara_Tujuan->Lookup->getParamTag($t_ecp_add, "p_x_Negara_Tujuan") ?>
</span>
<?php echo $t_ecp_add->Negara_Tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<div id="r_Nilai_Ekspor_USD" class="form-group row">
		<label id="elh_t_ecp_Nilai_Ekspor_USD" for="x_Nilai_Ekspor_USD" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Nilai_Ekspor_USD->caption() ?><?php echo $t_ecp_add->Nilai_Ekspor_USD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el_t_ecp_Nilai_Ekspor_USD">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" data-page="1" name="x_Nilai_Ekspor_USD" id="x_Nilai_Ekspor_USD" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_add->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Nilai_Ekspor_USD->EditValue ?>"<?php echo $t_ecp_add->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<?php echo $t_ecp_add->Nilai_Ekspor_USD->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<div id="r_Nilai_Ekspor_Rupiah" class="form-group row">
		<label id="elh_t_ecp_Nilai_Ekspor_Rupiah" for="x_Nilai_Ekspor_Rupiah" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Nilai_Ekspor_Rupiah->caption() ?><?php echo $t_ecp_add->Nilai_Ekspor_Rupiah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el_t_ecp_Nilai_Ekspor_Rupiah">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" data-page="1" name="x_Nilai_Ekspor_Rupiah" id="x_Nilai_Ekspor_Rupiah" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_add->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $t_ecp_add->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<?php echo $t_ecp_add->Nilai_Ekspor_Rupiah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_ecp_add->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group row">
		<label id="elh_t_ecp_Keterangan" for="x_Keterangan" class="<?php echo $t_ecp_add->LeftColumnClass ?>"><?php echo $t_ecp_add->Keterangan->caption() ?><?php echo $t_ecp_add->Keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_ecp_add->RightColumnClass ?>"><div <?php echo $t_ecp_add->Keterangan->cellAttributes() ?>>
<span id="el_t_ecp_Keterangan">
<input type="text" data-table="t_ecp" data-field="x_Keterangan" data-page="1" name="x_Keterangan" id="x_Keterangan" size="15" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_add->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t_ecp_add->Keterangan->EditValue ?>"<?php echo $t_ecp_add->Keterangan->editAttributes() ?>>
</span>
<?php echo $t_ecp_add->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_ecp_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_ecp_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_ecp_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_ecp_add->showPageFooter();
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
$t_ecp_add->terminate();
?>