<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_pcp_view extends t_pcp
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_pcp';

	// Page object name
	public $PageObjName = "t_pcp_view";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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
		$keyUrl = "";
		if (Get("id") !== NULL) {
			$this->RecKey["id"] = Get("id");
			$keyUrl .= "&amp;id=" . urlencode($this->RecKey["id"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (excp)
		if (!isset($GLOBALS['excp']))
			$GLOBALS['excp'] = new excp();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;
	public $MultiPages; // Multi pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canView()) {
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
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_pcplist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->setVisibility();
		$this->rkid->setVisibility();
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
		$this->wilayah_ecp->setVisibility();
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
		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_pcplist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;

		// Set up master/detail parameters
		$this->setupMasterParms();
		if ($this->isPageRequest()) { // Validate request
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->RecKey["id"] = $this->id->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->id->setFormValue(Route(2));
				$this->RecKey["id"] = $this->id->FormValue;
			} else {
				$returnUrl = "t_pcplist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display

					// Load record based on key
					if (IsApi()) {
						$filter = $this->getRecordFilter();
						$this->CurrentFilter = $filter;
						$sql = $this->getCurrentSql();
						$conn = $this->getConnection();
						$this->Recordset = LoadRecordset($sql, $conn);
						$res = $this->Recordset && !$this->Recordset->EOF;
					} else {
						$res = $this->loadRow();
					}
					if (!$res) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "t_pcplist.php"; // No matching record, return to list
					}
			}
		} else {
			$returnUrl = "t_pcplist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Set up detail parameters
		$this->setupDetailParms();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl != "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "" && $Security->canEdit());

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());
		$option = $options["detail"];
		$detailTableLink = "";
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_t_ecp"
		$item = &$option->add("detail_t_ecp");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("t_ecp", "TblCaption");
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_ecplist.php?" . Config("TABLE_SHOW_MASTER") . "=t_pcp&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["t_ecp_grid"]))
			$GLOBALS["t_ecp_grid"] = new t_ecp_grid();
		if ($GLOBALS["t_ecp_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_pcp')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_ecp")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "t_ecp";
		}
		if ($GLOBALS["t_ecp_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_pcp')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_ecp")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "t_ecp";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_ecp');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_ecp";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$item = &$option->add("details");
			$item->Body = $body;
		}

		// Set up detail default
		$option = $options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$ar = explode(",", $detailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = TRUE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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
		if ($this->AuditTrailOnView)
			$this->writeAuditTrailOnView($row);
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

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

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

			// wilayah_ecp
			$this->wilayah_ecp->LinkCustomAttributes = "";
			$this->wilayah_ecp->HrefValue = "";
			$this->wilayah_ecp->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
				if ($GLOBALS["t_ecp_grid"]->DetailView) {
					$GLOBALS["t_ecp_grid"]->CurrentMode = "view";

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
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
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
		$this->OtherOptions["action"]->Items["add"]->Body = "";
		$this->OtherOptions["action"]->Items["edit"]->Body = "";
		$this->OtherOptions["action"]->Items["delete"]->Body = "";
		$this->OtherOptions["detail"]->Items["detail_t_ecp"]->Visible = FALSE;
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

		$this->legalitas_lain->Visible = FALSE;
		$this->sertifikat_lain->Visible = FALSE;
		$this->promosi_lain->Visible = FALSE;
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		$countdt = ExecuteScalar("SELECT COUNT(1) cc FROM `t_ecp` WHERE Peserta_ID = ".$this->id->CurrentValue);
		$footer = "<h4 class='t_head'>Data Ekspor <span class='badge badge-info'>".$countdt."</span></h4>";
		$sql = "SELECT @no:=@no+1 AS No,`Daerah`, `Produk`, `Tgl_Bln_Ekspor` 'Tgl Bln Ekspor', `Negara_Tujuan` 'Negara Tujuan', CONCAT('USD ', FORMAT(`Nilai_Ekspor_USD`,2)) 'Nilai Ekspor USD', CONCAT('Rp ',FORMAT(`Nilai_Ekspor_Rupiah`,2,'de_DE')) 'Nilai Ekspor Rupiah', `Keterangan`, `Tahun_Ekspor` 'Tahun Ekspor' FROM `t_ecp` JOIN (SELECT @no:=0) r WHERE Peserta_ID = ".$this->id->CurrentValue;
		$footer .= ExecuteHtml($sql, ["fieldcaption" => TRUE, "tablename" => ["Nama", "Perusahaan"]]); 
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
} // End class
?>