<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_pcp_list extends t_pcp
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_pcp';

	// Page object name
	public $PageObjName = "t_pcp_list";

	// Grid form hidden field names
	public $FormName = "ft_pcplist";
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

		// Table object (t_pcp)
		if (!isset($GLOBALS["t_pcp"]) || get_class($GLOBALS["t_pcp"]) == PROJECT_NAMESPACE . "t_pcp") {
			$GLOBALS["t_pcp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_pcp"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "t_pcpadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "t_pcpdelete.php";
		$this->MultiUpdateUrl = "t_pcpupdate.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (excp)
		if (!isset($GLOBALS['excp']))
			$GLOBALS['excp'] = new excp();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_pcp');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ft_pcplistsrch";

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
		global $t_pcp;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_pcp);
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
		$this->f_npwp->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_npwp->UploadPath = $this->f_npwp->OldUploadPath;
		$this->f_nib->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_nib->UploadPath = $this->f_nib->OldUploadPath;
		$this->f_siup->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_siup->UploadPath = $this->f_siup->OldUploadPath;
		$this->f_tdp->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_tdp->UploadPath = $this->f_tdp->OldUploadPath;
		$this->f_lain->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_lain->UploadPath = $this->f_lain->OldUploadPath;
		$this->f_sertifikat->OldUploadPath = "berkas/sertifikat_ecp/";
		$this->f_sertifikat->UploadPath = $this->f_sertifikat->OldUploadPath;
		$this->f_kartunama->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_kartunama->UploadPath = $this->f_kartunama->OldUploadPath;
		$this->f_brosur->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_brosur->UploadPath = $this->f_brosur->OldUploadPath;
		$this->f_katalog->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_katalog->UploadPath = $this->f_katalog->OldUploadPath;
		$this->f_profile->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_profile->UploadPath = $this->f_profile->OldUploadPath;
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
		$this->id->Visible = FALSE;
		$this->rkid->Visible = FALSE;
		$this->nama_peserta->setVisibility();
		$this->email_add->setVisibility();
		$this->handphone->setVisibility();
		$this->namap->setVisibility();
		$this->tahun_berdiri->Visible = FALSE;
		$this->alamat->Visible = FALSE;
		$this->alamat_prod->Visible = FALSE;
		$this->kategori_produk->setVisibility();
		$this->kategori_produk2->setVisibility();
		$this->kategori_produk3->setVisibility();
		$this->produk->setVisibility();
		$this->merek_dagang->setVisibility();
		$this->jenis_perusahaan->setVisibility();
		$this->kapasitas_produksi->setVisibility();
		$this->omset->setVisibility();
		$this->website->setVisibility();
		$this->fb->Visible = FALSE;
		$this->ig->Visible = FALSE;
		$this->sosmed_lain->Visible = FALSE;
		$this->jml_pegawai->setVisibility();
		$this->jml_pegawai2->setVisibility();
		$this->jml_pegawai_tidaktetap->setVisibility();
		$this->legalitas->setVisibility();
		$this->legalitas_lain->setVisibility();
		$this->f_npwp->Visible = FALSE;
		$this->f_nib->Visible = FALSE;
		$this->f_siup->Visible = FALSE;
		$this->f_tdp->Visible = FALSE;
		$this->f_lain->Visible = FALSE;
		$this->sertifikat->setVisibility();
		$this->sertifikat_lain->setVisibility();
		$this->f_sertifikat->Visible = FALSE;
		$this->alat_promosi->setVisibility();
		$this->promosi_lain->setVisibility();
		$this->f_kartunama->Visible = FALSE;
		$this->f_brosur->Visible = FALSE;
		$this->f_katalog->Visible = FALSE;
		$this->f_profile->Visible = FALSE;
		$this->tahun_ecp->setVisibility();
		$this->wilayah_ecp->setVisibility();
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
		$this->setupLookupOptions($this->namap);
		$this->setupLookupOptions($this->kategori_produk);
		$this->setupLookupOptions($this->kategori_produk2);
		$this->setupLookupOptions($this->kategori_produk3);

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
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();

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
		}

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "excp") {
			global $excp;
			$rsmaster = $excp->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("excplist.php"); // Return to master page
			} else {
				$excp->loadListRowValues($rsmaster);
				$excp->RowType = ROWTYPE_MASTER; // Master row
				$excp->renderListRow();
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
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
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
		$filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
		$filterList = Concat($filterList, $this->rkid->AdvancedSearch->toJson(), ","); // Field rkid
		$filterList = Concat($filterList, $this->nama_peserta->AdvancedSearch->toJson(), ","); // Field nama_peserta
		$filterList = Concat($filterList, $this->email_add->AdvancedSearch->toJson(), ","); // Field email_add
		$filterList = Concat($filterList, $this->handphone->AdvancedSearch->toJson(), ","); // Field handphone
		$filterList = Concat($filterList, $this->namap->AdvancedSearch->toJson(), ","); // Field namap
		$filterList = Concat($filterList, $this->tahun_berdiri->AdvancedSearch->toJson(), ","); // Field tahun_berdiri
		$filterList = Concat($filterList, $this->alamat->AdvancedSearch->toJson(), ","); // Field alamat
		$filterList = Concat($filterList, $this->alamat_prod->AdvancedSearch->toJson(), ","); // Field alamat_prod
		$filterList = Concat($filterList, $this->kategori_produk->AdvancedSearch->toJson(), ","); // Field kategori_produk
		$filterList = Concat($filterList, $this->kategori_produk2->AdvancedSearch->toJson(), ","); // Field kategori_produk2
		$filterList = Concat($filterList, $this->kategori_produk3->AdvancedSearch->toJson(), ","); // Field kategori_produk3
		$filterList = Concat($filterList, $this->produk->AdvancedSearch->toJson(), ","); // Field produk
		$filterList = Concat($filterList, $this->merek_dagang->AdvancedSearch->toJson(), ","); // Field merek_dagang
		$filterList = Concat($filterList, $this->jenis_perusahaan->AdvancedSearch->toJson(), ","); // Field jenis_perusahaan
		$filterList = Concat($filterList, $this->kapasitas_produksi->AdvancedSearch->toJson(), ","); // Field kapasitas_produksi
		$filterList = Concat($filterList, $this->omset->AdvancedSearch->toJson(), ","); // Field omset
		$filterList = Concat($filterList, $this->website->AdvancedSearch->toJson(), ","); // Field website
		$filterList = Concat($filterList, $this->fb->AdvancedSearch->toJson(), ","); // Field fb
		$filterList = Concat($filterList, $this->ig->AdvancedSearch->toJson(), ","); // Field ig
		$filterList = Concat($filterList, $this->sosmed_lain->AdvancedSearch->toJson(), ","); // Field sosmed_lain
		$filterList = Concat($filterList, $this->jml_pegawai->AdvancedSearch->toJson(), ","); // Field jml_pegawai
		$filterList = Concat($filterList, $this->jml_pegawai2->AdvancedSearch->toJson(), ","); // Field jml_pegawai2
		$filterList = Concat($filterList, $this->jml_pegawai_tidaktetap->AdvancedSearch->toJson(), ","); // Field jml_pegawai_tidaktetap
		$filterList = Concat($filterList, $this->legalitas->AdvancedSearch->toJson(), ","); // Field legalitas
		$filterList = Concat($filterList, $this->legalitas_lain->AdvancedSearch->toJson(), ","); // Field legalitas_lain
		$filterList = Concat($filterList, $this->f_npwp->AdvancedSearch->toJson(), ","); // Field f_npwp
		$filterList = Concat($filterList, $this->f_nib->AdvancedSearch->toJson(), ","); // Field f_nib
		$filterList = Concat($filterList, $this->f_siup->AdvancedSearch->toJson(), ","); // Field f_siup
		$filterList = Concat($filterList, $this->f_tdp->AdvancedSearch->toJson(), ","); // Field f_tdp
		$filterList = Concat($filterList, $this->f_lain->AdvancedSearch->toJson(), ","); // Field f_lain
		$filterList = Concat($filterList, $this->sertifikat->AdvancedSearch->toJson(), ","); // Field sertifikat
		$filterList = Concat($filterList, $this->sertifikat_lain->AdvancedSearch->toJson(), ","); // Field sertifikat_lain
		$filterList = Concat($filterList, $this->f_sertifikat->AdvancedSearch->toJson(), ","); // Field f_sertifikat
		$filterList = Concat($filterList, $this->alat_promosi->AdvancedSearch->toJson(), ","); // Field alat_promosi
		$filterList = Concat($filterList, $this->promosi_lain->AdvancedSearch->toJson(), ","); // Field promosi_lain
		$filterList = Concat($filterList, $this->f_kartunama->AdvancedSearch->toJson(), ","); // Field f_kartunama
		$filterList = Concat($filterList, $this->f_brosur->AdvancedSearch->toJson(), ","); // Field f_brosur
		$filterList = Concat($filterList, $this->f_katalog->AdvancedSearch->toJson(), ","); // Field f_katalog
		$filterList = Concat($filterList, $this->f_profile->AdvancedSearch->toJson(), ","); // Field f_profile
		$filterList = Concat($filterList, $this->tahun_ecp->AdvancedSearch->toJson(), ","); // Field tahun_ecp
		$filterList = Concat($filterList, $this->wilayah_ecp->AdvancedSearch->toJson(), ","); // Field wilayah_ecp
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
			$UserProfile->setSearchFilters(CurrentUserName(), "ft_pcplistsrch", $filters);
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

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->save();

		// Field rkid
		$this->rkid->AdvancedSearch->SearchValue = @$filter["x_rkid"];
		$this->rkid->AdvancedSearch->SearchOperator = @$filter["z_rkid"];
		$this->rkid->AdvancedSearch->SearchCondition = @$filter["v_rkid"];
		$this->rkid->AdvancedSearch->SearchValue2 = @$filter["y_rkid"];
		$this->rkid->AdvancedSearch->SearchOperator2 = @$filter["w_rkid"];
		$this->rkid->AdvancedSearch->save();

		// Field nama_peserta
		$this->nama_peserta->AdvancedSearch->SearchValue = @$filter["x_nama_peserta"];
		$this->nama_peserta->AdvancedSearch->SearchOperator = @$filter["z_nama_peserta"];
		$this->nama_peserta->AdvancedSearch->SearchCondition = @$filter["v_nama_peserta"];
		$this->nama_peserta->AdvancedSearch->SearchValue2 = @$filter["y_nama_peserta"];
		$this->nama_peserta->AdvancedSearch->SearchOperator2 = @$filter["w_nama_peserta"];
		$this->nama_peserta->AdvancedSearch->save();

		// Field email_add
		$this->email_add->AdvancedSearch->SearchValue = @$filter["x_email_add"];
		$this->email_add->AdvancedSearch->SearchOperator = @$filter["z_email_add"];
		$this->email_add->AdvancedSearch->SearchCondition = @$filter["v_email_add"];
		$this->email_add->AdvancedSearch->SearchValue2 = @$filter["y_email_add"];
		$this->email_add->AdvancedSearch->SearchOperator2 = @$filter["w_email_add"];
		$this->email_add->AdvancedSearch->save();

		// Field handphone
		$this->handphone->AdvancedSearch->SearchValue = @$filter["x_handphone"];
		$this->handphone->AdvancedSearch->SearchOperator = @$filter["z_handphone"];
		$this->handphone->AdvancedSearch->SearchCondition = @$filter["v_handphone"];
		$this->handphone->AdvancedSearch->SearchValue2 = @$filter["y_handphone"];
		$this->handphone->AdvancedSearch->SearchOperator2 = @$filter["w_handphone"];
		$this->handphone->AdvancedSearch->save();

		// Field namap
		$this->namap->AdvancedSearch->SearchValue = @$filter["x_namap"];
		$this->namap->AdvancedSearch->SearchOperator = @$filter["z_namap"];
		$this->namap->AdvancedSearch->SearchCondition = @$filter["v_namap"];
		$this->namap->AdvancedSearch->SearchValue2 = @$filter["y_namap"];
		$this->namap->AdvancedSearch->SearchOperator2 = @$filter["w_namap"];
		$this->namap->AdvancedSearch->save();

		// Field tahun_berdiri
		$this->tahun_berdiri->AdvancedSearch->SearchValue = @$filter["x_tahun_berdiri"];
		$this->tahun_berdiri->AdvancedSearch->SearchOperator = @$filter["z_tahun_berdiri"];
		$this->tahun_berdiri->AdvancedSearch->SearchCondition = @$filter["v_tahun_berdiri"];
		$this->tahun_berdiri->AdvancedSearch->SearchValue2 = @$filter["y_tahun_berdiri"];
		$this->tahun_berdiri->AdvancedSearch->SearchOperator2 = @$filter["w_tahun_berdiri"];
		$this->tahun_berdiri->AdvancedSearch->save();

		// Field alamat
		$this->alamat->AdvancedSearch->SearchValue = @$filter["x_alamat"];
		$this->alamat->AdvancedSearch->SearchOperator = @$filter["z_alamat"];
		$this->alamat->AdvancedSearch->SearchCondition = @$filter["v_alamat"];
		$this->alamat->AdvancedSearch->SearchValue2 = @$filter["y_alamat"];
		$this->alamat->AdvancedSearch->SearchOperator2 = @$filter["w_alamat"];
		$this->alamat->AdvancedSearch->save();

		// Field alamat_prod
		$this->alamat_prod->AdvancedSearch->SearchValue = @$filter["x_alamat_prod"];
		$this->alamat_prod->AdvancedSearch->SearchOperator = @$filter["z_alamat_prod"];
		$this->alamat_prod->AdvancedSearch->SearchCondition = @$filter["v_alamat_prod"];
		$this->alamat_prod->AdvancedSearch->SearchValue2 = @$filter["y_alamat_prod"];
		$this->alamat_prod->AdvancedSearch->SearchOperator2 = @$filter["w_alamat_prod"];
		$this->alamat_prod->AdvancedSearch->save();

		// Field kategori_produk
		$this->kategori_produk->AdvancedSearch->SearchValue = @$filter["x_kategori_produk"];
		$this->kategori_produk->AdvancedSearch->SearchOperator = @$filter["z_kategori_produk"];
		$this->kategori_produk->AdvancedSearch->SearchCondition = @$filter["v_kategori_produk"];
		$this->kategori_produk->AdvancedSearch->SearchValue2 = @$filter["y_kategori_produk"];
		$this->kategori_produk->AdvancedSearch->SearchOperator2 = @$filter["w_kategori_produk"];
		$this->kategori_produk->AdvancedSearch->save();

		// Field kategori_produk2
		$this->kategori_produk2->AdvancedSearch->SearchValue = @$filter["x_kategori_produk2"];
		$this->kategori_produk2->AdvancedSearch->SearchOperator = @$filter["z_kategori_produk2"];
		$this->kategori_produk2->AdvancedSearch->SearchCondition = @$filter["v_kategori_produk2"];
		$this->kategori_produk2->AdvancedSearch->SearchValue2 = @$filter["y_kategori_produk2"];
		$this->kategori_produk2->AdvancedSearch->SearchOperator2 = @$filter["w_kategori_produk2"];
		$this->kategori_produk2->AdvancedSearch->save();

		// Field kategori_produk3
		$this->kategori_produk3->AdvancedSearch->SearchValue = @$filter["x_kategori_produk3"];
		$this->kategori_produk3->AdvancedSearch->SearchOperator = @$filter["z_kategori_produk3"];
		$this->kategori_produk3->AdvancedSearch->SearchCondition = @$filter["v_kategori_produk3"];
		$this->kategori_produk3->AdvancedSearch->SearchValue2 = @$filter["y_kategori_produk3"];
		$this->kategori_produk3->AdvancedSearch->SearchOperator2 = @$filter["w_kategori_produk3"];
		$this->kategori_produk3->AdvancedSearch->save();

		// Field produk
		$this->produk->AdvancedSearch->SearchValue = @$filter["x_produk"];
		$this->produk->AdvancedSearch->SearchOperator = @$filter["z_produk"];
		$this->produk->AdvancedSearch->SearchCondition = @$filter["v_produk"];
		$this->produk->AdvancedSearch->SearchValue2 = @$filter["y_produk"];
		$this->produk->AdvancedSearch->SearchOperator2 = @$filter["w_produk"];
		$this->produk->AdvancedSearch->save();

		// Field merek_dagang
		$this->merek_dagang->AdvancedSearch->SearchValue = @$filter["x_merek_dagang"];
		$this->merek_dagang->AdvancedSearch->SearchOperator = @$filter["z_merek_dagang"];
		$this->merek_dagang->AdvancedSearch->SearchCondition = @$filter["v_merek_dagang"];
		$this->merek_dagang->AdvancedSearch->SearchValue2 = @$filter["y_merek_dagang"];
		$this->merek_dagang->AdvancedSearch->SearchOperator2 = @$filter["w_merek_dagang"];
		$this->merek_dagang->AdvancedSearch->save();

		// Field jenis_perusahaan
		$this->jenis_perusahaan->AdvancedSearch->SearchValue = @$filter["x_jenis_perusahaan"];
		$this->jenis_perusahaan->AdvancedSearch->SearchOperator = @$filter["z_jenis_perusahaan"];
		$this->jenis_perusahaan->AdvancedSearch->SearchCondition = @$filter["v_jenis_perusahaan"];
		$this->jenis_perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_jenis_perusahaan"];
		$this->jenis_perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_jenis_perusahaan"];
		$this->jenis_perusahaan->AdvancedSearch->save();

		// Field kapasitas_produksi
		$this->kapasitas_produksi->AdvancedSearch->SearchValue = @$filter["x_kapasitas_produksi"];
		$this->kapasitas_produksi->AdvancedSearch->SearchOperator = @$filter["z_kapasitas_produksi"];
		$this->kapasitas_produksi->AdvancedSearch->SearchCondition = @$filter["v_kapasitas_produksi"];
		$this->kapasitas_produksi->AdvancedSearch->SearchValue2 = @$filter["y_kapasitas_produksi"];
		$this->kapasitas_produksi->AdvancedSearch->SearchOperator2 = @$filter["w_kapasitas_produksi"];
		$this->kapasitas_produksi->AdvancedSearch->save();

		// Field omset
		$this->omset->AdvancedSearch->SearchValue = @$filter["x_omset"];
		$this->omset->AdvancedSearch->SearchOperator = @$filter["z_omset"];
		$this->omset->AdvancedSearch->SearchCondition = @$filter["v_omset"];
		$this->omset->AdvancedSearch->SearchValue2 = @$filter["y_omset"];
		$this->omset->AdvancedSearch->SearchOperator2 = @$filter["w_omset"];
		$this->omset->AdvancedSearch->save();

		// Field website
		$this->website->AdvancedSearch->SearchValue = @$filter["x_website"];
		$this->website->AdvancedSearch->SearchOperator = @$filter["z_website"];
		$this->website->AdvancedSearch->SearchCondition = @$filter["v_website"];
		$this->website->AdvancedSearch->SearchValue2 = @$filter["y_website"];
		$this->website->AdvancedSearch->SearchOperator2 = @$filter["w_website"];
		$this->website->AdvancedSearch->save();

		// Field fb
		$this->fb->AdvancedSearch->SearchValue = @$filter["x_fb"];
		$this->fb->AdvancedSearch->SearchOperator = @$filter["z_fb"];
		$this->fb->AdvancedSearch->SearchCondition = @$filter["v_fb"];
		$this->fb->AdvancedSearch->SearchValue2 = @$filter["y_fb"];
		$this->fb->AdvancedSearch->SearchOperator2 = @$filter["w_fb"];
		$this->fb->AdvancedSearch->save();

		// Field ig
		$this->ig->AdvancedSearch->SearchValue = @$filter["x_ig"];
		$this->ig->AdvancedSearch->SearchOperator = @$filter["z_ig"];
		$this->ig->AdvancedSearch->SearchCondition = @$filter["v_ig"];
		$this->ig->AdvancedSearch->SearchValue2 = @$filter["y_ig"];
		$this->ig->AdvancedSearch->SearchOperator2 = @$filter["w_ig"];
		$this->ig->AdvancedSearch->save();

		// Field sosmed_lain
		$this->sosmed_lain->AdvancedSearch->SearchValue = @$filter["x_sosmed_lain"];
		$this->sosmed_lain->AdvancedSearch->SearchOperator = @$filter["z_sosmed_lain"];
		$this->sosmed_lain->AdvancedSearch->SearchCondition = @$filter["v_sosmed_lain"];
		$this->sosmed_lain->AdvancedSearch->SearchValue2 = @$filter["y_sosmed_lain"];
		$this->sosmed_lain->AdvancedSearch->SearchOperator2 = @$filter["w_sosmed_lain"];
		$this->sosmed_lain->AdvancedSearch->save();

		// Field jml_pegawai
		$this->jml_pegawai->AdvancedSearch->SearchValue = @$filter["x_jml_pegawai"];
		$this->jml_pegawai->AdvancedSearch->SearchOperator = @$filter["z_jml_pegawai"];
		$this->jml_pegawai->AdvancedSearch->SearchCondition = @$filter["v_jml_pegawai"];
		$this->jml_pegawai->AdvancedSearch->SearchValue2 = @$filter["y_jml_pegawai"];
		$this->jml_pegawai->AdvancedSearch->SearchOperator2 = @$filter["w_jml_pegawai"];
		$this->jml_pegawai->AdvancedSearch->save();

		// Field jml_pegawai2
		$this->jml_pegawai2->AdvancedSearch->SearchValue = @$filter["x_jml_pegawai2"];
		$this->jml_pegawai2->AdvancedSearch->SearchOperator = @$filter["z_jml_pegawai2"];
		$this->jml_pegawai2->AdvancedSearch->SearchCondition = @$filter["v_jml_pegawai2"];
		$this->jml_pegawai2->AdvancedSearch->SearchValue2 = @$filter["y_jml_pegawai2"];
		$this->jml_pegawai2->AdvancedSearch->SearchOperator2 = @$filter["w_jml_pegawai2"];
		$this->jml_pegawai2->AdvancedSearch->save();

		// Field jml_pegawai_tidaktetap
		$this->jml_pegawai_tidaktetap->AdvancedSearch->SearchValue = @$filter["x_jml_pegawai_tidaktetap"];
		$this->jml_pegawai_tidaktetap->AdvancedSearch->SearchOperator = @$filter["z_jml_pegawai_tidaktetap"];
		$this->jml_pegawai_tidaktetap->AdvancedSearch->SearchCondition = @$filter["v_jml_pegawai_tidaktetap"];
		$this->jml_pegawai_tidaktetap->AdvancedSearch->SearchValue2 = @$filter["y_jml_pegawai_tidaktetap"];
		$this->jml_pegawai_tidaktetap->AdvancedSearch->SearchOperator2 = @$filter["w_jml_pegawai_tidaktetap"];
		$this->jml_pegawai_tidaktetap->AdvancedSearch->save();

		// Field legalitas
		$this->legalitas->AdvancedSearch->SearchValue = @$filter["x_legalitas"];
		$this->legalitas->AdvancedSearch->SearchOperator = @$filter["z_legalitas"];
		$this->legalitas->AdvancedSearch->SearchCondition = @$filter["v_legalitas"];
		$this->legalitas->AdvancedSearch->SearchValue2 = @$filter["y_legalitas"];
		$this->legalitas->AdvancedSearch->SearchOperator2 = @$filter["w_legalitas"];
		$this->legalitas->AdvancedSearch->save();

		// Field legalitas_lain
		$this->legalitas_lain->AdvancedSearch->SearchValue = @$filter["x_legalitas_lain"];
		$this->legalitas_lain->AdvancedSearch->SearchOperator = @$filter["z_legalitas_lain"];
		$this->legalitas_lain->AdvancedSearch->SearchCondition = @$filter["v_legalitas_lain"];
		$this->legalitas_lain->AdvancedSearch->SearchValue2 = @$filter["y_legalitas_lain"];
		$this->legalitas_lain->AdvancedSearch->SearchOperator2 = @$filter["w_legalitas_lain"];
		$this->legalitas_lain->AdvancedSearch->save();

		// Field f_npwp
		$this->f_npwp->AdvancedSearch->SearchValue = @$filter["x_f_npwp"];
		$this->f_npwp->AdvancedSearch->SearchOperator = @$filter["z_f_npwp"];
		$this->f_npwp->AdvancedSearch->SearchCondition = @$filter["v_f_npwp"];
		$this->f_npwp->AdvancedSearch->SearchValue2 = @$filter["y_f_npwp"];
		$this->f_npwp->AdvancedSearch->SearchOperator2 = @$filter["w_f_npwp"];
		$this->f_npwp->AdvancedSearch->save();

		// Field f_nib
		$this->f_nib->AdvancedSearch->SearchValue = @$filter["x_f_nib"];
		$this->f_nib->AdvancedSearch->SearchOperator = @$filter["z_f_nib"];
		$this->f_nib->AdvancedSearch->SearchCondition = @$filter["v_f_nib"];
		$this->f_nib->AdvancedSearch->SearchValue2 = @$filter["y_f_nib"];
		$this->f_nib->AdvancedSearch->SearchOperator2 = @$filter["w_f_nib"];
		$this->f_nib->AdvancedSearch->save();

		// Field f_siup
		$this->f_siup->AdvancedSearch->SearchValue = @$filter["x_f_siup"];
		$this->f_siup->AdvancedSearch->SearchOperator = @$filter["z_f_siup"];
		$this->f_siup->AdvancedSearch->SearchCondition = @$filter["v_f_siup"];
		$this->f_siup->AdvancedSearch->SearchValue2 = @$filter["y_f_siup"];
		$this->f_siup->AdvancedSearch->SearchOperator2 = @$filter["w_f_siup"];
		$this->f_siup->AdvancedSearch->save();

		// Field f_tdp
		$this->f_tdp->AdvancedSearch->SearchValue = @$filter["x_f_tdp"];
		$this->f_tdp->AdvancedSearch->SearchOperator = @$filter["z_f_tdp"];
		$this->f_tdp->AdvancedSearch->SearchCondition = @$filter["v_f_tdp"];
		$this->f_tdp->AdvancedSearch->SearchValue2 = @$filter["y_f_tdp"];
		$this->f_tdp->AdvancedSearch->SearchOperator2 = @$filter["w_f_tdp"];
		$this->f_tdp->AdvancedSearch->save();

		// Field f_lain
		$this->f_lain->AdvancedSearch->SearchValue = @$filter["x_f_lain"];
		$this->f_lain->AdvancedSearch->SearchOperator = @$filter["z_f_lain"];
		$this->f_lain->AdvancedSearch->SearchCondition = @$filter["v_f_lain"];
		$this->f_lain->AdvancedSearch->SearchValue2 = @$filter["y_f_lain"];
		$this->f_lain->AdvancedSearch->SearchOperator2 = @$filter["w_f_lain"];
		$this->f_lain->AdvancedSearch->save();

		// Field sertifikat
		$this->sertifikat->AdvancedSearch->SearchValue = @$filter["x_sertifikat"];
		$this->sertifikat->AdvancedSearch->SearchOperator = @$filter["z_sertifikat"];
		$this->sertifikat->AdvancedSearch->SearchCondition = @$filter["v_sertifikat"];
		$this->sertifikat->AdvancedSearch->SearchValue2 = @$filter["y_sertifikat"];
		$this->sertifikat->AdvancedSearch->SearchOperator2 = @$filter["w_sertifikat"];
		$this->sertifikat->AdvancedSearch->save();

		// Field sertifikat_lain
		$this->sertifikat_lain->AdvancedSearch->SearchValue = @$filter["x_sertifikat_lain"];
		$this->sertifikat_lain->AdvancedSearch->SearchOperator = @$filter["z_sertifikat_lain"];
		$this->sertifikat_lain->AdvancedSearch->SearchCondition = @$filter["v_sertifikat_lain"];
		$this->sertifikat_lain->AdvancedSearch->SearchValue2 = @$filter["y_sertifikat_lain"];
		$this->sertifikat_lain->AdvancedSearch->SearchOperator2 = @$filter["w_sertifikat_lain"];
		$this->sertifikat_lain->AdvancedSearch->save();

		// Field f_sertifikat
		$this->f_sertifikat->AdvancedSearch->SearchValue = @$filter["x_f_sertifikat"];
		$this->f_sertifikat->AdvancedSearch->SearchOperator = @$filter["z_f_sertifikat"];
		$this->f_sertifikat->AdvancedSearch->SearchCondition = @$filter["v_f_sertifikat"];
		$this->f_sertifikat->AdvancedSearch->SearchValue2 = @$filter["y_f_sertifikat"];
		$this->f_sertifikat->AdvancedSearch->SearchOperator2 = @$filter["w_f_sertifikat"];
		$this->f_sertifikat->AdvancedSearch->save();

		// Field alat_promosi
		$this->alat_promosi->AdvancedSearch->SearchValue = @$filter["x_alat_promosi"];
		$this->alat_promosi->AdvancedSearch->SearchOperator = @$filter["z_alat_promosi"];
		$this->alat_promosi->AdvancedSearch->SearchCondition = @$filter["v_alat_promosi"];
		$this->alat_promosi->AdvancedSearch->SearchValue2 = @$filter["y_alat_promosi"];
		$this->alat_promosi->AdvancedSearch->SearchOperator2 = @$filter["w_alat_promosi"];
		$this->alat_promosi->AdvancedSearch->save();

		// Field promosi_lain
		$this->promosi_lain->AdvancedSearch->SearchValue = @$filter["x_promosi_lain"];
		$this->promosi_lain->AdvancedSearch->SearchOperator = @$filter["z_promosi_lain"];
		$this->promosi_lain->AdvancedSearch->SearchCondition = @$filter["v_promosi_lain"];
		$this->promosi_lain->AdvancedSearch->SearchValue2 = @$filter["y_promosi_lain"];
		$this->promosi_lain->AdvancedSearch->SearchOperator2 = @$filter["w_promosi_lain"];
		$this->promosi_lain->AdvancedSearch->save();

		// Field f_kartunama
		$this->f_kartunama->AdvancedSearch->SearchValue = @$filter["x_f_kartunama"];
		$this->f_kartunama->AdvancedSearch->SearchOperator = @$filter["z_f_kartunama"];
		$this->f_kartunama->AdvancedSearch->SearchCondition = @$filter["v_f_kartunama"];
		$this->f_kartunama->AdvancedSearch->SearchValue2 = @$filter["y_f_kartunama"];
		$this->f_kartunama->AdvancedSearch->SearchOperator2 = @$filter["w_f_kartunama"];
		$this->f_kartunama->AdvancedSearch->save();

		// Field f_brosur
		$this->f_brosur->AdvancedSearch->SearchValue = @$filter["x_f_brosur"];
		$this->f_brosur->AdvancedSearch->SearchOperator = @$filter["z_f_brosur"];
		$this->f_brosur->AdvancedSearch->SearchCondition = @$filter["v_f_brosur"];
		$this->f_brosur->AdvancedSearch->SearchValue2 = @$filter["y_f_brosur"];
		$this->f_brosur->AdvancedSearch->SearchOperator2 = @$filter["w_f_brosur"];
		$this->f_brosur->AdvancedSearch->save();

		// Field f_katalog
		$this->f_katalog->AdvancedSearch->SearchValue = @$filter["x_f_katalog"];
		$this->f_katalog->AdvancedSearch->SearchOperator = @$filter["z_f_katalog"];
		$this->f_katalog->AdvancedSearch->SearchCondition = @$filter["v_f_katalog"];
		$this->f_katalog->AdvancedSearch->SearchValue2 = @$filter["y_f_katalog"];
		$this->f_katalog->AdvancedSearch->SearchOperator2 = @$filter["w_f_katalog"];
		$this->f_katalog->AdvancedSearch->save();

		// Field f_profile
		$this->f_profile->AdvancedSearch->SearchValue = @$filter["x_f_profile"];
		$this->f_profile->AdvancedSearch->SearchOperator = @$filter["z_f_profile"];
		$this->f_profile->AdvancedSearch->SearchCondition = @$filter["v_f_profile"];
		$this->f_profile->AdvancedSearch->SearchValue2 = @$filter["y_f_profile"];
		$this->f_profile->AdvancedSearch->SearchOperator2 = @$filter["w_f_profile"];
		$this->f_profile->AdvancedSearch->save();

		// Field tahun_ecp
		$this->tahun_ecp->AdvancedSearch->SearchValue = @$filter["x_tahun_ecp"];
		$this->tahun_ecp->AdvancedSearch->SearchOperator = @$filter["z_tahun_ecp"];
		$this->tahun_ecp->AdvancedSearch->SearchCondition = @$filter["v_tahun_ecp"];
		$this->tahun_ecp->AdvancedSearch->SearchValue2 = @$filter["y_tahun_ecp"];
		$this->tahun_ecp->AdvancedSearch->SearchOperator2 = @$filter["w_tahun_ecp"];
		$this->tahun_ecp->AdvancedSearch->save();

		// Field wilayah_ecp
		$this->wilayah_ecp->AdvancedSearch->SearchValue = @$filter["x_wilayah_ecp"];
		$this->wilayah_ecp->AdvancedSearch->SearchOperator = @$filter["z_wilayah_ecp"];
		$this->wilayah_ecp->AdvancedSearch->SearchCondition = @$filter["v_wilayah_ecp"];
		$this->wilayah_ecp->AdvancedSearch->SearchValue2 = @$filter["y_wilayah_ecp"];
		$this->wilayah_ecp->AdvancedSearch->SearchOperator2 = @$filter["w_wilayah_ecp"];
		$this->wilayah_ecp->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->nama_peserta, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->email_add, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->handphone, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->alamat, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->alamat_prod, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->kategori_produk, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->kategori_produk2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->kategori_produk3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->produk, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->merek_dagang, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->jenis_perusahaan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->kapasitas_produksi, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->website, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->fb, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ig, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->sosmed_lain, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->legalitas, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->legalitas_lain, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_npwp, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_nib, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_siup, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_tdp, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_lain, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->sertifikat, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->sertifikat_lain, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_sertifikat, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->alat_promosi, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->promosi_lain, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_kartunama, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_brosur, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_katalog, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->f_profile, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->wilayah_ecp, $arKeywords, $type);
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
		if (!$Security->canSearch())
			return "";
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

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->nama_peserta); // nama_peserta
			$this->updateSort($this->email_add); // email_add
			$this->updateSort($this->handphone); // handphone
			$this->updateSort($this->namap); // namap
			$this->updateSort($this->kategori_produk); // kategori_produk
			$this->updateSort($this->kategori_produk2); // kategori_produk2
			$this->updateSort($this->kategori_produk3); // kategori_produk3
			$this->updateSort($this->produk); // produk
			$this->updateSort($this->merek_dagang); // merek_dagang
			$this->updateSort($this->jenis_perusahaan); // jenis_perusahaan
			$this->updateSort($this->kapasitas_produksi); // kapasitas_produksi
			$this->updateSort($this->omset); // omset
			$this->updateSort($this->website); // website
			$this->updateSort($this->jml_pegawai); // jml_pegawai
			$this->updateSort($this->jml_pegawai2); // jml_pegawai2
			$this->updateSort($this->jml_pegawai_tidaktetap); // jml_pegawai_tidaktetap
			$this->updateSort($this->legalitas); // legalitas
			$this->updateSort($this->legalitas_lain); // legalitas_lain
			$this->updateSort($this->sertifikat); // sertifikat
			$this->updateSort($this->sertifikat_lain); // sertifikat_lain
			$this->updateSort($this->alat_promosi); // alat_promosi
			$this->updateSort($this->promosi_lain); // promosi_lain
			$this->updateSort($this->tahun_ecp); // tahun_ecp
			$this->updateSort($this->wilayah_ecp); // wilayah_ecp
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->rkid->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->nama_peserta->setSort("");
				$this->email_add->setSort("");
				$this->handphone->setSort("");
				$this->namap->setSort("");
				$this->kategori_produk->setSort("");
				$this->kategori_produk2->setSort("");
				$this->kategori_produk3->setSort("");
				$this->produk->setSort("");
				$this->merek_dagang->setSort("");
				$this->jenis_perusahaan->setSort("");
				$this->kapasitas_produksi->setSort("");
				$this->omset->setSort("");
				$this->website->setSort("");
				$this->jml_pegawai->setSort("");
				$this->jml_pegawai2->setSort("");
				$this->jml_pegawai_tidaktetap->setSort("");
				$this->legalitas->setSort("");
				$this->legalitas_lain->setSort("");
				$this->sertifikat->setSort("");
				$this->sertifikat_lain->setSort("");
				$this->alat_promosi->setSort("");
				$this->promosi_lain->setSort("");
				$this->tahun_ecp->setSort("");
				$this->wilayah_ecp->setSort("");
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
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

		// "detail_t_ecp"
		$item = &$this->ListOptions->add("detail_t_ecp");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 't_ecp') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t_ecp_grid"]))
			$GLOBALS["t_ecp_grid"] = new t_ecp_grid();

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new SubPages();
		$pages->add("t_ecp");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->moveTo(0);
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
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"t_pcp\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
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

		// "detail_t_ecp"
		$opt = $this->ListOptions["detail_t_ecp"];
		if ($Security->allowList(CurrentProjectID() . 't_ecp')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("t_ecp", "TblCaption");
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("t_ecplist.php?" . Config("TABLE_SHOW_MASTER") . "=t_pcp&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t_ecp_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 't_pcp')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=t_ecp");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "t_ecp";
			}
			if ($GLOBALS["t_ecp_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 't_pcp')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=t_ecp");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "t_ecp";
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item = &$option->add("detailadd_t_ecp");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=t_ecp");
		if (!isset($GLOBALS["t_ecp"]))
			$GLOBALS["t_ecp"] = new t_ecp();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["t_ecp"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t_ecp"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 't_pcp') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "t_ecp";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ft_pcplistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ft_pcplistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.ft_pcplist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
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
		$this->rkid->setDbValue($row['rkid']);
		$this->nama_peserta->setDbValue($row['nama_peserta']);
		$this->email_add->setDbValue($row['email_add']);
		$this->handphone->setDbValue($row['handphone']);
		$this->namap->setDbValue($row['namap']);
		$this->tahun_berdiri->setDbValue($row['tahun_berdiri']);
		$this->alamat->setDbValue($row['alamat']);
		$this->alamat_prod->setDbValue($row['alamat_prod']);
		$this->kategori_produk->setDbValue($row['kategori_produk']);
		$this->kategori_produk2->setDbValue($row['kategori_produk2']);
		$this->kategori_produk3->setDbValue($row['kategori_produk3']);
		$this->produk->setDbValue($row['produk']);
		$this->merek_dagang->setDbValue($row['merek_dagang']);
		$this->jenis_perusahaan->setDbValue($row['jenis_perusahaan']);
		$this->kapasitas_produksi->setDbValue($row['kapasitas_produksi']);
		$this->omset->setDbValue($row['omset']);
		$this->website->setDbValue($row['website']);
		$this->fb->setDbValue($row['fb']);
		$this->ig->setDbValue($row['ig']);
		$this->sosmed_lain->setDbValue($row['sosmed_lain']);
		$this->jml_pegawai->setDbValue($row['jml_pegawai']);
		$this->jml_pegawai2->setDbValue($row['jml_pegawai2']);
		$this->jml_pegawai_tidaktetap->setDbValue($row['jml_pegawai_tidaktetap']);
		$this->legalitas->setDbValue($row['legalitas']);
		$this->legalitas_lain->setDbValue($row['legalitas_lain']);
		$this->f_npwp->Upload->DbValue = $row['f_npwp'];
		$this->f_npwp->setDbValue($this->f_npwp->Upload->DbValue);
		$this->f_nib->Upload->DbValue = $row['f_nib'];
		$this->f_nib->setDbValue($this->f_nib->Upload->DbValue);
		$this->f_siup->Upload->DbValue = $row['f_siup'];
		$this->f_siup->setDbValue($this->f_siup->Upload->DbValue);
		$this->f_tdp->Upload->DbValue = $row['f_tdp'];
		$this->f_tdp->setDbValue($this->f_tdp->Upload->DbValue);
		$this->f_lain->Upload->DbValue = $row['f_lain'];
		$this->f_lain->setDbValue($this->f_lain->Upload->DbValue);
		$this->sertifikat->setDbValue($row['sertifikat']);
		$this->sertifikat_lain->setDbValue($row['sertifikat_lain']);
		$this->f_sertifikat->Upload->DbValue = $row['f_sertifikat'];
		$this->f_sertifikat->setDbValue($this->f_sertifikat->Upload->DbValue);
		$this->alat_promosi->setDbValue($row['alat_promosi']);
		$this->promosi_lain->setDbValue($row['promosi_lain']);
		$this->f_kartunama->Upload->DbValue = $row['f_kartunama'];
		$this->f_kartunama->setDbValue($this->f_kartunama->Upload->DbValue);
		$this->f_brosur->Upload->DbValue = $row['f_brosur'];
		$this->f_brosur->setDbValue($this->f_brosur->Upload->DbValue);
		$this->f_katalog->Upload->DbValue = $row['f_katalog'];
		$this->f_katalog->setDbValue($this->f_katalog->Upload->DbValue);
		$this->f_profile->Upload->DbValue = $row['f_profile'];
		$this->f_profile->setDbValue($this->f_profile->Upload->DbValue);
		$this->tahun_ecp->setDbValue($row['tahun_ecp']);
		$this->wilayah_ecp->setDbValue($row['wilayah_ecp']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['rkid'] = NULL;
		$row['nama_peserta'] = NULL;
		$row['email_add'] = NULL;
		$row['handphone'] = NULL;
		$row['namap'] = NULL;
		$row['tahun_berdiri'] = NULL;
		$row['alamat'] = NULL;
		$row['alamat_prod'] = NULL;
		$row['kategori_produk'] = NULL;
		$row['kategori_produk2'] = NULL;
		$row['kategori_produk3'] = NULL;
		$row['produk'] = NULL;
		$row['merek_dagang'] = NULL;
		$row['jenis_perusahaan'] = NULL;
		$row['kapasitas_produksi'] = NULL;
		$row['omset'] = NULL;
		$row['website'] = NULL;
		$row['fb'] = NULL;
		$row['ig'] = NULL;
		$row['sosmed_lain'] = NULL;
		$row['jml_pegawai'] = NULL;
		$row['jml_pegawai2'] = NULL;
		$row['jml_pegawai_tidaktetap'] = NULL;
		$row['legalitas'] = NULL;
		$row['legalitas_lain'] = NULL;
		$row['f_npwp'] = NULL;
		$row['f_nib'] = NULL;
		$row['f_siup'] = NULL;
		$row['f_tdp'] = NULL;
		$row['f_lain'] = NULL;
		$row['sertifikat'] = NULL;
		$row['sertifikat_lain'] = NULL;
		$row['f_sertifikat'] = NULL;
		$row['alat_promosi'] = NULL;
		$row['promosi_lain'] = NULL;
		$row['f_kartunama'] = NULL;
		$row['f_brosur'] = NULL;
		$row['f_katalog'] = NULL;
		$row['f_profile'] = NULL;
		$row['tahun_ecp'] = NULL;
		$row['wilayah_ecp'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
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
		// id
		// rkid
		// nama_peserta
		// email_add
		// handphone
		// namap
		// tahun_berdiri
		// alamat
		// alamat_prod
		// kategori_produk
		// kategori_produk2
		// kategori_produk3
		// produk
		// merek_dagang
		// jenis_perusahaan
		// kapasitas_produksi
		// omset
		// website
		// fb
		// ig
		// sosmed_lain
		// jml_pegawai
		// jml_pegawai2
		// jml_pegawai_tidaktetap
		// legalitas
		// legalitas_lain
		// f_npwp
		// f_nib
		// f_siup
		// f_tdp
		// f_lain
		// sertifikat
		// sertifikat_lain
		// f_sertifikat
		// alat_promosi
		// promosi_lain
		// f_kartunama
		// f_brosur
		// f_katalog
		// f_profile
		// tahun_ecp
		// wilayah_ecp

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// rkid
			$this->rkid->ViewValue = $this->rkid->CurrentValue;
			$this->rkid->ViewValue = FormatNumber($this->rkid->ViewValue, 0, -2, -2, -2);
			$this->rkid->ViewCustomAttributes = "";

			// nama_peserta
			$this->nama_peserta->ViewValue = $this->nama_peserta->CurrentValue;
			$this->nama_peserta->ViewCustomAttributes = "";

			// email_add
			$this->email_add->ViewValue = $this->email_add->CurrentValue;
			$this->email_add->ViewCustomAttributes = "";

			// handphone
			$this->handphone->ViewValue = $this->handphone->CurrentValue;
			$this->handphone->ViewCustomAttributes = "";

			// namap
			$this->namap->ViewValue = $this->namap->CurrentValue;
			$arwrk = [];
			$arwrk[1] = $this->namap->CurrentValue;
			$this->namap->ViewValue = $this->namap->displayValue($arwrk);
			$this->namap->ViewCustomAttributes = "";

			// tahun_berdiri
			$this->tahun_berdiri->ViewValue = $this->tahun_berdiri->CurrentValue;
			$this->tahun_berdiri->ViewValue = FormatNumber($this->tahun_berdiri->ViewValue, 0, -2, -2, -2);
			$this->tahun_berdiri->ViewCustomAttributes = "";

			// alamat_prod
			$this->alamat_prod->ViewValue = $this->alamat_prod->CurrentValue;
			$this->alamat_prod->ViewCustomAttributes = "";

			// kategori_produk
			$curVal = strval($this->kategori_produk->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk->ViewValue = $this->kategori_produk->lookupCacheOption($curVal);
				if ($this->kategori_produk->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk->ViewValue = $this->kategori_produk->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk->ViewValue = $this->kategori_produk->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk->ViewValue = NULL;
			}
			$this->kategori_produk->ViewCustomAttributes = "";

			// kategori_produk2
			$curVal = strval($this->kategori_produk2->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->lookupCacheOption($curVal);
				if ($this->kategori_produk2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk2->ViewValue = $this->kategori_produk2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk2->ViewValue = $this->kategori_produk2->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk2->ViewValue = NULL;
			}
			$this->kategori_produk2->ViewCustomAttributes = "";

			// kategori_produk3
			$curVal = strval($this->kategori_produk3->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->lookupCacheOption($curVal);
				if ($this->kategori_produk3->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk3->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk3->ViewValue = $this->kategori_produk3->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk3->ViewValue = $this->kategori_produk3->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk3->ViewValue = NULL;
			}
			$this->kategori_produk3->ViewCustomAttributes = "";

			// produk
			$this->produk->ViewValue = $this->produk->CurrentValue;
			$this->produk->ViewCustomAttributes = "";

			// merek_dagang
			$this->merek_dagang->ViewValue = $this->merek_dagang->CurrentValue;
			$this->merek_dagang->ViewCustomAttributes = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->ViewValue = $this->jenis_perusahaan->CurrentValue;
			$this->jenis_perusahaan->ViewCustomAttributes = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->ViewValue = $this->kapasitas_produksi->CurrentValue;
			$this->kapasitas_produksi->ViewCustomAttributes = "";

			// omset
			$this->omset->ViewValue = $this->omset->CurrentValue;
			$this->omset->ViewCustomAttributes = "";

			// website
			$this->website->ViewValue = $this->website->CurrentValue;
			$this->website->ViewCustomAttributes = "";

			// fb
			$this->fb->ViewValue = $this->fb->CurrentValue;
			$this->fb->ViewCustomAttributes = "";

			// ig
			$this->ig->ViewValue = $this->ig->CurrentValue;
			$this->ig->ViewCustomAttributes = "";

			// sosmed_lain
			$this->sosmed_lain->ViewValue = $this->sosmed_lain->CurrentValue;
			$this->sosmed_lain->ViewCustomAttributes = "";

			// jml_pegawai
			if (strval($this->jml_pegawai->CurrentValue) != "") {
				$this->jml_pegawai->ViewValue = $this->jml_pegawai->optionCaption($this->jml_pegawai->CurrentValue);
			} else {
				$this->jml_pegawai->ViewValue = NULL;
			}
			$this->jml_pegawai->ViewCustomAttributes = "";

			// jml_pegawai2
			$this->jml_pegawai2->ViewValue = $this->jml_pegawai2->CurrentValue;
			$this->jml_pegawai2->ViewCustomAttributes = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->ViewValue = $this->jml_pegawai_tidaktetap->CurrentValue;
			$this->jml_pegawai_tidaktetap->ViewCustomAttributes = "";

			// legalitas
			if (strval($this->legalitas->CurrentValue) != "") {
				$this->legalitas->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->legalitas->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->legalitas->ViewValue->add($this->legalitas->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->legalitas->ViewValue = NULL;
			}
			$this->legalitas->ViewCustomAttributes = "";

			// legalitas_lain
			$this->legalitas_lain->ViewValue = $this->legalitas_lain->CurrentValue;
			$this->legalitas_lain->ViewCustomAttributes = "";

			// f_npwp
			$this->f_npwp->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_npwp->Upload->DbValue)) {
				$this->f_npwp->ViewValue = $this->f_npwp->Upload->DbValue;
			} else {
				$this->f_npwp->ViewValue = "";
			}
			$this->f_npwp->ViewCustomAttributes = "";

			// f_nib
			$this->f_nib->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_nib->Upload->DbValue)) {
				$this->f_nib->ViewValue = $this->f_nib->Upload->DbValue;
			} else {
				$this->f_nib->ViewValue = "";
			}
			$this->f_nib->ViewCustomAttributes = "";

			// f_siup
			$this->f_siup->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_siup->Upload->DbValue)) {
				$this->f_siup->ViewValue = $this->f_siup->Upload->DbValue;
			} else {
				$this->f_siup->ViewValue = "";
			}
			$this->f_siup->ViewCustomAttributes = "";

			// f_tdp
			$this->f_tdp->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_tdp->Upload->DbValue)) {
				$this->f_tdp->ViewValue = $this->f_tdp->Upload->DbValue;
			} else {
				$this->f_tdp->ViewValue = "";
			}
			$this->f_tdp->ViewCustomAttributes = "";

			// f_lain
			$this->f_lain->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_lain->Upload->DbValue)) {
				$this->f_lain->ViewValue = $this->f_lain->Upload->DbValue;
			} else {
				$this->f_lain->ViewValue = "";
			}
			$this->f_lain->ViewCustomAttributes = "";

			// sertifikat
			if (strval($this->sertifikat->CurrentValue) != "") {
				$this->sertifikat->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->sertifikat->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->sertifikat->ViewValue->add($this->sertifikat->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->sertifikat->ViewValue = NULL;
			}
			$this->sertifikat->ViewCustomAttributes = "";

			// sertifikat_lain
			$this->sertifikat_lain->ViewValue = $this->sertifikat_lain->CurrentValue;
			$this->sertifikat_lain->ViewCustomAttributes = "";

			// f_sertifikat
			$this->f_sertifikat->UploadPath = "berkas/sertifikat_ecp/";
			if (!EmptyValue($this->f_sertifikat->Upload->DbValue)) {
				$this->f_sertifikat->ViewValue = $this->f_sertifikat->Upload->DbValue;
			} else {
				$this->f_sertifikat->ViewValue = "";
			}
			$this->f_sertifikat->ViewCustomAttributes = "";

			// alat_promosi
			if (strval($this->alat_promosi->CurrentValue) != "") {
				$this->alat_promosi->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->alat_promosi->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->alat_promosi->ViewValue->add($this->alat_promosi->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->alat_promosi->ViewValue = NULL;
			}
			$this->alat_promosi->ViewCustomAttributes = "";

			// promosi_lain
			$this->promosi_lain->ViewValue = $this->promosi_lain->CurrentValue;
			$this->promosi_lain->ViewCustomAttributes = "";

			// f_kartunama
			$this->f_kartunama->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_kartunama->Upload->DbValue)) {
				$this->f_kartunama->ViewValue = $this->f_kartunama->Upload->DbValue;
			} else {
				$this->f_kartunama->ViewValue = "";
			}
			$this->f_kartunama->ViewCustomAttributes = "";

			// f_brosur
			$this->f_brosur->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_brosur->Upload->DbValue)) {
				$this->f_brosur->ViewValue = $this->f_brosur->Upload->DbValue;
			} else {
				$this->f_brosur->ViewValue = "";
			}
			$this->f_brosur->ViewCustomAttributes = "";

			// f_katalog
			$this->f_katalog->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_katalog->Upload->DbValue)) {
				$this->f_katalog->ViewValue = $this->f_katalog->Upload->DbValue;
			} else {
				$this->f_katalog->ViewValue = "";
			}
			$this->f_katalog->ViewCustomAttributes = "";

			// f_profile
			$this->f_profile->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_profile->Upload->DbValue)) {
				$this->f_profile->ViewValue = $this->f_profile->Upload->DbValue;
			} else {
				$this->f_profile->ViewValue = "";
			}
			$this->f_profile->ViewCustomAttributes = "";

			// tahun_ecp
			$this->tahun_ecp->ViewValue = $this->tahun_ecp->CurrentValue;
			$this->tahun_ecp->ViewCustomAttributes = "";

			// wilayah_ecp
			$this->wilayah_ecp->ViewValue = $this->wilayah_ecp->CurrentValue;
			$this->wilayah_ecp->ViewCustomAttributes = "";

			// nama_peserta
			$this->nama_peserta->LinkCustomAttributes = "";
			$this->nama_peserta->HrefValue = "";
			$this->nama_peserta->TooltipValue = "";

			// email_add
			$this->email_add->LinkCustomAttributes = "";
			$this->email_add->HrefValue = "";
			$this->email_add->TooltipValue = "";

			// handphone
			$this->handphone->LinkCustomAttributes = "";
			$this->handphone->HrefValue = "";
			$this->handphone->TooltipValue = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";
			$this->namap->TooltipValue = "";

			// kategori_produk
			$this->kategori_produk->LinkCustomAttributes = "";
			$this->kategori_produk->HrefValue = "";
			$this->kategori_produk->TooltipValue = "";

			// kategori_produk2
			$this->kategori_produk2->LinkCustomAttributes = "";
			$this->kategori_produk2->HrefValue = "";
			$this->kategori_produk2->TooltipValue = "";

			// kategori_produk3
			$this->kategori_produk3->LinkCustomAttributes = "";
			$this->kategori_produk3->HrefValue = "";
			$this->kategori_produk3->TooltipValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";
			$this->produk->TooltipValue = "";

			// merek_dagang
			$this->merek_dagang->LinkCustomAttributes = "";
			$this->merek_dagang->HrefValue = "";
			$this->merek_dagang->TooltipValue = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->LinkCustomAttributes = "";
			$this->jenis_perusahaan->HrefValue = "";
			$this->jenis_perusahaan->TooltipValue = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->LinkCustomAttributes = "";
			$this->kapasitas_produksi->HrefValue = "";
			$this->kapasitas_produksi->TooltipValue = "";

			// omset
			$this->omset->LinkCustomAttributes = "";
			$this->omset->HrefValue = "";
			$this->omset->TooltipValue = "";

			// website
			$this->website->LinkCustomAttributes = "";
			$this->website->HrefValue = "";
			$this->website->TooltipValue = "";

			// jml_pegawai
			$this->jml_pegawai->LinkCustomAttributes = "";
			$this->jml_pegawai->HrefValue = "";
			$this->jml_pegawai->TooltipValue = "";

			// jml_pegawai2
			$this->jml_pegawai2->LinkCustomAttributes = "";
			$this->jml_pegawai2->HrefValue = "";
			$this->jml_pegawai2->TooltipValue = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->LinkCustomAttributes = "";
			$this->jml_pegawai_tidaktetap->HrefValue = "";
			$this->jml_pegawai_tidaktetap->TooltipValue = "";

			// legalitas
			$this->legalitas->LinkCustomAttributes = "";
			$this->legalitas->HrefValue = "";
			$this->legalitas->TooltipValue = "";

			// legalitas_lain
			$this->legalitas_lain->LinkCustomAttributes = "";
			$this->legalitas_lain->HrefValue = "";
			$this->legalitas_lain->TooltipValue = "";

			// sertifikat
			$this->sertifikat->LinkCustomAttributes = "";
			$this->sertifikat->HrefValue = "";
			$this->sertifikat->TooltipValue = "";

			// sertifikat_lain
			$this->sertifikat_lain->LinkCustomAttributes = "";
			$this->sertifikat_lain->HrefValue = "";
			$this->sertifikat_lain->TooltipValue = "";

			// alat_promosi
			$this->alat_promosi->LinkCustomAttributes = "";
			$this->alat_promosi->HrefValue = "";
			$this->alat_promosi->TooltipValue = "";

			// promosi_lain
			$this->promosi_lain->LinkCustomAttributes = "";
			$this->promosi_lain->HrefValue = "";
			$this->promosi_lain->TooltipValue = "";

			// tahun_ecp
			$this->tahun_ecp->LinkCustomAttributes = "";
			$this->tahun_ecp->HrefValue = "";
			$this->tahun_ecp->TooltipValue = "";

			// wilayah_ecp
			$this->wilayah_ecp->LinkCustomAttributes = "";
			$this->wilayah_ecp->HrefValue = "";
			$this->wilayah_ecp->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft_pcplistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
			if ($masterTblVar == "excp") {
				$validMaster = TRUE;
				if (($parm = Get("fk_rkid", Get("rkid"))) !== NULL) {
					$GLOBALS["excp"]->rkid->setQueryStringValue($parm);
					$this->rkid->setQueryStringValue($GLOBALS["excp"]->rkid->QueryStringValue);
					$this->rkid->setSessionValue($this->rkid->QueryStringValue);
					if (!is_numeric($GLOBALS["excp"]->rkid->QueryStringValue))
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
			if ($masterTblVar == "excp") {
				$validMaster = TRUE;
				if (($parm = Post("fk_rkid", Post("rkid"))) !== NULL) {
					$GLOBALS["excp"]->rkid->setFormValue($parm);
					$this->rkid->setFormValue($GLOBALS["excp"]->rkid->FormValue);
					$this->rkid->setSessionValue($this->rkid->FormValue);
					if (!is_numeric($GLOBALS["excp"]->rkid->FormValue))
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
			if ($masterTblVar != "excp") {
				if ($this->rkid->CurrentValue == "")
					$this->rkid->setSessionValue("");
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
				case "x_namap":
					break;
				case "x_kategori_produk":
					break;
				case "x_kategori_produk2":
					break;
				case "x_kategori_produk3":
					break;
				case "x_jml_pegawai":
					break;
				case "x_legalitas":
					break;
				case "x_sertifikat":
					break;
				case "x_alat_promosi":
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
						case "x_namap":
							break;
						case "x_kategori_produk":
							break;
						case "x_kategori_produk2":
							break;
						case "x_kategori_produk3":
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
		$cek_data = ExecuteScalar("SELECT COUNT(1) FROM `t_pcp` WHERE `tahun_ecp` IS NULL OR `wilayah_ecp` IS NULL");
		$cek_data2 = ExecuteScalar("SELECT COUNT(1) FROM `t_ecp` WHERE `Tahun_ECP` IS NULL OR `Wilayah_ECP` IS NULL");
		if($cek_data > 0){
			$updatedata = Execute("UPDATE `t_pcp` t1 INNER JOIN `t_rkcoaching` t2 ON t1.rkid = t2.rkid INNER JOIN `t_area` t3 ON t2.`area` = t3.`areaid` SET t1.`tahun_ecp` = t2.`tahun_keg`, t1.`wilayah_ecp` = t3.`area` WHERE t1.`tahun_ecp` IS NULL OR t1.`wilayah_ecp` IS NULL");
		}
		if($cek_data2 > 0){
			$updatedata2 = Execute("UPDATE `t_ecp` t1 INNER JOIN `t_pcp` t2 ON t1.`Peserta_ID` = t2.`id` SET t1.Nama = t2.nama_peserta, t1.Perusahaan = t2.namap, t1.`Tahun_ECP` = t2.`tahun_ecp`, t1.`Wilayah_ECP` = t2.`wilayah_ecp` WHERE (t1.`Tahun_ECP` IS NULL OR t1.`Wilayah_ECP` IS NULL) OR (t1.`Tahun_ECP` = '' OR t1.`Wilayah_ECP` = 0)");
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

		$this->nama_peserta->Visible = TRUE;
		$this->namap->Visible = TRUE;  
		$this->produk->Visible = TRUE;  
		$this->legalitas->Visible = TRUE;
		$this->id->Visible = FALSE;  
		$this->rkid->Visible = FALSE;  
		$this->tahun_ecp->Visible = FALSE;  
		$this->tahun_berdiri->Visible = FALSE;  
		$this->alamat_prod->Visible = FALSE;  
		$this->merek_dagang->Visible = FALSE;  
		$this->fb->Visible = FALSE;  
		$this->ig->Visible = FALSE;  
		$this->sosmed_lain->Visible = FALSE;  
		$this->jml_pegawai->Visible = FALSE;  

		//$this->jml_pegawai2->Visible = FALSE;
		$this->jml_pegawai_tidaktetap->Visible = FALSE;  
		$this->f_npwp->Visible = FALSE;  
		$this->f_nib->Visible = FALSE;  
		$this->f_siup->Visible = FALSE;  
		$this->f_tdp->Visible = FALSE;  
		$this->f_lain->Visible = FALSE;  
		$this->sertifikat->Visible = FALSE;  
		$this->f_sertifikat->Visible = FALSE; 
		$this->alat_promosi->Visible = FALSE;  
		$this->f_kartunama->Visible = FALSE;  
		$this->f_brosur->Visible = FALSE;  
		$this->f_katalog->Visible = FALSE;  
		$this->f_profile->Visible = FALSE;  
		$this->alamat->Visible = FALSE;  
		$this->kapasitas_produksi->Visible = FALSE;  
		$this->omset->Visible = FALSE;
		$this->email_add->Visible = FALSE;  
		$this->wilayah_ecp->Visible = FALSE;  
		$this->handphone->Visible = FALSE;  
		$this->website->Visible = FALSE;
		$this->kategori_produk->Visible = FALSE;  
		$this->kategori_produk2->Visible = FALSE;  
		$this->kategori_produk3->Visible = FALSE;  
		$this->jenis_perusahaan->Visible = FALSE;  
		$this->legalitas_lain->Visible = FALSE;  
		$this->sertifikat_lain->Visible = FALSE;  
		$this->promosi_lain->Visible = FALSE;
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
		//$this->ListOptions["new"]->Body = "xxx"; $GLOBALS["excp"]->rkid->CurrentValue

		$this->ListOptions->Items["edit"]->Body = '<a class="ew-row-link ew-edit dropdown-item" data-caption="Ubah" href="t_pcpedit.php?showdetail=t_ecp&id='.$this->id->CurrentValue.'&showmaster=excp&fk_rkid='.Page("excp")->rkid->CurrentValue.'" data-original-title="" title=""><i data-phrase="MasterDetailEditLink" class="icon-md-edit ew-icon mr-2" data-caption="Master/Detail Ubah"></i>Ubah</a>';

		//if ($this->t_ecp_Count == 0) {
			$this->ListOptions->Items["detail_t_ecp"]->Clear();

		//}
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