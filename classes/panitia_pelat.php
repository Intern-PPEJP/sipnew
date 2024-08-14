<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for panitia_pelat
 */
class panitia_pelat extends DbTable
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
	public $tahun;
	public $id_peg;
	public $panitia;
	public $nama;
	public $bagian;
	public $jml_pelat;
	public $tempat;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'panitia_pelat';
		$this->TableName = 'panitia_pelat';
		$this->TableType = 'CUSTOMVIEW';

		// Update Table
		$this->UpdateTable = "(SELECT t_pelatihan.idpelat, t_pelatihan.tawal, t_pelatihan.ketua panitia, 'ketua' sbg FROM t_pelatihan WHERE statuspel = 4 AND t_pelatihan.ketua > 0 UNION ALL SELECT t_pelatihan.idpelat, t_pelatihan.tawal, t_pelatihan.bendahara panitia, 'sekretaris' sbg FROM t_pelatihan WHERE statuspel = 4 AND t_pelatihan.bendahara > 0 UNION ALL SELECT t_pelatihan.idpelat, t_pelatihan.tawal, t_pelatihan.sekretaris panitia, 'anggota1' sbg FROM t_pelatihan WHERE statuspel = 4 AND t_pelatihan.sekretaris > 0 UNION ALL SELECT t_pelatihan.idpelat, t_pelatihan.tawal, t_pelatihan.anggota2 panitia, 'anggota2' sbg FROM t_pelatihan WHERE statuspel = 4 AND t_pelatihan.anggota2 > 0) customexport JOIN t_pegawai p ON p.id_peg = customexport.panitia";
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

		// tahun
		$this->tahun = new DbField('panitia_pelat', 'panitia_pelat', 'x_tahun', 'tahun', 'Year(customexport.tawal)', 'Year(customexport.tawal)', 3, 4, -1, FALSE, 'Year(customexport.tawal)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tahun->Sortable = FALSE; // Allow sort
		$this->tahun->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tahun->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->tahun->Lookup = new Lookup('tahun', 't_tahun', FALSE, 'tahun', ["tahun","","",""], [], [], [], [], [], [], '`tahun` DESC', '');
		$this->tahun->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tahun'] = &$this->tahun;

		// id_peg
		$this->id_peg = new DbField('panitia_pelat', 'panitia_pelat', 'x_id_peg', 'id_peg', 'p.id_peg', 'p.id_peg', 3, 11, -1, FALSE, 'p.id_peg', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_peg->Nullable = FALSE; // NOT NULL field
		$this->id_peg->Required = TRUE; // Required field
		$this->id_peg->Sortable = TRUE; // Allow sort
		$this->id_peg->Lookup = new Lookup('id_peg', 't_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->id_peg->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_peg'] = &$this->id_peg;

		// panitia
		$this->panitia = new DbField('panitia_pelat', 'panitia_pelat', 'x_panitia', 'panitia', 'customexport.panitia', 'customexport.panitia', 200, 40, -1, FALSE, 'customexport.panitia', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->panitia->Sortable = FALSE; // Allow sort
		$this->panitia->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->panitia->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->panitia->Lookup = new Lookup('panitia', 't_pegawai', FALSE, 'id_peg', ["nip","","",""], [], [], [], [], [], [], '', '');
		$this->fields['panitia'] = &$this->panitia;

		// nama
		$this->nama = new DbField('panitia_pelat', 'panitia_pelat', 'x_nama', 'nama', 'p.nama', 'p.nama', 200, 255, -1, FALSE, 'p.nama', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// bagian
		$this->bagian = new DbField('panitia_pelat', 'panitia_pelat', 'x_bagian', 'bagian', 'p.bagian', 'p.bagian', 3, 11, -1, FALSE, 'p.bagian', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bagian->Required = TRUE; // Required field
		$this->bagian->Sortable = FALSE; // Allow sort
		$this->bagian->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bagian->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->bagian->Lookup = new Lookup('bagian', 't_bagian', FALSE, 'kdbagian', ["namabagian","","",""], [], [], [], [], [], [], '', '');
		$this->bagian->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bagian'] = &$this->bagian;

		// jml_pelat
		$this->jml_pelat = new DbField('panitia_pelat', 'panitia_pelat', 'x_jml_pelat', 'jml_pelat', 'Count(1)', 'Count(1)', 20, 21, -1, FALSE, 'Count(1)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_pelat->Nullable = FALSE; // NOT NULL field
		$this->jml_pelat->Required = TRUE; // Required field
		$this->jml_pelat->Sortable = TRUE; // Allow sort
		$this->jml_pelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jml_pelat'] = &$this->jml_pelat;

		// tempat
		$this->tempat = new DbField('panitia_pelat', 'panitia_pelat', 'x_tempat', 'tempat', 'NULL', 'NULL', 12, 65530, -1, FALSE, 'NULL', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tempat->IsCustom = TRUE; // Custom field
		$this->tempat->Sortable = TRUE; // Allow sort
		$this->fields['tempat'] = &$this->tempat;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "(SELECT t_pelatihan.idpelat, t_pelatihan.tawal, t_pelatihan.ketua panitia, 'ketua' sbg FROM t_pelatihan WHERE statuspel = 4 AND t_pelatihan.ketua > 0 UNION ALL SELECT t_pelatihan.idpelat, t_pelatihan.tawal, t_pelatihan.bendahara panitia, 'sekretaris' sbg FROM t_pelatihan WHERE statuspel = 4 AND t_pelatihan.bendahara > 0 UNION ALL SELECT t_pelatihan.idpelat, t_pelatihan.tawal, t_pelatihan.sekretaris panitia, 'anggota1' sbg FROM t_pelatihan WHERE statuspel = 4 AND t_pelatihan.sekretaris > 0 UNION ALL SELECT t_pelatihan.idpelat, t_pelatihan.tawal, t_pelatihan.anggota2 panitia, 'anggota2' sbg FROM t_pelatihan WHERE statuspel = 4 AND t_pelatihan.anggota2 > 0) customexport JOIN t_pegawai p ON p.id_peg = customexport.panitia";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT Year(customexport.tawal) tahun, customexport.panitia, p.nama, Count(1) jml_pelat, p.bagian, p.id_peg, NULL AS `tempat` FROM " . $this->getSqlFrom();
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
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "customexport.panitia, p.bagian, p.id_peg";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "p.nama";
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
		$this->tahun->DbValue = $row['tahun'];
		$this->id_peg->DbValue = $row['id_peg'];
		$this->panitia->DbValue = $row['panitia'];
		$this->nama->DbValue = $row['nama'];
		$this->bagian->DbValue = $row['bagian'];
		$this->jml_pelat->DbValue = $row['jml_pelat'];
		$this->tempat->DbValue = $row['tempat'];
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
			return "panitia_pelatlist.php";
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
		if ($pageName == "panitia_pelatview.php")
			return $Language->phrase("View");
		elseif ($pageName == "panitia_pelatedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "panitia_pelatadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "panitia_pelatlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("panitia_pelatview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("panitia_pelatview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "panitia_pelatadd.php?" . $this->getUrlParm($parm);
		else
			$url = "panitia_pelatadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("panitia_pelatedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("panitia_pelatadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("panitia_pelatdelete.php", $this->getUrlParm());
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
		$this->tahun->setDbValue($rs->fields('tahun'));
		$this->id_peg->setDbValue($rs->fields('id_peg'));
		$this->panitia->setDbValue($rs->fields('panitia'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->bagian->setDbValue($rs->fields('bagian'));
		$this->jml_pelat->setDbValue($rs->fields('jml_pelat'));
		$this->tempat->setDbValue($rs->fields('tempat'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// tahun
		// id_peg
		// panitia
		// nama
		// bagian
		// jml_pelat
		// tempat
		// tahun

		$curVal = strval($this->tahun->CurrentValue);
		if ($curVal != "") {
			$this->tahun->ViewValue = $this->tahun->lookupCacheOption($curVal);
			if ($this->tahun->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`tahun` <= ". date("Y") . "";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->tahun->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->tahun->ViewValue = $this->tahun->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->tahun->ViewValue = $this->tahun->CurrentValue;
				}
			}
		} else {
			$this->tahun->ViewValue = NULL;
		}
		$this->tahun->ViewCustomAttributes = "";

		// id_peg
		$this->id_peg->ViewValue = $this->id_peg->CurrentValue;
		$curVal = strval($this->id_peg->CurrentValue);
		if ($curVal != "") {
			$this->id_peg->ViewValue = $this->id_peg->lookupCacheOption($curVal);
			if ($this->id_peg->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_peg->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_peg->ViewValue = $this->id_peg->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_peg->ViewValue = $this->id_peg->CurrentValue;
				}
			}
		} else {
			$this->id_peg->ViewValue = NULL;
		}
		$this->id_peg->ViewCustomAttributes = "";

		// panitia
		$curVal = strval($this->panitia->CurrentValue);
		if ($curVal != "") {
			$this->panitia->ViewValue = $this->panitia->lookupCacheOption($curVal);
			if ($this->panitia->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->panitia->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->panitia->ViewValue = $this->panitia->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->panitia->ViewValue = $this->panitia->CurrentValue;
				}
			}
		} else {
			$this->panitia->ViewValue = NULL;
		}
		$this->panitia->ViewCustomAttributes = "";

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

		// jml_pelat
		$this->jml_pelat->ViewValue = $this->jml_pelat->CurrentValue;
		$this->jml_pelat->ViewValue = FormatNumber($this->jml_pelat->ViewValue, 0, -2, -2, -2);
		$this->jml_pelat->CellCssStyle .= "text-align: center;";
		$this->jml_pelat->ViewCustomAttributes = "";

		// tempat
		$this->tempat->ViewValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

		// tahun
		$this->tahun->LinkCustomAttributes = "";
		$this->tahun->HrefValue = "";
		$this->tahun->TooltipValue = "";

		// id_peg
		$this->id_peg->LinkCustomAttributes = "";
		$this->id_peg->HrefValue = "";
		$this->id_peg->TooltipValue = "";

		// panitia
		$this->panitia->LinkCustomAttributes = "";
		$this->panitia->HrefValue = "";
		$this->panitia->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// bagian
		$this->bagian->LinkCustomAttributes = "";
		$this->bagian->HrefValue = "";
		$this->bagian->TooltipValue = "";

		// jml_pelat
		$this->jml_pelat->LinkCustomAttributes = "";
		$this->jml_pelat->HrefValue = "";
		$this->jml_pelat->TooltipValue = "";

		// tempat
		$this->tempat->LinkCustomAttributes = "";
		$this->tempat->HrefValue = "";
		$this->tempat->TooltipValue = "";

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

		// tahun
		$this->tahun->EditAttrs["class"] = "form-control";
		$this->tahun->EditCustomAttributes = "";

		// id_peg
		$this->id_peg->EditAttrs["class"] = "form-control";
		$this->id_peg->EditCustomAttributes = "";
		$this->id_peg->EditValue = $this->id_peg->CurrentValue;
		$this->id_peg->PlaceHolder = RemoveHtml($this->id_peg->caption());

		// panitia
		$this->panitia->EditAttrs["class"] = "form-control";
		$this->panitia->EditCustomAttributes = "";

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

		// jml_pelat
		$this->jml_pelat->EditAttrs["class"] = "form-control";
		$this->jml_pelat->EditCustomAttributes = "";
		$this->jml_pelat->EditValue = $this->jml_pelat->CurrentValue;
		$this->jml_pelat->PlaceHolder = RemoveHtml($this->jml_pelat->caption());

		// tempat
		$this->tempat->EditAttrs["class"] = "form-control";
		$this->tempat->EditCustomAttributes = "";
		$this->tempat->EditValue = $this->tempat->CurrentValue;
		$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

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
					$doc->exportCaption($this->tahun);
					$doc->exportCaption($this->id_peg);
					$doc->exportCaption($this->panitia);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->bagian);
					$doc->exportCaption($this->jml_pelat);
					$doc->exportCaption($this->tempat);
				} else {
					$doc->exportCaption($this->tahun);
					$doc->exportCaption($this->id_peg);
					$doc->exportCaption($this->panitia);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->bagian);
					$doc->exportCaption($this->jml_pelat);
					$doc->exportCaption($this->tempat);
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
						$doc->exportField($this->tahun);
						$doc->exportField($this->id_peg);
						$doc->exportField($this->panitia);
						$doc->exportField($this->nama);
						$doc->exportField($this->bagian);
						$doc->exportField($this->jml_pelat);
						$doc->exportField($this->tempat);
					} else {
						$doc->exportField($this->tahun);
						$doc->exportField($this->id_peg);
						$doc->exportField($this->panitia);
						$doc->exportField($this->nama);
						$doc->exportField($this->bagian);
						$doc->exportField($this->jml_pelat);
						$doc->exportField($this->tempat);
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
	//	if($this->tahun->AdvancedSearch->SearchValue == "")
	//		$this->tahun->AdvancedSearch->SearchValue = date("Y");

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
		//if ($fld->Name == "tahun") {
		//    $fld->Lookup->UserSelect = "SELECT Field1 AS lf, Field2 AS df, Field3 AS df2, '' AS df3, '' AS df4 FROM Table1"; // Modify SELECT
		   // $fld->Lookup->UserOrderBy = "Field2 ASC"; // Modify ORDER BY
	   // }

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

		$alltempat = "";
		$this->tempat->ViewValue = $alltempat;
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>