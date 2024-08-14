<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_kurikulum
 */
class t_kurikulum extends DbTable
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
	public $kurikulumid;
	public $singbagian;
	public $jpel;
	public $kdjudul;
	public $lama_pelatihan;
	public $kdkursil;
	public $revisi;
	public $hari;
	public $kurikulum;
	public $silabus;
	public $tujuan_instruksional;
	public $sesi;
	public $created_by;
	public $created_at;
	public $updated_by;
	public $updated_at;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_kurikulum';
		$this->TableName = 't_kurikulum';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_kurikulum`";
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
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// kurikulumid
		$this->kurikulumid = new DbField('t_kurikulum', 't_kurikulum', 'x_kurikulumid', 'kurikulumid', '`kurikulumid`', '`kurikulumid`', 3, 11, -1, FALSE, '`kurikulumid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->kurikulumid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->kurikulumid->IsPrimaryKey = TRUE; // Primary key field
		$this->kurikulumid->Sortable = TRUE; // Allow sort
		$this->kurikulumid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kurikulumid'] = &$this->kurikulumid;

		// singbagian
		$this->singbagian = new DbField('t_kurikulum', 't_kurikulum', 'x_singbagian', 'singbagian', '`singbagian`', '`singbagian`', 200, 10, -1, FALSE, '`singbagian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->singbagian->Required = TRUE; // Required field
		$this->singbagian->Sortable = TRUE; // Allow sort
		$this->singbagian->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->singbagian->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->singbagian->Lookup = new Lookup('singbagian', 't_bidang', FALSE, 'singkatan', ["bidang","","",""], [], [], [], [], [], [], '', '');
		$this->fields['singbagian'] = &$this->singbagian;

		// jpel
		$this->jpel = new DbField('t_kurikulum', 't_kurikulum', 'x_jpel', 'jpel', '`jpel`', '`jpel`', 200, 5, -1, FALSE, '`jpel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jpel->IsForeignKey = TRUE; // Foreign key field
		$this->jpel->Required = TRUE; // Required field
		$this->jpel->Sortable = TRUE; // Allow sort
		$this->jpel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jpel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jpel->Lookup = new Lookup('jpel', 't_kurikulum', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jpel->OptionCount = 3;
		$this->fields['jpel'] = &$this->jpel;

		// kdjudul
		$this->kdjudul = new DbField('t_kurikulum', 't_kurikulum', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`kdjudul`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->IsForeignKey = TRUE; // Foreign key field
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// lama_pelatihan
		$this->lama_pelatihan = new DbField('t_kurikulum', 't_kurikulum', 'x_lama_pelatihan', 'lama_pelatihan', '`lama_pelatihan`', '`lama_pelatihan`', 2, 3, -1, FALSE, '`lama_pelatihan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->lama_pelatihan->Required = TRUE; // Required field
		$this->lama_pelatihan->Sortable = TRUE; // Allow sort
		$this->lama_pelatihan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->lama_pelatihan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->lama_pelatihan->Lookup = new Lookup('lama_pelatihan', 't_hari', FALSE, 'angka', ["angka","","",""], [], [], [], [], [], [], '', '');
		$this->lama_pelatihan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['lama_pelatihan'] = &$this->lama_pelatihan;

		// kdkursil
		$this->kdkursil = new DbField('t_kurikulum', 't_kurikulum', 'x_kdkursil', 'kdkursil', '`kdkursil`', '`kdkursil`', 200, 20, -1, FALSE, '`kdkursil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdkursil->IsForeignKey = TRUE; // Foreign key field
		$this->kdkursil->Required = TRUE; // Required field
		$this->kdkursil->Sortable = TRUE; // Allow sort
		$this->fields['kdkursil'] = &$this->kdkursil;

		// revisi
		$this->revisi = new DbField('t_kurikulum', 't_kurikulum', 'x_revisi', 'revisi', '`revisi`', '`revisi`', 200, 2, -1, FALSE, '`revisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revisi->IsForeignKey = TRUE; // Foreign key field
		$this->revisi->Required = TRUE; // Required field
		$this->revisi->Sortable = TRUE; // Allow sort
		$this->fields['revisi'] = &$this->revisi;

		// hari
		$this->hari = new DbField('t_kurikulum', 't_kurikulum', 'x_hari', 'hari', '`hari`', '`hari`', 2, 2, -1, FALSE, '`hari`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->hari->Required = TRUE; // Required field
		$this->hari->Sortable = TRUE; // Allow sort
		$this->hari->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->hari->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->hari->Lookup = new Lookup('hari', 't_hari', FALSE, 'angka', ["huruf","","",""], [], [], [], [], [], [], '', '');
		$this->hari->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['hari'] = &$this->hari;

		// kurikulum
		$this->kurikulum = new DbField('t_kurikulum', 't_kurikulum', 'x_kurikulum', 'kurikulum', '`kurikulum`', '`kurikulum`', 200, 255, -1, FALSE, '`kurikulum`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->kurikulum->Required = TRUE; // Required field
		$this->kurikulum->Sortable = TRUE; // Allow sort
		$this->fields['kurikulum'] = &$this->kurikulum;

		// silabus
		$this->silabus = new DbField('t_kurikulum', 't_kurikulum', 'x_silabus', 'silabus', '`silabus`', '`silabus`', 201, 65535, -1, FALSE, '`silabus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->silabus->Required = TRUE; // Required field
		$this->silabus->Sortable = TRUE; // Allow sort
		$this->fields['silabus'] = &$this->silabus;

		// tujuan_instruksional
		$this->tujuan_instruksional = new DbField('t_kurikulum', 't_kurikulum', 'x_tujuan_instruksional', 'tujuan_instruksional', '`tujuan_instruksional`', '`tujuan_instruksional`', 201, 65535, -1, FALSE, '`tujuan_instruksional`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->tujuan_instruksional->Required = TRUE; // Required field
		$this->tujuan_instruksional->Sortable = TRUE; // Allow sort
		$this->fields['tujuan_instruksional'] = &$this->tujuan_instruksional;

		// sesi
		$this->sesi = new DbField('t_kurikulum', 't_kurikulum', 'x_sesi', 'sesi', '`sesi`', '`sesi`', 2, 2, -1, FALSE, '`sesi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sesi->Required = TRUE; // Required field
		$this->sesi->Sortable = TRUE; // Allow sort
		$this->sesi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sesi'] = &$this->sesi;

		// created_by
		$this->created_by = new DbField('t_kurikulum', 't_kurikulum', 'x_created_by', 'created_by', '`created_by`', '`created_by`', 200, 255, -1, FALSE, '`created_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_by->Sortable = TRUE; // Allow sort
		$this->fields['created_by'] = &$this->created_by;

		// created_at
		$this->created_at = new DbField('t_kurikulum', 't_kurikulum', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_by
		$this->updated_by = new DbField('t_kurikulum', 't_kurikulum', 'x_updated_by', 'updated_by', '`updated_by`', '`updated_by`', 200, 255, -1, FALSE, '`updated_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_by->Sortable = TRUE; // Allow sort
		$this->fields['updated_by'] = &$this->updated_by;

		// updated_at
		$this->updated_at = new DbField('t_kurikulum', 't_kurikulum', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;
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
		} else {
			$fld->setSort("");
		}
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
		if ($this->getCurrentMasterTable() == "t_juduldetail") {
			if ($this->kdkursil->getSessionValue() != "")
				$masterFilter .= "`kdkursil`=" . QuotedValue($this->kdkursil->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->jpel->getSessionValue() != "")
				$masterFilter .= " AND `jpel`=" . QuotedValue($this->jpel->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->kdjudul->getSessionValue() != "")
				$masterFilter .= " AND `kdjudul`=" . QuotedValue($this->kdjudul->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->revisi->getSessionValue() != "")
				$masterFilter .= " AND `revisi`=" . QuotedValue($this->revisi->getSessionValue(), DATATYPE_STRING, "DB");
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
		if ($this->getCurrentMasterTable() == "t_juduldetail") {
			if ($this->kdkursil->getSessionValue() != "")
				$detailFilter .= "`kdkursil`=" . QuotedValue($this->kdkursil->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->jpel->getSessionValue() != "")
				$detailFilter .= " AND `jpel`=" . QuotedValue($this->jpel->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->kdjudul->getSessionValue() != "")
				$detailFilter .= " AND `kdjudul`=" . QuotedValue($this->kdjudul->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->revisi->getSessionValue() != "")
				$detailFilter .= " AND `revisi`=" . QuotedValue($this->revisi->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_t_juduldetail()
	{
		return "`kdkursil`='@kdkursil@' AND `jpel`='@jpel@' AND `kdjudul`='@kdjudul@' AND `revisi`='@revisi@'";
	}

	// Detail filter
	public function sqlDetailFilter_t_juduldetail()
	{
		return "`kdkursil`='@kdkursil@' AND `jpel`='@jpel@' AND `kdjudul`='@kdjudul@' AND `revisi`='@revisi@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_kurikulum`";
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
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
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
			$this->kurikulumid->setDbValue($conn->insert_ID());
			$rs['kurikulumid'] = $this->kurikulumid->DbValue;
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
			$fldname = 'kurikulumid';
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
			if (array_key_exists('kurikulumid', $rs))
				AddFilter($where, QuotedName('kurikulumid', $this->Dbid) . '=' . QuotedValue($rs['kurikulumid'], $this->kurikulumid->DataType, $this->Dbid));
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
		$this->kurikulumid->DbValue = $row['kurikulumid'];
		$this->singbagian->DbValue = $row['singbagian'];
		$this->jpel->DbValue = $row['jpel'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->lama_pelatihan->DbValue = $row['lama_pelatihan'];
		$this->kdkursil->DbValue = $row['kdkursil'];
		$this->revisi->DbValue = $row['revisi'];
		$this->hari->DbValue = $row['hari'];
		$this->kurikulum->DbValue = $row['kurikulum'];
		$this->silabus->DbValue = $row['silabus'];
		$this->tujuan_instruksional->DbValue = $row['tujuan_instruksional'];
		$this->sesi->DbValue = $row['sesi'];
		$this->created_by->DbValue = $row['created_by'];
		$this->created_at->DbValue = $row['created_at'];
		$this->updated_by->DbValue = $row['updated_by'];
		$this->updated_at->DbValue = $row['updated_at'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`kurikulumid` = @kurikulumid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('kurikulumid', $row) ? $row['kurikulumid'] : NULL;
		else
			$val = $this->kurikulumid->OldValue !== NULL ? $this->kurikulumid->OldValue : $this->kurikulumid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@kurikulumid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_kurikulumlist.php";
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
		if ($pageName == "t_kurikulumview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_kurikulumedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_kurikulumadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_kurikulumlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_kurikulumview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_kurikulumview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_kurikulumadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_kurikulumadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_kurikulumedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("t_kurikulumadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("t_kurikulumdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "t_juduldetail" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_kdkursil=" . urlencode($this->kdkursil->CurrentValue);
			$url .= "&fk_jpel=" . urlencode($this->jpel->CurrentValue);
			$url .= "&fk_kdjudul=" . urlencode($this->kdjudul->CurrentValue);
			$url .= "&fk_revisi=" . urlencode($this->revisi->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "kurikulumid:" . JsonEncode($this->kurikulumid->CurrentValue, "number");
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
		if ($this->kurikulumid->CurrentValue != NULL) {
			$url .= "kurikulumid=" . urlencode($this->kurikulumid->CurrentValue);
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
			if (Param("kurikulumid") !== NULL)
				$arKeys[] = Param("kurikulumid");
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
				$this->kurikulumid->CurrentValue = $key;
			else
				$this->kurikulumid->OldValue = $key;
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
		$this->kurikulumid->setDbValue($rs->fields('kurikulumid'));
		$this->singbagian->setDbValue($rs->fields('singbagian'));
		$this->jpel->setDbValue($rs->fields('jpel'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->lama_pelatihan->setDbValue($rs->fields('lama_pelatihan'));
		$this->kdkursil->setDbValue($rs->fields('kdkursil'));
		$this->revisi->setDbValue($rs->fields('revisi'));
		$this->hari->setDbValue($rs->fields('hari'));
		$this->kurikulum->setDbValue($rs->fields('kurikulum'));
		$this->silabus->setDbValue($rs->fields('silabus'));
		$this->tujuan_instruksional->setDbValue($rs->fields('tujuan_instruksional'));
		$this->sesi->setDbValue($rs->fields('sesi'));
		$this->created_by->setDbValue($rs->fields('created_by'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->updated_by->setDbValue($rs->fields('updated_by'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// kurikulumid
		// singbagian
		// jpel
		// kdjudul
		// lama_pelatihan
		// kdkursil
		// revisi
		// hari
		// kurikulum
		// silabus
		// tujuan_instruksional
		// sesi
		// created_by
		// created_at
		// updated_by
		// updated_at
		// kurikulumid

		$this->kurikulumid->ViewValue = $this->kurikulumid->CurrentValue;
		$this->kurikulumid->ViewCustomAttributes = "";

		// singbagian
		$curVal = strval($this->singbagian->CurrentValue);
		if ($curVal != "") {
			$this->singbagian->ViewValue = $this->singbagian->lookupCacheOption($curVal);
			if ($this->singbagian->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`singkatan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->singbagian->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->singbagian->ViewValue = $this->singbagian->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->singbagian->ViewValue = $this->singbagian->CurrentValue;
				}
			}
		} else {
			$this->singbagian->ViewValue = NULL;
		}
		$this->singbagian->ViewCustomAttributes = "";

		// jpel
		if (strval($this->jpel->CurrentValue) != "") {
			$this->jpel->ViewValue = $this->jpel->optionCaption($this->jpel->CurrentValue);
		} else {
			$this->jpel->ViewValue = NULL;
		}
		$this->jpel->ViewCustomAttributes = "";

		// kdjudul
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
		$this->kdjudul->ViewCustomAttributes = "";

		// lama_pelatihan
		$curVal = strval($this->lama_pelatihan->CurrentValue);
		if ($curVal != "") {
			$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->lookupCacheOption($curVal);
			if ($this->lama_pelatihan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`angka`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->lama_pelatihan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->lama_pelatihan->ViewValue = $this->lama_pelatihan->CurrentValue;
				}
			}
		} else {
			$this->lama_pelatihan->ViewValue = NULL;
		}
		$this->lama_pelatihan->ViewCustomAttributes = "";

		// kdkursil
		$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
		$this->kdkursil->ViewCustomAttributes = "";

		// revisi
		$this->revisi->ViewValue = $this->revisi->CurrentValue;
		$this->revisi->ViewCustomAttributes = "";

		// hari
		$curVal = strval($this->hari->CurrentValue);
		if ($curVal != "") {
			$this->hari->ViewValue = $this->hari->lookupCacheOption($curVal);
			if ($this->hari->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`angka`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->hari->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->hari->ViewValue = $this->hari->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->hari->ViewValue = $this->hari->CurrentValue;
				}
			}
		} else {
			$this->hari->ViewValue = NULL;
		}
		$this->hari->ViewCustomAttributes = "";

		// kurikulum
		$this->kurikulum->ViewValue = $this->kurikulum->CurrentValue;
		$this->kurikulum->ViewCustomAttributes = "";

		// silabus
		$this->silabus->ViewValue = $this->silabus->CurrentValue;
		$this->silabus->ViewCustomAttributes = "";

		// tujuan_instruksional
		$this->tujuan_instruksional->ViewValue = $this->tujuan_instruksional->CurrentValue;
		$this->tujuan_instruksional->ViewCustomAttributes = "";

		// sesi
		$this->sesi->ViewValue = $this->sesi->CurrentValue;
		$this->sesi->ViewCustomAttributes = "";

		// created_by
		$this->created_by->ViewValue = $this->created_by->CurrentValue;
		$this->created_by->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// updated_by
		$this->updated_by->ViewValue = $this->updated_by->CurrentValue;
		$this->updated_by->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// kurikulumid
		$this->kurikulumid->LinkCustomAttributes = "";
		$this->kurikulumid->HrefValue = "";
		$this->kurikulumid->TooltipValue = "";

		// singbagian
		$this->singbagian->LinkCustomAttributes = "";
		$this->singbagian->HrefValue = "";
		$this->singbagian->TooltipValue = "";

		// jpel
		$this->jpel->LinkCustomAttributes = "";
		$this->jpel->HrefValue = "";
		$this->jpel->TooltipValue = "";

		// kdjudul
		$this->kdjudul->LinkCustomAttributes = "";
		$this->kdjudul->HrefValue = "";
		$this->kdjudul->TooltipValue = "";

		// lama_pelatihan
		$this->lama_pelatihan->LinkCustomAttributes = "";
		$this->lama_pelatihan->HrefValue = "";
		$this->lama_pelatihan->TooltipValue = "";

		// kdkursil
		$this->kdkursil->LinkCustomAttributes = "";
		$this->kdkursil->HrefValue = "";
		$this->kdkursil->TooltipValue = "";

		// revisi
		$this->revisi->LinkCustomAttributes = "";
		$this->revisi->HrefValue = "";
		$this->revisi->TooltipValue = "";

		// hari
		$this->hari->LinkCustomAttributes = "";
		$this->hari->HrefValue = "";
		$this->hari->TooltipValue = "";

		// kurikulum
		$this->kurikulum->LinkCustomAttributes = "";
		$this->kurikulum->HrefValue = "";
		$this->kurikulum->TooltipValue = "";

		// silabus
		$this->silabus->LinkCustomAttributes = "";
		$this->silabus->HrefValue = "";
		$this->silabus->TooltipValue = "";

		// tujuan_instruksional
		$this->tujuan_instruksional->LinkCustomAttributes = "";
		$this->tujuan_instruksional->HrefValue = "";
		$this->tujuan_instruksional->TooltipValue = "";

		// sesi
		$this->sesi->LinkCustomAttributes = "";
		$this->sesi->HrefValue = "";
		$this->sesi->TooltipValue = "";

		// created_by
		$this->created_by->LinkCustomAttributes = "";
		$this->created_by->HrefValue = "";
		$this->created_by->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// updated_by
		$this->updated_by->LinkCustomAttributes = "";
		$this->updated_by->HrefValue = "";
		$this->updated_by->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

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

		// kurikulumid
		$this->kurikulumid->EditAttrs["class"] = "form-control";
		$this->kurikulumid->EditCustomAttributes = "";
		$this->kurikulumid->EditValue = $this->kurikulumid->CurrentValue;
		$this->kurikulumid->ViewCustomAttributes = "";

		// singbagian
		$this->singbagian->EditAttrs["class"] = "form-control";
		$this->singbagian->EditCustomAttributes = "";
		$curVal = strval($this->singbagian->CurrentValue);
		if ($curVal != "") {
			$this->singbagian->EditValue = $this->singbagian->lookupCacheOption($curVal);
			if ($this->singbagian->EditValue === NULL) { // Lookup from database
				$filterWrk = "`singkatan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->singbagian->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->singbagian->EditValue = $this->singbagian->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->singbagian->EditValue = $this->singbagian->CurrentValue;
				}
			}
		} else {
			$this->singbagian->EditValue = NULL;
		}
		$this->singbagian->ViewCustomAttributes = "";

		// jpel
		$this->jpel->EditAttrs["class"] = "form-control";
		$this->jpel->EditCustomAttributes = "";
		if (strval($this->jpel->CurrentValue) != "") {
			$this->jpel->EditValue = $this->jpel->optionCaption($this->jpel->CurrentValue);
		} else {
			$this->jpel->EditValue = NULL;
		}
		$this->jpel->ViewCustomAttributes = "";

		// kdjudul
		$this->kdjudul->EditAttrs["class"] = "form-control";
		$this->kdjudul->EditCustomAttributes = "";
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
		$this->kdjudul->ViewCustomAttributes = "";

		// lama_pelatihan
		$this->lama_pelatihan->EditAttrs["class"] = "form-control";
		$this->lama_pelatihan->EditCustomAttributes = "";
		$curVal = strval($this->lama_pelatihan->CurrentValue);
		if ($curVal != "") {
			$this->lama_pelatihan->EditValue = $this->lama_pelatihan->lookupCacheOption($curVal);
			if ($this->lama_pelatihan->EditValue === NULL) { // Lookup from database
				$filterWrk = "`angka`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->lama_pelatihan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->lama_pelatihan->EditValue = $this->lama_pelatihan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->lama_pelatihan->EditValue = $this->lama_pelatihan->CurrentValue;
				}
			}
		} else {
			$this->lama_pelatihan->EditValue = NULL;
		}
		$this->lama_pelatihan->ViewCustomAttributes = "";

		// kdkursil
		$this->kdkursil->EditAttrs["class"] = "form-control";
		$this->kdkursil->EditCustomAttributes = "";
		$this->kdkursil->EditValue = $this->kdkursil->CurrentValue;
		$this->kdkursil->ViewCustomAttributes = "";

		// revisi
		$this->revisi->EditAttrs["class"] = "form-control";
		$this->revisi->EditCustomAttributes = "";
		if ($this->revisi->getSessionValue() != "") {
			$this->revisi->CurrentValue = $this->revisi->getSessionValue();
			$this->revisi->ViewValue = $this->revisi->CurrentValue;
			$this->revisi->ViewCustomAttributes = "";
		} else {
			if (!$this->revisi->Raw)
				$this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
			$this->revisi->EditValue = $this->revisi->CurrentValue;
			$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());
		}

		// hari
		$this->hari->EditAttrs["class"] = "form-control";
		$this->hari->EditCustomAttributes = "";

		// kurikulum
		$this->kurikulum->EditAttrs["class"] = "form-control";
		$this->kurikulum->EditCustomAttributes = "";
		$this->kurikulum->EditValue = $this->kurikulum->CurrentValue;
		$this->kurikulum->PlaceHolder = RemoveHtml($this->kurikulum->caption());

		// silabus
		$this->silabus->EditAttrs["class"] = "form-control";
		$this->silabus->EditCustomAttributes = "";
		$this->silabus->EditValue = $this->silabus->CurrentValue;
		$this->silabus->PlaceHolder = RemoveHtml($this->silabus->caption());

		// tujuan_instruksional
		$this->tujuan_instruksional->EditAttrs["class"] = "form-control";
		$this->tujuan_instruksional->EditCustomAttributes = "";
		$this->tujuan_instruksional->EditValue = $this->tujuan_instruksional->CurrentValue;
		$this->tujuan_instruksional->PlaceHolder = RemoveHtml($this->tujuan_instruksional->caption());

		// sesi
		$this->sesi->EditAttrs["class"] = "form-control";
		$this->sesi->EditCustomAttributes = "";
		$this->sesi->EditValue = $this->sesi->CurrentValue;
		$this->sesi->PlaceHolder = RemoveHtml($this->sesi->caption());

		// created_by
		// created_at
		// updated_by
		// updated_at
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
					$doc->exportCaption($this->singbagian);
					$doc->exportCaption($this->jpel);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->lama_pelatihan);
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->hari);
					$doc->exportCaption($this->kurikulum);
					$doc->exportCaption($this->silabus);
					$doc->exportCaption($this->tujuan_instruksional);
					$doc->exportCaption($this->sesi);
					$doc->exportCaption($this->created_by);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_by);
					$doc->exportCaption($this->updated_at);
				} else {
					$doc->exportCaption($this->hari);
					$doc->exportCaption($this->kurikulum);
					$doc->exportCaption($this->silabus);
					$doc->exportCaption($this->tujuan_instruksional);
					$doc->exportCaption($this->sesi);
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
						$doc->exportField($this->singbagian);
						$doc->exportField($this->jpel);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->lama_pelatihan);
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->revisi);
						$doc->exportField($this->hari);
						$doc->exportField($this->kurikulum);
						$doc->exportField($this->silabus);
						$doc->exportField($this->tujuan_instruksional);
						$doc->exportField($this->sesi);
						$doc->exportField($this->created_by);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_by);
						$doc->exportField($this->updated_at);
					} else {
						$doc->exportField($this->hari);
						$doc->exportField($this->kurikulum);
						$doc->exportField($this->silabus);
						$doc->exportField($this->tujuan_instruksional);
						$doc->exportField($this->sesi);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 't_kurikulum';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_kurikulum';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['kurikulumid'];

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
		$table = 't_kurikulum';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['kurikulumid'];

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
		$table = 't_kurikulum';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['kurikulumid'];

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

		/*if(empty($rsnew["singbagian"]) || empty($rsnew["jpel"]) || empty($rsnew["kdjudul"]) || empty($rsnew["lama_pelatihan"])){
			return FALSE;
		}
		$singjudul = ExecuteScalar("SELECT singkatan FROM `t_judul` WHERE kdjudul = '".$rsnew["kdjudul"]."'");
		if(empty($singjudul)){
			$this->setFailureMessage("Kode singkatan kosong! Silahkan cek pada daftar judul.");
			return FALSE;
		}
		if ($rsnew["lama_pelatihan"] < 10){
			$lamapel = "0".$rsnew["lama_pelatihan"];
		} else {
			$lamapel = $rsnew["lama_pelatihan"];
		}
		$rsnew["kdkursil"] = $rsnew["singbagian"] . "-" . $rsnew["jpel"] . "-" . $singjudul . "-" . $lamapel;
		*/
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		if(empty($rsnew["kdkursil"])){
			$rsnew["kdkursil"] = $rsold["kdkursil"];
		}
		$MyResult = Execute("UPDATE `t_kurikulum` a INNER JOIN `t_juduldetail` b ON a.`kdkursil` = b.`kdkursil` SET a.`kdjudul`= b.`kdjudul`, a.`singbagian` = SUBSTRING_INDEX(a.`kdkursil`,'-',1), a.`jpel` = SUBSTRING_INDEX(SUBSTRING_INDEX(a.`kdkursil`,'-',2),'-',-1), a.`lama_pelatihan` = SUBSTRING_INDEX(a.`kdkursil`,'-',-1) WHERE a.`kdkursil` = '".$rsnew["kdkursil"]."'");
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

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>