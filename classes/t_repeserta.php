<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_repeserta
 */
class t_repeserta extends DbTable
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
	public $id;
	public $idpelat;
	public $kdjudul;
	public $tgl_pel;
	public $nama;
	public $perusahaan;
	public $jabatan;
	public $tgl_daftar;
	public $telp;
	public $fax;
	public $hp;
	public $produk;
	public $cara_bayar;
	public $ket_bayar;
	public $tgl_bayar;
	public $kdinformasi;
	public $konfirmasi;
	public $ket;
	public $updated_at;
	public $created_at;
	public $ket_lainnya;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_repeserta';
		$this->TableName = 't_repeserta';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_repeserta`";
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

		// id
		$this->id = new DbField('t_repeserta', 't_repeserta', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->Lookup = new Lookup('id', 't_repeserta', FALSE, 'id', ["nama","perusahaan","",""], [], [], [], [], [], [], '', '<i class=\'glyphicon glyphicon-user\'></i> {{:df1}} <strong style="color:#032a96;"><i class=\'glyphicon glyphicon-tower\'></i> {{:df2}}</strong>');
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// idpelat
		$this->idpelat = new DbField('t_repeserta', 't_repeserta', 'x_idpelat', 'idpelat', '`idpelat`', '`idpelat`', 3, 11, -1, FALSE, '`idpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idpelat->IsForeignKey = TRUE; // Foreign key field
		$this->idpelat->Nullable = FALSE; // NOT NULL field
		$this->idpelat->Required = TRUE; // Required field
		$this->idpelat->Sortable = TRUE; // Allow sort
		$this->idpelat->Lookup = new Lookup('idpelat', 'vt_pelatihan', FALSE, 'idpelat', ["judul","tawal","",""], [], [], [], [], [], [], '', '');
		$this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idpelat'] = &$this->idpelat;

		// kdjudul
		$this->kdjudul = new DbField('t_repeserta', 't_repeserta', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`kdjudul`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], ["x_tgl_pel"], [], [], [], [], '', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// tgl_pel
		$this->tgl_pel = new DbField('t_repeserta', 't_repeserta', 'x_tgl_pel', 'tgl_pel', '`tgl_pel`', CastDateFieldForLike("`tgl_pel`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_pel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_pel->Required = TRUE; // Required field
		$this->tgl_pel->Sortable = TRUE; // Allow sort
		$this->tgl_pel->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_pel'] = &$this->tgl_pel;

		// nama
		$this->nama = new DbField('t_repeserta', 't_repeserta', 'x_nama', 'nama', '`nama`', '`nama`', 200, 50, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// perusahaan
		$this->perusahaan = new DbField('t_repeserta', 't_repeserta', 'x_perusahaan', 'perusahaan', '`perusahaan`', '`perusahaan`', 200, 255, -1, FALSE, '`perusahaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->perusahaan->Sortable = TRUE; // Allow sort
		$this->fields['perusahaan'] = &$this->perusahaan;

		// jabatan
		$this->jabatan = new DbField('t_repeserta', 't_repeserta', 'x_jabatan', 'jabatan', '`jabatan`', '`jabatan`', 200, 50, -1, FALSE, '`jabatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jabatan->Sortable = TRUE; // Allow sort
		$this->jabatan->Lookup = new Lookup('jabatan', 't_jabatan', FALSE, 'kdjabat', ["jabatan","","",""], [], [], [], [], [], [], '', '');
		$this->fields['jabatan'] = &$this->jabatan;

		// tgl_daftar
		$this->tgl_daftar = new DbField('t_repeserta', 't_repeserta', 'x_tgl_daftar', 'tgl_daftar', '`tgl_daftar`', CastDateFieldForLike("`tgl_daftar`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_daftar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_daftar->Required = TRUE; // Required field
		$this->tgl_daftar->Sortable = TRUE; // Allow sort
		$this->tgl_daftar->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_daftar'] = &$this->tgl_daftar;

		// telp
		$this->telp = new DbField('t_repeserta', 't_repeserta', 'x_telp', 'telp', '`telp`', '`telp`', 200, 50, -1, FALSE, '`telp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telp->Sortable = TRUE; // Allow sort
		$this->fields['telp'] = &$this->telp;

		// fax
		$this->fax = new DbField('t_repeserta', 't_repeserta', 'x_fax', 'fax', '`fax`', '`fax`', 200, 50, -1, FALSE, '`fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fax->Sortable = TRUE; // Allow sort
		$this->fields['fax'] = &$this->fax;

		// hp
		$this->hp = new DbField('t_repeserta', 't_repeserta', 'x_hp', 'hp', '`hp`', '`hp`', 200, 50, -1, FALSE, '`hp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hp->Sortable = TRUE; // Allow sort
		$this->fields['hp'] = &$this->hp;

		// produk
		$this->produk = new DbField('t_repeserta', 't_repeserta', 'x_produk', 'produk', '`produk`', '`produk`', 200, 255, -1, FALSE, '`produk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->produk->Sortable = TRUE; // Allow sort
		$this->fields['produk'] = &$this->produk;

		// cara_bayar
		$this->cara_bayar = new DbField('t_repeserta', 't_repeserta', 'x_cara_bayar', 'cara_bayar', '`cara_bayar`', '`cara_bayar`', 200, 2, -1, FALSE, '`cara_bayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->cara_bayar->Sortable = TRUE; // Allow sort
		$this->cara_bayar->Lookup = new Lookup('cara_bayar', 't_repeserta', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->cara_bayar->OptionCount = 2;
		$this->fields['cara_bayar'] = &$this->cara_bayar;

		// ket_bayar
		$this->ket_bayar = new DbField('t_repeserta', 't_repeserta', 'x_ket_bayar', 'ket_bayar', '`ket_bayar`', '`ket_bayar`', 201, 65535, -1, FALSE, '`ket_bayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ket_bayar->Sortable = TRUE; // Allow sort
		$this->fields['ket_bayar'] = &$this->ket_bayar;

		// tgl_bayar
		$this->tgl_bayar = new DbField('t_repeserta', 't_repeserta', 'x_tgl_bayar', 'tgl_bayar', '`tgl_bayar`', CastDateFieldForLike("`tgl_bayar`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_bayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_bayar->Sortable = TRUE; // Allow sort
		$this->tgl_bayar->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_bayar'] = &$this->tgl_bayar;

		// kdinformasi
		$this->kdinformasi = new DbField('t_repeserta', 't_repeserta', 'x_kdinformasi', 'kdinformasi', '`kdinformasi`', '`kdinformasi`', 16, 2, -1, FALSE, '`kdinformasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdinformasi->Required = TRUE; // Required field
		$this->kdinformasi->Sortable = TRUE; // Allow sort
		$this->kdinformasi->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdinformasi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdinformasi->Lookup = new Lookup('kdinformasi', 't_informasi', FALSE, 'kdinformasi', ["informasi","","",""], [], [], [], [], [], [], '', '');
		$this->kdinformasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdinformasi'] = &$this->kdinformasi;

		// konfirmasi
		$this->konfirmasi = new DbField('t_repeserta', 't_repeserta', 'x_konfirmasi', 'konfirmasi', '`konfirmasi`', '`konfirmasi`', 200, 2, -1, FALSE, '`konfirmasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->konfirmasi->Required = TRUE; // Required field
		$this->konfirmasi->Sortable = TRUE; // Allow sort
		$this->konfirmasi->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->konfirmasi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->konfirmasi->Lookup = new Lookup('konfirmasi', 't_repeserta', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->konfirmasi->OptionCount = 3;
		$this->fields['konfirmasi'] = &$this->konfirmasi;

		// ket
		$this->ket = new DbField('t_repeserta', 't_repeserta', 'x_ket', 'ket', '`ket`', '`ket`', 200, 2, -1, FALSE, '`ket`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ket->Sortable = TRUE; // Allow sort
		$this->ket->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ket->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ket->Lookup = new Lookup('ket', 't_repeserta', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ket->OptionCount = 7;
		$this->fields['ket'] = &$this->ket;

		// updated_at
		$this->updated_at = new DbField('t_repeserta', 't_repeserta', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// created_at
		$this->created_at = new DbField('t_repeserta', 't_repeserta', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// ket_lainnya
		$this->ket_lainnya = new DbField('t_repeserta', 't_repeserta', 'x_ket_lainnya', 'ket_lainnya', '`ket_lainnya`', '`ket_lainnya`', 201, 65535, -1, FALSE, '`ket_lainnya`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ket_lainnya->Sortable = TRUE; // Allow sort
		$this->fields['ket_lainnya'] = &$this->ket_lainnya;
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
		if ($this->getCurrentMasterTable() == "cv_pelrepes") {
			if ($this->idpelat->getSessionValue() != "")
				$masterFilter .= "t_pelatihan.idpelat=" . QuotedValue($this->idpelat->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "cv_pelrepes") {
			if ($this->idpelat->getSessionValue() != "")
				$detailFilter .= "`idpelat`=" . QuotedValue($this->idpelat->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_cv_pelrepes()
	{
		return "t_pelatihan.idpelat=@idpelat@";
	}

	// Detail filter
	public function sqlDetailFilter_cv_pelrepes()
	{
		return "`idpelat`=@idpelat@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_repeserta`";
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
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
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
			$fldname = 'id';
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
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
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
		$this->id->DbValue = $row['id'];
		$this->idpelat->DbValue = $row['idpelat'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->tgl_pel->DbValue = $row['tgl_pel'];
		$this->nama->DbValue = $row['nama'];
		$this->perusahaan->DbValue = $row['perusahaan'];
		$this->jabatan->DbValue = $row['jabatan'];
		$this->tgl_daftar->DbValue = $row['tgl_daftar'];
		$this->telp->DbValue = $row['telp'];
		$this->fax->DbValue = $row['fax'];
		$this->hp->DbValue = $row['hp'];
		$this->produk->DbValue = $row['produk'];
		$this->cara_bayar->DbValue = $row['cara_bayar'];
		$this->ket_bayar->DbValue = $row['ket_bayar'];
		$this->tgl_bayar->DbValue = $row['tgl_bayar'];
		$this->kdinformasi->DbValue = $row['kdinformasi'];
		$this->konfirmasi->DbValue = $row['konfirmasi'];
		$this->ket->DbValue = $row['ket'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->created_at->DbValue = $row['created_at'];
		$this->ket_lainnya->DbValue = $row['ket_lainnya'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_repesertalist.php";
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
		if ($pageName == "t_repesertaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_repesertaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_repesertaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_repesertalist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_repesertaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_repesertaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_repesertaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_repesertaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_repesertaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("t_repesertaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("t_repesertadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "cv_pelrepes" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_idpelat=" . urlencode($this->idpelat->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
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
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
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
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
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
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
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
		$this->id->setDbValue($rs->fields('id'));
		$this->idpelat->setDbValue($rs->fields('idpelat'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->tgl_pel->setDbValue($rs->fields('tgl_pel'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->perusahaan->setDbValue($rs->fields('perusahaan'));
		$this->jabatan->setDbValue($rs->fields('jabatan'));
		$this->tgl_daftar->setDbValue($rs->fields('tgl_daftar'));
		$this->telp->setDbValue($rs->fields('telp'));
		$this->fax->setDbValue($rs->fields('fax'));
		$this->hp->setDbValue($rs->fields('hp'));
		$this->produk->setDbValue($rs->fields('produk'));
		$this->cara_bayar->setDbValue($rs->fields('cara_bayar'));
		$this->ket_bayar->setDbValue($rs->fields('ket_bayar'));
		$this->tgl_bayar->setDbValue($rs->fields('tgl_bayar'));
		$this->kdinformasi->setDbValue($rs->fields('kdinformasi'));
		$this->konfirmasi->setDbValue($rs->fields('konfirmasi'));
		$this->ket->setDbValue($rs->fields('ket'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->ket_lainnya->setDbValue($rs->fields('ket_lainnya'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// idpelat
		// kdjudul
		// tgl_pel
		// nama
		// perusahaan
		// jabatan
		// tgl_daftar
		// telp
		// fax
		// hp
		// produk
		// cara_bayar
		// ket_bayar
		// tgl_bayar
		// kdinformasi
		// konfirmasi
		// ket
		// updated_at
		// created_at
		// ket_lainnya
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$arwrk = [];
		$arwrk[1] = $this->nama->CurrentValue;
		$arwrk[2] = $this->perusahaan->CurrentValue;
		$this->id->ViewValue = $this->id->displayValue($arwrk);
		$this->id->ViewCustomAttributes = "";

		// idpelat
		$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
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
					$arwrk[2] = $rswrk->fields('df2');
					$this->idpelat->ViewValue = $this->idpelat->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idpelat->ViewValue = $this->idpelat->CurrentValue;
				}
			}
		} else {
			$this->idpelat->ViewValue = NULL;
		}
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

		// tgl_pel
		$this->tgl_pel->ViewValue = $this->tgl_pel->CurrentValue;
		$this->tgl_pel->ViewValue = FormatDateTime($this->tgl_pel->ViewValue, 0);
		$this->tgl_pel->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

		// perusahaan
		$this->perusahaan->ViewValue = $this->perusahaan->CurrentValue;
		$this->perusahaan->ViewCustomAttributes = "";

		// jabatan
		$this->jabatan->ViewValue = $this->jabatan->CurrentValue;
		$curVal = strval($this->jabatan->CurrentValue);
		if ($curVal != "") {
			$this->jabatan->ViewValue = $this->jabatan->lookupCacheOption($curVal);
			if ($this->jabatan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jabatan->ViewValue = $this->jabatan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jabatan->ViewValue = $this->jabatan->CurrentValue;
				}
			}
		} else {
			$this->jabatan->ViewValue = NULL;
		}
		$this->jabatan->ViewCustomAttributes = "";

		// tgl_daftar
		$this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
		$this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
		$this->tgl_daftar->ViewCustomAttributes = "";

		// telp
		$this->telp->ViewValue = $this->telp->CurrentValue;
		$this->telp->ViewCustomAttributes = "";

		// fax
		$this->fax->ViewValue = $this->fax->CurrentValue;
		$this->fax->ViewCustomAttributes = "";

		// hp
		$this->hp->ViewValue = $this->hp->CurrentValue;
		$this->hp->ViewCustomAttributes = "";

		// produk
		$this->produk->ViewValue = $this->produk->CurrentValue;
		$this->produk->ViewCustomAttributes = "";

		// cara_bayar
		if (strval($this->cara_bayar->CurrentValue) != "") {
			$this->cara_bayar->ViewValue = $this->cara_bayar->optionCaption($this->cara_bayar->CurrentValue);
		} else {
			$this->cara_bayar->ViewValue = NULL;
		}
		$this->cara_bayar->ViewCustomAttributes = "";

		// ket_bayar
		$this->ket_bayar->ViewValue = $this->ket_bayar->CurrentValue;
		$this->ket_bayar->ViewCustomAttributes = "";

		// tgl_bayar
		$this->tgl_bayar->ViewValue = $this->tgl_bayar->CurrentValue;
		$this->tgl_bayar->ViewValue = FormatDateTime($this->tgl_bayar->ViewValue, 0);
		$this->tgl_bayar->ViewCustomAttributes = "";

		// kdinformasi
		$curVal = strval($this->kdinformasi->CurrentValue);
		if ($curVal != "") {
			$this->kdinformasi->ViewValue = $this->kdinformasi->lookupCacheOption($curVal);
			if ($this->kdinformasi->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdinformasi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdinformasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdinformasi->ViewValue = $this->kdinformasi->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdinformasi->ViewValue = $this->kdinformasi->CurrentValue;
				}
			}
		} else {
			$this->kdinformasi->ViewValue = NULL;
		}
		$this->kdinformasi->ViewCustomAttributes = "";

		// konfirmasi
		if (strval($this->konfirmasi->CurrentValue) != "") {
			$this->konfirmasi->ViewValue = $this->konfirmasi->optionCaption($this->konfirmasi->CurrentValue);
		} else {
			$this->konfirmasi->ViewValue = NULL;
		}
		$this->konfirmasi->ViewCustomAttributes = "";

		// ket
		if (strval($this->ket->CurrentValue) != "") {
			$this->ket->ViewValue = $this->ket->optionCaption($this->ket->CurrentValue);
		} else {
			$this->ket->ViewValue = NULL;
		}
		$this->ket->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// ket_lainnya
		$this->ket_lainnya->ViewValue = $this->ket_lainnya->CurrentValue;
		$this->ket_lainnya->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// idpelat
		$this->idpelat->LinkCustomAttributes = "";
		$this->idpelat->HrefValue = "";
		$this->idpelat->TooltipValue = "";

		// kdjudul
		$this->kdjudul->LinkCustomAttributes = "";
		$this->kdjudul->HrefValue = "";
		$this->kdjudul->TooltipValue = "";

		// tgl_pel
		$this->tgl_pel->LinkCustomAttributes = "";
		$this->tgl_pel->HrefValue = "";
		$this->tgl_pel->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// perusahaan
		$this->perusahaan->LinkCustomAttributes = "";
		$this->perusahaan->HrefValue = "";
		$this->perusahaan->TooltipValue = "";

		// jabatan
		$this->jabatan->LinkCustomAttributes = "";
		$this->jabatan->HrefValue = "";
		$this->jabatan->TooltipValue = "";

		// tgl_daftar
		$this->tgl_daftar->LinkCustomAttributes = "";
		$this->tgl_daftar->HrefValue = "";
		$this->tgl_daftar->TooltipValue = "";

		// telp
		$this->telp->LinkCustomAttributes = "";
		$this->telp->HrefValue = "";
		$this->telp->TooltipValue = "";

		// fax
		$this->fax->LinkCustomAttributes = "";
		$this->fax->HrefValue = "";
		$this->fax->TooltipValue = "";

		// hp
		$this->hp->LinkCustomAttributes = "";
		$this->hp->HrefValue = "";
		$this->hp->TooltipValue = "";

		// produk
		$this->produk->LinkCustomAttributes = "";
		$this->produk->HrefValue = "";
		$this->produk->TooltipValue = "";

		// cara_bayar
		$this->cara_bayar->LinkCustomAttributes = "";
		$this->cara_bayar->HrefValue = "";
		$this->cara_bayar->TooltipValue = "";

		// ket_bayar
		$this->ket_bayar->LinkCustomAttributes = "";
		$this->ket_bayar->HrefValue = "";
		$this->ket_bayar->TooltipValue = "";

		// tgl_bayar
		$this->tgl_bayar->LinkCustomAttributes = "";
		$this->tgl_bayar->HrefValue = "";
		$this->tgl_bayar->TooltipValue = "";

		// kdinformasi
		$this->kdinformasi->LinkCustomAttributes = "";
		$this->kdinformasi->HrefValue = "";
		$this->kdinformasi->TooltipValue = "";

		// konfirmasi
		$this->konfirmasi->LinkCustomAttributes = "";
		$this->konfirmasi->HrefValue = "";
		$this->konfirmasi->TooltipValue = "";

		// ket
		$this->ket->LinkCustomAttributes = "";
		$this->ket->HrefValue = "";
		$this->ket->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// ket_lainnya
		$this->ket_lainnya->LinkCustomAttributes = "";
		$this->ket_lainnya->HrefValue = "";
		$this->ket_lainnya->TooltipValue = "";

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

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$arwrk = [];
		$arwrk[1] = $this->nama->CurrentValue;
		$arwrk[2] = $this->perusahaan->CurrentValue;
		$this->id->EditValue = $this->id->displayValue($arwrk);
		$this->id->ViewCustomAttributes = "";

		// idpelat
		$this->idpelat->EditAttrs["class"] = "form-control";
		$this->idpelat->EditCustomAttributes = "";
		$this->idpelat->EditValue = $this->idpelat->CurrentValue;
		$curVal = strval($this->idpelat->CurrentValue);
		if ($curVal != "") {
			$this->idpelat->EditValue = $this->idpelat->lookupCacheOption($curVal);
			if ($this->idpelat->EditValue === NULL) { // Lookup from database
				$filterWrk = "`idpelat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->idpelat->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->idpelat->EditValue = $this->idpelat->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idpelat->EditValue = $this->idpelat->CurrentValue;
				}
			}
		} else {
			$this->idpelat->EditValue = NULL;
		}
		$this->idpelat->ViewCustomAttributes = "";

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

		// tgl_pel
		$this->tgl_pel->EditAttrs["class"] = "form-control";
		$this->tgl_pel->EditCustomAttributes = "";
		$this->tgl_pel->EditValue = $this->tgl_pel->CurrentValue;
		$this->tgl_pel->EditValue = FormatDateTime($this->tgl_pel->EditValue, 0);
		$this->tgl_pel->ViewCustomAttributes = "";

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

		// perusahaan
		$this->perusahaan->EditAttrs["class"] = "form-control";
		$this->perusahaan->EditCustomAttributes = "";
		if (!$this->perusahaan->Raw)
			$this->perusahaan->CurrentValue = HtmlDecode($this->perusahaan->CurrentValue);
		$this->perusahaan->EditValue = $this->perusahaan->CurrentValue;
		$this->perusahaan->PlaceHolder = RemoveHtml($this->perusahaan->caption());

		// jabatan
		$this->jabatan->EditAttrs["class"] = "form-control";
		$this->jabatan->EditCustomAttributes = "";
		if (!$this->jabatan->Raw)
			$this->jabatan->CurrentValue = HtmlDecode($this->jabatan->CurrentValue);
		$this->jabatan->EditValue = $this->jabatan->CurrentValue;
		$this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());

		// tgl_daftar
		$this->tgl_daftar->EditAttrs["class"] = "form-control";
		$this->tgl_daftar->EditCustomAttributes = "";
		$this->tgl_daftar->EditValue = FormatDateTime($this->tgl_daftar->CurrentValue, 8);
		$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

		// telp
		$this->telp->EditAttrs["class"] = "form-control";
		$this->telp->EditCustomAttributes = "";
		if (!$this->telp->Raw)
			$this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
		$this->telp->EditValue = $this->telp->CurrentValue;
		$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

		// fax
		$this->fax->EditAttrs["class"] = "form-control";
		$this->fax->EditCustomAttributes = "";
		if (!$this->fax->Raw)
			$this->fax->CurrentValue = HtmlDecode($this->fax->CurrentValue);
		$this->fax->EditValue = $this->fax->CurrentValue;
		$this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

		// hp
		$this->hp->EditAttrs["class"] = "form-control";
		$this->hp->EditCustomAttributes = "";
		if (!$this->hp->Raw)
			$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
		$this->hp->EditValue = $this->hp->CurrentValue;
		$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

		// produk
		$this->produk->EditAttrs["class"] = "form-control";
		$this->produk->EditCustomAttributes = "";
		if (!$this->produk->Raw)
			$this->produk->CurrentValue = HtmlDecode($this->produk->CurrentValue);
		$this->produk->EditValue = $this->produk->CurrentValue;
		$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

		// cara_bayar
		$this->cara_bayar->EditCustomAttributes = "";
		$this->cara_bayar->EditValue = $this->cara_bayar->options(FALSE);

		// ket_bayar
		$this->ket_bayar->EditAttrs["class"] = "form-control";
		$this->ket_bayar->EditCustomAttributes = "";
		$this->ket_bayar->EditValue = $this->ket_bayar->CurrentValue;
		$this->ket_bayar->PlaceHolder = RemoveHtml($this->ket_bayar->caption());

		// tgl_bayar
		$this->tgl_bayar->EditAttrs["class"] = "form-control";
		$this->tgl_bayar->EditCustomAttributes = "";
		$this->tgl_bayar->EditValue = FormatDateTime($this->tgl_bayar->CurrentValue, 8);
		$this->tgl_bayar->PlaceHolder = RemoveHtml($this->tgl_bayar->caption());

		// kdinformasi
		$this->kdinformasi->EditAttrs["class"] = "form-control";
		$this->kdinformasi->EditCustomAttributes = "";

		// konfirmasi
		$this->konfirmasi->EditAttrs["class"] = "form-control";
		$this->konfirmasi->EditCustomAttributes = "";
		$this->konfirmasi->EditValue = $this->konfirmasi->options(TRUE);

		// ket
		$this->ket->EditAttrs["class"] = "form-control";
		$this->ket->EditCustomAttributes = "";
		$this->ket->EditValue = $this->ket->options(TRUE);

		// updated_at
		// created_at
		// ket_lainnya

		$this->ket_lainnya->EditAttrs["class"] = "form-control";
		$this->ket_lainnya->EditCustomAttributes = "";
		$this->ket_lainnya->EditValue = $this->ket_lainnya->CurrentValue;
		$this->ket_lainnya->PlaceHolder = RemoveHtml($this->ket_lainnya->caption());

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
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->perusahaan);
					$doc->exportCaption($this->jabatan);
					$doc->exportCaption($this->tgl_daftar);
					$doc->exportCaption($this->telp);
					$doc->exportCaption($this->fax);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->produk);
					$doc->exportCaption($this->cara_bayar);
					$doc->exportCaption($this->ket_bayar);
					$doc->exportCaption($this->tgl_bayar);
					$doc->exportCaption($this->kdinformasi);
					$doc->exportCaption($this->konfirmasi);
					$doc->exportCaption($this->ket);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->ket_lainnya);
				} else {
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->perusahaan);
					$doc->exportCaption($this->jabatan);
					$doc->exportCaption($this->tgl_daftar);
					$doc->exportCaption($this->telp);
					$doc->exportCaption($this->fax);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->produk);
					$doc->exportCaption($this->cara_bayar);
					$doc->exportCaption($this->ket_bayar);
					$doc->exportCaption($this->tgl_bayar);
					$doc->exportCaption($this->kdinformasi);
					$doc->exportCaption($this->konfirmasi);
					$doc->exportCaption($this->ket);
					$doc->exportCaption($this->ket_lainnya);
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
						$doc->exportField($this->nama);
						$doc->exportField($this->perusahaan);
						$doc->exportField($this->jabatan);
						$doc->exportField($this->tgl_daftar);
						$doc->exportField($this->telp);
						$doc->exportField($this->fax);
						$doc->exportField($this->hp);
						$doc->exportField($this->produk);
						$doc->exportField($this->cara_bayar);
						$doc->exportField($this->ket_bayar);
						$doc->exportField($this->tgl_bayar);
						$doc->exportField($this->kdinformasi);
						$doc->exportField($this->konfirmasi);
						$doc->exportField($this->ket);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->created_at);
						$doc->exportField($this->ket_lainnya);
					} else {
						$doc->exportField($this->nama);
						$doc->exportField($this->perusahaan);
						$doc->exportField($this->jabatan);
						$doc->exportField($this->tgl_daftar);
						$doc->exportField($this->telp);
						$doc->exportField($this->fax);
						$doc->exportField($this->hp);
						$doc->exportField($this->produk);
						$doc->exportField($this->cara_bayar);
						$doc->exportField($this->ket_bayar);
						$doc->exportField($this->tgl_bayar);
						$doc->exportField($this->kdinformasi);
						$doc->exportField($this->konfirmasi);
						$doc->exportField($this->ket);
						$doc->exportField($this->ket_lainnya);
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
		$table = 't_repeserta';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_repeserta';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id'];

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
		$table = 't_repeserta';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['id'];

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
		$table = 't_repeserta';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id'];

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

		$rd = ExecuteRow("SELECT `kdjudul`, `tawal` FROM `t_pelatihan` WHERE `idpelat` = '".$rsnew["idpelat"]."'");
		$rsnew["kdjudul"] = $rd["kdjudul"];
		$rsnew["tgl_pel"] = $rd["tawal"];
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

		$rd = ExecuteRow("SELECT `kdjudul`, `tawal` FROM `t_pelatihan` WHERE `idpelat` = ".$rsold["idpelat"]);
		$rsnew["kdjudul"] = $rd["kdjudul"];
		$rsnew["tgl_pel"] = $rd["tawal"];
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

	/*
		$this->tgl->ViewValue = CSFormatTanggal($this->tgl->ViewValue, false, true);
		$kurikulum = ExecuteScalar("SELECT COUNT(1) FROM t_kurikulum WHERE kurikulumid = '".$this->materi->CurrentValue."'");
		if($kurikulum > 0){
			$m = ExecuteRow("SELECT kurikulum,silabus FROM t_kurikulum WHERE kurikulumid = '".$this->materi->CurrentValue."'");
			$this->materi->ViewValue = "<p><b>".$m["kurikulum"]."</b></p>".$m["silabus"];
		} else {
			$this->materi->ViewValue = "<b>".$this->materi->ViewValue."</b>";
		}
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
	*/
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>