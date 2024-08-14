<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_rpdiklat
 */
class t_rpdiklat extends DbTable
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
	public $rpdid;
	public $kdjudul;
	public $kdbidang;
	public $kdkursil;
	public $iso;
	public $tempat;
	public $jml_hari;
	public $jenisdurasi;
	public $targetpes;
	public $angkatan;
	public $sisa_angkatan;
	public $harga_satuan;
	public $hargatotal;
	public $tglrevisi;
	public $tahun_rencana;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_rpdiklat';
		$this->TableName = 't_rpdiklat';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_rpdiklat`";
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

		// rpdid
		$this->rpdid = new DbField('t_rpdiklat', 't_rpdiklat', 'x_rpdid', 'rpdid', '`rpdid`', '`rpdid`', 3, 11, -1, FALSE, '`rpdid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->rpdid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->rpdid->IsPrimaryKey = TRUE; // Primary key field
		$this->rpdid->IsForeignKey = TRUE; // Foreign key field
		$this->rpdid->Sortable = TRUE; // Allow sort
		$this->rpdid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rpdid'] = &$this->rpdid;

		// kdjudul
		$this->kdjudul = new DbField('t_rpdiklat', 't_rpdiklat', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->IsForeignKey = TRUE; // Foreign key field
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], ["x_kdkursil"], [], [], ["kdbidang"], ["x_kdbidang"], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// kdbidang
		$this->kdbidang = new DbField('t_rpdiklat', 't_rpdiklat', 'x_kdbidang', 'kdbidang', '`kdbidang`', '`kdbidang`', 200, 10, -1, FALSE, '`kdbidang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdbidang->Required = TRUE; // Required field
		$this->kdbidang->Sortable = TRUE; // Allow sort
		$this->kdbidang->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdbidang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdbidang->Lookup = new Lookup('kdbidang', 't_bidang', FALSE, 'kdbidang', ["bidang","","",""], [], [], [], [], [], [], '', '');
		$this->fields['kdbidang'] = &$this->kdbidang;

		// kdkursil
		$this->kdkursil = new DbField('t_rpdiklat', 't_rpdiklat', 'x_kdkursil', 'kdkursil', '`kdkursil`', '`kdkursil`', 200, 20, -1, FALSE, '`kdkursil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkursil->Sortable = TRUE; // Allow sort
		$this->kdkursil->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkursil->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkursil->Lookup = new Lookup('kdkursil', 't_juduldetail', FALSE, 'kdkursil', ["kdkursil","revisi","tgl_terbit",""], ["x_kdjudul"], [], ["kdjudul"], ["x_kdjudul"], [], [], '`tgl_terbit` DESC', '');
		$this->fields['kdkursil'] = &$this->kdkursil;

		// iso
		$this->iso = new DbField('t_rpdiklat', 't_rpdiklat', 'x_iso', 'iso', '`iso`', '`iso`', 200, 1, -1, FALSE, '`iso`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->iso->Required = TRUE; // Required field
		$this->iso->Sortable = TRUE; // Allow sort
		$this->iso->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->iso->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->iso->Lookup = new Lookup('iso', 't_rpdiklat', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->iso->OptionCount = 2;
		$this->fields['iso'] = &$this->iso;

		// tempat
		$this->tempat = new DbField('t_rpdiklat', 't_rpdiklat', 'x_tempat', 'tempat', '`tempat`', '`tempat`', 200, 255, -1, FALSE, '`tempat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tempat->Required = TRUE; // Required field
		$this->tempat->Sortable = TRUE; // Allow sort
		$this->fields['tempat'] = &$this->tempat;

		// jml_hari
		$this->jml_hari = new DbField('t_rpdiklat', 't_rpdiklat', 'x_jml_hari', 'jml_hari', '`jml_hari`', '`jml_hari`', 3, 3, -1, FALSE, '`jml_hari`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_hari->Required = TRUE; // Required field
		$this->jml_hari->Sortable = TRUE; // Allow sort
		$this->jml_hari->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jml_hari'] = &$this->jml_hari;

		// jenisdurasi
		$this->jenisdurasi = new DbField('t_rpdiklat', 't_rpdiklat', 'x_jenisdurasi', 'jenisdurasi', '`jenisdurasi`', '`jenisdurasi`', 200, 5, -1, FALSE, '`jenisdurasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenisdurasi->Required = TRUE; // Required field
		$this->jenisdurasi->Sortable = TRUE; // Allow sort
		$this->jenisdurasi->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenisdurasi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenisdurasi->Lookup = new Lookup('jenisdurasi', 't_rpdiklat', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenisdurasi->OptionCount = 2;
		$this->fields['jenisdurasi'] = &$this->jenisdurasi;

		// targetpes
		$this->targetpes = new DbField('t_rpdiklat', 't_rpdiklat', 'x_targetpes', 'targetpes', '`targetpes`', '`targetpes`', 3, 3, -1, FALSE, '`targetpes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes->Required = TRUE; // Required field
		$this->targetpes->Sortable = TRUE; // Allow sort
		$this->targetpes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes'] = &$this->targetpes;

		// angkatan
		$this->angkatan = new DbField('t_rpdiklat', 't_rpdiklat', 'x_angkatan', 'angkatan', '`angkatan`', '`angkatan`', 3, 3, -1, FALSE, '`angkatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->angkatan->Required = TRUE; // Required field
		$this->angkatan->Sortable = TRUE; // Allow sort
		$this->angkatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['angkatan'] = &$this->angkatan;

		// sisa_angkatan
		$this->sisa_angkatan = new DbField('t_rpdiklat', 't_rpdiklat', 'x_sisa_angkatan', 'sisa_angkatan', '(t_rpdiklat.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.kdjudul = t_rpdiklat.kdjudul AND t_pelatihan.rid = t_rpdiklat.rpdid))', '(t_rpdiklat.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.kdjudul = t_rpdiklat.kdjudul AND t_pelatihan.rid = t_rpdiklat.rpdid))', 20, 22, -1, FALSE, '(t_rpdiklat.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.kdjudul = t_rpdiklat.kdjudul AND t_pelatihan.rid = t_rpdiklat.rpdid))', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sisa_angkatan->IsCustom = TRUE; // Custom field
		$this->sisa_angkatan->Sortable = TRUE; // Allow sort
		$this->sisa_angkatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sisa_angkatan'] = &$this->sisa_angkatan;

		// harga_satuan
		$this->harga_satuan = new DbField('t_rpdiklat', 't_rpdiklat', 'x_harga_satuan', 'harga_satuan', '`harga_satuan`', '`harga_satuan`', 131, 15, -1, FALSE, '`harga_satuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->harga_satuan->Nullable = FALSE; // NOT NULL field
		$this->harga_satuan->Required = TRUE; // Required field
		$this->harga_satuan->Sortable = TRUE; // Allow sort
		$this->harga_satuan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['harga_satuan'] = &$this->harga_satuan;

		// hargatotal
		$this->hargatotal = new DbField('t_rpdiklat', 't_rpdiklat', 'x_hargatotal', 'hargatotal', 'NULL', 'NULL', 12, 0, -1, FALSE, 'NULL', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hargatotal->IsCustom = TRUE; // Custom field
		$this->hargatotal->Sortable = TRUE; // Allow sort
		$this->fields['hargatotal'] = &$this->hargatotal;

		// tglrevisi
		$this->tglrevisi = new DbField('t_rpdiklat', 't_rpdiklat', 'x_tglrevisi', 'tglrevisi', '`tglrevisi`', CastDateFieldForLike("`tglrevisi`", 0, "DB"), 133, 10, 0, FALSE, '`tglrevisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglrevisi->Required = TRUE; // Required field
		$this->tglrevisi->Sortable = TRUE; // Allow sort
		$this->tglrevisi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tglrevisi'] = &$this->tglrevisi;

		// tahun_rencana
		$this->tahun_rencana = new DbField('t_rpdiklat', 't_rpdiklat', 'x_tahun_rencana', 'tahun_rencana', '`tahun_rencana`', '`tahun_rencana`', 3, 4, -1, FALSE, '`tahun_rencana`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tahun_rencana->Required = TRUE; // Required field
		$this->tahun_rencana->Sortable = TRUE; // Allow sort
		$this->tahun_rencana->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tahun_rencana'] = &$this->tahun_rencana;
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
		if ($this->getCurrentDetailTable() == "diklatpusat") {
			$detailUrl = $GLOBALS["diklatpusat"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_rpdid=" . urlencode($this->rpdid->CurrentValue);
			$detailUrl .= "&fk_kdjudul=" . urlencode($this->kdjudul->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_rpdiklatlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_rpdiklat`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, (t_rpdiklat.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.kdjudul = t_rpdiklat.kdjudul AND t_pelatihan.rid = t_rpdiklat.rpdid)) AS `sisa_angkatan`, NULL AS `hargatotal` FROM " . $this->getSqlFrom();
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
			"SELECT *, (t_rpdiklat.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.kdjudul = t_rpdiklat.kdjudul AND t_pelatihan.rid = t_rpdiklat.rpdid)) AS `sisa_angkatan`, NULL AS `hargatotal`, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `t_rpdiklat`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `t_rpdiklat`" .
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
			$this->rpdid->setDbValue($conn->insert_ID());
			$rs['rpdid'] = $this->rpdid->DbValue;
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

		// Cascade Update detail table 'diklatpusat'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['rpdid']) && $rsold['rpdid'] != $rs['rpdid'])) { // Update detail field 'rid'
			$cascadeUpdate = TRUE;
			$rscascade['rid'] = $rs['rpdid'];
		}
		if ($rsold && (isset($rs['kdjudul']) && $rsold['kdjudul'] != $rs['kdjudul'])) { // Update detail field 'kdjudul'
			$cascadeUpdate = TRUE;
			$rscascade['kdjudul'] = $rs['kdjudul'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["diklatpusat"]))
				$GLOBALS["diklatpusat"] = new diklatpusat();
			$rswrk = $GLOBALS["diklatpusat"]->loadRs("`rid` = " . QuotedValue($rsold['rpdid'], DATATYPE_NUMBER, 'DB') . " AND " . "`kdjudul` = " . QuotedValue($rsold['kdjudul'], DATATYPE_STRING, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'idpelat';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["diklatpusat"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["diklatpusat"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["diklatpusat"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'rpdid';
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
			if (array_key_exists('rpdid', $rs))
				AddFilter($where, QuotedName('rpdid', $this->Dbid) . '=' . QuotedValue($rs['rpdid'], $this->rpdid->DataType, $this->Dbid));
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

		// Cascade delete detail table 'diklatpusat'
		if (!isset($GLOBALS["diklatpusat"]))
			$GLOBALS["diklatpusat"] = new diklatpusat();
		$rscascade = $GLOBALS["diklatpusat"]->loadRs("`rid` = " . QuotedValue($rs['rpdid'], DATATYPE_NUMBER, "DB") . " AND " . "`kdjudul` = " . QuotedValue($rs['kdjudul'], DATATYPE_STRING, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["diklatpusat"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["diklatpusat"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["diklatpusat"]->Row_Deleted($dtlrow);
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
		$this->rpdid->DbValue = $row['rpdid'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->kdbidang->DbValue = $row['kdbidang'];
		$this->kdkursil->DbValue = $row['kdkursil'];
		$this->iso->DbValue = $row['iso'];
		$this->tempat->DbValue = $row['tempat'];
		$this->jml_hari->DbValue = $row['jml_hari'];
		$this->jenisdurasi->DbValue = $row['jenisdurasi'];
		$this->targetpes->DbValue = $row['targetpes'];
		$this->angkatan->DbValue = $row['angkatan'];
		$this->sisa_angkatan->DbValue = $row['sisa_angkatan'];
		$this->harga_satuan->DbValue = $row['harga_satuan'];
		$this->hargatotal->DbValue = $row['hargatotal'];
		$this->tglrevisi->DbValue = $row['tglrevisi'];
		$this->tahun_rencana->DbValue = $row['tahun_rencana'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`rpdid` = @rpdid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('rpdid', $row) ? $row['rpdid'] : NULL;
		else
			$val = $this->rpdid->OldValue !== NULL ? $this->rpdid->OldValue : $this->rpdid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@rpdid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_rpdiklatlist.php";
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
		if ($pageName == "t_rpdiklatview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_rpdiklatedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_rpdiklatadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_rpdiklatlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_rpdiklatview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rpdiklatview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_rpdiklatadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_rpdiklatadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_rpdiklatedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rpdiklatedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("t_rpdiklatadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rpdiklatadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_rpdiklatdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "rpdid:" . JsonEncode($this->rpdid->CurrentValue, "number");
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
		if ($this->rpdid->CurrentValue != NULL) {
			$url .= "rpdid=" . urlencode($this->rpdid->CurrentValue);
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
			if (Param("rpdid") !== NULL)
				$arKeys[] = Param("rpdid");
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
				$this->rpdid->CurrentValue = $key;
			else
				$this->rpdid->OldValue = $key;
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
		$this->rpdid->setDbValue($rs->fields('rpdid'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->kdbidang->setDbValue($rs->fields('kdbidang'));
		$this->kdkursil->setDbValue($rs->fields('kdkursil'));
		$this->iso->setDbValue($rs->fields('iso'));
		$this->tempat->setDbValue($rs->fields('tempat'));
		$this->jml_hari->setDbValue($rs->fields('jml_hari'));
		$this->jenisdurasi->setDbValue($rs->fields('jenisdurasi'));
		$this->targetpes->setDbValue($rs->fields('targetpes'));
		$this->angkatan->setDbValue($rs->fields('angkatan'));
		$this->sisa_angkatan->setDbValue($rs->fields('sisa_angkatan'));
		$this->harga_satuan->setDbValue($rs->fields('harga_satuan'));
		$this->hargatotal->setDbValue($rs->fields('hargatotal'));
		$this->tglrevisi->setDbValue($rs->fields('tglrevisi'));
		$this->tahun_rencana->setDbValue($rs->fields('tahun_rencana'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// rpdid
		// kdjudul
		// kdbidang
		// kdkursil
		// iso
		// tempat
		// jml_hari
		// jenisdurasi
		// targetpes
		// angkatan
		// sisa_angkatan
		// harga_satuan
		// hargatotal
		// tglrevisi
		// tahun_rencana
		// rpdid

		$this->rpdid->ViewValue = $this->rpdid->CurrentValue;
		$this->rpdid->ViewCustomAttributes = "";

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

		// kdbidang
		$curVal = strval($this->kdbidang->CurrentValue);
		if ($curVal != "") {
			$this->kdbidang->ViewValue = $this->kdbidang->lookupCacheOption($curVal);
			if ($this->kdbidang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdbidang`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->kdbidang->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdbidang->ViewValue = $this->kdbidang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdbidang->ViewValue = $this->kdbidang->CurrentValue;
				}
			}
		} else {
			$this->kdbidang->ViewValue = NULL;
		}
		$this->kdbidang->ViewCustomAttributes = "";

		// kdkursil
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

		// iso
		if (strval($this->iso->CurrentValue) != "") {
			$this->iso->ViewValue = $this->iso->optionCaption($this->iso->CurrentValue);
		} else {
			$this->iso->ViewValue = NULL;
		}
		$this->iso->ViewCustomAttributes = "";

		// tempat
		$this->tempat->ViewValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

		// jml_hari
		$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
		$this->jml_hari->ViewCustomAttributes = "";

		// jenisdurasi
		if (strval($this->jenisdurasi->CurrentValue) != "") {
			$this->jenisdurasi->ViewValue = $this->jenisdurasi->optionCaption($this->jenisdurasi->CurrentValue);
		} else {
			$this->jenisdurasi->ViewValue = NULL;
		}
		$this->jenisdurasi->ViewCustomAttributes = "";

		// targetpes
		$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
		$this->targetpes->ViewCustomAttributes = "";

		// angkatan
		$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
		$this->angkatan->ViewCustomAttributes = "";

		// sisa_angkatan
		$this->sisa_angkatan->ViewValue = $this->sisa_angkatan->CurrentValue;
		$this->sisa_angkatan->ViewValue = FormatNumber($this->sisa_angkatan->ViewValue, 0, -2, -2, -2);
		$this->sisa_angkatan->ViewCustomAttributes = "";

		// harga_satuan
		$this->harga_satuan->ViewValue = $this->harga_satuan->CurrentValue;
		$this->harga_satuan->ViewValue = FormatCurrency($this->harga_satuan->ViewValue, 0, -2, -2, -2);
		$this->harga_satuan->ViewCustomAttributes = "";

		// hargatotal
		$this->hargatotal->ViewValue = $this->hargatotal->CurrentValue;
		$this->hargatotal->ViewCustomAttributes = "";

		// tglrevisi
		$this->tglrevisi->ViewValue = $this->tglrevisi->CurrentValue;
		$this->tglrevisi->ViewValue = FormatDateTime($this->tglrevisi->ViewValue, 0);
		$this->tglrevisi->ViewCustomAttributes = "";

		// tahun_rencana
		$this->tahun_rencana->ViewValue = $this->tahun_rencana->CurrentValue;
		$this->tahun_rencana->ViewCustomAttributes = "";

		// rpdid
		$this->rpdid->LinkCustomAttributes = "";
		$this->rpdid->HrefValue = "";
		$this->rpdid->TooltipValue = "";

		// kdjudul
		$this->kdjudul->LinkCustomAttributes = "";
		$this->kdjudul->HrefValue = "";
		$this->kdjudul->TooltipValue = "";

		// kdbidang
		$this->kdbidang->LinkCustomAttributes = "";
		$this->kdbidang->HrefValue = "";
		$this->kdbidang->TooltipValue = "";

		// kdkursil
		$this->kdkursil->LinkCustomAttributes = "";
		$this->kdkursil->HrefValue = "";
		$this->kdkursil->TooltipValue = "";

		// iso
		$this->iso->LinkCustomAttributes = "";
		$this->iso->HrefValue = "";
		$this->iso->TooltipValue = "";

		// tempat
		$this->tempat->LinkCustomAttributes = "";
		$this->tempat->HrefValue = "";
		$this->tempat->TooltipValue = "";

		// jml_hari
		$this->jml_hari->LinkCustomAttributes = "";
		$this->jml_hari->HrefValue = "";
		$this->jml_hari->TooltipValue = "";

		// jenisdurasi
		$this->jenisdurasi->LinkCustomAttributes = "";
		$this->jenisdurasi->HrefValue = "";
		$this->jenisdurasi->TooltipValue = "";

		// targetpes
		$this->targetpes->LinkCustomAttributes = "";
		$this->targetpes->HrefValue = "";
		$this->targetpes->TooltipValue = "";

		// angkatan
		$this->angkatan->LinkCustomAttributes = "";
		$this->angkatan->HrefValue = "";
		$this->angkatan->TooltipValue = "";

		// sisa_angkatan
		$this->sisa_angkatan->LinkCustomAttributes = "";
		$this->sisa_angkatan->HrefValue = "";
		$this->sisa_angkatan->TooltipValue = "";

		// harga_satuan
		$this->harga_satuan->LinkCustomAttributes = "";
		$this->harga_satuan->HrefValue = "";
		$this->harga_satuan->TooltipValue = "";

		// hargatotal
		$this->hargatotal->LinkCustomAttributes = "";
		$this->hargatotal->HrefValue = "";
		$this->hargatotal->TooltipValue = "";

		// tglrevisi
		$this->tglrevisi->LinkCustomAttributes = "";
		$this->tglrevisi->HrefValue = "";
		$this->tglrevisi->TooltipValue = "";

		// tahun_rencana
		$this->tahun_rencana->LinkCustomAttributes = "";
		$this->tahun_rencana->HrefValue = "";
		$this->tahun_rencana->TooltipValue = "";

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

		// rpdid
		$this->rpdid->EditAttrs["class"] = "form-control";
		$this->rpdid->EditCustomAttributes = "";
		$this->rpdid->EditValue = $this->rpdid->CurrentValue;
		$this->rpdid->ViewCustomAttributes = "";

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

		// kdbidang
		$this->kdbidang->EditAttrs["class"] = "form-control";
		$this->kdbidang->EditCustomAttributes = "";
		$curVal = strval($this->kdbidang->CurrentValue);
		if ($curVal != "") {
			$this->kdbidang->EditValue = $this->kdbidang->lookupCacheOption($curVal);
			if ($this->kdbidang->EditValue === NULL) { // Lookup from database
				$filterWrk = "`kdbidang`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->kdbidang->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdbidang->EditValue = $this->kdbidang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdbidang->EditValue = $this->kdbidang->CurrentValue;
				}
			}
		} else {
			$this->kdbidang->EditValue = NULL;
		}
		$this->kdbidang->ViewCustomAttributes = "";

		// kdkursil
		$this->kdkursil->EditAttrs["class"] = "form-control";
		$this->kdkursil->EditCustomAttributes = "";

		// iso
		$this->iso->EditAttrs["class"] = "form-control";
		$this->iso->EditCustomAttributes = "";
		$this->iso->EditValue = $this->iso->options(TRUE);

		// tempat
		$this->tempat->EditAttrs["class"] = "form-control";
		$this->tempat->EditCustomAttributes = "";
		$this->tempat->EditValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

		// jml_hari
		$this->jml_hari->EditAttrs["class"] = "form-control";
		$this->jml_hari->EditCustomAttributes = "";
		$this->jml_hari->EditValue = $this->jml_hari->CurrentValue;
		$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());

		// jenisdurasi
		$this->jenisdurasi->EditAttrs["class"] = "form-control";
		$this->jenisdurasi->EditCustomAttributes = "";
		$this->jenisdurasi->EditValue = $this->jenisdurasi->options(TRUE);

		// targetpes
		$this->targetpes->EditAttrs["class"] = "form-control";
		$this->targetpes->EditCustomAttributes = "";
		$this->targetpes->EditValue = $this->targetpes->CurrentValue;
		$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

		// angkatan
		$this->angkatan->EditAttrs["class"] = "form-control";
		$this->angkatan->EditCustomAttributes = "";
		$this->angkatan->EditValue = $this->angkatan->CurrentValue;
		$this->angkatan->PlaceHolder = RemoveHtml($this->angkatan->caption());

		// sisa_angkatan
		$this->sisa_angkatan->EditAttrs["class"] = "form-control";
		$this->sisa_angkatan->EditCustomAttributes = "";
		$this->sisa_angkatan->EditValue = $this->sisa_angkatan->CurrentValue;
		$this->sisa_angkatan->PlaceHolder = RemoveHtml($this->sisa_angkatan->caption());

		// harga_satuan
		$this->harga_satuan->EditAttrs["class"] = "form-control";
		$this->harga_satuan->EditCustomAttributes = "";
		$this->harga_satuan->EditValue = $this->harga_satuan->CurrentValue;
		$this->harga_satuan->PlaceHolder = RemoveHtml($this->harga_satuan->caption());
		if (strval($this->harga_satuan->EditValue) != "" && is_numeric($this->harga_satuan->EditValue))
			$this->harga_satuan->EditValue = FormatNumber($this->harga_satuan->EditValue, -2, -2, -2, -2);
		

		// hargatotal
		$this->hargatotal->EditAttrs["class"] = "form-control";
		$this->hargatotal->EditCustomAttributes = "";
		$this->hargatotal->EditValue = $this->hargatotal->CurrentValue;
		$this->hargatotal->PlaceHolder = RemoveHtml($this->hargatotal->caption());

		// tglrevisi
		$this->tglrevisi->EditAttrs["class"] = "form-control";
		$this->tglrevisi->EditCustomAttributes = "";
		$this->tglrevisi->EditValue = FormatDateTime($this->tglrevisi->CurrentValue, 8);
		$this->tglrevisi->PlaceHolder = RemoveHtml($this->tglrevisi->caption());

		// tahun_rencana
		$this->tahun_rencana->EditAttrs["class"] = "form-control";
		$this->tahun_rencana->EditCustomAttributes = "";
		$this->tahun_rencana->EditValue = $this->tahun_rencana->CurrentValue;
		$this->tahun_rencana->PlaceHolder = RemoveHtml($this->tahun_rencana->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->targetpes->CurrentValue))
				$this->targetpes->Total += $this->targetpes->CurrentValue; // Accumulate total
			if (is_numeric($this->angkatan->CurrentValue))
				$this->angkatan->Total += $this->angkatan->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->targetpes->CurrentValue = $this->targetpes->Total;
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->ViewCustomAttributes = "";
			$this->targetpes->HrefValue = ""; // Clear href value
			$this->angkatan->CurrentValue = $this->angkatan->Total;
			$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
			$this->angkatan->ViewCustomAttributes = "";
			$this->angkatan->HrefValue = ""; // Clear href value

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
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdbidang);
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->iso);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->jml_hari);
					$doc->exportCaption($this->jenisdurasi);
					$doc->exportCaption($this->targetpes);
					$doc->exportCaption($this->angkatan);
					$doc->exportCaption($this->sisa_angkatan);
					$doc->exportCaption($this->harga_satuan);
					$doc->exportCaption($this->hargatotal);
					$doc->exportCaption($this->tglrevisi);
					$doc->exportCaption($this->tahun_rencana);
				} else {
					$doc->exportCaption($this->rpdid);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdbidang);
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->iso);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->jml_hari);
					$doc->exportCaption($this->jenisdurasi);
					$doc->exportCaption($this->targetpes);
					$doc->exportCaption($this->angkatan);
					$doc->exportCaption($this->sisa_angkatan);
					$doc->exportCaption($this->harga_satuan);
					$doc->exportCaption($this->hargatotal);
					$doc->exportCaption($this->tglrevisi);
					$doc->exportCaption($this->tahun_rencana);
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
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdbidang);
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->iso);
						$doc->exportField($this->tempat);
						$doc->exportField($this->jml_hari);
						$doc->exportField($this->jenisdurasi);
						$doc->exportField($this->targetpes);
						$doc->exportField($this->angkatan);
						$doc->exportField($this->sisa_angkatan);
						$doc->exportField($this->harga_satuan);
						$doc->exportField($this->hargatotal);
						$doc->exportField($this->tglrevisi);
						$doc->exportField($this->tahun_rencana);
					} else {
						$doc->exportField($this->rpdid);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdbidang);
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->iso);
						$doc->exportField($this->tempat);
						$doc->exportField($this->jml_hari);
						$doc->exportField($this->jenisdurasi);
						$doc->exportField($this->targetpes);
						$doc->exportField($this->angkatan);
						$doc->exportField($this->sisa_angkatan);
						$doc->exportField($this->harga_satuan);
						$doc->exportField($this->hargatotal);
						$doc->exportField($this->tglrevisi);
						$doc->exportField($this->tahun_rencana);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->rpdid, '');
				$doc->exportAggregate($this->kdjudul, '');
				$doc->exportAggregate($this->kdbidang, '');
				$doc->exportAggregate($this->kdkursil, '');
				$doc->exportAggregate($this->iso, '');
				$doc->exportAggregate($this->tempat, '');
				$doc->exportAggregate($this->jml_hari, '');
				$doc->exportAggregate($this->jenisdurasi, '');
				$doc->exportAggregate($this->targetpes, 'TOTAL');
				$doc->exportAggregate($this->angkatan, 'TOTAL');
				$doc->exportAggregate($this->sisa_angkatan, '');
				$doc->exportAggregate($this->harga_satuan, '');
				$doc->exportAggregate($this->hargatotal, '');
				$doc->exportAggregate($this->tglrevisi, '');
				$doc->exportAggregate($this->tahun_rencana, '');
				$doc->endExportRow();
			}
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 't_rpdiklat';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_rpdiklat';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['rpdid'];

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
		$table = 't_rpdiklat';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['rpdid'];

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
		$table = 't_rpdiklat';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['rpdid'];

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
		if($this->tahun_rencana->AdvancedSearch->SearchValue == "")
		$this->tahun_rencana->AdvancedSearch->SearchValue = date("Y"); // Search value
	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
		$this->_SqlOrderBy = '`kdbidang` ASC';
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

		$rsnew["kdbidang"] = substr($rsnew["kdjudul"],0,1);
		$rsnew["tempat"] = "Jakarta";
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		$myResult = Execute("UPDATE t_pelatihan SET tempat='Jakarta' WHERE jenispel=1 AND rid =".$rsnew["rpdid"]);
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
		$cek_angkatan = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `rid` = '".$rsold["rpdid"]."' AND `jenispel` = 1");
		if($cek_angkatan > 0){
			$iso = $rsnew["iso"];
			if($rsnew["iso"] == "y"){
				$iso = "ISO";
			} else if ($rsnew["iso"] == "t") {
				$iso = "Tidak";
			} 
			$updatepelatihan = Execute("UPDATE `t_pelatihan` SET `kdprop` = 31, `kdkota` = 3174, `biaya` = ".$rsnew["harga_satuan"].", `pilihan_iso` = '".$rsnew["iso"]."', `tempat` = '".$rsnew["tempat"]."' WHERE `rid` = ".$rsold["rpdid"]." AND `jenispel` = 1");
		}
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

		$this->harga_satuan->ViewValue = str_replace(",", ".", FormatCurrency($this->harga_satuan->CurrentValue, 0, -2, -2, -2));
		if ($this->Export == "")
		$this->kdkursil->ViewValue = "<a href='t_kurikulumlist.php?showmaster=t_juduldetail&fk_kdkursil=".$this->kdkursil->CurrentValue."&fk_jpel=PP&fk_kdjudul=".$this->kdjudul->CurrentValue."'>".$this->kdkursil->ViewValue."</a>";
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>