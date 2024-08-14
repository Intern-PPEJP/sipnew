<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class diklatkerjasama_add extends diklatkerjasama
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 'diklatkerjasama';

	// Page object name
	public $PageObjName = "diklatkerjasama_add";

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

		// Table object (diklatkerjasama)
		if (!isset($GLOBALS["diklatkerjasama"]) || get_class($GLOBALS["diklatkerjasama"]) == PROJECT_NAMESPACE . "diklatkerjasama") {
			$GLOBALS["diklatkerjasama"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["diklatkerjasama"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (t_rpkerjasama)
		if (!isset($GLOBALS['t_rpkerjasama']))
			$GLOBALS['t_rpkerjasama'] = new t_rpkerjasama();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'diklatkerjasama');

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
		global $diklatkerjasama;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($diklatkerjasama);
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
					if ($pageName == "diklatkerjasamaview.php")
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
			$key .= @$ar['idpelat'];
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
			$this->idpelat->Visible = FALSE;
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
	public $MultiPages; // Multi pages object

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
					$this->terminate(GetUrl("diklatkerjasamalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->idpelat->Visible = FALSE;
		$this->kdpelat->Visible = FALSE;
		$this->kdjudul->setVisibility();
		$this->kdkursil->setVisibility();
		$this->tawal->setVisibility();
		$this->takhir->setVisibility();
		$this->jml_hari->setVisibility();
		$this->targetpes->setVisibility();
		$this->ketua->setVisibility();
		$this->sekretaris->setVisibility();
		$this->bendahara->setVisibility();
		$this->anggota2->setVisibility();
		$this->widyaiswara->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->tempat->setVisibility();
		$this->biaya->setVisibility();
		$this->statuspel->setVisibility();
		$this->rid->Visible = FALSE;
		$this->jenispel->Visible = FALSE;
		$this->jenisevaluasi->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up multi page object
		$this->setupMultiPages();

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
		$this->setupLookupOptions($this->ketua);
		$this->setupLookupOptions($this->sekretaris);
		$this->setupLookupOptions($this->bendahara);
		$this->setupLookupOptions($this->anggota2);
		$this->setupLookupOptions($this->widyaiswara);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);
		$this->setupLookupOptions($this->jenisevaluasi);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("diklatkerjasamalist.php");
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
			if (Get("idpelat") !== NULL) {
				$this->idpelat->setQueryStringValue(Get("idpelat"));
				$this->setKey("idpelat", $this->idpelat->CurrentValue); // Set up key
			} else {
				$this->setKey("idpelat", ""); // Clear key
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
					$this->terminate("diklatkerjasamalist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "diklatkerjasamalist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "diklatkerjasamaview.php")
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
		$this->idpelat->CurrentValue = NULL;
		$this->idpelat->OldValue = $this->idpelat->CurrentValue;
		$this->kdpelat->CurrentValue = NULL;
		$this->kdpelat->OldValue = $this->kdpelat->CurrentValue;
		$this->kdjudul->CurrentValue = NULL;
		$this->kdjudul->OldValue = $this->kdjudul->CurrentValue;
		$this->kdkursil->CurrentValue = NULL;
		$this->kdkursil->OldValue = $this->kdkursil->CurrentValue;
		$this->tawal->CurrentValue = NULL;
		$this->tawal->OldValue = $this->tawal->CurrentValue;
		$this->takhir->CurrentValue = NULL;
		$this->takhir->OldValue = $this->takhir->CurrentValue;
		$this->jml_hari->CurrentValue = NULL;
		$this->jml_hari->OldValue = $this->jml_hari->CurrentValue;
		$this->targetpes->CurrentValue = 0;
		$this->ketua->CurrentValue = NULL;
		$this->ketua->OldValue = $this->ketua->CurrentValue;
		$this->sekretaris->CurrentValue = NULL;
		$this->sekretaris->OldValue = $this->sekretaris->CurrentValue;
		$this->bendahara->CurrentValue = NULL;
		$this->bendahara->OldValue = $this->bendahara->CurrentValue;
		$this->anggota2->CurrentValue = NULL;
		$this->anggota2->OldValue = $this->anggota2->CurrentValue;
		$this->widyaiswara->CurrentValue = NULL;
		$this->widyaiswara->OldValue = $this->widyaiswara->CurrentValue;
		$this->kdprop->CurrentValue = NULL;
		$this->kdprop->OldValue = $this->kdprop->CurrentValue;
		$this->kdkota->CurrentValue = NULL;
		$this->kdkota->OldValue = $this->kdkota->CurrentValue;
		$this->tempat->CurrentValue = NULL;
		$this->tempat->OldValue = $this->tempat->CurrentValue;
		$this->biaya->CurrentValue = 0;
		$this->statuspel->CurrentValue = NULL;
		$this->statuspel->OldValue = $this->statuspel->CurrentValue;
		$this->rid->CurrentValue = NULL;
		$this->rid->OldValue = $this->rid->CurrentValue;
		$this->jenispel->CurrentValue = NULL;
		$this->jenispel->OldValue = $this->jenispel->CurrentValue;
		$this->jenisevaluasi->CurrentValue = NULL;
		$this->jenisevaluasi->OldValue = $this->jenisevaluasi->CurrentValue;
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

		// Check field name 'kdkursil' first before field var 'x_kdkursil'
		$val = $CurrentForm->hasValue("kdkursil") ? $CurrentForm->getValue("kdkursil") : $CurrentForm->getValue("x_kdkursil");
		if (!$this->kdkursil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkursil->Visible = FALSE; // Disable update for API request
			else
				$this->kdkursil->setFormValue($val);
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

		// Check field name 'jml_hari' first before field var 'x_jml_hari'
		$val = $CurrentForm->hasValue("jml_hari") ? $CurrentForm->getValue("jml_hari") : $CurrentForm->getValue("x_jml_hari");
		if (!$this->jml_hari->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_hari->Visible = FALSE; // Disable update for API request
			else
				$this->jml_hari->setFormValue($val);
		}

		// Check field name 'targetpes' first before field var 'x_targetpes'
		$val = $CurrentForm->hasValue("targetpes") ? $CurrentForm->getValue("targetpes") : $CurrentForm->getValue("x_targetpes");
		if (!$this->targetpes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes->setFormValue($val);
		}

		// Check field name 'ketua' first before field var 'x_ketua'
		$val = $CurrentForm->hasValue("ketua") ? $CurrentForm->getValue("ketua") : $CurrentForm->getValue("x_ketua");
		if (!$this->ketua->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ketua->Visible = FALSE; // Disable update for API request
			else
				$this->ketua->setFormValue($val);
		}

		// Check field name 'sekretaris' first before field var 'x_sekretaris'
		$val = $CurrentForm->hasValue("sekretaris") ? $CurrentForm->getValue("sekretaris") : $CurrentForm->getValue("x_sekretaris");
		if (!$this->sekretaris->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sekretaris->Visible = FALSE; // Disable update for API request
			else
				$this->sekretaris->setFormValue($val);
		}

		// Check field name 'bendahara' first before field var 'x_bendahara'
		$val = $CurrentForm->hasValue("bendahara") ? $CurrentForm->getValue("bendahara") : $CurrentForm->getValue("x_bendahara");
		if (!$this->bendahara->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->bendahara->Visible = FALSE; // Disable update for API request
			else
				$this->bendahara->setFormValue($val);
		}

		// Check field name 'anggota2' first before field var 'x_anggota2'
		$val = $CurrentForm->hasValue("anggota2") ? $CurrentForm->getValue("anggota2") : $CurrentForm->getValue("x_anggota2");
		if (!$this->anggota2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->anggota2->Visible = FALSE; // Disable update for API request
			else
				$this->anggota2->setFormValue($val);
		}

		// Check field name 'widyaiswara' first before field var 'x_widyaiswara'
		$val = $CurrentForm->hasValue("widyaiswara") ? $CurrentForm->getValue("widyaiswara") : $CurrentForm->getValue("x_widyaiswara");
		if (!$this->widyaiswara->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->widyaiswara->Visible = FALSE; // Disable update for API request
			else
				$this->widyaiswara->setFormValue($val);
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

		// Check field name 'tempat' first before field var 'x_tempat'
		$val = $CurrentForm->hasValue("tempat") ? $CurrentForm->getValue("tempat") : $CurrentForm->getValue("x_tempat");
		if (!$this->tempat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tempat->Visible = FALSE; // Disable update for API request
			else
				$this->tempat->setFormValue($val);
		}

		// Check field name 'biaya' first before field var 'x_biaya'
		$val = $CurrentForm->hasValue("biaya") ? $CurrentForm->getValue("biaya") : $CurrentForm->getValue("x_biaya");
		if (!$this->biaya->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->biaya->Visible = FALSE; // Disable update for API request
			else
				$this->biaya->setFormValue($val);
		}

		// Check field name 'statuspel' first before field var 'x_statuspel'
		$val = $CurrentForm->hasValue("statuspel") ? $CurrentForm->getValue("statuspel") : $CurrentForm->getValue("x_statuspel");
		if (!$this->statuspel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->statuspel->Visible = FALSE; // Disable update for API request
			else
				$this->statuspel->setFormValue($val);
		}

		// Check field name 'jenisevaluasi' first before field var 'x_jenisevaluasi'
		$val = $CurrentForm->hasValue("jenisevaluasi") ? $CurrentForm->getValue("jenisevaluasi") : $CurrentForm->getValue("x_jenisevaluasi");
		if (!$this->jenisevaluasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenisevaluasi->Visible = FALSE; // Disable update for API request
			else
				$this->jenisevaluasi->setFormValue($val);
		}

		// Check field name 'idpelat' first before field var 'x_idpelat'
		$val = $CurrentForm->hasValue("idpelat") ? $CurrentForm->getValue("idpelat") : $CurrentForm->getValue("x_idpelat");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->kdkursil->CurrentValue = $this->kdkursil->FormValue;
		$this->tawal->CurrentValue = $this->tawal->FormValue;
		$this->tawal->CurrentValue = UnFormatDateTime($this->tawal->CurrentValue, 0);
		$this->takhir->CurrentValue = $this->takhir->FormValue;
		$this->takhir->CurrentValue = UnFormatDateTime($this->takhir->CurrentValue, 0);
		$this->jml_hari->CurrentValue = $this->jml_hari->FormValue;
		$this->targetpes->CurrentValue = $this->targetpes->FormValue;
		$this->ketua->CurrentValue = $this->ketua->FormValue;
		$this->sekretaris->CurrentValue = $this->sekretaris->FormValue;
		$this->bendahara->CurrentValue = $this->bendahara->FormValue;
		$this->anggota2->CurrentValue = $this->anggota2->FormValue;
		$this->widyaiswara->CurrentValue = $this->widyaiswara->FormValue;
		$this->kdprop->CurrentValue = $this->kdprop->FormValue;
		$this->kdkota->CurrentValue = $this->kdkota->FormValue;
		$this->tempat->CurrentValue = $this->tempat->FormValue;
		$this->biaya->CurrentValue = $this->biaya->FormValue;
		$this->statuspel->CurrentValue = $this->statuspel->FormValue;
		$this->jenisevaluasi->CurrentValue = $this->jenisevaluasi->FormValue;
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
		$this->idpelat->setDbValue($row['idpelat']);
		$this->kdpelat->setDbValue($row['kdpelat']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->tawal->setDbValue($row['tawal']);
		$this->takhir->setDbValue($row['takhir']);
		$this->jml_hari->setDbValue($row['jml_hari']);
		$this->targetpes->setDbValue($row['targetpes']);
		$this->ketua->setDbValue($row['ketua']);
		$this->sekretaris->setDbValue($row['sekretaris']);
		$this->bendahara->setDbValue($row['bendahara']);
		$this->anggota2->setDbValue($row['anggota2']);
		$this->widyaiswara->setDbValue($row['widyaiswara']);
		$this->kdprop->setDbValue($row['kdprop']);
		$this->kdkota->setDbValue($row['kdkota']);
		$this->tempat->setDbValue($row['tempat']);
		$this->biaya->setDbValue($row['biaya']);
		$this->statuspel->setDbValue($row['statuspel']);
		$this->rid->setDbValue($row['rid']);
		$this->jenispel->setDbValue($row['jenispel']);
		$this->jenisevaluasi->setDbValue($row['jenisevaluasi']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['idpelat'] = $this->idpelat->CurrentValue;
		$row['kdpelat'] = $this->kdpelat->CurrentValue;
		$row['kdjudul'] = $this->kdjudul->CurrentValue;
		$row['kdkursil'] = $this->kdkursil->CurrentValue;
		$row['tawal'] = $this->tawal->CurrentValue;
		$row['takhir'] = $this->takhir->CurrentValue;
		$row['jml_hari'] = $this->jml_hari->CurrentValue;
		$row['targetpes'] = $this->targetpes->CurrentValue;
		$row['ketua'] = $this->ketua->CurrentValue;
		$row['sekretaris'] = $this->sekretaris->CurrentValue;
		$row['bendahara'] = $this->bendahara->CurrentValue;
		$row['anggota2'] = $this->anggota2->CurrentValue;
		$row['widyaiswara'] = $this->widyaiswara->CurrentValue;
		$row['kdprop'] = $this->kdprop->CurrentValue;
		$row['kdkota'] = $this->kdkota->CurrentValue;
		$row['tempat'] = $this->tempat->CurrentValue;
		$row['biaya'] = $this->biaya->CurrentValue;
		$row['statuspel'] = $this->statuspel->CurrentValue;
		$row['rid'] = $this->rid->CurrentValue;
		$row['jenispel'] = $this->jenispel->CurrentValue;
		$row['jenisevaluasi'] = $this->jenisevaluasi->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idpelat")) != "")
			$this->idpelat->OldValue = $this->getKey("idpelat"); // idpelat
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
		// idpelat
		// kdpelat
		// kdjudul
		// kdkursil
		// tawal
		// takhir
		// jml_hari
		// targetpes
		// ketua
		// sekretaris
		// bendahara
		// anggota2
		// widyaiswara
		// kdprop
		// kdkota
		// tempat
		// biaya
		// statuspel
		// rid
		// jenispel
		// jenisevaluasi

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// tawal
			$this->tawal->ViewValue = $this->tawal->CurrentValue;
			$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
			$this->tawal->ViewCustomAttributes = "";

			// takhir
			$this->takhir->ViewValue = $this->takhir->CurrentValue;
			$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
			$this->takhir->ViewCustomAttributes = "";

			// jml_hari
			$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
			$this->jml_hari->ViewCustomAttributes = "";

			// targetpes
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->ViewCustomAttributes = "";

			// ketua
			$this->ketua->ViewValue = $this->ketua->CurrentValue;
			$curVal = strval($this->ketua->CurrentValue);
			if ($curVal != "") {
				$this->ketua->ViewValue = $this->ketua->lookupCacheOption($curVal);
				if ($this->ketua->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ketua->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ketua->ViewValue = $this->ketua->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ketua->ViewValue = $this->ketua->CurrentValue;
					}
				}
			} else {
				$this->ketua->ViewValue = NULL;
			}
			$this->ketua->ViewCustomAttributes = "";

			// sekretaris
			$this->sekretaris->ViewValue = $this->sekretaris->CurrentValue;
			$curVal = strval($this->sekretaris->CurrentValue);
			if ($curVal != "") {
				$this->sekretaris->ViewValue = $this->sekretaris->lookupCacheOption($curVal);
				if ($this->sekretaris->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->sekretaris->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->sekretaris->ViewValue = $this->sekretaris->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sekretaris->ViewValue = $this->sekretaris->CurrentValue;
					}
				}
			} else {
				$this->sekretaris->ViewValue = NULL;
			}
			$this->sekretaris->ViewCustomAttributes = "";

			// bendahara
			$this->bendahara->ViewValue = $this->bendahara->CurrentValue;
			$curVal = strval($this->bendahara->CurrentValue);
			if ($curVal != "") {
				$this->bendahara->ViewValue = $this->bendahara->lookupCacheOption($curVal);
				if ($this->bendahara->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->bendahara->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->bendahara->ViewValue = $this->bendahara->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->bendahara->ViewValue = $this->bendahara->CurrentValue;
					}
				}
			} else {
				$this->bendahara->ViewValue = NULL;
			}
			$this->bendahara->ViewCustomAttributes = "";

			// anggota2
			$this->anggota2->ViewValue = $this->anggota2->CurrentValue;
			$curVal = strval($this->anggota2->CurrentValue);
			if ($curVal != "") {
				$this->anggota2->ViewValue = $this->anggota2->lookupCacheOption($curVal);
				if ($this->anggota2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->anggota2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->anggota2->ViewValue = $this->anggota2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->anggota2->ViewValue = $this->anggota2->CurrentValue;
					}
				}
			} else {
				$this->anggota2->ViewValue = NULL;
			}
			$this->anggota2->ViewCustomAttributes = "";

			// widyaiswara
			$this->widyaiswara->ViewValue = $this->widyaiswara->CurrentValue;
			$curVal = strval($this->widyaiswara->CurrentValue);
			if ($curVal != "") {
				$this->widyaiswara->ViewValue = $this->widyaiswara->lookupCacheOption($curVal);
				if ($this->widyaiswara->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->widyaiswara->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->widyaiswara->ViewValue = $this->widyaiswara->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->widyaiswara->ViewValue = $this->widyaiswara->CurrentValue;
					}
				}
			} else {
				$this->widyaiswara->ViewValue = NULL;
			}
			$this->widyaiswara->ViewCustomAttributes = "";

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

			// biaya
			$this->biaya->ViewValue = $this->biaya->CurrentValue;
			$this->biaya->ViewValue = FormatCurrency($this->biaya->ViewValue, 0, -2, -2, -2);
			$this->biaya->ViewCustomAttributes = "";

			// statuspel
			if (strval($this->statuspel->CurrentValue) != "") {
				$this->statuspel->ViewValue = $this->statuspel->optionCaption($this->statuspel->CurrentValue);
			} else {
				$this->statuspel->ViewValue = NULL;
			}
			$this->statuspel->ViewCustomAttributes = "";

			// jenisevaluasi
			$curVal = strval($this->jenisevaluasi->CurrentValue);
			if ($curVal != "") {
				$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->lookupCacheOption($curVal);
				if ($this->jenisevaluasi->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`id`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->jenisevaluasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->jenisevaluasi->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->jenisevaluasi->ViewValue->add($this->jenisevaluasi->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->CurrentValue;
					}
				}
			} else {
				$this->jenisevaluasi->ViewValue = NULL;
			}
			$this->jenisevaluasi->ViewCustomAttributes = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";
			$this->kdkursil->TooltipValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";
			$this->tawal->TooltipValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";
			$this->takhir->TooltipValue = "";

			// jml_hari
			$this->jml_hari->LinkCustomAttributes = "";
			$this->jml_hari->HrefValue = "";
			$this->jml_hari->TooltipValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";
			$this->targetpes->TooltipValue = "";

			// ketua
			$this->ketua->LinkCustomAttributes = "";
			$this->ketua->HrefValue = "";
			$this->ketua->TooltipValue = "";

			// sekretaris
			$this->sekretaris->LinkCustomAttributes = "";
			$this->sekretaris->HrefValue = "";
			$this->sekretaris->TooltipValue = "";

			// bendahara
			$this->bendahara->LinkCustomAttributes = "";
			$this->bendahara->HrefValue = "";
			$this->bendahara->TooltipValue = "";

			// anggota2
			$this->anggota2->LinkCustomAttributes = "";
			$this->anggota2->HrefValue = "";
			$this->anggota2->TooltipValue = "";

			// widyaiswara
			$this->widyaiswara->LinkCustomAttributes = "";
			$this->widyaiswara->HrefValue = "";
			$this->widyaiswara->TooltipValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";
			$this->kdprop->TooltipValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";
			$this->kdkota->TooltipValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";
			$this->biaya->TooltipValue = "";

			// statuspel
			$this->statuspel->LinkCustomAttributes = "";
			$this->statuspel->HrefValue = "";
			$this->statuspel->TooltipValue = "";

			// jenisevaluasi
			$this->jenisevaluasi->LinkCustomAttributes = "";
			$this->jenisevaluasi->HrefValue = "";
			$this->jenisevaluasi->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if (!$this->kdjudul->Raw)
				$this->kdjudul->CurrentValue = HtmlDecode($this->kdjudul->CurrentValue);
			$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->CurrentValue);
			$curVal = strval($this->kdjudul->CurrentValue);
			if ($curVal != "") {
				$this->kdjudul->EditValue = $this->kdjudul->lookupCacheOption($curVal);
				if ($this->kdjudul->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdjudul`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdjudul->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kdjudul->EditValue = $this->kdjudul->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->CurrentValue);
					}
				}
			} else {
				$this->kdjudul->EditValue = NULL;
			}
			$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

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

			// tawal
			$this->tawal->EditAttrs["class"] = "form-control";
			$this->tawal->EditCustomAttributes = 'style=" width: 120px; "';
			$this->tawal->EditValue = HtmlEncode(FormatDateTime($this->tawal->CurrentValue, 8));
			$this->tawal->PlaceHolder = RemoveHtml($this->tawal->caption());

			// takhir
			$this->takhir->EditAttrs["class"] = "form-control";
			$this->takhir->EditCustomAttributes = 'style=" width: 120px; "';
			$this->takhir->EditValue = HtmlEncode(FormatDateTime($this->takhir->CurrentValue, 8));
			$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

			// jml_hari
			$this->jml_hari->EditAttrs["class"] = "form-control";
			$this->jml_hari->EditCustomAttributes = "";
			$this->jml_hari->EditValue = HtmlEncode($this->jml_hari->CurrentValue);
			$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());

			// targetpes
			$this->targetpes->EditAttrs["class"] = "form-control";
			$this->targetpes->EditCustomAttributes = "";
			$this->targetpes->EditValue = HtmlEncode($this->targetpes->CurrentValue);
			$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

			// ketua
			$this->ketua->EditAttrs["class"] = "form-control";
			$this->ketua->EditCustomAttributes = "";
			if (!$this->ketua->Raw)
				$this->ketua->CurrentValue = HtmlDecode($this->ketua->CurrentValue);
			$this->ketua->EditValue = HtmlEncode($this->ketua->CurrentValue);
			$curVal = strval($this->ketua->CurrentValue);
			if ($curVal != "") {
				$this->ketua->EditValue = $this->ketua->lookupCacheOption($curVal);
				if ($this->ketua->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ketua->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ketua->EditValue = $this->ketua->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ketua->EditValue = HtmlEncode($this->ketua->CurrentValue);
					}
				}
			} else {
				$this->ketua->EditValue = NULL;
			}
			$this->ketua->PlaceHolder = RemoveHtml($this->ketua->caption());

			// sekretaris
			$this->sekretaris->EditAttrs["class"] = "form-control";
			$this->sekretaris->EditCustomAttributes = "";
			if (!$this->sekretaris->Raw)
				$this->sekretaris->CurrentValue = HtmlDecode($this->sekretaris->CurrentValue);
			$this->sekretaris->EditValue = HtmlEncode($this->sekretaris->CurrentValue);
			$curVal = strval($this->sekretaris->CurrentValue);
			if ($curVal != "") {
				$this->sekretaris->EditValue = $this->sekretaris->lookupCacheOption($curVal);
				if ($this->sekretaris->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->sekretaris->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->sekretaris->EditValue = $this->sekretaris->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sekretaris->EditValue = HtmlEncode($this->sekretaris->CurrentValue);
					}
				}
			} else {
				$this->sekretaris->EditValue = NULL;
			}
			$this->sekretaris->PlaceHolder = RemoveHtml($this->sekretaris->caption());

			// bendahara
			$this->bendahara->EditAttrs["class"] = "form-control";
			$this->bendahara->EditCustomAttributes = "";
			if (!$this->bendahara->Raw)
				$this->bendahara->CurrentValue = HtmlDecode($this->bendahara->CurrentValue);
			$this->bendahara->EditValue = HtmlEncode($this->bendahara->CurrentValue);
			$curVal = strval($this->bendahara->CurrentValue);
			if ($curVal != "") {
				$this->bendahara->EditValue = $this->bendahara->lookupCacheOption($curVal);
				if ($this->bendahara->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->bendahara->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->bendahara->EditValue = $this->bendahara->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->bendahara->EditValue = HtmlEncode($this->bendahara->CurrentValue);
					}
				}
			} else {
				$this->bendahara->EditValue = NULL;
			}
			$this->bendahara->PlaceHolder = RemoveHtml($this->bendahara->caption());

			// anggota2
			$this->anggota2->EditAttrs["class"] = "form-control";
			$this->anggota2->EditCustomAttributes = "";
			if (!$this->anggota2->Raw)
				$this->anggota2->CurrentValue = HtmlDecode($this->anggota2->CurrentValue);
			$this->anggota2->EditValue = HtmlEncode($this->anggota2->CurrentValue);
			$curVal = strval($this->anggota2->CurrentValue);
			if ($curVal != "") {
				$this->anggota2->EditValue = $this->anggota2->lookupCacheOption($curVal);
				if ($this->anggota2->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->anggota2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->anggota2->EditValue = $this->anggota2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->anggota2->EditValue = HtmlEncode($this->anggota2->CurrentValue);
					}
				}
			} else {
				$this->anggota2->EditValue = NULL;
			}
			$this->anggota2->PlaceHolder = RemoveHtml($this->anggota2->caption());

			// widyaiswara
			$this->widyaiswara->EditAttrs["class"] = "form-control";
			$this->widyaiswara->EditCustomAttributes = "";
			$this->widyaiswara->EditValue = HtmlEncode($this->widyaiswara->CurrentValue);
			$curVal = strval($this->widyaiswara->CurrentValue);
			if ($curVal != "") {
				$this->widyaiswara->EditValue = $this->widyaiswara->lookupCacheOption($curVal);
				if ($this->widyaiswara->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->widyaiswara->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->widyaiswara->EditValue = $this->widyaiswara->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->widyaiswara->EditValue = HtmlEncode($this->widyaiswara->CurrentValue);
					}
				}
			} else {
				$this->widyaiswara->EditValue = NULL;
			}
			$this->widyaiswara->PlaceHolder = RemoveHtml($this->widyaiswara->caption());

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";
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

			// kdkota
			$this->kdkota->EditAttrs["class"] = "form-control";
			$this->kdkota->EditCustomAttributes = "";
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

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			if (!$this->tempat->Raw)
				$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
			$this->tempat->EditValue = HtmlEncode($this->tempat->CurrentValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// biaya
			$this->biaya->EditAttrs["class"] = "form-control";
			$this->biaya->EditCustomAttributes = "";
			$this->biaya->EditValue = HtmlEncode($this->biaya->CurrentValue);
			$this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
			if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue))
				$this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -2, -2, -2);
			

			// statuspel
			$this->statuspel->EditAttrs["class"] = "form-control";
			$this->statuspel->EditCustomAttributes = "";
			$this->statuspel->EditValue = $this->statuspel->options(TRUE);

			// jenisevaluasi
			$this->jenisevaluasi->EditCustomAttributes = "";
			$curVal = trim(strval($this->jenisevaluasi->CurrentValue));
			if ($curVal != "")
				$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->lookupCacheOption($curVal);
			else
				$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->Lookup !== NULL && is_array($this->jenisevaluasi->Lookup->Options) ? $curVal : NULL;
			if ($this->jenisevaluasi->ViewValue !== NULL) { // Load from cache
				$this->jenisevaluasi->EditValue = array_values($this->jenisevaluasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`id`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->jenisevaluasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jenisevaluasi->EditValue = $arwrk;
			}

			// Add refer script
			// kdjudul

			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";

			// jml_hari
			$this->jml_hari->LinkCustomAttributes = "";
			$this->jml_hari->HrefValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";

			// ketua
			$this->ketua->LinkCustomAttributes = "";
			$this->ketua->HrefValue = "";

			// sekretaris
			$this->sekretaris->LinkCustomAttributes = "";
			$this->sekretaris->HrefValue = "";

			// bendahara
			$this->bendahara->LinkCustomAttributes = "";
			$this->bendahara->HrefValue = "";

			// anggota2
			$this->anggota2->LinkCustomAttributes = "";
			$this->anggota2->HrefValue = "";

			// widyaiswara
			$this->widyaiswara->LinkCustomAttributes = "";
			$this->widyaiswara->HrefValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";

			// statuspel
			$this->statuspel->LinkCustomAttributes = "";
			$this->statuspel->HrefValue = "";

			// jenisevaluasi
			$this->jenisevaluasi->LinkCustomAttributes = "";
			$this->jenisevaluasi->HrefValue = "";
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
		if ($this->kdkursil->Required) {
			if (!$this->kdkursil->IsDetailKey && $this->kdkursil->FormValue != NULL && $this->kdkursil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkursil->caption(), $this->kdkursil->RequiredErrorMessage));
			}
		}
		if ($this->tawal->Required) {
			if (!$this->tawal->IsDetailKey && $this->tawal->FormValue != NULL && $this->tawal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tawal->caption(), $this->tawal->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tawal->FormValue)) {
			AddMessage($FormError, $this->tawal->errorMessage());
		}
		if ($this->takhir->Required) {
			if (!$this->takhir->IsDetailKey && $this->takhir->FormValue != NULL && $this->takhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->takhir->caption(), $this->takhir->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->takhir->FormValue)) {
			AddMessage($FormError, $this->takhir->errorMessage());
		}
		if ($this->jml_hari->Required) {
			if (!$this->jml_hari->IsDetailKey && $this->jml_hari->FormValue != NULL && $this->jml_hari->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_hari->caption(), $this->jml_hari->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jml_hari->FormValue)) {
			AddMessage($FormError, $this->jml_hari->errorMessage());
		}
		if ($this->targetpes->Required) {
			if (!$this->targetpes->IsDetailKey && $this->targetpes->FormValue != NULL && $this->targetpes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes->caption(), $this->targetpes->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes->FormValue)) {
			AddMessage($FormError, $this->targetpes->errorMessage());
		}
		if ($this->ketua->Required) {
			if (!$this->ketua->IsDetailKey && $this->ketua->FormValue != NULL && $this->ketua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ketua->caption(), $this->ketua->RequiredErrorMessage));
			}
		}
		if ($this->sekretaris->Required) {
			if (!$this->sekretaris->IsDetailKey && $this->sekretaris->FormValue != NULL && $this->sekretaris->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sekretaris->caption(), $this->sekretaris->RequiredErrorMessage));
			}
		}
		if ($this->bendahara->Required) {
			if (!$this->bendahara->IsDetailKey && $this->bendahara->FormValue != NULL && $this->bendahara->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bendahara->caption(), $this->bendahara->RequiredErrorMessage));
			}
		}
		if ($this->anggota2->Required) {
			if (!$this->anggota2->IsDetailKey && $this->anggota2->FormValue != NULL && $this->anggota2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->anggota2->caption(), $this->anggota2->RequiredErrorMessage));
			}
		}
		if ($this->widyaiswara->Required) {
			if (!$this->widyaiswara->IsDetailKey && $this->widyaiswara->FormValue != NULL && $this->widyaiswara->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->widyaiswara->caption(), $this->widyaiswara->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->widyaiswara->FormValue)) {
			AddMessage($FormError, $this->widyaiswara->errorMessage());
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
		if ($this->tempat->Required) {
			if (!$this->tempat->IsDetailKey && $this->tempat->FormValue != NULL && $this->tempat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tempat->caption(), $this->tempat->RequiredErrorMessage));
			}
		}
		if ($this->biaya->Required) {
			if (!$this->biaya->IsDetailKey && $this->biaya->FormValue != NULL && $this->biaya->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->biaya->caption(), $this->biaya->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->biaya->FormValue)) {
			AddMessage($FormError, $this->biaya->errorMessage());
		}
		if ($this->statuspel->Required) {
			if (!$this->statuspel->IsDetailKey && $this->statuspel->FormValue != NULL && $this->statuspel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->statuspel->caption(), $this->statuspel->RequiredErrorMessage));
			}
		}
		if ($this->jenisevaluasi->Required) {
			if ($this->jenisevaluasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenisevaluasi->caption(), $this->jenisevaluasi->RequiredErrorMessage));
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

		// Check referential integrity for master table 'diklatkerjasama'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_rpkerjasama();
		if ($this->rid->getSessionValue() != "") {
			$masterFilter = str_replace("@rpkid@", AdjustSql($this->rid->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->jenispel->getSessionValue() != "") {
			$masterFilter = str_replace("@jenispel@", AdjustSql($this->jenispel->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_rpkerjasama"]))
				$GLOBALS["t_rpkerjasama"] = new t_rpkerjasama();
			$rsmaster = $GLOBALS["t_rpkerjasama"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_rpkerjasama", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// kdjudul
		$this->kdjudul->setDbValueDef($rsnew, $this->kdjudul->CurrentValue, NULL, FALSE);

		// kdkursil
		$this->kdkursil->setDbValueDef($rsnew, $this->kdkursil->CurrentValue, NULL, FALSE);

		// tawal
		$this->tawal->setDbValueDef($rsnew, UnFormatDateTime($this->tawal->CurrentValue, 0), NULL, FALSE);

		// takhir
		$this->takhir->setDbValueDef($rsnew, UnFormatDateTime($this->takhir->CurrentValue, 0), NULL, FALSE);

		// jml_hari
		$this->jml_hari->setDbValueDef($rsnew, $this->jml_hari->CurrentValue, NULL, FALSE);

		// targetpes
		$this->targetpes->setDbValueDef($rsnew, $this->targetpes->CurrentValue, NULL, FALSE);

		// ketua
		$this->ketua->setDbValueDef($rsnew, $this->ketua->CurrentValue, NULL, FALSE);

		// sekretaris
		$this->sekretaris->setDbValueDef($rsnew, $this->sekretaris->CurrentValue, NULL, FALSE);

		// bendahara
		$this->bendahara->setDbValueDef($rsnew, $this->bendahara->CurrentValue, NULL, FALSE);

		// anggota2
		$this->anggota2->setDbValueDef($rsnew, $this->anggota2->CurrentValue, NULL, FALSE);

		// widyaiswara
		$this->widyaiswara->setDbValueDef($rsnew, $this->widyaiswara->CurrentValue, NULL, FALSE);

		// kdprop
		$this->kdprop->setDbValueDef($rsnew, $this->kdprop->CurrentValue, NULL, FALSE);

		// kdkota
		$this->kdkota->setDbValueDef($rsnew, $this->kdkota->CurrentValue, NULL, FALSE);

		// tempat
		$this->tempat->setDbValueDef($rsnew, $this->tempat->CurrentValue, NULL, FALSE);

		// biaya
		$this->biaya->setDbValueDef($rsnew, $this->biaya->CurrentValue, NULL, FALSE);

		// statuspel
		$this->statuspel->setDbValueDef($rsnew, $this->statuspel->CurrentValue, NULL, FALSE);

		// jenisevaluasi
		$this->jenisevaluasi->setDbValueDef($rsnew, $this->jenisevaluasi->CurrentValue, "", FALSE);

		// rid
		if ($this->rid->getSessionValue() != "") {
			$rsnew['rid'] = $this->rid->getSessionValue();
		}

		// jenispel
		if ($this->jenispel->getSessionValue() != "") {
			$rsnew['jenispel'] = $this->jenispel->getSessionValue();
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
			if ($masterTblVar == "t_rpkerjasama") {
				$validMaster = TRUE;
				if (($parm = Get("fk_rpkid", Get("rid"))) !== NULL) {
					$GLOBALS["t_rpkerjasama"]->rpkid->setQueryStringValue($parm);
					$this->rid->setQueryStringValue($GLOBALS["t_rpkerjasama"]->rpkid->QueryStringValue);
					$this->rid->setSessionValue($this->rid->QueryStringValue);
					if (!is_numeric($GLOBALS["t_rpkerjasama"]->rpkid->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_jenispel", Get("jenispel"))) !== NULL) {
					$GLOBALS["t_rpkerjasama"]->jenispel->setQueryStringValue($parm);
					$this->jenispel->setQueryStringValue($GLOBALS["t_rpkerjasama"]->jenispel->QueryStringValue);
					$this->jenispel->setSessionValue($this->jenispel->QueryStringValue);
					if (!is_numeric($GLOBALS["t_rpkerjasama"]->jenispel->QueryStringValue))
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
			if ($masterTblVar == "t_rpkerjasama") {
				$validMaster = TRUE;
				if (($parm = Post("fk_rpkid", Post("rid"))) !== NULL) {
					$GLOBALS["t_rpkerjasama"]->rpkid->setFormValue($parm);
					$this->rid->setFormValue($GLOBALS["t_rpkerjasama"]->rpkid->FormValue);
					$this->rid->setSessionValue($this->rid->FormValue);
					if (!is_numeric($GLOBALS["t_rpkerjasama"]->rpkid->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_jenispel", Post("jenispel"))) !== NULL) {
					$GLOBALS["t_rpkerjasama"]->jenispel->setFormValue($parm);
					$this->jenispel->setFormValue($GLOBALS["t_rpkerjasama"]->jenispel->FormValue);
					$this->jenispel->setSessionValue($this->jenispel->FormValue);
					if (!is_numeric($GLOBALS["t_rpkerjasama"]->jenispel->FormValue))
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
			if ($masterTblVar != "t_rpkerjasama") {
				if ($this->rid->CurrentValue == "")
					$this->rid->setSessionValue("");
				if ($this->jenispel->CurrentValue == "")
					$this->jenispel->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("diklatkerjasamalist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Set up multi pages
	protected function setupMultiPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add(0);
		$pages->add(1);
		$pages->add(2);
		$this->MultiPages = $pages;
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
				case "x_ketua":
					break;
				case "x_sekretaris":
					break;
				case "x_bendahara":
					break;
				case "x_anggota2":
					break;
				case "x_widyaiswara":
					break;
				case "x_kdprop":
					break;
				case "x_kdkota":
					break;
				case "x_statuspel":
					break;
				case "x_jenisevaluasi":
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
						case "x_ketua":
							break;
						case "x_sekretaris":
							break;
						case "x_bendahara":
							break;
						case "x_anggota2":
							break;
						case "x_widyaiswara":
							break;
						case "x_kdprop":
							break;
						case "x_kdkota":
							break;
						case "x_jenisevaluasi":
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