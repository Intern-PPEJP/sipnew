<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_rkcoaching_add extends t_rkcoaching
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_rkcoaching';

	// Page object name
	public $PageObjName = "t_rkcoaching_add";

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

		// Table object (t_rkcoaching)
		if (!isset($GLOBALS["t_rkcoaching"]) || get_class($GLOBALS["t_rkcoaching"]) == PROJECT_NAMESPACE . "t_rkcoaching") {
			$GLOBALS["t_rkcoaching"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_rkcoaching"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_rkcoaching');

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
		global $t_rkcoaching;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_rkcoaching);
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
					if ($pageName == "t_rkcoachingview.php")
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
			$key .= @$ar['rkid'];
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
			$this->rkid->Visible = FALSE;
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
					$this->terminate(GetUrl("t_rkcoachinglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->rkid->Visible = FALSE;
		$this->jenispel->Visible = FALSE;
		$this->kdkategori->setVisibility();
		$this->kerjasama->setVisibility();
		$this->area->setVisibility();
		$this->area2->Visible = FALSE;
		$this->tempat->setVisibility();
		$this->jml_tahapan->setVisibility();
		$this->jml_peserta->setVisibility();
		$this->tahun_keg->setVisibility();
		$this->tglrevisi->setVisibility();
		$this->mou->setVisibility();
		$this->real->Visible = FALSE;
		$this->sisa->Visible = FALSE;
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
		$this->setupLookupOptions($this->kdkategori);
		$this->setupLookupOptions($this->kerjasama);
		$this->setupLookupOptions($this->area);
		$this->setupLookupOptions($this->area2);
		$this->setupLookupOptions($this->tahun_keg);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_rkcoachinglist.php");
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
			if (Get("rkid") !== NULL) {
				$this->rkid->setQueryStringValue(Get("rkid"));
				$this->setKey("rkid", $this->rkid->CurrentValue); // Set up key
			} else {
				$this->setKey("rkid", ""); // Clear key
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
					$this->terminate("t_rkcoachinglist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "t_rkcoachinglist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_rkcoachingview.php")
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
		$this->mou->Upload->Index = $CurrentForm->Index;
		$this->mou->Upload->uploadFile();
		$this->mou->CurrentValue = $this->mou->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->rkid->CurrentValue = NULL;
		$this->rkid->OldValue = $this->rkid->CurrentValue;
		$this->jenispel->CurrentValue = NULL;
		$this->jenispel->OldValue = $this->jenispel->CurrentValue;
		$this->kdkategori->CurrentValue = NULL;
		$this->kdkategori->OldValue = $this->kdkategori->CurrentValue;
		$this->kerjasama->CurrentValue = NULL;
		$this->kerjasama->OldValue = $this->kerjasama->CurrentValue;
		$this->area->CurrentValue = NULL;
		$this->area->OldValue = $this->area->CurrentValue;
		$this->area2->CurrentValue = NULL;
		$this->area2->OldValue = $this->area2->CurrentValue;
		$this->tempat->CurrentValue = NULL;
		$this->tempat->OldValue = $this->tempat->CurrentValue;
		$this->jml_tahapan->CurrentValue = NULL;
		$this->jml_tahapan->OldValue = $this->jml_tahapan->CurrentValue;
		$this->jml_peserta->CurrentValue = NULL;
		$this->jml_peserta->OldValue = $this->jml_peserta->CurrentValue;
		$this->tahun_keg->CurrentValue = NULL;
		$this->tahun_keg->OldValue = $this->tahun_keg->CurrentValue;
		$this->tglrevisi->CurrentValue = CurrentDate();
		$this->mou->Upload->DbValue = NULL;
		$this->mou->OldValue = $this->mou->Upload->DbValue;
		$this->mou->CurrentValue = NULL; // Clear file related field
		$this->real->CurrentValue = NULL;
		$this->real->OldValue = $this->real->CurrentValue;
		$this->sisa->CurrentValue = NULL;
		$this->sisa->OldValue = $this->sisa->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

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

		// Check field name 'area' first before field var 'x_area'
		$val = $CurrentForm->hasValue("area") ? $CurrentForm->getValue("area") : $CurrentForm->getValue("x_area");
		if (!$this->area->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->area->Visible = FALSE; // Disable update for API request
			else
				$this->area->setFormValue($val);
		}

		// Check field name 'tempat' first before field var 'x_tempat'
		$val = $CurrentForm->hasValue("tempat") ? $CurrentForm->getValue("tempat") : $CurrentForm->getValue("x_tempat");
		if (!$this->tempat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tempat->Visible = FALSE; // Disable update for API request
			else
				$this->tempat->setFormValue($val);
		}

		// Check field name 'jml_tahapan' first before field var 'x_jml_tahapan'
		$val = $CurrentForm->hasValue("jml_tahapan") ? $CurrentForm->getValue("jml_tahapan") : $CurrentForm->getValue("x_jml_tahapan");
		if (!$this->jml_tahapan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_tahapan->Visible = FALSE; // Disable update for API request
			else
				$this->jml_tahapan->setFormValue($val);
		}

		// Check field name 'jml_peserta' first before field var 'x_jml_peserta'
		$val = $CurrentForm->hasValue("jml_peserta") ? $CurrentForm->getValue("jml_peserta") : $CurrentForm->getValue("x_jml_peserta");
		if (!$this->jml_peserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_peserta->Visible = FALSE; // Disable update for API request
			else
				$this->jml_peserta->setFormValue($val);
		}

		// Check field name 'tahun_keg' first before field var 'x_tahun_keg'
		$val = $CurrentForm->hasValue("tahun_keg") ? $CurrentForm->getValue("tahun_keg") : $CurrentForm->getValue("x_tahun_keg");
		if (!$this->tahun_keg->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tahun_keg->Visible = FALSE; // Disable update for API request
			else
				$this->tahun_keg->setFormValue($val);
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

		// Check field name 'rkid' first before field var 'x_rkid'
		$val = $CurrentForm->hasValue("rkid") ? $CurrentForm->getValue("rkid") : $CurrentForm->getValue("x_rkid");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kdkategori->CurrentValue = $this->kdkategori->FormValue;
		$this->kerjasama->CurrentValue = $this->kerjasama->FormValue;
		$this->area->CurrentValue = $this->area->FormValue;
		$this->tempat->CurrentValue = $this->tempat->FormValue;
		$this->jml_tahapan->CurrentValue = $this->jml_tahapan->FormValue;
		$this->jml_peserta->CurrentValue = $this->jml_peserta->FormValue;
		$this->tahun_keg->CurrentValue = $this->tahun_keg->FormValue;
		$this->tglrevisi->CurrentValue = $this->tglrevisi->FormValue;
		$this->tglrevisi->CurrentValue = UnFormatDateTime($this->tglrevisi->CurrentValue, 0);
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
		$this->rkid->setDbValue($row['rkid']);
		$this->jenispel->setDbValue($row['jenispel']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->kerjasama->setDbValue($row['kerjasama']);
		if (array_key_exists('EV__kerjasama', $rs->fields)) {
			$this->kerjasama->VirtualValue = $rs->fields('EV__kerjasama'); // Set up virtual field value
		} else {
			$this->kerjasama->VirtualValue = ""; // Clear value
		}
		$this->area->setDbValue($row['area']);
		if (array_key_exists('EV__area', $rs->fields)) {
			$this->area->VirtualValue = $rs->fields('EV__area'); // Set up virtual field value
		} else {
			$this->area->VirtualValue = ""; // Clear value
		}
		$this->area2->setDbValue($row['area2']);
		$this->tempat->setDbValue($row['tempat']);
		$this->jml_tahapan->setDbValue($row['jml_tahapan']);
		$this->jml_peserta->setDbValue($row['jml_peserta']);
		$this->tahun_keg->setDbValue($row['tahun_keg']);
		$this->tglrevisi->setDbValue($row['tglrevisi']);
		$this->mou->Upload->DbValue = $row['mou'];
		$this->mou->setDbValue($this->mou->Upload->DbValue);
		$this->real->setDbValue($row['real']);
		$this->sisa->setDbValue($row['sisa']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['rkid'] = $this->rkid->CurrentValue;
		$row['jenispel'] = $this->jenispel->CurrentValue;
		$row['kdkategori'] = $this->kdkategori->CurrentValue;
		$row['kerjasama'] = $this->kerjasama->CurrentValue;
		$row['area'] = $this->area->CurrentValue;
		$row['area2'] = $this->area2->CurrentValue;
		$row['tempat'] = $this->tempat->CurrentValue;
		$row['jml_tahapan'] = $this->jml_tahapan->CurrentValue;
		$row['jml_peserta'] = $this->jml_peserta->CurrentValue;
		$row['tahun_keg'] = $this->tahun_keg->CurrentValue;
		$row['tglrevisi'] = $this->tglrevisi->CurrentValue;
		$row['mou'] = $this->mou->Upload->DbValue;
		$row['real'] = $this->real->CurrentValue;
		$row['sisa'] = $this->sisa->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("rkid")) != "")
			$this->rkid->OldValue = $this->getKey("rkid"); // rkid
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
		// rkid
		// jenispel
		// kdkategori
		// kerjasama
		// area
		// area2
		// tempat
		// jml_tahapan
		// jml_peserta
		// tahun_keg
		// tglrevisi
		// mou
		// real
		// sisa

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// rkid
			$this->rkid->ViewValue = $this->rkid->CurrentValue;
			$this->rkid->ViewCustomAttributes = "";

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
			if ($this->kerjasama->VirtualValue != "") {
				$this->kerjasama->ViewValue = $this->kerjasama->VirtualValue;
			} else {
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
			}
			$this->kerjasama->ViewCustomAttributes = "";

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

			// area2
			$curVal = strval($this->area2->CurrentValue);
			if ($curVal != "") {
				$this->area2->ViewValue = $this->area2->lookupCacheOption($curVal);
				if ($this->area2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->area2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->area2->ViewValue = $this->area2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->area2->ViewValue = $this->area2->CurrentValue;
					}
				}
			} else {
				$this->area2->ViewValue = NULL;
			}
			$this->area2->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// jml_tahapan
			$this->jml_tahapan->ViewValue = $this->jml_tahapan->CurrentValue;
			$this->jml_tahapan->ViewValue = FormatNumber($this->jml_tahapan->ViewValue, 0, -2, -2, -2);
			$this->jml_tahapan->ViewCustomAttributes = "";

			// jml_peserta
			$this->jml_peserta->ViewValue = $this->jml_peserta->CurrentValue;
			$this->jml_peserta->ViewValue = FormatNumber($this->jml_peserta->ViewValue, 0, -2, -2, -2);
			$this->jml_peserta->ViewCustomAttributes = "";

			// tahun_keg
			$curVal = strval($this->tahun_keg->CurrentValue);
			if ($curVal != "") {
				$this->tahun_keg->ViewValue = $this->tahun_keg->lookupCacheOption($curVal);
				if ($this->tahun_keg->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->tahun_keg->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->tahun_keg->ViewValue = $this->tahun_keg->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->tahun_keg->ViewValue = $this->tahun_keg->CurrentValue;
					}
				}
			} else {
				$this->tahun_keg->ViewValue = NULL;
			}
			$this->tahun_keg->ViewCustomAttributes = "";

			// tglrevisi
			$this->tglrevisi->ViewValue = $this->tglrevisi->CurrentValue;
			$this->tglrevisi->ViewValue = FormatDateTime($this->tglrevisi->ViewValue, 0);
			$this->tglrevisi->ViewCustomAttributes = "";

			// mou
			if (!EmptyValue($this->mou->Upload->DbValue)) {
				$this->mou->ViewValue = $this->mou->Upload->DbValue;
			} else {
				$this->mou->ViewValue = "";
			}
			$this->mou->ViewCustomAttributes = "";

			// real
			$this->real->ViewValue = $this->real->CurrentValue;
			$this->real->ViewValue = FormatNumber($this->real->ViewValue, 0, -2, -2, -2);
			$this->real->ViewCustomAttributes = "";

			// sisa
			$this->sisa->ViewValue = $this->sisa->CurrentValue;
			$this->sisa->ViewCustomAttributes = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";
			$this->kdkategori->TooltipValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";
			$this->kerjasama->TooltipValue = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";
			$this->area->TooltipValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// jml_tahapan
			$this->jml_tahapan->LinkCustomAttributes = "";
			$this->jml_tahapan->HrefValue = "";
			$this->jml_tahapan->TooltipValue = "";

			// jml_peserta
			$this->jml_peserta->LinkCustomAttributes = "";
			$this->jml_peserta->HrefValue = "";
			$this->jml_peserta->TooltipValue = "";

			// tahun_keg
			$this->tahun_keg->LinkCustomAttributes = "";
			$this->tahun_keg->HrefValue = "";
			$this->tahun_keg->TooltipValue = "";

			// tglrevisi
			$this->tglrevisi->LinkCustomAttributes = "";
			$this->tglrevisi->HrefValue = "";
			$this->tglrevisi->TooltipValue = "";

			// mou
			$this->mou->LinkCustomAttributes = "";
			$this->mou->HrefValue = "";
			$this->mou->ExportHrefValue = $this->mou->UploadPath . $this->mou->Upload->DbValue;
			$this->mou->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// area
			$this->area->EditAttrs["class"] = "form-control";
			$this->area->EditCustomAttributes = "";
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

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			if (!$this->tempat->Raw)
				$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
			$this->tempat->EditValue = HtmlEncode($this->tempat->CurrentValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// jml_tahapan
			$this->jml_tahapan->EditAttrs["class"] = "form-control";
			$this->jml_tahapan->EditCustomAttributes = "";
			$this->jml_tahapan->EditValue = HtmlEncode($this->jml_tahapan->CurrentValue);
			$this->jml_tahapan->PlaceHolder = RemoveHtml($this->jml_tahapan->caption());

			// jml_peserta
			$this->jml_peserta->EditAttrs["class"] = "form-control";
			$this->jml_peserta->EditCustomAttributes = "";
			$this->jml_peserta->EditValue = HtmlEncode($this->jml_peserta->CurrentValue);
			$this->jml_peserta->PlaceHolder = RemoveHtml($this->jml_peserta->caption());

			// tahun_keg
			$this->tahun_keg->EditAttrs["class"] = "form-control";
			$this->tahun_keg->EditCustomAttributes = "";
			$curVal = trim(strval($this->tahun_keg->CurrentValue));
			if ($curVal != "")
				$this->tahun_keg->ViewValue = $this->tahun_keg->lookupCacheOption($curVal);
			else
				$this->tahun_keg->ViewValue = $this->tahun_keg->Lookup !== NULL && is_array($this->tahun_keg->Lookup->Options) ? $curVal : NULL;
			if ($this->tahun_keg->ViewValue !== NULL) { // Load from cache
				$this->tahun_keg->EditValue = array_values($this->tahun_keg->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`tahun`" . SearchString("=", $this->tahun_keg->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->tahun_keg->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->tahun_keg->EditValue = $arwrk;
			}

			// tglrevisi
			// mou

			$this->mou->EditAttrs["class"] = "form-control";
			$this->mou->EditCustomAttributes = "";
			if (!EmptyValue($this->mou->Upload->DbValue)) {
				$this->mou->EditValue = $this->mou->Upload->DbValue;
			} else {
				$this->mou->EditValue = "";
			}
			if (!EmptyValue($this->mou->CurrentValue))
					$this->mou->Upload->FileName = $this->mou->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->mou);

			// Add refer script
			// kdkategori

			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";

			// jml_tahapan
			$this->jml_tahapan->LinkCustomAttributes = "";
			$this->jml_tahapan->HrefValue = "";

			// jml_peserta
			$this->jml_peserta->LinkCustomAttributes = "";
			$this->jml_peserta->HrefValue = "";

			// tahun_keg
			$this->tahun_keg->LinkCustomAttributes = "";
			$this->tahun_keg->HrefValue = "";

			// tglrevisi
			$this->tglrevisi->LinkCustomAttributes = "";
			$this->tglrevisi->HrefValue = "";

			// mou
			$this->mou->LinkCustomAttributes = "";
			$this->mou->HrefValue = "";
			$this->mou->ExportHrefValue = $this->mou->UploadPath . $this->mou->Upload->DbValue;
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
		if ($this->area->Required) {
			if (!$this->area->IsDetailKey && $this->area->FormValue != NULL && $this->area->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->area->caption(), $this->area->RequiredErrorMessage));
			}
		}
		if ($this->tempat->Required) {
			if (!$this->tempat->IsDetailKey && $this->tempat->FormValue != NULL && $this->tempat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tempat->caption(), $this->tempat->RequiredErrorMessage));
			}
		}
		if ($this->jml_tahapan->Required) {
			if (!$this->jml_tahapan->IsDetailKey && $this->jml_tahapan->FormValue != NULL && $this->jml_tahapan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_tahapan->caption(), $this->jml_tahapan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jml_tahapan->FormValue)) {
			AddMessage($FormError, $this->jml_tahapan->errorMessage());
		}
		if ($this->jml_peserta->Required) {
			if (!$this->jml_peserta->IsDetailKey && $this->jml_peserta->FormValue != NULL && $this->jml_peserta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_peserta->caption(), $this->jml_peserta->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jml_peserta->FormValue)) {
			AddMessage($FormError, $this->jml_peserta->errorMessage());
		}
		if ($this->tahun_keg->Required) {
			if (!$this->tahun_keg->IsDetailKey && $this->tahun_keg->FormValue != NULL && $this->tahun_keg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tahun_keg->caption(), $this->tahun_keg->RequiredErrorMessage));
			}
		}
		if ($this->tglrevisi->Required) {
			if (!$this->tglrevisi->IsDetailKey && $this->tglrevisi->FormValue != NULL && $this->tglrevisi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglrevisi->caption(), $this->tglrevisi->RequiredErrorMessage));
			}
		}
		if ($this->mou->Required) {
			if ($this->mou->Upload->FileName == "" && !$this->mou->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->mou->caption(), $this->mou->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t_coachingtahapan", $detailTblVar) && $GLOBALS["t_coachingtahapan"]->DetailAdd) {
			if (!isset($GLOBALS["t_coachingtahapan_grid"]))
				$GLOBALS["t_coachingtahapan_grid"] = new t_coachingtahapan_grid(); // Get detail page object
			$GLOBALS["t_coachingtahapan_grid"]->validateGridForm();
		}
		if (in_array("t_coaching", $detailTblVar) && $GLOBALS["t_coaching"]->DetailAdd) {
			if (!isset($GLOBALS["t_coaching_grid"]))
				$GLOBALS["t_coaching_grid"] = new t_coaching_grid(); // Get detail page object
			$GLOBALS["t_coaching_grid"]->validateGridForm();
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

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// kdkategori
		$this->kdkategori->setDbValueDef($rsnew, $this->kdkategori->CurrentValue, NULL, FALSE);

		// kerjasama
		$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, NULL, FALSE);

		// area
		$this->area->setDbValueDef($rsnew, $this->area->CurrentValue, NULL, FALSE);

		// tempat
		$this->tempat->setDbValueDef($rsnew, $this->tempat->CurrentValue, "", FALSE);

		// jml_tahapan
		$this->jml_tahapan->setDbValueDef($rsnew, $this->jml_tahapan->CurrentValue, 0, FALSE);

		// jml_peserta
		$this->jml_peserta->setDbValueDef($rsnew, $this->jml_peserta->CurrentValue, 0, FALSE);

		// tahun_keg
		$this->tahun_keg->setDbValueDef($rsnew, $this->tahun_keg->CurrentValue, NULL, FALSE);

		// tglrevisi
		$this->tglrevisi->CurrentValue = CurrentDate();
		$this->tglrevisi->setDbValueDef($rsnew, $this->tglrevisi->CurrentValue, NULL);

		// mou
		if ($this->mou->Visible && !$this->mou->Upload->KeepFile) {
			$this->mou->Upload->DbValue = ""; // No need to delete old file
			if ($this->mou->Upload->FileName == "") {
				$rsnew['mou'] = NULL;
			} else {
				$rsnew['mou'] = $this->mou->Upload->FileName;
			}
		}
		if ($this->mou->Visible && !$this->mou->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->mou->Upload->DbValue) ? [] : [$this->mou->htmlDecode($this->mou->Upload->DbValue)];
			if (!EmptyValue($this->mou->Upload->FileName)) {
				$newFiles = [$this->mou->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->mou, $this->mou->Upload->Index);
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
							$file1 = UniqueFilename($this->mou->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->mou->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->mou->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->mou->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->mou->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->mou->setDbValueDef($rsnew, $this->mou->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
				if ($this->mou->Visible && !$this->mou->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->mou->Upload->DbValue) ? [] : [$this->mou->htmlDecode($this->mou->Upload->DbValue)];
					if (!EmptyValue($this->mou->Upload->FileName)) {
						$newFiles = [$this->mou->Upload->FileName];
						$newFiles2 = [$this->mou->htmlDecode($rsnew['mou'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->mou, $this->mou->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->mou->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->mou->oldPhysicalUploadPath() . $oldFile);
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
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("t_coachingtahapan", $detailTblVar) && $GLOBALS["t_coachingtahapan"]->DetailAdd) {
				$GLOBALS["t_coachingtahapan"]->rkid->setSessionValue($this->rkid->CurrentValue); // Set master key
				$GLOBALS["t_coachingtahapan"]->area->setSessionValue($this->area->CurrentValue); // Set master key
				if (!isset($GLOBALS["t_coachingtahapan_grid"]))
					$GLOBALS["t_coachingtahapan_grid"] = new t_coachingtahapan_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "t_coachingtahapan"); // Load user level of detail table
				$addRow = $GLOBALS["t_coachingtahapan_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["t_coachingtahapan"]->rkid->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["t_coachingtahapan"]->area->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("t_coaching", $detailTblVar) && $GLOBALS["t_coaching"]->DetailAdd) {
				$GLOBALS["t_coaching"]->rkid->setSessionValue($this->rkid->CurrentValue); // Set master key
				$GLOBALS["t_coaching"]->kdprop->setSessionValue($this->area->CurrentValue); // Set master key
				if (!isset($GLOBALS["t_coaching_grid"]))
					$GLOBALS["t_coaching_grid"] = new t_coaching_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "t_coaching"); // Load user level of detail table
				$addRow = $GLOBALS["t_coaching_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["t_coaching"]->rkid->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["t_coaching"]->kdprop->setSessionValue(""); // Clear master key if insert failed
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

			// mou
			CleanUploadTempPath($this->mou, $this->mou->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
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
			if (in_array("t_coachingtahapan", $detailTblVar)) {
				if (!isset($GLOBALS["t_coachingtahapan_grid"]))
					$GLOBALS["t_coachingtahapan_grid"] = new t_coachingtahapan_grid();
				if ($GLOBALS["t_coachingtahapan_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t_coachingtahapan_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t_coachingtahapan_grid"]->CurrentMode = "add";
					$GLOBALS["t_coachingtahapan_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t_coachingtahapan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_coachingtahapan_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_coachingtahapan_grid"]->rkid->IsDetailKey = TRUE;
					$GLOBALS["t_coachingtahapan_grid"]->rkid->CurrentValue = $this->rkid->CurrentValue;
					$GLOBALS["t_coachingtahapan_grid"]->rkid->setSessionValue($GLOBALS["t_coachingtahapan_grid"]->rkid->CurrentValue);
					$GLOBALS["t_coachingtahapan_grid"]->area->IsDetailKey = TRUE;
					$GLOBALS["t_coachingtahapan_grid"]->area->CurrentValue = $this->area->CurrentValue;
					$GLOBALS["t_coachingtahapan_grid"]->area->setSessionValue($GLOBALS["t_coachingtahapan_grid"]->area->CurrentValue);
				}
			}
			if (in_array("t_coaching", $detailTblVar)) {
				if (!isset($GLOBALS["t_coaching_grid"]))
					$GLOBALS["t_coaching_grid"] = new t_coaching_grid();
				if ($GLOBALS["t_coaching_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t_coaching_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t_coaching_grid"]->CurrentMode = "add";
					$GLOBALS["t_coaching_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t_coaching_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_coaching_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_coaching_grid"]->rkid->IsDetailKey = TRUE;
					$GLOBALS["t_coaching_grid"]->rkid->CurrentValue = $this->rkid->CurrentValue;
					$GLOBALS["t_coaching_grid"]->rkid->setSessionValue($GLOBALS["t_coaching_grid"]->rkid->CurrentValue);
					$GLOBALS["t_coaching_grid"]->kdprop->IsDetailKey = TRUE;
					$GLOBALS["t_coaching_grid"]->kdprop->CurrentValue = $this->area->CurrentValue;
					$GLOBALS["t_coaching_grid"]->kdprop->setSessionValue($GLOBALS["t_coaching_grid"]->kdprop->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_rkcoachinglist.php"), "", $this->TableVar, TRUE);
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
				case "x_jenispel":
					break;
				case "x_kdkategori":
					break;
				case "x_kerjasama":
					break;
				case "x_area":
					break;
				case "x_area2":
					break;
				case "x_tahun_keg":
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
						case "x_kdkategori":
							break;
						case "x_kerjasama":
							break;
						case "x_area":
							break;
						case "x_area2":
							break;
						case "x_tahun_keg":
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