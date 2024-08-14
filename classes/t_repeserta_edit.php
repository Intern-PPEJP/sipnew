<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_repeserta_edit extends t_repeserta
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_repeserta';

	// Page object name
	public $PageObjName = "t_repeserta_edit";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
		$this->idpelat->setVisibility();
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
		$this->updated_at->setVisibility();
		$this->created_at->Visible = FALSE;
		$this->ket_lainnya->setVisibility();
		$this->hideFieldsForAddEdit();
		$this->idpelat->Required = FALSE;

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

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_repesertalist.php");
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
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->id->setOldValue($this->id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id->setQueryStringValue(Route(2));
				$this->id->setOldValue($this->id->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_id")) {
					$this->id->setFormValue($CurrentForm->getValue("x_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id") !== NULL) {
					$this->id->setQueryStringValue(Get("id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id->CurrentValue = NULL;
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
					$this->terminate("t_repesertalist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_repesertalist.php")
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

		// Check field name 'idpelat' first before field var 'x_idpelat'
		$val = $CurrentForm->hasValue("idpelat") ? $CurrentForm->getValue("idpelat") : $CurrentForm->getValue("x_idpelat");
		if (!$this->idpelat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idpelat->Visible = FALSE; // Disable update for API request
			else
				$this->idpelat->setFormValue($val);
		}

		// Check field name 'nama' first before field var 'x_nama'
		$val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
		if (!$this->nama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nama->Visible = FALSE; // Disable update for API request
			else
				$this->nama->setFormValue($val);
		}

		// Check field name 'perusahaan' first before field var 'x_perusahaan'
		$val = $CurrentForm->hasValue("perusahaan") ? $CurrentForm->getValue("perusahaan") : $CurrentForm->getValue("x_perusahaan");
		if (!$this->perusahaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->perusahaan->setFormValue($val);
		}

		// Check field name 'jabatan' first before field var 'x_jabatan'
		$val = $CurrentForm->hasValue("jabatan") ? $CurrentForm->getValue("jabatan") : $CurrentForm->getValue("x_jabatan");
		if (!$this->jabatan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->jabatan->setFormValue($val);
		}

		// Check field name 'tgl_daftar' first before field var 'x_tgl_daftar'
		$val = $CurrentForm->hasValue("tgl_daftar") ? $CurrentForm->getValue("tgl_daftar") : $CurrentForm->getValue("x_tgl_daftar");
		if (!$this->tgl_daftar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_daftar->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_daftar->setFormValue($val);
			$this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 0);
		}

		// Check field name 'telp' first before field var 'x_telp'
		$val = $CurrentForm->hasValue("telp") ? $CurrentForm->getValue("telp") : $CurrentForm->getValue("x_telp");
		if (!$this->telp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->telp->Visible = FALSE; // Disable update for API request
			else
				$this->telp->setFormValue($val);
		}

		// Check field name 'fax' first before field var 'x_fax'
		$val = $CurrentForm->hasValue("fax") ? $CurrentForm->getValue("fax") : $CurrentForm->getValue("x_fax");
		if (!$this->fax->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->fax->Visible = FALSE; // Disable update for API request
			else
				$this->fax->setFormValue($val);
		}

		// Check field name 'hp' first before field var 'x_hp'
		$val = $CurrentForm->hasValue("hp") ? $CurrentForm->getValue("hp") : $CurrentForm->getValue("x_hp");
		if (!$this->hp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->hp->Visible = FALSE; // Disable update for API request
			else
				$this->hp->setFormValue($val);
		}

		// Check field name 'produk' first before field var 'x_produk'
		$val = $CurrentForm->hasValue("produk") ? $CurrentForm->getValue("produk") : $CurrentForm->getValue("x_produk");
		if (!$this->produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->produk->Visible = FALSE; // Disable update for API request
			else
				$this->produk->setFormValue($val);
		}

		// Check field name 'cara_bayar' first before field var 'x_cara_bayar'
		$val = $CurrentForm->hasValue("cara_bayar") ? $CurrentForm->getValue("cara_bayar") : $CurrentForm->getValue("x_cara_bayar");
		if (!$this->cara_bayar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->cara_bayar->Visible = FALSE; // Disable update for API request
			else
				$this->cara_bayar->setFormValue($val);
		}

		// Check field name 'ket_bayar' first before field var 'x_ket_bayar'
		$val = $CurrentForm->hasValue("ket_bayar") ? $CurrentForm->getValue("ket_bayar") : $CurrentForm->getValue("x_ket_bayar");
		if (!$this->ket_bayar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ket_bayar->Visible = FALSE; // Disable update for API request
			else
				$this->ket_bayar->setFormValue($val);
		}

		// Check field name 'tgl_bayar' first before field var 'x_tgl_bayar'
		$val = $CurrentForm->hasValue("tgl_bayar") ? $CurrentForm->getValue("tgl_bayar") : $CurrentForm->getValue("x_tgl_bayar");
		if (!$this->tgl_bayar->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_bayar->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_bayar->setFormValue($val);
			$this->tgl_bayar->CurrentValue = UnFormatDateTime($this->tgl_bayar->CurrentValue, 0);
		}

		// Check field name 'kdinformasi' first before field var 'x_kdinformasi'
		$val = $CurrentForm->hasValue("kdinformasi") ? $CurrentForm->getValue("kdinformasi") : $CurrentForm->getValue("x_kdinformasi");
		if (!$this->kdinformasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdinformasi->Visible = FALSE; // Disable update for API request
			else
				$this->kdinformasi->setFormValue($val);
		}

		// Check field name 'konfirmasi' first before field var 'x_konfirmasi'
		$val = $CurrentForm->hasValue("konfirmasi") ? $CurrentForm->getValue("konfirmasi") : $CurrentForm->getValue("x_konfirmasi");
		if (!$this->konfirmasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->konfirmasi->Visible = FALSE; // Disable update for API request
			else
				$this->konfirmasi->setFormValue($val);
		}

		// Check field name 'ket' first before field var 'x_ket'
		$val = $CurrentForm->hasValue("ket") ? $CurrentForm->getValue("ket") : $CurrentForm->getValue("x_ket");
		if (!$this->ket->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ket->Visible = FALSE; // Disable update for API request
			else
				$this->ket->setFormValue($val);
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

		// Check field name 'ket_lainnya' first before field var 'x_ket_lainnya'
		$val = $CurrentForm->hasValue("ket_lainnya") ? $CurrentForm->getValue("ket_lainnya") : $CurrentForm->getValue("x_ket_lainnya");
		if (!$this->ket_lainnya->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ket_lainnya->Visible = FALSE; // Disable update for API request
			else
				$this->ket_lainnya->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->idpelat->CurrentValue = $this->idpelat->FormValue;
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->perusahaan->CurrentValue = $this->perusahaan->FormValue;
		$this->jabatan->CurrentValue = $this->jabatan->FormValue;
		$this->tgl_daftar->CurrentValue = $this->tgl_daftar->FormValue;
		$this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 0);
		$this->telp->CurrentValue = $this->telp->FormValue;
		$this->fax->CurrentValue = $this->fax->FormValue;
		$this->hp->CurrentValue = $this->hp->FormValue;
		$this->produk->CurrentValue = $this->produk->FormValue;
		$this->cara_bayar->CurrentValue = $this->cara_bayar->FormValue;
		$this->ket_bayar->CurrentValue = $this->ket_bayar->FormValue;
		$this->tgl_bayar->CurrentValue = $this->tgl_bayar->FormValue;
		$this->tgl_bayar->CurrentValue = UnFormatDateTime($this->tgl_bayar->CurrentValue, 0);
		$this->kdinformasi->CurrentValue = $this->kdinformasi->FormValue;
		$this->konfirmasi->CurrentValue = $this->konfirmasi->FormValue;
		$this->ket->CurrentValue = $this->ket->FormValue;
		$this->updated_at->CurrentValue = $this->updated_at->FormValue;
		$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
		$this->ket_lainnya->CurrentValue = $this->ket_lainnya->FormValue;
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
		$this->id->setDbValue($row['id']);
		$this->idpelat->setDbValue($row['idpelat']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		$this->tgl_pel->setDbValue($row['tgl_pel']);
		$this->nama->setDbValue($row['nama']);
		$this->perusahaan->setDbValue($row['perusahaan']);
		$this->jabatan->setDbValue($row['jabatan']);
		$this->tgl_daftar->setDbValue($row['tgl_daftar']);
		$this->telp->setDbValue($row['telp']);
		$this->fax->setDbValue($row['fax']);
		$this->hp->setDbValue($row['hp']);
		$this->produk->setDbValue($row['produk']);
		$this->cara_bayar->setDbValue($row['cara_bayar']);
		$this->ket_bayar->setDbValue($row['ket_bayar']);
		$this->tgl_bayar->setDbValue($row['tgl_bayar']);
		$this->kdinformasi->setDbValue($row['kdinformasi']);
		$this->konfirmasi->setDbValue($row['konfirmasi']);
		$this->ket->setDbValue($row['ket']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->created_at->setDbValue($row['created_at']);
		$this->ket_lainnya->setDbValue($row['ket_lainnya']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['idpelat'] = NULL;
		$row['kdjudul'] = NULL;
		$row['tgl_pel'] = NULL;
		$row['nama'] = NULL;
		$row['perusahaan'] = NULL;
		$row['jabatan'] = NULL;
		$row['tgl_daftar'] = NULL;
		$row['telp'] = NULL;
		$row['fax'] = NULL;
		$row['hp'] = NULL;
		$row['produk'] = NULL;
		$row['cara_bayar'] = NULL;
		$row['ket_bayar'] = NULL;
		$row['tgl_bayar'] = NULL;
		$row['kdinformasi'] = NULL;
		$row['konfirmasi'] = NULL;
		$row['ket'] = NULL;
		$row['updated_at'] = NULL;
		$row['created_at'] = NULL;
		$row['ket_lainnya'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
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

			// idpelat
			$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
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
						$arwrk[2] = $rswrk->fields('df2');
						$this->idpelat->ViewValue = $this->idpelat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
					}
				}
			} else {
				$this->idpelat->ViewValue = NULL;
			}
			$this->idpelat->ViewCustomAttributes = "";

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

			// updated_at
			$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
			$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
			$this->updated_at->ViewCustomAttributes = "";

			// ket_lainnya
			$this->ket_lainnya->ViewValue = $this->ket_lainnya->CurrentValue;
			$this->ket_lainnya->ViewCustomAttributes = "";

			// idpelat
			$this->idpelat->LinkCustomAttributes = "";
			$this->idpelat->HrefValue = "";
			$this->idpelat->TooltipValue = "";

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

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";

			// ket_lainnya
			$this->ket_lainnya->LinkCustomAttributes = "";
			$this->ket_lainnya->HrefValue = "";
			$this->ket_lainnya->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// idpelat
			$this->idpelat->EditAttrs["class"] = "form-control";
			$this->idpelat->EditCustomAttributes = "";
			$this->idpelat->EditValue = $this->idpelat->CurrentValue;
			$curVal = strval($this->idpelat->CurrentValue);
			if ($curVal != "") {
				$this->idpelat->EditValue = $this->idpelat->lookupCacheOption($curVal);
				if ($this->idpelat->EditValue === NULL) { // Lookup from database
					$filterWrk = "`idpelat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->idpelat->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->idpelat->EditValue = $this->idpelat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idpelat->EditValue = $this->idpelat->CurrentValue;
					}
				}
			} else {
				$this->idpelat->EditValue = NULL;
			}
			$this->idpelat->ViewCustomAttributes = "";

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// perusahaan
			$this->perusahaan->EditAttrs["class"] = "form-control";
			$this->perusahaan->EditCustomAttributes = "";
			if (!$this->perusahaan->Raw)
				$this->perusahaan->CurrentValue = HtmlDecode($this->perusahaan->CurrentValue);
			$this->perusahaan->EditValue = HtmlEncode($this->perusahaan->CurrentValue);
			$this->perusahaan->PlaceHolder = RemoveHtml($this->perusahaan->caption());

			// jabatan
			$this->jabatan->EditAttrs["class"] = "form-control";
			$this->jabatan->EditCustomAttributes = "";
			if (!$this->jabatan->Raw)
				$this->jabatan->CurrentValue = HtmlDecode($this->jabatan->CurrentValue);
			$this->jabatan->EditValue = HtmlEncode($this->jabatan->CurrentValue);
			$curVal = strval($this->jabatan->CurrentValue);
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
						$this->jabatan->EditValue = HtmlEncode($this->jabatan->CurrentValue);
					}
				}
			} else {
				$this->jabatan->EditValue = NULL;
			}
			$this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());

			// tgl_daftar
			$this->tgl_daftar->EditAttrs["class"] = "form-control";
			$this->tgl_daftar->EditCustomAttributes = "";
			$this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime($this->tgl_daftar->CurrentValue, 8));
			$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			if (!$this->telp->Raw)
				$this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
			$this->telp->EditValue = HtmlEncode($this->telp->CurrentValue);
			$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			if (!$this->fax->Raw)
				$this->fax->CurrentValue = HtmlDecode($this->fax->CurrentValue);
			$this->fax->EditValue = HtmlEncode($this->fax->CurrentValue);
			$this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
			$this->hp->EditValue = HtmlEncode($this->hp->CurrentValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "";
			if (!$this->produk->Raw)
				$this->produk->CurrentValue = HtmlDecode($this->produk->CurrentValue);
			$this->produk->EditValue = HtmlEncode($this->produk->CurrentValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// cara_bayar
			$this->cara_bayar->EditCustomAttributes = "";
			$this->cara_bayar->EditValue = $this->cara_bayar->options(FALSE);

			// ket_bayar
			$this->ket_bayar->EditAttrs["class"] = "form-control";
			$this->ket_bayar->EditCustomAttributes = "";
			$this->ket_bayar->EditValue = HtmlEncode($this->ket_bayar->CurrentValue);
			$this->ket_bayar->PlaceHolder = RemoveHtml($this->ket_bayar->caption());

			// tgl_bayar
			$this->tgl_bayar->EditAttrs["class"] = "form-control";
			$this->tgl_bayar->EditCustomAttributes = "";
			$this->tgl_bayar->EditValue = HtmlEncode(FormatDateTime($this->tgl_bayar->CurrentValue, 8));
			$this->tgl_bayar->PlaceHolder = RemoveHtml($this->tgl_bayar->caption());

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

			// konfirmasi
			$this->konfirmasi->EditAttrs["class"] = "form-control";
			$this->konfirmasi->EditCustomAttributes = "";
			$this->konfirmasi->EditValue = $this->konfirmasi->options(TRUE);

			// ket
			$this->ket->EditAttrs["class"] = "form-control";
			$this->ket->EditCustomAttributes = "";
			$this->ket->EditValue = $this->ket->options(TRUE);

			// updated_at
			// ket_lainnya

			$this->ket_lainnya->EditAttrs["class"] = "form-control";
			$this->ket_lainnya->EditCustomAttributes = "";
			$this->ket_lainnya->EditValue = HtmlEncode($this->ket_lainnya->CurrentValue);
			$this->ket_lainnya->PlaceHolder = RemoveHtml($this->ket_lainnya->caption());

			// Edit refer script
			// idpelat

			$this->idpelat->LinkCustomAttributes = "";
			$this->idpelat->HrefValue = "";
			$this->idpelat->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// perusahaan
			$this->perusahaan->LinkCustomAttributes = "";
			$this->perusahaan->HrefValue = "";

			// jabatan
			$this->jabatan->LinkCustomAttributes = "";
			$this->jabatan->HrefValue = "";

			// tgl_daftar
			$this->tgl_daftar->LinkCustomAttributes = "";
			$this->tgl_daftar->HrefValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";

			// cara_bayar
			$this->cara_bayar->LinkCustomAttributes = "";
			$this->cara_bayar->HrefValue = "";

			// ket_bayar
			$this->ket_bayar->LinkCustomAttributes = "";
			$this->ket_bayar->HrefValue = "";

			// tgl_bayar
			$this->tgl_bayar->LinkCustomAttributes = "";
			$this->tgl_bayar->HrefValue = "";

			// kdinformasi
			$this->kdinformasi->LinkCustomAttributes = "";
			$this->kdinformasi->HrefValue = "";

			// konfirmasi
			$this->konfirmasi->LinkCustomAttributes = "";
			$this->konfirmasi->HrefValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";

			// ket_lainnya
			$this->ket_lainnya->LinkCustomAttributes = "";
			$this->ket_lainnya->HrefValue = "";
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
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->perusahaan->Required) {
			if (!$this->perusahaan->IsDetailKey && $this->perusahaan->FormValue != NULL && $this->perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->perusahaan->caption(), $this->perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->jabatan->Required) {
			if (!$this->jabatan->IsDetailKey && $this->jabatan->FormValue != NULL && $this->jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jabatan->caption(), $this->jabatan->RequiredErrorMessage));
			}
		}
		if ($this->tgl_daftar->Required) {
			if (!$this->tgl_daftar->IsDetailKey && $this->tgl_daftar->FormValue != NULL && $this->tgl_daftar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_daftar->caption(), $this->tgl_daftar->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_daftar->FormValue)) {
			AddMessage($FormError, $this->tgl_daftar->errorMessage());
		}
		if ($this->telp->Required) {
			if (!$this->telp->IsDetailKey && $this->telp->FormValue != NULL && $this->telp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telp->caption(), $this->telp->RequiredErrorMessage));
			}
		}
		if ($this->fax->Required) {
			if (!$this->fax->IsDetailKey && $this->fax->FormValue != NULL && $this->fax->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fax->caption(), $this->fax->RequiredErrorMessage));
			}
		}
		if ($this->hp->Required) {
			if (!$this->hp->IsDetailKey && $this->hp->FormValue != NULL && $this->hp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hp->caption(), $this->hp->RequiredErrorMessage));
			}
		}
		if ($this->produk->Required) {
			if (!$this->produk->IsDetailKey && $this->produk->FormValue != NULL && $this->produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->produk->caption(), $this->produk->RequiredErrorMessage));
			}
		}
		if ($this->cara_bayar->Required) {
			if ($this->cara_bayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cara_bayar->caption(), $this->cara_bayar->RequiredErrorMessage));
			}
		}
		if ($this->ket_bayar->Required) {
			if (!$this->ket_bayar->IsDetailKey && $this->ket_bayar->FormValue != NULL && $this->ket_bayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ket_bayar->caption(), $this->ket_bayar->RequiredErrorMessage));
			}
		}
		if ($this->tgl_bayar->Required) {
			if (!$this->tgl_bayar->IsDetailKey && $this->tgl_bayar->FormValue != NULL && $this->tgl_bayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_bayar->caption(), $this->tgl_bayar->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_bayar->FormValue)) {
			AddMessage($FormError, $this->tgl_bayar->errorMessage());
		}
		if ($this->kdinformasi->Required) {
			if (!$this->kdinformasi->IsDetailKey && $this->kdinformasi->FormValue != NULL && $this->kdinformasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdinformasi->caption(), $this->kdinformasi->RequiredErrorMessage));
			}
		}
		if ($this->konfirmasi->Required) {
			if (!$this->konfirmasi->IsDetailKey && $this->konfirmasi->FormValue != NULL && $this->konfirmasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->konfirmasi->caption(), $this->konfirmasi->RequiredErrorMessage));
			}
		}
		if ($this->ket->Required) {
			if (!$this->ket->IsDetailKey && $this->ket->FormValue != NULL && $this->ket->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ket->caption(), $this->ket->RequiredErrorMessage));
			}
		}
		if ($this->updated_at->Required) {
			if (!$this->updated_at->IsDetailKey && $this->updated_at->FormValue != NULL && $this->updated_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
			}
		}
		if ($this->ket_lainnya->Required) {
			if (!$this->ket_lainnya->IsDetailKey && $this->ket_lainnya->FormValue != NULL && $this->ket_lainnya->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ket_lainnya->caption(), $this->ket_lainnya->RequiredErrorMessage));
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

			// nama
			$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, NULL, $this->nama->ReadOnly);

			// perusahaan
			$this->perusahaan->setDbValueDef($rsnew, $this->perusahaan->CurrentValue, NULL, $this->perusahaan->ReadOnly);

			// jabatan
			$this->jabatan->setDbValueDef($rsnew, $this->jabatan->CurrentValue, NULL, $this->jabatan->ReadOnly);

			// tgl_daftar
			$this->tgl_daftar->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_daftar->CurrentValue, 0), NULL, $this->tgl_daftar->ReadOnly);

			// telp
			$this->telp->setDbValueDef($rsnew, $this->telp->CurrentValue, NULL, $this->telp->ReadOnly);

			// fax
			$this->fax->setDbValueDef($rsnew, $this->fax->CurrentValue, NULL, $this->fax->ReadOnly);

			// hp
			$this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, NULL, $this->hp->ReadOnly);

			// produk
			$this->produk->setDbValueDef($rsnew, $this->produk->CurrentValue, NULL, $this->produk->ReadOnly);

			// cara_bayar
			$this->cara_bayar->setDbValueDef($rsnew, $this->cara_bayar->CurrentValue, NULL, $this->cara_bayar->ReadOnly);

			// ket_bayar
			$this->ket_bayar->setDbValueDef($rsnew, $this->ket_bayar->CurrentValue, NULL, $this->ket_bayar->ReadOnly);

			// tgl_bayar
			$this->tgl_bayar->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_bayar->CurrentValue, 0), NULL, $this->tgl_bayar->ReadOnly);

			// kdinformasi
			$this->kdinformasi->setDbValueDef($rsnew, $this->kdinformasi->CurrentValue, NULL, $this->kdinformasi->ReadOnly);

			// konfirmasi
			$this->konfirmasi->setDbValueDef($rsnew, $this->konfirmasi->CurrentValue, NULL, $this->konfirmasi->ReadOnly);

			// ket
			$this->ket->setDbValueDef($rsnew, $this->ket->CurrentValue, NULL, $this->ket->ReadOnly);

			// ket_lainnya
			$this->ket_lainnya->setDbValueDef($rsnew, $this->ket_lainnya->CurrentValue, NULL, $this->ket_lainnya->ReadOnly);

			// Check referential integrity for master table 'cv_pelrepes'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_cv_pelrepes();
			$keyValue = isset($rsnew['idpelat']) ? $rsnew['idpelat'] : $rsold['idpelat'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@idpelat@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["cv_pelrepes"]))
					$GLOBALS["cv_pelrepes"] = new cv_pelrepes();
				$rsmaster = $GLOBALS["cv_pelrepes"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "cv_pelrepes", $Language->phrase("RelatedRecordRequired"));
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
			if ($masterTblVar == "cv_pelrepes") {
				$validMaster = TRUE;
				if (($parm = Get("fk_idpelat", Get("idpelat"))) !== NULL) {
					$GLOBALS["cv_pelrepes"]->idpelat->setQueryStringValue($parm);
					$this->idpelat->setQueryStringValue($GLOBALS["cv_pelrepes"]->idpelat->QueryStringValue);
					$this->idpelat->setSessionValue($this->idpelat->QueryStringValue);
					if (!is_numeric($GLOBALS["cv_pelrepes"]->idpelat->QueryStringValue))
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
			if ($masterTblVar == "cv_pelrepes") {
				$validMaster = TRUE;
				if (($parm = Post("fk_idpelat", Post("idpelat"))) !== NULL) {
					$GLOBALS["cv_pelrepes"]->idpelat->setFormValue($parm);
					$this->idpelat->setFormValue($GLOBALS["cv_pelrepes"]->idpelat->FormValue);
					$this->idpelat->setSessionValue($this->idpelat->FormValue);
					if (!is_numeric($GLOBALS["cv_pelrepes"]->idpelat->FormValue))
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
			if ($masterTblVar != "cv_pelrepes") {
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_repesertalist.php"), "", $this->TableVar, TRUE);
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