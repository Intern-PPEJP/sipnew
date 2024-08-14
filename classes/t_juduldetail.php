<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_juduldetail
 */
class t_juduldetail extends DbTable
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
	public $detailjdid;
	public $singbagian;
	public $jpel;
	public $kdjudul;
	public $kdkursil;
	public $revisi;
	public $tgl_terbit;
	public $deskripsi_singkat;
	public $tujuan;
	public $target_peserta;
	public $lama_pelatihan;
	public $catatan;
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
		$this->TableVar = 't_juduldetail';
		$this->TableName = 't_juduldetail';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_juduldetail`";
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

		// detailjdid
		$this->detailjdid = new DbField('t_juduldetail', 't_juduldetail', 'x_detailjdid', 'detailjdid', '`detailjdid`', '`detailjdid`', 3, 11, -1, FALSE, '`detailjdid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->detailjdid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->detailjdid->IsPrimaryKey = TRUE; // Primary key field
		$this->detailjdid->Sortable = TRUE; // Allow sort
		$this->detailjdid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['detailjdid'] = &$this->detailjdid;

		// singbagian
		$this->singbagian = new DbField('t_juduldetail', 't_juduldetail', 'x_singbagian', 'singbagian', '`singbagian`', '`singbagian`', 200, 10, -1, FALSE, '`singbagian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->singbagian->Required = TRUE; // Required field
		$this->singbagian->Sortable = TRUE; // Allow sort
		$this->singbagian->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->singbagian->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->singbagian->Lookup = new Lookup('singbagian', 't_bidang', FALSE, 'singkatan', ["bidang","","",""], [], [], [], [], [], [], '', '');
		$this->fields['singbagian'] = &$this->singbagian;

		// jpel
		$this->jpel = new DbField('t_juduldetail', 't_juduldetail', 'x_jpel', 'jpel', '`jpel`', '`jpel`', 200, 5, -1, FALSE, '`jpel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jpel->IsForeignKey = TRUE; // Foreign key field
		$this->jpel->Required = TRUE; // Required field
		$this->jpel->Sortable = TRUE; // Allow sort
		$this->jpel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jpel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jpel->Lookup = new Lookup('jpel', 't_juduldetail', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jpel->OptionCount = 3;
		$this->fields['jpel'] = &$this->jpel;

		// kdjudul
		$this->kdjudul = new DbField('t_juduldetail', 't_juduldetail', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->IsForeignKey = TRUE; // Foreign key field
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// kdkursil
		$this->kdkursil = new DbField('t_juduldetail', 't_juduldetail', 'x_kdkursil', 'kdkursil', '`kdkursil`', '`kdkursil`', 200, 20, -1, FALSE, '`kdkursil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdkursil->IsForeignKey = TRUE; // Foreign key field
		$this->kdkursil->Required = TRUE; // Required field
		$this->kdkursil->Sortable = TRUE; // Allow sort
		$this->fields['kdkursil'] = &$this->kdkursil;

		// revisi
		$this->revisi = new DbField('t_juduldetail', 't_juduldetail', 'x_revisi', 'revisi', '`revisi`', '`revisi`', 200, 2, -1, FALSE, '`revisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revisi->IsForeignKey = TRUE; // Foreign key field
		$this->revisi->Required = TRUE; // Required field
		$this->revisi->Sortable = TRUE; // Allow sort
		$this->fields['revisi'] = &$this->revisi;

		// tgl_terbit
		$this->tgl_terbit = new DbField('t_juduldetail', 't_juduldetail', 'x_tgl_terbit', 'tgl_terbit', '`tgl_terbit`', CastDateFieldForLike("`tgl_terbit`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_terbit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_terbit->Required = TRUE; // Required field
		$this->tgl_terbit->Sortable = TRUE; // Allow sort
		$this->tgl_terbit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_terbit'] = &$this->tgl_terbit;

		// deskripsi_singkat
		$this->deskripsi_singkat = new DbField('t_juduldetail', 't_juduldetail', 'x_deskripsi_singkat', 'deskripsi_singkat', '`deskripsi_singkat`', '`deskripsi_singkat`', 201, 65535, -1, FALSE, '`deskripsi_singkat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->deskripsi_singkat->Required = TRUE; // Required field
		$this->deskripsi_singkat->Sortable = TRUE; // Allow sort
		$this->deskripsi_singkat->MemoMaxLength = 50;
		$this->fields['deskripsi_singkat'] = &$this->deskripsi_singkat;

		// tujuan
		$this->tujuan = new DbField('t_juduldetail', 't_juduldetail', 'x_tujuan', 'tujuan', '`tujuan`', '`tujuan`', 201, 65535, -1, FALSE, '`tujuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->tujuan->Required = TRUE; // Required field
		$this->tujuan->Sortable = TRUE; // Allow sort
		$this->tujuan->MemoMaxLength = 50;
		$this->fields['tujuan'] = &$this->tujuan;

		// target_peserta
		$this->target_peserta = new DbField('t_juduldetail', 't_juduldetail', 'x_target_peserta', 'target_peserta', '`target_peserta`', '`target_peserta`', 201, 65535, -1, FALSE, '`target_peserta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->target_peserta->Required = TRUE; // Required field
		$this->target_peserta->Sortable = TRUE; // Allow sort
		$this->target_peserta->MemoMaxLength = 50;
		$this->fields['target_peserta'] = &$this->target_peserta;

		// lama_pelatihan
		$this->lama_pelatihan = new DbField('t_juduldetail', 't_juduldetail', 'x_lama_pelatihan', 'lama_pelatihan', '`lama_pelatihan`', '`lama_pelatihan`', 2, 3, -1, FALSE, '`lama_pelatihan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->lama_pelatihan->Required = TRUE; // Required field
		$this->lama_pelatihan->Sortable = TRUE; // Allow sort
		$this->lama_pelatihan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->lama_pelatihan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->lama_pelatihan->Lookup = new Lookup('lama_pelatihan', 't_hari', FALSE, 'angka', ["angka","","",""], [], [], [], [], [], [], '', '');
		$this->lama_pelatihan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['lama_pelatihan'] = &$this->lama_pelatihan;

		// catatan
		$this->catatan = new DbField('t_juduldetail', 't_juduldetail', 'x_catatan', 'catatan', '`catatan`', '`catatan`', 201, 65535, -1, FALSE, '`catatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->catatan->Sortable = TRUE; // Allow sort
		$this->fields['catatan'] = &$this->catatan;

		// created_by
		$this->created_by = new DbField('t_juduldetail', 't_juduldetail', 'x_created_by', 'created_by', '`created_by`', '`created_by`', 200, 100, -1, FALSE, '`created_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_by->Sortable = TRUE; // Allow sort
		$this->fields['created_by'] = &$this->created_by;

		// created_at
		$this->created_at = new DbField('t_juduldetail', 't_juduldetail', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_by
		$this->updated_by = new DbField('t_juduldetail', 't_juduldetail', 'x_updated_by', 'updated_by', '`updated_by`', '`updated_by`', 200, 100, -1, FALSE, '`updated_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_by->Sortable = TRUE; // Allow sort
		$this->fields['updated_by'] = &$this->updated_by;

		// updated_at
		$this->updated_at = new DbField('t_juduldetail', 't_juduldetail', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		if ($this->getCurrentMasterTable() == "t_judul") {
			if ($this->kdjudul->getSessionValue() != "")
				$masterFilter .= "`kdjudul`=" . QuotedValue($this->kdjudul->getSessionValue(), DATATYPE_STRING, "DB");
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
		if ($this->getCurrentMasterTable() == "t_judul") {
			if ($this->kdjudul->getSessionValue() != "")
				$detailFilter .= "`kdjudul`=" . QuotedValue($this->kdjudul->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_t_judul()
	{
		return "`kdjudul`='@kdjudul@'";
	}

	// Detail filter
	public function sqlDetailFilter_t_judul()
	{
		return "`kdjudul`='@kdjudul@'";
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
		if ($this->getCurrentDetailTable() == "t_kurikulum") {
			$detailUrl = $GLOBALS["t_kurikulum"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_kdkursil=" . urlencode($this->kdkursil->CurrentValue);
			$detailUrl .= "&fk_jpel=" . urlencode($this->jpel->CurrentValue);
			$detailUrl .= "&fk_kdjudul=" . urlencode($this->kdjudul->CurrentValue);
			$detailUrl .= "&fk_revisi=" . urlencode($this->revisi->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_juduldetaillist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_juduldetail`";
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
			"SELECT *, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `t_juduldetail`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `t_juduldetail`" .
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
			$this->detailjdid->setDbValue($conn->insert_ID());
			$rs['detailjdid'] = $this->detailjdid->DbValue;
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

		// Cascade Update detail table 't_kurikulum'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['kdkursil']) && $rsold['kdkursil'] != $rs['kdkursil'])) { // Update detail field 'kdkursil'
			$cascadeUpdate = TRUE;
			$rscascade['kdkursil'] = $rs['kdkursil'];
		}
		if ($rsold && (isset($rs['jpel']) && $rsold['jpel'] != $rs['jpel'])) { // Update detail field 'jpel'
			$cascadeUpdate = TRUE;
			$rscascade['jpel'] = $rs['jpel'];
		}
		if ($rsold && (isset($rs['kdjudul']) && $rsold['kdjudul'] != $rs['kdjudul'])) { // Update detail field 'kdjudul'
			$cascadeUpdate = TRUE;
			$rscascade['kdjudul'] = $rs['kdjudul'];
		}
		if ($rsold && (isset($rs['revisi']) && $rsold['revisi'] != $rs['revisi'])) { // Update detail field 'revisi'
			$cascadeUpdate = TRUE;
			$rscascade['revisi'] = $rs['revisi'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["t_kurikulum"]))
				$GLOBALS["t_kurikulum"] = new t_kurikulum();
			$rswrk = $GLOBALS["t_kurikulum"]->loadRs("`kdkursil` = " . QuotedValue($rsold['kdkursil'], DATATYPE_STRING, 'DB') . " AND " . "`jpel` = " . QuotedValue($rsold['jpel'], DATATYPE_STRING, 'DB') . " AND " . "`kdjudul` = " . QuotedValue($rsold['kdjudul'], DATATYPE_STRING, 'DB') . " AND " . "`revisi` = " . QuotedValue($rsold['revisi'], DATATYPE_STRING, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'kurikulumid';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["t_kurikulum"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["t_kurikulum"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["t_kurikulum"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'detailjdid';
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
			if (array_key_exists('detailjdid', $rs))
				AddFilter($where, QuotedName('detailjdid', $this->Dbid) . '=' . QuotedValue($rs['detailjdid'], $this->detailjdid->DataType, $this->Dbid));
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

		// Cascade delete detail table 't_kurikulum'
		if (!isset($GLOBALS["t_kurikulum"]))
			$GLOBALS["t_kurikulum"] = new t_kurikulum();
		$rscascade = $GLOBALS["t_kurikulum"]->loadRs("`kdkursil` = " . QuotedValue($rs['kdkursil'], DATATYPE_STRING, "DB") . " AND " . "`jpel` = " . QuotedValue($rs['jpel'], DATATYPE_STRING, "DB") . " AND " . "`kdjudul` = " . QuotedValue($rs['kdjudul'], DATATYPE_STRING, "DB") . " AND " . "`revisi` = " . QuotedValue($rs['revisi'], DATATYPE_STRING, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["t_kurikulum"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["t_kurikulum"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["t_kurikulum"]->Row_Deleted($dtlrow);
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
		$this->detailjdid->DbValue = $row['detailjdid'];
		$this->singbagian->DbValue = $row['singbagian'];
		$this->jpel->DbValue = $row['jpel'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->kdkursil->DbValue = $row['kdkursil'];
		$this->revisi->DbValue = $row['revisi'];
		$this->tgl_terbit->DbValue = $row['tgl_terbit'];
		$this->deskripsi_singkat->DbValue = $row['deskripsi_singkat'];
		$this->tujuan->DbValue = $row['tujuan'];
		$this->target_peserta->DbValue = $row['target_peserta'];
		$this->lama_pelatihan->DbValue = $row['lama_pelatihan'];
		$this->catatan->DbValue = $row['catatan'];
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
		return "`detailjdid` = @detailjdid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('detailjdid', $row) ? $row['detailjdid'] : NULL;
		else
			$val = $this->detailjdid->OldValue !== NULL ? $this->detailjdid->OldValue : $this->detailjdid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@detailjdid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_juduldetaillist.php";
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
		if ($pageName == "t_juduldetailview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_juduldetailedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_juduldetailadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_juduldetaillist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_juduldetailview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_juduldetailview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_juduldetailadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_juduldetailadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_juduldetailedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_juduldetailedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("t_juduldetailadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_juduldetailadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_juduldetaildelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "t_judul" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_kdjudul=" . urlencode($this->kdjudul->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "detailjdid:" . JsonEncode($this->detailjdid->CurrentValue, "number");
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
		if ($this->detailjdid->CurrentValue != NULL) {
			$url .= "detailjdid=" . urlencode($this->detailjdid->CurrentValue);
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
			if (Param("detailjdid") !== NULL)
				$arKeys[] = Param("detailjdid");
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
				$this->detailjdid->CurrentValue = $key;
			else
				$this->detailjdid->OldValue = $key;
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
		$this->detailjdid->setDbValue($rs->fields('detailjdid'));
		$this->singbagian->setDbValue($rs->fields('singbagian'));
		$this->jpel->setDbValue($rs->fields('jpel'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->kdkursil->setDbValue($rs->fields('kdkursil'));
		$this->revisi->setDbValue($rs->fields('revisi'));
		$this->tgl_terbit->setDbValue($rs->fields('tgl_terbit'));
		$this->deskripsi_singkat->setDbValue($rs->fields('deskripsi_singkat'));
		$this->tujuan->setDbValue($rs->fields('tujuan'));
		$this->target_peserta->setDbValue($rs->fields('target_peserta'));
		$this->lama_pelatihan->setDbValue($rs->fields('lama_pelatihan'));
		$this->catatan->setDbValue($rs->fields('catatan'));
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
		// detailjdid
		// singbagian
		// jpel
		// kdjudul
		// kdkursil
		// revisi
		// tgl_terbit
		// deskripsi_singkat
		// tujuan
		// target_peserta
		// lama_pelatihan
		// catatan
		// created_by
		// created_at
		// updated_by
		// updated_at
		// detailjdid

		$this->detailjdid->ViewValue = $this->detailjdid->CurrentValue;
		$this->detailjdid->ViewCustomAttributes = "";

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
		$this->kdkursil->ViewCustomAttributes = "";

		// revisi
		$this->revisi->ViewValue = $this->revisi->CurrentValue;
		$this->revisi->ViewCustomAttributes = "";

		// tgl_terbit
		$this->tgl_terbit->ViewValue = $this->tgl_terbit->CurrentValue;
		$this->tgl_terbit->ViewValue = FormatDateTime($this->tgl_terbit->ViewValue, 0);
		$this->tgl_terbit->ViewCustomAttributes = "";

		// deskripsi_singkat
		$this->deskripsi_singkat->ViewValue = $this->deskripsi_singkat->CurrentValue;
		$this->deskripsi_singkat->ViewCustomAttributes = "";

		// tujuan
		$this->tujuan->ViewValue = $this->tujuan->CurrentValue;
		$this->tujuan->ViewCustomAttributes = "";

		// target_peserta
		$this->target_peserta->ViewValue = $this->target_peserta->CurrentValue;
		$this->target_peserta->ViewCustomAttributes = "";

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

		// catatan
		$this->catatan->ViewValue = $this->catatan->CurrentValue;
		$this->catatan->ViewCustomAttributes = "";

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

		// detailjdid
		$this->detailjdid->LinkCustomAttributes = "";
		$this->detailjdid->HrefValue = "";
		$this->detailjdid->TooltipValue = "";

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

		// deskripsi_singkat
		$this->deskripsi_singkat->LinkCustomAttributes = "";
		$this->deskripsi_singkat->HrefValue = "";
		if (!$this->isExport()) {
			$this->deskripsi_singkat->TooltipValue = strval($this->deskripsi_singkat->CurrentValue);
			$this->deskripsi_singkat->TooltipWidth = 500;
			if ($this->deskripsi_singkat->HrefValue == "")
				$this->deskripsi_singkat->HrefValue = "javascript:void(0);";
			$this->deskripsi_singkat->LinkAttrs->appendClass("ew-tooltip-link");
			$this->deskripsi_singkat->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x" . (($this->RowType != ROWTYPE_MASTER) ? @$this->RowCount : "") . "_deskripsi_singkat";
			$this->deskripsi_singkat->LinkAttrs["data-tooltip-width"] = $this->deskripsi_singkat->TooltipWidth;
			$this->deskripsi_singkat->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
		}

		// tujuan
		$this->tujuan->LinkCustomAttributes = "";
		$this->tujuan->HrefValue = "";
		if (!$this->isExport()) {
			$this->tujuan->TooltipValue = strval($this->tujuan->CurrentValue);
			$this->tujuan->TooltipWidth = 300;
			if ($this->tujuan->HrefValue == "")
				$this->tujuan->HrefValue = "javascript:void(0);";
			$this->tujuan->LinkAttrs->appendClass("ew-tooltip-link");
			$this->tujuan->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x" . (($this->RowType != ROWTYPE_MASTER) ? @$this->RowCount : "") . "_tujuan";
			$this->tujuan->LinkAttrs["data-tooltip-width"] = $this->tujuan->TooltipWidth;
			$this->tujuan->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
		}

		// target_peserta
		$this->target_peserta->LinkCustomAttributes = "";
		$this->target_peserta->HrefValue = "";
		if (!$this->isExport()) {
			$this->target_peserta->TooltipValue = strval($this->target_peserta->CurrentValue);
			$this->target_peserta->TooltipWidth = 300;
			if ($this->target_peserta->HrefValue == "")
				$this->target_peserta->HrefValue = "javascript:void(0);";
			$this->target_peserta->LinkAttrs->appendClass("ew-tooltip-link");
			$this->target_peserta->LinkAttrs["data-tooltip-id"] = "tt_t_juduldetail_x" . (($this->RowType != ROWTYPE_MASTER) ? @$this->RowCount : "") . "_target_peserta";
			$this->target_peserta->LinkAttrs["data-tooltip-width"] = $this->target_peserta->TooltipWidth;
			$this->target_peserta->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
		}

		// lama_pelatihan
		$this->lama_pelatihan->LinkCustomAttributes = "";
		$this->lama_pelatihan->HrefValue = "";
		$this->lama_pelatihan->TooltipValue = "";

		// catatan
		$this->catatan->LinkCustomAttributes = "";
		$this->catatan->HrefValue = "";
		$this->catatan->TooltipValue = "";

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

		// detailjdid
		$this->detailjdid->EditAttrs["class"] = "form-control";
		$this->detailjdid->EditCustomAttributes = "";
		$this->detailjdid->EditValue = $this->detailjdid->CurrentValue;
		$this->detailjdid->ViewCustomAttributes = "";

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
		$this->kdkursil->EditValue = $this->kdkursil->CurrentValue;
		$this->kdkursil->ViewCustomAttributes = "";

		// revisi
		$this->revisi->EditAttrs["class"] = "form-control";
		$this->revisi->EditCustomAttributes = "";
		$this->revisi->EditValue = $this->revisi->CurrentValue;
		$this->revisi->ViewCustomAttributes = "";

		// tgl_terbit
		$this->tgl_terbit->EditAttrs["class"] = "form-control";
		$this->tgl_terbit->EditCustomAttributes = "";
		$this->tgl_terbit->EditValue = FormatDateTime($this->tgl_terbit->CurrentValue, 8);
		$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

		// deskripsi_singkat
		$this->deskripsi_singkat->EditAttrs["class"] = "form-control";
		$this->deskripsi_singkat->EditCustomAttributes = "";
		$this->deskripsi_singkat->EditValue = $this->deskripsi_singkat->CurrentValue;
		$this->deskripsi_singkat->PlaceHolder = RemoveHtml($this->deskripsi_singkat->caption());

		// tujuan
		$this->tujuan->EditAttrs["class"] = "form-control";
		$this->tujuan->EditCustomAttributes = "";
		$this->tujuan->EditValue = $this->tujuan->CurrentValue;
		$this->tujuan->PlaceHolder = RemoveHtml($this->tujuan->caption());

		// target_peserta
		$this->target_peserta->EditAttrs["class"] = "form-control";
		$this->target_peserta->EditCustomAttributes = "";
		$this->target_peserta->EditValue = $this->target_peserta->CurrentValue;
		$this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

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

		// catatan
		$this->catatan->EditAttrs["class"] = "form-control";
		$this->catatan->EditCustomAttributes = "";
		$this->catatan->EditValue = $this->catatan->CurrentValue;
		$this->catatan->PlaceHolder = RemoveHtml($this->catatan->caption());

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
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->tgl_terbit);
					$doc->exportCaption($this->deskripsi_singkat);
					$doc->exportCaption($this->tujuan);
					$doc->exportCaption($this->target_peserta);
					$doc->exportCaption($this->lama_pelatihan);
					$doc->exportCaption($this->catatan);
				} else {
					$doc->exportCaption($this->singbagian);
					$doc->exportCaption($this->jpel);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->tgl_terbit);
					$doc->exportCaption($this->deskripsi_singkat);
					$doc->exportCaption($this->tujuan);
					$doc->exportCaption($this->target_peserta);
					$doc->exportCaption($this->lama_pelatihan);
					$doc->exportCaption($this->catatan);
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
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->revisi);
						$doc->exportField($this->tgl_terbit);
						$doc->exportField($this->deskripsi_singkat);
						$doc->exportField($this->tujuan);
						$doc->exportField($this->target_peserta);
						$doc->exportField($this->lama_pelatihan);
						$doc->exportField($this->catatan);
					} else {
						$doc->exportField($this->singbagian);
						$doc->exportField($this->jpel);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->revisi);
						$doc->exportField($this->tgl_terbit);
						$doc->exportField($this->deskripsi_singkat);
						$doc->exportField($this->tujuan);
						$doc->exportField($this->target_peserta);
						$doc->exportField($this->lama_pelatihan);
						$doc->exportField($this->catatan);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
//				$this->Row_Export($recordset->fields);
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
		$table = 't_juduldetail';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_juduldetail';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['detailjdid'];

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
		$table = 't_juduldetail';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['detailjdid'];

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
		$table = 't_juduldetail';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['detailjdid'];

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

		if(empty($rsnew["singbagian"]) || empty($rsnew["jpel"]) || empty($rsnew["kdjudul"]) || empty($rsnew["lama_pelatihan"])){
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

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>