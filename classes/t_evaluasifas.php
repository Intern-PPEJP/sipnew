<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_evaluasifas
 */
class t_evaluasifas extends DbTable
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
	public $evafas_id;
	public $bioid;
	public $idpelat;
	public $kurikulumid;
	public $nilai;
	public $komentar;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_evaluasifas';
		$this->TableName = 't_evaluasifas';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_evaluasifas`";
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

		// evafas_id
		$this->evafas_id = new DbField('t_evaluasifas', 't_evaluasifas', 'x_evafas_id', 'evafas_id', '`evafas_id`', '`evafas_id`', 3, 11, -1, FALSE, '`evafas_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->evafas_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->evafas_id->IsPrimaryKey = TRUE; // Primary key field
		$this->evafas_id->Sortable = TRUE; // Allow sort
		$this->evafas_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['evafas_id'] = &$this->evafas_id;

		// bioid
		$this->bioid = new DbField('t_evaluasifas', 't_evaluasifas', 'x_bioid', 'bioid', '`bioid`', '`bioid`', 3, 11, -1, FALSE, '`bioid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bioid->IsForeignKey = TRUE; // Foreign key field
		$this->bioid->Nullable = FALSE; // NOT NULL field
		$this->bioid->Required = TRUE; // Required field
		$this->bioid->Sortable = TRUE; // Allow sort
		$this->bioid->Lookup = new Lookup('bioid', 't_biointruktur', FALSE, 'bioid', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->bioid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bioid'] = &$this->bioid;

		// idpelat
		$this->idpelat = new DbField('t_evaluasifas', 't_evaluasifas', 'x_idpelat', 'idpelat', '`idpelat`', '`idpelat`', 3, 11, -1, FALSE, '`idpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->idpelat->IsForeignKey = TRUE; // Foreign key field
		$this->idpelat->Nullable = FALSE; // NOT NULL field
		$this->idpelat->Required = TRUE; // Required field
		$this->idpelat->Sortable = TRUE; // Allow sort
		$this->idpelat->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->idpelat->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->idpelat->Lookup = new Lookup('idpelat', 'v_japel', TRUE, 'idpelat', ["judul","tawal","takhir","kota"], [], ["t_evaluasifas x_kurikulumid"], [], [], [], [], '`tawal` ASC', '');
		$this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idpelat'] = &$this->idpelat;

		// kurikulumid
		$this->kurikulumid = new DbField('t_evaluasifas', 't_evaluasifas', 'x_kurikulumid', 'kurikulumid', '`kurikulumid`', '`kurikulumid`', 3, 11, -1, FALSE, '`kurikulumid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kurikulumid->IsForeignKey = TRUE; // Foreign key field
		$this->kurikulumid->Nullable = FALSE; // NOT NULL field
		$this->kurikulumid->Required = TRUE; // Required field
		$this->kurikulumid->Sortable = TRUE; // Allow sort
		$this->kurikulumid->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kurikulumid->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kurikulumid->Lookup = new Lookup('kurikulumid', 'v_japel', TRUE, 'kurikulumid', ["kurikulum","","",""], ["t_evaluasifas x_idpelat"], [], ["idpelat"], ["x_idpelat"], [], [], '', '');
		$this->kurikulumid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kurikulumid'] = &$this->kurikulumid;

		// nilai
		$this->nilai = new DbField('t_evaluasifas', 't_evaluasifas', 'x_nilai', 'nilai', '`nilai`', '`nilai`', 131, 5, -1, FALSE, '`nilai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nilai->Required = TRUE; // Required field
		$this->nilai->Sortable = TRUE; // Allow sort
		$this->nilai->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['nilai'] = &$this->nilai;

		// komentar
		$this->komentar = new DbField('t_evaluasifas', 't_evaluasifas', 'x_komentar', 'komentar', '`komentar`', '`komentar`', 201, 65535, -1, FALSE, '`komentar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->komentar->Sortable = TRUE; // Allow sort
		$this->fields['komentar'] = &$this->komentar;
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
		if ($this->getCurrentMasterTable() == "t_biointruktur") {
			if ($this->bioid->getSessionValue() != "")
				$masterFilter .= "`bioid`=" . QuotedValue($this->bioid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "cv_jp") {
			if ($this->bioid->getSessionValue() != "")
				$masterFilter .= "t_jadwalpel.instruktur=" . QuotedValue($this->bioid->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->idpelat->getSessionValue() != "")
				$masterFilter .= " AND t_jadwalpel.idpelat=" . QuotedValue($this->idpelat->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->kurikulumid->getSessionValue() != "")
				$masterFilter .= " AND t_jadwalpel.kurikulumid=" . QuotedValue($this->kurikulumid->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "t_biointruktur") {
			if ($this->bioid->getSessionValue() != "")
				$detailFilter .= "`bioid`=" . QuotedValue($this->bioid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "cv_jp") {
			if ($this->bioid->getSessionValue() != "")
				$detailFilter .= "`bioid`=" . QuotedValue($this->bioid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->idpelat->getSessionValue() != "")
				$detailFilter .= " AND `idpelat`=" . QuotedValue($this->idpelat->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->kurikulumid->getSessionValue() != "")
				$detailFilter .= " AND `kurikulumid`=" . QuotedValue($this->kurikulumid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_t_biointruktur()
	{
		return "`bioid`=@bioid@";
	}

	// Detail filter
	public function sqlDetailFilter_t_biointruktur()
	{
		return "`bioid`=@bioid@";
	}

	// Master filter
	public function sqlMasterFilter_cv_jp()
	{
		return "t_jadwalpel.instruktur='@bioid@' AND t_jadwalpel.idpelat=@idpelat@ AND t_jadwalpel.kurikulumid=@kurikulumid@";
	}

	// Detail filter
	public function sqlDetailFilter_cv_jp()
	{
		return "`bioid`=@bioid@ AND `idpelat`=@idpelat@ AND `kurikulumid`=@kurikulumid@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_evaluasifas`";
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
			$this->evafas_id->setDbValue($conn->insert_ID());
			$rs['evafas_id'] = $this->evafas_id->DbValue;
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
			$fldname = 'evafas_id';
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
			if (array_key_exists('evafas_id', $rs))
				AddFilter($where, QuotedName('evafas_id', $this->Dbid) . '=' . QuotedValue($rs['evafas_id'], $this->evafas_id->DataType, $this->Dbid));
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
		$this->evafas_id->DbValue = $row['evafas_id'];
		$this->bioid->DbValue = $row['bioid'];
		$this->idpelat->DbValue = $row['idpelat'];
		$this->kurikulumid->DbValue = $row['kurikulumid'];
		$this->nilai->DbValue = $row['nilai'];
		$this->komentar->DbValue = $row['komentar'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`evafas_id` = @evafas_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('evafas_id', $row) ? $row['evafas_id'] : NULL;
		else
			$val = $this->evafas_id->OldValue !== NULL ? $this->evafas_id->OldValue : $this->evafas_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@evafas_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_evaluasifaslist.php";
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
		if ($pageName == "t_evaluasifasview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_evaluasifasedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_evaluasifasadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_evaluasifaslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_evaluasifasview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_evaluasifasview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_evaluasifasadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_evaluasifasadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_evaluasifasedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("t_evaluasifasadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("t_evaluasifasdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "t_biointruktur" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_bioid=" . urlencode($this->bioid->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "cv_jp" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_bioid=" . urlencode($this->bioid->CurrentValue);
			$url .= "&fk_idpelat=" . urlencode($this->idpelat->CurrentValue);
			$url .= "&fk_kurikulumid=" . urlencode($this->kurikulumid->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "evafas_id:" . JsonEncode($this->evafas_id->CurrentValue, "number");
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
		if ($this->evafas_id->CurrentValue != NULL) {
			$url .= "evafas_id=" . urlencode($this->evafas_id->CurrentValue);
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
			if (Param("evafas_id") !== NULL)
				$arKeys[] = Param("evafas_id");
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
				$this->evafas_id->CurrentValue = $key;
			else
				$this->evafas_id->OldValue = $key;
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
		$this->evafas_id->setDbValue($rs->fields('evafas_id'));
		$this->bioid->setDbValue($rs->fields('bioid'));
		$this->idpelat->setDbValue($rs->fields('idpelat'));
		$this->kurikulumid->setDbValue($rs->fields('kurikulumid'));
		$this->nilai->setDbValue($rs->fields('nilai'));
		$this->komentar->setDbValue($rs->fields('komentar'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// evafas_id

		$this->evafas_id->CellCssStyle = "white-space: nowrap;";

		// bioid
		// idpelat
		// kurikulumid
		// nilai
		// komentar
		// evafas_id

		$this->evafas_id->ViewValue = $this->evafas_id->CurrentValue;
		$this->evafas_id->ViewCustomAttributes = "";

		// bioid
		$this->bioid->ViewValue = $this->bioid->CurrentValue;
		$curVal = strval($this->bioid->CurrentValue);
		if ($curVal != "") {
			$this->bioid->ViewValue = $this->bioid->lookupCacheOption($curVal);
			if ($this->bioid->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`bioid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->bioid->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->bioid->ViewValue = $this->bioid->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->bioid->ViewValue = $this->bioid->CurrentValue;
				}
			}
		} else {
			$this->bioid->ViewValue = NULL;
		}
		$this->bioid->ViewCustomAttributes = "";

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
					$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 0);
					$arwrk[3] = FormatDateTime($rswrk->fields('df3'), 0);
					$arwrk[4] = $rswrk->fields('df4');
					$this->idpelat->ViewValue = $this->idpelat->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
				}
			}
		} else {
			$this->idpelat->ViewValue = NULL;
		}
		$this->idpelat->ViewCustomAttributes = "width='200px'";

		// kurikulumid
		$curVal = strval($this->kurikulumid->CurrentValue);
		if ($curVal != "") {
			$this->kurikulumid->ViewValue = $this->kurikulumid->lookupCacheOption($curVal);
			if ($this->kurikulumid->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kurikulumid->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kurikulumid->ViewValue = $this->kurikulumid->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kurikulumid->ViewValue = $this->kurikulumid->CurrentValue;
				}
			}
		} else {
			$this->kurikulumid->ViewValue = NULL;
		}
		$this->kurikulumid->ViewCustomAttributes = "";

		// nilai
		$this->nilai->ViewValue = $this->nilai->CurrentValue;
		$this->nilai->ViewValue = FormatNumber($this->nilai->ViewValue, 2, -2, -2, -2);
		$this->nilai->ViewCustomAttributes = "";

		// komentar
		$this->komentar->ViewValue = $this->komentar->CurrentValue;
		$this->komentar->ViewCustomAttributes = "";

		// evafas_id
		$this->evafas_id->LinkCustomAttributes = "";
		$this->evafas_id->HrefValue = "";
		$this->evafas_id->TooltipValue = "";

		// bioid
		$this->bioid->LinkCustomAttributes = "";
		$this->bioid->HrefValue = "";
		$this->bioid->TooltipValue = "";

		// idpelat
		$this->idpelat->LinkCustomAttributes = "";
		$this->idpelat->HrefValue = "";
		$this->idpelat->TooltipValue = "";

		// kurikulumid
		$this->kurikulumid->LinkCustomAttributes = "";
		$this->kurikulumid->HrefValue = "";
		$this->kurikulumid->TooltipValue = "";

		// nilai
		$this->nilai->LinkCustomAttributes = "";
		$this->nilai->HrefValue = "";
		$this->nilai->TooltipValue = "";

		// komentar
		$this->komentar->LinkCustomAttributes = "";
		$this->komentar->HrefValue = "";
		$this->komentar->TooltipValue = "";

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

		// evafas_id
		$this->evafas_id->EditAttrs["class"] = "form-control";
		$this->evafas_id->EditCustomAttributes = "";
		$this->evafas_id->EditValue = $this->evafas_id->CurrentValue;
		$this->evafas_id->ViewCustomAttributes = "";

		// bioid
		$this->bioid->EditAttrs["class"] = "form-control";
		$this->bioid->EditCustomAttributes = "";
		if ($this->bioid->getSessionValue() != "") {
			$this->bioid->CurrentValue = $this->bioid->getSessionValue();
			$this->bioid->ViewValue = $this->bioid->CurrentValue;
			$curVal = strval($this->bioid->CurrentValue);
			if ($curVal != "") {
				$this->bioid->ViewValue = $this->bioid->lookupCacheOption($curVal);
				if ($this->bioid->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`bioid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->bioid->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->bioid->ViewValue = $this->bioid->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->bioid->ViewValue = $this->bioid->CurrentValue;
					}
				}
			} else {
				$this->bioid->ViewValue = NULL;
			}
			$this->bioid->ViewCustomAttributes = "";
		} else {
			$this->bioid->EditValue = $this->bioid->CurrentValue;
			$this->bioid->PlaceHolder = RemoveHtml($this->bioid->caption());
		}

		// idpelat
		$this->idpelat->EditAttrs["class"] = "form-control";
		$this->idpelat->EditCustomAttributes = "width='100px'";
		if ($this->idpelat->getSessionValue() != "") {
			$this->idpelat->CurrentValue = $this->idpelat->getSessionValue();
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
						$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 0);
						$arwrk[3] = FormatDateTime($rswrk->fields('df3'), 0);
						$arwrk[4] = $rswrk->fields('df4');
						$this->idpelat->ViewValue = $this->idpelat->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
					}
				}
			} else {
				$this->idpelat->ViewValue = NULL;
			}
			$this->idpelat->ViewCustomAttributes = "width='200px'";
		} else {
		}

		// kurikulumid
		$this->kurikulumid->EditAttrs["class"] = "form-control";
		$this->kurikulumid->EditCustomAttributes = "";
		if ($this->kurikulumid->getSessionValue() != "") {
			$this->kurikulumid->CurrentValue = $this->kurikulumid->getSessionValue();
			$curVal = strval($this->kurikulumid->CurrentValue);
			if ($curVal != "") {
				$this->kurikulumid->ViewValue = $this->kurikulumid->lookupCacheOption($curVal);
				if ($this->kurikulumid->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kurikulumid->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kurikulumid->ViewValue = $this->kurikulumid->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kurikulumid->ViewValue = $this->kurikulumid->CurrentValue;
					}
				}
			} else {
				$this->kurikulumid->ViewValue = NULL;
			}
			$this->kurikulumid->ViewCustomAttributes = "";
		} else {
		}

		// nilai
		$this->nilai->EditAttrs["class"] = "form-control";
		$this->nilai->EditCustomAttributes = "";
		$this->nilai->EditValue = $this->nilai->CurrentValue;
		$this->nilai->PlaceHolder = RemoveHtml($this->nilai->caption());
		if (strval($this->nilai->EditValue) != "" && is_numeric($this->nilai->EditValue))
			$this->nilai->EditValue = FormatNumber($this->nilai->EditValue, -2, -2, -2, -2);
		

		// komentar
		$this->komentar->EditAttrs["class"] = "form-control";
		$this->komentar->EditCustomAttributes = "";
		$this->komentar->EditValue = $this->komentar->CurrentValue;
		$this->komentar->PlaceHolder = RemoveHtml($this->komentar->caption());

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
					$doc->exportCaption($this->bioid);
					$doc->exportCaption($this->idpelat);
					$doc->exportCaption($this->kurikulumid);
					$doc->exportCaption($this->nilai);
					$doc->exportCaption($this->komentar);
				} else {
					$doc->exportCaption($this->bioid);
					$doc->exportCaption($this->idpelat);
					$doc->exportCaption($this->kurikulumid);
					$doc->exportCaption($this->nilai);
					$doc->exportCaption($this->komentar);
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
						$doc->exportField($this->bioid);
						$doc->exportField($this->idpelat);
						$doc->exportField($this->kurikulumid);
						$doc->exportField($this->nilai);
						$doc->exportField($this->komentar);
					} else {
						$doc->exportField($this->bioid);
						$doc->exportField($this->idpelat);
						$doc->exportField($this->kurikulumid);
						$doc->exportField($this->nilai);
						$doc->exportField($this->komentar);
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
		$table = 't_evaluasifas';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_evaluasifas';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['evafas_id'];

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
		$table = 't_evaluasifas';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['evafas_id'];

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
		$table = 't_evaluasifas';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['evafas_id'];

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

		if(isset($_GET[config("TABLE_SHOW_MASTER")]) <> "cv_jp"){
			if ($fld->Name == "idpelat")
				 AddFilter($filter, "instruktur = '".$GLOBALS["t_biointruktur"]->bioid->CurrentValue."'");
			if ($fld->Name == "kurikulumid")
				 AddFilter($filter, "instruktur = '".$GLOBALS["t_biointruktur"]->bioid->CurrentValue."'");
		} else {
			if ($fld->Name == "idpelat")
				 AddFilter($filter, "instruktur = '".$GLOBALS["cv_jp"]->bioid->CurrentValue."'");
			if ($fld->Name == "kurikulumid")
				 AddFilter($filter, "instruktur = '".$GLOBALS["cv_jp"]->bioid->CurrentValue."'");
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

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>