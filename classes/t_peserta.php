<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_peserta
 */
class t_peserta extends DbTable
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
	public $nama;
	public $idp;
	public $tempat;
	public $tlahir;
	public $usia;
	public $kdagama;
	public $kdsex;
	public $kdprop;
	public $kdkota;
	public $kdkec;
	public $alamat;
	public $kdpos;
	public $telp;
	public $hp;
	public $_email;
	public $kdjabat;
	public $kdpend;
	public $kdbahasa;
	public $kdinformasi;
	public $harapan;
	public $created_at;
	public $updated_at;
	public $jpelatihan;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_peserta';
		$this->TableName = 't_peserta';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_peserta`";
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
		$this->id = new DbField('t_peserta', 't_peserta', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->IsForeignKey = TRUE; // Foreign key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->Lookup = new Lookup('id', 'vt_peserta', FALSE, 'id', ["nama","namap","",""], [], [], [], [], [], [], '`nama` ASC', '<div><strong>{{:df1}}</strong> ({{:df2}})</div>');
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// nama
		$this->nama = new DbField('t_peserta', 't_peserta', 'x_nama', 'nama', '`nama`', '`nama`', 200, 50, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// idp
		$this->idp = new DbField('t_peserta', 't_peserta', 'x_idp', 'idp', '`idp`', '`idp`', 3, 11, -1, FALSE, '`EV__idp`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->idp->IsForeignKey = TRUE; // Foreign key field
		$this->idp->Sortable = TRUE; // Allow sort
		$this->idp->Lookup = new Lookup('idp', 't_perusahaan', FALSE, 'idp', ["namap","","",""], [], [], [], [], [], [], '', '');
		$this->idp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idp'] = &$this->idp;

		// tempat
		$this->tempat = new DbField('t_peserta', 't_peserta', 'x_tempat', 'tempat', '`tempat`', '`tempat`', 200, 25, -1, FALSE, '`tempat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tempat->Sortable = TRUE; // Allow sort
		$this->fields['tempat'] = &$this->tempat;

		// tlahir
		$this->tlahir = new DbField('t_peserta', 't_peserta', 'x_tlahir', 'tlahir', '`tlahir`', CastDateFieldForLike("`tlahir`", 0, "DB"), 133, 10, 0, FALSE, '`tlahir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tlahir->Sortable = TRUE; // Allow sort
		$this->tlahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tlahir'] = &$this->tlahir;

		// usia
		$this->usia = new DbField('t_peserta', 't_peserta', 'x_usia', 'usia', 'CAST(if((YEAR(tlahir) = \'0000\'),\'0\',(YEAR(CURDATE()) - YEAR(tlahir)))  AS UNSIGNED)', 'CAST(if((YEAR(tlahir) = \'0000\'),\'0\',(YEAR(CURDATE()) - YEAR(tlahir)))  AS UNSIGNED)', 21, 5, -1, FALSE, 'CAST(if((YEAR(tlahir) = \'0000\'),\'0\',(YEAR(CURDATE()) - YEAR(tlahir)))  AS UNSIGNED)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->usia->IsCustom = TRUE; // Custom field
		$this->usia->Sortable = TRUE; // Allow sort
		$this->usia->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['usia'] = &$this->usia;

		// kdagama
		$this->kdagama = new DbField('t_peserta', 't_peserta', 'x_kdagama', 'kdagama', '`kdagama`', '`kdagama`', 3, 11, -1, FALSE, '`kdagama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdagama->Sortable = TRUE; // Allow sort
		$this->kdagama->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdagama->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdagama->Lookup = new Lookup('kdagama', 't_agama', FALSE, 'kdagama', ["agama","","",""], [], [], [], [], [], [], '', '');
		$this->kdagama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdagama'] = &$this->kdagama;

		// kdsex
		$this->kdsex = new DbField('t_peserta', 't_peserta', 'x_kdsex', 'kdsex', '`kdsex`', '`kdsex`', 3, 11, -1, FALSE, '`kdsex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->kdsex->Sortable = TRUE; // Allow sort
		$this->kdsex->Lookup = new Lookup('kdsex', 't_peserta', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->kdsex->OptionCount = 2;
		$this->kdsex->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdsex'] = &$this->kdsex;

		// kdprop
		$this->kdprop = new DbField('t_peserta', 't_peserta', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, FALSE, '`EV__kdprop`', TRUE, TRUE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdprop->IsForeignKey = TRUE; // Foreign key field
		$this->kdprop->Required = TRUE; // Required field
		$this->kdprop->Sortable = TRUE; // Allow sort
		$this->kdprop->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdprop->Lookup = new Lookup('kdprop', 't_prop', FALSE, 'kdprop', ["prop","","",""], [], ["x_kdkota"], [], [], [], [], '`prop` ASC', '');
		$this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop'] = &$this->kdprop;

		// kdkota
		$this->kdkota = new DbField('t_peserta', 't_peserta', 'x_kdkota', 'kdkota', '`kdkota`', '`kdkota`', 3, 11, -1, FALSE, '`EV__kdkota`', TRUE, TRUE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkota->IsForeignKey = TRUE; // Foreign key field
		$this->kdkota->Required = TRUE; // Required field
		$this->kdkota->Sortable = TRUE; // Allow sort
		$this->kdkota->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkota->Lookup = new Lookup('kdkota', 't_kota', FALSE, 'kdkota', ["kota","","",""], ["x_kdprop"], ["x_kdkec"], ["kdprop"], ["x_kdprop"], [], [], '`kota` ASC', '');
		$this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkota'] = &$this->kdkota;

		// kdkec
		$this->kdkec = new DbField('t_peserta', 't_peserta', 'x_kdkec', 'kdkec', '`kdkec`', '`kdkec`', 3, 7, -1, FALSE, '`EV__kdkec`', TRUE, TRUE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkec->Sortable = TRUE; // Allow sort
		$this->kdkec->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkec->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkec->Lookup = new Lookup('kdkec', 't_kec', FALSE, 'kdkec', ["kec","","",""], ["x_kdkota"], [], ["kdkota"], ["x_kdkota"], [], [], '`kec` ASC', '');
		$this->kdkec->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkec'] = &$this->kdkec;

		// alamat
		$this->alamat = new DbField('t_peserta', 't_peserta', 'x_alamat', 'alamat', '`alamat`', '`alamat`', 201, 65535, -1, FALSE, '`alamat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamat->Required = TRUE; // Required field
		$this->alamat->Sortable = TRUE; // Allow sort
		$this->fields['alamat'] = &$this->alamat;

		// kdpos
		$this->kdpos = new DbField('t_peserta', 't_peserta', 'x_kdpos', 'kdpos', '`kdpos`', '`kdpos`', 200, 10, -1, FALSE, '`kdpos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpos->Sortable = TRUE; // Allow sort
		$this->fields['kdpos'] = &$this->kdpos;

		// telp
		$this->telp = new DbField('t_peserta', 't_peserta', 'x_telp', 'telp', '`telp`', '`telp`', 200, 50, -1, FALSE, '`telp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telp->Sortable = TRUE; // Allow sort
		$this->fields['telp'] = &$this->telp;

		// hp
		$this->hp = new DbField('t_peserta', 't_peserta', 'x_hp', 'hp', '`hp`', '`hp`', 200, 50, -1, FALSE, '`hp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hp->Sortable = TRUE; // Allow sort
		$this->fields['hp'] = &$this->hp;

		// email
		$this->_email = new DbField('t_peserta', 't_peserta', 'x__email', 'email', '`email`', '`email`', 200, 100, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;

		// kdjabat
		$this->kdjabat = new DbField('t_peserta', 't_peserta', 'x_kdjabat', 'kdjabat', '`kdjabat`', '`kdjabat`', 3, 11, -1, FALSE, '`kdjabat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdjabat->Sortable = TRUE; // Allow sort
		$this->kdjabat->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdjabat->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdjabat->Lookup = new Lookup('kdjabat', 't_jabatan', FALSE, 'kdjabat', ["jabatan","","",""], [], [], [], [], [], [], '', '');
		$this->kdjabat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdjabat'] = &$this->kdjabat;

		// kdpend
		$this->kdpend = new DbField('t_peserta', 't_peserta', 'x_kdpend', 'kdpend', '`kdpend`', '`kdpend`', 3, 11, -1, FALSE, '`kdpend`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdpend->Sortable = TRUE; // Allow sort
		$this->kdpend->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdpend->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdpend->Lookup = new Lookup('kdpend', 't_pendidikan', FALSE, 'kdpend', ["pendidikan","","",""], [], [], [], [], [], [], '', '');
		$this->kdpend->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdpend'] = &$this->kdpend;

		// kdbahasa
		$this->kdbahasa = new DbField('t_peserta', 't_peserta', 'x_kdbahasa', 'kdbahasa', '`kdbahasa`', '`kdbahasa`', 3, 11, -1, FALSE, '`kdbahasa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdbahasa->Sortable = TRUE; // Allow sort
		$this->kdbahasa->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdbahasa->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdbahasa->Lookup = new Lookup('kdbahasa', 't_bahasa', FALSE, 'kdbahasa', ["bahasa","","",""], [], [], [], [], [], [], '', '');
		$this->kdbahasa->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdbahasa'] = &$this->kdbahasa;

		// kdinformasi
		$this->kdinformasi = new DbField('t_peserta', 't_peserta', 'x_kdinformasi', 'kdinformasi', '`kdinformasi`', '`kdinformasi`', 3, 5, -1, FALSE, '`kdinformasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdinformasi->Sortable = TRUE; // Allow sort
		$this->kdinformasi->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdinformasi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdinformasi->Lookup = new Lookup('kdinformasi', 't_informasi', FALSE, 'kdinformasi', ["informasi","","",""], [], [], [], [], [], [], '', '');
		$this->kdinformasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdinformasi'] = &$this->kdinformasi;

		// harapan
		$this->harapan = new DbField('t_peserta', 't_peserta', 'x_harapan', 'harapan', '`harapan`', '`harapan`', 201, 16777215, -1, FALSE, '`harapan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->harapan->Sortable = TRUE; // Allow sort
		$this->fields['harapan'] = &$this->harapan;

		// created_at
		$this->created_at = new DbField('t_peserta', 't_peserta', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_at
		$this->updated_at = new DbField('t_peserta', 't_peserta', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// jpelatihan
		$this->jpelatihan = new DbField('t_peserta', 't_peserta', 'x_jpelatihan', 'jpelatihan', 'NULL', 'NULL', 12, 0, -1, FALSE, 'NULL', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->jpelatihan->IsCustom = TRUE; // Custom field
		$this->jpelatihan->Sortable = TRUE; // Allow sort
		$this->jpelatihan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jpelatihan'] = &$this->jpelatihan;
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
		if ($this->getCurrentMasterTable() == "t_perusahaan") {
			if ($this->idp->getSessionValue() != "")
				$masterFilter .= "`idp`=" . QuotedValue($this->idp->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "t_kota") {
			if ($this->kdkota->getSessionValue() != "")
				$masterFilter .= "`kdkota`=" . QuotedValue($this->kdkota->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "t_prop") {
			if ($this->kdprop->getSessionValue() != "")
				$masterFilter .= "`kdprop`=" . QuotedValue($this->kdprop->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "t_perusahaan") {
			if ($this->idp->getSessionValue() != "")
				$detailFilter .= "`idp`=" . QuotedValue($this->idp->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "t_kota") {
			if ($this->kdkota->getSessionValue() != "")
				$detailFilter .= "`kdkota`=" . QuotedValue($this->kdkota->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "t_prop") {
			if ($this->kdprop->getSessionValue() != "")
				$detailFilter .= "`kdprop`=" . QuotedValue($this->kdprop->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_t_perusahaan()
	{
		return "`idp`=@idp@";
	}

	// Detail filter
	public function sqlDetailFilter_t_perusahaan()
	{
		return "`idp`=@idp@";
	}

	// Master filter
	public function sqlMasterFilter_t_kota()
	{
		return "`kdkota`=@kdkota@";
	}

	// Detail filter
	public function sqlDetailFilter_t_kota()
	{
		return "`kdkota`=@kdkota@";
	}

	// Master filter
	public function sqlMasterFilter_t_prop()
	{
		return "`kdprop`=@kdprop@";
	}

	// Detail filter
	public function sqlDetailFilter_t_prop()
	{
		return "`kdprop`=@kdprop@";
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
		if ($this->getCurrentDetailTable() == "cv_historipelatihanpeserta") {
			$detailUrl = $GLOBALS["cv_historipelatihanpeserta"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_pesertalist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_peserta`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, CAST(if((YEAR(tlahir) = '0000'),'0',(YEAR(CURDATE()) - YEAR(tlahir)))  AS UNSIGNED) AS `usia`, NULL AS `jpelatihan` FROM " . $this->getSqlFrom();
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
			"SELECT *, CAST(if((YEAR(tlahir) = '0000'),'0',(YEAR(CURDATE()) - YEAR(tlahir)))  AS UNSIGNED) AS `usia`, NULL AS `jpelatihan`, (SELECT `namap` FROM `t_perusahaan` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`idp` = `t_peserta`.`idp` LIMIT 1) AS `EV__idp`, (SELECT `prop` FROM `t_prop` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdprop` = `t_peserta`.`kdprop` LIMIT 1) AS `EV__kdprop`, (SELECT `kota` FROM `t_kota` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdkota` = `t_peserta`.`kdkota` LIMIT 1) AS `EV__kdkota`, (SELECT `kec` FROM `t_kec` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdkec` = `t_peserta`.`kdkec` LIMIT 1) AS `EV__kdkec` FROM `t_peserta`" .
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
		if ($this->idp->AdvancedSearch->SearchValue != "" ||
			$this->idp->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->idp->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->idp->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->kdprop->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->kdkota->VirtualExpression . " "))
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
		$this->nama->DbValue = $row['nama'];
		$this->idp->DbValue = $row['idp'];
		$this->tempat->DbValue = $row['tempat'];
		$this->tlahir->DbValue = $row['tlahir'];
		$this->usia->DbValue = $row['usia'];
		$this->kdagama->DbValue = $row['kdagama'];
		$this->kdsex->DbValue = $row['kdsex'];
		$this->kdprop->DbValue = $row['kdprop'];
		$this->kdkota->DbValue = $row['kdkota'];
		$this->kdkec->DbValue = $row['kdkec'];
		$this->alamat->DbValue = $row['alamat'];
		$this->kdpos->DbValue = $row['kdpos'];
		$this->telp->DbValue = $row['telp'];
		$this->hp->DbValue = $row['hp'];
		$this->_email->DbValue = $row['email'];
		$this->kdjabat->DbValue = $row['kdjabat'];
		$this->kdpend->DbValue = $row['kdpend'];
		$this->kdbahasa->DbValue = $row['kdbahasa'];
		$this->kdinformasi->DbValue = $row['kdinformasi'];
		$this->harapan->DbValue = $row['harapan'];
		$this->created_at->DbValue = $row['created_at'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->jpelatihan->DbValue = $row['jpelatihan'];
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
			return "t_pesertalist.php";
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
		if ($pageName == "t_pesertaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_pesertaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_pesertaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_pesertalist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_pesertaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pesertaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_pesertaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_pesertaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_pesertaedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pesertaedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("t_pesertaadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pesertaadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_pesertadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "t_perusahaan" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_idp=" . urlencode($this->idp->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "t_kota" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_kdkota=" . urlencode($this->kdkota->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "t_prop" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_kdprop=" . urlencode($this->kdprop->CurrentValue);
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
		$this->nama->setDbValue($rs->fields('nama'));
		$this->idp->setDbValue($rs->fields('idp'));
		$this->tempat->setDbValue($rs->fields('tempat'));
		$this->tlahir->setDbValue($rs->fields('tlahir'));
		$this->usia->setDbValue($rs->fields('usia'));
		$this->kdagama->setDbValue($rs->fields('kdagama'));
		$this->kdsex->setDbValue($rs->fields('kdsex'));
		$this->kdprop->setDbValue($rs->fields('kdprop'));
		$this->kdkota->setDbValue($rs->fields('kdkota'));
		$this->kdkec->setDbValue($rs->fields('kdkec'));
		$this->alamat->setDbValue($rs->fields('alamat'));
		$this->kdpos->setDbValue($rs->fields('kdpos'));
		$this->telp->setDbValue($rs->fields('telp'));
		$this->hp->setDbValue($rs->fields('hp'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->kdjabat->setDbValue($rs->fields('kdjabat'));
		$this->kdpend->setDbValue($rs->fields('kdpend'));
		$this->kdbahasa->setDbValue($rs->fields('kdbahasa'));
		$this->kdinformasi->setDbValue($rs->fields('kdinformasi'));
		$this->harapan->setDbValue($rs->fields('harapan'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->jpelatihan->setDbValue($rs->fields('jpelatihan'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// nama
		// idp
		// tempat
		// tlahir
		// usia

		$this->usia->CellCssStyle = "white-space: nowrap;";

		// kdagama
		// kdsex
		// kdprop
		// kdkota
		// kdkec
		// alamat
		// kdpos
		// telp
		// hp
		// email
		// kdjabat
		// kdpend
		// kdbahasa
		// kdinformasi
		// harapan
		// created_at
		// updated_at
		// jpelatihan
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$curVal = strval($this->id->CurrentValue);
		if ($curVal != "") {
			$this->id->ViewValue = $this->id->lookupCacheOption($curVal);
			if ($this->id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->id->ViewValue = $this->id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id->ViewValue = $this->id->CurrentValue;
				}
			}
		} else {
			$this->id->ViewValue = NULL;
		}
		$this->id->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

		// idp
		if ($this->idp->VirtualValue != "") {
			$this->idp->ViewValue = $this->idp->VirtualValue;
		} else {
			$this->idp->ViewValue = $this->idp->CurrentValue;
			$curVal = strval($this->idp->CurrentValue);
			if ($curVal != "") {
				$this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
				if ($this->idp->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->idp->ViewValue = $this->idp->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idp->ViewValue = $this->idp->CurrentValue;
					}
				}
			} else {
				$this->idp->ViewValue = NULL;
			}
		}
		$this->idp->ViewCustomAttributes = "";

		// tempat
		$this->tempat->ViewValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

		// tlahir
		$this->tlahir->ViewValue = $this->tlahir->CurrentValue;
		$this->tlahir->ViewValue = FormatDateTime($this->tlahir->ViewValue, 0);
		$this->tlahir->ViewCustomAttributes = "";

		// usia
		$this->usia->ViewValue = $this->usia->CurrentValue;
		$this->usia->ViewCustomAttributes = "";

		// kdagama
		$curVal = strval($this->kdagama->CurrentValue);
		if ($curVal != "") {
			$this->kdagama->ViewValue = $this->kdagama->lookupCacheOption($curVal);
			if ($this->kdagama->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdagama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdagama->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdagama->ViewValue = $this->kdagama->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdagama->ViewValue = $this->kdagama->CurrentValue;
				}
			}
		} else {
			$this->kdagama->ViewValue = NULL;
		}
		$this->kdagama->ViewCustomAttributes = "";

		// kdsex
		if (strval($this->kdsex->CurrentValue) != "") {
			$this->kdsex->ViewValue = $this->kdsex->optionCaption($this->kdsex->CurrentValue);
		} else {
			$this->kdsex->ViewValue = NULL;
		}
		$this->kdsex->ViewCustomAttributes = "";

		// kdprop
		if ($this->kdprop->VirtualValue != "") {
			$this->kdprop->ViewValue = $this->kdprop->VirtualValue;
		} else {
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
		}
		$this->kdprop->ViewCustomAttributes = "";

		// kdkota
		if ($this->kdkota->VirtualValue != "") {
			$this->kdkota->ViewValue = $this->kdkota->VirtualValue;
		} else {
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

		// alamat
		$this->alamat->ViewValue = $this->alamat->CurrentValue;
		$this->alamat->ViewCustomAttributes = "";

		// kdpos
		$this->kdpos->ViewValue = $this->kdpos->CurrentValue;
		$this->kdpos->ViewCustomAttributes = "";

		// telp
		$this->telp->ViewValue = $this->telp->CurrentValue;
		$this->telp->ViewCustomAttributes = "";

		// hp
		$this->hp->ViewValue = $this->hp->CurrentValue;
		$this->hp->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

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

		// kdpend
		$curVal = strval($this->kdpend->CurrentValue);
		if ($curVal != "") {
			$this->kdpend->ViewValue = $this->kdpend->lookupCacheOption($curVal);
			if ($this->kdpend->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdpend`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdpend->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdpend->ViewValue = $this->kdpend->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdpend->ViewValue = $this->kdpend->CurrentValue;
				}
			}
		} else {
			$this->kdpend->ViewValue = NULL;
		}
		$this->kdpend->ViewCustomAttributes = "";

		// kdbahasa
		$curVal = strval($this->kdbahasa->CurrentValue);
		if ($curVal != "") {
			$this->kdbahasa->ViewValue = $this->kdbahasa->lookupCacheOption($curVal);
			if ($this->kdbahasa->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdbahasa`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdbahasa->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdbahasa->ViewValue = $this->kdbahasa->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdbahasa->ViewValue = $this->kdbahasa->CurrentValue;
				}
			}
		} else {
			$this->kdbahasa->ViewValue = NULL;
		}
		$this->kdbahasa->ViewCustomAttributes = "";

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

		// harapan
		$this->harapan->ViewValue = $this->harapan->CurrentValue;
		$this->harapan->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// jpelatihan
		$this->jpelatihan->ViewValue = $this->jpelatihan->CurrentValue;
		$this->jpelatihan->CellCssStyle .= "text-align: center;";
		$this->jpelatihan->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// idp
		$this->idp->LinkCustomAttributes = "";
		$this->idp->HrefValue = "";
		$this->idp->TooltipValue = "";

		// tempat
		$this->tempat->LinkCustomAttributes = "";
		$this->tempat->HrefValue = "";
		$this->tempat->TooltipValue = "";

		// tlahir
		$this->tlahir->LinkCustomAttributes = "";
		$this->tlahir->HrefValue = "";
		$this->tlahir->TooltipValue = "";

		// usia
		$this->usia->LinkCustomAttributes = "";
		$this->usia->HrefValue = "";
		$this->usia->TooltipValue = "";

		// kdagama
		$this->kdagama->LinkCustomAttributes = "";
		$this->kdagama->HrefValue = "";
		$this->kdagama->TooltipValue = "";

		// kdsex
		$this->kdsex->LinkCustomAttributes = "";
		$this->kdsex->HrefValue = "";
		$this->kdsex->TooltipValue = "";

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

		// alamat
		$this->alamat->LinkCustomAttributes = "";
		$this->alamat->HrefValue = "";
		$this->alamat->TooltipValue = "";

		// kdpos
		$this->kdpos->LinkCustomAttributes = "";
		$this->kdpos->HrefValue = "";
		$this->kdpos->TooltipValue = "";

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

		// kdjabat
		$this->kdjabat->LinkCustomAttributes = "";
		$this->kdjabat->HrefValue = "";
		$this->kdjabat->TooltipValue = "";

		// kdpend
		$this->kdpend->LinkCustomAttributes = "";
		$this->kdpend->HrefValue = "";
		$this->kdpend->TooltipValue = "";

		// kdbahasa
		$this->kdbahasa->LinkCustomAttributes = "";
		$this->kdbahasa->HrefValue = "";
		$this->kdbahasa->TooltipValue = "";

		// kdinformasi
		$this->kdinformasi->LinkCustomAttributes = "";
		$this->kdinformasi->HrefValue = "";
		$this->kdinformasi->TooltipValue = "";

		// harapan
		$this->harapan->LinkCustomAttributes = "";
		$this->harapan->HrefValue = "";
		$this->harapan->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

		// jpelatihan
		$this->jpelatihan->LinkCustomAttributes = "";
		$this->jpelatihan->HrefValue = "";
		$this->jpelatihan->TooltipValue = "";

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
		$curVal = strval($this->id->CurrentValue);
		if ($curVal != "") {
			$this->id->EditValue = $this->id->lookupCacheOption($curVal);
			if ($this->id->EditValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->id->EditValue = $this->id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id->EditValue = $this->id->CurrentValue;
				}
			}
		} else {
			$this->id->EditValue = NULL;
		}
		$this->id->ViewCustomAttributes = "";

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

		// idp
		$this->idp->EditAttrs["class"] = "form-control";
		$this->idp->EditCustomAttributes = "";
		if ($this->idp->getSessionValue() != "") {
			$this->idp->CurrentValue = $this->idp->getSessionValue();
			if ($this->idp->VirtualValue != "") {
				$this->idp->ViewValue = $this->idp->VirtualValue;
			} else {
				$this->idp->ViewValue = $this->idp->CurrentValue;
				$curVal = strval($this->idp->CurrentValue);
				if ($curVal != "") {
					$this->idp->ViewValue = $this->idp->lookupCacheOption($curVal);
					if ($this->idp->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->idp->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->idp->ViewValue = $this->idp->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->idp->ViewValue = $this->idp->CurrentValue;
						}
					}
				} else {
					$this->idp->ViewValue = NULL;
				}
			}
			$this->idp->ViewCustomAttributes = "";
		} else {
			$this->idp->EditValue = $this->idp->CurrentValue;
			$this->idp->PlaceHolder = RemoveHtml($this->idp->caption());
		}

		// tempat
		$this->tempat->EditAttrs["class"] = "form-control";
		$this->tempat->EditCustomAttributes = "";
		if (!$this->tempat->Raw)
			$this->tempat->CurrentValue = HtmlDecode($this->tempat->CurrentValue);
		$this->tempat->EditValue = $this->tempat->CurrentValue;
		$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

		// tlahir
		$this->tlahir->EditAttrs["class"] = "form-control";
		$this->tlahir->EditCustomAttributes = "";
		$this->tlahir->EditValue = FormatDateTime($this->tlahir->CurrentValue, 8);
		$this->tlahir->PlaceHolder = RemoveHtml($this->tlahir->caption());

		// usia
		$this->usia->EditAttrs["class"] = "form-control";
		$this->usia->EditCustomAttributes = "";
		$this->usia->EditValue = $this->usia->CurrentValue;
		$this->usia->PlaceHolder = RemoveHtml($this->usia->caption());

		// kdagama
		$this->kdagama->EditAttrs["class"] = "form-control";
		$this->kdagama->EditCustomAttributes = "";

		// kdsex
		$this->kdsex->EditCustomAttributes = "";
		$this->kdsex->EditValue = $this->kdsex->options(FALSE);

		// kdprop
		$this->kdprop->EditAttrs["class"] = "form-control";
		$this->kdprop->EditCustomAttributes = "";
		if ($this->kdprop->getSessionValue() != "") {
			$this->kdprop->CurrentValue = $this->kdprop->getSessionValue();
			if ($this->kdprop->VirtualValue != "") {
				$this->kdprop->ViewValue = $this->kdprop->VirtualValue;
			} else {
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
			}
			$this->kdprop->ViewCustomAttributes = "";
		} else {
		}

		// kdkota
		$this->kdkota->EditAttrs["class"] = "form-control";
		$this->kdkota->EditCustomAttributes = "";
		if ($this->kdkota->getSessionValue() != "") {
			$this->kdkota->CurrentValue = $this->kdkota->getSessionValue();
			if ($this->kdkota->VirtualValue != "") {
				$this->kdkota->ViewValue = $this->kdkota->VirtualValue;
			} else {
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
			}
			$this->kdkota->ViewCustomAttributes = "";
		} else {
		}

		// kdkec
		$this->kdkec->EditAttrs["class"] = "form-control";
		$this->kdkec->EditCustomAttributes = "";

		// alamat
		$this->alamat->EditAttrs["class"] = "form-control";
		$this->alamat->EditCustomAttributes = "";
		$this->alamat->EditValue = $this->alamat->CurrentValue;
		$this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

		// kdpos
		$this->kdpos->EditAttrs["class"] = "form-control";
		$this->kdpos->EditCustomAttributes = "";
		if (!$this->kdpos->Raw)
			$this->kdpos->CurrentValue = HtmlDecode($this->kdpos->CurrentValue);
		$this->kdpos->EditValue = $this->kdpos->CurrentValue;
		$this->kdpos->PlaceHolder = RemoveHtml($this->kdpos->caption());

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

		// kdjabat
		$this->kdjabat->EditAttrs["class"] = "form-control";
		$this->kdjabat->EditCustomAttributes = "";

		// kdpend
		$this->kdpend->EditAttrs["class"] = "form-control";
		$this->kdpend->EditCustomAttributes = "";

		// kdbahasa
		$this->kdbahasa->EditAttrs["class"] = "form-control";
		$this->kdbahasa->EditCustomAttributes = "";

		// kdinformasi
		$this->kdinformasi->EditAttrs["class"] = "form-control";
		$this->kdinformasi->EditCustomAttributes = "";

		// harapan
		$this->harapan->EditAttrs["class"] = "form-control";
		$this->harapan->EditCustomAttributes = "";
		$this->harapan->EditValue = $this->harapan->CurrentValue;
		$this->harapan->PlaceHolder = RemoveHtml($this->harapan->caption());

		// created_at
		// updated_at
		// jpelatihan

		$this->jpelatihan->EditAttrs["class"] = "form-control";
		$this->jpelatihan->EditCustomAttributes = "";

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
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->idp);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->tlahir);
					$doc->exportCaption($this->kdagama);
					$doc->exportCaption($this->kdsex);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdkec);
					$doc->exportCaption($this->alamat);
					$doc->exportCaption($this->kdpos);
					$doc->exportCaption($this->telp);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->kdjabat);
					$doc->exportCaption($this->kdpend);
					$doc->exportCaption($this->kdbahasa);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->jpelatihan);
				} else {
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->idp);
					$doc->exportCaption($this->tempat);
					$doc->exportCaption($this->tlahir);
					$doc->exportCaption($this->kdagama);
					$doc->exportCaption($this->kdsex);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdkec);
					$doc->exportCaption($this->alamat);
					$doc->exportCaption($this->kdpos);
					$doc->exportCaption($this->telp);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->kdjabat);
					$doc->exportCaption($this->kdpend);
					$doc->exportCaption($this->kdbahasa);
					$doc->exportCaption($this->jpelatihan);
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
						$doc->exportField($this->nama);
						$doc->exportField($this->idp);
						$doc->exportField($this->tempat);
						$doc->exportField($this->tlahir);
						$doc->exportField($this->kdagama);
						$doc->exportField($this->kdsex);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdkec);
						$doc->exportField($this->alamat);
						$doc->exportField($this->kdpos);
						$doc->exportField($this->telp);
						$doc->exportField($this->hp);
						$doc->exportField($this->_email);
						$doc->exportField($this->kdjabat);
						$doc->exportField($this->kdpend);
						$doc->exportField($this->kdbahasa);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->jpelatihan);
					} else {
						$doc->exportField($this->nama);
						$doc->exportField($this->idp);
						$doc->exportField($this->tempat);
						$doc->exportField($this->tlahir);
						$doc->exportField($this->kdagama);
						$doc->exportField($this->kdsex);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdkec);
						$doc->exportField($this->alamat);
						$doc->exportField($this->kdpos);
						$doc->exportField($this->telp);
						$doc->exportField($this->hp);
						$doc->exportField($this->_email);
						$doc->exportField($this->kdjabat);
						$doc->exportField($this->kdpend);
						$doc->exportField($this->kdbahasa);
						$doc->exportField($this->jpelatihan);
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
		$table = 't_peserta';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_peserta';

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
		$table = 't_peserta';

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
		$table = 't_peserta';

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
		$jp = ExecuteScalar("SELECT COUNT(1) FROM `t_pp` WHERE `t_pp`.`id` = '".$this->id->CurrentValue."'");
		$this->jpelatihan->CurrentValue = $jp;
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

		if (CurrentPage()->PageID <> "list" ){
			$this->jpelatihan->Visible = (CurrentPage()->RowType <> ROWTYPE_SEARCH);
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>