<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_judul_edit extends t_judul
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_judul';

	// Page object name
	public $PageObjName = "t_judul_edit";

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

		// Table object (t_judul)
		if (!isset($GLOBALS["t_judul"]) || get_class($GLOBALS["t_judul"]) == PROJECT_NAMESPACE . "t_judul") {
			$GLOBALS["t_judul"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_judul"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_judul');

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
		global $t_judul;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_judul);
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
					if ($pageName == "t_judulview.php")
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
			$key .= @$ar['kdjudul'];
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
					$this->terminate(GetUrl("t_judullist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->kdjudul->setVisibility();
		$this->kdbidang->setVisibility();
		$this->judul->setVisibility();
		$this->singkatan->setVisibility();
		$this->created_at->setVisibility();
		$this->user_created_by->setVisibility();
		$this->updated_at->setVisibility();
		$this->user_updated_by->setVisibility();
		$this->hideFieldsForAddEdit();
		$this->kdjudul->Required = FALSE;
		$this->kdbidang->Required = FALSE;

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
		$this->setupLookupOptions($this->kdbidang);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_judullist.php");
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
			if (Get("kdjudul") !== NULL) {
				$this->kdjudul->setQueryStringValue(Get("kdjudul"));
				$this->kdjudul->setOldValue($this->kdjudul->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->kdjudul->setQueryStringValue(Key(0));
				$this->kdjudul->setOldValue($this->kdjudul->QueryStringValue);
			} elseif (Post("kdjudul") !== NULL) {
				$this->kdjudul->setFormValue(Post("kdjudul"));
				$this->kdjudul->setOldValue($this->kdjudul->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->kdjudul->setQueryStringValue(Route(2));
				$this->kdjudul->setOldValue($this->kdjudul->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_kdjudul")) {
					$this->kdjudul->setFormValue($CurrentForm->getValue("x_kdjudul"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("kdjudul") !== NULL) {
					$this->kdjudul->setQueryStringValue(Get("kdjudul"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->kdjudul->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->kdjudul->CurrentValue = NULL;
				}
			}

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
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
					$this->terminate("t_judullist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_judullist.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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

		// Check field name 'kdjudul' first before field var 'x_kdjudul'
		$val = $CurrentForm->hasValue("kdjudul") ? $CurrentForm->getValue("kdjudul") : $CurrentForm->getValue("x_kdjudul");
		if (!$this->kdjudul->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdjudul->Visible = FALSE; // Disable update for API request
			else
				$this->kdjudul->setFormValue($val);
		}

		// Check field name 'kdbidang' first before field var 'x_kdbidang'
		$val = $CurrentForm->hasValue("kdbidang") ? $CurrentForm->getValue("kdbidang") : $CurrentForm->getValue("x_kdbidang");
		if (!$this->kdbidang->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdbidang->Visible = FALSE; // Disable update for API request
			else
				$this->kdbidang->setFormValue($val);
		}

		// Check field name 'judul' first before field var 'x_judul'
		$val = $CurrentForm->hasValue("judul") ? $CurrentForm->getValue("judul") : $CurrentForm->getValue("x_judul");
		if (!$this->judul->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->judul->Visible = FALSE; // Disable update for API request
			else
				$this->judul->setFormValue($val);
		}

		// Check field name 'singkatan' first before field var 'x_singkatan'
		$val = $CurrentForm->hasValue("singkatan") ? $CurrentForm->getValue("singkatan") : $CurrentForm->getValue("x_singkatan");
		if (!$this->singkatan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->singkatan->Visible = FALSE; // Disable update for API request
			else
				$this->singkatan->setFormValue($val);
		}

		// Check field name 'created_at' first before field var 'x_created_at'
		$val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
		if (!$this->created_at->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->created_at->Visible = FALSE; // Disable update for API request
			else
				$this->created_at->setFormValue($val);
			$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
		}

		// Check field name 'user_created_by' first before field var 'x_user_created_by'
		$val = $CurrentForm->hasValue("user_created_by") ? $CurrentForm->getValue("user_created_by") : $CurrentForm->getValue("x_user_created_by");
		if (!$this->user_created_by->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->user_created_by->Visible = FALSE; // Disable update for API request
			else
				$this->user_created_by->setFormValue($val);
		}

		// Check field name 'updated_at' first before field var 'x_updated_at'
		$val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
		if (!$this->updated_at->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->updated_at->Visible = FALSE; // Disable update for API request
			else
				$this->updated_at->setFormValue($val);
			$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
		}

		// Check field name 'user_updated_by' first before field var 'x_user_updated_by'
		$val = $CurrentForm->hasValue("user_updated_by") ? $CurrentForm->getValue("user_updated_by") : $CurrentForm->getValue("x_user_updated_by");
		if (!$this->user_updated_by->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->user_updated_by->Visible = FALSE; // Disable update for API request
			else
				$this->user_updated_by->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->kdbidang->CurrentValue = $this->kdbidang->FormValue;
		$this->judul->CurrentValue = $this->judul->FormValue;
		$this->singkatan->CurrentValue = $this->singkatan->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
		$this->user_created_by->CurrentValue = $this->user_created_by->FormValue;
		$this->updated_at->CurrentValue = $this->updated_at->FormValue;
		$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
		$this->user_updated_by->CurrentValue = $this->user_updated_by->FormValue;
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
		$this->kdjudul->setDbValue($row['kdjudul']);
		$this->kdbidang->setDbValue($row['kdbidang']);
		$this->judul->setDbValue($row['judul']);
		$this->singkatan->setDbValue($row['singkatan']);
		$this->created_at->setDbValue($row['created_at']);
		$this->user_created_by->setDbValue($row['user_created_by']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->user_updated_by->setDbValue($row['user_updated_by']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['kdjudul'] = NULL;
		$row['kdbidang'] = NULL;
		$row['judul'] = NULL;
		$row['singkatan'] = NULL;
		$row['created_at'] = NULL;
		$row['user_created_by'] = NULL;
		$row['updated_at'] = NULL;
		$row['user_updated_by'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("kdjudul")) != "")
			$this->kdjudul->OldValue = $this->getKey("kdjudul"); // kdjudul
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
		// kdjudul
		// kdbidang
		// judul
		// singkatan
		// created_at
		// user_created_by
		// updated_at
		// user_updated_by

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kdjudul
			$this->kdjudul->ViewValue = $this->kdjudul->CurrentValue;
			$this->kdjudul->ViewCustomAttributes = "";

			// kdbidang
			$curVal = strval($this->kdbidang->CurrentValue);
			if ($curVal != "") {
				$this->kdbidang->ViewValue = $this->kdbidang->lookupCacheOption($curVal);
				if ($this->kdbidang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdbidang`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdbidang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdbidang->ViewValue = $this->kdbidang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdbidang->ViewValue = $this->kdbidang->CurrentValue;
					}
				}
			} else {
				$this->kdbidang->ViewValue = NULL;
			}
			$this->kdbidang->ViewCustomAttributes = "";

			// judul
			$this->judul->ViewValue = $this->judul->CurrentValue;
			$this->judul->ViewCustomAttributes = "";

			// singkatan
			$this->singkatan->ViewValue = $this->singkatan->CurrentValue;
			$this->singkatan->ViewCustomAttributes = "";

			// created_at
			$this->created_at->ViewValue = $this->created_at->CurrentValue;
			$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
			$this->created_at->ViewCustomAttributes = "";

			// user_created_by
			$this->user_created_by->ViewValue = $this->user_created_by->CurrentValue;
			$this->user_created_by->ViewCustomAttributes = "";

			// updated_at
			$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
			$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
			$this->updated_at->ViewCustomAttributes = "";

			// user_updated_by
			$this->user_updated_by->ViewValue = $this->user_updated_by->CurrentValue;
			$this->user_updated_by->ViewCustomAttributes = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdbidang
			$this->kdbidang->LinkCustomAttributes = "";
			$this->kdbidang->HrefValue = "";
			$this->kdbidang->TooltipValue = "";

			// judul
			$this->judul->LinkCustomAttributes = "";
			$this->judul->HrefValue = "";
			$this->judul->TooltipValue = "";

			// singkatan
			$this->singkatan->LinkCustomAttributes = "";
			$this->singkatan->HrefValue = "";
			$this->singkatan->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// user_created_by
			$this->user_created_by->LinkCustomAttributes = "";
			$this->user_created_by->HrefValue = "";
			$this->user_created_by->TooltipValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";

			// user_updated_by
			$this->user_updated_by->LinkCustomAttributes = "";
			$this->user_updated_by->HrefValue = "";
			$this->user_updated_by->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
			$this->kdjudul->ViewCustomAttributes = "";

			// kdbidang
			$this->kdbidang->EditAttrs["class"] = "form-control";
			$this->kdbidang->EditCustomAttributes = "";
			$curVal = strval($this->kdbidang->CurrentValue);
			if ($curVal != "") {
				$this->kdbidang->EditValue = $this->kdbidang->lookupCacheOption($curVal);
				if ($this->kdbidang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdbidang`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdbidang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdbidang->EditValue = $this->kdbidang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdbidang->EditValue = $this->kdbidang->CurrentValue;
					}
				}
			} else {
				$this->kdbidang->EditValue = NULL;
			}
			$this->kdbidang->ViewCustomAttributes = "";

			// judul
			$this->judul->EditAttrs["class"] = "form-control";
			$this->judul->EditCustomAttributes = "";
			if (!$this->judul->Raw)
				$this->judul->CurrentValue = HtmlDecode($this->judul->CurrentValue);
			$this->judul->EditValue = HtmlEncode($this->judul->CurrentValue);
			$this->judul->PlaceHolder = RemoveHtml($this->judul->caption());

			// singkatan
			$this->singkatan->EditAttrs["class"] = "form-control";
			$this->singkatan->EditCustomAttributes = "";
			if (!$this->singkatan->Raw)
				$this->singkatan->CurrentValue = HtmlDecode($this->singkatan->CurrentValue);
			$this->singkatan->EditValue = HtmlEncode($this->singkatan->CurrentValue);
			$this->singkatan->PlaceHolder = RemoveHtml($this->singkatan->caption());

			// created_at
			// user_created_by
			// updated_at
			// user_updated_by
			// Edit refer script
			// kdjudul

			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdbidang
			$this->kdbidang->LinkCustomAttributes = "";
			$this->kdbidang->HrefValue = "";
			$this->kdbidang->TooltipValue = "";

			// judul
			$this->judul->LinkCustomAttributes = "";
			$this->judul->HrefValue = "";

			// singkatan
			$this->singkatan->LinkCustomAttributes = "";
			$this->singkatan->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";

			// user_created_by
			$this->user_created_by->LinkCustomAttributes = "";
			$this->user_created_by->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";

			// user_updated_by
			$this->user_updated_by->LinkCustomAttributes = "";
			$this->user_updated_by->HrefValue = "";
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
		if ($this->kdjudul->Required) {
			if (!$this->kdjudul->IsDetailKey && $this->kdjudul->FormValue != NULL && $this->kdjudul->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdjudul->caption(), $this->kdjudul->RequiredErrorMessage));
			}
		}
		if ($this->kdbidang->Required) {
			if (!$this->kdbidang->IsDetailKey && $this->kdbidang->FormValue != NULL && $this->kdbidang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdbidang->caption(), $this->kdbidang->RequiredErrorMessage));
			}
		}
		if ($this->judul->Required) {
			if (!$this->judul->IsDetailKey && $this->judul->FormValue != NULL && $this->judul->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->judul->caption(), $this->judul->RequiredErrorMessage));
			}
		}
		if ($this->singkatan->Required) {
			if (!$this->singkatan->IsDetailKey && $this->singkatan->FormValue != NULL && $this->singkatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->singkatan->caption(), $this->singkatan->RequiredErrorMessage));
			}
		}
		if ($this->created_at->Required) {
			if (!$this->created_at->IsDetailKey && $this->created_at->FormValue != NULL && $this->created_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
			}
		}
		if ($this->user_created_by->Required) {
			if (!$this->user_created_by->IsDetailKey && $this->user_created_by->FormValue != NULL && $this->user_created_by->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_created_by->caption(), $this->user_created_by->RequiredErrorMessage));
			}
		}
		if ($this->updated_at->Required) {
			if (!$this->updated_at->IsDetailKey && $this->updated_at->FormValue != NULL && $this->updated_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
			}
		}
		if ($this->user_updated_by->Required) {
			if (!$this->user_updated_by->IsDetailKey && $this->user_updated_by->FormValue != NULL && $this->user_updated_by->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_updated_by->caption(), $this->user_updated_by->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t_juduldetail", $detailTblVar) && $GLOBALS["t_juduldetail"]->DetailEdit) {
			if (!isset($GLOBALS["t_juduldetail_grid"]))
				$GLOBALS["t_juduldetail_grid"] = new t_juduldetail_grid(); // Get detail page object
			$GLOBALS["t_juduldetail_grid"]->validateGridForm();
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

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// judul
			$this->judul->setDbValueDef($rsnew, $this->judul->CurrentValue, NULL, $this->judul->ReadOnly);

			// singkatan
			$this->singkatan->setDbValueDef($rsnew, $this->singkatan->CurrentValue, NULL, $this->singkatan->ReadOnly);

			// created_at
			$this->created_at->CurrentValue = CurrentDateTime();
			$this->created_at->setDbValueDef($rsnew, $this->created_at->CurrentValue, NULL);

			// user_created_by
			$this->user_created_by->CurrentValue = CurrentUserName();
			$this->user_created_by->setDbValueDef($rsnew, $this->user_created_by->CurrentValue, NULL);

			// updated_at
			$this->updated_at->CurrentValue = CurrentDateTime();
			$this->updated_at->setDbValueDef($rsnew, $this->updated_at->CurrentValue, NULL);

			// user_updated_by
			$this->user_updated_by->CurrentValue = CurrentUserName();
			$this->user_updated_by->setDbValueDef($rsnew, $this->user_updated_by->CurrentValue, NULL);

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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("t_juduldetail", $detailTblVar) && $GLOBALS["t_juduldetail"]->DetailEdit) {
						if (!isset($GLOBALS["t_juduldetail_grid"]))
							$GLOBALS["t_juduldetail_grid"] = new t_juduldetail_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "t_juduldetail"); // Load user level of detail table
						$editRow = $GLOBALS["t_juduldetail_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
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
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("t_juduldetail", $detailTblVar)) {
				if (!isset($GLOBALS["t_juduldetail_grid"]))
					$GLOBALS["t_juduldetail_grid"] = new t_juduldetail_grid();
				if ($GLOBALS["t_juduldetail_grid"]->DetailEdit) {
					$GLOBALS["t_juduldetail_grid"]->CurrentMode = "edit";
					$GLOBALS["t_juduldetail_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t_juduldetail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_juduldetail_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_juduldetail_grid"]->kdjudul->IsDetailKey = TRUE;
					$GLOBALS["t_juduldetail_grid"]->kdjudul->CurrentValue = $this->kdjudul->CurrentValue;
					$GLOBALS["t_juduldetail_grid"]->kdjudul->setSessionValue($GLOBALS["t_juduldetail_grid"]->kdjudul->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_judullist.php"), "", $this->TableVar, TRUE);
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
				case "x_kdbidang":
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
						case "x_kdbidang":
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