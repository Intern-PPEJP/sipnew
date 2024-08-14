<?php
namespace PHPMaker2020\ppei_20;

/**
 * Class for index
 */
class index
{

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Constructor
	public function __construct() {
		$this->CheckToken = Config("CHECK_TOKEN");
	}

	// Terminate page
	public function terminate($url = "")
	{

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Page Redirecting event
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url != "") {
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	//
	// Page run
	//

	public function run()
	{
		global $Language, $UserProfile, $Security, $Breadcrumb;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// User profile
		$UserProfile = new UserProfile();

		// Security object
		$Security = new AdvancedSecurity();
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Breadcrumb
		$Breadcrumb = new Breadcrumb();

		// If session expired, show session expired message
		if (Get("expired") == "1")
			$this->setFailureMessage($Language->phrase("SessionExpired"));
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level
		if ($Security->allowList(CurrentProjectID() . 'beranda.php'))
			$this->terminate("beranda.php"); // Exit and go to default page
		if ($Security->allowList(CurrentProjectID() . 't_agama'))
			$this->terminate("t_agamalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_bahasa'))
			$this->terminate("t_bahasalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_bidang'))
			$this->terminate("t_bidanglist.php");
		if ($Security->allowList(CurrentProjectID() . 't_export'))
			$this->terminate("t_exportlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_informasi'))
			$this->terminate("t_informasilist.php");
		if ($Security->allowList(CurrentProjectID() . 't_jabatan'))
			$this->terminate("t_jabatanlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_jenis'))
			$this->terminate("t_jenislist.php");
		if ($Security->allowList(CurrentProjectID() . 't_judul'))
			$this->terminate("t_judullist.php");
		if ($Security->allowList(CurrentProjectID() . 't_kategori'))
			$this->terminate("t_kategorilist.php");
		if ($Security->allowList(CurrentProjectID() . 't_kota'))
			$this->terminate("t_kotalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_lokasi'))
			$this->terminate("t_lokasilist.php");
		if ($Security->allowList(CurrentProjectID() . 't_negara'))
			$this->terminate("t_negaralist.php");
		if ($Security->allowList(CurrentProjectID() . 't_pelatihan'))
			$this->terminate("t_pelatihanlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_pendidikan'))
			$this->terminate("t_pendidikanlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_perusahaan'))
			$this->terminate("t_perusahaanlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_peserta'))
			$this->terminate("t_pesertalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_repeserta'))
			$this->terminate("t_repesertalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_produk'))
			$this->terminate("t_produklist.php");
		if ($Security->allowList(CurrentProjectID() . 't_produknafed'))
			$this->terminate("t_produknafedlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_prop'))
			$this->terminate("t_proplist.php");
		if ($Security->allowList(CurrentProjectID() . 't_skala'))
			$this->terminate("t_skalalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_users'))
			$this->terminate("t_userslist.php");
		if ($Security->allowList(CurrentProjectID() . 't_userlevelpermissions'))
			$this->terminate("t_userlevelpermissionslist.php");
		if ($Security->allowList(CurrentProjectID() . 't_userlevels'))
			$this->terminate("t_userlevelslist.php");
		if ($Security->allowList(CurrentProjectID() . 't_pegawai'))
			$this->terminate("t_pegawailist.php");
		if ($Security->allowList(CurrentProjectID() . 't_biointruktur'))
			$this->terminate("t_biointrukturlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_rwpekerjaan'))
			$this->terminate("t_rwpekerjaanlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_rwpendd'))
			$this->terminate("t_rwpenddlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_rwtraining'))
			$this->terminate("t_rwtraininglist.php");
		if ($Security->allowList(CurrentProjectID() . 't_juduldetail'))
			$this->terminate("t_juduldetaillist.php");
		if ($Security->allowList(CurrentProjectID() . 't_kurikulum'))
			$this->terminate("t_kurikulumlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_bagian'))
			$this->terminate("t_bagianlist.php");
		if ($Security->allowList(CurrentProjectID() . 'cv_historipelatihanpeserta'))
			$this->terminate("cv_historipelatihanpesertalist.php");
		if ($Security->allowList(CurrentProjectID() . 'cv_historipeserta'))
			$this->terminate("cv_historipesertalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_tahapan'))
			$this->terminate("t_tahapanlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_kec'))
			$this->terminate("t_keclist.php");
		if ($Security->allowList(CurrentProjectID() . 'cv_coachingprogram'))
			$this->terminate("cv_coachingprogramlist.php");
		if ($Security->allowList(CurrentProjectID() . 'cv_historiinstruktur'))
			$this->terminate("cv_historiinstrukturlist.php");
		if ($Security->allowList(CurrentProjectID() . 'cv_rwipelatihaninstruktur'))
			$this->terminate("cv_rwipelatihaninstrukturlist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_kerjasama'))
			$this->terminate("v_kerjasamalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_faskur'))
			$this->terminate("t_faskurlist.php");
		if ($Security->allowList(CurrentProjectID() . 'coba.php'))
			$this->terminate("coba.php");
		if ($Security->allowList(CurrentProjectID() . 'cv_pelrepes'))
			$this->terminate("cv_pelrepeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporanrealisasi.php'))
			$this->terminate("laporanrealisasi.php");
		if ($Security->allowList(CurrentProjectID() . 't_jadwalpel'))
			$this->terminate("t_jadwalpellist.php");
		if ($Security->allowList(CurrentProjectID() . 't_rpdiklat'))
			$this->terminate("t_rpdiklatlist.php");
		if ($Security->allowList(CurrentProjectID() . 'real_pengajar_internal'))
			$this->terminate("real_pengajar_internallist.php");
		if ($Security->allowList(CurrentProjectID() . 'real_keu_pelatihan'))
			$this->terminate("real_keu_pelatihanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'real_pst_jk'))
			$this->terminate("real_pst_jklist.php");
		if ($Security->allowList(CurrentProjectID() . 'petri'))
			$this->terminate("petrilist.php");
		if ($Security->allowList(CurrentProjectID() . 'real_prog'))
			$this->terminate("real_proglist.php");
		if ($Security->allowList(CurrentProjectID() . 't_rpkerjasama'))
			$this->terminate("t_rpkerjasamalist.php");
		if ($Security->allowList(CurrentProjectID() . 'diklatpusat'))
			$this->terminate("diklatpusatlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_area'))
			$this->terminate("t_arealist.php");
		if ($Security->allowList(CurrentProjectID() . 'diklatkerjasama'))
			$this->terminate("diklatkerjasamalist.php");
		if ($Security->allowList(CurrentProjectID() . 't_rkcoaching'))
			$this->terminate("t_rkcoachinglist.php");
		if ($Security->allowList(CurrentProjectID() . 't_coachingtahapan'))
			$this->terminate("t_coachingtahapanlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_cp'))
			$this->terminate("t_cplist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_rencanakerjasama'))
			$this->terminate("v_rencanakerjasamalist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_realuniv'))
			$this->terminate("v_realunivlist.php");
		if ($Security->allowList(CurrentProjectID() . 'customexport'))
			$this->terminate("customexportlist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_targetreal'))
			$this->terminate("v_targetreallist.php");
		if ($Security->allowList(CurrentProjectID() . 't_evaluasifas'))
			$this->terminate("t_evaluasifaslist.php");
		if ($Security->allowList(CurrentProjectID() . 'cv_jp'))
			$this->terminate("cv_jplist.php");
		if ($Security->allowList(CurrentProjectID() . 'realpengajar.php'))
			$this->terminate("realpengajar.php");
		if ($Security->allowList(CurrentProjectID() . 'realpelatihan.php'))
			$this->terminate("realpelatihan.php");
		if ($Security->allowList(CurrentProjectID() . 't_rkwebinar'))
			$this->terminate("t_rkwebinarlist.php");
		if ($Security->allowList(CurrentProjectID() . 'realpeserta.php'))
			$this->terminate("realpeserta.php");
		if ($Security->allowList(CurrentProjectID() . 'cv_pelatcpermonth'))
			$this->terminate("cv_pelatcpermonthlist.php");
		if ($Security->allowList(CurrentProjectID() . 'xprint'))
			$this->terminate("xprintlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_jdiklat'))
			$this->terminate("t_jdiklatlist.php");
		if ($Security->allowList(CurrentProjectID() . 'panitia_pelat'))
			$this->terminate("panitia_pelatlist.php");
		if ($Security->allowList(CurrentProjectID() . 'webinar'))
			$this->terminate("webinarlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_jadwalwebinar'))
			$this->terminate("t_jadwalwebinarlist.php");
		if ($Security->allowList(CurrentProjectID() . 't_pweb'))
			$this->terminate("t_pweblist.php");
		if ($Security->allowList(CurrentProjectID() . 'evaluasi'))
			$this->terminate("evaluasilist.php");
		if ($Security->isLoggedIn()) {
			$this->setFailureMessage(DeniedMessage() . "<br><br><a href=\"logout.php\">" . $Language->phrase("BackToLogin") . "</a>");
		} else {
			$this->terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>