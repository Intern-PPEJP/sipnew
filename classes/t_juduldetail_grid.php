<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_juduldetail_grid extends t_juduldetail
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_juduldetail';

	// Page object name
	public $PageObjName = "t_juduldetail_grid";

	// Grid form hidden field names
	public $FormName = "ft_juduldetailgrid";
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

		// Table object (t_juduldetail)
		if (!isset($GLOBALS["t_juduldetail"]) || get_class($GLOBALS["t_juduldetail"]) == PROJECT_NAMESPACE . "t_juduldetail") {
			$GLOBALS["t_juduldetail"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["t_juduldetail"];

		}
		$this->AddUrl = "t_juduldetailadd.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

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
	public $ShowOtherOptions = FALSE;
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
			$this->DisplayRecords = 10; // Load default
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
					$this->DisplayRecords = 10; // Non-numeric, load default
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
			$this->detailjdid->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->detailjdid->OldValue))
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
					$key .= $this->detailjdid->CurrentValue;

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
		if ($CurrentForm->hasValue("x_singbagian") && $CurrentForm->hasValue("o_singbagian") && $this->singbagian->CurrentValue != $this->singbagian->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jpel") && $CurrentForm->hasValue("o_jpel") && $this->jpel->CurrentValue != $this->jpel->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdjudul") && $CurrentForm->hasValue("o_kdjudul") && $this->kdjudul->CurrentValue != $this->kdjudul->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdkursil") && $CurrentForm->hasValue("o_kdkursil") && $this->kdkursil->CurrentValue != $this->kdkursil->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_revisi") && $CurrentForm->hasValue("o_revisi") && $this->revisi->CurrentValue != $this->revisi->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tgl_terbit") && $CurrentForm->hasValue("o_tgl_terbit") && $this->tgl_terbit->CurrentValue != $this->tgl_terbit->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_deskripsi_singkat") && $CurrentForm->hasValue("o_deskripsi_singkat") && $this->deskripsi_singkat->CurrentValue != $this->deskripsi_singkat->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tujuan") && $CurrentForm->hasValue("o_tujuan") && $this->tujuan->CurrentValue != $this->tujuan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_target_peserta") && $CurrentForm->hasValue("o_target_peserta") && $this->target_peserta->CurrentValue != $this->target_peserta->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_lama_pelatihan") && $CurrentForm->hasValue("o_lama_pelatihan") && $this->lama_pelatihan->CurrentValue != $this->lama_pelatihan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_catatan") && $CurrentForm->hasValue("o_catatan") && $this->catatan->CurrentValue != $this->catatan->OldValue)
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
				$this->kdjudul->setSessionValue("");
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
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->detailjdid->CurrentValue . "\">";
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
		$key .= $rs->fields('detailjdid');
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
		$this->detailjdid->CurrentValue = NULL;
		$this->detailjdid->OldValue = $this->detailjdid->CurrentValue;
		$this->singbagian->CurrentValue = NULL;
		$this->singbagian->OldValue = $this->singbagian->CurrentValue;
		$this->jpel->CurrentValue = NULL;
		$this->jpel->OldValue = $this->jpel->CurrentValue;
		$this->kdjudul->CurrentValue = NULL;
		$this->kdjudul->OldValue = $this->kdjudul->CurrentValue;
		$this->kdkursil->CurrentValue = NULL;
		$this->kdkursil->OldValue = $this->kdkursil->CurrentValue;
		$this->revisi->CurrentValue = NULL;
		$this->revisi->OldValue = $this->revisi->CurrentValue;
		$this->tgl_terbit->CurrentValue = NULL;
		$this->tgl_terbit->OldValue = $this->tgl_terbit->CurrentValue;
		$this->deskripsi_singkat->CurrentValue = NULL;
		$this->deskripsi_singkat->OldValue = $this->deskripsi_singkat->CurrentValue;
		$this->tujuan->CurrentValue = NULL;
		$this->tujuan->OldValue = $this->tujuan->CurrentValue;
		$this->target_peserta->CurrentValue = NULL;
		$this->target_peserta->OldValue = $this->target_peserta->CurrentValue;
		$this->lama_pelatihan->CurrentValue = NULL;
		$this->lama_pelatihan->OldValue = $this->lama_pelatihan->CurrentValue;
		$this->catatan->CurrentValue = NULL;
		$this->catatan->OldValue = $this->catatan->CurrentValue;
		$this->created_by->CurrentValue = NULL;
		$this->created_by->OldValue = $this->created_by->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->updated_by->CurrentValue = NULL;
		$this->updated_by->OldValue = $this->updated_by->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'singbagian' first before field var 'x_singbagian'
		$val = $CurrentForm->hasValue("singbagian") ? $CurrentForm->getValue("singbagian") : $CurrentForm->getValue("x_singbagian");
		if (!$this->singbagian->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->singbagian->Visible = FALSE; // Disable update for API request
			else
				$this->singbagian->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_singbagian"))
			$this->singbagian->setOldValue($CurrentForm->getValue("o_singbagian"));

		// Check field name 'jpel' first before field var 'x_jpel'
		$val = $CurrentForm->hasValue("jpel") ? $CurrentForm->getValue("jpel") : $CurrentForm->getValue("x_jpel");
		if (!$this->jpel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jpel->Visible = FALSE; // Disable update for API request
			else
				$this->jpel->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jpel"))
			$this->jpel->setOldValue($CurrentForm->getValue("o_jpel"));

		// Check field name 'kdjudul' first before field var 'x_kdjudul'
		$val = $CurrentForm->hasValue("kdjudul") ? $CurrentForm->getValue("kdjudul") : $CurrentForm->getValue("x_kdjudul");
		if (!$this->kdjudul->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdjudul->Visible = FALSE; // Disable update for API request
			else
				$this->kdjudul->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdjudul"))
			$this->kdjudul->setOldValue($CurrentForm->getValue("o_kdjudul"));

		// Check field name 'kdkursil' first before field var 'x_kdkursil'
		$val = $CurrentForm->hasValue("kdkursil") ? $CurrentForm->getValue("kdkursil") : $CurrentForm->getValue("x_kdkursil");
		if (!$this->kdkursil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkursil->Visible = FALSE; // Disable update for API request
			else
				$this->kdkursil->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdkursil"))
			$this->kdkursil->setOldValue($CurrentForm->getValue("o_kdkursil"));

		// Check field name 'revisi' first before field var 'x_revisi'
		$val = $CurrentForm->hasValue("revisi") ? $CurrentForm->getValue("revisi") : $CurrentForm->getValue("x_revisi");
		if (!$this->revisi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->revisi->Visible = FALSE; // Disable update for API request
			else
				$this->revisi->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_revisi"))
			$this->revisi->setOldValue($CurrentForm->getValue("o_revisi"));

		// Check field name 'tgl_terbit' first before field var 'x_tgl_terbit'
		$val = $CurrentForm->hasValue("tgl_terbit") ? $CurrentForm->getValue("tgl_terbit") : $CurrentForm->getValue("x_tgl_terbit");
		if (!$this->tgl_terbit->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_terbit->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_terbit->setFormValue($val);
			$this->tgl_terbit->CurrentValue = UnFormatDateTime($this->tgl_terbit->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_tgl_terbit"))
			$this->tgl_terbit->setOldValue($CurrentForm->getValue("o_tgl_terbit"));

		// Check field name 'deskripsi_singkat' first before field var 'x_deskripsi_singkat'
		$val = $CurrentForm->hasValue("deskripsi_singkat") ? $CurrentForm->getValue("deskripsi_singkat") : $CurrentForm->getValue("x_deskripsi_singkat");
		if (!$this->deskripsi_singkat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->deskripsi_singkat->Visible = FALSE; // Disable update for API request
			else
				$this->deskripsi_singkat->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_deskripsi_singkat"))
			$this->deskripsi_singkat->setOldValue($CurrentForm->getValue("o_deskripsi_singkat"));

		// Check field name 'tujuan' first before field var 'x_tujuan'
		$val = $CurrentForm->hasValue("tujuan") ? $CurrentForm->getValue("tujuan") : $CurrentForm->getValue("x_tujuan");
		if (!$this->tujuan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tujuan->Visible = FALSE; // Disable update for API request
			else
				$this->tujuan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tujuan"))
			$this->tujuan->setOldValue($CurrentForm->getValue("o_tujuan"));

		// Check field name 'target_peserta' first before field var 'x_target_peserta'
		$val = $CurrentForm->hasValue("target_peserta") ? $CurrentForm->getValue("target_peserta") : $CurrentForm->getValue("x_target_peserta");
		if (!$this->target_peserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->target_peserta->Visible = FALSE; // Disable update for API request
			else
				$this->target_peserta->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_target_peserta"))
			$this->target_peserta->setOldValue($CurrentForm->getValue("o_target_peserta"));

		// Check field name 'lama_pelatihan' first before field var 'x_lama_pelatihan'
		$val = $CurrentForm->hasValue("lama_pelatihan") ? $CurrentForm->getValue("lama_pelatihan") : $CurrentForm->getValue("x_lama_pelatihan");
		if (!$this->lama_pelatihan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->lama_pelatihan->Visible = FALSE; // Disable update for API request
			else
				$this->lama_pelatihan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_lama_pelatihan"))
			$this->lama_pelatihan->setOldValue($CurrentForm->getValue("o_lama_pelatihan"));

		// Check field name 'catatan' first before field var 'x_catatan'
		$val = $CurrentForm->hasValue("catatan") ? $CurrentForm->getValue("catatan") : $CurrentForm->getValue("x_catatan");
		if (!$this->catatan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->catatan->Visible = FALSE; // Disable update for API request
			else
				$this->catatan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_catatan"))
			$this->catatan->setOldValue($CurrentForm->getValue("o_catatan"));

		// Check field name 'detailjdid' first before field var 'x_detailjdid'
		$val = $CurrentForm->hasValue("detailjdid") ? $CurrentForm->getValue("detailjdid") : $CurrentForm->getValue("x_detailjdid");
		if (!$this->detailjdid->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->detailjdid->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->detailjdid->CurrentValue = $this->detailjdid->FormValue;
		$this->singbagian->CurrentValue = $this->singbagian->FormValue;
		$this->jpel->CurrentValue = $this->jpel->FormValue;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->kdkursil->CurrentValue = $this->kdkursil->FormValue;
		$this->revisi->CurrentValue = $this->revisi->FormValue;
		$this->tgl_terbit->CurrentValue = $this->tgl_terbit->FormValue;
		$this->tgl_terbit->CurrentValue = UnFormatDateTime($this->tgl_terbit->CurrentValue, 0);
		$this->deskripsi_singkat->CurrentValue = $this->deskripsi_singkat->FormValue;
		$this->tujuan->CurrentValue = $this->tujuan->FormValue;
		$this->target_peserta->CurrentValue = $this->target_peserta->FormValue;
		$this->lama_pelatihan->CurrentValue = $this->lama_pelatihan->FormValue;
		$this->catatan->CurrentValue = $this->catatan->FormValue;
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
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['detailjdid'] = $this->detailjdid->CurrentValue;
		$row['singbagian'] = $this->singbagian->CurrentValue;
		$row['jpel'] = $this->jpel->CurrentValue;
		$row['kdjudul'] = $this->kdjudul->CurrentValue;
		$row['kdkursil'] = $this->kdkursil->CurrentValue;
		$row['revisi'] = $this->revisi->CurrentValue;
		$row['tgl_terbit'] = $this->tgl_terbit->CurrentValue;
		$row['deskripsi_singkat'] = $this->deskripsi_singkat->CurrentValue;
		$row['tujuan'] = $this->tujuan->CurrentValue;
		$row['target_peserta'] = $this->target_peserta->CurrentValue;
		$row['lama_pelatihan'] = $this->lama_pelatihan->CurrentValue;
		$row['catatan'] = $this->catatan->CurrentValue;
		$row['created_by'] = $this->created_by->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['updated_by'] = $this->updated_by->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
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
				$this->detailjdid->OldValue = strval($keys[0]); // detailjdid
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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// singbagian
			$this->singbagian->EditAttrs["class"] = "form-control";
			$this->singbagian->EditCustomAttributes = "";
			$curVal = trim(strval($this->singbagian->CurrentValue));
			if ($curVal != "")
				$this->singbagian->ViewValue = $this->singbagian->lookupCacheOption($curVal);
			else
				$this->singbagian->ViewValue = $this->singbagian->Lookup !== NULL && is_array($this->singbagian->Lookup->Options) ? $curVal : NULL;
			if ($this->singbagian->ViewValue !== NULL) { // Load from cache
				$this->singbagian->EditValue = array_values($this->singbagian->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`singkatan`" . SearchString("=", $this->singbagian->CurrentValue, DATATYPE_STRING, "");
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
			if ($this->kdjudul->getSessionValue() != "") {
				$this->kdjudul->CurrentValue = $this->kdjudul->getSessionValue();
				$this->kdjudul->OldValue = $this->kdjudul->CurrentValue;
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
			} else {
				if (!$this->kdjudul->Raw)
					$this->kdjudul->CurrentValue = HtmlDecode($this->kdjudul->CurrentValue);
				$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->CurrentValue);
				$curVal = strval($this->kdjudul->CurrentValue);
				if ($curVal != "") {
					$this->kdjudul->EditValue = $this->kdjudul->lookupCacheOption($curVal);
					if ($this->kdjudul->EditValue === NULL) { // Lookup from database
						$filterWrk = "`kdjudul`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->kdjudul->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->kdjudul->EditValue = $this->kdjudul->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->CurrentValue);
						}
					}
				} else {
					$this->kdjudul->EditValue = NULL;
				}
				$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());
			}

			// kdkursil
			$this->kdkursil->EditAttrs["class"] = "form-control";
			$this->kdkursil->EditCustomAttributes = "";
			if (!$this->kdkursil->Raw)
				$this->kdkursil->CurrentValue = HtmlDecode($this->kdkursil->CurrentValue);
			$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->CurrentValue);
			$this->kdkursil->PlaceHolder = RemoveHtml($this->kdkursil->caption());

			// revisi
			$this->revisi->EditAttrs["class"] = "form-control";
			$this->revisi->EditCustomAttributes = "";
			if (!$this->revisi->Raw)
				$this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
			$this->revisi->EditValue = HtmlEncode($this->revisi->CurrentValue);
			$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

			// tgl_terbit
			$this->tgl_terbit->EditAttrs["class"] = "form-control";
			$this->tgl_terbit->EditCustomAttributes = "";
			$this->tgl_terbit->EditValue = HtmlEncode(FormatDateTime($this->tgl_terbit->CurrentValue, 8));
			$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

			// deskripsi_singkat
			$this->deskripsi_singkat->EditAttrs["class"] = "form-control";
			$this->deskripsi_singkat->EditCustomAttributes = "";
			$this->deskripsi_singkat->EditValue = HtmlEncode($this->deskripsi_singkat->CurrentValue);
			$this->deskripsi_singkat->PlaceHolder = RemoveHtml($this->deskripsi_singkat->caption());

			// tujuan
			$this->tujuan->EditAttrs["class"] = "form-control";
			$this->tujuan->EditCustomAttributes = "";
			$this->tujuan->EditValue = HtmlEncode($this->tujuan->CurrentValue);
			$this->tujuan->PlaceHolder = RemoveHtml($this->tujuan->caption());

			// target_peserta
			$this->target_peserta->EditAttrs["class"] = "form-control";
			$this->target_peserta->EditCustomAttributes = "";
			$this->target_peserta->EditValue = HtmlEncode($this->target_peserta->CurrentValue);
			$this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

			// lama_pelatihan
			$this->lama_pelatihan->EditAttrs["class"] = "form-control";
			$this->lama_pelatihan->EditCustomAttributes = "";
			$curVal = trim(strval($this->lama_pelatihan->CurrentValue));
			if ($curVal != "")
				$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->lookupCacheOption($curVal);
			else
				$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->Lookup !== NULL && is_array($this->lama_pelatihan->Lookup->Options) ? $curVal : NULL;
			if ($this->lama_pelatihan->ViewValue !== NULL) { // Load from cache
				$this->lama_pelatihan->EditValue = array_values($this->lama_pelatihan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`angka`" . SearchString("=", $this->lama_pelatihan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->lama_pelatihan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->lama_pelatihan->EditValue = $arwrk;
			}

			// catatan
			$this->catatan->EditAttrs["class"] = "form-control";
			$this->catatan->EditCustomAttributes = "";
			$this->catatan->EditValue = HtmlEncode($this->catatan->CurrentValue);
			$this->catatan->PlaceHolder = RemoveHtml($this->catatan->caption());

			// Add refer script
			// singbagian

			$this->singbagian->LinkCustomAttributes = "";
			$this->singbagian->HrefValue = "";

			// jpel
			$this->jpel->LinkCustomAttributes = "";
			$this->jpel->HrefValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";

			// tgl_terbit
			$this->tgl_terbit->LinkCustomAttributes = "";
			$this->tgl_terbit->HrefValue = "";

			// deskripsi_singkat
			$this->deskripsi_singkat->LinkCustomAttributes = "";
			$this->deskripsi_singkat->HrefValue = "";

			// tujuan
			$this->tujuan->LinkCustomAttributes = "";
			$this->tujuan->HrefValue = "";

			// target_peserta
			$this->target_peserta->LinkCustomAttributes = "";
			$this->target_peserta->HrefValue = "";

			// lama_pelatihan
			$this->lama_pelatihan->LinkCustomAttributes = "";
			$this->lama_pelatihan->HrefValue = "";

			// catatan
			$this->catatan->LinkCustomAttributes = "";
			$this->catatan->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// singbagian
			$this->singbagian->EditAttrs["class"] = "form-control";
			$this->singbagian->EditCustomAttributes = "";
			$curVal = strval($this->singbagian->CurrentValue);
			if ($curVal != "") {
				$this->singbagian->EditValue = $this->singbagian->lookupCacheOption($curVal);
				if ($this->singbagian->EditValue === NULL) { // Lookup from database
					$filterWrk = "`singkatan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->singbagian->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->singbagian->EditValue = $this->singbagian->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->singbagian->EditValue = $this->singbagian->CurrentValue;
					}
				}
			} else {
				$this->singbagian->EditValue = NULL;
			}
			$this->singbagian->ViewCustomAttributes = "";

			// jpel
			$this->jpel->EditAttrs["class"] = "form-control";
			$this->jpel->EditCustomAttributes = "";
			if (strval($this->jpel->CurrentValue) != "") {
				$this->jpel->EditValue = $this->jpel->optionCaption($this->jpel->CurrentValue);
			} else {
				$this->jpel->EditValue = NULL;
			}
			$this->jpel->ViewCustomAttributes = "";

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if ($this->kdjudul->VirtualValue != "") {
				$this->kdjudul->EditValue = $this->kdjudul->VirtualValue;
			} else {
				$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
				$curVal = strval($this->kdjudul->CurrentValue);
				if ($curVal != "") {
					$this->kdjudul->EditValue = $this->kdjudul->lookupCacheOption($curVal);
					if ($this->kdjudul->EditValue === NULL) { // Lookup from database
						$filterWrk = "`kdjudul`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->kdjudul->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdjudul->EditValue = $this->kdjudul->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
						}
					}
				} else {
					$this->kdjudul->EditValue = NULL;
				}
			}
			$this->kdjudul->ViewCustomAttributes = "";

			// kdkursil
			$this->kdkursil->EditAttrs["class"] = "form-control";
			$this->kdkursil->EditCustomAttributes = "";
			$this->kdkursil->EditValue = $this->kdkursil->CurrentValue;
			$this->kdkursil->ViewCustomAttributes = "";

			// revisi
			$this->revisi->EditAttrs["class"] = "form-control";
			$this->revisi->EditCustomAttributes = "";
			$this->revisi->EditValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tgl_terbit
			$this->tgl_terbit->EditAttrs["class"] = "form-control";
			$this->tgl_terbit->EditCustomAttributes = "";
			$this->tgl_terbit->EditValue = HtmlEncode(FormatDateTime($this->tgl_terbit->CurrentValue, 8));
			$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

			// deskripsi_singkat
			$this->deskripsi_singkat->EditAttrs["class"] = "form-control";
			$this->deskripsi_singkat->EditCustomAttributes = "";
			$this->deskripsi_singkat->EditValue = HtmlEncode($this->deskripsi_singkat->CurrentValue);
			$this->deskripsi_singkat->PlaceHolder = RemoveHtml($this->deskripsi_singkat->caption());

			// tujuan
			$this->tujuan->EditAttrs["class"] = "form-control";
			$this->tujuan->EditCustomAttributes = "";
			$this->tujuan->EditValue = HtmlEncode($this->tujuan->CurrentValue);
			$this->tujuan->PlaceHolder = RemoveHtml($this->tujuan->caption());

			// target_peserta
			$this->target_peserta->EditAttrs["class"] = "form-control";
			$this->target_peserta->EditCustomAttributes = "";
			$this->target_peserta->EditValue = HtmlEncode($this->target_peserta->CurrentValue);
			$this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

			// lama_pelatihan
			$this->lama_pelatihan->EditAttrs["class"] = "form-control";
			$this->lama_pelatihan->EditCustomAttributes = "";
			$curVal = strval($this->lama_pelatihan->CurrentValue);
			if ($curVal != "") {
				$this->lama_pelatihan->EditValue = $this->lama_pelatihan->lookupCacheOption($curVal);
				if ($this->lama_pelatihan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`angka`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->lama_pelatihan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->lama_pelatihan->EditValue = $this->lama_pelatihan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->lama_pelatihan->EditValue = $this->lama_pelatihan->CurrentValue;
					}
				}
			} else {
				$this->lama_pelatihan->EditValue = NULL;
			}
			$this->lama_pelatihan->ViewCustomAttributes = "";

			// catatan
			$this->catatan->EditAttrs["class"] = "form-control";
			$this->catatan->EditCustomAttributes = "";
			$this->catatan->EditValue = HtmlEncode($this->catatan->CurrentValue);
			$this->catatan->PlaceHolder = RemoveHtml($this->catatan->caption());

			// Edit refer script
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

			// deskripsi_singkat
			$this->deskripsi_singkat->LinkCustomAttributes = "";
			$this->deskripsi_singkat->HrefValue = "";

			// tujuan
			$this->tujuan->LinkCustomAttributes = "";
			$this->tujuan->HrefValue = "";

			// target_peserta
			$this->target_peserta->LinkCustomAttributes = "";
			$this->target_peserta->HrefValue = "";

			// lama_pelatihan
			$this->lama_pelatihan->LinkCustomAttributes = "";
			$this->lama_pelatihan->HrefValue = "";
			$this->lama_pelatihan->TooltipValue = "";

			// catatan
			$this->catatan->LinkCustomAttributes = "";
			$this->catatan->HrefValue = "";
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
		if ($this->singbagian->Required) {
			if (!$this->singbagian->IsDetailKey && $this->singbagian->FormValue != NULL && $this->singbagian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->singbagian->caption(), $this->singbagian->RequiredErrorMessage));
			}
		}
		if ($this->jpel->Required) {
			if (!$this->jpel->IsDetailKey && $this->jpel->FormValue != NULL && $this->jpel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jpel->caption(), $this->jpel->RequiredErrorMessage));
			}
		}
		if ($this->kdjudul->Required) {
			if (!$this->kdjudul->IsDetailKey && $this->kdjudul->FormValue != NULL && $this->kdjudul->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdjudul->caption(), $this->kdjudul->RequiredErrorMessage));
			}
		}
		if ($this->kdkursil->Required) {
			if (!$this->kdkursil->IsDetailKey && $this->kdkursil->FormValue != NULL && $this->kdkursil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkursil->caption(), $this->kdkursil->RequiredErrorMessage));
			}
		}
		if ($this->revisi->Required) {
			if (!$this->revisi->IsDetailKey && $this->revisi->FormValue != NULL && $this->revisi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revisi->caption(), $this->revisi->RequiredErrorMessage));
			}
		}
		if ($this->tgl_terbit->Required) {
			if (!$this->tgl_terbit->IsDetailKey && $this->tgl_terbit->FormValue != NULL && $this->tgl_terbit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_terbit->caption(), $this->tgl_terbit->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_terbit->FormValue)) {
			AddMessage($FormError, $this->tgl_terbit->errorMessage());
		}
		if ($this->deskripsi_singkat->Required) {
			if (!$this->deskripsi_singkat->IsDetailKey && $this->deskripsi_singkat->FormValue != NULL && $this->deskripsi_singkat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->deskripsi_singkat->caption(), $this->deskripsi_singkat->RequiredErrorMessage));
			}
		}
		if ($this->tujuan->Required) {
			if (!$this->tujuan->IsDetailKey && $this->tujuan->FormValue != NULL && $this->tujuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tujuan->caption(), $this->tujuan->RequiredErrorMessage));
			}
		}
		if ($this->target_peserta->Required) {
			if (!$this->target_peserta->IsDetailKey && $this->target_peserta->FormValue != NULL && $this->target_peserta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->target_peserta->caption(), $this->target_peserta->RequiredErrorMessage));
			}
		}
		if ($this->lama_pelatihan->Required) {
			if (!$this->lama_pelatihan->IsDetailKey && $this->lama_pelatihan->FormValue != NULL && $this->lama_pelatihan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->lama_pelatihan->caption(), $this->lama_pelatihan->RequiredErrorMessage));
			}
		}
		if ($this->catatan->Required) {
			if (!$this->catatan->IsDetailKey && $this->catatan->FormValue != NULL && $this->catatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->catatan->caption(), $this->catatan->RequiredErrorMessage));
			}
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
				$thisKey .= $row['detailjdid'];
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

			// tgl_terbit
			$this->tgl_terbit->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_terbit->CurrentValue, 0), NULL, $this->tgl_terbit->ReadOnly);

			// deskripsi_singkat
			$this->deskripsi_singkat->setDbValueDef($rsnew, $this->deskripsi_singkat->CurrentValue, NULL, $this->deskripsi_singkat->ReadOnly);

			// tujuan
			$this->tujuan->setDbValueDef($rsnew, $this->tujuan->CurrentValue, NULL, $this->tujuan->ReadOnly);

			// target_peserta
			$this->target_peserta->setDbValueDef($rsnew, $this->target_peserta->CurrentValue, NULL, $this->target_peserta->ReadOnly);

			// catatan
			$this->catatan->setDbValueDef($rsnew, $this->catatan->CurrentValue, NULL, $this->catatan->ReadOnly);

			// Check referential integrity for master table 't_judul'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_judul();
			$keyValue = isset($rsnew['kdjudul']) ? $rsnew['kdjudul'] : $rsold['kdjudul'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@kdjudul@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_judul"]))
					$GLOBALS["t_judul"] = new t_judul();
				$rsmaster = $GLOBALS["t_judul"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_judul", $Language->phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "t_judul") {
				$this->kdjudul->CurrentValue = $this->kdjudul->getSessionValue();
			}

		// Check referential integrity for master table 't_juduldetail'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_judul();
		if (strval($this->kdjudul->CurrentValue) != "") {
			$masterFilter = str_replace("@kdjudul@", AdjustSql($this->kdjudul->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_judul"]))
				$GLOBALS["t_judul"] = new t_judul();
			$rsmaster = $GLOBALS["t_judul"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_judul", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// singbagian
		$this->singbagian->setDbValueDef($rsnew, $this->singbagian->CurrentValue, NULL, FALSE);

		// jpel
		$this->jpel->setDbValueDef($rsnew, $this->jpel->CurrentValue, NULL, FALSE);

		// kdjudul
		$this->kdjudul->setDbValueDef($rsnew, $this->kdjudul->CurrentValue, NULL, FALSE);

		// kdkursil
		$this->kdkursil->setDbValueDef($rsnew, $this->kdkursil->CurrentValue, NULL, FALSE);

		// revisi
		$this->revisi->setDbValueDef($rsnew, $this->revisi->CurrentValue, NULL, FALSE);

		// tgl_terbit
		$this->tgl_terbit->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_terbit->CurrentValue, 0), NULL, FALSE);

		// deskripsi_singkat
		$this->deskripsi_singkat->setDbValueDef($rsnew, $this->deskripsi_singkat->CurrentValue, NULL, FALSE);

		// tujuan
		$this->tujuan->setDbValueDef($rsnew, $this->tujuan->CurrentValue, NULL, FALSE);

		// target_peserta
		$this->target_peserta->setDbValueDef($rsnew, $this->target_peserta->CurrentValue, NULL, FALSE);

		// lama_pelatihan
		$this->lama_pelatihan->setDbValueDef($rsnew, $this->lama_pelatihan->CurrentValue, NULL, FALSE);

		// catatan
		$this->catatan->setDbValueDef($rsnew, $this->catatan->CurrentValue, NULL, FALSE);

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
		if ($masterTblVar == "t_judul") {
			$this->kdjudul->Visible = FALSE;
			if ($GLOBALS["t_judul"]->EventCancelled)
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