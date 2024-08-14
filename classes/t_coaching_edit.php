<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_coaching_edit extends t_coaching
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_coaching';

	// Page object name
	public $PageObjName = "t_coaching_edit";

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

		// Table object (t_coaching)
		if (!isset($GLOBALS["t_coaching"]) || get_class($GLOBALS["t_coaching"]) == PROJECT_NAMESPACE . "t_coaching") {
			$GLOBALS["t_coaching"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_coaching"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_coaching');

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
		global $t_coaching;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_coaching);
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
					if ($pageName == "t_coachingview.php")
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
			$key .= @$ar['kdcoaching'];
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
			$this->kdcoaching->Visible = FALSE;
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
					$this->terminate(GetUrl("t_coachinglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->kdcoaching->setVisibility();
		$this->rkid->Visible = FALSE;
		$this->kdtahapan->setVisibility();
		$this->kdkursil->setVisibility();
		$this->tawal->setVisibility();
		$this->takhir->setVisibility();
		$this->jmlhari->setVisibility();
		$this->kdprop->setVisibility();
		$this->ketua->setVisibility();
		$this->sekretaris->setVisibility();
		$this->bendahara->setVisibility();
		$this->status->setVisibility();
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
		$this->setupLookupOptions($this->kdtahapan);
		$this->setupLookupOptions($this->kdkursil);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->ketua);
		$this->setupLookupOptions($this->sekretaris);
		$this->setupLookupOptions($this->bendahara);
		$this->setupLookupOptions($this->jenisevaluasi);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_coachinglist.php");
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
			if (Get("kdcoaching") !== NULL) {
				$this->kdcoaching->setQueryStringValue(Get("kdcoaching"));
				$this->kdcoaching->setOldValue($this->kdcoaching->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->kdcoaching->setQueryStringValue(Key(0));
				$this->kdcoaching->setOldValue($this->kdcoaching->QueryStringValue);
			} elseif (Post("kdcoaching") !== NULL) {
				$this->kdcoaching->setFormValue(Post("kdcoaching"));
				$this->kdcoaching->setOldValue($this->kdcoaching->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->kdcoaching->setQueryStringValue(Route(2));
				$this->kdcoaching->setOldValue($this->kdcoaching->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_kdcoaching")) {
					$this->kdcoaching->setFormValue($CurrentForm->getValue("x_kdcoaching"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("kdcoaching") !== NULL) {
					$this->kdcoaching->setQueryStringValue(Get("kdcoaching"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->kdcoaching->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->kdcoaching->CurrentValue = NULL;
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
					$this->terminate("t_coachinglist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_coachinglist.php")
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

		// Check field name 'kdcoaching' first before field var 'x_kdcoaching'
		$val = $CurrentForm->hasValue("kdcoaching") ? $CurrentForm->getValue("kdcoaching") : $CurrentForm->getValue("x_kdcoaching");
		if (!$this->kdcoaching->IsDetailKey)
			$this->kdcoaching->setFormValue($val);

		// Check field name 'kdtahapan' first before field var 'x_kdtahapan'
		$val = $CurrentForm->hasValue("kdtahapan") ? $CurrentForm->getValue("kdtahapan") : $CurrentForm->getValue("x_kdtahapan");
		if (!$this->kdtahapan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdtahapan->Visible = FALSE; // Disable update for API request
			else
				$this->kdtahapan->setFormValue($val);
		}

		// Check field name 'kdkursil' first before field var 'x_kdkursil'
		$val = $CurrentForm->hasValue("kdkursil") ? $CurrentForm->getValue("kdkursil") : $CurrentForm->getValue("x_kdkursil");
		if (!$this->kdkursil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkursil->Visible = FALSE; // Disable update for API request
			else
				$this->kdkursil->setFormValue($val);
		}

		// Check field name 'tawal' first before field var 'x_tawal'
		$val = $CurrentForm->hasValue("tawal") ? $CurrentForm->getValue("tawal") : $CurrentForm->getValue("x_tawal");
		if (!$this->tawal->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tawal->Visible = FALSE; // Disable update for API request
			else
				$this->tawal->setFormValue($val);
			$this->tawal->CurrentValue = UnFormatDateTime($this->tawal->CurrentValue, 0);
		}

		// Check field name 'takhir' first before field var 'x_takhir'
		$val = $CurrentForm->hasValue("takhir") ? $CurrentForm->getValue("takhir") : $CurrentForm->getValue("x_takhir");
		if (!$this->takhir->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->takhir->Visible = FALSE; // Disable update for API request
			else
				$this->takhir->setFormValue($val);
			$this->takhir->CurrentValue = UnFormatDateTime($this->takhir->CurrentValue, 0);
		}

		// Check field name 'jmlhari' first before field var 'x_jmlhari'
		$val = $CurrentForm->hasValue("jmlhari") ? $CurrentForm->getValue("jmlhari") : $CurrentForm->getValue("x_jmlhari");
		if (!$this->jmlhari->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jmlhari->Visible = FALSE; // Disable update for API request
			else
				$this->jmlhari->setFormValue($val);
		}

		// Check field name 'kdprop' first before field var 'x_kdprop'
		$val = $CurrentForm->hasValue("kdprop") ? $CurrentForm->getValue("kdprop") : $CurrentForm->getValue("x_kdprop");
		if (!$this->kdprop->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdprop->Visible = FALSE; // Disable update for API request
			else
				$this->kdprop->setFormValue($val);
		}

		// Check field name 'ketua' first before field var 'x_ketua'
		$val = $CurrentForm->hasValue("ketua") ? $CurrentForm->getValue("ketua") : $CurrentForm->getValue("x_ketua");
		if (!$this->ketua->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ketua->Visible = FALSE; // Disable update for API request
			else
				$this->ketua->setFormValue($val);
		}

		// Check field name 'sekretaris' first before field var 'x_sekretaris'
		$val = $CurrentForm->hasValue("sekretaris") ? $CurrentForm->getValue("sekretaris") : $CurrentForm->getValue("x_sekretaris");
		if (!$this->sekretaris->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sekretaris->Visible = FALSE; // Disable update for API request
			else
				$this->sekretaris->setFormValue($val);
		}

		// Check field name 'bendahara' first before field var 'x_bendahara'
		$val = $CurrentForm->hasValue("bendahara") ? $CurrentForm->getValue("bendahara") : $CurrentForm->getValue("x_bendahara");
		if (!$this->bendahara->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->bendahara->Visible = FALSE; // Disable update for API request
			else
				$this->bendahara->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'jenisevaluasi' first before field var 'x_jenisevaluasi'
		$val = $CurrentForm->hasValue("jenisevaluasi") ? $CurrentForm->getValue("jenisevaluasi") : $CurrentForm->getValue("x_jenisevaluasi");
		if (!$this->jenisevaluasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenisevaluasi->Visible = FALSE; // Disable update for API request
			else
				$this->jenisevaluasi->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kdcoaching->CurrentValue = $this->kdcoaching->FormValue;
		$this->kdtahapan->CurrentValue = $this->kdtahapan->FormValue;
		$this->kdkursil->CurrentValue = $this->kdkursil->FormValue;
		$this->tawal->CurrentValue = $this->tawal->FormValue;
		$this->tawal->CurrentValue = UnFormatDateTime($this->tawal->CurrentValue, 0);
		$this->takhir->CurrentValue = $this->takhir->FormValue;
		$this->takhir->CurrentValue = UnFormatDateTime($this->takhir->CurrentValue, 0);
		$this->jmlhari->CurrentValue = $this->jmlhari->FormValue;
		$this->kdprop->CurrentValue = $this->kdprop->FormValue;
		$this->ketua->CurrentValue = $this->ketua->FormValue;
		$this->sekretaris->CurrentValue = $this->sekretaris->FormValue;
		$this->bendahara->CurrentValue = $this->bendahara->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->jenisevaluasi->CurrentValue = $this->jenisevaluasi->FormValue;
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
		$this->kdcoaching->setDbValue($row['kdcoaching']);
		$this->rkid->setDbValue($row['rkid']);
		$this->kdtahapan->setDbValue($row['kdtahapan']);
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->tawal->setDbValue($row['tawal']);
		$this->takhir->setDbValue($row['takhir']);
		$this->jmlhari->setDbValue($row['jmlhari']);
		$this->kdprop->setDbValue($row['kdprop']);
		$this->ketua->setDbValue($row['ketua']);
		$this->sekretaris->setDbValue($row['sekretaris']);
		$this->bendahara->setDbValue($row['bendahara']);
		$this->status->setDbValue($row['status']);
		$this->jenisevaluasi->setDbValue($row['jenisevaluasi']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['kdcoaching'] = NULL;
		$row['rkid'] = NULL;
		$row['kdtahapan'] = NULL;
		$row['kdkursil'] = NULL;
		$row['tawal'] = NULL;
		$row['takhir'] = NULL;
		$row['jmlhari'] = NULL;
		$row['kdprop'] = NULL;
		$row['ketua'] = NULL;
		$row['sekretaris'] = NULL;
		$row['bendahara'] = NULL;
		$row['status'] = NULL;
		$row['jenisevaluasi'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("kdcoaching")) != "")
			$this->kdcoaching->OldValue = $this->getKey("kdcoaching"); // kdcoaching
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
		// kdcoaching
		// rkid
		// kdtahapan
		// kdkursil
		// tawal
		// takhir
		// jmlhari
		// kdprop
		// ketua
		// sekretaris
		// bendahara
		// status
		// jenisevaluasi

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kdcoaching
			$this->kdcoaching->ViewValue = $this->kdcoaching->CurrentValue;
			$this->kdcoaching->ViewCustomAttributes = "";

			// kdtahapan
			$curVal = strval($this->kdtahapan->CurrentValue);
			if ($curVal != "") {
				$this->kdtahapan->ViewValue = $this->kdtahapan->lookupCacheOption($curVal);
				if ($this->kdtahapan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdtahapan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdtahapan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdtahapan->ViewValue = $this->kdtahapan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdtahapan->ViewValue = $this->kdtahapan->CurrentValue;
					}
				}
			} else {
				$this->kdtahapan->ViewValue = NULL;
			}
			$this->kdtahapan->ViewCustomAttributes = "";

			// kdkursil
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

			// tawal
			$this->tawal->ViewValue = $this->tawal->CurrentValue;
			$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
			$this->tawal->ViewCustomAttributes = "";

			// takhir
			$this->takhir->ViewValue = $this->takhir->CurrentValue;
			$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
			$this->takhir->ViewCustomAttributes = "";

			// jmlhari
			$this->jmlhari->ViewValue = $this->jmlhari->CurrentValue;
			$this->jmlhari->ViewValue = FormatNumber($this->jmlhari->ViewValue, 0, -2, -2, -2);
			$this->jmlhari->ViewCustomAttributes = "";

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

			// status
			if (strval($this->status->CurrentValue) != "") {
				$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
			} else {
				$this->status->ViewValue = NULL;
			}
			$this->status->ViewCustomAttributes = "";

			// jenisevaluasi
			$curVal = strval($this->jenisevaluasi->CurrentValue);
			if ($curVal != "") {
				$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->lookupCacheOption($curVal);
				if ($this->jenisevaluasi->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`id`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->jenisevaluasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->jenisevaluasi->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->jenisevaluasi->ViewValue->add($this->jenisevaluasi->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->CurrentValue;
					}
				}
			} else {
				$this->jenisevaluasi->ViewValue = NULL;
			}
			$this->jenisevaluasi->ViewCustomAttributes = "";

			// kdcoaching
			$this->kdcoaching->LinkCustomAttributes = "";
			$this->kdcoaching->HrefValue = "";
			$this->kdcoaching->TooltipValue = "";

			// kdtahapan
			$this->kdtahapan->LinkCustomAttributes = "";
			$this->kdtahapan->HrefValue = "";
			$this->kdtahapan->TooltipValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";
			$this->kdkursil->TooltipValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";
			$this->tawal->TooltipValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";
			$this->takhir->TooltipValue = "";

			// jmlhari
			$this->jmlhari->LinkCustomAttributes = "";
			$this->jmlhari->HrefValue = "";
			$this->jmlhari->TooltipValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";
			$this->kdprop->TooltipValue = "";

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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// jenisevaluasi
			$this->jenisevaluasi->LinkCustomAttributes = "";
			$this->jenisevaluasi->HrefValue = "";
			$this->jenisevaluasi->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// kdcoaching
			$this->kdcoaching->EditAttrs["class"] = "form-control";
			$this->kdcoaching->EditCustomAttributes = "";
			$this->kdcoaching->EditValue = $this->kdcoaching->CurrentValue;
			$this->kdcoaching->ViewCustomAttributes = "";

			// kdtahapan
			$this->kdtahapan->EditAttrs["class"] = "form-control";
			$this->kdtahapan->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdtahapan->CurrentValue));
			if ($curVal != "")
				$this->kdtahapan->ViewValue = $this->kdtahapan->lookupCacheOption($curVal);
			else
				$this->kdtahapan->ViewValue = $this->kdtahapan->Lookup !== NULL && is_array($this->kdtahapan->Lookup->Options) ? $curVal : NULL;
			if ($this->kdtahapan->ViewValue !== NULL) { // Load from cache
				$this->kdtahapan->EditValue = array_values($this->kdtahapan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdtahapan`" . SearchString("=", $this->kdtahapan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdtahapan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdtahapan->EditValue = $arwrk;
			}

			// kdkursil
			$this->kdkursil->EditAttrs["class"] = "form-control";
			$this->kdkursil->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkursil->CurrentValue));
			if ($curVal != "")
				$this->kdkursil->ViewValue = $this->kdkursil->lookupCacheOption($curVal);
			else
				$this->kdkursil->ViewValue = $this->kdkursil->Lookup !== NULL && is_array($this->kdkursil->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkursil->ViewValue !== NULL) { // Load from cache
				$this->kdkursil->EditValue = array_values($this->kdkursil->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkursil`" . SearchString("=", $this->kdkursil->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kdkursil->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][3] = FormatDateTime($arwrk[$i][3], 0);
				}
				$this->kdkursil->EditValue = $arwrk;
			}

			// tawal
			$this->tawal->EditAttrs["class"] = "form-control";
			$this->tawal->EditCustomAttributes = 'style=" width: 120px; "';
			$this->tawal->EditValue = HtmlEncode(FormatDateTime($this->tawal->CurrentValue, 8));
			$this->tawal->PlaceHolder = RemoveHtml($this->tawal->caption());

			// takhir
			$this->takhir->EditAttrs["class"] = "form-control";
			$this->takhir->EditCustomAttributes = 'style=" width: 120px; "';
			$this->takhir->EditValue = HtmlEncode(FormatDateTime($this->takhir->CurrentValue, 8));
			$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

			// jmlhari
			$this->jmlhari->EditAttrs["class"] = "form-control";
			$this->jmlhari->EditCustomAttributes = "";
			$this->jmlhari->EditValue = HtmlEncode($this->jmlhari->CurrentValue);
			$this->jmlhari->PlaceHolder = RemoveHtml($this->jmlhari->caption());

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";
			if ($this->kdprop->getSessionValue() != "") {
				$this->kdprop->CurrentValue = $this->kdprop->getSessionValue();
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
			} else {
				$curVal = trim(strval($this->kdprop->CurrentValue));
				if ($curVal != "")
					$this->kdprop->ViewValue = $this->kdprop->lookupCacheOption($curVal);
				else
					$this->kdprop->ViewValue = $this->kdprop->Lookup !== NULL && is_array($this->kdprop->Lookup->Options) ? $curVal : NULL;
				if ($this->kdprop->ViewValue !== NULL) { // Load from cache
					$this->kdprop->EditValue = array_values($this->kdprop->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`kdprop`" . SearchString("=", $this->kdprop->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->kdprop->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->kdprop->EditValue = $arwrk;
				}
			}

			// ketua
			$this->ketua->EditAttrs["class"] = "form-control";
			$this->ketua->EditCustomAttributes = "";
			if (!$this->ketua->Raw)
				$this->ketua->CurrentValue = HtmlDecode($this->ketua->CurrentValue);
			$this->ketua->EditValue = HtmlEncode($this->ketua->CurrentValue);
			$curVal = strval($this->ketua->CurrentValue);
			if ($curVal != "") {
				$this->ketua->EditValue = $this->ketua->lookupCacheOption($curVal);
				if ($this->ketua->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ketua->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ketua->EditValue = $this->ketua->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ketua->EditValue = HtmlEncode($this->ketua->CurrentValue);
					}
				}
			} else {
				$this->ketua->EditValue = NULL;
			}
			$this->ketua->PlaceHolder = RemoveHtml($this->ketua->caption());

			// sekretaris
			$this->sekretaris->EditAttrs["class"] = "form-control";
			$this->sekretaris->EditCustomAttributes = "";
			if (!$this->sekretaris->Raw)
				$this->sekretaris->CurrentValue = HtmlDecode($this->sekretaris->CurrentValue);
			$this->sekretaris->EditValue = HtmlEncode($this->sekretaris->CurrentValue);
			$curVal = strval($this->sekretaris->CurrentValue);
			if ($curVal != "") {
				$this->sekretaris->EditValue = $this->sekretaris->lookupCacheOption($curVal);
				if ($this->sekretaris->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->sekretaris->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->sekretaris->EditValue = $this->sekretaris->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sekretaris->EditValue = HtmlEncode($this->sekretaris->CurrentValue);
					}
				}
			} else {
				$this->sekretaris->EditValue = NULL;
			}
			$this->sekretaris->PlaceHolder = RemoveHtml($this->sekretaris->caption());

			// bendahara
			$this->bendahara->EditAttrs["class"] = "form-control";
			$this->bendahara->EditCustomAttributes = "";
			if (!$this->bendahara->Raw)
				$this->bendahara->CurrentValue = HtmlDecode($this->bendahara->CurrentValue);
			$this->bendahara->EditValue = HtmlEncode($this->bendahara->CurrentValue);
			$curVal = strval($this->bendahara->CurrentValue);
			if ($curVal != "") {
				$this->bendahara->EditValue = $this->bendahara->lookupCacheOption($curVal);
				if ($this->bendahara->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->bendahara->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->bendahara->EditValue = $this->bendahara->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->bendahara->EditValue = HtmlEncode($this->bendahara->CurrentValue);
					}
				}
			} else {
				$this->bendahara->EditValue = NULL;
			}
			$this->bendahara->PlaceHolder = RemoveHtml($this->bendahara->caption());

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(TRUE);

			// jenisevaluasi
			$this->jenisevaluasi->EditCustomAttributes = "";
			$curVal = trim(strval($this->jenisevaluasi->CurrentValue));
			if ($curVal != "")
				$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->lookupCacheOption($curVal);
			else
				$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->Lookup !== NULL && is_array($this->jenisevaluasi->Lookup->Options) ? $curVal : NULL;
			if ($this->jenisevaluasi->ViewValue !== NULL) { // Load from cache
				$this->jenisevaluasi->EditValue = array_values($this->jenisevaluasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`id`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->jenisevaluasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jenisevaluasi->EditValue = $arwrk;
			}

			// Edit refer script
			// kdcoaching

			$this->kdcoaching->LinkCustomAttributes = "";
			$this->kdcoaching->HrefValue = "";

			// kdtahapan
			$this->kdtahapan->LinkCustomAttributes = "";
			$this->kdtahapan->HrefValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";

			// jmlhari
			$this->jmlhari->LinkCustomAttributes = "";
			$this->jmlhari->HrefValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";

			// ketua
			$this->ketua->LinkCustomAttributes = "";
			$this->ketua->HrefValue = "";

			// sekretaris
			$this->sekretaris->LinkCustomAttributes = "";
			$this->sekretaris->HrefValue = "";

			// bendahara
			$this->bendahara->LinkCustomAttributes = "";
			$this->bendahara->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// jenisevaluasi
			$this->jenisevaluasi->LinkCustomAttributes = "";
			$this->jenisevaluasi->HrefValue = "";
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
		if ($this->kdcoaching->Required) {
			if (!$this->kdcoaching->IsDetailKey && $this->kdcoaching->FormValue != NULL && $this->kdcoaching->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdcoaching->caption(), $this->kdcoaching->RequiredErrorMessage));
			}
		}
		if ($this->kdtahapan->Required) {
			if (!$this->kdtahapan->IsDetailKey && $this->kdtahapan->FormValue != NULL && $this->kdtahapan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdtahapan->caption(), $this->kdtahapan->RequiredErrorMessage));
			}
		}
		if ($this->kdkursil->Required) {
			if (!$this->kdkursil->IsDetailKey && $this->kdkursil->FormValue != NULL && $this->kdkursil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkursil->caption(), $this->kdkursil->RequiredErrorMessage));
			}
		}
		if ($this->tawal->Required) {
			if (!$this->tawal->IsDetailKey && $this->tawal->FormValue != NULL && $this->tawal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tawal->caption(), $this->tawal->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tawal->FormValue)) {
			AddMessage($FormError, $this->tawal->errorMessage());
		}
		if ($this->takhir->Required) {
			if (!$this->takhir->IsDetailKey && $this->takhir->FormValue != NULL && $this->takhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->takhir->caption(), $this->takhir->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->takhir->FormValue)) {
			AddMessage($FormError, $this->takhir->errorMessage());
		}
		if ($this->jmlhari->Required) {
			if (!$this->jmlhari->IsDetailKey && $this->jmlhari->FormValue != NULL && $this->jmlhari->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jmlhari->caption(), $this->jmlhari->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jmlhari->FormValue)) {
			AddMessage($FormError, $this->jmlhari->errorMessage());
		}
		if ($this->kdprop->Required) {
			if (!$this->kdprop->IsDetailKey && $this->kdprop->FormValue != NULL && $this->kdprop->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdprop->caption(), $this->kdprop->RequiredErrorMessage));
			}
		}
		if ($this->ketua->Required) {
			if (!$this->ketua->IsDetailKey && $this->ketua->FormValue != NULL && $this->ketua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ketua->caption(), $this->ketua->RequiredErrorMessage));
			}
		}
		if ($this->sekretaris->Required) {
			if (!$this->sekretaris->IsDetailKey && $this->sekretaris->FormValue != NULL && $this->sekretaris->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sekretaris->caption(), $this->sekretaris->RequiredErrorMessage));
			}
		}
		if ($this->bendahara->Required) {
			if (!$this->bendahara->IsDetailKey && $this->bendahara->FormValue != NULL && $this->bendahara->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bendahara->caption(), $this->bendahara->RequiredErrorMessage));
			}
		}
		if ($this->status->Required) {
			if (!$this->status->IsDetailKey && $this->status->FormValue != NULL && $this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->jenisevaluasi->Required) {
			if ($this->jenisevaluasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenisevaluasi->caption(), $this->jenisevaluasi->RequiredErrorMessage));
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

			// kdtahapan
			$this->kdtahapan->setDbValueDef($rsnew, $this->kdtahapan->CurrentValue, 0, $this->kdtahapan->ReadOnly);

			// kdkursil
			$this->kdkursil->setDbValueDef($rsnew, $this->kdkursil->CurrentValue, "", $this->kdkursil->ReadOnly);

			// tawal
			$this->tawal->setDbValueDef($rsnew, UnFormatDateTime($this->tawal->CurrentValue, 0), CurrentDate(), $this->tawal->ReadOnly);

			// takhir
			$this->takhir->setDbValueDef($rsnew, UnFormatDateTime($this->takhir->CurrentValue, 0), CurrentDate(), $this->takhir->ReadOnly);

			// jmlhari
			$this->jmlhari->setDbValueDef($rsnew, $this->jmlhari->CurrentValue, 0, $this->jmlhari->ReadOnly);

			// kdprop
			$this->kdprop->setDbValueDef($rsnew, $this->kdprop->CurrentValue, 0, $this->kdprop->ReadOnly);

			// ketua
			$this->ketua->setDbValueDef($rsnew, $this->ketua->CurrentValue, "", $this->ketua->ReadOnly);

			// sekretaris
			$this->sekretaris->setDbValueDef($rsnew, $this->sekretaris->CurrentValue, "", $this->sekretaris->ReadOnly);

			// bendahara
			$this->bendahara->setDbValueDef($rsnew, $this->bendahara->CurrentValue, "", $this->bendahara->ReadOnly);

			// status
			$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, "", $this->status->ReadOnly);

			// jenisevaluasi
			$this->jenisevaluasi->setDbValueDef($rsnew, $this->jenisevaluasi->CurrentValue, "", $this->jenisevaluasi->ReadOnly);

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
				if (($parm = Get("fk_area", Get("kdprop"))) !== NULL) {
					$GLOBALS["t_rkcoaching"]->area->setQueryStringValue($parm);
					$this->kdprop->setQueryStringValue($GLOBALS["t_rkcoaching"]->area->QueryStringValue);
					$this->kdprop->setSessionValue($this->kdprop->QueryStringValue);
					if (!is_numeric($GLOBALS["t_rkcoaching"]->area->QueryStringValue))
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
				if (($parm = Post("fk_area", Post("kdprop"))) !== NULL) {
					$GLOBALS["t_rkcoaching"]->area->setFormValue($parm);
					$this->kdprop->setFormValue($GLOBALS["t_rkcoaching"]->area->FormValue);
					$this->kdprop->setSessionValue($this->kdprop->FormValue);
					if (!is_numeric($GLOBALS["t_rkcoaching"]->area->FormValue))
						$validMaster = FALSE;
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_coachinglist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_kdtahapan":
					break;
				case "x_kdkursil":
					break;
				case "x_kdprop":
					break;
				case "x_ketua":
					break;
				case "x_sekretaris":
					break;
				case "x_bendahara":
					break;
				case "x_status":
					break;
				case "x_jenisevaluasi":
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
						case "x_kdtahapan":
							break;
						case "x_kdkursil":
							$row[3] = FormatDateTime($row[3], 0);
							$row['df3'] = $row[3];
							break;
						case "x_kdprop":
							break;
						case "x_ketua":
							break;
						case "x_sekretaris":
							break;
						case "x_bendahara":
							break;
						case "x_jenisevaluasi":
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

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>