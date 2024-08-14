<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_pcp_edit extends t_pcp
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_pcp';

	// Page object name
	public $PageObjName = "t_pcp_edit";

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

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

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (t_pcp)
		if (!isset($GLOBALS["t_pcp"]) || get_class($GLOBALS["t_pcp"]) == PROJECT_NAMESPACE . "t_pcp") {
			$GLOBALS["t_pcp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_pcp"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (excp)
		if (!isset($GLOBALS['excp']))
			$GLOBALS['excp'] = new excp();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_pcp');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (t_users)
		$UserTable = $UserTable ?: new t_users();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $t_pcp;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_pcp);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "t_pcpview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
		$this->f_npwp->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_npwp->UploadPath = $this->f_npwp->OldUploadPath;
		$this->f_nib->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_nib->UploadPath = $this->f_nib->OldUploadPath;
		$this->f_siup->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_siup->UploadPath = $this->f_siup->OldUploadPath;
		$this->f_tdp->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_tdp->UploadPath = $this->f_tdp->OldUploadPath;
		$this->f_lain->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_lain->UploadPath = $this->f_lain->OldUploadPath;
		$this->f_sertifikat->OldUploadPath = "berkas/sertifikat_ecp/";
		$this->f_sertifikat->UploadPath = $this->f_sertifikat->OldUploadPath;
		$this->f_kartunama->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_kartunama->UploadPath = $this->f_kartunama->OldUploadPath;
		$this->f_brosur->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_brosur->UploadPath = $this->f_brosur->OldUploadPath;
		$this->f_katalog->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_katalog->UploadPath = $this->f_katalog->OldUploadPath;
		$this->f_profile->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_profile->UploadPath = $this->f_profile->OldUploadPath;
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $MultiPages; // Multi pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canEdit()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_pcplist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->rkid->Visible = FALSE;
		$this->nama_peserta->setVisibility();
		$this->email_add->setVisibility();
		$this->handphone->setVisibility();
		$this->namap->setVisibility();
		$this->tahun_berdiri->setVisibility();
		$this->alamat->setVisibility();
		$this->alamat_prod->setVisibility();
		$this->kategori_produk->setVisibility();
		$this->kategori_produk2->setVisibility();
		$this->kategori_produk3->setVisibility();
		$this->produk->setVisibility();
		$this->merek_dagang->setVisibility();
		$this->jenis_perusahaan->setVisibility();
		$this->kapasitas_produksi->setVisibility();
		$this->omset->setVisibility();
		$this->website->setVisibility();
		$this->fb->setVisibility();
		$this->ig->setVisibility();
		$this->sosmed_lain->setVisibility();
		$this->jml_pegawai->setVisibility();
		$this->jml_pegawai2->setVisibility();
		$this->jml_pegawai_tidaktetap->setVisibility();
		$this->legalitas->setVisibility();
		$this->legalitas_lain->setVisibility();
		$this->f_npwp->setVisibility();
		$this->f_nib->setVisibility();
		$this->f_siup->setVisibility();
		$this->f_tdp->setVisibility();
		$this->f_lain->setVisibility();
		$this->sertifikat->setVisibility();
		$this->sertifikat_lain->setVisibility();
		$this->f_sertifikat->setVisibility();
		$this->alat_promosi->setVisibility();
		$this->promosi_lain->setVisibility();
		$this->f_kartunama->setVisibility();
		$this->f_brosur->setVisibility();
		$this->f_katalog->setVisibility();
		$this->f_profile->setVisibility();
		$this->tahun_ecp->setVisibility();
		$this->wilayah_ecp->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up multi page object
		$this->setupMultiPages();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->namap);
		$this->setupLookupOptions($this->kategori_produk);
		$this->setupLookupOptions($this->kategori_produk2);
		$this->setupLookupOptions($this->kategori_produk3);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_pcplist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->id->setOldValue($this->id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id->setQueryStringValue(Route(2));
				$this->id->setOldValue($this->id->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_id")) {
					$this->id->setFormValue($CurrentForm->getValue("x_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id") !== NULL) {
					$this->id->setQueryStringValue(Get("id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id->CurrentValue = NULL;
				}
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("t_pcplist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_pcplist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->f_npwp->Upload->Index = $CurrentForm->Index;
		$this->f_npwp->Upload->uploadFile();
		$this->f_npwp->CurrentValue = $this->f_npwp->Upload->FileName;
		$this->f_nib->Upload->Index = $CurrentForm->Index;
		$this->f_nib->Upload->uploadFile();
		$this->f_nib->CurrentValue = $this->f_nib->Upload->FileName;
		$this->f_siup->Upload->Index = $CurrentForm->Index;
		$this->f_siup->Upload->uploadFile();
		$this->f_siup->CurrentValue = $this->f_siup->Upload->FileName;
		$this->f_tdp->Upload->Index = $CurrentForm->Index;
		$this->f_tdp->Upload->uploadFile();
		$this->f_tdp->CurrentValue = $this->f_tdp->Upload->FileName;
		$this->f_lain->Upload->Index = $CurrentForm->Index;
		$this->f_lain->Upload->uploadFile();
		$this->f_lain->CurrentValue = $this->f_lain->Upload->FileName;
		$this->f_sertifikat->Upload->Index = $CurrentForm->Index;
		$this->f_sertifikat->Upload->uploadFile();
		$this->f_sertifikat->CurrentValue = $this->f_sertifikat->Upload->FileName;
		$this->f_kartunama->Upload->Index = $CurrentForm->Index;
		$this->f_kartunama->Upload->uploadFile();
		$this->f_kartunama->CurrentValue = $this->f_kartunama->Upload->FileName;
		$this->f_brosur->Upload->Index = $CurrentForm->Index;
		$this->f_brosur->Upload->uploadFile();
		$this->f_brosur->CurrentValue = $this->f_brosur->Upload->FileName;
		$this->f_katalog->Upload->Index = $CurrentForm->Index;
		$this->f_katalog->Upload->uploadFile();
		$this->f_katalog->CurrentValue = $this->f_katalog->Upload->FileName;
		$this->f_profile->Upload->Index = $CurrentForm->Index;
		$this->f_profile->Upload->uploadFile();
		$this->f_profile->CurrentValue = $this->f_profile->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'nama_peserta' first before field var 'x_nama_peserta'
		$val = $CurrentForm->hasValue("nama_peserta") ? $CurrentForm->getValue("nama_peserta") : $CurrentForm->getValue("x_nama_peserta");
		if (!$this->nama_peserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nama_peserta->Visible = FALSE; // Disable update for API request
			else
				$this->nama_peserta->setFormValue($val);
		}

		// Check field name 'email_add' first before field var 'x_email_add'
		$val = $CurrentForm->hasValue("email_add") ? $CurrentForm->getValue("email_add") : $CurrentForm->getValue("x_email_add");
		if (!$this->email_add->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->email_add->Visible = FALSE; // Disable update for API request
			else
				$this->email_add->setFormValue($val);
		}

		// Check field name 'handphone' first before field var 'x_handphone'
		$val = $CurrentForm->hasValue("handphone") ? $CurrentForm->getValue("handphone") : $CurrentForm->getValue("x_handphone");
		if (!$this->handphone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->handphone->Visible = FALSE; // Disable update for API request
			else
				$this->handphone->setFormValue($val);
		}

		// Check field name 'namap' first before field var 'x_namap'
		$val = $CurrentForm->hasValue("namap") ? $CurrentForm->getValue("namap") : $CurrentForm->getValue("x_namap");
		if (!$this->namap->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->namap->Visible = FALSE; // Disable update for API request
			else
				$this->namap->setFormValue($val);
		}

		// Check field name 'tahun_berdiri' first before field var 'x_tahun_berdiri'
		$val = $CurrentForm->hasValue("tahun_berdiri") ? $CurrentForm->getValue("tahun_berdiri") : $CurrentForm->getValue("x_tahun_berdiri");
		if (!$this->tahun_berdiri->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tahun_berdiri->Visible = FALSE; // Disable update for API request
			else
				$this->tahun_berdiri->setFormValue($val);
		}

		// Check field name 'alamat' first before field var 'x_alamat'
		$val = $CurrentForm->hasValue("alamat") ? $CurrentForm->getValue("alamat") : $CurrentForm->getValue("x_alamat");
		if (!$this->alamat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alamat->Visible = FALSE; // Disable update for API request
			else
				$this->alamat->setFormValue($val);
		}

		// Check field name 'alamat_prod' first before field var 'x_alamat_prod'
		$val = $CurrentForm->hasValue("alamat_prod") ? $CurrentForm->getValue("alamat_prod") : $CurrentForm->getValue("x_alamat_prod");
		if (!$this->alamat_prod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alamat_prod->Visible = FALSE; // Disable update for API request
			else
				$this->alamat_prod->setFormValue($val);
		}

		// Check field name 'kategori_produk' first before field var 'x_kategori_produk'
		$val = $CurrentForm->hasValue("kategori_produk") ? $CurrentForm->getValue("kategori_produk") : $CurrentForm->getValue("x_kategori_produk");
		if (!$this->kategori_produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kategori_produk->Visible = FALSE; // Disable update for API request
			else
				$this->kategori_produk->setFormValue($val);
		}

		// Check field name 'kategori_produk2' first before field var 'x_kategori_produk2'
		$val = $CurrentForm->hasValue("kategori_produk2") ? $CurrentForm->getValue("kategori_produk2") : $CurrentForm->getValue("x_kategori_produk2");
		if (!$this->kategori_produk2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kategori_produk2->Visible = FALSE; // Disable update for API request
			else
				$this->kategori_produk2->setFormValue($val);
		}

		// Check field name 'kategori_produk3' first before field var 'x_kategori_produk3'
		$val = $CurrentForm->hasValue("kategori_produk3") ? $CurrentForm->getValue("kategori_produk3") : $CurrentForm->getValue("x_kategori_produk3");
		if (!$this->kategori_produk3->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kategori_produk3->Visible = FALSE; // Disable update for API request
			else
				$this->kategori_produk3->setFormValue($val);
		}

		// Check field name 'produk' first before field var 'x_produk'
		$val = $CurrentForm->hasValue("produk") ? $CurrentForm->getValue("produk") : $CurrentForm->getValue("x_produk");
		if (!$this->produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->produk->Visible = FALSE; // Disable update for API request
			else
				$this->produk->setFormValue($val);
		}

		// Check field name 'merek_dagang' first before field var 'x_merek_dagang'
		$val = $CurrentForm->hasValue("merek_dagang") ? $CurrentForm->getValue("merek_dagang") : $CurrentForm->getValue("x_merek_dagang");
		if (!$this->merek_dagang->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->merek_dagang->Visible = FALSE; // Disable update for API request
			else
				$this->merek_dagang->setFormValue($val);
		}

		// Check field name 'jenis_perusahaan' first before field var 'x_jenis_perusahaan'
		$val = $CurrentForm->hasValue("jenis_perusahaan") ? $CurrentForm->getValue("jenis_perusahaan") : $CurrentForm->getValue("x_jenis_perusahaan");
		if (!$this->jenis_perusahaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenis_perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->jenis_perusahaan->setFormValue($val);
		}

		// Check field name 'kapasitas_produksi' first before field var 'x_kapasitas_produksi'
		$val = $CurrentForm->hasValue("kapasitas_produksi") ? $CurrentForm->getValue("kapasitas_produksi") : $CurrentForm->getValue("x_kapasitas_produksi");
		if (!$this->kapasitas_produksi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kapasitas_produksi->Visible = FALSE; // Disable update for API request
			else
				$this->kapasitas_produksi->setFormValue($val);
		}

		// Check field name 'omset' first before field var 'x_omset'
		$val = $CurrentForm->hasValue("omset") ? $CurrentForm->getValue("omset") : $CurrentForm->getValue("x_omset");
		if (!$this->omset->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->omset->Visible = FALSE; // Disable update for API request
			else
				$this->omset->setFormValue($val);
		}

		// Check field name 'website' first before field var 'x_website'
		$val = $CurrentForm->hasValue("website") ? $CurrentForm->getValue("website") : $CurrentForm->getValue("x_website");
		if (!$this->website->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->website->Visible = FALSE; // Disable update for API request
			else
				$this->website->setFormValue($val);
		}

		// Check field name 'fb' first before field var 'x_fb'
		$val = $CurrentForm->hasValue("fb") ? $CurrentForm->getValue("fb") : $CurrentForm->getValue("x_fb");
		if (!$this->fb->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->fb->Visible = FALSE; // Disable update for API request
			else
				$this->fb->setFormValue($val);
		}

		// Check field name 'ig' first before field var 'x_ig'
		$val = $CurrentForm->hasValue("ig") ? $CurrentForm->getValue("ig") : $CurrentForm->getValue("x_ig");
		if (!$this->ig->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ig->Visible = FALSE; // Disable update for API request
			else
				$this->ig->setFormValue($val);
		}

		// Check field name 'sosmed_lain' first before field var 'x_sosmed_lain'
		$val = $CurrentForm->hasValue("sosmed_lain") ? $CurrentForm->getValue("sosmed_lain") : $CurrentForm->getValue("x_sosmed_lain");
		if (!$this->sosmed_lain->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sosmed_lain->Visible = FALSE; // Disable update for API request
			else
				$this->sosmed_lain->setFormValue($val);
		}

		// Check field name 'jml_pegawai' first before field var 'x_jml_pegawai'
		$val = $CurrentForm->hasValue("jml_pegawai") ? $CurrentForm->getValue("jml_pegawai") : $CurrentForm->getValue("x_jml_pegawai");
		if (!$this->jml_pegawai->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->jml_pegawai->setFormValue($val);
		}

		// Check field name 'jml_pegawai2' first before field var 'x_jml_pegawai2'
		$val = $CurrentForm->hasValue("jml_pegawai2") ? $CurrentForm->getValue("jml_pegawai2") : $CurrentForm->getValue("x_jml_pegawai2");
		if (!$this->jml_pegawai2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_pegawai2->Visible = FALSE; // Disable update for API request
			else
				$this->jml_pegawai2->setFormValue($val);
		}

		// Check field name 'jml_pegawai_tidaktetap' first before field var 'x_jml_pegawai_tidaktetap'
		$val = $CurrentForm->hasValue("jml_pegawai_tidaktetap") ? $CurrentForm->getValue("jml_pegawai_tidaktetap") : $CurrentForm->getValue("x_jml_pegawai_tidaktetap");
		if (!$this->jml_pegawai_tidaktetap->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_pegawai_tidaktetap->Visible = FALSE; // Disable update for API request
			else
				$this->jml_pegawai_tidaktetap->setFormValue($val);
		}

		// Check field name 'legalitas' first before field var 'x_legalitas'
		$val = $CurrentForm->hasValue("legalitas") ? $CurrentForm->getValue("legalitas") : $CurrentForm->getValue("x_legalitas");
		if (!$this->legalitas->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->legalitas->Visible = FALSE; // Disable update for API request
			else
				$this->legalitas->setFormValue($val);
		}

		// Check field name 'legalitas_lain' first before field var 'x_legalitas_lain'
		$val = $CurrentForm->hasValue("legalitas_lain") ? $CurrentForm->getValue("legalitas_lain") : $CurrentForm->getValue("x_legalitas_lain");
		if (!$this->legalitas_lain->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->legalitas_lain->Visible = FALSE; // Disable update for API request
			else
				$this->legalitas_lain->setFormValue($val);
		}

		// Check field name 'sertifikat' first before field var 'x_sertifikat'
		$val = $CurrentForm->hasValue("sertifikat") ? $CurrentForm->getValue("sertifikat") : $CurrentForm->getValue("x_sertifikat");
		if (!$this->sertifikat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sertifikat->Visible = FALSE; // Disable update for API request
			else
				$this->sertifikat->setFormValue($val);
		}

		// Check field name 'sertifikat_lain' first before field var 'x_sertifikat_lain'
		$val = $CurrentForm->hasValue("sertifikat_lain") ? $CurrentForm->getValue("sertifikat_lain") : $CurrentForm->getValue("x_sertifikat_lain");
		if (!$this->sertifikat_lain->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sertifikat_lain->Visible = FALSE; // Disable update for API request
			else
				$this->sertifikat_lain->setFormValue($val);
		}

		// Check field name 'alat_promosi' first before field var 'x_alat_promosi'
		$val = $CurrentForm->hasValue("alat_promosi") ? $CurrentForm->getValue("alat_promosi") : $CurrentForm->getValue("x_alat_promosi");
		if (!$this->alat_promosi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alat_promosi->Visible = FALSE; // Disable update for API request
			else
				$this->alat_promosi->setFormValue($val);
		}

		// Check field name 'promosi_lain' first before field var 'x_promosi_lain'
		$val = $CurrentForm->hasValue("promosi_lain") ? $CurrentForm->getValue("promosi_lain") : $CurrentForm->getValue("x_promosi_lain");
		if (!$this->promosi_lain->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->promosi_lain->Visible = FALSE; // Disable update for API request
			else
				$this->promosi_lain->setFormValue($val);
		}

		// Check field name 'tahun_ecp' first before field var 'x_tahun_ecp'
		$val = $CurrentForm->hasValue("tahun_ecp") ? $CurrentForm->getValue("tahun_ecp") : $CurrentForm->getValue("x_tahun_ecp");
		if (!$this->tahun_ecp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tahun_ecp->Visible = FALSE; // Disable update for API request
			else
				$this->tahun_ecp->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->nama_peserta->CurrentValue = $this->nama_peserta->FormValue;
		$this->email_add->CurrentValue = $this->email_add->FormValue;
		$this->handphone->CurrentValue = $this->handphone->FormValue;
		$this->namap->CurrentValue = $this->namap->FormValue;
		$this->tahun_berdiri->CurrentValue = $this->tahun_berdiri->FormValue;
		$this->alamat->CurrentValue = $this->alamat->FormValue;
		$this->alamat_prod->CurrentValue = $this->alamat_prod->FormValue;
		$this->kategori_produk->CurrentValue = $this->kategori_produk->FormValue;
		$this->kategori_produk2->CurrentValue = $this->kategori_produk2->FormValue;
		$this->kategori_produk3->CurrentValue = $this->kategori_produk3->FormValue;
		$this->produk->CurrentValue = $this->produk->FormValue;
		$this->merek_dagang->CurrentValue = $this->merek_dagang->FormValue;
		$this->jenis_perusahaan->CurrentValue = $this->jenis_perusahaan->FormValue;
		$this->kapasitas_produksi->CurrentValue = $this->kapasitas_produksi->FormValue;
		$this->omset->CurrentValue = $this->omset->FormValue;
		$this->website->CurrentValue = $this->website->FormValue;
		$this->fb->CurrentValue = $this->fb->FormValue;
		$this->ig->CurrentValue = $this->ig->FormValue;
		$this->sosmed_lain->CurrentValue = $this->sosmed_lain->FormValue;
		$this->jml_pegawai->CurrentValue = $this->jml_pegawai->FormValue;
		$this->jml_pegawai2->CurrentValue = $this->jml_pegawai2->FormValue;
		$this->jml_pegawai_tidaktetap->CurrentValue = $this->jml_pegawai_tidaktetap->FormValue;
		$this->legalitas->CurrentValue = $this->legalitas->FormValue;
		$this->legalitas_lain->CurrentValue = $this->legalitas_lain->FormValue;
		$this->sertifikat->CurrentValue = $this->sertifikat->FormValue;
		$this->sertifikat_lain->CurrentValue = $this->sertifikat_lain->FormValue;
		$this->alat_promosi->CurrentValue = $this->alat_promosi->FormValue;
		$this->promosi_lain->CurrentValue = $this->promosi_lain->FormValue;
		$this->tahun_ecp->CurrentValue = $this->tahun_ecp->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->rkid->setDbValue($row['rkid']);
		$this->nama_peserta->setDbValue($row['nama_peserta']);
		$this->email_add->setDbValue($row['email_add']);
		$this->handphone->setDbValue($row['handphone']);
		$this->namap->setDbValue($row['namap']);
		$this->tahun_berdiri->setDbValue($row['tahun_berdiri']);
		$this->alamat->setDbValue($row['alamat']);
		$this->alamat_prod->setDbValue($row['alamat_prod']);
		$this->kategori_produk->setDbValue($row['kategori_produk']);
		$this->kategori_produk2->setDbValue($row['kategori_produk2']);
		$this->kategori_produk3->setDbValue($row['kategori_produk3']);
		$this->produk->setDbValue($row['produk']);
		$this->merek_dagang->setDbValue($row['merek_dagang']);
		$this->jenis_perusahaan->setDbValue($row['jenis_perusahaan']);
		$this->kapasitas_produksi->setDbValue($row['kapasitas_produksi']);
		$this->omset->setDbValue($row['omset']);
		$this->website->setDbValue($row['website']);
		$this->fb->setDbValue($row['fb']);
		$this->ig->setDbValue($row['ig']);
		$this->sosmed_lain->setDbValue($row['sosmed_lain']);
		$this->jml_pegawai->setDbValue($row['jml_pegawai']);
		$this->jml_pegawai2->setDbValue($row['jml_pegawai2']);
		$this->jml_pegawai_tidaktetap->setDbValue($row['jml_pegawai_tidaktetap']);
		$this->legalitas->setDbValue($row['legalitas']);
		$this->legalitas_lain->setDbValue($row['legalitas_lain']);
		$this->f_npwp->Upload->DbValue = $row['f_npwp'];
		$this->f_npwp->setDbValue($this->f_npwp->Upload->DbValue);
		$this->f_nib->Upload->DbValue = $row['f_nib'];
		$this->f_nib->setDbValue($this->f_nib->Upload->DbValue);
		$this->f_siup->Upload->DbValue = $row['f_siup'];
		$this->f_siup->setDbValue($this->f_siup->Upload->DbValue);
		$this->f_tdp->Upload->DbValue = $row['f_tdp'];
		$this->f_tdp->setDbValue($this->f_tdp->Upload->DbValue);
		$this->f_lain->Upload->DbValue = $row['f_lain'];
		$this->f_lain->setDbValue($this->f_lain->Upload->DbValue);
		$this->sertifikat->setDbValue($row['sertifikat']);
		$this->sertifikat_lain->setDbValue($row['sertifikat_lain']);
		$this->f_sertifikat->Upload->DbValue = $row['f_sertifikat'];
		$this->f_sertifikat->setDbValue($this->f_sertifikat->Upload->DbValue);
		$this->alat_promosi->setDbValue($row['alat_promosi']);
		$this->promosi_lain->setDbValue($row['promosi_lain']);
		$this->f_kartunama->Upload->DbValue = $row['f_kartunama'];
		$this->f_kartunama->setDbValue($this->f_kartunama->Upload->DbValue);
		$this->f_brosur->Upload->DbValue = $row['f_brosur'];
		$this->f_brosur->setDbValue($this->f_brosur->Upload->DbValue);
		$this->f_katalog->Upload->DbValue = $row['f_katalog'];
		$this->f_katalog->setDbValue($this->f_katalog->Upload->DbValue);
		$this->f_profile->Upload->DbValue = $row['f_profile'];
		$this->f_profile->setDbValue($this->f_profile->Upload->DbValue);
		$this->tahun_ecp->setDbValue($row['tahun_ecp']);
		$this->wilayah_ecp->setDbValue($row['wilayah_ecp']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['rkid'] = NULL;
		$row['nama_peserta'] = NULL;
		$row['email_add'] = NULL;
		$row['handphone'] = NULL;
		$row['namap'] = NULL;
		$row['tahun_berdiri'] = NULL;
		$row['alamat'] = NULL;
		$row['alamat_prod'] = NULL;
		$row['kategori_produk'] = NULL;
		$row['kategori_produk2'] = NULL;
		$row['kategori_produk3'] = NULL;
		$row['produk'] = NULL;
		$row['merek_dagang'] = NULL;
		$row['jenis_perusahaan'] = NULL;
		$row['kapasitas_produksi'] = NULL;
		$row['omset'] = NULL;
		$row['website'] = NULL;
		$row['fb'] = NULL;
		$row['ig'] = NULL;
		$row['sosmed_lain'] = NULL;
		$row['jml_pegawai'] = NULL;
		$row['jml_pegawai2'] = NULL;
		$row['jml_pegawai_tidaktetap'] = NULL;
		$row['legalitas'] = NULL;
		$row['legalitas_lain'] = NULL;
		$row['f_npwp'] = NULL;
		$row['f_nib'] = NULL;
		$row['f_siup'] = NULL;
		$row['f_tdp'] = NULL;
		$row['f_lain'] = NULL;
		$row['sertifikat'] = NULL;
		$row['sertifikat_lain'] = NULL;
		$row['f_sertifikat'] = NULL;
		$row['alat_promosi'] = NULL;
		$row['promosi_lain'] = NULL;
		$row['f_kartunama'] = NULL;
		$row['f_brosur'] = NULL;
		$row['f_katalog'] = NULL;
		$row['f_profile'] = NULL;
		$row['tahun_ecp'] = NULL;
		$row['wilayah_ecp'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// rkid
		// nama_peserta
		// email_add
		// handphone
		// namap
		// tahun_berdiri
		// alamat
		// alamat_prod
		// kategori_produk
		// kategori_produk2
		// kategori_produk3
		// produk
		// merek_dagang
		// jenis_perusahaan
		// kapasitas_produksi
		// omset
		// website
		// fb
		// ig
		// sosmed_lain
		// jml_pegawai
		// jml_pegawai2
		// jml_pegawai_tidaktetap
		// legalitas
		// legalitas_lain
		// f_npwp
		// f_nib
		// f_siup
		// f_tdp
		// f_lain
		// sertifikat
		// sertifikat_lain
		// f_sertifikat
		// alat_promosi
		// promosi_lain
		// f_kartunama
		// f_brosur
		// f_katalog
		// f_profile
		// tahun_ecp
		// wilayah_ecp

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// rkid
			$this->rkid->ViewValue = $this->rkid->CurrentValue;
			$this->rkid->ViewValue = FormatNumber($this->rkid->ViewValue, 0, -2, -2, -2);
			$this->rkid->ViewCustomAttributes = "";

			// nama_peserta
			$this->nama_peserta->ViewValue = $this->nama_peserta->CurrentValue;
			$this->nama_peserta->ViewCustomAttributes = "";

			// email_add
			$this->email_add->ViewValue = $this->email_add->CurrentValue;
			$this->email_add->ViewCustomAttributes = "";

			// handphone
			$this->handphone->ViewValue = $this->handphone->CurrentValue;
			$this->handphone->ViewCustomAttributes = "";

			// namap
			$this->namap->ViewValue = $this->namap->CurrentValue;
			$arwrk = [];
			$arwrk[1] = $this->namap->CurrentValue;
			$this->namap->ViewValue = $this->namap->displayValue($arwrk);
			$this->namap->ViewCustomAttributes = "";

			// tahun_berdiri
			$this->tahun_berdiri->ViewValue = $this->tahun_berdiri->CurrentValue;
			$this->tahun_berdiri->ViewValue = FormatNumber($this->tahun_berdiri->ViewValue, 0, -2, -2, -2);
			$this->tahun_berdiri->ViewCustomAttributes = "";

			// alamat
			$this->alamat->ViewValue = $this->alamat->CurrentValue;
			$this->alamat->ViewCustomAttributes = "";

			// alamat_prod
			$this->alamat_prod->ViewValue = $this->alamat_prod->CurrentValue;
			$this->alamat_prod->ViewCustomAttributes = "";

			// kategori_produk
			$curVal = strval($this->kategori_produk->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk->ViewValue = $this->kategori_produk->lookupCacheOption($curVal);
				if ($this->kategori_produk->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk->ViewValue = $this->kategori_produk->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk->ViewValue = $this->kategori_produk->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk->ViewValue = NULL;
			}
			$this->kategori_produk->ViewCustomAttributes = "";

			// kategori_produk2
			$curVal = strval($this->kategori_produk2->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->lookupCacheOption($curVal);
				if ($this->kategori_produk2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk2->ViewValue = $this->kategori_produk2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk2->ViewValue = $this->kategori_produk2->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk2->ViewValue = NULL;
			}
			$this->kategori_produk2->ViewCustomAttributes = "";

			// kategori_produk3
			$curVal = strval($this->kategori_produk3->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->lookupCacheOption($curVal);
				if ($this->kategori_produk3->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk3->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk3->ViewValue = $this->kategori_produk3->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk3->ViewValue = $this->kategori_produk3->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk3->ViewValue = NULL;
			}
			$this->kategori_produk3->ViewCustomAttributes = "";

			// produk
			$this->produk->ViewValue = $this->produk->CurrentValue;
			$this->produk->ViewCustomAttributes = "";

			// merek_dagang
			$this->merek_dagang->ViewValue = $this->merek_dagang->CurrentValue;
			$this->merek_dagang->ViewCustomAttributes = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->ViewValue = $this->jenis_perusahaan->CurrentValue;
			$this->jenis_perusahaan->ViewCustomAttributes = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->ViewValue = $this->kapasitas_produksi->CurrentValue;
			$this->kapasitas_produksi->ViewCustomAttributes = "";

			// omset
			$this->omset->ViewValue = $this->omset->CurrentValue;
			$this->omset->ViewCustomAttributes = "";

			// website
			$this->website->ViewValue = $this->website->CurrentValue;
			$this->website->ViewCustomAttributes = "";

			// fb
			$this->fb->ViewValue = $this->fb->CurrentValue;
			$this->fb->ViewCustomAttributes = "";

			// ig
			$this->ig->ViewValue = $this->ig->CurrentValue;
			$this->ig->ViewCustomAttributes = "";

			// sosmed_lain
			$this->sosmed_lain->ViewValue = $this->sosmed_lain->CurrentValue;
			$this->sosmed_lain->ViewCustomAttributes = "";

			// jml_pegawai
			if (strval($this->jml_pegawai->CurrentValue) != "") {
				$this->jml_pegawai->ViewValue = $this->jml_pegawai->optionCaption($this->jml_pegawai->CurrentValue);
			} else {
				$this->jml_pegawai->ViewValue = NULL;
			}
			$this->jml_pegawai->ViewCustomAttributes = "";

			// jml_pegawai2
			$this->jml_pegawai2->ViewValue = $this->jml_pegawai2->CurrentValue;
			$this->jml_pegawai2->ViewCustomAttributes = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->ViewValue = $this->jml_pegawai_tidaktetap->CurrentValue;
			$this->jml_pegawai_tidaktetap->ViewCustomAttributes = "";

			// legalitas
			if (strval($this->legalitas->CurrentValue) != "") {
				$this->legalitas->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->legalitas->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->legalitas->ViewValue->add($this->legalitas->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->legalitas->ViewValue = NULL;
			}
			$this->legalitas->ViewCustomAttributes = "";

			// legalitas_lain
			$this->legalitas_lain->ViewValue = $this->legalitas_lain->CurrentValue;
			$this->legalitas_lain->ViewCustomAttributes = "";

			// f_npwp
			$this->f_npwp->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_npwp->Upload->DbValue)) {
				$this->f_npwp->ViewValue = $this->f_npwp->Upload->DbValue;
			} else {
				$this->f_npwp->ViewValue = "";
			}
			$this->f_npwp->ViewCustomAttributes = "";

			// f_nib
			$this->f_nib->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_nib->Upload->DbValue)) {
				$this->f_nib->ViewValue = $this->f_nib->Upload->DbValue;
			} else {
				$this->f_nib->ViewValue = "";
			}
			$this->f_nib->ViewCustomAttributes = "";

			// f_siup
			$this->f_siup->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_siup->Upload->DbValue)) {
				$this->f_siup->ViewValue = $this->f_siup->Upload->DbValue;
			} else {
				$this->f_siup->ViewValue = "";
			}
			$this->f_siup->ViewCustomAttributes = "";

			// f_tdp
			$this->f_tdp->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_tdp->Upload->DbValue)) {
				$this->f_tdp->ViewValue = $this->f_tdp->Upload->DbValue;
			} else {
				$this->f_tdp->ViewValue = "";
			}
			$this->f_tdp->ViewCustomAttributes = "";

			// f_lain
			$this->f_lain->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_lain->Upload->DbValue)) {
				$this->f_lain->ViewValue = $this->f_lain->Upload->DbValue;
			} else {
				$this->f_lain->ViewValue = "";
			}
			$this->f_lain->ViewCustomAttributes = "";

			// sertifikat
			if (strval($this->sertifikat->CurrentValue) != "") {
				$this->sertifikat->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->sertifikat->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->sertifikat->ViewValue->add($this->sertifikat->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->sertifikat->ViewValue = NULL;
			}
			$this->sertifikat->ViewCustomAttributes = "";

			// sertifikat_lain
			$this->sertifikat_lain->ViewValue = $this->sertifikat_lain->CurrentValue;
			$this->sertifikat_lain->ViewCustomAttributes = "";

			// f_sertifikat
			$this->f_sertifikat->UploadPath = "berkas/sertifikat_ecp/";
			if (!EmptyValue($this->f_sertifikat->Upload->DbValue)) {
				$this->f_sertifikat->ViewValue = $this->f_sertifikat->Upload->DbValue;
			} else {
				$this->f_sertifikat->ViewValue = "";
			}
			$this->f_sertifikat->ViewCustomAttributes = "";

			// alat_promosi
			if (strval($this->alat_promosi->CurrentValue) != "") {
				$this->alat_promosi->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->alat_promosi->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->alat_promosi->ViewValue->add($this->alat_promosi->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->alat_promosi->ViewValue = NULL;
			}
			$this->alat_promosi->ViewCustomAttributes = "";

			// promosi_lain
			$this->promosi_lain->ViewValue = $this->promosi_lain->CurrentValue;
			$this->promosi_lain->ViewCustomAttributes = "";

			// f_kartunama
			$this->f_kartunama->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_kartunama->Upload->DbValue)) {
				$this->f_kartunama->ViewValue = $this->f_kartunama->Upload->DbValue;
			} else {
				$this->f_kartunama->ViewValue = "";
			}
			$this->f_kartunama->ViewCustomAttributes = "";

			// f_brosur
			$this->f_brosur->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_brosur->Upload->DbValue)) {
				$this->f_brosur->ViewValue = $this->f_brosur->Upload->DbValue;
			} else {
				$this->f_brosur->ViewValue = "";
			}
			$this->f_brosur->ViewCustomAttributes = "";

			// f_katalog
			$this->f_katalog->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_katalog->Upload->DbValue)) {
				$this->f_katalog->ViewValue = $this->f_katalog->Upload->DbValue;
			} else {
				$this->f_katalog->ViewValue = "";
			}
			$this->f_katalog->ViewCustomAttributes = "";

			// f_profile
			$this->f_profile->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_profile->Upload->DbValue)) {
				$this->f_profile->ViewValue = $this->f_profile->Upload->DbValue;
			} else {
				$this->f_profile->ViewValue = "";
			}
			$this->f_profile->ViewCustomAttributes = "";

			// tahun_ecp
			$this->tahun_ecp->ViewValue = $this->tahun_ecp->CurrentValue;
			$this->tahun_ecp->ViewCustomAttributes = "";

			// wilayah_ecp
			$this->wilayah_ecp->ViewValue = $this->wilayah_ecp->CurrentValue;
			$this->wilayah_ecp->ViewCustomAttributes = "";

			// nama_peserta
			$this->nama_peserta->LinkCustomAttributes = "";
			$this->nama_peserta->HrefValue = "";
			$this->nama_peserta->TooltipValue = "";

			// email_add
			$this->email_add->LinkCustomAttributes = "";
			$this->email_add->HrefValue = "";
			$this->email_add->TooltipValue = "";

			// handphone
			$this->handphone->LinkCustomAttributes = "";
			$this->handphone->HrefValue = "";
			$this->handphone->TooltipValue = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";
			$this->namap->TooltipValue = "";

			// tahun_berdiri
			$this->tahun_berdiri->LinkCustomAttributes = "";
			$this->tahun_berdiri->HrefValue = "";
			$this->tahun_berdiri->TooltipValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";
			$this->alamat->TooltipValue = "";

			// alamat_prod
			$this->alamat_prod->LinkCustomAttributes = "";
			$this->alamat_prod->HrefValue = "";
			$this->alamat_prod->TooltipValue = "";

			// kategori_produk
			$this->kategori_produk->LinkCustomAttributes = "";
			$this->kategori_produk->HrefValue = "";
			$this->kategori_produk->TooltipValue = "";

			// kategori_produk2
			$this->kategori_produk2->LinkCustomAttributes = "";
			$this->kategori_produk2->HrefValue = "";
			$this->kategori_produk2->TooltipValue = "";

			// kategori_produk3
			$this->kategori_produk3->LinkCustomAttributes = "";
			$this->kategori_produk3->HrefValue = "";
			$this->kategori_produk3->TooltipValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";
			$this->produk->TooltipValue = "";

			// merek_dagang
			$this->merek_dagang->LinkCustomAttributes = "";
			$this->merek_dagang->HrefValue = "";
			$this->merek_dagang->TooltipValue = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->LinkCustomAttributes = "";
			$this->jenis_perusahaan->HrefValue = "";
			$this->jenis_perusahaan->TooltipValue = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->LinkCustomAttributes = "";
			$this->kapasitas_produksi->HrefValue = "";
			$this->kapasitas_produksi->TooltipValue = "";

			// omset
			$this->omset->LinkCustomAttributes = "";
			$this->omset->HrefValue = "";
			$this->omset->TooltipValue = "";

			// website
			$this->website->LinkCustomAttributes = "";
			$this->website->HrefValue = "";
			$this->website->TooltipValue = "";

			// fb
			$this->fb->LinkCustomAttributes = "";
			$this->fb->HrefValue = "";
			$this->fb->TooltipValue = "";

			// ig
			$this->ig->LinkCustomAttributes = "";
			$this->ig->HrefValue = "";
			$this->ig->TooltipValue = "";

			// sosmed_lain
			$this->sosmed_lain->LinkCustomAttributes = "";
			$this->sosmed_lain->HrefValue = "";
			$this->sosmed_lain->TooltipValue = "";

			// jml_pegawai
			$this->jml_pegawai->LinkCustomAttributes = "";
			$this->jml_pegawai->HrefValue = "";
			$this->jml_pegawai->TooltipValue = "";

			// jml_pegawai2
			$this->jml_pegawai2->LinkCustomAttributes = "";
			$this->jml_pegawai2->HrefValue = "";
			$this->jml_pegawai2->TooltipValue = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->LinkCustomAttributes = "";
			$this->jml_pegawai_tidaktetap->HrefValue = "";
			$this->jml_pegawai_tidaktetap->TooltipValue = "";

			// legalitas
			$this->legalitas->LinkCustomAttributes = "";
			$this->legalitas->HrefValue = "";
			$this->legalitas->TooltipValue = "";

			// legalitas_lain
			$this->legalitas_lain->LinkCustomAttributes = "";
			$this->legalitas_lain->HrefValue = "";
			$this->legalitas_lain->TooltipValue = "";

			// f_npwp
			$this->f_npwp->LinkCustomAttributes = "";
			$this->f_npwp->HrefValue = "";
			$this->f_npwp->ExportHrefValue = $this->f_npwp->UploadPath . $this->f_npwp->Upload->DbValue;
			$this->f_npwp->TooltipValue = "";

			// f_nib
			$this->f_nib->LinkCustomAttributes = "";
			$this->f_nib->HrefValue = "";
			$this->f_nib->ExportHrefValue = $this->f_nib->UploadPath . $this->f_nib->Upload->DbValue;
			$this->f_nib->TooltipValue = "";

			// f_siup
			$this->f_siup->LinkCustomAttributes = "";
			$this->f_siup->HrefValue = "";
			$this->f_siup->ExportHrefValue = $this->f_siup->UploadPath . $this->f_siup->Upload->DbValue;
			$this->f_siup->TooltipValue = "";

			// f_tdp
			$this->f_tdp->LinkCustomAttributes = "";
			$this->f_tdp->HrefValue = "";
			$this->f_tdp->ExportHrefValue = $this->f_tdp->UploadPath . $this->f_tdp->Upload->DbValue;
			$this->f_tdp->TooltipValue = "";

			// f_lain
			$this->f_lain->LinkCustomAttributes = "";
			$this->f_lain->HrefValue = "";
			$this->f_lain->ExportHrefValue = $this->f_lain->UploadPath . $this->f_lain->Upload->DbValue;
			$this->f_lain->TooltipValue = "";

			// sertifikat
			$this->sertifikat->LinkCustomAttributes = "";
			$this->sertifikat->HrefValue = "";
			$this->sertifikat->TooltipValue = "";

			// sertifikat_lain
			$this->sertifikat_lain->LinkCustomAttributes = "";
			$this->sertifikat_lain->HrefValue = "";
			$this->sertifikat_lain->TooltipValue = "";

			// f_sertifikat
			$this->f_sertifikat->LinkCustomAttributes = "";
			$this->f_sertifikat->HrefValue = "";
			$this->f_sertifikat->ExportHrefValue = $this->f_sertifikat->UploadPath . $this->f_sertifikat->Upload->DbValue;
			$this->f_sertifikat->TooltipValue = "";

			// alat_promosi
			$this->alat_promosi->LinkCustomAttributes = "";
			$this->alat_promosi->HrefValue = "";
			$this->alat_promosi->TooltipValue = "";

			// promosi_lain
			$this->promosi_lain->LinkCustomAttributes = "";
			$this->promosi_lain->HrefValue = "";
			$this->promosi_lain->TooltipValue = "";

			// f_kartunama
			$this->f_kartunama->LinkCustomAttributes = "";
			$this->f_kartunama->HrefValue = "";
			$this->f_kartunama->ExportHrefValue = $this->f_kartunama->UploadPath . $this->f_kartunama->Upload->DbValue;
			$this->f_kartunama->TooltipValue = "";

			// f_brosur
			$this->f_brosur->LinkCustomAttributes = "";
			$this->f_brosur->HrefValue = "";
			$this->f_brosur->ExportHrefValue = $this->f_brosur->UploadPath . $this->f_brosur->Upload->DbValue;
			$this->f_brosur->TooltipValue = "";

			// f_katalog
			$this->f_katalog->LinkCustomAttributes = "";
			$this->f_katalog->HrefValue = "";
			$this->f_katalog->ExportHrefValue = $this->f_katalog->UploadPath . $this->f_katalog->Upload->DbValue;
			$this->f_katalog->TooltipValue = "";

			// f_profile
			$this->f_profile->LinkCustomAttributes = "";
			$this->f_profile->HrefValue = "";
			$this->f_profile->ExportHrefValue = $this->f_profile->UploadPath . $this->f_profile->Upload->DbValue;
			$this->f_profile->TooltipValue = "";

			// tahun_ecp
			$this->tahun_ecp->LinkCustomAttributes = "";
			$this->tahun_ecp->HrefValue = "";
			$this->tahun_ecp->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// nama_peserta
			$this->nama_peserta->EditAttrs["class"] = "form-control";
			$this->nama_peserta->EditCustomAttributes = "";
			if (!$this->nama_peserta->Raw)
				$this->nama_peserta->CurrentValue = HtmlDecode($this->nama_peserta->CurrentValue);
			$this->nama_peserta->EditValue = HtmlEncode($this->nama_peserta->CurrentValue);
			$this->nama_peserta->PlaceHolder = RemoveHtml($this->nama_peserta->caption());

			// email_add
			$this->email_add->EditAttrs["class"] = "form-control";
			$this->email_add->EditCustomAttributes = "";
			if (!$this->email_add->Raw)
				$this->email_add->CurrentValue = HtmlDecode($this->email_add->CurrentValue);
			$this->email_add->EditValue = HtmlEncode($this->email_add->CurrentValue);
			$this->email_add->PlaceHolder = RemoveHtml($this->email_add->caption());

			// handphone
			$this->handphone->EditAttrs["class"] = "form-control";
			$this->handphone->EditCustomAttributes = "";
			if (!$this->handphone->Raw)
				$this->handphone->CurrentValue = HtmlDecode($this->handphone->CurrentValue);
			$this->handphone->EditValue = HtmlEncode($this->handphone->CurrentValue);
			$this->handphone->PlaceHolder = RemoveHtml($this->handphone->caption());

			// namap
			$this->namap->EditAttrs["class"] = "form-control";
			$this->namap->EditCustomAttributes = "";
			if (!$this->namap->Raw)
				$this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
			$this->namap->EditValue = HtmlEncode($this->namap->CurrentValue);
			$arwrk = [];
			$arwrk[1] = HtmlEncode($this->namap->CurrentValue);
			$this->namap->EditValue = $this->namap->displayValue($arwrk);
			$this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

			// tahun_berdiri
			$this->tahun_berdiri->EditAttrs["class"] = "form-control";
			$this->tahun_berdiri->EditCustomAttributes = "";
			$this->tahun_berdiri->EditValue = HtmlEncode($this->tahun_berdiri->CurrentValue);
			$this->tahun_berdiri->PlaceHolder = RemoveHtml($this->tahun_berdiri->caption());

			// alamat
			$this->alamat->EditAttrs["class"] = "form-control";
			$this->alamat->EditCustomAttributes = "";
			$this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
			$this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

			// alamat_prod
			$this->alamat_prod->EditAttrs["class"] = "form-control";
			$this->alamat_prod->EditCustomAttributes = "";
			$this->alamat_prod->EditValue = HtmlEncode($this->alamat_prod->CurrentValue);
			$this->alamat_prod->PlaceHolder = RemoveHtml($this->alamat_prod->caption());

			// kategori_produk
			$this->kategori_produk->EditAttrs["class"] = "form-control";
			$this->kategori_produk->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk->ViewValue = $this->kategori_produk->lookupCacheOption($curVal);
			else
				$this->kategori_produk->ViewValue = $this->kategori_produk->Lookup !== NULL && is_array($this->kategori_produk->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk->EditValue = array_values($this->kategori_produk->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk->EditValue = $arwrk;
			}

			// kategori_produk2
			$this->kategori_produk2->EditAttrs["class"] = "form-control";
			$this->kategori_produk2->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk2->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->lookupCacheOption($curVal);
			else
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->Lookup !== NULL && is_array($this->kategori_produk2->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk2->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk2->EditValue = array_values($this->kategori_produk2->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk2->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk2->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk2->EditValue = $arwrk;
			}

			// kategori_produk3
			$this->kategori_produk3->EditAttrs["class"] = "form-control";
			$this->kategori_produk3->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk3->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->lookupCacheOption($curVal);
			else
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->Lookup !== NULL && is_array($this->kategori_produk3->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk3->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk3->EditValue = array_values($this->kategori_produk3->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk3->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk3->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk3->EditValue = $arwrk;
			}

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "";
			if (!$this->produk->Raw)
				$this->produk->CurrentValue = HtmlDecode($this->produk->CurrentValue);
			$this->produk->EditValue = HtmlEncode($this->produk->CurrentValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// merek_dagang
			$this->merek_dagang->EditAttrs["class"] = "form-control";
			$this->merek_dagang->EditCustomAttributes = "";
			if (!$this->merek_dagang->Raw)
				$this->merek_dagang->CurrentValue = HtmlDecode($this->merek_dagang->CurrentValue);
			$this->merek_dagang->EditValue = HtmlEncode($this->merek_dagang->CurrentValue);
			$this->merek_dagang->PlaceHolder = RemoveHtml($this->merek_dagang->caption());

			// jenis_perusahaan
			$this->jenis_perusahaan->EditAttrs["class"] = "form-control";
			$this->jenis_perusahaan->EditCustomAttributes = "";
			if (!$this->jenis_perusahaan->Raw)
				$this->jenis_perusahaan->CurrentValue = HtmlDecode($this->jenis_perusahaan->CurrentValue);
			$this->jenis_perusahaan->EditValue = HtmlEncode($this->jenis_perusahaan->CurrentValue);
			$this->jenis_perusahaan->PlaceHolder = RemoveHtml($this->jenis_perusahaan->caption());

			// kapasitas_produksi
			$this->kapasitas_produksi->EditAttrs["class"] = "form-control";
			$this->kapasitas_produksi->EditCustomAttributes = "";
			if (!$this->kapasitas_produksi->Raw)
				$this->kapasitas_produksi->CurrentValue = HtmlDecode($this->kapasitas_produksi->CurrentValue);
			$this->kapasitas_produksi->EditValue = HtmlEncode($this->kapasitas_produksi->CurrentValue);
			$this->kapasitas_produksi->PlaceHolder = RemoveHtml($this->kapasitas_produksi->caption());

			// omset
			$this->omset->EditAttrs["class"] = "form-control";
			$this->omset->EditCustomAttributes = "";
			if (!$this->omset->Raw)
				$this->omset->CurrentValue = HtmlDecode($this->omset->CurrentValue);
			$this->omset->EditValue = HtmlEncode($this->omset->CurrentValue);
			$this->omset->PlaceHolder = RemoveHtml($this->omset->caption());

			// website
			$this->website->EditAttrs["class"] = "form-control";
			$this->website->EditCustomAttributes = "";
			if (!$this->website->Raw)
				$this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
			$this->website->EditValue = HtmlEncode($this->website->CurrentValue);
			$this->website->PlaceHolder = RemoveHtml($this->website->caption());

			// fb
			$this->fb->EditAttrs["class"] = "form-control";
			$this->fb->EditCustomAttributes = "";
			if (!$this->fb->Raw)
				$this->fb->CurrentValue = HtmlDecode($this->fb->CurrentValue);
			$this->fb->EditValue = HtmlEncode($this->fb->CurrentValue);
			$this->fb->PlaceHolder = RemoveHtml($this->fb->caption());

			// ig
			$this->ig->EditAttrs["class"] = "form-control";
			$this->ig->EditCustomAttributes = "";
			if (!$this->ig->Raw)
				$this->ig->CurrentValue = HtmlDecode($this->ig->CurrentValue);
			$this->ig->EditValue = HtmlEncode($this->ig->CurrentValue);
			$this->ig->PlaceHolder = RemoveHtml($this->ig->caption());

			// sosmed_lain
			$this->sosmed_lain->EditAttrs["class"] = "form-control";
			$this->sosmed_lain->EditCustomAttributes = "";
			if (!$this->sosmed_lain->Raw)
				$this->sosmed_lain->CurrentValue = HtmlDecode($this->sosmed_lain->CurrentValue);
			$this->sosmed_lain->EditValue = HtmlEncode($this->sosmed_lain->CurrentValue);
			$this->sosmed_lain->PlaceHolder = RemoveHtml($this->sosmed_lain->caption());

			// jml_pegawai
			$this->jml_pegawai->EditAttrs["class"] = "form-control";
			$this->jml_pegawai->EditCustomAttributes = "";
			$this->jml_pegawai->EditValue = $this->jml_pegawai->options(TRUE);

			// jml_pegawai2
			$this->jml_pegawai2->EditAttrs["class"] = "form-control";
			$this->jml_pegawai2->EditCustomAttributes = "";
			if (!$this->jml_pegawai2->Raw)
				$this->jml_pegawai2->CurrentValue = HtmlDecode($this->jml_pegawai2->CurrentValue);
			$this->jml_pegawai2->EditValue = HtmlEncode($this->jml_pegawai2->CurrentValue);
			$this->jml_pegawai2->PlaceHolder = RemoveHtml($this->jml_pegawai2->caption());

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->EditAttrs["class"] = "form-control";
			$this->jml_pegawai_tidaktetap->EditCustomAttributes = "";
			if (!$this->jml_pegawai_tidaktetap->Raw)
				$this->jml_pegawai_tidaktetap->CurrentValue = HtmlDecode($this->jml_pegawai_tidaktetap->CurrentValue);
			$this->jml_pegawai_tidaktetap->EditValue = HtmlEncode($this->jml_pegawai_tidaktetap->CurrentValue);
			$this->jml_pegawai_tidaktetap->PlaceHolder = RemoveHtml($this->jml_pegawai_tidaktetap->caption());

			// legalitas
			$this->legalitas->EditCustomAttributes = "";
			$this->legalitas->EditValue = $this->legalitas->options(FALSE);

			// legalitas_lain
			$this->legalitas_lain->EditAttrs["class"] = "form-control";
			$this->legalitas_lain->EditCustomAttributes = "";
			if (!$this->legalitas_lain->Raw)
				$this->legalitas_lain->CurrentValue = HtmlDecode($this->legalitas_lain->CurrentValue);
			$this->legalitas_lain->EditValue = HtmlEncode($this->legalitas_lain->CurrentValue);
			$this->legalitas_lain->PlaceHolder = RemoveHtml($this->legalitas_lain->caption());

			// f_npwp
			$this->f_npwp->EditAttrs["class"] = "form-control";
			$this->f_npwp->EditCustomAttributes = "";
			$this->f_npwp->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_npwp->Upload->DbValue)) {
				$this->f_npwp->EditValue = $this->f_npwp->Upload->DbValue;
			} else {
				$this->f_npwp->EditValue = "";
			}
			if (!EmptyValue($this->f_npwp->CurrentValue))
					$this->f_npwp->Upload->FileName = $this->f_npwp->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_npwp);

			// f_nib
			$this->f_nib->EditAttrs["class"] = "form-control";
			$this->f_nib->EditCustomAttributes = "";
			$this->f_nib->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_nib->Upload->DbValue)) {
				$this->f_nib->EditValue = $this->f_nib->Upload->DbValue;
			} else {
				$this->f_nib->EditValue = "";
			}
			if (!EmptyValue($this->f_nib->CurrentValue))
					$this->f_nib->Upload->FileName = $this->f_nib->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_nib);

			// f_siup
			$this->f_siup->EditAttrs["class"] = "form-control";
			$this->f_siup->EditCustomAttributes = "";
			$this->f_siup->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_siup->Upload->DbValue)) {
				$this->f_siup->EditValue = $this->f_siup->Upload->DbValue;
			} else {
				$this->f_siup->EditValue = "";
			}
			if (!EmptyValue($this->f_siup->CurrentValue))
					$this->f_siup->Upload->FileName = $this->f_siup->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_siup);

			// f_tdp
			$this->f_tdp->EditAttrs["class"] = "form-control";
			$this->f_tdp->EditCustomAttributes = "";
			$this->f_tdp->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_tdp->Upload->DbValue)) {
				$this->f_tdp->EditValue = $this->f_tdp->Upload->DbValue;
			} else {
				$this->f_tdp->EditValue = "";
			}
			if (!EmptyValue($this->f_tdp->CurrentValue))
					$this->f_tdp->Upload->FileName = $this->f_tdp->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_tdp);

			// f_lain
			$this->f_lain->EditAttrs["class"] = "form-control";
			$this->f_lain->EditCustomAttributes = "";
			$this->f_lain->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_lain->Upload->DbValue)) {
				$this->f_lain->EditValue = $this->f_lain->Upload->DbValue;
			} else {
				$this->f_lain->EditValue = "";
			}
			if (!EmptyValue($this->f_lain->CurrentValue))
					$this->f_lain->Upload->FileName = $this->f_lain->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_lain);

			// sertifikat
			$this->sertifikat->EditCustomAttributes = "";
			$this->sertifikat->EditValue = $this->sertifikat->options(FALSE);

			// sertifikat_lain
			$this->sertifikat_lain->EditAttrs["class"] = "form-control";
			$this->sertifikat_lain->EditCustomAttributes = "";
			if (!$this->sertifikat_lain->Raw)
				$this->sertifikat_lain->CurrentValue = HtmlDecode($this->sertifikat_lain->CurrentValue);
			$this->sertifikat_lain->EditValue = HtmlEncode($this->sertifikat_lain->CurrentValue);
			$this->sertifikat_lain->PlaceHolder = RemoveHtml($this->sertifikat_lain->caption());

			// f_sertifikat
			$this->f_sertifikat->EditAttrs["class"] = "form-control";
			$this->f_sertifikat->EditCustomAttributes = "";
			$this->f_sertifikat->UploadPath = "berkas/sertifikat_ecp/";
			if (!EmptyValue($this->f_sertifikat->Upload->DbValue)) {
				$this->f_sertifikat->EditValue = $this->f_sertifikat->Upload->DbValue;
			} else {
				$this->f_sertifikat->EditValue = "";
			}
			if (!EmptyValue($this->f_sertifikat->CurrentValue))
					$this->f_sertifikat->Upload->FileName = $this->f_sertifikat->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_sertifikat);

			// alat_promosi
			$this->alat_promosi->EditCustomAttributes = "";
			$this->alat_promosi->EditValue = $this->alat_promosi->options(FALSE);

			// promosi_lain
			$this->promosi_lain->EditAttrs["class"] = "form-control";
			$this->promosi_lain->EditCustomAttributes = "";
			if (!$this->promosi_lain->Raw)
				$this->promosi_lain->CurrentValue = HtmlDecode($this->promosi_lain->CurrentValue);
			$this->promosi_lain->EditValue = HtmlEncode($this->promosi_lain->CurrentValue);
			$this->promosi_lain->PlaceHolder = RemoveHtml($this->promosi_lain->caption());

			// f_kartunama
			$this->f_kartunama->EditAttrs["class"] = "form-control";
			$this->f_kartunama->EditCustomAttributes = "";
			$this->f_kartunama->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_kartunama->Upload->DbValue)) {
				$this->f_kartunama->EditValue = $this->f_kartunama->Upload->DbValue;
			} else {
				$this->f_kartunama->EditValue = "";
			}
			if (!EmptyValue($this->f_kartunama->CurrentValue))
					$this->f_kartunama->Upload->FileName = $this->f_kartunama->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_kartunama);

			// f_brosur
			$this->f_brosur->EditAttrs["class"] = "form-control";
			$this->f_brosur->EditCustomAttributes = "";
			$this->f_brosur->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_brosur->Upload->DbValue)) {
				$this->f_brosur->EditValue = $this->f_brosur->Upload->DbValue;
			} else {
				$this->f_brosur->EditValue = "";
			}
			if (!EmptyValue($this->f_brosur->CurrentValue))
					$this->f_brosur->Upload->FileName = $this->f_brosur->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_brosur);

			// f_katalog
			$this->f_katalog->EditAttrs["class"] = "form-control";
			$this->f_katalog->EditCustomAttributes = "";
			$this->f_katalog->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_katalog->Upload->DbValue)) {
				$this->f_katalog->EditValue = $this->f_katalog->Upload->DbValue;
			} else {
				$this->f_katalog->EditValue = "";
			}
			if (!EmptyValue($this->f_katalog->CurrentValue))
					$this->f_katalog->Upload->FileName = $this->f_katalog->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_katalog);

			// f_profile
			$this->f_profile->EditAttrs["class"] = "form-control";
			$this->f_profile->EditCustomAttributes = "";
			$this->f_profile->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_profile->Upload->DbValue)) {
				$this->f_profile->EditValue = $this->f_profile->Upload->DbValue;
			} else {
				$this->f_profile->EditValue = "";
			}
			if (!EmptyValue($this->f_profile->CurrentValue))
					$this->f_profile->Upload->FileName = $this->f_profile->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->f_profile);

			// tahun_ecp
			$this->tahun_ecp->EditAttrs["class"] = "form-control";
			$this->tahun_ecp->EditCustomAttributes = "";
			$this->tahun_ecp->EditValue = HtmlEncode($this->tahun_ecp->CurrentValue);
			$this->tahun_ecp->PlaceHolder = RemoveHtml($this->tahun_ecp->caption());

			// Edit refer script
			// nama_peserta

			$this->nama_peserta->LinkCustomAttributes = "";
			$this->nama_peserta->HrefValue = "";

			// email_add
			$this->email_add->LinkCustomAttributes = "";
			$this->email_add->HrefValue = "";

			// handphone
			$this->handphone->LinkCustomAttributes = "";
			$this->handphone->HrefValue = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";

			// tahun_berdiri
			$this->tahun_berdiri->LinkCustomAttributes = "";
			$this->tahun_berdiri->HrefValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";

			// alamat_prod
			$this->alamat_prod->LinkCustomAttributes = "";
			$this->alamat_prod->HrefValue = "";

			// kategori_produk
			$this->kategori_produk->LinkCustomAttributes = "";
			$this->kategori_produk->HrefValue = "";

			// kategori_produk2
			$this->kategori_produk2->LinkCustomAttributes = "";
			$this->kategori_produk2->HrefValue = "";

			// kategori_produk3
			$this->kategori_produk3->LinkCustomAttributes = "";
			$this->kategori_produk3->HrefValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";

			// merek_dagang
			$this->merek_dagang->LinkCustomAttributes = "";
			$this->merek_dagang->HrefValue = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->LinkCustomAttributes = "";
			$this->jenis_perusahaan->HrefValue = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->LinkCustomAttributes = "";
			$this->kapasitas_produksi->HrefValue = "";

			// omset
			$this->omset->LinkCustomAttributes = "";
			$this->omset->HrefValue = "";

			// website
			$this->website->LinkCustomAttributes = "";
			$this->website->HrefValue = "";

			// fb
			$this->fb->LinkCustomAttributes = "";
			$this->fb->HrefValue = "";

			// ig
			$this->ig->LinkCustomAttributes = "";
			$this->ig->HrefValue = "";

			// sosmed_lain
			$this->sosmed_lain->LinkCustomAttributes = "";
			$this->sosmed_lain->HrefValue = "";

			// jml_pegawai
			$this->jml_pegawai->LinkCustomAttributes = "";
			$this->jml_pegawai->HrefValue = "";

			// jml_pegawai2
			$this->jml_pegawai2->LinkCustomAttributes = "";
			$this->jml_pegawai2->HrefValue = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->LinkCustomAttributes = "";
			$this->jml_pegawai_tidaktetap->HrefValue = "";

			// legalitas
			$this->legalitas->LinkCustomAttributes = "";
			$this->legalitas->HrefValue = "";

			// legalitas_lain
			$this->legalitas_lain->LinkCustomAttributes = "";
			$this->legalitas_lain->HrefValue = "";

			// f_npwp
			$this->f_npwp->LinkCustomAttributes = "";
			$this->f_npwp->HrefValue = "";
			$this->f_npwp->ExportHrefValue = $this->f_npwp->UploadPath . $this->f_npwp->Upload->DbValue;

			// f_nib
			$this->f_nib->LinkCustomAttributes = "";
			$this->f_nib->HrefValue = "";
			$this->f_nib->ExportHrefValue = $this->f_nib->UploadPath . $this->f_nib->Upload->DbValue;

			// f_siup
			$this->f_siup->LinkCustomAttributes = "";
			$this->f_siup->HrefValue = "";
			$this->f_siup->ExportHrefValue = $this->f_siup->UploadPath . $this->f_siup->Upload->DbValue;

			// f_tdp
			$this->f_tdp->LinkCustomAttributes = "";
			$this->f_tdp->HrefValue = "";
			$this->f_tdp->ExportHrefValue = $this->f_tdp->UploadPath . $this->f_tdp->Upload->DbValue;

			// f_lain
			$this->f_lain->LinkCustomAttributes = "";
			$this->f_lain->HrefValue = "";
			$this->f_lain->ExportHrefValue = $this->f_lain->UploadPath . $this->f_lain->Upload->DbValue;

			// sertifikat
			$this->sertifikat->LinkCustomAttributes = "";
			$this->sertifikat->HrefValue = "";

			// sertifikat_lain
			$this->sertifikat_lain->LinkCustomAttributes = "";
			$this->sertifikat_lain->HrefValue = "";

			// f_sertifikat
			$this->f_sertifikat->LinkCustomAttributes = "";
			$this->f_sertifikat->HrefValue = "";
			$this->f_sertifikat->ExportHrefValue = $this->f_sertifikat->UploadPath . $this->f_sertifikat->Upload->DbValue;

			// alat_promosi
			$this->alat_promosi->LinkCustomAttributes = "";
			$this->alat_promosi->HrefValue = "";

			// promosi_lain
			$this->promosi_lain->LinkCustomAttributes = "";
			$this->promosi_lain->HrefValue = "";

			// f_kartunama
			$this->f_kartunama->LinkCustomAttributes = "";
			$this->f_kartunama->HrefValue = "";
			$this->f_kartunama->ExportHrefValue = $this->f_kartunama->UploadPath . $this->f_kartunama->Upload->DbValue;

			// f_brosur
			$this->f_brosur->LinkCustomAttributes = "";
			$this->f_brosur->HrefValue = "";
			$this->f_brosur->ExportHrefValue = $this->f_brosur->UploadPath . $this->f_brosur->Upload->DbValue;

			// f_katalog
			$this->f_katalog->LinkCustomAttributes = "";
			$this->f_katalog->HrefValue = "";
			$this->f_katalog->ExportHrefValue = $this->f_katalog->UploadPath . $this->f_katalog->Upload->DbValue;

			// f_profile
			$this->f_profile->LinkCustomAttributes = "";
			$this->f_profile->HrefValue = "";
			$this->f_profile->ExportHrefValue = $this->f_profile->UploadPath . $this->f_profile->Upload->DbValue;

			// tahun_ecp
			$this->tahun_ecp->LinkCustomAttributes = "";
			$this->tahun_ecp->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->nama_peserta->Required) {
			if (!$this->nama_peserta->IsDetailKey && $this->nama_peserta->FormValue != NULL && $this->nama_peserta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_peserta->caption(), $this->nama_peserta->RequiredErrorMessage));
			}
		}
		if ($this->email_add->Required) {
			if (!$this->email_add->IsDetailKey && $this->email_add->FormValue != NULL && $this->email_add->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->email_add->caption(), $this->email_add->RequiredErrorMessage));
			}
		}
		if ($this->handphone->Required) {
			if (!$this->handphone->IsDetailKey && $this->handphone->FormValue != NULL && $this->handphone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->handphone->caption(), $this->handphone->RequiredErrorMessage));
			}
		}
		if ($this->namap->Required) {
			if (!$this->namap->IsDetailKey && $this->namap->FormValue != NULL && $this->namap->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->namap->caption(), $this->namap->RequiredErrorMessage));
			}
		}
		if ($this->tahun_berdiri->Required) {
			if (!$this->tahun_berdiri->IsDetailKey && $this->tahun_berdiri->FormValue != NULL && $this->tahun_berdiri->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tahun_berdiri->caption(), $this->tahun_berdiri->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tahun_berdiri->FormValue)) {
			AddMessage($FormError, $this->tahun_berdiri->errorMessage());
		}
		if ($this->alamat->Required) {
			if (!$this->alamat->IsDetailKey && $this->alamat->FormValue != NULL && $this->alamat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
			}
		}
		if ($this->alamat_prod->Required) {
			if (!$this->alamat_prod->IsDetailKey && $this->alamat_prod->FormValue != NULL && $this->alamat_prod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat_prod->caption(), $this->alamat_prod->RequiredErrorMessage));
			}
		}
		if ($this->kategori_produk->Required) {
			if (!$this->kategori_produk->IsDetailKey && $this->kategori_produk->FormValue != NULL && $this->kategori_produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori_produk->caption(), $this->kategori_produk->RequiredErrorMessage));
			}
		}
		if ($this->kategori_produk2->Required) {
			if (!$this->kategori_produk2->IsDetailKey && $this->kategori_produk2->FormValue != NULL && $this->kategori_produk2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori_produk2->caption(), $this->kategori_produk2->RequiredErrorMessage));
			}
		}
		if ($this->kategori_produk3->Required) {
			if (!$this->kategori_produk3->IsDetailKey && $this->kategori_produk3->FormValue != NULL && $this->kategori_produk3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori_produk3->caption(), $this->kategori_produk3->RequiredErrorMessage));
			}
		}
		if ($this->produk->Required) {
			if (!$this->produk->IsDetailKey && $this->produk->FormValue != NULL && $this->produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->produk->caption(), $this->produk->RequiredErrorMessage));
			}
		}
		if ($this->merek_dagang->Required) {
			if (!$this->merek_dagang->IsDetailKey && $this->merek_dagang->FormValue != NULL && $this->merek_dagang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->merek_dagang->caption(), $this->merek_dagang->RequiredErrorMessage));
			}
		}
		if ($this->jenis_perusahaan->Required) {
			if (!$this->jenis_perusahaan->IsDetailKey && $this->jenis_perusahaan->FormValue != NULL && $this->jenis_perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis_perusahaan->caption(), $this->jenis_perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->kapasitas_produksi->Required) {
			if (!$this->kapasitas_produksi->IsDetailKey && $this->kapasitas_produksi->FormValue != NULL && $this->kapasitas_produksi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kapasitas_produksi->caption(), $this->kapasitas_produksi->RequiredErrorMessage));
			}
		}
		if ($this->omset->Required) {
			if (!$this->omset->IsDetailKey && $this->omset->FormValue != NULL && $this->omset->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->omset->caption(), $this->omset->RequiredErrorMessage));
			}
		}
		if ($this->website->Required) {
			if (!$this->website->IsDetailKey && $this->website->FormValue != NULL && $this->website->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->website->caption(), $this->website->RequiredErrorMessage));
			}
		}
		if ($this->fb->Required) {
			if (!$this->fb->IsDetailKey && $this->fb->FormValue != NULL && $this->fb->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fb->caption(), $this->fb->RequiredErrorMessage));
			}
		}
		if ($this->ig->Required) {
			if (!$this->ig->IsDetailKey && $this->ig->FormValue != NULL && $this->ig->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ig->caption(), $this->ig->RequiredErrorMessage));
			}
		}
		if ($this->sosmed_lain->Required) {
			if (!$this->sosmed_lain->IsDetailKey && $this->sosmed_lain->FormValue != NULL && $this->sosmed_lain->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sosmed_lain->caption(), $this->sosmed_lain->RequiredErrorMessage));
			}
		}
		if ($this->jml_pegawai->Required) {
			if (!$this->jml_pegawai->IsDetailKey && $this->jml_pegawai->FormValue != NULL && $this->jml_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_pegawai->caption(), $this->jml_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->jml_pegawai2->Required) {
			if (!$this->jml_pegawai2->IsDetailKey && $this->jml_pegawai2->FormValue != NULL && $this->jml_pegawai2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_pegawai2->caption(), $this->jml_pegawai2->RequiredErrorMessage));
			}
		}
		if ($this->jml_pegawai_tidaktetap->Required) {
			if (!$this->jml_pegawai_tidaktetap->IsDetailKey && $this->jml_pegawai_tidaktetap->FormValue != NULL && $this->jml_pegawai_tidaktetap->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_pegawai_tidaktetap->caption(), $this->jml_pegawai_tidaktetap->RequiredErrorMessage));
			}
		}
		if ($this->legalitas->Required) {
			if ($this->legalitas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->legalitas->caption(), $this->legalitas->RequiredErrorMessage));
			}
		}
		if ($this->legalitas_lain->Required) {
			if (!$this->legalitas_lain->IsDetailKey && $this->legalitas_lain->FormValue != NULL && $this->legalitas_lain->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->legalitas_lain->caption(), $this->legalitas_lain->RequiredErrorMessage));
			}
		}
		if ($this->f_npwp->Required) {
			if ($this->f_npwp->Upload->FileName == "" && !$this->f_npwp->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_npwp->caption(), $this->f_npwp->RequiredErrorMessage));
			}
		}
		if ($this->f_nib->Required) {
			if ($this->f_nib->Upload->FileName == "" && !$this->f_nib->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_nib->caption(), $this->f_nib->RequiredErrorMessage));
			}
		}
		if ($this->f_siup->Required) {
			if ($this->f_siup->Upload->FileName == "" && !$this->f_siup->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_siup->caption(), $this->f_siup->RequiredErrorMessage));
			}
		}
		if ($this->f_tdp->Required) {
			if ($this->f_tdp->Upload->FileName == "" && !$this->f_tdp->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_tdp->caption(), $this->f_tdp->RequiredErrorMessage));
			}
		}
		if ($this->f_lain->Required) {
			if ($this->f_lain->Upload->FileName == "" && !$this->f_lain->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_lain->caption(), $this->f_lain->RequiredErrorMessage));
			}
		}
		if ($this->sertifikat->Required) {
			if ($this->sertifikat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sertifikat->caption(), $this->sertifikat->RequiredErrorMessage));
			}
		}
		if ($this->sertifikat_lain->Required) {
			if (!$this->sertifikat_lain->IsDetailKey && $this->sertifikat_lain->FormValue != NULL && $this->sertifikat_lain->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sertifikat_lain->caption(), $this->sertifikat_lain->RequiredErrorMessage));
			}
		}
		if ($this->f_sertifikat->Required) {
			if ($this->f_sertifikat->Upload->FileName == "" && !$this->f_sertifikat->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_sertifikat->caption(), $this->f_sertifikat->RequiredErrorMessage));
			}
		}
		if ($this->alat_promosi->Required) {
			if ($this->alat_promosi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alat_promosi->caption(), $this->alat_promosi->RequiredErrorMessage));
			}
		}
		if ($this->promosi_lain->Required) {
			if (!$this->promosi_lain->IsDetailKey && $this->promosi_lain->FormValue != NULL && $this->promosi_lain->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->promosi_lain->caption(), $this->promosi_lain->RequiredErrorMessage));
			}
		}
		if ($this->f_kartunama->Required) {
			if ($this->f_kartunama->Upload->FileName == "" && !$this->f_kartunama->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_kartunama->caption(), $this->f_kartunama->RequiredErrorMessage));
			}
		}
		if ($this->f_brosur->Required) {
			if ($this->f_brosur->Upload->FileName == "" && !$this->f_brosur->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_brosur->caption(), $this->f_brosur->RequiredErrorMessage));
			}
		}
		if ($this->f_katalog->Required) {
			if ($this->f_katalog->Upload->FileName == "" && !$this->f_katalog->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_katalog->caption(), $this->f_katalog->RequiredErrorMessage));
			}
		}
		if ($this->f_profile->Required) {
			if ($this->f_profile->Upload->FileName == "" && !$this->f_profile->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->f_profile->caption(), $this->f_profile->RequiredErrorMessage));
			}
		}
		if ($this->tahun_ecp->Required) {
			if (!$this->tahun_ecp->IsDetailKey && $this->tahun_ecp->FormValue != NULL && $this->tahun_ecp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tahun_ecp->caption(), $this->tahun_ecp->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tahun_ecp->FormValue)) {
			AddMessage($FormError, $this->tahun_ecp->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t_ecp", $detailTblVar) && $GLOBALS["t_ecp"]->DetailEdit) {
			if (!isset($GLOBALS["t_ecp_grid"]))
				$GLOBALS["t_ecp_grid"] = new t_ecp_grid(); // Get detail page object
			$GLOBALS["t_ecp_grid"]->validateGridForm();
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$this->f_npwp->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_npwp->UploadPath = $this->f_npwp->OldUploadPath;
			$this->f_nib->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_nib->UploadPath = $this->f_nib->OldUploadPath;
			$this->f_siup->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_siup->UploadPath = $this->f_siup->OldUploadPath;
			$this->f_tdp->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_tdp->UploadPath = $this->f_tdp->OldUploadPath;
			$this->f_lain->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_lain->UploadPath = $this->f_lain->OldUploadPath;
			$this->f_sertifikat->OldUploadPath = "berkas/sertifikat_ecp/";
			$this->f_sertifikat->UploadPath = $this->f_sertifikat->OldUploadPath;
			$this->f_kartunama->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_kartunama->UploadPath = $this->f_kartunama->OldUploadPath;
			$this->f_brosur->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_brosur->UploadPath = $this->f_brosur->OldUploadPath;
			$this->f_katalog->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_katalog->UploadPath = $this->f_katalog->OldUploadPath;
			$this->f_profile->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_profile->UploadPath = $this->f_profile->OldUploadPath;
			$rsnew = [];

			// nama_peserta
			$this->nama_peserta->setDbValueDef($rsnew, $this->nama_peserta->CurrentValue, "", $this->nama_peserta->ReadOnly);

			// email_add
			$this->email_add->setDbValueDef($rsnew, $this->email_add->CurrentValue, NULL, $this->email_add->ReadOnly);

			// handphone
			$this->handphone->setDbValueDef($rsnew, $this->handphone->CurrentValue, NULL, $this->handphone->ReadOnly);

			// namap
			$this->namap->setDbValueDef($rsnew, $this->namap->CurrentValue, NULL, $this->namap->ReadOnly);

			// tahun_berdiri
			$this->tahun_berdiri->setDbValueDef($rsnew, $this->tahun_berdiri->CurrentValue, NULL, $this->tahun_berdiri->ReadOnly);

			// alamat
			$this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, NULL, $this->alamat->ReadOnly);

			// alamat_prod
			$this->alamat_prod->setDbValueDef($rsnew, $this->alamat_prod->CurrentValue, NULL, $this->alamat_prod->ReadOnly);

			// kategori_produk
			$this->kategori_produk->setDbValueDef($rsnew, $this->kategori_produk->CurrentValue, NULL, $this->kategori_produk->ReadOnly);

			// kategori_produk2
			$this->kategori_produk2->setDbValueDef($rsnew, $this->kategori_produk2->CurrentValue, NULL, $this->kategori_produk2->ReadOnly);

			// kategori_produk3
			$this->kategori_produk3->setDbValueDef($rsnew, $this->kategori_produk3->CurrentValue, NULL, $this->kategori_produk3->ReadOnly);

			// produk
			$this->produk->setDbValueDef($rsnew, $this->produk->CurrentValue, NULL, $this->produk->ReadOnly);

			// merek_dagang
			$this->merek_dagang->setDbValueDef($rsnew, $this->merek_dagang->CurrentValue, NULL, $this->merek_dagang->ReadOnly);

			// jenis_perusahaan
			$this->jenis_perusahaan->setDbValueDef($rsnew, $this->jenis_perusahaan->CurrentValue, NULL, $this->jenis_perusahaan->ReadOnly);

			// kapasitas_produksi
			$this->kapasitas_produksi->setDbValueDef($rsnew, $this->kapasitas_produksi->CurrentValue, NULL, $this->kapasitas_produksi->ReadOnly);

			// omset
			$this->omset->setDbValueDef($rsnew, $this->omset->CurrentValue, NULL, $this->omset->ReadOnly);

			// website
			$this->website->setDbValueDef($rsnew, $this->website->CurrentValue, NULL, $this->website->ReadOnly);

			// fb
			$this->fb->setDbValueDef($rsnew, $this->fb->CurrentValue, NULL, $this->fb->ReadOnly);

			// ig
			$this->ig->setDbValueDef($rsnew, $this->ig->CurrentValue, NULL, $this->ig->ReadOnly);

			// sosmed_lain
			$this->sosmed_lain->setDbValueDef($rsnew, $this->sosmed_lain->CurrentValue, NULL, $this->sosmed_lain->ReadOnly);

			// jml_pegawai
			$this->jml_pegawai->setDbValueDef($rsnew, $this->jml_pegawai->CurrentValue, NULL, $this->jml_pegawai->ReadOnly);

			// jml_pegawai2
			$this->jml_pegawai2->setDbValueDef($rsnew, $this->jml_pegawai2->CurrentValue, NULL, $this->jml_pegawai2->ReadOnly);

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->setDbValueDef($rsnew, $this->jml_pegawai_tidaktetap->CurrentValue, NULL, $this->jml_pegawai_tidaktetap->ReadOnly);

			// legalitas
			$this->legalitas->setDbValueDef($rsnew, $this->legalitas->CurrentValue, NULL, $this->legalitas->ReadOnly);

			// legalitas_lain
			$this->legalitas_lain->setDbValueDef($rsnew, $this->legalitas_lain->CurrentValue, NULL, $this->legalitas_lain->ReadOnly);

			// f_npwp
			if ($this->f_npwp->Visible && !$this->f_npwp->ReadOnly && !$this->f_npwp->Upload->KeepFile) {
				$this->f_npwp->Upload->DbValue = $rsold['f_npwp']; // Get original value
				if ($this->f_npwp->Upload->FileName == "") {
					$rsnew['f_npwp'] = NULL;
				} else {
					$rsnew['f_npwp'] = $this->f_npwp->Upload->FileName;
				}
			}

			// f_nib
			if ($this->f_nib->Visible && !$this->f_nib->ReadOnly && !$this->f_nib->Upload->KeepFile) {
				$this->f_nib->Upload->DbValue = $rsold['f_nib']; // Get original value
				if ($this->f_nib->Upload->FileName == "") {
					$rsnew['f_nib'] = NULL;
				} else {
					$rsnew['f_nib'] = $this->f_nib->Upload->FileName;
				}
			}

			// f_siup
			if ($this->f_siup->Visible && !$this->f_siup->ReadOnly && !$this->f_siup->Upload->KeepFile) {
				$this->f_siup->Upload->DbValue = $rsold['f_siup']; // Get original value
				if ($this->f_siup->Upload->FileName == "") {
					$rsnew['f_siup'] = NULL;
				} else {
					$rsnew['f_siup'] = $this->f_siup->Upload->FileName;
				}
			}

			// f_tdp
			if ($this->f_tdp->Visible && !$this->f_tdp->ReadOnly && !$this->f_tdp->Upload->KeepFile) {
				$this->f_tdp->Upload->DbValue = $rsold['f_tdp']; // Get original value
				if ($this->f_tdp->Upload->FileName == "") {
					$rsnew['f_tdp'] = NULL;
				} else {
					$rsnew['f_tdp'] = $this->f_tdp->Upload->FileName;
				}
			}

			// f_lain
			if ($this->f_lain->Visible && !$this->f_lain->ReadOnly && !$this->f_lain->Upload->KeepFile) {
				$this->f_lain->Upload->DbValue = $rsold['f_lain']; // Get original value
				if ($this->f_lain->Upload->FileName == "") {
					$rsnew['f_lain'] = NULL;
				} else {
					$rsnew['f_lain'] = $this->f_lain->Upload->FileName;
				}
			}

			// sertifikat
			$this->sertifikat->setDbValueDef($rsnew, $this->sertifikat->CurrentValue, NULL, $this->sertifikat->ReadOnly);

			// sertifikat_lain
			$this->sertifikat_lain->setDbValueDef($rsnew, $this->sertifikat_lain->CurrentValue, NULL, $this->sertifikat_lain->ReadOnly);

			// f_sertifikat
			if ($this->f_sertifikat->Visible && !$this->f_sertifikat->ReadOnly && !$this->f_sertifikat->Upload->KeepFile) {
				$this->f_sertifikat->Upload->DbValue = $rsold['f_sertifikat']; // Get original value
				if ($this->f_sertifikat->Upload->FileName == "") {
					$rsnew['f_sertifikat'] = NULL;
				} else {
					$rsnew['f_sertifikat'] = $this->f_sertifikat->Upload->FileName;
				}
			}

			// alat_promosi
			$this->alat_promosi->setDbValueDef($rsnew, $this->alat_promosi->CurrentValue, NULL, $this->alat_promosi->ReadOnly);

			// promosi_lain
			$this->promosi_lain->setDbValueDef($rsnew, $this->promosi_lain->CurrentValue, NULL, $this->promosi_lain->ReadOnly);

			// f_kartunama
			if ($this->f_kartunama->Visible && !$this->f_kartunama->ReadOnly && !$this->f_kartunama->Upload->KeepFile) {
				$this->f_kartunama->Upload->DbValue = $rsold['f_kartunama']; // Get original value
				if ($this->f_kartunama->Upload->FileName == "") {
					$rsnew['f_kartunama'] = NULL;
				} else {
					$rsnew['f_kartunama'] = $this->f_kartunama->Upload->FileName;
				}
			}

			// f_brosur
			if ($this->f_brosur->Visible && !$this->f_brosur->ReadOnly && !$this->f_brosur->Upload->KeepFile) {
				$this->f_brosur->Upload->DbValue = $rsold['f_brosur']; // Get original value
				if ($this->f_brosur->Upload->FileName == "") {
					$rsnew['f_brosur'] = NULL;
				} else {
					$rsnew['f_brosur'] = $this->f_brosur->Upload->FileName;
				}
			}

			// f_katalog
			if ($this->f_katalog->Visible && !$this->f_katalog->ReadOnly && !$this->f_katalog->Upload->KeepFile) {
				$this->f_katalog->Upload->DbValue = $rsold['f_katalog']; // Get original value
				if ($this->f_katalog->Upload->FileName == "") {
					$rsnew['f_katalog'] = NULL;
				} else {
					$rsnew['f_katalog'] = $this->f_katalog->Upload->FileName;
				}
			}

			// f_profile
			if ($this->f_profile->Visible && !$this->f_profile->ReadOnly && !$this->f_profile->Upload->KeepFile) {
				$this->f_profile->Upload->DbValue = $rsold['f_profile']; // Get original value
				if ($this->f_profile->Upload->FileName == "") {
					$rsnew['f_profile'] = NULL;
				} else {
					$rsnew['f_profile'] = $this->f_profile->Upload->FileName;
				}
			}

			// tahun_ecp
			$this->tahun_ecp->setDbValueDef($rsnew, $this->tahun_ecp->CurrentValue, NULL, $this->tahun_ecp->ReadOnly);

			// Check referential integrity for master table 'excp'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_excp();
			$keyValue = isset($rsnew['rkid']) ? $rsnew['rkid'] : $rsold['rkid'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@rkid@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["excp"]))
					$GLOBALS["excp"] = new excp();
				$rsmaster = $GLOBALS["excp"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "excp", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}
			if ($this->f_npwp->Visible && !$this->f_npwp->Upload->KeepFile) {
				$this->f_npwp->UploadPath = "berkas/legalitas_ecp/";
				$oldFiles = EmptyValue($this->f_npwp->Upload->DbValue) ? [] : [$this->f_npwp->htmlDecode($this->f_npwp->Upload->DbValue)];
				if (!EmptyValue($this->f_npwp->Upload->FileName)) {
					$newFiles = [$this->f_npwp->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_npwp, $this->f_npwp->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_npwp->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_npwp->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_npwp->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_npwp->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_npwp->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_npwp->setDbValueDef($rsnew, $this->f_npwp->Upload->FileName, NULL, $this->f_npwp->ReadOnly);
				}
			}
			if ($this->f_nib->Visible && !$this->f_nib->Upload->KeepFile) {
				$this->f_nib->UploadPath = "berkas/legalitas_ecp/";
				$oldFiles = EmptyValue($this->f_nib->Upload->DbValue) ? [] : [$this->f_nib->htmlDecode($this->f_nib->Upload->DbValue)];
				if (!EmptyValue($this->f_nib->Upload->FileName)) {
					$newFiles = [$this->f_nib->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_nib, $this->f_nib->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_nib->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_nib->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_nib->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_nib->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_nib->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_nib->setDbValueDef($rsnew, $this->f_nib->Upload->FileName, NULL, $this->f_nib->ReadOnly);
				}
			}
			if ($this->f_siup->Visible && !$this->f_siup->Upload->KeepFile) {
				$this->f_siup->UploadPath = "berkas/legalitas_ecp/";
				$oldFiles = EmptyValue($this->f_siup->Upload->DbValue) ? [] : [$this->f_siup->htmlDecode($this->f_siup->Upload->DbValue)];
				if (!EmptyValue($this->f_siup->Upload->FileName)) {
					$newFiles = [$this->f_siup->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_siup, $this->f_siup->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_siup->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_siup->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_siup->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_siup->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_siup->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_siup->setDbValueDef($rsnew, $this->f_siup->Upload->FileName, NULL, $this->f_siup->ReadOnly);
				}
			}
			if ($this->f_tdp->Visible && !$this->f_tdp->Upload->KeepFile) {
				$this->f_tdp->UploadPath = "berkas/legalitas_ecp/";
				$oldFiles = EmptyValue($this->f_tdp->Upload->DbValue) ? [] : [$this->f_tdp->htmlDecode($this->f_tdp->Upload->DbValue)];
				if (!EmptyValue($this->f_tdp->Upload->FileName)) {
					$newFiles = [$this->f_tdp->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_tdp, $this->f_tdp->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_tdp->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_tdp->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_tdp->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_tdp->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_tdp->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_tdp->setDbValueDef($rsnew, $this->f_tdp->Upload->FileName, NULL, $this->f_tdp->ReadOnly);
				}
			}
			if ($this->f_lain->Visible && !$this->f_lain->Upload->KeepFile) {
				$this->f_lain->UploadPath = "berkas/legalitas_ecp/";
				$oldFiles = EmptyValue($this->f_lain->Upload->DbValue) ? [] : [$this->f_lain->htmlDecode($this->f_lain->Upload->DbValue)];
				if (!EmptyValue($this->f_lain->Upload->FileName)) {
					$newFiles = [$this->f_lain->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_lain, $this->f_lain->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_lain->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_lain->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_lain->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_lain->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_lain->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_lain->setDbValueDef($rsnew, $this->f_lain->Upload->FileName, NULL, $this->f_lain->ReadOnly);
				}
			}
			if ($this->f_sertifikat->Visible && !$this->f_sertifikat->Upload->KeepFile) {
				$this->f_sertifikat->UploadPath = "berkas/sertifikat_ecp/";
				$oldFiles = EmptyValue($this->f_sertifikat->Upload->DbValue) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->f_sertifikat->htmlDecode(strval($this->f_sertifikat->Upload->DbValue)));
				if (!EmptyValue($this->f_sertifikat->Upload->FileName)) {
					$newFiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), strval($this->f_sertifikat->Upload->FileName));
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_sertifikat, $this->f_sertifikat->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_sertifikat->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_sertifikat->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_sertifikat->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_sertifikat->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_sertifikat->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_sertifikat->setDbValueDef($rsnew, $this->f_sertifikat->Upload->FileName, NULL, $this->f_sertifikat->ReadOnly);
				}
			}
			if ($this->f_kartunama->Visible && !$this->f_kartunama->Upload->KeepFile) {
				$this->f_kartunama->UploadPath = "berkas/promosi_ecp/";
				$oldFiles = EmptyValue($this->f_kartunama->Upload->DbValue) ? [] : [$this->f_kartunama->htmlDecode($this->f_kartunama->Upload->DbValue)];
				if (!EmptyValue($this->f_kartunama->Upload->FileName)) {
					$newFiles = [$this->f_kartunama->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_kartunama, $this->f_kartunama->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_kartunama->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_kartunama->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_kartunama->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_kartunama->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_kartunama->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_kartunama->setDbValueDef($rsnew, $this->f_kartunama->Upload->FileName, NULL, $this->f_kartunama->ReadOnly);
				}
			}
			if ($this->f_brosur->Visible && !$this->f_brosur->Upload->KeepFile) {
				$this->f_brosur->UploadPath = "berkas/promosi_ecp/";
				$oldFiles = EmptyValue($this->f_brosur->Upload->DbValue) ? [] : [$this->f_brosur->htmlDecode($this->f_brosur->Upload->DbValue)];
				if (!EmptyValue($this->f_brosur->Upload->FileName)) {
					$newFiles = [$this->f_brosur->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_brosur, $this->f_brosur->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_brosur->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_brosur->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_brosur->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_brosur->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_brosur->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_brosur->setDbValueDef($rsnew, $this->f_brosur->Upload->FileName, NULL, $this->f_brosur->ReadOnly);
				}
			}
			if ($this->f_katalog->Visible && !$this->f_katalog->Upload->KeepFile) {
				$this->f_katalog->UploadPath = "berkas/promosi_ecp/";
				$oldFiles = EmptyValue($this->f_katalog->Upload->DbValue) ? [] : [$this->f_katalog->htmlDecode($this->f_katalog->Upload->DbValue)];
				if (!EmptyValue($this->f_katalog->Upload->FileName)) {
					$newFiles = [$this->f_katalog->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_katalog, $this->f_katalog->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_katalog->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_katalog->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_katalog->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_katalog->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_katalog->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_katalog->setDbValueDef($rsnew, $this->f_katalog->Upload->FileName, NULL, $this->f_katalog->ReadOnly);
				}
			}
			if ($this->f_profile->Visible && !$this->f_profile->Upload->KeepFile) {
				$this->f_profile->UploadPath = "berkas/promosi_ecp/";
				$oldFiles = EmptyValue($this->f_profile->Upload->DbValue) ? [] : [$this->f_profile->htmlDecode($this->f_profile->Upload->DbValue)];
				if (!EmptyValue($this->f_profile->Upload->FileName)) {
					$newFiles = [$this->f_profile->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->f_profile, $this->f_profile->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->f_profile->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->f_profile->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->f_profile->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->f_profile->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->f_profile->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->f_profile->setDbValueDef($rsnew, $this->f_profile->Upload->FileName, NULL, $this->f_profile->ReadOnly);
				}
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
					if ($this->f_npwp->Visible && !$this->f_npwp->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_npwp->Upload->DbValue) ? [] : [$this->f_npwp->htmlDecode($this->f_npwp->Upload->DbValue)];
						if (!EmptyValue($this->f_npwp->Upload->FileName)) {
							$newFiles = [$this->f_npwp->Upload->FileName];
							$newFiles2 = [$this->f_npwp->htmlDecode($rsnew['f_npwp'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_npwp, $this->f_npwp->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_npwp->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_npwp->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_nib->Visible && !$this->f_nib->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_nib->Upload->DbValue) ? [] : [$this->f_nib->htmlDecode($this->f_nib->Upload->DbValue)];
						if (!EmptyValue($this->f_nib->Upload->FileName)) {
							$newFiles = [$this->f_nib->Upload->FileName];
							$newFiles2 = [$this->f_nib->htmlDecode($rsnew['f_nib'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_nib, $this->f_nib->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_nib->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_nib->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_siup->Visible && !$this->f_siup->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_siup->Upload->DbValue) ? [] : [$this->f_siup->htmlDecode($this->f_siup->Upload->DbValue)];
						if (!EmptyValue($this->f_siup->Upload->FileName)) {
							$newFiles = [$this->f_siup->Upload->FileName];
							$newFiles2 = [$this->f_siup->htmlDecode($rsnew['f_siup'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_siup, $this->f_siup->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_siup->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_siup->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_tdp->Visible && !$this->f_tdp->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_tdp->Upload->DbValue) ? [] : [$this->f_tdp->htmlDecode($this->f_tdp->Upload->DbValue)];
						if (!EmptyValue($this->f_tdp->Upload->FileName)) {
							$newFiles = [$this->f_tdp->Upload->FileName];
							$newFiles2 = [$this->f_tdp->htmlDecode($rsnew['f_tdp'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_tdp, $this->f_tdp->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_tdp->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_tdp->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_lain->Visible && !$this->f_lain->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_lain->Upload->DbValue) ? [] : [$this->f_lain->htmlDecode($this->f_lain->Upload->DbValue)];
						if (!EmptyValue($this->f_lain->Upload->FileName)) {
							$newFiles = [$this->f_lain->Upload->FileName];
							$newFiles2 = [$this->f_lain->htmlDecode($rsnew['f_lain'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_lain, $this->f_lain->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_lain->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_lain->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_sertifikat->Visible && !$this->f_sertifikat->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_sertifikat->Upload->DbValue) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->f_sertifikat->htmlDecode(strval($this->f_sertifikat->Upload->DbValue)));
						if (!EmptyValue($this->f_sertifikat->Upload->FileName)) {
							$newFiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->f_sertifikat->Upload->FileName);
							$newFiles2 = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->f_sertifikat->htmlDecode($rsnew['f_sertifikat']));
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_sertifikat, $this->f_sertifikat->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_sertifikat->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_sertifikat->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_kartunama->Visible && !$this->f_kartunama->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_kartunama->Upload->DbValue) ? [] : [$this->f_kartunama->htmlDecode($this->f_kartunama->Upload->DbValue)];
						if (!EmptyValue($this->f_kartunama->Upload->FileName)) {
							$newFiles = [$this->f_kartunama->Upload->FileName];
							$newFiles2 = [$this->f_kartunama->htmlDecode($rsnew['f_kartunama'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_kartunama, $this->f_kartunama->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_kartunama->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_kartunama->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_brosur->Visible && !$this->f_brosur->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_brosur->Upload->DbValue) ? [] : [$this->f_brosur->htmlDecode($this->f_brosur->Upload->DbValue)];
						if (!EmptyValue($this->f_brosur->Upload->FileName)) {
							$newFiles = [$this->f_brosur->Upload->FileName];
							$newFiles2 = [$this->f_brosur->htmlDecode($rsnew['f_brosur'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_brosur, $this->f_brosur->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_brosur->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_brosur->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_katalog->Visible && !$this->f_katalog->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_katalog->Upload->DbValue) ? [] : [$this->f_katalog->htmlDecode($this->f_katalog->Upload->DbValue)];
						if (!EmptyValue($this->f_katalog->Upload->FileName)) {
							$newFiles = [$this->f_katalog->Upload->FileName];
							$newFiles2 = [$this->f_katalog->htmlDecode($rsnew['f_katalog'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_katalog, $this->f_katalog->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_katalog->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_katalog->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->f_profile->Visible && !$this->f_profile->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->f_profile->Upload->DbValue) ? [] : [$this->f_profile->htmlDecode($this->f_profile->Upload->DbValue)];
						if (!EmptyValue($this->f_profile->Upload->FileName)) {
							$newFiles = [$this->f_profile->Upload->FileName];
							$newFiles2 = [$this->f_profile->htmlDecode($rsnew['f_profile'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->f_profile, $this->f_profile->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->f_profile->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->f_profile->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
				}

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("t_ecp", $detailTblVar) && $GLOBALS["t_ecp"]->DetailEdit) {
						if (!isset($GLOBALS["t_ecp_grid"]))
							$GLOBALS["t_ecp_grid"] = new t_ecp_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "t_ecp"); // Load user level of detail table
						$editRow = $GLOBALS["t_ecp_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {

			// f_npwp
			CleanUploadTempPath($this->f_npwp, $this->f_npwp->Upload->Index);

			// f_nib
			CleanUploadTempPath($this->f_nib, $this->f_nib->Upload->Index);

			// f_siup
			CleanUploadTempPath($this->f_siup, $this->f_siup->Upload->Index);

			// f_tdp
			CleanUploadTempPath($this->f_tdp, $this->f_tdp->Upload->Index);

			// f_lain
			CleanUploadTempPath($this->f_lain, $this->f_lain->Upload->Index);

			// f_sertifikat
			CleanUploadTempPath($this->f_sertifikat, $this->f_sertifikat->Upload->Index);

			// f_kartunama
			CleanUploadTempPath($this->f_kartunama, $this->f_kartunama->Upload->Index);

			// f_brosur
			CleanUploadTempPath($this->f_brosur, $this->f_brosur->Upload->Index);

			// f_katalog
			CleanUploadTempPath($this->f_katalog, $this->f_katalog->Upload->Index);

			// f_profile
			CleanUploadTempPath($this->f_profile, $this->f_profile->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "excp") {
				$validMaster = TRUE;
				if (($parm = Get("fk_rkid", Get("rkid"))) !== NULL) {
					$GLOBALS["excp"]->rkid->setQueryStringValue($parm);
					$this->rkid->setQueryStringValue($GLOBALS["excp"]->rkid->QueryStringValue);
					$this->rkid->setSessionValue($this->rkid->QueryStringValue);
					if (!is_numeric($GLOBALS["excp"]->rkid->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "excp") {
				$validMaster = TRUE;
				if (($parm = Post("fk_rkid", Post("rkid"))) !== NULL) {
					$GLOBALS["excp"]->rkid->setFormValue($parm);
					$this->rkid->setFormValue($GLOBALS["excp"]->rkid->FormValue);
					$this->rkid->setSessionValue($this->rkid->FormValue);
					if (!is_numeric($GLOBALS["excp"]->rkid->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "excp") {
				if ($this->rkid->CurrentValue == "")
					$this->rkid->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("t_ecp", $detailTblVar)) {
				if (!isset($GLOBALS["t_ecp_grid"]))
					$GLOBALS["t_ecp_grid"] = new t_ecp_grid();
				if ($GLOBALS["t_ecp_grid"]->DetailEdit) {
					$GLOBALS["t_ecp_grid"]->CurrentMode = "edit";
					$GLOBALS["t_ecp_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t_ecp_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_ecp_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_ecp_grid"]->Peserta_ID->IsDetailKey = TRUE;
					$GLOBALS["t_ecp_grid"]->Peserta_ID->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t_ecp_grid"]->Peserta_ID->setSessionValue($GLOBALS["t_ecp_grid"]->Peserta_ID->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_pcplist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Set up multi pages
	protected function setupMultiPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add(0);
		$pages->add(1);
		$pages->add(2);
		$pages->add(3);
		$pages->add(4);
		$pages->add(5);
		$this->MultiPages = $pages;
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_namap":
					break;
				case "x_kategori_produk":
					break;
				case "x_kategori_produk2":
					break;
				case "x_kategori_produk3":
					break;
				case "x_jml_pegawai":
					break;
				case "x_legalitas":
					break;
				case "x_sertifikat":
					break;
				case "x_alat_promosi":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_namap":
							break;
						case "x_kategori_produk":
							break;
						case "x_kategori_produk2":
							break;
						case "x_kategori_produk3":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>