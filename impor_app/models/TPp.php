<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for t_pp
 */
class TPp extends DbTable
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
    public $kdhistori;
    public $kdpelat;
    public $id;
    public $tahun;
    public $kdinformasi;
    public $harapan;
    public $sertifikat;
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
        $this->TableVar = 't_pp';
        $this->TableName = 't_pp';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`t_pp`";
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

        // kdhistori
        $this->kdhistori = new DbField('t_pp', 't_pp', 'x_kdhistori', 'kdhistori', '`kdhistori`', '`kdhistori`', 3, 25, -1, false, '`kdhistori`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->kdhistori->IsAutoIncrement = true; // Autoincrement field
        $this->kdhistori->IsPrimaryKey = true; // Primary key field
        $this->kdhistori->Sortable = true; // Allow sort
        $this->kdhistori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdhistori->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdhistori->Param, "CustomMsg");
        $this->Fields['kdhistori'] = &$this->kdhistori;

        // kdpelat
        $this->kdpelat = new DbField('t_pp', 't_pp', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 20, -1, false, '`kdpelat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdpelat->Sortable = true; // Allow sort
        $this->kdpelat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdpelat->Param, "CustomMsg");
        $this->Fields['kdpelat'] = &$this->kdpelat;

        // id
        $this->id = new DbField('t_pp', 't_pp', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // tahun
        $this->tahun = new DbField('t_pp', 't_pp', 'x_tahun', 'tahun', '`tahun`', '`tahun`', 2, 6, -1, false, '`tahun`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tahun->Sortable = true; // Allow sort
        $this->tahun->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->tahun->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tahun->Param, "CustomMsg");
        $this->Fields['tahun'] = &$this->tahun;

        // kdinformasi
        $this->kdinformasi = new DbField('t_pp', 't_pp', 'x_kdinformasi', 'kdinformasi', '`kdinformasi`', '`kdinformasi`', 3, 5, -1, false, '`kdinformasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdinformasi->Sortable = true; // Allow sort
        $this->kdinformasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdinformasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdinformasi->Param, "CustomMsg");
        $this->Fields['kdinformasi'] = &$this->kdinformasi;

        // harapan
        $this->harapan = new DbField('t_pp', 't_pp', 'x_harapan', 'harapan', '`harapan`', '`harapan`', 201, 16777215, -1, false, '`harapan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->harapan->Sortable = true; // Allow sort
        $this->harapan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->harapan->Param, "CustomMsg");
        $this->Fields['harapan'] = &$this->harapan;

        // sertifikat
        $this->sertifikat = new DbField('t_pp', 't_pp', 'x_sertifikat', 'sertifikat', '`sertifikat`', '`sertifikat`', 200, 100, -1, false, '`sertifikat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sertifikat->Sortable = true; // Allow sort
        $this->sertifikat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sertifikat->Param, "CustomMsg");
        $this->Fields['sertifikat'] = &$this->sertifikat;

        // imp
        $this->imp = new DbField('t_pp', 't_pp', 'x_imp', 'imp', '`imp`', '`imp`', 16, 1, -1, false, '`imp`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->imp->Nullable = false; // NOT NULL field
        $this->imp->Sortable = true; // Allow sort
        $this->imp->DataType = DATATYPE_BOOLEAN;
        $this->imp->Lookup = new Lookup('imp', 't_pp', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->imp->OptionCount = 2;
        $this->imp->DefaultErrorMessage = $Language->phrase("IncorrectField");
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_pp`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
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
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
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
            $this->kdhistori->setDbValue($conn->lastInsertId());
            $rs['kdhistori'] = $this->kdhistori->DbValue;
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
            if (array_key_exists('kdhistori', $rs)) {
                AddFilter($where, QuotedName('kdhistori', $this->Dbid) . '=' . QuotedValue($rs['kdhistori'], $this->kdhistori->DataType, $this->Dbid));
            }
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
        $this->kdhistori->DbValue = $row['kdhistori'];
        $this->kdpelat->DbValue = $row['kdpelat'];
        $this->id->DbValue = $row['id'];
        $this->tahun->DbValue = $row['tahun'];
        $this->kdinformasi->DbValue = $row['kdinformasi'];
        $this->harapan->DbValue = $row['harapan'];
        $this->sertifikat->DbValue = $row['sertifikat'];
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
        return "`kdhistori` = @kdhistori@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->kdhistori->CurrentValue : $this->kdhistori->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->kdhistori->CurrentValue = $keys[0];
            } else {
                $this->kdhistori->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('kdhistori', $row) ? $row['kdhistori'] : null;
        } else {
            $val = $this->kdhistori->OldValue !== null ? $this->kdhistori->OldValue : $this->kdhistori->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@kdhistori@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
        return $_SESSION[$name] ?? GetUrl("tpplist");
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
        if ($pageName == "tppview") {
            return $Language->phrase("View");
        } elseif ($pageName == "tppedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "tppadd") {
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
                return "TPpView";
            case Config("API_ADD_ACTION"):
                return "TPpAdd";
            case Config("API_EDIT_ACTION"):
                return "TPpEdit";
            case Config("API_DELETE_ACTION"):
                return "TPpDelete";
            case Config("API_LIST_ACTION"):
                return "TPpList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "tpplist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("tppview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("tppview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "tppadd?" . $this->getUrlParm($parm);
        } else {
            $url = "tppadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("tppedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("tppadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("tppdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "kdhistori:" . JsonEncode($this->kdhistori->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->kdhistori->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->kdhistori->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
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
            if (($keyValue = Param("kdhistori") ?? Route("kdhistori")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
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
            if ($setCurrent) {
                $this->kdhistori->CurrentValue = $key;
            } else {
                $this->kdhistori->OldValue = $key;
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
        $this->kdhistori->setDbValue($row['kdhistori']);
        $this->kdpelat->setDbValue($row['kdpelat']);
        $this->id->setDbValue($row['id']);
        $this->tahun->setDbValue($row['tahun']);
        $this->kdinformasi->setDbValue($row['kdinformasi']);
        $this->harapan->setDbValue($row['harapan']);
        $this->sertifikat->setDbValue($row['sertifikat']);
        $this->imp->setDbValue($row['imp']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // kdhistori

        // kdpelat

        // id

        // tahun

        // kdinformasi

        // harapan

        // sertifikat

        // imp

        // kdhistori
        $this->kdhistori->ViewValue = $this->kdhistori->CurrentValue;
        $this->kdhistori->ViewCustomAttributes = "";

        // kdpelat
        $this->kdpelat->ViewValue = $this->kdpelat->CurrentValue;
        $this->kdpelat->ViewCustomAttributes = "";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, 0, -2, -2, -2);
        $this->id->ViewCustomAttributes = "";

        // tahun
        $this->tahun->ViewValue = $this->tahun->CurrentValue;
        $this->tahun->ViewValue = FormatNumber($this->tahun->ViewValue, 0, -2, -2, -2);
        $this->tahun->ViewCustomAttributes = "";

        // kdinformasi
        $this->kdinformasi->ViewValue = $this->kdinformasi->CurrentValue;
        $this->kdinformasi->ViewValue = FormatNumber($this->kdinformasi->ViewValue, 0, -2, -2, -2);
        $this->kdinformasi->ViewCustomAttributes = "";

        // harapan
        $this->harapan->ViewValue = $this->harapan->CurrentValue;
        $this->harapan->ViewCustomAttributes = "";

        // sertifikat
        $this->sertifikat->ViewValue = $this->sertifikat->CurrentValue;
        $this->sertifikat->ViewCustomAttributes = "";

        // imp
        if (ConvertToBool($this->imp->CurrentValue)) {
            $this->imp->ViewValue = $this->imp->tagCaption(1) != "" ? $this->imp->tagCaption(1) : "Yes";
        } else {
            $this->imp->ViewValue = $this->imp->tagCaption(2) != "" ? $this->imp->tagCaption(2) : "No";
        }
        $this->imp->ViewCustomAttributes = "";

        // kdhistori
        $this->kdhistori->LinkCustomAttributes = "";
        $this->kdhistori->HrefValue = "";
        $this->kdhistori->TooltipValue = "";

        // kdpelat
        $this->kdpelat->LinkCustomAttributes = "";
        $this->kdpelat->HrefValue = "";
        $this->kdpelat->TooltipValue = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // tahun
        $this->tahun->LinkCustomAttributes = "";
        $this->tahun->HrefValue = "";
        $this->tahun->TooltipValue = "";

        // kdinformasi
        $this->kdinformasi->LinkCustomAttributes = "";
        $this->kdinformasi->HrefValue = "";
        $this->kdinformasi->TooltipValue = "";

        // harapan
        $this->harapan->LinkCustomAttributes = "";
        $this->harapan->HrefValue = "";
        $this->harapan->TooltipValue = "";

        // sertifikat
        $this->sertifikat->LinkCustomAttributes = "";
        $this->sertifikat->HrefValue = "";
        $this->sertifikat->TooltipValue = "";

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

        // kdhistori
        $this->kdhistori->EditAttrs["class"] = "form-control";
        $this->kdhistori->EditCustomAttributes = "";
        $this->kdhistori->EditValue = $this->kdhistori->CurrentValue;
        $this->kdhistori->ViewCustomAttributes = "";

        // kdpelat
        $this->kdpelat->EditAttrs["class"] = "form-control";
        $this->kdpelat->EditCustomAttributes = "";
        if (!$this->kdpelat->Raw) {
            $this->kdpelat->CurrentValue = HtmlDecode($this->kdpelat->CurrentValue);
        }
        $this->kdpelat->EditValue = $this->kdpelat->CurrentValue;
        $this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

        // id
        $this->id->EditAttrs["class"] = "form-control";
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->PlaceHolder = RemoveHtml($this->id->caption());

        // tahun
        $this->tahun->EditAttrs["class"] = "form-control";
        $this->tahun->EditCustomAttributes = "";
        $this->tahun->EditValue = $this->tahun->CurrentValue;
        $this->tahun->PlaceHolder = RemoveHtml($this->tahun->caption());

        // kdinformasi
        $this->kdinformasi->EditAttrs["class"] = "form-control";
        $this->kdinformasi->EditCustomAttributes = "";
        $this->kdinformasi->EditValue = $this->kdinformasi->CurrentValue;
        $this->kdinformasi->PlaceHolder = RemoveHtml($this->kdinformasi->caption());

        // harapan
        $this->harapan->EditAttrs["class"] = "form-control";
        $this->harapan->EditCustomAttributes = "";
        $this->harapan->EditValue = $this->harapan->CurrentValue;
        $this->harapan->PlaceHolder = RemoveHtml($this->harapan->caption());

        // sertifikat
        $this->sertifikat->EditAttrs["class"] = "form-control";
        $this->sertifikat->EditCustomAttributes = "";
        if (!$this->sertifikat->Raw) {
            $this->sertifikat->CurrentValue = HtmlDecode($this->sertifikat->CurrentValue);
        }
        $this->sertifikat->EditValue = $this->sertifikat->CurrentValue;
        $this->sertifikat->PlaceHolder = RemoveHtml($this->sertifikat->caption());

        // imp
        $this->imp->EditCustomAttributes = "";
        $this->imp->EditValue = $this->imp->options(false);
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
                    $doc->exportCaption($this->kdhistori);
                    $doc->exportCaption($this->kdpelat);
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->tahun);
                    $doc->exportCaption($this->kdinformasi);
                    $doc->exportCaption($this->harapan);
                    $doc->exportCaption($this->sertifikat);
                    $doc->exportCaption($this->imp);
                } else {
                    $doc->exportCaption($this->kdhistori);
                    $doc->exportCaption($this->kdpelat);
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->tahun);
                    $doc->exportCaption($this->kdinformasi);
                    $doc->exportCaption($this->sertifikat);
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
                        $doc->exportField($this->kdhistori);
                        $doc->exportField($this->kdpelat);
                        $doc->exportField($this->id);
                        $doc->exportField($this->tahun);
                        $doc->exportField($this->kdinformasi);
                        $doc->exportField($this->harapan);
                        $doc->exportField($this->sertifikat);
                        $doc->exportField($this->imp);
                    } else {
                        $doc->exportField($this->kdhistori);
                        $doc->exportField($this->kdpelat);
                        $doc->exportField($this->id);
                        $doc->exportField($this->tahun);
                        $doc->exportField($this->kdinformasi);
                        $doc->exportField($this->sertifikat);
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
