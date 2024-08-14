<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class xprint_list extends xprint
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 'xprint';

	// Page object name
	public $PageObjName = "xprint_list";

	// Grid form hidden field names
	public $FormName = "fxprintlist";
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

		// Table object (xprint)
		if (!isset($GLOBALS["xprint"]) || get_class($GLOBALS["xprint"]) == PROJECT_NAMESPACE . "xprint") {
			$GLOBALS["xprint"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["xprint"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "xprintadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "xprintdelete.php";
		$this->MultiUpdateUrl = "xprintupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'xprint');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fxprintlistsrch";

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
		global $xprint;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($xprint);
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
		if ($this->isAddOrEdit())
			$this->u->Visible = FALSE;
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
		$this->u->setVisibility();
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

			// Set up sorting order
			$this->setupSortOrder();
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

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->u); // u
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

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->u->setSort("");
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

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fxprintlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fxprintlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fxprintlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$this->u->setDbValue($row['u']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['u'] = NULL;
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

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// u

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// u
			$this->u->ViewValue = $this->u->CurrentValue;
			$this->u->ViewCustomAttributes = "";

			// u
			$this->u->LinkCustomAttributes = "";
			$this->u->HrefValue = "";
			$this->u->TooltipValue = "";
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
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fxprintlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fxprintlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fxprintlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_xprint" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_xprint\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fxprintlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		if(isset($_GET["pg"])){
			if($_GET["pg"] == "a4"){
				$GLOBALS["ExportFileName"] = "Year on Year ".$_GET["tahun"];
			} else if($_GET["pg"] == "a5"){
				$GLOBALS["ExportFileName"] = "Kota_Kab. TP-".$_GET["tahun"];
			} else if($_GET["pg"] == "a51"){
				$GLOBALS["ExportFileName"] = "Provinsi TP-".$_GET["tahun"];
			} 
			  else if(Get("pg") == "evafas"){
				$GLOBALS["ExportFileName"] = "EV_FASILITATOR_".Get("pelat");
			} else if(Get("pg") == "evakhir"){
				$GLOBALS["ExportFileName"] = "EV_AKHIR_".Get("pelat");
			} 
		}
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

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
		//$this->ListOptions["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event
		
		
		if(!isset($_GET["tahun"]) || !isset($_GET["pg"]) || empty($_GET["tahun"]) || empty($_GET["pg"])) { echo "Error!."; exit(); }
		if($this->Export == "excel"){
		$this->ExportDoc->Text = "
		<style>
		table { border-collapse: collapse; border-bottom: 1px solid #000; }
		th, td { border: 0.2px solid #000;border-width: thin; padding:5px; vertical-align: middle;}
		#trdata td { text-align: center;}
		#tdq{ background-color:#b5b5b5; font-size:15px; }
		#tdq2{ background-color:#b5b5b5; font-size:12px; }
		#tdk { border: none;  font-size:15px; }
		#tdr { border-top: none;border-bottom: none; height:33px; vertical-align: middle; }
		</style>";
		if($_GET["pg"] == "a4") { //Realisasi Jumlah Angkatan dan Peserta Pelatihan Ekspor 
		$tw = $_GET["tahun"] - 4;
		$this->ExportDoc->Text .= "Realisasi Jumlah Angkatan dan Peserta Pelatihan Ekspor <br>Tahun ".$tw." s.d ".$_GET["tahun"]."<br><br>
			<table>
			<tr>
				<th id='tdq' rowspan='2'>No</th>
				<th id='tdq' rowspan='2'>Tahun</th>
				<th id='tdq' colspan='2'>Target</th>
				<th id='tdq' colspan='2'>Realisasi</th>
			</tr><tr>
				<th id='tdq'>Angkatan</th>
				<th id='tdq'>Peserta</th>
				<th id='tdq'>Angkatan</th>
				<th id='tdq'>Peserta</th>
			</tr>"; // Export header // Export header
		} // tutup pg = a4
		
		
		
		if($_GET["pg"] == "evafas"){
			
			$vpel = @$_GET["pelat"]; // di pelatihan
			$qsql = Execute("SELECT idpelat, bioid FROM `t_evafas` a WHERE idpelat = ".$vpel." GROUP BY bioid");
			$jml_fasilitator = $qsql->RecordCount(); // jumlah fasilitator
			$pelatihan = ExecuteRow("SELECT judul, tempat, tawal, takhir FROM vt_pelatihan WHERE idpelat=".$vpel);
			$nama_pelatihan = $pelatihan["judul"];
			$tt_pelatihan = "" . $pelatihan["tempat"] . ", " . date('d F Y', strtotime($pelatihan["tawal"])) . " - " . date('d F Y', strtotime($pelatihan["takhir"])) ."";
			$this->ExportDoc->Text = "<p align='center'>".$nama_pelatihan."<br>".$tt_pelatihan."</p><p align='center'>EVALUASI FASILITATOR<br>Dalam upaya meningkatkan mutu pelatihan, kami mohon kesediaan Saudara untuk mengisi dan memberikan jawaban objektif dari evaluasi ini, Isilah kolom penilaian ini</p>";
			
			$this->ExportDoc->Text .= "<table border='1' width='100%'>";
			$jmlkolfas = $jml_fasilitator*2; // masih statis
			$this->ExportDoc->Text .= "<tr><td align='center' rowspan='4'>NO</td><td align='center' rowspan='4'>KRITERIA PENILAIAN</td><td align='center' colspan='".$jmlkolfas."'>HASIL PENILAIAN</td><tr><td align='center' colspan='".$jmlkolfas."'>NAMA FASILITATOR DAN MATERI PELAJARAN</td></tr>";
			if ($qsql->RecordCount() > 0) {
				$qsql->MoveFirst();
				$x = 1;
				while ($qsql && !$qsql->EOF) {
					if($x==1){
						$this->ExportDoc->Text .= "<tr>";
					}
					$nama_fas = ExecuteScalar("SELECT nama FROM t_biointruktur WHERE bioid = ".$qsql->fields[1]." ORDER BY bioid ASC");
					$this->ExportDoc->Text .= "<td align='center' colspan='2'>".$nama_fas."</td>";
					if($x==$jml_fasilitator){
						$this->ExportDoc->Text .= "</tr>";
					}
					$x++;
					$qsql->MoveNext();
				}
				$qsql->Close();
			}
			for ($n=1;$n<=$jml_fasilitator;$n++){
				if($n==1){
					$this->ExportDoc->Text .= "<tr>";
				}
				$this->ExportDoc->Text .= "<td align='center'>Nilai</td><td align='center'>Saran kepada Panitia Pelatihan :</td>";
				if($n==$jml_fasilitator){
					$this->ExportDoc->Text .= "</tr>";
				}
			}

			//$this->ExportDoc->Text .= "</tr>";
			$kriteria_penilaian = array("","Materi yang diberikan mencapai sasaran","Sistematika Penyajian","Metode Penyajian","Gaya dan sikap Fasilitator","Kemampuan memotivasi peserta","Penggunaan bahasa","Manajemen Waktu");
			$no = 1;
			$this->ExportDoc->Text .= "<tr>";
			for ($r=1;$r<=7;$r++){
				$this->ExportDoc->Text .= "<td>".$no.".</td><td>".$kriteria_penilaian[$r]."</td>";
				$sqlku = Execute("SELECT nilai,saran,idpelat,bioid,kurikulumid,kriteria_nilai FROM (
SELECT idpelat,bioid,kurikulumid,1 kriteria_nilai, FORMAT((SUM(SUBSTRING(nilai_fas, 1, 1))/ COUNT(1)), 2) nilai,  GROUP_CONCAT(saran SEPARATOR '; ') saran FROM `t_evafas` GROUP BY idpelat, bioid 
UNION ALL
SELECT idpelat,bioid,kurikulumid,2 kriteria_nilai, FORMAT((SUM(SUBSTRING(nilai_fas, 3, 1))/ COUNT(1)), 2) nilai,  GROUP_CONCAT(saran SEPARATOR '; ') saran FROM `t_evafas` GROUP BY idpelat, bioid
UNION ALL
SELECT idpelat,bioid,kurikulumid,3 kriteria_nilai, FORMAT((SUM(SUBSTRING(nilai_fas, 5, 1))/ COUNT(1)), 2) nilai,  GROUP_CONCAT(saran SEPARATOR '; ') saran FROM `t_evafas` GROUP BY idpelat, bioid
UNION ALL
SELECT idpelat,bioid,kurikulumid,4 kriteria_nilai, FORMAT((SUM(SUBSTRING(nilai_fas, 7, 1))/ COUNT(1)), 2) nilai,  GROUP_CONCAT(saran SEPARATOR '; ') saran FROM `t_evafas` GROUP BY idpelat, bioid
UNION ALL
SELECT idpelat,bioid,kurikulumid,5 kriteria_nilai, FORMAT((SUM(SUBSTRING(nilai_fas, 9, 1))/ COUNT(1)), 2) nilai,  GROUP_CONCAT(saran SEPARATOR '; ') saran FROM `t_evafas` GROUP BY idpelat, bioid
UNION ALL
SELECT idpelat,bioid,kurikulumid,6 kriteria_nilai, FORMAT((SUM(SUBSTRING(nilai_fas, 11, 1))/ COUNT(1)), 2) nilai,  GROUP_CONCAT(saran SEPARATOR '; ') saran FROM `t_evafas` GROUP BY idpelat, bioid
UNION ALL
SELECT idpelat,bioid,kurikulumid,7 kriteria_nilai, FORMAT((SUM(SUBSTRING(nilai_fas, 13, 1))/ COUNT(1)), 2) nilai,  GROUP_CONCAT(saran SEPARATOR '; ') saran FROM `t_evafas` GROUP BY idpelat, bioid
 ) x WHERE  idpelat = ".$vpel." AND kriteria_nilai = ".$r." ORDER BY bioid ASC");
				if ($sqlku->RecordCount() > 0) {
				$sqlku->MoveFirst();
					$nomor = 1;
					$rata = "";
					while ($sqlku && !$sqlku->EOF) {
							$nilai = $sqlku->fields[0];
							$array = (strval($sqlku->fields[0]) <> "") ? explode(",", strval($sqlku->fields[0])) : array();
							$cnt = count($array);
							if($cnt < 1){ $cnt = 1;}
							$rata = array_sum($array) / $cnt;
							$nilai_rata = number_format((float)$rata, 2, ',', '');
							$d_saran = "";
							if($r == 1){
								$d_saran = "<td rowspan='7' valign='top'>".$sqlku->fields[1]."</td>";
							}
							$this->ExportDoc->Text .= "<td align='right' id='td".$r.$nomor."'>".$nilai_rata."</td>".$d_saran;
							$sqlku->MoveNext();

							/*$rata = $rata + $sqlku->fields[0];
							if($nomor == $sqlku->RecordCount()){
								$this->ExportDoc->Text .= "<tr><td colspan='2'>Jumlah rata-rata (diisi panitia)</td><td align='center'>".$rata."</td><td></td>";
							}*/
							$nomor++;
					}
				}
				$no++;
				$this->ExportDoc->Text .= "</tr>";
			}

			$this->ExportDoc->Text .= "<tr><td colspan='2'>Jumlah rata-rata (diisi panitia)</td>";
			$sql2 = Execute("SELECT nilai_fas, saran FROM `t_evafas` WHERE idpelat = ".$vpel." GROUP BY bioid ORDER BY bioid ASC");
			if ($sql2->RecordCount() > 0) {
			$ab = 0;
			$alphas = array_merge(range('A', 'Z'), range('a', 'z'));
			$sql2->MoveFirst();
				while ($sql2 && !$sql2->EOF) {
				$ab+=2;
				$this->ExportDoc->Text .= "<td align='center'>=AVERAGE(".$alphas[$ab]."11:".$alphas[$ab]."17)</td><td></td>";
						$sql2->MoveNext();

				}
			}
			$this->ExportDoc->Text .= "</tr></table>";		
		} // tutup evaluasi
		
		
		else if($_GET["pg"] == "evakhir"){
			
			
			$vpel = @$_GET["pelat"]; // di pelatihan
			$pelatihan = ExecuteRow("SELECT judul, tempat, tawal, takhir FROM vt_pelatihan WHERE idpelat=".$vpel);
			$nama_pelatihan = $pelatihan["judul"];
			$tt_pelatihan = "" . $pelatihan["tempat"] . ", " . date('d F Y', strtotime($pelatihan["tawal"])) . " - " . date('d F Y', strtotime($pelatihan["takhir"])) ."";
			
			$this->ExportDoc->Text = "<table><tr><td colspan='4' align='center'>REKAP EVALUASI PELATIHAN</td></tr>"; // Export header
			$this->ExportDoc->Text .= "<tr><td colspan='4' align='center'>".$nama_pelatihan."</td></tr>";
			$this->ExportDoc->Text .= "<tr><td colspan='4' align='center'>".$tt_pelatihan."</td></tr>";
			$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>";
			
			$kriteria_penilaian = array("0", "Pelatihan ini secara keseluruhan ?", "Kesesuaian materi yang disajikan dengan kebutuhan ?", "Porsi waktu tiap-tiap materi pelatihan secara umum ?","Cara penyampaian materi oleh para fasilitator ?","Lamanya Pelatihan ?","Menurut anda topik apa yang sebaiknya ditambah atau dikurangi ?","a. Kondisi ruang belajar (dari segi kenyamanan dan kebersihan)","b. Pengaturan Kursi","c. Kualitas penggandaan makalah","d. Perlengkapan Pelatihan","e. Konsumsi (Snack)","Pelayanan Panitia Penyelenggara","Dari mana Anda mendapatkan informasi mengenai pelatihan ini","Bagaimana pendapat Anda tentang pelayanan pada saat Anda mendaftar menjadi peserta ?","Bagaimana pendapat Anda mengenai tarif pelatihan ini ?","Pelatihan yang ingin diikuti","Komentar dan saran-saran");
			
			$qsql = Execute("SELECT idpelat, tanya, SUM(if(jawab=1, 1, 0)) a, SUM(if(jawab=2, 1, 0)) b, SUM(if(jawab=3, 1, 0)) c, SUM(if(jawab=4, 1, 0)) d, SUM(if(jawab=5, 1, 0)) e, (SUM(if(jawab=1, 1, 0)) + SUM(if(jawab=2, 1, 0)) + SUM(if(jawab=3, 1, 0)) + SUM(if(jawab=4, 1, 0)) + SUM(if(jawab=5, 1, 0))) tot, `tanya_materi`, `tanya_alasan`, `tanya_tambahi`, `tanya_kurangi`, `lain`, `saran` FROM `t_evakhir` WHERE idpelat  = 867 GROUP BY tanya ORDER BY tanya,jawab ASC");
			if ($qsql->RecordCount() > 0) {
				$qsql->MoveFirst();
				
				while ($qsql && !$qsql->EOF) {
				
					$tanya = $qsql->fields[1];
					$nilai = "";
					
					if($tanya == 1 || $tanya == 3 || $tanya == 4 || $tanya == 7 || $tanya == 8 || $tanya == 9  || $tanya == 10 || $tanya == 11 || $tanya == 12 || $tanya == 14){ $ket_a = "sangat baik"; $ket_b = "baik"; $ket_c = "cukup"; $ket_d = "kurang"; $ket_e = "sangat kurang"; }
					else if($tanya == 2){ $ket_a = "sangat sesuai"; $ket_b = "sesuai"; $ket_c = "cukup sesuai"; $ket_d = "kurang sesuai"; $ket_e = "tidak sesuai";}
					else if($tanya == 5){ $ket_a = "lama"; $ket_b = "cukup"; $ket_c = "singkat"; $ket_d = ""; $ket_e = ""; }
					else if($tanya == 15){ $ket_a = "sangat mahal"; $ket_b = "mahal"; $ket_c = "cukup sesuai"; $ket_d = "murah"; $ket_e = "sangat murah"; }
					else { $ket_a = ""; $ket_b = ""; $ket_c = ""; $ket_d = ""; $ket_e = "";}
					
		
					$pernyataan_a = "orang peserta menyatakan ".$ket_a."";
					$pernyataan_b = "orang peserta menyatakan ".$ket_b."";
					$pernyataan_c = "orang peserta menyatakan ".$ket_c."";
					$pernyataan_d = "orang peserta menyatakan ".$ket_d."";
					$pernyataan_e = "orang peserta menyatakan ".$ket_e."";
					
					if($tanya == 13){
						$pernyataan_a = "orang peserta mendapatkan informasi dari surat penawaran/leaflet PPEI";
						$pernyataan_b = "orang peserta mendapatkan informasi dari media cetak";
						$pernyataan_c = "orang peserta mendapatkan informasi dari lain-lain";
					}			
					
					$no_tanya = $qsql->fields[1];
					
					if($no_tanya >= 7 && $no_tanya <= 11){ $no_tanya = "";
					} if($no_tanya == 12) { $no_tanya = 8; 
					} else if($no_tanya == 13) { $no_tanya = 9;
					} else if($no_tanya == 14) { $no_tanya = 10;
					} else if($no_tanya == 15) { $no_tanya = 11;
					} else if($no_tanya == 16) { $no_tanya = 12;
					} else if($no_tanya == 17) { $no_tanya = 13;
					}
					
					if($tanya == 7) 
					$this->ExportDoc->Text .= "<tr><td nowrap>7. </td><td colspan='2'>Sarana Pendukung : </td><td nowrap></td></tr>";
							
					$this->ExportDoc->Text .= "<tr><td>".$no_tanya."</td><td colspan='3'>".$kriteria_penilaian[$qsql->fields[1]]."</td></tr>";
					
					if($tanya >= 1 && $tanya <= 15 && $tanya <> 6){
					
					$tot = $qsql->fields[7];
					
					$vper_a = round(($qsql->fields[2] / $tot) * 100);
					$vper_b = round(($qsql->fields[3] / $tot) * 100);
					$vper_c = round(($qsql->fields[4] / $tot) * 100);
					$vper_d = round(($qsql->fields[5] / $tot) * 100);
					$vper_e = round(($qsql->fields[6] / $tot) * 100);	
					
					$this->ExportDoc->Text .= "<tr><td nowrap></td><td align='right'>".$qsql->fields[2]."<td nowrap>".$pernyataan_a."</td><td align='right' nowrap>".$vper_a."%</td></tr>";
					$this->ExportDoc->Text .= "<tr><td nowrap></td><td align='right'>".$qsql->fields[3]."<td nowrap>".$pernyataan_b."</td><td align='right' nowrap>".$vper_b."%</td></tr>";
					$this->ExportDoc->Text .= "<tr><td nowrap></td><td align='right'>".$qsql->fields[4]."<td nowrap>".$pernyataan_c."</td><td align='right' nowrap>".$vper_c."%</td></tr>";
					if($tanya <> 5 && $tanya <> 13){
					$this->ExportDoc->Text .= "<tr><td nowrap></td><td align='right'>".$qsql->fields[5]."<td nowrap>".$pernyataan_d."</td><td align='right' nowrap>".$vper_d."%</td></tr>";
					$this->ExportDoc->Text .= "<tr><td nowrap></td><td align='right'>".$qsql->fields[6]."<td nowrap>".$pernyataan_e."</td><td align='right' nowrap>".$vper_e."%</td></tr>";
					}
					
						if($tanya >= 2 && $tanya <= 4){
							$tidaksesuai = "Sebutkan materinya, bila menurut Anda kurang / tidak sesuai";
							$this->ExportDoc->Text .= "<tr><td nowrap></td><td colspan='2'>".$tidaksesuai."</td><td nowrap></td></tr>";
							
							if($qsql->fields[8] == "-"){ // cek data tanya materi
								$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap>Materi : <td nowrap>1. </td><td nowrap></td></tr>";
							} else {

								$tanya_materi = (strval($qsql->fields[8]) <> "") ? explode("; ", strval($qsql->fields[8])) : array();
								//sort($tanya_materi); // sort array tanya_materi
								$cnt_tanya_materi = count($tanya_materi);
								//$this->ExportDoc->Text .= $cnt_tanya_materi;
								for($x=1;$x<=$cnt_tanya_materi;$x++){
									$cap = "Materi : ";
									$n = $x - 1;
									if($x>1){ $cap = ""; }
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap>".$cap."<td nowrap>".$x.". ".$tanya_materi[$n]."</td><td nowrap></td></tr>";
								}
							}
							
							if($qsql->fields[9] == "-"){ // cek data tanya alasan
								$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap>Alasan : <td nowrap>1. </td><td nowrap></td></tr>";
							} else {
							
								$tanya_alasan = (strval($this->tanya_alasan->CurrentValue) <> "") ? explode("; ", strval($qsql->fields[9])) : array();
								//sort($tanya_alasan); // sort array tanya_alasan
								$cnt_tanya_alasan = count($tanya_alasan);
								
								for($x=1;$x<=$cnt_tanya_alasan;$x++){
									$cap = "Alasan : ";
									$n = $x - 1;
									if($x>1){ $cap = ""; }
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap>".$cap."<td nowrap>".$x.". ".$tanya_alasan[$n]."</td><td nowrap></td></tr>";
								}
							}
							
						} // >=2 dan <=4
					}
								
						if($tanya == 6){
							$this->ExportDoc->Text .= "<tr><td nowrap></td><td colspan='2'>a. Yang perlu di tambah ?</td><td nowrap></td></tr>";
							if($qsql->fields[10] == "-"){
								for($x=1;$x<=1;$x++){
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap></td><td nowrap>".$x.". </td><td nowrap></td></tr>";
								}
							} else {
								$tanya_tambahi = (strval($qsql->fields[10]) <> "") ? explode("; ", strval($qsql->fields[10])) : array();
								//sort($tanya_tambahi); // sort array tanya_tambahi
								$cnt_tanya_tambahi = count($tanya_tambahi);
								//$this->ExportDoc->Text .= $cnt_tanya_tambahi ;
								for($x=1;$x<=$cnt_tanya_tambahi;$x++){
									$n = $x - 1;
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap></td><td nowrap>".$x.". ".$tanya_tambahi[$n]."</td><td nowrap></td></tr>";
								}
							}
							$this->ExportDoc->Text .= "<tr><td nowrap></td><td colspan='2'>b. Yang perlu dikurangi atau dihilangkan ?</td><td nowrap></td></tr>";
							if($qsql->fields[11] == "-"){
								for($x=1;$x<=1;$x++){
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap></td><td nowrap>".$x.". </td><td nowrap></td></tr>";
								}
							} else {
								$tanya_kurangi = (strval($qsql->fields[11]) <> "") ? explode(";;", strval($qsql->fields[11])) : array();
								//sort($tanya_kurangi); // sort array tanya_kurangi
								$cnt_tanya_kurangi = count($tanya_kurangi);
								//$this->ExportDoc->Text .= $cnt_tanya_kurangi ;
								for($x=1;$x<=$cnt_tanya_kurangi;$x++){
									$n = $x - 1;
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap></td><td nowrap>".$x.". ".$tanya_kurangi[$n]."</td><td nowrap></td></tr>";
								}
							}
							
						} // 6
						if($tanya == 13 || $tanya == 14 || $tanya == 16){
							if($tanya == 14)
								$this->ExportDoc->Text .= "<tr><td nowrap></td><td colspan='2'>Bila menurut Anda kurang atau sangat kurang, mohon disebutkan dalam hal apa : </td><td nowrap></td></tr>";
							if($tanya == 16)
								$this->ExportDoc->Text .= "<tr><td nowrap></td><td colspan='2'>Pelatihan lainnya : </td><td nowrap></td></tr>";
							if($qsql->fields[12] == "-"){
								for($x=1;$x<=1;$x++){
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap></td><td nowrap>".$x.". </td><td nowrap></td></tr>";
								}
							} else {
								$lain = (strval($qsql->fields[12]) <> "") ? explode(";;", strval($qsql->fields[12])) : array();
								//sort($lain); // sort array lain
								$cnt_lain = count($lain);
								//$this->ExportDoc->Text .= $cnt_lain ;
								for($x=1;$x<=$cnt_lain;$x++){
									$n = $x - 1;
									$cap = "Lain-lain";
									if($x>1 || $tanya == 14 || $tanya == 16){ $cap = ""; }
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap>".$cap."</td><td nowrap>".$x.". ".$lain[$n]."</td><td nowrap></td></tr>";
								}
							}
						} // 13,14,16

						if($tanya == 17){
							$ar = array("","a","b","c","d","e");
							if($qsql->fields[13] == "-"){
								for($x=1;$x<=1;$x++){
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap></td><td nowrap>".$x.". </td><td nowrap></td></tr>";
								}
							} else {
								$saran = (strval($qsql->fields[13]) <> "") ? explode(";;", strval($qsql->fields[13])) : array();
								//sort($saran); // sort array saran
								$cnt_saran = count($saran);
								//$this->ExportDoc->Text .= $cnt_saran ;
								for($x=1;$x<=$cnt_saran;$x++){
									$n = $x - 1;
									$this->ExportDoc->Text .= "<tr><td nowrap></td><td nowrap></td><td nowrap>".$x.". ".$saran[$n]."</td><td nowrap></td></tr>";
								}
							}
						}	// 17				
	
					$qsql->MoveNext();
				}
				$qsql->Close();
			}
			
			$this->ExportDoc->Text .= "</table>";
			
		}
		
		
		} // tutup excel
		return FALSE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
		$thn = $_GET["tahun"]; 
		if($_GET["pg"] == "a4") { //Realisasi Jumlah Angkatan dan Peserta Pelatihan Ekspor 
			$sqlr = "";

			function denol($v){
				if($v > 0){
					return $v;
				} else {
					return "";
				}
			}
			$t = $thn - 4;

			function dbx($t,$j){
				if($j==1) return $target_angkatan = ExecuteScalar("select sum(c) from (select sum(angkatan) as c from t_rpdiklat WHERE tahun_rencana = ".$t." UNION ALL select sum(angkatan) as c from t_rpkerjasama WHERE tahun_rencana = ".$t.") tb");
				if($j==2) return $target_peserta = ExecuteScalar("select sum(c) from (select sum(targetpes) as c from t_rpdiklat WHERE tahun_rencana = ".$t." UNION ALL select sum(targetpes) as c from t_rpkerjasama WHERE tahun_rencana = ".$t.") tb");;
				if($j==3) return $real_angkatan = ExecuteScalar("SELECT COUNT(1) FROM t_pelatihan WHERE YEAR(tawal) = ".$t);
				if($j==4) return $real_peserta = ExecuteScalar("SELECT COUNT(1) FROM t_pp a INNER JOIN t_pelatihan b ON a.kdpelat = b.kdpelat WHERE a.tahun = ".$t);
			}
			$sumra = 0;
			$sumrp = 0;
			for($x=1;$x<=5;$x++){
				$ta = (dbx($t,1)>0)?dbx($t,1):0;
				$tp = (dbx($t,2)>0)?dbx($t,2):0;
				$this->ExportDoc->Text .= "<tr>
					<td>".$x."</td>
					<td>".$t."</td>
					<td>".$ta."</td>
					<td>".$tp."</td>
					<td>".dbx($t,3)."</td>
					<td>".dbx($t,4)."</td></tr>";
					$sumra += dbx($t,3);
					$sumrp += dbx($t,4);
					$t++;
			}
			$this->ExportDoc->Text .= "<tr>
					<td></td>
					<td><b>Total</b></td>
					<td></td>
					<td></td>
					<td><b>".$sumra."</b></td>
					<td><b>".$sumrp."</b></td></tr>";
		} // tutup pg=a4
		if($_GET["pg"] == "a2") { //Mitra Kerjasama
		$_SESSION["tpes"] = 0;
		$_SESSION["prs"] = "none";
		$this->ExportDoc->Text .= "<table>
		<tr>
			<th id='tdq'>No</th>
			<th id='tdq'>Mitra Kerja Sama</th>
			<th id='tdq' colspan='2'>Judul Pelatihan</th>
			<th id='tdq'>Lokasi</th>
			<th id='tdq'>Tanggal</th>
			<th id='tdq'>Skema Pembiayaan</th>
			<th id='tdq'>Jumlah Peserta</th>
			<th id='tdq'>Total Peserta</th>
			<th id='tdq'>Total Angkatan</th>
		</tr>";
		$rs = Execute("SELECT a.kdpelat,c.namap, j.judul, REPLACE(b.kota,'Kota ','') kota, DATE_FORMAT(a.tawal,'%Y-%m-%d') tawal, DATE_FORMAT(a.takhir,'%Y-%m-%d') takhir, a.jenispel, c.idp FROM `t_pelatihan` a INNER JOIN `t_kota` b ON a.kdkota = b.kdkota INNER JOIN t_perusahaan c ON c.idp = a.kerjasama INNER JOIN t_judul j ON j.kdjudul = a.kdjudul WHERE YEAR(a.tawal) = ".$thn." AND a.kerjasama > 0 ORDER BY c.namap"); // baca data dari tabel
		if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
			$rs->MoveFirst(); // mulai dari record pertama
			$no = 1;
			$nos = 1;
			while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset

				//echo $rs->fields("Theme_ID")." - " .$rs->fields("Theme_Name"). "<br>";  // tampilkan hasilnya
				$jp = array(1=>"Subsidi Pusat",2=>"Kerjasama Subsidi Daerah Dana Dekon",3=>"Kerjasama Subsidi Daerah",4=>"Kerjasama Kontraktual Pusat Dana Dekon",5=>"Kerjasama Kontraktual Pusat",6=>"Kerjasama Kontraktual Daerah - Dana Dekon",7=>"Kerjasama Kontraktual Daerah",8=>"Free Daerah Kerjasama",9=>"Free Daerah",10=>"Free Pusat Kerjasama",11=>"Free Pusat");
				$jpeserta = ExecuteScalar("SELECT COUNT(1) FROM t_pp WHERE kdpelat LIKE '".$rs->fields("kdpelat")."'");
				$cpel = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` a INNER JOIN `t_kota` b ON a.kdkota = b.kdkota INNER JOIN t_perusahaan c ON c.idp = a.kerjasama INNER JOIN t_judul j ON j.kdjudul = a.kdjudul WHERE YEAR(a.tawal) = ".$thn." AND a.kerjasama > 0 AND c.idp = '".$rs->fields("idp")."'");
				$_SESSION["tpes"] += $jpeserta;
				$tot_peserta = $_SESSION["tpes"];
				$nom = $no;
				$namaperusahaan = $rs->fields("namap");
				if($rs->fields("namap") == @$_SESSION["prs"]){
					$namaperusahaan = "";
					if($_SESSION["prs"] <> "none")
					$nom = "";
				} else {
					$no++;
					$nos =1;
				}
				$judul = $rs->fields("judul");
				if($rs->fields("judul") == @$_SESSION["jdl"]){
					$judul = "";
				} 
				if($rs->fields("tawal") == $rs->fields("takhir")){
					$tgl = $rs->fields("tawal");
				} else if(date("m", strtotime($rs->fields("tawal"))) == date("m", strtotime($rs->fields("takhir")))) {
					$tgl = date("d", strtotime($rs->fields("tawal")))." s.d.".CSFormatTanggal(date("d-m-Y", strtotime($rs->fields("takhir"))), false, false, true);
				} else {
					$tgl = CSFormatTanggal(date("d-m-Y", strtotime($rs->fields("tawal"))), false, false, true, true)." s.d.".CSFormatTanggal(date("d-m-Y", strtotime($rs->fields("takhir"))), false, false, true);
				}
				$this->ExportDoc->Text .= "
					<tr style='height:30px'>
						<td>".$nom.".</td>
						<td nowrap>".$namaperusahaan."</td>
						<td>".$nos.".</td>
						<td nowrap>".$rs->fields("judul")."</td>
						<td>".$rs->fields("kota")."</td>
						<td>".$tgl."</td>
						<td>".str_replace('Kerjasama ','',$jp[$rs->fields("jenispel")])."</td>
						<td>".$jpeserta."</td>
						<td></td>
						<td></td>
					</tr>";
				if($nos == $cpel){
					$this->ExportDoc->Text .= "<tr bgcolor='#c0d2e6'><td colspan='7'></td><td></td><td>".$tot_peserta."</td><td>".$cpel."</td></tr>";
					$_SESSION["tpes"] = 0;
				}
				$nos++;
				$_SESSION["prs"] = $rs->fields("namap");
				$_SESSION["jdl"] = $rs->fields("judul");
				$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
			} // akhir loop
			unset($_SESSION["prs"]);
			unset($_SESSION["jdl"]);
			unset($_SESSION["tpes"]);
			$rs->Close(); // tutup recordset jika sudah selesai
		} else { // jika jumlah record tidak lebih besar dari nol
			echo "Tidak ada data ditemukan."; // tampilkan pesan tidak ada record
		} // akhir pemeriksaan record
		} // tutup pg=a4
		else if ($_GET["pg"] == "a5"){ // Kabupaten dan Kota
		$this->ExportDoc->Text .= "<table>
			<tr>
				<th id='tdq'>No</th>
				<th id='tdq'>Kota/Kabupaten</th>
			</tr>";
		$rs = Execute("SELECT REPLACE(b.kota,'Kota ','') kota, COUNT(a.idpelat) c FROM `t_pelatihan` a INNER JOIN `t_kota` b ON a.kdkota = b.kdkota WHERE YEAR(a.tawal) = ".$thn." GROUP BY a.kdkota ORDER BY REPLACE(b.kota,'Kota ','')"); // baca data dari tabel
		if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
			$rs->MoveFirst(); // mulai dari record pertama
			$no = 1;
			while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset

				//echo $rs->fields("Theme_ID")." - " .$rs->fields("Theme_Name"). "<br>";  // tampilkan hasilnya
				$this->ExportDoc->Text .= "
					<tr>
						<th id='tdq'>".$no."</th>
						<td>".$rs->fields("kota")."</td>
					</tr>";
				$no++;
				$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
			} // akhir loop
			$rs->Close(); // tutup recordset jika sudah selesai
		} else { // jika jumlah record tidak lebih besar dari nol
			echo "Tidak ada data ditemukan."; // tampilkan pesan tidak ada record
		} // akhir pemeriksaan record
		} // tutup pg=a5
		else if ($_GET["pg"] == "a51"){ // Provinsi
		$this->ExportDoc->Text .= "<table>
			<tr>
				<th id='tdq'>No</th>
				<th id='tdq'>Propinsi</th>
			</tr>";
		$rs = Execute("SELECT b.prop, COUNT(a.idpelat) c FROM `t_pelatihan` a INNER JOIN `t_prop` b ON a.kdprop = b.kdprop WHERE YEAR(a.tawal) = ".$thn." GROUP BY a.kdprop ORDER BY b.prop"); // baca data dari tabel
		if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
			$rs->MoveFirst(); // mulai dari record pertama
			$no = 1;
			while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset

				//echo $rs->fields("Theme_ID")." - " .$rs->fields("Theme_Name"). "<br>";  // tampilkan hasilnya
				$this->ExportDoc->Text .= "
					<tr>
						<th id='tdq'>".$no."</th>
						<td>".$rs->fields("prop")."</td>
					</tr>";
				$no++;
				$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
			} // akhir loop
			$rs->Close(); // tutup recordset jika sudah selesai
		} else { // jika jumlah record tidak lebih besar dari nol
			echo "Tidak ada data ditemukan."; // tampilkan pesan tidak ada record
		} // akhir pemeriksaan record
		} // tutup pg = a51
		else if ($_GET["pg"] == "a6"){ // Mitra Kerjasama
		$this->ExportDoc->Text .= "<table>
			<tr>
				<th id='tdq'>No</th>
				<th id='tdq'>Mitra Kerja Sama</th>
			</tr>";
		$rs = Execute("SELECT b.namap FROM `t_pelatihan` a INNER JOIN `t_perusahaan` b ON a.kerjasama = b.idp WHERE YEAR(a.tawal) = ".$thn." AND a.kerjasama > 0 GROUP BY a.kerjasama ORDER BY b.namap"); // baca data dari tabel
		if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
			$rs->MoveFirst(); // mulai dari record pertama
			$no = 1;
			while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset

				//echo $rs->fields("Theme_ID")." - " .$rs->fields("Theme_Name"). "<br>";  // tampilkan hasilnya
				$this->ExportDoc->Text .= "
					<tr>
						<th id='tdq'>".$no."</th>
						<td nowrap>".$rs->fields("namap")."</td>
					</tr>";
				$no++;
				$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
			} // akhir loop
			$rs->Close(); // tutup recordset jika sudah selesai
		} else { // jika jumlah record tidak lebih besar dari nol
			echo "Tidak ada data ditemukan."; // tampilkan pesan tidak ada record
		} // akhir pemeriksaan record
		} // tutup pg=a6
		else if ($_GET["pg"] == "a8"){ // Kabupaten dan Kota
		$this->ExportDoc->Text .= "<table>
			<tr>
				<th id='tdq'>No</th>
				<th id='tdq'>Kota/Kabupaten</th>
				<th id='tdq'>Jumlah Batches</th>
				<th id='tdq'>Tahun Pelaksanaan</th>
			</tr>";
		$rs = Execute("SELECT REPLACE(b.kota,'Kota ','') kota, a.kdkota, COUNT(a.idpelat) c FROM `t_pelatihan` a INNER JOIN `t_kota` b ON a.kdkota = b.kdkota WHERE a.coachingprogr = 1 GROUP BY a.kdkota ORDER BY REPLACE(b.kota,'Kota ','')"); // baca data dari tabel
		if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
			$rs->MoveFirst(); // mulai dari record pertama
			$no = 1;
			while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset

				//echo $rs->fields("Theme_ID")." - " .$rs->fields("Theme_Name"). "<br>";  // tampilkan hasilnya
				$this->ExportDoc->Text .= "
					<tr>
						<th id='tdq'>".$no."</th>
						<td>".$rs->fields("kota")."</td>
						<td>".$rs->fields("c")."</td>
						<td>";
					$rsa = mysql_query("SELECT YEAR(x.tawal) AS th FROM `t_pelatihan` x WHERE x.coachingprogr = 1 AND x.kdkota = ".$rs->fields("kdkota")." GROUP BY YEAR(x.tawal) ORDER BY YEAR(x.tawal) ASC");
					while($rd = mysql_fetch_array($rsa)){
						$this->ExportDoc->Text .= $rd["th"]."; ";
					}
				$this->ExportDoc->Text .= "</td>
					</tr>";
				$no++;
				$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
			} // akhir loop
			$rs->Close(); // tutup recordset jika sudah selesai
		} else { // jika jumlah record tidak lebih besar dari nol
			echo "Tidak ada data ditemukan."; // tampilkan pesan tidak ada record
		} // akhir pemeriksaan record
		} // tutup pg=a8 
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {
		if($this->Export == "excel")
		$this->ExportDoc->Text .= "</table><br><br>Data per ".CurrentDateTime();
		if(isset($_GET["db"])){ echo $this->ExportDoc->Text; exit(); }
		
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