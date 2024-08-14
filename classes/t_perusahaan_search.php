<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_perusahaan_search extends t_perusahaan
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_perusahaan';

	// Page object name
	public $PageObjName = "t_perusahaan_search";

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

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "t_perusahaanview.php")
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
					$this->terminate(GetUrl("t_perusahaanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->namap->setVisibility();
		$this->idp->Visible = FALSE;
		$this->kontak->setVisibility();
		$this->kdlokasi->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->alamatp->setVisibility();
		$this->kdpos->setVisibility();
		$this->telpp->setVisibility();
		$this->faxp->setVisibility();
		$this->emailp->setVisibility();
		$this->webp->setVisibility();
		$this->medsos->Visible = FALSE;
		$this->kdjenis->setVisibility();
		$this->kdproduknafed->setVisibility();
		$this->kdproduknafed2->Visible = FALSE;
		$this->kdproduknafed3->Visible = FALSE;
		$this->pproduk->setVisibility();
		$this->kdexport->setVisibility();
		$this->nexport->setVisibility();
		$this->kdskala->setVisibility();
		$this->kdkategori->setVisibility();
		$this->omzet_saat_ini->setVisibility();
		$this->omzet_stl_6bln->Visible = FALSE;
		$this->omzet_stl_1thn->Visible = FALSE;
		$this->omzet_stl_2thn->Visible = FALSE;
		$this->kapasitas_saat_ini->setVisibility();
		$this->kapasitas_stl_6bln->Visible = FALSE;
		$this->kapasitas_stl_1thn->setVisibility();
		$this->kapasitas_stl_2thn->setVisibility();
		$this->created_at->Visible = FALSE;
		$this->user_created_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->user_updated_by->Visible = FALSE;
		$this->jpeserta->setVisibility();
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
					$srchStr = "t_perusahaanlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->namap); // namap
		$this->buildSearchUrl($srchUrl, $this->kontak); // kontak
		$this->buildSearchUrl($srchUrl, $this->kdlokasi); // kdlokasi
		$this->buildSearchUrl($srchUrl, $this->kdprop); // kdprop
		$this->buildSearchUrl($srchUrl, $this->kdkota); // kdkota
		$this->buildSearchUrl($srchUrl, $this->kdkec); // kdkec
		$this->buildSearchUrl($srchUrl, $this->alamatp); // alamatp
		$this->buildSearchUrl($srchUrl, $this->kdpos); // kdpos
		$this->buildSearchUrl($srchUrl, $this->telpp); // telpp
		$this->buildSearchUrl($srchUrl, $this->faxp); // faxp
		$this->buildSearchUrl($srchUrl, $this->emailp); // emailp
		$this->buildSearchUrl($srchUrl, $this->webp); // webp
		$this->buildSearchUrl($srchUrl, $this->kdjenis); // kdjenis
		$this->buildSearchUrl($srchUrl, $this->kdproduknafed); // kdproduknafed
		$this->buildSearchUrl($srchUrl, $this->pproduk); // pproduk
		$this->buildSearchUrl($srchUrl, $this->kdexport); // kdexport
		$this->buildSearchUrl($srchUrl, $this->nexport); // nexport
		$this->buildSearchUrl($srchUrl, $this->kdskala); // kdskala
		$this->buildSearchUrl($srchUrl, $this->kdkategori); // kdkategori
		$this->buildSearchUrl($srchUrl, $this->omzet_saat_ini); // omzet_saat_ini
		$this->buildSearchUrl($srchUrl, $this->kapasitas_saat_ini); // kapasitas_saat_ini
		$this->buildSearchUrl($srchUrl, $this->kapasitas_stl_1thn); // kapasitas_stl_1thn
		$this->buildSearchUrl($srchUrl, $this->kapasitas_stl_2thn); // kapasitas_stl_2thn
		$this->buildSearchUrl($srchUrl, $this->jpeserta); // jpeserta
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
		if ($this->namap->AdvancedSearch->post())
			$got = TRUE;
		if ($this->idp->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kontak->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdlokasi->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdprop->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdkota->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdkec->AdvancedSearch->post())
			$got = TRUE;
		if ($this->alamatp->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdpos->AdvancedSearch->post())
			$got = TRUE;
		if ($this->telpp->AdvancedSearch->post())
			$got = TRUE;
		if ($this->faxp->AdvancedSearch->post())
			$got = TRUE;
		if ($this->emailp->AdvancedSearch->post())
			$got = TRUE;
		if ($this->webp->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdjenis->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdproduknafed->AdvancedSearch->post())
			$got = TRUE;
		if ($this->pproduk->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdexport->AdvancedSearch->post())
			$got = TRUE;
		if ($this->nexport->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdskala->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdkategori->AdvancedSearch->post())
			$got = TRUE;
		if ($this->omzet_saat_ini->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kapasitas_saat_ini->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kapasitas_stl_1thn->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kapasitas_stl_2thn->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jpeserta->AdvancedSearch->post())
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

			// kontak
			$this->kontak->LinkCustomAttributes = "";
			$this->kontak->HrefValue = "";
			$this->kontak->TooltipValue = "";

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

			// kdpos
			$this->kdpos->LinkCustomAttributes = "";
			$this->kdpos->HrefValue = "";
			$this->kdpos->TooltipValue = "";

			// telpp
			$this->telpp->LinkCustomAttributes = "";
			$this->telpp->HrefValue = "";
			$this->telpp->TooltipValue = "";

			// faxp
			$this->faxp->LinkCustomAttributes = "";
			$this->faxp->HrefValue = "";
			$this->faxp->TooltipValue = "";

			// emailp
			$this->emailp->LinkCustomAttributes = "";
			$this->emailp->HrefValue = "";
			$this->emailp->TooltipValue = "";

			// webp
			$this->webp->LinkCustomAttributes = "";
			$this->webp->HrefValue = "";
			$this->webp->TooltipValue = "";

			// kdjenis
			$this->kdjenis->LinkCustomAttributes = "";
			$this->kdjenis->HrefValue = "";
			$this->kdjenis->TooltipValue = "";

			// kdproduknafed
			$this->kdproduknafed->LinkCustomAttributes = "";
			$this->kdproduknafed->HrefValue = "";
			$this->kdproduknafed->TooltipValue = "";

			// pproduk
			$this->pproduk->LinkCustomAttributes = "";
			$this->pproduk->HrefValue = "";
			$this->pproduk->TooltipValue = "";

			// kdexport
			$this->kdexport->LinkCustomAttributes = "";
			$this->kdexport->HrefValue = "";
			$this->kdexport->TooltipValue = "";

			// nexport
			$this->nexport->LinkCustomAttributes = "";
			$this->nexport->HrefValue = "";
			$this->nexport->TooltipValue = "";

			// kdskala
			$this->kdskala->LinkCustomAttributes = "";
			$this->kdskala->HrefValue = "";
			$this->kdskala->TooltipValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";
			$this->kdkategori->TooltipValue = "";

			// omzet_saat_ini
			$this->omzet_saat_ini->LinkCustomAttributes = "";
			$this->omzet_saat_ini->HrefValue = "";
			$this->omzet_saat_ini->TooltipValue = "";

			// kapasitas_saat_ini
			$this->kapasitas_saat_ini->LinkCustomAttributes = "";
			$this->kapasitas_saat_ini->HrefValue = "";
			$this->kapasitas_saat_ini->TooltipValue = "";

			// kapasitas_stl_1thn
			$this->kapasitas_stl_1thn->LinkCustomAttributes = "";
			$this->kapasitas_stl_1thn->HrefValue = "";
			$this->kapasitas_stl_1thn->TooltipValue = "";

			// kapasitas_stl_2thn
			$this->kapasitas_stl_2thn->LinkCustomAttributes = "";
			$this->kapasitas_stl_2thn->HrefValue = "";
			$this->kapasitas_stl_2thn->TooltipValue = "";

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
			$curVal = trim(strval($this->kdlokasi->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdlokasi->AdvancedSearch->ViewValue = $this->kdlokasi->lookupCacheOption($curVal);
			else
				$this->kdlokasi->AdvancedSearch->ViewValue = $this->kdlokasi->Lookup !== NULL && is_array($this->kdlokasi->Lookup->Options) ? $curVal : NULL;
			if ($this->kdlokasi->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdlokasi->EditValue = array_values($this->kdlokasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdlokasi`" . SearchString("=", $this->kdlokasi->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdlokasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdlokasi->EditValue = $arwrk;
			}

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdprop->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdprop->AdvancedSearch->ViewValue = $this->kdprop->lookupCacheOption($curVal);
			else
				$this->kdprop->AdvancedSearch->ViewValue = $this->kdprop->Lookup !== NULL && is_array($this->kdprop->Lookup->Options) ? $curVal : NULL;
			if ($this->kdprop->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdprop->EditValue = array_values($this->kdprop->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdprop`" . SearchString("=", $this->kdprop->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdprop->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdprop->EditValue = $arwrk;
			}

			// kdkota
			$this->kdkota->EditAttrs["class"] = "form-control";
			$this->kdkota->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkota->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdkota->AdvancedSearch->ViewValue = $this->kdkota->lookupCacheOption($curVal);
			else
				$this->kdkota->AdvancedSearch->ViewValue = $this->kdkota->Lookup !== NULL && is_array($this->kdkota->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkota->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdkota->EditValue = array_values($this->kdkota->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkota`" . SearchString("=", $this->kdkota->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkota->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkota->EditValue = $arwrk;
			}

			// kdkec
			$this->kdkec->EditAttrs["class"] = "form-control";
			$this->kdkec->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkec->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdkec->AdvancedSearch->ViewValue = $this->kdkec->lookupCacheOption($curVal);
			else
				$this->kdkec->AdvancedSearch->ViewValue = $this->kdkec->Lookup !== NULL && is_array($this->kdkec->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkec->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdkec->EditValue = array_values($this->kdkec->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkec`" . SearchString("=", $this->kdkec->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkec->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkec->EditValue = $arwrk;
			}

			// alamatp
			$this->alamatp->EditAttrs["class"] = "form-control";
			$this->alamatp->EditCustomAttributes = "";
			$this->alamatp->EditValue = HtmlEncode($this->alamatp->AdvancedSearch->SearchValue);
			$this->alamatp->PlaceHolder = RemoveHtml($this->alamatp->caption());

			// kdpos
			$this->kdpos->EditAttrs["class"] = "form-control";
			$this->kdpos->EditCustomAttributes = "";
			if (!$this->kdpos->Raw)
				$this->kdpos->AdvancedSearch->SearchValue = HtmlDecode($this->kdpos->AdvancedSearch->SearchValue);
			$this->kdpos->EditValue = HtmlEncode($this->kdpos->AdvancedSearch->SearchValue);
			$this->kdpos->PlaceHolder = RemoveHtml($this->kdpos->caption());

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

			// kdjenis
			$this->kdjenis->EditAttrs["class"] = "form-control";
			$this->kdjenis->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdjenis->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdjenis->AdvancedSearch->ViewValue = $this->kdjenis->lookupCacheOption($curVal);
			else
				$this->kdjenis->AdvancedSearch->ViewValue = $this->kdjenis->Lookup !== NULL && is_array($this->kdjenis->Lookup->Options) ? $curVal : NULL;
			if ($this->kdjenis->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdjenis->EditValue = array_values($this->kdjenis->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdjenis`" . SearchString("=", $this->kdjenis->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdjenis->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdjenis->EditValue = $arwrk;
			}

			// kdproduknafed
			$this->kdproduknafed->EditAttrs["class"] = "form-control";
			$this->kdproduknafed->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdproduknafed->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdproduknafed->AdvancedSearch->ViewValue = $this->kdproduknafed->lookupCacheOption($curVal);
			else
				$this->kdproduknafed->AdvancedSearch->ViewValue = $this->kdproduknafed->Lookup !== NULL && is_array($this->kdproduknafed->Lookup->Options) ? $curVal : NULL;
			if ($this->kdproduknafed->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdproduknafed->EditValue = array_values($this->kdproduknafed->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdproduknafed`" . SearchString("=", $this->kdproduknafed->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdproduknafed->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdproduknafed->EditValue = $arwrk;
			}

			// pproduk
			$this->pproduk->EditAttrs["class"] = "form-control";
			$this->pproduk->EditCustomAttributes = "";
			$this->pproduk->EditValue = HtmlEncode($this->pproduk->AdvancedSearch->SearchValue);
			$this->pproduk->PlaceHolder = RemoveHtml($this->pproduk->caption());

			// kdexport
			$this->kdexport->EditAttrs["class"] = "form-control";
			$this->kdexport->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdexport->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdexport->AdvancedSearch->ViewValue = $this->kdexport->lookupCacheOption($curVal);
			else
				$this->kdexport->AdvancedSearch->ViewValue = $this->kdexport->Lookup !== NULL && is_array($this->kdexport->Lookup->Options) ? $curVal : NULL;
			if ($this->kdexport->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdexport->EditValue = array_values($this->kdexport->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdexport`" . SearchString("=", $this->kdexport->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdexport->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdexport->EditValue = $arwrk;
			}

			// nexport
			$this->nexport->EditAttrs["class"] = "form-control";
			$this->nexport->EditCustomAttributes = "";
			$this->nexport->EditValue = HtmlEncode($this->nexport->AdvancedSearch->SearchValue);
			$this->nexport->PlaceHolder = RemoveHtml($this->nexport->caption());

			// kdskala
			$this->kdskala->EditAttrs["class"] = "form-control";
			$this->kdskala->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdskala->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdskala->AdvancedSearch->ViewValue = $this->kdskala->lookupCacheOption($curVal);
			else
				$this->kdskala->AdvancedSearch->ViewValue = $this->kdskala->Lookup !== NULL && is_array($this->kdskala->Lookup->Options) ? $curVal : NULL;
			if ($this->kdskala->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdskala->EditValue = array_values($this->kdskala->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdskala`" . SearchString("=", $this->kdskala->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdskala->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdskala->EditValue = $arwrk;
			}

			// kdkategori
			$this->kdkategori->EditAttrs["class"] = "form-control";
			$this->kdkategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkategori->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdkategori->AdvancedSearch->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
			else
				$this->kdkategori->AdvancedSearch->ViewValue = $this->kdkategori->Lookup !== NULL && is_array($this->kdkategori->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkategori->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdkategori->EditValue = array_values($this->kdkategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkategori`" . SearchString("=", $this->kdkategori->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkategori->EditValue = $arwrk;
			}

			// omzet_saat_ini
			$this->omzet_saat_ini->EditAttrs["class"] = "form-control";
			$this->omzet_saat_ini->EditCustomAttributes = "";
			if (!$this->omzet_saat_ini->Raw)
				$this->omzet_saat_ini->AdvancedSearch->SearchValue = HtmlDecode($this->omzet_saat_ini->AdvancedSearch->SearchValue);
			$this->omzet_saat_ini->EditValue = HtmlEncode($this->omzet_saat_ini->AdvancedSearch->SearchValue);
			$this->omzet_saat_ini->PlaceHolder = RemoveHtml($this->omzet_saat_ini->caption());

			// kapasitas_saat_ini
			$this->kapasitas_saat_ini->EditAttrs["class"] = "form-control";
			$this->kapasitas_saat_ini->EditCustomAttributes = "";
			if (!$this->kapasitas_saat_ini->Raw)
				$this->kapasitas_saat_ini->AdvancedSearch->SearchValue = HtmlDecode($this->kapasitas_saat_ini->AdvancedSearch->SearchValue);
			$this->kapasitas_saat_ini->EditValue = HtmlEncode($this->kapasitas_saat_ini->AdvancedSearch->SearchValue);
			$this->kapasitas_saat_ini->PlaceHolder = RemoveHtml($this->kapasitas_saat_ini->caption());

			// kapasitas_stl_1thn
			$this->kapasitas_stl_1thn->EditAttrs["class"] = "form-control";
			$this->kapasitas_stl_1thn->EditCustomAttributes = "";
			if (!$this->kapasitas_stl_1thn->Raw)
				$this->kapasitas_stl_1thn->AdvancedSearch->SearchValue = HtmlDecode($this->kapasitas_stl_1thn->AdvancedSearch->SearchValue);
			$this->kapasitas_stl_1thn->EditValue = HtmlEncode($this->kapasitas_stl_1thn->AdvancedSearch->SearchValue);
			$this->kapasitas_stl_1thn->PlaceHolder = RemoveHtml($this->kapasitas_stl_1thn->caption());

			// kapasitas_stl_2thn
			$this->kapasitas_stl_2thn->EditAttrs["class"] = "form-control";
			$this->kapasitas_stl_2thn->EditCustomAttributes = "";
			if (!$this->kapasitas_stl_2thn->Raw)
				$this->kapasitas_stl_2thn->AdvancedSearch->SearchValue = HtmlDecode($this->kapasitas_stl_2thn->AdvancedSearch->SearchValue);
			$this->kapasitas_stl_2thn->EditValue = HtmlEncode($this->kapasitas_stl_2thn->AdvancedSearch->SearchValue);
			$this->kapasitas_stl_2thn->PlaceHolder = RemoveHtml($this->kapasitas_stl_2thn->caption());

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
		if (!CheckInteger($this->jpeserta->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->jpeserta->errorMessage());
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_perusahaanlist.php"), "", $this->TableVar, TRUE);
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