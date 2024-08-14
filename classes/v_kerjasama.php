<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for v_kerjasama
 */
class v_kerjasama extends DbTable
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
	public $kdpelat;
	public $kdjudul;
	public $kdkursil;
	public $revisi;
	public $tgl_terbit;
	public $tawal;
	public $takhir;
	public $jenispel;
	public $kdkategori;
	public $kerjasama;
	public $biaya;
	public $tempat;
	public $target_peserta;
	public $durasi1;
	public $durasi2;
	public $nmou;
	public $nmou2;
	public $statuspel;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'v_kerjasama';
		$this->TableName = 'v_kerjasama';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`v_kerjasama`";
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

		// kdpelat
		$this->kdpelat = new DbField('v_kerjasama', 'v_kerjasama', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 20, -1, FALSE, '`kdpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpelat->IsPrimaryKey = TRUE; // Primary key field
		$this->kdpelat->Nullable = FALSE; // NOT NULL field
		$this->kdpelat->Required = TRUE; // Required field
		$this->kdpelat->Sortable = TRUE; // Allow sort
		$this->fields['kdpelat'] = &$this->kdpelat;

		// kdjudul
		$this->kdjudul = new DbField('v_kerjasama', 'v_kerjasama', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], ["x_kdkursil","x_revisi"], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// kdkursil
		$this->kdkursil = new DbField('v_kerjasama', 'v_kerjasama', 'x_kdkursil', 'kdkursil', '`kdkursil`', '`kdkursil`', 200, 12, -1, FALSE, '`kdkursil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdkursil->Sortable = TRUE; // Allow sort
		$this->kdkursil->Lookup = new Lookup('kdkursil', 't_juduldetail', FALSE, 'kdkursil', ["kdkursil","revisi","tgl_terbit",""], ["x_kdjudul"], [], ["kdjudul"], ["x_kdjudul"], ["revisi","tgl_terbit"], ["x_revisi","x_tgl_terbit"], '', '');
		$this->fields['kdkursil'] = &$this->kdkursil;

		// revisi
		$this->revisi = new DbField('v_kerjasama', 'v_kerjasama', 'x_revisi', 'revisi', '`revisi`', '`revisi`', 200, 2, -1, FALSE, '`revisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revisi->Sortable = TRUE; // Allow sort
		$this->fields['revisi'] = &$this->revisi;

		// tgl_terbit
		$this->tgl_terbit = new DbField('v_kerjasama', 'v_kerjasama', 'x_tgl_terbit', 'tgl_terbit', '`tgl_terbit`', CastDateFieldForLike("`tgl_terbit`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_terbit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_terbit->Sortable = TRUE; // Allow sort
		$this->tgl_terbit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_terbit'] = &$this->tgl_terbit;

		// tawal
		$this->tawal = new DbField('v_kerjasama', 'v_kerjasama', 'x_tawal', 'tawal', '`tawal`', CastDateFieldForLike("`tawal`", 0, "DB"), 135, 19, 0, FALSE, '`tawal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tawal->Sortable = TRUE; // Allow sort
		$this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tawal'] = &$this->tawal;

		// takhir
		$this->takhir = new DbField('v_kerjasama', 'v_kerjasama', 'x_takhir', 'takhir', '`takhir`', CastDateFieldForLike("`takhir`", 0, "DB"), 135, 19, 0, FALSE, '`takhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->takhir->Sortable = TRUE; // Allow sort
		$this->takhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['takhir'] = &$this->takhir;

		// jenispel
		$this->jenispel = new DbField('v_kerjasama', 'v_kerjasama', 'x_jenispel', 'jenispel', '`jenispel`', '`jenispel`', 16, 2, -1, FALSE, '`jenispel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenispel->Required = TRUE; // Required field
		$this->jenispel->Sortable = TRUE; // Allow sort
		$this->jenispel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenispel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenispel->Lookup = new Lookup('jenispel', 'v_kerjasama', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenispel->OptionCount = 6;
		$this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenispel'] = &$this->jenispel;

		// kdkategori
		$this->kdkategori = new DbField('v_kerjasama', 'v_kerjasama', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, FALSE, '`kdkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkategori->Required = TRUE; // Required field
		$this->kdkategori->Sortable = TRUE; // Allow sort
		$this->kdkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', FALSE, 'kdkategori', ["kategori","","",""], [], ["x_kerjasama"], [], [], [], [], '`kdkategori` ASC', '');
		$this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkategori'] = &$this->kdkategori;

		// kerjasama
		$this->kerjasama = new DbField('v_kerjasama', 'v_kerjasama', 'x_kerjasama', 'kerjasama', '`kerjasama`', '`kerjasama`', 3, 11, -1, FALSE, '`kerjasama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kerjasama->Required = TRUE; // Required field
		$this->kerjasama->Sortable = TRUE; // Allow sort
		$this->kerjasama->Lookup = new Lookup('kerjasama', 't_perusahaan', FALSE, 'idp', ["namap","","",""], ["x_kdkategori"], [], ["kdkategori"], ["x_kdkategori"], [], [], '`namap` ASC', '');
		$this->kerjasama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kerjasama'] = &$this->kerjasama;

		// biaya
		$this->biaya = new DbField('v_kerjasama', 'v_kerjasama', 'x_biaya', 'biaya', '`biaya`', '`biaya`', 5, 22, -1, FALSE, '`biaya`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->biaya->Required = TRUE; // Required field
		$this->biaya->Sortable = TRUE; // Allow sort
		$this->biaya->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['biaya'] = &$this->biaya;

		// tempat
		$this->tempat = new DbField('v_kerjasama', 'v_kerjasama', 'x_tempat', 'tempat', '`tempat`', '`tempat`', 201, 65535, -1, FALSE, '`tempat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tempat->Sortable = TRUE; // Allow sort
		$this->fields['tempat'] = &$this->tempat;

		// target_peserta
		$this->target_peserta = new DbField('v_kerjasama', 'v_kerjasama', 'x_target_peserta', 'target_peserta', '`target_peserta`', '`target_peserta`', 201, 65535, -1, FALSE, '`target_peserta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->target_peserta->Sortable = TRUE; // Allow sort
		$this->fields['target_peserta'] = &$this->target_peserta;

		// durasi1
		$this->durasi1 = new DbField('v_kerjasama', 'v_kerjasama', 'x_durasi1', 'durasi1', '`durasi1`', '`durasi1`', 200, 50, -1, FALSE, '`durasi1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->durasi1->Sortable = TRUE; // Allow sort
		$this->fields['durasi1'] = &$this->durasi1;

		// durasi2
		$this->durasi2 = new DbField('v_kerjasama', 'v_kerjasama', 'x_durasi2', 'durasi2', '`durasi2`', '`durasi2`', 200, 50, -1, FALSE, '`durasi2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->durasi2->Sortable = TRUE; // Allow sort
		$this->fields['durasi2'] = &$this->durasi2;

		// nmou
		$this->nmou = new DbField('v_kerjasama', 'v_kerjasama', 'x_nmou', 'nmou', '`nmou`', '`nmou`', 200, 255, -1, TRUE, '`nmou`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->nmou->Sortable = TRUE; // Allow sort
		$this->fields['nmou'] = &$this->nmou;

		// nmou2
		$this->nmou2 = new DbField('v_kerjasama', 'v_kerjasama', 'x_nmou2', 'nmou2', '`nmou2`', '`nmou2`', 200, 255, -1, TRUE, '`nmou2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->nmou2->Sortable = TRUE; // Allow sort
		$this->fields['nmou2'] = &$this->nmou2;

		// statuspel
		$this->statuspel = new DbField('v_kerjasama', 'v_kerjasama', 'x_statuspel', 'statuspel', '`statuspel`', '`statuspel`', 16, 2, -1, FALSE, '`statuspel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->statuspel->Required = TRUE; // Required field
		$this->statuspel->Sortable = TRUE; // Allow sort
		$this->statuspel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->statuspel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->statuspel->Lookup = new Lookup('statuspel', 'v_kerjasama', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->statuspel->OptionCount = 5;
		$this->statuspel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['statuspel'] = &$this->statuspel;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_kerjasama`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
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
			"SELECT *, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `v_kerjasama`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `v_kerjasama`" .
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
		$this->TableFilter = "(`jenispel` >= 3 AND `jenispel` <= 8)";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`tawal` DESC";
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
		if ($this->kdjudul->AdvancedSearch->SearchValue != "" ||
			$this->kdjudul->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->kdjudul->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->kdjudul->VirtualExpression . " "))
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
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'kdpelat';
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
			if (array_key_exists('kdpelat', $rs))
				AddFilter($where, QuotedName('kdpelat', $this->Dbid) . '=' . QuotedValue($rs['kdpelat'], $this->kdpelat->DataType, $this->Dbid));
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
		$this->kdpelat->DbValue = $row['kdpelat'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->kdkursil->DbValue = $row['kdkursil'];
		$this->revisi->DbValue = $row['revisi'];
		$this->tgl_terbit->DbValue = $row['tgl_terbit'];
		$this->tawal->DbValue = $row['tawal'];
		$this->takhir->DbValue = $row['takhir'];
		$this->jenispel->DbValue = $row['jenispel'];
		$this->kdkategori->DbValue = $row['kdkategori'];
		$this->kerjasama->DbValue = $row['kerjasama'];
		$this->biaya->DbValue = $row['biaya'];
		$this->tempat->DbValue = $row['tempat'];
		$this->target_peserta->DbValue = $row['target_peserta'];
		$this->durasi1->DbValue = $row['durasi1'];
		$this->durasi2->DbValue = $row['durasi2'];
		$this->nmou->Upload->DbValue = $row['nmou'];
		$this->nmou2->Upload->DbValue = $row['nmou2'];
		$this->statuspel->DbValue = $row['statuspel'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['nmou']) ? [] : [$row['nmou']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->nmou->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->nmou->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['nmou2']) ? [] : [$row['nmou2']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->nmou2->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->nmou2->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`kdpelat` = '@kdpelat@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('kdpelat', $row) ? $row['kdpelat'] : NULL;
		else
			$val = $this->kdpelat->OldValue !== NULL ? $this->kdpelat->OldValue : $this->kdpelat->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@kdpelat@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "v_kerjasamalist.php";
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
		if ($pageName == "v_kerjasamaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "v_kerjasamaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "v_kerjasamaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "v_kerjasamalist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("v_kerjasamaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("v_kerjasamaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "v_kerjasamaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "v_kerjasamaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("v_kerjasamaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("v_kerjasamaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("v_kerjasamadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "kdpelat:" . JsonEncode($this->kdpelat->CurrentValue, "string");
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
		if ($this->kdpelat->CurrentValue != NULL) {
			$url .= "kdpelat=" . urlencode($this->kdpelat->CurrentValue);
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
			if (Param("kdpelat") !== NULL)
				$arKeys[] = Param("kdpelat");
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
				$this->kdpelat->CurrentValue = $key;
			else
				$this->kdpelat->OldValue = $key;
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
		$this->kdpelat->setDbValue($rs->fields('kdpelat'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->kdkursil->setDbValue($rs->fields('kdkursil'));
		$this->revisi->setDbValue($rs->fields('revisi'));
		$this->tgl_terbit->setDbValue($rs->fields('tgl_terbit'));
		$this->tawal->setDbValue($rs->fields('tawal'));
		$this->takhir->setDbValue($rs->fields('takhir'));
		$this->jenispel->setDbValue($rs->fields('jenispel'));
		$this->kdkategori->setDbValue($rs->fields('kdkategori'));
		$this->kerjasama->setDbValue($rs->fields('kerjasama'));
		$this->biaya->setDbValue($rs->fields('biaya'));
		$this->tempat->setDbValue($rs->fields('tempat'));
		$this->target_peserta->setDbValue($rs->fields('target_peserta'));
		$this->durasi1->setDbValue($rs->fields('durasi1'));
		$this->durasi2->setDbValue($rs->fields('durasi2'));
		$this->nmou->Upload->DbValue = $rs->fields('nmou');
		$this->nmou2->Upload->DbValue = $rs->fields('nmou2');
		$this->statuspel->setDbValue($rs->fields('statuspel'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// kdpelat
		// kdjudul
		// kdkursil
		// revisi
		// tgl_terbit
		// tawal
		// takhir
		// jenispel
		// kdkategori
		// kerjasama
		// biaya
		// tempat
		// target_peserta
		// durasi1
		// durasi2
		// nmou
		// nmou2
		// statuspel
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

		// tawal
		$this->tawal->ViewValue = $this->tawal->CurrentValue;
		$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->ViewValue = $this->takhir->CurrentValue;
		$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
		$this->takhir->ViewCustomAttributes = "";

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

		// tempat
		$this->tempat->ViewValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

		// target_peserta
		$this->target_peserta->ViewValue = $this->target_peserta->CurrentValue;
		$this->target_peserta->ViewCustomAttributes = "";

		// durasi1
		$this->durasi1->ViewValue = $this->durasi1->CurrentValue;
		$this->durasi1->ViewCustomAttributes = "";

		// durasi2
		$this->durasi2->ViewValue = $this->durasi2->CurrentValue;
		$this->durasi2->ViewCustomAttributes = "";

		// nmou
		if (!EmptyValue($this->nmou->Upload->DbValue)) {
			$this->nmou->ViewValue = $this->nmou->Upload->DbValue;
		} else {
			$this->nmou->ViewValue = "";
		}
		$this->nmou->ViewCustomAttributes = "";

		// nmou2
		if (!EmptyValue($this->nmou2->Upload->DbValue)) {
			$this->nmou2->ViewValue = $this->nmou2->Upload->DbValue;
		} else {
			$this->nmou2->ViewValue = "";
		}
		$this->nmou2->ViewCustomAttributes = "";

		// statuspel
		if (strval($this->statuspel->CurrentValue) != "") {
			$this->statuspel->ViewValue = $this->statuspel->optionCaption($this->statuspel->CurrentValue);
		} else {
			$this->statuspel->ViewValue = NULL;
		}
		$this->statuspel->ViewCustomAttributes = "";

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

		// tawal
		$this->tawal->LinkCustomAttributes = "";
		$this->tawal->HrefValue = "";
		$this->tawal->TooltipValue = "";

		// takhir
		$this->takhir->LinkCustomAttributes = "";
		$this->takhir->HrefValue = "";
		$this->takhir->TooltipValue = "";

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

		// tempat
		$this->tempat->LinkCustomAttributes = "";
		$this->tempat->HrefValue = "";
		$this->tempat->TooltipValue = "";

		// target_peserta
		$this->target_peserta->LinkCustomAttributes = "";
		$this->target_peserta->HrefValue = "";
		$this->target_peserta->TooltipValue = "";

		// durasi1
		$this->durasi1->LinkCustomAttributes = "";
		$this->durasi1->HrefValue = "";
		$this->durasi1->TooltipValue = "";

		// durasi2
		$this->durasi2->LinkCustomAttributes = "";
		$this->durasi2->HrefValue = "";
		$this->durasi2->TooltipValue = "";

		// nmou
		$this->nmou->LinkCustomAttributes = "";
		$this->nmou->HrefValue = "";
		$this->nmou->ExportHrefValue = $this->nmou->UploadPath . $this->nmou->Upload->DbValue;
		$this->nmou->TooltipValue = "";

		// nmou2
		$this->nmou2->LinkCustomAttributes = "";
		$this->nmou2->HrefValue = "";
		$this->nmou2->ExportHrefValue = $this->nmou2->UploadPath . $this->nmou2->Upload->DbValue;
		$this->nmou2->TooltipValue = "";

		// statuspel
		$this->statuspel->LinkCustomAttributes = "";
		$this->statuspel->HrefValue = "";
		$this->statuspel->TooltipValue = "";

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

		// kdpelat
		$this->kdpelat->EditAttrs["class"] = "form-control";
		$this->kdpelat->EditCustomAttributes = "";
		$this->kdpelat->EditValue = $this->kdpelat->CurrentValue;
		$this->kdpelat->ViewCustomAttributes = "";

		// kdjudul
		$this->kdjudul->EditAttrs["class"] = "form-control";
		$this->kdjudul->EditCustomAttributes = "";
		if ($this->kdjudul->VirtualValue != "") {
			$this->kdjudul->EditValue = $this->kdjudul->VirtualValue;
		} else {
			$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
			$curVal = strval($this->kdjudul->CurrentValue);
			if ($curVal != "") {
				$this->kdjudul->EditValue = $this->kdjudul->lookupCacheOption($curVal);
				if ($this->kdjudul->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdjudul`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->kdjudul->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdjudul->EditValue = $this->kdjudul->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
					}
				}
			} else {
				$this->kdjudul->EditValue = NULL;
			}
		}
		$this->kdjudul->ViewCustomAttributes = "";

		// kdkursil
		$this->kdkursil->EditAttrs["class"] = "form-control";
		$this->kdkursil->EditCustomAttributes = "";
		if (!$this->kdkursil->Raw)
			$this->kdkursil->CurrentValue = HtmlDecode($this->kdkursil->CurrentValue);
		$this->kdkursil->EditValue = $this->kdkursil->CurrentValue;
		$this->kdkursil->PlaceHolder = RemoveHtml($this->kdkursil->caption());

		// revisi
		$this->revisi->EditAttrs["class"] = "form-control";
		$this->revisi->EditCustomAttributes = "";
		if (!$this->revisi->Raw)
			$this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
		$this->revisi->EditValue = $this->revisi->CurrentValue;
		$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

		// tgl_terbit
		$this->tgl_terbit->EditAttrs["class"] = "form-control";
		$this->tgl_terbit->EditCustomAttributes = "";
		$this->tgl_terbit->EditValue = FormatDateTime($this->tgl_terbit->CurrentValue, 8);
		$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

		// tawal
		$this->tawal->EditAttrs["class"] = "form-control";
		$this->tawal->EditCustomAttributes = "";
		$this->tawal->EditValue = $this->tawal->CurrentValue;
		$this->tawal->EditValue = FormatDateTime($this->tawal->EditValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->EditAttrs["class"] = "form-control";
		$this->takhir->EditCustomAttributes = "";
		$this->takhir->EditValue = FormatDateTime($this->takhir->CurrentValue, 8);
		$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

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

		// biaya
		$this->biaya->EditAttrs["class"] = "form-control";
		$this->biaya->EditCustomAttributes = "";
		$this->biaya->EditValue = $this->biaya->CurrentValue;
		$this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
		if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue))
			$this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -1, -2, 0);
		

		// tempat
		$this->tempat->EditAttrs["class"] = "form-control";
		$this->tempat->EditCustomAttributes = "";
		if (!$this->tempat->Raw)
			$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
		$this->tempat->EditValue = $this->tempat->CurrentValue;
		$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

		// target_peserta
		$this->target_peserta->EditAttrs["class"] = "form-control";
		$this->target_peserta->EditCustomAttributes = "";
		if (!$this->target_peserta->Raw)
			$this->target_peserta->CurrentValue = HtmlDecode($this->target_peserta->CurrentValue);
		$this->target_peserta->EditValue = $this->target_peserta->CurrentValue;
		$this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

		// durasi1
		$this->durasi1->EditAttrs["class"] = "form-control";
		$this->durasi1->EditCustomAttributes = "";
		if (!$this->durasi1->Raw)
			$this->durasi1->CurrentValue = HtmlDecode($this->durasi1->CurrentValue);
		$this->durasi1->EditValue = $this->durasi1->CurrentValue;
		$this->durasi1->PlaceHolder = RemoveHtml($this->durasi1->caption());

		// durasi2
		$this->durasi2->EditAttrs["class"] = "form-control";
		$this->durasi2->EditCustomAttributes = "";
		if (!$this->durasi2->Raw)
			$this->durasi2->CurrentValue = HtmlDecode($this->durasi2->CurrentValue);
		$this->durasi2->EditValue = $this->durasi2->CurrentValue;
		$this->durasi2->PlaceHolder = RemoveHtml($this->durasi2->caption());

		// nmou
		$this->nmou->EditAttrs["class"] = "form-control";
		$this->nmou->EditCustomAttributes = "";
		if (!EmptyValue($this->nmou->Upload->DbValue)) {
			$this->nmou->EditValue = $this->nmou->Upload->DbValue;
		} else {
			$this->nmou->EditValue = "";
		}
		if (!EmptyValue($this->nmou->CurrentValue))
				$this->nmou->Upload->FileName = $this->nmou->CurrentValue;

		// nmou2
		$this->nmou2->EditAttrs["class"] = "form-control";
		$this->nmou2->EditCustomAttributes = "";
		if (!EmptyValue($this->nmou2->Upload->DbValue)) {
			$this->nmou2->EditValue = $this->nmou2->Upload->DbValue;
		} else {
			$this->nmou2->EditValue = "";
		}
		if (!EmptyValue($this->nmou2->CurrentValue))
				$this->nmou2->Upload->FileName = $this->nmou2->CurrentValue;

		// statuspel
		$this->statuspel->EditAttrs["class"] = "form-control";
		$this->statuspel->EditCustomAttributes = "";
		$this->statuspel->EditValue = $this->statuspel->options(TRUE);

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
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->tgl_terbit);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->biaya);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->target_peserta);
					$doc->exportCaption($this->durasi1);
					$doc->exportCaption($this->durasi2);
					$doc->exportCaption($this->nmou);
					$doc->exportCaption($this->nmou2);
					$doc->exportCaption($this->statuspel);
				} else {
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->tgl_terbit);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->biaya);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->target_peserta);
					$doc->exportCaption($this->durasi1);
					$doc->exportCaption($this->durasi2);
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
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->revisi);
						$doc->exportField($this->tgl_terbit);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->biaya);
						$doc->exportField($this->tempat);
						$doc->exportField($this->target_peserta);
						$doc->exportField($this->durasi1);
						$doc->exportField($this->durasi2);
						$doc->exportField($this->nmou);
						$doc->exportField($this->nmou2);
						$doc->exportField($this->statuspel);
					} else {
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->revisi);
						$doc->exportField($this->tgl_terbit);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->biaya);
						$doc->exportField($this->tempat);
						$doc->exportField($this->target_peserta);
						$doc->exportField($this->durasi1);
						$doc->exportField($this->durasi2);
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
		if ($fldparm == 'nmou') {
			$fldName = "nmou";
			$fileNameFld = "nmou";
		} elseif ($fldparm == 'nmou2') {
			$fldName = "nmou2";
			$fileNameFld = "nmou2";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->kdpelat->CurrentValue = $ar[0];
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
		$table = 'v_kerjasama';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'v_kerjasama';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['kdpelat'];

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
		$table = 'v_kerjasama';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['kdpelat'];

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
		$table = 'v_kerjasama';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['kdpelat'];

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

		$kdpelat = $rsnew["kdjudul"];
		$kdpelat .= "L"; // perbaikan kode D dan L 
		$kdpelat .= $rsnew["tawal"];
		$pelatarray = array(1 => 'A', 'B', 'C', 'D');
		$arraykey = 0;
		do {
			$arraykey++;
			$newkdpelat = $kdpelat . $pelatarray[$arraykey];
			$checknewpelat = ExecuteScalar("SELECT COUNT(1) FROM t_pelatihan WHERE kdpelat = '".$newkdpelat."'");
			$numpelat = $checknewpelat;
		} while($numpelat > 0);
		$kdpelat = $newkdpelat;
		$rsnew["kdpelat"] = $kdpelat;

		//$this->setWarningMessage($kdpelat);
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

		$this->kdpelat->Visible = FALSE;
		$this->biaya->ViewValue = CSFormatRupiah($this->biaya->ViewValue);
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>