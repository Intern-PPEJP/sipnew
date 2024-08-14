<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class evaluasi_list extends evaluasi
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 'evaluasi';

	// Page object name
	public $PageObjName = "evaluasi_list";

	// Grid form hidden field names
	public $FormName = "fevaluasilist";
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

		// Table object (evaluasi)
		if (!isset($GLOBALS["evaluasi"]) || get_class($GLOBALS["evaluasi"]) == PROJECT_NAMESPACE . "evaluasi") {
			$GLOBALS["evaluasi"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["evaluasi"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "evaluasiadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "evaluasidelete.php";
		$this->MultiUpdateUrl = "evaluasiupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'evaluasi');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fevaluasilistsrch";

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
		global $evaluasi;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($evaluasi);
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
			$key .= @$ar['idpelat'];
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
			$this->th->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->idpelat->Visible = FALSE;
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
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->th->setVisibility();
		$this->idpelat->setVisibility();
		$this->kdpelat->setVisibility();
		$this->kdjudul->setVisibility();
		$this->tawal->setVisibility();
		$this->takhir->setVisibility();
		$this->ketua->Visible = FALSE;
		$this->sekretaris->Visible = FALSE;
		$this->bendahara->Visible = FALSE;
		$this->anggota2->Visible = FALSE;
		$this->widyaiswara->Visible = FALSE;
		$this->tglpel->setVisibility();
		$this->panitia->setVisibility();
		$this->jenisevaluasi->setVisibility();
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
		$this->setupLookupOptions($this->th);
		$this->setupLookupOptions($this->idpelat);
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->ketua);
		$this->setupLookupOptions($this->sekretaris);
		$this->setupLookupOptions($this->bendahara);
		$this->setupLookupOptions($this->anggota2);
		$this->setupLookupOptions($this->widyaiswara);

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
		if ($filter == "") {
			$filter = "0=101";
			$this->SearchWhere = $filter;
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
		if (count($arKeyFlds) >= 1) {
			$this->idpelat->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->idpelat->OldValue))
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
		$filterList = Concat($filterList, $this->th->AdvancedSearch->toJson(), ","); // Field th
		$filterList = Concat($filterList, $this->idpelat->AdvancedSearch->toJson(), ","); // Field idpelat
		$filterList = Concat($filterList, $this->kdpelat->AdvancedSearch->toJson(), ","); // Field kdpelat
		$filterList = Concat($filterList, $this->kdjudul->AdvancedSearch->toJson(), ","); // Field kdjudul
		$filterList = Concat($filterList, $this->tawal->AdvancedSearch->toJson(), ","); // Field tawal
		$filterList = Concat($filterList, $this->takhir->AdvancedSearch->toJson(), ","); // Field takhir
		$filterList = Concat($filterList, $this->ketua->AdvancedSearch->toJson(), ","); // Field ketua
		$filterList = Concat($filterList, $this->sekretaris->AdvancedSearch->toJson(), ","); // Field sekretaris
		$filterList = Concat($filterList, $this->bendahara->AdvancedSearch->toJson(), ","); // Field bendahara
		$filterList = Concat($filterList, $this->anggota2->AdvancedSearch->toJson(), ","); // Field anggota2
		$filterList = Concat($filterList, $this->widyaiswara->AdvancedSearch->toJson(), ","); // Field widyaiswara
		$filterList = Concat($filterList, $this->tglpel->AdvancedSearch->toJson(), ","); // Field tglpel
		$filterList = Concat($filterList, $this->panitia->AdvancedSearch->toJson(), ","); // Field panitia
		$filterList = Concat($filterList, $this->jenisevaluasi->AdvancedSearch->toJson(), ","); // Field jenisevaluasi

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
			$UserProfile->setSearchFilters(CurrentUserName(), "fevaluasilistsrch", $filters);
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

		// Field th
		$this->th->AdvancedSearch->SearchValue = @$filter["x_th"];
		$this->th->AdvancedSearch->SearchOperator = @$filter["z_th"];
		$this->th->AdvancedSearch->SearchCondition = @$filter["v_th"];
		$this->th->AdvancedSearch->SearchValue2 = @$filter["y_th"];
		$this->th->AdvancedSearch->SearchOperator2 = @$filter["w_th"];
		$this->th->AdvancedSearch->save();

		// Field idpelat
		$this->idpelat->AdvancedSearch->SearchValue = @$filter["x_idpelat"];
		$this->idpelat->AdvancedSearch->SearchOperator = @$filter["z_idpelat"];
		$this->idpelat->AdvancedSearch->SearchCondition = @$filter["v_idpelat"];
		$this->idpelat->AdvancedSearch->SearchValue2 = @$filter["y_idpelat"];
		$this->idpelat->AdvancedSearch->SearchOperator2 = @$filter["w_idpelat"];
		$this->idpelat->AdvancedSearch->save();

		// Field kdpelat
		$this->kdpelat->AdvancedSearch->SearchValue = @$filter["x_kdpelat"];
		$this->kdpelat->AdvancedSearch->SearchOperator = @$filter["z_kdpelat"];
		$this->kdpelat->AdvancedSearch->SearchCondition = @$filter["v_kdpelat"];
		$this->kdpelat->AdvancedSearch->SearchValue2 = @$filter["y_kdpelat"];
		$this->kdpelat->AdvancedSearch->SearchOperator2 = @$filter["w_kdpelat"];
		$this->kdpelat->AdvancedSearch->save();

		// Field kdjudul
		$this->kdjudul->AdvancedSearch->SearchValue = @$filter["x_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchOperator = @$filter["z_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchCondition = @$filter["v_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchValue2 = @$filter["y_kdjudul"];
		$this->kdjudul->AdvancedSearch->SearchOperator2 = @$filter["w_kdjudul"];
		$this->kdjudul->AdvancedSearch->save();

		// Field tawal
		$this->tawal->AdvancedSearch->SearchValue = @$filter["x_tawal"];
		$this->tawal->AdvancedSearch->SearchOperator = @$filter["z_tawal"];
		$this->tawal->AdvancedSearch->SearchCondition = @$filter["v_tawal"];
		$this->tawal->AdvancedSearch->SearchValue2 = @$filter["y_tawal"];
		$this->tawal->AdvancedSearch->SearchOperator2 = @$filter["w_tawal"];
		$this->tawal->AdvancedSearch->save();

		// Field takhir
		$this->takhir->AdvancedSearch->SearchValue = @$filter["x_takhir"];
		$this->takhir->AdvancedSearch->SearchOperator = @$filter["z_takhir"];
		$this->takhir->AdvancedSearch->SearchCondition = @$filter["v_takhir"];
		$this->takhir->AdvancedSearch->SearchValue2 = @$filter["y_takhir"];
		$this->takhir->AdvancedSearch->SearchOperator2 = @$filter["w_takhir"];
		$this->takhir->AdvancedSearch->save();

		// Field ketua
		$this->ketua->AdvancedSearch->SearchValue = @$filter["x_ketua"];
		$this->ketua->AdvancedSearch->SearchOperator = @$filter["z_ketua"];
		$this->ketua->AdvancedSearch->SearchCondition = @$filter["v_ketua"];
		$this->ketua->AdvancedSearch->SearchValue2 = @$filter["y_ketua"];
		$this->ketua->AdvancedSearch->SearchOperator2 = @$filter["w_ketua"];
		$this->ketua->AdvancedSearch->save();

		// Field sekretaris
		$this->sekretaris->AdvancedSearch->SearchValue = @$filter["x_sekretaris"];
		$this->sekretaris->AdvancedSearch->SearchOperator = @$filter["z_sekretaris"];
		$this->sekretaris->AdvancedSearch->SearchCondition = @$filter["v_sekretaris"];
		$this->sekretaris->AdvancedSearch->SearchValue2 = @$filter["y_sekretaris"];
		$this->sekretaris->AdvancedSearch->SearchOperator2 = @$filter["w_sekretaris"];
		$this->sekretaris->AdvancedSearch->save();

		// Field bendahara
		$this->bendahara->AdvancedSearch->SearchValue = @$filter["x_bendahara"];
		$this->bendahara->AdvancedSearch->SearchOperator = @$filter["z_bendahara"];
		$this->bendahara->AdvancedSearch->SearchCondition = @$filter["v_bendahara"];
		$this->bendahara->AdvancedSearch->SearchValue2 = @$filter["y_bendahara"];
		$this->bendahara->AdvancedSearch->SearchOperator2 = @$filter["w_bendahara"];
		$this->bendahara->AdvancedSearch->save();

		// Field anggota2
		$this->anggota2->AdvancedSearch->SearchValue = @$filter["x_anggota2"];
		$this->anggota2->AdvancedSearch->SearchOperator = @$filter["z_anggota2"];
		$this->anggota2->AdvancedSearch->SearchCondition = @$filter["v_anggota2"];
		$this->anggota2->AdvancedSearch->SearchValue2 = @$filter["y_anggota2"];
		$this->anggota2->AdvancedSearch->SearchOperator2 = @$filter["w_anggota2"];
		$this->anggota2->AdvancedSearch->save();

		// Field widyaiswara
		$this->widyaiswara->AdvancedSearch->SearchValue = @$filter["x_widyaiswara"];
		$this->widyaiswara->AdvancedSearch->SearchOperator = @$filter["z_widyaiswara"];
		$this->widyaiswara->AdvancedSearch->SearchCondition = @$filter["v_widyaiswara"];
		$this->widyaiswara->AdvancedSearch->SearchValue2 = @$filter["y_widyaiswara"];
		$this->widyaiswara->AdvancedSearch->SearchOperator2 = @$filter["w_widyaiswara"];
		$this->widyaiswara->AdvancedSearch->save();

		// Field tglpel
		$this->tglpel->AdvancedSearch->SearchValue = @$filter["x_tglpel"];
		$this->tglpel->AdvancedSearch->SearchOperator = @$filter["z_tglpel"];
		$this->tglpel->AdvancedSearch->SearchCondition = @$filter["v_tglpel"];
		$this->tglpel->AdvancedSearch->SearchValue2 = @$filter["y_tglpel"];
		$this->tglpel->AdvancedSearch->SearchOperator2 = @$filter["w_tglpel"];
		$this->tglpel->AdvancedSearch->save();

		// Field panitia
		$this->panitia->AdvancedSearch->SearchValue = @$filter["x_panitia"];
		$this->panitia->AdvancedSearch->SearchOperator = @$filter["z_panitia"];
		$this->panitia->AdvancedSearch->SearchCondition = @$filter["v_panitia"];
		$this->panitia->AdvancedSearch->SearchValue2 = @$filter["y_panitia"];
		$this->panitia->AdvancedSearch->SearchOperator2 = @$filter["w_panitia"];
		$this->panitia->AdvancedSearch->save();

		// Field jenisevaluasi
		$this->jenisevaluasi->AdvancedSearch->SearchValue = @$filter["x_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->SearchOperator = @$filter["z_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->SearchCondition = @$filter["v_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->SearchValue2 = @$filter["y_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->SearchOperator2 = @$filter["w_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->save();
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->th, $default, FALSE); // th
		$this->buildSearchSql($where, $this->idpelat, $default, FALSE); // idpelat
		$this->buildSearchSql($where, $this->kdpelat, $default, FALSE); // kdpelat
		$this->buildSearchSql($where, $this->kdjudul, $default, FALSE); // kdjudul
		$this->buildSearchSql($where, $this->tawal, $default, FALSE); // tawal
		$this->buildSearchSql($where, $this->takhir, $default, FALSE); // takhir
		$this->buildSearchSql($where, $this->ketua, $default, FALSE); // ketua
		$this->buildSearchSql($where, $this->sekretaris, $default, FALSE); // sekretaris
		$this->buildSearchSql($where, $this->bendahara, $default, FALSE); // bendahara
		$this->buildSearchSql($where, $this->anggota2, $default, FALSE); // anggota2
		$this->buildSearchSql($where, $this->widyaiswara, $default, FALSE); // widyaiswara
		$this->buildSearchSql($where, $this->tglpel, $default, FALSE); // tglpel
		$this->buildSearchSql($where, $this->panitia, $default, FALSE); // panitia
		$this->buildSearchSql($where, $this->jenisevaluasi, $default, FALSE); // jenisevaluasi

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->th->AdvancedSearch->save(); // th
			$this->idpelat->AdvancedSearch->save(); // idpelat
			$this->kdpelat->AdvancedSearch->save(); // kdpelat
			$this->kdjudul->AdvancedSearch->save(); // kdjudul
			$this->tawal->AdvancedSearch->save(); // tawal
			$this->takhir->AdvancedSearch->save(); // takhir
			$this->ketua->AdvancedSearch->save(); // ketua
			$this->sekretaris->AdvancedSearch->save(); // sekretaris
			$this->bendahara->AdvancedSearch->save(); // bendahara
			$this->anggota2->AdvancedSearch->save(); // anggota2
			$this->widyaiswara->AdvancedSearch->save(); // widyaiswara
			$this->tglpel->AdvancedSearch->save(); // tglpel
			$this->panitia->AdvancedSearch->save(); // panitia
			$this->jenisevaluasi->AdvancedSearch->save(); // jenisevaluasi
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
		if ($this->th->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->idpelat->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdpelat->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdjudul->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tawal->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->takhir->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ketua->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->sekretaris->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->bendahara->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->anggota2->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->widyaiswara->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tglpel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->panitia->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jenisevaluasi->AdvancedSearch->issetSession())
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
		$this->th->AdvancedSearch->unsetSession();
		$this->idpelat->AdvancedSearch->unsetSession();
		$this->kdpelat->AdvancedSearch->unsetSession();
		$this->kdjudul->AdvancedSearch->unsetSession();
		$this->tawal->AdvancedSearch->unsetSession();
		$this->takhir->AdvancedSearch->unsetSession();
		$this->ketua->AdvancedSearch->unsetSession();
		$this->sekretaris->AdvancedSearch->unsetSession();
		$this->bendahara->AdvancedSearch->unsetSession();
		$this->anggota2->AdvancedSearch->unsetSession();
		$this->widyaiswara->AdvancedSearch->unsetSession();
		$this->tglpel->AdvancedSearch->unsetSession();
		$this->panitia->AdvancedSearch->unsetSession();
		$this->jenisevaluasi->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->th->AdvancedSearch->load();
		$this->idpelat->AdvancedSearch->load();
		$this->kdpelat->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->tawal->AdvancedSearch->load();
		$this->takhir->AdvancedSearch->load();
		$this->ketua->AdvancedSearch->load();
		$this->sekretaris->AdvancedSearch->load();
		$this->bendahara->AdvancedSearch->load();
		$this->anggota2->AdvancedSearch->load();
		$this->widyaiswara->AdvancedSearch->load();
		$this->tglpel->AdvancedSearch->load();
		$this->panitia->AdvancedSearch->load();
		$this->jenisevaluasi->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->th); // th
			$this->updateSort($this->idpelat); // idpelat
			$this->updateSort($this->kdpelat); // kdpelat
			$this->updateSort($this->kdjudul); // kdjudul
			$this->updateSort($this->tawal); // tawal
			$this->updateSort($this->takhir); // takhir
			$this->updateSort($this->tglpel); // tglpel
			$this->updateSort($this->panitia); // panitia
			$this->updateSort($this->jenisevaluasi); // jenisevaluasi
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
				$this->tawal->setSort("ASC");
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
				$this->th->setSort("");
				$this->idpelat->setSort("");
				$this->kdpelat->setSort("");
				$this->kdjudul->setSort("");
				$this->tawal->setSort("");
				$this->takhir->setSort("");
				$this->tglpel->setSort("");
				$this->panitia->setSort("");
				$this->jenisevaluasi->setSort("");
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
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"evaluasi\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->idpelat->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fevaluasilistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fevaluasilistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fevaluasilist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// th
		if (!$this->isAddOrEdit() && $this->th->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->th->AdvancedSearch->SearchValue != "" || $this->th->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// idpelat
		if (!$this->isAddOrEdit() && $this->idpelat->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->idpelat->AdvancedSearch->SearchValue != "" || $this->idpelat->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdpelat
		if (!$this->isAddOrEdit() && $this->kdpelat->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdpelat->AdvancedSearch->SearchValue != "" || $this->kdpelat->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdjudul
		if (!$this->isAddOrEdit() && $this->kdjudul->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdjudul->AdvancedSearch->SearchValue != "" || $this->kdjudul->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tawal
		if (!$this->isAddOrEdit() && $this->tawal->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tawal->AdvancedSearch->SearchValue != "" || $this->tawal->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// takhir
		if (!$this->isAddOrEdit() && $this->takhir->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->takhir->AdvancedSearch->SearchValue != "" || $this->takhir->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ketua
		if (!$this->isAddOrEdit() && $this->ketua->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ketua->AdvancedSearch->SearchValue != "" || $this->ketua->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// sekretaris
		if (!$this->isAddOrEdit() && $this->sekretaris->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->sekretaris->AdvancedSearch->SearchValue != "" || $this->sekretaris->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// bendahara
		if (!$this->isAddOrEdit() && $this->bendahara->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->bendahara->AdvancedSearch->SearchValue != "" || $this->bendahara->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// anggota2
		if (!$this->isAddOrEdit() && $this->anggota2->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->anggota2->AdvancedSearch->SearchValue != "" || $this->anggota2->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// widyaiswara
		if (!$this->isAddOrEdit() && $this->widyaiswara->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->widyaiswara->AdvancedSearch->SearchValue != "" || $this->widyaiswara->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tglpel
		if (!$this->isAddOrEdit() && $this->tglpel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tglpel->AdvancedSearch->SearchValue != "" || $this->tglpel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// panitia
		if (!$this->isAddOrEdit() && $this->panitia->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->panitia->AdvancedSearch->SearchValue != "" || $this->panitia->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jenisevaluasi
		if (!$this->isAddOrEdit() && $this->jenisevaluasi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jenisevaluasi->AdvancedSearch->SearchValue != "" || $this->jenisevaluasi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->th->setDbValue($row['th']);
		$this->idpelat->setDbValue($row['idpelat']);
		$this->kdpelat->setDbValue($row['kdpelat']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->tawal->setDbValue($row['tawal']);
		$this->takhir->setDbValue($row['takhir']);
		$this->ketua->setDbValue($row['ketua']);
		$this->sekretaris->setDbValue($row['sekretaris']);
		$this->bendahara->setDbValue($row['bendahara']);
		$this->anggota2->setDbValue($row['anggota2']);
		$this->widyaiswara->setDbValue($row['widyaiswara']);
		$this->tglpel->setDbValue($row['tglpel']);
		$this->panitia->setDbValue($row['panitia']);
		$this->jenisevaluasi->setDbValue($row['jenisevaluasi']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['th'] = NULL;
		$row['idpelat'] = NULL;
		$row['kdpelat'] = NULL;
		$row['kdjudul'] = NULL;
		$row['tawal'] = NULL;
		$row['takhir'] = NULL;
		$row['ketua'] = NULL;
		$row['sekretaris'] = NULL;
		$row['bendahara'] = NULL;
		$row['anggota2'] = NULL;
		$row['widyaiswara'] = NULL;
		$row['tglpel'] = NULL;
		$row['panitia'] = NULL;
		$row['jenisevaluasi'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idpelat")) != "")
			$this->idpelat->OldValue = $this->getKey("idpelat"); // idpelat
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
		// th
		// idpelat
		// kdpelat
		// kdjudul
		// tawal
		// takhir
		// ketua
		// sekretaris
		// bendahara
		// anggota2
		// widyaiswara
		// tglpel
		// panitia
		// jenisevaluasi

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// th
			$curVal = strval($this->th->CurrentValue);
			if ($curVal != "") {
				$this->th->ViewValue = $this->th->lookupCacheOption($curVal);
				if ($this->th->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`tahun` BETWEEN YEAR(CURDATE())-8 AND YEAR(CURDATE())+1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->th->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->th->ViewValue = $this->th->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->th->ViewValue = $this->th->CurrentValue;
					}
				}
			} else {
				$this->th->ViewValue = NULL;
			}
			$this->th->ViewCustomAttributes = "";

			// idpelat
			$curVal = strval($this->idpelat->CurrentValue);
			if ($curVal != "") {
				$this->idpelat->ViewValue = $this->idpelat->lookupCacheOption($curVal);
				if ($this->idpelat->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idpelat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->idpelat->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->idpelat->ViewValue = $this->idpelat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
					}
				}
			} else {
				$this->idpelat->ViewValue = NULL;
			}
			$this->idpelat->ViewCustomAttributes = "";

			// kdpelat
			$this->kdpelat->ViewValue = $this->kdpelat->CurrentValue;
			$this->kdpelat->ViewCustomAttributes = "";

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

			// tawal
			$this->tawal->ViewValue = $this->tawal->CurrentValue;
			$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
			$this->tawal->ViewCustomAttributes = "";

			// takhir
			$this->takhir->ViewValue = $this->takhir->CurrentValue;
			$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
			$this->takhir->ViewCustomAttributes = "";

			// ketua
			$this->ketua->ViewValue = $this->ketua->CurrentValue;
			$curVal = strval($this->ketua->CurrentValue);
			if ($curVal != "") {
				$this->ketua->ViewValue = $this->ketua->lookupCacheOption($curVal);
				if ($this->ketua->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ketua->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ketua->ViewValue = $this->ketua->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ketua->ViewValue = $this->ketua->CurrentValue;
					}
				}
			} else {
				$this->ketua->ViewValue = NULL;
			}
			$this->ketua->ViewCustomAttributes = "";

			// sekretaris
			$this->sekretaris->ViewValue = $this->sekretaris->CurrentValue;
			$curVal = strval($this->sekretaris->CurrentValue);
			if ($curVal != "") {
				$this->sekretaris->ViewValue = $this->sekretaris->lookupCacheOption($curVal);
				if ($this->sekretaris->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->sekretaris->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->sekretaris->ViewValue = $this->sekretaris->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sekretaris->ViewValue = $this->sekretaris->CurrentValue;
					}
				}
			} else {
				$this->sekretaris->ViewValue = NULL;
			}
			$this->sekretaris->ViewCustomAttributes = "";

			// bendahara
			$this->bendahara->ViewValue = $this->bendahara->CurrentValue;
			$curVal = strval($this->bendahara->CurrentValue);
			if ($curVal != "") {
				$this->bendahara->ViewValue = $this->bendahara->lookupCacheOption($curVal);
				if ($this->bendahara->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->bendahara->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->bendahara->ViewValue = $this->bendahara->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->bendahara->ViewValue = $this->bendahara->CurrentValue;
					}
				}
			} else {
				$this->bendahara->ViewValue = NULL;
			}
			$this->bendahara->ViewCustomAttributes = "";

			// anggota2
			$this->anggota2->ViewValue = $this->anggota2->CurrentValue;
			$curVal = strval($this->anggota2->CurrentValue);
			if ($curVal != "") {
				$this->anggota2->ViewValue = $this->anggota2->lookupCacheOption($curVal);
				if ($this->anggota2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->anggota2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->anggota2->ViewValue = $this->anggota2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->anggota2->ViewValue = $this->anggota2->CurrentValue;
					}
				}
			} else {
				$this->anggota2->ViewValue = NULL;
			}
			$this->anggota2->ViewCustomAttributes = "";

			// widyaiswara
			$this->widyaiswara->ViewValue = $this->widyaiswara->CurrentValue;
			$curVal = strval($this->widyaiswara->CurrentValue);
			if ($curVal != "") {
				$this->widyaiswara->ViewValue = $this->widyaiswara->lookupCacheOption($curVal);
				if ($this->widyaiswara->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->widyaiswara->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->widyaiswara->ViewValue = $this->widyaiswara->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->widyaiswara->ViewValue = $this->widyaiswara->CurrentValue;
					}
				}
			} else {
				$this->widyaiswara->ViewValue = NULL;
			}
			$this->widyaiswara->ViewCustomAttributes = "";

			// tglpel
			$this->tglpel->ViewValue = $this->tglpel->CurrentValue;
			$this->tglpel->CellCssStyle .= "text-align: right;";
			$this->tglpel->ViewCustomAttributes = "";

			// panitia
			$this->panitia->ViewValue = $this->panitia->CurrentValue;
			$this->panitia->ViewCustomAttributes = "";

			// jenisevaluasi
			$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->CurrentValue;
			$this->jenisevaluasi->ViewCustomAttributes = "";

			// th
			$this->th->LinkCustomAttributes = "";
			$this->th->HrefValue = "";
			$this->th->TooltipValue = "";

			// idpelat
			$this->idpelat->LinkCustomAttributes = "";
			$this->idpelat->HrefValue = "";
			$this->idpelat->TooltipValue = "";

			// kdpelat
			$this->kdpelat->LinkCustomAttributes = "";
			$this->kdpelat->HrefValue = "";
			$this->kdpelat->TooltipValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";
			$this->tawal->TooltipValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";
			$this->takhir->TooltipValue = "";

			// tglpel
			$this->tglpel->LinkCustomAttributes = "";
			$this->tglpel->HrefValue = "";
			$this->tglpel->TooltipValue = "";

			// panitia
			$this->panitia->LinkCustomAttributes = "";
			$this->panitia->HrefValue = "";
			$this->panitia->TooltipValue = "";

			// jenisevaluasi
			$this->jenisevaluasi->LinkCustomAttributes = "";
			$this->jenisevaluasi->HrefValue = "";
			$this->jenisevaluasi->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// th
			$this->th->EditAttrs["class"] = "form-control";
			$this->th->EditCustomAttributes = "";
			$curVal = trim(strval($this->th->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->th->AdvancedSearch->ViewValue = $this->th->lookupCacheOption($curVal);
			else
				$this->th->AdvancedSearch->ViewValue = $this->th->Lookup !== NULL && is_array($this->th->Lookup->Options) ? $curVal : NULL;
			if ($this->th->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->th->EditValue = array_values($this->th->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`tahun`" . SearchString("=", $this->th->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`tahun` BETWEEN YEAR(CURDATE())-8 AND YEAR(CURDATE())+1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->th->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->th->EditValue = $arwrk;
			}

			// idpelat
			$this->idpelat->EditCustomAttributes = "";
			$curVal = trim(strval($this->idpelat->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->idpelat->AdvancedSearch->ViewValue = $this->idpelat->lookupCacheOption($curVal);
			else
				$this->idpelat->AdvancedSearch->ViewValue = $this->idpelat->Lookup !== NULL && is_array($this->idpelat->Lookup->Options) ? $curVal : NULL;
			if ($this->idpelat->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->idpelat->EditValue = array_values($this->idpelat->Lookup->Options);
				if ($this->idpelat->AdvancedSearch->ViewValue == "")
					$this->idpelat->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idpelat`" . SearchString("=", $this->idpelat->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->idpelat->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
					$this->idpelat->AdvancedSearch->ViewValue = $this->idpelat->displayValue($arwrk);
				} else {
					$this->idpelat->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->idpelat->EditValue = $arwrk;
			}

			// kdpelat
			$this->kdpelat->EditAttrs["class"] = "form-control";
			$this->kdpelat->EditCustomAttributes = "";
			if (!$this->kdpelat->Raw)
				$this->kdpelat->AdvancedSearch->SearchValue = HtmlDecode($this->kdpelat->AdvancedSearch->SearchValue);
			$this->kdpelat->EditValue = HtmlEncode($this->kdpelat->AdvancedSearch->SearchValue);
			$this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if (!$this->kdjudul->Raw)
				$this->kdjudul->AdvancedSearch->SearchValue = HtmlDecode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

			// tawal
			$this->tawal->EditAttrs["class"] = "form-control";
			$this->tawal->EditCustomAttributes = "";
			$this->tawal->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tawal->AdvancedSearch->SearchValue, 0), 8));
			$this->tawal->PlaceHolder = RemoveHtml($this->tawal->caption());

			// takhir
			$this->takhir->EditAttrs["class"] = "form-control";
			$this->takhir->EditCustomAttributes = "";
			$this->takhir->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->takhir->AdvancedSearch->SearchValue, 0), 8));
			$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

			// tglpel
			$this->tglpel->EditAttrs["class"] = "form-control";
			$this->tglpel->EditCustomAttributes = "";
			$this->tglpel->EditValue = HtmlEncode($this->tglpel->AdvancedSearch->SearchValue);
			$this->tglpel->PlaceHolder = RemoveHtml($this->tglpel->caption());

			// panitia
			$this->panitia->EditAttrs["class"] = "form-control";
			$this->panitia->EditCustomAttributes = "";
			$this->panitia->EditValue = HtmlEncode($this->panitia->AdvancedSearch->SearchValue);
			$this->panitia->PlaceHolder = RemoveHtml($this->panitia->caption());

			// jenisevaluasi
			$this->jenisevaluasi->EditAttrs["class"] = "form-control";
			$this->jenisevaluasi->EditCustomAttributes = "";
			if (!$this->jenisevaluasi->Raw)
				$this->jenisevaluasi->AdvancedSearch->SearchValue = HtmlDecode($this->jenisevaluasi->AdvancedSearch->SearchValue);
			$this->jenisevaluasi->EditValue = HtmlEncode($this->jenisevaluasi->AdvancedSearch->SearchValue);
			$this->jenisevaluasi->PlaceHolder = RemoveHtml($this->jenisevaluasi->caption());
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
		$this->th->AdvancedSearch->load();
		$this->idpelat->AdvancedSearch->load();
		$this->kdpelat->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->tawal->AdvancedSearch->load();
		$this->takhir->AdvancedSearch->load();
		$this->ketua->AdvancedSearch->load();
		$this->sekretaris->AdvancedSearch->load();
		$this->bendahara->AdvancedSearch->load();
		$this->anggota2->AdvancedSearch->load();
		$this->widyaiswara->AdvancedSearch->load();
		$this->tglpel->AdvancedSearch->load();
		$this->panitia->AdvancedSearch->load();
		$this->jenisevaluasi->AdvancedSearch->load();
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fevaluasilistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ResetSearch") . "\" data-caption=\"" . $Language->phrase("ResetSearch") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ResetSearchBtn") . "</a>";
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
				case "x_th":
					$lookupFilter = function() {
						return "`tahun` BETWEEN YEAR(CURDATE())-8 AND YEAR(CURDATE())+1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_idpelat":
					break;
				case "x_kdjudul":
					break;
				case "x_ketua":
					break;
				case "x_sekretaris":
					break;
				case "x_bendahara":
					break;
				case "x_anggota2":
					break;
				case "x_widyaiswara":
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
						case "x_th":
							break;
						case "x_idpelat":
							break;
						case "x_kdjudul":
							break;
						case "x_ketua":
							break;
						case "x_sekretaris":
							break;
						case "x_bendahara":
							break;
						case "x_anggota2":
							break;
						case "x_widyaiswara":
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

		$this->th->Visible = FALSE;
		$this->kdjudul->Visible = FALSE;
		$this->tawal->Visible = FALSE;
		$this->takhir->Visible = FALSE;
		$this->ketua->Visible = FALSE;
		$this->bendahara->Visible = FALSE;
		$this->sekretaris->Visible = FALSE;	
		$this->anggota2->Visible = FALSE;
		$this->widyaiswara->Visible = FALSE;
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

		/*
		$this->ListOptions->Items["detail_t_evafas"]->Visible = FALSE;
		$this->ListOptions->Items["detail_t_evakunjlap"]->Visible = FALSE;
		$this->ListOptions->Items["detail_t_evapant"]->Visible = FALSE;
		$this->ListOptions->Items["detail_t_evasis"]->Visible = FALSE;
		$this->ListOptions->Items["detail_t_evakhir"]->Visible = FALSE;
		$this->ListOptions->Items["detail_t_preposttest"]->Visible = FALSE;
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