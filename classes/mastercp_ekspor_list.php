<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class mastercp_ekspor_list extends mastercp_ekspor
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 'mastercp_ekspor';

	// Page object name
	public $PageObjName = "mastercp_ekspor_list";

	// Grid form hidden field names
	public $FormName = "fmastercp_eksporlist";
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

		// Table object (mastercp_ekspor)
		if (!isset($GLOBALS["mastercp_ekspor"]) || get_class($GLOBALS["mastercp_ekspor"]) == PROJECT_NAMESPACE . "mastercp_ekspor") {
			$GLOBALS["mastercp_ekspor"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["mastercp_ekspor"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "mastercp_eksporadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "mastercp_ekspordelete.php";
		$this->MultiUpdateUrl = "mastercp_eksporupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'mastercp_ekspor');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fmastercp_eksporlistsrch";

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
		global $mastercp_ekspor;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($mastercp_ekspor);
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
			$this->ID_ECP->Visible = FALSE;
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
	public $SearchFieldsPerRow = 3; // For extended search
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
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->ID_ECP->Visible = FALSE;
		$this->Wilayah_ECP->setVisibility();
		$this->Tahun_ECP->setVisibility();
		$this->Nama->setVisibility();
		$this->Perusahaan->setVisibility();
		$this->Produk->setVisibility();
		$this->Nilai_Ekspor_USD->setVisibility();
		$this->Nilai_Ekspor_Rupiah->setVisibility();
		$this->Tgl_Bln_Ekspor->setVisibility();
		$this->Tahun_Ekspor->setVisibility();
		$this->Negara_Tujuan->setVisibility();
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
		$this->setupLookupOptions($this->Wilayah_ECP);
		$this->setupLookupOptions($this->Tahun_ECP);
		$this->setupLookupOptions($this->Tahun_Ekspor);
		$this->setupLookupOptions($this->Negara_Tujuan);

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
		$filterList = Concat($filterList, $this->ID_ECP->AdvancedSearch->toJson(), ","); // Field ID_ECP
		$filterList = Concat($filterList, $this->Wilayah_ECP->AdvancedSearch->toJson(), ","); // Field Wilayah_ECP
		$filterList = Concat($filterList, $this->Tahun_ECP->AdvancedSearch->toJson(), ","); // Field Tahun_ECP
		$filterList = Concat($filterList, $this->Nama->AdvancedSearch->toJson(), ","); // Field Nama
		$filterList = Concat($filterList, $this->Perusahaan->AdvancedSearch->toJson(), ","); // Field Perusahaan
		$filterList = Concat($filterList, $this->Produk->AdvancedSearch->toJson(), ","); // Field Produk
		$filterList = Concat($filterList, $this->Nilai_Ekspor_USD->AdvancedSearch->toJson(), ","); // Field Nilai_Ekspor_USD
		$filterList = Concat($filterList, $this->Nilai_Ekspor_Rupiah->AdvancedSearch->toJson(), ","); // Field Nilai_Ekspor_Rupiah
		$filterList = Concat($filterList, $this->Tgl_Bln_Ekspor->AdvancedSearch->toJson(), ","); // Field Tgl_Bln_Ekspor
		$filterList = Concat($filterList, $this->Tahun_Ekspor->AdvancedSearch->toJson(), ","); // Field Tahun_Ekspor
		$filterList = Concat($filterList, $this->Negara_Tujuan->AdvancedSearch->toJson(), ","); // Field Negara_Tujuan

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
			$UserProfile->setSearchFilters(CurrentUserName(), "fmastercp_eksporlistsrch", $filters);
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

		// Field ID_ECP
		$this->ID_ECP->AdvancedSearch->SearchValue = @$filter["x_ID_ECP"];
		$this->ID_ECP->AdvancedSearch->SearchOperator = @$filter["z_ID_ECP"];
		$this->ID_ECP->AdvancedSearch->SearchCondition = @$filter["v_ID_ECP"];
		$this->ID_ECP->AdvancedSearch->SearchValue2 = @$filter["y_ID_ECP"];
		$this->ID_ECP->AdvancedSearch->SearchOperator2 = @$filter["w_ID_ECP"];
		$this->ID_ECP->AdvancedSearch->save();

		// Field Wilayah_ECP
		$this->Wilayah_ECP->AdvancedSearch->SearchValue = @$filter["x_Wilayah_ECP"];
		$this->Wilayah_ECP->AdvancedSearch->SearchOperator = @$filter["z_Wilayah_ECP"];
		$this->Wilayah_ECP->AdvancedSearch->SearchCondition = @$filter["v_Wilayah_ECP"];
		$this->Wilayah_ECP->AdvancedSearch->SearchValue2 = @$filter["y_Wilayah_ECP"];
		$this->Wilayah_ECP->AdvancedSearch->SearchOperator2 = @$filter["w_Wilayah_ECP"];
		$this->Wilayah_ECP->AdvancedSearch->save();

		// Field Tahun_ECP
		$this->Tahun_ECP->AdvancedSearch->SearchValue = @$filter["x_Tahun_ECP"];
		$this->Tahun_ECP->AdvancedSearch->SearchOperator = @$filter["z_Tahun_ECP"];
		$this->Tahun_ECP->AdvancedSearch->SearchCondition = @$filter["v_Tahun_ECP"];
		$this->Tahun_ECP->AdvancedSearch->SearchValue2 = @$filter["y_Tahun_ECP"];
		$this->Tahun_ECP->AdvancedSearch->SearchOperator2 = @$filter["w_Tahun_ECP"];
		$this->Tahun_ECP->AdvancedSearch->save();

		// Field Nama
		$this->Nama->AdvancedSearch->SearchValue = @$filter["x_Nama"];
		$this->Nama->AdvancedSearch->SearchOperator = @$filter["z_Nama"];
		$this->Nama->AdvancedSearch->SearchCondition = @$filter["v_Nama"];
		$this->Nama->AdvancedSearch->SearchValue2 = @$filter["y_Nama"];
		$this->Nama->AdvancedSearch->SearchOperator2 = @$filter["w_Nama"];
		$this->Nama->AdvancedSearch->save();

		// Field Perusahaan
		$this->Perusahaan->AdvancedSearch->SearchValue = @$filter["x_Perusahaan"];
		$this->Perusahaan->AdvancedSearch->SearchOperator = @$filter["z_Perusahaan"];
		$this->Perusahaan->AdvancedSearch->SearchCondition = @$filter["v_Perusahaan"];
		$this->Perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_Perusahaan"];
		$this->Perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_Perusahaan"];
		$this->Perusahaan->AdvancedSearch->save();

		// Field Produk
		$this->Produk->AdvancedSearch->SearchValue = @$filter["x_Produk"];
		$this->Produk->AdvancedSearch->SearchOperator = @$filter["z_Produk"];
		$this->Produk->AdvancedSearch->SearchCondition = @$filter["v_Produk"];
		$this->Produk->AdvancedSearch->SearchValue2 = @$filter["y_Produk"];
		$this->Produk->AdvancedSearch->SearchOperator2 = @$filter["w_Produk"];
		$this->Produk->AdvancedSearch->save();

		// Field Nilai_Ekspor_USD
		$this->Nilai_Ekspor_USD->AdvancedSearch->SearchValue = @$filter["x_Nilai_Ekspor_USD"];
		$this->Nilai_Ekspor_USD->AdvancedSearch->SearchOperator = @$filter["z_Nilai_Ekspor_USD"];
		$this->Nilai_Ekspor_USD->AdvancedSearch->SearchCondition = @$filter["v_Nilai_Ekspor_USD"];
		$this->Nilai_Ekspor_USD->AdvancedSearch->SearchValue2 = @$filter["y_Nilai_Ekspor_USD"];
		$this->Nilai_Ekspor_USD->AdvancedSearch->SearchOperator2 = @$filter["w_Nilai_Ekspor_USD"];
		$this->Nilai_Ekspor_USD->AdvancedSearch->save();

		// Field Nilai_Ekspor_Rupiah
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->SearchValue = @$filter["x_Nilai_Ekspor_Rupiah"];
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->SearchOperator = @$filter["z_Nilai_Ekspor_Rupiah"];
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->SearchCondition = @$filter["v_Nilai_Ekspor_Rupiah"];
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->SearchValue2 = @$filter["y_Nilai_Ekspor_Rupiah"];
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->SearchOperator2 = @$filter["w_Nilai_Ekspor_Rupiah"];
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->save();

		// Field Tgl_Bln_Ekspor
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue = @$filter["x_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchOperator = @$filter["z_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchCondition = @$filter["v_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue2 = @$filter["y_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchOperator2 = @$filter["w_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->save();

		// Field Tahun_Ekspor
		$this->Tahun_Ekspor->AdvancedSearch->SearchValue = @$filter["x_Tahun_Ekspor"];
		$this->Tahun_Ekspor->AdvancedSearch->SearchOperator = @$filter["z_Tahun_Ekspor"];
		$this->Tahun_Ekspor->AdvancedSearch->SearchCondition = @$filter["v_Tahun_Ekspor"];
		$this->Tahun_Ekspor->AdvancedSearch->SearchValue2 = @$filter["y_Tahun_Ekspor"];
		$this->Tahun_Ekspor->AdvancedSearch->SearchOperator2 = @$filter["w_Tahun_Ekspor"];
		$this->Tahun_Ekspor->AdvancedSearch->save();

		// Field Negara_Tujuan
		$this->Negara_Tujuan->AdvancedSearch->SearchValue = @$filter["x_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->SearchOperator = @$filter["z_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->SearchCondition = @$filter["v_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->SearchValue2 = @$filter["y_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->SearchOperator2 = @$filter["w_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->save();
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->ID_ECP, $default, FALSE); // ID_ECP
		$this->buildSearchSql($where, $this->Wilayah_ECP, $default, FALSE); // Wilayah_ECP
		$this->buildSearchSql($where, $this->Tahun_ECP, $default, FALSE); // Tahun_ECP
		$this->buildSearchSql($where, $this->Nama, $default, FALSE); // Nama
		$this->buildSearchSql($where, $this->Perusahaan, $default, FALSE); // Perusahaan
		$this->buildSearchSql($where, $this->Produk, $default, FALSE); // Produk
		$this->buildSearchSql($where, $this->Nilai_Ekspor_USD, $default, FALSE); // Nilai_Ekspor_USD
		$this->buildSearchSql($where, $this->Nilai_Ekspor_Rupiah, $default, FALSE); // Nilai_Ekspor_Rupiah
		$this->buildSearchSql($where, $this->Tgl_Bln_Ekspor, $default, FALSE); // Tgl_Bln_Ekspor
		$this->buildSearchSql($where, $this->Tahun_Ekspor, $default, FALSE); // Tahun_Ekspor
		$this->buildSearchSql($where, $this->Negara_Tujuan, $default, FALSE); // Negara_Tujuan

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->ID_ECP->AdvancedSearch->save(); // ID_ECP
			$this->Wilayah_ECP->AdvancedSearch->save(); // Wilayah_ECP
			$this->Tahun_ECP->AdvancedSearch->save(); // Tahun_ECP
			$this->Nama->AdvancedSearch->save(); // Nama
			$this->Perusahaan->AdvancedSearch->save(); // Perusahaan
			$this->Produk->AdvancedSearch->save(); // Produk
			$this->Nilai_Ekspor_USD->AdvancedSearch->save(); // Nilai_Ekspor_USD
			$this->Nilai_Ekspor_Rupiah->AdvancedSearch->save(); // Nilai_Ekspor_Rupiah
			$this->Tgl_Bln_Ekspor->AdvancedSearch->save(); // Tgl_Bln_Ekspor
			$this->Tahun_Ekspor->AdvancedSearch->save(); // Tahun_Ekspor
			$this->Negara_Tujuan->AdvancedSearch->save(); // Negara_Tujuan
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
		if ($this->ID_ECP->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Wilayah_ECP->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Tahun_ECP->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Nama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Perusahaan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Produk->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Nilai_Ekspor_USD->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Nilai_Ekspor_Rupiah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Tgl_Bln_Ekspor->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Tahun_Ekspor->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Negara_Tujuan->AdvancedSearch->issetSession())
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
		$this->ID_ECP->AdvancedSearch->unsetSession();
		$this->Wilayah_ECP->AdvancedSearch->unsetSession();
		$this->Tahun_ECP->AdvancedSearch->unsetSession();
		$this->Nama->AdvancedSearch->unsetSession();
		$this->Perusahaan->AdvancedSearch->unsetSession();
		$this->Produk->AdvancedSearch->unsetSession();
		$this->Nilai_Ekspor_USD->AdvancedSearch->unsetSession();
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->unsetSession();
		$this->Tgl_Bln_Ekspor->AdvancedSearch->unsetSession();
		$this->Tahun_Ekspor->AdvancedSearch->unsetSession();
		$this->Negara_Tujuan->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->ID_ECP->AdvancedSearch->load();
		$this->Wilayah_ECP->AdvancedSearch->load();
		$this->Tahun_ECP->AdvancedSearch->load();
		$this->Nama->AdvancedSearch->load();
		$this->Perusahaan->AdvancedSearch->load();
		$this->Produk->AdvancedSearch->load();
		$this->Nilai_Ekspor_USD->AdvancedSearch->load();
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->load();
		$this->Tgl_Bln_Ekspor->AdvancedSearch->load();
		$this->Tahun_Ekspor->AdvancedSearch->load();
		$this->Negara_Tujuan->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->Wilayah_ECP); // Wilayah_ECP
			$this->updateSort($this->Tahun_ECP); // Tahun_ECP
			$this->updateSort($this->Nama); // Nama
			$this->updateSort($this->Perusahaan); // Perusahaan
			$this->updateSort($this->Produk); // Produk
			$this->updateSort($this->Nilai_Ekspor_USD); // Nilai_Ekspor_USD
			$this->updateSort($this->Nilai_Ekspor_Rupiah); // Nilai_Ekspor_Rupiah
			$this->updateSort($this->Tgl_Bln_Ekspor); // Tgl_Bln_Ekspor
			$this->updateSort($this->Tahun_Ekspor); // Tahun_Ekspor
			$this->updateSort($this->Negara_Tujuan); // Negara_Tujuan
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
				$this->Wilayah_ECP->setSort("");
				$this->Tahun_ECP->setSort("");
				$this->Nama->setSort("");
				$this->Perusahaan->setSort("");
				$this->Produk->setSort("");
				$this->Nilai_Ekspor_USD->setSort("");
				$this->Nilai_Ekspor_Rupiah->setSort("");
				$this->Tgl_Bln_Ekspor->setSort("");
				$this->Tahun_Ekspor->setSort("");
				$this->Negara_Tujuan->setSort("");
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fmastercp_eksporlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fmastercp_eksporlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fmastercp_eksporlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// ID_ECP
		if (!$this->isAddOrEdit() && $this->ID_ECP->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ID_ECP->AdvancedSearch->SearchValue != "" || $this->ID_ECP->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Wilayah_ECP
		if (!$this->isAddOrEdit() && $this->Wilayah_ECP->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Wilayah_ECP->AdvancedSearch->SearchValue != "" || $this->Wilayah_ECP->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Tahun_ECP
		if (!$this->isAddOrEdit() && $this->Tahun_ECP->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Tahun_ECP->AdvancedSearch->SearchValue != "" || $this->Tahun_ECP->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Nama
		if (!$this->isAddOrEdit() && $this->Nama->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Nama->AdvancedSearch->SearchValue != "" || $this->Nama->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Perusahaan
		if (!$this->isAddOrEdit() && $this->Perusahaan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Perusahaan->AdvancedSearch->SearchValue != "" || $this->Perusahaan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Produk
		if (!$this->isAddOrEdit() && $this->Produk->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Produk->AdvancedSearch->SearchValue != "" || $this->Produk->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Nilai_Ekspor_USD
		if (!$this->isAddOrEdit() && $this->Nilai_Ekspor_USD->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Nilai_Ekspor_USD->AdvancedSearch->SearchValue != "" || $this->Nilai_Ekspor_USD->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Nilai_Ekspor_Rupiah
		if (!$this->isAddOrEdit() && $this->Nilai_Ekspor_Rupiah->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Nilai_Ekspor_Rupiah->AdvancedSearch->SearchValue != "" || $this->Nilai_Ekspor_Rupiah->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Tgl_Bln_Ekspor
		if (!$this->isAddOrEdit() && $this->Tgl_Bln_Ekspor->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue != "" || $this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Tahun_Ekspor
		if (!$this->isAddOrEdit() && $this->Tahun_Ekspor->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Tahun_Ekspor->AdvancedSearch->SearchValue != "" || $this->Tahun_Ekspor->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Negara_Tujuan
		if (!$this->isAddOrEdit() && $this->Negara_Tujuan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Negara_Tujuan->AdvancedSearch->SearchValue != "" || $this->Negara_Tujuan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->ID_ECP->setDbValue($row['ID_ECP']);
		$this->Wilayah_ECP->setDbValue($row['Wilayah_ECP']);
		$this->Tahun_ECP->setDbValue($row['Tahun_ECP']);
		$this->Nama->setDbValue($row['Nama']);
		$this->Perusahaan->setDbValue($row['Perusahaan']);
		$this->Produk->setDbValue($row['Produk']);
		$this->Nilai_Ekspor_USD->setDbValue($row['Nilai_Ekspor_USD']);
		$this->Nilai_Ekspor_Rupiah->setDbValue($row['Nilai_Ekspor_Rupiah']);
		$this->Tgl_Bln_Ekspor->setDbValue($row['Tgl_Bln_Ekspor']);
		$this->Tahun_Ekspor->setDbValue($row['Tahun_Ekspor']);
		$this->Negara_Tujuan->setDbValue($row['Negara_Tujuan']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID_ECP'] = NULL;
		$row['Wilayah_ECP'] = NULL;
		$row['Tahun_ECP'] = NULL;
		$row['Nama'] = NULL;
		$row['Perusahaan'] = NULL;
		$row['Produk'] = NULL;
		$row['Nilai_Ekspor_USD'] = NULL;
		$row['Nilai_Ekspor_Rupiah'] = NULL;
		$row['Tgl_Bln_Ekspor'] = NULL;
		$row['Tahun_Ekspor'] = NULL;
		$row['Negara_Tujuan'] = NULL;
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
		if ($this->Nilai_Ekspor_USD->FormValue == $this->Nilai_Ekspor_USD->CurrentValue && is_numeric(ConvertToFloatString($this->Nilai_Ekspor_USD->CurrentValue)))
			$this->Nilai_Ekspor_USD->CurrentValue = ConvertToFloatString($this->Nilai_Ekspor_USD->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Nilai_Ekspor_Rupiah->FormValue == $this->Nilai_Ekspor_Rupiah->CurrentValue && is_numeric(ConvertToFloatString($this->Nilai_Ekspor_Rupiah->CurrentValue)))
			$this->Nilai_Ekspor_Rupiah->CurrentValue = ConvertToFloatString($this->Nilai_Ekspor_Rupiah->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_ECP
		// Wilayah_ECP
		// Tahun_ECP
		// Nama
		// Perusahaan
		// Produk
		// Nilai_Ekspor_USD
		// Nilai_Ekspor_Rupiah
		// Tgl_Bln_Ekspor
		// Tahun_Ekspor
		// Negara_Tujuan

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_ECP
			$this->ID_ECP->ViewValue = $this->ID_ECP->CurrentValue;
			$this->ID_ECP->ViewCustomAttributes = "";

			// Wilayah_ECP
			$curVal = strval($this->Wilayah_ECP->CurrentValue);
			if ($curVal != "") {
				$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->lookupCacheOption($curVal);
				if ($this->Wilayah_ECP->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`area`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Wilayah_ECP->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->CurrentValue;
					}
				}
			} else {
				$this->Wilayah_ECP->ViewValue = NULL;
			}
			$this->Wilayah_ECP->ViewCustomAttributes = "";

			// Tahun_ECP
			$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
			$curVal = strval($this->Tahun_ECP->CurrentValue);
			if ($curVal != "") {
				$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->lookupCacheOption($curVal);
				if ($this->Tahun_ECP->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->Tahun_ECP->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
					}
				}
			} else {
				$this->Tahun_ECP->ViewValue = NULL;
			}
			$this->Tahun_ECP->ViewCustomAttributes = "";

			// Nama
			$this->Nama->ViewValue = $this->Nama->CurrentValue;
			$this->Nama->ViewCustomAttributes = "";

			// Perusahaan
			$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
			$this->Perusahaan->ViewCustomAttributes = "";

			// Produk
			$this->Produk->ViewValue = $this->Produk->CurrentValue;
			$this->Produk->ViewCustomAttributes = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->ViewValue = $this->Nilai_Ekspor_USD->CurrentValue;
			$this->Nilai_Ekspor_USD->ViewValue = FormatNumber($this->Nilai_Ekspor_USD->ViewValue, 2, -2, -2, -2);
			$this->Nilai_Ekspor_USD->ViewCustomAttributes = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->ViewValue = $this->Nilai_Ekspor_Rupiah->CurrentValue;
			$this->Nilai_Ekspor_Rupiah->ViewValue = FormatNumber($this->Nilai_Ekspor_Rupiah->ViewValue, 2, -2, -2, -2);
			$this->Nilai_Ekspor_Rupiah->ViewCustomAttributes = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->ViewValue = $this->Tgl_Bln_Ekspor->CurrentValue;
			$this->Tgl_Bln_Ekspor->ViewCustomAttributes = "";

			// Tahun_Ekspor
			$curVal = strval($this->Tahun_Ekspor->CurrentValue);
			if ($curVal != "") {
				$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->lookupCacheOption($curVal);
				if ($this->Tahun_Ekspor->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->Tahun_Ekspor->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->CurrentValue;
					}
				}
			} else {
				$this->Tahun_Ekspor->ViewValue = NULL;
			}
			$this->Tahun_Ekspor->ViewCustomAttributes = "";

			// Negara_Tujuan
			$curVal = strval($this->Negara_Tujuan->CurrentValue);
			if ($curVal != "") {
				$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->lookupCacheOption($curVal);
				if ($this->Negara_Tujuan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`negara`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Negara_Tujuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->CurrentValue;
					}
				}
			} else {
				$this->Negara_Tujuan->ViewValue = NULL;
			}
			$this->Negara_Tujuan->ViewCustomAttributes = "";

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";
			$this->Wilayah_ECP->TooltipValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
			$this->Tahun_ECP->TooltipValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";
			$this->Perusahaan->TooltipValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";
			$this->Produk->TooltipValue = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_USD->HrefValue = "";
			$this->Nilai_Ekspor_USD->TooltipValue = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->HrefValue = "";
			$this->Nilai_Ekspor_Rupiah->TooltipValue = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->LinkCustomAttributes = "";
			$this->Tgl_Bln_Ekspor->HrefValue = "";
			$this->Tgl_Bln_Ekspor->TooltipValue = "";

			// Tahun_Ekspor
			$this->Tahun_Ekspor->LinkCustomAttributes = "";
			$this->Tahun_Ekspor->HrefValue = "";
			$this->Tahun_Ekspor->TooltipValue = "";

			// Negara_Tujuan
			$this->Negara_Tujuan->LinkCustomAttributes = "";
			$this->Negara_Tujuan->HrefValue = "";
			$this->Negara_Tujuan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// Wilayah_ECP
			$this->Wilayah_ECP->EditAttrs["class"] = "form-control";
			$this->Wilayah_ECP->EditCustomAttributes = "";
			$curVal = trim(strval($this->Wilayah_ECP->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Wilayah_ECP->AdvancedSearch->ViewValue = $this->Wilayah_ECP->lookupCacheOption($curVal);
			else
				$this->Wilayah_ECP->AdvancedSearch->ViewValue = $this->Wilayah_ECP->Lookup !== NULL && is_array($this->Wilayah_ECP->Lookup->Options) ? $curVal : NULL;
			if ($this->Wilayah_ECP->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Wilayah_ECP->EditValue = array_values($this->Wilayah_ECP->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`area`" . SearchString("=", $this->Wilayah_ECP->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Wilayah_ECP->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Wilayah_ECP->EditValue = $arwrk;
			}

			// Tahun_ECP
			$this->Tahun_ECP->EditAttrs["class"] = "form-control";
			$this->Tahun_ECP->EditCustomAttributes = "";
			$this->Tahun_ECP->EditValue = HtmlEncode($this->Tahun_ECP->AdvancedSearch->SearchValue);
			$curVal = strval($this->Tahun_ECP->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->Tahun_ECP->EditValue = $this->Tahun_ECP->lookupCacheOption($curVal);
				if ($this->Tahun_ECP->EditValue === NULL) { // Lookup from database
					$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->Tahun_ECP->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Tahun_ECP->EditValue = $this->Tahun_ECP->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Tahun_ECP->EditValue = HtmlEncode($this->Tahun_ECP->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->Tahun_ECP->EditValue = NULL;
			}
			$this->Tahun_ECP->PlaceHolder = RemoveHtml($this->Tahun_ECP->caption());

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			if (!$this->Nama->Raw)
				$this->Nama->AdvancedSearch->SearchValue = HtmlDecode($this->Nama->AdvancedSearch->SearchValue);
			$this->Nama->EditValue = HtmlEncode($this->Nama->AdvancedSearch->SearchValue);
			$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

			// Perusahaan
			$this->Perusahaan->EditAttrs["class"] = "form-control";
			$this->Perusahaan->EditCustomAttributes = "";
			if (!$this->Perusahaan->Raw)
				$this->Perusahaan->AdvancedSearch->SearchValue = HtmlDecode($this->Perusahaan->AdvancedSearch->SearchValue);
			$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->AdvancedSearch->SearchValue);
			$this->Perusahaan->PlaceHolder = RemoveHtml($this->Perusahaan->caption());

			// Produk
			$this->Produk->EditAttrs["class"] = "form-control";
			$this->Produk->EditCustomAttributes = "";
			if (!$this->Produk->Raw)
				$this->Produk->AdvancedSearch->SearchValue = HtmlDecode($this->Produk->AdvancedSearch->SearchValue);
			$this->Produk->EditValue = HtmlEncode($this->Produk->AdvancedSearch->SearchValue);
			$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->EditAttrs["class"] = "form-control";
			$this->Nilai_Ekspor_USD->EditCustomAttributes = "";
			$this->Nilai_Ekspor_USD->EditValue = HtmlEncode($this->Nilai_Ekspor_USD->AdvancedSearch->SearchValue);
			$this->Nilai_Ekspor_USD->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_USD->caption());

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->EditAttrs["class"] = "form-control";
			$this->Nilai_Ekspor_Rupiah->EditCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->EditValue = HtmlEncode($this->Nilai_Ekspor_Rupiah->AdvancedSearch->SearchValue);
			$this->Nilai_Ekspor_Rupiah->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_Rupiah->caption());

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->EditAttrs["class"] = "form-control";
			$this->Tgl_Bln_Ekspor->EditCustomAttributes = "";
			if (!$this->Tgl_Bln_Ekspor->Raw)
				$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue = HtmlDecode($this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue);
			$this->Tgl_Bln_Ekspor->EditValue = HtmlEncode($this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue);
			$this->Tgl_Bln_Ekspor->PlaceHolder = RemoveHtml($this->Tgl_Bln_Ekspor->caption());

			// Tahun_Ekspor
			$this->Tahun_Ekspor->EditAttrs["class"] = "form-control";
			$this->Tahun_Ekspor->EditCustomAttributes = "";

			// Negara_Tujuan
			$this->Negara_Tujuan->EditAttrs["class"] = "form-control";
			$this->Negara_Tujuan->EditCustomAttributes = "";
			$curVal = trim(strval($this->Negara_Tujuan->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Negara_Tujuan->AdvancedSearch->ViewValue = $this->Negara_Tujuan->lookupCacheOption($curVal);
			else
				$this->Negara_Tujuan->AdvancedSearch->ViewValue = $this->Negara_Tujuan->Lookup !== NULL && is_array($this->Negara_Tujuan->Lookup->Options) ? $curVal : NULL;
			if ($this->Negara_Tujuan->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Negara_Tujuan->EditValue = array_values($this->Negara_Tujuan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`negara`" . SearchString("=", $this->Negara_Tujuan->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Negara_Tujuan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Negara_Tujuan->EditValue = $arwrk;
			}
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
		if (!CheckInteger($this->Tahun_ECP->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Tahun_ECP->errorMessage());
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
		$this->ID_ECP->AdvancedSearch->load();
		$this->Wilayah_ECP->AdvancedSearch->load();
		$this->Tahun_ECP->AdvancedSearch->load();
		$this->Nama->AdvancedSearch->load();
		$this->Perusahaan->AdvancedSearch->load();
		$this->Produk->AdvancedSearch->load();
		$this->Nilai_Ekspor_USD->AdvancedSearch->load();
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->load();
		$this->Tgl_Bln_Ekspor->AdvancedSearch->load();
		$this->Tahun_Ekspor->AdvancedSearch->load();
		$this->Negara_Tujuan->AdvancedSearch->load();
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fmastercp_eksporlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
				case "x_Wilayah_ECP":
					break;
				case "x_Tahun_ECP":
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_Tahun_Ekspor":
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_Negara_Tujuan":
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
						case "x_Wilayah_ECP":
							break;
						case "x_Tahun_ECP":
							break;
						case "x_Tahun_Ekspor":
							break;
						case "x_Negara_Tujuan":
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