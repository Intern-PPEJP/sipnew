<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_biointruktur
 */
class t_biointruktur extends DbTable
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
	public $bioid;
	public $kdinstruktur;
	public $revisi;
	public $tglterbit;
	public $nama;
	public $komp_materi;
	public $tmplahir;
	public $tgllahir;
	public $agama;
	public $kategori;
	public $instansi;
	public $pekerjaan;
	public $alamatkantor;
	public $alamatrumah;
	public $telepon;
	public $hp;
	public $_email;
	public $fax;
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
		$this->TableVar = 't_biointruktur';
		$this->TableName = 't_biointruktur';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_biointruktur`";
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
		$this->ShowMultipleDetails = TRUE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// bioid
		$this->bioid = new DbField('t_biointruktur', 't_biointruktur', 'x_bioid', 'bioid', '`bioid`', '`bioid`', 3, 11, -1, FALSE, '`bioid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->bioid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->bioid->IsPrimaryKey = TRUE; // Primary key field
		$this->bioid->IsForeignKey = TRUE; // Foreign key field
		$this->bioid->Sortable = FALSE; // Allow sort
		$this->bioid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bioid'] = &$this->bioid;

		// kdinstruktur
		$this->kdinstruktur = new DbField('t_biointruktur', 't_biointruktur', 'x_kdinstruktur', 'kdinstruktur', '`kdinstruktur`', '`kdinstruktur`', 200, 6, -1, FALSE, '`kdinstruktur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdinstruktur->Required = TRUE; // Required field
		$this->kdinstruktur->Sortable = FALSE; // Allow sort
		$this->fields['kdinstruktur'] = &$this->kdinstruktur;

		// revisi
		$this->revisi = new DbField('t_biointruktur', 't_biointruktur', 'x_revisi', 'revisi', '`revisi`', '`revisi`', 200, 2, -1, FALSE, '`revisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revisi->Required = TRUE; // Required field
		$this->revisi->Sortable = FALSE; // Allow sort
		$this->fields['revisi'] = &$this->revisi;

		// tglterbit
		$this->tglterbit = new DbField('t_biointruktur', 't_biointruktur', 'x_tglterbit', 'tglterbit', '`tglterbit`', CastDateFieldForLike("`tglterbit`", 0, "DB"), 133, 10, 0, FALSE, '`tglterbit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglterbit->Required = TRUE; // Required field
		$this->tglterbit->Sortable = FALSE; // Allow sort
		$this->tglterbit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tglterbit'] = &$this->tglterbit;

		// nama
		$this->nama = new DbField('t_biointruktur', 't_biointruktur', 'x_nama', 'nama', '`nama`', '`nama`', 200, 200, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = FALSE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// komp_materi
		$this->komp_materi = new DbField('t_biointruktur', 't_biointruktur', 'x_komp_materi', 'komp_materi', '0', '0', 20, 1, -1, FALSE, '0', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->komp_materi->IsCustom = TRUE; // Custom field
		$this->komp_materi->Sortable = FALSE; // Allow sort
		$this->komp_materi->Lookup = new Lookup('komp_materi', 't_kurikulum', FALSE, 'kurikulumid', ["kurikulum","","",""], [], [], [], [], [], [], '`kurikulum` ASC', '');
		$this->komp_materi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['komp_materi'] = &$this->komp_materi;

		// tmplahir
		$this->tmplahir = new DbField('t_biointruktur', 't_biointruktur', 'x_tmplahir', 'tmplahir', '`tmplahir`', '`tmplahir`', 200, 255, -1, FALSE, '`tmplahir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tmplahir->Required = TRUE; // Required field
		$this->tmplahir->Sortable = FALSE; // Allow sort
		$this->fields['tmplahir'] = &$this->tmplahir;

		// tgllahir
		$this->tgllahir = new DbField('t_biointruktur', 't_biointruktur', 'x_tgllahir', 'tgllahir', '`tgllahir`', CastDateFieldForLike("`tgllahir`", 0, "DB"), 133, 10, 0, FALSE, '`tgllahir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgllahir->Required = TRUE; // Required field
		$this->tgllahir->Sortable = FALSE; // Allow sort
		$this->tgllahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgllahir'] = &$this->tgllahir;

		// agama
		$this->agama = new DbField('t_biointruktur', 't_biointruktur', 'x_agama', 'agama', '`agama`', '`agama`', 16, 2, -1, FALSE, '`agama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->agama->Required = TRUE; // Required field
		$this->agama->Sortable = FALSE; // Allow sort
		$this->agama->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->agama->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->agama->Lookup = new Lookup('agama', 't_agama', FALSE, 'kdagama', ["agama","","",""], [], [], [], [], [], [], '', '');
		$this->agama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['agama'] = &$this->agama;

		// kategori
		$this->kategori = new DbField('t_biointruktur', 't_biointruktur', 'x_kategori', 'kategori', '`kategori`', '`kategori`', 16, 1, -1, FALSE, '`kategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->kategori->Nullable = FALSE; // NOT NULL field
		$this->kategori->Required = TRUE; // Required field
		$this->kategori->Sortable = FALSE; // Allow sort
		$this->kategori->Lookup = new Lookup('kategori', 't_biointruktur', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->kategori->OptionCount = 2;
		$this->kategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kategori'] = &$this->kategori;

		// instansi
		$this->instansi = new DbField('t_biointruktur', 't_biointruktur', 'x_instansi', 'instansi', '`instansi`', '`instansi`', 200, 255, -1, FALSE, '`instansi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->instansi->Required = TRUE; // Required field
		$this->instansi->Sortable = FALSE; // Allow sort
		$this->fields['instansi'] = &$this->instansi;

		// pekerjaan
		$this->pekerjaan = new DbField('t_biointruktur', 't_biointruktur', 'x_pekerjaan', 'pekerjaan', '`pekerjaan`', '`pekerjaan`', 200, 255, -1, FALSE, '`pekerjaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pekerjaan->Required = TRUE; // Required field
		$this->pekerjaan->Sortable = FALSE; // Allow sort
		$this->fields['pekerjaan'] = &$this->pekerjaan;

		// alamatkantor
		$this->alamatkantor = new DbField('t_biointruktur', 't_biointruktur', 'x_alamatkantor', 'alamatkantor', '`alamatkantor`', '`alamatkantor`', 201, 65535, -1, FALSE, '`alamatkantor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamatkantor->Sortable = FALSE; // Allow sort
		$this->fields['alamatkantor'] = &$this->alamatkantor;

		// alamatrumah
		$this->alamatrumah = new DbField('t_biointruktur', 't_biointruktur', 'x_alamatrumah', 'alamatrumah', '`alamatrumah`', '`alamatrumah`', 201, 65535, -1, FALSE, '`alamatrumah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamatrumah->Required = TRUE; // Required field
		$this->alamatrumah->Sortable = FALSE; // Allow sort
		$this->fields['alamatrumah'] = &$this->alamatrumah;

		// telepon
		$this->telepon = new DbField('t_biointruktur', 't_biointruktur', 'x_telepon', 'telepon', '`telepon`', '`telepon`', 200, 50, -1, FALSE, '`telepon`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telepon->Required = TRUE; // Required field
		$this->telepon->Sortable = FALSE; // Allow sort
		$this->fields['telepon'] = &$this->telepon;

		// hp
		$this->hp = new DbField('t_biointruktur', 't_biointruktur', 'x_hp', 'hp', '`hp`', '`hp`', 200, 25, -1, FALSE, '`hp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hp->Required = TRUE; // Required field
		$this->hp->Sortable = FALSE; // Allow sort
		$this->fields['hp'] = &$this->hp;

		// email
		$this->_email = new DbField('t_biointruktur', 't_biointruktur', 'x__email', 'email', '`email`', '`email`', 200, 100, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Required = TRUE; // Required field
		$this->_email->Sortable = FALSE; // Allow sort
		$this->_email->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
		$this->fields['email'] = &$this->_email;

		// fax
		$this->fax = new DbField('t_biointruktur', 't_biointruktur', 'x_fax', 'fax', '`fax`', '`fax`', 200, 25, -1, FALSE, '`fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fax->Sortable = FALSE; // Allow sort
		$this->fields['fax'] = &$this->fax;

		// created_by
		$this->created_by = new DbField('t_biointruktur', 't_biointruktur', 'x_created_by', 'created_by', '`created_by`', '`created_by`', 200, 255, -1, FALSE, '`created_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_by->Sortable = TRUE; // Allow sort
		$this->fields['created_by'] = &$this->created_by;

		// created_at
		$this->created_at = new DbField('t_biointruktur', 't_biointruktur', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_by
		$this->updated_by = new DbField('t_biointruktur', 't_biointruktur', 'x_updated_by', 'updated_by', '`updated_by`', '`updated_by`', 200, 255, -1, FALSE, '`updated_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_by->Sortable = TRUE; // Allow sort
		$this->fields['updated_by'] = &$this->updated_by;

		// updated_at
		$this->updated_at = new DbField('t_biointruktur', 't_biointruktur', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		} else {
			$fld->setSort("");
		}
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
		if ($this->getCurrentDetailTable() == "t_rwpendd") {
			$detailUrl = $GLOBALS["t_rwpendd"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_bioid=" . urlencode($this->bioid->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "t_rwpekerjaan") {
			$detailUrl = $GLOBALS["t_rwpekerjaan"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_bioid=" . urlencode($this->bioid->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "t_rwtraining") {
			$detailUrl = $GLOBALS["t_rwtraining"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_bioid=" . urlencode($this->bioid->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "t_faskur") {
			$detailUrl = $GLOBALS["t_faskur"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_bioid=" . urlencode($this->bioid->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "cv_rwipelatihaninstruktur") {
			$detailUrl = $GLOBALS["cv_rwipelatihaninstruktur"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_bioid=" . urlencode($this->bioid->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "t_evaluasifas") {
			$detailUrl = $GLOBALS["t_evaluasifas"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_bioid=" . urlencode($this->bioid->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_biointrukturlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_biointruktur`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, 0 AS `komp_materi` FROM " . $this->getSqlFrom();
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`nama` ASC";
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
			$this->bioid->setDbValue($conn->insert_ID());
			$rs['bioid'] = $this->bioid->DbValue;
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

		// Cascade Update detail table 't_rwpendd'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['bioid']) && $rsold['bioid'] != $rs['bioid'])) { // Update detail field 'bioid'
			$cascadeUpdate = TRUE;
			$rscascade['bioid'] = $rs['bioid'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["t_rwpendd"]))
				$GLOBALS["t_rwpendd"] = new t_rwpendd();
			$rswrk = $GLOBALS["t_rwpendd"]->loadRs("`bioid` = " . QuotedValue($rsold['bioid'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'penddid';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["t_rwpendd"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["t_rwpendd"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["t_rwpendd"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 't_rwpekerjaan'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['bioid']) && $rsold['bioid'] != $rs['bioid'])) { // Update detail field 'bioid'
			$cascadeUpdate = TRUE;
			$rscascade['bioid'] = $rs['bioid'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["t_rwpekerjaan"]))
				$GLOBALS["t_rwpekerjaan"] = new t_rwpekerjaan();
			$rswrk = $GLOBALS["t_rwpekerjaan"]->loadRs("`bioid` = " . QuotedValue($rsold['bioid'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'rwkerjaid';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["t_rwpekerjaan"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["t_rwpekerjaan"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["t_rwpekerjaan"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 't_rwtraining'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['bioid']) && $rsold['bioid'] != $rs['bioid'])) { // Update detail field 'bioid'
			$cascadeUpdate = TRUE;
			$rscascade['bioid'] = $rs['bioid'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["t_rwtraining"]))
				$GLOBALS["t_rwtraining"] = new t_rwtraining();
			$rswrk = $GLOBALS["t_rwtraining"]->loadRs("`bioid` = " . QuotedValue($rsold['bioid'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'rwtrainingid';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["t_rwtraining"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["t_rwtraining"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["t_rwtraining"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 't_faskur'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['bioid']) && $rsold['bioid'] != $rs['bioid'])) { // Update detail field 'bioid'
			$cascadeUpdate = TRUE;
			$rscascade['bioid'] = $rs['bioid'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["t_faskur"]))
				$GLOBALS["t_faskur"] = new t_faskur();
			$rswrk = $GLOBALS["t_faskur"]->loadRs("`bioid` = " . QuotedValue($rsold['bioid'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'faskurid';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["t_faskur"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["t_faskur"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["t_faskur"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'cv_rwipelatihaninstruktur'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['bioid']) && $rsold['bioid'] != $rs['bioid'])) { // Update detail field 'bioid'
			$cascadeUpdate = TRUE;
			$rscascade['bioid'] = $rs['bioid'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["cv_rwipelatihaninstruktur"]))
				$GLOBALS["cv_rwipelatihaninstruktur"] = new cv_rwipelatihaninstruktur();
			$rswrk = $GLOBALS["cv_rwipelatihaninstruktur"]->loadRs("t_jadwalpel.instruktur = " . QuotedValue($rsold['bioid'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["cv_rwipelatihaninstruktur"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["cv_rwipelatihaninstruktur"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["cv_rwipelatihaninstruktur"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 't_evaluasifas'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['bioid']) && $rsold['bioid'] != $rs['bioid'])) { // Update detail field 'bioid'
			$cascadeUpdate = TRUE;
			$rscascade['bioid'] = $rs['bioid'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["t_evaluasifas"]))
				$GLOBALS["t_evaluasifas"] = new t_evaluasifas();
			$rswrk = $GLOBALS["t_evaluasifas"]->loadRs("`bioid` = " . QuotedValue($rsold['bioid'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'evafas_id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["t_evaluasifas"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["t_evaluasifas"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["t_evaluasifas"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'bioid';
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
			if (array_key_exists('bioid', $rs))
				AddFilter($where, QuotedName('bioid', $this->Dbid) . '=' . QuotedValue($rs['bioid'], $this->bioid->DataType, $this->Dbid));
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

		// Cascade delete detail table 't_rwpendd'
		if (!isset($GLOBALS["t_rwpendd"]))
			$GLOBALS["t_rwpendd"] = new t_rwpendd();
		$rscascade = $GLOBALS["t_rwpendd"]->loadRs("`bioid` = " . QuotedValue($rs['bioid'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["t_rwpendd"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["t_rwpendd"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["t_rwpendd"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 't_rwpekerjaan'
		if (!isset($GLOBALS["t_rwpekerjaan"]))
			$GLOBALS["t_rwpekerjaan"] = new t_rwpekerjaan();
		$rscascade = $GLOBALS["t_rwpekerjaan"]->loadRs("`bioid` = " . QuotedValue($rs['bioid'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["t_rwpekerjaan"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["t_rwpekerjaan"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["t_rwpekerjaan"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 't_rwtraining'
		if (!isset($GLOBALS["t_rwtraining"]))
			$GLOBALS["t_rwtraining"] = new t_rwtraining();
		$rscascade = $GLOBALS["t_rwtraining"]->loadRs("`bioid` = " . QuotedValue($rs['bioid'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["t_rwtraining"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["t_rwtraining"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["t_rwtraining"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 't_faskur'
		if (!isset($GLOBALS["t_faskur"]))
			$GLOBALS["t_faskur"] = new t_faskur();
		$rscascade = $GLOBALS["t_faskur"]->loadRs("`bioid` = " . QuotedValue($rs['bioid'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["t_faskur"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["t_faskur"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["t_faskur"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'cv_rwipelatihaninstruktur'
		if (!isset($GLOBALS["cv_rwipelatihaninstruktur"]))
			$GLOBALS["cv_rwipelatihaninstruktur"] = new cv_rwipelatihaninstruktur();
		$rscascade = $GLOBALS["cv_rwipelatihaninstruktur"]->loadRs("t_jadwalpel.instruktur = " . QuotedValue($rs['bioid'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["cv_rwipelatihaninstruktur"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["cv_rwipelatihaninstruktur"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["cv_rwipelatihaninstruktur"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 't_evaluasifas'
		if (!isset($GLOBALS["t_evaluasifas"]))
			$GLOBALS["t_evaluasifas"] = new t_evaluasifas();
		$rscascade = $GLOBALS["t_evaluasifas"]->loadRs("`bioid` = " . QuotedValue($rs['bioid'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["t_evaluasifas"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["t_evaluasifas"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["t_evaluasifas"]->Row_Deleted($dtlrow);
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
		$this->bioid->DbValue = $row['bioid'];
		$this->kdinstruktur->DbValue = $row['kdinstruktur'];
		$this->revisi->DbValue = $row['revisi'];
		$this->tglterbit->DbValue = $row['tglterbit'];
		$this->nama->DbValue = $row['nama'];
		$this->komp_materi->DbValue = $row['komp_materi'];
		$this->tmplahir->DbValue = $row['tmplahir'];
		$this->tgllahir->DbValue = $row['tgllahir'];
		$this->agama->DbValue = $row['agama'];
		$this->kategori->DbValue = $row['kategori'];
		$this->instansi->DbValue = $row['instansi'];
		$this->pekerjaan->DbValue = $row['pekerjaan'];
		$this->alamatkantor->DbValue = $row['alamatkantor'];
		$this->alamatrumah->DbValue = $row['alamatrumah'];
		$this->telepon->DbValue = $row['telepon'];
		$this->hp->DbValue = $row['hp'];
		$this->_email->DbValue = $row['email'];
		$this->fax->DbValue = $row['fax'];
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
		return "`bioid` = @bioid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('bioid', $row) ? $row['bioid'] : NULL;
		else
			$val = $this->bioid->OldValue !== NULL ? $this->bioid->OldValue : $this->bioid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@bioid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_biointrukturlist.php";
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
		if ($pageName == "t_biointrukturview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_biointrukturedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_biointrukturadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_biointrukturlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_biointrukturview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_biointrukturview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_biointrukturadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_biointrukturadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_biointrukturedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_biointrukturedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("t_biointrukturadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_biointrukturadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_biointrukturdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "bioid:" . JsonEncode($this->bioid->CurrentValue, "number");
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
		if ($this->bioid->CurrentValue != NULL) {
			$url .= "bioid=" . urlencode($this->bioid->CurrentValue);
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
			if (Param("bioid") !== NULL)
				$arKeys[] = Param("bioid");
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
				$this->bioid->CurrentValue = $key;
			else
				$this->bioid->OldValue = $key;
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
		$this->bioid->setDbValue($rs->fields('bioid'));
		$this->kdinstruktur->setDbValue($rs->fields('kdinstruktur'));
		$this->revisi->setDbValue($rs->fields('revisi'));
		$this->tglterbit->setDbValue($rs->fields('tglterbit'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->komp_materi->setDbValue($rs->fields('komp_materi'));
		$this->tmplahir->setDbValue($rs->fields('tmplahir'));
		$this->tgllahir->setDbValue($rs->fields('tgllahir'));
		$this->agama->setDbValue($rs->fields('agama'));
		$this->kategori->setDbValue($rs->fields('kategori'));
		$this->instansi->setDbValue($rs->fields('instansi'));
		$this->pekerjaan->setDbValue($rs->fields('pekerjaan'));
		$this->alamatkantor->setDbValue($rs->fields('alamatkantor'));
		$this->alamatrumah->setDbValue($rs->fields('alamatrumah'));
		$this->telepon->setDbValue($rs->fields('telepon'));
		$this->hp->setDbValue($rs->fields('hp'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->fax->setDbValue($rs->fields('fax'));
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
		// bioid
		// kdinstruktur
		// revisi
		// tglterbit
		// nama
		// komp_materi
		// tmplahir
		// tgllahir
		// agama
		// kategori
		// instansi
		// pekerjaan
		// alamatkantor
		// alamatrumah
		// telepon
		// hp
		// email
		// fax
		// created_by
		// created_at
		// updated_by
		// updated_at
		// bioid

		$this->bioid->ViewValue = $this->bioid->CurrentValue;
		$this->bioid->ViewCustomAttributes = "";

		// kdinstruktur
		$this->kdinstruktur->ViewValue = $this->kdinstruktur->CurrentValue;
		$this->kdinstruktur->ViewCustomAttributes = "";

		// revisi
		$this->revisi->ViewValue = $this->revisi->CurrentValue;
		$this->revisi->ViewCustomAttributes = "";

		// tglterbit
		$this->tglterbit->ViewValue = $this->tglterbit->CurrentValue;
		$this->tglterbit->ViewValue = FormatDateTime($this->tglterbit->ViewValue, 0);
		$this->tglterbit->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

		// komp_materi
		$this->komp_materi->ViewValue = $this->komp_materi->CurrentValue;
		$curVal = strval($this->komp_materi->CurrentValue);
		if ($curVal != "") {
			$this->komp_materi->ViewValue = $this->komp_materi->lookupCacheOption($curVal);
			if ($this->komp_materi->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kurikulumid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->komp_materi->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->komp_materi->ViewValue = $this->komp_materi->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->komp_materi->ViewValue = $this->komp_materi->CurrentValue;
				}
			}
		} else {
			$this->komp_materi->ViewValue = NULL;
		}
		$this->komp_materi->ViewCustomAttributes = "";

		// tmplahir
		$this->tmplahir->ViewValue = $this->tmplahir->CurrentValue;
		$this->tmplahir->ViewCustomAttributes = "";

		// tgllahir
		$this->tgllahir->ViewValue = $this->tgllahir->CurrentValue;
		$this->tgllahir->ViewValue = FormatDateTime($this->tgllahir->ViewValue, 0);
		$this->tgllahir->ViewCustomAttributes = "";

		// agama
		$curVal = strval($this->agama->CurrentValue);
		if ($curVal != "") {
			$this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
			if ($this->agama->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdagama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->agama->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->agama->ViewValue = $this->agama->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->agama->ViewValue = $this->agama->CurrentValue;
				}
			}
		} else {
			$this->agama->ViewValue = NULL;
		}
		$this->agama->ViewCustomAttributes = "";

		// kategori
		if (strval($this->kategori->CurrentValue) != "") {
			$this->kategori->ViewValue = $this->kategori->optionCaption($this->kategori->CurrentValue);
		} else {
			$this->kategori->ViewValue = NULL;
		}
		$this->kategori->ViewCustomAttributes = "";

		// instansi
		$this->instansi->ViewValue = $this->instansi->CurrentValue;
		$this->instansi->ViewCustomAttributes = "";

		// pekerjaan
		$this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
		$this->pekerjaan->ViewCustomAttributes = "";

		// alamatkantor
		$this->alamatkantor->ViewValue = $this->alamatkantor->CurrentValue;
		$this->alamatkantor->ViewCustomAttributes = "";

		// alamatrumah
		$this->alamatrumah->ViewValue = $this->alamatrumah->CurrentValue;
		$this->alamatrumah->ViewCustomAttributes = "";

		// telepon
		$this->telepon->ViewValue = $this->telepon->CurrentValue;
		$this->telepon->ViewCustomAttributes = "";

		// hp
		$this->hp->ViewValue = $this->hp->CurrentValue;
		$this->hp->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// fax
		$this->fax->ViewValue = $this->fax->CurrentValue;
		$this->fax->ViewCustomAttributes = "";

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

		// bioid
		$this->bioid->LinkCustomAttributes = "";
		$this->bioid->HrefValue = "";
		$this->bioid->TooltipValue = "";

		// kdinstruktur
		$this->kdinstruktur->LinkCustomAttributes = "";
		$this->kdinstruktur->HrefValue = "";
		$this->kdinstruktur->TooltipValue = "";

		// revisi
		$this->revisi->LinkCustomAttributes = "";
		$this->revisi->HrefValue = "";
		$this->revisi->TooltipValue = "";

		// tglterbit
		$this->tglterbit->LinkCustomAttributes = "";
		$this->tglterbit->HrefValue = "";
		$this->tglterbit->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// komp_materi
		$this->komp_materi->LinkCustomAttributes = "";
		$this->komp_materi->HrefValue = "";
		$this->komp_materi->TooltipValue = "";

		// tmplahir
		$this->tmplahir->LinkCustomAttributes = "";
		$this->tmplahir->HrefValue = "";
		$this->tmplahir->TooltipValue = "";

		// tgllahir
		$this->tgllahir->LinkCustomAttributes = "";
		$this->tgllahir->HrefValue = "";
		$this->tgllahir->TooltipValue = "";

		// agama
		$this->agama->LinkCustomAttributes = "";
		$this->agama->HrefValue = "";
		$this->agama->TooltipValue = "";

		// kategori
		$this->kategori->LinkCustomAttributes = "";
		$this->kategori->HrefValue = "";
		$this->kategori->TooltipValue = "";

		// instansi
		$this->instansi->LinkCustomAttributes = "";
		$this->instansi->HrefValue = "";
		$this->instansi->TooltipValue = "";

		// pekerjaan
		$this->pekerjaan->LinkCustomAttributes = "";
		$this->pekerjaan->HrefValue = "";
		$this->pekerjaan->TooltipValue = "";

		// alamatkantor
		$this->alamatkantor->LinkCustomAttributes = "";
		$this->alamatkantor->HrefValue = "";
		$this->alamatkantor->TooltipValue = "";

		// alamatrumah
		$this->alamatrumah->LinkCustomAttributes = "";
		$this->alamatrumah->HrefValue = "";
		$this->alamatrumah->TooltipValue = "";

		// telepon
		$this->telepon->LinkCustomAttributes = "";
		$this->telepon->HrefValue = "";
		$this->telepon->TooltipValue = "";

		// hp
		$this->hp->LinkCustomAttributes = "";
		$this->hp->HrefValue = "";
		$this->hp->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// fax
		$this->fax->LinkCustomAttributes = "";
		$this->fax->HrefValue = "";
		$this->fax->TooltipValue = "";

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

		// bioid
		$this->bioid->EditAttrs["class"] = "form-control";
		$this->bioid->EditCustomAttributes = "";
		$this->bioid->EditValue = $this->bioid->CurrentValue;
		$this->bioid->ViewCustomAttributes = "";

		// kdinstruktur
		$this->kdinstruktur->EditAttrs["class"] = "form-control";
		$this->kdinstruktur->EditCustomAttributes = "";
		$this->kdinstruktur->EditValue = $this->kdinstruktur->CurrentValue;
		$this->kdinstruktur->ViewCustomAttributes = "";

		// revisi
		$this->revisi->EditAttrs["class"] = "form-control";
		$this->revisi->EditCustomAttributes = "";
		if (!$this->revisi->Raw)
			$this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
		$this->revisi->EditValue = $this->revisi->CurrentValue;
		$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

		// tglterbit
		$this->tglterbit->EditAttrs["class"] = "form-control";
		$this->tglterbit->EditCustomAttributes = "";
		$this->tglterbit->EditValue = FormatDateTime($this->tglterbit->CurrentValue, 8);
		$this->tglterbit->PlaceHolder = RemoveHtml($this->tglterbit->caption());

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

		// komp_materi
		$this->komp_materi->EditAttrs["class"] = "form-control";
		$this->komp_materi->EditCustomAttributes = "";
		$this->komp_materi->EditValue = $this->komp_materi->CurrentValue;
		$this->komp_materi->PlaceHolder = RemoveHtml($this->komp_materi->caption());

		// tmplahir
		$this->tmplahir->EditAttrs["class"] = "form-control";
		$this->tmplahir->EditCustomAttributes = "";
		if (!$this->tmplahir->Raw)
			$this->tmplahir->CurrentValue = HtmlDecode($this->tmplahir->CurrentValue);
		$this->tmplahir->EditValue = $this->tmplahir->CurrentValue;
		$this->tmplahir->PlaceHolder = RemoveHtml($this->tmplahir->caption());

		// tgllahir
		$this->tgllahir->EditAttrs["class"] = "form-control";
		$this->tgllahir->EditCustomAttributes = "";
		$this->tgllahir->EditValue = FormatDateTime($this->tgllahir->CurrentValue, 8);
		$this->tgllahir->PlaceHolder = RemoveHtml($this->tgllahir->caption());

		// agama
		$this->agama->EditAttrs["class"] = "form-control";
		$this->agama->EditCustomAttributes = "";

		// kategori
		$this->kategori->EditCustomAttributes = "";
		$this->kategori->EditValue = $this->kategori->options(FALSE);

		// instansi
		$this->instansi->EditAttrs["class"] = "form-control";
		$this->instansi->EditCustomAttributes = "";
		if (!$this->instansi->Raw)
			$this->instansi->CurrentValue = HtmlDecode($this->instansi->CurrentValue);
		$this->instansi->EditValue = $this->instansi->CurrentValue;
		$this->instansi->PlaceHolder = RemoveHtml($this->instansi->caption());

		// pekerjaan
		$this->pekerjaan->EditAttrs["class"] = "form-control";
		$this->pekerjaan->EditCustomAttributes = "";
		if (!$this->pekerjaan->Raw)
			$this->pekerjaan->CurrentValue = HtmlDecode($this->pekerjaan->CurrentValue);
		$this->pekerjaan->EditValue = $this->pekerjaan->CurrentValue;
		$this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

		// alamatkantor
		$this->alamatkantor->EditAttrs["class"] = "form-control";
		$this->alamatkantor->EditCustomAttributes = "";
		$this->alamatkantor->EditValue = $this->alamatkantor->CurrentValue;
		$this->alamatkantor->PlaceHolder = RemoveHtml($this->alamatkantor->caption());

		// alamatrumah
		$this->alamatrumah->EditAttrs["class"] = "form-control";
		$this->alamatrumah->EditCustomAttributes = "";
		$this->alamatrumah->EditValue = $this->alamatrumah->CurrentValue;
		$this->alamatrumah->PlaceHolder = RemoveHtml($this->alamatrumah->caption());

		// telepon
		$this->telepon->EditAttrs["class"] = "form-control";
		$this->telepon->EditCustomAttributes = "";
		if (!$this->telepon->Raw)
			$this->telepon->CurrentValue = HtmlDecode($this->telepon->CurrentValue);
		$this->telepon->EditValue = $this->telepon->CurrentValue;
		$this->telepon->PlaceHolder = RemoveHtml($this->telepon->caption());

		// hp
		$this->hp->EditAttrs["class"] = "form-control";
		$this->hp->EditCustomAttributes = "";
		if (!$this->hp->Raw)
			$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
		$this->hp->EditValue = $this->hp->CurrentValue;
		$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		if (!$this->_email->Raw)
			$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

		// fax
		$this->fax->EditAttrs["class"] = "form-control";
		$this->fax->EditCustomAttributes = "";
		if (!$this->fax->Raw)
			$this->fax->CurrentValue = HtmlDecode($this->fax->CurrentValue);
		$this->fax->EditValue = $this->fax->CurrentValue;
		$this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

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
					$doc->exportCaption($this->bioid);
					$doc->exportCaption($this->kdinstruktur);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->tglterbit);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->komp_materi);
					$doc->exportCaption($this->tmplahir);
					$doc->exportCaption($this->tgllahir);
					$doc->exportCaption($this->agama);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->instansi);
					$doc->exportCaption($this->pekerjaan);
					$doc->exportCaption($this->alamatkantor);
					$doc->exportCaption($this->alamatrumah);
					$doc->exportCaption($this->telepon);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->fax);
				} else {
					$doc->exportCaption($this->kdinstruktur);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->tglterbit);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->komp_materi);
					$doc->exportCaption($this->tmplahir);
					$doc->exportCaption($this->tgllahir);
					$doc->exportCaption($this->agama);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->instansi);
					$doc->exportCaption($this->pekerjaan);
					$doc->exportCaption($this->alamatkantor);
					$doc->exportCaption($this->alamatrumah);
					$doc->exportCaption($this->telepon);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->fax);
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
						$doc->exportField($this->kdinstruktur);
						$doc->exportField($this->revisi);
						$doc->exportField($this->tglterbit);
						$doc->exportField($this->nama);
						$doc->exportField($this->komp_materi);
						$doc->exportField($this->tmplahir);
						$doc->exportField($this->tgllahir);
						$doc->exportField($this->agama);
						$doc->exportField($this->kategori);
						$doc->exportField($this->instansi);
						$doc->exportField($this->pekerjaan);
						$doc->exportField($this->alamatkantor);
						$doc->exportField($this->alamatrumah);
						$doc->exportField($this->telepon);
						$doc->exportField($this->hp);
						$doc->exportField($this->_email);
						$doc->exportField($this->fax);
					} else {
						$doc->exportField($this->kdinstruktur);
						$doc->exportField($this->revisi);
						$doc->exportField($this->tglterbit);
						$doc->exportField($this->nama);
						$doc->exportField($this->komp_materi);
						$doc->exportField($this->tmplahir);
						$doc->exportField($this->tgllahir);
						$doc->exportField($this->agama);
						$doc->exportField($this->kategori);
						$doc->exportField($this->instansi);
						$doc->exportField($this->pekerjaan);
						$doc->exportField($this->alamatkantor);
						$doc->exportField($this->alamatrumah);
						$doc->exportField($this->telepon);
						$doc->exportField($this->hp);
						$doc->exportField($this->_email);
						$doc->exportField($this->fax);
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
		$table = 't_biointruktur';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_biointruktur';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['bioid'];

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
		$table = 't_biointruktur';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['bioid'];

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
		$table = 't_biointruktur';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['bioid'];

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
		if(@$_GET["rp"] == 1) { // pengajar internal
			AddFilter($filter, "kategori = 1"); 
		} else if(@$_GET["rp"] == 2) { // pengajar eksternal
			AddFilter($filter, "kategori = 2"); 
		}
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
		if(!empty($this->komp_materi->AdvancedSearch->SearchValue)){
			$idpengajar = "";
			$rs = Execute("SELECT bioid FROM `t_faskur` WHERE kurikulumid=".$this->komp_materi->AdvancedSearch->SearchValue.""); 
			$no =1;
			if (@$rs->RecordCount() > 0) { // periksa dan pastikan jumlah record lebih besar dari nol
				$rs->MoveFirst(); // mulai dari record pertama
				while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset
					$koma = "";
					if($no > 1) $koma = ",";
					$idpengajar .= $koma.$rs->fields("bioid");
					$no++;
				$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
				} // akhirdataku loop
			$rs->Close();
			if(!empty($this->nama->AdvancedSearch->SearchValue)){
				$filter = "(`nama` LIKE '%".$this->nama->AdvancedSearch->SearchValue."%') AND (bioid IN (".$idpengajar."))"; 
			} else {
				$filter = "bioid IN (".$idpengajar.")"; 
			}
			}
		}

		//die($filter);
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

		/* Minta Manual
		$firstalphabet = strtoupper(substr($rsnew["nama"],0,1)); // mengambil huruf pertama nama instruktur
			if ($firstalphabet != "") {
				$dtc = ExecuteScalar("SELECT MAX(RIGHT(kdinstruktur,2))+1 FROM `t_biointruktur` WHERE LEFT(kdinstruktur,1) LIKE '".$firstalphabet."'"); // mengambil angka terakhir
				$dtc = $dtc + 1;
				if($dtc == 1000){
					$this->setFailureMessage("Kode Instruktur penuh!");
					return FALSE;
				}
				$sNextKode = $firstalphabet . sprintf('%03s', $dtc); // format hasilnya dan tambahkan prefix
			} else {
				$this->setFailureMessage("Format nama salah!");
				return FALSE;
			}
		$rsnew["kdinstruktur"] = $sNextKode;
		*/ 
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

		if ($this->PageID == "list" || $this->PageID == "view") { // List/View page only
				$rs = Execute("SELECT kurikulum FROM `t_faskur` a INNER JOIN `t_kurikulum` b ON a.kurikulumid = b.kurikulumid WHERE a.bioid = '".$this->bioid->CurrentValue."'"); 
				$no =1;
				if ($rs->RecordCount() >0) { // periksa dan pastikan jumlah record lebih besar dari nol
					$rs->MoveFirst(); // mulai dari record pertama
					while (!$rs->EOF) { // loop selama belum mencapai akhir file atau akhir recordset
						$this->komp_materi->ViewValue .= $no.". ".$rs->fields("kurikulum")."<br>";
						$no++;
					$rs->MoveNext(); // jangan lupa untuk menggerakkan ke record berikutnya
					} // akhirdataku loop
				$rs->Close();
				} else {
					$this->komp_materi->ViewValue = "";
				}
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>