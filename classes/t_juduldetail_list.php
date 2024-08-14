<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_juduldetail_list extends t_juduldetail
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_juduldetail';

	// Page object name
	public $PageObjName = "t_juduldetail_list";

	// Grid form hidden field names
	public $FormName = "ft_juduldetaillist";
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

		// Table object (t_juduldetail)
		if (!isset($GLOBALS["t_juduldetail"]) || get_class($GLOBALS["t_juduldetail"]) == PROJECT_NAMESPACE . "t_juduldetail") {
			$GLOBALS["t_juduldetail"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_juduldetail"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "t_juduldetailadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "t_juduldetaildelete.php";
		$this->MultiUpdateUrl = "t_juduldetailupdate.php";

		// Table object (t_judul)
		if (!isset($GLOBALS['t_judul']))
			$GLOBALS['t_judul'] = new t_judul();

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_juduldetail');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ft_juduldetaillistsrch";

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
		global $t_juduldetail;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_juduldetail);
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
			$key .= @$ar['detailjdid'];
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
			$this->detailjdid->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->created_by->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->created_at->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->updated_by->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->updated_at->Visible = FALSE;
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
	public $DisplayRecords = 10;
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
	public $t_kurikulum_Count;
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
		$this->detailjdid->Visible = FALSE;
		$this->singbagian->setVisibility();
		$this->jpel->setVisibility();
		$this->kdjudul->setVisibility();
		$this->kdkursil->setVisibility();
		$this->revisi->setVisibility();
		$this->tgl_terbit->setVisibility();
		$this->deskripsi_singkat->setVisibility();
		$this->tujuan->setVisibility();
		$this->target_peserta->setVisibility();
		$this->lama_pelatihan->setVisibility();
		$this->catatan->setVisibility();
		$this->created_by->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->updated_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
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
		$this->setupLookupOptions($this->singbagian);
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->lama_pelatihan);

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
			$this->DisplayRecords = 10; // Load default
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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_judul") {
			global $t_judul;
			$rsmaster = $t_judul->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("t_judullist.php"); // Return to master page
			} else {
				$t_judul->loadListRowValues($rsmaster);
				$t_judul->RowType = ROWTYPE_MASTER; // Master row
				$t_judul->renderListRow();
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
					$this->DisplayRecords = 10; // Non-numeric, load default
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
			$this->detailjdid->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->detailjdid->OldValue))
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
		$filterList = Concat($filterList, $this->detailjdid->AdvancedSearch->toJson(), ","); // Field detailjdid
		$filterList = Concat($filterList, $this->singbagian->AdvancedSearch->toJson(), ","); // Field singbagian
		$filterList = Concat($filterList, $this->jpel->AdvancedSearch->toJson(), ","); // Field jpel
		$filterList = Concat($filterList, $this->kdjudul->AdvancedSearch->toJson(), ","); // Field kdjudul
		$filterList = Concat($filterList, $this->kdkursil->AdvancedSearch->toJson(), ","); // Field kdkursil
		$filterList = Concat($filterList, $this->revisi->AdvancedSearch->toJson(), ","); // Field revisi
		$filterList = Concat($filterList, $this->tgl_terbit->AdvancedSearch->toJson(), ","); // Field tgl_terbit
		$filterList = Concat($filterList, $this->deskripsi_singkat->AdvancedSearch->toJson(), ","); // Field deskripsi_singkat
		$filterList = Concat($filterList, $this->target_peserta->AdvancedSearch->toJson(), ","); // Field target_peserta
		$filterList = Concat($filterList, $this->lama_pelatihan->AdvancedSearch->toJson(), ","); // Field lama_pelatihan
		$filterList = Concat($filterList, $this->catatan->AdvancedSearch->toJson(), ","); // Field catatan
		$filterList = Concat($filterList, $this->created_by->AdvancedSearch->toJson(), ","); // Field created_by
		$filterList = Concat($filterList, $this->created_at->AdvancedSearch->toJson(), ","); // Field created_at
		$filterList = Concat($filterList, $this->updated_by->AdvancedSearch->toJson(), ","); // Field updated_by
		$filterList = Concat($filterList, $this->updated_at->AdvancedSearch->toJson(), ","); // Field updated_at

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
			$UserProfile->setSearchFilters(CurrentUserName(), "ft_juduldetaillistsrch", $filters);
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

		// Field detailjdid
		$this->detailjdid->AdvancedSearch->SearchValue = @$filter["x_detailjdid"];
		$this->detailjdid->AdvancedSearch->SearchOperator = @$filter["z_detailjdid"];
		$this->detailjdid->AdvancedSearch->SearchCondition = @$filter["v_detailjdid"];
		$this->detailjdid->AdvancedSearch->SearchValue2 = @$filter["y_detailjdid"];
		$this->detailjdid->AdvancedSearch->SearchOperator2 = @$filter["w_detailjdid"];
		$this->detailjdid->AdvancedSearch->save();

		// Field singbagian
		$this->singbagian->AdvancedSearch->SearchValue = @$filter["x_singbagian"];
		$this->singbagian->AdvancedSearch->SearchOperator = @$filter["z_singbagian"];
		$this->singbagian->AdvancedSearch->SearchCondition = @$filter["v_singbagian"];
		$this->singbagian->AdvancedSearch->SearchValue2 = @$filter["y_singbagian"];
		$this->singbagian->AdvancedSearch->SearchOperator2 = @$filter["w_singbagian"];
		$this->singbagian->AdvancedSearch->save();

		// Field jpel
		$this->jpel->AdvancedSearch->SearchValue = @$filter["x_jpel"];
		$this->jpel->AdvancedSearch->SearchOperator = @$filter["z_jpel"];
		$this->jpel->AdvancedSearch->SearchCondition = @$filter["v_jpel"];
		$this->jpel->AdvancedSearch->SearchValue2 = @$filter["y_jpel"];
		$this->jpel->AdvancedSearch->SearchOperator2 = @$filter["w_jpel"];
		$this->jpel->AdvancedSearch->save();

		// Field kdjudul
		$this->kdjudul->AdvancedSearch->SearchValue = @$filter["x_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchOperator = @$filter["z_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchCondition = @$filter["v_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchValue2 = @$filter["y_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchOperator2 = @$filter["w_kdjudul"];
		$this->kdjudul->AdvancedSearch->save();

		// Field kdkursil
		$this->kdkursil->AdvancedSearch->SearchValue = @$filter["x_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchOperator = @$filter["z_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchCondition = @$filter["v_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchValue2 = @$filter["y_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchOperator2 = @$filter["w_kdkursil"];
		$this->kdkursil->AdvancedSearch->save();

		// Field revisi
		$this->revisi->AdvancedSearch->SearchValue = @$filter["x_revisi"];
		$this->revisi->AdvancedSearch->SearchOperator = @$filter["z_revisi"];
		$this->revisi->AdvancedSearch->SearchCondition = @$filter["v_revisi"];
		$this->revisi->AdvancedSearch->SearchValue2 = @$filter["y_revisi"];
		$this->revisi->AdvancedSearch->SearchOperator2 = @$filter["w_revisi"];
		$this->revisi->AdvancedSearch->save();

		// Field tgl_terbit
		$this->tgl_terbit->AdvancedSearch->SearchValue = @$filter["x_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->SearchOperator = @$filter["z_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->SearchCondition = @$filter["v_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->SearchValue2 = @$filter["y_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->save();

		// Field deskripsi_singkat
		$this->deskripsi_singkat->AdvancedSearch->SearchValue = @$filter["x_deskripsi_singkat"];
		$this->deskripsi_singkat->AdvancedSearch->SearchOperator = @$filter["z_deskripsi_singkat"];
		$this->deskripsi_singkat->AdvancedSearch->SearchCondition = @$filter["v_deskripsi_singkat"];
		$this->deskripsi_singkat->AdvancedSearch->SearchValue2 = @$filter["y_deskripsi_singkat"];
		$this->deskripsi_singkat->AdvancedSearch->SearchOperator2 = @$filter["w_deskripsi_singkat"];
		$this->deskripsi_singkat->AdvancedSearch->save();

		// Field target_peserta
		$this->target_peserta->AdvancedSearch->SearchValue = @$filter["x_target_peserta"];
		$this->target_peserta->AdvancedSearch->SearchOperator = @$filter["z_target_peserta"];
		$this->target_peserta->AdvancedSearch->SearchCondition = @$filter["v_target_peserta"];
		$this->target_peserta->AdvancedSearch->SearchValue2 = @$filter["y_target_peserta"];
		$this->target_peserta->AdvancedSearch->SearchOperator2 = @$filter["w_target_peserta"];
		$this->target_peserta->AdvancedSearch->save();

		// Field lama_pelatihan
		$this->lama_pelatihan->AdvancedSearch->SearchValue = @$filter["x_lama_pelatihan"];
		$this->lama_pelatihan->AdvancedSearch->SearchOperator = @$filter["z_lama_pelatihan"];
		$this->lama_pelatihan->AdvancedSearch->SearchCondition = @$filter["v_lama_pelatihan"];
		$this->lama_pelatihan->AdvancedSearch->SearchValue2 = @$filter["y_lama_pelatihan"];
		$this->lama_pelatihan->AdvancedSearch->SearchOperator2 = @$filter["w_lama_pelatihan"];
		$this->lama_pelatihan->AdvancedSearch->save();

		// Field catatan
		$this->catatan->AdvancedSearch->SearchValue = @$filter["x_catatan"];
		$this->catatan->AdvancedSearch->SearchOperator = @$filter["z_catatan"];
		$this->catatan->AdvancedSearch->SearchCondition = @$filter["v_catatan"];
		$this->catatan->AdvancedSearch->SearchValue2 = @$filter["y_catatan"];
		$this->catatan->AdvancedSearch->SearchOperator2 = @$filter["w_catatan"];
		$this->catatan->AdvancedSearch->save();

		// Field created_by
		$this->created_by->AdvancedSearch->SearchValue = @$filter["x_created_by"];
		$this->created_by->AdvancedSearch->SearchOperator = @$filter["z_created_by"];
		$this->created_by->AdvancedSearch->SearchCondition = @$filter["v_created_by"];
		$this->created_by->AdvancedSearch->SearchValue2 = @$filter["y_created_by"];
		$this->created_by->AdvancedSearch->SearchOperator2 = @$filter["w_created_by"];
		$this->created_by->AdvancedSearch->save();

		// Field created_at
		$this->created_at->AdvancedSearch->SearchValue = @$filter["x_created_at"];
		$this->created_at->AdvancedSearch->SearchOperator = @$filter["z_created_at"];
		$this->created_at->AdvancedSearch->SearchCondition = @$filter["v_created_at"];
		$this->created_at->AdvancedSearch->SearchValue2 = @$filter["y_created_at"];
		$this->created_at->AdvancedSearch->SearchOperator2 = @$filter["w_created_at"];
		$this->created_at->AdvancedSearch->save();

		// Field updated_by
		$this->updated_by->AdvancedSearch->SearchValue = @$filter["x_updated_by"];
		$this->updated_by->AdvancedSearch->SearchOperator = @$filter["z_updated_by"];
		$this->updated_by->AdvancedSearch->SearchCondition = @$filter["v_updated_by"];
		$this->updated_by->AdvancedSearch->SearchValue2 = @$filter["y_updated_by"];
		$this->updated_by->AdvancedSearch->SearchOperator2 = @$filter["w_updated_by"];
		$this->updated_by->AdvancedSearch->save();

		// Field updated_at
		$this->updated_at->AdvancedSearch->SearchValue = @$filter["x_updated_at"];
		$this->updated_at->AdvancedSearch->SearchOperator = @$filter["z_updated_at"];
		$this->updated_at->AdvancedSearch->SearchCondition = @$filter["v_updated_at"];
		$this->updated_at->AdvancedSearch->SearchValue2 = @$filter["y_updated_at"];
		$this->updated_at->AdvancedSearch->SearchOperator2 = @$filter["w_updated_at"];
		$this->updated_at->AdvancedSearch->save();
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->detailjdid, $default, FALSE); // detailjdid
		$this->buildSearchSql($where, $this->singbagian, $default, FALSE); // singbagian
		$this->buildSearchSql($where, $this->jpel, $default, FALSE); // jpel
		$this->buildSearchSql($where, $this->kdjudul, $default, FALSE); // kdjudul
		$this->buildSearchSql($where, $this->kdkursil, $default, FALSE); // kdkursil
		$this->buildSearchSql($where, $this->revisi, $default, FALSE); // revisi
		$this->buildSearchSql($where, $this->tgl_terbit, $default, FALSE); // tgl_terbit
		$this->buildSearchSql($where, $this->deskripsi_singkat, $default, FALSE); // deskripsi_singkat
		$this->buildSearchSql($where, $this->target_peserta, $default, FALSE); // target_peserta
		$this->buildSearchSql($where, $this->lama_pelatihan, $default, FALSE); // lama_pelatihan
		$this->buildSearchSql($where, $this->catatan, $default, FALSE); // catatan
		$this->buildSearchSql($where, $this->created_by, $default, FALSE); // created_by
		$this->buildSearchSql($where, $this->created_at, $default, FALSE); // created_at
		$this->buildSearchSql($where, $this->updated_by, $default, FALSE); // updated_by
		$this->buildSearchSql($where, $this->updated_at, $default, FALSE); // updated_at

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->detailjdid->AdvancedSearch->save(); // detailjdid
			$this->singbagian->AdvancedSearch->save(); // singbagian
			$this->jpel->AdvancedSearch->save(); // jpel
			$this->kdjudul->AdvancedSearch->save(); // kdjudul
			$this->kdkursil->AdvancedSearch->save(); // kdkursil
			$this->revisi->AdvancedSearch->save(); // revisi
			$this->tgl_terbit->AdvancedSearch->save(); // tgl_terbit
			$this->deskripsi_singkat->AdvancedSearch->save(); // deskripsi_singkat
			$this->target_peserta->AdvancedSearch->save(); // target_peserta
			$this->lama_pelatihan->AdvancedSearch->save(); // lama_pelatihan
			$this->catatan->AdvancedSearch->save(); // catatan
			$this->created_by->AdvancedSearch->save(); // created_by
			$this->created_at->AdvancedSearch->save(); // created_at
			$this->updated_by->AdvancedSearch->save(); // updated_by
			$this->updated_at->AdvancedSearch->save(); // updated_at
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
		if ($this->detailjdid->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->singbagian->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jpel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdjudul->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkursil->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->revisi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tgl_terbit->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->deskripsi_singkat->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->target_peserta->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->lama_pelatihan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->catatan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->created_by->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->created_at->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->updated_by->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->updated_at->AdvancedSearch->issetSession())
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
		$this->detailjdid->AdvancedSearch->unsetSession();
		$this->singbagian->AdvancedSearch->unsetSession();
		$this->jpel->AdvancedSearch->unsetSession();
		$this->kdjudul->AdvancedSearch->unsetSession();
		$this->kdkursil->AdvancedSearch->unsetSession();
		$this->revisi->AdvancedSearch->unsetSession();
		$this->tgl_terbit->AdvancedSearch->unsetSession();
		$this->deskripsi_singkat->AdvancedSearch->unsetSession();
		$this->target_peserta->AdvancedSearch->unsetSession();
		$this->lama_pelatihan->AdvancedSearch->unsetSession();
		$this->catatan->AdvancedSearch->unsetSession();
		$this->created_by->AdvancedSearch->unsetSession();
		$this->created_at->AdvancedSearch->unsetSession();
		$this->updated_by->AdvancedSearch->unsetSession();
		$this->updated_at->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->detailjdid->AdvancedSearch->load();
		$this->singbagian->AdvancedSearch->load();
		$this->jpel->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->kdkursil->AdvancedSearch->load();
		$this->revisi->AdvancedSearch->load();
		$this->tgl_terbit->AdvancedSearch->load();
		$this->deskripsi_singkat->AdvancedSearch->load();
		$this->target_peserta->AdvancedSearch->load();
		$this->lama_pelatihan->AdvancedSearch->load();
		$this->catatan->AdvancedSearch->load();
		$this->created_by->AdvancedSearch->load();
		$this->created_at->AdvancedSearch->load();
		$this->updated_by->AdvancedSearch->load();
		$this->updated_at->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->singbagian); // singbagian
			$this->updateSort($this->jpel); // jpel
			$this->updateSort($this->kdjudul); // kdjudul
			$this->updateSort($this->kdkursil); // kdkursil
			$this->updateSort($this->revisi); // revisi
			$this->updateSort($this->tgl_terbit); // tgl_terbit
			$this->updateSort($this->deskripsi_singkat); // deskripsi_singkat
			$this->updateSort($this->tujuan); // tujuan
			$this->updateSort($this->target_peserta); // target_peserta
			$this->updateSort($this->lama_pelatihan); // lama_pelatihan
			$this->updateSort($this->catatan); // catatan
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
				$this->kdjudul->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
				$this->singbagian->setSort("");
				$this->jpel->setSort("");
				$this->kdjudul->setSort("");
				$this->kdkursil->setSort("");
				$this->revisi->setSort("");
				$this->tgl_terbit->setSort("");
				$this->deskripsi_singkat->setSort("");
				$this->tujuan->setSort("");
				$this->target_peserta->setSort("");
				$this->lama_pelatihan->setSort("");
				$this->catatan->setSort("");
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

		// "detail_t_kurikulum"
		$item = &$this->ListOptions->add("detail_t_kurikulum");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_kurikulum') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_kurikulum_grid"]))
			$GLOBALS["t_kurikulum_grid"] = new t_kurikulum_grid();

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
		$pages->add("t_kurikulum");
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

		// "detail_t_kurikulum"
		$opt = $this->ListOptions["detail_t_kurikulum"];
		if ($Security->allowList(CurrentProjectID() . 't_kurikulum')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_kurikulum", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->t_kurikulum_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_kurikulumlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_juduldetail&fk_kdkursil=" . urlencode(strval($this->kdkursil->CurrentValue)) . "&fk_jpel=" . urlencode(strval($this->jpel->CurrentValue)) . "&fk_kdjudul=" . urlencode(strval($this->kdjudul->CurrentValue)) . "&fk_revisi=" . urlencode(strval($this->revisi->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_kurikulum_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_juduldetail')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_kurikulum");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_kurikulum";
			}
			if ($GLOBALS["t_kurikulum_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_juduldetail')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_kurikulum");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_kurikulum";
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->detailjdid->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item = &$option->add("detailadd_t_kurikulum");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_kurikulum");
		if (!isset($GLOBALS["t_kurikulum"]))
			$GLOBALS["t_kurikulum"] = new t_kurikulum();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_kurikulum"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_kurikulum"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_juduldetail') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_kurikulum";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ft_juduldetaillistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ft_juduldetaillistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.ft_juduldetaillist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// detailjdid
		if (!$this->isAddOrEdit() && $this->detailjdid->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->detailjdid->AdvancedSearch->SearchValue != "" || $this->detailjdid->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// singbagian
		if (!$this->isAddOrEdit() && $this->singbagian->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->singbagian->AdvancedSearch->SearchValue != "" || $this->singbagian->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jpel
		if (!$this->isAddOrEdit() && $this->jpel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jpel->AdvancedSearch->SearchValue != "" || $this->jpel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdjudul
		if (!$this->isAddOrEdit() && $this->kdjudul->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdjudul->AdvancedSearch->SearchValue != "" || $this->kdjudul->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdkursil
		if (!$this->isAddOrEdit() && $this->kdkursil->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdkursil->AdvancedSearch->SearchValue != "" || $this->kdkursil->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// revisi
		if (!$this->isAddOrEdit() && $this->revisi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->revisi->AdvancedSearch->SearchValue != "" || $this->revisi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tgl_terbit
		if (!$this->isAddOrEdit() && $this->tgl_terbit->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tgl_terbit->AdvancedSearch->SearchValue != "" || $this->tgl_terbit->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// deskripsi_singkat
		if (!$this->isAddOrEdit() && $this->deskripsi_singkat->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->deskripsi_singkat->AdvancedSearch->SearchValue != "" || $this->deskripsi_singkat->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// target_peserta
		if (!$this->isAddOrEdit() && $this->target_peserta->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->target_peserta->AdvancedSearch->SearchValue != "" || $this->target_peserta->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// lama_pelatihan
		if (!$this->isAddOrEdit() && $this->lama_pelatihan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->lama_pelatihan->AdvancedSearch->SearchValue != "" || $this->lama_pelatihan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// catatan
		if (!$this->isAddOrEdit() && $this->catatan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->catatan->AdvancedSearch->SearchValue != "" || $this->catatan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// created_by
		if (!$this->isAddOrEdit() && $this->created_by->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->created_by->AdvancedSearch->SearchValue != "" || $this->created_by->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// created_at
		if (!$this->isAddOrEdit() && $this->created_at->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->created_at->AdvancedSearch->SearchValue != "" || $this->created_at->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// updated_by
		if (!$this->isAddOrEdit() && $this->updated_by->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->updated_by->AdvancedSearch->SearchValue != "" || $this->updated_by->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// updated_at
		if (!$this->isAddOrEdit() && $this->updated_at->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->updated_at->AdvancedSearch->SearchValue != "" || $this->updated_at->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->detailjdid->setDbValue($row['detailjdid']);
		$this->singbagian->setDbValue($row['singbagian']);
		$this->jpel->setDbValue($row['jpel']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->revisi->setDbValue($row['revisi']);
		$this->tgl_terbit->setDbValue($row['tgl_terbit']);
		$this->deskripsi_singkat->setDbValue($row['deskripsi_singkat']);
		$this->tujuan->setDbValue($row['tujuan']);
		$this->target_peserta->setDbValue($row['target_peserta']);
		$this->lama_pelatihan->setDbValue($row['lama_pelatihan']);
		$this->catatan->setDbValue($row['catatan']);
		$this->created_by->setDbValue($row['created_by']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_by->setDbValue($row['updated_by']);
		$this->updated_at->setDbValue($row['updated_at']);
		if (!isset($GLOBALS["t_kurikulum_grid"]))
			$GLOBALS["t_kurikulum_grid"] = new t_kurikulum_grid();
		$detailFilter = $GLOBALS["t_kurikulum"]->sqlDetailFilter_t_juduldetail();
		$detailFilter = str_replace("@kdkursil@", AdjustSql($this->kdkursil->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@jpel@", AdjustSql($this->jpel->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@kdjudul@", AdjustSql($this->kdjudul->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@revisi@", AdjustSql($this->revisi->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_kurikulum"]->setCurrentMasterTable("t_juduldetail");
		$detailFilter = $GLOBALS["t_kurikulum"]->applyUserIDFilters($detailFilter);
		$this->t_kurikulum_Count = $GLOBALS["t_kurikulum"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['detailjdid'] = NULL;
		$row['singbagian'] = NULL;
		$row['jpel'] = NULL;
		$row['kdjudul'] = NULL;
		$row['kdkursil'] = NULL;
		$row['revisi'] = NULL;
		$row['tgl_terbit'] = NULL;
		$row['deskripsi_singkat'] = NULL;
		$row['tujuan'] = NULL;
		$row['target_peserta'] = NULL;
		$row['lama_pelatihan'] = NULL;
		$row['catatan'] = NULL;
		$row['created_by'] = NULL;
		$row['created_at'] = NULL;
		$row['updated_by'] = NULL;
		$row['updated_at'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("detailjdid")) != "")
			$this->detailjdid->OldValue = $this->getKey("detailjdid"); // detailjdid
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
		// detailjdid
		// singbagian
		// jpel
		// kdjudul
		// kdkursil
		// revisi
		// tgl_terbit
		// deskripsi_singkat
		// tujuan
		// target_peserta
		// lama_pelatihan
		// catatan
		// created_by
		// created_at
		// updated_by
		// updated_at

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// singbagian
			$curVal = strval($this->singbagian->CurrentValue);
			if ($curVal != "") {
				$this->singbagian->ViewValue = $this->singbagian->lookupCacheOption($curVal);
				if ($this->singbagian->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`singkatan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->singbagian->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->singbagian->ViewValue = $this->singbagian->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->singbagian->ViewValue = $this->singbagian->CurrentValue;
					}
				}
			} else {
				$this->singbagian->ViewValue = NULL;
			}
			$this->singbagian->ViewCustomAttributes = "";

			// jpel
			if (strval($this->jpel->CurrentValue) != "") {
				$this->jpel->ViewValue = $this->jpel->optionCaption($this->jpel->CurrentValue);
			} else {
				$this->jpel->ViewValue = NULL;
			}
			$this->jpel->ViewCustomAttributes = "";

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

			// kdkursil
			$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
			$this->kdkursil->ViewCustomAttributes = "";

			// revisi
			$this->revisi->ViewValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tgl_terbit
			$this->tgl_terbit->ViewValue = $this->tgl_terbit->CurrentValue;
			$this->tgl_terbit->ViewValue = FormatDateTime($this->tgl_terbit->ViewValue, 0);
			$this->tgl_terbit->ViewCustomAttributes = "";

			// deskripsi_singkat
			$this->deskripsi_singkat->ViewValue = TruncateMemo($this->deskripsi_singkat->CurrentValue, 50, $this->deskripsi_singkat->TruncateMemoRemoveHtml);
			$this->deskripsi_singkat->ViewCustomAttributes = "";

			// tujuan
			$this->tujuan->ViewValue = TruncateMemo($this->tujuan->CurrentValue, 50, $this->tujuan->TruncateMemoRemoveHtml);
			$this->tujuan->ViewCustomAttributes = "";

			// target_peserta
			$this->target_peserta->ViewValue = TruncateMemo($this->target_peserta->CurrentValue, 50, $this->target_peserta->TruncateMemoRemoveHtml);
			$this->target_peserta->ViewCustomAttributes = "";

			// lama_pelatihan
			$curVal = strval($this->lama_pelatihan->CurrentValue);
			if ($curVal != "") {
				$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->lookupCacheOption($curVal);
				if ($this->lama_pelatihan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`angka`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->lama_pelatihan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->CurrentValue;
					}
				}
			} else {
				$this->lama_pelatihan->ViewValue = NULL;
			}
			$this->lama_pelatihan->ViewCustomAttributes = "";

			// catatan
			$this->catatan->ViewValue = $this->catatan->CurrentValue;
			$this->catatan->ViewCustomAttributes = "";

			// singbagian
			$this->singbagian->LinkCustomAttributes = "";
			$this->singbagian->HrefValue = "";
			$this->singbagian->TooltipValue = "";

			// jpel
			$this->jpel->LinkCustomAttributes = "";
			$this->jpel->HrefValue = "";
			$this->jpel->TooltipValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";
			$this->kdkursil->TooltipValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";
			$this->revisi->TooltipValue = "";

			// tgl_terbit
			$this->tgl_terbit->LinkCustomAttributes = "";
			$this->tgl_terbit->HrefValue = "";
			$this->tgl_terbit->TooltipValue = "";

			// deskripsi_singkat
			$this->deskripsi_singkat->LinkCustomAttributes = "";
			$this->deskripsi_singkat->HrefValue = "";
			if (!$this->isExport()) {
				$this->deskripsi_singkat->TooltipValue = strval($this->deskripsi_singkat->CurrentValue);
				$this->deskripsi_singkat->TooltipWidth = 500;
				if ($this->deskripsi_singkat->HrefValue == "")
					$this->deskripsi_singkat->HrefValue = "javascript:void(0);";
				$this->deskripsi_singkat->LinkAttrs->appendClass("ew-tooltip-link");
				$this->deskripsi_singkat->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x" . $this->RowCount . "_deskripsi_singkat";
				$this->deskripsi_singkat->LinkAttrs["data-tooltip-width"] = $this->deskripsi_singkat->TooltipWidth;
				$this->deskripsi_singkat->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
			}

			// tujuan
			$this->tujuan->LinkCustomAttributes = "";
			$this->tujuan->HrefValue = "";
			if (!$this->isExport()) {
				$this->tujuan->TooltipValue = strval($this->tujuan->CurrentValue);
				$this->tujuan->TooltipWidth = 300;
				if ($this->tujuan->HrefValue == "")
					$this->tujuan->HrefValue = "javascript:void(0);";
				$this->tujuan->LinkAttrs->appendClass("ew-tooltip-link");
				$this->tujuan->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x" . $this->RowCount . "_tujuan";
				$this->tujuan->LinkAttrs["data-tooltip-width"] = $this->tujuan->TooltipWidth;
				$this->tujuan->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
			}

			// target_peserta
			$this->target_peserta->LinkCustomAttributes = "";
			$this->target_peserta->HrefValue = "";
			if (!$this->isExport()) {
				$this->target_peserta->TooltipValue = strval($this->target_peserta->CurrentValue);
				$this->target_peserta->TooltipWidth = 300;
				if ($this->target_peserta->HrefValue == "")
					$this->target_peserta->HrefValue = "javascript:void(0);";
				$this->target_peserta->LinkAttrs->appendClass("ew-tooltip-link");
				$this->target_peserta->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x" . $this->RowCount . "_target_peserta";
				$this->target_peserta->LinkAttrs["data-tooltip-width"] = $this->target_peserta->TooltipWidth;
				$this->target_peserta->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
			}

			// lama_pelatihan
			$this->lama_pelatihan->LinkCustomAttributes = "";
			$this->lama_pelatihan->HrefValue = "";
			$this->lama_pelatihan->TooltipValue = "";

			// catatan
			$this->catatan->LinkCustomAttributes = "";
			$this->catatan->HrefValue = "";
			$this->catatan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// singbagian
			$this->singbagian->EditAttrs["class"] = "form-control";
			$this->singbagian->EditCustomAttributes = "";
			$curVal = trim(strval($this->singbagian->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->singbagian->AdvancedSearch->ViewValue = $this->singbagian->lookupCacheOption($curVal);
			else
				$this->singbagian->AdvancedSearch->ViewValue = $this->singbagian->Lookup !== NULL && is_array($this->singbagian->Lookup->Options) ? $curVal : NULL;
			if ($this->singbagian->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->singbagian->EditValue = array_values($this->singbagian->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`singkatan`" . SearchString("=", $this->singbagian->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->singbagian->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->singbagian->EditValue = $arwrk;
			}

			// jpel
			$this->jpel->EditAttrs["class"] = "form-control";
			$this->jpel->EditCustomAttributes = "";
			$this->jpel->EditValue = $this->jpel->options(TRUE);

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if (!$this->kdjudul->Raw)
				$this->kdjudul->AdvancedSearch->SearchValue = HtmlDecode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

			// kdkursil
			$this->kdkursil->EditAttrs["class"] = "form-control";
			$this->kdkursil->EditCustomAttributes = "";
			if (!$this->kdkursil->Raw)
				$this->kdkursil->AdvancedSearch->SearchValue = HtmlDecode($this->kdkursil->AdvancedSearch->SearchValue);
			$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->AdvancedSearch->SearchValue);
			$this->kdkursil->PlaceHolder = RemoveHtml($this->kdkursil->caption());

			// revisi
			$this->revisi->EditAttrs["class"] = "form-control";
			$this->revisi->EditCustomAttributes = "";
			if (!$this->revisi->Raw)
				$this->revisi->AdvancedSearch->SearchValue = HtmlDecode($this->revisi->AdvancedSearch->SearchValue);
			$this->revisi->EditValue = HtmlEncode($this->revisi->AdvancedSearch->SearchValue);
			$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

			// tgl_terbit
			$this->tgl_terbit->EditAttrs["class"] = "form-control";
			$this->tgl_terbit->EditCustomAttributes = "";
			$this->tgl_terbit->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_terbit->AdvancedSearch->SearchValue, 0), 8));
			$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

			// deskripsi_singkat
			$this->deskripsi_singkat->EditAttrs["class"] = "form-control";
			$this->deskripsi_singkat->EditCustomAttributes = "";
			$this->deskripsi_singkat->EditValue = HtmlEncode($this->deskripsi_singkat->AdvancedSearch->SearchValue);
			$this->deskripsi_singkat->PlaceHolder = RemoveHtml($this->deskripsi_singkat->caption());

			// tujuan
			$this->tujuan->EditAttrs["class"] = "form-control";
			$this->tujuan->EditCustomAttributes = "";
			$this->tujuan->EditValue = HtmlEncode($this->tujuan->AdvancedSearch->SearchValue);
			$this->tujuan->PlaceHolder = RemoveHtml($this->tujuan->caption());

			// target_peserta
			$this->target_peserta->EditAttrs["class"] = "form-control";
			$this->target_peserta->EditCustomAttributes = "";
			$this->target_peserta->EditValue = HtmlEncode($this->target_peserta->AdvancedSearch->SearchValue);
			$this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

			// lama_pelatihan
			$this->lama_pelatihan->EditAttrs["class"] = "form-control";
			$this->lama_pelatihan->EditCustomAttributes = "";

			// catatan
			$this->catatan->EditAttrs["class"] = "form-control";
			$this->catatan->EditCustomAttributes = "";
			$this->catatan->EditValue = HtmlEncode($this->catatan->AdvancedSearch->SearchValue);
			$this->catatan->PlaceHolder = RemoveHtml($this->catatan->caption());
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
		$this->detailjdid->AdvancedSearch->load();
		$this->singbagian->AdvancedSearch->load();
		$this->jpel->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->kdkursil->AdvancedSearch->load();
		$this->revisi->AdvancedSearch->load();
		$this->tgl_terbit->AdvancedSearch->load();
		$this->deskripsi_singkat->AdvancedSearch->load();
		$this->target_peserta->AdvancedSearch->load();
		$this->lama_pelatihan->AdvancedSearch->load();
		$this->catatan->AdvancedSearch->load();
		$this->created_by->AdvancedSearch->load();
		$this->created_at->AdvancedSearch->load();
		$this->updated_by->AdvancedSearch->load();
		$this->updated_at->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ft_juduldetaillist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ft_juduldetaillist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ft_juduldetaillist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_t_juduldetail" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_t_juduldetail\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ft_juduldetaillist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft_juduldetaillistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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

		// Export master record
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_judul") {
			global $t_judul;
			if (!isset($t_judul))
				$t_judul = new t_judul();
			$rsmaster = $t_judul->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("v"); // Change to vertical
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$t_judul;
					$t_judul->exportDocument($doc, $rsmaster);
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
			if ($masterTblVar == "t_judul") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdjudul", Get("kdjudul"))) !== NULL) {
					$GLOBALS["t_judul"]->kdjudul->setQueryStringValue($parm);
					$this->kdjudul->setQueryStringValue($GLOBALS["t_judul"]->kdjudul->QueryStringValue);
					$this->kdjudul->setSessionValue($this->kdjudul->QueryStringValue);
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
			if ($masterTblVar == "t_judul") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdjudul", Post("kdjudul"))) !== NULL) {
					$GLOBALS["t_judul"]->kdjudul->setFormValue($parm);
					$this->kdjudul->setFormValue($GLOBALS["t_judul"]->kdjudul->FormValue);
					$this->kdjudul->setSessionValue($this->kdjudul->FormValue);
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
			if ($masterTblVar != "t_judul") {
				if ($this->kdjudul->CurrentValue == "")
					$this->kdjudul->setSessionValue("");
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
				case "x_singbagian":
					break;
				case "x_jpel":
					break;
				case "x_kdjudul":
					break;
				case "x_lama_pelatihan":
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
						case "x_singbagian":
							break;
						case "x_kdjudul":
							break;
						case "x_lama_pelatihan":
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
		$GLOBALS["ExportFileName"] = "Judul_Detail-PPE".CurrentDate();
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

		if (isset($_GET[Config("TABLE_SHOW_MASTER")]) <> "") {
			$this->kdjudul->Visible = FALSE;
			$this->deskripsi_singkat->TooltipValue = "";
			$this->target_peserta->TooltipValue = "";
		}
			if(CurrentUserLevel() == 1){ //user manajemen
					$this->singbagian->Visible = FALSE;
					$this->jpel->Visible = FALSE;
					$this->revisi->Visible = FALSE;
					$this->tgl_terbit->Visible = FALSE;
					$this->deskripsi_singkat->Visible = FALSE;
					$this->tujuan->Visible = FALSE;
					$this->target_peserta->Visible = FALSE;
					$this->catatan->Visible = FALSE;
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

	/*
		$opt = &$this->ListOptions->Add("rev");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(0); // Move to first column
	*/
		$this->ListOptions->Items["view"]->Visible = FALSE;
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
		//$this->ListOptions->Items["rev"]->Body = "<a href=\"#\" onclick=\"return ew.submitAction(event, {action: 'buatrevisi', method: 'ajax', msg: 'Apakah Anda yakin ingin membuat revisi?', key: " . $this->KeyToJson(TRUE) . "});\" class=\"btn btn-info ew-row-link ew-detail\">Buat Revisi</a>";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		if ($action == "buatrevisi") { // Check action name
				$newrev = ExecuteScalar("SELECT revisi+1 FROM t_juduldetail WHERE detailjdid = ".$row["detailjdid"]." ORDER BY revisi DESC");
				$result = Execute("INSERT INTO `t_juduldetail`(`detailjdid`, `singbagian`, `jpel`, `kdjudul`, `kdkursil`, `revisi`, `tgl_terbit`, `deskripsi_singkat`, `tujuan`, `target_peserta`, `lama_pelatihan`, `catatan`, `created_by`, `created_at`, `updated_by`, `updated_at`) SELECT NULL `detailjdid`, `singbagian`, `jpel`, `kdjudul`, `kdkursil`, ".$newrev." `revisi`, `tgl_terbit`, `deskripsi_singkat`, `tujuan`, `target_peserta`, `lama_pelatihan`, `catatan`, '".CurrentUserName()."' `created_by`, '".CurrentDateTime()."' `created_at`, NULL `updated_by`, NULL `updated_at` FROM `t_juduldetail` WHERE `detailjdid` = ".$row["detailjdid"]);

				//$rs = Execute("SELECT detailjdid FROM t_juduldetail WHERE kdpelat = '".$row["kdpelat"]."' ORDER BY detailjdid DESC LIMIT 1"); 
				$rs = Execute("SELECT kurikulumid FROM t_kurikulum WHERE kdkursil = '".$row["kdkursil"]."' AND revisi = '".$row["revisi"]."'");
				if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
					$rs->MoveFirst(); // mulai dari record pertama
					while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset
						$detailtabel = Execute("INSERT INTO `t_kurikulum`(`kurikulumid`, `singbagian`, `jpel`, `kdjudul`, `lama_pelatihan`, `kdkursil`, `revisi`, `hari`, `kurikulum`, `silabus`, `tujuan_instruksional`, `sesi`, `created_by`, `created_at`, `updated_by`, `updated_at`) SELECT NULL `kurikulumid`, `singbagian`, `jpel`, `kdjudul`, `lama_pelatihan`, `kdkursil`, ".$newrev." `revisi`, `hari`, `kurikulum`, `silabus`, `tujuan_instruksional`, `sesi`, '".CurrentUserName()."' `created_by`, '".CurrentDateTime()."' `created_at`, NULL `updated_by`, NULL `updated_at` FROM `t_kurikulum` WHERE kurikulumid = ".$rs->fields("kurikulumid"));
					$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
					} // akhirdataku loop
				$rs->Close();
				}
				if ($this->SelectedIndex == $this->SelectedCount) { // Last row
						$getlastid = ExecuteScalar("SELECT kurikulumid FROM t_kurikulum WHERE kdjudul = '".$row["kdjudul"]."' ORDER BY kurikulumid DESC LIMIT 1");

						//header('location: t_juduldetailedit.php?showdetail=t_kurikulum&detailjdid='.$getlastid);
				}
				return TRUE;
		}     
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