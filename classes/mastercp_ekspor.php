<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for mastercp_ekspor
 */
class mastercp_ekspor extends DbTable
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
	public $ID_ECP;
	public $Wilayah_ECP;
	public $Tahun_ECP;
	public $Nama;
	public $Perusahaan;
	public $Produk;
	public $Nilai_Ekspor_USD;
	public $Nilai_Ekspor_Rupiah;
	public $Tgl_Bln_Ekspor;
	public $Tahun_Ekspor;
	public $Negara_Tujuan;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'mastercp_ekspor';
		$this->TableName = 'mastercp_ekspor';
		$this->TableType = 'CUSTOMVIEW';

		// Update Table
		$this->UpdateTable = "t_ecp";
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

		// ID_ECP
		$this->ID_ECP = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_ID_ECP', 'ID_ECP', 't_ecp.ID_ECP', 't_ecp.ID_ECP', 3, 9, -1, FALSE, 't_ecp.ID_ECP', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_ECP->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_ECP->Sortable = TRUE; // Allow sort
		$this->ID_ECP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_ECP'] = &$this->ID_ECP;

		// Wilayah_ECP
		$this->Wilayah_ECP = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Wilayah_ECP', 'Wilayah_ECP', 't_ecp.Wilayah_ECP', 't_ecp.Wilayah_ECP', 200, 100, -1, FALSE, 't_ecp.Wilayah_ECP', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Wilayah_ECP->Sortable = TRUE; // Allow sort
		$this->Wilayah_ECP->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Wilayah_ECP->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Wilayah_ECP->Lookup = new Lookup('Wilayah_ECP', 't_area', FALSE, 'area', ["area","","",""], [], [], [], [], [], [], '`area` ASC', '');
		$this->fields['Wilayah_ECP'] = &$this->Wilayah_ECP;

		// Tahun_ECP
		$this->Tahun_ECP = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Tahun_ECP', 'Tahun_ECP', 't_ecp.Tahun_ECP', 't_ecp.Tahun_ECP', 2, 4, -1, FALSE, 't_ecp.Tahun_ECP', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tahun_ECP->Sortable = TRUE; // Allow sort
		$this->Tahun_ECP->Lookup = new Lookup('Tahun_ECP', 't_tahun', TRUE, 'tahun', ["tahun","","",""], [], [], [], [], [], [], '`tahun` ASC', '');
		$this->Tahun_ECP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Tahun_ECP'] = &$this->Tahun_ECP;

		// Nama
		$this->Nama = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Nama', 'Nama', 't_ecp.Nama', 't_ecp.Nama', 200, 200, -1, FALSE, 't_ecp.Nama', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nama->Nullable = FALSE; // NOT NULL field
		$this->Nama->Required = TRUE; // Required field
		$this->Nama->Sortable = TRUE; // Allow sort
		$this->fields['Nama'] = &$this->Nama;

		// Perusahaan
		$this->Perusahaan = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Perusahaan', 'Perusahaan', 't_ecp.Perusahaan', 't_ecp.Perusahaan', 200, 255, -1, FALSE, 't_ecp.Perusahaan', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Perusahaan->Nullable = FALSE; // NOT NULL field
		$this->Perusahaan->Required = TRUE; // Required field
		$this->Perusahaan->Sortable = TRUE; // Allow sort
		$this->fields['Perusahaan'] = &$this->Perusahaan;

		// Produk
		$this->Produk = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Produk', 'Produk', 't_ecp.Produk', 't_ecp.Produk', 200, 255, -1, FALSE, 't_ecp.Produk', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Produk->Nullable = FALSE; // NOT NULL field
		$this->Produk->Required = TRUE; // Required field
		$this->Produk->Sortable = TRUE; // Allow sort
		$this->fields['Produk'] = &$this->Produk;

		// Nilai_Ekspor_USD
		$this->Nilai_Ekspor_USD = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Nilai_Ekspor_USD', 'Nilai_Ekspor_USD', 't_ecp.Nilai_Ekspor_USD', 't_ecp.Nilai_Ekspor_USD', 131, 15, -1, FALSE, 't_ecp.Nilai_Ekspor_USD', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nilai_Ekspor_USD->Nullable = FALSE; // NOT NULL field
		$this->Nilai_Ekspor_USD->Required = TRUE; // Required field
		$this->Nilai_Ekspor_USD->Sortable = TRUE; // Allow sort
		$this->Nilai_Ekspor_USD->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Nilai_Ekspor_USD'] = &$this->Nilai_Ekspor_USD;

		// Nilai_Ekspor_Rupiah
		$this->Nilai_Ekspor_Rupiah = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Nilai_Ekspor_Rupiah', 'Nilai_Ekspor_Rupiah', 't_ecp.Nilai_Ekspor_Rupiah', 't_ecp.Nilai_Ekspor_Rupiah', 131, 15, -1, FALSE, 't_ecp.Nilai_Ekspor_Rupiah', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nilai_Ekspor_Rupiah->Nullable = FALSE; // NOT NULL field
		$this->Nilai_Ekspor_Rupiah->Required = TRUE; // Required field
		$this->Nilai_Ekspor_Rupiah->Sortable = TRUE; // Allow sort
		$this->Nilai_Ekspor_Rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Nilai_Ekspor_Rupiah'] = &$this->Nilai_Ekspor_Rupiah;

		// Tgl_Bln_Ekspor
		$this->Tgl_Bln_Ekspor = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Tgl_Bln_Ekspor', 'Tgl_Bln_Ekspor', 't_ecp.Tgl_Bln_Ekspor', 't_ecp.Tgl_Bln_Ekspor', 200, 50, -1, FALSE, 't_ecp.Tgl_Bln_Ekspor', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tgl_Bln_Ekspor->Nullable = FALSE; // NOT NULL field
		$this->Tgl_Bln_Ekspor->Required = TRUE; // Required field
		$this->Tgl_Bln_Ekspor->Sortable = TRUE; // Allow sort
		$this->fields['Tgl_Bln_Ekspor'] = &$this->Tgl_Bln_Ekspor;

		// Tahun_Ekspor
		$this->Tahun_Ekspor = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Tahun_Ekspor', 'Tahun_Ekspor', 't_ecp.Tahun_Ekspor', 't_ecp.Tahun_Ekspor', 2, 4, -1, FALSE, 't_ecp.Tahun_Ekspor', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Tahun_Ekspor->Nullable = FALSE; // NOT NULL field
		$this->Tahun_Ekspor->Required = TRUE; // Required field
		$this->Tahun_Ekspor->Sortable = TRUE; // Allow sort
		$this->Tahun_Ekspor->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Tahun_Ekspor->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Tahun_Ekspor->Lookup = new Lookup('Tahun_Ekspor', 't_tahun', TRUE, 'tahun', ["tahun","","",""], [], [], [], [], [], [], '`tahun` DESC', '');
		$this->Tahun_Ekspor->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Tahun_Ekspor'] = &$this->Tahun_Ekspor;

		// Negara_Tujuan
		$this->Negara_Tujuan = new DbField('mastercp_ekspor', 'mastercp_ekspor', 'x_Negara_Tujuan', 'Negara_Tujuan', 't_ecp.Negara_Tujuan', 't_ecp.Negara_Tujuan', 200, 100, -1, FALSE, 't_ecp.Negara_Tujuan', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Negara_Tujuan->Nullable = FALSE; // NOT NULL field
		$this->Negara_Tujuan->Required = TRUE; // Required field
		$this->Negara_Tujuan->Sortable = TRUE; // Allow sort
		$this->Negara_Tujuan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Negara_Tujuan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Negara_Tujuan->Lookup = new Lookup('Negara_Tujuan', 't_negara', FALSE, 'negara', ["negara","","",""], [], [], [], [], [], [], '', '');
		$this->fields['Negara_Tujuan'] = &$this->Negara_Tujuan;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "t_ecp";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT t_ecp.ID_ECP, t_ecp.Wilayah_ECP, t_ecp.Tahun_ECP, t_ecp.Nama, t_ecp.Perusahaan, t_ecp.Produk, t_ecp.Nilai_Ekspor_USD, t_ecp.Nilai_Ekspor_Rupiah, t_ecp.Tgl_Bln_Ekspor, t_ecp.Tahun_Ekspor, t_ecp.Negara_Tujuan FROM " . $this->getSqlFrom();
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
			$this->ID_ECP->setDbValue($conn->insert_ID());
			$rs['ID_ECP'] = $this->ID_ECP->DbValue;
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
		$this->ID_ECP->DbValue = $row['ID_ECP'];
		$this->Wilayah_ECP->DbValue = $row['Wilayah_ECP'];
		$this->Tahun_ECP->DbValue = $row['Tahun_ECP'];
		$this->Nama->DbValue = $row['Nama'];
		$this->Perusahaan->DbValue = $row['Perusahaan'];
		$this->Produk->DbValue = $row['Produk'];
		$this->Nilai_Ekspor_USD->DbValue = $row['Nilai_Ekspor_USD'];
		$this->Nilai_Ekspor_Rupiah->DbValue = $row['Nilai_Ekspor_Rupiah'];
		$this->Tgl_Bln_Ekspor->DbValue = $row['Tgl_Bln_Ekspor'];
		$this->Tahun_Ekspor->DbValue = $row['Tahun_Ekspor'];
		$this->Negara_Tujuan->DbValue = $row['Negara_Tujuan'];
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
			return "mastercp_eksporlist.php";
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
		if ($pageName == "mastercp_eksporview.php")
			return $Language->phrase("View");
		elseif ($pageName == "mastercp_eksporedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "mastercp_eksporadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "mastercp_eksporlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("mastercp_eksporview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("mastercp_eksporview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "mastercp_eksporadd.php?" . $this->getUrlParm($parm);
		else
			$url = "mastercp_eksporadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("mastercp_eksporedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("mastercp_eksporadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("mastercp_ekspordelete.php", $this->getUrlParm());
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
		$this->ID_ECP->setDbValue($rs->fields('ID_ECP'));
		$this->Wilayah_ECP->setDbValue($rs->fields('Wilayah_ECP'));
		$this->Tahun_ECP->setDbValue($rs->fields('Tahun_ECP'));
		$this->Nama->setDbValue($rs->fields('Nama'));
		$this->Perusahaan->setDbValue($rs->fields('Perusahaan'));
		$this->Produk->setDbValue($rs->fields('Produk'));
		$this->Nilai_Ekspor_USD->setDbValue($rs->fields('Nilai_Ekspor_USD'));
		$this->Nilai_Ekspor_Rupiah->setDbValue($rs->fields('Nilai_Ekspor_Rupiah'));
		$this->Tgl_Bln_Ekspor->setDbValue($rs->fields('Tgl_Bln_Ekspor'));
		$this->Tahun_Ekspor->setDbValue($rs->fields('Tahun_Ekspor'));
		$this->Negara_Tujuan->setDbValue($rs->fields('Negara_Tujuan'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_ECP
		// Wilayah_ECP
		// Tahun_ECP
		// Nama
		// Perusahaan
		// Produk
		// Nilai_Ekspor_USD
		// Nilai_Ekspor_Rupiah
		// Tgl_Bln_Ekspor
		// Tahun_Ekspor
		// Negara_Tujuan
		// ID_ECP

		$this->ID_ECP->ViewValue = $this->ID_ECP->CurrentValue;
		$this->ID_ECP->ViewCustomAttributes = "";

		// Wilayah_ECP
		$curVal = strval($this->Wilayah_ECP->CurrentValue);
		if ($curVal != "") {
			$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->lookupCacheOption($curVal);
			if ($this->Wilayah_ECP->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`area`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->Wilayah_ECP->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->CurrentValue;
				}
			}
		} else {
			$this->Wilayah_ECP->ViewValue = NULL;
		}
		$this->Wilayah_ECP->ViewCustomAttributes = "";

		// Tahun_ECP
		$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
		$curVal = strval($this->Tahun_ECP->CurrentValue);
		if ($curVal != "") {
			$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->lookupCacheOption($curVal);
			if ($this->Tahun_ECP->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`tahun` > 2010";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Tahun_ECP->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
				}
			}
		} else {
			$this->Tahun_ECP->ViewValue = NULL;
		}
		$this->Tahun_ECP->ViewCustomAttributes = "";

		// Nama
		$this->Nama->ViewValue = $this->Nama->CurrentValue;
		$this->Nama->ViewCustomAttributes = "";

		// Perusahaan
		$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
		$this->Perusahaan->ViewCustomAttributes = "";

		// Produk
		$this->Produk->ViewValue = $this->Produk->CurrentValue;
		$this->Produk->ViewCustomAttributes = "";

		// Nilai_Ekspor_USD
		$this->Nilai_Ekspor_USD->ViewValue = $this->Nilai_Ekspor_USD->CurrentValue;
		$this->Nilai_Ekspor_USD->ViewValue = FormatNumber($this->Nilai_Ekspor_USD->ViewValue, 2, -2, -2, -2);
		$this->Nilai_Ekspor_USD->ViewCustomAttributes = "";

		// Nilai_Ekspor_Rupiah
		$this->Nilai_Ekspor_Rupiah->ViewValue = $this->Nilai_Ekspor_Rupiah->CurrentValue;
		$this->Nilai_Ekspor_Rupiah->ViewValue = FormatNumber($this->Nilai_Ekspor_Rupiah->ViewValue, 2, -2, -2, -2);
		$this->Nilai_Ekspor_Rupiah->ViewCustomAttributes = "";

		// Tgl_Bln_Ekspor
		$this->Tgl_Bln_Ekspor->ViewValue = $this->Tgl_Bln_Ekspor->CurrentValue;
		$this->Tgl_Bln_Ekspor->ViewCustomAttributes = "";

		// Tahun_Ekspor
		$curVal = strval($this->Tahun_Ekspor->CurrentValue);
		if ($curVal != "") {
			$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->lookupCacheOption($curVal);
			if ($this->Tahun_Ekspor->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`tahun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`tahun` > 2010";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Tahun_Ekspor->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Tahun_Ekspor->ViewValue = $this->Tahun_Ekspor->CurrentValue;
				}
			}
		} else {
			$this->Tahun_Ekspor->ViewValue = NULL;
		}
		$this->Tahun_Ekspor->ViewCustomAttributes = "";

		// Negara_Tujuan
		$curVal = strval($this->Negara_Tujuan->CurrentValue);
		if ($curVal != "") {
			$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->lookupCacheOption($curVal);
			if ($this->Negara_Tujuan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`negara`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->Negara_Tujuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Negara_Tujuan->ViewValue = $this->Negara_Tujuan->CurrentValue;
				}
			}
		} else {
			$this->Negara_Tujuan->ViewValue = NULL;
		}
		$this->Negara_Tujuan->ViewCustomAttributes = "";

		// ID_ECP
		$this->ID_ECP->LinkCustomAttributes = "";
		$this->ID_ECP->HrefValue = "";
		$this->ID_ECP->TooltipValue = "";

		// Wilayah_ECP
		$this->Wilayah_ECP->LinkCustomAttributes = "";
		$this->Wilayah_ECP->HrefValue = "";
		$this->Wilayah_ECP->TooltipValue = "";

		// Tahun_ECP
		$this->Tahun_ECP->LinkCustomAttributes = "";
		$this->Tahun_ECP->HrefValue = "";
		$this->Tahun_ECP->TooltipValue = "";

		// Nama
		$this->Nama->LinkCustomAttributes = "";
		$this->Nama->HrefValue = "";
		$this->Nama->TooltipValue = "";

		// Perusahaan
		$this->Perusahaan->LinkCustomAttributes = "";
		$this->Perusahaan->HrefValue = "";
		$this->Perusahaan->TooltipValue = "";

		// Produk
		$this->Produk->LinkCustomAttributes = "";
		$this->Produk->HrefValue = "";
		$this->Produk->TooltipValue = "";

		// Nilai_Ekspor_USD
		$this->Nilai_Ekspor_USD->LinkCustomAttributes = "";
		$this->Nilai_Ekspor_USD->HrefValue = "";
		$this->Nilai_Ekspor_USD->TooltipValue = "";

		// Nilai_Ekspor_Rupiah
		$this->Nilai_Ekspor_Rupiah->LinkCustomAttributes = "";
		$this->Nilai_Ekspor_Rupiah->HrefValue = "";
		$this->Nilai_Ekspor_Rupiah->TooltipValue = "";

		// Tgl_Bln_Ekspor
		$this->Tgl_Bln_Ekspor->LinkCustomAttributes = "";
		$this->Tgl_Bln_Ekspor->HrefValue = "";
		$this->Tgl_Bln_Ekspor->TooltipValue = "";

		// Tahun_Ekspor
		$this->Tahun_Ekspor->LinkCustomAttributes = "";
		$this->Tahun_Ekspor->HrefValue = "";
		$this->Tahun_Ekspor->TooltipValue = "";

		// Negara_Tujuan
		$this->Negara_Tujuan->LinkCustomAttributes = "";
		$this->Negara_Tujuan->HrefValue = "";
		$this->Negara_Tujuan->TooltipValue = "";

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

		// ID_ECP
		$this->ID_ECP->EditAttrs["class"] = "form-control";
		$this->ID_ECP->EditCustomAttributes = "";
		$this->ID_ECP->EditValue = $this->ID_ECP->CurrentValue;
		$this->ID_ECP->PlaceHolder = RemoveHtml($this->ID_ECP->caption());

		// Wilayah_ECP
		$this->Wilayah_ECP->EditAttrs["class"] = "form-control";
		$this->Wilayah_ECP->EditCustomAttributes = "";

		// Tahun_ECP
		$this->Tahun_ECP->EditAttrs["class"] = "form-control";
		$this->Tahun_ECP->EditCustomAttributes = "";
		$this->Tahun_ECP->EditValue = $this->Tahun_ECP->CurrentValue;
		$this->Tahun_ECP->PlaceHolder = RemoveHtml($this->Tahun_ECP->caption());

		// Nama
		$this->Nama->EditAttrs["class"] = "form-control";
		$this->Nama->EditCustomAttributes = "";
		if (!$this->Nama->Raw)
			$this->Nama->CurrentValue = HtmlDecode($this->Nama->CurrentValue);
		$this->Nama->EditValue = $this->Nama->CurrentValue;
		$this->Nama->PlaceHolder = RemoveHtml($this->Nama->caption());

		// Perusahaan
		$this->Perusahaan->EditAttrs["class"] = "form-control";
		$this->Perusahaan->EditCustomAttributes = "";
		if (!$this->Perusahaan->Raw)
			$this->Perusahaan->CurrentValue = HtmlDecode($this->Perusahaan->CurrentValue);
		$this->Perusahaan->EditValue = $this->Perusahaan->CurrentValue;
		$this->Perusahaan->PlaceHolder = RemoveHtml($this->Perusahaan->caption());

		// Produk
		$this->Produk->EditAttrs["class"] = "form-control";
		$this->Produk->EditCustomAttributes = "";
		if (!$this->Produk->Raw)
			$this->Produk->CurrentValue = HtmlDecode($this->Produk->CurrentValue);
		$this->Produk->EditValue = $this->Produk->CurrentValue;
		$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

		// Nilai_Ekspor_USD
		$this->Nilai_Ekspor_USD->EditAttrs["class"] = "form-control";
		$this->Nilai_Ekspor_USD->EditCustomAttributes = "";
		$this->Nilai_Ekspor_USD->EditValue = $this->Nilai_Ekspor_USD->CurrentValue;
		$this->Nilai_Ekspor_USD->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_USD->caption());
		if (strval($this->Nilai_Ekspor_USD->EditValue) != "" && is_numeric($this->Nilai_Ekspor_USD->EditValue))
			$this->Nilai_Ekspor_USD->EditValue = FormatNumber($this->Nilai_Ekspor_USD->EditValue, -2, -2, -2, -2);
		

		// Nilai_Ekspor_Rupiah
		$this->Nilai_Ekspor_Rupiah->EditAttrs["class"] = "form-control";
		$this->Nilai_Ekspor_Rupiah->EditCustomAttributes = "";
		$this->Nilai_Ekspor_Rupiah->EditValue = $this->Nilai_Ekspor_Rupiah->CurrentValue;
		$this->Nilai_Ekspor_Rupiah->PlaceHolder = RemoveHtml($this->Nilai_Ekspor_Rupiah->caption());
		if (strval($this->Nilai_Ekspor_Rupiah->EditValue) != "" && is_numeric($this->Nilai_Ekspor_Rupiah->EditValue))
			$this->Nilai_Ekspor_Rupiah->EditValue = FormatNumber($this->Nilai_Ekspor_Rupiah->EditValue, -2, -2, -2, -2);
		

		// Tgl_Bln_Ekspor
		$this->Tgl_Bln_Ekspor->EditAttrs["class"] = "form-control";
		$this->Tgl_Bln_Ekspor->EditCustomAttributes = "";
		if (!$this->Tgl_Bln_Ekspor->Raw)
			$this->Tgl_Bln_Ekspor->CurrentValue = HtmlDecode($this->Tgl_Bln_Ekspor->CurrentValue);
		$this->Tgl_Bln_Ekspor->EditValue = $this->Tgl_Bln_Ekspor->CurrentValue;
		$this->Tgl_Bln_Ekspor->PlaceHolder = RemoveHtml($this->Tgl_Bln_Ekspor->caption());

		// Tahun_Ekspor
		$this->Tahun_Ekspor->EditAttrs["class"] = "form-control";
		$this->Tahun_Ekspor->EditCustomAttributes = "";

		// Negara_Tujuan
		$this->Negara_Tujuan->EditAttrs["class"] = "form-control";
		$this->Negara_Tujuan->EditCustomAttributes = "";

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
					$doc->exportCaption($this->ID_ECP);
					$doc->exportCaption($this->Nama);
					$doc->exportCaption($this->Perusahaan);
					$doc->exportCaption($this->Produk);
					$doc->exportCaption($this->Nilai_Ekspor_USD);
					$doc->exportCaption($this->Nilai_Ekspor_Rupiah);
					$doc->exportCaption($this->Tgl_Bln_Ekspor);
					$doc->exportCaption($this->Tahun_Ekspor);
					$doc->exportCaption($this->Negara_Tujuan);
				} else {
					$doc->exportCaption($this->ID_ECP);
					$doc->exportCaption($this->Wilayah_ECP);
					$doc->exportCaption($this->Tahun_ECP);
					$doc->exportCaption($this->Nama);
					$doc->exportCaption($this->Perusahaan);
					$doc->exportCaption($this->Produk);
					$doc->exportCaption($this->Nilai_Ekspor_USD);
					$doc->exportCaption($this->Nilai_Ekspor_Rupiah);
					$doc->exportCaption($this->Tgl_Bln_Ekspor);
					$doc->exportCaption($this->Tahun_Ekspor);
					$doc->exportCaption($this->Negara_Tujuan);
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
						$doc->exportField($this->ID_ECP);
						$doc->exportField($this->Nama);
						$doc->exportField($this->Perusahaan);
						$doc->exportField($this->Produk);
						$doc->exportField($this->Nilai_Ekspor_USD);
						$doc->exportField($this->Nilai_Ekspor_Rupiah);
						$doc->exportField($this->Tgl_Bln_Ekspor);
						$doc->exportField($this->Tahun_Ekspor);
						$doc->exportField($this->Negara_Tujuan);
					} else {
						$doc->exportField($this->ID_ECP);
						$doc->exportField($this->Wilayah_ECP);
						$doc->exportField($this->Tahun_ECP);
						$doc->exportField($this->Nama);
						$doc->exportField($this->Perusahaan);
						$doc->exportField($this->Produk);
						$doc->exportField($this->Nilai_Ekspor_USD);
						$doc->exportField($this->Nilai_Ekspor_Rupiah);
						$doc->exportField($this->Tgl_Bln_Ekspor);
						$doc->exportField($this->Tahun_Ekspor);
						$doc->exportField($this->Negara_Tujuan);
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