<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class cv_historipelatihanpeserta_add extends cv_historipelatihanpeserta
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 'cv_historipelatihanpeserta';

	// Page object name
	public $PageObjName = "cv_historipelatihanpeserta_add";

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

		// Table object (cv_historipelatihanpeserta)
		if (!isset($GLOBALS["cv_historipelatihanpeserta"]) || get_class($GLOBALS["cv_historipelatihanpeserta"]) == PROJECT_NAMESPACE . "cv_historipelatihanpeserta") {
			$GLOBALS["cv_historipelatihanpeserta"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cv_historipelatihanpeserta"];
		}

		// Table object (t_peserta)
		if (!isset($GLOBALS['t_peserta']))
			$GLOBALS['t_peserta'] = new t_peserta();

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'cv_historipelatihanpeserta');

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
		global $cv_historipelatihanpeserta;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($cv_historipelatihanpeserta);
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
					if ($pageName == "cv_historipelatihanpesertaview.php")
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
			$key .= @$ar['kdhistori'];
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
			$this->kdhistori->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("cv_historipelatihanpesertalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->kdhistori->Visible = FALSE;
		$this->id->setVisibility();
		$this->kdpelat->setVisibility();
		$this->tahun->setVisibility();
		$this->kdinformasi->setVisibility();
		$this->harapan->setVisibility();
		$this->sertifikat->setVisibility();
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
		$this->setupLookupOptions($this->kdpelat);
		$this->setupLookupOptions($this->kdinformasi);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("cv_historipelatihanpesertalist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("kdhistori") !== NULL) {
				$this->kdhistori->setQueryStringValue(Get("kdhistori"));
				$this->setKey("kdhistori", $this->kdhistori->CurrentValue); // Set up key
			} else {
				$this->setKey("kdhistori", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("cv_historipelatihanpesertalist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "cv_historipelatihanpesertalist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "cv_historipelatihanpesertaview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->kdhistori->CurrentValue = NULL;
		$this->kdhistori->OldValue = $this->kdhistori->CurrentValue;
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->kdpelat->CurrentValue = NULL;
		$this->kdpelat->OldValue = $this->kdpelat->CurrentValue;
		$this->tahun->CurrentValue = NULL;
		$this->tahun->OldValue = $this->tahun->CurrentValue;
		$this->kdinformasi->CurrentValue = NULL;
		$this->kdinformasi->OldValue = $this->kdinformasi->CurrentValue;
		$this->harapan->CurrentValue = NULL;
		$this->harapan->OldValue = $this->harapan->CurrentValue;
		$this->sertifikat->CurrentValue = NULL;
		$this->sertifikat->OldValue = $this->sertifikat->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->id->Visible = FALSE; // Disable update for API request
			else
				$this->id->setFormValue($val);
		}

		// Check field name 'kdpelat' first before field var 'x_kdpelat'
		$val = $CurrentForm->hasValue("kdpelat") ? $CurrentForm->getValue("kdpelat") : $CurrentForm->getValue("x_kdpelat");
		if (!$this->kdpelat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdpelat->Visible = FALSE; // Disable update for API request
			else
				$this->kdpelat->setFormValue($val);
		}

		// Check field name 'tahun' first before field var 'x_tahun'
		$val = $CurrentForm->hasValue("tahun") ? $CurrentForm->getValue("tahun") : $CurrentForm->getValue("x_tahun");
		if (!$this->tahun->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tahun->Visible = FALSE; // Disable update for API request
			else
				$this->tahun->setFormValue($val);
		}

		// Check field name 'kdinformasi' first before field var 'x_kdinformasi'
		$val = $CurrentForm->hasValue("kdinformasi") ? $CurrentForm->getValue("kdinformasi") : $CurrentForm->getValue("x_kdinformasi");
		if (!$this->kdinformasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdinformasi->Visible = FALSE; // Disable update for API request
			else
				$this->kdinformasi->setFormValue($val);
		}

		// Check field name 'harapan' first before field var 'x_harapan'
		$val = $CurrentForm->hasValue("harapan") ? $CurrentForm->getValue("harapan") : $CurrentForm->getValue("x_harapan");
		if (!$this->harapan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->harapan->Visible = FALSE; // Disable update for API request
			else
				$this->harapan->setFormValue($val);
		}

		// Check field name 'sertifikat' first before field var 'x_sertifikat'
		$val = $CurrentForm->hasValue("sertifikat") ? $CurrentForm->getValue("sertifikat") : $CurrentForm->getValue("x_sertifikat");
		if (!$this->sertifikat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sertifikat->Visible = FALSE; // Disable update for API request
			else
				$this->sertifikat->setFormValue($val);
		}

		// Check field name 'kdhistori' first before field var 'x_kdhistori'
		$val = $CurrentForm->hasValue("kdhistori") ? $CurrentForm->getValue("kdhistori") : $CurrentForm->getValue("x_kdhistori");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->kdpelat->CurrentValue = $this->kdpelat->FormValue;
		$this->tahun->CurrentValue = $this->tahun->FormValue;
		$this->kdinformasi->CurrentValue = $this->kdinformasi->FormValue;
		$this->harapan->CurrentValue = $this->harapan->FormValue;
		$this->sertifikat->CurrentValue = $this->sertifikat->FormValue;
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
		$this->kdhistori->setDbValue($row['kdhistori']);
		$this->id->setDbValue($row['id']);
		$this->kdpelat->setDbValue($row['kdpelat']);
		$this->tahun->setDbValue($row['tahun']);
		$this->kdinformasi->setDbValue($row['kdinformasi']);
		$this->harapan->setDbValue($row['harapan']);
		$this->sertifikat->setDbValue($row['sertifikat']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['kdhistori'] = $this->kdhistori->CurrentValue;
		$row['id'] = $this->id->CurrentValue;
		$row['kdpelat'] = $this->kdpelat->CurrentValue;
		$row['tahun'] = $this->tahun->CurrentValue;
		$row['kdinformasi'] = $this->kdinformasi->CurrentValue;
		$row['harapan'] = $this->harapan->CurrentValue;
		$row['sertifikat'] = $this->sertifikat->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("kdhistori")) != "")
			$this->kdhistori->OldValue = $this->getKey("kdhistori"); // kdhistori
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// kdhistori
		// id
		// kdpelat
		// tahun
		// kdinformasi
		// harapan
		// sertifikat

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$curVal = strval($this->id->CurrentValue);
			if ($curVal != "") {
				$this->id->ViewValue = $this->id->lookupCacheOption($curVal);
				if ($this->id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->id->ViewValue = $this->id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id->ViewValue = $this->id->CurrentValue;
					}
				}
			} else {
				$this->id->ViewValue = NULL;
			}
			$this->id->ViewCustomAttributes = "";

			// kdpelat
			$this->kdpelat->ViewValue = $this->kdpelat->CurrentValue;
			$curVal = strval($this->kdpelat->CurrentValue);
			if ($curVal != "") {
				$this->kdpelat->ViewValue = $this->kdpelat->lookupCacheOption($curVal);
				if ($this->kdpelat->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdpelat`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdpelat->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->kdpelat->ViewValue = $this->kdpelat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdpelat->ViewValue = $this->kdpelat->CurrentValue;
					}
				}
			} else {
				$this->kdpelat->ViewValue = NULL;
			}
			$this->kdpelat->ViewCustomAttributes = "";

			// tahun
			$this->tahun->ViewValue = $this->tahun->CurrentValue;
			$this->tahun->ViewCustomAttributes = "";

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

			// harapan
			$this->harapan->ViewValue = $this->harapan->CurrentValue;
			$this->harapan->ViewCustomAttributes = "";

			// sertifikat
			$this->sertifikat->ViewValue = $this->sertifikat->CurrentValue;
			$this->sertifikat->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			if (!EmptyValue($this->id->CurrentValue)) {
				$this->id->HrefValue = "t_pesertaview.php?showdetail=&id=" . $this->id->CurrentValue; // Add prefix/suffix
				$this->id->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->id->HrefValue = FullUrl($this->id->HrefValue, "href");
			} else {
				$this->id->HrefValue = "";
			}
			$this->id->TooltipValue = "";

			// kdpelat
			$this->kdpelat->LinkCustomAttributes = "";
			$this->kdpelat->HrefValue = "";
			$this->kdpelat->TooltipValue = "";

			// tahun
			$this->tahun->LinkCustomAttributes = "";
			$this->tahun->HrefValue = "";
			$this->tahun->TooltipValue = "";

			// kdinformasi
			$this->kdinformasi->LinkCustomAttributes = "";
			$this->kdinformasi->HrefValue = "";
			$this->kdinformasi->TooltipValue = "";

			// harapan
			$this->harapan->LinkCustomAttributes = "";
			$this->harapan->HrefValue = "";
			$this->harapan->TooltipValue = "";

			// sertifikat
			$this->sertifikat->LinkCustomAttributes = "";
			$this->sertifikat->HrefValue = "";
			$this->sertifikat->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			if ($this->id->getSessionValue() != "") {
				$this->id->CurrentValue = $this->id->getSessionValue();
				$this->id->ViewValue = $this->id->CurrentValue;
				$curVal = strval($this->id->CurrentValue);
				if ($curVal != "") {
					$this->id->ViewValue = $this->id->lookupCacheOption($curVal);
					if ($this->id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->id->ViewValue = $this->id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->id->ViewValue = $this->id->CurrentValue;
						}
					}
				} else {
					$this->id->ViewValue = NULL;
				}
				$this->id->ViewCustomAttributes = "";
			} else {
				$this->id->EditValue = HtmlEncode($this->id->CurrentValue);
				$curVal = strval($this->id->CurrentValue);
				if ($curVal != "") {
					$this->id->EditValue = $this->id->lookupCacheOption($curVal);
					if ($this->id->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$this->id->EditValue = $this->id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->id->EditValue = HtmlEncode($this->id->CurrentValue);
						}
					}
				} else {
					$this->id->EditValue = NULL;
				}
				$this->id->PlaceHolder = RemoveHtml($this->id->caption());
			}

			// kdpelat
			$this->kdpelat->EditAttrs["class"] = "form-control";
			$this->kdpelat->EditCustomAttributes = "";
			if (!$this->kdpelat->Raw)
				$this->kdpelat->CurrentValue = HtmlDecode($this->kdpelat->CurrentValue);
			$this->kdpelat->EditValue = HtmlEncode($this->kdpelat->CurrentValue);
			$curVal = strval($this->kdpelat->CurrentValue);
			if ($curVal != "") {
				$this->kdpelat->EditValue = $this->kdpelat->lookupCacheOption($curVal);
				if ($this->kdpelat->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdpelat`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdpelat->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
						$this->kdpelat->EditValue = $this->kdpelat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdpelat->EditValue = HtmlEncode($this->kdpelat->CurrentValue);
					}
				}
			} else {
				$this->kdpelat->EditValue = NULL;
			}
			$this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

			// tahun
			$this->tahun->EditAttrs["class"] = "form-control";
			$this->tahun->EditCustomAttributes = "";
			$this->tahun->EditValue = HtmlEncode($this->tahun->CurrentValue);
			$this->tahun->PlaceHolder = RemoveHtml($this->tahun->caption());

			// kdinformasi
			$this->kdinformasi->EditAttrs["class"] = "form-control";
			$this->kdinformasi->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdinformasi->CurrentValue));
			if ($curVal != "")
				$this->kdinformasi->ViewValue = $this->kdinformasi->lookupCacheOption($curVal);
			else
				$this->kdinformasi->ViewValue = $this->kdinformasi->Lookup !== NULL && is_array($this->kdinformasi->Lookup->Options) ? $curVal : NULL;
			if ($this->kdinformasi->ViewValue !== NULL) { // Load from cache
				$this->kdinformasi->EditValue = array_values($this->kdinformasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdinformasi`" . SearchString("=", $this->kdinformasi->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdinformasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdinformasi->EditValue = $arwrk;
			}

			// harapan
			$this->harapan->EditAttrs["class"] = "form-control";
			$this->harapan->EditCustomAttributes = "";
			$this->harapan->EditValue = HtmlEncode($this->harapan->CurrentValue);
			$this->harapan->PlaceHolder = RemoveHtml($this->harapan->caption());

			// sertifikat
			$this->sertifikat->EditAttrs["class"] = "form-control";
			$this->sertifikat->EditCustomAttributes = "";
			if (!$this->sertifikat->Raw)
				$this->sertifikat->CurrentValue = HtmlDecode($this->sertifikat->CurrentValue);
			$this->sertifikat->EditValue = HtmlEncode($this->sertifikat->CurrentValue);
			$this->sertifikat->PlaceHolder = RemoveHtml($this->sertifikat->caption());

			// Add refer script
			// id

			$this->id->LinkCustomAttributes = "";
			if (!EmptyValue($this->id->CurrentValue)) {
				$this->id->HrefValue = "t_pesertaview.php?showdetail=&id=" . $this->id->CurrentValue; // Add prefix/suffix
				$this->id->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->id->HrefValue = FullUrl($this->id->HrefValue, "href");
			} else {
				$this->id->HrefValue = "";
			}

			// kdpelat
			$this->kdpelat->LinkCustomAttributes = "";
			$this->kdpelat->HrefValue = "";

			// tahun
			$this->tahun->LinkCustomAttributes = "";
			$this->tahun->HrefValue = "";

			// kdinformasi
			$this->kdinformasi->LinkCustomAttributes = "";
			$this->kdinformasi->HrefValue = "";

			// harapan
			$this->harapan->LinkCustomAttributes = "";
			$this->harapan->HrefValue = "";

			// sertifikat
			$this->sertifikat->LinkCustomAttributes = "";
			$this->sertifikat->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id->FormValue)) {
			AddMessage($FormError, $this->id->errorMessage());
		}
		if ($this->kdpelat->Required) {
			if (!$this->kdpelat->IsDetailKey && $this->kdpelat->FormValue != NULL && $this->kdpelat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdpelat->caption(), $this->kdpelat->RequiredErrorMessage));
			}
		}
		if ($this->tahun->Required) {
			if (!$this->tahun->IsDetailKey && $this->tahun->FormValue != NULL && $this->tahun->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tahun->caption(), $this->tahun->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tahun->FormValue)) {
			AddMessage($FormError, $this->tahun->errorMessage());
		}
		if ($this->kdinformasi->Required) {
			if (!$this->kdinformasi->IsDetailKey && $this->kdinformasi->FormValue != NULL && $this->kdinformasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdinformasi->caption(), $this->kdinformasi->RequiredErrorMessage));
			}
		}
		if ($this->harapan->Required) {
			if (!$this->harapan->IsDetailKey && $this->harapan->FormValue != NULL && $this->harapan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->harapan->caption(), $this->harapan->RequiredErrorMessage));
			}
		}
		if ($this->sertifikat->Required) {
			if (!$this->sertifikat->IsDetailKey && $this->sertifikat->FormValue != NULL && $this->sertifikat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sertifikat->caption(), $this->sertifikat->RequiredErrorMessage));
			}
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

		// id
		$this->id->setDbValueDef($rsnew, $this->id->CurrentValue, NULL, FALSE);

		// kdpelat
		$this->kdpelat->setDbValueDef($rsnew, $this->kdpelat->CurrentValue, NULL, FALSE);

		// tahun
		$this->tahun->setDbValueDef($rsnew, $this->tahun->CurrentValue, NULL, FALSE);

		// kdinformasi
		$this->kdinformasi->setDbValueDef($rsnew, $this->kdinformasi->CurrentValue, NULL, FALSE);

		// harapan
		$this->harapan->setDbValueDef($rsnew, $this->harapan->CurrentValue, NULL, FALSE);

		// sertifikat
		$this->sertifikat->setDbValueDef($rsnew, $this->sertifikat->CurrentValue, NULL, FALSE);

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
			if ($masterTblVar == "t_peserta") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("id"))) !== NULL) {
					$GLOBALS["t_peserta"]->id->setQueryStringValue($parm);
					$this->id->setQueryStringValue($GLOBALS["t_peserta"]->id->QueryStringValue);
					$this->id->setSessionValue($this->id->QueryStringValue);
					if (!is_numeric($GLOBALS["t_peserta"]->id->QueryStringValue))
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
			if ($masterTblVar == "t_peserta") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("id"))) !== NULL) {
					$GLOBALS["t_peserta"]->id->setFormValue($parm);
					$this->id->setFormValue($GLOBALS["t_peserta"]->id->FormValue);
					$this->id->setSessionValue($this->id->FormValue);
					if (!is_numeric($GLOBALS["t_peserta"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "t_peserta") {
				if ($this->id->CurrentValue == "")
					$this->id->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("cv_historipelatihanpesertalist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_kdpelat":
					break;
				case "x_kdinformasi":
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
						case "x_kdpelat":
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