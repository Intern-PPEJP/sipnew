<?php namespace PHPMaker2020\input_ecp; ?>
<?php

/**
 * Table class for dm_pesertaecp
 */
class dm_pesertaecp extends DbTable
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
	public $ID_Unik;
	public $Nama;
	public $Perusahaan;
	public $Alamat;
	public $Produk;
	public $Kapasitas_Produksi;
	public $Omset;
	public $Jumlah_Pegawai;
	public $Legalitas_Perusahaan;
	public $Sertifikasi_dimiliki;
	public $Handphone;
	public $Email_Add;
	public $Website;
	public $Tahun_Berdiri;
	public $Alamat_Produksi;
	public $Wilayah_ECP;
	public $Tahun_ECP;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'dm_pesertaecp';
		$this->TableName = 'dm_pesertaecp';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`dm_pesertaecp`";
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
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ID_Unik
		$this->ID_Unik = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_ID_Unik', 'ID_Unik', '`ID_Unik`', '`ID_Unik`', 3, 9, -1, FALSE, '`ID_Unik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_Unik->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_Unik->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_Unik->Sortable = TRUE; // Allow sort
		$this->ID_Unik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Unik'] = &$this->ID_Unik;

		// Nama
		$this->Nama = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Nama', 'Nama', '`Nama`', '`Nama`', 200, 200, -1, FALSE, '`Nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nama->Nullable = FALSE; // NOT NULL field
		$this->Nama->Required = TRUE; // Required field
		$this->Nama->Sortable = TRUE; // Allow sort
		$this->fields['Nama'] = &$this->Nama;

		// Perusahaan
		$this->Perusahaan = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Perusahaan', 'Perusahaan', '`Perusahaan`', '`Perusahaan`', 200, 255, -1, FALSE, '`Perusahaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Perusahaan->Nullable = FALSE; // NOT NULL field
		$this->Perusahaan->Required = TRUE; // Required field
		$this->Perusahaan->Sortable = TRUE; // Allow sort
		$this->fields['Perusahaan'] = &$this->Perusahaan;

		// Alamat
		$this->Alamat = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Alamat', 'Alamat', '`Alamat`', '`Alamat`', 201, 65535, -1, FALSE, '`Alamat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Alamat->Sortable = TRUE; // Allow sort
		$this->fields['Alamat'] = &$this->Alamat;

		// Produk
		$this->Produk = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Produk', 'Produk', '`Produk`', '`Produk`', 200, 255, -1, FALSE, '`Produk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Produk->Sortable = TRUE; // Allow sort
		$this->fields['Produk'] = &$this->Produk;

		// Kapasitas_Produksi
		$this->Kapasitas_Produksi = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Kapasitas_Produksi', 'Kapasitas_Produksi', '`Kapasitas_Produksi`', '`Kapasitas_Produksi`', 200, 255, -1, FALSE, '`Kapasitas_Produksi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Kapasitas_Produksi->Sortable = TRUE; // Allow sort
		$this->fields['Kapasitas_Produksi'] = &$this->Kapasitas_Produksi;

		// Omset
		$this->Omset = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Omset', 'Omset', '`Omset`', '`Omset`', 200, 100, -1, FALSE, '`Omset`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Omset->Sortable = TRUE; // Allow sort
		$this->fields['Omset'] = &$this->Omset;

		// Jumlah_Pegawai
		$this->Jumlah_Pegawai = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Jumlah_Pegawai', 'Jumlah_Pegawai', '`Jumlah_Pegawai`', '`Jumlah_Pegawai`', 200, 20, -1, FALSE, '`Jumlah_Pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Jumlah_Pegawai->Sortable = TRUE; // Allow sort
		$this->fields['Jumlah_Pegawai'] = &$this->Jumlah_Pegawai;

		// Legalitas_Perusahaan
		$this->Legalitas_Perusahaan = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Legalitas_Perusahaan', 'Legalitas_Perusahaan', '`Legalitas_Perusahaan`', '`Legalitas_Perusahaan`', 200, 200, -1, FALSE, '`Legalitas_Perusahaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Legalitas_Perusahaan->Sortable = TRUE; // Allow sort
		$this->fields['Legalitas_Perusahaan'] = &$this->Legalitas_Perusahaan;

		// Sertifikasi_dimiliki
		$this->Sertifikasi_dimiliki = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Sertifikasi_dimiliki', 'Sertifikasi_dimiliki', '`Sertifikasi_dimiliki`', '`Sertifikasi_dimiliki`', 200, 200, -1, FALSE, '`Sertifikasi_dimiliki`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sertifikasi_dimiliki->Sortable = TRUE; // Allow sort
		$this->fields['Sertifikasi_dimiliki'] = &$this->Sertifikasi_dimiliki;

		// Handphone
		$this->Handphone = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Handphone', 'Handphone', '`Handphone`', '`Handphone`', 200, 25, -1, FALSE, '`Handphone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Handphone->Sortable = TRUE; // Allow sort
		$this->fields['Handphone'] = &$this->Handphone;

		// Email_Add
		$this->Email_Add = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Email_Add', 'Email_Add', '`Email_Add`', '`Email_Add`', 200, 100, -1, FALSE, '`Email_Add`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Email_Add->Sortable = TRUE; // Allow sort
		$this->fields['Email_Add'] = &$this->Email_Add;

		// Website
		$this->Website = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Website', 'Website', '`Website`', '`Website`', 200, 100, -1, FALSE, '`Website`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Website->Sortable = TRUE; // Allow sort
		$this->fields['Website'] = &$this->Website;

		// Tahun_Berdiri
		$this->Tahun_Berdiri = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Tahun_Berdiri', 'Tahun_Berdiri', '`Tahun_Berdiri`', '`Tahun_Berdiri`', 200, 100, -1, FALSE, '`Tahun_Berdiri`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tahun_Berdiri->Sortable = TRUE; // Allow sort
		$this->fields['Tahun_Berdiri'] = &$this->Tahun_Berdiri;

		// Alamat_Produksi
		$this->Alamat_Produksi = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Alamat_Produksi', 'Alamat_Produksi', '`Alamat_Produksi`', '`Alamat_Produksi`', 201, 65535, -1, FALSE, '`Alamat_Produksi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Alamat_Produksi->Sortable = TRUE; // Allow sort
		$this->fields['Alamat_Produksi'] = &$this->Alamat_Produksi;

		// Wilayah_ECP
		$this->Wilayah_ECP = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Wilayah_ECP', 'Wilayah_ECP', '`Wilayah_ECP`', '`Wilayah_ECP`', 200, 100, -1, FALSE, '`Wilayah_ECP`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Wilayah_ECP->Nullable = FALSE; // NOT NULL field
		$this->Wilayah_ECP->Required = TRUE; // Required field
		$this->Wilayah_ECP->Sortable = TRUE; // Allow sort
		$this->Wilayah_ECP->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Wilayah_ECP->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Wilayah_ECP->Lookup = new Lookup('Wilayah_ECP', 'dm_pesertaecp', TRUE, 'Wilayah_ECP', ["Wilayah_ECP","","",""], [], [], [], [], [], [], '', '');
		$this->fields['Wilayah_ECP'] = &$this->Wilayah_ECP;

		// Tahun_ECP
		$this->Tahun_ECP = new DbField('dm_pesertaecp', 'dm_pesertaecp', 'x_Tahun_ECP', 'Tahun_ECP', '`Tahun_ECP`', '`Tahun_ECP`', 2, 4, -1, FALSE, '`Tahun_ECP`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tahun_ECP->Nullable = FALSE; // NOT NULL field
		$this->Tahun_ECP->Required = TRUE; // Required field
		$this->Tahun_ECP->Sortable = TRUE; // Allow sort
		$this->Tahun_ECP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Tahun_ECP'] = &$this->Tahun_ECP;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`dm_pesertaecp`";
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
			$this->ID_Unik->setDbValue($conn->insert_ID());
			$rs['ID_Unik'] = $this->ID_Unik->DbValue;
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
			if (array_key_exists('ID_Unik', $rs))
				AddFilter($where, QuotedName('ID_Unik', $this->Dbid) . '=' . QuotedValue($rs['ID_Unik'], $this->ID_Unik->DataType, $this->Dbid));
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
		$this->ID_Unik->DbValue = $row['ID_Unik'];
		$this->Nama->DbValue = $row['Nama'];
		$this->Perusahaan->DbValue = $row['Perusahaan'];
		$this->Alamat->DbValue = $row['Alamat'];
		$this->Produk->DbValue = $row['Produk'];
		$this->Kapasitas_Produksi->DbValue = $row['Kapasitas_Produksi'];
		$this->Omset->DbValue = $row['Omset'];
		$this->Jumlah_Pegawai->DbValue = $row['Jumlah_Pegawai'];
		$this->Legalitas_Perusahaan->DbValue = $row['Legalitas_Perusahaan'];
		$this->Sertifikasi_dimiliki->DbValue = $row['Sertifikasi_dimiliki'];
		$this->Handphone->DbValue = $row['Handphone'];
		$this->Email_Add->DbValue = $row['Email_Add'];
		$this->Website->DbValue = $row['Website'];
		$this->Tahun_Berdiri->DbValue = $row['Tahun_Berdiri'];
		$this->Alamat_Produksi->DbValue = $row['Alamat_Produksi'];
		$this->Wilayah_ECP->DbValue = $row['Wilayah_ECP'];
		$this->Tahun_ECP->DbValue = $row['Tahun_ECP'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_Unik` = @ID_Unik@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ID_Unik', $row) ? $row['ID_Unik'] : NULL;
		else
			$val = $this->ID_Unik->OldValue !== NULL ? $this->ID_Unik->OldValue : $this->ID_Unik->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_Unik@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "dm_pesertaecplist.php";
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
		if ($pageName == "dm_pesertaecpview.php")
			return $Language->phrase("View");
		elseif ($pageName == "dm_pesertaecpedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "dm_pesertaecpadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "dm_pesertaecplist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("dm_pesertaecpview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("dm_pesertaecpview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "dm_pesertaecpadd.php?" . $this->getUrlParm($parm);
		else
			$url = "dm_pesertaecpadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("dm_pesertaecpedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("dm_pesertaecpadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("dm_pesertaecpdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_Unik:" . JsonEncode($this->ID_Unik->CurrentValue, "number");
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
		if ($this->ID_Unik->CurrentValue != NULL) {
			$url .= "ID_Unik=" . urlencode($this->ID_Unik->CurrentValue);
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
			if (Param("ID_Unik") !== NULL)
				$arKeys[] = Param("ID_Unik");
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
				$this->ID_Unik->CurrentValue = $key;
			else
				$this->ID_Unik->OldValue = $key;
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
		$this->ID_Unik->setDbValue($rs->fields('ID_Unik'));
		$this->Nama->setDbValue($rs->fields('Nama'));
		$this->Perusahaan->setDbValue($rs->fields('Perusahaan'));
		$this->Alamat->setDbValue($rs->fields('Alamat'));
		$this->Produk->setDbValue($rs->fields('Produk'));
		$this->Kapasitas_Produksi->setDbValue($rs->fields('Kapasitas_Produksi'));
		$this->Omset->setDbValue($rs->fields('Omset'));
		$this->Jumlah_Pegawai->setDbValue($rs->fields('Jumlah_Pegawai'));
		$this->Legalitas_Perusahaan->setDbValue($rs->fields('Legalitas_Perusahaan'));
		$this->Sertifikasi_dimiliki->setDbValue($rs->fields('Sertifikasi_dimiliki'));
		$this->Handphone->setDbValue($rs->fields('Handphone'));
		$this->Email_Add->setDbValue($rs->fields('Email_Add'));
		$this->Website->setDbValue($rs->fields('Website'));
		$this->Tahun_Berdiri->setDbValue($rs->fields('Tahun_Berdiri'));
		$this->Alamat_Produksi->setDbValue($rs->fields('Alamat_Produksi'));
		$this->Wilayah_ECP->setDbValue($rs->fields('Wilayah_ECP'));
		$this->Tahun_ECP->setDbValue($rs->fields('Tahun_ECP'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_Unik
		// Nama
		// Perusahaan
		// Alamat
		// Produk
		// Kapasitas_Produksi
		// Omset
		// Jumlah_Pegawai
		// Legalitas_Perusahaan
		// Sertifikasi_dimiliki
		// Handphone
		// Email_Add
		// Website
		// Tahun_Berdiri
		// Alamat_Produksi
		// Wilayah_ECP
		// Tahun_ECP
		// ID_Unik

		$this->ID_Unik->ViewValue = $this->ID_Unik->CurrentValue;
		$this->ID_Unik->ViewCustomAttributes = "";

		// Nama
		$this->Nama->ViewValue = $this->Nama->CurrentValue;
		$this->Nama->ViewCustomAttributes = "";

		// Perusahaan
		$this->Perusahaan->ViewValue = $this->Perusahaan->CurrentValue;
		$this->Perusahaan->ViewCustomAttributes = "";

		// Alamat
		$this->Alamat->ViewValue = $this->Alamat->CurrentValue;
		$this->Alamat->ViewCustomAttributes = "";

		// Produk
		$this->Produk->ViewValue = $this->Produk->CurrentValue;
		$this->Produk->ViewCustomAttributes = "";

		// Kapasitas_Produksi
		$this->Kapasitas_Produksi->ViewValue = $this->Kapasitas_Produksi->CurrentValue;
		$this->Kapasitas_Produksi->ViewCustomAttributes = "";

		// Omset
		$this->Omset->ViewValue = $this->Omset->CurrentValue;
		$this->Omset->ViewCustomAttributes = "";

		// Jumlah_Pegawai
		$this->Jumlah_Pegawai->ViewValue = $this->Jumlah_Pegawai->CurrentValue;
		$this->Jumlah_Pegawai->ViewCustomAttributes = "";

		// Legalitas_Perusahaan
		$this->Legalitas_Perusahaan->ViewValue = $this->Legalitas_Perusahaan->CurrentValue;
		$this->Legalitas_Perusahaan->ViewCustomAttributes = "";

		// Sertifikasi_dimiliki
		$this->Sertifikasi_dimiliki->ViewValue = $this->Sertifikasi_dimiliki->CurrentValue;
		$this->Sertifikasi_dimiliki->ViewCustomAttributes = "";

		// Handphone
		$this->Handphone->ViewValue = $this->Handphone->CurrentValue;
		$this->Handphone->ViewCustomAttributes = "";

		// Email_Add
		$this->Email_Add->ViewValue = $this->Email_Add->CurrentValue;
		$this->Email_Add->ViewCustomAttributes = "";

		// Website
		$this->Website->ViewValue = $this->Website->CurrentValue;
		$this->Website->ViewCustomAttributes = "";

		// Tahun_Berdiri
		$this->Tahun_Berdiri->ViewValue = $this->Tahun_Berdiri->CurrentValue;
		$this->Tahun_Berdiri->ViewCustomAttributes = "";

		// Alamat_Produksi
		$this->Alamat_Produksi->ViewValue = $this->Alamat_Produksi->CurrentValue;
		$this->Alamat_Produksi->ViewCustomAttributes = "";

		// Wilayah_ECP
		$arwrk = [];
		$arwrk[1] = $this->Wilayah_ECP->CurrentValue;
		$this->Wilayah_ECP->ViewValue = $this->Wilayah_ECP->displayValue($arwrk);
		$this->Wilayah_ECP->ViewCustomAttributes = "";

		// Tahun_ECP
		$this->Tahun_ECP->ViewValue = $this->Tahun_ECP->CurrentValue;
		$this->Tahun_ECP->ViewValue = FormatNumber($this->Tahun_ECP->ViewValue, 0, -2, -2, -2);
		$this->Tahun_ECP->ViewCustomAttributes = "";

		// ID_Unik
		$this->ID_Unik->LinkCustomAttributes = "";
		$this->ID_Unik->HrefValue = "";
		$this->ID_Unik->TooltipValue = "";

		// Nama
		$this->Nama->LinkCustomAttributes = "";
		$this->Nama->HrefValue = "";
		$this->Nama->TooltipValue = "";

		// Perusahaan
		$this->Perusahaan->LinkCustomAttributes = "";
		$this->Perusahaan->HrefValue = "";
		$this->Perusahaan->TooltipValue = "";

		// Alamat
		$this->Alamat->LinkCustomAttributes = "";
		$this->Alamat->HrefValue = "";
		$this->Alamat->TooltipValue = "";

		// Produk
		$this->Produk->LinkCustomAttributes = "";
		$this->Produk->HrefValue = "";
		$this->Produk->TooltipValue = "";

		// Kapasitas_Produksi
		$this->Kapasitas_Produksi->LinkCustomAttributes = "";
		$this->Kapasitas_Produksi->HrefValue = "";
		$this->Kapasitas_Produksi->TooltipValue = "";

		// Omset
		$this->Omset->LinkCustomAttributes = "";
		$this->Omset->HrefValue = "";
		$this->Omset->TooltipValue = "";

		// Jumlah_Pegawai
		$this->Jumlah_Pegawai->LinkCustomAttributes = "";
		$this->Jumlah_Pegawai->HrefValue = "";
		$this->Jumlah_Pegawai->TooltipValue = "";

		// Legalitas_Perusahaan
		$this->Legalitas_Perusahaan->LinkCustomAttributes = "";
		$this->Legalitas_Perusahaan->HrefValue = "";
		$this->Legalitas_Perusahaan->TooltipValue = "";

		// Sertifikasi_dimiliki
		$this->Sertifikasi_dimiliki->LinkCustomAttributes = "";
		$this->Sertifikasi_dimiliki->HrefValue = "";
		$this->Sertifikasi_dimiliki->TooltipValue = "";

		// Handphone
		$this->Handphone->LinkCustomAttributes = "";
		$this->Handphone->HrefValue = "";
		$this->Handphone->TooltipValue = "";

		// Email_Add
		$this->Email_Add->LinkCustomAttributes = "";
		$this->Email_Add->HrefValue = "";
		$this->Email_Add->TooltipValue = "";

		// Website
		$this->Website->LinkCustomAttributes = "";
		$this->Website->HrefValue = "";
		$this->Website->TooltipValue = "";

		// Tahun_Berdiri
		$this->Tahun_Berdiri->LinkCustomAttributes = "";
		$this->Tahun_Berdiri->HrefValue = "";
		$this->Tahun_Berdiri->TooltipValue = "";

		// Alamat_Produksi
		$this->Alamat_Produksi->LinkCustomAttributes = "";
		$this->Alamat_Produksi->HrefValue = "";
		$this->Alamat_Produksi->TooltipValue = "";

		// Wilayah_ECP
		$this->Wilayah_ECP->LinkCustomAttributes = "";
		$this->Wilayah_ECP->HrefValue = "";
		$this->Wilayah_ECP->TooltipValue = "";

		// Tahun_ECP
		$this->Tahun_ECP->LinkCustomAttributes = "";
		$this->Tahun_ECP->HrefValue = "";
		$this->Tahun_ECP->TooltipValue = "";

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

		// ID_Unik
		$this->ID_Unik->EditAttrs["class"] = "form-control";
		$this->ID_Unik->EditCustomAttributes = "";
		$this->ID_Unik->EditValue = $this->ID_Unik->CurrentValue;
		$this->ID_Unik->ViewCustomAttributes = "";

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

		// Alamat
		$this->Alamat->EditAttrs["class"] = "form-control";
		$this->Alamat->EditCustomAttributes = "";
		$this->Alamat->EditValue = $this->Alamat->CurrentValue;
		$this->Alamat->PlaceHolder = RemoveHtml($this->Alamat->caption());

		// Produk
		$this->Produk->EditAttrs["class"] = "form-control";
		$this->Produk->EditCustomAttributes = "";
		if (!$this->Produk->Raw)
			$this->Produk->CurrentValue = HtmlDecode($this->Produk->CurrentValue);
		$this->Produk->EditValue = $this->Produk->CurrentValue;
		$this->Produk->PlaceHolder = RemoveHtml($this->Produk->caption());

		// Kapasitas_Produksi
		$this->Kapasitas_Produksi->EditAttrs["class"] = "form-control";
		$this->Kapasitas_Produksi->EditCustomAttributes = "";
		if (!$this->Kapasitas_Produksi->Raw)
			$this->Kapasitas_Produksi->CurrentValue = HtmlDecode($this->Kapasitas_Produksi->CurrentValue);
		$this->Kapasitas_Produksi->EditValue = $this->Kapasitas_Produksi->CurrentValue;
		$this->Kapasitas_Produksi->PlaceHolder = RemoveHtml($this->Kapasitas_Produksi->caption());

		// Omset
		$this->Omset->EditAttrs["class"] = "form-control";
		$this->Omset->EditCustomAttributes = "";
		if (!$this->Omset->Raw)
			$this->Omset->CurrentValue = HtmlDecode($this->Omset->CurrentValue);
		$this->Omset->EditValue = $this->Omset->CurrentValue;
		$this->Omset->PlaceHolder = RemoveHtml($this->Omset->caption());

		// Jumlah_Pegawai
		$this->Jumlah_Pegawai->EditAttrs["class"] = "form-control";
		$this->Jumlah_Pegawai->EditCustomAttributes = "";
		if (!$this->Jumlah_Pegawai->Raw)
			$this->Jumlah_Pegawai->CurrentValue = HtmlDecode($this->Jumlah_Pegawai->CurrentValue);
		$this->Jumlah_Pegawai->EditValue = $this->Jumlah_Pegawai->CurrentValue;
		$this->Jumlah_Pegawai->PlaceHolder = RemoveHtml($this->Jumlah_Pegawai->caption());

		// Legalitas_Perusahaan
		$this->Legalitas_Perusahaan->EditAttrs["class"] = "form-control";
		$this->Legalitas_Perusahaan->EditCustomAttributes = "";
		if (!$this->Legalitas_Perusahaan->Raw)
			$this->Legalitas_Perusahaan->CurrentValue = HtmlDecode($this->Legalitas_Perusahaan->CurrentValue);
		$this->Legalitas_Perusahaan->EditValue = $this->Legalitas_Perusahaan->CurrentValue;
		$this->Legalitas_Perusahaan->PlaceHolder = RemoveHtml($this->Legalitas_Perusahaan->caption());

		// Sertifikasi_dimiliki
		$this->Sertifikasi_dimiliki->EditAttrs["class"] = "form-control";
		$this->Sertifikasi_dimiliki->EditCustomAttributes = "";
		if (!$this->Sertifikasi_dimiliki->Raw)
			$this->Sertifikasi_dimiliki->CurrentValue = HtmlDecode($this->Sertifikasi_dimiliki->CurrentValue);
		$this->Sertifikasi_dimiliki->EditValue = $this->Sertifikasi_dimiliki->CurrentValue;
		$this->Sertifikasi_dimiliki->PlaceHolder = RemoveHtml($this->Sertifikasi_dimiliki->caption());

		// Handphone
		$this->Handphone->EditAttrs["class"] = "form-control";
		$this->Handphone->EditCustomAttributes = "";
		if (!$this->Handphone->Raw)
			$this->Handphone->CurrentValue = HtmlDecode($this->Handphone->CurrentValue);
		$this->Handphone->EditValue = $this->Handphone->CurrentValue;
		$this->Handphone->PlaceHolder = RemoveHtml($this->Handphone->caption());

		// Email_Add
		$this->Email_Add->EditAttrs["class"] = "form-control";
		$this->Email_Add->EditCustomAttributes = "";
		if (!$this->Email_Add->Raw)
			$this->Email_Add->CurrentValue = HtmlDecode($this->Email_Add->CurrentValue);
		$this->Email_Add->EditValue = $this->Email_Add->CurrentValue;
		$this->Email_Add->PlaceHolder = RemoveHtml($this->Email_Add->caption());

		// Website
		$this->Website->EditAttrs["class"] = "form-control";
		$this->Website->EditCustomAttributes = "";
		if (!$this->Website->Raw)
			$this->Website->CurrentValue = HtmlDecode($this->Website->CurrentValue);
		$this->Website->EditValue = $this->Website->CurrentValue;
		$this->Website->PlaceHolder = RemoveHtml($this->Website->caption());

		// Tahun_Berdiri
		$this->Tahun_Berdiri->EditAttrs["class"] = "form-control";
		$this->Tahun_Berdiri->EditCustomAttributes = "";
		if (!$this->Tahun_Berdiri->Raw)
			$this->Tahun_Berdiri->CurrentValue = HtmlDecode($this->Tahun_Berdiri->CurrentValue);
		$this->Tahun_Berdiri->EditValue = $this->Tahun_Berdiri->CurrentValue;
		$this->Tahun_Berdiri->PlaceHolder = RemoveHtml($this->Tahun_Berdiri->caption());

		// Alamat_Produksi
		$this->Alamat_Produksi->EditAttrs["class"] = "form-control";
		$this->Alamat_Produksi->EditCustomAttributes = "";
		$this->Alamat_Produksi->EditValue = $this->Alamat_Produksi->CurrentValue;
		$this->Alamat_Produksi->PlaceHolder = RemoveHtml($this->Alamat_Produksi->caption());

		// Wilayah_ECP
		$this->Wilayah_ECP->EditAttrs["class"] = "form-control";
		$this->Wilayah_ECP->EditCustomAttributes = "";

		// Tahun_ECP
		$this->Tahun_ECP->EditAttrs["class"] = "form-control";
		$this->Tahun_ECP->EditCustomAttributes = "";
		$this->Tahun_ECP->EditValue = $this->Tahun_ECP->CurrentValue;
		$this->Tahun_ECP->PlaceHolder = RemoveHtml($this->Tahun_ECP->caption());

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
					$doc->exportCaption($this->ID_Unik);
					$doc->exportCaption($this->Nama);
					$doc->exportCaption($this->Perusahaan);
					$doc->exportCaption($this->Alamat);
					$doc->exportCaption($this->Produk);
					$doc->exportCaption($this->Kapasitas_Produksi);
					$doc->exportCaption($this->Omset);
					$doc->exportCaption($this->Jumlah_Pegawai);
					$doc->exportCaption($this->Legalitas_Perusahaan);
					$doc->exportCaption($this->Sertifikasi_dimiliki);
					$doc->exportCaption($this->Handphone);
					$doc->exportCaption($this->Email_Add);
					$doc->exportCaption($this->Website);
					$doc->exportCaption($this->Tahun_Berdiri);
					$doc->exportCaption($this->Alamat_Produksi);
					$doc->exportCaption($this->Wilayah_ECP);
					$doc->exportCaption($this->Tahun_ECP);
				} else {
					$doc->exportCaption($this->ID_Unik);
					$doc->exportCaption($this->Nama);
					$doc->exportCaption($this->Perusahaan);
					$doc->exportCaption($this->Produk);
					$doc->exportCaption($this->Kapasitas_Produksi);
					$doc->exportCaption($this->Omset);
					$doc->exportCaption($this->Jumlah_Pegawai);
					$doc->exportCaption($this->Legalitas_Perusahaan);
					$doc->exportCaption($this->Sertifikasi_dimiliki);
					$doc->exportCaption($this->Handphone);
					$doc->exportCaption($this->Email_Add);
					$doc->exportCaption($this->Website);
					$doc->exportCaption($this->Tahun_Berdiri);
					$doc->exportCaption($this->Wilayah_ECP);
					$doc->exportCaption($this->Tahun_ECP);
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
						$doc->exportField($this->ID_Unik);
						$doc->exportField($this->Nama);
						$doc->exportField($this->Perusahaan);
						$doc->exportField($this->Alamat);
						$doc->exportField($this->Produk);
						$doc->exportField($this->Kapasitas_Produksi);
						$doc->exportField($this->Omset);
						$doc->exportField($this->Jumlah_Pegawai);
						$doc->exportField($this->Legalitas_Perusahaan);
						$doc->exportField($this->Sertifikasi_dimiliki);
						$doc->exportField($this->Handphone);
						$doc->exportField($this->Email_Add);
						$doc->exportField($this->Website);
						$doc->exportField($this->Tahun_Berdiri);
						$doc->exportField($this->Alamat_Produksi);
						$doc->exportField($this->Wilayah_ECP);
						$doc->exportField($this->Tahun_ECP);
					} else {
						$doc->exportField($this->ID_Unik);
						$doc->exportField($this->Nama);
						$doc->exportField($this->Perusahaan);
						$doc->exportField($this->Produk);
						$doc->exportField($this->Kapasitas_Produksi);
						$doc->exportField($this->Omset);
						$doc->exportField($this->Jumlah_Pegawai);
						$doc->exportField($this->Legalitas_Perusahaan);
						$doc->exportField($this->Sertifikasi_dimiliki);
						$doc->exportField($this->Handphone);
						$doc->exportField($this->Email_Add);
						$doc->exportField($this->Website);
						$doc->exportField($this->Tahun_Berdiri);
						$doc->exportField($this->Wilayah_ECP);
						$doc->exportField($this->Tahun_ECP);
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

		if ($fld->Name == "Tahun_ECP"){
			$jmin = 2010; // tahun terlama
			$jmax = date("Y");
			for ($x = $jmin; $x<= $jmax; $x++) {
				echo "[".$x.", ".$x."],";
			}
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