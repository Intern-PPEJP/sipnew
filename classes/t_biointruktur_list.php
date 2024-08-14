<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_biointruktur_list extends t_biointruktur
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_biointruktur';

	// Page object name
	public $PageObjName = "t_biointruktur_list";

	// Grid form hidden field names
	public $FormName = "ft_biointrukturlist";
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

		// Table object (t_biointruktur)
		if (!isset($GLOBALS["t_biointruktur"]) || get_class($GLOBALS["t_biointruktur"]) == PROJECT_NAMESPACE . "t_biointruktur") {
			$GLOBALS["t_biointruktur"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_biointruktur"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "t_biointrukturadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "t_biointrukturdelete.php";
		$this->MultiUpdateUrl = "t_biointrukturupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_biointruktur');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ft_biointrukturlistsrch";

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
		global $t_biointruktur;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_biointruktur);
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
			$key .= @$ar['bioid'];
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
			$this->bioid->Visible = FALSE;
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
	public $t_rwpendd_Count;
	public $t_rwpekerjaan_Count;
	public $t_rwtraining_Count;
	public $t_faskur_Count;
	public $cv_rwipelatihaninstruktur_Count;
	public $t_evaluasifas_Count;
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
		$this->bioid->setVisibility();
		$this->kdinstruktur->setVisibility();
		$this->revisi->setVisibility();
		$this->tglterbit->setVisibility();
		$this->nama->setVisibility();
		$this->komp_materi->setVisibility();
		$this->tmplahir->Visible = FALSE;
		$this->tgllahir->Visible = FALSE;
		$this->agama->Visible = FALSE;
		$this->kategori->Visible = FALSE;
		$this->instansi->setVisibility();
		$this->pekerjaan->setVisibility();
		$this->alamatkantor->Visible = FALSE;
		$this->alamatrumah->Visible = FALSE;
		$this->telepon->Visible = FALSE;
		$this->hp->Visible = FALSE;
		$this->_email->Visible = FALSE;
		$this->fax->Visible = FALSE;
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
		$this->setupLookupOptions($this->komp_materi);
		$this->setupLookupOptions($this->agama);

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
			$this->bioid->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->bioid->OldValue))
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
		$filterList = Concat($filterList, $this->bioid->AdvancedSearch->toJson(), ","); // Field bioid
		$filterList = Concat($filterList, $this->kdinstruktur->AdvancedSearch->toJson(), ","); // Field kdinstruktur
		$filterList = Concat($filterList, $this->revisi->AdvancedSearch->toJson(), ","); // Field revisi
		$filterList = Concat($filterList, $this->tglterbit->AdvancedSearch->toJson(), ","); // Field tglterbit
		$filterList = Concat($filterList, $this->nama->AdvancedSearch->toJson(), ","); // Field nama
		$filterList = Concat($filterList, $this->komp_materi->AdvancedSearch->toJson(), ","); // Field komp_materi
		$filterList = Concat($filterList, $this->tmplahir->AdvancedSearch->toJson(), ","); // Field tmplahir
		$filterList = Concat($filterList, $this->tgllahir->AdvancedSearch->toJson(), ","); // Field tgllahir
		$filterList = Concat($filterList, $this->agama->AdvancedSearch->toJson(), ","); // Field agama
		$filterList = Concat($filterList, $this->kategori->AdvancedSearch->toJson(), ","); // Field kategori
		$filterList = Concat($filterList, $this->instansi->AdvancedSearch->toJson(), ","); // Field instansi
		$filterList = Concat($filterList, $this->pekerjaan->AdvancedSearch->toJson(), ","); // Field pekerjaan
		$filterList = Concat($filterList, $this->alamatkantor->AdvancedSearch->toJson(), ","); // Field alamatkantor
		$filterList = Concat($filterList, $this->alamatrumah->AdvancedSearch->toJson(), ","); // Field alamatrumah
		$filterList = Concat($filterList, $this->telepon->AdvancedSearch->toJson(), ","); // Field telepon
		$filterList = Concat($filterList, $this->hp->AdvancedSearch->toJson(), ","); // Field hp
		$filterList = Concat($filterList, $this->_email->AdvancedSearch->toJson(), ","); // Field email
		$filterList = Concat($filterList, $this->fax->AdvancedSearch->toJson(), ","); // Field fax
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
			$UserProfile->setSearchFilters(CurrentUserName(), "ft_biointrukturlistsrch", $filters);
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

		// Field bioid
		$this->bioid->AdvancedSearch->SearchValue = @$filter["x_bioid"];
		$this->bioid->AdvancedSearch->SearchOperator = @$filter["z_bioid"];
		$this->bioid->AdvancedSearch->SearchCondition = @$filter["v_bioid"];
		$this->bioid->AdvancedSearch->SearchValue2 = @$filter["y_bioid"];
		$this->bioid->AdvancedSearch->SearchOperator2 = @$filter["w_bioid"];
		$this->bioid->AdvancedSearch->save();

		// Field kdinstruktur
		$this->kdinstruktur->AdvancedSearch->SearchValue = @$filter["x_kdinstruktur"];
		$this->kdinstruktur->AdvancedSearch->SearchOperator = @$filter["z_kdinstruktur"];
		$this->kdinstruktur->AdvancedSearch->SearchCondition = @$filter["v_kdinstruktur"];
		$this->kdinstruktur->AdvancedSearch->SearchValue2 = @$filter["y_kdinstruktur"];
		$this->kdinstruktur->AdvancedSearch->SearchOperator2 = @$filter["w_kdinstruktur"];
		$this->kdinstruktur->AdvancedSearch->save();

		// Field revisi
		$this->revisi->AdvancedSearch->SearchValue = @$filter["x_revisi"];
		$this->revisi->AdvancedSearch->SearchOperator = @$filter["z_revisi"];
		$this->revisi->AdvancedSearch->SearchCondition = @$filter["v_revisi"];
		$this->revisi->AdvancedSearch->SearchValue2 = @$filter["y_revisi"];
		$this->revisi->AdvancedSearch->SearchOperator2 = @$filter["w_revisi"];
		$this->revisi->AdvancedSearch->save();

		// Field tglterbit
		$this->tglterbit->AdvancedSearch->SearchValue = @$filter["x_tglterbit"];
		$this->tglterbit->AdvancedSearch->SearchOperator = @$filter["z_tglterbit"];
		$this->tglterbit->AdvancedSearch->SearchCondition = @$filter["v_tglterbit"];
		$this->tglterbit->AdvancedSearch->SearchValue2 = @$filter["y_tglterbit"];
		$this->tglterbit->AdvancedSearch->SearchOperator2 = @$filter["w_tglterbit"];
		$this->tglterbit->AdvancedSearch->save();

		// Field nama
		$this->nama->AdvancedSearch->SearchValue = @$filter["x_nama"];
		$this->nama->AdvancedSearch->SearchOperator = @$filter["z_nama"];
		$this->nama->AdvancedSearch->SearchCondition = @$filter["v_nama"];
		$this->nama->AdvancedSearch->SearchValue2 = @$filter["y_nama"];
		$this->nama->AdvancedSearch->SearchOperator2 = @$filter["w_nama"];
		$this->nama->AdvancedSearch->save();

		// Field komp_materi
		$this->komp_materi->AdvancedSearch->SearchValue = @$filter["x_komp_materi"];
		$this->komp_materi->AdvancedSearch->SearchOperator = @$filter["z_komp_materi"];
		$this->komp_materi->AdvancedSearch->SearchCondition = @$filter["v_komp_materi"];
		$this->komp_materi->AdvancedSearch->SearchValue2 = @$filter["y_komp_materi"];
		$this->komp_materi->AdvancedSearch->SearchOperator2 = @$filter["w_komp_materi"];
		$this->komp_materi->AdvancedSearch->save();

		// Field tmplahir
		$this->tmplahir->AdvancedSearch->SearchValue = @$filter["x_tmplahir"];
		$this->tmplahir->AdvancedSearch->SearchOperator = @$filter["z_tmplahir"];
		$this->tmplahir->AdvancedSearch->SearchCondition = @$filter["v_tmplahir"];
		$this->tmplahir->AdvancedSearch->SearchValue2 = @$filter["y_tmplahir"];
		$this->tmplahir->AdvancedSearch->SearchOperator2 = @$filter["w_tmplahir"];
		$this->tmplahir->AdvancedSearch->save();

		// Field tgllahir
		$this->tgllahir->AdvancedSearch->SearchValue = @$filter["x_tgllahir"];
		$this->tgllahir->AdvancedSearch->SearchOperator = @$filter["z_tgllahir"];
		$this->tgllahir->AdvancedSearch->SearchCondition = @$filter["v_tgllahir"];
		$this->tgllahir->AdvancedSearch->SearchValue2 = @$filter["y_tgllahir"];
		$this->tgllahir->AdvancedSearch->SearchOperator2 = @$filter["w_tgllahir"];
		$this->tgllahir->AdvancedSearch->save();

		// Field agama
		$this->agama->AdvancedSearch->SearchValue = @$filter["x_agama"];
		$this->agama->AdvancedSearch->SearchOperator = @$filter["z_agama"];
		$this->agama->AdvancedSearch->SearchCondition = @$filter["v_agama"];
		$this->agama->AdvancedSearch->SearchValue2 = @$filter["y_agama"];
		$this->agama->AdvancedSearch->SearchOperator2 = @$filter["w_agama"];
		$this->agama->AdvancedSearch->save();

		// Field kategori
		$this->kategori->AdvancedSearch->SearchValue = @$filter["x_kategori"];
		$this->kategori->AdvancedSearch->SearchOperator = @$filter["z_kategori"];
		$this->kategori->AdvancedSearch->SearchCondition = @$filter["v_kategori"];
		$this->kategori->AdvancedSearch->SearchValue2 = @$filter["y_kategori"];
		$this->kategori->AdvancedSearch->SearchOperator2 = @$filter["w_kategori"];
		$this->kategori->AdvancedSearch->save();

		// Field instansi
		$this->instansi->AdvancedSearch->SearchValue = @$filter["x_instansi"];
		$this->instansi->AdvancedSearch->SearchOperator = @$filter["z_instansi"];
		$this->instansi->AdvancedSearch->SearchCondition = @$filter["v_instansi"];
		$this->instansi->AdvancedSearch->SearchValue2 = @$filter["y_instansi"];
		$this->instansi->AdvancedSearch->SearchOperator2 = @$filter["w_instansi"];
		$this->instansi->AdvancedSearch->save();

		// Field pekerjaan
		$this->pekerjaan->AdvancedSearch->SearchValue = @$filter["x_pekerjaan"];
		$this->pekerjaan->AdvancedSearch->SearchOperator = @$filter["z_pekerjaan"];
		$this->pekerjaan->AdvancedSearch->SearchCondition = @$filter["v_pekerjaan"];
		$this->pekerjaan->AdvancedSearch->SearchValue2 = @$filter["y_pekerjaan"];
		$this->pekerjaan->AdvancedSearch->SearchOperator2 = @$filter["w_pekerjaan"];
		$this->pekerjaan->AdvancedSearch->save();

		// Field alamatkantor
		$this->alamatkantor->AdvancedSearch->SearchValue = @$filter["x_alamatkantor"];
		$this->alamatkantor->AdvancedSearch->SearchOperator = @$filter["z_alamatkantor"];
		$this->alamatkantor->AdvancedSearch->SearchCondition = @$filter["v_alamatkantor"];
		$this->alamatkantor->AdvancedSearch->SearchValue2 = @$filter["y_alamatkantor"];
		$this->alamatkantor->AdvancedSearch->SearchOperator2 = @$filter["w_alamatkantor"];
		$this->alamatkantor->AdvancedSearch->save();

		// Field alamatrumah
		$this->alamatrumah->AdvancedSearch->SearchValue = @$filter["x_alamatrumah"];
		$this->alamatrumah->AdvancedSearch->SearchOperator = @$filter["z_alamatrumah"];
		$this->alamatrumah->AdvancedSearch->SearchCondition = @$filter["v_alamatrumah"];
		$this->alamatrumah->AdvancedSearch->SearchValue2 = @$filter["y_alamatrumah"];
		$this->alamatrumah->AdvancedSearch->SearchOperator2 = @$filter["w_alamatrumah"];
		$this->alamatrumah->AdvancedSearch->save();

		// Field telepon
		$this->telepon->AdvancedSearch->SearchValue = @$filter["x_telepon"];
		$this->telepon->AdvancedSearch->SearchOperator = @$filter["z_telepon"];
		$this->telepon->AdvancedSearch->SearchCondition = @$filter["v_telepon"];
		$this->telepon->AdvancedSearch->SearchValue2 = @$filter["y_telepon"];
		$this->telepon->AdvancedSearch->SearchOperator2 = @$filter["w_telepon"];
		$this->telepon->AdvancedSearch->save();

		// Field hp
		$this->hp->AdvancedSearch->SearchValue = @$filter["x_hp"];
		$this->hp->AdvancedSearch->SearchOperator = @$filter["z_hp"];
		$this->hp->AdvancedSearch->SearchCondition = @$filter["v_hp"];
		$this->hp->AdvancedSearch->SearchValue2 = @$filter["y_hp"];
		$this->hp->AdvancedSearch->SearchOperator2 = @$filter["w_hp"];
		$this->hp->AdvancedSearch->save();

		// Field email
		$this->_email->AdvancedSearch->SearchValue = @$filter["x__email"];
		$this->_email->AdvancedSearch->SearchOperator = @$filter["z__email"];
		$this->_email->AdvancedSearch->SearchCondition = @$filter["v__email"];
		$this->_email->AdvancedSearch->SearchValue2 = @$filter["y__email"];
		$this->_email->AdvancedSearch->SearchOperator2 = @$filter["w__email"];
		$this->_email->AdvancedSearch->save();

		// Field fax
		$this->fax->AdvancedSearch->SearchValue = @$filter["x_fax"];
		$this->fax->AdvancedSearch->SearchOperator = @$filter["z_fax"];
		$this->fax->AdvancedSearch->SearchCondition = @$filter["v_fax"];
		$this->fax->AdvancedSearch->SearchValue2 = @$filter["y_fax"];
		$this->fax->AdvancedSearch->SearchOperator2 = @$filter["w_fax"];
		$this->fax->AdvancedSearch->save();

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
		$this->buildSearchSql($where, $this->bioid, $default, FALSE); // bioid
		$this->buildSearchSql($where, $this->kdinstruktur, $default, FALSE); // kdinstruktur
		$this->buildSearchSql($where, $this->revisi, $default, FALSE); // revisi
		$this->buildSearchSql($where, $this->tglterbit, $default, FALSE); // tglterbit
		$this->buildSearchSql($where, $this->nama, $default, FALSE); // nama
		$this->buildSearchSql($where, $this->komp_materi, $default, FALSE); // komp_materi
		$this->buildSearchSql($where, $this->tmplahir, $default, FALSE); // tmplahir
		$this->buildSearchSql($where, $this->tgllahir, $default, FALSE); // tgllahir
		$this->buildSearchSql($where, $this->agama, $default, FALSE); // agama
		$this->buildSearchSql($where, $this->kategori, $default, FALSE); // kategori
		$this->buildSearchSql($where, $this->instansi, $default, FALSE); // instansi
		$this->buildSearchSql($where, $this->pekerjaan, $default, FALSE); // pekerjaan
		$this->buildSearchSql($where, $this->alamatkantor, $default, FALSE); // alamatkantor
		$this->buildSearchSql($where, $this->alamatrumah, $default, FALSE); // alamatrumah
		$this->buildSearchSql($where, $this->telepon, $default, FALSE); // telepon
		$this->buildSearchSql($where, $this->hp, $default, FALSE); // hp
		$this->buildSearchSql($where, $this->_email, $default, FALSE); // email
		$this->buildSearchSql($where, $this->fax, $default, FALSE); // fax
		$this->buildSearchSql($where, $this->created_by, $default, FALSE); // created_by
		$this->buildSearchSql($where, $this->created_at, $default, FALSE); // created_at
		$this->buildSearchSql($where, $this->updated_by, $default, FALSE); // updated_by
		$this->buildSearchSql($where, $this->updated_at, $default, FALSE); // updated_at

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->bioid->AdvancedSearch->save(); // bioid
			$this->kdinstruktur->AdvancedSearch->save(); // kdinstruktur
			$this->revisi->AdvancedSearch->save(); // revisi
			$this->tglterbit->AdvancedSearch->save(); // tglterbit
			$this->nama->AdvancedSearch->save(); // nama
			$this->komp_materi->AdvancedSearch->save(); // komp_materi
			$this->tmplahir->AdvancedSearch->save(); // tmplahir
			$this->tgllahir->AdvancedSearch->save(); // tgllahir
			$this->agama->AdvancedSearch->save(); // agama
			$this->kategori->AdvancedSearch->save(); // kategori
			$this->instansi->AdvancedSearch->save(); // instansi
			$this->pekerjaan->AdvancedSearch->save(); // pekerjaan
			$this->alamatkantor->AdvancedSearch->save(); // alamatkantor
			$this->alamatrumah->AdvancedSearch->save(); // alamatrumah
			$this->telepon->AdvancedSearch->save(); // telepon
			$this->hp->AdvancedSearch->save(); // hp
			$this->_email->AdvancedSearch->save(); // email
			$this->fax->AdvancedSearch->save(); // fax
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
		if ($this->bioid->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdinstruktur->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->revisi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tglterbit->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->komp_materi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tmplahir->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tgllahir->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->agama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kategori->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->instansi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->pekerjaan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->alamatkantor->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->alamatrumah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->telepon->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->hp->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->_email->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->fax->AdvancedSearch->issetSession())
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
		$this->bioid->AdvancedSearch->unsetSession();
		$this->kdinstruktur->AdvancedSearch->unsetSession();
		$this->revisi->AdvancedSearch->unsetSession();
		$this->tglterbit->AdvancedSearch->unsetSession();
		$this->nama->AdvancedSearch->unsetSession();
		$this->komp_materi->AdvancedSearch->unsetSession();
		$this->tmplahir->AdvancedSearch->unsetSession();
		$this->tgllahir->AdvancedSearch->unsetSession();
		$this->agama->AdvancedSearch->unsetSession();
		$this->kategori->AdvancedSearch->unsetSession();
		$this->instansi->AdvancedSearch->unsetSession();
		$this->pekerjaan->AdvancedSearch->unsetSession();
		$this->alamatkantor->AdvancedSearch->unsetSession();
		$this->alamatrumah->AdvancedSearch->unsetSession();
		$this->telepon->AdvancedSearch->unsetSession();
		$this->hp->AdvancedSearch->unsetSession();
		$this->_email->AdvancedSearch->unsetSession();
		$this->fax->AdvancedSearch->unsetSession();
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
		$this->bioid->AdvancedSearch->load();
		$this->kdinstruktur->AdvancedSearch->load();
		$this->revisi->AdvancedSearch->load();
		$this->tglterbit->AdvancedSearch->load();
		$this->nama->AdvancedSearch->load();
		$this->komp_materi->AdvancedSearch->load();
		$this->tmplahir->AdvancedSearch->load();
		$this->tgllahir->AdvancedSearch->load();
		$this->agama->AdvancedSearch->load();
		$this->kategori->AdvancedSearch->load();
		$this->instansi->AdvancedSearch->load();
		$this->pekerjaan->AdvancedSearch->load();
		$this->alamatkantor->AdvancedSearch->load();
		$this->alamatrumah->AdvancedSearch->load();
		$this->telepon->AdvancedSearch->load();
		$this->hp->AdvancedSearch->load();
		$this->_email->AdvancedSearch->load();
		$this->fax->AdvancedSearch->load();
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
			$this->updateSort($this->bioid); // bioid
			$this->updateSort($this->kdinstruktur); // kdinstruktur
			$this->updateSort($this->revisi); // revisi
			$this->updateSort($this->tglterbit); // tglterbit
			$this->updateSort($this->nama); // nama
			$this->updateSort($this->komp_materi); // komp_materi
			$this->updateSort($this->instansi); // instansi
			$this->updateSort($this->pekerjaan); // pekerjaan
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->bioid->setSort("");
				$this->kdinstruktur->setSort("");
				$this->revisi->setSort("");
				$this->tglterbit->setSort("");
				$this->nama->setSort("");
				$this->komp_materi->setSort("");
				$this->instansi->setSort("");
				$this->pekerjaan->setSort("");
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

		// "detail_t_rwpendd"
		$item = &$this->ListOptions->add("detail_t_rwpendd");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_rwpendd') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_rwpendd_grid"]))
			$GLOBALS["t_rwpendd_grid"] = new t_rwpendd_grid();

		// "detail_t_rwpekerjaan"
		$item = &$this->ListOptions->add("detail_t_rwpekerjaan");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_rwpekerjaan') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_rwpekerjaan_grid"]))
			$GLOBALS["t_rwpekerjaan_grid"] = new t_rwpekerjaan_grid();

		// "detail_t_rwtraining"
		$item = &$this->ListOptions->add("detail_t_rwtraining");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_rwtraining') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_rwtraining_grid"]))
			$GLOBALS["t_rwtraining_grid"] = new t_rwtraining_grid();

		// "detail_t_faskur"
		$item = &$this->ListOptions->add("detail_t_faskur");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_faskur') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_faskur_grid"]))
			$GLOBALS["t_faskur_grid"] = new t_faskur_grid();

		// "detail_cv_rwipelatihaninstruktur"
		$item = &$this->ListOptions->add("detail_cv_rwipelatihaninstruktur");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'cv_rwipelatihaninstruktur') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["cv_rwipelatihaninstruktur_grid"]))
			$GLOBALS["cv_rwipelatihaninstruktur_grid"] = new cv_rwipelatihaninstruktur_grid();

		// "detail_t_evaluasifas"
		$item = &$this->ListOptions->add("detail_t_evaluasifas");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_evaluasifas') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_evaluasifas_grid"]))
			$GLOBALS["t_evaluasifas_grid"] = new t_evaluasifas_grid();

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
		$pages->add("t_rwpendd");
		$pages->add("t_rwpekerjaan");
		$pages->add("t_rwtraining");
		$pages->add("t_faskur");
		$pages->add("cv_rwipelatihaninstruktur");
		$pages->add("t_evaluasifas");
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

		// "detail_t_rwpendd"
		$opt = $this->ListOptions["detail_t_rwpendd"];
		if ($Security->allowList(CurrentProjectID() . 't_rwpendd')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_rwpendd", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->t_rwpendd_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_rwpenddlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_rwpendd_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpendd");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_rwpendd";
			}
			if ($GLOBALS["t_rwpendd_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpendd");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_rwpendd";
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

		// "detail_t_rwpekerjaan"
		$opt = $this->ListOptions["detail_t_rwpekerjaan"];
		if ($Security->allowList(CurrentProjectID() . 't_rwpekerjaan')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_rwpekerjaan", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->t_rwpekerjaan_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_rwpekerjaanlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_rwpekerjaan_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpekerjaan");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_rwpekerjaan";
			}
			if ($GLOBALS["t_rwpekerjaan_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpekerjaan");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_rwpekerjaan";
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

		// "detail_t_rwtraining"
		$opt = $this->ListOptions["detail_t_rwtraining"];
		if ($Security->allowList(CurrentProjectID() . 't_rwtraining')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_rwtraining", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->t_rwtraining_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_rwtraininglist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_rwtraining_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwtraining");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_rwtraining";
			}
			if ($GLOBALS["t_rwtraining_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwtraining");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_rwtraining";
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

		// "detail_t_faskur"
		$opt = $this->ListOptions["detail_t_faskur"];
		if ($Security->allowList(CurrentProjectID() . 't_faskur')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_faskur", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->t_faskur_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_faskurlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_faskur_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_faskur");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_faskur";
			}
			if ($GLOBALS["t_faskur_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_faskur");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_faskur";
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

		// "detail_cv_rwipelatihaninstruktur"
		$opt = $this->ListOptions["detail_cv_rwipelatihaninstruktur"];
		if ($Security->allowList(CurrentProjectID() . 'cv_rwipelatihaninstruktur')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("cv_rwipelatihaninstruktur", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->cv_rwipelatihaninstruktur_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("cv_rwipelatihaninstrukturlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["cv_rwipelatihaninstruktur_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=cv_rwipelatihaninstruktur");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "cv_rwipelatihaninstruktur";
			}
			if ($GLOBALS["cv_rwipelatihaninstruktur_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=cv_rwipelatihaninstruktur");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "cv_rwipelatihaninstruktur";
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

		// "detail_t_evaluasifas"
		$opt = $this->ListOptions["detail_t_evaluasifas"];
		if ($Security->allowList(CurrentProjectID() . 't_evaluasifas')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_evaluasifas", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->t_evaluasifas_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_evaluasifaslist.php?" . Config("TABLE_SHOW_MASTER") . "=t_biointruktur&fk_bioid=" . urlencode(strval($this->bioid->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_evaluasifas_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_evaluasifas");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_evaluasifas";
			}
			if ($GLOBALS["t_evaluasifas_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_biointruktur')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_evaluasifas");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_evaluasifas";
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->bioid->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item = &$option->add("detailadd_t_rwpendd");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpendd");
		if (!isset($GLOBALS["t_rwpendd"]))
			$GLOBALS["t_rwpendd"] = new t_rwpendd();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_rwpendd"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_rwpendd"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_biointruktur') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_rwpendd";
		}
		$item = &$option->add("detailadd_t_rwpekerjaan");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwpekerjaan");
		if (!isset($GLOBALS["t_rwpekerjaan"]))
			$GLOBALS["t_rwpekerjaan"] = new t_rwpekerjaan();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_rwpekerjaan"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_rwpekerjaan"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_biointruktur') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_rwpekerjaan";
		}
		$item = &$option->add("detailadd_t_rwtraining");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_rwtraining");
		if (!isset($GLOBALS["t_rwtraining"]))
			$GLOBALS["t_rwtraining"] = new t_rwtraining();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_rwtraining"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_rwtraining"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_biointruktur') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_rwtraining";
		}
		$item = &$option->add("detailadd_t_faskur");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_faskur");
		if (!isset($GLOBALS["t_faskur"]))
			$GLOBALS["t_faskur"] = new t_faskur();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_faskur"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_faskur"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_biointruktur') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_faskur";
		}
		$item = &$option->add("detailadd_cv_rwipelatihaninstruktur");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=cv_rwipelatihaninstruktur");
		if (!isset($GLOBALS["cv_rwipelatihaninstruktur"]))
			$GLOBALS["cv_rwipelatihaninstruktur"] = new cv_rwipelatihaninstruktur();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["cv_rwipelatihaninstruktur"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["cv_rwipelatihaninstruktur"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_biointruktur') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "cv_rwipelatihaninstruktur";
		}
		$item = &$option->add("detailadd_t_evaluasifas");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_evaluasifas");
		if (!isset($GLOBALS["t_evaluasifas"]))
			$GLOBALS["t_evaluasifas"] = new t_evaluasifas();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_evaluasifas"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_evaluasifas"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_biointruktur') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_evaluasifas";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ft_biointrukturlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ft_biointrukturlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.ft_biointrukturlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// bioid
		if (!$this->isAddOrEdit() && $this->bioid->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->bioid->AdvancedSearch->SearchValue != "" || $this->bioid->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdinstruktur
		if (!$this->isAddOrEdit() && $this->kdinstruktur->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdinstruktur->AdvancedSearch->SearchValue != "" || $this->kdinstruktur->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// revisi
		if (!$this->isAddOrEdit() && $this->revisi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->revisi->AdvancedSearch->SearchValue != "" || $this->revisi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tglterbit
		if (!$this->isAddOrEdit() && $this->tglterbit->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tglterbit->AdvancedSearch->SearchValue != "" || $this->tglterbit->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nama
		if (!$this->isAddOrEdit() && $this->nama->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nama->AdvancedSearch->SearchValue != "" || $this->nama->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// komp_materi
		if (!$this->isAddOrEdit() && $this->komp_materi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->komp_materi->AdvancedSearch->SearchValue != "" || $this->komp_materi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tmplahir
		if (!$this->isAddOrEdit() && $this->tmplahir->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tmplahir->AdvancedSearch->SearchValue != "" || $this->tmplahir->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tgllahir
		if (!$this->isAddOrEdit() && $this->tgllahir->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tgllahir->AdvancedSearch->SearchValue != "" || $this->tgllahir->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// agama
		if (!$this->isAddOrEdit() && $this->agama->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->agama->AdvancedSearch->SearchValue != "" || $this->agama->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kategori
		if (!$this->isAddOrEdit() && $this->kategori->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kategori->AdvancedSearch->SearchValue != "" || $this->kategori->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// instansi
		if (!$this->isAddOrEdit() && $this->instansi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->instansi->AdvancedSearch->SearchValue != "" || $this->instansi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// pekerjaan
		if (!$this->isAddOrEdit() && $this->pekerjaan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->pekerjaan->AdvancedSearch->SearchValue != "" || $this->pekerjaan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// alamatkantor
		if (!$this->isAddOrEdit() && $this->alamatkantor->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->alamatkantor->AdvancedSearch->SearchValue != "" || $this->alamatkantor->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// alamatrumah
		if (!$this->isAddOrEdit() && $this->alamatrumah->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->alamatrumah->AdvancedSearch->SearchValue != "" || $this->alamatrumah->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// telepon
		if (!$this->isAddOrEdit() && $this->telepon->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->telepon->AdvancedSearch->SearchValue != "" || $this->telepon->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// hp
		if (!$this->isAddOrEdit() && $this->hp->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->hp->AdvancedSearch->SearchValue != "" || $this->hp->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// email
		if (!$this->isAddOrEdit() && $this->_email->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->_email->AdvancedSearch->SearchValue != "" || $this->_email->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// fax
		if (!$this->isAddOrEdit() && $this->fax->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->fax->AdvancedSearch->SearchValue != "" || $this->fax->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->bioid->setDbValue($row['bioid']);
		$this->kdinstruktur->setDbValue($row['kdinstruktur']);
		$this->revisi->setDbValue($row['revisi']);
		$this->tglterbit->setDbValue($row['tglterbit']);
		$this->nama->setDbValue($row['nama']);
		$this->komp_materi->setDbValue($row['komp_materi']);
		$this->tmplahir->setDbValue($row['tmplahir']);
		$this->tgllahir->setDbValue($row['tgllahir']);
		$this->agama->setDbValue($row['agama']);
		$this->kategori->setDbValue($row['kategori']);
		$this->instansi->setDbValue($row['instansi']);
		$this->pekerjaan->setDbValue($row['pekerjaan']);
		$this->alamatkantor->setDbValue($row['alamatkantor']);
		$this->alamatrumah->setDbValue($row['alamatrumah']);
		$this->telepon->setDbValue($row['telepon']);
		$this->hp->setDbValue($row['hp']);
		$this->_email->setDbValue($row['email']);
		$this->fax->setDbValue($row['fax']);
		$this->created_by->setDbValue($row['created_by']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_by->setDbValue($row['updated_by']);
		$this->updated_at->setDbValue($row['updated_at']);
		if (!isset($GLOBALS["t_rwpendd_grid"]))
			$GLOBALS["t_rwpendd_grid"] = new t_rwpendd_grid();
		$detailFilter = $GLOBALS["t_rwpendd"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_rwpendd"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_rwpendd"]->applyUserIDFilters($detailFilter);
		$this->t_rwpendd_Count = $GLOBALS["t_rwpendd"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_rwpekerjaan_grid"]))
			$GLOBALS["t_rwpekerjaan_grid"] = new t_rwpekerjaan_grid();
		$detailFilter = $GLOBALS["t_rwpekerjaan"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_rwpekerjaan"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_rwpekerjaan"]->applyUserIDFilters($detailFilter);
		$this->t_rwpekerjaan_Count = $GLOBALS["t_rwpekerjaan"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_rwtraining_grid"]))
			$GLOBALS["t_rwtraining_grid"] = new t_rwtraining_grid();
		$detailFilter = $GLOBALS["t_rwtraining"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_rwtraining"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_rwtraining"]->applyUserIDFilters($detailFilter);
		$this->t_rwtraining_Count = $GLOBALS["t_rwtraining"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_faskur_grid"]))
			$GLOBALS["t_faskur_grid"] = new t_faskur_grid();
		$detailFilter = $GLOBALS["t_faskur"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_faskur"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_faskur"]->applyUserIDFilters($detailFilter);
		$this->t_faskur_Count = $GLOBALS["t_faskur"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["cv_rwipelatihaninstruktur_grid"]))
			$GLOBALS["cv_rwipelatihaninstruktur_grid"] = new cv_rwipelatihaninstruktur_grid();
		$detailFilter = $GLOBALS["cv_rwipelatihaninstruktur"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["cv_rwipelatihaninstruktur"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["cv_rwipelatihaninstruktur"]->applyUserIDFilters($detailFilter);
		$this->cv_rwipelatihaninstruktur_Count = $GLOBALS["cv_rwipelatihaninstruktur"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_evaluasifas_grid"]))
			$GLOBALS["t_evaluasifas_grid"] = new t_evaluasifas_grid();
		$detailFilter = $GLOBALS["t_evaluasifas"]->sqlDetailFilter_t_biointruktur();
		$detailFilter = str_replace("@bioid@", AdjustSql($this->bioid->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_evaluasifas"]->setCurrentMasterTable("t_biointruktur");
		$detailFilter = $GLOBALS["t_evaluasifas"]->applyUserIDFilters($detailFilter);
		$this->t_evaluasifas_Count = $GLOBALS["t_evaluasifas"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['bioid'] = NULL;
		$row['kdinstruktur'] = NULL;
		$row['revisi'] = NULL;
		$row['tglterbit'] = NULL;
		$row['nama'] = NULL;
		$row['komp_materi'] = NULL;
		$row['tmplahir'] = NULL;
		$row['tgllahir'] = NULL;
		$row['agama'] = NULL;
		$row['kategori'] = NULL;
		$row['instansi'] = NULL;
		$row['pekerjaan'] = NULL;
		$row['alamatkantor'] = NULL;
		$row['alamatrumah'] = NULL;
		$row['telepon'] = NULL;
		$row['hp'] = NULL;
		$row['email'] = NULL;
		$row['fax'] = NULL;
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
		if (strval($this->getKey("bioid")) != "")
			$this->bioid->OldValue = $this->getKey("bioid"); // bioid
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
		// bioid
		// kdinstruktur
		// revisi
		// tglterbit
		// nama
		// komp_materi
		// tmplahir
		// tgllahir
		// agama
		// kategori
		// instansi
		// pekerjaan
		// alamatkantor
		// alamatrumah
		// telepon
		// hp
		// email
		// fax
		// created_by
		// created_at
		// updated_by
		// updated_at

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// bioid
			$this->bioid->ViewValue = $this->bioid->CurrentValue;
			$this->bioid->ViewCustomAttributes = "";

			// kdinstruktur
			$this->kdinstruktur->ViewValue = $this->kdinstruktur->CurrentValue;
			$this->kdinstruktur->ViewCustomAttributes = "";

			// revisi
			$this->revisi->ViewValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tglterbit
			$this->tglterbit->ViewValue = $this->tglterbit->CurrentValue;
			$this->tglterbit->ViewValue = FormatDateTime($this->tglterbit->ViewValue, 0);
			$this->tglterbit->ViewCustomAttributes = "";

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// komp_materi
			$this->komp_materi->ViewValue = $this->komp_materi->CurrentValue;
			$curVal = strval($this->komp_materi->CurrentValue);
			if ($curVal != "") {
				$this->komp_materi->ViewValue = $this->komp_materi->lookupCacheOption($curVal);
				if ($this->komp_materi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->komp_materi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->komp_materi->ViewValue = $this->komp_materi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->komp_materi->ViewValue = $this->komp_materi->CurrentValue;
					}
				}
			} else {
				$this->komp_materi->ViewValue = NULL;
			}
			$this->komp_materi->ViewCustomAttributes = "";

			// tmplahir
			$this->tmplahir->ViewValue = $this->tmplahir->CurrentValue;
			$this->tmplahir->ViewCustomAttributes = "";

			// tgllahir
			$this->tgllahir->ViewValue = $this->tgllahir->CurrentValue;
			$this->tgllahir->ViewValue = FormatDateTime($this->tgllahir->ViewValue, 0);
			$this->tgllahir->ViewCustomAttributes = "";

			// agama
			$curVal = strval($this->agama->CurrentValue);
			if ($curVal != "") {
				$this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
				if ($this->agama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdagama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->agama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->agama->ViewValue = $this->agama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->agama->ViewValue = $this->agama->CurrentValue;
					}
				}
			} else {
				$this->agama->ViewValue = NULL;
			}
			$this->agama->ViewCustomAttributes = "";

			// kategori
			if (strval($this->kategori->CurrentValue) != "") {
				$this->kategori->ViewValue = $this->kategori->optionCaption($this->kategori->CurrentValue);
			} else {
				$this->kategori->ViewValue = NULL;
			}
			$this->kategori->ViewCustomAttributes = "";

			// instansi
			$this->instansi->ViewValue = $this->instansi->CurrentValue;
			$this->instansi->ViewCustomAttributes = "";

			// pekerjaan
			$this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
			$this->pekerjaan->ViewCustomAttributes = "";

			// alamatkantor
			$this->alamatkantor->ViewValue = $this->alamatkantor->CurrentValue;
			$this->alamatkantor->ViewCustomAttributes = "";

			// alamatrumah
			$this->alamatrumah->ViewValue = $this->alamatrumah->CurrentValue;
			$this->alamatrumah->ViewCustomAttributes = "";

			// telepon
			$this->telepon->ViewValue = $this->telepon->CurrentValue;
			$this->telepon->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// fax
			$this->fax->ViewValue = $this->fax->CurrentValue;
			$this->fax->ViewCustomAttributes = "";

			// bioid
			$this->bioid->LinkCustomAttributes = "";
			$this->bioid->HrefValue = "";
			$this->bioid->TooltipValue = "";

			// kdinstruktur
			$this->kdinstruktur->LinkCustomAttributes = "";
			$this->kdinstruktur->HrefValue = "";
			$this->kdinstruktur->TooltipValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";
			$this->revisi->TooltipValue = "";

			// tglterbit
			$this->tglterbit->LinkCustomAttributes = "";
			$this->tglterbit->HrefValue = "";
			$this->tglterbit->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";
			if (!$this->isExport())
				$this->nama->ViewValue = $this->highlightValue($this->nama);

			// komp_materi
			$this->komp_materi->LinkCustomAttributes = "";
			$this->komp_materi->HrefValue = "";
			$this->komp_materi->TooltipValue = "";

			// instansi
			$this->instansi->LinkCustomAttributes = "";
			$this->instansi->HrefValue = "";
			$this->instansi->TooltipValue = "";

			// pekerjaan
			$this->pekerjaan->LinkCustomAttributes = "";
			$this->pekerjaan->HrefValue = "";
			$this->pekerjaan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// bioid
			$this->bioid->EditAttrs["class"] = "form-control";
			$this->bioid->EditCustomAttributes = "";
			$this->bioid->EditValue = HtmlEncode($this->bioid->AdvancedSearch->SearchValue);
			$this->bioid->PlaceHolder = RemoveHtml($this->bioid->caption());

			// kdinstruktur
			$this->kdinstruktur->EditAttrs["class"] = "form-control";
			$this->kdinstruktur->EditCustomAttributes = "";
			if (!$this->kdinstruktur->Raw)
				$this->kdinstruktur->AdvancedSearch->SearchValue = HtmlDecode($this->kdinstruktur->AdvancedSearch->SearchValue);
			$this->kdinstruktur->EditValue = HtmlEncode($this->kdinstruktur->AdvancedSearch->SearchValue);
			$this->kdinstruktur->PlaceHolder = RemoveHtml($this->kdinstruktur->caption());

			// revisi
			$this->revisi->EditAttrs["class"] = "form-control";
			$this->revisi->EditCustomAttributes = "";
			if (!$this->revisi->Raw)
				$this->revisi->AdvancedSearch->SearchValue = HtmlDecode($this->revisi->AdvancedSearch->SearchValue);
			$this->revisi->EditValue = HtmlEncode($this->revisi->AdvancedSearch->SearchValue);
			$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

			// tglterbit
			$this->tglterbit->EditAttrs["class"] = "form-control";
			$this->tglterbit->EditCustomAttributes = "";
			$this->tglterbit->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tglterbit->AdvancedSearch->SearchValue, 0), 8));
			$this->tglterbit->PlaceHolder = RemoveHtml($this->tglterbit->caption());

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->AdvancedSearch->SearchValue = HtmlDecode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->EditValue = HtmlEncode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// komp_materi
			$this->komp_materi->EditAttrs["class"] = "form-control";
			$this->komp_materi->EditCustomAttributes = "";
			$this->komp_materi->EditValue = HtmlEncode($this->komp_materi->AdvancedSearch->SearchValue);
			$curVal = strval($this->komp_materi->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->komp_materi->EditValue = $this->komp_materi->lookupCacheOption($curVal);
				if ($this->komp_materi->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->komp_materi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->komp_materi->EditValue = $this->komp_materi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->komp_materi->EditValue = HtmlEncode($this->komp_materi->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->komp_materi->EditValue = NULL;
			}
			$this->komp_materi->PlaceHolder = RemoveHtml($this->komp_materi->caption());

			// instansi
			$this->instansi->EditAttrs["class"] = "form-control";
			$this->instansi->EditCustomAttributes = "";
			if (!$this->instansi->Raw)
				$this->instansi->AdvancedSearch->SearchValue = HtmlDecode($this->instansi->AdvancedSearch->SearchValue);
			$this->instansi->EditValue = HtmlEncode($this->instansi->AdvancedSearch->SearchValue);
			$this->instansi->PlaceHolder = RemoveHtml($this->instansi->caption());

			// pekerjaan
			$this->pekerjaan->EditAttrs["class"] = "form-control";
			$this->pekerjaan->EditCustomAttributes = "";
			if (!$this->pekerjaan->Raw)
				$this->pekerjaan->AdvancedSearch->SearchValue = HtmlDecode($this->pekerjaan->AdvancedSearch->SearchValue);
			$this->pekerjaan->EditValue = HtmlEncode($this->pekerjaan->AdvancedSearch->SearchValue);
			$this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());
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
		if (!CheckInteger($this->komp_materi->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->komp_materi->errorMessage());
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
		$this->bioid->AdvancedSearch->load();
		$this->kdinstruktur->AdvancedSearch->load();
		$this->revisi->AdvancedSearch->load();
		$this->tglterbit->AdvancedSearch->load();
		$this->nama->AdvancedSearch->load();
		$this->komp_materi->AdvancedSearch->load();
		$this->tmplahir->AdvancedSearch->load();
		$this->tgllahir->AdvancedSearch->load();
		$this->agama->AdvancedSearch->load();
		$this->kategori->AdvancedSearch->load();
		$this->instansi->AdvancedSearch->load();
		$this->pekerjaan->AdvancedSearch->load();
		$this->alamatkantor->AdvancedSearch->load();
		$this->alamatrumah->AdvancedSearch->load();
		$this->telepon->AdvancedSearch->load();
		$this->hp->AdvancedSearch->load();
		$this->_email->AdvancedSearch->load();
		$this->fax->AdvancedSearch->load();
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
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ft_biointrukturlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ft_biointrukturlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ft_biointrukturlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_t_biointruktur" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_t_biointruktur\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ft_biointrukturlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Visible = TRUE;

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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft_biointrukturlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"ft_biointrukturlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
				case "x_komp_materi":
					break;
				case "x_agama":
					break;
				case "x_kategori":
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
						case "x_komp_materi":
							break;
						case "x_agama":
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
		if(!empty($_GET["h"])){
		if(@$_GET["bulan"] == @$_GET["bulan2"]){
			$tampilbulan = ucfirst(BulanIndo(@$_GET["bulan"])) . ".";
			} else {
				if(@$_GET["bulan"] == 1 && @$_GET["bulan2"] >= 12){
					$tampilbulan = "";
				} else {
					$tampilbulan = ucfirst(BulanIndo(@$_GET["bulan"])) . ".sd." . ucfirst(BulanIndo(@$_GET["bulan2"])) . " .";
				}
			}
			if($_GET["rp"] == 1){ // PENGAJAR INTERNAL
				if($_GET["h"] == "rpt1"){ 
					$GLOBALS["ExportFileName"] = "3. Rekap.Real.Pengajar.Internal.Per.Instruktur.".$tampilbulan."Th." . @$_GET["tahun"];
				} else if($_GET["h"] == "rpt2"){ 
					$GLOBALS["ExportFileName"] = "1. Rekap.Real.Pengajar.Internal.".$tampilbulan."Th." . @$_GET["tahun"];
				}
			} else if($_GET["rp"] == 2){ // PENGAJAR EKSTERNAL
				if($_GET["h"] == "rpt1"){ 
					$GLOBALS["ExportFileName"] = "4. Rekap.Real.Pengajar.Eksternal.Per.Instruktur.".$tampilbulan."Th." . @$_GET["tahun"];
				} else if($_GET["h"] == "rpt2"){ 
					$GLOBALS["ExportFileName"] = "2. Rekap.Real.Pengajar.Eksternal.".$tampilbulan."Th." . @$_GET["tahun"];
				}
			}
		} else {
			$GLOBALS["ExportFileName"] = "Daftar_Fasilitator-PPE".CurrentDate();
		}
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
			if(!isset($_GET["h"]) && $this->Export <> "word")
			$header = "<center><h4>LIST FASILITATOR BALAI BESAR PENDIDIKAN DAN PELATIHAN EKSPOR INDONESIA</h4></center>";
		} else {
			if(CurrentUserLevel() == 1){ //user manajemen
					$this->revisi->Visible = FALSE;
					$this->tglterbit->Visible = FALSE;
					$this->tgllahir->Visible = FALSE;
					$this->tmplahir->Visible = FALSE;
					$this->agama->Visible = FALSE;
					$this->kategori->Visible = FALSE;
					$this->alamatkantor->Visible = FALSE;
					$this->alamatrumah->Visible = FALSE;
					$this->telepon->Visible = FALSE;
					$this->hp->Visible = FALSE;
					$this->_email->Visible = FALSE;
					$this->fax->Visible = FALSE;
				}
		}
		$this->bioid->Visible = FALSE;
		$this->kdinstruktur->Visible = FALSE;
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

		$this->ListOptions->Items["view"]->Visible = FALSE;

	/*
		$opt = &$this->ListOptions->Add("Evaluasi");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(9); // Move to first column
		*/
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
		//$this->ListOptions->Items["evaluasi"]->Body = "<a class='ewRowLink ewEdit' data-caption='Evaluasi' href='t_evafaslist.php?showmaster=t_bioinstruktur&fk_bioid=" . $this->bioid->CurrentValue . "'><span data-phrase='ViewLink' class='icon-view ewIcon' data-caption='Evaluasi'></span> Evaluasi</a>";

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

		if(@$_GET["h"] == "rpt1"){
			if($_GET["bulan"] == $_GET["bulan2"]){
				$tampilbulan = strtoupper(BulanIndo($_GET["bulan"])) . " ";
			} else {
				if($_GET["bulan"] == 1 && $_GET["bulan2"] >= 12){
					$tampilbulan = "";
				} else {
					$tampilbulan = strtoupper(BulanIndo($_GET["bulan"])) . " S.D " . strtoupper(BulanIndo($_GET["bulan2"])) . " ";
				}
			}
			$this->ExportDoc->Text = "<h4>REALISASI JADWAL FASILITATOR TAHUN ".$tampilbulan.$_GET["tahun"]."</h4><h4></h4>";
			return FALSE;
		} else if (@$_GET["h"] == "rpt2"){
			if(@$_GET["rp"] == 1){ // Pengajar Internal
				$judul = "INTERNAL";
			} else if(@$_GET["rp"] == 2) { // Pengajar Eksternal
				$judul = "EKSTERNAL";
			}
			if($_GET["bulan"] == $_GET["bulan2"]){
				$tampilbulan = ucfirst(BulanIndo($_GET["bulan"])) . " ";
			} else {
				if($_GET["bulan"] == 1 && $_GET["bulan2"] >= 12){
					$tampilbulan = "Januari S.D Desember ";
				} else {
					$tampilbulan = ucfirst(BulanIndo($_GET["bulan"])) . " S.D " . ucfirst(BulanIndo($_GET["bulan2"])) . " ";
				}
			}
			$_SESSION["nom"] = 1;
			$this->ExportDoc->Text = "<style>#tdq{ background-color:#b5b5b5; } table { border-collapse: collapse; } th, td { border: 1px solid #000; padding:5px;} .tdt{border-left:0;border-bottom:0;border-right:0;}.tdn{border:none;} </style>
				<table width='45%'>
				<tr>
					<th colspan='5' class='tdt'><h4>REALISASI PENGAJAR ".$judul."</h4></th>
				</tr>
				<tr>
					<th colspan='5' class='tdt' style='border-top:0;text-align: left;'>Bulan : ".$tampilbulan."".@$_GET["tahun"]."</th>
				</tr>
				<tr>
					<th id='tdq'>NO</th>
					<th id='tdq'>NAMA</th>
					<th colspan='2' id='tdq'>JUMLAH MENGAJAR</th>
					<th id='tdq'>KETERANGAN</th>
				</tr>
				<tr>
					<th id='tdq'>&nbsp;</th>
					<th id='tdq'>&nbsp;</th>
					<th id='tdq'>PUSAT</th>
					<th id='tdq'>DAERAH</th>
					<th id='tdq'>&nbsp;</th>
				</tr>";
			return FALSE;
		} else {
			if ($this->Export == "word"){
				return FALSE;
			} else {
				return TRUE; // Return TRUE to use default export and skip Row_Export event
			}
		}
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
			if(@$_GET["h"] == "rpt1"){
				$this->ExportDoc->Text .= '<style>#tdh { border-bottom:2.0pt double windowtext;}</style>
				<table><tbody>
		<tr>
			<td>Nama Instruktur</td>
			<td width="2px" align="center">:</td>
			<td>'.$this->nama->ViewValue.'</td>
		</tr>
		<tr>
			<td>HP</td>
			<td align="center">:</td>
			<td align="left">'.$this->hp->ViewValue.'</td>
		</tr>
		<tr>
			<td>Tlp. Kantor</td>
			<td align="center">:</td>
			<td></td>
		</tr>
		<tr>
			<td>Tlp. Rumah</td>
			<td align="center">:</td>
			<td>'.$this->telepon->ViewValue.'</td>
		</tr>
		<tr>
			<td>Fax</td>
			<td align="center">:</td>
			<td>'.$this->fax->ViewValue.'</td>
		</tr>
		<tr>
			<td>Instansi</td>
			<td align="center">:</td>
			<td>'.$this->instansi->ViewValue.'</td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td align="center">:</td>
			<td>'.$this->pekerjaan->ViewValue.'</td>
		</tr><tr>
			<td>Email</td>
			<td align="center">:</td>
			<td>'.$rs["email"].'</td>
		</tr>
	</tbody></table>
		<br>';
		if($_GET["bulan"] == $_GET["bulan2"]){
			$caribulan = " AND month(a.tgl) = ".$_GET["bulan"]."";
		} else {
			$caribulan = " AND (month(a.tgl) >= ".$_GET["bulan"]." AND month(a.tgl) <= ".$_GET["bulan2"].")";
		}
		 $this->ExportDoc->Text .= '<table border="1"><tbody><tr><th id="tdh">No.</th><th id="tdh">Tgl. Ceramah</th><th id="tdh">Tgl. Pelaksana</th><th id="tdh">Tempat</th><th id="tdh">Pelatihan</th><th id="tdh">Materi</th><th id="tdh">Sesi</th><th id="tdh">Nilai</th><th id="tdh">Komentar / Saran</th></tr>';
		$my_sql = mysql_query("SELECT a.*, pl.`tawal`, pl.`takhir`, pl.`tempat`, jd.`judul`, kr.`kurikulum`  FROM `t_jadwalpel` a LEFT JOIN `t_pelatihan` pl ON a.`idpelat` = pl.`idpelat` LEFT JOIN `t_judul` jd ON pl.`kdjudul` = jd.`kdjudul` LEFT JOIN `t_kurikulum` kr ON a.`materi` = kr.`kurikulumid` WHERE pl.statuspel = 4 AND a.`instruktur` = '".$this->bioid->CurrentValue."' AND YEAR(a.tgl) = ".$_GET["tahun"].$caribulan."") or die("Error Query...");
				$no = 1;

				//$this->instruktur->CurrentValue = "";
				while($rd = mysql_fetch_array($my_sql)){
		$btawal = date("n", strtotime($rd["tawal"]));
		$btakhir = date("n", strtotime($rd["takhir"]));
		if($btawal == $btakhir){
			$tgl_jd =  date("d", strtotime($rd["tawal"])) . " - " . CSFormatTanggal(date("d-m", strtotime($rd["takhir"])), $cetak_hari = false, $cetak_br = false, $singkatan_bulan = true);
		} else {
			$tgl_jd =  CSFormatTanggal(date("d-m", strtotime($rd["tawal"])), $cetak_hari = false, $cetak_br = false, $singkatan_bulan = true) . " - " . CSFormatTanggal(date("d-m", strtotime($rd["takhir"])), $cetak_hari = false, $cetak_br = false, $singkatan_bulan = true);
		}
		$rd["tgl"] = date("d-m", strtotime($rd["tgl"]));
					$this->ExportDoc->Text .= '<tr><td>'.$no.'</td><td align="left">'.CSFormatTanggal($rd["tgl"], $cetak_hari = false, $cetak_br = false, $singkatan_bulan = true).'</td><td>'.$tgl_jd.'</td><td>'.$rd["tempat"].'</td><td>'.$rd["judul"].'</td><td>'.$rd["kurikulum"].'</td><td></td><td></td><td></td></tr>';
					$no++;
				}
		$this->ExportDoc->Text .= '</tbody></table><br><br><br>';
			} // tutup halaman report
			else if (@$_GET["h"] == "rpt2"){
				$nom = $_SESSION["nom"]++;
				$caribulan = "";
				if(!empty($_GET["bulan"])){
					$caribulan = "AND ".$_GET["bulan"]." BETWEEN month(b.tawal) AND month(takhir) ";
				}
				if($_GET["bulan"] == $_GET["bulan2"]){
					$caribulan = " AND month(b.tawal) = '".$_GET["bulan"]."'";
				} else {
					$caribulan = " AND (month(b.tawal) >= ".$_GET["bulan"]." AND month(b.tawal) <= ".$_GET["bulan2"].")";
				}
				$jmlpusat = ExecuteScalar("SELECT COUNT(1) FROM `t_instrukturpelatihan` a INNER JOIN `t_pelatihan` b ON a.kdpelat = b.kdpelat WHERE b.statuspel = 4 AND b.`kdkota` = 31 AND a.`bioid` = ".$rs["bioid"]." AND YEAR(b.tawal) = ".$_GET["tahun"].$caribulan."");
				$jmldaerah = ExecuteScalar("SELECT COUNT(1) FROM `t_instrukturpelatihan` a INNER JOIN `t_pelatihan` b ON a.kdpelat = b.kdpelat WHERE b.statuspel = 4 AND b.`kdkota` != 31 AND a.`bioid` = ".$rs["bioid"]." AND YEAR(b.tawal) = ".$_GET["tahun"].$caribulan."");
			$this->ExportDoc->Text .= "
			<tr>
				<td align='center' valign='top'>".$nom."</td>
				<td>".$rs["nama"]."</td>
				<td align='center'>".$jmlpusat."</td>
				<td align='center'>".$jmldaerah."</td>
				<td> </td>
			</tr>"; 
			} else { // eksport default t_biointruktur
			if ($this->Export == "word"){
				$this->ExportDoc->Text .= "
				<style>
					#tbrw td { font-size: 10pt;}
				</style>
				<table width='100%' border='1' id='tbrw' bordercolor='black' cellpadding='5'>
				<tr>
					<td width='23%' colspan='2' rowspan='3'><img src='images/dblogo.jpg'></img></td>
					<td width='35%' colspan='4' rowspan='3' style='text-align:center'><h4>BIODATA INSTRUKTUR</h4></td>
					<td width='17%' colspan='2'>KODE INSTRUKTUR</td>
					<td width='25%' colspan='2'>".strtoupper($this->kdinstruktur->ViewValue)."</td>
				</tr>
				<tr>
					<td colspan='2'>REVISI /TGL. TERBIT</td>
					<td colspan='2'>".$this->revisi->ViewValue."/".CSFormatTanggal(date('d-m-Y', strtotime($this->tglterbit->CurrentValue)), false, false, false)."</td>
				</tr>
				<tr>
					<td colspan='2'>HALAMAN</td>
					<td colspan='2'>1 DARI 3</td>
				</tr></table>
				<br><br>
				<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
				<tr>
					<td width='35%'>Nama</td><td width='5%'>:</td><td colspan='3' width='60%'>".$this->nama->ViewValue."</td>
				</tr><tr>
					<td>Tempat/Tanggal Lahir</td><td>:</td><td colspan='3'>".$this->tmplahir->ViewValue."/".CSFormatTanggal(date('d-m-Y', strtotime($this->tgllahir->CurrentValue)), false, false, false)."</td>
				</tr><tr>
					<td>Agama</td><td>:</td><td colspan='3'>".$this->agama->ViewValue."</td>
				</tr><tr>
					<td>Pekerjaan</td><td>:</td><td colspan='3'>".$this->pekerjaan->ViewValue."</td>
				</tr><tr>
					<td>Instansi</td><td>:</td><td colspan='3'>".$this->instansi->ViewValue."</td>
				</tr><tr>
					<td>Alamat Kantor</td><td>:</td><td colspan='3'>".$this->alamatkantor->ViewValue."</td>
				</tr><tr>
					<td>Alamat Rumah</td><td>:</td><td colspan='3'>".$this->alamatrumah->ViewValue."</td>
				</tr><tr>
					<td width='35%'></td><td width='5%'>Phone</td><td width='30%'>".$this->telepon->ViewValue."</td><td width='5%'>HP</td><td width='25%'>".$this->hp->ViewValue."</td>
				</tr><tr>
					<td width='35%'></td><td width='5%'>E-mail</td><td width='30%'>".$this->_email->ViewValue."</td><td width='5%'>Fax</td><td width='25%'>".$this->fax->ViewValue."</td>
				</tr>
				</table>
				<br>
				<h4>I. RIWAYAT PENDIDIKAN</h4>
				<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
				<tr>
					<td width='5%' align='center'><b>NO</b></td>
					<td width='55%'><b>SEKOLAH/UNIVERSITAS</b></td>
					<td width='25%' align='center'><b>TEMPAT</b></td>
					<td width='15%' align='center'><b>TAHUN</b></td>
				</tr>";
				$no=1;
				$dt = Execute("SELECT sekolah,tempat,tahun FROM `t_rwpendd` WHERE bioid = ".$this->bioid->CurrentValue); 
				if ($dt->RecordCount() >0) {
					$dt->MoveFirst(); 
					while (!$dt->EOF) { 
					$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$dt->fields("sekolah")."</td><td align='center'>".$dt->fields("tempat")."</td><td align='center'>".$dt->fields("tahun")."</td></tr>"; 
					$no++;
					$dt->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
					} // akhir loop
					$dt->Close(); // tutup recordset jika sudah selesai
				} else { // jika jumlah record tidak lebih besar dari nol
					$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>"; // tampilkan pesan tidak ada record
				} 
				$this->ExportDoc->Text .= "
				</table>
				(* Lampiran foto copy ijasah S 1/S 2/S 3)
				<br>
				<br>
				<br>
				<table width='100%' border='1' id='tbrw' bordercolor='black' cellpadding='5'>
				<tr>
					<td width='23%' colspan='2' rowspan='3'><img src='images/dblogo.jpg'></img></td>
					<td width='35%' colspan='4' rowspan='3' style='text-align:center'><h4>BIODATA INSTRUKTUR</h4></td>
					<td width='17%' colspan='2'>KODE INSTRUKTUR</td>
					<td width='25%' colspan='2'>".strtoupper($this->kdinstruktur->ViewValue)."</td>
				</tr>
				<tr>
					<td colspan='2'>REVISI /TGL. TERBIT</td>
					<td colspan='2'>".$this->revisi->ViewValue."/".CSFormatTanggal(date('d-m-Y', strtotime($this->tglterbit->CurrentValue)), false, false, false)."</td>
				</tr>
				<tr>
					<td colspan='2'>HALAMAN</td>
					<td colspan='2'>2 DARI 3</td>
				</tr></table>
				<br>
				<h4>II. PENGALAMAN TRAINING</h4>
				<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
				<tr>
					<td width='5%' align='center'><b>NO</b></td>
					<td width='55%' align='center'><b>UNIT/INSTANSI/PERUSAHAAN</b></td>
					<td width='25%' align='center'><b>TEMPAT</b></td>
					<td width='15%' align='center'><b>TAHUN</b></td>
				</tr>";
				$no=1;
				$dt2 = Execute("SELECT training,tempat,tahun FROM `t_rwtraining` WHERE bioid = ".$this->bioid->CurrentValue); 
				if ($dt2->RecordCount() >0) {
					$dt2->MoveFirst(); 
					while (!$dt2->EOF) { 
					$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$dt2->fields("training")."</td><td align='center'>".$dt2->fields("tempat")."</td><td align='center'>".$dt2->fields("tahun")."</td></tr>"; 
					$no++;
					$dt2->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
					} // akhir loop
					$dt2->Close(); // tutup recordset jika sudah selesai
				} else { // jika jumlah record tidak lebih besar dari nol
					$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>"; // tampilkan pesan tidak ada record
				} 
				$this->ExportDoc->Text .= "
				</table>
				(* Lampirkan foto copy Sertifikat training)
				<br>
				<br>
				<br>
				<h4>III. PENGALAMAN KERJA</h4>
				<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
				<tr>
					<td width='5%' align='center'><b>NO</b></td>
					<td width='55%' align='center'><b>UNIT/INSTANSI/PERUSAHAAN</b></td>
					<td width='25%' align='center'><b>JABATAN</b></td>
					<td width='15%' align='center'><b>TAHUN</b></td>
				</tr>";
				$no=1;
				$dt3 = Execute("SELECT perusahaan,jabatan,mulai,hingga FROM `t_rwpekerjaan` WHERE bioid = ".$this->bioid->CurrentValue); 
				if ($dt3->RecordCount() >0) {
					$dt3->MoveFirst(); 
					while (!$dt3->EOF) { 
					$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$dt3->fields("perusahaan")."</td><td align='center'>".$dt3->fields("jabatan")."</td><td align='center'>".$dt3->fields("mulai")."-".$dt3->fields("hingga")."</td></tr>"; 
					$no++;
					$dt3->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
					} // akhir loop
					$dt3->Close(); // tutup recordset jika sudah selesai
				} else { // jika jumlah record tidak lebih besar dari nol
					$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>"; // tampilkan pesan tidak ada record
				} 
				$this->ExportDoc->Text .= "
				</table>
				<br>
				<br>
				<table width='100%' border='1' id='tbrw' bordercolor='black' cellpadding='5'>
				<tr>
					<td width='23%' colspan='2' rowspan='3'><img src='images/dblogo.jpg'></img></td>
					<td width='35%' colspan='4' rowspan='3' style='text-align:center'><h4>BIODATA INSTRUKTUR</h4></td>
					<td width='17%' colspan='2'>KODE INSTRUKTUR</td>
					<td width='25%' colspan='2'>".strtoupper($this->kdinstruktur->ViewValue)."</td>
				</tr>
				<tr>
					<td colspan='2'>REVISI /TGL. TERBIT</td>
					<td colspan='2'>".$this->revisi->ViewValue."/".CSFormatTanggal(date('d-m-Y', strtotime($this->tglterbit->CurrentValue)), false, false, false)."</td>
				</tr>
				<tr>
					<td colspan='2'>HALAMAN</td>
					<td colspan='2'>3 DARI 3</td>
				</tr></table>
				<br>
				<h4>IV. PENGALAMAN MENGAJAR</h4>
				<table width='100%'  border='3' bordercolor='black' cellpadding='5'>
				<tr>
					<td width='5%' align='center'><b>NO</b></td>
					<td width='55%' align='center'><b>TOPIK</b></td>
					<td width='25%' align='center'><b>TEMPAT</b></td>
					<td width='15%' align='center'><b>TAHUN</b></td>
				</tr>";
				$no=1;
				$dt5 = Execute("SELECT t_kurikulum.kurikulum,YEAR(t_pelatihan.tawal) tahun, t_kota.kota
	FROM t_pelatihan INNER JOIN
	t_jadwalpel ON t_pelatihan.idpelat = t_jadwalpel.idpelat AND t_pelatihan.kdjudul = t_jadwalpel.kdjudul INNER JOIN
	t_kurikulum ON t_jadwalpel.kurikulumid = t_kurikulum.kurikulumid INNER JOIN
	t_kota ON t_kota.kdkota = t_pelatihan.kdkota
	WHERE t_jadwalpel.instruktur > 0 AND t_jadwalpel.instruktur = ".$this->bioid->CurrentValue); 
				if ($dt5->RecordCount() >0) {
					$dt5->MoveFirst(); 
					while (!$dt5->EOF) { 
					$this->ExportDoc->Text .= "<tr><td align='center'>".$no."</td><td>".$dt5->fields("kurikulum")."</td><td align='center'>".str_replace(array('Kota ', 'Kab. ', ' Barat'), array('', '', ''),$dt5->fields("kota"))."</td><td align='center'>".$dt5->fields("tahun")."</td></tr>"; 
					$no++;
					$dt5->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
					} // akhir loop
					$dt5->Close(); // tutup recordset jika sudah selesai
				} else { // jika jumlah record tidak lebih besar dari nol
					$this->ExportDoc->Text .= "<tr><td colspan='4'></td></tr>"; // tampilkan pesan tidak ada record
				} 
				$this->ExportDoc->Text .= "
				</table>
				<br><br><br>
				";
			} //tutup word
			} // tutup get h
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		if(@$_GET["h"] == "rpt1"){
			$this->ExportDoc->Text .= "";
		} else if (@$_GET["h"] == "rpt2"){
			$this->ExportDoc->Text .= "<style></style>";
		$this->ExportDoc->Text .= "<tr><td class='tdt'></td><td class='tdt'></td><td class='tdt'></td><td class='tdt'></td><td class='tdt'></td></tr>";
		$this->ExportDoc->Text .= "<tr><td colspan='2' class='tdn' align='center'><br><br>Pelaksana,<br><br><br><br><br>Nama_Lengkap</td><td colspan='3' class='tdn' align='center'>Jakarta, &nbsp;&nbsp; Bulan Tahun<br>Mengetahui/Menyetujui<br>Kepala Seksi Penyelenggaraan,<br><br><br><br><br>Nama_Lengkap</td></table>";
			unset($_SESSION["nom"]);
		}  else {
		}

		//echo $this->ExportDoc->Text; exit();
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