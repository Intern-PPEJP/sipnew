<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class v_rencanakerjasama_list extends v_rencanakerjasama
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 'v_rencanakerjasama';

	// Page object name
	public $PageObjName = "v_rencanakerjasama_list";

	// Grid form hidden field names
	public $FormName = "fv_rencanakerjasamalist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

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

		// Table object (v_rencanakerjasama)
		if (!isset($GLOBALS["v_rencanakerjasama"]) || get_class($GLOBALS["v_rencanakerjasama"]) == PROJECT_NAMESPACE . "v_rencanakerjasama") {
			$GLOBALS["v_rencanakerjasama"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["v_rencanakerjasama"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "v_rencanakerjasamaadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "v_rencanakerjasamadelete.php";
		$this->MultiUpdateUrl = "v_rencanakerjasamaupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'v_rencanakerjasama');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fv_rencanakerjasamalistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
		global $v_rencanakerjasama;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($v_rencanakerjasama);
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,100,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canList()) {
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
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
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

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->kerjasama->setVisibility();
		$this->jenispel->setVisibility();
		$this->kdjudul->setVisibility();
		$this->jml_hari->setVisibility();
		$this->dana->setVisibility();
		$this->angkatan->setVisibility();
		$this->targetpes->setVisibility();
		$this->kontak_person->setVisibility();
		$this->rpkid->setVisibility();
		$this->tahun_rencana->setVisibility();
		$this->hideFieldsForAddEdit();

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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->kerjasama);
		$this->setupLookupOptions($this->kdjudul);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new NumericPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 0) {
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->kerjasama->AdvancedSearch->toJson(), ","); // Field kerjasama
		$filterList = Concat($filterList, $this->jenispel->AdvancedSearch->toJson(), ","); // Field jenispel
		$filterList = Concat($filterList, $this->kdjudul->AdvancedSearch->toJson(), ","); // Field kdjudul
		$filterList = Concat($filterList, $this->jml_hari->AdvancedSearch->toJson(), ","); // Field jml_hari
		$filterList = Concat($filterList, $this->dana->AdvancedSearch->toJson(), ","); // Field dana
		$filterList = Concat($filterList, $this->angkatan->AdvancedSearch->toJson(), ","); // Field angkatan
		$filterList = Concat($filterList, $this->targetpes->AdvancedSearch->toJson(), ","); // Field targetpes
		$filterList = Concat($filterList, $this->kontak_person->AdvancedSearch->toJson(), ","); // Field kontak_person
		$filterList = Concat($filterList, $this->rpkid->AdvancedSearch->toJson(), ","); // Field rpkid
		$filterList = Concat($filterList, $this->tahun_rencana->AdvancedSearch->toJson(), ","); // Field tahun_rencana
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fv_rencanakerjasamalistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field kerjasama
		$this->kerjasama->AdvancedSearch->SearchValue = @$filter["x_kerjasama"];
		$this->kerjasama->AdvancedSearch->SearchOperator = @$filter["z_kerjasama"];
		$this->kerjasama->AdvancedSearch->SearchCondition = @$filter["v_kerjasama"];
		$this->kerjasama->AdvancedSearch->SearchValue2 = @$filter["y_kerjasama"];
		$this->kerjasama->AdvancedSearch->SearchOperator2 = @$filter["w_kerjasama"];
		$this->kerjasama->AdvancedSearch->save();

		// Field jenispel
		$this->jenispel->AdvancedSearch->SearchValue = @$filter["x_jenispel"];
		$this->jenispel->AdvancedSearch->SearchOperator = @$filter["z_jenispel"];
		$this->jenispel->AdvancedSearch->SearchCondition = @$filter["v_jenispel"];
		$this->jenispel->AdvancedSearch->SearchValue2 = @$filter["y_jenispel"];
		$this->jenispel->AdvancedSearch->SearchOperator2 = @$filter["w_jenispel"];
		$this->jenispel->AdvancedSearch->save();

		// Field kdjudul
		$this->kdjudul->AdvancedSearch->SearchValue = @$filter["x_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchOperator = @$filter["z_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchCondition = @$filter["v_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchValue2 = @$filter["y_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchOperator2 = @$filter["w_kdjudul"];
		$this->kdjudul->AdvancedSearch->save();

		// Field jml_hari
		$this->jml_hari->AdvancedSearch->SearchValue = @$filter["x_jml_hari"];
		$this->jml_hari->AdvancedSearch->SearchOperator = @$filter["z_jml_hari"];
		$this->jml_hari->AdvancedSearch->SearchCondition = @$filter["v_jml_hari"];
		$this->jml_hari->AdvancedSearch->SearchValue2 = @$filter["y_jml_hari"];
		$this->jml_hari->AdvancedSearch->SearchOperator2 = @$filter["w_jml_hari"];
		$this->jml_hari->AdvancedSearch->save();

		// Field dana
		$this->dana->AdvancedSearch->SearchValue = @$filter["x_dana"];
		$this->dana->AdvancedSearch->SearchOperator = @$filter["z_dana"];
		$this->dana->AdvancedSearch->SearchCondition = @$filter["v_dana"];
		$this->dana->AdvancedSearch->SearchValue2 = @$filter["y_dana"];
		$this->dana->AdvancedSearch->SearchOperator2 = @$filter["w_dana"];
		$this->dana->AdvancedSearch->save();

		// Field angkatan
		$this->angkatan->AdvancedSearch->SearchValue = @$filter["x_angkatan"];
		$this->angkatan->AdvancedSearch->SearchOperator = @$filter["z_angkatan"];
		$this->angkatan->AdvancedSearch->SearchCondition = @$filter["v_angkatan"];
		$this->angkatan->AdvancedSearch->SearchValue2 = @$filter["y_angkatan"];
		$this->angkatan->AdvancedSearch->SearchOperator2 = @$filter["w_angkatan"];
		$this->angkatan->AdvancedSearch->save();

		// Field targetpes
		$this->targetpes->AdvancedSearch->SearchValue = @$filter["x_targetpes"];
		$this->targetpes->AdvancedSearch->SearchOperator = @$filter["z_targetpes"];
		$this->targetpes->AdvancedSearch->SearchCondition = @$filter["v_targetpes"];
		$this->targetpes->AdvancedSearch->SearchValue2 = @$filter["y_targetpes"];
		$this->targetpes->AdvancedSearch->SearchOperator2 = @$filter["w_targetpes"];
		$this->targetpes->AdvancedSearch->save();

		// Field kontak_person
		$this->kontak_person->AdvancedSearch->SearchValue = @$filter["x_kontak_person"];
		$this->kontak_person->AdvancedSearch->SearchOperator = @$filter["z_kontak_person"];
		$this->kontak_person->AdvancedSearch->SearchCondition = @$filter["v_kontak_person"];
		$this->kontak_person->AdvancedSearch->SearchValue2 = @$filter["y_kontak_person"];
		$this->kontak_person->AdvancedSearch->SearchOperator2 = @$filter["w_kontak_person"];
		$this->kontak_person->AdvancedSearch->save();

		// Field rpkid
		$this->rpkid->AdvancedSearch->SearchValue = @$filter["x_rpkid"];
		$this->rpkid->AdvancedSearch->SearchOperator = @$filter["z_rpkid"];
		$this->rpkid->AdvancedSearch->SearchCondition = @$filter["v_rpkid"];
		$this->rpkid->AdvancedSearch->SearchValue2 = @$filter["y_rpkid"];
		$this->rpkid->AdvancedSearch->SearchOperator2 = @$filter["w_rpkid"];
		$this->rpkid->AdvancedSearch->save();

		// Field tahun_rencana
		$this->tahun_rencana->AdvancedSearch->SearchValue = @$filter["x_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->SearchOperator = @$filter["z_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->SearchCondition = @$filter["v_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->SearchValue2 = @$filter["y_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->SearchOperator2 = @$filter["w_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->kerjasama, $default, FALSE); // kerjasama
		$this->buildSearchSql($where, $this->jenispel, $default, FALSE); // jenispel
		$this->buildSearchSql($where, $this->kdjudul, $default, FALSE); // kdjudul
		$this->buildSearchSql($where, $this->jml_hari, $default, FALSE); // jml_hari
		$this->buildSearchSql($where, $this->dana, $default, FALSE); // dana
		$this->buildSearchSql($where, $this->angkatan, $default, FALSE); // angkatan
		$this->buildSearchSql($where, $this->targetpes, $default, FALSE); // targetpes
		$this->buildSearchSql($where, $this->kontak_person, $default, FALSE); // kontak_person
		$this->buildSearchSql($where, $this->rpkid, $default, FALSE); // rpkid
		$this->buildSearchSql($where, $this->tahun_rencana, $default, FALSE); // tahun_rencana

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->kerjasama->AdvancedSearch->save(); // kerjasama
			$this->jenispel->AdvancedSearch->save(); // jenispel
			$this->kdjudul->AdvancedSearch->save(); // kdjudul
			$this->jml_hari->AdvancedSearch->save(); // jml_hari
			$this->dana->AdvancedSearch->save(); // dana
			$this->angkatan->AdvancedSearch->save(); // angkatan
			$this->targetpes->AdvancedSearch->save(); // targetpes
			$this->kontak_person->AdvancedSearch->save(); // kontak_person
			$this->rpkid->AdvancedSearch->save(); // rpkid
			$this->tahun_rencana->AdvancedSearch->save(); // tahun_rencana
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 || !IsMultiSearchOperator($fldOpr))
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal != "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 != "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 != "")
				$wrk = ($wrk != "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE"))
			return $fldVal;
		$value = $fldVal;
		if ($fld->isBoolean()) {
			if ($fldVal != "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal != "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->kontak_person, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->kerjasama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jenispel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdjudul->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jml_hari->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->dana->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->angkatan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->targetpes->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kontak_person->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->rpkid->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tahun_rencana->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->kerjasama->AdvancedSearch->unsetSession();
		$this->jenispel->AdvancedSearch->unsetSession();
		$this->kdjudul->AdvancedSearch->unsetSession();
		$this->jml_hari->AdvancedSearch->unsetSession();
		$this->dana->AdvancedSearch->unsetSession();
		$this->angkatan->AdvancedSearch->unsetSession();
		$this->targetpes->AdvancedSearch->unsetSession();
		$this->kontak_person->AdvancedSearch->unsetSession();
		$this->rpkid->AdvancedSearch->unsetSession();
		$this->tahun_rencana->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->kerjasama->AdvancedSearch->load();
		$this->jenispel->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->jml_hari->AdvancedSearch->load();
		$this->dana->AdvancedSearch->load();
		$this->angkatan->AdvancedSearch->load();
		$this->targetpes->AdvancedSearch->load();
		$this->kontak_person->AdvancedSearch->load();
		$this->rpkid->AdvancedSearch->load();
		$this->tahun_rencana->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->kerjasama); // kerjasama
			$this->updateSort($this->jenispel); // jenispel
			$this->updateSort($this->kdjudul); // kdjudul
			$this->updateSort($this->jml_hari); // jml_hari
			$this->updateSort($this->dana); // dana
			$this->updateSort($this->angkatan); // angkatan
			$this->updateSort($this->targetpes); // targetpes
			$this->updateSort($this->kontak_person); // kontak_person
			$this->updateSort($this->rpkid); // rpkid
			$this->updateSort($this->tahun_rencana); // tahun_rencana
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
				$this->tahun_rencana->setSort("DESC");
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
				$this->kerjasama->setSort("");
				$this->jenispel->setSort("");
				$this->kdjudul->setSort("");
				$this->jml_hari->setSort("");
				$this->dana->setSort("");
				$this->angkatan->setSort("");
				$this->targetpes->setSort("");
				$this->kontak_person->setSort("");
				$this->rpkid->setSort("");
				$this->tahun_rencana->setSort("");
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "sequence"
		$opt = $this->ListOptions["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecordCount);

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fv_rencanakerjasamalistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fv_rencanakerjasamalistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fv_rencanakerjasamalist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;

		// kerjasama
		if (!$this->isAddOrEdit() && $this->kerjasama->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kerjasama->AdvancedSearch->SearchValue != "" || $this->kerjasama->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jenispel
		if (!$this->isAddOrEdit() && $this->jenispel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jenispel->AdvancedSearch->SearchValue != "" || $this->jenispel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdjudul
		if (!$this->isAddOrEdit() && $this->kdjudul->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdjudul->AdvancedSearch->SearchValue != "" || $this->kdjudul->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jml_hari
		if (!$this->isAddOrEdit() && $this->jml_hari->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jml_hari->AdvancedSearch->SearchValue != "" || $this->jml_hari->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// dana
		if (!$this->isAddOrEdit() && $this->dana->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->dana->AdvancedSearch->SearchValue != "" || $this->dana->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// angkatan
		if (!$this->isAddOrEdit() && $this->angkatan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->angkatan->AdvancedSearch->SearchValue != "" || $this->angkatan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// targetpes
		if (!$this->isAddOrEdit() && $this->targetpes->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->targetpes->AdvancedSearch->SearchValue != "" || $this->targetpes->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kontak_person
		if (!$this->isAddOrEdit() && $this->kontak_person->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kontak_person->AdvancedSearch->SearchValue != "" || $this->kontak_person->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// rpkid
		if (!$this->isAddOrEdit() && $this->rpkid->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->rpkid->AdvancedSearch->SearchValue != "" || $this->rpkid->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tahun_rencana
		if (!$this->isAddOrEdit() && $this->tahun_rencana->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tahun_rencana->AdvancedSearch->SearchValue != "" || $this->tahun_rencana->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
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
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())]);
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
		$this->kerjasama->setDbValue($row['kerjasama']);
		$this->jenispel->setDbValue($row['jenispel']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->jml_hari->setDbValue($row['jml_hari']);
		$this->dana->setDbValue($row['dana']);
		$this->angkatan->setDbValue($row['angkatan']);
		$this->targetpes->setDbValue($row['targetpes']);
		$this->kontak_person->setDbValue($row['kontak_person']);
		$this->rpkid->setDbValue($row['rpkid']);
		$this->tahun_rencana->setDbValue($row['tahun_rencana']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['kerjasama'] = NULL;
		$row['jenispel'] = NULL;
		$row['kdjudul'] = NULL;
		$row['jml_hari'] = NULL;
		$row['dana'] = NULL;
		$row['angkatan'] = NULL;
		$row['targetpes'] = NULL;
		$row['kontak_person'] = NULL;
		$row['rpkid'] = NULL;
		$row['tahun_rencana'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{
		return FALSE;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->jml_hari->FormValue == $this->jml_hari->CurrentValue && is_numeric(ConvertToFloatString($this->jml_hari->CurrentValue)))
			$this->jml_hari->CurrentValue = ConvertToFloatString($this->jml_hari->CurrentValue);

		// Convert decimal values if posted back
		if ($this->dana->FormValue == $this->dana->CurrentValue && is_numeric(ConvertToFloatString($this->dana->CurrentValue)))
			$this->dana->CurrentValue = ConvertToFloatString($this->dana->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// kerjasama
		// jenispel
		// kdjudul
		// jml_hari
		// dana
		// angkatan
		// targetpes
		// kontak_person
		// rpkid
		// tahun_rencana

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kerjasama
			$this->kerjasama->ViewValue = $this->kerjasama->CurrentValue;
			$curVal = strval($this->kerjasama->CurrentValue);
			if ($curVal != "") {
				$this->kerjasama->ViewValue = $this->kerjasama->lookupCacheOption($curVal);
				if ($this->kerjasama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kerjasama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kerjasama->ViewValue = $this->kerjasama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kerjasama->ViewValue = $this->kerjasama->CurrentValue;
					}
				}
			} else {
				$this->kerjasama->ViewValue = NULL;
			}
			$this->kerjasama->ViewCustomAttributes = "";

			// jenispel
			if (strval($this->jenispel->CurrentValue) != "") {
				$this->jenispel->ViewValue = $this->jenispel->optionCaption($this->jenispel->CurrentValue);
			} else {
				$this->jenispel->ViewValue = NULL;
			}
			$this->jenispel->ViewCustomAttributes = "";

			// kdjudul
			if ($this->kdjudul->VirtualValue != "") {
				$this->kdjudul->ViewValue = $this->kdjudul->VirtualValue;
			} else {
				$this->kdjudul->ViewValue = $this->kdjudul->CurrentValue;
				$curVal = strval($this->kdjudul->CurrentValue);
				if ($curVal != "") {
					$this->kdjudul->ViewValue = $this->kdjudul->lookupCacheOption($curVal);
					if ($this->kdjudul->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`kdjudul`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->kdjudul->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdjudul->ViewValue = $this->kdjudul->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdjudul->ViewValue = $this->kdjudul->CurrentValue;
						}
					}
				} else {
					$this->kdjudul->ViewValue = NULL;
				}
			}
			$this->kdjudul->ViewCustomAttributes = "";

			// jml_hari
			$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
			$this->jml_hari->ViewValue = FormatNumber($this->jml_hari->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->jml_hari->ViewCustomAttributes = "";

			// dana
			$this->dana->ViewValue = $this->dana->CurrentValue;
			$this->dana->ViewValue = FormatCurrency($this->dana->ViewValue, 0, -2, -2, -2);
			$this->dana->ViewCustomAttributes = "";

			// angkatan
			$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
			$this->angkatan->ViewCustomAttributes = "";

			// targetpes
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->ViewCustomAttributes = "";

			// kontak_person
			$this->kontak_person->ViewValue = $this->kontak_person->CurrentValue;
			$this->kontak_person->ViewCustomAttributes = "";

			// rpkid
			$this->rpkid->ViewValue = $this->rpkid->CurrentValue;
			$this->rpkid->ViewCustomAttributes = "";

			// tahun_rencana
			$this->tahun_rencana->ViewValue = $this->tahun_rencana->CurrentValue;
			$this->tahun_rencana->ViewCustomAttributes = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";
			$this->kerjasama->TooltipValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";
			$this->jenispel->TooltipValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// jml_hari
			$this->jml_hari->LinkCustomAttributes = "";
			$this->jml_hari->HrefValue = "";
			$this->jml_hari->TooltipValue = "";

			// dana
			$this->dana->LinkCustomAttributes = "";
			$this->dana->HrefValue = "";
			$this->dana->TooltipValue = "";

			// angkatan
			$this->angkatan->LinkCustomAttributes = "";
			$this->angkatan->HrefValue = "";
			$this->angkatan->TooltipValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";
			$this->targetpes->TooltipValue = "";

			// kontak_person
			$this->kontak_person->LinkCustomAttributes = "";
			$this->kontak_person->HrefValue = "";
			$this->kontak_person->TooltipValue = "";

			// rpkid
			$this->rpkid->LinkCustomAttributes = "";
			$this->rpkid->HrefValue = "";
			$this->rpkid->TooltipValue = "";

			// tahun_rencana
			$this->tahun_rencana->LinkCustomAttributes = "";
			$this->tahun_rencana->HrefValue = "";
			$this->tahun_rencana->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// kerjasama
			$this->kerjasama->EditAttrs["class"] = "form-control";
			$this->kerjasama->EditCustomAttributes = "";
			$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->AdvancedSearch->SearchValue);
			$curVal = strval($this->kerjasama->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->kerjasama->EditValue = $this->kerjasama->lookupCacheOption($curVal);
				if ($this->kerjasama->EditValue === NULL) { // Lookup from database
					$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kerjasama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kerjasama->EditValue = $this->kerjasama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->kerjasama->EditValue = NULL;
			}
			$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

			// jenispel
			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			$this->jenispel->EditValue = $this->jenispel->options(TRUE);

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if (!$this->kdjudul->Raw)
				$this->kdjudul->AdvancedSearch->SearchValue = HtmlDecode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

			// jml_hari
			$this->jml_hari->EditAttrs["class"] = "form-control";
			$this->jml_hari->EditCustomAttributes = "";
			$this->jml_hari->EditValue = HtmlEncode($this->jml_hari->AdvancedSearch->SearchValue);
			$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());

			// dana
			$this->dana->EditAttrs["class"] = "form-control";
			$this->dana->EditCustomAttributes = "";
			$this->dana->EditValue = HtmlEncode($this->dana->AdvancedSearch->SearchValue);
			$this->dana->PlaceHolder = RemoveHtml($this->dana->caption());

			// angkatan
			$this->angkatan->EditAttrs["class"] = "form-control";
			$this->angkatan->EditCustomAttributes = "";
			$this->angkatan->EditValue = HtmlEncode($this->angkatan->AdvancedSearch->SearchValue);
			$this->angkatan->PlaceHolder = RemoveHtml($this->angkatan->caption());

			// targetpes
			$this->targetpes->EditAttrs["class"] = "form-control";
			$this->targetpes->EditCustomAttributes = "";
			$this->targetpes->EditValue = HtmlEncode($this->targetpes->AdvancedSearch->SearchValue);
			$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

			// kontak_person
			$this->kontak_person->EditAttrs["class"] = "form-control";
			$this->kontak_person->EditCustomAttributes = "";
			$this->kontak_person->EditValue = HtmlEncode($this->kontak_person->AdvancedSearch->SearchValue);
			$this->kontak_person->PlaceHolder = RemoveHtml($this->kontak_person->caption());

			// rpkid
			$this->rpkid->EditAttrs["class"] = "form-control";
			$this->rpkid->EditCustomAttributes = "";
			$this->rpkid->EditValue = HtmlEncode($this->rpkid->AdvancedSearch->SearchValue);
			$this->rpkid->PlaceHolder = RemoveHtml($this->rpkid->caption());

			// tahun_rencana
			$this->tahun_rencana->EditAttrs["class"] = "form-control";
			$this->tahun_rencana->EditCustomAttributes = "";
			$this->tahun_rencana->EditValue = HtmlEncode($this->tahun_rencana->AdvancedSearch->SearchValue);
			$this->tahun_rencana->PlaceHolder = RemoveHtml($this->tahun_rencana->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;
		if (!CheckInteger($this->kerjasama->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->kerjasama->errorMessage());
		}
		if (!CheckInteger($this->tahun_rencana->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tahun_rencana->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->kerjasama->AdvancedSearch->load();
		$this->jenispel->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->jml_hari->AdvancedSearch->load();
		$this->dana->AdvancedSearch->load();
		$this->angkatan->AdvancedSearch->load();
		$this->targetpes->AdvancedSearch->load();
		$this->kontak_person->AdvancedSearch->load();
		$this->rpkid->AdvancedSearch->load();
		$this->tahun_rencana->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fv_rencanakerjasamalist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fv_rencanakerjasamalist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fv_rencanakerjasamalist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_v_rencanakerjasama" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_v_rencanakerjasama\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fv_rencanakerjasamalist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Visible = FALSE;

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
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fv_rencanakerjasamalistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
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
		$selectLimit = $this->UseSelectLimit;

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

		// Export all
		if ($this->ExportAll) {
			set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
			$this->DisplayRecords = $this->TotalRecords;
			$this->StopRecord = $this->TotalRecords;
		} else { // Export one page only
			$this->setupStartRecord(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecords <= 0) {
				$this->StopRecord = $this->TotalRecords;
			} else {
				$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
		$this->ExportDoc = GetExportDocument($this, "h");
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
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
				case "x_kerjasama":
					break;
				case "x_jenispel":
					break;
				case "x_kdjudul":
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
						case "x_kerjasama":
							break;
						case "x_kdjudul":
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
		$GLOBALS["ExportFileName"] = "Rencana.Program.Kerjasama.Th." . date("Y");
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
		$this->OtherOptions["addedit"]->UseDropDownButton = FALSE; // jangan gunakan style DropDownButton
		$my_options = &$this->OtherOptions; // pastikan menggunakan area OtherOptions
		$my_option = $my_options["addedit"]; // dekat tombol addedit
		$my_item = &$my_option->Add("mynewbutton"); // tambahkan tombol baru
		$my_item->Body = "<a class=\"btn btn-default ewAddEdit ewAdd btn-sm\" title=\"\" data-caption=\"Add\" href=\"t_rpkerjasamaadd.php?showdetail=\" data-original-title=\"Add\"><span data-phrase=\"AddLink\" class=\"glyphicon glyphicon-plus ewIcon\" data-caption=\"Add\"></span></a>"; // definisikan link, style, dan caption tombol
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

		$this->rpkid->Visible = FALSE;
		$this->dana->Visible = FALSE;
		$this->tahun_rencana->Visible = FALSE;
		$this->jml_hari->Visible = FALSE;
		$this->kdjudul->Visible = FALSE;

	//	$this->dana->ViewValue = FormatCurrency($this->dana->ViewValue, 0, -2, -2, -2);
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

	// ListOptions Load event
	function ListOptions_Load() {
		$opt = &$this->ListOptions->Add("edit");
		$opt->Header = "";
		$opt->OnLeft = FALSE; // Link on right
		$opt->MoveTo(0); // Move to first column
		$opt = &$this->ListOptions->Add("delete");
		$opt->Header = "";
		$opt->OnLeft = FALSE; 
		$opt->MoveTo(1); 
		$opt = &$this->ListOptions->Add("vdetail");
		$opt->Header = "";
		$opt->OnLeft = FALSE; 
		$opt->MoveTo(2); 
		$opt = &$this->ListOptions->Add("edetail");
		$opt->Header = "";
		$opt->OnLeft = FALSE; 
		$opt->MoveTo(3); 
	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {
		$this->ListOptions->Items["edit"]->Body = "<a class=\"ewRowLink ewEdit\" data-caption=\"Edit\" href=\"t_rpkerjasamaedit.php?showdetail=&rpkid=".$this->rpkid->CurrentValue."\" data-original-title=\"\" title=\"\"><span data-phrase=\"EditLink\" class=\"icon-edit ewIcon\" data-caption=\"Edit\"></span>&nbsp;&nbsp;Edit</a>";
		$this->ListOptions->Items["delete"]->Body = "<a class=\"ewRowLink ewDelete\" data-caption=\"Delete\" href=\"t_rpkerjasamadelete.php?rpkid=".$this->rpkid->CurrentValue."\" data-original-title=\"\" title=\"\"><span data-phrase=\"DeleteLink\" class=\"glyphicon glyphicon-trash ewIcon\" data-caption=\"Delete\"></span>&nbsp;&nbsp;Delete</a>";
		$this->ListOptions->Items["vdetail"]->Body = "<a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"Master/Detail View\" href=\"t_rpkerjasamaview.php?showdetail=diklatkerjasama&rpkid=".$this->rpkid->CurrentValue."\" data-original-title=\"\"><span data-phrase=\"MasterDetailViewLink\" class=\"icon-md-view ewIcon\" data-caption=\"Master/Detail View\"></span>&nbsp;&nbsp;Master/Detail View</a>";
		$this->ListOptions->Items["edetail"]->Body = "<a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"Master/Detail Edit\" href=\"t_rpkerjasamaedit.php?showdetail=diklatkerjasama&rpkid=".$this->rpkid->CurrentValue."\" data-original-title=\"\"><span data-phrase=\"MasterDetailEditLink\" class=\"icon-md-edit ewIcon\" data-caption=\"Master/Detail Edit\"></span>&nbsp;&nbsp;Master/Detail Edit</a>";
	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {
		$_SESSION["no"] = 1;
		$_SESSION["jp"] = "";
		$_SESSION["nokata"] = 1;
		$_SESSION["nokatb"] = 1;

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		$this->ExportDoc->Text = "<style>#tdx {background-color:#9a9999} #tdq{ background-color:#c7c6c6; } table { border-collapse: collapse; } th, td { border: thin solid #000; padding:5px;vertical-align:middle;font-size:18pt;font-family: arial;} .tdt{border-left:0;border-bottom:0;border-right:0;}.tdn{border:none;font-size:20pt;} </style>
			";
		return FALSE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {
		$no = $_SESSION["no"];
		$kepala = "<table>
			<tr>
				<th style='width:2281px;' colspan='18' class='tdn'>RENCANA PROGRAM DIKLAT BBPPEI TAHUN ".date("Y")."</th>
			</tr>
			<tr>
				<th style='width:2281px;' colspan='18' class='tdn'>Jl. Letjen S. Parman 112, Grogol, Jakarta Barat 11440</th>
			</tr>
			<tr>
				<th style='width:2281px;' colspan='18' class='tdn'>Tel. (021) 5674229 <i>Ext</i>. 105, 5654962, 5663309, 56966017, 56963669   <i>Fax</i>. (021) 5663309, 5654962, 56966017</th>
			</tr>
			<tr>
				<th style='width:2281px;' colspan='18' class='tdn'><i>Website</i>: http://ppei.kemendag.go.id   <i>Email</i>: promosi.ppei@kemendag.go.id</th>
			</tr>
			<tr>
				<th style='width:2281px;' colspan='18' class='tdn'></th>
			</tr> 
			<tr style='height:75px;'>
				<th rowspan='2' style='width:57px;'>NO</th>
				<th rowspan='2' style='width:548px;'>TOPIK</th>
				<th rowspan='2' style='width:72px;'>HARI</th>
				<th colspan='12' style='width:1212px;'>BULAN</th>
				<th rowspan='2' style='width:122px;word-wrap: break-word;'>TARGET PESERTA</th>
				<th rowspan='2' style='width:98px;'>AKT</th>
				<th rowspan='2' style='width:172px;' colspan='2'>HARGA</th>
			</tr>
			<tr style='height:75px;;'>
				<th style='width:101px;'>JAN</th>
				<th style='width:101px;'>FEB</th>
				<th style='width:101px;'>MAR</th>
				<th style='width:101px;'>APR</th>
				<th style='width:101px;'>MEI</th>
				<th style='width:101px;'>JUN</th>
				<th style='width:101px;'>JUL</th>
				<th style='width:101px;'>AGS</th>
				<th style='width:101px;'>SEP</th>
				<th style='width:101px;'>OKT</th>
				<th style='width:101px;'>NOP</th>
				<th style='width:101px;'>DES</th>
			</tr>
			<tr style='height:75px;'>
				<th>1</th>
				<th>2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
				<th>7</th>
				<th>8</th>
				<th>9</th>
				<th>10</th>
				<th>11</th>
				<th>12</th>
				<th>13</th>
				<th>14</th>
				<th>15</th>
				<th>16</th>
				<th>17</th>
				<th colspan='2'>18</th>
			</tr>
			<tr style='height:75px;'>
				<th>II</th>
				<th>KELOMPOK</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th colspan='2'></th>
			</tr>";

		//$sumtargetpes += $this->targetpes->CurrentValue;
		$lth = "<th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq'></th> <th id='tdq' colspan='2'></th> </tr>";
		$xth = "<th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx'></th> <th id='tdx' colspan='2'></th> </tr>";
		$tth = "<tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th colspan='2'></th> </tr>";
		if($_SESSION["jp"] == 11 || $_SESSION["jp"] == 10){ // Free Pusat
			$_SESSION["jp"] = 1;
		} else if($_SESSION["jp"] == 5 || $_SESSION["jp"] == 4){ // Kontraktual Pusat
			$_SESSION["jp"] = 2;
		} else if($_SESSION["jp"] == 3 || $_SESSION["jp"] == 2 || $_SESSION["jp"] == 9 || $_SESSION["jp"] == 8){ // Kerjasama Daerah Subsidi
			$_SESSION["jp"] = 3;
		} else if($_SESSION["jp"] == 7 || $_SESSION["jp"] == 6){ // Kerjasama Daerah Kontraktual
			$_SESSION["jp"] = 4;
		}
		$jenispel_before = $_SESSION["jp"];
		$jenispel = $this->jenispel->CurrentValue;
		if($jenispel == 11 || $jenispel == 10){ // Free Pusat
			$jenispel = 1;
		} else if($jenispel == 5 || $jenispel == 4){ // Kontraktual Pusat
			$jenispel = 2;
		} else if($jenispel == 3 || $jenispel == 2 || $jenispel == 9 || $jenispel == 8){ // Kerjasama Daerah Subsidi
			$jenispel = 3;
		} else if($jenispel == 7 || $jenispel == 6){ // Kerjasama Daerah Kontraktual
			$jenispel = 4;
		}
		if($jenispel <> $jenispel_before){
		if($jenispel == 1 ){ // Free Pusat
			$this->ExportDoc->Text .= $kepala;
			$this->ExportDoc->Text .= "<tr style='height:75px;'> <th id='tdx'>A</th> <th id='tdx' align='left' >KERJASAMA DI PUSAT</th>".$xth."<tr style='height:75px;'> <th id='tdq'>".Conv_Angka_Romawi($_SESSION["nokata"]++)."</th> <th id='tdq' align='left'><i>Free</i></th>".$lth;
		} else if($jenispel == 2 ){ // Kontraktual Pusat

			/*$this->ExportDoc->Text .= $tth;*/
			if($jenispel_before == ""){ $this->ExportDoc->Text .= $kepala; }
			$this->ExportDoc->Text .= "<tr style='height:75px;'> <th id='tdq'>".Conv_Angka_Romawi($_SESSION["nokata"]++)."</th> <th id='tdq' align='left'>Kontraktual</th>".$lth;
		}  else if($jenispel == 3){ // Kerjasama Daerah Subsidi
			$this->ExportDoc->Text .= $tth;
			$this->ExportDoc->Text .= $kepala;
			$this->ExportDoc->Text .= "<tr style='height:75px;'> <th id='tdx'>B</th> <th id='tdx' align='left' >KERJASAMA DI DAERAH</th>".$xth."<tr style='height:75px;'> <th id='tdq'>".Conv_Angka_Romawi($_SESSION["nokatb"]++)."</th> <th id='tdq' align='left'>Subsidi</th>".$lth;
		}  else if($jenispel == 4){ // Kerjasama Daerah Kontraktual
			$this->ExportDoc->Text .= $tth;
			$this->ExportDoc->Text .= $kepala;
			$this->ExportDoc->Text .= "<tr style='height:75px;'> <th id='tdx'>B</th> <th id='tdx' align='left' >KERJASAMA DI DAERAH</th>".$xth."<tr style='height:75px;'> <th id='tdq'>".Conv_Angka_Romawi($_SESSION["nokatb"]++)."</th> <th id='tdq' align='left'><i>Kontraktual</i></th>".$lth;
		}/*)  else if($jenispel == 9 || $jenispel == 8){ // Free Daerah
			$this->ExportDoc->Text .= $tth;
			$this->ExportDoc->Text .= $kepala;
			$this->ExportDoc->Text .= "<tr style='height:75px;'> <th id='tdx'>B</th> <th id='tdx' align='left' >KERJASAMA DI DAERAH</th>".$xth."<tr style='height:75px;'> <th id='tdq'>".Conv_Angka_Romawi($_SESSION["nokatb"]++)."</th> <th id='tdq' align='left'><i>Free</i></th>".$lth;
		} */ 
		}
		$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$this->kdjudul->ViewValue."</td><td align='center'>".$this->jml_hari->ViewValue."</td>";
		$bbb = 0;
		$lanjutke = 0;
		for ($x = 1; $x <= 12; $x++) {
			$pel = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `jenispel` > 1 AND `rid` = ".$this->rpkid->CurrentValue." AND `kdjudul` = '".$this->kdjudul->CurrentValue."' AND MONTH(tawal) = ".$x."");
				$lanjutke = 0;
				$gabungkolom = "";
				if($pel > 0){
					$rs = ExecuteRow("SELECT tawal,takhir FROM `t_pelatihan` WHERE `jenispel` > 1 AND `rid` = ".$this->rpkid->CurrentValue." AND `kdjudul` = '".$this->kdjudul->CurrentValue."' AND MONTH(tawal) = ".$x."");
					if(strtotime($rs['tawal']) == strtotime($rs['takhir'])){
						$tgl = date("j",strtotime($rs['tawal']));
					} else {
						$bln_tawal = date("n",strtotime($rs['tawal']));
						$bln_takhir = date("n",strtotime($rs['takhir']));
						if($bln_tawal == $bln_takhir){
							$tgl = date("j",strtotime($rs['tawal'])) . "-" . date("j",strtotime($rs['takhir']));
							$bbb = 0;
						} else { // bulan berbeda
							$lanjutke = $bln_takhir - $bln_tawal + 1;
							$gabungkolom = " colspan='".$lanjutke."'";
							$bbb = $x+$lanjutke;
							$tgl = CSFormatTanggal(date("j-m-Y",strtotime($rs['tawal'])), false, false, true, true) . " - " . CSFormatTanggal(date("j-m-Y",strtotime($rs['takhir'])), false, false, true, true);
						}
					}
					$this->ExportDoc->Text .= "<td align='center'".$gabungkolom.">'".$tgl."</td>";
				} else {
					if($x < $bbb){
						continue;
					}
					$this->ExportDoc->Text .= "<td align='center'></td>";
				}
		}
		$this->dana->ViewValue = '<table width="100%" style="border:none"><tr><td style="border:none">Rp</td><td align="right" style="border:none">'.str_replace("Rp", "", str_replace(",", ".", FormatCurrency($this->dana->CurrentValue, 0, -2, -2, -2))).'</td></tr></table>';
		$this->ExportDoc->Text .= "
		<td align='center'>".$this->targetpes->ViewValue."</td>
		<td align='center'>".$this->angkatan->ViewValue."</td>
		<td colspan='2'>".$this->dana->ViewValue."</td></tr>";	
		$jml_angkatan_detail = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `jenispel` > 1 AND `rid` = ".$this->rpkid->CurrentValue." AND `kdjudul` = '".$this->kdjudul->CurrentValue."'");
		$jml_peserta_detail = ExecuteScalar("SELECT SUM(targetpes) FROM `t_pelatihan` WHERE `jenispel` > 1 AND `rid` = ".$this->rpkid->CurrentValue." AND `kdjudul` = '".$this->kdjudul->CurrentValue."'");
		if($jml_angkatan_detail > 0){
		if($this->angkatan->CurrentValue <> $jml_angkatan_detail){
			$_SESSION["no"] = $_SESSION["no"] + 1;
			$tpeserta = $this->targetpes->CurrentValue - $jml_peserta_detail;
			$jangkatan = $this->angkatan->CurrentValue - $jml_angkatan_detail;
		$this->ExportDoc->Text .= "<tr><td align='center'>".$_SESSION["no"]."</td><td>".$this->kerjasama->ViewValue."</td><td align='center'>".$this->jml_hari->ViewValue."</td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td align='center'>".$tpeserta."</td> <td align='center'>".$jangkatan."</td> <td colspan='2'>".$this->dana->ViewValue."</td> </tr>";
		}
		}
		$_SESSION["no"]++;
		$_SESSION["jp"] = $this->jenispel->CurrentValue;
	}
	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {
		$this->ExportDoc->Text .= "
			<tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th colspan='2'></th> </tr></table><br><table>
			<tr style='height:75px;'>
				<th></th> <th align='left'>Total</th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th>".$this->targetpes->Total."</th> <th>".$this->angkatan->Total."</th> <th colspan='2'></th>
			</tr>
			</table><br>"; // Export footer
		unset($_SESSION["nokata"] );
		unset($_SESSION["nokatb"] );
		unset($_SESSION["jp"]);
		//echo $this->ExportDoc->Text; exit();
	}
	// Page Importing event
	function Page_Importing($reader, &$options) {
		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import
		return TRUE;
	}
	// Row Import event
	function Row_Import(&$row, $cnt) {
		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import
		return TRUE;
	}
	// Page Imported event
	function Page_Imported($reader, $results) {
		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results
	}
} // End class
?>