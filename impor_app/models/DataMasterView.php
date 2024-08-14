<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class DataMasterView extends DataMaster
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'data_master';

    // Page object name
    public $PageObjName = "DataMasterView";

    // Rendering View
    public $RenderingView = false;

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
        if (($keyValue = Get("id") ?? Route("id")) !== null) {
            $this->RecKey["id"] = $keyValue;
        }
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";

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

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "datamasterview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
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
    public $ExportOptions; // Export options
    public $OtherOptions; // Other options
    public $DisplayRecords = 1;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecKey = [];
    public $IsModal = false;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->CurrentAction = Param("action"); // Set up current action
        $this->dipindahkan->setVisibility();
        $this->id->setVisibility();
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
        $this->Pengalaman_Ekspor->setVisibility();
        $this->ekspor_ke_negara_mana->setVisibility();
        $this->mengikuti_pelatihan_sebelumnya->setVisibility();
        $this->pelatihan_apa_dimana->setVisibility();
        $this->mendapatkan_informasi->setVisibility();
        $this->harapkan_dari_pelatihan->setVisibility();
        $this->data_diisi_benar->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }

        // Load current record
        $loadCurrentRecord = false;
        $returnUrl = "";
        $matchRecord = false;
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->RecKey["id"] = $this->id->QueryStringValue;
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->RecKey["id"] = $this->id->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->RecKey["id"] = $this->id->QueryStringValue;
            } else {
                $returnUrl = "datamasterlist"; // Return to list
            }

            // Get action
            $this->CurrentAction = "show"; // Display
            switch ($this->CurrentAction) {
                case "show": // Get a record to display

                    // Load record based on key
                    if (IsApi()) {
                        $filter = $this->getRecordFilter();
                        $this->CurrentFilter = $filter;
                        $sql = $this->getCurrentSql();
                        $conn = $this->getConnection();
                        $this->Recordset = LoadRecordset($sql, $conn);
                        $res = $this->Recordset && !$this->Recordset->EOF;
                    } else {
                        $res = $this->loadRow();
                    }
                    if (!$res) { // Load record based on key
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $returnUrl = "datamasterlist"; // No matching record, return to list
                    }
                    break;
            }
        } else {
            $returnUrl = "datamasterlist"; // Not page request, return to list
        }
        if ($returnUrl != "") {
            $this->terminate($returnUrl);
            return;
        }

        // Set up Breadcrumb
        if (!$this->isExport()) {
            $this->setupBreadcrumb();
        }

        // Render row
        $this->RowType = ROWTYPE_VIEW;
        $this->resetAttributes();
        $this->renderRow();

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset, true); // Get current record only
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows]);
            $this->terminate(true);
            return;
        }

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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        }
        $item->Visible = ($this->AddUrl != "" && $Security->canAdd());

        // Set up action default
        $option = $options["action"];
        $option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
        $option->UseDropDownButton = false;
        $option->UseButtonGroup = true;
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
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

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->AddUrl = $this->getAddUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();
        $this->ListUrl = $this->getListUrl();
        $this->setupOtherOptions();

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

            // Pengalaman_Ekspor
            $this->Pengalaman_Ekspor->ViewValue = $this->Pengalaman_Ekspor->CurrentValue;
            $this->Pengalaman_Ekspor->ViewCustomAttributes = "";

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

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // kdpelat
            $this->kdpelat->LinkCustomAttributes = "";
            $this->kdpelat->HrefValue = "";
            $this->kdpelat->TooltipValue = "";

            // Email_Address
            $this->Email_Address->LinkCustomAttributes = "";
            $this->Email_Address->HrefValue = "";
            $this->Email_Address->TooltipValue = "";

            // Nama_Lengkap
            $this->Nama_Lengkap->LinkCustomAttributes = "";
            $this->Nama_Lengkap->HrefValue = "";
            $this->Nama_Lengkap->TooltipValue = "";

            // Nomor_Handphone
            $this->Nomor_Handphone->LinkCustomAttributes = "";
            $this->Nomor_Handphone->HrefValue = "";
            $this->Nomor_Handphone->TooltipValue = "";

            // Jenis_Kelamin
            $this->Jenis_Kelamin->LinkCustomAttributes = "";
            $this->Jenis_Kelamin->HrefValue = "";
            $this->Jenis_Kelamin->TooltipValue = "";

            // Tempat_Lahir
            $this->Tempat_Lahir->LinkCustomAttributes = "";
            $this->Tempat_Lahir->HrefValue = "";
            $this->Tempat_Lahir->TooltipValue = "";

            // Tanggal_Lahir
            $this->Tanggal_Lahir->LinkCustomAttributes = "";
            $this->Tanggal_Lahir->HrefValue = "";
            $this->Tanggal_Lahir->TooltipValue = "";

            // Alamat_Tinggal
            $this->Alamat_Tinggal->LinkCustomAttributes = "";
            $this->Alamat_Tinggal->HrefValue = "";
            $this->Alamat_Tinggal->TooltipValue = "";

            // Provinsi
            $this->Provinsi->LinkCustomAttributes = "";
            $this->Provinsi->HrefValue = "";
            $this->Provinsi->TooltipValue = "";

            // Kabupaten_Kota
            $this->Kabupaten_Kota->LinkCustomAttributes = "";
            $this->Kabupaten_Kota->HrefValue = "";
            $this->Kabupaten_Kota->TooltipValue = "";

            // Jabatan_di_Perusahaan
            $this->Jabatan_di_Perusahaan->LinkCustomAttributes = "";
            $this->Jabatan_di_Perusahaan->HrefValue = "";
            $this->Jabatan_di_Perusahaan->TooltipValue = "";

            // Pendidikan
            $this->Pendidikan->LinkCustomAttributes = "";
            $this->Pendidikan->HrefValue = "";
            $this->Pendidikan->TooltipValue = "";

            // Nama_Perusahaan_Instansi
            $this->Nama_Perusahaan_Instansi->LinkCustomAttributes = "";
            $this->Nama_Perusahaan_Instansi->HrefValue = "";
            $this->Nama_Perusahaan_Instansi->TooltipValue = "";

            // Contact_Person_Perusahaan
            $this->Contact_Person_Perusahaan->LinkCustomAttributes = "";
            $this->Contact_Person_Perusahaan->HrefValue = "";
            $this->Contact_Person_Perusahaan->TooltipValue = "";

            // Telepon_Kantor
            $this->Telepon_Kantor->LinkCustomAttributes = "";
            $this->Telepon_Kantor->HrefValue = "";
            $this->Telepon_Kantor->TooltipValue = "";

            // Email
            $this->_Email->LinkCustomAttributes = "";
            $this->_Email->HrefValue = "";
            $this->_Email->TooltipValue = "";

            // Website
            $this->Website->LinkCustomAttributes = "";
            $this->Website->HrefValue = "";
            $this->Website->TooltipValue = "";

            // Alamat_Kantor
            $this->Alamat_Kantor->LinkCustomAttributes = "";
            $this->Alamat_Kantor->HrefValue = "";
            $this->Alamat_Kantor->TooltipValue = "";

            // Provinsi2
            $this->Provinsi2->LinkCustomAttributes = "";
            $this->Provinsi2->HrefValue = "";
            $this->Provinsi2->TooltipValue = "";

            // Kabupaten_Kota2
            $this->Kabupaten_Kota2->LinkCustomAttributes = "";
            $this->Kabupaten_Kota2->HrefValue = "";
            $this->Kabupaten_Kota2->TooltipValue = "";

            // ID_Sosial_Media
            $this->ID_Sosial_Media->LinkCustomAttributes = "";
            $this->ID_Sosial_Media->HrefValue = "";
            $this->ID_Sosial_Media->TooltipValue = "";

            // Kategori_perusahaan
            $this->Kategori_perusahaan->LinkCustomAttributes = "";
            $this->Kategori_perusahaan->HrefValue = "";
            $this->Kategori_perusahaan->TooltipValue = "";

            // Jenis_Usaha
            $this->Jenis_Usaha->LinkCustomAttributes = "";
            $this->Jenis_Usaha->HrefValue = "";
            $this->Jenis_Usaha->TooltipValue = "";

            // Skala_Perusahaan
            $this->Skala_Perusahaan->LinkCustomAttributes = "";
            $this->Skala_Perusahaan->HrefValue = "";
            $this->Skala_Perusahaan->TooltipValue = "";

            // Kategori_Produk
            $this->Kategori_Produk->LinkCustomAttributes = "";
            $this->Kategori_Produk->HrefValue = "";
            $this->Kategori_Produk->TooltipValue = "";

            // Produk_Perusahaan
            $this->Produk_Perusahaan->LinkCustomAttributes = "";
            $this->Produk_Perusahaan->HrefValue = "";
            $this->Produk_Perusahaan->TooltipValue = "";

            // HS_Code_Product
            $this->HS_Code_Product->LinkCustomAttributes = "";
            $this->HS_Code_Product->HrefValue = "";
            $this->HS_Code_Product->TooltipValue = "";

            // Omset_Perusahaan
            $this->Omset_Perusahaan->LinkCustomAttributes = "";
            $this->Omset_Perusahaan->HrefValue = "";
            $this->Omset_Perusahaan->TooltipValue = "";

            // Kapasitas_Produksi
            $this->Kapasitas_Produksi->LinkCustomAttributes = "";
            $this->Kapasitas_Produksi->HrefValue = "";
            $this->Kapasitas_Produksi->TooltipValue = "";

            // Pengalaman_Ekspor
            $this->Pengalaman_Ekspor->LinkCustomAttributes = "";
            $this->Pengalaman_Ekspor->HrefValue = "";
            $this->Pengalaman_Ekspor->TooltipValue = "";

            // ekspor_ke_negara_mana
            $this->ekspor_ke_negara_mana->LinkCustomAttributes = "";
            $this->ekspor_ke_negara_mana->HrefValue = "";
            $this->ekspor_ke_negara_mana->TooltipValue = "";

            // mengikuti_pelatihan_sebelumnya
            $this->mengikuti_pelatihan_sebelumnya->LinkCustomAttributes = "";
            $this->mengikuti_pelatihan_sebelumnya->HrefValue = "";
            $this->mengikuti_pelatihan_sebelumnya->TooltipValue = "";

            // pelatihan_apa_dimana
            $this->pelatihan_apa_dimana->LinkCustomAttributes = "";
            $this->pelatihan_apa_dimana->HrefValue = "";
            $this->pelatihan_apa_dimana->TooltipValue = "";

            // mendapatkan_informasi
            $this->mendapatkan_informasi->LinkCustomAttributes = "";
            $this->mendapatkan_informasi->HrefValue = "";
            $this->mendapatkan_informasi->TooltipValue = "";

            // harapkan_dari_pelatihan
            $this->harapkan_dari_pelatihan->LinkCustomAttributes = "";
            $this->harapkan_dari_pelatihan->HrefValue = "";
            $this->harapkan_dari_pelatihan->TooltipValue = "";

            // data_diisi_benar
            $this->data_diisi_benar->LinkCustomAttributes = "";
            $this->data_diisi_benar->HrefValue = "";
            $this->data_diisi_benar->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("datamasterlist"), "", $this->TableVar, true);
        $pageId = "view";
        $Breadcrumb->add("view", $pageId, $url);
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
}
