<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_biointruktur_view extends t_biointruktur
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_biointruktur';

	// Page object name
	public $PageObjName = "t_biointruktur_view";

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

		// Table object (t_biointruktur)
		if (!isset($GLOBALS["t_biointruktur"]) || get_class($GLOBALS["t_biointruktur"]) == PROJECT_NAMESPACE . "t_biointruktur") {
			$GLOBALS["t_biointruktur"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_biointruktur"];
		}
		$keyUrl = "";
		if (Get("bioid") !== NULL) {
			$this->RecKey["bioid"] = Get("bioid");
			$keyUrl .= "&amp;bioid=" . urlencode($this->RecKey["bioid"]);
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

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_biointruktur');

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
		global $t_biointruktur;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_biointruktur);
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
					if ($pageName == "t_biointrukturview.php")
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
			$key .= @$ar['bioid'];
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
			$this->bioid->Visible = FALSE;
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
	public $t_rwpendd_Count;
	public $t_rwpekerjaan_Count;
	public $t_rwtraining_Count;
	public $t_faskur_Count;
	public $cv_rwipelatihaninstruktur_Count;
	public $t_evaluasifas_Count;
	public $DetailPages; // Detail pages object

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
					$this->terminate(GetUrl("t_biointrukturlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header
		if (Get("bioid") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("bioid");
		}

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Setup export options
		$this->setupExportOptions();
		$this->bioid->setVisibility();
		$this->kdinstruktur->setVisibility();
		$this->revisi->setVisibility();
		$this->tglterbit->setVisibility();
		$this->nama->setVisibility();
		$this->komp_materi->setVisibility();
		$this->tmplahir->setVisibility();
		$this->tgllahir->setVisibility();
		$this->agama->setVisibility();
		$this->kategori->setVisibility();
		$this->instansi->setVisibility();
		$this->pekerjaan->setVisibility();
		$this->alamatkantor->setVisibility();
		$this->alamatrumah->setVisibility();
		$this->telepon->setVisibility();
		$this->hp->setVisibility();
		$this->_email->setVisibility();
		$this->fax->setVisibility();
		$this->created_by->setVisibility();
		$this->created_at->setVisibility();
		$this->updated_by->setVisibility();
		$this->updated_at->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up detail page object
		$this->setupDetailPages();

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
		$this->setupLookupOptions($this->komp_materi);
		$this->setupLookupOptions($this->agama);

		// Check permission
		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_biointrukturlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("bioid") !== NULL) {
				$this->bioid->setQueryStringValue(Get("bioid"));
				$this->RecKey["bioid"] = $this->bioid->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->bioid->setQueryStringValue(Key(0));
				$this->RecKey["bioid"] = $this->bioid->QueryStringValue;
			} elseif (Post("bioid") !== NULL) {
				$this->bioid->setFormValue(Post("bioid"));
				$this->RecKey["bioid"] = $this->bioid->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->bioid->setFormValue(Route(2));
				$this->RecKey["bioid"] = $this->bioid->FormValue;
			} else {
				$returnUrl = "t_biointrukturlist.php"; // Return to list
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
						$returnUrl = "t_biointrukturlist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "t_biointrukturlist.php"; // Not page request, return to list
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

		// "detail_t_rwpendd"
		$item = &$option->add("detail_t_rwpendd");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("t_rwpendd", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->t_rwpendd_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_rwpenddlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["t_rwpendd_grid"]))
			$GLOBALS["t_rwpendd_grid"] = new t_rwpendd_grid();
		if ($GLOBALS["t_rwpendd_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpendd")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "t_rwpendd";
		}
		if ($GLOBALS["t_rwpendd_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpendd")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "t_rwpendd";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_rwpendd');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_rwpendd";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_t_rwpekerjaan"
		$item = &$option->add("detail_t_rwpekerjaan");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("t_rwpekerjaan", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->t_rwpekerjaan_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_rwpekerjaanlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["t_rwpekerjaan_grid"]))
			$GLOBALS["t_rwpekerjaan_grid"] = new t_rwpekerjaan_grid();
		if ($GLOBALS["t_rwpekerjaan_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpekerjaan")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "t_rwpekerjaan";
		}
		if ($GLOBALS["t_rwpekerjaan_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpekerjaan")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "t_rwpekerjaan";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_rwpekerjaan');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_rwpekerjaan";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_t_rwtraining"
		$item = &$option->add("detail_t_rwtraining");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("t_rwtraining", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->t_rwtraining_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_rwtraininglist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["t_rwtraining_grid"]))
			$GLOBALS["t_rwtraining_grid"] = new t_rwtraining_grid();
		if ($GLOBALS["t_rwtraining_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwtraining")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "t_rwtraining";
		}
		if ($GLOBALS["t_rwtraining_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwtraining")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "t_rwtraining";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_rwtraining');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_rwtraining";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_t_faskur"
		$item = &$option->add("detail_t_faskur");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("t_faskur", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->t_faskur_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_faskurlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["t_faskur_grid"]))
			$GLOBALS["t_faskur_grid"] = new t_faskur_grid();
		if ($GLOBALS["t_faskur_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_faskur")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "t_faskur";
		}
		if ($GLOBALS["t_faskur_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_faskur")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "t_faskur";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_faskur');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_faskur";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_cv_rwipelatihaninstruktur"
		$item = &$option->add("detail_cv_rwipelatihaninstruktur");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("cv_rwipelatihaninstruktur", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->cv_rwipelatihaninstruktur_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("cv_rwipelatihaninstrukturlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["cv_rwipelatihaninstruktur_grid"]))
			$GLOBALS["cv_rwipelatihaninstruktur_grid"] = new cv_rwipelatihaninstruktur_grid();
		if ($GLOBALS["cv_rwipelatihaninstruktur_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=cv_rwipelatihaninstruktur")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "cv_rwipelatihaninstruktur";
		}
		if ($GLOBALS["cv_rwipelatihaninstruktur_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=cv_rwipelatihaninstruktur")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "cv_rwipelatihaninstruktur";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'cv_rwipelatihaninstruktur');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "cv_rwipelatihaninstruktur";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_t_evaluasifas"
		$item = &$option->add("detail_t_evaluasifas");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("t_evaluasifas", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->t_evaluasifas_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_evaluasifaslist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["t_evaluasifas_grid"]))
			$GLOBALS["t_evaluasifas_grid"] = new t_evaluasifas_grid();
		if ($GLOBALS["t_evaluasifas_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_evaluasifas")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "t_evaluasifas";
		}
		if ($GLOBALS["t_evaluasifas_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_evaluasifas")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "t_evaluasifas";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_evaluasifas');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_evaluasifas";
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

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->bioid->setDbValue($row['bioid']);
		$this->kdinstruktur->setDbValue($row['kdinstruktur']);
		$this->revisi->setDbValue($row['revisi']);
		$this->tglterbit->setDbValue($row['tglterbit']);
		$this->nama->setDbValue($row['nama']);
		$this->komp_materi->setDbValue($row['komp_materi']);
		$this->tmplahir->setDbValue($row['tmplahir']);
		$this->tgllahir->setDbValue($row['tgllahir']);
		$this->agama->setDbValue($row['agama']);
		$this->kategori->setDbValue($row['kategori']);
		$this->instansi->setDbValue($row['instansi']);
		$this->pekerjaan->setDbValue($row['pekerjaan']);
		$this->alamatkantor->setDbValue($row['alamatkantor']);
		$this->alamatrumah->setDbValue($row['alamatrumah']);
		$this->telepon->setDbValue($row['telepon']);
		$this->hp->setDbValue($row['hp']);
		$this->_email->setDbValue($row['email']);
		$this->fax->setDbValue($row['fax']);
		$this->created_by->setDbValue($row['created_by']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_by->setDbValue($row['updated_by']);
		$this->updated_at->setDbValue($row['updated_at']);
		if (!isset($GLOBALS["t_rwpendd_grid"]))
			$GLOBALS["t_rwpendd_grid"] = new t_rwpendd_grid();
		$detailFilter = $GLOBALS["t_rwpendd"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_rwpendd"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_rwpendd"]->applyUserIDFilters($detailFilter);
		$this->t_rwpendd_Count = $GLOBALS["t_rwpendd"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_rwpekerjaan_grid"]))
			$GLOBALS["t_rwpekerjaan_grid"] = new t_rwpekerjaan_grid();
		$detailFilter = $GLOBALS["t_rwpekerjaan"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_rwpekerjaan"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_rwpekerjaan"]->applyUserIDFilters($detailFilter);
		$this->t_rwpekerjaan_Count = $GLOBALS["t_rwpekerjaan"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_rwtraining_grid"]))
			$GLOBALS["t_rwtraining_grid"] = new t_rwtraining_grid();
		$detailFilter = $GLOBALS["t_rwtraining"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_rwtraining"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_rwtraining"]->applyUserIDFilters($detailFilter);
		$this->t_rwtraining_Count = $GLOBALS["t_rwtraining"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_faskur_grid"]))
			$GLOBALS["t_faskur_grid"] = new t_faskur_grid();
		$detailFilter = $GLOBALS["t_faskur"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_faskur"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_faskur"]->applyUserIDFilters($detailFilter);
		$this->t_faskur_Count = $GLOBALS["t_faskur"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["cv_rwipelatihaninstruktur_grid"]))
			$GLOBALS["cv_rwipelatihaninstruktur_grid"] = new cv_rwipelatihaninstruktur_grid();
		$detailFilter = $GLOBALS["cv_rwipelatihaninstruktur"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["cv_rwipelatihaninstruktur"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["cv_rwipelatihaninstruktur"]->applyUserIDFilters($detailFilter);
		$this->cv_rwipelatihaninstruktur_Count = $GLOBALS["cv_rwipelatihaninstruktur"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_evaluasifas_grid"]))
			$GLOBALS["t_evaluasifas_grid"] = new t_evaluasifas_grid();
		$detailFilter = $GLOBALS["t_evaluasifas"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_evaluasifas"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_evaluasifas"]->applyUserIDFilters($detailFilter);
		$this->t_evaluasifas_Count = $GLOBALS["t_evaluasifas"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['bioid'] = NULL;
		$row['kdinstruktur'] = NULL;
		$row['revisi'] = NULL;
		$row['tglterbit'] = NULL;
		$row['nama'] = NULL;
		$row['komp_materi'] = NULL;
		$row['tmplahir'] = NULL;
		$row['tgllahir'] = NULL;
		$row['agama'] = NULL;
		$row['kategori'] = NULL;
		$row['instansi'] = NULL;
		$row['pekerjaan'] = NULL;
		$row['alamatkantor'] = NULL;
		$row['alamatrumah'] = NULL;
		$row['telepon'] = NULL;
		$row['hp'] = NULL;
		$row['email'] = NULL;
		$row['fax'] = NULL;
		$row['created_by'] = NULL;
		$row['created_at'] = NULL;
		$row['updated_by'] = NULL;
		$row['updated_at'] = NULL;
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
		// bioid
		// kdinstruktur
		// revisi
		// tglterbit
		// nama
		// komp_materi
		// tmplahir
		// tgllahir
		// agama
		// kategori
		// instansi
		// pekerjaan
		// alamatkantor
		// alamatrumah
		// telepon
		// hp
		// email
		// fax
		// created_by
		// created_at
		// updated_by
		// updated_at

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// bioid
			$this->bioid->ViewValue = $this->bioid->CurrentValue;
			$this->bioid->ViewCustomAttributes = "";

			// kdinstruktur
			$this->kdinstruktur->ViewValue = $this->kdinstruktur->CurrentValue;
			$this->kdinstruktur->ViewCustomAttributes = "";

			// revisi
			$this->revisi->ViewValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tglterbit
			$this->tglterbit->ViewValue = $this->tglterbit->CurrentValue;
			$this->tglterbit->ViewValue = FormatDateTime($this->tglterbit->ViewValue, 0);
			$this->tglterbit->ViewCustomAttributes = "";

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// komp_materi
			$this->komp_materi->ViewValue = $this->komp_materi->CurrentValue;
			$curVal = strval($this->komp_materi->CurrentValue);
			if ($curVal != "") {
				$this->komp_materi->ViewValue = $this->komp_materi->lookupCacheOption($curVal);
				if ($this->komp_materi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->komp_materi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->komp_materi->ViewValue = $this->komp_materi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->komp_materi->ViewValue = $this->komp_materi->CurrentValue;
					}
				}
			} else {
				$this->komp_materi->ViewValue = NULL;
			}
			$this->komp_materi->ViewCustomAttributes = "";

			// tmplahir
			$this->tmplahir->ViewValue = $this->tmplahir->CurrentValue;
			$this->tmplahir->ViewCustomAttributes = "";

			// tgllahir
			$this->tgllahir->ViewValue = $this->tgllahir->CurrentValue;
			$this->tgllahir->ViewValue = FormatDateTime($this->tgllahir->ViewValue, 0);
			$this->tgllahir->ViewCustomAttributes = "";

			// agama
			$curVal = strval($this->agama->CurrentValue);
			if ($curVal != "") {
				$this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
				if ($this->agama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdagama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->agama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->agama->ViewValue = $this->agama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->agama->ViewValue = $this->agama->CurrentValue;
					}
				}
			} else {
				$this->agama->ViewValue = NULL;
			}
			$this->agama->ViewCustomAttributes = "";

			// kategori
			if (strval($this->kategori->CurrentValue) != "") {
				$this->kategori->ViewValue = $this->kategori->optionCaption($this->kategori->CurrentValue);
			} else {
				$this->kategori->ViewValue = NULL;
			}
			$this->kategori->ViewCustomAttributes = "";

			// instansi
			$this->instansi->ViewValue = $this->instansi->CurrentValue;
			$this->instansi->ViewCustomAttributes = "";

			// pekerjaan
			$this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
			$this->pekerjaan->ViewCustomAttributes = "";

			// alamatkantor
			$this->alamatkantor->ViewValue = $this->alamatkantor->CurrentValue;
			$this->alamatkantor->ViewCustomAttributes = "";

			// alamatrumah
			$this->alamatrumah->ViewValue = $this->alamatrumah->CurrentValue;
			$this->alamatrumah->ViewCustomAttributes = "";

			// telepon
			$this->telepon->ViewValue = $this->telepon->CurrentValue;
			$this->telepon->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// fax
			$this->fax->ViewValue = $this->fax->CurrentValue;
			$this->fax->ViewCustomAttributes = "";

			// bioid
			$this->bioid->LinkCustomAttributes = "";
			$this->bioid->HrefValue = "";
			$this->bioid->TooltipValue = "";

			// kdinstruktur
			$this->kdinstruktur->LinkCustomAttributes = "";
			$this->kdinstruktur->HrefValue = "";
			$this->kdinstruktur->TooltipValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";
			$this->revisi->TooltipValue = "";

			// tglterbit
			$this->tglterbit->LinkCustomAttributes = "";
			$this->tglterbit->HrefValue = "";
			$this->tglterbit->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

			// komp_materi
			$this->komp_materi->LinkCustomAttributes = "";
			$this->komp_materi->HrefValue = "";
			$this->komp_materi->TooltipValue = "";

			// tmplahir
			$this->tmplahir->LinkCustomAttributes = "";
			$this->tmplahir->HrefValue = "";
			$this->tmplahir->TooltipValue = "";

			// tgllahir
			$this->tgllahir->LinkCustomAttributes = "";
			$this->tgllahir->HrefValue = "";
			$this->tgllahir->TooltipValue = "";

			// agama
			$this->agama->LinkCustomAttributes = "";
			$this->agama->HrefValue = "";
			$this->agama->TooltipValue = "";

			// kategori
			$this->kategori->LinkCustomAttributes = "";
			$this->kategori->HrefValue = "";
			$this->kategori->TooltipValue = "";

			// instansi
			$this->instansi->LinkCustomAttributes = "";
			$this->instansi->HrefValue = "";
			$this->instansi->TooltipValue = "";

			// pekerjaan
			$this->pekerjaan->LinkCustomAttributes = "";
			$this->pekerjaan->HrefValue = "";
			$this->pekerjaan->TooltipValue = "";

			// alamatkantor
			$this->alamatkantor->LinkCustomAttributes = "";
			$this->alamatkantor->HrefValue = "";
			$this->alamatkantor->TooltipValue = "";

			// alamatrumah
			$this->alamatrumah->LinkCustomAttributes = "";
			$this->alamatrumah->HrefValue = "";
			$this->alamatrumah->TooltipValue = "";

			// telepon
			$this->telepon->LinkCustomAttributes = "";
			$this->telepon->HrefValue = "";
			$this->telepon->TooltipValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";
			$this->hp->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";
			$this->fax->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ft_biointrukturview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ft_biointrukturview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ft_biointrukturview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "email")) {
			$url = $custom ? ",url:'" . $this->pageUrl() . "export=email&amp;custom=1'" : "";
			return '<button id="emf_t_biointruktur" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_t_biointruktur\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ft_biointrukturview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = FALSE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");
		$selectLimit = FALSE;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecords = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecords = $rs->RecordCount();
		}
		$this->StartRecord = 1;
		$this->setupStartRecord(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecords <= 0) {
			$this->StopRecord = $this->TotalRecords;
		} else {
			$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRecord = 1;
			$this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");

		// Export detail records (t_rwpendd)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("t_rwpendd", explode(",", $this->getCurrentDetailTable()))) {
			global $t_rwpendd;
			if (!isset($t_rwpendd))
				$t_rwpendd = new t_rwpendd();
			$rsdetail = $t_rwpendd->loadRs($t_rwpendd->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $t_rwpendd;
					$t_rwpendd->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (t_rwpekerjaan)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("t_rwpekerjaan", explode(",", $this->getCurrentDetailTable()))) {
			global $t_rwpekerjaan;
			if (!isset($t_rwpekerjaan))
				$t_rwpekerjaan = new t_rwpekerjaan();
			$rsdetail = $t_rwpekerjaan->loadRs($t_rwpekerjaan->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $t_rwpekerjaan;
					$t_rwpekerjaan->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (t_rwtraining)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("t_rwtraining", explode(",", $this->getCurrentDetailTable()))) {
			global $t_rwtraining;
			if (!isset($t_rwtraining))
				$t_rwtraining = new t_rwtraining();
			$rsdetail = $t_rwtraining->loadRs($t_rwtraining->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $t_rwtraining;
					$t_rwtraining->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (t_faskur)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("t_faskur", explode(",", $this->getCurrentDetailTable()))) {
			global $t_faskur;
			if (!isset($t_faskur))
				$t_faskur = new t_faskur();
			$rsdetail = $t_faskur->loadRs($t_faskur->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $t_faskur;
					$t_faskur->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (cv_rwipelatihaninstruktur)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("cv_rwipelatihaninstruktur", explode(",", $this->getCurrentDetailTable()))) {
			global $cv_rwipelatihaninstruktur;
			if (!isset($cv_rwipelatihaninstruktur))
				$cv_rwipelatihaninstruktur = new cv_rwipelatihaninstruktur();
			$rsdetail = $cv_rwipelatihaninstruktur->loadRs($cv_rwipelatihaninstruktur->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $cv_rwipelatihaninstruktur;
					$cv_rwipelatihaninstruktur->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (t_evaluasifas)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("t_evaluasifas", explode(",", $this->getCurrentDetailTable()))) {
			global $t_evaluasifas;
			if (!isset($t_evaluasifas))
				$t_evaluasifas = new t_evaluasifas();
			$rsdetail = $t_evaluasifas->loadRs($t_evaluasifas->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $t_evaluasifas;
					$t_evaluasifas->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!Config("DEBUG") && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (Config("DEBUG") && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
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
			if (in_array("t_rwpendd", $detailTblVar)) {
				if (!isset($GLOBALS["t_rwpendd_grid"]))
					$GLOBALS["t_rwpendd_grid"] = new t_rwpendd_grid();
				if ($GLOBALS["t_rwpendd_grid"]->DetailView) {
					$GLOBALS["t_rwpendd_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["t_rwpendd_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_rwpendd_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_rwpendd_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_rwpendd_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_rwpendd_grid"]->bioid->setSessionValue($GLOBALS["t_rwpendd_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("t_rwpekerjaan", $detailTblVar)) {
				if (!isset($GLOBALS["t_rwpekerjaan_grid"]))
					$GLOBALS["t_rwpekerjaan_grid"] = new t_rwpekerjaan_grid();
				if ($GLOBALS["t_rwpekerjaan_grid"]->DetailView) {
					$GLOBALS["t_rwpekerjaan_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["t_rwpekerjaan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_rwpekerjaan_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_rwpekerjaan_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_rwpekerjaan_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_rwpekerjaan_grid"]->bioid->setSessionValue($GLOBALS["t_rwpekerjaan_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("t_rwtraining", $detailTblVar)) {
				if (!isset($GLOBALS["t_rwtraining_grid"]))
					$GLOBALS["t_rwtraining_grid"] = new t_rwtraining_grid();
				if ($GLOBALS["t_rwtraining_grid"]->DetailView) {
					$GLOBALS["t_rwtraining_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["t_rwtraining_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_rwtraining_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_rwtraining_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_rwtraining_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_rwtraining_grid"]->bioid->setSessionValue($GLOBALS["t_rwtraining_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("t_faskur", $detailTblVar)) {
				if (!isset($GLOBALS["t_faskur_grid"]))
					$GLOBALS["t_faskur_grid"] = new t_faskur_grid();
				if ($GLOBALS["t_faskur_grid"]->DetailView) {
					$GLOBALS["t_faskur_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["t_faskur_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_faskur_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_faskur_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_faskur_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_faskur_grid"]->bioid->setSessionValue($GLOBALS["t_faskur_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("cv_rwipelatihaninstruktur", $detailTblVar)) {
				if (!isset($GLOBALS["cv_rwipelatihaninstruktur_grid"]))
					$GLOBALS["cv_rwipelatihaninstruktur_grid"] = new cv_rwipelatihaninstruktur_grid();
				if ($GLOBALS["cv_rwipelatihaninstruktur_grid"]->DetailView) {
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->setStartRecordNumber(1);
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->bioid->setSessionValue($GLOBALS["cv_rwipelatihaninstruktur_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("t_evaluasifas", $detailTblVar)) {
				if (!isset($GLOBALS["t_evaluasifas_grid"]))
					$GLOBALS["t_evaluasifas_grid"] = new t_evaluasifas_grid();
				if ($GLOBALS["t_evaluasifas_grid"]->DetailView) {
					$GLOBALS["t_evaluasifas_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["t_evaluasifas_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_evaluasifas_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_evaluasifas_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_evaluasifas_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_evaluasifas_grid"]->bioid->setSessionValue($GLOBALS["t_evaluasifas_grid"]->bioid->CurrentValue);
					$GLOBALS["t_evaluasifas_grid"]->idpelat->setSessionValue(""); // Clear session key
					$GLOBALS["t_evaluasifas_grid"]->kurikulumid->setSessionValue(""); // Clear session key
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_biointrukturlist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add('t_rwpendd');
		$pages->add('t_rwpekerjaan');
		$pages->add('t_rwtraining');
		$pages->add('t_faskur');
		$pages->add('cv_rwipelatihaninstruktur');
		$pages->add('t_evaluasifas');
		$this->DetailPages = $pages;
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
				case "x_komp_materi":
					break;
				case "x_agama":
					break;
				case "x_kategori":
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
						case "x_komp_materi":
							break;
						case "x_agama":
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
		$GLOBALS["ExportFileName"] = "Instruktur-PPE".CurrentDate();
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

		$this->bioid->Visible = FALSE;
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		if ($this->Export == "word"){
			return FALSE;
		} else {
			return TRUE; // Return TRUE to use default export and skip Row_Export event
		}
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	if ($this->Export == "word"){
					$this->ExportDoc->Text .= "
					<style>
						#tbrw td { font-size: 10pt;}
					</style>
					<table width='100%' border='1' id='tbrw' bordercolor='black' cellpadding='5'>
					<tr>
						<td width='23%' colspan='2' rowspan='3'><img src='images/dblogo.jpg'></img></td>
						<td width='35%' colspan='4' rowspan='3' style='text-align:center'><h4>BIODATA INSTRUKTUR</h4></td>
						<td width='17%' colspan='2'>KODE INSTRUKTUR</td>
						<td width='25%' colspan='2'>".strtoupper($this->kdinstruktur->ViewValue)."</td>
					</tr>
					<tr>
						<td colspan='2'>REVISI /TGL. TERBIT</td>
						<td colspan='2'>".$this->revisi->ViewValue."/".CSFormatTanggal(date('d-m-Y', strtotime($this->tglterbit->CurrentValue)), false, false, false)."</td>
					</tr>
					<tr>
						<td colspan='2'>HALAMAN</td>
						<td colspan='2'>1 DARI 3</td>
					</tr></table>
					<br><br>
					<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
					<tr>
						<td width='35%'>Nama</td><td width='5%'>:</td><td colspan='3' width='60%'>".$this->nama->ViewValue."</td>
					</tr><tr>
						<td>Tempat/Tanggal Lahir</td><td>:</td><td colspan='3'>".$this->tmplahir->ViewValue."/".CSFormatTanggal(date('d-m-Y', strtotime($this->tgllahir->CurrentValue)), false, false, false)."</td>
					</tr><tr>
						<td>Agama</td><td>:</td><td colspan='3'>".$this->agama->ViewValue."</td>
					</tr><tr>
						<td>Pekerjaan</td><td>:</td><td colspan='3'>".$this->pekerjaan->ViewValue."</td>
					</tr><tr>
						<td>Instansi</td><td>:</td><td colspan='3'>".$this->instansi->ViewValue."</td>
					</tr><tr>
						<td>Alamat Kantor</td><td>:</td><td colspan='3'>".$this->alamatkantor->ViewValue."</td>
					</tr><tr>
						<td>Alamat Rumah</td><td>:</td><td colspan='3'>".$this->alamatrumah->ViewValue."</td>
					</tr><tr>
						<td width='35%'></td><td width='5%'>Phone</td><td width='30%'>".$this->telepon->ViewValue."</td><td width='5%'>HP</td><td width='25%'>".$this->hp->ViewValue."</td>
					</tr><tr>
						<td width='35%'></td><td width='5%'>E-mail</td><td width='30%'>".$this->_email->ViewValue."</td><td width='5%'>Fax</td><td width='25%'>".$this->fax->ViewValue."</td>
					</tr>
					</table>
					<br>
					<h4>I. RIWAYAT PENDIDIKAN</h4>
					<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
					<tr>
						<td width='5%' align='center'><b>NO</b></td>
						<td width='55%'><b>SEKOLAH/UNIVERSITAS</b></td>
						<td width='25%' align='center'><b>TEMPAT</b></td>
						<td width='15%' align='center'><b>TAHUN</b></td>
					</tr>";
					$no=1;
					$dt = Execute("SELECT sekolah,tempat,tahun FROM `t_rwpendd` WHERE bioid = ".$this->bioid->CurrentValue); 
					if ($dt->RecordCount() >0) {
						$dt->MoveFirst(); 
						while (!$dt->EOF) { 
						$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$dt->fields("sekolah")."</td><td align='center'>".$dt->fields("tempat")."</td><td align='center'>".$dt->fields("tahun")."</td></tr>"; 
						$no++;
						$dt->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
						} // akhir loop
						$dt->Close(); // tutup recordset jika sudah selesai
					} else { // jika jumlah record tidak lebih besar dari nol
						$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>"; // tampilkan pesan tidak ada record
					} 
					$this->ExportDoc->Text .= "
					</table>
					(* Lampiran foto copy ijasah S 1/S 2/S 3)
					<br>
					<br>
					<br>
					<table width='100%' border='1' id='tbrw' bordercolor='black' cellpadding='5'>
					<tr>
						<td width='23%' colspan='2' rowspan='3'><img src='images/dblogo.jpg'></img></td>
						<td width='35%' colspan='4' rowspan='3' style='text-align:center'><h4>BIODATA INSTRUKTUR</h4></td>
						<td width='17%' colspan='2'>KODE INSTRUKTUR</td>
						<td width='25%' colspan='2'>".strtoupper($this->kdinstruktur->ViewValue)."</td>
					</tr>
					<tr>
						<td colspan='2'>REVISI /TGL. TERBIT</td>
						<td colspan='2'>".$this->revisi->ViewValue."/".CSFormatTanggal(date('d-m-Y', strtotime($this->tglterbit->CurrentValue)), false, false, false)."</td>
					</tr>
					<tr>
						<td colspan='2'>HALAMAN</td>
						<td colspan='2'>2 DARI 3</td>
					</tr></table>
					<br>
					<h4>II. PENGALAMAN TRAINING</h4>
					<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
					<tr>
						<td width='5%' align='center'><b>NO</b></td>
						<td width='55%' align='center'><b>UNIT/INSTANSI/PERUSAHAAN</b></td>
						<td width='25%' align='center'><b>TEMPAT</b></td>
						<td width='15%' align='center'><b>TAHUN</b></td>
					</tr>";
					$no=1;
					$dt2 = Execute("SELECT training,tempat,tahun FROM `t_rwtraining` WHERE bioid = ".$this->bioid->CurrentValue); 
					if ($dt2->RecordCount() >0) {
						$dt2->MoveFirst(); 
						while (!$dt2->EOF) { 
						$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$dt2->fields("training")."</td><td align='center'>".$dt2->fields("tempat")."</td><td align='center'>".$dt2->fields("tahun")."</td></tr>"; 
						$no++;
						$dt2->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
						} // akhir loop
						$dt2->Close(); // tutup recordset jika sudah selesai
					} else { // jika jumlah record tidak lebih besar dari nol
						$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>"; // tampilkan pesan tidak ada record
					} 
					$this->ExportDoc->Text .= "
					</table>
					(* Lampirkan foto copy Sertifikat training)
					<br>
					<br>
					<br>
					<h4>III. PENGALAMAN KERJA</h4>
					<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
					<tr>
						<td width='5%' align='center'><b>NO</b></td>
						<td width='55%' align='center'><b>UNIT/INSTANSI/PERUSAHAAN</b></td>
						<td width='25%' align='center'><b>JABATAN</b></td>
						<td width='15%' align='center'><b>TAHUN</b></td>
					</tr>";
					$no=1;
					$dt3 = Execute("SELECT perusahaan,jabatan,mulai,hingga FROM `t_rwpekerjaan` WHERE bioid = ".$this->bioid->CurrentValue); 
					if ($dt3->RecordCount() >0) {
						$dt3->MoveFirst(); 
						while (!$dt3->EOF) { 
						$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$dt3->fields("perusahaan")."</td><td align='center'>".$dt3->fields("jabatan")."</td><td align='center'>".$dt3->fields("mulai")."-".$dt3->fields("hingga")."</td></tr>"; 
						$no++;
						$dt3->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
						} // akhir loop
						$dt3->Close(); // tutup recordset jika sudah selesai
					} else { // jika jumlah record tidak lebih besar dari nol
						$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>"; // tampilkan pesan tidak ada record
					} 
					$this->ExportDoc->Text .= "
					</table>
					<br>
					<br>
					<table width='100%' border='1' id='tbrw' bordercolor='black' cellpadding='5'>
					<tr>
						<td width='23%' colspan='2' rowspan='3'><img src='images/dblogo.jpg'></img></td>
						<td width='35%' colspan='4' rowspan='3' style='text-align:center'><h4>BIODATA INSTRUKTUR</h4></td>
						<td width='17%' colspan='2'>KODE INSTRUKTUR</td>
						<td width='25%' colspan='2'>".strtoupper($this->kdinstruktur->ViewValue)."</td>
					</tr>
					<tr>
						<td colspan='2'>REVISI /TGL. TERBIT</td>
						<td colspan='2'>".$this->revisi->ViewValue."/".CSFormatTanggal(date('d-m-Y', strtotime($this->tglterbit->CurrentValue)), false, false, false)."</td>
					</tr>
					<tr>
						<td colspan='2'>HALAMAN</td>
						<td colspan='2'>3 DARI 3</td>
					</tr></table>
					<br>
					<h4>IV. PENGALAMAN MENGAJAR</h4>
					<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
					<tr>
						<td width='5%' align='center'><b>NO</b></td>
						<td width='55%' align='center'><b>TOPIK</b></td>
						<td width='25%' align='center'><b>TEMPAT</b></td>
						<td width='15%' align='center'><b>TAHUN</b></td>
					</tr>";
					$no=1;
					$dt5 = Execute("SELECT t_kurikulum.kurikulum,YEAR(t_pelatihan.tawal) tahun, t_kota.kota
		FROM t_pelatihan INNER JOIN
		t_jadwalpel ON t_pelatihan.idpelat = t_jadwalpel.idpelat AND t_pelatihan.kdjudul = t_jadwalpel.kdjudul INNER JOIN
		t_kurikulum ON t_jadwalpel.kurikulumid = t_kurikulum.kurikulumid INNER JOIN
		t_kota ON t_kota.kdkota = t_pelatihan.kdkota
		WHERE t_jadwalpel.instruktur > 0 AND t_jadwalpel.instruktur = ".$this->bioid->CurrentValue); 
					if ($dt5->RecordCount() >0) {
						$dt5->MoveFirst(); 
						while (!$dt5->EOF) { 
						$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$dt5->fields("kurikulum")."</td><td align='center'>".str_replace(array('Kota ', 'Kab. ', ' Barat'), array('', '', ''),$dt5->fields("kota"))."</td><td align='center'>".$dt5->fields("tahun")."</td></tr>"; 
						$no++;
						$dt5->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
						} // akhir loop
						$dt5->Close(); // tutup recordset jika sudah selesai
					} else { // jika jumlah record tidak lebih besar dari nol
						$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>"; // tampilkan pesan tidak ada record
					} 
					$this->ExportDoc->Text .= "
					</table>
					<br><br><br>
					";
				} 
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
} // End class
?>