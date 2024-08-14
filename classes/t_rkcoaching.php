<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_rkcoaching
 */
class t_rkcoaching extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $rkid;
	public $jenispel;
	public $kdkategori;
	public $kerjasama;
	public $area;
	public $area2;
	public $tempat;
	public $jml_tahapan;
	public $jml_peserta;
	public $tahun_keg;
	public $tglrevisi;
	public $mou;
	public $real;
	public $sisa;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_rkcoaching';
		$this->TableName = 't_rkcoaching';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_rkcoaching`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// rkid
		$this->rkid = new DbField('t_rkcoaching', 't_rkcoaching', 'x_rkid', 'rkid', '`rkid`', '`rkid`', 3, 11, -1, FALSE, '`rkid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->rkid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->rkid->IsPrimaryKey = TRUE; // Primary key field
		$this->rkid->IsForeignKey = TRUE; // Foreign key field
		$this->rkid->Sortable = TRUE; // Allow sort
		$this->rkid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rkid'] = &$this->rkid;

		// jenispel
		$this->jenispel = new DbField('t_rkcoaching', 't_rkcoaching', 'x_jenispel', 'jenispel', '`jenispel`', '`jenispel`', 16, 2, -1, FALSE, '`jenispel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenispel->Nullable = FALSE; // NOT NULL field
		$this->jenispel->Required = TRUE; // Required field
		$this->jenispel->Sortable = FALSE; // Allow sort
		$this->jenispel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenispel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenispel->Lookup = new Lookup('jenispel', 't_rkcoaching', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenispel->OptionCount = 10;
		$this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenispel'] = &$this->jenispel;

		// kdkategori
		$this->kdkategori = new DbField('t_rkcoaching', 't_rkcoaching', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, FALSE, '`kdkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkategori->Sortable = TRUE; // Allow sort
		$this->kdkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', FALSE, 'kdkategori', ["kategori","","",""], [], ["x_kerjasama"], [], [], [], [], '`kdkategori` ASC', '');
		$this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkategori'] = &$this->kdkategori;

		// kerjasama
		$this->kerjasama = new DbField('t_rkcoaching', 't_rkcoaching', 'x_kerjasama', 'kerjasama', '`kerjasama`', '`kerjasama`', 3, 11, -1, FALSE, '`EV__kerjasama`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kerjasama->Sortable = TRUE; // Allow sort
		$this->kerjasama->Lookup = new Lookup('kerjasama', 't_perusahaan', FALSE, 'idp', ["namap","","",""], ["x_kdkategori"], [], ["kdkategori"], ["x_kdkategori"], [], [], '`namap` ASC', '');
		$this->kerjasama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kerjasama'] = &$this->kerjasama;

		// area
		$this->area = new DbField('t_rkcoaching', 't_rkcoaching', 'x_area', 'area', '`area`', '`area`', 16, 2, -1, FALSE, '`EV__area`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->area->IsForeignKey = TRUE; // Foreign key field
		$this->area->Required = TRUE; // Required field
		$this->area->Sortable = TRUE; // Allow sort
		$this->area->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->area->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->area->Lookup = new Lookup('area', 't_area', FALSE, 'areaid', ["area","","",""], [], [], [], [], [], [], '`area` ASC', '');
		$this->area->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['area'] = &$this->area;

		// area2
		$this->area2 = new DbField('t_rkcoaching', 't_rkcoaching', 'x_area2', 'area2', 't_rkcoaching.area', 't_rkcoaching.area', 16, 2, -1, FALSE, 't_rkcoaching.area', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->area2->IsCustom = TRUE; // Custom field
		$this->area2->Sortable = TRUE; // Allow sort
		$this->area2->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->area2->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->area2->Lookup = new Lookup('area2', 't_area', FALSE, 'areaid', ["area","","",""], [], [], [], [], [], [], '`area` ASC', '');
		$this->area2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['area2'] = &$this->area2;

		// tempat
		$this->tempat = new DbField('t_rkcoaching', 't_rkcoaching', 'x_tempat', 'tempat', '`tempat`', '`tempat`', 200, 50, -1, FALSE, '`tempat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tempat->Nullable = FALSE; // NOT NULL field
		$this->tempat->Required = TRUE; // Required field
		$this->tempat->Sortable = TRUE; // Allow sort
		$this->fields['tempat'] = &$this->tempat;

		// jml_tahapan
		$this->jml_tahapan = new DbField('t_rkcoaching', 't_rkcoaching', 'x_jml_tahapan', 'jml_tahapan', '`jml_tahapan`', '`jml_tahapan`', 16, 2, -1, FALSE, '`jml_tahapan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_tahapan->Nullable = FALSE; // NOT NULL field
		$this->jml_tahapan->Required = TRUE; // Required field
		$this->jml_tahapan->Sortable = TRUE; // Allow sort
		$this->jml_tahapan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jml_tahapan'] = &$this->jml_tahapan;

		// jml_peserta
		$this->jml_peserta = new DbField('t_rkcoaching', 't_rkcoaching', 'x_jml_peserta', 'jml_peserta', '`jml_peserta`', '`jml_peserta`', 2, 5, -1, FALSE, '`jml_peserta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_peserta->Nullable = FALSE; // NOT NULL field
		$this->jml_peserta->Required = TRUE; // Required field
		$this->jml_peserta->Sortable = TRUE; // Allow sort
		$this->jml_peserta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jml_peserta'] = &$this->jml_peserta;

		// tahun_keg
		$this->tahun_keg = new DbField('t_rkcoaching', 't_rkcoaching', 'x_tahun_keg', 'tahun_keg', '`tahun_keg`', '`tahun_keg`', 3, 4, -1, FALSE, '`tahun_keg`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tahun_keg->Required = TRUE; // Required field
		$this->tahun_keg->Sortable = TRUE; // Allow sort
		$this->tahun_keg->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tahun_keg->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->tahun_keg->Lookup = new Lookup('tahun_keg', 't_tahun', TRUE, 'tahun', ["tahun","","",""], [], [], [], [], [], [], '`tahun` DESC', '');
		$this->tahun_keg->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tahun_keg'] = &$this->tahun_keg;

		// tglrevisi
		$this->tglrevisi = new DbField('t_rkcoaching', 't_rkcoaching', 'x_tglrevisi', 'tglrevisi', '`tglrevisi`', CastDateFieldForLike("`tglrevisi`", 0, "DB"), 133, 10, 0, FALSE, '`tglrevisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglrevisi->Sortable = TRUE; // Allow sort
		$this->tglrevisi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tglrevisi'] = &$this->tglrevisi;

		// mou
		$this->mou = new DbField('t_rkcoaching', 't_rkcoaching', 'x_mou', 'mou', '`mou`', '`mou`', 200, 255, -1, TRUE, '`mou`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->mou->Sortable = TRUE; // Allow sort
		$this->mou->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['mou'] = &$this->mou;

		// real
		$this->real = new DbField('t_rkcoaching', 't_rkcoaching', 'x_real', 'real', '(SELECT COUNT(1) FROM t_coaching a WHERE a.rkid = t_rkcoaching.rkid LIMIT 1)', '(SELECT COUNT(1) FROM t_coaching a WHERE a.rkid = t_rkcoaching.rkid LIMIT 1)', 20, 21, -1, FALSE, '(SELECT COUNT(1) FROM t_coaching a WHERE a.rkid = t_rkcoaching.rkid LIMIT 1)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->real->IsCustom = TRUE; // Custom field
		$this->real->Sortable = TRUE; // Allow sort
		$this->real->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['real'] = &$this->real;

		// sisa
		$this->sisa = new DbField('t_rkcoaching', 't_rkcoaching', 'x_sisa', 'sisa', 'NULL', 'NULL', 12, 65530, -1, FALSE, 'NULL', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sisa->IsCustom = TRUE; // Custom field
		$this->sisa->Sortable = TRUE; // Allow sort
		$this->fields['sisa'] = &$this->sisa;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
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
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			$sortFieldList = ($fld->VirtualExpression != "") ? $fld->VirtualExpression : $sortField;
			$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")] = $v;
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "t_coachingtahapan") {
			$detailUrl = $GLOBALS["t_coachingtahapan"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_rkid=" . urlencode($this->rkid->CurrentValue);
			$detailUrl .= "&fk_area=" . urlencode($this->area->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "t_coaching") {
			$detailUrl = $GLOBALS["t_coaching"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_rkid=" . urlencode($this->rkid->CurrentValue);
			$detailUrl .= "&fk_area=" . urlencode($this->area->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_rkcoachinglist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_rkcoaching`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, t_rkcoaching.area AS `area2`, (SELECT COUNT(1) FROM t_coaching a WHERE a.rkid = t_rkcoaching.rkid LIMIT 1) AS `real`, NULL AS `sisa` FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, t_rkcoaching.area AS `area2`, (SELECT COUNT(1) FROM t_coaching a WHERE a.rkid = t_rkcoaching.rkid LIMIT 1) AS `real`, NULL AS `sisa`, (SELECT `namap` FROM `t_perusahaan` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`idp` = `t_rkcoaching`.`kerjasama` LIMIT 1) AS `EV__kerjasama`, (SELECT `area` FROM `t_area` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`areaid` = `t_rkcoaching`.`area` LIMIT 1) AS `EV__area` FROM `t_rkcoaching`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList != "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
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
	public function applyUserIDFilters($filter, $id = "")
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
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where != "")
			$where = " " . str_replace(["(", ")"], ["", ""], $where) . " ";
		if ($orderBy != "")
			$orderBy = " " . str_replace(["(", ")"], ["", ""], $orderBy) . " ";
		if ($this->BasicSearch->getKeyword() != "")
			return TRUE;
		if ($this->kerjasama->AdvancedSearch->SearchValue != "" ||
			$this->kerjasama->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->kerjasama->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->kerjasama->VirtualExpression . " "))
			return TRUE;
		if ($this->area->AdvancedSearch->SearchValue != "" ||
			$this->area->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->area->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->area->VirtualExpression . " "))
			return TRUE;
		return FALSE;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
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
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
			$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->rkid->setDbValue($conn->insert_ID());
			$rs['rkid'] = $this->rkid->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();

		// Cascade Update detail table 't_coachingtahapan'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['rkid']) && $rsold['rkid'] != $rs['rkid'])) { // Update detail field 'rkid'
			$cascadeUpdate = TRUE;
			$rscascade['rkid'] = $rs['rkid'];
		}
		if ($rsold && (isset($rs['area']) && $rsold['area'] != $rs['area'])) { // Update detail field 'area'
			$cascadeUpdate = TRUE;
			$rscascade['area'] = $rs['area'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["t_coachingtahapan"]))
				$GLOBALS["t_coachingtahapan"] = new t_coachingtahapan();
			$rswrk = $GLOBALS["t_coachingtahapan"]->loadRs("`rkid` = " . QuotedValue($rsold['rkid'], DATATYPE_NUMBER, 'DB') . " AND " . "`area` = " . QuotedValue($rsold['area'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'ctid';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["t_coachingtahapan"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["t_coachingtahapan"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["t_coachingtahapan"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'rkid';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('rkid', $rs))
				AddFilter($where, QuotedName('rkid', $this->Dbid) . '=' . QuotedValue($rs['rkid'], $this->rkid->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();

		// Cascade delete detail table 't_coachingtahapan'
		if (!isset($GLOBALS["t_coachingtahapan"]))
			$GLOBALS["t_coachingtahapan"] = new t_coachingtahapan();
		$rscascade = $GLOBALS["t_coachingtahapan"]->loadRs("`rkid` = " . QuotedValue($rs['rkid'], DATATYPE_NUMBER, "DB") . " AND " . "`area` = " . QuotedValue($rs['area'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["t_coachingtahapan"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["t_coachingtahapan"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["t_coachingtahapan"]->Row_Deleted($dtlrow);
		}
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->rkid->DbValue = $row['rkid'];
		$this->jenispel->DbValue = $row['jenispel'];
		$this->kdkategori->DbValue = $row['kdkategori'];
		$this->kerjasama->DbValue = $row['kerjasama'];
		$this->area->DbValue = $row['area'];
		$this->area2->DbValue = $row['area2'];
		$this->tempat->DbValue = $row['tempat'];
		$this->jml_tahapan->DbValue = $row['jml_tahapan'];
		$this->jml_peserta->DbValue = $row['jml_peserta'];
		$this->tahun_keg->DbValue = $row['tahun_keg'];
		$this->tglrevisi->DbValue = $row['tglrevisi'];
		$this->mou->Upload->DbValue = $row['mou'];
		$this->real->DbValue = $row['real'];
		$this->sisa->DbValue = $row['sisa'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['mou']) ? [] : [$row['mou']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->mou->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->mou->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`rkid` = @rkid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('rkid', $row) ? $row['rkid'] : NULL;
		else
			$val = $this->rkid->OldValue !== NULL ? $this->rkid->OldValue : $this->rkid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@rkid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "t_rkcoachinglist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "t_rkcoachingview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_rkcoachingedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_rkcoachingadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_rkcoachinglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_rkcoachingview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rkcoachingview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_rkcoachingadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_rkcoachingadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_rkcoachingedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rkcoachingedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		if ($parm != "")
			$url = $this->keyUrl("t_rkcoachingadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rkcoachingadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_rkcoachingdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "rkid:" . JsonEncode($this->rkid->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->rkid->CurrentValue != NULL) {
			$url .= "rkid=" . urlencode($this->rkid->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
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
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("rkid") !== NULL)
				$arKeys[] = Param("rkid");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->rkid->CurrentValue = $key;
			else
				$this->rkid->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->rkid->setDbValue($rs->fields('rkid'));
		$this->jenispel->setDbValue($rs->fields('jenispel'));
		$this->kdkategori->setDbValue($rs->fields('kdkategori'));
		$this->kerjasama->setDbValue($rs->fields('kerjasama'));
		$this->area->setDbValue($rs->fields('area'));
		$this->area2->setDbValue($rs->fields('area2'));
		$this->tempat->setDbValue($rs->fields('tempat'));
		$this->jml_tahapan->setDbValue($rs->fields('jml_tahapan'));
		$this->jml_peserta->setDbValue($rs->fields('jml_peserta'));
		$this->tahun_keg->setDbValue($rs->fields('tahun_keg'));
		$this->tglrevisi->setDbValue($rs->fields('tglrevisi'));
		$this->mou->Upload->DbValue = $rs->fields('mou');
		$this->real->setDbValue($rs->fields('real'));
		$this->sisa->setDbValue($rs->fields('sisa'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// rkid
		// jenispel

		$this->jenispel->CellCssStyle = "white-space: nowrap;";

		// kdkategori
		// kerjasama
		// area
		// area2
		// tempat
		// jml_tahapan
		// jml_peserta
		// tahun_keg
		// tglrevisi
		// mou
		// real
		// sisa
		// rkid

		$this->rkid->ViewValue = $this->rkid->CurrentValue;
		$this->rkid->ViewCustomAttributes = "";

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
		if ($this->kerjasama->VirtualValue != "") {
			$this->kerjasama->ViewValue = $this->kerjasama->VirtualValue;
		} else {
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
		}
		$this->kerjasama->ViewCustomAttributes = "";

		// area
		if ($this->area->VirtualValue != "") {
			$this->area->ViewValue = $this->area->VirtualValue;
		} else {
			$curVal = strval($this->area->CurrentValue);
			if ($curVal != "") {
				$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
				if ($this->area->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->area->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->area->ViewValue = $this->area->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->area->ViewValue = $this->area->CurrentValue;
					}
				}
			} else {
				$this->area->ViewValue = NULL;
			}
		}
		$this->area->ViewCustomAttributes = "";

		// area2
		$curVal = strval($this->area2->CurrentValue);
		if ($curVal != "") {
			$this->area2->ViewValue = $this->area2->lookupCacheOption($curVal);
			if ($this->area2->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->area2->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->area2->ViewValue = $this->area2->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->area2->ViewValue = $this->area2->CurrentValue;
				}
			}
		} else {
			$this->area2->ViewValue = NULL;
		}
		$this->area2->ViewCustomAttributes = "";

		// tempat
		$this->tempat->ViewValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

		// jml_tahapan
		$this->jml_tahapan->ViewValue = $this->jml_tahapan->CurrentValue;
		$this->jml_tahapan->ViewValue = FormatNumber($this->jml_tahapan->ViewValue, 0, -2, -2, -2);
		$this->jml_tahapan->ViewCustomAttributes = "";

		// jml_peserta
		$this->jml_peserta->ViewValue = $this->jml_peserta->CurrentValue;
		$this->jml_peserta->ViewValue = FormatNumber($this->jml_peserta->ViewValue, 0, -2, -2, -2);
		$this->jml_peserta->ViewCustomAttributes = "";

		// tahun_keg
		$curVal = strval($this->tahun_keg->CurrentValue);
		if ($curVal != "") {
			$this->tahun_keg->ViewValue = $this->tahun_keg->lookupCacheOption($curVal);
			if ($this->tahun_keg->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->tahun_keg->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->tahun_keg->ViewValue = $this->tahun_keg->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->tahun_keg->ViewValue = $this->tahun_keg->CurrentValue;
				}
			}
		} else {
			$this->tahun_keg->ViewValue = NULL;
		}
		$this->tahun_keg->ViewCustomAttributes = "";

		// tglrevisi
		$this->tglrevisi->ViewValue = $this->tglrevisi->CurrentValue;
		$this->tglrevisi->ViewValue = FormatDateTime($this->tglrevisi->ViewValue, 0);
		$this->tglrevisi->ViewCustomAttributes = "";

		// mou
		if (!EmptyValue($this->mou->Upload->DbValue)) {
			$this->mou->ViewValue = $this->mou->Upload->DbValue;
		} else {
			$this->mou->ViewValue = "";
		}
		$this->mou->ViewCustomAttributes = "";

		// real
		$this->real->ViewValue = $this->real->CurrentValue;
		$this->real->ViewValue = FormatNumber($this->real->ViewValue, 0, -2, -2, -2);
		$this->real->ViewCustomAttributes = "";

		// sisa
		$this->sisa->ViewValue = $this->sisa->CurrentValue;
		$this->sisa->ViewCustomAttributes = "";

		// rkid
		$this->rkid->LinkCustomAttributes = "";
		$this->rkid->HrefValue = "";
		$this->rkid->TooltipValue = "";

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

		// area
		$this->area->LinkCustomAttributes = "";
		$this->area->HrefValue = "";
		$this->area->TooltipValue = "";

		// area2
		$this->area2->LinkCustomAttributes = "";
		$this->area2->HrefValue = "";
		$this->area2->TooltipValue = "";

		// tempat
		$this->tempat->LinkCustomAttributes = "";
		$this->tempat->HrefValue = "";
		$this->tempat->TooltipValue = "";

		// jml_tahapan
		$this->jml_tahapan->LinkCustomAttributes = "";
		$this->jml_tahapan->HrefValue = "";
		$this->jml_tahapan->TooltipValue = "";

		// jml_peserta
		$this->jml_peserta->LinkCustomAttributes = "";
		$this->jml_peserta->HrefValue = "";
		$this->jml_peserta->TooltipValue = "";

		// tahun_keg
		$this->tahun_keg->LinkCustomAttributes = "";
		$this->tahun_keg->HrefValue = "";
		$this->tahun_keg->TooltipValue = "";

		// tglrevisi
		$this->tglrevisi->LinkCustomAttributes = "";
		$this->tglrevisi->HrefValue = "";
		$this->tglrevisi->TooltipValue = "";

		// mou
		$this->mou->LinkCustomAttributes = "";
		$this->mou->HrefValue = "";
		$this->mou->ExportHrefValue = $this->mou->UploadPath . $this->mou->Upload->DbValue;
		$this->mou->TooltipValue = "";

		// real
		$this->real->LinkCustomAttributes = "";
		$this->real->HrefValue = "";
		$this->real->TooltipValue = "";

		// sisa
		$this->sisa->LinkCustomAttributes = "";
		$this->sisa->HrefValue = "";
		$this->sisa->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// rkid
		$this->rkid->EditAttrs["class"] = "form-control";
		$this->rkid->EditCustomAttributes = "";
		$this->rkid->EditValue = $this->rkid->CurrentValue;
		$this->rkid->ViewCustomAttributes = "";

		// jenispel
		$this->jenispel->EditAttrs["class"] = "form-control";
		$this->jenispel->EditCustomAttributes = "";
		$this->jenispel->EditValue = $this->jenispel->options(TRUE);

		// kdkategori
		$this->kdkategori->EditAttrs["class"] = "form-control";
		$this->kdkategori->EditCustomAttributes = "";

		// kerjasama
		$this->kerjasama->EditAttrs["class"] = "form-control";
		$this->kerjasama->EditCustomAttributes = "";
		$this->kerjasama->EditValue = $this->kerjasama->CurrentValue;
		$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

		// area
		$this->area->EditAttrs["class"] = "form-control";
		$this->area->EditCustomAttributes = "";

		// area2
		$this->area2->EditAttrs["class"] = "form-control";
		$this->area2->EditCustomAttributes = "";

		// tempat
		$this->tempat->EditAttrs["class"] = "form-control";
		$this->tempat->EditCustomAttributes = "";
		if (!$this->tempat->Raw)
			$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
		$this->tempat->EditValue = $this->tempat->CurrentValue;
		$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

		// jml_tahapan
		$this->jml_tahapan->EditAttrs["class"] = "form-control";
		$this->jml_tahapan->EditCustomAttributes = "";
		$this->jml_tahapan->EditValue = $this->jml_tahapan->CurrentValue;
		$this->jml_tahapan->PlaceHolder = RemoveHtml($this->jml_tahapan->caption());

		// jml_peserta
		$this->jml_peserta->EditAttrs["class"] = "form-control";
		$this->jml_peserta->EditCustomAttributes = "";
		$this->jml_peserta->EditValue = $this->jml_peserta->CurrentValue;
		$this->jml_peserta->PlaceHolder = RemoveHtml($this->jml_peserta->caption());

		// tahun_keg
		$this->tahun_keg->EditAttrs["class"] = "form-control";
		$this->tahun_keg->EditCustomAttributes = "";

		// tglrevisi
		// mou

		$this->mou->EditAttrs["class"] = "form-control";
		$this->mou->EditCustomAttributes = "";
		if (!EmptyValue($this->mou->Upload->DbValue)) {
			$this->mou->EditValue = $this->mou->Upload->DbValue;
		} else {
			$this->mou->EditValue = "";
		}
		if (!EmptyValue($this->mou->CurrentValue))
				$this->mou->Upload->FileName = $this->mou->CurrentValue;

		// real
		$this->real->EditAttrs["class"] = "form-control";
		$this->real->EditCustomAttributes = "";
		$this->real->EditValue = $this->real->CurrentValue;
		$this->real->PlaceHolder = RemoveHtml($this->real->caption());

		// sisa
		$this->sisa->EditAttrs["class"] = "form-control";
		$this->sisa->EditCustomAttributes = "";
		$this->sisa->EditValue = $this->sisa->CurrentValue;
		$this->sisa->PlaceHolder = RemoveHtml($this->sisa->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->area);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->jml_tahapan);
					$doc->exportCaption($this->jml_peserta);
					$doc->exportCaption($this->tahun_keg);
					$doc->exportCaption($this->tglrevisi);
					$doc->exportCaption($this->mou);
					$doc->exportCaption($this->real);
					$doc->exportCaption($this->sisa);
				} else {
					$doc->exportCaption($this->rkid);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->area);
					$doc->exportCaption($this->area2);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->jml_tahapan);
					$doc->exportCaption($this->jml_peserta);
					$doc->exportCaption($this->tahun_keg);
					$doc->exportCaption($this->mou);
					$doc->exportCaption($this->real);
					$doc->exportCaption($this->sisa);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->area);
						$doc->exportField($this->tempat);
						$doc->exportField($this->jml_tahapan);
						$doc->exportField($this->jml_peserta);
						$doc->exportField($this->tahun_keg);
						$doc->exportField($this->tglrevisi);
						$doc->exportField($this->mou);
						$doc->exportField($this->real);
						$doc->exportField($this->sisa);
					} else {
						$doc->exportField($this->rkid);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->area);
						$doc->exportField($this->area2);
						$doc->exportField($this->tempat);
						$doc->exportField($this->jml_tahapan);
						$doc->exportField($this->jml_peserta);
						$doc->exportField($this->tahun_keg);
						$doc->exportField($this->mou);
						$doc->exportField($this->real);
						$doc->exportField($this->sisa);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'mou') {
			$fldName = "mou";
			$fileNameFld = "mou";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->rkid->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 't_rkcoaching';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_rkcoaching';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['rkid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 't_rkcoaching';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['rkid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 't_rkcoaching';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['rkid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

		if (CurrentPage()->PageID == "list"){
			$this->sisa->ViewValue = $this->jml_tahapan->ViewValue - $this->real->ViewValue;
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>