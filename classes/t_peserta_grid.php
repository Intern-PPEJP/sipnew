<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_peserta_grid extends t_peserta
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_peserta';

	// Page object name
	public $PageObjName = "t_peserta_grid";

	// Grid form hidden field names
	public $FormName = "ft_pesertagrid";
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

		// Table object (t_peserta)
		if (!isset($GLOBALS["t_peserta"]) || get_class($GLOBALS["t_peserta"]) == PROJECT_NAMESPACE . "t_peserta") {
			$GLOBALS["t_peserta"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["t_peserta"];

		}
		$this->AddUrl = "t_pesertaadd.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_peserta');

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
		global $t_peserta;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_peserta);
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
			$this->created_at->Visible = FALSE;
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
	public $cv_historipelatihanpeserta_Count;
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
		$this->id->setVisibility();
		$this->nama->setVisibility();
		$this->idp->setVisibility();
		$this->tempat->setVisibility();
		$this->tlahir->Visible = FALSE;
		$this->usia->Visible = FALSE;
		$this->kdagama->setVisibility();
		$this->kdsex->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->alamat->setVisibility();
		$this->kdpos->Visible = FALSE;
		$this->telp->setVisibility();
		$this->hp->setVisibility();
		$this->_email->Visible = FALSE;
		$this->kdjabat->setVisibility();
		$this->kdpend->setVisibility();
		$this->kdbahasa->setVisibility();
		$this->kdinformasi->Visible = FALSE;
		$this->harapan->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->jpelatihan->setVisibility();
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
		$this->setupLookupOptions($this->idp);
		$this->setupLookupOptions($this->kdagama);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);
		$this->setupLookupOptions($this->kdkec);
		$this->setupLookupOptions($this->kdjabat);
		$this->setupLookupOptions($this->kdpend);
		$this->setupLookupOptions($this->kdbahasa);
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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_perusahaan") {
			global $t_perusahaan;
			$rsmaster = $t_perusahaan->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("t_perusahaanlist.php"); // Return to master page
			} else {
				$t_perusahaan->loadListRowValues($rsmaster);
				$t_perusahaan->RowType = ROWTYPE_MASTER; // Master row
				$t_perusahaan->renderListRow();
				$rsmaster->close();
			}
		}

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_kota") {
			global $t_kota;
			$rsmaster = $t_kota->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("t_kotalist.php"); // Return to master page
			} else {
				$t_kota->loadListRowValues($rsmaster);
				$t_kota->RowType = ROWTYPE_MASTER; // Master row
				$t_kota->renderListRow();
				$rsmaster->close();
			}
		}

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_prop") {
			global $t_prop;
			$rsmaster = $t_prop->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("t_proplist.php"); // Return to master page
			} else {
				$t_prop->loadListRowValues($rsmaster);
				$t_prop->RowType = ROWTYPE_MASTER; // Master row
				$t_prop->renderListRow();
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
		if ($CurrentForm->hasValue("x_idp") && $CurrentForm->hasValue("o_idp") && $this->idp->CurrentValue != $this->idp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tempat") && $CurrentForm->hasValue("o_tempat") && $this->tempat->CurrentValue != $this->tempat->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdagama") && $CurrentForm->hasValue("o_kdagama") && $this->kdagama->CurrentValue != $this->kdagama->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdsex") && $CurrentForm->hasValue("o_kdsex") && $this->kdsex->CurrentValue != $this->kdsex->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdprop") && $CurrentForm->hasValue("o_kdprop") && $this->kdprop->CurrentValue != $this->kdprop->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdkota") && $CurrentForm->hasValue("o_kdkota") && $this->kdkota->CurrentValue != $this->kdkota->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdkec") && $CurrentForm->hasValue("o_kdkec") && $this->kdkec->CurrentValue != $this->kdkec->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_alamat") && $CurrentForm->hasValue("o_alamat") && $this->alamat->CurrentValue != $this->alamat->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_telp") && $CurrentForm->hasValue("o_telp") && $this->telp->CurrentValue != $this->telp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_hp") && $CurrentForm->hasValue("o_hp") && $this->hp->CurrentValue != $this->hp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdjabat") && $CurrentForm->hasValue("o_kdjabat") && $this->kdjabat->CurrentValue != $this->kdjabat->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdpend") && $CurrentForm->hasValue("o_kdpend") && $this->kdpend->CurrentValue != $this->kdpend->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kdbahasa") && $CurrentForm->hasValue("o_kdbahasa") && $this->kdbahasa->CurrentValue != $this->kdbahasa->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jpelatihan") && $CurrentForm->hasValue("o_jpelatihan") && $this->jpelatihan->CurrentValue != $this->jpelatihan->OldValue)
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
				$this->nama->setSort("ASC");
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
				$this->idp->setSessionValue("");
				$this->kdkota->setSessionValue("");
				$this->kdprop->setSessionValue("");
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
		$this->nama->CurrentValue = NULL;
		$this->nama->OldValue = $this->nama->CurrentValue;
		$this->idp->CurrentValue = NULL;
		$this->idp->OldValue = $this->idp->CurrentValue;
		$this->tempat->CurrentValue = NULL;
		$this->tempat->OldValue = $this->tempat->CurrentValue;
		$this->tlahir->CurrentValue = NULL;
		$this->tlahir->OldValue = $this->tlahir->CurrentValue;
		$this->usia->CurrentValue = NULL;
		$this->usia->OldValue = $this->usia->CurrentValue;
		$this->kdagama->CurrentValue = NULL;
		$this->kdagama->OldValue = $this->kdagama->CurrentValue;
		$this->kdsex->CurrentValue = NULL;
		$this->kdsex->OldValue = $this->kdsex->CurrentValue;
		$this->kdprop->CurrentValue = NULL;
		$this->kdprop->OldValue = $this->kdprop->CurrentValue;
		$this->kdkota->CurrentValue = NULL;
		$this->kdkota->OldValue = $this->kdkota->CurrentValue;
		$this->kdkec->CurrentValue = NULL;
		$this->kdkec->OldValue = $this->kdkec->CurrentValue;
		$this->alamat->CurrentValue = NULL;
		$this->alamat->OldValue = $this->alamat->CurrentValue;
		$this->kdpos->CurrentValue = NULL;
		$this->kdpos->OldValue = $this->kdpos->CurrentValue;
		$this->telp->CurrentValue = NULL;
		$this->telp->OldValue = $this->telp->CurrentValue;
		$this->hp->CurrentValue = NULL;
		$this->hp->OldValue = $this->hp->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->kdjabat->CurrentValue = NULL;
		$this->kdjabat->OldValue = $this->kdjabat->CurrentValue;
		$this->kdpend->CurrentValue = NULL;
		$this->kdpend->OldValue = $this->kdpend->CurrentValue;
		$this->kdbahasa->CurrentValue = NULL;
		$this->kdbahasa->OldValue = $this->kdbahasa->CurrentValue;
		$this->kdinformasi->CurrentValue = NULL;
		$this->kdinformasi->OldValue = $this->kdinformasi->CurrentValue;
		$this->harapan->CurrentValue = NULL;
		$this->harapan->OldValue = $this->harapan->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
		$this->jpelatihan->CurrentValue = NULL;
		$this->jpelatihan->OldValue = $this->jpelatihan->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id->setFormValue($val);

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

		// Check field name 'idp' first before field var 'x_idp'
		$val = $CurrentForm->hasValue("idp") ? $CurrentForm->getValue("idp") : $CurrentForm->getValue("x_idp");
		if (!$this->idp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idp->Visible = FALSE; // Disable update for API request
			else
				$this->idp->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_idp"))
			$this->idp->setOldValue($CurrentForm->getValue("o_idp"));

		// Check field name 'tempat' first before field var 'x_tempat'
		$val = $CurrentForm->hasValue("tempat") ? $CurrentForm->getValue("tempat") : $CurrentForm->getValue("x_tempat");
		if (!$this->tempat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tempat->Visible = FALSE; // Disable update for API request
			else
				$this->tempat->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tempat"))
			$this->tempat->setOldValue($CurrentForm->getValue("o_tempat"));

		// Check field name 'kdagama' first before field var 'x_kdagama'
		$val = $CurrentForm->hasValue("kdagama") ? $CurrentForm->getValue("kdagama") : $CurrentForm->getValue("x_kdagama");
		if (!$this->kdagama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdagama->Visible = FALSE; // Disable update for API request
			else
				$this->kdagama->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdagama"))
			$this->kdagama->setOldValue($CurrentForm->getValue("o_kdagama"));

		// Check field name 'kdsex' first before field var 'x_kdsex'
		$val = $CurrentForm->hasValue("kdsex") ? $CurrentForm->getValue("kdsex") : $CurrentForm->getValue("x_kdsex");
		if (!$this->kdsex->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdsex->Visible = FALSE; // Disable update for API request
			else
				$this->kdsex->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdsex"))
			$this->kdsex->setOldValue($CurrentForm->getValue("o_kdsex"));

		// Check field name 'kdprop' first before field var 'x_kdprop'
		$val = $CurrentForm->hasValue("kdprop") ? $CurrentForm->getValue("kdprop") : $CurrentForm->getValue("x_kdprop");
		if (!$this->kdprop->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdprop->Visible = FALSE; // Disable update for API request
			else
				$this->kdprop->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdprop"))
			$this->kdprop->setOldValue($CurrentForm->getValue("o_kdprop"));

		// Check field name 'kdkota' first before field var 'x_kdkota'
		$val = $CurrentForm->hasValue("kdkota") ? $CurrentForm->getValue("kdkota") : $CurrentForm->getValue("x_kdkota");
		if (!$this->kdkota->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkota->Visible = FALSE; // Disable update for API request
			else
				$this->kdkota->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdkota"))
			$this->kdkota->setOldValue($CurrentForm->getValue("o_kdkota"));

		// Check field name 'kdkec' first before field var 'x_kdkec'
		$val = $CurrentForm->hasValue("kdkec") ? $CurrentForm->getValue("kdkec") : $CurrentForm->getValue("x_kdkec");
		if (!$this->kdkec->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkec->Visible = FALSE; // Disable update for API request
			else
				$this->kdkec->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdkec"))
			$this->kdkec->setOldValue($CurrentForm->getValue("o_kdkec"));

		// Check field name 'alamat' first before field var 'x_alamat'
		$val = $CurrentForm->hasValue("alamat") ? $CurrentForm->getValue("alamat") : $CurrentForm->getValue("x_alamat");
		if (!$this->alamat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alamat->Visible = FALSE; // Disable update for API request
			else
				$this->alamat->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_alamat"))
			$this->alamat->setOldValue($CurrentForm->getValue("o_alamat"));

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

		// Check field name 'kdjabat' first before field var 'x_kdjabat'
		$val = $CurrentForm->hasValue("kdjabat") ? $CurrentForm->getValue("kdjabat") : $CurrentForm->getValue("x_kdjabat");
		if (!$this->kdjabat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdjabat->Visible = FALSE; // Disable update for API request
			else
				$this->kdjabat->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdjabat"))
			$this->kdjabat->setOldValue($CurrentForm->getValue("o_kdjabat"));

		// Check field name 'kdpend' first before field var 'x_kdpend'
		$val = $CurrentForm->hasValue("kdpend") ? $CurrentForm->getValue("kdpend") : $CurrentForm->getValue("x_kdpend");
		if (!$this->kdpend->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdpend->Visible = FALSE; // Disable update for API request
			else
				$this->kdpend->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdpend"))
			$this->kdpend->setOldValue($CurrentForm->getValue("o_kdpend"));

		// Check field name 'kdbahasa' first before field var 'x_kdbahasa'
		$val = $CurrentForm->hasValue("kdbahasa") ? $CurrentForm->getValue("kdbahasa") : $CurrentForm->getValue("x_kdbahasa");
		if (!$this->kdbahasa->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdbahasa->Visible = FALSE; // Disable update for API request
			else
				$this->kdbahasa->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdbahasa"))
			$this->kdbahasa->setOldValue($CurrentForm->getValue("o_kdbahasa"));

		// Check field name 'jpelatihan' first before field var 'x_jpelatihan'
		$val = $CurrentForm->hasValue("jpelatihan") ? $CurrentForm->getValue("jpelatihan") : $CurrentForm->getValue("x_jpelatihan");
		if (!$this->jpelatihan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jpelatihan->Visible = FALSE; // Disable update for API request
			else
				$this->jpelatihan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jpelatihan"))
			$this->jpelatihan->setOldValue($CurrentForm->getValue("o_jpelatihan"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id->CurrentValue = $this->id->FormValue;
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->idp->CurrentValue = $this->idp->FormValue;
		$this->tempat->CurrentValue = $this->tempat->FormValue;
		$this->kdagama->CurrentValue = $this->kdagama->FormValue;
		$this->kdsex->CurrentValue = $this->kdsex->FormValue;
		$this->kdprop->CurrentValue = $this->kdprop->FormValue;
		$this->kdkota->CurrentValue = $this->kdkota->FormValue;
		$this->kdkec->CurrentValue = $this->kdkec->FormValue;
		$this->alamat->CurrentValue = $this->alamat->FormValue;
		$this->telp->CurrentValue = $this->telp->FormValue;
		$this->hp->CurrentValue = $this->hp->FormValue;
		$this->kdjabat->CurrentValue = $this->kdjabat->FormValue;
		$this->kdpend->CurrentValue = $this->kdpend->FormValue;
		$this->kdbahasa->CurrentValue = $this->kdbahasa->FormValue;
		$this->jpelatihan->CurrentValue = $this->jpelatihan->FormValue;
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
		$this->id->setDbValue($row['id']);
		$this->nama->setDbValue($row['nama']);
		$this->idp->setDbValue($row['idp']);
		if (array_key_exists('EV__idp', $rs->fields)) {
			$this->idp->VirtualValue = $rs->fields('EV__idp'); // Set up virtual field value
		} else {
			$this->idp->VirtualValue = ""; // Clear value
		}
		$this->tempat->setDbValue($row['tempat']);
		$this->tlahir->setDbValue($row['tlahir']);
		$this->usia->setDbValue($row['usia']);
		$this->kdagama->setDbValue($row['kdagama']);
		$this->kdsex->setDbValue($row['kdsex']);
		$this->kdprop->setDbValue($row['kdprop']);
		if (array_key_exists('EV__kdprop', $rs->fields)) {
			$this->kdprop->VirtualValue = $rs->fields('EV__kdprop'); // Set up virtual field value
		} else {
			$this->kdprop->VirtualValue = ""; // Clear value
		}
		$this->kdkota->setDbValue($row['kdkota']);
		if (array_key_exists('EV__kdkota', $rs->fields)) {
			$this->kdkota->VirtualValue = $rs->fields('EV__kdkota'); // Set up virtual field value
		} else {
			$this->kdkota->VirtualValue = ""; // Clear value
		}
		$this->kdkec->setDbValue($row['kdkec']);
		if (array_key_exists('EV__kdkec', $rs->fields)) {
			$this->kdkec->VirtualValue = $rs->fields('EV__kdkec'); // Set up virtual field value
		} else {
			$this->kdkec->VirtualValue = ""; // Clear value
		}
		$this->alamat->setDbValue($row['alamat']);
		$this->kdpos->setDbValue($row['kdpos']);
		$this->telp->setDbValue($row['telp']);
		$this->hp->setDbValue($row['hp']);
		$this->_email->setDbValue($row['email']);
		$this->kdjabat->setDbValue($row['kdjabat']);
		$this->kdpend->setDbValue($row['kdpend']);
		$this->kdbahasa->setDbValue($row['kdbahasa']);
		$this->kdinformasi->setDbValue($row['kdinformasi']);
		$this->harapan->setDbValue($row['harapan']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->jpelatihan->setDbValue($row['jpelatihan']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['nama'] = $this->nama->CurrentValue;
		$row['idp'] = $this->idp->CurrentValue;
		$row['tempat'] = $this->tempat->CurrentValue;
		$row['tlahir'] = $this->tlahir->CurrentValue;
		$row['usia'] = $this->usia->CurrentValue;
		$row['kdagama'] = $this->kdagama->CurrentValue;
		$row['kdsex'] = $this->kdsex->CurrentValue;
		$row['kdprop'] = $this->kdprop->CurrentValue;
		$row['kdkota'] = $this->kdkota->CurrentValue;
		$row['kdkec'] = $this->kdkec->CurrentValue;
		$row['alamat'] = $this->alamat->CurrentValue;
		$row['kdpos'] = $this->kdpos->CurrentValue;
		$row['telp'] = $this->telp->CurrentValue;
		$row['hp'] = $this->hp->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['kdjabat'] = $this->kdjabat->CurrentValue;
		$row['kdpend'] = $this->kdpend->CurrentValue;
		$row['kdbahasa'] = $this->kdbahasa->CurrentValue;
		$row['kdinformasi'] = $this->kdinformasi->CurrentValue;
		$row['harapan'] = $this->harapan->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		$row['jpelatihan'] = $this->jpelatihan->CurrentValue;
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
		// nama
		// idp
		// tempat
		// tlahir
		// usia

		$this->usia->CellCssStyle = "white-space: nowrap;";

		// kdagama
		// kdsex
		// kdprop
		// kdkota
		// kdkec
		// alamat
		// kdpos
		// telp
		// hp
		// email
		// kdjabat
		// kdpend
		// kdbahasa
		// kdinformasi
		// harapan
		// created_at
		// updated_at
		// jpelatihan

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$curVal = strval($this->id->CurrentValue);
			if ($curVal != "") {
				$this->id->ViewValue = $this->id->lookupCacheOption($curVal);
				if ($this->id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->id->ViewValue = $this->id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id->ViewValue = $this->id->CurrentValue;
					}
				}
			} else {
				$this->id->ViewValue = NULL;
			}
			$this->id->ViewCustomAttributes = "";

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// idp
			if ($this->idp->VirtualValue != "") {
				$this->idp->ViewValue = $this->idp->VirtualValue;
			} else {
				$this->idp->ViewValue = $this->idp->CurrentValue;
				$curVal = strval($this->idp->CurrentValue);
				if ($curVal != "") {
					$this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
					if ($this->idp->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->idp->ViewValue = $this->idp->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->idp->ViewValue = $this->idp->CurrentValue;
						}
					}
				} else {
					$this->idp->ViewValue = NULL;
				}
			}
			$this->idp->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// tlahir
			$this->tlahir->ViewValue = $this->tlahir->CurrentValue;
			$this->tlahir->ViewValue = FormatDateTime($this->tlahir->ViewValue, 0);
			$this->tlahir->ViewCustomAttributes = "";

			// kdagama
			$curVal = strval($this->kdagama->CurrentValue);
			if ($curVal != "") {
				$this->kdagama->ViewValue = $this->kdagama->lookupCacheOption($curVal);
				if ($this->kdagama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdagama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdagama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdagama->ViewValue = $this->kdagama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdagama->ViewValue = $this->kdagama->CurrentValue;
					}
				}
			} else {
				$this->kdagama->ViewValue = NULL;
			}
			$this->kdagama->ViewCustomAttributes = "";

			// kdsex
			if (strval($this->kdsex->CurrentValue) != "") {
				$this->kdsex->ViewValue = $this->kdsex->optionCaption($this->kdsex->CurrentValue);
			} else {
				$this->kdsex->ViewValue = NULL;
			}
			$this->kdsex->ViewCustomAttributes = "";

			// kdprop
			if ($this->kdprop->VirtualValue != "") {
				$this->kdprop->ViewValue = $this->kdprop->VirtualValue;
			} else {
				$curVal = strval($this->kdprop->CurrentValue);
				if ($curVal != "") {
					$this->kdprop->ViewValue = $this->kdprop->lookupCacheOption($curVal);
					if ($this->kdprop->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`kdprop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->kdprop->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdprop->ViewValue = $this->kdprop->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdprop->ViewValue = $this->kdprop->CurrentValue;
						}
					}
				} else {
					$this->kdprop->ViewValue = NULL;
				}
			}
			$this->kdprop->ViewCustomAttributes = "";

			// kdkota
			if ($this->kdkota->VirtualValue != "") {
				$this->kdkota->ViewValue = $this->kdkota->VirtualValue;
			} else {
				$curVal = strval($this->kdkota->CurrentValue);
				if ($curVal != "") {
					$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
					if ($this->kdkota->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->kdkota->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdkota->ViewValue = $this->kdkota->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdkota->ViewValue = $this->kdkota->CurrentValue;
						}
					}
				} else {
					$this->kdkota->ViewValue = NULL;
				}
			}
			$this->kdkota->ViewCustomAttributes = "";

			// kdkec
			if ($this->kdkec->VirtualValue != "") {
				$this->kdkec->ViewValue = $this->kdkec->VirtualValue;
			} else {
				$curVal = strval($this->kdkec->CurrentValue);
				if ($curVal != "") {
					$this->kdkec->ViewValue = $this->kdkec->lookupCacheOption($curVal);
					if ($this->kdkec->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`kdkec`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->kdkec->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdkec->ViewValue = $this->kdkec->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdkec->ViewValue = $this->kdkec->CurrentValue;
						}
					}
				} else {
					$this->kdkec->ViewValue = NULL;
				}
			}
			$this->kdkec->ViewCustomAttributes = "";

			// alamat
			$this->alamat->ViewValue = $this->alamat->CurrentValue;
			$this->alamat->ViewCustomAttributes = "";

			// kdpos
			$this->kdpos->ViewValue = $this->kdpos->CurrentValue;
			$this->kdpos->ViewCustomAttributes = "";

			// telp
			$this->telp->ViewValue = $this->telp->CurrentValue;
			$this->telp->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// kdjabat
			$curVal = strval($this->kdjabat->CurrentValue);
			if ($curVal != "") {
				$this->kdjabat->ViewValue = $this->kdjabat->lookupCacheOption($curVal);
				if ($this->kdjabat->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdjabat->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdjabat->ViewValue = $this->kdjabat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdjabat->ViewValue = $this->kdjabat->CurrentValue;
					}
				}
			} else {
				$this->kdjabat->ViewValue = NULL;
			}
			$this->kdjabat->ViewCustomAttributes = "";

			// kdpend
			$curVal = strval($this->kdpend->CurrentValue);
			if ($curVal != "") {
				$this->kdpend->ViewValue = $this->kdpend->lookupCacheOption($curVal);
				if ($this->kdpend->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdpend`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdpend->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdpend->ViewValue = $this->kdpend->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdpend->ViewValue = $this->kdpend->CurrentValue;
					}
				}
			} else {
				$this->kdpend->ViewValue = NULL;
			}
			$this->kdpend->ViewCustomAttributes = "";

			// kdbahasa
			$curVal = strval($this->kdbahasa->CurrentValue);
			if ($curVal != "") {
				$this->kdbahasa->ViewValue = $this->kdbahasa->lookupCacheOption($curVal);
				if ($this->kdbahasa->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdbahasa`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdbahasa->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdbahasa->ViewValue = $this->kdbahasa->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdbahasa->ViewValue = $this->kdbahasa->CurrentValue;
					}
				}
			} else {
				$this->kdbahasa->ViewValue = NULL;
			}
			$this->kdbahasa->ViewCustomAttributes = "";

			// jpelatihan
			$this->jpelatihan->ViewValue = $this->jpelatihan->CurrentValue;
			$this->jpelatihan->CellCssStyle .= "text-align: center;";
			$this->jpelatihan->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";
			if (!$this->isExport())
				$this->id->ViewValue = $this->highlightValue($this->id);

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";
			if (!$this->isExport())
				$this->nama->ViewValue = $this->highlightValue($this->nama);

			// idp
			$this->idp->LinkCustomAttributes = "";
			$this->idp->HrefValue = "";
			$this->idp->TooltipValue = "";
			if (!$this->isExport())
				$this->idp->ViewValue = $this->highlightValue($this->idp);

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";
			if (!$this->isExport())
				$this->tempat->ViewValue = $this->highlightValue($this->tempat);

			// kdagama
			$this->kdagama->LinkCustomAttributes = "";
			$this->kdagama->HrefValue = "";
			$this->kdagama->TooltipValue = "";

			// kdsex
			$this->kdsex->LinkCustomAttributes = "";
			$this->kdsex->HrefValue = "";
			$this->kdsex->TooltipValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";
			$this->kdprop->TooltipValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";
			$this->kdkota->TooltipValue = "";

			// kdkec
			$this->kdkec->LinkCustomAttributes = "";
			$this->kdkec->HrefValue = "";
			$this->kdkec->TooltipValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";
			$this->alamat->TooltipValue = "";
			if (!$this->isExport())
				$this->alamat->ViewValue = $this->highlightValue($this->alamat);

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";
			$this->telp->TooltipValue = "";
			if (!$this->isExport())
				$this->telp->ViewValue = $this->highlightValue($this->telp);

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";
			$this->hp->TooltipValue = "";
			if (!$this->isExport())
				$this->hp->ViewValue = $this->highlightValue($this->hp);

			// kdjabat
			$this->kdjabat->LinkCustomAttributes = "";
			$this->kdjabat->HrefValue = "";
			$this->kdjabat->TooltipValue = "";

			// kdpend
			$this->kdpend->LinkCustomAttributes = "";
			$this->kdpend->HrefValue = "";
			$this->kdpend->TooltipValue = "";

			// kdbahasa
			$this->kdbahasa->LinkCustomAttributes = "";
			$this->kdbahasa->HrefValue = "";
			$this->kdbahasa->TooltipValue = "";

			// jpelatihan
			$this->jpelatihan->LinkCustomAttributes = "";
			$this->jpelatihan->HrefValue = "";
			$this->jpelatihan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id
			// nama

			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// idp
			$this->idp->EditAttrs["class"] = "form-control";
			$this->idp->EditCustomAttributes = "";
			if ($this->idp->getSessionValue() != "") {
				$this->idp->CurrentValue = $this->idp->getSessionValue();
				$this->idp->OldValue = $this->idp->CurrentValue;
				if ($this->idp->VirtualValue != "") {
					$this->idp->ViewValue = $this->idp->VirtualValue;
				} else {
					$this->idp->ViewValue = $this->idp->CurrentValue;
					$curVal = strval($this->idp->CurrentValue);
					if ($curVal != "") {
						$this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
						if ($this->idp->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->idp->ViewValue = $this->idp->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->idp->ViewValue = $this->idp->CurrentValue;
							}
						}
					} else {
						$this->idp->ViewValue = NULL;
					}
				}
				$this->idp->ViewCustomAttributes = "";
			} else {
				$this->idp->EditValue = HtmlEncode($this->idp->CurrentValue);
				$curVal = strval($this->idp->CurrentValue);
				if ($curVal != "") {
					$this->idp->EditValue = $this->idp->lookupCacheOption($curVal);
					if ($this->idp->EditValue === NULL) { // Lookup from database
						$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->idp->EditValue = $this->idp->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->idp->EditValue = HtmlEncode($this->idp->CurrentValue);
						}
					}
				} else {
					$this->idp->EditValue = NULL;
				}
				$this->idp->PlaceHolder = RemoveHtml($this->idp->caption());
			}

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			if (!$this->tempat->Raw)
				$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
			$this->tempat->EditValue = HtmlEncode($this->tempat->CurrentValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// kdagama
			$this->kdagama->EditAttrs["class"] = "form-control";
			$this->kdagama->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdagama->CurrentValue));
			if ($curVal != "")
				$this->kdagama->ViewValue = $this->kdagama->lookupCacheOption($curVal);
			else
				$this->kdagama->ViewValue = $this->kdagama->Lookup !== NULL && is_array($this->kdagama->Lookup->Options) ? $curVal : NULL;
			if ($this->kdagama->ViewValue !== NULL) { // Load from cache
				$this->kdagama->EditValue = array_values($this->kdagama->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdagama`" . SearchString("=", $this->kdagama->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdagama->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdagama->EditValue = $arwrk;
			}

			// kdsex
			$this->kdsex->EditCustomAttributes = "";
			$this->kdsex->EditValue = $this->kdsex->options(FALSE);

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";
			if ($this->kdprop->getSessionValue() != "") {
				$this->kdprop->CurrentValue = $this->kdprop->getSessionValue();
				$this->kdprop->OldValue = $this->kdprop->CurrentValue;
				if ($this->kdprop->VirtualValue != "") {
					$this->kdprop->ViewValue = $this->kdprop->VirtualValue;
				} else {
					$curVal = strval($this->kdprop->CurrentValue);
					if ($curVal != "") {
						$this->kdprop->ViewValue = $this->kdprop->lookupCacheOption($curVal);
						if ($this->kdprop->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`kdprop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->kdprop->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->kdprop->ViewValue = $this->kdprop->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->kdprop->ViewValue = $this->kdprop->CurrentValue;
							}
						}
					} else {
						$this->kdprop->ViewValue = NULL;
					}
				}
				$this->kdprop->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->kdprop->CurrentValue));
				if ($curVal != "")
					$this->kdprop->ViewValue = $this->kdprop->lookupCacheOption($curVal);
				else
					$this->kdprop->ViewValue = $this->kdprop->Lookup !== NULL && is_array($this->kdprop->Lookup->Options) ? $curVal : NULL;
				if ($this->kdprop->ViewValue !== NULL) { // Load from cache
					$this->kdprop->EditValue = array_values($this->kdprop->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`kdprop`" . SearchString("=", $this->kdprop->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->kdprop->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->kdprop->EditValue = $arwrk;
				}
			}

			// kdkota
			$this->kdkota->EditAttrs["class"] = "form-control";
			$this->kdkota->EditCustomAttributes = "";
			if ($this->kdkota->getSessionValue() != "") {
				$this->kdkota->CurrentValue = $this->kdkota->getSessionValue();
				$this->kdkota->OldValue = $this->kdkota->CurrentValue;
				if ($this->kdkota->VirtualValue != "") {
					$this->kdkota->ViewValue = $this->kdkota->VirtualValue;
				} else {
					$curVal = strval($this->kdkota->CurrentValue);
					if ($curVal != "") {
						$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
						if ($this->kdkota->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->kdkota->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->kdkota->ViewValue = $this->kdkota->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->kdkota->ViewValue = $this->kdkota->CurrentValue;
							}
						}
					} else {
						$this->kdkota->ViewValue = NULL;
					}
				}
				$this->kdkota->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->kdkota->CurrentValue));
				if ($curVal != "")
					$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
				else
					$this->kdkota->ViewValue = $this->kdkota->Lookup !== NULL && is_array($this->kdkota->Lookup->Options) ? $curVal : NULL;
				if ($this->kdkota->ViewValue !== NULL) { // Load from cache
					$this->kdkota->EditValue = array_values($this->kdkota->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`kdkota`" . SearchString("=", $this->kdkota->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->kdkota->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->kdkota->EditValue = $arwrk;
				}
			}

			// kdkec
			$this->kdkec->EditAttrs["class"] = "form-control";
			$this->kdkec->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkec->CurrentValue));
			if ($curVal != "")
				$this->kdkec->ViewValue = $this->kdkec->lookupCacheOption($curVal);
			else
				$this->kdkec->ViewValue = $this->kdkec->Lookup !== NULL && is_array($this->kdkec->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkec->ViewValue !== NULL) { // Load from cache
				$this->kdkec->EditValue = array_values($this->kdkec->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkec`" . SearchString("=", $this->kdkec->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkec->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkec->EditValue = $arwrk;
			}

			// alamat
			$this->alamat->EditAttrs["class"] = "form-control";
			$this->alamat->EditCustomAttributes = "";
			$this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
			$this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			if (!$this->telp->Raw)
				$this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
			$this->telp->EditValue = HtmlEncode($this->telp->CurrentValue);
			$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
			$this->hp->EditValue = HtmlEncode($this->hp->CurrentValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// kdjabat
			$this->kdjabat->EditAttrs["class"] = "form-control";
			$this->kdjabat->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdjabat->CurrentValue));
			if ($curVal != "")
				$this->kdjabat->ViewValue = $this->kdjabat->lookupCacheOption($curVal);
			else
				$this->kdjabat->ViewValue = $this->kdjabat->Lookup !== NULL && is_array($this->kdjabat->Lookup->Options) ? $curVal : NULL;
			if ($this->kdjabat->ViewValue !== NULL) { // Load from cache
				$this->kdjabat->EditValue = array_values($this->kdjabat->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdjabat`" . SearchString("=", $this->kdjabat->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdjabat->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdjabat->EditValue = $arwrk;
			}

			// kdpend
			$this->kdpend->EditAttrs["class"] = "form-control";
			$this->kdpend->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdpend->CurrentValue));
			if ($curVal != "")
				$this->kdpend->ViewValue = $this->kdpend->lookupCacheOption($curVal);
			else
				$this->kdpend->ViewValue = $this->kdpend->Lookup !== NULL && is_array($this->kdpend->Lookup->Options) ? $curVal : NULL;
			if ($this->kdpend->ViewValue !== NULL) { // Load from cache
				$this->kdpend->EditValue = array_values($this->kdpend->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdpend`" . SearchString("=", $this->kdpend->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdpend->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdpend->EditValue = $arwrk;
			}

			// kdbahasa
			$this->kdbahasa->EditAttrs["class"] = "form-control";
			$this->kdbahasa->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdbahasa->CurrentValue));
			if ($curVal != "")
				$this->kdbahasa->ViewValue = $this->kdbahasa->lookupCacheOption($curVal);
			else
				$this->kdbahasa->ViewValue = $this->kdbahasa->Lookup !== NULL && is_array($this->kdbahasa->Lookup->Options) ? $curVal : NULL;
			if ($this->kdbahasa->ViewValue !== NULL) { // Load from cache
				$this->kdbahasa->EditValue = array_values($this->kdbahasa->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdbahasa`" . SearchString("=", $this->kdbahasa->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdbahasa->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdbahasa->EditValue = $arwrk;
			}

			// jpelatihan
			$this->jpelatihan->EditAttrs["class"] = "form-control";
			$this->jpelatihan->EditCustomAttributes = "";
			$this->jpelatihan->EditValue = HtmlEncode($this->jpelatihan->CurrentValue);
			$this->jpelatihan->PlaceHolder = RemoveHtml($this->jpelatihan->caption());

			// Add refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// idp
			$this->idp->LinkCustomAttributes = "";
			$this->idp->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";

			// kdagama
			$this->kdagama->LinkCustomAttributes = "";
			$this->kdagama->HrefValue = "";

			// kdsex
			$this->kdsex->LinkCustomAttributes = "";
			$this->kdsex->HrefValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";

			// kdkec
			$this->kdkec->LinkCustomAttributes = "";
			$this->kdkec->HrefValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";

			// kdjabat
			$this->kdjabat->LinkCustomAttributes = "";
			$this->kdjabat->HrefValue = "";

			// kdpend
			$this->kdpend->LinkCustomAttributes = "";
			$this->kdpend->HrefValue = "";

			// kdbahasa
			$this->kdbahasa->LinkCustomAttributes = "";
			$this->kdbahasa->HrefValue = "";

			// jpelatihan
			$this->jpelatihan->LinkCustomAttributes = "";
			$this->jpelatihan->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$curVal = strval($this->id->CurrentValue);
			if ($curVal != "") {
				$this->id->EditValue = $this->id->lookupCacheOption($curVal);
				if ($this->id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->id->EditValue = $this->id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id->EditValue = $this->id->CurrentValue;
					}
				}
			} else {
				$this->id->EditValue = NULL;
			}
			$this->id->ViewCustomAttributes = "";

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// idp
			$this->idp->EditAttrs["class"] = "form-control";
			$this->idp->EditCustomAttributes = "";
			if ($this->idp->getSessionValue() != "") {
				$this->idp->CurrentValue = $this->idp->getSessionValue();
				$this->idp->OldValue = $this->idp->CurrentValue;
				if ($this->idp->VirtualValue != "") {
					$this->idp->ViewValue = $this->idp->VirtualValue;
				} else {
					$this->idp->ViewValue = $this->idp->CurrentValue;
					$curVal = strval($this->idp->CurrentValue);
					if ($curVal != "") {
						$this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
						if ($this->idp->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->idp->ViewValue = $this->idp->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->idp->ViewValue = $this->idp->CurrentValue;
							}
						}
					} else {
						$this->idp->ViewValue = NULL;
					}
				}
				$this->idp->ViewCustomAttributes = "";
			} else {
				$this->idp->EditValue = HtmlEncode($this->idp->CurrentValue);
				$curVal = strval($this->idp->CurrentValue);
				if ($curVal != "") {
					$this->idp->EditValue = $this->idp->lookupCacheOption($curVal);
					if ($this->idp->EditValue === NULL) { // Lookup from database
						$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->idp->EditValue = $this->idp->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->idp->EditValue = HtmlEncode($this->idp->CurrentValue);
						}
					}
				} else {
					$this->idp->EditValue = NULL;
				}
				$this->idp->PlaceHolder = RemoveHtml($this->idp->caption());
			}

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			if (!$this->tempat->Raw)
				$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
			$this->tempat->EditValue = HtmlEncode($this->tempat->CurrentValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// kdagama
			$this->kdagama->EditAttrs["class"] = "form-control";
			$this->kdagama->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdagama->CurrentValue));
			if ($curVal != "")
				$this->kdagama->ViewValue = $this->kdagama->lookupCacheOption($curVal);
			else
				$this->kdagama->ViewValue = $this->kdagama->Lookup !== NULL && is_array($this->kdagama->Lookup->Options) ? $curVal : NULL;
			if ($this->kdagama->ViewValue !== NULL) { // Load from cache
				$this->kdagama->EditValue = array_values($this->kdagama->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdagama`" . SearchString("=", $this->kdagama->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdagama->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdagama->EditValue = $arwrk;
			}

			// kdsex
			$this->kdsex->EditCustomAttributes = "";
			$this->kdsex->EditValue = $this->kdsex->options(FALSE);

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";
			if ($this->kdprop->getSessionValue() != "") {
				$this->kdprop->CurrentValue = $this->kdprop->getSessionValue();
				$this->kdprop->OldValue = $this->kdprop->CurrentValue;
				if ($this->kdprop->VirtualValue != "") {
					$this->kdprop->ViewValue = $this->kdprop->VirtualValue;
				} else {
					$curVal = strval($this->kdprop->CurrentValue);
					if ($curVal != "") {
						$this->kdprop->ViewValue = $this->kdprop->lookupCacheOption($curVal);
						if ($this->kdprop->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`kdprop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->kdprop->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->kdprop->ViewValue = $this->kdprop->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->kdprop->ViewValue = $this->kdprop->CurrentValue;
							}
						}
					} else {
						$this->kdprop->ViewValue = NULL;
					}
				}
				$this->kdprop->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->kdprop->CurrentValue));
				if ($curVal != "")
					$this->kdprop->ViewValue = $this->kdprop->lookupCacheOption($curVal);
				else
					$this->kdprop->ViewValue = $this->kdprop->Lookup !== NULL && is_array($this->kdprop->Lookup->Options) ? $curVal : NULL;
				if ($this->kdprop->ViewValue !== NULL) { // Load from cache
					$this->kdprop->EditValue = array_values($this->kdprop->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`kdprop`" . SearchString("=", $this->kdprop->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->kdprop->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->kdprop->EditValue = $arwrk;
				}
			}

			// kdkota
			$this->kdkota->EditAttrs["class"] = "form-control";
			$this->kdkota->EditCustomAttributes = "";
			if ($this->kdkota->getSessionValue() != "") {
				$this->kdkota->CurrentValue = $this->kdkota->getSessionValue();
				$this->kdkota->OldValue = $this->kdkota->CurrentValue;
				if ($this->kdkota->VirtualValue != "") {
					$this->kdkota->ViewValue = $this->kdkota->VirtualValue;
				} else {
					$curVal = strval($this->kdkota->CurrentValue);
					if ($curVal != "") {
						$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
						if ($this->kdkota->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->kdkota->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->kdkota->ViewValue = $this->kdkota->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->kdkota->ViewValue = $this->kdkota->CurrentValue;
							}
						}
					} else {
						$this->kdkota->ViewValue = NULL;
					}
				}
				$this->kdkota->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->kdkota->CurrentValue));
				if ($curVal != "")
					$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
				else
					$this->kdkota->ViewValue = $this->kdkota->Lookup !== NULL && is_array($this->kdkota->Lookup->Options) ? $curVal : NULL;
				if ($this->kdkota->ViewValue !== NULL) { // Load from cache
					$this->kdkota->EditValue = array_values($this->kdkota->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`kdkota`" . SearchString("=", $this->kdkota->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->kdkota->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->kdkota->EditValue = $arwrk;
				}
			}

			// kdkec
			$this->kdkec->EditAttrs["class"] = "form-control";
			$this->kdkec->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkec->CurrentValue));
			if ($curVal != "")
				$this->kdkec->ViewValue = $this->kdkec->lookupCacheOption($curVal);
			else
				$this->kdkec->ViewValue = $this->kdkec->Lookup !== NULL && is_array($this->kdkec->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkec->ViewValue !== NULL) { // Load from cache
				$this->kdkec->EditValue = array_values($this->kdkec->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkec`" . SearchString("=", $this->kdkec->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkec->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkec->EditValue = $arwrk;
			}

			// alamat
			$this->alamat->EditAttrs["class"] = "form-control";
			$this->alamat->EditCustomAttributes = "";
			$this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
			$this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			if (!$this->telp->Raw)
				$this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
			$this->telp->EditValue = HtmlEncode($this->telp->CurrentValue);
			$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
			$this->hp->EditValue = HtmlEncode($this->hp->CurrentValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// kdjabat
			$this->kdjabat->EditAttrs["class"] = "form-control";
			$this->kdjabat->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdjabat->CurrentValue));
			if ($curVal != "")
				$this->kdjabat->ViewValue = $this->kdjabat->lookupCacheOption($curVal);
			else
				$this->kdjabat->ViewValue = $this->kdjabat->Lookup !== NULL && is_array($this->kdjabat->Lookup->Options) ? $curVal : NULL;
			if ($this->kdjabat->ViewValue !== NULL) { // Load from cache
				$this->kdjabat->EditValue = array_values($this->kdjabat->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdjabat`" . SearchString("=", $this->kdjabat->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdjabat->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdjabat->EditValue = $arwrk;
			}

			// kdpend
			$this->kdpend->EditAttrs["class"] = "form-control";
			$this->kdpend->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdpend->CurrentValue));
			if ($curVal != "")
				$this->kdpend->ViewValue = $this->kdpend->lookupCacheOption($curVal);
			else
				$this->kdpend->ViewValue = $this->kdpend->Lookup !== NULL && is_array($this->kdpend->Lookup->Options) ? $curVal : NULL;
			if ($this->kdpend->ViewValue !== NULL) { // Load from cache
				$this->kdpend->EditValue = array_values($this->kdpend->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdpend`" . SearchString("=", $this->kdpend->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdpend->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdpend->EditValue = $arwrk;
			}

			// kdbahasa
			$this->kdbahasa->EditAttrs["class"] = "form-control";
			$this->kdbahasa->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdbahasa->CurrentValue));
			if ($curVal != "")
				$this->kdbahasa->ViewValue = $this->kdbahasa->lookupCacheOption($curVal);
			else
				$this->kdbahasa->ViewValue = $this->kdbahasa->Lookup !== NULL && is_array($this->kdbahasa->Lookup->Options) ? $curVal : NULL;
			if ($this->kdbahasa->ViewValue !== NULL) { // Load from cache
				$this->kdbahasa->EditValue = array_values($this->kdbahasa->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdbahasa`" . SearchString("=", $this->kdbahasa->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdbahasa->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdbahasa->EditValue = $arwrk;
			}

			// jpelatihan
			$this->jpelatihan->EditAttrs["class"] = "form-control";
			$this->jpelatihan->EditCustomAttributes = "";

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// idp
			$this->idp->LinkCustomAttributes = "";
			$this->idp->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";

			// kdagama
			$this->kdagama->LinkCustomAttributes = "";
			$this->kdagama->HrefValue = "";

			// kdsex
			$this->kdsex->LinkCustomAttributes = "";
			$this->kdsex->HrefValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";

			// kdkec
			$this->kdkec->LinkCustomAttributes = "";
			$this->kdkec->HrefValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";

			// kdjabat
			$this->kdjabat->LinkCustomAttributes = "";
			$this->kdjabat->HrefValue = "";

			// kdpend
			$this->kdpend->LinkCustomAttributes = "";
			$this->kdpend->HrefValue = "";

			// kdbahasa
			$this->kdbahasa->LinkCustomAttributes = "";
			$this->kdbahasa->HrefValue = "";

			// jpelatihan
			$this->jpelatihan->LinkCustomAttributes = "";
			$this->jpelatihan->HrefValue = "";
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
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->idp->Required) {
			if (!$this->idp->IsDetailKey && $this->idp->FormValue != NULL && $this->idp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idp->caption(), $this->idp->RequiredErrorMessage));
			}
		}
		if ($this->tempat->Required) {
			if (!$this->tempat->IsDetailKey && $this->tempat->FormValue != NULL && $this->tempat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tempat->caption(), $this->tempat->RequiredErrorMessage));
			}
		}
		if ($this->kdagama->Required) {
			if (!$this->kdagama->IsDetailKey && $this->kdagama->FormValue != NULL && $this->kdagama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdagama->caption(), $this->kdagama->RequiredErrorMessage));
			}
		}
		if ($this->kdsex->Required) {
			if ($this->kdsex->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdsex->caption(), $this->kdsex->RequiredErrorMessage));
			}
		}
		if ($this->kdprop->Required) {
			if (!$this->kdprop->IsDetailKey && $this->kdprop->FormValue != NULL && $this->kdprop->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdprop->caption(), $this->kdprop->RequiredErrorMessage));
			}
		}
		if ($this->kdkota->Required) {
			if (!$this->kdkota->IsDetailKey && $this->kdkota->FormValue != NULL && $this->kdkota->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkota->caption(), $this->kdkota->RequiredErrorMessage));
			}
		}
		if ($this->kdkec->Required) {
			if (!$this->kdkec->IsDetailKey && $this->kdkec->FormValue != NULL && $this->kdkec->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkec->caption(), $this->kdkec->RequiredErrorMessage));
			}
		}
		if ($this->alamat->Required) {
			if (!$this->alamat->IsDetailKey && $this->alamat->FormValue != NULL && $this->alamat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
			}
		}
		if ($this->telp->Required) {
			if (!$this->telp->IsDetailKey && $this->telp->FormValue != NULL && $this->telp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telp->caption(), $this->telp->RequiredErrorMessage));
			}
		}
		if ($this->hp->Required) {
			if (!$this->hp->IsDetailKey && $this->hp->FormValue != NULL && $this->hp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hp->caption(), $this->hp->RequiredErrorMessage));
			}
		}
		if ($this->kdjabat->Required) {
			if (!$this->kdjabat->IsDetailKey && $this->kdjabat->FormValue != NULL && $this->kdjabat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdjabat->caption(), $this->kdjabat->RequiredErrorMessage));
			}
		}
		if ($this->kdpend->Required) {
			if (!$this->kdpend->IsDetailKey && $this->kdpend->FormValue != NULL && $this->kdpend->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdpend->caption(), $this->kdpend->RequiredErrorMessage));
			}
		}
		if ($this->kdbahasa->Required) {
			if (!$this->kdbahasa->IsDetailKey && $this->kdbahasa->FormValue != NULL && $this->kdbahasa->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdbahasa->caption(), $this->kdbahasa->RequiredErrorMessage));
			}
		}
		if ($this->jpelatihan->Required) {
			if (!$this->jpelatihan->IsDetailKey && $this->jpelatihan->FormValue != NULL && $this->jpelatihan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jpelatihan->caption(), $this->jpelatihan->RequiredErrorMessage));
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

			// idp
			$this->idp->setDbValueDef($rsnew, $this->idp->CurrentValue, NULL, $this->idp->ReadOnly);

			// tempat
			$this->tempat->setDbValueDef($rsnew, $this->tempat->CurrentValue, NULL, $this->tempat->ReadOnly);

			// kdagama
			$this->kdagama->setDbValueDef($rsnew, $this->kdagama->CurrentValue, NULL, $this->kdagama->ReadOnly);

			// kdsex
			$this->kdsex->setDbValueDef($rsnew, $this->kdsex->CurrentValue, NULL, $this->kdsex->ReadOnly);

			// kdprop
			$this->kdprop->setDbValueDef($rsnew, $this->kdprop->CurrentValue, NULL, $this->kdprop->ReadOnly);

			// kdkota
			$this->kdkota->setDbValueDef($rsnew, $this->kdkota->CurrentValue, NULL, $this->kdkota->ReadOnly);

			// kdkec
			$this->kdkec->setDbValueDef($rsnew, $this->kdkec->CurrentValue, NULL, $this->kdkec->ReadOnly);

			// alamat
			$this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, NULL, $this->alamat->ReadOnly);

			// telp
			$this->telp->setDbValueDef($rsnew, $this->telp->CurrentValue, NULL, $this->telp->ReadOnly);

			// hp
			$this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, NULL, $this->hp->ReadOnly);

			// kdjabat
			$this->kdjabat->setDbValueDef($rsnew, $this->kdjabat->CurrentValue, NULL, $this->kdjabat->ReadOnly);

			// kdpend
			$this->kdpend->setDbValueDef($rsnew, $this->kdpend->CurrentValue, NULL, $this->kdpend->ReadOnly);

			// kdbahasa
			$this->kdbahasa->setDbValueDef($rsnew, $this->kdbahasa->CurrentValue, NULL, $this->kdbahasa->ReadOnly);

			// jpelatihan
			$this->jpelatihan->setDbValueDef($rsnew, $this->jpelatihan->CurrentValue, NULL, $this->jpelatihan->ReadOnly);

			// Check referential integrity for master table 't_prop'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_prop();
			$keyValue = isset($rsnew['kdprop']) ? $rsnew['kdprop'] : $rsold['kdprop'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@kdprop@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_prop"]))
					$GLOBALS["t_prop"] = new t_prop();
				$rsmaster = $GLOBALS["t_prop"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_prop", $Language->phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "t_perusahaan") {
				$this->idp->CurrentValue = $this->idp->getSessionValue();
			}
			if ($this->getCurrentMasterTable() == "t_kota") {
				$this->kdkota->CurrentValue = $this->kdkota->getSessionValue();
			}
			if ($this->getCurrentMasterTable() == "t_prop") {
				$this->kdprop->CurrentValue = $this->kdprop->getSessionValue();
			}

		// Check referential integrity for master table 't_peserta'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_prop();
		if (strval($this->kdprop->CurrentValue) != "") {
			$masterFilter = str_replace("@kdprop@", AdjustSql($this->kdprop->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_prop"]))
				$GLOBALS["t_prop"] = new t_prop();
			$rsmaster = $GLOBALS["t_prop"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_prop", $Language->phrase("RelatedRecordRequired"));
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

		// idp
		$this->idp->setDbValueDef($rsnew, $this->idp->CurrentValue, NULL, FALSE);

		// tempat
		$this->tempat->setDbValueDef($rsnew, $this->tempat->CurrentValue, NULL, FALSE);

		// kdagama
		$this->kdagama->setDbValueDef($rsnew, $this->kdagama->CurrentValue, NULL, FALSE);

		// kdsex
		$this->kdsex->setDbValueDef($rsnew, $this->kdsex->CurrentValue, NULL, FALSE);

		// kdprop
		$this->kdprop->setDbValueDef($rsnew, $this->kdprop->CurrentValue, NULL, FALSE);

		// kdkota
		$this->kdkota->setDbValueDef($rsnew, $this->kdkota->CurrentValue, NULL, FALSE);

		// kdkec
		$this->kdkec->setDbValueDef($rsnew, $this->kdkec->CurrentValue, NULL, FALSE);

		// alamat
		$this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, NULL, FALSE);

		// telp
		$this->telp->setDbValueDef($rsnew, $this->telp->CurrentValue, NULL, FALSE);

		// hp
		$this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, NULL, FALSE);

		// kdjabat
		$this->kdjabat->setDbValueDef($rsnew, $this->kdjabat->CurrentValue, NULL, FALSE);

		// kdpend
		$this->kdpend->setDbValueDef($rsnew, $this->kdpend->CurrentValue, NULL, FALSE);

		// kdbahasa
		$this->kdbahasa->setDbValueDef($rsnew, $this->kdbahasa->CurrentValue, NULL, FALSE);

		// jpelatihan
		$this->jpelatihan->setDbValueDef($rsnew, $this->jpelatihan->CurrentValue, NULL, FALSE);

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
		if ($masterTblVar == "t_perusahaan") {
			$this->idp->Visible = FALSE;
			if ($GLOBALS["t_perusahaan"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		if ($masterTblVar == "t_kota") {
			$this->kdkota->Visible = FALSE;
			if ($GLOBALS["t_kota"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		if ($masterTblVar == "t_prop") {
			$this->kdprop->Visible = FALSE;
			if ($GLOBALS["t_prop"]->EventCancelled)
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
				case "x_idp":
					break;
				case "x_kdagama":
					break;
				case "x_kdsex":
					break;
				case "x_kdprop":
					break;
				case "x_kdkota":
					break;
				case "x_kdkec":
					break;
				case "x_kdjabat":
					break;
				case "x_kdpend":
					break;
				case "x_kdbahasa":
					break;
				case "x_kdinformasi":
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
						case "x_idp":
							break;
						case "x_kdagama":
							break;
						case "x_kdprop":
							break;
						case "x_kdkota":
							break;
						case "x_kdkec":
							break;
						case "x_kdjabat":
							break;
						case "x_kdpend":
							break;
						case "x_kdbahasa":
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
		$GLOBALS["ExportFileName"] = "Daftar_Peserta-PPE".CurrentDate();
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

		if ($this->Export <> "") {
		$header = "<center><h4>Daftar Peserta Pelatihan PPEI</h4>";
		if(!empty($this->nama->AdvancedSearch->SearchValue)){
			$nama = "Nama : ".$this->nama->AdvancedSearch->SearchValue.", ";
		} else { $nama = ""; }
		if(!empty($this->idp->AdvancedSearch->SearchValue)){
			$perusahaan = "Perusahaan : ".ExecuteScalar("SELECT `namap` FROM `t_perusahaan` WHERE `idp` = '".$this->idp->AdvancedSearch->SearchValue."'").", ";
		} else { $perusahaan = ""; }
		if(!empty($this->tempat->AdvancedSearch->SearchValue)){
			$tempatlahir = "Tempat Lahir : ".$this->tempat->AdvancedSearch->SearchValue.", ";
		} else { $tempatlahir = ""; }
		if(!empty($this->tlahir->AdvancedSearch->SearchValue)){
			$tanggallahir = "Tanggal Lahir : ".$this->tlahir->AdvancedSearch->SearchValue.", ";
		} else { $tanggallahir = ""; }
		if(!empty($this->kdagama->AdvancedSearch->SearchValue)){
			$agama = "Agama : ".ExecuteScalar("SELECT `agama` FROM `t_agama` WHERE `kdagama` = '".$this->kdagama->AdvancedSearch->SearchValue."'").", ";
		} else { $agama = ""; }
		if(!empty($this->kdsex->AdvancedSearch->SearchValue)){
			if($this->kdsex->AdvancedSearch->SearchValue == 1) { $jk = "Laki-laki"; } else if($this->kdsex->AdvancedSearch->SearchValue == 2){ $jk = "Perempuan"; } else { $jk = $this->kdsex->AdvancedSearch->SearchValue; }
			$jeniskelamin = "Jenis Kelamin : ".$jk.", ";
		} else { $jeniskelamin = ""; }
		if(!empty($this->kdprop->AdvancedSearch->SearchValue)){
			$propinsi = "Propinsi : ".show_propinsi($this->kdprop->AdvancedSearch->SearchValue).", ";
		} else { $propinsi = ""; }
		if(!empty($this->kdkota->AdvancedSearch->SearchValue)){
			$kota = "Kabupaten/Kota : ".show_kota($this->kdkota->AdvancedSearch->SearchValue).", ";
		} else { $kota = ""; }
		if(!empty($this->kdked->AdvancedSearch->SearchValue)){
			$kecamatan = "Kecamatan : ".show_kecamatan($this->kdkec->AdvancedSearch->SearchValue).", ";
		} else { $kecamatan = ""; }
		if(!empty($this->alamat->AdvancedSearch->SearchValue)){
			$alamat = "Alamat : ".$this->alamat->AdvancedSearch->SearchValue.", ";
		} else { $alamat = ""; }
		if(!empty($this->telp->AdvancedSearch->SearchValue)){
			$telpon = "Telepon : ".$this->telp->AdvancedSearch->SearchValue.", ";
		} else { $telpon = ""; }
		if(!empty($this->hp->AdvancedSearch->SearchValue)){
			$hp = "HP : ".$this->hp->AdvancedSearch->SearchValue.", ";
		} else { $hp = ""; }
		if(!empty($this->email->AdvancedSearch->SearchValue)){
			$email = "Email : ".$this->email->AdvancedSearch->SearchValue.", ";
		} else { $email = ""; }
		if(!empty($this->kdjabat->AdvancedSearch->SearchValue)){
			$jabatan = "Jabatan : ".ExecuteScalar("SELECT `jabatan` FROM `t_jabatan` WHERE `kdjabat` = '".$this->kdjabat->AdvancedSearch->SearchValue."'").", ";
		} else { $jabatan = ""; }
		if(!empty($this->kdpend->AdvancedSearch->SearchValue)){
			$pendidikan = "Pendidikan : ".ExecuteScalar("SELECT `pendidikan` FROM `t_pendidikan` WHERE `kdpend` = '".$this->kdpend->AdvancedSearch->SearchValue."'").", ";
		} else { $pendidikan = ""; }
		if(!empty($this->kdbahasa->AdvancedSearch->SearchValue)){
			$bahasa = "Bahasa : ".ExecuteScalar("SELECT `bahasa` FROM `t_bahasa` WHERE `kdbahasa` = '".$this->kdbahasa->AdvancedSearch->SearchValue."'").", ";
		} else { $bahasa = ""; }
		if(!empty($this->kdinformasi->AdvancedSearch->SearchValue)){
			$informasi = "Sumber Informasi : ".ExecuteScalar("SELECT `informasi` FROM `t_informasi` WHERE `kdinformasi` = '".$this->kdinformasi->AdvancedSearch->SearchValue."'").", ";
		} else { $informasi = ""; }

	/*	if(!empty($this->harapan->AdvancedSearch->SearchValue)){
			$harapan = "Harapan Mengikuti Pelatihan : ".$this->harapan->AdvancedSearch->SearchValue.", ";
		} else { $harapan = ""; }
		if(!empty($this->created_at->AdvancedSearch->SearchValue)){
			$created_at = "Waktu Input : dari ".$this->created_at->AdvancedSearch->SearchValue." hingga ".$this->created_at->AdvancedSearch->SearchValue2.", ";
		} else { $created_at = ""; }
	*/	
		$header .= "<h5>".$nama.$perusahaan.$tempatlahir.$tanggallahir.$agama.$jeniskelamin.$propinsi.$kota.$kecamatan.$alamat.$telpon.$hp.$email.$jabatan.$pendidikan.$bahasa.$informasi."</h5>";
		$header .= "</center>";
		$header .= "Jumlah Peserta : ".@$_SESSION["totaldata_peserta"]." peserta";
		} else {
				if(CurrentUserLevel() == 1){ //user manajemen
					$this->tlahir->Visible = FALSE;
					$this->kdkota->Visible = FALSE;
					$this->kdpos->Visible = FALSE;
					$this->kdjabat->Visible = FALSE;
				}
			$this->tempat->Visible = FALSE;
			$this->kdagama->Visible = FALSE;
			$this->kdsex->Visible = FALSE;
			$this->kdkec->Visible = FALSE;
			$this->alamat->Visible = FALSE;
			$this->telp->Visible = FALSE;
			$this->hp->Visible = FALSE;
			$this->kdpend->Visible = FALSE;
			$this->kdbahasa->Visible = FALSE;

			//$this->kdinformasi->Visible = FALSE;
			//$this->harapan->Visible = FALSE;		

		}
		$this->id->Visible = FALSE;
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

		if(isset(CurrentPage()->Pager->RecordCount) > 0){
			$_SESSION["totaldata_peserta"] = CurrentPage()->Pager->RecordCount;
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