<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_peserta_delete extends t_peserta
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_peserta';

	// Page object name
	public $PageObjName = "t_peserta_delete";

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

		// Table object (t_peserta)
		if (!isset($GLOBALS["t_peserta"]) || get_class($GLOBALS["t_peserta"]) == PROJECT_NAMESPACE . "t_peserta") {
			$GLOBALS["t_peserta"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_peserta"];
		}

		// Table object (t_kota)
		if (!isset($GLOBALS['t_kota']))
			$GLOBALS['t_kota'] = new t_kota();

		// Table object (t_perusahaan)
		if (!isset($GLOBALS['t_perusahaan']))
			$GLOBALS['t_perusahaan'] = new t_perusahaan();

		// Table object (t_prop)
		if (!isset($GLOBALS['t_prop']))
			$GLOBALS['t_prop'] = new t_prop();

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_peserta');

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
		global $t_peserta;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_peserta);
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
			$key .= @$ar['id'];
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
			$this->id->Visible = FALSE;
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
					$this->terminate(GetUrl("t_pesertalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->setVisibility();
		$this->nama->setVisibility();
		$this->idp->setVisibility();
		$this->tempat->setVisibility();
		$this->tlahir->Visible = FALSE;
		$this->usia->Visible = FALSE;
		$this->kdagama->setVisibility();
		$this->kdsex->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->alamat->setVisibility();
		$this->kdpos->Visible = FALSE;
		$this->telp->setVisibility();
		$this->hp->setVisibility();
		$this->_email->Visible = FALSE;
		$this->kdjabat->setVisibility();
		$this->kdpend->setVisibility();
		$this->kdbahasa->setVisibility();
		$this->kdinformasi->Visible = FALSE;
		$this->harapan->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->jpelatihan->setVisibility();
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
		$this->setupLookupOptions($this->id);
		$this->setupLookupOptions($this->idp);
		$this->setupLookupOptions($this->kdagama);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);
		$this->setupLookupOptions($this->kdkec);
		$this->setupLookupOptions($this->kdjabat);
		$this->setupLookupOptions($this->kdpend);
		$this->setupLookupOptions($this->kdbahasa);
		$this->setupLookupOptions($this->kdinformasi);

		// Check permission
		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_pesertalist.php");
			return;
		}

		// Set up master/detail parameters
		$this->setupMasterParms();

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("t_pesertalist.php"); // Prevent SQL injection, return to list
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
				$this->terminate("t_pesertalist.php"); // Return to list
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
		$this->id->setDbValue($row['id']);
		$this->nama->setDbValue($row['nama']);
		$this->idp->setDbValue($row['idp']);
		if (array_key_exists('EV__idp', $rs->fields)) {
			$this->idp->VirtualValue = $rs->fields('EV__idp'); // Set up virtual field value
		} else {
			$this->idp->VirtualValue = ""; // Clear value
		}
		$this->tempat->setDbValue($row['tempat']);
		$this->tlahir->setDbValue($row['tlahir']);
		$this->usia->setDbValue($row['usia']);
		$this->kdagama->setDbValue($row['kdagama']);
		$this->kdsex->setDbValue($row['kdsex']);
		$this->kdprop->setDbValue($row['kdprop']);
		if (array_key_exists('EV__kdprop', $rs->fields)) {
			$this->kdprop->VirtualValue = $rs->fields('EV__kdprop'); // Set up virtual field value
		} else {
			$this->kdprop->VirtualValue = ""; // Clear value
		}
		$this->kdkota->setDbValue($row['kdkota']);
		if (array_key_exists('EV__kdkota', $rs->fields)) {
			$this->kdkota->VirtualValue = $rs->fields('EV__kdkota'); // Set up virtual field value
		} else {
			$this->kdkota->VirtualValue = ""; // Clear value
		}
		$this->kdkec->setDbValue($row['kdkec']);
		if (array_key_exists('EV__kdkec', $rs->fields)) {
			$this->kdkec->VirtualValue = $rs->fields('EV__kdkec'); // Set up virtual field value
		} else {
			$this->kdkec->VirtualValue = ""; // Clear value
		}
		$this->alamat->setDbValue($row['alamat']);
		$this->kdpos->setDbValue($row['kdpos']);
		$this->telp->setDbValue($row['telp']);
		$this->hp->setDbValue($row['hp']);
		$this->_email->setDbValue($row['email']);
		$this->kdjabat->setDbValue($row['kdjabat']);
		$this->kdpend->setDbValue($row['kdpend']);
		$this->kdbahasa->setDbValue($row['kdbahasa']);
		$this->kdinformasi->setDbValue($row['kdinformasi']);
		$this->harapan->setDbValue($row['harapan']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->jpelatihan->setDbValue($row['jpelatihan']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['nama'] = NULL;
		$row['idp'] = NULL;
		$row['tempat'] = NULL;
		$row['tlahir'] = NULL;
		$row['usia'] = NULL;
		$row['kdagama'] = NULL;
		$row['kdsex'] = NULL;
		$row['kdprop'] = NULL;
		$row['kdkota'] = NULL;
		$row['kdkec'] = NULL;
		$row['alamat'] = NULL;
		$row['kdpos'] = NULL;
		$row['telp'] = NULL;
		$row['hp'] = NULL;
		$row['email'] = NULL;
		$row['kdjabat'] = NULL;
		$row['kdpend'] = NULL;
		$row['kdbahasa'] = NULL;
		$row['kdinformasi'] = NULL;
		$row['harapan'] = NULL;
		$row['created_at'] = NULL;
		$row['updated_at'] = NULL;
		$row['jpelatihan'] = NULL;
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
		// id
		// nama
		// idp
		// tempat
		// tlahir
		// usia

		$this->usia->CellCssStyle = "white-space: nowrap;";

		// kdagama
		// kdsex
		// kdprop
		// kdkota
		// kdkec
		// alamat
		// kdpos
		// telp
		// hp
		// email
		// kdjabat
		// kdpend
		// kdbahasa
		// kdinformasi
		// harapan
		// created_at
		// updated_at
		// jpelatihan

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$curVal = strval($this->id->CurrentValue);
			if ($curVal != "") {
				$this->id->ViewValue = $this->id->lookupCacheOption($curVal);
				if ($this->id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->id->ViewValue = $this->id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id->ViewValue = $this->id->CurrentValue;
					}
				}
			} else {
				$this->id->ViewValue = NULL;
			}
			$this->id->ViewCustomAttributes = "";

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// idp
			if ($this->idp->VirtualValue != "") {
				$this->idp->ViewValue = $this->idp->VirtualValue;
			} else {
				$this->idp->ViewValue = $this->idp->CurrentValue;
				$curVal = strval($this->idp->CurrentValue);
				if ($curVal != "") {
					$this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
					if ($this->idp->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->idp->ViewValue = $this->idp->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->idp->ViewValue = $this->idp->CurrentValue;
						}
					}
				} else {
					$this->idp->ViewValue = NULL;
				}
			}
			$this->idp->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// tlahir
			$this->tlahir->ViewValue = $this->tlahir->CurrentValue;
			$this->tlahir->ViewValue = FormatDateTime($this->tlahir->ViewValue, 0);
			$this->tlahir->ViewCustomAttributes = "";

			// kdagama
			$curVal = strval($this->kdagama->CurrentValue);
			if ($curVal != "") {
				$this->kdagama->ViewValue = $this->kdagama->lookupCacheOption($curVal);
				if ($this->kdagama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdagama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdagama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdagama->ViewValue = $this->kdagama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdagama->ViewValue = $this->kdagama->CurrentValue;
					}
				}
			} else {
				$this->kdagama->ViewValue = NULL;
			}
			$this->kdagama->ViewCustomAttributes = "";

			// kdsex
			if (strval($this->kdsex->CurrentValue) != "") {
				$this->kdsex->ViewValue = $this->kdsex->optionCaption($this->kdsex->CurrentValue);
			} else {
				$this->kdsex->ViewValue = NULL;
			}
			$this->kdsex->ViewCustomAttributes = "";

			// kdprop
			if ($this->kdprop->VirtualValue != "") {
				$this->kdprop->ViewValue = $this->kdprop->VirtualValue;
			} else {
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
			}
			$this->kdprop->ViewCustomAttributes = "";

			// kdkota
			if ($this->kdkota->VirtualValue != "") {
				$this->kdkota->ViewValue = $this->kdkota->VirtualValue;
			} else {
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

			// alamat
			$this->alamat->ViewValue = $this->alamat->CurrentValue;
			$this->alamat->ViewCustomAttributes = "";

			// kdpos
			$this->kdpos->ViewValue = $this->kdpos->CurrentValue;
			$this->kdpos->ViewCustomAttributes = "";

			// telp
			$this->telp->ViewValue = $this->telp->CurrentValue;
			$this->telp->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// kdjabat
			$curVal = strval($this->kdjabat->CurrentValue);
			if ($curVal != "") {
				$this->kdjabat->ViewValue = $this->kdjabat->lookupCacheOption($curVal);
				if ($this->kdjabat->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdjabat->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdjabat->ViewValue = $this->kdjabat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdjabat->ViewValue = $this->kdjabat->CurrentValue;
					}
				}
			} else {
				$this->kdjabat->ViewValue = NULL;
			}
			$this->kdjabat->ViewCustomAttributes = "";

			// kdpend
			$curVal = strval($this->kdpend->CurrentValue);
			if ($curVal != "") {
				$this->kdpend->ViewValue = $this->kdpend->lookupCacheOption($curVal);
				if ($this->kdpend->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdpend`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdpend->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdpend->ViewValue = $this->kdpend->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdpend->ViewValue = $this->kdpend->CurrentValue;
					}
				}
			} else {
				$this->kdpend->ViewValue = NULL;
			}
			$this->kdpend->ViewCustomAttributes = "";

			// kdbahasa
			$curVal = strval($this->kdbahasa->CurrentValue);
			if ($curVal != "") {
				$this->kdbahasa->ViewValue = $this->kdbahasa->lookupCacheOption($curVal);
				if ($this->kdbahasa->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdbahasa`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdbahasa->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdbahasa->ViewValue = $this->kdbahasa->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdbahasa->ViewValue = $this->kdbahasa->CurrentValue;
					}
				}
			} else {
				$this->kdbahasa->ViewValue = NULL;
			}
			$this->kdbahasa->ViewCustomAttributes = "";

			// jpelatihan
			$this->jpelatihan->ViewValue = $this->jpelatihan->CurrentValue;
			$this->jpelatihan->CellCssStyle .= "text-align: center;";
			$this->jpelatihan->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

			// idp
			$this->idp->LinkCustomAttributes = "";
			$this->idp->HrefValue = "";
			$this->idp->TooltipValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// kdagama
			$this->kdagama->LinkCustomAttributes = "";
			$this->kdagama->HrefValue = "";
			$this->kdagama->TooltipValue = "";

			// kdsex
			$this->kdsex->LinkCustomAttributes = "";
			$this->kdsex->HrefValue = "";
			$this->kdsex->TooltipValue = "";

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

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";
			$this->alamat->TooltipValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";
			$this->telp->TooltipValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";
			$this->hp->TooltipValue = "";

			// kdjabat
			$this->kdjabat->LinkCustomAttributes = "";
			$this->kdjabat->HrefValue = "";
			$this->kdjabat->TooltipValue = "";

			// kdpend
			$this->kdpend->LinkCustomAttributes = "";
			$this->kdpend->HrefValue = "";
			$this->kdpend->TooltipValue = "";

			// kdbahasa
			$this->kdbahasa->LinkCustomAttributes = "";
			$this->kdbahasa->HrefValue = "";
			$this->kdbahasa->TooltipValue = "";

			// jpelatihan
			$this->jpelatihan->LinkCustomAttributes = "";
			$this->jpelatihan->HrefValue = "";
			$this->jpelatihan->TooltipValue = "";
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
				$thisKey .= $row['id'];
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
			if ($masterTblVar == "t_perusahaan") {
				$validMaster = TRUE;
				if (($parm = Get("fk_idp", Get("idp"))) !== NULL) {
					$GLOBALS["t_perusahaan"]->idp->setQueryStringValue($parm);
					$this->idp->setQueryStringValue($GLOBALS["t_perusahaan"]->idp->QueryStringValue);
					$this->idp->setSessionValue($this->idp->QueryStringValue);
					if (!is_numeric($GLOBALS["t_perusahaan"]->idp->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_kota") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdkota", Get("kdkota"))) !== NULL) {
					$GLOBALS["t_kota"]->kdkota->setQueryStringValue($parm);
					$this->kdkota->setQueryStringValue($GLOBALS["t_kota"]->kdkota->QueryStringValue);
					$this->kdkota->setSessionValue($this->kdkota->QueryStringValue);
					if (!is_numeric($GLOBALS["t_kota"]->kdkota->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_prop") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdprop", Get("kdprop"))) !== NULL) {
					$GLOBALS["t_prop"]->kdprop->setQueryStringValue($parm);
					$this->kdprop->setQueryStringValue($GLOBALS["t_prop"]->kdprop->QueryStringValue);
					$this->kdprop->setSessionValue($this->kdprop->QueryStringValue);
					if (!is_numeric($GLOBALS["t_prop"]->kdprop->QueryStringValue))
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
			if ($masterTblVar == "t_perusahaan") {
				$validMaster = TRUE;
				if (($parm = Post("fk_idp", Post("idp"))) !== NULL) {
					$GLOBALS["t_perusahaan"]->idp->setFormValue($parm);
					$this->idp->setFormValue($GLOBALS["t_perusahaan"]->idp->FormValue);
					$this->idp->setSessionValue($this->idp->FormValue);
					if (!is_numeric($GLOBALS["t_perusahaan"]->idp->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_kota") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdkota", Post("kdkota"))) !== NULL) {
					$GLOBALS["t_kota"]->kdkota->setFormValue($parm);
					$this->kdkota->setFormValue($GLOBALS["t_kota"]->kdkota->FormValue);
					$this->kdkota->setSessionValue($this->kdkota->FormValue);
					if (!is_numeric($GLOBALS["t_kota"]->kdkota->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "t_prop") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdprop", Post("kdprop"))) !== NULL) {
					$GLOBALS["t_prop"]->kdprop->setFormValue($parm);
					$this->kdprop->setFormValue($GLOBALS["t_prop"]->kdprop->FormValue);
					$this->kdprop->setSessionValue($this->kdprop->FormValue);
					if (!is_numeric($GLOBALS["t_prop"]->kdprop->FormValue))
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
			if ($masterTblVar != "t_perusahaan") {
				if ($this->idp->CurrentValue == "")
					$this->idp->setSessionValue("");
			}
			if ($masterTblVar != "t_kota") {
				if ($this->kdkota->CurrentValue == "")
					$this->kdkota->setSessionValue("");
			}
			if ($masterTblVar != "t_prop") {
				if ($this->kdprop->CurrentValue == "")
					$this->kdprop->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_pesertalist.php"), "", $this->TableVar, TRUE);
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
				case "x_id":
					break;
				case "x_idp":
					break;
				case "x_kdagama":
					break;
				case "x_kdsex":
					break;
				case "x_kdprop":
					break;
				case "x_kdkota":
					break;
				case "x_kdkec":
					break;
				case "x_kdjabat":
					break;
				case "x_kdpend":
					break;
				case "x_kdbahasa":
					break;
				case "x_kdinformasi":
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
						case "x_id":
							break;
						case "x_idp":
							break;
						case "x_kdagama":
							break;
						case "x_kdprop":
							break;
						case "x_kdkota":
							break;
						case "x_kdkec":
							break;
						case "x_kdjabat":
							break;
						case "x_kdpend":
							break;
						case "x_kdbahasa":
							break;
						case "x_kdinformasi":
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