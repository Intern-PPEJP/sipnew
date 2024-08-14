<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for diklatpusat
 */
class diklatpusat extends DbTable
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

	// Export
	public $ExportDoc;

	// Fields
	public $idpelat;
	public $kdpelat;
	public $kdjudul;
	public $tawal;
	public $takhir;
	public $dana;
	public $ketua;
	public $sekretaris;
	public $bendahara;
	public $anggota2;
	public $widyaiswara;
	public $statuspel;
	public $ket;
	public $rid;
	public $jenispel;
	public $jenisevaluasi;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'diklatpusat';
		$this->TableName = 'diklatpusat';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`diklatpusat`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// idpelat
		$this->idpelat = new DbField('diklatpusat', 'diklatpusat', 'x_idpelat', 'idpelat', '`idpelat`', '`idpelat`', 3, 11, -1, FALSE, '`idpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idpelat->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idpelat->IsPrimaryKey = TRUE; // Primary key field
		$this->idpelat->Sortable = TRUE; // Allow sort
		$this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idpelat'] = &$this->idpelat;

		// kdpelat
		$this->kdpelat = new DbField('diklatpusat', 'diklatpusat', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 20, -1, FALSE, '`kdpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpelat->Nullable = FALSE; // NOT NULL field
		$this->kdpelat->Required = TRUE; // Required field
		$this->kdpelat->Sortable = TRUE; // Allow sort
		$this->fields['kdpelat'] = &$this->kdpelat;

		// kdjudul
		$this->kdjudul = new DbField('diklatpusat', 'diklatpusat', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->IsForeignKey = TRUE; // Foreign key field
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// tawal
		$this->tawal = new DbField('diklatpusat', 'diklatpusat', 'x_tawal', 'tawal', '`tawal`', CastDateFieldForLike("`tawal`", 0, "DB"), 135, 19, 0, FALSE, '`tawal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tawal->Required = TRUE; // Required field
		$this->tawal->Sortable = TRUE; // Allow sort
		$this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tawal'] = &$this->tawal;

		// takhir
		$this->takhir = new DbField('diklatpusat', 'diklatpusat', 'x_takhir', 'takhir', '`takhir`', CastDateFieldForLike("`takhir`", 0, "DB"), 135, 19, 0, FALSE, '`takhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->takhir->Required = TRUE; // Required field
		$this->takhir->Sortable = TRUE; // Allow sort
		$this->takhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['takhir'] = &$this->takhir;

		// dana
		$this->dana = new DbField('diklatpusat', 'diklatpusat', 'x_dana', 'dana', '`dana`', '`dana`', 200, 25, -1, FALSE, '`dana`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->dana->Sortable = TRUE; // Allow sort
		$this->dana->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->dana->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->dana->Lookup = new Lookup('dana', 'diklatpusat', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->dana->OptionCount = 4;
		$this->fields['dana'] = &$this->dana;

		// ketua
		$this->ketua = new DbField('diklatpusat', 'diklatpusat', 'x_ketua', 'ketua', '`ketua`', '`ketua`', 200, 40, -1, FALSE, '`ketua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ketua->Sortable = TRUE; // Allow sort
		$this->ketua->Lookup = new Lookup('ketua', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['ketua'] = &$this->ketua;

		// sekretaris
		$this->sekretaris = new DbField('diklatpusat', 'diklatpusat', 'x_sekretaris', 'sekretaris', '`sekretaris`', '`sekretaris`', 200, 40, -1, FALSE, '`sekretaris`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sekretaris->Sortable = TRUE; // Allow sort
		$this->sekretaris->Lookup = new Lookup('sekretaris', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['sekretaris'] = &$this->sekretaris;

		// bendahara
		$this->bendahara = new DbField('diklatpusat', 'diklatpusat', 'x_bendahara', 'bendahara', '`bendahara`', '`bendahara`', 200, 40, -1, FALSE, '`bendahara`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bendahara->Sortable = TRUE; // Allow sort
		$this->bendahara->Lookup = new Lookup('bendahara', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['bendahara'] = &$this->bendahara;

		// anggota2
		$this->anggota2 = new DbField('diklatpusat', 'diklatpusat', 'x_anggota2', 'anggota2', '`anggota2`', '`anggota2`', 200, 40, -1, FALSE, '`anggota2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->anggota2->Sortable = TRUE; // Allow sort
		$this->anggota2->Lookup = new Lookup('anggota2', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['anggota2'] = &$this->anggota2;

		// widyaiswara
		$this->widyaiswara = new DbField('diklatpusat', 'diklatpusat', 'x_widyaiswara', 'widyaiswara', '`widyaiswara`', '`widyaiswara`', 3, 11, -1, FALSE, '`widyaiswara`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->widyaiswara->Sortable = TRUE; // Allow sort
		$this->widyaiswara->Lookup = new Lookup('widyaiswara', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->widyaiswara->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['widyaiswara'] = &$this->widyaiswara;

		// statuspel
		$this->statuspel = new DbField('diklatpusat', 'diklatpusat', 'x_statuspel', 'statuspel', '`statuspel`', '`statuspel`', 16, 2, -1, FALSE, '`statuspel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->statuspel->Required = TRUE; // Required field
		$this->statuspel->Sortable = TRUE; // Allow sort
		$this->statuspel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->statuspel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->statuspel->Lookup = new Lookup('statuspel', 'diklatpusat', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->statuspel->OptionCount = 4;
		$this->statuspel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['statuspel'] = &$this->statuspel;

		// ket
		$this->ket = new DbField('diklatpusat', 'diklatpusat', 'x_ket', 'ket', '`ket`', '`ket`', 201, 65535, -1, FALSE, '`ket`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ket->Sortable = TRUE; // Allow sort
		$this->fields['ket'] = &$this->ket;

		// rid
		$this->rid = new DbField('diklatpusat', 'diklatpusat', 'x_rid', 'rid', '`rid`', '`rid`', 3, 11, -1, FALSE, '`rid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rid->IsForeignKey = TRUE; // Foreign key field
		$this->rid->Sortable = TRUE; // Allow sort
		$this->rid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rid'] = &$this->rid;

		// jenispel
		$this->jenispel = new DbField('diklatpusat', 'diklatpusat', 'x_jenispel', 'jenispel', '`jenispel`', '`jenispel`', 16, 2, -1, FALSE, '`jenispel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenispel->Sortable = TRUE; // Allow sort
		$this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenispel'] = &$this->jenispel;

		// jenisevaluasi
		$this->jenisevaluasi = new DbField('diklatpusat', 'diklatpusat', 'x_jenisevaluasi', 'jenisevaluasi', '`jenisevaluasi`', '`jenisevaluasi`', 200, 25, -1, FALSE, '`jenisevaluasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->jenisevaluasi->Nullable = FALSE; // NOT NULL field
		$this->jenisevaluasi->Required = TRUE; // Required field
		$this->jenisevaluasi->Sortable = TRUE; // Allow sort
		$this->jenisevaluasi->Lookup = new Lookup('jenisevaluasi', 't_evaluasi', FALSE, 'id', ["jenis_evaluasi","","",""], [], [], [], [], [], [], '', '');
		$this->jenisevaluasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenisevaluasi'] = &$this->jenisevaluasi;
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

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "t_rpdiklat") {
			if ($this->rid->getSessionValue() != "")
				$masterFilter .= "`rpdid`=" . QuotedValue($this->rid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->kdjudul->getSessionValue() != "")
				$masterFilter .= " AND `kdjudul`=" . QuotedValue($this->kdjudul->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "t_rpdiklat") {
			if ($this->rid->getSessionValue() != "")
				$detailFilter .= "`rid`=" . QuotedValue($this->rid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->kdjudul->getSessionValue() != "")
				$detailFilter .= " AND `kdjudul`=" . QuotedValue($this->kdjudul->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_t_rpdiklat()
	{
		return "`rpdid`=@rpdid@ AND `kdjudul`='@kdjudul@'";
	}

	// Detail filter
	public function sqlDetailFilter_t_rpdiklat()
	{
		return "`rid`=@rid@ AND `kdjudul`='@kdjudul@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`diklatpusat`";
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
			"SELECT *, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `diklatpusat`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `diklatpusat`" .
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
		$this->TableFilter = "`jenispel` = 1";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`tawal` ASC";
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

			// Get insert id if necessary
			$this->idpelat->setDbValue($conn->insert_ID());
			$rs['idpelat'] = $this->idpelat->DbValue;
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
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('idpelat', $rs))
				AddFilter($where, QuotedName('idpelat', $this->Dbid) . '=' . QuotedValue($rs['idpelat'], $this->idpelat->DataType, $this->Dbid));
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
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idpelat->DbValue = $row['idpelat'];
		$this->kdpelat->DbValue = $row['kdpelat'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->tawal->DbValue = $row['tawal'];
		$this->takhir->DbValue = $row['takhir'];
		$this->dana->DbValue = $row['dana'];
		$this->ketua->DbValue = $row['ketua'];
		$this->sekretaris->DbValue = $row['sekretaris'];
		$this->bendahara->DbValue = $row['bendahara'];
		$this->anggota2->DbValue = $row['anggota2'];
		$this->widyaiswara->DbValue = $row['widyaiswara'];
		$this->statuspel->DbValue = $row['statuspel'];
		$this->ket->DbValue = $row['ket'];
		$this->rid->DbValue = $row['rid'];
		$this->jenispel->DbValue = $row['jenispel'];
		$this->jenisevaluasi->DbValue = $row['jenisevaluasi'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`idpelat` = @idpelat@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('idpelat', $row) ? $row['idpelat'] : NULL;
		else
			$val = $this->idpelat->OldValue !== NULL ? $this->idpelat->OldValue : $this->idpelat->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@idpelat@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "diklatpusatlist.php";
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
		if ($pageName == "diklatpusatview.php")
			return $Language->phrase("View");
		elseif ($pageName == "diklatpusatedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "diklatpusatadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "diklatpusatlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("diklatpusatview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("diklatpusatview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "diklatpusatadd.php?" . $this->getUrlParm($parm);
		else
			$url = "diklatpusatadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("diklatpusatedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("diklatpusatadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("diklatpusatdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "t_rpdiklat" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_rpdid=" . urlencode($this->rid->CurrentValue);
			$url .= "&fk_kdjudul=" . urlencode($this->kdjudul->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "idpelat:" . JsonEncode($this->idpelat->CurrentValue, "number");
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
		if ($this->idpelat->CurrentValue != NULL) {
			$url .= "idpelat=" . urlencode($this->idpelat->CurrentValue);
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
			if (Param("idpelat") !== NULL)
				$arKeys[] = Param("idpelat");
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
				$this->idpelat->CurrentValue = $key;
			else
				$this->idpelat->OldValue = $key;
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
		$this->idpelat->setDbValue($rs->fields('idpelat'));
		$this->kdpelat->setDbValue($rs->fields('kdpelat'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->tawal->setDbValue($rs->fields('tawal'));
		$this->takhir->setDbValue($rs->fields('takhir'));
		$this->dana->setDbValue($rs->fields('dana'));
		$this->ketua->setDbValue($rs->fields('ketua'));
		$this->sekretaris->setDbValue($rs->fields('sekretaris'));
		$this->bendahara->setDbValue($rs->fields('bendahara'));
		$this->anggota2->setDbValue($rs->fields('anggota2'));
		$this->widyaiswara->setDbValue($rs->fields('widyaiswara'));
		$this->statuspel->setDbValue($rs->fields('statuspel'));
		$this->ket->setDbValue($rs->fields('ket'));
		$this->rid->setDbValue($rs->fields('rid'));
		$this->jenispel->setDbValue($rs->fields('jenispel'));
		$this->jenisevaluasi->setDbValue($rs->fields('jenisevaluasi'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// idpelat
		// kdpelat
		// kdjudul
		// tawal
		// takhir
		// dana
		// ketua
		// sekretaris
		// bendahara
		// anggota2
		// widyaiswara
		// statuspel
		// ket
		// rid
		// jenispel

		$this->jenispel->CellCssStyle = "white-space: nowrap;";

		// jenisevaluasi
		// idpelat

		$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
		$this->idpelat->ViewCustomAttributes = "";

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

		// tawal
		$this->tawal->ViewValue = $this->tawal->CurrentValue;
		$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->ViewValue = $this->takhir->CurrentValue;
		$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
		$this->takhir->ViewCustomAttributes = "";

		// dana
		if (strval($this->dana->CurrentValue) != "") {
			$this->dana->ViewValue = $this->dana->optionCaption($this->dana->CurrentValue);
		} else {
			$this->dana->ViewValue = NULL;
		}
		$this->dana->ViewCustomAttributes = "";

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

		// rid
		$this->rid->ViewValue = $this->rid->CurrentValue;
		$this->rid->ViewCustomAttributes = "";

		// jenispel
		$this->jenispel->ViewValue = $this->jenispel->CurrentValue;
		$this->jenispel->ViewCustomAttributes = "";

		// jenisevaluasi
		$curVal = strval($this->jenisevaluasi->CurrentValue);
		if ($curVal != "") {
			$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->lookupCacheOption($curVal);
			if ($this->jenisevaluasi->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`id`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->jenisevaluasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->jenisevaluasi->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jenisevaluasi->ViewValue->add($this->jenisevaluasi->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->CurrentValue;
				}
			}
		} else {
			$this->jenisevaluasi->ViewValue = NULL;
		}
		$this->jenisevaluasi->ViewCustomAttributes = "";

		// idpelat
		$this->idpelat->LinkCustomAttributes = "";
		$this->idpelat->HrefValue = "";
		$this->idpelat->TooltipValue = "";

		// kdpelat
		$this->kdpelat->LinkCustomAttributes = "";
		$this->kdpelat->HrefValue = "";
		$this->kdpelat->TooltipValue = "";

		// kdjudul
		$this->kdjudul->LinkCustomAttributes = "";
		$this->kdjudul->HrefValue = "";
		$this->kdjudul->TooltipValue = "";

		// tawal
		$this->tawal->LinkCustomAttributes = "";
		$this->tawal->HrefValue = "";
		$this->tawal->TooltipValue = "";

		// takhir
		$this->takhir->LinkCustomAttributes = "";
		$this->takhir->HrefValue = "";
		$this->takhir->TooltipValue = "";

		// dana
		$this->dana->LinkCustomAttributes = "";
		$this->dana->HrefValue = "";
		$this->dana->TooltipValue = "";

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

		// statuspel
		$this->statuspel->LinkCustomAttributes = "";
		$this->statuspel->HrefValue = "";
		$this->statuspel->TooltipValue = "";

		// ket
		$this->ket->LinkCustomAttributes = "";
		$this->ket->HrefValue = "";
		$this->ket->TooltipValue = "";

		// rid
		$this->rid->LinkCustomAttributes = "";
		$this->rid->HrefValue = "";
		$this->rid->TooltipValue = "";

		// jenispel
		$this->jenispel->LinkCustomAttributes = "";
		$this->jenispel->HrefValue = "";
		$this->jenispel->TooltipValue = "";

		// jenisevaluasi
		$this->jenisevaluasi->LinkCustomAttributes = "";
		$this->jenisevaluasi->HrefValue = "";
		$this->jenisevaluasi->TooltipValue = "";

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

		// idpelat
		$this->idpelat->EditAttrs["class"] = "form-control";
		$this->idpelat->EditCustomAttributes = "";
		$this->idpelat->EditValue = $this->idpelat->CurrentValue;
		$this->idpelat->ViewCustomAttributes = "";

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

		// tawal
		$this->tawal->EditAttrs["class"] = "form-control";
		$this->tawal->EditCustomAttributes = "";
		$this->tawal->EditValue = FormatDateTime($this->tawal->CurrentValue, 8);
		$this->tawal->PlaceHolder = RemoveHtml($this->tawal->caption());

		// takhir
		$this->takhir->EditAttrs["class"] = "form-control";
		$this->takhir->EditCustomAttributes = "";
		$this->takhir->EditValue = FormatDateTime($this->takhir->CurrentValue, 8);
		$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

		// dana
		$this->dana->EditAttrs["class"] = "form-control";
		$this->dana->EditCustomAttributes = "";
		$this->dana->EditValue = $this->dana->options(TRUE);

		// ketua
		$this->ketua->EditAttrs["class"] = "form-control";
		$this->ketua->EditCustomAttributes = "";
		if (!$this->ketua->Raw)
			$this->ketua->CurrentValue = HtmlDecode($this->ketua->CurrentValue);
		$this->ketua->EditValue = $this->ketua->CurrentValue;
		$this->ketua->PlaceHolder = RemoveHtml($this->ketua->caption());

		// sekretaris
		$this->sekretaris->EditAttrs["class"] = "form-control";
		$this->sekretaris->EditCustomAttributes = "";
		if (!$this->sekretaris->Raw)
			$this->sekretaris->CurrentValue = HtmlDecode($this->sekretaris->CurrentValue);
		$this->sekretaris->EditValue = $this->sekretaris->CurrentValue;
		$this->sekretaris->PlaceHolder = RemoveHtml($this->sekretaris->caption());

		// bendahara
		$this->bendahara->EditAttrs["class"] = "form-control";
		$this->bendahara->EditCustomAttributes = "";
		if (!$this->bendahara->Raw)
			$this->bendahara->CurrentValue = HtmlDecode($this->bendahara->CurrentValue);
		$this->bendahara->EditValue = $this->bendahara->CurrentValue;
		$this->bendahara->PlaceHolder = RemoveHtml($this->bendahara->caption());

		// anggota2
		$this->anggota2->EditAttrs["class"] = "form-control";
		$this->anggota2->EditCustomAttributes = "";
		if (!$this->anggota2->Raw)
			$this->anggota2->CurrentValue = HtmlDecode($this->anggota2->CurrentValue);
		$this->anggota2->EditValue = $this->anggota2->CurrentValue;
		$this->anggota2->PlaceHolder = RemoveHtml($this->anggota2->caption());

		// widyaiswara
		$this->widyaiswara->EditAttrs["class"] = "form-control";
		$this->widyaiswara->EditCustomAttributes = "";
		$this->widyaiswara->EditValue = $this->widyaiswara->CurrentValue;
		$this->widyaiswara->PlaceHolder = RemoveHtml($this->widyaiswara->caption());

		// statuspel
		$this->statuspel->EditAttrs["class"] = "form-control";
		$this->statuspel->EditCustomAttributes = "";
		$this->statuspel->EditValue = $this->statuspel->options(TRUE);

		// ket
		$this->ket->EditAttrs["class"] = "form-control";
		$this->ket->EditCustomAttributes = "";
		$this->ket->EditValue = $this->ket->CurrentValue;
		$this->ket->PlaceHolder = RemoveHtml($this->ket->caption());

		// rid
		$this->rid->EditAttrs["class"] = "form-control";
		$this->rid->EditCustomAttributes = "";
		if ($this->rid->getSessionValue() != "") {
			$this->rid->CurrentValue = $this->rid->getSessionValue();
			$this->rid->ViewValue = $this->rid->CurrentValue;
			$this->rid->ViewCustomAttributes = "";
		} else {
			$this->rid->EditValue = $this->rid->CurrentValue;
			$this->rid->PlaceHolder = RemoveHtml($this->rid->caption());
		}

		// jenispel
		$this->jenispel->EditAttrs["class"] = "form-control";
		$this->jenispel->EditCustomAttributes = "";
		$this->jenispel->EditValue = $this->jenispel->CurrentValue;
		$this->jenispel->PlaceHolder = RemoveHtml($this->jenispel->caption());

		// jenisevaluasi
		$this->jenisevaluasi->EditCustomAttributes = "";

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
					$doc->exportCaption($this->idpelat);
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->dana);
					$doc->exportCaption($this->ketua);
					$doc->exportCaption($this->sekretaris);
					$doc->exportCaption($this->bendahara);
					$doc->exportCaption($this->anggota2);
					$doc->exportCaption($this->widyaiswara);
					$doc->exportCaption($this->statuspel);
					$doc->exportCaption($this->ket);
					$doc->exportCaption($this->jenisevaluasi);
				} else {
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->dana);
					$doc->exportCaption($this->ketua);
					$doc->exportCaption($this->sekretaris);
					$doc->exportCaption($this->bendahara);
					$doc->exportCaption($this->anggota2);
					$doc->exportCaption($this->widyaiswara);
					$doc->exportCaption($this->statuspel);
					$doc->exportCaption($this->ket);
					$doc->exportCaption($this->jenisevaluasi);
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
						$doc->exportField($this->idpelat);
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->dana);
						$doc->exportField($this->ketua);
						$doc->exportField($this->sekretaris);
						$doc->exportField($this->bendahara);
						$doc->exportField($this->anggota2);
						$doc->exportField($this->widyaiswara);
						$doc->exportField($this->statuspel);
						$doc->exportField($this->ket);
						$doc->exportField($this->jenisevaluasi);
					} else {
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->dana);
						$doc->exportField($this->ketua);
						$doc->exportField($this->sekretaris);
						$doc->exportField($this->bendahara);
						$doc->exportField($this->anggota2);
						$doc->exportField($this->widyaiswara);
						$doc->exportField($this->statuspel);
						$doc->exportField($this->ket);
						$doc->exportField($this->jenisevaluasi);
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

		// No binary fields
		return FALSE;
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
		$rsnew["jenispel"] = 1; // default Subsidi Pusat

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

		$rsnew["jenispel"] = 1; // default Subsidi Pusat

		//$this->setWarningMessage($kdpelat);
		if($rsnew["statuspel"] < 1){
			$rsnew["statuspel"] = $rsold["statuspel"];
		}
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

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>