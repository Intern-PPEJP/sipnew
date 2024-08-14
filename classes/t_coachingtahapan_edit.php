<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_coachingtahapan_edit extends t_coachingtahapan
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_coachingtahapan';

	// Page object name
	public $PageObjName = "t_coachingtahapan_edit";

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

		// Table object (t_coachingtahapan)
		if (!isset($GLOBALS["t_coachingtahapan"]) || get_class($GLOBALS["t_coachingtahapan"]) == PROJECT_NAMESPACE . "t_coachingtahapan") {
			$GLOBALS["t_coachingtahapan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_coachingtahapan"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (t_rkcoaching)
		if (!isset($GLOBALS['t_rkcoaching']))
			$GLOBALS['t_rkcoaching'] = new t_rkcoaching();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_coachingtahapan');

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
		global $t_coachingtahapan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_coachingtahapan);
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
					if ($pageName == "t_coachingtahapanview.php")
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
			$key .= @$ar['ctid'];
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
			$this->ctid->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
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
			if (!$Security->canEdit()) {
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_coachingtahapanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ctid->Visible = FALSE;
		$this->rkid->Visible = FALSE;
		$this->area->setVisibility();
		$this->jenispel->setVisibility();
		$this->kdkategori->setVisibility();
		$this->kerjasama->setVisibility();
		$this->tglpelak1->setVisibility();
		$this->targetpes1->setVisibility();
		$this->tglpelak2->setVisibility();
		$this->targetpes2->setVisibility();
		$this->tglpelak3->setVisibility();
		$this->targetpes3->setVisibility();
		$this->tglpelak4->setVisibility();
		$this->targetpes4->setVisibility();
		$this->tglpelak5->setVisibility();
		$this->targetpes5->setVisibility();
		$this->tglpelak6->setVisibility();
		$this->targetpes6->setVisibility();
		$this->tglpelak7->setVisibility();
		$this->targetpes7->setVisibility();
		$this->tglpelak8->setVisibility();
		$this->targetpes8->setVisibility();
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
		$this->setupLookupOptions($this->area);
		$this->setupLookupOptions($this->kdkategori);
		$this->setupLookupOptions($this->kerjasama);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_coachingtahapanlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("ctid") !== NULL) {
				$this->ctid->setQueryStringValue(Get("ctid"));
				$this->ctid->setOldValue($this->ctid->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->ctid->setQueryStringValue(Key(0));
				$this->ctid->setOldValue($this->ctid->QueryStringValue);
			} elseif (Post("ctid") !== NULL) {
				$this->ctid->setFormValue(Post("ctid"));
				$this->ctid->setOldValue($this->ctid->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->ctid->setQueryStringValue(Route(2));
				$this->ctid->setOldValue($this->ctid->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_ctid")) {
					$this->ctid->setFormValue($CurrentForm->getValue("x_ctid"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("ctid") !== NULL) {
					$this->ctid->setQueryStringValue(Get("ctid"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->ctid->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->ctid->CurrentValue = NULL;
				}
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("t_coachingtahapanlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_coachingtahapanlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'area' first before field var 'x_area'
		$val = $CurrentForm->hasValue("area") ? $CurrentForm->getValue("area") : $CurrentForm->getValue("x_area");
		if (!$this->area->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->area->Visible = FALSE; // Disable update for API request
			else
				$this->area->setFormValue($val);
		}

		// Check field name 'jenispel' first before field var 'x_jenispel'
		$val = $CurrentForm->hasValue("jenispel") ? $CurrentForm->getValue("jenispel") : $CurrentForm->getValue("x_jenispel");
		if (!$this->jenispel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenispel->Visible = FALSE; // Disable update for API request
			else
				$this->jenispel->setFormValue($val);
		}

		// Check field name 'kdkategori' first before field var 'x_kdkategori'
		$val = $CurrentForm->hasValue("kdkategori") ? $CurrentForm->getValue("kdkategori") : $CurrentForm->getValue("x_kdkategori");
		if (!$this->kdkategori->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkategori->Visible = FALSE; // Disable update for API request
			else
				$this->kdkategori->setFormValue($val);
		}

		// Check field name 'kerjasama' first before field var 'x_kerjasama'
		$val = $CurrentForm->hasValue("kerjasama") ? $CurrentForm->getValue("kerjasama") : $CurrentForm->getValue("x_kerjasama");
		if (!$this->kerjasama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kerjasama->Visible = FALSE; // Disable update for API request
			else
				$this->kerjasama->setFormValue($val);
		}

		// Check field name 'tglpelak1' first before field var 'x_tglpelak1'
		$val = $CurrentForm->hasValue("tglpelak1") ? $CurrentForm->getValue("tglpelak1") : $CurrentForm->getValue("x_tglpelak1");
		if (!$this->tglpelak1->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak1->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak1->setFormValue($val);
		}

		// Check field name 'targetpes1' first before field var 'x_targetpes1'
		$val = $CurrentForm->hasValue("targetpes1") ? $CurrentForm->getValue("targetpes1") : $CurrentForm->getValue("x_targetpes1");
		if (!$this->targetpes1->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes1->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes1->setFormValue($val);
		}

		// Check field name 'tglpelak2' first before field var 'x_tglpelak2'
		$val = $CurrentForm->hasValue("tglpelak2") ? $CurrentForm->getValue("tglpelak2") : $CurrentForm->getValue("x_tglpelak2");
		if (!$this->tglpelak2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak2->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak2->setFormValue($val);
		}

		// Check field name 'targetpes2' first before field var 'x_targetpes2'
		$val = $CurrentForm->hasValue("targetpes2") ? $CurrentForm->getValue("targetpes2") : $CurrentForm->getValue("x_targetpes2");
		if (!$this->targetpes2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes2->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes2->setFormValue($val);
		}

		// Check field name 'tglpelak3' first before field var 'x_tglpelak3'
		$val = $CurrentForm->hasValue("tglpelak3") ? $CurrentForm->getValue("tglpelak3") : $CurrentForm->getValue("x_tglpelak3");
		if (!$this->tglpelak3->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak3->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak3->setFormValue($val);
		}

		// Check field name 'targetpes3' first before field var 'x_targetpes3'
		$val = $CurrentForm->hasValue("targetpes3") ? $CurrentForm->getValue("targetpes3") : $CurrentForm->getValue("x_targetpes3");
		if (!$this->targetpes3->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes3->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes3->setFormValue($val);
		}

		// Check field name 'tglpelak4' first before field var 'x_tglpelak4'
		$val = $CurrentForm->hasValue("tglpelak4") ? $CurrentForm->getValue("tglpelak4") : $CurrentForm->getValue("x_tglpelak4");
		if (!$this->tglpelak4->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak4->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak4->setFormValue($val);
		}

		// Check field name 'targetpes4' first before field var 'x_targetpes4'
		$val = $CurrentForm->hasValue("targetpes4") ? $CurrentForm->getValue("targetpes4") : $CurrentForm->getValue("x_targetpes4");
		if (!$this->targetpes4->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes4->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes4->setFormValue($val);
		}

		// Check field name 'tglpelak5' first before field var 'x_tglpelak5'
		$val = $CurrentForm->hasValue("tglpelak5") ? $CurrentForm->getValue("tglpelak5") : $CurrentForm->getValue("x_tglpelak5");
		if (!$this->tglpelak5->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak5->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak5->setFormValue($val);
		}

		// Check field name 'targetpes5' first before field var 'x_targetpes5'
		$val = $CurrentForm->hasValue("targetpes5") ? $CurrentForm->getValue("targetpes5") : $CurrentForm->getValue("x_targetpes5");
		if (!$this->targetpes5->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes5->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes5->setFormValue($val);
		}

		// Check field name 'tglpelak6' first before field var 'x_tglpelak6'
		$val = $CurrentForm->hasValue("tglpelak6") ? $CurrentForm->getValue("tglpelak6") : $CurrentForm->getValue("x_tglpelak6");
		if (!$this->tglpelak6->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak6->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak6->setFormValue($val);
		}

		// Check field name 'targetpes6' first before field var 'x_targetpes6'
		$val = $CurrentForm->hasValue("targetpes6") ? $CurrentForm->getValue("targetpes6") : $CurrentForm->getValue("x_targetpes6");
		if (!$this->targetpes6->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes6->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes6->setFormValue($val);
		}

		// Check field name 'tglpelak7' first before field var 'x_tglpelak7'
		$val = $CurrentForm->hasValue("tglpelak7") ? $CurrentForm->getValue("tglpelak7") : $CurrentForm->getValue("x_tglpelak7");
		if (!$this->tglpelak7->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak7->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak7->setFormValue($val);
		}

		// Check field name 'targetpes7' first before field var 'x_targetpes7'
		$val = $CurrentForm->hasValue("targetpes7") ? $CurrentForm->getValue("targetpes7") : $CurrentForm->getValue("x_targetpes7");
		if (!$this->targetpes7->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes7->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes7->setFormValue($val);
		}

		// Check field name 'tglpelak8' first before field var 'x_tglpelak8'
		$val = $CurrentForm->hasValue("tglpelak8") ? $CurrentForm->getValue("tglpelak8") : $CurrentForm->getValue("x_tglpelak8");
		if (!$this->tglpelak8->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpelak8->Visible = FALSE; // Disable update for API request
			else
				$this->tglpelak8->setFormValue($val);
		}

		// Check field name 'targetpes8' first before field var 'x_targetpes8'
		$val = $CurrentForm->hasValue("targetpes8") ? $CurrentForm->getValue("targetpes8") : $CurrentForm->getValue("x_targetpes8");
		if (!$this->targetpes8->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes8->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes8->setFormValue($val);
		}

		// Check field name 'ctid' first before field var 'x_ctid'
		$val = $CurrentForm->hasValue("ctid") ? $CurrentForm->getValue("ctid") : $CurrentForm->getValue("x_ctid");
		if (!$this->ctid->IsDetailKey)
			$this->ctid->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ctid->CurrentValue = $this->ctid->FormValue;
		$this->area->CurrentValue = $this->area->FormValue;
		$this->jenispel->CurrentValue = $this->jenispel->FormValue;
		$this->kdkategori->CurrentValue = $this->kdkategori->FormValue;
		$this->kerjasama->CurrentValue = $this->kerjasama->FormValue;
		$this->tglpelak1->CurrentValue = $this->tglpelak1->FormValue;
		$this->targetpes1->CurrentValue = $this->targetpes1->FormValue;
		$this->tglpelak2->CurrentValue = $this->tglpelak2->FormValue;
		$this->targetpes2->CurrentValue = $this->targetpes2->FormValue;
		$this->tglpelak3->CurrentValue = $this->tglpelak3->FormValue;
		$this->targetpes3->CurrentValue = $this->targetpes3->FormValue;
		$this->tglpelak4->CurrentValue = $this->tglpelak4->FormValue;
		$this->targetpes4->CurrentValue = $this->targetpes4->FormValue;
		$this->tglpelak5->CurrentValue = $this->tglpelak5->FormValue;
		$this->targetpes5->CurrentValue = $this->targetpes5->FormValue;
		$this->tglpelak6->CurrentValue = $this->tglpelak6->FormValue;
		$this->targetpes6->CurrentValue = $this->targetpes6->FormValue;
		$this->tglpelak7->CurrentValue = $this->tglpelak7->FormValue;
		$this->targetpes7->CurrentValue = $this->targetpes7->FormValue;
		$this->tglpelak8->CurrentValue = $this->tglpelak8->FormValue;
		$this->targetpes8->CurrentValue = $this->targetpes8->FormValue;
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
		$this->ctid->setDbValue($row['ctid']);
		$this->rkid->setDbValue($row['rkid']);
		$this->area->setDbValue($row['area']);
		if (array_key_exists('EV__area', $rs->fields)) {
			$this->area->VirtualValue = $rs->fields('EV__area'); // Set up virtual field value
		} else {
			$this->area->VirtualValue = ""; // Clear value
		}
		$this->jenispel->setDbValue($row['jenispel']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->kerjasama->setDbValue($row['kerjasama']);
		$this->tglpelak1->setDbValue($row['tglpelak1']);
		$this->targetpes1->setDbValue($row['targetpes1']);
		$this->tglpelak2->setDbValue($row['tglpelak2']);
		$this->targetpes2->setDbValue($row['targetpes2']);
		$this->tglpelak3->setDbValue($row['tglpelak3']);
		$this->targetpes3->setDbValue($row['targetpes3']);
		$this->tglpelak4->setDbValue($row['tglpelak4']);
		$this->targetpes4->setDbValue($row['targetpes4']);
		$this->tglpelak5->setDbValue($row['tglpelak5']);
		$this->targetpes5->setDbValue($row['targetpes5']);
		$this->tglpelak6->setDbValue($row['tglpelak6']);
		$this->targetpes6->setDbValue($row['targetpes6']);
		$this->tglpelak7->setDbValue($row['tglpelak7']);
		$this->targetpes7->setDbValue($row['targetpes7']);
		$this->tglpelak8->setDbValue($row['tglpelak8']);
		$this->targetpes8->setDbValue($row['targetpes8']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ctid'] = NULL;
		$row['rkid'] = NULL;
		$row['area'] = NULL;
		$row['jenispel'] = NULL;
		$row['kdkategori'] = NULL;
		$row['kerjasama'] = NULL;
		$row['tglpelak1'] = NULL;
		$row['targetpes1'] = NULL;
		$row['tglpelak2'] = NULL;
		$row['targetpes2'] = NULL;
		$row['tglpelak3'] = NULL;
		$row['targetpes3'] = NULL;
		$row['tglpelak4'] = NULL;
		$row['targetpes4'] = NULL;
		$row['tglpelak5'] = NULL;
		$row['targetpes5'] = NULL;
		$row['tglpelak6'] = NULL;
		$row['targetpes6'] = NULL;
		$row['tglpelak7'] = NULL;
		$row['targetpes7'] = NULL;
		$row['tglpelak8'] = NULL;
		$row['targetpes8'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ctid")) != "")
			$this->ctid->OldValue = $this->getKey("ctid"); // ctid
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
		// ctid
		// rkid
		// area
		// jenispel
		// kdkategori
		// kerjasama
		// tglpelak1
		// targetpes1
		// tglpelak2
		// targetpes2
		// tglpelak3
		// targetpes3
		// tglpelak4
		// targetpes4
		// tglpelak5
		// targetpes5
		// tglpelak6
		// targetpes6
		// tglpelak7
		// targetpes7
		// tglpelak8
		// targetpes8

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// area
			if ($this->area->VirtualValue != "") {
				$this->area->ViewValue = $this->area->VirtualValue;
			} else {
				$curVal = strval($this->area->CurrentValue);
				if ($curVal != "") {
					$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
					if ($this->area->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->area->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->area->ViewValue = $this->area->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->area->ViewValue = $this->area->CurrentValue;
						}
					}
				} else {
					$this->area->ViewValue = NULL;
				}
			}
			$this->area->ViewCustomAttributes = "";

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

			// tglpelak1
			$this->tglpelak1->ViewValue = $this->tglpelak1->CurrentValue;
			$this->tglpelak1->ViewCustomAttributes = "";

			// targetpes1
			$this->targetpes1->ViewValue = $this->targetpes1->CurrentValue;
			$this->targetpes1->ViewCustomAttributes = "";

			// tglpelak2
			$this->tglpelak2->ViewValue = $this->tglpelak2->CurrentValue;
			$this->tglpelak2->ViewCustomAttributes = "";

			// targetpes2
			$this->targetpes2->ViewValue = $this->targetpes2->CurrentValue;
			$this->targetpes2->ViewCustomAttributes = "";

			// tglpelak3
			$this->tglpelak3->ViewValue = $this->tglpelak3->CurrentValue;
			$this->tglpelak3->ViewCustomAttributes = "";

			// targetpes3
			$this->targetpes3->ViewValue = $this->targetpes3->CurrentValue;
			$this->targetpes3->ViewCustomAttributes = "";

			// tglpelak4
			$this->tglpelak4->ViewValue = $this->tglpelak4->CurrentValue;
			$this->tglpelak4->ViewCustomAttributes = "";

			// targetpes4
			$this->targetpes4->ViewValue = $this->targetpes4->CurrentValue;
			$this->targetpes4->ViewCustomAttributes = "";

			// tglpelak5
			$this->tglpelak5->ViewValue = $this->tglpelak5->CurrentValue;
			$this->tglpelak5->ViewCustomAttributes = "";

			// targetpes5
			$this->targetpes5->ViewValue = $this->targetpes5->CurrentValue;
			$this->targetpes5->ViewCustomAttributes = "";

			// tglpelak6
			$this->tglpelak6->ViewValue = $this->tglpelak6->CurrentValue;
			$this->tglpelak6->ViewCustomAttributes = "";

			// targetpes6
			$this->targetpes6->ViewValue = $this->targetpes6->CurrentValue;
			$this->targetpes6->ViewCustomAttributes = "";

			// tglpelak7
			$this->tglpelak7->ViewValue = $this->tglpelak7->CurrentValue;
			$this->tglpelak7->ViewCustomAttributes = "";

			// targetpes7
			$this->targetpes7->ViewValue = $this->targetpes7->CurrentValue;
			$this->targetpes7->ViewCustomAttributes = "";

			// tglpelak8
			$this->tglpelak8->ViewValue = $this->tglpelak8->CurrentValue;
			$this->tglpelak8->ViewCustomAttributes = "";

			// targetpes8
			$this->targetpes8->ViewValue = $this->targetpes8->CurrentValue;
			$this->targetpes8->ViewCustomAttributes = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";
			$this->area->TooltipValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";
			$this->jenispel->TooltipValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";
			$this->kdkategori->TooltipValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";
			$this->kerjasama->TooltipValue = "";

			// tglpelak1
			$this->tglpelak1->LinkCustomAttributes = "";
			$this->tglpelak1->HrefValue = "";
			$this->tglpelak1->TooltipValue = "";

			// targetpes1
			$this->targetpes1->LinkCustomAttributes = "";
			$this->targetpes1->HrefValue = "";
			$this->targetpes1->TooltipValue = "";

			// tglpelak2
			$this->tglpelak2->LinkCustomAttributes = "";
			$this->tglpelak2->HrefValue = "";
			$this->tglpelak2->TooltipValue = "";

			// targetpes2
			$this->targetpes2->LinkCustomAttributes = "";
			$this->targetpes2->HrefValue = "";
			$this->targetpes2->TooltipValue = "";

			// tglpelak3
			$this->tglpelak3->LinkCustomAttributes = "";
			$this->tglpelak3->HrefValue = "";
			$this->tglpelak3->TooltipValue = "";

			// targetpes3
			$this->targetpes3->LinkCustomAttributes = "";
			$this->targetpes3->HrefValue = "";
			$this->targetpes3->TooltipValue = "";

			// tglpelak4
			$this->tglpelak4->LinkCustomAttributes = "";
			$this->tglpelak4->HrefValue = "";
			$this->tglpelak4->TooltipValue = "";

			// targetpes4
			$this->targetpes4->LinkCustomAttributes = "";
			$this->targetpes4->HrefValue = "";
			$this->targetpes4->TooltipValue = "";

			// tglpelak5
			$this->tglpelak5->LinkCustomAttributes = "";
			$this->tglpelak5->HrefValue = "";
			$this->tglpelak5->TooltipValue = "";

			// targetpes5
			$this->targetpes5->LinkCustomAttributes = "";
			$this->targetpes5->HrefValue = "";
			$this->targetpes5->TooltipValue = "";

			// tglpelak6
			$this->tglpelak6->LinkCustomAttributes = "";
			$this->tglpelak6->HrefValue = "";
			$this->tglpelak6->TooltipValue = "";

			// targetpes6
			$this->targetpes6->LinkCustomAttributes = "";
			$this->targetpes6->HrefValue = "";
			$this->targetpes6->TooltipValue = "";

			// tglpelak7
			$this->tglpelak7->LinkCustomAttributes = "";
			$this->tglpelak7->HrefValue = "";
			$this->tglpelak7->TooltipValue = "";

			// targetpes7
			$this->targetpes7->LinkCustomAttributes = "";
			$this->targetpes7->HrefValue = "";
			$this->targetpes7->TooltipValue = "";

			// tglpelak8
			$this->tglpelak8->LinkCustomAttributes = "";
			$this->tglpelak8->HrefValue = "";
			$this->tglpelak8->TooltipValue = "";

			// targetpes8
			$this->targetpes8->LinkCustomAttributes = "";
			$this->targetpes8->HrefValue = "";
			$this->targetpes8->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// area
			$this->area->EditAttrs["class"] = "form-control";
			$this->area->EditCustomAttributes = "";
			if ($this->area->getSessionValue() != "") {
				$this->area->CurrentValue = $this->area->getSessionValue();
				if ($this->area->VirtualValue != "") {
					$this->area->ViewValue = $this->area->VirtualValue;
				} else {
					$curVal = strval($this->area->CurrentValue);
					if ($curVal != "") {
						$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
						if ($this->area->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->area->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$arwrk[2] = $rswrk->fields('df2');
								$this->area->ViewValue = $this->area->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->area->ViewValue = $this->area->CurrentValue;
							}
						}
					} else {
						$this->area->ViewValue = NULL;
					}
				}
				$this->area->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->area->CurrentValue));
				if ($curVal != "")
					$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
				else
					$this->area->ViewValue = $this->area->Lookup !== NULL && is_array($this->area->Lookup->Options) ? $curVal : NULL;
				if ($this->area->ViewValue !== NULL) { // Load from cache
					$this->area->EditValue = array_values($this->area->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`areaid`" . SearchString("=", $this->area->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->area->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->area->EditValue = $arwrk;
				}
			}

			// jenispel
			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			$this->jenispel->EditValue = $this->jenispel->options(TRUE);

			// kdkategori
			$this->kdkategori->EditAttrs["class"] = "form-control";
			$this->kdkategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkategori->CurrentValue));
			if ($curVal != "")
				$this->kdkategori->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
			else
				$this->kdkategori->ViewValue = $this->kdkategori->Lookup !== NULL && is_array($this->kdkategori->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkategori->ViewValue !== NULL) { // Load from cache
				$this->kdkategori->EditValue = array_values($this->kdkategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkategori`" . SearchString("=", $this->kdkategori->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkategori->EditValue = $arwrk;
			}

			// kerjasama
			$this->kerjasama->EditAttrs["class"] = "form-control";
			$this->kerjasama->EditCustomAttributes = "";
			$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->CurrentValue);
			$curVal = strval($this->kerjasama->CurrentValue);
			if ($curVal != "") {
				$this->kerjasama->EditValue = $this->kerjasama->lookupCacheOption($curVal);
				if ($this->kerjasama->EditValue === NULL) { // Lookup from database
					$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kerjasama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kerjasama->EditValue = $this->kerjasama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->CurrentValue);
					}
				}
			} else {
				$this->kerjasama->EditValue = NULL;
			}
			$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

			// tglpelak1
			$this->tglpelak1->EditAttrs["class"] = "form-control";
			$this->tglpelak1->EditCustomAttributes = "";
			if (!$this->tglpelak1->Raw)
				$this->tglpelak1->CurrentValue = HtmlDecode($this->tglpelak1->CurrentValue);
			$this->tglpelak1->EditValue = HtmlEncode($this->tglpelak1->CurrentValue);
			$this->tglpelak1->PlaceHolder = RemoveHtml($this->tglpelak1->caption());

			// targetpes1
			$this->targetpes1->EditAttrs["class"] = "form-control";
			$this->targetpes1->EditCustomAttributes = "";
			$this->targetpes1->EditValue = HtmlEncode($this->targetpes1->CurrentValue);
			$this->targetpes1->PlaceHolder = RemoveHtml($this->targetpes1->caption());

			// tglpelak2
			$this->tglpelak2->EditAttrs["class"] = "form-control";
			$this->tglpelak2->EditCustomAttributes = "";
			if (!$this->tglpelak2->Raw)
				$this->tglpelak2->CurrentValue = HtmlDecode($this->tglpelak2->CurrentValue);
			$this->tglpelak2->EditValue = HtmlEncode($this->tglpelak2->CurrentValue);
			$this->tglpelak2->PlaceHolder = RemoveHtml($this->tglpelak2->caption());

			// targetpes2
			$this->targetpes2->EditAttrs["class"] = "form-control";
			$this->targetpes2->EditCustomAttributes = "";
			$this->targetpes2->EditValue = HtmlEncode($this->targetpes2->CurrentValue);
			$this->targetpes2->PlaceHolder = RemoveHtml($this->targetpes2->caption());

			// tglpelak3
			$this->tglpelak3->EditAttrs["class"] = "form-control";
			$this->tglpelak3->EditCustomAttributes = "";
			if (!$this->tglpelak3->Raw)
				$this->tglpelak3->CurrentValue = HtmlDecode($this->tglpelak3->CurrentValue);
			$this->tglpelak3->EditValue = HtmlEncode($this->tglpelak3->CurrentValue);
			$this->tglpelak3->PlaceHolder = RemoveHtml($this->tglpelak3->caption());

			// targetpes3
			$this->targetpes3->EditAttrs["class"] = "form-control";
			$this->targetpes3->EditCustomAttributes = "";
			$this->targetpes3->EditValue = HtmlEncode($this->targetpes3->CurrentValue);
			$this->targetpes3->PlaceHolder = RemoveHtml($this->targetpes3->caption());

			// tglpelak4
			$this->tglpelak4->EditAttrs["class"] = "form-control";
			$this->tglpelak4->EditCustomAttributes = "";
			if (!$this->tglpelak4->Raw)
				$this->tglpelak4->CurrentValue = HtmlDecode($this->tglpelak4->CurrentValue);
			$this->tglpelak4->EditValue = HtmlEncode($this->tglpelak4->CurrentValue);
			$this->tglpelak4->PlaceHolder = RemoveHtml($this->tglpelak4->caption());

			// targetpes4
			$this->targetpes4->EditAttrs["class"] = "form-control";
			$this->targetpes4->EditCustomAttributes = "";
			$this->targetpes4->EditValue = HtmlEncode($this->targetpes4->CurrentValue);
			$this->targetpes4->PlaceHolder = RemoveHtml($this->targetpes4->caption());

			// tglpelak5
			$this->tglpelak5->EditAttrs["class"] = "form-control";
			$this->tglpelak5->EditCustomAttributes = "";
			if (!$this->tglpelak5->Raw)
				$this->tglpelak5->CurrentValue = HtmlDecode($this->tglpelak5->CurrentValue);
			$this->tglpelak5->EditValue = HtmlEncode($this->tglpelak5->CurrentValue);
			$this->tglpelak5->PlaceHolder = RemoveHtml($this->tglpelak5->caption());

			// targetpes5
			$this->targetpes5->EditAttrs["class"] = "form-control";
			$this->targetpes5->EditCustomAttributes = "";
			$this->targetpes5->EditValue = HtmlEncode($this->targetpes5->CurrentValue);
			$this->targetpes5->PlaceHolder = RemoveHtml($this->targetpes5->caption());

			// tglpelak6
			$this->tglpelak6->EditAttrs["class"] = "form-control";
			$this->tglpelak6->EditCustomAttributes = "";
			if (!$this->tglpelak6->Raw)
				$this->tglpelak6->CurrentValue = HtmlDecode($this->tglpelak6->CurrentValue);
			$this->tglpelak6->EditValue = HtmlEncode($this->tglpelak6->CurrentValue);
			$this->tglpelak6->PlaceHolder = RemoveHtml($this->tglpelak6->caption());

			// targetpes6
			$this->targetpes6->EditAttrs["class"] = "form-control";
			$this->targetpes6->EditCustomAttributes = "";
			$this->targetpes6->EditValue = HtmlEncode($this->targetpes6->CurrentValue);
			$this->targetpes6->PlaceHolder = RemoveHtml($this->targetpes6->caption());

			// tglpelak7
			$this->tglpelak7->EditAttrs["class"] = "form-control";
			$this->tglpelak7->EditCustomAttributes = "";
			if (!$this->tglpelak7->Raw)
				$this->tglpelak7->CurrentValue = HtmlDecode($this->tglpelak7->CurrentValue);
			$this->tglpelak7->EditValue = HtmlEncode($this->tglpelak7->CurrentValue);
			$this->tglpelak7->PlaceHolder = RemoveHtml($this->tglpelak7->caption());

			// targetpes7
			$this->targetpes7->EditAttrs["class"] = "form-control";
			$this->targetpes7->EditCustomAttributes = "";
			$this->targetpes7->EditValue = HtmlEncode($this->targetpes7->CurrentValue);
			$this->targetpes7->PlaceHolder = RemoveHtml($this->targetpes7->caption());

			// tglpelak8
			$this->tglpelak8->EditAttrs["class"] = "form-control";
			$this->tglpelak8->EditCustomAttributes = "";
			if (!$this->tglpelak8->Raw)
				$this->tglpelak8->CurrentValue = HtmlDecode($this->tglpelak8->CurrentValue);
			$this->tglpelak8->EditValue = HtmlEncode($this->tglpelak8->CurrentValue);
			$this->tglpelak8->PlaceHolder = RemoveHtml($this->tglpelak8->caption());

			// targetpes8
			$this->targetpes8->EditAttrs["class"] = "form-control";
			$this->targetpes8->EditCustomAttributes = "";
			$this->targetpes8->EditValue = HtmlEncode($this->targetpes8->CurrentValue);
			$this->targetpes8->PlaceHolder = RemoveHtml($this->targetpes8->caption());

			// Edit refer script
			// area

			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// tglpelak1
			$this->tglpelak1->LinkCustomAttributes = "";
			$this->tglpelak1->HrefValue = "";

			// targetpes1
			$this->targetpes1->LinkCustomAttributes = "";
			$this->targetpes1->HrefValue = "";

			// tglpelak2
			$this->tglpelak2->LinkCustomAttributes = "";
			$this->tglpelak2->HrefValue = "";

			// targetpes2
			$this->targetpes2->LinkCustomAttributes = "";
			$this->targetpes2->HrefValue = "";

			// tglpelak3
			$this->tglpelak3->LinkCustomAttributes = "";
			$this->tglpelak3->HrefValue = "";

			// targetpes3
			$this->targetpes3->LinkCustomAttributes = "";
			$this->targetpes3->HrefValue = "";

			// tglpelak4
			$this->tglpelak4->LinkCustomAttributes = "";
			$this->tglpelak4->HrefValue = "";

			// targetpes4
			$this->targetpes4->LinkCustomAttributes = "";
			$this->targetpes4->HrefValue = "";

			// tglpelak5
			$this->tglpelak5->LinkCustomAttributes = "";
			$this->tglpelak5->HrefValue = "";

			// targetpes5
			$this->targetpes5->LinkCustomAttributes = "";
			$this->targetpes5->HrefValue = "";

			// tglpelak6
			$this->tglpelak6->LinkCustomAttributes = "";
			$this->tglpelak6->HrefValue = "";

			// targetpes6
			$this->targetpes6->LinkCustomAttributes = "";
			$this->targetpes6->HrefValue = "";

			// tglpelak7
			$this->tglpelak7->LinkCustomAttributes = "";
			$this->tglpelak7->HrefValue = "";

			// targetpes7
			$this->targetpes7->LinkCustomAttributes = "";
			$this->targetpes7->HrefValue = "";

			// tglpelak8
			$this->tglpelak8->LinkCustomAttributes = "";
			$this->tglpelak8->HrefValue = "";

			// targetpes8
			$this->targetpes8->LinkCustomAttributes = "";
			$this->targetpes8->HrefValue = "";
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
		if ($this->area->Required) {
			if (!$this->area->IsDetailKey && $this->area->FormValue != NULL && $this->area->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->area->caption(), $this->area->RequiredErrorMessage));
			}
		}
		if ($this->jenispel->Required) {
			if (!$this->jenispel->IsDetailKey && $this->jenispel->FormValue != NULL && $this->jenispel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenispel->caption(), $this->jenispel->RequiredErrorMessage));
			}
		}
		if ($this->kdkategori->Required) {
			if (!$this->kdkategori->IsDetailKey && $this->kdkategori->FormValue != NULL && $this->kdkategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkategori->caption(), $this->kdkategori->RequiredErrorMessage));
			}
		}
		if ($this->kerjasama->Required) {
			if (!$this->kerjasama->IsDetailKey && $this->kerjasama->FormValue != NULL && $this->kerjasama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kerjasama->caption(), $this->kerjasama->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->kerjasama->FormValue)) {
			AddMessage($FormError, $this->kerjasama->errorMessage());
		}
		if ($this->tglpelak1->Required) {
			if (!$this->tglpelak1->IsDetailKey && $this->tglpelak1->FormValue != NULL && $this->tglpelak1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak1->caption(), $this->tglpelak1->RequiredErrorMessage));
			}
		}
		if ($this->targetpes1->Required) {
			if (!$this->targetpes1->IsDetailKey && $this->targetpes1->FormValue != NULL && $this->targetpes1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes1->caption(), $this->targetpes1->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes1->FormValue)) {
			AddMessage($FormError, $this->targetpes1->errorMessage());
		}
		if ($this->tglpelak2->Required) {
			if (!$this->tglpelak2->IsDetailKey && $this->tglpelak2->FormValue != NULL && $this->tglpelak2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak2->caption(), $this->tglpelak2->RequiredErrorMessage));
			}
		}
		if ($this->targetpes2->Required) {
			if (!$this->targetpes2->IsDetailKey && $this->targetpes2->FormValue != NULL && $this->targetpes2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes2->caption(), $this->targetpes2->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes2->FormValue)) {
			AddMessage($FormError, $this->targetpes2->errorMessage());
		}
		if ($this->tglpelak3->Required) {
			if (!$this->tglpelak3->IsDetailKey && $this->tglpelak3->FormValue != NULL && $this->tglpelak3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak3->caption(), $this->tglpelak3->RequiredErrorMessage));
			}
		}
		if ($this->targetpes3->Required) {
			if (!$this->targetpes3->IsDetailKey && $this->targetpes3->FormValue != NULL && $this->targetpes3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes3->caption(), $this->targetpes3->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes3->FormValue)) {
			AddMessage($FormError, $this->targetpes3->errorMessage());
		}
		if ($this->tglpelak4->Required) {
			if (!$this->tglpelak4->IsDetailKey && $this->tglpelak4->FormValue != NULL && $this->tglpelak4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak4->caption(), $this->tglpelak4->RequiredErrorMessage));
			}
		}
		if ($this->targetpes4->Required) {
			if (!$this->targetpes4->IsDetailKey && $this->targetpes4->FormValue != NULL && $this->targetpes4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes4->caption(), $this->targetpes4->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes4->FormValue)) {
			AddMessage($FormError, $this->targetpes4->errorMessage());
		}
		if ($this->tglpelak5->Required) {
			if (!$this->tglpelak5->IsDetailKey && $this->tglpelak5->FormValue != NULL && $this->tglpelak5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak5->caption(), $this->tglpelak5->RequiredErrorMessage));
			}
		}
		if ($this->targetpes5->Required) {
			if (!$this->targetpes5->IsDetailKey && $this->targetpes5->FormValue != NULL && $this->targetpes5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes5->caption(), $this->targetpes5->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes5->FormValue)) {
			AddMessage($FormError, $this->targetpes5->errorMessage());
		}
		if ($this->tglpelak6->Required) {
			if (!$this->tglpelak6->IsDetailKey && $this->tglpelak6->FormValue != NULL && $this->tglpelak6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak6->caption(), $this->tglpelak6->RequiredErrorMessage));
			}
		}
		if ($this->targetpes6->Required) {
			if (!$this->targetpes6->IsDetailKey && $this->targetpes6->FormValue != NULL && $this->targetpes6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes6->caption(), $this->targetpes6->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes6->FormValue)) {
			AddMessage($FormError, $this->targetpes6->errorMessage());
		}
		if ($this->tglpelak7->Required) {
			if (!$this->tglpelak7->IsDetailKey && $this->tglpelak7->FormValue != NULL && $this->tglpelak7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak7->caption(), $this->tglpelak7->RequiredErrorMessage));
			}
		}
		if ($this->targetpes7->Required) {
			if (!$this->targetpes7->IsDetailKey && $this->targetpes7->FormValue != NULL && $this->targetpes7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes7->caption(), $this->targetpes7->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes7->FormValue)) {
			AddMessage($FormError, $this->targetpes7->errorMessage());
		}
		if ($this->tglpelak8->Required) {
			if (!$this->tglpelak8->IsDetailKey && $this->tglpelak8->FormValue != NULL && $this->tglpelak8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpelak8->caption(), $this->tglpelak8->RequiredErrorMessage));
			}
		}
		if ($this->targetpes8->Required) {
			if (!$this->targetpes8->IsDetailKey && $this->targetpes8->FormValue != NULL && $this->targetpes8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes8->caption(), $this->targetpes8->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes8->FormValue)) {
			AddMessage($FormError, $this->targetpes8->errorMessage());
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// area
			$this->area->setDbValueDef($rsnew, $this->area->CurrentValue, NULL, $this->area->ReadOnly);

			// jenispel
			$this->jenispel->setDbValueDef($rsnew, $this->jenispel->CurrentValue, 0, $this->jenispel->ReadOnly);

			// kdkategori
			$this->kdkategori->setDbValueDef($rsnew, $this->kdkategori->CurrentValue, 0, $this->kdkategori->ReadOnly);

			// kerjasama
			$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, 0, $this->kerjasama->ReadOnly);

			// tglpelak1
			$this->tglpelak1->setDbValueDef($rsnew, $this->tglpelak1->CurrentValue, NULL, $this->tglpelak1->ReadOnly);

			// targetpes1
			$this->targetpes1->setDbValueDef($rsnew, $this->targetpes1->CurrentValue, NULL, $this->targetpes1->ReadOnly);

			// tglpelak2
			$this->tglpelak2->setDbValueDef($rsnew, $this->tglpelak2->CurrentValue, NULL, $this->tglpelak2->ReadOnly);

			// targetpes2
			$this->targetpes2->setDbValueDef($rsnew, $this->targetpes2->CurrentValue, NULL, $this->targetpes2->ReadOnly);

			// tglpelak3
			$this->tglpelak3->setDbValueDef($rsnew, $this->tglpelak3->CurrentValue, NULL, $this->tglpelak3->ReadOnly);

			// targetpes3
			$this->targetpes3->setDbValueDef($rsnew, $this->targetpes3->CurrentValue, NULL, $this->targetpes3->ReadOnly);

			// tglpelak4
			$this->tglpelak4->setDbValueDef($rsnew, $this->tglpelak4->CurrentValue, NULL, $this->tglpelak4->ReadOnly);

			// targetpes4
			$this->targetpes4->setDbValueDef($rsnew, $this->targetpes4->CurrentValue, NULL, $this->targetpes4->ReadOnly);

			// tglpelak5
			$this->tglpelak5->setDbValueDef($rsnew, $this->tglpelak5->CurrentValue, NULL, $this->tglpelak5->ReadOnly);

			// targetpes5
			$this->targetpes5->setDbValueDef($rsnew, $this->targetpes5->CurrentValue, NULL, $this->targetpes5->ReadOnly);

			// tglpelak6
			$this->tglpelak6->setDbValueDef($rsnew, $this->tglpelak6->CurrentValue, NULL, $this->tglpelak6->ReadOnly);

			// targetpes6
			$this->targetpes6->setDbValueDef($rsnew, $this->targetpes6->CurrentValue, NULL, $this->targetpes6->ReadOnly);

			// tglpelak7
			$this->tglpelak7->setDbValueDef($rsnew, $this->tglpelak7->CurrentValue, NULL, $this->tglpelak7->ReadOnly);

			// targetpes7
			$this->targetpes7->setDbValueDef($rsnew, $this->targetpes7->CurrentValue, NULL, $this->targetpes7->ReadOnly);

			// tglpelak8
			$this->tglpelak8->setDbValueDef($rsnew, $this->tglpelak8->CurrentValue, NULL, $this->tglpelak8->ReadOnly);

			// targetpes8
			$this->targetpes8->setDbValueDef($rsnew, $this->targetpes8->CurrentValue, NULL, $this->targetpes8->ReadOnly);

			// Check referential integrity for master table 't_rkcoaching'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_rkcoaching();
			$keyValue = isset($rsnew['rkid']) ? $rsnew['rkid'] : $rsold['rkid'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@rkid@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['area']) ? $rsnew['area'] : $rsold['area'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@area@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_rkcoaching"]))
					$GLOBALS["t_rkcoaching"] = new t_rkcoaching();
				$rsmaster = $GLOBALS["t_rkcoaching"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_rkcoaching", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
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
			if ($masterTblVar == "t_rkcoaching") {
				$validMaster = TRUE;
				if (($parm = Get("fk_rkid", Get("rkid"))) !== NULL) {
					$GLOBALS["t_rkcoaching"]->rkid->setQueryStringValue($parm);
					$this->rkid->setQueryStringValue($GLOBALS["t_rkcoaching"]->rkid->QueryStringValue);
					$this->rkid->setSessionValue($this->rkid->QueryStringValue);
					if (!is_numeric($GLOBALS["t_rkcoaching"]->rkid->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_area", Get("area"))) !== NULL) {
					$GLOBALS["t_rkcoaching"]->area->setQueryStringValue($parm);
					$this->area->setQueryStringValue($GLOBALS["t_rkcoaching"]->area->QueryStringValue);
					$this->area->setSessionValue($this->area->QueryStringValue);
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
			if ($masterTblVar == "t_rkcoaching") {
				$validMaster = TRUE;
				if (($parm = Post("fk_rkid", Post("rkid"))) !== NULL) {
					$GLOBALS["t_rkcoaching"]->rkid->setFormValue($parm);
					$this->rkid->setFormValue($GLOBALS["t_rkcoaching"]->rkid->FormValue);
					$this->rkid->setSessionValue($this->rkid->FormValue);
					if (!is_numeric($GLOBALS["t_rkcoaching"]->rkid->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_area", Post("area"))) !== NULL) {
					$GLOBALS["t_rkcoaching"]->area->setFormValue($parm);
					$this->area->setFormValue($GLOBALS["t_rkcoaching"]->area->FormValue);
					$this->area->setSessionValue($this->area->FormValue);
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "t_rkcoaching") {
				if ($this->rkid->CurrentValue == "")
					$this->rkid->setSessionValue("");
				if ($this->area->CurrentValue == "")
					$this->area->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_coachingtahapanlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Set up multi pages
	protected function setupMultiPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add(0);
		$pages->add(1);
		$pages->add(2);
		$pages->add(3);
		$pages->add(4);
		$pages->add(5);
		$pages->add(6);
		$pages->add(7);
		$pages->add(8);
		$pages->add(9);
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
				case "x_area":
					break;
				case "x_jenispel":
					break;
				case "x_kdkategori":
					break;
				case "x_kerjasama":
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
						case "x_area":
							break;
						case "x_kdkategori":
							break;
						case "x_kerjasama":
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

		$footer = "<br>Keterangan: <br>";
		$footer .= "Tahap 1: Workshop dan Verifikasi Perusahaan (4 hari, 1 hari dikelas dan 3 hari kunjungan)<br>";
		$footer .= "Tahap 2: Training of Exporter (TOX) (3 hari di kelas)<br>";
		$footer .= "Tahap 3: Pendampingan Produk (3 hari kunjungan)<br>";
		$footer .= "Tahap 4: Pendampingan Market Development (3 hari kunjungan)<br>";
		$footer .= "Tahap 5: TOX Lanjutan (3 hari di kelas)<br>";
		$footer .= "Tahap 6: Business Matching (1 hari di kelas)<br>";
		$footer .= "Tahap 7: Progress Monitoring (3 hari kunjungan)<br>";
		$footer .= "Tahap 8: Evaluasi dan Penutupan (2 hari)<br>";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>