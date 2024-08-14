<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PerusahaanList extends Perusahaan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'Perusahaan';

    // Page object name
    public $PageObjName = "PerusahaanList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fPerusahaanlist";
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

        // Table object (Perusahaan)
        if (!isset($GLOBALS["Perusahaan"]) || get_class($GLOBALS["Perusahaan"]) == PROJECT_NAMESPACE . "Perusahaan") {
            $GLOBALS["Perusahaan"] = &$this;
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
        $this->AddUrl = "perusahaanadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "perusahaandelete";
        $this->MultiUpdateUrl = "perusahaanupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'Perusahaan');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fPerusahaanlistsrch";

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
                $doc = new $class(Container("Perusahaan"));
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
        if ($this->isAddOrEdit()) {
            $this->idp->Visible = false;
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
        $this->idp->setVisibility();
        $this->namap->setVisibility();
        $this->kontak->setVisibility();
        $this->alamatp->Visible = false;
        $this->kdprop->setVisibility();
        $this->kdkota->setVisibility();
        $this->emailp->setVisibility();
        $this->webp->setVisibility();
        $this->medsos->setVisibility();
        $this->kdproduknafed->setVisibility();
        $this->pproduk->Visible = false;
        $this->kdskala->setVisibility();
        $this->kdjenis->setVisibility();
        $this->kdexport->setVisibility();
        $this->nexport->Visible = false;
        $this->kdkategori->setVisibility();
        $this->omzet_saat_ini->setVisibility();
        $this->kapasitas_saat_ini->setVisibility();
        $this->hscode->Visible = false;
        $this->created_at->setVisibility();
        $this->imp->setVisibility();
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
        $this->setupLookupOptions($this->kdprop);
        $this->setupLookupOptions($this->kdkota);
        $this->setupLookupOptions($this->kdproduknafed);
        $this->setupLookupOptions($this->kdskala);
        $this->setupLookupOptions($this->kdjenis);
        $this->setupLookupOptions($this->kdexport);
        $this->setupLookupOptions($this->kdkategori);

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
        $filterList = Concat($filterList, $this->idp->AdvancedSearch->toJson(), ","); // Field idp
        $filterList = Concat($filterList, $this->namap->AdvancedSearch->toJson(), ","); // Field namap
        $filterList = Concat($filterList, $this->kontak->AdvancedSearch->toJson(), ","); // Field kontak
        $filterList = Concat($filterList, $this->alamatp->AdvancedSearch->toJson(), ","); // Field alamatp
        $filterList = Concat($filterList, $this->kdprop->AdvancedSearch->toJson(), ","); // Field kdprop
        $filterList = Concat($filterList, $this->kdkota->AdvancedSearch->toJson(), ","); // Field kdkota
        $filterList = Concat($filterList, $this->emailp->AdvancedSearch->toJson(), ","); // Field emailp
        $filterList = Concat($filterList, $this->webp->AdvancedSearch->toJson(), ","); // Field webp
        $filterList = Concat($filterList, $this->medsos->AdvancedSearch->toJson(), ","); // Field medsos
        $filterList = Concat($filterList, $this->kdproduknafed->AdvancedSearch->toJson(), ","); // Field kdproduknafed
        $filterList = Concat($filterList, $this->pproduk->AdvancedSearch->toJson(), ","); // Field pproduk
        $filterList = Concat($filterList, $this->kdskala->AdvancedSearch->toJson(), ","); // Field kdskala
        $filterList = Concat($filterList, $this->kdjenis->AdvancedSearch->toJson(), ","); // Field kdjenis
        $filterList = Concat($filterList, $this->kdexport->AdvancedSearch->toJson(), ","); // Field kdexport
        $filterList = Concat($filterList, $this->nexport->AdvancedSearch->toJson(), ","); // Field nexport
        $filterList = Concat($filterList, $this->kdkategori->AdvancedSearch->toJson(), ","); // Field kdkategori
        $filterList = Concat($filterList, $this->omzet_saat_ini->AdvancedSearch->toJson(), ","); // Field omzet_saat_ini
        $filterList = Concat($filterList, $this->kapasitas_saat_ini->AdvancedSearch->toJson(), ","); // Field kapasitas_saat_ini
        $filterList = Concat($filterList, $this->hscode->AdvancedSearch->toJson(), ","); // Field hscode
        $filterList = Concat($filterList, $this->created_at->AdvancedSearch->toJson(), ","); // Field created_at
        $filterList = Concat($filterList, $this->imp->AdvancedSearch->toJson(), ","); // Field imp
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fPerusahaanlistsrch", $filters);
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

        // Field idp
        $this->idp->AdvancedSearch->SearchValue = @$filter["x_idp"];
        $this->idp->AdvancedSearch->SearchOperator = @$filter["z_idp"];
        $this->idp->AdvancedSearch->SearchCondition = @$filter["v_idp"];
        $this->idp->AdvancedSearch->SearchValue2 = @$filter["y_idp"];
        $this->idp->AdvancedSearch->SearchOperator2 = @$filter["w_idp"];
        $this->idp->AdvancedSearch->save();

        // Field namap
        $this->namap->AdvancedSearch->SearchValue = @$filter["x_namap"];
        $this->namap->AdvancedSearch->SearchOperator = @$filter["z_namap"];
        $this->namap->AdvancedSearch->SearchCondition = @$filter["v_namap"];
        $this->namap->AdvancedSearch->SearchValue2 = @$filter["y_namap"];
        $this->namap->AdvancedSearch->SearchOperator2 = @$filter["w_namap"];
        $this->namap->AdvancedSearch->save();

        // Field kontak
        $this->kontak->AdvancedSearch->SearchValue = @$filter["x_kontak"];
        $this->kontak->AdvancedSearch->SearchOperator = @$filter["z_kontak"];
        $this->kontak->AdvancedSearch->SearchCondition = @$filter["v_kontak"];
        $this->kontak->AdvancedSearch->SearchValue2 = @$filter["y_kontak"];
        $this->kontak->AdvancedSearch->SearchOperator2 = @$filter["w_kontak"];
        $this->kontak->AdvancedSearch->save();

        // Field alamatp
        $this->alamatp->AdvancedSearch->SearchValue = @$filter["x_alamatp"];
        $this->alamatp->AdvancedSearch->SearchOperator = @$filter["z_alamatp"];
        $this->alamatp->AdvancedSearch->SearchCondition = @$filter["v_alamatp"];
        $this->alamatp->AdvancedSearch->SearchValue2 = @$filter["y_alamatp"];
        $this->alamatp->AdvancedSearch->SearchOperator2 = @$filter["w_alamatp"];
        $this->alamatp->AdvancedSearch->save();

        // Field kdprop
        $this->kdprop->AdvancedSearch->SearchValue = @$filter["x_kdprop"];
        $this->kdprop->AdvancedSearch->SearchOperator = @$filter["z_kdprop"];
        $this->kdprop->AdvancedSearch->SearchCondition = @$filter["v_kdprop"];
        $this->kdprop->AdvancedSearch->SearchValue2 = @$filter["y_kdprop"];
        $this->kdprop->AdvancedSearch->SearchOperator2 = @$filter["w_kdprop"];
        $this->kdprop->AdvancedSearch->save();

        // Field kdkota
        $this->kdkota->AdvancedSearch->SearchValue = @$filter["x_kdkota"];
        $this->kdkota->AdvancedSearch->SearchOperator = @$filter["z_kdkota"];
        $this->kdkota->AdvancedSearch->SearchCondition = @$filter["v_kdkota"];
        $this->kdkota->AdvancedSearch->SearchValue2 = @$filter["y_kdkota"];
        $this->kdkota->AdvancedSearch->SearchOperator2 = @$filter["w_kdkota"];
        $this->kdkota->AdvancedSearch->save();

        // Field emailp
        $this->emailp->AdvancedSearch->SearchValue = @$filter["x_emailp"];
        $this->emailp->AdvancedSearch->SearchOperator = @$filter["z_emailp"];
        $this->emailp->AdvancedSearch->SearchCondition = @$filter["v_emailp"];
        $this->emailp->AdvancedSearch->SearchValue2 = @$filter["y_emailp"];
        $this->emailp->AdvancedSearch->SearchOperator2 = @$filter["w_emailp"];
        $this->emailp->AdvancedSearch->save();

        // Field webp
        $this->webp->AdvancedSearch->SearchValue = @$filter["x_webp"];
        $this->webp->AdvancedSearch->SearchOperator = @$filter["z_webp"];
        $this->webp->AdvancedSearch->SearchCondition = @$filter["v_webp"];
        $this->webp->AdvancedSearch->SearchValue2 = @$filter["y_webp"];
        $this->webp->AdvancedSearch->SearchOperator2 = @$filter["w_webp"];
        $this->webp->AdvancedSearch->save();

        // Field medsos
        $this->medsos->AdvancedSearch->SearchValue = @$filter["x_medsos"];
        $this->medsos->AdvancedSearch->SearchOperator = @$filter["z_medsos"];
        $this->medsos->AdvancedSearch->SearchCondition = @$filter["v_medsos"];
        $this->medsos->AdvancedSearch->SearchValue2 = @$filter["y_medsos"];
        $this->medsos->AdvancedSearch->SearchOperator2 = @$filter["w_medsos"];
        $this->medsos->AdvancedSearch->save();

        // Field kdproduknafed
        $this->kdproduknafed->AdvancedSearch->SearchValue = @$filter["x_kdproduknafed"];
        $this->kdproduknafed->AdvancedSearch->SearchOperator = @$filter["z_kdproduknafed"];
        $this->kdproduknafed->AdvancedSearch->SearchCondition = @$filter["v_kdproduknafed"];
        $this->kdproduknafed->AdvancedSearch->SearchValue2 = @$filter["y_kdproduknafed"];
        $this->kdproduknafed->AdvancedSearch->SearchOperator2 = @$filter["w_kdproduknafed"];
        $this->kdproduknafed->AdvancedSearch->save();

        // Field pproduk
        $this->pproduk->AdvancedSearch->SearchValue = @$filter["x_pproduk"];
        $this->pproduk->AdvancedSearch->SearchOperator = @$filter["z_pproduk"];
        $this->pproduk->AdvancedSearch->SearchCondition = @$filter["v_pproduk"];
        $this->pproduk->AdvancedSearch->SearchValue2 = @$filter["y_pproduk"];
        $this->pproduk->AdvancedSearch->SearchOperator2 = @$filter["w_pproduk"];
        $this->pproduk->AdvancedSearch->save();

        // Field kdskala
        $this->kdskala->AdvancedSearch->SearchValue = @$filter["x_kdskala"];
        $this->kdskala->AdvancedSearch->SearchOperator = @$filter["z_kdskala"];
        $this->kdskala->AdvancedSearch->SearchCondition = @$filter["v_kdskala"];
        $this->kdskala->AdvancedSearch->SearchValue2 = @$filter["y_kdskala"];
        $this->kdskala->AdvancedSearch->SearchOperator2 = @$filter["w_kdskala"];
        $this->kdskala->AdvancedSearch->save();

        // Field kdjenis
        $this->kdjenis->AdvancedSearch->SearchValue = @$filter["x_kdjenis"];
        $this->kdjenis->AdvancedSearch->SearchOperator = @$filter["z_kdjenis"];
        $this->kdjenis->AdvancedSearch->SearchCondition = @$filter["v_kdjenis"];
        $this->kdjenis->AdvancedSearch->SearchValue2 = @$filter["y_kdjenis"];
        $this->kdjenis->AdvancedSearch->SearchOperator2 = @$filter["w_kdjenis"];
        $this->kdjenis->AdvancedSearch->save();

        // Field kdexport
        $this->kdexport->AdvancedSearch->SearchValue = @$filter["x_kdexport"];
        $this->kdexport->AdvancedSearch->SearchOperator = @$filter["z_kdexport"];
        $this->kdexport->AdvancedSearch->SearchCondition = @$filter["v_kdexport"];
        $this->kdexport->AdvancedSearch->SearchValue2 = @$filter["y_kdexport"];
        $this->kdexport->AdvancedSearch->SearchOperator2 = @$filter["w_kdexport"];
        $this->kdexport->AdvancedSearch->save();

        // Field nexport
        $this->nexport->AdvancedSearch->SearchValue = @$filter["x_nexport"];
        $this->nexport->AdvancedSearch->SearchOperator = @$filter["z_nexport"];
        $this->nexport->AdvancedSearch->SearchCondition = @$filter["v_nexport"];
        $this->nexport->AdvancedSearch->SearchValue2 = @$filter["y_nexport"];
        $this->nexport->AdvancedSearch->SearchOperator2 = @$filter["w_nexport"];
        $this->nexport->AdvancedSearch->save();

        // Field kdkategori
        $this->kdkategori->AdvancedSearch->SearchValue = @$filter["x_kdkategori"];
        $this->kdkategori->AdvancedSearch->SearchOperator = @$filter["z_kdkategori"];
        $this->kdkategori->AdvancedSearch->SearchCondition = @$filter["v_kdkategori"];
        $this->kdkategori->AdvancedSearch->SearchValue2 = @$filter["y_kdkategori"];
        $this->kdkategori->AdvancedSearch->SearchOperator2 = @$filter["w_kdkategori"];
        $this->kdkategori->AdvancedSearch->save();

        // Field omzet_saat_ini
        $this->omzet_saat_ini->AdvancedSearch->SearchValue = @$filter["x_omzet_saat_ini"];
        $this->omzet_saat_ini->AdvancedSearch->SearchOperator = @$filter["z_omzet_saat_ini"];
        $this->omzet_saat_ini->AdvancedSearch->SearchCondition = @$filter["v_omzet_saat_ini"];
        $this->omzet_saat_ini->AdvancedSearch->SearchValue2 = @$filter["y_omzet_saat_ini"];
        $this->omzet_saat_ini->AdvancedSearch->SearchOperator2 = @$filter["w_omzet_saat_ini"];
        $this->omzet_saat_ini->AdvancedSearch->save();

        // Field kapasitas_saat_ini
        $this->kapasitas_saat_ini->AdvancedSearch->SearchValue = @$filter["x_kapasitas_saat_ini"];
        $this->kapasitas_saat_ini->AdvancedSearch->SearchOperator = @$filter["z_kapasitas_saat_ini"];
        $this->kapasitas_saat_ini->AdvancedSearch->SearchCondition = @$filter["v_kapasitas_saat_ini"];
        $this->kapasitas_saat_ini->AdvancedSearch->SearchValue2 = @$filter["y_kapasitas_saat_ini"];
        $this->kapasitas_saat_ini->AdvancedSearch->SearchOperator2 = @$filter["w_kapasitas_saat_ini"];
        $this->kapasitas_saat_ini->AdvancedSearch->save();

        // Field hscode
        $this->hscode->AdvancedSearch->SearchValue = @$filter["x_hscode"];
        $this->hscode->AdvancedSearch->SearchOperator = @$filter["z_hscode"];
        $this->hscode->AdvancedSearch->SearchCondition = @$filter["v_hscode"];
        $this->hscode->AdvancedSearch->SearchValue2 = @$filter["y_hscode"];
        $this->hscode->AdvancedSearch->SearchOperator2 = @$filter["w_hscode"];
        $this->hscode->AdvancedSearch->save();

        // Field created_at
        $this->created_at->AdvancedSearch->SearchValue = @$filter["x_created_at"];
        $this->created_at->AdvancedSearch->SearchOperator = @$filter["z_created_at"];
        $this->created_at->AdvancedSearch->SearchCondition = @$filter["v_created_at"];
        $this->created_at->AdvancedSearch->SearchValue2 = @$filter["y_created_at"];
        $this->created_at->AdvancedSearch->SearchOperator2 = @$filter["w_created_at"];
        $this->created_at->AdvancedSearch->save();

        // Field imp
        $this->imp->AdvancedSearch->SearchValue = @$filter["x_imp"];
        $this->imp->AdvancedSearch->SearchOperator = @$filter["z_imp"];
        $this->imp->AdvancedSearch->SearchCondition = @$filter["v_imp"];
        $this->imp->AdvancedSearch->SearchValue2 = @$filter["y_imp"];
        $this->imp->AdvancedSearch->SearchOperator2 = @$filter["w_imp"];
        $this->imp->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->namap, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kontak, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->alamatp, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->emailp, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->webp, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->medsos, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kdproduknafed, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->pproduk, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nexport, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->omzet_saat_ini, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kapasitas_saat_ini, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->hscode, $arKeywords, $type);
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
            $this->updateSort($this->idp); // idp
            $this->updateSort($this->namap); // namap
            $this->updateSort($this->kontak); // kontak
            $this->updateSort($this->kdprop); // kdprop
            $this->updateSort($this->kdkota); // kdkota
            $this->updateSort($this->emailp); // emailp
            $this->updateSort($this->webp); // webp
            $this->updateSort($this->medsos); // medsos
            $this->updateSort($this->kdproduknafed); // kdproduknafed
            $this->updateSort($this->kdskala); // kdskala
            $this->updateSort($this->kdjenis); // kdjenis
            $this->updateSort($this->kdexport); // kdexport
            $this->updateSort($this->kdkategori); // kdkategori
            $this->updateSort($this->omzet_saat_ini); // omzet_saat_ini
            $this->updateSort($this->kapasitas_saat_ini); // kapasitas_saat_ini
            $this->updateSort($this->created_at); // created_at
            $this->updateSort($this->imp); // imp
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
                $this->idp->setSort("");
                $this->namap->setSort("");
                $this->kontak->setSort("");
                $this->alamatp->setSort("");
                $this->kdprop->setSort("");
                $this->kdkota->setSort("");
                $this->emailp->setSort("");
                $this->webp->setSort("");
                $this->medsos->setSort("");
                $this->kdproduknafed->setSort("");
                $this->pproduk->setSort("");
                $this->kdskala->setSort("");
                $this->kdjenis->setSort("");
                $this->kdexport->setSort("");
                $this->nexport->setSort("");
                $this->kdkategori->setSort("");
                $this->omzet_saat_ini->setSort("");
                $this->kapasitas_saat_ini->setSort("");
                $this->hscode->setSort("");
                $this->created_at->setSort("");
                $this->imp->setSort("");
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
        if ($this->CurrentMode == "view") { // View mode
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
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fPerusahaanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fPerusahaanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fPerusahaanlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
        $this->idp->setDbValue($row['idp']);
        $this->namap->setDbValue($row['namap']);
        $this->kontak->setDbValue($row['kontak']);
        $this->alamatp->setDbValue($row['alamatp']);
        $this->kdprop->setDbValue($row['kdprop']);
        $this->kdkota->setDbValue($row['kdkota']);
        $this->emailp->setDbValue($row['emailp']);
        $this->webp->setDbValue($row['webp']);
        $this->medsos->setDbValue($row['medsos']);
        $this->kdproduknafed->setDbValue($row['kdproduknafed']);
        $this->pproduk->setDbValue($row['pproduk']);
        $this->kdskala->setDbValue($row['kdskala']);
        $this->kdjenis->setDbValue($row['kdjenis']);
        $this->kdexport->setDbValue($row['kdexport']);
        $this->nexport->setDbValue($row['nexport']);
        $this->kdkategori->setDbValue($row['kdkategori']);
        $this->omzet_saat_ini->setDbValue($row['omzet_saat_ini']);
        $this->kapasitas_saat_ini->setDbValue($row['kapasitas_saat_ini']);
        $this->hscode->setDbValue($row['hscode']);
        $this->created_at->setDbValue($row['created_at']);
        $this->imp->setDbValue($row['imp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['idp'] = null;
        $row['namap'] = null;
        $row['kontak'] = null;
        $row['alamatp'] = null;
        $row['kdprop'] = null;
        $row['kdkota'] = null;
        $row['emailp'] = null;
        $row['webp'] = null;
        $row['medsos'] = null;
        $row['kdproduknafed'] = null;
        $row['pproduk'] = null;
        $row['kdskala'] = null;
        $row['kdjenis'] = null;
        $row['kdexport'] = null;
        $row['nexport'] = null;
        $row['kdkategori'] = null;
        $row['omzet_saat_ini'] = null;
        $row['kapasitas_saat_ini'] = null;
        $row['hscode'] = null;
        $row['created_at'] = null;
        $row['imp'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        return false;
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

        // idp

        // namap

        // kontak

        // alamatp

        // kdprop

        // kdkota

        // emailp

        // webp

        // medsos

        // kdproduknafed

        // pproduk

        // kdskala

        // kdjenis

        // kdexport

        // nexport

        // kdkategori

        // omzet_saat_ini

        // kapasitas_saat_ini

        // hscode

        // created_at

        // imp
        if ($this->RowType == ROWTYPE_VIEW) {
            // idp
            $this->idp->ViewValue = $this->idp->CurrentValue;
            $this->idp->ViewCustomAttributes = "";

            // namap
            $this->namap->ViewValue = $this->namap->CurrentValue;
            $this->namap->ViewCustomAttributes = "";

            // kontak
            $this->kontak->ViewValue = $this->kontak->CurrentValue;
            $this->kontak->ViewCustomAttributes = "";

            // kdprop
            $curVal = trim(strval($this->kdprop->CurrentValue));
            if ($curVal != "") {
                $this->kdprop->ViewValue = $this->kdprop->lookupCacheOption($curVal);
                if ($this->kdprop->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kdprop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kdprop->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kdprop->Lookup->renderViewRow($rswrk[0]);
                        $this->kdprop->ViewValue = $this->kdprop->displayValue($arwrk);
                    } else {
                        $this->kdprop->ViewValue = $this->kdprop->CurrentValue;
                    }
                }
            } else {
                $this->kdprop->ViewValue = null;
            }
            $this->kdprop->ViewCustomAttributes = "";

            // kdkota
            $curVal = trim(strval($this->kdkota->CurrentValue));
            if ($curVal != "") {
                $this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
                if ($this->kdkota->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kdkota->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kdkota->Lookup->renderViewRow($rswrk[0]);
                        $this->kdkota->ViewValue = $this->kdkota->displayValue($arwrk);
                    } else {
                        $this->kdkota->ViewValue = $this->kdkota->CurrentValue;
                    }
                }
            } else {
                $this->kdkota->ViewValue = null;
            }
            $this->kdkota->ViewCustomAttributes = "";

            // emailp
            $this->emailp->ViewValue = $this->emailp->CurrentValue;
            $this->emailp->ViewCustomAttributes = "";

            // webp
            $this->webp->ViewValue = $this->webp->CurrentValue;
            $this->webp->ViewCustomAttributes = "";

            // medsos
            $this->medsos->ViewValue = $this->medsos->CurrentValue;
            $this->medsos->ViewCustomAttributes = "";

            // kdproduknafed
            $this->kdproduknafed->ViewValue = $this->kdproduknafed->CurrentValue;
            $curVal = trim(strval($this->kdproduknafed->CurrentValue));
            if ($curVal != "") {
                $this->kdproduknafed->ViewValue = $this->kdproduknafed->lookupCacheOption($curVal);
                if ($this->kdproduknafed->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kdproduknafed->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kdproduknafed->Lookup->renderViewRow($rswrk[0]);
                        $this->kdproduknafed->ViewValue = $this->kdproduknafed->displayValue($arwrk);
                    } else {
                        $this->kdproduknafed->ViewValue = $this->kdproduknafed->CurrentValue;
                    }
                }
            } else {
                $this->kdproduknafed->ViewValue = null;
            }
            $this->kdproduknafed->ViewCustomAttributes = "";

            // kdskala
            $curVal = trim(strval($this->kdskala->CurrentValue));
            if ($curVal != "") {
                $this->kdskala->ViewValue = $this->kdskala->lookupCacheOption($curVal);
                if ($this->kdskala->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kdskala`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kdskala->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kdskala->Lookup->renderViewRow($rswrk[0]);
                        $this->kdskala->ViewValue = $this->kdskala->displayValue($arwrk);
                    } else {
                        $this->kdskala->ViewValue = $this->kdskala->CurrentValue;
                    }
                }
            } else {
                $this->kdskala->ViewValue = null;
            }
            $this->kdskala->ViewCustomAttributes = "";

            // kdjenis
            $curVal = trim(strval($this->kdjenis->CurrentValue));
            if ($curVal != "") {
                $this->kdjenis->ViewValue = $this->kdjenis->lookupCacheOption($curVal);
                if ($this->kdjenis->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kdjenis`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kdjenis->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kdjenis->Lookup->renderViewRow($rswrk[0]);
                        $this->kdjenis->ViewValue = $this->kdjenis->displayValue($arwrk);
                    } else {
                        $this->kdjenis->ViewValue = $this->kdjenis->CurrentValue;
                    }
                }
            } else {
                $this->kdjenis->ViewValue = null;
            }
            $this->kdjenis->ViewCustomAttributes = "";

            // kdexport
            $curVal = trim(strval($this->kdexport->CurrentValue));
            if ($curVal != "") {
                $this->kdexport->ViewValue = $this->kdexport->lookupCacheOption($curVal);
                if ($this->kdexport->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kdexport`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kdexport->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kdexport->Lookup->renderViewRow($rswrk[0]);
                        $this->kdexport->ViewValue = $this->kdexport->displayValue($arwrk);
                    } else {
                        $this->kdexport->ViewValue = $this->kdexport->CurrentValue;
                    }
                }
            } else {
                $this->kdexport->ViewValue = null;
            }
            $this->kdexport->ViewCustomAttributes = "";

            // kdkategori
            $this->kdkategori->ViewValue = $this->kdkategori->CurrentValue;
            $curVal = trim(strval($this->kdkategori->CurrentValue));
            if ($curVal != "") {
                $this->kdkategori->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
                if ($this->kdkategori->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kdkategori`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kdkategori->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kdkategori->Lookup->renderViewRow($rswrk[0]);
                        $this->kdkategori->ViewValue = $this->kdkategori->displayValue($arwrk);
                    } else {
                        $this->kdkategori->ViewValue = $this->kdkategori->CurrentValue;
                    }
                }
            } else {
                $this->kdkategori->ViewValue = null;
            }
            $this->kdkategori->ViewCustomAttributes = "";

            // omzet_saat_ini
            $this->omzet_saat_ini->ViewValue = $this->omzet_saat_ini->CurrentValue;
            $this->omzet_saat_ini->ViewCustomAttributes = "";

            // kapasitas_saat_ini
            $this->kapasitas_saat_ini->ViewValue = $this->kapasitas_saat_ini->CurrentValue;
            $this->kapasitas_saat_ini->ViewCustomAttributes = "";

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
            $this->created_at->ViewCustomAttributes = "";

            // imp
            $this->imp->ViewValue = $this->imp->CurrentValue;
            $this->imp->ViewValue = FormatNumber($this->imp->ViewValue, 0, -2, -2, -2);
            $this->imp->ViewCustomAttributes = "";

            // idp
            $this->idp->LinkCustomAttributes = "";
            $this->idp->HrefValue = "";
            $this->idp->TooltipValue = "";

            // namap
            $this->namap->LinkCustomAttributes = "";
            $this->namap->HrefValue = "";
            $this->namap->TooltipValue = "";

            // kontak
            $this->kontak->LinkCustomAttributes = "";
            $this->kontak->HrefValue = "";
            $this->kontak->TooltipValue = "";

            // kdprop
            $this->kdprop->LinkCustomAttributes = "";
            $this->kdprop->HrefValue = "";
            $this->kdprop->TooltipValue = "";

            // kdkota
            $this->kdkota->LinkCustomAttributes = "";
            $this->kdkota->HrefValue = "";
            $this->kdkota->TooltipValue = "";

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

            // kdproduknafed
            $this->kdproduknafed->LinkCustomAttributes = "";
            $this->kdproduknafed->HrefValue = "";
            $this->kdproduknafed->TooltipValue = "";

            // kdskala
            $this->kdskala->LinkCustomAttributes = "";
            $this->kdskala->HrefValue = "";
            $this->kdskala->TooltipValue = "";

            // kdjenis
            $this->kdjenis->LinkCustomAttributes = "";
            $this->kdjenis->HrefValue = "";
            $this->kdjenis->TooltipValue = "";

            // kdexport
            $this->kdexport->LinkCustomAttributes = "";
            $this->kdexport->HrefValue = "";
            $this->kdexport->TooltipValue = "";

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

            // created_at
            $this->created_at->LinkCustomAttributes = "";
            $this->created_at->HrefValue = "";
            $this->created_at->TooltipValue = "";

            // imp
            $this->imp->LinkCustomAttributes = "";
            $this->imp->HrefValue = "";
            $this->imp->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fPerusahaanlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

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
                case "x_kdprop":
                    break;
                case "x_kdkota":
                    break;
                case "x_kdproduknafed":
                    break;
                case "x_kdskala":
                    break;
                case "x_kdjenis":
                    break;
                case "x_kdexport":
                    break;
                case "x_kdkategori":
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
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
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
        //$header = "your header";
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
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
