<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_repeserta_list extends t_repeserta
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_repeserta';

	// Page object name
	public $PageObjName = "t_repeserta_list";

	// Grid form hidden field names
	public $FormName = "ft_repesertalist";
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

		// Table object (t_repeserta)
		if (!isset($GLOBALS["t_repeserta"]) || get_class($GLOBALS["t_repeserta"]) == PROJECT_NAMESPACE . "t_repeserta") {
			$GLOBALS["t_repeserta"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_repeserta"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "t_repesertaadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "t_repesertadelete.php";
		$this->MultiUpdateUrl = "t_repesertaupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (cv_pelrepes)
		if (!isset($GLOBALS['cv_pelrepes']))
			$GLOBALS['cv_pelrepes'] = new cv_pelrepes();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_repeserta');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ft_repesertalistsrch";

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
		global $t_repeserta;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_repeserta);
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
		if ($this->isAddOrEdit())
			$this->updated_at->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->created_at->Visible = FALSE;
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
		$this->id->Visible = FALSE;
		$this->idpelat->Visible = FALSE;
		$this->kdjudul->Visible = FALSE;
		$this->tgl_pel->Visible = FALSE;
		$this->nama->setVisibility();
		$this->perusahaan->setVisibility();
		$this->jabatan->setVisibility();
		$this->tgl_daftar->setVisibility();
		$this->telp->setVisibility();
		$this->fax->setVisibility();
		$this->hp->setVisibility();
		$this->produk->setVisibility();
		$this->cara_bayar->setVisibility();
		$this->ket_bayar->setVisibility();
		$this->tgl_bayar->setVisibility();
		$this->kdinformasi->setVisibility();
		$this->konfirmasi->setVisibility();
		$this->ket->setVisibility();
		$this->updated_at->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->ket_lainnya->setVisibility();
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

		// Set up master detail parameters
		$this->setupMasterParms();

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
		$this->setupLookupOptions($this->id);
		$this->setupLookupOptions($this->idpelat);
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->jabatan);
		$this->setupLookupOptions($this->kdinformasi);

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

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "cv_pelrepes") {
			global $cv_pelrepes;
			$rsmaster = $cv_pelrepes->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("cv_pelrepeslist.php"); // Return to master page
			} else {
				$cv_pelrepes->loadListRowValues($rsmaster);
				$cv_pelrepes->RowType = ROWTYPE_MASTER; // Master row
				$cv_pelrepes->renderListRow();
				$rsmaster->close();
			}
		}

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
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
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
		$filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
		$filterList = Concat($filterList, $this->nama->AdvancedSearch->toJson(), ","); // Field nama
		$filterList = Concat($filterList, $this->perusahaan->AdvancedSearch->toJson(), ","); // Field perusahaan
		$filterList = Concat($filterList, $this->jabatan->AdvancedSearch->toJson(), ","); // Field jabatan
		$filterList = Concat($filterList, $this->tgl_daftar->AdvancedSearch->toJson(), ","); // Field tgl_daftar
		$filterList = Concat($filterList, $this->telp->AdvancedSearch->toJson(), ","); // Field telp
		$filterList = Concat($filterList, $this->fax->AdvancedSearch->toJson(), ","); // Field fax
		$filterList = Concat($filterList, $this->hp->AdvancedSearch->toJson(), ","); // Field hp
		$filterList = Concat($filterList, $this->produk->AdvancedSearch->toJson(), ","); // Field produk
		$filterList = Concat($filterList, $this->cara_bayar->AdvancedSearch->toJson(), ","); // Field cara_bayar
		$filterList = Concat($filterList, $this->ket_bayar->AdvancedSearch->toJson(), ","); // Field ket_bayar
		$filterList = Concat($filterList, $this->tgl_bayar->AdvancedSearch->toJson(), ","); // Field tgl_bayar
		$filterList = Concat($filterList, $this->kdinformasi->AdvancedSearch->toJson(), ","); // Field kdinformasi
		$filterList = Concat($filterList, $this->konfirmasi->AdvancedSearch->toJson(), ","); // Field konfirmasi
		$filterList = Concat($filterList, $this->ket->AdvancedSearch->toJson(), ","); // Field ket
		$filterList = Concat($filterList, $this->ket_lainnya->AdvancedSearch->toJson(), ","); // Field ket_lainnya

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
			$UserProfile->setSearchFilters(CurrentUserName(), "ft_repesertalistsrch", $filters);
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

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->save();

		// Field nama
		$this->nama->AdvancedSearch->SearchValue = @$filter["x_nama"];
		$this->nama->AdvancedSearch->SearchOperator = @$filter["z_nama"];
		$this->nama->AdvancedSearch->SearchCondition = @$filter["v_nama"];
		$this->nama->AdvancedSearch->SearchValue2 = @$filter["y_nama"];
		$this->nama->AdvancedSearch->SearchOperator2 = @$filter["w_nama"];
		$this->nama->AdvancedSearch->save();

		// Field perusahaan
		$this->perusahaan->AdvancedSearch->SearchValue = @$filter["x_perusahaan"];
		$this->perusahaan->AdvancedSearch->SearchOperator = @$filter["z_perusahaan"];
		$this->perusahaan->AdvancedSearch->SearchCondition = @$filter["v_perusahaan"];
		$this->perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_perusahaan"];
		$this->perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_perusahaan"];
		$this->perusahaan->AdvancedSearch->save();

		// Field jabatan
		$this->jabatan->AdvancedSearch->SearchValue = @$filter["x_jabatan"];
		$this->jabatan->AdvancedSearch->SearchOperator = @$filter["z_jabatan"];
		$this->jabatan->AdvancedSearch->SearchCondition = @$filter["v_jabatan"];
		$this->jabatan->AdvancedSearch->SearchValue2 = @$filter["y_jabatan"];
		$this->jabatan->AdvancedSearch->SearchOperator2 = @$filter["w_jabatan"];
		$this->jabatan->AdvancedSearch->save();

		// Field tgl_daftar
		$this->tgl_daftar->AdvancedSearch->SearchValue = @$filter["x_tgl_daftar"];
		$this->tgl_daftar->AdvancedSearch->SearchOperator = @$filter["z_tgl_daftar"];
		$this->tgl_daftar->AdvancedSearch->SearchCondition = @$filter["v_tgl_daftar"];
		$this->tgl_daftar->AdvancedSearch->SearchValue2 = @$filter["y_tgl_daftar"];
		$this->tgl_daftar->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_daftar"];
		$this->tgl_daftar->AdvancedSearch->save();

		// Field telp
		$this->telp->AdvancedSearch->SearchValue = @$filter["x_telp"];
		$this->telp->AdvancedSearch->SearchOperator = @$filter["z_telp"];
		$this->telp->AdvancedSearch->SearchCondition = @$filter["v_telp"];
		$this->telp->AdvancedSearch->SearchValue2 = @$filter["y_telp"];
		$this->telp->AdvancedSearch->SearchOperator2 = @$filter["w_telp"];
		$this->telp->AdvancedSearch->save();

		// Field fax
		$this->fax->AdvancedSearch->SearchValue = @$filter["x_fax"];
		$this->fax->AdvancedSearch->SearchOperator = @$filter["z_fax"];
		$this->fax->AdvancedSearch->SearchCondition = @$filter["v_fax"];
		$this->fax->AdvancedSearch->SearchValue2 = @$filter["y_fax"];
		$this->fax->AdvancedSearch->SearchOperator2 = @$filter["w_fax"];
		$this->fax->AdvancedSearch->save();

		// Field hp
		$this->hp->AdvancedSearch->SearchValue = @$filter["x_hp"];
		$this->hp->AdvancedSearch->SearchOperator = @$filter["z_hp"];
		$this->hp->AdvancedSearch->SearchCondition = @$filter["v_hp"];
		$this->hp->AdvancedSearch->SearchValue2 = @$filter["y_hp"];
		$this->hp->AdvancedSearch->SearchOperator2 = @$filter["w_hp"];
		$this->hp->AdvancedSearch->save();

		// Field produk
		$this->produk->AdvancedSearch->SearchValue = @$filter["x_produk"];
		$this->produk->AdvancedSearch->SearchOperator = @$filter["z_produk"];
		$this->produk->AdvancedSearch->SearchCondition = @$filter["v_produk"];
		$this->produk->AdvancedSearch->SearchValue2 = @$filter["y_produk"];
		$this->produk->AdvancedSearch->SearchOperator2 = @$filter["w_produk"];
		$this->produk->AdvancedSearch->save();

		// Field cara_bayar
		$this->cara_bayar->AdvancedSearch->SearchValue = @$filter["x_cara_bayar"];
		$this->cara_bayar->AdvancedSearch->SearchOperator = @$filter["z_cara_bayar"];
		$this->cara_bayar->AdvancedSearch->SearchCondition = @$filter["v_cara_bayar"];
		$this->cara_bayar->AdvancedSearch->SearchValue2 = @$filter["y_cara_bayar"];
		$this->cara_bayar->AdvancedSearch->SearchOperator2 = @$filter["w_cara_bayar"];
		$this->cara_bayar->AdvancedSearch->save();

		// Field ket_bayar
		$this->ket_bayar->AdvancedSearch->SearchValue = @$filter["x_ket_bayar"];
		$this->ket_bayar->AdvancedSearch->SearchOperator = @$filter["z_ket_bayar"];
		$this->ket_bayar->AdvancedSearch->SearchCondition = @$filter["v_ket_bayar"];
		$this->ket_bayar->AdvancedSearch->SearchValue2 = @$filter["y_ket_bayar"];
		$this->ket_bayar->AdvancedSearch->SearchOperator2 = @$filter["w_ket_bayar"];
		$this->ket_bayar->AdvancedSearch->save();

		// Field tgl_bayar
		$this->tgl_bayar->AdvancedSearch->SearchValue = @$filter["x_tgl_bayar"];
		$this->tgl_bayar->AdvancedSearch->SearchOperator = @$filter["z_tgl_bayar"];
		$this->tgl_bayar->AdvancedSearch->SearchCondition = @$filter["v_tgl_bayar"];
		$this->tgl_bayar->AdvancedSearch->SearchValue2 = @$filter["y_tgl_bayar"];
		$this->tgl_bayar->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_bayar"];
		$this->tgl_bayar->AdvancedSearch->save();

		// Field kdinformasi
		$this->kdinformasi->AdvancedSearch->SearchValue = @$filter["x_kdinformasi"];
		$this->kdinformasi->AdvancedSearch->SearchOperator = @$filter["z_kdinformasi"];
		$this->kdinformasi->AdvancedSearch->SearchCondition = @$filter["v_kdinformasi"];
		$this->kdinformasi->AdvancedSearch->SearchValue2 = @$filter["y_kdinformasi"];
		$this->kdinformasi->AdvancedSearch->SearchOperator2 = @$filter["w_kdinformasi"];
		$this->kdinformasi->AdvancedSearch->save();

		// Field konfirmasi
		$this->konfirmasi->AdvancedSearch->SearchValue = @$filter["x_konfirmasi"];
		$this->konfirmasi->AdvancedSearch->SearchOperator = @$filter["z_konfirmasi"];
		$this->konfirmasi->AdvancedSearch->SearchCondition = @$filter["v_konfirmasi"];
		$this->konfirmasi->AdvancedSearch->SearchValue2 = @$filter["y_konfirmasi"];
		$this->konfirmasi->AdvancedSearch->SearchOperator2 = @$filter["w_konfirmasi"];
		$this->konfirmasi->AdvancedSearch->save();

		// Field ket
		$this->ket->AdvancedSearch->SearchValue = @$filter["x_ket"];
		$this->ket->AdvancedSearch->SearchOperator = @$filter["z_ket"];
		$this->ket->AdvancedSearch->SearchCondition = @$filter["v_ket"];
		$this->ket->AdvancedSearch->SearchValue2 = @$filter["y_ket"];
		$this->ket->AdvancedSearch->SearchOperator2 = @$filter["w_ket"];
		$this->ket->AdvancedSearch->save();

		// Field ket_lainnya
		$this->ket_lainnya->AdvancedSearch->SearchValue = @$filter["x_ket_lainnya"];
		$this->ket_lainnya->AdvancedSearch->SearchOperator = @$filter["z_ket_lainnya"];
		$this->ket_lainnya->AdvancedSearch->SearchCondition = @$filter["v_ket_lainnya"];
		$this->ket_lainnya->AdvancedSearch->SearchValue2 = @$filter["y_ket_lainnya"];
		$this->ket_lainnya->AdvancedSearch->SearchOperator2 = @$filter["w_ket_lainnya"];
		$this->ket_lainnya->AdvancedSearch->save();
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->id, $default, FALSE); // id
		$this->buildSearchSql($where, $this->nama, $default, FALSE); // nama
		$this->buildSearchSql($where, $this->perusahaan, $default, FALSE); // perusahaan
		$this->buildSearchSql($where, $this->jabatan, $default, FALSE); // jabatan
		$this->buildSearchSql($where, $this->tgl_daftar, $default, FALSE); // tgl_daftar
		$this->buildSearchSql($where, $this->telp, $default, FALSE); // telp
		$this->buildSearchSql($where, $this->fax, $default, FALSE); // fax
		$this->buildSearchSql($where, $this->hp, $default, FALSE); // hp
		$this->buildSearchSql($where, $this->produk, $default, FALSE); // produk
		$this->buildSearchSql($where, $this->cara_bayar, $default, FALSE); // cara_bayar
		$this->buildSearchSql($where, $this->ket_bayar, $default, FALSE); // ket_bayar
		$this->buildSearchSql($where, $this->tgl_bayar, $default, FALSE); // tgl_bayar
		$this->buildSearchSql($where, $this->kdinformasi, $default, FALSE); // kdinformasi
		$this->buildSearchSql($where, $this->konfirmasi, $default, FALSE); // konfirmasi
		$this->buildSearchSql($where, $this->ket, $default, FALSE); // ket
		$this->buildSearchSql($where, $this->ket_lainnya, $default, FALSE); // ket_lainnya

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->id->AdvancedSearch->save(); // id
			$this->nama->AdvancedSearch->save(); // nama
			$this->perusahaan->AdvancedSearch->save(); // perusahaan
			$this->jabatan->AdvancedSearch->save(); // jabatan
			$this->tgl_daftar->AdvancedSearch->save(); // tgl_daftar
			$this->telp->AdvancedSearch->save(); // telp
			$this->fax->AdvancedSearch->save(); // fax
			$this->hp->AdvancedSearch->save(); // hp
			$this->produk->AdvancedSearch->save(); // produk
			$this->cara_bayar->AdvancedSearch->save(); // cara_bayar
			$this->ket_bayar->AdvancedSearch->save(); // ket_bayar
			$this->tgl_bayar->AdvancedSearch->save(); // tgl_bayar
			$this->kdinformasi->AdvancedSearch->save(); // kdinformasi
			$this->konfirmasi->AdvancedSearch->save(); // konfirmasi
			$this->ket->AdvancedSearch->save(); // ket
			$this->ket_lainnya->AdvancedSearch->save(); // ket_lainnya
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
		if ($this->id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->perusahaan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jabatan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tgl_daftar->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->telp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->fax->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->hp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->produk->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->cara_bayar->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ket_bayar->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tgl_bayar->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdinformasi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->konfirmasi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ket->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ket_lainnya->AdvancedSearch->issetSession())
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
		$this->id->AdvancedSearch->unsetSession();
		$this->nama->AdvancedSearch->unsetSession();
		$this->perusahaan->AdvancedSearch->unsetSession();
		$this->jabatan->AdvancedSearch->unsetSession();
		$this->tgl_daftar->AdvancedSearch->unsetSession();
		$this->telp->AdvancedSearch->unsetSession();
		$this->fax->AdvancedSearch->unsetSession();
		$this->hp->AdvancedSearch->unsetSession();
		$this->produk->AdvancedSearch->unsetSession();
		$this->cara_bayar->AdvancedSearch->unsetSession();
		$this->ket_bayar->AdvancedSearch->unsetSession();
		$this->tgl_bayar->AdvancedSearch->unsetSession();
		$this->kdinformasi->AdvancedSearch->unsetSession();
		$this->konfirmasi->AdvancedSearch->unsetSession();
		$this->ket->AdvancedSearch->unsetSession();
		$this->ket_lainnya->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->id->AdvancedSearch->load();
		$this->nama->AdvancedSearch->load();
		$this->perusahaan->AdvancedSearch->load();
		$this->jabatan->AdvancedSearch->load();
		$this->tgl_daftar->AdvancedSearch->load();
		$this->telp->AdvancedSearch->load();
		$this->fax->AdvancedSearch->load();
		$this->hp->AdvancedSearch->load();
		$this->produk->AdvancedSearch->load();
		$this->cara_bayar->AdvancedSearch->load();
		$this->ket_bayar->AdvancedSearch->load();
		$this->tgl_bayar->AdvancedSearch->load();
		$this->kdinformasi->AdvancedSearch->load();
		$this->konfirmasi->AdvancedSearch->load();
		$this->ket->AdvancedSearch->load();
		$this->ket_lainnya->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->nama); // nama
			$this->updateSort($this->perusahaan); // perusahaan
			$this->updateSort($this->jabatan); // jabatan
			$this->updateSort($this->tgl_daftar); // tgl_daftar
			$this->updateSort($this->telp); // telp
			$this->updateSort($this->fax); // fax
			$this->updateSort($this->hp); // hp
			$this->updateSort($this->produk); // produk
			$this->updateSort($this->cara_bayar); // cara_bayar
			$this->updateSort($this->ket_bayar); // ket_bayar
			$this->updateSort($this->tgl_bayar); // tgl_bayar
			$this->updateSort($this->kdinformasi); // kdinformasi
			$this->updateSort($this->konfirmasi); // konfirmasi
			$this->updateSort($this->ket); // ket
			$this->updateSort($this->ket_lainnya); // ket_lainnya
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->idpelat->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->nama->setSort("");
				$this->perusahaan->setSort("");
				$this->jabatan->setSort("");
				$this->tgl_daftar->setSort("");
				$this->telp->setSort("");
				$this->fax->setSort("");
				$this->hp->setSort("");
				$this->produk->setSort("");
				$this->cara_bayar->setSort("");
				$this->ket_bayar->setSort("");
				$this->tgl_bayar->setSort("");
				$this->kdinformasi->setSort("");
				$this->konfirmasi->setSort("");
				$this->ket->setSort("");
				$this->ket_lainnya->setSort("");
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

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ft_repesertalistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ft_repesertalistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.ft_repesertalist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// nama
		if (!$this->isAddOrEdit() && $this->nama->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nama->AdvancedSearch->SearchValue != "" || $this->nama->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// perusahaan
		if (!$this->isAddOrEdit() && $this->perusahaan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->perusahaan->AdvancedSearch->SearchValue != "" || $this->perusahaan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jabatan
		if (!$this->isAddOrEdit() && $this->jabatan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jabatan->AdvancedSearch->SearchValue != "" || $this->jabatan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tgl_daftar
		if (!$this->isAddOrEdit() && $this->tgl_daftar->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tgl_daftar->AdvancedSearch->SearchValue != "" || $this->tgl_daftar->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// telp
		if (!$this->isAddOrEdit() && $this->telp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->telp->AdvancedSearch->SearchValue != "" || $this->telp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// fax
		if (!$this->isAddOrEdit() && $this->fax->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->fax->AdvancedSearch->SearchValue != "" || $this->fax->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// hp
		if (!$this->isAddOrEdit() && $this->hp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->hp->AdvancedSearch->SearchValue != "" || $this->hp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// produk
		if (!$this->isAddOrEdit() && $this->produk->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->produk->AdvancedSearch->SearchValue != "" || $this->produk->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// cara_bayar
		if (!$this->isAddOrEdit() && $this->cara_bayar->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->cara_bayar->AdvancedSearch->SearchValue != "" || $this->cara_bayar->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ket_bayar
		if (!$this->isAddOrEdit() && $this->ket_bayar->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ket_bayar->AdvancedSearch->SearchValue != "" || $this->ket_bayar->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tgl_bayar
		if (!$this->isAddOrEdit() && $this->tgl_bayar->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tgl_bayar->AdvancedSearch->SearchValue != "" || $this->tgl_bayar->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdinformasi
		if (!$this->isAddOrEdit() && $this->kdinformasi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdinformasi->AdvancedSearch->SearchValue != "" || $this->kdinformasi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// konfirmasi
		if (!$this->isAddOrEdit() && $this->konfirmasi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->konfirmasi->AdvancedSearch->SearchValue != "" || $this->konfirmasi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ket
		if (!$this->isAddOrEdit() && $this->ket->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ket->AdvancedSearch->SearchValue != "" || $this->ket->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ket_lainnya
		if (!$this->isAddOrEdit() && $this->ket_lainnya->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ket_lainnya->AdvancedSearch->SearchValue != "" || $this->ket_lainnya->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->id->setDbValue($row['id']);
		$this->idpelat->setDbValue($row['idpelat']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		$this->tgl_pel->setDbValue($row['tgl_pel']);
		$this->nama->setDbValue($row['nama']);
		$this->perusahaan->setDbValue($row['perusahaan']);
		$this->jabatan->setDbValue($row['jabatan']);
		$this->tgl_daftar->setDbValue($row['tgl_daftar']);
		$this->telp->setDbValue($row['telp']);
		$this->fax->setDbValue($row['fax']);
		$this->hp->setDbValue($row['hp']);
		$this->produk->setDbValue($row['produk']);
		$this->cara_bayar->setDbValue($row['cara_bayar']);
		$this->ket_bayar->setDbValue($row['ket_bayar']);
		$this->tgl_bayar->setDbValue($row['tgl_bayar']);
		$this->kdinformasi->setDbValue($row['kdinformasi']);
		$this->konfirmasi->setDbValue($row['konfirmasi']);
		$this->ket->setDbValue($row['ket']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->created_at->setDbValue($row['created_at']);
		$this->ket_lainnya->setDbValue($row['ket_lainnya']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['idpelat'] = NULL;
		$row['kdjudul'] = NULL;
		$row['tgl_pel'] = NULL;
		$row['nama'] = NULL;
		$row['perusahaan'] = NULL;
		$row['jabatan'] = NULL;
		$row['tgl_daftar'] = NULL;
		$row['telp'] = NULL;
		$row['fax'] = NULL;
		$row['hp'] = NULL;
		$row['produk'] = NULL;
		$row['cara_bayar'] = NULL;
		$row['ket_bayar'] = NULL;
		$row['tgl_bayar'] = NULL;
		$row['kdinformasi'] = NULL;
		$row['konfirmasi'] = NULL;
		$row['ket'] = NULL;
		$row['updated_at'] = NULL;
		$row['created_at'] = NULL;
		$row['ket_lainnya'] = NULL;
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
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// idpelat
		// kdjudul
		// tgl_pel
		// nama
		// perusahaan
		// jabatan
		// tgl_daftar
		// telp
		// fax
		// hp
		// produk
		// cara_bayar
		// ket_bayar
		// tgl_bayar
		// kdinformasi
		// konfirmasi
		// ket
		// updated_at
		// created_at
		// ket_lainnya

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// perusahaan
			$this->perusahaan->ViewValue = $this->perusahaan->CurrentValue;
			$this->perusahaan->ViewCustomAttributes = "";

			// jabatan
			$this->jabatan->ViewValue = $this->jabatan->CurrentValue;
			$curVal = strval($this->jabatan->CurrentValue);
			if ($curVal != "") {
				$this->jabatan->ViewValue = $this->jabatan->lookupCacheOption($curVal);
				if ($this->jabatan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jabatan->ViewValue = $this->jabatan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan->ViewValue = $this->jabatan->CurrentValue;
					}
				}
			} else {
				$this->jabatan->ViewValue = NULL;
			}
			$this->jabatan->ViewCustomAttributes = "";

			// tgl_daftar
			$this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
			$this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
			$this->tgl_daftar->ViewCustomAttributes = "";

			// telp
			$this->telp->ViewValue = $this->telp->CurrentValue;
			$this->telp->ViewCustomAttributes = "";

			// fax
			$this->fax->ViewValue = $this->fax->CurrentValue;
			$this->fax->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// produk
			$this->produk->ViewValue = $this->produk->CurrentValue;
			$this->produk->ViewCustomAttributes = "";

			// cara_bayar
			if (strval($this->cara_bayar->CurrentValue) != "") {
				$this->cara_bayar->ViewValue = $this->cara_bayar->optionCaption($this->cara_bayar->CurrentValue);
			} else {
				$this->cara_bayar->ViewValue = NULL;
			}
			$this->cara_bayar->ViewCustomAttributes = "";

			// ket_bayar
			$this->ket_bayar->ViewValue = $this->ket_bayar->CurrentValue;
			$this->ket_bayar->ViewCustomAttributes = "";

			// tgl_bayar
			$this->tgl_bayar->ViewValue = $this->tgl_bayar->CurrentValue;
			$this->tgl_bayar->ViewValue = FormatDateTime($this->tgl_bayar->ViewValue, 0);
			$this->tgl_bayar->ViewCustomAttributes = "";

			// kdinformasi
			$curVal = strval($this->kdinformasi->CurrentValue);
			if ($curVal != "") {
				$this->kdinformasi->ViewValue = $this->kdinformasi->lookupCacheOption($curVal);
				if ($this->kdinformasi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdinformasi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdinformasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdinformasi->ViewValue = $this->kdinformasi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdinformasi->ViewValue = $this->kdinformasi->CurrentValue;
					}
				}
			} else {
				$this->kdinformasi->ViewValue = NULL;
			}
			$this->kdinformasi->ViewCustomAttributes = "";

			// konfirmasi
			if (strval($this->konfirmasi->CurrentValue) != "") {
				$this->konfirmasi->ViewValue = $this->konfirmasi->optionCaption($this->konfirmasi->CurrentValue);
			} else {
				$this->konfirmasi->ViewValue = NULL;
			}
			$this->konfirmasi->ViewCustomAttributes = "";

			// ket
			if (strval($this->ket->CurrentValue) != "") {
				$this->ket->ViewValue = $this->ket->optionCaption($this->ket->CurrentValue);
			} else {
				$this->ket->ViewValue = NULL;
			}
			$this->ket->ViewCustomAttributes = "";

			// ket_lainnya
			$this->ket_lainnya->ViewValue = $this->ket_lainnya->CurrentValue;
			$this->ket_lainnya->ViewCustomAttributes = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";
			if (!$this->isExport())
				$this->nama->ViewValue = $this->highlightValue($this->nama);

			// perusahaan
			$this->perusahaan->LinkCustomAttributes = "";
			$this->perusahaan->HrefValue = "";
			$this->perusahaan->TooltipValue = "";
			if (!$this->isExport())
				$this->perusahaan->ViewValue = $this->highlightValue($this->perusahaan);

			// jabatan
			$this->jabatan->LinkCustomAttributes = "";
			$this->jabatan->HrefValue = "";
			$this->jabatan->TooltipValue = "";
			if (!$this->isExport())
				$this->jabatan->ViewValue = $this->highlightValue($this->jabatan);

			// tgl_daftar
			$this->tgl_daftar->LinkCustomAttributes = "";
			$this->tgl_daftar->HrefValue = "";
			$this->tgl_daftar->TooltipValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";
			$this->telp->TooltipValue = "";
			if (!$this->isExport())
				$this->telp->ViewValue = $this->highlightValue($this->telp);

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";
			$this->fax->TooltipValue = "";
			if (!$this->isExport())
				$this->fax->ViewValue = $this->highlightValue($this->fax);

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";
			$this->hp->TooltipValue = "";
			if (!$this->isExport())
				$this->hp->ViewValue = $this->highlightValue($this->hp);

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";
			$this->produk->TooltipValue = "";
			if (!$this->isExport())
				$this->produk->ViewValue = $this->highlightValue($this->produk);

			// cara_bayar
			$this->cara_bayar->LinkCustomAttributes = "";
			$this->cara_bayar->HrefValue = "";
			$this->cara_bayar->TooltipValue = "";

			// ket_bayar
			$this->ket_bayar->LinkCustomAttributes = "";
			$this->ket_bayar->HrefValue = "";
			$this->ket_bayar->TooltipValue = "";
			if (!$this->isExport())
				$this->ket_bayar->ViewValue = $this->highlightValue($this->ket_bayar);

			// tgl_bayar
			$this->tgl_bayar->LinkCustomAttributes = "";
			$this->tgl_bayar->HrefValue = "";
			$this->tgl_bayar->TooltipValue = "";

			// kdinformasi
			$this->kdinformasi->LinkCustomAttributes = "";
			$this->kdinformasi->HrefValue = "";
			$this->kdinformasi->TooltipValue = "";

			// konfirmasi
			$this->konfirmasi->LinkCustomAttributes = "";
			$this->konfirmasi->HrefValue = "";
			$this->konfirmasi->TooltipValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";
			$this->ket->TooltipValue = "";

			// ket_lainnya
			$this->ket_lainnya->LinkCustomAttributes = "";
			$this->ket_lainnya->HrefValue = "";
			$this->ket_lainnya->TooltipValue = "";
			if (!$this->isExport())
				$this->ket_lainnya->ViewValue = $this->highlightValue($this->ket_lainnya);
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->AdvancedSearch->SearchValue = HtmlDecode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->EditValue = HtmlEncode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// perusahaan
			$this->perusahaan->EditAttrs["class"] = "form-control";
			$this->perusahaan->EditCustomAttributes = "";
			if (!$this->perusahaan->Raw)
				$this->perusahaan->AdvancedSearch->SearchValue = HtmlDecode($this->perusahaan->AdvancedSearch->SearchValue);
			$this->perusahaan->EditValue = HtmlEncode($this->perusahaan->AdvancedSearch->SearchValue);
			$this->perusahaan->PlaceHolder = RemoveHtml($this->perusahaan->caption());

			// jabatan
			$this->jabatan->EditAttrs["class"] = "form-control";
			$this->jabatan->EditCustomAttributes = "";
			if (!$this->jabatan->Raw)
				$this->jabatan->AdvancedSearch->SearchValue = HtmlDecode($this->jabatan->AdvancedSearch->SearchValue);
			$this->jabatan->EditValue = HtmlEncode($this->jabatan->AdvancedSearch->SearchValue);
			$this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());

			// tgl_daftar
			$this->tgl_daftar->EditAttrs["class"] = "form-control";
			$this->tgl_daftar->EditCustomAttributes = "";
			$this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_daftar->AdvancedSearch->SearchValue, 0), 8));
			$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			if (!$this->telp->Raw)
				$this->telp->AdvancedSearch->SearchValue = HtmlDecode($this->telp->AdvancedSearch->SearchValue);
			$this->telp->EditValue = HtmlEncode($this->telp->AdvancedSearch->SearchValue);
			$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			if (!$this->fax->Raw)
				$this->fax->AdvancedSearch->SearchValue = HtmlDecode($this->fax->AdvancedSearch->SearchValue);
			$this->fax->EditValue = HtmlEncode($this->fax->AdvancedSearch->SearchValue);
			$this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->AdvancedSearch->SearchValue = HtmlDecode($this->hp->AdvancedSearch->SearchValue);
			$this->hp->EditValue = HtmlEncode($this->hp->AdvancedSearch->SearchValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "";
			if (!$this->produk->Raw)
				$this->produk->AdvancedSearch->SearchValue = HtmlDecode($this->produk->AdvancedSearch->SearchValue);
			$this->produk->EditValue = HtmlEncode($this->produk->AdvancedSearch->SearchValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// cara_bayar
			$this->cara_bayar->EditCustomAttributes = "";
			$this->cara_bayar->EditValue = $this->cara_bayar->options(FALSE);

			// ket_bayar
			$this->ket_bayar->EditAttrs["class"] = "form-control";
			$this->ket_bayar->EditCustomAttributes = "";
			$this->ket_bayar->EditValue = HtmlEncode($this->ket_bayar->AdvancedSearch->SearchValue);
			$this->ket_bayar->PlaceHolder = RemoveHtml($this->ket_bayar->caption());

			// tgl_bayar
			$this->tgl_bayar->EditAttrs["class"] = "form-control";
			$this->tgl_bayar->EditCustomAttributes = "";
			$this->tgl_bayar->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_bayar->AdvancedSearch->SearchValue, 0), 8));
			$this->tgl_bayar->PlaceHolder = RemoveHtml($this->tgl_bayar->caption());

			// kdinformasi
			$this->kdinformasi->EditAttrs["class"] = "form-control";
			$this->kdinformasi->EditCustomAttributes = "";

			// konfirmasi
			$this->konfirmasi->EditAttrs["class"] = "form-control";
			$this->konfirmasi->EditCustomAttributes = "";
			$this->konfirmasi->EditValue = $this->konfirmasi->options(TRUE);

			// ket
			$this->ket->EditAttrs["class"] = "form-control";
			$this->ket->EditCustomAttributes = "";
			$this->ket->EditValue = $this->ket->options(TRUE);

			// ket_lainnya
			$this->ket_lainnya->EditAttrs["class"] = "form-control";
			$this->ket_lainnya->EditCustomAttributes = "";
			$this->ket_lainnya->EditValue = HtmlEncode($this->ket_lainnya->AdvancedSearch->SearchValue);
			$this->ket_lainnya->PlaceHolder = RemoveHtml($this->ket_lainnya->caption());
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
		$this->nama->AdvancedSearch->load();
		$this->perusahaan->AdvancedSearch->load();
		$this->jabatan->AdvancedSearch->load();
		$this->tgl_daftar->AdvancedSearch->load();
		$this->telp->AdvancedSearch->load();
		$this->fax->AdvancedSearch->load();
		$this->hp->AdvancedSearch->load();
		$this->produk->AdvancedSearch->load();
		$this->cara_bayar->AdvancedSearch->load();
		$this->ket_bayar->AdvancedSearch->load();
		$this->tgl_bayar->AdvancedSearch->load();
		$this->kdinformasi->AdvancedSearch->load();
		$this->konfirmasi->AdvancedSearch->load();
		$this->ket->AdvancedSearch->load();
		$this->ket_lainnya->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ft_repesertalist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ft_repesertalist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ft_repesertalist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_t_repeserta" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_t_repeserta\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ft_repesertalist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Visible = FALSE;

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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft_repesertalistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"t_repesertasrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"t_repeserta\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'t_repesertasrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"ft_repesertalistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != "" && $this->TotalRecords > 0);

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

		// Export master record
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "cv_pelrepes") {
			global $cv_pelrepes;
			if (!isset($cv_pelrepes))
				$cv_pelrepes = new cv_pelrepes();
			$rsmaster = $cv_pelrepes->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("v"); // Change to vertical
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$cv_pelrepes;
					$cv_pelrepes->exportDocument($doc, $rsmaster);
					$doc->exportEmptyRow();
					$doc->Table = &$this;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsmaster->close();
			}
		}
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
			if ($masterTblVar == "cv_pelrepes") {
				$validMaster = TRUE;
				if (($parm = Get("fk_idpelat", Get("idpelat"))) !== NULL) {
					$GLOBALS["cv_pelrepes"]->idpelat->setQueryStringValue($parm);
					$this->idpelat->setQueryStringValue($GLOBALS["cv_pelrepes"]->idpelat->QueryStringValue);
					$this->idpelat->setSessionValue($this->idpelat->QueryStringValue);
					if (!is_numeric($GLOBALS["cv_pelrepes"]->idpelat->QueryStringValue))
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
			if ($masterTblVar == "cv_pelrepes") {
				$validMaster = TRUE;
				if (($parm = Post("fk_idpelat", Post("idpelat"))) !== NULL) {
					$GLOBALS["cv_pelrepes"]->idpelat->setFormValue($parm);
					$this->idpelat->setFormValue($GLOBALS["cv_pelrepes"]->idpelat->FormValue);
					$this->idpelat->setSessionValue($this->idpelat->FormValue);
					if (!is_numeric($GLOBALS["cv_pelrepes"]->idpelat->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Update URL
			$this->AddUrl = $this->addMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->addMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->addMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->addMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "cv_pelrepes") {
				if ($this->idpelat->CurrentValue == "")
					$this->idpelat->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_id":
					break;
				case "x_idpelat":
					break;
				case "x_kdjudul":
					break;
				case "x_jabatan":
					break;
				case "x_cara_bayar":
					break;
				case "x_kdinformasi":
					break;
				case "x_konfirmasi":
					break;
				case "x_ket":
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
						case "x_id":
							break;
						case "x_idpelat":
							break;
						case "x_kdjudul":
							break;
						case "x_jabatan":
							break;
						case "x_kdinformasi":
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
		$GLOBALS["ExportFileName"] = "Daftar_Calon_Peserta_Pelatihan.doc";
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
		if(strtotime($GLOBALS['cv_pelrepes']->tawal->CurrentValue) == strtotime($GLOBALS['cv_pelrepes']->takhir->CurrentValue)){
			$tgl = date("j",strtotime($GLOBALS['cv_pelrepes']->tawal->CurrentValue)). " " . ucfirst(BulanIndo(date("n",strtotime($GLOBALS['cv_pelrepes']->tawal->CurrentValue)))) . " " . date("Y".$GLOBALS['cv_pelrepes']->tawal->CurrentValue);
		} else {
			$bln_tawal = date("n",strtotime($GLOBALS['cv_pelrepes']->tawal->CurrentValue));
			$bln_takhir = date("n",strtotime($GLOBALS['cv_pelrepes']->takhir->CurrentValue));
			if($bln_tawal == $bln_takhir){
				$tgl = date("j",strtotime($GLOBALS['cv_pelrepes']->tawal->CurrentValue)) . " sampai dengan " . date("j",strtotime($GLOBALS['cv_pelrepes']->takhir->CurrentValue)). " " . ucfirst(BulanIndo($bln_tawal)) . " " . date("Y",strtotime($GLOBALS['cv_pelrepes']->tawal->CurrentValue));
				$bbb = 0;
			} else { // bulan berbeda
				$lanjutke = $bln_takhir - $bln_tawal + 1;
				$gabungkolom = " colspan='".$lanjutke."'";
				$bbb = $x+$lanjutke;
				$tgl = date("j",strtotime($GLOBALS['cv_pelrepes']->tawal->CurrentValue)) . " sampai dengan " . date("j",strtotime($GLOBALS['cv_pelrepes']->takhir->CurrentValue)). " " . ucfirst(BulanIndo($bln_tawal)) . " " . date("Y",strtotime($GLOBALS['cv_pelrepes']->tawal->CurrentValue));
			}
		}
		$tglpel = $tgl;
		$spasi = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$this->ExportDoc->Text = "
		<style>
		span {font-size:11.5pt;}
		table { border-collapse: collapse; border-bottom: 1px solid #000; }
		th, td { border: 1px solid #000; padding:5px;}
		th {font-size:8pt;}
		td {font-size:9pt;vertical-align: text-top; text-align: center;}
		</style>
		<span>NAMA PELATIHAN ".$spasi." : ".$GLOBALS['cv_pelrepes']->kdjudul->ViewValue."</span> <br>
		<span>TANGGAL ".$spasi."&nbsp;&nbsp;".$spasi." : ".$tglpel."</span><br><br><table><tr>
		<th rowspan='2'>NO</th>
		<th rowspan='2'>NAMA CALON PESERTA</th>
		<th rowspan='2'>PERUSAHAAN/ INSTANSI</th>
		<th rowspan='2'>JABATAN</th>
		<th rowspan='2'>TGL PEN-DAFTARAN</th>
		<th rowspan='2'>TELP./FAX & HP</th>
		<th rowspan='2'>PRODUK</th>
		<th colspan='2'>PEMBAYARAN</th>
		<th rowspan='2'>ASAL INFORMASI</th>
		<th rowspan='2'>REGISTRASI (via)</th>
		<th rowspan='2'>KONF.</th></tr>
		<tr><th>CARA</th><th>TANGGAL</th></tr>"; // Export header

		//return FALSE; // Return FALSE to skip default export and use Row_Export event
		$_SESSION["no"] = 1;
		return FALSE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//for($x = 1;$x <100;$x++){
		if($this->tgl_bayar->CurrentValue == ""){
			$tgl_bayar = $this->tgl_bayar->CurrentValue;
		} else {
			$tgl_bayar = date("j",strtotime($this->tgl_bayar->CurrentValue)) . " ". ucfirst(BulanIndo(date("n",strtotime($this->tgl_bayar->CurrentValue)))) . " " . date("Y",strtotime($this->tgl_bayar->CurrentValue));
		}
		$this->ExportDoc->Text .= "
			<tr>
			<td style='width:1%'>".$_SESSION["no"]."</td>
			<td style='text-align:left;width:16%'>".$this->nama->ViewValue."</td>
			<td style='width:10%'>".$this->perusahaan->ViewValue."</td>
			<td style='width:9%'>".$this->jabatan->ViewValue."</td>
			<td style='width:9%'>".date("j",strtotime($this->tgl_daftar->CurrentValue)) . " ". ucfirst(BulanIndo(date("n",strtotime($this->tgl_daftar->CurrentValue)))) . " " . date("Y",strtotime($this->tgl_daftar->CurrentValue))."</td>
			<td style='width:9%'>".$this->hp->ViewValue."</td>
			<td style='width:9%'>".$this->produk->ViewValue."</td>
			<td style='width:9%'>".$this->cara_bayar->ViewValue."</td>
			<td style='width:9%'>".$tgl_bayar."</td>
			<td style='width:8%'>".$this->kdinformasi->ViewValue."</td>
			<td style='width:8%'>".$this->ket->ViewValue."</td>
			<td style='width:3%'>".$this->konfirmasi->ViewValue."</td>
			</tr>
			"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
		$_SESSION["no"]++;

		//}
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {
		unset($_SESSION["no"]);

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;exit();

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