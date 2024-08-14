<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_pelatihan_search extends t_pelatihan
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_pelatihan';

	// Page object name
	public $PageObjName = "t_pelatihan_search";

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

		// Table object (t_pelatihan)
		if (!isset($GLOBALS["t_pelatihan"]) || get_class($GLOBALS["t_pelatihan"]) == PROJECT_NAMESPACE . "t_pelatihan") {
			$GLOBALS["t_pelatihan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_pelatihan"];
		}

		// Table object (t_judul)
		if (!isset($GLOBALS['t_judul']))
			$GLOBALS['t_judul'] = new t_judul();

		// Table object (t_kota)
		if (!isset($GLOBALS['t_kota']))
			$GLOBALS['t_kota'] = new t_kota();

		// Table object (t_prop)
		if (!isset($GLOBALS['t_prop']))
			$GLOBALS['t_prop'] = new t_prop();

		// Table object (t_users)
		if (!isset($GLOBALS['t_users']))
			$GLOBALS['t_users'] = new t_users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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
					if ($pageName == "t_pelatihanview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_pelatihanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->idpelat->Visible = FALSE;
		$this->kdpelat->setVisibility();
		$this->kdjudul->setVisibility();
		$this->kdkursil->setVisibility();
		$this->revisi->setVisibility();
		$this->tgl_terbit->setVisibility();
		$this->pilihan_iso->setVisibility();
		$this->tawal->setVisibility();
		$this->takhir->setVisibility();
		$this->tglpel->setVisibility();
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->ketua->setVisibility();
		$this->sekretaris->setVisibility();
		$this->bendahara->setVisibility();
		$this->anggota2->setVisibility();
		$this->widyaiswara->setVisibility();
		$this->jenisevaluasi->setVisibility();
		$this->created_at->Visible = FALSE;
		$this->user_created_by->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->user_updated_by->Visible = FALSE;
		$this->jenispel->setVisibility();
		$this->kdkategori->setVisibility();
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
		$this->statuspel->setVisibility();
		$this->ket->setVisibility();
		$this->tempat->Visible = FALSE;
		$this->jpeserta->setVisibility();
		$this->jml_hari->Visible = FALSE;
		$this->targetpes->Visible = FALSE;
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

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "t_pelatihanlist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->kdpelat); // kdpelat
		$this->buildSearchUrl($srchUrl, $this->kdjudul); // kdjudul
		$this->buildSearchUrl($srchUrl, $this->kdkursil); // kdkursil
		$this->buildSearchUrl($srchUrl, $this->revisi); // revisi
		$this->buildSearchUrl($srchUrl, $this->tgl_terbit); // tgl_terbit
		$this->buildSearchUrl($srchUrl, $this->pilihan_iso); // pilihan_iso
		$this->buildSearchUrl($srchUrl, $this->tawal); // tawal
		$this->buildSearchUrl($srchUrl, $this->takhir); // takhir
		$this->buildSearchUrl($srchUrl, $this->tglpel); // tglpel
		$this->buildSearchUrl($srchUrl, $this->kdprop); // kdprop
		$this->buildSearchUrl($srchUrl, $this->kdkota); // kdkota
		$this->buildSearchUrl($srchUrl, $this->kdkec); // kdkec
		$this->buildSearchUrl($srchUrl, $this->ketua); // ketua
		$this->buildSearchUrl($srchUrl, $this->sekretaris); // sekretaris
		$this->buildSearchUrl($srchUrl, $this->bendahara); // bendahara
		$this->buildSearchUrl($srchUrl, $this->anggota2); // anggota2
		$this->buildSearchUrl($srchUrl, $this->widyaiswara); // widyaiswara
		$this->buildSearchUrl($srchUrl, $this->jenisevaluasi); // jenisevaluasi
		$this->buildSearchUrl($srchUrl, $this->jenispel); // jenispel
		$this->buildSearchUrl($srchUrl, $this->kdkategori); // kdkategori
		$this->buildSearchUrl($srchUrl, $this->kerjasama); // kerjasama
		$this->buildSearchUrl($srchUrl, $this->biaya); // biaya
		$this->buildSearchUrl($srchUrl, $this->coachingprogr); // coachingprogr
		$this->buildSearchUrl($srchUrl, $this->area); // area
		$this->buildSearchUrl($srchUrl, $this->periode_awal); // periode_awal
		$this->buildSearchUrl($srchUrl, $this->periode_akhir); // periode_akhir
		$this->buildSearchUrl($srchUrl, $this->tahapan); // tahapan
		$this->buildSearchUrl($srchUrl, $this->namaberkas); // namaberkas
		$this->buildSearchUrl($srchUrl, $this->instruktur); // instruktur
		$this->buildSearchUrl($srchUrl, $this->statuspel); // statuspel
		$this->buildSearchUrl($srchUrl, $this->ket); // ket
		$this->buildSearchUrl($srchUrl, $this->jpeserta); // jpeserta
		$this->buildSearchUrl($srchUrl, $this->Tahun); // Tahun
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->kdpelat->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdjudul->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdkursil->AdvancedSearch->post())
			$got = TRUE;
		if ($this->revisi->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tgl_terbit->AdvancedSearch->post())
			$got = TRUE;
		if ($this->pilihan_iso->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tawal->AdvancedSearch->post())
			$got = TRUE;
		if ($this->takhir->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tglpel->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdprop->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdkota->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdkec->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ketua->AdvancedSearch->post())
			$got = TRUE;
		if ($this->sekretaris->AdvancedSearch->post())
			$got = TRUE;
		if ($this->bendahara->AdvancedSearch->post())
			$got = TRUE;
		if ($this->anggota2->AdvancedSearch->post())
			$got = TRUE;
		if ($this->widyaiswara->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jenisevaluasi->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jenispel->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kdkategori->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kerjasama->AdvancedSearch->post())
			$got = TRUE;
		if ($this->biaya->AdvancedSearch->post())
			$got = TRUE;
		if ($this->coachingprogr->AdvancedSearch->post())
			$got = TRUE;
		if ($this->area->AdvancedSearch->post())
			$got = TRUE;
		if ($this->periode_awal->AdvancedSearch->post())
			$got = TRUE;
		if ($this->periode_akhir->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tahapan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->namaberkas->AdvancedSearch->post())
			$got = TRUE;
		if ($this->instruktur->AdvancedSearch->post())
			$got = TRUE;
		if ($this->statuspel->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ket->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jpeserta->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Tahun->AdvancedSearch->post())
			$got = TRUE;
		return $got;
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kdpelat
			$this->kdpelat->ViewValue = $this->kdpelat->CurrentValue;
			$this->kdpelat->ViewCustomAttributes = "";

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

			// jenisevaluasi
			$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->CurrentValue;
			$this->jenisevaluasi->ViewCustomAttributes = "";

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

			// statuspel
			if (strval($this->statuspel->CurrentValue) != "") {
				$this->statuspel->ViewValue = $this->statuspel->optionCaption($this->statuspel->CurrentValue);
			} else {
				$this->statuspel->ViewValue = NULL;
			}
			$this->statuspel->ViewCustomAttributes = "";

			// ket
			$this->ket->ViewValue = $this->ket->CurrentValue;
			$this->ket->ViewCustomAttributes = "";

			// jpeserta
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->CellCssStyle .= "text-align: right;";
			$this->jpeserta->ViewCustomAttributes = "";

			// Tahun
			$this->Tahun->ViewValue = $this->Tahun->CurrentValue;
			$this->Tahun->ViewCustomAttributes = "";

			// kdpelat
			$this->kdpelat->LinkCustomAttributes = "";
			$this->kdpelat->HrefValue = "";
			$this->kdpelat->TooltipValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";
			$this->kdjudul->TooltipValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";
			$this->kdkursil->TooltipValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";
			$this->revisi->TooltipValue = "";

			// tgl_terbit
			$this->tgl_terbit->LinkCustomAttributes = "";
			$this->tgl_terbit->HrefValue = "";
			$this->tgl_terbit->TooltipValue = "";

			// pilihan_iso
			$this->pilihan_iso->LinkCustomAttributes = "";
			$this->pilihan_iso->HrefValue = "";
			$this->pilihan_iso->TooltipValue = "";

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

			// jenisevaluasi
			$this->jenisevaluasi->LinkCustomAttributes = "";
			$this->jenisevaluasi->HrefValue = "";
			$this->jenisevaluasi->TooltipValue = "";

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

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";
			$this->biaya->TooltipValue = "";

			// coachingprogr
			$this->coachingprogr->LinkCustomAttributes = "";
			$this->coachingprogr->HrefValue = "";
			$this->coachingprogr->TooltipValue = "";

			// area
			$this->area->LinkCustomAttributes = "";
			$this->area->HrefValue = "";
			$this->area->TooltipValue = "";

			// periode_awal
			$this->periode_awal->LinkCustomAttributes = "";
			$this->periode_awal->HrefValue = "";
			$this->periode_awal->TooltipValue = "";

			// periode_akhir
			$this->periode_akhir->LinkCustomAttributes = "";
			$this->periode_akhir->HrefValue = "";
			$this->periode_akhir->TooltipValue = "";

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

			// statuspel
			$this->statuspel->LinkCustomAttributes = "";
			$this->statuspel->HrefValue = "";
			$this->statuspel->TooltipValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";
			$this->ket->TooltipValue = "";

			// jpeserta
			$this->jpeserta->LinkCustomAttributes = "";
			$this->jpeserta->HrefValue = "";
			$this->jpeserta->TooltipValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";
			$this->Tahun->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// kdpelat
			$this->kdpelat->EditAttrs["class"] = "form-control";
			$this->kdpelat->EditCustomAttributes = "";
			if (!$this->kdpelat->Raw)
				$this->kdpelat->AdvancedSearch->SearchValue = HtmlDecode($this->kdpelat->AdvancedSearch->SearchValue);
			$this->kdpelat->EditValue = HtmlEncode($this->kdpelat->AdvancedSearch->SearchValue);
			$this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if (!$this->kdjudul->Raw)
				$this->kdjudul->AdvancedSearch->SearchValue = HtmlDecode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->EditValue = HtmlEncode($this->kdjudul->AdvancedSearch->SearchValue);
			$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

			// kdkursil
			$this->kdkursil->EditAttrs["class"] = "form-control";
			$this->kdkursil->EditCustomAttributes = "";
			if (!$this->kdkursil->Raw)
				$this->kdkursil->AdvancedSearch->SearchValue = HtmlDecode($this->kdkursil->AdvancedSearch->SearchValue);
			$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->AdvancedSearch->SearchValue);
			$curVal = strval($this->kdkursil->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->kdkursil->EditValue = $this->kdkursil->lookupCacheOption($curVal);
				if ($this->kdkursil->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdkursil`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdkursil->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$arwrk[3] = HtmlEncode(FormatDateTime($rswrk->fields('df3'), 0));
						$this->kdkursil->EditValue = $this->kdkursil->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->kdkursil->EditValue = NULL;
			}
			$this->kdkursil->PlaceHolder = RemoveHtml($this->kdkursil->caption());

			// revisi
			$this->revisi->EditAttrs["class"] = "form-control";
			$this->revisi->EditCustomAttributes = "";
			if (!$this->revisi->Raw)
				$this->revisi->AdvancedSearch->SearchValue = HtmlDecode($this->revisi->AdvancedSearch->SearchValue);
			$this->revisi->EditValue = HtmlEncode($this->revisi->AdvancedSearch->SearchValue);
			$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

			// tgl_terbit
			$this->tgl_terbit->EditAttrs["class"] = "form-control";
			$this->tgl_terbit->EditCustomAttributes = "";
			$this->tgl_terbit->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_terbit->AdvancedSearch->SearchValue, 0), 8));
			$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

			// pilihan_iso
			$this->pilihan_iso->EditAttrs["class"] = "form-control";
			$this->pilihan_iso->EditCustomAttributes = "";
			$this->pilihan_iso->EditValue = $this->pilihan_iso->options(TRUE);

			// tawal
			$this->tawal->EditAttrs["class"] = "form-control";
			$this->tawal->EditCustomAttributes = "";
			$this->tawal->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tawal->AdvancedSearch->SearchValue, 0), 8));
			$this->tawal->PlaceHolder = RemoveHtml($this->tawal->caption());

			// takhir
			$this->takhir->EditAttrs["class"] = "form-control";
			$this->takhir->EditCustomAttributes = "";
			$this->takhir->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->takhir->AdvancedSearch->SearchValue, 0), 8));
			$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

			// tglpel
			$this->tglpel->EditAttrs["class"] = "form-control";
			$this->tglpel->EditCustomAttributes = "";
			$this->tglpel->EditValue = HtmlEncode($this->tglpel->AdvancedSearch->SearchValue);
			$this->tglpel->PlaceHolder = RemoveHtml($this->tglpel->caption());

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdprop->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdprop->AdvancedSearch->ViewValue = $this->kdprop->lookupCacheOption($curVal);
			else
				$this->kdprop->AdvancedSearch->ViewValue = $this->kdprop->Lookup !== NULL && is_array($this->kdprop->Lookup->Options) ? $curVal : NULL;
			if ($this->kdprop->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdprop->EditValue = array_values($this->kdprop->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdprop`" . SearchString("=", $this->kdprop->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->kdkota->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdkota->AdvancedSearch->ViewValue = $this->kdkota->lookupCacheOption($curVal);
			else
				$this->kdkota->AdvancedSearch->ViewValue = $this->kdkota->Lookup !== NULL && is_array($this->kdkota->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkota->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdkota->EditValue = array_values($this->kdkota->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkota`" . SearchString("=", $this->kdkota->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			$this->kdkec->EditValue = HtmlEncode($this->kdkec->AdvancedSearch->SearchValue);
			$this->kdkec->PlaceHolder = RemoveHtml($this->kdkec->caption());

			// ketua
			$this->ketua->EditAttrs["class"] = "form-control";
			$this->ketua->EditCustomAttributes = "";
			if (!$this->ketua->Raw)
				$this->ketua->AdvancedSearch->SearchValue = HtmlDecode($this->ketua->AdvancedSearch->SearchValue);
			$this->ketua->EditValue = HtmlEncode($this->ketua->AdvancedSearch->SearchValue);
			$curVal = strval($this->ketua->AdvancedSearch->SearchValue);
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
						$this->ketua->EditValue = HtmlEncode($this->ketua->AdvancedSearch->SearchValue);
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
				$this->sekretaris->AdvancedSearch->SearchValue = HtmlDecode($this->sekretaris->AdvancedSearch->SearchValue);
			$this->sekretaris->EditValue = HtmlEncode($this->sekretaris->AdvancedSearch->SearchValue);
			$curVal = strval($this->sekretaris->AdvancedSearch->SearchValue);
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
						$this->sekretaris->EditValue = HtmlEncode($this->sekretaris->AdvancedSearch->SearchValue);
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
				$this->bendahara->AdvancedSearch->SearchValue = HtmlDecode($this->bendahara->AdvancedSearch->SearchValue);
			$this->bendahara->EditValue = HtmlEncode($this->bendahara->AdvancedSearch->SearchValue);
			$curVal = strval($this->bendahara->AdvancedSearch->SearchValue);
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
						$this->bendahara->EditValue = HtmlEncode($this->bendahara->AdvancedSearch->SearchValue);
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
				$this->anggota2->AdvancedSearch->SearchValue = HtmlDecode($this->anggota2->AdvancedSearch->SearchValue);
			$this->anggota2->EditValue = HtmlEncode($this->anggota2->AdvancedSearch->SearchValue);
			$curVal = strval($this->anggota2->AdvancedSearch->SearchValue);
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
						$this->anggota2->EditValue = HtmlEncode($this->anggota2->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->anggota2->EditValue = NULL;
			}
			$this->anggota2->PlaceHolder = RemoveHtml($this->anggota2->caption());

			// widyaiswara
			$this->widyaiswara->EditAttrs["class"] = "form-control";
			$this->widyaiswara->EditCustomAttributes = "";
			$this->widyaiswara->EditValue = HtmlEncode($this->widyaiswara->AdvancedSearch->SearchValue);
			$curVal = strval($this->widyaiswara->AdvancedSearch->SearchValue);
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
						$this->widyaiswara->EditValue = HtmlEncode($this->widyaiswara->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->widyaiswara->EditValue = NULL;
			}
			$this->widyaiswara->PlaceHolder = RemoveHtml($this->widyaiswara->caption());

			// jenisevaluasi
			$this->jenisevaluasi->EditAttrs["class"] = "form-control";
			$this->jenisevaluasi->EditCustomAttributes = "";
			if (!$this->jenisevaluasi->Raw)
				$this->jenisevaluasi->AdvancedSearch->SearchValue = HtmlDecode($this->jenisevaluasi->AdvancedSearch->SearchValue);
			$this->jenisevaluasi->EditValue = HtmlEncode($this->jenisevaluasi->AdvancedSearch->SearchValue);
			$this->jenisevaluasi->PlaceHolder = RemoveHtml($this->jenisevaluasi->caption());

			// jenispel
			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			$this->jenispel->EditValue = $this->jenispel->options(TRUE);

			// kdkategori
			$this->kdkategori->EditAttrs["class"] = "form-control";
			$this->kdkategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->kdkategori->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kdkategori->AdvancedSearch->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
			else
				$this->kdkategori->AdvancedSearch->ViewValue = $this->kdkategori->Lookup !== NULL && is_array($this->kdkategori->Lookup->Options) ? $curVal : NULL;
			if ($this->kdkategori->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kdkategori->EditValue = array_values($this->kdkategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdkategori`" . SearchString("=", $this->kdkategori->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->AdvancedSearch->SearchValue);
			$curVal = strval($this->kerjasama->AdvancedSearch->SearchValue);
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
						$this->kerjasama->EditValue = HtmlEncode($this->kerjasama->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->kerjasama->EditValue = NULL;
			}
			$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

			// biaya
			$this->biaya->EditAttrs["class"] = "form-control";
			$this->biaya->EditCustomAttributes = "";
			$this->biaya->EditValue = HtmlEncode($this->biaya->AdvancedSearch->SearchValue);
			$this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());

			// coachingprogr
			$this->coachingprogr->EditAttrs["class"] = "form-control";
			$this->coachingprogr->EditCustomAttributes = "";
			$this->coachingprogr->EditValue = $this->coachingprogr->options(TRUE);

			// area
			$this->area->EditAttrs["class"] = "form-control";
			$this->area->EditCustomAttributes = "";
			if (!$this->area->Raw)
				$this->area->AdvancedSearch->SearchValue = HtmlDecode($this->area->AdvancedSearch->SearchValue);
			$this->area->EditValue = HtmlEncode($this->area->AdvancedSearch->SearchValue);
			$this->area->PlaceHolder = RemoveHtml($this->area->caption());

			// periode_awal
			$this->periode_awal->EditAttrs["class"] = "form-control";
			$this->periode_awal->EditCustomAttributes = "";
			$this->periode_awal->EditValue = HtmlEncode($this->periode_awal->AdvancedSearch->SearchValue);
			$this->periode_awal->PlaceHolder = RemoveHtml($this->periode_awal->caption());

			// periode_akhir
			$this->periode_akhir->EditAttrs["class"] = "form-control";
			$this->periode_akhir->EditCustomAttributes = "";
			$this->periode_akhir->EditValue = HtmlEncode($this->periode_akhir->AdvancedSearch->SearchValue);
			$this->periode_akhir->PlaceHolder = RemoveHtml($this->periode_akhir->caption());

			// tahapan
			$this->tahapan->EditAttrs["class"] = "form-control";
			$this->tahapan->EditCustomAttributes = "";
			$curVal = trim(strval($this->tahapan->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->tahapan->AdvancedSearch->ViewValue = $this->tahapan->lookupCacheOption($curVal);
			else
				$this->tahapan->AdvancedSearch->ViewValue = $this->tahapan->Lookup !== NULL && is_array($this->tahapan->Lookup->Options) ? $curVal : NULL;
			if ($this->tahapan->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->tahapan->EditValue = array_values($this->tahapan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kdtahapan`" . SearchString("=", $this->tahapan->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			if (!$this->namaberkas->Raw)
				$this->namaberkas->AdvancedSearch->SearchValue = HtmlDecode($this->namaberkas->AdvancedSearch->SearchValue);
			$this->namaberkas->EditValue = HtmlEncode($this->namaberkas->AdvancedSearch->SearchValue);
			$this->namaberkas->PlaceHolder = RemoveHtml($this->namaberkas->caption());

			// instruktur
			$this->instruktur->EditAttrs["class"] = "form-control";
			$this->instruktur->EditCustomAttributes = "";
			if (!$this->instruktur->Raw)
				$this->instruktur->AdvancedSearch->SearchValue = HtmlDecode($this->instruktur->AdvancedSearch->SearchValue);
			$this->instruktur->EditValue = HtmlEncode($this->instruktur->AdvancedSearch->SearchValue);
			$this->instruktur->PlaceHolder = RemoveHtml($this->instruktur->caption());

			// statuspel
			$this->statuspel->EditAttrs["class"] = "form-control";
			$this->statuspel->EditCustomAttributes = "";
			$this->statuspel->EditValue = $this->statuspel->options(TRUE);

			// ket
			$this->ket->EditAttrs["class"] = "form-control";
			$this->ket->EditCustomAttributes = "";
			$this->ket->EditValue = HtmlEncode($this->ket->AdvancedSearch->SearchValue);
			$this->ket->PlaceHolder = RemoveHtml($this->ket->caption());

			// jpeserta
			$this->jpeserta->EditAttrs["class"] = "form-control";
			$this->jpeserta->EditCustomAttributes = "";
			$this->jpeserta->EditValue = HtmlEncode($this->jpeserta->AdvancedSearch->SearchValue);
			$this->jpeserta->PlaceHolder = RemoveHtml($this->jpeserta->caption());

			// Tahun
			$this->Tahun->EditAttrs["class"] = "form-control";
			$this->Tahun->EditCustomAttributes = "";
			$this->Tahun->EditValue = HtmlEncode($this->Tahun->AdvancedSearch->SearchValue);
			$this->Tahun->PlaceHolder = RemoveHtml($this->Tahun->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;
		if (!CheckDate($this->tgl_terbit->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tgl_terbit->errorMessage());
		}
		if (!CheckDate($this->tawal->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tawal->errorMessage());
		}
		if (!CheckDate($this->takhir->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->takhir->errorMessage());
		}
		if (!CheckInteger($this->widyaiswara->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->widyaiswara->errorMessage());
		}
		if (!CheckInteger($this->jenisevaluasi->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->jenisevaluasi->errorMessage());
		}
		if (!CheckInteger($this->kerjasama->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->kerjasama->errorMessage());
		}
		if (!CheckInteger($this->biaya->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->biaya->errorMessage());
		}
		if (!CheckInteger($this->periode_akhir->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->periode_akhir->errorMessage());
		}
		if (!CheckInteger($this->jpeserta->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->jpeserta->errorMessage());
		}
		if (!CheckInteger($this->Tahun->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Tahun->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->kdpelat->AdvancedSearch->load();
		$this->kdjudul->AdvancedSearch->load();
		$this->kdkursil->AdvancedSearch->load();
		$this->revisi->AdvancedSearch->load();
		$this->tgl_terbit->AdvancedSearch->load();
		$this->pilihan_iso->AdvancedSearch->load();
		$this->tawal->AdvancedSearch->load();
		$this->takhir->AdvancedSearch->load();
		$this->tglpel->AdvancedSearch->load();
		$this->kdprop->AdvancedSearch->load();
		$this->kdkota->AdvancedSearch->load();
		$this->kdkec->AdvancedSearch->load();
		$this->ketua->AdvancedSearch->load();
		$this->sekretaris->AdvancedSearch->load();
		$this->bendahara->AdvancedSearch->load();
		$this->anggota2->AdvancedSearch->load();
		$this->widyaiswara->AdvancedSearch->load();
		$this->jenisevaluasi->AdvancedSearch->load();
		$this->jenispel->AdvancedSearch->load();
		$this->kdkategori->AdvancedSearch->load();
		$this->kerjasama->AdvancedSearch->load();
		$this->biaya->AdvancedSearch->load();
		$this->coachingprogr->AdvancedSearch->load();
		$this->area->AdvancedSearch->load();
		$this->periode_awal->AdvancedSearch->load();
		$this->periode_akhir->AdvancedSearch->load();
		$this->tahapan->AdvancedSearch->load();
		$this->namaberkas->AdvancedSearch->load();
		$this->instruktur->AdvancedSearch->load();
		$this->statuspel->AdvancedSearch->load();
		$this->ket->AdvancedSearch->load();
		$this->jpeserta->AdvancedSearch->load();
		$this->Tahun->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_pelatihanlist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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