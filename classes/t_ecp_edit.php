<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_ecp_edit extends t_ecp
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_ecp';

	// Page object name
	public $PageObjName = "t_ecp_edit";

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

		// Table object (t_ecp)
		if (!isset($GLOBALS["t_ecp"]) || get_class($GLOBALS["t_ecp"]) == PROJECT_NAMESPACE . "t_ecp") {
			$GLOBALS["t_ecp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_ecp"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Table object (t_pcp)
		if (!isset($GLOBALS['t_pcp']))
			$GLOBALS['t_pcp'] = new t_pcp();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_ecp');

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
		global $t_ecp;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_ecp);
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
					if ($pageName == "t_ecpview.php")
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
			$key .= @$ar['ID_ECP'];
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
			$this->ID_ECP->Visible = FALSE;
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
					$this->terminate(GetUrl("t_ecplist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID_ECP->setVisibility();
		$this->Peserta_ID->setVisibility();
		$this->Nama->setVisibility();
		$this->Perusahaan_ID->setVisibility();
		$this->Perusahaan->setVisibility();
		$this->Daerah->setVisibility();
		$this->Produk->setVisibility();
		$this->Tgl_Bln_Ekspor->setVisibility();
		$this->Tahun_Ekspor->setVisibility();
		$this->Negara_Tujuan->setVisibility();
		$this->Nilai_Ekspor_USD->setVisibility();
		$this->Nilai_Ekspor_Rupiah->setVisibility();
		$this->Keterangan->setVisibility();
		$this->Wilayah_ECP->Visible = FALSE;
		$this->Tahun_ECP->Visible = FALSE;
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
		$this->setupLookupOptions($this->Tahun_Ekspor);
		$this->setupLookupOptions($this->Negara_Tujuan);
		$this->setupLookupOptions($this->Tahun_ECP);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_ecplist.php");
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
			if (Get("ID_ECP") !== NULL) {
				$this->ID_ECP->setQueryStringValue(Get("ID_ECP"));
				$this->ID_ECP->setOldValue($this->ID_ECP->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->ID_ECP->setQueryStringValue(Key(0));
				$this->ID_ECP->setOldValue($this->ID_ECP->QueryStringValue);
			} elseif (Post("ID_ECP") !== NULL) {
				$this->ID_ECP->setFormValue(Post("ID_ECP"));
				$this->ID_ECP->setOldValue($this->ID_ECP->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->ID_ECP->setQueryStringValue(Route(2));
				$this->ID_ECP->setOldValue($this->ID_ECP->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_ID_ECP")) {
					$this->ID_ECP->setFormValue($CurrentForm->getValue("x_ID_ECP"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("ID_ECP") !== NULL) {
					$this->ID_ECP->setQueryStringValue(Get("ID_ECP"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->ID_ECP->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->ID_ECP->CurrentValue = NULL;
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
					$this->terminate("t_ecplist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_ecplist.php")
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

		// Check field name 'ID_ECP' first before field var 'x_ID_ECP'
		$val = $CurrentForm->hasValue("ID_ECP") ? $CurrentForm->getValue("ID_ECP") : $CurrentForm->getValue("x_ID_ECP");
		if (!$this->ID_ECP->IsDetailKey)
			$this->ID_ECP->setFormValue($val);

		// Check field name 'Peserta_ID' first before field var 'x_Peserta_ID'
		$val = $CurrentForm->hasValue("Peserta_ID") ? $CurrentForm->getValue("Peserta_ID") : $CurrentForm->getValue("x_Peserta_ID");
		if (!$this->Peserta_ID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Peserta_ID->Visible = FALSE; // Disable update for API request
			else
				$this->Peserta_ID->setFormValue($val);
		}

		// Check field name 'Nama' first before field var 'x_Nama'
		$val = $CurrentForm->hasValue("Nama") ? $CurrentForm->getValue("Nama") : $CurrentForm->getValue("x_Nama");
		if (!$this->Nama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Nama->Visible = FALSE; // Disable update for API request
			else
				$this->Nama->setFormValue($val);
		}

		// Check field name 'Perusahaan_ID' first before field var 'x_Perusahaan_ID'
		$val = $CurrentForm->hasValue("Perusahaan_ID") ? $CurrentForm->getValue("Perusahaan_ID") : $CurrentForm->getValue("x_Perusahaan_ID");
		if (!$this->Perusahaan_ID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Perusahaan_ID->Visible = FALSE; // Disable update for API request
			else
				$this->Perusahaan_ID->setFormValue($val);
		}

		// Check field name 'Perusahaan' first before field var 'x_Perusahaan'
		$val = $CurrentForm->hasValue("Perusahaan") ? $CurrentForm->getValue("Perusahaan") : $CurrentForm->getValue("x_Perusahaan");
		if (!$this->Perusahaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->Perusahaan->setFormValue($val);
		}

		// Check field name 'Daerah' first before field var 'x_Daerah'
		$val = $CurrentForm->hasValue("Daerah") ? $CurrentForm->getValue("Daerah") : $CurrentForm->getValue("x_Daerah");
		if (!$this->Daerah->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Daerah->Visible = FALSE; // Disable update for API request
			else
				$this->Daerah->setFormValue($val);
		}

		// Check field name 'Produk' first before field var 'x_Produk'
		$val = $CurrentForm->hasValue("Produk") ? $CurrentForm->getValue("Produk") : $CurrentForm->getValue("x_Produk");
		if (!$this->Produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Produk->Visible = FALSE; // Disable update for API request
			else
				$this->Produk->setFormValue($val);
		}

		// Check field name 'Tgl_Bln_Ekspor' first before field var 'x_Tgl_Bln_Ekspor'
		$val = $CurrentForm->hasValue("Tgl_Bln_Ekspor") ? $CurrentForm->getValue("Tgl_Bln_Ekspor") : $CurrentForm->getValue("x_Tgl_Bln_Ekspor");
		if (!$this->Tgl_Bln_Ekspor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Tgl_Bln_Ekspor->Visible = FALSE; // Disable update for API request
			else
				$this->Tgl_Bln_Ekspor->setFormValue($val);
		}

		// Check field name 'Tahun_Ekspor' first before field var 'x_Tahun_Ekspor'
		$val = $CurrentForm->hasValue("Tahun_Ekspor") ? $CurrentForm->getValue("Tahun_Ekspor") : $CurrentForm->getValue("x_Tahun_Ekspor");
		if (!$this->Tahun_Ekspor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Tahun_Ekspor->Visible = FALSE; // Disable update for API request
			else
				$this->Tahun_Ekspor->setFormValue($val);
		}

		// Check field name 'Negara_Tujuan' first before field var 'x_Negara_Tujuan'
		$val = $CurrentForm->hasValue("Negara_Tujuan") ? $CurrentForm->getValue("Negara_Tujuan") : $CurrentForm->getValue("x_Negara_Tujuan");
		if (!$this->Negara_Tujuan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Negara_Tujuan->Visible = FALSE; // Disable update for API request
			else
				$this->Negara_Tujuan->setFormValue($val);
		}

		// Check field name 'Nilai_Ekspor_USD' first before field var 'x_Nilai_Ekspor_USD'
		$val = $CurrentForm->hasValue("Nilai_Ekspor_USD") ? $CurrentForm->getValue("Nilai_Ekspor_USD") : $CurrentForm->getValue("x_Nilai_Ekspor_USD");
		if (!$this->Nilai_Ekspor_USD->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Nilai_Ekspor_USD->Visible = FALSE; // Disable update for API request
			else
				$this->Nilai_Ekspor_USD->setFormValue($val);
		}

		// Check field name 'Nilai_Ekspor_Rupiah' first before field var 'x_Nilai_Ekspor_Rupiah'
		$val = $CurrentForm->hasValue("Nilai_Ekspor_Rupiah") ? $CurrentForm->getValue("Nilai_Ekspor_Rupiah") : $CurrentForm->getValue("x_Nilai_Ekspor_Rupiah");
		if (!$this->Nilai_Ekspor_Rupiah->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Nilai_Ekspor_Rupiah->Visible = FALSE; // Disable update for API request
			else
				$this->Nilai_Ekspor_Rupiah->setFormValue($val);
		}

		// Check field name 'Keterangan' first before field var 'x_Keterangan'
		$val = $CurrentForm->hasValue("Keterangan") ? $CurrentForm->getValue("Keterangan") : $CurrentForm->getValue("x_Keterangan");
		if (!$this->Keterangan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->Keterangan->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID_ECP->CurrentValue = $this->ID_ECP->FormValue;
		$this->Peserta_ID->CurrentValue = $this->Peserta_ID->FormValue;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->Perusahaan_ID->CurrentValue = $this->Perusahaan_ID->FormValue;
		$this->Perusahaan->CurrentValue = $this->Perusahaan->FormValue;
		$this->Daerah->CurrentValue = $this->Daerah->FormValue;
		$this->Produk->CurrentValue = $this->Produk->FormValue;
		$this->Tgl_Bln_Ekspor->CurrentValue = $this->Tgl_Bln_Ekspor->FormValue;
		$this->Tahun_Ekspor->CurrentValue = $this->Tahun_Ekspor->FormValue;
		$this->Negara_Tujuan->CurrentValue = $this->Negara_Tujuan->FormValue;
		$this->Nilai_Ekspor_USD->CurrentValue = $this->Nilai_Ekspor_USD->FormValue;
		$this->Nilai_Ekspor_Rupiah->CurrentValue = $this->Nilai_Ekspor_Rupiah->FormValue;
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
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
		$this->ID_ECP->setDbValue($row['ID_ECP']);
		$this->Peserta_ID->setDbValue($row['Peserta_ID']);
		$this->Nama->setDbValue($row['Nama']);
		$this->Perusahaan_ID->setDbValue($row['Perusahaan_ID']);
		$this->Perusahaan->setDbValue($row['Perusahaan']);
		$this->Daerah->setDbValue($row['Daerah']);
		$this->Produk->setDbValue($row['Produk']);
		$this->Tgl_Bln_Ekspor->setDbValue($row['Tgl_Bln_Ekspor']);
		$this->Tahun_Ekspor->setDbValue($row['Tahun_Ekspor']);
		$this->Negara_Tujuan->setDbValue($row['Negara_Tujuan']);
		$this->Nilai_Ekspor_USD->setDbValue($row['Nilai_Ekspor_USD']);
		$this->Nilai_Ekspor_Rupiah->setDbValue($row['Nilai_Ekspor_Rupiah']);
		$this->Keterangan->setDbValue($row['Keterangan']);
		$this->Wilayah_ECP->setDbValue($row['Wilayah_ECP']);
		$this->Tahun_ECP->setDbValue($row['Tahun_ECP']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID_ECP'] = NULL;
		$row['Peserta_ID'] = NULL;
		$row['Nama'] = NULL;
		$row['Perusahaan_ID'] = NULL;
		$row['Perusahaan'] = NULL;
		$row['Daerah'] = NULL;
		$row['Produk'] = NULL;
		$row['Tgl_Bln_Ekspor'] = NULL;
		$row['Tahun_Ekspor'] = NULL;
		$row['Negara_Tujuan'] = NULL;
		$row['Nilai_Ekspor_USD'] = NULL;
		$row['Nilai_Ekspor_Rupiah'] = NULL;
		$row['Keterangan'] = NULL;
		$row['Wilayah_ECP'] = NULL;
		$row['Tahun_ECP'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_ECP")) != "")
			$this->ID_ECP->OldValue = $this->getKey("ID_ECP"); // ID_ECP
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

		if ($this->Nilai_Ekspor_USD->FormValue == $this->Nilai_Ekspor_USD->CurrentValue && is_numeric(ConvertToFloatString($this->Nilai_Ekspor_USD->CurrentValue)))
			$this->Nilai_Ekspor_USD->CurrentValue = ConvertToFloatString($this->Nilai_Ekspor_USD->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Nilai_Ekspor_Rupiah->FormValue == $this->Nilai_Ekspor_Rupiah->CurrentValue && is_numeric(ConvertToFloatString($this->Nilai_Ekspor_Rupiah->CurrentValue)))
			$this->Nilai_Ekspor_Rupiah->CurrentValue = ConvertToFloatString($this->Nilai_Ekspor_Rupiah->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_ECP
		// Peserta_ID
		// Nama
		// Perusahaan_ID
		// Perusahaan
		// Daerah
		// Produk
		// Tgl_Bln_Ekspor
		// Tahun_Ekspor
		// Negara_Tujuan
		// Nilai_Ekspor_USD
		// Nilai_Ekspor_Rupiah
		// Keterangan
		// Wilayah_ECP
		// Tahun_ECP

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_ECP
			$this->ID_ECP->ViewValue = $this->ID_ECP->CurrentValue;
			$this->ID_ECP->ViewCustomAttributes = "";

			// Peserta_ID
			$this->Peserta_ID->ViewValue = $this->Peserta_ID->CurrentValue;
			$this->Peserta_ID->ViewValue = FormatNumber($this->Peserta_ID->ViewValue, 0, -2, -2, -2);
			$this->Peserta_ID->ViewCustomAttributes = "";

			// Nama
			$this->Nama->ViewValue = $this->Nama->CurrentValue;
			$this->Nama->ViewCustomAttributes = "";

			// Perusahaan_ID
			$this->Perusahaan_ID->ViewValue = $this->Perusahaan_ID->CurrentValue;
			$this->Perusahaan_ID->ViewValue = FormatNumber($this->Perusahaan_ID->ViewValue, 0, -2, -2, -2);
			$this->Perusahaan_ID->ViewCustomAttributes = "";

			// Perusahaan
			$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
			$this->Perusahaan->ViewCustomAttributes = "";

			// Daerah
			$this->Daerah->ViewValue = $this->Daerah->CurrentValue;
			$this->Daerah->ViewCustomAttributes = "";

			// Produk
			$this->Produk->ViewValue = $this->Produk->CurrentValue;
			$this->Produk->ViewCustomAttributes = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->ViewValue = $this->Tgl_Bln_Ekspor->CurrentValue;
			$this->Tgl_Bln_Ekspor->ViewCustomAttributes = "";

			// Tahun_Ekspor
			$curVal = strval($this->Tahun_Ekspor->CurrentValue);
			if ($curVal != "") {
				$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->lookupCacheOption($curVal);
				if ($this->Tahun_Ekspor->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->Tahun_Ekspor->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->CurrentValue;
					}
				}
			} else {
				$this->Tahun_Ekspor->ViewValue = NULL;
			}
			$this->Tahun_Ekspor->ViewCustomAttributes = "";

			// Negara_Tujuan
			$curVal = strval($this->Negara_Tujuan->CurrentValue);
			if ($curVal != "") {
				$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->lookupCacheOption($curVal);
				if ($this->Negara_Tujuan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`negara`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Negara_Tujuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->CurrentValue;
					}
				}
			} else {
				$this->Negara_Tujuan->ViewValue = NULL;
			}
			$this->Negara_Tujuan->ViewCustomAttributes = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->ViewValue = $this->Nilai_Ekspor_USD->CurrentValue;
			$this->Nilai_Ekspor_USD->ViewValue = FormatNumber($this->Nilai_Ekspor_USD->ViewValue, 2, -2, -2, -2);
			$this->Nilai_Ekspor_USD->ViewCustomAttributes = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->ViewValue = $this->Nilai_Ekspor_Rupiah->CurrentValue;
			$this->Nilai_Ekspor_Rupiah->ViewValue = FormatNumber($this->Nilai_Ekspor_Rupiah->ViewValue, 2, -2, -2, -2);
			$this->Nilai_Ekspor_Rupiah->ViewCustomAttributes = "";

			// Keterangan
			$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
			$this->Keterangan->ViewCustomAttributes = "";

			// Wilayah_ECP
			$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->CurrentValue;
			$this->Wilayah_ECP->ViewCustomAttributes = "";

			// Tahun_ECP
			$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
			$curVal = strval($this->Tahun_ECP->CurrentValue);
			if ($curVal != "") {
				$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->lookupCacheOption($curVal);
				if ($this->Tahun_ECP->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->Tahun_ECP->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
					}
				}
			} else {
				$this->Tahun_ECP->ViewValue = NULL;
			}
			$this->Tahun_ECP->ViewCustomAttributes = "";

			// ID_ECP
			$this->ID_ECP->LinkCustomAttributes = "";
			$this->ID_ECP->HrefValue = "";
			$this->ID_ECP->TooltipValue = "";

			// Peserta_ID
			$this->Peserta_ID->LinkCustomAttributes = "";
			$this->Peserta_ID->HrefValue = "";
			$this->Peserta_ID->TooltipValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";

			// Perusahaan_ID
			$this->Perusahaan_ID->LinkCustomAttributes = "";
			$this->Perusahaan_ID->HrefValue = "";
			$this->Perusahaan_ID->TooltipValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";
			$this->Perusahaan->TooltipValue = "";

			// Daerah
			$this->Daerah->LinkCustomAttributes = "";
			$this->Daerah->HrefValue = "";
			$this->Daerah->TooltipValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";
			$this->Produk->TooltipValue = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->LinkCustomAttributes = "";
			$this->Tgl_Bln_Ekspor->HrefValue = "";
			$this->Tgl_Bln_Ekspor->TooltipValue = "";

			// Tahun_Ekspor
			$this->Tahun_Ekspor->LinkCustomAttributes = "";
			$this->Tahun_Ekspor->HrefValue = "";
			$this->Tahun_Ekspor->TooltipValue = "";

			// Negara_Tujuan
			$this->Negara_Tujuan->LinkCustomAttributes = "";
			$this->Negara_Tujuan->HrefValue = "";
			$this->Negara_Tujuan->TooltipValue = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_USD->HrefValue = "";
			$this->Nilai_Ekspor_USD->TooltipValue = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->HrefValue = "";
			$this->Nilai_Ekspor_Rupiah->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID_ECP
			$this->ID_ECP->EditAttrs["class"] = "form-control";
			$this->ID_ECP->EditCustomAttributes = "";
			$this->ID_ECP->EditValue = $this->ID_ECP->CurrentValue;
			$this->ID_ECP->ViewCustomAttributes = "";

			// Peserta_ID
			$this->Peserta_ID->EditAttrs["class"] = "form-control";
			$this->Peserta_ID->EditCustomAttributes = "";
			if ($this->Peserta_ID->getSessionValue() != "") {
				$this->Peserta_ID->CurrentValue = $this->Peserta_ID->getSessionValue();
				$this->Peserta_ID->ViewValue = $this->Peserta_ID->CurrentValue;
				$this->Peserta_ID->ViewValue = FormatNumber($this->Peserta_ID->ViewValue, 0, -2, -2, -2);
				$this->Peserta_ID->ViewCustomAttributes = "";
			} else {
				$this->Peserta_ID->EditValue = HtmlEncode($this->Peserta_ID->CurrentValue);
				$this->Peserta_ID->PlaceHolder = RemoveHtml($this->Peserta_ID->caption());
			}

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			if (!$this->Nama->Raw)
				$this->Nama->CurrentValue = HtmlDecode($this->Nama->CurrentValue);
			$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
			$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

			// Perusahaan_ID
			$this->Perusahaan_ID->EditAttrs["class"] = "form-control";
			$this->Perusahaan_ID->EditCustomAttributes = "";
			$this->Perusahaan_ID->EditValue = HtmlEncode($this->Perusahaan_ID->CurrentValue);
			$this->Perusahaan_ID->PlaceHolder = RemoveHtml($this->Perusahaan_ID->caption());

			// Perusahaan
			$this->Perusahaan->EditAttrs["class"] = "form-control";
			$this->Perusahaan->EditCustomAttributes = "";
			if (!$this->Perusahaan->Raw)
				$this->Perusahaan->CurrentValue = HtmlDecode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->PlaceHolder = RemoveHtml($this->Perusahaan->caption());

			// Daerah
			$this->Daerah->EditAttrs["class"] = "form-control";
			$this->Daerah->EditCustomAttributes = "";
			if (!$this->Daerah->Raw)
				$this->Daerah->CurrentValue = HtmlDecode($this->Daerah->CurrentValue);
			$this->Daerah->EditValue = HtmlEncode($this->Daerah->CurrentValue);
			$this->Daerah->PlaceHolder = RemoveHtml($this->Daerah->caption());

			// Produk
			$this->Produk->EditAttrs["class"] = "form-control";
			$this->Produk->EditCustomAttributes = "";
			if (!$this->Produk->Raw)
				$this->Produk->CurrentValue = HtmlDecode($this->Produk->CurrentValue);
			$this->Produk->EditValue = HtmlEncode($this->Produk->CurrentValue);
			$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->EditAttrs["class"] = "form-control";
			$this->Tgl_Bln_Ekspor->EditCustomAttributes = "";
			if (!$this->Tgl_Bln_Ekspor->Raw)
				$this->Tgl_Bln_Ekspor->CurrentValue = HtmlDecode($this->Tgl_Bln_Ekspor->CurrentValue);
			$this->Tgl_Bln_Ekspor->EditValue = HtmlEncode($this->Tgl_Bln_Ekspor->CurrentValue);
			$this->Tgl_Bln_Ekspor->PlaceHolder = RemoveHtml($this->Tgl_Bln_Ekspor->caption());

			// Tahun_Ekspor
			$this->Tahun_Ekspor->EditAttrs["class"] = "form-control";
			$this->Tahun_Ekspor->EditCustomAttributes = "";
			$curVal = trim(strval($this->Tahun_Ekspor->CurrentValue));
			if ($curVal != "")
				$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->lookupCacheOption($curVal);
			else
				$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->Lookup !== NULL && is_array($this->Tahun_Ekspor->Lookup->Options) ? $curVal : NULL;
			if ($this->Tahun_Ekspor->ViewValue !== NULL) { // Load from cache
				$this->Tahun_Ekspor->EditValue = array_values($this->Tahun_Ekspor->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`tahun`" . SearchString("=", $this->Tahun_Ekspor->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`tahun` > 2010";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Tahun_Ekspor->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Tahun_Ekspor->EditValue = $arwrk;
			}

			// Negara_Tujuan
			$this->Negara_Tujuan->EditAttrs["class"] = "form-control";
			$this->Negara_Tujuan->EditCustomAttributes = "";
			$curVal = trim(strval($this->Negara_Tujuan->CurrentValue));
			if ($curVal != "")
				$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->lookupCacheOption($curVal);
			else
				$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->Lookup !== NULL && is_array($this->Negara_Tujuan->Lookup->Options) ? $curVal : NULL;
			if ($this->Negara_Tujuan->ViewValue !== NULL) { // Load from cache
				$this->Negara_Tujuan->EditValue = array_values($this->Negara_Tujuan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`negara`" . SearchString("=", $this->Negara_Tujuan->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Negara_Tujuan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Negara_Tujuan->EditValue = $arwrk;
			}

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->EditAttrs["class"] = "form-control";
			$this->Nilai_Ekspor_USD->EditCustomAttributes = "";
			$this->Nilai_Ekspor_USD->EditValue = HtmlEncode($this->Nilai_Ekspor_USD->CurrentValue);
			$this->Nilai_Ekspor_USD->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_USD->caption());
			if (strval($this->Nilai_Ekspor_USD->EditValue) != "" && is_numeric($this->Nilai_Ekspor_USD->EditValue))
				$this->Nilai_Ekspor_USD->EditValue = FormatNumber($this->Nilai_Ekspor_USD->EditValue, -2, -2, -2, -2);
			

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->EditAttrs["class"] = "form-control";
			$this->Nilai_Ekspor_Rupiah->EditCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->EditValue = HtmlEncode($this->Nilai_Ekspor_Rupiah->CurrentValue);
			$this->Nilai_Ekspor_Rupiah->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_Rupiah->caption());
			if (strval($this->Nilai_Ekspor_Rupiah->EditValue) != "" && is_numeric($this->Nilai_Ekspor_Rupiah->EditValue))
				$this->Nilai_Ekspor_Rupiah->EditValue = FormatNumber($this->Nilai_Ekspor_Rupiah->EditValue, -2, -2, -2, -2);
			

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			if (!$this->Keterangan->Raw)
				$this->Keterangan->CurrentValue = HtmlDecode($this->Keterangan->CurrentValue);
			$this->Keterangan->EditValue = HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = RemoveHtml($this->Keterangan->caption());

			// Edit refer script
			// ID_ECP

			$this->ID_ECP->LinkCustomAttributes = "";
			$this->ID_ECP->HrefValue = "";

			// Peserta_ID
			$this->Peserta_ID->LinkCustomAttributes = "";
			$this->Peserta_ID->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// Perusahaan_ID
			$this->Perusahaan_ID->LinkCustomAttributes = "";
			$this->Perusahaan_ID->HrefValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";

			// Daerah
			$this->Daerah->LinkCustomAttributes = "";
			$this->Daerah->HrefValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->LinkCustomAttributes = "";
			$this->Tgl_Bln_Ekspor->HrefValue = "";

			// Tahun_Ekspor
			$this->Tahun_Ekspor->LinkCustomAttributes = "";
			$this->Tahun_Ekspor->HrefValue = "";

			// Negara_Tujuan
			$this->Negara_Tujuan->LinkCustomAttributes = "";
			$this->Negara_Tujuan->HrefValue = "";

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_USD->HrefValue = "";

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->LinkCustomAttributes = "";
			$this->Nilai_Ekspor_Rupiah->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
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
		if ($this->ID_ECP->Required) {
			if (!$this->ID_ECP->IsDetailKey && $this->ID_ECP->FormValue != NULL && $this->ID_ECP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_ECP->caption(), $this->ID_ECP->RequiredErrorMessage));
			}
		}
		if ($this->Peserta_ID->Required) {
			if (!$this->Peserta_ID->IsDetailKey && $this->Peserta_ID->FormValue != NULL && $this->Peserta_ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Peserta_ID->caption(), $this->Peserta_ID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Peserta_ID->FormValue)) {
			AddMessage($FormError, $this->Peserta_ID->errorMessage());
		}
		if ($this->Nama->Required) {
			if (!$this->Nama->IsDetailKey && $this->Nama->FormValue != NULL && $this->Nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nama->caption(), $this->Nama->RequiredErrorMessage));
			}
		}
		if ($this->Perusahaan_ID->Required) {
			if (!$this->Perusahaan_ID->IsDetailKey && $this->Perusahaan_ID->FormValue != NULL && $this->Perusahaan_ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Perusahaan_ID->caption(), $this->Perusahaan_ID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Perusahaan_ID->FormValue)) {
			AddMessage($FormError, $this->Perusahaan_ID->errorMessage());
		}
		if ($this->Perusahaan->Required) {
			if (!$this->Perusahaan->IsDetailKey && $this->Perusahaan->FormValue != NULL && $this->Perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Perusahaan->caption(), $this->Perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->Daerah->Required) {
			if (!$this->Daerah->IsDetailKey && $this->Daerah->FormValue != NULL && $this->Daerah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Daerah->caption(), $this->Daerah->RequiredErrorMessage));
			}
		}
		if ($this->Produk->Required) {
			if (!$this->Produk->IsDetailKey && $this->Produk->FormValue != NULL && $this->Produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Produk->caption(), $this->Produk->RequiredErrorMessage));
			}
		}
		if ($this->Tgl_Bln_Ekspor->Required) {
			if (!$this->Tgl_Bln_Ekspor->IsDetailKey && $this->Tgl_Bln_Ekspor->FormValue != NULL && $this->Tgl_Bln_Ekspor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tgl_Bln_Ekspor->caption(), $this->Tgl_Bln_Ekspor->RequiredErrorMessage));
			}
		}
		if ($this->Tahun_Ekspor->Required) {
			if (!$this->Tahun_Ekspor->IsDetailKey && $this->Tahun_Ekspor->FormValue != NULL && $this->Tahun_Ekspor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tahun_Ekspor->caption(), $this->Tahun_Ekspor->RequiredErrorMessage));
			}
		}
		if ($this->Negara_Tujuan->Required) {
			if (!$this->Negara_Tujuan->IsDetailKey && $this->Negara_Tujuan->FormValue != NULL && $this->Negara_Tujuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Negara_Tujuan->caption(), $this->Negara_Tujuan->RequiredErrorMessage));
			}
		}
		if ($this->Nilai_Ekspor_USD->Required) {
			if (!$this->Nilai_Ekspor_USD->IsDetailKey && $this->Nilai_Ekspor_USD->FormValue != NULL && $this->Nilai_Ekspor_USD->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nilai_Ekspor_USD->caption(), $this->Nilai_Ekspor_USD->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Nilai_Ekspor_USD->FormValue)) {
			AddMessage($FormError, $this->Nilai_Ekspor_USD->errorMessage());
		}
		if ($this->Nilai_Ekspor_Rupiah->Required) {
			if (!$this->Nilai_Ekspor_Rupiah->IsDetailKey && $this->Nilai_Ekspor_Rupiah->FormValue != NULL && $this->Nilai_Ekspor_Rupiah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nilai_Ekspor_Rupiah->caption(), $this->Nilai_Ekspor_Rupiah->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Nilai_Ekspor_Rupiah->FormValue)) {
			AddMessage($FormError, $this->Nilai_Ekspor_Rupiah->errorMessage());
		}
		if ($this->Keterangan->Required) {
			if (!$this->Keterangan->IsDetailKey && $this->Keterangan->FormValue != NULL && $this->Keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Keterangan->caption(), $this->Keterangan->RequiredErrorMessage));
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

			// Peserta_ID
			$this->Peserta_ID->setDbValueDef($rsnew, $this->Peserta_ID->CurrentValue, 0, $this->Peserta_ID->ReadOnly);

			// Nama
			$this->Nama->setDbValueDef($rsnew, $this->Nama->CurrentValue, "", $this->Nama->ReadOnly);

			// Perusahaan_ID
			$this->Perusahaan_ID->setDbValueDef($rsnew, $this->Perusahaan_ID->CurrentValue, 0, $this->Perusahaan_ID->ReadOnly);

			// Perusahaan
			$this->Perusahaan->setDbValueDef($rsnew, $this->Perusahaan->CurrentValue, "", $this->Perusahaan->ReadOnly);

			// Daerah
			$this->Daerah->setDbValueDef($rsnew, $this->Daerah->CurrentValue, "", $this->Daerah->ReadOnly);

			// Produk
			$this->Produk->setDbValueDef($rsnew, $this->Produk->CurrentValue, "", $this->Produk->ReadOnly);

			// Tgl_Bln_Ekspor
			$this->Tgl_Bln_Ekspor->setDbValueDef($rsnew, $this->Tgl_Bln_Ekspor->CurrentValue, "", $this->Tgl_Bln_Ekspor->ReadOnly);

			// Tahun_Ekspor
			$this->Tahun_Ekspor->setDbValueDef($rsnew, $this->Tahun_Ekspor->CurrentValue, 0, $this->Tahun_Ekspor->ReadOnly);

			// Negara_Tujuan
			$this->Negara_Tujuan->setDbValueDef($rsnew, $this->Negara_Tujuan->CurrentValue, "", $this->Negara_Tujuan->ReadOnly);

			// Nilai_Ekspor_USD
			$this->Nilai_Ekspor_USD->setDbValueDef($rsnew, $this->Nilai_Ekspor_USD->CurrentValue, 0, $this->Nilai_Ekspor_USD->ReadOnly);

			// Nilai_Ekspor_Rupiah
			$this->Nilai_Ekspor_Rupiah->setDbValueDef($rsnew, $this->Nilai_Ekspor_Rupiah->CurrentValue, 0, $this->Nilai_Ekspor_Rupiah->ReadOnly);

			// Keterangan
			$this->Keterangan->setDbValueDef($rsnew, $this->Keterangan->CurrentValue, "", $this->Keterangan->ReadOnly);

			// Check referential integrity for master table 't_pcp'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_pcp();
			$keyValue = isset($rsnew['Peserta_ID']) ? $rsnew['Peserta_ID'] : $rsold['Peserta_ID'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_pcp"]))
					$GLOBALS["t_pcp"] = new t_pcp();
				$rsmaster = $GLOBALS["t_pcp"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_pcp", $Language->phrase("RelatedRecordRequired"));
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
			if ($masterTblVar == "t_pcp") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("Peserta_ID"))) !== NULL) {
					$GLOBALS["t_pcp"]->id->setQueryStringValue($parm);
					$this->Peserta_ID->setQueryStringValue($GLOBALS["t_pcp"]->id->QueryStringValue);
					$this->Peserta_ID->setSessionValue($this->Peserta_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["t_pcp"]->id->QueryStringValue))
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
			if ($masterTblVar == "t_pcp") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("Peserta_ID"))) !== NULL) {
					$GLOBALS["t_pcp"]->id->setFormValue($parm);
					$this->Peserta_ID->setFormValue($GLOBALS["t_pcp"]->id->FormValue);
					$this->Peserta_ID->setSessionValue($this->Peserta_ID->FormValue);
					if (!is_numeric($GLOBALS["t_pcp"]->id->FormValue))
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
			if ($masterTblVar != "t_pcp") {
				if ($this->Peserta_ID->CurrentValue == "")
					$this->Peserta_ID->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_ecplist.php"), "", $this->TableVar, TRUE);
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
				case "x_Tahun_Ekspor":
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_Negara_Tujuan":
					break;
				case "x_Tahun_ECP":
					$lookupFilter = function() {
						return "`tahun` > 2010";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
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
						case "x_Tahun_Ekspor":
							break;
						case "x_Negara_Tujuan":
							break;
						case "x_Tahun_ECP":
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