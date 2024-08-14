<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_peserta_add extends t_peserta
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_peserta';

	// Page object name
	public $PageObjName = "t_peserta_add";

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

		// Table object (t_peserta)
		if (!isset($GLOBALS["t_peserta"]) || get_class($GLOBALS["t_peserta"]) == PROJECT_NAMESPACE . "t_peserta") {
			$GLOBALS["t_peserta"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_peserta"];
		}

		// Table object (t_kota)
		if (!isset($GLOBALS['t_kota']))
			$GLOBALS['t_kota'] = new t_kota();

		// Table object (t_perusahaan)
		if (!isset($GLOBALS['t_perusahaan']))
			$GLOBALS['t_perusahaan'] = new t_perusahaan();

		// Table object (t_prop)
		if (!isset($GLOBALS['t_prop']))
			$GLOBALS['t_prop'] = new t_prop();

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_peserta');

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
		global $t_peserta;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_peserta);
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
					if ($pageName == "t_pesertaview.php")
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
					$this->terminate(GetUrl("t_pesertalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->nama->setVisibility();
		$this->idp->setVisibility();
		$this->tempat->setVisibility();
		$this->tlahir->setVisibility();
		$this->usia->Visible = FALSE;
		$this->kdagama->setVisibility();
		$this->kdsex->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->alamat->setVisibility();
		$this->kdpos->setVisibility();
		$this->telp->setVisibility();
		$this->hp->setVisibility();
		$this->_email->setVisibility();
		$this->kdjabat->setVisibility();
		$this->kdpend->setVisibility();
		$this->kdbahasa->setVisibility();
		$this->kdinformasi->Visible = FALSE;
		$this->harapan->Visible = FALSE;
		$this->created_at->setVisibility();
		$this->updated_at->Visible = FALSE;
		$this->jpelatihan->Visible = FALSE;
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
		$this->setupLookupOptions($this->idp);
		$this->setupLookupOptions($this->kdagama);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);
		$this->setupLookupOptions($this->kdkec);
		$this->setupLookupOptions($this->kdjabat);
		$this->setupLookupOptions($this->kdpend);
		$this->setupLookupOptions($this->kdbahasa);
		$this->setupLookupOptions($this->kdinformasi);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_pesertalist.php");
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
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("t_pesertalist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() != "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "t_pesertalist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_pesertaview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->nama->CurrentValue = NULL;
		$this->nama->OldValue = $this->nama->CurrentValue;
		$this->idp->CurrentValue = NULL;
		$this->idp->OldValue = $this->idp->CurrentValue;
		$this->tempat->CurrentValue = NULL;
		$this->tempat->OldValue = $this->tempat->CurrentValue;
		$this->tlahir->CurrentValue = NULL;
		$this->tlahir->OldValue = $this->tlahir->CurrentValue;
		$this->usia->CurrentValue = NULL;
		$this->usia->OldValue = $this->usia->CurrentValue;
		$this->kdagama->CurrentValue = NULL;
		$this->kdagama->OldValue = $this->kdagama->CurrentValue;
		$this->kdsex->CurrentValue = NULL;
		$this->kdsex->OldValue = $this->kdsex->CurrentValue;
		$this->kdprop->CurrentValue = NULL;
		$this->kdprop->OldValue = $this->kdprop->CurrentValue;
		$this->kdkota->CurrentValue = NULL;
		$this->kdkota->OldValue = $this->kdkota->CurrentValue;
		$this->kdkec->CurrentValue = NULL;
		$this->kdkec->OldValue = $this->kdkec->CurrentValue;
		$this->alamat->CurrentValue = NULL;
		$this->alamat->OldValue = $this->alamat->CurrentValue;
		$this->kdpos->CurrentValue = NULL;
		$this->kdpos->OldValue = $this->kdpos->CurrentValue;
		$this->telp->CurrentValue = NULL;
		$this->telp->OldValue = $this->telp->CurrentValue;
		$this->hp->CurrentValue = NULL;
		$this->hp->OldValue = $this->hp->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->kdjabat->CurrentValue = NULL;
		$this->kdjabat->OldValue = $this->kdjabat->CurrentValue;
		$this->kdpend->CurrentValue = NULL;
		$this->kdpend->OldValue = $this->kdpend->CurrentValue;
		$this->kdbahasa->CurrentValue = NULL;
		$this->kdbahasa->OldValue = $this->kdbahasa->CurrentValue;
		$this->kdinformasi->CurrentValue = NULL;
		$this->kdinformasi->OldValue = $this->kdinformasi->CurrentValue;
		$this->harapan->CurrentValue = NULL;
		$this->harapan->OldValue = $this->harapan->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
		$this->jpelatihan->CurrentValue = NULL;
		$this->jpelatihan->OldValue = $this->jpelatihan->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'nama' first before field var 'x_nama'
		$val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
		if (!$this->nama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nama->Visible = FALSE; // Disable update for API request
			else
				$this->nama->setFormValue($val);
		}

		// Check field name 'idp' first before field var 'x_idp'
		$val = $CurrentForm->hasValue("idp") ? $CurrentForm->getValue("idp") : $CurrentForm->getValue("x_idp");
		if (!$this->idp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idp->Visible = FALSE; // Disable update for API request
			else
				$this->idp->setFormValue($val);
		}

		// Check field name 'tempat' first before field var 'x_tempat'
		$val = $CurrentForm->hasValue("tempat") ? $CurrentForm->getValue("tempat") : $CurrentForm->getValue("x_tempat");
		if (!$this->tempat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tempat->Visible = FALSE; // Disable update for API request
			else
				$this->tempat->setFormValue($val);
		}

		// Check field name 'tlahir' first before field var 'x_tlahir'
		$val = $CurrentForm->hasValue("tlahir") ? $CurrentForm->getValue("tlahir") : $CurrentForm->getValue("x_tlahir");
		if (!$this->tlahir->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tlahir->Visible = FALSE; // Disable update for API request
			else
				$this->tlahir->setFormValue($val);
			$this->tlahir->CurrentValue = UnFormatDateTime($this->tlahir->CurrentValue, 0);
		}

		// Check field name 'kdagama' first before field var 'x_kdagama'
		$val = $CurrentForm->hasValue("kdagama") ? $CurrentForm->getValue("kdagama") : $CurrentForm->getValue("x_kdagama");
		if (!$this->kdagama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdagama->Visible = FALSE; // Disable update for API request
			else
				$this->kdagama->setFormValue($val);
		}

		// Check field name 'kdsex' first before field var 'x_kdsex'
		$val = $CurrentForm->hasValue("kdsex") ? $CurrentForm->getValue("kdsex") : $CurrentForm->getValue("x_kdsex");
		if (!$this->kdsex->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdsex->Visible = FALSE; // Disable update for API request
			else
				$this->kdsex->setFormValue($val);
		}

		// Check field name 'kdprop' first before field var 'x_kdprop'
		$val = $CurrentForm->hasValue("kdprop") ? $CurrentForm->getValue("kdprop") : $CurrentForm->getValue("x_kdprop");
		if (!$this->kdprop->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdprop->Visible = FALSE; // Disable update for API request
			else
				$this->kdprop->setFormValue($val);
		}

		// Check field name 'kdkota' first before field var 'x_kdkota'
		$val = $CurrentForm->hasValue("kdkota") ? $CurrentForm->getValue("kdkota") : $CurrentForm->getValue("x_kdkota");
		if (!$this->kdkota->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkota->Visible = FALSE; // Disable update for API request
			else
				$this->kdkota->setFormValue($val);
		}

		// Check field name 'kdkec' first before field var 'x_kdkec'
		$val = $CurrentForm->hasValue("kdkec") ? $CurrentForm->getValue("kdkec") : $CurrentForm->getValue("x_kdkec");
		if (!$this->kdkec->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkec->Visible = FALSE; // Disable update for API request
			else
				$this->kdkec->setFormValue($val);
		}

		// Check field name 'alamat' first before field var 'x_alamat'
		$val = $CurrentForm->hasValue("alamat") ? $CurrentForm->getValue("alamat") : $CurrentForm->getValue("x_alamat");
		if (!$this->alamat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alamat->Visible = FALSE; // Disable update for API request
			else
				$this->alamat->setFormValue($val);
		}

		// Check field name 'kdpos' first before field var 'x_kdpos'
		$val = $CurrentForm->hasValue("kdpos") ? $CurrentForm->getValue("kdpos") : $CurrentForm->getValue("x_kdpos");
		if (!$this->kdpos->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdpos->Visible = FALSE; // Disable update for API request
			else
				$this->kdpos->setFormValue($val);
		}

		// Check field name 'telp' first before field var 'x_telp'
		$val = $CurrentForm->hasValue("telp") ? $CurrentForm->getValue("telp") : $CurrentForm->getValue("x_telp");
		if (!$this->telp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->telp->Visible = FALSE; // Disable update for API request
			else
				$this->telp->setFormValue($val);
		}

		// Check field name 'hp' first before field var 'x_hp'
		$val = $CurrentForm->hasValue("hp") ? $CurrentForm->getValue("hp") : $CurrentForm->getValue("x_hp");
		if (!$this->hp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->hp->Visible = FALSE; // Disable update for API request
			else
				$this->hp->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}

		// Check field name 'kdjabat' first before field var 'x_kdjabat'
		$val = $CurrentForm->hasValue("kdjabat") ? $CurrentForm->getValue("kdjabat") : $CurrentForm->getValue("x_kdjabat");
		if (!$this->kdjabat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdjabat->Visible = FALSE; // Disable update for API request
			else
				$this->kdjabat->setFormValue($val);
		}

		// Check field name 'kdpend' first before field var 'x_kdpend'
		$val = $CurrentForm->hasValue("kdpend") ? $CurrentForm->getValue("kdpend") : $CurrentForm->getValue("x_kdpend");
		if (!$this->kdpend->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdpend->Visible = FALSE; // Disable update for API request
			else
				$this->kdpend->setFormValue($val);
		}

		// Check field name 'kdbahasa' first before field var 'x_kdbahasa'
		$val = $CurrentForm->hasValue("kdbahasa") ? $CurrentForm->getValue("kdbahasa") : $CurrentForm->getValue("x_kdbahasa");
		if (!$this->kdbahasa->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdbahasa->Visible = FALSE; // Disable update for API request
			else
				$this->kdbahasa->setFormValue($val);
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

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->idp->CurrentValue = $this->idp->FormValue;
		$this->tempat->CurrentValue = $this->tempat->FormValue;
		$this->tlahir->CurrentValue = $this->tlahir->FormValue;
		$this->tlahir->CurrentValue = UnFormatDateTime($this->tlahir->CurrentValue, 0);
		$this->kdagama->CurrentValue = $this->kdagama->FormValue;
		$this->kdsex->CurrentValue = $this->kdsex->FormValue;
		$this->kdprop->CurrentValue = $this->kdprop->FormValue;
		$this->kdkota->CurrentValue = $this->kdkota->FormValue;
		$this->kdkec->CurrentValue = $this->kdkec->FormValue;
		$this->alamat->CurrentValue = $this->alamat->FormValue;
		$this->kdpos->CurrentValue = $this->kdpos->FormValue;
		$this->telp->CurrentValue = $this->telp->FormValue;
		$this->hp->CurrentValue = $this->hp->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->kdjabat->CurrentValue = $this->kdjabat->FormValue;
		$this->kdpend->CurrentValue = $this->kdpend->FormValue;
		$this->kdbahasa->CurrentValue = $this->kdbahasa->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
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
		$this->nama->setDbValue($row['nama']);
		$this->idp->setDbValue($row['idp']);
		if (array_key_exists('EV__idp', $rs->fields)) {
			$this->idp->VirtualValue = $rs->fields('EV__idp'); // Set up virtual field value
		} else {
			$this->idp->VirtualValue = ""; // Clear value
		}
		$this->tempat->setDbValue($row['tempat']);
		$this->tlahir->setDbValue($row['tlahir']);
		$this->usia->setDbValue($row['usia']);
		$this->kdagama->setDbValue($row['kdagama']);
		$this->kdsex->setDbValue($row['kdsex']);
		$this->kdprop->setDbValue($row['kdprop']);
		if (array_key_exists('EV__kdprop', $rs->fields)) {
			$this->kdprop->VirtualValue = $rs->fields('EV__kdprop'); // Set up virtual field value
		} else {
			$this->kdprop->VirtualValue = ""; // Clear value
		}
		$this->kdkota->setDbValue($row['kdkota']);
		if (array_key_exists('EV__kdkota', $rs->fields)) {
			$this->kdkota->VirtualValue = $rs->fields('EV__kdkota'); // Set up virtual field value
		} else {
			$this->kdkota->VirtualValue = ""; // Clear value
		}
		$this->kdkec->setDbValue($row['kdkec']);
		if (array_key_exists('EV__kdkec', $rs->fields)) {
			$this->kdkec->VirtualValue = $rs->fields('EV__kdkec'); // Set up virtual field value
		} else {
			$this->kdkec->VirtualValue = ""; // Clear value
		}
		$this->alamat->setDbValue($row['alamat']);
		$this->kdpos->setDbValue($row['kdpos']);
		$this->telp->setDbValue($row['telp']);
		$this->hp->setDbValue($row['hp']);
		$this->_email->setDbValue($row['email']);
		$this->kdjabat->setDbValue($row['kdjabat']);
		$this->kdpend->setDbValue($row['kdpend']);
		$this->kdbahasa->setDbValue($row['kdbahasa']);
		$this->kdinformasi->setDbValue($row['kdinformasi']);
		$this->harapan->setDbValue($row['harapan']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->jpelatihan->setDbValue($row['jpelatihan']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['nama'] = $this->nama->CurrentValue;
		$row['idp'] = $this->idp->CurrentValue;
		$row['tempat'] = $this->tempat->CurrentValue;
		$row['tlahir'] = $this->tlahir->CurrentValue;
		$row['usia'] = $this->usia->CurrentValue;
		$row['kdagama'] = $this->kdagama->CurrentValue;
		$row['kdsex'] = $this->kdsex->CurrentValue;
		$row['kdprop'] = $this->kdprop->CurrentValue;
		$row['kdkota'] = $this->kdkota->CurrentValue;
		$row['kdkec'] = $this->kdkec->CurrentValue;
		$row['alamat'] = $this->alamat->CurrentValue;
		$row['kdpos'] = $this->kdpos->CurrentValue;
		$row['telp'] = $this->telp->CurrentValue;
		$row['hp'] = $this->hp->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['kdjabat'] = $this->kdjabat->CurrentValue;
		$row['kdpend'] = $this->kdpend->CurrentValue;
		$row['kdbahasa'] = $this->kdbahasa->CurrentValue;
		$row['kdinformasi'] = $this->kdinformasi->CurrentValue;
		$row['harapan'] = $this->harapan->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		$row['jpelatihan'] = $this->jpelatihan->CurrentValue;
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
		// nama
		// idp
		// tempat
		// tlahir
		// usia
		// kdagama
		// kdsex
		// kdprop
		// kdkota
		// kdkec
		// alamat
		// kdpos
		// telp
		// hp
		// email
		// kdjabat
		// kdpend
		// kdbahasa
		// kdinformasi
		// harapan
		// created_at
		// updated_at
		// jpelatihan

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// idp
			if ($this->idp->VirtualValue != "") {
				$this->idp->ViewValue = $this->idp->VirtualValue;
			} else {
				$this->idp->ViewValue = $this->idp->CurrentValue;
				$curVal = strval($this->idp->CurrentValue);
				if ($curVal != "") {
					$this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
					if ($this->idp->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->idp->ViewValue = $this->idp->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->idp->ViewValue = $this->idp->CurrentValue;
						}
					}
				} else {
					$this->idp->ViewValue = NULL;
				}
			}
			$this->idp->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// tlahir
			$this->tlahir->ViewValue = $this->tlahir->CurrentValue;
			$this->tlahir->ViewValue = FormatDateTime($this->tlahir->ViewValue, 0);
			$this->tlahir->ViewCustomAttributes = "";

			// kdagama
			$curVal = strval($this->kdagama->CurrentValue);
			if ($curVal != "") {
				$this->kdagama->ViewValue = $this->kdagama->lookupCacheOption($curVal);
				if ($this->kdagama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdagama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdagama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdagama->ViewValue = $this->kdagama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdagama->ViewValue = $this->kdagama->CurrentValue;
					}
				}
			} else {
				$this->kdagama->ViewValue = NULL;
			}
			$this->kdagama->ViewCustomAttributes = "";

			// kdsex
			if (strval($this->kdsex->CurrentValue) != "") {
				$this->kdsex->ViewValue = $this->kdsex->optionCaption($this->kdsex->CurrentValue);
			} else {
				$this->kdsex->ViewValue = NULL;
			}
			$this->kdsex->ViewCustomAttributes = "";

			// kdprop
			if ($this->kdprop->VirtualValue != "") {
				$this->kdprop->ViewValue = $this->kdprop->VirtualValue;
			} else {
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
			}
			$this->kdprop->ViewCustomAttributes = "";

			// kdkota
			if ($this->kdkota->VirtualValue != "") {
				$this->kdkota->ViewValue = $this->kdkota->VirtualValue;
			} else {
				$curVal = strval($this->kdkota->CurrentValue);
				if ($curVal != "") {
					$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
					if ($this->kdkota->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->kdkota->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdkota->ViewValue = $this->kdkota->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdkota->ViewValue = $this->kdkota->CurrentValue;
						}
					}
				} else {
					$this->kdkota->ViewValue = NULL;
				}
			}
			$this->kdkota->ViewCustomAttributes = "";

			// kdkec
			if ($this->kdkec->VirtualValue != "") {
				$this->kdkec->ViewValue = $this->kdkec->VirtualValue;
			} else {
				$curVal = strval($this->kdkec->CurrentValue);
				if ($curVal != "") {
					$this->kdkec->ViewValue = $this->kdkec->lookupCacheOption($curVal);
					if ($this->kdkec->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`kdkec`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->kdkec->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdkec->ViewValue = $this->kdkec->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdkec->ViewValue = $this->kdkec->CurrentValue;
						}
					}
				} else {
					$this->kdkec->ViewValue = NULL;
				}
			}
			$this->kdkec->ViewCustomAttributes = "";

			// alamat
			$this->alamat->ViewValue = $this->alamat->CurrentValue;
			$this->alamat->ViewCustomAttributes = "";

			// kdpos
			$this->kdpos->ViewValue = $this->kdpos->CurrentValue;
			$this->kdpos->ViewCustomAttributes = "";

			// telp
			$this->telp->ViewValue = $this->telp->CurrentValue;
			$this->telp->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// kdjabat
			$curVal = strval($this->kdjabat->CurrentValue);
			if ($curVal != "") {
				$this->kdjabat->ViewValue = $this->kdjabat->lookupCacheOption($curVal);
				if ($this->kdjabat->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdjabat->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdjabat->ViewValue = $this->kdjabat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdjabat->ViewValue = $this->kdjabat->CurrentValue;
					}
				}
			} else {
				$this->kdjabat->ViewValue = NULL;
			}
			$this->kdjabat->ViewCustomAttributes = "";

			// kdpend
			$curVal = strval($this->kdpend->CurrentValue);
			if ($curVal != "") {
				$this->kdpend->ViewValue = $this->kdpend->lookupCacheOption($curVal);
				if ($this->kdpend->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdpend`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdpend->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdpend->ViewValue = $this->kdpend->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdpend->ViewValue = $this->kdpend->CurrentValue;
					}
				}
			} else {
				$this->kdpend->ViewValue = NULL;
			}
			$this->kdpend->ViewCustomAttributes = "";

			// kdbahasa
			$curVal = strval($this->kdbahasa->CurrentValue);
			if ($curVal != "") {
				$this->kdbahasa->ViewValue = $this->kdbahasa->lookupCacheOption($curVal);
				if ($this->kdbahasa->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdbahasa`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdbahasa->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdbahasa->ViewValue = $this->kdbahasa->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdbahasa->ViewValue = $this->kdbahasa->CurrentValue;
					}
				}
			} else {
				$this->kdbahasa->ViewValue = NULL;
			}
			$this->kdbahasa->ViewCustomAttributes = "";

			// created_at
			$this->created_at->ViewValue = $this->created_at->CurrentValue;
			$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
			$this->created_at->ViewCustomAttributes = "";

			// jpelatihan
			$this->jpelatihan->ViewValue = $this->jpelatihan->CurrentValue;
			$this->jpelatihan->CellCssStyle .= "text-align: center;";
			$this->jpelatihan->ViewCustomAttributes = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

			// idp
			$this->idp->LinkCustomAttributes = "";
			$this->idp->HrefValue = "";
			$this->idp->TooltipValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// tlahir
			$this->tlahir->LinkCustomAttributes = "";
			$this->tlahir->HrefValue = "";
			$this->tlahir->TooltipValue = "";

			// kdagama
			$this->kdagama->LinkCustomAttributes = "";
			$this->kdagama->HrefValue = "";
			$this->kdagama->TooltipValue = "";

			// kdsex
			$this->kdsex->LinkCustomAttributes = "";
			$this->kdsex->HrefValue = "";
			$this->kdsex->TooltipValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";
			$this->kdprop->TooltipValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";
			$this->kdkota->TooltipValue = "";

			// kdkec
			$this->kdkec->LinkCustomAttributes = "";
			$this->kdkec->HrefValue = "";
			$this->kdkec->TooltipValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";
			$this->alamat->TooltipValue = "";

			// kdpos
			$this->kdpos->LinkCustomAttributes = "";
			$this->kdpos->HrefValue = "";
			$this->kdpos->TooltipValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";
			$this->telp->TooltipValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";
			$this->hp->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// kdjabat
			$this->kdjabat->LinkCustomAttributes = "";
			$this->kdjabat->HrefValue = "";
			$this->kdjabat->TooltipValue = "";

			// kdpend
			$this->kdpend->LinkCustomAttributes = "";
			$this->kdpend->HrefValue = "";
			$this->kdpend->TooltipValue = "";

			// kdbahasa
			$this->kdbahasa->LinkCustomAttributes = "";
			$this->kdbahasa->HrefValue = "";
			$this->kdbahasa->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// idp
			$this->idp->EditAttrs["class"] = "form-control";
			$this->idp->EditCustomAttributes = "";
			if ($this->idp->getSessionValue() != "") {
				$this->idp->CurrentValue = $this->idp->getSessionValue();
				if ($this->idp->VirtualValue != "") {
					$this->idp->ViewValue = $this->idp->VirtualValue;
				} else {
					$this->idp->ViewValue = $this->idp->CurrentValue;
					$curVal = strval($this->idp->CurrentValue);
					if ($curVal != "") {
						$this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
						if ($this->idp->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->idp->ViewValue = $this->idp->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->idp->ViewValue = $this->idp->CurrentValue;
							}
						}
					} else {
						$this->idp->ViewValue = NULL;
					}
				}
				$this->idp->ViewCustomAttributes = "";
			} else {
				$this->idp->EditValue = HtmlEncode($this->idp->CurrentValue);
				$curVal = strval($this->idp->CurrentValue);
				if ($curVal != "") {
					$this->idp->EditValue = $this->idp->lookupCacheOption($curVal);
					if ($this->idp->EditValue === NULL) { // Lookup from database
						$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->idp->EditValue = $this->idp->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->idp->EditValue = HtmlEncode($this->idp->CurrentValue);
						}
					}
				} else {
					$this->idp->EditValue = NULL;
				}
				$this->idp->PlaceHolder = RemoveHtml($this->idp->caption());
			}

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			if (!$this->tempat->Raw)
				$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
			$this->tempat->EditValue = HtmlEncode($this->tempat->CurrentValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// tlahir
			$this->tlahir->EditAttrs["class"] = "form-control";
			$this->tlahir->EditCustomAttributes = "";
			$this->tlahir->EditValue = HtmlEncode(FormatDateTime($this->tlahir->CurrentValue, 8));
			$this->tlahir->PlaceHolder = RemoveHtml($this->tlahir->caption());

			// kdagama
			$this->kdagama->EditAttrs["class"] = "form-control";
			$this->kdagama->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdagama->CurrentValue));
			if ($curVal != "")
				$this->kdagama->ViewValue = $this->kdagama->lookupCacheOption($curVal);
			else
				$this->kdagama->ViewValue = $this->kdagama->Lookup !== NULL && is_array($this->kdagama->Lookup->Options) ? $curVal : NULL;
			if ($this->kdagama->ViewValue !== NULL) { // Load from cache
				$this->kdagama->EditValue = array_values($this->kdagama->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdagama`" . SearchString("=", $this->kdagama->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdagama->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdagama->EditValue = $arwrk;
			}

			// kdsex
			$this->kdsex->EditCustomAttributes = "";
			$this->kdsex->EditValue = $this->kdsex->options(FALSE);

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";
			if ($this->kdprop->getSessionValue() != "") {
				$this->kdprop->CurrentValue = $this->kdprop->getSessionValue();
				if ($this->kdprop->VirtualValue != "") {
					$this->kdprop->ViewValue = $this->kdprop->VirtualValue;
				} else {
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

			// kdkota
			$this->kdkota->EditAttrs["class"] = "form-control";
			$this->kdkota->EditCustomAttributes = "";
			if ($this->kdkota->getSessionValue() != "") {
				$this->kdkota->CurrentValue = $this->kdkota->getSessionValue();
				if ($this->kdkota->VirtualValue != "") {
					$this->kdkota->ViewValue = $this->kdkota->VirtualValue;
				} else {
					$curVal = strval($this->kdkota->CurrentValue);
					if ($curVal != "") {
						$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
						if ($this->kdkota->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->kdkota->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->kdkota->ViewValue = $this->kdkota->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->kdkota->ViewValue = $this->kdkota->CurrentValue;
							}
						}
					} else {
						$this->kdkota->ViewValue = NULL;
					}
				}
				$this->kdkota->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->kdkota->CurrentValue));
				if ($curVal != "")
					$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
				else
					$this->kdkota->ViewValue = $this->kdkota->Lookup !== NULL && is_array($this->kdkota->Lookup->Options) ? $curVal : NULL;
				if ($this->kdkota->ViewValue !== NULL) { // Load from cache
					$this->kdkota->EditValue = array_values($this->kdkota->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`kdkota`" . SearchString("=", $this->kdkota->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->kdkota->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->kdkota->EditValue = $arwrk;
				}
			}

			// kdkec
			$this->kdkec->EditAttrs["class"] = "form-control";
			$this->kdkec->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkec->CurrentValue));
			if ($curVal != "")
				$this->kdkec->ViewValue = $this->kdkec->lookupCacheOption($curVal);
			else
				$this->kdkec->ViewValue = $this->kdkec->Lookup !== NULL && is_array($this->kdkec->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkec->ViewValue !== NULL) { // Load from cache
				$this->kdkec->EditValue = array_values($this->kdkec->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkec`" . SearchString("=", $this->kdkec->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdkec->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdkec->EditValue = $arwrk;
			}

			// alamat
			$this->alamat->EditAttrs["class"] = "form-control";
			$this->alamat->EditCustomAttributes = "";
			$this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
			$this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

			// kdpos
			$this->kdpos->EditAttrs["class"] = "form-control";
			$this->kdpos->EditCustomAttributes = "";
			if (!$this->kdpos->Raw)
				$this->kdpos->CurrentValue = HtmlDecode($this->kdpos->CurrentValue);
			$this->kdpos->EditValue = HtmlEncode($this->kdpos->CurrentValue);
			$this->kdpos->PlaceHolder = RemoveHtml($this->kdpos->caption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			if (!$this->telp->Raw)
				$this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
			$this->telp->EditValue = HtmlEncode($this->telp->CurrentValue);
			$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
			$this->hp->EditValue = HtmlEncode($this->hp->CurrentValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			if (!$this->_email->Raw)
				$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// kdjabat
			$this->kdjabat->EditAttrs["class"] = "form-control";
			$this->kdjabat->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdjabat->CurrentValue));
			if ($curVal != "")
				$this->kdjabat->ViewValue = $this->kdjabat->lookupCacheOption($curVal);
			else
				$this->kdjabat->ViewValue = $this->kdjabat->Lookup !== NULL && is_array($this->kdjabat->Lookup->Options) ? $curVal : NULL;
			if ($this->kdjabat->ViewValue !== NULL) { // Load from cache
				$this->kdjabat->EditValue = array_values($this->kdjabat->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdjabat`" . SearchString("=", $this->kdjabat->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdjabat->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdjabat->EditValue = $arwrk;
			}

			// kdpend
			$this->kdpend->EditAttrs["class"] = "form-control";
			$this->kdpend->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdpend->CurrentValue));
			if ($curVal != "")
				$this->kdpend->ViewValue = $this->kdpend->lookupCacheOption($curVal);
			else
				$this->kdpend->ViewValue = $this->kdpend->Lookup !== NULL && is_array($this->kdpend->Lookup->Options) ? $curVal : NULL;
			if ($this->kdpend->ViewValue !== NULL) { // Load from cache
				$this->kdpend->EditValue = array_values($this->kdpend->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdpend`" . SearchString("=", $this->kdpend->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdpend->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdpend->EditValue = $arwrk;
			}

			// kdbahasa
			$this->kdbahasa->EditAttrs["class"] = "form-control";
			$this->kdbahasa->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdbahasa->CurrentValue));
			if ($curVal != "")
				$this->kdbahasa->ViewValue = $this->kdbahasa->lookupCacheOption($curVal);
			else
				$this->kdbahasa->ViewValue = $this->kdbahasa->Lookup !== NULL && is_array($this->kdbahasa->Lookup->Options) ? $curVal : NULL;
			if ($this->kdbahasa->ViewValue !== NULL) { // Load from cache
				$this->kdbahasa->EditValue = array_values($this->kdbahasa->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdbahasa`" . SearchString("=", $this->kdbahasa->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdbahasa->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdbahasa->EditValue = $arwrk;
			}

			// created_at
			// Add refer script
			// nama

			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// idp
			$this->idp->LinkCustomAttributes = "";
			$this->idp->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";

			// tlahir
			$this->tlahir->LinkCustomAttributes = "";
			$this->tlahir->HrefValue = "";

			// kdagama
			$this->kdagama->LinkCustomAttributes = "";
			$this->kdagama->HrefValue = "";

			// kdsex
			$this->kdsex->LinkCustomAttributes = "";
			$this->kdsex->HrefValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";

			// kdkec
			$this->kdkec->LinkCustomAttributes = "";
			$this->kdkec->HrefValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";

			// kdpos
			$this->kdpos->LinkCustomAttributes = "";
			$this->kdpos->HrefValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// kdjabat
			$this->kdjabat->LinkCustomAttributes = "";
			$this->kdjabat->HrefValue = "";

			// kdpend
			$this->kdpend->LinkCustomAttributes = "";
			$this->kdpend->HrefValue = "";

			// kdbahasa
			$this->kdbahasa->LinkCustomAttributes = "";
			$this->kdbahasa->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
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
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->idp->Required) {
			if (!$this->idp->IsDetailKey && $this->idp->FormValue != NULL && $this->idp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idp->caption(), $this->idp->RequiredErrorMessage));
			}
		}
		if ($this->tempat->Required) {
			if (!$this->tempat->IsDetailKey && $this->tempat->FormValue != NULL && $this->tempat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tempat->caption(), $this->tempat->RequiredErrorMessage));
			}
		}
		if ($this->tlahir->Required) {
			if (!$this->tlahir->IsDetailKey && $this->tlahir->FormValue != NULL && $this->tlahir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tlahir->caption(), $this->tlahir->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tlahir->FormValue)) {
			AddMessage($FormError, $this->tlahir->errorMessage());
		}
		if ($this->kdagama->Required) {
			if (!$this->kdagama->IsDetailKey && $this->kdagama->FormValue != NULL && $this->kdagama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdagama->caption(), $this->kdagama->RequiredErrorMessage));
			}
		}
		if ($this->kdsex->Required) {
			if ($this->kdsex->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdsex->caption(), $this->kdsex->RequiredErrorMessage));
			}
		}
		if ($this->kdprop->Required) {
			if (!$this->kdprop->IsDetailKey && $this->kdprop->FormValue != NULL && $this->kdprop->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdprop->caption(), $this->kdprop->RequiredErrorMessage));
			}
		}
		if ($this->kdkota->Required) {
			if (!$this->kdkota->IsDetailKey && $this->kdkota->FormValue != NULL && $this->kdkota->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkota->caption(), $this->kdkota->RequiredErrorMessage));
			}
		}
		if ($this->kdkec->Required) {
			if (!$this->kdkec->IsDetailKey && $this->kdkec->FormValue != NULL && $this->kdkec->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkec->caption(), $this->kdkec->RequiredErrorMessage));
			}
		}
		if ($this->alamat->Required) {
			if (!$this->alamat->IsDetailKey && $this->alamat->FormValue != NULL && $this->alamat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
			}
		}
		if ($this->kdpos->Required) {
			if (!$this->kdpos->IsDetailKey && $this->kdpos->FormValue != NULL && $this->kdpos->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdpos->caption(), $this->kdpos->RequiredErrorMessage));
			}
		}
		if ($this->telp->Required) {
			if (!$this->telp->IsDetailKey && $this->telp->FormValue != NULL && $this->telp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telp->caption(), $this->telp->RequiredErrorMessage));
			}
		}
		if ($this->hp->Required) {
			if (!$this->hp->IsDetailKey && $this->hp->FormValue != NULL && $this->hp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hp->caption(), $this->hp->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
		}
		if ($this->kdjabat->Required) {
			if (!$this->kdjabat->IsDetailKey && $this->kdjabat->FormValue != NULL && $this->kdjabat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdjabat->caption(), $this->kdjabat->RequiredErrorMessage));
			}
		}
		if ($this->kdpend->Required) {
			if (!$this->kdpend->IsDetailKey && $this->kdpend->FormValue != NULL && $this->kdpend->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdpend->caption(), $this->kdpend->RequiredErrorMessage));
			}
		}
		if ($this->kdbahasa->Required) {
			if (!$this->kdbahasa->IsDetailKey && $this->kdbahasa->FormValue != NULL && $this->kdbahasa->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdbahasa->caption(), $this->kdbahasa->RequiredErrorMessage));
			}
		}
		if ($this->created_at->Required) {
			if (!$this->created_at->IsDetailKey && $this->created_at->FormValue != NULL && $this->created_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("cv_historipelatihanpeserta", $detailTblVar) && $GLOBALS["cv_historipelatihanpeserta"]->DetailAdd) {
			if (!isset($GLOBALS["cv_historipelatihanpeserta_grid"]))
				$GLOBALS["cv_historipelatihanpeserta_grid"] = new cv_historipelatihanpeserta_grid(); // Get detail page object
			$GLOBALS["cv_historipelatihanpeserta_grid"]->validateGridForm();
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

		// Check referential integrity for master table 't_peserta'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_prop();
		if (strval($this->kdprop->CurrentValue) != "") {
			$masterFilter = str_replace("@kdprop@", AdjustSql($this->kdprop->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_prop"]))
				$GLOBALS["t_prop"] = new t_prop();
			$rsmaster = $GLOBALS["t_prop"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_prop", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// nama
		$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, NULL, FALSE);

		// idp
		$this->idp->setDbValueDef($rsnew, $this->idp->CurrentValue, NULL, FALSE);

		// tempat
		$this->tempat->setDbValueDef($rsnew, $this->tempat->CurrentValue, NULL, FALSE);

		// tlahir
		$this->tlahir->setDbValueDef($rsnew, UnFormatDateTime($this->tlahir->CurrentValue, 0), NULL, FALSE);

		// kdagama
		$this->kdagama->setDbValueDef($rsnew, $this->kdagama->CurrentValue, NULL, FALSE);

		// kdsex
		$this->kdsex->setDbValueDef($rsnew, $this->kdsex->CurrentValue, NULL, FALSE);

		// kdprop
		$this->kdprop->setDbValueDef($rsnew, $this->kdprop->CurrentValue, NULL, FALSE);

		// kdkota
		$this->kdkota->setDbValueDef($rsnew, $this->kdkota->CurrentValue, NULL, FALSE);

		// kdkec
		$this->kdkec->setDbValueDef($rsnew, $this->kdkec->CurrentValue, NULL, FALSE);

		// alamat
		$this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, NULL, FALSE);

		// kdpos
		$this->kdpos->setDbValueDef($rsnew, $this->kdpos->CurrentValue, NULL, FALSE);

		// telp
		$this->telp->setDbValueDef($rsnew, $this->telp->CurrentValue, NULL, FALSE);

		// hp
		$this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, NULL, FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// kdjabat
		$this->kdjabat->setDbValueDef($rsnew, $this->kdjabat->CurrentValue, NULL, FALSE);

		// kdpend
		$this->kdpend->setDbValueDef($rsnew, $this->kdpend->CurrentValue, NULL, FALSE);

		// kdbahasa
		$this->kdbahasa->setDbValueDef($rsnew, $this->kdbahasa->CurrentValue, NULL, FALSE);

		// created_at
		$this->created_at->CurrentValue = CurrentDateTime();
		$this->created_at->setDbValueDef($rsnew, $this->created_at->CurrentValue, NULL);

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("cv_historipelatihanpeserta", $detailTblVar) && $GLOBALS["cv_historipelatihanpeserta"]->DetailAdd) {
				$GLOBALS["cv_historipelatihanpeserta"]->id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["cv_historipelatihanpeserta_grid"]))
					$GLOBALS["cv_historipelatihanpeserta_grid"] = new cv_historipelatihanpeserta_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "cv_historipelatihanpeserta"); // Load user level of detail table
				$addRow = $GLOBALS["cv_historipelatihanpeserta_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["cv_historipelatihanpeserta"]->id->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
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
			if ($masterTblVar == "t_perusahaan") {
				$validMaster = TRUE;
				if (($parm = Get("fk_idp", Get("idp"))) !== NULL) {
					$GLOBALS["t_perusahaan"]->idp->setQueryStringValue($parm);
					$this->idp->setQueryStringValue($GLOBALS["t_perusahaan"]->idp->QueryStringValue);
					$this->idp->setSessionValue($this->idp->QueryStringValue);
					if (!is_numeric($GLOBALS["t_perusahaan"]->idp->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_kota") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdkota", Get("kdkota"))) !== NULL) {
					$GLOBALS["t_kota"]->kdkota->setQueryStringValue($parm);
					$this->kdkota->setQueryStringValue($GLOBALS["t_kota"]->kdkota->QueryStringValue);
					$this->kdkota->setSessionValue($this->kdkota->QueryStringValue);
					if (!is_numeric($GLOBALS["t_kota"]->kdkota->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_prop") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdprop", Get("kdprop"))) !== NULL) {
					$GLOBALS["t_prop"]->kdprop->setQueryStringValue($parm);
					$this->kdprop->setQueryStringValue($GLOBALS["t_prop"]->kdprop->QueryStringValue);
					$this->kdprop->setSessionValue($this->kdprop->QueryStringValue);
					if (!is_numeric($GLOBALS["t_prop"]->kdprop->QueryStringValue))
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
			if ($masterTblVar == "t_perusahaan") {
				$validMaster = TRUE;
				if (($parm = Post("fk_idp", Post("idp"))) !== NULL) {
					$GLOBALS["t_perusahaan"]->idp->setFormValue($parm);
					$this->idp->setFormValue($GLOBALS["t_perusahaan"]->idp->FormValue);
					$this->idp->setSessionValue($this->idp->FormValue);
					if (!is_numeric($GLOBALS["t_perusahaan"]->idp->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_kota") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdkota", Post("kdkota"))) !== NULL) {
					$GLOBALS["t_kota"]->kdkota->setFormValue($parm);
					$this->kdkota->setFormValue($GLOBALS["t_kota"]->kdkota->FormValue);
					$this->kdkota->setSessionValue($this->kdkota->FormValue);
					if (!is_numeric($GLOBALS["t_kota"]->kdkota->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_prop") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdprop", Post("kdprop"))) !== NULL) {
					$GLOBALS["t_prop"]->kdprop->setFormValue($parm);
					$this->kdprop->setFormValue($GLOBALS["t_prop"]->kdprop->FormValue);
					$this->kdprop->setSessionValue($this->kdprop->FormValue);
					if (!is_numeric($GLOBALS["t_prop"]->kdprop->FormValue))
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
			if ($masterTblVar != "t_perusahaan") {
				if ($this->idp->CurrentValue == "")
					$this->idp->setSessionValue("");
			}
			if ($masterTblVar != "t_kota") {
				if ($this->kdkota->CurrentValue == "")
					$this->kdkota->setSessionValue("");
			}
			if ($masterTblVar != "t_prop") {
				if ($this->kdprop->CurrentValue == "")
					$this->kdprop->setSessionValue("");
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
			if (in_array("cv_historipelatihanpeserta", $detailTblVar)) {
				if (!isset($GLOBALS["cv_historipelatihanpeserta_grid"]))
					$GLOBALS["cv_historipelatihanpeserta_grid"] = new cv_historipelatihanpeserta_grid();
				if ($GLOBALS["cv_historipelatihanpeserta_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["cv_historipelatihanpeserta_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["cv_historipelatihanpeserta_grid"]->CurrentMode = "add";
					$GLOBALS["cv_historipelatihanpeserta_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["cv_historipelatihanpeserta_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cv_historipelatihanpeserta_grid"]->setStartRecordNumber(1);
					$GLOBALS["cv_historipelatihanpeserta_grid"]->id->IsDetailKey = TRUE;
					$GLOBALS["cv_historipelatihanpeserta_grid"]->id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["cv_historipelatihanpeserta_grid"]->id->setSessionValue($GLOBALS["cv_historipelatihanpeserta_grid"]->id->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_pesertalist.php"), "", $this->TableVar, TRUE);
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
				case "x_idp":
					break;
				case "x_kdagama":
					break;
				case "x_kdsex":
					break;
				case "x_kdprop":
					break;
				case "x_kdkota":
					break;
				case "x_kdkec":
					break;
				case "x_kdjabat":
					break;
				case "x_kdpend":
					break;
				case "x_kdbahasa":
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
						case "x_idp":
							break;
						case "x_kdagama":
							break;
						case "x_kdprop":
							break;
						case "x_kdkota":
							break;
						case "x_kdkec":
							break;
						case "x_kdjabat":
							break;
						case "x_kdpend":
							break;
						case "x_kdbahasa":
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