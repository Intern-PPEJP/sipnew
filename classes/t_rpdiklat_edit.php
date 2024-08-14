<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_rpdiklat_edit extends t_rpdiklat
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_rpdiklat';

	// Page object name
	public $PageObjName = "t_rpdiklat_edit";

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

		// Table object (t_rpdiklat)
		if (!isset($GLOBALS["t_rpdiklat"]) || get_class($GLOBALS["t_rpdiklat"]) == PROJECT_NAMESPACE . "t_rpdiklat") {
			$GLOBALS["t_rpdiklat"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_rpdiklat"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_rpdiklat');

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
		global $t_rpdiklat;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_rpdiklat);
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
					if ($pageName == "t_rpdiklatview.php")
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
			$key .= @$ar['rpdid'];
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
			$this->rpdid->Visible = FALSE;
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
					$this->terminate(GetUrl("t_rpdiklatlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->rpdid->Visible = FALSE;
		$this->kdjudul->setVisibility();
		$this->kdbidang->setVisibility();
		$this->kdkursil->setVisibility();
		$this->iso->setVisibility();
		$this->tempat->setVisibility();
		$this->jml_hari->setVisibility();
		$this->jenisdurasi->setVisibility();
		$this->targetpes->setVisibility();
		$this->angkatan->setVisibility();
		$this->sisa_angkatan->Visible = FALSE;
		$this->harga_satuan->setVisibility();
		$this->hargatotal->Visible = FALSE;
		$this->tglrevisi->setVisibility();
		$this->tahun_rencana->setVisibility();
		$this->hideFieldsForAddEdit();
		$this->kdjudul->Required = FALSE;
		$this->kdbidang->Required = FALSE;
		$this->tempat->Required = FALSE;

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
		$this->setupLookupOptions($this->kdbidang);
		$this->setupLookupOptions($this->kdkursil);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_rpdiklatlist.php");
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
			if (Get("rpdid") !== NULL) {
				$this->rpdid->setQueryStringValue(Get("rpdid"));
				$this->rpdid->setOldValue($this->rpdid->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->rpdid->setQueryStringValue(Key(0));
				$this->rpdid->setOldValue($this->rpdid->QueryStringValue);
			} elseif (Post("rpdid") !== NULL) {
				$this->rpdid->setFormValue(Post("rpdid"));
				$this->rpdid->setOldValue($this->rpdid->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->rpdid->setQueryStringValue(Route(2));
				$this->rpdid->setOldValue($this->rpdid->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_rpdid")) {
					$this->rpdid->setFormValue($CurrentForm->getValue("x_rpdid"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("rpdid") !== NULL) {
					$this->rpdid->setQueryStringValue(Get("rpdid"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->rpdid->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->rpdid->CurrentValue = NULL;
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
					$this->terminate("t_rpdiklatlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_rpdiklatlist.php")
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

		// Check field name 'kdkursil' first before field var 'x_kdkursil'
		$val = $CurrentForm->hasValue("kdkursil") ? $CurrentForm->getValue("kdkursil") : $CurrentForm->getValue("x_kdkursil");
		if (!$this->kdkursil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkursil->Visible = FALSE; // Disable update for API request
			else
				$this->kdkursil->setFormValue($val);
		}

		// Check field name 'iso' first before field var 'x_iso'
		$val = $CurrentForm->hasValue("iso") ? $CurrentForm->getValue("iso") : $CurrentForm->getValue("x_iso");
		if (!$this->iso->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->iso->Visible = FALSE; // Disable update for API request
			else
				$this->iso->setFormValue($val);
		}

		// Check field name 'tempat' first before field var 'x_tempat'
		$val = $CurrentForm->hasValue("tempat") ? $CurrentForm->getValue("tempat") : $CurrentForm->getValue("x_tempat");
		if (!$this->tempat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tempat->Visible = FALSE; // Disable update for API request
			else
				$this->tempat->setFormValue($val);
		}

		// Check field name 'jml_hari' first before field var 'x_jml_hari'
		$val = $CurrentForm->hasValue("jml_hari") ? $CurrentForm->getValue("jml_hari") : $CurrentForm->getValue("x_jml_hari");
		if (!$this->jml_hari->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_hari->Visible = FALSE; // Disable update for API request
			else
				$this->jml_hari->setFormValue($val);
		}

		// Check field name 'jenisdurasi' first before field var 'x_jenisdurasi'
		$val = $CurrentForm->hasValue("jenisdurasi") ? $CurrentForm->getValue("jenisdurasi") : $CurrentForm->getValue("x_jenisdurasi");
		if (!$this->jenisdurasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenisdurasi->Visible = FALSE; // Disable update for API request
			else
				$this->jenisdurasi->setFormValue($val);
		}

		// Check field name 'targetpes' first before field var 'x_targetpes'
		$val = $CurrentForm->hasValue("targetpes") ? $CurrentForm->getValue("targetpes") : $CurrentForm->getValue("x_targetpes");
		if (!$this->targetpes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes->setFormValue($val);
		}

		// Check field name 'angkatan' first before field var 'x_angkatan'
		$val = $CurrentForm->hasValue("angkatan") ? $CurrentForm->getValue("angkatan") : $CurrentForm->getValue("x_angkatan");
		if (!$this->angkatan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->angkatan->Visible = FALSE; // Disable update for API request
			else
				$this->angkatan->setFormValue($val);
		}

		// Check field name 'harga_satuan' first before field var 'x_harga_satuan'
		$val = $CurrentForm->hasValue("harga_satuan") ? $CurrentForm->getValue("harga_satuan") : $CurrentForm->getValue("x_harga_satuan");
		if (!$this->harga_satuan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->harga_satuan->Visible = FALSE; // Disable update for API request
			else
				$this->harga_satuan->setFormValue($val);
		}

		// Check field name 'tglrevisi' first before field var 'x_tglrevisi'
		$val = $CurrentForm->hasValue("tglrevisi") ? $CurrentForm->getValue("tglrevisi") : $CurrentForm->getValue("x_tglrevisi");
		if (!$this->tglrevisi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglrevisi->Visible = FALSE; // Disable update for API request
			else
				$this->tglrevisi->setFormValue($val);
			$this->tglrevisi->CurrentValue = UnFormatDateTime($this->tglrevisi->CurrentValue, 0);
		}

		// Check field name 'tahun_rencana' first before field var 'x_tahun_rencana'
		$val = $CurrentForm->hasValue("tahun_rencana") ? $CurrentForm->getValue("tahun_rencana") : $CurrentForm->getValue("x_tahun_rencana");
		if (!$this->tahun_rencana->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tahun_rencana->Visible = FALSE; // Disable update for API request
			else
				$this->tahun_rencana->setFormValue($val);
		}

		// Check field name 'rpdid' first before field var 'x_rpdid'
		$val = $CurrentForm->hasValue("rpdid") ? $CurrentForm->getValue("rpdid") : $CurrentForm->getValue("x_rpdid");
		if (!$this->rpdid->IsDetailKey)
			$this->rpdid->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->rpdid->CurrentValue = $this->rpdid->FormValue;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->kdbidang->CurrentValue = $this->kdbidang->FormValue;
		$this->kdkursil->CurrentValue = $this->kdkursil->FormValue;
		$this->iso->CurrentValue = $this->iso->FormValue;
		$this->tempat->CurrentValue = $this->tempat->FormValue;
		$this->jml_hari->CurrentValue = $this->jml_hari->FormValue;
		$this->jenisdurasi->CurrentValue = $this->jenisdurasi->FormValue;
		$this->targetpes->CurrentValue = $this->targetpes->FormValue;
		$this->angkatan->CurrentValue = $this->angkatan->FormValue;
		$this->harga_satuan->CurrentValue = $this->harga_satuan->FormValue;
		$this->tglrevisi->CurrentValue = $this->tglrevisi->FormValue;
		$this->tglrevisi->CurrentValue = UnFormatDateTime($this->tglrevisi->CurrentValue, 0);
		$this->tahun_rencana->CurrentValue = $this->tahun_rencana->FormValue;
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
		$this->rpdid->setDbValue($row['rpdid']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->kdbidang->setDbValue($row['kdbidang']);
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->iso->setDbValue($row['iso']);
		$this->tempat->setDbValue($row['tempat']);
		$this->jml_hari->setDbValue($row['jml_hari']);
		$this->jenisdurasi->setDbValue($row['jenisdurasi']);
		$this->targetpes->setDbValue($row['targetpes']);
		$this->angkatan->setDbValue($row['angkatan']);
		$this->sisa_angkatan->setDbValue($row['sisa_angkatan']);
		$this->harga_satuan->setDbValue($row['harga_satuan']);
		$this->hargatotal->setDbValue($row['hargatotal']);
		$this->tglrevisi->setDbValue($row['tglrevisi']);
		$this->tahun_rencana->setDbValue($row['tahun_rencana']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['rpdid'] = NULL;
		$row['kdjudul'] = NULL;
		$row['kdbidang'] = NULL;
		$row['kdkursil'] = NULL;
		$row['iso'] = NULL;
		$row['tempat'] = NULL;
		$row['jml_hari'] = NULL;
		$row['jenisdurasi'] = NULL;
		$row['targetpes'] = NULL;
		$row['angkatan'] = NULL;
		$row['sisa_angkatan'] = NULL;
		$row['harga_satuan'] = NULL;
		$row['hargatotal'] = NULL;
		$row['tglrevisi'] = NULL;
		$row['tahun_rencana'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("rpdid")) != "")
			$this->rpdid->OldValue = $this->getKey("rpdid"); // rpdid
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

		if ($this->harga_satuan->FormValue == $this->harga_satuan->CurrentValue && is_numeric(ConvertToFloatString($this->harga_satuan->CurrentValue)))
			$this->harga_satuan->CurrentValue = ConvertToFloatString($this->harga_satuan->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// rpdid
		// kdjudul
		// kdbidang
		// kdkursil
		// iso
		// tempat
		// jml_hari
		// jenisdurasi
		// targetpes
		// angkatan
		// sisa_angkatan
		// harga_satuan
		// hargatotal
		// tglrevisi
		// tahun_rencana

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// rpdid
			$this->rpdid->ViewValue = $this->rpdid->CurrentValue;
			$this->rpdid->ViewCustomAttributes = "";

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

			// iso
			if (strval($this->iso->CurrentValue) != "") {
				$this->iso->ViewValue = $this->iso->optionCaption($this->iso->CurrentValue);
			} else {
				$this->iso->ViewValue = NULL;
			}
			$this->iso->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// jml_hari
			$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
			$this->jml_hari->ViewCustomAttributes = "";

			// jenisdurasi
			if (strval($this->jenisdurasi->CurrentValue) != "") {
				$this->jenisdurasi->ViewValue = $this->jenisdurasi->optionCaption($this->jenisdurasi->CurrentValue);
			} else {
				$this->jenisdurasi->ViewValue = NULL;
			}
			$this->jenisdurasi->ViewCustomAttributes = "";

			// targetpes
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->ViewCustomAttributes = "";

			// angkatan
			$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
			$this->angkatan->ViewCustomAttributes = "";

			// sisa_angkatan
			$this->sisa_angkatan->ViewValue = $this->sisa_angkatan->CurrentValue;
			$this->sisa_angkatan->ViewValue = FormatNumber($this->sisa_angkatan->ViewValue, 0, -2, -2, -2);
			$this->sisa_angkatan->ViewCustomAttributes = "";

			// harga_satuan
			$this->harga_satuan->ViewValue = $this->harga_satuan->CurrentValue;
			$this->harga_satuan->ViewValue = FormatCurrency($this->harga_satuan->ViewValue, 0, -2, -2, -2);
			$this->harga_satuan->ViewCustomAttributes = "";

			// hargatotal
			$this->hargatotal->ViewValue = $this->hargatotal->CurrentValue;
			$this->hargatotal->ViewCustomAttributes = "";

			// tglrevisi
			$this->tglrevisi->ViewValue = $this->tglrevisi->CurrentValue;
			$this->tglrevisi->ViewValue = FormatDateTime($this->tglrevisi->ViewValue, 0);
			$this->tglrevisi->ViewCustomAttributes = "";

			// tahun_rencana
			$this->tahun_rencana->ViewValue = $this->tahun_rencana->CurrentValue;
			$this->tahun_rencana->ViewCustomAttributes = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdbidang
			$this->kdbidang->LinkCustomAttributes = "";
			$this->kdbidang->HrefValue = "";
			$this->kdbidang->TooltipValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";
			$this->kdkursil->TooltipValue = "";

			// iso
			$this->iso->LinkCustomAttributes = "";
			$this->iso->HrefValue = "";
			$this->iso->TooltipValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// jml_hari
			$this->jml_hari->LinkCustomAttributes = "";
			$this->jml_hari->HrefValue = "";
			$this->jml_hari->TooltipValue = "";

			// jenisdurasi
			$this->jenisdurasi->LinkCustomAttributes = "";
			$this->jenisdurasi->HrefValue = "";
			$this->jenisdurasi->TooltipValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";
			$this->targetpes->TooltipValue = "";

			// angkatan
			$this->angkatan->LinkCustomAttributes = "";
			$this->angkatan->HrefValue = "";
			$this->angkatan->TooltipValue = "";

			// harga_satuan
			$this->harga_satuan->LinkCustomAttributes = "";
			$this->harga_satuan->HrefValue = "";
			$this->harga_satuan->TooltipValue = "";

			// tglrevisi
			$this->tglrevisi->LinkCustomAttributes = "";
			$this->tglrevisi->HrefValue = "";
			$this->tglrevisi->TooltipValue = "";

			// tahun_rencana
			$this->tahun_rencana->LinkCustomAttributes = "";
			$this->tahun_rencana->HrefValue = "";
			$this->tahun_rencana->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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

			// iso
			$this->iso->EditAttrs["class"] = "form-control";
			$this->iso->EditCustomAttributes = "";
			$this->iso->EditValue = $this->iso->options(TRUE);

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			$this->tempat->EditValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// jml_hari
			$this->jml_hari->EditAttrs["class"] = "form-control";
			$this->jml_hari->EditCustomAttributes = "";
			$this->jml_hari->EditValue = HtmlEncode($this->jml_hari->CurrentValue);
			$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());

			// jenisdurasi
			$this->jenisdurasi->EditAttrs["class"] = "form-control";
			$this->jenisdurasi->EditCustomAttributes = "";
			$this->jenisdurasi->EditValue = $this->jenisdurasi->options(TRUE);

			// targetpes
			$this->targetpes->EditAttrs["class"] = "form-control";
			$this->targetpes->EditCustomAttributes = "";
			$this->targetpes->EditValue = HtmlEncode($this->targetpes->CurrentValue);
			$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

			// angkatan
			$this->angkatan->EditAttrs["class"] = "form-control";
			$this->angkatan->EditCustomAttributes = "";
			$this->angkatan->EditValue = HtmlEncode($this->angkatan->CurrentValue);
			$this->angkatan->PlaceHolder = RemoveHtml($this->angkatan->caption());

			// harga_satuan
			$this->harga_satuan->EditAttrs["class"] = "form-control";
			$this->harga_satuan->EditCustomAttributes = "";
			$this->harga_satuan->EditValue = HtmlEncode($this->harga_satuan->CurrentValue);
			$this->harga_satuan->PlaceHolder = RemoveHtml($this->harga_satuan->caption());
			if (strval($this->harga_satuan->EditValue) != "" && is_numeric($this->harga_satuan->EditValue))
				$this->harga_satuan->EditValue = FormatNumber($this->harga_satuan->EditValue, -2, -2, -2, -2);
			

			// tglrevisi
			$this->tglrevisi->EditAttrs["class"] = "form-control";
			$this->tglrevisi->EditCustomAttributes = "";
			$this->tglrevisi->EditValue = HtmlEncode(FormatDateTime($this->tglrevisi->CurrentValue, 8));
			$this->tglrevisi->PlaceHolder = RemoveHtml($this->tglrevisi->caption());

			// tahun_rencana
			$this->tahun_rencana->EditAttrs["class"] = "form-control";
			$this->tahun_rencana->EditCustomAttributes = "";
			$this->tahun_rencana->EditValue = HtmlEncode($this->tahun_rencana->CurrentValue);
			$this->tahun_rencana->PlaceHolder = RemoveHtml($this->tahun_rencana->caption());

			// Edit refer script
			// kdjudul

			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdbidang
			$this->kdbidang->LinkCustomAttributes = "";
			$this->kdbidang->HrefValue = "";
			$this->kdbidang->TooltipValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";

			// iso
			$this->iso->LinkCustomAttributes = "";
			$this->iso->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// jml_hari
			$this->jml_hari->LinkCustomAttributes = "";
			$this->jml_hari->HrefValue = "";

			// jenisdurasi
			$this->jenisdurasi->LinkCustomAttributes = "";
			$this->jenisdurasi->HrefValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";

			// angkatan
			$this->angkatan->LinkCustomAttributes = "";
			$this->angkatan->HrefValue = "";

			// harga_satuan
			$this->harga_satuan->LinkCustomAttributes = "";
			$this->harga_satuan->HrefValue = "";

			// tglrevisi
			$this->tglrevisi->LinkCustomAttributes = "";
			$this->tglrevisi->HrefValue = "";

			// tahun_rencana
			$this->tahun_rencana->LinkCustomAttributes = "";
			$this->tahun_rencana->HrefValue = "";
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
		if ($this->kdkursil->Required) {
			if (!$this->kdkursil->IsDetailKey && $this->kdkursil->FormValue != NULL && $this->kdkursil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkursil->caption(), $this->kdkursil->RequiredErrorMessage));
			}
		}
		if ($this->iso->Required) {
			if (!$this->iso->IsDetailKey && $this->iso->FormValue != NULL && $this->iso->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->iso->caption(), $this->iso->RequiredErrorMessage));
			}
		}
		if ($this->tempat->Required) {
			if (!$this->tempat->IsDetailKey && $this->tempat->FormValue != NULL && $this->tempat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tempat->caption(), $this->tempat->RequiredErrorMessage));
			}
		}
		if ($this->jml_hari->Required) {
			if (!$this->jml_hari->IsDetailKey && $this->jml_hari->FormValue != NULL && $this->jml_hari->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_hari->caption(), $this->jml_hari->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jml_hari->FormValue)) {
			AddMessage($FormError, $this->jml_hari->errorMessage());
		}
		if ($this->jenisdurasi->Required) {
			if (!$this->jenisdurasi->IsDetailKey && $this->jenisdurasi->FormValue != NULL && $this->jenisdurasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenisdurasi->caption(), $this->jenisdurasi->RequiredErrorMessage));
			}
		}
		if ($this->targetpes->Required) {
			if (!$this->targetpes->IsDetailKey && $this->targetpes->FormValue != NULL && $this->targetpes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes->caption(), $this->targetpes->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes->FormValue)) {
			AddMessage($FormError, $this->targetpes->errorMessage());
		}
		if ($this->angkatan->Required) {
			if (!$this->angkatan->IsDetailKey && $this->angkatan->FormValue != NULL && $this->angkatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->angkatan->caption(), $this->angkatan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->angkatan->FormValue)) {
			AddMessage($FormError, $this->angkatan->errorMessage());
		}
		if ($this->harga_satuan->Required) {
			if (!$this->harga_satuan->IsDetailKey && $this->harga_satuan->FormValue != NULL && $this->harga_satuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->harga_satuan->caption(), $this->harga_satuan->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->harga_satuan->FormValue)) {
			AddMessage($FormError, $this->harga_satuan->errorMessage());
		}
		if ($this->tglrevisi->Required) {
			if (!$this->tglrevisi->IsDetailKey && $this->tglrevisi->FormValue != NULL && $this->tglrevisi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglrevisi->caption(), $this->tglrevisi->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tglrevisi->FormValue)) {
			AddMessage($FormError, $this->tglrevisi->errorMessage());
		}
		if ($this->tahun_rencana->Required) {
			if (!$this->tahun_rencana->IsDetailKey && $this->tahun_rencana->FormValue != NULL && $this->tahun_rencana->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tahun_rencana->caption(), $this->tahun_rencana->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tahun_rencana->FormValue)) {
			AddMessage($FormError, $this->tahun_rencana->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("diklatpusat", $detailTblVar) && $GLOBALS["diklatpusat"]->DetailEdit) {
			if (!isset($GLOBALS["diklatpusat_grid"]))
				$GLOBALS["diklatpusat_grid"] = new diklatpusat_grid(); // Get detail page object
			$GLOBALS["diklatpusat_grid"]->validateGridForm();
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

			// kdkursil
			$this->kdkursil->setDbValueDef($rsnew, $this->kdkursil->CurrentValue, NULL, $this->kdkursil->ReadOnly);

			// iso
			$this->iso->setDbValueDef($rsnew, $this->iso->CurrentValue, NULL, $this->iso->ReadOnly);

			// jml_hari
			$this->jml_hari->setDbValueDef($rsnew, $this->jml_hari->CurrentValue, NULL, $this->jml_hari->ReadOnly);

			// jenisdurasi
			$this->jenisdurasi->setDbValueDef($rsnew, $this->jenisdurasi->CurrentValue, NULL, $this->jenisdurasi->ReadOnly);

			// targetpes
			$this->targetpes->setDbValueDef($rsnew, $this->targetpes->CurrentValue, NULL, $this->targetpes->ReadOnly);

			// angkatan
			$this->angkatan->setDbValueDef($rsnew, $this->angkatan->CurrentValue, NULL, $this->angkatan->ReadOnly);

			// harga_satuan
			$this->harga_satuan->setDbValueDef($rsnew, $this->harga_satuan->CurrentValue, 0, $this->harga_satuan->ReadOnly);

			// tglrevisi
			$this->tglrevisi->setDbValueDef($rsnew, UnFormatDateTime($this->tglrevisi->CurrentValue, 0), NULL, $this->tglrevisi->ReadOnly);

			// tahun_rencana
			$this->tahun_rencana->setDbValueDef($rsnew, $this->tahun_rencana->CurrentValue, NULL, $this->tahun_rencana->ReadOnly);

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
					if (in_array("diklatpusat", $detailTblVar) && $GLOBALS["diklatpusat"]->DetailEdit) {
						if (!isset($GLOBALS["diklatpusat_grid"]))
							$GLOBALS["diklatpusat_grid"] = new diklatpusat_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "diklatpusat"); // Load user level of detail table
						$editRow = $GLOBALS["diklatpusat_grid"]->gridUpdate();
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
			if (in_array("diklatpusat", $detailTblVar)) {
				if (!isset($GLOBALS["diklatpusat_grid"]))
					$GLOBALS["diklatpusat_grid"] = new diklatpusat_grid();
				if ($GLOBALS["diklatpusat_grid"]->DetailEdit) {
					$GLOBALS["diklatpusat_grid"]->CurrentMode = "edit";
					$GLOBALS["diklatpusat_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["diklatpusat_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["diklatpusat_grid"]->setStartRecordNumber(1);
					$GLOBALS["diklatpusat_grid"]->rid->IsDetailKey = TRUE;
					$GLOBALS["diklatpusat_grid"]->rid->CurrentValue = $this->rpdid->CurrentValue;
					$GLOBALS["diklatpusat_grid"]->rid->setSessionValue($GLOBALS["diklatpusat_grid"]->rid->CurrentValue);
					$GLOBALS["diklatpusat_grid"]->kdjudul->IsDetailKey = TRUE;
					$GLOBALS["diklatpusat_grid"]->kdjudul->CurrentValue = $this->kdjudul->CurrentValue;
					$GLOBALS["diklatpusat_grid"]->kdjudul->setSessionValue($GLOBALS["diklatpusat_grid"]->kdjudul->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_rpdiklatlist.php"), "", $this->TableVar, TRUE);
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
				case "x_kdbidang":
					break;
				case "x_kdkursil":
					break;
				case "x_iso":
					break;
				case "x_jenisdurasi":
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
						case "x_kdbidang":
							break;
						case "x_kdkursil":
							$row[3] = FormatDateTime($row[3], 0);
							$row['df3'] = $row[3];
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
		if (@$_POST["myajax"] == 1 && @$_POST["value"] != "") { // Check if it is your custom Ajax and if the query value is present
			$val = ExecuteScalar("SELECT detailjdid  FROM `t_juduldetail` WHERE `kdkursil` LIKE '" . $_POST["value"] . "'"); // Get the desired value (assume ProductID is integer so no need to quote the value)
			echo $val; // Return the value (manipulate it first if necessary)
			$this->terminate(); // Terminate the page
		} 
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

		$this->harga_satuan->EditValue = round($this->harga_satuan->CurrentValue);
		$this->hargatotal->EditValue = $this->angkatan->CurrentValue * $this->harga_satuan->CurrentValue;

		//$this->tahun_rencana->Visible = FALSE;
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