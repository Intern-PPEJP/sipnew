<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_coachingtahapan_grid extends t_coachingtahapan
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_coachingtahapan';

	// Page object name
	public $PageObjName = "t_coachingtahapan_grid";

	// Grid form hidden field names
	public $FormName = "ft_coachingtahapangrid";
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
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (t_coachingtahapan)
		if (!isset($GLOBALS["t_coachingtahapan"]) || get_class($GLOBALS["t_coachingtahapan"]) == PROJECT_NAMESPACE . "t_coachingtahapan") {
			$GLOBALS["t_coachingtahapan"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["t_coachingtahapan"];

		}
		$this->AddUrl = "t_coachingtahapanadd.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_coachingtahapan');

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

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Export
		global $t_coachingtahapan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_coachingtahapan);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

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
			$key .= @$ar['ctid'];
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
			$this->ctid->Visible = FALSE;
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
	public $ShowOtherOptions = FALSE;
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

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->ctid->Visible = FALSE;
		$this->rkid->Visible = FALSE;
		$this->area->setVisibility();
		$this->jenispel->setVisibility();
		$this->kdkategori->setVisibility();
		$this->kerjasama->setVisibility();
		$this->tglpelak1->setVisibility();
		$this->targetpes1->setVisibility();
		$this->tglpelak2->setVisibility();
		$this->targetpes2->setVisibility();
		$this->tglpelak3->setVisibility();
		$this->targetpes3->setVisibility();
		$this->tglpelak4->setVisibility();
		$this->targetpes4->setVisibility();
		$this->tglpelak5->setVisibility();
		$this->targetpes5->setVisibility();
		$this->tglpelak6->setVisibility();
		$this->targetpes6->setVisibility();
		$this->tglpelak7->setVisibility();
		$this->targetpes7->setVisibility();
		$this->tglpelak8->setVisibility();
		$this->targetpes8->setVisibility();
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

		// Set up lookup cache
		$this->setupLookupOptions($this->area);
		$this->setupLookupOptions($this->kdkategori);
		$this->setupLookupOptions($this->kerjasama);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

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

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_rkcoaching") {
			global $t_rkcoaching;
			$rsmaster = $t_rkcoaching->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("t_rkcoachinglist.php"); // Return to master page
			} else {
				$t_rkcoaching->loadListRowValues($rsmaster);
				$t_rkcoaching->RowType = ROWTYPE_MASTER; // Master row
				$t_rkcoaching->renderListRow();
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
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecords = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecords = $this->Recordset->RecordCount();
				}
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->TotalRecords;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->GridAddRowCount;
			}
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
			$this->DisplayRecords = $this->TotalRecords; // Display all records
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
		}

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

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
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
			$this->ctid->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ctid->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->ctid->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_area") && $CurrentForm->hasValue("o_area") && $this->area->CurrentValue != $this->area->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jenispel") && $CurrentForm->hasValue("o_jenispel") && $this->jenispel->CurrentValue != $this->jenispel->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdkategori") && $CurrentForm->hasValue("o_kdkategori") && $this->kdkategori->CurrentValue != $this->kdkategori->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kerjasama") && $CurrentForm->hasValue("o_kerjasama") && $this->kerjasama->CurrentValue != $this->kerjasama->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpelak1") && $CurrentForm->hasValue("o_tglpelak1") && $this->tglpelak1->CurrentValue != $this->tglpelak1->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes1") && $CurrentForm->hasValue("o_targetpes1") && $this->targetpes1->CurrentValue != $this->targetpes1->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpelak2") && $CurrentForm->hasValue("o_tglpelak2") && $this->tglpelak2->CurrentValue != $this->tglpelak2->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes2") && $CurrentForm->hasValue("o_targetpes2") && $this->targetpes2->CurrentValue != $this->targetpes2->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpelak3") && $CurrentForm->hasValue("o_tglpelak3") && $this->tglpelak3->CurrentValue != $this->tglpelak3->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes3") && $CurrentForm->hasValue("o_targetpes3") && $this->targetpes3->CurrentValue != $this->targetpes3->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpelak4") && $CurrentForm->hasValue("o_tglpelak4") && $this->tglpelak4->CurrentValue != $this->tglpelak4->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes4") && $CurrentForm->hasValue("o_targetpes4") && $this->targetpes4->CurrentValue != $this->targetpes4->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpelak5") && $CurrentForm->hasValue("o_tglpelak5") && $this->tglpelak5->CurrentValue != $this->tglpelak5->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes5") && $CurrentForm->hasValue("o_targetpes5") && $this->targetpes5->CurrentValue != $this->targetpes5->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpelak6") && $CurrentForm->hasValue("o_tglpelak6") && $this->tglpelak6->CurrentValue != $this->tglpelak6->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes6") && $CurrentForm->hasValue("o_targetpes6") && $this->targetpes6->CurrentValue != $this->targetpes6->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpelak7") && $CurrentForm->hasValue("o_tglpelak7") && $this->tglpelak7->CurrentValue != $this->tglpelak7->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes7") && $CurrentForm->hasValue("o_targetpes7") && $this->targetpes7->CurrentValue != $this->targetpes7->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpelak8") && $CurrentForm->hasValue("o_tglpelak8") && $this->tglpelak8->CurrentValue != $this->tglpelak8->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes8") && $CurrentForm->hasValue("o_targetpes8") && $this->targetpes8->CurrentValue != $this->targetpes8->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->rkid->setSessionValue("");
				$this->area->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
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

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = FALSE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

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

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$opt = $this->ListOptions["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecordCount);
		if ($this->CurrentMode == "view") { // View mode

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
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ctid->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('ctid');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = $this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		}
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = $options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = $Security->canAdd();
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = $options["addedit"];
			$item = $option["add"];
			$this->ShowOtherOptions = $item && $item->Visible;
		}
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ctid->CurrentValue = NULL;
		$this->ctid->OldValue = $this->ctid->CurrentValue;
		$this->rkid->CurrentValue = NULL;
		$this->rkid->OldValue = $this->rkid->CurrentValue;
		$this->area->CurrentValue = NULL;
		$this->area->OldValue = $this->area->CurrentValue;
		$this->jenispel->CurrentValue = NULL;
		$this->jenispel->OldValue = $this->jenispel->CurrentValue;
		$this->kdkategori->CurrentValue = NULL;
		$this->kdkategori->OldValue = $this->kdkategori->CurrentValue;
		$this->kerjasama->CurrentValue = NULL;
		$this->kerjasama->OldValue = $this->kerjasama->CurrentValue;
		$this->tglpelak1->CurrentValue = NULL;
		$this->tglpelak1->OldValue = $this->tglpelak1->CurrentValue;
		$this->targetpes1->CurrentValue = NULL;
		$this->targetpes1->OldValue = $this->targetpes1->CurrentValue;
		$this->tglpelak2->CurrentValue = NULL;
		$this->tglpelak2->OldValue = $this->tglpelak2->CurrentValue;
		$this->targetpes2->CurrentValue = NULL;
		$this->targetpes2->OldValue = $this->targetpes2->CurrentValue;
		$this->tglpelak3->CurrentValue = NULL;
		$this->tglpelak3->OldValue = $this->tglpelak3->CurrentValue;
		$this->targetpes3->CurrentValue = NULL;
		$this->targetpes3->OldValue = $this->targetpes3->CurrentValue;
		$this->tglpelak4->CurrentValue = NULL;
		$this->tglpelak4->OldValue = $this->tglpelak4->CurrentValue;
		$this->targetpes4->CurrentValue = NULL;
		$this->targetpes4->OldValue = $this->targetpes4->CurrentValue;
		$this->tglpelak5->CurrentValue = NULL;
		$this->tglpelak5->OldValue = $this->tglpelak5->CurrentValue;
		$this->targetpes5->CurrentValue = NULL;
		$this->targetpes5->OldValue = $this->targetpes5->CurrentValue;
		$this->tglpelak6->CurrentValue = NULL;
		$this->tglpelak6->OldValue = $this->tglpelak6->CurrentValue;
		$this->targetpes6->CurrentValue = NULL;
		$this->targetpes6->OldValue = $this->targetpes6->CurrentValue;
		$this->tglpelak7->CurrentValue = NULL;
		$this->tglpelak7->OldValue = $this->tglpelak7->CurrentValue;
		$this->targetpes7->CurrentValue = NULL;
		$this->targetpes7->OldValue = $this->targetpes7->CurrentValue;
		$this->tglpelak8->CurrentValue = NULL;
		$this->tglpelak8->OldValue = $this->tglpelak8->CurrentValue;
		$this->targetpes8->CurrentValue = NULL;
		$this->targetpes8->OldValue = $this->targetpes8->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'area' first before field var 'x_area'
		$val = $CurrentForm->hasValue("area") ? $CurrentForm->getValue("area") : $CurrentForm->getValue("x_area");
		if (!$this->area->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->area->Visible = FALSE; // Disable update for API request
			else
				$this->area->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_area"))
			$this->area->setOldValue($CurrentForm->getValue("o_area"));

		// Check field name 'jenispel' first before field var 'x_jenispel'
		$val = $CurrentForm->hasValue("jenispel") ? $CurrentForm->getValue("jenispel") : $CurrentForm->getValue("x_jenispel");
		if (!$this->jenispel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenispel->Visible = FALSE; // Disable update for API request
			else
				$this->jenispel->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jenispel"))
			$this->jenispel->setOldValue($CurrentForm->getValue("o_jenispel"));

		// Check field name 'kdkategori' first before field var 'x_kdkategori'
		$val = $CurrentForm->hasValue("kdkategori") ? $CurrentForm->getValue("kdkategori") : $CurrentForm->getValue("x_kdkategori");
		if (!$this->kdkategori->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkategori->Visible = FALSE; // Disable update for API request
			else
				$this->kdkategori->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdkategori"))
			$this->kdkategori->setOldValue($CurrentForm->getValue("o_kdkategori"));

		// Check field name 'kerjasama' first before field var 'x_kerjasama'
		$val = $CurrentForm->hasValue("kerjasama") ? $CurrentForm->getValue("kerjasama") : $CurrentForm->getValue("x_kerjasama");
		if (!$this->kerjasama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kerjasama->Visible = FALSE; // Disable update for API request
			else
				$this->kerjasama->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kerjasama"))
			$this->kerjasama->setOldValue($CurrentForm->getValue("o_kerjasama"));

		// Check field name 'tglpelak1' first before field var 'x_tglpelak1'
		$val = $CurrentForm->hasValue("tglpelak1") ? $CurrentForm->getValue("tglpelak1") : $CurrentForm->getValue("x_tglpelak1");
		if (!$this->tglpelak1->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak1->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak1->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpelak1"))
			$this->tglpelak1->setOldValue($CurrentForm->getValue("o_tglpelak1"));

		// Check field name 'targetpes1' first before field var 'x_targetpes1'
		$val = $CurrentForm->hasValue("targetpes1") ? $CurrentForm->getValue("targetpes1") : $CurrentForm->getValue("x_targetpes1");
		if (!$this->targetpes1->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes1->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes1->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes1"))
			$this->targetpes1->setOldValue($CurrentForm->getValue("o_targetpes1"));

		// Check field name 'tglpelak2' first before field var 'x_tglpelak2'
		$val = $CurrentForm->hasValue("tglpelak2") ? $CurrentForm->getValue("tglpelak2") : $CurrentForm->getValue("x_tglpelak2");
		if (!$this->tglpelak2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak2->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak2->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpelak2"))
			$this->tglpelak2->setOldValue($CurrentForm->getValue("o_tglpelak2"));

		// Check field name 'targetpes2' first before field var 'x_targetpes2'
		$val = $CurrentForm->hasValue("targetpes2") ? $CurrentForm->getValue("targetpes2") : $CurrentForm->getValue("x_targetpes2");
		if (!$this->targetpes2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes2->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes2->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes2"))
			$this->targetpes2->setOldValue($CurrentForm->getValue("o_targetpes2"));

		// Check field name 'tglpelak3' first before field var 'x_tglpelak3'
		$val = $CurrentForm->hasValue("tglpelak3") ? $CurrentForm->getValue("tglpelak3") : $CurrentForm->getValue("x_tglpelak3");
		if (!$this->tglpelak3->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak3->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak3->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpelak3"))
			$this->tglpelak3->setOldValue($CurrentForm->getValue("o_tglpelak3"));

		// Check field name 'targetpes3' first before field var 'x_targetpes3'
		$val = $CurrentForm->hasValue("targetpes3") ? $CurrentForm->getValue("targetpes3") : $CurrentForm->getValue("x_targetpes3");
		if (!$this->targetpes3->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes3->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes3->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes3"))
			$this->targetpes3->setOldValue($CurrentForm->getValue("o_targetpes3"));

		// Check field name 'tglpelak4' first before field var 'x_tglpelak4'
		$val = $CurrentForm->hasValue("tglpelak4") ? $CurrentForm->getValue("tglpelak4") : $CurrentForm->getValue("x_tglpelak4");
		if (!$this->tglpelak4->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak4->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak4->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpelak4"))
			$this->tglpelak4->setOldValue($CurrentForm->getValue("o_tglpelak4"));

		// Check field name 'targetpes4' first before field var 'x_targetpes4'
		$val = $CurrentForm->hasValue("targetpes4") ? $CurrentForm->getValue("targetpes4") : $CurrentForm->getValue("x_targetpes4");
		if (!$this->targetpes4->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes4->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes4->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes4"))
			$this->targetpes4->setOldValue($CurrentForm->getValue("o_targetpes4"));

		// Check field name 'tglpelak5' first before field var 'x_tglpelak5'
		$val = $CurrentForm->hasValue("tglpelak5") ? $CurrentForm->getValue("tglpelak5") : $CurrentForm->getValue("x_tglpelak5");
		if (!$this->tglpelak5->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak5->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak5->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpelak5"))
			$this->tglpelak5->setOldValue($CurrentForm->getValue("o_tglpelak5"));

		// Check field name 'targetpes5' first before field var 'x_targetpes5'
		$val = $CurrentForm->hasValue("targetpes5") ? $CurrentForm->getValue("targetpes5") : $CurrentForm->getValue("x_targetpes5");
		if (!$this->targetpes5->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes5->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes5->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes5"))
			$this->targetpes5->setOldValue($CurrentForm->getValue("o_targetpes5"));

		// Check field name 'tglpelak6' first before field var 'x_tglpelak6'
		$val = $CurrentForm->hasValue("tglpelak6") ? $CurrentForm->getValue("tglpelak6") : $CurrentForm->getValue("x_tglpelak6");
		if (!$this->tglpelak6->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak6->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak6->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpelak6"))
			$this->tglpelak6->setOldValue($CurrentForm->getValue("o_tglpelak6"));

		// Check field name 'targetpes6' first before field var 'x_targetpes6'
		$val = $CurrentForm->hasValue("targetpes6") ? $CurrentForm->getValue("targetpes6") : $CurrentForm->getValue("x_targetpes6");
		if (!$this->targetpes6->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes6->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes6->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes6"))
			$this->targetpes6->setOldValue($CurrentForm->getValue("o_targetpes6"));

		// Check field name 'tglpelak7' first before field var 'x_tglpelak7'
		$val = $CurrentForm->hasValue("tglpelak7") ? $CurrentForm->getValue("tglpelak7") : $CurrentForm->getValue("x_tglpelak7");
		if (!$this->tglpelak7->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak7->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak7->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpelak7"))
			$this->tglpelak7->setOldValue($CurrentForm->getValue("o_tglpelak7"));

		// Check field name 'targetpes7' first before field var 'x_targetpes7'
		$val = $CurrentForm->hasValue("targetpes7") ? $CurrentForm->getValue("targetpes7") : $CurrentForm->getValue("x_targetpes7");
		if (!$this->targetpes7->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes7->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes7->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes7"))
			$this->targetpes7->setOldValue($CurrentForm->getValue("o_targetpes7"));

		// Check field name 'tglpelak8' first before field var 'x_tglpelak8'
		$val = $CurrentForm->hasValue("tglpelak8") ? $CurrentForm->getValue("tglpelak8") : $CurrentForm->getValue("x_tglpelak8");
		if (!$this->tglpelak8->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak8->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak8->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpelak8"))
			$this->tglpelak8->setOldValue($CurrentForm->getValue("o_tglpelak8"));

		// Check field name 'targetpes8' first before field var 'x_targetpes8'
		$val = $CurrentForm->hasValue("targetpes8") ? $CurrentForm->getValue("targetpes8") : $CurrentForm->getValue("x_targetpes8");
		if (!$this->targetpes8->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes8->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes8->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes8"))
			$this->targetpes8->setOldValue($CurrentForm->getValue("o_targetpes8"));

		// Check field name 'ctid' first before field var 'x_ctid'
		$val = $CurrentForm->hasValue("ctid") ? $CurrentForm->getValue("ctid") : $CurrentForm->getValue("x_ctid");
		if (!$this->ctid->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->ctid->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->ctid->CurrentValue = $this->ctid->FormValue;
		$this->area->CurrentValue = $this->area->FormValue;
		$this->jenispel->CurrentValue = $this->jenispel->FormValue;
		$this->kdkategori->CurrentValue = $this->kdkategori->FormValue;
		$this->kerjasama->CurrentValue = $this->kerjasama->FormValue;
		$this->tglpelak1->CurrentValue = $this->tglpelak1->FormValue;
		$this->targetpes1->CurrentValue = $this->targetpes1->FormValue;
		$this->tglpelak2->CurrentValue = $this->tglpelak2->FormValue;
		$this->targetpes2->CurrentValue = $this->targetpes2->FormValue;
		$this->tglpelak3->CurrentValue = $this->tglpelak3->FormValue;
		$this->targetpes3->CurrentValue = $this->targetpes3->FormValue;
		$this->tglpelak4->CurrentValue = $this->tglpelak4->FormValue;
		$this->targetpes4->CurrentValue = $this->targetpes4->FormValue;
		$this->tglpelak5->CurrentValue = $this->tglpelak5->FormValue;
		$this->targetpes5->CurrentValue = $this->targetpes5->FormValue;
		$this->tglpelak6->CurrentValue = $this->tglpelak6->FormValue;
		$this->targetpes6->CurrentValue = $this->targetpes6->FormValue;
		$this->tglpelak7->CurrentValue = $this->tglpelak7->FormValue;
		$this->targetpes7->CurrentValue = $this->targetpes7->FormValue;
		$this->tglpelak8->CurrentValue = $this->tglpelak8->FormValue;
		$this->targetpes8->CurrentValue = $this->targetpes8->FormValue;
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
		$this->ctid->setDbValue($row['ctid']);
		$this->rkid->setDbValue($row['rkid']);
		$this->area->setDbValue($row['area']);
		if (array_key_exists('EV__area', $rs->fields)) {
			$this->area->VirtualValue = $rs->fields('EV__area'); // Set up virtual field value
		} else {
			$this->area->VirtualValue = ""; // Clear value
		}
		$this->jenispel->setDbValue($row['jenispel']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->kerjasama->setDbValue($row['kerjasama']);
		$this->tglpelak1->setDbValue($row['tglpelak1']);
		$this->targetpes1->setDbValue($row['targetpes1']);
		$this->tglpelak2->setDbValue($row['tglpelak2']);
		$this->targetpes2->setDbValue($row['targetpes2']);
		$this->tglpelak3->setDbValue($row['tglpelak3']);
		$this->targetpes3->setDbValue($row['targetpes3']);
		$this->tglpelak4->setDbValue($row['tglpelak4']);
		$this->targetpes4->setDbValue($row['targetpes4']);
		$this->tglpelak5->setDbValue($row['tglpelak5']);
		$this->targetpes5->setDbValue($row['targetpes5']);
		$this->tglpelak6->setDbValue($row['tglpelak6']);
		$this->targetpes6->setDbValue($row['targetpes6']);
		$this->tglpelak7->setDbValue($row['tglpelak7']);
		$this->targetpes7->setDbValue($row['targetpes7']);
		$this->tglpelak8->setDbValue($row['tglpelak8']);
		$this->targetpes8->setDbValue($row['targetpes8']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ctid'] = $this->ctid->CurrentValue;
		$row['rkid'] = $this->rkid->CurrentValue;
		$row['area'] = $this->area->CurrentValue;
		$row['jenispel'] = $this->jenispel->CurrentValue;
		$row['kdkategori'] = $this->kdkategori->CurrentValue;
		$row['kerjasama'] = $this->kerjasama->CurrentValue;
		$row['tglpelak1'] = $this->tglpelak1->CurrentValue;
		$row['targetpes1'] = $this->targetpes1->CurrentValue;
		$row['tglpelak2'] = $this->tglpelak2->CurrentValue;
		$row['targetpes2'] = $this->targetpes2->CurrentValue;
		$row['tglpelak3'] = $this->tglpelak3->CurrentValue;
		$row['targetpes3'] = $this->targetpes3->CurrentValue;
		$row['tglpelak4'] = $this->tglpelak4->CurrentValue;
		$row['targetpes4'] = $this->targetpes4->CurrentValue;
		$row['tglpelak5'] = $this->tglpelak5->CurrentValue;
		$row['targetpes5'] = $this->targetpes5->CurrentValue;
		$row['tglpelak6'] = $this->tglpelak6->CurrentValue;
		$row['targetpes6'] = $this->targetpes6->CurrentValue;
		$row['tglpelak7'] = $this->tglpelak7->CurrentValue;
		$row['targetpes7'] = $this->targetpes7->CurrentValue;
		$row['tglpelak8'] = $this->tglpelak8->CurrentValue;
		$row['targetpes8'] = $this->targetpes8->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = [$this->RowOldKey];
		$cnt = count($keys);
		if ($cnt >= 1) {
			if (strval($keys[0]) != "")
				$this->ctid->OldValue = strval($keys[0]); // ctid
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

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
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ctid
		// rkid
		// area
		// jenispel
		// kdkategori
		// kerjasama
		// tglpelak1
		// targetpes1
		// tglpelak2
		// targetpes2
		// tglpelak3
		// targetpes3
		// tglpelak4
		// targetpes4
		// tglpelak5
		// targetpes5
		// tglpelak6
		// targetpes6
		// tglpelak7
		// targetpes7
		// tglpelak8
		// targetpes8

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// area
			if ($this->area->VirtualValue != "") {
				$this->area->ViewValue = $this->area->VirtualValue;
			} else {
				$curVal = strval($this->area->CurrentValue);
				if ($curVal != "") {
					$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
					if ($this->area->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->area->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->area->ViewValue = $this->area->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->area->ViewValue = $this->area->CurrentValue;
						}
					}
				} else {
					$this->area->ViewValue = NULL;
				}
			}
			$this->area->ViewCustomAttributes = "";

			// jenispel
			if (strval($this->jenispel->CurrentValue) != "") {
				$this->jenispel->ViewValue = $this->jenispel->optionCaption($this->jenispel->CurrentValue);
			} else {
				$this->jenispel->ViewValue = NULL;
			}
			$this->jenispel->ViewCustomAttributes = "";

			// kdkategori
			$curVal = strval($this->kdkategori->CurrentValue);
			if ($curVal != "") {
				$this->kdkategori->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
				if ($this->kdkategori->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdkategori`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdkategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdkategori->ViewValue = $this->kdkategori->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdkategori->ViewValue = $this->kdkategori->CurrentValue;
					}
				}
			} else {
				$this->kdkategori->ViewValue = NULL;
			}
			$this->kdkategori->ViewCustomAttributes = "";

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

			// tglpelak1
			$this->tglpelak1->ViewValue = $this->tglpelak1->CurrentValue;
			$this->tglpelak1->ViewCustomAttributes = "";

			// targetpes1
			$this->targetpes1->ViewValue = $this->targetpes1->CurrentValue;
			$this->targetpes1->ViewCustomAttributes = "";

			// tglpelak2
			$this->tglpelak2->ViewValue = $this->tglpelak2->CurrentValue;
			$this->tglpelak2->ViewCustomAttributes = "";

			// targetpes2
			$this->targetpes2->ViewValue = $this->targetpes2->CurrentValue;
			$this->targetpes2->ViewCustomAttributes = "";

			// tglpelak3
			$this->tglpelak3->ViewValue = $this->tglpelak3->CurrentValue;
			$this->tglpelak3->ViewCustomAttributes = "";

			// targetpes3
			$this->targetpes3->ViewValue = $this->targetpes3->CurrentValue;
			$this->targetpes3->ViewCustomAttributes = "";

			// tglpelak4
			$this->tglpelak4->ViewValue = $this->tglpelak4->CurrentValue;
			$this->tglpelak4->ViewCustomAttributes = "";

			// targetpes4
			$this->targetpes4->ViewValue = $this->targetpes4->CurrentValue;
			$this->targetpes4->ViewCustomAttributes = "";

			// tglpelak5
			$this->tglpelak5->ViewValue = $this->tglpelak5->CurrentValue;
			$this->tglpelak5->ViewCustomAttributes = "";

			// targetpes5
			$this->targetpes5->ViewValue = $this->targetpes5->CurrentValue;
			$this->targetpes5->ViewCustomAttributes = "";

			// tglpelak6
			$this->tglpelak6->ViewValue = $this->tglpelak6->CurrentValue;
			$this->tglpelak6->ViewCustomAttributes = "";

			// targetpes6
			$this->targetpes6->ViewValue = $this->targetpes6->CurrentValue;
			$this->targetpes6->ViewCustomAttributes = "";

			// tglpelak7
			$this->tglpelak7->ViewValue = $this->tglpelak7->CurrentValue;
			$this->tglpelak7->ViewCustomAttributes = "";

			// targetpes7
			$this->targetpes7->ViewValue = $this->targetpes7->CurrentValue;
			$this->targetpes7->ViewCustomAttributes = "";

			// tglpelak8
			$this->tglpelak8->ViewValue = $this->tglpelak8->CurrentValue;
			$this->tglpelak8->ViewCustomAttributes = "";

			// targetpes8
			$this->targetpes8->ViewValue = $this->targetpes8->CurrentValue;
			$this->targetpes8->ViewCustomAttributes = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";
			$this->area->TooltipValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";
			$this->jenispel->TooltipValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";
			$this->kdkategori->TooltipValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";
			$this->kerjasama->TooltipValue = "";

			// tglpelak1
			$this->tglpelak1->LinkCustomAttributes = "";
			$this->tglpelak1->HrefValue = "";
			$this->tglpelak1->TooltipValue = "";

			// targetpes1
			$this->targetpes1->LinkCustomAttributes = "";
			$this->targetpes1->HrefValue = "";
			$this->targetpes1->TooltipValue = "";

			// tglpelak2
			$this->tglpelak2->LinkCustomAttributes = "";
			$this->tglpelak2->HrefValue = "";
			$this->tglpelak2->TooltipValue = "";

			// targetpes2
			$this->targetpes2->LinkCustomAttributes = "";
			$this->targetpes2->HrefValue = "";
			$this->targetpes2->TooltipValue = "";

			// tglpelak3
			$this->tglpelak3->LinkCustomAttributes = "";
			$this->tglpelak3->HrefValue = "";
			$this->tglpelak3->TooltipValue = "";

			// targetpes3
			$this->targetpes3->LinkCustomAttributes = "";
			$this->targetpes3->HrefValue = "";
			$this->targetpes3->TooltipValue = "";

			// tglpelak4
			$this->tglpelak4->LinkCustomAttributes = "";
			$this->tglpelak4->HrefValue = "";
			$this->tglpelak4->TooltipValue = "";

			// targetpes4
			$this->targetpes4->LinkCustomAttributes = "";
			$this->targetpes4->HrefValue = "";
			$this->targetpes4->TooltipValue = "";

			// tglpelak5
			$this->tglpelak5->LinkCustomAttributes = "";
			$this->tglpelak5->HrefValue = "";
			$this->tglpelak5->TooltipValue = "";

			// targetpes5
			$this->targetpes5->LinkCustomAttributes = "";
			$this->targetpes5->HrefValue = "";
			$this->targetpes5->TooltipValue = "";

			// tglpelak6
			$this->tglpelak6->LinkCustomAttributes = "";
			$this->tglpelak6->HrefValue = "";
			$this->tglpelak6->TooltipValue = "";

			// targetpes6
			$this->targetpes6->LinkCustomAttributes = "";
			$this->targetpes6->HrefValue = "";
			$this->targetpes6->TooltipValue = "";

			// tglpelak7
			$this->tglpelak7->LinkCustomAttributes = "";
			$this->tglpelak7->HrefValue = "";
			$this->tglpelak7->TooltipValue = "";

			// targetpes7
			$this->targetpes7->LinkCustomAttributes = "";
			$this->targetpes7->HrefValue = "";
			$this->targetpes7->TooltipValue = "";

			// tglpelak8
			$this->tglpelak8->LinkCustomAttributes = "";
			$this->tglpelak8->HrefValue = "";
			$this->tglpelak8->TooltipValue = "";

			// targetpes8
			$this->targetpes8->LinkCustomAttributes = "";
			$this->targetpes8->HrefValue = "";
			$this->targetpes8->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// area
			$this->area->EditAttrs["class"] = "form-control";
			$this->area->EditCustomAttributes = "";
			if ($this->area->getSessionValue() != "") {
				$this->area->CurrentValue = $this->area->getSessionValue();
				$this->area->OldValue = $this->area->CurrentValue;
				if ($this->area->VirtualValue != "") {
					$this->area->ViewValue = $this->area->VirtualValue;
				} else {
					$curVal = strval($this->area->CurrentValue);
					if ($curVal != "") {
						$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
						if ($this->area->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->area->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$arwrk[2] = $rswrk->fields('df2');
								$this->area->ViewValue = $this->area->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->area->ViewValue = $this->area->CurrentValue;
							}
						}
					} else {
						$this->area->ViewValue = NULL;
					}
				}
				$this->area->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->area->CurrentValue));
				if ($curVal != "")
					$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
				else
					$this->area->ViewValue = $this->area->Lookup !== NULL && is_array($this->area->Lookup->Options) ? $curVal : NULL;
				if ($this->area->ViewValue !== NULL) { // Load from cache
					$this->area->EditValue = array_values($this->area->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`areaid`" . SearchString("=", $this->area->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->area->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->area->EditValue = $arwrk;
				}
			}

			// jenispel
			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			$this->jenispel->EditValue = $this->jenispel->options(TRUE);

			// kdkategori
			$this->kdkategori->EditAttrs["class"] = "form-control";
			$this->kdkategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkategori->CurrentValue));
			if ($curVal != "")
				$this->kdkategori->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
			else
				$this->kdkategori->ViewValue = $this->kdkategori->Lookup !== NULL && is_array($this->kdkategori->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkategori->ViewValue !== NULL) { // Load from cache
				$this->kdkategori->EditValue = array_values($this->kdkategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkategori`" . SearchString("=", $this->kdkategori->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkategori->EditValue = $arwrk;
			}

			// kerjasama
			$this->kerjasama->EditAttrs["class"] = "form-control";
			$this->kerjasama->EditCustomAttributes = "";
			$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->CurrentValue);
			$curVal = strval($this->kerjasama->CurrentValue);
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
						$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->CurrentValue);
					}
				}
			} else {
				$this->kerjasama->EditValue = NULL;
			}
			$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

			// tglpelak1
			$this->tglpelak1->EditAttrs["class"] = "form-control";
			$this->tglpelak1->EditCustomAttributes = "";
			if (!$this->tglpelak1->Raw)
				$this->tglpelak1->CurrentValue = HtmlDecode($this->tglpelak1->CurrentValue);
			$this->tglpelak1->EditValue = HtmlEncode($this->tglpelak1->CurrentValue);
			$this->tglpelak1->PlaceHolder = RemoveHtml($this->tglpelak1->caption());

			// targetpes1
			$this->targetpes1->EditAttrs["class"] = "form-control";
			$this->targetpes1->EditCustomAttributes = "";
			$this->targetpes1->EditValue = HtmlEncode($this->targetpes1->CurrentValue);
			$this->targetpes1->PlaceHolder = RemoveHtml($this->targetpes1->caption());

			// tglpelak2
			$this->tglpelak2->EditAttrs["class"] = "form-control";
			$this->tglpelak2->EditCustomAttributes = "";
			if (!$this->tglpelak2->Raw)
				$this->tglpelak2->CurrentValue = HtmlDecode($this->tglpelak2->CurrentValue);
			$this->tglpelak2->EditValue = HtmlEncode($this->tglpelak2->CurrentValue);
			$this->tglpelak2->PlaceHolder = RemoveHtml($this->tglpelak2->caption());

			// targetpes2
			$this->targetpes2->EditAttrs["class"] = "form-control";
			$this->targetpes2->EditCustomAttributes = "";
			$this->targetpes2->EditValue = HtmlEncode($this->targetpes2->CurrentValue);
			$this->targetpes2->PlaceHolder = RemoveHtml($this->targetpes2->caption());

			// tglpelak3
			$this->tglpelak3->EditAttrs["class"] = "form-control";
			$this->tglpelak3->EditCustomAttributes = "";
			if (!$this->tglpelak3->Raw)
				$this->tglpelak3->CurrentValue = HtmlDecode($this->tglpelak3->CurrentValue);
			$this->tglpelak3->EditValue = HtmlEncode($this->tglpelak3->CurrentValue);
			$this->tglpelak3->PlaceHolder = RemoveHtml($this->tglpelak3->caption());

			// targetpes3
			$this->targetpes3->EditAttrs["class"] = "form-control";
			$this->targetpes3->EditCustomAttributes = "";
			$this->targetpes3->EditValue = HtmlEncode($this->targetpes3->CurrentValue);
			$this->targetpes3->PlaceHolder = RemoveHtml($this->targetpes3->caption());

			// tglpelak4
			$this->tglpelak4->EditAttrs["class"] = "form-control";
			$this->tglpelak4->EditCustomAttributes = "";
			if (!$this->tglpelak4->Raw)
				$this->tglpelak4->CurrentValue = HtmlDecode($this->tglpelak4->CurrentValue);
			$this->tglpelak4->EditValue = HtmlEncode($this->tglpelak4->CurrentValue);
			$this->tglpelak4->PlaceHolder = RemoveHtml($this->tglpelak4->caption());

			// targetpes4
			$this->targetpes4->EditAttrs["class"] = "form-control";
			$this->targetpes4->EditCustomAttributes = "";
			$this->targetpes4->EditValue = HtmlEncode($this->targetpes4->CurrentValue);
			$this->targetpes4->PlaceHolder = RemoveHtml($this->targetpes4->caption());

			// tglpelak5
			$this->tglpelak5->EditAttrs["class"] = "form-control";
			$this->tglpelak5->EditCustomAttributes = "";
			if (!$this->tglpelak5->Raw)
				$this->tglpelak5->CurrentValue = HtmlDecode($this->tglpelak5->CurrentValue);
			$this->tglpelak5->EditValue = HtmlEncode($this->tglpelak5->CurrentValue);
			$this->tglpelak5->PlaceHolder = RemoveHtml($this->tglpelak5->caption());

			// targetpes5
			$this->targetpes5->EditAttrs["class"] = "form-control";
			$this->targetpes5->EditCustomAttributes = "";
			$this->targetpes5->EditValue = HtmlEncode($this->targetpes5->CurrentValue);
			$this->targetpes5->PlaceHolder = RemoveHtml($this->targetpes5->caption());

			// tglpelak6
			$this->tglpelak6->EditAttrs["class"] = "form-control";
			$this->tglpelak6->EditCustomAttributes = "";
			if (!$this->tglpelak6->Raw)
				$this->tglpelak6->CurrentValue = HtmlDecode($this->tglpelak6->CurrentValue);
			$this->tglpelak6->EditValue = HtmlEncode($this->tglpelak6->CurrentValue);
			$this->tglpelak6->PlaceHolder = RemoveHtml($this->tglpelak6->caption());

			// targetpes6
			$this->targetpes6->EditAttrs["class"] = "form-control";
			$this->targetpes6->EditCustomAttributes = "";
			$this->targetpes6->EditValue = HtmlEncode($this->targetpes6->CurrentValue);
			$this->targetpes6->PlaceHolder = RemoveHtml($this->targetpes6->caption());

			// tglpelak7
			$this->tglpelak7->EditAttrs["class"] = "form-control";
			$this->tglpelak7->EditCustomAttributes = "";
			if (!$this->tglpelak7->Raw)
				$this->tglpelak7->CurrentValue = HtmlDecode($this->tglpelak7->CurrentValue);
			$this->tglpelak7->EditValue = HtmlEncode($this->tglpelak7->CurrentValue);
			$this->tglpelak7->PlaceHolder = RemoveHtml($this->tglpelak7->caption());

			// targetpes7
			$this->targetpes7->EditAttrs["class"] = "form-control";
			$this->targetpes7->EditCustomAttributes = "";
			$this->targetpes7->EditValue = HtmlEncode($this->targetpes7->CurrentValue);
			$this->targetpes7->PlaceHolder = RemoveHtml($this->targetpes7->caption());

			// tglpelak8
			$this->tglpelak8->EditAttrs["class"] = "form-control";
			$this->tglpelak8->EditCustomAttributes = "";
			if (!$this->tglpelak8->Raw)
				$this->tglpelak8->CurrentValue = HtmlDecode($this->tglpelak8->CurrentValue);
			$this->tglpelak8->EditValue = HtmlEncode($this->tglpelak8->CurrentValue);
			$this->tglpelak8->PlaceHolder = RemoveHtml($this->tglpelak8->caption());

			// targetpes8
			$this->targetpes8->EditAttrs["class"] = "form-control";
			$this->targetpes8->EditCustomAttributes = "";
			$this->targetpes8->EditValue = HtmlEncode($this->targetpes8->CurrentValue);
			$this->targetpes8->PlaceHolder = RemoveHtml($this->targetpes8->caption());

			// Add refer script
			// area

			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// tglpelak1
			$this->tglpelak1->LinkCustomAttributes = "";
			$this->tglpelak1->HrefValue = "";

			// targetpes1
			$this->targetpes1->LinkCustomAttributes = "";
			$this->targetpes1->HrefValue = "";

			// tglpelak2
			$this->tglpelak2->LinkCustomAttributes = "";
			$this->tglpelak2->HrefValue = "";

			// targetpes2
			$this->targetpes2->LinkCustomAttributes = "";
			$this->targetpes2->HrefValue = "";

			// tglpelak3
			$this->tglpelak3->LinkCustomAttributes = "";
			$this->tglpelak3->HrefValue = "";

			// targetpes3
			$this->targetpes3->LinkCustomAttributes = "";
			$this->targetpes3->HrefValue = "";

			// tglpelak4
			$this->tglpelak4->LinkCustomAttributes = "";
			$this->tglpelak4->HrefValue = "";

			// targetpes4
			$this->targetpes4->LinkCustomAttributes = "";
			$this->targetpes4->HrefValue = "";

			// tglpelak5
			$this->tglpelak5->LinkCustomAttributes = "";
			$this->tglpelak5->HrefValue = "";

			// targetpes5
			$this->targetpes5->LinkCustomAttributes = "";
			$this->targetpes5->HrefValue = "";

			// tglpelak6
			$this->tglpelak6->LinkCustomAttributes = "";
			$this->tglpelak6->HrefValue = "";

			// targetpes6
			$this->targetpes6->LinkCustomAttributes = "";
			$this->targetpes6->HrefValue = "";

			// tglpelak7
			$this->tglpelak7->LinkCustomAttributes = "";
			$this->tglpelak7->HrefValue = "";

			// targetpes7
			$this->targetpes7->LinkCustomAttributes = "";
			$this->targetpes7->HrefValue = "";

			// tglpelak8
			$this->tglpelak8->LinkCustomAttributes = "";
			$this->tglpelak8->HrefValue = "";

			// targetpes8
			$this->targetpes8->LinkCustomAttributes = "";
			$this->targetpes8->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// area
			$this->area->EditAttrs["class"] = "form-control";
			$this->area->EditCustomAttributes = "";
			if ($this->area->getSessionValue() != "") {
				$this->area->CurrentValue = $this->area->getSessionValue();
				$this->area->OldValue = $this->area->CurrentValue;
				if ($this->area->VirtualValue != "") {
					$this->area->ViewValue = $this->area->VirtualValue;
				} else {
					$curVal = strval($this->area->CurrentValue);
					if ($curVal != "") {
						$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
						if ($this->area->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->area->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$arwrk[2] = $rswrk->fields('df2');
								$this->area->ViewValue = $this->area->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->area->ViewValue = $this->area->CurrentValue;
							}
						}
					} else {
						$this->area->ViewValue = NULL;
					}
				}
				$this->area->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->area->CurrentValue));
				if ($curVal != "")
					$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
				else
					$this->area->ViewValue = $this->area->Lookup !== NULL && is_array($this->area->Lookup->Options) ? $curVal : NULL;
				if ($this->area->ViewValue !== NULL) { // Load from cache
					$this->area->EditValue = array_values($this->area->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`areaid`" . SearchString("=", $this->area->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->area->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->area->EditValue = $arwrk;
				}
			}

			// jenispel
			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			$this->jenispel->EditValue = $this->jenispel->options(TRUE);

			// kdkategori
			$this->kdkategori->EditAttrs["class"] = "form-control";
			$this->kdkategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkategori->CurrentValue));
			if ($curVal != "")
				$this->kdkategori->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
			else
				$this->kdkategori->ViewValue = $this->kdkategori->Lookup !== NULL && is_array($this->kdkategori->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkategori->ViewValue !== NULL) { // Load from cache
				$this->kdkategori->EditValue = array_values($this->kdkategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkategori`" . SearchString("=", $this->kdkategori->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkategori->EditValue = $arwrk;
			}

			// kerjasama
			$this->kerjasama->EditAttrs["class"] = "form-control";
			$this->kerjasama->EditCustomAttributes = "";
			$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->CurrentValue);
			$curVal = strval($this->kerjasama->CurrentValue);
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
						$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->CurrentValue);
					}
				}
			} else {
				$this->kerjasama->EditValue = NULL;
			}
			$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

			// tglpelak1
			$this->tglpelak1->EditAttrs["class"] = "form-control";
			$this->tglpelak1->EditCustomAttributes = "";
			if (!$this->tglpelak1->Raw)
				$this->tglpelak1->CurrentValue = HtmlDecode($this->tglpelak1->CurrentValue);
			$this->tglpelak1->EditValue = HtmlEncode($this->tglpelak1->CurrentValue);
			$this->tglpelak1->PlaceHolder = RemoveHtml($this->tglpelak1->caption());

			// targetpes1
			$this->targetpes1->EditAttrs["class"] = "form-control";
			$this->targetpes1->EditCustomAttributes = "";
			$this->targetpes1->EditValue = HtmlEncode($this->targetpes1->CurrentValue);
			$this->targetpes1->PlaceHolder = RemoveHtml($this->targetpes1->caption());

			// tglpelak2
			$this->tglpelak2->EditAttrs["class"] = "form-control";
			$this->tglpelak2->EditCustomAttributes = "";
			if (!$this->tglpelak2->Raw)
				$this->tglpelak2->CurrentValue = HtmlDecode($this->tglpelak2->CurrentValue);
			$this->tglpelak2->EditValue = HtmlEncode($this->tglpelak2->CurrentValue);
			$this->tglpelak2->PlaceHolder = RemoveHtml($this->tglpelak2->caption());

			// targetpes2
			$this->targetpes2->EditAttrs["class"] = "form-control";
			$this->targetpes2->EditCustomAttributes = "";
			$this->targetpes2->EditValue = HtmlEncode($this->targetpes2->CurrentValue);
			$this->targetpes2->PlaceHolder = RemoveHtml($this->targetpes2->caption());

			// tglpelak3
			$this->tglpelak3->EditAttrs["class"] = "form-control";
			$this->tglpelak3->EditCustomAttributes = "";
			if (!$this->tglpelak3->Raw)
				$this->tglpelak3->CurrentValue = HtmlDecode($this->tglpelak3->CurrentValue);
			$this->tglpelak3->EditValue = HtmlEncode($this->tglpelak3->CurrentValue);
			$this->tglpelak3->PlaceHolder = RemoveHtml($this->tglpelak3->caption());

			// targetpes3
			$this->targetpes3->EditAttrs["class"] = "form-control";
			$this->targetpes3->EditCustomAttributes = "";
			$this->targetpes3->EditValue = HtmlEncode($this->targetpes3->CurrentValue);
			$this->targetpes3->PlaceHolder = RemoveHtml($this->targetpes3->caption());

			// tglpelak4
			$this->tglpelak4->EditAttrs["class"] = "form-control";
			$this->tglpelak4->EditCustomAttributes = "";
			if (!$this->tglpelak4->Raw)
				$this->tglpelak4->CurrentValue = HtmlDecode($this->tglpelak4->CurrentValue);
			$this->tglpelak4->EditValue = HtmlEncode($this->tglpelak4->CurrentValue);
			$this->tglpelak4->PlaceHolder = RemoveHtml($this->tglpelak4->caption());

			// targetpes4
			$this->targetpes4->EditAttrs["class"] = "form-control";
			$this->targetpes4->EditCustomAttributes = "";
			$this->targetpes4->EditValue = HtmlEncode($this->targetpes4->CurrentValue);
			$this->targetpes4->PlaceHolder = RemoveHtml($this->targetpes4->caption());

			// tglpelak5
			$this->tglpelak5->EditAttrs["class"] = "form-control";
			$this->tglpelak5->EditCustomAttributes = "";
			if (!$this->tglpelak5->Raw)
				$this->tglpelak5->CurrentValue = HtmlDecode($this->tglpelak5->CurrentValue);
			$this->tglpelak5->EditValue = HtmlEncode($this->tglpelak5->CurrentValue);
			$this->tglpelak5->PlaceHolder = RemoveHtml($this->tglpelak5->caption());

			// targetpes5
			$this->targetpes5->EditAttrs["class"] = "form-control";
			$this->targetpes5->EditCustomAttributes = "";
			$this->targetpes5->EditValue = HtmlEncode($this->targetpes5->CurrentValue);
			$this->targetpes5->PlaceHolder = RemoveHtml($this->targetpes5->caption());

			// tglpelak6
			$this->tglpelak6->EditAttrs["class"] = "form-control";
			$this->tglpelak6->EditCustomAttributes = "";
			if (!$this->tglpelak6->Raw)
				$this->tglpelak6->CurrentValue = HtmlDecode($this->tglpelak6->CurrentValue);
			$this->tglpelak6->EditValue = HtmlEncode($this->tglpelak6->CurrentValue);
			$this->tglpelak6->PlaceHolder = RemoveHtml($this->tglpelak6->caption());

			// targetpes6
			$this->targetpes6->EditAttrs["class"] = "form-control";
			$this->targetpes6->EditCustomAttributes = "";
			$this->targetpes6->EditValue = HtmlEncode($this->targetpes6->CurrentValue);
			$this->targetpes6->PlaceHolder = RemoveHtml($this->targetpes6->caption());

			// tglpelak7
			$this->tglpelak7->EditAttrs["class"] = "form-control";
			$this->tglpelak7->EditCustomAttributes = "";
			if (!$this->tglpelak7->Raw)
				$this->tglpelak7->CurrentValue = HtmlDecode($this->tglpelak7->CurrentValue);
			$this->tglpelak7->EditValue = HtmlEncode($this->tglpelak7->CurrentValue);
			$this->tglpelak7->PlaceHolder = RemoveHtml($this->tglpelak7->caption());

			// targetpes7
			$this->targetpes7->EditAttrs["class"] = "form-control";
			$this->targetpes7->EditCustomAttributes = "";
			$this->targetpes7->EditValue = HtmlEncode($this->targetpes7->CurrentValue);
			$this->targetpes7->PlaceHolder = RemoveHtml($this->targetpes7->caption());

			// tglpelak8
			$this->tglpelak8->EditAttrs["class"] = "form-control";
			$this->tglpelak8->EditCustomAttributes = "";
			if (!$this->tglpelak8->Raw)
				$this->tglpelak8->CurrentValue = HtmlDecode($this->tglpelak8->CurrentValue);
			$this->tglpelak8->EditValue = HtmlEncode($this->tglpelak8->CurrentValue);
			$this->tglpelak8->PlaceHolder = RemoveHtml($this->tglpelak8->caption());

			// targetpes8
			$this->targetpes8->EditAttrs["class"] = "form-control";
			$this->targetpes8->EditCustomAttributes = "";
			$this->targetpes8->EditValue = HtmlEncode($this->targetpes8->CurrentValue);
			$this->targetpes8->PlaceHolder = RemoveHtml($this->targetpes8->caption());

			// Edit refer script
			// area

			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// tglpelak1
			$this->tglpelak1->LinkCustomAttributes = "";
			$this->tglpelak1->HrefValue = "";

			// targetpes1
			$this->targetpes1->LinkCustomAttributes = "";
			$this->targetpes1->HrefValue = "";

			// tglpelak2
			$this->tglpelak2->LinkCustomAttributes = "";
			$this->tglpelak2->HrefValue = "";

			// targetpes2
			$this->targetpes2->LinkCustomAttributes = "";
			$this->targetpes2->HrefValue = "";

			// tglpelak3
			$this->tglpelak3->LinkCustomAttributes = "";
			$this->tglpelak3->HrefValue = "";

			// targetpes3
			$this->targetpes3->LinkCustomAttributes = "";
			$this->targetpes3->HrefValue = "";

			// tglpelak4
			$this->tglpelak4->LinkCustomAttributes = "";
			$this->tglpelak4->HrefValue = "";

			// targetpes4
			$this->targetpes4->LinkCustomAttributes = "";
			$this->targetpes4->HrefValue = "";

			// tglpelak5
			$this->tglpelak5->LinkCustomAttributes = "";
			$this->tglpelak5->HrefValue = "";

			// targetpes5
			$this->targetpes5->LinkCustomAttributes = "";
			$this->targetpes5->HrefValue = "";

			// tglpelak6
			$this->tglpelak6->LinkCustomAttributes = "";
			$this->tglpelak6->HrefValue = "";

			// targetpes6
			$this->targetpes6->LinkCustomAttributes = "";
			$this->targetpes6->HrefValue = "";

			// tglpelak7
			$this->tglpelak7->LinkCustomAttributes = "";
			$this->tglpelak7->HrefValue = "";

			// targetpes7
			$this->targetpes7->LinkCustomAttributes = "";
			$this->targetpes7->HrefValue = "";

			// tglpelak8
			$this->tglpelak8->LinkCustomAttributes = "";
			$this->tglpelak8->HrefValue = "";

			// targetpes8
			$this->targetpes8->LinkCustomAttributes = "";
			$this->targetpes8->HrefValue = "";
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

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->area->Required) {
			if (!$this->area->IsDetailKey && $this->area->FormValue != NULL && $this->area->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->area->caption(), $this->area->RequiredErrorMessage));
			}
		}
		if ($this->jenispel->Required) {
			if (!$this->jenispel->IsDetailKey && $this->jenispel->FormValue != NULL && $this->jenispel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenispel->caption(), $this->jenispel->RequiredErrorMessage));
			}
		}
		if ($this->kdkategori->Required) {
			if (!$this->kdkategori->IsDetailKey && $this->kdkategori->FormValue != NULL && $this->kdkategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkategori->caption(), $this->kdkategori->RequiredErrorMessage));
			}
		}
		if ($this->kerjasama->Required) {
			if (!$this->kerjasama->IsDetailKey && $this->kerjasama->FormValue != NULL && $this->kerjasama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kerjasama->caption(), $this->kerjasama->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->kerjasama->FormValue)) {
			AddMessage($FormError, $this->kerjasama->errorMessage());
		}
		if ($this->tglpelak1->Required) {
			if (!$this->tglpelak1->IsDetailKey && $this->tglpelak1->FormValue != NULL && $this->tglpelak1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak1->caption(), $this->tglpelak1->RequiredErrorMessage));
			}
		}
		if ($this->targetpes1->Required) {
			if (!$this->targetpes1->IsDetailKey && $this->targetpes1->FormValue != NULL && $this->targetpes1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes1->caption(), $this->targetpes1->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes1->FormValue)) {
			AddMessage($FormError, $this->targetpes1->errorMessage());
		}
		if ($this->tglpelak2->Required) {
			if (!$this->tglpelak2->IsDetailKey && $this->tglpelak2->FormValue != NULL && $this->tglpelak2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak2->caption(), $this->tglpelak2->RequiredErrorMessage));
			}
		}
		if ($this->targetpes2->Required) {
			if (!$this->targetpes2->IsDetailKey && $this->targetpes2->FormValue != NULL && $this->targetpes2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes2->caption(), $this->targetpes2->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes2->FormValue)) {
			AddMessage($FormError, $this->targetpes2->errorMessage());
		}
		if ($this->tglpelak3->Required) {
			if (!$this->tglpelak3->IsDetailKey && $this->tglpelak3->FormValue != NULL && $this->tglpelak3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak3->caption(), $this->tglpelak3->RequiredErrorMessage));
			}
		}
		if ($this->targetpes3->Required) {
			if (!$this->targetpes3->IsDetailKey && $this->targetpes3->FormValue != NULL && $this->targetpes3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes3->caption(), $this->targetpes3->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes3->FormValue)) {
			AddMessage($FormError, $this->targetpes3->errorMessage());
		}
		if ($this->tglpelak4->Required) {
			if (!$this->tglpelak4->IsDetailKey && $this->tglpelak4->FormValue != NULL && $this->tglpelak4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak4->caption(), $this->tglpelak4->RequiredErrorMessage));
			}
		}
		if ($this->targetpes4->Required) {
			if (!$this->targetpes4->IsDetailKey && $this->targetpes4->FormValue != NULL && $this->targetpes4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes4->caption(), $this->targetpes4->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes4->FormValue)) {
			AddMessage($FormError, $this->targetpes4->errorMessage());
		}
		if ($this->tglpelak5->Required) {
			if (!$this->tglpelak5->IsDetailKey && $this->tglpelak5->FormValue != NULL && $this->tglpelak5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak5->caption(), $this->tglpelak5->RequiredErrorMessage));
			}
		}
		if ($this->targetpes5->Required) {
			if (!$this->targetpes5->IsDetailKey && $this->targetpes5->FormValue != NULL && $this->targetpes5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes5->caption(), $this->targetpes5->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes5->FormValue)) {
			AddMessage($FormError, $this->targetpes5->errorMessage());
		}
		if ($this->tglpelak6->Required) {
			if (!$this->tglpelak6->IsDetailKey && $this->tglpelak6->FormValue != NULL && $this->tglpelak6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak6->caption(), $this->tglpelak6->RequiredErrorMessage));
			}
		}
		if ($this->targetpes6->Required) {
			if (!$this->targetpes6->IsDetailKey && $this->targetpes6->FormValue != NULL && $this->targetpes6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes6->caption(), $this->targetpes6->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes6->FormValue)) {
			AddMessage($FormError, $this->targetpes6->errorMessage());
		}
		if ($this->tglpelak7->Required) {
			if (!$this->tglpelak7->IsDetailKey && $this->tglpelak7->FormValue != NULL && $this->tglpelak7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak7->caption(), $this->tglpelak7->RequiredErrorMessage));
			}
		}
		if ($this->targetpes7->Required) {
			if (!$this->targetpes7->IsDetailKey && $this->targetpes7->FormValue != NULL && $this->targetpes7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes7->caption(), $this->targetpes7->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes7->FormValue)) {
			AddMessage($FormError, $this->targetpes7->errorMessage());
		}
		if ($this->tglpelak8->Required) {
			if (!$this->tglpelak8->IsDetailKey && $this->tglpelak8->FormValue != NULL && $this->tglpelak8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak8->caption(), $this->tglpelak8->RequiredErrorMessage));
			}
		}
		if ($this->targetpes8->Required) {
			if (!$this->targetpes8->IsDetailKey && $this->targetpes8->FormValue != NULL && $this->targetpes8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes8->caption(), $this->targetpes8->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes8->FormValue)) {
			AddMessage($FormError, $this->targetpes8->errorMessage());
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

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['ctid'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
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

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// area
			$this->area->setDbValueDef($rsnew, $this->area->CurrentValue, NULL, $this->area->ReadOnly);

			// jenispel
			$this->jenispel->setDbValueDef($rsnew, $this->jenispel->CurrentValue, 0, $this->jenispel->ReadOnly);

			// kdkategori
			$this->kdkategori->setDbValueDef($rsnew, $this->kdkategori->CurrentValue, 0, $this->kdkategori->ReadOnly);

			// kerjasama
			$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, 0, $this->kerjasama->ReadOnly);

			// tglpelak1
			$this->tglpelak1->setDbValueDef($rsnew, $this->tglpelak1->CurrentValue, NULL, $this->tglpelak1->ReadOnly);

			// targetpes1
			$this->targetpes1->setDbValueDef($rsnew, $this->targetpes1->CurrentValue, NULL, $this->targetpes1->ReadOnly);

			// tglpelak2
			$this->tglpelak2->setDbValueDef($rsnew, $this->tglpelak2->CurrentValue, NULL, $this->tglpelak2->ReadOnly);

			// targetpes2
			$this->targetpes2->setDbValueDef($rsnew, $this->targetpes2->CurrentValue, NULL, $this->targetpes2->ReadOnly);

			// tglpelak3
			$this->tglpelak3->setDbValueDef($rsnew, $this->tglpelak3->CurrentValue, NULL, $this->tglpelak3->ReadOnly);

			// targetpes3
			$this->targetpes3->setDbValueDef($rsnew, $this->targetpes3->CurrentValue, NULL, $this->targetpes3->ReadOnly);

			// tglpelak4
			$this->tglpelak4->setDbValueDef($rsnew, $this->tglpelak4->CurrentValue, NULL, $this->tglpelak4->ReadOnly);

			// targetpes4
			$this->targetpes4->setDbValueDef($rsnew, $this->targetpes4->CurrentValue, NULL, $this->targetpes4->ReadOnly);

			// tglpelak5
			$this->tglpelak5->setDbValueDef($rsnew, $this->tglpelak5->CurrentValue, NULL, $this->tglpelak5->ReadOnly);

			// targetpes5
			$this->targetpes5->setDbValueDef($rsnew, $this->targetpes5->CurrentValue, NULL, $this->targetpes5->ReadOnly);

			// tglpelak6
			$this->tglpelak6->setDbValueDef($rsnew, $this->tglpelak6->CurrentValue, NULL, $this->tglpelak6->ReadOnly);

			// targetpes6
			$this->targetpes6->setDbValueDef($rsnew, $this->targetpes6->CurrentValue, NULL, $this->targetpes6->ReadOnly);

			// tglpelak7
			$this->tglpelak7->setDbValueDef($rsnew, $this->tglpelak7->CurrentValue, NULL, $this->tglpelak7->ReadOnly);

			// targetpes7
			$this->targetpes7->setDbValueDef($rsnew, $this->targetpes7->CurrentValue, NULL, $this->targetpes7->ReadOnly);

			// tglpelak8
			$this->tglpelak8->setDbValueDef($rsnew, $this->tglpelak8->CurrentValue, NULL, $this->tglpelak8->ReadOnly);

			// targetpes8
			$this->targetpes8->setDbValueDef($rsnew, $this->targetpes8->CurrentValue, NULL, $this->targetpes8->ReadOnly);

			// Check referential integrity for master table 't_rkcoaching'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_rkcoaching();
			$keyValue = isset($rsnew['rkid']) ? $rsnew['rkid'] : $rsold['rkid'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@rkid@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['area']) ? $rsnew['area'] : $rsold['area'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@area@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_rkcoaching"]))
					$GLOBALS["t_rkcoaching"] = new t_rkcoaching();
				$rsmaster = $GLOBALS["t_rkcoaching"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_rkcoaching", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
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
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "t_rkcoaching") {
				$this->rkid->CurrentValue = $this->rkid->getSessionValue();
				$this->area->CurrentValue = $this->area->getSessionValue();
			}

		// Check referential integrity for master table 't_coachingtahapan'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_rkcoaching();
		if ($this->rkid->getSessionValue() != "") {
			$masterFilter = str_replace("@rkid@", AdjustSql($this->rkid->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->area->CurrentValue) != "") {
			$masterFilter = str_replace("@area@", AdjustSql($this->area->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_rkcoaching"]))
				$GLOBALS["t_rkcoaching"] = new t_rkcoaching();
			$rsmaster = $GLOBALS["t_rkcoaching"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_rkcoaching", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// area
		$this->area->setDbValueDef($rsnew, $this->area->CurrentValue, NULL, FALSE);

		// jenispel
		$this->jenispel->setDbValueDef($rsnew, $this->jenispel->CurrentValue, 0, FALSE);

		// kdkategori
		$this->kdkategori->setDbValueDef($rsnew, $this->kdkategori->CurrentValue, 0, FALSE);

		// kerjasama
		$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, 0, FALSE);

		// tglpelak1
		$this->tglpelak1->setDbValueDef($rsnew, $this->tglpelak1->CurrentValue, NULL, FALSE);

		// targetpes1
		$this->targetpes1->setDbValueDef($rsnew, $this->targetpes1->CurrentValue, NULL, FALSE);

		// tglpelak2
		$this->tglpelak2->setDbValueDef($rsnew, $this->tglpelak2->CurrentValue, NULL, FALSE);

		// targetpes2
		$this->targetpes2->setDbValueDef($rsnew, $this->targetpes2->CurrentValue, NULL, FALSE);

		// tglpelak3
		$this->tglpelak3->setDbValueDef($rsnew, $this->tglpelak3->CurrentValue, NULL, FALSE);

		// targetpes3
		$this->targetpes3->setDbValueDef($rsnew, $this->targetpes3->CurrentValue, NULL, FALSE);

		// tglpelak4
		$this->tglpelak4->setDbValueDef($rsnew, $this->tglpelak4->CurrentValue, NULL, FALSE);

		// targetpes4
		$this->targetpes4->setDbValueDef($rsnew, $this->targetpes4->CurrentValue, NULL, FALSE);

		// tglpelak5
		$this->tglpelak5->setDbValueDef($rsnew, $this->tglpelak5->CurrentValue, NULL, FALSE);

		// targetpes5
		$this->targetpes5->setDbValueDef($rsnew, $this->targetpes5->CurrentValue, NULL, FALSE);

		// tglpelak6
		$this->tglpelak6->setDbValueDef($rsnew, $this->tglpelak6->CurrentValue, NULL, FALSE);

		// targetpes6
		$this->targetpes6->setDbValueDef($rsnew, $this->targetpes6->CurrentValue, NULL, FALSE);

		// tglpelak7
		$this->tglpelak7->setDbValueDef($rsnew, $this->tglpelak7->CurrentValue, NULL, FALSE);

		// targetpes7
		$this->targetpes7->setDbValueDef($rsnew, $this->targetpes7->CurrentValue, NULL, FALSE);

		// tglpelak8
		$this->tglpelak8->setDbValueDef($rsnew, $this->tglpelak8->CurrentValue, NULL, FALSE);

		// targetpes8
		$this->targetpes8->setDbValueDef($rsnew, $this->targetpes8->CurrentValue, NULL, FALSE);

		// rkid
		if ($this->rkid->getSessionValue() != "") {
			$rsnew['rkid'] = $this->rkid->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "t_rkcoaching") {
			$this->rkid->Visible = FALSE;
			if ($GLOBALS["t_rkcoaching"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->area->Visible = FALSE;
			if ($GLOBALS["t_rkcoaching"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_area":
					break;
				case "x_jenispel":
					break;
				case "x_kdkategori":
					break;
				case "x_kerjasama":
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
						case "x_area":
							break;
						case "x_kdkategori":
							break;
						case "x_kerjasama":
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

		$this->area->Visible = FALSE;
		if($this->Export <> ""){
			$GLOBALS["ExportFileName"] = "Jadwal_Kegiatan_Coaching_Program_Tahun_".$GLOBALS['t_rkcoaching']->tahun_keg->CurrentValue;
		} else {
			$header = "<ul class='nav nav-tabs'>
		<li><a href='#' class='btn btn-default' id='t1' data-toggle='tab'>Tahap 1</a></li> 
		<li><a href='#' class='btn btn-default' id='t2' data-toggle='tab'>Tahap 2</a></li> 
		<li><a href='#' class='btn btn-default' id='t3' data-toggle='tab'>Tahap 3</a></li>
		<li><a href='#' class='btn btn-default' id='t4' data-toggle='tab'>Tahap 4</a></li>
		<li><a href='#' class='btn btn-default' id='t5' data-toggle='tab'>Tahap 5</a></li>
		<li><a href='#' class='btn btn-default' id='t6' data-toggle='tab'>Tahap 6</a></li>
		<li><a href='#' class='btn btn-default' id='t7' data-toggle='tab'>Tahap 7</a></li>
		<li><a href='#' class='btn btn-default' id='t8' data-toggle='tab'>Tahap 8</a></li>
		</ul>";
		}
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		if($this->Export <> ""){
		} else {
		$footer = "<br>Keterangan: <br>";
		$footer .= "Tahap 1: Workshop dan Verifikasi Perusahaan (4 hari, 1 hari dikelas dan 3 hari kunjungan)<br>";
		$footer .= "Tahap 2: Training of Exporter (TOX) (3 hari di kelas)<br>";
		$footer .= "Tahap 3: Pendampingan Produk (3 hari kunjungan)<br>";
		$footer .= "Tahap 4: Pendampingan Market Development (3 hari kunjungan)<br>";
		$footer .= "Tahap 5: TOX Lanjutan (3 hari di kelas)<br>";
		$footer .= "Tahap 6: Business Matching (1 hari di kelas)<br>";
		$footer .= "Tahap 7: Progress Monitoring (3 hari kunjungan)<br>";
		$footer .= "Tahap 8: Evaluasi dan Penutupan (2 hari)<br>";
		}
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
} // End class
?>