<?php
namespace PHPMaker2020\input_ecp;

/**
 * Page class
 */
class dm_ecp_list extends dm_ecp
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{9B9A621D-5170-4F08-8852-72A13BB88C54}";

	// Table name
	public $TableName = 'dm_ecp';

	// Page object name
	public $PageObjName = "dm_ecp_list";

	// Grid form hidden field names
	public $FormName = "fdm_ecplist";
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
		$hidden = TRUE;
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

		// Table object (dm_ecp)
		if (!isset($GLOBALS["dm_ecp"]) || get_class($GLOBALS["dm_ecp"]) == PROJECT_NAMESPACE . "dm_ecp") {
			$GLOBALS["dm_ecp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["dm_ecp"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "dm_ecpadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "dm_ecpdelete.php";
		$this->MultiUpdateUrl = "dm_ecpupdate.php";

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'dm_ecp');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

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
		$this->FilterOptions->TagClassName = "ew-filter-option fdm_ecplistsrch";

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
		global $dm_ecp;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($dm_ecp);
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
			$key .= @$ar['ID_ECP'];
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
		if (!$Security->isLoggedIn()) // Logged in
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
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
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
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup import options
		$this->setupImportOptions();
		$this->ID_ECP->setVisibility();
		$this->Nama->setVisibility();
		$this->Perusahaan->setVisibility();
		$this->Daerah->setVisibility();
		$this->Produk->setVisibility();
		$this->Tgl_Bln_Ekspor->setVisibility();
		$this->Negara_Tujuan->setVisibility();
		$this->Nilai_Ekspor_USD->setVisibility();
		$this->Nilai_Ekspor_Rupiah->setVisibility();
		$this->Keterangan->setVisibility();
		$this->Wilayah_ECP->setVisibility();
		$this->Tahun_ECP->setVisibility();
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
		$this->setupLookupOptions($this->Nama);
		$this->setupLookupOptions($this->Perusahaan);
		$this->setupLookupOptions($this->Wilayah_ECP);

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

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid edit mode
				if ($this->isGridEdit())
					$this->gridEditMode();

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Process import
					if ($this->isImport()) {
						$this->import(Post(Config("API_FILE_TOKEN_NAME")));
						$this->terminate();
					}

					// Grid Update
					if (($this->isGridUpdate() || $this->isGridOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "gridedit") {
						if ($this->validateGridForm()) {
							$gridUpdate = $this->gridUpdate();
						} else {
							$gridUpdate = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridUpdate) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridEditMode(); // Stay in Grid edit mode
						}
					}

					// Grid Insert
					if ($this->isGridInsert() && @$_SESSION[SESSION_INLINE_MODE] == "gridadd") {
						if ($this->validateGridForm()) {
							$gridInsert = $this->gridInsert();
						} else {
							$gridInsert = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridInsert) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridAddMode(); // Stay in Grid add mode
						}
					}
				} elseif (@$_SESSION[SESSION_INLINE_MODE] == "gridedit") { // Previously in grid edit mode
					if (Get(Config("TABLE_START_REC")) !== NULL || Get(Config("TABLE_PAGE_NO")) !== NULL) // Stay in grid edit mode if paging
						$this->gridEditMode();
					else // Reset grid edit
						$this->clearInlineMode();
				}
			}

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

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

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

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

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

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
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
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
		$this->Nilai_Ekspor_USD->FormValue = ""; // Clear form value
		$this->Nilai_Ekspor_Rupiah->FormValue = ""; // Clear form value
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

		// Begin transaction
		$conn->beginTrans();
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
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
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
			$this->ID_ECP->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ID_ECP->OldValue))
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

		// Begin transaction
		$conn->beginTrans();

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
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
					$key .= $this->ID_ECP->CurrentValue;

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
			$this->setFailureMessage($Language->phrase("NoAddRecord"));
			$gridInsert = FALSE;
		}
		if ($gridInsert) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("InsertSuccess")); // Set up insert success message
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_Nama") && $CurrentForm->hasValue("o_Nama") && $this->Nama->CurrentValue != $this->Nama->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Perusahaan") && $CurrentForm->hasValue("o_Perusahaan") && $this->Perusahaan->CurrentValue != $this->Perusahaan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Daerah") && $CurrentForm->hasValue("o_Daerah") && $this->Daerah->CurrentValue != $this->Daerah->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Produk") && $CurrentForm->hasValue("o_Produk") && $this->Produk->CurrentValue != $this->Produk->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Tgl_Bln_Ekspor") && $CurrentForm->hasValue("o_Tgl_Bln_Ekspor") && $this->Tgl_Bln_Ekspor->CurrentValue != $this->Tgl_Bln_Ekspor->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Negara_Tujuan") && $CurrentForm->hasValue("o_Negara_Tujuan") && $this->Negara_Tujuan->CurrentValue != $this->Negara_Tujuan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Nilai_Ekspor_USD") && $CurrentForm->hasValue("o_Nilai_Ekspor_USD") && $this->Nilai_Ekspor_USD->CurrentValue != $this->Nilai_Ekspor_USD->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Nilai_Ekspor_Rupiah") && $CurrentForm->hasValue("o_Nilai_Ekspor_Rupiah") && $this->Nilai_Ekspor_Rupiah->CurrentValue != $this->Nilai_Ekspor_Rupiah->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Keterangan") && $CurrentForm->hasValue("o_Keterangan") && $this->Keterangan->CurrentValue != $this->Keterangan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Wilayah_ECP") && $CurrentForm->hasValue("o_Wilayah_ECP") && $this->Wilayah_ECP->CurrentValue != $this->Wilayah_ECP->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Tahun_ECP") && $CurrentForm->hasValue("o_Tahun_ECP") && $this->Tahun_ECP->CurrentValue != $this->Tahun_ECP->OldValue)
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

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->ID_ECP->AdvancedSearch->toJson(), ","); // Field ID_ECP
		$filterList = Concat($filterList, $this->Nama->AdvancedSearch->toJson(), ","); // Field Nama
		$filterList = Concat($filterList, $this->Perusahaan->AdvancedSearch->toJson(), ","); // Field Perusahaan
		$filterList = Concat($filterList, $this->Daerah->AdvancedSearch->toJson(), ","); // Field Daerah
		$filterList = Concat($filterList, $this->Produk->AdvancedSearch->toJson(), ","); // Field Produk
		$filterList = Concat($filterList, $this->Tgl_Bln_Ekspor->AdvancedSearch->toJson(), ","); // Field Tgl_Bln_Ekspor
		$filterList = Concat($filterList, $this->Negara_Tujuan->AdvancedSearch->toJson(), ","); // Field Negara_Tujuan
		$filterList = Concat($filterList, $this->Nilai_Ekspor_USD->AdvancedSearch->toJson(), ","); // Field Nilai_Ekspor_USD
		$filterList = Concat($filterList, $this->Nilai_Ekspor_Rupiah->AdvancedSearch->toJson(), ","); // Field Nilai_Ekspor_Rupiah
		$filterList = Concat($filterList, $this->Keterangan->AdvancedSearch->toJson(), ","); // Field Keterangan
		$filterList = Concat($filterList, $this->Wilayah_ECP->AdvancedSearch->toJson(), ","); // Field Wilayah_ECP
		$filterList = Concat($filterList, $this->Tahun_ECP->AdvancedSearch->toJson(), ","); // Field Tahun_ECP
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

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
			$UserProfile->setSearchFilters(CurrentUserName(), "fdm_ecplistsrch", $filters);
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

		// Field Daerah
		$this->Daerah->AdvancedSearch->SearchValue = @$filter["x_Daerah"];
		$this->Daerah->AdvancedSearch->SearchOperator = @$filter["z_Daerah"];
		$this->Daerah->AdvancedSearch->SearchCondition = @$filter["v_Daerah"];
		$this->Daerah->AdvancedSearch->SearchValue2 = @$filter["y_Daerah"];
		$this->Daerah->AdvancedSearch->SearchOperator2 = @$filter["w_Daerah"];
		$this->Daerah->AdvancedSearch->save();

		// Field Produk
		$this->Produk->AdvancedSearch->SearchValue = @$filter["x_Produk"];
		$this->Produk->AdvancedSearch->SearchOperator = @$filter["z_Produk"];
		$this->Produk->AdvancedSearch->SearchCondition = @$filter["v_Produk"];
		$this->Produk->AdvancedSearch->SearchValue2 = @$filter["y_Produk"];
		$this->Produk->AdvancedSearch->SearchOperator2 = @$filter["w_Produk"];
		$this->Produk->AdvancedSearch->save();

		// Field Tgl_Bln_Ekspor
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue = @$filter["x_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchOperator = @$filter["z_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchCondition = @$filter["v_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue2 = @$filter["y_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchOperator2 = @$filter["w_Tgl_Bln_Ekspor"];
		$this->Tgl_Bln_Ekspor->AdvancedSearch->save();

		// Field Negara_Tujuan
		$this->Negara_Tujuan->AdvancedSearch->SearchValue = @$filter["x_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->SearchOperator = @$filter["z_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->SearchCondition = @$filter["v_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->SearchValue2 = @$filter["y_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->SearchOperator2 = @$filter["w_Negara_Tujuan"];
		$this->Negara_Tujuan->AdvancedSearch->save();

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

		// Field Keterangan
		$this->Keterangan->AdvancedSearch->SearchValue = @$filter["x_Keterangan"];
		$this->Keterangan->AdvancedSearch->SearchOperator = @$filter["z_Keterangan"];
		$this->Keterangan->AdvancedSearch->SearchCondition = @$filter["v_Keterangan"];
		$this->Keterangan->AdvancedSearch->SearchValue2 = @$filter["y_Keterangan"];
		$this->Keterangan->AdvancedSearch->SearchOperator2 = @$filter["w_Keterangan"];
		$this->Keterangan->AdvancedSearch->save();

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
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		$this->buildSearchSql($where, $this->ID_ECP, $default, FALSE); // ID_ECP
		$this->buildSearchSql($where, $this->Nama, $default, FALSE); // Nama
		$this->buildSearchSql($where, $this->Perusahaan, $default, FALSE); // Perusahaan
		$this->buildSearchSql($where, $this->Daerah, $default, FALSE); // Daerah
		$this->buildSearchSql($where, $this->Produk, $default, FALSE); // Produk
		$this->buildSearchSql($where, $this->Tgl_Bln_Ekspor, $default, FALSE); // Tgl_Bln_Ekspor
		$this->buildSearchSql($where, $this->Negara_Tujuan, $default, FALSE); // Negara_Tujuan
		$this->buildSearchSql($where, $this->Nilai_Ekspor_USD, $default, FALSE); // Nilai_Ekspor_USD
		$this->buildSearchSql($where, $this->Nilai_Ekspor_Rupiah, $default, FALSE); // Nilai_Ekspor_Rupiah
		$this->buildSearchSql($where, $this->Keterangan, $default, FALSE); // Keterangan
		$this->buildSearchSql($where, $this->Wilayah_ECP, $default, FALSE); // Wilayah_ECP
		$this->buildSearchSql($where, $this->Tahun_ECP, $default, FALSE); // Tahun_ECP

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->ID_ECP->AdvancedSearch->save(); // ID_ECP
			$this->Nama->AdvancedSearch->save(); // Nama
			$this->Perusahaan->AdvancedSearch->save(); // Perusahaan
			$this->Daerah->AdvancedSearch->save(); // Daerah
			$this->Produk->AdvancedSearch->save(); // Produk
			$this->Tgl_Bln_Ekspor->AdvancedSearch->save(); // Tgl_Bln_Ekspor
			$this->Negara_Tujuan->AdvancedSearch->save(); // Negara_Tujuan
			$this->Nilai_Ekspor_USD->AdvancedSearch->save(); // Nilai_Ekspor_USD
			$this->Nilai_Ekspor_Rupiah->AdvancedSearch->save(); // Nilai_Ekspor_Rupiah
			$this->Keterangan->AdvancedSearch->save(); // Keterangan
			$this->Wilayah_ECP->AdvancedSearch->save(); // Wilayah_ECP
			$this->Tahun_ECP->AdvancedSearch->save(); // Tahun_ECP
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

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->Nama, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Perusahaan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Daerah, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Produk, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Tgl_Bln_Ekspor, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Negara_Tujuan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Keterangan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Wilayah_ECP, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->ID_ECP->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Nama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Perusahaan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Daerah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Produk->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Tgl_Bln_Ekspor->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Negara_Tujuan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Nilai_Ekspor_USD->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Nilai_Ekspor_Rupiah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Keterangan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Wilayah_ECP->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Tahun_ECP->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->ID_ECP->AdvancedSearch->unsetSession();
		$this->Nama->AdvancedSearch->unsetSession();
		$this->Perusahaan->AdvancedSearch->unsetSession();
		$this->Daerah->AdvancedSearch->unsetSession();
		$this->Produk->AdvancedSearch->unsetSession();
		$this->Tgl_Bln_Ekspor->AdvancedSearch->unsetSession();
		$this->Negara_Tujuan->AdvancedSearch->unsetSession();
		$this->Nilai_Ekspor_USD->AdvancedSearch->unsetSession();
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->unsetSession();
		$this->Keterangan->AdvancedSearch->unsetSession();
		$this->Wilayah_ECP->AdvancedSearch->unsetSession();
		$this->Tahun_ECP->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->ID_ECP->AdvancedSearch->load();
		$this->Nama->AdvancedSearch->load();
		$this->Perusahaan->AdvancedSearch->load();
		$this->Daerah->AdvancedSearch->load();
		$this->Produk->AdvancedSearch->load();
		$this->Tgl_Bln_Ekspor->AdvancedSearch->load();
		$this->Negara_Tujuan->AdvancedSearch->load();
		$this->Nilai_Ekspor_USD->AdvancedSearch->load();
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->load();
		$this->Keterangan->AdvancedSearch->load();
		$this->Wilayah_ECP->AdvancedSearch->load();
		$this->Tahun_ECP->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->ID_ECP); // ID_ECP
			$this->updateSort($this->Nama); // Nama
			$this->updateSort($this->Perusahaan); // Perusahaan
			$this->updateSort($this->Daerah); // Daerah
			$this->updateSort($this->Produk); // Produk
			$this->updateSort($this->Tgl_Bln_Ekspor); // Tgl_Bln_Ekspor
			$this->updateSort($this->Negara_Tujuan); // Negara_Tujuan
			$this->updateSort($this->Nilai_Ekspor_USD); // Nilai_Ekspor_USD
			$this->updateSort($this->Nilai_Ekspor_Rupiah); // Nilai_Ekspor_Rupiah
			$this->updateSort($this->Keterangan); // Keterangan
			$this->updateSort($this->Wilayah_ECP); // Wilayah_ECP
			$this->updateSort($this->Tahun_ECP); // Tahun_ECP
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
				$this->ID_ECP->setSort("");
				$this->Nama->setSort("");
				$this->Perusahaan->setSort("");
				$this->Daerah->setSort("");
				$this->Produk->setSort("");
				$this->Tgl_Bln_Ekspor->setSort("");
				$this->Negara_Tujuan->setSort("");
				$this->Nilai_Ekspor_USD->setSort("");
				$this->Nilai_Ekspor_Rupiah->setSort("");
				$this->Keterangan->setSort("");
				$this->Wilayah_ECP->setSort("");
				$this->Tahun_ECP->setSort("");
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

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
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

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
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
			if ($this->isGridAdd() || $this->isGridEdit()) {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
			}
		}

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

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ID_ECP->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ID_ECP->CurrentValue . "\">";
		}
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
		$item = &$option->add("gridadd");
		$item->Body = "<a class=\"ew-add-edit ew-grid-add\" title=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" href=\"" . HtmlEncode($this->GridAddUrl) . "\">" . $Language->phrase("GridAddLink") . "</a>";
		$item->Visible = $this->GridAddUrl != "" && $Security->canAdd();

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->add("gridedit");
		$item->Body = "<a class=\"ew-add-edit ew-grid-edit\" title=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->phrase("GridEditLink") . "</a>";
		$item->Visible = $this->GridEditUrl != "" && $Security->canEdit();
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fdm_ecplistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fdm_ecplistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fdm_ecplist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as $option)
				$option->hideAllOptions();

			// Grid-Add
			if ($this->isGridAdd()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = $options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = $options["action"];
				$option->UseDropDownButton = FALSE;

				// Add grid insert
				$item = &$option->add("gridinsert");
				$item->Body = "<a class=\"ew-action ew-grid-insert\" title=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->add("gridcancel");
				$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
				$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}

			// Grid-Edit
			if ($this->isGridEdit()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = $options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = $options["action"];
				$option->UseDropDownButton = FALSE;
					$item = &$option->add("gridsave");
					$item->Body = "<a class=\"ew-action ew-grid-save\" title=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridSaveLink") . "</a>";
					$item = &$option->add("gridcancel");
					$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
					$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}
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

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ID_ECP->CurrentValue = NULL;
		$this->ID_ECP->OldValue = $this->ID_ECP->CurrentValue;
		$this->Nama->CurrentValue = NULL;
		$this->Nama->OldValue = $this->Nama->CurrentValue;
		$this->Perusahaan->CurrentValue = NULL;
		$this->Perusahaan->OldValue = $this->Perusahaan->CurrentValue;
		$this->Daerah->CurrentValue = NULL;
		$this->Daerah->OldValue = $this->Daerah->CurrentValue;
		$this->Produk->CurrentValue = NULL;
		$this->Produk->OldValue = $this->Produk->CurrentValue;
		$this->Tgl_Bln_Ekspor->CurrentValue = NULL;
		$this->Tgl_Bln_Ekspor->OldValue = $this->Tgl_Bln_Ekspor->CurrentValue;
		$this->Negara_Tujuan->CurrentValue = NULL;
		$this->Negara_Tujuan->OldValue = $this->Negara_Tujuan->CurrentValue;
		$this->Nilai_Ekspor_USD->CurrentValue = NULL;
		$this->Nilai_Ekspor_USD->OldValue = $this->Nilai_Ekspor_USD->CurrentValue;
		$this->Nilai_Ekspor_Rupiah->CurrentValue = NULL;
		$this->Nilai_Ekspor_Rupiah->OldValue = $this->Nilai_Ekspor_Rupiah->CurrentValue;
		$this->Keterangan->CurrentValue = NULL;
		$this->Keterangan->OldValue = $this->Keterangan->CurrentValue;
		$this->Wilayah_ECP->CurrentValue = NULL;
		$this->Wilayah_ECP->OldValue = $this->Wilayah_ECP->CurrentValue;
		$this->Tahun_ECP->CurrentValue = NULL;
		$this->Tahun_ECP->OldValue = $this->Tahun_ECP->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
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

		// Daerah
		if (!$this->isAddOrEdit() && $this->Daerah->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Daerah->AdvancedSearch->SearchValue != "" || $this->Daerah->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Produk
		if (!$this->isAddOrEdit() && $this->Produk->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Produk->AdvancedSearch->SearchValue != "" || $this->Produk->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Tgl_Bln_Ekspor
		if (!$this->isAddOrEdit() && $this->Tgl_Bln_Ekspor->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue != "" || $this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Negara_Tujuan
		if (!$this->isAddOrEdit() && $this->Negara_Tujuan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Negara_Tujuan->AdvancedSearch->SearchValue != "" || $this->Negara_Tujuan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// Keterangan
		if (!$this->isAddOrEdit() && $this->Keterangan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Keterangan->AdvancedSearch->SearchValue != "" || $this->Keterangan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ID_ECP' first before field var 'x_ID_ECP'
		$val = $CurrentForm->hasValue("ID_ECP") ? $CurrentForm->getValue("ID_ECP") : $CurrentForm->getValue("x_ID_ECP");
		if (!$this->ID_ECP->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->ID_ECP->setFormValue($val);

		// Check field name 'Nama' first before field var 'x_Nama'
		$val = $CurrentForm->hasValue("Nama") ? $CurrentForm->getValue("Nama") : $CurrentForm->getValue("x_Nama");
		if (!$this->Nama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Nama->Visible = FALSE; // Disable update for API request
			else
				$this->Nama->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Nama"))
			$this->Nama->setOldValue($CurrentForm->getValue("o_Nama"));

		// Check field name 'Perusahaan' first before field var 'x_Perusahaan'
		$val = $CurrentForm->hasValue("Perusahaan") ? $CurrentForm->getValue("Perusahaan") : $CurrentForm->getValue("x_Perusahaan");
		if (!$this->Perusahaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->Perusahaan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Perusahaan"))
			$this->Perusahaan->setOldValue($CurrentForm->getValue("o_Perusahaan"));

		// Check field name 'Daerah' first before field var 'x_Daerah'
		$val = $CurrentForm->hasValue("Daerah") ? $CurrentForm->getValue("Daerah") : $CurrentForm->getValue("x_Daerah");
		if (!$this->Daerah->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Daerah->Visible = FALSE; // Disable update for API request
			else
				$this->Daerah->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Daerah"))
			$this->Daerah->setOldValue($CurrentForm->getValue("o_Daerah"));

		// Check field name 'Produk' first before field var 'x_Produk'
		$val = $CurrentForm->hasValue("Produk") ? $CurrentForm->getValue("Produk") : $CurrentForm->getValue("x_Produk");
		if (!$this->Produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Produk->Visible = FALSE; // Disable update for API request
			else
				$this->Produk->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Produk"))
			$this->Produk->setOldValue($CurrentForm->getValue("o_Produk"));

		// Check field name 'Tgl_Bln_Ekspor' first before field var 'x_Tgl_Bln_Ekspor'
		$val = $CurrentForm->hasValue("Tgl_Bln_Ekspor") ? $CurrentForm->getValue("Tgl_Bln_Ekspor") : $CurrentForm->getValue("x_Tgl_Bln_Ekspor");
		if (!$this->Tgl_Bln_Ekspor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Tgl_Bln_Ekspor->Visible = FALSE; // Disable update for API request
			else
				$this->Tgl_Bln_Ekspor->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Tgl_Bln_Ekspor"))
			$this->Tgl_Bln_Ekspor->setOldValue($CurrentForm->getValue("o_Tgl_Bln_Ekspor"));

		// Check field name 'Negara_Tujuan' first before field var 'x_Negara_Tujuan'
		$val = $CurrentForm->hasValue("Negara_Tujuan") ? $CurrentForm->getValue("Negara_Tujuan") : $CurrentForm->getValue("x_Negara_Tujuan");
		if (!$this->Negara_Tujuan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Negara_Tujuan->Visible = FALSE; // Disable update for API request
			else
				$this->Negara_Tujuan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Negara_Tujuan"))
			$this->Negara_Tujuan->setOldValue($CurrentForm->getValue("o_Negara_Tujuan"));

		// Check field name 'Nilai_Ekspor_USD' first before field var 'x_Nilai_Ekspor_USD'
		$val = $CurrentForm->hasValue("Nilai_Ekspor_USD") ? $CurrentForm->getValue("Nilai_Ekspor_USD") : $CurrentForm->getValue("x_Nilai_Ekspor_USD");
		if (!$this->Nilai_Ekspor_USD->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Nilai_Ekspor_USD->Visible = FALSE; // Disable update for API request
			else
				$this->Nilai_Ekspor_USD->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Nilai_Ekspor_USD"))
			$this->Nilai_Ekspor_USD->setOldValue($CurrentForm->getValue("o_Nilai_Ekspor_USD"));

		// Check field name 'Nilai_Ekspor_Rupiah' first before field var 'x_Nilai_Ekspor_Rupiah'
		$val = $CurrentForm->hasValue("Nilai_Ekspor_Rupiah") ? $CurrentForm->getValue("Nilai_Ekspor_Rupiah") : $CurrentForm->getValue("x_Nilai_Ekspor_Rupiah");
		if (!$this->Nilai_Ekspor_Rupiah->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Nilai_Ekspor_Rupiah->Visible = FALSE; // Disable update for API request
			else
				$this->Nilai_Ekspor_Rupiah->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Nilai_Ekspor_Rupiah"))
			$this->Nilai_Ekspor_Rupiah->setOldValue($CurrentForm->getValue("o_Nilai_Ekspor_Rupiah"));

		// Check field name 'Keterangan' first before field var 'x_Keterangan'
		$val = $CurrentForm->hasValue("Keterangan") ? $CurrentForm->getValue("Keterangan") : $CurrentForm->getValue("x_Keterangan");
		if (!$this->Keterangan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->Keterangan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Keterangan"))
			$this->Keterangan->setOldValue($CurrentForm->getValue("o_Keterangan"));

		// Check field name 'Wilayah_ECP' first before field var 'x_Wilayah_ECP'
		$val = $CurrentForm->hasValue("Wilayah_ECP") ? $CurrentForm->getValue("Wilayah_ECP") : $CurrentForm->getValue("x_Wilayah_ECP");
		if (!$this->Wilayah_ECP->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Wilayah_ECP->Visible = FALSE; // Disable update for API request
			else
				$this->Wilayah_ECP->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Wilayah_ECP"))
			$this->Wilayah_ECP->setOldValue($CurrentForm->getValue("o_Wilayah_ECP"));

		// Check field name 'Tahun_ECP' first before field var 'x_Tahun_ECP'
		$val = $CurrentForm->hasValue("Tahun_ECP") ? $CurrentForm->getValue("Tahun_ECP") : $CurrentForm->getValue("x_Tahun_ECP");
		if (!$this->Tahun_ECP->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Tahun_ECP->Visible = FALSE; // Disable update for API request
			else
				$this->Tahun_ECP->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Tahun_ECP"))
			$this->Tahun_ECP->setOldValue($CurrentForm->getValue("o_Tahun_ECP"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->ID_ECP->CurrentValue = $this->ID_ECP->FormValue;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->Perusahaan->CurrentValue = $this->Perusahaan->FormValue;
		$this->Daerah->CurrentValue = $this->Daerah->FormValue;
		$this->Produk->CurrentValue = $this->Produk->FormValue;
		$this->Tgl_Bln_Ekspor->CurrentValue = $this->Tgl_Bln_Ekspor->FormValue;
		$this->Negara_Tujuan->CurrentValue = $this->Negara_Tujuan->FormValue;
		$this->Nilai_Ekspor_USD->CurrentValue = $this->Nilai_Ekspor_USD->FormValue;
		$this->Nilai_Ekspor_Rupiah->CurrentValue = $this->Nilai_Ekspor_Rupiah->FormValue;
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
		$this->Wilayah_ECP->CurrentValue = $this->Wilayah_ECP->FormValue;
		$this->Tahun_ECP->CurrentValue = $this->Tahun_ECP->FormValue;
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
			if (!$this->EventCancelled)
				$this->HashValue = $this->getRowHash($rs); // Get hash value for record
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
		$this->Nama->setDbValue($row['Nama']);
		$this->Perusahaan->setDbValue($row['Perusahaan']);
		$this->Daerah->setDbValue($row['Daerah']);
		$this->Produk->setDbValue($row['Produk']);
		$this->Tgl_Bln_Ekspor->setDbValue($row['Tgl_Bln_Ekspor']);
		$this->Negara_Tujuan->setDbValue($row['Negara_Tujuan']);
		$this->Nilai_Ekspor_USD->setDbValue($row['Nilai_Ekspor_USD']);
		$this->Nilai_Ekspor_Rupiah->setDbValue($row['Nilai_Ekspor_Rupiah']);
		$this->Keterangan->setDbValue($row['Keterangan']);
		$this->Wilayah_ECP->setDbValue($row['Wilayah_ECP']);
		$this->Tahun_ECP->setDbValue($row['Tahun_ECP']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_ECP'] = $this->ID_ECP->CurrentValue;
		$row['Nama'] = $this->Nama->CurrentValue;
		$row['Perusahaan'] = $this->Perusahaan->CurrentValue;
		$row['Daerah'] = $this->Daerah->CurrentValue;
		$row['Produk'] = $this->Produk->CurrentValue;
		$row['Tgl_Bln_Ekspor'] = $this->Tgl_Bln_Ekspor->CurrentValue;
		$row['Negara_Tujuan'] = $this->Negara_Tujuan->CurrentValue;
		$row['Nilai_Ekspor_USD'] = $this->Nilai_Ekspor_USD->CurrentValue;
		$row['Nilai_Ekspor_Rupiah'] = $this->Nilai_Ekspor_Rupiah->CurrentValue;
		$row['Keterangan'] = $this->Keterangan->CurrentValue;
		$row['Wilayah_ECP'] = $this->Wilayah_ECP->CurrentValue;
		$row['Tahun_ECP'] = $this->Tahun_ECP->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_ECP")) != "")
			$this->ID_ECP->OldValue = $this->getKey("ID_ECP"); // ID_ECP
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
		if ($this->Nilai_Ekspor_USD->FormValue == $this->Nilai_Ekspor_USD->CurrentValue && is_numeric(ConvertToFloatString($this->Nilai_Ekspor_USD->CurrentValue)))
			$this->Nilai_Ekspor_USD->CurrentValue = ConvertToFloatString($this->Nilai_Ekspor_USD->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Nilai_Ekspor_Rupiah->FormValue == $this->Nilai_Ekspor_Rupiah->CurrentValue && is_numeric(ConvertToFloatString($this->Nilai_Ekspor_Rupiah->CurrentValue)))
			$this->Nilai_Ekspor_Rupiah->CurrentValue = ConvertToFloatString($this->Nilai_Ekspor_Rupiah->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_ECP
		// Nama
		// Perusahaan
		// Daerah
		// Produk
		// Tgl_Bln_Ekspor
		// Negara_Tujuan
		// Nilai_Ekspor_USD
		// Nilai_Ekspor_Rupiah
		// Keterangan
		// Wilayah_ECP
		// Tahun_ECP

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_ECP
			$this->ID_ECP->ViewValue = $this->ID_ECP->CurrentValue;
			$this->ID_ECP->ViewCustomAttributes = "";

			// Nama
			$this->Nama->ViewValue = $this->Nama->CurrentValue;
			$curVal = strval($this->Nama->CurrentValue);
			if ($curVal != "") {
				$this->Nama->ViewValue = $this->Nama->lookupCacheOption($curVal);
				if ($this->Nama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Nama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Nama->ViewValue = $this->Nama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Nama->ViewValue = $this->Nama->CurrentValue;
					}
				}
			} else {
				$this->Nama->ViewValue = NULL;
			}
			$this->Nama->ViewCustomAttributes = "";

			// Perusahaan
			$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
			$curVal = strval($this->Perusahaan->CurrentValue);
			if ($curVal != "") {
				$this->Perusahaan->ViewValue = $this->Perusahaan->lookupCacheOption($curVal);
				if ($this->Perusahaan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Perusahaan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Perusahaan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Perusahaan->ViewValue = $this->Perusahaan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
					}
				}
			} else {
				$this->Perusahaan->ViewValue = NULL;
			}
			$this->Perusahaan->ViewCustomAttributes = "";

			// Daerah
			$this->Daerah->ViewValue = $this->Daerah->CurrentValue;
			$this->Daerah->ViewCustomAttributes = "";

			// Produk
			$this->Produk->ViewValue = $this->Produk->CurrentValue;
			$this->Produk->ViewCustomAttributes = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->ViewValue = $this->Tgl_Bln_Ekspor->CurrentValue;
			$this->Tgl_Bln_Ekspor->ViewCustomAttributes = "";

			// Negara_Tujuan
			$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->CurrentValue;
			$this->Negara_Tujuan->ViewCustomAttributes = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->ViewValue = $this->Nilai_Ekspor_USD->CurrentValue;
			$this->Nilai_Ekspor_USD->ViewValue = FormatNumber($this->Nilai_Ekspor_USD->ViewValue, 2, -2, -2, -2);
			$this->Nilai_Ekspor_USD->ViewCustomAttributes = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->ViewValue = $this->Nilai_Ekspor_Rupiah->CurrentValue;
			$this->Nilai_Ekspor_Rupiah->ViewValue = FormatNumber($this->Nilai_Ekspor_Rupiah->ViewValue, 2, -2, -2, -2);
			$this->Nilai_Ekspor_Rupiah->ViewCustomAttributes = "";

			// Keterangan
			$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
			$this->Keterangan->ViewCustomAttributes = "";

			// Wilayah_ECP
			$arwrk = [];
			$arwrk[1] = $this->Wilayah_ECP->CurrentValue;
			$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->displayValue($arwrk);
			$this->Wilayah_ECP->ViewCustomAttributes = "";

			// Tahun_ECP
			$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
			$this->Tahun_ECP->ViewCustomAttributes = "";

			// ID_ECP
			$this->ID_ECP->LinkCustomAttributes = "";
			$this->ID_ECP->HrefValue = "";
			$this->ID_ECP->TooltipValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";
			$this->Perusahaan->TooltipValue = "";

			// Daerah
			$this->Daerah->LinkCustomAttributes = "";
			$this->Daerah->HrefValue = "";
			$this->Daerah->TooltipValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";
			$this->Produk->TooltipValue = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->LinkCustomAttributes = "";
			$this->Tgl_Bln_Ekspor->HrefValue = "";
			$this->Tgl_Bln_Ekspor->TooltipValue = "";

			// Negara_Tujuan
			$this->Negara_Tujuan->LinkCustomAttributes = "";
			$this->Negara_Tujuan->HrefValue = "";
			$this->Negara_Tujuan->TooltipValue = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_USD->HrefValue = "";
			$this->Nilai_Ekspor_USD->TooltipValue = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->HrefValue = "";
			$this->Nilai_Ekspor_Rupiah->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";
			$this->Wilayah_ECP->TooltipValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
			$this->Tahun_ECP->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ID_ECP
			// Nama

			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			if (!$this->Nama->Raw)
				$this->Nama->CurrentValue = HtmlDecode($this->Nama->CurrentValue);
			$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
			$curVal = strval($this->Nama->CurrentValue);
			if ($curVal != "") {
				$this->Nama->EditValue = $this->Nama->lookupCacheOption($curVal);
				if ($this->Nama->EditValue === NULL) { // Lookup from database
					$filterWrk = "`Nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Nama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Nama->EditValue = $this->Nama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
					}
				}
			} else {
				$this->Nama->EditValue = NULL;
			}
			$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

			// Perusahaan
			$this->Perusahaan->EditAttrs["class"] = "form-control";
			$this->Perusahaan->EditCustomAttributes = "";
			if (!$this->Perusahaan->Raw)
				$this->Perusahaan->CurrentValue = HtmlDecode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
			$curVal = strval($this->Perusahaan->CurrentValue);
			if ($curVal != "") {
				$this->Perusahaan->EditValue = $this->Perusahaan->lookupCacheOption($curVal);
				if ($this->Perusahaan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`Perusahaan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Perusahaan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Perusahaan->EditValue = $this->Perusahaan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
					}
				}
			} else {
				$this->Perusahaan->EditValue = NULL;
			}
			$this->Perusahaan->PlaceHolder = RemoveHtml($this->Perusahaan->caption());

			// Daerah
			$this->Daerah->EditAttrs["class"] = "form-control";
			$this->Daerah->EditCustomAttributes = "";
			if (!$this->Daerah->Raw)
				$this->Daerah->CurrentValue = HtmlDecode($this->Daerah->CurrentValue);
			$this->Daerah->EditValue = HtmlEncode($this->Daerah->CurrentValue);
			$this->Daerah->PlaceHolder = RemoveHtml($this->Daerah->caption());

			// Produk
			$this->Produk->EditAttrs["class"] = "form-control";
			$this->Produk->EditCustomAttributes = "";
			if (!$this->Produk->Raw)
				$this->Produk->CurrentValue = HtmlDecode($this->Produk->CurrentValue);
			$this->Produk->EditValue = HtmlEncode($this->Produk->CurrentValue);
			$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->EditAttrs["class"] = "form-control";
			$this->Tgl_Bln_Ekspor->EditCustomAttributes = "";
			if (!$this->Tgl_Bln_Ekspor->Raw)
				$this->Tgl_Bln_Ekspor->CurrentValue = HtmlDecode($this->Tgl_Bln_Ekspor->CurrentValue);
			$this->Tgl_Bln_Ekspor->EditValue = HtmlEncode($this->Tgl_Bln_Ekspor->CurrentValue);
			$this->Tgl_Bln_Ekspor->PlaceHolder = RemoveHtml($this->Tgl_Bln_Ekspor->caption());

			// Negara_Tujuan
			$this->Negara_Tujuan->EditAttrs["class"] = "form-control";
			$this->Negara_Tujuan->EditCustomAttributes = "";
			if (!$this->Negara_Tujuan->Raw)
				$this->Negara_Tujuan->CurrentValue = HtmlDecode($this->Negara_Tujuan->CurrentValue);
			$this->Negara_Tujuan->EditValue = HtmlEncode($this->Negara_Tujuan->CurrentValue);
			$this->Negara_Tujuan->PlaceHolder = RemoveHtml($this->Negara_Tujuan->caption());

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->EditAttrs["class"] = "form-control";
			$this->Nilai_Ekspor_USD->EditCustomAttributes = "";
			$this->Nilai_Ekspor_USD->EditValue = HtmlEncode($this->Nilai_Ekspor_USD->CurrentValue);
			$this->Nilai_Ekspor_USD->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_USD->caption());
			if (strval($this->Nilai_Ekspor_USD->EditValue) != "" && is_numeric($this->Nilai_Ekspor_USD->EditValue)) {
				$this->Nilai_Ekspor_USD->EditValue = FormatNumber($this->Nilai_Ekspor_USD->EditValue, -2, -2, -2, -2);
				$this->Nilai_Ekspor_USD->OldValue = $this->Nilai_Ekspor_USD->EditValue;
			}
			

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->EditAttrs["class"] = "form-control";
			$this->Nilai_Ekspor_Rupiah->EditCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->EditValue = HtmlEncode($this->Nilai_Ekspor_Rupiah->CurrentValue);
			$this->Nilai_Ekspor_Rupiah->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_Rupiah->caption());
			if (strval($this->Nilai_Ekspor_Rupiah->EditValue) != "" && is_numeric($this->Nilai_Ekspor_Rupiah->EditValue)) {
				$this->Nilai_Ekspor_Rupiah->EditValue = FormatNumber($this->Nilai_Ekspor_Rupiah->EditValue, -2, -2, -2, -2);
				$this->Nilai_Ekspor_Rupiah->OldValue = $this->Nilai_Ekspor_Rupiah->EditValue;
			}
			

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			if (!$this->Keterangan->Raw)
				$this->Keterangan->CurrentValue = HtmlDecode($this->Keterangan->CurrentValue);
			$this->Keterangan->EditValue = HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = RemoveHtml($this->Keterangan->caption());

			// Wilayah_ECP
			$this->Wilayah_ECP->EditAttrs["class"] = "form-control";
			$this->Wilayah_ECP->EditCustomAttributes = "";
			$curVal = trim(strval($this->Wilayah_ECP->CurrentValue));
			if ($curVal != "")
				$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->lookupCacheOption($curVal);
			else
				$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->Lookup !== NULL && is_array($this->Wilayah_ECP->Lookup->Options) ? $curVal : NULL;
			if ($this->Wilayah_ECP->ViewValue !== NULL) { // Load from cache
				$this->Wilayah_ECP->EditValue = array_values($this->Wilayah_ECP->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Wilayah_ECP`" . SearchString("=", $this->Wilayah_ECP->CurrentValue, DATATYPE_STRING, "");
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
			$this->Tahun_ECP->EditValue = HtmlEncode($this->Tahun_ECP->CurrentValue);
			$this->Tahun_ECP->PlaceHolder = RemoveHtml($this->Tahun_ECP->caption());

			// Add refer script
			// ID_ECP

			$this->ID_ECP->LinkCustomAttributes = "";
			$this->ID_ECP->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";

			// Daerah
			$this->Daerah->LinkCustomAttributes = "";
			$this->Daerah->HrefValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->LinkCustomAttributes = "";
			$this->Tgl_Bln_Ekspor->HrefValue = "";

			// Negara_Tujuan
			$this->Negara_Tujuan->LinkCustomAttributes = "";
			$this->Negara_Tujuan->HrefValue = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_USD->HrefValue = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID_ECP
			$this->ID_ECP->EditAttrs["class"] = "form-control";
			$this->ID_ECP->EditCustomAttributes = "";
			$this->ID_ECP->EditValue = $this->ID_ECP->CurrentValue;
			$this->ID_ECP->ViewCustomAttributes = "";

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			if (!$this->Nama->Raw)
				$this->Nama->CurrentValue = HtmlDecode($this->Nama->CurrentValue);
			$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
			$curVal = strval($this->Nama->CurrentValue);
			if ($curVal != "") {
				$this->Nama->EditValue = $this->Nama->lookupCacheOption($curVal);
				if ($this->Nama->EditValue === NULL) { // Lookup from database
					$filterWrk = "`Nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Nama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Nama->EditValue = $this->Nama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
					}
				}
			} else {
				$this->Nama->EditValue = NULL;
			}
			$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

			// Perusahaan
			$this->Perusahaan->EditAttrs["class"] = "form-control";
			$this->Perusahaan->EditCustomAttributes = "";
			if (!$this->Perusahaan->Raw)
				$this->Perusahaan->CurrentValue = HtmlDecode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
			$curVal = strval($this->Perusahaan->CurrentValue);
			if ($curVal != "") {
				$this->Perusahaan->EditValue = $this->Perusahaan->lookupCacheOption($curVal);
				if ($this->Perusahaan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`Perusahaan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Perusahaan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Perusahaan->EditValue = $this->Perusahaan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
					}
				}
			} else {
				$this->Perusahaan->EditValue = NULL;
			}
			$this->Perusahaan->PlaceHolder = RemoveHtml($this->Perusahaan->caption());

			// Daerah
			$this->Daerah->EditAttrs["class"] = "form-control";
			$this->Daerah->EditCustomAttributes = "";
			if (!$this->Daerah->Raw)
				$this->Daerah->CurrentValue = HtmlDecode($this->Daerah->CurrentValue);
			$this->Daerah->EditValue = HtmlEncode($this->Daerah->CurrentValue);
			$this->Daerah->PlaceHolder = RemoveHtml($this->Daerah->caption());

			// Produk
			$this->Produk->EditAttrs["class"] = "form-control";
			$this->Produk->EditCustomAttributes = "";
			if (!$this->Produk->Raw)
				$this->Produk->CurrentValue = HtmlDecode($this->Produk->CurrentValue);
			$this->Produk->EditValue = HtmlEncode($this->Produk->CurrentValue);
			$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->EditAttrs["class"] = "form-control";
			$this->Tgl_Bln_Ekspor->EditCustomAttributes = "";
			if (!$this->Tgl_Bln_Ekspor->Raw)
				$this->Tgl_Bln_Ekspor->CurrentValue = HtmlDecode($this->Tgl_Bln_Ekspor->CurrentValue);
			$this->Tgl_Bln_Ekspor->EditValue = HtmlEncode($this->Tgl_Bln_Ekspor->CurrentValue);
			$this->Tgl_Bln_Ekspor->PlaceHolder = RemoveHtml($this->Tgl_Bln_Ekspor->caption());

			// Negara_Tujuan
			$this->Negara_Tujuan->EditAttrs["class"] = "form-control";
			$this->Negara_Tujuan->EditCustomAttributes = "";
			if (!$this->Negara_Tujuan->Raw)
				$this->Negara_Tujuan->CurrentValue = HtmlDecode($this->Negara_Tujuan->CurrentValue);
			$this->Negara_Tujuan->EditValue = HtmlEncode($this->Negara_Tujuan->CurrentValue);
			$this->Negara_Tujuan->PlaceHolder = RemoveHtml($this->Negara_Tujuan->caption());

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->EditAttrs["class"] = "form-control";
			$this->Nilai_Ekspor_USD->EditCustomAttributes = "";
			$this->Nilai_Ekspor_USD->EditValue = HtmlEncode($this->Nilai_Ekspor_USD->CurrentValue);
			$this->Nilai_Ekspor_USD->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_USD->caption());
			if (strval($this->Nilai_Ekspor_USD->EditValue) != "" && is_numeric($this->Nilai_Ekspor_USD->EditValue)) {
				$this->Nilai_Ekspor_USD->EditValue = FormatNumber($this->Nilai_Ekspor_USD->EditValue, -2, -2, -2, -2);
				$this->Nilai_Ekspor_USD->OldValue = $this->Nilai_Ekspor_USD->EditValue;
			}
			

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->EditAttrs["class"] = "form-control";
			$this->Nilai_Ekspor_Rupiah->EditCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->EditValue = HtmlEncode($this->Nilai_Ekspor_Rupiah->CurrentValue);
			$this->Nilai_Ekspor_Rupiah->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_Rupiah->caption());
			if (strval($this->Nilai_Ekspor_Rupiah->EditValue) != "" && is_numeric($this->Nilai_Ekspor_Rupiah->EditValue)) {
				$this->Nilai_Ekspor_Rupiah->EditValue = FormatNumber($this->Nilai_Ekspor_Rupiah->EditValue, -2, -2, -2, -2);
				$this->Nilai_Ekspor_Rupiah->OldValue = $this->Nilai_Ekspor_Rupiah->EditValue;
			}
			

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			if (!$this->Keterangan->Raw)
				$this->Keterangan->CurrentValue = HtmlDecode($this->Keterangan->CurrentValue);
			$this->Keterangan->EditValue = HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = RemoveHtml($this->Keterangan->caption());

			// Wilayah_ECP
			$this->Wilayah_ECP->EditAttrs["class"] = "form-control";
			$this->Wilayah_ECP->EditCustomAttributes = "";
			$curVal = trim(strval($this->Wilayah_ECP->CurrentValue));
			if ($curVal != "")
				$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->lookupCacheOption($curVal);
			else
				$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->Lookup !== NULL && is_array($this->Wilayah_ECP->Lookup->Options) ? $curVal : NULL;
			if ($this->Wilayah_ECP->ViewValue !== NULL) { // Load from cache
				$this->Wilayah_ECP->EditValue = array_values($this->Wilayah_ECP->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Wilayah_ECP`" . SearchString("=", $this->Wilayah_ECP->CurrentValue, DATATYPE_STRING, "");
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
			$this->Tahun_ECP->EditValue = HtmlEncode($this->Tahun_ECP->CurrentValue);
			$this->Tahun_ECP->PlaceHolder = RemoveHtml($this->Tahun_ECP->caption());

			// Edit refer script
			// ID_ECP

			$this->ID_ECP->LinkCustomAttributes = "";
			$this->ID_ECP->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";

			// Daerah
			$this->Daerah->LinkCustomAttributes = "";
			$this->Daerah->HrefValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->LinkCustomAttributes = "";
			$this->Tgl_Bln_Ekspor->HrefValue = "";

			// Negara_Tujuan
			$this->Negara_Tujuan->LinkCustomAttributes = "";
			$this->Negara_Tujuan->HrefValue = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_USD->HrefValue = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ID_ECP
			$this->ID_ECP->EditAttrs["class"] = "form-control";
			$this->ID_ECP->EditCustomAttributes = "";
			$this->ID_ECP->EditValue = HtmlEncode($this->ID_ECP->AdvancedSearch->SearchValue);
			$this->ID_ECP->PlaceHolder = RemoveHtml($this->ID_ECP->caption());

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

			// Daerah
			$this->Daerah->EditAttrs["class"] = "form-control";
			$this->Daerah->EditCustomAttributes = "";
			if (!$this->Daerah->Raw)
				$this->Daerah->AdvancedSearch->SearchValue = HtmlDecode($this->Daerah->AdvancedSearch->SearchValue);
			$this->Daerah->EditValue = HtmlEncode($this->Daerah->AdvancedSearch->SearchValue);
			$this->Daerah->PlaceHolder = RemoveHtml($this->Daerah->caption());

			// Produk
			$this->Produk->EditAttrs["class"] = "form-control";
			$this->Produk->EditCustomAttributes = "";
			if (!$this->Produk->Raw)
				$this->Produk->AdvancedSearch->SearchValue = HtmlDecode($this->Produk->AdvancedSearch->SearchValue);
			$this->Produk->EditValue = HtmlEncode($this->Produk->AdvancedSearch->SearchValue);
			$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->EditAttrs["class"] = "form-control";
			$this->Tgl_Bln_Ekspor->EditCustomAttributes = "";
			if (!$this->Tgl_Bln_Ekspor->Raw)
				$this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue = HtmlDecode($this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue);
			$this->Tgl_Bln_Ekspor->EditValue = HtmlEncode($this->Tgl_Bln_Ekspor->AdvancedSearch->SearchValue);
			$this->Tgl_Bln_Ekspor->PlaceHolder = RemoveHtml($this->Tgl_Bln_Ekspor->caption());

			// Negara_Tujuan
			$this->Negara_Tujuan->EditAttrs["class"] = "form-control";
			$this->Negara_Tujuan->EditCustomAttributes = "";
			if (!$this->Negara_Tujuan->Raw)
				$this->Negara_Tujuan->AdvancedSearch->SearchValue = HtmlDecode($this->Negara_Tujuan->AdvancedSearch->SearchValue);
			$this->Negara_Tujuan->EditValue = HtmlEncode($this->Negara_Tujuan->AdvancedSearch->SearchValue);
			$this->Negara_Tujuan->PlaceHolder = RemoveHtml($this->Negara_Tujuan->caption());

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

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			if (!$this->Keterangan->Raw)
				$this->Keterangan->AdvancedSearch->SearchValue = HtmlDecode($this->Keterangan->AdvancedSearch->SearchValue);
			$this->Keterangan->EditValue = HtmlEncode($this->Keterangan->AdvancedSearch->SearchValue);
			$this->Keterangan->PlaceHolder = RemoveHtml($this->Keterangan->caption());

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
					$filterWrk = "`Wilayah_ECP`" . SearchString("=", $this->Wilayah_ECP->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
			$this->Tahun_ECP->PlaceHolder = RemoveHtml($this->Tahun_ECP->caption());
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

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->ID_ECP->Required) {
			if (!$this->ID_ECP->IsDetailKey && $this->ID_ECP->FormValue != NULL && $this->ID_ECP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_ECP->caption(), $this->ID_ECP->RequiredErrorMessage));
			}
		}
		if ($this->Nama->Required) {
			if (!$this->Nama->IsDetailKey && $this->Nama->FormValue != NULL && $this->Nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nama->caption(), $this->Nama->RequiredErrorMessage));
			}
		}
		if ($this->Perusahaan->Required) {
			if (!$this->Perusahaan->IsDetailKey && $this->Perusahaan->FormValue != NULL && $this->Perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Perusahaan->caption(), $this->Perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->Daerah->Required) {
			if (!$this->Daerah->IsDetailKey && $this->Daerah->FormValue != NULL && $this->Daerah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Daerah->caption(), $this->Daerah->RequiredErrorMessage));
			}
		}
		if ($this->Produk->Required) {
			if (!$this->Produk->IsDetailKey && $this->Produk->FormValue != NULL && $this->Produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Produk->caption(), $this->Produk->RequiredErrorMessage));
			}
		}
		if ($this->Tgl_Bln_Ekspor->Required) {
			if (!$this->Tgl_Bln_Ekspor->IsDetailKey && $this->Tgl_Bln_Ekspor->FormValue != NULL && $this->Tgl_Bln_Ekspor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tgl_Bln_Ekspor->caption(), $this->Tgl_Bln_Ekspor->RequiredErrorMessage));
			}
		}
		if ($this->Negara_Tujuan->Required) {
			if (!$this->Negara_Tujuan->IsDetailKey && $this->Negara_Tujuan->FormValue != NULL && $this->Negara_Tujuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Negara_Tujuan->caption(), $this->Negara_Tujuan->RequiredErrorMessage));
			}
		}
		if ($this->Nilai_Ekspor_USD->Required) {
			if (!$this->Nilai_Ekspor_USD->IsDetailKey && $this->Nilai_Ekspor_USD->FormValue != NULL && $this->Nilai_Ekspor_USD->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nilai_Ekspor_USD->caption(), $this->Nilai_Ekspor_USD->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Nilai_Ekspor_USD->FormValue)) {
			AddMessage($FormError, $this->Nilai_Ekspor_USD->errorMessage());
		}
		if ($this->Nilai_Ekspor_Rupiah->Required) {
			if (!$this->Nilai_Ekspor_Rupiah->IsDetailKey && $this->Nilai_Ekspor_Rupiah->FormValue != NULL && $this->Nilai_Ekspor_Rupiah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nilai_Ekspor_Rupiah->caption(), $this->Nilai_Ekspor_Rupiah->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Nilai_Ekspor_Rupiah->FormValue)) {
			AddMessage($FormError, $this->Nilai_Ekspor_Rupiah->errorMessage());
		}
		if ($this->Keterangan->Required) {
			if (!$this->Keterangan->IsDetailKey && $this->Keterangan->FormValue != NULL && $this->Keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Keterangan->caption(), $this->Keterangan->RequiredErrorMessage));
			}
		}
		if ($this->Wilayah_ECP->Required) {
			if (!$this->Wilayah_ECP->IsDetailKey && $this->Wilayah_ECP->FormValue != NULL && $this->Wilayah_ECP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Wilayah_ECP->caption(), $this->Wilayah_ECP->RequiredErrorMessage));
			}
		}
		if ($this->Tahun_ECP->Required) {
			if (!$this->Tahun_ECP->IsDetailKey && $this->Tahun_ECP->FormValue != NULL && $this->Tahun_ECP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tahun_ECP->caption(), $this->Tahun_ECP->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Tahun_ECP->FormValue)) {
			AddMessage($FormError, $this->Tahun_ECP->errorMessage());
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
				$thisKey .= $row['ID_ECP'];
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

			// Nama
			$this->Nama->setDbValueDef($rsnew, $this->Nama->CurrentValue, "", $this->Nama->ReadOnly);

			// Perusahaan
			$this->Perusahaan->setDbValueDef($rsnew, $this->Perusahaan->CurrentValue, "", $this->Perusahaan->ReadOnly);

			// Daerah
			$this->Daerah->setDbValueDef($rsnew, $this->Daerah->CurrentValue, "", $this->Daerah->ReadOnly);

			// Produk
			$this->Produk->setDbValueDef($rsnew, $this->Produk->CurrentValue, "", $this->Produk->ReadOnly);

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->setDbValueDef($rsnew, $this->Tgl_Bln_Ekspor->CurrentValue, "", $this->Tgl_Bln_Ekspor->ReadOnly);

			// Negara_Tujuan
			$this->Negara_Tujuan->setDbValueDef($rsnew, $this->Negara_Tujuan->CurrentValue, "", $this->Negara_Tujuan->ReadOnly);

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->setDbValueDef($rsnew, $this->Nilai_Ekspor_USD->CurrentValue, 0, $this->Nilai_Ekspor_USD->ReadOnly);

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->setDbValueDef($rsnew, $this->Nilai_Ekspor_Rupiah->CurrentValue, 0, $this->Nilai_Ekspor_Rupiah->ReadOnly);

			// Keterangan
			$this->Keterangan->setDbValueDef($rsnew, $this->Keterangan->CurrentValue, "", $this->Keterangan->ReadOnly);

			// Wilayah_ECP
			$this->Wilayah_ECP->setDbValueDef($rsnew, $this->Wilayah_ECP->CurrentValue, "", $this->Wilayah_ECP->ReadOnly);

			// Tahun_ECP
			$this->Tahun_ECP->setDbValueDef($rsnew, $this->Tahun_ECP->CurrentValue, 0, $this->Tahun_ECP->ReadOnly);

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

	/**
	 * Import file
	 *
	 * @param string $filetoken File token to locate the uploaded import file
	 * @return boolean
	 */
	public function import($filetoken)
	{
		global $Security, $Language;

		// Check if valid token
		if (EmptyValue($filetoken))
			return FALSE;

		// Get uploaded files by token
		$upload = new HttpUpload();
		$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $upload->getUploadedFileName($filetoken, TRUE));
		$exts = explode(",", Config("IMPORT_FILE_ALLOWED_EXT"));
		$totCnt = 0;
		$totSuccessCnt = 0;
		$totFailCnt = 0;
		$result = [Config("API_FILE_TOKEN_NAME") => $filetoken, "files" => [], "success" => FALSE];

		// Import records
		foreach ($files as $file) {
			$res = [Config("API_FILE_TOKEN_NAME") => $filetoken, "file" => basename($file)];
			$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

			// Ignore log file
			if ($ext == "txt")
				continue;
			if (!in_array($ext, $exts)) {
				$res = array_merge($res, ["error" => str_replace("%e", $ext, $Language->phrase("ImportMessageInvalidFileExtension"))]);
				WriteJson($res);
				return FALSE;
			}

			// Set up options for Page Importing event
			// Get optional data from $_POST first

			$ar = array_keys($_POST);
			$options = [];
			foreach ($ar as $key) {
				if (!in_array($key, ["action", Config("TOKEN_NAME"), "filetoken"]))
					$options[$key] = $_POST[$key];
			}

			// Merge default options
			$options = array_merge(["maxExecutionTime" => $this->ImportMaxExecutionTime, "file" => $file, "activeSheet" => 0, "headerRowNumber" => 0, "headers" => [], "offset" => 0, "limit" => 0], $options);
			if ($ext == "csv")
				$options = array_merge(["inputEncoding" => $this->ImportCsvEncoding, "delimiter" => $this->ImportCsvDelimiter, "enclosure" => $this->ImportCsvQuoteCharacter], $options);
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($ext));

			// Call Page Importing server event
			if (!$this->Page_Importing($reader, $options)) {
				WriteJson($res);
				return FALSE;
			}

			// Set max execution time
			if ($options["maxExecutionTime"] > 0)
				ini_set("max_execution_time", $options["maxExecutionTime"]);
			try {
				if ($ext == "csv") {
					if ($options["inputEncoding"] != '')
						$reader->setInputEncoding($options["inputEncoding"]);
					if ($options["delimiter"] != '')
						$reader->setDelimiter($options["delimiter"]);
					if ($options["enclosure"] != '')
						$reader->setEnclosure($options["enclosure"]);
				}
				$spreadsheet = @$reader->load($file);
			} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
				$res = array_merge($res, ["error" => $e->getMessage()]);
				WriteJson($res);
				return FALSE;
			}

			// Get active worksheet
			$spreadsheet->setActiveSheetIndex($options["activeSheet"]);
			$worksheet = $spreadsheet->getActiveSheet();

			// Get row and column indexes
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

			// Get column headers
			$headers = $options["headers"];
			$headerRow = 0;
			if (count($headers) == 0) { // Undetermined, load from header row
				$headerRow = $options["headerRowNumber"] + 1;
				$headers = $this->getImportHeaders($worksheet, $headerRow, $highestColumn);
			}
			if (count($headers) == 0) { // Unable to load header
				$res["error"] = $Language->phrase("ImportMessageNoHeaderRow");
				WriteJson($res);
				return FALSE;
			}
			foreach ($headers as $name) {
				if (!array_key_exists($name, $this->fields)) { // Unidentified field, not header row
					$res["error"] = str_replace('%f', $name, $Language->phrase("ImportMessageInvalidFieldName"));
					WriteJson($res);
					return FALSE;
				}
			}
			$startRow = $headerRow + 1;
			$endRow = $highestRow;
			if ($options["offset"] > 0)
				$startRow += $options["offset"];
			if ($options["limit"] > 0) {
				$endRow = $startRow + $options["limit"] - 1;
				if ($endRow > $highestRow)
					$endRow = $highestRow;
			}
			if ($endRow >= $startRow)
				$records = $this->getImportRecords($worksheet, $startRow, $endRow, $highestColumn);
			else
				$records = [];
			$recordCnt = count($records);
			$cnt = 0;
			$successCnt = 0;
			$failCnt = 0;
			$failList = [];
			$relLogFile = IncludeTrailingDelimiter(UploadPath(FALSE) . Config("UPLOAD_TEMP_FOLDER_PREFIX") . $filetoken, FALSE) . $filetoken . ".txt";
			$res = array_merge($res, ["totalCount" => $recordCnt, "count" => $cnt, "successCount" => $successCnt, "failCount" => 0]);

			// Begin transaction
			if ($this->ImportUseTransaction) {
				$conn = $this->getConnection();
				$conn->beginTrans();
			}

			// Process records
			foreach ($records as $values) {
				$importSuccess = FALSE;
				try {
					$row = array_combine($headers, $values);
					$cnt++;
					$res["count"] = $cnt;
					if ($this->importRow($row, $cnt)) {
						$successCnt++;
						$importSuccess = TRUE;
					} else {
						$failCnt++;
						$failList["row" . $cnt] = $this->getFailureMessage();
						$this->clearFailureMessage(); // Clear error message
					}
				} catch (Exception $e) {
					$failCnt++;
					if ($failList["row" . $cnt] == "")
						$failList["row" . $cnt] = $e->getMessage();
				}

				// Reset count if import fail + use transaction
				if (!$importSuccess && $this->ImportUseTransaction) {
					$successCnt = 0;
					$failCnt = $cnt;
				}

				// Save progress to cache
				$res["successCount"] = $successCnt;
				$res["failCount"] = $failCnt;
				SetCache($filetoken, $res);

				// No need to process further if import fail + use transaction
				if (!$importSuccess && $this->ImportUseTransaction)
					break;
			}
			$res["failList"] = $failList;

			// Commit/Rollback transaction
			if ($this->ImportUseTransaction) {
				$conn = $this->getConnection();
				if ($failCnt > 0) // Rollback
					$conn->rollbackTrans();
				else // Commit
					$conn->commitTrans();
			}
			$totCnt += $cnt;
			$totSuccessCnt += $successCnt;
			$totFailCnt += $failCnt;

			// Call Page Imported server event
			$this->Page_Imported($reader, $res);
			if ($totCnt > 0 && $totFailCnt == 0) { // Clean up if all records imported
				$res["success"] = TRUE;
				$result["success"] = TRUE;
			} else {
				$res["log"] = $relLogFile;
				$result["success"] = FALSE;
			}
			$result["files"][] = $res;
		}
		if ($result["success"])
			CleanUploadTempPaths($filetoken);
		WriteJson($result);
		return $result["success"];
	}

	/**
	 * Get import header
	 *
	 * @param object $ws PhpSpreadsheet worksheet
	 * @param integer $rowIdx Row index for header row (1-based)
	 * @param string $endColName End column Name (e.g. "F")
	 * @return array
	 */
	protected function getImportHeaders($ws, $rowIdx, $endColName) {
		$ar = $ws->rangeToArray("A" . $rowIdx . ":" . $endColName . $rowIdx);
		return $ar[0];
	}

	/**
	 * Get import records
	 *
	 * @param object $ws PhpSpreadsheet worksheet
	 * @param integer $startRowIdx Start row index
	 * @param integer $endRowIdx End row index
	 * @param string $endColName End column Name (e.g. "F")
	 * @return array
	 */
	protected function getImportRecords($ws, $startRowIdx, $endRowIdx, $endColName) {
		$ar = $ws->rangeToArray("A" . $startRowIdx . ":" . $endColName . $endRowIdx);
		return $ar;
	}

	/**
	 * Import a row
	 *
	 * @param array $row
	 * @param integer $cnt
	 * @return boolean
	 */
	protected function importRow($row, $cnt)
	{
		global $Language;

		// Call Row Import server event
		if (!$this->Row_Import($row, $cnt))
			return FALSE;

		// Check field values
		foreach ($row as $name => $value) {
			$fld = $this->fields[$name];
			if (!$this->checkValue($fld, $value)) {
				$this->setFailureMessage(str_replace(["%f", "%v"], [$fld->Name, $value], $Language->phrase("ImportMessageInvalidFieldValue")));
				return FALSE;
			}
		}

		// Insert/Update to database
		if (!$this->ImportInsertOnly && $oldrow = $this->load($row)) {
			$res = $this->update($row, "", $oldrow);
		} else {
			$res = $this->insert($row);
		}
		return $res;
	}

	/**
	 * Check field value
	 *
	 * @param object $fld Field object
	 * @param object $value
	 * @return boolean
	 */
	protected function checkValue($fld, $value)
	{
		if ($fld->DataType == DATATYPE_NUMBER && !is_numeric($value))
			return FALSE;
		elseif ($fld->DataType == DATATYPE_DATE && !CheckDate($value))
			return FALSE;
		return TRUE;
	}

	// Load row
	protected function load($row)
	{
		$filter = $this->getRecordFilter($row);
		if (!$filter)
			return NULL;
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF)
			return $rs->fields;
		else
			return NULL;
	}

	// Load row hash
	protected function loadRowHash()
	{
		$filter = $this->getRecordFilter();

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$rsRow = $conn->Execute($sql);
		$this->HashValue = ($rsRow && !$rsRow->EOF) ? $this->getRowHash($rsRow) : ""; // Get hash value for record
		$rsRow->close();
	}

	// Get Row Hash
	public function getRowHash(&$rs)
	{
		if (!$rs)
			return "";
		$hash = "";
		$hash .= GetFieldHash($rs->fields('Nama')); // Nama
		$hash .= GetFieldHash($rs->fields('Perusahaan')); // Perusahaan
		$hash .= GetFieldHash($rs->fields('Daerah')); // Daerah
		$hash .= GetFieldHash($rs->fields('Produk')); // Produk
		$hash .= GetFieldHash($rs->fields('Tgl_Bln_Ekspor')); // Tgl_Bln_Ekspor
		$hash .= GetFieldHash($rs->fields('Negara_Tujuan')); // Negara_Tujuan
		$hash .= GetFieldHash($rs->fields('Nilai_Ekspor_USD')); // Nilai_Ekspor_USD
		$hash .= GetFieldHash($rs->fields('Nilai_Ekspor_Rupiah')); // Nilai_Ekspor_Rupiah
		$hash .= GetFieldHash($rs->fields('Keterangan')); // Keterangan
		$hash .= GetFieldHash($rs->fields('Wilayah_ECP')); // Wilayah_ECP
		$hash .= GetFieldHash($rs->fields('Tahun_ECP')); // Tahun_ECP
		return md5($hash);
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// Nama
		$this->Nama->setDbValueDef($rsnew, $this->Nama->CurrentValue, "", FALSE);

		// Perusahaan
		$this->Perusahaan->setDbValueDef($rsnew, $this->Perusahaan->CurrentValue, "", FALSE);

		// Daerah
		$this->Daerah->setDbValueDef($rsnew, $this->Daerah->CurrentValue, "", FALSE);

		// Produk
		$this->Produk->setDbValueDef($rsnew, $this->Produk->CurrentValue, "", FALSE);

		// Tgl_Bln_Ekspor
		$this->Tgl_Bln_Ekspor->setDbValueDef($rsnew, $this->Tgl_Bln_Ekspor->CurrentValue, "", FALSE);

		// Negara_Tujuan
		$this->Negara_Tujuan->setDbValueDef($rsnew, $this->Negara_Tujuan->CurrentValue, "", FALSE);

		// Nilai_Ekspor_USD
		$this->Nilai_Ekspor_USD->setDbValueDef($rsnew, $this->Nilai_Ekspor_USD->CurrentValue, 0, FALSE);

		// Nilai_Ekspor_Rupiah
		$this->Nilai_Ekspor_Rupiah->setDbValueDef($rsnew, $this->Nilai_Ekspor_Rupiah->CurrentValue, 0, FALSE);

		// Keterangan
		$this->Keterangan->setDbValueDef($rsnew, $this->Keterangan->CurrentValue, "", FALSE);

		// Wilayah_ECP
		$this->Wilayah_ECP->setDbValueDef($rsnew, $this->Wilayah_ECP->CurrentValue, "", FALSE);

		// Tahun_ECP
		$this->Tahun_ECP->setDbValueDef($rsnew, $this->Tahun_ECP->CurrentValue, 0, FALSE);

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

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->ID_ECP->AdvancedSearch->load();
		$this->Nama->AdvancedSearch->load();
		$this->Perusahaan->AdvancedSearch->load();
		$this->Daerah->AdvancedSearch->load();
		$this->Produk->AdvancedSearch->load();
		$this->Tgl_Bln_Ekspor->AdvancedSearch->load();
		$this->Negara_Tujuan->AdvancedSearch->load();
		$this->Nilai_Ekspor_USD->AdvancedSearch->load();
		$this->Nilai_Ekspor_Rupiah->AdvancedSearch->load();
		$this->Keterangan->AdvancedSearch->load();
		$this->Wilayah_ECP->AdvancedSearch->load();
		$this->Tahun_ECP->AdvancedSearch->load();
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fdm_ecplistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
	}

	// Set up import options
	protected function setupImportOptions()
	{
		global $Security, $Language;

		// Import
		$item = &$this->ImportOptions->add("import");
		$item->Body = "<a class=\"ew-import-link ew-import\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("ImportText") . "\" data-caption=\"" . $Language->phrase("ImportText") . "\" onclick=\"return ew.importDialogShow({lnk:this,hdr:ew.language.phrase('ImportText')});\">" . $Language->phrase("Import") . "</a>";
		$item->Visible = $Security->canImport();
		$this->ImportOptions->UseButtonGroup = TRUE;
		$this->ImportOptions->UseDropDownButton = FALSE;
		$this->ImportOptions->DropDownButtonPhrase = $Language->phrase("ButtonImport");

		// Add group option item
		$item = &$this->ImportOptions->add($this->ImportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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
				case "x_Nama":
					break;
				case "x_Perusahaan":
					break;
				case "x_Wilayah_ECP":
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
						case "x_Nama":
							break;
						case "x_Perusahaan":
							break;
						case "x_Wilayah_ECP":
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