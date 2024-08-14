<?php
namespace PHPMaker2020\input_ecp;

/**
 * Page class
 */
class dm_pesertaecp_list extends dm_pesertaecp
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{9B9A621D-5170-4F08-8852-72A13BB88C54}";

	// Table name
	public $TableName = 'dm_pesertaecp';

	// Page object name
	public $PageObjName = "dm_pesertaecp_list";

	// Grid form hidden field names
	public $FormName = "fdm_pesertaecplist";
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

		// Table object (dm_pesertaecp)
		if (!isset($GLOBALS["dm_pesertaecp"]) || get_class($GLOBALS["dm_pesertaecp"]) == PROJECT_NAMESPACE . "dm_pesertaecp") {
			$GLOBALS["dm_pesertaecp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["dm_pesertaecp"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "dm_pesertaecpadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "dm_pesertaecpdelete.php";
		$this->MultiUpdateUrl = "dm_pesertaecpupdate.php";

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'dm_pesertaecp');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fdm_pesertaecplistsrch";

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
		global $dm_pesertaecp;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($dm_pesertaecp);
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
			$key .= @$ar['ID_Unik'];
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
			$this->ID_Unik->Visible = FALSE;
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
		$this->ID_Unik->setVisibility();
		$this->Nama->setVisibility();
		$this->Perusahaan->setVisibility();
		$this->Alamat->Visible = FALSE;
		$this->Produk->setVisibility();
		$this->Kapasitas_Produksi->setVisibility();
		$this->Omset->setVisibility();
		$this->Jumlah_Pegawai->setVisibility();
		$this->Legalitas_Perusahaan->setVisibility();
		$this->Sertifikasi_dimiliki->setVisibility();
		$this->Handphone->setVisibility();
		$this->Email_Add->setVisibility();
		$this->Website->setVisibility();
		$this->Tahun_Berdiri->setVisibility();
		$this->Alamat_Produksi->Visible = FALSE;
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
			$this->ID_Unik->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ID_Unik->OldValue))
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
					$key .= $this->ID_Unik->CurrentValue;

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
		if ($CurrentForm->hasValue("x_Produk") && $CurrentForm->hasValue("o_Produk") && $this->Produk->CurrentValue != $this->Produk->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Kapasitas_Produksi") && $CurrentForm->hasValue("o_Kapasitas_Produksi") && $this->Kapasitas_Produksi->CurrentValue != $this->Kapasitas_Produksi->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Omset") && $CurrentForm->hasValue("o_Omset") && $this->Omset->CurrentValue != $this->Omset->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Jumlah_Pegawai") && $CurrentForm->hasValue("o_Jumlah_Pegawai") && $this->Jumlah_Pegawai->CurrentValue != $this->Jumlah_Pegawai->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Legalitas_Perusahaan") && $CurrentForm->hasValue("o_Legalitas_Perusahaan") && $this->Legalitas_Perusahaan->CurrentValue != $this->Legalitas_Perusahaan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Sertifikasi_dimiliki") && $CurrentForm->hasValue("o_Sertifikasi_dimiliki") && $this->Sertifikasi_dimiliki->CurrentValue != $this->Sertifikasi_dimiliki->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Handphone") && $CurrentForm->hasValue("o_Handphone") && $this->Handphone->CurrentValue != $this->Handphone->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Email_Add") && $CurrentForm->hasValue("o_Email_Add") && $this->Email_Add->CurrentValue != $this->Email_Add->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Website") && $CurrentForm->hasValue("o_Website") && $this->Website->CurrentValue != $this->Website->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Tahun_Berdiri") && $CurrentForm->hasValue("o_Tahun_Berdiri") && $this->Tahun_Berdiri->CurrentValue != $this->Tahun_Berdiri->OldValue)
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
		$filterList = Concat($filterList, $this->ID_Unik->AdvancedSearch->toJson(), ","); // Field ID_Unik
		$filterList = Concat($filterList, $this->Nama->AdvancedSearch->toJson(), ","); // Field Nama
		$filterList = Concat($filterList, $this->Perusahaan->AdvancedSearch->toJson(), ","); // Field Perusahaan
		$filterList = Concat($filterList, $this->Alamat->AdvancedSearch->toJson(), ","); // Field Alamat
		$filterList = Concat($filterList, $this->Produk->AdvancedSearch->toJson(), ","); // Field Produk
		$filterList = Concat($filterList, $this->Kapasitas_Produksi->AdvancedSearch->toJson(), ","); // Field Kapasitas_Produksi
		$filterList = Concat($filterList, $this->Omset->AdvancedSearch->toJson(), ","); // Field Omset
		$filterList = Concat($filterList, $this->Jumlah_Pegawai->AdvancedSearch->toJson(), ","); // Field Jumlah_Pegawai
		$filterList = Concat($filterList, $this->Legalitas_Perusahaan->AdvancedSearch->toJson(), ","); // Field Legalitas_Perusahaan
		$filterList = Concat($filterList, $this->Sertifikasi_dimiliki->AdvancedSearch->toJson(), ","); // Field Sertifikasi_dimiliki
		$filterList = Concat($filterList, $this->Handphone->AdvancedSearch->toJson(), ","); // Field Handphone
		$filterList = Concat($filterList, $this->Email_Add->AdvancedSearch->toJson(), ","); // Field Email_Add
		$filterList = Concat($filterList, $this->Website->AdvancedSearch->toJson(), ","); // Field Website
		$filterList = Concat($filterList, $this->Tahun_Berdiri->AdvancedSearch->toJson(), ","); // Field Tahun_Berdiri
		$filterList = Concat($filterList, $this->Alamat_Produksi->AdvancedSearch->toJson(), ","); // Field Alamat_Produksi
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fdm_pesertaecplistsrch", $filters);
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

		// Field ID_Unik
		$this->ID_Unik->AdvancedSearch->SearchValue = @$filter["x_ID_Unik"];
		$this->ID_Unik->AdvancedSearch->SearchOperator = @$filter["z_ID_Unik"];
		$this->ID_Unik->AdvancedSearch->SearchCondition = @$filter["v_ID_Unik"];
		$this->ID_Unik->AdvancedSearch->SearchValue2 = @$filter["y_ID_Unik"];
		$this->ID_Unik->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Unik"];
		$this->ID_Unik->AdvancedSearch->save();

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

		// Field Alamat
		$this->Alamat->AdvancedSearch->SearchValue = @$filter["x_Alamat"];
		$this->Alamat->AdvancedSearch->SearchOperator = @$filter["z_Alamat"];
		$this->Alamat->AdvancedSearch->SearchCondition = @$filter["v_Alamat"];
		$this->Alamat->AdvancedSearch->SearchValue2 = @$filter["y_Alamat"];
		$this->Alamat->AdvancedSearch->SearchOperator2 = @$filter["w_Alamat"];
		$this->Alamat->AdvancedSearch->save();

		// Field Produk
		$this->Produk->AdvancedSearch->SearchValue = @$filter["x_Produk"];
		$this->Produk->AdvancedSearch->SearchOperator = @$filter["z_Produk"];
		$this->Produk->AdvancedSearch->SearchCondition = @$filter["v_Produk"];
		$this->Produk->AdvancedSearch->SearchValue2 = @$filter["y_Produk"];
		$this->Produk->AdvancedSearch->SearchOperator2 = @$filter["w_Produk"];
		$this->Produk->AdvancedSearch->save();

		// Field Kapasitas_Produksi
		$this->Kapasitas_Produksi->AdvancedSearch->SearchValue = @$filter["x_Kapasitas_Produksi"];
		$this->Kapasitas_Produksi->AdvancedSearch->SearchOperator = @$filter["z_Kapasitas_Produksi"];
		$this->Kapasitas_Produksi->AdvancedSearch->SearchCondition = @$filter["v_Kapasitas_Produksi"];
		$this->Kapasitas_Produksi->AdvancedSearch->SearchValue2 = @$filter["y_Kapasitas_Produksi"];
		$this->Kapasitas_Produksi->AdvancedSearch->SearchOperator2 = @$filter["w_Kapasitas_Produksi"];
		$this->Kapasitas_Produksi->AdvancedSearch->save();

		// Field Omset
		$this->Omset->AdvancedSearch->SearchValue = @$filter["x_Omset"];
		$this->Omset->AdvancedSearch->SearchOperator = @$filter["z_Omset"];
		$this->Omset->AdvancedSearch->SearchCondition = @$filter["v_Omset"];
		$this->Omset->AdvancedSearch->SearchValue2 = @$filter["y_Omset"];
		$this->Omset->AdvancedSearch->SearchOperator2 = @$filter["w_Omset"];
		$this->Omset->AdvancedSearch->save();

		// Field Jumlah_Pegawai
		$this->Jumlah_Pegawai->AdvancedSearch->SearchValue = @$filter["x_Jumlah_Pegawai"];
		$this->Jumlah_Pegawai->AdvancedSearch->SearchOperator = @$filter["z_Jumlah_Pegawai"];
		$this->Jumlah_Pegawai->AdvancedSearch->SearchCondition = @$filter["v_Jumlah_Pegawai"];
		$this->Jumlah_Pegawai->AdvancedSearch->SearchValue2 = @$filter["y_Jumlah_Pegawai"];
		$this->Jumlah_Pegawai->AdvancedSearch->SearchOperator2 = @$filter["w_Jumlah_Pegawai"];
		$this->Jumlah_Pegawai->AdvancedSearch->save();

		// Field Legalitas_Perusahaan
		$this->Legalitas_Perusahaan->AdvancedSearch->SearchValue = @$filter["x_Legalitas_Perusahaan"];
		$this->Legalitas_Perusahaan->AdvancedSearch->SearchOperator = @$filter["z_Legalitas_Perusahaan"];
		$this->Legalitas_Perusahaan->AdvancedSearch->SearchCondition = @$filter["v_Legalitas_Perusahaan"];
		$this->Legalitas_Perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_Legalitas_Perusahaan"];
		$this->Legalitas_Perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_Legalitas_Perusahaan"];
		$this->Legalitas_Perusahaan->AdvancedSearch->save();

		// Field Sertifikasi_dimiliki
		$this->Sertifikasi_dimiliki->AdvancedSearch->SearchValue = @$filter["x_Sertifikasi_dimiliki"];
		$this->Sertifikasi_dimiliki->AdvancedSearch->SearchOperator = @$filter["z_Sertifikasi_dimiliki"];
		$this->Sertifikasi_dimiliki->AdvancedSearch->SearchCondition = @$filter["v_Sertifikasi_dimiliki"];
		$this->Sertifikasi_dimiliki->AdvancedSearch->SearchValue2 = @$filter["y_Sertifikasi_dimiliki"];
		$this->Sertifikasi_dimiliki->AdvancedSearch->SearchOperator2 = @$filter["w_Sertifikasi_dimiliki"];
		$this->Sertifikasi_dimiliki->AdvancedSearch->save();

		// Field Handphone
		$this->Handphone->AdvancedSearch->SearchValue = @$filter["x_Handphone"];
		$this->Handphone->AdvancedSearch->SearchOperator = @$filter["z_Handphone"];
		$this->Handphone->AdvancedSearch->SearchCondition = @$filter["v_Handphone"];
		$this->Handphone->AdvancedSearch->SearchValue2 = @$filter["y_Handphone"];
		$this->Handphone->AdvancedSearch->SearchOperator2 = @$filter["w_Handphone"];
		$this->Handphone->AdvancedSearch->save();

		// Field Email_Add
		$this->Email_Add->AdvancedSearch->SearchValue = @$filter["x_Email_Add"];
		$this->Email_Add->AdvancedSearch->SearchOperator = @$filter["z_Email_Add"];
		$this->Email_Add->AdvancedSearch->SearchCondition = @$filter["v_Email_Add"];
		$this->Email_Add->AdvancedSearch->SearchValue2 = @$filter["y_Email_Add"];
		$this->Email_Add->AdvancedSearch->SearchOperator2 = @$filter["w_Email_Add"];
		$this->Email_Add->AdvancedSearch->save();

		// Field Website
		$this->Website->AdvancedSearch->SearchValue = @$filter["x_Website"];
		$this->Website->AdvancedSearch->SearchOperator = @$filter["z_Website"];
		$this->Website->AdvancedSearch->SearchCondition = @$filter["v_Website"];
		$this->Website->AdvancedSearch->SearchValue2 = @$filter["y_Website"];
		$this->Website->AdvancedSearch->SearchOperator2 = @$filter["w_Website"];
		$this->Website->AdvancedSearch->save();

		// Field Tahun_Berdiri
		$this->Tahun_Berdiri->AdvancedSearch->SearchValue = @$filter["x_Tahun_Berdiri"];
		$this->Tahun_Berdiri->AdvancedSearch->SearchOperator = @$filter["z_Tahun_Berdiri"];
		$this->Tahun_Berdiri->AdvancedSearch->SearchCondition = @$filter["v_Tahun_Berdiri"];
		$this->Tahun_Berdiri->AdvancedSearch->SearchValue2 = @$filter["y_Tahun_Berdiri"];
		$this->Tahun_Berdiri->AdvancedSearch->SearchOperator2 = @$filter["w_Tahun_Berdiri"];
		$this->Tahun_Berdiri->AdvancedSearch->save();

		// Field Alamat_Produksi
		$this->Alamat_Produksi->AdvancedSearch->SearchValue = @$filter["x_Alamat_Produksi"];
		$this->Alamat_Produksi->AdvancedSearch->SearchOperator = @$filter["z_Alamat_Produksi"];
		$this->Alamat_Produksi->AdvancedSearch->SearchCondition = @$filter["v_Alamat_Produksi"];
		$this->Alamat_Produksi->AdvancedSearch->SearchValue2 = @$filter["y_Alamat_Produksi"];
		$this->Alamat_Produksi->AdvancedSearch->SearchOperator2 = @$filter["w_Alamat_Produksi"];
		$this->Alamat_Produksi->AdvancedSearch->save();

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
		$this->buildSearchSql($where, $this->ID_Unik, $default, FALSE); // ID_Unik
		$this->buildSearchSql($where, $this->Nama, $default, FALSE); // Nama
		$this->buildSearchSql($where, $this->Perusahaan, $default, FALSE); // Perusahaan
		$this->buildSearchSql($where, $this->Alamat, $default, FALSE); // Alamat
		$this->buildSearchSql($where, $this->Produk, $default, FALSE); // Produk
		$this->buildSearchSql($where, $this->Kapasitas_Produksi, $default, FALSE); // Kapasitas_Produksi
		$this->buildSearchSql($where, $this->Omset, $default, FALSE); // Omset
		$this->buildSearchSql($where, $this->Jumlah_Pegawai, $default, FALSE); // Jumlah_Pegawai
		$this->buildSearchSql($where, $this->Legalitas_Perusahaan, $default, FALSE); // Legalitas_Perusahaan
		$this->buildSearchSql($where, $this->Sertifikasi_dimiliki, $default, FALSE); // Sertifikasi_dimiliki
		$this->buildSearchSql($where, $this->Handphone, $default, FALSE); // Handphone
		$this->buildSearchSql($where, $this->Email_Add, $default, FALSE); // Email_Add
		$this->buildSearchSql($where, $this->Website, $default, FALSE); // Website
		$this->buildSearchSql($where, $this->Tahun_Berdiri, $default, FALSE); // Tahun_Berdiri
		$this->buildSearchSql($where, $this->Alamat_Produksi, $default, FALSE); // Alamat_Produksi
		$this->buildSearchSql($where, $this->Wilayah_ECP, $default, FALSE); // Wilayah_ECP
		$this->buildSearchSql($where, $this->Tahun_ECP, $default, FALSE); // Tahun_ECP

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->ID_Unik->AdvancedSearch->save(); // ID_Unik
			$this->Nama->AdvancedSearch->save(); // Nama
			$this->Perusahaan->AdvancedSearch->save(); // Perusahaan
			$this->Alamat->AdvancedSearch->save(); // Alamat
			$this->Produk->AdvancedSearch->save(); // Produk
			$this->Kapasitas_Produksi->AdvancedSearch->save(); // Kapasitas_Produksi
			$this->Omset->AdvancedSearch->save(); // Omset
			$this->Jumlah_Pegawai->AdvancedSearch->save(); // Jumlah_Pegawai
			$this->Legalitas_Perusahaan->AdvancedSearch->save(); // Legalitas_Perusahaan
			$this->Sertifikasi_dimiliki->AdvancedSearch->save(); // Sertifikasi_dimiliki
			$this->Handphone->AdvancedSearch->save(); // Handphone
			$this->Email_Add->AdvancedSearch->save(); // Email_Add
			$this->Website->AdvancedSearch->save(); // Website
			$this->Tahun_Berdiri->AdvancedSearch->save(); // Tahun_Berdiri
			$this->Alamat_Produksi->AdvancedSearch->save(); // Alamat_Produksi
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
		$this->buildBasicSearchSql($where, $this->Alamat, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Produk, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Kapasitas_Produksi, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Omset, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Legalitas_Perusahaan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Sertifikasi_dimiliki, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Email_Add, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Website, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Alamat_Produksi, $arKeywords, $type);
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
		if ($this->ID_Unik->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Nama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Perusahaan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Alamat->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Produk->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Kapasitas_Produksi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Omset->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Jumlah_Pegawai->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Legalitas_Perusahaan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Sertifikasi_dimiliki->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Handphone->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Email_Add->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Website->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Tahun_Berdiri->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Alamat_Produksi->AdvancedSearch->issetSession())
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
		$this->ID_Unik->AdvancedSearch->unsetSession();
		$this->Nama->AdvancedSearch->unsetSession();
		$this->Perusahaan->AdvancedSearch->unsetSession();
		$this->Alamat->AdvancedSearch->unsetSession();
		$this->Produk->AdvancedSearch->unsetSession();
		$this->Kapasitas_Produksi->AdvancedSearch->unsetSession();
		$this->Omset->AdvancedSearch->unsetSession();
		$this->Jumlah_Pegawai->AdvancedSearch->unsetSession();
		$this->Legalitas_Perusahaan->AdvancedSearch->unsetSession();
		$this->Sertifikasi_dimiliki->AdvancedSearch->unsetSession();
		$this->Handphone->AdvancedSearch->unsetSession();
		$this->Email_Add->AdvancedSearch->unsetSession();
		$this->Website->AdvancedSearch->unsetSession();
		$this->Tahun_Berdiri->AdvancedSearch->unsetSession();
		$this->Alamat_Produksi->AdvancedSearch->unsetSession();
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
		$this->ID_Unik->AdvancedSearch->load();
		$this->Nama->AdvancedSearch->load();
		$this->Perusahaan->AdvancedSearch->load();
		$this->Alamat->AdvancedSearch->load();
		$this->Produk->AdvancedSearch->load();
		$this->Kapasitas_Produksi->AdvancedSearch->load();
		$this->Omset->AdvancedSearch->load();
		$this->Jumlah_Pegawai->AdvancedSearch->load();
		$this->Legalitas_Perusahaan->AdvancedSearch->load();
		$this->Sertifikasi_dimiliki->AdvancedSearch->load();
		$this->Handphone->AdvancedSearch->load();
		$this->Email_Add->AdvancedSearch->load();
		$this->Website->AdvancedSearch->load();
		$this->Tahun_Berdiri->AdvancedSearch->load();
		$this->Alamat_Produksi->AdvancedSearch->load();
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
			$this->updateSort($this->ID_Unik); // ID_Unik
			$this->updateSort($this->Nama); // Nama
			$this->updateSort($this->Perusahaan); // Perusahaan
			$this->updateSort($this->Produk); // Produk
			$this->updateSort($this->Kapasitas_Produksi); // Kapasitas_Produksi
			$this->updateSort($this->Omset); // Omset
			$this->updateSort($this->Jumlah_Pegawai); // Jumlah_Pegawai
			$this->updateSort($this->Legalitas_Perusahaan); // Legalitas_Perusahaan
			$this->updateSort($this->Sertifikasi_dimiliki); // Sertifikasi_dimiliki
			$this->updateSort($this->Handphone); // Handphone
			$this->updateSort($this->Email_Add); // Email_Add
			$this->updateSort($this->Website); // Website
			$this->updateSort($this->Tahun_Berdiri); // Tahun_Berdiri
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
				$this->ID_Unik->setSort("");
				$this->Nama->setSort("");
				$this->Perusahaan->setSort("");
				$this->Produk->setSort("");
				$this->Kapasitas_Produksi->setSort("");
				$this->Omset->setSort("");
				$this->Jumlah_Pegawai->setSort("");
				$this->Legalitas_Perusahaan->setSort("");
				$this->Sertifikasi_dimiliki->setSort("");
				$this->Handphone->setSort("");
				$this->Email_Add->setSort("");
				$this->Website->setSort("");
				$this->Tahun_Berdiri->setSort("");
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ID_Unik->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ID_Unik->CurrentValue . "\">";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fdm_pesertaecplistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fdm_pesertaecplistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fdm_pesertaecplist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$this->ID_Unik->CurrentValue = NULL;
		$this->ID_Unik->OldValue = $this->ID_Unik->CurrentValue;
		$this->Nama->CurrentValue = NULL;
		$this->Nama->OldValue = $this->Nama->CurrentValue;
		$this->Perusahaan->CurrentValue = NULL;
		$this->Perusahaan->OldValue = $this->Perusahaan->CurrentValue;
		$this->Alamat->CurrentValue = NULL;
		$this->Alamat->OldValue = $this->Alamat->CurrentValue;
		$this->Produk->CurrentValue = NULL;
		$this->Produk->OldValue = $this->Produk->CurrentValue;
		$this->Kapasitas_Produksi->CurrentValue = NULL;
		$this->Kapasitas_Produksi->OldValue = $this->Kapasitas_Produksi->CurrentValue;
		$this->Omset->CurrentValue = NULL;
		$this->Omset->OldValue = $this->Omset->CurrentValue;
		$this->Jumlah_Pegawai->CurrentValue = NULL;
		$this->Jumlah_Pegawai->OldValue = $this->Jumlah_Pegawai->CurrentValue;
		$this->Legalitas_Perusahaan->CurrentValue = NULL;
		$this->Legalitas_Perusahaan->OldValue = $this->Legalitas_Perusahaan->CurrentValue;
		$this->Sertifikasi_dimiliki->CurrentValue = NULL;
		$this->Sertifikasi_dimiliki->OldValue = $this->Sertifikasi_dimiliki->CurrentValue;
		$this->Handphone->CurrentValue = NULL;
		$this->Handphone->OldValue = $this->Handphone->CurrentValue;
		$this->Email_Add->CurrentValue = NULL;
		$this->Email_Add->OldValue = $this->Email_Add->CurrentValue;
		$this->Website->CurrentValue = NULL;
		$this->Website->OldValue = $this->Website->CurrentValue;
		$this->Tahun_Berdiri->CurrentValue = NULL;
		$this->Tahun_Berdiri->OldValue = $this->Tahun_Berdiri->CurrentValue;
		$this->Alamat_Produksi->CurrentValue = NULL;
		$this->Alamat_Produksi->OldValue = $this->Alamat_Produksi->CurrentValue;
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

		// ID_Unik
		if (!$this->isAddOrEdit() && $this->ID_Unik->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ID_Unik->AdvancedSearch->SearchValue != "" || $this->ID_Unik->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// Alamat
		if (!$this->isAddOrEdit() && $this->Alamat->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Alamat->AdvancedSearch->SearchValue != "" || $this->Alamat->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Produk
		if (!$this->isAddOrEdit() && $this->Produk->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Produk->AdvancedSearch->SearchValue != "" || $this->Produk->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Kapasitas_Produksi
		if (!$this->isAddOrEdit() && $this->Kapasitas_Produksi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Kapasitas_Produksi->AdvancedSearch->SearchValue != "" || $this->Kapasitas_Produksi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Omset
		if (!$this->isAddOrEdit() && $this->Omset->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Omset->AdvancedSearch->SearchValue != "" || $this->Omset->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Jumlah_Pegawai
		if (!$this->isAddOrEdit() && $this->Jumlah_Pegawai->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Jumlah_Pegawai->AdvancedSearch->SearchValue != "" || $this->Jumlah_Pegawai->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Legalitas_Perusahaan
		if (!$this->isAddOrEdit() && $this->Legalitas_Perusahaan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Legalitas_Perusahaan->AdvancedSearch->SearchValue != "" || $this->Legalitas_Perusahaan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Sertifikasi_dimiliki
		if (!$this->isAddOrEdit() && $this->Sertifikasi_dimiliki->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Sertifikasi_dimiliki->AdvancedSearch->SearchValue != "" || $this->Sertifikasi_dimiliki->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Handphone
		if (!$this->isAddOrEdit() && $this->Handphone->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Handphone->AdvancedSearch->SearchValue != "" || $this->Handphone->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Email_Add
		if (!$this->isAddOrEdit() && $this->Email_Add->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Email_Add->AdvancedSearch->SearchValue != "" || $this->Email_Add->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Website
		if (!$this->isAddOrEdit() && $this->Website->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Website->AdvancedSearch->SearchValue != "" || $this->Website->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Tahun_Berdiri
		if (!$this->isAddOrEdit() && $this->Tahun_Berdiri->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Tahun_Berdiri->AdvancedSearch->SearchValue != "" || $this->Tahun_Berdiri->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Alamat_Produksi
		if (!$this->isAddOrEdit() && $this->Alamat_Produksi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Alamat_Produksi->AdvancedSearch->SearchValue != "" || $this->Alamat_Produksi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// Check field name 'ID_Unik' first before field var 'x_ID_Unik'
		$val = $CurrentForm->hasValue("ID_Unik") ? $CurrentForm->getValue("ID_Unik") : $CurrentForm->getValue("x_ID_Unik");
		if (!$this->ID_Unik->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->ID_Unik->setFormValue($val);

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

		// Check field name 'Kapasitas_Produksi' first before field var 'x_Kapasitas_Produksi'
		$val = $CurrentForm->hasValue("Kapasitas_Produksi") ? $CurrentForm->getValue("Kapasitas_Produksi") : $CurrentForm->getValue("x_Kapasitas_Produksi");
		if (!$this->Kapasitas_Produksi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Kapasitas_Produksi->Visible = FALSE; // Disable update for API request
			else
				$this->Kapasitas_Produksi->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Kapasitas_Produksi"))
			$this->Kapasitas_Produksi->setOldValue($CurrentForm->getValue("o_Kapasitas_Produksi"));

		// Check field name 'Omset' first before field var 'x_Omset'
		$val = $CurrentForm->hasValue("Omset") ? $CurrentForm->getValue("Omset") : $CurrentForm->getValue("x_Omset");
		if (!$this->Omset->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Omset->Visible = FALSE; // Disable update for API request
			else
				$this->Omset->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Omset"))
			$this->Omset->setOldValue($CurrentForm->getValue("o_Omset"));

		// Check field name 'Jumlah_Pegawai' first before field var 'x_Jumlah_Pegawai'
		$val = $CurrentForm->hasValue("Jumlah_Pegawai") ? $CurrentForm->getValue("Jumlah_Pegawai") : $CurrentForm->getValue("x_Jumlah_Pegawai");
		if (!$this->Jumlah_Pegawai->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Jumlah_Pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->Jumlah_Pegawai->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Jumlah_Pegawai"))
			$this->Jumlah_Pegawai->setOldValue($CurrentForm->getValue("o_Jumlah_Pegawai"));

		// Check field name 'Legalitas_Perusahaan' first before field var 'x_Legalitas_Perusahaan'
		$val = $CurrentForm->hasValue("Legalitas_Perusahaan") ? $CurrentForm->getValue("Legalitas_Perusahaan") : $CurrentForm->getValue("x_Legalitas_Perusahaan");
		if (!$this->Legalitas_Perusahaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Legalitas_Perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->Legalitas_Perusahaan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Legalitas_Perusahaan"))
			$this->Legalitas_Perusahaan->setOldValue($CurrentForm->getValue("o_Legalitas_Perusahaan"));

		// Check field name 'Sertifikasi_dimiliki' first before field var 'x_Sertifikasi_dimiliki'
		$val = $CurrentForm->hasValue("Sertifikasi_dimiliki") ? $CurrentForm->getValue("Sertifikasi_dimiliki") : $CurrentForm->getValue("x_Sertifikasi_dimiliki");
		if (!$this->Sertifikasi_dimiliki->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Sertifikasi_dimiliki->Visible = FALSE; // Disable update for API request
			else
				$this->Sertifikasi_dimiliki->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Sertifikasi_dimiliki"))
			$this->Sertifikasi_dimiliki->setOldValue($CurrentForm->getValue("o_Sertifikasi_dimiliki"));

		// Check field name 'Handphone' first before field var 'x_Handphone'
		$val = $CurrentForm->hasValue("Handphone") ? $CurrentForm->getValue("Handphone") : $CurrentForm->getValue("x_Handphone");
		if (!$this->Handphone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Handphone->Visible = FALSE; // Disable update for API request
			else
				$this->Handphone->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Handphone"))
			$this->Handphone->setOldValue($CurrentForm->getValue("o_Handphone"));

		// Check field name 'Email_Add' first before field var 'x_Email_Add'
		$val = $CurrentForm->hasValue("Email_Add") ? $CurrentForm->getValue("Email_Add") : $CurrentForm->getValue("x_Email_Add");
		if (!$this->Email_Add->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Email_Add->Visible = FALSE; // Disable update for API request
			else
				$this->Email_Add->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Email_Add"))
			$this->Email_Add->setOldValue($CurrentForm->getValue("o_Email_Add"));

		// Check field name 'Website' first before field var 'x_Website'
		$val = $CurrentForm->hasValue("Website") ? $CurrentForm->getValue("Website") : $CurrentForm->getValue("x_Website");
		if (!$this->Website->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Website->Visible = FALSE; // Disable update for API request
			else
				$this->Website->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Website"))
			$this->Website->setOldValue($CurrentForm->getValue("o_Website"));

		// Check field name 'Tahun_Berdiri' first before field var 'x_Tahun_Berdiri'
		$val = $CurrentForm->hasValue("Tahun_Berdiri") ? $CurrentForm->getValue("Tahun_Berdiri") : $CurrentForm->getValue("x_Tahun_Berdiri");
		if (!$this->Tahun_Berdiri->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Tahun_Berdiri->Visible = FALSE; // Disable update for API request
			else
				$this->Tahun_Berdiri->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Tahun_Berdiri"))
			$this->Tahun_Berdiri->setOldValue($CurrentForm->getValue("o_Tahun_Berdiri"));

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
			$this->ID_Unik->CurrentValue = $this->ID_Unik->FormValue;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->Perusahaan->CurrentValue = $this->Perusahaan->FormValue;
		$this->Produk->CurrentValue = $this->Produk->FormValue;
		$this->Kapasitas_Produksi->CurrentValue = $this->Kapasitas_Produksi->FormValue;
		$this->Omset->CurrentValue = $this->Omset->FormValue;
		$this->Jumlah_Pegawai->CurrentValue = $this->Jumlah_Pegawai->FormValue;
		$this->Legalitas_Perusahaan->CurrentValue = $this->Legalitas_Perusahaan->FormValue;
		$this->Sertifikasi_dimiliki->CurrentValue = $this->Sertifikasi_dimiliki->FormValue;
		$this->Handphone->CurrentValue = $this->Handphone->FormValue;
		$this->Email_Add->CurrentValue = $this->Email_Add->FormValue;
		$this->Website->CurrentValue = $this->Website->FormValue;
		$this->Tahun_Berdiri->CurrentValue = $this->Tahun_Berdiri->FormValue;
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
		$this->ID_Unik->setDbValue($row['ID_Unik']);
		$this->Nama->setDbValue($row['Nama']);
		$this->Perusahaan->setDbValue($row['Perusahaan']);
		$this->Alamat->setDbValue($row['Alamat']);
		$this->Produk->setDbValue($row['Produk']);
		$this->Kapasitas_Produksi->setDbValue($row['Kapasitas_Produksi']);
		$this->Omset->setDbValue($row['Omset']);
		$this->Jumlah_Pegawai->setDbValue($row['Jumlah_Pegawai']);
		$this->Legalitas_Perusahaan->setDbValue($row['Legalitas_Perusahaan']);
		$this->Sertifikasi_dimiliki->setDbValue($row['Sertifikasi_dimiliki']);
		$this->Handphone->setDbValue($row['Handphone']);
		$this->Email_Add->setDbValue($row['Email_Add']);
		$this->Website->setDbValue($row['Website']);
		$this->Tahun_Berdiri->setDbValue($row['Tahun_Berdiri']);
		$this->Alamat_Produksi->setDbValue($row['Alamat_Produksi']);
		$this->Wilayah_ECP->setDbValue($row['Wilayah_ECP']);
		$this->Tahun_ECP->setDbValue($row['Tahun_ECP']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Unik'] = $this->ID_Unik->CurrentValue;
		$row['Nama'] = $this->Nama->CurrentValue;
		$row['Perusahaan'] = $this->Perusahaan->CurrentValue;
		$row['Alamat'] = $this->Alamat->CurrentValue;
		$row['Produk'] = $this->Produk->CurrentValue;
		$row['Kapasitas_Produksi'] = $this->Kapasitas_Produksi->CurrentValue;
		$row['Omset'] = $this->Omset->CurrentValue;
		$row['Jumlah_Pegawai'] = $this->Jumlah_Pegawai->CurrentValue;
		$row['Legalitas_Perusahaan'] = $this->Legalitas_Perusahaan->CurrentValue;
		$row['Sertifikasi_dimiliki'] = $this->Sertifikasi_dimiliki->CurrentValue;
		$row['Handphone'] = $this->Handphone->CurrentValue;
		$row['Email_Add'] = $this->Email_Add->CurrentValue;
		$row['Website'] = $this->Website->CurrentValue;
		$row['Tahun_Berdiri'] = $this->Tahun_Berdiri->CurrentValue;
		$row['Alamat_Produksi'] = $this->Alamat_Produksi->CurrentValue;
		$row['Wilayah_ECP'] = $this->Wilayah_ECP->CurrentValue;
		$row['Tahun_ECP'] = $this->Tahun_ECP->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Unik")) != "")
			$this->ID_Unik->OldValue = $this->getKey("ID_Unik"); // ID_Unik
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
		// ID_Unik
		// Nama
		// Perusahaan
		// Alamat
		// Produk
		// Kapasitas_Produksi
		// Omset
		// Jumlah_Pegawai
		// Legalitas_Perusahaan
		// Sertifikasi_dimiliki
		// Handphone
		// Email_Add
		// Website
		// Tahun_Berdiri
		// Alamat_Produksi
		// Wilayah_ECP
		// Tahun_ECP

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_Unik
			$this->ID_Unik->ViewValue = $this->ID_Unik->CurrentValue;
			$this->ID_Unik->ViewCustomAttributes = "";

			// Nama
			$this->Nama->ViewValue = $this->Nama->CurrentValue;
			$this->Nama->ViewCustomAttributes = "";

			// Perusahaan
			$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
			$this->Perusahaan->ViewCustomAttributes = "";

			// Produk
			$this->Produk->ViewValue = $this->Produk->CurrentValue;
			$this->Produk->ViewCustomAttributes = "";

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->ViewValue = $this->Kapasitas_Produksi->CurrentValue;
			$this->Kapasitas_Produksi->ViewCustomAttributes = "";

			// Omset
			$this->Omset->ViewValue = $this->Omset->CurrentValue;
			$this->Omset->ViewCustomAttributes = "";

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->ViewValue = $this->Jumlah_Pegawai->CurrentValue;
			$this->Jumlah_Pegawai->ViewCustomAttributes = "";

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->ViewValue = $this->Legalitas_Perusahaan->CurrentValue;
			$this->Legalitas_Perusahaan->ViewCustomAttributes = "";

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->ViewValue = $this->Sertifikasi_dimiliki->CurrentValue;
			$this->Sertifikasi_dimiliki->ViewCustomAttributes = "";

			// Handphone
			$this->Handphone->ViewValue = $this->Handphone->CurrentValue;
			$this->Handphone->ViewCustomAttributes = "";

			// Email_Add
			$this->Email_Add->ViewValue = $this->Email_Add->CurrentValue;
			$this->Email_Add->ViewCustomAttributes = "";

			// Website
			$this->Website->ViewValue = $this->Website->CurrentValue;
			$this->Website->ViewCustomAttributes = "";

			// Tahun_Berdiri
			$this->Tahun_Berdiri->ViewValue = $this->Tahun_Berdiri->CurrentValue;
			$this->Tahun_Berdiri->ViewCustomAttributes = "";

			// Wilayah_ECP
			$arwrk = [];
			$arwrk[1] = $this->Wilayah_ECP->CurrentValue;
			$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->displayValue($arwrk);
			$this->Wilayah_ECP->ViewCustomAttributes = "";

			// Tahun_ECP
			$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
			$this->Tahun_ECP->ViewValue = FormatNumber($this->Tahun_ECP->ViewValue, 0, -2, -2, -2);
			$this->Tahun_ECP->ViewCustomAttributes = "";

			// ID_Unik
			$this->ID_Unik->LinkCustomAttributes = "";
			$this->ID_Unik->HrefValue = "";
			$this->ID_Unik->TooltipValue = "";

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

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->LinkCustomAttributes = "";
			$this->Kapasitas_Produksi->HrefValue = "";
			$this->Kapasitas_Produksi->TooltipValue = "";

			// Omset
			$this->Omset->LinkCustomAttributes = "";
			$this->Omset->HrefValue = "";
			$this->Omset->TooltipValue = "";

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->LinkCustomAttributes = "";
			$this->Jumlah_Pegawai->HrefValue = "";
			$this->Jumlah_Pegawai->TooltipValue = "";

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->LinkCustomAttributes = "";
			$this->Legalitas_Perusahaan->HrefValue = "";
			$this->Legalitas_Perusahaan->TooltipValue = "";

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->LinkCustomAttributes = "";
			$this->Sertifikasi_dimiliki->HrefValue = "";
			$this->Sertifikasi_dimiliki->TooltipValue = "";

			// Handphone
			$this->Handphone->LinkCustomAttributes = "";
			$this->Handphone->HrefValue = "";
			$this->Handphone->TooltipValue = "";

			// Email_Add
			$this->Email_Add->LinkCustomAttributes = "";
			$this->Email_Add->HrefValue = "";
			$this->Email_Add->TooltipValue = "";

			// Website
			$this->Website->LinkCustomAttributes = "";
			$this->Website->HrefValue = "";
			$this->Website->TooltipValue = "";

			// Tahun_Berdiri
			$this->Tahun_Berdiri->LinkCustomAttributes = "";
			$this->Tahun_Berdiri->HrefValue = "";
			$this->Tahun_Berdiri->TooltipValue = "";

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";
			$this->Wilayah_ECP->TooltipValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
			$this->Tahun_ECP->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ID_Unik
			// Nama

			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			if (!$this->Nama->Raw)
				$this->Nama->CurrentValue = HtmlDecode($this->Nama->CurrentValue);
			$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
			$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

			// Perusahaan
			$this->Perusahaan->EditAttrs["class"] = "form-control";
			$this->Perusahaan->EditCustomAttributes = "";
			if (!$this->Perusahaan->Raw)
				$this->Perusahaan->CurrentValue = HtmlDecode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->PlaceHolder = RemoveHtml($this->Perusahaan->caption());

			// Produk
			$this->Produk->EditAttrs["class"] = "form-control";
			$this->Produk->EditCustomAttributes = "";
			if (!$this->Produk->Raw)
				$this->Produk->CurrentValue = HtmlDecode($this->Produk->CurrentValue);
			$this->Produk->EditValue = HtmlEncode($this->Produk->CurrentValue);
			$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->EditAttrs["class"] = "form-control";
			$this->Kapasitas_Produksi->EditCustomAttributes = "";
			if (!$this->Kapasitas_Produksi->Raw)
				$this->Kapasitas_Produksi->CurrentValue = HtmlDecode($this->Kapasitas_Produksi->CurrentValue);
			$this->Kapasitas_Produksi->EditValue = HtmlEncode($this->Kapasitas_Produksi->CurrentValue);
			$this->Kapasitas_Produksi->PlaceHolder = RemoveHtml($this->Kapasitas_Produksi->caption());

			// Omset
			$this->Omset->EditAttrs["class"] = "form-control";
			$this->Omset->EditCustomAttributes = "";
			if (!$this->Omset->Raw)
				$this->Omset->CurrentValue = HtmlDecode($this->Omset->CurrentValue);
			$this->Omset->EditValue = HtmlEncode($this->Omset->CurrentValue);
			$this->Omset->PlaceHolder = RemoveHtml($this->Omset->caption());

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->EditAttrs["class"] = "form-control";
			$this->Jumlah_Pegawai->EditCustomAttributes = "";
			if (!$this->Jumlah_Pegawai->Raw)
				$this->Jumlah_Pegawai->CurrentValue = HtmlDecode($this->Jumlah_Pegawai->CurrentValue);
			$this->Jumlah_Pegawai->EditValue = HtmlEncode($this->Jumlah_Pegawai->CurrentValue);
			$this->Jumlah_Pegawai->PlaceHolder = RemoveHtml($this->Jumlah_Pegawai->caption());

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->EditAttrs["class"] = "form-control";
			$this->Legalitas_Perusahaan->EditCustomAttributes = "";
			if (!$this->Legalitas_Perusahaan->Raw)
				$this->Legalitas_Perusahaan->CurrentValue = HtmlDecode($this->Legalitas_Perusahaan->CurrentValue);
			$this->Legalitas_Perusahaan->EditValue = HtmlEncode($this->Legalitas_Perusahaan->CurrentValue);
			$this->Legalitas_Perusahaan->PlaceHolder = RemoveHtml($this->Legalitas_Perusahaan->caption());

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->EditAttrs["class"] = "form-control";
			$this->Sertifikasi_dimiliki->EditCustomAttributes = "";
			if (!$this->Sertifikasi_dimiliki->Raw)
				$this->Sertifikasi_dimiliki->CurrentValue = HtmlDecode($this->Sertifikasi_dimiliki->CurrentValue);
			$this->Sertifikasi_dimiliki->EditValue = HtmlEncode($this->Sertifikasi_dimiliki->CurrentValue);
			$this->Sertifikasi_dimiliki->PlaceHolder = RemoveHtml($this->Sertifikasi_dimiliki->caption());

			// Handphone
			$this->Handphone->EditAttrs["class"] = "form-control";
			$this->Handphone->EditCustomAttributes = "";
			if (!$this->Handphone->Raw)
				$this->Handphone->CurrentValue = HtmlDecode($this->Handphone->CurrentValue);
			$this->Handphone->EditValue = HtmlEncode($this->Handphone->CurrentValue);
			$this->Handphone->PlaceHolder = RemoveHtml($this->Handphone->caption());

			// Email_Add
			$this->Email_Add->EditAttrs["class"] = "form-control";
			$this->Email_Add->EditCustomAttributes = "";
			if (!$this->Email_Add->Raw)
				$this->Email_Add->CurrentValue = HtmlDecode($this->Email_Add->CurrentValue);
			$this->Email_Add->EditValue = HtmlEncode($this->Email_Add->CurrentValue);
			$this->Email_Add->PlaceHolder = RemoveHtml($this->Email_Add->caption());

			// Website
			$this->Website->EditAttrs["class"] = "form-control";
			$this->Website->EditCustomAttributes = "";
			if (!$this->Website->Raw)
				$this->Website->CurrentValue = HtmlDecode($this->Website->CurrentValue);
			$this->Website->EditValue = HtmlEncode($this->Website->CurrentValue);
			$this->Website->PlaceHolder = RemoveHtml($this->Website->caption());

			// Tahun_Berdiri
			$this->Tahun_Berdiri->EditAttrs["class"] = "form-control";
			$this->Tahun_Berdiri->EditCustomAttributes = "";
			if (!$this->Tahun_Berdiri->Raw)
				$this->Tahun_Berdiri->CurrentValue = HtmlDecode($this->Tahun_Berdiri->CurrentValue);
			$this->Tahun_Berdiri->EditValue = HtmlEncode($this->Tahun_Berdiri->CurrentValue);
			$this->Tahun_Berdiri->PlaceHolder = RemoveHtml($this->Tahun_Berdiri->caption());

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
			// ID_Unik

			$this->ID_Unik->LinkCustomAttributes = "";
			$this->ID_Unik->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->LinkCustomAttributes = "";
			$this->Kapasitas_Produksi->HrefValue = "";

			// Omset
			$this->Omset->LinkCustomAttributes = "";
			$this->Omset->HrefValue = "";

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->LinkCustomAttributes = "";
			$this->Jumlah_Pegawai->HrefValue = "";

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->LinkCustomAttributes = "";
			$this->Legalitas_Perusahaan->HrefValue = "";

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->LinkCustomAttributes = "";
			$this->Sertifikasi_dimiliki->HrefValue = "";

			// Handphone
			$this->Handphone->LinkCustomAttributes = "";
			$this->Handphone->HrefValue = "";

			// Email_Add
			$this->Email_Add->LinkCustomAttributes = "";
			$this->Email_Add->HrefValue = "";

			// Website
			$this->Website->LinkCustomAttributes = "";
			$this->Website->HrefValue = "";

			// Tahun_Berdiri
			$this->Tahun_Berdiri->LinkCustomAttributes = "";
			$this->Tahun_Berdiri->HrefValue = "";

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID_Unik
			$this->ID_Unik->EditAttrs["class"] = "form-control";
			$this->ID_Unik->EditCustomAttributes = "";
			$this->ID_Unik->EditValue = $this->ID_Unik->CurrentValue;
			$this->ID_Unik->ViewCustomAttributes = "";

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			if (!$this->Nama->Raw)
				$this->Nama->CurrentValue = HtmlDecode($this->Nama->CurrentValue);
			$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
			$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

			// Perusahaan
			$this->Perusahaan->EditAttrs["class"] = "form-control";
			$this->Perusahaan->EditCustomAttributes = "";
			if (!$this->Perusahaan->Raw)
				$this->Perusahaan->CurrentValue = HtmlDecode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->PlaceHolder = RemoveHtml($this->Perusahaan->caption());

			// Produk
			$this->Produk->EditAttrs["class"] = "form-control";
			$this->Produk->EditCustomAttributes = "";
			if (!$this->Produk->Raw)
				$this->Produk->CurrentValue = HtmlDecode($this->Produk->CurrentValue);
			$this->Produk->EditValue = HtmlEncode($this->Produk->CurrentValue);
			$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->EditAttrs["class"] = "form-control";
			$this->Kapasitas_Produksi->EditCustomAttributes = "";
			if (!$this->Kapasitas_Produksi->Raw)
				$this->Kapasitas_Produksi->CurrentValue = HtmlDecode($this->Kapasitas_Produksi->CurrentValue);
			$this->Kapasitas_Produksi->EditValue = HtmlEncode($this->Kapasitas_Produksi->CurrentValue);
			$this->Kapasitas_Produksi->PlaceHolder = RemoveHtml($this->Kapasitas_Produksi->caption());

			// Omset
			$this->Omset->EditAttrs["class"] = "form-control";
			$this->Omset->EditCustomAttributes = "";
			if (!$this->Omset->Raw)
				$this->Omset->CurrentValue = HtmlDecode($this->Omset->CurrentValue);
			$this->Omset->EditValue = HtmlEncode($this->Omset->CurrentValue);
			$this->Omset->PlaceHolder = RemoveHtml($this->Omset->caption());

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->EditAttrs["class"] = "form-control";
			$this->Jumlah_Pegawai->EditCustomAttributes = "";
			if (!$this->Jumlah_Pegawai->Raw)
				$this->Jumlah_Pegawai->CurrentValue = HtmlDecode($this->Jumlah_Pegawai->CurrentValue);
			$this->Jumlah_Pegawai->EditValue = HtmlEncode($this->Jumlah_Pegawai->CurrentValue);
			$this->Jumlah_Pegawai->PlaceHolder = RemoveHtml($this->Jumlah_Pegawai->caption());

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->EditAttrs["class"] = "form-control";
			$this->Legalitas_Perusahaan->EditCustomAttributes = "";
			if (!$this->Legalitas_Perusahaan->Raw)
				$this->Legalitas_Perusahaan->CurrentValue = HtmlDecode($this->Legalitas_Perusahaan->CurrentValue);
			$this->Legalitas_Perusahaan->EditValue = HtmlEncode($this->Legalitas_Perusahaan->CurrentValue);
			$this->Legalitas_Perusahaan->PlaceHolder = RemoveHtml($this->Legalitas_Perusahaan->caption());

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->EditAttrs["class"] = "form-control";
			$this->Sertifikasi_dimiliki->EditCustomAttributes = "";
			if (!$this->Sertifikasi_dimiliki->Raw)
				$this->Sertifikasi_dimiliki->CurrentValue = HtmlDecode($this->Sertifikasi_dimiliki->CurrentValue);
			$this->Sertifikasi_dimiliki->EditValue = HtmlEncode($this->Sertifikasi_dimiliki->CurrentValue);
			$this->Sertifikasi_dimiliki->PlaceHolder = RemoveHtml($this->Sertifikasi_dimiliki->caption());

			// Handphone
			$this->Handphone->EditAttrs["class"] = "form-control";
			$this->Handphone->EditCustomAttributes = "";
			if (!$this->Handphone->Raw)
				$this->Handphone->CurrentValue = HtmlDecode($this->Handphone->CurrentValue);
			$this->Handphone->EditValue = HtmlEncode($this->Handphone->CurrentValue);
			$this->Handphone->PlaceHolder = RemoveHtml($this->Handphone->caption());

			// Email_Add
			$this->Email_Add->EditAttrs["class"] = "form-control";
			$this->Email_Add->EditCustomAttributes = "";
			if (!$this->Email_Add->Raw)
				$this->Email_Add->CurrentValue = HtmlDecode($this->Email_Add->CurrentValue);
			$this->Email_Add->EditValue = HtmlEncode($this->Email_Add->CurrentValue);
			$this->Email_Add->PlaceHolder = RemoveHtml($this->Email_Add->caption());

			// Website
			$this->Website->EditAttrs["class"] = "form-control";
			$this->Website->EditCustomAttributes = "";
			if (!$this->Website->Raw)
				$this->Website->CurrentValue = HtmlDecode($this->Website->CurrentValue);
			$this->Website->EditValue = HtmlEncode($this->Website->CurrentValue);
			$this->Website->PlaceHolder = RemoveHtml($this->Website->caption());

			// Tahun_Berdiri
			$this->Tahun_Berdiri->EditAttrs["class"] = "form-control";
			$this->Tahun_Berdiri->EditCustomAttributes = "";
			if (!$this->Tahun_Berdiri->Raw)
				$this->Tahun_Berdiri->CurrentValue = HtmlDecode($this->Tahun_Berdiri->CurrentValue);
			$this->Tahun_Berdiri->EditValue = HtmlEncode($this->Tahun_Berdiri->CurrentValue);
			$this->Tahun_Berdiri->PlaceHolder = RemoveHtml($this->Tahun_Berdiri->caption());

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
			// ID_Unik

			$this->ID_Unik->LinkCustomAttributes = "";
			$this->ID_Unik->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->LinkCustomAttributes = "";
			$this->Kapasitas_Produksi->HrefValue = "";

			// Omset
			$this->Omset->LinkCustomAttributes = "";
			$this->Omset->HrefValue = "";

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->LinkCustomAttributes = "";
			$this->Jumlah_Pegawai->HrefValue = "";

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->LinkCustomAttributes = "";
			$this->Legalitas_Perusahaan->HrefValue = "";

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->LinkCustomAttributes = "";
			$this->Sertifikasi_dimiliki->HrefValue = "";

			// Handphone
			$this->Handphone->LinkCustomAttributes = "";
			$this->Handphone->HrefValue = "";

			// Email_Add
			$this->Email_Add->LinkCustomAttributes = "";
			$this->Email_Add->HrefValue = "";

			// Website
			$this->Website->LinkCustomAttributes = "";
			$this->Website->HrefValue = "";

			// Tahun_Berdiri
			$this->Tahun_Berdiri->LinkCustomAttributes = "";
			$this->Tahun_Berdiri->HrefValue = "";

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ID_Unik
			$this->ID_Unik->EditAttrs["class"] = "form-control";
			$this->ID_Unik->EditCustomAttributes = "";
			$this->ID_Unik->EditValue = HtmlEncode($this->ID_Unik->AdvancedSearch->SearchValue);
			$this->ID_Unik->PlaceHolder = RemoveHtml($this->ID_Unik->caption());

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

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->EditAttrs["class"] = "form-control";
			$this->Kapasitas_Produksi->EditCustomAttributes = "";
			if (!$this->Kapasitas_Produksi->Raw)
				$this->Kapasitas_Produksi->AdvancedSearch->SearchValue = HtmlDecode($this->Kapasitas_Produksi->AdvancedSearch->SearchValue);
			$this->Kapasitas_Produksi->EditValue = HtmlEncode($this->Kapasitas_Produksi->AdvancedSearch->SearchValue);
			$this->Kapasitas_Produksi->PlaceHolder = RemoveHtml($this->Kapasitas_Produksi->caption());

			// Omset
			$this->Omset->EditAttrs["class"] = "form-control";
			$this->Omset->EditCustomAttributes = "";
			if (!$this->Omset->Raw)
				$this->Omset->AdvancedSearch->SearchValue = HtmlDecode($this->Omset->AdvancedSearch->SearchValue);
			$this->Omset->EditValue = HtmlEncode($this->Omset->AdvancedSearch->SearchValue);
			$this->Omset->PlaceHolder = RemoveHtml($this->Omset->caption());

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->EditAttrs["class"] = "form-control";
			$this->Jumlah_Pegawai->EditCustomAttributes = "";
			if (!$this->Jumlah_Pegawai->Raw)
				$this->Jumlah_Pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->Jumlah_Pegawai->AdvancedSearch->SearchValue);
			$this->Jumlah_Pegawai->EditValue = HtmlEncode($this->Jumlah_Pegawai->AdvancedSearch->SearchValue);
			$this->Jumlah_Pegawai->PlaceHolder = RemoveHtml($this->Jumlah_Pegawai->caption());

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->EditAttrs["class"] = "form-control";
			$this->Legalitas_Perusahaan->EditCustomAttributes = "";
			if (!$this->Legalitas_Perusahaan->Raw)
				$this->Legalitas_Perusahaan->AdvancedSearch->SearchValue = HtmlDecode($this->Legalitas_Perusahaan->AdvancedSearch->SearchValue);
			$this->Legalitas_Perusahaan->EditValue = HtmlEncode($this->Legalitas_Perusahaan->AdvancedSearch->SearchValue);
			$this->Legalitas_Perusahaan->PlaceHolder = RemoveHtml($this->Legalitas_Perusahaan->caption());

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->EditAttrs["class"] = "form-control";
			$this->Sertifikasi_dimiliki->EditCustomAttributes = "";
			if (!$this->Sertifikasi_dimiliki->Raw)
				$this->Sertifikasi_dimiliki->AdvancedSearch->SearchValue = HtmlDecode($this->Sertifikasi_dimiliki->AdvancedSearch->SearchValue);
			$this->Sertifikasi_dimiliki->EditValue = HtmlEncode($this->Sertifikasi_dimiliki->AdvancedSearch->SearchValue);
			$this->Sertifikasi_dimiliki->PlaceHolder = RemoveHtml($this->Sertifikasi_dimiliki->caption());

			// Handphone
			$this->Handphone->EditAttrs["class"] = "form-control";
			$this->Handphone->EditCustomAttributes = "";
			if (!$this->Handphone->Raw)
				$this->Handphone->AdvancedSearch->SearchValue = HtmlDecode($this->Handphone->AdvancedSearch->SearchValue);
			$this->Handphone->EditValue = HtmlEncode($this->Handphone->AdvancedSearch->SearchValue);
			$this->Handphone->PlaceHolder = RemoveHtml($this->Handphone->caption());

			// Email_Add
			$this->Email_Add->EditAttrs["class"] = "form-control";
			$this->Email_Add->EditCustomAttributes = "";
			if (!$this->Email_Add->Raw)
				$this->Email_Add->AdvancedSearch->SearchValue = HtmlDecode($this->Email_Add->AdvancedSearch->SearchValue);
			$this->Email_Add->EditValue = HtmlEncode($this->Email_Add->AdvancedSearch->SearchValue);
			$this->Email_Add->PlaceHolder = RemoveHtml($this->Email_Add->caption());

			// Website
			$this->Website->EditAttrs["class"] = "form-control";
			$this->Website->EditCustomAttributes = "";
			if (!$this->Website->Raw)
				$this->Website->AdvancedSearch->SearchValue = HtmlDecode($this->Website->AdvancedSearch->SearchValue);
			$this->Website->EditValue = HtmlEncode($this->Website->AdvancedSearch->SearchValue);
			$this->Website->PlaceHolder = RemoveHtml($this->Website->caption());

			// Tahun_Berdiri
			$this->Tahun_Berdiri->EditAttrs["class"] = "form-control";
			$this->Tahun_Berdiri->EditCustomAttributes = "";
			if (!$this->Tahun_Berdiri->Raw)
				$this->Tahun_Berdiri->AdvancedSearch->SearchValue = HtmlDecode($this->Tahun_Berdiri->AdvancedSearch->SearchValue);
			$this->Tahun_Berdiri->EditValue = HtmlEncode($this->Tahun_Berdiri->AdvancedSearch->SearchValue);
			$this->Tahun_Berdiri->PlaceHolder = RemoveHtml($this->Tahun_Berdiri->caption());

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
		if ($this->ID_Unik->Required) {
			if (!$this->ID_Unik->IsDetailKey && $this->ID_Unik->FormValue != NULL && $this->ID_Unik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Unik->caption(), $this->ID_Unik->RequiredErrorMessage));
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
		if ($this->Produk->Required) {
			if (!$this->Produk->IsDetailKey && $this->Produk->FormValue != NULL && $this->Produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Produk->caption(), $this->Produk->RequiredErrorMessage));
			}
		}
		if ($this->Kapasitas_Produksi->Required) {
			if (!$this->Kapasitas_Produksi->IsDetailKey && $this->Kapasitas_Produksi->FormValue != NULL && $this->Kapasitas_Produksi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Kapasitas_Produksi->caption(), $this->Kapasitas_Produksi->RequiredErrorMessage));
			}
		}
		if ($this->Omset->Required) {
			if (!$this->Omset->IsDetailKey && $this->Omset->FormValue != NULL && $this->Omset->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Omset->caption(), $this->Omset->RequiredErrorMessage));
			}
		}
		if ($this->Jumlah_Pegawai->Required) {
			if (!$this->Jumlah_Pegawai->IsDetailKey && $this->Jumlah_Pegawai->FormValue != NULL && $this->Jumlah_Pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Jumlah_Pegawai->caption(), $this->Jumlah_Pegawai->RequiredErrorMessage));
			}
		}
		if ($this->Legalitas_Perusahaan->Required) {
			if (!$this->Legalitas_Perusahaan->IsDetailKey && $this->Legalitas_Perusahaan->FormValue != NULL && $this->Legalitas_Perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Legalitas_Perusahaan->caption(), $this->Legalitas_Perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->Sertifikasi_dimiliki->Required) {
			if (!$this->Sertifikasi_dimiliki->IsDetailKey && $this->Sertifikasi_dimiliki->FormValue != NULL && $this->Sertifikasi_dimiliki->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Sertifikasi_dimiliki->caption(), $this->Sertifikasi_dimiliki->RequiredErrorMessage));
			}
		}
		if ($this->Handphone->Required) {
			if (!$this->Handphone->IsDetailKey && $this->Handphone->FormValue != NULL && $this->Handphone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Handphone->caption(), $this->Handphone->RequiredErrorMessage));
			}
		}
		if ($this->Email_Add->Required) {
			if (!$this->Email_Add->IsDetailKey && $this->Email_Add->FormValue != NULL && $this->Email_Add->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Email_Add->caption(), $this->Email_Add->RequiredErrorMessage));
			}
		}
		if ($this->Website->Required) {
			if (!$this->Website->IsDetailKey && $this->Website->FormValue != NULL && $this->Website->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Website->caption(), $this->Website->RequiredErrorMessage));
			}
		}
		if ($this->Tahun_Berdiri->Required) {
			if (!$this->Tahun_Berdiri->IsDetailKey && $this->Tahun_Berdiri->FormValue != NULL && $this->Tahun_Berdiri->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tahun_Berdiri->caption(), $this->Tahun_Berdiri->RequiredErrorMessage));
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
				$thisKey .= $row['ID_Unik'];
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

			// Produk
			$this->Produk->setDbValueDef($rsnew, $this->Produk->CurrentValue, NULL, $this->Produk->ReadOnly);

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->setDbValueDef($rsnew, $this->Kapasitas_Produksi->CurrentValue, NULL, $this->Kapasitas_Produksi->ReadOnly);

			// Omset
			$this->Omset->setDbValueDef($rsnew, $this->Omset->CurrentValue, NULL, $this->Omset->ReadOnly);

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->setDbValueDef($rsnew, $this->Jumlah_Pegawai->CurrentValue, NULL, $this->Jumlah_Pegawai->ReadOnly);

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->setDbValueDef($rsnew, $this->Legalitas_Perusahaan->CurrentValue, NULL, $this->Legalitas_Perusahaan->ReadOnly);

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->setDbValueDef($rsnew, $this->Sertifikasi_dimiliki->CurrentValue, NULL, $this->Sertifikasi_dimiliki->ReadOnly);

			// Handphone
			$this->Handphone->setDbValueDef($rsnew, $this->Handphone->CurrentValue, NULL, $this->Handphone->ReadOnly);

			// Email_Add
			$this->Email_Add->setDbValueDef($rsnew, $this->Email_Add->CurrentValue, NULL, $this->Email_Add->ReadOnly);

			// Website
			$this->Website->setDbValueDef($rsnew, $this->Website->CurrentValue, NULL, $this->Website->ReadOnly);

			// Tahun_Berdiri
			$this->Tahun_Berdiri->setDbValueDef($rsnew, $this->Tahun_Berdiri->CurrentValue, NULL, $this->Tahun_Berdiri->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('Produk')); // Produk
		$hash .= GetFieldHash($rs->fields('Kapasitas_Produksi')); // Kapasitas_Produksi
		$hash .= GetFieldHash($rs->fields('Omset')); // Omset
		$hash .= GetFieldHash($rs->fields('Jumlah_Pegawai')); // Jumlah_Pegawai
		$hash .= GetFieldHash($rs->fields('Legalitas_Perusahaan')); // Legalitas_Perusahaan
		$hash .= GetFieldHash($rs->fields('Sertifikasi_dimiliki')); // Sertifikasi_dimiliki
		$hash .= GetFieldHash($rs->fields('Handphone')); // Handphone
		$hash .= GetFieldHash($rs->fields('Email_Add')); // Email_Add
		$hash .= GetFieldHash($rs->fields('Website')); // Website
		$hash .= GetFieldHash($rs->fields('Tahun_Berdiri')); // Tahun_Berdiri
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

		// Produk
		$this->Produk->setDbValueDef($rsnew, $this->Produk->CurrentValue, NULL, FALSE);

		// Kapasitas_Produksi
		$this->Kapasitas_Produksi->setDbValueDef($rsnew, $this->Kapasitas_Produksi->CurrentValue, NULL, FALSE);

		// Omset
		$this->Omset->setDbValueDef($rsnew, $this->Omset->CurrentValue, NULL, FALSE);

		// Jumlah_Pegawai
		$this->Jumlah_Pegawai->setDbValueDef($rsnew, $this->Jumlah_Pegawai->CurrentValue, NULL, FALSE);

		// Legalitas_Perusahaan
		$this->Legalitas_Perusahaan->setDbValueDef($rsnew, $this->Legalitas_Perusahaan->CurrentValue, NULL, FALSE);

		// Sertifikasi_dimiliki
		$this->Sertifikasi_dimiliki->setDbValueDef($rsnew, $this->Sertifikasi_dimiliki->CurrentValue, NULL, FALSE);

		// Handphone
		$this->Handphone->setDbValueDef($rsnew, $this->Handphone->CurrentValue, NULL, FALSE);

		// Email_Add
		$this->Email_Add->setDbValueDef($rsnew, $this->Email_Add->CurrentValue, NULL, FALSE);

		// Website
		$this->Website->setDbValueDef($rsnew, $this->Website->CurrentValue, NULL, FALSE);

		// Tahun_Berdiri
		$this->Tahun_Berdiri->setDbValueDef($rsnew, $this->Tahun_Berdiri->CurrentValue, NULL, FALSE);

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
		$this->ID_Unik->AdvancedSearch->load();
		$this->Nama->AdvancedSearch->load();
		$this->Perusahaan->AdvancedSearch->load();
		$this->Alamat->AdvancedSearch->load();
		$this->Produk->AdvancedSearch->load();
		$this->Kapasitas_Produksi->AdvancedSearch->load();
		$this->Omset->AdvancedSearch->load();
		$this->Jumlah_Pegawai->AdvancedSearch->load();
		$this->Legalitas_Perusahaan->AdvancedSearch->load();
		$this->Sertifikasi_dimiliki->AdvancedSearch->load();
		$this->Handphone->AdvancedSearch->load();
		$this->Email_Add->AdvancedSearch->load();
		$this->Website->AdvancedSearch->load();
		$this->Tahun_Berdiri->AdvancedSearch->load();
		$this->Alamat_Produksi->AdvancedSearch->load();
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fdm_pesertaecplistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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