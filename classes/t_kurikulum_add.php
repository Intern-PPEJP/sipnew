<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_kurikulum_add extends t_kurikulum
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_kurikulum';

	// Page object name
	public $PageObjName = "t_kurikulum_add";

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

		// Table object (t_kurikulum)
		if (!isset($GLOBALS["t_kurikulum"]) || get_class($GLOBALS["t_kurikulum"]) == PROJECT_NAMESPACE . "t_kurikulum") {
			$GLOBALS["t_kurikulum"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_kurikulum"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (t_juduldetail)
		if (!isset($GLOBALS['t_juduldetail']))
			$GLOBALS['t_juduldetail'] = new t_juduldetail();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_kurikulum');

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
		global $t_kurikulum;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_kurikulum);
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
					if ($pageName == "t_kurikulumview.php")
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
			$key .= @$ar['kurikulumid'];
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
			$this->kurikulumid->Visible = FALSE;
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
					$this->terminate(GetUrl("t_kurikulumlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->kurikulumid->Visible = FALSE;
		$this->singbagian->Visible = FALSE;
		$this->jpel->Visible = FALSE;
		$this->kdjudul->Visible = FALSE;
		$this->lama_pelatihan->Visible = FALSE;
		$this->kdkursil->setVisibility();
		$this->revisi->Visible = FALSE;
		$this->hari->setVisibility();
		$this->kurikulum->setVisibility();
		$this->silabus->setVisibility();
		$this->tujuan_instruksional->setVisibility();
		$this->sesi->setVisibility();
		$this->created_by->setVisibility();
		$this->created_at->setVisibility();
		$this->updated_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
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
		$this->setupLookupOptions($this->singbagian);
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->lama_pelatihan);
		$this->setupLookupOptions($this->hari);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_kurikulumlist.php");
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
			if (Get("kurikulumid") !== NULL) {
				$this->kurikulumid->setQueryStringValue(Get("kurikulumid"));
				$this->setKey("kurikulumid", $this->kurikulumid->CurrentValue); // Set up key
			} else {
				$this->setKey("kurikulumid", ""); // Clear key
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
					$this->terminate("t_kurikulumlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "t_kurikulumlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_kurikulumview.php")
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
		$this->kurikulumid->CurrentValue = NULL;
		$this->kurikulumid->OldValue = $this->kurikulumid->CurrentValue;
		$this->singbagian->CurrentValue = NULL;
		$this->singbagian->OldValue = $this->singbagian->CurrentValue;
		$this->jpel->CurrentValue = NULL;
		$this->jpel->OldValue = $this->jpel->CurrentValue;
		$this->kdjudul->CurrentValue = NULL;
		$this->kdjudul->OldValue = $this->kdjudul->CurrentValue;
		$this->lama_pelatihan->CurrentValue = NULL;
		$this->lama_pelatihan->OldValue = $this->lama_pelatihan->CurrentValue;
		$this->kdkursil->CurrentValue = NULL;
		$this->kdkursil->OldValue = $this->kdkursil->CurrentValue;
		$this->revisi->CurrentValue = NULL;
		$this->revisi->OldValue = $this->revisi->CurrentValue;
		$this->hari->CurrentValue = NULL;
		$this->hari->OldValue = $this->hari->CurrentValue;
		$this->kurikulum->CurrentValue = NULL;
		$this->kurikulum->OldValue = $this->kurikulum->CurrentValue;
		$this->silabus->CurrentValue = NULL;
		$this->silabus->OldValue = $this->silabus->CurrentValue;
		$this->tujuan_instruksional->CurrentValue = NULL;
		$this->tujuan_instruksional->OldValue = $this->tujuan_instruksional->CurrentValue;
		$this->sesi->CurrentValue = NULL;
		$this->sesi->OldValue = $this->sesi->CurrentValue;
		$this->created_by->CurrentValue = NULL;
		$this->created_by->OldValue = $this->created_by->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->updated_by->CurrentValue = NULL;
		$this->updated_by->OldValue = $this->updated_by->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'kdkursil' first before field var 'x_kdkursil'
		$val = $CurrentForm->hasValue("kdkursil") ? $CurrentForm->getValue("kdkursil") : $CurrentForm->getValue("x_kdkursil");
		if (!$this->kdkursil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkursil->Visible = FALSE; // Disable update for API request
			else
				$this->kdkursil->setFormValue($val);
		}

		// Check field name 'hari' first before field var 'x_hari'
		$val = $CurrentForm->hasValue("hari") ? $CurrentForm->getValue("hari") : $CurrentForm->getValue("x_hari");
		if (!$this->hari->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->hari->Visible = FALSE; // Disable update for API request
			else
				$this->hari->setFormValue($val);
		}

		// Check field name 'kurikulum' first before field var 'x_kurikulum'
		$val = $CurrentForm->hasValue("kurikulum") ? $CurrentForm->getValue("kurikulum") : $CurrentForm->getValue("x_kurikulum");
		if (!$this->kurikulum->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kurikulum->Visible = FALSE; // Disable update for API request
			else
				$this->kurikulum->setFormValue($val);
		}

		// Check field name 'silabus' first before field var 'x_silabus'
		$val = $CurrentForm->hasValue("silabus") ? $CurrentForm->getValue("silabus") : $CurrentForm->getValue("x_silabus");
		if (!$this->silabus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->silabus->Visible = FALSE; // Disable update for API request
			else
				$this->silabus->setFormValue($val);
		}

		// Check field name 'tujuan_instruksional' first before field var 'x_tujuan_instruksional'
		$val = $CurrentForm->hasValue("tujuan_instruksional") ? $CurrentForm->getValue("tujuan_instruksional") : $CurrentForm->getValue("x_tujuan_instruksional");
		if (!$this->tujuan_instruksional->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tujuan_instruksional->Visible = FALSE; // Disable update for API request
			else
				$this->tujuan_instruksional->setFormValue($val);
		}

		// Check field name 'sesi' first before field var 'x_sesi'
		$val = $CurrentForm->hasValue("sesi") ? $CurrentForm->getValue("sesi") : $CurrentForm->getValue("x_sesi");
		if (!$this->sesi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sesi->Visible = FALSE; // Disable update for API request
			else
				$this->sesi->setFormValue($val);
		}

		// Check field name 'created_by' first before field var 'x_created_by'
		$val = $CurrentForm->hasValue("created_by") ? $CurrentForm->getValue("created_by") : $CurrentForm->getValue("x_created_by");
		if (!$this->created_by->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->created_by->Visible = FALSE; // Disable update for API request
			else
				$this->created_by->setFormValue($val);
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

		// Check field name 'kurikulumid' first before field var 'x_kurikulumid'
		$val = $CurrentForm->hasValue("kurikulumid") ? $CurrentForm->getValue("kurikulumid") : $CurrentForm->getValue("x_kurikulumid");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kdkursil->CurrentValue = $this->kdkursil->FormValue;
		$this->hari->CurrentValue = $this->hari->FormValue;
		$this->kurikulum->CurrentValue = $this->kurikulum->FormValue;
		$this->silabus->CurrentValue = $this->silabus->FormValue;
		$this->tujuan_instruksional->CurrentValue = $this->tujuan_instruksional->FormValue;
		$this->sesi->CurrentValue = $this->sesi->FormValue;
		$this->created_by->CurrentValue = $this->created_by->FormValue;
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
		$this->kurikulumid->setDbValue($row['kurikulumid']);
		$this->singbagian->setDbValue($row['singbagian']);
		$this->jpel->setDbValue($row['jpel']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		$this->lama_pelatihan->setDbValue($row['lama_pelatihan']);
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->revisi->setDbValue($row['revisi']);
		$this->hari->setDbValue($row['hari']);
		$this->kurikulum->setDbValue($row['kurikulum']);
		$this->silabus->setDbValue($row['silabus']);
		$this->tujuan_instruksional->setDbValue($row['tujuan_instruksional']);
		$this->sesi->setDbValue($row['sesi']);
		$this->created_by->setDbValue($row['created_by']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_by->setDbValue($row['updated_by']);
		$this->updated_at->setDbValue($row['updated_at']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['kurikulumid'] = $this->kurikulumid->CurrentValue;
		$row['singbagian'] = $this->singbagian->CurrentValue;
		$row['jpel'] = $this->jpel->CurrentValue;
		$row['kdjudul'] = $this->kdjudul->CurrentValue;
		$row['lama_pelatihan'] = $this->lama_pelatihan->CurrentValue;
		$row['kdkursil'] = $this->kdkursil->CurrentValue;
		$row['revisi'] = $this->revisi->CurrentValue;
		$row['hari'] = $this->hari->CurrentValue;
		$row['kurikulum'] = $this->kurikulum->CurrentValue;
		$row['silabus'] = $this->silabus->CurrentValue;
		$row['tujuan_instruksional'] = $this->tujuan_instruksional->CurrentValue;
		$row['sesi'] = $this->sesi->CurrentValue;
		$row['created_by'] = $this->created_by->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['updated_by'] = $this->updated_by->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("kurikulumid")) != "")
			$this->kurikulumid->OldValue = $this->getKey("kurikulumid"); // kurikulumid
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
		// kurikulumid
		// singbagian
		// jpel
		// kdjudul
		// lama_pelatihan
		// kdkursil
		// revisi
		// hari
		// kurikulum
		// silabus
		// tujuan_instruksional
		// sesi
		// created_by
		// created_at
		// updated_by
		// updated_at

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kdkursil
			$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
			$this->kdkursil->ViewCustomAttributes = "";

			// hari
			$curVal = strval($this->hari->CurrentValue);
			if ($curVal != "") {
				$this->hari->ViewValue = $this->hari->lookupCacheOption($curVal);
				if ($this->hari->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`angka`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->hari->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->hari->ViewValue = $this->hari->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->hari->ViewValue = $this->hari->CurrentValue;
					}
				}
			} else {
				$this->hari->ViewValue = NULL;
			}
			$this->hari->ViewCustomAttributes = "";

			// kurikulum
			$this->kurikulum->ViewValue = $this->kurikulum->CurrentValue;
			$this->kurikulum->ViewCustomAttributes = "";

			// silabus
			$this->silabus->ViewValue = $this->silabus->CurrentValue;
			$this->silabus->ViewCustomAttributes = "";

			// tujuan_instruksional
			$this->tujuan_instruksional->ViewValue = $this->tujuan_instruksional->CurrentValue;
			$this->tujuan_instruksional->ViewCustomAttributes = "";

			// sesi
			$this->sesi->ViewValue = $this->sesi->CurrentValue;
			$this->sesi->ViewCustomAttributes = "";

			// created_by
			$this->created_by->ViewValue = $this->created_by->CurrentValue;
			$this->created_by->ViewCustomAttributes = "";

			// created_at
			$this->created_at->ViewValue = $this->created_at->CurrentValue;
			$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
			$this->created_at->ViewCustomAttributes = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";
			$this->kdkursil->TooltipValue = "";

			// hari
			$this->hari->LinkCustomAttributes = "";
			$this->hari->HrefValue = "";
			$this->hari->TooltipValue = "";

			// kurikulum
			$this->kurikulum->LinkCustomAttributes = "";
			$this->kurikulum->HrefValue = "";
			$this->kurikulum->TooltipValue = "";

			// silabus
			$this->silabus->LinkCustomAttributes = "";
			$this->silabus->HrefValue = "";
			$this->silabus->TooltipValue = "";

			// tujuan_instruksional
			$this->tujuan_instruksional->LinkCustomAttributes = "";
			$this->tujuan_instruksional->HrefValue = "";
			$this->tujuan_instruksional->TooltipValue = "";

			// sesi
			$this->sesi->LinkCustomAttributes = "";
			$this->sesi->HrefValue = "";
			$this->sesi->TooltipValue = "";

			// created_by
			$this->created_by->LinkCustomAttributes = "";
			$this->created_by->HrefValue = "";
			$this->created_by->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// kdkursil
			$this->kdkursil->EditAttrs["class"] = "form-control";
			$this->kdkursil->EditCustomAttributes = "";
			if ($this->kdkursil->getSessionValue() != "") {
				$this->kdkursil->CurrentValue = $this->kdkursil->getSessionValue();
				$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
				$this->kdkursil->ViewCustomAttributes = "";
			} else {
				if (!$this->kdkursil->Raw)
					$this->kdkursil->CurrentValue = HtmlDecode($this->kdkursil->CurrentValue);
				$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->CurrentValue);
				$this->kdkursil->PlaceHolder = RemoveHtml($this->kdkursil->caption());
			}

			// hari
			$this->hari->EditAttrs["class"] = "form-control";
			$this->hari->EditCustomAttributes = "";
			$curVal = trim(strval($this->hari->CurrentValue));
			if ($curVal != "")
				$this->hari->ViewValue = $this->hari->lookupCacheOption($curVal);
			else
				$this->hari->ViewValue = $this->hari->Lookup !== NULL && is_array($this->hari->Lookup->Options) ? $curVal : NULL;
			if ($this->hari->ViewValue !== NULL) { // Load from cache
				$this->hari->EditValue = array_values($this->hari->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`angka`" . SearchString("=", $this->hari->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->hari->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->hari->EditValue = $arwrk;
			}

			// kurikulum
			$this->kurikulum->EditAttrs["class"] = "form-control";
			$this->kurikulum->EditCustomAttributes = "";
			$this->kurikulum->EditValue = HtmlEncode($this->kurikulum->CurrentValue);
			$this->kurikulum->PlaceHolder = RemoveHtml($this->kurikulum->caption());

			// silabus
			$this->silabus->EditAttrs["class"] = "form-control";
			$this->silabus->EditCustomAttributes = "";
			$this->silabus->EditValue = HtmlEncode($this->silabus->CurrentValue);
			$this->silabus->PlaceHolder = RemoveHtml($this->silabus->caption());

			// tujuan_instruksional
			$this->tujuan_instruksional->EditAttrs["class"] = "form-control";
			$this->tujuan_instruksional->EditCustomAttributes = "";
			$this->tujuan_instruksional->EditValue = HtmlEncode($this->tujuan_instruksional->CurrentValue);
			$this->tujuan_instruksional->PlaceHolder = RemoveHtml($this->tujuan_instruksional->caption());

			// sesi
			$this->sesi->EditAttrs["class"] = "form-control";
			$this->sesi->EditCustomAttributes = "";
			$this->sesi->EditValue = HtmlEncode($this->sesi->CurrentValue);
			$this->sesi->PlaceHolder = RemoveHtml($this->sesi->caption());

			// created_by
			// created_at
			// Add refer script
			// kdkursil

			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";

			// hari
			$this->hari->LinkCustomAttributes = "";
			$this->hari->HrefValue = "";

			// kurikulum
			$this->kurikulum->LinkCustomAttributes = "";
			$this->kurikulum->HrefValue = "";

			// silabus
			$this->silabus->LinkCustomAttributes = "";
			$this->silabus->HrefValue = "";

			// tujuan_instruksional
			$this->tujuan_instruksional->LinkCustomAttributes = "";
			$this->tujuan_instruksional->HrefValue = "";

			// sesi
			$this->sesi->LinkCustomAttributes = "";
			$this->sesi->HrefValue = "";

			// created_by
			$this->created_by->LinkCustomAttributes = "";
			$this->created_by->HrefValue = "";

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
		if ($this->kdkursil->Required) {
			if (!$this->kdkursil->IsDetailKey && $this->kdkursil->FormValue != NULL && $this->kdkursil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkursil->caption(), $this->kdkursil->RequiredErrorMessage));
			}
		}
		if ($this->hari->Required) {
			if (!$this->hari->IsDetailKey && $this->hari->FormValue != NULL && $this->hari->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hari->caption(), $this->hari->RequiredErrorMessage));
			}
		}
		if ($this->kurikulum->Required) {
			if (!$this->kurikulum->IsDetailKey && $this->kurikulum->FormValue != NULL && $this->kurikulum->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kurikulum->caption(), $this->kurikulum->RequiredErrorMessage));
			}
		}
		if ($this->silabus->Required) {
			if (!$this->silabus->IsDetailKey && $this->silabus->FormValue != NULL && $this->silabus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->silabus->caption(), $this->silabus->RequiredErrorMessage));
			}
		}
		if ($this->tujuan_instruksional->Required) {
			if (!$this->tujuan_instruksional->IsDetailKey && $this->tujuan_instruksional->FormValue != NULL && $this->tujuan_instruksional->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tujuan_instruksional->caption(), $this->tujuan_instruksional->RequiredErrorMessage));
			}
		}
		if ($this->sesi->Required) {
			if (!$this->sesi->IsDetailKey && $this->sesi->FormValue != NULL && $this->sesi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sesi->caption(), $this->sesi->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->sesi->FormValue)) {
			AddMessage($FormError, $this->sesi->errorMessage());
		}
		if ($this->created_by->Required) {
			if (!$this->created_by->IsDetailKey && $this->created_by->FormValue != NULL && $this->created_by->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->created_by->caption(), $this->created_by->RequiredErrorMessage));
			}
		}
		if ($this->created_at->Required) {
			if (!$this->created_at->IsDetailKey && $this->created_at->FormValue != NULL && $this->created_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
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
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// kdkursil
		$this->kdkursil->setDbValueDef($rsnew, $this->kdkursil->CurrentValue, NULL, FALSE);

		// hari
		$this->hari->setDbValueDef($rsnew, $this->hari->CurrentValue, NULL, FALSE);

		// kurikulum
		$this->kurikulum->setDbValueDef($rsnew, $this->kurikulum->CurrentValue, NULL, FALSE);

		// silabus
		$this->silabus->setDbValueDef($rsnew, $this->silabus->CurrentValue, NULL, FALSE);

		// tujuan_instruksional
		$this->tujuan_instruksional->setDbValueDef($rsnew, $this->tujuan_instruksional->CurrentValue, NULL, FALSE);

		// sesi
		$this->sesi->setDbValueDef($rsnew, $this->sesi->CurrentValue, NULL, FALSE);

		// created_by
		$this->created_by->CurrentValue = CurrentUserName();
		$this->created_by->setDbValueDef($rsnew, $this->created_by->CurrentValue, NULL);

		// created_at
		$this->created_at->CurrentValue = CurrentDateTime();
		$this->created_at->setDbValueDef($rsnew, $this->created_at->CurrentValue, NULL);

		// jpel
		if ($this->jpel->getSessionValue() != "") {
			$rsnew['jpel'] = $this->jpel->getSessionValue();
		}

		// kdjudul
		if ($this->kdjudul->getSessionValue() != "") {
			$rsnew['kdjudul'] = $this->kdjudul->getSessionValue();
		}

		// revisi
		if ($this->revisi->getSessionValue() != "") {
			$rsnew['revisi'] = $this->revisi->getSessionValue();
		}

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
			if ($masterTblVar == "t_juduldetail") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdkursil", Get("kdkursil"))) !== NULL) {
					$GLOBALS["t_juduldetail"]->kdkursil->setQueryStringValue($parm);
					$this->kdkursil->setQueryStringValue($GLOBALS["t_juduldetail"]->kdkursil->QueryStringValue);
					$this->kdkursil->setSessionValue($this->kdkursil->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_jpel", Get("jpel"))) !== NULL) {
					$GLOBALS["t_juduldetail"]->jpel->setQueryStringValue($parm);
					$this->jpel->setQueryStringValue($GLOBALS["t_juduldetail"]->jpel->QueryStringValue);
					$this->jpel->setSessionValue($this->jpel->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_kdjudul", Get("kdjudul"))) !== NULL) {
					$GLOBALS["t_juduldetail"]->kdjudul->setQueryStringValue($parm);
					$this->kdjudul->setQueryStringValue($GLOBALS["t_juduldetail"]->kdjudul->QueryStringValue);
					$this->kdjudul->setSessionValue($this->kdjudul->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_revisi", Get("revisi"))) !== NULL) {
					$GLOBALS["t_juduldetail"]->revisi->setQueryStringValue($parm);
					$this->revisi->setQueryStringValue($GLOBALS["t_juduldetail"]->revisi->QueryStringValue);
					$this->revisi->setSessionValue($this->revisi->QueryStringValue);
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
			if ($masterTblVar == "t_juduldetail") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdkursil", Post("kdkursil"))) !== NULL) {
					$GLOBALS["t_juduldetail"]->kdkursil->setFormValue($parm);
					$this->kdkursil->setFormValue($GLOBALS["t_juduldetail"]->kdkursil->FormValue);
					$this->kdkursil->setSessionValue($this->kdkursil->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_jpel", Post("jpel"))) !== NULL) {
					$GLOBALS["t_juduldetail"]->jpel->setFormValue($parm);
					$this->jpel->setFormValue($GLOBALS["t_juduldetail"]->jpel->FormValue);
					$this->jpel->setSessionValue($this->jpel->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_kdjudul", Post("kdjudul"))) !== NULL) {
					$GLOBALS["t_juduldetail"]->kdjudul->setFormValue($parm);
					$this->kdjudul->setFormValue($GLOBALS["t_juduldetail"]->kdjudul->FormValue);
					$this->kdjudul->setSessionValue($this->kdjudul->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_revisi", Post("revisi"))) !== NULL) {
					$GLOBALS["t_juduldetail"]->revisi->setFormValue($parm);
					$this->revisi->setFormValue($GLOBALS["t_juduldetail"]->revisi->FormValue);
					$this->revisi->setSessionValue($this->revisi->FormValue);
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
			if ($masterTblVar != "t_juduldetail") {
				if ($this->kdkursil->CurrentValue == "")
					$this->kdkursil->setSessionValue("");
				if ($this->jpel->CurrentValue == "")
					$this->jpel->setSessionValue("");
				if ($this->kdjudul->CurrentValue == "")
					$this->kdjudul->setSessionValue("");
				if ($this->revisi->CurrentValue == "")
					$this->revisi->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_kurikulumlist.php"), "", $this->TableVar, TRUE);
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
				case "x_singbagian":
					break;
				case "x_jpel":
					break;
				case "x_kdjudul":
					break;
				case "x_lama_pelatihan":
					break;
				case "x_hari":
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
						case "x_hari":
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