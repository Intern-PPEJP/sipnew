<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_perusahaan_edit extends t_perusahaan
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_perusahaan';

	// Page object name
	public $PageObjName = "t_perusahaan_edit";

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

		// Table object (t_perusahaan)
		if (!isset($GLOBALS["t_perusahaan"]) || get_class($GLOBALS["t_perusahaan"]) == PROJECT_NAMESPACE . "t_perusahaan") {
			$GLOBALS["t_perusahaan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_perusahaan"];
		}

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_perusahaan');

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
		global $t_perusahaan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_perusahaan);
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
					if ($pageName == "t_perusahaanview.php")
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
			$key .= @$ar['idp'];
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
			$this->idp->Visible = FALSE;
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
					$this->terminate(GetUrl("t_perusahaanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->namap->setVisibility();
		$this->idp->Visible = FALSE;
		$this->kontak->setVisibility();
		$this->kdlokasi->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->alamatp->setVisibility();
		$this->kdpos->setVisibility();
		$this->telpp->setVisibility();
		$this->faxp->setVisibility();
		$this->emailp->setVisibility();
		$this->webp->setVisibility();
		$this->medsos->setVisibility();
		$this->kdjenis->setVisibility();
		$this->kdproduknafed->setVisibility();
		$this->kdproduknafed2->setVisibility();
		$this->kdproduknafed3->setVisibility();
		$this->pproduk->setVisibility();
		$this->kdexport->setVisibility();
		$this->nexport->setVisibility();
		$this->kdskala->setVisibility();
		$this->kdkategori->setVisibility();
		$this->omzet_saat_ini->setVisibility();
		$this->omzet_stl_6bln->Visible = FALSE;
		$this->omzet_stl_1thn->Visible = FALSE;
		$this->omzet_stl_2thn->Visible = FALSE;
		$this->kapasitas_saat_ini->setVisibility();
		$this->kapasitas_stl_6bln->Visible = FALSE;
		$this->kapasitas_stl_1thn->setVisibility();
		$this->kapasitas_stl_2thn->setVisibility();
		$this->created_at->Visible = FALSE;
		$this->user_created_by->Visible = FALSE;
		$this->updated_at->setVisibility();
		$this->user_updated_by->setVisibility();
		$this->jpeserta->Visible = FALSE;
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
		$this->setupLookupOptions($this->idp);
		$this->setupLookupOptions($this->kdlokasi);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);
		$this->setupLookupOptions($this->kdkec);
		$this->setupLookupOptions($this->kdjenis);
		$this->setupLookupOptions($this->kdproduknafed);
		$this->setupLookupOptions($this->kdproduknafed2);
		$this->setupLookupOptions($this->kdproduknafed3);
		$this->setupLookupOptions($this->kdexport);
		$this->setupLookupOptions($this->kdskala);
		$this->setupLookupOptions($this->kdkategori);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_perusahaanlist.php");
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
			if (Get("idp") !== NULL) {
				$this->idp->setQueryStringValue(Get("idp"));
				$this->idp->setOldValue($this->idp->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->idp->setQueryStringValue(Key(0));
				$this->idp->setOldValue($this->idp->QueryStringValue);
			} elseif (Post("idp") !== NULL) {
				$this->idp->setFormValue(Post("idp"));
				$this->idp->setOldValue($this->idp->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->idp->setQueryStringValue(Route(2));
				$this->idp->setOldValue($this->idp->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_idp")) {
					$this->idp->setFormValue($CurrentForm->getValue("x_idp"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("idp") !== NULL) {
					$this->idp->setQueryStringValue(Get("idp"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->idp->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->idp->CurrentValue = NULL;
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
					$this->terminate("t_perusahaanlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_perusahaanlist.php")
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

		// Check field name 'namap' first before field var 'x_namap'
		$val = $CurrentForm->hasValue("namap") ? $CurrentForm->getValue("namap") : $CurrentForm->getValue("x_namap");
		if (!$this->namap->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->namap->Visible = FALSE; // Disable update for API request
			else
				$this->namap->setFormValue($val);
		}

		// Check field name 'kontak' first before field var 'x_kontak'
		$val = $CurrentForm->hasValue("kontak") ? $CurrentForm->getValue("kontak") : $CurrentForm->getValue("x_kontak");
		if (!$this->kontak->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kontak->Visible = FALSE; // Disable update for API request
			else
				$this->kontak->setFormValue($val);
		}

		// Check field name 'kdlokasi' first before field var 'x_kdlokasi'
		$val = $CurrentForm->hasValue("kdlokasi") ? $CurrentForm->getValue("kdlokasi") : $CurrentForm->getValue("x_kdlokasi");
		if (!$this->kdlokasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdlokasi->Visible = FALSE; // Disable update for API request
			else
				$this->kdlokasi->setFormValue($val);
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

		// Check field name 'alamatp' first before field var 'x_alamatp'
		$val = $CurrentForm->hasValue("alamatp") ? $CurrentForm->getValue("alamatp") : $CurrentForm->getValue("x_alamatp");
		if (!$this->alamatp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alamatp->Visible = FALSE; // Disable update for API request
			else
				$this->alamatp->setFormValue($val);
		}

		// Check field name 'kdpos' first before field var 'x_kdpos'
		$val = $CurrentForm->hasValue("kdpos") ? $CurrentForm->getValue("kdpos") : $CurrentForm->getValue("x_kdpos");
		if (!$this->kdpos->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdpos->Visible = FALSE; // Disable update for API request
			else
				$this->kdpos->setFormValue($val);
		}

		// Check field name 'telpp' first before field var 'x_telpp'
		$val = $CurrentForm->hasValue("telpp") ? $CurrentForm->getValue("telpp") : $CurrentForm->getValue("x_telpp");
		if (!$this->telpp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->telpp->Visible = FALSE; // Disable update for API request
			else
				$this->telpp->setFormValue($val);
		}

		// Check field name 'faxp' first before field var 'x_faxp'
		$val = $CurrentForm->hasValue("faxp") ? $CurrentForm->getValue("faxp") : $CurrentForm->getValue("x_faxp");
		if (!$this->faxp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->faxp->Visible = FALSE; // Disable update for API request
			else
				$this->faxp->setFormValue($val);
		}

		// Check field name 'emailp' first before field var 'x_emailp'
		$val = $CurrentForm->hasValue("emailp") ? $CurrentForm->getValue("emailp") : $CurrentForm->getValue("x_emailp");
		if (!$this->emailp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->emailp->Visible = FALSE; // Disable update for API request
			else
				$this->emailp->setFormValue($val);
		}

		// Check field name 'webp' first before field var 'x_webp'
		$val = $CurrentForm->hasValue("webp") ? $CurrentForm->getValue("webp") : $CurrentForm->getValue("x_webp");
		if (!$this->webp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->webp->Visible = FALSE; // Disable update for API request
			else
				$this->webp->setFormValue($val);
		}

		// Check field name 'medsos' first before field var 'x_medsos'
		$val = $CurrentForm->hasValue("medsos") ? $CurrentForm->getValue("medsos") : $CurrentForm->getValue("x_medsos");
		if (!$this->medsos->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->medsos->Visible = FALSE; // Disable update for API request
			else
				$this->medsos->setFormValue($val);
		}

		// Check field name 'kdjenis' first before field var 'x_kdjenis'
		$val = $CurrentForm->hasValue("kdjenis") ? $CurrentForm->getValue("kdjenis") : $CurrentForm->getValue("x_kdjenis");
		if (!$this->kdjenis->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdjenis->Visible = FALSE; // Disable update for API request
			else
				$this->kdjenis->setFormValue($val);
		}

		// Check field name 'kdproduknafed' first before field var 'x_kdproduknafed'
		$val = $CurrentForm->hasValue("kdproduknafed") ? $CurrentForm->getValue("kdproduknafed") : $CurrentForm->getValue("x_kdproduknafed");
		if (!$this->kdproduknafed->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdproduknafed->Visible = FALSE; // Disable update for API request
			else
				$this->kdproduknafed->setFormValue($val);
		}

		// Check field name 'kdproduknafed2' first before field var 'x_kdproduknafed2'
		$val = $CurrentForm->hasValue("kdproduknafed2") ? $CurrentForm->getValue("kdproduknafed2") : $CurrentForm->getValue("x_kdproduknafed2");
		if (!$this->kdproduknafed2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdproduknafed2->Visible = FALSE; // Disable update for API request
			else
				$this->kdproduknafed2->setFormValue($val);
		}

		// Check field name 'kdproduknafed3' first before field var 'x_kdproduknafed3'
		$val = $CurrentForm->hasValue("kdproduknafed3") ? $CurrentForm->getValue("kdproduknafed3") : $CurrentForm->getValue("x_kdproduknafed3");
		if (!$this->kdproduknafed3->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdproduknafed3->Visible = FALSE; // Disable update for API request
			else
				$this->kdproduknafed3->setFormValue($val);
		}

		// Check field name 'pproduk' first before field var 'x_pproduk'
		$val = $CurrentForm->hasValue("pproduk") ? $CurrentForm->getValue("pproduk") : $CurrentForm->getValue("x_pproduk");
		if (!$this->pproduk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pproduk->Visible = FALSE; // Disable update for API request
			else
				$this->pproduk->setFormValue($val);
		}

		// Check field name 'kdexport' first before field var 'x_kdexport'
		$val = $CurrentForm->hasValue("kdexport") ? $CurrentForm->getValue("kdexport") : $CurrentForm->getValue("x_kdexport");
		if (!$this->kdexport->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdexport->Visible = FALSE; // Disable update for API request
			else
				$this->kdexport->setFormValue($val);
		}

		// Check field name 'nexport' first before field var 'x_nexport'
		$val = $CurrentForm->hasValue("nexport") ? $CurrentForm->getValue("nexport") : $CurrentForm->getValue("x_nexport");
		if (!$this->nexport->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nexport->Visible = FALSE; // Disable update for API request
			else
				$this->nexport->setFormValue($val);
		}

		// Check field name 'kdskala' first before field var 'x_kdskala'
		$val = $CurrentForm->hasValue("kdskala") ? $CurrentForm->getValue("kdskala") : $CurrentForm->getValue("x_kdskala");
		if (!$this->kdskala->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdskala->Visible = FALSE; // Disable update for API request
			else
				$this->kdskala->setFormValue($val);
		}

		// Check field name 'kdkategori' first before field var 'x_kdkategori'
		$val = $CurrentForm->hasValue("kdkategori") ? $CurrentForm->getValue("kdkategori") : $CurrentForm->getValue("x_kdkategori");
		if (!$this->kdkategori->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkategori->Visible = FALSE; // Disable update for API request
			else
				$this->kdkategori->setFormValue($val);
		}

		// Check field name 'omzet_saat_ini' first before field var 'x_omzet_saat_ini'
		$val = $CurrentForm->hasValue("omzet_saat_ini") ? $CurrentForm->getValue("omzet_saat_ini") : $CurrentForm->getValue("x_omzet_saat_ini");
		if (!$this->omzet_saat_ini->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->omzet_saat_ini->Visible = FALSE; // Disable update for API request
			else
				$this->omzet_saat_ini->setFormValue($val);
		}

		// Check field name 'kapasitas_saat_ini' first before field var 'x_kapasitas_saat_ini'
		$val = $CurrentForm->hasValue("kapasitas_saat_ini") ? $CurrentForm->getValue("kapasitas_saat_ini") : $CurrentForm->getValue("x_kapasitas_saat_ini");
		if (!$this->kapasitas_saat_ini->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kapasitas_saat_ini->Visible = FALSE; // Disable update for API request
			else
				$this->kapasitas_saat_ini->setFormValue($val);
		}

		// Check field name 'kapasitas_stl_1thn' first before field var 'x_kapasitas_stl_1thn'
		$val = $CurrentForm->hasValue("kapasitas_stl_1thn") ? $CurrentForm->getValue("kapasitas_stl_1thn") : $CurrentForm->getValue("x_kapasitas_stl_1thn");
		if (!$this->kapasitas_stl_1thn->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kapasitas_stl_1thn->Visible = FALSE; // Disable update for API request
			else
				$this->kapasitas_stl_1thn->setFormValue($val);
		}

		// Check field name 'kapasitas_stl_2thn' first before field var 'x_kapasitas_stl_2thn'
		$val = $CurrentForm->hasValue("kapasitas_stl_2thn") ? $CurrentForm->getValue("kapasitas_stl_2thn") : $CurrentForm->getValue("x_kapasitas_stl_2thn");
		if (!$this->kapasitas_stl_2thn->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kapasitas_stl_2thn->Visible = FALSE; // Disable update for API request
			else
				$this->kapasitas_stl_2thn->setFormValue($val);
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

		// Check field name 'user_updated_by' first before field var 'x_user_updated_by'
		$val = $CurrentForm->hasValue("user_updated_by") ? $CurrentForm->getValue("user_updated_by") : $CurrentForm->getValue("x_user_updated_by");
		if (!$this->user_updated_by->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->user_updated_by->Visible = FALSE; // Disable update for API request
			else
				$this->user_updated_by->setFormValue($val);
		}

		// Check field name 'idp' first before field var 'x_idp'
		$val = $CurrentForm->hasValue("idp") ? $CurrentForm->getValue("idp") : $CurrentForm->getValue("x_idp");
		if (!$this->idp->IsDetailKey)
			$this->idp->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->idp->CurrentValue = $this->idp->FormValue;
		$this->namap->CurrentValue = $this->namap->FormValue;
		$this->kontak->CurrentValue = $this->kontak->FormValue;
		$this->kdlokasi->CurrentValue = $this->kdlokasi->FormValue;
		$this->kdprop->CurrentValue = $this->kdprop->FormValue;
		$this->kdkota->CurrentValue = $this->kdkota->FormValue;
		$this->kdkec->CurrentValue = $this->kdkec->FormValue;
		$this->alamatp->CurrentValue = $this->alamatp->FormValue;
		$this->kdpos->CurrentValue = $this->kdpos->FormValue;
		$this->telpp->CurrentValue = $this->telpp->FormValue;
		$this->faxp->CurrentValue = $this->faxp->FormValue;
		$this->emailp->CurrentValue = $this->emailp->FormValue;
		$this->webp->CurrentValue = $this->webp->FormValue;
		$this->medsos->CurrentValue = $this->medsos->FormValue;
		$this->kdjenis->CurrentValue = $this->kdjenis->FormValue;
		$this->kdproduknafed->CurrentValue = $this->kdproduknafed->FormValue;
		$this->kdproduknafed2->CurrentValue = $this->kdproduknafed2->FormValue;
		$this->kdproduknafed3->CurrentValue = $this->kdproduknafed3->FormValue;
		$this->pproduk->CurrentValue = $this->pproduk->FormValue;
		$this->kdexport->CurrentValue = $this->kdexport->FormValue;
		$this->nexport->CurrentValue = $this->nexport->FormValue;
		$this->kdskala->CurrentValue = $this->kdskala->FormValue;
		$this->kdkategori->CurrentValue = $this->kdkategori->FormValue;
		$this->omzet_saat_ini->CurrentValue = $this->omzet_saat_ini->FormValue;
		$this->kapasitas_saat_ini->CurrentValue = $this->kapasitas_saat_ini->FormValue;
		$this->kapasitas_stl_1thn->CurrentValue = $this->kapasitas_stl_1thn->FormValue;
		$this->kapasitas_stl_2thn->CurrentValue = $this->kapasitas_stl_2thn->FormValue;
		$this->updated_at->CurrentValue = $this->updated_at->FormValue;
		$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
		$this->user_updated_by->CurrentValue = $this->user_updated_by->FormValue;
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
		$this->namap->setDbValue($row['namap']);
		$this->idp->setDbValue($row['idp']);
		$this->kontak->setDbValue($row['kontak']);
		$this->kdlokasi->setDbValue($row['kdlokasi']);
		$this->kdprop->setDbValue($row['kdprop']);
		$this->kdkota->setDbValue($row['kdkota']);
		$this->kdkec->setDbValue($row['kdkec']);
		if (array_key_exists('EV__kdkec', $rs->fields)) {
			$this->kdkec->VirtualValue = $rs->fields('EV__kdkec'); // Set up virtual field value
		} else {
			$this->kdkec->VirtualValue = ""; // Clear value
		}
		$this->alamatp->setDbValue($row['alamatp']);
		$this->kdpos->setDbValue($row['kdpos']);
		$this->telpp->setDbValue($row['telpp']);
		$this->faxp->setDbValue($row['faxp']);
		$this->emailp->setDbValue($row['emailp']);
		$this->webp->setDbValue($row['webp']);
		$this->medsos->setDbValue($row['medsos']);
		$this->kdjenis->setDbValue($row['kdjenis']);
		$this->kdproduknafed->setDbValue($row['kdproduknafed']);
		$this->kdproduknafed2->setDbValue($row['kdproduknafed2']);
		$this->kdproduknafed3->setDbValue($row['kdproduknafed3']);
		$this->pproduk->setDbValue($row['pproduk']);
		$this->kdexport->setDbValue($row['kdexport']);
		$this->nexport->setDbValue($row['nexport']);
		$this->kdskala->setDbValue($row['kdskala']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->omzet_saat_ini->setDbValue($row['omzet_saat_ini']);
		$this->omzet_stl_6bln->setDbValue($row['omzet_stl_6bln']);
		$this->omzet_stl_1thn->setDbValue($row['omzet_stl_1thn']);
		$this->omzet_stl_2thn->setDbValue($row['omzet_stl_2thn']);
		$this->kapasitas_saat_ini->setDbValue($row['kapasitas_saat_ini']);
		$this->kapasitas_stl_6bln->setDbValue($row['kapasitas_stl_6bln']);
		$this->kapasitas_stl_1thn->setDbValue($row['kapasitas_stl_1thn']);
		$this->kapasitas_stl_2thn->setDbValue($row['kapasitas_stl_2thn']);
		$this->created_at->setDbValue($row['created_at']);
		$this->user_created_by->setDbValue($row['user_created_by']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->user_updated_by->setDbValue($row['user_updated_by']);
		$this->jpeserta->setDbValue($row['jpeserta']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['namap'] = NULL;
		$row['idp'] = NULL;
		$row['kontak'] = NULL;
		$row['kdlokasi'] = NULL;
		$row['kdprop'] = NULL;
		$row['kdkota'] = NULL;
		$row['kdkec'] = NULL;
		$row['alamatp'] = NULL;
		$row['kdpos'] = NULL;
		$row['telpp'] = NULL;
		$row['faxp'] = NULL;
		$row['emailp'] = NULL;
		$row['webp'] = NULL;
		$row['medsos'] = NULL;
		$row['kdjenis'] = NULL;
		$row['kdproduknafed'] = NULL;
		$row['kdproduknafed2'] = NULL;
		$row['kdproduknafed3'] = NULL;
		$row['pproduk'] = NULL;
		$row['kdexport'] = NULL;
		$row['nexport'] = NULL;
		$row['kdskala'] = NULL;
		$row['kdkategori'] = NULL;
		$row['omzet_saat_ini'] = NULL;
		$row['omzet_stl_6bln'] = NULL;
		$row['omzet_stl_1thn'] = NULL;
		$row['omzet_stl_2thn'] = NULL;
		$row['kapasitas_saat_ini'] = NULL;
		$row['kapasitas_stl_6bln'] = NULL;
		$row['kapasitas_stl_1thn'] = NULL;
		$row['kapasitas_stl_2thn'] = NULL;
		$row['created_at'] = NULL;
		$row['user_created_by'] = NULL;
		$row['updated_at'] = NULL;
		$row['user_updated_by'] = NULL;
		$row['jpeserta'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idp")) != "")
			$this->idp->OldValue = $this->getKey("idp"); // idp
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
		// namap
		// idp
		// kontak
		// kdlokasi
		// kdprop
		// kdkota
		// kdkec
		// alamatp
		// kdpos
		// telpp
		// faxp
		// emailp
		// webp
		// medsos
		// kdjenis
		// kdproduknafed
		// kdproduknafed2
		// kdproduknafed3
		// pproduk
		// kdexport
		// nexport
		// kdskala
		// kdkategori
		// omzet_saat_ini
		// omzet_stl_6bln
		// omzet_stl_1thn
		// omzet_stl_2thn
		// kapasitas_saat_ini
		// kapasitas_stl_6bln
		// kapasitas_stl_1thn
		// kapasitas_stl_2thn
		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jpeserta

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// namap
			$this->namap->ViewValue = $this->namap->CurrentValue;
			$this->namap->ViewCustomAttributes = "";

			// kontak
			$this->kontak->ViewValue = $this->kontak->CurrentValue;
			$this->kontak->ViewCustomAttributes = "";

			// kdlokasi
			$curVal = strval($this->kdlokasi->CurrentValue);
			if ($curVal != "") {
				$this->kdlokasi->ViewValue = $this->kdlokasi->lookupCacheOption($curVal);
				if ($this->kdlokasi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdlokasi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdlokasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdlokasi->ViewValue = $this->kdlokasi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdlokasi->ViewValue = $this->kdlokasi->CurrentValue;
					}
				}
			} else {
				$this->kdlokasi->ViewValue = NULL;
			}
			$this->kdlokasi->ViewCustomAttributes = "";

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

			// alamatp
			$this->alamatp->ViewValue = $this->alamatp->CurrentValue;
			$this->alamatp->ViewCustomAttributes = "";

			// kdpos
			$this->kdpos->ViewValue = $this->kdpos->CurrentValue;
			$this->kdpos->ViewCustomAttributes = "";

			// telpp
			$this->telpp->ViewValue = $this->telpp->CurrentValue;
			$this->telpp->ViewCustomAttributes = "";

			// faxp
			$this->faxp->ViewValue = $this->faxp->CurrentValue;
			$this->faxp->ViewCustomAttributes = "";

			// emailp
			$this->emailp->ViewValue = $this->emailp->CurrentValue;
			$this->emailp->ViewCustomAttributes = "";

			// webp
			$this->webp->ViewValue = $this->webp->CurrentValue;
			$this->webp->ViewCustomAttributes = "";

			// medsos
			$this->medsos->ViewValue = $this->medsos->CurrentValue;
			$this->medsos->ViewCustomAttributes = "";

			// kdjenis
			$curVal = strval($this->kdjenis->CurrentValue);
			if ($curVal != "") {
				$this->kdjenis->ViewValue = $this->kdjenis->lookupCacheOption($curVal);
				if ($this->kdjenis->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdjenis`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdjenis->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdjenis->ViewValue = $this->kdjenis->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdjenis->ViewValue = $this->kdjenis->CurrentValue;
					}
				}
			} else {
				$this->kdjenis->ViewValue = NULL;
			}
			$this->kdjenis->ViewCustomAttributes = "";

			// kdproduknafed
			$curVal = strval($this->kdproduknafed->CurrentValue);
			if ($curVal != "") {
				$this->kdproduknafed->ViewValue = $this->kdproduknafed->lookupCacheOption($curVal);
				if ($this->kdproduknafed->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdproduknafed->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdproduknafed->ViewValue = $this->kdproduknafed->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdproduknafed->ViewValue = $this->kdproduknafed->CurrentValue;
					}
				}
			} else {
				$this->kdproduknafed->ViewValue = NULL;
			}
			$this->kdproduknafed->ViewCustomAttributes = "";

			// kdproduknafed2
			$curVal = strval($this->kdproduknafed2->CurrentValue);
			if ($curVal != "") {
				$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->lookupCacheOption($curVal);
				if ($this->kdproduknafed2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdproduknafed2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->CurrentValue;
					}
				}
			} else {
				$this->kdproduknafed2->ViewValue = NULL;
			}
			$this->kdproduknafed2->ViewCustomAttributes = "";

			// kdproduknafed3
			$curVal = strval($this->kdproduknafed3->CurrentValue);
			if ($curVal != "") {
				$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->lookupCacheOption($curVal);
				if ($this->kdproduknafed3->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdproduknafed3->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->CurrentValue;
					}
				}
			} else {
				$this->kdproduknafed3->ViewValue = NULL;
			}
			$this->kdproduknafed3->ViewCustomAttributes = "";

			// pproduk
			$this->pproduk->ViewValue = $this->pproduk->CurrentValue;
			$this->pproduk->ViewCustomAttributes = "";

			// kdexport
			$curVal = strval($this->kdexport->CurrentValue);
			if ($curVal != "") {
				$this->kdexport->ViewValue = $this->kdexport->lookupCacheOption($curVal);
				if ($this->kdexport->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdexport`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdexport->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdexport->ViewValue = $this->kdexport->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdexport->ViewValue = $this->kdexport->CurrentValue;
					}
				}
			} else {
				$this->kdexport->ViewValue = NULL;
			}
			$this->kdexport->ViewCustomAttributes = "";

			// nexport
			$this->nexport->ViewValue = $this->nexport->CurrentValue;
			$this->nexport->ViewCustomAttributes = "";

			// kdskala
			$curVal = strval($this->kdskala->CurrentValue);
			if ($curVal != "") {
				$this->kdskala->ViewValue = $this->kdskala->lookupCacheOption($curVal);
				if ($this->kdskala->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdskala`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdskala->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdskala->ViewValue = $this->kdskala->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdskala->ViewValue = $this->kdskala->CurrentValue;
					}
				}
			} else {
				$this->kdskala->ViewValue = NULL;
			}
			$this->kdskala->ViewCustomAttributes = "";

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

			// omzet_saat_ini
			$this->omzet_saat_ini->ViewValue = $this->omzet_saat_ini->CurrentValue;
			$this->omzet_saat_ini->ViewCustomAttributes = "";

			// omzet_stl_6bln
			$this->omzet_stl_6bln->ViewValue = $this->omzet_stl_6bln->CurrentValue;
			$this->omzet_stl_6bln->ViewCustomAttributes = "";

			// omzet_stl_1thn
			$this->omzet_stl_1thn->ViewValue = $this->omzet_stl_1thn->CurrentValue;
			$this->omzet_stl_1thn->ViewCustomAttributes = "";

			// omzet_stl_2thn
			$this->omzet_stl_2thn->ViewValue = $this->omzet_stl_2thn->CurrentValue;
			$this->omzet_stl_2thn->ViewCustomAttributes = "";

			// kapasitas_saat_ini
			$this->kapasitas_saat_ini->ViewValue = $this->kapasitas_saat_ini->CurrentValue;
			$this->kapasitas_saat_ini->ViewCustomAttributes = "";

			// kapasitas_stl_6bln
			$this->kapasitas_stl_6bln->ViewValue = $this->kapasitas_stl_6bln->CurrentValue;
			$this->kapasitas_stl_6bln->ViewCustomAttributes = "";

			// kapasitas_stl_1thn
			$this->kapasitas_stl_1thn->ViewValue = $this->kapasitas_stl_1thn->CurrentValue;
			$this->kapasitas_stl_1thn->ViewCustomAttributes = "";

			// kapasitas_stl_2thn
			$this->kapasitas_stl_2thn->ViewValue = $this->kapasitas_stl_2thn->CurrentValue;
			$this->kapasitas_stl_2thn->ViewCustomAttributes = "";

			// updated_at
			$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
			$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
			$this->updated_at->ViewCustomAttributes = "";

			// user_updated_by
			$this->user_updated_by->ViewValue = $this->user_updated_by->CurrentValue;
			$this->user_updated_by->ViewCustomAttributes = "";

			// jpeserta
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->ViewCustomAttributes = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";
			$this->namap->TooltipValue = "";

			// kontak
			$this->kontak->LinkCustomAttributes = "";
			$this->kontak->HrefValue = "";
			$this->kontak->TooltipValue = "";

			// kdlokasi
			$this->kdlokasi->LinkCustomAttributes = "";
			$this->kdlokasi->HrefValue = "";
			$this->kdlokasi->TooltipValue = "";

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

			// alamatp
			$this->alamatp->LinkCustomAttributes = "";
			$this->alamatp->HrefValue = "";
			$this->alamatp->TooltipValue = "";

			// kdpos
			$this->kdpos->LinkCustomAttributes = "";
			$this->kdpos->HrefValue = "";
			$this->kdpos->TooltipValue = "";

			// telpp
			$this->telpp->LinkCustomAttributes = "";
			$this->telpp->HrefValue = "";
			$this->telpp->TooltipValue = "";

			// faxp
			$this->faxp->LinkCustomAttributes = "";
			$this->faxp->HrefValue = "";
			$this->faxp->TooltipValue = "";

			// emailp
			$this->emailp->LinkCustomAttributes = "";
			$this->emailp->HrefValue = "";
			$this->emailp->TooltipValue = "";

			// webp
			$this->webp->LinkCustomAttributes = "";
			$this->webp->HrefValue = "";
			$this->webp->TooltipValue = "";

			// medsos
			$this->medsos->LinkCustomAttributes = "";
			$this->medsos->HrefValue = "";
			$this->medsos->TooltipValue = "";

			// kdjenis
			$this->kdjenis->LinkCustomAttributes = "";
			$this->kdjenis->HrefValue = "";
			$this->kdjenis->TooltipValue = "";

			// kdproduknafed
			$this->kdproduknafed->LinkCustomAttributes = "";
			$this->kdproduknafed->HrefValue = "";
			$this->kdproduknafed->TooltipValue = "";

			// kdproduknafed2
			$this->kdproduknafed2->LinkCustomAttributes = "";
			$this->kdproduknafed2->HrefValue = "";
			$this->kdproduknafed2->TooltipValue = "";

			// kdproduknafed3
			$this->kdproduknafed3->LinkCustomAttributes = "";
			$this->kdproduknafed3->HrefValue = "";
			$this->kdproduknafed3->TooltipValue = "";

			// pproduk
			$this->pproduk->LinkCustomAttributes = "";
			$this->pproduk->HrefValue = "";
			$this->pproduk->TooltipValue = "";

			// kdexport
			$this->kdexport->LinkCustomAttributes = "";
			$this->kdexport->HrefValue = "";
			$this->kdexport->TooltipValue = "";

			// nexport
			$this->nexport->LinkCustomAttributes = "";
			$this->nexport->HrefValue = "";
			$this->nexport->TooltipValue = "";

			// kdskala
			$this->kdskala->LinkCustomAttributes = "";
			$this->kdskala->HrefValue = "";
			$this->kdskala->TooltipValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";
			$this->kdkategori->TooltipValue = "";

			// omzet_saat_ini
			$this->omzet_saat_ini->LinkCustomAttributes = "";
			$this->omzet_saat_ini->HrefValue = "";
			$this->omzet_saat_ini->TooltipValue = "";

			// kapasitas_saat_ini
			$this->kapasitas_saat_ini->LinkCustomAttributes = "";
			$this->kapasitas_saat_ini->HrefValue = "";
			$this->kapasitas_saat_ini->TooltipValue = "";

			// kapasitas_stl_1thn
			$this->kapasitas_stl_1thn->LinkCustomAttributes = "";
			$this->kapasitas_stl_1thn->HrefValue = "";
			$this->kapasitas_stl_1thn->TooltipValue = "";

			// kapasitas_stl_2thn
			$this->kapasitas_stl_2thn->LinkCustomAttributes = "";
			$this->kapasitas_stl_2thn->HrefValue = "";
			$this->kapasitas_stl_2thn->TooltipValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";

			// user_updated_by
			$this->user_updated_by->LinkCustomAttributes = "";
			$this->user_updated_by->HrefValue = "";
			$this->user_updated_by->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// namap
			$this->namap->EditAttrs["class"] = "form-control";
			$this->namap->EditCustomAttributes = "";
			if (!$this->namap->Raw)
				$this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
			$this->namap->EditValue = HtmlEncode($this->namap->CurrentValue);
			$this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

			// kontak
			$this->kontak->EditAttrs["class"] = "form-control";
			$this->kontak->EditCustomAttributes = "";
			if (!$this->kontak->Raw)
				$this->kontak->CurrentValue = HtmlDecode($this->kontak->CurrentValue);
			$this->kontak->EditValue = HtmlEncode($this->kontak->CurrentValue);
			$this->kontak->PlaceHolder = RemoveHtml($this->kontak->caption());

			// kdlokasi
			$this->kdlokasi->EditAttrs["class"] = "form-control";
			$this->kdlokasi->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdlokasi->CurrentValue));
			if ($curVal != "")
				$this->kdlokasi->ViewValue = $this->kdlokasi->lookupCacheOption($curVal);
			else
				$this->kdlokasi->ViewValue = $this->kdlokasi->Lookup !== NULL && is_array($this->kdlokasi->Lookup->Options) ? $curVal : NULL;
			if ($this->kdlokasi->ViewValue !== NULL) { // Load from cache
				$this->kdlokasi->EditValue = array_values($this->kdlokasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdlokasi`" . SearchString("=", $this->kdlokasi->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdlokasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdlokasi->EditValue = $arwrk;
			}

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

			// alamatp
			$this->alamatp->EditAttrs["class"] = "form-control";
			$this->alamatp->EditCustomAttributes = "";
			$this->alamatp->EditValue = HtmlEncode($this->alamatp->CurrentValue);
			$this->alamatp->PlaceHolder = RemoveHtml($this->alamatp->caption());

			// kdpos
			$this->kdpos->EditAttrs["class"] = "form-control";
			$this->kdpos->EditCustomAttributes = "";
			if (!$this->kdpos->Raw)
				$this->kdpos->CurrentValue = HtmlDecode($this->kdpos->CurrentValue);
			$this->kdpos->EditValue = HtmlEncode($this->kdpos->CurrentValue);
			$this->kdpos->PlaceHolder = RemoveHtml($this->kdpos->caption());

			// telpp
			$this->telpp->EditAttrs["class"] = "form-control";
			$this->telpp->EditCustomAttributes = "";
			if (!$this->telpp->Raw)
				$this->telpp->CurrentValue = HtmlDecode($this->telpp->CurrentValue);
			$this->telpp->EditValue = HtmlEncode($this->telpp->CurrentValue);
			$this->telpp->PlaceHolder = RemoveHtml($this->telpp->caption());

			// faxp
			$this->faxp->EditAttrs["class"] = "form-control";
			$this->faxp->EditCustomAttributes = "";
			if (!$this->faxp->Raw)
				$this->faxp->CurrentValue = HtmlDecode($this->faxp->CurrentValue);
			$this->faxp->EditValue = HtmlEncode($this->faxp->CurrentValue);
			$this->faxp->PlaceHolder = RemoveHtml($this->faxp->caption());

			// emailp
			$this->emailp->EditAttrs["class"] = "form-control";
			$this->emailp->EditCustomAttributes = "";
			if (!$this->emailp->Raw)
				$this->emailp->CurrentValue = HtmlDecode($this->emailp->CurrentValue);
			$this->emailp->EditValue = HtmlEncode($this->emailp->CurrentValue);
			$this->emailp->PlaceHolder = RemoveHtml($this->emailp->caption());

			// webp
			$this->webp->EditAttrs["class"] = "form-control";
			$this->webp->EditCustomAttributes = "";
			if (!$this->webp->Raw)
				$this->webp->CurrentValue = HtmlDecode($this->webp->CurrentValue);
			$this->webp->EditValue = HtmlEncode($this->webp->CurrentValue);
			$this->webp->PlaceHolder = RemoveHtml($this->webp->caption());

			// medsos
			$this->medsos->EditAttrs["class"] = "form-control";
			$this->medsos->EditCustomAttributes = "";
			if (!$this->medsos->Raw)
				$this->medsos->CurrentValue = HtmlDecode($this->medsos->CurrentValue);
			$this->medsos->EditValue = HtmlEncode($this->medsos->CurrentValue);
			$this->medsos->PlaceHolder = RemoveHtml($this->medsos->caption());

			// kdjenis
			$this->kdjenis->EditAttrs["class"] = "form-control";
			$this->kdjenis->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdjenis->CurrentValue));
			if ($curVal != "")
				$this->kdjenis->ViewValue = $this->kdjenis->lookupCacheOption($curVal);
			else
				$this->kdjenis->ViewValue = $this->kdjenis->Lookup !== NULL && is_array($this->kdjenis->Lookup->Options) ? $curVal : NULL;
			if ($this->kdjenis->ViewValue !== NULL) { // Load from cache
				$this->kdjenis->EditValue = array_values($this->kdjenis->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdjenis`" . SearchString("=", $this->kdjenis->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdjenis->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdjenis->EditValue = $arwrk;
			}

			// kdproduknafed
			$this->kdproduknafed->EditAttrs["class"] = "form-control";
			$this->kdproduknafed->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdproduknafed->CurrentValue));
			if ($curVal != "")
				$this->kdproduknafed->ViewValue = $this->kdproduknafed->lookupCacheOption($curVal);
			else
				$this->kdproduknafed->ViewValue = $this->kdproduknafed->Lookup !== NULL && is_array($this->kdproduknafed->Lookup->Options) ? $curVal : NULL;
			if ($this->kdproduknafed->ViewValue !== NULL) { // Load from cache
				$this->kdproduknafed->EditValue = array_values($this->kdproduknafed->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdproduknafed`" . SearchString("=", $this->kdproduknafed->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdproduknafed->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdproduknafed->EditValue = $arwrk;
			}

			// kdproduknafed2
			$this->kdproduknafed2->EditAttrs["class"] = "form-control";
			$this->kdproduknafed2->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdproduknafed2->CurrentValue));
			if ($curVal != "")
				$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->lookupCacheOption($curVal);
			else
				$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->Lookup !== NULL && is_array($this->kdproduknafed2->Lookup->Options) ? $curVal : NULL;
			if ($this->kdproduknafed2->ViewValue !== NULL) { // Load from cache
				$this->kdproduknafed2->EditValue = array_values($this->kdproduknafed2->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdproduknafed`" . SearchString("=", $this->kdproduknafed2->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdproduknafed2->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdproduknafed2->EditValue = $arwrk;
			}

			// kdproduknafed3
			$this->kdproduknafed3->EditAttrs["class"] = "form-control";
			$this->kdproduknafed3->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdproduknafed3->CurrentValue));
			if ($curVal != "")
				$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->lookupCacheOption($curVal);
			else
				$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->Lookup !== NULL && is_array($this->kdproduknafed3->Lookup->Options) ? $curVal : NULL;
			if ($this->kdproduknafed3->ViewValue !== NULL) { // Load from cache
				$this->kdproduknafed3->EditValue = array_values($this->kdproduknafed3->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdproduknafed`" . SearchString("=", $this->kdproduknafed3->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdproduknafed3->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdproduknafed3->EditValue = $arwrk;
			}

			// pproduk
			$this->pproduk->EditAttrs["class"] = "form-control";
			$this->pproduk->EditCustomAttributes = "";
			$this->pproduk->EditValue = HtmlEncode($this->pproduk->CurrentValue);
			$this->pproduk->PlaceHolder = RemoveHtml($this->pproduk->caption());

			// kdexport
			$this->kdexport->EditAttrs["class"] = "form-control";
			$this->kdexport->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdexport->CurrentValue));
			if ($curVal != "")
				$this->kdexport->ViewValue = $this->kdexport->lookupCacheOption($curVal);
			else
				$this->kdexport->ViewValue = $this->kdexport->Lookup !== NULL && is_array($this->kdexport->Lookup->Options) ? $curVal : NULL;
			if ($this->kdexport->ViewValue !== NULL) { // Load from cache
				$this->kdexport->EditValue = array_values($this->kdexport->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdexport`" . SearchString("=", $this->kdexport->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdexport->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdexport->EditValue = $arwrk;
			}

			// nexport
			$this->nexport->EditAttrs["class"] = "form-control";
			$this->nexport->EditCustomAttributes = "";
			$this->nexport->EditValue = HtmlEncode($this->nexport->CurrentValue);
			$this->nexport->PlaceHolder = RemoveHtml($this->nexport->caption());

			// kdskala
			$this->kdskala->EditAttrs["class"] = "form-control";
			$this->kdskala->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdskala->CurrentValue));
			if ($curVal != "")
				$this->kdskala->ViewValue = $this->kdskala->lookupCacheOption($curVal);
			else
				$this->kdskala->ViewValue = $this->kdskala->Lookup !== NULL && is_array($this->kdskala->Lookup->Options) ? $curVal : NULL;
			if ($this->kdskala->ViewValue !== NULL) { // Load from cache
				$this->kdskala->EditValue = array_values($this->kdskala->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdskala`" . SearchString("=", $this->kdskala->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kdskala->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kdskala->EditValue = $arwrk;
			}

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

			// omzet_saat_ini
			$this->omzet_saat_ini->EditAttrs["class"] = "form-control";
			$this->omzet_saat_ini->EditCustomAttributes = "";
			if (!$this->omzet_saat_ini->Raw)
				$this->omzet_saat_ini->CurrentValue = HtmlDecode($this->omzet_saat_ini->CurrentValue);
			$this->omzet_saat_ini->EditValue = HtmlEncode($this->omzet_saat_ini->CurrentValue);
			$this->omzet_saat_ini->PlaceHolder = RemoveHtml($this->omzet_saat_ini->caption());

			// kapasitas_saat_ini
			$this->kapasitas_saat_ini->EditAttrs["class"] = "form-control";
			$this->kapasitas_saat_ini->EditCustomAttributes = "";
			if (!$this->kapasitas_saat_ini->Raw)
				$this->kapasitas_saat_ini->CurrentValue = HtmlDecode($this->kapasitas_saat_ini->CurrentValue);
			$this->kapasitas_saat_ini->EditValue = HtmlEncode($this->kapasitas_saat_ini->CurrentValue);
			$this->kapasitas_saat_ini->PlaceHolder = RemoveHtml($this->kapasitas_saat_ini->caption());

			// kapasitas_stl_1thn
			$this->kapasitas_stl_1thn->EditAttrs["class"] = "form-control";
			$this->kapasitas_stl_1thn->EditCustomAttributes = "";
			if (!$this->kapasitas_stl_1thn->Raw)
				$this->kapasitas_stl_1thn->CurrentValue = HtmlDecode($this->kapasitas_stl_1thn->CurrentValue);
			$this->kapasitas_stl_1thn->EditValue = HtmlEncode($this->kapasitas_stl_1thn->CurrentValue);
			$this->kapasitas_stl_1thn->PlaceHolder = RemoveHtml($this->kapasitas_stl_1thn->caption());

			// kapasitas_stl_2thn
			$this->kapasitas_stl_2thn->EditAttrs["class"] = "form-control";
			$this->kapasitas_stl_2thn->EditCustomAttributes = "";
			if (!$this->kapasitas_stl_2thn->Raw)
				$this->kapasitas_stl_2thn->CurrentValue = HtmlDecode($this->kapasitas_stl_2thn->CurrentValue);
			$this->kapasitas_stl_2thn->EditValue = HtmlEncode($this->kapasitas_stl_2thn->CurrentValue);
			$this->kapasitas_stl_2thn->PlaceHolder = RemoveHtml($this->kapasitas_stl_2thn->caption());

			// updated_at
			// user_updated_by
			// Edit refer script
			// namap

			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";

			// kontak
			$this->kontak->LinkCustomAttributes = "";
			$this->kontak->HrefValue = "";

			// kdlokasi
			$this->kdlokasi->LinkCustomAttributes = "";
			$this->kdlokasi->HrefValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";

			// kdkec
			$this->kdkec->LinkCustomAttributes = "";
			$this->kdkec->HrefValue = "";

			// alamatp
			$this->alamatp->LinkCustomAttributes = "";
			$this->alamatp->HrefValue = "";

			// kdpos
			$this->kdpos->LinkCustomAttributes = "";
			$this->kdpos->HrefValue = "";

			// telpp
			$this->telpp->LinkCustomAttributes = "";
			$this->telpp->HrefValue = "";

			// faxp
			$this->faxp->LinkCustomAttributes = "";
			$this->faxp->HrefValue = "";

			// emailp
			$this->emailp->LinkCustomAttributes = "";
			$this->emailp->HrefValue = "";

			// webp
			$this->webp->LinkCustomAttributes = "";
			$this->webp->HrefValue = "";

			// medsos
			$this->medsos->LinkCustomAttributes = "";
			$this->medsos->HrefValue = "";

			// kdjenis
			$this->kdjenis->LinkCustomAttributes = "";
			$this->kdjenis->HrefValue = "";

			// kdproduknafed
			$this->kdproduknafed->LinkCustomAttributes = "";
			$this->kdproduknafed->HrefValue = "";

			// kdproduknafed2
			$this->kdproduknafed2->LinkCustomAttributes = "";
			$this->kdproduknafed2->HrefValue = "";

			// kdproduknafed3
			$this->kdproduknafed3->LinkCustomAttributes = "";
			$this->kdproduknafed3->HrefValue = "";

			// pproduk
			$this->pproduk->LinkCustomAttributes = "";
			$this->pproduk->HrefValue = "";

			// kdexport
			$this->kdexport->LinkCustomAttributes = "";
			$this->kdexport->HrefValue = "";

			// nexport
			$this->nexport->LinkCustomAttributes = "";
			$this->nexport->HrefValue = "";

			// kdskala
			$this->kdskala->LinkCustomAttributes = "";
			$this->kdskala->HrefValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";

			// omzet_saat_ini
			$this->omzet_saat_ini->LinkCustomAttributes = "";
			$this->omzet_saat_ini->HrefValue = "";

			// kapasitas_saat_ini
			$this->kapasitas_saat_ini->LinkCustomAttributes = "";
			$this->kapasitas_saat_ini->HrefValue = "";

			// kapasitas_stl_1thn
			$this->kapasitas_stl_1thn->LinkCustomAttributes = "";
			$this->kapasitas_stl_1thn->HrefValue = "";

			// kapasitas_stl_2thn
			$this->kapasitas_stl_2thn->LinkCustomAttributes = "";
			$this->kapasitas_stl_2thn->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";

			// user_updated_by
			$this->user_updated_by->LinkCustomAttributes = "";
			$this->user_updated_by->HrefValue = "";
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
		if ($this->namap->Required) {
			if (!$this->namap->IsDetailKey && $this->namap->FormValue != NULL && $this->namap->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->namap->caption(), $this->namap->RequiredErrorMessage));
			}
		}
		if ($this->kontak->Required) {
			if (!$this->kontak->IsDetailKey && $this->kontak->FormValue != NULL && $this->kontak->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kontak->caption(), $this->kontak->RequiredErrorMessage));
			}
		}
		if ($this->kdlokasi->Required) {
			if (!$this->kdlokasi->IsDetailKey && $this->kdlokasi->FormValue != NULL && $this->kdlokasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdlokasi->caption(), $this->kdlokasi->RequiredErrorMessage));
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
		if ($this->alamatp->Required) {
			if (!$this->alamatp->IsDetailKey && $this->alamatp->FormValue != NULL && $this->alamatp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamatp->caption(), $this->alamatp->RequiredErrorMessage));
			}
		}
		if ($this->kdpos->Required) {
			if (!$this->kdpos->IsDetailKey && $this->kdpos->FormValue != NULL && $this->kdpos->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdpos->caption(), $this->kdpos->RequiredErrorMessage));
			}
		}
		if ($this->telpp->Required) {
			if (!$this->telpp->IsDetailKey && $this->telpp->FormValue != NULL && $this->telpp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telpp->caption(), $this->telpp->RequiredErrorMessage));
			}
		}
		if ($this->faxp->Required) {
			if (!$this->faxp->IsDetailKey && $this->faxp->FormValue != NULL && $this->faxp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->faxp->caption(), $this->faxp->RequiredErrorMessage));
			}
		}
		if ($this->emailp->Required) {
			if (!$this->emailp->IsDetailKey && $this->emailp->FormValue != NULL && $this->emailp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emailp->caption(), $this->emailp->RequiredErrorMessage));
			}
		}
		if ($this->webp->Required) {
			if (!$this->webp->IsDetailKey && $this->webp->FormValue != NULL && $this->webp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->webp->caption(), $this->webp->RequiredErrorMessage));
			}
		}
		if ($this->medsos->Required) {
			if (!$this->medsos->IsDetailKey && $this->medsos->FormValue != NULL && $this->medsos->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->medsos->caption(), $this->medsos->RequiredErrorMessage));
			}
		}
		if ($this->kdjenis->Required) {
			if (!$this->kdjenis->IsDetailKey && $this->kdjenis->FormValue != NULL && $this->kdjenis->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdjenis->caption(), $this->kdjenis->RequiredErrorMessage));
			}
		}
		if ($this->kdproduknafed->Required) {
			if (!$this->kdproduknafed->IsDetailKey && $this->kdproduknafed->FormValue != NULL && $this->kdproduknafed->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdproduknafed->caption(), $this->kdproduknafed->RequiredErrorMessage));
			}
		}
		if ($this->kdproduknafed2->Required) {
			if (!$this->kdproduknafed2->IsDetailKey && $this->kdproduknafed2->FormValue != NULL && $this->kdproduknafed2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdproduknafed2->caption(), $this->kdproduknafed2->RequiredErrorMessage));
			}
		}
		if ($this->kdproduknafed3->Required) {
			if (!$this->kdproduknafed3->IsDetailKey && $this->kdproduknafed3->FormValue != NULL && $this->kdproduknafed3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdproduknafed3->caption(), $this->kdproduknafed3->RequiredErrorMessage));
			}
		}
		if ($this->pproduk->Required) {
			if (!$this->pproduk->IsDetailKey && $this->pproduk->FormValue != NULL && $this->pproduk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pproduk->caption(), $this->pproduk->RequiredErrorMessage));
			}
		}
		if ($this->kdexport->Required) {
			if (!$this->kdexport->IsDetailKey && $this->kdexport->FormValue != NULL && $this->kdexport->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdexport->caption(), $this->kdexport->RequiredErrorMessage));
			}
		}
		if ($this->nexport->Required) {
			if (!$this->nexport->IsDetailKey && $this->nexport->FormValue != NULL && $this->nexport->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nexport->caption(), $this->nexport->RequiredErrorMessage));
			}
		}
		if ($this->kdskala->Required) {
			if (!$this->kdskala->IsDetailKey && $this->kdskala->FormValue != NULL && $this->kdskala->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdskala->caption(), $this->kdskala->RequiredErrorMessage));
			}
		}
		if ($this->kdkategori->Required) {
			if (!$this->kdkategori->IsDetailKey && $this->kdkategori->FormValue != NULL && $this->kdkategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkategori->caption(), $this->kdkategori->RequiredErrorMessage));
			}
		}
		if ($this->omzet_saat_ini->Required) {
			if (!$this->omzet_saat_ini->IsDetailKey && $this->omzet_saat_ini->FormValue != NULL && $this->omzet_saat_ini->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->omzet_saat_ini->caption(), $this->omzet_saat_ini->RequiredErrorMessage));
			}
		}
		if ($this->kapasitas_saat_ini->Required) {
			if (!$this->kapasitas_saat_ini->IsDetailKey && $this->kapasitas_saat_ini->FormValue != NULL && $this->kapasitas_saat_ini->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kapasitas_saat_ini->caption(), $this->kapasitas_saat_ini->RequiredErrorMessage));
			}
		}
		if ($this->kapasitas_stl_1thn->Required) {
			if (!$this->kapasitas_stl_1thn->IsDetailKey && $this->kapasitas_stl_1thn->FormValue != NULL && $this->kapasitas_stl_1thn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kapasitas_stl_1thn->caption(), $this->kapasitas_stl_1thn->RequiredErrorMessage));
			}
		}
		if ($this->kapasitas_stl_2thn->Required) {
			if (!$this->kapasitas_stl_2thn->IsDetailKey && $this->kapasitas_stl_2thn->FormValue != NULL && $this->kapasitas_stl_2thn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kapasitas_stl_2thn->caption(), $this->kapasitas_stl_2thn->RequiredErrorMessage));
			}
		}
		if ($this->updated_at->Required) {
			if (!$this->updated_at->IsDetailKey && $this->updated_at->FormValue != NULL && $this->updated_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
			}
		}
		if ($this->user_updated_by->Required) {
			if (!$this->user_updated_by->IsDetailKey && $this->user_updated_by->FormValue != NULL && $this->user_updated_by->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_updated_by->caption(), $this->user_updated_by->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t_peserta", $detailTblVar) && $GLOBALS["t_peserta"]->DetailEdit) {
			if (!isset($GLOBALS["t_peserta_grid"]))
				$GLOBALS["t_peserta_grid"] = new t_peserta_grid(); // Get detail page object
			$GLOBALS["t_peserta_grid"]->validateGridForm();
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

			// namap
			$this->namap->setDbValueDef($rsnew, $this->namap->CurrentValue, NULL, $this->namap->ReadOnly);

			// kontak
			$this->kontak->setDbValueDef($rsnew, $this->kontak->CurrentValue, NULL, $this->kontak->ReadOnly);

			// kdlokasi
			$this->kdlokasi->setDbValueDef($rsnew, $this->kdlokasi->CurrentValue, NULL, $this->kdlokasi->ReadOnly);

			// kdprop
			$this->kdprop->setDbValueDef($rsnew, $this->kdprop->CurrentValue, NULL, $this->kdprop->ReadOnly);

			// kdkota
			$this->kdkota->setDbValueDef($rsnew, $this->kdkota->CurrentValue, NULL, $this->kdkota->ReadOnly);

			// kdkec
			$this->kdkec->setDbValueDef($rsnew, $this->kdkec->CurrentValue, NULL, $this->kdkec->ReadOnly);

			// alamatp
			$this->alamatp->setDbValueDef($rsnew, $this->alamatp->CurrentValue, NULL, $this->alamatp->ReadOnly);

			// kdpos
			$this->kdpos->setDbValueDef($rsnew, $this->kdpos->CurrentValue, NULL, $this->kdpos->ReadOnly);

			// telpp
			$this->telpp->setDbValueDef($rsnew, $this->telpp->CurrentValue, NULL, $this->telpp->ReadOnly);

			// faxp
			$this->faxp->setDbValueDef($rsnew, $this->faxp->CurrentValue, NULL, $this->faxp->ReadOnly);

			// emailp
			$this->emailp->setDbValueDef($rsnew, $this->emailp->CurrentValue, NULL, $this->emailp->ReadOnly);

			// webp
			$this->webp->setDbValueDef($rsnew, $this->webp->CurrentValue, NULL, $this->webp->ReadOnly);

			// medsos
			$this->medsos->setDbValueDef($rsnew, $this->medsos->CurrentValue, NULL, $this->medsos->ReadOnly);

			// kdjenis
			$this->kdjenis->setDbValueDef($rsnew, $this->kdjenis->CurrentValue, NULL, $this->kdjenis->ReadOnly);

			// kdproduknafed
			$this->kdproduknafed->setDbValueDef($rsnew, $this->kdproduknafed->CurrentValue, NULL, $this->kdproduknafed->ReadOnly);

			// kdproduknafed2
			$this->kdproduknafed2->setDbValueDef($rsnew, $this->kdproduknafed2->CurrentValue, NULL, $this->kdproduknafed2->ReadOnly);

			// kdproduknafed3
			$this->kdproduknafed3->setDbValueDef($rsnew, $this->kdproduknafed3->CurrentValue, NULL, $this->kdproduknafed3->ReadOnly);

			// pproduk
			$this->pproduk->setDbValueDef($rsnew, $this->pproduk->CurrentValue, NULL, $this->pproduk->ReadOnly);

			// kdexport
			$this->kdexport->setDbValueDef($rsnew, $this->kdexport->CurrentValue, NULL, $this->kdexport->ReadOnly);

			// nexport
			$this->nexport->setDbValueDef($rsnew, $this->nexport->CurrentValue, NULL, $this->nexport->ReadOnly);

			// kdskala
			$this->kdskala->setDbValueDef($rsnew, $this->kdskala->CurrentValue, NULL, $this->kdskala->ReadOnly);

			// kdkategori
			$this->kdkategori->setDbValueDef($rsnew, $this->kdkategori->CurrentValue, NULL, $this->kdkategori->ReadOnly);

			// omzet_saat_ini
			$this->omzet_saat_ini->setDbValueDef($rsnew, $this->omzet_saat_ini->CurrentValue, NULL, $this->omzet_saat_ini->ReadOnly);

			// kapasitas_saat_ini
			$this->kapasitas_saat_ini->setDbValueDef($rsnew, $this->kapasitas_saat_ini->CurrentValue, NULL, $this->kapasitas_saat_ini->ReadOnly);

			// kapasitas_stl_1thn
			$this->kapasitas_stl_1thn->setDbValueDef($rsnew, $this->kapasitas_stl_1thn->CurrentValue, NULL, $this->kapasitas_stl_1thn->ReadOnly);

			// kapasitas_stl_2thn
			$this->kapasitas_stl_2thn->setDbValueDef($rsnew, $this->kapasitas_stl_2thn->CurrentValue, NULL, $this->kapasitas_stl_2thn->ReadOnly);

			// updated_at
			$this->updated_at->CurrentValue = CurrentUserName();
			$this->updated_at->setDbValueDef($rsnew, $this->updated_at->CurrentValue, NULL);

			// user_updated_by
			$this->user_updated_by->CurrentValue = CurrentDateTime();
			$this->user_updated_by->setDbValueDef($rsnew, $this->user_updated_by->CurrentValue, NULL);

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
					if (in_array("t_peserta", $detailTblVar) && $GLOBALS["t_peserta"]->DetailEdit) {
						if (!isset($GLOBALS["t_peserta_grid"]))
							$GLOBALS["t_peserta_grid"] = new t_peserta_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "t_peserta"); // Load user level of detail table
						$editRow = $GLOBALS["t_peserta_grid"]->gridUpdate();
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
			if (in_array("t_peserta", $detailTblVar)) {
				if (!isset($GLOBALS["t_peserta_grid"]))
					$GLOBALS["t_peserta_grid"] = new t_peserta_grid();
				if ($GLOBALS["t_peserta_grid"]->DetailEdit) {
					$GLOBALS["t_peserta_grid"]->CurrentMode = "edit";
					$GLOBALS["t_peserta_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t_peserta_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_peserta_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_peserta_grid"]->idp->IsDetailKey = TRUE;
					$GLOBALS["t_peserta_grid"]->idp->CurrentValue = $this->idp->CurrentValue;
					$GLOBALS["t_peserta_grid"]->idp->setSessionValue($GLOBALS["t_peserta_grid"]->idp->CurrentValue);
					$GLOBALS["t_peserta_grid"]->kdkota->setSessionValue(""); // Clear session key
					$GLOBALS["t_peserta_grid"]->kdprop->setSessionValue(""); // Clear session key
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_perusahaanlist.php"), "", $this->TableVar, TRUE);
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
				case "x_idp":
					break;
				case "x_kdlokasi":
					break;
				case "x_kdprop":
					break;
				case "x_kdkota":
					break;
				case "x_kdkec":
					break;
				case "x_kdjenis":
					break;
				case "x_kdproduknafed":
					break;
				case "x_kdproduknafed2":
					break;
				case "x_kdproduknafed3":
					break;
				case "x_kdexport":
					break;
				case "x_kdskala":
					break;
				case "x_kdkategori":
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
						case "x_idp":
							break;
						case "x_kdlokasi":
							break;
						case "x_kdprop":
							break;
						case "x_kdkota":
							break;
						case "x_kdkec":
							break;
						case "x_kdjenis":
							break;
						case "x_kdproduknafed":
							break;
						case "x_kdproduknafed2":
							break;
						case "x_kdproduknafed3":
							break;
						case "x_kdexport":
							break;
						case "x_kdskala":
							break;
						case "x_kdkategori":
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

		/*$footer = "Peserta :<br>";
		$idPerusahaan = $this->idp->CurrentValue;
		$idpage = "t_perusahaan#".$idPerusahaan;
		$vsql = "SELECT id,nama FROM `t_peserta` WHERE idp ='".$idPerusahaan."'";
		$judul = "Peserta:";
		$footer = cs_panelbs($idpage,$vsql,$judul);
		*/
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>