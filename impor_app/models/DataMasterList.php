<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class DataMasterList extends DataMaster
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'data_master';

    // Page object name
    public $PageObjName = "DataMasterList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fdata_masterlist";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Export URLs
    public $ExportPrintUrl;
    public $ExportHtmlUrl;
    public $ExportExcelUrl;
    public $ExportWordUrl;
    public $ExportXmlUrl;
    public $ExportCsvUrl;
    public $ExportPdfUrl;

    // Custom export
    public $ExportExcelCustom = false;
    public $ExportWordCustom = false;
    public $ExportPdfCustom = false;
    public $ExportEmailCustom = false;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
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
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (data_master)
        if (!isset($GLOBALS["data_master"]) || get_class($GLOBALS["data_master"]) == PROJECT_NAMESPACE . "data_master") {
            $GLOBALS["data_master"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Initialize URLs
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->AddUrl = "datamasteradd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "datamasterdelete";
        $this->MultiUpdateUrl = "datamasterupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'data_master');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // List options
        $this->ListOptions = new ListOptions();
        $this->ListOptions->TableVar = $this->TableVar;

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Import options
        $this->ImportOptions = new ListOptions("div");
        $this->ImportOptions->TagClassName = "ew-import-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";

        // Filter options
        $this->FilterOptions = new ListOptions("div");
        $this->FilterOptions->TagClassName = "ew-filter-option fdata_masterlistsrch";

        // List actions
        $this->ListActions = new ListActions();
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("data_master"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }
            SaveDebugMessage();
            Redirect(GetUrl($url));
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
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
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

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
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
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
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
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
    public $DisplayRecords = 10;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
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
    public $MultiColumnClass = "col-sm";
    public $MultiColumnEditClass = "w-100";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup import options
        $this->setupImportOptions();
        $this->dipindahkan->setVisibility();
        $this->id->Visible = false;
        $this->kdpelat->setVisibility();
        $this->Email_Address->setVisibility();
        $this->Nama_Lengkap->setVisibility();
        $this->Nomor_Handphone->setVisibility();
        $this->Jenis_Kelamin->setVisibility();
        $this->Tempat_Lahir->setVisibility();
        $this->Tanggal_Lahir->setVisibility();
        $this->Alamat_Tinggal->setVisibility();
        $this->Provinsi->setVisibility();
        $this->Kabupaten_Kota->setVisibility();
        $this->Jabatan_di_Perusahaan->setVisibility();
        $this->Pendidikan->setVisibility();
        $this->Nama_Perusahaan_Instansi->setVisibility();
        $this->Contact_Person_Perusahaan->setVisibility();
        $this->Telepon_Kantor->setVisibility();
        $this->_Email->setVisibility();
        $this->Website->setVisibility();
        $this->Alamat_Kantor->setVisibility();
        $this->Provinsi2->setVisibility();
        $this->Kabupaten_Kota2->setVisibility();
        $this->ID_Sosial_Media->setVisibility();
        $this->Kategori_perusahaan->setVisibility();
        $this->Jenis_Usaha->setVisibility();
        $this->Skala_Perusahaan->setVisibility();
        $this->Kategori_Produk->setVisibility();
        $this->Produk_Perusahaan->setVisibility();
        $this->HS_Code_Product->setVisibility();
        $this->Omset_Perusahaan->setVisibility();
        $this->Kapasitas_Produksi->setVisibility();
        $this->Pengalaman_Ekspor->Visible = false;
        $this->ekspor_ke_negara_mana->setVisibility();
        $this->mengikuti_pelatihan_sebelumnya->setVisibility();
        $this->pelatihan_apa_dimana->setVisibility();
        $this->mendapatkan_informasi->setVisibility();
        $this->harapkan_dari_pelatihan->setVisibility();
        $this->data_diisi_benar->setVisibility();
        $this->hideFieldsForAddEdit();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Show checkbox column if multiple action
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
                $this->ListOptions["checkbox"]->Visible = true;
                break;
            }
        }

        // Set up lookup cache

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Check QueryString parameters
            if (Get("action") !== null) {
                $this->CurrentAction = Get("action");
            } else {
                if (Post("action") !== null) {
                    $this->CurrentAction = Post("action"); // Get action

                    // Process import
                    if ($this->isImport()) {
                        $this->import(Post(Config("API_FILE_TOKEN_NAME")));
                        $this->terminate();
                        return;
                    }
                }
            }

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 10; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load Sorting Order
        if ($this->Command != "json") {
            $this->loadSortOrder();
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
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

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->dipindahkan->AdvancedSearch->toJson(), ","); // Field dipindahkan
        $filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
        $filterList = Concat($filterList, $this->kdpelat->AdvancedSearch->toJson(), ","); // Field kdpelat
        $filterList = Concat($filterList, $this->Email_Address->AdvancedSearch->toJson(), ","); // Field Email_Address
        $filterList = Concat($filterList, $this->Nama_Lengkap->AdvancedSearch->toJson(), ","); // Field Nama_Lengkap
        $filterList = Concat($filterList, $this->Nomor_Handphone->AdvancedSearch->toJson(), ","); // Field Nomor_Handphone
        $filterList = Concat($filterList, $this->Jenis_Kelamin->AdvancedSearch->toJson(), ","); // Field Jenis_Kelamin
        $filterList = Concat($filterList, $this->Tempat_Lahir->AdvancedSearch->toJson(), ","); // Field Tempat_Lahir
        $filterList = Concat($filterList, $this->Tanggal_Lahir->AdvancedSearch->toJson(), ","); // Field Tanggal_Lahir
        $filterList = Concat($filterList, $this->Alamat_Tinggal->AdvancedSearch->toJson(), ","); // Field Alamat_Tinggal
        $filterList = Concat($filterList, $this->Provinsi->AdvancedSearch->toJson(), ","); // Field Provinsi
        $filterList = Concat($filterList, $this->Kabupaten_Kota->AdvancedSearch->toJson(), ","); // Field Kabupaten_Kota
        $filterList = Concat($filterList, $this->Jabatan_di_Perusahaan->AdvancedSearch->toJson(), ","); // Field Jabatan_di_Perusahaan
        $filterList = Concat($filterList, $this->Pendidikan->AdvancedSearch->toJson(), ","); // Field Pendidikan
        $filterList = Concat($filterList, $this->Nama_Perusahaan_Instansi->AdvancedSearch->toJson(), ","); // Field Nama_Perusahaan_Instansi
        $filterList = Concat($filterList, $this->Contact_Person_Perusahaan->AdvancedSearch->toJson(), ","); // Field Contact_Person_Perusahaan
        $filterList = Concat($filterList, $this->Telepon_Kantor->AdvancedSearch->toJson(), ","); // Field Telepon_Kantor
        $filterList = Concat($filterList, $this->_Email->AdvancedSearch->toJson(), ","); // Field Email
        $filterList = Concat($filterList, $this->Website->AdvancedSearch->toJson(), ","); // Field Website
        $filterList = Concat($filterList, $this->Alamat_Kantor->AdvancedSearch->toJson(), ","); // Field Alamat_Kantor
        $filterList = Concat($filterList, $this->Provinsi2->AdvancedSearch->toJson(), ","); // Field Provinsi2
        $filterList = Concat($filterList, $this->Kabupaten_Kota2->AdvancedSearch->toJson(), ","); // Field Kabupaten_Kota2
        $filterList = Concat($filterList, $this->ID_Sosial_Media->AdvancedSearch->toJson(), ","); // Field ID_Sosial_Media
        $filterList = Concat($filterList, $this->Kategori_perusahaan->AdvancedSearch->toJson(), ","); // Field Kategori_perusahaan
        $filterList = Concat($filterList, $this->Jenis_Usaha->AdvancedSearch->toJson(), ","); // Field Jenis_Usaha
        $filterList = Concat($filterList, $this->Skala_Perusahaan->AdvancedSearch->toJson(), ","); // Field Skala_Perusahaan
        $filterList = Concat($filterList, $this->Kategori_Produk->AdvancedSearch->toJson(), ","); // Field Kategori_Produk
        $filterList = Concat($filterList, $this->Produk_Perusahaan->AdvancedSearch->toJson(), ","); // Field Produk_Perusahaan
        $filterList = Concat($filterList, $this->HS_Code_Product->AdvancedSearch->toJson(), ","); // Field HS_Code_Product
        $filterList = Concat($filterList, $this->Omset_Perusahaan->AdvancedSearch->toJson(), ","); // Field Omset_Perusahaan
        $filterList = Concat($filterList, $this->Kapasitas_Produksi->AdvancedSearch->toJson(), ","); // Field Kapasitas_Produksi
        $filterList = Concat($filterList, $this->Pengalaman_Ekspor->AdvancedSearch->toJson(), ","); // Field Pengalaman_Ekspor
        $filterList = Concat($filterList, $this->ekspor_ke_negara_mana->AdvancedSearch->toJson(), ","); // Field ekspor_ke_negara_mana
        $filterList = Concat($filterList, $this->mengikuti_pelatihan_sebelumnya->AdvancedSearch->toJson(), ","); // Field mengikuti_pelatihan_sebelumnya
        $filterList = Concat($filterList, $this->pelatihan_apa_dimana->AdvancedSearch->toJson(), ","); // Field pelatihan_apa_dimana
        $filterList = Concat($filterList, $this->mendapatkan_informasi->AdvancedSearch->toJson(), ","); // Field mendapatkan_informasi
        $filterList = Concat($filterList, $this->harapkan_dari_pelatihan->AdvancedSearch->toJson(), ","); // Field harapkan_dari_pelatihan
        $filterList = Concat($filterList, $this->data_diisi_benar->AdvancedSearch->toJson(), ","); // Field data_diisi_benar
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fdata_masterlistsrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field dipindahkan
        $this->dipindahkan->AdvancedSearch->SearchValue = @$filter["x_dipindahkan"];
        $this->dipindahkan->AdvancedSearch->SearchOperator = @$filter["z_dipindahkan"];
        $this->dipindahkan->AdvancedSearch->SearchCondition = @$filter["v_dipindahkan"];
        $this->dipindahkan->AdvancedSearch->SearchValue2 = @$filter["y_dipindahkan"];
        $this->dipindahkan->AdvancedSearch->SearchOperator2 = @$filter["w_dipindahkan"];
        $this->dipindahkan->AdvancedSearch->save();

        // Field id
        $this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
        $this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
        $this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
        $this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
        $this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
        $this->id->AdvancedSearch->save();

        // Field kdpelat
        $this->kdpelat->AdvancedSearch->SearchValue = @$filter["x_kdpelat"];
        $this->kdpelat->AdvancedSearch->SearchOperator = @$filter["z_kdpelat"];
        $this->kdpelat->AdvancedSearch->SearchCondition = @$filter["v_kdpelat"];
        $this->kdpelat->AdvancedSearch->SearchValue2 = @$filter["y_kdpelat"];
        $this->kdpelat->AdvancedSearch->SearchOperator2 = @$filter["w_kdpelat"];
        $this->kdpelat->AdvancedSearch->save();

        // Field Email_Address
        $this->Email_Address->AdvancedSearch->SearchValue = @$filter["x_Email_Address"];
        $this->Email_Address->AdvancedSearch->SearchOperator = @$filter["z_Email_Address"];
        $this->Email_Address->AdvancedSearch->SearchCondition = @$filter["v_Email_Address"];
        $this->Email_Address->AdvancedSearch->SearchValue2 = @$filter["y_Email_Address"];
        $this->Email_Address->AdvancedSearch->SearchOperator2 = @$filter["w_Email_Address"];
        $this->Email_Address->AdvancedSearch->save();

        // Field Nama_Lengkap
        $this->Nama_Lengkap->AdvancedSearch->SearchValue = @$filter["x_Nama_Lengkap"];
        $this->Nama_Lengkap->AdvancedSearch->SearchOperator = @$filter["z_Nama_Lengkap"];
        $this->Nama_Lengkap->AdvancedSearch->SearchCondition = @$filter["v_Nama_Lengkap"];
        $this->Nama_Lengkap->AdvancedSearch->SearchValue2 = @$filter["y_Nama_Lengkap"];
        $this->Nama_Lengkap->AdvancedSearch->SearchOperator2 = @$filter["w_Nama_Lengkap"];
        $this->Nama_Lengkap->AdvancedSearch->save();

        // Field Nomor_Handphone
        $this->Nomor_Handphone->AdvancedSearch->SearchValue = @$filter["x_Nomor_Handphone"];
        $this->Nomor_Handphone->AdvancedSearch->SearchOperator = @$filter["z_Nomor_Handphone"];
        $this->Nomor_Handphone->AdvancedSearch->SearchCondition = @$filter["v_Nomor_Handphone"];
        $this->Nomor_Handphone->AdvancedSearch->SearchValue2 = @$filter["y_Nomor_Handphone"];
        $this->Nomor_Handphone->AdvancedSearch->SearchOperator2 = @$filter["w_Nomor_Handphone"];
        $this->Nomor_Handphone->AdvancedSearch->save();

        // Field Jenis_Kelamin
        $this->Jenis_Kelamin->AdvancedSearch->SearchValue = @$filter["x_Jenis_Kelamin"];
        $this->Jenis_Kelamin->AdvancedSearch->SearchOperator = @$filter["z_Jenis_Kelamin"];
        $this->Jenis_Kelamin->AdvancedSearch->SearchCondition = @$filter["v_Jenis_Kelamin"];
        $this->Jenis_Kelamin->AdvancedSearch->SearchValue2 = @$filter["y_Jenis_Kelamin"];
        $this->Jenis_Kelamin->AdvancedSearch->SearchOperator2 = @$filter["w_Jenis_Kelamin"];
        $this->Jenis_Kelamin->AdvancedSearch->save();

        // Field Tempat_Lahir
        $this->Tempat_Lahir->AdvancedSearch->SearchValue = @$filter["x_Tempat_Lahir"];
        $this->Tempat_Lahir->AdvancedSearch->SearchOperator = @$filter["z_Tempat_Lahir"];
        $this->Tempat_Lahir->AdvancedSearch->SearchCondition = @$filter["v_Tempat_Lahir"];
        $this->Tempat_Lahir->AdvancedSearch->SearchValue2 = @$filter["y_Tempat_Lahir"];
        $this->Tempat_Lahir->AdvancedSearch->SearchOperator2 = @$filter["w_Tempat_Lahir"];
        $this->Tempat_Lahir->AdvancedSearch->save();

        // Field Tanggal_Lahir
        $this->Tanggal_Lahir->AdvancedSearch->SearchValue = @$filter["x_Tanggal_Lahir"];
        $this->Tanggal_Lahir->AdvancedSearch->SearchOperator = @$filter["z_Tanggal_Lahir"];
        $this->Tanggal_Lahir->AdvancedSearch->SearchCondition = @$filter["v_Tanggal_Lahir"];
        $this->Tanggal_Lahir->AdvancedSearch->SearchValue2 = @$filter["y_Tanggal_Lahir"];
        $this->Tanggal_Lahir->AdvancedSearch->SearchOperator2 = @$filter["w_Tanggal_Lahir"];
        $this->Tanggal_Lahir->AdvancedSearch->save();

        // Field Alamat_Tinggal
        $this->Alamat_Tinggal->AdvancedSearch->SearchValue = @$filter["x_Alamat_Tinggal"];
        $this->Alamat_Tinggal->AdvancedSearch->SearchOperator = @$filter["z_Alamat_Tinggal"];
        $this->Alamat_Tinggal->AdvancedSearch->SearchCondition = @$filter["v_Alamat_Tinggal"];
        $this->Alamat_Tinggal->AdvancedSearch->SearchValue2 = @$filter["y_Alamat_Tinggal"];
        $this->Alamat_Tinggal->AdvancedSearch->SearchOperator2 = @$filter["w_Alamat_Tinggal"];
        $this->Alamat_Tinggal->AdvancedSearch->save();

        // Field Provinsi
        $this->Provinsi->AdvancedSearch->SearchValue = @$filter["x_Provinsi"];
        $this->Provinsi->AdvancedSearch->SearchOperator = @$filter["z_Provinsi"];
        $this->Provinsi->AdvancedSearch->SearchCondition = @$filter["v_Provinsi"];
        $this->Provinsi->AdvancedSearch->SearchValue2 = @$filter["y_Provinsi"];
        $this->Provinsi->AdvancedSearch->SearchOperator2 = @$filter["w_Provinsi"];
        $this->Provinsi->AdvancedSearch->save();

        // Field Kabupaten_Kota
        $this->Kabupaten_Kota->AdvancedSearch->SearchValue = @$filter["x_Kabupaten_Kota"];
        $this->Kabupaten_Kota->AdvancedSearch->SearchOperator = @$filter["z_Kabupaten_Kota"];
        $this->Kabupaten_Kota->AdvancedSearch->SearchCondition = @$filter["v_Kabupaten_Kota"];
        $this->Kabupaten_Kota->AdvancedSearch->SearchValue2 = @$filter["y_Kabupaten_Kota"];
        $this->Kabupaten_Kota->AdvancedSearch->SearchOperator2 = @$filter["w_Kabupaten_Kota"];
        $this->Kabupaten_Kota->AdvancedSearch->save();

        // Field Jabatan_di_Perusahaan
        $this->Jabatan_di_Perusahaan->AdvancedSearch->SearchValue = @$filter["x_Jabatan_di_Perusahaan"];
        $this->Jabatan_di_Perusahaan->AdvancedSearch->SearchOperator = @$filter["z_Jabatan_di_Perusahaan"];
        $this->Jabatan_di_Perusahaan->AdvancedSearch->SearchCondition = @$filter["v_Jabatan_di_Perusahaan"];
        $this->Jabatan_di_Perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_Jabatan_di_Perusahaan"];
        $this->Jabatan_di_Perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_Jabatan_di_Perusahaan"];
        $this->Jabatan_di_Perusahaan->AdvancedSearch->save();

        // Field Pendidikan
        $this->Pendidikan->AdvancedSearch->SearchValue = @$filter["x_Pendidikan"];
        $this->Pendidikan->AdvancedSearch->SearchOperator = @$filter["z_Pendidikan"];
        $this->Pendidikan->AdvancedSearch->SearchCondition = @$filter["v_Pendidikan"];
        $this->Pendidikan->AdvancedSearch->SearchValue2 = @$filter["y_Pendidikan"];
        $this->Pendidikan->AdvancedSearch->SearchOperator2 = @$filter["w_Pendidikan"];
        $this->Pendidikan->AdvancedSearch->save();

        // Field Nama_Perusahaan_Instansi
        $this->Nama_Perusahaan_Instansi->AdvancedSearch->SearchValue = @$filter["x_Nama_Perusahaan_Instansi"];
        $this->Nama_Perusahaan_Instansi->AdvancedSearch->SearchOperator = @$filter["z_Nama_Perusahaan_Instansi"];
        $this->Nama_Perusahaan_Instansi->AdvancedSearch->SearchCondition = @$filter["v_Nama_Perusahaan_Instansi"];
        $this->Nama_Perusahaan_Instansi->AdvancedSearch->SearchValue2 = @$filter["y_Nama_Perusahaan_Instansi"];
        $this->Nama_Perusahaan_Instansi->AdvancedSearch->SearchOperator2 = @$filter["w_Nama_Perusahaan_Instansi"];
        $this->Nama_Perusahaan_Instansi->AdvancedSearch->save();

        // Field Contact_Person_Perusahaan
        $this->Contact_Person_Perusahaan->AdvancedSearch->SearchValue = @$filter["x_Contact_Person_Perusahaan"];
        $this->Contact_Person_Perusahaan->AdvancedSearch->SearchOperator = @$filter["z_Contact_Person_Perusahaan"];
        $this->Contact_Person_Perusahaan->AdvancedSearch->SearchCondition = @$filter["v_Contact_Person_Perusahaan"];
        $this->Contact_Person_Perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_Contact_Person_Perusahaan"];
        $this->Contact_Person_Perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_Contact_Person_Perusahaan"];
        $this->Contact_Person_Perusahaan->AdvancedSearch->save();

        // Field Telepon_Kantor
        $this->Telepon_Kantor->AdvancedSearch->SearchValue = @$filter["x_Telepon_Kantor"];
        $this->Telepon_Kantor->AdvancedSearch->SearchOperator = @$filter["z_Telepon_Kantor"];
        $this->Telepon_Kantor->AdvancedSearch->SearchCondition = @$filter["v_Telepon_Kantor"];
        $this->Telepon_Kantor->AdvancedSearch->SearchValue2 = @$filter["y_Telepon_Kantor"];
        $this->Telepon_Kantor->AdvancedSearch->SearchOperator2 = @$filter["w_Telepon_Kantor"];
        $this->Telepon_Kantor->AdvancedSearch->save();

        // Field Email
        $this->_Email->AdvancedSearch->SearchValue = @$filter["x__Email"];
        $this->_Email->AdvancedSearch->SearchOperator = @$filter["z__Email"];
        $this->_Email->AdvancedSearch->SearchCondition = @$filter["v__Email"];
        $this->_Email->AdvancedSearch->SearchValue2 = @$filter["y__Email"];
        $this->_Email->AdvancedSearch->SearchOperator2 = @$filter["w__Email"];
        $this->_Email->AdvancedSearch->save();

        // Field Website
        $this->Website->AdvancedSearch->SearchValue = @$filter["x_Website"];
        $this->Website->AdvancedSearch->SearchOperator = @$filter["z_Website"];
        $this->Website->AdvancedSearch->SearchCondition = @$filter["v_Website"];
        $this->Website->AdvancedSearch->SearchValue2 = @$filter["y_Website"];
        $this->Website->AdvancedSearch->SearchOperator2 = @$filter["w_Website"];
        $this->Website->AdvancedSearch->save();

        // Field Alamat_Kantor
        $this->Alamat_Kantor->AdvancedSearch->SearchValue = @$filter["x_Alamat_Kantor"];
        $this->Alamat_Kantor->AdvancedSearch->SearchOperator = @$filter["z_Alamat_Kantor"];
        $this->Alamat_Kantor->AdvancedSearch->SearchCondition = @$filter["v_Alamat_Kantor"];
        $this->Alamat_Kantor->AdvancedSearch->SearchValue2 = @$filter["y_Alamat_Kantor"];
        $this->Alamat_Kantor->AdvancedSearch->SearchOperator2 = @$filter["w_Alamat_Kantor"];
        $this->Alamat_Kantor->AdvancedSearch->save();

        // Field Provinsi2
        $this->Provinsi2->AdvancedSearch->SearchValue = @$filter["x_Provinsi2"];
        $this->Provinsi2->AdvancedSearch->SearchOperator = @$filter["z_Provinsi2"];
        $this->Provinsi2->AdvancedSearch->SearchCondition = @$filter["v_Provinsi2"];
        $this->Provinsi2->AdvancedSearch->SearchValue2 = @$filter["y_Provinsi2"];
        $this->Provinsi2->AdvancedSearch->SearchOperator2 = @$filter["w_Provinsi2"];
        $this->Provinsi2->AdvancedSearch->save();

        // Field Kabupaten_Kota2
        $this->Kabupaten_Kota2->AdvancedSearch->SearchValue = @$filter["x_Kabupaten_Kota2"];
        $this->Kabupaten_Kota2->AdvancedSearch->SearchOperator = @$filter["z_Kabupaten_Kota2"];
        $this->Kabupaten_Kota2->AdvancedSearch->SearchCondition = @$filter["v_Kabupaten_Kota2"];
        $this->Kabupaten_Kota2->AdvancedSearch->SearchValue2 = @$filter["y_Kabupaten_Kota2"];
        $this->Kabupaten_Kota2->AdvancedSearch->SearchOperator2 = @$filter["w_Kabupaten_Kota2"];
        $this->Kabupaten_Kota2->AdvancedSearch->save();

        // Field ID_Sosial_Media
        $this->ID_Sosial_Media->AdvancedSearch->SearchValue = @$filter["x_ID_Sosial_Media"];
        $this->ID_Sosial_Media->AdvancedSearch->SearchOperator = @$filter["z_ID_Sosial_Media"];
        $this->ID_Sosial_Media->AdvancedSearch->SearchCondition = @$filter["v_ID_Sosial_Media"];
        $this->ID_Sosial_Media->AdvancedSearch->SearchValue2 = @$filter["y_ID_Sosial_Media"];
        $this->ID_Sosial_Media->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Sosial_Media"];
        $this->ID_Sosial_Media->AdvancedSearch->save();

        // Field Kategori_perusahaan
        $this->Kategori_perusahaan->AdvancedSearch->SearchValue = @$filter["x_Kategori_perusahaan"];
        $this->Kategori_perusahaan->AdvancedSearch->SearchOperator = @$filter["z_Kategori_perusahaan"];
        $this->Kategori_perusahaan->AdvancedSearch->SearchCondition = @$filter["v_Kategori_perusahaan"];
        $this->Kategori_perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_Kategori_perusahaan"];
        $this->Kategori_perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_Kategori_perusahaan"];
        $this->Kategori_perusahaan->AdvancedSearch->save();

        // Field Jenis_Usaha
        $this->Jenis_Usaha->AdvancedSearch->SearchValue = @$filter["x_Jenis_Usaha"];
        $this->Jenis_Usaha->AdvancedSearch->SearchOperator = @$filter["z_Jenis_Usaha"];
        $this->Jenis_Usaha->AdvancedSearch->SearchCondition = @$filter["v_Jenis_Usaha"];
        $this->Jenis_Usaha->AdvancedSearch->SearchValue2 = @$filter["y_Jenis_Usaha"];
        $this->Jenis_Usaha->AdvancedSearch->SearchOperator2 = @$filter["w_Jenis_Usaha"];
        $this->Jenis_Usaha->AdvancedSearch->save();

        // Field Skala_Perusahaan
        $this->Skala_Perusahaan->AdvancedSearch->SearchValue = @$filter["x_Skala_Perusahaan"];
        $this->Skala_Perusahaan->AdvancedSearch->SearchOperator = @$filter["z_Skala_Perusahaan"];
        $this->Skala_Perusahaan->AdvancedSearch->SearchCondition = @$filter["v_Skala_Perusahaan"];
        $this->Skala_Perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_Skala_Perusahaan"];
        $this->Skala_Perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_Skala_Perusahaan"];
        $this->Skala_Perusahaan->AdvancedSearch->save();

        // Field Kategori_Produk
        $this->Kategori_Produk->AdvancedSearch->SearchValue = @$filter["x_Kategori_Produk"];
        $this->Kategori_Produk->AdvancedSearch->SearchOperator = @$filter["z_Kategori_Produk"];
        $this->Kategori_Produk->AdvancedSearch->SearchCondition = @$filter["v_Kategori_Produk"];
        $this->Kategori_Produk->AdvancedSearch->SearchValue2 = @$filter["y_Kategori_Produk"];
        $this->Kategori_Produk->AdvancedSearch->SearchOperator2 = @$filter["w_Kategori_Produk"];
        $this->Kategori_Produk->AdvancedSearch->save();

        // Field Produk_Perusahaan
        $this->Produk_Perusahaan->AdvancedSearch->SearchValue = @$filter["x_Produk_Perusahaan"];
        $this->Produk_Perusahaan->AdvancedSearch->SearchOperator = @$filter["z_Produk_Perusahaan"];
        $this->Produk_Perusahaan->AdvancedSearch->SearchCondition = @$filter["v_Produk_Perusahaan"];
        $this->Produk_Perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_Produk_Perusahaan"];
        $this->Produk_Perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_Produk_Perusahaan"];
        $this->Produk_Perusahaan->AdvancedSearch->save();

        // Field HS_Code_Product
        $this->HS_Code_Product->AdvancedSearch->SearchValue = @$filter["x_HS_Code_Product"];
        $this->HS_Code_Product->AdvancedSearch->SearchOperator = @$filter["z_HS_Code_Product"];
        $this->HS_Code_Product->AdvancedSearch->SearchCondition = @$filter["v_HS_Code_Product"];
        $this->HS_Code_Product->AdvancedSearch->SearchValue2 = @$filter["y_HS_Code_Product"];
        $this->HS_Code_Product->AdvancedSearch->SearchOperator2 = @$filter["w_HS_Code_Product"];
        $this->HS_Code_Product->AdvancedSearch->save();

        // Field Omset_Perusahaan
        $this->Omset_Perusahaan->AdvancedSearch->SearchValue = @$filter["x_Omset_Perusahaan"];
        $this->Omset_Perusahaan->AdvancedSearch->SearchOperator = @$filter["z_Omset_Perusahaan"];
        $this->Omset_Perusahaan->AdvancedSearch->SearchCondition = @$filter["v_Omset_Perusahaan"];
        $this->Omset_Perusahaan->AdvancedSearch->SearchValue2 = @$filter["y_Omset_Perusahaan"];
        $this->Omset_Perusahaan->AdvancedSearch->SearchOperator2 = @$filter["w_Omset_Perusahaan"];
        $this->Omset_Perusahaan->AdvancedSearch->save();

        // Field Kapasitas_Produksi
        $this->Kapasitas_Produksi->AdvancedSearch->SearchValue = @$filter["x_Kapasitas_Produksi"];
        $this->Kapasitas_Produksi->AdvancedSearch->SearchOperator = @$filter["z_Kapasitas_Produksi"];
        $this->Kapasitas_Produksi->AdvancedSearch->SearchCondition = @$filter["v_Kapasitas_Produksi"];
        $this->Kapasitas_Produksi->AdvancedSearch->SearchValue2 = @$filter["y_Kapasitas_Produksi"];
        $this->Kapasitas_Produksi->AdvancedSearch->SearchOperator2 = @$filter["w_Kapasitas_Produksi"];
        $this->Kapasitas_Produksi->AdvancedSearch->save();

        // Field Pengalaman_Ekspor
        $this->Pengalaman_Ekspor->AdvancedSearch->SearchValue = @$filter["x_Pengalaman_Ekspor"];
        $this->Pengalaman_Ekspor->AdvancedSearch->SearchOperator = @$filter["z_Pengalaman_Ekspor"];
        $this->Pengalaman_Ekspor->AdvancedSearch->SearchCondition = @$filter["v_Pengalaman_Ekspor"];
        $this->Pengalaman_Ekspor->AdvancedSearch->SearchValue2 = @$filter["y_Pengalaman_Ekspor"];
        $this->Pengalaman_Ekspor->AdvancedSearch->SearchOperator2 = @$filter["w_Pengalaman_Ekspor"];
        $this->Pengalaman_Ekspor->AdvancedSearch->save();

        // Field ekspor_ke_negara_mana
        $this->ekspor_ke_negara_mana->AdvancedSearch->SearchValue = @$filter["x_ekspor_ke_negara_mana"];
        $this->ekspor_ke_negara_mana->AdvancedSearch->SearchOperator = @$filter["z_ekspor_ke_negara_mana"];
        $this->ekspor_ke_negara_mana->AdvancedSearch->SearchCondition = @$filter["v_ekspor_ke_negara_mana"];
        $this->ekspor_ke_negara_mana->AdvancedSearch->SearchValue2 = @$filter["y_ekspor_ke_negara_mana"];
        $this->ekspor_ke_negara_mana->AdvancedSearch->SearchOperator2 = @$filter["w_ekspor_ke_negara_mana"];
        $this->ekspor_ke_negara_mana->AdvancedSearch->save();

        // Field mengikuti_pelatihan_sebelumnya
        $this->mengikuti_pelatihan_sebelumnya->AdvancedSearch->SearchValue = @$filter["x_mengikuti_pelatihan_sebelumnya"];
        $this->mengikuti_pelatihan_sebelumnya->AdvancedSearch->SearchOperator = @$filter["z_mengikuti_pelatihan_sebelumnya"];
        $this->mengikuti_pelatihan_sebelumnya->AdvancedSearch->SearchCondition = @$filter["v_mengikuti_pelatihan_sebelumnya"];
        $this->mengikuti_pelatihan_sebelumnya->AdvancedSearch->SearchValue2 = @$filter["y_mengikuti_pelatihan_sebelumnya"];
        $this->mengikuti_pelatihan_sebelumnya->AdvancedSearch->SearchOperator2 = @$filter["w_mengikuti_pelatihan_sebelumnya"];
        $this->mengikuti_pelatihan_sebelumnya->AdvancedSearch->save();

        // Field pelatihan_apa_dimana
        $this->pelatihan_apa_dimana->AdvancedSearch->SearchValue = @$filter["x_pelatihan_apa_dimana"];
        $this->pelatihan_apa_dimana->AdvancedSearch->SearchOperator = @$filter["z_pelatihan_apa_dimana"];
        $this->pelatihan_apa_dimana->AdvancedSearch->SearchCondition = @$filter["v_pelatihan_apa_dimana"];
        $this->pelatihan_apa_dimana->AdvancedSearch->SearchValue2 = @$filter["y_pelatihan_apa_dimana"];
        $this->pelatihan_apa_dimana->AdvancedSearch->SearchOperator2 = @$filter["w_pelatihan_apa_dimana"];
        $this->pelatihan_apa_dimana->AdvancedSearch->save();

        // Field mendapatkan_informasi
        $this->mendapatkan_informasi->AdvancedSearch->SearchValue = @$filter["x_mendapatkan_informasi"];
        $this->mendapatkan_informasi->AdvancedSearch->SearchOperator = @$filter["z_mendapatkan_informasi"];
        $this->mendapatkan_informasi->AdvancedSearch->SearchCondition = @$filter["v_mendapatkan_informasi"];
        $this->mendapatkan_informasi->AdvancedSearch->SearchValue2 = @$filter["y_mendapatkan_informasi"];
        $this->mendapatkan_informasi->AdvancedSearch->SearchOperator2 = @$filter["w_mendapatkan_informasi"];
        $this->mendapatkan_informasi->AdvancedSearch->save();

        // Field harapkan_dari_pelatihan
        $this->harapkan_dari_pelatihan->AdvancedSearch->SearchValue = @$filter["x_harapkan_dari_pelatihan"];
        $this->harapkan_dari_pelatihan->AdvancedSearch->SearchOperator = @$filter["z_harapkan_dari_pelatihan"];
        $this->harapkan_dari_pelatihan->AdvancedSearch->SearchCondition = @$filter["v_harapkan_dari_pelatihan"];
        $this->harapkan_dari_pelatihan->AdvancedSearch->SearchValue2 = @$filter["y_harapkan_dari_pelatihan"];
        $this->harapkan_dari_pelatihan->AdvancedSearch->SearchOperator2 = @$filter["w_harapkan_dari_pelatihan"];
        $this->harapkan_dari_pelatihan->AdvancedSearch->save();

        // Field data_diisi_benar
        $this->data_diisi_benar->AdvancedSearch->SearchValue = @$filter["x_data_diisi_benar"];
        $this->data_diisi_benar->AdvancedSearch->SearchOperator = @$filter["z_data_diisi_benar"];
        $this->data_diisi_benar->AdvancedSearch->SearchCondition = @$filter["v_data_diisi_benar"];
        $this->data_diisi_benar->AdvancedSearch->SearchValue2 = @$filter["y_data_diisi_benar"];
        $this->data_diisi_benar->AdvancedSearch->SearchOperator2 = @$filter["w_data_diisi_benar"];
        $this->data_diisi_benar->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->kdpelat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Email_Address, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Nama_Lengkap, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Nomor_Handphone, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Jenis_Kelamin, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Tempat_Lahir, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Tanggal_Lahir, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Alamat_Tinggal, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Provinsi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Kabupaten_Kota, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Jabatan_di_Perusahaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Pendidikan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Nama_Perusahaan_Instansi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Contact_Person_Perusahaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Telepon_Kantor, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->_Email, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Website, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Alamat_Kantor, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Provinsi2, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Kabupaten_Kota2, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ID_Sosial_Media, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Kategori_perusahaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Jenis_Usaha, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Skala_Perusahaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Kategori_Produk, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Produk_Perusahaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->HS_Code_Product, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Omset_Perusahaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Kapasitas_Produksi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->Pengalaman_Ekspor, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ekspor_ke_negara_mana, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->mengikuti_pelatihan_sebelumnya, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->pelatihan_apa_dimana, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->mendapatkan_informasi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->harapkan_dari_pelatihan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->data_diisi_benar, $arKeywords, $type);
        return $where;
    }

    // Build basic search SQL
    protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
    {
        $defCond = ($type == "OR") ? "OR" : "AND";
        $arSql = []; // Array for SQL parts
        $arCond = []; // Array for search conditions
        $cnt = count($arKeywords);
        $j = 0; // Number of SQL parts
        for ($i = 0; $i < $cnt; $i++) {
            $keyword = $arKeywords[$i];
            $keyword = trim($keyword);
            if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
                $keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
                $ar = explode("\\", $keyword);
            } else {
                $ar = [$keyword];
            }
            foreach ($ar as $keyword) {
                if ($keyword != "") {
                    $wrk = "";
                    if ($keyword == "OR" && $type == "") {
                        if ($j > 0) {
                            $arCond[$j - 1] = "OR";
                        }
                    } elseif ($keyword == Config("NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NULL";
                    } elseif ($keyword == Config("NOT_NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NOT NULL";
                    } elseif ($fld->IsVirtual && $fld->Visible) {
                        $wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    } elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
                        $wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    }
                    if ($wrk != "") {
                        $arSql[$j] = $wrk;
                        $arCond[$j] = $defCond;
                        $j += 1;
                    }
                }
            }
        }
        $cnt = count($arSql);
        $quoted = false;
        $sql = "";
        if ($cnt > 0) {
            for ($i = 0; $i < $cnt - 1; $i++) {
                if ($arCond[$i] == "OR") {
                    if (!$quoted) {
                        $sql .= "(";
                    }
                    $quoted = true;
                }
                $sql .= $arSql[$i];
                if ($quoted && $arCond[$i] != "OR") {
                    $sql .= ")";
                    $quoted = false;
                }
                $sql .= " " . $arCond[$i] . " ";
            }
            $sql .= $arSql[$cnt - 1];
            if ($quoted) {
                $sql .= ")";
            }
        }
        if ($sql != "") {
            if ($where != "") {
                $where .= " OR ";
            }
            $where .= "(" . $sql . ")";
        }
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        $searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            // Search keyword in any fields
            if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
                foreach ($ar as $keyword) {
                    if ($keyword != "") {
                        if ($searchStr != "") {
                            $searchStr .= " " . $searchType . " ";
                        }
                        $searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
                    }
                }
            } else {
                $searchStr = $this->basicSearchSql($ar, $searchType);
            }
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->dipindahkan); // dipindahkan
            $this->updateSort($this->kdpelat); // kdpelat
            $this->updateSort($this->Email_Address); // Email_Address
            $this->updateSort($this->Nama_Lengkap); // Nama_Lengkap
            $this->updateSort($this->Nomor_Handphone); // Nomor_Handphone
            $this->updateSort($this->Jenis_Kelamin); // Jenis_Kelamin
            $this->updateSort($this->Tempat_Lahir); // Tempat_Lahir
            $this->updateSort($this->Tanggal_Lahir); // Tanggal_Lahir
            $this->updateSort($this->Alamat_Tinggal); // Alamat_Tinggal
            $this->updateSort($this->Provinsi); // Provinsi
            $this->updateSort($this->Kabupaten_Kota); // Kabupaten_Kota
            $this->updateSort($this->Jabatan_di_Perusahaan); // Jabatan_di_Perusahaan
            $this->updateSort($this->Pendidikan); // Pendidikan
            $this->updateSort($this->Nama_Perusahaan_Instansi); // Nama_Perusahaan_Instansi
            $this->updateSort($this->Contact_Person_Perusahaan); // Contact_Person_Perusahaan
            $this->updateSort($this->Telepon_Kantor); // Telepon_Kantor
            $this->updateSort($this->_Email); // Email
            $this->updateSort($this->Website); // Website
            $this->updateSort($this->Alamat_Kantor); // Alamat_Kantor
            $this->updateSort($this->Provinsi2); // Provinsi2
            $this->updateSort($this->Kabupaten_Kota2); // Kabupaten_Kota2
            $this->updateSort($this->ID_Sosial_Media); // ID_Sosial_Media
            $this->updateSort($this->Kategori_perusahaan); // Kategori_perusahaan
            $this->updateSort($this->Jenis_Usaha); // Jenis_Usaha
            $this->updateSort($this->Skala_Perusahaan); // Skala_Perusahaan
            $this->updateSort($this->Kategori_Produk); // Kategori_Produk
            $this->updateSort($this->Produk_Perusahaan); // Produk_Perusahaan
            $this->updateSort($this->HS_Code_Product); // HS_Code_Product
            $this->updateSort($this->Omset_Perusahaan); // Omset_Perusahaan
            $this->updateSort($this->Kapasitas_Produksi); // Kapasitas_Produksi
            $this->updateSort($this->ekspor_ke_negara_mana); // ekspor_ke_negara_mana
            $this->updateSort($this->mengikuti_pelatihan_sebelumnya); // mengikuti_pelatihan_sebelumnya
            $this->updateSort($this->pelatihan_apa_dimana); // pelatihan_apa_dimana
            $this->updateSort($this->mendapatkan_informasi); // mendapatkan_informasi
            $this->updateSort($this->harapkan_dari_pelatihan); // harapkan_dari_pelatihan
            $this->updateSort($this->data_diisi_benar); // data_diisi_benar
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($useDefaultSort) {
                    $orderBy = $this->getSqlOrderBy();
                    $this->setSessionOrderBy($orderBy);
                } else {
                    $this->setSessionOrderBy("");
                }
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
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->dipindahkan->setSort("");
                $this->id->setSort("");
                $this->kdpelat->setSort("");
                $this->Email_Address->setSort("");
                $this->Nama_Lengkap->setSort("");
                $this->Nomor_Handphone->setSort("");
                $this->Jenis_Kelamin->setSort("");
                $this->Tempat_Lahir->setSort("");
                $this->Tanggal_Lahir->setSort("");
                $this->Alamat_Tinggal->setSort("");
                $this->Provinsi->setSort("");
                $this->Kabupaten_Kota->setSort("");
                $this->Jabatan_di_Perusahaan->setSort("");
                $this->Pendidikan->setSort("");
                $this->Nama_Perusahaan_Instansi->setSort("");
                $this->Contact_Person_Perusahaan->setSort("");
                $this->Telepon_Kantor->setSort("");
                $this->_Email->setSort("");
                $this->Website->setSort("");
                $this->Alamat_Kantor->setSort("");
                $this->Provinsi2->setSort("");
                $this->Kabupaten_Kota2->setSort("");
                $this->ID_Sosial_Media->setSort("");
                $this->Kategori_perusahaan->setSort("");
                $this->Jenis_Usaha->setSort("");
                $this->Skala_Perusahaan->setSort("");
                $this->Kategori_Produk->setSort("");
                $this->Produk_Perusahaan->setSort("");
                $this->HS_Code_Product->setSort("");
                $this->Omset_Perusahaan->setSort("");
                $this->Kapasitas_Produksi->setSort("");
                $this->Pengalaman_Ekspor->setSort("");
                $this->ekspor_ke_negara_mana->setSort("");
                $this->mengikuti_pelatihan_sebelumnya->setSort("");
                $this->pelatihan_apa_dimana->setSort("");
                $this->mendapatkan_informasi->setSort("");
                $this->harapkan_dari_pelatihan->setSort("");
                $this->data_diisi_benar->setSort("");
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

        // Add group option item
        $item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
        $item->Body = "";
        $item->OnLeft = true;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = true;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = true;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = true;
        $item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
        $item->moveTo(0);
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl();
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView()) {
                if (IsMobile()) {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
                } else {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"data_master\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->ViewUrl)) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
                }
            } else {
                $opt->Body = "";
            }
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
                    $action = $listaction->Action;
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a></li>";
                    if (count($links) == 1) { // Single button
                        $body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a>";
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
                $opt->Visible = true;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["action"];

        // Set up options default
        foreach ($options as $option) {
            $option->UseDropDownButton = false;
            $option->UseButtonGroup = true;
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->add($option->GroupOptionName);
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fdata_masterlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fdata_masterlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fdata_masterlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn, \PDO::FETCH_ASSOC);
            $this->CurrentAction = $userAction;

            // Call row action event
            if ($rs) {
                $conn->beginTransaction();
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    $conn->commit(); // Commit the changes
                    if ($this->getSuccessMessage() == "" && !ob_get_length()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    $conn->rollback(); // Rollback changes

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            $this->CurrentAction = ""; // Clear action
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Set up list options (extended codes)
    protected function setupListOptionsExt()
    {
    }

    // Render list options (extended codes)
    protected function renderListOptionsExt()
    {
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $stmt = $sql->execute();
        $rs = new Recordset($stmt, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
            return;
        }
        $this->dipindahkan->setDbValue($row['dipindahkan']);
        $this->id->setDbValue($row['id']);
        $this->kdpelat->setDbValue($row['kdpelat']);
        $this->Email_Address->setDbValue($row['Email_Address']);
        $this->Nama_Lengkap->setDbValue($row['Nama_Lengkap']);
        $this->Nomor_Handphone->setDbValue($row['Nomor_Handphone']);
        $this->Jenis_Kelamin->setDbValue($row['Jenis_Kelamin']);
        $this->Tempat_Lahir->setDbValue($row['Tempat_Lahir']);
        $this->Tanggal_Lahir->setDbValue($row['Tanggal_Lahir']);
        $this->Alamat_Tinggal->setDbValue($row['Alamat_Tinggal']);
        $this->Provinsi->setDbValue($row['Provinsi']);
        $this->Kabupaten_Kota->setDbValue($row['Kabupaten_Kota']);
        $this->Jabatan_di_Perusahaan->setDbValue($row['Jabatan_di_Perusahaan']);
        $this->Pendidikan->setDbValue($row['Pendidikan']);
        $this->Nama_Perusahaan_Instansi->setDbValue($row['Nama_Perusahaan_Instansi']);
        $this->Contact_Person_Perusahaan->setDbValue($row['Contact_Person_Perusahaan']);
        $this->Telepon_Kantor->setDbValue($row['Telepon_Kantor']);
        $this->_Email->setDbValue($row['Email']);
        $this->Website->setDbValue($row['Website']);
        $this->Alamat_Kantor->setDbValue($row['Alamat_Kantor']);
        $this->Provinsi2->setDbValue($row['Provinsi2']);
        $this->Kabupaten_Kota2->setDbValue($row['Kabupaten_Kota2']);
        $this->ID_Sosial_Media->setDbValue($row['ID_Sosial_Media']);
        $this->Kategori_perusahaan->setDbValue($row['Kategori_perusahaan']);
        $this->Jenis_Usaha->setDbValue($row['Jenis_Usaha']);
        $this->Skala_Perusahaan->setDbValue($row['Skala_Perusahaan']);
        $this->Kategori_Produk->setDbValue($row['Kategori_Produk']);
        $this->Produk_Perusahaan->setDbValue($row['Produk_Perusahaan']);
        $this->HS_Code_Product->setDbValue($row['HS_Code_Product']);
        $this->Omset_Perusahaan->setDbValue($row['Omset_Perusahaan']);
        $this->Kapasitas_Produksi->setDbValue($row['Kapasitas_Produksi']);
        $this->Pengalaman_Ekspor->setDbValue($row['Pengalaman_Ekspor']);
        $this->ekspor_ke_negara_mana->setDbValue($row['ekspor_ke_negara_mana']);
        $this->mengikuti_pelatihan_sebelumnya->setDbValue($row['mengikuti_pelatihan_sebelumnya']);
        $this->pelatihan_apa_dimana->setDbValue($row['pelatihan_apa_dimana']);
        $this->mendapatkan_informasi->setDbValue($row['mendapatkan_informasi']);
        $this->harapkan_dari_pelatihan->setDbValue($row['harapkan_dari_pelatihan']);
        $this->data_diisi_benar->setDbValue($row['data_diisi_benar']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['dipindahkan'] = null;
        $row['id'] = null;
        $row['kdpelat'] = null;
        $row['Email_Address'] = null;
        $row['Nama_Lengkap'] = null;
        $row['Nomor_Handphone'] = null;
        $row['Jenis_Kelamin'] = null;
        $row['Tempat_Lahir'] = null;
        $row['Tanggal_Lahir'] = null;
        $row['Alamat_Tinggal'] = null;
        $row['Provinsi'] = null;
        $row['Kabupaten_Kota'] = null;
        $row['Jabatan_di_Perusahaan'] = null;
        $row['Pendidikan'] = null;
        $row['Nama_Perusahaan_Instansi'] = null;
        $row['Contact_Person_Perusahaan'] = null;
        $row['Telepon_Kantor'] = null;
        $row['Email'] = null;
        $row['Website'] = null;
        $row['Alamat_Kantor'] = null;
        $row['Provinsi2'] = null;
        $row['Kabupaten_Kota2'] = null;
        $row['ID_Sosial_Media'] = null;
        $row['Kategori_perusahaan'] = null;
        $row['Jenis_Usaha'] = null;
        $row['Skala_Perusahaan'] = null;
        $row['Kategori_Produk'] = null;
        $row['Produk_Perusahaan'] = null;
        $row['HS_Code_Product'] = null;
        $row['Omset_Perusahaan'] = null;
        $row['Kapasitas_Produksi'] = null;
        $row['Pengalaman_Ekspor'] = null;
        $row['ekspor_ke_negara_mana'] = null;
        $row['mengikuti_pelatihan_sebelumnya'] = null;
        $row['pelatihan_apa_dimana'] = null;
        $row['mendapatkan_informasi'] = null;
        $row['harapkan_dari_pelatihan'] = null;
        $row['data_diisi_benar'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
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
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // dipindahkan

        // id

        // kdpelat

        // Email_Address

        // Nama_Lengkap

        // Nomor_Handphone

        // Jenis_Kelamin

        // Tempat_Lahir

        // Tanggal_Lahir

        // Alamat_Tinggal

        // Provinsi

        // Kabupaten_Kota

        // Jabatan_di_Perusahaan

        // Pendidikan

        // Nama_Perusahaan_Instansi

        // Contact_Person_Perusahaan

        // Telepon_Kantor

        // Email

        // Website

        // Alamat_Kantor

        // Provinsi2

        // Kabupaten_Kota2

        // ID_Sosial_Media

        // Kategori_perusahaan

        // Jenis_Usaha

        // Skala_Perusahaan

        // Kategori_Produk

        // Produk_Perusahaan

        // HS_Code_Product

        // Omset_Perusahaan

        // Kapasitas_Produksi

        // Pengalaman_Ekspor

        // ekspor_ke_negara_mana

        // mengikuti_pelatihan_sebelumnya

        // pelatihan_apa_dimana

        // mendapatkan_informasi

        // harapkan_dari_pelatihan

        // data_diisi_benar
        if ($this->RowType == ROWTYPE_VIEW) {
            // dipindahkan
            if (ConvertToBool($this->dipindahkan->CurrentValue)) {
                $this->dipindahkan->ViewValue = $this->dipindahkan->tagCaption(1) != "" ? $this->dipindahkan->tagCaption(1) : "Yes";
            } else {
                $this->dipindahkan->ViewValue = $this->dipindahkan->tagCaption(2) != "" ? $this->dipindahkan->tagCaption(2) : "No";
            }
            $this->dipindahkan->ViewCustomAttributes = "";

            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // kdpelat
            $this->kdpelat->ViewValue = $this->kdpelat->CurrentValue;
            $this->kdpelat->ViewCustomAttributes = "";

            // Email_Address
            $this->Email_Address->ViewValue = $this->Email_Address->CurrentValue;
            $this->Email_Address->ViewCustomAttributes = "";

            // Nama_Lengkap
            $this->Nama_Lengkap->ViewValue = $this->Nama_Lengkap->CurrentValue;
            $this->Nama_Lengkap->ViewCustomAttributes = "";

            // Nomor_Handphone
            $this->Nomor_Handphone->ViewValue = $this->Nomor_Handphone->CurrentValue;
            $this->Nomor_Handphone->ViewCustomAttributes = "";

            // Jenis_Kelamin
            $this->Jenis_Kelamin->ViewValue = $this->Jenis_Kelamin->CurrentValue;
            $this->Jenis_Kelamin->ViewCustomAttributes = "";

            // Tempat_Lahir
            $this->Tempat_Lahir->ViewValue = $this->Tempat_Lahir->CurrentValue;
            $this->Tempat_Lahir->ViewCustomAttributes = "";

            // Tanggal_Lahir
            $this->Tanggal_Lahir->ViewValue = $this->Tanggal_Lahir->CurrentValue;
            $this->Tanggal_Lahir->ViewCustomAttributes = "";

            // Alamat_Tinggal
            $this->Alamat_Tinggal->ViewValue = $this->Alamat_Tinggal->CurrentValue;
            $this->Alamat_Tinggal->ViewCustomAttributes = "";

            // Provinsi
            $this->Provinsi->ViewValue = $this->Provinsi->CurrentValue;
            $this->Provinsi->ViewCustomAttributes = "";

            // Kabupaten_Kota
            $this->Kabupaten_Kota->ViewValue = $this->Kabupaten_Kota->CurrentValue;
            $this->Kabupaten_Kota->ViewCustomAttributes = "";

            // Jabatan_di_Perusahaan
            $this->Jabatan_di_Perusahaan->ViewValue = $this->Jabatan_di_Perusahaan->CurrentValue;
            $this->Jabatan_di_Perusahaan->ViewCustomAttributes = "";

            // Pendidikan
            $this->Pendidikan->ViewValue = $this->Pendidikan->CurrentValue;
            $this->Pendidikan->ViewCustomAttributes = "";

            // Nama_Perusahaan_Instansi
            $this->Nama_Perusahaan_Instansi->ViewValue = $this->Nama_Perusahaan_Instansi->CurrentValue;
            $this->Nama_Perusahaan_Instansi->ViewCustomAttributes = "";

            // Contact_Person_Perusahaan
            $this->Contact_Person_Perusahaan->ViewValue = $this->Contact_Person_Perusahaan->CurrentValue;
            $this->Contact_Person_Perusahaan->ViewCustomAttributes = "";

            // Telepon_Kantor
            $this->Telepon_Kantor->ViewValue = $this->Telepon_Kantor->CurrentValue;
            $this->Telepon_Kantor->ViewCustomAttributes = "";

            // Email
            $this->_Email->ViewValue = $this->_Email->CurrentValue;
            $this->_Email->ViewCustomAttributes = "";

            // Website
            $this->Website->ViewValue = $this->Website->CurrentValue;
            $this->Website->ViewCustomAttributes = "";

            // Alamat_Kantor
            $this->Alamat_Kantor->ViewValue = $this->Alamat_Kantor->CurrentValue;
            $this->Alamat_Kantor->ViewCustomAttributes = "";

            // Provinsi2
            $this->Provinsi2->ViewValue = $this->Provinsi2->CurrentValue;
            $this->Provinsi2->ViewCustomAttributes = "";

            // Kabupaten_Kota2
            $this->Kabupaten_Kota2->ViewValue = $this->Kabupaten_Kota2->CurrentValue;
            $this->Kabupaten_Kota2->ViewCustomAttributes = "";

            // ID_Sosial_Media
            $this->ID_Sosial_Media->ViewValue = $this->ID_Sosial_Media->CurrentValue;
            $this->ID_Sosial_Media->ViewCustomAttributes = "";

            // Kategori_perusahaan
            $this->Kategori_perusahaan->ViewValue = $this->Kategori_perusahaan->CurrentValue;
            $this->Kategori_perusahaan->ViewCustomAttributes = "";

            // Jenis_Usaha
            $this->Jenis_Usaha->ViewValue = $this->Jenis_Usaha->CurrentValue;
            $this->Jenis_Usaha->ViewCustomAttributes = "";

            // Skala_Perusahaan
            $this->Skala_Perusahaan->ViewValue = $this->Skala_Perusahaan->CurrentValue;
            $this->Skala_Perusahaan->ViewCustomAttributes = "";

            // Kategori_Produk
            $this->Kategori_Produk->ViewValue = $this->Kategori_Produk->CurrentValue;
            $this->Kategori_Produk->ViewCustomAttributes = "";

            // Produk_Perusahaan
            $this->Produk_Perusahaan->ViewValue = $this->Produk_Perusahaan->CurrentValue;
            $this->Produk_Perusahaan->ViewCustomAttributes = "";

            // HS_Code_Product
            $this->HS_Code_Product->ViewValue = $this->HS_Code_Product->CurrentValue;
            $this->HS_Code_Product->ViewCustomAttributes = "";

            // Omset_Perusahaan
            $this->Omset_Perusahaan->ViewValue = $this->Omset_Perusahaan->CurrentValue;
            $this->Omset_Perusahaan->ViewCustomAttributes = "";

            // Kapasitas_Produksi
            $this->Kapasitas_Produksi->ViewValue = $this->Kapasitas_Produksi->CurrentValue;
            $this->Kapasitas_Produksi->ViewCustomAttributes = "";

            // ekspor_ke_negara_mana
            $this->ekspor_ke_negara_mana->ViewValue = $this->ekspor_ke_negara_mana->CurrentValue;
            $this->ekspor_ke_negara_mana->ViewCustomAttributes = "";

            // mengikuti_pelatihan_sebelumnya
            $this->mengikuti_pelatihan_sebelumnya->ViewValue = $this->mengikuti_pelatihan_sebelumnya->CurrentValue;
            $this->mengikuti_pelatihan_sebelumnya->ViewCustomAttributes = "";

            // pelatihan_apa_dimana
            $this->pelatihan_apa_dimana->ViewValue = $this->pelatihan_apa_dimana->CurrentValue;
            $this->pelatihan_apa_dimana->ViewCustomAttributes = "";

            // mendapatkan_informasi
            $this->mendapatkan_informasi->ViewValue = $this->mendapatkan_informasi->CurrentValue;
            $this->mendapatkan_informasi->ViewCustomAttributes = "";

            // harapkan_dari_pelatihan
            $this->harapkan_dari_pelatihan->ViewValue = $this->harapkan_dari_pelatihan->CurrentValue;
            $this->harapkan_dari_pelatihan->ViewCustomAttributes = "";

            // data_diisi_benar
            $this->data_diisi_benar->ViewValue = $this->data_diisi_benar->CurrentValue;
            $this->data_diisi_benar->ViewCustomAttributes = "";

            // dipindahkan
            $this->dipindahkan->LinkCustomAttributes = "";
            $this->dipindahkan->HrefValue = "";
            $this->dipindahkan->TooltipValue = "";

            // kdpelat
            $this->kdpelat->LinkCustomAttributes = "";
            $this->kdpelat->HrefValue = "";
            $this->kdpelat->TooltipValue = "";
            if (!$this->isExport()) {
                $this->kdpelat->ViewValue = $this->highlightValue($this->kdpelat);
            }

            // Email_Address
            $this->Email_Address->LinkCustomAttributes = "";
            $this->Email_Address->HrefValue = "";
            $this->Email_Address->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Email_Address->ViewValue = $this->highlightValue($this->Email_Address);
            }

            // Nama_Lengkap
            $this->Nama_Lengkap->LinkCustomAttributes = "";
            $this->Nama_Lengkap->HrefValue = "";
            $this->Nama_Lengkap->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Nama_Lengkap->ViewValue = $this->highlightValue($this->Nama_Lengkap);
            }

            // Nomor_Handphone
            $this->Nomor_Handphone->LinkCustomAttributes = "";
            $this->Nomor_Handphone->HrefValue = "";
            $this->Nomor_Handphone->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Nomor_Handphone->ViewValue = $this->highlightValue($this->Nomor_Handphone);
            }

            // Jenis_Kelamin
            $this->Jenis_Kelamin->LinkCustomAttributes = "";
            $this->Jenis_Kelamin->HrefValue = "";
            $this->Jenis_Kelamin->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Jenis_Kelamin->ViewValue = $this->highlightValue($this->Jenis_Kelamin);
            }

            // Tempat_Lahir
            $this->Tempat_Lahir->LinkCustomAttributes = "";
            $this->Tempat_Lahir->HrefValue = "";
            $this->Tempat_Lahir->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Tempat_Lahir->ViewValue = $this->highlightValue($this->Tempat_Lahir);
            }

            // Tanggal_Lahir
            $this->Tanggal_Lahir->LinkCustomAttributes = "";
            $this->Tanggal_Lahir->HrefValue = "";
            $this->Tanggal_Lahir->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Tanggal_Lahir->ViewValue = $this->highlightValue($this->Tanggal_Lahir);
            }

            // Alamat_Tinggal
            $this->Alamat_Tinggal->LinkCustomAttributes = "";
            $this->Alamat_Tinggal->HrefValue = "";
            $this->Alamat_Tinggal->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Alamat_Tinggal->ViewValue = $this->highlightValue($this->Alamat_Tinggal);
            }

            // Provinsi
            $this->Provinsi->LinkCustomAttributes = "";
            $this->Provinsi->HrefValue = "";
            $this->Provinsi->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Provinsi->ViewValue = $this->highlightValue($this->Provinsi);
            }

            // Kabupaten_Kota
            $this->Kabupaten_Kota->LinkCustomAttributes = "";
            $this->Kabupaten_Kota->HrefValue = "";
            $this->Kabupaten_Kota->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Kabupaten_Kota->ViewValue = $this->highlightValue($this->Kabupaten_Kota);
            }

            // Jabatan_di_Perusahaan
            $this->Jabatan_di_Perusahaan->LinkCustomAttributes = "";
            $this->Jabatan_di_Perusahaan->HrefValue = "";
            $this->Jabatan_di_Perusahaan->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Jabatan_di_Perusahaan->ViewValue = $this->highlightValue($this->Jabatan_di_Perusahaan);
            }

            // Pendidikan
            $this->Pendidikan->LinkCustomAttributes = "";
            $this->Pendidikan->HrefValue = "";
            $this->Pendidikan->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Pendidikan->ViewValue = $this->highlightValue($this->Pendidikan);
            }

            // Nama_Perusahaan_Instansi
            $this->Nama_Perusahaan_Instansi->LinkCustomAttributes = "";
            $this->Nama_Perusahaan_Instansi->HrefValue = "";
            $this->Nama_Perusahaan_Instansi->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Nama_Perusahaan_Instansi->ViewValue = $this->highlightValue($this->Nama_Perusahaan_Instansi);
            }

            // Contact_Person_Perusahaan
            $this->Contact_Person_Perusahaan->LinkCustomAttributes = "";
            $this->Contact_Person_Perusahaan->HrefValue = "";
            $this->Contact_Person_Perusahaan->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Contact_Person_Perusahaan->ViewValue = $this->highlightValue($this->Contact_Person_Perusahaan);
            }

            // Telepon_Kantor
            $this->Telepon_Kantor->LinkCustomAttributes = "";
            $this->Telepon_Kantor->HrefValue = "";
            $this->Telepon_Kantor->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Telepon_Kantor->ViewValue = $this->highlightValue($this->Telepon_Kantor);
            }

            // Email
            $this->_Email->LinkCustomAttributes = "";
            $this->_Email->HrefValue = "";
            $this->_Email->TooltipValue = "";
            if (!$this->isExport()) {
                $this->_Email->ViewValue = $this->highlightValue($this->_Email);
            }

            // Website
            $this->Website->LinkCustomAttributes = "";
            $this->Website->HrefValue = "";
            $this->Website->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Website->ViewValue = $this->highlightValue($this->Website);
            }

            // Alamat_Kantor
            $this->Alamat_Kantor->LinkCustomAttributes = "";
            $this->Alamat_Kantor->HrefValue = "";
            $this->Alamat_Kantor->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Alamat_Kantor->ViewValue = $this->highlightValue($this->Alamat_Kantor);
            }

            // Provinsi2
            $this->Provinsi2->LinkCustomAttributes = "";
            $this->Provinsi2->HrefValue = "";
            $this->Provinsi2->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Provinsi2->ViewValue = $this->highlightValue($this->Provinsi2);
            }

            // Kabupaten_Kota2
            $this->Kabupaten_Kota2->LinkCustomAttributes = "";
            $this->Kabupaten_Kota2->HrefValue = "";
            $this->Kabupaten_Kota2->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Kabupaten_Kota2->ViewValue = $this->highlightValue($this->Kabupaten_Kota2);
            }

            // ID_Sosial_Media
            $this->ID_Sosial_Media->LinkCustomAttributes = "";
            $this->ID_Sosial_Media->HrefValue = "";
            $this->ID_Sosial_Media->TooltipValue = "";
            if (!$this->isExport()) {
                $this->ID_Sosial_Media->ViewValue = $this->highlightValue($this->ID_Sosial_Media);
            }

            // Kategori_perusahaan
            $this->Kategori_perusahaan->LinkCustomAttributes = "";
            $this->Kategori_perusahaan->HrefValue = "";
            $this->Kategori_perusahaan->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Kategori_perusahaan->ViewValue = $this->highlightValue($this->Kategori_perusahaan);
            }

            // Jenis_Usaha
            $this->Jenis_Usaha->LinkCustomAttributes = "";
            $this->Jenis_Usaha->HrefValue = "";
            $this->Jenis_Usaha->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Jenis_Usaha->ViewValue = $this->highlightValue($this->Jenis_Usaha);
            }

            // Skala_Perusahaan
            $this->Skala_Perusahaan->LinkCustomAttributes = "";
            $this->Skala_Perusahaan->HrefValue = "";
            $this->Skala_Perusahaan->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Skala_Perusahaan->ViewValue = $this->highlightValue($this->Skala_Perusahaan);
            }

            // Kategori_Produk
            $this->Kategori_Produk->LinkCustomAttributes = "";
            $this->Kategori_Produk->HrefValue = "";
            $this->Kategori_Produk->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Kategori_Produk->ViewValue = $this->highlightValue($this->Kategori_Produk);
            }

            // Produk_Perusahaan
            $this->Produk_Perusahaan->LinkCustomAttributes = "";
            $this->Produk_Perusahaan->HrefValue = "";
            $this->Produk_Perusahaan->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Produk_Perusahaan->ViewValue = $this->highlightValue($this->Produk_Perusahaan);
            }

            // HS_Code_Product
            $this->HS_Code_Product->LinkCustomAttributes = "";
            $this->HS_Code_Product->HrefValue = "";
            $this->HS_Code_Product->TooltipValue = "";
            if (!$this->isExport()) {
                $this->HS_Code_Product->ViewValue = $this->highlightValue($this->HS_Code_Product);
            }

            // Omset_Perusahaan
            $this->Omset_Perusahaan->LinkCustomAttributes = "";
            $this->Omset_Perusahaan->HrefValue = "";
            $this->Omset_Perusahaan->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Omset_Perusahaan->ViewValue = $this->highlightValue($this->Omset_Perusahaan);
            }

            // Kapasitas_Produksi
            $this->Kapasitas_Produksi->LinkCustomAttributes = "";
            $this->Kapasitas_Produksi->HrefValue = "";
            $this->Kapasitas_Produksi->TooltipValue = "";
            if (!$this->isExport()) {
                $this->Kapasitas_Produksi->ViewValue = $this->highlightValue($this->Kapasitas_Produksi);
            }

            // ekspor_ke_negara_mana
            $this->ekspor_ke_negara_mana->LinkCustomAttributes = "";
            $this->ekspor_ke_negara_mana->HrefValue = "";
            $this->ekspor_ke_negara_mana->TooltipValue = "";
            if (!$this->isExport()) {
                $this->ekspor_ke_negara_mana->ViewValue = $this->highlightValue($this->ekspor_ke_negara_mana);
            }

            // mengikuti_pelatihan_sebelumnya
            $this->mengikuti_pelatihan_sebelumnya->LinkCustomAttributes = "";
            $this->mengikuti_pelatihan_sebelumnya->HrefValue = "";
            $this->mengikuti_pelatihan_sebelumnya->TooltipValue = "";
            if (!$this->isExport()) {
                $this->mengikuti_pelatihan_sebelumnya->ViewValue = $this->highlightValue($this->mengikuti_pelatihan_sebelumnya);
            }

            // pelatihan_apa_dimana
            $this->pelatihan_apa_dimana->LinkCustomAttributes = "";
            $this->pelatihan_apa_dimana->HrefValue = "";
            $this->pelatihan_apa_dimana->TooltipValue = "";
            if (!$this->isExport()) {
                $this->pelatihan_apa_dimana->ViewValue = $this->highlightValue($this->pelatihan_apa_dimana);
            }

            // mendapatkan_informasi
            $this->mendapatkan_informasi->LinkCustomAttributes = "";
            $this->mendapatkan_informasi->HrefValue = "";
            $this->mendapatkan_informasi->TooltipValue = "";
            if (!$this->isExport()) {
                $this->mendapatkan_informasi->ViewValue = $this->highlightValue($this->mendapatkan_informasi);
            }

            // harapkan_dari_pelatihan
            $this->harapkan_dari_pelatihan->LinkCustomAttributes = "";
            $this->harapkan_dari_pelatihan->HrefValue = "";
            $this->harapkan_dari_pelatihan->TooltipValue = "";
            if (!$this->isExport()) {
                $this->harapkan_dari_pelatihan->ViewValue = $this->highlightValue($this->harapkan_dari_pelatihan);
            }

            // data_diisi_benar
            $this->data_diisi_benar->LinkCustomAttributes = "";
            $this->data_diisi_benar->HrefValue = "";
            $this->data_diisi_benar->TooltipValue = "";
            if (!$this->isExport()) {
                $this->data_diisi_benar->ViewValue = $this->highlightValue($this->data_diisi_benar);
            }
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    /**
     * Import file
     *
     * @param string $filetoken File token to locate the uploaded import file
     * @return bool
     */
    public function import($filetoken)
    {
        global $Security, $Language;

        // Check if valid token
        if (EmptyValue($filetoken)) {
            return false;
        }

        // Get uploaded files by token
        $files = GetUploadedFileNames($filetoken);
        $exts = explode(",", Config("IMPORT_FILE_ALLOWED_EXT"));
        $totCnt = 0;
        $totSuccessCnt = 0;
        $totFailCnt = 0;
        $result = [Config("API_FILE_TOKEN_NAME") => $filetoken, "files" => [], "success" => false];

        // Import records
        foreach ($files as $file) {
            $res = [Config("API_FILE_TOKEN_NAME") => $filetoken, "file" => basename($file)];
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            // Ignore log file
            if ($ext == "txt") {
                continue;
            }
            if (!in_array($ext, $exts)) {
                $res = array_merge($res, ["error" => str_replace("%e", $ext, $Language->phrase("ImportMessageInvalidFileExtension"))]);
                WriteJson($res);
                return false;
            }

            // Set up options for Page Importing event

            // Get optional data from $_POST first
            $ar = array_keys($_POST);
            $options = [];
            foreach ($ar as $key) {
                if (!in_array($key, ["action", "filetoken"])) {
                    $options[$key] = $_POST[$key];
                }
            }

            // Merge default options
            $options = array_merge(["maxExecutionTime" => $this->ImportMaxExecutionTime, "file" => $file, "activeSheet" => 0, "headerRowNumber" => 0, "headers" => [], "offset" => 0, "limit" => 0], $options);
            if ($ext == "csv") {
                $options = array_merge(["inputEncoding" => $this->ImportCsvEncoding, "delimiter" => $this->ImportCsvDelimiter, "enclosure" => $this->ImportCsvQuoteCharacter], $options);
            }
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($ext));

            // Call Page Importing server event
            if (!$this->pageImporting($reader, $options)) {
                WriteJson($res);
                return false;
            }

            // Set max execution time
            if ($options["maxExecutionTime"] > 0) {
                ini_set("max_execution_time", $options["maxExecutionTime"]);
            }
            try {
                if ($ext == "csv") {
                    if ($options["inputEncoding"] != '') {
                        $reader->setInputEncoding($options["inputEncoding"]);
                    }
                    if ($options["delimiter"] != '') {
                        $reader->setDelimiter($options["delimiter"]);
                    }
                    if ($options["enclosure"] != '') {
                        $reader->setEnclosure($options["enclosure"]);
                    }
                }
                $spreadsheet = @$reader->load($file);
            } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                $res = array_merge($res, ["error" => $e->getMessage()]);
                WriteJson($res);
                return false;
            }

            // Get active worksheet
            $spreadsheet->setActiveSheetIndex($options["activeSheet"]);
            $worksheet = $spreadsheet->getActiveSheet();

            // Get row and column indexes
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

            // Get column headers
            $headers = $options["headers"];
            $headerRow = 0;
            if (count($headers) == 0) { // Undetermined, load from header row
                $headerRow = $options["headerRowNumber"] + 1;
                $headers = $this->getImportHeaders($worksheet, $headerRow, $highestColumn);
            }
            if (count($headers) == 0) { // Unable to load header
                $res["error"] = $Language->phrase("ImportMessageNoHeaderRow");
                WriteJson($res);
                return false;
            }
            $checkValue = true; // Clear blank header values at end
            $headers = array_reverse(array_reduce(array_reverse($headers), function ($res, $name) use ($checkValue) {
                if (!EmptyValue($name) || !$checkValue) {
                    $res[] = $name;
                    $checkValue = false; // Skip further checking
                }
                return $res;
            }, []));
            foreach ($headers as $name) {
                if (!array_key_exists($name, $this->Fields)) { // Unidentified field, not header row
                    $res["error"] = str_replace('%f', $name, $Language->phrase("ImportMessageInvalidFieldName"));
                    WriteJson($res);
                    return false;
                }
            }
            $startRow = $headerRow + 1;
            $endRow = $highestRow;
            if ($options["offset"] > 0) {
                $startRow += $options["offset"];
            }
            if ($options["limit"] > 0) {
                $endRow = $startRow + $options["limit"] - 1;
                if ($endRow > $highestRow) {
                    $endRow = $highestRow;
                }
            }
            if ($endRow >= $startRow) {
                $records = $this->getImportRecords($worksheet, $startRow, $endRow, $highestColumn);
            } else {
                $records = [];
            }
            $recordCnt = count($records);
            $cnt = 0;
            $successCnt = 0;
            $failCnt = 0;
            $failList = [];
            $relLogFile = IncludeTrailingDelimiter(UploadPath(false) . Config("UPLOAD_TEMP_FOLDER_PREFIX") . $filetoken, false) . $filetoken . ".txt";
            $res = array_merge($res, ["totalCount" => $recordCnt, "count" => $cnt, "successCount" => $successCnt, "failCount" => 0]);

            // Begin transaction
            if ($this->ImportUseTransaction) {
                $conn = $this->getConnection();
                $conn->beginTransaction();
            }

            // Process records
            foreach ($records as $values) {
                $importSuccess = false;
                try {
                    if (count($values) > count($headers)) { // Make sure headers / values count matched
                        array_splice($values, count($headers));
                    }
                    $row = array_combine($headers, $values);
                    $cnt++;
                    $res["count"] = $cnt;
                    if ($this->importRow($row, $cnt)) {
                        $successCnt++;
                        $importSuccess = true;
                    } else {
                        $failCnt++;
                        $failList["row" . $cnt] = $this->getFailureMessage();
                        $this->clearFailureMessage(); // Clear error message
                    }
                } catch (\Throwable $e) {
                    $failCnt++;
                    if ($failList["row" . $cnt] == "") {
                        $failList["row" . $cnt] = $e->getMessage();
                    }
                }

                // Reset count if import fail + use transaction
                if (!$importSuccess && $this->ImportUseTransaction) {
                    $successCnt = 0;
                    $failCnt = $cnt;
                }

                // Save progress to cache
                $res["successCount"] = $successCnt;
                $res["failCount"] = $failCnt;
                SetCache($filetoken, $res);

                // No need to process further if import fail + use transaction
                if (!$importSuccess && $this->ImportUseTransaction) {
                    break;
                }
            }
            $res["failList"] = $failList;

            // Commit/Rollback transaction
            if ($this->ImportUseTransaction) {
                $conn = $this->getConnection();
                if ($failCnt > 0) { // Rollback
                    $conn->rollback();
                } else { // Commit
                    $conn->commit();
                }
            }
            $totCnt += $cnt;
            $totSuccessCnt += $successCnt;
            $totFailCnt += $failCnt;

            // Call Page Imported server event
            $this->pageImported($reader, $res);
            if ($totCnt > 0 && $totFailCnt == 0) { // Clean up if all records imported
                $res["success"] = true;
                $result["success"] = true;
            } else {
                $res["log"] = $relLogFile;
                $result["success"] = false;
            }
            $result["files"][] = $res;
        }
        if ($result["success"]) {
            CleanUploadTempPaths($filetoken);
        }
        WriteJson($result);
        return $result["success"];
    }

    /**
     * Get import header
     *
     * @param object $ws PhpSpreadsheet worksheet
     * @param int $rowIdx Row index for header row (1-based)
     * @param string $endColName End column Name (e.g. "F")
     * @return array
     */
    protected function getImportHeaders($ws, $rowIdx, $endColName)
    {
        $ar = $ws->rangeToArray("A" . $rowIdx . ":" . $endColName . $rowIdx);
        return $ar[0];
    }

    /**
     * Get import records
     *
     * @param object $ws PhpSpreadsheet worksheet
     * @param int $startRowIdx Start row index
     * @param int $endRowIdx End row index
     * @param string $endColName End column Name (e.g. "F")
     * @return array
     */
    protected function getImportRecords($ws, $startRowIdx, $endRowIdx, $endColName)
    {
        $ar = $ws->rangeToArray("A" . $startRowIdx . ":" . $endColName . $endRowIdx);
        return $ar;
    }

    /**
     * Import a row
     *
     * @param array $row
     * @param int $cnt
     * @return bool
     */
    protected function importRow($row, $cnt)
    {
        global $Language;

        // Call Row Import server event
        if (!$this->rowImport($row, $cnt)) {
            return false;
        }

        // Check field values
        foreach ($row as $name => $value) {
            $fld = $this->Fields[$name];
            if (!$this->checkValue($fld, $value)) {
                $this->setFailureMessage(str_replace(["%f", "%v"], [$fld->Name, $value], $Language->phrase("ImportMessageInvalidFieldValue")));
                return false;
            }
        }

        // Insert/Update to database
        if (!$this->ImportInsertOnly && $oldrow = $this->load($row)) {
            $res = $this->update($row, "", $oldrow);
        } else {
            $res = $this->insert($row);
        }
        return $res;
    }

    /**
     * Check field value
     *
     * @param object $fld Field object
     * @param object $value
     * @return bool
     */
    protected function checkValue($fld, $value)
    {
        if ($fld->DataType == DATATYPE_NUMBER && !is_numeric($value)) {
            return false;
        } elseif ($fld->DataType == DATATYPE_DATE && !CheckDate($value)) {
            return false;
        }
        return true;
    }

    // Load row
    protected function load($row)
    {
        $filter = $this->getRecordFilter($row);
        if (!$filter) {
            return null;
        }
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        return $conn->fetchAssoc($sql);
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions("div");
        $this->SearchOptions->TagClassName = "ew-search-option";

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fdata_masterlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Search highlight button
        $item = &$this->SearchOptions->add("searchhighlight");
        $item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fdata_masterlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != "" && $this->TotalRecords > 0);

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
    }

    // Set up import options
    protected function setupImportOptions()
    {
        global $Security, $Language;

        // Import
        $item = &$this->ImportOptions->add("import");
        $item->Body = "<a class=\"ew-import-link ew-import\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("ImportText") . "\" data-caption=\"" . $Language->phrase("ImportText") . "\" onclick=\"return ew.importDialogShow({lnk:this,hdr:ew.language.phrase('ImportText')});\">" . $Language->phrase("Import") . "</a>";
        $item->Visible = $Security->canImport();
        $this->ImportOptions->UseButtonGroup = true;
        $this->ImportOptions->UseDropDownButton = false;
        $this->ImportOptions->DropDownButtonPhrase = $Language->phrase("ButtonImport");

        // Add group option item
        $item = &$this->ImportOptions->add($this->ImportOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_dipindahkan":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
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
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
        if(@$_GET["p"] == 'cleardata'){
        	$myResult = ExecuteUpdate("TRUNCATE TABLE `data_master`");
        } else 	if(@$_GET["p"] == 'insertdata' ) {
        $cekpindah = ExecuteScalar("SELECT COUNT(1) FROM `data_master` WHERE dipindahkan = 0");
        if($cekpindah > 0){
    		//TAMBAH DATA PERUSAHAAN
    		$perusahaan = ExecuteUpdate("INSERT INTO `t_perusahaan`( `namap`, `kontak`, `alamatp`, `kdprop`, `kdkota`, `emailp`, `webp`, `medsos`, `kdproduknafed`, `pproduk`, `kdskala`, `kdjenis`, `kdexport`, `nexport`, `kdkategori`, `omzet_saat_ini`, `kapasitas_saat_ini`, `hscode`, `created_at`, `imp`) SELECT `Nama_Perusahaan_Instansi`, CONCAT(`Contact_Person_Perusahaan`, ' ', `Telepon_Kantor`) Kontak, `Alamat_Kantor`, `Provinsi2`, `Kabupaten_Kota2`, `Email`, `Website`,  `ID_Sosial_Media`, `Kategori_Produk`, `Produk_Perusahaan`, `Skala_Perusahaan`, `Jenis_Usaha`, `Pengalaman_Ekspor`, `ekspor_ke_negara_mana`,`Kategori_perusahaan`, `Omset_Perusahaan`, `Kapasitas_Produksi`,  `HS_Code_Product`, NOW(), 1 'imp' FROM `data_master` WHERE `Nama_Perusahaan_Instansi` IS NOT NULL AND `Nama_Perusahaan_Instansi` != '-' AND `dipindahkan` = 0");

    		//TAMBAH DATA PESERTA
    		$peserta = ExecuteUpdate("INSERT INTO `t_peserta`(`nama`, `idp`, `tempat_lhr`, `tlahir`, `alamat`, `telp`, `email`, `kdprop`, `kdkota`, `kdsex`, `hp`, `kdjabat`, `kdpend`, `harapan`, `kdinformasi`, `created_at`, `imp`) SELECT a.`Nama_Lengkap`, (SELECT b.`idp` FROM `t_perusahaan` b WHERE b.`namap` = a.`Nama_Perusahaan_Instansi` AND `b`.`imp` = 1 LIMIT 1) 'idp', a.`Tempat_Lahir`, a.`Tanggal_Lahir`, a.`Alamat_Tinggal`, a.`Nomor_Handphone`, a.`Email_Address`, a.`Provinsi`, a.`Kabupaten_Kota`, a.`Jenis_Kelamin`, a.`Nomor_Handphone`, a.`Jabatan_di_Perusahaan`, a.`Pendidikan`, a.`harapkan_dari_pelatihan`, a.`mendapatkan_informasi`, NOW(), 1 'imp' FROM `data_master` a WHERE a.`dipindahkan` = 0");

    		//TAMBAH DATA RELASI PELATIHAN PESERTA
    		$pelatihan_peserta = ExecuteUpdate("INSERT INTO `t_pp`(`kdpelat`, `id`, `tahun`, `imp`) SELECT a.`kdpelat`,b.id,SUBSTR(a.`kdpelat`,9,4) 'thn',1 'imp' FROM `data_master` a INNER JOIN `t_peserta` b ON a.Email_Address = b.email WHERE a.`dipindahkan` = 0 AND b.imp = 1");

    		//UBAH STATUS DATA MASTER
    		$statuspindah = ExecuteUpdate("UPDATE `data_master` SET `dipindahkan`= 1 WHERE `dipindahkan` = 0");
    		$this->setSuccessMessage("Data telah berhasil disalin");
        }
        }
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
       if(@$_GET["p"] == 'cleardata'){
       		$url = "datamasterlist";
        	$this->setSuccessMessage("Data telah dikosongkan");
       	}
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
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
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        $header = "";
        $cekpindah = ExecuteScalar("SELECT COUNT(1) FROM `data_master` WHERE dipindahkan = 0");
        if($cekpindah > 0){
            $header .= "<a href='?p=insertdata' class='btn btn-success'>PINDAHKAN DATA</a> ";
        }
        $header .= "<a href='?p=cleardata' class='btn btn-danger'>KOSONGKAN TABEL</a>";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        $row["Nomor_Handphone"] = "+62 ".$row["Nomor_Handphone"];
        $row["Email"] = strtolower($row["Email"]);
        $row["Website"] = strtolower($row["Website"]);
        $row["Jenis_Kelamin"] = ExecuteScalar("SELECT kdsex FROM `t_sex` WHERE sex ='" . AdjustSql($row["Jenis_Kelamin"]) . "'");
        $row["mendapatkan_informasi"] = ExecuteScalar("SELECT kdinformasi FROM `t_informasi` WHERE informasi LIKE '%" . AdjustSql($row["mendapatkan_informasi"]) . "%'");
        $tl = explode("/",$row["Tanggal_Lahir"]);
        $row["Tanggal_Lahir"] = $tl[2]."-".$tl[0]."-".$tl[1];
        $row["Provinsi"] = ExecuteScalar("SELECT kdprop FROM `t_prop` WHERE prop ='" . AdjustSql($row["Provinsi"]) . "'");
        $row["Provinsi2"] = ExecuteScalar("SELECT kdprop FROM `t_prop` WHERE prop ='" . AdjustSql($row["Provinsi2"]) . "'");
         $row["Kabupaten_Kota"] = ExecuteScalar("SELECT kdkota FROM `t_kota` WHERE kota LIKE '%" . AdjustSql($row["Kabupaten_Kota"]) . "%'");
        $row["Kabupaten_Kota2"] = ExecuteScalar("SELECT kdkota FROM `t_kota` WHERE kota LIKE '%" . AdjustSql($row["Kabupaten_Kota2"]) . "%'");
        $row["Jabatan_di_Perusahaan"] = ExecuteScalar("SELECT kdjabat FROM `t_jabatan` WHERE jabatan ='" . AdjustSql($row["Jabatan_di_Perusahaan"]) . "'");
        if( $row["Pendidikan"] == "SMU/Sederajat"){
        	$row["Pendidikan"] = "SLTA";
        }
        $row["Pendidikan"] = ExecuteScalar("SELECT kdpend FROM `t_pendidikan` WHERE pendidikan LIKE '%" . AdjustSql($row["Pendidikan"]) . "%'");
        $row["Kategori_perusahaan"] = ExecuteScalar("SELECT kdkategori FROM `t_kategori` WHERE kategori ='" . AdjustSql($row["Kategori_perusahaan"]) . "'");
        $row["Jenis_Usaha"] = ExecuteScalar("SELECT kdjenis FROM `t_jenis` WHERE jenis ='" . AdjustSql($row["Jenis_Usaha"]) . "'");
        $row["Skala_Perusahaan"] = ExecuteScalar("SELECT kdskala FROM `t_skala` WHERE skala ='" . AdjustSql($row["Skala_Perusahaan"]) . "'");
        $row["Kategori_Produk"] = ExecuteScalar("SELECT kdproduknafed FROM `t_produknafed` WHERE produknafed LIKE '%" . AdjustSql($row["Kategori_Produk"]) . "%'");
        $row["Pengalaman_Ekspor"] = ExecuteScalar("SELECT kdexport FROM `t_export` WHERE export ='" . AdjustSql($row["Pengalaman_Ekspor"]) . "'");
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
