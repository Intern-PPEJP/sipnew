<?php
namespace PHPMaker2020\ppei_20;

/**
 * Page class
 */
class t_pelatihan_add extends t_pelatihan
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{046BD04F-8A8B-497E-98E3-47339F0B2FB6}";

	// Table name
	public $TableName = 't_pelatihan';

	// Page object name
	public $PageObjName = "t_pelatihan_add";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
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
		$this->tglpel->Visible = FALSE;
		$this->kdprop->setVisibility();
		$this->kdkota->setVisibility();
		$this->kdkec->setVisibility();
		$this->ketua->setVisibility();
		$this->sekretaris->setVisibility();
		$this->bendahara->setVisibility();
		$this->anggota2->setVisibility();
		$this->widyaiswara->setVisibility();
		$this->jenisevaluasi->setVisibility();
		$this->created_at->setVisibility();
		$this->user_created_by->setVisibility();
		$this->updated_at->Visible = FALSE;
		$this->user_updated_by->Visible = FALSE;
		$this->jenispel->setVisibility();
		$this->kdkategori->setVisibility();
		$this->kerjasama->setVisibility();
		$this->dana->Visible = FALSE;
		$this->biaya->setVisibility();
		$this->coachingprogr->Visible = FALSE;
		$this->area->Visible = FALSE;
		$this->periode_awal->Visible = FALSE;
		$this->periode_akhir->Visible = FALSE;
		$this->tahapan->Visible = FALSE;
		$this->namaberkas->setVisibility();
		$this->instruktur->Visible = FALSE;
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
		$this->real_peserta->setVisibility();
		$this->independen->setVisibility();
		$this->swasta_k->setVisibility();
		$this->swasta_m->setVisibility();
		$this->swasta_b->setVisibility();
		$this->bumn->setVisibility();
		$this->koperasi->setVisibility();
		$this->pns->setVisibility();
		$this->pt_dosen->setVisibility();
		$this->pt_mhs->setVisibility();
		$this->jk_l->setVisibility();
		$this->jk_p->setVisibility();
		$this->usia_k45->setVisibility();
		$this->usia_b45->setVisibility();
		$this->produk->setVisibility();
		$this->bbio->setVisibility();
		$this->bbio2->setVisibility();
		$this->bbio3->setVisibility();
		$this->bbio4->setVisibility();
		$this->bbio5->setVisibility();
		$this->Tahun->Visible = FALSE;
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

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("t_pelatihanlist.php");
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("t_pelatihanlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = "t_pelatihanlist.php";
					if (GetPageName($returnUrl) == "t_pelatihanlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_pelatihanview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->namaberkas->Upload->Index = $CurrentForm->Index;
		$this->namaberkas->Upload->uploadFile();
		$this->namaberkas->CurrentValue = $this->namaberkas->Upload->FileName;
		$this->bbio->Upload->Index = $CurrentForm->Index;
		$this->bbio->Upload->uploadFile();
		$this->bbio->CurrentValue = $this->bbio->Upload->FileName;
		$this->bbio2->Upload->Index = $CurrentForm->Index;
		$this->bbio2->Upload->uploadFile();
		$this->bbio2->CurrentValue = $this->bbio2->Upload->FileName;
		$this->bbio3->Upload->Index = $CurrentForm->Index;
		$this->bbio3->Upload->uploadFile();
		$this->bbio3->CurrentValue = $this->bbio3->Upload->FileName;
		$this->bbio4->Upload->Index = $CurrentForm->Index;
		$this->bbio4->Upload->uploadFile();
		$this->bbio4->CurrentValue = $this->bbio4->Upload->FileName;
		$this->bbio5->Upload->Index = $CurrentForm->Index;
		$this->bbio5->Upload->uploadFile();
		$this->bbio5->CurrentValue = $this->bbio5->Upload->FileName;
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
		$this->namaberkas->CurrentValue = NULL; // Clear file related field
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
		$this->bbio->CurrentValue = NULL; // Clear file related field
		$this->bbio2->Upload->DbValue = NULL;
		$this->bbio2->OldValue = $this->bbio2->Upload->DbValue;
		$this->bbio2->CurrentValue = NULL; // Clear file related field
		$this->bbio3->Upload->DbValue = NULL;
		$this->bbio3->OldValue = $this->bbio3->Upload->DbValue;
		$this->bbio3->CurrentValue = NULL; // Clear file related field
		$this->bbio4->Upload->DbValue = NULL;
		$this->bbio4->OldValue = $this->bbio4->Upload->DbValue;
		$this->bbio4->CurrentValue = NULL; // Clear file related field
		$this->bbio5->Upload->DbValue = NULL;
		$this->bbio5->OldValue = $this->bbio5->Upload->DbValue;
		$this->bbio5->CurrentValue = NULL; // Clear file related field
		$this->Tahun->CurrentValue = NULL;
		$this->Tahun->OldValue = $this->Tahun->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'kdpelat' first before field var 'x_kdpelat'
		$val = $CurrentForm->hasValue("kdpelat") ? $CurrentForm->getValue("kdpelat") : $CurrentForm->getValue("x_kdpelat");
		if (!$this->kdpelat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdpelat->Visible = FALSE; // Disable update for API request
			else
				$this->kdpelat->setFormValue($val);
		}

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

		// Check field name 'revisi' first before field var 'x_revisi'
		$val = $CurrentForm->hasValue("revisi") ? $CurrentForm->getValue("revisi") : $CurrentForm->getValue("x_revisi");
		if (!$this->revisi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->revisi->Visible = FALSE; // Disable update for API request
			else
				$this->revisi->setFormValue($val);
		}

		// Check field name 'tgl_terbit' first before field var 'x_tgl_terbit'
		$val = $CurrentForm->hasValue("tgl_terbit") ? $CurrentForm->getValue("tgl_terbit") : $CurrentForm->getValue("x_tgl_terbit");
		if (!$this->tgl_terbit->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_terbit->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_terbit->setFormValue($val);
			$this->tgl_terbit->CurrentValue = UnFormatDateTime($this->tgl_terbit->CurrentValue, 0);
		}

		// Check field name 'pilihan_iso' first before field var 'x_pilihan_iso'
		$val = $CurrentForm->hasValue("pilihan_iso") ? $CurrentForm->getValue("pilihan_iso") : $CurrentForm->getValue("x_pilihan_iso");
		if (!$this->pilihan_iso->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pilihan_iso->Visible = FALSE; // Disable update for API request
			else
				$this->pilihan_iso->setFormValue($val);
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

		// Check field name 'jenisevaluasi' first before field var 'x_jenisevaluasi'
		$val = $CurrentForm->hasValue("jenisevaluasi") ? $CurrentForm->getValue("jenisevaluasi") : $CurrentForm->getValue("x_jenisevaluasi");
		if (!$this->jenisevaluasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenisevaluasi->Visible = FALSE; // Disable update for API request
			else
				$this->jenisevaluasi->setFormValue($val);
		}

		// Check field name 'created_at' first before field var 'x_created_at'
		$val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
		if (!$this->created_at->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->created_at->Visible = FALSE; // Disable update for API request
			else
				$this->created_at->setFormValue($val);
			$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
		}

		// Check field name 'user_created_by' first before field var 'x_user_created_by'
		$val = $CurrentForm->hasValue("user_created_by") ? $CurrentForm->getValue("user_created_by") : $CurrentForm->getValue("x_user_created_by");
		if (!$this->user_created_by->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->user_created_by->Visible = FALSE; // Disable update for API request
			else
				$this->user_created_by->setFormValue($val);
		}

		// Check field name 'jenispel' first before field var 'x_jenispel'
		$val = $CurrentForm->hasValue("jenispel") ? $CurrentForm->getValue("jenispel") : $CurrentForm->getValue("x_jenispel");
		if (!$this->jenispel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenispel->Visible = FALSE; // Disable update for API request
			else
				$this->jenispel->setFormValue($val);
		}

		// Check field name 'kdkategori' first before field var 'x_kdkategori'
		$val = $CurrentForm->hasValue("kdkategori") ? $CurrentForm->getValue("kdkategori") : $CurrentForm->getValue("x_kdkategori");
		if (!$this->kdkategori->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kdkategori->Visible = FALSE; // Disable update for API request
			else
				$this->kdkategori->setFormValue($val);
		}

		// Check field name 'kerjasama' first before field var 'x_kerjasama'
		$val = $CurrentForm->hasValue("kerjasama") ? $CurrentForm->getValue("kerjasama") : $CurrentForm->getValue("x_kerjasama");
		if (!$this->kerjasama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kerjasama->Visible = FALSE; // Disable update for API request
			else
				$this->kerjasama->setFormValue($val);
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

		// Check field name 'ket' first before field var 'x_ket'
		$val = $CurrentForm->hasValue("ket") ? $CurrentForm->getValue("ket") : $CurrentForm->getValue("x_ket");
		if (!$this->ket->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ket->Visible = FALSE; // Disable update for API request
			else
				$this->ket->setFormValue($val);
		}

		// Check field name 'jpeserta' first before field var 'x_jpeserta'
		$val = $CurrentForm->hasValue("jpeserta") ? $CurrentForm->getValue("jpeserta") : $CurrentForm->getValue("x_jpeserta");
		if (!$this->jpeserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jpeserta->Visible = FALSE; // Disable update for API request
			else
				$this->jpeserta->setFormValue($val);
		}

		// Check field name 'real_peserta' first before field var 'x_real_peserta'
		$val = $CurrentForm->hasValue("real_peserta") ? $CurrentForm->getValue("real_peserta") : $CurrentForm->getValue("x_real_peserta");
		if (!$this->real_peserta->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->real_peserta->Visible = FALSE; // Disable update for API request
			else
				$this->real_peserta->setFormValue($val);
		}

		// Check field name 'independen' first before field var 'x_independen'
		$val = $CurrentForm->hasValue("independen") ? $CurrentForm->getValue("independen") : $CurrentForm->getValue("x_independen");
		if (!$this->independen->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->independen->Visible = FALSE; // Disable update for API request
			else
				$this->independen->setFormValue($val);
		}

		// Check field name 'swasta_k' first before field var 'x_swasta_k'
		$val = $CurrentForm->hasValue("swasta_k") ? $CurrentForm->getValue("swasta_k") : $CurrentForm->getValue("x_swasta_k");
		if (!$this->swasta_k->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->swasta_k->Visible = FALSE; // Disable update for API request
			else
				$this->swasta_k->setFormValue($val);
		}

		// Check field name 'swasta_m' first before field var 'x_swasta_m'
		$val = $CurrentForm->hasValue("swasta_m") ? $CurrentForm->getValue("swasta_m") : $CurrentForm->getValue("x_swasta_m");
		if (!$this->swasta_m->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->swasta_m->Visible = FALSE; // Disable update for API request
			else
				$this->swasta_m->setFormValue($val);
		}

		// Check field name 'swasta_b' first before field var 'x_swasta_b'
		$val = $CurrentForm->hasValue("swasta_b") ? $CurrentForm->getValue("swasta_b") : $CurrentForm->getValue("x_swasta_b");
		if (!$this->swasta_b->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->swasta_b->Visible = FALSE; // Disable update for API request
			else
				$this->swasta_b->setFormValue($val);
		}

		// Check field name 'bumn' first before field var 'x_bumn'
		$val = $CurrentForm->hasValue("bumn") ? $CurrentForm->getValue("bumn") : $CurrentForm->getValue("x_bumn");
		if (!$this->bumn->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->bumn->Visible = FALSE; // Disable update for API request
			else
				$this->bumn->setFormValue($val);
		}

		// Check field name 'koperasi' first before field var 'x_koperasi'
		$val = $CurrentForm->hasValue("koperasi") ? $CurrentForm->getValue("koperasi") : $CurrentForm->getValue("x_koperasi");
		if (!$this->koperasi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->koperasi->Visible = FALSE; // Disable update for API request
			else
				$this->koperasi->setFormValue($val);
		}

		// Check field name 'pns' first before field var 'x_pns'
		$val = $CurrentForm->hasValue("pns") ? $CurrentForm->getValue("pns") : $CurrentForm->getValue("x_pns");
		if (!$this->pns->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pns->Visible = FALSE; // Disable update for API request
			else
				$this->pns->setFormValue($val);
		}

		// Check field name 'pt_dosen' first before field var 'x_pt_dosen'
		$val = $CurrentForm->hasValue("pt_dosen") ? $CurrentForm->getValue("pt_dosen") : $CurrentForm->getValue("x_pt_dosen");
		if (!$this->pt_dosen->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pt_dosen->Visible = FALSE; // Disable update for API request
			else
				$this->pt_dosen->setFormValue($val);
		}

		// Check field name 'pt_mhs' first before field var 'x_pt_mhs'
		$val = $CurrentForm->hasValue("pt_mhs") ? $CurrentForm->getValue("pt_mhs") : $CurrentForm->getValue("x_pt_mhs");
		if (!$this->pt_mhs->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pt_mhs->Visible = FALSE; // Disable update for API request
			else
				$this->pt_mhs->setFormValue($val);
		}

		// Check field name 'jk_l' first before field var 'x_jk_l'
		$val = $CurrentForm->hasValue("jk_l") ? $CurrentForm->getValue("jk_l") : $CurrentForm->getValue("x_jk_l");
		if (!$this->jk_l->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jk_l->Visible = FALSE; // Disable update for API request
			else
				$this->jk_l->setFormValue($val);
		}

		// Check field name 'jk_p' first before field var 'x_jk_p'
		$val = $CurrentForm->hasValue("jk_p") ? $CurrentForm->getValue("jk_p") : $CurrentForm->getValue("x_jk_p");
		if (!$this->jk_p->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jk_p->Visible = FALSE; // Disable update for API request
			else
				$this->jk_p->setFormValue($val);
		}

		// Check field name 'usia_k45' first before field var 'x_usia_k45'
		$val = $CurrentForm->hasValue("usia_k45") ? $CurrentForm->getValue("usia_k45") : $CurrentForm->getValue("x_usia_k45");
		if (!$this->usia_k45->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->usia_k45->Visible = FALSE; // Disable update for API request
			else
				$this->usia_k45->setFormValue($val);
		}

		// Check field name 'usia_b45' first before field var 'x_usia_b45'
		$val = $CurrentForm->hasValue("usia_b45") ? $CurrentForm->getValue("usia_b45") : $CurrentForm->getValue("x_usia_b45");
		if (!$this->usia_b45->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->usia_b45->Visible = FALSE; // Disable update for API request
			else
				$this->usia_b45->setFormValue($val);
		}

		// Check field name 'produk' first before field var 'x_produk'
		$val = $CurrentForm->hasValue("produk") ? $CurrentForm->getValue("produk") : $CurrentForm->getValue("x_produk");
		if (!$this->produk->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->produk->Visible = FALSE; // Disable update for API request
			else
				$this->produk->setFormValue($val);
		}

		// Check field name 'idpelat' first before field var 'x_idpelat'
		$val = $CurrentForm->hasValue("idpelat") ? $CurrentForm->getValue("idpelat") : $CurrentForm->getValue("x_idpelat");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kdpelat->CurrentValue = $this->kdpelat->FormValue;
		$this->kdjudul->CurrentValue = $this->kdjudul->FormValue;
		$this->kdkursil->CurrentValue = $this->kdkursil->FormValue;
		$this->revisi->CurrentValue = $this->revisi->FormValue;
		$this->tgl_terbit->CurrentValue = $this->tgl_terbit->FormValue;
		$this->tgl_terbit->CurrentValue = UnFormatDateTime($this->tgl_terbit->CurrentValue, 0);
		$this->pilihan_iso->CurrentValue = $this->pilihan_iso->FormValue;
		$this->tawal->CurrentValue = $this->tawal->FormValue;
		$this->tawal->CurrentValue = UnFormatDateTime($this->tawal->CurrentValue, 0);
		$this->takhir->CurrentValue = $this->takhir->FormValue;
		$this->takhir->CurrentValue = UnFormatDateTime($this->takhir->CurrentValue, 0);
		$this->kdprop->CurrentValue = $this->kdprop->FormValue;
		$this->kdkota->CurrentValue = $this->kdkota->FormValue;
		$this->kdkec->CurrentValue = $this->kdkec->FormValue;
		$this->ketua->CurrentValue = $this->ketua->FormValue;
		$this->sekretaris->CurrentValue = $this->sekretaris->FormValue;
		$this->bendahara->CurrentValue = $this->bendahara->FormValue;
		$this->anggota2->CurrentValue = $this->anggota2->FormValue;
		$this->widyaiswara->CurrentValue = $this->widyaiswara->FormValue;
		$this->jenisevaluasi->CurrentValue = $this->jenisevaluasi->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
		$this->user_created_by->CurrentValue = $this->user_created_by->FormValue;
		$this->jenispel->CurrentValue = $this->jenispel->FormValue;
		$this->kdkategori->CurrentValue = $this->kdkategori->FormValue;
		$this->kerjasama->CurrentValue = $this->kerjasama->FormValue;
		$this->biaya->CurrentValue = $this->biaya->FormValue;
		$this->statuspel->CurrentValue = $this->statuspel->FormValue;
		$this->ket->CurrentValue = $this->ket->FormValue;
		$this->jpeserta->CurrentValue = $this->jpeserta->FormValue;
		$this->real_peserta->CurrentValue = $this->real_peserta->FormValue;
		$this->independen->CurrentValue = $this->independen->FormValue;
		$this->swasta_k->CurrentValue = $this->swasta_k->FormValue;
		$this->swasta_m->CurrentValue = $this->swasta_m->FormValue;
		$this->swasta_b->CurrentValue = $this->swasta_b->FormValue;
		$this->bumn->CurrentValue = $this->bumn->FormValue;
		$this->koperasi->CurrentValue = $this->koperasi->FormValue;
		$this->pns->CurrentValue = $this->pns->FormValue;
		$this->pt_dosen->CurrentValue = $this->pt_dosen->FormValue;
		$this->pt_mhs->CurrentValue = $this->pt_mhs->FormValue;
		$this->jk_l->CurrentValue = $this->jk_l->FormValue;
		$this->jk_p->CurrentValue = $this->jk_p->FormValue;
		$this->usia_k45->CurrentValue = $this->usia_k45->FormValue;
		$this->usia_b45->CurrentValue = $this->usia_b45->FormValue;
		$this->produk->CurrentValue = $this->produk->FormValue;
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
		$this->bbio2->Upload->DbValue = $row['bbio2'];
		$this->bbio2->setDbValue($this->bbio2->Upload->DbValue);
		$this->bbio3->Upload->DbValue = $row['bbio3'];
		$this->bbio3->setDbValue($this->bbio3->Upload->DbValue);
		$this->bbio4->Upload->DbValue = $row['bbio4'];
		$this->bbio4->setDbValue($this->bbio4->Upload->DbValue);
		$this->bbio5->Upload->DbValue = $row['bbio5'];
		$this->bbio5->setDbValue($this->bbio5->Upload->DbValue);
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

			// created_at
			$this->created_at->ViewValue = $this->created_at->CurrentValue;
			$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
			$this->created_at->ViewCustomAttributes = "";

			// user_created_by
			$this->user_created_by->ViewValue = $this->user_created_by->CurrentValue;
			$this->user_created_by->ViewCustomAttributes = "";

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

			// real_peserta
			$this->real_peserta->ViewValue = $this->real_peserta->CurrentValue;
			$this->real_peserta->ViewCustomAttributes = "";

			// independen
			$this->independen->ViewValue = $this->independen->CurrentValue;
			$this->independen->ViewCustomAttributes = "";

			// swasta_k
			$this->swasta_k->ViewValue = $this->swasta_k->CurrentValue;
			$this->swasta_k->ViewCustomAttributes = "";

			// swasta_m
			$this->swasta_m->ViewValue = $this->swasta_m->CurrentValue;
			$this->swasta_m->ViewCustomAttributes = "";

			// swasta_b
			$this->swasta_b->ViewValue = $this->swasta_b->CurrentValue;
			$this->swasta_b->ViewCustomAttributes = "";

			// bumn
			$this->bumn->ViewValue = $this->bumn->CurrentValue;
			$this->bumn->ViewCustomAttributes = "";

			// koperasi
			$this->koperasi->ViewValue = $this->koperasi->CurrentValue;
			$this->koperasi->ViewCustomAttributes = "";

			// pns
			$this->pns->ViewValue = $this->pns->CurrentValue;
			$this->pns->ViewCustomAttributes = "";

			// pt_dosen
			$this->pt_dosen->ViewValue = $this->pt_dosen->CurrentValue;
			$this->pt_dosen->ViewCustomAttributes = "";

			// pt_mhs
			$this->pt_mhs->ViewValue = $this->pt_mhs->CurrentValue;
			$this->pt_mhs->ViewCustomAttributes = "";

			// jk_l
			$this->jk_l->ViewValue = $this->jk_l->CurrentValue;
			$this->jk_l->ViewCustomAttributes = "";

			// jk_p
			$this->jk_p->ViewValue = $this->jk_p->CurrentValue;
			$this->jk_p->ViewCustomAttributes = "";

			// usia_k45
			$this->usia_k45->ViewValue = $this->usia_k45->CurrentValue;
			$this->usia_k45->ViewCustomAttributes = "";

			// usia_b45
			$this->usia_b45->ViewValue = $this->usia_b45->CurrentValue;
			$this->usia_b45->ViewCustomAttributes = "";

			// produk
			$this->produk->ViewValue = $this->produk->CurrentValue;
			$this->produk->ViewCustomAttributes = "";

			// bbio
			if (!EmptyValue($this->bbio->Upload->DbValue)) {
				$this->bbio->ViewValue = $this->bbio->Upload->DbValue;
			} else {
				$this->bbio->ViewValue = "";
			}
			$this->bbio->ViewCustomAttributes = "";

			// bbio2
			if (!EmptyValue($this->bbio2->Upload->DbValue)) {
				$this->bbio2->ViewValue = $this->bbio2->Upload->DbValue;
			} else {
				$this->bbio2->ViewValue = "";
			}
			$this->bbio2->ViewCustomAttributes = "";

			// bbio3
			if (!EmptyValue($this->bbio3->Upload->DbValue)) {
				$this->bbio3->ViewValue = $this->bbio3->Upload->DbValue;
			} else {
				$this->bbio3->ViewValue = "";
			}
			$this->bbio3->ViewCustomAttributes = "";

			// bbio4
			if (!EmptyValue($this->bbio4->Upload->DbValue)) {
				$this->bbio4->ViewValue = $this->bbio4->Upload->DbValue;
			} else {
				$this->bbio4->ViewValue = "";
			}
			$this->bbio4->ViewCustomAttributes = "";

			// bbio5
			if (!EmptyValue($this->bbio5->Upload->DbValue)) {
				$this->bbio5->ViewValue = $this->bbio5->Upload->DbValue;
			} else {
				$this->bbio5->ViewValue = "";
			}
			$this->bbio5->ViewCustomAttributes = "";

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

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// user_created_by
			$this->user_created_by->LinkCustomAttributes = "";
			$this->user_created_by->HrefValue = "";
			$this->user_created_by->TooltipValue = "";

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

			// real_peserta
			$this->real_peserta->LinkCustomAttributes = "";
			$this->real_peserta->HrefValue = "";
			$this->real_peserta->TooltipValue = "";

			// independen
			$this->independen->LinkCustomAttributes = "";
			$this->independen->HrefValue = "";
			$this->independen->TooltipValue = "";

			// swasta_k
			$this->swasta_k->LinkCustomAttributes = "";
			$this->swasta_k->HrefValue = "";
			$this->swasta_k->TooltipValue = "";

			// swasta_m
			$this->swasta_m->LinkCustomAttributes = "";
			$this->swasta_m->HrefValue = "";
			$this->swasta_m->TooltipValue = "";

			// swasta_b
			$this->swasta_b->LinkCustomAttributes = "";
			$this->swasta_b->HrefValue = "";
			$this->swasta_b->TooltipValue = "";

			// bumn
			$this->bumn->LinkCustomAttributes = "";
			$this->bumn->HrefValue = "";
			$this->bumn->TooltipValue = "";

			// koperasi
			$this->koperasi->LinkCustomAttributes = "";
			$this->koperasi->HrefValue = "";
			$this->koperasi->TooltipValue = "";

			// pns
			$this->pns->LinkCustomAttributes = "";
			$this->pns->HrefValue = "";
			$this->pns->TooltipValue = "";

			// pt_dosen
			$this->pt_dosen->LinkCustomAttributes = "";
			$this->pt_dosen->HrefValue = "";
			$this->pt_dosen->TooltipValue = "";

			// pt_mhs
			$this->pt_mhs->LinkCustomAttributes = "";
			$this->pt_mhs->HrefValue = "";
			$this->pt_mhs->TooltipValue = "";

			// jk_l
			$this->jk_l->LinkCustomAttributes = "";
			$this->jk_l->HrefValue = "";
			$this->jk_l->TooltipValue = "";

			// jk_p
			$this->jk_p->LinkCustomAttributes = "";
			$this->jk_p->HrefValue = "";
			$this->jk_p->TooltipValue = "";

			// usia_k45
			$this->usia_k45->LinkCustomAttributes = "";
			$this->usia_k45->HrefValue = "";
			$this->usia_k45->TooltipValue = "";

			// usia_b45
			$this->usia_b45->LinkCustomAttributes = "";
			$this->usia_b45->HrefValue = "";
			$this->usia_b45->TooltipValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";
			$this->produk->TooltipValue = "";

			// bbio
			$this->bbio->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio->Upload->DbValue)) {
				$this->bbio->HrefValue = GetFileUploadUrl($this->bbio, $this->bbio->htmlDecode($this->bbio->Upload->DbValue)); // Add prefix/suffix
				$this->bbio->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio->HrefValue = FullUrl($this->bbio->HrefValue, "href");
			} else {
				$this->bbio->HrefValue = "";
			}
			$this->bbio->ExportHrefValue = $this->bbio->UploadPath . $this->bbio->Upload->DbValue;
			$this->bbio->TooltipValue = "";

			// bbio2
			$this->bbio2->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio2->Upload->DbValue)) {
				$this->bbio2->HrefValue = GetFileUploadUrl($this->bbio2, $this->bbio2->htmlDecode($this->bbio2->Upload->DbValue)); // Add prefix/suffix
				$this->bbio2->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio2->HrefValue = FullUrl($this->bbio2->HrefValue, "href");
			} else {
				$this->bbio2->HrefValue = "";
			}
			$this->bbio2->ExportHrefValue = $this->bbio2->UploadPath . $this->bbio2->Upload->DbValue;
			$this->bbio2->TooltipValue = "";

			// bbio3
			$this->bbio3->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio3->Upload->DbValue)) {
				$this->bbio3->HrefValue = GetFileUploadUrl($this->bbio3, $this->bbio3->htmlDecode($this->bbio3->Upload->DbValue)); // Add prefix/suffix
				$this->bbio3->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio3->HrefValue = FullUrl($this->bbio3->HrefValue, "href");
			} else {
				$this->bbio3->HrefValue = "";
			}
			$this->bbio3->ExportHrefValue = $this->bbio3->UploadPath . $this->bbio3->Upload->DbValue;
			$this->bbio3->TooltipValue = "";

			// bbio4
			$this->bbio4->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio4->Upload->DbValue)) {
				$this->bbio4->HrefValue = GetFileUploadUrl($this->bbio4, $this->bbio4->htmlDecode($this->bbio4->Upload->DbValue)); // Add prefix/suffix
				$this->bbio4->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio4->HrefValue = FullUrl($this->bbio4->HrefValue, "href");
			} else {
				$this->bbio4->HrefValue = "";
			}
			$this->bbio4->ExportHrefValue = $this->bbio4->UploadPath . $this->bbio4->Upload->DbValue;
			$this->bbio4->TooltipValue = "";

			// bbio5
			$this->bbio5->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio5->Upload->DbValue)) {
				$this->bbio5->HrefValue = GetFileUploadUrl($this->bbio5, $this->bbio5->htmlDecode($this->bbio5->Upload->DbValue)); // Add prefix/suffix
				$this->bbio5->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio5->HrefValue = FullUrl($this->bbio5->HrefValue, "href");
			} else {
				$this->bbio5->HrefValue = "";
			}
			$this->bbio5->ExportHrefValue = $this->bbio5->UploadPath . $this->bbio5->Upload->DbValue;
			$this->bbio5->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// kdpelat
			$this->kdpelat->EditAttrs["class"] = "form-control";
			$this->kdpelat->EditCustomAttributes = "";
			if (!$this->kdpelat->Raw)
				$this->kdpelat->CurrentValue = HtmlDecode($this->kdpelat->CurrentValue);
			$this->kdpelat->EditValue = HtmlEncode($this->kdpelat->CurrentValue);
			$this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

			// kdjudul
			$this->kdjudul->EditAttrs["class"] = "form-control";
			$this->kdjudul->EditCustomAttributes = "";
			if ($this->kdjudul->getSessionValue() != "") {
				$this->kdjudul->CurrentValue = $this->kdjudul->getSessionValue();
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

			// kdkursil
			$this->kdkursil->EditAttrs["class"] = "form-control";
			$this->kdkursil->EditCustomAttributes = "";
			if (!$this->kdkursil->Raw)
				$this->kdkursil->CurrentValue = HtmlDecode($this->kdkursil->CurrentValue);
			$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->CurrentValue);
			$curVal = strval($this->kdkursil->CurrentValue);
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
						$this->kdkursil->EditValue = HtmlEncode($this->kdkursil->CurrentValue);
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
				$this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
			$this->revisi->EditValue = HtmlEncode($this->revisi->CurrentValue);
			$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

			// tgl_terbit
			$this->tgl_terbit->EditAttrs["class"] = "form-control";
			$this->tgl_terbit->EditCustomAttributes = "";
			$this->tgl_terbit->EditValue = HtmlEncode(FormatDateTime($this->tgl_terbit->CurrentValue, 8));
			$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

			// pilihan_iso
			$this->pilihan_iso->EditAttrs["class"] = "form-control";
			$this->pilihan_iso->EditCustomAttributes = "";
			$this->pilihan_iso->EditValue = $this->pilihan_iso->options(TRUE);

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

			// kdprop
			$this->kdprop->EditAttrs["class"] = "form-control";
			$this->kdprop->EditCustomAttributes = "";
			if ($this->kdprop->getSessionValue() != "") {
				$this->kdprop->CurrentValue = $this->kdprop->getSessionValue();
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
			} else {
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
			}

			// kdkota
			$this->kdkota->EditAttrs["class"] = "form-control";
			$this->kdkota->EditCustomAttributes = "";
			if ($this->kdkota->getSessionValue() != "") {
				$this->kdkota->CurrentValue = $this->kdkota->getSessionValue();
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
			} else {
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

			// jenisevaluasi
			$this->jenisevaluasi->EditAttrs["class"] = "form-control";
			$this->jenisevaluasi->EditCustomAttributes = "";
			if (!$this->jenisevaluasi->Raw)
				$this->jenisevaluasi->CurrentValue = HtmlDecode($this->jenisevaluasi->CurrentValue);
			$this->jenisevaluasi->EditValue = HtmlEncode($this->jenisevaluasi->CurrentValue);
			$this->jenisevaluasi->PlaceHolder = RemoveHtml($this->jenisevaluasi->caption());

			// created_at
			// user_created_by
			// jenispel

			$this->jenispel->EditAttrs["class"] = "form-control";
			$this->jenispel->EditCustomAttributes = "";
			$this->jenispel->EditValue = $this->jenispel->options(TRUE);

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
			if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue))
				$this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -1, -2, 0);
			

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
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->namaberkas);

			// statuspel
			$this->statuspel->EditAttrs["class"] = "form-control";
			$this->statuspel->EditCustomAttributes = "";
			$this->statuspel->EditValue = $this->statuspel->options(TRUE);

			// ket
			$this->ket->EditAttrs["class"] = "form-control";
			$this->ket->EditCustomAttributes = "";
			$this->ket->EditValue = HtmlEncode($this->ket->CurrentValue);
			$this->ket->PlaceHolder = RemoveHtml($this->ket->caption());

			// jpeserta
			$this->jpeserta->EditAttrs["class"] = "form-control";
			$this->jpeserta->EditCustomAttributes = "";
			$this->jpeserta->EditValue = HtmlEncode($this->jpeserta->CurrentValue);
			$this->jpeserta->PlaceHolder = RemoveHtml($this->jpeserta->caption());

			// real_peserta
			$this->real_peserta->EditAttrs["class"] = "form-control";
			$this->real_peserta->EditCustomAttributes = "";
			$this->real_peserta->EditValue = HtmlEncode($this->real_peserta->CurrentValue);
			$this->real_peserta->PlaceHolder = RemoveHtml($this->real_peserta->caption());

			// independen
			$this->independen->EditAttrs["class"] = "form-control";
			$this->independen->EditCustomAttributes = "";
			$this->independen->EditValue = HtmlEncode($this->independen->CurrentValue);
			$this->independen->PlaceHolder = RemoveHtml($this->independen->caption());

			// swasta_k
			$this->swasta_k->EditAttrs["class"] = "form-control";
			$this->swasta_k->EditCustomAttributes = "";
			$this->swasta_k->EditValue = HtmlEncode($this->swasta_k->CurrentValue);
			$this->swasta_k->PlaceHolder = RemoveHtml($this->swasta_k->caption());

			// swasta_m
			$this->swasta_m->EditAttrs["class"] = "form-control";
			$this->swasta_m->EditCustomAttributes = "";
			$this->swasta_m->EditValue = HtmlEncode($this->swasta_m->CurrentValue);
			$this->swasta_m->PlaceHolder = RemoveHtml($this->swasta_m->caption());

			// swasta_b
			$this->swasta_b->EditAttrs["class"] = "form-control";
			$this->swasta_b->EditCustomAttributes = "";
			$this->swasta_b->EditValue = HtmlEncode($this->swasta_b->CurrentValue);
			$this->swasta_b->PlaceHolder = RemoveHtml($this->swasta_b->caption());

			// bumn
			$this->bumn->EditAttrs["class"] = "form-control";
			$this->bumn->EditCustomAttributes = "";
			$this->bumn->EditValue = HtmlEncode($this->bumn->CurrentValue);
			$this->bumn->PlaceHolder = RemoveHtml($this->bumn->caption());

			// koperasi
			$this->koperasi->EditAttrs["class"] = "form-control";
			$this->koperasi->EditCustomAttributes = "";
			$this->koperasi->EditValue = HtmlEncode($this->koperasi->CurrentValue);
			$this->koperasi->PlaceHolder = RemoveHtml($this->koperasi->caption());

			// pns
			$this->pns->EditAttrs["class"] = "form-control";
			$this->pns->EditCustomAttributes = "";
			$this->pns->EditValue = HtmlEncode($this->pns->CurrentValue);
			$this->pns->PlaceHolder = RemoveHtml($this->pns->caption());

			// pt_dosen
			$this->pt_dosen->EditAttrs["class"] = "form-control";
			$this->pt_dosen->EditCustomAttributes = "";
			$this->pt_dosen->EditValue = HtmlEncode($this->pt_dosen->CurrentValue);
			$this->pt_dosen->PlaceHolder = RemoveHtml($this->pt_dosen->caption());

			// pt_mhs
			$this->pt_mhs->EditAttrs["class"] = "form-control";
			$this->pt_mhs->EditCustomAttributes = "";
			$this->pt_mhs->EditValue = HtmlEncode($this->pt_mhs->CurrentValue);
			$this->pt_mhs->PlaceHolder = RemoveHtml($this->pt_mhs->caption());

			// jk_l
			$this->jk_l->EditAttrs["class"] = "form-control";
			$this->jk_l->EditCustomAttributes = "";
			$this->jk_l->EditValue = HtmlEncode($this->jk_l->CurrentValue);
			$this->jk_l->PlaceHolder = RemoveHtml($this->jk_l->caption());

			// jk_p
			$this->jk_p->EditAttrs["class"] = "form-control";
			$this->jk_p->EditCustomAttributes = "";
			$this->jk_p->EditValue = HtmlEncode($this->jk_p->CurrentValue);
			$this->jk_p->PlaceHolder = RemoveHtml($this->jk_p->caption());

			// usia_k45
			$this->usia_k45->EditAttrs["class"] = "form-control";
			$this->usia_k45->EditCustomAttributes = "";
			$this->usia_k45->EditValue = HtmlEncode($this->usia_k45->CurrentValue);
			$this->usia_k45->PlaceHolder = RemoveHtml($this->usia_k45->caption());

			// usia_b45
			$this->usia_b45->EditAttrs["class"] = "form-control";
			$this->usia_b45->EditCustomAttributes = "";
			$this->usia_b45->EditValue = HtmlEncode($this->usia_b45->CurrentValue);
			$this->usia_b45->PlaceHolder = RemoveHtml($this->usia_b45->caption());

			// produk
			$this->produk->EditAttrs["class"] = "form-control";
			$this->produk->EditCustomAttributes = "maxlength='300'";
			$this->produk->EditValue = HtmlEncode($this->produk->CurrentValue);
			$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

			// bbio
			$this->bbio->EditAttrs["class"] = "form-control";
			$this->bbio->EditCustomAttributes = "";
			if (!EmptyValue($this->bbio->Upload->DbValue)) {
				$this->bbio->EditValue = $this->bbio->Upload->DbValue;
			} else {
				$this->bbio->EditValue = "";
			}
			if (!EmptyValue($this->bbio->CurrentValue))
					$this->bbio->Upload->FileName = $this->bbio->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->bbio);

			// bbio2
			$this->bbio2->EditAttrs["class"] = "form-control";
			$this->bbio2->EditCustomAttributes = "";
			if (!EmptyValue($this->bbio2->Upload->DbValue)) {
				$this->bbio2->EditValue = $this->bbio2->Upload->DbValue;
			} else {
				$this->bbio2->EditValue = "";
			}
			if (!EmptyValue($this->bbio2->CurrentValue))
					$this->bbio2->Upload->FileName = $this->bbio2->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->bbio2);

			// bbio3
			$this->bbio3->EditAttrs["class"] = "form-control";
			$this->bbio3->EditCustomAttributes = "";
			if (!EmptyValue($this->bbio3->Upload->DbValue)) {
				$this->bbio3->EditValue = $this->bbio3->Upload->DbValue;
			} else {
				$this->bbio3->EditValue = "";
			}
			if (!EmptyValue($this->bbio3->CurrentValue))
					$this->bbio3->Upload->FileName = $this->bbio3->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->bbio3);

			// bbio4
			$this->bbio4->EditAttrs["class"] = "form-control";
			$this->bbio4->EditCustomAttributes = "";
			if (!EmptyValue($this->bbio4->Upload->DbValue)) {
				$this->bbio4->EditValue = $this->bbio4->Upload->DbValue;
			} else {
				$this->bbio4->EditValue = "";
			}
			if (!EmptyValue($this->bbio4->CurrentValue))
					$this->bbio4->Upload->FileName = $this->bbio4->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->bbio4);

			// bbio5
			$this->bbio5->EditAttrs["class"] = "form-control";
			$this->bbio5->EditCustomAttributes = "";
			if (!EmptyValue($this->bbio5->Upload->DbValue)) {
				$this->bbio5->EditValue = $this->bbio5->Upload->DbValue;
			} else {
				$this->bbio5->EditValue = "";
			}
			if (!EmptyValue($this->bbio5->CurrentValue))
					$this->bbio5->Upload->FileName = $this->bbio5->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->bbio5);

			// Add refer script
			// kdpelat

			$this->kdpelat->LinkCustomAttributes = "";
			$this->kdpelat->HrefValue = "";

			// kdjudul
			$this->kdjudul->LinkCustomAttributes = "";
			$this->kdjudul->HrefValue = "";

			// kdkursil
			$this->kdkursil->LinkCustomAttributes = "";
			$this->kdkursil->HrefValue = "";

			// revisi
			$this->revisi->LinkCustomAttributes = "";
			$this->revisi->HrefValue = "";

			// tgl_terbit
			$this->tgl_terbit->LinkCustomAttributes = "";
			$this->tgl_terbit->HrefValue = "";

			// pilihan_iso
			$this->pilihan_iso->LinkCustomAttributes = "";
			$this->pilihan_iso->HrefValue = "";

			// tawal
			$this->tawal->LinkCustomAttributes = "";
			$this->tawal->HrefValue = "";

			// takhir
			$this->takhir->LinkCustomAttributes = "";
			$this->takhir->HrefValue = "";

			// kdprop
			$this->kdprop->LinkCustomAttributes = "";
			$this->kdprop->HrefValue = "";

			// kdkota
			$this->kdkota->LinkCustomAttributes = "";
			$this->kdkota->HrefValue = "";

			// kdkec
			$this->kdkec->LinkCustomAttributes = "";
			$this->kdkec->HrefValue = "";

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

			// jenisevaluasi
			$this->jenisevaluasi->LinkCustomAttributes = "";
			$this->jenisevaluasi->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";

			// user_created_by
			$this->user_created_by->LinkCustomAttributes = "";
			$this->user_created_by->HrefValue = "";

			// jenispel
			$this->jenispel->LinkCustomAttributes = "";
			$this->jenispel->HrefValue = "";

			// kdkategori
			$this->kdkategori->LinkCustomAttributes = "";
			$this->kdkategori->HrefValue = "";

			// kerjasama
			$this->kerjasama->LinkCustomAttributes = "";
			$this->kerjasama->HrefValue = "";

			// biaya
			$this->biaya->LinkCustomAttributes = "";
			$this->biaya->HrefValue = "";

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

			// statuspel
			$this->statuspel->LinkCustomAttributes = "";
			$this->statuspel->HrefValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";

			// jpeserta
			$this->jpeserta->LinkCustomAttributes = "";
			$this->jpeserta->HrefValue = "";

			// real_peserta
			$this->real_peserta->LinkCustomAttributes = "";
			$this->real_peserta->HrefValue = "";

			// independen
			$this->independen->LinkCustomAttributes = "";
			$this->independen->HrefValue = "";

			// swasta_k
			$this->swasta_k->LinkCustomAttributes = "";
			$this->swasta_k->HrefValue = "";

			// swasta_m
			$this->swasta_m->LinkCustomAttributes = "";
			$this->swasta_m->HrefValue = "";

			// swasta_b
			$this->swasta_b->LinkCustomAttributes = "";
			$this->swasta_b->HrefValue = "";

			// bumn
			$this->bumn->LinkCustomAttributes = "";
			$this->bumn->HrefValue = "";

			// koperasi
			$this->koperasi->LinkCustomAttributes = "";
			$this->koperasi->HrefValue = "";

			// pns
			$this->pns->LinkCustomAttributes = "";
			$this->pns->HrefValue = "";

			// pt_dosen
			$this->pt_dosen->LinkCustomAttributes = "";
			$this->pt_dosen->HrefValue = "";

			// pt_mhs
			$this->pt_mhs->LinkCustomAttributes = "";
			$this->pt_mhs->HrefValue = "";

			// jk_l
			$this->jk_l->LinkCustomAttributes = "";
			$this->jk_l->HrefValue = "";

			// jk_p
			$this->jk_p->LinkCustomAttributes = "";
			$this->jk_p->HrefValue = "";

			// usia_k45
			$this->usia_k45->LinkCustomAttributes = "";
			$this->usia_k45->HrefValue = "";

			// usia_b45
			$this->usia_b45->LinkCustomAttributes = "";
			$this->usia_b45->HrefValue = "";

			// produk
			$this->produk->LinkCustomAttributes = "";
			$this->produk->HrefValue = "";

			// bbio
			$this->bbio->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio->Upload->DbValue)) {
				$this->bbio->HrefValue = GetFileUploadUrl($this->bbio, $this->bbio->htmlDecode($this->bbio->Upload->DbValue)); // Add prefix/suffix
				$this->bbio->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio->HrefValue = FullUrl($this->bbio->HrefValue, "href");
			} else {
				$this->bbio->HrefValue = "";
			}
			$this->bbio->ExportHrefValue = $this->bbio->UploadPath . $this->bbio->Upload->DbValue;

			// bbio2
			$this->bbio2->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio2->Upload->DbValue)) {
				$this->bbio2->HrefValue = GetFileUploadUrl($this->bbio2, $this->bbio2->htmlDecode($this->bbio2->Upload->DbValue)); // Add prefix/suffix
				$this->bbio2->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio2->HrefValue = FullUrl($this->bbio2->HrefValue, "href");
			} else {
				$this->bbio2->HrefValue = "";
			}
			$this->bbio2->ExportHrefValue = $this->bbio2->UploadPath . $this->bbio2->Upload->DbValue;

			// bbio3
			$this->bbio3->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio3->Upload->DbValue)) {
				$this->bbio3->HrefValue = GetFileUploadUrl($this->bbio3, $this->bbio3->htmlDecode($this->bbio3->Upload->DbValue)); // Add prefix/suffix
				$this->bbio3->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio3->HrefValue = FullUrl($this->bbio3->HrefValue, "href");
			} else {
				$this->bbio3->HrefValue = "";
			}
			$this->bbio3->ExportHrefValue = $this->bbio3->UploadPath . $this->bbio3->Upload->DbValue;

			// bbio4
			$this->bbio4->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio4->Upload->DbValue)) {
				$this->bbio4->HrefValue = GetFileUploadUrl($this->bbio4, $this->bbio4->htmlDecode($this->bbio4->Upload->DbValue)); // Add prefix/suffix
				$this->bbio4->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio4->HrefValue = FullUrl($this->bbio4->HrefValue, "href");
			} else {
				$this->bbio4->HrefValue = "";
			}
			$this->bbio4->ExportHrefValue = $this->bbio4->UploadPath . $this->bbio4->Upload->DbValue;

			// bbio5
			$this->bbio5->LinkCustomAttributes = "";
			if (!EmptyValue($this->bbio5->Upload->DbValue)) {
				$this->bbio5->HrefValue = GetFileUploadUrl($this->bbio5, $this->bbio5->htmlDecode($this->bbio5->Upload->DbValue)); // Add prefix/suffix
				$this->bbio5->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->bbio5->HrefValue = FullUrl($this->bbio5->HrefValue, "href");
			} else {
				$this->bbio5->HrefValue = "";
			}
			$this->bbio5->ExportHrefValue = $this->bbio5->UploadPath . $this->bbio5->Upload->DbValue;
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
		if ($this->kdpelat->Required) {
			if (!$this->kdpelat->IsDetailKey && $this->kdpelat->FormValue != NULL && $this->kdpelat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdpelat->caption(), $this->kdpelat->RequiredErrorMessage));
			}
		}
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
		if ($this->revisi->Required) {
			if (!$this->revisi->IsDetailKey && $this->revisi->FormValue != NULL && $this->revisi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revisi->caption(), $this->revisi->RequiredErrorMessage));
			}
		}
		if ($this->tgl_terbit->Required) {
			if (!$this->tgl_terbit->IsDetailKey && $this->tgl_terbit->FormValue != NULL && $this->tgl_terbit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_terbit->caption(), $this->tgl_terbit->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_terbit->FormValue)) {
			AddMessage($FormError, $this->tgl_terbit->errorMessage());
		}
		if ($this->pilihan_iso->Required) {
			if (!$this->pilihan_iso->IsDetailKey && $this->pilihan_iso->FormValue != NULL && $this->pilihan_iso->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pilihan_iso->caption(), $this->pilihan_iso->RequiredErrorMessage));
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
		if ($this->jenisevaluasi->Required) {
			if (!$this->jenisevaluasi->IsDetailKey && $this->jenisevaluasi->FormValue != NULL && $this->jenisevaluasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenisevaluasi->caption(), $this->jenisevaluasi->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jenisevaluasi->FormValue)) {
			AddMessage($FormError, $this->jenisevaluasi->errorMessage());
		}
		if ($this->created_at->Required) {
			if (!$this->created_at->IsDetailKey && $this->created_at->FormValue != NULL && $this->created_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
			}
		}
		if ($this->user_created_by->Required) {
			if (!$this->user_created_by->IsDetailKey && $this->user_created_by->FormValue != NULL && $this->user_created_by->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_created_by->caption(), $this->user_created_by->RequiredErrorMessage));
			}
		}
		if ($this->jenispel->Required) {
			if (!$this->jenispel->IsDetailKey && $this->jenispel->FormValue != NULL && $this->jenispel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenispel->caption(), $this->jenispel->RequiredErrorMessage));
			}
		}
		if ($this->kdkategori->Required) {
			if (!$this->kdkategori->IsDetailKey && $this->kdkategori->FormValue != NULL && $this->kdkategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kdkategori->caption(), $this->kdkategori->RequiredErrorMessage));
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
		if ($this->namaberkas->Required) {
			if ($this->namaberkas->Upload->FileName == "" && !$this->namaberkas->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->namaberkas->caption(), $this->namaberkas->RequiredErrorMessage));
			}
		}
		if ($this->statuspel->Required) {
			if (!$this->statuspel->IsDetailKey && $this->statuspel->FormValue != NULL && $this->statuspel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->statuspel->caption(), $this->statuspel->RequiredErrorMessage));
			}
		}
		if ($this->ket->Required) {
			if (!$this->ket->IsDetailKey && $this->ket->FormValue != NULL && $this->ket->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ket->caption(), $this->ket->RequiredErrorMessage));
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
		if ($this->real_peserta->Required) {
			if (!$this->real_peserta->IsDetailKey && $this->real_peserta->FormValue != NULL && $this->real_peserta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->real_peserta->caption(), $this->real_peserta->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->real_peserta->FormValue)) {
			AddMessage($FormError, $this->real_peserta->errorMessage());
		}
		if ($this->independen->Required) {
			if (!$this->independen->IsDetailKey && $this->independen->FormValue != NULL && $this->independen->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->independen->caption(), $this->independen->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->independen->FormValue)) {
			AddMessage($FormError, $this->independen->errorMessage());
		}
		if ($this->swasta_k->Required) {
			if (!$this->swasta_k->IsDetailKey && $this->swasta_k->FormValue != NULL && $this->swasta_k->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->swasta_k->caption(), $this->swasta_k->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->swasta_k->FormValue)) {
			AddMessage($FormError, $this->swasta_k->errorMessage());
		}
		if ($this->swasta_m->Required) {
			if (!$this->swasta_m->IsDetailKey && $this->swasta_m->FormValue != NULL && $this->swasta_m->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->swasta_m->caption(), $this->swasta_m->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->swasta_m->FormValue)) {
			AddMessage($FormError, $this->swasta_m->errorMessage());
		}
		if ($this->swasta_b->Required) {
			if (!$this->swasta_b->IsDetailKey && $this->swasta_b->FormValue != NULL && $this->swasta_b->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->swasta_b->caption(), $this->swasta_b->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->swasta_b->FormValue)) {
			AddMessage($FormError, $this->swasta_b->errorMessage());
		}
		if ($this->bumn->Required) {
			if (!$this->bumn->IsDetailKey && $this->bumn->FormValue != NULL && $this->bumn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bumn->caption(), $this->bumn->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->bumn->FormValue)) {
			AddMessage($FormError, $this->bumn->errorMessage());
		}
		if ($this->koperasi->Required) {
			if (!$this->koperasi->IsDetailKey && $this->koperasi->FormValue != NULL && $this->koperasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->koperasi->caption(), $this->koperasi->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->koperasi->FormValue)) {
			AddMessage($FormError, $this->koperasi->errorMessage());
		}
		if ($this->pns->Required) {
			if (!$this->pns->IsDetailKey && $this->pns->FormValue != NULL && $this->pns->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pns->caption(), $this->pns->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pns->FormValue)) {
			AddMessage($FormError, $this->pns->errorMessage());
		}
		if ($this->pt_dosen->Required) {
			if (!$this->pt_dosen->IsDetailKey && $this->pt_dosen->FormValue != NULL && $this->pt_dosen->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pt_dosen->caption(), $this->pt_dosen->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pt_dosen->FormValue)) {
			AddMessage($FormError, $this->pt_dosen->errorMessage());
		}
		if ($this->pt_mhs->Required) {
			if (!$this->pt_mhs->IsDetailKey && $this->pt_mhs->FormValue != NULL && $this->pt_mhs->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pt_mhs->caption(), $this->pt_mhs->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pt_mhs->FormValue)) {
			AddMessage($FormError, $this->pt_mhs->errorMessage());
		}
		if ($this->jk_l->Required) {
			if (!$this->jk_l->IsDetailKey && $this->jk_l->FormValue != NULL && $this->jk_l->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jk_l->caption(), $this->jk_l->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jk_l->FormValue)) {
			AddMessage($FormError, $this->jk_l->errorMessage());
		}
		if ($this->jk_p->Required) {
			if (!$this->jk_p->IsDetailKey && $this->jk_p->FormValue != NULL && $this->jk_p->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jk_p->caption(), $this->jk_p->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jk_p->FormValue)) {
			AddMessage($FormError, $this->jk_p->errorMessage());
		}
		if ($this->usia_k45->Required) {
			if (!$this->usia_k45->IsDetailKey && $this->usia_k45->FormValue != NULL && $this->usia_k45->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->usia_k45->caption(), $this->usia_k45->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->usia_k45->FormValue)) {
			AddMessage($FormError, $this->usia_k45->errorMessage());
		}
		if ($this->usia_b45->Required) {
			if (!$this->usia_b45->IsDetailKey && $this->usia_b45->FormValue != NULL && $this->usia_b45->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->usia_b45->caption(), $this->usia_b45->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->usia_b45->FormValue)) {
			AddMessage($FormError, $this->usia_b45->errorMessage());
		}
		if ($this->produk->Required) {
			if (!$this->produk->IsDetailKey && $this->produk->FormValue != NULL && $this->produk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->produk->caption(), $this->produk->RequiredErrorMessage));
			}
		}
		if ($this->bbio->Required) {
			if ($this->bbio->Upload->FileName == "" && !$this->bbio->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bbio->caption(), $this->bbio->RequiredErrorMessage));
			}
		}
		if ($this->bbio2->Required) {
			if ($this->bbio2->Upload->FileName == "" && !$this->bbio2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bbio2->caption(), $this->bbio2->RequiredErrorMessage));
			}
		}
		if ($this->bbio3->Required) {
			if ($this->bbio3->Upload->FileName == "" && !$this->bbio3->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bbio3->caption(), $this->bbio3->RequiredErrorMessage));
			}
		}
		if ($this->bbio4->Required) {
			if ($this->bbio4->Upload->FileName == "" && !$this->bbio4->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bbio4->caption(), $this->bbio4->RequiredErrorMessage));
			}
		}
		if ($this->bbio5->Required) {
			if ($this->bbio5->Upload->FileName == "" && !$this->bbio5->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bbio5->caption(), $this->bbio5->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("cv_historipeserta", $detailTblVar) && $GLOBALS["cv_historipeserta"]->DetailAdd) {
			if (!isset($GLOBALS["cv_historipeserta_grid"]))
				$GLOBALS["cv_historipeserta_grid"] = new cv_historipeserta_grid(); // Get detail page object
			$GLOBALS["cv_historipeserta_grid"]->validateGridForm();
		}
		if (in_array("cv_historiinstruktur", $detailTblVar) && $GLOBALS["cv_historiinstruktur"]->DetailAdd) {
			if (!isset($GLOBALS["cv_historiinstruktur_grid"]))
				$GLOBALS["cv_historiinstruktur_grid"] = new cv_historiinstruktur_grid(); // Get detail page object
			$GLOBALS["cv_historiinstruktur_grid"]->validateGridForm();
		}
		if (in_array("t_jadwalpel", $detailTblVar) && $GLOBALS["t_jadwalpel"]->DetailAdd) {
			if (!isset($GLOBALS["t_jadwalpel_grid"]))
				$GLOBALS["t_jadwalpel_grid"] = new t_jadwalpel_grid(); // Get detail page object
			$GLOBALS["t_jadwalpel_grid"]->validateGridForm();
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
		if ($this->kdpelat->CurrentValue != "") { // Check field with unique index
			$filter = "(`kdpelat` = '" . AdjustSql($this->kdpelat->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->kdpelat->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->kdpelat->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
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
		if (strval($this->kdkota->CurrentValue) != "") {
			$masterFilter = str_replace("@kdkota@", AdjustSql($this->kdkota->CurrentValue, "DB"), $masterFilter);
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
		if (strval($this->kdprop->CurrentValue) != "") {
			$masterFilter = str_replace("@kdprop@", AdjustSql($this->kdprop->CurrentValue, "DB"), $masterFilter);
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

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// kdpelat
		$this->kdpelat->setDbValueDef($rsnew, $this->kdpelat->CurrentValue, "", FALSE);

		// kdjudul
		$this->kdjudul->setDbValueDef($rsnew, $this->kdjudul->CurrentValue, NULL, FALSE);

		// kdkursil
		$this->kdkursil->setDbValueDef($rsnew, $this->kdkursil->CurrentValue, NULL, FALSE);

		// revisi
		$this->revisi->setDbValueDef($rsnew, $this->revisi->CurrentValue, NULL, FALSE);

		// tgl_terbit
		$this->tgl_terbit->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_terbit->CurrentValue, 0), NULL, FALSE);

		// pilihan_iso
		$this->pilihan_iso->setDbValueDef($rsnew, $this->pilihan_iso->CurrentValue, NULL, FALSE);

		// tawal
		$this->tawal->setDbValueDef($rsnew, UnFormatDateTime($this->tawal->CurrentValue, 0), NULL, FALSE);

		// takhir
		$this->takhir->setDbValueDef($rsnew, UnFormatDateTime($this->takhir->CurrentValue, 0), NULL, FALSE);

		// kdprop
		$this->kdprop->setDbValueDef($rsnew, $this->kdprop->CurrentValue, NULL, FALSE);

		// kdkota
		$this->kdkota->setDbValueDef($rsnew, $this->kdkota->CurrentValue, NULL, FALSE);

		// kdkec
		$this->kdkec->setDbValueDef($rsnew, $this->kdkec->CurrentValue, NULL, FALSE);

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

		// jenisevaluasi
		$this->jenisevaluasi->setDbValueDef($rsnew, $this->jenisevaluasi->CurrentValue, "", FALSE);

		// created_at
		$this->created_at->CurrentValue = CurrentDateTime();
		$this->created_at->setDbValueDef($rsnew, $this->created_at->CurrentValue, NULL);

		// user_created_by
		$this->user_created_by->CurrentValue = CurrentUserName();
		$this->user_created_by->setDbValueDef($rsnew, $this->user_created_by->CurrentValue, NULL);

		// jenispel
		$this->jenispel->setDbValueDef($rsnew, $this->jenispel->CurrentValue, NULL, FALSE);

		// kdkategori
		$this->kdkategori->setDbValueDef($rsnew, $this->kdkategori->CurrentValue, NULL, FALSE);

		// kerjasama
		$this->kerjasama->setDbValueDef($rsnew, $this->kerjasama->CurrentValue, NULL, FALSE);

		// biaya
		$this->biaya->setDbValueDef($rsnew, $this->biaya->CurrentValue, NULL, FALSE);

		// namaberkas
		if ($this->namaberkas->Visible && !$this->namaberkas->Upload->KeepFile) {
			$this->namaberkas->Upload->DbValue = ""; // No need to delete old file
			if ($this->namaberkas->Upload->FileName == "") {
				$rsnew['namaberkas'] = NULL;
			} else {
				$rsnew['namaberkas'] = $this->namaberkas->Upload->FileName;
			}
		}

		// statuspel
		$this->statuspel->setDbValueDef($rsnew, $this->statuspel->CurrentValue, NULL, FALSE);

		// ket
		$this->ket->setDbValueDef($rsnew, $this->ket->CurrentValue, NULL, FALSE);

		// jpeserta
		$this->jpeserta->setDbValueDef($rsnew, $this->jpeserta->CurrentValue, NULL, FALSE);

		// real_peserta
		$this->real_peserta->setDbValueDef($rsnew, $this->real_peserta->CurrentValue, NULL, FALSE);

		// independen
		$this->independen->setDbValueDef($rsnew, $this->independen->CurrentValue, NULL, FALSE);

		// swasta_k
		$this->swasta_k->setDbValueDef($rsnew, $this->swasta_k->CurrentValue, NULL, FALSE);

		// swasta_m
		$this->swasta_m->setDbValueDef($rsnew, $this->swasta_m->CurrentValue, NULL, FALSE);

		// swasta_b
		$this->swasta_b->setDbValueDef($rsnew, $this->swasta_b->CurrentValue, NULL, FALSE);

		// bumn
		$this->bumn->setDbValueDef($rsnew, $this->bumn->CurrentValue, NULL, FALSE);

		// koperasi
		$this->koperasi->setDbValueDef($rsnew, $this->koperasi->CurrentValue, NULL, FALSE);

		// pns
		$this->pns->setDbValueDef($rsnew, $this->pns->CurrentValue, NULL, FALSE);

		// pt_dosen
		$this->pt_dosen->setDbValueDef($rsnew, $this->pt_dosen->CurrentValue, NULL, FALSE);

		// pt_mhs
		$this->pt_mhs->setDbValueDef($rsnew, $this->pt_mhs->CurrentValue, NULL, FALSE);

		// jk_l
		$this->jk_l->setDbValueDef($rsnew, $this->jk_l->CurrentValue, NULL, FALSE);

		// jk_p
		$this->jk_p->setDbValueDef($rsnew, $this->jk_p->CurrentValue, NULL, FALSE);

		// usia_k45
		$this->usia_k45->setDbValueDef($rsnew, $this->usia_k45->CurrentValue, NULL, FALSE);

		// usia_b45
		$this->usia_b45->setDbValueDef($rsnew, $this->usia_b45->CurrentValue, NULL, FALSE);

		// produk
		$this->produk->setDbValueDef($rsnew, $this->produk->CurrentValue, NULL, FALSE);

		// bbio
		if ($this->bbio->Visible && !$this->bbio->Upload->KeepFile) {
			$this->bbio->Upload->DbValue = ""; // No need to delete old file
			if ($this->bbio->Upload->FileName == "") {
				$rsnew['bbio'] = NULL;
			} else {
				$rsnew['bbio'] = $this->bbio->Upload->FileName;
			}
		}

		// bbio2
		if ($this->bbio2->Visible && !$this->bbio2->Upload->KeepFile) {
			$this->bbio2->Upload->DbValue = ""; // No need to delete old file
			if ($this->bbio2->Upload->FileName == "") {
				$rsnew['bbio2'] = NULL;
			} else {
				$rsnew['bbio2'] = $this->bbio2->Upload->FileName;
			}
		}

		// bbio3
		if ($this->bbio3->Visible && !$this->bbio3->Upload->KeepFile) {
			$this->bbio3->Upload->DbValue = ""; // No need to delete old file
			if ($this->bbio3->Upload->FileName == "") {
				$rsnew['bbio3'] = NULL;
			} else {
				$rsnew['bbio3'] = $this->bbio3->Upload->FileName;
			}
		}

		// bbio4
		if ($this->bbio4->Visible && !$this->bbio4->Upload->KeepFile) {
			$this->bbio4->Upload->DbValue = ""; // No need to delete old file
			if ($this->bbio4->Upload->FileName == "") {
				$rsnew['bbio4'] = NULL;
			} else {
				$rsnew['bbio4'] = $this->bbio4->Upload->FileName;
			}
		}

		// bbio5
		if ($this->bbio5->Visible && !$this->bbio5->Upload->KeepFile) {
			$this->bbio5->Upload->DbValue = ""; // No need to delete old file
			if ($this->bbio5->Upload->FileName == "") {
				$rsnew['bbio5'] = NULL;
			} else {
				$rsnew['bbio5'] = $this->bbio5->Upload->FileName;
			}
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
		if ($this->bbio->Visible && !$this->bbio->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->bbio->Upload->DbValue) ? [] : [$this->bbio->htmlDecode($this->bbio->Upload->DbValue)];
			if (!EmptyValue($this->bbio->Upload->FileName)) {
				$newFiles = [$this->bbio->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->bbio, $this->bbio->Upload->Index);
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
							$file1 = UniqueFilename($this->bbio->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->bbio->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->bbio->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->bbio->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->bbio->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->bbio->setDbValueDef($rsnew, $this->bbio->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->bbio2->Visible && !$this->bbio2->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->bbio2->Upload->DbValue) ? [] : [$this->bbio2->htmlDecode($this->bbio2->Upload->DbValue)];
			if (!EmptyValue($this->bbio2->Upload->FileName)) {
				$newFiles = [$this->bbio2->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->bbio2, $this->bbio2->Upload->Index);
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
							$file1 = UniqueFilename($this->bbio2->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->bbio2->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->bbio2->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->bbio2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->bbio2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->bbio2->setDbValueDef($rsnew, $this->bbio2->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->bbio3->Visible && !$this->bbio3->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->bbio3->Upload->DbValue) ? [] : [$this->bbio3->htmlDecode($this->bbio3->Upload->DbValue)];
			if (!EmptyValue($this->bbio3->Upload->FileName)) {
				$newFiles = [$this->bbio3->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->bbio3, $this->bbio3->Upload->Index);
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
							$file1 = UniqueFilename($this->bbio3->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->bbio3->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->bbio3->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->bbio3->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->bbio3->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->bbio3->setDbValueDef($rsnew, $this->bbio3->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->bbio4->Visible && !$this->bbio4->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->bbio4->Upload->DbValue) ? [] : [$this->bbio4->htmlDecode($this->bbio4->Upload->DbValue)];
			if (!EmptyValue($this->bbio4->Upload->FileName)) {
				$newFiles = [$this->bbio4->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->bbio4, $this->bbio4->Upload->Index);
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
							$file1 = UniqueFilename($this->bbio4->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->bbio4->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->bbio4->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->bbio4->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->bbio4->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->bbio4->setDbValueDef($rsnew, $this->bbio4->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->bbio5->Visible && !$this->bbio5->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->bbio5->Upload->DbValue) ? [] : [$this->bbio5->htmlDecode($this->bbio5->Upload->DbValue)];
			if (!EmptyValue($this->bbio5->Upload->FileName)) {
				$newFiles = [$this->bbio5->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->bbio5, $this->bbio5->Upload->Index);
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
							$file1 = UniqueFilename($this->bbio5->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->bbio5->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->bbio5->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->bbio5->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->bbio5->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->bbio5->setDbValueDef($rsnew, $this->bbio5->Upload->FileName, NULL, FALSE);
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
				if ($this->bbio->Visible && !$this->bbio->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->bbio->Upload->DbValue) ? [] : [$this->bbio->htmlDecode($this->bbio->Upload->DbValue)];
					if (!EmptyValue($this->bbio->Upload->FileName)) {
						$newFiles = [$this->bbio->Upload->FileName];
						$newFiles2 = [$this->bbio->htmlDecode($rsnew['bbio'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->bbio, $this->bbio->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->bbio->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->bbio->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->bbio2->Visible && !$this->bbio2->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->bbio2->Upload->DbValue) ? [] : [$this->bbio2->htmlDecode($this->bbio2->Upload->DbValue)];
					if (!EmptyValue($this->bbio2->Upload->FileName)) {
						$newFiles = [$this->bbio2->Upload->FileName];
						$newFiles2 = [$this->bbio2->htmlDecode($rsnew['bbio2'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->bbio2, $this->bbio2->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->bbio2->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->bbio2->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->bbio3->Visible && !$this->bbio3->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->bbio3->Upload->DbValue) ? [] : [$this->bbio3->htmlDecode($this->bbio3->Upload->DbValue)];
					if (!EmptyValue($this->bbio3->Upload->FileName)) {
						$newFiles = [$this->bbio3->Upload->FileName];
						$newFiles2 = [$this->bbio3->htmlDecode($rsnew['bbio3'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->bbio3, $this->bbio3->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->bbio3->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->bbio3->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->bbio4->Visible && !$this->bbio4->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->bbio4->Upload->DbValue) ? [] : [$this->bbio4->htmlDecode($this->bbio4->Upload->DbValue)];
					if (!EmptyValue($this->bbio4->Upload->FileName)) {
						$newFiles = [$this->bbio4->Upload->FileName];
						$newFiles2 = [$this->bbio4->htmlDecode($rsnew['bbio4'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->bbio4, $this->bbio4->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->bbio4->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->bbio4->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->bbio5->Visible && !$this->bbio5->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->bbio5->Upload->DbValue) ? [] : [$this->bbio5->htmlDecode($this->bbio5->Upload->DbValue)];
					if (!EmptyValue($this->bbio5->Upload->FileName)) {
						$newFiles = [$this->bbio5->Upload->FileName];
						$newFiles2 = [$this->bbio5->htmlDecode($rsnew['bbio5'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->bbio5, $this->bbio5->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->bbio5->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->bbio5->oldPhysicalUploadPath() . $oldFile);
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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("cv_historipeserta", $detailTblVar) && $GLOBALS["cv_historipeserta"]->DetailAdd) {
				$GLOBALS["cv_historipeserta"]->kdpelat->setSessionValue($this->kdpelat->CurrentValue); // Set master key
				if (!isset($GLOBALS["cv_historipeserta_grid"]))
					$GLOBALS["cv_historipeserta_grid"] = new cv_historipeserta_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "cv_historipeserta"); // Load user level of detail table
				$addRow = $GLOBALS["cv_historipeserta_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["cv_historipeserta"]->kdpelat->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("cv_historiinstruktur", $detailTblVar) && $GLOBALS["cv_historiinstruktur"]->DetailAdd) {
				$GLOBALS["cv_historiinstruktur"]->kdpelat->setSessionValue($this->kdpelat->CurrentValue); // Set master key
				if (!isset($GLOBALS["cv_historiinstruktur_grid"]))
					$GLOBALS["cv_historiinstruktur_grid"] = new cv_historiinstruktur_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "cv_historiinstruktur"); // Load user level of detail table
				$addRow = $GLOBALS["cv_historiinstruktur_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["cv_historiinstruktur"]->kdpelat->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("t_jadwalpel", $detailTblVar) && $GLOBALS["t_jadwalpel"]->DetailAdd) {
				$GLOBALS["t_jadwalpel"]->idpelat->setSessionValue($this->idpelat->CurrentValue); // Set master key
				$GLOBALS["t_jadwalpel"]->kdjudul->setSessionValue($this->kdjudul->CurrentValue); // Set master key
				if (!isset($GLOBALS["t_jadwalpel_grid"]))
					$GLOBALS["t_jadwalpel_grid"] = new t_jadwalpel_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "t_jadwalpel"); // Load user level of detail table
				$addRow = $GLOBALS["t_jadwalpel_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["t_jadwalpel"]->idpelat->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["t_jadwalpel"]->kdjudul->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
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

			// bbio
			CleanUploadTempPath($this->bbio, $this->bbio->Upload->Index);

			// bbio2
			CleanUploadTempPath($this->bbio2, $this->bbio2->Upload->Index);

			// bbio3
			CleanUploadTempPath($this->bbio3, $this->bbio3->Upload->Index);

			// bbio4
			CleanUploadTempPath($this->bbio4, $this->bbio4->Upload->Index);

			// bbio5
			CleanUploadTempPath($this->bbio5, $this->bbio5->Upload->Index);
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
			if ($masterTblVar == "t_judul") {
				$validMaster = TRUE;
				if (($parm = Get("fk_kdjudul", Get("kdjudul"))) !== NULL) {
					$GLOBALS["t_judul"]->kdjudul->setQueryStringValue($parm);
					$this->kdjudul->setQueryStringValue($GLOBALS["t_judul"]->kdjudul->QueryStringValue);
					$this->kdjudul->setSessionValue($this->kdjudul->QueryStringValue);
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
			if ($masterTblVar == "t_judul") {
				$validMaster = TRUE;
				if (($parm = Post("fk_kdjudul", Post("kdjudul"))) !== NULL) {
					$GLOBALS["t_judul"]->kdjudul->setFormValue($parm);
					$this->kdjudul->setFormValue($GLOBALS["t_judul"]->kdjudul->FormValue);
					$this->kdjudul->setSessionValue($this->kdjudul->FormValue);
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
			if ($masterTblVar != "t_judul") {
				if ($this->kdjudul->CurrentValue == "")
					$this->kdjudul->setSessionValue("");
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
			if (in_array("cv_historipeserta", $detailTblVar)) {
				if (!isset($GLOBALS["cv_historipeserta_grid"]))
					$GLOBALS["cv_historipeserta_grid"] = new cv_historipeserta_grid();
				if ($GLOBALS["cv_historipeserta_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["cv_historipeserta_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["cv_historipeserta_grid"]->CurrentMode = "add";
					$GLOBALS["cv_historipeserta_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["cv_historipeserta_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cv_historipeserta_grid"]->setStartRecordNumber(1);
					$GLOBALS["cv_historipeserta_grid"]->kdpelat->IsDetailKey = TRUE;
					$GLOBALS["cv_historipeserta_grid"]->kdpelat->CurrentValue = $this->kdpelat->CurrentValue;
					$GLOBALS["cv_historipeserta_grid"]->kdpelat->setSessionValue($GLOBALS["cv_historipeserta_grid"]->kdpelat->CurrentValue);
				}
			}
			if (in_array("cv_historiinstruktur", $detailTblVar)) {
				if (!isset($GLOBALS["cv_historiinstruktur_grid"]))
					$GLOBALS["cv_historiinstruktur_grid"] = new cv_historiinstruktur_grid();
				if ($GLOBALS["cv_historiinstruktur_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["cv_historiinstruktur_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["cv_historiinstruktur_grid"]->CurrentMode = "add";
					$GLOBALS["cv_historiinstruktur_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["cv_historiinstruktur_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cv_historiinstruktur_grid"]->setStartRecordNumber(1);
					$GLOBALS["cv_historiinstruktur_grid"]->kdpelat->IsDetailKey = TRUE;
					$GLOBALS["cv_historiinstruktur_grid"]->kdpelat->CurrentValue = $this->kdpelat->CurrentValue;
					$GLOBALS["cv_historiinstruktur_grid"]->kdpelat->setSessionValue($GLOBALS["cv_historiinstruktur_grid"]->kdpelat->CurrentValue);
				}
			}
			if (in_array("t_jadwalpel", $detailTblVar)) {
				if (!isset($GLOBALS["t_jadwalpel_grid"]))
					$GLOBALS["t_jadwalpel_grid"] = new t_jadwalpel_grid();
				if ($GLOBALS["t_jadwalpel_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t_jadwalpel_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t_jadwalpel_grid"]->CurrentMode = "add";
					$GLOBALS["t_jadwalpel_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t_jadwalpel_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t_jadwalpel_grid"]->setStartRecordNumber(1);
					$GLOBALS["t_jadwalpel_grid"]->idpelat->IsDetailKey = TRUE;
					$GLOBALS["t_jadwalpel_grid"]->idpelat->CurrentValue = $this->idpelat->CurrentValue;
					$GLOBALS["t_jadwalpel_grid"]->idpelat->setSessionValue($GLOBALS["t_jadwalpel_grid"]->idpelat->CurrentValue);
					$GLOBALS["t_jadwalpel_grid"]->kdjudul->IsDetailKey = TRUE;
					$GLOBALS["t_jadwalpel_grid"]->kdjudul->CurrentValue = $this->kdjudul->CurrentValue;
					$GLOBALS["t_jadwalpel_grid"]->kdjudul->setSessionValue($GLOBALS["t_jadwalpel_grid"]->kdjudul->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_pelatihanlist.php"), "", $this->TableVar, TRUE);
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
		$this->setFailureMessage("Maaf, halaman ini tidak bisa diakses!");
		$url = "t_pelatihanlist.php?cmd=resetall";
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

		$this->revisi->ReadOnly = TRUE;
		$this->tgl_terbit->ReadOnly = TRUE;
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