<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_pegawai
 */
class t_pegawai extends DbTable
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
	public $id_peg;
	public $nip;
	public $nama;
	public $bagian;
	public $created_at;
	public $user_created_by;
	public $updated_at;
	public $user_updated_by;
	public $jpelatihan;
	public $username;
	public $password;
	public $role;
	public $aktif;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_pegawai';
		$this->TableName = 't_pegawai';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_pegawai`";
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

		// id_peg
		$this->id_peg = new DbField('t_pegawai', 't_pegawai', 'x_id_peg', 'id_peg', '`id_peg`', '`id_peg`', 3, 11, -1, FALSE, '`id_peg`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_peg->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_peg->IsPrimaryKey = TRUE; // Primary key field
		$this->id_peg->Sortable = TRUE; // Allow sort
		$this->id_peg->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_peg'] = &$this->id_peg;

		// nip
		$this->nip = new DbField('t_pegawai', 't_pegawai', 'x_nip', 'nip', '`nip`', '`nip`', 200, 20, -1, FALSE, '`nip`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nip->Required = TRUE; // Required field
		$this->nip->Sortable = TRUE; // Allow sort
		$this->fields['nip'] = &$this->nip;

		// nama
		$this->nama = new DbField('t_pegawai', 't_pegawai', 'x_nama', 'nama', '`nama`', '`nama`', 200, 255, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// bagian
		$this->bagian = new DbField('t_pegawai', 't_pegawai', 'x_bagian', 'bagian', '`bagian`', '`bagian`', 3, 11, -1, FALSE, '`bagian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bagian->Required = TRUE; // Required field
		$this->bagian->Sortable = TRUE; // Allow sort
		$this->bagian->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bagian->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->bagian->Lookup = new Lookup('bagian', 't_bagian', FALSE, 'kdbagian', ["namabagian","","",""], [], [], [], [], [], [], '', '');
		$this->bagian->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bagian'] = &$this->bagian;

		// created_at
		$this->created_at = new DbField('t_pegawai', 't_pegawai', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// user_created_by
		$this->user_created_by = new DbField('t_pegawai', 't_pegawai', 'x_user_created_by', 'user_created_by', '`user_created_by`', '`user_created_by`', 200, 100, -1, FALSE, '`user_created_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_created_by->Sortable = TRUE; // Allow sort
		$this->fields['user_created_by'] = &$this->user_created_by;

		// updated_at
		$this->updated_at = new DbField('t_pegawai', 't_pegawai', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// user_updated_by
		$this->user_updated_by = new DbField('t_pegawai', 't_pegawai', 'x_user_updated_by', 'user_updated_by', '`user_updated_by`', '`user_updated_by`', 200, 100, -1, FALSE, '`user_updated_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_updated_by->Sortable = TRUE; // Allow sort
		$this->fields['user_updated_by'] = &$this->user_updated_by;

		// jpelatihan
		$this->jpelatihan = new DbField('t_pegawai', 't_pegawai', 'x_jpelatihan', 'jpelatihan', '(SELECT Count(1) FROM t_pelatihan a WHERE YEAR(a.tawal) = YEAR(CURDATE()) AND ((a.ketua = t_pegawai.id_peg) OR (a.bendahara = t_pegawai.id_peg) OR (a.sekretaris = t_pegawai.id_peg)))', '(SELECT Count(1) FROM t_pelatihan a WHERE YEAR(a.tawal) = YEAR(CURDATE()) AND ((a.ketua = t_pegawai.id_peg) OR (a.bendahara = t_pegawai.id_peg) OR (a.sekretaris = t_pegawai.id_peg)))', 20, 21, -1, FALSE, '(SELECT Count(1) FROM t_pelatihan a WHERE YEAR(a.tawal) = YEAR(CURDATE()) AND ((a.ketua = t_pegawai.id_peg) OR (a.bendahara = t_pegawai.id_peg) OR (a.sekretaris = t_pegawai.id_peg)))', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jpelatihan->IsCustom = TRUE; // Custom field
		$this->jpelatihan->Sortable = TRUE; // Allow sort
		$this->jpelatihan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jpelatihan'] = &$this->jpelatihan;

		// username
		$this->username = new DbField('t_pegawai', 't_pegawai', 'x_username', 'username', '`username`', '`username`', 200, 30, -1, FALSE, '`username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->username->Nullable = FALSE; // NOT NULL field
		$this->username->Required = TRUE; // Required field
		$this->username->Sortable = TRUE; // Allow sort
		$this->fields['username'] = &$this->username;

		// password
		$this->password = new DbField('t_pegawai', 't_pegawai', 'x_password', 'password', '`password`', '`password`', 200, 50, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'PASSWORD');
		$this->password->Nullable = FALSE; // NOT NULL field
		$this->password->Required = TRUE; // Required field
		$this->password->Sortable = TRUE; // Allow sort
		$this->fields['password'] = &$this->password;

		// role
		$this->role = new DbField('t_pegawai', 't_pegawai', 'x_role', 'role', '`role`', '`role`', 16, 2, -1, FALSE, '`role`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->role->Nullable = FALSE; // NOT NULL field
		$this->role->Required = TRUE; // Required field
		$this->role->Sortable = TRUE; // Allow sort
		$this->role->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->role->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->role->Lookup = new Lookup('role', 't_pegawai', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->role->OptionCount = 4;
		$this->fields['role'] = &$this->role;

		// aktif
		$this->aktif = new DbField('t_pegawai', 't_pegawai', 'x_aktif', 'aktif', '`aktif`', '`aktif`', 202, 1, -1, FALSE, '`aktif`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->aktif->Nullable = FALSE; // NOT NULL field
		$this->aktif->Sortable = TRUE; // Allow sort
		$this->aktif->DataType = DATATYPE_BOOLEAN;
		$this->aktif->TrueValue = "Y";
		$this->aktif->FalseValue = "N";
		$this->aktif->Lookup = new Lookup('aktif', 't_pegawai', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->aktif->OptionCount = 2;
		$this->fields['aktif'] = &$this->aktif;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_pegawai`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, (SELECT Count(1) FROM t_pelatihan a WHERE YEAR(a.tawal) = YEAR(CURDATE()) AND ((a.ketua = t_pegawai.id_peg) OR (a.bendahara = t_pegawai.id_peg) OR (a.sekretaris = t_pegawai.id_peg))) AS `jpelatihan` FROM " . $this->getSqlFrom();
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
			$this->id_peg->setDbValue($conn->insert_ID());
			$rs['id_peg'] = $this->id_peg->DbValue;
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
			$fldname = 'id_peg';
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
			if (array_key_exists('id_peg', $rs))
				AddFilter($where, QuotedName('id_peg', $this->Dbid) . '=' . QuotedValue($rs['id_peg'], $this->id_peg->DataType, $this->Dbid));
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
		$this->id_peg->DbValue = $row['id_peg'];
		$this->nip->DbValue = $row['nip'];
		$this->nama->DbValue = $row['nama'];
		$this->bagian->DbValue = $row['bagian'];
		$this->created_at->DbValue = $row['created_at'];
		$this->user_created_by->DbValue = $row['user_created_by'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->user_updated_by->DbValue = $row['user_updated_by'];
		$this->jpelatihan->DbValue = $row['jpelatihan'];
		$this->username->DbValue = $row['username'];
		$this->password->DbValue = $row['password'];
		$this->role->DbValue = $row['role'];
		$this->aktif->DbValue = $row['aktif'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_peg` = @id_peg@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_peg', $row) ? $row['id_peg'] : NULL;
		else
			$val = $this->id_peg->OldValue !== NULL ? $this->id_peg->OldValue : $this->id_peg->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_peg@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_pegawailist.php";
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
		if ($pageName == "t_pegawaiview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_pegawaiedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_pegawaiadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_pegawailist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_pegawaiview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pegawaiview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_pegawaiadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_pegawaiadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_pegawaiedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("t_pegawaiadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("t_pegawaidelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_peg:" . JsonEncode($this->id_peg->CurrentValue, "number");
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
		if ($this->id_peg->CurrentValue != NULL) {
			$url .= "id_peg=" . urlencode($this->id_peg->CurrentValue);
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
			if (Param("id_peg") !== NULL)
				$arKeys[] = Param("id_peg");
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
				$this->id_peg->CurrentValue = $key;
			else
				$this->id_peg->OldValue = $key;
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
		$this->id_peg->setDbValue($rs->fields('id_peg'));
		$this->nip->setDbValue($rs->fields('nip'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->bagian->setDbValue($rs->fields('bagian'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->user_created_by->setDbValue($rs->fields('user_created_by'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->user_updated_by->setDbValue($rs->fields('user_updated_by'));
		$this->jpelatihan->setDbValue($rs->fields('jpelatihan'));
		$this->username->setDbValue($rs->fields('username'));
		$this->password->setDbValue($rs->fields('password'));
		$this->role->setDbValue($rs->fields('role'));
		$this->aktif->setDbValue($rs->fields('aktif'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_peg
		// nip
		// nama
		// bagian
		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jpelatihan
		// username
		// password
		// role
		// aktif
		// id_peg

		$this->id_peg->ViewValue = $this->id_peg->CurrentValue;
		$this->id_peg->ViewCustomAttributes = "";

		// nip
		$this->nip->ViewValue = $this->nip->CurrentValue;
		$this->nip->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

		// bagian
		$curVal = strval($this->bagian->CurrentValue);
		if ($curVal != "") {
			$this->bagian->ViewValue = $this->bagian->lookupCacheOption($curVal);
			if ($this->bagian->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdbagian`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->bagian->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->bagian->ViewValue = $this->bagian->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->bagian->ViewValue = $this->bagian->CurrentValue;
				}
			}
		} else {
			$this->bagian->ViewValue = NULL;
		}
		$this->bagian->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// user_created_by
		$this->user_created_by->ViewValue = $this->user_created_by->CurrentValue;
		$this->user_created_by->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// user_updated_by
		$this->user_updated_by->ViewValue = $this->user_updated_by->CurrentValue;
		$this->user_updated_by->ViewCustomAttributes = "";

		// jpelatihan
		$this->jpelatihan->ViewValue = $this->jpelatihan->CurrentValue;
		$this->jpelatihan->ViewValue = FormatNumber($this->jpelatihan->ViewValue, 0, -2, -2, -2);
		$this->jpelatihan->ViewCustomAttributes = "";

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $Language->phrase("PasswordMask");
		$this->password->ViewCustomAttributes = "";

		// role
		if (strval($this->role->CurrentValue) != "") {
			$this->role->ViewValue = $this->role->optionCaption($this->role->CurrentValue);
		} else {
			$this->role->ViewValue = NULL;
		}
		$this->role->ViewCustomAttributes = "";

		// aktif
		if (ConvertToBool($this->aktif->CurrentValue)) {
			$this->aktif->ViewValue = $this->aktif->tagCaption(1) != "" ? $this->aktif->tagCaption(1) : "Ya";
		} else {
			$this->aktif->ViewValue = $this->aktif->tagCaption(2) != "" ? $this->aktif->tagCaption(2) : "Tidak";
		}
		$this->aktif->ViewCustomAttributes = "";

		// id_peg
		$this->id_peg->LinkCustomAttributes = "";
		$this->id_peg->HrefValue = "";
		$this->id_peg->TooltipValue = "";

		// nip
		$this->nip->LinkCustomAttributes = "";
		$this->nip->HrefValue = "";
		$this->nip->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// bagian
		$this->bagian->LinkCustomAttributes = "";
		$this->bagian->HrefValue = "";
		$this->bagian->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// user_created_by
		$this->user_created_by->LinkCustomAttributes = "";
		$this->user_created_by->HrefValue = "";
		$this->user_created_by->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

		// user_updated_by
		$this->user_updated_by->LinkCustomAttributes = "";
		$this->user_updated_by->HrefValue = "";
		$this->user_updated_by->TooltipValue = "";

		// jpelatihan
		$this->jpelatihan->LinkCustomAttributes = "";
		$this->jpelatihan->HrefValue = "";
		$this->jpelatihan->TooltipValue = "";

		// username
		$this->username->LinkCustomAttributes = "";
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

		// password
		$this->password->LinkCustomAttributes = "";
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// role
		$this->role->LinkCustomAttributes = "";
		$this->role->HrefValue = "";
		$this->role->TooltipValue = "";

		// aktif
		$this->aktif->LinkCustomAttributes = "";
		$this->aktif->HrefValue = "";
		$this->aktif->TooltipValue = "";

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

		// id_peg
		$this->id_peg->EditAttrs["class"] = "form-control";
		$this->id_peg->EditCustomAttributes = "";
		$this->id_peg->EditValue = $this->id_peg->CurrentValue;
		$this->id_peg->ViewCustomAttributes = "";

		// nip
		$this->nip->EditAttrs["class"] = "form-control";
		$this->nip->EditCustomAttributes = "";
		$this->nip->EditValue = $this->nip->CurrentValue;
		$this->nip->ViewCustomAttributes = "";

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

		// bagian
		$this->bagian->EditAttrs["class"] = "form-control";
		$this->bagian->EditCustomAttributes = "";

		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jpelatihan

		$this->jpelatihan->EditAttrs["class"] = "form-control";
		$this->jpelatihan->EditCustomAttributes = "";
		$this->jpelatihan->EditValue = $this->jpelatihan->CurrentValue;
		$this->jpelatihan->PlaceHolder = RemoveHtml($this->jpelatihan->caption());

		// username
		$this->username->EditAttrs["class"] = "form-control";
		$this->username->EditCustomAttributes = "";
		if (!$this->username->Raw)
			$this->username->CurrentValue = HtmlDecode($this->username->CurrentValue);
		$this->username->EditValue = $this->username->CurrentValue;
		$this->username->PlaceHolder = RemoveHtml($this->username->caption());

		// password
		$this->password->EditAttrs["class"] = "form-control";
		$this->password->EditCustomAttributes = "";
		$this->password->EditValue = $this->password->CurrentValue;
		$this->password->PlaceHolder = RemoveHtml($this->password->caption());

		// role
		$this->role->EditAttrs["class"] = "form-control";
		$this->role->EditCustomAttributes = "";
		$this->role->EditValue = $this->role->options(TRUE);

		// aktif
		$this->aktif->EditCustomAttributes = "";
		$this->aktif->EditValue = $this->aktif->options(FALSE);

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
					$doc->exportCaption($this->nip);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->bagian);
					$doc->exportCaption($this->username);
					$doc->exportCaption($this->password);
					$doc->exportCaption($this->role);
					$doc->exportCaption($this->aktif);
				} else {
					$doc->exportCaption($this->nip);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->bagian);
					$doc->exportCaption($this->aktif);
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
						$doc->exportField($this->nip);
						$doc->exportField($this->nama);
						$doc->exportField($this->bagian);
						$doc->exportField($this->username);
						$doc->exportField($this->password);
						$doc->exportField($this->role);
						$doc->exportField($this->aktif);
					} else {
						$doc->exportField($this->nip);
						$doc->exportField($this->nama);
						$doc->exportField($this->bagian);
						$doc->exportField($this->aktif);
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
		$table = 't_pegawai';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_pegawai';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id_peg'];

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
		$table = 't_pegawai';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['id_peg'];

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
		$table = 't_pegawai';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id_peg'];

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

		if($rsnew["aktif"] <> $rsold["aktif"])
			Execute("UPDATE t_users SET aktif='".$rsnew["aktif"]."' WHERE username = '".$rsold["nip"]."'");
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
		//$jp = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `ketua` = '".$this->id_peg->CurrentValue."' OR `bendahara` = '".$this->id_peg->CurrentValue."' OR `sekretaris` = '".$this->id_peg->CurrentValue."'");
		//$this->jpelatihan->ViewValue = $jp;

		if (CurrentPage()->PageID <> "list" ){
			$this->jpelatihan->Visible = (CurrentPage()->RowType <> ROWTYPE_SEARCH);
		}
		if(CurrentUserLevel() <> -1){
			$this->username->Visible = FALSE;
			$this->password->Visible = FALSE;
			$this->role->Visible = FALSE;
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>