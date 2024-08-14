<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for evaluasi
 */
class evaluasi extends DbTable
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
	public $th;
	public $idpelat;
	public $kdpelat;
	public $kdjudul;
	public $tawal;
	public $takhir;
	public $ketua;
	public $sekretaris;
	public $bendahara;
	public $anggota2;
	public $widyaiswara;
	public $tglpel;
	public $panitia;
	public $jenisevaluasi;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'evaluasi';
		$this->TableName = 'evaluasi';
		$this->TableType = 'CUSTOMVIEW';

		// Update Table
		$this->UpdateTable = "t_pelatihan";
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

		// th
		$this->th = new DbField('evaluasi', 'evaluasi', 'x_th', 'th', 'Year(t_pelatihan.tawal)', 'Year(t_pelatihan.tawal)', 20, 4, -1, FALSE, 'Year(t_pelatihan.tawal)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->th->Sortable = TRUE; // Allow sort
		$this->th->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->th->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->th->Lookup = new Lookup('th', 't_tahun', FALSE, 'tahun', ["tahun","","",""], [], ["x_idpelat"], [], [], [], [], '`tahun` DESC', '');
		$this->th->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['th'] = &$this->th;

		// idpelat
		$this->idpelat = new DbField('evaluasi', 'evaluasi', 'x_idpelat', 'idpelat', 't_pelatihan.idpelat', 't_pelatihan.idpelat', 3, 11, -1, FALSE, 't_pelatihan.idpelat', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->idpelat->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idpelat->IsPrimaryKey = TRUE; // Primary key field
		$this->idpelat->Sortable = TRUE; // Allow sort
		$this->idpelat->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->idpelat->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->idpelat->Lookup = new Lookup('idpelat', 'vt_pelatihan', FALSE, 'idpelat', ["judul","tempat","tawal",""], ["x_th"], [], ["th"], ["x_th"], [], [], '`judul` ASC', '');
		$this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idpelat'] = &$this->idpelat;

		// kdpelat
		$this->kdpelat = new DbField('evaluasi', 'evaluasi', 'x_kdpelat', 'kdpelat', 't_pelatihan.kdpelat', 't_pelatihan.kdpelat', 200, 20, -1, FALSE, 't_pelatihan.kdpelat', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpelat->Nullable = FALSE; // NOT NULL field
		$this->kdpelat->Required = TRUE; // Required field
		$this->kdpelat->Sortable = TRUE; // Allow sort
		$this->fields['kdpelat'] = &$this->kdpelat;

		// kdjudul
		$this->kdjudul = new DbField('evaluasi', 'evaluasi', 'x_kdjudul', 'kdjudul', 't_pelatihan.kdjudul', 't_pelatihan.kdjudul', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = FALSE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// tawal
		$this->tawal = new DbField('evaluasi', 'evaluasi', 'x_tawal', 'tawal', 't_pelatihan.tawal', CastDateFieldForLike("t_pelatihan.tawal", 0, "DB"), 135, 19, 0, FALSE, 't_pelatihan.tawal', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tawal->Required = TRUE; // Required field
		$this->tawal->Sortable = TRUE; // Allow sort
		$this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tawal'] = &$this->tawal;

		// takhir
		$this->takhir = new DbField('evaluasi', 'evaluasi', 'x_takhir', 'takhir', 't_pelatihan.takhir', CastDateFieldForLike("t_pelatihan.takhir", 0, "DB"), 135, 19, 0, FALSE, 't_pelatihan.takhir', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->takhir->Required = TRUE; // Required field
		$this->takhir->Sortable = TRUE; // Allow sort
		$this->takhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['takhir'] = &$this->takhir;

		// ketua
		$this->ketua = new DbField('evaluasi', 'evaluasi', 'x_ketua', 'ketua', 't_pelatihan.ketua', 't_pelatihan.ketua', 200, 40, -1, FALSE, 't_pelatihan.ketua', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ketua->Required = TRUE; // Required field
		$this->ketua->Sortable = TRUE; // Allow sort
		$this->ketua->Lookup = new Lookup('ketua', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['ketua'] = &$this->ketua;

		// sekretaris
		$this->sekretaris = new DbField('evaluasi', 'evaluasi', 'x_sekretaris', 'sekretaris', 't_pelatihan.sekretaris', 't_pelatihan.sekretaris', 200, 40, -1, FALSE, 't_pelatihan.sekretaris', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sekretaris->Required = TRUE; // Required field
		$this->sekretaris->Sortable = TRUE; // Allow sort
		$this->sekretaris->Lookup = new Lookup('sekretaris', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['sekretaris'] = &$this->sekretaris;

		// bendahara
		$this->bendahara = new DbField('evaluasi', 'evaluasi', 'x_bendahara', 'bendahara', 't_pelatihan.bendahara', 't_pelatihan.bendahara', 200, 40, -1, FALSE, 't_pelatihan.bendahara', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bendahara->Required = TRUE; // Required field
		$this->bendahara->Sortable = TRUE; // Allow sort
		$this->bendahara->Lookup = new Lookup('bendahara', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['bendahara'] = &$this->bendahara;

		// anggota2
		$this->anggota2 = new DbField('evaluasi', 'evaluasi', 'x_anggota2', 'anggota2', 't_pelatihan.anggota2', 't_pelatihan.anggota2', 200, 40, -1, FALSE, 't_pelatihan.anggota2', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->anggota2->Required = TRUE; // Required field
		$this->anggota2->Sortable = TRUE; // Allow sort
		$this->anggota2->Lookup = new Lookup('anggota2', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['anggota2'] = &$this->anggota2;

		// widyaiswara
		$this->widyaiswara = new DbField('evaluasi', 'evaluasi', 'x_widyaiswara', 'widyaiswara', 't_pelatihan.widyaiswara', 't_pelatihan.widyaiswara', 3, 11, -1, FALSE, 't_pelatihan.widyaiswara', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->widyaiswara->Sortable = TRUE; // Allow sort
		$this->widyaiswara->Lookup = new Lookup('widyaiswara', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->widyaiswara->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['widyaiswara'] = &$this->widyaiswara;

		// tglpel
		$this->tglpel = new DbField('evaluasi', 'evaluasi', 'x_tglpel', 'tglpel', 'NULL', 'NULL', 12, 65530, -1, FALSE, 'NULL', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpel->IsCustom = TRUE; // Custom field
		$this->tglpel->Sortable = TRUE; // Allow sort
		$this->fields['tglpel'] = &$this->tglpel;

		// panitia
		$this->panitia = new DbField('evaluasi', 'evaluasi', 'x_panitia', 'panitia', 'NULL', 'NULL', 12, 65530, -1, FALSE, 'NULL', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->panitia->IsCustom = TRUE; // Custom field
		$this->panitia->Sortable = TRUE; // Allow sort
		$this->fields['panitia'] = &$this->panitia;

		// jenisevaluasi
		$this->jenisevaluasi = new DbField('evaluasi', 'evaluasi', 'x_jenisevaluasi', 'jenisevaluasi', 't_pelatihan.jenisevaluasi', 't_pelatihan.jenisevaluasi', 200, 25, -1, FALSE, 't_pelatihan.jenisevaluasi', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenisevaluasi->Nullable = FALSE; // NOT NULL field
		$this->jenisevaluasi->Required = TRUE; // Required field
		$this->jenisevaluasi->Sortable = TRUE; // Allow sort
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "t_pelatihan";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT t_pelatihan.idpelat,t_pelatihan.kdpelat, t_pelatihan.kdjudul, Year(t_pelatihan.tawal) th, t_pelatihan.tawal, t_pelatihan.takhir, t_pelatihan.ketua, t_pelatihan.bendahara, t_pelatihan.sekretaris, t_pelatihan.anggota2, t_pelatihan.jenisevaluasi, t_pelatihan.widyaiswara, NULL AS `tglpel`, NULL AS `panitia` FROM " . $this->getSqlFrom();
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
			"SELECT t_pelatihan.idpelat,t_pelatihan.kdpelat, t_pelatihan.kdjudul, Year(t_pelatihan.tawal) th, t_pelatihan.tawal, t_pelatihan.takhir, t_pelatihan.ketua, t_pelatihan.bendahara, t_pelatihan.sekretaris, t_pelatihan.anggota2, t_pelatihan.jenisevaluasi, t_pelatihan.widyaiswara, NULL AS `tglpel`, NULL AS `panitia`, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = t_pelatihan.kdjudul LIMIT 1) AS `EV__kdjudul` FROM t_pelatihan" .
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
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "t_pelatihan.statuspel = 4";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "t_pelatihan.tawal";
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
		$this->th->DbValue = $row['th'];
		$this->idpelat->DbValue = $row['idpelat'];
		$this->kdpelat->DbValue = $row['kdpelat'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->tawal->DbValue = $row['tawal'];
		$this->takhir->DbValue = $row['takhir'];
		$this->ketua->DbValue = $row['ketua'];
		$this->sekretaris->DbValue = $row['sekretaris'];
		$this->bendahara->DbValue = $row['bendahara'];
		$this->anggota2->DbValue = $row['anggota2'];
		$this->widyaiswara->DbValue = $row['widyaiswara'];
		$this->tglpel->DbValue = $row['tglpel'];
		$this->panitia->DbValue = $row['panitia'];
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
		return "t_pelatihan.idpelat = @idpelat@";
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
			return "evaluasilist.php";
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
		if ($pageName == "evaluasiview.php")
			return $Language->phrase("View");
		elseif ($pageName == "evaluasiedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "evaluasiadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "evaluasilist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("evaluasiview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("evaluasiview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "evaluasiadd.php?" . $this->getUrlParm($parm);
		else
			$url = "evaluasiadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("evaluasiedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("evaluasiadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("evaluasidelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
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
		$this->th->setDbValue($rs->fields('th'));
		$this->idpelat->setDbValue($rs->fields('idpelat'));
		$this->kdpelat->setDbValue($rs->fields('kdpelat'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->tawal->setDbValue($rs->fields('tawal'));
		$this->takhir->setDbValue($rs->fields('takhir'));
		$this->ketua->setDbValue($rs->fields('ketua'));
		$this->sekretaris->setDbValue($rs->fields('sekretaris'));
		$this->bendahara->setDbValue($rs->fields('bendahara'));
		$this->anggota2->setDbValue($rs->fields('anggota2'));
		$this->widyaiswara->setDbValue($rs->fields('widyaiswara'));
		$this->tglpel->setDbValue($rs->fields('tglpel'));
		$this->panitia->setDbValue($rs->fields('panitia'));
		$this->jenisevaluasi->setDbValue($rs->fields('jenisevaluasi'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// th
		// idpelat
		// kdpelat
		// kdjudul
		// tawal
		// takhir
		// ketua
		// sekretaris
		// bendahara
		// anggota2
		// widyaiswara
		// tglpel
		// panitia
		// jenisevaluasi
		// th

		$curVal = strval($this->th->CurrentValue);
		if ($curVal != "") {
			$this->th->ViewValue = $this->th->lookupCacheOption($curVal);
			if ($this->th->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`tahun` BETWEEN YEAR(CURDATE())-8 AND YEAR(CURDATE())+1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->th->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->th->ViewValue = $this->th->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->th->ViewValue = $this->th->CurrentValue;
				}
			}
		} else {
			$this->th->ViewValue = NULL;
		}
		$this->th->ViewCustomAttributes = "";

		// idpelat
		$curVal = strval($this->idpelat->CurrentValue);
		if ($curVal != "") {
			$this->idpelat->ViewValue = $this->idpelat->lookupCacheOption($curVal);
			if ($this->idpelat->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`idpelat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->idpelat->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->idpelat->ViewValue = $this->idpelat->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
				}
			}
		} else {
			$this->idpelat->ViewValue = NULL;
		}
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

		// tglpel
		$this->tglpel->ViewValue = $this->tglpel->CurrentValue;
		$this->tglpel->CellCssStyle .= "text-align: right;";
		$this->tglpel->ViewCustomAttributes = "";

		// panitia
		$this->panitia->ViewValue = $this->panitia->CurrentValue;
		$this->panitia->ViewCustomAttributes = "";

		// jenisevaluasi
		$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->CurrentValue;
		$this->jenisevaluasi->ViewCustomAttributes = "";

		// th
		$this->th->LinkCustomAttributes = "";
		$this->th->HrefValue = "";
		$this->th->TooltipValue = "";

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

		// tglpel
		$this->tglpel->LinkCustomAttributes = "";
		$this->tglpel->HrefValue = "";
		$this->tglpel->TooltipValue = "";

		// panitia
		$this->panitia->LinkCustomAttributes = "";
		$this->panitia->HrefValue = "";
		$this->panitia->TooltipValue = "";

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

		// th
		$this->th->EditAttrs["class"] = "form-control";
		$this->th->EditCustomAttributes = "";

		// idpelat
		$this->idpelat->EditAttrs["class"] = "form-control";
		$this->idpelat->EditCustomAttributes = "";
		$curVal = strval($this->idpelat->CurrentValue);
		if ($curVal != "") {
			$this->idpelat->EditValue = $this->idpelat->lookupCacheOption($curVal);
			if ($this->idpelat->EditValue === NULL) { // Lookup from database
				$filterWrk = "`idpelat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->idpelat->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->idpelat->EditValue = $this->idpelat->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idpelat->EditValue = $this->idpelat->CurrentValue;
				}
			}
		} else {
			$this->idpelat->EditValue = NULL;
		}
		$this->idpelat->ViewCustomAttributes = "";

		// kdpelat
		$this->kdpelat->EditAttrs["class"] = "form-control";
		$this->kdpelat->EditCustomAttributes = "";
		if (!$this->kdpelat->Raw)
			$this->kdpelat->CurrentValue = HtmlDecode($this->kdpelat->CurrentValue);
		$this->kdpelat->EditValue = $this->kdpelat->CurrentValue;
		$this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

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
		$this->tawal->EditValue = $this->tawal->CurrentValue;
		$this->tawal->EditValue = FormatDateTime($this->tawal->EditValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->EditAttrs["class"] = "form-control";
		$this->takhir->EditCustomAttributes = "";
		$this->takhir->EditValue = $this->takhir->CurrentValue;
		$this->takhir->EditValue = FormatDateTime($this->takhir->EditValue, 0);
		$this->takhir->ViewCustomAttributes = "";

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

		// tglpel
		$this->tglpel->EditAttrs["class"] = "form-control";
		$this->tglpel->EditCustomAttributes = "";
		$this->tglpel->EditValue = $this->tglpel->CurrentValue;
		$this->tglpel->PlaceHolder = RemoveHtml($this->tglpel->caption());

		// panitia
		$this->panitia->EditAttrs["class"] = "form-control";
		$this->panitia->EditCustomAttributes = "";
		$this->panitia->EditValue = $this->panitia->CurrentValue;
		$this->panitia->PlaceHolder = RemoveHtml($this->panitia->caption());

		// jenisevaluasi
		$this->jenisevaluasi->EditAttrs["class"] = "form-control";
		$this->jenisevaluasi->EditCustomAttributes = "";
		if (!$this->jenisevaluasi->Raw)
			$this->jenisevaluasi->CurrentValue = HtmlDecode($this->jenisevaluasi->CurrentValue);
		$this->jenisevaluasi->EditValue = $this->jenisevaluasi->CurrentValue;
		$this->jenisevaluasi->PlaceHolder = RemoveHtml($this->jenisevaluasi->caption());

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
					$doc->exportCaption($this->th);
					$doc->exportCaption($this->idpelat);
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->ketua);
					$doc->exportCaption($this->sekretaris);
					$doc->exportCaption($this->bendahara);
					$doc->exportCaption($this->anggota2);
					$doc->exportCaption($this->widyaiswara);
					$doc->exportCaption($this->tglpel);
					$doc->exportCaption($this->panitia);
					$doc->exportCaption($this->jenisevaluasi);
				} else {
					$doc->exportCaption($this->th);
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->ketua);
					$doc->exportCaption($this->sekretaris);
					$doc->exportCaption($this->bendahara);
					$doc->exportCaption($this->anggota2);
					$doc->exportCaption($this->widyaiswara);
					$doc->exportCaption($this->tglpel);
					$doc->exportCaption($this->panitia);
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
						$doc->exportField($this->th);
						$doc->exportField($this->idpelat);
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->ketua);
						$doc->exportField($this->sekretaris);
						$doc->exportField($this->bendahara);
						$doc->exportField($this->anggota2);
						$doc->exportField($this->widyaiswara);
						$doc->exportField($this->tglpel);
						$doc->exportField($this->panitia);
						$doc->exportField($this->jenisevaluasi);
					} else {
						$doc->exportField($this->th);
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->ketua);
						$doc->exportField($this->sekretaris);
						$doc->exportField($this->bendahara);
						$doc->exportField($this->anggota2);
						$doc->exportField($this->widyaiswara);
						$doc->exportField($this->tglpel);
						$doc->exportField($this->panitia);
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
		//AddFilter($filter, "ketua = '".CurrentUserID()."' OR sekretaris = '".CurrentUserID()."' OR bendahara = '".CurrentUserID()."' OR anggota2 = '".CurrentUserID()."'");
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

		if ($fld->Name == "idpelat"){
		$fld->Lookup->UserOrderBy = "judul ASC, date_format(tawal,'%Y-%m-%d') ASC, tempat ASC";
		}
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

		if($this->jenisevaluasi->CurrentValue <> 0 || !empty($this->jenisevaluasi->CurrentValue)){
		$armultiwrk = (strval($this->jenisevaluasi->CurrentValue) <> "") ? explode(",", strval($this->jenisevaluasi->CurrentValue)) : array();
		sort($armultiwrk); // sort array jenis evaluasi
		$cnt = count($armultiwrk);
		$munculah = "";
		for ($ari = 0; $ari < $cnt; $ari++) {
			$sql = "SELECT jenis_evaluasi FROM t_evaluasi WHERE id = ".$armultiwrk[$ari]."";
			$row = ExecuteScalar($sql);

			//link tabel
			$vje = $armultiwrk[$ari];
			if($vje == 1) { $tb = "t_evafas"; } else if ($vje == 2) { $tb = "t_evakhir"; } else if ($vje == 3) { $tb = "t_evasis"; } else if ($vje == 4) { $tb = "t_evakunjlap"; } else if ($vje == 5) { $tb = "t_evapant"; } else if ($vje == 6) { $tb = "t_preposttest"; } else { $tb = "javascript:void(0);"; }
			if($vje == 1) {
				$munculah .= "" . $row . "<br><a class='btn btn-success ew-export-link ew-excel btn-block' href='xprintlist.php?export=excel&pelat=".$this->idpelat->CurrentValue."&pg=evafas&tahun=".date("Y")."' title='' data-caption='Hasil Excel' data-original-title='Hasil Excel'><i data-phrase='ExportToExcel' class='icon-excel ew-icon' data-caption='Ekspor ke Excel'></i> Hasil Evaluasi</a><hr>";
			} else if($vje == 2) {
				$munculah .= "" . $row . "<br><a class='btn btn-success ew-export-link ew-excel btn-block' href='xprintlist.php?export=excel&pelat=".$this->idpelat->CurrentValue."&pg=evakhir&tahun=".date("Y")."' title='' data-caption='Hasil Excel' data-original-title='Hasil Excel'><i data-phrase='ExportToExcel' class='icon-excel ew-icon' data-caption='Ekspor ke Excel'></i> Hasil Evaluasi</a><hr>";
			} else if($vje == 3) {
				$munculah .= "" . $row . "<br><a class='btn btn-success ew-export-link ew-excel btn-block' href='xprintlist.php?export=excel&pelat=".$this->idpelat->CurrentValue."&pg=evasis&tahun=".date("Y")."' title='' data-caption='Hasil Excel' data-original-title='Hasil Excel'><i data-phrase='ExportToExcel' class='icon-excel ew-icon' data-caption='Ekspor ke Excel'></i> Hasil Evaluasi</a><hr>";
			}  else if($vje == 4) {
				$munculah .= "" . $row . "<br><a class='btn btn-success ew-export-link ew-excel btn-block' href='xprintlist.php?export=excel&pelat=".$this->idpelat->CurrentValue."&pg=evakunjlap&tahun=".date("Y")."' title='' data-caption='Hasil Excel' data-original-title='Hasil Excel'><i data-phrase='ExportToExcel' class='icon-excel ew-icon' data-caption='Ekspor ke Excel'></i> Hasil Evaluasi</a><hr>";
			}  else if($vje == 5) {
				$munculah .= "" . $row . "<br><a class='btn btn-success ew-export-link ew-excel btn-block' href='xprintlist.php?export=excel&pelat=".$this->idpelat->CurrentValue."&pg=evapant&tahun=".date("Y")."' title='' data-caption='Hasil Excel' data-original-title='Hasil Excel'><i data-phrase='ExportToExcel' class='icon-excel ew-icon' data-caption='Ekspor ke Excel'></i> Hasil Evaluasi</a><hr>";
			}  else if($vje == 6) {
				$munculah .= "" . $row . "<br><a class='btn btn-success ew-export-link ew-excel btn-block' href='xprintlist.php?export=excel&pelat=".$this->idpelat->CurrentValue."&pg=prepost&tahun=".date("Y")."' title='' data-caption='Hasil Excel' data-original-title='Hasil Excel'><i data-phrase='ExportToExcel' class='icon-excel ew-icon' data-caption='Ekspor ke Excel'></i> Hasil Evaluasi</a><hr>";
			} else {
				//$munculah .= "<a href='".$tb."list.php?cmd=search&t=".$tb."&z_idpelat=%3D&x_idpelat=".$this->idpelat->CurrentValue."&p_x_idpelat=o%3DhW5VoLelhyXAbwvXZo-uxg..&z_bioid=%3D&x_bioid=&p_x_bioid=o%3DPohBvg9oM3vSM6fQ7V0uIQ..&z_kurikulumid=%3D&x_kurikulumid=&export=excel' class='btn btn-success' id='evx'><i class='fa fa-table ew-icon'></i></a>";
				//$munculah .= "<hr>";
			}
			
		}
		$this->jenisevaluasi->ViewValue = $munculah;
		}
		else {
		$this->jenisevaluasi->ViewValue = "not set - please contact admin!";	
		}
		$ketua = ExecuteScalar("SELECT nama FROM t_pegawai WHERE id_peg = ".$this->ketua->CurrentValue);
		$sekretaris = ExecuteScalar("SELECT nama FROM t_pegawai WHERE id_peg = ".$this->sekretaris->CurrentValue);
		$bendahara = ExecuteScalar("SELECT nama FROM t_pegawai WHERE id_peg = ".$this->bendahara->CurrentValue);
		$anggota2 = ExecuteScalar("SELECT nama FROM t_pegawai WHERE id_peg = ".$this->anggota2->CurrentValue);
		$this->ketua->ViewValue = $ketua;
		$this->sekretaris->ViewValue = $sekretaris;
		$this->bendahara->ViewValue = $bendahara;
		$this->anggota2->ViewValue = $anggota2;
		if (CurrentPage()->PageID == "list" ){
		if(strtotime($this->tawal->CurrentValue) == strtotime($this->takhir->CurrentValue)){
			$tgl = $this->tawal->ViewValue;
		} else {
			$bln_tawal = date("n",strtotime($this->tawal->CurrentValue));
			$bln_takhir = date("n",strtotime($this->takhir->CurrentValue));
			if($bln_tawal == $bln_takhir){
				$tgl = date("j",strtotime($this->tawal->CurrentValue)) . "-" . CSFormatTanggal(date("j-m-Y",strtotime($this->takhir->CurrentValue)), false, false, false);
			} else { // bulan berbeda
				$tgl = CSFormatTanggal(date("j-m-Y",strtotime($this->tawal->CurrentValue)), false, false, true, true) . " - " . CSFormatTanggal(date("j-m-Y",strtotime($this->takhir->CurrentValue)), false, false, true, true);
			}
		}
		$this->tglpel->ViewValue = $tgl;

		//$this->tglpel->ViewValue = $this->tawal->ViewValue . " - " . $this->takhir->ViewValue;
			$this->panitia->ViewValue = "<table><tr><td>Ketua</td><td>" . $this->ketua->ViewValue . "</td></tr><tr><td>Sekretaris</td><td>" . $this->sekretaris->ViewValue . "</td></tr><tr><td>Anggota</td><td>1. ".$this->bendahara->ViewValue."<br>2. ".$this->anggota2->ViewValue."</td></tr></table>";
		}
		$kotapel = ExecuteScalar("SELECT kota FROM vt_pelatihan WHERE idpelat = ".$this->idpelat->CurrentValue);
		$this->idpelat->ViewValue = $this->kdjudul->ViewValue . "<br>" . $kotapel;
		
		
		$this->kdpelat->ViewValue = $this->kdpelat->ViewValue . '<br><a href="http://ppei.kemendag.go.id/evaluasi/?c='.$this->kdpelat->CurrentValue.'" target="_blank" class="btn btn-info btn-block">Link Evaluasi</a>';
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>