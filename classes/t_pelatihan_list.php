<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_pelatihan_list extends t_pelatihan
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_pelatihan';

	// Page object name
	public $PageObjName = "t_pelatihan_list";

	// Grid form hidden field names
	public $FormName = "ft_pelatihanlist";
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

		// Table object (t_pelatihan)
		if (!isset($GLOBALS["t_pelatihan"]) || get_class($GLOBALS["t_pelatihan"]) == PROJECT_NAMESPACE . "t_pelatihan") {
			$GLOBALS["t_pelatihan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_pelatihan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "t_pelatihanadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "t_pelatihandelete.php";
		$this->MultiUpdateUrl = "t_pelatihanupdate.php";

		// Table object (t_judul)
		if (!isset($GLOBALS['t_judul']))
			$GLOBALS['t_judul'] = new t_judul();

		// Table object (t_kota)
		if (!isset($GLOBALS['t_kota']))
			$GLOBALS['t_kota'] = new t_kota();

		// Table object (t_prop)
		if (!isset($GLOBALS['t_prop']))
			$GLOBALS['t_prop'] = new t_prop();

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_pelatihan');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ft_pelatihanlistsrch";

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
		global $t_pelatihan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_pelatihan);
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->idpelat->Visible = FALSE;
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
	public $cv_historipeserta_Count;
	public $cv_historiinstruktur_Count;
	public $t_jadwalpel_Count;
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
		$this->idpelat->Visible = FALSE;
		$this->kdpelat->Visible = FALSE;
		$this->kdjudul->setVisibility();
		$this->kdkursil->Visible = FALSE;
		$this->revisi->Visible = FALSE;
		$this->tgl_terbit->Visible = FALSE;
		$this->pilihan_iso->Visible = FALSE;
		$this->tawal->setVisibility();
		$this->takhir->setVisibility();
		$this->tglpel->setVisibility();
		$this->kdprop->Visible = FALSE;
		$this->kdkota->Visible = FALSE;
		$this->kdkec->Visible = FALSE;
		$this->ketua->Visible = FALSE;
		$this->sekretaris->Visible = FALSE;
		$this->bendahara->Visible = FALSE;
		$this->anggota2->Visible = FALSE;
		$this->widyaiswara->Visible = FALSE;
		$this->jenisevaluasi->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->user_created_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->user_updated_by->Visible = FALSE;
		$this->jenispel->setVisibility();
		$this->kdkategori->Visible = FALSE;
		$this->kerjasama->setVisibility();
		$this->dana->Visible = FALSE;
		$this->biaya->setVisibility();
		$this->coachingprogr->setVisibility();
		$this->area->setVisibility();
		$this->periode_awal->setVisibility();
		$this->periode_akhir->setVisibility();
		$this->tahapan->setVisibility();
		$this->namaberkas->setVisibility();
		$this->instruktur->setVisibility();
		$this->nmou->Visible = FALSE;
		$this->nmou2->Visible = FALSE;
		$this->statuspel->Visible = FALSE;
		$this->ket->Visible = FALSE;
		$this->tempat->setVisibility();
		$this->jpeserta->setVisibility();
		$this->jml_hari->Visible = FALSE;
		$this->targetpes->setVisibility();
		$this->target_peserta->Visible = FALSE;
		$this->durasi1->Visible = FALSE;
		$this->durasi2->Visible = FALSE;
		$this->rid->Visible = FALSE;
		$this->real_peserta->Visible = FALSE;
		$this->independen->Visible = FALSE;
		$this->swasta_k->Visible = FALSE;
		$this->swasta_m->Visible = FALSE;
		$this->swasta_b->Visible = FALSE;
		$this->bumn->Visible = FALSE;
		$this->koperasi->Visible = FALSE;
		$this->pns->Visible = FALSE;
		$this->pt_dosen->Visible = FALSE;
		$this->pt_mhs->Visible = FALSE;
		$this->jk_l->Visible = FALSE;
		$this->jk_p->Visible = FALSE;
		$this->usia_k45->Visible = FALSE;
		$this->usia_b45->Visible = FALSE;
		$this->produk->Visible = FALSE;
		$this->bbio->Visible = FALSE;
		$this->bbio2->Visible = FALSE;
		$this->bbio3->Visible = FALSE;
		$this->bbio4->Visible = FALSE;
		$this->bbio5->Visible = FALSE;
		$this->Tahun->setVisibility();
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
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->kdkursil);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);
		$this->setupLookupOptions($this->kdkec);
		$this->setupLookupOptions($this->ketua);
		$this->setupLookupOptions($this->sekretaris);
		$this->setupLookupOptions($this->bendahara);
		$this->setupLookupOptions($this->anggota2);
		$this->setupLookupOptions($this->widyaiswara);
		$this->setupLookupOptions($this->kdkategori);
		$this->setupLookupOptions($this->kerjasama);
		$this->setupLookupOptions($this->tahapan);

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
		$filterList = Concat($filterList, $this->kdpelat->AdvancedSearch->toJson(), ","); // Field kdpelat
		$filterList = Concat($filterList, $this->kdjudul->AdvancedSearch->toJson(), ","); // Field kdjudul
		$filterList = Concat($filterList, $this->kdkursil->AdvancedSearch->toJson(), ","); // Field kdkursil
		$filterList = Concat($filterList, $this->revisi->AdvancedSearch->toJson(), ","); // Field revisi
		$filterList = Concat($filterList, $this->tgl_terbit->AdvancedSearch->toJson(), ","); // Field tgl_terbit
		$filterList = Concat($filterList, $this->pilihan_iso->AdvancedSearch->toJson(), ","); // Field pilihan_iso
		$filterList = Concat($filterList, $this->tawal->AdvancedSearch->toJson(), ","); // Field tawal
		$filterList = Concat($filterList, $this->takhir->AdvancedSearch->toJson(), ","); // Field takhir
		$filterList = Concat($filterList, $this->tglpel->AdvancedSearch->toJson(), ","); // Field tglpel
		$filterList = Concat($filterList, $this->kdprop->AdvancedSearch->toJson(), ","); // Field kdprop
		$filterList = Concat($filterList, $this->kdkota->AdvancedSearch->toJson(), ","); // Field kdkota
		$filterList = Concat($filterList, $this->kdkec->AdvancedSearch->toJson(), ","); // Field kdkec
		$filterList = Concat($filterList, $this->ketua->AdvancedSearch->toJson(), ","); // Field ketua
		$filterList = Concat($filterList, $this->sekretaris->AdvancedSearch->toJson(), ","); // Field sekretaris
		$filterList = Concat($filterList, $this->bendahara->AdvancedSearch->toJson(), ","); // Field bendahara
		$filterList = Concat($filterList, $this->anggota2->AdvancedSearch->toJson(), ","); // Field anggota2
		$filterList = Concat($filterList, $this->widyaiswara->AdvancedSearch->toJson(), ","); // Field widyaiswara
		$filterList = Concat($filterList, $this->jenisevaluasi->AdvancedSearch->toJson(), ","); // Field jenisevaluasi
		$filterList = Concat($filterList, $this->jenispel->AdvancedSearch->toJson(), ","); // Field jenispel
		$filterList = Concat($filterList, $this->kdkategori->AdvancedSearch->toJson(), ","); // Field kdkategori
		$filterList = Concat($filterList, $this->kerjasama->AdvancedSearch->toJson(), ","); // Field kerjasama
		$filterList = Concat($filterList, $this->biaya->AdvancedSearch->toJson(), ","); // Field biaya
		$filterList = Concat($filterList, $this->coachingprogr->AdvancedSearch->toJson(), ","); // Field coachingprogr
		$filterList = Concat($filterList, $this->area->AdvancedSearch->toJson(), ","); // Field area
		$filterList = Concat($filterList, $this->periode_awal->AdvancedSearch->toJson(), ","); // Field periode_awal
		$filterList = Concat($filterList, $this->periode_akhir->AdvancedSearch->toJson(), ","); // Field periode_akhir
		$filterList = Concat($filterList, $this->tahapan->AdvancedSearch->toJson(), ","); // Field tahapan
		$filterList = Concat($filterList, $this->namaberkas->AdvancedSearch->toJson(), ","); // Field namaberkas
		$filterList = Concat($filterList, $this->instruktur->AdvancedSearch->toJson(), ","); // Field instruktur
		$filterList = Concat($filterList, $this->statuspel->AdvancedSearch->toJson(), ","); // Field statuspel
		$filterList = Concat($filterList, $this->ket->AdvancedSearch->toJson(), ","); // Field ket
		$filterList = Concat($filterList, $this->jpeserta->AdvancedSearch->toJson(), ","); // Field jpeserta
		$filterList = Concat($filterList, $this->Tahun->AdvancedSearch->toJson(), ","); // Field Tahun

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
			$UserProfile->setSearchFilters(CurrentUserName(), "ft_pelatihanlistsrch", $filters);
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

		// Field kdkursil
		$this->kdkursil->AdvancedSearch->SearchValue = @$filter["x_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchOperator = @$filter["z_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchCondition = @$filter["v_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchValue2 = @$filter["y_kdkursil"];
		$this->kdkursil->AdvancedSearch->SearchOperator2 = @$filter["w_kdkursil"];
		$this->kdkursil->AdvancedSearch->save();

		// Field revisi
		$this->revisi->AdvancedSearch->SearchValue = @$filter["x_revisi"];
		$this->revisi->AdvancedSearch->SearchOperator = @$filter["z_revisi"];
		$this->revisi->AdvancedSearch->SearchCondition = @$filter["v_revisi"];
		$this->revisi->AdvancedSearch->SearchValue2 = @$filter["y_revisi"];
		$this->revisi->AdvancedSearch->SearchOperator2 = @$filter["w_revisi"];
		$this->revisi->AdvancedSearch->save();

		// Field tgl_terbit
		$this->tgl_terbit->AdvancedSearch->SearchValue = @$filter["x_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->SearchOperator = @$filter["z_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->SearchCondition = @$filter["v_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->SearchValue2 = @$filter["y_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_terbit"];
		$this->tgl_terbit->AdvancedSearch->save();

		// Field pilihan_iso
		$this->pilihan_iso->AdvancedSearch->SearchValue = @$filter["x_pilihan_iso"];
		$this->pilihan_iso->AdvancedSearch->SearchOperator = @$filter["z_pilihan_iso"];
		$this->pilihan_iso->AdvancedSearch->SearchCondition = @$filter["v_pilihan_iso"];
		$this->pilihan_iso->AdvancedSearch->SearchValue2 = @$filter["y_pilihan_iso"];
		$this->pilihan_iso->AdvancedSearch->SearchOperator2 = @$filter["w_pilihan_iso"];
		$this->pilihan_iso->AdvancedSearch->save();

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

		// Field tglpel
		$this->tglpel->AdvancedSearch->SearchValue = @$filter["x_tglpel"];
		$this->tglpel->AdvancedSearch->SearchOperator = @$filter["z_tglpel"];
		$this->tglpel->AdvancedSearch->SearchCondition = @$filter["v_tglpel"];
		$this->tglpel->AdvancedSearch->SearchValue2 = @$filter["y_tglpel"];
		$this->tglpel->AdvancedSearch->SearchOperator2 = @$filter["w_tglpel"];
		$this->tglpel->AdvancedSearch->save();

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

		// Field jenisevaluasi
		$this->jenisevaluasi->AdvancedSearch->SearchValue = @$filter["x_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->SearchOperator = @$filter["z_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->SearchCondition = @$filter["v_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->SearchValue2 = @$filter["y_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->SearchOperator2 = @$filter["w_jenisevaluasi"];
		$this->jenisevaluasi->AdvancedSearch->save();

		// Field jenispel
		$this->jenispel->AdvancedSearch->SearchValue = @$filter["x_jenispel"];
		$this->jenispel->AdvancedSearch->SearchOperator = @$filter["z_jenispel"];
		$this->jenispel->AdvancedSearch->SearchCondition = @$filter["v_jenispel"];
		$this->jenispel->AdvancedSearch->SearchValue2 = @$filter["y_jenispel"];
		$this->jenispel->AdvancedSearch->SearchOperator2 = @$filter["w_jenispel"];
		$this->jenispel->AdvancedSearch->save();

		// Field kdkategori
		$this->kdkategori->AdvancedSearch->SearchValue = @$filter["x_kdkategori"];
		$this->kdkategori->AdvancedSearch->SearchOperator = @$filter["z_kdkategori"];
		$this->kdkategori->AdvancedSearch->SearchCondition = @$filter["v_kdkategori"];
		$this->kdkategori->AdvancedSearch->SearchValue2 = @$filter["y_kdkategori"];
		$this->kdkategori->AdvancedSearch->SearchOperator2 = @$filter["w_kdkategori"];
		$this->kdkategori->AdvancedSearch->save();

		// Field kerjasama
		$this->kerjasama->AdvancedSearch->SearchValue = @$filter["x_kerjasama"];
		$this->kerjasama->AdvancedSearch->SearchOperator = @$filter["z_kerjasama"];
		$this->kerjasama->AdvancedSearch->SearchCondition = @$filter["v_kerjasama"];
		$this->kerjasama->AdvancedSearch->SearchValue2 = @$filter["y_kerjasama"];
		$this->kerjasama->AdvancedSearch->SearchOperator2 = @$filter["w_kerjasama"];
		$this->kerjasama->AdvancedSearch->save();

		// Field biaya
		$this->biaya->AdvancedSearch->SearchValue = @$filter["x_biaya"];
		$this->biaya->AdvancedSearch->SearchOperator = @$filter["z_biaya"];
		$this->biaya->AdvancedSearch->SearchCondition = @$filter["v_biaya"];
		$this->biaya->AdvancedSearch->SearchValue2 = @$filter["y_biaya"];
		$this->biaya->AdvancedSearch->SearchOperator2 = @$filter["w_biaya"];
		$this->biaya->AdvancedSearch->save();

		// Field coachingprogr
		$this->coachingprogr->AdvancedSearch->SearchValue = @$filter["x_coachingprogr"];
		$this->coachingprogr->AdvancedSearch->SearchOperator = @$filter["z_coachingprogr"];
		$this->coachingprogr->AdvancedSearch->SearchCondition = @$filter["v_coachingprogr"];
		$this->coachingprogr->AdvancedSearch->SearchValue2 = @$filter["y_coachingprogr"];
		$this->coachingprogr->AdvancedSearch->SearchOperator2 = @$filter["w_coachingprogr"];
		$this->coachingprogr->AdvancedSearch->save();

		// Field area
		$this->area->AdvancedSearch->SearchValue = @$filter["x_area"];
		$this->area->AdvancedSearch->SearchOperator = @$filter["z_area"];
		$this->area->AdvancedSearch->SearchCondition = @$filter["v_area"];
		$this->area->AdvancedSearch->SearchValue2 = @$filter["y_area"];
		$this->area->AdvancedSearch->SearchOperator2 = @$filter["w_area"];
		$this->area->AdvancedSearch->save();

		// Field periode_awal
		$this->periode_awal->AdvancedSearch->SearchValue = @$filter["x_periode_awal"];
		$this->periode_awal->AdvancedSearch->SearchOperator = @$filter["z_periode_awal"];
		$this->periode_awal->AdvancedSearch->SearchCondition = @$filter["v_periode_awal"];
		$this->periode_awal->AdvancedSearch->SearchValue2 = @$filter["y_periode_awal"];
		$this->periode_awal->AdvancedSearch->SearchOperator2 = @$filter["w_periode_awal"];
		$this->periode_awal->AdvancedSearch->save();

		// Field periode_akhir
		$this->periode_akhir->AdvancedSearch->SearchValue = @$filter["x_periode_akhir"];
		$this->periode_akhir->AdvancedSearch->SearchOperator = @$filter["z_periode_akhir"];
		$this->periode_akhir->AdvancedSearch->SearchCondition = @$filter["v_periode_akhir"];
		$this->periode_akhir->AdvancedSearch->SearchValue2 = @$filter["y_periode_akhir"];
		$this->periode_akhir->AdvancedSearch->SearchOperator2 = @$filter["w_periode_akhir"];
		$this->periode_akhir->AdvancedSearch->save();

		// Field tahapan
		$this->tahapan->AdvancedSearch->SearchValue = @$filter["x_tahapan"];
		$this->tahapan->AdvancedSearch->SearchOperator = @$filter["z_tahapan"];
		$this->tahapan->AdvancedSearch->SearchCondition = @$filter["v_tahapan"];
		$this->tahapan->AdvancedSearch->SearchValue2 = @$filter["y_tahapan"];
		$this->tahapan->AdvancedSearch->SearchOperator2 = @$filter["w_tahapan"];
		$this->tahapan->AdvancedSearch->save();

		// Field namaberkas
		$this->namaberkas->AdvancedSearch->SearchValue = @$filter["x_namaberkas"];
		$this->namaberkas->AdvancedSearch->SearchOperator = @$filter["z_namaberkas"];
		$this->namaberkas->AdvancedSearch->SearchCondition = @$filter["v_namaberkas"];
		$this->namaberkas->AdvancedSearch->SearchValue2 = @$filter["y_namaberkas"];
		$this->namaberkas->AdvancedSearch->SearchOperator2 = @$filter["w_namaberkas"];
		$this->namaberkas->AdvancedSearch->save();

		// Field instruktur
		$this->instruktur->AdvancedSearch->SearchValue = @$filter["x_instruktur"];
		$this->instruktur->AdvancedSearch->SearchOperator = @$filter["z_instruktur"];
		$this->instruktur->AdvancedSearch->SearchCondition = @$filter["v_instruktur"];
		$this->instruktur->AdvancedSearch->SearchValue2 = @$filter["y_instruktur"];
		$this->instruktur->AdvancedSearch->SearchOperator2 = @$filter["w_instruktur"];
		$this->instruktur->AdvancedSearch->save();

		// Field statuspel
		$this->statuspel->AdvancedSearch->SearchValue = @$filter["x_statuspel"];
		$this->statuspel->AdvancedSearch->SearchOperator = @$filter["z_statuspel"];
		$this->statuspel->AdvancedSearch->SearchCondition = @$filter["v_statuspel"];
		$this->statuspel->AdvancedSearch->SearchValue2 = @$filter["y_statuspel"];
		$this->statuspel->AdvancedSearch->SearchOperator2 = @$filter["w_statuspel"];
		$this->statuspel->AdvancedSearch->save();

		// Field ket
		$this->ket->AdvancedSearch->SearchValue = @$filter["x_ket"];
		$this->ket->AdvancedSearch->SearchOperator = @$filter["z_ket"];
		$this->ket->AdvancedSearch->SearchCondition = @$filter["v_ket"];
		$this->ket->AdvancedSearch->SearchValue2 = @$filter["y_ket"];
		$this->ket->AdvancedSearch->SearchOperator2 = @$filter["w_ket"];
		$this->ket->AdvancedSearch->save();

		// Field jpeserta
		$this->jpeserta->AdvancedSearch->SearchValue = @$filter["x_jpeserta"];
		$this->jpeserta->AdvancedSearch->SearchOperator = @$filter["z_jpeserta"];
		$this->jpeserta->AdvancedSearch->SearchCondition = @$filter["v_jpeserta"];
		$this->jpeserta->AdvancedSearch->SearchValue2 = @$filter["y_jpeserta"];
		$this->jpeserta->AdvancedSearch->SearchOperator2 = @$filter["w_jpeserta"];
		$this->jpeserta->AdvancedSearch->save();

		// Field Tahun
		$this->Tahun->AdvancedSearch->SearchValue = @$filter["x_Tahun"];
		$this->Tahun->AdvancedSearch->SearchOperator = @$filter["z_Tahun"];
		$this->Tahun->AdvancedSearch->SearchCondition = @$filter["v_Tahun"];
		$this->Tahun->AdvancedSearch->SearchValue2 = @$filter["y_Tahun"];
		$this->Tahun->AdvancedSearch->SearchOperator2 = @$filter["w_Tahun"];
		$this->Tahun->AdvancedSearch->save();
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->kdpelat, $default, FALSE); // kdpelat
		$this->buildSearchSql($where, $this->kdjudul, $default, FALSE); // kdjudul
		$this->buildSearchSql($where, $this->kdkursil, $default, FALSE); // kdkursil
		$this->buildSearchSql($where, $this->revisi, $default, FALSE); // revisi
		$this->buildSearchSql($where, $this->tgl_terbit, $default, FALSE); // tgl_terbit
		$this->buildSearchSql($where, $this->pilihan_iso, $default, FALSE); // pilihan_iso
		$this->buildSearchSql($where, $this->tawal, $default, FALSE); // tawal
		$this->buildSearchSql($where, $this->takhir, $default, FALSE); // takhir
		$this->buildSearchSql($where, $this->tglpel, $default, FALSE); // tglpel
		$this->buildSearchSql($where, $this->kdprop, $default, FALSE); // kdprop
		$this->buildSearchSql($where, $this->kdkota, $default, FALSE); // kdkota
		$this->buildSearchSql($where, $this->kdkec, $default, FALSE); // kdkec
		$this->buildSearchSql($where, $this->ketua, $default, FALSE); // ketua
		$this->buildSearchSql($where, $this->sekretaris, $default, FALSE); // sekretaris
		$this->buildSearchSql($where, $this->bendahara, $default, FALSE); // bendahara
		$this->buildSearchSql($where, $this->anggota2, $default, FALSE); // anggota2
		$this->buildSearchSql($where, $this->widyaiswara, $default, FALSE); // widyaiswara
		$this->buildSearchSql($where, $this->jenisevaluasi, $default, FALSE); // jenisevaluasi
		$this->buildSearchSql($where, $this->jenispel, $default, FALSE); // jenispel
		$this->buildSearchSql($where, $this->kdkategori, $default, FALSE); // kdkategori
		$this->buildSearchSql($where, $this->kerjasama, $default, FALSE); // kerjasama
		$this->buildSearchSql($where, $this->biaya, $default, FALSE); // biaya
		$this->buildSearchSql($where, $this->coachingprogr, $default, FALSE); // coachingprogr
		$this->buildSearchSql($where, $this->area, $default, FALSE); // area
		$this->buildSearchSql($where, $this->periode_awal, $default, FALSE); // periode_awal
		$this->buildSearchSql($where, $this->periode_akhir, $default, FALSE); // periode_akhir
		$this->buildSearchSql($where, $this->tahapan, $default, FALSE); // tahapan
		$this->buildSearchSql($where, $this->namaberkas, $default, FALSE); // namaberkas
		$this->buildSearchSql($where, $this->instruktur, $default, FALSE); // instruktur
		$this->buildSearchSql($where, $this->statuspel, $default, FALSE); // statuspel
		$this->buildSearchSql($where, $this->ket, $default, FALSE); // ket
		$this->buildSearchSql($where, $this->jpeserta, $default, FALSE); // jpeserta
		$this->buildSearchSql($where, $this->Tahun, $default, FALSE); // Tahun

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->kdpelat->AdvancedSearch->save(); // kdpelat
			$this->kdjudul->AdvancedSearch->save(); // kdjudul
			$this->kdkursil->AdvancedSearch->save(); // kdkursil
			$this->revisi->AdvancedSearch->save(); // revisi
			$this->tgl_terbit->AdvancedSearch->save(); // tgl_terbit
			$this->pilihan_iso->AdvancedSearch->save(); // pilihan_iso
			$this->tawal->AdvancedSearch->save(); // tawal
			$this->takhir->AdvancedSearch->save(); // takhir
			$this->tglpel->AdvancedSearch->save(); // tglpel
			$this->kdprop->AdvancedSearch->save(); // kdprop
			$this->kdkota->AdvancedSearch->save(); // kdkota
			$this->kdkec->AdvancedSearch->save(); // kdkec
			$this->ketua->AdvancedSearch->save(); // ketua
			$this->sekretaris->AdvancedSearch->save(); // sekretaris
			$this->bendahara->AdvancedSearch->save(); // bendahara
			$this->anggota2->AdvancedSearch->save(); // anggota2
			$this->widyaiswara->AdvancedSearch->save(); // widyaiswara
			$this->jenisevaluasi->AdvancedSearch->save(); // jenisevaluasi
			$this->jenispel->AdvancedSearch->save(); // jenispel
			$this->kdkategori->AdvancedSearch->save(); // kdkategori
			$this->kerjasama->AdvancedSearch->save(); // kerjasama
			$this->biaya->AdvancedSearch->save(); // biaya
			$this->coachingprogr->AdvancedSearch->save(); // coachingprogr
			$this->area->AdvancedSearch->save(); // area
			$this->periode_awal->AdvancedSearch->save(); // periode_awal
			$this->periode_akhir->AdvancedSearch->save(); // periode_akhir
			$this->tahapan->AdvancedSearch->save(); // tahapan
			$this->namaberkas->AdvancedSearch->save(); // namaberkas
			$this->instruktur->AdvancedSearch->save(); // instruktur
			$this->statuspel->AdvancedSearch->save(); // statuspel
			$this->ket->AdvancedSearch->save(); // ket
			$this->jpeserta->AdvancedSearch->save(); // jpeserta
			$this->Tahun->AdvancedSearch->save(); // Tahun
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
		if ($this->kdpelat->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdjudul->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkursil->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->revisi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tgl_terbit->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->pilihan_iso->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tawal->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->takhir->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tglpel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdprop->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkota->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkec->AdvancedSearch->issetSession())
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
		if ($this->jenisevaluasi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jenispel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kdkategori->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kerjasama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->biaya->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->coachingprogr->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->area->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->periode_awal->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->periode_akhir->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tahapan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->namaberkas->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->instruktur->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->statuspel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ket->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jpeserta->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Tahun->AdvancedSearch->issetSession())
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
		$this->kdpelat->AdvancedSearch->unsetSession();
		$this->kdjudul->AdvancedSearch->unsetSession();
		$this->kdkursil->AdvancedSearch->unsetSession();
		$this->revisi->AdvancedSearch->unsetSession();
		$this->tgl_terbit->AdvancedSearch->unsetSession();
		$this->pilihan_iso->AdvancedSearch->unsetSession();
		$this->tawal->AdvancedSearch->unsetSession();
		$this->takhir->AdvancedSearch->unsetSession();
		$this->tglpel->AdvancedSearch->unsetSession();
		$this->kdprop->AdvancedSearch->unsetSession();
		$this->kdkota->AdvancedSearch->unsetSession();
		$this->kdkec->AdvancedSearch->unsetSession();
		$this->ketua->AdvancedSearch->unsetSession();
		$this->sekretaris->AdvancedSearch->unsetSession();
		$this->bendahara->AdvancedSearch->unsetSession();
		$this->anggota2->AdvancedSearch->unsetSession();
		$this->widyaiswara->AdvancedSearch->unsetSession();
		$this->jenisevaluasi->AdvancedSearch->unsetSession();
		$this->jenispel->AdvancedSearch->unsetSession();
		$this->kdkategori->AdvancedSearch->unsetSession();
		$this->kerjasama->AdvancedSearch->unsetSession();
		$this->biaya->AdvancedSearch->unsetSession();
		$this->coachingprogr->AdvancedSearch->unsetSession();
		$this->area->AdvancedSearch->unsetSession();
		$this->periode_awal->AdvancedSearch->unsetSession();
		$this->periode_akhir->AdvancedSearch->unsetSession();
		$this->tahapan->AdvancedSearch->unsetSession();
		$this->namaberkas->AdvancedSearch->unsetSession();
		$this->instruktur->AdvancedSearch->unsetSession();
		$this->statuspel->AdvancedSearch->unsetSession();
		$this->ket->AdvancedSearch->unsetSession();
		$this->jpeserta->AdvancedSearch->unsetSession();
		$this->Tahun->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->kdpelat->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->kdkursil->AdvancedSearch->load();
		$this->revisi->AdvancedSearch->load();
		$this->tgl_terbit->AdvancedSearch->load();
		$this->pilihan_iso->AdvancedSearch->load();
		$this->tawal->AdvancedSearch->load();
		$this->takhir->AdvancedSearch->load();
		$this->tglpel->AdvancedSearch->load();
		$this->kdprop->AdvancedSearch->load();
		$this->kdkota->AdvancedSearch->load();
		$this->kdkec->AdvancedSearch->load();
		$this->ketua->AdvancedSearch->load();
		$this->sekretaris->AdvancedSearch->load();
		$this->bendahara->AdvancedSearch->load();
		$this->anggota2->AdvancedSearch->load();
		$this->widyaiswara->AdvancedSearch->load();
		$this->jenisevaluasi->AdvancedSearch->load();
		$this->jenispel->AdvancedSearch->load();
		$this->kdkategori->AdvancedSearch->load();
		$this->kerjasama->AdvancedSearch->load();
		$this->biaya->AdvancedSearch->load();
		$this->coachingprogr->AdvancedSearch->load();
		$this->area->AdvancedSearch->load();
		$this->periode_awal->AdvancedSearch->load();
		$this->periode_akhir->AdvancedSearch->load();
		$this->tahapan->AdvancedSearch->load();
		$this->namaberkas->AdvancedSearch->load();
		$this->instruktur->AdvancedSearch->load();
		$this->statuspel->AdvancedSearch->load();
		$this->ket->AdvancedSearch->load();
		$this->jpeserta->AdvancedSearch->load();
		$this->Tahun->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->kdjudul); // kdjudul
			$this->updateSort($this->tawal); // tawal
			$this->updateSort($this->takhir); // takhir
			$this->updateSort($this->tglpel); // tglpel
			$this->updateSort($this->jenispel); // jenispel
			$this->updateSort($this->kerjasama); // kerjasama
			$this->updateSort($this->biaya); // biaya
			$this->updateSort($this->coachingprogr); // coachingprogr
			$this->updateSort($this->area); // area
			$this->updateSort($this->periode_awal); // periode_awal
			$this->updateSort($this->periode_akhir); // periode_akhir
			$this->updateSort($this->tahapan); // tahapan
			$this->updateSort($this->namaberkas); // namaberkas
			$this->updateSort($this->instruktur); // instruktur
			$this->updateSort($this->tempat); // tempat
			$this->updateSort($this->jpeserta); // jpeserta
			$this->updateSort($this->targetpes); // targetpes
			$this->updateSort($this->Tahun); // Tahun
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->kdjudul->setSessionValue("");
				$this->kdkota->setSessionValue("");
				$this->kdprop->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
				$this->kdjudul->setSort("");
				$this->tawal->setSort("");
				$this->takhir->setSort("");
				$this->tglpel->setSort("");
				$this->jenispel->setSort("");
				$this->kerjasama->setSort("");
				$this->biaya->setSort("");
				$this->coachingprogr->setSort("");
				$this->area->setSort("");
				$this->periode_awal->setSort("");
				$this->periode_akhir->setSort("");
				$this->tahapan->setSort("");
				$this->namaberkas->setSort("");
				$this->instruktur->setSort("");
				$this->tempat->setSort("");
				$this->jpeserta->setSort("");
				$this->targetpes->setSort("");
				$this->Tahun->setSort("");
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

		// "detail_cv_historipeserta"
		$item = &$this->ListOptions->add("detail_cv_historipeserta");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'cv_historipeserta') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["cv_historipeserta_grid"]))
			$GLOBALS["cv_historipeserta_grid"] = new cv_historipeserta_grid();

		// "detail_cv_historiinstruktur"
		$item = &$this->ListOptions->add("detail_cv_historiinstruktur");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'cv_historiinstruktur') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["cv_historiinstruktur_grid"]))
			$GLOBALS["cv_historiinstruktur_grid"] = new cv_historiinstruktur_grid();

		// "detail_t_jadwalpel"
		$item = &$this->ListOptions->add("detail_t_jadwalpel");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_jadwalpel') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_jadwalpel_grid"]))
			$GLOBALS["t_jadwalpel_grid"] = new t_jadwalpel_grid();

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
		$pages->add("cv_historipeserta");
		$pages->add("cv_historiinstruktur");
		$pages->add("t_jadwalpel");
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

		// "detail_cv_historipeserta"
		$opt = $this->ListOptions["detail_cv_historipeserta"];
		if ($Security->allowList(CurrentProjectID() . 'cv_historipeserta')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("cv_historipeserta", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->cv_historipeserta_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("cv_historipesertalist.php?" . Config("TABLE_SHOW_MASTER") . "=t_pelatihan&fk_kdpelat=" . urlencode(strval($this->kdpelat->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["cv_historipeserta_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_pelatihan')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=cv_historipeserta");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "cv_historipeserta";
			}
			if ($GLOBALS["cv_historipeserta_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_pelatihan')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=cv_historipeserta");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "cv_historipeserta";
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

		// "detail_cv_historiinstruktur"
		$opt = $this->ListOptions["detail_cv_historiinstruktur"];
		if ($Security->allowList(CurrentProjectID() . 'cv_historiinstruktur')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("cv_historiinstruktur", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->cv_historiinstruktur_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("cv_historiinstrukturlist.php?" . Config("TABLE_SHOW_MASTER") . "=t_pelatihan&fk_kdpelat=" . urlencode(strval($this->kdpelat->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["cv_historiinstruktur_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_pelatihan')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=cv_historiinstruktur");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "cv_historiinstruktur";
			}
			if ($GLOBALS["cv_historiinstruktur_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_pelatihan')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=cv_historiinstruktur");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "cv_historiinstruktur";
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

		// "detail_t_jadwalpel"
		$opt = $this->ListOptions["detail_t_jadwalpel"];
		if ($Security->allowList(CurrentProjectID() . 't_jadwalpel')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_jadwalpel", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->t_jadwalpel_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_jadwalpellist.php?" . Config("TABLE_SHOW_MASTER") . "=t_pelatihan&fk_idpelat=" . urlencode(strval($this->idpelat->CurrentValue)) . "&fk_kdjudul=" . urlencode(strval($this->kdjudul->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_jadwalpel_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_pelatihan')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_jadwalpel");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_jadwalpel";
			}
			if ($GLOBALS["t_jadwalpel_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_pelatihan')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_jadwalpel");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_jadwalpel";
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
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_cv_historipeserta");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=cv_historipeserta");
		if (!isset($GLOBALS["cv_historipeserta"]))
			$GLOBALS["cv_historipeserta"] = new cv_historipeserta();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["cv_historipeserta"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["cv_historipeserta"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_pelatihan') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "cv_historipeserta";
		}
		$item = &$option->add("detailadd_cv_historiinstruktur");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=cv_historiinstruktur");
		if (!isset($GLOBALS["cv_historiinstruktur"]))
			$GLOBALS["cv_historiinstruktur"] = new cv_historiinstruktur();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["cv_historiinstruktur"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["cv_historiinstruktur"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_pelatihan') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "cv_historiinstruktur";
		}
		$item = &$option->add("detailadd_t_jadwalpel");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_jadwalpel");
		if (!isset($GLOBALS["t_jadwalpel"]))
			$GLOBALS["t_jadwalpel"] = new t_jadwalpel();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_jadwalpel"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_jadwalpel"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_pelatihan') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_jadwalpel";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ft_pelatihanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ft_pelatihanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.ft_pelatihanlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// kdkursil
		if (!$this->isAddOrEdit() && $this->kdkursil->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdkursil->AdvancedSearch->SearchValue != "" || $this->kdkursil->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// revisi
		if (!$this->isAddOrEdit() && $this->revisi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->revisi->AdvancedSearch->SearchValue != "" || $this->revisi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tgl_terbit
		if (!$this->isAddOrEdit() && $this->tgl_terbit->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tgl_terbit->AdvancedSearch->SearchValue != "" || $this->tgl_terbit->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// pilihan_iso
		if (!$this->isAddOrEdit() && $this->pilihan_iso->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->pilihan_iso->AdvancedSearch->SearchValue != "" || $this->pilihan_iso->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// tglpel
		if (!$this->isAddOrEdit() && $this->tglpel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tglpel->AdvancedSearch->SearchValue != "" || $this->tglpel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// jenisevaluasi
		if (!$this->isAddOrEdit() && $this->jenisevaluasi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jenisevaluasi->AdvancedSearch->SearchValue != "" || $this->jenisevaluasi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jenispel
		if (!$this->isAddOrEdit() && $this->jenispel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jenispel->AdvancedSearch->SearchValue != "" || $this->jenispel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kdkategori
		if (!$this->isAddOrEdit() && $this->kdkategori->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kdkategori->AdvancedSearch->SearchValue != "" || $this->kdkategori->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kerjasama
		if (!$this->isAddOrEdit() && $this->kerjasama->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kerjasama->AdvancedSearch->SearchValue != "" || $this->kerjasama->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// biaya
		if (!$this->isAddOrEdit() && $this->biaya->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->biaya->AdvancedSearch->SearchValue != "" || $this->biaya->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// coachingprogr
		if (!$this->isAddOrEdit() && $this->coachingprogr->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->coachingprogr->AdvancedSearch->SearchValue != "" || $this->coachingprogr->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// area
		if (!$this->isAddOrEdit() && $this->area->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->area->AdvancedSearch->SearchValue != "" || $this->area->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// periode_awal
		if (!$this->isAddOrEdit() && $this->periode_awal->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->periode_awal->AdvancedSearch->SearchValue != "" || $this->periode_awal->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// periode_akhir
		if (!$this->isAddOrEdit() && $this->periode_akhir->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->periode_akhir->AdvancedSearch->SearchValue != "" || $this->periode_akhir->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tahapan
		if (!$this->isAddOrEdit() && $this->tahapan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tahapan->AdvancedSearch->SearchValue != "" || $this->tahapan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// namaberkas
		if (!$this->isAddOrEdit() && $this->namaberkas->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->namaberkas->AdvancedSearch->SearchValue != "" || $this->namaberkas->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// instruktur
		if (!$this->isAddOrEdit() && $this->instruktur->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->instruktur->AdvancedSearch->SearchValue != "" || $this->instruktur->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// statuspel
		if (!$this->isAddOrEdit() && $this->statuspel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->statuspel->AdvancedSearch->SearchValue != "" || $this->statuspel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ket
		if (!$this->isAddOrEdit() && $this->ket->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ket->AdvancedSearch->SearchValue != "" || $this->ket->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jpeserta
		if (!$this->isAddOrEdit() && $this->jpeserta->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jpeserta->AdvancedSearch->SearchValue != "" || $this->jpeserta->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Tahun
		if (!$this->isAddOrEdit() && $this->Tahun->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Tahun->AdvancedSearch->SearchValue != "" || $this->Tahun->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->idpelat->setDbValue($row['idpelat']);
		$this->kdpelat->setDbValue($row['kdpelat']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->revisi->setDbValue($row['revisi']);
		$this->tgl_terbit->setDbValue($row['tgl_terbit']);
		$this->pilihan_iso->setDbValue($row['pilihan_iso']);
		$this->tawal->setDbValue($row['tawal']);
		$this->takhir->setDbValue($row['takhir']);
		$this->tglpel->setDbValue($row['tglpel']);
		$this->kdprop->setDbValue($row['kdprop']);
		$this->kdkota->setDbValue($row['kdkota']);
		$this->kdkec->setDbValue($row['kdkec']);
		if (array_key_exists('EV__kdkec', $rs->fields)) {
			$this->kdkec->VirtualValue = $rs->fields('EV__kdkec'); // Set up virtual field value
		} else {
			$this->kdkec->VirtualValue = ""; // Clear value
		}
		$this->ketua->setDbValue($row['ketua']);
		$this->sekretaris->setDbValue($row['sekretaris']);
		$this->bendahara->setDbValue($row['bendahara']);
		$this->anggota2->setDbValue($row['anggota2']);
		$this->widyaiswara->setDbValue($row['widyaiswara']);
		$this->jenisevaluasi->setDbValue($row['jenisevaluasi']);
		$this->created_at->setDbValue($row['created_at']);
		$this->user_created_by->setDbValue($row['user_created_by']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->user_updated_by->setDbValue($row['user_updated_by']);
		$this->jenispel->setDbValue($row['jenispel']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->kerjasama->setDbValue($row['kerjasama']);
		$this->dana->setDbValue($row['dana']);
		$this->biaya->setDbValue($row['biaya']);
		$this->coachingprogr->setDbValue($row['coachingprogr']);
		$this->area->setDbValue($row['area']);
		$this->periode_awal->setDbValue($row['periode_awal']);
		$this->periode_akhir->setDbValue($row['periode_akhir']);
		$this->tahapan->setDbValue($row['tahapan']);
		$this->namaberkas->Upload->DbValue = $row['namaberkas'];
		$this->namaberkas->setDbValue($this->namaberkas->Upload->DbValue);
		$this->instruktur->setDbValue($row['instruktur']);
		$this->nmou->setDbValue($row['nmou']);
		$this->nmou2->setDbValue($row['nmou2']);
		$this->statuspel->setDbValue($row['statuspel']);
		$this->ket->setDbValue($row['ket']);
		$this->tempat->setDbValue($row['tempat']);
		$this->jpeserta->setDbValue($row['jpeserta']);
		$this->jml_hari->setDbValue($row['jml_hari']);
		$this->targetpes->setDbValue($row['targetpes']);
		$this->target_peserta->setDbValue($row['target_peserta']);
		$this->durasi1->setDbValue($row['durasi1']);
		$this->durasi2->setDbValue($row['durasi2']);
		$this->rid->setDbValue($row['rid']);
		$this->real_peserta->setDbValue($row['real_peserta']);
		$this->independen->setDbValue($row['independen']);
		$this->swasta_k->setDbValue($row['swasta_k']);
		$this->swasta_m->setDbValue($row['swasta_m']);
		$this->swasta_b->setDbValue($row['swasta_b']);
		$this->bumn->setDbValue($row['bumn']);
		$this->koperasi->setDbValue($row['koperasi']);
		$this->pns->setDbValue($row['pns']);
		$this->pt_dosen->setDbValue($row['pt_dosen']);
		$this->pt_mhs->setDbValue($row['pt_mhs']);
		$this->jk_l->setDbValue($row['jk_l']);
		$this->jk_p->setDbValue($row['jk_p']);
		$this->usia_k45->setDbValue($row['usia_k45']);
		$this->usia_b45->setDbValue($row['usia_b45']);
		$this->produk->setDbValue($row['produk']);
		$this->bbio->Upload->DbValue = $row['bbio'];
		$this->bbio->setDbValue($this->bbio->Upload->DbValue);
		$this->bbio2->Upload->DbValue = $row['bbio2'];
		$this->bbio2->setDbValue($this->bbio2->Upload->DbValue);
		$this->bbio3->Upload->DbValue = $row['bbio3'];
		$this->bbio3->setDbValue($this->bbio3->Upload->DbValue);
		$this->bbio4->Upload->DbValue = $row['bbio4'];
		$this->bbio4->setDbValue($this->bbio4->Upload->DbValue);
		$this->bbio5->Upload->DbValue = $row['bbio5'];
		$this->bbio5->setDbValue($this->bbio5->Upload->DbValue);
		$this->Tahun->setDbValue($row['Tahun']);
		if (!isset($GLOBALS["cv_historipeserta_grid"]))
			$GLOBALS["cv_historipeserta_grid"] = new cv_historipeserta_grid();
		$detailFilter = $GLOBALS["cv_historipeserta"]->sqlDetailFilter_t_pelatihan();
		$detailFilter = str_replace("@kdpelat@", AdjustSql($this->kdpelat->DbValue, "DB"), $detailFilter);
		$GLOBALS["cv_historipeserta"]->setCurrentMasterTable("t_pelatihan");
		$detailFilter = $GLOBALS["cv_historipeserta"]->applyUserIDFilters($detailFilter);
		$this->cv_historipeserta_Count = $GLOBALS["cv_historipeserta"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["cv_historiinstruktur_grid"]))
			$GLOBALS["cv_historiinstruktur_grid"] = new cv_historiinstruktur_grid();
		$detailFilter = $GLOBALS["cv_historiinstruktur"]->sqlDetailFilter_t_pelatihan();
		$detailFilter = str_replace("@kdpelat@", AdjustSql($this->kdpelat->DbValue, "DB"), $detailFilter);
		$GLOBALS["cv_historiinstruktur"]->setCurrentMasterTable("t_pelatihan");
		$detailFilter = $GLOBALS["cv_historiinstruktur"]->applyUserIDFilters($detailFilter);
		$this->cv_historiinstruktur_Count = $GLOBALS["cv_historiinstruktur"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["t_jadwalpel_grid"]))
			$GLOBALS["t_jadwalpel_grid"] = new t_jadwalpel_grid();
		$detailFilter = $GLOBALS["t_jadwalpel"]->sqlDetailFilter_t_pelatihan();
		$detailFilter = str_replace("@idpelat@", AdjustSql($this->idpelat->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@kdjudul@", AdjustSql($this->kdjudul->DbValue, "DB"), $detailFilter);
		$GLOBALS["t_jadwalpel"]->setCurrentMasterTable("t_pelatihan");
		$detailFilter = $GLOBALS["t_jadwalpel"]->applyUserIDFilters($detailFilter);
		$this->t_jadwalpel_Count = $GLOBALS["t_jadwalpel"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['idpelat'] = NULL;
		$row['kdpelat'] = NULL;
		$row['kdjudul'] = NULL;
		$row['kdkursil'] = NULL;
		$row['revisi'] = NULL;
		$row['tgl_terbit'] = NULL;
		$row['pilihan_iso'] = NULL;
		$row['tawal'] = NULL;
		$row['takhir'] = NULL;
		$row['tglpel'] = NULL;
		$row['kdprop'] = NULL;
		$row['kdkota'] = NULL;
		$row['kdkec'] = NULL;
		$row['ketua'] = NULL;
		$row['sekretaris'] = NULL;
		$row['bendahara'] = NULL;
		$row['anggota2'] = NULL;
		$row['widyaiswara'] = NULL;
		$row['jenisevaluasi'] = NULL;
		$row['created_at'] = NULL;
		$row['user_created_by'] = NULL;
		$row['updated_at'] = NULL;
		$row['user_updated_by'] = NULL;
		$row['jenispel'] = NULL;
		$row['kdkategori'] = NULL;
		$row['kerjasama'] = NULL;
		$row['dana'] = NULL;
		$row['biaya'] = NULL;
		$row['coachingprogr'] = NULL;
		$row['area'] = NULL;
		$row['periode_awal'] = NULL;
		$row['periode_akhir'] = NULL;
		$row['tahapan'] = NULL;
		$row['namaberkas'] = NULL;
		$row['instruktur'] = NULL;
		$row['nmou'] = NULL;
		$row['nmou2'] = NULL;
		$row['statuspel'] = NULL;
		$row['ket'] = NULL;
		$row['tempat'] = NULL;
		$row['jpeserta'] = NULL;
		$row['jml_hari'] = NULL;
		$row['targetpes'] = NULL;
		$row['target_peserta'] = NULL;
		$row['durasi1'] = NULL;
		$row['durasi2'] = NULL;
		$row['rid'] = NULL;
		$row['real_peserta'] = NULL;
		$row['independen'] = NULL;
		$row['swasta_k'] = NULL;
		$row['swasta_m'] = NULL;
		$row['swasta_b'] = NULL;
		$row['bumn'] = NULL;
		$row['koperasi'] = NULL;
		$row['pns'] = NULL;
		$row['pt_dosen'] = NULL;
		$row['pt_mhs'] = NULL;
		$row['jk_l'] = NULL;
		$row['jk_p'] = NULL;
		$row['usia_k45'] = NULL;
		$row['usia_b45'] = NULL;
		$row['produk'] = NULL;
		$row['bbio'] = NULL;
		$row['bbio2'] = NULL;
		$row['bbio3'] = NULL;
		$row['bbio4'] = NULL;
		$row['bbio5'] = NULL;
		$row['Tahun'] = NULL;
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

		// Convert decimal values if posted back
		if ($this->biaya->FormValue == $this->biaya->CurrentValue && is_numeric(ConvertToFloatString($this->biaya->CurrentValue)))
			$this->biaya->CurrentValue = ConvertToFloatString($this->biaya->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// idpelat
		// kdpelat
		// kdjudul
		// kdkursil
		// revisi
		// tgl_terbit
		// pilihan_iso
		// tawal
		// takhir
		// tglpel
		// kdprop
		// kdkota
		// kdkec
		// ketua
		// sekretaris
		// bendahara
		// anggota2
		// widyaiswara
		// jenisevaluasi
		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jenispel
		// kdkategori
		// kerjasama
		// dana
		// biaya
		// coachingprogr
		// area
		// periode_awal
		// periode_akhir
		// tahapan
		// namaberkas
		// instruktur
		// nmou
		// nmou2
		// statuspel
		// ket
		// tempat
		// jpeserta
		// jml_hari
		// targetpes
		// target_peserta
		// durasi1
		// durasi2
		// rid
		// real_peserta
		// independen
		// swasta_k
		// swasta_m
		// swasta_b
		// bumn
		// koperasi
		// pns
		// pt_dosen
		// pt_mhs
		// jk_l
		// jk_p
		// usia_k45
		// usia_b45
		// produk
		// bbio
		// bbio2
		// bbio3
		// bbio4
		// bbio5
		// Tahun
		// Accumulate aggregate value

		if ($this->RowType != ROWTYPE_AGGREGATEINIT && $this->RowType != ROWTYPE_AGGREGATE) {
			if (is_numeric($this->jpeserta->CurrentValue))
				$this->jpeserta->Total += $this->jpeserta->CurrentValue; // Accumulate total
			if (is_numeric($this->targetpes->CurrentValue))
				$this->targetpes->Total += $this->targetpes->CurrentValue; // Accumulate total
		}
		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
			$curVal = strval($this->kdkursil->CurrentValue);
			if ($curVal != "") {
				$this->kdkursil->ViewValue = $this->kdkursil->lookupCacheOption($curVal);
				if ($this->kdkursil->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdkursil`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdkursil->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = FormatDateTime($rswrk->fields('df3'), 0);
						$this->kdkursil->ViewValue = $this->kdkursil->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
					}
				}
			} else {
				$this->kdkursil->ViewValue = NULL;
			}
			$this->kdkursil->ViewCustomAttributes = "";

			// revisi
			$this->revisi->ViewValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tgl_terbit
			$this->tgl_terbit->ViewValue = $this->tgl_terbit->CurrentValue;
			$this->tgl_terbit->ViewValue = FormatDateTime($this->tgl_terbit->ViewValue, 0);
			$this->tgl_terbit->ViewCustomAttributes = "";

			// pilihan_iso
			if (strval($this->pilihan_iso->CurrentValue) != "") {
				$this->pilihan_iso->ViewValue = $this->pilihan_iso->optionCaption($this->pilihan_iso->CurrentValue);
			} else {
				$this->pilihan_iso->ViewValue = NULL;
			}
			$this->pilihan_iso->ViewCustomAttributes = "";

			// tawal
			$this->tawal->ViewValue = $this->tawal->CurrentValue;
			$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
			$this->tawal->ViewCustomAttributes = "";

			// takhir
			$this->takhir->ViewValue = $this->takhir->CurrentValue;
			$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
			$this->takhir->ViewCustomAttributes = "";

			// tglpel
			$this->tglpel->ViewValue = $this->tglpel->CurrentValue;
			$this->tglpel->CellCssStyle .= "text-align: right;";
			$this->tglpel->ViewCustomAttributes = 'style=text-align:center';

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

			// biaya
			$this->biaya->ViewValue = $this->biaya->CurrentValue;
			$this->biaya->ViewValue = FormatNumber($this->biaya->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->biaya->ViewCustomAttributes = "";

			// coachingprogr
			if (strval($this->coachingprogr->CurrentValue) != "") {
				$this->coachingprogr->ViewValue = $this->coachingprogr->optionCaption($this->coachingprogr->CurrentValue);
			} else {
				$this->coachingprogr->ViewValue = NULL;
			}
			$this->coachingprogr->ViewCustomAttributes = "";

			// area
			$this->area->ViewValue = $this->area->CurrentValue;
			$this->area->ViewCustomAttributes = "";

			// periode_awal
			$this->periode_awal->ViewValue = $this->periode_awal->CurrentValue;
			$this->periode_awal->ViewCustomAttributes = "";

			// periode_akhir
			$this->periode_akhir->ViewValue = $this->periode_akhir->CurrentValue;
			$this->periode_akhir->ViewCustomAttributes = "";

			// tahapan
			$curVal = strval($this->tahapan->CurrentValue);
			if ($curVal != "") {
				$this->tahapan->ViewValue = $this->tahapan->lookupCacheOption($curVal);
				if ($this->tahapan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdtahapan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->tahapan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->tahapan->ViewValue = $this->tahapan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->tahapan->ViewValue = $this->tahapan->CurrentValue;
					}
				}
			} else {
				$this->tahapan->ViewValue = NULL;
			}
			$this->tahapan->ViewCustomAttributes = "";

			// namaberkas
			if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
				$this->namaberkas->ViewValue = $this->namaberkas->Upload->DbValue;
			} else {
				$this->namaberkas->ViewValue = "";
			}
			$this->namaberkas->ViewCustomAttributes = "";

			// instruktur
			$this->instruktur->ViewValue = $this->instruktur->CurrentValue;
			$this->instruktur->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// jpeserta
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->CellCssStyle .= "text-align: right;";
			$this->jpeserta->ViewCustomAttributes = "";

			// targetpes
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->CellCssStyle .= "text-align: right;";
			$this->targetpes->ViewCustomAttributes = "";

			// Tahun
			$this->Tahun->ViewValue = $this->Tahun->CurrentValue;
			$this->Tahun->ViewCustomAttributes = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";
			if (!$this->isExport())
				$this->kdjudul->ViewValue = $this->highlightValue($this->kdjudul);

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

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";
			$this->jenispel->TooltipValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";
			$this->kerjasama->TooltipValue = "";
			if (!$this->isExport())
				$this->kerjasama->ViewValue = $this->highlightValue($this->kerjasama);

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";
			$this->biaya->TooltipValue = "";
			if (!$this->isExport())
				$this->biaya->ViewValue = $this->highlightValue($this->biaya);

			// coachingprogr
			$this->coachingprogr->LinkCustomAttributes = "";
			$this->coachingprogr->HrefValue = "";
			$this->coachingprogr->TooltipValue = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";
			$this->area->TooltipValue = "";
			if (!$this->isExport())
				$this->area->ViewValue = $this->highlightValue($this->area);

			// periode_awal
			$this->periode_awal->LinkCustomAttributes = "";
			$this->periode_awal->HrefValue = "";
			$this->periode_awal->TooltipValue = "";
			if (!$this->isExport())
				$this->periode_awal->ViewValue = $this->highlightValue($this->periode_awal);

			// periode_akhir
			$this->periode_akhir->LinkCustomAttributes = "";
			$this->periode_akhir->HrefValue = "";
			$this->periode_akhir->TooltipValue = "";
			if (!$this->isExport())
				$this->periode_akhir->ViewValue = $this->highlightValue($this->periode_akhir);

			// tahapan
			$this->tahapan->LinkCustomAttributes = "";
			$this->tahapan->HrefValue = "";
			$this->tahapan->TooltipValue = "";

			// namaberkas
			$this->namaberkas->LinkCustomAttributes = "";
			if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
				$this->namaberkas->HrefValue = GetFileUploadUrl($this->namaberkas, $this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)); // Add prefix/suffix
				$this->namaberkas->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport())
					$this->namaberkas->HrefValue = FullUrl($this->namaberkas->HrefValue, "href");
			} else {
				$this->namaberkas->HrefValue = "";
			}
			$this->namaberkas->ExportHrefValue = $this->namaberkas->UploadPath . $this->namaberkas->Upload->DbValue;
			$this->namaberkas->TooltipValue = "";

			// instruktur
			$this->instruktur->LinkCustomAttributes = "";
			$this->instruktur->HrefValue = "";
			$this->instruktur->TooltipValue = "";
			if (!$this->isExport())
				$this->instruktur->ViewValue = $this->highlightValue($this->instruktur);

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// jpeserta
			$this->jpeserta->LinkCustomAttributes = "";
			$this->jpeserta->HrefValue = "";
			$this->jpeserta->TooltipValue = "";
			if (!$this->isExport())
				$this->jpeserta->ViewValue = $this->highlightValue($this->jpeserta);

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";
			$this->targetpes->TooltipValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";
			$this->Tahun->TooltipValue = "";
			if (!$this->isExport())
				$this->Tahun->ViewValue = $this->highlightValue($this->Tahun);
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

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

			// jenispel
			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			$this->jenispel->EditValue = $this->jenispel->options(TRUE);

			// kerjasama
			$this->kerjasama->EditAttrs["class"] = "form-control";
			$this->kerjasama->EditCustomAttributes = "";
			$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->AdvancedSearch->SearchValue);
			$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

			// biaya
			$this->biaya->EditAttrs["class"] = "form-control";
			$this->biaya->EditCustomAttributes = "";
			$this->biaya->EditValue = HtmlEncode($this->biaya->AdvancedSearch->SearchValue);
			$this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());

			// coachingprogr
			$this->coachingprogr->EditAttrs["class"] = "form-control";
			$this->coachingprogr->EditCustomAttributes = "";
			$this->coachingprogr->EditValue = $this->coachingprogr->options(TRUE);

			// area
			$this->area->EditAttrs["class"] = "form-control";
			$this->area->EditCustomAttributes = "";
			if (!$this->area->Raw)
				$this->area->AdvancedSearch->SearchValue = HtmlDecode($this->area->AdvancedSearch->SearchValue);
			$this->area->EditValue = HtmlEncode($this->area->AdvancedSearch->SearchValue);
			$this->area->PlaceHolder = RemoveHtml($this->area->caption());

			// periode_awal
			$this->periode_awal->EditAttrs["class"] = "form-control";
			$this->periode_awal->EditCustomAttributes = "";
			$this->periode_awal->EditValue = HtmlEncode($this->periode_awal->AdvancedSearch->SearchValue);
			$this->periode_awal->PlaceHolder = RemoveHtml($this->periode_awal->caption());

			// periode_akhir
			$this->periode_akhir->EditAttrs["class"] = "form-control";
			$this->periode_akhir->EditCustomAttributes = "";
			$this->periode_akhir->EditValue = HtmlEncode($this->periode_akhir->AdvancedSearch->SearchValue);
			$this->periode_akhir->PlaceHolder = RemoveHtml($this->periode_akhir->caption());

			// tahapan
			$this->tahapan->EditAttrs["class"] = "form-control";
			$this->tahapan->EditCustomAttributes = "";

			// namaberkas
			$this->namaberkas->EditAttrs["class"] = "form-control";
			$this->namaberkas->EditCustomAttributes = "";
			if (!$this->namaberkas->Raw)
				$this->namaberkas->AdvancedSearch->SearchValue = HtmlDecode($this->namaberkas->AdvancedSearch->SearchValue);
			$this->namaberkas->EditValue = HtmlEncode($this->namaberkas->AdvancedSearch->SearchValue);
			$this->namaberkas->PlaceHolder = RemoveHtml($this->namaberkas->caption());

			// instruktur
			$this->instruktur->EditAttrs["class"] = "form-control";
			$this->instruktur->EditCustomAttributes = "";
			if (!$this->instruktur->Raw)
				$this->instruktur->AdvancedSearch->SearchValue = HtmlDecode($this->instruktur->AdvancedSearch->SearchValue);
			$this->instruktur->EditValue = HtmlEncode($this->instruktur->AdvancedSearch->SearchValue);
			$this->instruktur->PlaceHolder = RemoveHtml($this->instruktur->caption());

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			$this->tempat->EditValue = HtmlEncode($this->tempat->AdvancedSearch->SearchValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// jpeserta
			$this->jpeserta->EditAttrs["class"] = "form-control";
			$this->jpeserta->EditCustomAttributes = "";
			$this->jpeserta->EditValue = HtmlEncode($this->jpeserta->AdvancedSearch->SearchValue);
			$this->jpeserta->PlaceHolder = RemoveHtml($this->jpeserta->caption());

			// targetpes
			$this->targetpes->EditAttrs["class"] = "form-control";
			$this->targetpes->EditCustomAttributes = "";
			$this->targetpes->EditValue = HtmlEncode($this->targetpes->AdvancedSearch->SearchValue);
			$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

			// Tahun
			$this->Tahun->EditAttrs["class"] = "form-control";
			$this->Tahun->EditCustomAttributes = "";
			$this->Tahun->EditValue = HtmlEncode($this->Tahun->AdvancedSearch->SearchValue);
			$this->Tahun->PlaceHolder = RemoveHtml($this->Tahun->caption());
		} elseif ($this->RowType == ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->jpeserta->Total = 0; // Initialize total
			$this->targetpes->Total = 0; // Initialize total
		} elseif ($this->RowType == ROWTYPE_AGGREGATE) { // Aggregate row
			$this->jpeserta->CurrentValue = $this->jpeserta->Total;
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->CellCssStyle .= "text-align: right;";
			$this->jpeserta->ViewCustomAttributes = "";
			$this->jpeserta->HrefValue = ""; // Clear href value
			$this->targetpes->CurrentValue = $this->targetpes->Total;
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->CellCssStyle .= "text-align: right;";
			$this->targetpes->ViewCustomAttributes = "";
			$this->targetpes->HrefValue = ""; // Clear href value
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
		if (!CheckInteger($this->Tahun->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Tahun->errorMessage());
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
		$this->kdpelat->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->kdkursil->AdvancedSearch->load();
		$this->revisi->AdvancedSearch->load();
		$this->tgl_terbit->AdvancedSearch->load();
		$this->pilihan_iso->AdvancedSearch->load();
		$this->tawal->AdvancedSearch->load();
		$this->takhir->AdvancedSearch->load();
		$this->tglpel->AdvancedSearch->load();
		$this->kdprop->AdvancedSearch->load();
		$this->kdkota->AdvancedSearch->load();
		$this->kdkec->AdvancedSearch->load();
		$this->ketua->AdvancedSearch->load();
		$this->sekretaris->AdvancedSearch->load();
		$this->bendahara->AdvancedSearch->load();
		$this->anggota2->AdvancedSearch->load();
		$this->widyaiswara->AdvancedSearch->load();
		$this->jenisevaluasi->AdvancedSearch->load();
		$this->jenispel->AdvancedSearch->load();
		$this->kdkategori->AdvancedSearch->load();
		$this->kerjasama->AdvancedSearch->load();
		$this->biaya->AdvancedSearch->load();
		$this->coachingprogr->AdvancedSearch->load();
		$this->area->AdvancedSearch->load();
		$this->periode_awal->AdvancedSearch->load();
		$this->periode_akhir->AdvancedSearch->load();
		$this->tahapan->AdvancedSearch->load();
		$this->namaberkas->AdvancedSearch->load();
		$this->instruktur->AdvancedSearch->load();
		$this->statuspel->AdvancedSearch->load();
		$this->ket->AdvancedSearch->load();
		$this->jpeserta->AdvancedSearch->load();
		$this->Tahun->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ft_pelatihanlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ft_pelatihanlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ft_pelatihanlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_t_pelatihan" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_t_pelatihan\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ft_pelatihanlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft_pelatihanlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"t_pelatihansrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"t_pelatihan\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'t_pelatihansrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"ft_pelatihanlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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

		// Export master record
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_judul") {
			global $t_judul;
			if (!isset($t_judul))
				$t_judul = new t_judul();
			$rsmaster = $t_judul->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("v"); // Change to vertical
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$t_judul;
					$t_judul->exportDocument($doc, $rsmaster);
					$doc->exportEmptyRow();
					$doc->Table = &$this;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsmaster->close();
			}
		}

		// Export master record
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_kota") {
			global $t_kota;
			if (!isset($t_kota))
				$t_kota = new t_kota();
			$rsmaster = $t_kota->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("v"); // Change to vertical
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$t_kota;
					$t_kota->exportDocument($doc, $rsmaster);
					$doc->exportEmptyRow();
					$doc->Table = &$this;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsmaster->close();
			}
		}

		// Export master record
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_prop") {
			global $t_prop;
			if (!isset($t_prop))
				$t_prop = new t_prop();
			$rsmaster = $t_prop->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("v"); // Change to vertical
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$t_prop;
					$t_prop->exportDocument($doc, $rsmaster);
					$doc->exportEmptyRow();
					$doc->Table = &$this;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsmaster->close();
			}
		}
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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "t_judul") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdjudul", Get("kdjudul"))) !== NULL) {
					$GLOBALS["t_judul"]->kdjudul->setQueryStringValue($parm);
					$this->kdjudul->setQueryStringValue($GLOBALS["t_judul"]->kdjudul->QueryStringValue);
					$this->kdjudul->setSessionValue($this->kdjudul->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_kota") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdkota", Get("kdkota"))) !== NULL) {
					$GLOBALS["t_kota"]->kdkota->setQueryStringValue($parm);
					$this->kdkota->setQueryStringValue($GLOBALS["t_kota"]->kdkota->QueryStringValue);
					$this->kdkota->setSessionValue($this->kdkota->QueryStringValue);
					if (!is_numeric($GLOBALS["t_kota"]->kdkota->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_prop") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdprop", Get("kdprop"))) !== NULL) {
					$GLOBALS["t_prop"]->kdprop->setQueryStringValue($parm);
					$this->kdprop->setQueryStringValue($GLOBALS["t_prop"]->kdprop->QueryStringValue);
					$this->kdprop->setSessionValue($this->kdprop->QueryStringValue);
					if (!is_numeric($GLOBALS["t_prop"]->kdprop->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "t_judul") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdjudul", Post("kdjudul"))) !== NULL) {
					$GLOBALS["t_judul"]->kdjudul->setFormValue($parm);
					$this->kdjudul->setFormValue($GLOBALS["t_judul"]->kdjudul->FormValue);
					$this->kdjudul->setSessionValue($this->kdjudul->FormValue);
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_kota") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdkota", Post("kdkota"))) !== NULL) {
					$GLOBALS["t_kota"]->kdkota->setFormValue($parm);
					$this->kdkota->setFormValue($GLOBALS["t_kota"]->kdkota->FormValue);
					$this->kdkota->setSessionValue($this->kdkota->FormValue);
					if (!is_numeric($GLOBALS["t_kota"]->kdkota->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_prop") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdprop", Post("kdprop"))) !== NULL) {
					$GLOBALS["t_prop"]->kdprop->setFormValue($parm);
					$this->kdprop->setFormValue($GLOBALS["t_prop"]->kdprop->FormValue);
					$this->kdprop->setSessionValue($this->kdprop->FormValue);
					if (!is_numeric($GLOBALS["t_prop"]->kdprop->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Update URL
			$this->AddUrl = $this->addMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->addMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->addMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->addMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "t_judul") {
				if ($this->kdjudul->CurrentValue == "")
					$this->kdjudul->setSessionValue("");
			}
			if ($masterTblVar != "t_kota") {
				if ($this->kdkota->CurrentValue == "")
					$this->kdkota->setSessionValue("");
			}
			if ($masterTblVar != "t_prop") {
				if ($this->kdprop->CurrentValue == "")
					$this->kdprop->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_kdjudul":
					break;
				case "x_kdkursil":
					break;
				case "x_pilihan_iso":
					break;
				case "x_kdprop":
					break;
				case "x_kdkota":
					break;
				case "x_kdkec":
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
				case "x_jenispel":
					break;
				case "x_kdkategori":
					break;
				case "x_kerjasama":
					break;
				case "x_dana":
					break;
				case "x_coachingprogr":
					break;
				case "x_tahapan":
					break;
				case "x_statuspel":
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
						case "x_kdjudul":
							break;
						case "x_kdkursil":
							$row[3] = FormatDateTime($row[3], 0);
							$row['df3'] = $row[3];
							break;
						case "x_kdprop":
							break;
						case "x_kdkota":
							break;
						case "x_kdkec":
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
						case "x_kdkategori":
							break;
						case "x_kerjasama":
							break;
						case "x_tahapan":
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
		$this->kdpelat->Visible = FALSE;
		if(isset($_GET["h"])){ // pelatihan tunda
			if(@$_GET["bulan"] == @$_GET["bulan2"]){
				$tampilbulan = ucfirst(BulanIndo(@$_GET["bulan"])) . ".";
			} else {
				if(@$_GET["bulan"] == 1 && @$_GET["bulan2"] >= 12){
					$tampilbulan = "";
				} else {
					$tampilbulan = ucfirst(BulanIndo(@$_GET["bulan"])) . ".sd." . ucfirst(BulanIndo(@$_GET["bulan2"])) . " .";
				}
			}
			$GLOBALS["ExportFileName"] = "9. Pelatihan.Tunda.".$tampilbulan."Th." . @$_GET["tahun"];
		} else { 
			$GLOBALS["ExportFileName"] = "Daftar_Pelatihan-PPE".CurrentDate();
		}
		if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){
			$item = &$this->ExportOptions->Add("excel");
			$item->Body = '<a class="btn btn-default ewExportLink ewExcel" href="t_pelatihanlist.php?export=excel&pegid='.$_GET["pegid"].'" title="" data-caption="Excel" data-original-title="Excel"><span data-phrase="ExportToExcel" class="icon-excel ewIcon" data-caption="Export to Excel"></span></a>';
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
		$this->OtherOptions["addedit"]->Items["add"]->Visible = FALSE;
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

		$this->Tahun->Visible = FALSE;
		if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){
			$nm = ExecuteScalar("SELECT nama FROM `t_pegawai` WHERE `id_peg` = '".$_GET["pegid"]."'");
			$myh = "<center><h4>Daftar Pelatihan dengan Panitia : <u>".$nm."</u></h4></center>";
			$header = $myh;
		} else {
			if ($this->Export <> "") {
				if(isset($_GET["h"])){
					$myh = "";
				} else {
					$myh = "<center><h4>Daftar Pelatihan</h4></center>";
				}
			} else {
				$myh = "";
			}
		}
		if ($this->Export <> "") {
			$header = $myh;
		} else {
				if(CurrentUserLevel() == 1){ //user manajemen
					$this->ketua->Visible = FALSE;
					$this->sekretaris->Visible = FALSE;
					$this->bendahara->Visible = FALSE;
					$this->anggota2->Visible = FALSE;
					$this->widyaiswara->Visible = FALSE;
					$this->kdkategori->Visible = FALSE;
				}
			$this->tawal->Visible = FALSE;
			$this->takhir->Visible = FALSE;
			$this->kdkec->Visible = FALSE;
			$this->jenispel->Visible = FALSE;
			$this->kerjasama->Visible = FALSE;
			$this->biaya->Visible = FALSE;
			$this->coachingprogr->Visible = FALSE;
			$this->area->Visible = FALSE;
			$this->periode_awal->Visible = FALSE;
			$this->periode_akhir->Visible = FALSE;
			$this->tahapan->Visible = FALSE;
			$this->namaberkas->Visible = FALSE;
			$this->nmou->Visible = FALSE;
			$this->nmou2->Visible = FALSE;
			$header = $myh;
		}
		if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){
			$this->sekretaris->Visible = FALSE;
			$this->bendahara->Visible = FALSE;
			$this->kdkategori->Visible = FALSE;
			$this->instruktur->Visible = FALSE;

			//$this->ketua->setFldCaption("SEBAGAI");
			$this->idpelat->Exportable = FALSE;
			$this->kdpelat->Exportable = FALSE;
			$this->sekretaris->Exportable = FALSE;
			$this->bendahara->Exportable = FALSE;
			$this->anggota2->Exportable = FALSE;
			$this->kdkategori->Exportable = FALSE;
			$this->instruktur->Exportable = FALSE;
			$this->kdkec->Exportable = FALSE;
			$this->jenispel->Exportable = FALSE;
			$this->kerjasama->Exportable = FALSE;
			$this->biaya->Exportable = FALSE;
			$this->coachingprogr->Exportable = FALSE;
			$this->area->Exportable = FALSE;
			$this->periode_awal->Exportable = FALSE;
			$this->periode_akhir->Exportable = FALSE;
			$this->tahapan->Exportable = FALSE;
			$this->namaberkas->Visible = FALSE;
			$this->nmou->Visible = FALSE;
			$this->nmou2->Visible = FALSE;
		}

	//	$this->idpelat->Visible = FALSE;
		$this->instruktur->Visible = FALSE;
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
		$opt = &$this->ListOptions->Add("dpdf");
		$opt->Header = "";
		$opt->OnLeft = FALSE; // Link on left
		$opt->MoveTo(0); // Move to first column
		$opt = &$this->ListOptions->Add("djad");
		$opt->Header = "";
		$opt->OnLeft = FALSE; // Link on left
		$opt->MoveTo(9); // Move to first column
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
		if($this->namaberkas->ViewValue <> ""){
			$key =  RANDOM_KEY . session_id();
			$path = "berkas/";
			$val = $this->namaberkas->CurrentValue;
			$fn = "csewfile12.php?t=" . Encrypt('t_pelatihan', $key) ."&fn=" . Encrypt($path . $val, $key);
			$ld = " href='" . $fn ."'";
		} else {
			$ld = " href='javascript:void(0)' onclick='noberkas()'";
		}
		$this->ListOptions->Items["dpdf"]->Body = "<a class='ewRowLink ewPDF' data-caption='Berkas PDF'".$ld."><span data-phrase='ViewLink' class='icon-pdf ewIcon' data-caption='PDF'></span> Berkas PDF</a>";
		$this->ListOptions->Items["detail_cv_historipeserta"]->Body = "<a class='ewRowLink ewEdit' data-caption='View Detail' href='cv_historipesertalist.php?showmaster=t_pelatihan&fk_kdpelat=" . $this->kdpelat->CurrentValue . "'><span data-phrase='ViewLink' class='icon-view ewIcon' data-caption='View'></span> View</a>";

		//$this->ListOptions->Items["detail_cv_historiinstruktur"]->Body = "<a class='btn btn-default ewAddEdit ewAdd btn-sm' data-caption='Add Instruktur' href='cscv_historiinstrukturadd.php?showmaster=t_pelatihan&fk_kdpelat=" . $this->kdpelat->CurrentValue . "'><span data-phrase='AddLink' class='glyphicon glyphicon-plus ewIcon' data-caption='Add'></span> Add Intruktur</a>";
		$this->ListOptions->Items["detail_cv_historiinstruktur"]->Body = "";
		$this->ListOptions->Items["djad"]->Body = '<a class="ewRowLink ewWord" data-caption="Download Jadwal" href="t_jadwalpellist.php?showmaster=t_pelatihan&fk_idpelat='.$this->idpelat->CurrentValue.'&fk_kdjudul='.$this->kdjudul->CurrentValue.'&export=word" data-original-title="" title=""><span data-phrase="ViewLink" class="icon-word ewIcon" data-caption="Word"></span>&nbsp;&nbsp;Download Jadwal</a>';
	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {
		$_SESSION["bln_before"] = 0;
		$_SESSION["no"] = 1;
		if(@$_GET["h"] == "rpt"){
		if($_GET["bulan"] == $_GET["bulan2"]){
			$tampilbulan = strtoupper(BulanIndo($_GET["bulan"])) . " ";
		} else {
			if($_GET["bulan"] == 1 && $_GET["bulan2"] >= 12){
				$tampilbulan = "S.D DESEMBER ";
			} else {
				$tampilbulan = strtoupper(BulanIndo($_GET["bulan"])) . " S.D " . strtoupper(BulanIndo($_GET["bulan2"])) . " ";
			}
		}
		$this->ExportDoc->Text = "
	<style>
		table { border-collapse: collapse; border-bottom: 1px solid #000; }
		th, td { border: 1px solid #000; padding:5px; height: 36px;}
		#tdq{ background-color:#b5b5b5; font-size:15px;}
		#tdq2{ background-color:#dadada; height: 6px;border-top: none;border-bottom: none;}
		#trdata td {border-top: none;border-bottom: none;}
		#tdk { border: none;  font-size:15px; }
		#tdr { border-top: none;border-bottom: none; height:33px; vertical-align: middle; }
	</style>
		<table width='45%'>
		<tr>
			<th colspan='8' id='tdk'>REALISASI DIKLAT TUNDA/BATAL/JALAN</th>
		</tr>
		<tr>
			<th colspan='8' id='tdk'>BALAI BESAR PENDIDIKAN DAN PELATIHAN EKSPOR INDONESIA</th>
		</tr>
		<tr>
			<th colspan='8' id='tdk'>".$tampilbulan.@$_GET["tahun"]."</th>
		</tr>
		<tr>
			<th id='tdq' rowspan='2'>NO.</th>
			<th id='tdq' rowspan='2'>TOPIK</th>
			<th id='tdq' rowspan='2'>TEMPAT</th>
			<th id='tdq' colspan='2'>RENCANA</th>
			<th id='tdq' colspan='2'>TUNDA / BATAL / JALAN</th>
			<th id='tdq' rowspan='2'>KETERANGAN</th>
		</tr>
		<tr>
			<th id='tdq'>TANGGAL</th>
			<th id='tdq'>JUMLAH</th>
			<th id='tdq'>TANGGAL</th>
			<th id='tdq'>JUMLAH</th>
		</tr>"; // Export header // Export header
		return FALSE; // Return FALSE to skip default export and use Row_Export event
		} else {
		return TRUE;
		}
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {
		if(@$_GET["h"] == "rpt"){
		$no = $_SESSION["no"]++;
		$bln = date('n', strtotime($this->tawal->ViewValue));
		if($_SESSION["bln_before"] > 0){
			if($bln <> $_SESSION["bln_before"]){
				$this->ExportDoc->Text .= "<tr><th id='tdq'></th><th id='tdq'></th><th id='tdq'></th><th id='tdq'></th><th id='tdq'></th><th id='tdq'></th><th id='tdq'></th><th id='tdq'></th></tr>";
			}
		}
		$btawal = date("n", strtotime($this->tawal->ViewValue));
		$btakhir = date("n", strtotime($this->takhir->ViewValue));
		if($btawal == $btakhir){
			$tgl_jd =  date("d", strtotime($this->tawal->ViewValue)) . " - " . CSFormatTanggal($this->takhir->ViewValue, false, false, true);
		} else {
			$tgl_jd =  CSFormatTanggal($this->tawal->ViewValue) . " - " . CSFormatTanggal($this->takhir->ViewValue, false, false, true);
		}
		$this->ExportDoc->Text .= "<tr id='trdata'><td align='center'>".$no."</td><td>".$this->kdjudul->ViewValue."</td><td>".$this->kdkota->ViewValue."</td><td align='center'>".$tgl_jd."</td><td align='center'>".$this->jpeserta->ViewValue."</td><td></td><td></td><td></td></tr>"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
		$_SESSION["bln_before"] = $bln;
		}
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {
		if(@$_GET["h"] == "rpt"){
			$this->ExportDoc->Text .= "</table>"; // Export footer

		//	echo $this->ExportDoc->Text; exit();
			unset($_SESSION["no"]);
			unset($_SESSION["bln_before"]);
		}
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