<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_evaluasifas_add extends t_evaluasifas
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_evaluasifas';

	// Page object name
	public $PageObjName = "t_evaluasifas_add";

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

		// Table object (t_evaluasifas)
		if (!isset($GLOBALS["t_evaluasifas"]) || get_class($GLOBALS["t_evaluasifas"]) == PROJECT_NAMESPACE . "t_evaluasifas") {
			$GLOBALS["t_evaluasifas"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_evaluasifas"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (t_biointruktur)
		if (!isset($GLOBALS['t_biointruktur']))
			$GLOBALS['t_biointruktur'] = new t_biointruktur();

		// Table object (cv_jp)
		if (!isset($GLOBALS['cv_jp']))
			$GLOBALS['cv_jp'] = new cv_jp();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_evaluasifas');

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
		global $t_evaluasifas;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_evaluasifas);
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
					if ($pageName == "t_evaluasifasview.php")
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
			$key .= @$ar['evafas_id'];
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
			$this->evafas_id->Visible = FALSE;
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
					$this->terminate(GetUrl("t_evaluasifaslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->evafas_id->Visible = FALSE;
		$this->bioid->setVisibility();
		$this->idpelat->setVisibility();
		$this->kurikulumid->setVisibility();
		$this->nilai->setVisibility();
		$this->komentar->setVisibility();
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
		$this->setupLookupOptions($this->bioid);
		$this->setupLookupOptions($this->idpelat);
		$this->setupLookupOptions($this->kurikulumid);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_evaluasifaslist.php");
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
			if (Get("evafas_id") !== NULL) {
				$this->evafas_id->setQueryStringValue(Get("evafas_id"));
				$this->setKey("evafas_id", $this->evafas_id->CurrentValue); // Set up key
			} else {
				$this->setKey("evafas_id", ""); // Clear key
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
					$this->terminate("t_evaluasifaslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "t_evaluasifaslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_evaluasifasview.php")
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
		$this->evafas_id->CurrentValue = NULL;
		$this->evafas_id->OldValue = $this->evafas_id->CurrentValue;
		$this->bioid->CurrentValue = NULL;
		$this->bioid->OldValue = $this->bioid->CurrentValue;
		$this->idpelat->CurrentValue = NULL;
		$this->idpelat->OldValue = $this->idpelat->CurrentValue;
		$this->kurikulumid->CurrentValue = NULL;
		$this->kurikulumid->OldValue = $this->kurikulumid->CurrentValue;
		$this->nilai->CurrentValue = NULL;
		$this->nilai->OldValue = $this->nilai->CurrentValue;
		$this->komentar->CurrentValue = NULL;
		$this->komentar->OldValue = $this->komentar->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'bioid' first before field var 'x_bioid'
		$val = $CurrentForm->hasValue("bioid") ? $CurrentForm->getValue("bioid") : $CurrentForm->getValue("x_bioid");
		if (!$this->bioid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->bioid->Visible = FALSE; // Disable update for API request
			else
				$this->bioid->setFormValue($val);
		}

		// Check field name 'idpelat' first before field var 'x_idpelat'
		$val = $CurrentForm->hasValue("idpelat") ? $CurrentForm->getValue("idpelat") : $CurrentForm->getValue("x_idpelat");
		if (!$this->idpelat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idpelat->Visible = FALSE; // Disable update for API request
			else
				$this->idpelat->setFormValue($val);
		}

		// Check field name 'kurikulumid' first before field var 'x_kurikulumid'
		$val = $CurrentForm->hasValue("kurikulumid") ? $CurrentForm->getValue("kurikulumid") : $CurrentForm->getValue("x_kurikulumid");
		if (!$this->kurikulumid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kurikulumid->Visible = FALSE; // Disable update for API request
			else
				$this->kurikulumid->setFormValue($val);
		}

		// Check field name 'nilai' first before field var 'x_nilai'
		$val = $CurrentForm->hasValue("nilai") ? $CurrentForm->getValue("nilai") : $CurrentForm->getValue("x_nilai");
		if (!$this->nilai->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nilai->Visible = FALSE; // Disable update for API request
			else
				$this->nilai->setFormValue($val);
		}

		// Check field name 'komentar' first before field var 'x_komentar'
		$val = $CurrentForm->hasValue("komentar") ? $CurrentForm->getValue("komentar") : $CurrentForm->getValue("x_komentar");
		if (!$this->komentar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->komentar->Visible = FALSE; // Disable update for API request
			else
				$this->komentar->setFormValue($val);
		}

		// Check field name 'evafas_id' first before field var 'x_evafas_id'
		$val = $CurrentForm->hasValue("evafas_id") ? $CurrentForm->getValue("evafas_id") : $CurrentForm->getValue("x_evafas_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->bioid->CurrentValue = $this->bioid->FormValue;
		$this->idpelat->CurrentValue = $this->idpelat->FormValue;
		$this->kurikulumid->CurrentValue = $this->kurikulumid->FormValue;
		$this->nilai->CurrentValue = $this->nilai->FormValue;
		$this->komentar->CurrentValue = $this->komentar->FormValue;
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
		$this->evafas_id->setDbValue($row['evafas_id']);
		$this->bioid->setDbValue($row['bioid']);
		$this->idpelat->setDbValue($row['idpelat']);
		$this->kurikulumid->setDbValue($row['kurikulumid']);
		$this->nilai->setDbValue($row['nilai']);
		$this->komentar->setDbValue($row['komentar']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['evafas_id'] = $this->evafas_id->CurrentValue;
		$row['bioid'] = $this->bioid->CurrentValue;
		$row['idpelat'] = $this->idpelat->CurrentValue;
		$row['kurikulumid'] = $this->kurikulumid->CurrentValue;
		$row['nilai'] = $this->nilai->CurrentValue;
		$row['komentar'] = $this->komentar->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("evafas_id")) != "")
			$this->evafas_id->OldValue = $this->getKey("evafas_id"); // evafas_id
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
		// Convert decimal values if posted back

		if ($this->nilai->FormValue == $this->nilai->CurrentValue && is_numeric(ConvertToFloatString($this->nilai->CurrentValue)))
			$this->nilai->CurrentValue = ConvertToFloatString($this->nilai->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// evafas_id
		// bioid
		// idpelat
		// kurikulumid
		// nilai
		// komentar

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// bioid
			$this->bioid->ViewValue = $this->bioid->CurrentValue;
			$curVal = strval($this->bioid->CurrentValue);
			if ($curVal != "") {
				$this->bioid->ViewValue = $this->bioid->lookupCacheOption($curVal);
				if ($this->bioid->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`bioid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->bioid->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->bioid->ViewValue = $this->bioid->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->bioid->ViewValue = $this->bioid->CurrentValue;
					}
				}
			} else {
				$this->bioid->ViewValue = NULL;
			}
			$this->bioid->ViewCustomAttributes = "";

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
						$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 0);
						$arwrk[3] = FormatDateTime($rswrk->fields('df3'), 0);
						$arwrk[4] = $rswrk->fields('df4');
						$this->idpelat->ViewValue = $this->idpelat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
					}
				}
			} else {
				$this->idpelat->ViewValue = NULL;
			}
			$this->idpelat->ViewCustomAttributes = "width='200px'";

			// kurikulumid
			$curVal = strval($this->kurikulumid->CurrentValue);
			if ($curVal != "") {
				$this->kurikulumid->ViewValue = $this->kurikulumid->lookupCacheOption($curVal);
				if ($this->kurikulumid->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kurikulumid->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kurikulumid->ViewValue = $this->kurikulumid->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kurikulumid->ViewValue = $this->kurikulumid->CurrentValue;
					}
				}
			} else {
				$this->kurikulumid->ViewValue = NULL;
			}
			$this->kurikulumid->ViewCustomAttributes = "";

			// nilai
			$this->nilai->ViewValue = $this->nilai->CurrentValue;
			$this->nilai->ViewValue = FormatNumber($this->nilai->ViewValue, 2, -2, -2, -2);
			$this->nilai->ViewCustomAttributes = "";

			// komentar
			$this->komentar->ViewValue = $this->komentar->CurrentValue;
			$this->komentar->ViewCustomAttributes = "";

			// bioid
			$this->bioid->LinkCustomAttributes = "";
			$this->bioid->HrefValue = "";
			$this->bioid->TooltipValue = "";

			// idpelat
			$this->idpelat->LinkCustomAttributes = "";
			$this->idpelat->HrefValue = "";
			$this->idpelat->TooltipValue = "";

			// kurikulumid
			$this->kurikulumid->LinkCustomAttributes = "";
			$this->kurikulumid->HrefValue = "";
			$this->kurikulumid->TooltipValue = "";

			// nilai
			$this->nilai->LinkCustomAttributes = "";
			$this->nilai->HrefValue = "";
			$this->nilai->TooltipValue = "";

			// komentar
			$this->komentar->LinkCustomAttributes = "";
			$this->komentar->HrefValue = "";
			$this->komentar->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// bioid
			$this->bioid->EditAttrs["class"] = "form-control";
			$this->bioid->EditCustomAttributes = "";
			if ($this->bioid->getSessionValue() != "") {
				$this->bioid->CurrentValue = $this->bioid->getSessionValue();
				$this->bioid->ViewValue = $this->bioid->CurrentValue;
				$curVal = strval($this->bioid->CurrentValue);
				if ($curVal != "") {
					$this->bioid->ViewValue = $this->bioid->lookupCacheOption($curVal);
					if ($this->bioid->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`bioid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->bioid->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->bioid->ViewValue = $this->bioid->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->bioid->ViewValue = $this->bioid->CurrentValue;
						}
					}
				} else {
					$this->bioid->ViewValue = NULL;
				}
				$this->bioid->ViewCustomAttributes = "";
			} else {
				$this->bioid->EditValue = HtmlEncode($this->bioid->CurrentValue);
				$curVal = strval($this->bioid->CurrentValue);
				if ($curVal != "") {
					$this->bioid->EditValue = $this->bioid->lookupCacheOption($curVal);
					if ($this->bioid->EditValue === NULL) { // Lookup from database
						$filterWrk = "`bioid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->bioid->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->bioid->EditValue = $this->bioid->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->bioid->EditValue = HtmlEncode($this->bioid->CurrentValue);
						}
					}
				} else {
					$this->bioid->EditValue = NULL;
				}
				$this->bioid->PlaceHolder = RemoveHtml($this->bioid->caption());
			}

			// idpelat
			$this->idpelat->EditAttrs["class"] = "form-control";
			$this->idpelat->EditCustomAttributes = "width='100px'";
			if ($this->idpelat->getSessionValue() != "") {
				$this->idpelat->CurrentValue = $this->idpelat->getSessionValue();
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
							$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 0);
							$arwrk[3] = FormatDateTime($rswrk->fields('df3'), 0);
							$arwrk[4] = $rswrk->fields('df4');
							$this->idpelat->ViewValue = $this->idpelat->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
						}
					}
				} else {
					$this->idpelat->ViewValue = NULL;
				}
				$this->idpelat->ViewCustomAttributes = "width='200px'";
			} else {
				$curVal = trim(strval($this->idpelat->CurrentValue));
				if ($curVal != "")
					$this->idpelat->ViewValue = $this->idpelat->lookupCacheOption($curVal);
				else
					$this->idpelat->ViewValue = $this->idpelat->Lookup !== NULL && is_array($this->idpelat->Lookup->Options) ? $curVal : NULL;
				if ($this->idpelat->ViewValue !== NULL) { // Load from cache
					$this->idpelat->EditValue = array_values($this->idpelat->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`idpelat`" . SearchString("=", $this->idpelat->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->idpelat->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$rowcnt = count($arwrk);
					for ($i = 0; $i < $rowcnt; $i++) {
						$arwrk[$i][2] = FormatDateTime($arwrk[$i][2], 0);
						$arwrk[$i][3] = FormatDateTime($arwrk[$i][3], 0);
					}
					$this->idpelat->EditValue = $arwrk;
				}
			}

			// kurikulumid
			$this->kurikulumid->EditAttrs["class"] = "form-control";
			$this->kurikulumid->EditCustomAttributes = "";
			if ($this->kurikulumid->getSessionValue() != "") {
				$this->kurikulumid->CurrentValue = $this->kurikulumid->getSessionValue();
				$curVal = strval($this->kurikulumid->CurrentValue);
				if ($curVal != "") {
					$this->kurikulumid->ViewValue = $this->kurikulumid->lookupCacheOption($curVal);
					if ($this->kurikulumid->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->kurikulumid->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kurikulumid->ViewValue = $this->kurikulumid->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kurikulumid->ViewValue = $this->kurikulumid->CurrentValue;
						}
					}
				} else {
					$this->kurikulumid->ViewValue = NULL;
				}
				$this->kurikulumid->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->kurikulumid->CurrentValue));
				if ($curVal != "")
					$this->kurikulumid->ViewValue = $this->kurikulumid->lookupCacheOption($curVal);
				else
					$this->kurikulumid->ViewValue = $this->kurikulumid->Lookup !== NULL && is_array($this->kurikulumid->Lookup->Options) ? $curVal : NULL;
				if ($this->kurikulumid->ViewValue !== NULL) { // Load from cache
					$this->kurikulumid->EditValue = array_values($this->kurikulumid->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`kurikulumid`" . SearchString("=", $this->kurikulumid->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->kurikulumid->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->kurikulumid->EditValue = $arwrk;
				}
			}

			// nilai
			$this->nilai->EditAttrs["class"] = "form-control";
			$this->nilai->EditCustomAttributes = "";
			$this->nilai->EditValue = HtmlEncode($this->nilai->CurrentValue);
			$this->nilai->PlaceHolder = RemoveHtml($this->nilai->caption());
			if (strval($this->nilai->EditValue) != "" && is_numeric($this->nilai->EditValue))
				$this->nilai->EditValue = FormatNumber($this->nilai->EditValue, -2, -2, -2, -2);
			

			// komentar
			$this->komentar->EditAttrs["class"] = "form-control";
			$this->komentar->EditCustomAttributes = "";
			$this->komentar->EditValue = HtmlEncode($this->komentar->CurrentValue);
			$this->komentar->PlaceHolder = RemoveHtml($this->komentar->caption());

			// Add refer script
			// bioid

			$this->bioid->LinkCustomAttributes = "";
			$this->bioid->HrefValue = "";

			// idpelat
			$this->idpelat->LinkCustomAttributes = "";
			$this->idpelat->HrefValue = "";

			// kurikulumid
			$this->kurikulumid->LinkCustomAttributes = "";
			$this->kurikulumid->HrefValue = "";

			// nilai
			$this->nilai->LinkCustomAttributes = "";
			$this->nilai->HrefValue = "";

			// komentar
			$this->komentar->LinkCustomAttributes = "";
			$this->komentar->HrefValue = "";
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
		if ($this->bioid->Required) {
			if (!$this->bioid->IsDetailKey && $this->bioid->FormValue != NULL && $this->bioid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bioid->caption(), $this->bioid->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->bioid->FormValue)) {
			AddMessage($FormError, $this->bioid->errorMessage());
		}
		if ($this->idpelat->Required) {
			if (!$this->idpelat->IsDetailKey && $this->idpelat->FormValue != NULL && $this->idpelat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idpelat->caption(), $this->idpelat->RequiredErrorMessage));
			}
		}
		if ($this->kurikulumid->Required) {
			if (!$this->kurikulumid->IsDetailKey && $this->kurikulumid->FormValue != NULL && $this->kurikulumid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kurikulumid->caption(), $this->kurikulumid->RequiredErrorMessage));
			}
		}
		if ($this->nilai->Required) {
			if (!$this->nilai->IsDetailKey && $this->nilai->FormValue != NULL && $this->nilai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nilai->caption(), $this->nilai->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->nilai->FormValue)) {
			AddMessage($FormError, $this->nilai->errorMessage());
		}
		if ($this->komentar->Required) {
			if (!$this->komentar->IsDetailKey && $this->komentar->FormValue != NULL && $this->komentar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->komentar->caption(), $this->komentar->RequiredErrorMessage));
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

		// Check referential integrity for master table 't_evaluasifas'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_biointruktur();
		if (strval($this->bioid->CurrentValue) != "") {
			$masterFilter = str_replace("@bioid@", AdjustSql($this->bioid->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_biointruktur"]))
				$GLOBALS["t_biointruktur"] = new t_biointruktur();
			$rsmaster = $GLOBALS["t_biointruktur"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_biointruktur", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}

		// Check referential integrity for master table 't_evaluasifas'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_cv_jp();
		if (strval($this->bioid->CurrentValue) != "") {
			$masterFilter = str_replace("@bioid@", AdjustSql($this->bioid->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->idpelat->CurrentValue) != "") {
			$masterFilter = str_replace("@idpelat@", AdjustSql($this->idpelat->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->kurikulumid->CurrentValue) != "") {
			$masterFilter = str_replace("@kurikulumid@", AdjustSql($this->kurikulumid->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["cv_jp"]))
				$GLOBALS["cv_jp"] = new cv_jp();
			$rsmaster = $GLOBALS["cv_jp"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "cv_jp", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// bioid
		$this->bioid->setDbValueDef($rsnew, $this->bioid->CurrentValue, 0, FALSE);

		// idpelat
		$this->idpelat->setDbValueDef($rsnew, $this->idpelat->CurrentValue, 0, FALSE);

		// kurikulumid
		$this->kurikulumid->setDbValueDef($rsnew, $this->kurikulumid->CurrentValue, 0, FALSE);

		// nilai
		$this->nilai->setDbValueDef($rsnew, $this->nilai->CurrentValue, NULL, FALSE);

		// komentar
		$this->komentar->setDbValueDef($rsnew, $this->komentar->CurrentValue, NULL, FALSE);

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
			if ($masterTblVar == "t_biointruktur") {
				$validMaster = TRUE;
				if (($parm = Get("fk_bioid", Get("bioid"))) !== NULL) {
					$GLOBALS["t_biointruktur"]->bioid->setQueryStringValue($parm);
					$this->bioid->setQueryStringValue($GLOBALS["t_biointruktur"]->bioid->QueryStringValue);
					$this->bioid->setSessionValue($this->bioid->QueryStringValue);
					if (!is_numeric($GLOBALS["t_biointruktur"]->bioid->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "cv_jp") {
				$validMaster = TRUE;
				if (($parm = Get("fk_bioid", Get("bioid"))) !== NULL) {
					$GLOBALS["cv_jp"]->bioid->setQueryStringValue($parm);
					$this->bioid->setQueryStringValue($GLOBALS["cv_jp"]->bioid->QueryStringValue);
					$this->bioid->setSessionValue($this->bioid->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_idpelat", Get("idpelat"))) !== NULL) {
					$GLOBALS["cv_jp"]->idpelat->setQueryStringValue($parm);
					$this->idpelat->setQueryStringValue($GLOBALS["cv_jp"]->idpelat->QueryStringValue);
					$this->idpelat->setSessionValue($this->idpelat->QueryStringValue);
					if (!is_numeric($GLOBALS["cv_jp"]->idpelat->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_kurikulumid", Get("kurikulumid"))) !== NULL) {
					$GLOBALS["cv_jp"]->kurikulumid->setQueryStringValue($parm);
					$this->kurikulumid->setQueryStringValue($GLOBALS["cv_jp"]->kurikulumid->QueryStringValue);
					$this->kurikulumid->setSessionValue($this->kurikulumid->QueryStringValue);
					if (!is_numeric($GLOBALS["cv_jp"]->kurikulumid->QueryStringValue))
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
			if ($masterTblVar == "t_biointruktur") {
				$validMaster = TRUE;
				if (($parm = Post("fk_bioid", Post("bioid"))) !== NULL) {
					$GLOBALS["t_biointruktur"]->bioid->setFormValue($parm);
					$this->bioid->setFormValue($GLOBALS["t_biointruktur"]->bioid->FormValue);
					$this->bioid->setSessionValue($this->bioid->FormValue);
					if (!is_numeric($GLOBALS["t_biointruktur"]->bioid->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "cv_jp") {
				$validMaster = TRUE;
				if (($parm = Post("fk_bioid", Post("bioid"))) !== NULL) {
					$GLOBALS["cv_jp"]->bioid->setFormValue($parm);
					$this->bioid->setFormValue($GLOBALS["cv_jp"]->bioid->FormValue);
					$this->bioid->setSessionValue($this->bioid->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_idpelat", Post("idpelat"))) !== NULL) {
					$GLOBALS["cv_jp"]->idpelat->setFormValue($parm);
					$this->idpelat->setFormValue($GLOBALS["cv_jp"]->idpelat->FormValue);
					$this->idpelat->setSessionValue($this->idpelat->FormValue);
					if (!is_numeric($GLOBALS["cv_jp"]->idpelat->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_kurikulumid", Post("kurikulumid"))) !== NULL) {
					$GLOBALS["cv_jp"]->kurikulumid->setFormValue($parm);
					$this->kurikulumid->setFormValue($GLOBALS["cv_jp"]->kurikulumid->FormValue);
					$this->kurikulumid->setSessionValue($this->kurikulumid->FormValue);
					if (!is_numeric($GLOBALS["cv_jp"]->kurikulumid->FormValue))
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
			if ($masterTblVar != "t_biointruktur") {
				if ($this->bioid->CurrentValue == "")
					$this->bioid->setSessionValue("");
			}
			if ($masterTblVar != "cv_jp") {
				if ($this->bioid->CurrentValue == "")
					$this->bioid->setSessionValue("");
				if ($this->idpelat->CurrentValue == "")
					$this->idpelat->setSessionValue("");
				if ($this->kurikulumid->CurrentValue == "")
					$this->kurikulumid->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_evaluasifaslist.php"), "", $this->TableVar, TRUE);
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
				case "x_bioid":
					break;
				case "x_idpelat":
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
						case "x_bioid":
							break;
						case "x_idpelat":
							$row[2] = FormatDateTime($row[2], 0);
							$row['df2'] = $row[2];
							$row[3] = FormatDateTime($row[3], 0);
							$row['df3'] = $row[3];
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