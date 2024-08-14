<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_pcp_grid extends t_pcp
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_pcp';

	// Page object name
	public $PageObjName = "t_pcp_grid";

	// Grid form hidden field names
	public $FormName = "ft_pcpgrid";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

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
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (t_pcp)
		if (!isset($GLOBALS["t_pcp"]) || get_class($GLOBALS["t_pcp"]) == PROJECT_NAMESPACE . "t_pcp") {
			$GLOBALS["t_pcp"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["t_pcp"];

		}
		$this->AddUrl = "t_pcpadd.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_pcp');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Export
		global $t_pcp;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_pcp);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

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
		$this->f_npwp->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_npwp->UploadPath = $this->f_npwp->OldUploadPath;
		$this->f_nib->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_nib->UploadPath = $this->f_nib->OldUploadPath;
		$this->f_siup->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_siup->UploadPath = $this->f_siup->OldUploadPath;
		$this->f_tdp->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_tdp->UploadPath = $this->f_tdp->OldUploadPath;
		$this->f_lain->OldUploadPath = "berkas/legalitas_ecp/";
		$this->f_lain->UploadPath = $this->f_lain->OldUploadPath;
		$this->f_sertifikat->OldUploadPath = "berkas/sertifikat_ecp/";
		$this->f_sertifikat->UploadPath = $this->f_sertifikat->OldUploadPath;
		$this->f_kartunama->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_kartunama->UploadPath = $this->f_kartunama->OldUploadPath;
		$this->f_brosur->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_brosur->UploadPath = $this->f_brosur->OldUploadPath;
		$this->f_katalog->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_katalog->UploadPath = $this->f_katalog->OldUploadPath;
		$this->f_profile->OldUploadPath = "berkas/promosi_ecp/";
		$this->f_profile->UploadPath = $this->f_profile->OldUploadPath;
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $ShowOtherOptions = FALSE;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,100,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->id->Visible = FALSE;
		$this->rkid->Visible = FALSE;
		$this->nama_peserta->setVisibility();
		$this->email_add->setVisibility();
		$this->handphone->setVisibility();
		$this->namap->setVisibility();
		$this->tahun_berdiri->Visible = FALSE;
		$this->alamat->Visible = FALSE;
		$this->alamat_prod->Visible = FALSE;
		$this->kategori_produk->setVisibility();
		$this->kategori_produk2->setVisibility();
		$this->kategori_produk3->setVisibility();
		$this->produk->setVisibility();
		$this->merek_dagang->setVisibility();
		$this->jenis_perusahaan->setVisibility();
		$this->kapasitas_produksi->setVisibility();
		$this->omset->setVisibility();
		$this->website->setVisibility();
		$this->fb->Visible = FALSE;
		$this->ig->Visible = FALSE;
		$this->sosmed_lain->Visible = FALSE;
		$this->jml_pegawai->setVisibility();
		$this->jml_pegawai2->setVisibility();
		$this->jml_pegawai_tidaktetap->setVisibility();
		$this->legalitas->setVisibility();
		$this->legalitas_lain->setVisibility();
		$this->f_npwp->Visible = FALSE;
		$this->f_nib->Visible = FALSE;
		$this->f_siup->Visible = FALSE;
		$this->f_tdp->Visible = FALSE;
		$this->f_lain->Visible = FALSE;
		$this->sertifikat->setVisibility();
		$this->sertifikat_lain->setVisibility();
		$this->f_sertifikat->Visible = FALSE;
		$this->alat_promosi->setVisibility();
		$this->promosi_lain->setVisibility();
		$this->f_kartunama->Visible = FALSE;
		$this->f_brosur->Visible = FALSE;
		$this->f_katalog->Visible = FALSE;
		$this->f_profile->Visible = FALSE;
		$this->tahun_ecp->setVisibility();
		$this->wilayah_ecp->setVisibility();
		$this->hideFieldsForAddEdit();

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

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		$this->setupLookupOptions($this->namap);
		$this->setupLookupOptions($this->kategori_produk);
		$this->setupLookupOptions($this->kategori_produk2);
		$this->setupLookupOptions($this->kategori_produk3);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "excp") {
			global $excp;
			$rsmaster = $excp->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("excplist.php"); // Return to master page
			} else {
				$excp->loadListRowValues($rsmaster);
				$excp->RowType = ROWTYPE_MASTER; // Master row
				$excp->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecords = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecords = $this->Recordset->RecordCount();
				}
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->TotalRecords;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->GridAddRowCount;
			}
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->TotalRecords; // Display all records
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
		}

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new NumericPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->id->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_nama_peserta") && $CurrentForm->hasValue("o_nama_peserta") && $this->nama_peserta->CurrentValue != $this->nama_peserta->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_email_add") && $CurrentForm->hasValue("o_email_add") && $this->email_add->CurrentValue != $this->email_add->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_handphone") && $CurrentForm->hasValue("o_handphone") && $this->handphone->CurrentValue != $this->handphone->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_namap") && $CurrentForm->hasValue("o_namap") && $this->namap->CurrentValue != $this->namap->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kategori_produk") && $CurrentForm->hasValue("o_kategori_produk") && $this->kategori_produk->CurrentValue != $this->kategori_produk->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kategori_produk2") && $CurrentForm->hasValue("o_kategori_produk2") && $this->kategori_produk2->CurrentValue != $this->kategori_produk2->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kategori_produk3") && $CurrentForm->hasValue("o_kategori_produk3") && $this->kategori_produk3->CurrentValue != $this->kategori_produk3->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_produk") && $CurrentForm->hasValue("o_produk") && $this->produk->CurrentValue != $this->produk->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_merek_dagang") && $CurrentForm->hasValue("o_merek_dagang") && $this->merek_dagang->CurrentValue != $this->merek_dagang->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jenis_perusahaan") && $CurrentForm->hasValue("o_jenis_perusahaan") && $this->jenis_perusahaan->CurrentValue != $this->jenis_perusahaan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kapasitas_produksi") && $CurrentForm->hasValue("o_kapasitas_produksi") && $this->kapasitas_produksi->CurrentValue != $this->kapasitas_produksi->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_omset") && $CurrentForm->hasValue("o_omset") && $this->omset->CurrentValue != $this->omset->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_website") && $CurrentForm->hasValue("o_website") && $this->website->CurrentValue != $this->website->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jml_pegawai") && $CurrentForm->hasValue("o_jml_pegawai") && $this->jml_pegawai->CurrentValue != $this->jml_pegawai->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jml_pegawai2") && $CurrentForm->hasValue("o_jml_pegawai2") && $this->jml_pegawai2->CurrentValue != $this->jml_pegawai2->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jml_pegawai_tidaktetap") && $CurrentForm->hasValue("o_jml_pegawai_tidaktetap") && $this->jml_pegawai_tidaktetap->CurrentValue != $this->jml_pegawai_tidaktetap->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_legalitas") && $CurrentForm->hasValue("o_legalitas") && $this->legalitas->CurrentValue != $this->legalitas->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_legalitas_lain") && $CurrentForm->hasValue("o_legalitas_lain") && $this->legalitas_lain->CurrentValue != $this->legalitas_lain->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_sertifikat") && $CurrentForm->hasValue("o_sertifikat") && $this->sertifikat->CurrentValue != $this->sertifikat->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_sertifikat_lain") && $CurrentForm->hasValue("o_sertifikat_lain") && $this->sertifikat_lain->CurrentValue != $this->sertifikat_lain->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_alat_promosi") && $CurrentForm->hasValue("o_alat_promosi") && $this->alat_promosi->CurrentValue != $this->alat_promosi->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_promosi_lain") && $CurrentForm->hasValue("o_promosi_lain") && $this->promosi_lain->CurrentValue != $this->promosi_lain->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tahun_ecp") && $CurrentForm->hasValue("o_tahun_ecp") && $this->tahun_ecp->CurrentValue != $this->tahun_ecp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_wilayah_ecp") && $CurrentForm->hasValue("o_wilayah_ecp") && $this->wilayah_ecp->CurrentValue != $this->wilayah_ecp->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->rkid->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

		// "sequence"
		$item = &$this->ListOptions->add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$opt = $this->ListOptions["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecordCount);
		if ($this->CurrentMode == "view") { // View mode

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"t_pcp\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->id->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('id');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = $this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		}
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = $options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = $Security->canAdd();
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = $options["addedit"];
			$item = $option["add"];
			$this->ShowOtherOptions = $item && $item->Visible;
		}
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->rkid->CurrentValue = NULL;
		$this->rkid->OldValue = $this->rkid->CurrentValue;
		$this->nama_peserta->CurrentValue = NULL;
		$this->nama_peserta->OldValue = $this->nama_peserta->CurrentValue;
		$this->email_add->CurrentValue = NULL;
		$this->email_add->OldValue = $this->email_add->CurrentValue;
		$this->handphone->CurrentValue = NULL;
		$this->handphone->OldValue = $this->handphone->CurrentValue;
		$this->namap->CurrentValue = NULL;
		$this->namap->OldValue = $this->namap->CurrentValue;
		$this->tahun_berdiri->CurrentValue = NULL;
		$this->tahun_berdiri->OldValue = $this->tahun_berdiri->CurrentValue;
		$this->alamat->CurrentValue = NULL;
		$this->alamat->OldValue = $this->alamat->CurrentValue;
		$this->alamat_prod->CurrentValue = NULL;
		$this->alamat_prod->OldValue = $this->alamat_prod->CurrentValue;
		$this->kategori_produk->CurrentValue = NULL;
		$this->kategori_produk->OldValue = $this->kategori_produk->CurrentValue;
		$this->kategori_produk2->CurrentValue = NULL;
		$this->kategori_produk2->OldValue = $this->kategori_produk2->CurrentValue;
		$this->kategori_produk3->CurrentValue = NULL;
		$this->kategori_produk3->OldValue = $this->kategori_produk3->CurrentValue;
		$this->produk->CurrentValue = NULL;
		$this->produk->OldValue = $this->produk->CurrentValue;
		$this->merek_dagang->CurrentValue = NULL;
		$this->merek_dagang->OldValue = $this->merek_dagang->CurrentValue;
		$this->jenis_perusahaan->CurrentValue = NULL;
		$this->jenis_perusahaan->OldValue = $this->jenis_perusahaan->CurrentValue;
		$this->kapasitas_produksi->CurrentValue = NULL;
		$this->kapasitas_produksi->OldValue = $this->kapasitas_produksi->CurrentValue;
		$this->omset->CurrentValue = NULL;
		$this->omset->OldValue = $this->omset->CurrentValue;
		$this->website->CurrentValue = NULL;
		$this->website->OldValue = $this->website->CurrentValue;
		$this->fb->CurrentValue = NULL;
		$this->fb->OldValue = $this->fb->CurrentValue;
		$this->ig->CurrentValue = NULL;
		$this->ig->OldValue = $this->ig->CurrentValue;
		$this->sosmed_lain->CurrentValue = NULL;
		$this->sosmed_lain->OldValue = $this->sosmed_lain->CurrentValue;
		$this->jml_pegawai->CurrentValue = NULL;
		$this->jml_pegawai->OldValue = $this->jml_pegawai->CurrentValue;
		$this->jml_pegawai2->CurrentValue = NULL;
		$this->jml_pegawai2->OldValue = $this->jml_pegawai2->CurrentValue;
		$this->jml_pegawai_tidaktetap->CurrentValue = NULL;
		$this->jml_pegawai_tidaktetap->OldValue = $this->jml_pegawai_tidaktetap->CurrentValue;
		$this->legalitas->CurrentValue = NULL;
		$this->legalitas->OldValue = $this->legalitas->CurrentValue;
		$this->legalitas_lain->CurrentValue = NULL;
		$this->legalitas_lain->OldValue = $this->legalitas_lain->CurrentValue;
		$this->f_npwp->Upload->DbValue = NULL;
		$this->f_npwp->OldValue = $this->f_npwp->Upload->DbValue;
		$this->f_npwp->Upload->Index = $this->RowIndex;
		$this->f_nib->Upload->DbValue = NULL;
		$this->f_nib->OldValue = $this->f_nib->Upload->DbValue;
		$this->f_nib->Upload->Index = $this->RowIndex;
		$this->f_siup->Upload->DbValue = NULL;
		$this->f_siup->OldValue = $this->f_siup->Upload->DbValue;
		$this->f_siup->Upload->Index = $this->RowIndex;
		$this->f_tdp->Upload->DbValue = NULL;
		$this->f_tdp->OldValue = $this->f_tdp->Upload->DbValue;
		$this->f_tdp->Upload->Index = $this->RowIndex;
		$this->f_lain->Upload->DbValue = NULL;
		$this->f_lain->OldValue = $this->f_lain->Upload->DbValue;
		$this->f_lain->Upload->Index = $this->RowIndex;
		$this->sertifikat->CurrentValue = NULL;
		$this->sertifikat->OldValue = $this->sertifikat->CurrentValue;
		$this->sertifikat_lain->CurrentValue = NULL;
		$this->sertifikat_lain->OldValue = $this->sertifikat_lain->CurrentValue;
		$this->f_sertifikat->Upload->DbValue = NULL;
		$this->f_sertifikat->OldValue = $this->f_sertifikat->Upload->DbValue;
		$this->f_sertifikat->Upload->Index = $this->RowIndex;
		$this->alat_promosi->CurrentValue = NULL;
		$this->alat_promosi->OldValue = $this->alat_promosi->CurrentValue;
		$this->promosi_lain->CurrentValue = NULL;
		$this->promosi_lain->OldValue = $this->promosi_lain->CurrentValue;
		$this->f_kartunama->Upload->DbValue = NULL;
		$this->f_kartunama->OldValue = $this->f_kartunama->Upload->DbValue;
		$this->f_kartunama->Upload->Index = $this->RowIndex;
		$this->f_brosur->Upload->DbValue = NULL;
		$this->f_brosur->OldValue = $this->f_brosur->Upload->DbValue;
		$this->f_brosur->Upload->Index = $this->RowIndex;
		$this->f_katalog->Upload->DbValue = NULL;
		$this->f_katalog->OldValue = $this->f_katalog->Upload->DbValue;
		$this->f_katalog->Upload->Index = $this->RowIndex;
		$this->f_profile->Upload->DbValue = NULL;
		$this->f_profile->OldValue = $this->f_profile->Upload->DbValue;
		$this->f_profile->Upload->Index = $this->RowIndex;
		$this->tahun_ecp->CurrentValue = NULL;
		$this->tahun_ecp->OldValue = $this->tahun_ecp->CurrentValue;
		$this->wilayah_ecp->CurrentValue = NULL;
		$this->wilayah_ecp->OldValue = $this->wilayah_ecp->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'nama_peserta' first before field var 'x_nama_peserta'
		$val = $CurrentForm->hasValue("nama_peserta") ? $CurrentForm->getValue("nama_peserta") : $CurrentForm->getValue("x_nama_peserta");
		if (!$this->nama_peserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nama_peserta->Visible = FALSE; // Disable update for API request
			else
				$this->nama_peserta->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_nama_peserta"))
			$this->nama_peserta->setOldValue($CurrentForm->getValue("o_nama_peserta"));

		// Check field name 'email_add' first before field var 'x_email_add'
		$val = $CurrentForm->hasValue("email_add") ? $CurrentForm->getValue("email_add") : $CurrentForm->getValue("x_email_add");
		if (!$this->email_add->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->email_add->Visible = FALSE; // Disable update for API request
			else
				$this->email_add->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_email_add"))
			$this->email_add->setOldValue($CurrentForm->getValue("o_email_add"));

		// Check field name 'handphone' first before field var 'x_handphone'
		$val = $CurrentForm->hasValue("handphone") ? $CurrentForm->getValue("handphone") : $CurrentForm->getValue("x_handphone");
		if (!$this->handphone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->handphone->Visible = FALSE; // Disable update for API request
			else
				$this->handphone->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_handphone"))
			$this->handphone->setOldValue($CurrentForm->getValue("o_handphone"));

		// Check field name 'namap' first before field var 'x_namap'
		$val = $CurrentForm->hasValue("namap") ? $CurrentForm->getValue("namap") : $CurrentForm->getValue("x_namap");
		if (!$this->namap->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->namap->Visible = FALSE; // Disable update for API request
			else
				$this->namap->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_namap"))
			$this->namap->setOldValue($CurrentForm->getValue("o_namap"));

		// Check field name 'kategori_produk' first before field var 'x_kategori_produk'
		$val = $CurrentForm->hasValue("kategori_produk") ? $CurrentForm->getValue("kategori_produk") : $CurrentForm->getValue("x_kategori_produk");
		if (!$this->kategori_produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kategori_produk->Visible = FALSE; // Disable update for API request
			else
				$this->kategori_produk->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kategori_produk"))
			$this->kategori_produk->setOldValue($CurrentForm->getValue("o_kategori_produk"));

		// Check field name 'kategori_produk2' first before field var 'x_kategori_produk2'
		$val = $CurrentForm->hasValue("kategori_produk2") ? $CurrentForm->getValue("kategori_produk2") : $CurrentForm->getValue("x_kategori_produk2");
		if (!$this->kategori_produk2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kategori_produk2->Visible = FALSE; // Disable update for API request
			else
				$this->kategori_produk2->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kategori_produk2"))
			$this->kategori_produk2->setOldValue($CurrentForm->getValue("o_kategori_produk2"));

		// Check field name 'kategori_produk3' first before field var 'x_kategori_produk3'
		$val = $CurrentForm->hasValue("kategori_produk3") ? $CurrentForm->getValue("kategori_produk3") : $CurrentForm->getValue("x_kategori_produk3");
		if (!$this->kategori_produk3->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kategori_produk3->Visible = FALSE; // Disable update for API request
			else
				$this->kategori_produk3->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kategori_produk3"))
			$this->kategori_produk3->setOldValue($CurrentForm->getValue("o_kategori_produk3"));

		// Check field name 'produk' first before field var 'x_produk'
		$val = $CurrentForm->hasValue("produk") ? $CurrentForm->getValue("produk") : $CurrentForm->getValue("x_produk");
		if (!$this->produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->produk->Visible = FALSE; // Disable update for API request
			else
				$this->produk->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_produk"))
			$this->produk->setOldValue($CurrentForm->getValue("o_produk"));

		// Check field name 'merek_dagang' first before field var 'x_merek_dagang'
		$val = $CurrentForm->hasValue("merek_dagang") ? $CurrentForm->getValue("merek_dagang") : $CurrentForm->getValue("x_merek_dagang");
		if (!$this->merek_dagang->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->merek_dagang->Visible = FALSE; // Disable update for API request
			else
				$this->merek_dagang->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_merek_dagang"))
			$this->merek_dagang->setOldValue($CurrentForm->getValue("o_merek_dagang"));

		// Check field name 'jenis_perusahaan' first before field var 'x_jenis_perusahaan'
		$val = $CurrentForm->hasValue("jenis_perusahaan") ? $CurrentForm->getValue("jenis_perusahaan") : $CurrentForm->getValue("x_jenis_perusahaan");
		if (!$this->jenis_perusahaan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenis_perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->jenis_perusahaan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jenis_perusahaan"))
			$this->jenis_perusahaan->setOldValue($CurrentForm->getValue("o_jenis_perusahaan"));

		// Check field name 'kapasitas_produksi' first before field var 'x_kapasitas_produksi'
		$val = $CurrentForm->hasValue("kapasitas_produksi") ? $CurrentForm->getValue("kapasitas_produksi") : $CurrentForm->getValue("x_kapasitas_produksi");
		if (!$this->kapasitas_produksi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kapasitas_produksi->Visible = FALSE; // Disable update for API request
			else
				$this->kapasitas_produksi->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kapasitas_produksi"))
			$this->kapasitas_produksi->setOldValue($CurrentForm->getValue("o_kapasitas_produksi"));

		// Check field name 'omset' first before field var 'x_omset'
		$val = $CurrentForm->hasValue("omset") ? $CurrentForm->getValue("omset") : $CurrentForm->getValue("x_omset");
		if (!$this->omset->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->omset->Visible = FALSE; // Disable update for API request
			else
				$this->omset->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_omset"))
			$this->omset->setOldValue($CurrentForm->getValue("o_omset"));

		// Check field name 'website' first before field var 'x_website'
		$val = $CurrentForm->hasValue("website") ? $CurrentForm->getValue("website") : $CurrentForm->getValue("x_website");
		if (!$this->website->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->website->Visible = FALSE; // Disable update for API request
			else
				$this->website->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_website"))
			$this->website->setOldValue($CurrentForm->getValue("o_website"));

		// Check field name 'jml_pegawai' first before field var 'x_jml_pegawai'
		$val = $CurrentForm->hasValue("jml_pegawai") ? $CurrentForm->getValue("jml_pegawai") : $CurrentForm->getValue("x_jml_pegawai");
		if (!$this->jml_pegawai->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->jml_pegawai->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jml_pegawai"))
			$this->jml_pegawai->setOldValue($CurrentForm->getValue("o_jml_pegawai"));

		// Check field name 'jml_pegawai2' first before field var 'x_jml_pegawai2'
		$val = $CurrentForm->hasValue("jml_pegawai2") ? $CurrentForm->getValue("jml_pegawai2") : $CurrentForm->getValue("x_jml_pegawai2");
		if (!$this->jml_pegawai2->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_pegawai2->Visible = FALSE; // Disable update for API request
			else
				$this->jml_pegawai2->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jml_pegawai2"))
			$this->jml_pegawai2->setOldValue($CurrentForm->getValue("o_jml_pegawai2"));

		// Check field name 'jml_pegawai_tidaktetap' first before field var 'x_jml_pegawai_tidaktetap'
		$val = $CurrentForm->hasValue("jml_pegawai_tidaktetap") ? $CurrentForm->getValue("jml_pegawai_tidaktetap") : $CurrentForm->getValue("x_jml_pegawai_tidaktetap");
		if (!$this->jml_pegawai_tidaktetap->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jml_pegawai_tidaktetap->Visible = FALSE; // Disable update for API request
			else
				$this->jml_pegawai_tidaktetap->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jml_pegawai_tidaktetap"))
			$this->jml_pegawai_tidaktetap->setOldValue($CurrentForm->getValue("o_jml_pegawai_tidaktetap"));

		// Check field name 'legalitas' first before field var 'x_legalitas'
		$val = $CurrentForm->hasValue("legalitas") ? $CurrentForm->getValue("legalitas") : $CurrentForm->getValue("x_legalitas");
		if (!$this->legalitas->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->legalitas->Visible = FALSE; // Disable update for API request
			else
				$this->legalitas->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_legalitas"))
			$this->legalitas->setOldValue($CurrentForm->getValue("o_legalitas"));

		// Check field name 'legalitas_lain' first before field var 'x_legalitas_lain'
		$val = $CurrentForm->hasValue("legalitas_lain") ? $CurrentForm->getValue("legalitas_lain") : $CurrentForm->getValue("x_legalitas_lain");
		if (!$this->legalitas_lain->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->legalitas_lain->Visible = FALSE; // Disable update for API request
			else
				$this->legalitas_lain->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_legalitas_lain"))
			$this->legalitas_lain->setOldValue($CurrentForm->getValue("o_legalitas_lain"));

		// Check field name 'sertifikat' first before field var 'x_sertifikat'
		$val = $CurrentForm->hasValue("sertifikat") ? $CurrentForm->getValue("sertifikat") : $CurrentForm->getValue("x_sertifikat");
		if (!$this->sertifikat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sertifikat->Visible = FALSE; // Disable update for API request
			else
				$this->sertifikat->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_sertifikat"))
			$this->sertifikat->setOldValue($CurrentForm->getValue("o_sertifikat"));

		// Check field name 'sertifikat_lain' first before field var 'x_sertifikat_lain'
		$val = $CurrentForm->hasValue("sertifikat_lain") ? $CurrentForm->getValue("sertifikat_lain") : $CurrentForm->getValue("x_sertifikat_lain");
		if (!$this->sertifikat_lain->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sertifikat_lain->Visible = FALSE; // Disable update for API request
			else
				$this->sertifikat_lain->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_sertifikat_lain"))
			$this->sertifikat_lain->setOldValue($CurrentForm->getValue("o_sertifikat_lain"));

		// Check field name 'alat_promosi' first before field var 'x_alat_promosi'
		$val = $CurrentForm->hasValue("alat_promosi") ? $CurrentForm->getValue("alat_promosi") : $CurrentForm->getValue("x_alat_promosi");
		if (!$this->alat_promosi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->alat_promosi->Visible = FALSE; // Disable update for API request
			else
				$this->alat_promosi->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_alat_promosi"))
			$this->alat_promosi->setOldValue($CurrentForm->getValue("o_alat_promosi"));

		// Check field name 'promosi_lain' first before field var 'x_promosi_lain'
		$val = $CurrentForm->hasValue("promosi_lain") ? $CurrentForm->getValue("promosi_lain") : $CurrentForm->getValue("x_promosi_lain");
		if (!$this->promosi_lain->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->promosi_lain->Visible = FALSE; // Disable update for API request
			else
				$this->promosi_lain->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_promosi_lain"))
			$this->promosi_lain->setOldValue($CurrentForm->getValue("o_promosi_lain"));

		// Check field name 'tahun_ecp' first before field var 'x_tahun_ecp'
		$val = $CurrentForm->hasValue("tahun_ecp") ? $CurrentForm->getValue("tahun_ecp") : $CurrentForm->getValue("x_tahun_ecp");
		if (!$this->tahun_ecp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tahun_ecp->Visible = FALSE; // Disable update for API request
			else
				$this->tahun_ecp->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tahun_ecp"))
			$this->tahun_ecp->setOldValue($CurrentForm->getValue("o_tahun_ecp"));

		// Check field name 'wilayah_ecp' first before field var 'x_wilayah_ecp'
		$val = $CurrentForm->hasValue("wilayah_ecp") ? $CurrentForm->getValue("wilayah_ecp") : $CurrentForm->getValue("x_wilayah_ecp");
		if (!$this->wilayah_ecp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->wilayah_ecp->Visible = FALSE; // Disable update for API request
			else
				$this->wilayah_ecp->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_wilayah_ecp"))
			$this->wilayah_ecp->setOldValue($CurrentForm->getValue("o_wilayah_ecp"));

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id->CurrentValue = $this->id->FormValue;
		$this->nama_peserta->CurrentValue = $this->nama_peserta->FormValue;
		$this->email_add->CurrentValue = $this->email_add->FormValue;
		$this->handphone->CurrentValue = $this->handphone->FormValue;
		$this->namap->CurrentValue = $this->namap->FormValue;
		$this->kategori_produk->CurrentValue = $this->kategori_produk->FormValue;
		$this->kategori_produk2->CurrentValue = $this->kategori_produk2->FormValue;
		$this->kategori_produk3->CurrentValue = $this->kategori_produk3->FormValue;
		$this->produk->CurrentValue = $this->produk->FormValue;
		$this->merek_dagang->CurrentValue = $this->merek_dagang->FormValue;
		$this->jenis_perusahaan->CurrentValue = $this->jenis_perusahaan->FormValue;
		$this->kapasitas_produksi->CurrentValue = $this->kapasitas_produksi->FormValue;
		$this->omset->CurrentValue = $this->omset->FormValue;
		$this->website->CurrentValue = $this->website->FormValue;
		$this->jml_pegawai->CurrentValue = $this->jml_pegawai->FormValue;
		$this->jml_pegawai2->CurrentValue = $this->jml_pegawai2->FormValue;
		$this->jml_pegawai_tidaktetap->CurrentValue = $this->jml_pegawai_tidaktetap->FormValue;
		$this->legalitas->CurrentValue = $this->legalitas->FormValue;
		$this->legalitas_lain->CurrentValue = $this->legalitas_lain->FormValue;
		$this->sertifikat->CurrentValue = $this->sertifikat->FormValue;
		$this->sertifikat_lain->CurrentValue = $this->sertifikat_lain->FormValue;
		$this->alat_promosi->CurrentValue = $this->alat_promosi->FormValue;
		$this->promosi_lain->CurrentValue = $this->promosi_lain->FormValue;
		$this->tahun_ecp->CurrentValue = $this->tahun_ecp->FormValue;
		$this->wilayah_ecp->CurrentValue = $this->wilayah_ecp->FormValue;
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
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
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
		$this->rkid->setDbValue($row['rkid']);
		$this->nama_peserta->setDbValue($row['nama_peserta']);
		$this->email_add->setDbValue($row['email_add']);
		$this->handphone->setDbValue($row['handphone']);
		$this->namap->setDbValue($row['namap']);
		$this->tahun_berdiri->setDbValue($row['tahun_berdiri']);
		$this->alamat->setDbValue($row['alamat']);
		$this->alamat_prod->setDbValue($row['alamat_prod']);
		$this->kategori_produk->setDbValue($row['kategori_produk']);
		$this->kategori_produk2->setDbValue($row['kategori_produk2']);
		$this->kategori_produk3->setDbValue($row['kategori_produk3']);
		$this->produk->setDbValue($row['produk']);
		$this->merek_dagang->setDbValue($row['merek_dagang']);
		$this->jenis_perusahaan->setDbValue($row['jenis_perusahaan']);
		$this->kapasitas_produksi->setDbValue($row['kapasitas_produksi']);
		$this->omset->setDbValue($row['omset']);
		$this->website->setDbValue($row['website']);
		$this->fb->setDbValue($row['fb']);
		$this->ig->setDbValue($row['ig']);
		$this->sosmed_lain->setDbValue($row['sosmed_lain']);
		$this->jml_pegawai->setDbValue($row['jml_pegawai']);
		$this->jml_pegawai2->setDbValue($row['jml_pegawai2']);
		$this->jml_pegawai_tidaktetap->setDbValue($row['jml_pegawai_tidaktetap']);
		$this->legalitas->setDbValue($row['legalitas']);
		$this->legalitas_lain->setDbValue($row['legalitas_lain']);
		$this->f_npwp->Upload->DbValue = $row['f_npwp'];
		$this->f_npwp->setDbValue($this->f_npwp->Upload->DbValue);
		$this->f_npwp->Upload->Index = $this->RowIndex;
		$this->f_nib->Upload->DbValue = $row['f_nib'];
		$this->f_nib->setDbValue($this->f_nib->Upload->DbValue);
		$this->f_nib->Upload->Index = $this->RowIndex;
		$this->f_siup->Upload->DbValue = $row['f_siup'];
		$this->f_siup->setDbValue($this->f_siup->Upload->DbValue);
		$this->f_siup->Upload->Index = $this->RowIndex;
		$this->f_tdp->Upload->DbValue = $row['f_tdp'];
		$this->f_tdp->setDbValue($this->f_tdp->Upload->DbValue);
		$this->f_tdp->Upload->Index = $this->RowIndex;
		$this->f_lain->Upload->DbValue = $row['f_lain'];
		$this->f_lain->setDbValue($this->f_lain->Upload->DbValue);
		$this->f_lain->Upload->Index = $this->RowIndex;
		$this->sertifikat->setDbValue($row['sertifikat']);
		$this->sertifikat_lain->setDbValue($row['sertifikat_lain']);
		$this->f_sertifikat->Upload->DbValue = $row['f_sertifikat'];
		$this->f_sertifikat->setDbValue($this->f_sertifikat->Upload->DbValue);
		$this->f_sertifikat->Upload->Index = $this->RowIndex;
		$this->alat_promosi->setDbValue($row['alat_promosi']);
		$this->promosi_lain->setDbValue($row['promosi_lain']);
		$this->f_kartunama->Upload->DbValue = $row['f_kartunama'];
		$this->f_kartunama->setDbValue($this->f_kartunama->Upload->DbValue);
		$this->f_kartunama->Upload->Index = $this->RowIndex;
		$this->f_brosur->Upload->DbValue = $row['f_brosur'];
		$this->f_brosur->setDbValue($this->f_brosur->Upload->DbValue);
		$this->f_brosur->Upload->Index = $this->RowIndex;
		$this->f_katalog->Upload->DbValue = $row['f_katalog'];
		$this->f_katalog->setDbValue($this->f_katalog->Upload->DbValue);
		$this->f_katalog->Upload->Index = $this->RowIndex;
		$this->f_profile->Upload->DbValue = $row['f_profile'];
		$this->f_profile->setDbValue($this->f_profile->Upload->DbValue);
		$this->f_profile->Upload->Index = $this->RowIndex;
		$this->tahun_ecp->setDbValue($row['tahun_ecp']);
		$this->wilayah_ecp->setDbValue($row['wilayah_ecp']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['rkid'] = $this->rkid->CurrentValue;
		$row['nama_peserta'] = $this->nama_peserta->CurrentValue;
		$row['email_add'] = $this->email_add->CurrentValue;
		$row['handphone'] = $this->handphone->CurrentValue;
		$row['namap'] = $this->namap->CurrentValue;
		$row['tahun_berdiri'] = $this->tahun_berdiri->CurrentValue;
		$row['alamat'] = $this->alamat->CurrentValue;
		$row['alamat_prod'] = $this->alamat_prod->CurrentValue;
		$row['kategori_produk'] = $this->kategori_produk->CurrentValue;
		$row['kategori_produk2'] = $this->kategori_produk2->CurrentValue;
		$row['kategori_produk3'] = $this->kategori_produk3->CurrentValue;
		$row['produk'] = $this->produk->CurrentValue;
		$row['merek_dagang'] = $this->merek_dagang->CurrentValue;
		$row['jenis_perusahaan'] = $this->jenis_perusahaan->CurrentValue;
		$row['kapasitas_produksi'] = $this->kapasitas_produksi->CurrentValue;
		$row['omset'] = $this->omset->CurrentValue;
		$row['website'] = $this->website->CurrentValue;
		$row['fb'] = $this->fb->CurrentValue;
		$row['ig'] = $this->ig->CurrentValue;
		$row['sosmed_lain'] = $this->sosmed_lain->CurrentValue;
		$row['jml_pegawai'] = $this->jml_pegawai->CurrentValue;
		$row['jml_pegawai2'] = $this->jml_pegawai2->CurrentValue;
		$row['jml_pegawai_tidaktetap'] = $this->jml_pegawai_tidaktetap->CurrentValue;
		$row['legalitas'] = $this->legalitas->CurrentValue;
		$row['legalitas_lain'] = $this->legalitas_lain->CurrentValue;
		$row['f_npwp'] = $this->f_npwp->Upload->DbValue;
		$row['f_nib'] = $this->f_nib->Upload->DbValue;
		$row['f_siup'] = $this->f_siup->Upload->DbValue;
		$row['f_tdp'] = $this->f_tdp->Upload->DbValue;
		$row['f_lain'] = $this->f_lain->Upload->DbValue;
		$row['sertifikat'] = $this->sertifikat->CurrentValue;
		$row['sertifikat_lain'] = $this->sertifikat_lain->CurrentValue;
		$row['f_sertifikat'] = $this->f_sertifikat->Upload->DbValue;
		$row['alat_promosi'] = $this->alat_promosi->CurrentValue;
		$row['promosi_lain'] = $this->promosi_lain->CurrentValue;
		$row['f_kartunama'] = $this->f_kartunama->Upload->DbValue;
		$row['f_brosur'] = $this->f_brosur->Upload->DbValue;
		$row['f_katalog'] = $this->f_katalog->Upload->DbValue;
		$row['f_profile'] = $this->f_profile->Upload->DbValue;
		$row['tahun_ecp'] = $this->tahun_ecp->CurrentValue;
		$row['wilayah_ecp'] = $this->wilayah_ecp->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = [$this->RowOldKey];
		$cnt = count($keys);
		if ($cnt >= 1) {
			if (strval($keys[0]) != "")
				$this->id->OldValue = strval($keys[0]); // id
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

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
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// rkid
		// nama_peserta
		// email_add
		// handphone
		// namap
		// tahun_berdiri
		// alamat
		// alamat_prod
		// kategori_produk
		// kategori_produk2
		// kategori_produk3
		// produk
		// merek_dagang
		// jenis_perusahaan
		// kapasitas_produksi
		// omset
		// website
		// fb
		// ig
		// sosmed_lain
		// jml_pegawai
		// jml_pegawai2
		// jml_pegawai_tidaktetap
		// legalitas
		// legalitas_lain
		// f_npwp
		// f_nib
		// f_siup
		// f_tdp
		// f_lain
		// sertifikat
		// sertifikat_lain
		// f_sertifikat
		// alat_promosi
		// promosi_lain
		// f_kartunama
		// f_brosur
		// f_katalog
		// f_profile
		// tahun_ecp
		// wilayah_ecp

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// rkid
			$this->rkid->ViewValue = $this->rkid->CurrentValue;
			$this->rkid->ViewValue = FormatNumber($this->rkid->ViewValue, 0, -2, -2, -2);
			$this->rkid->ViewCustomAttributes = "";

			// nama_peserta
			$this->nama_peserta->ViewValue = $this->nama_peserta->CurrentValue;
			$this->nama_peserta->ViewCustomAttributes = "";

			// email_add
			$this->email_add->ViewValue = $this->email_add->CurrentValue;
			$this->email_add->ViewCustomAttributes = "";

			// handphone
			$this->handphone->ViewValue = $this->handphone->CurrentValue;
			$this->handphone->ViewCustomAttributes = "";

			// namap
			$this->namap->ViewValue = $this->namap->CurrentValue;
			$arwrk = [];
			$arwrk[1] = $this->namap->CurrentValue;
			$this->namap->ViewValue = $this->namap->displayValue($arwrk);
			$this->namap->ViewCustomAttributes = "";

			// tahun_berdiri
			$this->tahun_berdiri->ViewValue = $this->tahun_berdiri->CurrentValue;
			$this->tahun_berdiri->ViewValue = FormatNumber($this->tahun_berdiri->ViewValue, 0, -2, -2, -2);
			$this->tahun_berdiri->ViewCustomAttributes = "";

			// alamat_prod
			$this->alamat_prod->ViewValue = $this->alamat_prod->CurrentValue;
			$this->alamat_prod->ViewCustomAttributes = "";

			// kategori_produk
			$curVal = strval($this->kategori_produk->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk->ViewValue = $this->kategori_produk->lookupCacheOption($curVal);
				if ($this->kategori_produk->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk->ViewValue = $this->kategori_produk->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk->ViewValue = $this->kategori_produk->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk->ViewValue = NULL;
			}
			$this->kategori_produk->ViewCustomAttributes = "";

			// kategori_produk2
			$curVal = strval($this->kategori_produk2->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->lookupCacheOption($curVal);
				if ($this->kategori_produk2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk2->ViewValue = $this->kategori_produk2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk2->ViewValue = $this->kategori_produk2->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk2->ViewValue = NULL;
			}
			$this->kategori_produk2->ViewCustomAttributes = "";

			// kategori_produk3
			$curVal = strval($this->kategori_produk3->CurrentValue);
			if ($curVal != "") {
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->lookupCacheOption($curVal);
				if ($this->kategori_produk3->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kategori_produk3->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori_produk3->ViewValue = $this->kategori_produk3->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori_produk3->ViewValue = $this->kategori_produk3->CurrentValue;
					}
				}
			} else {
				$this->kategori_produk3->ViewValue = NULL;
			}
			$this->kategori_produk3->ViewCustomAttributes = "";

			// produk
			$this->produk->ViewValue = $this->produk->CurrentValue;
			$this->produk->ViewCustomAttributes = "";

			// merek_dagang
			$this->merek_dagang->ViewValue = $this->merek_dagang->CurrentValue;
			$this->merek_dagang->ViewCustomAttributes = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->ViewValue = $this->jenis_perusahaan->CurrentValue;
			$this->jenis_perusahaan->ViewCustomAttributes = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->ViewValue = $this->kapasitas_produksi->CurrentValue;
			$this->kapasitas_produksi->ViewCustomAttributes = "";

			// omset
			$this->omset->ViewValue = $this->omset->CurrentValue;
			$this->omset->ViewCustomAttributes = "";

			// website
			$this->website->ViewValue = $this->website->CurrentValue;
			$this->website->ViewCustomAttributes = "";

			// fb
			$this->fb->ViewValue = $this->fb->CurrentValue;
			$this->fb->ViewCustomAttributes = "";

			// ig
			$this->ig->ViewValue = $this->ig->CurrentValue;
			$this->ig->ViewCustomAttributes = "";

			// sosmed_lain
			$this->sosmed_lain->ViewValue = $this->sosmed_lain->CurrentValue;
			$this->sosmed_lain->ViewCustomAttributes = "";

			// jml_pegawai
			if (strval($this->jml_pegawai->CurrentValue) != "") {
				$this->jml_pegawai->ViewValue = $this->jml_pegawai->optionCaption($this->jml_pegawai->CurrentValue);
			} else {
				$this->jml_pegawai->ViewValue = NULL;
			}
			$this->jml_pegawai->ViewCustomAttributes = "";

			// jml_pegawai2
			$this->jml_pegawai2->ViewValue = $this->jml_pegawai2->CurrentValue;
			$this->jml_pegawai2->ViewCustomAttributes = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->ViewValue = $this->jml_pegawai_tidaktetap->CurrentValue;
			$this->jml_pegawai_tidaktetap->ViewCustomAttributes = "";

			// legalitas
			if (strval($this->legalitas->CurrentValue) != "") {
				$this->legalitas->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->legalitas->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->legalitas->ViewValue->add($this->legalitas->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->legalitas->ViewValue = NULL;
			}
			$this->legalitas->ViewCustomAttributes = "";

			// legalitas_lain
			$this->legalitas_lain->ViewValue = $this->legalitas_lain->CurrentValue;
			$this->legalitas_lain->ViewCustomAttributes = "";

			// f_npwp
			$this->f_npwp->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_npwp->Upload->DbValue)) {
				$this->f_npwp->ViewValue = $this->f_npwp->Upload->DbValue;
			} else {
				$this->f_npwp->ViewValue = "";
			}
			$this->f_npwp->ViewCustomAttributes = "";

			// f_nib
			$this->f_nib->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_nib->Upload->DbValue)) {
				$this->f_nib->ViewValue = $this->f_nib->Upload->DbValue;
			} else {
				$this->f_nib->ViewValue = "";
			}
			$this->f_nib->ViewCustomAttributes = "";

			// f_siup
			$this->f_siup->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_siup->Upload->DbValue)) {
				$this->f_siup->ViewValue = $this->f_siup->Upload->DbValue;
			} else {
				$this->f_siup->ViewValue = "";
			}
			$this->f_siup->ViewCustomAttributes = "";

			// f_tdp
			$this->f_tdp->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_tdp->Upload->DbValue)) {
				$this->f_tdp->ViewValue = $this->f_tdp->Upload->DbValue;
			} else {
				$this->f_tdp->ViewValue = "";
			}
			$this->f_tdp->ViewCustomAttributes = "";

			// f_lain
			$this->f_lain->UploadPath = "berkas/legalitas_ecp/";
			if (!EmptyValue($this->f_lain->Upload->DbValue)) {
				$this->f_lain->ViewValue = $this->f_lain->Upload->DbValue;
			} else {
				$this->f_lain->ViewValue = "";
			}
			$this->f_lain->ViewCustomAttributes = "";

			// sertifikat
			if (strval($this->sertifikat->CurrentValue) != "") {
				$this->sertifikat->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->sertifikat->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->sertifikat->ViewValue->add($this->sertifikat->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->sertifikat->ViewValue = NULL;
			}
			$this->sertifikat->ViewCustomAttributes = "";

			// sertifikat_lain
			$this->sertifikat_lain->ViewValue = $this->sertifikat_lain->CurrentValue;
			$this->sertifikat_lain->ViewCustomAttributes = "";

			// f_sertifikat
			$this->f_sertifikat->UploadPath = "berkas/sertifikat_ecp/";
			if (!EmptyValue($this->f_sertifikat->Upload->DbValue)) {
				$this->f_sertifikat->ViewValue = $this->f_sertifikat->Upload->DbValue;
			} else {
				$this->f_sertifikat->ViewValue = "";
			}
			$this->f_sertifikat->ViewCustomAttributes = "";

			// alat_promosi
			if (strval($this->alat_promosi->CurrentValue) != "") {
				$this->alat_promosi->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->alat_promosi->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->alat_promosi->ViewValue->add($this->alat_promosi->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->alat_promosi->ViewValue = NULL;
			}
			$this->alat_promosi->ViewCustomAttributes = "";

			// promosi_lain
			$this->promosi_lain->ViewValue = $this->promosi_lain->CurrentValue;
			$this->promosi_lain->ViewCustomAttributes = "";

			// f_kartunama
			$this->f_kartunama->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_kartunama->Upload->DbValue)) {
				$this->f_kartunama->ViewValue = $this->f_kartunama->Upload->DbValue;
			} else {
				$this->f_kartunama->ViewValue = "";
			}
			$this->f_kartunama->ViewCustomAttributes = "";

			// f_brosur
			$this->f_brosur->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_brosur->Upload->DbValue)) {
				$this->f_brosur->ViewValue = $this->f_brosur->Upload->DbValue;
			} else {
				$this->f_brosur->ViewValue = "";
			}
			$this->f_brosur->ViewCustomAttributes = "";

			// f_katalog
			$this->f_katalog->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_katalog->Upload->DbValue)) {
				$this->f_katalog->ViewValue = $this->f_katalog->Upload->DbValue;
			} else {
				$this->f_katalog->ViewValue = "";
			}
			$this->f_katalog->ViewCustomAttributes = "";

			// f_profile
			$this->f_profile->UploadPath = "berkas/promosi_ecp/";
			if (!EmptyValue($this->f_profile->Upload->DbValue)) {
				$this->f_profile->ViewValue = $this->f_profile->Upload->DbValue;
			} else {
				$this->f_profile->ViewValue = "";
			}
			$this->f_profile->ViewCustomAttributes = "";

			// tahun_ecp
			$this->tahun_ecp->ViewValue = $this->tahun_ecp->CurrentValue;
			$this->tahun_ecp->ViewCustomAttributes = "";

			// wilayah_ecp
			$this->wilayah_ecp->ViewValue = $this->wilayah_ecp->CurrentValue;
			$this->wilayah_ecp->ViewCustomAttributes = "";

			// nama_peserta
			$this->nama_peserta->LinkCustomAttributes = "";
			$this->nama_peserta->HrefValue = "";
			$this->nama_peserta->TooltipValue = "";

			// email_add
			$this->email_add->LinkCustomAttributes = "";
			$this->email_add->HrefValue = "";
			$this->email_add->TooltipValue = "";

			// handphone
			$this->handphone->LinkCustomAttributes = "";
			$this->handphone->HrefValue = "";
			$this->handphone->TooltipValue = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";
			$this->namap->TooltipValue = "";

			// kategori_produk
			$this->kategori_produk->LinkCustomAttributes = "";
			$this->kategori_produk->HrefValue = "";
			$this->kategori_produk->TooltipValue = "";

			// kategori_produk2
			$this->kategori_produk2->LinkCustomAttributes = "";
			$this->kategori_produk2->HrefValue = "";
			$this->kategori_produk2->TooltipValue = "";

			// kategori_produk3
			$this->kategori_produk3->LinkCustomAttributes = "";
			$this->kategori_produk3->HrefValue = "";
			$this->kategori_produk3->TooltipValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";
			$this->produk->TooltipValue = "";

			// merek_dagang
			$this->merek_dagang->LinkCustomAttributes = "";
			$this->merek_dagang->HrefValue = "";
			$this->merek_dagang->TooltipValue = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->LinkCustomAttributes = "";
			$this->jenis_perusahaan->HrefValue = "";
			$this->jenis_perusahaan->TooltipValue = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->LinkCustomAttributes = "";
			$this->kapasitas_produksi->HrefValue = "";
			$this->kapasitas_produksi->TooltipValue = "";

			// omset
			$this->omset->LinkCustomAttributes = "";
			$this->omset->HrefValue = "";
			$this->omset->TooltipValue = "";

			// website
			$this->website->LinkCustomAttributes = "";
			$this->website->HrefValue = "";
			$this->website->TooltipValue = "";

			// jml_pegawai
			$this->jml_pegawai->LinkCustomAttributes = "";
			$this->jml_pegawai->HrefValue = "";
			$this->jml_pegawai->TooltipValue = "";

			// jml_pegawai2
			$this->jml_pegawai2->LinkCustomAttributes = "";
			$this->jml_pegawai2->HrefValue = "";
			$this->jml_pegawai2->TooltipValue = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->LinkCustomAttributes = "";
			$this->jml_pegawai_tidaktetap->HrefValue = "";
			$this->jml_pegawai_tidaktetap->TooltipValue = "";

			// legalitas
			$this->legalitas->LinkCustomAttributes = "";
			$this->legalitas->HrefValue = "";
			$this->legalitas->TooltipValue = "";

			// legalitas_lain
			$this->legalitas_lain->LinkCustomAttributes = "";
			$this->legalitas_lain->HrefValue = "";
			$this->legalitas_lain->TooltipValue = "";

			// sertifikat
			$this->sertifikat->LinkCustomAttributes = "";
			$this->sertifikat->HrefValue = "";
			$this->sertifikat->TooltipValue = "";

			// sertifikat_lain
			$this->sertifikat_lain->LinkCustomAttributes = "";
			$this->sertifikat_lain->HrefValue = "";
			$this->sertifikat_lain->TooltipValue = "";

			// alat_promosi
			$this->alat_promosi->LinkCustomAttributes = "";
			$this->alat_promosi->HrefValue = "";
			$this->alat_promosi->TooltipValue = "";

			// promosi_lain
			$this->promosi_lain->LinkCustomAttributes = "";
			$this->promosi_lain->HrefValue = "";
			$this->promosi_lain->TooltipValue = "";

			// tahun_ecp
			$this->tahun_ecp->LinkCustomAttributes = "";
			$this->tahun_ecp->HrefValue = "";
			$this->tahun_ecp->TooltipValue = "";

			// wilayah_ecp
			$this->wilayah_ecp->LinkCustomAttributes = "";
			$this->wilayah_ecp->HrefValue = "";
			$this->wilayah_ecp->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// nama_peserta
			$this->nama_peserta->EditAttrs["class"] = "form-control";
			$this->nama_peserta->EditCustomAttributes = "";
			if (!$this->nama_peserta->Raw)
				$this->nama_peserta->CurrentValue = HtmlDecode($this->nama_peserta->CurrentValue);
			$this->nama_peserta->EditValue = HtmlEncode($this->nama_peserta->CurrentValue);
			$this->nama_peserta->PlaceHolder = RemoveHtml($this->nama_peserta->caption());

			// email_add
			$this->email_add->EditAttrs["class"] = "form-control";
			$this->email_add->EditCustomAttributes = "";
			if (!$this->email_add->Raw)
				$this->email_add->CurrentValue = HtmlDecode($this->email_add->CurrentValue);
			$this->email_add->EditValue = HtmlEncode($this->email_add->CurrentValue);
			$this->email_add->PlaceHolder = RemoveHtml($this->email_add->caption());

			// handphone
			$this->handphone->EditAttrs["class"] = "form-control";
			$this->handphone->EditCustomAttributes = "";
			if (!$this->handphone->Raw)
				$this->handphone->CurrentValue = HtmlDecode($this->handphone->CurrentValue);
			$this->handphone->EditValue = HtmlEncode($this->handphone->CurrentValue);
			$this->handphone->PlaceHolder = RemoveHtml($this->handphone->caption());

			// namap
			$this->namap->EditAttrs["class"] = "form-control";
			$this->namap->EditCustomAttributes = "";
			if (!$this->namap->Raw)
				$this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
			$this->namap->EditValue = HtmlEncode($this->namap->CurrentValue);
			$arwrk = [];
			$arwrk[1] = HtmlEncode($this->namap->CurrentValue);
			$this->namap->EditValue = $this->namap->displayValue($arwrk);
			$this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

			// kategori_produk
			$this->kategori_produk->EditAttrs["class"] = "form-control";
			$this->kategori_produk->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk->ViewValue = $this->kategori_produk->lookupCacheOption($curVal);
			else
				$this->kategori_produk->ViewValue = $this->kategori_produk->Lookup !== NULL && is_array($this->kategori_produk->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk->EditValue = array_values($this->kategori_produk->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk->EditValue = $arwrk;
			}

			// kategori_produk2
			$this->kategori_produk2->EditAttrs["class"] = "form-control";
			$this->kategori_produk2->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk2->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->lookupCacheOption($curVal);
			else
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->Lookup !== NULL && is_array($this->kategori_produk2->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk2->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk2->EditValue = array_values($this->kategori_produk2->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk2->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk2->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk2->EditValue = $arwrk;
			}

			// kategori_produk3
			$this->kategori_produk3->EditAttrs["class"] = "form-control";
			$this->kategori_produk3->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk3->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->lookupCacheOption($curVal);
			else
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->Lookup !== NULL && is_array($this->kategori_produk3->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk3->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk3->EditValue = array_values($this->kategori_produk3->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk3->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk3->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk3->EditValue = $arwrk;
			}

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "";
			if (!$this->produk->Raw)
				$this->produk->CurrentValue = HtmlDecode($this->produk->CurrentValue);
			$this->produk->EditValue = HtmlEncode($this->produk->CurrentValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// merek_dagang
			$this->merek_dagang->EditAttrs["class"] = "form-control";
			$this->merek_dagang->EditCustomAttributes = "";
			if (!$this->merek_dagang->Raw)
				$this->merek_dagang->CurrentValue = HtmlDecode($this->merek_dagang->CurrentValue);
			$this->merek_dagang->EditValue = HtmlEncode($this->merek_dagang->CurrentValue);
			$this->merek_dagang->PlaceHolder = RemoveHtml($this->merek_dagang->caption());

			// jenis_perusahaan
			$this->jenis_perusahaan->EditAttrs["class"] = "form-control";
			$this->jenis_perusahaan->EditCustomAttributes = "";
			if (!$this->jenis_perusahaan->Raw)
				$this->jenis_perusahaan->CurrentValue = HtmlDecode($this->jenis_perusahaan->CurrentValue);
			$this->jenis_perusahaan->EditValue = HtmlEncode($this->jenis_perusahaan->CurrentValue);
			$this->jenis_perusahaan->PlaceHolder = RemoveHtml($this->jenis_perusahaan->caption());

			// kapasitas_produksi
			$this->kapasitas_produksi->EditAttrs["class"] = "form-control";
			$this->kapasitas_produksi->EditCustomAttributes = "";
			if (!$this->kapasitas_produksi->Raw)
				$this->kapasitas_produksi->CurrentValue = HtmlDecode($this->kapasitas_produksi->CurrentValue);
			$this->kapasitas_produksi->EditValue = HtmlEncode($this->kapasitas_produksi->CurrentValue);
			$this->kapasitas_produksi->PlaceHolder = RemoveHtml($this->kapasitas_produksi->caption());

			// omset
			$this->omset->EditAttrs["class"] = "form-control";
			$this->omset->EditCustomAttributes = "";
			if (!$this->omset->Raw)
				$this->omset->CurrentValue = HtmlDecode($this->omset->CurrentValue);
			$this->omset->EditValue = HtmlEncode($this->omset->CurrentValue);
			$this->omset->PlaceHolder = RemoveHtml($this->omset->caption());

			// website
			$this->website->EditAttrs["class"] = "form-control";
			$this->website->EditCustomAttributes = "";
			if (!$this->website->Raw)
				$this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
			$this->website->EditValue = HtmlEncode($this->website->CurrentValue);
			$this->website->PlaceHolder = RemoveHtml($this->website->caption());

			// jml_pegawai
			$this->jml_pegawai->EditAttrs["class"] = "form-control";
			$this->jml_pegawai->EditCustomAttributes = "";
			$this->jml_pegawai->EditValue = $this->jml_pegawai->options(TRUE);

			// jml_pegawai2
			$this->jml_pegawai2->EditAttrs["class"] = "form-control";
			$this->jml_pegawai2->EditCustomAttributes = "";
			if (!$this->jml_pegawai2->Raw)
				$this->jml_pegawai2->CurrentValue = HtmlDecode($this->jml_pegawai2->CurrentValue);
			$this->jml_pegawai2->EditValue = HtmlEncode($this->jml_pegawai2->CurrentValue);
			$this->jml_pegawai2->PlaceHolder = RemoveHtml($this->jml_pegawai2->caption());

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->EditAttrs["class"] = "form-control";
			$this->jml_pegawai_tidaktetap->EditCustomAttributes = "";
			if (!$this->jml_pegawai_tidaktetap->Raw)
				$this->jml_pegawai_tidaktetap->CurrentValue = HtmlDecode($this->jml_pegawai_tidaktetap->CurrentValue);
			$this->jml_pegawai_tidaktetap->EditValue = HtmlEncode($this->jml_pegawai_tidaktetap->CurrentValue);
			$this->jml_pegawai_tidaktetap->PlaceHolder = RemoveHtml($this->jml_pegawai_tidaktetap->caption());

			// legalitas
			$this->legalitas->EditCustomAttributes = "";
			$this->legalitas->EditValue = $this->legalitas->options(FALSE);

			// legalitas_lain
			$this->legalitas_lain->EditAttrs["class"] = "form-control";
			$this->legalitas_lain->EditCustomAttributes = "";
			if (!$this->legalitas_lain->Raw)
				$this->legalitas_lain->CurrentValue = HtmlDecode($this->legalitas_lain->CurrentValue);
			$this->legalitas_lain->EditValue = HtmlEncode($this->legalitas_lain->CurrentValue);
			$this->legalitas_lain->PlaceHolder = RemoveHtml($this->legalitas_lain->caption());

			// sertifikat
			$this->sertifikat->EditCustomAttributes = "";
			$this->sertifikat->EditValue = $this->sertifikat->options(FALSE);

			// sertifikat_lain
			$this->sertifikat_lain->EditAttrs["class"] = "form-control";
			$this->sertifikat_lain->EditCustomAttributes = "";
			if (!$this->sertifikat_lain->Raw)
				$this->sertifikat_lain->CurrentValue = HtmlDecode($this->sertifikat_lain->CurrentValue);
			$this->sertifikat_lain->EditValue = HtmlEncode($this->sertifikat_lain->CurrentValue);
			$this->sertifikat_lain->PlaceHolder = RemoveHtml($this->sertifikat_lain->caption());

			// alat_promosi
			$this->alat_promosi->EditCustomAttributes = "";
			$this->alat_promosi->EditValue = $this->alat_promosi->options(FALSE);

			// promosi_lain
			$this->promosi_lain->EditAttrs["class"] = "form-control";
			$this->promosi_lain->EditCustomAttributes = "";
			if (!$this->promosi_lain->Raw)
				$this->promosi_lain->CurrentValue = HtmlDecode($this->promosi_lain->CurrentValue);
			$this->promosi_lain->EditValue = HtmlEncode($this->promosi_lain->CurrentValue);
			$this->promosi_lain->PlaceHolder = RemoveHtml($this->promosi_lain->caption());

			// tahun_ecp
			$this->tahun_ecp->EditAttrs["class"] = "form-control";
			$this->tahun_ecp->EditCustomAttributes = "";
			$this->tahun_ecp->EditValue = HtmlEncode($this->tahun_ecp->CurrentValue);
			$this->tahun_ecp->PlaceHolder = RemoveHtml($this->tahun_ecp->caption());

			// wilayah_ecp
			$this->wilayah_ecp->EditAttrs["class"] = "form-control";
			$this->wilayah_ecp->EditCustomAttributes = "";
			if (!$this->wilayah_ecp->Raw)
				$this->wilayah_ecp->CurrentValue = HtmlDecode($this->wilayah_ecp->CurrentValue);
			$this->wilayah_ecp->EditValue = HtmlEncode($this->wilayah_ecp->CurrentValue);
			$this->wilayah_ecp->PlaceHolder = RemoveHtml($this->wilayah_ecp->caption());

			// Add refer script
			// nama_peserta

			$this->nama_peserta->LinkCustomAttributes = "";
			$this->nama_peserta->HrefValue = "";

			// email_add
			$this->email_add->LinkCustomAttributes = "";
			$this->email_add->HrefValue = "";

			// handphone
			$this->handphone->LinkCustomAttributes = "";
			$this->handphone->HrefValue = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";

			// kategori_produk
			$this->kategori_produk->LinkCustomAttributes = "";
			$this->kategori_produk->HrefValue = "";

			// kategori_produk2
			$this->kategori_produk2->LinkCustomAttributes = "";
			$this->kategori_produk2->HrefValue = "";

			// kategori_produk3
			$this->kategori_produk3->LinkCustomAttributes = "";
			$this->kategori_produk3->HrefValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";

			// merek_dagang
			$this->merek_dagang->LinkCustomAttributes = "";
			$this->merek_dagang->HrefValue = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->LinkCustomAttributes = "";
			$this->jenis_perusahaan->HrefValue = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->LinkCustomAttributes = "";
			$this->kapasitas_produksi->HrefValue = "";

			// omset
			$this->omset->LinkCustomAttributes = "";
			$this->omset->HrefValue = "";

			// website
			$this->website->LinkCustomAttributes = "";
			$this->website->HrefValue = "";

			// jml_pegawai
			$this->jml_pegawai->LinkCustomAttributes = "";
			$this->jml_pegawai->HrefValue = "";

			// jml_pegawai2
			$this->jml_pegawai2->LinkCustomAttributes = "";
			$this->jml_pegawai2->HrefValue = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->LinkCustomAttributes = "";
			$this->jml_pegawai_tidaktetap->HrefValue = "";

			// legalitas
			$this->legalitas->LinkCustomAttributes = "";
			$this->legalitas->HrefValue = "";

			// legalitas_lain
			$this->legalitas_lain->LinkCustomAttributes = "";
			$this->legalitas_lain->HrefValue = "";

			// sertifikat
			$this->sertifikat->LinkCustomAttributes = "";
			$this->sertifikat->HrefValue = "";

			// sertifikat_lain
			$this->sertifikat_lain->LinkCustomAttributes = "";
			$this->sertifikat_lain->HrefValue = "";

			// alat_promosi
			$this->alat_promosi->LinkCustomAttributes = "";
			$this->alat_promosi->HrefValue = "";

			// promosi_lain
			$this->promosi_lain->LinkCustomAttributes = "";
			$this->promosi_lain->HrefValue = "";

			// tahun_ecp
			$this->tahun_ecp->LinkCustomAttributes = "";
			$this->tahun_ecp->HrefValue = "";

			// wilayah_ecp
			$this->wilayah_ecp->LinkCustomAttributes = "";
			$this->wilayah_ecp->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// nama_peserta
			$this->nama_peserta->EditAttrs["class"] = "form-control";
			$this->nama_peserta->EditCustomAttributes = "";
			if (!$this->nama_peserta->Raw)
				$this->nama_peserta->CurrentValue = HtmlDecode($this->nama_peserta->CurrentValue);
			$this->nama_peserta->EditValue = HtmlEncode($this->nama_peserta->CurrentValue);
			$this->nama_peserta->PlaceHolder = RemoveHtml($this->nama_peserta->caption());

			// email_add
			$this->email_add->EditAttrs["class"] = "form-control";
			$this->email_add->EditCustomAttributes = "";
			if (!$this->email_add->Raw)
				$this->email_add->CurrentValue = HtmlDecode($this->email_add->CurrentValue);
			$this->email_add->EditValue = HtmlEncode($this->email_add->CurrentValue);
			$this->email_add->PlaceHolder = RemoveHtml($this->email_add->caption());

			// handphone
			$this->handphone->EditAttrs["class"] = "form-control";
			$this->handphone->EditCustomAttributes = "";
			if (!$this->handphone->Raw)
				$this->handphone->CurrentValue = HtmlDecode($this->handphone->CurrentValue);
			$this->handphone->EditValue = HtmlEncode($this->handphone->CurrentValue);
			$this->handphone->PlaceHolder = RemoveHtml($this->handphone->caption());

			// namap
			$this->namap->EditAttrs["class"] = "form-control";
			$this->namap->EditCustomAttributes = "";
			if (!$this->namap->Raw)
				$this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
			$this->namap->EditValue = HtmlEncode($this->namap->CurrentValue);
			$arwrk = [];
			$arwrk[1] = HtmlEncode($this->namap->CurrentValue);
			$this->namap->EditValue = $this->namap->displayValue($arwrk);
			$this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

			// kategori_produk
			$this->kategori_produk->EditAttrs["class"] = "form-control";
			$this->kategori_produk->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk->ViewValue = $this->kategori_produk->lookupCacheOption($curVal);
			else
				$this->kategori_produk->ViewValue = $this->kategori_produk->Lookup !== NULL && is_array($this->kategori_produk->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk->EditValue = array_values($this->kategori_produk->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk->EditValue = $arwrk;
			}

			// kategori_produk2
			$this->kategori_produk2->EditAttrs["class"] = "form-control";
			$this->kategori_produk2->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk2->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->lookupCacheOption($curVal);
			else
				$this->kategori_produk2->ViewValue = $this->kategori_produk2->Lookup !== NULL && is_array($this->kategori_produk2->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk2->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk2->EditValue = array_values($this->kategori_produk2->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk2->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk2->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk2->EditValue = $arwrk;
			}

			// kategori_produk3
			$this->kategori_produk3->EditAttrs["class"] = "form-control";
			$this->kategori_produk3->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori_produk3->CurrentValue));
			if ($curVal != "")
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->lookupCacheOption($curVal);
			else
				$this->kategori_produk3->ViewValue = $this->kategori_produk3->Lookup !== NULL && is_array($this->kategori_produk3->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori_produk3->ViewValue !== NULL) { // Load from cache
				$this->kategori_produk3->EditValue = array_values($this->kategori_produk3->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Kategori_Produk`" . SearchString("=", $this->kategori_produk3->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->kategori_produk3->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori_produk3->EditValue = $arwrk;
			}

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "";
			if (!$this->produk->Raw)
				$this->produk->CurrentValue = HtmlDecode($this->produk->CurrentValue);
			$this->produk->EditValue = HtmlEncode($this->produk->CurrentValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// merek_dagang
			$this->merek_dagang->EditAttrs["class"] = "form-control";
			$this->merek_dagang->EditCustomAttributes = "";
			if (!$this->merek_dagang->Raw)
				$this->merek_dagang->CurrentValue = HtmlDecode($this->merek_dagang->CurrentValue);
			$this->merek_dagang->EditValue = HtmlEncode($this->merek_dagang->CurrentValue);
			$this->merek_dagang->PlaceHolder = RemoveHtml($this->merek_dagang->caption());

			// jenis_perusahaan
			$this->jenis_perusahaan->EditAttrs["class"] = "form-control";
			$this->jenis_perusahaan->EditCustomAttributes = "";
			if (!$this->jenis_perusahaan->Raw)
				$this->jenis_perusahaan->CurrentValue = HtmlDecode($this->jenis_perusahaan->CurrentValue);
			$this->jenis_perusahaan->EditValue = HtmlEncode($this->jenis_perusahaan->CurrentValue);
			$this->jenis_perusahaan->PlaceHolder = RemoveHtml($this->jenis_perusahaan->caption());

			// kapasitas_produksi
			$this->kapasitas_produksi->EditAttrs["class"] = "form-control";
			$this->kapasitas_produksi->EditCustomAttributes = "";
			if (!$this->kapasitas_produksi->Raw)
				$this->kapasitas_produksi->CurrentValue = HtmlDecode($this->kapasitas_produksi->CurrentValue);
			$this->kapasitas_produksi->EditValue = HtmlEncode($this->kapasitas_produksi->CurrentValue);
			$this->kapasitas_produksi->PlaceHolder = RemoveHtml($this->kapasitas_produksi->caption());

			// omset
			$this->omset->EditAttrs["class"] = "form-control";
			$this->omset->EditCustomAttributes = "";
			if (!$this->omset->Raw)
				$this->omset->CurrentValue = HtmlDecode($this->omset->CurrentValue);
			$this->omset->EditValue = HtmlEncode($this->omset->CurrentValue);
			$this->omset->PlaceHolder = RemoveHtml($this->omset->caption());

			// website
			$this->website->EditAttrs["class"] = "form-control";
			$this->website->EditCustomAttributes = "";
			if (!$this->website->Raw)
				$this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
			$this->website->EditValue = HtmlEncode($this->website->CurrentValue);
			$this->website->PlaceHolder = RemoveHtml($this->website->caption());

			// jml_pegawai
			$this->jml_pegawai->EditAttrs["class"] = "form-control";
			$this->jml_pegawai->EditCustomAttributes = "";
			$this->jml_pegawai->EditValue = $this->jml_pegawai->options(TRUE);

			// jml_pegawai2
			$this->jml_pegawai2->EditAttrs["class"] = "form-control";
			$this->jml_pegawai2->EditCustomAttributes = "";
			if (!$this->jml_pegawai2->Raw)
				$this->jml_pegawai2->CurrentValue = HtmlDecode($this->jml_pegawai2->CurrentValue);
			$this->jml_pegawai2->EditValue = HtmlEncode($this->jml_pegawai2->CurrentValue);
			$this->jml_pegawai2->PlaceHolder = RemoveHtml($this->jml_pegawai2->caption());

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->EditAttrs["class"] = "form-control";
			$this->jml_pegawai_tidaktetap->EditCustomAttributes = "";
			if (!$this->jml_pegawai_tidaktetap->Raw)
				$this->jml_pegawai_tidaktetap->CurrentValue = HtmlDecode($this->jml_pegawai_tidaktetap->CurrentValue);
			$this->jml_pegawai_tidaktetap->EditValue = HtmlEncode($this->jml_pegawai_tidaktetap->CurrentValue);
			$this->jml_pegawai_tidaktetap->PlaceHolder = RemoveHtml($this->jml_pegawai_tidaktetap->caption());

			// legalitas
			$this->legalitas->EditCustomAttributes = "";
			$this->legalitas->EditValue = $this->legalitas->options(FALSE);

			// legalitas_lain
			$this->legalitas_lain->EditAttrs["class"] = "form-control";
			$this->legalitas_lain->EditCustomAttributes = "";
			if (!$this->legalitas_lain->Raw)
				$this->legalitas_lain->CurrentValue = HtmlDecode($this->legalitas_lain->CurrentValue);
			$this->legalitas_lain->EditValue = HtmlEncode($this->legalitas_lain->CurrentValue);
			$this->legalitas_lain->PlaceHolder = RemoveHtml($this->legalitas_lain->caption());

			// sertifikat
			$this->sertifikat->EditCustomAttributes = "";
			$this->sertifikat->EditValue = $this->sertifikat->options(FALSE);

			// sertifikat_lain
			$this->sertifikat_lain->EditAttrs["class"] = "form-control";
			$this->sertifikat_lain->EditCustomAttributes = "";
			if (!$this->sertifikat_lain->Raw)
				$this->sertifikat_lain->CurrentValue = HtmlDecode($this->sertifikat_lain->CurrentValue);
			$this->sertifikat_lain->EditValue = HtmlEncode($this->sertifikat_lain->CurrentValue);
			$this->sertifikat_lain->PlaceHolder = RemoveHtml($this->sertifikat_lain->caption());

			// alat_promosi
			$this->alat_promosi->EditCustomAttributes = "";
			$this->alat_promosi->EditValue = $this->alat_promosi->options(FALSE);

			// promosi_lain
			$this->promosi_lain->EditAttrs["class"] = "form-control";
			$this->promosi_lain->EditCustomAttributes = "";
			if (!$this->promosi_lain->Raw)
				$this->promosi_lain->CurrentValue = HtmlDecode($this->promosi_lain->CurrentValue);
			$this->promosi_lain->EditValue = HtmlEncode($this->promosi_lain->CurrentValue);
			$this->promosi_lain->PlaceHolder = RemoveHtml($this->promosi_lain->caption());

			// tahun_ecp
			$this->tahun_ecp->EditAttrs["class"] = "form-control";
			$this->tahun_ecp->EditCustomAttributes = "";
			$this->tahun_ecp->EditValue = HtmlEncode($this->tahun_ecp->CurrentValue);
			$this->tahun_ecp->PlaceHolder = RemoveHtml($this->tahun_ecp->caption());

			// wilayah_ecp
			$this->wilayah_ecp->EditAttrs["class"] = "form-control";
			$this->wilayah_ecp->EditCustomAttributes = "";
			if (!$this->wilayah_ecp->Raw)
				$this->wilayah_ecp->CurrentValue = HtmlDecode($this->wilayah_ecp->CurrentValue);
			$this->wilayah_ecp->EditValue = HtmlEncode($this->wilayah_ecp->CurrentValue);
			$this->wilayah_ecp->PlaceHolder = RemoveHtml($this->wilayah_ecp->caption());

			// Edit refer script
			// nama_peserta

			$this->nama_peserta->LinkCustomAttributes = "";
			$this->nama_peserta->HrefValue = "";

			// email_add
			$this->email_add->LinkCustomAttributes = "";
			$this->email_add->HrefValue = "";

			// handphone
			$this->handphone->LinkCustomAttributes = "";
			$this->handphone->HrefValue = "";

			// namap
			$this->namap->LinkCustomAttributes = "";
			$this->namap->HrefValue = "";

			// kategori_produk
			$this->kategori_produk->LinkCustomAttributes = "";
			$this->kategori_produk->HrefValue = "";

			// kategori_produk2
			$this->kategori_produk2->LinkCustomAttributes = "";
			$this->kategori_produk2->HrefValue = "";

			// kategori_produk3
			$this->kategori_produk3->LinkCustomAttributes = "";
			$this->kategori_produk3->HrefValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";

			// merek_dagang
			$this->merek_dagang->LinkCustomAttributes = "";
			$this->merek_dagang->HrefValue = "";

			// jenis_perusahaan
			$this->jenis_perusahaan->LinkCustomAttributes = "";
			$this->jenis_perusahaan->HrefValue = "";

			// kapasitas_produksi
			$this->kapasitas_produksi->LinkCustomAttributes = "";
			$this->kapasitas_produksi->HrefValue = "";

			// omset
			$this->omset->LinkCustomAttributes = "";
			$this->omset->HrefValue = "";

			// website
			$this->website->LinkCustomAttributes = "";
			$this->website->HrefValue = "";

			// jml_pegawai
			$this->jml_pegawai->LinkCustomAttributes = "";
			$this->jml_pegawai->HrefValue = "";

			// jml_pegawai2
			$this->jml_pegawai2->LinkCustomAttributes = "";
			$this->jml_pegawai2->HrefValue = "";

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->LinkCustomAttributes = "";
			$this->jml_pegawai_tidaktetap->HrefValue = "";

			// legalitas
			$this->legalitas->LinkCustomAttributes = "";
			$this->legalitas->HrefValue = "";

			// legalitas_lain
			$this->legalitas_lain->LinkCustomAttributes = "";
			$this->legalitas_lain->HrefValue = "";

			// sertifikat
			$this->sertifikat->LinkCustomAttributes = "";
			$this->sertifikat->HrefValue = "";

			// sertifikat_lain
			$this->sertifikat_lain->LinkCustomAttributes = "";
			$this->sertifikat_lain->HrefValue = "";

			// alat_promosi
			$this->alat_promosi->LinkCustomAttributes = "";
			$this->alat_promosi->HrefValue = "";

			// promosi_lain
			$this->promosi_lain->LinkCustomAttributes = "";
			$this->promosi_lain->HrefValue = "";

			// tahun_ecp
			$this->tahun_ecp->LinkCustomAttributes = "";
			$this->tahun_ecp->HrefValue = "";

			// wilayah_ecp
			$this->wilayah_ecp->LinkCustomAttributes = "";
			$this->wilayah_ecp->HrefValue = "";
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

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->nama_peserta->Required) {
			if (!$this->nama_peserta->IsDetailKey && $this->nama_peserta->FormValue != NULL && $this->nama_peserta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_peserta->caption(), $this->nama_peserta->RequiredErrorMessage));
			}
		}
		if ($this->email_add->Required) {
			if (!$this->email_add->IsDetailKey && $this->email_add->FormValue != NULL && $this->email_add->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->email_add->caption(), $this->email_add->RequiredErrorMessage));
			}
		}
		if ($this->handphone->Required) {
			if (!$this->handphone->IsDetailKey && $this->handphone->FormValue != NULL && $this->handphone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->handphone->caption(), $this->handphone->RequiredErrorMessage));
			}
		}
		if ($this->namap->Required) {
			if (!$this->namap->IsDetailKey && $this->namap->FormValue != NULL && $this->namap->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->namap->caption(), $this->namap->RequiredErrorMessage));
			}
		}
		if ($this->kategori_produk->Required) {
			if (!$this->kategori_produk->IsDetailKey && $this->kategori_produk->FormValue != NULL && $this->kategori_produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori_produk->caption(), $this->kategori_produk->RequiredErrorMessage));
			}
		}
		if ($this->kategori_produk2->Required) {
			if (!$this->kategori_produk2->IsDetailKey && $this->kategori_produk2->FormValue != NULL && $this->kategori_produk2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori_produk2->caption(), $this->kategori_produk2->RequiredErrorMessage));
			}
		}
		if ($this->kategori_produk3->Required) {
			if (!$this->kategori_produk3->IsDetailKey && $this->kategori_produk3->FormValue != NULL && $this->kategori_produk3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori_produk3->caption(), $this->kategori_produk3->RequiredErrorMessage));
			}
		}
		if ($this->produk->Required) {
			if (!$this->produk->IsDetailKey && $this->produk->FormValue != NULL && $this->produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->produk->caption(), $this->produk->RequiredErrorMessage));
			}
		}
		if ($this->merek_dagang->Required) {
			if (!$this->merek_dagang->IsDetailKey && $this->merek_dagang->FormValue != NULL && $this->merek_dagang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->merek_dagang->caption(), $this->merek_dagang->RequiredErrorMessage));
			}
		}
		if ($this->jenis_perusahaan->Required) {
			if (!$this->jenis_perusahaan->IsDetailKey && $this->jenis_perusahaan->FormValue != NULL && $this->jenis_perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis_perusahaan->caption(), $this->jenis_perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->kapasitas_produksi->Required) {
			if (!$this->kapasitas_produksi->IsDetailKey && $this->kapasitas_produksi->FormValue != NULL && $this->kapasitas_produksi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kapasitas_produksi->caption(), $this->kapasitas_produksi->RequiredErrorMessage));
			}
		}
		if ($this->omset->Required) {
			if (!$this->omset->IsDetailKey && $this->omset->FormValue != NULL && $this->omset->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->omset->caption(), $this->omset->RequiredErrorMessage));
			}
		}
		if ($this->website->Required) {
			if (!$this->website->IsDetailKey && $this->website->FormValue != NULL && $this->website->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->website->caption(), $this->website->RequiredErrorMessage));
			}
		}
		if ($this->jml_pegawai->Required) {
			if (!$this->jml_pegawai->IsDetailKey && $this->jml_pegawai->FormValue != NULL && $this->jml_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_pegawai->caption(), $this->jml_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->jml_pegawai2->Required) {
			if (!$this->jml_pegawai2->IsDetailKey && $this->jml_pegawai2->FormValue != NULL && $this->jml_pegawai2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_pegawai2->caption(), $this->jml_pegawai2->RequiredErrorMessage));
			}
		}
		if ($this->jml_pegawai_tidaktetap->Required) {
			if (!$this->jml_pegawai_tidaktetap->IsDetailKey && $this->jml_pegawai_tidaktetap->FormValue != NULL && $this->jml_pegawai_tidaktetap->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jml_pegawai_tidaktetap->caption(), $this->jml_pegawai_tidaktetap->RequiredErrorMessage));
			}
		}
		if ($this->legalitas->Required) {
			if ($this->legalitas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->legalitas->caption(), $this->legalitas->RequiredErrorMessage));
			}
		}
		if ($this->legalitas_lain->Required) {
			if (!$this->legalitas_lain->IsDetailKey && $this->legalitas_lain->FormValue != NULL && $this->legalitas_lain->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->legalitas_lain->caption(), $this->legalitas_lain->RequiredErrorMessage));
			}
		}
		if ($this->sertifikat->Required) {
			if ($this->sertifikat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sertifikat->caption(), $this->sertifikat->RequiredErrorMessage));
			}
		}
		if ($this->sertifikat_lain->Required) {
			if (!$this->sertifikat_lain->IsDetailKey && $this->sertifikat_lain->FormValue != NULL && $this->sertifikat_lain->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sertifikat_lain->caption(), $this->sertifikat_lain->RequiredErrorMessage));
			}
		}
		if ($this->alat_promosi->Required) {
			if ($this->alat_promosi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alat_promosi->caption(), $this->alat_promosi->RequiredErrorMessage));
			}
		}
		if ($this->promosi_lain->Required) {
			if (!$this->promosi_lain->IsDetailKey && $this->promosi_lain->FormValue != NULL && $this->promosi_lain->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->promosi_lain->caption(), $this->promosi_lain->RequiredErrorMessage));
			}
		}
		if ($this->tahun_ecp->Required) {
			if (!$this->tahun_ecp->IsDetailKey && $this->tahun_ecp->FormValue != NULL && $this->tahun_ecp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tahun_ecp->caption(), $this->tahun_ecp->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tahun_ecp->FormValue)) {
			AddMessage($FormError, $this->tahun_ecp->errorMessage());
		}
		if ($this->wilayah_ecp->Required) {
			if (!$this->wilayah_ecp->IsDetailKey && $this->wilayah_ecp->FormValue != NULL && $this->wilayah_ecp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->wilayah_ecp->caption(), $this->wilayah_ecp->RequiredErrorMessage));
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

		// Check if records exist for detail table 't_ecp'
		if (!isset($GLOBALS["t_ecp"]))
			$GLOBALS["t_ecp"] = new t_ecp();
		foreach ($rows as $row) {
			$rsdetail = $GLOBALS["t_ecp"]->loadRs("`Peserta_ID` = " . QuotedValue($row['id'], DATATYPE_NUMBER, 'DB'));
			if ($rsdetail && !$rsdetail->EOF) {
				$relatedRecordMsg = str_replace("%t", "t_ecp", $Language->phrase("RelatedRecordExists"));
				$this->setFailureMessage($relatedRecordMsg);
				return FALSE;
			}
		}
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
			$this->f_npwp->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_npwp->UploadPath = $this->f_npwp->OldUploadPath;
			$this->f_nib->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_nib->UploadPath = $this->f_nib->OldUploadPath;
			$this->f_siup->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_siup->UploadPath = $this->f_siup->OldUploadPath;
			$this->f_tdp->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_tdp->UploadPath = $this->f_tdp->OldUploadPath;
			$this->f_lain->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_lain->UploadPath = $this->f_lain->OldUploadPath;
			$this->f_sertifikat->OldUploadPath = "berkas/sertifikat_ecp/";
			$this->f_sertifikat->UploadPath = $this->f_sertifikat->OldUploadPath;
			$this->f_kartunama->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_kartunama->UploadPath = $this->f_kartunama->OldUploadPath;
			$this->f_brosur->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_brosur->UploadPath = $this->f_brosur->OldUploadPath;
			$this->f_katalog->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_katalog->UploadPath = $this->f_katalog->OldUploadPath;
			$this->f_profile->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_profile->UploadPath = $this->f_profile->OldUploadPath;
			$rsnew = [];

			// nama_peserta
			$this->nama_peserta->setDbValueDef($rsnew, $this->nama_peserta->CurrentValue, "", $this->nama_peserta->ReadOnly);

			// email_add
			$this->email_add->setDbValueDef($rsnew, $this->email_add->CurrentValue, NULL, $this->email_add->ReadOnly);

			// handphone
			$this->handphone->setDbValueDef($rsnew, $this->handphone->CurrentValue, NULL, $this->handphone->ReadOnly);

			// namap
			$this->namap->setDbValueDef($rsnew, $this->namap->CurrentValue, NULL, $this->namap->ReadOnly);

			// kategori_produk
			$this->kategori_produk->setDbValueDef($rsnew, $this->kategori_produk->CurrentValue, NULL, $this->kategori_produk->ReadOnly);

			// kategori_produk2
			$this->kategori_produk2->setDbValueDef($rsnew, $this->kategori_produk2->CurrentValue, NULL, $this->kategori_produk2->ReadOnly);

			// kategori_produk3
			$this->kategori_produk3->setDbValueDef($rsnew, $this->kategori_produk3->CurrentValue, NULL, $this->kategori_produk3->ReadOnly);

			// produk
			$this->produk->setDbValueDef($rsnew, $this->produk->CurrentValue, NULL, $this->produk->ReadOnly);

			// merek_dagang
			$this->merek_dagang->setDbValueDef($rsnew, $this->merek_dagang->CurrentValue, NULL, $this->merek_dagang->ReadOnly);

			// jenis_perusahaan
			$this->jenis_perusahaan->setDbValueDef($rsnew, $this->jenis_perusahaan->CurrentValue, NULL, $this->jenis_perusahaan->ReadOnly);

			// kapasitas_produksi
			$this->kapasitas_produksi->setDbValueDef($rsnew, $this->kapasitas_produksi->CurrentValue, NULL, $this->kapasitas_produksi->ReadOnly);

			// omset
			$this->omset->setDbValueDef($rsnew, $this->omset->CurrentValue, NULL, $this->omset->ReadOnly);

			// website
			$this->website->setDbValueDef($rsnew, $this->website->CurrentValue, NULL, $this->website->ReadOnly);

			// jml_pegawai
			$this->jml_pegawai->setDbValueDef($rsnew, $this->jml_pegawai->CurrentValue, NULL, $this->jml_pegawai->ReadOnly);

			// jml_pegawai2
			$this->jml_pegawai2->setDbValueDef($rsnew, $this->jml_pegawai2->CurrentValue, NULL, $this->jml_pegawai2->ReadOnly);

			// jml_pegawai_tidaktetap
			$this->jml_pegawai_tidaktetap->setDbValueDef($rsnew, $this->jml_pegawai_tidaktetap->CurrentValue, NULL, $this->jml_pegawai_tidaktetap->ReadOnly);

			// legalitas
			$this->legalitas->setDbValueDef($rsnew, $this->legalitas->CurrentValue, NULL, $this->legalitas->ReadOnly);

			// legalitas_lain
			$this->legalitas_lain->setDbValueDef($rsnew, $this->legalitas_lain->CurrentValue, NULL, $this->legalitas_lain->ReadOnly);

			// sertifikat
			$this->sertifikat->setDbValueDef($rsnew, $this->sertifikat->CurrentValue, NULL, $this->sertifikat->ReadOnly);

			// sertifikat_lain
			$this->sertifikat_lain->setDbValueDef($rsnew, $this->sertifikat_lain->CurrentValue, NULL, $this->sertifikat_lain->ReadOnly);

			// alat_promosi
			$this->alat_promosi->setDbValueDef($rsnew, $this->alat_promosi->CurrentValue, NULL, $this->alat_promosi->ReadOnly);

			// promosi_lain
			$this->promosi_lain->setDbValueDef($rsnew, $this->promosi_lain->CurrentValue, NULL, $this->promosi_lain->ReadOnly);

			// tahun_ecp
			$this->tahun_ecp->setDbValueDef($rsnew, $this->tahun_ecp->CurrentValue, NULL, $this->tahun_ecp->ReadOnly);

			// wilayah_ecp
			$this->wilayah_ecp->setDbValueDef($rsnew, $this->wilayah_ecp->CurrentValue, NULL, $this->wilayah_ecp->ReadOnly);

			// Check referential integrity for master table 'excp'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_excp();
			$keyValue = isset($rsnew['rkid']) ? $rsnew['rkid'] : $rsold['rkid'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@rkid@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["excp"]))
					$GLOBALS["excp"] = new excp();
				$rsmaster = $GLOBALS["excp"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "excp", $Language->phrase("RelatedRecordRequired"));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "excp") {
				$this->rkid->CurrentValue = $this->rkid->getSessionValue();
			}

		// Check referential integrity for master table 't_pcp'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_excp();
		if ($this->rkid->getSessionValue() != "") {
			$masterFilter = str_replace("@rkid@", AdjustSql($this->rkid->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["excp"]))
				$GLOBALS["excp"] = new excp();
			$rsmaster = $GLOBALS["excp"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "excp", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
			$this->f_npwp->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_npwp->UploadPath = $this->f_npwp->OldUploadPath;
			$this->f_nib->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_nib->UploadPath = $this->f_nib->OldUploadPath;
			$this->f_siup->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_siup->UploadPath = $this->f_siup->OldUploadPath;
			$this->f_tdp->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_tdp->UploadPath = $this->f_tdp->OldUploadPath;
			$this->f_lain->OldUploadPath = "berkas/legalitas_ecp/";
			$this->f_lain->UploadPath = $this->f_lain->OldUploadPath;
			$this->f_sertifikat->OldUploadPath = "berkas/sertifikat_ecp/";
			$this->f_sertifikat->UploadPath = $this->f_sertifikat->OldUploadPath;
			$this->f_kartunama->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_kartunama->UploadPath = $this->f_kartunama->OldUploadPath;
			$this->f_brosur->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_brosur->UploadPath = $this->f_brosur->OldUploadPath;
			$this->f_katalog->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_katalog->UploadPath = $this->f_katalog->OldUploadPath;
			$this->f_profile->OldUploadPath = "berkas/promosi_ecp/";
			$this->f_profile->UploadPath = $this->f_profile->OldUploadPath;
		}
		$rsnew = [];

		// nama_peserta
		$this->nama_peserta->setDbValueDef($rsnew, $this->nama_peserta->CurrentValue, "", FALSE);

		// email_add
		$this->email_add->setDbValueDef($rsnew, $this->email_add->CurrentValue, NULL, FALSE);

		// handphone
		$this->handphone->setDbValueDef($rsnew, $this->handphone->CurrentValue, NULL, FALSE);

		// namap
		$this->namap->setDbValueDef($rsnew, $this->namap->CurrentValue, NULL, FALSE);

		// kategori_produk
		$this->kategori_produk->setDbValueDef($rsnew, $this->kategori_produk->CurrentValue, NULL, FALSE);

		// kategori_produk2
		$this->kategori_produk2->setDbValueDef($rsnew, $this->kategori_produk2->CurrentValue, NULL, FALSE);

		// kategori_produk3
		$this->kategori_produk3->setDbValueDef($rsnew, $this->kategori_produk3->CurrentValue, NULL, FALSE);

		// produk
		$this->produk->setDbValueDef($rsnew, $this->produk->CurrentValue, NULL, FALSE);

		// merek_dagang
		$this->merek_dagang->setDbValueDef($rsnew, $this->merek_dagang->CurrentValue, NULL, FALSE);

		// jenis_perusahaan
		$this->jenis_perusahaan->setDbValueDef($rsnew, $this->jenis_perusahaan->CurrentValue, NULL, FALSE);

		// kapasitas_produksi
		$this->kapasitas_produksi->setDbValueDef($rsnew, $this->kapasitas_produksi->CurrentValue, NULL, FALSE);

		// omset
		$this->omset->setDbValueDef($rsnew, $this->omset->CurrentValue, NULL, FALSE);

		// website
		$this->website->setDbValueDef($rsnew, $this->website->CurrentValue, NULL, FALSE);

		// jml_pegawai
		$this->jml_pegawai->setDbValueDef($rsnew, $this->jml_pegawai->CurrentValue, NULL, FALSE);

		// jml_pegawai2
		$this->jml_pegawai2->setDbValueDef($rsnew, $this->jml_pegawai2->CurrentValue, NULL, FALSE);

		// jml_pegawai_tidaktetap
		$this->jml_pegawai_tidaktetap->setDbValueDef($rsnew, $this->jml_pegawai_tidaktetap->CurrentValue, NULL, FALSE);

		// legalitas
		$this->legalitas->setDbValueDef($rsnew, $this->legalitas->CurrentValue, NULL, FALSE);

		// legalitas_lain
		$this->legalitas_lain->setDbValueDef($rsnew, $this->legalitas_lain->CurrentValue, NULL, FALSE);

		// sertifikat
		$this->sertifikat->setDbValueDef($rsnew, $this->sertifikat->CurrentValue, NULL, FALSE);

		// sertifikat_lain
		$this->sertifikat_lain->setDbValueDef($rsnew, $this->sertifikat_lain->CurrentValue, NULL, FALSE);

		// alat_promosi
		$this->alat_promosi->setDbValueDef($rsnew, $this->alat_promosi->CurrentValue, NULL, FALSE);

		// promosi_lain
		$this->promosi_lain->setDbValueDef($rsnew, $this->promosi_lain->CurrentValue, NULL, FALSE);

		// tahun_ecp
		$this->tahun_ecp->setDbValueDef($rsnew, $this->tahun_ecp->CurrentValue, NULL, FALSE);

		// wilayah_ecp
		$this->wilayah_ecp->setDbValueDef($rsnew, $this->wilayah_ecp->CurrentValue, NULL, FALSE);

		// rkid
		if ($this->rkid->getSessionValue() != "") {
			$rsnew['rkid'] = $this->rkid->getSessionValue();
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

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "excp") {
			$this->rkid->Visible = FALSE;
			if ($GLOBALS["excp"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_namap":
					break;
				case "x_kategori_produk":
					break;
				case "x_kategori_produk2":
					break;
				case "x_kategori_produk3":
					break;
				case "x_jml_pegawai":
					break;
				case "x_legalitas":
					break;
				case "x_sertifikat":
					break;
				case "x_alat_promosi":
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
						case "x_namap":
							break;
						case "x_kategori_produk":
							break;
						case "x_kategori_produk2":
							break;
						case "x_kategori_produk3":
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
		$cek_data = ExecuteScalar("SELECT COUNT(1) FROM `t_pcp` WHERE `tahun_ecp` IS NULL OR `wilayah_ecp` IS NULL");
		$cek_data2 = ExecuteScalar("SELECT COUNT(1) FROM `t_ecp` WHERE `Tahun_ECP` IS NULL OR `Wilayah_ECP` IS NULL");
		if($cek_data > 0){
			$updatedata = Execute("UPDATE `t_pcp` t1 INNER JOIN `t_rkcoaching` t2 ON t1.rkid = t2.rkid INNER JOIN `t_prop` t3 ON t2.`area` = t3.`kdprop` SET t1.`tahun_ecp` = t2.`tahun_keg`, t1.`wilayah_ecp` = t3.`prop` WHERE t1.`tahun_ecp` IS NULL OR t1.`wilayah_ecp` IS NULL");
		}
		if($cek_data2 > 0){
			$updatedata2 = Execute("UPDATE `t_ecp` t1 INNER JOIN `t_pcp` t2 ON t1.`Peserta_ID` = t2.`id` SET t1.Nama = t2.nama_peserta, t1.Perusahaan = t2.namap, t1.`Tahun_ECP` = t2.`tahun_ecp`, t1.`Wilayah_ECP` = t2.`wilayah_ecp` WHERE (t1.`Tahun_ECP` IS NULL OR t1.`Wilayah_ECP` IS NULL) OR (t1.`Tahun_ECP` = '' OR t1.`Wilayah_ECP` = 0)");
		}
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
		$this->OtherOptions["addedit"]->Items["add"]->Visible = FALSE;
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

		$this->nama_peserta->Visible = TRUE;
		$this->namap->Visible = TRUE;  
		$this->produk->Visible = TRUE;  
		$this->legalitas->Visible = TRUE;
		$this->id->Visible = FALSE;  
		$this->rkid->Visible = FALSE;  
		$this->tahun_ecp->Visible = FALSE;  
		$this->tahun_berdiri->Visible = FALSE;  
		$this->alamat_prod->Visible = FALSE;  
		$this->merek_dagang->Visible = FALSE;  
		$this->fb->Visible = FALSE;  
		$this->ig->Visible = FALSE;  
		$this->sosmed_lain->Visible = FALSE;  
		$this->jml_pegawai->Visible = FALSE;  

		//$this->jml_pegawai2->Visible = FALSE;
		$this->jml_pegawai_tidaktetap->Visible = FALSE;  
		$this->f_npwp->Visible = FALSE;  
		$this->f_nib->Visible = FALSE;  
		$this->f_siup->Visible = FALSE;  
		$this->f_tdp->Visible = FALSE;  
		$this->f_lain->Visible = FALSE;  
		$this->sertifikat->Visible = FALSE;  
		$this->f_sertifikat->Visible = FALSE; 
		$this->alat_promosi->Visible = FALSE;  
		$this->f_kartunama->Visible = FALSE;  
		$this->f_brosur->Visible = FALSE;  
		$this->f_katalog->Visible = FALSE;  
		$this->f_profile->Visible = FALSE;  
		$this->alamat->Visible = FALSE;  
		$this->kapasitas_produksi->Visible = FALSE;  
		$this->omset->Visible = FALSE;
		$this->email_add->Visible = FALSE;  
		$this->wilayah_ecp->Visible = FALSE;  
		$this->handphone->Visible = FALSE;  
		$this->website->Visible = FALSE;
		$this->kategori_produk->Visible = FALSE;  
		$this->kategori_produk2->Visible = FALSE;  
		$this->kategori_produk3->Visible = FALSE;  
		$this->jenis_perusahaan->Visible = FALSE;  
		$this->legalitas_lain->Visible = FALSE;  
		$this->sertifikat_lain->Visible = FALSE;  
		$this->promosi_lain->Visible = FALSE;
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}
} // End class
?>