<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_pelatihan_grid extends t_pelatihan
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_pelatihan';

	// Page object name
	public $PageObjName = "t_pelatihan_grid";

	// Grid form hidden field names
	public $FormName = "ft_pelatihangrid";
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

		// Table object (t_pelatihan)
		if (!isset($GLOBALS["t_pelatihan"]) || get_class($GLOBALS["t_pelatihan"]) == PROJECT_NAMESPACE . "t_pelatihan") {
			$GLOBALS["t_pelatihan"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["t_pelatihan"];

		}
		$this->AddUrl = "t_pelatihanadd.php";

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_pelatihan');

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
		global $t_pelatihan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($t_pelatihan);
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
		if ($this->isAddOrEdit())
			$this->created_at->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->user_created_by->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->updated_at->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->user_updated_by->Visible = FALSE;
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
	public $DisplayRecords = 10;
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
	public $cv_historipeserta_Count;
	public $cv_historiinstruktur_Count;
	public $t_jadwalpel_Count;
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
		$this->idpelat->Visible = FALSE;
		$this->kdpelat->Visible = FALSE;
		$this->kdjudul->setVisibility();
		$this->kdkursil->Visible = FALSE;
		$this->revisi->Visible = FALSE;
		$this->tgl_terbit->Visible = FALSE;
		$this->pilihan_iso->Visible = FALSE;
		$this->tawal->setVisibility();
		$this->takhir->setVisibility();
		$this->tglpel->setVisibility();
		$this->kdprop->Visible = FALSE;
		$this->kdkota->Visible = FALSE;
		$this->kdkec->Visible = FALSE;
		$this->ketua->Visible = FALSE;
		$this->sekretaris->Visible = FALSE;
		$this->bendahara->Visible = FALSE;
		$this->anggota2->Visible = FALSE;
		$this->widyaiswara->Visible = FALSE;
		$this->jenisevaluasi->Visible = FALSE;
		$this->created_at->Visible = FALSE;
		$this->user_created_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->user_updated_by->Visible = FALSE;
		$this->jenispel->setVisibility();
		$this->kdkategori->Visible = FALSE;
		$this->kerjasama->setVisibility();
		$this->dana->Visible = FALSE;
		$this->biaya->setVisibility();
		$this->coachingprogr->setVisibility();
		$this->area->setVisibility();
		$this->periode_awal->setVisibility();
		$this->periode_akhir->setVisibility();
		$this->tahapan->setVisibility();
		$this->namaberkas->setVisibility();
		$this->instruktur->setVisibility();
		$this->nmou->Visible = FALSE;
		$this->nmou2->Visible = FALSE;
		$this->statuspel->Visible = FALSE;
		$this->ket->Visible = FALSE;
		$this->tempat->setVisibility();
		$this->jpeserta->setVisibility();
		$this->jml_hari->Visible = FALSE;
		$this->targetpes->setVisibility();
		$this->target_peserta->Visible = FALSE;
		$this->durasi1->Visible = FALSE;
		$this->durasi2->Visible = FALSE;
		$this->rid->Visible = FALSE;
		$this->real_peserta->Visible = FALSE;
		$this->independen->Visible = FALSE;
		$this->swasta_k->Visible = FALSE;
		$this->swasta_m->Visible = FALSE;
		$this->swasta_b->Visible = FALSE;
		$this->bumn->Visible = FALSE;
		$this->koperasi->Visible = FALSE;
		$this->pns->Visible = FALSE;
		$this->pt_dosen->Visible = FALSE;
		$this->pt_mhs->Visible = FALSE;
		$this->jk_l->Visible = FALSE;
		$this->jk_p->Visible = FALSE;
		$this->usia_k45->Visible = FALSE;
		$this->usia_b45->Visible = FALSE;
		$this->produk->Visible = FALSE;
		$this->bbio->Visible = FALSE;
		$this->bbio2->Visible = FALSE;
		$this->bbio3->Visible = FALSE;
		$this->bbio4->Visible = FALSE;
		$this->bbio5->Visible = FALSE;
		$this->Tahun->setVisibility();
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
		$this->setupLookupOptions($this->kdjudul);
		$this->setupLookupOptions($this->kdkursil);
		$this->setupLookupOptions($this->kdprop);
		$this->setupLookupOptions($this->kdkota);
		$this->setupLookupOptions($this->kdkec);
		$this->setupLookupOptions($this->ketua);
		$this->setupLookupOptions($this->sekretaris);
		$this->setupLookupOptions($this->bendahara);
		$this->setupLookupOptions($this->anggota2);
		$this->setupLookupOptions($this->widyaiswara);
		$this->setupLookupOptions($this->kdkategori);
		$this->setupLookupOptions($this->kerjasama);
		$this->setupLookupOptions($this->tahapan);

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
			$this->DisplayRecords = 10; // Load default
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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_judul") {
			global $t_judul;
			$rsmaster = $t_judul->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("t_judullist.php"); // Return to master page
			} else {
				$t_judul->loadListRowValues($rsmaster);
				$t_judul->RowType = ROWTYPE_MASTER; // Master row
				$t_judul->renderListRow();
				$rsmaster->close();
			}
		}

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_kota") {
			global $t_kota;
			$rsmaster = $t_kota->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("t_kotalist.php"); // Return to master page
			} else {
				$t_kota->loadListRowValues($rsmaster);
				$t_kota->RowType = ROWTYPE_MASTER; // Master row
				$t_kota->renderListRow();
				$rsmaster->close();
			}
		}

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "t_prop") {
			global $t_prop;
			$rsmaster = $t_prop->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("t_proplist.php"); // Return to master page
			} else {
				$t_prop->loadListRowValues($rsmaster);
				$t_prop->RowType = ROWTYPE_MASTER; // Master row
				$t_prop->renderListRow();
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
					$this->DisplayRecords = 10; // Non-numeric, load default
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
		$this->biaya->FormValue = ""; // Clear form value
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
			$this->idpelat->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->idpelat->OldValue))
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
					$key .= $this->idpelat->CurrentValue;

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
		if ($CurrentForm->hasValue("x_kdjudul") && $CurrentForm->hasValue("o_kdjudul") && $this->kdjudul->CurrentValue != $this->kdjudul->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tawal") && $CurrentForm->hasValue("o_tawal") && $this->tawal->CurrentValue != $this->tawal->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_takhir") && $CurrentForm->hasValue("o_takhir") && $this->takhir->CurrentValue != $this->takhir->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tglpel") && $CurrentForm->hasValue("o_tglpel") && $this->tglpel->CurrentValue != $this->tglpel->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jenispel") && $CurrentForm->hasValue("o_jenispel") && $this->jenispel->CurrentValue != $this->jenispel->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kerjasama") && $CurrentForm->hasValue("o_kerjasama") && $this->kerjasama->CurrentValue != $this->kerjasama->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_biaya") && $CurrentForm->hasValue("o_biaya") && $this->biaya->CurrentValue != $this->biaya->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_coachingprogr") && $CurrentForm->hasValue("o_coachingprogr") && $this->coachingprogr->CurrentValue != $this->coachingprogr->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_area") && $CurrentForm->hasValue("o_area") && $this->area->CurrentValue != $this->area->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_periode_awal") && $CurrentForm->hasValue("o_periode_awal") && $this->periode_awal->CurrentValue != $this->periode_awal->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_periode_akhir") && $CurrentForm->hasValue("o_periode_akhir") && $this->periode_akhir->CurrentValue != $this->periode_akhir->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tahapan") && $CurrentForm->hasValue("o_tahapan") && $this->tahapan->CurrentValue != $this->tahapan->OldValue)
			return FALSE;
		if (!EmptyValue($this->namaberkas->Upload->Value))
			return FALSE;
		if ($CurrentForm->hasValue("x_instruktur") && $CurrentForm->hasValue("o_instruktur") && $this->instruktur->CurrentValue != $this->instruktur->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tempat") && $CurrentForm->hasValue("o_tempat") && $this->tempat->CurrentValue != $this->tempat->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jpeserta") && $CurrentForm->hasValue("o_jpeserta") && $this->jpeserta->CurrentValue != $this->jpeserta->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_targetpes") && $CurrentForm->hasValue("o_targetpes") && $this->targetpes->CurrentValue != $this->targetpes->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Tahun") && $CurrentForm->hasValue("o_Tahun") && $this->Tahun->CurrentValue != $this->Tahun->OldValue)
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
				$this->tawal->setSort("ASC");
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
				$this->kdjudul->setSessionValue("");
				$this->kdkota->setSessionValue("");
				$this->kdprop->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
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
			$item->OnLeft = FALSE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = FALSE;

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
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
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
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
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
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->idpelat->CurrentValue . "\">";
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
		$key .= $rs->fields('idpelat');
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
		$this->namaberkas->Upload->Index = $CurrentForm->Index;
		$this->namaberkas->Upload->uploadFile();
		$this->namaberkas->CurrentValue = $this->namaberkas->Upload->FileName;
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
		$this->revisi->CurrentValue = NULL;
		$this->revisi->OldValue = $this->revisi->CurrentValue;
		$this->tgl_terbit->CurrentValue = NULL;
		$this->tgl_terbit->OldValue = $this->tgl_terbit->CurrentValue;
		$this->pilihan_iso->CurrentValue = NULL;
		$this->pilihan_iso->OldValue = $this->pilihan_iso->CurrentValue;
		$this->tawal->CurrentValue = NULL;
		$this->tawal->OldValue = $this->tawal->CurrentValue;
		$this->takhir->CurrentValue = NULL;
		$this->takhir->OldValue = $this->takhir->CurrentValue;
		$this->tglpel->CurrentValue = NULL;
		$this->tglpel->OldValue = $this->tglpel->CurrentValue;
		$this->kdprop->CurrentValue = NULL;
		$this->kdprop->OldValue = $this->kdprop->CurrentValue;
		$this->kdkota->CurrentValue = NULL;
		$this->kdkota->OldValue = $this->kdkota->CurrentValue;
		$this->kdkec->CurrentValue = NULL;
		$this->kdkec->OldValue = $this->kdkec->CurrentValue;
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
		$this->jenisevaluasi->CurrentValue = NULL;
		$this->jenisevaluasi->OldValue = $this->jenisevaluasi->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->user_created_by->CurrentValue = NULL;
		$this->user_created_by->OldValue = $this->user_created_by->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
		$this->user_updated_by->CurrentValue = NULL;
		$this->user_updated_by->OldValue = $this->user_updated_by->CurrentValue;
		$this->jenispel->CurrentValue = NULL;
		$this->jenispel->OldValue = $this->jenispel->CurrentValue;
		$this->kdkategori->CurrentValue = NULL;
		$this->kdkategori->OldValue = $this->kdkategori->CurrentValue;
		$this->kerjasama->CurrentValue = NULL;
		$this->kerjasama->OldValue = $this->kerjasama->CurrentValue;
		$this->dana->CurrentValue = NULL;
		$this->dana->OldValue = $this->dana->CurrentValue;
		$this->biaya->CurrentValue = NULL;
		$this->biaya->OldValue = $this->biaya->CurrentValue;
		$this->coachingprogr->CurrentValue = "2";
		$this->coachingprogr->OldValue = $this->coachingprogr->CurrentValue;
		$this->area->CurrentValue = NULL;
		$this->area->OldValue = $this->area->CurrentValue;
		$this->periode_awal->CurrentValue = NULL;
		$this->periode_awal->OldValue = $this->periode_awal->CurrentValue;
		$this->periode_akhir->CurrentValue = NULL;
		$this->periode_akhir->OldValue = $this->periode_akhir->CurrentValue;
		$this->tahapan->CurrentValue = NULL;
		$this->tahapan->OldValue = $this->tahapan->CurrentValue;
		$this->namaberkas->Upload->DbValue = NULL;
		$this->namaberkas->OldValue = $this->namaberkas->Upload->DbValue;
		$this->namaberkas->Upload->Index = $this->RowIndex;
		$this->instruktur->CurrentValue = NULL;
		$this->instruktur->OldValue = $this->instruktur->CurrentValue;
		$this->nmou->CurrentValue = NULL;
		$this->nmou->OldValue = $this->nmou->CurrentValue;
		$this->nmou2->CurrentValue = NULL;
		$this->nmou2->OldValue = $this->nmou2->CurrentValue;
		$this->statuspel->CurrentValue = NULL;
		$this->statuspel->OldValue = $this->statuspel->CurrentValue;
		$this->ket->CurrentValue = NULL;
		$this->ket->OldValue = $this->ket->CurrentValue;
		$this->tempat->CurrentValue = NULL;
		$this->tempat->OldValue = $this->tempat->CurrentValue;
		$this->jpeserta->CurrentValue = NULL;
		$this->jpeserta->OldValue = $this->jpeserta->CurrentValue;
		$this->jml_hari->CurrentValue = NULL;
		$this->jml_hari->OldValue = $this->jml_hari->CurrentValue;
		$this->targetpes->CurrentValue = NULL;
		$this->targetpes->OldValue = $this->targetpes->CurrentValue;
		$this->target_peserta->CurrentValue = NULL;
		$this->target_peserta->OldValue = $this->target_peserta->CurrentValue;
		$this->durasi1->CurrentValue = NULL;
		$this->durasi1->OldValue = $this->durasi1->CurrentValue;
		$this->durasi2->CurrentValue = NULL;
		$this->durasi2->OldValue = $this->durasi2->CurrentValue;
		$this->rid->CurrentValue = NULL;
		$this->rid->OldValue = $this->rid->CurrentValue;
		$this->real_peserta->CurrentValue = NULL;
		$this->real_peserta->OldValue = $this->real_peserta->CurrentValue;
		$this->independen->CurrentValue = NULL;
		$this->independen->OldValue = $this->independen->CurrentValue;
		$this->swasta_k->CurrentValue = NULL;
		$this->swasta_k->OldValue = $this->swasta_k->CurrentValue;
		$this->swasta_m->CurrentValue = NULL;
		$this->swasta_m->OldValue = $this->swasta_m->CurrentValue;
		$this->swasta_b->CurrentValue = NULL;
		$this->swasta_b->OldValue = $this->swasta_b->CurrentValue;
		$this->bumn->CurrentValue = NULL;
		$this->bumn->OldValue = $this->bumn->CurrentValue;
		$this->koperasi->CurrentValue = NULL;
		$this->koperasi->OldValue = $this->koperasi->CurrentValue;
		$this->pns->CurrentValue = NULL;
		$this->pns->OldValue = $this->pns->CurrentValue;
		$this->pt_dosen->CurrentValue = NULL;
		$this->pt_dosen->OldValue = $this->pt_dosen->CurrentValue;
		$this->pt_mhs->CurrentValue = NULL;
		$this->pt_mhs->OldValue = $this->pt_mhs->CurrentValue;
		$this->jk_l->CurrentValue = NULL;
		$this->jk_l->OldValue = $this->jk_l->CurrentValue;
		$this->jk_p->CurrentValue = NULL;
		$this->jk_p->OldValue = $this->jk_p->CurrentValue;
		$this->usia_k45->CurrentValue = NULL;
		$this->usia_k45->OldValue = $this->usia_k45->CurrentValue;
		$this->usia_b45->CurrentValue = NULL;
		$this->usia_b45->OldValue = $this->usia_b45->CurrentValue;
		$this->produk->CurrentValue = NULL;
		$this->produk->OldValue = $this->produk->CurrentValue;
		$this->bbio->Upload->DbValue = NULL;
		$this->bbio->OldValue = $this->bbio->Upload->DbValue;
		$this->bbio->Upload->Index = $this->RowIndex;
		$this->bbio2->Upload->DbValue = NULL;
		$this->bbio2->OldValue = $this->bbio2->Upload->DbValue;
		$this->bbio2->Upload->Index = $this->RowIndex;
		$this->bbio3->Upload->DbValue = NULL;
		$this->bbio3->OldValue = $this->bbio3->Upload->DbValue;
		$this->bbio3->Upload->Index = $this->RowIndex;
		$this->bbio4->Upload->DbValue = NULL;
		$this->bbio4->OldValue = $this->bbio4->Upload->DbValue;
		$this->bbio4->Upload->Index = $this->RowIndex;
		$this->bbio5->Upload->DbValue = NULL;
		$this->bbio5->OldValue = $this->bbio5->Upload->DbValue;
		$this->bbio5->Upload->Index = $this->RowIndex;
		$this->Tahun->CurrentValue = NULL;
		$this->Tahun->OldValue = $this->Tahun->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'kdjudul' first before field var 'x_kdjudul'
		$val = $CurrentForm->hasValue("kdjudul") ? $CurrentForm->getValue("kdjudul") : $CurrentForm->getValue("x_kdjudul");
		if (!$this->kdjudul->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdjudul->Visible = FALSE; // Disable update for API request
			else
				$this->kdjudul->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kdjudul"))
			$this->kdjudul->setOldValue($CurrentForm->getValue("o_kdjudul"));

		// Check field name 'tawal' first before field var 'x_tawal'
		$val = $CurrentForm->hasValue("tawal") ? $CurrentForm->getValue("tawal") : $CurrentForm->getValue("x_tawal");
		if (!$this->tawal->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tawal->Visible = FALSE; // Disable update for API request
			else
				$this->tawal->setFormValue($val);
			$this->tawal->CurrentValue = UnFormatDateTime($this->tawal->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_tawal"))
			$this->tawal->setOldValue($CurrentForm->getValue("o_tawal"));

		// Check field name 'takhir' first before field var 'x_takhir'
		$val = $CurrentForm->hasValue("takhir") ? $CurrentForm->getValue("takhir") : $CurrentForm->getValue("x_takhir");
		if (!$this->takhir->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->takhir->Visible = FALSE; // Disable update for API request
			else
				$this->takhir->setFormValue($val);
			$this->takhir->CurrentValue = UnFormatDateTime($this->takhir->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_takhir"))
			$this->takhir->setOldValue($CurrentForm->getValue("o_takhir"));

		// Check field name 'tglpel' first before field var 'x_tglpel'
		$val = $CurrentForm->hasValue("tglpel") ? $CurrentForm->getValue("tglpel") : $CurrentForm->getValue("x_tglpel");
		if (!$this->tglpel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tglpel->Visible = FALSE; // Disable update for API request
			else
				$this->tglpel->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tglpel"))
			$this->tglpel->setOldValue($CurrentForm->getValue("o_tglpel"));

		// Check field name 'jenispel' first before field var 'x_jenispel'
		$val = $CurrentForm->hasValue("jenispel") ? $CurrentForm->getValue("jenispel") : $CurrentForm->getValue("x_jenispel");
		if (!$this->jenispel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenispel->Visible = FALSE; // Disable update for API request
			else
				$this->jenispel->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jenispel"))
			$this->jenispel->setOldValue($CurrentForm->getValue("o_jenispel"));

		// Check field name 'kerjasama' first before field var 'x_kerjasama'
		$val = $CurrentForm->hasValue("kerjasama") ? $CurrentForm->getValue("kerjasama") : $CurrentForm->getValue("x_kerjasama");
		if (!$this->kerjasama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kerjasama->Visible = FALSE; // Disable update for API request
			else
				$this->kerjasama->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kerjasama"))
			$this->kerjasama->setOldValue($CurrentForm->getValue("o_kerjasama"));

		// Check field name 'biaya' first before field var 'x_biaya'
		$val = $CurrentForm->hasValue("biaya") ? $CurrentForm->getValue("biaya") : $CurrentForm->getValue("x_biaya");
		if (!$this->biaya->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->biaya->Visible = FALSE; // Disable update for API request
			else
				$this->biaya->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_biaya"))
			$this->biaya->setOldValue($CurrentForm->getValue("o_biaya"));

		// Check field name 'coachingprogr' first before field var 'x_coachingprogr'
		$val = $CurrentForm->hasValue("coachingprogr") ? $CurrentForm->getValue("coachingprogr") : $CurrentForm->getValue("x_coachingprogr");
		if (!$this->coachingprogr->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->coachingprogr->Visible = FALSE; // Disable update for API request
			else
				$this->coachingprogr->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_coachingprogr"))
			$this->coachingprogr->setOldValue($CurrentForm->getValue("o_coachingprogr"));

		// Check field name 'area' first before field var 'x_area'
		$val = $CurrentForm->hasValue("area") ? $CurrentForm->getValue("area") : $CurrentForm->getValue("x_area");
		if (!$this->area->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->area->Visible = FALSE; // Disable update for API request
			else
				$this->area->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_area"))
			$this->area->setOldValue($CurrentForm->getValue("o_area"));

		// Check field name 'periode_awal' first before field var 'x_periode_awal'
		$val = $CurrentForm->hasValue("periode_awal") ? $CurrentForm->getValue("periode_awal") : $CurrentForm->getValue("x_periode_awal");
		if (!$this->periode_awal->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->periode_awal->Visible = FALSE; // Disable update for API request
			else
				$this->periode_awal->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_periode_awal"))
			$this->periode_awal->setOldValue($CurrentForm->getValue("o_periode_awal"));

		// Check field name 'periode_akhir' first before field var 'x_periode_akhir'
		$val = $CurrentForm->hasValue("periode_akhir") ? $CurrentForm->getValue("periode_akhir") : $CurrentForm->getValue("x_periode_akhir");
		if (!$this->periode_akhir->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->periode_akhir->Visible = FALSE; // Disable update for API request
			else
				$this->periode_akhir->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_periode_akhir"))
			$this->periode_akhir->setOldValue($CurrentForm->getValue("o_periode_akhir"));

		// Check field name 'tahapan' first before field var 'x_tahapan'
		$val = $CurrentForm->hasValue("tahapan") ? $CurrentForm->getValue("tahapan") : $CurrentForm->getValue("x_tahapan");
		if (!$this->tahapan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tahapan->Visible = FALSE; // Disable update for API request
			else
				$this->tahapan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tahapan"))
			$this->tahapan->setOldValue($CurrentForm->getValue("o_tahapan"));

		// Check field name 'instruktur' first before field var 'x_instruktur'
		$val = $CurrentForm->hasValue("instruktur") ? $CurrentForm->getValue("instruktur") : $CurrentForm->getValue("x_instruktur");
		if (!$this->instruktur->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->instruktur->Visible = FALSE; // Disable update for API request
			else
				$this->instruktur->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_instruktur"))
			$this->instruktur->setOldValue($CurrentForm->getValue("o_instruktur"));

		// Check field name 'tempat' first before field var 'x_tempat'
		$val = $CurrentForm->hasValue("tempat") ? $CurrentForm->getValue("tempat") : $CurrentForm->getValue("x_tempat");
		if (!$this->tempat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tempat->Visible = FALSE; // Disable update for API request
			else
				$this->tempat->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tempat"))
			$this->tempat->setOldValue($CurrentForm->getValue("o_tempat"));

		// Check field name 'jpeserta' first before field var 'x_jpeserta'
		$val = $CurrentForm->hasValue("jpeserta") ? $CurrentForm->getValue("jpeserta") : $CurrentForm->getValue("x_jpeserta");
		if (!$this->jpeserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jpeserta->Visible = FALSE; // Disable update for API request
			else
				$this->jpeserta->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jpeserta"))
			$this->jpeserta->setOldValue($CurrentForm->getValue("o_jpeserta"));

		// Check field name 'targetpes' first before field var 'x_targetpes'
		$val = $CurrentForm->hasValue("targetpes") ? $CurrentForm->getValue("targetpes") : $CurrentForm->getValue("x_targetpes");
		if (!$this->targetpes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->targetpes->Visible = FALSE; // Disable update for API request
			else
				$this->targetpes->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_targetpes"))
			$this->targetpes->setOldValue($CurrentForm->getValue("o_targetpes"));

		// Check field name 'Tahun' first before field var 'x_Tahun'
		$val = $CurrentForm->hasValue("Tahun") ? $CurrentForm->getValue("Tahun") : $CurrentForm->getValue("x_Tahun");
		if (!$this->Tahun->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Tahun->Visible = FALSE; // Disable update for API request
			else
				$this->Tahun->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Tahun"))
			$this->Tahun->setOldValue($CurrentForm->getValue("o_Tahun"));

		// Check field name 'idpelat' first before field var 'x_idpelat'
		$val = $CurrentForm->hasValue("idpelat") ? $CurrentForm->getValue("idpelat") : $CurrentForm->getValue("x_idpelat");
		if (!$this->idpelat->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->idpelat->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->idpelat->CurrentValue = $this->idpelat->FormValue;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->tawal->CurrentValue = $this->tawal->FormValue;
		$this->tawal->CurrentValue = UnFormatDateTime($this->tawal->CurrentValue, 0);
		$this->takhir->CurrentValue = $this->takhir->FormValue;
		$this->takhir->CurrentValue = UnFormatDateTime($this->takhir->CurrentValue, 0);
		$this->tglpel->CurrentValue = $this->tglpel->FormValue;
		$this->jenispel->CurrentValue = $this->jenispel->FormValue;
		$this->kerjasama->CurrentValue = $this->kerjasama->FormValue;
		$this->biaya->CurrentValue = $this->biaya->FormValue;
		$this->coachingprogr->CurrentValue = $this->coachingprogr->FormValue;
		$this->area->CurrentValue = $this->area->FormValue;
		$this->periode_awal->CurrentValue = $this->periode_awal->FormValue;
		$this->periode_akhir->CurrentValue = $this->periode_akhir->FormValue;
		$this->tahapan->CurrentValue = $this->tahapan->FormValue;
		$this->instruktur->CurrentValue = $this->instruktur->FormValue;
		$this->tempat->CurrentValue = $this->tempat->FormValue;
		$this->jpeserta->CurrentValue = $this->jpeserta->FormValue;
		$this->targetpes->CurrentValue = $this->targetpes->FormValue;
		$this->Tahun->CurrentValue = $this->Tahun->FormValue;
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
		$this->idpelat->setDbValue($row['idpelat']);
		$this->kdpelat->setDbValue($row['kdpelat']);
		$this->kdjudul->setDbValue($row['kdjudul']);
		if (array_key_exists('EV__kdjudul', $rs->fields)) {
			$this->kdjudul->VirtualValue = $rs->fields('EV__kdjudul'); // Set up virtual field value
		} else {
			$this->kdjudul->VirtualValue = ""; // Clear value
		}
		$this->kdkursil->setDbValue($row['kdkursil']);
		$this->revisi->setDbValue($row['revisi']);
		$this->tgl_terbit->setDbValue($row['tgl_terbit']);
		$this->pilihan_iso->setDbValue($row['pilihan_iso']);
		$this->tawal->setDbValue($row['tawal']);
		$this->takhir->setDbValue($row['takhir']);
		$this->tglpel->setDbValue($row['tglpel']);
		$this->kdprop->setDbValue($row['kdprop']);
		$this->kdkota->setDbValue($row['kdkota']);
		$this->kdkec->setDbValue($row['kdkec']);
		if (array_key_exists('EV__kdkec', $rs->fields)) {
			$this->kdkec->VirtualValue = $rs->fields('EV__kdkec'); // Set up virtual field value
		} else {
			$this->kdkec->VirtualValue = ""; // Clear value
		}
		$this->ketua->setDbValue($row['ketua']);
		$this->sekretaris->setDbValue($row['sekretaris']);
		$this->bendahara->setDbValue($row['bendahara']);
		$this->anggota2->setDbValue($row['anggota2']);
		$this->widyaiswara->setDbValue($row['widyaiswara']);
		$this->jenisevaluasi->setDbValue($row['jenisevaluasi']);
		$this->created_at->setDbValue($row['created_at']);
		$this->user_created_by->setDbValue($row['user_created_by']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->user_updated_by->setDbValue($row['user_updated_by']);
		$this->jenispel->setDbValue($row['jenispel']);
		$this->kdkategori->setDbValue($row['kdkategori']);
		$this->kerjasama->setDbValue($row['kerjasama']);
		$this->dana->setDbValue($row['dana']);
		$this->biaya->setDbValue($row['biaya']);
		$this->coachingprogr->setDbValue($row['coachingprogr']);
		$this->area->setDbValue($row['area']);
		$this->periode_awal->setDbValue($row['periode_awal']);
		$this->periode_akhir->setDbValue($row['periode_akhir']);
		$this->tahapan->setDbValue($row['tahapan']);
		$this->namaberkas->Upload->DbValue = $row['namaberkas'];
		$this->namaberkas->setDbValue($this->namaberkas->Upload->DbValue);
		$this->namaberkas->Upload->Index = $this->RowIndex;
		$this->instruktur->setDbValue($row['instruktur']);
		$this->nmou->setDbValue($row['nmou']);
		$this->nmou2->setDbValue($row['nmou2']);
		$this->statuspel->setDbValue($row['statuspel']);
		$this->ket->setDbValue($row['ket']);
		$this->tempat->setDbValue($row['tempat']);
		$this->jpeserta->setDbValue($row['jpeserta']);
		$this->jml_hari->setDbValue($row['jml_hari']);
		$this->targetpes->setDbValue($row['targetpes']);
		$this->target_peserta->setDbValue($row['target_peserta']);
		$this->durasi1->setDbValue($row['durasi1']);
		$this->durasi2->setDbValue($row['durasi2']);
		$this->rid->setDbValue($row['rid']);
		$this->real_peserta->setDbValue($row['real_peserta']);
		$this->independen->setDbValue($row['independen']);
		$this->swasta_k->setDbValue($row['swasta_k']);
		$this->swasta_m->setDbValue($row['swasta_m']);
		$this->swasta_b->setDbValue($row['swasta_b']);
		$this->bumn->setDbValue($row['bumn']);
		$this->koperasi->setDbValue($row['koperasi']);
		$this->pns->setDbValue($row['pns']);
		$this->pt_dosen->setDbValue($row['pt_dosen']);
		$this->pt_mhs->setDbValue($row['pt_mhs']);
		$this->jk_l->setDbValue($row['jk_l']);
		$this->jk_p->setDbValue($row['jk_p']);
		$this->usia_k45->setDbValue($row['usia_k45']);
		$this->usia_b45->setDbValue($row['usia_b45']);
		$this->produk->setDbValue($row['produk']);
		$this->bbio->Upload->DbValue = $row['bbio'];
		$this->bbio->setDbValue($this->bbio->Upload->DbValue);
		$this->bbio->Upload->Index = $this->RowIndex;
		$this->bbio2->Upload->DbValue = $row['bbio2'];
		$this->bbio2->setDbValue($this->bbio2->Upload->DbValue);
		$this->bbio2->Upload->Index = $this->RowIndex;
		$this->bbio3->Upload->DbValue = $row['bbio3'];
		$this->bbio3->setDbValue($this->bbio3->Upload->DbValue);
		$this->bbio3->Upload->Index = $this->RowIndex;
		$this->bbio4->Upload->DbValue = $row['bbio4'];
		$this->bbio4->setDbValue($this->bbio4->Upload->DbValue);
		$this->bbio4->Upload->Index = $this->RowIndex;
		$this->bbio5->Upload->DbValue = $row['bbio5'];
		$this->bbio5->setDbValue($this->bbio5->Upload->DbValue);
		$this->bbio5->Upload->Index = $this->RowIndex;
		$this->Tahun->setDbValue($row['Tahun']);
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
		$row['revisi'] = $this->revisi->CurrentValue;
		$row['tgl_terbit'] = $this->tgl_terbit->CurrentValue;
		$row['pilihan_iso'] = $this->pilihan_iso->CurrentValue;
		$row['tawal'] = $this->tawal->CurrentValue;
		$row['takhir'] = $this->takhir->CurrentValue;
		$row['tglpel'] = $this->tglpel->CurrentValue;
		$row['kdprop'] = $this->kdprop->CurrentValue;
		$row['kdkota'] = $this->kdkota->CurrentValue;
		$row['kdkec'] = $this->kdkec->CurrentValue;
		$row['ketua'] = $this->ketua->CurrentValue;
		$row['sekretaris'] = $this->sekretaris->CurrentValue;
		$row['bendahara'] = $this->bendahara->CurrentValue;
		$row['anggota2'] = $this->anggota2->CurrentValue;
		$row['widyaiswara'] = $this->widyaiswara->CurrentValue;
		$row['jenisevaluasi'] = $this->jenisevaluasi->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['user_created_by'] = $this->user_created_by->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		$row['user_updated_by'] = $this->user_updated_by->CurrentValue;
		$row['jenispel'] = $this->jenispel->CurrentValue;
		$row['kdkategori'] = $this->kdkategori->CurrentValue;
		$row['kerjasama'] = $this->kerjasama->CurrentValue;
		$row['dana'] = $this->dana->CurrentValue;
		$row['biaya'] = $this->biaya->CurrentValue;
		$row['coachingprogr'] = $this->coachingprogr->CurrentValue;
		$row['area'] = $this->area->CurrentValue;
		$row['periode_awal'] = $this->periode_awal->CurrentValue;
		$row['periode_akhir'] = $this->periode_akhir->CurrentValue;
		$row['tahapan'] = $this->tahapan->CurrentValue;
		$row['namaberkas'] = $this->namaberkas->Upload->DbValue;
		$row['instruktur'] = $this->instruktur->CurrentValue;
		$row['nmou'] = $this->nmou->CurrentValue;
		$row['nmou2'] = $this->nmou2->CurrentValue;
		$row['statuspel'] = $this->statuspel->CurrentValue;
		$row['ket'] = $this->ket->CurrentValue;
		$row['tempat'] = $this->tempat->CurrentValue;
		$row['jpeserta'] = $this->jpeserta->CurrentValue;
		$row['jml_hari'] = $this->jml_hari->CurrentValue;
		$row['targetpes'] = $this->targetpes->CurrentValue;
		$row['target_peserta'] = $this->target_peserta->CurrentValue;
		$row['durasi1'] = $this->durasi1->CurrentValue;
		$row['durasi2'] = $this->durasi2->CurrentValue;
		$row['rid'] = $this->rid->CurrentValue;
		$row['real_peserta'] = $this->real_peserta->CurrentValue;
		$row['independen'] = $this->independen->CurrentValue;
		$row['swasta_k'] = $this->swasta_k->CurrentValue;
		$row['swasta_m'] = $this->swasta_m->CurrentValue;
		$row['swasta_b'] = $this->swasta_b->CurrentValue;
		$row['bumn'] = $this->bumn->CurrentValue;
		$row['koperasi'] = $this->koperasi->CurrentValue;
		$row['pns'] = $this->pns->CurrentValue;
		$row['pt_dosen'] = $this->pt_dosen->CurrentValue;
		$row['pt_mhs'] = $this->pt_mhs->CurrentValue;
		$row['jk_l'] = $this->jk_l->CurrentValue;
		$row['jk_p'] = $this->jk_p->CurrentValue;
		$row['usia_k45'] = $this->usia_k45->CurrentValue;
		$row['usia_b45'] = $this->usia_b45->CurrentValue;
		$row['produk'] = $this->produk->CurrentValue;
		$row['bbio'] = $this->bbio->Upload->DbValue;
		$row['bbio2'] = $this->bbio2->Upload->DbValue;
		$row['bbio3'] = $this->bbio3->Upload->DbValue;
		$row['bbio4'] = $this->bbio4->Upload->DbValue;
		$row['bbio5'] = $this->bbio5->Upload->DbValue;
		$row['Tahun'] = $this->Tahun->CurrentValue;
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
				$this->idpelat->OldValue = strval($keys[0]); // idpelat
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
		// revisi
		// tgl_terbit
		// pilihan_iso
		// tawal
		// takhir
		// tglpel
		// kdprop
		// kdkota
		// kdkec
		// ketua
		// sekretaris
		// bendahara
		// anggota2
		// widyaiswara
		// jenisevaluasi
		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jenispel
		// kdkategori
		// kerjasama
		// dana
		// biaya
		// coachingprogr
		// area
		// periode_awal
		// periode_akhir
		// tahapan
		// namaberkas
		// instruktur
		// nmou
		// nmou2
		// statuspel
		// ket
		// tempat
		// jpeserta
		// jml_hari
		// targetpes
		// target_peserta
		// durasi1
		// durasi2
		// rid
		// real_peserta
		// independen
		// swasta_k
		// swasta_m
		// swasta_b
		// bumn
		// koperasi
		// pns
		// pt_dosen
		// pt_mhs
		// jk_l
		// jk_p
		// usia_k45
		// usia_b45
		// produk
		// bbio
		// bbio2
		// bbio3
		// bbio4
		// bbio5
		// Tahun
		// Accumulate aggregate value

		if ($this->RowType != ROWTYPE_AGGREGATEINIT && $this->RowType != ROWTYPE_AGGREGATE) {
			if (is_numeric($this->jpeserta->CurrentValue))
				$this->jpeserta->Total += $this->jpeserta->CurrentValue; // Accumulate total
			if (is_numeric($this->targetpes->CurrentValue))
				$this->targetpes->Total += $this->targetpes->CurrentValue; // Accumulate total
		}
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
			$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
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

			// revisi
			$this->revisi->ViewValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";

			// tgl_terbit
			$this->tgl_terbit->ViewValue = $this->tgl_terbit->CurrentValue;
			$this->tgl_terbit->ViewValue = FormatDateTime($this->tgl_terbit->ViewValue, 0);
			$this->tgl_terbit->ViewCustomAttributes = "";

			// pilihan_iso
			if (strval($this->pilihan_iso->CurrentValue) != "") {
				$this->pilihan_iso->ViewValue = $this->pilihan_iso->optionCaption($this->pilihan_iso->CurrentValue);
			} else {
				$this->pilihan_iso->ViewValue = NULL;
			}
			$this->pilihan_iso->ViewCustomAttributes = "";

			// tawal
			$this->tawal->ViewValue = $this->tawal->CurrentValue;
			$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
			$this->tawal->ViewCustomAttributes = "";

			// takhir
			$this->takhir->ViewValue = $this->takhir->CurrentValue;
			$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
			$this->takhir->ViewCustomAttributes = "";

			// tglpel
			$this->tglpel->ViewValue = $this->tglpel->CurrentValue;
			$this->tglpel->CellCssStyle .= "text-align: right;";
			$this->tglpel->ViewCustomAttributes = 'style=text-align:center';

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

			// biaya
			$this->biaya->ViewValue = $this->biaya->CurrentValue;
			$this->biaya->ViewValue = FormatNumber($this->biaya->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->biaya->ViewCustomAttributes = "";

			// coachingprogr
			if (strval($this->coachingprogr->CurrentValue) != "") {
				$this->coachingprogr->ViewValue = $this->coachingprogr->optionCaption($this->coachingprogr->CurrentValue);
			} else {
				$this->coachingprogr->ViewValue = NULL;
			}
			$this->coachingprogr->ViewCustomAttributes = "";

			// area
			$this->area->ViewValue = $this->area->CurrentValue;
			$this->area->ViewCustomAttributes = "";

			// periode_awal
			$this->periode_awal->ViewValue = $this->periode_awal->CurrentValue;
			$this->periode_awal->ViewCustomAttributes = "";

			// periode_akhir
			$this->periode_akhir->ViewValue = $this->periode_akhir->CurrentValue;
			$this->periode_akhir->ViewCustomAttributes = "";

			// tahapan
			$curVal = strval($this->tahapan->CurrentValue);
			if ($curVal != "") {
				$this->tahapan->ViewValue = $this->tahapan->lookupCacheOption($curVal);
				if ($this->tahapan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdtahapan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->tahapan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->tahapan->ViewValue = $this->tahapan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->tahapan->ViewValue = $this->tahapan->CurrentValue;
					}
				}
			} else {
				$this->tahapan->ViewValue = NULL;
			}
			$this->tahapan->ViewCustomAttributes = "";

			// namaberkas
			if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
				$this->namaberkas->ViewValue = $this->namaberkas->Upload->DbValue;
			} else {
				$this->namaberkas->ViewValue = "";
			}
			$this->namaberkas->ViewCustomAttributes = "";

			// instruktur
			$this->instruktur->ViewValue = $this->instruktur->CurrentValue;
			$this->instruktur->ViewCustomAttributes = "";

			// tempat
			$this->tempat->ViewValue = $this->tempat->CurrentValue;
			$this->tempat->ViewCustomAttributes = "";

			// jpeserta
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->CellCssStyle .= "text-align: right;";
			$this->jpeserta->ViewCustomAttributes = "";

			// targetpes
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->CellCssStyle .= "text-align: right;";
			$this->targetpes->ViewCustomAttributes = "";

			// Tahun
			$this->Tahun->ViewValue = $this->Tahun->CurrentValue;
			$this->Tahun->ViewCustomAttributes = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";
			if (!$this->isExport())
				$this->kdjudul->ViewValue = $this->highlightValue($this->kdjudul);

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";
			$this->tawal->TooltipValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";
			$this->takhir->TooltipValue = "";

			// tglpel
			$this->tglpel->LinkCustomAttributes = "";
			$this->tglpel->HrefValue = "";
			$this->tglpel->TooltipValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";
			$this->jenispel->TooltipValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";
			$this->kerjasama->TooltipValue = "";
			if (!$this->isExport())
				$this->kerjasama->ViewValue = $this->highlightValue($this->kerjasama);

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";
			$this->biaya->TooltipValue = "";
			if (!$this->isExport())
				$this->biaya->ViewValue = $this->highlightValue($this->biaya);

			// coachingprogr
			$this->coachingprogr->LinkCustomAttributes = "";
			$this->coachingprogr->HrefValue = "";
			$this->coachingprogr->TooltipValue = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";
			$this->area->TooltipValue = "";
			if (!$this->isExport())
				$this->area->ViewValue = $this->highlightValue($this->area);

			// periode_awal
			$this->periode_awal->LinkCustomAttributes = "";
			$this->periode_awal->HrefValue = "";
			$this->periode_awal->TooltipValue = "";
			if (!$this->isExport())
				$this->periode_awal->ViewValue = $this->highlightValue($this->periode_awal);

			// periode_akhir
			$this->periode_akhir->LinkCustomAttributes = "";
			$this->periode_akhir->HrefValue = "";
			$this->periode_akhir->TooltipValue = "";
			if (!$this->isExport())
				$this->periode_akhir->ViewValue = $this->highlightValue($this->periode_akhir);

			// tahapan
			$this->tahapan->LinkCustomAttributes = "";
			$this->tahapan->HrefValue = "";
			$this->tahapan->TooltipValue = "";

			// namaberkas
			$this->namaberkas->LinkCustomAttributes = "";
			if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
				$this->namaberkas->HrefValue = GetFileUploadUrl($this->namaberkas, $this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)); // Add prefix/suffix
				$this->namaberkas->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport())
					$this->namaberkas->HrefValue = FullUrl($this->namaberkas->HrefValue, "href");
			} else {
				$this->namaberkas->HrefValue = "";
			}
			$this->namaberkas->ExportHrefValue = $this->namaberkas->UploadPath . $this->namaberkas->Upload->DbValue;
			$this->namaberkas->TooltipValue = "";

			// instruktur
			$this->instruktur->LinkCustomAttributes = "";
			$this->instruktur->HrefValue = "";
			$this->instruktur->TooltipValue = "";
			if (!$this->isExport())
				$this->instruktur->ViewValue = $this->highlightValue($this->instruktur);

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";
			$this->tempat->TooltipValue = "";

			// jpeserta
			$this->jpeserta->LinkCustomAttributes = "";
			$this->jpeserta->HrefValue = "";
			$this->jpeserta->TooltipValue = "";
			if (!$this->isExport())
				$this->jpeserta->ViewValue = $this->highlightValue($this->jpeserta);

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";
			$this->targetpes->TooltipValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";
			$this->Tahun->TooltipValue = "";
			if (!$this->isExport())
				$this->Tahun->ViewValue = $this->highlightValue($this->Tahun);
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if ($this->kdjudul->getSessionValue() != "") {
				$this->kdjudul->CurrentValue = $this->kdjudul->getSessionValue();
				$this->kdjudul->OldValue = $this->kdjudul->CurrentValue;
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
			} else {
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
			}

			// tawal
			$this->tawal->EditAttrs["class"] = "form-control";
			$this->tawal->EditCustomAttributes = "";
			$this->tawal->EditValue = HtmlEncode(FormatDateTime($this->tawal->CurrentValue, 8));
			$this->tawal->PlaceHolder = RemoveHtml($this->tawal->caption());

			// takhir
			$this->takhir->EditAttrs["class"] = "form-control";
			$this->takhir->EditCustomAttributes = "";
			$this->takhir->EditValue = HtmlEncode(FormatDateTime($this->takhir->CurrentValue, 8));
			$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

			// tglpel
			$this->tglpel->EditAttrs["class"] = "form-control";
			$this->tglpel->EditCustomAttributes = "";
			$this->tglpel->EditValue = HtmlEncode($this->tglpel->CurrentValue);
			$this->tglpel->PlaceHolder = RemoveHtml($this->tglpel->caption());

			// jenispel
			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			$this->jenispel->EditValue = $this->jenispel->options(TRUE);

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

			// biaya
			$this->biaya->EditAttrs["class"] = "form-control";
			$this->biaya->EditCustomAttributes = "";
			$this->biaya->EditValue = HtmlEncode($this->biaya->CurrentValue);
			$this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
			if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue)) {
				$this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -1, -2, 0);
				$this->biaya->OldValue = $this->biaya->EditValue;
			}
			

			// coachingprogr
			$this->coachingprogr->EditAttrs["class"] = "form-control";
			$this->coachingprogr->EditCustomAttributes = "";
			$this->coachingprogr->EditValue = $this->coachingprogr->options(TRUE);

			// area
			$this->area->EditAttrs["class"] = "form-control";
			$this->area->EditCustomAttributes = "";
			if (!$this->area->Raw)
				$this->area->CurrentValue = HtmlDecode($this->area->CurrentValue);
			$this->area->EditValue = HtmlEncode($this->area->CurrentValue);
			$this->area->PlaceHolder = RemoveHtml($this->area->caption());

			// periode_awal
			$this->periode_awal->EditAttrs["class"] = "form-control";
			$this->periode_awal->EditCustomAttributes = "";
			$this->periode_awal->EditValue = HtmlEncode($this->periode_awal->CurrentValue);
			$this->periode_awal->PlaceHolder = RemoveHtml($this->periode_awal->caption());

			// periode_akhir
			$this->periode_akhir->EditAttrs["class"] = "form-control";
			$this->periode_akhir->EditCustomAttributes = "";
			$this->periode_akhir->EditValue = HtmlEncode($this->periode_akhir->CurrentValue);
			$this->periode_akhir->PlaceHolder = RemoveHtml($this->periode_akhir->caption());

			// tahapan
			$this->tahapan->EditAttrs["class"] = "form-control";
			$this->tahapan->EditCustomAttributes = "";
			$curVal = trim(strval($this->tahapan->CurrentValue));
			if ($curVal != "")
				$this->tahapan->ViewValue = $this->tahapan->lookupCacheOption($curVal);
			else
				$this->tahapan->ViewValue = $this->tahapan->Lookup !== NULL && is_array($this->tahapan->Lookup->Options) ? $curVal : NULL;
			if ($this->tahapan->ViewValue !== NULL) { // Load from cache
				$this->tahapan->EditValue = array_values($this->tahapan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdtahapan`" . SearchString("=", $this->tahapan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->tahapan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->tahapan->EditValue = $arwrk;
			}

			// namaberkas
			$this->namaberkas->EditAttrs["class"] = "form-control";
			$this->namaberkas->EditCustomAttributes = "";
			if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
				$this->namaberkas->EditValue = $this->namaberkas->Upload->DbValue;
			} else {
				$this->namaberkas->EditValue = "";
			}
			if (!EmptyValue($this->namaberkas->CurrentValue))
					$this->namaberkas->Upload->FileName = $this->namaberkas->CurrentValue;
			if (is_numeric($this->RowIndex))
				RenderUploadField($this->namaberkas, $this->RowIndex);

			// instruktur
			$this->instruktur->EditAttrs["class"] = "form-control";
			$this->instruktur->EditCustomAttributes = "";
			if (!$this->instruktur->Raw)
				$this->instruktur->CurrentValue = HtmlDecode($this->instruktur->CurrentValue);
			$this->instruktur->EditValue = HtmlEncode($this->instruktur->CurrentValue);
			$this->instruktur->PlaceHolder = RemoveHtml($this->instruktur->caption());

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			$this->tempat->EditValue = HtmlEncode($this->tempat->CurrentValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// jpeserta
			$this->jpeserta->EditAttrs["class"] = "form-control";
			$this->jpeserta->EditCustomAttributes = "";
			$this->jpeserta->EditValue = HtmlEncode($this->jpeserta->CurrentValue);
			$this->jpeserta->PlaceHolder = RemoveHtml($this->jpeserta->caption());

			// targetpes
			$this->targetpes->EditAttrs["class"] = "form-control";
			$this->targetpes->EditCustomAttributes = "";
			$this->targetpes->EditValue = HtmlEncode($this->targetpes->CurrentValue);
			$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

			// Tahun
			$this->Tahun->EditAttrs["class"] = "form-control";
			$this->Tahun->EditCustomAttributes = "";
			$this->Tahun->EditValue = HtmlEncode($this->Tahun->CurrentValue);
			$this->Tahun->PlaceHolder = RemoveHtml($this->Tahun->caption());

			// Add refer script
			// kdjudul

			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";

			// tglpel
			$this->tglpel->LinkCustomAttributes = "";
			$this->tglpel->HrefValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";

			// coachingprogr
			$this->coachingprogr->LinkCustomAttributes = "";
			$this->coachingprogr->HrefValue = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";

			// periode_awal
			$this->periode_awal->LinkCustomAttributes = "";
			$this->periode_awal->HrefValue = "";

			// periode_akhir
			$this->periode_akhir->LinkCustomAttributes = "";
			$this->periode_akhir->HrefValue = "";

			// tahapan
			$this->tahapan->LinkCustomAttributes = "";
			$this->tahapan->HrefValue = "";

			// namaberkas
			$this->namaberkas->LinkCustomAttributes = "";
			if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
				$this->namaberkas->HrefValue = GetFileUploadUrl($this->namaberkas, $this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)); // Add prefix/suffix
				$this->namaberkas->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport())
					$this->namaberkas->HrefValue = FullUrl($this->namaberkas->HrefValue, "href");
			} else {
				$this->namaberkas->HrefValue = "";
			}
			$this->namaberkas->ExportHrefValue = $this->namaberkas->UploadPath . $this->namaberkas->Upload->DbValue;

			// instruktur
			$this->instruktur->LinkCustomAttributes = "";
			$this->instruktur->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";

			// jpeserta
			$this->jpeserta->LinkCustomAttributes = "";
			$this->jpeserta->HrefValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if ($this->kdjudul->VirtualValue != "") {
				$this->kdjudul->EditValue = $this->kdjudul->VirtualValue;
			} else {
				$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
				$curVal = strval($this->kdjudul->CurrentValue);
				if ($curVal != "") {
					$this->kdjudul->EditValue = $this->kdjudul->lookupCacheOption($curVal);
					if ($this->kdjudul->EditValue === NULL) { // Lookup from database
						$filterWrk = "`kdjudul`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->kdjudul->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->kdjudul->EditValue = $this->kdjudul->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
						}
					}
				} else {
					$this->kdjudul->EditValue = NULL;
				}
			}
			$this->kdjudul->ViewCustomAttributes = "";

			// tawal
			$this->tawal->EditAttrs["class"] = "form-control";
			$this->tawal->EditCustomAttributes = "";
			$this->tawal->EditValue = $this->tawal->CurrentValue;
			$this->tawal->EditValue = FormatDateTime($this->tawal->EditValue, 0);
			$this->tawal->ViewCustomAttributes = "";

			// takhir
			$this->takhir->EditAttrs["class"] = "form-control";
			$this->takhir->EditCustomAttributes = "";
			$this->takhir->EditValue = $this->takhir->CurrentValue;
			$this->takhir->EditValue = FormatDateTime($this->takhir->EditValue, 0);
			$this->takhir->ViewCustomAttributes = "";

			// tglpel
			$this->tglpel->EditAttrs["class"] = "form-control";
			$this->tglpel->EditCustomAttributes = "";
			$this->tglpel->EditValue = HtmlEncode($this->tglpel->CurrentValue);
			$this->tglpel->PlaceHolder = RemoveHtml($this->tglpel->caption());

			// jenispel
			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			if (strval($this->jenispel->CurrentValue) != "") {
				$this->jenispel->EditValue = $this->jenispel->optionCaption($this->jenispel->CurrentValue);
			} else {
				$this->jenispel->EditValue = NULL;
			}
			$this->jenispel->ViewCustomAttributes = "";

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

			// biaya
			$this->biaya->EditAttrs["class"] = "form-control";
			$this->biaya->EditCustomAttributes = "";
			$this->biaya->EditValue = HtmlEncode($this->biaya->CurrentValue);
			$this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
			if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue)) {
				$this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -1, -2, 0);
				$this->biaya->OldValue = $this->biaya->EditValue;
			}
			

			// coachingprogr
			$this->coachingprogr->EditAttrs["class"] = "form-control";
			$this->coachingprogr->EditCustomAttributes = "";
			$this->coachingprogr->EditValue = $this->coachingprogr->options(TRUE);

			// area
			$this->area->EditAttrs["class"] = "form-control";
			$this->area->EditCustomAttributes = "";
			if (!$this->area->Raw)
				$this->area->CurrentValue = HtmlDecode($this->area->CurrentValue);
			$this->area->EditValue = HtmlEncode($this->area->CurrentValue);
			$this->area->PlaceHolder = RemoveHtml($this->area->caption());

			// periode_awal
			$this->periode_awal->EditAttrs["class"] = "form-control";
			$this->periode_awal->EditCustomAttributes = "";
			$this->periode_awal->EditValue = HtmlEncode($this->periode_awal->CurrentValue);
			$this->periode_awal->PlaceHolder = RemoveHtml($this->periode_awal->caption());

			// periode_akhir
			$this->periode_akhir->EditAttrs["class"] = "form-control";
			$this->periode_akhir->EditCustomAttributes = "";
			$this->periode_akhir->EditValue = HtmlEncode($this->periode_akhir->CurrentValue);
			$this->periode_akhir->PlaceHolder = RemoveHtml($this->periode_akhir->caption());

			// tahapan
			$this->tahapan->EditAttrs["class"] = "form-control";
			$this->tahapan->EditCustomAttributes = "";
			$curVal = trim(strval($this->tahapan->CurrentValue));
			if ($curVal != "")
				$this->tahapan->ViewValue = $this->tahapan->lookupCacheOption($curVal);
			else
				$this->tahapan->ViewValue = $this->tahapan->Lookup !== NULL && is_array($this->tahapan->Lookup->Options) ? $curVal : NULL;
			if ($this->tahapan->ViewValue !== NULL) { // Load from cache
				$this->tahapan->EditValue = array_values($this->tahapan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdtahapan`" . SearchString("=", $this->tahapan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->tahapan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->tahapan->EditValue = $arwrk;
			}

			// namaberkas
			$this->namaberkas->EditAttrs["class"] = "form-control";
			$this->namaberkas->EditCustomAttributes = "";
			if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
				$this->namaberkas->EditValue = $this->namaberkas->Upload->DbValue;
			} else {
				$this->namaberkas->EditValue = "";
			}
			if (!EmptyValue($this->namaberkas->CurrentValue))
					$this->namaberkas->Upload->FileName = $this->namaberkas->CurrentValue;
			if (is_numeric($this->RowIndex))
				RenderUploadField($this->namaberkas, $this->RowIndex);

			// instruktur
			$this->instruktur->EditAttrs["class"] = "form-control";
			$this->instruktur->EditCustomAttributes = "";
			if (!$this->instruktur->Raw)
				$this->instruktur->CurrentValue = HtmlDecode($this->instruktur->CurrentValue);
			$this->instruktur->EditValue = HtmlEncode($this->instruktur->CurrentValue);
			$this->instruktur->PlaceHolder = RemoveHtml($this->instruktur->caption());

			// tempat
			$this->tempat->EditAttrs["class"] = "form-control";
			$this->tempat->EditCustomAttributes = "";
			$this->tempat->EditValue = HtmlEncode($this->tempat->CurrentValue);
			$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

			// jpeserta
			$this->jpeserta->EditAttrs["class"] = "form-control";
			$this->jpeserta->EditCustomAttributes = "";
			$this->jpeserta->EditValue = HtmlEncode($this->jpeserta->CurrentValue);
			$this->jpeserta->PlaceHolder = RemoveHtml($this->jpeserta->caption());

			// targetpes
			$this->targetpes->EditAttrs["class"] = "form-control";
			$this->targetpes->EditCustomAttributes = "";
			$this->targetpes->EditValue = HtmlEncode($this->targetpes->CurrentValue);
			$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

			// Tahun
			$this->Tahun->EditAttrs["class"] = "form-control";
			$this->Tahun->EditCustomAttributes = "";
			$this->Tahun->EditValue = HtmlEncode($this->Tahun->CurrentValue);
			$this->Tahun->PlaceHolder = RemoveHtml($this->Tahun->caption());

			// Edit refer script
			// kdjudul

			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";
			$this->tawal->TooltipValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";
			$this->takhir->TooltipValue = "";

			// tglpel
			$this->tglpel->LinkCustomAttributes = "";
			$this->tglpel->HrefValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";
			$this->jenispel->TooltipValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";

			// coachingprogr
			$this->coachingprogr->LinkCustomAttributes = "";
			$this->coachingprogr->HrefValue = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";

			// periode_awal
			$this->periode_awal->LinkCustomAttributes = "";
			$this->periode_awal->HrefValue = "";

			// periode_akhir
			$this->periode_akhir->LinkCustomAttributes = "";
			$this->periode_akhir->HrefValue = "";

			// tahapan
			$this->tahapan->LinkCustomAttributes = "";
			$this->tahapan->HrefValue = "";

			// namaberkas
			$this->namaberkas->LinkCustomAttributes = "";
			if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
				$this->namaberkas->HrefValue = GetFileUploadUrl($this->namaberkas, $this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)); // Add prefix/suffix
				$this->namaberkas->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport())
					$this->namaberkas->HrefValue = FullUrl($this->namaberkas->HrefValue, "href");
			} else {
				$this->namaberkas->HrefValue = "";
			}
			$this->namaberkas->ExportHrefValue = $this->namaberkas->UploadPath . $this->namaberkas->Upload->DbValue;

			// instruktur
			$this->instruktur->LinkCustomAttributes = "";
			$this->instruktur->HrefValue = "";

			// tempat
			$this->tempat->LinkCustomAttributes = "";
			$this->tempat->HrefValue = "";

			// jpeserta
			$this->jpeserta->LinkCustomAttributes = "";
			$this->jpeserta->HrefValue = "";

			// targetpes
			$this->targetpes->LinkCustomAttributes = "";
			$this->targetpes->HrefValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->jpeserta->Total = 0; // Initialize total
			$this->targetpes->Total = 0; // Initialize total
		} elseif ($this->RowType == ROWTYPE_AGGREGATE) { // Aggregate row
			$this->jpeserta->CurrentValue = $this->jpeserta->Total;
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->CellCssStyle .= "text-align: right;";
			$this->jpeserta->ViewCustomAttributes = "";
			$this->jpeserta->HrefValue = ""; // Clear href value
			$this->targetpes->CurrentValue = $this->targetpes->Total;
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->CellCssStyle .= "text-align: right;";
			$this->targetpes->ViewCustomAttributes = "";
			$this->targetpes->HrefValue = ""; // Clear href value
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
		if ($this->kdjudul->Required) {
			if (!$this->kdjudul->IsDetailKey && $this->kdjudul->FormValue != NULL && $this->kdjudul->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdjudul->caption(), $this->kdjudul->RequiredErrorMessage));
			}
		}
		if ($this->tawal->Required) {
			if (!$this->tawal->IsDetailKey && $this->tawal->FormValue != NULL && $this->tawal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tawal->caption(), $this->tawal->RequiredErrorMessage));
			}
		}
		if ($this->takhir->Required) {
			if (!$this->takhir->IsDetailKey && $this->takhir->FormValue != NULL && $this->takhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->takhir->caption(), $this->takhir->RequiredErrorMessage));
			}
		}
		if ($this->tglpel->Required) {
			if (!$this->tglpel->IsDetailKey && $this->tglpel->FormValue != NULL && $this->tglpel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tglpel->caption(), $this->tglpel->RequiredErrorMessage));
			}
		}
		if ($this->jenispel->Required) {
			if (!$this->jenispel->IsDetailKey && $this->jenispel->FormValue != NULL && $this->jenispel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenispel->caption(), $this->jenispel->RequiredErrorMessage));
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
		if ($this->biaya->Required) {
			if (!$this->biaya->IsDetailKey && $this->biaya->FormValue != NULL && $this->biaya->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->biaya->caption(), $this->biaya->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->biaya->FormValue)) {
			AddMessage($FormError, $this->biaya->errorMessage());
		}
		if ($this->coachingprogr->Required) {
			if (!$this->coachingprogr->IsDetailKey && $this->coachingprogr->FormValue != NULL && $this->coachingprogr->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->coachingprogr->caption(), $this->coachingprogr->RequiredErrorMessage));
			}
		}
		if ($this->area->Required) {
			if (!$this->area->IsDetailKey && $this->area->FormValue != NULL && $this->area->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->area->caption(), $this->area->RequiredErrorMessage));
			}
		}
		if ($this->periode_awal->Required) {
			if (!$this->periode_awal->IsDetailKey && $this->periode_awal->FormValue != NULL && $this->periode_awal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->periode_awal->caption(), $this->periode_awal->RequiredErrorMessage));
			}
		}
		if ($this->periode_akhir->Required) {
			if (!$this->periode_akhir->IsDetailKey && $this->periode_akhir->FormValue != NULL && $this->periode_akhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->periode_akhir->caption(), $this->periode_akhir->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->periode_akhir->FormValue)) {
			AddMessage($FormError, $this->periode_akhir->errorMessage());
		}
		if ($this->tahapan->Required) {
			if (!$this->tahapan->IsDetailKey && $this->tahapan->FormValue != NULL && $this->tahapan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tahapan->caption(), $this->tahapan->RequiredErrorMessage));
			}
		}
		if ($this->namaberkas->Required) {
			if ($this->namaberkas->Upload->FileName == "" && !$this->namaberkas->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->namaberkas->caption(), $this->namaberkas->RequiredErrorMessage));
			}
		}
		if ($this->instruktur->Required) {
			if (!$this->instruktur->IsDetailKey && $this->instruktur->FormValue != NULL && $this->instruktur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->instruktur->caption(), $this->instruktur->RequiredErrorMessage));
			}
		}
		if ($this->tempat->Required) {
			if (!$this->tempat->IsDetailKey && $this->tempat->FormValue != NULL && $this->tempat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tempat->caption(), $this->tempat->RequiredErrorMessage));
			}
		}
		if ($this->jpeserta->Required) {
			if (!$this->jpeserta->IsDetailKey && $this->jpeserta->FormValue != NULL && $this->jpeserta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jpeserta->caption(), $this->jpeserta->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jpeserta->FormValue)) {
			AddMessage($FormError, $this->jpeserta->errorMessage());
		}
		if ($this->targetpes->Required) {
			if (!$this->targetpes->IsDetailKey && $this->targetpes->FormValue != NULL && $this->targetpes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->targetpes->caption(), $this->targetpes->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->targetpes->FormValue)) {
			AddMessage($FormError, $this->targetpes->errorMessage());
		}
		if ($this->Tahun->Required) {
			if (!$this->Tahun->IsDetailKey && $this->Tahun->FormValue != NULL && $this->Tahun->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tahun->caption(), $this->Tahun->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Tahun->FormValue)) {
			AddMessage($FormError, $this->Tahun->errorMessage());
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
				$thisKey .= $row['idpelat'];
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
			$rsnew = [];

			// tglpel
			$this->tglpel->setDbValueDef($rsnew, $this->tglpel->CurrentValue, NULL, $this->tglpel->ReadOnly);

			// kerjasama
			$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, NULL, $this->kerjasama->ReadOnly);

			// biaya
			$this->biaya->setDbValueDef($rsnew, $this->biaya->CurrentValue, NULL, $this->biaya->ReadOnly);

			// coachingprogr
			$this->coachingprogr->setDbValueDef($rsnew, $this->coachingprogr->CurrentValue, NULL, $this->coachingprogr->ReadOnly);

			// area
			$this->area->setDbValueDef($rsnew, $this->area->CurrentValue, NULL, $this->area->ReadOnly);

			// periode_awal
			$this->periode_awal->setDbValueDef($rsnew, $this->periode_awal->CurrentValue, NULL, $this->periode_awal->ReadOnly);

			// periode_akhir
			$this->periode_akhir->setDbValueDef($rsnew, $this->periode_akhir->CurrentValue, NULL, $this->periode_akhir->ReadOnly);

			// tahapan
			$this->tahapan->setDbValueDef($rsnew, $this->tahapan->CurrentValue, NULL, $this->tahapan->ReadOnly);

			// namaberkas
			if ($this->namaberkas->Visible && !$this->namaberkas->ReadOnly && !$this->namaberkas->Upload->KeepFile) {
				$this->namaberkas->Upload->DbValue = $rsold['namaberkas']; // Get original value
				if ($this->namaberkas->Upload->FileName == "") {
					$rsnew['namaberkas'] = NULL;
				} else {
					$rsnew['namaberkas'] = $this->namaberkas->Upload->FileName;
				}
			}

			// instruktur
			$this->instruktur->setDbValueDef($rsnew, $this->instruktur->CurrentValue, "", $this->instruktur->ReadOnly);

			// tempat
			$this->tempat->setDbValueDef($rsnew, $this->tempat->CurrentValue, NULL, $this->tempat->ReadOnly);

			// jpeserta
			$this->jpeserta->setDbValueDef($rsnew, $this->jpeserta->CurrentValue, NULL, $this->jpeserta->ReadOnly);

			// targetpes
			$this->targetpes->setDbValueDef($rsnew, $this->targetpes->CurrentValue, NULL, $this->targetpes->ReadOnly);

			// Tahun
			$this->Tahun->setDbValueDef($rsnew, $this->Tahun->CurrentValue, NULL, $this->Tahun->ReadOnly);

			// Check referential integrity for master table 't_judul'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_judul();
			$keyValue = isset($rsnew['kdjudul']) ? $rsnew['kdjudul'] : $rsold['kdjudul'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@kdjudul@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_judul"]))
					$GLOBALS["t_judul"] = new t_judul();
				$rsmaster = $GLOBALS["t_judul"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_judul", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Check referential integrity for master table 't_kota'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_kota();
			$keyValue = isset($rsnew['kdkota']) ? $rsnew['kdkota'] : $rsold['kdkota'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@kdkota@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_kota"]))
					$GLOBALS["t_kota"] = new t_kota();
				$rsmaster = $GLOBALS["t_kota"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_kota", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Check referential integrity for master table 't_prop'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_prop();
			$keyValue = isset($rsnew['kdprop']) ? $rsnew['kdprop'] : $rsold['kdprop'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@kdprop@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_prop"]))
					$GLOBALS["t_prop"] = new t_prop();
				$rsmaster = $GLOBALS["t_prop"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_prop", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}
			if ($this->namaberkas->Visible && !$this->namaberkas->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->namaberkas->Upload->DbValue) ? [] : [$this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)];
				if (!EmptyValue($this->namaberkas->Upload->FileName)) {
					$newFiles = [$this->namaberkas->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->namaberkas, $this->namaberkas->Upload->Index);
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
								$file1 = UniqueFilename($this->namaberkas->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->namaberkas->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->namaberkas->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->namaberkas->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->namaberkas->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->namaberkas->setDbValueDef($rsnew, $this->namaberkas->Upload->FileName, NULL, $this->namaberkas->ReadOnly);
				}
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
					if ($this->namaberkas->Visible && !$this->namaberkas->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->namaberkas->Upload->DbValue) ? [] : [$this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)];
						if (!EmptyValue($this->namaberkas->Upload->FileName)) {
							$newFiles = [$this->namaberkas->Upload->FileName];
							$newFiles2 = [$this->namaberkas->htmlDecode($rsnew['namaberkas'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->namaberkas, $this->namaberkas->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->namaberkas->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->namaberkas->oldPhysicalUploadPath() . $oldFile);
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

			// namaberkas
			CleanUploadTempPath($this->namaberkas, $this->namaberkas->Upload->Index);
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
			if ($this->getCurrentMasterTable() == "t_judul") {
				$this->kdjudul->CurrentValue = $this->kdjudul->getSessionValue();
			}
			if ($this->getCurrentMasterTable() == "t_kota") {
				$this->kdkota->CurrentValue = $this->kdkota->getSessionValue();
			}
			if ($this->getCurrentMasterTable() == "t_prop") {
				$this->kdprop->CurrentValue = $this->kdprop->getSessionValue();
			}

		// Check referential integrity for master table 't_pelatihan'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_judul();
		if (strval($this->kdjudul->CurrentValue) != "") {
			$masterFilter = str_replace("@kdjudul@", AdjustSql($this->kdjudul->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_judul"]))
				$GLOBALS["t_judul"] = new t_judul();
			$rsmaster = $GLOBALS["t_judul"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_judul", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}

		// Check referential integrity for master table 't_pelatihan'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_kota();
		if ($this->kdkota->getSessionValue() != "") {
			$masterFilter = str_replace("@kdkota@", AdjustSql($this->kdkota->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_kota"]))
				$GLOBALS["t_kota"] = new t_kota();
			$rsmaster = $GLOBALS["t_kota"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_kota", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}

		// Check referential integrity for master table 't_pelatihan'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_prop();
		if ($this->kdprop->getSessionValue() != "") {
			$masterFilter = str_replace("@kdprop@", AdjustSql($this->kdprop->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_prop"]))
				$GLOBALS["t_prop"] = new t_prop();
			$rsmaster = $GLOBALS["t_prop"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_prop", $Language->phrase("RelatedRecordRequired"));
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

		// tawal
		$this->tawal->setDbValueDef($rsnew, UnFormatDateTime($this->tawal->CurrentValue, 0), NULL, FALSE);

		// takhir
		$this->takhir->setDbValueDef($rsnew, UnFormatDateTime($this->takhir->CurrentValue, 0), NULL, FALSE);

		// tglpel
		$this->tglpel->setDbValueDef($rsnew, $this->tglpel->CurrentValue, NULL, FALSE);

		// jenispel
		$this->jenispel->setDbValueDef($rsnew, $this->jenispel->CurrentValue, NULL, FALSE);

		// kerjasama
		$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, NULL, FALSE);

		// biaya
		$this->biaya->setDbValueDef($rsnew, $this->biaya->CurrentValue, NULL, FALSE);

		// coachingprogr
		$this->coachingprogr->setDbValueDef($rsnew, $this->coachingprogr->CurrentValue, NULL, FALSE);

		// area
		$this->area->setDbValueDef($rsnew, $this->area->CurrentValue, NULL, FALSE);

		// periode_awal
		$this->periode_awal->setDbValueDef($rsnew, $this->periode_awal->CurrentValue, NULL, FALSE);

		// periode_akhir
		$this->periode_akhir->setDbValueDef($rsnew, $this->periode_akhir->CurrentValue, NULL, FALSE);

		// tahapan
		$this->tahapan->setDbValueDef($rsnew, $this->tahapan->CurrentValue, NULL, FALSE);

		// namaberkas
		if ($this->namaberkas->Visible && !$this->namaberkas->Upload->KeepFile) {
			$this->namaberkas->Upload->DbValue = ""; // No need to delete old file
			if ($this->namaberkas->Upload->FileName == "") {
				$rsnew['namaberkas'] = NULL;
			} else {
				$rsnew['namaberkas'] = $this->namaberkas->Upload->FileName;
			}
		}

		// instruktur
		$this->instruktur->setDbValueDef($rsnew, $this->instruktur->CurrentValue, "", FALSE);

		// tempat
		$this->tempat->setDbValueDef($rsnew, $this->tempat->CurrentValue, NULL, FALSE);

		// jpeserta
		$this->jpeserta->setDbValueDef($rsnew, $this->jpeserta->CurrentValue, NULL, FALSE);

		// targetpes
		$this->targetpes->setDbValueDef($rsnew, $this->targetpes->CurrentValue, NULL, FALSE);

		// Tahun
		$this->Tahun->setDbValueDef($rsnew, $this->Tahun->CurrentValue, NULL, FALSE);

		// kdprop
		if ($this->kdprop->getSessionValue() != "") {
			$rsnew['kdprop'] = $this->kdprop->getSessionValue();
		}

		// kdkota
		if ($this->kdkota->getSessionValue() != "") {
			$rsnew['kdkota'] = $this->kdkota->getSessionValue();
		}
		if ($this->namaberkas->Visible && !$this->namaberkas->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->namaberkas->Upload->DbValue) ? [] : [$this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)];
			if (!EmptyValue($this->namaberkas->Upload->FileName)) {
				$newFiles = [$this->namaberkas->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->namaberkas, $this->namaberkas->Upload->Index);
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
							$file1 = UniqueFilename($this->namaberkas->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->namaberkas->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->namaberkas->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->namaberkas->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->namaberkas->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->namaberkas->setDbValueDef($rsnew, $this->namaberkas->Upload->FileName, NULL, FALSE);
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
				if ($this->namaberkas->Visible && !$this->namaberkas->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->namaberkas->Upload->DbValue) ? [] : [$this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)];
					if (!EmptyValue($this->namaberkas->Upload->FileName)) {
						$newFiles = [$this->namaberkas->Upload->FileName];
						$newFiles2 = [$this->namaberkas->htmlDecode($rsnew['namaberkas'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->namaberkas, $this->namaberkas->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->namaberkas->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->namaberkas->oldPhysicalUploadPath() . $oldFile);
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
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {

			// namaberkas
			CleanUploadTempPath($this->namaberkas, $this->namaberkas->Upload->Index);
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
		if ($masterTblVar == "t_judul") {
			$this->kdjudul->Visible = FALSE;
			if ($GLOBALS["t_judul"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		if ($masterTblVar == "t_kota") {
			$this->kdkota->Visible = FALSE;
			if ($GLOBALS["t_kota"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		if ($masterTblVar == "t_prop") {
			$this->kdprop->Visible = FALSE;
			if ($GLOBALS["t_prop"]->EventCancelled)
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
				case "x_kdjudul":
					break;
				case "x_kdkursil":
					break;
				case "x_pilihan_iso":
					break;
				case "x_kdprop":
					break;
				case "x_kdkota":
					break;
				case "x_kdkec":
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
				case "x_jenispel":
					break;
				case "x_kdkategori":
					break;
				case "x_kerjasama":
					break;
				case "x_dana":
					break;
				case "x_coachingprogr":
					break;
				case "x_tahapan":
					break;
				case "x_statuspel":
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
						case "x_kdprop":
							break;
						case "x_kdkota":
							break;
						case "x_kdkec":
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
						case "x_kdkategori":
							break;
						case "x_kerjasama":
							break;
						case "x_tahapan":
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
		$this->kdpelat->Visible = FALSE;
		if(isset($_GET["h"])){ // pelatihan tunda
			if(@$_GET["bulan"] == @$_GET["bulan2"]){
				$tampilbulan = ucfirst(BulanIndo(@$_GET["bulan"])) . ".";
			} else {
				if(@$_GET["bulan"] == 1 && @$_GET["bulan2"] >= 12){
					$tampilbulan = "";
				} else {
					$tampilbulan = ucfirst(BulanIndo(@$_GET["bulan"])) . ".sd." . ucfirst(BulanIndo(@$_GET["bulan2"])) . " .";
				}
			}
			$GLOBALS["ExportFileName"] = "9. Pelatihan.Tunda.".$tampilbulan."Th." . @$_GET["tahun"];
		} else { 
			$GLOBALS["ExportFileName"] = "Daftar_Pelatihan-PPE".CurrentDate();
		}
		if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){
			$item = &$this->ExportOptions->Add("excel");
			$item->Body = '<a class="btn btn-default ewExportLink ewExcel" href="t_pelatihanlist.php?export=excel&pegid='.$_GET["pegid"].'" title="" data-caption="Excel" data-original-title="Excel"><span data-phrase="ExportToExcel" class="icon-excel ewIcon" data-caption="Export to Excel"></span></a>';
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

		$this->Tahun->Visible = FALSE;
		if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){
			$nm = ExecuteScalar("SELECT nama FROM `t_pegawai` WHERE `id_peg` = '".$_GET["pegid"]."'");
			$myh = "<center><h4>Daftar Pelatihan dengan Panitia : <u>".$nm."</u></h4></center>";
			$header = $myh;
		} else {
			if ($this->Export <> "") {
				if(isset($_GET["h"])){
					$myh = "";
				} else {
					$myh = "<center><h4>Daftar Pelatihan</h4></center>";
				}
			} else {
				$myh = "";
			}
		}
		if ($this->Export <> "") {
			$header = $myh;
		} else {
				if(CurrentUserLevel() == 1){ //user manajemen
					$this->ketua->Visible = FALSE;
					$this->sekretaris->Visible = FALSE;
					$this->bendahara->Visible = FALSE;
					$this->anggota2->Visible = FALSE;
					$this->widyaiswara->Visible = FALSE;
					$this->kdkategori->Visible = FALSE;
				}
			$this->tawal->Visible = FALSE;
			$this->takhir->Visible = FALSE;
			$this->kdkec->Visible = FALSE;
			$this->jenispel->Visible = FALSE;
			$this->kerjasama->Visible = FALSE;
			$this->biaya->Visible = FALSE;
			$this->coachingprogr->Visible = FALSE;
			$this->area->Visible = FALSE;
			$this->periode_awal->Visible = FALSE;
			$this->periode_akhir->Visible = FALSE;
			$this->tahapan->Visible = FALSE;
			$this->namaberkas->Visible = FALSE;
			$this->nmou->Visible = FALSE;
			$this->nmou2->Visible = FALSE;
			$header = $myh;
		}
		if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){
			$this->sekretaris->Visible = FALSE;
			$this->bendahara->Visible = FALSE;
			$this->kdkategori->Visible = FALSE;
			$this->instruktur->Visible = FALSE;

			//$this->ketua->setFldCaption("SEBAGAI");
			$this->idpelat->Exportable = FALSE;
			$this->kdpelat->Exportable = FALSE;
			$this->sekretaris->Exportable = FALSE;
			$this->bendahara->Exportable = FALSE;
			$this->anggota2->Exportable = FALSE;
			$this->kdkategori->Exportable = FALSE;
			$this->instruktur->Exportable = FALSE;
			$this->kdkec->Exportable = FALSE;
			$this->jenispel->Exportable = FALSE;
			$this->kerjasama->Exportable = FALSE;
			$this->biaya->Exportable = FALSE;
			$this->coachingprogr->Exportable = FALSE;
			$this->area->Exportable = FALSE;
			$this->periode_awal->Exportable = FALSE;
			$this->periode_akhir->Exportable = FALSE;
			$this->tahapan->Exportable = FALSE;
			$this->namaberkas->Visible = FALSE;
			$this->nmou->Visible = FALSE;
			$this->nmou2->Visible = FALSE;
		}

	//	$this->idpelat->Visible = FALSE;
		$this->instruktur->Visible = FALSE;
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