<?php
namespace PHPMaker2020\input_ecp;

/**
 * Page class
 */
class dm_pesertaecp_add extends dm_pesertaecp
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{9B9A621D-5170-4F08-8852-72A13BB88C54}";

	// Table name
	public $TableName = 'dm_pesertaecp';

	// Page object name
	public $PageObjName = "dm_pesertaecp_add";

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

		// Table object (dm_pesertaecp)
		if (!isset($GLOBALS["dm_pesertaecp"]) || get_class($GLOBALS["dm_pesertaecp"]) == PROJECT_NAMESPACE . "dm_pesertaecp") {
			$GLOBALS["dm_pesertaecp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["dm_pesertaecp"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'dm_pesertaecp');

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
		global $dm_pesertaecp;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($dm_pesertaecp);
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
					if ($pageName == "dm_pesertaecpview.php")
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
			$key .= @$ar['ID_Unik'];
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
			$this->ID_Unik->Visible = FALSE;
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
					$this->terminate(GetUrl("dm_pesertaecplist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID_Unik->Visible = FALSE;
		$this->Nama->setVisibility();
		$this->Perusahaan->setVisibility();
		$this->Alamat->setVisibility();
		$this->Produk->setVisibility();
		$this->Kapasitas_Produksi->setVisibility();
		$this->Omset->setVisibility();
		$this->Jumlah_Pegawai->setVisibility();
		$this->Legalitas_Perusahaan->setVisibility();
		$this->Sertifikasi_dimiliki->setVisibility();
		$this->Handphone->setVisibility();
		$this->Email_Add->setVisibility();
		$this->Website->setVisibility();
		$this->Tahun_Berdiri->setVisibility();
		$this->Alamat_Produksi->setVisibility();
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
			if (Get("ID_Unik") !== NULL) {
				$this->ID_Unik->setQueryStringValue(Get("ID_Unik"));
				$this->setKey("ID_Unik", $this->ID_Unik->CurrentValue); // Set up key
			} else {
				$this->setKey("ID_Unik", ""); // Clear key
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
					$this->terminate("dm_pesertaecplist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "dm_pesertaecplist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "dm_pesertaecpview.php")
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
		$this->ID_Unik->CurrentValue = NULL;
		$this->ID_Unik->OldValue = $this->ID_Unik->CurrentValue;
		$this->Nama->CurrentValue = NULL;
		$this->Nama->OldValue = $this->Nama->CurrentValue;
		$this->Perusahaan->CurrentValue = NULL;
		$this->Perusahaan->OldValue = $this->Perusahaan->CurrentValue;
		$this->Alamat->CurrentValue = NULL;
		$this->Alamat->OldValue = $this->Alamat->CurrentValue;
		$this->Produk->CurrentValue = NULL;
		$this->Produk->OldValue = $this->Produk->CurrentValue;
		$this->Kapasitas_Produksi->CurrentValue = NULL;
		$this->Kapasitas_Produksi->OldValue = $this->Kapasitas_Produksi->CurrentValue;
		$this->Omset->CurrentValue = NULL;
		$this->Omset->OldValue = $this->Omset->CurrentValue;
		$this->Jumlah_Pegawai->CurrentValue = NULL;
		$this->Jumlah_Pegawai->OldValue = $this->Jumlah_Pegawai->CurrentValue;
		$this->Legalitas_Perusahaan->CurrentValue = NULL;
		$this->Legalitas_Perusahaan->OldValue = $this->Legalitas_Perusahaan->CurrentValue;
		$this->Sertifikasi_dimiliki->CurrentValue = NULL;
		$this->Sertifikasi_dimiliki->OldValue = $this->Sertifikasi_dimiliki->CurrentValue;
		$this->Handphone->CurrentValue = NULL;
		$this->Handphone->OldValue = $this->Handphone->CurrentValue;
		$this->Email_Add->CurrentValue = NULL;
		$this->Email_Add->OldValue = $this->Email_Add->CurrentValue;
		$this->Website->CurrentValue = NULL;
		$this->Website->OldValue = $this->Website->CurrentValue;
		$this->Tahun_Berdiri->CurrentValue = NULL;
		$this->Tahun_Berdiri->OldValue = $this->Tahun_Berdiri->CurrentValue;
		$this->Alamat_Produksi->CurrentValue = NULL;
		$this->Alamat_Produksi->OldValue = $this->Alamat_Produksi->CurrentValue;
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

		// Check field name 'Alamat' first before field var 'x_Alamat'
		$val = $CurrentForm->hasValue("Alamat") ? $CurrentForm->getValue("Alamat") : $CurrentForm->getValue("x_Alamat");
		if (!$this->Alamat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Alamat->Visible = FALSE; // Disable update for API request
			else
				$this->Alamat->setFormValue($val);
		}

		// Check field name 'Produk' first before field var 'x_Produk'
		$val = $CurrentForm->hasValue("Produk") ? $CurrentForm->getValue("Produk") : $CurrentForm->getValue("x_Produk");
		if (!$this->Produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Produk->Visible = FALSE; // Disable update for API request
			else
				$this->Produk->setFormValue($val);
		}

		// Check field name 'Kapasitas_Produksi' first before field var 'x_Kapasitas_Produksi'
		$val = $CurrentForm->hasValue("Kapasitas_Produksi") ? $CurrentForm->getValue("Kapasitas_Produksi") : $CurrentForm->getValue("x_Kapasitas_Produksi");
		if (!$this->Kapasitas_Produksi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Kapasitas_Produksi->Visible = FALSE; // Disable update for API request
			else
				$this->Kapasitas_Produksi->setFormValue($val);
		}

		// Check field name 'Omset' first before field var 'x_Omset'
		$val = $CurrentForm->hasValue("Omset") ? $CurrentForm->getValue("Omset") : $CurrentForm->getValue("x_Omset");
		if (!$this->Omset->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Omset->Visible = FALSE; // Disable update for API request
			else
				$this->Omset->setFormValue($val);
		}

		// Check field name 'Jumlah_Pegawai' first before field var 'x_Jumlah_Pegawai'
		$val = $CurrentForm->hasValue("Jumlah_Pegawai") ? $CurrentForm->getValue("Jumlah_Pegawai") : $CurrentForm->getValue("x_Jumlah_Pegawai");
		if (!$this->Jumlah_Pegawai->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Jumlah_Pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->Jumlah_Pegawai->setFormValue($val);
		}

		// Check field name 'Legalitas_Perusahaan' first before field var 'x_Legalitas_Perusahaan'
		$val = $CurrentForm->hasValue("Legalitas_Perusahaan") ? $CurrentForm->getValue("Legalitas_Perusahaan") : $CurrentForm->getValue("x_Legalitas_Perusahaan");
		if (!$this->Legalitas_Perusahaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Legalitas_Perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->Legalitas_Perusahaan->setFormValue($val);
		}

		// Check field name 'Sertifikasi_dimiliki' first before field var 'x_Sertifikasi_dimiliki'
		$val = $CurrentForm->hasValue("Sertifikasi_dimiliki") ? $CurrentForm->getValue("Sertifikasi_dimiliki") : $CurrentForm->getValue("x_Sertifikasi_dimiliki");
		if (!$this->Sertifikasi_dimiliki->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Sertifikasi_dimiliki->Visible = FALSE; // Disable update for API request
			else
				$this->Sertifikasi_dimiliki->setFormValue($val);
		}

		// Check field name 'Handphone' first before field var 'x_Handphone'
		$val = $CurrentForm->hasValue("Handphone") ? $CurrentForm->getValue("Handphone") : $CurrentForm->getValue("x_Handphone");
		if (!$this->Handphone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Handphone->Visible = FALSE; // Disable update for API request
			else
				$this->Handphone->setFormValue($val);
		}

		// Check field name 'Email_Add' first before field var 'x_Email_Add'
		$val = $CurrentForm->hasValue("Email_Add") ? $CurrentForm->getValue("Email_Add") : $CurrentForm->getValue("x_Email_Add");
		if (!$this->Email_Add->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Email_Add->Visible = FALSE; // Disable update for API request
			else
				$this->Email_Add->setFormValue($val);
		}

		// Check field name 'Website' first before field var 'x_Website'
		$val = $CurrentForm->hasValue("Website") ? $CurrentForm->getValue("Website") : $CurrentForm->getValue("x_Website");
		if (!$this->Website->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Website->Visible = FALSE; // Disable update for API request
			else
				$this->Website->setFormValue($val);
		}

		// Check field name 'Tahun_Berdiri' first before field var 'x_Tahun_Berdiri'
		$val = $CurrentForm->hasValue("Tahun_Berdiri") ? $CurrentForm->getValue("Tahun_Berdiri") : $CurrentForm->getValue("x_Tahun_Berdiri");
		if (!$this->Tahun_Berdiri->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Tahun_Berdiri->Visible = FALSE; // Disable update for API request
			else
				$this->Tahun_Berdiri->setFormValue($val);
		}

		// Check field name 'Alamat_Produksi' first before field var 'x_Alamat_Produksi'
		$val = $CurrentForm->hasValue("Alamat_Produksi") ? $CurrentForm->getValue("Alamat_Produksi") : $CurrentForm->getValue("x_Alamat_Produksi");
		if (!$this->Alamat_Produksi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Alamat_Produksi->Visible = FALSE; // Disable update for API request
			else
				$this->Alamat_Produksi->setFormValue($val);
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

		// Check field name 'ID_Unik' first before field var 'x_ID_Unik'
		$val = $CurrentForm->hasValue("ID_Unik") ? $CurrentForm->getValue("ID_Unik") : $CurrentForm->getValue("x_ID_Unik");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->Perusahaan->CurrentValue = $this->Perusahaan->FormValue;
		$this->Alamat->CurrentValue = $this->Alamat->FormValue;
		$this->Produk->CurrentValue = $this->Produk->FormValue;
		$this->Kapasitas_Produksi->CurrentValue = $this->Kapasitas_Produksi->FormValue;
		$this->Omset->CurrentValue = $this->Omset->FormValue;
		$this->Jumlah_Pegawai->CurrentValue = $this->Jumlah_Pegawai->FormValue;
		$this->Legalitas_Perusahaan->CurrentValue = $this->Legalitas_Perusahaan->FormValue;
		$this->Sertifikasi_dimiliki->CurrentValue = $this->Sertifikasi_dimiliki->FormValue;
		$this->Handphone->CurrentValue = $this->Handphone->FormValue;
		$this->Email_Add->CurrentValue = $this->Email_Add->FormValue;
		$this->Website->CurrentValue = $this->Website->FormValue;
		$this->Tahun_Berdiri->CurrentValue = $this->Tahun_Berdiri->FormValue;
		$this->Alamat_Produksi->CurrentValue = $this->Alamat_Produksi->FormValue;
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
		$this->ID_Unik->setDbValue($row['ID_Unik']);
		$this->Nama->setDbValue($row['Nama']);
		$this->Perusahaan->setDbValue($row['Perusahaan']);
		$this->Alamat->setDbValue($row['Alamat']);
		$this->Produk->setDbValue($row['Produk']);
		$this->Kapasitas_Produksi->setDbValue($row['Kapasitas_Produksi']);
		$this->Omset->setDbValue($row['Omset']);
		$this->Jumlah_Pegawai->setDbValue($row['Jumlah_Pegawai']);
		$this->Legalitas_Perusahaan->setDbValue($row['Legalitas_Perusahaan']);
		$this->Sertifikasi_dimiliki->setDbValue($row['Sertifikasi_dimiliki']);
		$this->Handphone->setDbValue($row['Handphone']);
		$this->Email_Add->setDbValue($row['Email_Add']);
		$this->Website->setDbValue($row['Website']);
		$this->Tahun_Berdiri->setDbValue($row['Tahun_Berdiri']);
		$this->Alamat_Produksi->setDbValue($row['Alamat_Produksi']);
		$this->Wilayah_ECP->setDbValue($row['Wilayah_ECP']);
		$this->Tahun_ECP->setDbValue($row['Tahun_ECP']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Unik'] = $this->ID_Unik->CurrentValue;
		$row['Nama'] = $this->Nama->CurrentValue;
		$row['Perusahaan'] = $this->Perusahaan->CurrentValue;
		$row['Alamat'] = $this->Alamat->CurrentValue;
		$row['Produk'] = $this->Produk->CurrentValue;
		$row['Kapasitas_Produksi'] = $this->Kapasitas_Produksi->CurrentValue;
		$row['Omset'] = $this->Omset->CurrentValue;
		$row['Jumlah_Pegawai'] = $this->Jumlah_Pegawai->CurrentValue;
		$row['Legalitas_Perusahaan'] = $this->Legalitas_Perusahaan->CurrentValue;
		$row['Sertifikasi_dimiliki'] = $this->Sertifikasi_dimiliki->CurrentValue;
		$row['Handphone'] = $this->Handphone->CurrentValue;
		$row['Email_Add'] = $this->Email_Add->CurrentValue;
		$row['Website'] = $this->Website->CurrentValue;
		$row['Tahun_Berdiri'] = $this->Tahun_Berdiri->CurrentValue;
		$row['Alamat_Produksi'] = $this->Alamat_Produksi->CurrentValue;
		$row['Wilayah_ECP'] = $this->Wilayah_ECP->CurrentValue;
		$row['Tahun_ECP'] = $this->Tahun_ECP->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Unik")) != "")
			$this->ID_Unik->OldValue = $this->getKey("ID_Unik"); // ID_Unik
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
		// ID_Unik
		// Nama
		// Perusahaan
		// Alamat
		// Produk
		// Kapasitas_Produksi
		// Omset
		// Jumlah_Pegawai
		// Legalitas_Perusahaan
		// Sertifikasi_dimiliki
		// Handphone
		// Email_Add
		// Website
		// Tahun_Berdiri
		// Alamat_Produksi
		// Wilayah_ECP
		// Tahun_ECP

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_Unik
			$this->ID_Unik->ViewValue = $this->ID_Unik->CurrentValue;
			$this->ID_Unik->ViewCustomAttributes = "";

			// Nama
			$this->Nama->ViewValue = $this->Nama->CurrentValue;
			$this->Nama->ViewCustomAttributes = "";

			// Perusahaan
			$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
			$this->Perusahaan->ViewCustomAttributes = "";

			// Alamat
			$this->Alamat->ViewValue = $this->Alamat->CurrentValue;
			$this->Alamat->ViewCustomAttributes = "";

			// Produk
			$this->Produk->ViewValue = $this->Produk->CurrentValue;
			$this->Produk->ViewCustomAttributes = "";

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->ViewValue = $this->Kapasitas_Produksi->CurrentValue;
			$this->Kapasitas_Produksi->ViewCustomAttributes = "";

			// Omset
			$this->Omset->ViewValue = $this->Omset->CurrentValue;
			$this->Omset->ViewCustomAttributes = "";

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->ViewValue = $this->Jumlah_Pegawai->CurrentValue;
			$this->Jumlah_Pegawai->ViewCustomAttributes = "";

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->ViewValue = $this->Legalitas_Perusahaan->CurrentValue;
			$this->Legalitas_Perusahaan->ViewCustomAttributes = "";

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->ViewValue = $this->Sertifikasi_dimiliki->CurrentValue;
			$this->Sertifikasi_dimiliki->ViewCustomAttributes = "";

			// Handphone
			$this->Handphone->ViewValue = $this->Handphone->CurrentValue;
			$this->Handphone->ViewCustomAttributes = "";

			// Email_Add
			$this->Email_Add->ViewValue = $this->Email_Add->CurrentValue;
			$this->Email_Add->ViewCustomAttributes = "";

			// Website
			$this->Website->ViewValue = $this->Website->CurrentValue;
			$this->Website->ViewCustomAttributes = "";

			// Tahun_Berdiri
			$this->Tahun_Berdiri->ViewValue = $this->Tahun_Berdiri->CurrentValue;
			$this->Tahun_Berdiri->ViewCustomAttributes = "";

			// Alamat_Produksi
			$this->Alamat_Produksi->ViewValue = $this->Alamat_Produksi->CurrentValue;
			$this->Alamat_Produksi->ViewCustomAttributes = "";

			// Wilayah_ECP
			$arwrk = [];
			$arwrk[1] = $this->Wilayah_ECP->CurrentValue;
			$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->displayValue($arwrk);
			$this->Wilayah_ECP->ViewCustomAttributes = "";

			// Tahun_ECP
			$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
			$this->Tahun_ECP->ViewValue = FormatNumber($this->Tahun_ECP->ViewValue, 0, -2, -2, -2);
			$this->Tahun_ECP->ViewCustomAttributes = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";

			// Perusahaan
			$this->Perusahaan->LinkCustomAttributes = "";
			$this->Perusahaan->HrefValue = "";
			$this->Perusahaan->TooltipValue = "";

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";
			$this->Alamat->TooltipValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";
			$this->Produk->TooltipValue = "";

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->LinkCustomAttributes = "";
			$this->Kapasitas_Produksi->HrefValue = "";
			$this->Kapasitas_Produksi->TooltipValue = "";

			// Omset
			$this->Omset->LinkCustomAttributes = "";
			$this->Omset->HrefValue = "";
			$this->Omset->TooltipValue = "";

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->LinkCustomAttributes = "";
			$this->Jumlah_Pegawai->HrefValue = "";
			$this->Jumlah_Pegawai->TooltipValue = "";

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->LinkCustomAttributes = "";
			$this->Legalitas_Perusahaan->HrefValue = "";
			$this->Legalitas_Perusahaan->TooltipValue = "";

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->LinkCustomAttributes = "";
			$this->Sertifikasi_dimiliki->HrefValue = "";
			$this->Sertifikasi_dimiliki->TooltipValue = "";

			// Handphone
			$this->Handphone->LinkCustomAttributes = "";
			$this->Handphone->HrefValue = "";
			$this->Handphone->TooltipValue = "";

			// Email_Add
			$this->Email_Add->LinkCustomAttributes = "";
			$this->Email_Add->HrefValue = "";
			$this->Email_Add->TooltipValue = "";

			// Website
			$this->Website->LinkCustomAttributes = "";
			$this->Website->HrefValue = "";
			$this->Website->TooltipValue = "";

			// Tahun_Berdiri
			$this->Tahun_Berdiri->LinkCustomAttributes = "";
			$this->Tahun_Berdiri->HrefValue = "";
			$this->Tahun_Berdiri->TooltipValue = "";

			// Alamat_Produksi
			$this->Alamat_Produksi->LinkCustomAttributes = "";
			$this->Alamat_Produksi->HrefValue = "";
			$this->Alamat_Produksi->TooltipValue = "";

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
			$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

			// Perusahaan
			$this->Perusahaan->EditAttrs["class"] = "form-control";
			$this->Perusahaan->EditCustomAttributes = "";
			if (!$this->Perusahaan->Raw)
				$this->Perusahaan->CurrentValue = HtmlDecode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->EditValue = HtmlEncode($this->Perusahaan->CurrentValue);
			$this->Perusahaan->PlaceHolder = RemoveHtml($this->Perusahaan->caption());

			// Alamat
			$this->Alamat->EditAttrs["class"] = "form-control";
			$this->Alamat->EditCustomAttributes = "";
			$this->Alamat->EditValue = HtmlEncode($this->Alamat->CurrentValue);
			$this->Alamat->PlaceHolder = RemoveHtml($this->Alamat->caption());

			// Produk
			$this->Produk->EditAttrs["class"] = "form-control";
			$this->Produk->EditCustomAttributes = "";
			if (!$this->Produk->Raw)
				$this->Produk->CurrentValue = HtmlDecode($this->Produk->CurrentValue);
			$this->Produk->EditValue = HtmlEncode($this->Produk->CurrentValue);
			$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->EditAttrs["class"] = "form-control";
			$this->Kapasitas_Produksi->EditCustomAttributes = "";
			if (!$this->Kapasitas_Produksi->Raw)
				$this->Kapasitas_Produksi->CurrentValue = HtmlDecode($this->Kapasitas_Produksi->CurrentValue);
			$this->Kapasitas_Produksi->EditValue = HtmlEncode($this->Kapasitas_Produksi->CurrentValue);
			$this->Kapasitas_Produksi->PlaceHolder = RemoveHtml($this->Kapasitas_Produksi->caption());

			// Omset
			$this->Omset->EditAttrs["class"] = "form-control";
			$this->Omset->EditCustomAttributes = "";
			if (!$this->Omset->Raw)
				$this->Omset->CurrentValue = HtmlDecode($this->Omset->CurrentValue);
			$this->Omset->EditValue = HtmlEncode($this->Omset->CurrentValue);
			$this->Omset->PlaceHolder = RemoveHtml($this->Omset->caption());

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->EditAttrs["class"] = "form-control";
			$this->Jumlah_Pegawai->EditCustomAttributes = "";
			if (!$this->Jumlah_Pegawai->Raw)
				$this->Jumlah_Pegawai->CurrentValue = HtmlDecode($this->Jumlah_Pegawai->CurrentValue);
			$this->Jumlah_Pegawai->EditValue = HtmlEncode($this->Jumlah_Pegawai->CurrentValue);
			$this->Jumlah_Pegawai->PlaceHolder = RemoveHtml($this->Jumlah_Pegawai->caption());

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->EditAttrs["class"] = "form-control";
			$this->Legalitas_Perusahaan->EditCustomAttributes = "";
			if (!$this->Legalitas_Perusahaan->Raw)
				$this->Legalitas_Perusahaan->CurrentValue = HtmlDecode($this->Legalitas_Perusahaan->CurrentValue);
			$this->Legalitas_Perusahaan->EditValue = HtmlEncode($this->Legalitas_Perusahaan->CurrentValue);
			$this->Legalitas_Perusahaan->PlaceHolder = RemoveHtml($this->Legalitas_Perusahaan->caption());

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->EditAttrs["class"] = "form-control";
			$this->Sertifikasi_dimiliki->EditCustomAttributes = "";
			if (!$this->Sertifikasi_dimiliki->Raw)
				$this->Sertifikasi_dimiliki->CurrentValue = HtmlDecode($this->Sertifikasi_dimiliki->CurrentValue);
			$this->Sertifikasi_dimiliki->EditValue = HtmlEncode($this->Sertifikasi_dimiliki->CurrentValue);
			$this->Sertifikasi_dimiliki->PlaceHolder = RemoveHtml($this->Sertifikasi_dimiliki->caption());

			// Handphone
			$this->Handphone->EditAttrs["class"] = "form-control";
			$this->Handphone->EditCustomAttributes = "";
			if (!$this->Handphone->Raw)
				$this->Handphone->CurrentValue = HtmlDecode($this->Handphone->CurrentValue);
			$this->Handphone->EditValue = HtmlEncode($this->Handphone->CurrentValue);
			$this->Handphone->PlaceHolder = RemoveHtml($this->Handphone->caption());

			// Email_Add
			$this->Email_Add->EditAttrs["class"] = "form-control";
			$this->Email_Add->EditCustomAttributes = "";
			if (!$this->Email_Add->Raw)
				$this->Email_Add->CurrentValue = HtmlDecode($this->Email_Add->CurrentValue);
			$this->Email_Add->EditValue = HtmlEncode($this->Email_Add->CurrentValue);
			$this->Email_Add->PlaceHolder = RemoveHtml($this->Email_Add->caption());

			// Website
			$this->Website->EditAttrs["class"] = "form-control";
			$this->Website->EditCustomAttributes = "";
			if (!$this->Website->Raw)
				$this->Website->CurrentValue = HtmlDecode($this->Website->CurrentValue);
			$this->Website->EditValue = HtmlEncode($this->Website->CurrentValue);
			$this->Website->PlaceHolder = RemoveHtml($this->Website->caption());

			// Tahun_Berdiri
			$this->Tahun_Berdiri->EditAttrs["class"] = "form-control";
			$this->Tahun_Berdiri->EditCustomAttributes = "";
			if (!$this->Tahun_Berdiri->Raw)
				$this->Tahun_Berdiri->CurrentValue = HtmlDecode($this->Tahun_Berdiri->CurrentValue);
			$this->Tahun_Berdiri->EditValue = HtmlEncode($this->Tahun_Berdiri->CurrentValue);
			$this->Tahun_Berdiri->PlaceHolder = RemoveHtml($this->Tahun_Berdiri->caption());

			// Alamat_Produksi
			$this->Alamat_Produksi->EditAttrs["class"] = "form-control";
			$this->Alamat_Produksi->EditCustomAttributes = "";
			$this->Alamat_Produksi->EditValue = HtmlEncode($this->Alamat_Produksi->CurrentValue);
			$this->Alamat_Produksi->PlaceHolder = RemoveHtml($this->Alamat_Produksi->caption());

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

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";

			// Produk
			$this->Produk->LinkCustomAttributes = "";
			$this->Produk->HrefValue = "";

			// Kapasitas_Produksi
			$this->Kapasitas_Produksi->LinkCustomAttributes = "";
			$this->Kapasitas_Produksi->HrefValue = "";

			// Omset
			$this->Omset->LinkCustomAttributes = "";
			$this->Omset->HrefValue = "";

			// Jumlah_Pegawai
			$this->Jumlah_Pegawai->LinkCustomAttributes = "";
			$this->Jumlah_Pegawai->HrefValue = "";

			// Legalitas_Perusahaan
			$this->Legalitas_Perusahaan->LinkCustomAttributes = "";
			$this->Legalitas_Perusahaan->HrefValue = "";

			// Sertifikasi_dimiliki
			$this->Sertifikasi_dimiliki->LinkCustomAttributes = "";
			$this->Sertifikasi_dimiliki->HrefValue = "";

			// Handphone
			$this->Handphone->LinkCustomAttributes = "";
			$this->Handphone->HrefValue = "";

			// Email_Add
			$this->Email_Add->LinkCustomAttributes = "";
			$this->Email_Add->HrefValue = "";

			// Website
			$this->Website->LinkCustomAttributes = "";
			$this->Website->HrefValue = "";

			// Tahun_Berdiri
			$this->Tahun_Berdiri->LinkCustomAttributes = "";
			$this->Tahun_Berdiri->HrefValue = "";

			// Alamat_Produksi
			$this->Alamat_Produksi->LinkCustomAttributes = "";
			$this->Alamat_Produksi->HrefValue = "";

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
		if ($this->Alamat->Required) {
			if (!$this->Alamat->IsDetailKey && $this->Alamat->FormValue != NULL && $this->Alamat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Alamat->caption(), $this->Alamat->RequiredErrorMessage));
			}
		}
		if ($this->Produk->Required) {
			if (!$this->Produk->IsDetailKey && $this->Produk->FormValue != NULL && $this->Produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Produk->caption(), $this->Produk->RequiredErrorMessage));
			}
		}
		if ($this->Kapasitas_Produksi->Required) {
			if (!$this->Kapasitas_Produksi->IsDetailKey && $this->Kapasitas_Produksi->FormValue != NULL && $this->Kapasitas_Produksi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Kapasitas_Produksi->caption(), $this->Kapasitas_Produksi->RequiredErrorMessage));
			}
		}
		if ($this->Omset->Required) {
			if (!$this->Omset->IsDetailKey && $this->Omset->FormValue != NULL && $this->Omset->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Omset->caption(), $this->Omset->RequiredErrorMessage));
			}
		}
		if ($this->Jumlah_Pegawai->Required) {
			if (!$this->Jumlah_Pegawai->IsDetailKey && $this->Jumlah_Pegawai->FormValue != NULL && $this->Jumlah_Pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Jumlah_Pegawai->caption(), $this->Jumlah_Pegawai->RequiredErrorMessage));
			}
		}
		if ($this->Legalitas_Perusahaan->Required) {
			if (!$this->Legalitas_Perusahaan->IsDetailKey && $this->Legalitas_Perusahaan->FormValue != NULL && $this->Legalitas_Perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Legalitas_Perusahaan->caption(), $this->Legalitas_Perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->Sertifikasi_dimiliki->Required) {
			if (!$this->Sertifikasi_dimiliki->IsDetailKey && $this->Sertifikasi_dimiliki->FormValue != NULL && $this->Sertifikasi_dimiliki->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Sertifikasi_dimiliki->caption(), $this->Sertifikasi_dimiliki->RequiredErrorMessage));
			}
		}
		if ($this->Handphone->Required) {
			if (!$this->Handphone->IsDetailKey && $this->Handphone->FormValue != NULL && $this->Handphone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Handphone->caption(), $this->Handphone->RequiredErrorMessage));
			}
		}
		if ($this->Email_Add->Required) {
			if (!$this->Email_Add->IsDetailKey && $this->Email_Add->FormValue != NULL && $this->Email_Add->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Email_Add->caption(), $this->Email_Add->RequiredErrorMessage));
			}
		}
		if ($this->Website->Required) {
			if (!$this->Website->IsDetailKey && $this->Website->FormValue != NULL && $this->Website->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Website->caption(), $this->Website->RequiredErrorMessage));
			}
		}
		if ($this->Tahun_Berdiri->Required) {
			if (!$this->Tahun_Berdiri->IsDetailKey && $this->Tahun_Berdiri->FormValue != NULL && $this->Tahun_Berdiri->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tahun_Berdiri->caption(), $this->Tahun_Berdiri->RequiredErrorMessage));
			}
		}
		if ($this->Alamat_Produksi->Required) {
			if (!$this->Alamat_Produksi->IsDetailKey && $this->Alamat_Produksi->FormValue != NULL && $this->Alamat_Produksi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Alamat_Produksi->caption(), $this->Alamat_Produksi->RequiredErrorMessage));
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

		// Alamat
		$this->Alamat->setDbValueDef($rsnew, $this->Alamat->CurrentValue, NULL, FALSE);

		// Produk
		$this->Produk->setDbValueDef($rsnew, $this->Produk->CurrentValue, NULL, FALSE);

		// Kapasitas_Produksi
		$this->Kapasitas_Produksi->setDbValueDef($rsnew, $this->Kapasitas_Produksi->CurrentValue, NULL, FALSE);

		// Omset
		$this->Omset->setDbValueDef($rsnew, $this->Omset->CurrentValue, NULL, FALSE);

		// Jumlah_Pegawai
		$this->Jumlah_Pegawai->setDbValueDef($rsnew, $this->Jumlah_Pegawai->CurrentValue, NULL, FALSE);

		// Legalitas_Perusahaan
		$this->Legalitas_Perusahaan->setDbValueDef($rsnew, $this->Legalitas_Perusahaan->CurrentValue, NULL, FALSE);

		// Sertifikasi_dimiliki
		$this->Sertifikasi_dimiliki->setDbValueDef($rsnew, $this->Sertifikasi_dimiliki->CurrentValue, NULL, FALSE);

		// Handphone
		$this->Handphone->setDbValueDef($rsnew, $this->Handphone->CurrentValue, NULL, FALSE);

		// Email_Add
		$this->Email_Add->setDbValueDef($rsnew, $this->Email_Add->CurrentValue, NULL, FALSE);

		// Website
		$this->Website->setDbValueDef($rsnew, $this->Website->CurrentValue, NULL, FALSE);

		// Tahun_Berdiri
		$this->Tahun_Berdiri->setDbValueDef($rsnew, $this->Tahun_Berdiri->CurrentValue, NULL, FALSE);

		// Alamat_Produksi
		$this->Alamat_Produksi->setDbValueDef($rsnew, $this->Alamat_Produksi->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("dm_pesertaecplist.php"), "", $this->TableVar, TRUE);
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