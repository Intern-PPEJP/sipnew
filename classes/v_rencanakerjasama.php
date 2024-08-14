<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for v_rencanakerjasama
 */
class v_rencanakerjasama extends DbTable
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
	public $kerjasama;
	public $jenispel;
	public $kdjudul;
	public $jml_hari;
	public $dana;
	public $angkatan;
	public $targetpes;
	public $kontak_person;
	public $rpkid;
	public $tahun_rencana;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'v_rencanakerjasama';
		$this->TableName = 'v_rencanakerjasama';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`v_rencanakerjasama`";
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

		// kerjasama
		$this->kerjasama = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_kerjasama', 'kerjasama', '`kerjasama`', '`kerjasama`', 3, 11, -1, FALSE, '`kerjasama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kerjasama->Required = TRUE; // Required field
		$this->kerjasama->Sortable = TRUE; // Allow sort
		$this->kerjasama->Lookup = new Lookup('kerjasama', 't_perusahaan', FALSE, 'idp', ["namap","","",""], [], [], [], [], [], [], '`namap` ASC', '');
		$this->kerjasama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kerjasama'] = &$this->kerjasama;

		// jenispel
		$this->jenispel = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_jenispel', 'jenispel', '`jenispel`', '`jenispel`', 16, 2, -1, FALSE, '`jenispel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenispel->Required = TRUE; // Required field
		$this->jenispel->Sortable = TRUE; // Allow sort
		$this->jenispel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenispel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenispel->Lookup = new Lookup('jenispel', 'v_rencanakerjasama', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenispel->OptionCount = 10;
		$this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenispel'] = &$this->jenispel;

		// kdjudul
		$this->kdjudul = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// jml_hari
		$this->jml_hari = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_jml_hari', 'jml_hari', '`jml_hari`', '`jml_hari`', 131, 32, -1, FALSE, '`jml_hari`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_hari->Required = TRUE; // Required field
		$this->jml_hari->Sortable = TRUE; // Allow sort
		$this->jml_hari->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jml_hari'] = &$this->jml_hari;

		// dana
		$this->dana = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_dana', 'dana', '`dana`', '`dana`', 131, 15, -1, FALSE, '`dana`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dana->Nullable = FALSE; // NOT NULL field
		$this->dana->Required = TRUE; // Required field
		$this->dana->Sortable = TRUE; // Allow sort
		$this->dana->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['dana'] = &$this->dana;

		// angkatan
		$this->angkatan = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_angkatan', 'angkatan', '`angkatan`', '`angkatan`', 3, 3, -1, FALSE, '`angkatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->angkatan->Required = TRUE; // Required field
		$this->angkatan->Sortable = TRUE; // Allow sort
		$this->angkatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['angkatan'] = &$this->angkatan;

		// targetpes
		$this->targetpes = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_targetpes', 'targetpes', '`targetpes`', '`targetpes`', 3, 3, -1, FALSE, '`targetpes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes->Required = TRUE; // Required field
		$this->targetpes->Sortable = TRUE; // Allow sort
		$this->targetpes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes'] = &$this->targetpes;

		// kontak_person
		$this->kontak_person = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_kontak_person', 'kontak_person', '`kontak_person`', '`kontak_person`', 201, 65535, -1, FALSE, '`kontak_person`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->kontak_person->Sortable = TRUE; // Allow sort
		$this->fields['kontak_person'] = &$this->kontak_person;

		// rpkid
		$this->rpkid = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_rpkid', 'rpkid', '`rpkid`', '`rpkid`', 3, 11, -1, FALSE, '`rpkid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rpkid->Nullable = FALSE; // NOT NULL field
		$this->rpkid->Required = TRUE; // Required field
		$this->rpkid->Sortable = TRUE; // Allow sort
		$this->rpkid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rpkid'] = &$this->rpkid;

		// tahun_rencana
		$this->tahun_rencana = new DbField('v_rencanakerjasama', 'v_rencanakerjasama', 'x_tahun_rencana', 'tahun_rencana', '`tahun_rencana`', '`tahun_rencana`', 3, 4, -1, FALSE, '`tahun_rencana`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_rencanakerjasama`";
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
			"SELECT *, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `v_rencanakerjasama`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `v_rencanakerjasama`" .
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`tahun_rencana` DESC";
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
		$this->kerjasama->DbValue = $row['kerjasama'];
		$this->jenispel->DbValue = $row['jenispel'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->jml_hari->DbValue = $row['jml_hari'];
		$this->dana->DbValue = $row['dana'];
		$this->angkatan->DbValue = $row['angkatan'];
		$this->targetpes->DbValue = $row['targetpes'];
		$this->kontak_person->DbValue = $row['kontak_person'];
		$this->rpkid->DbValue = $row['rpkid'];
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
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "v_rencanakerjasamalist.php";
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
		if ($pageName == "v_rencanakerjasamaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "v_rencanakerjasamaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "v_rencanakerjasamaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "v_rencanakerjasamalist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("v_rencanakerjasamaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("v_rencanakerjasamaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "v_rencanakerjasamaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "v_rencanakerjasamaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("v_rencanakerjasamaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("v_rencanakerjasamaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("v_rencanakerjasamadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
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
		$this->kerjasama->setDbValue($rs->fields('kerjasama'));
		$this->jenispel->setDbValue($rs->fields('jenispel'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->jml_hari->setDbValue($rs->fields('jml_hari'));
		$this->dana->setDbValue($rs->fields('dana'));
		$this->angkatan->setDbValue($rs->fields('angkatan'));
		$this->targetpes->setDbValue($rs->fields('targetpes'));
		$this->kontak_person->setDbValue($rs->fields('kontak_person'));
		$this->rpkid->setDbValue($rs->fields('rpkid'));
		$this->tahun_rencana->setDbValue($rs->fields('tahun_rencana'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// kerjasama
		// jenispel
		// kdjudul
		// jml_hari
		// dana
		// angkatan
		// targetpes
		// kontak_person
		// rpkid
		// tahun_rencana
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

		// jenispel
		if (strval($this->jenispel->CurrentValue) != "") {
			$this->jenispel->ViewValue = $this->jenispel->optionCaption($this->jenispel->CurrentValue);
		} else {
			$this->jenispel->ViewValue = NULL;
		}
		$this->jenispel->ViewCustomAttributes = "";

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

		// jml_hari
		$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
		$this->jml_hari->ViewValue = FormatNumber($this->jml_hari->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->jml_hari->ViewCustomAttributes = "";

		// dana
		$this->dana->ViewValue = $this->dana->CurrentValue;
		$this->dana->ViewValue = FormatCurrency($this->dana->ViewValue, 0, -2, -2, -2);
		$this->dana->ViewCustomAttributes = "";

		// angkatan
		$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
		$this->angkatan->ViewCustomAttributes = "";

		// targetpes
		$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
		$this->targetpes->ViewCustomAttributes = "";

		// kontak_person
		$this->kontak_person->ViewValue = $this->kontak_person->CurrentValue;
		$this->kontak_person->ViewCustomAttributes = "";

		// rpkid
		$this->rpkid->ViewValue = $this->rpkid->CurrentValue;
		$this->rpkid->ViewCustomAttributes = "";

		// tahun_rencana
		$this->tahun_rencana->ViewValue = $this->tahun_rencana->CurrentValue;
		$this->tahun_rencana->ViewCustomAttributes = "";

		// kerjasama
		$this->kerjasama->LinkCustomAttributes = "";
		$this->kerjasama->HrefValue = "";
		$this->kerjasama->TooltipValue = "";

		// jenispel
		$this->jenispel->LinkCustomAttributes = "";
		$this->jenispel->HrefValue = "";
		$this->jenispel->TooltipValue = "";

		// kdjudul
		$this->kdjudul->LinkCustomAttributes = "";
		$this->kdjudul->HrefValue = "";
		$this->kdjudul->TooltipValue = "";

		// jml_hari
		$this->jml_hari->LinkCustomAttributes = "";
		$this->jml_hari->HrefValue = "";
		$this->jml_hari->TooltipValue = "";

		// dana
		$this->dana->LinkCustomAttributes = "";
		$this->dana->HrefValue = "";
		$this->dana->TooltipValue = "";

		// angkatan
		$this->angkatan->LinkCustomAttributes = "";
		$this->angkatan->HrefValue = "";
		$this->angkatan->TooltipValue = "";

		// targetpes
		$this->targetpes->LinkCustomAttributes = "";
		$this->targetpes->HrefValue = "";
		$this->targetpes->TooltipValue = "";

		// kontak_person
		$this->kontak_person->LinkCustomAttributes = "";
		$this->kontak_person->HrefValue = "";
		$this->kontak_person->TooltipValue = "";

		// rpkid
		$this->rpkid->LinkCustomAttributes = "";
		$this->rpkid->HrefValue = "";
		$this->rpkid->TooltipValue = "";

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

		// kerjasama
		$this->kerjasama->EditAttrs["class"] = "form-control";
		$this->kerjasama->EditCustomAttributes = "";
		$this->kerjasama->EditValue = $this->kerjasama->CurrentValue;
		$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

		// jenispel
		$this->jenispel->EditAttrs["class"] = "form-control";
		$this->jenispel->EditCustomAttributes = "";
		$this->jenispel->EditValue = $this->jenispel->options(TRUE);

		// kdjudul
		$this->kdjudul->EditAttrs["class"] = "form-control";
		$this->kdjudul->EditCustomAttributes = "";
		if (!$this->kdjudul->Raw)
			$this->kdjudul->CurrentValue = HtmlDecode($this->kdjudul->CurrentValue);
		$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
		$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

		// jml_hari
		$this->jml_hari->EditAttrs["class"] = "form-control";
		$this->jml_hari->EditCustomAttributes = "";
		$this->jml_hari->EditValue = $this->jml_hari->CurrentValue;
		$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());
		if (strval($this->jml_hari->EditValue) != "" && is_numeric($this->jml_hari->EditValue))
			$this->jml_hari->EditValue = FormatNumber($this->jml_hari->EditValue, -2, -1, -2, 0);
		

		// dana
		$this->dana->EditAttrs["class"] = "form-control";
		$this->dana->EditCustomAttributes = "";
		$this->dana->EditValue = $this->dana->CurrentValue;
		$this->dana->PlaceHolder = RemoveHtml($this->dana->caption());
		if (strval($this->dana->EditValue) != "" && is_numeric($this->dana->EditValue))
			$this->dana->EditValue = FormatNumber($this->dana->EditValue, -2, -2, -2, -2);
		

		// angkatan
		$this->angkatan->EditAttrs["class"] = "form-control";
		$this->angkatan->EditCustomAttributes = "";
		$this->angkatan->EditValue = $this->angkatan->CurrentValue;
		$this->angkatan->PlaceHolder = RemoveHtml($this->angkatan->caption());

		// targetpes
		$this->targetpes->EditAttrs["class"] = "form-control";
		$this->targetpes->EditCustomAttributes = "";
		$this->targetpes->EditValue = $this->targetpes->CurrentValue;
		$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

		// kontak_person
		$this->kontak_person->EditAttrs["class"] = "form-control";
		$this->kontak_person->EditCustomAttributes = "";
		$this->kontak_person->EditValue = $this->kontak_person->CurrentValue;
		$this->kontak_person->PlaceHolder = RemoveHtml($this->kontak_person->caption());

		// rpkid
		$this->rpkid->EditAttrs["class"] = "form-control";
		$this->rpkid->EditCustomAttributes = "";
		$this->rpkid->EditValue = $this->rpkid->CurrentValue;
		$this->rpkid->PlaceHolder = RemoveHtml($this->rpkid->caption());

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
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->jml_hari);
					$doc->exportCaption($this->dana);
					$doc->exportCaption($this->angkatan);
					$doc->exportCaption($this->targetpes);
					$doc->exportCaption($this->kontak_person);
					$doc->exportCaption($this->rpkid);
					$doc->exportCaption($this->tahun_rencana);
				} else {
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->jml_hari);
					$doc->exportCaption($this->dana);
					$doc->exportCaption($this->angkatan);
					$doc->exportCaption($this->targetpes);
					$doc->exportCaption($this->kontak_person);
					$doc->exportCaption($this->rpkid);
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

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->jml_hari);
						$doc->exportField($this->dana);
						$doc->exportField($this->angkatan);
						$doc->exportField($this->targetpes);
						$doc->exportField($this->kontak_person);
						$doc->exportField($this->rpkid);
						$doc->exportField($this->tahun_rencana);
					} else {
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->jml_hari);
						$doc->exportField($this->dana);
						$doc->exportField($this->angkatan);
						$doc->exportField($this->targetpes);
						$doc->exportField($this->kontak_person);
						$doc->exportField($this->rpkid);
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
		if($this->tahun_rencana->AdvancedSearch->SearchValue == "")
		$this->tahun_rencana->AdvancedSearch->SearchValue = date("Y"); // Search value
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

		if($this->Export == "excel"){
		if($this->kdjudul->ViewValue == ""){
			$this->kdjudul->ViewValue = $this->kerjasama->ViewValue;
		} else {
			$this->kdjudul->ViewValue = $this->kdjudul->ViewValue . " (". $this->kerjasama->ViewValue . ")";
		}
		}
		if($this->jml_hari->ViewValue == ""){
			$this->jml_hari->ViewValue = 0;
		}
		if($this->targetpes->ViewValue == ""){
			$this->targetpes->ViewValue = 0;
		}
		$cek_angkatan = ExecuteScalar("SELECT COUNT(1) FROM t_pelatihan WHERE rid = '".$this->rpkid->CurrentValue."' AND jenispel = '".$this->jenispel->CurrentValue."' AND kdjudul = '".$this->kdjudul->CurrentValue."'");
		if($cek_angkatan > 0){

			//$targetpes = ExecuteScalar("SELECT targetpes FROM t_pelatihan WHERE rid = '".$this->rpkid->CurrentValue."' AND jenispel = '".$this->jenispel->CurrentValue."' AND kdjudul = '".$this->kdjudul->CurrentValue."'");
			//$this->targetpes->ViewValue = $targetpes;
			//$this->angkatan->ViewValue = $cek_angkatan;

		}
		$this->dana->ViewValue = str_replace(",", ".", FormatCurrency($this->dana->CurrentValue, 0, -2, -2, -2));
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>