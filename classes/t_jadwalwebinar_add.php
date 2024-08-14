<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_jadwalwebinar_add extends t_jadwalwebinar
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_jadwalwebinar';

	// Page object name
	public $PageObjName = "t_jadwalwebinar_add";

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

		// Table object (t_jadwalwebinar)
		if (!isset($GLOBALS["t_jadwalwebinar"]) || get_class($GLOBALS["t_jadwalwebinar"]) == PROJECT_NAMESPACE . "t_jadwalwebinar") {
			$GLOBALS["t_jadwalwebinar"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_jadwalwebinar"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (webinar)
		if (!isset($GLOBALS['webinar']))
			$GLOBALS['webinar'] = new webinar();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_jadwalwebinar');

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
		global $t_jadwalwebinar;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_jadwalwebinar);
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
					if ($pageName == "t_jadwalwebinarview.php")
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
			$key .= @$ar['idjadwal'];
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
			$this->idjadwal->Visible = FALSE;
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
	public $MultiPages; // Multi pages object

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
					$this->terminate(GetUrl("t_jadwalwebinarlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->idjadwal->Visible = FALSE;
		$this->idpelat->setVisibility();
		$this->kdjudul->setVisibility();
		$this->tgl->setVisibility();
		$this->jam->setVisibility();
		$this->jam_akhir->setVisibility();
		$this->kurikulumid->Visible = FALSE;
		$this->materi->setVisibility();
		$this->instruktur->setVisibility();
		$this->instansi->setVisibility();
		$this->ket->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up multi page object
		$this->setupMultiPages();

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
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->kurikulumid);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_jadwalwebinarlist.php");
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
			if (Get("idjadwal") !== NULL) {
				$this->idjadwal->setQueryStringValue(Get("idjadwal"));
				$this->setKey("idjadwal", $this->idjadwal->CurrentValue); // Set up key
			} else {
				$this->setKey("idjadwal", ""); // Clear key
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
					$this->terminate("t_jadwalwebinarlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "t_jadwalwebinarlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_jadwalwebinarview.php")
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
		$this->idjadwal->CurrentValue = NULL;
		$this->idjadwal->OldValue = $this->idjadwal->CurrentValue;
		$this->idpelat->CurrentValue = NULL;
		$this->idpelat->OldValue = $this->idpelat->CurrentValue;
		$this->kdjudul->CurrentValue = NULL;
		$this->kdjudul->OldValue = $this->kdjudul->CurrentValue;
		$this->tgl->CurrentValue = NULL;
		$this->tgl->OldValue = $this->tgl->CurrentValue;
		$this->jam->CurrentValue = NULL;
		$this->jam->OldValue = $this->jam->CurrentValue;
		$this->jam_akhir->CurrentValue = NULL;
		$this->jam_akhir->OldValue = $this->jam_akhir->CurrentValue;
		$this->kurikulumid->CurrentValue = NULL;
		$this->kurikulumid->OldValue = $this->kurikulumid->CurrentValue;
		$this->materi->CurrentValue = NULL;
		$this->materi->OldValue = $this->materi->CurrentValue;
		$this->instruktur->CurrentValue = NULL;
		$this->instruktur->OldValue = $this->instruktur->CurrentValue;
		$this->instansi->CurrentValue = NULL;
		$this->instansi->OldValue = $this->instansi->CurrentValue;
		$this->ket->CurrentValue = NULL;
		$this->ket->OldValue = $this->ket->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'idpelat' first before field var 'x_idpelat'
		$val = $CurrentForm->hasValue("idpelat") ? $CurrentForm->getValue("idpelat") : $CurrentForm->getValue("x_idpelat");
		if (!$this->idpelat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idpelat->Visible = FALSE; // Disable update for API request
			else
				$this->idpelat->setFormValue($val);
		}

		// Check field name 'kdjudul' first before field var 'x_kdjudul'
		$val = $CurrentForm->hasValue("kdjudul") ? $CurrentForm->getValue("kdjudul") : $CurrentForm->getValue("x_kdjudul");
		if (!$this->kdjudul->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdjudul->Visible = FALSE; // Disable update for API request
			else
				$this->kdjudul->setFormValue($val);
		}

		// Check field name 'tgl' first before field var 'x_tgl'
		$val = $CurrentForm->hasValue("tgl") ? $CurrentForm->getValue("tgl") : $CurrentForm->getValue("x_tgl");
		if (!$this->tgl->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl->Visible = FALSE; // Disable update for API request
			else
				$this->tgl->setFormValue($val);
			$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		}

		// Check field name 'jam' first before field var 'x_jam'
		$val = $CurrentForm->hasValue("jam") ? $CurrentForm->getValue("jam") : $CurrentForm->getValue("x_jam");
		if (!$this->jam->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jam->Visible = FALSE; // Disable update for API request
			else
				$this->jam->setFormValue($val);
			$this->jam->CurrentValue = UnFormatDateTime($this->jam->CurrentValue, 4);
		}

		// Check field name 'jam_akhir' first before field var 'x_jam_akhir'
		$val = $CurrentForm->hasValue("jam_akhir") ? $CurrentForm->getValue("jam_akhir") : $CurrentForm->getValue("x_jam_akhir");
		if (!$this->jam_akhir->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jam_akhir->Visible = FALSE; // Disable update for API request
			else
				$this->jam_akhir->setFormValue($val);
			$this->jam_akhir->CurrentValue = UnFormatDateTime($this->jam_akhir->CurrentValue, 4);
		}

		// Check field name 'materi' first before field var 'x_materi'
		$val = $CurrentForm->hasValue("materi") ? $CurrentForm->getValue("materi") : $CurrentForm->getValue("x_materi");
		if (!$this->materi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->materi->Visible = FALSE; // Disable update for API request
			else
				$this->materi->setFormValue($val);
		}

		// Check field name 'instruktur' first before field var 'x_instruktur'
		$val = $CurrentForm->hasValue("instruktur") ? $CurrentForm->getValue("instruktur") : $CurrentForm->getValue("x_instruktur");
		if (!$this->instruktur->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->instruktur->Visible = FALSE; // Disable update for API request
			else
				$this->instruktur->setFormValue($val);
		}

		// Check field name 'instansi' first before field var 'x_instansi'
		$val = $CurrentForm->hasValue("instansi") ? $CurrentForm->getValue("instansi") : $CurrentForm->getValue("x_instansi");
		if (!$this->instansi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->instansi->Visible = FALSE; // Disable update for API request
			else
				$this->instansi->setFormValue($val);
		}

		// Check field name 'ket' first before field var 'x_ket'
		$val = $CurrentForm->hasValue("ket") ? $CurrentForm->getValue("ket") : $CurrentForm->getValue("x_ket");
		if (!$this->ket->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ket->Visible = FALSE; // Disable update for API request
			else
				$this->ket->setFormValue($val);
		}

		// Check field name 'idjadwal' first before field var 'x_idjadwal'
		$val = $CurrentForm->hasValue("idjadwal") ? $CurrentForm->getValue("idjadwal") : $CurrentForm->getValue("x_idjadwal");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->idpelat->CurrentValue = $this->idpelat->FormValue;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->tgl->CurrentValue = $this->tgl->FormValue;
		$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		$this->jam->CurrentValue = $this->jam->FormValue;
		$this->jam->CurrentValue = UnFormatDateTime($this->jam->CurrentValue, 4);
		$this->jam_akhir->CurrentValue = $this->jam_akhir->FormValue;
		$this->jam_akhir->CurrentValue = UnFormatDateTime($this->jam_akhir->CurrentValue, 4);
		$this->materi->CurrentValue = $this->materi->FormValue;
		$this->instruktur->CurrentValue = $this->instruktur->FormValue;
		$this->instansi->CurrentValue = $this->instansi->FormValue;
		$this->ket->CurrentValue = $this->ket->FormValue;
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
		$this->idjadwal->setDbValue($row['idjadwal']);
		$this->idpelat->setDbValue($row['idpelat']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		$this->tgl->setDbValue($row['tgl']);
		$this->jam->setDbValue($row['jam']);
		$this->jam_akhir->setDbValue($row['jam_akhir']);
		$this->kurikulumid->setDbValue($row['kurikulumid']);
		$this->materi->setDbValue($row['materi']);
		$this->instruktur->setDbValue($row['instruktur']);
		$this->instansi->setDbValue($row['instansi']);
		$this->ket->setDbValue($row['ket']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['idjadwal'] = $this->idjadwal->CurrentValue;
		$row['idpelat'] = $this->idpelat->CurrentValue;
		$row['kdjudul'] = $this->kdjudul->CurrentValue;
		$row['tgl'] = $this->tgl->CurrentValue;
		$row['jam'] = $this->jam->CurrentValue;
		$row['jam_akhir'] = $this->jam_akhir->CurrentValue;
		$row['kurikulumid'] = $this->kurikulumid->CurrentValue;
		$row['materi'] = $this->materi->CurrentValue;
		$row['instruktur'] = $this->instruktur->CurrentValue;
		$row['instansi'] = $this->instansi->CurrentValue;
		$row['ket'] = $this->ket->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idjadwal")) != "")
			$this->idjadwal->OldValue = $this->getKey("idjadwal"); // idjadwal
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
		// idjadwal
		// idpelat
		// kdjudul
		// tgl
		// jam
		// jam_akhir
		// kurikulumid
		// materi
		// instruktur
		// instansi
		// ket

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// idpelat
			$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
			$this->idpelat->ViewCustomAttributes = "";

			// kdjudul
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
			$this->kdjudul->ViewCustomAttributes = "";

			// tgl
			$this->tgl->ViewValue = $this->tgl->CurrentValue;
			$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
			$this->tgl->ViewCustomAttributes = "";

			// jam
			$this->jam->ViewValue = $this->jam->CurrentValue;
			$this->jam->ViewValue = FormatDateTime($this->jam->ViewValue, 4);
			$this->jam->ViewCustomAttributes = "width='100px'";

			// jam_akhir
			$this->jam_akhir->ViewValue = $this->jam_akhir->CurrentValue;
			$this->jam_akhir->ViewValue = FormatDateTime($this->jam_akhir->ViewValue, 4);
			$this->jam_akhir->ViewCustomAttributes = "width='100px'";

			// materi
			$this->materi->ViewValue = $this->materi->CurrentValue;
			$this->materi->ViewCustomAttributes = "";

			// instruktur
			$this->instruktur->ViewValue = $this->instruktur->CurrentValue;
			$this->instruktur->ViewCustomAttributes = "";

			// instansi
			$this->instansi->ViewValue = $this->instansi->CurrentValue;
			$this->instansi->ViewCustomAttributes = "";

			// ket
			$this->ket->ViewValue = $this->ket->CurrentValue;
			$this->ket->ViewCustomAttributes = "";

			// idpelat
			$this->idpelat->LinkCustomAttributes = "";
			$this->idpelat->HrefValue = "";
			$this->idpelat->TooltipValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";
			$this->tgl->TooltipValue = "";

			// jam
			$this->jam->LinkCustomAttributes = "";
			$this->jam->HrefValue = "";
			$this->jam->TooltipValue = "";

			// jam_akhir
			$this->jam_akhir->LinkCustomAttributes = "";
			$this->jam_akhir->HrefValue = "";
			$this->jam_akhir->TooltipValue = "";

			// materi
			$this->materi->LinkCustomAttributes = "";
			$this->materi->HrefValue = "";
			$this->materi->TooltipValue = "";

			// instruktur
			$this->instruktur->LinkCustomAttributes = "";
			$this->instruktur->HrefValue = "";
			$this->instruktur->TooltipValue = "";

			// instansi
			$this->instansi->LinkCustomAttributes = "";
			$this->instansi->HrefValue = "";
			$this->instansi->TooltipValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";
			$this->ket->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// idpelat
			$this->idpelat->EditAttrs["class"] = "form-control";
			$this->idpelat->EditCustomAttributes = "";
			if ($this->idpelat->getSessionValue() != "") {
				$this->idpelat->CurrentValue = $this->idpelat->getSessionValue();
				$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
				$this->idpelat->ViewCustomAttributes = "";
			} else {
				$this->idpelat->EditValue = HtmlEncode($this->idpelat->CurrentValue);
				$this->idpelat->PlaceHolder = RemoveHtml($this->idpelat->caption());
			}

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if (!$this->kdjudul->Raw)
				$this->kdjudul->CurrentValue = HtmlDecode($this->kdjudul->CurrentValue);
			$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->CurrentValue);
			$curVal = strval($this->kdjudul->CurrentValue);
			if ($curVal != "") {
				$this->kdjudul->EditValue = $this->kdjudul->lookupCacheOption($curVal);
				if ($this->kdjudul->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdjudul`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdjudul->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kdjudul->EditValue = $this->kdjudul->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->CurrentValue);
					}
				}
			} else {
				$this->kdjudul->EditValue = NULL;
			}
			$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

			// tgl
			$this->tgl->EditAttrs["class"] = "form-control";
			$this->tgl->EditCustomAttributes = 'style=" width: 100px; "';
			$this->tgl->EditValue = HtmlEncode(FormatDateTime($this->tgl->CurrentValue, 8));
			$this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

			// jam
			$this->jam->EditAttrs["class"] = "form-control";
			$this->jam->EditCustomAttributes = "";
			$this->jam->EditValue = HtmlEncode($this->jam->CurrentValue);
			$this->jam->PlaceHolder = RemoveHtml($this->jam->caption());

			// jam_akhir
			$this->jam_akhir->EditAttrs["class"] = "form-control";
			$this->jam_akhir->EditCustomAttributes = "";
			$this->jam_akhir->EditValue = HtmlEncode($this->jam_akhir->CurrentValue);
			$this->jam_akhir->PlaceHolder = RemoveHtml($this->jam_akhir->caption());

			// materi
			$this->materi->EditAttrs["class"] = "form-control";
			$this->materi->EditCustomAttributes = "";
			if (!$this->materi->Raw)
				$this->materi->CurrentValue = HtmlDecode($this->materi->CurrentValue);
			$this->materi->EditValue = HtmlEncode($this->materi->CurrentValue);
			$this->materi->PlaceHolder = RemoveHtml($this->materi->caption());

			// instruktur
			$this->instruktur->EditAttrs["class"] = "form-control";
			$this->instruktur->EditCustomAttributes = "";
			if (!$this->instruktur->Raw)
				$this->instruktur->CurrentValue = HtmlDecode($this->instruktur->CurrentValue);
			$this->instruktur->EditValue = HtmlEncode($this->instruktur->CurrentValue);
			$this->instruktur->PlaceHolder = RemoveHtml($this->instruktur->caption());

			// instansi
			$this->instansi->EditAttrs["class"] = "form-control";
			$this->instansi->EditCustomAttributes = "";
			if (!$this->instansi->Raw)
				$this->instansi->CurrentValue = HtmlDecode($this->instansi->CurrentValue);
			$this->instansi->EditValue = HtmlEncode($this->instansi->CurrentValue);
			$this->instansi->PlaceHolder = RemoveHtml($this->instansi->caption());

			// ket
			$this->ket->EditAttrs["class"] = "form-control";
			$this->ket->EditCustomAttributes = "";
			if (!$this->ket->Raw)
				$this->ket->CurrentValue = HtmlDecode($this->ket->CurrentValue);
			$this->ket->EditValue = HtmlEncode($this->ket->CurrentValue);
			$this->ket->PlaceHolder = RemoveHtml($this->ket->caption());

			// Add refer script
			// idpelat

			$this->idpelat->LinkCustomAttributes = "";
			$this->idpelat->HrefValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";

			// jam
			$this->jam->LinkCustomAttributes = "";
			$this->jam->HrefValue = "";

			// jam_akhir
			$this->jam_akhir->LinkCustomAttributes = "";
			$this->jam_akhir->HrefValue = "";

			// materi
			$this->materi->LinkCustomAttributes = "";
			$this->materi->HrefValue = "";

			// instruktur
			$this->instruktur->LinkCustomAttributes = "";
			$this->instruktur->HrefValue = "";

			// instansi
			$this->instansi->LinkCustomAttributes = "";
			$this->instansi->HrefValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";
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
		if ($this->idpelat->Required) {
			if (!$this->idpelat->IsDetailKey && $this->idpelat->FormValue != NULL && $this->idpelat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idpelat->caption(), $this->idpelat->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->idpelat->FormValue)) {
			AddMessage($FormError, $this->idpelat->errorMessage());
		}
		if ($this->kdjudul->Required) {
			if (!$this->kdjudul->IsDetailKey && $this->kdjudul->FormValue != NULL && $this->kdjudul->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdjudul->caption(), $this->kdjudul->RequiredErrorMessage));
			}
		}
		if ($this->tgl->Required) {
			if (!$this->tgl->IsDetailKey && $this->tgl->FormValue != NULL && $this->tgl->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl->caption(), $this->tgl->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl->FormValue)) {
			AddMessage($FormError, $this->tgl->errorMessage());
		}
		if ($this->jam->Required) {
			if (!$this->jam->IsDetailKey && $this->jam->FormValue != NULL && $this->jam->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jam->caption(), $this->jam->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->jam->FormValue)) {
			AddMessage($FormError, $this->jam->errorMessage());
		}
		if ($this->jam_akhir->Required) {
			if (!$this->jam_akhir->IsDetailKey && $this->jam_akhir->FormValue != NULL && $this->jam_akhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jam_akhir->caption(), $this->jam_akhir->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->jam_akhir->FormValue)) {
			AddMessage($FormError, $this->jam_akhir->errorMessage());
		}
		if ($this->materi->Required) {
			if (!$this->materi->IsDetailKey && $this->materi->FormValue != NULL && $this->materi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->materi->caption(), $this->materi->RequiredErrorMessage));
			}
		}
		if ($this->instruktur->Required) {
			if (!$this->instruktur->IsDetailKey && $this->instruktur->FormValue != NULL && $this->instruktur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->instruktur->caption(), $this->instruktur->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->instruktur->FormValue)) {
			AddMessage($FormError, $this->instruktur->errorMessage());
		}
		if ($this->instansi->Required) {
			if (!$this->instansi->IsDetailKey && $this->instansi->FormValue != NULL && $this->instansi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->instansi->caption(), $this->instansi->RequiredErrorMessage));
			}
		}
		if ($this->ket->Required) {
			if (!$this->ket->IsDetailKey && $this->ket->FormValue != NULL && $this->ket->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ket->caption(), $this->ket->RequiredErrorMessage));
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

		// idpelat
		$this->idpelat->setDbValueDef($rsnew, $this->idpelat->CurrentValue, NULL, FALSE);

		// kdjudul
		$this->kdjudul->setDbValueDef($rsnew, $this->kdjudul->CurrentValue, NULL, FALSE);

		// tgl
		$this->tgl->setDbValueDef($rsnew, UnFormatDateTime($this->tgl->CurrentValue, 0), NULL, FALSE);

		// jam
		$this->jam->setDbValueDef($rsnew, $this->jam->CurrentValue, NULL, FALSE);

		// jam_akhir
		$this->jam_akhir->setDbValueDef($rsnew, $this->jam_akhir->CurrentValue, CurrentTime(), FALSE);

		// materi
		$this->materi->setDbValueDef($rsnew, $this->materi->CurrentValue, NULL, FALSE);

		// instruktur
		$this->instruktur->setDbValueDef($rsnew, $this->instruktur->CurrentValue, NULL, FALSE);

		// instansi
		$this->instansi->setDbValueDef($rsnew, $this->instansi->CurrentValue, NULL, FALSE);

		// ket
		$this->ket->setDbValueDef($rsnew, $this->ket->CurrentValue, NULL, FALSE);

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
			if ($masterTblVar == "webinar") {
				$validMaster = TRUE;
				if (($parm = Get("fk_rkwid", Get("idpelat"))) !== NULL) {
					$GLOBALS["webinar"]->rkwid->setQueryStringValue($parm);
					$this->idpelat->setQueryStringValue($GLOBALS["webinar"]->rkwid->QueryStringValue);
					$this->idpelat->setSessionValue($this->idpelat->QueryStringValue);
					if (!is_numeric($GLOBALS["webinar"]->rkwid->QueryStringValue))
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
			if ($masterTblVar == "webinar") {
				$validMaster = TRUE;
				if (($parm = Post("fk_rkwid", Post("idpelat"))) !== NULL) {
					$GLOBALS["webinar"]->rkwid->setFormValue($parm);
					$this->idpelat->setFormValue($GLOBALS["webinar"]->rkwid->FormValue);
					$this->idpelat->setSessionValue($this->idpelat->FormValue);
					if (!is_numeric($GLOBALS["webinar"]->rkwid->FormValue))
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
			if ($masterTblVar != "webinar") {
				if ($this->idpelat->CurrentValue == "")
					$this->idpelat->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_jadwalwebinarlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Set up multi pages
	protected function setupMultiPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add(0);
		$pages->add(1);
		$pages->add(2);
		$this->MultiPages = $pages;
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
				case "x_kurikulumid":
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
						case "x_kurikulumid":
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