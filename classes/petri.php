<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for petri
 */
class petri extends DbTable
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
	public $kdpelat;
	public $kdjudul;
	public $tawal;
	public $takhir;
	public $nama;
	public $kdprop;
	public $kdkota;
	public $kdsex;
	public $kdjabat;
	public $telp;
	public $hp;
	public $_email;
	public $namap;
	public $kdprop_perusahaan;
	public $kdkota_perusahaan;
	public $kdkategori;
	public $kdjenis;
	public $kdskala;
	public $kdexport;
	public $nexport;
	public $kontak;
	public $independen;
	public $kdproduknafed;
	public $kdproduknafed2;
	public $kdproduknafed3;
	public $pproduk;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'petri';
		$this->TableName = 'petri';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`petri`";
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
		$this->kdpelat = new DbField('petri', 'petri', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 20, -1, FALSE, '`kdpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpelat->Nullable = FALSE; // NOT NULL field
		$this->kdpelat->Required = TRUE; // Required field
		$this->kdpelat->Sortable = TRUE; // Allow sort
		$this->fields['kdpelat'] = &$this->kdpelat;

		// kdjudul
		$this->kdjudul = new DbField('petri', 'petri', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = TRUE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], [], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// tawal
		$this->tawal = new DbField('petri', 'petri', 'x_tawal', 'tawal', '`tawal`', CastDateFieldForLike("`tawal`", 0, "DB"), 135, 19, 0, FALSE, '`tawal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tawal->Required = TRUE; // Required field
		$this->tawal->Sortable = TRUE; // Allow sort
		$this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tawal'] = &$this->tawal;

		// takhir
		$this->takhir = new DbField('petri', 'petri', 'x_takhir', 'takhir', '`takhir`', CastDateFieldForLike("`takhir`", 0, "DB"), 135, 19, 0, FALSE, '`takhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->takhir->Required = TRUE; // Required field
		$this->takhir->Sortable = TRUE; // Allow sort
		$this->takhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['takhir'] = &$this->takhir;

		// nama
		$this->nama = new DbField('petri', 'petri', 'x_nama', 'nama', '`nama`', '`nama`', 200, 50, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// kdprop
		$this->kdprop = new DbField('petri', 'petri', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, FALSE, '`kdprop`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdprop->Required = TRUE; // Required field
		$this->kdprop->Sortable = TRUE; // Allow sort
		$this->kdprop->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdprop->Lookup = new Lookup('kdprop', 't_prop', FALSE, 'kdprop', ["prop","","",""], [], ["x_kdkota","x_kdkota_perusahaan"], [], [], [], [], '`prop` ASC', '');
		$this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop'] = &$this->kdprop;

		// kdkota
		$this->kdkota = new DbField('petri', 'petri', 'x_kdkota', 'kdkota', '`kdkota`', '`kdkota`', 3, 11, -1, FALSE, '`kdkota`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkota->Required = TRUE; // Required field
		$this->kdkota->Sortable = TRUE; // Allow sort
		$this->kdkota->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkota->Lookup = new Lookup('kdkota', 't_kota', FALSE, 'kdkota', ["kota","","",""], ["x_kdprop"], [], ["kdprop"], ["x_kdprop"], [], [], '`kota` ASC', '');
		$this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkota'] = &$this->kdkota;

		// kdsex
		$this->kdsex = new DbField('petri', 'petri', 'x_kdsex', 'kdsex', '`kdsex`', '`kdsex`', 3, 11, -1, FALSE, '`kdsex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->kdsex->Sortable = TRUE; // Allow sort
		$this->kdsex->Lookup = new Lookup('kdsex', 'petri', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->kdsex->OptionCount = 2;
		$this->kdsex->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdsex'] = &$this->kdsex;

		// kdjabat
		$this->kdjabat = new DbField('petri', 'petri', 'x_kdjabat', 'kdjabat', '`kdjabat`', '`kdjabat`', 3, 11, -1, FALSE, '`kdjabat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdjabat->Sortable = TRUE; // Allow sort
		$this->kdjabat->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdjabat->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdjabat->Lookup = new Lookup('kdjabat', 't_jabatan', FALSE, 'kdjabat', ["jabatan","","",""], [], [], [], [], [], [], '', '');
		$this->kdjabat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdjabat'] = &$this->kdjabat;

		// telp
		$this->telp = new DbField('petri', 'petri', 'x_telp', 'telp', '`telp`', '`telp`', 200, 50, -1, FALSE, '`telp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telp->Sortable = TRUE; // Allow sort
		$this->fields['telp'] = &$this->telp;

		// hp
		$this->hp = new DbField('petri', 'petri', 'x_hp', 'hp', '`hp`', '`hp`', 200, 50, -1, FALSE, '`hp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hp->Sortable = TRUE; // Allow sort
		$this->fields['hp'] = &$this->hp;

		// email
		$this->_email = new DbField('petri', 'petri', 'x__email', 'email', '`email`', '`email`', 200, 100, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->_email->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
		$this->fields['email'] = &$this->_email;

		// namap
		$this->namap = new DbField('petri', 'petri', 'x_namap', 'namap', '`namap`', '`namap`', 200, 150, -1, FALSE, '`namap`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->namap->Required = TRUE; // Required field
		$this->namap->Sortable = TRUE; // Allow sort
		$this->fields['namap'] = &$this->namap;

		// kdprop_perusahaan
		$this->kdprop_perusahaan = new DbField('petri', 'petri', 'x_kdprop_perusahaan', 'kdprop_perusahaan', '`kdprop_perusahaan`', '`kdprop_perusahaan`', 3, 11, -1, FALSE, '`kdprop_perusahaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdprop_perusahaan->Required = TRUE; // Required field
		$this->kdprop_perusahaan->Sortable = TRUE; // Allow sort
		$this->kdprop_perusahaan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdprop_perusahaan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdprop_perusahaan->Lookup = new Lookup('kdprop_perusahaan', 't_prop', FALSE, 'kdprop', ["prop","","",""], [], [], [], [], [], [], '`prop` ASC', '');
		$this->kdprop_perusahaan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop_perusahaan'] = &$this->kdprop_perusahaan;

		// kdkota_perusahaan
		$this->kdkota_perusahaan = new DbField('petri', 'petri', 'x_kdkota_perusahaan', 'kdkota_perusahaan', '`kdkota_perusahaan`', '`kdkota_perusahaan`', 3, 11, -1, FALSE, '`kdkota_perusahaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkota_perusahaan->Required = TRUE; // Required field
		$this->kdkota_perusahaan->Sortable = TRUE; // Allow sort
		$this->kdkota_perusahaan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkota_perusahaan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkota_perusahaan->Lookup = new Lookup('kdkota_perusahaan', 't_kota', FALSE, 'kdkota', ["kota","","",""], ["x_kdprop"], [], ["kdprop"], ["x_kdprop"], [], [], '', '');
		$this->kdkota_perusahaan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkota_perusahaan'] = &$this->kdkota_perusahaan;

		// kdkategori
		$this->kdkategori = new DbField('petri', 'petri', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, FALSE, '`kdkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkategori->Sortable = TRUE; // Allow sort
		$this->kdkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', FALSE, 'kdkategori', ["kategori","","",""], [], [], [], [], [], [], '', '');
		$this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkategori'] = &$this->kdkategori;

		// kdjenis
		$this->kdjenis = new DbField('petri', 'petri', 'x_kdjenis', 'kdjenis', '`kdjenis`', '`kdjenis`', 3, 11, -1, FALSE, '`kdjenis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdjenis->Sortable = TRUE; // Allow sort
		$this->kdjenis->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdjenis->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdjenis->Lookup = new Lookup('kdjenis', 't_jenis', FALSE, 'kdjenis', ["jenis","","",""], [], [], [], [], [], [], '', '');
		$this->kdjenis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdjenis'] = &$this->kdjenis;

		// kdskala
		$this->kdskala = new DbField('petri', 'petri', 'x_kdskala', 'kdskala', '`kdskala`', '`kdskala`', 3, 11, -1, FALSE, '`kdskala`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdskala->Sortable = TRUE; // Allow sort
		$this->kdskala->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdskala->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdskala->Lookup = new Lookup('kdskala', 't_skala', FALSE, 'kdskala', ["skala","","",""], [], [], [], [], [], [], '', '');
		$this->kdskala->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdskala'] = &$this->kdskala;

		// kdexport
		$this->kdexport = new DbField('petri', 'petri', 'x_kdexport', 'kdexport', '`kdexport`', '`kdexport`', 3, 11, -1, FALSE, '`kdexport`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdexport->Sortable = TRUE; // Allow sort
		$this->kdexport->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdexport->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdexport->Lookup = new Lookup('kdexport', 't_export', FALSE, 'kdexport', ["export","","",""], [], [], [], [], [], [], '', '');
		$this->kdexport->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdexport'] = &$this->kdexport;

		// nexport
		$this->nexport = new DbField('petri', 'petri', 'x_nexport', 'nexport', '`nexport`', '`nexport`', 201, 65535, -1, FALSE, '`nexport`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->nexport->Sortable = TRUE; // Allow sort
		$this->fields['nexport'] = &$this->nexport;

		// kontak
		$this->kontak = new DbField('petri', 'petri', 'x_kontak', 'kontak', '`kontak`', '`kontak`', 200, 100, -1, FALSE, '`kontak`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kontak->Sortable = TRUE; // Allow sort
		$this->fields['kontak'] = &$this->kontak;

		// independen
		$this->independen = new DbField('petri', 'petri', 'x_independen', 'independen', '`independen`', '`independen`', 200, 10, -1, FALSE, '`independen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->independen->Sortable = TRUE; // Allow sort
		$this->independen->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->independen->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->independen->Lookup = new Lookup('independen', 'petri', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->independen->OptionCount = 1;
		$this->fields['independen'] = &$this->independen;

		// kdproduknafed
		$this->kdproduknafed = new DbField('petri', 'petri', 'x_kdproduknafed', 'kdproduknafed', '`kdproduknafed`', '`kdproduknafed`', 200, 10, -1, FALSE, '`kdproduknafed`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdproduknafed->Sortable = TRUE; // Allow sort
		$this->kdproduknafed->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdproduknafed->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdproduknafed->Lookup = new Lookup('kdproduknafed', 't_produknafed', FALSE, 'kdproduknafed', ["produknafedid","","",""], [], [], [], [], [], [], '`produknafed` ASC', '');
		$this->fields['kdproduknafed'] = &$this->kdproduknafed;

		// kdproduknafed2
		$this->kdproduknafed2 = new DbField('petri', 'petri', 'x_kdproduknafed2', 'kdproduknafed2', '`kdproduknafed2`', '`kdproduknafed2`', 200, 10, -1, FALSE, '`kdproduknafed2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdproduknafed2->Sortable = TRUE; // Allow sort
		$this->kdproduknafed2->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdproduknafed2->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdproduknafed2->Lookup = new Lookup('kdproduknafed2', 't_produknafed', FALSE, 'kdproduknafed', ["produknafedid","","",""], [], [], [], [], [], [], '`produknafed` ASC', '');
		$this->fields['kdproduknafed2'] = &$this->kdproduknafed2;

		// kdproduknafed3
		$this->kdproduknafed3 = new DbField('petri', 'petri', 'x_kdproduknafed3', 'kdproduknafed3', '`kdproduknafed3`', '`kdproduknafed3`', 200, 10, -1, FALSE, '`kdproduknafed3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdproduknafed3->Sortable = TRUE; // Allow sort
		$this->kdproduknafed3->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdproduknafed3->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdproduknafed3->Lookup = new Lookup('kdproduknafed3', 't_produknafed', FALSE, 'kdproduknafed', ["produknafedid","","",""], [], [], [], [], [], [], '`produknafed` ASC', '');
		$this->fields['kdproduknafed3'] = &$this->kdproduknafed3;

		// pproduk
		$this->pproduk = new DbField('petri', 'petri', 'x_pproduk', 'pproduk', '`pproduk`', '`pproduk`', 201, 65535, -1, FALSE, '`pproduk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->pproduk->Sortable = TRUE; // Allow sort
		$this->fields['pproduk'] = &$this->pproduk;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`petri`";
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
			"SELECT *, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `petri`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `petri`" .
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
		$this->kdpelat->DbValue = $row['kdpelat'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->tawal->DbValue = $row['tawal'];
		$this->takhir->DbValue = $row['takhir'];
		$this->nama->DbValue = $row['nama'];
		$this->kdprop->DbValue = $row['kdprop'];
		$this->kdkota->DbValue = $row['kdkota'];
		$this->kdsex->DbValue = $row['kdsex'];
		$this->kdjabat->DbValue = $row['kdjabat'];
		$this->telp->DbValue = $row['telp'];
		$this->hp->DbValue = $row['hp'];
		$this->_email->DbValue = $row['email'];
		$this->namap->DbValue = $row['namap'];
		$this->kdprop_perusahaan->DbValue = $row['kdprop_perusahaan'];
		$this->kdkota_perusahaan->DbValue = $row['kdkota_perusahaan'];
		$this->kdkategori->DbValue = $row['kdkategori'];
		$this->kdjenis->DbValue = $row['kdjenis'];
		$this->kdskala->DbValue = $row['kdskala'];
		$this->kdexport->DbValue = $row['kdexport'];
		$this->nexport->DbValue = $row['nexport'];
		$this->kontak->DbValue = $row['kontak'];
		$this->independen->DbValue = $row['independen'];
		$this->kdproduknafed->DbValue = $row['kdproduknafed'];
		$this->kdproduknafed2->DbValue = $row['kdproduknafed2'];
		$this->kdproduknafed3->DbValue = $row['kdproduknafed3'];
		$this->pproduk->DbValue = $row['pproduk'];
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
			return "petrilist.php";
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
		if ($pageName == "petriview.php")
			return $Language->phrase("View");
		elseif ($pageName == "petriedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "petriadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "petrilist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("petriview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("petriview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "petriadd.php?" . $this->getUrlParm($parm);
		else
			$url = "petriadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("petriedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("petriadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("petridelete.php", $this->getUrlParm());
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
		$this->tawal->setDbValue($rs->fields('tawal'));
		$this->takhir->setDbValue($rs->fields('takhir'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->kdprop->setDbValue($rs->fields('kdprop'));
		$this->kdkota->setDbValue($rs->fields('kdkota'));
		$this->kdsex->setDbValue($rs->fields('kdsex'));
		$this->kdjabat->setDbValue($rs->fields('kdjabat'));
		$this->telp->setDbValue($rs->fields('telp'));
		$this->hp->setDbValue($rs->fields('hp'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->namap->setDbValue($rs->fields('namap'));
		$this->kdprop_perusahaan->setDbValue($rs->fields('kdprop_perusahaan'));
		$this->kdkota_perusahaan->setDbValue($rs->fields('kdkota_perusahaan'));
		$this->kdkategori->setDbValue($rs->fields('kdkategori'));
		$this->kdjenis->setDbValue($rs->fields('kdjenis'));
		$this->kdskala->setDbValue($rs->fields('kdskala'));
		$this->kdexport->setDbValue($rs->fields('kdexport'));
		$this->nexport->setDbValue($rs->fields('nexport'));
		$this->kontak->setDbValue($rs->fields('kontak'));
		$this->independen->setDbValue($rs->fields('independen'));
		$this->kdproduknafed->setDbValue($rs->fields('kdproduknafed'));
		$this->kdproduknafed2->setDbValue($rs->fields('kdproduknafed2'));
		$this->kdproduknafed3->setDbValue($rs->fields('kdproduknafed3'));
		$this->pproduk->setDbValue($rs->fields('pproduk'));
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
		// tawal
		// takhir
		// nama
		// kdprop
		// kdkota
		// kdsex
		// kdjabat
		// telp
		// hp
		// email
		// namap
		// kdprop_perusahaan
		// kdkota_perusahaan
		// kdkategori
		// kdjenis
		// kdskala
		// kdexport
		// nexport
		// kontak
		// independen
		// kdproduknafed
		// kdproduknafed2
		// kdproduknafed3
		// pproduk
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

		// tawal
		$this->tawal->ViewValue = $this->tawal->CurrentValue;
		$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->ViewValue = $this->takhir->CurrentValue;
		$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
		$this->takhir->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

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

		// kdsex
		if (strval($this->kdsex->CurrentValue) != "") {
			$this->kdsex->ViewValue = $this->kdsex->optionCaption($this->kdsex->CurrentValue);
		} else {
			$this->kdsex->ViewValue = NULL;
		}
		$this->kdsex->ViewCustomAttributes = "";

		// kdjabat
		$curVal = strval($this->kdjabat->CurrentValue);
		if ($curVal != "") {
			$this->kdjabat->ViewValue = $this->kdjabat->lookupCacheOption($curVal);
			if ($this->kdjabat->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdjabat`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdjabat->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdjabat->ViewValue = $this->kdjabat->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdjabat->ViewValue = $this->kdjabat->CurrentValue;
				}
			}
		} else {
			$this->kdjabat->ViewValue = NULL;
		}
		$this->kdjabat->ViewCustomAttributes = "";

		// telp
		$this->telp->ViewValue = $this->telp->CurrentValue;
		$this->telp->ViewCustomAttributes = "";

		// hp
		$this->hp->ViewValue = $this->hp->CurrentValue;
		$this->hp->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// namap
		$this->namap->ViewValue = $this->namap->CurrentValue;
		$this->namap->ViewCustomAttributes = "";

		// kdprop_perusahaan
		$curVal = strval($this->kdprop_perusahaan->CurrentValue);
		if ($curVal != "") {
			$this->kdprop_perusahaan->ViewValue = $this->kdprop_perusahaan->lookupCacheOption($curVal);
			if ($this->kdprop_perusahaan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdprop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdprop_perusahaan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdprop_perusahaan->ViewValue = $this->kdprop_perusahaan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdprop_perusahaan->ViewValue = $this->kdprop_perusahaan->CurrentValue;
				}
			}
		} else {
			$this->kdprop_perusahaan->ViewValue = NULL;
		}
		$this->kdprop_perusahaan->ViewCustomAttributes = "";

		// kdkota_perusahaan
		$curVal = strval($this->kdkota_perusahaan->CurrentValue);
		if ($curVal != "") {
			$this->kdkota_perusahaan->ViewValue = $this->kdkota_perusahaan->lookupCacheOption($curVal);
			if ($this->kdkota_perusahaan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdkota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdkota_perusahaan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdkota_perusahaan->ViewValue = $this->kdkota_perusahaan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdkota_perusahaan->ViewValue = $this->kdkota_perusahaan->CurrentValue;
				}
			}
		} else {
			$this->kdkota_perusahaan->ViewValue = NULL;
		}
		$this->kdkota_perusahaan->ViewCustomAttributes = "";

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

		// kdjenis
		$curVal = strval($this->kdjenis->CurrentValue);
		if ($curVal != "") {
			$this->kdjenis->ViewValue = $this->kdjenis->lookupCacheOption($curVal);
			if ($this->kdjenis->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdjenis`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdjenis->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdjenis->ViewValue = $this->kdjenis->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdjenis->ViewValue = $this->kdjenis->CurrentValue;
				}
			}
		} else {
			$this->kdjenis->ViewValue = NULL;
		}
		$this->kdjenis->ViewCustomAttributes = "";

		// kdskala
		$curVal = strval($this->kdskala->CurrentValue);
		if ($curVal != "") {
			$this->kdskala->ViewValue = $this->kdskala->lookupCacheOption($curVal);
			if ($this->kdskala->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdskala`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdskala->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdskala->ViewValue = $this->kdskala->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdskala->ViewValue = $this->kdskala->CurrentValue;
				}
			}
		} else {
			$this->kdskala->ViewValue = NULL;
		}
		$this->kdskala->ViewCustomAttributes = "";

		// kdexport
		$curVal = strval($this->kdexport->CurrentValue);
		if ($curVal != "") {
			$this->kdexport->ViewValue = $this->kdexport->lookupCacheOption($curVal);
			if ($this->kdexport->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdexport`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdexport->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdexport->ViewValue = $this->kdexport->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdexport->ViewValue = $this->kdexport->CurrentValue;
				}
			}
		} else {
			$this->kdexport->ViewValue = NULL;
		}
		$this->kdexport->ViewCustomAttributes = "";

		// nexport
		$this->nexport->ViewValue = $this->nexport->CurrentValue;
		$this->nexport->ViewCustomAttributes = "";

		// kontak
		$this->kontak->ViewValue = $this->kontak->CurrentValue;
		$this->kontak->ViewCustomAttributes = "";

		// independen
		if (strval($this->independen->CurrentValue) != "") {
			$this->independen->ViewValue = $this->independen->optionCaption($this->independen->CurrentValue);
		} else {
			$this->independen->ViewValue = NULL;
		}
		$this->independen->ViewCustomAttributes = "";

		// kdproduknafed
		$curVal = strval($this->kdproduknafed->CurrentValue);
		if ($curVal != "") {
			$this->kdproduknafed->ViewValue = $this->kdproduknafed->lookupCacheOption($curVal);
			if ($this->kdproduknafed->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdproduknafed->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdproduknafed->ViewValue = $this->kdproduknafed->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdproduknafed->ViewValue = $this->kdproduknafed->CurrentValue;
				}
			}
		} else {
			$this->kdproduknafed->ViewValue = NULL;
		}
		$this->kdproduknafed->ViewCustomAttributes = "";

		// kdproduknafed2
		$curVal = strval($this->kdproduknafed2->CurrentValue);
		if ($curVal != "") {
			$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->lookupCacheOption($curVal);
			if ($this->kdproduknafed2->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdproduknafed2->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdproduknafed2->ViewValue = $this->kdproduknafed2->CurrentValue;
				}
			}
		} else {
			$this->kdproduknafed2->ViewValue = NULL;
		}
		$this->kdproduknafed2->ViewCustomAttributes = "";

		// kdproduknafed3
		$curVal = strval($this->kdproduknafed3->CurrentValue);
		if ($curVal != "") {
			$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->lookupCacheOption($curVal);
			if ($this->kdproduknafed3->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdproduknafed`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdproduknafed3->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdproduknafed3->ViewValue = $this->kdproduknafed3->CurrentValue;
				}
			}
		} else {
			$this->kdproduknafed3->ViewValue = NULL;
		}
		$this->kdproduknafed3->ViewCustomAttributes = "";

		// pproduk
		$this->pproduk->ViewValue = $this->pproduk->CurrentValue;
		$this->pproduk->ViewCustomAttributes = "";

		// kdpelat
		$this->kdpelat->LinkCustomAttributes = "";
		$this->kdpelat->HrefValue = "";
		$this->kdpelat->TooltipValue = "";

		// kdjudul
		$this->kdjudul->LinkCustomAttributes = "";
		$this->kdjudul->HrefValue = "";
		$this->kdjudul->TooltipValue = "";

		// tawal
		$this->tawal->LinkCustomAttributes = "";
		$this->tawal->HrefValue = "";
		$this->tawal->TooltipValue = "";

		// takhir
		$this->takhir->LinkCustomAttributes = "";
		$this->takhir->HrefValue = "";
		$this->takhir->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// kdprop
		$this->kdprop->LinkCustomAttributes = "";
		$this->kdprop->HrefValue = "";
		$this->kdprop->TooltipValue = "";

		// kdkota
		$this->kdkota->LinkCustomAttributes = "";
		$this->kdkota->HrefValue = "";
		$this->kdkota->TooltipValue = "";

		// kdsex
		$this->kdsex->LinkCustomAttributes = "";
		$this->kdsex->HrefValue = "";
		$this->kdsex->TooltipValue = "";

		// kdjabat
		$this->kdjabat->LinkCustomAttributes = "";
		$this->kdjabat->HrefValue = "";
		$this->kdjabat->TooltipValue = "";

		// telp
		$this->telp->LinkCustomAttributes = "";
		$this->telp->HrefValue = "";
		$this->telp->TooltipValue = "";

		// hp
		$this->hp->LinkCustomAttributes = "";
		$this->hp->HrefValue = "";
		$this->hp->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// namap
		$this->namap->LinkCustomAttributes = "";
		$this->namap->HrefValue = "";
		$this->namap->TooltipValue = "";

		// kdprop_perusahaan
		$this->kdprop_perusahaan->LinkCustomAttributes = "";
		$this->kdprop_perusahaan->HrefValue = "";
		$this->kdprop_perusahaan->TooltipValue = "";

		// kdkota_perusahaan
		$this->kdkota_perusahaan->LinkCustomAttributes = "";
		$this->kdkota_perusahaan->HrefValue = "";
		$this->kdkota_perusahaan->TooltipValue = "";

		// kdkategori
		$this->kdkategori->LinkCustomAttributes = "";
		$this->kdkategori->HrefValue = "";
		$this->kdkategori->TooltipValue = "";

		// kdjenis
		$this->kdjenis->LinkCustomAttributes = "";
		$this->kdjenis->HrefValue = "";
		$this->kdjenis->TooltipValue = "";

		// kdskala
		$this->kdskala->LinkCustomAttributes = "";
		$this->kdskala->HrefValue = "";
		$this->kdskala->TooltipValue = "";

		// kdexport
		$this->kdexport->LinkCustomAttributes = "";
		$this->kdexport->HrefValue = "";
		$this->kdexport->TooltipValue = "";

		// nexport
		$this->nexport->LinkCustomAttributes = "";
		$this->nexport->HrefValue = "";
		$this->nexport->TooltipValue = "";

		// kontak
		$this->kontak->LinkCustomAttributes = "";
		$this->kontak->HrefValue = "";
		$this->kontak->TooltipValue = "";

		// independen
		$this->independen->LinkCustomAttributes = "";
		$this->independen->HrefValue = "";
		$this->independen->TooltipValue = "";

		// kdproduknafed
		$this->kdproduknafed->LinkCustomAttributes = "";
		$this->kdproduknafed->HrefValue = "";
		$this->kdproduknafed->TooltipValue = "";

		// kdproduknafed2
		$this->kdproduknafed2->LinkCustomAttributes = "";
		$this->kdproduknafed2->HrefValue = "";
		$this->kdproduknafed2->TooltipValue = "";

		// kdproduknafed3
		$this->kdproduknafed3->LinkCustomAttributes = "";
		$this->kdproduknafed3->HrefValue = "";
		$this->kdproduknafed3->TooltipValue = "";

		// pproduk
		$this->pproduk->LinkCustomAttributes = "";
		$this->pproduk->HrefValue = "";
		$this->pproduk->TooltipValue = "";

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

		// tawal
		$this->tawal->EditAttrs["class"] = "form-control";
		$this->tawal->EditCustomAttributes = "";
		$this->tawal->EditValue = $this->tawal->CurrentValue;
		$this->tawal->EditValue = FormatDateTime($this->tawal->EditValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->EditAttrs["class"] = "form-control";
		$this->takhir->EditCustomAttributes = "";
		$this->takhir->EditValue = FormatDateTime($this->takhir->CurrentValue, 8);
		$this->takhir->PlaceHolder = RemoveHtml($this->takhir->caption());

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

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

		// kdsex
		$this->kdsex->EditCustomAttributes = "";
		$this->kdsex->EditValue = $this->kdsex->options(FALSE);

		// kdjabat
		$this->kdjabat->EditAttrs["class"] = "form-control";
		$this->kdjabat->EditCustomAttributes = "";

		// telp
		$this->telp->EditAttrs["class"] = "form-control";
		$this->telp->EditCustomAttributes = "";
		if (!$this->telp->Raw)
			$this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
		$this->telp->EditValue = $this->telp->CurrentValue;
		$this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

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

		// namap
		$this->namap->EditAttrs["class"] = "form-control";
		$this->namap->EditCustomAttributes = "";
		if (!$this->namap->Raw)
			$this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
		$this->namap->EditValue = $this->namap->CurrentValue;
		$this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

		// kdprop_perusahaan
		$this->kdprop_perusahaan->EditAttrs["class"] = "form-control";
		$this->kdprop_perusahaan->EditCustomAttributes = "";

		// kdkota_perusahaan
		$this->kdkota_perusahaan->EditAttrs["class"] = "form-control";
		$this->kdkota_perusahaan->EditCustomAttributes = "";

		// kdkategori
		$this->kdkategori->EditAttrs["class"] = "form-control";
		$this->kdkategori->EditCustomAttributes = "";

		// kdjenis
		$this->kdjenis->EditAttrs["class"] = "form-control";
		$this->kdjenis->EditCustomAttributes = "";

		// kdskala
		$this->kdskala->EditAttrs["class"] = "form-control";
		$this->kdskala->EditCustomAttributes = "";

		// kdexport
		$this->kdexport->EditAttrs["class"] = "form-control";
		$this->kdexport->EditCustomAttributes = "";

		// nexport
		$this->nexport->EditAttrs["class"] = "form-control";
		$this->nexport->EditCustomAttributes = "";
		$this->nexport->EditValue = $this->nexport->CurrentValue;
		$this->nexport->PlaceHolder = RemoveHtml($this->nexport->caption());

		// kontak
		$this->kontak->EditAttrs["class"] = "form-control";
		$this->kontak->EditCustomAttributes = "";
		if (!$this->kontak->Raw)
			$this->kontak->CurrentValue = HtmlDecode($this->kontak->CurrentValue);
		$this->kontak->EditValue = $this->kontak->CurrentValue;
		$this->kontak->PlaceHolder = RemoveHtml($this->kontak->caption());

		// independen
		$this->independen->EditAttrs["class"] = "form-control";
		$this->independen->EditCustomAttributes = "";
		$this->independen->EditValue = $this->independen->options(TRUE);

		// kdproduknafed
		$this->kdproduknafed->EditAttrs["class"] = "form-control";
		$this->kdproduknafed->EditCustomAttributes = "";

		// kdproduknafed2
		$this->kdproduknafed2->EditAttrs["class"] = "form-control";
		$this->kdproduknafed2->EditCustomAttributes = "";

		// kdproduknafed3
		$this->kdproduknafed3->EditAttrs["class"] = "form-control";
		$this->kdproduknafed3->EditCustomAttributes = "";

		// pproduk
		$this->pproduk->EditAttrs["class"] = "form-control";
		$this->pproduk->EditCustomAttributes = "";
		$this->pproduk->EditValue = $this->pproduk->CurrentValue;
		$this->pproduk->PlaceHolder = RemoveHtml($this->pproduk->caption());

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
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdsex);
					$doc->exportCaption($this->kdjabat);
					$doc->exportCaption($this->telp);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->namap);
					$doc->exportCaption($this->kdprop_perusahaan);
					$doc->exportCaption($this->kdkota_perusahaan);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kdjenis);
					$doc->exportCaption($this->kdskala);
					$doc->exportCaption($this->kdexport);
					$doc->exportCaption($this->nexport);
					$doc->exportCaption($this->kontak);
					$doc->exportCaption($this->independen);
					$doc->exportCaption($this->kdproduknafed);
					$doc->exportCaption($this->kdproduknafed2);
					$doc->exportCaption($this->kdproduknafed3);
					$doc->exportCaption($this->pproduk);
				} else {
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdsex);
					$doc->exportCaption($this->kdjabat);
					$doc->exportCaption($this->telp);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->namap);
					$doc->exportCaption($this->kdprop_perusahaan);
					$doc->exportCaption($this->kdkota_perusahaan);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kdjenis);
					$doc->exportCaption($this->kdskala);
					$doc->exportCaption($this->kdexport);
					$doc->exportCaption($this->nexport);
					$doc->exportCaption($this->kontak);
					$doc->exportCaption($this->independen);
					$doc->exportCaption($this->kdproduknafed);
					$doc->exportCaption($this->kdproduknafed2);
					$doc->exportCaption($this->kdproduknafed3);
					$doc->exportCaption($this->pproduk);
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
						$doc->exportField($this->nama);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdsex);
						$doc->exportField($this->kdjabat);
						$doc->exportField($this->telp);
						$doc->exportField($this->hp);
						$doc->exportField($this->_email);
						$doc->exportField($this->namap);
						$doc->exportField($this->kdprop_perusahaan);
						$doc->exportField($this->kdkota_perusahaan);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kdjenis);
						$doc->exportField($this->kdskala);
						$doc->exportField($this->kdexport);
						$doc->exportField($this->nexport);
						$doc->exportField($this->kontak);
						$doc->exportField($this->independen);
						$doc->exportField($this->kdproduknafed);
						$doc->exportField($this->kdproduknafed2);
						$doc->exportField($this->kdproduknafed3);
						$doc->exportField($this->pproduk);
					} else {
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->nama);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdsex);
						$doc->exportField($this->kdjabat);
						$doc->exportField($this->telp);
						$doc->exportField($this->hp);
						$doc->exportField($this->_email);
						$doc->exportField($this->namap);
						$doc->exportField($this->kdprop_perusahaan);
						$doc->exportField($this->kdkota_perusahaan);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kdjenis);
						$doc->exportField($this->kdskala);
						$doc->exportField($this->kdexport);
						$doc->exportField($this->nexport);
						$doc->exportField($this->kontak);
						$doc->exportField($this->independen);
						$doc->exportField($this->kdproduknafed);
						$doc->exportField($this->kdproduknafed2);
						$doc->exportField($this->kdproduknafed3);
						$doc->exportField($this->pproduk);
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