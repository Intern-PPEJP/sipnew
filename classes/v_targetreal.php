<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for v_targetreal
 */
class v_targetreal extends DbTable
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
	public $kdprop;
	public $targetpes;
	public $durasi;
	public $real_peserta;
	public $c_angk;
	public $tawal;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'v_targetreal';
		$this->TableName = 'v_targetreal';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`v_targetreal`";
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

		// idpelat
		$this->idpelat = new DbField('v_targetreal', 'v_targetreal', 'x_idpelat', 'idpelat', '`idpelat`', '`idpelat`', 3, 11, -1, FALSE, '`idpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idpelat->IsPrimaryKey = TRUE; // Primary key field
		$this->idpelat->Nullable = FALSE; // NOT NULL field
		$this->idpelat->Sortable = TRUE; // Allow sort
		$this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idpelat'] = &$this->idpelat;

		// kdpelat
		$this->kdpelat = new DbField('v_targetreal', 'v_targetreal', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 20, -1, FALSE, '`kdpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpelat->Nullable = FALSE; // NOT NULL field
		$this->kdpelat->Required = TRUE; // Required field
		$this->kdpelat->Sortable = TRUE; // Allow sort
		$this->fields['kdpelat'] = &$this->kdpelat;

		// kdjudul
		$this->kdjudul = new DbField('v_targetreal', 'v_targetreal', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// kdprop
		$this->kdprop = new DbField('v_targetreal', 'v_targetreal', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, FALSE, '`kdprop`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdprop->Sortable = TRUE; // Allow sort
		$this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop'] = &$this->kdprop;

		// targetpes
		$this->targetpes = new DbField('v_targetreal', 'v_targetreal', 'x_targetpes', 'targetpes', '`targetpes`', '`targetpes`', 131, 32, -1, FALSE, '`targetpes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes->Sortable = TRUE; // Allow sort
		$this->targetpes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes'] = &$this->targetpes;

		// durasi
		$this->durasi = new DbField('v_targetreal', 'v_targetreal', 'x_durasi', 'durasi', '`durasi`', '`durasi`', 131, 32, -1, FALSE, '`durasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->durasi->Sortable = TRUE; // Allow sort
		$this->durasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['durasi'] = &$this->durasi;

		// real_peserta
		$this->real_peserta = new DbField('v_targetreal', 'v_targetreal', 'x_real_peserta', 'real_peserta', '`real_peserta`', '`real_peserta`', 131, 32, -1, FALSE, '`real_peserta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->real_peserta->Sortable = TRUE; // Allow sort
		$this->real_peserta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['real_peserta'] = &$this->real_peserta;

		// c_angk
		$this->c_angk = new DbField('v_targetreal', 'v_targetreal', 'x_c_angk', 'c_angk', '`c_angk`', '`c_angk`', 20, 21, -1, FALSE, '`c_angk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->c_angk->Nullable = FALSE; // NOT NULL field
		$this->c_angk->Required = TRUE; // Required field
		$this->c_angk->Sortable = TRUE; // Allow sort
		$this->c_angk->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['c_angk'] = &$this->c_angk;

		// tawal
		$this->tawal = new DbField('v_targetreal', 'v_targetreal', 'x_tawal', 'tawal', '`tawal`', CastDateFieldForLike("`tawal`", 0, "DB"), 135, 19, 0, FALSE, '`tawal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tawal->Sortable = TRUE; // Allow sort
		$this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tawal'] = &$this->tawal;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_targetreal`";
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
			"SELECT *, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `v_targetreal`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `v_targetreal`" .
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
		$this->kdprop->DbValue = $row['kdprop'];
		$this->targetpes->DbValue = $row['targetpes'];
		$this->durasi->DbValue = $row['durasi'];
		$this->real_peserta->DbValue = $row['real_peserta'];
		$this->c_angk->DbValue = $row['c_angk'];
		$this->tawal->DbValue = $row['tawal'];
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
			return "v_targetreallist.php";
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
		if ($pageName == "v_targetrealview.php")
			return $Language->phrase("View");
		elseif ($pageName == "v_targetrealedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "v_targetrealadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "v_targetreallist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("v_targetrealview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("v_targetrealview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "v_targetrealadd.php?" . $this->getUrlParm($parm);
		else
			$url = "v_targetrealadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("v_targetrealedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("v_targetrealadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("v_targetrealdelete.php", $this->getUrlParm());
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
		$this->idpelat->setDbValue($rs->fields('idpelat'));
		$this->kdpelat->setDbValue($rs->fields('kdpelat'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->kdprop->setDbValue($rs->fields('kdprop'));
		$this->targetpes->setDbValue($rs->fields('targetpes'));
		$this->durasi->setDbValue($rs->fields('durasi'));
		$this->real_peserta->setDbValue($rs->fields('real_peserta'));
		$this->c_angk->setDbValue($rs->fields('c_angk'));
		$this->tawal->setDbValue($rs->fields('tawal'));
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
		// kdprop
		// targetpes
		// durasi
		// real_peserta
		// c_angk
		// tawal
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

		// kdprop
		$this->kdprop->ViewValue = $this->kdprop->CurrentValue;
		$this->kdprop->ViewCustomAttributes = "";

		// targetpes
		$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
		$this->targetpes->ViewValue = FormatNumber($this->targetpes->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->targetpes->ViewCustomAttributes = "";

		// durasi
		$this->durasi->ViewValue = $this->durasi->CurrentValue;
		$this->durasi->ViewValue = FormatNumber($this->durasi->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->durasi->ViewCustomAttributes = "";

		// real_peserta
		$this->real_peserta->ViewValue = $this->real_peserta->CurrentValue;
		$this->real_peserta->ViewValue = FormatNumber($this->real_peserta->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->real_peserta->ViewCustomAttributes = "";

		// c_angk
		$this->c_angk->ViewValue = $this->c_angk->CurrentValue;
		$this->c_angk->ViewCustomAttributes = "";

		// tawal
		$this->tawal->ViewValue = $this->tawal->CurrentValue;
		$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
		$this->tawal->ViewCustomAttributes = "";

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

		// kdprop
		$this->kdprop->LinkCustomAttributes = "";
		$this->kdprop->HrefValue = "";
		$this->kdprop->TooltipValue = "";

		// targetpes
		$this->targetpes->LinkCustomAttributes = "";
		$this->targetpes->HrefValue = "";
		$this->targetpes->TooltipValue = "";

		// durasi
		$this->durasi->LinkCustomAttributes = "";
		$this->durasi->HrefValue = "";
		$this->durasi->TooltipValue = "";

		// real_peserta
		$this->real_peserta->LinkCustomAttributes = "";
		$this->real_peserta->HrefValue = "";
		$this->real_peserta->TooltipValue = "";

		// c_angk
		$this->c_angk->LinkCustomAttributes = "";
		$this->c_angk->HrefValue = "";
		$this->c_angk->TooltipValue = "";

		// tawal
		$this->tawal->LinkCustomAttributes = "";
		$this->tawal->HrefValue = "";
		$this->tawal->TooltipValue = "";

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
		$this->idpelat->PlaceHolder = RemoveHtml($this->idpelat->caption());

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

		// kdprop
		$this->kdprop->EditAttrs["class"] = "form-control";
		$this->kdprop->EditCustomAttributes = "";
		$this->kdprop->EditValue = $this->kdprop->CurrentValue;
		$this->kdprop->PlaceHolder = RemoveHtml($this->kdprop->caption());

		// targetpes
		$this->targetpes->EditAttrs["class"] = "form-control";
		$this->targetpes->EditCustomAttributes = "";
		$this->targetpes->EditValue = $this->targetpes->CurrentValue;
		$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());
		if (strval($this->targetpes->EditValue) != "" && is_numeric($this->targetpes->EditValue))
			$this->targetpes->EditValue = FormatNumber($this->targetpes->EditValue, -2, -1, -2, 0);
		

		// durasi
		$this->durasi->EditAttrs["class"] = "form-control";
		$this->durasi->EditCustomAttributes = "";
		$this->durasi->EditValue = $this->durasi->CurrentValue;
		$this->durasi->PlaceHolder = RemoveHtml($this->durasi->caption());
		if (strval($this->durasi->EditValue) != "" && is_numeric($this->durasi->EditValue))
			$this->durasi->EditValue = FormatNumber($this->durasi->EditValue, -2, -1, -2, 0);
		

		// real_peserta
		$this->real_peserta->EditAttrs["class"] = "form-control";
		$this->real_peserta->EditCustomAttributes = "";
		$this->real_peserta->EditValue = $this->real_peserta->CurrentValue;
		$this->real_peserta->PlaceHolder = RemoveHtml($this->real_peserta->caption());
		if (strval($this->real_peserta->EditValue) != "" && is_numeric($this->real_peserta->EditValue))
			$this->real_peserta->EditValue = FormatNumber($this->real_peserta->EditValue, -2, -1, -2, 0);
		

		// c_angk
		$this->c_angk->EditAttrs["class"] = "form-control";
		$this->c_angk->EditCustomAttributes = "";
		$this->c_angk->EditValue = $this->c_angk->CurrentValue;
		$this->c_angk->PlaceHolder = RemoveHtml($this->c_angk->caption());

		// tawal
		$this->tawal->EditAttrs["class"] = "form-control";
		$this->tawal->EditCustomAttributes = "";
		$this->tawal->EditValue = FormatDateTime($this->tawal->CurrentValue, 8);
		$this->tawal->PlaceHolder = RemoveHtml($this->tawal->caption());

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
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->targetpes);
					$doc->exportCaption($this->durasi);
					$doc->exportCaption($this->real_peserta);
					$doc->exportCaption($this->c_angk);
					$doc->exportCaption($this->tawal);
				} else {
					$doc->exportCaption($this->idpelat);
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->targetpes);
					$doc->exportCaption($this->durasi);
					$doc->exportCaption($this->real_peserta);
					$doc->exportCaption($this->c_angk);
					$doc->exportCaption($this->tawal);
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
						$doc->exportField($this->kdprop);
						$doc->exportField($this->targetpes);
						$doc->exportField($this->durasi);
						$doc->exportField($this->real_peserta);
						$doc->exportField($this->c_angk);
						$doc->exportField($this->tawal);
					} else {
						$doc->exportField($this->idpelat);
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->targetpes);
						$doc->exportField($this->durasi);
						$doc->exportField($this->real_peserta);
						$doc->exportField($this->c_angk);
						$doc->exportField($this->tawal);
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
		if(@$_GET["bulan"] == @$_GET["bulan2"]){
			$caribulan = " AND month(tawal) = '".@$_GET["bulan"]."'";
		} else {
			$caribulan = " AND (month(tawal) >= ".@$_GET["bulan"]." AND month(tawal) <= ".@$_GET["bulan2"].")";
		}
		AddFilter($filter, "YEAR(tawal) = ".@$_GET["tahun"].$caribulan); 
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

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>