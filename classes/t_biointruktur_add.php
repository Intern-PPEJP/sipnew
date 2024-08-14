<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_biointruktur_add extends t_biointruktur
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_biointruktur';

	// Page object name
	public $PageObjName = "t_biointruktur_add";

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

		// Table object (t_biointruktur)
		if (!isset($GLOBALS["t_biointruktur"]) || get_class($GLOBALS["t_biointruktur"]) == PROJECT_NAMESPACE . "t_biointruktur") {
			$GLOBALS["t_biointruktur"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_biointruktur"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_biointruktur');

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
		global $t_biointruktur;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_biointruktur);
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
					if ($pageName == "t_biointrukturview.php")
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
			$key .= @$ar['bioid'];
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
			$this->bioid->Visible = FALSE;
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
	public $DetailPages; // Detail pages object

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
					$this->terminate(GetUrl("t_biointrukturlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->bioid->Visible = FALSE;
		$this->kdinstruktur->setVisibility();
		$this->revisi->setVisibility();
		$this->tglterbit->setVisibility();
		$this->nama->setVisibility();
		$this->komp_materi->setVisibility();
		$this->tmplahir->setVisibility();
		$this->tgllahir->setVisibility();
		$this->agama->setVisibility();
		$this->kategori->setVisibility();
		$this->instansi->setVisibility();
		$this->pekerjaan->setVisibility();
		$this->alamatkantor->setVisibility();
		$this->alamatrumah->setVisibility();
		$this->telepon->setVisibility();
		$this->hp->setVisibility();
		$this->_email->setVisibility();
		$this->fax->setVisibility();
		$this->created_by->setVisibility();
		$this->created_at->setVisibility();
		$this->updated_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up detail page object
		$this->setupDetailPages();

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
		$this->setupLookupOptions($this->komp_materi);
		$this->setupLookupOptions($this->agama);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_biointrukturlist.php");
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
			if (Get("bioid") !== NULL) {
				$this->bioid->setQueryStringValue(Get("bioid"));
				$this->setKey("bioid", $this->bioid->CurrentValue); // Set up key
			} else {
				$this->setKey("bioid", ""); // Clear key
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
					$this->terminate("t_biointrukturlist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "t_biointrukturlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_biointrukturview.php")
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
		$this->bioid->CurrentValue = NULL;
		$this->bioid->OldValue = $this->bioid->CurrentValue;
		$this->kdinstruktur->CurrentValue = NULL;
		$this->kdinstruktur->OldValue = $this->kdinstruktur->CurrentValue;
		$this->revisi->CurrentValue = NULL;
		$this->revisi->OldValue = $this->revisi->CurrentValue;
		$this->tglterbit->CurrentValue = NULL;
		$this->tglterbit->OldValue = $this->tglterbit->CurrentValue;
		$this->nama->CurrentValue = NULL;
		$this->nama->OldValue = $this->nama->CurrentValue;
		$this->komp_materi->CurrentValue = NULL;
		$this->komp_materi->OldValue = $this->komp_materi->CurrentValue;
		$this->tmplahir->CurrentValue = NULL;
		$this->tmplahir->OldValue = $this->tmplahir->CurrentValue;
		$this->tgllahir->CurrentValue = NULL;
		$this->tgllahir->OldValue = $this->tgllahir->CurrentValue;
		$this->agama->CurrentValue = NULL;
		$this->agama->OldValue = $this->agama->CurrentValue;
		$this->kategori->CurrentValue = NULL;
		$this->kategori->OldValue = $this->kategori->CurrentValue;
		$this->instansi->CurrentValue = NULL;
		$this->instansi->OldValue = $this->instansi->CurrentValue;
		$this->pekerjaan->CurrentValue = NULL;
		$this->pekerjaan->OldValue = $this->pekerjaan->CurrentValue;
		$this->alamatkantor->CurrentValue = NULL;
		$this->alamatkantor->OldValue = $this->alamatkantor->CurrentValue;
		$this->alamatrumah->CurrentValue = NULL;
		$this->alamatrumah->OldValue = $this->alamatrumah->CurrentValue;
		$this->telepon->CurrentValue = NULL;
		$this->telepon->OldValue = $this->telepon->CurrentValue;
		$this->hp->CurrentValue = NULL;
		$this->hp->OldValue = $this->hp->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->fax->CurrentValue = NULL;
		$this->fax->OldValue = $this->fax->CurrentValue;
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

		// Check field name 'kdinstruktur' first before field var 'x_kdinstruktur'
		$val = $CurrentForm->hasValue("kdinstruktur") ? $CurrentForm->getValue("kdinstruktur") : $CurrentForm->getValue("x_kdinstruktur");
		if (!$this->kdinstruktur->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdinstruktur->Visible = FALSE; // Disable update for API request
			else
				$this->kdinstruktur->setFormValue($val);
		}

		// Check field name 'revisi' first before field var 'x_revisi'
		$val = $CurrentForm->hasValue("revisi") ? $CurrentForm->getValue("revisi") : $CurrentForm->getValue("x_revisi");
		if (!$this->revisi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->revisi->Visible = FALSE; // Disable update for API request
			else
				$this->revisi->setFormValue($val);
		}

		// Check field name 'tglterbit' first before field var 'x_tglterbit'
		$val = $CurrentForm->hasValue("tglterbit") ? $CurrentForm->getValue("tglterbit") : $CurrentForm->getValue("x_tglterbit");
		if (!$this->tglterbit->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglterbit->Visible = FALSE; // Disable update for API request
			else
				$this->tglterbit->setFormValue($val);
			$this->tglterbit->CurrentValue = UnFormatDateTime($this->tglterbit->CurrentValue, 0);
		}

		// Check field name 'nama' first before field var 'x_nama'
		$val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
		if (!$this->nama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nama->Visible = FALSE; // Disable update for API request
			else
				$this->nama->setFormValue($val);
		}

		// Check field name 'komp_materi' first before field var 'x_komp_materi'
		$val = $CurrentForm->hasValue("komp_materi") ? $CurrentForm->getValue("komp_materi") : $CurrentForm->getValue("x_komp_materi");
		if (!$this->komp_materi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->komp_materi->Visible = FALSE; // Disable update for API request
			else
				$this->komp_materi->setFormValue($val);
		}

		// Check field name 'tmplahir' first before field var 'x_tmplahir'
		$val = $CurrentForm->hasValue("tmplahir") ? $CurrentForm->getValue("tmplahir") : $CurrentForm->getValue("x_tmplahir");
		if (!$this->tmplahir->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tmplahir->Visible = FALSE; // Disable update for API request
			else
				$this->tmplahir->setFormValue($val);
		}

		// Check field name 'tgllahir' first before field var 'x_tgllahir'
		$val = $CurrentForm->hasValue("tgllahir") ? $CurrentForm->getValue("tgllahir") : $CurrentForm->getValue("x_tgllahir");
		if (!$this->tgllahir->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgllahir->Visible = FALSE; // Disable update for API request
			else
				$this->tgllahir->setFormValue($val);
			$this->tgllahir->CurrentValue = UnFormatDateTime($this->tgllahir->CurrentValue, 0);
		}

		// Check field name 'agama' first before field var 'x_agama'
		$val = $CurrentForm->hasValue("agama") ? $CurrentForm->getValue("agama") : $CurrentForm->getValue("x_agama");
		if (!$this->agama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->agama->Visible = FALSE; // Disable update for API request
			else
				$this->agama->setFormValue($val);
		}

		// Check field name 'kategori' first before field var 'x_kategori'
		$val = $CurrentForm->hasValue("kategori") ? $CurrentForm->getValue("kategori") : $CurrentForm->getValue("x_kategori");
		if (!$this->kategori->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kategori->Visible = FALSE; // Disable update for API request
			else
				$this->kategori->setFormValue($val);
		}

		// Check field name 'instansi' first before field var 'x_instansi'
		$val = $CurrentForm->hasValue("instansi") ? $CurrentForm->getValue("instansi") : $CurrentForm->getValue("x_instansi");
		if (!$this->instansi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->instansi->Visible = FALSE; // Disable update for API request
			else
				$this->instansi->setFormValue($val);
		}

		// Check field name 'pekerjaan' first before field var 'x_pekerjaan'
		$val = $CurrentForm->hasValue("pekerjaan") ? $CurrentForm->getValue("pekerjaan") : $CurrentForm->getValue("x_pekerjaan");
		if (!$this->pekerjaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pekerjaan->Visible = FALSE; // Disable update for API request
			else
				$this->pekerjaan->setFormValue($val);
		}

		// Check field name 'alamatkantor' first before field var 'x_alamatkantor'
		$val = $CurrentForm->hasValue("alamatkantor") ? $CurrentForm->getValue("alamatkantor") : $CurrentForm->getValue("x_alamatkantor");
		if (!$this->alamatkantor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alamatkantor->Visible = FALSE; // Disable update for API request
			else
				$this->alamatkantor->setFormValue($val);
		}

		// Check field name 'alamatrumah' first before field var 'x_alamatrumah'
		$val = $CurrentForm->hasValue("alamatrumah") ? $CurrentForm->getValue("alamatrumah") : $CurrentForm->getValue("x_alamatrumah");
		if (!$this->alamatrumah->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alamatrumah->Visible = FALSE; // Disable update for API request
			else
				$this->alamatrumah->setFormValue($val);
		}

		// Check field name 'telepon' first before field var 'x_telepon'
		$val = $CurrentForm->hasValue("telepon") ? $CurrentForm->getValue("telepon") : $CurrentForm->getValue("x_telepon");
		if (!$this->telepon->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->telepon->Visible = FALSE; // Disable update for API request
			else
				$this->telepon->setFormValue($val);
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

		// Check field name 'fax' first before field var 'x_fax'
		$val = $CurrentForm->hasValue("fax") ? $CurrentForm->getValue("fax") : $CurrentForm->getValue("x_fax");
		if (!$this->fax->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->fax->Visible = FALSE; // Disable update for API request
			else
				$this->fax->setFormValue($val);
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

		// Check field name 'bioid' first before field var 'x_bioid'
		$val = $CurrentForm->hasValue("bioid") ? $CurrentForm->getValue("bioid") : $CurrentForm->getValue("x_bioid");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kdinstruktur->CurrentValue = $this->kdinstruktur->FormValue;
		$this->revisi->CurrentValue = $this->revisi->FormValue;
		$this->tglterbit->CurrentValue = $this->tglterbit->FormValue;
		$this->tglterbit->CurrentValue = UnFormatDateTime($this->tglterbit->CurrentValue, 0);
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->komp_materi->CurrentValue = $this->komp_materi->FormValue;
		$this->tmplahir->CurrentValue = $this->tmplahir->FormValue;
		$this->tgllahir->CurrentValue = $this->tgllahir->FormValue;
		$this->tgllahir->CurrentValue = UnFormatDateTime($this->tgllahir->CurrentValue, 0);
		$this->agama->CurrentValue = $this->agama->FormValue;
		$this->kategori->CurrentValue = $this->kategori->FormValue;
		$this->instansi->CurrentValue = $this->instansi->FormValue;
		$this->pekerjaan->CurrentValue = $this->pekerjaan->FormValue;
		$this->alamatkantor->CurrentValue = $this->alamatkantor->FormValue;
		$this->alamatrumah->CurrentValue = $this->alamatrumah->FormValue;
		$this->telepon->CurrentValue = $this->telepon->FormValue;
		$this->hp->CurrentValue = $this->hp->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->fax->CurrentValue = $this->fax->FormValue;
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
		$this->bioid->setDbValue($row['bioid']);
		$this->kdinstruktur->setDbValue($row['kdinstruktur']);
		$this->revisi->setDbValue($row['revisi']);
		$this->tglterbit->setDbValue($row['tglterbit']);
		$this->nama->setDbValue($row['nama']);
		$this->komp_materi->setDbValue($row['komp_materi']);
		$this->tmplahir->setDbValue($row['tmplahir']);
		$this->tgllahir->setDbValue($row['tgllahir']);
		$this->agama->setDbValue($row['agama']);
		$this->kategori->setDbValue($row['kategori']);
		$this->instansi->setDbValue($row['instansi']);
		$this->pekerjaan->setDbValue($row['pekerjaan']);
		$this->alamatkantor->setDbValue($row['alamatkantor']);
		$this->alamatrumah->setDbValue($row['alamatrumah']);
		$this->telepon->setDbValue($row['telepon']);
		$this->hp->setDbValue($row['hp']);
		$this->_email->setDbValue($row['email']);
		$this->fax->setDbValue($row['fax']);
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
		$row['bioid'] = $this->bioid->CurrentValue;
		$row['kdinstruktur'] = $this->kdinstruktur->CurrentValue;
		$row['revisi'] = $this->revisi->CurrentValue;
		$row['tglterbit'] = $this->tglterbit->CurrentValue;
		$row['nama'] = $this->nama->CurrentValue;
		$row['komp_materi'] = $this->komp_materi->CurrentValue;
		$row['tmplahir'] = $this->tmplahir->CurrentValue;
		$row['tgllahir'] = $this->tgllahir->CurrentValue;
		$row['agama'] = $this->agama->CurrentValue;
		$row['kategori'] = $this->kategori->CurrentValue;
		$row['instansi'] = $this->instansi->CurrentValue;
		$row['pekerjaan'] = $this->pekerjaan->CurrentValue;
		$row['alamatkantor'] = $this->alamatkantor->CurrentValue;
		$row['alamatrumah'] = $this->alamatrumah->CurrentValue;
		$row['telepon'] = $this->telepon->CurrentValue;
		$row['hp'] = $this->hp->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['fax'] = $this->fax->CurrentValue;
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
		if (strval($this->getKey("bioid")) != "")
			$this->bioid->OldValue = $this->getKey("bioid"); // bioid
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
		// bioid
		// kdinstruktur
		// revisi
		// tglterbit
		// nama
		// komp_materi
		// tmplahir
		// tgllahir
		// agama
		// kategori
		// instansi
		// pekerjaan
		// alamatkantor
		// alamatrumah
		// telepon
		// hp
		// email
		// fax
		// created_by
		// created_at
		// updated_by
		// updated_at

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kdinstruktur
			$this->kdinstruktur->ViewValue = $this->kdinstruktur->CurrentValue;
			$this->kdinstruktur->ViewCustomAttributes = "";

			// revisi
			$this->revisi->ViewValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tglterbit
			$this->tglterbit->ViewValue = $this->tglterbit->CurrentValue;
			$this->tglterbit->ViewValue = FormatDateTime($this->tglterbit->ViewValue, 0);
			$this->tglterbit->ViewCustomAttributes = "";

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// komp_materi
			$this->komp_materi->ViewValue = $this->komp_materi->CurrentValue;
			$curVal = strval($this->komp_materi->CurrentValue);
			if ($curVal != "") {
				$this->komp_materi->ViewValue = $this->komp_materi->lookupCacheOption($curVal);
				if ($this->komp_materi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->komp_materi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->komp_materi->ViewValue = $this->komp_materi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->komp_materi->ViewValue = $this->komp_materi->CurrentValue;
					}
				}
			} else {
				$this->komp_materi->ViewValue = NULL;
			}
			$this->komp_materi->ViewCustomAttributes = "";

			// tmplahir
			$this->tmplahir->ViewValue = $this->tmplahir->CurrentValue;
			$this->tmplahir->ViewCustomAttributes = "";

			// tgllahir
			$this->tgllahir->ViewValue = $this->tgllahir->CurrentValue;
			$this->tgllahir->ViewValue = FormatDateTime($this->tgllahir->ViewValue, 0);
			$this->tgllahir->ViewCustomAttributes = "";

			// agama
			$curVal = strval($this->agama->CurrentValue);
			if ($curVal != "") {
				$this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
				if ($this->agama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdagama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->agama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->agama->ViewValue = $this->agama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->agama->ViewValue = $this->agama->CurrentValue;
					}
				}
			} else {
				$this->agama->ViewValue = NULL;
			}
			$this->agama->ViewCustomAttributes = "";

			// kategori
			if (strval($this->kategori->CurrentValue) != "") {
				$this->kategori->ViewValue = $this->kategori->optionCaption($this->kategori->CurrentValue);
			} else {
				$this->kategori->ViewValue = NULL;
			}
			$this->kategori->ViewCustomAttributes = "";

			// instansi
			$this->instansi->ViewValue = $this->instansi->CurrentValue;
			$this->instansi->ViewCustomAttributes = "";

			// pekerjaan
			$this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
			$this->pekerjaan->ViewCustomAttributes = "";

			// alamatkantor
			$this->alamatkantor->ViewValue = $this->alamatkantor->CurrentValue;
			$this->alamatkantor->ViewCustomAttributes = "";

			// alamatrumah
			$this->alamatrumah->ViewValue = $this->alamatrumah->CurrentValue;
			$this->alamatrumah->ViewCustomAttributes = "";

			// telepon
			$this->telepon->ViewValue = $this->telepon->CurrentValue;
			$this->telepon->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// fax
			$this->fax->ViewValue = $this->fax->CurrentValue;
			$this->fax->ViewCustomAttributes = "";

			// created_by
			$this->created_by->ViewValue = $this->created_by->CurrentValue;
			$this->created_by->ViewCustomAttributes = "";

			// created_at
			$this->created_at->ViewValue = $this->created_at->CurrentValue;
			$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
			$this->created_at->ViewCustomAttributes = "";

			// kdinstruktur
			$this->kdinstruktur->LinkCustomAttributes = "";
			$this->kdinstruktur->HrefValue = "";
			$this->kdinstruktur->TooltipValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";
			$this->revisi->TooltipValue = "";

			// tglterbit
			$this->tglterbit->LinkCustomAttributes = "";
			$this->tglterbit->HrefValue = "";
			$this->tglterbit->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

			// komp_materi
			$this->komp_materi->LinkCustomAttributes = "";
			$this->komp_materi->HrefValue = "";
			$this->komp_materi->TooltipValue = "";

			// tmplahir
			$this->tmplahir->LinkCustomAttributes = "";
			$this->tmplahir->HrefValue = "";
			$this->tmplahir->TooltipValue = "";

			// tgllahir
			$this->tgllahir->LinkCustomAttributes = "";
			$this->tgllahir->HrefValue = "";
			$this->tgllahir->TooltipValue = "";

			// agama
			$this->agama->LinkCustomAttributes = "";
			$this->agama->HrefValue = "";
			$this->agama->TooltipValue = "";

			// kategori
			$this->kategori->LinkCustomAttributes = "";
			$this->kategori->HrefValue = "";
			$this->kategori->TooltipValue = "";

			// instansi
			$this->instansi->LinkCustomAttributes = "";
			$this->instansi->HrefValue = "";
			$this->instansi->TooltipValue = "";

			// pekerjaan
			$this->pekerjaan->LinkCustomAttributes = "";
			$this->pekerjaan->HrefValue = "";
			$this->pekerjaan->TooltipValue = "";

			// alamatkantor
			$this->alamatkantor->LinkCustomAttributes = "";
			$this->alamatkantor->HrefValue = "";
			$this->alamatkantor->TooltipValue = "";

			// alamatrumah
			$this->alamatrumah->LinkCustomAttributes = "";
			$this->alamatrumah->HrefValue = "";
			$this->alamatrumah->TooltipValue = "";

			// telepon
			$this->telepon->LinkCustomAttributes = "";
			$this->telepon->HrefValue = "";
			$this->telepon->TooltipValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";
			$this->hp->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";
			$this->fax->TooltipValue = "";

			// created_by
			$this->created_by->LinkCustomAttributes = "";
			$this->created_by->HrefValue = "";
			$this->created_by->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// kdinstruktur
			$this->kdinstruktur->EditAttrs["class"] = "form-control";
			$this->kdinstruktur->EditCustomAttributes = "";
			if (!$this->kdinstruktur->Raw)
				$this->kdinstruktur->CurrentValue = HtmlDecode($this->kdinstruktur->CurrentValue);
			$this->kdinstruktur->EditValue = HtmlEncode($this->kdinstruktur->CurrentValue);
			$this->kdinstruktur->PlaceHolder = RemoveHtml($this->kdinstruktur->caption());

			// revisi
			$this->revisi->EditAttrs["class"] = "form-control";
			$this->revisi->EditCustomAttributes = "";
			if (!$this->revisi->Raw)
				$this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
			$this->revisi->EditValue = HtmlEncode($this->revisi->CurrentValue);
			$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

			// tglterbit
			$this->tglterbit->EditAttrs["class"] = "form-control";
			$this->tglterbit->EditCustomAttributes = "";
			$this->tglterbit->EditValue = HtmlEncode(FormatDateTime($this->tglterbit->CurrentValue, 8));
			$this->tglterbit->PlaceHolder = RemoveHtml($this->tglterbit->caption());

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// komp_materi
			$this->komp_materi->EditAttrs["class"] = "form-control";
			$this->komp_materi->EditCustomAttributes = "";
			$this->komp_materi->EditValue = HtmlEncode($this->komp_materi->CurrentValue);
			$curVal = strval($this->komp_materi->CurrentValue);
			if ($curVal != "") {
				$this->komp_materi->EditValue = $this->komp_materi->lookupCacheOption($curVal);
				if ($this->komp_materi->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->komp_materi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->komp_materi->EditValue = $this->komp_materi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->komp_materi->EditValue = HtmlEncode($this->komp_materi->CurrentValue);
					}
				}
			} else {
				$this->komp_materi->EditValue = NULL;
			}
			$this->komp_materi->PlaceHolder = RemoveHtml($this->komp_materi->caption());

			// tmplahir
			$this->tmplahir->EditAttrs["class"] = "form-control";
			$this->tmplahir->EditCustomAttributes = "";
			if (!$this->tmplahir->Raw)
				$this->tmplahir->CurrentValue = HtmlDecode($this->tmplahir->CurrentValue);
			$this->tmplahir->EditValue = HtmlEncode($this->tmplahir->CurrentValue);
			$this->tmplahir->PlaceHolder = RemoveHtml($this->tmplahir->caption());

			// tgllahir
			$this->tgllahir->EditAttrs["class"] = "form-control";
			$this->tgllahir->EditCustomAttributes = "";
			$this->tgllahir->EditValue = HtmlEncode(FormatDateTime($this->tgllahir->CurrentValue, 8));
			$this->tgllahir->PlaceHolder = RemoveHtml($this->tgllahir->caption());

			// agama
			$this->agama->EditAttrs["class"] = "form-control";
			$this->agama->EditCustomAttributes = "";
			$curVal = trim(strval($this->agama->CurrentValue));
			if ($curVal != "")
				$this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
			else
				$this->agama->ViewValue = $this->agama->Lookup !== NULL && is_array($this->agama->Lookup->Options) ? $curVal : NULL;
			if ($this->agama->ViewValue !== NULL) { // Load from cache
				$this->agama->EditValue = array_values($this->agama->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdagama`" . SearchString("=", $this->agama->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->agama->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->agama->EditValue = $arwrk;
			}

			// kategori
			$this->kategori->EditCustomAttributes = "";
			$this->kategori->EditValue = $this->kategori->options(FALSE);

			// instansi
			$this->instansi->EditAttrs["class"] = "form-control";
			$this->instansi->EditCustomAttributes = "";
			if (!$this->instansi->Raw)
				$this->instansi->CurrentValue = HtmlDecode($this->instansi->CurrentValue);
			$this->instansi->EditValue = HtmlEncode($this->instansi->CurrentValue);
			$this->instansi->PlaceHolder = RemoveHtml($this->instansi->caption());

			// pekerjaan
			$this->pekerjaan->EditAttrs["class"] = "form-control";
			$this->pekerjaan->EditCustomAttributes = "";
			if (!$this->pekerjaan->Raw)
				$this->pekerjaan->CurrentValue = HtmlDecode($this->pekerjaan->CurrentValue);
			$this->pekerjaan->EditValue = HtmlEncode($this->pekerjaan->CurrentValue);
			$this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

			// alamatkantor
			$this->alamatkantor->EditAttrs["class"] = "form-control";
			$this->alamatkantor->EditCustomAttributes = "";
			$this->alamatkantor->EditValue = HtmlEncode($this->alamatkantor->CurrentValue);
			$this->alamatkantor->PlaceHolder = RemoveHtml($this->alamatkantor->caption());

			// alamatrumah
			$this->alamatrumah->EditAttrs["class"] = "form-control";
			$this->alamatrumah->EditCustomAttributes = "";
			$this->alamatrumah->EditValue = HtmlEncode($this->alamatrumah->CurrentValue);
			$this->alamatrumah->PlaceHolder = RemoveHtml($this->alamatrumah->caption());

			// telepon
			$this->telepon->EditAttrs["class"] = "form-control";
			$this->telepon->EditCustomAttributes = "";
			if (!$this->telepon->Raw)
				$this->telepon->CurrentValue = HtmlDecode($this->telepon->CurrentValue);
			$this->telepon->EditValue = HtmlEncode($this->telepon->CurrentValue);
			$this->telepon->PlaceHolder = RemoveHtml($this->telepon->caption());

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

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			if (!$this->fax->Raw)
				$this->fax->CurrentValue = HtmlDecode($this->fax->CurrentValue);
			$this->fax->EditValue = HtmlEncode($this->fax->CurrentValue);
			$this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

			// created_by
			// created_at
			// Add refer script
			// kdinstruktur

			$this->kdinstruktur->LinkCustomAttributes = "";
			$this->kdinstruktur->HrefValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";

			// tglterbit
			$this->tglterbit->LinkCustomAttributes = "";
			$this->tglterbit->HrefValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// komp_materi
			$this->komp_materi->LinkCustomAttributes = "";
			$this->komp_materi->HrefValue = "";

			// tmplahir
			$this->tmplahir->LinkCustomAttributes = "";
			$this->tmplahir->HrefValue = "";

			// tgllahir
			$this->tgllahir->LinkCustomAttributes = "";
			$this->tgllahir->HrefValue = "";

			// agama
			$this->agama->LinkCustomAttributes = "";
			$this->agama->HrefValue = "";

			// kategori
			$this->kategori->LinkCustomAttributes = "";
			$this->kategori->HrefValue = "";

			// instansi
			$this->instansi->LinkCustomAttributes = "";
			$this->instansi->HrefValue = "";

			// pekerjaan
			$this->pekerjaan->LinkCustomAttributes = "";
			$this->pekerjaan->HrefValue = "";

			// alamatkantor
			$this->alamatkantor->LinkCustomAttributes = "";
			$this->alamatkantor->HrefValue = "";

			// alamatrumah
			$this->alamatrumah->LinkCustomAttributes = "";
			$this->alamatrumah->HrefValue = "";

			// telepon
			$this->telepon->LinkCustomAttributes = "";
			$this->telepon->HrefValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";

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
		if ($this->kdinstruktur->Required) {
			if (!$this->kdinstruktur->IsDetailKey && $this->kdinstruktur->FormValue != NULL && $this->kdinstruktur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdinstruktur->caption(), $this->kdinstruktur->RequiredErrorMessage));
			}
		}
		if ($this->revisi->Required) {
			if (!$this->revisi->IsDetailKey && $this->revisi->FormValue != NULL && $this->revisi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revisi->caption(), $this->revisi->RequiredErrorMessage));
			}
		}
		if ($this->tglterbit->Required) {
			if (!$this->tglterbit->IsDetailKey && $this->tglterbit->FormValue != NULL && $this->tglterbit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglterbit->caption(), $this->tglterbit->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tglterbit->FormValue)) {
			AddMessage($FormError, $this->tglterbit->errorMessage());
		}
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->komp_materi->Required) {
			if (!$this->komp_materi->IsDetailKey && $this->komp_materi->FormValue != NULL && $this->komp_materi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->komp_materi->caption(), $this->komp_materi->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->komp_materi->FormValue)) {
			AddMessage($FormError, $this->komp_materi->errorMessage());
		}
		if ($this->tmplahir->Required) {
			if (!$this->tmplahir->IsDetailKey && $this->tmplahir->FormValue != NULL && $this->tmplahir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tmplahir->caption(), $this->tmplahir->RequiredErrorMessage));
			}
		}
		if ($this->tgllahir->Required) {
			if (!$this->tgllahir->IsDetailKey && $this->tgllahir->FormValue != NULL && $this->tgllahir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgllahir->caption(), $this->tgllahir->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgllahir->FormValue)) {
			AddMessage($FormError, $this->tgllahir->errorMessage());
		}
		if ($this->agama->Required) {
			if (!$this->agama->IsDetailKey && $this->agama->FormValue != NULL && $this->agama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->agama->caption(), $this->agama->RequiredErrorMessage));
			}
		}
		if ($this->kategori->Required) {
			if ($this->kategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori->caption(), $this->kategori->RequiredErrorMessage));
			}
		}
		if ($this->instansi->Required) {
			if (!$this->instansi->IsDetailKey && $this->instansi->FormValue != NULL && $this->instansi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->instansi->caption(), $this->instansi->RequiredErrorMessage));
			}
		}
		if ($this->pekerjaan->Required) {
			if (!$this->pekerjaan->IsDetailKey && $this->pekerjaan->FormValue != NULL && $this->pekerjaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pekerjaan->caption(), $this->pekerjaan->RequiredErrorMessage));
			}
		}
		if ($this->alamatkantor->Required) {
			if (!$this->alamatkantor->IsDetailKey && $this->alamatkantor->FormValue != NULL && $this->alamatkantor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamatkantor->caption(), $this->alamatkantor->RequiredErrorMessage));
			}
		}
		if ($this->alamatrumah->Required) {
			if (!$this->alamatrumah->IsDetailKey && $this->alamatrumah->FormValue != NULL && $this->alamatrumah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamatrumah->caption(), $this->alamatrumah->RequiredErrorMessage));
			}
		}
		if ($this->telepon->Required) {
			if (!$this->telepon->IsDetailKey && $this->telepon->FormValue != NULL && $this->telepon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telepon->caption(), $this->telepon->RequiredErrorMessage));
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
		if (!CheckEmail($this->_email->FormValue)) {
			AddMessage($FormError, $this->_email->errorMessage());
		}
		if ($this->fax->Required) {
			if (!$this->fax->IsDetailKey && $this->fax->FormValue != NULL && $this->fax->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fax->caption(), $this->fax->RequiredErrorMessage));
			}
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t_rwpendd", $detailTblVar) && $GLOBALS["t_rwpendd"]->DetailAdd) {
			if (!isset($GLOBALS["t_rwpendd_grid"]))
				$GLOBALS["t_rwpendd_grid"] = new t_rwpendd_grid(); // Get detail page object
			$GLOBALS["t_rwpendd_grid"]->validateGridForm();
		}
		if (in_array("t_rwpekerjaan", $detailTblVar) && $GLOBALS["t_rwpekerjaan"]->DetailAdd) {
			if (!isset($GLOBALS["t_rwpekerjaan_grid"]))
				$GLOBALS["t_rwpekerjaan_grid"] = new t_rwpekerjaan_grid(); // Get detail page object
			$GLOBALS["t_rwpekerjaan_grid"]->validateGridForm();
		}
		if (in_array("t_rwtraining", $detailTblVar) && $GLOBALS["t_rwtraining"]->DetailAdd) {
			if (!isset($GLOBALS["t_rwtraining_grid"]))
				$GLOBALS["t_rwtraining_grid"] = new t_rwtraining_grid(); // Get detail page object
			$GLOBALS["t_rwtraining_grid"]->validateGridForm();
		}
		if (in_array("t_faskur", $detailTblVar) && $GLOBALS["t_faskur"]->DetailAdd) {
			if (!isset($GLOBALS["t_faskur_grid"]))
				$GLOBALS["t_faskur_grid"] = new t_faskur_grid(); // Get detail page object
			$GLOBALS["t_faskur_grid"]->validateGridForm();
		}
		if (in_array("cv_rwipelatihaninstruktur", $detailTblVar) && $GLOBALS["cv_rwipelatihaninstruktur"]->DetailAdd) {
			if (!isset($GLOBALS["cv_rwipelatihaninstruktur_grid"]))
				$GLOBALS["cv_rwipelatihaninstruktur_grid"] = new cv_rwipelatihaninstruktur_grid(); // Get detail page object
			$GLOBALS["cv_rwipelatihaninstruktur_grid"]->validateGridForm();
		}
		if (in_array("t_evaluasifas", $detailTblVar) && $GLOBALS["t_evaluasifas"]->DetailAdd) {
			if (!isset($GLOBALS["t_evaluasifas_grid"]))
				$GLOBALS["t_evaluasifas_grid"] = new t_evaluasifas_grid(); // Get detail page object
			$GLOBALS["t_evaluasifas_grid"]->validateGridForm();
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
		if ($this->kdinstruktur->CurrentValue != "") { // Check field with unique index
			$filter = "(`kdinstruktur` = '" . AdjustSql($this->kdinstruktur->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->kdinstruktur->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->kdinstruktur->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
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

		// kdinstruktur
		$this->kdinstruktur->setDbValueDef($rsnew, $this->kdinstruktur->CurrentValue, NULL, FALSE);

		// revisi
		$this->revisi->setDbValueDef($rsnew, $this->revisi->CurrentValue, NULL, FALSE);

		// tglterbit
		$this->tglterbit->setDbValueDef($rsnew, UnFormatDateTime($this->tglterbit->CurrentValue, 0), NULL, FALSE);

		// nama
		$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, NULL, FALSE);

		// komp_materi
		$this->komp_materi->setDbValueDef($rsnew, $this->komp_materi->CurrentValue, 0, FALSE);

		// tmplahir
		$this->tmplahir->setDbValueDef($rsnew, $this->tmplahir->CurrentValue, NULL, FALSE);

		// tgllahir
		$this->tgllahir->setDbValueDef($rsnew, UnFormatDateTime($this->tgllahir->CurrentValue, 0), NULL, FALSE);

		// agama
		$this->agama->setDbValueDef($rsnew, $this->agama->CurrentValue, NULL, FALSE);

		// kategori
		$this->kategori->setDbValueDef($rsnew, $this->kategori->CurrentValue, 0, FALSE);

		// instansi
		$this->instansi->setDbValueDef($rsnew, $this->instansi->CurrentValue, NULL, FALSE);

		// pekerjaan
		$this->pekerjaan->setDbValueDef($rsnew, $this->pekerjaan->CurrentValue, NULL, FALSE);

		// alamatkantor
		$this->alamatkantor->setDbValueDef($rsnew, $this->alamatkantor->CurrentValue, NULL, FALSE);

		// alamatrumah
		$this->alamatrumah->setDbValueDef($rsnew, $this->alamatrumah->CurrentValue, NULL, FALSE);

		// telepon
		$this->telepon->setDbValueDef($rsnew, $this->telepon->CurrentValue, NULL, FALSE);

		// hp
		$this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, NULL, FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// fax
		$this->fax->setDbValueDef($rsnew, $this->fax->CurrentValue, NULL, FALSE);

		// created_by
		$this->created_by->CurrentValue = CurrentUserName();
		$this->created_by->setDbValueDef($rsnew, $this->created_by->CurrentValue, NULL);

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
			if (in_array("t_rwpendd", $detailTblVar) && $GLOBALS["t_rwpendd"]->DetailAdd) {
				$GLOBALS["t_rwpendd"]->bioid->setSessionValue($this->bioid->CurrentValue); // Set master key
				if (!isset($GLOBALS["t_rwpendd_grid"]))
					$GLOBALS["t_rwpendd_grid"] = new t_rwpendd_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "t_rwpendd"); // Load user level of detail table
				$addRow = $GLOBALS["t_rwpendd_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["t_rwpendd"]->bioid->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("t_rwpekerjaan", $detailTblVar) && $GLOBALS["t_rwpekerjaan"]->DetailAdd) {
				$GLOBALS["t_rwpekerjaan"]->bioid->setSessionValue($this->bioid->CurrentValue); // Set master key
				if (!isset($GLOBALS["t_rwpekerjaan_grid"]))
					$GLOBALS["t_rwpekerjaan_grid"] = new t_rwpekerjaan_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "t_rwpekerjaan"); // Load user level of detail table
				$addRow = $GLOBALS["t_rwpekerjaan_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["t_rwpekerjaan"]->bioid->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("t_rwtraining", $detailTblVar) && $GLOBALS["t_rwtraining"]->DetailAdd) {
				$GLOBALS["t_rwtraining"]->bioid->setSessionValue($this->bioid->CurrentValue); // Set master key
				if (!isset($GLOBALS["t_rwtraining_grid"]))
					$GLOBALS["t_rwtraining_grid"] = new t_rwtraining_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "t_rwtraining"); // Load user level of detail table
				$addRow = $GLOBALS["t_rwtraining_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["t_rwtraining"]->bioid->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("t_faskur", $detailTblVar) && $GLOBALS["t_faskur"]->DetailAdd) {
				$GLOBALS["t_faskur"]->bioid->setSessionValue($this->bioid->CurrentValue); // Set master key
				if (!isset($GLOBALS["t_faskur_grid"]))
					$GLOBALS["t_faskur_grid"] = new t_faskur_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "t_faskur"); // Load user level of detail table
				$addRow = $GLOBALS["t_faskur_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["t_faskur"]->bioid->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("cv_rwipelatihaninstruktur", $detailTblVar) && $GLOBALS["cv_rwipelatihaninstruktur"]->DetailAdd) {
				$GLOBALS["cv_rwipelatihaninstruktur"]->bioid->setSessionValue($this->bioid->CurrentValue); // Set master key
				if (!isset($GLOBALS["cv_rwipelatihaninstruktur_grid"]))
					$GLOBALS["cv_rwipelatihaninstruktur_grid"] = new cv_rwipelatihaninstruktur_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "cv_rwipelatihaninstruktur"); // Load user level of detail table
				$addRow = $GLOBALS["cv_rwipelatihaninstruktur_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["cv_rwipelatihaninstruktur"]->bioid->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("t_evaluasifas", $detailTblVar) && $GLOBALS["t_evaluasifas"]->DetailAdd) {
				$GLOBALS["t_evaluasifas"]->bioid->setSessionValue($this->bioid->CurrentValue); // Set master key
				if (!isset($GLOBALS["t_evaluasifas_grid"]))
					$GLOBALS["t_evaluasifas_grid"] = new t_evaluasifas_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "t_evaluasifas"); // Load user level of detail table
				$addRow = $GLOBALS["t_evaluasifas_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["t_evaluasifas"]->bioid->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("t_rwpendd", $detailTblVar)) {
				if (!isset($GLOBALS["t_rwpendd_grid"]))
					$GLOBALS["t_rwpendd_grid"] = new t_rwpendd_grid();
				if ($GLOBALS["t_rwpendd_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t_rwpendd_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t_rwpendd_grid"]->CurrentMode = "add";
					$GLOBALS["t_rwpendd_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t_rwpendd_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_rwpendd_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_rwpendd_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_rwpendd_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_rwpendd_grid"]->bioid->setSessionValue($GLOBALS["t_rwpendd_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("t_rwpekerjaan", $detailTblVar)) {
				if (!isset($GLOBALS["t_rwpekerjaan_grid"]))
					$GLOBALS["t_rwpekerjaan_grid"] = new t_rwpekerjaan_grid();
				if ($GLOBALS["t_rwpekerjaan_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t_rwpekerjaan_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t_rwpekerjaan_grid"]->CurrentMode = "add";
					$GLOBALS["t_rwpekerjaan_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t_rwpekerjaan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_rwpekerjaan_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_rwpekerjaan_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_rwpekerjaan_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_rwpekerjaan_grid"]->bioid->setSessionValue($GLOBALS["t_rwpekerjaan_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("t_rwtraining", $detailTblVar)) {
				if (!isset($GLOBALS["t_rwtraining_grid"]))
					$GLOBALS["t_rwtraining_grid"] = new t_rwtraining_grid();
				if ($GLOBALS["t_rwtraining_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t_rwtraining_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t_rwtraining_grid"]->CurrentMode = "add";
					$GLOBALS["t_rwtraining_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t_rwtraining_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_rwtraining_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_rwtraining_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_rwtraining_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_rwtraining_grid"]->bioid->setSessionValue($GLOBALS["t_rwtraining_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("t_faskur", $detailTblVar)) {
				if (!isset($GLOBALS["t_faskur_grid"]))
					$GLOBALS["t_faskur_grid"] = new t_faskur_grid();
				if ($GLOBALS["t_faskur_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t_faskur_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t_faskur_grid"]->CurrentMode = "add";
					$GLOBALS["t_faskur_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t_faskur_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_faskur_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_faskur_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_faskur_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_faskur_grid"]->bioid->setSessionValue($GLOBALS["t_faskur_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("cv_rwipelatihaninstruktur", $detailTblVar)) {
				if (!isset($GLOBALS["cv_rwipelatihaninstruktur_grid"]))
					$GLOBALS["cv_rwipelatihaninstruktur_grid"] = new cv_rwipelatihaninstruktur_grid();
				if ($GLOBALS["cv_rwipelatihaninstruktur_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["cv_rwipelatihaninstruktur_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["cv_rwipelatihaninstruktur_grid"]->CurrentMode = "add";
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->setStartRecordNumber(1);
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["cv_rwipelatihaninstruktur_grid"]->bioid->setSessionValue($GLOBALS["cv_rwipelatihaninstruktur_grid"]->bioid->CurrentValue);
				}
			}
			if (in_array("t_evaluasifas", $detailTblVar)) {
				if (!isset($GLOBALS["t_evaluasifas_grid"]))
					$GLOBALS["t_evaluasifas_grid"] = new t_evaluasifas_grid();
				if ($GLOBALS["t_evaluasifas_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t_evaluasifas_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t_evaluasifas_grid"]->CurrentMode = "add";
					$GLOBALS["t_evaluasifas_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t_evaluasifas_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_evaluasifas_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_evaluasifas_grid"]->bioid->IsDetailKey = TRUE;
					$GLOBALS["t_evaluasifas_grid"]->bioid->CurrentValue = $this->bioid->CurrentValue;
					$GLOBALS["t_evaluasifas_grid"]->bioid->setSessionValue($GLOBALS["t_evaluasifas_grid"]->bioid->CurrentValue);
					$GLOBALS["t_evaluasifas_grid"]->idpelat->setSessionValue(""); // Clear session key
					$GLOBALS["t_evaluasifas_grid"]->kurikulumid->setSessionValue(""); // Clear session key
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_biointrukturlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add('t_rwpendd');
		$pages->add('t_rwpekerjaan');
		$pages->add('t_rwtraining');
		$pages->add('t_faskur');
		$pages->add('cv_rwipelatihaninstruktur');
		$pages->add('t_evaluasifas');
		$this->DetailPages = $pages;
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
				case "x_komp_materi":
					break;
				case "x_agama":
					break;
				case "x_kategori":
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
						case "x_komp_materi":
							break;
						case "x_agama":
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
		//$this->kdinstruktur->Visible = FALSE;

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