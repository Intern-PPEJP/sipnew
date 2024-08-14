<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_juduldetail_edit extends t_juduldetail
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_juduldetail';

	// Page object name
	public $PageObjName = "t_juduldetail_edit";

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

		// Table object (t_juduldetail)
		if (!isset($GLOBALS["t_juduldetail"]) || get_class($GLOBALS["t_juduldetail"]) == PROJECT_NAMESPACE . "t_juduldetail") {
			$GLOBALS["t_juduldetail"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_juduldetail"];
		}

		// Table object (t_judul)
		if (!isset($GLOBALS['t_judul']))
			$GLOBALS['t_judul'] = new t_judul();

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_juduldetail');

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
		global $t_juduldetail;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_juduldetail);
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
					if ($pageName == "t_juduldetailview.php")
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
			$key .= @$ar['detailjdid'];
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
			$this->detailjdid->Visible = FALSE;
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
					$this->terminate(GetUrl("t_juduldetaillist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->detailjdid->Visible = FALSE;
		$this->singbagian->setVisibility();
		$this->jpel->setVisibility();
		$this->kdjudul->setVisibility();
		$this->kdkursil->setVisibility();
		$this->revisi->setVisibility();
		$this->tgl_terbit->setVisibility();
		$this->deskripsi_singkat->setVisibility();
		$this->tujuan->setVisibility();
		$this->target_peserta->setVisibility();
		$this->lama_pelatihan->setVisibility();
		$this->catatan->setVisibility();
		$this->created_by->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->updated_by->setVisibility();
		$this->updated_at->setVisibility();
		$this->hideFieldsForAddEdit();
		$this->singbagian->Required = FALSE;
		$this->jpel->Required = FALSE;
		$this->kdjudul->Required = FALSE;
		$this->kdkursil->Required = FALSE;
		$this->revisi->Required = FALSE;
		$this->lama_pelatihan->Required = FALSE;

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
		$this->setupLookupOptions($this->singbagian);
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->lama_pelatihan);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_juduldetaillist.php");
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
			if (Get("detailjdid") !== NULL) {
				$this->detailjdid->setQueryStringValue(Get("detailjdid"));
				$this->detailjdid->setOldValue($this->detailjdid->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->detailjdid->setQueryStringValue(Key(0));
				$this->detailjdid->setOldValue($this->detailjdid->QueryStringValue);
			} elseif (Post("detailjdid") !== NULL) {
				$this->detailjdid->setFormValue(Post("detailjdid"));
				$this->detailjdid->setOldValue($this->detailjdid->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->detailjdid->setQueryStringValue(Route(2));
				$this->detailjdid->setOldValue($this->detailjdid->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_detailjdid")) {
					$this->detailjdid->setFormValue($CurrentForm->getValue("x_detailjdid"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("detailjdid") !== NULL) {
					$this->detailjdid->setQueryStringValue(Get("detailjdid"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->detailjdid->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->detailjdid->CurrentValue = NULL;
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
					$this->terminate("t_juduldetaillist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_juduldetaillist.php")
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

		// Check field name 'singbagian' first before field var 'x_singbagian'
		$val = $CurrentForm->hasValue("singbagian") ? $CurrentForm->getValue("singbagian") : $CurrentForm->getValue("x_singbagian");
		if (!$this->singbagian->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->singbagian->Visible = FALSE; // Disable update for API request
			else
				$this->singbagian->setFormValue($val);
		}

		// Check field name 'jpel' first before field var 'x_jpel'
		$val = $CurrentForm->hasValue("jpel") ? $CurrentForm->getValue("jpel") : $CurrentForm->getValue("x_jpel");
		if (!$this->jpel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jpel->Visible = FALSE; // Disable update for API request
			else
				$this->jpel->setFormValue($val);
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

		// Check field name 'deskripsi_singkat' first before field var 'x_deskripsi_singkat'
		$val = $CurrentForm->hasValue("deskripsi_singkat") ? $CurrentForm->getValue("deskripsi_singkat") : $CurrentForm->getValue("x_deskripsi_singkat");
		if (!$this->deskripsi_singkat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->deskripsi_singkat->Visible = FALSE; // Disable update for API request
			else
				$this->deskripsi_singkat->setFormValue($val);
		}

		// Check field name 'tujuan' first before field var 'x_tujuan'
		$val = $CurrentForm->hasValue("tujuan") ? $CurrentForm->getValue("tujuan") : $CurrentForm->getValue("x_tujuan");
		if (!$this->tujuan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tujuan->Visible = FALSE; // Disable update for API request
			else
				$this->tujuan->setFormValue($val);
		}

		// Check field name 'target_peserta' first before field var 'x_target_peserta'
		$val = $CurrentForm->hasValue("target_peserta") ? $CurrentForm->getValue("target_peserta") : $CurrentForm->getValue("x_target_peserta");
		if (!$this->target_peserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->target_peserta->Visible = FALSE; // Disable update for API request
			else
				$this->target_peserta->setFormValue($val);
		}

		// Check field name 'lama_pelatihan' first before field var 'x_lama_pelatihan'
		$val = $CurrentForm->hasValue("lama_pelatihan") ? $CurrentForm->getValue("lama_pelatihan") : $CurrentForm->getValue("x_lama_pelatihan");
		if (!$this->lama_pelatihan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->lama_pelatihan->Visible = FALSE; // Disable update for API request
			else
				$this->lama_pelatihan->setFormValue($val);
		}

		// Check field name 'catatan' first before field var 'x_catatan'
		$val = $CurrentForm->hasValue("catatan") ? $CurrentForm->getValue("catatan") : $CurrentForm->getValue("x_catatan");
		if (!$this->catatan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->catatan->Visible = FALSE; // Disable update for API request
			else
				$this->catatan->setFormValue($val);
		}

		// Check field name 'updated_by' first before field var 'x_updated_by'
		$val = $CurrentForm->hasValue("updated_by") ? $CurrentForm->getValue("updated_by") : $CurrentForm->getValue("x_updated_by");
		if (!$this->updated_by->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->updated_by->Visible = FALSE; // Disable update for API request
			else
				$this->updated_by->setFormValue($val);
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

		// Check field name 'detailjdid' first before field var 'x_detailjdid'
		$val = $CurrentForm->hasValue("detailjdid") ? $CurrentForm->getValue("detailjdid") : $CurrentForm->getValue("x_detailjdid");
		if (!$this->detailjdid->IsDetailKey)
			$this->detailjdid->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->detailjdid->CurrentValue = $this->detailjdid->FormValue;
		$this->singbagian->CurrentValue = $this->singbagian->FormValue;
		$this->jpel->CurrentValue = $this->jpel->FormValue;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->kdkursil->CurrentValue = $this->kdkursil->FormValue;
		$this->revisi->CurrentValue = $this->revisi->FormValue;
		$this->tgl_terbit->CurrentValue = $this->tgl_terbit->FormValue;
		$this->tgl_terbit->CurrentValue = UnFormatDateTime($this->tgl_terbit->CurrentValue, 0);
		$this->deskripsi_singkat->CurrentValue = $this->deskripsi_singkat->FormValue;
		$this->tujuan->CurrentValue = $this->tujuan->FormValue;
		$this->target_peserta->CurrentValue = $this->target_peserta->FormValue;
		$this->lama_pelatihan->CurrentValue = $this->lama_pelatihan->FormValue;
		$this->catatan->CurrentValue = $this->catatan->FormValue;
		$this->updated_by->CurrentValue = $this->updated_by->FormValue;
		$this->updated_at->CurrentValue = $this->updated_at->FormValue;
		$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
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
		$this->detailjdid->setDbValue($row['detailjdid']);
		$this->singbagian->setDbValue($row['singbagian']);
		$this->jpel->setDbValue($row['jpel']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->revisi->setDbValue($row['revisi']);
		$this->tgl_terbit->setDbValue($row['tgl_terbit']);
		$this->deskripsi_singkat->setDbValue($row['deskripsi_singkat']);
		$this->tujuan->setDbValue($row['tujuan']);
		$this->target_peserta->setDbValue($row['target_peserta']);
		$this->lama_pelatihan->setDbValue($row['lama_pelatihan']);
		$this->catatan->setDbValue($row['catatan']);
		$this->created_by->setDbValue($row['created_by']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_by->setDbValue($row['updated_by']);
		$this->updated_at->setDbValue($row['updated_at']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['detailjdid'] = NULL;
		$row['singbagian'] = NULL;
		$row['jpel'] = NULL;
		$row['kdjudul'] = NULL;
		$row['kdkursil'] = NULL;
		$row['revisi'] = NULL;
		$row['tgl_terbit'] = NULL;
		$row['deskripsi_singkat'] = NULL;
		$row['tujuan'] = NULL;
		$row['target_peserta'] = NULL;
		$row['lama_pelatihan'] = NULL;
		$row['catatan'] = NULL;
		$row['created_by'] = NULL;
		$row['created_at'] = NULL;
		$row['updated_by'] = NULL;
		$row['updated_at'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("detailjdid")) != "")
			$this->detailjdid->OldValue = $this->getKey("detailjdid"); // detailjdid
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
		// detailjdid
		// singbagian
		// jpel
		// kdjudul
		// kdkursil
		// revisi
		// tgl_terbit
		// deskripsi_singkat
		// tujuan
		// target_peserta
		// lama_pelatihan
		// catatan
		// created_by
		// created_at
		// updated_by
		// updated_at

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// singbagian
			$curVal = strval($this->singbagian->CurrentValue);
			if ($curVal != "") {
				$this->singbagian->ViewValue = $this->singbagian->lookupCacheOption($curVal);
				if ($this->singbagian->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`singkatan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->singbagian->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->singbagian->ViewValue = $this->singbagian->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->singbagian->ViewValue = $this->singbagian->CurrentValue;
					}
				}
			} else {
				$this->singbagian->ViewValue = NULL;
			}
			$this->singbagian->ViewCustomAttributes = "";

			// jpel
			if (strval($this->jpel->CurrentValue) != "") {
				$this->jpel->ViewValue = $this->jpel->optionCaption($this->jpel->CurrentValue);
			} else {
				$this->jpel->ViewValue = NULL;
			}
			$this->jpel->ViewCustomAttributes = "";

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
			$this->kdkursil->ViewCustomAttributes = "";

			// revisi
			$this->revisi->ViewValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tgl_terbit
			$this->tgl_terbit->ViewValue = $this->tgl_terbit->CurrentValue;
			$this->tgl_terbit->ViewValue = FormatDateTime($this->tgl_terbit->ViewValue, 0);
			$this->tgl_terbit->ViewCustomAttributes = "";

			// deskripsi_singkat
			$this->deskripsi_singkat->ViewValue = $this->deskripsi_singkat->CurrentValue;
			$this->deskripsi_singkat->ViewCustomAttributes = "";

			// tujuan
			$this->tujuan->ViewValue = $this->tujuan->CurrentValue;
			$this->tujuan->ViewCustomAttributes = "";

			// target_peserta
			$this->target_peserta->ViewValue = $this->target_peserta->CurrentValue;
			$this->target_peserta->ViewCustomAttributes = "";

			// lama_pelatihan
			$curVal = strval($this->lama_pelatihan->CurrentValue);
			if ($curVal != "") {
				$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->lookupCacheOption($curVal);
				if ($this->lama_pelatihan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`angka`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->lama_pelatihan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->CurrentValue;
					}
				}
			} else {
				$this->lama_pelatihan->ViewValue = NULL;
			}
			$this->lama_pelatihan->ViewCustomAttributes = "";

			// catatan
			$this->catatan->ViewValue = $this->catatan->CurrentValue;
			$this->catatan->ViewCustomAttributes = "";

			// updated_by
			$this->updated_by->ViewValue = $this->updated_by->CurrentValue;
			$this->updated_by->ViewCustomAttributes = "";

			// updated_at
			$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
			$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
			$this->updated_at->ViewCustomAttributes = "";

			// singbagian
			$this->singbagian->LinkCustomAttributes = "";
			$this->singbagian->HrefValue = "";
			$this->singbagian->TooltipValue = "";

			// jpel
			$this->jpel->LinkCustomAttributes = "";
			$this->jpel->HrefValue = "";
			$this->jpel->TooltipValue = "";

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

			// deskripsi_singkat
			$this->deskripsi_singkat->LinkCustomAttributes = "";
			$this->deskripsi_singkat->HrefValue = "";
			if (!$this->isExport()) {
				$this->deskripsi_singkat->TooltipValue = strval($this->deskripsi_singkat->CurrentValue);
				$this->deskripsi_singkat->TooltipWidth = 500;
				if ($this->deskripsi_singkat->HrefValue == "")
					$this->deskripsi_singkat->HrefValue = "javascript:void(0);";
				$this->deskripsi_singkat->LinkAttrs->appendClass("ew-tooltip-link");
				$this->deskripsi_singkat->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x_deskripsi_singkat";
				$this->deskripsi_singkat->LinkAttrs["data-tooltip-width"] = $this->deskripsi_singkat->TooltipWidth;
				$this->deskripsi_singkat->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
			}

			// tujuan
			$this->tujuan->LinkCustomAttributes = "";
			$this->tujuan->HrefValue = "";
			if (!$this->isExport()) {
				$this->tujuan->TooltipValue = strval($this->tujuan->CurrentValue);
				$this->tujuan->TooltipWidth = 300;
				if ($this->tujuan->HrefValue == "")
					$this->tujuan->HrefValue = "javascript:void(0);";
				$this->tujuan->LinkAttrs->appendClass("ew-tooltip-link");
				$this->tujuan->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x_tujuan";
				$this->tujuan->LinkAttrs["data-tooltip-width"] = $this->tujuan->TooltipWidth;
				$this->tujuan->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
			}

			// target_peserta
			$this->target_peserta->LinkCustomAttributes = "";
			$this->target_peserta->HrefValue = "";
			if (!$this->isExport()) {
				$this->target_peserta->TooltipValue = strval($this->target_peserta->CurrentValue);
				$this->target_peserta->TooltipWidth = 300;
				if ($this->target_peserta->HrefValue == "")
					$this->target_peserta->HrefValue = "javascript:void(0);";
				$this->target_peserta->LinkAttrs->appendClass("ew-tooltip-link");
				$this->target_peserta->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x_target_peserta";
				$this->target_peserta->LinkAttrs["data-tooltip-width"] = $this->target_peserta->TooltipWidth;
				$this->target_peserta->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
			}

			// lama_pelatihan
			$this->lama_pelatihan->LinkCustomAttributes = "";
			$this->lama_pelatihan->HrefValue = "";
			$this->lama_pelatihan->TooltipValue = "";

			// catatan
			$this->catatan->LinkCustomAttributes = "";
			$this->catatan->HrefValue = "";
			$this->catatan->TooltipValue = "";

			// updated_by
			$this->updated_by->LinkCustomAttributes = "";
			$this->updated_by->HrefValue = "";
			$this->updated_by->TooltipValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// singbagian
			$this->singbagian->EditAttrs["class"] = "form-control";
			$this->singbagian->EditCustomAttributes = "";
			$curVal = strval($this->singbagian->CurrentValue);
			if ($curVal != "") {
				$this->singbagian->EditValue = $this->singbagian->lookupCacheOption($curVal);
				if ($this->singbagian->EditValue === NULL) { // Lookup from database
					$filterWrk = "`singkatan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->singbagian->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->singbagian->EditValue = $this->singbagian->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->singbagian->EditValue = $this->singbagian->CurrentValue;
					}
				}
			} else {
				$this->singbagian->EditValue = NULL;
			}
			$this->singbagian->ViewCustomAttributes = "";

			// jpel
			$this->jpel->EditAttrs["class"] = "form-control";
			$this->jpel->EditCustomAttributes = "";
			if (strval($this->jpel->CurrentValue) != "") {
				$this->jpel->EditValue = $this->jpel->optionCaption($this->jpel->CurrentValue);
			} else {
				$this->jpel->EditValue = NULL;
			}
			$this->jpel->ViewCustomAttributes = "";

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
			$this->kdkursil->EditValue = $this->kdkursil->CurrentValue;
			$this->kdkursil->ViewCustomAttributes = "";

			// revisi
			$this->revisi->EditAttrs["class"] = "form-control";
			$this->revisi->EditCustomAttributes = "";
			$this->revisi->EditValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tgl_terbit
			$this->tgl_terbit->EditAttrs["class"] = "form-control";
			$this->tgl_terbit->EditCustomAttributes = "";
			$this->tgl_terbit->EditValue = HtmlEncode(FormatDateTime($this->tgl_terbit->CurrentValue, 8));
			$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

			// deskripsi_singkat
			$this->deskripsi_singkat->EditAttrs["class"] = "form-control";
			$this->deskripsi_singkat->EditCustomAttributes = "";
			$this->deskripsi_singkat->EditValue = HtmlEncode($this->deskripsi_singkat->CurrentValue);
			$this->deskripsi_singkat->PlaceHolder = RemoveHtml($this->deskripsi_singkat->caption());

			// tujuan
			$this->tujuan->EditAttrs["class"] = "form-control";
			$this->tujuan->EditCustomAttributes = "";
			$this->tujuan->EditValue = HtmlEncode($this->tujuan->CurrentValue);
			$this->tujuan->PlaceHolder = RemoveHtml($this->tujuan->caption());

			// target_peserta
			$this->target_peserta->EditAttrs["class"] = "form-control";
			$this->target_peserta->EditCustomAttributes = "";
			$this->target_peserta->EditValue = HtmlEncode($this->target_peserta->CurrentValue);
			$this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

			// lama_pelatihan
			$this->lama_pelatihan->EditAttrs["class"] = "form-control";
			$this->lama_pelatihan->EditCustomAttributes = "";
			$curVal = strval($this->lama_pelatihan->CurrentValue);
			if ($curVal != "") {
				$this->lama_pelatihan->EditValue = $this->lama_pelatihan->lookupCacheOption($curVal);
				if ($this->lama_pelatihan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`angka`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->lama_pelatihan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->lama_pelatihan->EditValue = $this->lama_pelatihan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->lama_pelatihan->EditValue = $this->lama_pelatihan->CurrentValue;
					}
				}
			} else {
				$this->lama_pelatihan->EditValue = NULL;
			}
			$this->lama_pelatihan->ViewCustomAttributes = "";

			// catatan
			$this->catatan->EditAttrs["class"] = "form-control";
			$this->catatan->EditCustomAttributes = "";
			$this->catatan->EditValue = HtmlEncode($this->catatan->CurrentValue);
			$this->catatan->PlaceHolder = RemoveHtml($this->catatan->caption());

			// updated_by
			// updated_at
			// Edit refer script
			// singbagian

			$this->singbagian->LinkCustomAttributes = "";
			$this->singbagian->HrefValue = "";
			$this->singbagian->TooltipValue = "";

			// jpel
			$this->jpel->LinkCustomAttributes = "";
			$this->jpel->HrefValue = "";
			$this->jpel->TooltipValue = "";

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

			// deskripsi_singkat
			$this->deskripsi_singkat->LinkCustomAttributes = "";
			$this->deskripsi_singkat->HrefValue = "";

			// tujuan
			$this->tujuan->LinkCustomAttributes = "";
			$this->tujuan->HrefValue = "";

			// target_peserta
			$this->target_peserta->LinkCustomAttributes = "";
			$this->target_peserta->HrefValue = "";

			// lama_pelatihan
			$this->lama_pelatihan->LinkCustomAttributes = "";
			$this->lama_pelatihan->HrefValue = "";
			$this->lama_pelatihan->TooltipValue = "";

			// catatan
			$this->catatan->LinkCustomAttributes = "";
			$this->catatan->HrefValue = "";

			// updated_by
			$this->updated_by->LinkCustomAttributes = "";
			$this->updated_by->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
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
		if ($this->singbagian->Required) {
			if (!$this->singbagian->IsDetailKey && $this->singbagian->FormValue != NULL && $this->singbagian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->singbagian->caption(), $this->singbagian->RequiredErrorMessage));
			}
		}
		if ($this->jpel->Required) {
			if (!$this->jpel->IsDetailKey && $this->jpel->FormValue != NULL && $this->jpel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jpel->caption(), $this->jpel->RequiredErrorMessage));
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
		if ($this->deskripsi_singkat->Required) {
			if (!$this->deskripsi_singkat->IsDetailKey && $this->deskripsi_singkat->FormValue != NULL && $this->deskripsi_singkat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->deskripsi_singkat->caption(), $this->deskripsi_singkat->RequiredErrorMessage));
			}
		}
		if ($this->tujuan->Required) {
			if (!$this->tujuan->IsDetailKey && $this->tujuan->FormValue != NULL && $this->tujuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tujuan->caption(), $this->tujuan->RequiredErrorMessage));
			}
		}
		if ($this->target_peserta->Required) {
			if (!$this->target_peserta->IsDetailKey && $this->target_peserta->FormValue != NULL && $this->target_peserta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->target_peserta->caption(), $this->target_peserta->RequiredErrorMessage));
			}
		}
		if ($this->lama_pelatihan->Required) {
			if (!$this->lama_pelatihan->IsDetailKey && $this->lama_pelatihan->FormValue != NULL && $this->lama_pelatihan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->lama_pelatihan->caption(), $this->lama_pelatihan->RequiredErrorMessage));
			}
		}
		if ($this->catatan->Required) {
			if (!$this->catatan->IsDetailKey && $this->catatan->FormValue != NULL && $this->catatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->catatan->caption(), $this->catatan->RequiredErrorMessage));
			}
		}
		if ($this->updated_by->Required) {
			if (!$this->updated_by->IsDetailKey && $this->updated_by->FormValue != NULL && $this->updated_by->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_by->caption(), $this->updated_by->RequiredErrorMessage));
			}
		}
		if ($this->updated_at->Required) {
			if (!$this->updated_at->IsDetailKey && $this->updated_at->FormValue != NULL && $this->updated_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t_kurikulum", $detailTblVar) && $GLOBALS["t_kurikulum"]->DetailEdit) {
			if (!isset($GLOBALS["t_kurikulum_grid"]))
				$GLOBALS["t_kurikulum_grid"] = new t_kurikulum_grid(); // Get detail page object
			$GLOBALS["t_kurikulum_grid"]->validateGridForm();
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

			// tgl_terbit
			$this->tgl_terbit->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_terbit->CurrentValue, 0), NULL, $this->tgl_terbit->ReadOnly);

			// deskripsi_singkat
			$this->deskripsi_singkat->setDbValueDef($rsnew, $this->deskripsi_singkat->CurrentValue, NULL, $this->deskripsi_singkat->ReadOnly);

			// tujuan
			$this->tujuan->setDbValueDef($rsnew, $this->tujuan->CurrentValue, NULL, $this->tujuan->ReadOnly);

			// target_peserta
			$this->target_peserta->setDbValueDef($rsnew, $this->target_peserta->CurrentValue, NULL, $this->target_peserta->ReadOnly);

			// catatan
			$this->catatan->setDbValueDef($rsnew, $this->catatan->CurrentValue, NULL, $this->catatan->ReadOnly);

			// updated_by
			$this->updated_by->CurrentValue = CurrentUserName();
			$this->updated_by->setDbValueDef($rsnew, $this->updated_by->CurrentValue, NULL);

			// updated_at
			$this->updated_at->CurrentValue = CurrentDateTime();
			$this->updated_at->setDbValueDef($rsnew, $this->updated_at->CurrentValue, NULL);

			// Check referential integrity for master table 't_judul'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_judul();
			$keyValue = isset($rsnew['kdjudul']) ? $rsnew['kdjudul'] : $rsold['kdjudul'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@kdjudul@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_judul"]))
					$GLOBALS["t_judul"] = new t_judul();
				$rsmaster = $GLOBALS["t_judul"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_judul", $Language->phrase("RelatedRecordRequired"));
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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("t_kurikulum", $detailTblVar) && $GLOBALS["t_kurikulum"]->DetailEdit) {
						if (!isset($GLOBALS["t_kurikulum_grid"]))
							$GLOBALS["t_kurikulum_grid"] = new t_kurikulum_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "t_kurikulum"); // Load user level of detail table
						$editRow = $GLOBALS["t_kurikulum_grid"]->gridUpdate();
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
			if ($masterTblVar == "t_judul") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdjudul", Get("kdjudul"))) !== NULL) {
					$GLOBALS["t_judul"]->kdjudul->setQueryStringValue($parm);
					$this->kdjudul->setQueryStringValue($GLOBALS["t_judul"]->kdjudul->QueryStringValue);
					$this->kdjudul->setSessionValue($this->kdjudul->QueryStringValue);
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
			if ($masterTblVar == "t_judul") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdjudul", Post("kdjudul"))) !== NULL) {
					$GLOBALS["t_judul"]->kdjudul->setFormValue($parm);
					$this->kdjudul->setFormValue($GLOBALS["t_judul"]->kdjudul->FormValue);
					$this->kdjudul->setSessionValue($this->kdjudul->FormValue);
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
			if ($masterTblVar != "t_judul") {
				if ($this->kdjudul->CurrentValue == "")
					$this->kdjudul->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
			if (in_array("t_kurikulum", $detailTblVar)) {
				if (!isset($GLOBALS["t_kurikulum_grid"]))
					$GLOBALS["t_kurikulum_grid"] = new t_kurikulum_grid();
				if ($GLOBALS["t_kurikulum_grid"]->DetailEdit) {
					$GLOBALS["t_kurikulum_grid"]->CurrentMode = "edit";
					$GLOBALS["t_kurikulum_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t_kurikulum_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_kurikulum_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_kurikulum_grid"]->kdkursil->IsDetailKey = TRUE;
					$GLOBALS["t_kurikulum_grid"]->kdkursil->CurrentValue = $this->kdkursil->CurrentValue;
					$GLOBALS["t_kurikulum_grid"]->kdkursil->setSessionValue($GLOBALS["t_kurikulum_grid"]->kdkursil->CurrentValue);
					$GLOBALS["t_kurikulum_grid"]->jpel->IsDetailKey = TRUE;
					$GLOBALS["t_kurikulum_grid"]->jpel->CurrentValue = $this->jpel->CurrentValue;
					$GLOBALS["t_kurikulum_grid"]->jpel->setSessionValue($GLOBALS["t_kurikulum_grid"]->jpel->CurrentValue);
					$GLOBALS["t_kurikulum_grid"]->kdjudul->IsDetailKey = TRUE;
					$GLOBALS["t_kurikulum_grid"]->kdjudul->CurrentValue = $this->kdjudul->CurrentValue;
					$GLOBALS["t_kurikulum_grid"]->kdjudul->setSessionValue($GLOBALS["t_kurikulum_grid"]->kdjudul->CurrentValue);
					$GLOBALS["t_kurikulum_grid"]->revisi->IsDetailKey = TRUE;
					$GLOBALS["t_kurikulum_grid"]->revisi->CurrentValue = $this->revisi->CurrentValue;
					$GLOBALS["t_kurikulum_grid"]->revisi->setSessionValue($GLOBALS["t_kurikulum_grid"]->revisi->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_juduldetaillist.php"), "", $this->TableVar, TRUE);
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
				case "x_singbagian":
					break;
				case "x_jpel":
					break;
				case "x_kdjudul":
					break;
				case "x_lama_pelatihan":
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
						case "x_singbagian":
							break;
						case "x_kdjudul":
							break;
						case "x_lama_pelatihan":
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