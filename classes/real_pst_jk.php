<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for real_pst_jk
 */
class real_pst_jk extends DbTable
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
	public $kdkota;
	public $tawal;
	public $takhir;
	public $dana;
	public $produk;
	public $ket;
	public $bln;
	public $thn;
	public $real_peserta;
	public $kdprop;
	public $independen;
	public $swasta_k;
	public $swasta_m;
	public $swasta_b;
	public $bumn;
	public $koperasi;
	public $pns;
	public $pt_dosen;
	public $pt_mhs;
	public $jk_l;
	public $jk_p;
	public $usia_k45;
	public $usia_b45;
	public $tempat;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'real_pst_jk';
		$this->TableName = 'real_pst_jk';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`real_pst_jk`";
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
		$this->idpelat = new DbField('real_pst_jk', 'real_pst_jk', 'x_idpelat', 'idpelat', '`idpelat`', '`idpelat`', 3, 11, -1, FALSE, '`idpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idpelat->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idpelat->IsPrimaryKey = TRUE; // Primary key field
		$this->idpelat->Sortable = TRUE; // Allow sort
		$this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idpelat'] = &$this->idpelat;

		// kdpelat
		$this->kdpelat = new DbField('real_pst_jk', 'real_pst_jk', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 20, -1, FALSE, '`kdpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpelat->Nullable = FALSE; // NOT NULL field
		$this->kdpelat->Required = TRUE; // Required field
		$this->kdpelat->Sortable = TRUE; // Allow sort
		$this->fields['kdpelat'] = &$this->kdpelat;

		// kdjudul
		$this->kdjudul = new DbField('real_pst_jk', 'real_pst_jk', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// kdkota
		$this->kdkota = new DbField('real_pst_jk', 'real_pst_jk', 'x_kdkota', 'kdkota', '`kdkota`', '`kdkota`', 3, 11, -1, FALSE, '`kdkota`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkota->Required = TRUE; // Required field
		$this->kdkota->Sortable = TRUE; // Allow sort
		$this->kdkota->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkota->Lookup = new Lookup('kdkota', 't_kota', FALSE, 'kdkota', ["kota","","",""], ["x_kdprop"], [], ["kdprop"], ["x_kdprop"], [], [], '`kota` ASC', '');
		$this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkota'] = &$this->kdkota;

		// tawal
		$this->tawal = new DbField('real_pst_jk', 'real_pst_jk', 'x_tawal', 'tawal', '`tawal`', CastDateFieldForLike("`tawal`", 0, "DB"), 135, 19, 0, FALSE, '`tawal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tawal->Required = TRUE; // Required field
		$this->tawal->Sortable = TRUE; // Allow sort
		$this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tawal'] = &$this->tawal;

		// takhir
		$this->takhir = new DbField('real_pst_jk', 'real_pst_jk', 'x_takhir', 'takhir', '`takhir`', CastDateFieldForLike("`takhir`", 0, "DB"), 135, 19, 0, FALSE, '`takhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->takhir->Required = TRUE; // Required field
		$this->takhir->Sortable = TRUE; // Allow sort
		$this->takhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['takhir'] = &$this->takhir;

		// dana
		$this->dana = new DbField('real_pst_jk', 'real_pst_jk', 'x_dana', 'dana', '`dana`', '`dana`', 200, 25, -1, FALSE, '`dana`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->dana->Sortable = TRUE; // Allow sort
		$this->dana->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->dana->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->dana->Lookup = new Lookup('dana', 'real_pst_jk', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->dana->OptionCount = 4;
		$this->fields['dana'] = &$this->dana;

		// produk
		$this->produk = new DbField('real_pst_jk', 'real_pst_jk', 'x_produk', 'produk', '`produk`', '`produk`', 201, 65535, -1, FALSE, '`produk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->produk->Sortable = TRUE; // Allow sort
		$this->fields['produk'] = &$this->produk;

		// ket
		$this->ket = new DbField('real_pst_jk', 'real_pst_jk', 'x_ket', 'ket', '`ket`', '`ket`', 201, 65535, -1, FALSE, '`ket`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ket->Sortable = TRUE; // Allow sort
		$this->fields['ket'] = &$this->ket;

		// bln
		$this->bln = new DbField('real_pst_jk', 'real_pst_jk', 'x_bln', 'bln', '`bln`', '`bln`', 20, 2, -1, FALSE, '`bln`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bln->Sortable = TRUE; // Allow sort
		$this->bln->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bln->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->bln->Lookup = new Lookup('bln', 'real_pst_jk', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->bln->OptionCount = 12;
		$this->bln->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bln'] = &$this->bln;

		// thn
		$this->thn = new DbField('real_pst_jk', 'real_pst_jk', 'x_thn', 'thn', '`thn`', '`thn`', 20, 4, -1, FALSE, '`thn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->thn->Sortable = TRUE; // Allow sort
		$this->thn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->thn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->thn->Lookup = new Lookup('thn', 'real_pst_jk', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->thn->OptionCount = 9;
		$this->thn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['thn'] = &$this->thn;

		// real_peserta
		$this->real_peserta = new DbField('real_pst_jk', 'real_pst_jk', 'x_real_peserta', 'real_peserta', '`real_peserta`', '`real_peserta`', 3, 3, -1, FALSE, '`real_peserta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->real_peserta->Sortable = TRUE; // Allow sort
		$this->real_peserta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['real_peserta'] = &$this->real_peserta;

		// kdprop
		$this->kdprop = new DbField('real_pst_jk', 'real_pst_jk', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, FALSE, '`kdprop`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdprop->Required = TRUE; // Required field
		$this->kdprop->Sortable = TRUE; // Allow sort
		$this->kdprop->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdprop->Lookup = new Lookup('kdprop', 't_prop', FALSE, 'kdprop', ["prop","","",""], [], ["x_kdkota"], [], [], [], [], '`prop` ASC', '');
		$this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop'] = &$this->kdprop;

		// independen
		$this->independen = new DbField('real_pst_jk', 'real_pst_jk', 'x_independen', 'independen', '`independen`', '`independen`', 3, 3, -1, FALSE, '`independen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->independen->Sortable = TRUE; // Allow sort
		$this->independen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['independen'] = &$this->independen;

		// swasta_k
		$this->swasta_k = new DbField('real_pst_jk', 'real_pst_jk', 'x_swasta_k', 'swasta_k', '`swasta_k`', '`swasta_k`', 3, 3, -1, FALSE, '`swasta_k`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->swasta_k->Sortable = TRUE; // Allow sort
		$this->swasta_k->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['swasta_k'] = &$this->swasta_k;

		// swasta_m
		$this->swasta_m = new DbField('real_pst_jk', 'real_pst_jk', 'x_swasta_m', 'swasta_m', '`swasta_m`', '`swasta_m`', 3, 3, -1, FALSE, '`swasta_m`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->swasta_m->Sortable = TRUE; // Allow sort
		$this->swasta_m->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['swasta_m'] = &$this->swasta_m;

		// swasta_b
		$this->swasta_b = new DbField('real_pst_jk', 'real_pst_jk', 'x_swasta_b', 'swasta_b', '`swasta_b`', '`swasta_b`', 3, 3, -1, FALSE, '`swasta_b`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->swasta_b->Sortable = TRUE; // Allow sort
		$this->swasta_b->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['swasta_b'] = &$this->swasta_b;

		// bumn
		$this->bumn = new DbField('real_pst_jk', 'real_pst_jk', 'x_bumn', 'bumn', '`bumn`', '`bumn`', 3, 3, -1, FALSE, '`bumn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bumn->Sortable = TRUE; // Allow sort
		$this->bumn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bumn'] = &$this->bumn;

		// koperasi
		$this->koperasi = new DbField('real_pst_jk', 'real_pst_jk', 'x_koperasi', 'koperasi', '`koperasi`', '`koperasi`', 3, 3, -1, FALSE, '`koperasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->koperasi->Sortable = TRUE; // Allow sort
		$this->koperasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['koperasi'] = &$this->koperasi;

		// pns
		$this->pns = new DbField('real_pst_jk', 'real_pst_jk', 'x_pns', 'pns', '`pns`', '`pns`', 3, 3, -1, FALSE, '`pns`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pns->Sortable = TRUE; // Allow sort
		$this->pns->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pns'] = &$this->pns;

		// pt_dosen
		$this->pt_dosen = new DbField('real_pst_jk', 'real_pst_jk', 'x_pt_dosen', 'pt_dosen', '`pt_dosen`', '`pt_dosen`', 3, 3, -1, FALSE, '`pt_dosen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pt_dosen->Sortable = TRUE; // Allow sort
		$this->pt_dosen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pt_dosen'] = &$this->pt_dosen;

		// pt_mhs
		$this->pt_mhs = new DbField('real_pst_jk', 'real_pst_jk', 'x_pt_mhs', 'pt_mhs', '`pt_mhs`', '`pt_mhs`', 3, 3, -1, FALSE, '`pt_mhs`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pt_mhs->Sortable = TRUE; // Allow sort
		$this->pt_mhs->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pt_mhs'] = &$this->pt_mhs;

		// jk_l
		$this->jk_l = new DbField('real_pst_jk', 'real_pst_jk', 'x_jk_l', 'jk_l', '`jk_l`', '`jk_l`', 3, 3, -1, FALSE, '`jk_l`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jk_l->Sortable = TRUE; // Allow sort
		$this->jk_l->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jk_l'] = &$this->jk_l;

		// jk_p
		$this->jk_p = new DbField('real_pst_jk', 'real_pst_jk', 'x_jk_p', 'jk_p', '`jk_p`', '`jk_p`', 3, 3, -1, FALSE, '`jk_p`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jk_p->Sortable = TRUE; // Allow sort
		$this->jk_p->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jk_p'] = &$this->jk_p;

		// usia_k45
		$this->usia_k45 = new DbField('real_pst_jk', 'real_pst_jk', 'x_usia_k45', 'usia_k45', '`usia_k45`', '`usia_k45`', 3, 3, -1, FALSE, '`usia_k45`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->usia_k45->Sortable = TRUE; // Allow sort
		$this->usia_k45->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['usia_k45'] = &$this->usia_k45;

		// usia_b45
		$this->usia_b45 = new DbField('real_pst_jk', 'real_pst_jk', 'x_usia_b45', 'usia_b45', '`usia_b45`', '`usia_b45`', 3, 3, -1, FALSE, '`usia_b45`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->usia_b45->Sortable = TRUE; // Allow sort
		$this->usia_b45->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['usia_b45'] = &$this->usia_b45;

		// tempat
		$this->tempat = new DbField('real_pst_jk', 'real_pst_jk', 'x_tempat', 'tempat', '`tempat`', '`tempat`', 201, 65535, -1, FALSE, '`tempat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`real_pst_jk`";
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
			"SELECT *, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `real_pst_jk`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `real_pst_jk`" .
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

			// Get insert id if necessary
			$this->idpelat->setDbValue($conn->insert_ID());
			$rs['idpelat'] = $this->idpelat->DbValue;
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
		$this->kdkota->DbValue = $row['kdkota'];
		$this->tawal->DbValue = $row['tawal'];
		$this->takhir->DbValue = $row['takhir'];
		$this->dana->DbValue = $row['dana'];
		$this->produk->DbValue = $row['produk'];
		$this->ket->DbValue = $row['ket'];
		$this->bln->DbValue = $row['bln'];
		$this->thn->DbValue = $row['thn'];
		$this->real_peserta->DbValue = $row['real_peserta'];
		$this->kdprop->DbValue = $row['kdprop'];
		$this->independen->DbValue = $row['independen'];
		$this->swasta_k->DbValue = $row['swasta_k'];
		$this->swasta_m->DbValue = $row['swasta_m'];
		$this->swasta_b->DbValue = $row['swasta_b'];
		$this->bumn->DbValue = $row['bumn'];
		$this->koperasi->DbValue = $row['koperasi'];
		$this->pns->DbValue = $row['pns'];
		$this->pt_dosen->DbValue = $row['pt_dosen'];
		$this->pt_mhs->DbValue = $row['pt_mhs'];
		$this->jk_l->DbValue = $row['jk_l'];
		$this->jk_p->DbValue = $row['jk_p'];
		$this->usia_k45->DbValue = $row['usia_k45'];
		$this->usia_b45->DbValue = $row['usia_b45'];
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
			return "real_pst_jklist.php";
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
		if ($pageName == "real_pst_jkview.php")
			return $Language->phrase("View");
		elseif ($pageName == "real_pst_jkedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "real_pst_jkadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "real_pst_jklist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("real_pst_jkview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("real_pst_jkview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "real_pst_jkadd.php?" . $this->getUrlParm($parm);
		else
			$url = "real_pst_jkadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("real_pst_jkedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("real_pst_jkadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("real_pst_jkdelete.php", $this->getUrlParm());
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
		$this->kdkota->setDbValue($rs->fields('kdkota'));
		$this->tawal->setDbValue($rs->fields('tawal'));
		$this->takhir->setDbValue($rs->fields('takhir'));
		$this->dana->setDbValue($rs->fields('dana'));
		$this->produk->setDbValue($rs->fields('produk'));
		$this->ket->setDbValue($rs->fields('ket'));
		$this->bln->setDbValue($rs->fields('bln'));
		$this->thn->setDbValue($rs->fields('thn'));
		$this->real_peserta->setDbValue($rs->fields('real_peserta'));
		$this->kdprop->setDbValue($rs->fields('kdprop'));
		$this->independen->setDbValue($rs->fields('independen'));
		$this->swasta_k->setDbValue($rs->fields('swasta_k'));
		$this->swasta_m->setDbValue($rs->fields('swasta_m'));
		$this->swasta_b->setDbValue($rs->fields('swasta_b'));
		$this->bumn->setDbValue($rs->fields('bumn'));
		$this->koperasi->setDbValue($rs->fields('koperasi'));
		$this->pns->setDbValue($rs->fields('pns'));
		$this->pt_dosen->setDbValue($rs->fields('pt_dosen'));
		$this->pt_mhs->setDbValue($rs->fields('pt_mhs'));
		$this->jk_l->setDbValue($rs->fields('jk_l'));
		$this->jk_p->setDbValue($rs->fields('jk_p'));
		$this->usia_k45->setDbValue($rs->fields('usia_k45'));
		$this->usia_b45->setDbValue($rs->fields('usia_b45'));
		$this->tempat->setDbValue($rs->fields('tempat'));
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
		// kdkota

		$this->kdkota->CellCssStyle = "white-space: nowrap;";

		// tawal
		// takhir
		// dana
		// produk
		// ket
		// bln
		// thn
		// real_peserta
		// kdprop
		// independen
		// swasta_k
		// swasta_m
		// swasta_b
		// bumn
		// koperasi
		// pns
		// pt_dosen
		// pt_mhs
		// jk_l
		// jk_p
		// usia_k45
		// usia_b45
		// tempat
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

		// tawal
		$this->tawal->ViewValue = $this->tawal->CurrentValue;
		$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->ViewValue = $this->takhir->CurrentValue;
		$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
		$this->takhir->ViewCustomAttributes = "";

		// dana
		if (strval($this->dana->CurrentValue) != "") {
			$this->dana->ViewValue = $this->dana->optionCaption($this->dana->CurrentValue);
		} else {
			$this->dana->ViewValue = NULL;
		}
		$this->dana->ViewCustomAttributes = "";

		// produk
		$this->produk->ViewValue = $this->produk->CurrentValue;
		$this->produk->ViewCustomAttributes = "";

		// ket
		$this->ket->ViewValue = $this->ket->CurrentValue;
		$this->ket->ViewCustomAttributes = "";

		// bln
		if (strval($this->bln->CurrentValue) != "") {
			$this->bln->ViewValue = $this->bln->optionCaption($this->bln->CurrentValue);
		} else {
			$this->bln->ViewValue = NULL;
		}
		$this->bln->ViewCustomAttributes = "";

		// thn
		if (strval($this->thn->CurrentValue) != "") {
			$this->thn->ViewValue = $this->thn->optionCaption($this->thn->CurrentValue);
		} else {
			$this->thn->ViewValue = NULL;
		}
		$this->thn->ViewCustomAttributes = "";

		// real_peserta
		$this->real_peserta->ViewValue = $this->real_peserta->CurrentValue;
		$this->real_peserta->ViewCustomAttributes = "";

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

		// independen
		$this->independen->ViewValue = $this->independen->CurrentValue;
		$this->independen->ViewCustomAttributes = "";

		// swasta_k
		$this->swasta_k->ViewValue = $this->swasta_k->CurrentValue;
		$this->swasta_k->ViewCustomAttributes = "";

		// swasta_m
		$this->swasta_m->ViewValue = $this->swasta_m->CurrentValue;
		$this->swasta_m->ViewCustomAttributes = "";

		// swasta_b
		$this->swasta_b->ViewValue = $this->swasta_b->CurrentValue;
		$this->swasta_b->ViewCustomAttributes = "";

		// bumn
		$this->bumn->ViewValue = $this->bumn->CurrentValue;
		$this->bumn->ViewCustomAttributes = "";

		// koperasi
		$this->koperasi->ViewValue = $this->koperasi->CurrentValue;
		$this->koperasi->ViewCustomAttributes = "";

		// pns
		$this->pns->ViewValue = $this->pns->CurrentValue;
		$this->pns->ViewCustomAttributes = "";

		// pt_dosen
		$this->pt_dosen->ViewValue = $this->pt_dosen->CurrentValue;
		$this->pt_dosen->ViewCustomAttributes = "";

		// pt_mhs
		$this->pt_mhs->ViewValue = $this->pt_mhs->CurrentValue;
		$this->pt_mhs->ViewCustomAttributes = "";

		// jk_l
		$this->jk_l->ViewValue = $this->jk_l->CurrentValue;
		$this->jk_l->ViewCustomAttributes = "";

		// jk_p
		$this->jk_p->ViewValue = $this->jk_p->CurrentValue;
		$this->jk_p->ViewCustomAttributes = "";

		// usia_k45
		$this->usia_k45->ViewValue = $this->usia_k45->CurrentValue;
		$this->usia_k45->ViewCustomAttributes = "";

		// usia_b45
		$this->usia_b45->ViewValue = $this->usia_b45->CurrentValue;
		$this->usia_b45->ViewCustomAttributes = "";

		// tempat
		$this->tempat->ViewValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

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

		// kdkota
		$this->kdkota->LinkCustomAttributes = "";
		$this->kdkota->HrefValue = "";
		$this->kdkota->TooltipValue = "";

		// tawal
		$this->tawal->LinkCustomAttributes = "";
		$this->tawal->HrefValue = "";
		$this->tawal->TooltipValue = "";

		// takhir
		$this->takhir->LinkCustomAttributes = "";
		$this->takhir->HrefValue = "";
		$this->takhir->TooltipValue = "";

		// dana
		$this->dana->LinkCustomAttributes = "";
		$this->dana->HrefValue = "";
		$this->dana->TooltipValue = "";

		// produk
		$this->produk->LinkCustomAttributes = "";
		$this->produk->HrefValue = "";
		$this->produk->TooltipValue = "";

		// ket
		$this->ket->LinkCustomAttributes = "";
		$this->ket->HrefValue = "";
		$this->ket->TooltipValue = "";

		// bln
		$this->bln->LinkCustomAttributes = "";
		$this->bln->HrefValue = "";
		$this->bln->TooltipValue = "";

		// thn
		$this->thn->LinkCustomAttributes = "";
		$this->thn->HrefValue = "";
		$this->thn->TooltipValue = "";

		// real_peserta
		$this->real_peserta->LinkCustomAttributes = "";
		$this->real_peserta->HrefValue = "";
		$this->real_peserta->TooltipValue = "";

		// kdprop
		$this->kdprop->LinkCustomAttributes = "";
		$this->kdprop->HrefValue = "";
		$this->kdprop->TooltipValue = "";

		// independen
		$this->independen->LinkCustomAttributes = "";
		$this->independen->HrefValue = "";
		$this->independen->TooltipValue = "";

		// swasta_k
		$this->swasta_k->LinkCustomAttributes = "";
		$this->swasta_k->HrefValue = "";
		$this->swasta_k->TooltipValue = "";

		// swasta_m
		$this->swasta_m->LinkCustomAttributes = "";
		$this->swasta_m->HrefValue = "";
		$this->swasta_m->TooltipValue = "";

		// swasta_b
		$this->swasta_b->LinkCustomAttributes = "";
		$this->swasta_b->HrefValue = "";
		$this->swasta_b->TooltipValue = "";

		// bumn
		$this->bumn->LinkCustomAttributes = "";
		$this->bumn->HrefValue = "";
		$this->bumn->TooltipValue = "";

		// koperasi
		$this->koperasi->LinkCustomAttributes = "";
		$this->koperasi->HrefValue = "";
		$this->koperasi->TooltipValue = "";

		// pns
		$this->pns->LinkCustomAttributes = "";
		$this->pns->HrefValue = "";
		$this->pns->TooltipValue = "";

		// pt_dosen
		$this->pt_dosen->LinkCustomAttributes = "";
		$this->pt_dosen->HrefValue = "";
		$this->pt_dosen->TooltipValue = "";

		// pt_mhs
		$this->pt_mhs->LinkCustomAttributes = "";
		$this->pt_mhs->HrefValue = "";
		$this->pt_mhs->TooltipValue = "";

		// jk_l
		$this->jk_l->LinkCustomAttributes = "";
		$this->jk_l->HrefValue = "";
		$this->jk_l->TooltipValue = "";

		// jk_p
		$this->jk_p->LinkCustomAttributes = "";
		$this->jk_p->HrefValue = "";
		$this->jk_p->TooltipValue = "";

		// usia_k45
		$this->usia_k45->LinkCustomAttributes = "";
		$this->usia_k45->HrefValue = "";
		$this->usia_k45->TooltipValue = "";

		// usia_b45
		$this->usia_b45->LinkCustomAttributes = "";
		$this->usia_b45->HrefValue = "";
		$this->usia_b45->TooltipValue = "";

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

		// idpelat
		$this->idpelat->EditAttrs["class"] = "form-control";
		$this->idpelat->EditCustomAttributes = "";
		$this->idpelat->EditValue = $this->idpelat->CurrentValue;
		$this->idpelat->ViewCustomAttributes = "";

		// kdpelat
		$this->kdpelat->EditAttrs["class"] = "form-control";
		$this->kdpelat->EditCustomAttributes = "";
		$this->kdpelat->EditValue = $this->kdpelat->CurrentValue;
		$this->kdpelat->ViewCustomAttributes = "";

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

		// kdkota
		$this->kdkota->EditAttrs["class"] = "form-control";
		$this->kdkota->EditCustomAttributes = "";
		$curVal = strval($this->kdkota->CurrentValue);
		if ($curVal != "") {
			$this->kdkota->EditValue = $this->kdkota->lookupCacheOption($curVal);
			if ($this->kdkota->EditValue === NULL) { // Lookup from database
				$filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdkota->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdkota->EditValue = $this->kdkota->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdkota->EditValue = $this->kdkota->CurrentValue;
				}
			}
		} else {
			$this->kdkota->EditValue = NULL;
		}
		$this->kdkota->ViewCustomAttributes = "";

		// tawal
		$this->tawal->EditAttrs["class"] = "form-control";
		$this->tawal->EditCustomAttributes = "";
		$this->tawal->EditValue = $this->tawal->CurrentValue;
		$this->tawal->EditValue = FormatDateTime($this->tawal->EditValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->EditAttrs["class"] = "form-control";
		$this->takhir->EditCustomAttributes = "";
		$this->takhir->EditValue = $this->takhir->CurrentValue;
		$this->takhir->EditValue = FormatDateTime($this->takhir->EditValue, 0);
		$this->takhir->ViewCustomAttributes = "";

		// dana
		$this->dana->EditAttrs["class"] = "form-control";
		$this->dana->EditCustomAttributes = "";
		$this->dana->EditValue = $this->dana->options(TRUE);

		// produk
		$this->produk->EditAttrs["class"] = "form-control";
		$this->produk->EditCustomAttributes = "maxlength='300'";
		$this->produk->EditValue = $this->produk->CurrentValue;
		$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

		// ket
		$this->ket->EditAttrs["class"] = "form-control";
		$this->ket->EditCustomAttributes = "";
		$this->ket->EditValue = $this->ket->CurrentValue;
		$this->ket->PlaceHolder = RemoveHtml($this->ket->caption());

		// bln
		$this->bln->EditAttrs["class"] = "form-control";
		$this->bln->EditCustomAttributes = "";
		$this->bln->EditValue = $this->bln->options(TRUE);

		// thn
		$this->thn->EditAttrs["class"] = "form-control";
		$this->thn->EditCustomAttributes = "";
		$this->thn->EditValue = $this->thn->options(TRUE);

		// real_peserta
		$this->real_peserta->EditAttrs["class"] = "form-control";
		$this->real_peserta->EditCustomAttributes = "";
		$this->real_peserta->EditValue = $this->real_peserta->CurrentValue;
		$this->real_peserta->PlaceHolder = RemoveHtml($this->real_peserta->caption());

		// kdprop
		$this->kdprop->EditAttrs["class"] = "form-control";
		$this->kdprop->EditCustomAttributes = "";
		$curVal = strval($this->kdprop->CurrentValue);
		if ($curVal != "") {
			$this->kdprop->EditValue = $this->kdprop->lookupCacheOption($curVal);
			if ($this->kdprop->EditValue === NULL) { // Lookup from database
				$filterWrk = "`kdprop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdprop->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdprop->EditValue = $this->kdprop->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdprop->EditValue = $this->kdprop->CurrentValue;
				}
			}
		} else {
			$this->kdprop->EditValue = NULL;
		}
		$this->kdprop->ViewCustomAttributes = "";

		// independen
		$this->independen->EditAttrs["class"] = "form-control";
		$this->independen->EditCustomAttributes = "";
		$this->independen->EditValue = $this->independen->CurrentValue;
		$this->independen->PlaceHolder = RemoveHtml($this->independen->caption());

		// swasta_k
		$this->swasta_k->EditAttrs["class"] = "form-control";
		$this->swasta_k->EditCustomAttributes = "";
		$this->swasta_k->EditValue = $this->swasta_k->CurrentValue;
		$this->swasta_k->PlaceHolder = RemoveHtml($this->swasta_k->caption());

		// swasta_m
		$this->swasta_m->EditAttrs["class"] = "form-control";
		$this->swasta_m->EditCustomAttributes = "";
		$this->swasta_m->EditValue = $this->swasta_m->CurrentValue;
		$this->swasta_m->PlaceHolder = RemoveHtml($this->swasta_m->caption());

		// swasta_b
		$this->swasta_b->EditAttrs["class"] = "form-control";
		$this->swasta_b->EditCustomAttributes = "";
		$this->swasta_b->EditValue = $this->swasta_b->CurrentValue;
		$this->swasta_b->PlaceHolder = RemoveHtml($this->swasta_b->caption());

		// bumn
		$this->bumn->EditAttrs["class"] = "form-control";
		$this->bumn->EditCustomAttributes = "";
		$this->bumn->EditValue = $this->bumn->CurrentValue;
		$this->bumn->PlaceHolder = RemoveHtml($this->bumn->caption());

		// koperasi
		$this->koperasi->EditAttrs["class"] = "form-control";
		$this->koperasi->EditCustomAttributes = "";
		$this->koperasi->EditValue = $this->koperasi->CurrentValue;
		$this->koperasi->PlaceHolder = RemoveHtml($this->koperasi->caption());

		// pns
		$this->pns->EditAttrs["class"] = "form-control";
		$this->pns->EditCustomAttributes = "";
		$this->pns->EditValue = $this->pns->CurrentValue;
		$this->pns->PlaceHolder = RemoveHtml($this->pns->caption());

		// pt_dosen
		$this->pt_dosen->EditAttrs["class"] = "form-control";
		$this->pt_dosen->EditCustomAttributes = "";
		$this->pt_dosen->EditValue = $this->pt_dosen->CurrentValue;
		$this->pt_dosen->PlaceHolder = RemoveHtml($this->pt_dosen->caption());

		// pt_mhs
		$this->pt_mhs->EditAttrs["class"] = "form-control";
		$this->pt_mhs->EditCustomAttributes = "";
		$this->pt_mhs->EditValue = $this->pt_mhs->CurrentValue;
		$this->pt_mhs->PlaceHolder = RemoveHtml($this->pt_mhs->caption());

		// jk_l
		$this->jk_l->EditAttrs["class"] = "form-control";
		$this->jk_l->EditCustomAttributes = "";
		$this->jk_l->EditValue = $this->jk_l->CurrentValue;
		$this->jk_l->PlaceHolder = RemoveHtml($this->jk_l->caption());

		// jk_p
		$this->jk_p->EditAttrs["class"] = "form-control";
		$this->jk_p->EditCustomAttributes = "";
		$this->jk_p->EditValue = $this->jk_p->CurrentValue;
		$this->jk_p->PlaceHolder = RemoveHtml($this->jk_p->caption());

		// usia_k45
		$this->usia_k45->EditAttrs["class"] = "form-control";
		$this->usia_k45->EditCustomAttributes = "";
		$this->usia_k45->EditValue = $this->usia_k45->CurrentValue;
		$this->usia_k45->PlaceHolder = RemoveHtml($this->usia_k45->caption());

		// usia_b45
		$this->usia_b45->EditAttrs["class"] = "form-control";
		$this->usia_b45->EditCustomAttributes = "";
		$this->usia_b45->EditValue = $this->usia_b45->CurrentValue;
		$this->usia_b45->PlaceHolder = RemoveHtml($this->usia_b45->caption());

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
					$doc->exportCaption($this->idpelat);
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->produk);
					$doc->exportCaption($this->ket);
					$doc->exportCaption($this->bln);
					$doc->exportCaption($this->thn);
					$doc->exportCaption($this->real_peserta);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->independen);
					$doc->exportCaption($this->swasta_k);
					$doc->exportCaption($this->swasta_m);
					$doc->exportCaption($this->swasta_b);
					$doc->exportCaption($this->bumn);
					$doc->exportCaption($this->koperasi);
					$doc->exportCaption($this->pns);
					$doc->exportCaption($this->pt_dosen);
					$doc->exportCaption($this->pt_mhs);
					$doc->exportCaption($this->jk_l);
					$doc->exportCaption($this->jk_p);
					$doc->exportCaption($this->usia_k45);
					$doc->exportCaption($this->usia_b45);
					$doc->exportCaption($this->tempat);
				} else {
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->swasta_b);
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
						$doc->exportField($this->kdkota);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->produk);
						$doc->exportField($this->ket);
						$doc->exportField($this->bln);
						$doc->exportField($this->thn);
						$doc->exportField($this->real_peserta);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->independen);
						$doc->exportField($this->swasta_k);
						$doc->exportField($this->swasta_m);
						$doc->exportField($this->swasta_b);
						$doc->exportField($this->bumn);
						$doc->exportField($this->koperasi);
						$doc->exportField($this->pns);
						$doc->exportField($this->pt_dosen);
						$doc->exportField($this->pt_mhs);
						$doc->exportField($this->jk_l);
						$doc->exportField($this->jk_p);
						$doc->exportField($this->usia_k45);
						$doc->exportField($this->usia_b45);
						$doc->exportField($this->tempat);
					} else {
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->swasta_b);
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
		if(isset($_GET["bulan"])){
		if(@$_GET["bulan"] == @$_GET["bulan2"]){
			$caribulan = " AND month(tawal) = '".@$_GET["bulan"]."'";
		} else {
			$caribulan = " AND (month(tawal) >= ".@$_GET["bulan"]." AND month(tawal) <= ".@$_GET["bulan2"].")";
		}
		AddFilter($filter, "YEAR(tawal) = ".@$_GET["tahun"].$caribulan);
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

			if($this->real_peserta->ViewValue == 0)
				$this->real_peserta->ViewValue = "";
			if($this->independen->CurrentValue == 0)
				$this->independen->CurrentValue = "";
			if($this->swasta_k->CurrentValue == 0)
				$this->swasta_k->CurrentValue = "";
			if($this->swasta_m->CurrentValue == 0)
				$this->swasta_m->CurrentValue = "";
			if($this->swasta_b->CurrentValue == 0)
				$this->swasta_b->CurrentValue = "";
			if($this->bumn->CurrentValue == 0)
				$this->bumn->CurrentValue = "";
			if($this->koperasi->CurrentValue == 0)
				$this->koperasi->CurrentValue = "";
			if($this->pns->CurrentValue == 0)
				$this->pns->CurrentValue = "";
			if($this->pt_dosen->CurrentValue == 0)
				$this->pt_dosen->CurrentValue = "";
			if($this->pt_mhs->CurrentValue == 0)
				$this->pt_mhs->CurrentValue = "";
			if($this->jk_l->CurrentValue == 0)
				$this->jk_l->CurrentValue = "";
			if($this->jk_p->CurrentValue == 0)
				$this->jk_p->CurrentValue = "";
			if($this->usia_k45->CurrentValue == 0)
				$this->usia_k45->CurrentValue = "";
			if($this->usia_b45->CurrentValue == 0)
				$this->usia_b45->CurrentValue = "";
			if(empty($this->produk->CurrentValue))
				$this->produk->ViewValue = "Tidak menyebutkan produk";
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>