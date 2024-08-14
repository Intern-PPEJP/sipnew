<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_perusahaan_delete extends t_perusahaan
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_perusahaan';

	// Page object name
	public $PageObjName = "t_perusahaan_delete";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

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
			SaveDebugMessage();
			AddHeader("Location", $url);
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

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $TotalRecords = 0;
	public $RecordCount;
	public $RecKeys = [];
	public $StartRowCount = 1;
	public $RowCount = 0;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canDelete()) {
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
			if (!$Security->canDelete()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_perusahaanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->namap->setVisibility();
		$this->idp->setVisibility();
		$this->kontak->setVisibility();
		$this->kdlokasi->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->alamatp->setVisibility();
		$this->kdpos->Visible = FALSE;
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
		$this->omzet_saat_ini->Visible = FALSE;
		$this->omzet_stl_6bln->Visible = FALSE;
		$this->omzet_stl_1thn->Visible = FALSE;
		$this->omzet_stl_2thn->Visible = FALSE;
		$this->kapasitas_saat_ini->Visible = FALSE;
		$this->kapasitas_stl_6bln->Visible = FALSE;
		$this->kapasitas_stl_1thn->Visible = FALSE;
		$this->kapasitas_stl_2thn->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->user_created_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->user_updated_by->Visible = FALSE;
		$this->jpeserta->setVisibility();
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
		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_perusahaanlist.php");
			return;
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("t_perusahaanlist.php"); // Prevent SQL injection, return to list
			return;
		}

		// Set up filter (WHERE Clause)
		$this->CurrentFilter = $filter;

		// Get action
		if (IsApi()) {
			$this->CurrentAction = "delete"; // Delete record directly
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action");
		} elseif (Get("action") == "1") {
			$this->CurrentAction = "delete"; // Delete record directly
		} else {
			$this->CurrentAction = "show"; // Display record
		}
		if ($this->isDelete()) {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->deleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
				if (IsApi()) {
					$this->terminate(TRUE);
					return;
				} else {
					$this->terminate($this->getReturnUrl()); // Return to caller
				}
			} else { // Delete failed
				if (IsApi()) {
					$this->terminate();
					return;
				}
				$this->CurrentAction = "show"; // Display record
			}
		}
		if ($this->isShow()) { // Load records for display
			if ($this->Recordset = $this->loadRecordset())
				$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->close();
				$this->terminate("t_perusahaanlist.php"); // Return to list
			}
		}
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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

			// idp
			$this->idp->ViewValue = $this->idp->CurrentValue;
			$arwrk = [];
			$arwrk[1] = $this->namap->CurrentValue;
			$this->idp->ViewValue = $this->idp->displayValue($arwrk);
			$this->idp->ViewCustomAttributes = "";

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

			// jpeserta
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->ViewCustomAttributes = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";
			$this->namap->TooltipValue = "";

			// idp
			$this->idp->LinkCustomAttributes = "";
			$this->idp->HrefValue = "";
			$this->idp->TooltipValue = "";

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

			// jpeserta
			$this->jpeserta->LinkCustomAttributes = "";
			$this->jpeserta->HrefValue = "";
			$this->jpeserta->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		$conn->beginTrans();
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['idp'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}
		if ($deleteRows) {
			$conn->commitTrans(); // Commit the changes
			if ($this->AuditTrailOnDelete)
				$this->writeAuditTrailDummy($Language->phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->rollbackTrans(); // Rollback changes
			if ($this->AuditTrailOnDelete)
				$this->writeAuditTrailDummy($Language->phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_perusahaanlist.php"), "", $this->TableVar, TRUE);
		$pageId = "delete";
		$Breadcrumb->add("delete", $pageId, $url);
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
} // End class
?>