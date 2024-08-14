<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for Peserta
 */
class Peserta extends DbTable
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
    public $id;
    public $nama;
    public $idp;
    public $tlahir;
    public $alamat;
    public $telp;
    public $_email;
    public $kdprop;
    public $kdkota;
    public $kdsex;
    public $hp;
    public $kdjabat;
    public $kdpend;
    public $harapan;
    public $kdinformasi;
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
        $this->TableVar = 'Peserta';
        $this->TableName = 'Peserta';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "t_peserta";
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

        // id
        $this->id = new DbField('Peserta', 'Peserta', 'x_id', 'id', 't_peserta.id', 't_peserta.id', 3, 11, -1, false, 't_peserta.id', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // nama
        $this->nama = new DbField('Peserta', 'Peserta', 'x_nama', 'nama', 't_peserta.nama', 't_peserta.nama', 200, 50, -1, false, 't_peserta.nama', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama->Sortable = true; // Allow sort
        $this->nama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama->Param, "CustomMsg");
        $this->Fields['nama'] = &$this->nama;

        // idp
        $this->idp = new DbField('Peserta', 'Peserta', 'x_idp', 'idp', 't_peserta.idp', 't_peserta.idp', 3, 11, -1, false, 't_peserta.idp', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->idp->Sortable = true; // Allow sort
        $this->idp->Lookup = new Lookup('idp', 't_perusahaan', false, 'idp', ["namap","","",""], [], [], [], [], [], [], '', '');
        $this->idp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->idp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idp->Param, "CustomMsg");
        $this->Fields['idp'] = &$this->idp;

        // tlahir
        $this->tlahir = new DbField('Peserta', 'Peserta', 'x_tlahir', 'tlahir', 't_peserta.tlahir', CastDateFieldForLike("t_peserta.tlahir", 0, "DB"), 133, 10, 0, false, 't_peserta.tlahir', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tlahir->Sortable = true; // Allow sort
        $this->tlahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tlahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tlahir->Param, "CustomMsg");
        $this->Fields['tlahir'] = &$this->tlahir;

        // alamat
        $this->alamat = new DbField('Peserta', 'Peserta', 'x_alamat', 'alamat', 't_peserta.alamat', 't_peserta.alamat', 201, 65535, -1, false, 't_peserta.alamat', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->alamat->Sortable = true; // Allow sort
        $this->alamat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat->Param, "CustomMsg");
        $this->Fields['alamat'] = &$this->alamat;

        // telp
        $this->telp = new DbField('Peserta', 'Peserta', 'x_telp', 'telp', 't_peserta.telp', 't_peserta.telp', 200, 50, -1, false, 't_peserta.telp', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->telp->Sortable = true; // Allow sort
        $this->telp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->telp->Param, "CustomMsg");
        $this->Fields['telp'] = &$this->telp;

        // email
        $this->_email = new DbField('Peserta', 'Peserta', 'x__email', 'email', 't_peserta.email', 't_peserta.email', 200, 100, -1, false, 't_peserta.email', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_email->Sortable = true; // Allow sort
        $this->_email->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_email->Param, "CustomMsg");
        $this->Fields['email'] = &$this->_email;

        // kdprop
        $this->kdprop = new DbField('Peserta', 'Peserta', 'x_kdprop', 'kdprop', 't_peserta.kdprop', 't_peserta.kdprop', 3, 11, -1, false, 't_peserta.kdprop', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdprop->Sortable = true; // Allow sort
        $this->kdprop->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdprop->Lookup = new Lookup('kdprop', 't_prop', false, 'kdprop', ["prop","","",""], [], [], [], [], [], [], '', '');
        $this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdprop->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdprop->Param, "CustomMsg");
        $this->Fields['kdprop'] = &$this->kdprop;

        // kdkota
        $this->kdkota = new DbField('Peserta', 'Peserta', 'x_kdkota', 'kdkota', 't_peserta.kdkota', 't_peserta.kdkota', 3, 11, -1, false, 't_peserta.kdkota', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdkota->Sortable = true; // Allow sort
        $this->kdkota->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdkota->Lookup = new Lookup('kdkota', 't_kota', false, 'kdkota', ["kota","","",""], [], [], [], [], [], [], '', '');
        $this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkota->Param, "CustomMsg");
        $this->Fields['kdkota'] = &$this->kdkota;

        // kdsex
        $this->kdsex = new DbField('Peserta', 'Peserta', 'x_kdsex', 'kdsex', 't_peserta.kdsex', 't_peserta.kdsex', 3, 11, -1, false, 't_peserta.kdsex', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kdsex->Sortable = true; // Allow sort
        $this->kdsex->Lookup = new Lookup('kdsex', 't_sex', false, 'kdsex', ["sex","","",""], [], [], [], [], [], [], '', '');
        $this->kdsex->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdsex->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdsex->Param, "CustomMsg");
        $this->Fields['kdsex'] = &$this->kdsex;

        // hp
        $this->hp = new DbField('Peserta', 'Peserta', 'x_hp', 'hp', 't_peserta.hp', 't_peserta.hp', 200, 50, -1, false, 't_peserta.hp', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->hp->Sortable = true; // Allow sort
        $this->hp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hp->Param, "CustomMsg");
        $this->Fields['hp'] = &$this->hp;

        // kdjabat
        $this->kdjabat = new DbField('Peserta', 'Peserta', 'x_kdjabat', 'kdjabat', 't_peserta.kdjabat', 't_peserta.kdjabat', 3, 11, -1, false, 't_peserta.kdjabat', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdjabat->Sortable = true; // Allow sort
        $this->kdjabat->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdjabat->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdjabat->Lookup = new Lookup('kdjabat', 't_jabatan', false, 'kdjabat', ["jabatan","","",""], [], [], [], [], [], [], '', '');
        $this->kdjabat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdjabat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdjabat->Param, "CustomMsg");
        $this->Fields['kdjabat'] = &$this->kdjabat;

        // kdpend
        $this->kdpend = new DbField('Peserta', 'Peserta', 'x_kdpend', 'kdpend', 't_peserta.kdpend', 't_peserta.kdpend', 3, 11, -1, false, 't_peserta.kdpend', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdpend->Sortable = true; // Allow sort
        $this->kdpend->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdpend->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdpend->Lookup = new Lookup('kdpend', 't_pendidikan', false, 'kdpend', ["pendidikan","","",""], [], [], [], [], [], [], '', '');
        $this->kdpend->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdpend->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdpend->Param, "CustomMsg");
        $this->Fields['kdpend'] = &$this->kdpend;

        // harapan
        $this->harapan = new DbField('Peserta', 'Peserta', 'x_harapan', 'harapan', 't_peserta.harapan', 't_peserta.harapan', 201, 16777215, -1, false, 't_peserta.harapan', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->harapan->Sortable = true; // Allow sort
        $this->harapan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->harapan->Param, "CustomMsg");
        $this->Fields['harapan'] = &$this->harapan;

        // kdinformasi
        $this->kdinformasi = new DbField('Peserta', 'Peserta', 'x_kdinformasi', 'kdinformasi', 't_peserta.kdinformasi', 't_peserta.kdinformasi', 3, 5, -1, false, 't_peserta.kdinformasi', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kdinformasi->Sortable = true; // Allow sort
        $this->kdinformasi->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kdinformasi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kdinformasi->Lookup = new Lookup('kdinformasi', 't_informasi', false, 'kdinformasi', ["informasi","","",""], [], [], [], [], [], [], '', '');
        $this->kdinformasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdinformasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdinformasi->Param, "CustomMsg");
        $this->Fields['kdinformasi'] = &$this->kdinformasi;

        // created_at
        $this->created_at = new DbField('Peserta', 'Peserta', 'x_created_at', 'created_at', 't_peserta.created_at', CastDateFieldForLike("t_peserta.created_at", 0, "DB"), 135, 19, 0, false, 't_peserta.created_at', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->created_at->Sortable = true; // Allow sort
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_at->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->created_at->Param, "CustomMsg");
        $this->Fields['created_at'] = &$this->created_at;

        // imp
        $this->imp = new DbField('Peserta', 'Peserta', 'x_imp', 'imp', 't_peserta.imp', 't_peserta.imp', 16, 1, -1, false, 't_peserta.imp', false, false, false, 'FORMATTED TEXT', 'TEXT');
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "t_peserta";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("t_peserta.id, t_peserta.nama, t_peserta.idp, t_peserta.tlahir, t_peserta.alamat, t_peserta.telp, t_peserta.email, t_peserta.kdprop, t_peserta.kdkota, t_peserta.kdsex, t_peserta.hp, t_peserta.kdjabat, t_peserta.kdpend, t_peserta.harapan, t_peserta.kdinformasi, t_peserta.created_at, t_peserta.imp");
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
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "t_peserta.imp = 1";
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
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
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
        $this->id->DbValue = $row['id'];
        $this->nama->DbValue = $row['nama'];
        $this->idp->DbValue = $row['idp'];
        $this->tlahir->DbValue = $row['tlahir'];
        $this->alamat->DbValue = $row['alamat'];
        $this->telp->DbValue = $row['telp'];
        $this->_email->DbValue = $row['email'];
        $this->kdprop->DbValue = $row['kdprop'];
        $this->kdkota->DbValue = $row['kdkota'];
        $this->kdsex->DbValue = $row['kdsex'];
        $this->hp->DbValue = $row['hp'];
        $this->kdjabat->DbValue = $row['kdjabat'];
        $this->kdpend->DbValue = $row['kdpend'];
        $this->harapan->DbValue = $row['harapan'];
        $this->kdinformasi->DbValue = $row['kdinformasi'];
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
        return $_SESSION[$name] ?? GetUrl("pesertalist");
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
        if ($pageName == "pesertaview") {
            return $Language->phrase("View");
        } elseif ($pageName == "pesertaedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "pesertaadd") {
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
                return "PesertaView";
            case Config("API_ADD_ACTION"):
                return "PesertaAdd";
            case Config("API_EDIT_ACTION"):
                return "PesertaEdit";
            case Config("API_DELETE_ACTION"):
                return "PesertaDelete";
            case Config("API_LIST_ACTION"):
                return "PesertaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "pesertalist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("pesertaview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("pesertaview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "pesertaadd?" . $this->getUrlParm($parm);
        } else {
            $url = "pesertaadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("pesertaedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("pesertaadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("pesertadelete", $this->getUrlParm());
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
        $this->id->setDbValue($row['id']);
        $this->nama->setDbValue($row['nama']);
        $this->idp->setDbValue($row['idp']);
        $this->tlahir->setDbValue($row['tlahir']);
        $this->alamat->setDbValue($row['alamat']);
        $this->telp->setDbValue($row['telp']);
        $this->_email->setDbValue($row['email']);
        $this->kdprop->setDbValue($row['kdprop']);
        $this->kdkota->setDbValue($row['kdkota']);
        $this->kdsex->setDbValue($row['kdsex']);
        $this->hp->setDbValue($row['hp']);
        $this->kdjabat->setDbValue($row['kdjabat']);
        $this->kdpend->setDbValue($row['kdpend']);
        $this->harapan->setDbValue($row['harapan']);
        $this->kdinformasi->setDbValue($row['kdinformasi']);
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

        // id

        // nama

        // idp

        // tlahir

        // alamat

        // telp

        // email

        // kdprop

        // kdkota

        // kdsex

        // hp

        // kdjabat

        // kdpend

        // harapan

        // kdinformasi

        // created_at

        // imp

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // nama
        $this->nama->ViewValue = $this->nama->CurrentValue;
        $this->nama->ViewCustomAttributes = "";

        // idp
        $this->idp->ViewValue = $this->idp->CurrentValue;
        $curVal = trim(strval($this->idp->CurrentValue));
        if ($curVal != "") {
            $this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
            if ($this->idp->ViewValue === null) { // Lookup from database
                $filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->idp->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->idp->Lookup->renderViewRow($rswrk[0]);
                    $this->idp->ViewValue = $this->idp->displayValue($arwrk);
                } else {
                    $this->idp->ViewValue = $this->idp->CurrentValue;
                }
            }
        } else {
            $this->idp->ViewValue = null;
        }
        $this->idp->ViewCustomAttributes = "";

        // tlahir
        $this->tlahir->ViewValue = $this->tlahir->CurrentValue;
        $this->tlahir->ViewValue = FormatDateTime($this->tlahir->ViewValue, 0);
        $this->tlahir->ViewCustomAttributes = "";

        // alamat
        $this->alamat->ViewValue = $this->alamat->CurrentValue;
        $this->alamat->ViewCustomAttributes = "";

        // telp
        $this->telp->ViewValue = $this->telp->CurrentValue;
        $this->telp->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

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

        // kdsex
        $curVal = trim(strval($this->kdsex->CurrentValue));
        if ($curVal != "") {
            $this->kdsex->ViewValue = $this->kdsex->lookupCacheOption($curVal);
            if ($this->kdsex->ViewValue === null) { // Lookup from database
                $filterWrk = "`kdsex`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kdsex->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kdsex->Lookup->renderViewRow($rswrk[0]);
                    $this->kdsex->ViewValue = $this->kdsex->displayValue($arwrk);
                } else {
                    $this->kdsex->ViewValue = $this->kdsex->CurrentValue;
                }
            }
        } else {
            $this->kdsex->ViewValue = null;
        }
        $this->kdsex->ViewCustomAttributes = "";

        // hp
        $this->hp->ViewValue = $this->hp->CurrentValue;
        $this->hp->ViewCustomAttributes = "";

        // kdjabat
        $curVal = trim(strval($this->kdjabat->CurrentValue));
        if ($curVal != "") {
            $this->kdjabat->ViewValue = $this->kdjabat->lookupCacheOption($curVal);
            if ($this->kdjabat->ViewValue === null) { // Lookup from database
                $filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kdjabat->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kdjabat->Lookup->renderViewRow($rswrk[0]);
                    $this->kdjabat->ViewValue = $this->kdjabat->displayValue($arwrk);
                } else {
                    $this->kdjabat->ViewValue = $this->kdjabat->CurrentValue;
                }
            }
        } else {
            $this->kdjabat->ViewValue = null;
        }
        $this->kdjabat->ViewCustomAttributes = "";

        // kdpend
        $curVal = trim(strval($this->kdpend->CurrentValue));
        if ($curVal != "") {
            $this->kdpend->ViewValue = $this->kdpend->lookupCacheOption($curVal);
            if ($this->kdpend->ViewValue === null) { // Lookup from database
                $filterWrk = "`kdpend`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kdpend->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kdpend->Lookup->renderViewRow($rswrk[0]);
                    $this->kdpend->ViewValue = $this->kdpend->displayValue($arwrk);
                } else {
                    $this->kdpend->ViewValue = $this->kdpend->CurrentValue;
                }
            }
        } else {
            $this->kdpend->ViewValue = null;
        }
        $this->kdpend->ViewCustomAttributes = "";

        // harapan
        $this->harapan->ViewValue = $this->harapan->CurrentValue;
        $this->harapan->ViewCustomAttributes = "";

        // kdinformasi
        $curVal = trim(strval($this->kdinformasi->CurrentValue));
        if ($curVal != "") {
            $this->kdinformasi->ViewValue = $this->kdinformasi->lookupCacheOption($curVal);
            if ($this->kdinformasi->ViewValue === null) { // Lookup from database
                $filterWrk = "`kdinformasi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kdinformasi->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kdinformasi->Lookup->renderViewRow($rswrk[0]);
                    $this->kdinformasi->ViewValue = $this->kdinformasi->displayValue($arwrk);
                } else {
                    $this->kdinformasi->ViewValue = $this->kdinformasi->CurrentValue;
                }
            }
        } else {
            $this->kdinformasi->ViewValue = null;
        }
        $this->kdinformasi->ViewCustomAttributes = "";

        // created_at
        $this->created_at->ViewValue = $this->created_at->CurrentValue;
        $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
        $this->created_at->ViewCustomAttributes = "";

        // imp
        $this->imp->ViewValue = $this->imp->CurrentValue;
        $this->imp->ViewValue = FormatNumber($this->imp->ViewValue, 0, -2, -2, -2);
        $this->imp->ViewCustomAttributes = "";

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

        // tlahir
        $this->tlahir->LinkCustomAttributes = "";
        $this->tlahir->HrefValue = "";
        $this->tlahir->TooltipValue = "";

        // alamat
        $this->alamat->LinkCustomAttributes = "";
        $this->alamat->HrefValue = "";
        $this->alamat->TooltipValue = "";

        // telp
        $this->telp->LinkCustomAttributes = "";
        $this->telp->HrefValue = "";
        $this->telp->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // kdprop
        $this->kdprop->LinkCustomAttributes = "";
        $this->kdprop->HrefValue = "";
        $this->kdprop->TooltipValue = "";

        // kdkota
        $this->kdkota->LinkCustomAttributes = "";
        $this->kdkota->HrefValue = "";
        $this->kdkota->TooltipValue = "";

        // kdsex
        $this->kdsex->LinkCustomAttributes = "";
        $this->kdsex->HrefValue = "";
        $this->kdsex->TooltipValue = "";

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

        // harapan
        $this->harapan->LinkCustomAttributes = "";
        $this->harapan->HrefValue = "";
        $this->harapan->TooltipValue = "";

        // kdinformasi
        $this->kdinformasi->LinkCustomAttributes = "";
        $this->kdinformasi->HrefValue = "";
        $this->kdinformasi->TooltipValue = "";

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

        // id
        $this->id->EditAttrs["class"] = "form-control";
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->PlaceHolder = RemoveHtml($this->id->caption());

        // nama
        $this->nama->EditAttrs["class"] = "form-control";
        $this->nama->EditCustomAttributes = "";
        if (!$this->nama->Raw) {
            $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
        }
        $this->nama->EditValue = $this->nama->CurrentValue;
        $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

        // idp
        $this->idp->EditAttrs["class"] = "form-control";
        $this->idp->EditCustomAttributes = "";
        $this->idp->EditValue = $this->idp->CurrentValue;
        $this->idp->PlaceHolder = RemoveHtml($this->idp->caption());

        // tlahir
        $this->tlahir->EditAttrs["class"] = "form-control";
        $this->tlahir->EditCustomAttributes = "";
        $this->tlahir->EditValue = FormatDateTime($this->tlahir->CurrentValue, 8);
        $this->tlahir->PlaceHolder = RemoveHtml($this->tlahir->caption());

        // alamat
        $this->alamat->EditAttrs["class"] = "form-control";
        $this->alamat->EditCustomAttributes = "";
        $this->alamat->EditValue = $this->alamat->CurrentValue;
        $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

        // telp
        $this->telp->EditAttrs["class"] = "form-control";
        $this->telp->EditCustomAttributes = "";
        if (!$this->telp->Raw) {
            $this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
        }
        $this->telp->EditValue = $this->telp->CurrentValue;
        $this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

        // email
        $this->_email->EditAttrs["class"] = "form-control";
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // kdprop
        $this->kdprop->EditAttrs["class"] = "form-control";
        $this->kdprop->EditCustomAttributes = "";
        $this->kdprop->PlaceHolder = RemoveHtml($this->kdprop->caption());

        // kdkota
        $this->kdkota->EditAttrs["class"] = "form-control";
        $this->kdkota->EditCustomAttributes = "";
        $this->kdkota->PlaceHolder = RemoveHtml($this->kdkota->caption());

        // kdsex
        $this->kdsex->EditCustomAttributes = "";
        $this->kdsex->PlaceHolder = RemoveHtml($this->kdsex->caption());

        // hp
        $this->hp->EditAttrs["class"] = "form-control";
        $this->hp->EditCustomAttributes = "";
        if (!$this->hp->Raw) {
            $this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
        }
        $this->hp->EditValue = $this->hp->CurrentValue;
        $this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

        // kdjabat
        $this->kdjabat->EditAttrs["class"] = "form-control";
        $this->kdjabat->EditCustomAttributes = "";
        $this->kdjabat->PlaceHolder = RemoveHtml($this->kdjabat->caption());

        // kdpend
        $this->kdpend->EditAttrs["class"] = "form-control";
        $this->kdpend->EditCustomAttributes = "";
        $this->kdpend->PlaceHolder = RemoveHtml($this->kdpend->caption());

        // harapan
        $this->harapan->EditAttrs["class"] = "form-control";
        $this->harapan->EditCustomAttributes = "";
        $this->harapan->EditValue = $this->harapan->CurrentValue;
        $this->harapan->PlaceHolder = RemoveHtml($this->harapan->caption());

        // kdinformasi
        $this->kdinformasi->EditAttrs["class"] = "form-control";
        $this->kdinformasi->EditCustomAttributes = "";
        $this->kdinformasi->PlaceHolder = RemoveHtml($this->kdinformasi->caption());

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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->idp);
                    $doc->exportCaption($this->tlahir);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->telp);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->kdprop);
                    $doc->exportCaption($this->kdkota);
                    $doc->exportCaption($this->kdsex);
                    $doc->exportCaption($this->hp);
                    $doc->exportCaption($this->kdjabat);
                    $doc->exportCaption($this->kdpend);
                    $doc->exportCaption($this->harapan);
                    $doc->exportCaption($this->kdinformasi);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->imp);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->idp);
                    $doc->exportCaption($this->tlahir);
                    $doc->exportCaption($this->telp);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->kdprop);
                    $doc->exportCaption($this->kdkota);
                    $doc->exportCaption($this->kdsex);
                    $doc->exportCaption($this->hp);
                    $doc->exportCaption($this->kdjabat);
                    $doc->exportCaption($this->kdpend);
                    $doc->exportCaption($this->kdinformasi);
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
                        $doc->exportField($this->id);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->idp);
                        $doc->exportField($this->tlahir);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->telp);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->kdprop);
                        $doc->exportField($this->kdkota);
                        $doc->exportField($this->kdsex);
                        $doc->exportField($this->hp);
                        $doc->exportField($this->kdjabat);
                        $doc->exportField($this->kdpend);
                        $doc->exportField($this->harapan);
                        $doc->exportField($this->kdinformasi);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->imp);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->idp);
                        $doc->exportField($this->tlahir);
                        $doc->exportField($this->telp);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->kdprop);
                        $doc->exportField($this->kdkota);
                        $doc->exportField($this->kdsex);
                        $doc->exportField($this->hp);
                        $doc->exportField($this->kdjabat);
                        $doc->exportField($this->kdpend);
                        $doc->exportField($this->kdinformasi);
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
