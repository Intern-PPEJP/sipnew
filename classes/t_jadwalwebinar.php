<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_jadwalwebinar
 */
class t_jadwalwebinar extends DbTable
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
	public $idjadwal;
	public $idpelat;
	public $kdjudul;
	public $tgl;
	public $jam;
	public $jam_akhir;
	public $kurikulumid;
	public $materi;
	public $instruktur;
	public $instansi;
	public $ket;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_jadwalwebinar';
		$this->TableName = 't_jadwalwebinar';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_jadwalwebinar`";
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

		// idjadwal
		$this->idjadwal = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_idjadwal', 'idjadwal', '`idjadwal`', '`idjadwal`', 3, 11, -1, FALSE, '`idjadwal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idjadwal->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idjadwal->IsPrimaryKey = TRUE; // Primary key field
		$this->idjadwal->Sortable = TRUE; // Allow sort
		$this->idjadwal->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idjadwal'] = &$this->idjadwal;

		// idpelat
		$this->idpelat = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_idpelat', 'idpelat', '`idpelat`', '`idpelat`', 3, 11, -1, FALSE, '`idpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idpelat->IsForeignKey = TRUE; // Foreign key field
		$this->idpelat->Required = TRUE; // Required field
		$this->idpelat->Sortable = TRUE; // Allow sort
		$this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idpelat'] = &$this->idpelat;

		// kdjudul
		$this->kdjudul = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`kdjudul`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// tgl
		$this->tgl = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_tgl', 'tgl', '`tgl`', CastDateFieldForLike("`tgl`", 0, "DB"), 133, 10, 0, FALSE, '`tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl->Required = TRUE; // Required field
		$this->tgl->Sortable = TRUE; // Allow sort
		$this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl'] = &$this->tgl;

		// jam
		$this->jam = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_jam', 'jam', '`jam`', CastDateFieldForLike("`jam`", 4, "DB"), 134, 10, 4, FALSE, '`jam`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jam->Required = TRUE; // Required field
		$this->jam->Sortable = TRUE; // Allow sort
		$this->jam->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['jam'] = &$this->jam;

		// jam_akhir
		$this->jam_akhir = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_jam_akhir', 'jam_akhir', '`jam_akhir`', CastDateFieldForLike("`jam_akhir`", 4, "DB"), 134, 10, 4, FALSE, '`jam_akhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jam_akhir->Nullable = FALSE; // NOT NULL field
		$this->jam_akhir->Required = TRUE; // Required field
		$this->jam_akhir->Sortable = TRUE; // Allow sort
		$this->jam_akhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['jam_akhir'] = &$this->jam_akhir;

		// kurikulumid
		$this->kurikulumid = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_kurikulumid', 'kurikulumid', '`kurikulumid`', '`kurikulumid`', 3, 11, -1, FALSE, '`kurikulumid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kurikulumid->Required = TRUE; // Required field
		$this->kurikulumid->Sortable = TRUE; // Allow sort
		$this->kurikulumid->Lookup = new Lookup('kurikulumid', 't_kurikulum', FALSE, 'kurikulumid', ["kurikulum","","",""], [], [], [], [], ["silabus"], ["x_materi"], '', '');
		$this->kurikulumid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kurikulumid'] = &$this->kurikulumid;

		// materi
		$this->materi = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_materi', 'materi', '`materi`', '`materi`', 201, 65535, -1, FALSE, '`materi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->materi->Sortable = TRUE; // Allow sort
		$this->fields['materi'] = &$this->materi;

		// instruktur
		$this->instruktur = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_instruktur', 'instruktur', '`instruktur`', '`instruktur`', 200, 50, -1, FALSE, '`instruktur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->instruktur->Sortable = TRUE; // Allow sort
		$this->instruktur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['instruktur'] = &$this->instruktur;

		// instansi
		$this->instansi = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_instansi', 'instansi', '`instansi`', '`instansi`', 200, 255, -1, FALSE, '`instansi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->instansi->Sortable = TRUE; // Allow sort
		$this->fields['instansi'] = &$this->instansi;

		// ket
		$this->ket = new DbField('t_jadwalwebinar', 't_jadwalwebinar', 'x_ket', 'ket', '`ket`', '`ket`', 200, 50, -1, FALSE, '`ket`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ket->Sortable = TRUE; // Allow sort
		$this->fields['ket'] = &$this->ket;
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
		if ($this->getCurrentMasterTable() == "webinar") {
			if ($this->idpelat->getSessionValue() != "")
				$masterFilter .= "t_rkwebinar.rkwid=" . QuotedValue($this->idpelat->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "webinar") {
			if ($this->idpelat->getSessionValue() != "")
				$detailFilter .= "`idpelat`=" . QuotedValue($this->idpelat->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_webinar()
	{
		return "t_rkwebinar.rkwid=@rkwid@";
	}

	// Detail filter
	public function sqlDetailFilter_webinar()
	{
		return "`idpelat`=@idpelat@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_jadwalwebinar`";
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
			$this->idjadwal->setDbValue($conn->insert_ID());
			$rs['idjadwal'] = $this->idjadwal->DbValue;
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
			$fldname = 'idjadwal';
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
			if (array_key_exists('idjadwal', $rs))
				AddFilter($where, QuotedName('idjadwal', $this->Dbid) . '=' . QuotedValue($rs['idjadwal'], $this->idjadwal->DataType, $this->Dbid));
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
		$this->idjadwal->DbValue = $row['idjadwal'];
		$this->idpelat->DbValue = $row['idpelat'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->tgl->DbValue = $row['tgl'];
		$this->jam->DbValue = $row['jam'];
		$this->jam_akhir->DbValue = $row['jam_akhir'];
		$this->kurikulumid->DbValue = $row['kurikulumid'];
		$this->materi->DbValue = $row['materi'];
		$this->instruktur->DbValue = $row['instruktur'];
		$this->instansi->DbValue = $row['instansi'];
		$this->ket->DbValue = $row['ket'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`idjadwal` = @idjadwal@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('idjadwal', $row) ? $row['idjadwal'] : NULL;
		else
			$val = $this->idjadwal->OldValue !== NULL ? $this->idjadwal->OldValue : $this->idjadwal->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@idjadwal@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_jadwalwebinarlist.php";
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
		if ($pageName == "t_jadwalwebinarview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_jadwalwebinaredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_jadwalwebinaradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_jadwalwebinarlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_jadwalwebinarview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_jadwalwebinarview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_jadwalwebinaradd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_jadwalwebinaradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_jadwalwebinaredit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("t_jadwalwebinaradd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("t_jadwalwebinardelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "webinar" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_rkwid=" . urlencode($this->idpelat->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "idjadwal:" . JsonEncode($this->idjadwal->CurrentValue, "number");
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
		if ($this->idjadwal->CurrentValue != NULL) {
			$url .= "idjadwal=" . urlencode($this->idjadwal->CurrentValue);
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
			if (Param("idjadwal") !== NULL)
				$arKeys[] = Param("idjadwal");
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
				$this->idjadwal->CurrentValue = $key;
			else
				$this->idjadwal->OldValue = $key;
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
		$this->idjadwal->setDbValue($rs->fields('idjadwal'));
		$this->idpelat->setDbValue($rs->fields('idpelat'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->tgl->setDbValue($rs->fields('tgl'));
		$this->jam->setDbValue($rs->fields('jam'));
		$this->jam_akhir->setDbValue($rs->fields('jam_akhir'));
		$this->kurikulumid->setDbValue($rs->fields('kurikulumid'));
		$this->materi->setDbValue($rs->fields('materi'));
		$this->instruktur->setDbValue($rs->fields('instruktur'));
		$this->instansi->setDbValue($rs->fields('instansi'));
		$this->ket->setDbValue($rs->fields('ket'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// idjadwal
		// idpelat
		// kdjudul
		// tgl
		// jam
		// jam_akhir
		// kurikulumid
		// materi
		// instruktur
		// instansi
		// ket
		// idjadwal

		$this->idjadwal->ViewValue = $this->idjadwal->CurrentValue;
		$this->idjadwal->ViewCustomAttributes = "";

		// idpelat
		$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
		$this->idpelat->ViewCustomAttributes = "";

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

		// tgl
		$this->tgl->ViewValue = $this->tgl->CurrentValue;
		$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
		$this->tgl->ViewCustomAttributes = "";

		// jam
		$this->jam->ViewValue = $this->jam->CurrentValue;
		$this->jam->ViewValue = FormatDateTime($this->jam->ViewValue, 4);
		$this->jam->ViewCustomAttributes = "width='100px'";

		// jam_akhir
		$this->jam_akhir->ViewValue = $this->jam_akhir->CurrentValue;
		$this->jam_akhir->ViewValue = FormatDateTime($this->jam_akhir->ViewValue, 4);
		$this->jam_akhir->ViewCustomAttributes = "width='100px'";

		// kurikulumid
		$this->kurikulumid->ViewValue = $this->kurikulumid->CurrentValue;
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

		// materi
		$this->materi->ViewValue = $this->materi->CurrentValue;
		$this->materi->ViewCustomAttributes = "";

		// instruktur
		$this->instruktur->ViewValue = $this->instruktur->CurrentValue;
		$this->instruktur->ViewCustomAttributes = "";

		// instansi
		$this->instansi->ViewValue = $this->instansi->CurrentValue;
		$this->instansi->ViewCustomAttributes = "";

		// ket
		$this->ket->ViewValue = $this->ket->CurrentValue;
		$this->ket->ViewCustomAttributes = "";

		// idjadwal
		$this->idjadwal->LinkCustomAttributes = "";
		$this->idjadwal->HrefValue = "";
		$this->idjadwal->TooltipValue = "";

		// idpelat
		$this->idpelat->LinkCustomAttributes = "";
		$this->idpelat->HrefValue = "";
		$this->idpelat->TooltipValue = "";

		// kdjudul
		$this->kdjudul->LinkCustomAttributes = "";
		$this->kdjudul->HrefValue = "";
		$this->kdjudul->TooltipValue = "";

		// tgl
		$this->tgl->LinkCustomAttributes = "";
		$this->tgl->HrefValue = "";
		$this->tgl->TooltipValue = "";

		// jam
		$this->jam->LinkCustomAttributes = "";
		$this->jam->HrefValue = "";
		$this->jam->TooltipValue = "";

		// jam_akhir
		$this->jam_akhir->LinkCustomAttributes = "";
		$this->jam_akhir->HrefValue = "";
		$this->jam_akhir->TooltipValue = "";

		// kurikulumid
		$this->kurikulumid->LinkCustomAttributes = "";
		$this->kurikulumid->HrefValue = "";
		$this->kurikulumid->TooltipValue = "";

		// materi
		$this->materi->LinkCustomAttributes = "";
		$this->materi->HrefValue = "";
		$this->materi->TooltipValue = "";

		// instruktur
		$this->instruktur->LinkCustomAttributes = "";
		$this->instruktur->HrefValue = "";
		$this->instruktur->TooltipValue = "";

		// instansi
		$this->instansi->LinkCustomAttributes = "";
		$this->instansi->HrefValue = "";
		$this->instansi->TooltipValue = "";

		// ket
		$this->ket->LinkCustomAttributes = "";
		$this->ket->HrefValue = "";
		$this->ket->TooltipValue = "";

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

		// idjadwal
		$this->idjadwal->EditAttrs["class"] = "form-control";
		$this->idjadwal->EditCustomAttributes = "";
		$this->idjadwal->EditValue = $this->idjadwal->CurrentValue;
		$this->idjadwal->ViewCustomAttributes = "";

		// idpelat
		$this->idpelat->EditAttrs["class"] = "form-control";
		$this->idpelat->EditCustomAttributes = "";
		if ($this->idpelat->getSessionValue() != "") {
			$this->idpelat->CurrentValue = $this->idpelat->getSessionValue();
			$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
			$this->idpelat->ViewCustomAttributes = "";
		} else {
			$this->idpelat->EditValue = $this->idpelat->CurrentValue;
			$this->idpelat->PlaceHolder = RemoveHtml($this->idpelat->caption());
		}

		// kdjudul
		$this->kdjudul->EditAttrs["class"] = "form-control";
		$this->kdjudul->EditCustomAttributes = "";
		if (!$this->kdjudul->Raw)
			$this->kdjudul->CurrentValue = HtmlDecode($this->kdjudul->CurrentValue);
		$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
		$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

		// tgl
		$this->tgl->EditAttrs["class"] = "form-control";
		$this->tgl->EditCustomAttributes = 'style=" width: 100px; "';
		$this->tgl->EditValue = FormatDateTime($this->tgl->CurrentValue, 8);
		$this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

		// jam
		$this->jam->EditAttrs["class"] = "form-control";
		$this->jam->EditCustomAttributes = "";
		$this->jam->EditValue = $this->jam->CurrentValue;
		$this->jam->PlaceHolder = RemoveHtml($this->jam->caption());

		// jam_akhir
		$this->jam_akhir->EditAttrs["class"] = "form-control";
		$this->jam_akhir->EditCustomAttributes = "";
		$this->jam_akhir->EditValue = $this->jam_akhir->CurrentValue;
		$this->jam_akhir->PlaceHolder = RemoveHtml($this->jam_akhir->caption());

		// kurikulumid
		$this->kurikulumid->EditAttrs["class"] = "form-control";
		$this->kurikulumid->EditCustomAttributes = "";
		$this->kurikulumid->EditValue = $this->kurikulumid->CurrentValue;
		$this->kurikulumid->PlaceHolder = RemoveHtml($this->kurikulumid->caption());

		// materi
		$this->materi->EditAttrs["class"] = "form-control";
		$this->materi->EditCustomAttributes = "";
		if (!$this->materi->Raw)
			$this->materi->CurrentValue = HtmlDecode($this->materi->CurrentValue);
		$this->materi->EditValue = $this->materi->CurrentValue;
		$this->materi->PlaceHolder = RemoveHtml($this->materi->caption());

		// instruktur
		$this->instruktur->EditAttrs["class"] = "form-control";
		$this->instruktur->EditCustomAttributes = "";
		if (!$this->instruktur->Raw)
			$this->instruktur->CurrentValue = HtmlDecode($this->instruktur->CurrentValue);
		$this->instruktur->EditValue = $this->instruktur->CurrentValue;
		$this->instruktur->PlaceHolder = RemoveHtml($this->instruktur->caption());

		// instansi
		$this->instansi->EditAttrs["class"] = "form-control";
		$this->instansi->EditCustomAttributes = "";
		if (!$this->instansi->Raw)
			$this->instansi->CurrentValue = HtmlDecode($this->instansi->CurrentValue);
		$this->instansi->EditValue = $this->instansi->CurrentValue;
		$this->instansi->PlaceHolder = RemoveHtml($this->instansi->caption());

		// ket
		$this->ket->EditAttrs["class"] = "form-control";
		$this->ket->EditCustomAttributes = "";
		if (!$this->ket->Raw)
			$this->ket->CurrentValue = HtmlDecode($this->ket->CurrentValue);
		$this->ket->EditValue = $this->ket->CurrentValue;
		$this->ket->PlaceHolder = RemoveHtml($this->ket->caption());

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
					$doc->exportCaption($this->idjadwal);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->jam);
					$doc->exportCaption($this->jam_akhir);
					$doc->exportCaption($this->materi);
					$doc->exportCaption($this->instruktur);
					$doc->exportCaption($this->instansi);
					$doc->exportCaption($this->ket);
				} else {
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->jam);
					$doc->exportCaption($this->jam_akhir);
					$doc->exportCaption($this->materi);
					$doc->exportCaption($this->instruktur);
					$doc->exportCaption($this->instansi);
					$doc->exportCaption($this->ket);
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
						$doc->exportField($this->idjadwal);
						$doc->exportField($this->tgl);
						$doc->exportField($this->jam);
						$doc->exportField($this->jam_akhir);
						$doc->exportField($this->materi);
						$doc->exportField($this->instruktur);
						$doc->exportField($this->instansi);
						$doc->exportField($this->ket);
					} else {
						$doc->exportField($this->tgl);
						$doc->exportField($this->jam);
						$doc->exportField($this->jam_akhir);
						$doc->exportField($this->materi);
						$doc->exportField($this->instruktur);
						$doc->exportField($this->instansi);
						$doc->exportField($this->ket);
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
		$table = 't_jadwalwebinar';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_jadwalwebinar';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['idjadwal'];

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
		$table = 't_jadwalwebinar';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['idjadwal'];

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
		$table = 't_jadwalwebinar';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['idjadwal'];

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

		$kurikulum = ExecuteScalar("SELECT COUNT(1) FROM t_kurikulum WHERE kurikulumid = '".$rsnew["materi"]."'");
		if($kurikulum > 0){
			$rsnew["kurikulumid"] = $rsnew["materi"];
		}
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

		$kurikulum = ExecuteScalar("SELECT COUNT(1) FROM t_kurikulum WHERE kurikulumid = '".$rsnew["materi"]."'");
		if($kurikulum > 0){
			$rsnew["kurikulumid"] = $rsnew["materi"];
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

		$this->tgl->ViewValue = CSFormatTanggal($this->tgl->ViewValue, false, true);

	/*	
		$kurikulum = ExecuteScalar("SELECT COUNT(1) FROM t_kurikulum WHERE kurikulumid = '".$this->materi->CurrentValue."'");
		if($kurikulum > 0){
			$m = ExecuteRow("SELECT kurikulum,silabus FROM t_kurikulum WHERE kurikulumid = '".$this->materi->CurrentValue."'");
			$this->materi->ViewValue = "<p><b>".$m["kurikulum"]."</b></p>".$m["silabus"];
		} else {
			$this->materi->ViewValue = "<b>".$this->materi->ViewValue."</b>";
		}
	*/	
		if ($this->Export <> "") { 
			GLOBAL $dvalue;
			if($this->tgl->CurrentValue == $dvalue){
				$this->tgl->ViewValue = "";
			}
			$dvalue = $this->tgl->CurrentValue;
			if($this->materi->CurrentValue == ""){
				$this->materi->ViewValue = "<b>". $this->ket->CurrentValue . "</b>";
			}
		}
		$this->jam->ViewValue = date('H.i', strtotime( $this->jam->CurrentValue ));
		$this->jam_akhir->ViewValue = date('H.i', strtotime( $this->jam_akhir->CurrentValue ));
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>