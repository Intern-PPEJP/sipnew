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
$login = new login();

// Run the page
$login->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$login->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
loadjs.ready("head", function() {

	// Client script
});
</script>
	<style>
	body {
		background: #FFF !important;
	}
	.btn-primary {
		border-color: #af1a0e !important;
	}

	.ewToolbar, #ewHeaderRow, #ewFooterRow {
		display: none !important;
	}
</style>

<script>
var flogin;
loadjs.ready("head", function() {
	var flogin = new ew.Form("flogin");

	// Validate function
	flogin.validate = function() {
		var fobj = this._form;
		if (!this.validateRequired)
			return true; // Ignore validation
		if (!ew.hasValue(fobj.username))
			return this.onError(fobj.username, ew.language.phrase("EnterUid"));
		if (!ew.hasValue(fobj.password))
			return this.onError(fobj.password, ew.language.phrase("EnterPwd"));

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	flogin.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation
	flogin.validateRequired = <?php echo JsonEncode(Config("CLIENT_VALIDATE")) ?>;
	loadjs.done("flogin");
});
</script>

<style>
	body {
		background: url('images/bglogin.jpg') no-repeat center center fixed !important;
		background-size: cover;
		height: 100vh;
		width: 100%;
		margin: 0;
		padding: 0;
		display: flex; /* Menambahkan flexbox untuk pengaturan elemen */
		justify-content: center; 
		align-items: center; 
		padding-top: 160px;
		position: relative;
		background-attachment: fixed;
	}

	.login_wrapper {
	width: 100%; /* Agar form menyesuaikan ukuran dengan layar */
	max-width: 400px; /* Batas maksimal lebar form */
	align-items: center; 
	justify-content: center;
	position: relative; /* Tambahkan relative untuk memastikan card berada di atas */
    z-index: 2; /* Card berada di atas overlay */
	}
	
	.login-footer {
    text-align: center;
    margin-top: 20px;
    color: white;
    font-size: 15px;
	}

	.login-footer p {
    margin: 5px 0;
	}

	h2 {
    font-weight: bold; 
    text-align: center; 
    margin: 20px 0; /* Opsional: tambahkan jarak margin atas dan bawah */
	}

	.login-logo {
    margin-top: 25px; 
	margin-bottom: 0;
    text-align: center; 
	}

	.card {
		border-radius: 10px;
		align-items: center; 
		justify-content: center;
		background: white;
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
	}

	.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3); 
    z-index: 1; /* Nilai z-index lebih rendah dari card */
}
</style>

<body>
<div class="overlay"></div>
<form name="flogin" id="flogin" class="ew-form ew-login-form"  action="<?php echo CurrentPageName() ?>" method="post">
	<?php if ($Page->CheckToken) { ?>
	<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
	<?php } ?>
	<input type="hidden" name="modal" value="<?php echo (int)$login->IsModal ?>">
	<div class="ew-login-box login_wrapper">
	<?php
	$login->showMessage();
	?>

<div class="card">
	<div class="login-logo">
		<img src="images/Logo_Kementerian_Perdagangan_Republik_Indonesia.png" alt="" width="230px">
	</div>
	<div class="card-body login_content">
		<h2><?php echo $Language->projectPhrase("BodyTitle") ?></h2>
	<!--<p class="login-box-msg"><?php echo $Language->phrase("LoginMsg") ?></p>-->
	<div class="form-group row">
		<input type="text" name="username" id="username" autocomplete="username" class="form-control ew-control" value="<?php echo HtmlEncode($login->Username) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Username")) ?>">
	</div>
	<div class="form-group row">
		<div class="input-group flex-nowrap"><input type="password" name="password" id="password" autocomplete="current-password" class="form-control ew-control" placeholder="<?php echo HtmlEncode($Language->phrase("Password")) ?>">
		<div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div>
		</div>
	</div>
<?php if (!$login->IsModal) { ?>
	<center>
	<button class="btn btn-primary ew-btn" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("Login") ?></button>
	</center>
<?php } ?>
<?php

	// OAuth login
	$providers = Config("AUTH_CONFIG.providers");
	$cntProviders = 0;
	foreach ($providers as $id => $provider) {
		if ($provider["enabled"])
			$cntProviders++;
	}
	if ($cntProviders > 0) {
?>
	<div class="social-auth-links text-center mt-3">
		<p><?php echo $Language->phrase("LoginOr") ?></p>
<?php
		foreach ($providers as $id => $provider) {
			if ($provider["enabled"]) {
?>
			<a href="login.php?provider=<?php echo $id ?>" class="btn btn-block btn-<?php echo strtolower($provider["color"]) ?>"><i class="fab fa-<?php echo strtolower($id) ?> mr-2"></i><?php echo $Language->phrase("Login" . $id) ?></a>
<?php
			}
		}
?>
	</div>
<?php
	}
?>
<div class="social-auth-links text-center mt-3">
</div>
</div>
</div>
		<div class="login-footer">
            <p>Kementerian Perdagangan</p>
            <p>SISTEM INFORMASI PPEJP © <?php echo date("Y"); ?> All Rights Reserved.</p>
        </div>
</body>
</div>
</form>

<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your startup script here
	// console.log("page loaded");

});
</script>

<?php include_once "footer.php"; ?>
<?php
$login->terminate();
?>