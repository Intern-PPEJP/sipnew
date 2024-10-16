<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_rpdiklat_list extends t_rpdiklat
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_rpdiklat';

	// Page object name
	public $PageObjName = "t_rpdiklat_list";

	// Grid form hidden field names
	public $FormName = "ft_rpdiklatlist";
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

		// Table object (t_rpdiklat)
		if (!isset($GLOBALS["t_rpdiklat"]) || get_class($GLOBALS["t_rpdiklat"]) == PROJECT_NAMESPACE . "t_rpdiklat") {
			$GLOBALS["t_rpdiklat"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_rpdiklat"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "t_rpdiklatadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "t_rpdiklatdelete.php";
		$this->MultiUpdateUrl = "t_rpdiklatupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_rpdiklat');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ft_rpdiklatlistsrch";

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
		global $t_rpdiklat;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_rpdiklat);
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
			$key .= @$ar['rpdid'];
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
			$this->rpdid->Visible = FALSE;
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
	public $diklatpusat_Count;
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
		$this->rpdid->Visible = FALSE;
		$this->kdjudul->setVisibility();
		$this->kdbidang->setVisibility();
		$this->kdkursil->Visible = FALSE;
		$this->iso->Visible = FALSE;
		$this->tempat->Visible = FALSE;
		$this->jml_hari->setVisibility();
		$this->jenisdurasi->setVisibility();
		$this->targetpes->setVisibility();
		$this->angkatan->setVisibility();
		$this->sisa_angkatan->setVisibility();
		$this->harga_satuan->setVisibility();
		$this->hargatotal->Visible = FALSE;
		$this->tglrevisi->Visible = FALSE;
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
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->kdbidang);
		$this->setupLookupOptions($this->kdkursil);

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
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

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

			// Audit trail on search
			if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
				$searchParm = ServerVar("QUERY_STRING");
				$searchSql = $this->getSessionWhere();
				$this->writeAuditTrailOnSearch($searchParm, $searchSql);
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
		if (count($arKeyFlds) >= 1) {
			$this->rpdid->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->rpdid->OldValue))
				return FALSE;
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
		$filterList = Concat($filterList, $this->rpdid->AdvancedSearch->toJson(), ","); // Field rpdid
		$filterList = Concat($filterList, $this->kdjudul->AdvancedSearch->toJson(), ","); // Field kdjudul
		$filterList = Concat($filterList, $this->kdbidang->AdvancedSearch->toJson(), ","); // Field kdbidang
		$filterList = Concat($filterList, $this->kdkursil->AdvancedSearch->toJson(), ","); // Field kdkursil
		$filterList = Concat($filterList, $this->iso->AdvancedSearch->toJson(), ","); // Field iso
		$filterList = Concat($filterList, $this->jml_hari->AdvancedSearch->toJson(), ","); // Field jml_hari
		$filterList = Concat($filterList, $this->jenisdurasi->AdvancedSearch->toJson(), ","); // Field jenisdurasi
		$filterList = Concat($filterList, $this->targetpes->AdvancedSearch->toJson(), ","); // Field targetpes
		$filterList = Concat($filterList, $this->angkatan->AdvancedSearch->toJson(), ","); // Field angkatan
		$filterList = Concat($filterList, $this->sisa_angkatan->AdvancedSearch->toJson(), ","); // Field sisa_angkatan
		$filterList = Concat($filterList, $this->harga_satuan->AdvancedSearch->toJson(), ","); // Field harga_satuan
		$filterList = Concat($filterList, $this->hargatotal->AdvancedSearch->toJson(), ","); // Field hargatotal
		$filterList = Concat($filterList, $this->tglrevisi->AdvancedSearch->toJson(), ","); // Field tglrevisi
		$filterList = Concat($filterList, $this->tahun_rencana->AdvancedSearch->toJson(), ","); // Field tahun_rencana

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
			$UserProfile->setSearchFilters(CurrentUserName(), "ft_rpdiklatlistsrch", $filters);
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

		// Field rpdid
		$this->rpdid->AdvancedSearch->SearchValue = @$filter["x_rpdid"];
		$this->rpdid->AdvancedSearch->SearchOperator = @$filter["z_rpdid"];
		$this->rpdid->AdvancedSearch->SearchCondition = @$filter["v_rpdid"];
		$this->rpdid->AdvancedSearch->SearchValue2 = @$filter["y_rpdid"];
		$this->rpdid->AdvancedSearch->SearchOperator2 = @$filter["w_rpdid"];
		$this->rpdid->AdvancedSearch->save();

		// Field kdjudul
		$this->kdjudul->AdvancedSearch->SearchValue = @$filter["x_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchOperator = @$filter["z_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchCondition = @$filter["v_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchValue2 = @$filter["y_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchOperator2 = @$filter["w_kdjudul"];
		$this->kdjudul->AdvancedSearch->save();

		// Field kdbidang
		$this->kdbidang->AdvancedSearch->SearchValue = @$filter["x_kdbidang"];
		$this->kdbidang->AdvancedSearch->SearchOperator = @$filter["z_kdbidang"];
		$this->kdbidang->AdvancedSearch->SearchCondition = @$filter["v_kdbidang"];
		$this->kdbidang->AdvancedSearch->SearchValue2 = @$filter["y_kdbidang"];
		$this->kdbidang->AdvancedSearch->SearchOperator2 = @$filter["w_kdbidang"];
		$this->kdbidang->AdvancedSearch->save();

		// Field kdkursil
		$this->kdkursil->AdvancedSearch->SearchValue = @$filter["x_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchOperator = @$filter["z_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchCondition = @$filter["v_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchValue2 = @$filter["y_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchOperator2 = @$filter["w_kdkursil"];
		$this->kdkursil->AdvancedSearch->save();

		// Field iso
		$this->iso->AdvancedSearch->SearchValue = @$filter["x_iso"];
		$this->iso->AdvancedSearch->SearchOperator = @$filter["z_iso"];
		$this->iso->AdvancedSearch->SearchCondition = @$filter["v_iso"];
		$this->iso->AdvancedSearch->SearchValue2 = @$filter["y_iso"];
		$this->iso->AdvancedSearch->SearchOperator2 = @$filter["w_iso"];
		$this->iso->AdvancedSearch->save();

		// Field jml_hari
		$this->jml_hari->AdvancedSearch->SearchValue = @$filter["x_jml_hari"];
		$this->jml_hari->AdvancedSearch->SearchOperator = @$filter["z_jml_hari"];
		$this->jml_hari->AdvancedSearch->SearchCondition = @$filter["v_jml_hari"];
		$this->jml_hari->AdvancedSearch->SearchValue2 = @$filter["y_jml_hari"];
		$this->jml_hari->AdvancedSearch->SearchOperator2 = @$filter["w_jml_hari"];
		$this->jml_hari->AdvancedSearch->save();

		// Field jenisdurasi
		$this->jenisdurasi->AdvancedSearch->SearchValue = @$filter["x_jenisdurasi"];
		$this->jenisdurasi->AdvancedSearch->SearchOperator = @$filter["z_jenisdurasi"];
		$this->jenisdurasi->AdvancedSearch->SearchCondition = @$filter["v_jenisdurasi"];
		$this->jenisdurasi->AdvancedSearch->SearchValue2 = @$filter["y_jenisdurasi"];
		$this->jenisdurasi->AdvancedSearch->SearchOperator2 = @$filter["w_jenisdurasi"];
		$this->jenisdurasi->AdvancedSearch->save();

		// Field targetpes
		$this->targetpes->AdvancedSearch->SearchValue = @$filter["x_targetpes"];
		$this->targetpes->AdvancedSearch->SearchOperator = @$filter["z_targetpes"];
		$this->targetpes->AdvancedSearch->SearchCondition = @$filter["v_targetpes"];
		$this->targetpes->AdvancedSearch->SearchValue2 = @$filter["y_targetpes"];
		$this->targetpes->AdvancedSearch->SearchOperator2 = @$filter["w_targetpes"];
		$this->targetpes->AdvancedSearch->save();

		// Field angkatan
		$this->angkatan->AdvancedSearch->SearchValue = @$filter["x_angkatan"];
		$this->angkatan->AdvancedSearch->SearchOperator = @$filter["z_angkatan"];
		$this->angkatan->AdvancedSearch->SearchCondition = @$filter["v_angkatan"];
		$this->angkatan->AdvancedSearch->SearchValue2 = @$filter["y_angkatan"];
		$this->angkatan->AdvancedSearch->SearchOperator2 = @$filter["w_angkatan"];
		$this->angkatan->AdvancedSearch->save();

		// Field sisa_angkatan
		$this->sisa_angkatan->AdvancedSearch->SearchValue = @$filter["x_sisa_angkatan"];
		$this->sisa_angkatan->AdvancedSearch->SearchOperator = @$filter["z_sisa_angkatan"];
		$this->sisa_angkatan->AdvancedSearch->SearchCondition = @$filter["v_sisa_angkatan"];
		$this->sisa_angkatan->AdvancedSearch->SearchValue2 = @$filter["y_sisa_angkatan"];
		$this->sisa_angkatan->AdvancedSearch->SearchOperator2 = @$filter["w_sisa_angkatan"];
		$this->sisa_angkatan->AdvancedSearch->save();

		// Field harga_satuan
		$this->harga_satuan->AdvancedSearch->SearchValue = @$filter["x_harga_satuan"];
		$this->harga_satuan->AdvancedSearch->SearchOperator = @$filter["z_harga_satuan"];
		$this->harga_satuan->AdvancedSearch->SearchCondition = @$filter["v_harga_satuan"];
		$this->harga_satuan->AdvancedSearch->SearchValue2 = @$filter["y_harga_satuan"];
		$this->harga_satuan->AdvancedSearch->SearchOperator2 = @$filter["w_harga_satuan"];
		$this->harga_satuan->AdvancedSearch->save();

		// Field hargatotal
		$this->hargatotal->AdvancedSearch->SearchValue = @$filter["x_hargatotal"];
		$this->hargatotal->AdvancedSearch->SearchOperator = @$filter["z_hargatotal"];
		$this->hargatotal->AdvancedSearch->SearchCondition = @$filter["v_hargatotal"];
		$this->hargatotal->AdvancedSearch->SearchValue2 = @$filter["y_hargatotal"];
		$this->hargatotal->AdvancedSearch->SearchOperator2 = @$filter["w_hargatotal"];
		$this->hargatotal->AdvancedSearch->save();

		// Field tglrevisi
		$this->tglrevisi->AdvancedSearch->SearchValue = @$filter["x_tglrevisi"];
		$this->tglrevisi->AdvancedSearch->SearchOperator = @$filter["z_tglrevisi"];
		$this->tglrevisi->AdvancedSearch->SearchCondition = @$filter["v_tglrevisi"];
		$this->tglrevisi->AdvancedSearch->SearchValue2 = @$filter["y_tglrevisi"];
		$this->tglrevisi->AdvancedSearch->SearchOperator2 = @$filter["w_tglrevisi"];
		$this->tglrevisi->AdvancedSearch->save();

		// Field tahun_rencana
		$this->tahun_rencana->AdvancedSearch->SearchValue = @$filter["x_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->SearchOperator = @$filter["z_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->SearchCondition = @$filter["v_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->SearchValue2 = @$filter["y_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->SearchOperator2 = @$filter["w_tahun_rencana"];
		$this->tahun_rencana->AdvancedSearch->save();
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->rpdid, $default, FALSE); // rpdid
		$this->buildSearchSql($where, $this->kdjudul, $default, FALSE); // kdjudul
		$this->buildSearchSql($where, $this->kdbidang, $default, FALSE); // kdbidang
		$this->buildSearchSql($where, $this->kdkursil, $default, FALSE); // kdkursil
		$this->buildSearchSql($where, $this->iso, $default, FALSE); // iso
		$this->buildSearchSql($where, $this->jml_hari, $default, FALSE); // jml_hari
		$this->buildSearchSql($where, $this->jenisdurasi, $default, FALSE); // jenisdurasi
		$this->buildSearchSql($where, $this->targetpes, $default, FALSE); // targetpes
		$this->buildSearchSql($where, $this->angkatan, $default, FALSE); // angkatan
		$this->buildSearchSql($where, $this->sisa_angkatan, $default, FALSE); // sisa_angkatan
		$this->buildSearchSql($where, $this->harga_satuan, $default, FALSE); // harga_satuan
		$this->buildSearchSql($where, $this->hargatotal, $default, FALSE); // hargatotal
		$this->buildSearchSql($where, $this->tglrevisi, $default, FALSE); // tglrevisi
		$this->buildSearchSql($where, $this->tahun_rencana, $default, FALSE); // tahun_rencana

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->rpdid->AdvancedSearch->save(); // rpdid
			$this->kdjudul->AdvancedSearch->save(); // kdjudul
			$this->kdbidang->AdvancedSearch->save(); // kdbidang
			$this->kdkursil->AdvancedSearch->save(); // kdkursil
			$this->iso->AdvancedSearch->save(); // iso
			$this->jml_hari->AdvancedSearch->save(); // jml_hari
			$this->jenisdurasi->AdvancedSearch->save(); // jenisdurasi
			$this->targetpes->AdvancedSearch->save(); // targetpes
			$this->angkatan->AdvancedSearch->save(); // angkatan
			$this->sisa_angkatan->AdvancedSearch->save(); // sisa_angkatan
			$this->harga_satuan->AdvancedSearch->save(); // harga_satuan
			$this->hargatotal->AdvancedSearch->save(); // hargatotal
			$this->tglrevisi->AdvancedSearch->save(); // tglrevisi
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

	// Check if search parm exists
	protected function checkSearchParms()
	{
		if ($this->rpdid->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdjudul->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdbidang->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkursil->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->iso->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jml_hari->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jenisdurasi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->targetpes->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->angkatan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->sisa_angkatan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->harga_satuan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->hargatotal->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tglrevisi->AdvancedSearch->issetSession())
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

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->rpdid->AdvancedSearch->unsetSession();
		$this->kdjudul->AdvancedSearch->unsetSession();
		$this->kdbidang->AdvancedSearch->unsetSession();
		$this->kdkursil->AdvancedSearch->unsetSession();
		$this->iso->AdvancedSearch->unsetSession();
		$this->jml_hari->AdvancedSearch->unsetSession();
		$this->jenisdurasi->AdvancedSearch->unsetSession();
		$this->targetpes->AdvancedSearch->unsetSession();
		$this->angkatan->AdvancedSearch->unsetSession();
		$this->sisa_angkatan->AdvancedSearch->unsetSession();
		$this->harga_satuan->AdvancedSearch->unsetSession();
		$this->hargatotal->AdvancedSearch->unsetSession();
		$this->tglrevisi->AdvancedSearch->unsetSession();
		$this->tahun_rencana->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->rpdid->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->kdbidang->AdvancedSearch->load();
		$this->kdkursil->AdvancedSearch->load();
		$this->iso->AdvancedSearch->load();
		$this->jml_hari->AdvancedSearch->load();
		$this->jenisdurasi->AdvancedSearch->load();
		$this->targetpes->AdvancedSearch->load();
		$this->angkatan->AdvancedSearch->load();
		$this->sisa_angkatan->AdvancedSearch->load();
		$this->harga_satuan->AdvancedSearch->load();
		$this->hargatotal->AdvancedSearch->load();
		$this->tglrevisi->AdvancedSearch->load();
		$this->tahun_rencana->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->kdjudul); // kdjudul
			$this->updateSort($this->kdbidang); // kdbidang
			$this->updateSort($this->jml_hari); // jml_hari
			$this->updateSort($this->jenisdurasi); // jenisdurasi
			$this->updateSort($this->targetpes); // targetpes
			$this->updateSort($this->angkatan); // angkatan
			$this->updateSort($this->sisa_angkatan); // sisa_angkatan
			$this->updateSort($this->harga_satuan); // harga_satuan
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
				$this->kdjudul->setSort("");
				$this->kdbidang->setSort("");
				$this->jml_hari->setSort("");
				$this->jenisdurasi->setSort("");
				$this->targetpes->setSort("");
				$this->angkatan->setSort("");
				$this->sisa_angkatan->setSort("");
				$this->harga_satuan->setSort("");
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

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = FALSE;

		// "detail_diklatpusat"
		$item = &$this->ListOptions->add("detail_diklatpusat");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'diklatpusat') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["diklatpusat_grid"]))
			$GLOBALS["diklatpusat_grid"] = new diklatpusat_grid();

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = FALSE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new SubPages();
		$pages->add("diklatpusat");
		$this->DetailPages = $pages;

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

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

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
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_diklatpusat"
		$opt = $this->ListOptions["detail_diklatpusat"];
		if ($Security->allowList(CurrentProjectID() . 'diklatpusat')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("diklatpusat", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->diklatpusat_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("diklatpusatlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_rpdiklat&fk_rpdid=" . urlencode(strval($this->rpdid->CurrentValue)) . "&fk_kdjudul=" . urlencode(strval($this->kdjudul->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["diklatpusat_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_rpdiklat')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=diklatpusat");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "diklatpusat";
			}
			if ($GLOBALS["diklatpusat_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_rpdiklat')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=diklatpusat");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "diklatpusat";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$opt = $this->ListOptions["details"];
			$opt->Body = $body;
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->rpdid->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_diklatpusat");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=diklatpusat");
		if (!isset($GLOBALS["diklatpusat"]))
			$GLOBALS["diklatpusat"] = new diklatpusat();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["diklatpusat"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["diklatpusat"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_rpdiklat') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "diklatpusat";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->add("detailsadd");
			$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
			$caption = $Language->phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = $detailTableLink != "" && $Security->canAdd();

			// Hide single master/detail items
			$ar = explode(",", $detailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = $option["detailadd_" . $ar[$i]])
					$item->Visible = FALSE;
			}
		}
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ft_rpdiklatlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ft_rpdiklatlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.ft_rpdiklatlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;

		// rpdid
		if (!$this->isAddOrEdit() && $this->rpdid->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->rpdid->AdvancedSearch->SearchValue != "" || $this->rpdid->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdjudul
		if (!$this->isAddOrEdit() && $this->kdjudul->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdjudul->AdvancedSearch->SearchValue != "" || $this->kdjudul->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdbidang
		if (!$this->isAddOrEdit() && $this->kdbidang->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdbidang->AdvancedSearch->SearchValue != "" || $this->kdbidang->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdkursil
		if (!$this->isAddOrEdit() && $this->kdkursil->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdkursil->AdvancedSearch->SearchValue != "" || $this->kdkursil->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// iso
		if (!$this->isAddOrEdit() && $this->iso->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->iso->AdvancedSearch->SearchValue != "" || $this->iso->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jml_hari
		if (!$this->isAddOrEdit() && $this->jml_hari->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jml_hari->AdvancedSearch->SearchValue != "" || $this->jml_hari->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jenisdurasi
		if (!$this->isAddOrEdit() && $this->jenisdurasi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jenisdurasi->AdvancedSearch->SearchValue != "" || $this->jenisdurasi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// targetpes
		if (!$this->isAddOrEdit() && $this->targetpes->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->targetpes->AdvancedSearch->SearchValue != "" || $this->targetpes->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// angkatan
		if (!$this->isAddOrEdit() && $this->angkatan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->angkatan->AdvancedSearch->SearchValue != "" || $this->angkatan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// sisa_angkatan
		if (!$this->isAddOrEdit() && $this->sisa_angkatan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->sisa_angkatan->AdvancedSearch->SearchValue != "" || $this->sisa_angkatan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// harga_satuan
		if (!$this->isAddOrEdit() && $this->harga_satuan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->harga_satuan->AdvancedSearch->SearchValue != "" || $this->harga_satuan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// hargatotal
		if (!$this->isAddOrEdit() && $this->hargatotal->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->hargatotal->AdvancedSearch->SearchValue != "" || $this->hargatotal->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tglrevisi
		if (!$this->isAddOrEdit() && $this->tglrevisi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tglrevisi->AdvancedSearch->SearchValue != "" || $this->tglrevisi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->rpdid->setDbValue($row['rpdid']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->kdbidang->setDbValue($row['kdbidang']);
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->iso->setDbValue($row['iso']);
		$this->tempat->setDbValue($row['tempat']);
		$this->jml_hari->setDbValue($row['jml_hari']);
		$this->jenisdurasi->setDbValue($row['jenisdurasi']);
		$this->targetpes->setDbValue($row['targetpes']);
		$this->angkatan->setDbValue($row['angkatan']);
		$this->sisa_angkatan->setDbValue($row['sisa_angkatan']);
		$this->harga_satuan->setDbValue($row['harga_satuan']);
		$this->hargatotal->setDbValue($row['hargatotal']);
		$this->tglrevisi->setDbValue($row['tglrevisi']);
		$this->tahun_rencana->setDbValue($row['tahun_rencana']);
		if (!isset($GLOBALS["diklatpusat_grid"]))
			$GLOBALS["diklatpusat_grid"] = new diklatpusat_grid();
		$detailFilter = $GLOBALS["diklatpusat"]->sqlDetailFilter_t_rpdiklat();
		$detailFilter = str_replace("@rid@", AdjustSql($this->rpdid->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@kdjudul@", AdjustSql($this->kdjudul->DbValue, "DB"), $detailFilter);
		$GLOBALS["diklatpusat"]->setCurrentMasterTable("t_rpdiklat");
		$detailFilter = $GLOBALS["diklatpusat"]->applyUserIDFilters($detailFilter);
		$this->diklatpusat_Count = $GLOBALS["diklatpusat"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['rpdid'] = NULL;
		$row['kdjudul'] = NULL;
		$row['kdbidang'] = NULL;
		$row['kdkursil'] = NULL;
		$row['iso'] = NULL;
		$row['tempat'] = NULL;
		$row['jml_hari'] = NULL;
		$row['jenisdurasi'] = NULL;
		$row['targetpes'] = NULL;
		$row['angkatan'] = NULL;
		$row['sisa_angkatan'] = NULL;
		$row['harga_satuan'] = NULL;
		$row['hargatotal'] = NULL;
		$row['tglrevisi'] = NULL;
		$row['tahun_rencana'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("rpdid")) != "")
			$this->rpdid->OldValue = $this->getKey("rpdid"); // rpdid
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
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->harga_satuan->FormValue == $this->harga_satuan->CurrentValue && is_numeric(ConvertToFloatString($this->harga_satuan->CurrentValue)))
			$this->harga_satuan->CurrentValue = ConvertToFloatString($this->harga_satuan->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// rpdid
		// kdjudul
		// kdbidang
		// kdkursil
		// iso
		// tempat
		// jml_hari
		// jenisdurasi
		// targetpes
		// angkatan
		// sisa_angkatan
		// harga_satuan
		// hargatotal
		// tglrevisi
		// tahun_rencana
		// Accumulate aggregate value

		if ($this->RowType != ROWTYPE_AGGREGATEINIT && $this->RowType != ROWTYPE_AGGREGATE) {
			if (is_numeric($this->targetpes->CurrentValue))
				$this->targetpes->Total += $this->targetpes->CurrentValue; // Accumulate total
			if (is_numeric($this->angkatan->CurrentValue))
				$this->angkatan->Total += $this->angkatan->CurrentValue; // Accumulate total
		}
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// rpdid
			$this->rpdid->ViewValue = $this->rpdid->CurrentValue;
			$this->rpdid->ViewCustomAttributes = "";

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

			// kdbidang
			$curVal = strval($this->kdbidang->CurrentValue);
			if ($curVal != "") {
				$this->kdbidang->ViewValue = $this->kdbidang->lookupCacheOption($curVal);
				if ($this->kdbidang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdbidang`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdbidang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdbidang->ViewValue = $this->kdbidang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdbidang->ViewValue = $this->kdbidang->CurrentValue;
					}
				}
			} else {
				$this->kdbidang->ViewValue = NULL;
			}
			$this->kdbidang->ViewCustomAttributes = "";

			// kdkursil
			$curVal = strval($this->kdkursil->CurrentValue);
			if ($curVal != "") {
				$this->kdkursil->ViewValue = $this->kdkursil->lookupCacheOption($curVal);
				if ($this->kdkursil->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdkursil`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdkursil->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = FormatDateTime($rswrk->fields('df3'), 0);
						$this->kdkursil->ViewValue = $this->kdkursil->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
					}
				}
			} else {
				$this->kdkursil->ViewValue = NULL;
			}
			$this->kdkursil->ViewCustomAttributes = "";

			// iso
			if (strval($this->iso->CurrentValue) != "") {
				$this->iso->ViewValue = $this->iso->optionCaption($this->iso->CurrentValue);
			} else {
				$this->iso->ViewValue = NULL;
			}
			$this->iso->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// jml_hari
			$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
			$this->jml_hari->ViewCustomAttributes = "";

			// jenisdurasi
			if (strval($this->jenisdurasi->CurrentValue) != "") {
				$this->jenisdurasi->ViewValue = $this->jenisdurasi->optionCaption($this->jenisdurasi->CurrentValue);
			} else {
				$this->jenisdurasi->ViewValue = NULL;
			}
			$this->jenisdurasi->ViewCustomAttributes = "";

			// targetpes
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->ViewCustomAttributes = "";

			// angkatan
			$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
			$this->angkatan->ViewCustomAttributes = "";

			// sisa_angkatan
			$this->sisa_angkatan->ViewValue = $this->sisa_angkatan->CurrentValue;
			$this->sisa_angkatan->ViewValue = FormatNumber($this->sisa_angkatan->ViewValue, 0, -2, -2, -2);
			$this->sisa_angkatan->ViewCustomAttributes = "";

			// harga_satuan
			$this->harga_satuan->ViewValue = $this->harga_satuan->CurrentValue;
			$this->harga_satuan->ViewValue = FormatCurrency($this->harga_satuan->ViewValue, 0, -2, -2, -2);
			$this->harga_satuan->ViewCustomAttributes = "";

			// hargatotal
			$this->hargatotal->ViewValue = $this->hargatotal->CurrentValue;
			$this->hargatotal->ViewCustomAttributes = "";

			// tglrevisi
			$this->tglrevisi->ViewValue = $this->tglrevisi->CurrentValue;
			$this->tglrevisi->ViewValue = FormatDateTime($this->tglrevisi->ViewValue, 0);
			$this->tglrevisi->ViewCustomAttributes = "";

			// tahun_rencana
			$this->tahun_rencana->ViewValue = $this->tahun_rencana->CurrentValue;
			$this->tahun_rencana->ViewCustomAttributes = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdbidang
			$this->kdbidang->LinkCustomAttributes = "";
			$this->kdbidang->HrefValue = "";
			$this->kdbidang->TooltipValue = "";

			// jml_hari
			$this->jml_hari->LinkCustomAttributes = "";
			$this->jml_hari->HrefValue = "";
			$this->jml_hari->TooltipValue = "";

			// jenisdurasi
			$this->jenisdurasi->LinkCustomAttributes = "";
			$this->jenisdurasi->HrefValue = "";
			$this->jenisdurasi->TooltipValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";
			$this->targetpes->TooltipValue = "";

			// angkatan
			$this->angkatan->LinkCustomAttributes = "";
			$this->angkatan->HrefValue = "";
			$this->angkatan->TooltipValue = "";

			// sisa_angkatan
			$this->sisa_angkatan->LinkCustomAttributes = "";
			$this->sisa_angkatan->HrefValue = "";
			$this->sisa_angkatan->TooltipValue = "";

			// harga_satuan
			$this->harga_satuan->LinkCustomAttributes = "";
			$this->harga_satuan->HrefValue = "";
			$this->harga_satuan->TooltipValue = "";

			// tahun_rencana
			$this->tahun_rencana->LinkCustomAttributes = "";
			$this->tahun_rencana->HrefValue = "";
			$this->tahun_rencana->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if (!$this->kdjudul->Raw)
				$this->kdjudul->AdvancedSearch->SearchValue = HtmlDecode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

			// kdbidang
			$this->kdbidang->EditAttrs["class"] = "form-control";
			$this->kdbidang->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdbidang->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdbidang->AdvancedSearch->ViewValue = $this->kdbidang->lookupCacheOption($curVal);
			else
				$this->kdbidang->AdvancedSearch->ViewValue = $this->kdbidang->Lookup !== NULL && is_array($this->kdbidang->Lookup->Options) ? $curVal : NULL;
			if ($this->kdbidang->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdbidang->EditValue = array_values($this->kdbidang->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdbidang`" . SearchString("=", $this->kdbidang->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kdbidang->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdbidang->EditValue = $arwrk;
			}

			// jml_hari
			$this->jml_hari->EditAttrs["class"] = "form-control";
			$this->jml_hari->EditCustomAttributes = "";
			$this->jml_hari->EditValue = HtmlEncode($this->jml_hari->AdvancedSearch->SearchValue);
			$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());

			// jenisdurasi
			$this->jenisdurasi->EditAttrs["class"] = "form-control";
			$this->jenisdurasi->EditCustomAttributes = "";
			$this->jenisdurasi->EditValue = $this->jenisdurasi->options(TRUE);

			// targetpes
			$this->targetpes->EditAttrs["class"] = "form-control";
			$this->targetpes->EditCustomAttributes = "";
			$this->targetpes->EditValue = HtmlEncode($this->targetpes->AdvancedSearch->SearchValue);
			$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

			// angkatan
			$this->angkatan->EditAttrs["class"] = "form-control";
			$this->angkatan->EditCustomAttributes = "";
			$this->angkatan->EditValue = HtmlEncode($this->angkatan->AdvancedSearch->SearchValue);
			$this->angkatan->PlaceHolder = RemoveHtml($this->angkatan->caption());

			// sisa_angkatan
			$this->sisa_angkatan->EditAttrs["class"] = "form-control";
			$this->sisa_angkatan->EditCustomAttributes = "";
			$this->sisa_angkatan->EditValue = HtmlEncode($this->sisa_angkatan->AdvancedSearch->SearchValue);
			$this->sisa_angkatan->PlaceHolder = RemoveHtml($this->sisa_angkatan->caption());

			// harga_satuan
			$this->harga_satuan->EditAttrs["class"] = "form-control";
			$this->harga_satuan->EditCustomAttributes = "";
			$this->harga_satuan->EditValue = HtmlEncode($this->harga_satuan->AdvancedSearch->SearchValue);
			$this->harga_satuan->PlaceHolder = RemoveHtml($this->harga_satuan->caption());

			// tahun_rencana
			$this->tahun_rencana->EditAttrs["class"] = "form-control";
			$this->tahun_rencana->EditCustomAttributes = "";
			$this->tahun_rencana->EditValue = HtmlEncode($this->tahun_rencana->AdvancedSearch->SearchValue);
			$this->tahun_rencana->PlaceHolder = RemoveHtml($this->tahun_rencana->caption());
		} elseif ($this->RowType == ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->targetpes->Total = 0; // Initialize total
			$this->angkatan->Total = 0; // Initialize total
		} elseif ($this->RowType == ROWTYPE_AGGREGATE) { // Aggregate row
			$this->targetpes->CurrentValue = $this->targetpes->Total;
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->ViewCustomAttributes = "";
			$this->targetpes->HrefValue = ""; // Clear href value
			$this->angkatan->CurrentValue = $this->angkatan->Total;
			$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
			$this->angkatan->ViewCustomAttributes = "";
			$this->angkatan->HrefValue = ""; // Clear href value
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
		$this->rpdid->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->kdbidang->AdvancedSearch->load();
		$this->kdkursil->AdvancedSearch->load();
		$this->iso->AdvancedSearch->load();
		$this->jml_hari->AdvancedSearch->load();
		$this->jenisdurasi->AdvancedSearch->load();
		$this->targetpes->AdvancedSearch->load();
		$this->angkatan->AdvancedSearch->load();
		$this->sisa_angkatan->AdvancedSearch->load();
		$this->harga_satuan->AdvancedSearch->load();
		$this->hargatotal->AdvancedSearch->load();
		$this->tglrevisi->AdvancedSearch->load();
		$this->tahun_rencana->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ft_rpdiklatlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ft_rpdiklatlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ft_rpdiklatlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_t_rpdiklat" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_t_rpdiklat\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ft_rpdiklatlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft_rpdiklatlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
				case "x_kdjudul":
					break;
				case "x_kdbidang":
					break;
				case "x_kdkursil":
					break;
				case "x_iso":
					break;
				case "x_jenisdurasi":
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
						case "x_kdjudul":
							break;
						case "x_kdbidang":
							break;
						case "x_kdkursil":
							$row[3] = FormatDateTime($row[3], 0);
							$row['df3'] = $row[3];
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
		$GLOBALS["ExportFileName"] = "Rencana.Program.Diklat.Th." . date("Y");
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
		//$this->harga_satuan->ViewValue = FormatCurrency($this->harga_satuan->ViewValue, 0, -2, -2, -2);

		$this->tahun_rencana->Visible = FALSE;
		if($this->Export == ""){
		$tahun = $this->tahun_rencana->AdvancedSearch->SearchValue;
		$cekdiklat = ExecuteScalar("SELECT COUNT(1) FROM t_jdiklat WHERE tahun = ".$tahun);
		if($cekdiklat > 0){
			$jmldiklat = ExecuteScalar("SELECT angkatan_reg FROM t_jdiklat WHERE tahun = ".$tahun);
			$diklat = ExecuteRow("SELECT SUM(`angkatan`) jml_angt, SUM(`targetpes`) jml_pes FROM `t_rpdiklat` WHERE `tahun_rencana` = ".$tahun);//".$this->tahun_rencana->AdvancedSearch->SearchValue);
			$sisa = $jmldiklat - $diklat["jml_angt"];
			$header = '<h5 class="alert alert-info ew-info">Tersisa '.$sisa.' dari '.$jmldiklat.' angkatan</h5>';
			if($sisa < 1){ 
				$this->OtherOptions["addedit"]->Items["add"]->Visible = FALSE;
				$header .= '<style>.ew-detail-add{display:none;}</style>';
			}
		} else {
			$header = '<h5 class="alert alert-danger alert-dismissible ew-danger">Jumlah angkatan belum diatur dalam Menu Rencana Kegiatan.</h5>'; 
			$this->OtherOptions["addedit"]->Items["add"]->Visible = FALSE;
			$header .= '<style>.ew-detail-add{display:none;}</style>';
		}
		}
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

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

		$this->ListOptions->Items["view"]->Visible = FALSE;
		$opt = &$this->ListOptions->Add("vv");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(-1); 
		$opt = &$this->ListOptions->Add("ee");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(-2); 
		 $this->ListOptions->Items["detail_diklatpusat"]->Visible = FALSE; 
	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

		$this->ListOptions->Items["vv"]->Body = '<a class="ewRowLink ewDetailView" data-action="view" data-caption="Master/Detail View" href="t_rpdiklatview.php?showdetail=diklatpusat&amp;rpdid='.$this->rpdid->CurrentValue.'" data-original-title="" title=""><span data-phrase="MasterDetailViewLink" class="icon-md-view ewIcon" data-caption="Master/Detail View"></span>&nbsp;&nbsp;Master/Detail View</a>';
		$this->ListOptions->Items["ee"]->Body = '<a class="ewRowLink ewDetailEdit" data-action="edit" data-caption="Master/Detail Edit" href="t_rpdiklatedit.php?showdetail=diklatpusat&amp;rpdid='.$this->rpdid->CurrentValue.'" data-original-title="" title=""><span data-phrase="MasterDetailEditLink" class="icon-md-edit ewIcon" data-caption="Master/Detail Edit"></span>&nbsp;&nbsp;Master/Detail Edit</a>';
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
		$_SESSION["bidang"] = "";

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		$this->ExportDoc->Text = "<style>#tdq{ background-color:#c7c6c6; } table { border-collapse: collapse; } th, td { border: thin solid #000; padding:5px;vertical-align:middle;font-size:18pt;font-family: arial;} .tdt{border-left:0;border-bottom:0;border-right:0;}.tdn{border:none;font-size:20pt;} </style>
			<table>
			<tr>
				<th colspan='18' class='tdn'>RENCANA PROGRAM DIKLAT BBPPEI TAHUN 2018</th>
			</tr>
			<tr>
				<th colspan='18' class='tdn'>Jl. Letjen S. Parman 112, Grogol, Jakarta Barat 11440</th>
			</tr>
			<tr>
				<th colspan='18' class='tdn'>Tel. (021) 5674229 <i>Ext</i>. 105, 5654962, 5663309, 56966017, 56963669   <i>Fax</i>. (021) 5663309, 5654962, 56966017</th>
			</tr>
			<tr>
				<th colspan='18' class='tdn'><i>Website</i>: http://ppei.kemendag.go.id   <i>Email</i>: promosi.ppei@kemendag.go.id</th>
			</tr>
			<tr>
				<th colspan='18' class='tdn'></th>
			</tr> 
			<tr style='height:75px;'>
				<th rowspan='2' style='width:56px'>NO</th>
				<th rowspan='2' style='width:548px'>TOPIK</th>
				<th rowspan='2' style='width:72px'>HARI</th>
				<th colspan='12'>BULAN</th>
				<th rowspan='2' style='width:120px'>TARGET PESERTA</th>
				<th rowspan='2' style='width:98px'>AKT</th>
				<th rowspan='2' style='width:170px'>HARGA</th>
			</tr>
			<tr style='height:75px;'>
				<th style='width:115px'>JAN</th>
				<th style='width:115px'>FEB</th>
				<th style='width:115px'>MAR</th>
				<th style='width:115px'>APR</th>
				<th style='width:115px'>MEI</th>
				<th style='width:115px'>JUN</th>
				<th style='width:115px'>JUL</th>
				<th style='width:115px'>AGS</th>
				<th style='width:115px'>SEP</th>
				<th style='width:115px'>OKT</th>
				<th style='width:115px'>NOP</th>
				<th style='width:115px'>DES</th>
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
				<th>18</th>
			</tr>
			<tr style='height:75px;'>
				<th>I</th>
				<th>INDIVIDU/REGULER DI PUSAT</th>
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
				<th></th>
			</tr>";
		return FALSE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {
		$bidang = $_SESSION["bidang"];
		if($this->kdbidang->CurrentValue <> $bidang){
			$arbidang = array("A"=>"Membangun Strategi Ekspor","B"=>"Persiapan Ekspor","C"=>"Negosiasi Ekspor","D"=>"Pendukung Proses Ekspor");
			$this->ExportDoc->Text .= "<tr style='height:75px;'>
			<td id='tdq' align='center'><b>".strtolower($this->kdbidang->CurrentValue)."</b></td>
			<td id='tdq'><b>".$arbidang[$this->kdbidang->CurrentValue]."</b></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			<td id='tdq'></td>
			</tr>";
			$_SESSION["no"] = 1;
		}
		$no = $_SESSION["no"]++;
		$this->ExportDoc->Text .= "<tr style='height:75px;'>
		<td align='center'>".$no."</td>
		<td>".$this->kdjudul->ViewValue."</td>
		<td align='center'>".$this->jml_hari->ViewValue."</td>";
		$bbb = 0;
		$lanjutke = 0;
		for ($x = 1; $x <= 12; $x++) {
			$pel = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `jenispel` = 1 AND `rid` = ".$this->rpdid->CurrentValue." AND `kdjudul` = '".$this->kdjudul->CurrentValue."' AND MONTH(tawal) = ".$x."");
				$lanjutke = 0;
				$gabungkolom = "";
				if($pel > 0){
					$rs = ExecuteRow("SELECT tawal,takhir FROM `t_pelatihan` WHERE `jenispel` = 1 AND `rid` = ".$this->rpdid->CurrentValue." AND `kdjudul` = '".$this->kdjudul->CurrentValue."' AND MONTH(tawal) = ".$x."");
					if(strtotime($rs['tawal']) == strtotime($rs['takhir'])){
						$tgl = "'".date("j",strtotime($rs['tawal']));
					} else {
						$bln_tawal = date("n",strtotime($rs['tawal']));
						$bln_takhir = date("n",strtotime($rs['takhir']));
						if($bln_tawal == $bln_takhir){
							$tgl = "'".date("j",strtotime($rs['tawal'])) . "-" . date("j",strtotime($rs['takhir']));
							$bbb = 0;
						} else { // bulan berbeda
							$lanjutke = $bln_takhir - $bln_tawal + 1;
							$gabungkolom = " colspan='".$lanjutke."'";
							$bbb = $x+$lanjutke;
							$tgl = "'".CSFormatTanggal(date("j-m-Y",strtotime($rs['tawal'])), false, false, true, true) . " - " . CSFormatTanggal(date("j-m-Y",strtotime($rs['takhir'])), false, false, true, true);
						}
					}
					$this->ExportDoc->Text .= "<td align='center'".$gabungkolom.">".$tgl."</td>";
				} else {
					if($x < $bbb){
						continue;
					}
					$this->ExportDoc->Text .= "<td align='center'></td>";
				}
		} 
		$this->harga_satuan->ViewValue = '<table width="100%" style="border:none"><tr><td style="border:none">Rp</td><td align="right" style="border:none">'.str_replace("Rp", "", str_replace(",", ".", FormatCurrency($this->harga_satuan->CurrentValue, 0, -2, -2, -2))).'</td></tr></table>';
		$this->ExportDoc->Text .= "
		<td align='center'>".$this->targetpes->ViewValue."</td>
		<td align='center'>".$this->angkatan->ViewValue."</td>
		<td align='right'>".$this->harga_satuan->ViewValue."</td>
		</tr>"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
		$_SESSION["bidang"] = $this->kdbidang->CurrentValue;
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {
		$this->ExportDoc->Text .= "
			<tr style='height:75px;'>
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
				<th>".$this->targetpes->Total."</th>
				<th>".$this->angkatan->Total."</th>
				<th></th>
			</tr>
			</table><br>"; // Export footer

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