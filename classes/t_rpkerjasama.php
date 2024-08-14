<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_rpkerjasama
 */
class t_rpkerjasama extends DbTable
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
	public $rpkid;
	public $jenispel;
	public $kdkategori;
	public $kerjasama;
	public $angkatan;
	public $sisa_angkatan;
	public $targetpes;
	public $kdprop;
	public $kdkota;
	public $tempat;
	public $dana;
	public $kontak_person;
	public $tglrevisi;
	public $tahun_rencana;
	public $mou;
	public $mou2;
	public $mou3;
	public $sk;
	public $sk2;
	public $sk3;
	public $sk4;
	public $sk5;
	public $jml_hari;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_rpkerjasama';
		$this->TableName = 't_rpkerjasama';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_rpkerjasama`";
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

		// rpkid
		$this->rpkid = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_rpkid', 'rpkid', '`rpkid`', '`rpkid`', 3, 11, -1, FALSE, '`rpkid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->rpkid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->rpkid->IsPrimaryKey = TRUE; // Primary key field
		$this->rpkid->IsForeignKey = TRUE; // Foreign key field
		$this->rpkid->Sortable = TRUE; // Allow sort
		$this->rpkid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rpkid'] = &$this->rpkid;

		// jenispel
		$this->jenispel = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_jenispel', 'jenispel', '`jenispel`', '`jenispel`', 16, 2, -1, FALSE, '`jenispel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenispel->IsForeignKey = TRUE; // Foreign key field
		$this->jenispel->Required = TRUE; // Required field
		$this->jenispel->Sortable = TRUE; // Allow sort
		$this->jenispel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenispel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenispel->Lookup = new Lookup('jenispel', 't_rpkerjasama', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenispel->OptionCount = 10;
		$this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenispel'] = &$this->jenispel;

		// kdkategori
		$this->kdkategori = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, FALSE, '`kdkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkategori->Required = TRUE; // Required field
		$this->kdkategori->Sortable = TRUE; // Allow sort
		$this->kdkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', FALSE, 'kdkategori', ["kategori","","",""], [], ["x_kerjasama"], [], [], [], [], '`kdkategori` ASC', '');
		$this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkategori'] = &$this->kdkategori;

		// kerjasama
		$this->kerjasama = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_kerjasama', 'kerjasama', '`kerjasama`', '`kerjasama`', 3, 11, -1, FALSE, '`kerjasama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kerjasama->Required = TRUE; // Required field
		$this->kerjasama->Sortable = TRUE; // Allow sort
		$this->kerjasama->Lookup = new Lookup('kerjasama', 't_perusahaan', FALSE, 'idp', ["namap","","",""], ["x_kdkategori"], [], ["kdkategori"], ["x_kdkategori"], [], [], '`namap` ASC', '');
		$this->kerjasama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kerjasama'] = &$this->kerjasama;

		// angkatan
		$this->angkatan = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_angkatan', 'angkatan', '`angkatan`', '`angkatan`', 3, 3, -1, FALSE, '`angkatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->angkatan->Required = TRUE; // Required field
		$this->angkatan->Sortable = TRUE; // Allow sort
		$this->angkatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['angkatan'] = &$this->angkatan;

		// sisa_angkatan
		$this->sisa_angkatan = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_sisa_angkatan', 'sisa_angkatan', '(t_rpkerjasama.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.jenispel = t_rpkerjasama.jenispel AND t_pelatihan.rid = t_rpkerjasama.rpkid))', '(t_rpkerjasama.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.jenispel = t_rpkerjasama.jenispel AND t_pelatihan.rid = t_rpkerjasama.rpkid))', 20, 22, -1, FALSE, '(t_rpkerjasama.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.jenispel = t_rpkerjasama.jenispel AND t_pelatihan.rid = t_rpkerjasama.rpkid))', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sisa_angkatan->IsCustom = TRUE; // Custom field
		$this->sisa_angkatan->Sortable = TRUE; // Allow sort
		$this->sisa_angkatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sisa_angkatan'] = &$this->sisa_angkatan;

		// targetpes
		$this->targetpes = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_targetpes', 'targetpes', '`targetpes`', '`targetpes`', 3, 3, -1, FALSE, '`targetpes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes->Required = TRUE; // Required field
		$this->targetpes->Sortable = TRUE; // Allow sort
		$this->targetpes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes'] = &$this->targetpes;

		// kdprop
		$this->kdprop = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, FALSE, '`kdprop`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdprop->Required = TRUE; // Required field
		$this->kdprop->Sortable = TRUE; // Allow sort
		$this->kdprop->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdprop->Lookup = new Lookup('kdprop', 't_prop', FALSE, 'kdprop', ["prop","","",""], [], ["x_kdkota"], [], [], [], [], '`prop` ASC', '');
		$this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop'] = &$this->kdprop;

		// kdkota
		$this->kdkota = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_kdkota', 'kdkota', '`kdkota`', '`kdkota`', 3, 11, -1, FALSE, '`kdkota`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkota->Required = TRUE; // Required field
		$this->kdkota->Sortable = TRUE; // Allow sort
		$this->kdkota->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkota->Lookup = new Lookup('kdkota', 't_kota', FALSE, 'kdkota', ["kota","","",""], ["x_kdprop"], [], ["kdprop"], ["x_kdprop"], [], [], '`kota` ASC', '');
		$this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkota'] = &$this->kdkota;

		// tempat
		$this->tempat = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_tempat', 'tempat', '`tempat`', '`tempat`', 200, 255, -1, FALSE, '`tempat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tempat->Required = TRUE; // Required field
		$this->tempat->Sortable = TRUE; // Allow sort
		$this->fields['tempat'] = &$this->tempat;

		// dana
		$this->dana = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_dana', 'dana', '`dana`', '`dana`', 131, 15, -1, FALSE, '`dana`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dana->Nullable = FALSE; // NOT NULL field
		$this->dana->Required = TRUE; // Required field
		$this->dana->Sortable = TRUE; // Allow sort
		$this->dana->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['dana'] = &$this->dana;

		// kontak_person
		$this->kontak_person = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_kontak_person', 'kontak_person', '`kontak_person`', '`kontak_person`', 201, 65535, -1, FALSE, '`kontak_person`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->kontak_person->Sortable = TRUE; // Allow sort
		$this->fields['kontak_person'] = &$this->kontak_person;

		// tglrevisi
		$this->tglrevisi = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_tglrevisi', 'tglrevisi', '`tglrevisi`', CastDateFieldForLike("`tglrevisi`", 0, "DB"), 133, 10, 0, FALSE, '`tglrevisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglrevisi->Required = TRUE; // Required field
		$this->tglrevisi->Sortable = TRUE; // Allow sort
		$this->tglrevisi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tglrevisi'] = &$this->tglrevisi;

		// tahun_rencana
		$this->tahun_rencana = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_tahun_rencana', 'tahun_rencana', '`tahun_rencana`', '`tahun_rencana`', 3, 4, -1, FALSE, '`tahun_rencana`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tahun_rencana->Required = TRUE; // Required field
		$this->tahun_rencana->Sortable = TRUE; // Allow sort
		$this->tahun_rencana->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tahun_rencana'] = &$this->tahun_rencana;

		// mou
		$this->mou = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_mou', 'mou', '`mou`', '`mou`', 200, 255, -1, TRUE, '`mou`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->mou->Sortable = TRUE; // Allow sort
		$this->fields['mou'] = &$this->mou;

		// mou2
		$this->mou2 = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_mou2', 'mou2', '`mou2`', '`mou2`', 200, 255, -1, TRUE, '`mou2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->mou2->Sortable = TRUE; // Allow sort
		$this->fields['mou2'] = &$this->mou2;

		// mou3
		$this->mou3 = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_mou3', 'mou3', '`mou3`', '`mou3`', 200, 255, -1, TRUE, '`mou3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->mou3->Sortable = TRUE; // Allow sort
		$this->fields['mou3'] = &$this->mou3;

		// sk
		$this->sk = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_sk', 'sk', '`sk`', '`sk`', 200, 255, -1, TRUE, '`sk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->sk->Sortable = TRUE; // Allow sort
		$this->fields['sk'] = &$this->sk;

		// sk2
		$this->sk2 = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_sk2', 'sk2', '`sk2`', '`sk2`', 200, 255, -1, TRUE, '`sk2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->sk2->Sortable = TRUE; // Allow sort
		$this->fields['sk2'] = &$this->sk2;

		// sk3
		$this->sk3 = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_sk3', 'sk3', '`sk3`', '`sk3`', 200, 255, -1, TRUE, '`sk3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->sk3->Sortable = TRUE; // Allow sort
		$this->fields['sk3'] = &$this->sk3;

		// sk4
		$this->sk4 = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_sk4', 'sk4', '`sk4`', '`sk4`', 200, 255, -1, TRUE, '`sk4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->sk4->Sortable = TRUE; // Allow sort
		$this->fields['sk4'] = &$this->sk4;

		// sk5
		$this->sk5 = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_sk5', 'sk5', '`sk5`', '`sk5`', 200, 255, -1, TRUE, '`sk5`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->sk5->Sortable = TRUE; // Allow sort
		$this->fields['sk5'] = &$this->sk5;

		// jml_hari
		$this->jml_hari = new DbField('t_rpkerjasama', 't_rpkerjasama', 'x_jml_hari', 'jml_hari', '`jml_hari`', '`jml_hari`', 16, 3, -1, FALSE, '`jml_hari`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_hari->Sortable = TRUE; // Allow sort
		$this->jml_hari->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jml_hari'] = &$this->jml_hari;
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
		if ($this->getCurrentDetailTable() == "diklatkerjasama") {
			$detailUrl = $GLOBALS["diklatkerjasama"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_rpkid=" . urlencode($this->rpkid->CurrentValue);
			$detailUrl .= "&fk_jenispel=" . urlencode($this->jenispel->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_rpkerjasamalist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_rpkerjasama`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, (t_rpkerjasama.angkatan - (SELECT COUNT(1) FROM t_pelatihan WHERE t_pelatihan.jenispel = t_rpkerjasama.jenispel AND t_pelatihan.rid = t_rpkerjasama.rpkid)) AS `sisa_angkatan` FROM " . $this->getSqlFrom();
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
			$this->rpkid->setDbValue($conn->insert_ID());
			$rs['rpkid'] = $this->rpkid->DbValue;
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

		// Cascade Update detail table 'diklatkerjasama'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['rpkid']) && $rsold['rpkid'] != $rs['rpkid'])) { // Update detail field 'rid'
			$cascadeUpdate = TRUE;
			$rscascade['rid'] = $rs['rpkid'];
		}
		if ($rsold && (isset($rs['jenispel']) && $rsold['jenispel'] != $rs['jenispel'])) { // Update detail field 'jenispel'
			$cascadeUpdate = TRUE;
			$rscascade['jenispel'] = $rs['jenispel'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["diklatkerjasama"]))
				$GLOBALS["diklatkerjasama"] = new diklatkerjasama();
			$rswrk = $GLOBALS["diklatkerjasama"]->loadRs("`rid` = " . QuotedValue($rsold['rpkid'], DATATYPE_NUMBER, 'DB') . " AND " . "`jenispel` = " . QuotedValue($rsold['jenispel'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'idpelat';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["diklatkerjasama"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["diklatkerjasama"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["diklatkerjasama"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
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
			if (array_key_exists('rpkid', $rs))
				AddFilter($where, QuotedName('rpkid', $this->Dbid) . '=' . QuotedValue($rs['rpkid'], $this->rpkid->DataType, $this->Dbid));
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

		// Cascade delete detail table 'diklatkerjasama'
		if (!isset($GLOBALS["diklatkerjasama"]))
			$GLOBALS["diklatkerjasama"] = new diklatkerjasama();
		$rscascade = $GLOBALS["diklatkerjasama"]->loadRs("`rid` = " . QuotedValue($rs['rpkid'], DATATYPE_NUMBER, "DB") . " AND " . "`jenispel` = " . QuotedValue($rs['jenispel'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["diklatkerjasama"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["diklatkerjasama"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["diklatkerjasama"]->Row_Deleted($dtlrow);
		}
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
		$this->rpkid->DbValue = $row['rpkid'];
		$this->jenispel->DbValue = $row['jenispel'];
		$this->kdkategori->DbValue = $row['kdkategori'];
		$this->kerjasama->DbValue = $row['kerjasama'];
		$this->angkatan->DbValue = $row['angkatan'];
		$this->sisa_angkatan->DbValue = $row['sisa_angkatan'];
		$this->targetpes->DbValue = $row['targetpes'];
		$this->kdprop->DbValue = $row['kdprop'];
		$this->kdkota->DbValue = $row['kdkota'];
		$this->tempat->DbValue = $row['tempat'];
		$this->dana->DbValue = $row['dana'];
		$this->kontak_person->DbValue = $row['kontak_person'];
		$this->tglrevisi->DbValue = $row['tglrevisi'];
		$this->tahun_rencana->DbValue = $row['tahun_rencana'];
		$this->mou->Upload->DbValue = $row['mou'];
		$this->mou2->Upload->DbValue = $row['mou2'];
		$this->mou3->Upload->DbValue = $row['mou3'];
		$this->sk->Upload->DbValue = $row['sk'];
		$this->sk2->Upload->DbValue = $row['sk2'];
		$this->sk3->Upload->DbValue = $row['sk3'];
		$this->sk4->Upload->DbValue = $row['sk4'];
		$this->sk5->Upload->DbValue = $row['sk5'];
		$this->jml_hari->DbValue = $row['jml_hari'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['mou']) ? [] : [$row['mou']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->mou->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->mou->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['mou2']) ? [] : [$row['mou2']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->mou2->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->mou2->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['mou3']) ? [] : [$row['mou3']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->mou3->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->mou3->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['sk']) ? [] : [$row['sk']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->sk->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->sk->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['sk2']) ? [] : [$row['sk2']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->sk2->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->sk2->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['sk3']) ? [] : [$row['sk3']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->sk3->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->sk3->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['sk4']) ? [] : [$row['sk4']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->sk4->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->sk4->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['sk5']) ? [] : [$row['sk5']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->sk5->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->sk5->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`rpkid` = @rpkid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('rpkid', $row) ? $row['rpkid'] : NULL;
		else
			$val = $this->rpkid->OldValue !== NULL ? $this->rpkid->OldValue : $this->rpkid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@rpkid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_rpkerjasamalist.php";
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
		if ($pageName == "t_rpkerjasamaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_rpkerjasamaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_rpkerjasamaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_rpkerjasamalist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_rpkerjasamaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rpkerjasamaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_rpkerjasamaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_rpkerjasamaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_rpkerjasamaedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rpkerjasamaedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("t_rpkerjasamaadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_rpkerjasamaadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_rpkerjasamadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "rpkid:" . JsonEncode($this->rpkid->CurrentValue, "number");
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
		if ($this->rpkid->CurrentValue != NULL) {
			$url .= "rpkid=" . urlencode($this->rpkid->CurrentValue);
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
			if (Param("rpkid") !== NULL)
				$arKeys[] = Param("rpkid");
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
				$this->rpkid->CurrentValue = $key;
			else
				$this->rpkid->OldValue = $key;
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
		$this->rpkid->setDbValue($rs->fields('rpkid'));
		$this->jenispel->setDbValue($rs->fields('jenispel'));
		$this->kdkategori->setDbValue($rs->fields('kdkategori'));
		$this->kerjasama->setDbValue($rs->fields('kerjasama'));
		$this->angkatan->setDbValue($rs->fields('angkatan'));
		$this->sisa_angkatan->setDbValue($rs->fields('sisa_angkatan'));
		$this->targetpes->setDbValue($rs->fields('targetpes'));
		$this->kdprop->setDbValue($rs->fields('kdprop'));
		$this->kdkota->setDbValue($rs->fields('kdkota'));
		$this->tempat->setDbValue($rs->fields('tempat'));
		$this->dana->setDbValue($rs->fields('dana'));
		$this->kontak_person->setDbValue($rs->fields('kontak_person'));
		$this->tglrevisi->setDbValue($rs->fields('tglrevisi'));
		$this->tahun_rencana->setDbValue($rs->fields('tahun_rencana'));
		$this->mou->Upload->DbValue = $rs->fields('mou');
		$this->mou2->Upload->DbValue = $rs->fields('mou2');
		$this->mou3->Upload->DbValue = $rs->fields('mou3');
		$this->sk->Upload->DbValue = $rs->fields('sk');
		$this->sk2->Upload->DbValue = $rs->fields('sk2');
		$this->sk3->Upload->DbValue = $rs->fields('sk3');
		$this->sk4->Upload->DbValue = $rs->fields('sk4');
		$this->sk5->Upload->DbValue = $rs->fields('sk5');
		$this->jml_hari->setDbValue($rs->fields('jml_hari'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// rpkid
		// jenispel
		// kdkategori
		// kerjasama
		// angkatan
		// sisa_angkatan
		// targetpes
		// kdprop
		// kdkota

		$this->kdkota->CellCssStyle = "white-space: nowrap;";

		// tempat
		// dana

		$this->dana->CellCssStyle = "white-space: nowrap;";

		// kontak_person
		// tglrevisi
		// tahun_rencana
		// mou
		// mou2
		// mou3
		// sk
		// sk2
		// sk3
		// sk4
		// sk5
		// jml_hari
		// rpkid

		$this->rpkid->ViewValue = $this->rpkid->CurrentValue;
		$this->rpkid->ViewCustomAttributes = "";

		// jenispel
		if (strval($this->jenispel->CurrentValue) != "") {
			$this->jenispel->ViewValue = $this->jenispel->optionCaption($this->jenispel->CurrentValue);
		} else {
			$this->jenispel->ViewValue = NULL;
		}
		$this->jenispel->ViewCustomAttributes = "";

		// kdkategori
		$curVal = strval($this->kdkategori->CurrentValue);
		if ($curVal != "") {
			$this->kdkategori->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
			if ($this->kdkategori->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdkategori`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdkategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdkategori->ViewValue = $this->kdkategori->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdkategori->ViewValue = $this->kdkategori->CurrentValue;
				}
			}
		} else {
			$this->kdkategori->ViewValue = NULL;
		}
		$this->kdkategori->ViewCustomAttributes = "";

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

		// angkatan
		$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
		$this->angkatan->ViewCustomAttributes = "";

		// sisa_angkatan
		$this->sisa_angkatan->ViewValue = $this->sisa_angkatan->CurrentValue;
		$this->sisa_angkatan->ViewValue = FormatNumber($this->sisa_angkatan->ViewValue, 0, -2, -2, -2);
		$this->sisa_angkatan->ViewCustomAttributes = "";

		// targetpes
		$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
		$this->targetpes->ViewCustomAttributes = "";

		// kdprop
		$curVal = strval($this->kdprop->CurrentValue);
		if ($curVal != "") {
			$this->kdprop->ViewValue = $this->kdprop->lookupCacheOption($curVal);
			if ($this->kdprop->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdprop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdprop->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdprop->ViewValue = $this->kdprop->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdprop->ViewValue = $this->kdprop->CurrentValue;
				}
			}
		} else {
			$this->kdprop->ViewValue = NULL;
		}
		$this->kdprop->ViewCustomAttributes = "";

		// kdkota
		$curVal = strval($this->kdkota->CurrentValue);
		if ($curVal != "") {
			$this->kdkota->ViewValue = $this->kdkota->lookupCacheOption($curVal);
			if ($this->kdkota->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdkota->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdkota->ViewValue = $this->kdkota->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdkota->ViewValue = $this->kdkota->CurrentValue;
				}
			}
		} else {
			$this->kdkota->ViewValue = NULL;
		}
		$this->kdkota->ViewCustomAttributes = "";

		// tempat
		$this->tempat->ViewValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

		// dana
		$this->dana->ViewValue = $this->dana->CurrentValue;
		$this->dana->ViewValue = FormatCurrency($this->dana->ViewValue, 0, -2, -2, -2);
		$this->dana->ViewCustomAttributes = "";

		// kontak_person
		$this->kontak_person->ViewValue = $this->kontak_person->CurrentValue;
		$this->kontak_person->ViewCustomAttributes = "";

		// tglrevisi
		$this->tglrevisi->ViewValue = $this->tglrevisi->CurrentValue;
		$this->tglrevisi->ViewValue = FormatDateTime($this->tglrevisi->ViewValue, 0);
		$this->tglrevisi->ViewCustomAttributes = "";

		// tahun_rencana
		$this->tahun_rencana->ViewValue = $this->tahun_rencana->CurrentValue;
		$this->tahun_rencana->ViewCustomAttributes = "";

		// mou
		if (!EmptyValue($this->mou->Upload->DbValue)) {
			$this->mou->ViewValue = $this->mou->Upload->DbValue;
		} else {
			$this->mou->ViewValue = "";
		}
		$this->mou->ViewCustomAttributes = "";

		// mou2
		if (!EmptyValue($this->mou2->Upload->DbValue)) {
			$this->mou2->ViewValue = $this->mou2->Upload->DbValue;
		} else {
			$this->mou2->ViewValue = "";
		}
		$this->mou2->ViewCustomAttributes = "";

		// mou3
		if (!EmptyValue($this->mou3->Upload->DbValue)) {
			$this->mou3->ViewValue = $this->mou3->Upload->DbValue;
		} else {
			$this->mou3->ViewValue = "";
		}
		$this->mou3->ViewCustomAttributes = "";

		// sk
		if (!EmptyValue($this->sk->Upload->DbValue)) {
			$this->sk->ViewValue = $this->sk->Upload->DbValue;
		} else {
			$this->sk->ViewValue = "";
		}
		$this->sk->ViewCustomAttributes = "";

		// sk2
		if (!EmptyValue($this->sk2->Upload->DbValue)) {
			$this->sk2->ViewValue = $this->sk2->Upload->DbValue;
		} else {
			$this->sk2->ViewValue = "";
		}
		$this->sk2->ViewCustomAttributes = "";

		// sk3
		if (!EmptyValue($this->sk3->Upload->DbValue)) {
			$this->sk3->ViewValue = $this->sk3->Upload->DbValue;
		} else {
			$this->sk3->ViewValue = "";
		}
		$this->sk3->ViewCustomAttributes = "";

		// sk4
		if (!EmptyValue($this->sk4->Upload->DbValue)) {
			$this->sk4->ViewValue = $this->sk4->Upload->DbValue;
		} else {
			$this->sk4->ViewValue = "";
		}
		$this->sk4->ViewCustomAttributes = "";

		// sk5
		if (!EmptyValue($this->sk5->Upload->DbValue)) {
			$this->sk5->ViewValue = $this->sk5->Upload->DbValue;
		} else {
			$this->sk5->ViewValue = "";
		}
		$this->sk5->ViewCustomAttributes = "";

		// jml_hari
		$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
		$this->jml_hari->ViewCustomAttributes = "";

		// rpkid
		$this->rpkid->LinkCustomAttributes = "";
		$this->rpkid->HrefValue = "";
		$this->rpkid->TooltipValue = "";

		// jenispel
		$this->jenispel->LinkCustomAttributes = "";
		$this->jenispel->HrefValue = "";
		$this->jenispel->TooltipValue = "";

		// kdkategori
		$this->kdkategori->LinkCustomAttributes = "";
		$this->kdkategori->HrefValue = "";
		$this->kdkategori->TooltipValue = "";

		// kerjasama
		$this->kerjasama->LinkCustomAttributes = "";
		$this->kerjasama->HrefValue = "";
		$this->kerjasama->TooltipValue = "";

		// angkatan
		$this->angkatan->LinkCustomAttributes = "";
		$this->angkatan->HrefValue = "";
		$this->angkatan->TooltipValue = "";

		// sisa_angkatan
		$this->sisa_angkatan->LinkCustomAttributes = "";
		$this->sisa_angkatan->HrefValue = "";
		$this->sisa_angkatan->TooltipValue = "";

		// targetpes
		$this->targetpes->LinkCustomAttributes = "";
		$this->targetpes->HrefValue = "";
		$this->targetpes->TooltipValue = "";

		// kdprop
		$this->kdprop->LinkCustomAttributes = "";
		$this->kdprop->HrefValue = "";
		$this->kdprop->TooltipValue = "";

		// kdkota
		$this->kdkota->LinkCustomAttributes = "";
		$this->kdkota->HrefValue = "";
		$this->kdkota->TooltipValue = "";

		// tempat
		$this->tempat->LinkCustomAttributes = "";
		$this->tempat->HrefValue = "";
		$this->tempat->TooltipValue = "";

		// dana
		$this->dana->LinkCustomAttributes = "";
		$this->dana->HrefValue = "";
		$this->dana->TooltipValue = "";

		// kontak_person
		$this->kontak_person->LinkCustomAttributes = "";
		$this->kontak_person->HrefValue = "";
		$this->kontak_person->TooltipValue = "";

		// tglrevisi
		$this->tglrevisi->LinkCustomAttributes = "";
		$this->tglrevisi->HrefValue = "";
		$this->tglrevisi->TooltipValue = "";

		// tahun_rencana
		$this->tahun_rencana->LinkCustomAttributes = "";
		$this->tahun_rencana->HrefValue = "";
		$this->tahun_rencana->TooltipValue = "";

		// mou
		$this->mou->LinkCustomAttributes = "";
		$this->mou->HrefValue = "";
		$this->mou->ExportHrefValue = $this->mou->UploadPath . $this->mou->Upload->DbValue;
		$this->mou->TooltipValue = "";

		// mou2
		$this->mou2->LinkCustomAttributes = "";
		$this->mou2->HrefValue = "";
		$this->mou2->ExportHrefValue = $this->mou2->UploadPath . $this->mou2->Upload->DbValue;
		$this->mou2->TooltipValue = "";

		// mou3
		$this->mou3->LinkCustomAttributes = "";
		$this->mou3->HrefValue = "";
		$this->mou3->ExportHrefValue = $this->mou3->UploadPath . $this->mou3->Upload->DbValue;
		$this->mou3->TooltipValue = "";

		// sk
		$this->sk->LinkCustomAttributes = "";
		$this->sk->HrefValue = "";
		$this->sk->ExportHrefValue = $this->sk->UploadPath . $this->sk->Upload->DbValue;
		$this->sk->TooltipValue = "";

		// sk2
		$this->sk2->LinkCustomAttributes = "";
		$this->sk2->HrefValue = "";
		$this->sk2->ExportHrefValue = $this->sk2->UploadPath . $this->sk2->Upload->DbValue;
		$this->sk2->TooltipValue = "";

		// sk3
		$this->sk3->LinkCustomAttributes = "";
		$this->sk3->HrefValue = "";
		$this->sk3->ExportHrefValue = $this->sk3->UploadPath . $this->sk3->Upload->DbValue;
		$this->sk3->TooltipValue = "";

		// sk4
		$this->sk4->LinkCustomAttributes = "";
		$this->sk4->HrefValue = "";
		$this->sk4->ExportHrefValue = $this->sk4->UploadPath . $this->sk4->Upload->DbValue;
		$this->sk4->TooltipValue = "";

		// sk5
		$this->sk5->LinkCustomAttributes = "";
		$this->sk5->HrefValue = "";
		$this->sk5->ExportHrefValue = $this->sk5->UploadPath . $this->sk5->Upload->DbValue;
		$this->sk5->TooltipValue = "";

		// jml_hari
		$this->jml_hari->LinkCustomAttributes = "";
		$this->jml_hari->HrefValue = "";
		$this->jml_hari->TooltipValue = "";

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

		// rpkid
		$this->rpkid->EditAttrs["class"] = "form-control";
		$this->rpkid->EditCustomAttributes = "";
		$this->rpkid->EditValue = $this->rpkid->CurrentValue;
		$this->rpkid->ViewCustomAttributes = "";

		// jenispel
		$this->jenispel->EditAttrs["class"] = "form-control";
		$this->jenispel->EditCustomAttributes = "";
		$this->jenispel->EditValue = $this->jenispel->options(TRUE);

		// kdkategori
		$this->kdkategori->EditAttrs["class"] = "form-control";
		$this->kdkategori->EditCustomAttributes = "";

		// kerjasama
		$this->kerjasama->EditAttrs["class"] = "form-control";
		$this->kerjasama->EditCustomAttributes = "";
		$this->kerjasama->EditValue = $this->kerjasama->CurrentValue;
		$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

		// angkatan
		$this->angkatan->EditAttrs["class"] = "form-control";
		$this->angkatan->EditCustomAttributes = "";
		$this->angkatan->EditValue = $this->angkatan->CurrentValue;
		$this->angkatan->PlaceHolder = RemoveHtml($this->angkatan->caption());

		// sisa_angkatan
		$this->sisa_angkatan->EditAttrs["class"] = "form-control";
		$this->sisa_angkatan->EditCustomAttributes = "";
		$this->sisa_angkatan->EditValue = $this->sisa_angkatan->CurrentValue;
		$this->sisa_angkatan->PlaceHolder = RemoveHtml($this->sisa_angkatan->caption());

		// targetpes
		$this->targetpes->EditAttrs["class"] = "form-control";
		$this->targetpes->EditCustomAttributes = "";
		$this->targetpes->EditValue = $this->targetpes->CurrentValue;
		$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

		// kdprop
		$this->kdprop->EditAttrs["class"] = "form-control";
		$this->kdprop->EditCustomAttributes = "";

		// kdkota
		$this->kdkota->EditAttrs["class"] = "form-control";
		$this->kdkota->EditCustomAttributes = "";

		// tempat
		$this->tempat->EditAttrs["class"] = "form-control";
		$this->tempat->EditCustomAttributes = "";
		if (!$this->tempat->Raw)
			$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
		$this->tempat->EditValue = $this->tempat->CurrentValue;
		$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

		// dana
		$this->dana->EditAttrs["class"] = "form-control";
		$this->dana->EditCustomAttributes = "";
		$this->dana->EditValue = $this->dana->CurrentValue;
		$this->dana->PlaceHolder = RemoveHtml($this->dana->caption());
		if (strval($this->dana->EditValue) != "" && is_numeric($this->dana->EditValue))
			$this->dana->EditValue = FormatNumber($this->dana->EditValue, -2, -2, -2, -2);
		

		// kontak_person
		$this->kontak_person->EditAttrs["class"] = "form-control";
		$this->kontak_person->EditCustomAttributes = "";
		$this->kontak_person->EditValue = $this->kontak_person->CurrentValue;
		$this->kontak_person->PlaceHolder = RemoveHtml($this->kontak_person->caption());

		// tglrevisi
		$this->tglrevisi->EditAttrs["class"] = "form-control";
		$this->tglrevisi->EditCustomAttributes = "";
		$this->tglrevisi->EditValue = FormatDateTime($this->tglrevisi->CurrentValue, 8);
		$this->tglrevisi->PlaceHolder = RemoveHtml($this->tglrevisi->caption());

		// tahun_rencana
		$this->tahun_rencana->EditAttrs["class"] = "form-control";
		$this->tahun_rencana->EditCustomAttributes = "";
		$this->tahun_rencana->EditValue = $this->tahun_rencana->CurrentValue;
		$this->tahun_rencana->PlaceHolder = RemoveHtml($this->tahun_rencana->caption());

		// mou
		$this->mou->EditAttrs["class"] = "form-control";
		$this->mou->EditCustomAttributes = "";
		if (!EmptyValue($this->mou->Upload->DbValue)) {
			$this->mou->EditValue = $this->mou->Upload->DbValue;
		} else {
			$this->mou->EditValue = "";
		}
		if (!EmptyValue($this->mou->CurrentValue))
				$this->mou->Upload->FileName = $this->mou->CurrentValue;

		// mou2
		$this->mou2->EditAttrs["class"] = "form-control";
		$this->mou2->EditCustomAttributes = "";
		if (!EmptyValue($this->mou2->Upload->DbValue)) {
			$this->mou2->EditValue = $this->mou2->Upload->DbValue;
		} else {
			$this->mou2->EditValue = "";
		}
		if (!EmptyValue($this->mou2->CurrentValue))
				$this->mou2->Upload->FileName = $this->mou2->CurrentValue;

		// mou3
		$this->mou3->EditAttrs["class"] = "form-control";
		$this->mou3->EditCustomAttributes = "";
		if (!EmptyValue($this->mou3->Upload->DbValue)) {
			$this->mou3->EditValue = $this->mou3->Upload->DbValue;
		} else {
			$this->mou3->EditValue = "";
		}
		if (!EmptyValue($this->mou3->CurrentValue))
				$this->mou3->Upload->FileName = $this->mou3->CurrentValue;

		// sk
		$this->sk->EditAttrs["class"] = "form-control";
		$this->sk->EditCustomAttributes = "";
		if (!EmptyValue($this->sk->Upload->DbValue)) {
			$this->sk->EditValue = $this->sk->Upload->DbValue;
		} else {
			$this->sk->EditValue = "";
		}
		if (!EmptyValue($this->sk->CurrentValue))
				$this->sk->Upload->FileName = $this->sk->CurrentValue;

		// sk2
		$this->sk2->EditAttrs["class"] = "form-control";
		$this->sk2->EditCustomAttributes = "";
		if (!EmptyValue($this->sk2->Upload->DbValue)) {
			$this->sk2->EditValue = $this->sk2->Upload->DbValue;
		} else {
			$this->sk2->EditValue = "";
		}
		if (!EmptyValue($this->sk2->CurrentValue))
				$this->sk2->Upload->FileName = $this->sk2->CurrentValue;

		// sk3
		$this->sk3->EditAttrs["class"] = "form-control";
		$this->sk3->EditCustomAttributes = "";
		if (!EmptyValue($this->sk3->Upload->DbValue)) {
			$this->sk3->EditValue = $this->sk3->Upload->DbValue;
		} else {
			$this->sk3->EditValue = "";
		}
		if (!EmptyValue($this->sk3->CurrentValue))
				$this->sk3->Upload->FileName = $this->sk3->CurrentValue;

		// sk4
		$this->sk4->EditAttrs["class"] = "form-control";
		$this->sk4->EditCustomAttributes = "";
		if (!EmptyValue($this->sk4->Upload->DbValue)) {
			$this->sk4->EditValue = $this->sk4->Upload->DbValue;
		} else {
			$this->sk4->EditValue = "";
		}
		if (!EmptyValue($this->sk4->CurrentValue))
				$this->sk4->Upload->FileName = $this->sk4->CurrentValue;

		// sk5
		$this->sk5->EditAttrs["class"] = "form-control";
		$this->sk5->EditCustomAttributes = "";
		if (!EmptyValue($this->sk5->Upload->DbValue)) {
			$this->sk5->EditValue = $this->sk5->Upload->DbValue;
		} else {
			$this->sk5->EditValue = "";
		}
		if (!EmptyValue($this->sk5->CurrentValue))
				$this->sk5->Upload->FileName = $this->sk5->CurrentValue;

		// jml_hari
		$this->jml_hari->EditAttrs["class"] = "form-control";
		$this->jml_hari->EditCustomAttributes = "";
		$this->jml_hari->EditValue = $this->jml_hari->CurrentValue;
		$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->angkatan->CurrentValue))
				$this->angkatan->Total += $this->angkatan->CurrentValue; // Accumulate total
			if (is_numeric($this->targetpes->CurrentValue))
				$this->targetpes->Total += $this->targetpes->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->angkatan->CurrentValue = $this->angkatan->Total;
			$this->angkatan->ViewValue = $this->angkatan->CurrentValue;
			$this->angkatan->ViewCustomAttributes = "";
			$this->angkatan->HrefValue = ""; // Clear href value
			$this->targetpes->CurrentValue = $this->targetpes->Total;
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->ViewCustomAttributes = "";
			$this->targetpes->HrefValue = ""; // Clear href value

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
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->angkatan);
					$doc->exportCaption($this->sisa_angkatan);
					$doc->exportCaption($this->targetpes);
					$doc->exportCaption($this->kontak_person);
					$doc->exportCaption($this->tglrevisi);
					$doc->exportCaption($this->tahun_rencana);
					$doc->exportCaption($this->mou);
					$doc->exportCaption($this->mou2);
					$doc->exportCaption($this->mou3);
					$doc->exportCaption($this->sk);
					$doc->exportCaption($this->sk2);
					$doc->exportCaption($this->sk3);
					$doc->exportCaption($this->sk4);
					$doc->exportCaption($this->sk5);
					$doc->exportCaption($this->jml_hari);
				} else {
					$doc->exportCaption($this->rpkid);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->angkatan);
					$doc->exportCaption($this->sisa_angkatan);
					$doc->exportCaption($this->targetpes);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->dana);
					$doc->exportCaption($this->kontak_person);
					$doc->exportCaption($this->tglrevisi);
					$doc->exportCaption($this->tahun_rencana);
					$doc->exportCaption($this->sk);
					$doc->exportCaption($this->sk2);
					$doc->exportCaption($this->sk3);
					$doc->exportCaption($this->sk4);
					$doc->exportCaption($this->sk5);
					$doc->exportCaption($this->jml_hari);
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
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->angkatan);
						$doc->exportField($this->sisa_angkatan);
						$doc->exportField($this->targetpes);
						$doc->exportField($this->kontak_person);
						$doc->exportField($this->tglrevisi);
						$doc->exportField($this->tahun_rencana);
						$doc->exportField($this->mou);
						$doc->exportField($this->mou2);
						$doc->exportField($this->mou3);
						$doc->exportField($this->sk);
						$doc->exportField($this->sk2);
						$doc->exportField($this->sk3);
						$doc->exportField($this->sk4);
						$doc->exportField($this->sk5);
						$doc->exportField($this->jml_hari);
					} else {
						$doc->exportField($this->rpkid);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->angkatan);
						$doc->exportField($this->sisa_angkatan);
						$doc->exportField($this->targetpes);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->tempat);
						$doc->exportField($this->dana);
						$doc->exportField($this->kontak_person);
						$doc->exportField($this->tglrevisi);
						$doc->exportField($this->tahun_rencana);
						$doc->exportField($this->sk);
						$doc->exportField($this->sk2);
						$doc->exportField($this->sk3);
						$doc->exportField($this->sk4);
						$doc->exportField($this->sk5);
						$doc->exportField($this->jml_hari);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->rpkid, '');
				$doc->exportAggregate($this->jenispel, '');
				$doc->exportAggregate($this->kdkategori, '');
				$doc->exportAggregate($this->kerjasama, '');
				$doc->exportAggregate($this->angkatan, 'TOTAL');
				$doc->exportAggregate($this->sisa_angkatan, '');
				$doc->exportAggregate($this->targetpes, 'TOTAL');
				$doc->exportAggregate($this->kdprop, '');
				$doc->exportAggregate($this->kdkota, '');
				$doc->exportAggregate($this->tempat, '');
				$doc->exportAggregate($this->dana, '');
				$doc->exportAggregate($this->kontak_person, '');
				$doc->exportAggregate($this->tglrevisi, '');
				$doc->exportAggregate($this->tahun_rencana, '');
				$doc->exportAggregate($this->sk, '');
				$doc->exportAggregate($this->sk2, '');
				$doc->exportAggregate($this->sk3, '');
				$doc->exportAggregate($this->sk4, '');
				$doc->exportAggregate($this->sk5, '');
				$doc->exportAggregate($this->jml_hari, '');
				$doc->endExportRow();
			}
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'mou') {
			$fldName = "mou";
			$fileNameFld = "mou";
		} elseif ($fldparm == 'mou2') {
			$fldName = "mou2";
			$fileNameFld = "mou2";
		} elseif ($fldparm == 'mou3') {
			$fldName = "mou3";
			$fileNameFld = "mou3";
		} elseif ($fldparm == 'sk') {
			$fldName = "sk";
			$fileNameFld = "sk";
		} elseif ($fldparm == 'sk2') {
			$fldName = "sk2";
			$fileNameFld = "sk2";
		} elseif ($fldparm == 'sk3') {
			$fldName = "sk3";
			$fileNameFld = "sk3";
		} elseif ($fldparm == 'sk4') {
			$fldName = "sk4";
			$fileNameFld = "sk4";
		} elseif ($fldparm == 'sk5') {
			$fldName = "sk5";
			$fileNameFld = "sk5";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->rpkid->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
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

		if($this->tahun_rencana->AdvancedSearch->SearchValue == "")
		$this->tahun_rencana->AdvancedSearch->SearchValue = date("Y");
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
		$cek_angkatan = ExecuteScalar("SELECT COUNT(1) FROM `t_pelatihan` WHERE `rid` = '".$rsold["rpkid"]."' AND `jenispel` = '".$rsnew["jenispel"]."'");
		if($cek_angkatan > 0){
			$updatepelatihan = Execute("UPDATE `t_pelatihan` SET `kdkategori` = ".$rsnew["kdkategori"].", `kerjasama` = ".$rsnew["kerjasama"]." WHERE `rid` = ".$rsold["rpkid"]." AND `jenispel` = ".$rsnew["jenispel"]."");
		}
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