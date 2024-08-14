<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for Perusahaan
 */
class Perusahaan extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $idp;
    public $namap;
    public $kontak;
    public $alamatp;
    public $kdprop;
    public $kdkota;
    public $emailp;
    public $webp;
    public $medsos;
    public $kdproduknafed;
    public $pproduk;
    public $kdskala;
    public $kdjenis;
    public $kdexport;
    public $nexport;
    public $kdkategori;
    public $omzet_saat_ini;
    public $kapasitas_saat_ini;
    public $hscode;
    public $created_at;
    public $imp;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'Perusahaan';
        $this->TableName = 'Perusahaan';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "t_perusahaan";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // idp
        $this->idp = new DbField('Perusahaan', 'Perusahaan', 'x_idp', 'idp', 't_perusahaan.idp', 't_perusahaan.idp', 3, 11, -1, false, 't_perusahaan.idp', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->idp->IsAutoIncrement = true; // Autoincrement field
        $this->idp->Sortable = true; // Allow sort
        $this->idp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->idp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idp->Param, "CustomMsg");
        $this->Fields['idp'] = &$this->idp;

        // namap
        $this->namap = new DbField('Perusahaan', 'Perusahaan', 'x_namap', 'namap', 't_perusahaan.namap', 't_perusahaan.namap', 200, 150, -1, false, 't_perusahaan.namap', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->namap->Sortable = true; // Allow sort
        $this->namap->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->namap->Param, "CustomMsg");
        $this->Fields['namap'] = &$this->namap;

        // kontak
        $this->kontak = new DbField('Perusahaan', 'Perusahaan', 'x_kontak', 'kontak', 't_perusahaan.kontak', 't_perusahaan.kontak', 200, 100, -1, false, 't_perusahaan.kontak', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kontak->Sortable = true; // Allow sort
        $this->kontak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kontak->Param, "CustomMsg");
        $this->Fields['kontak'] = &$this->kontak;

        // alamatp
        $this->alamatp = new DbField('Perusahaan', 'Perusahaan', 'x_alamatp', 'alamatp', 't_perusahaan.alamatp', 't_perusahaan.alamatp', 201, 65535, -1, false, 't_perusahaan.alamatp', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->alamatp->Sortable = true; // Allow sort
        $this->alamatp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamatp->Param, "CustomMsg");
        $this->Fields['alamatp'] = &$this->alamatp;

        // kdprop
        $this->kdprop = new DbField('Perusahaan', 'Perusahaan', 'x_kdprop', 'kdprop', 't_perusahaan.kdprop', 't_perusahaan.kdprop', 3, 11, -1, false, 't_perusahaan.kdprop', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdprop->Sortable = true; // Allow sort
        $this->kdprop->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdprop->Lookup = new Lookup('kdprop', 't_prop', false, 'kdprop', ["prop","","",""], [], [], [], [], [], [], '', '');
        $this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdprop->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdprop->Param, "CustomMsg");
        $this->Fields['kdprop'] = &$this->kdprop;

        // kdkota
        $this->kdkota = new DbField('Perusahaan', 'Perusahaan', 'x_kdkota', 'kdkota', 't_perusahaan.kdkota', 't_perusahaan.kdkota', 3, 11, -1, false, 't_perusahaan.kdkota', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdkota->Sortable = true; // Allow sort
        $this->kdkota->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdkota->Lookup = new Lookup('kdkota', 't_kota', false, 'kdkota', ["kota","","",""], [], [], [], [], [], [], '', '');
        $this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkota->Param, "CustomMsg");
        $this->Fields['kdkota'] = &$this->kdkota;

        // emailp
        $this->emailp = new DbField('Perusahaan', 'Perusahaan', 'x_emailp', 'emailp', 't_perusahaan.emailp', 't_perusahaan.emailp', 200, 100, -1, false, 't_perusahaan.emailp', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->emailp->Sortable = true; // Allow sort
        $this->emailp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->emailp->Param, "CustomMsg");
        $this->Fields['emailp'] = &$this->emailp;

        // webp
        $this->webp = new DbField('Perusahaan', 'Perusahaan', 'x_webp', 'webp', 't_perusahaan.webp', 't_perusahaan.webp', 200, 100, -1, false, 't_perusahaan.webp', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->webp->Sortable = true; // Allow sort
        $this->webp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->webp->Param, "CustomMsg");
        $this->Fields['webp'] = &$this->webp;

        // medsos
        $this->medsos = new DbField('Perusahaan', 'Perusahaan', 'x_medsos', 'medsos', 't_perusahaan.medsos', 't_perusahaan.medsos', 200, 100, -1, false, 't_perusahaan.medsos', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->medsos->Sortable = true; // Allow sort
        $this->medsos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->medsos->Param, "CustomMsg");
        $this->Fields['medsos'] = &$this->medsos;

        // kdproduknafed
        $this->kdproduknafed = new DbField('Perusahaan', 'Perusahaan', 'x_kdproduknafed', 'kdproduknafed', 't_perusahaan.kdproduknafed', 't_perusahaan.kdproduknafed', 200, 10, -1, false, 't_perusahaan.kdproduknafed', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdproduknafed->Sortable = true; // Allow sort
        $this->kdproduknafed->Lookup = new Lookup('kdproduknafed', 't_produknafed', false, 'kdproduknafed', ["produknafed","","",""], [], [], [], [], [], [], '', '');
        $this->kdproduknafed->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdproduknafed->Param, "CustomMsg");
        $this->Fields['kdproduknafed'] = &$this->kdproduknafed;

        // pproduk
        $this->pproduk = new DbField('Perusahaan', 'Perusahaan', 'x_pproduk', 'pproduk', 't_perusahaan.pproduk', 't_perusahaan.pproduk', 201, 65535, -1, false, 't_perusahaan.pproduk', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->pproduk->Sortable = true; // Allow sort
        $this->pproduk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pproduk->Param, "CustomMsg");
        $this->Fields['pproduk'] = &$this->pproduk;

        // kdskala
        $this->kdskala = new DbField('Perusahaan', 'Perusahaan', 'x_kdskala', 'kdskala', 't_perusahaan.kdskala', 't_perusahaan.kdskala', 3, 11, -1, false, 't_perusahaan.kdskala', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdskala->Sortable = true; // Allow sort
        $this->kdskala->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdskala->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdskala->Lookup = new Lookup('kdskala', 't_skala', false, 'kdskala', ["skala","","",""], [], [], [], [], [], [], '', '');
        $this->kdskala->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdskala->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdskala->Param, "CustomMsg");
        $this->Fields['kdskala'] = &$this->kdskala;

        // kdjenis
        $this->kdjenis = new DbField('Perusahaan', 'Perusahaan', 'x_kdjenis', 'kdjenis', 't_perusahaan.kdjenis', 't_perusahaan.kdjenis', 3, 11, -1, false, 't_perusahaan.kdjenis', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdjenis->Sortable = true; // Allow sort
        $this->kdjenis->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdjenis->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdjenis->Lookup = new Lookup('kdjenis', 't_jenis', false, 'kdjenis', ["jenis","","",""], [], [], [], [], [], [], '', '');
        $this->kdjenis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdjenis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdjenis->Param, "CustomMsg");
        $this->Fields['kdjenis'] = &$this->kdjenis;

        // kdexport
        $this->kdexport = new DbField('Perusahaan', 'Perusahaan', 'x_kdexport', 'kdexport', 't_perusahaan.kdexport', 't_perusahaan.kdexport', 3, 11, -1, false, 't_perusahaan.kdexport', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdexport->Sortable = true; // Allow sort
        $this->kdexport->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdexport->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdexport->Lookup = new Lookup('kdexport', 't_export', false, 'kdexport', ["export","","",""], [], [], [], [], [], [], '', '');
        $this->kdexport->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdexport->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdexport->Param, "CustomMsg");
        $this->Fields['kdexport'] = &$this->kdexport;

        // nexport
        $this->nexport = new DbField('Perusahaan', 'Perusahaan', 'x_nexport', 'nexport', 't_perusahaan.nexport', 't_perusahaan.nexport', 201, 65535, -1, false, 't_perusahaan.nexport', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->nexport->Sortable = true; // Allow sort
        $this->nexport->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nexport->Param, "CustomMsg");
        $this->Fields['nexport'] = &$this->nexport;

        // kdkategori
        $this->kdkategori = new DbField('Perusahaan', 'Perusahaan', 'x_kdkategori', 'kdkategori', 't_perusahaan.kdkategori', 't_perusahaan.kdkategori', 3, 11, -1, false, 't_perusahaan.kdkategori', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdkategori->Sortable = true; // Allow sort
        $this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', false, 'kdkategori', ["kategori","","",""], [], [], [], [], [], [], '', '');
        $this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkategori->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkategori->Param, "CustomMsg");
        $this->Fields['kdkategori'] = &$this->kdkategori;

        // omzet_saat_ini
        $this->omzet_saat_ini = new DbField('Perusahaan', 'Perusahaan', 'x_omzet_saat_ini', 'omzet_saat_ini', 't_perusahaan.omzet_saat_ini', 't_perusahaan.omzet_saat_ini', 200, 100, -1, false, 't_perusahaan.omzet_saat_ini', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->omzet_saat_ini->Sortable = true; // Allow sort
        $this->omzet_saat_ini->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->omzet_saat_ini->Param, "CustomMsg");
        $this->Fields['omzet_saat_ini'] = &$this->omzet_saat_ini;

        // kapasitas_saat_ini
        $this->kapasitas_saat_ini = new DbField('Perusahaan', 'Perusahaan', 'x_kapasitas_saat_ini', 'kapasitas_saat_ini', 't_perusahaan.kapasitas_saat_ini', 't_perusahaan.kapasitas_saat_ini', 200, 100, -1, false, 't_perusahaan.kapasitas_saat_ini', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapasitas_saat_ini->Sortable = true; // Allow sort
        $this->kapasitas_saat_ini->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapasitas_saat_ini->Param, "CustomMsg");
        $this->Fields['kapasitas_saat_ini'] = &$this->kapasitas_saat_ini;

        // hscode
        $this->hscode = new DbField('Perusahaan', 'Perusahaan', 'x_hscode', 'hscode', 't_perusahaan.hscode', 't_perusahaan.hscode', 201, 65535, -1, false, 't_perusahaan.hscode', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->hscode->Sortable = true; // Allow sort
        $this->hscode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hscode->Param, "CustomMsg");
        $this->Fields['hscode'] = &$this->hscode;

        // created_at
        $this->created_at = new DbField('Perusahaan', 'Perusahaan', 'x_created_at', 'created_at', 't_perusahaan.created_at', CastDateFieldForLike("t_perusahaan.created_at", 0, "DB"), 135, 19, 0, false, 't_perusahaan.created_at', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->created_at->Sortable = true; // Allow sort
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_at->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->created_at->Param, "CustomMsg");
        $this->Fields['created_at'] = &$this->created_at;

        // imp
        $this->imp = new DbField('Perusahaan', 'Perusahaan', 'x_imp', 'imp', 't_perusahaan.imp', 't_perusahaan.imp', 16, 4, -1, false, 't_perusahaan.imp', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->imp->Nullable = false; // NOT NULL field
        $this->imp->Required = true; // Required field
        $this->imp->Sortable = true; // Allow sort
        $this->imp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->imp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->imp->Param, "CustomMsg");
        $this->Fields['imp'] = &$this->imp;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "t_perusahaan";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("t_perusahaan.idp, t_perusahaan.namap, t_perusahaan.kontak, t_perusahaan.alamatp, t_perusahaan.kdprop, t_perusahaan.kdkota, t_perusahaan.emailp, t_perusahaan.webp, t_perusahaan.medsos, t_perusahaan.kdproduknafed, t_perusahaan.pproduk, t_perusahaan.kdskala, t_perusahaan.kdjenis, t_perusahaan.kdexport, t_perusahaan.nexport, t_perusahaan.kdkategori, t_perusahaan.omzet_saat_ini, t_perusahaan.kapasitas_saat_ini, t_perusahaan.hscode, t_perusahaan.imp, t_perusahaan.created_at");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "t_perusahaan.imp = 1";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->idp->setDbValue($conn->lastInsertId());
            $rs['idp'] = $this->idp->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->idp->DbValue = $row['idp'];
        $this->namap->DbValue = $row['namap'];
        $this->kontak->DbValue = $row['kontak'];
        $this->alamatp->DbValue = $row['alamatp'];
        $this->kdprop->DbValue = $row['kdprop'];
        $this->kdkota->DbValue = $row['kdkota'];
        $this->emailp->DbValue = $row['emailp'];
        $this->webp->DbValue = $row['webp'];
        $this->medsos->DbValue = $row['medsos'];
        $this->kdproduknafed->DbValue = $row['kdproduknafed'];
        $this->pproduk->DbValue = $row['pproduk'];
        $this->kdskala->DbValue = $row['kdskala'];
        $this->kdjenis->DbValue = $row['kdjenis'];
        $this->kdexport->DbValue = $row['kdexport'];
        $this->nexport->DbValue = $row['nexport'];
        $this->kdkategori->DbValue = $row['kdkategori'];
        $this->omzet_saat_ini->DbValue = $row['omzet_saat_ini'];
        $this->kapasitas_saat_ini->DbValue = $row['kapasitas_saat_ini'];
        $this->hscode->DbValue = $row['hscode'];
        $this->created_at->DbValue = $row['created_at'];
        $this->imp->DbValue = $row['imp'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("perusahaanlist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "perusahaanview") {
            return $Language->phrase("View");
        } elseif ($pageName == "perusahaanedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "perusahaanadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "PerusahaanView";
            case Config("API_ADD_ACTION"):
                return "PerusahaanAdd";
            case Config("API_EDIT_ACTION"):
                return "PerusahaanEdit";
            case Config("API_DELETE_ACTION"):
                return "PerusahaanDelete";
            case Config("API_LIST_ACTION"):
                return "PerusahaanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "perusahaanlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("perusahaanview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("perusahaanview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "perusahaanadd?" . $this->getUrlParm($parm);
        } else {
            $url = "perusahaanadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("perusahaanedit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("perusahaanadd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("perusahaandelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // idp
        $this->idp->ViewValue = $this->idp->CurrentValue;
        $this->idp->ViewCustomAttributes = "";

        // namap
        $this->namap->ViewValue = $this->namap->CurrentValue;
        $this->namap->ViewCustomAttributes = "";

        // kontak
        $this->kontak->ViewValue = $this->kontak->CurrentValue;
        $this->kontak->ViewCustomAttributes = "";

        // alamatp
        $this->alamatp->ViewValue = $this->alamatp->CurrentValue;
        $this->alamatp->ViewCustomAttributes = "";

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

        // pproduk
        $this->pproduk->ViewValue = $this->pproduk->CurrentValue;
        $this->pproduk->ViewCustomAttributes = "";

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

        // nexport
        $this->nexport->ViewValue = $this->nexport->CurrentValue;
        $this->nexport->ViewCustomAttributes = "";

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

        // hscode
        $this->hscode->ViewValue = $this->hscode->CurrentValue;
        $this->hscode->ViewCustomAttributes = "";

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

        // alamatp
        $this->alamatp->LinkCustomAttributes = "";
        $this->alamatp->HrefValue = "";
        $this->alamatp->TooltipValue = "";

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

        // pproduk
        $this->pproduk->LinkCustomAttributes = "";
        $this->pproduk->HrefValue = "";
        $this->pproduk->TooltipValue = "";

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

        // nexport
        $this->nexport->LinkCustomAttributes = "";
        $this->nexport->HrefValue = "";
        $this->nexport->TooltipValue = "";

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

        // hscode
        $this->hscode->LinkCustomAttributes = "";
        $this->hscode->HrefValue = "";
        $this->hscode->TooltipValue = "";

        // created_at
        $this->created_at->LinkCustomAttributes = "";
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // imp
        $this->imp->LinkCustomAttributes = "";
        $this->imp->HrefValue = "";
        $this->imp->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // idp
        $this->idp->EditAttrs["class"] = "form-control";
        $this->idp->EditCustomAttributes = "";
        $this->idp->EditValue = $this->idp->CurrentValue;
        $this->idp->PlaceHolder = RemoveHtml($this->idp->caption());

        // namap
        $this->namap->EditAttrs["class"] = "form-control";
        $this->namap->EditCustomAttributes = "";
        if (!$this->namap->Raw) {
            $this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
        }
        $this->namap->EditValue = $this->namap->CurrentValue;
        $this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

        // kontak
        $this->kontak->EditAttrs["class"] = "form-control";
        $this->kontak->EditCustomAttributes = "";
        if (!$this->kontak->Raw) {
            $this->kontak->CurrentValue = HtmlDecode($this->kontak->CurrentValue);
        }
        $this->kontak->EditValue = $this->kontak->CurrentValue;
        $this->kontak->PlaceHolder = RemoveHtml($this->kontak->caption());

        // alamatp
        $this->alamatp->EditAttrs["class"] = "form-control";
        $this->alamatp->EditCustomAttributes = "";
        $this->alamatp->EditValue = $this->alamatp->CurrentValue;
        $this->alamatp->PlaceHolder = RemoveHtml($this->alamatp->caption());

        // kdprop
        $this->kdprop->EditAttrs["class"] = "form-control";
        $this->kdprop->EditCustomAttributes = "";
        $this->kdprop->PlaceHolder = RemoveHtml($this->kdprop->caption());

        // kdkota
        $this->kdkota->EditAttrs["class"] = "form-control";
        $this->kdkota->EditCustomAttributes = "";
        $this->kdkota->PlaceHolder = RemoveHtml($this->kdkota->caption());

        // emailp
        $this->emailp->EditAttrs["class"] = "form-control";
        $this->emailp->EditCustomAttributes = "";
        if (!$this->emailp->Raw) {
            $this->emailp->CurrentValue = HtmlDecode($this->emailp->CurrentValue);
        }
        $this->emailp->EditValue = $this->emailp->CurrentValue;
        $this->emailp->PlaceHolder = RemoveHtml($this->emailp->caption());

        // webp
        $this->webp->EditAttrs["class"] = "form-control";
        $this->webp->EditCustomAttributes = "";
        if (!$this->webp->Raw) {
            $this->webp->CurrentValue = HtmlDecode($this->webp->CurrentValue);
        }
        $this->webp->EditValue = $this->webp->CurrentValue;
        $this->webp->PlaceHolder = RemoveHtml($this->webp->caption());

        // medsos
        $this->medsos->EditAttrs["class"] = "form-control";
        $this->medsos->EditCustomAttributes = "";
        if (!$this->medsos->Raw) {
            $this->medsos->CurrentValue = HtmlDecode($this->medsos->CurrentValue);
        }
        $this->medsos->EditValue = $this->medsos->CurrentValue;
        $this->medsos->PlaceHolder = RemoveHtml($this->medsos->caption());

        // kdproduknafed
        $this->kdproduknafed->EditAttrs["class"] = "form-control";
        $this->kdproduknafed->EditCustomAttributes = "";
        if (!$this->kdproduknafed->Raw) {
            $this->kdproduknafed->CurrentValue = HtmlDecode($this->kdproduknafed->CurrentValue);
        }
        $this->kdproduknafed->EditValue = $this->kdproduknafed->CurrentValue;
        $this->kdproduknafed->PlaceHolder = RemoveHtml($this->kdproduknafed->caption());

        // pproduk
        $this->pproduk->EditAttrs["class"] = "form-control";
        $this->pproduk->EditCustomAttributes = "";
        $this->pproduk->EditValue = $this->pproduk->CurrentValue;
        $this->pproduk->PlaceHolder = RemoveHtml($this->pproduk->caption());

        // kdskala
        $this->kdskala->EditAttrs["class"] = "form-control";
        $this->kdskala->EditCustomAttributes = "";
        $this->kdskala->PlaceHolder = RemoveHtml($this->kdskala->caption());

        // kdjenis
        $this->kdjenis->EditAttrs["class"] = "form-control";
        $this->kdjenis->EditCustomAttributes = "";
        $this->kdjenis->PlaceHolder = RemoveHtml($this->kdjenis->caption());

        // kdexport
        $this->kdexport->EditAttrs["class"] = "form-control";
        $this->kdexport->EditCustomAttributes = "";
        $this->kdexport->PlaceHolder = RemoveHtml($this->kdexport->caption());

        // nexport
        $this->nexport->EditAttrs["class"] = "form-control";
        $this->nexport->EditCustomAttributes = "";
        $this->nexport->EditValue = $this->nexport->CurrentValue;
        $this->nexport->PlaceHolder = RemoveHtml($this->nexport->caption());

        // kdkategori
        $this->kdkategori->EditAttrs["class"] = "form-control";
        $this->kdkategori->EditCustomAttributes = "";
        $this->kdkategori->EditValue = $this->kdkategori->CurrentValue;
        $this->kdkategori->PlaceHolder = RemoveHtml($this->kdkategori->caption());

        // omzet_saat_ini
        $this->omzet_saat_ini->EditAttrs["class"] = "form-control";
        $this->omzet_saat_ini->EditCustomAttributes = "";
        if (!$this->omzet_saat_ini->Raw) {
            $this->omzet_saat_ini->CurrentValue = HtmlDecode($this->omzet_saat_ini->CurrentValue);
        }
        $this->omzet_saat_ini->EditValue = $this->omzet_saat_ini->CurrentValue;
        $this->omzet_saat_ini->PlaceHolder = RemoveHtml($this->omzet_saat_ini->caption());

        // kapasitas_saat_ini
        $this->kapasitas_saat_ini->EditAttrs["class"] = "form-control";
        $this->kapasitas_saat_ini->EditCustomAttributes = "";
        if (!$this->kapasitas_saat_ini->Raw) {
            $this->kapasitas_saat_ini->CurrentValue = HtmlDecode($this->kapasitas_saat_ini->CurrentValue);
        }
        $this->kapasitas_saat_ini->EditValue = $this->kapasitas_saat_ini->CurrentValue;
        $this->kapasitas_saat_ini->PlaceHolder = RemoveHtml($this->kapasitas_saat_ini->caption());

        // hscode
        $this->hscode->EditAttrs["class"] = "form-control";
        $this->hscode->EditCustomAttributes = "";
        $this->hscode->EditValue = $this->hscode->CurrentValue;
        $this->hscode->PlaceHolder = RemoveHtml($this->hscode->caption());

        // created_at
        $this->created_at->EditAttrs["class"] = "form-control";
        $this->created_at->EditCustomAttributes = "";
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, 8);
        $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

        // imp
        $this->imp->EditAttrs["class"] = "form-control";
        $this->imp->EditCustomAttributes = "";
        $this->imp->EditValue = $this->imp->CurrentValue;
        $this->imp->PlaceHolder = RemoveHtml($this->imp->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->idp);
                    $doc->exportCaption($this->namap);
                    $doc->exportCaption($this->kontak);
                    $doc->exportCaption($this->alamatp);
                    $doc->exportCaption($this->kdprop);
                    $doc->exportCaption($this->kdkota);
                    $doc->exportCaption($this->emailp);
                    $doc->exportCaption($this->webp);
                    $doc->exportCaption($this->medsos);
                    $doc->exportCaption($this->kdproduknafed);
                    $doc->exportCaption($this->pproduk);
                    $doc->exportCaption($this->kdskala);
                    $doc->exportCaption($this->kdjenis);
                    $doc->exportCaption($this->kdexport);
                    $doc->exportCaption($this->nexport);
                    $doc->exportCaption($this->kdkategori);
                    $doc->exportCaption($this->omzet_saat_ini);
                    $doc->exportCaption($this->kapasitas_saat_ini);
                    $doc->exportCaption($this->hscode);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->imp);
                } else {
                    $doc->exportCaption($this->idp);
                    $doc->exportCaption($this->namap);
                    $doc->exportCaption($this->kontak);
                    $doc->exportCaption($this->kdprop);
                    $doc->exportCaption($this->kdkota);
                    $doc->exportCaption($this->emailp);
                    $doc->exportCaption($this->webp);
                    $doc->exportCaption($this->medsos);
                    $doc->exportCaption($this->kdproduknafed);
                    $doc->exportCaption($this->kdskala);
                    $doc->exportCaption($this->kdjenis);
                    $doc->exportCaption($this->kdexport);
                    $doc->exportCaption($this->kdkategori);
                    $doc->exportCaption($this->omzet_saat_ini);
                    $doc->exportCaption($this->kapasitas_saat_ini);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->imp);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->idp);
                        $doc->exportField($this->namap);
                        $doc->exportField($this->kontak);
                        $doc->exportField($this->alamatp);
                        $doc->exportField($this->kdprop);
                        $doc->exportField($this->kdkota);
                        $doc->exportField($this->emailp);
                        $doc->exportField($this->webp);
                        $doc->exportField($this->medsos);
                        $doc->exportField($this->kdproduknafed);
                        $doc->exportField($this->pproduk);
                        $doc->exportField($this->kdskala);
                        $doc->exportField($this->kdjenis);
                        $doc->exportField($this->kdexport);
                        $doc->exportField($this->nexport);
                        $doc->exportField($this->kdkategori);
                        $doc->exportField($this->omzet_saat_ini);
                        $doc->exportField($this->kapasitas_saat_ini);
                        $doc->exportField($this->hscode);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->imp);
                    } else {
                        $doc->exportField($this->idp);
                        $doc->exportField($this->namap);
                        $doc->exportField($this->kontak);
                        $doc->exportField($this->kdprop);
                        $doc->exportField($this->kdkota);
                        $doc->exportField($this->emailp);
                        $doc->exportField($this->webp);
                        $doc->exportField($this->medsos);
                        $doc->exportField($this->kdproduknafed);
                        $doc->exportField($this->kdskala);
                        $doc->exportField($this->kdjenis);
                        $doc->exportField($this->kdexport);
                        $doc->exportField($this->kdkategori);
                        $doc->exportField($this->omzet_saat_ini);
                        $doc->exportField($this->kapasitas_saat_ini);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->imp);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
