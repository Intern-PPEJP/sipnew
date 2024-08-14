<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class evaluasi_view extends evaluasi
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 'evaluasi';

	// Page object name
	public $PageObjName = "evaluasi_view";

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
		$keyUrl = "";
		if (Get("idpelat") !== NULL) {
			$this->RecKey["idpelat"] = Get("idpelat");
			$keyUrl .= "&amp;idpelat=" . urlencode($this->RecKey["idpelat"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "evaluasiview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canView()) {
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
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("evaluasilist.php"));
				else
					$this->terminate(GetUrl("login.php"));
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
		if (Get("idpelat") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("idpelat");
		}

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

		// Setup export options
		$this->setupExportOptions();
		$this->th->setVisibility();
		$this->idpelat->setVisibility();
		$this->kdpelat->setVisibility();
		$this->kdjudul->setVisibility();
		$this->tawal->setVisibility();
		$this->takhir->setVisibility();
		$this->ketua->setVisibility();
		$this->sekretaris->setVisibility();
		$this->bendahara->setVisibility();
		$this->anggota2->setVisibility();
		$this->widyaiswara->setVisibility();
		$this->tglpel->setVisibility();
		$this->panitia->setVisibility();
		$this->jenisevaluasi->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->th);
		$this->setupLookupOptions($this->idpelat);
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->ketua);
		$this->setupLookupOptions($this->sekretaris);
		$this->setupLookupOptions($this->bendahara);
		$this->setupLookupOptions($this->anggota2);
		$this->setupLookupOptions($this->widyaiswara);

		// Check permission
		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("evaluasilist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("idpelat") !== NULL) {
				$this->idpelat->setQueryStringValue(Get("idpelat"));
				$this->RecKey["idpelat"] = $this->idpelat->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->idpelat->setQueryStringValue(Key(0));
				$this->RecKey["idpelat"] = $this->idpelat->QueryStringValue;
			} elseif (Post("idpelat") !== NULL) {
				$this->idpelat->setFormValue(Post("idpelat"));
				$this->RecKey["idpelat"] = $this->idpelat->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->idpelat->setFormValue(Route(2));
				$this->RecKey["idpelat"] = $this->idpelat->FormValue;
			} else {
				$returnUrl = "evaluasilist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display

					// Load record based on key
					if (IsApi()) {
						$filter = $this->getRecordFilter();
						$this->CurrentFilter = $filter;
						$sql = $this->getCurrentSql();
						$conn = $this->getConnection();
						$this->Recordset = LoadRecordset($sql, $conn);
						$res = $this->Recordset && !$this->Recordset->EOF;
					} else {
						$res = $this->loadRow();
					}
					if (!$res) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "evaluasilist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "evaluasilist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

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

			// ketua
			$this->ketua->LinkCustomAttributes = "";
			$this->ketua->HrefValue = "";
			$this->ketua->TooltipValue = "";

			// sekretaris
			$this->sekretaris->LinkCustomAttributes = "";
			$this->sekretaris->HrefValue = "";
			$this->sekretaris->TooltipValue = "";

			// bendahara
			$this->bendahara->LinkCustomAttributes = "";
			$this->bendahara->HrefValue = "";
			$this->bendahara->TooltipValue = "";

			// anggota2
			$this->anggota2->LinkCustomAttributes = "";
			$this->anggota2->HrefValue = "";
			$this->anggota2->TooltipValue = "";

			// widyaiswara
			$this->widyaiswara->LinkCustomAttributes = "";
			$this->widyaiswara->HrefValue = "";
			$this->widyaiswara->TooltipValue = "";

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fevaluasiview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fevaluasiview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fevaluasiview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_evaluasi" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_evaluasi\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fevaluasiview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
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
		$selectLimit = FALSE;

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
		$this->setupStartRecord(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecords <= 0) {
			$this->StopRecord = $this->TotalRecords;
		} else {
			$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
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
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("evaluasilist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
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
		if(Get("p") == "t_evafas"){
			$tb = "EV_FASILITATOR_".Get("idpelat");
		} else if(Get("p") == "t_evakhir"){
			$tb = "EV_AKHIR_".Get("idpelat");
		} else if(Get("p") == "t_evakunjlap"){
			$tb = "EV_KUNJLAP_".Get("idpelat");
		} 
		$GLOBALS["ExportFileName"] = "FORMAT_".$tb;

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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {
		if(@$_GET["p"] == "t_evafas"){ // EVALUASI FASILITATOR
			$this->ExportDoc->Text = "<table border='1'><tr><th>Pelatihan</th><th>Fasilitator</th><th>Materi</th><th>Kriteria Penilaian</th><th>Nilai</th><th>Saran</th></tr>";
		} else if(@$_GET["p"] == "t_evakhir"){ // EVALUASI AKHIR
			$this->ExportDoc->Text = "<table border='1'><tr><th>Pelatihan</th><th>Pertanyaan</th><th>Jml. A</th><th>Jml. B</th><th>Jml. C</th><th>Jml. D</th><th>Jml. E</th><th>Jml. F</th><th>Materi tidak sesuai</th><th>Alasan tidak sesuai</th><th>Ditambah</th><th>Dikurang</th><th>Lain-lain</th><th>Saran & Komentar</th><th>Urutan</th></tr>";
		} else if(@$_GET["p"] == "t_evakunjlap"){ // EVALUASI KUNJUNGAN LAPANGAN
			$this->ExportDoc->Text = "<table border='1'><th>Pelatihan</th><th>Pertanyaan</th><th>Jml. A</th><th>Jml. B</th><th>Jml. C</th><th>Jml. D</th><th>Jml. E</th></tr>";
		} else if(@$_GET["p"] == "t_evapant"){ // EVALUASI PANITIA
			$this->ExportDoc->Text = "<table border='1'><tr><th>Pelatihan</th><th>Fasilitator</th><th>Kriteria Penilaian</th><th>Nilai</th><th>Saran Kpd. Panitia</th></tr>";
		} else if(@$_GET["p"] == "t_evasis"){ // EVALUASI FASILITATOR
			$this->ExportDoc->Text = "<table border='1'><tr><th>Pelatihan</th><th>Pembimbing Simulasi</th><th>Materi Simulasi</th><th>Kriteria Penilaian</th><th>Nilai</th><th>Saran</th></tr>";
		}

		//return FALSE; // Return FALSE to skip default export and use Row_Export event
		return FALSE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
		if(@$_GET["p"] == "t_evafas"){ // EVALUASI FASILITATOR
			$this->ExportDoc->Text .= "";
			$qsql = Execute("SELECT idpelat, instruktur, kurikulumid FROM `t_jadwalpel` WHERE idpelat = ".$rs["idpelat"]." AND kurikulumid > 0 AND instruktur > 0 GROUP BY kurikulumid");
			if ($qsql->RecordCount() > 0) {
				$qsql->MoveFirst();
				$sData = "";
				while ($qsql && !$qsql->EOF) {

				//$field_one = $qsql->fields[0]; // get the value of fiqsqlt field
				$sData .= "";
				$kriteria_penilaian = array("0", "Materi yang diberikan mencapai sasaran", "Sistematika Penyajian", "Metode Penyajian", "Gaya dan sikap Fasilitator", "Kemampuan memotivasi peserta", "Penggunaan bahasa", "Manajemen Waktu");
				for ($x=1;$x<=7;$x++){ // jumlah kriteria
					$pelatihan = ExecuteScalar("SELECT judul FROM `vt_pelatihan` WHERE idpelat = ".$qsql->fields[0]);
					$fasilitator = ExecuteScalar("SELECT nama FROM `t_biointruktur` WHERE bioid = ".$qsql->fields[1]);
					$materi = ExecuteScalar("SELECT kurikulum FROM `t_kurikulum` WHERE kurikulumid = ".$qsql->fields[2]);
					$sData .= "<tr><td>".$pelatihan." <font color='white'>##".$qsql->fields[0]."</font></td><td>".$fasilitator." <font color='white'>##".$qsql->fields[1]."</font></td><td>".$materi." <font color='white'>##".$qsql->fields[2]."</font></td><td>".$x.". ".$kriteria_penilaian[$x]."</td><td></td><td></td></tr>";
				}
				$sData .= "";
				$qsql->MoveNext();
				}
				$this->ExportDoc->Text .=  $sData;
				$qsql->Close();
			} else {
				$this->ExportDoc->Text .=  "<tr><td colspan='6'>Maaf format belum tersedia. Pelatihan belum terlaksana.</td></tr>";
			}
			$this->ExportDoc->Text .= "";
		} else if(@$_GET["p"] == "t_evakhir"){ // EVALUASI AKHIR
			$kriteria_penilaian = array("0", "Pelatihan ini secara keseluruhan ?", "Kesesuaian materi yang disajikan dengan kebutuhan ?", "Porsi waktu tiap-tiap materi pelatihan secara umum ?","Cara penyampaian materi oleh para fasilitator ?","Lamanya Pelatihan ?","Menurut anda topik apa yang sebaiknya ditambah atau dikurangi ?","Sarana Pendukung : a. Kondisi ruang belajar (dari segi kenyamanan dan kebersihan)","Sarana Pendukung : b. Pengaturan Kursi","Sarana Pendukung : c. Kualitas penggandaan makalah","Sarana Pendukung : d. Perlengkapan Pelatihan","Sarana Pendukung : e. Konsumsi (Snack)","Pelayanan Panitia Penyelenggara","Dari mana Anda mendapatkan informasi mengenai pelatihan ini","Bagaimana pendapat Anda tentang pelayanan pada saat Anda mendaftar menjadi peserta ?","Bagaimana pendapat Anda mengenai tarif pelatihan ini ?","Pelatihan yang ingin diikuti","Komentar dan saran-saran");
			$n=0;
			$kriteria=1;
			$pelatihan = ExecuteScalar("SELECT judul FROM `vt_pelatihan` WHERE idpelat = ".$rs["idpelat"]);
			$warna = " bgcolor='lime'";
			for ($x=1;$x<=17;$x++){ // jumlah pertanyaan
				if($x >= 7 && $x <= 11){ // jumlah Sarana Pendukung
					$n = $n+1;
					$kriteria = 70 + $n;
				} else if ($x == 12){
					$kriteria = 8;
				}
				$warna_idpelat = "";$warna_tanya = "";$warna_a = "";$warna_b = "";$warna_c = "";$warna_d = "";$warna_e = "";$warna_f = "";$warna_tanya_materi = "";$warna_tanya_alasan = "";$warna_tanya_tambahi = "";$warna_tanya_kurangi = "";$warna_lain = "";$warna_saran = "";
				if($x<=4 || ($x>=7 && $x<=12) || ($x>=14 && $x<=16)){
					$warna_a = $warna;
					$warna_b = $warna;
					$warna_c = $warna;
					$warna_d = $warna;
					$warna_e = $warna;
					if($x<>1 && $x<=4){
						$warna_tanya_materi = $warna;
						$warna_tanya_alasan = $warna;
					}
					if($x==16)
						$warna_f = $warna;
				}
				if($x==5 || ($x>=13 && $x<=16) ){
					$warna_a = $warna;
					$warna_b = $warna;
					$warna_c = $warna;
					if($x==13 || $x==14 || $x==16 )
						$warna_lain = $warna;
				}
				if($x==6){
					$warna_tanya_tambahi = $warna;
					$warna_tanya_kurangi = $warna;
				}
				if($x==17){
					$warna_saran = $warna;
				}
				$this->ExportDoc->Text .= "<tr><td>".$pelatihan." <font color='white'>##".$rs["idpelat"]."</font></td><td>".$kriteria_penilaian[$x]." <font color='white'>##".$kriteria++."</font></td><td".$warna_a.">0</td><td".$warna_b.">0</td><td".$warna_c.">0</td><td".$warna_d.">0</td><td".$warna_e.">0</td><td".$warna_f.">0</td><td".$warna_tanya_materi.">-</td><td".$warna_tanya_alasan.">-</td><td".$warna_tanya_tambahi.">-</td><td".$warna_tanya_kurangi.">-</td><td".$warna_lain.">-</td><td".$warna_saran.">-</td><td>".$x."</td></tr>";
			}
		} else if(@$_GET["p"] == "t_evakunjlap"){ // EVALUASI KUNJUNGAN LAPANGAN
			$kriteria_penilaian = array("0", "Bagaimana pendapat Anda mengenai Transportasi kunjungan lapangan ini ?", "Bagaimana pendapat Anda mengenai pemberian informasi kepabeanan di Bea dan Cukai ?", "Bagaimana pendapat Anda mengenai pemberian informasi pelayanan di Terminal Peti Kemas ?","Bagaimana penilaian Anda mengenai pelayanan Penanggung Jawab kunjungan lapangan ini ?");
			$pelatihan = ExecuteScalar("SELECT judul FROM `vt_pelatihan` WHERE idpelat = ".$rs["idpelat"]);
			$kriteria=1;
			for ($x=1;$x<=4;$x++){ // jumlah pertanyaan
				$this->ExportDoc->Text .= "<tr><td>".$pelatihan." <font color='white'>##".$rs["idpelat"]."</font></td><td>".$kriteria_penilaian[$x]." <font color='white'>##".$kriteria++."</font></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
			}
		} else if(@$_GET["p"] == "t_evapant"){ // EVALUASI PANITIA
			$this->ExportDoc->Text .= "";
			$qsql = Execute("SELECT idpelat, instruktur FROM `t_jadwalpel` WHERE idpelat = ".$rs["idpelat"]." AND kurikulumid > 0 AND instruktur > 0 GROUP BY instruktur");
			if ($qsql->RecordCount() > 0) {
				$qsql->MoveFirst();
				$sData = "";
				while ($qsql && !$qsql->EOF) {

				//$field_one = $qsql->fields[0]; // get the value of fiqsqlt field
				$sData .= "";
				$kriteria_penilaian = array("0", "Panitia bekerja sesuai tugasnya", "Komunikasi panitia dengan fasilitator", "Fasilitas yang disediakan untuk fasilitator (akomodasi + konsumsi)", "Pelaksanaan pelatihan  (tempat/venue dan waktu)", "Manajemen Waktu");
				for ($x=1;$x<=5;$x++){ // jumlah kriteria
					$pelatihan = ExecuteScalar("SELECT judul FROM `vt_pelatihan` WHERE idpelat = ".$qsql->fields[0]);
					$fasilitator = ExecuteScalar("SELECT nama FROM `t_biointruktur` WHERE bioid = ".$qsql->fields[1]);
					$sData .= "<tr><td>".$pelatihan." <font color='white'>##".$qsql->fields[0]."</font></td><td>".$fasilitator." <font color='white'>##".$qsql->fields[1]."</font></td><td>".$x.". ".$kriteria_penilaian[$x]."</td><td></td><td></td></tr>";
				}
				$sData .= "";
				$qsql->MoveNext();
				}
				$this->ExportDoc->Text .=  $sData;
				$qsql->Close();
			} else {
				$this->ExportDoc->Text .=  "<tr><td colspan='6'>Maaf format belum tersedia. Pelatihan belum terlaksana.</td></tr>";
			}
			$this->ExportDoc->Text .= "";
		} else if(@$_GET["p"] == "t_evasis"){ // EVALUASI SIMULASI
			$this->ExportDoc->Text .= "";
			$qsql = Execute("SELECT idpelat, instruktur, kurikulumid FROM `t_jadwalpel` WHERE idpelat = ".$rs["idpelat"]." AND kurikulumid > 0 AND instruktur > 0 GROUP BY kurikulumid");
			if ($qsql->RecordCount() > 0) {
				$qsql->MoveFirst();
				$sData = "";
				while ($qsql && !$qsql->EOF) {

				//$field_one = $qsql->fields[0]; // get the value of fiqsqlt field
				$sData .= "";
				$kriteria_penilaian = array("0", "Panduan dari pembimbing mencapai sasaran", "Ketepatan waktu pembimbing", "Kemampuan memotivasi peserta");
				for ($x=1;$x<=3;$x++){ // jumlah kriteria
					$pelatihan = ExecuteScalar("SELECT judul FROM `vt_pelatihan` WHERE idpelat = ".$qsql->fields[0]);
					$fasilitator = ExecuteScalar("SELECT nama FROM `t_biointruktur` WHERE bioid = ".$qsql->fields[1]);
					$materi = ExecuteScalar("SELECT kurikulum FROM `t_kurikulum` WHERE kurikulumid = ".$qsql->fields[2]);
					$sData .= "<tr><td>".$pelatihan." <font color='white'>##".$qsql->fields[0]."</font></td><td>".$fasilitator." <font color='white'>##".$qsql->fields[1]."</font></td><td>".$materi." <font color='white'>##".$qsql->fields[2]."</font></td><td>".$x.". ".$kriteria_penilaian[$x]."</td><td></td><td></td></tr>";
				}
				$sData .= "";
				$qsql->MoveNext();
				}
				$this->ExportDoc->Text .=  $sData;
				$qsql->Close();
			} else {
				$this->ExportDoc->Text .=  "<tr><td colspan='6'>Maaf format belum tersedia. Pelatihan belum terlaksana.</td></tr>";
			}
			$this->ExportDoc->Text .= "";
		}  
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {
		if(@$_GET["p"] == "t_evafas" || @$_GET["p"] == "t_evasis"){ // EVALUASI FASILITATOR
			$jml = ExecuteScalar("SELECT COUNT(1) FROM `t_jadwalpel` WHERE idpelat = ".$this->idpelat->CurrentValue." AND kurikulumid > 0 AND instruktur > 0 ");
			$jmlrecord = ($jml * 7)+1; // dikali kriteria nilai + 1 header
			$this->ExportDoc->Text .= "</table><p></p>";
			$this->ExportDoc->Text .= "<table bgcolor='yellow'><tr><td colspan='10'><b>Cara mengisi data dari excel:</b><br>1. Tidak boleh merubah format tabel diatas<br>2. Kolom yang BOLEH DIUBAH hanya kolom <b>Nilai</b> dan <b>Saran</b><br>3. Untuk mengisi kolom <b>Nilai</b> gunakan <b>koma</b> (,) untuk memisahkan nilai yang diberikan masing-masing peserta<br>4. Untuk mengisi kolom <b>Saran</b> gunakan <b>titik koma</b> (;) untuk memisahkan saran yang diberikan masing-masing peserta<br>5. Copy tabel (HANYA TABEL) yang sudah diisi diatas, mulai kolom <b>A1</b> hingga akhir (<b>F".$jmlrecord."</b>)<br>6. Buat file excel baru kemudian klik kanan pada kolom <b>A1</b>, pilih <b>Paste Special...</b>, kemudian pilih <b>Values</b><br>7. Simpan dan import di aplikasi</td></tr></table>"; 
		} else if(@$_GET["p"] == "t_evakhir"){ // EVALUASI AKHIR
			$jmlrecord = 18;
			$this->ExportDoc->Text .= "</table><p></p><table bgcolor='yellow'><tr><td colspan='10'><b>Cara mengisi data dari excel:</b><br>1. Tidak boleh merubah format tabel diatas<br>2. Kolom yang BOLEH DIUBAH hanya kolom warna hijau<br>3. Untuk memisahkan isian gunakan <b>2 kali titik koma</b> (;;)<br>4. Copy tabel (HANYA TABEL) yang sudah diisi diatas, mulai kolom <b>A1</b> hingga akhir (<b>O".$jmlrecord."</b>)<br>5. Buat file excel baru kemudian klik kanan pada kolom <b>A1</b>, pilih <b>Paste Special...</b>, kemudian pilih <b>Values</b><br>6. Simpan dan import di aplikasi</td></tr></table>";
		} else if(@$_GET["p"] == "t_evakunjlap"){ 
			$jmlrecord = 5;	
			$this->ExportDoc->Text .= "</table><p></p><table bgcolor='yellow'><tr><td colspan='7'><b>Cara mengisi data dari excel:</b><br>1. Tidak boleh merubah format tabel diatas<br>2. Kolom yang BOLEH DIUBAH hanya kolom Jml. A sampai Jml. E (berisi bilangan bulan)<br>3. Copy tabel (HANYA TABEL) yang sudah diisi diatas, mulai kolom <b>A1</b> hingga akhir (<b>G".$jmlrecord."</b>)<br>4. Buat file excel baru kemudian klik kanan pada kolom <b>A1</b>, pilih <b>Paste Special...</b>, kemudian pilih <b>Values</b><br>5. Simpan dan import di aplikasi</td></tr></table>";
		} else if(@$_GET["p"] == "t_evapant"){ // EVALUASI PANITIA
			$jml = Execute("SELECT idpelat, instruktur FROM `t_jadwalpel` WHERE idpelat = ".$this->idpelat->CurrentValue." AND kurikulumid > 0 AND instruktur > 0 GROUP BY instruktur");
			$jmlrecord = ($jml->RecordCount() * 5)+1; // dikali kriteria nilai + 1 header
			$this->ExportDoc->Text .= "</table><p></p>";
			$this->ExportDoc->Text .= "<table bgcolor='yellow'><tr><td colspan='10'><b>Cara mengisi data dari excel:</b><br>1. Tidak boleh merubah format tabel diatas<br>2. Kolom yang BOLEH DIUBAH hanya kolom <b>Nilai</b> (<i>berisi bilangan bulat</i>) dan <b>Saran Kpd. Panitia</b><br>3. Copy tabel (HANYA TABEL) yang sudah diisi diatas, mulai kolom <b>A1</b> hingga akhir (<b>E".$jmlrecord."</b>)<br>4. Buat file excel baru kemudian <b>klik kanan</b> mouse pada kolom <b>A1</b>, pilih <b>Paste Special...</b>, kemudian pilih <b>Values</b><br>5. Simpan dan import di aplikasi</td></tr></table>"; 
		} 

		//echo $this->ExportDoc->Text; exit();
	}
} // End class
?>