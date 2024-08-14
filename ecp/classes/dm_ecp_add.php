<?php
namespace PHPMaker2020\input_ecp;

/**
 * Page class
 */
class dm_ecp_add extends dm_ecp
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{9B9A621D-5170-4F08-8852-72A13BB88C54}";

	// Table name
	public $TableName = 'dm_ecp';

	// Page object name
	public $PageObjName = "dm_ecp_add";

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
		$hidden = TRUE;
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

		// Table object (dm_ecp)
		if (!isset($GLOBALS["dm_ecp"]) || get_class($GLOBALS["dm_ecp"]) == PROJECT_NAMESPACE . "dm_ecp") {
			$GLOBALS["dm_ecp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["dm_ecp"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'dm_ecp');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();
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
		global $dm_ecp;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($dm_ecp);
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
					if ($pageName == "dm_ecpview.php")
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
		if (!$Security->isLoggedIn()) // Logged in
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
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("dm_ecplist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID_ECP->Visible = FALSE;
		$this->Nama->setVisibility();
		$this->Perusahaan->setVisibility();
		$this->Daerah->setVisibility();
		$this->Produk->setVisibility();
		$this->Tgl_Bln_Ekspor->setVisibility();
		$this->Negara_Tujuan->setVisibility();
		$this->Nilai_Ekspor_USD->setVisibility();
		$this->Nilai_Ekspor_Rupiah->setVisibility();
		$this->Keterangan->setVisibility();
		$this->Wilayah_ECP->setVisibility();
		$this->Tahun_ECP->setVisibility();
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
		$this->setupLookupOptions($this->Nama);
		$this->setupLookupOptions($this->Perusahaan);
		$this->setupLookupOptions($this->Wilayah_ECP);

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
			if (Get("ID_ECP") !== NULL) {
				$this->ID_ECP->setQueryStringValue(Get("ID_ECP"));
				$this->setKey("ID_ECP", $this->ID_ECP->CurrentValue); // Set up key
			} else {
				$this->setKey("ID_ECP", ""); // Clear key
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
					$this->terminate("dm_ecplist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "dm_ecplist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "dm_ecpview.php")
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
		$this->ID_ECP->CurrentValue = NULL;
		$this->ID_ECP->OldValue = $this->ID_ECP->CurrentValue;
		$this->Nama->CurrentValue = NULL;
		$this->Nama->OldValue = $this->Nama->CurrentValue;
		$this->Perusahaan->CurrentValue = NULL;
		$this->Perusahaan->OldValue = $this->Perusahaan->CurrentValue;
		$this->Daerah->CurrentValue = NULL;
		$this->Daerah->OldValue = $this->Daerah->CurrentValue;
		$this->Produk->CurrentValue = NULL;
		$this->Produk->OldValue = $this->Produk->CurrentValue;
		$this->Tgl_Bln_Ekspor->CurrentValue = NULL;
		$this->Tgl_Bln_Ekspor->OldValue = $this->Tgl_Bln_Ekspor->CurrentValue;
		$this->Negara_Tujuan->CurrentValue = NULL;
		$this->Negara_Tujuan->OldValue = $this->Negara_Tujuan->CurrentValue;
		$this->Nilai_Ekspor_USD->CurrentValue = NULL;
		$this->Nilai_Ekspor_USD->OldValue = $this->Nilai_Ekspor_USD->CurrentValue;
		$this->Nilai_Ekspor_Rupiah->CurrentValue = NULL;
		$this->Nilai_Ekspor_Rupiah->OldValue = $this->Nilai_Ekspor_Rupiah->CurrentValue;
		$this->Keterangan->CurrentValue = NULL;
		$this->Keterangan->OldValue = $this->Keterangan->CurrentValue;
		$this->Wilayah_ECP->CurrentValue = NULL;
		$this->Wilayah_ECP->OldValue = $this->Wilayah_ECP->CurrentValue;
		$this->Tahun_ECP->CurrentValue = NULL;
		$this->Tahun_ECP->OldValue = $this->Tahun_ECP->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Nama' first before field var 'x_Nama'
		$val = $CurrentForm->hasValue("Nama") ? $CurrentForm->getValue("Nama") : $CurrentForm->getValue("x_Nama");
		if (!$this->Nama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Nama->Visible = FALSE; // Disable update for API request
			else
				$this->Nama->setFormValue($val);
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

		// Check field name 'Wilayah_ECP' first before field var 'x_Wilayah_ECP'
		$val = $CurrentForm->hasValue("Wilayah_ECP") ? $CurrentForm->getValue("Wilayah_ECP") : $CurrentForm->getValue("x_Wilayah_ECP");
		if (!$this->Wilayah_ECP->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Wilayah_ECP->Visible = FALSE; // Disable update for API request
			else
				$this->Wilayah_ECP->setFormValue($val);
		}

		// Check field name 'Tahun_ECP' first before field var 'x_Tahun_ECP'
		$val = $CurrentForm->hasValue("Tahun_ECP") ? $CurrentForm->getValue("Tahun_ECP") : $CurrentForm->getValue("x_Tahun_ECP");
		if (!$this->Tahun_ECP->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Tahun_ECP->Visible = FALSE; // Disable update for API request
			else
				$this->Tahun_ECP->setFormValue($val);
		}

		// Check field name 'ID_ECP' first before field var 'x_ID_ECP'
		$val = $CurrentForm->hasValue("ID_ECP") ? $CurrentForm->getValue("ID_ECP") : $CurrentForm->getValue("x_ID_ECP");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->Perusahaan->CurrentValue = $this->Perusahaan->FormValue;
		$this->Daerah->CurrentValue = $this->Daerah->FormValue;
		$this->Produk->CurrentValue = $this->Produk->FormValue;
		$this->Tgl_Bln_Ekspor->CurrentValue = $this->Tgl_Bln_Ekspor->FormValue;
		$this->Negara_Tujuan->CurrentValue = $this->Negara_Tujuan->FormValue;
		$this->Nilai_Ekspor_USD->CurrentValue = $this->Nilai_Ekspor_USD->FormValue;
		$this->Nilai_Ekspor_Rupiah->CurrentValue = $this->Nilai_Ekspor_Rupiah->FormValue;
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
		$this->Wilayah_ECP->CurrentValue = $this->Wilayah_ECP->FormValue;
		$this->Tahun_ECP->CurrentValue = $this->Tahun_ECP->FormValue;
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
		$this->Nama->setDbValue($row['Nama']);
		$this->Perusahaan->setDbValue($row['Perusahaan']);
		$this->Daerah->setDbValue($row['Daerah']);
		$this->Produk->setDbValue($row['Produk']);
		$this->Tgl_Bln_Ekspor->setDbValue($row['Tgl_Bln_Ekspor']);
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
		$this->loadDefaultValues();
		$row = [];
		$row['ID_ECP'] = $this->ID_ECP->CurrentValue;
		$row['Nama'] = $this->Nama->CurrentValue;
		$row['Perusahaan'] = $this->Perusahaan->CurrentValue;
		$row['Daerah'] = $this->Daerah->CurrentValue;
		$row['Produk'] = $this->Produk->CurrentValue;
		$row['Tgl_Bln_Ekspor'] = $this->Tgl_Bln_Ekspor->CurrentValue;
		$row['Negara_Tujuan'] = $this->Negara_Tujuan->CurrentValue;
		$row['Nilai_Ekspor_USD'] = $this->Nilai_Ekspor_USD->CurrentValue;
		$row['Nilai_Ekspor_Rupiah'] = $this->Nilai_Ekspor_Rupiah->CurrentValue;
		$row['Keterangan'] = $this->Keterangan->CurrentValue;
		$row['Wilayah_ECP'] = $this->Wilayah_ECP->CurrentValue;
		$row['Tahun_ECP'] = $this->Tahun_ECP->CurrentValue;
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
		// Nama
		// Perusahaan
		// Daerah
		// Produk
		// Tgl_Bln_Ekspor
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

			// Nama
			$this->Nama->ViewValue = $this->Nama->CurrentValue;
			$curVal = strval($this->Nama->CurrentValue);
			if ($curVal != "") {
				$this->Nama->ViewValue = $this->Nama->lookupCacheOption($curVal);
				if ($this->Nama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Nama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Nama->ViewValue = $this->Nama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Nama->ViewValue = $this->Nama->CurrentValue;
					}
				}
			} else {
				$this->Nama->ViewValue = NULL;
			}
			$this->Nama->ViewCustomAttributes = "";

			// Perusahaan
			$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
			$curVal = strval($this->Perusahaan->CurrentValue);
			if ($curVal != "") {
				$this->Perusahaan->ViewValue = $this->Perusahaan->lookupCacheOption($curVal);
				if ($this->Perusahaan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Perusahaan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Perusahaan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Perusahaan->ViewValue = $this->Perusahaan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
					}
				}
			} else {
				$this->Perusahaan->ViewValue = NULL;
			}
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

			// Negara_Tujuan
			$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->CurrentValue;
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
			$arwrk = [];
			$arwrk[1] = $this->Wilayah_ECP->CurrentValue;
			$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->displayValue($arwrk);
			$this->Wilayah_ECP->ViewCustomAttributes = "";

			// Tahun_ECP
			$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
			$this->Tahun_ECP->ViewCustomAttributes = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";

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

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";
			$this->Wilayah_ECP->TooltipValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
			$this->Tahun_ECP->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			if (!$this->Nama->Raw)
				$this->Nama->CurrentValue = HtmlDecode($this->Nama->CurrentValue);
			$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
			$curVal = strval($this->Nama->CurrentValue);
			if ($curVal != "") {
				$this->Nama->EditValue = $this->Nama->lookupCacheOption($curVal);
				if ($this->Nama->EditValue === NULL) { // Lookup from database
					$filterWrk = "`Nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Nama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Nama->EditValue = $this->Nama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Nama->EditValue = HtmlEncode($this->Nama->CurrentValue);
					}
				}
			} else {
				$this->Nama->EditValue = NULL;
			}
			$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

			// Perusahaan
			$this->Perusahaan->EditAttrs["class"] = "form-control";
			$this->Perusahaan->EditCustomAttributes = "";
			if (!$this->Perusahaan->Raw)
				$this->Perusahaan->CurrentValue = HtmlDecode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
			$curVal = strval($this->Perusahaan->CurrentValue);
			if ($curVal != "") {
				$this->Perusahaan->EditValue = $this->Perusahaan->lookupCacheOption($curVal);
				if ($this->Perusahaan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`Perusahaan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Perusahaan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Perusahaan->EditValue = $this->Perusahaan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
					}
				}
			} else {
				$this->Perusahaan->EditValue = NULL;
			}
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

			// Negara_Tujuan
			$this->Negara_Tujuan->EditAttrs["class"] = "form-control";
			$this->Negara_Tujuan->EditCustomAttributes = "";
			if (!$this->Negara_Tujuan->Raw)
				$this->Negara_Tujuan->CurrentValue = HtmlDecode($this->Negara_Tujuan->CurrentValue);
			$this->Negara_Tujuan->EditValue = HtmlEncode($this->Negara_Tujuan->CurrentValue);
			$this->Negara_Tujuan->PlaceHolder = RemoveHtml($this->Negara_Tujuan->caption());

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

			// Wilayah_ECP
			$this->Wilayah_ECP->EditAttrs["class"] = "form-control";
			$this->Wilayah_ECP->EditCustomAttributes = "";
			$curVal = trim(strval($this->Wilayah_ECP->CurrentValue));
			if ($curVal != "")
				$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->lookupCacheOption($curVal);
			else
				$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->Lookup !== NULL && is_array($this->Wilayah_ECP->Lookup->Options) ? $curVal : NULL;
			if ($this->Wilayah_ECP->ViewValue !== NULL) { // Load from cache
				$this->Wilayah_ECP->EditValue = array_values($this->Wilayah_ECP->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Wilayah_ECP`" . SearchString("=", $this->Wilayah_ECP->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Wilayah_ECP->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Wilayah_ECP->EditValue = $arwrk;
			}

			// Tahun_ECP
			$this->Tahun_ECP->EditAttrs["class"] = "form-control";
			$this->Tahun_ECP->EditCustomAttributes = "";
			$this->Tahun_ECP->EditValue = HtmlEncode($this->Tahun_ECP->CurrentValue);
			$this->Tahun_ECP->PlaceHolder = RemoveHtml($this->Tahun_ECP->caption());

			// Add refer script
			// Nama

			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

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

			// Wilayah_ECP
			$this->Wilayah_ECP->LinkCustomAttributes = "";
			$this->Wilayah_ECP->HrefValue = "";

			// Tahun_ECP
			$this->Tahun_ECP->LinkCustomAttributes = "";
			$this->Tahun_ECP->HrefValue = "";
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
		if ($this->Nama->Required) {
			if (!$this->Nama->IsDetailKey && $this->Nama->FormValue != NULL && $this->Nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nama->caption(), $this->Nama->RequiredErrorMessage));
			}
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
		if ($this->Wilayah_ECP->Required) {
			if (!$this->Wilayah_ECP->IsDetailKey && $this->Wilayah_ECP->FormValue != NULL && $this->Wilayah_ECP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Wilayah_ECP->caption(), $this->Wilayah_ECP->RequiredErrorMessage));
			}
		}
		if ($this->Tahun_ECP->Required) {
			if (!$this->Tahun_ECP->IsDetailKey && $this->Tahun_ECP->FormValue != NULL && $this->Tahun_ECP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tahun_ECP->caption(), $this->Tahun_ECP->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Tahun_ECP->FormValue)) {
			AddMessage($FormError, $this->Tahun_ECP->errorMessage());
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

		// Nama
		$this->Nama->setDbValueDef($rsnew, $this->Nama->CurrentValue, "", FALSE);

		// Perusahaan
		$this->Perusahaan->setDbValueDef($rsnew, $this->Perusahaan->CurrentValue, "", FALSE);

		// Daerah
		$this->Daerah->setDbValueDef($rsnew, $this->Daerah->CurrentValue, "", FALSE);

		// Produk
		$this->Produk->setDbValueDef($rsnew, $this->Produk->CurrentValue, "", FALSE);

		// Tgl_Bln_Ekspor
		$this->Tgl_Bln_Ekspor->setDbValueDef($rsnew, $this->Tgl_Bln_Ekspor->CurrentValue, "", FALSE);

		// Negara_Tujuan
		$this->Negara_Tujuan->setDbValueDef($rsnew, $this->Negara_Tujuan->CurrentValue, "", FALSE);

		// Nilai_Ekspor_USD
		$this->Nilai_Ekspor_USD->setDbValueDef($rsnew, $this->Nilai_Ekspor_USD->CurrentValue, 0, FALSE);

		// Nilai_Ekspor_Rupiah
		$this->Nilai_Ekspor_Rupiah->setDbValueDef($rsnew, $this->Nilai_Ekspor_Rupiah->CurrentValue, 0, FALSE);

		// Keterangan
		$this->Keterangan->setDbValueDef($rsnew, $this->Keterangan->CurrentValue, "", FALSE);

		// Wilayah_ECP
		$this->Wilayah_ECP->setDbValueDef($rsnew, $this->Wilayah_ECP->CurrentValue, "", FALSE);

		// Tahun_ECP
		$this->Tahun_ECP->setDbValueDef($rsnew, $this->Tahun_ECP->CurrentValue, 0, FALSE);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("dm_ecplist.php"), "", $this->TableVar, TRUE);
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
				case "x_Nama":
					break;
				case "x_Perusahaan":
					break;
				case "x_Wilayah_ECP":
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
						case "x_Nama":
							break;
						case "x_Perusahaan":
							break;
						case "x_Wilayah_ECP":
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