<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for cv_coachingprogram
 */
class cv_coachingprogram extends DbTable
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
	public $kdpelat;
	public $kdjudul;
	public $kdkursil;
	public $revisi;
	public $tawal;
	public $takhir;
	public $kdprop;
	public $kdkota;
	public $kdkec;
	public $ketua;
	public $bendahara;
	public $sekretaris;
	public $jenispel;
	public $kdkategori;
	public $kerjasama;
	public $biaya;
	public $coachingprogr;
	public $area;
	public $periode_awal;
	public $periode_akhir;
	public $tahapan;
	public $jpeserta2;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'cv_coachingprogram';
		$this->TableName = 'cv_coachingprogram';
		$this->TableType = 'CUSTOMVIEW';

		// Update Table
		$this->UpdateTable = "t_pelatihan";
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

		// kdpelat
		$this->kdpelat = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_kdpelat', 'kdpelat', 't_pelatihan.kdpelat', 't_pelatihan.kdpelat', 200, 20, -1, FALSE, 't_pelatihan.kdpelat', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpelat->Nullable = FALSE; // NOT NULL field
		$this->kdpelat->Required = TRUE; // Required field
		$this->kdpelat->Sortable = TRUE; // Allow sort
		$this->fields['kdpelat'] = &$this->kdpelat;

		// kdjudul
		$this->kdjudul = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_kdjudul', 'kdjudul', 't_pelatihan.kdjudul', 't_pelatihan.kdjudul', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], ["x_kdkursil","x_revisi"], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// kdkursil
		$this->kdkursil = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_kdkursil', 'kdkursil', 't_pelatihan.kdkursil', 't_pelatihan.kdkursil', 200, 12, -1, FALSE, 't_pelatihan.kdkursil', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkursil->Required = TRUE; // Required field
		$this->kdkursil->Sortable = TRUE; // Allow sort
		$this->kdkursil->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkursil->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkursil->Lookup = new Lookup('kdkursil', 't_juduldetail', FALSE, 'kdkursil', ["kdkursil","","",""], ["x_kdjudul"], [], ["kdjudul"], ["x_kdjudul"], [], [], '', '');
		$this->fields['kdkursil'] = &$this->kdkursil;

		// revisi
		$this->revisi = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_revisi', 'revisi', 't_pelatihan.revisi', 't_pelatihan.revisi', 200, 2, -1, FALSE, 't_pelatihan.revisi', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->revisi->Required = TRUE; // Required field
		$this->revisi->Sortable = TRUE; // Allow sort
		$this->revisi->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->revisi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->revisi->Lookup = new Lookup('revisi', 't_juduldetail', FALSE, 'revisi', ["revisi","","",""], ["x_kdjudul"], [], ["kdjudul"], ["x_kdjudul"], [], [], '', '');
		$this->fields['revisi'] = &$this->revisi;

		// tawal
		$this->tawal = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_tawal', 'tawal', 't_pelatihan.tawal', CastDateFieldForLike("t_pelatihan.tawal", 0, "DB"), 135, 19, 0, FALSE, 't_pelatihan.tawal', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tawal->Required = TRUE; // Required field
		$this->tawal->Sortable = TRUE; // Allow sort
		$this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tawal'] = &$this->tawal;

		// takhir
		$this->takhir = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_takhir', 'takhir', 't_pelatihan.takhir', CastDateFieldForLike("t_pelatihan.takhir", 0, "DB"), 135, 19, 0, FALSE, 't_pelatihan.takhir', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->takhir->Required = TRUE; // Required field
		$this->takhir->Sortable = TRUE; // Allow sort
		$this->takhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['takhir'] = &$this->takhir;

		// kdprop
		$this->kdprop = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_kdprop', 'kdprop', 't_pelatihan.kdprop', 't_pelatihan.kdprop', 3, 11, -1, FALSE, 't_pelatihan.kdprop', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdprop->Required = TRUE; // Required field
		$this->kdprop->Sortable = TRUE; // Allow sort
		$this->kdprop->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdprop->Lookup = new Lookup('kdprop', 't_prop', FALSE, 'kdprop', ["prop","","",""], [], ["x_kdkota"], [], [], [], [], '`prop` ASC', '');
		$this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop'] = &$this->kdprop;

		// kdkota
		$this->kdkota = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_kdkota', 'kdkota', 't_pelatihan.kdkota', 't_pelatihan.kdkota', 3, 11, -1, FALSE, 't_pelatihan.kdkota', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkota->Required = TRUE; // Required field
		$this->kdkota->Sortable = TRUE; // Allow sort
		$this->kdkota->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkota->Lookup = new Lookup('kdkota', 't_kota', FALSE, 'kdkota', ["kota","","",""], ["x_kdprop"], ["x_kdkec"], ["kdprop"], ["x_kdprop"], [], [], '`kota` ASC', '');
		$this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkota'] = &$this->kdkota;

		// kdkec
		$this->kdkec = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_kdkec', 'kdkec', 't_pelatihan.kdkec', 't_pelatihan.kdkec', 3, 11, -1, FALSE, '`EV__kdkec`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkec->Sortable = TRUE; // Allow sort
		$this->kdkec->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkec->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkec->Lookup = new Lookup('kdkec', 't_kec', FALSE, 'kdkec', ["kec","","",""], ["x_kdkota"], [], ["kdkota"], ["x_kdkota"], [], [], '`kec` ASC', '');
		$this->kdkec->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkec'] = &$this->kdkec;

		// ketua
		$this->ketua = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_ketua', 'ketua', 't_pelatihan.ketua', 't_pelatihan.ketua', 200, 40, -1, FALSE, 't_pelatihan.ketua', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ketua->Sortable = TRUE; // Allow sort
		$this->ketua->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ketua->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ketua->Lookup = new Lookup('ketua', 't_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['ketua'] = &$this->ketua;

		// bendahara
		$this->bendahara = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_bendahara', 'bendahara', 't_pelatihan.bendahara', 't_pelatihan.bendahara', 200, 40, -1, FALSE, 't_pelatihan.bendahara', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bendahara->Sortable = TRUE; // Allow sort
		$this->bendahara->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bendahara->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->bendahara->Lookup = new Lookup('bendahara', 't_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['bendahara'] = &$this->bendahara;

		// sekretaris
		$this->sekretaris = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_sekretaris', 'sekretaris', 't_pelatihan.sekretaris', 't_pelatihan.sekretaris', 200, 40, -1, FALSE, 't_pelatihan.sekretaris', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->sekretaris->Sortable = TRUE; // Allow sort
		$this->sekretaris->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->sekretaris->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->sekretaris->Lookup = new Lookup('sekretaris', 't_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['sekretaris'] = &$this->sekretaris;

		// jenispel
		$this->jenispel = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_jenispel', 'jenispel', 't_pelatihan.jenispel', 't_pelatihan.jenispel', 16, 2, -1, FALSE, 't_pelatihan.jenispel', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenispel->Required = TRUE; // Required field
		$this->jenispel->Sortable = TRUE; // Allow sort
		$this->jenispel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenispel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenispel->Lookup = new Lookup('jenispel', 'cv_coachingprogram', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenispel->OptionCount = 11;
		$this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenispel'] = &$this->jenispel;

		// kdkategori
		$this->kdkategori = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_kdkategori', 'kdkategori', 't_pelatihan.kdkategori', 't_pelatihan.kdkategori', 3, 11, -1, FALSE, 't_pelatihan.kdkategori', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkategori->Required = TRUE; // Required field
		$this->kdkategori->Sortable = TRUE; // Allow sort
		$this->kdkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', FALSE, 'kdkategori', ["kategori","","",""], [], ["x_kerjasama"], [], [], [], [], '`kdkategori` ASC', '');
		$this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkategori'] = &$this->kdkategori;

		// kerjasama
		$this->kerjasama = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_kerjasama', 'kerjasama', 't_pelatihan.kerjasama', 't_pelatihan.kerjasama', 3, 11, -1, FALSE, 't_pelatihan.kerjasama', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kerjasama->Required = TRUE; // Required field
		$this->kerjasama->Sortable = TRUE; // Allow sort
		$this->kerjasama->Lookup = new Lookup('kerjasama', 't_perusahaan', FALSE, 'idp', ["namap","","",""], ["x_kdkategori"], [], ["kdkategori"], ["x_kdkategori"], [], [], '`namap` ASC', '');
		$this->kerjasama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kerjasama'] = &$this->kerjasama;

		// biaya
		$this->biaya = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_biaya', 'biaya', 't_pelatihan.biaya', 't_pelatihan.biaya', 5, 22, -1, FALSE, 't_pelatihan.biaya', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->biaya->Required = TRUE; // Required field
		$this->biaya->Sortable = TRUE; // Allow sort
		$this->biaya->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['biaya'] = &$this->biaya;

		// coachingprogr
		$this->coachingprogr = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_coachingprogr', 'coachingprogr', 't_pelatihan.coachingprogr', 't_pelatihan.coachingprogr', 200, 1, -1, FALSE, 't_pelatihan.coachingprogr', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->coachingprogr->Required = TRUE; // Required field
		$this->coachingprogr->Sortable = TRUE; // Allow sort
		$this->coachingprogr->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->coachingprogr->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->coachingprogr->Lookup = new Lookup('coachingprogr', 'cv_coachingprogram', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->coachingprogr->OptionCount = 2;
		$this->fields['coachingprogr'] = &$this->coachingprogr;

		// area
		$this->area = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_area', 'area', 't_pelatihan.area', 't_pelatihan.area', 200, 100, -1, FALSE, 't_pelatihan.area', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->area->Required = TRUE; // Required field
		$this->area->Sortable = TRUE; // Allow sort
		$this->fields['area'] = &$this->area;

		// periode_awal
		$this->periode_awal = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_periode_awal', 'periode_awal', 't_pelatihan.periode_awal', 't_pelatihan.periode_awal', 2, 4, -1, FALSE, 't_pelatihan.periode_awal', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->periode_awal->Required = TRUE; // Required field
		$this->periode_awal->Sortable = TRUE; // Allow sort
		$this->fields['periode_awal'] = &$this->periode_awal;

		// periode_akhir
		$this->periode_akhir = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_periode_akhir', 'periode_akhir', 't_pelatihan.periode_akhir', 't_pelatihan.periode_akhir', 2, 4, -1, FALSE, 't_pelatihan.periode_akhir', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->periode_akhir->Required = TRUE; // Required field
		$this->periode_akhir->Sortable = TRUE; // Allow sort
		$this->periode_akhir->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['periode_akhir'] = &$this->periode_akhir;

		// tahapan
		$this->tahapan = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_tahapan', 'tahapan', 't_pelatihan.tahapan', 't_pelatihan.tahapan', 2, 3, -1, FALSE, 't_pelatihan.tahapan', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tahapan->Required = TRUE; // Required field
		$this->tahapan->Sortable = TRUE; // Allow sort
		$this->tahapan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tahapan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->tahapan->Lookup = new Lookup('tahapan', 't_tahapan', FALSE, 'kdtahapan', ["Tahapan","","",""], [], [], [], [], [], [], '', '');
		$this->fields['tahapan'] = &$this->tahapan;

		// jpeserta2
		$this->jpeserta2 = new DbField('cv_coachingprogram', 'cv_coachingprogram', 'x_jpeserta2', 'jpeserta2', '(Select Count(1) From t_pp a Where a.kdpelat = t_pelatihan.kdpelat)', '(Select Count(1) From t_pp a Where a.kdpelat = t_pelatihan.kdpelat)', 20, 21, -1, FALSE, '(Select Count(1) From t_pp a Where a.kdpelat = t_pelatihan.kdpelat)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jpeserta2->Sortable = TRUE; // Allow sort
		$this->jpeserta2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jpeserta2'] = &$this->jpeserta2;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "t_pelatihan";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT t_pelatihan.kdpelat, t_pelatihan.kdjudul, t_pelatihan.kdkursil, t_pelatihan.revisi, t_pelatihan.tawal, t_pelatihan.takhir, t_pelatihan.ketua, t_pelatihan.bendahara, t_pelatihan.sekretaris, t_pelatihan.kdprop, t_pelatihan.kdkota, t_pelatihan.kdkec, t_pelatihan.jenispel, t_pelatihan.kdkategori, t_pelatihan.kerjasama, t_pelatihan.biaya, t_pelatihan.coachingprogr, t_pelatihan.area, t_pelatihan.periode_awal, t_pelatihan.periode_akhir, t_pelatihan.tahapan, (SELECT Count(1) FROM t_pp a WHERE a.kdpelat = t_pelatihan.kdpelat) AS jpeserta2 FROM " . $this->getSqlFrom();
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
			"SELECT t_pelatihan.kdpelat, t_pelatihan.kdjudul, t_pelatihan.kdkursil, t_pelatihan.revisi, t_pelatihan.tawal, t_pelatihan.takhir, t_pelatihan.ketua, t_pelatihan.bendahara, t_pelatihan.sekretaris, t_pelatihan.kdprop, t_pelatihan.kdkota, t_pelatihan.kdkec, t_pelatihan.jenispel, t_pelatihan.kdkategori, t_pelatihan.kerjasama, t_pelatihan.biaya, t_pelatihan.coachingprogr, t_pelatihan.area, t_pelatihan.periode_awal, t_pelatihan.periode_akhir, t_pelatihan.tahapan, (SELECT Count(1) FROM t_pp a WHERE a.kdpelat = t_pelatihan.kdpelat) AS jpeserta2, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = t_pelatihan.kdjudul LIMIT 1) AS `EV__kdjudul` FROM t_pelatihan" .
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
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "t_pelatihan.coachingprogr = 1";
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
		if ($this->kdkec->AdvancedSearch->SearchValue != "" ||
			$this->kdkec->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->kdkec->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->kdkec->VirtualExpression . " "))
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
		$this->kdpelat->DbValue = $row['kdpelat'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->kdkursil->DbValue = $row['kdkursil'];
		$this->revisi->DbValue = $row['revisi'];
		$this->tawal->DbValue = $row['tawal'];
		$this->takhir->DbValue = $row['takhir'];
		$this->kdprop->DbValue = $row['kdprop'];
		$this->kdkota->DbValue = $row['kdkota'];
		$this->kdkec->DbValue = $row['kdkec'];
		$this->ketua->DbValue = $row['ketua'];
		$this->bendahara->DbValue = $row['bendahara'];
		$this->sekretaris->DbValue = $row['sekretaris'];
		$this->jenispel->DbValue = $row['jenispel'];
		$this->kdkategori->DbValue = $row['kdkategori'];
		$this->kerjasama->DbValue = $row['kerjasama'];
		$this->biaya->DbValue = $row['biaya'];
		$this->coachingprogr->DbValue = $row['coachingprogr'];
		$this->area->DbValue = $row['area'];
		$this->periode_awal->DbValue = $row['periode_awal'];
		$this->periode_akhir->DbValue = $row['periode_akhir'];
		$this->tahapan->DbValue = $row['tahapan'];
		$this->jpeserta2->DbValue = $row['jpeserta2'];
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
			return "cv_coachingprogramlist.php";
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
		if ($pageName == "cv_coachingprogramview.php")
			return $Language->phrase("View");
		elseif ($pageName == "cv_coachingprogramedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "cv_coachingprogramadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "cv_coachingprogramlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("cv_coachingprogramview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("cv_coachingprogramview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "cv_coachingprogramadd.php?" . $this->getUrlParm($parm);
		else
			$url = "cv_coachingprogramadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("cv_coachingprogramedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("cv_coachingprogramadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("cv_coachingprogramdelete.php", $this->getUrlParm());
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
		$this->kdpelat->setDbValue($rs->fields('kdpelat'));
		$this->kdjudul->setDbValue($rs->fields('kdjudul'));
		$this->kdkursil->setDbValue($rs->fields('kdkursil'));
		$this->revisi->setDbValue($rs->fields('revisi'));
		$this->tawal->setDbValue($rs->fields('tawal'));
		$this->takhir->setDbValue($rs->fields('takhir'));
		$this->kdprop->setDbValue($rs->fields('kdprop'));
		$this->kdkota->setDbValue($rs->fields('kdkota'));
		$this->kdkec->setDbValue($rs->fields('kdkec'));
		$this->ketua->setDbValue($rs->fields('ketua'));
		$this->bendahara->setDbValue($rs->fields('bendahara'));
		$this->sekretaris->setDbValue($rs->fields('sekretaris'));
		$this->jenispel->setDbValue($rs->fields('jenispel'));
		$this->kdkategori->setDbValue($rs->fields('kdkategori'));
		$this->kerjasama->setDbValue($rs->fields('kerjasama'));
		$this->biaya->setDbValue($rs->fields('biaya'));
		$this->coachingprogr->setDbValue($rs->fields('coachingprogr'));
		$this->area->setDbValue($rs->fields('area'));
		$this->periode_awal->setDbValue($rs->fields('periode_awal'));
		$this->periode_akhir->setDbValue($rs->fields('periode_akhir'));
		$this->tahapan->setDbValue($rs->fields('tahapan'));
		$this->jpeserta2->setDbValue($rs->fields('jpeserta2'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// kdpelat
		// kdjudul
		// kdkursil
		// revisi
		// tawal
		// takhir
		// kdprop
		// kdkota

		$this->kdkota->CellCssStyle = "white-space: nowrap;";

		// kdkec
		// ketua
		// bendahara
		// sekretaris
		// jenispel
		// kdkategori
		// kerjasama
		// biaya
		// coachingprogr
		// area
		// periode_awal
		// periode_akhir
		// tahapan
		// jpeserta2
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

		// kdkursil
		$curVal = strval($this->kdkursil->CurrentValue);
		if ($curVal != "") {
			$this->kdkursil->ViewValue = $this->kdkursil->lookupCacheOption($curVal);
			if ($this->kdkursil->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdkursil`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->kdkursil->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdkursil->ViewValue = $this->kdkursil->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
				}
			}
		} else {
			$this->kdkursil->ViewValue = NULL;
		}
		$this->kdkursil->ViewCustomAttributes = "";

		// revisi
		$curVal = strval($this->revisi->CurrentValue);
		if ($curVal != "") {
			$this->revisi->ViewValue = $this->revisi->lookupCacheOption($curVal);
			if ($this->revisi->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`revisi`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->revisi->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->revisi->ViewValue = $this->revisi->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->revisi->ViewValue = $this->revisi->CurrentValue;
				}
			}
		} else {
			$this->revisi->ViewValue = NULL;
		}
		$this->revisi->ViewCustomAttributes = "";

		// tawal
		$this->tawal->ViewValue = $this->tawal->CurrentValue;
		$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->ViewValue = $this->takhir->CurrentValue;
		$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
		$this->takhir->ViewCustomAttributes = "";

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

		// kdkec
		if ($this->kdkec->VirtualValue != "") {
			$this->kdkec->ViewValue = $this->kdkec->VirtualValue;
		} else {
			$curVal = strval($this->kdkec->CurrentValue);
			if ($curVal != "") {
				$this->kdkec->ViewValue = $this->kdkec->lookupCacheOption($curVal);
				if ($this->kdkec->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kdkec`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdkec->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdkec->ViewValue = $this->kdkec->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdkec->ViewValue = $this->kdkec->CurrentValue;
					}
				}
			} else {
				$this->kdkec->ViewValue = NULL;
			}
		}
		$this->kdkec->ViewCustomAttributes = "";

		// ketua
		$curVal = strval($this->ketua->CurrentValue);
		if ($curVal != "") {
			$this->ketua->ViewValue = $this->ketua->lookupCacheOption($curVal);
			if ($this->ketua->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ketua->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ketua->ViewValue = $this->ketua->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ketua->ViewValue = $this->ketua->CurrentValue;
				}
			}
		} else {
			$this->ketua->ViewValue = NULL;
		}
		$this->ketua->ViewCustomAttributes = "";

		// bendahara
		$curVal = strval($this->bendahara->CurrentValue);
		if ($curVal != "") {
			$this->bendahara->ViewValue = $this->bendahara->lookupCacheOption($curVal);
			if ($this->bendahara->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->bendahara->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->bendahara->ViewValue = $this->bendahara->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->bendahara->ViewValue = $this->bendahara->CurrentValue;
				}
			}
		} else {
			$this->bendahara->ViewValue = NULL;
		}
		$this->bendahara->ViewCustomAttributes = "";

		// sekretaris
		$curVal = strval($this->sekretaris->CurrentValue);
		if ($curVal != "") {
			$this->sekretaris->ViewValue = $this->sekretaris->lookupCacheOption($curVal);
			if ($this->sekretaris->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->sekretaris->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->sekretaris->ViewValue = $this->sekretaris->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->sekretaris->ViewValue = $this->sekretaris->CurrentValue;
				}
			}
		} else {
			$this->sekretaris->ViewValue = NULL;
		}
		$this->sekretaris->ViewCustomAttributes = "";

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

		// biaya
		$this->biaya->ViewValue = $this->biaya->CurrentValue;
		$this->biaya->ViewValue = FormatNumber($this->biaya->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->biaya->ViewCustomAttributes = "";

		// coachingprogr
		if (strval($this->coachingprogr->CurrentValue) != "") {
			$this->coachingprogr->ViewValue = $this->coachingprogr->optionCaption($this->coachingprogr->CurrentValue);
		} else {
			$this->coachingprogr->ViewValue = NULL;
		}
		$this->coachingprogr->ViewCustomAttributes = "";

		// area
		$this->area->ViewValue = $this->area->CurrentValue;
		$this->area->ViewCustomAttributes = "";

		// periode_awal
		$this->periode_awal->ViewValue = $this->periode_awal->CurrentValue;
		$this->periode_awal->ViewCustomAttributes = "";

		// periode_akhir
		$this->periode_akhir->ViewValue = $this->periode_akhir->CurrentValue;
		$this->periode_akhir->ViewCustomAttributes = "";

		// tahapan
		$curVal = strval($this->tahapan->CurrentValue);
		if ($curVal != "") {
			$this->tahapan->ViewValue = $this->tahapan->lookupCacheOption($curVal);
			if ($this->tahapan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdtahapan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->tahapan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->tahapan->ViewValue = $this->tahapan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->tahapan->ViewValue = $this->tahapan->CurrentValue;
				}
			}
		} else {
			$this->tahapan->ViewValue = NULL;
		}
		$this->tahapan->ViewCustomAttributes = "";

		// jpeserta2
		$this->jpeserta2->ViewValue = $this->jpeserta2->CurrentValue;
		$this->jpeserta2->ViewCustomAttributes = "";

		// kdpelat
		$this->kdpelat->LinkCustomAttributes = "";
		$this->kdpelat->HrefValue = "";
		$this->kdpelat->TooltipValue = "";

		// kdjudul
		$this->kdjudul->LinkCustomAttributes = "";
		$this->kdjudul->HrefValue = "";
		$this->kdjudul->TooltipValue = "";

		// kdkursil
		$this->kdkursil->LinkCustomAttributes = "";
		$this->kdkursil->HrefValue = "";
		$this->kdkursil->TooltipValue = "";

		// revisi
		$this->revisi->LinkCustomAttributes = "";
		$this->revisi->HrefValue = "";
		$this->revisi->TooltipValue = "";

		// tawal
		$this->tawal->LinkCustomAttributes = "";
		$this->tawal->HrefValue = "";
		$this->tawal->TooltipValue = "";

		// takhir
		$this->takhir->LinkCustomAttributes = "";
		$this->takhir->HrefValue = "";
		$this->takhir->TooltipValue = "";

		// kdprop
		$this->kdprop->LinkCustomAttributes = "";
		$this->kdprop->HrefValue = "";
		$this->kdprop->TooltipValue = "";

		// kdkota
		$this->kdkota->LinkCustomAttributes = "";
		$this->kdkota->HrefValue = "";
		$this->kdkota->TooltipValue = "";

		// kdkec
		$this->kdkec->LinkCustomAttributes = "";
		$this->kdkec->HrefValue = "";
		$this->kdkec->TooltipValue = "";

		// ketua
		$this->ketua->LinkCustomAttributes = "";
		$this->ketua->HrefValue = "";
		$this->ketua->TooltipValue = "";

		// bendahara
		$this->bendahara->LinkCustomAttributes = "";
		$this->bendahara->HrefValue = "";
		$this->bendahara->TooltipValue = "";

		// sekretaris
		$this->sekretaris->LinkCustomAttributes = "";
		$this->sekretaris->HrefValue = "";
		$this->sekretaris->TooltipValue = "";

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

		// biaya
		$this->biaya->LinkCustomAttributes = "";
		$this->biaya->HrefValue = "";
		$this->biaya->TooltipValue = "";

		// coachingprogr
		$this->coachingprogr->LinkCustomAttributes = "";
		$this->coachingprogr->HrefValue = "";
		$this->coachingprogr->TooltipValue = "";

		// area
		$this->area->LinkCustomAttributes = "";
		$this->area->HrefValue = "";
		$this->area->TooltipValue = "";

		// periode_awal
		$this->periode_awal->LinkCustomAttributes = "";
		$this->periode_awal->HrefValue = "";
		$this->periode_awal->TooltipValue = "";

		// periode_akhir
		$this->periode_akhir->LinkCustomAttributes = "";
		$this->periode_akhir->HrefValue = "";
		$this->periode_akhir->TooltipValue = "";

		// tahapan
		$this->tahapan->LinkCustomAttributes = "";
		$this->tahapan->HrefValue = "";
		$this->tahapan->TooltipValue = "";

		// jpeserta2
		$this->jpeserta2->LinkCustomAttributes = "";
		$this->jpeserta2->HrefValue = "";
		$this->jpeserta2->TooltipValue = "";

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

		// kdpelat
		$this->kdpelat->EditAttrs["class"] = "form-control";
		$this->kdpelat->EditCustomAttributes = "";
		if (!$this->kdpelat->Raw)
			$this->kdpelat->CurrentValue = HtmlDecode($this->kdpelat->CurrentValue);
		$this->kdpelat->EditValue = $this->kdpelat->CurrentValue;
		$this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

		// kdjudul
		$this->kdjudul->EditAttrs["class"] = "form-control";
		$this->kdjudul->EditCustomAttributes = "";
		if (!$this->kdjudul->Raw)
			$this->kdjudul->CurrentValue = HtmlDecode($this->kdjudul->CurrentValue);
		$this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
		$this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

		// kdkursil
		$this->kdkursil->EditAttrs["class"] = "form-control";
		$this->kdkursil->EditCustomAttributes = "";

		// revisi
		$this->revisi->EditAttrs["class"] = "form-control";
		$this->revisi->EditCustomAttributes = "";

		// tawal
		$this->tawal->EditAttrs["class"] = "form-control";
		$this->tawal->EditCustomAttributes = "";
		$this->tawal->EditValue = FormatDateTime($this->tawal->CurrentValue, 8);
		$this->tawal->PlaceHolder = RemoveHtml($this->tawal->caption());

		// takhir
		$this->takhir->EditAttrs["class"] = "form-control";
		$this->takhir->EditCustomAttributes = "";
		$this->takhir->EditValue = FormatDateTime($this->takhir->CurrentValue, 8);
		$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

		// kdprop
		$this->kdprop->EditAttrs["class"] = "form-control";
		$this->kdprop->EditCustomAttributes = "";

		// kdkota
		$this->kdkota->EditAttrs["class"] = "form-control";
		$this->kdkota->EditCustomAttributes = "";

		// kdkec
		$this->kdkec->EditAttrs["class"] = "form-control";
		$this->kdkec->EditCustomAttributes = "";
		if ($this->kdkec->VirtualValue != "") {
			$this->kdkec->EditValue = $this->kdkec->VirtualValue;
		} else {
			$curVal = strval($this->kdkec->CurrentValue);
			if ($curVal != "") {
				$this->kdkec->EditValue = $this->kdkec->lookupCacheOption($curVal);
				if ($this->kdkec->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kdkec`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kdkec->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kdkec->EditValue = $this->kdkec->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kdkec->EditValue = $this->kdkec->CurrentValue;
					}
				}
			} else {
				$this->kdkec->EditValue = NULL;
			}
		}
		$this->kdkec->ViewCustomAttributes = "";

		// ketua
		$this->ketua->EditAttrs["class"] = "form-control";
		$this->ketua->EditCustomAttributes = "";

		// bendahara
		$this->bendahara->EditAttrs["class"] = "form-control";
		$this->bendahara->EditCustomAttributes = "";

		// sekretaris
		$this->sekretaris->EditAttrs["class"] = "form-control";
		$this->sekretaris->EditCustomAttributes = "";

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

		// biaya
		$this->biaya->EditAttrs["class"] = "form-control";
		$this->biaya->EditCustomAttributes = "";
		$this->biaya->EditValue = $this->biaya->CurrentValue;
		$this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
		if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue))
			$this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -1, -2, 0);
		

		// coachingprogr
		$this->coachingprogr->EditAttrs["class"] = "form-control";
		$this->coachingprogr->EditCustomAttributes = "";
		$this->coachingprogr->EditValue = $this->coachingprogr->options(TRUE);

		// area
		$this->area->EditAttrs["class"] = "form-control";
		$this->area->EditCustomAttributes = "";
		if (!$this->area->Raw)
			$this->area->CurrentValue = HtmlDecode($this->area->CurrentValue);
		$this->area->EditValue = $this->area->CurrentValue;
		$this->area->PlaceHolder = RemoveHtml($this->area->caption());

		// periode_awal
		$this->periode_awal->EditAttrs["class"] = "form-control";
		$this->periode_awal->EditCustomAttributes = "";
		$this->periode_awal->EditValue = $this->periode_awal->CurrentValue;
		$this->periode_awal->PlaceHolder = RemoveHtml($this->periode_awal->caption());

		// periode_akhir
		$this->periode_akhir->EditAttrs["class"] = "form-control";
		$this->periode_akhir->EditCustomAttributes = "";
		$this->periode_akhir->EditValue = $this->periode_akhir->CurrentValue;
		$this->periode_akhir->PlaceHolder = RemoveHtml($this->periode_akhir->caption());

		// tahapan
		$this->tahapan->EditAttrs["class"] = "form-control";
		$this->tahapan->EditCustomAttributes = "";

		// jpeserta2
		$this->jpeserta2->EditAttrs["class"] = "form-control";
		$this->jpeserta2->EditCustomAttributes = "";
		$this->jpeserta2->EditValue = $this->jpeserta2->CurrentValue;
		$this->jpeserta2->PlaceHolder = RemoveHtml($this->jpeserta2->caption());

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
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdkec);
					$doc->exportCaption($this->ketua);
					$doc->exportCaption($this->bendahara);
					$doc->exportCaption($this->sekretaris);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->biaya);
					$doc->exportCaption($this->coachingprogr);
					$doc->exportCaption($this->area);
					$doc->exportCaption($this->periode_awal);
					$doc->exportCaption($this->periode_akhir);
					$doc->exportCaption($this->tahapan);
					$doc->exportCaption($this->jpeserta2);
				} else {
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->ketua);
					$doc->exportCaption($this->bendahara);
					$doc->exportCaption($this->sekretaris);
					$doc->exportCaption($this->periode_awal);
					$doc->exportCaption($this->periode_akhir);
					$doc->exportCaption($this->jpeserta2);
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
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdkec);
						$doc->exportField($this->ketua);
						$doc->exportField($this->bendahara);
						$doc->exportField($this->sekretaris);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->biaya);
						$doc->exportField($this->coachingprogr);
						$doc->exportField($this->area);
						$doc->exportField($this->periode_awal);
						$doc->exportField($this->periode_akhir);
						$doc->exportField($this->tahapan);
						$doc->exportField($this->jpeserta2);
					} else {
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->ketua);
						$doc->exportField($this->bendahara);
						$doc->exportField($this->sekretaris);
						$doc->exportField($this->periode_awal);
						$doc->exportField($this->periode_akhir);
						$doc->exportField($this->jpeserta2);
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
		$table = 'cv_coachingprogram';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'cv_coachingprogram';

		// Get key value
		$key = "";

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
		$table = 'cv_coachingprogram';

		// Get key value
		$key = "";

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
		$table = 'cv_coachingprogram';

		// Get key value
		$key = "";

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