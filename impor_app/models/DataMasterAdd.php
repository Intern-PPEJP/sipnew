<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class DataMasterAdd extends DataMaster
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'data_master';

    // Page object name
    public $PageObjName = "DataMasterAdd";

    // Rendering View
    public $RenderingView = false;

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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
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
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
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
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
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
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("datamasterlist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "datamasterlist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "datamasterview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->dipindahkan->CurrentValue = 0;
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->kdpelat->CurrentValue = null;
        $this->kdpelat->OldValue = $this->kdpelat->CurrentValue;
        $this->Email_Address->CurrentValue = null;
        $this->Email_Address->OldValue = $this->Email_Address->CurrentValue;
        $this->Nama_Lengkap->CurrentValue = null;
        $this->Nama_Lengkap->OldValue = $this->Nama_Lengkap->CurrentValue;
        $this->Nomor_Handphone->CurrentValue = null;
        $this->Nomor_Handphone->OldValue = $this->Nomor_Handphone->CurrentValue;
        $this->Jenis_Kelamin->CurrentValue = null;
        $this->Jenis_Kelamin->OldValue = $this->Jenis_Kelamin->CurrentValue;
        $this->Tempat_Lahir->CurrentValue = null;
        $this->Tempat_Lahir->OldValue = $this->Tempat_Lahir->CurrentValue;
        $this->Tanggal_Lahir->CurrentValue = null;
        $this->Tanggal_Lahir->OldValue = $this->Tanggal_Lahir->CurrentValue;
        $this->Alamat_Tinggal->CurrentValue = null;
        $this->Alamat_Tinggal->OldValue = $this->Alamat_Tinggal->CurrentValue;
        $this->Provinsi->CurrentValue = null;
        $this->Provinsi->OldValue = $this->Provinsi->CurrentValue;
        $this->Kabupaten_Kota->CurrentValue = null;
        $this->Kabupaten_Kota->OldValue = $this->Kabupaten_Kota->CurrentValue;
        $this->Jabatan_di_Perusahaan->CurrentValue = null;
        $this->Jabatan_di_Perusahaan->OldValue = $this->Jabatan_di_Perusahaan->CurrentValue;
        $this->Pendidikan->CurrentValue = null;
        $this->Pendidikan->OldValue = $this->Pendidikan->CurrentValue;
        $this->Nama_Perusahaan_Instansi->CurrentValue = null;
        $this->Nama_Perusahaan_Instansi->OldValue = $this->Nama_Perusahaan_Instansi->CurrentValue;
        $this->Contact_Person_Perusahaan->CurrentValue = null;
        $this->Contact_Person_Perusahaan->OldValue = $this->Contact_Person_Perusahaan->CurrentValue;
        $this->Telepon_Kantor->CurrentValue = null;
        $this->Telepon_Kantor->OldValue = $this->Telepon_Kantor->CurrentValue;
        $this->_Email->CurrentValue = null;
        $this->_Email->OldValue = $this->_Email->CurrentValue;
        $this->Website->CurrentValue = null;
        $this->Website->OldValue = $this->Website->CurrentValue;
        $this->Alamat_Kantor->CurrentValue = null;
        $this->Alamat_Kantor->OldValue = $this->Alamat_Kantor->CurrentValue;
        $this->Provinsi2->CurrentValue = null;
        $this->Provinsi2->OldValue = $this->Provinsi2->CurrentValue;
        $this->Kabupaten_Kota2->CurrentValue = null;
        $this->Kabupaten_Kota2->OldValue = $this->Kabupaten_Kota2->CurrentValue;
        $this->ID_Sosial_Media->CurrentValue = null;
        $this->ID_Sosial_Media->OldValue = $this->ID_Sosial_Media->CurrentValue;
        $this->Kategori_perusahaan->CurrentValue = null;
        $this->Kategori_perusahaan->OldValue = $this->Kategori_perusahaan->CurrentValue;
        $this->Jenis_Usaha->CurrentValue = null;
        $this->Jenis_Usaha->OldValue = $this->Jenis_Usaha->CurrentValue;
        $this->Skala_Perusahaan->CurrentValue = null;
        $this->Skala_Perusahaan->OldValue = $this->Skala_Perusahaan->CurrentValue;
        $this->Kategori_Produk->CurrentValue = null;
        $this->Kategori_Produk->OldValue = $this->Kategori_Produk->CurrentValue;
        $this->Produk_Perusahaan->CurrentValue = null;
        $this->Produk_Perusahaan->OldValue = $this->Produk_Perusahaan->CurrentValue;
        $this->HS_Code_Product->CurrentValue = null;
        $this->HS_Code_Product->OldValue = $this->HS_Code_Product->CurrentValue;
        $this->Omset_Perusahaan->CurrentValue = null;
        $this->Omset_Perusahaan->OldValue = $this->Omset_Perusahaan->CurrentValue;
        $this->Kapasitas_Produksi->CurrentValue = null;
        $this->Kapasitas_Produksi->OldValue = $this->Kapasitas_Produksi->CurrentValue;
        $this->Pengalaman_Ekspor->CurrentValue = null;
        $this->Pengalaman_Ekspor->OldValue = $this->Pengalaman_Ekspor->CurrentValue;
        $this->ekspor_ke_negara_mana->CurrentValue = null;
        $this->ekspor_ke_negara_mana->OldValue = $this->ekspor_ke_negara_mana->CurrentValue;
        $this->mengikuti_pelatihan_sebelumnya->CurrentValue = null;
        $this->mengikuti_pelatihan_sebelumnya->OldValue = $this->mengikuti_pelatihan_sebelumnya->CurrentValue;
        $this->pelatihan_apa_dimana->CurrentValue = null;
        $this->pelatihan_apa_dimana->OldValue = $this->pelatihan_apa_dimana->CurrentValue;
        $this->mendapatkan_informasi->CurrentValue = null;
        $this->mendapatkan_informasi->OldValue = $this->mendapatkan_informasi->CurrentValue;
        $this->harapkan_dari_pelatihan->CurrentValue = null;
        $this->harapkan_dari_pelatihan->OldValue = $this->harapkan_dari_pelatihan->CurrentValue;
        $this->data_diisi_benar->CurrentValue = null;
        $this->data_diisi_benar->OldValue = $this->data_diisi_benar->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'dipindahkan' first before field var 'x_dipindahkan'
        $val = $CurrentForm->hasValue("dipindahkan") ? $CurrentForm->getValue("dipindahkan") : $CurrentForm->getValue("x_dipindahkan");
        if (!$this->dipindahkan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dipindahkan->Visible = false; // Disable update for API request
            } else {
                $this->dipindahkan->setFormValue($val);
            }
        }

        // Check field name 'kdpelat' first before field var 'x_kdpelat'
        $val = $CurrentForm->hasValue("kdpelat") ? $CurrentForm->getValue("kdpelat") : $CurrentForm->getValue("x_kdpelat");
        if (!$this->kdpelat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kdpelat->Visible = false; // Disable update for API request
            } else {
                $this->kdpelat->setFormValue($val);
            }
        }

        // Check field name 'Email_Address' first before field var 'x_Email_Address'
        $val = $CurrentForm->hasValue("Email_Address") ? $CurrentForm->getValue("Email_Address") : $CurrentForm->getValue("x_Email_Address");
        if (!$this->Email_Address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Email_Address->Visible = false; // Disable update for API request
            } else {
                $this->Email_Address->setFormValue($val);
            }
        }

        // Check field name 'Nama_Lengkap' first before field var 'x_Nama_Lengkap'
        $val = $CurrentForm->hasValue("Nama_Lengkap") ? $CurrentForm->getValue("Nama_Lengkap") : $CurrentForm->getValue("x_Nama_Lengkap");
        if (!$this->Nama_Lengkap->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Nama_Lengkap->Visible = false; // Disable update for API request
            } else {
                $this->Nama_Lengkap->setFormValue($val);
            }
        }

        // Check field name 'Nomor_Handphone' first before field var 'x_Nomor_Handphone'
        $val = $CurrentForm->hasValue("Nomor_Handphone") ? $CurrentForm->getValue("Nomor_Handphone") : $CurrentForm->getValue("x_Nomor_Handphone");
        if (!$this->Nomor_Handphone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Nomor_Handphone->Visible = false; // Disable update for API request
            } else {
                $this->Nomor_Handphone->setFormValue($val);
            }
        }

        // Check field name 'Jenis_Kelamin' first before field var 'x_Jenis_Kelamin'
        $val = $CurrentForm->hasValue("Jenis_Kelamin") ? $CurrentForm->getValue("Jenis_Kelamin") : $CurrentForm->getValue("x_Jenis_Kelamin");
        if (!$this->Jenis_Kelamin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Jenis_Kelamin->Visible = false; // Disable update for API request
            } else {
                $this->Jenis_Kelamin->setFormValue($val);
            }
        }

        // Check field name 'Tempat_Lahir' first before field var 'x_Tempat_Lahir'
        $val = $CurrentForm->hasValue("Tempat_Lahir") ? $CurrentForm->getValue("Tempat_Lahir") : $CurrentForm->getValue("x_Tempat_Lahir");
        if (!$this->Tempat_Lahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Tempat_Lahir->Visible = false; // Disable update for API request
            } else {
                $this->Tempat_Lahir->setFormValue($val);
            }
        }

        // Check field name 'Tanggal_Lahir' first before field var 'x_Tanggal_Lahir'
        $val = $CurrentForm->hasValue("Tanggal_Lahir") ? $CurrentForm->getValue("Tanggal_Lahir") : $CurrentForm->getValue("x_Tanggal_Lahir");
        if (!$this->Tanggal_Lahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Tanggal_Lahir->Visible = false; // Disable update for API request
            } else {
                $this->Tanggal_Lahir->setFormValue($val);
            }
        }

        // Check field name 'Alamat_Tinggal' first before field var 'x_Alamat_Tinggal'
        $val = $CurrentForm->hasValue("Alamat_Tinggal") ? $CurrentForm->getValue("Alamat_Tinggal") : $CurrentForm->getValue("x_Alamat_Tinggal");
        if (!$this->Alamat_Tinggal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Alamat_Tinggal->Visible = false; // Disable update for API request
            } else {
                $this->Alamat_Tinggal->setFormValue($val);
            }
        }

        // Check field name 'Provinsi' first before field var 'x_Provinsi'
        $val = $CurrentForm->hasValue("Provinsi") ? $CurrentForm->getValue("Provinsi") : $CurrentForm->getValue("x_Provinsi");
        if (!$this->Provinsi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Provinsi->Visible = false; // Disable update for API request
            } else {
                $this->Provinsi->setFormValue($val);
            }
        }

        // Check field name 'Kabupaten_Kota' first before field var 'x_Kabupaten_Kota'
        $val = $CurrentForm->hasValue("Kabupaten_Kota") ? $CurrentForm->getValue("Kabupaten_Kota") : $CurrentForm->getValue("x_Kabupaten_Kota");
        if (!$this->Kabupaten_Kota->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Kabupaten_Kota->Visible = false; // Disable update for API request
            } else {
                $this->Kabupaten_Kota->setFormValue($val);
            }
        }

        // Check field name 'Jabatan_di_Perusahaan' first before field var 'x_Jabatan_di_Perusahaan'
        $val = $CurrentForm->hasValue("Jabatan_di_Perusahaan") ? $CurrentForm->getValue("Jabatan_di_Perusahaan") : $CurrentForm->getValue("x_Jabatan_di_Perusahaan");
        if (!$this->Jabatan_di_Perusahaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Jabatan_di_Perusahaan->Visible = false; // Disable update for API request
            } else {
                $this->Jabatan_di_Perusahaan->setFormValue($val);
            }
        }

        // Check field name 'Pendidikan' first before field var 'x_Pendidikan'
        $val = $CurrentForm->hasValue("Pendidikan") ? $CurrentForm->getValue("Pendidikan") : $CurrentForm->getValue("x_Pendidikan");
        if (!$this->Pendidikan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Pendidikan->Visible = false; // Disable update for API request
            } else {
                $this->Pendidikan->setFormValue($val);
            }
        }

        // Check field name 'Nama_Perusahaan_Instansi' first before field var 'x_Nama_Perusahaan_Instansi'
        $val = $CurrentForm->hasValue("Nama_Perusahaan_Instansi") ? $CurrentForm->getValue("Nama_Perusahaan_Instansi") : $CurrentForm->getValue("x_Nama_Perusahaan_Instansi");
        if (!$this->Nama_Perusahaan_Instansi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Nama_Perusahaan_Instansi->Visible = false; // Disable update for API request
            } else {
                $this->Nama_Perusahaan_Instansi->setFormValue($val);
            }
        }

        // Check field name 'Contact_Person_Perusahaan' first before field var 'x_Contact_Person_Perusahaan'
        $val = $CurrentForm->hasValue("Contact_Person_Perusahaan") ? $CurrentForm->getValue("Contact_Person_Perusahaan") : $CurrentForm->getValue("x_Contact_Person_Perusahaan");
        if (!$this->Contact_Person_Perusahaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Contact_Person_Perusahaan->Visible = false; // Disable update for API request
            } else {
                $this->Contact_Person_Perusahaan->setFormValue($val);
            }
        }

        // Check field name 'Telepon_Kantor' first before field var 'x_Telepon_Kantor'
        $val = $CurrentForm->hasValue("Telepon_Kantor") ? $CurrentForm->getValue("Telepon_Kantor") : $CurrentForm->getValue("x_Telepon_Kantor");
        if (!$this->Telepon_Kantor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Telepon_Kantor->Visible = false; // Disable update for API request
            } else {
                $this->Telepon_Kantor->setFormValue($val);
            }
        }

        // Check field name 'Email' first before field var 'x__Email'
        $val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
        if (!$this->_Email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_Email->Visible = false; // Disable update for API request
            } else {
                $this->_Email->setFormValue($val);
            }
        }

        // Check field name 'Website' first before field var 'x_Website'
        $val = $CurrentForm->hasValue("Website") ? $CurrentForm->getValue("Website") : $CurrentForm->getValue("x_Website");
        if (!$this->Website->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Website->Visible = false; // Disable update for API request
            } else {
                $this->Website->setFormValue($val);
            }
        }

        // Check field name 'Alamat_Kantor' first before field var 'x_Alamat_Kantor'
        $val = $CurrentForm->hasValue("Alamat_Kantor") ? $CurrentForm->getValue("Alamat_Kantor") : $CurrentForm->getValue("x_Alamat_Kantor");
        if (!$this->Alamat_Kantor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Alamat_Kantor->Visible = false; // Disable update for API request
            } else {
                $this->Alamat_Kantor->setFormValue($val);
            }
        }

        // Check field name 'Provinsi2' first before field var 'x_Provinsi2'
        $val = $CurrentForm->hasValue("Provinsi2") ? $CurrentForm->getValue("Provinsi2") : $CurrentForm->getValue("x_Provinsi2");
        if (!$this->Provinsi2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Provinsi2->Visible = false; // Disable update for API request
            } else {
                $this->Provinsi2->setFormValue($val);
            }
        }

        // Check field name 'Kabupaten_Kota2' first before field var 'x_Kabupaten_Kota2'
        $val = $CurrentForm->hasValue("Kabupaten_Kota2") ? $CurrentForm->getValue("Kabupaten_Kota2") : $CurrentForm->getValue("x_Kabupaten_Kota2");
        if (!$this->Kabupaten_Kota2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Kabupaten_Kota2->Visible = false; // Disable update for API request
            } else {
                $this->Kabupaten_Kota2->setFormValue($val);
            }
        }

        // Check field name 'ID_Sosial_Media' first before field var 'x_ID_Sosial_Media'
        $val = $CurrentForm->hasValue("ID_Sosial_Media") ? $CurrentForm->getValue("ID_Sosial_Media") : $CurrentForm->getValue("x_ID_Sosial_Media");
        if (!$this->ID_Sosial_Media->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ID_Sosial_Media->Visible = false; // Disable update for API request
            } else {
                $this->ID_Sosial_Media->setFormValue($val);
            }
        }

        // Check field name 'Kategori_perusahaan' first before field var 'x_Kategori_perusahaan'
        $val = $CurrentForm->hasValue("Kategori_perusahaan") ? $CurrentForm->getValue("Kategori_perusahaan") : $CurrentForm->getValue("x_Kategori_perusahaan");
        if (!$this->Kategori_perusahaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Kategori_perusahaan->Visible = false; // Disable update for API request
            } else {
                $this->Kategori_perusahaan->setFormValue($val);
            }
        }

        // Check field name 'Jenis_Usaha' first before field var 'x_Jenis_Usaha'
        $val = $CurrentForm->hasValue("Jenis_Usaha") ? $CurrentForm->getValue("Jenis_Usaha") : $CurrentForm->getValue("x_Jenis_Usaha");
        if (!$this->Jenis_Usaha->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Jenis_Usaha->Visible = false; // Disable update for API request
            } else {
                $this->Jenis_Usaha->setFormValue($val);
            }
        }

        // Check field name 'Skala_Perusahaan' first before field var 'x_Skala_Perusahaan'
        $val = $CurrentForm->hasValue("Skala_Perusahaan") ? $CurrentForm->getValue("Skala_Perusahaan") : $CurrentForm->getValue("x_Skala_Perusahaan");
        if (!$this->Skala_Perusahaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Skala_Perusahaan->Visible = false; // Disable update for API request
            } else {
                $this->Skala_Perusahaan->setFormValue($val);
            }
        }

        // Check field name 'Kategori_Produk' first before field var 'x_Kategori_Produk'
        $val = $CurrentForm->hasValue("Kategori_Produk") ? $CurrentForm->getValue("Kategori_Produk") : $CurrentForm->getValue("x_Kategori_Produk");
        if (!$this->Kategori_Produk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Kategori_Produk->Visible = false; // Disable update for API request
            } else {
                $this->Kategori_Produk->setFormValue($val);
            }
        }

        // Check field name 'Produk_Perusahaan' first before field var 'x_Produk_Perusahaan'
        $val = $CurrentForm->hasValue("Produk_Perusahaan") ? $CurrentForm->getValue("Produk_Perusahaan") : $CurrentForm->getValue("x_Produk_Perusahaan");
        if (!$this->Produk_Perusahaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Produk_Perusahaan->Visible = false; // Disable update for API request
            } else {
                $this->Produk_Perusahaan->setFormValue($val);
            }
        }

        // Check field name 'HS_Code_Product' first before field var 'x_HS_Code_Product'
        $val = $CurrentForm->hasValue("HS_Code_Product") ? $CurrentForm->getValue("HS_Code_Product") : $CurrentForm->getValue("x_HS_Code_Product");
        if (!$this->HS_Code_Product->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->HS_Code_Product->Visible = false; // Disable update for API request
            } else {
                $this->HS_Code_Product->setFormValue($val);
            }
        }

        // Check field name 'Omset_Perusahaan' first before field var 'x_Omset_Perusahaan'
        $val = $CurrentForm->hasValue("Omset_Perusahaan") ? $CurrentForm->getValue("Omset_Perusahaan") : $CurrentForm->getValue("x_Omset_Perusahaan");
        if (!$this->Omset_Perusahaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Omset_Perusahaan->Visible = false; // Disable update for API request
            } else {
                $this->Omset_Perusahaan->setFormValue($val);
            }
        }

        // Check field name 'Kapasitas_Produksi' first before field var 'x_Kapasitas_Produksi'
        $val = $CurrentForm->hasValue("Kapasitas_Produksi") ? $CurrentForm->getValue("Kapasitas_Produksi") : $CurrentForm->getValue("x_Kapasitas_Produksi");
        if (!$this->Kapasitas_Produksi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Kapasitas_Produksi->Visible = false; // Disable update for API request
            } else {
                $this->Kapasitas_Produksi->setFormValue($val);
            }
        }

        // Check field name 'Pengalaman_Ekspor' first before field var 'x_Pengalaman_Ekspor'
        $val = $CurrentForm->hasValue("Pengalaman_Ekspor") ? $CurrentForm->getValue("Pengalaman_Ekspor") : $CurrentForm->getValue("x_Pengalaman_Ekspor");
        if (!$this->Pengalaman_Ekspor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Pengalaman_Ekspor->Visible = false; // Disable update for API request
            } else {
                $this->Pengalaman_Ekspor->setFormValue($val);
            }
        }

        // Check field name 'ekspor_ke_negara_mana' first before field var 'x_ekspor_ke_negara_mana'
        $val = $CurrentForm->hasValue("ekspor_ke_negara_mana") ? $CurrentForm->getValue("ekspor_ke_negara_mana") : $CurrentForm->getValue("x_ekspor_ke_negara_mana");
        if (!$this->ekspor_ke_negara_mana->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ekspor_ke_negara_mana->Visible = false; // Disable update for API request
            } else {
                $this->ekspor_ke_negara_mana->setFormValue($val);
            }
        }

        // Check field name 'mengikuti_pelatihan_sebelumnya' first before field var 'x_mengikuti_pelatihan_sebelumnya'
        $val = $CurrentForm->hasValue("mengikuti_pelatihan_sebelumnya") ? $CurrentForm->getValue("mengikuti_pelatihan_sebelumnya") : $CurrentForm->getValue("x_mengikuti_pelatihan_sebelumnya");
        if (!$this->mengikuti_pelatihan_sebelumnya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->mengikuti_pelatihan_sebelumnya->Visible = false; // Disable update for API request
            } else {
                $this->mengikuti_pelatihan_sebelumnya->setFormValue($val);
            }
        }

        // Check field name 'pelatihan_apa_dimana' first before field var 'x_pelatihan_apa_dimana'
        $val = $CurrentForm->hasValue("pelatihan_apa_dimana") ? $CurrentForm->getValue("pelatihan_apa_dimana") : $CurrentForm->getValue("x_pelatihan_apa_dimana");
        if (!$this->pelatihan_apa_dimana->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pelatihan_apa_dimana->Visible = false; // Disable update for API request
            } else {
                $this->pelatihan_apa_dimana->setFormValue($val);
            }
        }

        // Check field name 'mendapatkan_informasi' first before field var 'x_mendapatkan_informasi'
        $val = $CurrentForm->hasValue("mendapatkan_informasi") ? $CurrentForm->getValue("mendapatkan_informasi") : $CurrentForm->getValue("x_mendapatkan_informasi");
        if (!$this->mendapatkan_informasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->mendapatkan_informasi->Visible = false; // Disable update for API request
            } else {
                $this->mendapatkan_informasi->setFormValue($val);
            }
        }

        // Check field name 'harapkan_dari_pelatihan' first before field var 'x_harapkan_dari_pelatihan'
        $val = $CurrentForm->hasValue("harapkan_dari_pelatihan") ? $CurrentForm->getValue("harapkan_dari_pelatihan") : $CurrentForm->getValue("x_harapkan_dari_pelatihan");
        if (!$this->harapkan_dari_pelatihan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->harapkan_dari_pelatihan->Visible = false; // Disable update for API request
            } else {
                $this->harapkan_dari_pelatihan->setFormValue($val);
            }
        }

        // Check field name 'data_diisi_benar' first before field var 'x_data_diisi_benar'
        $val = $CurrentForm->hasValue("data_diisi_benar") ? $CurrentForm->getValue("data_diisi_benar") : $CurrentForm->getValue("x_data_diisi_benar");
        if (!$this->data_diisi_benar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->data_diisi_benar->Visible = false; // Disable update for API request
            } else {
                $this->data_diisi_benar->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->dipindahkan->CurrentValue = $this->dipindahkan->FormValue;
        $this->kdpelat->CurrentValue = $this->kdpelat->FormValue;
        $this->Email_Address->CurrentValue = $this->Email_Address->FormValue;
        $this->Nama_Lengkap->CurrentValue = $this->Nama_Lengkap->FormValue;
        $this->Nomor_Handphone->CurrentValue = $this->Nomor_Handphone->FormValue;
        $this->Jenis_Kelamin->CurrentValue = $this->Jenis_Kelamin->FormValue;
        $this->Tempat_Lahir->CurrentValue = $this->Tempat_Lahir->FormValue;
        $this->Tanggal_Lahir->CurrentValue = $this->Tanggal_Lahir->FormValue;
        $this->Alamat_Tinggal->CurrentValue = $this->Alamat_Tinggal->FormValue;
        $this->Provinsi->CurrentValue = $this->Provinsi->FormValue;
        $this->Kabupaten_Kota->CurrentValue = $this->Kabupaten_Kota->FormValue;
        $this->Jabatan_di_Perusahaan->CurrentValue = $this->Jabatan_di_Perusahaan->FormValue;
        $this->Pendidikan->CurrentValue = $this->Pendidikan->FormValue;
        $this->Nama_Perusahaan_Instansi->CurrentValue = $this->Nama_Perusahaan_Instansi->FormValue;
        $this->Contact_Person_Perusahaan->CurrentValue = $this->Contact_Person_Perusahaan->FormValue;
        $this->Telepon_Kantor->CurrentValue = $this->Telepon_Kantor->FormValue;
        $this->_Email->CurrentValue = $this->_Email->FormValue;
        $this->Website->CurrentValue = $this->Website->FormValue;
        $this->Alamat_Kantor->CurrentValue = $this->Alamat_Kantor->FormValue;
        $this->Provinsi2->CurrentValue = $this->Provinsi2->FormValue;
        $this->Kabupaten_Kota2->CurrentValue = $this->Kabupaten_Kota2->FormValue;
        $this->ID_Sosial_Media->CurrentValue = $this->ID_Sosial_Media->FormValue;
        $this->Kategori_perusahaan->CurrentValue = $this->Kategori_perusahaan->FormValue;
        $this->Jenis_Usaha->CurrentValue = $this->Jenis_Usaha->FormValue;
        $this->Skala_Perusahaan->CurrentValue = $this->Skala_Perusahaan->FormValue;
        $this->Kategori_Produk->CurrentValue = $this->Kategori_Produk->FormValue;
        $this->Produk_Perusahaan->CurrentValue = $this->Produk_Perusahaan->FormValue;
        $this->HS_Code_Product->CurrentValue = $this->HS_Code_Product->FormValue;
        $this->Omset_Perusahaan->CurrentValue = $this->Omset_Perusahaan->FormValue;
        $this->Kapasitas_Produksi->CurrentValue = $this->Kapasitas_Produksi->FormValue;
        $this->Pengalaman_Ekspor->CurrentValue = $this->Pengalaman_Ekspor->FormValue;
        $this->ekspor_ke_negara_mana->CurrentValue = $this->ekspor_ke_negara_mana->FormValue;
        $this->mengikuti_pelatihan_sebelumnya->CurrentValue = $this->mengikuti_pelatihan_sebelumnya->FormValue;
        $this->pelatihan_apa_dimana->CurrentValue = $this->pelatihan_apa_dimana->FormValue;
        $this->mendapatkan_informasi->CurrentValue = $this->mendapatkan_informasi->FormValue;
        $this->harapkan_dari_pelatihan->CurrentValue = $this->harapkan_dari_pelatihan->FormValue;
        $this->data_diisi_benar->CurrentValue = $this->data_diisi_benar->FormValue;
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
        $this->loadDefaultValues();
        $row = [];
        $row['dipindahkan'] = $this->dipindahkan->CurrentValue;
        $row['id'] = $this->id->CurrentValue;
        $row['kdpelat'] = $this->kdpelat->CurrentValue;
        $row['Email_Address'] = $this->Email_Address->CurrentValue;
        $row['Nama_Lengkap'] = $this->Nama_Lengkap->CurrentValue;
        $row['Nomor_Handphone'] = $this->Nomor_Handphone->CurrentValue;
        $row['Jenis_Kelamin'] = $this->Jenis_Kelamin->CurrentValue;
        $row['Tempat_Lahir'] = $this->Tempat_Lahir->CurrentValue;
        $row['Tanggal_Lahir'] = $this->Tanggal_Lahir->CurrentValue;
        $row['Alamat_Tinggal'] = $this->Alamat_Tinggal->CurrentValue;
        $row['Provinsi'] = $this->Provinsi->CurrentValue;
        $row['Kabupaten_Kota'] = $this->Kabupaten_Kota->CurrentValue;
        $row['Jabatan_di_Perusahaan'] = $this->Jabatan_di_Perusahaan->CurrentValue;
        $row['Pendidikan'] = $this->Pendidikan->CurrentValue;
        $row['Nama_Perusahaan_Instansi'] = $this->Nama_Perusahaan_Instansi->CurrentValue;
        $row['Contact_Person_Perusahaan'] = $this->Contact_Person_Perusahaan->CurrentValue;
        $row['Telepon_Kantor'] = $this->Telepon_Kantor->CurrentValue;
        $row['Email'] = $this->_Email->CurrentValue;
        $row['Website'] = $this->Website->CurrentValue;
        $row['Alamat_Kantor'] = $this->Alamat_Kantor->CurrentValue;
        $row['Provinsi2'] = $this->Provinsi2->CurrentValue;
        $row['Kabupaten_Kota2'] = $this->Kabupaten_Kota2->CurrentValue;
        $row['ID_Sosial_Media'] = $this->ID_Sosial_Media->CurrentValue;
        $row['Kategori_perusahaan'] = $this->Kategori_perusahaan->CurrentValue;
        $row['Jenis_Usaha'] = $this->Jenis_Usaha->CurrentValue;
        $row['Skala_Perusahaan'] = $this->Skala_Perusahaan->CurrentValue;
        $row['Kategori_Produk'] = $this->Kategori_Produk->CurrentValue;
        $row['Produk_Perusahaan'] = $this->Produk_Perusahaan->CurrentValue;
        $row['HS_Code_Product'] = $this->HS_Code_Product->CurrentValue;
        $row['Omset_Perusahaan'] = $this->Omset_Perusahaan->CurrentValue;
        $row['Kapasitas_Produksi'] = $this->Kapasitas_Produksi->CurrentValue;
        $row['Pengalaman_Ekspor'] = $this->Pengalaman_Ekspor->CurrentValue;
        $row['ekspor_ke_negara_mana'] = $this->ekspor_ke_negara_mana->CurrentValue;
        $row['mengikuti_pelatihan_sebelumnya'] = $this->mengikuti_pelatihan_sebelumnya->CurrentValue;
        $row['pelatihan_apa_dimana'] = $this->pelatihan_apa_dimana->CurrentValue;
        $row['mendapatkan_informasi'] = $this->mendapatkan_informasi->CurrentValue;
        $row['harapkan_dari_pelatihan'] = $this->harapkan_dari_pelatihan->CurrentValue;
        $row['data_diisi_benar'] = $this->data_diisi_benar->CurrentValue;
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
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // dipindahkan
            $this->dipindahkan->EditCustomAttributes = "";
            $this->dipindahkan->EditValue = $this->dipindahkan->options(false);
            $this->dipindahkan->PlaceHolder = RemoveHtml($this->dipindahkan->caption());

            // kdpelat
            $this->kdpelat->EditAttrs["class"] = "form-control";
            $this->kdpelat->EditCustomAttributes = "";
            if (!$this->kdpelat->Raw) {
                $this->kdpelat->CurrentValue = HtmlDecode($this->kdpelat->CurrentValue);
            }
            $this->kdpelat->EditValue = HtmlEncode($this->kdpelat->CurrentValue);
            $this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

            // Email_Address
            $this->Email_Address->EditAttrs["class"] = "form-control";
            $this->Email_Address->EditCustomAttributes = "";
            $this->Email_Address->EditValue = HtmlEncode($this->Email_Address->CurrentValue);
            $this->Email_Address->PlaceHolder = RemoveHtml($this->Email_Address->caption());

            // Nama_Lengkap
            $this->Nama_Lengkap->EditAttrs["class"] = "form-control";
            $this->Nama_Lengkap->EditCustomAttributes = "";
            $this->Nama_Lengkap->EditValue = HtmlEncode($this->Nama_Lengkap->CurrentValue);
            $this->Nama_Lengkap->PlaceHolder = RemoveHtml($this->Nama_Lengkap->caption());

            // Nomor_Handphone
            $this->Nomor_Handphone->EditAttrs["class"] = "form-control";
            $this->Nomor_Handphone->EditCustomAttributes = "";
            $this->Nomor_Handphone->EditValue = HtmlEncode($this->Nomor_Handphone->CurrentValue);
            $this->Nomor_Handphone->PlaceHolder = RemoveHtml($this->Nomor_Handphone->caption());

            // Jenis_Kelamin
            $this->Jenis_Kelamin->EditAttrs["class"] = "form-control";
            $this->Jenis_Kelamin->EditCustomAttributes = "";
            $this->Jenis_Kelamin->EditValue = HtmlEncode($this->Jenis_Kelamin->CurrentValue);
            $this->Jenis_Kelamin->PlaceHolder = RemoveHtml($this->Jenis_Kelamin->caption());

            // Tempat_Lahir
            $this->Tempat_Lahir->EditAttrs["class"] = "form-control";
            $this->Tempat_Lahir->EditCustomAttributes = "";
            $this->Tempat_Lahir->EditValue = HtmlEncode($this->Tempat_Lahir->CurrentValue);
            $this->Tempat_Lahir->PlaceHolder = RemoveHtml($this->Tempat_Lahir->caption());

            // Tanggal_Lahir
            $this->Tanggal_Lahir->EditAttrs["class"] = "form-control";
            $this->Tanggal_Lahir->EditCustomAttributes = "";
            $this->Tanggal_Lahir->EditValue = HtmlEncode($this->Tanggal_Lahir->CurrentValue);
            $this->Tanggal_Lahir->PlaceHolder = RemoveHtml($this->Tanggal_Lahir->caption());

            // Alamat_Tinggal
            $this->Alamat_Tinggal->EditAttrs["class"] = "form-control";
            $this->Alamat_Tinggal->EditCustomAttributes = "";
            $this->Alamat_Tinggal->EditValue = HtmlEncode($this->Alamat_Tinggal->CurrentValue);
            $this->Alamat_Tinggal->PlaceHolder = RemoveHtml($this->Alamat_Tinggal->caption());

            // Provinsi
            $this->Provinsi->EditAttrs["class"] = "form-control";
            $this->Provinsi->EditCustomAttributes = "";
            if (!$this->Provinsi->Raw) {
                $this->Provinsi->CurrentValue = HtmlDecode($this->Provinsi->CurrentValue);
            }
            $this->Provinsi->EditValue = HtmlEncode($this->Provinsi->CurrentValue);
            $this->Provinsi->PlaceHolder = RemoveHtml($this->Provinsi->caption());

            // Kabupaten_Kota
            $this->Kabupaten_Kota->EditAttrs["class"] = "form-control";
            $this->Kabupaten_Kota->EditCustomAttributes = "";
            if (!$this->Kabupaten_Kota->Raw) {
                $this->Kabupaten_Kota->CurrentValue = HtmlDecode($this->Kabupaten_Kota->CurrentValue);
            }
            $this->Kabupaten_Kota->EditValue = HtmlEncode($this->Kabupaten_Kota->CurrentValue);
            $this->Kabupaten_Kota->PlaceHolder = RemoveHtml($this->Kabupaten_Kota->caption());

            // Jabatan_di_Perusahaan
            $this->Jabatan_di_Perusahaan->EditAttrs["class"] = "form-control";
            $this->Jabatan_di_Perusahaan->EditCustomAttributes = "";
            $this->Jabatan_di_Perusahaan->EditValue = HtmlEncode($this->Jabatan_di_Perusahaan->CurrentValue);
            $this->Jabatan_di_Perusahaan->PlaceHolder = RemoveHtml($this->Jabatan_di_Perusahaan->caption());

            // Pendidikan
            $this->Pendidikan->EditAttrs["class"] = "form-control";
            $this->Pendidikan->EditCustomAttributes = "";
            $this->Pendidikan->EditValue = HtmlEncode($this->Pendidikan->CurrentValue);
            $this->Pendidikan->PlaceHolder = RemoveHtml($this->Pendidikan->caption());

            // Nama_Perusahaan_Instansi
            $this->Nama_Perusahaan_Instansi->EditAttrs["class"] = "form-control";
            $this->Nama_Perusahaan_Instansi->EditCustomAttributes = "";
            $this->Nama_Perusahaan_Instansi->EditValue = HtmlEncode($this->Nama_Perusahaan_Instansi->CurrentValue);
            $this->Nama_Perusahaan_Instansi->PlaceHolder = RemoveHtml($this->Nama_Perusahaan_Instansi->caption());

            // Contact_Person_Perusahaan
            $this->Contact_Person_Perusahaan->EditAttrs["class"] = "form-control";
            $this->Contact_Person_Perusahaan->EditCustomAttributes = "";
            $this->Contact_Person_Perusahaan->EditValue = HtmlEncode($this->Contact_Person_Perusahaan->CurrentValue);
            $this->Contact_Person_Perusahaan->PlaceHolder = RemoveHtml($this->Contact_Person_Perusahaan->caption());

            // Telepon_Kantor
            $this->Telepon_Kantor->EditAttrs["class"] = "form-control";
            $this->Telepon_Kantor->EditCustomAttributes = "";
            $this->Telepon_Kantor->EditValue = HtmlEncode($this->Telepon_Kantor->CurrentValue);
            $this->Telepon_Kantor->PlaceHolder = RemoveHtml($this->Telepon_Kantor->caption());

            // Email
            $this->_Email->EditAttrs["class"] = "form-control";
            $this->_Email->EditCustomAttributes = "";
            $this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
            $this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

            // Website
            $this->Website->EditAttrs["class"] = "form-control";
            $this->Website->EditCustomAttributes = "";
            $this->Website->EditValue = HtmlEncode($this->Website->CurrentValue);
            $this->Website->PlaceHolder = RemoveHtml($this->Website->caption());

            // Alamat_Kantor
            $this->Alamat_Kantor->EditAttrs["class"] = "form-control";
            $this->Alamat_Kantor->EditCustomAttributes = "";
            $this->Alamat_Kantor->EditValue = HtmlEncode($this->Alamat_Kantor->CurrentValue);
            $this->Alamat_Kantor->PlaceHolder = RemoveHtml($this->Alamat_Kantor->caption());

            // Provinsi2
            $this->Provinsi2->EditAttrs["class"] = "form-control";
            $this->Provinsi2->EditCustomAttributes = "";
            $this->Provinsi2->EditValue = HtmlEncode($this->Provinsi2->CurrentValue);
            $this->Provinsi2->PlaceHolder = RemoveHtml($this->Provinsi2->caption());

            // Kabupaten_Kota2
            $this->Kabupaten_Kota2->EditAttrs["class"] = "form-control";
            $this->Kabupaten_Kota2->EditCustomAttributes = "";
            $this->Kabupaten_Kota2->EditValue = HtmlEncode($this->Kabupaten_Kota2->CurrentValue);
            $this->Kabupaten_Kota2->PlaceHolder = RemoveHtml($this->Kabupaten_Kota2->caption());

            // ID_Sosial_Media
            $this->ID_Sosial_Media->EditAttrs["class"] = "form-control";
            $this->ID_Sosial_Media->EditCustomAttributes = "";
            $this->ID_Sosial_Media->EditValue = HtmlEncode($this->ID_Sosial_Media->CurrentValue);
            $this->ID_Sosial_Media->PlaceHolder = RemoveHtml($this->ID_Sosial_Media->caption());

            // Kategori_perusahaan
            $this->Kategori_perusahaan->EditAttrs["class"] = "form-control";
            $this->Kategori_perusahaan->EditCustomAttributes = "";
            $this->Kategori_perusahaan->EditValue = HtmlEncode($this->Kategori_perusahaan->CurrentValue);
            $this->Kategori_perusahaan->PlaceHolder = RemoveHtml($this->Kategori_perusahaan->caption());

            // Jenis_Usaha
            $this->Jenis_Usaha->EditAttrs["class"] = "form-control";
            $this->Jenis_Usaha->EditCustomAttributes = "";
            $this->Jenis_Usaha->EditValue = HtmlEncode($this->Jenis_Usaha->CurrentValue);
            $this->Jenis_Usaha->PlaceHolder = RemoveHtml($this->Jenis_Usaha->caption());

            // Skala_Perusahaan
            $this->Skala_Perusahaan->EditAttrs["class"] = "form-control";
            $this->Skala_Perusahaan->EditCustomAttributes = "";
            $this->Skala_Perusahaan->EditValue = HtmlEncode($this->Skala_Perusahaan->CurrentValue);
            $this->Skala_Perusahaan->PlaceHolder = RemoveHtml($this->Skala_Perusahaan->caption());

            // Kategori_Produk
            $this->Kategori_Produk->EditAttrs["class"] = "form-control";
            $this->Kategori_Produk->EditCustomAttributes = "";
            $this->Kategori_Produk->EditValue = HtmlEncode($this->Kategori_Produk->CurrentValue);
            $this->Kategori_Produk->PlaceHolder = RemoveHtml($this->Kategori_Produk->caption());

            // Produk_Perusahaan
            $this->Produk_Perusahaan->EditAttrs["class"] = "form-control";
            $this->Produk_Perusahaan->EditCustomAttributes = "";
            $this->Produk_Perusahaan->EditValue = HtmlEncode($this->Produk_Perusahaan->CurrentValue);
            $this->Produk_Perusahaan->PlaceHolder = RemoveHtml($this->Produk_Perusahaan->caption());

            // HS_Code_Product
            $this->HS_Code_Product->EditAttrs["class"] = "form-control";
            $this->HS_Code_Product->EditCustomAttributes = "";
            $this->HS_Code_Product->EditValue = HtmlEncode($this->HS_Code_Product->CurrentValue);
            $this->HS_Code_Product->PlaceHolder = RemoveHtml($this->HS_Code_Product->caption());

            // Omset_Perusahaan
            $this->Omset_Perusahaan->EditAttrs["class"] = "form-control";
            $this->Omset_Perusahaan->EditCustomAttributes = "";
            $this->Omset_Perusahaan->EditValue = HtmlEncode($this->Omset_Perusahaan->CurrentValue);
            $this->Omset_Perusahaan->PlaceHolder = RemoveHtml($this->Omset_Perusahaan->caption());

            // Kapasitas_Produksi
            $this->Kapasitas_Produksi->EditAttrs["class"] = "form-control";
            $this->Kapasitas_Produksi->EditCustomAttributes = "";
            $this->Kapasitas_Produksi->EditValue = HtmlEncode($this->Kapasitas_Produksi->CurrentValue);
            $this->Kapasitas_Produksi->PlaceHolder = RemoveHtml($this->Kapasitas_Produksi->caption());

            // Pengalaman_Ekspor
            $this->Pengalaman_Ekspor->EditAttrs["class"] = "form-control";
            $this->Pengalaman_Ekspor->EditCustomAttributes = "";
            $this->Pengalaman_Ekspor->EditValue = HtmlEncode($this->Pengalaman_Ekspor->CurrentValue);
            $this->Pengalaman_Ekspor->PlaceHolder = RemoveHtml($this->Pengalaman_Ekspor->caption());

            // ekspor_ke_negara_mana
            $this->ekspor_ke_negara_mana->EditAttrs["class"] = "form-control";
            $this->ekspor_ke_negara_mana->EditCustomAttributes = "";
            $this->ekspor_ke_negara_mana->EditValue = HtmlEncode($this->ekspor_ke_negara_mana->CurrentValue);
            $this->ekspor_ke_negara_mana->PlaceHolder = RemoveHtml($this->ekspor_ke_negara_mana->caption());

            // mengikuti_pelatihan_sebelumnya
            $this->mengikuti_pelatihan_sebelumnya->EditAttrs["class"] = "form-control";
            $this->mengikuti_pelatihan_sebelumnya->EditCustomAttributes = "";
            $this->mengikuti_pelatihan_sebelumnya->EditValue = HtmlEncode($this->mengikuti_pelatihan_sebelumnya->CurrentValue);
            $this->mengikuti_pelatihan_sebelumnya->PlaceHolder = RemoveHtml($this->mengikuti_pelatihan_sebelumnya->caption());

            // pelatihan_apa_dimana
            $this->pelatihan_apa_dimana->EditAttrs["class"] = "form-control";
            $this->pelatihan_apa_dimana->EditCustomAttributes = "";
            $this->pelatihan_apa_dimana->EditValue = HtmlEncode($this->pelatihan_apa_dimana->CurrentValue);
            $this->pelatihan_apa_dimana->PlaceHolder = RemoveHtml($this->pelatihan_apa_dimana->caption());

            // mendapatkan_informasi
            $this->mendapatkan_informasi->EditAttrs["class"] = "form-control";
            $this->mendapatkan_informasi->EditCustomAttributes = "";
            $this->mendapatkan_informasi->EditValue = HtmlEncode($this->mendapatkan_informasi->CurrentValue);
            $this->mendapatkan_informasi->PlaceHolder = RemoveHtml($this->mendapatkan_informasi->caption());

            // harapkan_dari_pelatihan
            $this->harapkan_dari_pelatihan->EditAttrs["class"] = "form-control";
            $this->harapkan_dari_pelatihan->EditCustomAttributes = "";
            $this->harapkan_dari_pelatihan->EditValue = HtmlEncode($this->harapkan_dari_pelatihan->CurrentValue);
            $this->harapkan_dari_pelatihan->PlaceHolder = RemoveHtml($this->harapkan_dari_pelatihan->caption());

            // data_diisi_benar
            $this->data_diisi_benar->EditAttrs["class"] = "form-control";
            $this->data_diisi_benar->EditCustomAttributes = "";
            $this->data_diisi_benar->EditValue = HtmlEncode($this->data_diisi_benar->CurrentValue);
            $this->data_diisi_benar->PlaceHolder = RemoveHtml($this->data_diisi_benar->caption());

            // Add refer script

            // dipindahkan
            $this->dipindahkan->LinkCustomAttributes = "";
            $this->dipindahkan->HrefValue = "";

            // kdpelat
            $this->kdpelat->LinkCustomAttributes = "";
            $this->kdpelat->HrefValue = "";

            // Email_Address
            $this->Email_Address->LinkCustomAttributes = "";
            $this->Email_Address->HrefValue = "";

            // Nama_Lengkap
            $this->Nama_Lengkap->LinkCustomAttributes = "";
            $this->Nama_Lengkap->HrefValue = "";

            // Nomor_Handphone
            $this->Nomor_Handphone->LinkCustomAttributes = "";
            $this->Nomor_Handphone->HrefValue = "";

            // Jenis_Kelamin
            $this->Jenis_Kelamin->LinkCustomAttributes = "";
            $this->Jenis_Kelamin->HrefValue = "";

            // Tempat_Lahir
            $this->Tempat_Lahir->LinkCustomAttributes = "";
            $this->Tempat_Lahir->HrefValue = "";

            // Tanggal_Lahir
            $this->Tanggal_Lahir->LinkCustomAttributes = "";
            $this->Tanggal_Lahir->HrefValue = "";

            // Alamat_Tinggal
            $this->Alamat_Tinggal->LinkCustomAttributes = "";
            $this->Alamat_Tinggal->HrefValue = "";

            // Provinsi
            $this->Provinsi->LinkCustomAttributes = "";
            $this->Provinsi->HrefValue = "";

            // Kabupaten_Kota
            $this->Kabupaten_Kota->LinkCustomAttributes = "";
            $this->Kabupaten_Kota->HrefValue = "";

            // Jabatan_di_Perusahaan
            $this->Jabatan_di_Perusahaan->LinkCustomAttributes = "";
            $this->Jabatan_di_Perusahaan->HrefValue = "";

            // Pendidikan
            $this->Pendidikan->LinkCustomAttributes = "";
            $this->Pendidikan->HrefValue = "";

            // Nama_Perusahaan_Instansi
            $this->Nama_Perusahaan_Instansi->LinkCustomAttributes = "";
            $this->Nama_Perusahaan_Instansi->HrefValue = "";

            // Contact_Person_Perusahaan
            $this->Contact_Person_Perusahaan->LinkCustomAttributes = "";
            $this->Contact_Person_Perusahaan->HrefValue = "";

            // Telepon_Kantor
            $this->Telepon_Kantor->LinkCustomAttributes = "";
            $this->Telepon_Kantor->HrefValue = "";

            // Email
            $this->_Email->LinkCustomAttributes = "";
            $this->_Email->HrefValue = "";

            // Website
            $this->Website->LinkCustomAttributes = "";
            $this->Website->HrefValue = "";

            // Alamat_Kantor
            $this->Alamat_Kantor->LinkCustomAttributes = "";
            $this->Alamat_Kantor->HrefValue = "";

            // Provinsi2
            $this->Provinsi2->LinkCustomAttributes = "";
            $this->Provinsi2->HrefValue = "";

            // Kabupaten_Kota2
            $this->Kabupaten_Kota2->LinkCustomAttributes = "";
            $this->Kabupaten_Kota2->HrefValue = "";

            // ID_Sosial_Media
            $this->ID_Sosial_Media->LinkCustomAttributes = "";
            $this->ID_Sosial_Media->HrefValue = "";

            // Kategori_perusahaan
            $this->Kategori_perusahaan->LinkCustomAttributes = "";
            $this->Kategori_perusahaan->HrefValue = "";

            // Jenis_Usaha
            $this->Jenis_Usaha->LinkCustomAttributes = "";
            $this->Jenis_Usaha->HrefValue = "";

            // Skala_Perusahaan
            $this->Skala_Perusahaan->LinkCustomAttributes = "";
            $this->Skala_Perusahaan->HrefValue = "";

            // Kategori_Produk
            $this->Kategori_Produk->LinkCustomAttributes = "";
            $this->Kategori_Produk->HrefValue = "";

            // Produk_Perusahaan
            $this->Produk_Perusahaan->LinkCustomAttributes = "";
            $this->Produk_Perusahaan->HrefValue = "";

            // HS_Code_Product
            $this->HS_Code_Product->LinkCustomAttributes = "";
            $this->HS_Code_Product->HrefValue = "";

            // Omset_Perusahaan
            $this->Omset_Perusahaan->LinkCustomAttributes = "";
            $this->Omset_Perusahaan->HrefValue = "";

            // Kapasitas_Produksi
            $this->Kapasitas_Produksi->LinkCustomAttributes = "";
            $this->Kapasitas_Produksi->HrefValue = "";

            // Pengalaman_Ekspor
            $this->Pengalaman_Ekspor->LinkCustomAttributes = "";
            $this->Pengalaman_Ekspor->HrefValue = "";

            // ekspor_ke_negara_mana
            $this->ekspor_ke_negara_mana->LinkCustomAttributes = "";
            $this->ekspor_ke_negara_mana->HrefValue = "";

            // mengikuti_pelatihan_sebelumnya
            $this->mengikuti_pelatihan_sebelumnya->LinkCustomAttributes = "";
            $this->mengikuti_pelatihan_sebelumnya->HrefValue = "";

            // pelatihan_apa_dimana
            $this->pelatihan_apa_dimana->LinkCustomAttributes = "";
            $this->pelatihan_apa_dimana->HrefValue = "";

            // mendapatkan_informasi
            $this->mendapatkan_informasi->LinkCustomAttributes = "";
            $this->mendapatkan_informasi->HrefValue = "";

            // harapkan_dari_pelatihan
            $this->harapkan_dari_pelatihan->LinkCustomAttributes = "";
            $this->harapkan_dari_pelatihan->HrefValue = "";

            // data_diisi_benar
            $this->data_diisi_benar->LinkCustomAttributes = "";
            $this->data_diisi_benar->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->dipindahkan->Required) {
            if ($this->dipindahkan->FormValue == "") {
                $this->dipindahkan->addErrorMessage(str_replace("%s", $this->dipindahkan->caption(), $this->dipindahkan->RequiredErrorMessage));
            }
        }
        if ($this->kdpelat->Required) {
            if (!$this->kdpelat->IsDetailKey && EmptyValue($this->kdpelat->FormValue)) {
                $this->kdpelat->addErrorMessage(str_replace("%s", $this->kdpelat->caption(), $this->kdpelat->RequiredErrorMessage));
            }
        }
        if ($this->Email_Address->Required) {
            if (!$this->Email_Address->IsDetailKey && EmptyValue($this->Email_Address->FormValue)) {
                $this->Email_Address->addErrorMessage(str_replace("%s", $this->Email_Address->caption(), $this->Email_Address->RequiredErrorMessage));
            }
        }
        if ($this->Nama_Lengkap->Required) {
            if (!$this->Nama_Lengkap->IsDetailKey && EmptyValue($this->Nama_Lengkap->FormValue)) {
                $this->Nama_Lengkap->addErrorMessage(str_replace("%s", $this->Nama_Lengkap->caption(), $this->Nama_Lengkap->RequiredErrorMessage));
            }
        }
        if ($this->Nomor_Handphone->Required) {
            if (!$this->Nomor_Handphone->IsDetailKey && EmptyValue($this->Nomor_Handphone->FormValue)) {
                $this->Nomor_Handphone->addErrorMessage(str_replace("%s", $this->Nomor_Handphone->caption(), $this->Nomor_Handphone->RequiredErrorMessage));
            }
        }
        if ($this->Jenis_Kelamin->Required) {
            if (!$this->Jenis_Kelamin->IsDetailKey && EmptyValue($this->Jenis_Kelamin->FormValue)) {
                $this->Jenis_Kelamin->addErrorMessage(str_replace("%s", $this->Jenis_Kelamin->caption(), $this->Jenis_Kelamin->RequiredErrorMessage));
            }
        }
        if ($this->Tempat_Lahir->Required) {
            if (!$this->Tempat_Lahir->IsDetailKey && EmptyValue($this->Tempat_Lahir->FormValue)) {
                $this->Tempat_Lahir->addErrorMessage(str_replace("%s", $this->Tempat_Lahir->caption(), $this->Tempat_Lahir->RequiredErrorMessage));
            }
        }
        if ($this->Tanggal_Lahir->Required) {
            if (!$this->Tanggal_Lahir->IsDetailKey && EmptyValue($this->Tanggal_Lahir->FormValue)) {
                $this->Tanggal_Lahir->addErrorMessage(str_replace("%s", $this->Tanggal_Lahir->caption(), $this->Tanggal_Lahir->RequiredErrorMessage));
            }
        }
        if ($this->Alamat_Tinggal->Required) {
            if (!$this->Alamat_Tinggal->IsDetailKey && EmptyValue($this->Alamat_Tinggal->FormValue)) {
                $this->Alamat_Tinggal->addErrorMessage(str_replace("%s", $this->Alamat_Tinggal->caption(), $this->Alamat_Tinggal->RequiredErrorMessage));
            }
        }
        if ($this->Provinsi->Required) {
            if (!$this->Provinsi->IsDetailKey && EmptyValue($this->Provinsi->FormValue)) {
                $this->Provinsi->addErrorMessage(str_replace("%s", $this->Provinsi->caption(), $this->Provinsi->RequiredErrorMessage));
            }
        }
        if ($this->Kabupaten_Kota->Required) {
            if (!$this->Kabupaten_Kota->IsDetailKey && EmptyValue($this->Kabupaten_Kota->FormValue)) {
                $this->Kabupaten_Kota->addErrorMessage(str_replace("%s", $this->Kabupaten_Kota->caption(), $this->Kabupaten_Kota->RequiredErrorMessage));
            }
        }
        if ($this->Jabatan_di_Perusahaan->Required) {
            if (!$this->Jabatan_di_Perusahaan->IsDetailKey && EmptyValue($this->Jabatan_di_Perusahaan->FormValue)) {
                $this->Jabatan_di_Perusahaan->addErrorMessage(str_replace("%s", $this->Jabatan_di_Perusahaan->caption(), $this->Jabatan_di_Perusahaan->RequiredErrorMessage));
            }
        }
        if ($this->Pendidikan->Required) {
            if (!$this->Pendidikan->IsDetailKey && EmptyValue($this->Pendidikan->FormValue)) {
                $this->Pendidikan->addErrorMessage(str_replace("%s", $this->Pendidikan->caption(), $this->Pendidikan->RequiredErrorMessage));
            }
        }
        if ($this->Nama_Perusahaan_Instansi->Required) {
            if (!$this->Nama_Perusahaan_Instansi->IsDetailKey && EmptyValue($this->Nama_Perusahaan_Instansi->FormValue)) {
                $this->Nama_Perusahaan_Instansi->addErrorMessage(str_replace("%s", $this->Nama_Perusahaan_Instansi->caption(), $this->Nama_Perusahaan_Instansi->RequiredErrorMessage));
            }
        }
        if ($this->Contact_Person_Perusahaan->Required) {
            if (!$this->Contact_Person_Perusahaan->IsDetailKey && EmptyValue($this->Contact_Person_Perusahaan->FormValue)) {
                $this->Contact_Person_Perusahaan->addErrorMessage(str_replace("%s", $this->Contact_Person_Perusahaan->caption(), $this->Contact_Person_Perusahaan->RequiredErrorMessage));
            }
        }
        if ($this->Telepon_Kantor->Required) {
            if (!$this->Telepon_Kantor->IsDetailKey && EmptyValue($this->Telepon_Kantor->FormValue)) {
                $this->Telepon_Kantor->addErrorMessage(str_replace("%s", $this->Telepon_Kantor->caption(), $this->Telepon_Kantor->RequiredErrorMessage));
            }
        }
        if ($this->_Email->Required) {
            if (!$this->_Email->IsDetailKey && EmptyValue($this->_Email->FormValue)) {
                $this->_Email->addErrorMessage(str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
            }
        }
        if ($this->Website->Required) {
            if (!$this->Website->IsDetailKey && EmptyValue($this->Website->FormValue)) {
                $this->Website->addErrorMessage(str_replace("%s", $this->Website->caption(), $this->Website->RequiredErrorMessage));
            }
        }
        if ($this->Alamat_Kantor->Required) {
            if (!$this->Alamat_Kantor->IsDetailKey && EmptyValue($this->Alamat_Kantor->FormValue)) {
                $this->Alamat_Kantor->addErrorMessage(str_replace("%s", $this->Alamat_Kantor->caption(), $this->Alamat_Kantor->RequiredErrorMessage));
            }
        }
        if ($this->Provinsi2->Required) {
            if (!$this->Provinsi2->IsDetailKey && EmptyValue($this->Provinsi2->FormValue)) {
                $this->Provinsi2->addErrorMessage(str_replace("%s", $this->Provinsi2->caption(), $this->Provinsi2->RequiredErrorMessage));
            }
        }
        if ($this->Kabupaten_Kota2->Required) {
            if (!$this->Kabupaten_Kota2->IsDetailKey && EmptyValue($this->Kabupaten_Kota2->FormValue)) {
                $this->Kabupaten_Kota2->addErrorMessage(str_replace("%s", $this->Kabupaten_Kota2->caption(), $this->Kabupaten_Kota2->RequiredErrorMessage));
            }
        }
        if ($this->ID_Sosial_Media->Required) {
            if (!$this->ID_Sosial_Media->IsDetailKey && EmptyValue($this->ID_Sosial_Media->FormValue)) {
                $this->ID_Sosial_Media->addErrorMessage(str_replace("%s", $this->ID_Sosial_Media->caption(), $this->ID_Sosial_Media->RequiredErrorMessage));
            }
        }
        if ($this->Kategori_perusahaan->Required) {
            if (!$this->Kategori_perusahaan->IsDetailKey && EmptyValue($this->Kategori_perusahaan->FormValue)) {
                $this->Kategori_perusahaan->addErrorMessage(str_replace("%s", $this->Kategori_perusahaan->caption(), $this->Kategori_perusahaan->RequiredErrorMessage));
            }
        }
        if ($this->Jenis_Usaha->Required) {
            if (!$this->Jenis_Usaha->IsDetailKey && EmptyValue($this->Jenis_Usaha->FormValue)) {
                $this->Jenis_Usaha->addErrorMessage(str_replace("%s", $this->Jenis_Usaha->caption(), $this->Jenis_Usaha->RequiredErrorMessage));
            }
        }
        if ($this->Skala_Perusahaan->Required) {
            if (!$this->Skala_Perusahaan->IsDetailKey && EmptyValue($this->Skala_Perusahaan->FormValue)) {
                $this->Skala_Perusahaan->addErrorMessage(str_replace("%s", $this->Skala_Perusahaan->caption(), $this->Skala_Perusahaan->RequiredErrorMessage));
            }
        }
        if ($this->Kategori_Produk->Required) {
            if (!$this->Kategori_Produk->IsDetailKey && EmptyValue($this->Kategori_Produk->FormValue)) {
                $this->Kategori_Produk->addErrorMessage(str_replace("%s", $this->Kategori_Produk->caption(), $this->Kategori_Produk->RequiredErrorMessage));
            }
        }
        if ($this->Produk_Perusahaan->Required) {
            if (!$this->Produk_Perusahaan->IsDetailKey && EmptyValue($this->Produk_Perusahaan->FormValue)) {
                $this->Produk_Perusahaan->addErrorMessage(str_replace("%s", $this->Produk_Perusahaan->caption(), $this->Produk_Perusahaan->RequiredErrorMessage));
            }
        }
        if ($this->HS_Code_Product->Required) {
            if (!$this->HS_Code_Product->IsDetailKey && EmptyValue($this->HS_Code_Product->FormValue)) {
                $this->HS_Code_Product->addErrorMessage(str_replace("%s", $this->HS_Code_Product->caption(), $this->HS_Code_Product->RequiredErrorMessage));
            }
        }
        if ($this->Omset_Perusahaan->Required) {
            if (!$this->Omset_Perusahaan->IsDetailKey && EmptyValue($this->Omset_Perusahaan->FormValue)) {
                $this->Omset_Perusahaan->addErrorMessage(str_replace("%s", $this->Omset_Perusahaan->caption(), $this->Omset_Perusahaan->RequiredErrorMessage));
            }
        }
        if ($this->Kapasitas_Produksi->Required) {
            if (!$this->Kapasitas_Produksi->IsDetailKey && EmptyValue($this->Kapasitas_Produksi->FormValue)) {
                $this->Kapasitas_Produksi->addErrorMessage(str_replace("%s", $this->Kapasitas_Produksi->caption(), $this->Kapasitas_Produksi->RequiredErrorMessage));
            }
        }
        if ($this->Pengalaman_Ekspor->Required) {
            if (!$this->Pengalaman_Ekspor->IsDetailKey && EmptyValue($this->Pengalaman_Ekspor->FormValue)) {
                $this->Pengalaman_Ekspor->addErrorMessage(str_replace("%s", $this->Pengalaman_Ekspor->caption(), $this->Pengalaman_Ekspor->RequiredErrorMessage));
            }
        }
        if ($this->ekspor_ke_negara_mana->Required) {
            if (!$this->ekspor_ke_negara_mana->IsDetailKey && EmptyValue($this->ekspor_ke_negara_mana->FormValue)) {
                $this->ekspor_ke_negara_mana->addErrorMessage(str_replace("%s", $this->ekspor_ke_negara_mana->caption(), $this->ekspor_ke_negara_mana->RequiredErrorMessage));
            }
        }
        if ($this->mengikuti_pelatihan_sebelumnya->Required) {
            if (!$this->mengikuti_pelatihan_sebelumnya->IsDetailKey && EmptyValue($this->mengikuti_pelatihan_sebelumnya->FormValue)) {
                $this->mengikuti_pelatihan_sebelumnya->addErrorMessage(str_replace("%s", $this->mengikuti_pelatihan_sebelumnya->caption(), $this->mengikuti_pelatihan_sebelumnya->RequiredErrorMessage));
            }
        }
        if ($this->pelatihan_apa_dimana->Required) {
            if (!$this->pelatihan_apa_dimana->IsDetailKey && EmptyValue($this->pelatihan_apa_dimana->FormValue)) {
                $this->pelatihan_apa_dimana->addErrorMessage(str_replace("%s", $this->pelatihan_apa_dimana->caption(), $this->pelatihan_apa_dimana->RequiredErrorMessage));
            }
        }
        if ($this->mendapatkan_informasi->Required) {
            if (!$this->mendapatkan_informasi->IsDetailKey && EmptyValue($this->mendapatkan_informasi->FormValue)) {
                $this->mendapatkan_informasi->addErrorMessage(str_replace("%s", $this->mendapatkan_informasi->caption(), $this->mendapatkan_informasi->RequiredErrorMessage));
            }
        }
        if ($this->harapkan_dari_pelatihan->Required) {
            if (!$this->harapkan_dari_pelatihan->IsDetailKey && EmptyValue($this->harapkan_dari_pelatihan->FormValue)) {
                $this->harapkan_dari_pelatihan->addErrorMessage(str_replace("%s", $this->harapkan_dari_pelatihan->caption(), $this->harapkan_dari_pelatihan->RequiredErrorMessage));
            }
        }
        if ($this->data_diisi_benar->Required) {
            if (!$this->data_diisi_benar->IsDetailKey && EmptyValue($this->data_diisi_benar->FormValue)) {
                $this->data_diisi_benar->addErrorMessage(str_replace("%s", $this->data_diisi_benar->caption(), $this->data_diisi_benar->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // dipindahkan
        $tmpBool = $this->dipindahkan->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->dipindahkan->setDbValueDef($rsnew, $tmpBool, 0, strval($this->dipindahkan->CurrentValue) == "");

        // kdpelat
        $this->kdpelat->setDbValueDef($rsnew, $this->kdpelat->CurrentValue, null, false);

        // Email_Address
        $this->Email_Address->setDbValueDef($rsnew, $this->Email_Address->CurrentValue, null, false);

        // Nama_Lengkap
        $this->Nama_Lengkap->setDbValueDef($rsnew, $this->Nama_Lengkap->CurrentValue, null, false);

        // Nomor_Handphone
        $this->Nomor_Handphone->setDbValueDef($rsnew, $this->Nomor_Handphone->CurrentValue, null, false);

        // Jenis_Kelamin
        $this->Jenis_Kelamin->setDbValueDef($rsnew, $this->Jenis_Kelamin->CurrentValue, null, false);

        // Tempat_Lahir
        $this->Tempat_Lahir->setDbValueDef($rsnew, $this->Tempat_Lahir->CurrentValue, null, false);

        // Tanggal_Lahir
        $this->Tanggal_Lahir->setDbValueDef($rsnew, $this->Tanggal_Lahir->CurrentValue, null, false);

        // Alamat_Tinggal
        $this->Alamat_Tinggal->setDbValueDef($rsnew, $this->Alamat_Tinggal->CurrentValue, null, false);

        // Provinsi
        $this->Provinsi->setDbValueDef($rsnew, $this->Provinsi->CurrentValue, null, false);

        // Kabupaten_Kota
        $this->Kabupaten_Kota->setDbValueDef($rsnew, $this->Kabupaten_Kota->CurrentValue, null, false);

        // Jabatan_di_Perusahaan
        $this->Jabatan_di_Perusahaan->setDbValueDef($rsnew, $this->Jabatan_di_Perusahaan->CurrentValue, null, false);

        // Pendidikan
        $this->Pendidikan->setDbValueDef($rsnew, $this->Pendidikan->CurrentValue, null, false);

        // Nama_Perusahaan_Instansi
        $this->Nama_Perusahaan_Instansi->setDbValueDef($rsnew, $this->Nama_Perusahaan_Instansi->CurrentValue, null, false);

        // Contact_Person_Perusahaan
        $this->Contact_Person_Perusahaan->setDbValueDef($rsnew, $this->Contact_Person_Perusahaan->CurrentValue, null, false);

        // Telepon_Kantor
        $this->Telepon_Kantor->setDbValueDef($rsnew, $this->Telepon_Kantor->CurrentValue, null, false);

        // Email
        $this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, null, false);

        // Website
        $this->Website->setDbValueDef($rsnew, $this->Website->CurrentValue, null, false);

        // Alamat_Kantor
        $this->Alamat_Kantor->setDbValueDef($rsnew, $this->Alamat_Kantor->CurrentValue, null, false);

        // Provinsi2
        $this->Provinsi2->setDbValueDef($rsnew, $this->Provinsi2->CurrentValue, null, false);

        // Kabupaten_Kota2
        $this->Kabupaten_Kota2->setDbValueDef($rsnew, $this->Kabupaten_Kota2->CurrentValue, null, false);

        // ID_Sosial_Media
        $this->ID_Sosial_Media->setDbValueDef($rsnew, $this->ID_Sosial_Media->CurrentValue, null, false);

        // Kategori_perusahaan
        $this->Kategori_perusahaan->setDbValueDef($rsnew, $this->Kategori_perusahaan->CurrentValue, null, false);

        // Jenis_Usaha
        $this->Jenis_Usaha->setDbValueDef($rsnew, $this->Jenis_Usaha->CurrentValue, null, false);

        // Skala_Perusahaan
        $this->Skala_Perusahaan->setDbValueDef($rsnew, $this->Skala_Perusahaan->CurrentValue, null, false);

        // Kategori_Produk
        $this->Kategori_Produk->setDbValueDef($rsnew, $this->Kategori_Produk->CurrentValue, null, false);

        // Produk_Perusahaan
        $this->Produk_Perusahaan->setDbValueDef($rsnew, $this->Produk_Perusahaan->CurrentValue, null, false);

        // HS_Code_Product
        $this->HS_Code_Product->setDbValueDef($rsnew, $this->HS_Code_Product->CurrentValue, null, false);

        // Omset_Perusahaan
        $this->Omset_Perusahaan->setDbValueDef($rsnew, $this->Omset_Perusahaan->CurrentValue, null, false);

        // Kapasitas_Produksi
        $this->Kapasitas_Produksi->setDbValueDef($rsnew, $this->Kapasitas_Produksi->CurrentValue, null, false);

        // Pengalaman_Ekspor
        $this->Pengalaman_Ekspor->setDbValueDef($rsnew, $this->Pengalaman_Ekspor->CurrentValue, null, false);

        // ekspor_ke_negara_mana
        $this->ekspor_ke_negara_mana->setDbValueDef($rsnew, $this->ekspor_ke_negara_mana->CurrentValue, null, false);

        // mengikuti_pelatihan_sebelumnya
        $this->mengikuti_pelatihan_sebelumnya->setDbValueDef($rsnew, $this->mengikuti_pelatihan_sebelumnya->CurrentValue, null, false);

        // pelatihan_apa_dimana
        $this->pelatihan_apa_dimana->setDbValueDef($rsnew, $this->pelatihan_apa_dimana->CurrentValue, null, false);

        // mendapatkan_informasi
        $this->mendapatkan_informasi->setDbValueDef($rsnew, $this->mendapatkan_informasi->CurrentValue, null, false);

        // harapkan_dari_pelatihan
        $this->harapkan_dari_pelatihan->setDbValueDef($rsnew, $this->harapkan_dari_pelatihan->CurrentValue, null, false);

        // data_diisi_benar
        $this->data_diisi_benar->setDbValueDef($rsnew, $this->data_diisi_benar->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        $addRow = false;
        if ($insertRow) {
            try {
                $addRow = $this->insert($rsnew);
            } catch (\Exception $e) {
                $this->setFailureMessage($e->getMessage());
            }
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
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("datamasterlist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
}
