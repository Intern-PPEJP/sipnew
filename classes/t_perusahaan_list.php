<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_perusahaan_list extends t_perusahaan
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_perusahaan';

	// Page object name
	public $PageObjName = "t_perusahaan_list";

	// Grid form hidden field names
	public $FormName = "ft_perusahaanlist";
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

		// Table object (t_perusahaan)
		if (!isset($GLOBALS["t_perusahaan"]) || get_class($GLOBALS["t_perusahaan"]) == PROJECT_NAMESPACE . "t_perusahaan") {
			$GLOBALS["t_perusahaan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_perusahaan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "t_perusahaanadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "t_perusahaandelete.php";
		$this->MultiUpdateUrl = "t_perusahaanupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_perusahaan');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ft_perusahaanlistsrch";

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
		global $t_perusahaan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_perusahaan);
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
			$key .= @$ar['idp'];
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
			$this->idp->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->created_at->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->user_created_by->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->updated_at->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->user_updated_by->Visible = FALSE;
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
	public $t_peserta_Count;
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
		$this->namap->setVisibility();
		$this->idp->setVisibility();
		$this->kontak->setVisibility();
		$this->kdlokasi->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->alamatp->setVisibility();
		$this->kdpos->Visible = FALSE;
		$this->telpp->setVisibility();
		$this->faxp->setVisibility();
		$this->emailp->setVisibility();
		$this->webp->setVisibility();
		$this->medsos->setVisibility();
		$this->kdjenis->setVisibility();
		$this->kdproduknafed->setVisibility();
		$this->kdproduknafed2->setVisibility();
		$this->kdproduknafed3->setVisibility();
		$this->pproduk->setVisibility();
		$this->kdexport->setVisibility();
		$this->nexport->setVisibility();
		$this->kdskala->setVisibility();
		$this->kdkategori->setVisibility();
		$this->omzet_saat_ini->Visible = FALSE;
		$this->omzet_stl_6bln->Visible = FALSE;
		$this->omzet_stl_1thn->Visible = FALSE;
		$this->omzet_stl_2thn->Visible = FALSE;
		$this->kapasitas_saat_ini->Visible = FALSE;
		$this->kapasitas_stl_6bln->Visible = FALSE;
		$this->kapasitas_stl_1thn->Visible = FALSE;
		$this->kapasitas_stl_2thn->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->user_created_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->user_updated_by->Visible = FALSE;
		$this->jpeserta->setVisibility();
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
		$this->setupLookupOptions($this->idp);
		$this->setupLookupOptions($this->kdlokasi);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);
		$this->setupLookupOptions($this->kdkec);
		$this->setupLookupOptions($this->kdjenis);
		$this->setupLookupOptions($this->kdproduknafed);
		$this->setupLookupOptions($this->kdproduknafed2);
		$this->setupLookupOptions($this->kdproduknafed3);
		$this->setupLookupOptions($this->kdexport);
		$this->setupLookupOptions($this->kdskala);
		$this->setupLookupOptions($this->kdkategori);

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
			$this->idp->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->idp->OldValue))
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
		$filterList = Concat($filterList, $this->namap->AdvancedSearch->toJson(), ","); // Field namap
		$filterList = Concat($filterList, $this->idp->AdvancedSearch->toJson(), ","); // Field idp
		$filterList = Concat($filterList, $this->kontak->AdvancedSearch->toJson(), ","); // Field kontak
		$filterList = Concat($filterList, $this->kdlokasi->AdvancedSearch->toJson(), ","); // Field kdlokasi
		$filterList = Concat($filterList, $this->kdprop->AdvancedSearch->toJson(), ","); // Field kdprop
		$filterList = Concat($filterList, $this->kdkota->AdvancedSearch->toJson(), ","); // Field kdkota
		$filterList = Concat($filterList, $this->kdkec->AdvancedSearch->toJson(), ","); // Field kdkec
		$filterList = Concat($filterList, $this->alamatp->AdvancedSearch->toJson(), ","); // Field alamatp
		$filterList = Concat($filterList, $this->kdpos->AdvancedSearch->toJson(), ","); // Field kdpos
		$filterList = Concat($filterList, $this->telpp->AdvancedSearch->toJson(), ","); // Field telpp
		$filterList = Concat($filterList, $this->faxp->AdvancedSearch->toJson(), ","); // Field faxp
		$filterList = Concat($filterList, $this->emailp->AdvancedSearch->toJson(), ","); // Field emailp
		$filterList = Concat($filterList, $this->webp->AdvancedSearch->toJson(), ","); // Field webp
		$filterList = Concat($filterList, $this->kdjenis->AdvancedSearch->toJson(), ","); // Field kdjenis
		$filterList = Concat($filterList, $this->kdproduknafed->AdvancedSearch->toJson(), ","); // Field kdproduknafed
		$filterList = Concat($filterList, $this->pproduk->AdvancedSearch->toJson(), ","); // Field pproduk
		$filterList = Concat($filterList, $this->kdexport->AdvancedSearch->toJson(), ","); // Field kdexport
		$filterList = Concat($filterList, $this->nexport->AdvancedSearch->toJson(), ","); // Field nexport
		$filterList = Concat($filterList, $this->kdskala->AdvancedSearch->toJson(), ","); // Field kdskala
		$filterList = Concat($filterList, $this->kdkategori->AdvancedSearch->toJson(), ","); // Field kdkategori
		$filterList = Concat($filterList, $this->omzet_saat_ini->AdvancedSearch->toJson(), ","); // Field omzet_saat_ini
		$filterList = Concat($filterList, $this->kapasitas_saat_ini->AdvancedSearch->toJson(), ","); // Field kapasitas_saat_ini
		$filterList = Concat($filterList, $this->kapasitas_stl_1thn->AdvancedSearch->toJson(), ","); // Field kapasitas_stl_1thn
		$filterList = Concat($filterList, $this->kapasitas_stl_2thn->AdvancedSearch->toJson(), ","); // Field kapasitas_stl_2thn
		$filterList = Concat($filterList, $this->jpeserta->AdvancedSearch->toJson(), ","); // Field jpeserta

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
			$UserProfile->setSearchFilters(CurrentUserName(), "ft_perusahaanlistsrch", $filters);
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

		// Field namap
		$this->namap->AdvancedSearch->SearchValue = @$filter["x_namap"];
		$this->namap->AdvancedSearch->SearchOperator = @$filter["z_namap"];
		$this->namap->AdvancedSearch->SearchCondition = @$filter["v_namap"];
		$this->namap->AdvancedSearch->SearchValue2 = @$filter["y_namap"];
		$this->namap->AdvancedSearch->SearchOperator2 = @$filter["w_namap"];
		$this->namap->AdvancedSearch->save();

		// Field idp
		$this->idp->AdvancedSearch->SearchValue = @$filter["x_idp"];
		$this->idp->AdvancedSearch->SearchOperator = @$filter["z_idp"];
		$this->idp->AdvancedSearch->SearchCondition = @$filter["v_idp"];
		$this->idp->AdvancedSearch->SearchValue2 = @$filter["y_idp"];
		$this->idp->AdvancedSearch->SearchOperator2 = @$filter["w_idp"];
		$this->idp->AdvancedSearch->save();

		// Field kontak
		$this->kontak->AdvancedSearch->SearchValue = @$filter["x_kontak"];
		$this->kontak->AdvancedSearch->SearchOperator = @$filter["z_kontak"];
		$this->kontak->AdvancedSearch->SearchCondition = @$filter["v_kontak"];
		$this->kontak->AdvancedSearch->SearchValue2 = @$filter["y_kontak"];
		$this->kontak->AdvancedSearch->SearchOperator2 = @$filter["w_kontak"];
		$this->kontak->AdvancedSearch->save();

		// Field kdlokasi
		$this->kdlokasi->AdvancedSearch->SearchValue = @$filter["x_kdlokasi"];
		$this->kdlokasi->AdvancedSearch->SearchOperator = @$filter["z_kdlokasi"];
		$this->kdlokasi->AdvancedSearch->SearchCondition = @$filter["v_kdlokasi"];
		$this->kdlokasi->AdvancedSearch->SearchValue2 = @$filter["y_kdlokasi"];
		$this->kdlokasi->AdvancedSearch->SearchOperator2 = @$filter["w_kdlokasi"];
		$this->kdlokasi->AdvancedSearch->save();

		// Field kdprop
		$this->kdprop->AdvancedSearch->SearchValue = @$filter["x_kdprop"];
		$this->kdprop->AdvancedSearch->SearchOperator = @$filter["z_kdprop"];
		$this->kdprop->AdvancedSearch->SearchCondition = @$filter["v_kdprop"];
		$this->kdprop->AdvancedSearch->SearchValue2 = @$filter["y_kdprop"];
		$this->kdprop->AdvancedSearch->SearchOperator2 = @$filter["w_kdprop"];
		$this->kdprop->AdvancedSearch->save();

		// Field kdkota
		$this->kdkota->AdvancedSearch->SearchValue = @$filter["x_kdkota"];
		$this->kdkota->AdvancedSearch->SearchOperator = @$filter["z_kdkota"];
		$this->kdkota->AdvancedSearch->SearchCondition = @$filter["v_kdkota"];
		$this->kdkota->AdvancedSearch->SearchValue2 = @$filter["y_kdkota"];
		$this->kdkota->AdvancedSearch->SearchOperator2 = @$filter["w_kdkota"];
		$this->kdkota->AdvancedSearch->save();

		// Field kdkec
		$this->kdkec->AdvancedSearch->SearchValue = @$filter["x_kdkec"];
		$this->kdkec->AdvancedSearch->SearchOperator = @$filter["z_kdkec"];
		$this->kdkec->AdvancedSearch->SearchCondition = @$filter["v_kdkec"];
		$this->kdkec->AdvancedSearch->SearchValue2 = @$filter["y_kdkec"];
		$this->kdkec->AdvancedSearch->SearchOperator2 = @$filter["w_kdkec"];
		$this->kdkec->AdvancedSearch->save();

		// Field alamatp
		$this->alamatp->AdvancedSearch->SearchValue = @$filter["x_alamatp"];
		$this->alamatp->AdvancedSearch->SearchOperator = @$filter["z_alamatp"];
		$this->alamatp->AdvancedSearch->SearchCondition = @$filter["v_alamatp"];
		$this->alamatp->AdvancedSearch->SearchValue2 = @$filter["y_alamatp"];
		$this->alamatp->AdvancedSearch->SearchOperator2 = @$filter["w_alamatp"];
		$this->alamatp->AdvancedSearch->save();

		// Field kdpos
		$this->kdpos->AdvancedSearch->SearchValue = @$filter["x_kdpos"];
		$this->kdpos->AdvancedSearch->SearchOperator = @$filter["z_kdpos"];
		$this->kdpos->AdvancedSearch->SearchCondition = @$filter["v_kdpos"];
		$this->kdpos->AdvancedSearch->SearchValue2 = @$filter["y_kdpos"];
		$this->kdpos->AdvancedSearch->SearchOperator2 = @$filter["w_kdpos"];
		$this->kdpos->AdvancedSearch->save();

		// Field telpp
		$this->telpp->AdvancedSearch->SearchValue = @$filter["x_telpp"];
		$this->telpp->AdvancedSearch->SearchOperator = @$filter["z_telpp"];
		$this->telpp->AdvancedSearch->SearchCondition = @$filter["v_telpp"];
		$this->telpp->AdvancedSearch->SearchValue2 = @$filter["y_telpp"];
		$this->telpp->AdvancedSearch->SearchOperator2 = @$filter["w_telpp"];
		$this->telpp->AdvancedSearch->save();

		// Field faxp
		$this->faxp->AdvancedSearch->SearchValue = @$filter["x_faxp"];
		$this->faxp->AdvancedSearch->SearchOperator = @$filter["z_faxp"];
		$this->faxp->AdvancedSearch->SearchCondition = @$filter["v_faxp"];
		$this->faxp->AdvancedSearch->SearchValue2 = @$filter["y_faxp"];
		$this->faxp->AdvancedSearch->SearchOperator2 = @$filter["w_faxp"];
		$this->faxp->AdvancedSearch->save();

		// Field emailp
		$this->emailp->AdvancedSearch->SearchValue = @$filter["x_emailp"];
		$this->emailp->AdvancedSearch->SearchOperator = @$filter["z_emailp"];
		$this->emailp->AdvancedSearch->SearchCondition = @$filter["v_emailp"];
		$this->emailp->AdvancedSearch->SearchValue2 = @$filter["y_emailp"];
		$this->emailp->AdvancedSearch->SearchOperator2 = @$filter["w_emailp"];
		$this->emailp->AdvancedSearch->save();

		// Field webp
		$this->webp->AdvancedSearch->SearchValue = @$filter["x_webp"];
		$this->webp->AdvancedSearch->SearchOperator = @$filter["z_webp"];
		$this->webp->AdvancedSearch->SearchCondition = @$filter["v_webp"];
		$this->webp->AdvancedSearch->SearchValue2 = @$filter["y_webp"];
		$this->webp->AdvancedSearch->SearchOperator2 = @$filter["w_webp"];
		$this->webp->AdvancedSearch->save();

		// Field kdjenis
		$this->kdjenis->AdvancedSearch->SearchValue = @$filter["x_kdjenis"];
		$this->kdjenis->AdvancedSearch->SearchOperator = @$filter["z_kdjenis"];
		$this->kdjenis->AdvancedSearch->SearchCondition = @$filter["v_kdjenis"];
		$this->kdjenis->AdvancedSearch->SearchValue2 = @$filter["y_kdjenis"];
		$this->kdjenis->AdvancedSearch->SearchOperator2 = @$filter["w_kdjenis"];
		$this->kdjenis->AdvancedSearch->save();

		// Field kdproduknafed
		$this->kdproduknafed->AdvancedSearch->SearchValue = @$filter["x_kdproduknafed"];
		$this->kdproduknafed->AdvancedSearch->SearchOperator = @$filter["z_kdproduknafed"];
		$this->kdproduknafed->AdvancedSearch->SearchCondition = @$filter["v_kdproduknafed"];
		$this->kdproduknafed->AdvancedSearch->SearchValue2 = @$filter["y_kdproduknafed"];
		$this->kdproduknafed->AdvancedSearch->SearchOperator2 = @$filter["w_kdproduknafed"];
		$this->kdproduknafed->AdvancedSearch->save();

		// Field pproduk
		$this->pproduk->AdvancedSearch->SearchValue = @$filter["x_pproduk"];
		$this->pproduk->AdvancedSearch->SearchOperator = @$filter["z_pproduk"];
		$this->pproduk->AdvancedSearch->SearchCondition = @$filter["v_pproduk"];
		$this->pproduk->AdvancedSearch->SearchValue2 = @$filter["y_pproduk"];
		$this->pproduk->AdvancedSearch->SearchOperator2 = @$filter["w_pproduk"];
		$this->pproduk->AdvancedSearch->save();

		// Field kdexport
		$this->kdexport->AdvancedSearch->SearchValue = @$filter["x_kdexport"];
		$this->kdexport->AdvancedSearch->SearchOperator = @$filter["z_kdexport"];
		$this->kdexport->AdvancedSearch->SearchCondition = @$filter["v_kdexport"];
		$this->kdexport->AdvancedSearch->SearchValue2 = @$filter["y_kdexport"];
		$this->kdexport->AdvancedSearch->SearchOperator2 = @$filter["w_kdexport"];
		$this->kdexport->AdvancedSearch->save();

		// Field nexport
		$this->nexport->AdvancedSearch->SearchValue = @$filter["x_nexport"];
		$this->nexport->AdvancedSearch->SearchOperator = @$filter["z_nexport"];
		$this->nexport->AdvancedSearch->SearchCondition = @$filter["v_nexport"];
		$this->nexport->AdvancedSearch->SearchValue2 = @$filter["y_nexport"];
		$this->nexport->AdvancedSearch->SearchOperator2 = @$filter["w_nexport"];
		$this->nexport->AdvancedSearch->save();

		// Field kdskala
		$this->kdskala->AdvancedSearch->SearchValue = @$filter["x_kdskala"];
		$this->kdskala->AdvancedSearch->SearchOperator = @$filter["z_kdskala"];
		$this->kdskala->AdvancedSearch->SearchCondition = @$filter["v_kdskala"];
		$this->kdskala->AdvancedSearch->SearchValue2 = @$filter["y_kdskala"];
		$this->kdskala->AdvancedSearch->SearchOperator2 = @$filter["w_kdskala"];
		$this->kdskala->AdvancedSearch->save();

		// Field kdkategori
		$this->kdkategori->AdvancedSearch->SearchValue = @$filter["x_kdkategori"];
		$this->kdkategori->AdvancedSearch->SearchOperator = @$filter["z_kdkategori"];
		$this->kdkategori->AdvancedSearch->SearchCondition = @$filter["v_kdkategori"];
		$this->kdkategori->AdvancedSearch->SearchValue2 = @$filter["y_kdkategori"];
		$this->kdkategori->AdvancedSearch->SearchOperator2 = @$filter["w_kdkategori"];
		$this->kdkategori->AdvancedSearch->save();

		// Field omzet_saat_ini
		$this->omzet_saat_ini->AdvancedSearch->SearchValue = @$filter["x_omzet_saat_ini"];
		$this->omzet_saat_ini->AdvancedSearch->SearchOperator = @$filter["z_omzet_saat_ini"];
		$this->omzet_saat_ini->AdvancedSearch->SearchCondition = @$filter["v_omzet_saat_ini"];
		$this->omzet_saat_ini->AdvancedSearch->SearchValue2 = @$filter["y_omzet_saat_ini"];
		$this->omzet_saat_ini->AdvancedSearch->SearchOperator2 = @$filter["w_omzet_saat_ini"];
		$this->omzet_saat_ini->AdvancedSearch->save();

		// Field kapasitas_saat_ini
		$this->kapasitas_saat_ini->AdvancedSearch->SearchValue = @$filter["x_kapasitas_saat_ini"];
		$this->kapasitas_saat_ini->AdvancedSearch->SearchOperator = @$filter["z_kapasitas_saat_ini"];
		$this->kapasitas_saat_ini->AdvancedSearch->SearchCondition = @$filter["v_kapasitas_saat_ini"];
		$this->kapasitas_saat_ini->AdvancedSearch->SearchValue2 = @$filter["y_kapasitas_saat_ini"];
		$this->kapasitas_saat_ini->AdvancedSearch->SearchOperator2 = @$filter["w_kapasitas_saat_ini"];
		$this->kapasitas_saat_ini->AdvancedSearch->save();

		// Field kapasitas_stl_1thn
		$this->kapasitas_stl_1thn->AdvancedSearch->SearchValue = @$filter["x_kapasitas_stl_1thn"];
		$this->kapasitas_stl_1thn->AdvancedSearch->SearchOperator = @$filter["z_kapasitas_stl_1thn"];
		$this->kapasitas_stl_1thn->AdvancedSearch->SearchCondition = @$filter["v_kapasitas_stl_1thn"];
		$this->kapasitas_stl_1thn->AdvancedSearch->SearchValue2 = @$filter["y_kapasitas_stl_1thn"];
		$this->kapasitas_stl_1thn->AdvancedSearch->SearchOperator2 = @$filter["w_kapasitas_stl_1thn"];
		$this->kapasitas_stl_1thn->AdvancedSearch->save();

		// Field kapasitas_stl_2thn
		$this->kapasitas_stl_2thn->AdvancedSearch->SearchValue = @$filter["x_kapasitas_stl_2thn"];
		$this->kapasitas_stl_2thn->AdvancedSearch->SearchOperator = @$filter["z_kapasitas_stl_2thn"];
		$this->kapasitas_stl_2thn->AdvancedSearch->SearchCondition = @$filter["v_kapasitas_stl_2thn"];
		$this->kapasitas_stl_2thn->AdvancedSearch->SearchValue2 = @$filter["y_kapasitas_stl_2thn"];
		$this->kapasitas_stl_2thn->AdvancedSearch->SearchOperator2 = @$filter["w_kapasitas_stl_2thn"];
		$this->kapasitas_stl_2thn->AdvancedSearch->save();

		// Field jpeserta
		$this->jpeserta->AdvancedSearch->SearchValue = @$filter["x_jpeserta"];
		$this->jpeserta->AdvancedSearch->SearchOperator = @$filter["z_jpeserta"];
		$this->jpeserta->AdvancedSearch->SearchCondition = @$filter["v_jpeserta"];
		$this->jpeserta->AdvancedSearch->SearchValue2 = @$filter["y_jpeserta"];
		$this->jpeserta->AdvancedSearch->SearchOperator2 = @$filter["w_jpeserta"];
		$this->jpeserta->AdvancedSearch->save();
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->namap, $default, FALSE); // namap
		$this->buildSearchSql($where, $this->idp, $default, FALSE); // idp
		$this->buildSearchSql($where, $this->kontak, $default, FALSE); // kontak
		$this->buildSearchSql($where, $this->kdlokasi, $default, FALSE); // kdlokasi
		$this->buildSearchSql($where, $this->kdprop, $default, FALSE); // kdprop
		$this->buildSearchSql($where, $this->kdkota, $default, FALSE); // kdkota
		$this->buildSearchSql($where, $this->kdkec, $default, FALSE); // kdkec
		$this->buildSearchSql($where, $this->alamatp, $default, FALSE); // alamatp
		$this->buildSearchSql($where, $this->kdpos, $default, FALSE); // kdpos
		$this->buildSearchSql($where, $this->telpp, $default, FALSE); // telpp
		$this->buildSearchSql($where, $this->faxp, $default, FALSE); // faxp
		$this->buildSearchSql($where, $this->emailp, $default, FALSE); // emailp
		$this->buildSearchSql($where, $this->webp, $default, FALSE); // webp
		$this->buildSearchSql($where, $this->kdjenis, $default, FALSE); // kdjenis
		$this->buildSearchSql($where, $this->kdproduknafed, $default, FALSE); // kdproduknafed
		$this->buildSearchSql($where, $this->pproduk, $default, FALSE); // pproduk
		$this->buildSearchSql($where, $this->kdexport, $default, FALSE); // kdexport
		$this->buildSearchSql($where, $this->nexport, $default, FALSE); // nexport
		$this->buildSearchSql($where, $this->kdskala, $default, FALSE); // kdskala
		$this->buildSearchSql($where, $this->kdkategori, $default, FALSE); // kdkategori
		$this->buildSearchSql($where, $this->omzet_saat_ini, $default, FALSE); // omzet_saat_ini
		$this->buildSearchSql($where, $this->kapasitas_saat_ini, $default, FALSE); // kapasitas_saat_ini
		$this->buildSearchSql($where, $this->kapasitas_stl_1thn, $default, FALSE); // kapasitas_stl_1thn
		$this->buildSearchSql($where, $this->kapasitas_stl_2thn, $default, FALSE); // kapasitas_stl_2thn
		$this->buildSearchSql($where, $this->jpeserta, $default, FALSE); // jpeserta

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->namap->AdvancedSearch->save(); // namap
			$this->idp->AdvancedSearch->save(); // idp
			$this->kontak->AdvancedSearch->save(); // kontak
			$this->kdlokasi->AdvancedSearch->save(); // kdlokasi
			$this->kdprop->AdvancedSearch->save(); // kdprop
			$this->kdkota->AdvancedSearch->save(); // kdkota
			$this->kdkec->AdvancedSearch->save(); // kdkec
			$this->alamatp->AdvancedSearch->save(); // alamatp
			$this->kdpos->AdvancedSearch->save(); // kdpos
			$this->telpp->AdvancedSearch->save(); // telpp
			$this->faxp->AdvancedSearch->save(); // faxp
			$this->emailp->AdvancedSearch->save(); // emailp
			$this->webp->AdvancedSearch->save(); // webp
			$this->kdjenis->AdvancedSearch->save(); // kdjenis
			$this->kdproduknafed->AdvancedSearch->save(); // kdproduknafed
			$this->pproduk->AdvancedSearch->save(); // pproduk
			$this->kdexport->AdvancedSearch->save(); // kdexport
			$this->nexport->AdvancedSearch->save(); // nexport
			$this->kdskala->AdvancedSearch->save(); // kdskala
			$this->kdkategori->AdvancedSearch->save(); // kdkategori
			$this->omzet_saat_ini->AdvancedSearch->save(); // omzet_saat_ini
			$this->kapasitas_saat_ini->AdvancedSearch->save(); // kapasitas_saat_ini
			$this->kapasitas_stl_1thn->AdvancedSearch->save(); // kapasitas_stl_1thn
			$this->kapasitas_stl_2thn->AdvancedSearch->save(); // kapasitas_stl_2thn
			$this->jpeserta->AdvancedSearch->save(); // jpeserta
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
		if ($this->namap->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->idp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kontak->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdlokasi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdprop->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkota->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkec->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->alamatp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdpos->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->telpp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->faxp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->emailp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->webp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdjenis->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdproduknafed->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->pproduk->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdexport->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nexport->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdskala->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkategori->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->omzet_saat_ini->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kapasitas_saat_ini->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kapasitas_stl_1thn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kapasitas_stl_2thn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jpeserta->AdvancedSearch->issetSession())
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
		$this->namap->AdvancedSearch->unsetSession();
		$this->idp->AdvancedSearch->unsetSession();
		$this->kontak->AdvancedSearch->unsetSession();
		$this->kdlokasi->AdvancedSearch->unsetSession();
		$this->kdprop->AdvancedSearch->unsetSession();
		$this->kdkota->AdvancedSearch->unsetSession();
		$this->kdkec->AdvancedSearch->unsetSession();
		$this->alamatp->AdvancedSearch->unsetSession();
		$this->kdpos->AdvancedSearch->unsetSession();
		$this->telpp->AdvancedSearch->unsetSession();
		$this->faxp->AdvancedSearch->unsetSession();
		$this->emailp->AdvancedSearch->unsetSession();
		$this->webp->AdvancedSearch->unsetSession();
		$this->kdjenis->AdvancedSearch->unsetSession();
		$this->kdproduknafed->AdvancedSearch->unsetSession();
		$this->pproduk->AdvancedSearch->unsetSession();
		$this->kdexport->AdvancedSearch->unsetSession();
		$this->nexport->AdvancedSearch->unsetSession();
		$this->kdskala->AdvancedSearch->unsetSession();
		$this->kdkategori->AdvancedSearch->unsetSession();
		$this->omzet_saat_ini->AdvancedSearch->unsetSession();
		$this->kapasitas_saat_ini->AdvancedSearch->unsetSession();
		$this->kapasitas_stl_1thn->AdvancedSearch->unsetSession();
		$this->kapasitas_stl_2thn->AdvancedSearch->unsetSession();
		$this->jpeserta->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->namap->AdvancedSearch->load();
		$this->idp->AdvancedSearch->load();
		$this->kontak->AdvancedSearch->load();
		$this->kdlokasi->AdvancedSearch->load();
		$this->kdprop->AdvancedSearch->load();
		$this->kdkota->AdvancedSearch->load();
		$this->kdkec->AdvancedSearch->load();
		$this->alamatp->AdvancedSearch->load();
		$this->kdpos->AdvancedSearch->load();
		$this->telpp->AdvancedSearch->load();
		$this->faxp->AdvancedSearch->load();
		$this->emailp->AdvancedSearch->load();
		$this->webp->AdvancedSearch->load();
		$this->kdjenis->AdvancedSearch->load();
		$this->kdproduknafed->AdvancedSearch->load();
		$this->pproduk->AdvancedSearch->load();
		$this->kdexport->AdvancedSearch->load();
		$this->nexport->AdvancedSearch->load();
		$this->kdskala->AdvancedSearch->load();
		$this->kdkategori->AdvancedSearch->load();
		$this->omzet_saat_ini->AdvancedSearch->load();
		$this->kapasitas_saat_ini->AdvancedSearch->load();
		$this->kapasitas_stl_1thn->AdvancedSearch->load();
		$this->kapasitas_stl_2thn->AdvancedSearch->load();
		$this->jpeserta->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->namap); // namap
			$this->updateSort($this->idp); // idp
			$this->updateSort($this->kontak); // kontak
			$this->updateSort($this->kdlokasi); // kdlokasi
			$this->updateSort($this->kdprop); // kdprop
			$this->updateSort($this->kdkota); // kdkota
			$this->updateSort($this->kdkec); // kdkec
			$this->updateSort($this->alamatp); // alamatp
			$this->updateSort($this->telpp); // telpp
			$this->updateSort($this->faxp); // faxp
			$this->updateSort($this->emailp); // emailp
			$this->updateSort($this->webp); // webp
			$this->updateSort($this->medsos); // medsos
			$this->updateSort($this->kdjenis); // kdjenis
			$this->updateSort($this->kdproduknafed); // kdproduknafed
			$this->updateSort($this->kdproduknafed2); // kdproduknafed2
			$this->updateSort($this->kdproduknafed3); // kdproduknafed3
			$this->updateSort($this->pproduk); // pproduk
			$this->updateSort($this->kdexport); // kdexport
			$this->updateSort($this->nexport); // nexport
			$this->updateSort($this->kdskala); // kdskala
			$this->updateSort($this->kdkategori); // kdkategori
			$this->updateSort($this->jpeserta); // jpeserta
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
				$this->namap->setSort("ASC");
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
				$this->namap->setSort("");
				$this->idp->setSort("");
				$this->kontak->setSort("");
				$this->kdlokasi->setSort("");
				$this->kdprop->setSort("");
				$this->kdkota->setSort("");
				$this->kdkec->setSort("");
				$this->alamatp->setSort("");
				$this->telpp->setSort("");
				$this->faxp->setSort("");
				$this->emailp->setSort("");
				$this->webp->setSort("");
				$this->medsos->setSort("");
				$this->kdjenis->setSort("");
				$this->kdproduknafed->setSort("");
				$this->kdproduknafed2->setSort("");
				$this->kdproduknafed3->setSort("");
				$this->pproduk->setSort("");
				$this->kdexport->setSort("");
				$this->nexport->setSort("");
				$this->kdskala->setSort("");
				$this->kdkategori->setSort("");
				$this->jpeserta->setSort("");
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

		// "detail_t_peserta"
		$item = &$this->ListOptions->add("detail_t_peserta");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_peserta') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_peserta_grid"]))
			$GLOBALS["t_peserta_grid"] = new t_peserta_grid();

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
		$pages->add("t_peserta");
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
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_t_peserta"
		$opt = $this->ListOptions["detail_t_peserta"];
		if ($Security->allowList(CurrentProjectID() . 't_peserta')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_peserta", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->t_peserta_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_pesertalist.php?" . Config("TABLE_SHOW_MASTER") . "=t_perusahaan&fk_idp=" . urlencode(strval($this->idp->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_peserta_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_perusahaan')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_peserta");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_peserta";
			}
			if ($GLOBALS["t_peserta_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_perusahaan')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_peserta");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_peserta";
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->idp->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item = &$option->add("detailadd_t_peserta");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_peserta");
		if (!isset($GLOBALS["t_peserta"]))
			$GLOBALS["t_peserta"] = new t_peserta();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_peserta"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_peserta"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_perusahaan') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_peserta";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ft_perusahaanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ft_perusahaanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.ft_perusahaanlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// namap
		if (!$this->isAddOrEdit() && $this->namap->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->namap->AdvancedSearch->SearchValue != "" || $this->namap->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// idp
		if (!$this->isAddOrEdit() && $this->idp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->idp->AdvancedSearch->SearchValue != "" || $this->idp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kontak
		if (!$this->isAddOrEdit() && $this->kontak->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kontak->AdvancedSearch->SearchValue != "" || $this->kontak->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdlokasi
		if (!$this->isAddOrEdit() && $this->kdlokasi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdlokasi->AdvancedSearch->SearchValue != "" || $this->kdlokasi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdprop
		if (!$this->isAddOrEdit() && $this->kdprop->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdprop->AdvancedSearch->SearchValue != "" || $this->kdprop->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdkota
		if (!$this->isAddOrEdit() && $this->kdkota->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdkota->AdvancedSearch->SearchValue != "" || $this->kdkota->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdkec
		if (!$this->isAddOrEdit() && $this->kdkec->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdkec->AdvancedSearch->SearchValue != "" || $this->kdkec->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// alamatp
		if (!$this->isAddOrEdit() && $this->alamatp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->alamatp->AdvancedSearch->SearchValue != "" || $this->alamatp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdpos
		if (!$this->isAddOrEdit() && $this->kdpos->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdpos->AdvancedSearch->SearchValue != "" || $this->kdpos->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// telpp
		if (!$this->isAddOrEdit() && $this->telpp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->telpp->AdvancedSearch->SearchValue != "" || $this->telpp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// faxp
		if (!$this->isAddOrEdit() && $this->faxp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->faxp->AdvancedSearch->SearchValue != "" || $this->faxp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// emailp
		if (!$this->isAddOrEdit() && $this->emailp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->emailp->AdvancedSearch->SearchValue != "" || $this->emailp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// webp
		if (!$this->isAddOrEdit() && $this->webp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->webp->AdvancedSearch->SearchValue != "" || $this->webp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdjenis
		if (!$this->isAddOrEdit() && $this->kdjenis->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdjenis->AdvancedSearch->SearchValue != "" || $this->kdjenis->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdproduknafed
		if (!$this->isAddOrEdit() && $this->kdproduknafed->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdproduknafed->AdvancedSearch->SearchValue != "" || $this->kdproduknafed->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// pproduk
		if (!$this->isAddOrEdit() && $this->pproduk->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->pproduk->AdvancedSearch->SearchValue != "" || $this->pproduk->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdexport
		if (!$this->isAddOrEdit() && $this->kdexport->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdexport->AdvancedSearch->SearchValue != "" || $this->kdexport->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nexport
		if (!$this->isAddOrEdit() && $this->nexport->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nexport->AdvancedSearch->SearchValue != "" || $this->nexport->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdskala
		if (!$this->isAddOrEdit() && $this->kdskala->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdskala->AdvancedSearch->SearchValue != "" || $this->kdskala->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdkategori
		if (!$this->isAddOrEdit() && $this->kdkategori->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdkategori->AdvancedSearch->SearchValue != "" || $this->kdkategori->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// omzet_saat_ini
		if (!$this->isAddOrEdit() && $this->omzet_saat_ini->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->omzet_saat_ini->AdvancedSearch->SearchValue != "" || $this->omzet_saat_ini->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kapasitas_saat_ini
		if (!$this->isAddOrEdit() && $this->kapasitas_saat_ini->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kapasitas_saat_ini->AdvancedSearch->SearchValue != "" || $this->kapasitas_saat_ini->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kapasitas_stl_1thn
		if (!$this->isAddOrEdit() && $this->kapasitas_stl_1thn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kapasitas_stl_1thn->AdvancedSearch->SearchValue != "" || $this->kapasitas_stl_1thn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kapasitas_stl_2thn
		if (!$this->isAddOrEdit() && $this->kapasitas_stl_2thn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kapasitas_stl_2thn->AdvancedSearch->SearchValue != "" || $this->kapasitas_stl_2thn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jpeserta
		if (!$this->isAddOrEdit() && $this->jpeserta->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jpeserta->AdvancedSearch->SearchValue != "" || $this->jpeserta->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->namap->setDbValue($row['namap']);
		$this->idp->setDbValue($row['idp']);
		$this->kontak->setDbValue($row['kontak']);
		$this->kdlokasi->setDbValue($row['kdlokasi']);
		$this->kdprop->setDbValue($row['kdprop']);
		$this->kdkota->setDbValue($row['kdkota']);
		$this->kdkec->setDbValue($row['kdkec']);
		if (array_key_exists('EV__kdkec', $rs->fields)) {
			$this->kdkec->VirtualValue = $rs->fields('EV__kdkec'); // Set up virtual field value
		} else {
			$this->kdkec->VirtualValue = ""; // Clear value
		}
		$this->alamatp->setDbValue($row['alamatp']);
		$this->kdpos->setDbValue($row['kdpos']);
		$this->telpp->setDbValue($row['telpp']);
		$this->faxp->setDbValue($row['faxp']);
		$this->emailp->setDbValue($row['emailp']);
		$this->webp->setDbValue($row['webp']);
		$this->medsos->setDbValue($row['medsos']);
		$this->kdjenis->setDbValue($row['kdjenis']);
		$this->kdproduknafed->setDbValue($row['kdproduknafed']);
		$this->kdproduknafed2->setDbValue($row['kdproduknafed2']);
		$this->kdproduknafed3->setDbValue($row['kdproduknafed3']);
		$this->pproduk->setDbValue($row['pproduk']);
		$this->kdexport->setDbValue($row['kdexport']);
		$this->nexport->setDbValue($row['nexport']);
		$this->kdskala->setDbValue($row['kdskala']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->omzet_saat_ini->setDbValue($row['omzet_saat_ini']);
		$this->omzet_stl_6bln->setDbValue($row['omzet_stl_6bln']);
		$this->omzet_stl_1thn->setDbValue($row['omzet_stl_1thn']);
		$this->omzet_stl_2thn->setDbValue($row['omzet_stl_2thn']);
		$this->kapasitas_saat_ini->setDbValue($row['kapasitas_saat_ini']);
		$this->kapasitas_stl_6bln->setDbValue($row['kapasitas_stl_6bln']);
		$this->kapasitas_stl_1thn->setDbValue($row['kapasitas_stl_1thn']);
		$this->kapasitas_stl_2thn->setDbValue($row['kapasitas_stl_2thn']);
		$this->created_at->setDbValue($row['created_at']);
		$this->user_created_by->setDbValue($row['user_created_by']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->user_updated_by->setDbValue($row['user_updated_by']);
		$this->jpeserta->setDbValue($row['jpeserta']);
		if (!isset($GLOBALS["t_peserta_grid"]))
			$GLOBALS["t_peserta_grid"] = new t_peserta_grid();
		$detailFilter = $GLOBALS["t_peserta"]->sqlDetailFilter_t_perusahaan();
		$detailFilter = str_replace("@idp@", AdjustSql($this->idp->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_peserta"]->setCurrentMasterTable("t_perusahaan");
		$detailFilter = $GLOBALS["t_peserta"]->applyUserIDFilters($detailFilter);
		$this->t_peserta_Count = $GLOBALS["t_peserta"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['namap'] = NULL;
		$row['idp'] = NULL;
		$row['kontak'] = NULL;
		$row['kdlokasi'] = NULL;
		$row['kdprop'] = NULL;
		$row['kdkota'] = NULL;
		$row['kdkec'] = NULL;
		$row['alamatp'] = NULL;
		$row['kdpos'] = NULL;
		$row['telpp'] = NULL;
		$row['faxp'] = NULL;
		$row['emailp'] = NULL;
		$row['webp'] = NULL;
		$row['medsos'] = NULL;
		$row['kdjenis'] = NULL;
		$row['kdproduknafed'] = NULL;
		$row['kdproduknafed2'] = NULL;
		$row['kdproduknafed3'] = NULL;
		$row['pproduk'] = NULL;
		$row['kdexport'] = NULL;
		$row['nexport'] = NULL;
		$row['kdskala'] = NULL;
		$row['kdkategori'] = NULL;
		$row['omzet_saat_ini'] = NULL;
		$row['omzet_stl_6bln'] = NULL;
		$row['omzet_stl_1thn'] = NULL;
		$row['omzet_stl_2thn'] = NULL;
		$row['kapasitas_saat_ini'] = NULL;
		$row['kapasitas_stl_6bln'] = NULL;
		$row['kapasitas_stl_1thn'] = NULL;
		$row['kapasitas_stl_2thn'] = NULL;
		$row['created_at'] = NULL;
		$row['user_created_by'] = NULL;
		$row['updated_at'] = NULL;
		$row['user_updated_by'] = NULL;
		$row['jpeserta'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idp")) != "")
			$this->idp->OldValue = $this->getKey("idp"); // idp
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
		// namap
		// idp
		// kontak
		// kdlokasi
		// kdprop
		// kdkota
		// kdkec
		// alamatp
		// kdpos
		// telpp
		// faxp
		// emailp
		// webp
		// medsos
		// kdjenis
		// kdproduknafed
		// kdproduknafed2
		// kdproduknafed3
		// pproduk
		// kdexport
		// nexport
		// kdskala
		// kdkategori
		// omzet_saat_ini
		// omzet_stl_6bln
		// omzet_stl_1thn
		// omzet_stl_2thn
		// kapasitas_saat_ini
		// kapasitas_stl_6bln
		// kapasitas_stl_1thn
		// kapasitas_stl_2thn
		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jpeserta

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// namap
			$this->namap->ViewValue = $this->namap->CurrentValue;
			$this->namap->ViewCustomAttributes = "";

			// idp
			$this->idp->ViewValue = $this->idp->CurrentValue;
			$arwrk = [];
			$arwrk[1] = $this->namap->CurrentValue;
			$this->idp->ViewValue = $this->idp->displayValue($arwrk);
			$this->idp->ViewCustomAttributes = "";

			// kontak
			$this->kontak->ViewValue = $this->kontak->CurrentValue;
			$this->kontak->ViewCustomAttributes = "";

			// kdlokasi
			$curVal = strval($this->kdlokasi->CurrentValue);
			if ($curVal != "") {
				$this->kdlokasi->ViewValue = $this->kdlokasi->lookupCacheOption($curVal);
				if ($this->kdlokasi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdlokasi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdlokasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdlokasi->ViewValue = $this->kdlokasi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdlokasi->ViewValue = $this->kdlokasi->CurrentValue;
					}
				}
			} else {
				$this->kdlokasi->ViewValue = NULL;
			}
			$this->kdlokasi->ViewCustomAttributes = "";

			// kdprop
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
			$this->kdprop->ViewCustomAttributes = "";

			// kdkota
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

			// alamatp
			$this->alamatp->ViewValue = $this->alamatp->CurrentValue;
			$this->alamatp->ViewCustomAttributes = "";

			// kdpos
			$this->kdpos->ViewValue = $this->kdpos->CurrentValue;
			$this->kdpos->ViewCustomAttributes = "";

			// telpp
			$this->telpp->ViewValue = $this->telpp->CurrentValue;
			$this->telpp->ViewCustomAttributes = "";

			// faxp
			$this->faxp->ViewValue = $this->faxp->CurrentValue;
			$this->faxp->ViewCustomAttributes = "";

			// emailp
			$this->emailp->ViewValue = $this->emailp->CurrentValue;
			$this->emailp->ViewCustomAttributes = "";

			// webp
			$this->webp->ViewValue = $this->webp->CurrentValue;
			$this->webp->ViewCustomAttributes = "";

			// medsos
			$this->medsos->ViewValue = $this->medsos->CurrentValue;
			$this->medsos->ViewCustomAttributes = "";

			// kdjenis
			$curVal = strval($this->kdjenis->CurrentValue);
			if ($curVal != "") {
				$this->kdjenis->ViewValue = $this->kdjenis->lookupCacheOption($curVal);
				if ($this->kdjenis->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdjenis`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdjenis->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdjenis->ViewValue = $this->kdjenis->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdjenis->ViewValue = $this->kdjenis->CurrentValue;
					}
				}
			} else {
				$this->kdjenis->ViewValue = NULL;
			}
			$this->kdjenis->ViewCustomAttributes = "";

			// kdproduknafed
			$curVal = strval($this->kdproduknafed->CurrentValue);
			if ($curVal != "") {
				$this->kdproduknafed->ViewValue = $this->kdproduknafed->lookupCacheOption($curVal);
				if ($this->kdproduknafed->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdproduknafed->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdproduknafed->ViewValue = $this->kdproduknafed->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdproduknafed->ViewValue = $this->kdproduknafed->CurrentValue;
					}
				}
			} else {
				$this->kdproduknafed->ViewValue = NULL;
			}
			$this->kdproduknafed->ViewCustomAttributes = "";

			// kdproduknafed2
			$curVal = strval($this->kdproduknafed2->CurrentValue);
			if ($curVal != "") {
				$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->lookupCacheOption($curVal);
				if ($this->kdproduknafed2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdproduknafed2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->CurrentValue;
					}
				}
			} else {
				$this->kdproduknafed2->ViewValue = NULL;
			}
			$this->kdproduknafed2->ViewCustomAttributes = "";

			// kdproduknafed3
			$curVal = strval($this->kdproduknafed3->CurrentValue);
			if ($curVal != "") {
				$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->lookupCacheOption($curVal);
				if ($this->kdproduknafed3->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdproduknafed3->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->CurrentValue;
					}
				}
			} else {
				$this->kdproduknafed3->ViewValue = NULL;
			}
			$this->kdproduknafed3->ViewCustomAttributes = "";

			// pproduk
			$this->pproduk->ViewValue = $this->pproduk->CurrentValue;
			$this->pproduk->ViewCustomAttributes = "";

			// kdexport
			$curVal = strval($this->kdexport->CurrentValue);
			if ($curVal != "") {
				$this->kdexport->ViewValue = $this->kdexport->lookupCacheOption($curVal);
				if ($this->kdexport->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdexport`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdexport->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdexport->ViewValue = $this->kdexport->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdexport->ViewValue = $this->kdexport->CurrentValue;
					}
				}
			} else {
				$this->kdexport->ViewValue = NULL;
			}
			$this->kdexport->ViewCustomAttributes = "";

			// nexport
			$this->nexport->ViewValue = $this->nexport->CurrentValue;
			$this->nexport->ViewCustomAttributes = "";

			// kdskala
			$curVal = strval($this->kdskala->CurrentValue);
			if ($curVal != "") {
				$this->kdskala->ViewValue = $this->kdskala->lookupCacheOption($curVal);
				if ($this->kdskala->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdskala`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdskala->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdskala->ViewValue = $this->kdskala->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdskala->ViewValue = $this->kdskala->CurrentValue;
					}
				}
			} else {
				$this->kdskala->ViewValue = NULL;
			}
			$this->kdskala->ViewCustomAttributes = "";

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

			// omzet_saat_ini
			$this->omzet_saat_ini->ViewValue = $this->omzet_saat_ini->CurrentValue;
			$this->omzet_saat_ini->ViewCustomAttributes = "";

			// omzet_stl_6bln
			$this->omzet_stl_6bln->ViewValue = $this->omzet_stl_6bln->CurrentValue;
			$this->omzet_stl_6bln->ViewCustomAttributes = "";

			// omzet_stl_1thn
			$this->omzet_stl_1thn->ViewValue = $this->omzet_stl_1thn->CurrentValue;
			$this->omzet_stl_1thn->ViewCustomAttributes = "";

			// omzet_stl_2thn
			$this->omzet_stl_2thn->ViewValue = $this->omzet_stl_2thn->CurrentValue;
			$this->omzet_stl_2thn->ViewCustomAttributes = "";

			// kapasitas_saat_ini
			$this->kapasitas_saat_ini->ViewValue = $this->kapasitas_saat_ini->CurrentValue;
			$this->kapasitas_saat_ini->ViewCustomAttributes = "";

			// kapasitas_stl_6bln
			$this->kapasitas_stl_6bln->ViewValue = $this->kapasitas_stl_6bln->CurrentValue;
			$this->kapasitas_stl_6bln->ViewCustomAttributes = "";

			// kapasitas_stl_1thn
			$this->kapasitas_stl_1thn->ViewValue = $this->kapasitas_stl_1thn->CurrentValue;
			$this->kapasitas_stl_1thn->ViewCustomAttributes = "";

			// kapasitas_stl_2thn
			$this->kapasitas_stl_2thn->ViewValue = $this->kapasitas_stl_2thn->CurrentValue;
			$this->kapasitas_stl_2thn->ViewCustomAttributes = "";

			// jpeserta
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->ViewCustomAttributes = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";
			$this->namap->TooltipValue = "";
			if (!$this->isExport())
				$this->namap->ViewValue = $this->highlightValue($this->namap);

			// idp
			$this->idp->LinkCustomAttributes = "";
			$this->idp->HrefValue = "";
			$this->idp->TooltipValue = "";
			if (!$this->isExport())
				$this->idp->ViewValue = $this->highlightValue($this->idp);

			// kontak
			$this->kontak->LinkCustomAttributes = "";
			$this->kontak->HrefValue = "";
			$this->kontak->TooltipValue = "";
			if (!$this->isExport())
				$this->kontak->ViewValue = $this->highlightValue($this->kontak);

			// kdlokasi
			$this->kdlokasi->LinkCustomAttributes = "";
			$this->kdlokasi->HrefValue = "";
			$this->kdlokasi->TooltipValue = "";

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

			// alamatp
			$this->alamatp->LinkCustomAttributes = "";
			$this->alamatp->HrefValue = "";
			$this->alamatp->TooltipValue = "";
			if (!$this->isExport())
				$this->alamatp->ViewValue = $this->highlightValue($this->alamatp);

			// telpp
			$this->telpp->LinkCustomAttributes = "";
			$this->telpp->HrefValue = "";
			$this->telpp->TooltipValue = "";
			if (!$this->isExport())
				$this->telpp->ViewValue = $this->highlightValue($this->telpp);

			// faxp
			$this->faxp->LinkCustomAttributes = "";
			$this->faxp->HrefValue = "";
			$this->faxp->TooltipValue = "";
			if (!$this->isExport())
				$this->faxp->ViewValue = $this->highlightValue($this->faxp);

			// emailp
			$this->emailp->LinkCustomAttributes = "";
			$this->emailp->HrefValue = "";
			$this->emailp->TooltipValue = "";
			if (!$this->isExport())
				$this->emailp->ViewValue = $this->highlightValue($this->emailp);

			// webp
			$this->webp->LinkCustomAttributes = "";
			$this->webp->HrefValue = "";
			$this->webp->TooltipValue = "";
			if (!$this->isExport())
				$this->webp->ViewValue = $this->highlightValue($this->webp);

			// medsos
			$this->medsos->LinkCustomAttributes = "";
			$this->medsos->HrefValue = "";
			$this->medsos->TooltipValue = "";

			// kdjenis
			$this->kdjenis->LinkCustomAttributes = "";
			$this->kdjenis->HrefValue = "";
			$this->kdjenis->TooltipValue = "";

			// kdproduknafed
			$this->kdproduknafed->LinkCustomAttributes = "";
			$this->kdproduknafed->HrefValue = "";
			$this->kdproduknafed->TooltipValue = "";

			// kdproduknafed2
			$this->kdproduknafed2->LinkCustomAttributes = "";
			$this->kdproduknafed2->HrefValue = "";
			$this->kdproduknafed2->TooltipValue = "";

			// kdproduknafed3
			$this->kdproduknafed3->LinkCustomAttributes = "";
			$this->kdproduknafed3->HrefValue = "";
			$this->kdproduknafed3->TooltipValue = "";

			// pproduk
			$this->pproduk->LinkCustomAttributes = "";
			$this->pproduk->HrefValue = "";
			$this->pproduk->TooltipValue = "";
			if (!$this->isExport())
				$this->pproduk->ViewValue = $this->highlightValue($this->pproduk);

			// kdexport
			$this->kdexport->LinkCustomAttributes = "";
			$this->kdexport->HrefValue = "";
			$this->kdexport->TooltipValue = "";

			// nexport
			$this->nexport->LinkCustomAttributes = "";
			$this->nexport->HrefValue = "";
			$this->nexport->TooltipValue = "";
			if (!$this->isExport())
				$this->nexport->ViewValue = $this->highlightValue($this->nexport);

			// kdskala
			$this->kdskala->LinkCustomAttributes = "";
			$this->kdskala->HrefValue = "";
			$this->kdskala->TooltipValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";
			$this->kdkategori->TooltipValue = "";

			// jpeserta
			$this->jpeserta->LinkCustomAttributes = "";
			$this->jpeserta->HrefValue = "";
			$this->jpeserta->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// namap
			$this->namap->EditAttrs["class"] = "form-control";
			$this->namap->EditCustomAttributes = "";
			if (!$this->namap->Raw)
				$this->namap->AdvancedSearch->SearchValue = HtmlDecode($this->namap->AdvancedSearch->SearchValue);
			$this->namap->EditValue = HtmlEncode($this->namap->AdvancedSearch->SearchValue);
			$this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

			// idp
			$this->idp->EditAttrs["class"] = "form-control";
			$this->idp->EditCustomAttributes = "";
			$this->idp->EditValue = HtmlEncode($this->idp->AdvancedSearch->SearchValue);
			$arwrk = [];
			$arwrk[1] = HtmlEncode($this->namap->CurrentValue);
			$this->idp->EditValue = $this->idp->displayValue($arwrk);
			$this->idp->PlaceHolder = RemoveHtml($this->idp->caption());

			// kontak
			$this->kontak->EditAttrs["class"] = "form-control";
			$this->kontak->EditCustomAttributes = "";
			if (!$this->kontak->Raw)
				$this->kontak->AdvancedSearch->SearchValue = HtmlDecode($this->kontak->AdvancedSearch->SearchValue);
			$this->kontak->EditValue = HtmlEncode($this->kontak->AdvancedSearch->SearchValue);
			$this->kontak->PlaceHolder = RemoveHtml($this->kontak->caption());

			// kdlokasi
			$this->kdlokasi->EditAttrs["class"] = "form-control";
			$this->kdlokasi->EditCustomAttributes = "";

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";

			// kdkota
			$this->kdkota->EditAttrs["class"] = "form-control";
			$this->kdkota->EditCustomAttributes = "";

			// kdkec
			$this->kdkec->EditAttrs["class"] = "form-control";
			$this->kdkec->EditCustomAttributes = "";

			// alamatp
			$this->alamatp->EditAttrs["class"] = "form-control";
			$this->alamatp->EditCustomAttributes = "";
			$this->alamatp->EditValue = HtmlEncode($this->alamatp->AdvancedSearch->SearchValue);
			$this->alamatp->PlaceHolder = RemoveHtml($this->alamatp->caption());

			// telpp
			$this->telpp->EditAttrs["class"] = "form-control";
			$this->telpp->EditCustomAttributes = "";
			if (!$this->telpp->Raw)
				$this->telpp->AdvancedSearch->SearchValue = HtmlDecode($this->telpp->AdvancedSearch->SearchValue);
			$this->telpp->EditValue = HtmlEncode($this->telpp->AdvancedSearch->SearchValue);
			$this->telpp->PlaceHolder = RemoveHtml($this->telpp->caption());

			// faxp
			$this->faxp->EditAttrs["class"] = "form-control";
			$this->faxp->EditCustomAttributes = "";
			if (!$this->faxp->Raw)
				$this->faxp->AdvancedSearch->SearchValue = HtmlDecode($this->faxp->AdvancedSearch->SearchValue);
			$this->faxp->EditValue = HtmlEncode($this->faxp->AdvancedSearch->SearchValue);
			$this->faxp->PlaceHolder = RemoveHtml($this->faxp->caption());

			// emailp
			$this->emailp->EditAttrs["class"] = "form-control";
			$this->emailp->EditCustomAttributes = "";
			if (!$this->emailp->Raw)
				$this->emailp->AdvancedSearch->SearchValue = HtmlDecode($this->emailp->AdvancedSearch->SearchValue);
			$this->emailp->EditValue = HtmlEncode($this->emailp->AdvancedSearch->SearchValue);
			$this->emailp->PlaceHolder = RemoveHtml($this->emailp->caption());

			// webp
			$this->webp->EditAttrs["class"] = "form-control";
			$this->webp->EditCustomAttributes = "";
			if (!$this->webp->Raw)
				$this->webp->AdvancedSearch->SearchValue = HtmlDecode($this->webp->AdvancedSearch->SearchValue);
			$this->webp->EditValue = HtmlEncode($this->webp->AdvancedSearch->SearchValue);
			$this->webp->PlaceHolder = RemoveHtml($this->webp->caption());

			// medsos
			$this->medsos->EditAttrs["class"] = "form-control";
			$this->medsos->EditCustomAttributes = "";
			if (!$this->medsos->Raw)
				$this->medsos->AdvancedSearch->SearchValue = HtmlDecode($this->medsos->AdvancedSearch->SearchValue);
			$this->medsos->EditValue = HtmlEncode($this->medsos->AdvancedSearch->SearchValue);
			$this->medsos->PlaceHolder = RemoveHtml($this->medsos->caption());

			// kdjenis
			$this->kdjenis->EditAttrs["class"] = "form-control";
			$this->kdjenis->EditCustomAttributes = "";

			// kdproduknafed
			$this->kdproduknafed->EditAttrs["class"] = "form-control";
			$this->kdproduknafed->EditCustomAttributes = "";

			// kdproduknafed2
			$this->kdproduknafed2->EditAttrs["class"] = "form-control";
			$this->kdproduknafed2->EditCustomAttributes = "";

			// kdproduknafed3
			$this->kdproduknafed3->EditAttrs["class"] = "form-control";
			$this->kdproduknafed3->EditCustomAttributes = "";

			// pproduk
			$this->pproduk->EditAttrs["class"] = "form-control";
			$this->pproduk->EditCustomAttributes = "";
			$this->pproduk->EditValue = HtmlEncode($this->pproduk->AdvancedSearch->SearchValue);
			$this->pproduk->PlaceHolder = RemoveHtml($this->pproduk->caption());

			// kdexport
			$this->kdexport->EditAttrs["class"] = "form-control";
			$this->kdexport->EditCustomAttributes = "";

			// nexport
			$this->nexport->EditAttrs["class"] = "form-control";
			$this->nexport->EditCustomAttributes = "";
			$this->nexport->EditValue = HtmlEncode($this->nexport->AdvancedSearch->SearchValue);
			$this->nexport->PlaceHolder = RemoveHtml($this->nexport->caption());

			// kdskala
			$this->kdskala->EditAttrs["class"] = "form-control";
			$this->kdskala->EditCustomAttributes = "";

			// kdkategori
			$this->kdkategori->EditAttrs["class"] = "form-control";
			$this->kdkategori->EditCustomAttributes = "";

			// jpeserta
			$this->jpeserta->EditAttrs["class"] = "form-control";
			$this->jpeserta->EditCustomAttributes = "";
			$this->jpeserta->EditValue = HtmlEncode($this->jpeserta->AdvancedSearch->SearchValue);
			$this->jpeserta->PlaceHolder = RemoveHtml($this->jpeserta->caption());
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
		if (!CheckInteger($this->idp->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->idp->errorMessage());
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
		$this->namap->AdvancedSearch->load();
		$this->idp->AdvancedSearch->load();
		$this->kontak->AdvancedSearch->load();
		$this->kdlokasi->AdvancedSearch->load();
		$this->kdprop->AdvancedSearch->load();
		$this->kdkota->AdvancedSearch->load();
		$this->kdkec->AdvancedSearch->load();
		$this->alamatp->AdvancedSearch->load();
		$this->kdpos->AdvancedSearch->load();
		$this->telpp->AdvancedSearch->load();
		$this->faxp->AdvancedSearch->load();
		$this->emailp->AdvancedSearch->load();
		$this->webp->AdvancedSearch->load();
		$this->kdjenis->AdvancedSearch->load();
		$this->kdproduknafed->AdvancedSearch->load();
		$this->pproduk->AdvancedSearch->load();
		$this->kdexport->AdvancedSearch->load();
		$this->nexport->AdvancedSearch->load();
		$this->kdskala->AdvancedSearch->load();
		$this->kdkategori->AdvancedSearch->load();
		$this->omzet_saat_ini->AdvancedSearch->load();
		$this->kapasitas_saat_ini->AdvancedSearch->load();
		$this->kapasitas_stl_1thn->AdvancedSearch->load();
		$this->kapasitas_stl_2thn->AdvancedSearch->load();
		$this->jpeserta->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ft_perusahaanlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ft_perusahaanlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ft_perusahaanlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_t_perusahaan" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_t_perusahaan\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ft_perusahaanlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft_perusahaanlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"t_perusahaansrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"t_perusahaan\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'t_perusahaansrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"ft_perusahaanlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
				case "x_idp":
					break;
				case "x_kdlokasi":
					break;
				case "x_kdprop":
					break;
				case "x_kdkota":
					break;
				case "x_kdkec":
					break;
				case "x_kdjenis":
					break;
				case "x_kdproduknafed":
					break;
				case "x_kdproduknafed2":
					break;
				case "x_kdproduknafed3":
					break;
				case "x_kdexport":
					break;
				case "x_kdskala":
					break;
				case "x_kdkategori":
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
						case "x_idp":
							break;
						case "x_kdlokasi":
							break;
						case "x_kdprop":
							break;
						case "x_kdkota":
							break;
						case "x_kdkec":
							break;
						case "x_kdjenis":
							break;
						case "x_kdproduknafed":
							break;
						case "x_kdproduknafed2":
							break;
						case "x_kdproduknafed3":
							break;
						case "x_kdexport":
							break;
						case "x_kdskala":
							break;
						case "x_kdkategori":
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
		$GLOBALS["ExportFileName"] = "Daftar_Perusahaan-PPE".CurrentDate();
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
		if ($this->Export <> "") {
		$header = "<center><h4>Daftar Perusahaan Peserta Pelatihan PPEI</h4>";
		if(!empty($this->namap->AdvancedSearch->SearchValue)){
			$namaperusahaan = "Nama Perusahaan : ".$this->namap->AdvancedSearch->SearchValue.", ";
		} else { $namaperusahaan = ""; }
		if(!empty($this->kontak->AdvancedSearch->SearchValue)){
			$contactperson = "Contact Person : ".$this->kontak->AdvancedSearch->SearchValue.", ";
		} else { $contactperson = ""; }
		if(!empty($this->kdlokasi->AdvancedSearch->SearchValue)){
			$lokasi = "Lokasi : ".ExecuteScalar("SELECT `lokasi` FROM `t_lokasi` WHERE `kdlokasi` = '".$this->kdlokasi->AdvancedSearch->SearchValue."'").", ";
		} else { $lokasi = ""; }
		if(!empty($this->kdprop->AdvancedSearch->SearchValue)){
			$propinsi = "Propinsi : ".show_propinsi($this->kdprop->AdvancedSearch->SearchValue).", ";
		} else { $propinsi = ""; }
		if(!empty($this->kdkota->AdvancedSearch->SearchValue)){
			$kota = "Kabupaten/Kota : ".show_kota($this->kdkota->AdvancedSearch->SearchValue).", ";
		} else { $kota = ""; }
		if(!empty($this->kdkec->AdvancedSearch->SearchValue)){
			$kecamatan = "Kecamatan : ".show_kecamatan($this->kdkec->AdvancedSearch->SearchValue).", ";
		} else { $kecamatan = ""; }
		if(!empty($this->alamatp->AdvancedSearch->SearchValue)){
			$alamat = "Alamat : ".$this->alamatp->AdvancedSearch->SearchValue.", ";
		} else { $alamat = ""; }
		if(!empty($this->telpp->AdvancedSearch->SearchValue)){
			$telpon = "Telepon : ".$this->telpp->AdvancedSearch->SearchValue.", ";
		} else { $telpon = ""; }
		if(!empty($this->faxp->AdvancedSearch->SearchValue)){
			$fax = "Fax : ".$this->faxp->AdvancedSearch->SearchValue.", ";
		} else { $fax = ""; }
		if(!empty($this->emailp->AdvancedSearch->SearchValue)){
			$email = "Email : ".$this->emailp->AdvancedSearch->SearchValue.", ";
		} else { $email = ""; }
		if(!empty($this->webp->AdvancedSearch->SearchValue)){
			$website = "Website : ".$this->webp->AdvancedSearch->SearchValue.", ";
		} else { $website = ""; }
		if(!empty($this->kdjenis->AdvancedSearch->SearchValue)){
			$jenis = "Jenis : ".ExecuteScalar("SELECT `jenis` FROM `t_jenis` WHERE `kdjenis` = '".$this->kdjenis->AdvancedSearch->SearchValue."'").", ";
		} else { $jenis = ""; }
		if(!empty($this->kdproduknafed->AdvancedSearch->SearchValue)){
			$kategoriproduk = "Kategori Produk : ".ExecuteScalar("SELECT `produknafedid` FROM `t_produknafed` WHERE `kdproduknafed` = '".$this->kdproduknafed->AdvancedSearch->SearchValue."'").", ";
		} else { $kategoriproduk = ""; }
		if(!empty($this->kdproduknafed2->AdvancedSearch->SearchValue)){
			$kategoriproduk2 = "Kategori Produk 2 : ".ExecuteScalar("SELECT `produknafedid` FROM `t_produknafed` WHERE `kdproduknafed` = '".$this->kdproduknafed2->AdvancedSearch->SearchValue."'").", ";
		} else { $kategoriproduk2 = ""; }
		if(!empty($this->kdproduknafed3->AdvancedSearch->SearchValue)){
			$kategoriproduk3 = "Kategori Produk 3 : ".ExecuteScalar("SELECT `produknafedid` FROM `t_produknafed` WHERE `kdproduknafed` = '".$this->kdproduknafed3->AdvancedSearch->SearchValue."'").", ";
		} else { $kategoriproduk3 = ""; }
		if(!empty($this->pproduk->AdvancedSearch->SearchValue)){
			$produk = "Produk : ".$this->pproduk->AdvancedSearch->SearchValue.", ";
		} else { $produk = ""; }
		if(!empty($this->kdexport->AdvancedSearch->SearchValue)){
			$export = "Export : ".ExecuteScalar("SELECT `export` FROM `t_export` WHERE `kdexport` = '".$this->kdexport->AdvancedSearch->SearchValue."'").", ";
		} else { $export = ""; }
		if(!empty($this->nexport->AdvancedSearch->SearchValue)){
			$negaraexport = "Negara Export : ".$this->nexport->AdvancedSearch->SearchValue.", ";
		} else { $negaraexport = ""; }
		if(!empty($this->kdskala->AdvancedSearch->SearchValue)){
			$skala = "Skala : ".ExecuteScalar("SELECT `skala` FROM `t_skala` WHERE `kdskala` = '".$this->kdskala->AdvancedSearch->SearchValue."'").", ";
		} else { $skala = ""; }
		if(!empty($this->kdkategori->AdvancedSearch->SearchValue)){
			$kategori = "Kategori : ".ExecuteScalar("SELECT `kategori` FROM `t_kategori` WHERE `kdkategori` = '".$this->kdkategori->AdvancedSearch->SearchValue."'").", ";
		} else { $kategori = ""; }
		$header .= "<h5>".$namaperusahaan.$contactperson.$lokasi.$propinsi.$kota.$kecamatan.$alamat.$telpon.$fax.$email.$website.$jenis.$kategoriproduk.$kategoriproduk2.$kategoriproduk3.$produk.$export.$negaraexport.$skala.$kategori."</h5>";
		$header .= "</center>";
		$header .= "Jumlah Perusahaan : ".@$_SESSION["totaldata_perusahaan"]." perusahaan";
		} else {
				if(CurrentUserLevel() == 1){ //user manajemen
					$this->kdkota->Visible = FALSE;
					$this->kdpos->Visible = FALSE;
				}
			$this->kontak->Visible = FALSE;
			$this->kdlokasi->Visible = FALSE;
			$this->kdkec->Visible = FALSE;
			$this->alamatp->Visible = FALSE;
			$this->telpp->Visible = FALSE;
			$this->faxp->Visible = FALSE;
			$this->emailp->Visible = FALSE;
			$this->medsos->Visible = FALSE;
			$this->webp->Visible = FALSE;
			$this->kdjenis->Visible = FALSE;
			$this->kdproduknafed->Visible = FALSE;
			$this->kdproduknafed2->Visible = FALSE;
			$this->kdproduknafed3->Visible = FALSE;
			$this->kdexport->Visible = FALSE;
			$this->nexport->Visible = FALSE;
			$this->kdskala->Visible = FALSE;
			$this->kdkategori->Visible = FALSE;		
		}// tutup export
		$this->idp->Visible = FALSE;
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

		if(isset(CurrentPage()->Pager->RecordCount) && CurrentPage()->Pager->RecordCount > 0){
			$_SESSION["totaldata_perusahaan"] = CurrentPage()->Pager->RecordCount;
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
		//$this->ListOptions->Items["new"]->Body = "xxx";

		$this->ListOptions->Items["detail_t_peserta"]->Body = "<a class='ewRowLink ewEdit' data-caption='View Detail' href='t_pesertalist.php?showmaster=t_perusahaan&fk_idp=" . $this->idp->CurrentValue . "'><span data-phrase='ViewLink' class='icon-view ewIcon' data-caption='View Detail'></span> View</a>";
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