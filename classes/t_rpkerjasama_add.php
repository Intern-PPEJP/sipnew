<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_rpkerjasama_add extends t_rpkerjasama
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_rpkerjasama';

	// Page object name
	public $PageObjName = "t_rpkerjasama_add";

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

		// Table object (t_rpkerjasama)
		if (!isset($GLOBALS["t_rpkerjasama"]) || get_class($GLOBALS["t_rpkerjasama"]) == PROJECT_NAMESPACE . "t_rpkerjasama") {
			$GLOBALS["t_rpkerjasama"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_rpkerjasama"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_rpkerjasama');

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
		global $t_rpkerjasama;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_rpkerjasama);
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
					if ($pageName == "t_rpkerjasamaview.php")
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
			$key .= @$ar['rpkid'];
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
			$this->rpkid->Visible = FALSE;
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
					$this->terminate(GetUrl("t_rpkerjasamalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->rpkid->Visible = FALSE;
		$this->jenispel->setVisibility();
		$this->kdkategori->setVisibility();
		$this->kerjasama->setVisibility();
		$this->angkatan->setVisibility();
		$this->sisa_angkatan->Visible = FALSE;
		$this->targetpes->setVisibility();
		$this->kdprop->Visible = FALSE;
		$this->kdkota->Visible = FALSE;
		$this->tempat->Visible = FALSE;
		$this->dana->Visible = FALSE;
		$this->kontak_person->setVisibility();
		$this->tglrevisi->setVisibility();
		$this->tahun_rencana->setVisibility();
		$this->mou->setVisibility();
		$this->mou2->setVisibility();
		$this->mou3->setVisibility();
		$this->sk->setVisibility();
		$this->sk2->setVisibility();
		$this->sk3->setVisibility();
		$this->sk4->setVisibility();
		$this->sk5->setVisibility();
		$this->jml_hari->setVisibility();
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
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_rpkerjasamalist.php");
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
			if (Get("rpkid") !== NULL) {
				$this->rpkid->setQueryStringValue(Get("rpkid"));
				$this->setKey("rpkid", $this->rpkid->CurrentValue); // Set up key
			} else {
				$this->setKey("rpkid", ""); // Clear key
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
					$this->terminate("t_rpkerjasamalist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "t_rpkerjasamalist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_rpkerjasamaview.php")
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
		$this->mou2->Upload->Index = $CurrentForm->Index;
		$this->mou2->Upload->uploadFile();
		$this->mou2->CurrentValue = $this->mou2->Upload->FileName;
		$this->mou3->Upload->Index = $CurrentForm->Index;
		$this->mou3->Upload->uploadFile();
		$this->mou3->CurrentValue = $this->mou3->Upload->FileName;
		$this->sk->Upload->Index = $CurrentForm->Index;
		$this->sk->Upload->uploadFile();
		$this->sk->CurrentValue = $this->sk->Upload->FileName;
		$this->sk2->Upload->Index = $CurrentForm->Index;
		$this->sk2->Upload->uploadFile();
		$this->sk2->CurrentValue = $this->sk2->Upload->FileName;
		$this->sk3->Upload->Index = $CurrentForm->Index;
		$this->sk3->Upload->uploadFile();
		$this->sk3->CurrentValue = $this->sk3->Upload->FileName;
		$this->sk4->Upload->Index = $CurrentForm->Index;
		$this->sk4->Upload->uploadFile();
		$this->sk4->CurrentValue = $this->sk4->Upload->FileName;
		$this->sk5->Upload->Index = $CurrentForm->Index;
		$this->sk5->Upload->uploadFile();
		$this->sk5->CurrentValue = $this->sk5->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->rpkid->CurrentValue = NULL;
		$this->rpkid->OldValue = $this->rpkid->CurrentValue;
		$this->jenispel->CurrentValue = NULL;
		$this->jenispel->OldValue = $this->jenispel->CurrentValue;
		$this->kdkategori->CurrentValue = NULL;
		$this->kdkategori->OldValue = $this->kdkategori->CurrentValue;
		$this->kerjasama->CurrentValue = NULL;
		$this->kerjasama->OldValue = $this->kerjasama->CurrentValue;
		$this->angkatan->CurrentValue = NULL;
		$this->angkatan->OldValue = $this->angkatan->CurrentValue;
		$this->sisa_angkatan->CurrentValue = NULL;
		$this->sisa_angkatan->OldValue = $this->sisa_angkatan->CurrentValue;
		$this->targetpes->CurrentValue = NULL;
		$this->targetpes->OldValue = $this->targetpes->CurrentValue;
		$this->kdprop->CurrentValue = NULL;
		$this->kdprop->OldValue = $this->kdprop->CurrentValue;
		$this->kdkota->CurrentValue = NULL;
		$this->kdkota->OldValue = $this->kdkota->CurrentValue;
		$this->tempat->CurrentValue = NULL;
		$this->tempat->OldValue = $this->tempat->CurrentValue;
		$this->dana->CurrentValue = 0;
		$this->kontak_person->CurrentValue = NULL;
		$this->kontak_person->OldValue = $this->kontak_person->CurrentValue;
		$this->tglrevisi->CurrentValue = CurrentDate();
		$this->tahun_rencana->CurrentValue = NULL;
		$this->tahun_rencana->OldValue = $this->tahun_rencana->CurrentValue;
		$this->mou->Upload->DbValue = NULL;
		$this->mou->OldValue = $this->mou->Upload->DbValue;
		$this->mou->CurrentValue = NULL; // Clear file related field
		$this->mou2->Upload->DbValue = NULL;
		$this->mou2->OldValue = $this->mou2->Upload->DbValue;
		$this->mou2->CurrentValue = NULL; // Clear file related field
		$this->mou3->Upload->DbValue = NULL;
		$this->mou3->OldValue = $this->mou3->Upload->DbValue;
		$this->mou3->CurrentValue = NULL; // Clear file related field
		$this->sk->Upload->DbValue = NULL;
		$this->sk->OldValue = $this->sk->Upload->DbValue;
		$this->sk->CurrentValue = NULL; // Clear file related field
		$this->sk2->Upload->DbValue = NULL;
		$this->sk2->OldValue = $this->sk2->Upload->DbValue;
		$this->sk2->CurrentValue = NULL; // Clear file related field
		$this->sk3->Upload->DbValue = NULL;
		$this->sk3->OldValue = $this->sk3->Upload->DbValue;
		$this->sk3->CurrentValue = NULL; // Clear file related field
		$this->sk4->Upload->DbValue = NULL;
		$this->sk4->OldValue = $this->sk4->Upload->DbValue;
		$this->sk4->CurrentValue = NULL; // Clear file related field
		$this->sk5->Upload->DbValue = NULL;
		$this->sk5->OldValue = $this->sk5->Upload->DbValue;
		$this->sk5->CurrentValue = NULL; // Clear file related field
		$this->jml_hari->CurrentValue = NULL;
		$this->jml_hari->OldValue = $this->jml_hari->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

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

		// Check field name 'angkatan' first before field var 'x_angkatan'
		$val = $CurrentForm->hasValue("angkatan") ? $CurrentForm->getValue("angkatan") : $CurrentForm->getValue("x_angkatan");
		if (!$this->angkatan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->angkatan->Visible = FALSE; // Disable update for API request
			else
				$this->angkatan->setFormValue($val);
		}

		// Check field name 'targetpes' first before field var 'x_targetpes'
		$val = $CurrentForm->hasValue("targetpes") ? $CurrentForm->getValue("targetpes") : $CurrentForm->getValue("x_targetpes");
		if (!$this->targetpes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes->setFormValue($val);
		}

		// Check field name 'kontak_person' first before field var 'x_kontak_person'
		$val = $CurrentForm->hasValue("kontak_person") ? $CurrentForm->getValue("kontak_person") : $CurrentForm->getValue("x_kontak_person");
		if (!$this->kontak_person->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kontak_person->Visible = FALSE; // Disable update for API request
			else
				$this->kontak_person->setFormValue($val);
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

		// Check field name 'jml_hari' first before field var 'x_jml_hari'
		$val = $CurrentForm->hasValue("jml_hari") ? $CurrentForm->getValue("jml_hari") : $CurrentForm->getValue("x_jml_hari");
		if (!$this->jml_hari->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_hari->Visible = FALSE; // Disable update for API request
			else
				$this->jml_hari->setFormValue($val);
		}

		// Check field name 'rpkid' first before field var 'x_rpkid'
		$val = $CurrentForm->hasValue("rpkid") ? $CurrentForm->getValue("rpkid") : $CurrentForm->getValue("x_rpkid");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->jenispel->CurrentValue = $this->jenispel->FormValue;
		$this->kdkategori->CurrentValue = $this->kdkategori->FormValue;
		$this->kerjasama->CurrentValue = $this->kerjasama->FormValue;
		$this->angkatan->CurrentValue = $this->angkatan->FormValue;
		$this->targetpes->CurrentValue = $this->targetpes->FormValue;
		$this->kontak_person->CurrentValue = $this->kontak_person->FormValue;
		$this->tglrevisi->CurrentValue = $this->tglrevisi->FormValue;
		$this->tglrevisi->CurrentValue = UnFormatDateTime($this->tglrevisi->CurrentValue, 0);
		$this->tahun_rencana->CurrentValue = $this->tahun_rencana->FormValue;
		$this->jml_hari->CurrentValue = $this->jml_hari->FormValue;
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
		$this->rpkid->setDbValue($row['rpkid']);
		$this->jenispel->setDbValue($row['jenispel']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->kerjasama->setDbValue($row['kerjasama']);
		$this->angkatan->setDbValue($row['angkatan']);
		$this->sisa_angkatan->setDbValue($row['sisa_angkatan']);
		$this->targetpes->setDbValue($row['targetpes']);
		$this->kdprop->setDbValue($row['kdprop']);
		$this->kdkota->setDbValue($row['kdkota']);
		$this->tempat->setDbValue($row['tempat']);
		$this->dana->setDbValue($row['dana']);
		$this->kontak_person->setDbValue($row['kontak_person']);
		$this->tglrevisi->setDbValue($row['tglrevisi']);
		$this->tahun_rencana->setDbValue($row['tahun_rencana']);
		$this->mou->Upload->DbValue = $row['mou'];
		$this->mou->setDbValue($this->mou->Upload->DbValue);
		$this->mou2->Upload->DbValue = $row['mou2'];
		$this->mou2->setDbValue($this->mou2->Upload->DbValue);
		$this->mou3->Upload->DbValue = $row['mou3'];
		$this->mou3->setDbValue($this->mou3->Upload->DbValue);
		$this->sk->Upload->DbValue = $row['sk'];
		$this->sk->setDbValue($this->sk->Upload->DbValue);
		$this->sk2->Upload->DbValue = $row['sk2'];
		$this->sk2->setDbValue($this->sk2->Upload->DbValue);
		$this->sk3->Upload->DbValue = $row['sk3'];
		$this->sk3->setDbValue($this->sk3->Upload->DbValue);
		$this->sk4->Upload->DbValue = $row['sk4'];
		$this->sk4->setDbValue($this->sk4->Upload->DbValue);
		$this->sk5->Upload->DbValue = $row['sk5'];
		$this->sk5->setDbValue($this->sk5->Upload->DbValue);
		$this->jml_hari->setDbValue($row['jml_hari']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['rpkid'] = $this->rpkid->CurrentValue;
		$row['jenispel'] = $this->jenispel->CurrentValue;
		$row['kdkategori'] = $this->kdkategori->CurrentValue;
		$row['kerjasama'] = $this->kerjasama->CurrentValue;
		$row['angkatan'] = $this->angkatan->CurrentValue;
		$row['sisa_angkatan'] = $this->sisa_angkatan->CurrentValue;
		$row['targetpes'] = $this->targetpes->CurrentValue;
		$row['kdprop'] = $this->kdprop->CurrentValue;
		$row['kdkota'] = $this->kdkota->CurrentValue;
		$row['tempat'] = $this->tempat->CurrentValue;
		$row['dana'] = $this->dana->CurrentValue;
		$row['kontak_person'] = $this->kontak_person->CurrentValue;
		$row['tglrevisi'] = $this->tglrevisi->CurrentValue;
		$row['tahun_rencana'] = $this->tahun_rencana->CurrentValue;
		$row['mou'] = $this->mou->Upload->DbValue;
		$row['mou2'] = $this->mou2->Upload->DbValue;
		$row['mou3'] = $this->mou3->Upload->DbValue;
		$row['sk'] = $this->sk->Upload->DbValue;
		$row['sk2'] = $this->sk2->Upload->DbValue;
		$row['sk3'] = $this->sk3->Upload->DbValue;
		$row['sk4'] = $this->sk4->Upload->DbValue;
		$row['sk5'] = $this->sk5->Upload->DbValue;
		$row['jml_hari'] = $this->jml_hari->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("rpkid")) != "")
			$this->rpkid->OldValue = $this->getKey("rpkid"); // rpkid
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
		// rpkid
		// jenispel
		// kdkategori
		// kerjasama
		// angkatan
		// sisa_angkatan
		// targetpes
		// kdprop
		// kdkota
		// tempat
		// dana
		// kontak_person
		// tglrevisi
		// tahun_rencana
		// mou
		// mou2
		// mou3
		// sk
		// sk2
		// sk3
		// sk4
		// sk5
		// jml_hari

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// rpkid
			$this->rpkid->ViewValue = $this->rpkid->CurrentValue;
			$this->rpkid->ViewCustomAttributes = "";

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

			// angkatan
			$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
			$this->angkatan->ViewCustomAttributes = "";

			// sisa_angkatan
			$this->sisa_angkatan->ViewValue = $this->sisa_angkatan->CurrentValue;
			$this->sisa_angkatan->ViewValue = FormatNumber($this->sisa_angkatan->ViewValue, 0, -2, -2, -2);
			$this->sisa_angkatan->ViewCustomAttributes = "";

			// targetpes
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->ViewCustomAttributes = "";

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

			// kdkota
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
			$this->kdkota->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// dana
			$this->dana->ViewValue = $this->dana->CurrentValue;
			$this->dana->ViewValue = FormatCurrency($this->dana->ViewValue, 0, -2, -2, -2);
			$this->dana->ViewCustomAttributes = "";

			// kontak_person
			$this->kontak_person->ViewValue = $this->kontak_person->CurrentValue;
			$this->kontak_person->ViewCustomAttributes = "";

			// tglrevisi
			$this->tglrevisi->ViewValue = $this->tglrevisi->CurrentValue;
			$this->tglrevisi->ViewValue = FormatDateTime($this->tglrevisi->ViewValue, 0);
			$this->tglrevisi->ViewCustomAttributes = "";

			// tahun_rencana
			$this->tahun_rencana->ViewValue = $this->tahun_rencana->CurrentValue;
			$this->tahun_rencana->ViewCustomAttributes = "";

			// mou
			if (!EmptyValue($this->mou->Upload->DbValue)) {
				$this->mou->ViewValue = $this->mou->Upload->DbValue;
			} else {
				$this->mou->ViewValue = "";
			}
			$this->mou->ViewCustomAttributes = "";

			// mou2
			if (!EmptyValue($this->mou2->Upload->DbValue)) {
				$this->mou2->ViewValue = $this->mou2->Upload->DbValue;
			} else {
				$this->mou2->ViewValue = "";
			}
			$this->mou2->ViewCustomAttributes = "";

			// mou3
			if (!EmptyValue($this->mou3->Upload->DbValue)) {
				$this->mou3->ViewValue = $this->mou3->Upload->DbValue;
			} else {
				$this->mou3->ViewValue = "";
			}
			$this->mou3->ViewCustomAttributes = "";

			// sk
			if (!EmptyValue($this->sk->Upload->DbValue)) {
				$this->sk->ViewValue = $this->sk->Upload->DbValue;
			} else {
				$this->sk->ViewValue = "";
			}
			$this->sk->ViewCustomAttributes = "";

			// sk2
			if (!EmptyValue($this->sk2->Upload->DbValue)) {
				$this->sk2->ViewValue = $this->sk2->Upload->DbValue;
			} else {
				$this->sk2->ViewValue = "";
			}
			$this->sk2->ViewCustomAttributes = "";

			// sk3
			if (!EmptyValue($this->sk3->Upload->DbValue)) {
				$this->sk3->ViewValue = $this->sk3->Upload->DbValue;
			} else {
				$this->sk3->ViewValue = "";
			}
			$this->sk3->ViewCustomAttributes = "";

			// sk4
			if (!EmptyValue($this->sk4->Upload->DbValue)) {
				$this->sk4->ViewValue = $this->sk4->Upload->DbValue;
			} else {
				$this->sk4->ViewValue = "";
			}
			$this->sk4->ViewCustomAttributes = "";

			// sk5
			if (!EmptyValue($this->sk5->Upload->DbValue)) {
				$this->sk5->ViewValue = $this->sk5->Upload->DbValue;
			} else {
				$this->sk5->ViewValue = "";
			}
			$this->sk5->ViewCustomAttributes = "";

			// jml_hari
			$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
			$this->jml_hari->ViewCustomAttributes = "";

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

			// angkatan
			$this->angkatan->LinkCustomAttributes = "";
			$this->angkatan->HrefValue = "";
			$this->angkatan->TooltipValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";
			$this->targetpes->TooltipValue = "";

			// kontak_person
			$this->kontak_person->LinkCustomAttributes = "";
			$this->kontak_person->HrefValue = "";
			$this->kontak_person->TooltipValue = "";

			// tglrevisi
			$this->tglrevisi->LinkCustomAttributes = "";
			$this->tglrevisi->HrefValue = "";
			$this->tglrevisi->TooltipValue = "";

			// tahun_rencana
			$this->tahun_rencana->LinkCustomAttributes = "";
			$this->tahun_rencana->HrefValue = "";
			$this->tahun_rencana->TooltipValue = "";

			// mou
			$this->mou->LinkCustomAttributes = "";
			$this->mou->HrefValue = "";
			$this->mou->ExportHrefValue = $this->mou->UploadPath . $this->mou->Upload->DbValue;
			$this->mou->TooltipValue = "";

			// mou2
			$this->mou2->LinkCustomAttributes = "";
			$this->mou2->HrefValue = "";
			$this->mou2->ExportHrefValue = $this->mou2->UploadPath . $this->mou2->Upload->DbValue;
			$this->mou2->TooltipValue = "";

			// mou3
			$this->mou3->LinkCustomAttributes = "";
			$this->mou3->HrefValue = "";
			$this->mou3->ExportHrefValue = $this->mou3->UploadPath . $this->mou3->Upload->DbValue;
			$this->mou3->TooltipValue = "";

			// sk
			$this->sk->LinkCustomAttributes = "";
			$this->sk->HrefValue = "";
			$this->sk->ExportHrefValue = $this->sk->UploadPath . $this->sk->Upload->DbValue;
			$this->sk->TooltipValue = "";

			// sk2
			$this->sk2->LinkCustomAttributes = "";
			$this->sk2->HrefValue = "";
			$this->sk2->ExportHrefValue = $this->sk2->UploadPath . $this->sk2->Upload->DbValue;
			$this->sk2->TooltipValue = "";

			// sk3
			$this->sk3->LinkCustomAttributes = "";
			$this->sk3->HrefValue = "";
			$this->sk3->ExportHrefValue = $this->sk3->UploadPath . $this->sk3->Upload->DbValue;
			$this->sk3->TooltipValue = "";

			// sk4
			$this->sk4->LinkCustomAttributes = "";
			$this->sk4->HrefValue = "";
			$this->sk4->ExportHrefValue = $this->sk4->UploadPath . $this->sk4->Upload->DbValue;
			$this->sk4->TooltipValue = "";

			// sk5
			$this->sk5->LinkCustomAttributes = "";
			$this->sk5->HrefValue = "";
			$this->sk5->ExportHrefValue = $this->sk5->UploadPath . $this->sk5->Upload->DbValue;
			$this->sk5->TooltipValue = "";

			// jml_hari
			$this->jml_hari->LinkCustomAttributes = "";
			$this->jml_hari->HrefValue = "";
			$this->jml_hari->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// angkatan
			$this->angkatan->EditAttrs["class"] = "form-control";
			$this->angkatan->EditCustomAttributes = "";
			$this->angkatan->EditValue = HtmlEncode($this->angkatan->CurrentValue);
			$this->angkatan->PlaceHolder = RemoveHtml($this->angkatan->caption());

			// targetpes
			$this->targetpes->EditAttrs["class"] = "form-control";
			$this->targetpes->EditCustomAttributes = "";
			$this->targetpes->EditValue = HtmlEncode($this->targetpes->CurrentValue);
			$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

			// kontak_person
			$this->kontak_person->EditAttrs["class"] = "form-control";
			$this->kontak_person->EditCustomAttributes = "";
			$this->kontak_person->EditValue = HtmlEncode($this->kontak_person->CurrentValue);
			$this->kontak_person->PlaceHolder = RemoveHtml($this->kontak_person->caption());

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

			// mou2
			$this->mou2->EditAttrs["class"] = "form-control";
			$this->mou2->EditCustomAttributes = "";
			if (!EmptyValue($this->mou2->Upload->DbValue)) {
				$this->mou2->EditValue = $this->mou2->Upload->DbValue;
			} else {
				$this->mou2->EditValue = "";
			}
			if (!EmptyValue($this->mou2->CurrentValue))
					$this->mou2->Upload->FileName = $this->mou2->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->mou2);

			// mou3
			$this->mou3->EditAttrs["class"] = "form-control";
			$this->mou3->EditCustomAttributes = "";
			if (!EmptyValue($this->mou3->Upload->DbValue)) {
				$this->mou3->EditValue = $this->mou3->Upload->DbValue;
			} else {
				$this->mou3->EditValue = "";
			}
			if (!EmptyValue($this->mou3->CurrentValue))
					$this->mou3->Upload->FileName = $this->mou3->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->mou3);

			// sk
			$this->sk->EditAttrs["class"] = "form-control";
			$this->sk->EditCustomAttributes = "";
			if (!EmptyValue($this->sk->Upload->DbValue)) {
				$this->sk->EditValue = $this->sk->Upload->DbValue;
			} else {
				$this->sk->EditValue = "";
			}
			if (!EmptyValue($this->sk->CurrentValue))
					$this->sk->Upload->FileName = $this->sk->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->sk);

			// sk2
			$this->sk2->EditAttrs["class"] = "form-control";
			$this->sk2->EditCustomAttributes = "";
			if (!EmptyValue($this->sk2->Upload->DbValue)) {
				$this->sk2->EditValue = $this->sk2->Upload->DbValue;
			} else {
				$this->sk2->EditValue = "";
			}
			if (!EmptyValue($this->sk2->CurrentValue))
					$this->sk2->Upload->FileName = $this->sk2->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->sk2);

			// sk3
			$this->sk3->EditAttrs["class"] = "form-control";
			$this->sk3->EditCustomAttributes = "";
			if (!EmptyValue($this->sk3->Upload->DbValue)) {
				$this->sk3->EditValue = $this->sk3->Upload->DbValue;
			} else {
				$this->sk3->EditValue = "";
			}
			if (!EmptyValue($this->sk3->CurrentValue))
					$this->sk3->Upload->FileName = $this->sk3->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->sk3);

			// sk4
			$this->sk4->EditAttrs["class"] = "form-control";
			$this->sk4->EditCustomAttributes = "";
			if (!EmptyValue($this->sk4->Upload->DbValue)) {
				$this->sk4->EditValue = $this->sk4->Upload->DbValue;
			} else {
				$this->sk4->EditValue = "";
			}
			if (!EmptyValue($this->sk4->CurrentValue))
					$this->sk4->Upload->FileName = $this->sk4->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->sk4);

			// sk5
			$this->sk5->EditAttrs["class"] = "form-control";
			$this->sk5->EditCustomAttributes = "";
			if (!EmptyValue($this->sk5->Upload->DbValue)) {
				$this->sk5->EditValue = $this->sk5->Upload->DbValue;
			} else {
				$this->sk5->EditValue = "";
			}
			if (!EmptyValue($this->sk5->CurrentValue))
					$this->sk5->Upload->FileName = $this->sk5->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->sk5);

			// jml_hari
			$this->jml_hari->EditAttrs["class"] = "form-control";
			$this->jml_hari->EditCustomAttributes = "";
			$this->jml_hari->EditValue = HtmlEncode($this->jml_hari->CurrentValue);
			$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());

			// Add refer script
			// jenispel

			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// angkatan
			$this->angkatan->LinkCustomAttributes = "";
			$this->angkatan->HrefValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";

			// kontak_person
			$this->kontak_person->LinkCustomAttributes = "";
			$this->kontak_person->HrefValue = "";

			// tglrevisi
			$this->tglrevisi->LinkCustomAttributes = "";
			$this->tglrevisi->HrefValue = "";

			// tahun_rencana
			$this->tahun_rencana->LinkCustomAttributes = "";
			$this->tahun_rencana->HrefValue = "";

			// mou
			$this->mou->LinkCustomAttributes = "";
			$this->mou->HrefValue = "";
			$this->mou->ExportHrefValue = $this->mou->UploadPath . $this->mou->Upload->DbValue;

			// mou2
			$this->mou2->LinkCustomAttributes = "";
			$this->mou2->HrefValue = "";
			$this->mou2->ExportHrefValue = $this->mou2->UploadPath . $this->mou2->Upload->DbValue;

			// mou3
			$this->mou3->LinkCustomAttributes = "";
			$this->mou3->HrefValue = "";
			$this->mou3->ExportHrefValue = $this->mou3->UploadPath . $this->mou3->Upload->DbValue;

			// sk
			$this->sk->LinkCustomAttributes = "";
			$this->sk->HrefValue = "";
			$this->sk->ExportHrefValue = $this->sk->UploadPath . $this->sk->Upload->DbValue;

			// sk2
			$this->sk2->LinkCustomAttributes = "";
			$this->sk2->HrefValue = "";
			$this->sk2->ExportHrefValue = $this->sk2->UploadPath . $this->sk2->Upload->DbValue;

			// sk3
			$this->sk3->LinkCustomAttributes = "";
			$this->sk3->HrefValue = "";
			$this->sk3->ExportHrefValue = $this->sk3->UploadPath . $this->sk3->Upload->DbValue;

			// sk4
			$this->sk4->LinkCustomAttributes = "";
			$this->sk4->HrefValue = "";
			$this->sk4->ExportHrefValue = $this->sk4->UploadPath . $this->sk4->Upload->DbValue;

			// sk5
			$this->sk5->LinkCustomAttributes = "";
			$this->sk5->HrefValue = "";
			$this->sk5->ExportHrefValue = $this->sk5->UploadPath . $this->sk5->Upload->DbValue;

			// jml_hari
			$this->jml_hari->LinkCustomAttributes = "";
			$this->jml_hari->HrefValue = "";
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
		if ($this->angkatan->Required) {
			if (!$this->angkatan->IsDetailKey && $this->angkatan->FormValue != NULL && $this->angkatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->angkatan->caption(), $this->angkatan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->angkatan->FormValue)) {
			AddMessage($FormError, $this->angkatan->errorMessage());
		}
		if ($this->targetpes->Required) {
			if (!$this->targetpes->IsDetailKey && $this->targetpes->FormValue != NULL && $this->targetpes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes->caption(), $this->targetpes->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes->FormValue)) {
			AddMessage($FormError, $this->targetpes->errorMessage());
		}
		if ($this->kontak_person->Required) {
			if (!$this->kontak_person->IsDetailKey && $this->kontak_person->FormValue != NULL && $this->kontak_person->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kontak_person->caption(), $this->kontak_person->RequiredErrorMessage));
			}
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
		if ($this->mou->Required) {
			if ($this->mou->Upload->FileName == "" && !$this->mou->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->mou->caption(), $this->mou->RequiredErrorMessage));
			}
		}
		if ($this->mou2->Required) {
			if ($this->mou2->Upload->FileName == "" && !$this->mou2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->mou2->caption(), $this->mou2->RequiredErrorMessage));
			}
		}
		if ($this->mou3->Required) {
			if ($this->mou3->Upload->FileName == "" && !$this->mou3->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->mou3->caption(), $this->mou3->RequiredErrorMessage));
			}
		}
		if ($this->sk->Required) {
			if ($this->sk->Upload->FileName == "" && !$this->sk->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->sk->caption(), $this->sk->RequiredErrorMessage));
			}
		}
		if ($this->sk2->Required) {
			if ($this->sk2->Upload->FileName == "" && !$this->sk2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->sk2->caption(), $this->sk2->RequiredErrorMessage));
			}
		}
		if ($this->sk3->Required) {
			if ($this->sk3->Upload->FileName == "" && !$this->sk3->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->sk3->caption(), $this->sk3->RequiredErrorMessage));
			}
		}
		if ($this->sk4->Required) {
			if ($this->sk4->Upload->FileName == "" && !$this->sk4->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->sk4->caption(), $this->sk4->RequiredErrorMessage));
			}
		}
		if ($this->sk5->Required) {
			if ($this->sk5->Upload->FileName == "" && !$this->sk5->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->sk5->caption(), $this->sk5->RequiredErrorMessage));
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("diklatkerjasama", $detailTblVar) && $GLOBALS["diklatkerjasama"]->DetailAdd) {
			if (!isset($GLOBALS["diklatkerjasama_grid"]))
				$GLOBALS["diklatkerjasama_grid"] = new diklatkerjasama_grid(); // Get detail page object
			$GLOBALS["diklatkerjasama_grid"]->validateGridForm();
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

		// jenispel
		$this->jenispel->setDbValueDef($rsnew, $this->jenispel->CurrentValue, NULL, FALSE);

		// kdkategori
		$this->kdkategori->setDbValueDef($rsnew, $this->kdkategori->CurrentValue, NULL, FALSE);

		// kerjasama
		$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, NULL, FALSE);

		// angkatan
		$this->angkatan->setDbValueDef($rsnew, $this->angkatan->CurrentValue, NULL, FALSE);

		// targetpes
		$this->targetpes->setDbValueDef($rsnew, $this->targetpes->CurrentValue, NULL, FALSE);

		// kontak_person
		$this->kontak_person->setDbValueDef($rsnew, $this->kontak_person->CurrentValue, NULL, FALSE);

		// tglrevisi
		$this->tglrevisi->setDbValueDef($rsnew, UnFormatDateTime($this->tglrevisi->CurrentValue, 0), NULL, FALSE);

		// tahun_rencana
		$this->tahun_rencana->setDbValueDef($rsnew, $this->tahun_rencana->CurrentValue, NULL, FALSE);

		// mou
		if ($this->mou->Visible && !$this->mou->Upload->KeepFile) {
			$this->mou->Upload->DbValue = ""; // No need to delete old file
			if ($this->mou->Upload->FileName == "") {
				$rsnew['mou'] = NULL;
			} else {
				$rsnew['mou'] = $this->mou->Upload->FileName;
			}
		}

		// mou2
		if ($this->mou2->Visible && !$this->mou2->Upload->KeepFile) {
			$this->mou2->Upload->DbValue = ""; // No need to delete old file
			if ($this->mou2->Upload->FileName == "") {
				$rsnew['mou2'] = NULL;
			} else {
				$rsnew['mou2'] = $this->mou2->Upload->FileName;
			}
		}

		// mou3
		if ($this->mou3->Visible && !$this->mou3->Upload->KeepFile) {
			$this->mou3->Upload->DbValue = ""; // No need to delete old file
			if ($this->mou3->Upload->FileName == "") {
				$rsnew['mou3'] = NULL;
			} else {
				$rsnew['mou3'] = $this->mou3->Upload->FileName;
			}
		}

		// sk
		if ($this->sk->Visible && !$this->sk->Upload->KeepFile) {
			$this->sk->Upload->DbValue = ""; // No need to delete old file
			if ($this->sk->Upload->FileName == "") {
				$rsnew['sk'] = NULL;
			} else {
				$rsnew['sk'] = $this->sk->Upload->FileName;
			}
		}

		// sk2
		if ($this->sk2->Visible && !$this->sk2->Upload->KeepFile) {
			$this->sk2->Upload->DbValue = ""; // No need to delete old file
			if ($this->sk2->Upload->FileName == "") {
				$rsnew['sk2'] = NULL;
			} else {
				$rsnew['sk2'] = $this->sk2->Upload->FileName;
			}
		}

		// sk3
		if ($this->sk3->Visible && !$this->sk3->Upload->KeepFile) {
			$this->sk3->Upload->DbValue = ""; // No need to delete old file
			if ($this->sk3->Upload->FileName == "") {
				$rsnew['sk3'] = NULL;
			} else {
				$rsnew['sk3'] = $this->sk3->Upload->FileName;
			}
		}

		// sk4
		if ($this->sk4->Visible && !$this->sk4->Upload->KeepFile) {
			$this->sk4->Upload->DbValue = ""; // No need to delete old file
			if ($this->sk4->Upload->FileName == "") {
				$rsnew['sk4'] = NULL;
			} else {
				$rsnew['sk4'] = $this->sk4->Upload->FileName;
			}
		}

		// sk5
		if ($this->sk5->Visible && !$this->sk5->Upload->KeepFile) {
			$this->sk5->Upload->DbValue = ""; // No need to delete old file
			if ($this->sk5->Upload->FileName == "") {
				$rsnew['sk5'] = NULL;
			} else {
				$rsnew['sk5'] = $this->sk5->Upload->FileName;
			}
		}

		// jml_hari
		$this->jml_hari->setDbValueDef($rsnew, $this->jml_hari->CurrentValue, NULL, FALSE);
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
		if ($this->mou2->Visible && !$this->mou2->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->mou2->Upload->DbValue) ? [] : [$this->mou2->htmlDecode($this->mou2->Upload->DbValue)];
			if (!EmptyValue($this->mou2->Upload->FileName)) {
				$newFiles = [$this->mou2->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->mou2, $this->mou2->Upload->Index);
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
							$file1 = UniqueFilename($this->mou2->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->mou2->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->mou2->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->mou2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->mou2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->mou2->setDbValueDef($rsnew, $this->mou2->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->mou3->Visible && !$this->mou3->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->mou3->Upload->DbValue) ? [] : [$this->mou3->htmlDecode($this->mou3->Upload->DbValue)];
			if (!EmptyValue($this->mou3->Upload->FileName)) {
				$newFiles = [$this->mou3->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->mou3, $this->mou3->Upload->Index);
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
							$file1 = UniqueFilename($this->mou3->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->mou3->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->mou3->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->mou3->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->mou3->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->mou3->setDbValueDef($rsnew, $this->mou3->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->sk->Visible && !$this->sk->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->sk->Upload->DbValue) ? [] : [$this->sk->htmlDecode($this->sk->Upload->DbValue)];
			if (!EmptyValue($this->sk->Upload->FileName)) {
				$newFiles = [$this->sk->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->sk, $this->sk->Upload->Index);
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
							$file1 = UniqueFilename($this->sk->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->sk->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->sk->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->sk->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->sk->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->sk->setDbValueDef($rsnew, $this->sk->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->sk2->Visible && !$this->sk2->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->sk2->Upload->DbValue) ? [] : [$this->sk2->htmlDecode($this->sk2->Upload->DbValue)];
			if (!EmptyValue($this->sk2->Upload->FileName)) {
				$newFiles = [$this->sk2->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->sk2, $this->sk2->Upload->Index);
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
							$file1 = UniqueFilename($this->sk2->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->sk2->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->sk2->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->sk2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->sk2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->sk2->setDbValueDef($rsnew, $this->sk2->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->sk3->Visible && !$this->sk3->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->sk3->Upload->DbValue) ? [] : [$this->sk3->htmlDecode($this->sk3->Upload->DbValue)];
			if (!EmptyValue($this->sk3->Upload->FileName)) {
				$newFiles = [$this->sk3->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->sk3, $this->sk3->Upload->Index);
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
							$file1 = UniqueFilename($this->sk3->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->sk3->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->sk3->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->sk3->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->sk3->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->sk3->setDbValueDef($rsnew, $this->sk3->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->sk4->Visible && !$this->sk4->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->sk4->Upload->DbValue) ? [] : [$this->sk4->htmlDecode($this->sk4->Upload->DbValue)];
			if (!EmptyValue($this->sk4->Upload->FileName)) {
				$newFiles = [$this->sk4->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->sk4, $this->sk4->Upload->Index);
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
							$file1 = UniqueFilename($this->sk4->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->sk4->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->sk4->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->sk4->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->sk4->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->sk4->setDbValueDef($rsnew, $this->sk4->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->sk5->Visible && !$this->sk5->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->sk5->Upload->DbValue) ? [] : [$this->sk5->htmlDecode($this->sk5->Upload->DbValue)];
			if (!EmptyValue($this->sk5->Upload->FileName)) {
				$newFiles = [$this->sk5->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->sk5, $this->sk5->Upload->Index);
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
							$file1 = UniqueFilename($this->sk5->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->sk5->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->sk5->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->sk5->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->sk5->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->sk5->setDbValueDef($rsnew, $this->sk5->Upload->FileName, NULL, FALSE);
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
				if ($this->mou2->Visible && !$this->mou2->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->mou2->Upload->DbValue) ? [] : [$this->mou2->htmlDecode($this->mou2->Upload->DbValue)];
					if (!EmptyValue($this->mou2->Upload->FileName)) {
						$newFiles = [$this->mou2->Upload->FileName];
						$newFiles2 = [$this->mou2->htmlDecode($rsnew['mou2'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->mou2, $this->mou2->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->mou2->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->mou2->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->mou3->Visible && !$this->mou3->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->mou3->Upload->DbValue) ? [] : [$this->mou3->htmlDecode($this->mou3->Upload->DbValue)];
					if (!EmptyValue($this->mou3->Upload->FileName)) {
						$newFiles = [$this->mou3->Upload->FileName];
						$newFiles2 = [$this->mou3->htmlDecode($rsnew['mou3'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->mou3, $this->mou3->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->mou3->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->mou3->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->sk->Visible && !$this->sk->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->sk->Upload->DbValue) ? [] : [$this->sk->htmlDecode($this->sk->Upload->DbValue)];
					if (!EmptyValue($this->sk->Upload->FileName)) {
						$newFiles = [$this->sk->Upload->FileName];
						$newFiles2 = [$this->sk->htmlDecode($rsnew['sk'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->sk, $this->sk->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->sk->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->sk->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->sk2->Visible && !$this->sk2->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->sk2->Upload->DbValue) ? [] : [$this->sk2->htmlDecode($this->sk2->Upload->DbValue)];
					if (!EmptyValue($this->sk2->Upload->FileName)) {
						$newFiles = [$this->sk2->Upload->FileName];
						$newFiles2 = [$this->sk2->htmlDecode($rsnew['sk2'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->sk2, $this->sk2->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->sk2->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->sk2->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->sk3->Visible && !$this->sk3->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->sk3->Upload->DbValue) ? [] : [$this->sk3->htmlDecode($this->sk3->Upload->DbValue)];
					if (!EmptyValue($this->sk3->Upload->FileName)) {
						$newFiles = [$this->sk3->Upload->FileName];
						$newFiles2 = [$this->sk3->htmlDecode($rsnew['sk3'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->sk3, $this->sk3->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->sk3->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->sk3->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->sk4->Visible && !$this->sk4->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->sk4->Upload->DbValue) ? [] : [$this->sk4->htmlDecode($this->sk4->Upload->DbValue)];
					if (!EmptyValue($this->sk4->Upload->FileName)) {
						$newFiles = [$this->sk4->Upload->FileName];
						$newFiles2 = [$this->sk4->htmlDecode($rsnew['sk4'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->sk4, $this->sk4->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->sk4->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->sk4->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->sk5->Visible && !$this->sk5->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->sk5->Upload->DbValue) ? [] : [$this->sk5->htmlDecode($this->sk5->Upload->DbValue)];
					if (!EmptyValue($this->sk5->Upload->FileName)) {
						$newFiles = [$this->sk5->Upload->FileName];
						$newFiles2 = [$this->sk5->htmlDecode($rsnew['sk5'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->sk5, $this->sk5->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->sk5->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->sk5->oldPhysicalUploadPath() . $oldFile);
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
			if (in_array("diklatkerjasama", $detailTblVar) && $GLOBALS["diklatkerjasama"]->DetailAdd) {
				$GLOBALS["diklatkerjasama"]->rid->setSessionValue($this->rpkid->CurrentValue); // Set master key
				$GLOBALS["diklatkerjasama"]->jenispel->setSessionValue($this->jenispel->CurrentValue); // Set master key
				if (!isset($GLOBALS["diklatkerjasama_grid"]))
					$GLOBALS["diklatkerjasama_grid"] = new diklatkerjasama_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "diklatkerjasama"); // Load user level of detail table
				$addRow = $GLOBALS["diklatkerjasama_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["diklatkerjasama"]->rid->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["diklatkerjasama"]->jenispel->setSessionValue(""); // Clear master key if insert failed
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

			// mou2
			CleanUploadTempPath($this->mou2, $this->mou2->Upload->Index);

			// mou3
			CleanUploadTempPath($this->mou3, $this->mou3->Upload->Index);

			// sk
			CleanUploadTempPath($this->sk, $this->sk->Upload->Index);

			// sk2
			CleanUploadTempPath($this->sk2, $this->sk2->Upload->Index);

			// sk3
			CleanUploadTempPath($this->sk3, $this->sk3->Upload->Index);

			// sk4
			CleanUploadTempPath($this->sk4, $this->sk4->Upload->Index);

			// sk5
			CleanUploadTempPath($this->sk5, $this->sk5->Upload->Index);
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
			if (in_array("diklatkerjasama", $detailTblVar)) {
				if (!isset($GLOBALS["diklatkerjasama_grid"]))
					$GLOBALS["diklatkerjasama_grid"] = new diklatkerjasama_grid();
				if ($GLOBALS["diklatkerjasama_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["diklatkerjasama_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["diklatkerjasama_grid"]->CurrentMode = "add";
					$GLOBALS["diklatkerjasama_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["diklatkerjasama_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["diklatkerjasama_grid"]->setStartRecordNumber(1);
					$GLOBALS["diklatkerjasama_grid"]->rid->IsDetailKey = TRUE;
					$GLOBALS["diklatkerjasama_grid"]->rid->CurrentValue = $this->rpkid->CurrentValue;
					$GLOBALS["diklatkerjasama_grid"]->rid->setSessionValue($GLOBALS["diklatkerjasama_grid"]->rid->CurrentValue);
					$GLOBALS["diklatkerjasama_grid"]->jenispel->IsDetailKey = TRUE;
					$GLOBALS["diklatkerjasama_grid"]->jenispel->CurrentValue = $this->jenispel->CurrentValue;
					$GLOBALS["diklatkerjasama_grid"]->jenispel->setSessionValue($GLOBALS["diklatkerjasama_grid"]->jenispel->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_rpkerjasamalist.php"), "", $this->TableVar, TRUE);
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
				case "x_kdprop":
					break;
				case "x_kdkota":
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
						case "x_kdprop":
							break;
						case "x_kdkota":
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
		SetClientVar("SqlCP1", Encrypt("SELECT cp1 FROM t_cp WHERE namap = {query_value}"));
		SetClientVar("SqlCP2", Encrypt("SELECT cp2 FROM t_cp WHERE namap = {query_value}"));
		SetClientVar("SqlCP3", Encrypt("SELECT cp3 FROM t_cp WHERE namap = {query_value}"));
		$this->jml_hari->Visible = FALSE;
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