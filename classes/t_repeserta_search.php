<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_repeserta_search extends t_repeserta
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_repeserta';

	// Page object name
	public $PageObjName = "t_repeserta_search";

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

		// Table object (t_repeserta)
		if (!isset($GLOBALS["t_repeserta"]) || get_class($GLOBALS["t_repeserta"]) == PROJECT_NAMESPACE . "t_repeserta") {
			$GLOBALS["t_repeserta"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_repeserta"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (cv_pelrepes)
		if (!isset($GLOBALS['cv_pelrepes']))
			$GLOBALS['cv_pelrepes'] = new cv_pelrepes();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_repeserta');

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
		global $t_repeserta;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_repeserta);
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
					if ($pageName == "t_repesertaview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_repesertalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->idpelat->Visible = FALSE;
		$this->kdjudul->Visible = FALSE;
		$this->tgl_pel->Visible = FALSE;
		$this->nama->setVisibility();
		$this->perusahaan->setVisibility();
		$this->jabatan->setVisibility();
		$this->tgl_daftar->setVisibility();
		$this->telp->setVisibility();
		$this->fax->setVisibility();
		$this->hp->setVisibility();
		$this->produk->setVisibility();
		$this->cara_bayar->setVisibility();
		$this->ket_bayar->setVisibility();
		$this->tgl_bayar->setVisibility();
		$this->kdinformasi->setVisibility();
		$this->konfirmasi->setVisibility();
		$this->ket->setVisibility();
		$this->updated_at->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->ket_lainnya->setVisibility();
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
		$this->setupLookupOptions($this->id);
		$this->setupLookupOptions($this->idpelat);
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->jabatan);
		$this->setupLookupOptions($this->kdinformasi);

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "t_repesertalist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->nama); // nama
		$this->buildSearchUrl($srchUrl, $this->perusahaan); // perusahaan
		$this->buildSearchUrl($srchUrl, $this->jabatan); // jabatan
		$this->buildSearchUrl($srchUrl, $this->tgl_daftar); // tgl_daftar
		$this->buildSearchUrl($srchUrl, $this->telp); // telp
		$this->buildSearchUrl($srchUrl, $this->fax); // fax
		$this->buildSearchUrl($srchUrl, $this->hp); // hp
		$this->buildSearchUrl($srchUrl, $this->produk); // produk
		$this->buildSearchUrl($srchUrl, $this->cara_bayar); // cara_bayar
		$this->buildSearchUrl($srchUrl, $this->ket_bayar); // ket_bayar
		$this->buildSearchUrl($srchUrl, $this->tgl_bayar); // tgl_bayar
		$this->buildSearchUrl($srchUrl, $this->kdinformasi); // kdinformasi
		$this->buildSearchUrl($srchUrl, $this->konfirmasi); // konfirmasi
		$this->buildSearchUrl($srchUrl, $this->ket); // ket
		$this->buildSearchUrl($srchUrl, $this->ket_lainnya); // ket_lainnya
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->nama->AdvancedSearch->post())
			$got = TRUE;
		if ($this->perusahaan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jabatan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tgl_daftar->AdvancedSearch->post())
			$got = TRUE;
		if ($this->telp->AdvancedSearch->post())
			$got = TRUE;
		if ($this->fax->AdvancedSearch->post())
			$got = TRUE;
		if ($this->hp->AdvancedSearch->post())
			$got = TRUE;
		if ($this->produk->AdvancedSearch->post())
			$got = TRUE;
		if ($this->cara_bayar->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ket_bayar->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tgl_bayar->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdinformasi->AdvancedSearch->post())
			$got = TRUE;
		if ($this->konfirmasi->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ket->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ket_lainnya->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// idpelat
		// kdjudul
		// tgl_pel
		// nama
		// perusahaan
		// jabatan
		// tgl_daftar
		// telp
		// fax
		// hp
		// produk
		// cara_bayar
		// ket_bayar
		// tgl_bayar
		// kdinformasi
		// konfirmasi
		// ket
		// updated_at
		// created_at
		// ket_lainnya

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// perusahaan
			$this->perusahaan->ViewValue = $this->perusahaan->CurrentValue;
			$this->perusahaan->ViewCustomAttributes = "";

			// jabatan
			$this->jabatan->ViewValue = $this->jabatan->CurrentValue;
			$curVal = strval($this->jabatan->CurrentValue);
			if ($curVal != "") {
				$this->jabatan->ViewValue = $this->jabatan->lookupCacheOption($curVal);
				if ($this->jabatan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jabatan->ViewValue = $this->jabatan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan->ViewValue = $this->jabatan->CurrentValue;
					}
				}
			} else {
				$this->jabatan->ViewValue = NULL;
			}
			$this->jabatan->ViewCustomAttributes = "";

			// tgl_daftar
			$this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
			$this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
			$this->tgl_daftar->ViewCustomAttributes = "";

			// telp
			$this->telp->ViewValue = $this->telp->CurrentValue;
			$this->telp->ViewCustomAttributes = "";

			// fax
			$this->fax->ViewValue = $this->fax->CurrentValue;
			$this->fax->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// produk
			$this->produk->ViewValue = $this->produk->CurrentValue;
			$this->produk->ViewCustomAttributes = "";

			// cara_bayar
			if (strval($this->cara_bayar->CurrentValue) != "") {
				$this->cara_bayar->ViewValue = $this->cara_bayar->optionCaption($this->cara_bayar->CurrentValue);
			} else {
				$this->cara_bayar->ViewValue = NULL;
			}
			$this->cara_bayar->ViewCustomAttributes = "";

			// ket_bayar
			$this->ket_bayar->ViewValue = $this->ket_bayar->CurrentValue;
			$this->ket_bayar->ViewCustomAttributes = "";

			// tgl_bayar
			$this->tgl_bayar->ViewValue = $this->tgl_bayar->CurrentValue;
			$this->tgl_bayar->ViewValue = FormatDateTime($this->tgl_bayar->ViewValue, 0);
			$this->tgl_bayar->ViewCustomAttributes = "";

			// kdinformasi
			$curVal = strval($this->kdinformasi->CurrentValue);
			if ($curVal != "") {
				$this->kdinformasi->ViewValue = $this->kdinformasi->lookupCacheOption($curVal);
				if ($this->kdinformasi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdinformasi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdinformasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdinformasi->ViewValue = $this->kdinformasi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdinformasi->ViewValue = $this->kdinformasi->CurrentValue;
					}
				}
			} else {
				$this->kdinformasi->ViewValue = NULL;
			}
			$this->kdinformasi->ViewCustomAttributes = "";

			// konfirmasi
			if (strval($this->konfirmasi->CurrentValue) != "") {
				$this->konfirmasi->ViewValue = $this->konfirmasi->optionCaption($this->konfirmasi->CurrentValue);
			} else {
				$this->konfirmasi->ViewValue = NULL;
			}
			$this->konfirmasi->ViewCustomAttributes = "";

			// ket
			if (strval($this->ket->CurrentValue) != "") {
				$this->ket->ViewValue = $this->ket->optionCaption($this->ket->CurrentValue);
			} else {
				$this->ket->ViewValue = NULL;
			}
			$this->ket->ViewCustomAttributes = "";

			// ket_lainnya
			$this->ket_lainnya->ViewValue = $this->ket_lainnya->CurrentValue;
			$this->ket_lainnya->ViewCustomAttributes = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

			// perusahaan
			$this->perusahaan->LinkCustomAttributes = "";
			$this->perusahaan->HrefValue = "";
			$this->perusahaan->TooltipValue = "";

			// jabatan
			$this->jabatan->LinkCustomAttributes = "";
			$this->jabatan->HrefValue = "";
			$this->jabatan->TooltipValue = "";

			// tgl_daftar
			$this->tgl_daftar->LinkCustomAttributes = "";
			$this->tgl_daftar->HrefValue = "";
			$this->tgl_daftar->TooltipValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";
			$this->telp->TooltipValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";
			$this->fax->TooltipValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";
			$this->hp->TooltipValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";
			$this->produk->TooltipValue = "";

			// cara_bayar
			$this->cara_bayar->LinkCustomAttributes = "";
			$this->cara_bayar->HrefValue = "";
			$this->cara_bayar->TooltipValue = "";

			// ket_bayar
			$this->ket_bayar->LinkCustomAttributes = "";
			$this->ket_bayar->HrefValue = "";
			$this->ket_bayar->TooltipValue = "";

			// tgl_bayar
			$this->tgl_bayar->LinkCustomAttributes = "";
			$this->tgl_bayar->HrefValue = "";
			$this->tgl_bayar->TooltipValue = "";

			// kdinformasi
			$this->kdinformasi->LinkCustomAttributes = "";
			$this->kdinformasi->HrefValue = "";
			$this->kdinformasi->TooltipValue = "";

			// konfirmasi
			$this->konfirmasi->LinkCustomAttributes = "";
			$this->konfirmasi->HrefValue = "";
			$this->konfirmasi->TooltipValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";
			$this->ket->TooltipValue = "";

			// ket_lainnya
			$this->ket_lainnya->LinkCustomAttributes = "";
			$this->ket_lainnya->HrefValue = "";
			$this->ket_lainnya->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->AdvancedSearch->SearchValue = HtmlDecode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->EditValue = HtmlEncode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// perusahaan
			$this->perusahaan->EditAttrs["class"] = "form-control";
			$this->perusahaan->EditCustomAttributes = "";
			if (!$this->perusahaan->Raw)
				$this->perusahaan->AdvancedSearch->SearchValue = HtmlDecode($this->perusahaan->AdvancedSearch->SearchValue);
			$this->perusahaan->EditValue = HtmlEncode($this->perusahaan->AdvancedSearch->SearchValue);
			$this->perusahaan->PlaceHolder = RemoveHtml($this->perusahaan->caption());

			// jabatan
			$this->jabatan->EditAttrs["class"] = "form-control";
			$this->jabatan->EditCustomAttributes = "";
			if (!$this->jabatan->Raw)
				$this->jabatan->AdvancedSearch->SearchValue = HtmlDecode($this->jabatan->AdvancedSearch->SearchValue);
			$this->jabatan->EditValue = HtmlEncode($this->jabatan->AdvancedSearch->SearchValue);
			$curVal = strval($this->jabatan->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->jabatan->EditValue = $this->jabatan->lookupCacheOption($curVal);
				if ($this->jabatan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->jabatan->EditValue = $this->jabatan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan->EditValue = HtmlEncode($this->jabatan->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->jabatan->EditValue = NULL;
			}
			$this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());

			// tgl_daftar
			$this->tgl_daftar->EditAttrs["class"] = "form-control";
			$this->tgl_daftar->EditCustomAttributes = "";
			$this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_daftar->AdvancedSearch->SearchValue, 0), 8));
			$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			if (!$this->telp->Raw)
				$this->telp->AdvancedSearch->SearchValue = HtmlDecode($this->telp->AdvancedSearch->SearchValue);
			$this->telp->EditValue = HtmlEncode($this->telp->AdvancedSearch->SearchValue);
			$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			if (!$this->fax->Raw)
				$this->fax->AdvancedSearch->SearchValue = HtmlDecode($this->fax->AdvancedSearch->SearchValue);
			$this->fax->EditValue = HtmlEncode($this->fax->AdvancedSearch->SearchValue);
			$this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->AdvancedSearch->SearchValue = HtmlDecode($this->hp->AdvancedSearch->SearchValue);
			$this->hp->EditValue = HtmlEncode($this->hp->AdvancedSearch->SearchValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "";
			if (!$this->produk->Raw)
				$this->produk->AdvancedSearch->SearchValue = HtmlDecode($this->produk->AdvancedSearch->SearchValue);
			$this->produk->EditValue = HtmlEncode($this->produk->AdvancedSearch->SearchValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// cara_bayar
			$this->cara_bayar->EditCustomAttributes = "";
			$this->cara_bayar->EditValue = $this->cara_bayar->options(FALSE);

			// ket_bayar
			$this->ket_bayar->EditAttrs["class"] = "form-control";
			$this->ket_bayar->EditCustomAttributes = "";
			$this->ket_bayar->EditValue = HtmlEncode($this->ket_bayar->AdvancedSearch->SearchValue);
			$this->ket_bayar->PlaceHolder = RemoveHtml($this->ket_bayar->caption());

			// tgl_bayar
			$this->tgl_bayar->EditAttrs["class"] = "form-control";
			$this->tgl_bayar->EditCustomAttributes = "";
			$this->tgl_bayar->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_bayar->AdvancedSearch->SearchValue, 0), 8));
			$this->tgl_bayar->PlaceHolder = RemoveHtml($this->tgl_bayar->caption());

			// kdinformasi
			$this->kdinformasi->EditAttrs["class"] = "form-control";
			$this->kdinformasi->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdinformasi->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdinformasi->AdvancedSearch->ViewValue = $this->kdinformasi->lookupCacheOption($curVal);
			else
				$this->kdinformasi->AdvancedSearch->ViewValue = $this->kdinformasi->Lookup !== NULL && is_array($this->kdinformasi->Lookup->Options) ? $curVal : NULL;
			if ($this->kdinformasi->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdinformasi->EditValue = array_values($this->kdinformasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdinformasi`" . SearchString("=", $this->kdinformasi->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdinformasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdinformasi->EditValue = $arwrk;
			}

			// konfirmasi
			$this->konfirmasi->EditAttrs["class"] = "form-control";
			$this->konfirmasi->EditCustomAttributes = "";
			$this->konfirmasi->EditValue = $this->konfirmasi->options(TRUE);

			// ket
			$this->ket->EditAttrs["class"] = "form-control";
			$this->ket->EditCustomAttributes = "";
			$this->ket->EditValue = $this->ket->options(TRUE);

			// ket_lainnya
			$this->ket_lainnya->EditAttrs["class"] = "form-control";
			$this->ket_lainnya->EditCustomAttributes = "";
			$this->ket_lainnya->EditValue = HtmlEncode($this->ket_lainnya->AdvancedSearch->SearchValue);
			$this->ket_lainnya->PlaceHolder = RemoveHtml($this->ket_lainnya->caption());
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
		if (!CheckDate($this->tgl_daftar->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tgl_daftar->errorMessage());
		}
		if (!CheckDate($this->tgl_bayar->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tgl_bayar->errorMessage());
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
		$this->nama->AdvancedSearch->load();
		$this->perusahaan->AdvancedSearch->load();
		$this->jabatan->AdvancedSearch->load();
		$this->tgl_daftar->AdvancedSearch->load();
		$this->telp->AdvancedSearch->load();
		$this->fax->AdvancedSearch->load();
		$this->hp->AdvancedSearch->load();
		$this->produk->AdvancedSearch->load();
		$this->cara_bayar->AdvancedSearch->load();
		$this->ket_bayar->AdvancedSearch->load();
		$this->tgl_bayar->AdvancedSearch->load();
		$this->kdinformasi->AdvancedSearch->load();
		$this->konfirmasi->AdvancedSearch->load();
		$this->ket->AdvancedSearch->load();
		$this->ket_lainnya->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_repesertalist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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
				case "x_idpelat":
					break;
				case "x_kdjudul":
					break;
				case "x_jabatan":
					break;
				case "x_cara_bayar":
					break;
				case "x_kdinformasi":
					break;
				case "x_konfirmasi":
					break;
				case "x_ket":
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
						case "x_idpelat":
							break;
						case "x_kdjudul":
							break;
						case "x_jabatan":
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
} // End class
?>