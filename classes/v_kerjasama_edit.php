<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class v_kerjasama_edit extends v_kerjasama
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 'v_kerjasama';

	// Page object name
	public $PageObjName = "v_kerjasama_edit";

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

		// Table object (v_kerjasama)
		if (!isset($GLOBALS["v_kerjasama"]) || get_class($GLOBALS["v_kerjasama"]) == PROJECT_NAMESPACE . "v_kerjasama") {
			$GLOBALS["v_kerjasama"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["v_kerjasama"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'v_kerjasama');

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
		global $v_kerjasama;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($v_kerjasama);
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
					if ($pageName == "v_kerjasamaview.php")
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
			$key .= @$ar['kdpelat'];
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
					$this->terminate(GetUrl("v_kerjasamalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->kdpelat->setVisibility();
		$this->kdjudul->setVisibility();
		$this->kdkursil->setVisibility();
		$this->revisi->setVisibility();
		$this->tgl_terbit->setVisibility();
		$this->tawal->setVisibility();
		$this->takhir->setVisibility();
		$this->jenispel->setVisibility();
		$this->kdkategori->setVisibility();
		$this->kerjasama->setVisibility();
		$this->biaya->setVisibility();
		$this->tempat->setVisibility();
		$this->target_peserta->setVisibility();
		$this->durasi1->setVisibility();
		$this->durasi2->setVisibility();
		$this->nmou->setVisibility();
		$this->nmou2->setVisibility();
		$this->statuspel->setVisibility();
		$this->hideFieldsForAddEdit();
		$this->kdpelat->Required = FALSE;
		$this->kdjudul->Required = FALSE;

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
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->kdkursil);
		$this->setupLookupOptions($this->kdkategori);
		$this->setupLookupOptions($this->kerjasama);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("v_kerjasamalist.php");
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
			if (Get("kdpelat") !== NULL) {
				$this->kdpelat->setQueryStringValue(Get("kdpelat"));
				$this->kdpelat->setOldValue($this->kdpelat->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->kdpelat->setQueryStringValue(Key(0));
				$this->kdpelat->setOldValue($this->kdpelat->QueryStringValue);
			} elseif (Post("kdpelat") !== NULL) {
				$this->kdpelat->setFormValue(Post("kdpelat"));
				$this->kdpelat->setOldValue($this->kdpelat->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->kdpelat->setQueryStringValue(Route(2));
				$this->kdpelat->setOldValue($this->kdpelat->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_kdpelat")) {
					$this->kdpelat->setFormValue($CurrentForm->getValue("x_kdpelat"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("kdpelat") !== NULL) {
					$this->kdpelat->setQueryStringValue(Get("kdpelat"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->kdpelat->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->kdpelat->CurrentValue = NULL;
				}
			}

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
					$this->terminate("v_kerjasamalist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = "v_kerjasamalist.php";
				if (GetPageName($returnUrl) == "v_kerjasamalist.php")
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
		$this->nmou->Upload->Index = $CurrentForm->Index;
		$this->nmou->Upload->uploadFile();
		$this->nmou->CurrentValue = $this->nmou->Upload->FileName;
		$this->nmou2->Upload->Index = $CurrentForm->Index;
		$this->nmou2->Upload->uploadFile();
		$this->nmou2->CurrentValue = $this->nmou2->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'kdpelat' first before field var 'x_kdpelat'
		$val = $CurrentForm->hasValue("kdpelat") ? $CurrentForm->getValue("kdpelat") : $CurrentForm->getValue("x_kdpelat");
		if (!$this->kdpelat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdpelat->Visible = FALSE; // Disable update for API request
			else
				$this->kdpelat->setFormValue($val);
		}

		// Check field name 'kdjudul' first before field var 'x_kdjudul'
		$val = $CurrentForm->hasValue("kdjudul") ? $CurrentForm->getValue("kdjudul") : $CurrentForm->getValue("x_kdjudul");
		if (!$this->kdjudul->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdjudul->Visible = FALSE; // Disable update for API request
			else
				$this->kdjudul->setFormValue($val);
		}

		// Check field name 'kdkursil' first before field var 'x_kdkursil'
		$val = $CurrentForm->hasValue("kdkursil") ? $CurrentForm->getValue("kdkursil") : $CurrentForm->getValue("x_kdkursil");
		if (!$this->kdkursil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkursil->Visible = FALSE; // Disable update for API request
			else
				$this->kdkursil->setFormValue($val);
		}

		// Check field name 'revisi' first before field var 'x_revisi'
		$val = $CurrentForm->hasValue("revisi") ? $CurrentForm->getValue("revisi") : $CurrentForm->getValue("x_revisi");
		if (!$this->revisi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->revisi->Visible = FALSE; // Disable update for API request
			else
				$this->revisi->setFormValue($val);
		}

		// Check field name 'tgl_terbit' first before field var 'x_tgl_terbit'
		$val = $CurrentForm->hasValue("tgl_terbit") ? $CurrentForm->getValue("tgl_terbit") : $CurrentForm->getValue("x_tgl_terbit");
		if (!$this->tgl_terbit->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_terbit->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_terbit->setFormValue($val);
			$this->tgl_terbit->CurrentValue = UnFormatDateTime($this->tgl_terbit->CurrentValue, 0);
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

		// Check field name 'biaya' first before field var 'x_biaya'
		$val = $CurrentForm->hasValue("biaya") ? $CurrentForm->getValue("biaya") : $CurrentForm->getValue("x_biaya");
		if (!$this->biaya->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->biaya->Visible = FALSE; // Disable update for API request
			else
				$this->biaya->setFormValue($val);
		}

		// Check field name 'tempat' first before field var 'x_tempat'
		$val = $CurrentForm->hasValue("tempat") ? $CurrentForm->getValue("tempat") : $CurrentForm->getValue("x_tempat");
		if (!$this->tempat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tempat->Visible = FALSE; // Disable update for API request
			else
				$this->tempat->setFormValue($val);
		}

		// Check field name 'target_peserta' first before field var 'x_target_peserta'
		$val = $CurrentForm->hasValue("target_peserta") ? $CurrentForm->getValue("target_peserta") : $CurrentForm->getValue("x_target_peserta");
		if (!$this->target_peserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->target_peserta->Visible = FALSE; // Disable update for API request
			else
				$this->target_peserta->setFormValue($val);
		}

		// Check field name 'durasi1' first before field var 'x_durasi1'
		$val = $CurrentForm->hasValue("durasi1") ? $CurrentForm->getValue("durasi1") : $CurrentForm->getValue("x_durasi1");
		if (!$this->durasi1->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->durasi1->Visible = FALSE; // Disable update for API request
			else
				$this->durasi1->setFormValue($val);
		}

		// Check field name 'durasi2' first before field var 'x_durasi2'
		$val = $CurrentForm->hasValue("durasi2") ? $CurrentForm->getValue("durasi2") : $CurrentForm->getValue("x_durasi2");
		if (!$this->durasi2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->durasi2->Visible = FALSE; // Disable update for API request
			else
				$this->durasi2->setFormValue($val);
		}

		// Check field name 'statuspel' first before field var 'x_statuspel'
		$val = $CurrentForm->hasValue("statuspel") ? $CurrentForm->getValue("statuspel") : $CurrentForm->getValue("x_statuspel");
		if (!$this->statuspel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->statuspel->Visible = FALSE; // Disable update for API request
			else
				$this->statuspel->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kdpelat->CurrentValue = $this->kdpelat->FormValue;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->kdkursil->CurrentValue = $this->kdkursil->FormValue;
		$this->revisi->CurrentValue = $this->revisi->FormValue;
		$this->tgl_terbit->CurrentValue = $this->tgl_terbit->FormValue;
		$this->tgl_terbit->CurrentValue = UnFormatDateTime($this->tgl_terbit->CurrentValue, 0);
		$this->tawal->CurrentValue = $this->tawal->FormValue;
		$this->tawal->CurrentValue = UnFormatDateTime($this->tawal->CurrentValue, 0);
		$this->takhir->CurrentValue = $this->takhir->FormValue;
		$this->takhir->CurrentValue = UnFormatDateTime($this->takhir->CurrentValue, 0);
		$this->jenispel->CurrentValue = $this->jenispel->FormValue;
		$this->kdkategori->CurrentValue = $this->kdkategori->FormValue;
		$this->kerjasama->CurrentValue = $this->kerjasama->FormValue;
		$this->biaya->CurrentValue = $this->biaya->FormValue;
		$this->tempat->CurrentValue = $this->tempat->FormValue;
		$this->target_peserta->CurrentValue = $this->target_peserta->FormValue;
		$this->durasi1->CurrentValue = $this->durasi1->FormValue;
		$this->durasi2->CurrentValue = $this->durasi2->FormValue;
		$this->statuspel->CurrentValue = $this->statuspel->FormValue;
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
		$this->tawal->setDbValue($row['tawal']);
		$this->takhir->setDbValue($row['takhir']);
		$this->jenispel->setDbValue($row['jenispel']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->kerjasama->setDbValue($row['kerjasama']);
		$this->biaya->setDbValue($row['biaya']);
		$this->tempat->setDbValue($row['tempat']);
		$this->target_peserta->setDbValue($row['target_peserta']);
		$this->durasi1->setDbValue($row['durasi1']);
		$this->durasi2->setDbValue($row['durasi2']);
		$this->nmou->Upload->DbValue = $row['nmou'];
		$this->nmou->setDbValue($this->nmou->Upload->DbValue);
		$this->nmou2->Upload->DbValue = $row['nmou2'];
		$this->nmou2->setDbValue($this->nmou2->Upload->DbValue);
		$this->statuspel->setDbValue($row['statuspel']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['kdpelat'] = NULL;
		$row['kdjudul'] = NULL;
		$row['kdkursil'] = NULL;
		$row['revisi'] = NULL;
		$row['tgl_terbit'] = NULL;
		$row['tawal'] = NULL;
		$row['takhir'] = NULL;
		$row['jenispel'] = NULL;
		$row['kdkategori'] = NULL;
		$row['kerjasama'] = NULL;
		$row['biaya'] = NULL;
		$row['tempat'] = NULL;
		$row['target_peserta'] = NULL;
		$row['durasi1'] = NULL;
		$row['durasi2'] = NULL;
		$row['nmou'] = NULL;
		$row['nmou2'] = NULL;
		$row['statuspel'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("kdpelat")) != "")
			$this->kdpelat->OldValue = $this->getKey("kdpelat"); // kdpelat
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

		if ($this->biaya->FormValue == $this->biaya->CurrentValue && is_numeric(ConvertToFloatString($this->biaya->CurrentValue)))
			$this->biaya->CurrentValue = ConvertToFloatString($this->biaya->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// kdpelat
		// kdjudul
		// kdkursil
		// revisi
		// tgl_terbit
		// tawal
		// takhir
		// jenispel
		// kdkategori
		// kerjasama
		// biaya
		// tempat
		// target_peserta
		// durasi1
		// durasi2
		// nmou
		// nmou2
		// statuspel

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// tawal
			$this->tawal->ViewValue = $this->tawal->CurrentValue;
			$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
			$this->tawal->ViewCustomAttributes = "";

			// takhir
			$this->takhir->ViewValue = $this->takhir->CurrentValue;
			$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
			$this->takhir->ViewCustomAttributes = "";

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

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// target_peserta
			$this->target_peserta->ViewValue = $this->target_peserta->CurrentValue;
			$this->target_peserta->ViewCustomAttributes = "";

			// durasi1
			$this->durasi1->ViewValue = $this->durasi1->CurrentValue;
			$this->durasi1->ViewCustomAttributes = "";

			// durasi2
			$this->durasi2->ViewValue = $this->durasi2->CurrentValue;
			$this->durasi2->ViewCustomAttributes = "";

			// nmou
			if (!EmptyValue($this->nmou->Upload->DbValue)) {
				$this->nmou->ViewValue = $this->nmou->Upload->DbValue;
			} else {
				$this->nmou->ViewValue = "";
			}
			$this->nmou->ViewCustomAttributes = "";

			// nmou2
			if (!EmptyValue($this->nmou2->Upload->DbValue)) {
				$this->nmou2->ViewValue = $this->nmou2->Upload->DbValue;
			} else {
				$this->nmou2->ViewValue = "";
			}
			$this->nmou2->ViewCustomAttributes = "";

			// statuspel
			if (strval($this->statuspel->CurrentValue) != "") {
				$this->statuspel->ViewValue = $this->statuspel->optionCaption($this->statuspel->CurrentValue);
			} else {
				$this->statuspel->ViewValue = NULL;
			}
			$this->statuspel->ViewCustomAttributes = "";

			// kdpelat
			$this->kdpelat->LinkCustomAttributes = "";
			$this->kdpelat->HrefValue = "";
			$this->kdpelat->TooltipValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";
			$this->kdkursil->TooltipValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";
			$this->revisi->TooltipValue = "";

			// tgl_terbit
			$this->tgl_terbit->LinkCustomAttributes = "";
			$this->tgl_terbit->HrefValue = "";
			$this->tgl_terbit->TooltipValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";
			$this->tawal->TooltipValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";
			$this->takhir->TooltipValue = "";

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

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";
			$this->biaya->TooltipValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// target_peserta
			$this->target_peserta->LinkCustomAttributes = "";
			$this->target_peserta->HrefValue = "";
			$this->target_peserta->TooltipValue = "";

			// durasi1
			$this->durasi1->LinkCustomAttributes = "";
			$this->durasi1->HrefValue = "";
			$this->durasi1->TooltipValue = "";

			// durasi2
			$this->durasi2->LinkCustomAttributes = "";
			$this->durasi2->HrefValue = "";
			$this->durasi2->TooltipValue = "";

			// nmou
			$this->nmou->LinkCustomAttributes = "";
			$this->nmou->HrefValue = "";
			$this->nmou->ExportHrefValue = $this->nmou->UploadPath . $this->nmou->Upload->DbValue;
			$this->nmou->TooltipValue = "";

			// nmou2
			$this->nmou2->LinkCustomAttributes = "";
			$this->nmou2->HrefValue = "";
			$this->nmou2->ExportHrefValue = $this->nmou2->UploadPath . $this->nmou2->Upload->DbValue;
			$this->nmou2->TooltipValue = "";

			// statuspel
			$this->statuspel->LinkCustomAttributes = "";
			$this->statuspel->HrefValue = "";
			$this->statuspel->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// kdpelat
			$this->kdpelat->EditAttrs["class"] = "form-control";
			$this->kdpelat->EditCustomAttributes = "";
			$this->kdpelat->EditValue = $this->kdpelat->CurrentValue;
			$this->kdpelat->ViewCustomAttributes = "";

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if ($this->kdjudul->VirtualValue != "") {
				$this->kdjudul->EditValue = $this->kdjudul->VirtualValue;
			} else {
				$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
				$curVal = strval($this->kdjudul->CurrentValue);
				if ($curVal != "") {
					$this->kdjudul->EditValue = $this->kdjudul->lookupCacheOption($curVal);
					if ($this->kdjudul->EditValue === NULL) { // Lookup from database
						$filterWrk = "`kdjudul`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->kdjudul->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdjudul->EditValue = $this->kdjudul->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
						}
					}
				} else {
					$this->kdjudul->EditValue = NULL;
				}
			}
			$this->kdjudul->ViewCustomAttributes = "";

			// kdkursil
			$this->kdkursil->EditAttrs["class"] = "form-control";
			$this->kdkursil->EditCustomAttributes = "";
			if (!$this->kdkursil->Raw)
				$this->kdkursil->CurrentValue = HtmlDecode($this->kdkursil->CurrentValue);
			$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->CurrentValue);
			$curVal = strval($this->kdkursil->CurrentValue);
			if ($curVal != "") {
				$this->kdkursil->EditValue = $this->kdkursil->lookupCacheOption($curVal);
				if ($this->kdkursil->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdkursil`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdkursil->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$arwrk[3] = HtmlEncode(FormatDateTime($rswrk->fields('df3'), 0));
						$this->kdkursil->EditValue = $this->kdkursil->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->CurrentValue);
					}
				}
			} else {
				$this->kdkursil->EditValue = NULL;
			}
			$this->kdkursil->PlaceHolder = RemoveHtml($this->kdkursil->caption());

			// revisi
			$this->revisi->EditAttrs["class"] = "form-control";
			$this->revisi->EditCustomAttributes = "";
			if (!$this->revisi->Raw)
				$this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
			$this->revisi->EditValue = HtmlEncode($this->revisi->CurrentValue);
			$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

			// tgl_terbit
			$this->tgl_terbit->EditAttrs["class"] = "form-control";
			$this->tgl_terbit->EditCustomAttributes = "";
			$this->tgl_terbit->EditValue = HtmlEncode(FormatDateTime($this->tgl_terbit->CurrentValue, 8));
			$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

			// tawal
			$this->tawal->EditAttrs["class"] = "form-control";
			$this->tawal->EditCustomAttributes = "";
			$this->tawal->EditValue = $this->tawal->CurrentValue;
			$this->tawal->EditValue = FormatDateTime($this->tawal->EditValue, 0);
			$this->tawal->ViewCustomAttributes = "";

			// takhir
			$this->takhir->EditAttrs["class"] = "form-control";
			$this->takhir->EditCustomAttributes = "";
			$this->takhir->EditValue = HtmlEncode(FormatDateTime($this->takhir->CurrentValue, 8));
			$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

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

			// biaya
			$this->biaya->EditAttrs["class"] = "form-control";
			$this->biaya->EditCustomAttributes = "";
			$this->biaya->EditValue = HtmlEncode($this->biaya->CurrentValue);
			$this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
			if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue))
				$this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -1, -2, 0);
			

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			if (!$this->tempat->Raw)
				$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
			$this->tempat->EditValue = HtmlEncode($this->tempat->CurrentValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// target_peserta
			$this->target_peserta->EditAttrs["class"] = "form-control";
			$this->target_peserta->EditCustomAttributes = "";
			if (!$this->target_peserta->Raw)
				$this->target_peserta->CurrentValue = HtmlDecode($this->target_peserta->CurrentValue);
			$this->target_peserta->EditValue = HtmlEncode($this->target_peserta->CurrentValue);
			$this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

			// durasi1
			$this->durasi1->EditAttrs["class"] = "form-control";
			$this->durasi1->EditCustomAttributes = "";
			if (!$this->durasi1->Raw)
				$this->durasi1->CurrentValue = HtmlDecode($this->durasi1->CurrentValue);
			$this->durasi1->EditValue = HtmlEncode($this->durasi1->CurrentValue);
			$this->durasi1->PlaceHolder = RemoveHtml($this->durasi1->caption());

			// durasi2
			$this->durasi2->EditAttrs["class"] = "form-control";
			$this->durasi2->EditCustomAttributes = "";
			if (!$this->durasi2->Raw)
				$this->durasi2->CurrentValue = HtmlDecode($this->durasi2->CurrentValue);
			$this->durasi2->EditValue = HtmlEncode($this->durasi2->CurrentValue);
			$this->durasi2->PlaceHolder = RemoveHtml($this->durasi2->caption());

			// nmou
			$this->nmou->EditAttrs["class"] = "form-control";
			$this->nmou->EditCustomAttributes = "";
			if (!EmptyValue($this->nmou->Upload->DbValue)) {
				$this->nmou->EditValue = $this->nmou->Upload->DbValue;
			} else {
				$this->nmou->EditValue = "";
			}
			if (!EmptyValue($this->nmou->CurrentValue))
					$this->nmou->Upload->FileName = $this->nmou->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->nmou);

			// nmou2
			$this->nmou2->EditAttrs["class"] = "form-control";
			$this->nmou2->EditCustomAttributes = "";
			if (!EmptyValue($this->nmou2->Upload->DbValue)) {
				$this->nmou2->EditValue = $this->nmou2->Upload->DbValue;
			} else {
				$this->nmou2->EditValue = "";
			}
			if (!EmptyValue($this->nmou2->CurrentValue))
					$this->nmou2->Upload->FileName = $this->nmou2->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->nmou2);

			// statuspel
			$this->statuspel->EditAttrs["class"] = "form-control";
			$this->statuspel->EditCustomAttributes = "";
			$this->statuspel->EditValue = $this->statuspel->options(TRUE);

			// Edit refer script
			// kdpelat

			$this->kdpelat->LinkCustomAttributes = "";
			$this->kdpelat->HrefValue = "";
			$this->kdpelat->TooltipValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";

			// tgl_terbit
			$this->tgl_terbit->LinkCustomAttributes = "";
			$this->tgl_terbit->HrefValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";
			$this->tawal->TooltipValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";

			// target_peserta
			$this->target_peserta->LinkCustomAttributes = "";
			$this->target_peserta->HrefValue = "";

			// durasi1
			$this->durasi1->LinkCustomAttributes = "";
			$this->durasi1->HrefValue = "";

			// durasi2
			$this->durasi2->LinkCustomAttributes = "";
			$this->durasi2->HrefValue = "";

			// nmou
			$this->nmou->LinkCustomAttributes = "";
			$this->nmou->HrefValue = "";
			$this->nmou->ExportHrefValue = $this->nmou->UploadPath . $this->nmou->Upload->DbValue;

			// nmou2
			$this->nmou2->LinkCustomAttributes = "";
			$this->nmou2->HrefValue = "";
			$this->nmou2->ExportHrefValue = $this->nmou2->UploadPath . $this->nmou2->Upload->DbValue;

			// statuspel
			$this->statuspel->LinkCustomAttributes = "";
			$this->statuspel->HrefValue = "";
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
		if ($this->kdpelat->Required) {
			if (!$this->kdpelat->IsDetailKey && $this->kdpelat->FormValue != NULL && $this->kdpelat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdpelat->caption(), $this->kdpelat->RequiredErrorMessage));
			}
		}
		if ($this->kdjudul->Required) {
			if (!$this->kdjudul->IsDetailKey && $this->kdjudul->FormValue != NULL && $this->kdjudul->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdjudul->caption(), $this->kdjudul->RequiredErrorMessage));
			}
		}
		if ($this->kdkursil->Required) {
			if (!$this->kdkursil->IsDetailKey && $this->kdkursil->FormValue != NULL && $this->kdkursil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkursil->caption(), $this->kdkursil->RequiredErrorMessage));
			}
		}
		if ($this->revisi->Required) {
			if (!$this->revisi->IsDetailKey && $this->revisi->FormValue != NULL && $this->revisi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revisi->caption(), $this->revisi->RequiredErrorMessage));
			}
		}
		if ($this->tgl_terbit->Required) {
			if (!$this->tgl_terbit->IsDetailKey && $this->tgl_terbit->FormValue != NULL && $this->tgl_terbit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_terbit->caption(), $this->tgl_terbit->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_terbit->FormValue)) {
			AddMessage($FormError, $this->tgl_terbit->errorMessage());
		}
		if ($this->tawal->Required) {
			if (!$this->tawal->IsDetailKey && $this->tawal->FormValue != NULL && $this->tawal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tawal->caption(), $this->tawal->RequiredErrorMessage));
			}
		}
		if ($this->takhir->Required) {
			if (!$this->takhir->IsDetailKey && $this->takhir->FormValue != NULL && $this->takhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->takhir->caption(), $this->takhir->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->takhir->FormValue)) {
			AddMessage($FormError, $this->takhir->errorMessage());
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
		if ($this->biaya->Required) {
			if (!$this->biaya->IsDetailKey && $this->biaya->FormValue != NULL && $this->biaya->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->biaya->caption(), $this->biaya->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->biaya->FormValue)) {
			AddMessage($FormError, $this->biaya->errorMessage());
		}
		if ($this->tempat->Required) {
			if (!$this->tempat->IsDetailKey && $this->tempat->FormValue != NULL && $this->tempat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tempat->caption(), $this->tempat->RequiredErrorMessage));
			}
		}
		if ($this->target_peserta->Required) {
			if (!$this->target_peserta->IsDetailKey && $this->target_peserta->FormValue != NULL && $this->target_peserta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->target_peserta->caption(), $this->target_peserta->RequiredErrorMessage));
			}
		}
		if ($this->durasi1->Required) {
			if (!$this->durasi1->IsDetailKey && $this->durasi1->FormValue != NULL && $this->durasi1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->durasi1->caption(), $this->durasi1->RequiredErrorMessage));
			}
		}
		if ($this->durasi2->Required) {
			if (!$this->durasi2->IsDetailKey && $this->durasi2->FormValue != NULL && $this->durasi2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->durasi2->caption(), $this->durasi2->RequiredErrorMessage));
			}
		}
		if ($this->nmou->Required) {
			if ($this->nmou->Upload->FileName == "" && !$this->nmou->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->nmou->caption(), $this->nmou->RequiredErrorMessage));
			}
		}
		if ($this->nmou2->Required) {
			if ($this->nmou2->Upload->FileName == "" && !$this->nmou2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->nmou2->caption(), $this->nmou2->RequiredErrorMessage));
			}
		}
		if ($this->statuspel->Required) {
			if (!$this->statuspel->IsDetailKey && $this->statuspel->FormValue != NULL && $this->statuspel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->statuspel->caption(), $this->statuspel->RequiredErrorMessage));
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

			// kdkursil
			$this->kdkursil->setDbValueDef($rsnew, $this->kdkursil->CurrentValue, NULL, $this->kdkursil->ReadOnly);

			// revisi
			$this->revisi->setDbValueDef($rsnew, $this->revisi->CurrentValue, NULL, $this->revisi->ReadOnly);

			// tgl_terbit
			$this->tgl_terbit->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_terbit->CurrentValue, 0), NULL, $this->tgl_terbit->ReadOnly);

			// takhir
			$this->takhir->setDbValueDef($rsnew, UnFormatDateTime($this->takhir->CurrentValue, 0), NULL, $this->takhir->ReadOnly);

			// jenispel
			$this->jenispel->setDbValueDef($rsnew, $this->jenispel->CurrentValue, NULL, $this->jenispel->ReadOnly);

			// kdkategori
			$this->kdkategori->setDbValueDef($rsnew, $this->kdkategori->CurrentValue, NULL, $this->kdkategori->ReadOnly);

			// kerjasama
			$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, NULL, $this->kerjasama->ReadOnly);

			// biaya
			$this->biaya->setDbValueDef($rsnew, $this->biaya->CurrentValue, NULL, $this->biaya->ReadOnly);

			// tempat
			$this->tempat->setDbValueDef($rsnew, $this->tempat->CurrentValue, NULL, $this->tempat->ReadOnly);

			// target_peserta
			$this->target_peserta->setDbValueDef($rsnew, $this->target_peserta->CurrentValue, NULL, $this->target_peserta->ReadOnly);

			// durasi1
			$this->durasi1->setDbValueDef($rsnew, $this->durasi1->CurrentValue, NULL, $this->durasi1->ReadOnly);

			// durasi2
			$this->durasi2->setDbValueDef($rsnew, $this->durasi2->CurrentValue, NULL, $this->durasi2->ReadOnly);

			// nmou
			if ($this->nmou->Visible && !$this->nmou->ReadOnly && !$this->nmou->Upload->KeepFile) {
				$this->nmou->Upload->DbValue = $rsold['nmou']; // Get original value
				if ($this->nmou->Upload->FileName == "") {
					$rsnew['nmou'] = NULL;
				} else {
					$rsnew['nmou'] = $this->nmou->Upload->FileName;
				}
			}

			// nmou2
			if ($this->nmou2->Visible && !$this->nmou2->ReadOnly && !$this->nmou2->Upload->KeepFile) {
				$this->nmou2->Upload->DbValue = $rsold['nmou2']; // Get original value
				if ($this->nmou2->Upload->FileName == "") {
					$rsnew['nmou2'] = NULL;
				} else {
					$rsnew['nmou2'] = $this->nmou2->Upload->FileName;
				}
			}

			// statuspel
			$this->statuspel->setDbValueDef($rsnew, $this->statuspel->CurrentValue, NULL, $this->statuspel->ReadOnly);
			if ($this->nmou->Visible && !$this->nmou->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->nmou->Upload->DbValue) ? [] : [$this->nmou->htmlDecode($this->nmou->Upload->DbValue)];
				if (!EmptyValue($this->nmou->Upload->FileName)) {
					$newFiles = [$this->nmou->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->nmou, $this->nmou->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->nmou->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->nmou->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->nmou->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->nmou->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->nmou->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->nmou->setDbValueDef($rsnew, $this->nmou->Upload->FileName, NULL, $this->nmou->ReadOnly);
				}
			}
			if ($this->nmou2->Visible && !$this->nmou2->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->nmou2->Upload->DbValue) ? [] : [$this->nmou2->htmlDecode($this->nmou2->Upload->DbValue)];
				if (!EmptyValue($this->nmou2->Upload->FileName)) {
					$newFiles = [$this->nmou2->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->nmou2, $this->nmou2->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->nmou2->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->nmou2->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->nmou2->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->nmou2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->nmou2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->nmou2->setDbValueDef($rsnew, $this->nmou2->Upload->FileName, NULL, $this->nmou2->ReadOnly);
				}
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
					if ($this->nmou->Visible && !$this->nmou->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->nmou->Upload->DbValue) ? [] : [$this->nmou->htmlDecode($this->nmou->Upload->DbValue)];
						if (!EmptyValue($this->nmou->Upload->FileName)) {
							$newFiles = [$this->nmou->Upload->FileName];
							$newFiles2 = [$this->nmou->htmlDecode($rsnew['nmou'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->nmou, $this->nmou->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->nmou->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->nmou->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->nmou2->Visible && !$this->nmou2->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->nmou2->Upload->DbValue) ? [] : [$this->nmou2->htmlDecode($this->nmou2->Upload->DbValue)];
						if (!EmptyValue($this->nmou2->Upload->FileName)) {
							$newFiles = [$this->nmou2->Upload->FileName];
							$newFiles2 = [$this->nmou2->htmlDecode($rsnew['nmou2'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->nmou2, $this->nmou2->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->nmou2->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->nmou2->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
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

			// nmou
			CleanUploadTempPath($this->nmou, $this->nmou->Upload->Index);

			// nmou2
			CleanUploadTempPath($this->nmou2, $this->nmou2->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("v_kerjasamalist.php"), "", $this->TableVar, TRUE);
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
				case "x_kdjudul":
					break;
				case "x_kdkursil":
					break;
				case "x_jenispel":
					break;
				case "x_kdkategori":
					break;
				case "x_kerjasama":
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

		$this->revisi->ReadOnly = TRUE;
		$this->tgl_terbit->ReadOnly = TRUE;
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