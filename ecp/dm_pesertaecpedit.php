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
$dm_pesertaecp_edit = new dm_pesertaecp_edit();

// Run the page
$dm_pesertaecp_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_pesertaecp_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdm_pesertaecpedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdm_pesertaecpedit = currentForm = new ew.Form("fdm_pesertaecpedit", "edit");

	// Validate form
	fdm_pesertaecpedit.validate = function() {
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
			<?php if ($dm_pesertaecp_edit->ID_Unik->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Unik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->ID_Unik->caption(), $dm_pesertaecp_edit->ID_Unik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Nama->caption(), $dm_pesertaecp_edit->Nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Perusahaan->caption(), $dm_pesertaecp_edit->Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Alamat->Required) { ?>
				elm = this.getElements("x" + infix + "_Alamat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Alamat->caption(), $dm_pesertaecp_edit->Alamat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Produk->caption(), $dm_pesertaecp_edit->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Kapasitas_Produksi->Required) { ?>
				elm = this.getElements("x" + infix + "_Kapasitas_Produksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Kapasitas_Produksi->caption(), $dm_pesertaecp_edit->Kapasitas_Produksi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Omset->Required) { ?>
				elm = this.getElements("x" + infix + "_Omset");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Omset->caption(), $dm_pesertaecp_edit->Omset->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Jumlah_Pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_Jumlah_Pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Jumlah_Pegawai->caption(), $dm_pesertaecp_edit->Jumlah_Pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Legalitas_Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Legalitas_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Legalitas_Perusahaan->caption(), $dm_pesertaecp_edit->Legalitas_Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Sertifikasi_dimiliki->Required) { ?>
				elm = this.getElements("x" + infix + "_Sertifikasi_dimiliki");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Sertifikasi_dimiliki->caption(), $dm_pesertaecp_edit->Sertifikasi_dimiliki->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Handphone->Required) { ?>
				elm = this.getElements("x" + infix + "_Handphone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Handphone->caption(), $dm_pesertaecp_edit->Handphone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Email_Add->Required) { ?>
				elm = this.getElements("x" + infix + "_Email_Add");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Email_Add->caption(), $dm_pesertaecp_edit->Email_Add->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Website->Required) { ?>
				elm = this.getElements("x" + infix + "_Website");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Website->caption(), $dm_pesertaecp_edit->Website->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Tahun_Berdiri->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_Berdiri");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Tahun_Berdiri->caption(), $dm_pesertaecp_edit->Tahun_Berdiri->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Alamat_Produksi->Required) { ?>
				elm = this.getElements("x" + infix + "_Alamat_Produksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Alamat_Produksi->caption(), $dm_pesertaecp_edit->Alamat_Produksi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Wilayah_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Wilayah_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Wilayah_ECP->caption(), $dm_pesertaecp_edit->Wilayah_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_edit->Tahun_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_edit->Tahun_ECP->caption(), $dm_pesertaecp_edit->Tahun_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_pesertaecp_edit->Tahun_ECP->errorMessage()) ?>");

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
	fdm_pesertaecpedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdm_pesertaecpedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdm_pesertaecpedit.lists["x_Wilayah_ECP"] = <?php echo $dm_pesertaecp_edit->Wilayah_ECP->Lookup->toClientList($dm_pesertaecp_edit) ?>;
	fdm_pesertaecpedit.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($dm_pesertaecp_edit->Wilayah_ECP->lookupOptions()) ?>;
	loadjs.done("fdm_pesertaecpedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dm_pesertaecp_edit->showPageHeader(); ?>
<?php
$dm_pesertaecp_edit->showMessage();
?>
<form name="fdm_pesertaecpedit" id="fdm_pesertaecpedit" class="<?php echo $dm_pesertaecp_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_pesertaecp">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$dm_pesertaecp_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($dm_pesertaecp_edit->ID_Unik->Visible) { // ID_Unik ?>
	<div id="r_ID_Unik" class="form-group row">
		<label id="elh_dm_pesertaecp_ID_Unik" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->ID_Unik->caption() ?><?php echo $dm_pesertaecp_edit->ID_Unik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->ID_Unik->cellAttributes() ?>>
<span id="el_dm_pesertaecp_ID_Unik">
<span<?php echo $dm_pesertaecp_edit->ID_Unik->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dm_pesertaecp_edit->ID_Unik->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_ID_Unik" name="x_ID_Unik" id="x_ID_Unik" value="<?php echo HtmlEncode($dm_pesertaecp_edit->ID_Unik->CurrentValue) ?>">
<?php echo $dm_pesertaecp_edit->ID_Unik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group row">
		<label id="elh_dm_pesertaecp_Nama" for="x_Nama" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Nama->caption() ?><?php echo $dm_pesertaecp_edit->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Nama->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Nama">
<input type="text" data-table="dm_pesertaecp" data-field="x_Nama" name="x_Nama" id="x_Nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Nama->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Nama->EditValue ?>"<?php echo $dm_pesertaecp_edit->Nama->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Perusahaan->Visible) { // Perusahaan ?>
	<div id="r_Perusahaan" class="form-group row">
		<label id="elh_dm_pesertaecp_Perusahaan" for="x_Perusahaan" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Perusahaan->caption() ?><?php echo $dm_pesertaecp_edit->Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Perusahaan->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Perusahaan">
<input type="text" data-table="dm_pesertaecp" data-field="x_Perusahaan" name="x_Perusahaan" id="x_Perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_edit->Perusahaan->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Alamat->Visible) { // Alamat ?>
	<div id="r_Alamat" class="form-group row">
		<label id="elh_dm_pesertaecp_Alamat" for="x_Alamat" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Alamat->caption() ?><?php echo $dm_pesertaecp_edit->Alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Alamat->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Alamat">
<textarea data-table="dm_pesertaecp" data-field="x_Alamat" name="x_Alamat" id="x_Alamat" cols="35" rows="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Alamat->getPlaceHolder()) ?>"<?php echo $dm_pesertaecp_edit->Alamat->editAttributes() ?>><?php echo $dm_pesertaecp_edit->Alamat->EditValue ?></textarea>
</span>
<?php echo $dm_pesertaecp_edit->Alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Produk->Visible) { // Produk ?>
	<div id="r_Produk" class="form-group row">
		<label id="elh_dm_pesertaecp_Produk" for="x_Produk" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Produk->caption() ?><?php echo $dm_pesertaecp_edit->Produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Produk->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Produk">
<input type="text" data-table="dm_pesertaecp" data-field="x_Produk" name="x_Produk" id="x_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Produk->EditValue ?>"<?php echo $dm_pesertaecp_edit->Produk->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
	<div id="r_Kapasitas_Produksi" class="form-group row">
		<label id="elh_dm_pesertaecp_Kapasitas_Produksi" for="x_Kapasitas_Produksi" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Kapasitas_Produksi->caption() ?><?php echo $dm_pesertaecp_edit->Kapasitas_Produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Kapasitas_Produksi->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Kapasitas_Produksi">
<input type="text" data-table="dm_pesertaecp" data-field="x_Kapasitas_Produksi" name="x_Kapasitas_Produksi" id="x_Kapasitas_Produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Kapasitas_Produksi->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Kapasitas_Produksi->EditValue ?>"<?php echo $dm_pesertaecp_edit->Kapasitas_Produksi->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Kapasitas_Produksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Omset->Visible) { // Omset ?>
	<div id="r_Omset" class="form-group row">
		<label id="elh_dm_pesertaecp_Omset" for="x_Omset" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Omset->caption() ?><?php echo $dm_pesertaecp_edit->Omset->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Omset->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Omset">
<input type="text" data-table="dm_pesertaecp" data-field="x_Omset" name="x_Omset" id="x_Omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Omset->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Omset->EditValue ?>"<?php echo $dm_pesertaecp_edit->Omset->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Omset->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Jumlah_Pegawai->Visible) { // Jumlah_Pegawai ?>
	<div id="r_Jumlah_Pegawai" class="form-group row">
		<label id="elh_dm_pesertaecp_Jumlah_Pegawai" for="x_Jumlah_Pegawai" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Jumlah_Pegawai->caption() ?><?php echo $dm_pesertaecp_edit->Jumlah_Pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Jumlah_Pegawai->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Jumlah_Pegawai">
<input type="text" data-table="dm_pesertaecp" data-field="x_Jumlah_Pegawai" name="x_Jumlah_Pegawai" id="x_Jumlah_Pegawai" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Jumlah_Pegawai->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Jumlah_Pegawai->EditValue ?>"<?php echo $dm_pesertaecp_edit->Jumlah_Pegawai->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Jumlah_Pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Legalitas_Perusahaan->Visible) { // Legalitas_Perusahaan ?>
	<div id="r_Legalitas_Perusahaan" class="form-group row">
		<label id="elh_dm_pesertaecp_Legalitas_Perusahaan" for="x_Legalitas_Perusahaan" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Legalitas_Perusahaan->caption() ?><?php echo $dm_pesertaecp_edit->Legalitas_Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Legalitas_Perusahaan->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Legalitas_Perusahaan">
<input type="text" data-table="dm_pesertaecp" data-field="x_Legalitas_Perusahaan" name="x_Legalitas_Perusahaan" id="x_Legalitas_Perusahaan" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Legalitas_Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Legalitas_Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_edit->Legalitas_Perusahaan->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Legalitas_Perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Sertifikasi_dimiliki->Visible) { // Sertifikasi_dimiliki ?>
	<div id="r_Sertifikasi_dimiliki" class="form-group row">
		<label id="elh_dm_pesertaecp_Sertifikasi_dimiliki" for="x_Sertifikasi_dimiliki" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Sertifikasi_dimiliki->caption() ?><?php echo $dm_pesertaecp_edit->Sertifikasi_dimiliki->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Sertifikasi_dimiliki->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Sertifikasi_dimiliki">
<input type="text" data-table="dm_pesertaecp" data-field="x_Sertifikasi_dimiliki" name="x_Sertifikasi_dimiliki" id="x_Sertifikasi_dimiliki" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Sertifikasi_dimiliki->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Sertifikasi_dimiliki->EditValue ?>"<?php echo $dm_pesertaecp_edit->Sertifikasi_dimiliki->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Sertifikasi_dimiliki->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Handphone->Visible) { // Handphone ?>
	<div id="r_Handphone" class="form-group row">
		<label id="elh_dm_pesertaecp_Handphone" for="x_Handphone" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Handphone->caption() ?><?php echo $dm_pesertaecp_edit->Handphone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Handphone->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Handphone">
<input type="text" data-table="dm_pesertaecp" data-field="x_Handphone" name="x_Handphone" id="x_Handphone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Handphone->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Handphone->EditValue ?>"<?php echo $dm_pesertaecp_edit->Handphone->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Handphone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Email_Add->Visible) { // Email_Add ?>
	<div id="r_Email_Add" class="form-group row">
		<label id="elh_dm_pesertaecp_Email_Add" for="x_Email_Add" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Email_Add->caption() ?><?php echo $dm_pesertaecp_edit->Email_Add->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Email_Add->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Email_Add">
<input type="text" data-table="dm_pesertaecp" data-field="x_Email_Add" name="x_Email_Add" id="x_Email_Add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Email_Add->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Email_Add->EditValue ?>"<?php echo $dm_pesertaecp_edit->Email_Add->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Email_Add->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Website->Visible) { // Website ?>
	<div id="r_Website" class="form-group row">
		<label id="elh_dm_pesertaecp_Website" for="x_Website" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Website->caption() ?><?php echo $dm_pesertaecp_edit->Website->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Website->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Website">
<input type="text" data-table="dm_pesertaecp" data-field="x_Website" name="x_Website" id="x_Website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Website->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Website->EditValue ?>"<?php echo $dm_pesertaecp_edit->Website->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Website->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Tahun_Berdiri->Visible) { // Tahun_Berdiri ?>
	<div id="r_Tahun_Berdiri" class="form-group row">
		<label id="elh_dm_pesertaecp_Tahun_Berdiri" for="x_Tahun_Berdiri" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Tahun_Berdiri->caption() ?><?php echo $dm_pesertaecp_edit->Tahun_Berdiri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Tahun_Berdiri->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Tahun_Berdiri">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_Berdiri" name="x_Tahun_Berdiri" id="x_Tahun_Berdiri" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Tahun_Berdiri->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Tahun_Berdiri->EditValue ?>"<?php echo $dm_pesertaecp_edit->Tahun_Berdiri->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Tahun_Berdiri->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Alamat_Produksi->Visible) { // Alamat_Produksi ?>
	<div id="r_Alamat_Produksi" class="form-group row">
		<label id="elh_dm_pesertaecp_Alamat_Produksi" for="x_Alamat_Produksi" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Alamat_Produksi->caption() ?><?php echo $dm_pesertaecp_edit->Alamat_Produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Alamat_Produksi->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Alamat_Produksi">
<textarea data-table="dm_pesertaecp" data-field="x_Alamat_Produksi" name="x_Alamat_Produksi" id="x_Alamat_Produksi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Alamat_Produksi->getPlaceHolder()) ?>"<?php echo $dm_pesertaecp_edit->Alamat_Produksi->editAttributes() ?>><?php echo $dm_pesertaecp_edit->Alamat_Produksi->EditValue ?></textarea>
</span>
<?php echo $dm_pesertaecp_edit->Alamat_Produksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<div id="r_Wilayah_ECP" class="form-group row">
		<label id="elh_dm_pesertaecp_Wilayah_ECP" for="x_Wilayah_ECP" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Wilayah_ECP->caption() ?><?php echo $dm_pesertaecp_edit->Wilayah_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Wilayah_ECP->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Wilayah_ECP">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_pesertaecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_pesertaecp_edit->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x_Wilayah_ECP" name="x_Wilayah_ECP"<?php echo $dm_pesertaecp_edit->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_pesertaecp_edit->Wilayah_ECP->selectOptionListHtml("x_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_pesertaecp_edit->Wilayah_ECP->Lookup->getParamTag($dm_pesertaecp_edit, "p_x_Wilayah_ECP") ?>
</span>
<?php echo $dm_pesertaecp_edit->Wilayah_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_edit->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<div id="r_Tahun_ECP" class="form-group row">
		<label id="elh_dm_pesertaecp_Tahun_ECP" for="x_Tahun_ECP" class="<?php echo $dm_pesertaecp_edit->LeftColumnClass ?>"><?php echo $dm_pesertaecp_edit->Tahun_ECP->caption() ?><?php echo $dm_pesertaecp_edit->Tahun_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_edit->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_edit->Tahun_ECP->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Tahun_ECP">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_ECP" name="x_Tahun_ECP" id="x_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_edit->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_edit->Tahun_ECP->EditValue ?>"<?php echo $dm_pesertaecp_edit->Tahun_ECP->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_edit->Tahun_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$dm_pesertaecp_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dm_pesertaecp_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dm_pesertaecp_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$dm_pesertaecp_edit->showPageFooter();
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
$dm_pesertaecp_edit->terminate();
?>