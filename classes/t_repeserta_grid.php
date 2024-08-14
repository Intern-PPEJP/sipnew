<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_repeserta_grid extends t_repeserta
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_repeserta';

	// Page object name
	public $PageObjName = "t_repeserta_grid";

	// Grid form hidden field names
	public $FormName = "ft_repesertagrid";
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

		// Table object (t_repeserta)
		if (!isset($GLOBALS["t_repeserta"]) || get_class($GLOBALS["t_repeserta"]) == PROJECT_NAMESPACE . "t_repeserta") {
			$GLOBALS["t_repeserta"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["t_repeserta"];

		}
		$this->AddUrl = "t_repesertaadd.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

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
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
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
					$key .= $this->id->CurrentValue;

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
		if ($CurrentForm->hasValue("x_nama") && $CurrentForm->hasValue("o_nama") && $this->nama->CurrentValue != $this->nama->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_perusahaan") && $CurrentForm->hasValue("o_perusahaan") && $this->perusahaan->CurrentValue != $this->perusahaan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jabatan") && $CurrentForm->hasValue("o_jabatan") && $this->jabatan->CurrentValue != $this->jabatan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tgl_daftar") && $CurrentForm->hasValue("o_tgl_daftar") && $this->tgl_daftar->CurrentValue != $this->tgl_daftar->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_telp") && $CurrentForm->hasValue("o_telp") && $this->telp->CurrentValue != $this->telp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_fax") && $CurrentForm->hasValue("o_fax") && $this->fax->CurrentValue != $this->fax->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_hp") && $CurrentForm->hasValue("o_hp") && $this->hp->CurrentValue != $this->hp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_produk") && $CurrentForm->hasValue("o_produk") && $this->produk->CurrentValue != $this->produk->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_cara_bayar") && $CurrentForm->hasValue("o_cara_bayar") && $this->cara_bayar->CurrentValue != $this->cara_bayar->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ket_bayar") && $CurrentForm->hasValue("o_ket_bayar") && $this->ket_bayar->CurrentValue != $this->ket_bayar->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tgl_bayar") && $CurrentForm->hasValue("o_tgl_bayar") && $this->tgl_bayar->CurrentValue != $this->tgl_bayar->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdinformasi") && $CurrentForm->hasValue("o_kdinformasi") && $this->kdinformasi->CurrentValue != $this->kdinformasi->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_konfirmasi") && $CurrentForm->hasValue("o_konfirmasi") && $this->konfirmasi->CurrentValue != $this->konfirmasi->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ket") && $CurrentForm->hasValue("o_ket") && $this->ket->CurrentValue != $this->ket->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ket_lainnya") && $CurrentForm->hasValue("o_ket_lainnya") && $this->ket_lainnya->CurrentValue != $this->ket_lainnya->OldValue)
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
				$this->idpelat->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
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
		$this->ListOptions->UseDropDownButton = TRUE;
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->id->CurrentValue . "\">";
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
		$key .= $rs->fields('id');
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
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->idpelat->CurrentValue = NULL;
		$this->idpelat->OldValue = $this->idpelat->CurrentValue;
		$this->kdjudul->CurrentValue = NULL;
		$this->kdjudul->OldValue = $this->kdjudul->CurrentValue;
		$this->tgl_pel->CurrentValue = NULL;
		$this->tgl_pel->OldValue = $this->tgl_pel->CurrentValue;
		$this->nama->CurrentValue = NULL;
		$this->nama->OldValue = $this->nama->CurrentValue;
		$this->perusahaan->CurrentValue = NULL;
		$this->perusahaan->OldValue = $this->perusahaan->CurrentValue;
		$this->jabatan->CurrentValue = NULL;
		$this->jabatan->OldValue = $this->jabatan->CurrentValue;
		$this->tgl_daftar->CurrentValue = NULL;
		$this->tgl_daftar->OldValue = $this->tgl_daftar->CurrentValue;
		$this->telp->CurrentValue = NULL;
		$this->telp->OldValue = $this->telp->CurrentValue;
		$this->fax->CurrentValue = NULL;
		$this->fax->OldValue = $this->fax->CurrentValue;
		$this->hp->CurrentValue = NULL;
		$this->hp->OldValue = $this->hp->CurrentValue;
		$this->produk->CurrentValue = NULL;
		$this->produk->OldValue = $this->produk->CurrentValue;
		$this->cara_bayar->CurrentValue = NULL;
		$this->cara_bayar->OldValue = $this->cara_bayar->CurrentValue;
		$this->ket_bayar->CurrentValue = NULL;
		$this->ket_bayar->OldValue = $this->ket_bayar->CurrentValue;
		$this->tgl_bayar->CurrentValue = NULL;
		$this->tgl_bayar->OldValue = $this->tgl_bayar->CurrentValue;
		$this->kdinformasi->CurrentValue = NULL;
		$this->kdinformasi->OldValue = $this->kdinformasi->CurrentValue;
		$this->konfirmasi->CurrentValue = NULL;
		$this->konfirmasi->OldValue = $this->konfirmasi->CurrentValue;
		$this->ket->CurrentValue = NULL;
		$this->ket->OldValue = $this->ket->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->ket_lainnya->CurrentValue = NULL;
		$this->ket_lainnya->OldValue = $this->ket_lainnya->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'nama' first before field var 'x_nama'
		$val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
		if (!$this->nama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nama->Visible = FALSE; // Disable update for API request
			else
				$this->nama->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_nama"))
			$this->nama->setOldValue($CurrentForm->getValue("o_nama"));

		// Check field name 'perusahaan' first before field var 'x_perusahaan'
		$val = $CurrentForm->hasValue("perusahaan") ? $CurrentForm->getValue("perusahaan") : $CurrentForm->getValue("x_perusahaan");
		if (!$this->perusahaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->perusahaan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_perusahaan"))
			$this->perusahaan->setOldValue($CurrentForm->getValue("o_perusahaan"));

		// Check field name 'jabatan' first before field var 'x_jabatan'
		$val = $CurrentForm->hasValue("jabatan") ? $CurrentForm->getValue("jabatan") : $CurrentForm->getValue("x_jabatan");
		if (!$this->jabatan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->jabatan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jabatan"))
			$this->jabatan->setOldValue($CurrentForm->getValue("o_jabatan"));

		// Check field name 'tgl_daftar' first before field var 'x_tgl_daftar'
		$val = $CurrentForm->hasValue("tgl_daftar") ? $CurrentForm->getValue("tgl_daftar") : $CurrentForm->getValue("x_tgl_daftar");
		if (!$this->tgl_daftar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_daftar->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_daftar->setFormValue($val);
			$this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_tgl_daftar"))
			$this->tgl_daftar->setOldValue($CurrentForm->getValue("o_tgl_daftar"));

		// Check field name 'telp' first before field var 'x_telp'
		$val = $CurrentForm->hasValue("telp") ? $CurrentForm->getValue("telp") : $CurrentForm->getValue("x_telp");
		if (!$this->telp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->telp->Visible = FALSE; // Disable update for API request
			else
				$this->telp->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_telp"))
			$this->telp->setOldValue($CurrentForm->getValue("o_telp"));

		// Check field name 'fax' first before field var 'x_fax'
		$val = $CurrentForm->hasValue("fax") ? $CurrentForm->getValue("fax") : $CurrentForm->getValue("x_fax");
		if (!$this->fax->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->fax->Visible = FALSE; // Disable update for API request
			else
				$this->fax->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_fax"))
			$this->fax->setOldValue($CurrentForm->getValue("o_fax"));

		// Check field name 'hp' first before field var 'x_hp'
		$val = $CurrentForm->hasValue("hp") ? $CurrentForm->getValue("hp") : $CurrentForm->getValue("x_hp");
		if (!$this->hp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->hp->Visible = FALSE; // Disable update for API request
			else
				$this->hp->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_hp"))
			$this->hp->setOldValue($CurrentForm->getValue("o_hp"));

		// Check field name 'produk' first before field var 'x_produk'
		$val = $CurrentForm->hasValue("produk") ? $CurrentForm->getValue("produk") : $CurrentForm->getValue("x_produk");
		if (!$this->produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->produk->Visible = FALSE; // Disable update for API request
			else
				$this->produk->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_produk"))
			$this->produk->setOldValue($CurrentForm->getValue("o_produk"));

		// Check field name 'cara_bayar' first before field var 'x_cara_bayar'
		$val = $CurrentForm->hasValue("cara_bayar") ? $CurrentForm->getValue("cara_bayar") : $CurrentForm->getValue("x_cara_bayar");
		if (!$this->cara_bayar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->cara_bayar->Visible = FALSE; // Disable update for API request
			else
				$this->cara_bayar->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_cara_bayar"))
			$this->cara_bayar->setOldValue($CurrentForm->getValue("o_cara_bayar"));

		// Check field name 'ket_bayar' first before field var 'x_ket_bayar'
		$val = $CurrentForm->hasValue("ket_bayar") ? $CurrentForm->getValue("ket_bayar") : $CurrentForm->getValue("x_ket_bayar");
		if (!$this->ket_bayar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ket_bayar->Visible = FALSE; // Disable update for API request
			else
				$this->ket_bayar->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ket_bayar"))
			$this->ket_bayar->setOldValue($CurrentForm->getValue("o_ket_bayar"));

		// Check field name 'tgl_bayar' first before field var 'x_tgl_bayar'
		$val = $CurrentForm->hasValue("tgl_bayar") ? $CurrentForm->getValue("tgl_bayar") : $CurrentForm->getValue("x_tgl_bayar");
		if (!$this->tgl_bayar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_bayar->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_bayar->setFormValue($val);
			$this->tgl_bayar->CurrentValue = UnFormatDateTime($this->tgl_bayar->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_tgl_bayar"))
			$this->tgl_bayar->setOldValue($CurrentForm->getValue("o_tgl_bayar"));

		// Check field name 'kdinformasi' first before field var 'x_kdinformasi'
		$val = $CurrentForm->hasValue("kdinformasi") ? $CurrentForm->getValue("kdinformasi") : $CurrentForm->getValue("x_kdinformasi");
		if (!$this->kdinformasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdinformasi->Visible = FALSE; // Disable update for API request
			else
				$this->kdinformasi->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdinformasi"))
			$this->kdinformasi->setOldValue($CurrentForm->getValue("o_kdinformasi"));

		// Check field name 'konfirmasi' first before field var 'x_konfirmasi'
		$val = $CurrentForm->hasValue("konfirmasi") ? $CurrentForm->getValue("konfirmasi") : $CurrentForm->getValue("x_konfirmasi");
		if (!$this->konfirmasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->konfirmasi->Visible = FALSE; // Disable update for API request
			else
				$this->konfirmasi->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_konfirmasi"))
			$this->konfirmasi->setOldValue($CurrentForm->getValue("o_konfirmasi"));

		// Check field name 'ket' first before field var 'x_ket'
		$val = $CurrentForm->hasValue("ket") ? $CurrentForm->getValue("ket") : $CurrentForm->getValue("x_ket");
		if (!$this->ket->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ket->Visible = FALSE; // Disable update for API request
			else
				$this->ket->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ket"))
			$this->ket->setOldValue($CurrentForm->getValue("o_ket"));

		// Check field name 'ket_lainnya' first before field var 'x_ket_lainnya'
		$val = $CurrentForm->hasValue("ket_lainnya") ? $CurrentForm->getValue("ket_lainnya") : $CurrentForm->getValue("x_ket_lainnya");
		if (!$this->ket_lainnya->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ket_lainnya->Visible = FALSE; // Disable update for API request
			else
				$this->ket_lainnya->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ket_lainnya"))
			$this->ket_lainnya->setOldValue($CurrentForm->getValue("o_ket_lainnya"));

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id->CurrentValue = $this->id->FormValue;
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->perusahaan->CurrentValue = $this->perusahaan->FormValue;
		$this->jabatan->CurrentValue = $this->jabatan->FormValue;
		$this->tgl_daftar->CurrentValue = $this->tgl_daftar->FormValue;
		$this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 0);
		$this->telp->CurrentValue = $this->telp->FormValue;
		$this->fax->CurrentValue = $this->fax->FormValue;
		$this->hp->CurrentValue = $this->hp->FormValue;
		$this->produk->CurrentValue = $this->produk->FormValue;
		$this->cara_bayar->CurrentValue = $this->cara_bayar->FormValue;
		$this->ket_bayar->CurrentValue = $this->ket_bayar->FormValue;
		$this->tgl_bayar->CurrentValue = $this->tgl_bayar->FormValue;
		$this->tgl_bayar->CurrentValue = UnFormatDateTime($this->tgl_bayar->CurrentValue, 0);
		$this->kdinformasi->CurrentValue = $this->kdinformasi->FormValue;
		$this->konfirmasi->CurrentValue = $this->konfirmasi->FormValue;
		$this->ket->CurrentValue = $this->ket->FormValue;
		$this->ket_lainnya->CurrentValue = $this->ket_lainnya->FormValue;
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
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['idpelat'] = $this->idpelat->CurrentValue;
		$row['kdjudul'] = $this->kdjudul->CurrentValue;
		$row['tgl_pel'] = $this->tgl_pel->CurrentValue;
		$row['nama'] = $this->nama->CurrentValue;
		$row['perusahaan'] = $this->perusahaan->CurrentValue;
		$row['jabatan'] = $this->jabatan->CurrentValue;
		$row['tgl_daftar'] = $this->tgl_daftar->CurrentValue;
		$row['telp'] = $this->telp->CurrentValue;
		$row['fax'] = $this->fax->CurrentValue;
		$row['hp'] = $this->hp->CurrentValue;
		$row['produk'] = $this->produk->CurrentValue;
		$row['cara_bayar'] = $this->cara_bayar->CurrentValue;
		$row['ket_bayar'] = $this->ket_bayar->CurrentValue;
		$row['tgl_bayar'] = $this->tgl_bayar->CurrentValue;
		$row['kdinformasi'] = $this->kdinformasi->CurrentValue;
		$row['konfirmasi'] = $this->konfirmasi->CurrentValue;
		$row['ket'] = $this->ket->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['ket_lainnya'] = $this->ket_lainnya->CurrentValue;
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
				$this->id->OldValue = strval($keys[0]); // id
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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// perusahaan
			$this->perusahaan->EditAttrs["class"] = "form-control";
			$this->perusahaan->EditCustomAttributes = "";
			if (!$this->perusahaan->Raw)
				$this->perusahaan->CurrentValue = HtmlDecode($this->perusahaan->CurrentValue);
			$this->perusahaan->EditValue = HtmlEncode($this->perusahaan->CurrentValue);
			$this->perusahaan->PlaceHolder = RemoveHtml($this->perusahaan->caption());

			// jabatan
			$this->jabatan->EditAttrs["class"] = "form-control";
			$this->jabatan->EditCustomAttributes = "";
			if (!$this->jabatan->Raw)
				$this->jabatan->CurrentValue = HtmlDecode($this->jabatan->CurrentValue);
			$this->jabatan->EditValue = HtmlEncode($this->jabatan->CurrentValue);
			$curVal = strval($this->jabatan->CurrentValue);
			if ($curVal != "") {
				$this->jabatan->EditValue = $this->jabatan->lookupCacheOption($curVal);
				if ($this->jabatan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->jabatan->EditValue = $this->jabatan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan->EditValue = HtmlEncode($this->jabatan->CurrentValue);
					}
				}
			} else {
				$this->jabatan->EditValue = NULL;
			}
			$this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());

			// tgl_daftar
			$this->tgl_daftar->EditAttrs["class"] = "form-control";
			$this->tgl_daftar->EditCustomAttributes = "";
			$this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime($this->tgl_daftar->CurrentValue, 8));
			$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			if (!$this->telp->Raw)
				$this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
			$this->telp->EditValue = HtmlEncode($this->telp->CurrentValue);
			$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			if (!$this->fax->Raw)
				$this->fax->CurrentValue = HtmlDecode($this->fax->CurrentValue);
			$this->fax->EditValue = HtmlEncode($this->fax->CurrentValue);
			$this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
			$this->hp->EditValue = HtmlEncode($this->hp->CurrentValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "";
			if (!$this->produk->Raw)
				$this->produk->CurrentValue = HtmlDecode($this->produk->CurrentValue);
			$this->produk->EditValue = HtmlEncode($this->produk->CurrentValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// cara_bayar
			$this->cara_bayar->EditCustomAttributes = "";
			$this->cara_bayar->EditValue = $this->cara_bayar->options(FALSE);

			// ket_bayar
			$this->ket_bayar->EditAttrs["class"] = "form-control";
			$this->ket_bayar->EditCustomAttributes = "";
			$this->ket_bayar->EditValue = HtmlEncode($this->ket_bayar->CurrentValue);
			$this->ket_bayar->PlaceHolder = RemoveHtml($this->ket_bayar->caption());

			// tgl_bayar
			$this->tgl_bayar->EditAttrs["class"] = "form-control";
			$this->tgl_bayar->EditCustomAttributes = "";
			$this->tgl_bayar->EditValue = HtmlEncode(FormatDateTime($this->tgl_bayar->CurrentValue, 8));
			$this->tgl_bayar->PlaceHolder = RemoveHtml($this->tgl_bayar->caption());

			// kdinformasi
			$this->kdinformasi->EditAttrs["class"] = "form-control";
			$this->kdinformasi->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdinformasi->CurrentValue));
			if ($curVal != "")
				$this->kdinformasi->ViewValue = $this->kdinformasi->lookupCacheOption($curVal);
			else
				$this->kdinformasi->ViewValue = $this->kdinformasi->Lookup !== NULL && is_array($this->kdinformasi->Lookup->Options) ? $curVal : NULL;
			if ($this->kdinformasi->ViewValue !== NULL) { // Load from cache
				$this->kdinformasi->EditValue = array_values($this->kdinformasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdinformasi`" . SearchString("=", $this->kdinformasi->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdinformasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdinformasi->EditValue = $arwrk;
			}

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
			$this->ket_lainnya->EditValue = HtmlEncode($this->ket_lainnya->CurrentValue);
			$this->ket_lainnya->PlaceHolder = RemoveHtml($this->ket_lainnya->caption());

			// Add refer script
			// nama

			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// perusahaan
			$this->perusahaan->LinkCustomAttributes = "";
			$this->perusahaan->HrefValue = "";

			// jabatan
			$this->jabatan->LinkCustomAttributes = "";
			$this->jabatan->HrefValue = "";

			// tgl_daftar
			$this->tgl_daftar->LinkCustomAttributes = "";
			$this->tgl_daftar->HrefValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";

			// cara_bayar
			$this->cara_bayar->LinkCustomAttributes = "";
			$this->cara_bayar->HrefValue = "";

			// ket_bayar
			$this->ket_bayar->LinkCustomAttributes = "";
			$this->ket_bayar->HrefValue = "";

			// tgl_bayar
			$this->tgl_bayar->LinkCustomAttributes = "";
			$this->tgl_bayar->HrefValue = "";

			// kdinformasi
			$this->kdinformasi->LinkCustomAttributes = "";
			$this->kdinformasi->HrefValue = "";

			// konfirmasi
			$this->konfirmasi->LinkCustomAttributes = "";
			$this->konfirmasi->HrefValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";

			// ket_lainnya
			$this->ket_lainnya->LinkCustomAttributes = "";
			$this->ket_lainnya->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// perusahaan
			$this->perusahaan->EditAttrs["class"] = "form-control";
			$this->perusahaan->EditCustomAttributes = "";
			if (!$this->perusahaan->Raw)
				$this->perusahaan->CurrentValue = HtmlDecode($this->perusahaan->CurrentValue);
			$this->perusahaan->EditValue = HtmlEncode($this->perusahaan->CurrentValue);
			$this->perusahaan->PlaceHolder = RemoveHtml($this->perusahaan->caption());

			// jabatan
			$this->jabatan->EditAttrs["class"] = "form-control";
			$this->jabatan->EditCustomAttributes = "";
			if (!$this->jabatan->Raw)
				$this->jabatan->CurrentValue = HtmlDecode($this->jabatan->CurrentValue);
			$this->jabatan->EditValue = HtmlEncode($this->jabatan->CurrentValue);
			$curVal = strval($this->jabatan->CurrentValue);
			if ($curVal != "") {
				$this->jabatan->EditValue = $this->jabatan->lookupCacheOption($curVal);
				if ($this->jabatan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->jabatan->EditValue = $this->jabatan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan->EditValue = HtmlEncode($this->jabatan->CurrentValue);
					}
				}
			} else {
				$this->jabatan->EditValue = NULL;
			}
			$this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());

			// tgl_daftar
			$this->tgl_daftar->EditAttrs["class"] = "form-control";
			$this->tgl_daftar->EditCustomAttributes = "";
			$this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime($this->tgl_daftar->CurrentValue, 8));
			$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			if (!$this->telp->Raw)
				$this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
			$this->telp->EditValue = HtmlEncode($this->telp->CurrentValue);
			$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			if (!$this->fax->Raw)
				$this->fax->CurrentValue = HtmlDecode($this->fax->CurrentValue);
			$this->fax->EditValue = HtmlEncode($this->fax->CurrentValue);
			$this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
			$this->hp->EditValue = HtmlEncode($this->hp->CurrentValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "";
			if (!$this->produk->Raw)
				$this->produk->CurrentValue = HtmlDecode($this->produk->CurrentValue);
			$this->produk->EditValue = HtmlEncode($this->produk->CurrentValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// cara_bayar
			$this->cara_bayar->EditCustomAttributes = "";
			$this->cara_bayar->EditValue = $this->cara_bayar->options(FALSE);

			// ket_bayar
			$this->ket_bayar->EditAttrs["class"] = "form-control";
			$this->ket_bayar->EditCustomAttributes = "";
			$this->ket_bayar->EditValue = HtmlEncode($this->ket_bayar->CurrentValue);
			$this->ket_bayar->PlaceHolder = RemoveHtml($this->ket_bayar->caption());

			// tgl_bayar
			$this->tgl_bayar->EditAttrs["class"] = "form-control";
			$this->tgl_bayar->EditCustomAttributes = "";
			$this->tgl_bayar->EditValue = HtmlEncode(FormatDateTime($this->tgl_bayar->CurrentValue, 8));
			$this->tgl_bayar->PlaceHolder = RemoveHtml($this->tgl_bayar->caption());

			// kdinformasi
			$this->kdinformasi->EditAttrs["class"] = "form-control";
			$this->kdinformasi->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdinformasi->CurrentValue));
			if ($curVal != "")
				$this->kdinformasi->ViewValue = $this->kdinformasi->lookupCacheOption($curVal);
			else
				$this->kdinformasi->ViewValue = $this->kdinformasi->Lookup !== NULL && is_array($this->kdinformasi->Lookup->Options) ? $curVal : NULL;
			if ($this->kdinformasi->ViewValue !== NULL) { // Load from cache
				$this->kdinformasi->EditValue = array_values($this->kdinformasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdinformasi`" . SearchString("=", $this->kdinformasi->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdinformasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdinformasi->EditValue = $arwrk;
			}

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
			$this->ket_lainnya->EditValue = HtmlEncode($this->ket_lainnya->CurrentValue);
			$this->ket_lainnya->PlaceHolder = RemoveHtml($this->ket_lainnya->caption());

			// Edit refer script
			// nama

			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// perusahaan
			$this->perusahaan->LinkCustomAttributes = "";
			$this->perusahaan->HrefValue = "";

			// jabatan
			$this->jabatan->LinkCustomAttributes = "";
			$this->jabatan->HrefValue = "";

			// tgl_daftar
			$this->tgl_daftar->LinkCustomAttributes = "";
			$this->tgl_daftar->HrefValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";

			// cara_bayar
			$this->cara_bayar->LinkCustomAttributes = "";
			$this->cara_bayar->HrefValue = "";

			// ket_bayar
			$this->ket_bayar->LinkCustomAttributes = "";
			$this->ket_bayar->HrefValue = "";

			// tgl_bayar
			$this->tgl_bayar->LinkCustomAttributes = "";
			$this->tgl_bayar->HrefValue = "";

			// kdinformasi
			$this->kdinformasi->LinkCustomAttributes = "";
			$this->kdinformasi->HrefValue = "";

			// konfirmasi
			$this->konfirmasi->LinkCustomAttributes = "";
			$this->konfirmasi->HrefValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";

			// ket_lainnya
			$this->ket_lainnya->LinkCustomAttributes = "";
			$this->ket_lainnya->HrefValue = "";
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
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->perusahaan->Required) {
			if (!$this->perusahaan->IsDetailKey && $this->perusahaan->FormValue != NULL && $this->perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->perusahaan->caption(), $this->perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->jabatan->Required) {
			if (!$this->jabatan->IsDetailKey && $this->jabatan->FormValue != NULL && $this->jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jabatan->caption(), $this->jabatan->RequiredErrorMessage));
			}
		}
		if ($this->tgl_daftar->Required) {
			if (!$this->tgl_daftar->IsDetailKey && $this->tgl_daftar->FormValue != NULL && $this->tgl_daftar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_daftar->caption(), $this->tgl_daftar->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_daftar->FormValue)) {
			AddMessage($FormError, $this->tgl_daftar->errorMessage());
		}
		if ($this->telp->Required) {
			if (!$this->telp->IsDetailKey && $this->telp->FormValue != NULL && $this->telp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telp->caption(), $this->telp->RequiredErrorMessage));
			}
		}
		if ($this->fax->Required) {
			if (!$this->fax->IsDetailKey && $this->fax->FormValue != NULL && $this->fax->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fax->caption(), $this->fax->RequiredErrorMessage));
			}
		}
		if ($this->hp->Required) {
			if (!$this->hp->IsDetailKey && $this->hp->FormValue != NULL && $this->hp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hp->caption(), $this->hp->RequiredErrorMessage));
			}
		}
		if ($this->produk->Required) {
			if (!$this->produk->IsDetailKey && $this->produk->FormValue != NULL && $this->produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->produk->caption(), $this->produk->RequiredErrorMessage));
			}
		}
		if ($this->cara_bayar->Required) {
			if ($this->cara_bayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cara_bayar->caption(), $this->cara_bayar->RequiredErrorMessage));
			}
		}
		if ($this->ket_bayar->Required) {
			if (!$this->ket_bayar->IsDetailKey && $this->ket_bayar->FormValue != NULL && $this->ket_bayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ket_bayar->caption(), $this->ket_bayar->RequiredErrorMessage));
			}
		}
		if ($this->tgl_bayar->Required) {
			if (!$this->tgl_bayar->IsDetailKey && $this->tgl_bayar->FormValue != NULL && $this->tgl_bayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_bayar->caption(), $this->tgl_bayar->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_bayar->FormValue)) {
			AddMessage($FormError, $this->tgl_bayar->errorMessage());
		}
		if ($this->kdinformasi->Required) {
			if (!$this->kdinformasi->IsDetailKey && $this->kdinformasi->FormValue != NULL && $this->kdinformasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdinformasi->caption(), $this->kdinformasi->RequiredErrorMessage));
			}
		}
		if ($this->konfirmasi->Required) {
			if (!$this->konfirmasi->IsDetailKey && $this->konfirmasi->FormValue != NULL && $this->konfirmasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->konfirmasi->caption(), $this->konfirmasi->RequiredErrorMessage));
			}
		}
		if ($this->ket->Required) {
			if (!$this->ket->IsDetailKey && $this->ket->FormValue != NULL && $this->ket->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ket->caption(), $this->ket->RequiredErrorMessage));
			}
		}
		if ($this->ket_lainnya->Required) {
			if (!$this->ket_lainnya->IsDetailKey && $this->ket_lainnya->FormValue != NULL && $this->ket_lainnya->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ket_lainnya->caption(), $this->ket_lainnya->RequiredErrorMessage));
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
				$thisKey .= $row['id'];
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

			// nama
			$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, NULL, $this->nama->ReadOnly);

			// perusahaan
			$this->perusahaan->setDbValueDef($rsnew, $this->perusahaan->CurrentValue, NULL, $this->perusahaan->ReadOnly);

			// jabatan
			$this->jabatan->setDbValueDef($rsnew, $this->jabatan->CurrentValue, NULL, $this->jabatan->ReadOnly);

			// tgl_daftar
			$this->tgl_daftar->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_daftar->CurrentValue, 0), NULL, $this->tgl_daftar->ReadOnly);

			// telp
			$this->telp->setDbValueDef($rsnew, $this->telp->CurrentValue, NULL, $this->telp->ReadOnly);

			// fax
			$this->fax->setDbValueDef($rsnew, $this->fax->CurrentValue, NULL, $this->fax->ReadOnly);

			// hp
			$this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, NULL, $this->hp->ReadOnly);

			// produk
			$this->produk->setDbValueDef($rsnew, $this->produk->CurrentValue, NULL, $this->produk->ReadOnly);

			// cara_bayar
			$this->cara_bayar->setDbValueDef($rsnew, $this->cara_bayar->CurrentValue, NULL, $this->cara_bayar->ReadOnly);

			// ket_bayar
			$this->ket_bayar->setDbValueDef($rsnew, $this->ket_bayar->CurrentValue, NULL, $this->ket_bayar->ReadOnly);

			// tgl_bayar
			$this->tgl_bayar->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_bayar->CurrentValue, 0), NULL, $this->tgl_bayar->ReadOnly);

			// kdinformasi
			$this->kdinformasi->setDbValueDef($rsnew, $this->kdinformasi->CurrentValue, NULL, $this->kdinformasi->ReadOnly);

			// konfirmasi
			$this->konfirmasi->setDbValueDef($rsnew, $this->konfirmasi->CurrentValue, NULL, $this->konfirmasi->ReadOnly);

			// ket
			$this->ket->setDbValueDef($rsnew, $this->ket->CurrentValue, NULL, $this->ket->ReadOnly);

			// ket_lainnya
			$this->ket_lainnya->setDbValueDef($rsnew, $this->ket_lainnya->CurrentValue, NULL, $this->ket_lainnya->ReadOnly);

			// Check referential integrity for master table 'cv_pelrepes'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_cv_pelrepes();
			$keyValue = isset($rsnew['idpelat']) ? $rsnew['idpelat'] : $rsold['idpelat'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@idpelat@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["cv_pelrepes"]))
					$GLOBALS["cv_pelrepes"] = new cv_pelrepes();
				$rsmaster = $GLOBALS["cv_pelrepes"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "cv_pelrepes", $Language->phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "cv_pelrepes") {
				$this->idpelat->CurrentValue = $this->idpelat->getSessionValue();
			}

		// Check referential integrity for master table 't_repeserta'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_cv_pelrepes();
		if ($this->idpelat->getSessionValue() != "") {
			$masterFilter = str_replace("@idpelat@", AdjustSql($this->idpelat->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["cv_pelrepes"]))
				$GLOBALS["cv_pelrepes"] = new cv_pelrepes();
			$rsmaster = $GLOBALS["cv_pelrepes"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "cv_pelrepes", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// nama
		$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, NULL, FALSE);

		// perusahaan
		$this->perusahaan->setDbValueDef($rsnew, $this->perusahaan->CurrentValue, NULL, FALSE);

		// jabatan
		$this->jabatan->setDbValueDef($rsnew, $this->jabatan->CurrentValue, NULL, FALSE);

		// tgl_daftar
		$this->tgl_daftar->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_daftar->CurrentValue, 0), NULL, FALSE);

		// telp
		$this->telp->setDbValueDef($rsnew, $this->telp->CurrentValue, NULL, FALSE);

		// fax
		$this->fax->setDbValueDef($rsnew, $this->fax->CurrentValue, NULL, FALSE);

		// hp
		$this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, NULL, FALSE);

		// produk
		$this->produk->setDbValueDef($rsnew, $this->produk->CurrentValue, NULL, FALSE);

		// cara_bayar
		$this->cara_bayar->setDbValueDef($rsnew, $this->cara_bayar->CurrentValue, NULL, FALSE);

		// ket_bayar
		$this->ket_bayar->setDbValueDef($rsnew, $this->ket_bayar->CurrentValue, NULL, FALSE);

		// tgl_bayar
		$this->tgl_bayar->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_bayar->CurrentValue, 0), NULL, FALSE);

		// kdinformasi
		$this->kdinformasi->setDbValueDef($rsnew, $this->kdinformasi->CurrentValue, NULL, FALSE);

		// konfirmasi
		$this->konfirmasi->setDbValueDef($rsnew, $this->konfirmasi->CurrentValue, NULL, FALSE);

		// ket
		$this->ket->setDbValueDef($rsnew, $this->ket->CurrentValue, NULL, FALSE);

		// ket_lainnya
		$this->ket_lainnya->setDbValueDef($rsnew, $this->ket_lainnya->CurrentValue, NULL, FALSE);

		// idpelat
		if ($this->idpelat->getSessionValue() != "") {
			$rsnew['idpelat'] = $this->idpelat->getSessionValue();
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
		if ($masterTblVar == "cv_pelrepes") {
			$this->idpelat->Visible = FALSE;
			if ($GLOBALS["cv_pelrepes"]->EventCancelled)
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
} // End class
?>