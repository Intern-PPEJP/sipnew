<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_perusahaan
 */
class t_perusahaan extends DbTable
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
	public $namap;
	public $idp;
	public $kontak;
	public $kdlokasi;
	public $kdprop;
	public $kdkota;
	public $kdkec;
	public $alamatp;
	public $kdpos;
	public $telpp;
	public $faxp;
	public $emailp;
	public $webp;
	public $medsos;
	public $kdjenis;
	public $kdproduknafed;
	public $kdproduknafed2;
	public $kdproduknafed3;
	public $pproduk;
	public $kdexport;
	public $nexport;
	public $kdskala;
	public $kdkategori;
	public $omzet_saat_ini;
	public $omzet_stl_6bln;
	public $omzet_stl_1thn;
	public $omzet_stl_2thn;
	public $kapasitas_saat_ini;
	public $kapasitas_stl_6bln;
	public $kapasitas_stl_1thn;
	public $kapasitas_stl_2thn;
	public $created_at;
	public $user_created_by;
	public $updated_at;
	public $user_updated_by;
	public $jpeserta;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_perusahaan';
		$this->TableName = 't_perusahaan';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_perusahaan`";
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

		// namap
		$this->namap = new DbField('t_perusahaan', 't_perusahaan', 'x_namap', 'namap', '`namap`', '`namap`', 200, 150, -1, FALSE, '`namap`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->namap->Required = TRUE; // Required field
		$this->namap->Sortable = TRUE; // Allow sort
		$this->fields['namap'] = &$this->namap;

		// idp
		$this->idp = new DbField('t_perusahaan', 't_perusahaan', 'x_idp', 'idp', '`idp`', '`idp`', 3, 11, -1, FALSE, '`idp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idp->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idp->IsPrimaryKey = TRUE; // Primary key field
		$this->idp->IsForeignKey = TRUE; // Foreign key field
		$this->idp->Sortable = TRUE; // Allow sort
		$this->idp->Lookup = new Lookup('idp', 't_perusahaan', FALSE, 'idp', ["namap","","",""], [], [], [], [], [], [], '`namap` ASC', '<div><i class=\'glyphicon glyphicon-tower\'></i> {{:df1}}</div>');
		$this->idp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idp'] = &$this->idp;

		// kontak
		$this->kontak = new DbField('t_perusahaan', 't_perusahaan', 'x_kontak', 'kontak', '`kontak`', '`kontak`', 200, 100, -1, FALSE, '`kontak`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kontak->Sortable = TRUE; // Allow sort
		$this->fields['kontak'] = &$this->kontak;

		// kdlokasi
		$this->kdlokasi = new DbField('t_perusahaan', 't_perusahaan', 'x_kdlokasi', 'kdlokasi', '`kdlokasi`', '`kdlokasi`', 3, 11, -1, FALSE, '`kdlokasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdlokasi->Required = TRUE; // Required field
		$this->kdlokasi->Sortable = TRUE; // Allow sort
		$this->kdlokasi->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdlokasi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdlokasi->Lookup = new Lookup('kdlokasi', 't_lokasi', FALSE, 'kdlokasi', ["lokasi","","",""], [], [], [], [], [], [], '', '');
		$this->kdlokasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdlokasi'] = &$this->kdlokasi;

		// kdprop
		$this->kdprop = new DbField('t_perusahaan', 't_perusahaan', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, FALSE, '`kdprop`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdprop->Required = TRUE; // Required field
		$this->kdprop->Sortable = TRUE; // Allow sort
		$this->kdprop->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdprop->Lookup = new Lookup('kdprop', 't_prop', FALSE, 'kdprop', ["prop","","",""], [], ["x_kdkota"], [], [], [], [], '`prop` ASC', '');
		$this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop'] = &$this->kdprop;

		// kdkota
		$this->kdkota = new DbField('t_perusahaan', 't_perusahaan', 'x_kdkota', 'kdkota', '`kdkota`', '`kdkota`', 3, 11, -1, FALSE, '`kdkota`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkota->Required = TRUE; // Required field
		$this->kdkota->Sortable = TRUE; // Allow sort
		$this->kdkota->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkota->Lookup = new Lookup('kdkota', 't_kota', FALSE, 'kdkota', ["kota","","",""], ["x_kdprop"], ["x_kdkec"], ["kdprop"], ["x_kdprop"], [], [], '', '');
		$this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkota'] = &$this->kdkota;

		// kdkec
		$this->kdkec = new DbField('t_perusahaan', 't_perusahaan', 'x_kdkec', 'kdkec', '`kdkec`', '`kdkec`', 3, 7, -1, FALSE, '`EV__kdkec`', TRUE, TRUE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkec->Sortable = TRUE; // Allow sort
		$this->kdkec->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkec->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkec->Lookup = new Lookup('kdkec', 't_kec', FALSE, 'kdkec', ["kec","","",""], ["x_kdkota"], [], ["kdkota"], ["x_kdkota"], [], [], '`kec` ASC', '');
		$this->kdkec->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkec'] = &$this->kdkec;

		// alamatp
		$this->alamatp = new DbField('t_perusahaan', 't_perusahaan', 'x_alamatp', 'alamatp', '`alamatp`', '`alamatp`', 201, 65535, -1, FALSE, '`alamatp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamatp->Required = TRUE; // Required field
		$this->alamatp->Sortable = TRUE; // Allow sort
		$this->fields['alamatp'] = &$this->alamatp;

		// kdpos
		$this->kdpos = new DbField('t_perusahaan', 't_perusahaan', 'x_kdpos', 'kdpos', '`kdpos`', '`kdpos`', 200, 10, -1, FALSE, '`kdpos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpos->Sortable = TRUE; // Allow sort
		$this->fields['kdpos'] = &$this->kdpos;

		// telpp
		$this->telpp = new DbField('t_perusahaan', 't_perusahaan', 'x_telpp', 'telpp', '`telpp`', '`telpp`', 200, 100, -1, FALSE, '`telpp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telpp->Sortable = TRUE; // Allow sort
		$this->fields['telpp'] = &$this->telpp;

		// faxp
		$this->faxp = new DbField('t_perusahaan', 't_perusahaan', 'x_faxp', 'faxp', '`faxp`', '`faxp`', 200, 100, -1, FALSE, '`faxp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->faxp->Sortable = TRUE; // Allow sort
		$this->fields['faxp'] = &$this->faxp;

		// emailp
		$this->emailp = new DbField('t_perusahaan', 't_perusahaan', 'x_emailp', 'emailp', '`emailp`', '`emailp`', 200, 100, -1, FALSE, '`emailp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->emailp->Sortable = TRUE; // Allow sort
		$this->fields['emailp'] = &$this->emailp;

		// webp
		$this->webp = new DbField('t_perusahaan', 't_perusahaan', 'x_webp', 'webp', '`webp`', '`webp`', 200, 100, -1, FALSE, '`webp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->webp->Sortable = TRUE; // Allow sort
		$this->fields['webp'] = &$this->webp;

		// medsos
		$this->medsos = new DbField('t_perusahaan', 't_perusahaan', 'x_medsos', 'medsos', '`medsos`', '`medsos`', 200, 100, -1, FALSE, '`medsos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->medsos->Sortable = TRUE; // Allow sort
		$this->fields['medsos'] = &$this->medsos;

		// kdjenis
		$this->kdjenis = new DbField('t_perusahaan', 't_perusahaan', 'x_kdjenis', 'kdjenis', '`kdjenis`', '`kdjenis`', 3, 11, -1, FALSE, '`kdjenis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdjenis->Sortable = TRUE; // Allow sort
		$this->kdjenis->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdjenis->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdjenis->Lookup = new Lookup('kdjenis', 't_jenis', FALSE, 'kdjenis', ["jenis","","",""], [], [], [], [], [], [], '', '');
		$this->kdjenis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdjenis'] = &$this->kdjenis;

		// kdproduknafed
		$this->kdproduknafed = new DbField('t_perusahaan', 't_perusahaan', 'x_kdproduknafed', 'kdproduknafed', '`kdproduknafed`', '`kdproduknafed`', 200, 10, -1, FALSE, '`kdproduknafed`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdproduknafed->Sortable = TRUE; // Allow sort
		$this->kdproduknafed->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdproduknafed->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdproduknafed->Lookup = new Lookup('kdproduknafed', 't_produknafed', FALSE, 'kdproduknafed', ["produknafedid","","",""], [], [], [], [], [], [], '`produknafed` ASC', '');
		$this->fields['kdproduknafed'] = &$this->kdproduknafed;

		// kdproduknafed2
		$this->kdproduknafed2 = new DbField('t_perusahaan', 't_perusahaan', 'x_kdproduknafed2', 'kdproduknafed2', '`kdproduknafed2`', '`kdproduknafed2`', 200, 10, -1, FALSE, '`kdproduknafed2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdproduknafed2->Sortable = TRUE; // Allow sort
		$this->kdproduknafed2->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdproduknafed2->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdproduknafed2->Lookup = new Lookup('kdproduknafed2', 't_produknafed', FALSE, 'kdproduknafed', ["produknafedid","","",""], [], [], [], [], [], [], '`produknafed` ASC', '');
		$this->fields['kdproduknafed2'] = &$this->kdproduknafed2;

		// kdproduknafed3
		$this->kdproduknafed3 = new DbField('t_perusahaan', 't_perusahaan', 'x_kdproduknafed3', 'kdproduknafed3', '`kdproduknafed3`', '`kdproduknafed3`', 200, 10, -1, FALSE, '`kdproduknafed3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdproduknafed3->Sortable = TRUE; // Allow sort
		$this->kdproduknafed3->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdproduknafed3->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdproduknafed3->Lookup = new Lookup('kdproduknafed3', 't_produknafed', FALSE, 'kdproduknafed', ["produknafedid","","",""], [], [], [], [], [], [], '`produknafed` ASC', '');
		$this->fields['kdproduknafed3'] = &$this->kdproduknafed3;

		// pproduk
		$this->pproduk = new DbField('t_perusahaan', 't_perusahaan', 'x_pproduk', 'pproduk', '`pproduk`', '`pproduk`', 201, 65535, -1, FALSE, '`pproduk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->pproduk->Sortable = TRUE; // Allow sort
		$this->fields['pproduk'] = &$this->pproduk;

		// kdexport
		$this->kdexport = new DbField('t_perusahaan', 't_perusahaan', 'x_kdexport', 'kdexport', '`kdexport`', '`kdexport`', 3, 11, -1, FALSE, '`kdexport`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdexport->Sortable = TRUE; // Allow sort
		$this->kdexport->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdexport->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdexport->Lookup = new Lookup('kdexport', 't_export', FALSE, 'kdexport', ["export","","",""], [], [], [], [], [], [], '', '');
		$this->kdexport->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdexport'] = &$this->kdexport;

		// nexport
		$this->nexport = new DbField('t_perusahaan', 't_perusahaan', 'x_nexport', 'nexport', '`nexport`', '`nexport`', 201, 65535, -1, FALSE, '`nexport`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->nexport->Sortable = TRUE; // Allow sort
		$this->fields['nexport'] = &$this->nexport;

		// kdskala
		$this->kdskala = new DbField('t_perusahaan', 't_perusahaan', 'x_kdskala', 'kdskala', '`kdskala`', '`kdskala`', 3, 11, -1, FALSE, '`kdskala`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdskala->Sortable = TRUE; // Allow sort
		$this->kdskala->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdskala->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdskala->Lookup = new Lookup('kdskala', 't_skala', FALSE, 'kdskala', ["skala","","",""], [], [], [], [], [], [], '', '');
		$this->kdskala->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdskala'] = &$this->kdskala;

		// kdkategori
		$this->kdkategori = new DbField('t_perusahaan', 't_perusahaan', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, FALSE, '`kdkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkategori->Sortable = TRUE; // Allow sort
		$this->kdkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', FALSE, 'kdkategori', ["kategori","","",""], [], [], [], [], [], [], '', '');
		$this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkategori'] = &$this->kdkategori;

		// omzet_saat_ini
		$this->omzet_saat_ini = new DbField('t_perusahaan', 't_perusahaan', 'x_omzet_saat_ini', 'omzet_saat_ini', '`omzet_saat_ini`', '`omzet_saat_ini`', 200, 100, -1, FALSE, '`omzet_saat_ini`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->omzet_saat_ini->Sortable = TRUE; // Allow sort
		$this->fields['omzet_saat_ini'] = &$this->omzet_saat_ini;

		// omzet_stl_6bln
		$this->omzet_stl_6bln = new DbField('t_perusahaan', 't_perusahaan', 'x_omzet_stl_6bln', 'omzet_stl_6bln', '`omzet_stl_6bln`', '`omzet_stl_6bln`', 200, 100, -1, FALSE, '`omzet_stl_6bln`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->omzet_stl_6bln->Sortable = TRUE; // Allow sort
		$this->fields['omzet_stl_6bln'] = &$this->omzet_stl_6bln;

		// omzet_stl_1thn
		$this->omzet_stl_1thn = new DbField('t_perusahaan', 't_perusahaan', 'x_omzet_stl_1thn', 'omzet_stl_1thn', '`omzet_stl_1thn`', '`omzet_stl_1thn`', 200, 100, -1, FALSE, '`omzet_stl_1thn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->omzet_stl_1thn->Sortable = TRUE; // Allow sort
		$this->fields['omzet_stl_1thn'] = &$this->omzet_stl_1thn;

		// omzet_stl_2thn
		$this->omzet_stl_2thn = new DbField('t_perusahaan', 't_perusahaan', 'x_omzet_stl_2thn', 'omzet_stl_2thn', '`omzet_stl_2thn`', '`omzet_stl_2thn`', 200, 100, -1, FALSE, '`omzet_stl_2thn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->omzet_stl_2thn->Sortable = TRUE; // Allow sort
		$this->fields['omzet_stl_2thn'] = &$this->omzet_stl_2thn;

		// kapasitas_saat_ini
		$this->kapasitas_saat_ini = new DbField('t_perusahaan', 't_perusahaan', 'x_kapasitas_saat_ini', 'kapasitas_saat_ini', '`kapasitas_saat_ini`', '`kapasitas_saat_ini`', 200, 100, -1, FALSE, '`kapasitas_saat_ini`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kapasitas_saat_ini->Sortable = TRUE; // Allow sort
		$this->fields['kapasitas_saat_ini'] = &$this->kapasitas_saat_ini;

		// kapasitas_stl_6bln
		$this->kapasitas_stl_6bln = new DbField('t_perusahaan', 't_perusahaan', 'x_kapasitas_stl_6bln', 'kapasitas_stl_6bln', '`kapasitas_stl_6bln`', '`kapasitas_stl_6bln`', 200, 100, -1, FALSE, '`kapasitas_stl_6bln`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kapasitas_stl_6bln->Sortable = TRUE; // Allow sort
		$this->fields['kapasitas_stl_6bln'] = &$this->kapasitas_stl_6bln;

		// kapasitas_stl_1thn
		$this->kapasitas_stl_1thn = new DbField('t_perusahaan', 't_perusahaan', 'x_kapasitas_stl_1thn', 'kapasitas_stl_1thn', '`kapasitas_stl_1thn`', '`kapasitas_stl_1thn`', 200, 100, -1, FALSE, '`kapasitas_stl_1thn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kapasitas_stl_1thn->Sortable = TRUE; // Allow sort
		$this->fields['kapasitas_stl_1thn'] = &$this->kapasitas_stl_1thn;

		// kapasitas_stl_2thn
		$this->kapasitas_stl_2thn = new DbField('t_perusahaan', 't_perusahaan', 'x_kapasitas_stl_2thn', 'kapasitas_stl_2thn', '`kapasitas_stl_2thn`', '`kapasitas_stl_2thn`', 200, 100, -1, FALSE, '`kapasitas_stl_2thn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kapasitas_stl_2thn->Sortable = TRUE; // Allow sort
		$this->fields['kapasitas_stl_2thn'] = &$this->kapasitas_stl_2thn;

		// created_at
		$this->created_at = new DbField('t_perusahaan', 't_perusahaan', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// user_created_by
		$this->user_created_by = new DbField('t_perusahaan', 't_perusahaan', 'x_user_created_by', 'user_created_by', '`user_created_by`', '`user_created_by`', 200, 100, -1, FALSE, '`user_created_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_created_by->Sortable = TRUE; // Allow sort
		$this->fields['user_created_by'] = &$this->user_created_by;

		// updated_at
		$this->updated_at = new DbField('t_perusahaan', 't_perusahaan', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// user_updated_by
		$this->user_updated_by = new DbField('t_perusahaan', 't_perusahaan', 'x_user_updated_by', 'user_updated_by', '`user_updated_by`', '`user_updated_by`', 200, 100, -1, FALSE, '`user_updated_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_updated_by->Sortable = TRUE; // Allow sort
		$this->fields['user_updated_by'] = &$this->user_updated_by;

		// jpeserta
		$this->jpeserta = new DbField('t_perusahaan', 't_perusahaan', 'x_jpeserta', 'jpeserta', 'NULL', 'NULL', 12, 0, -1, FALSE, 'NULL', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jpeserta->IsCustom = TRUE; // Custom field
		$this->jpeserta->Sortable = TRUE; // Allow sort
		$this->jpeserta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jpeserta'] = &$this->jpeserta;
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
		if ($this->getCurrentDetailTable() == "t_peserta") {
			$detailUrl = $GLOBALS["t_peserta"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_idp=" . urlencode($this->idp->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_perusahaanlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_perusahaan`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, NULL AS `jpeserta` FROM " . $this->getSqlFrom();
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
			"SELECT *, NULL AS `jpeserta`, (SELECT `kec` FROM `t_kec` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdkec` = `t_perusahaan`.`kdkec` LIMIT 1) AS `EV__kdkec` FROM `t_perusahaan`" .
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`namap` ASC";
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
			$this->idp->setDbValue($conn->insert_ID());
			$rs['idp'] = $this->idp->DbValue;
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
			$fldname = 'idp';
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
			if (array_key_exists('idp', $rs))
				AddFilter($where, QuotedName('idp', $this->Dbid) . '=' . QuotedValue($rs['idp'], $this->idp->DataType, $this->Dbid));
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
		$this->namap->DbValue = $row['namap'];
		$this->idp->DbValue = $row['idp'];
		$this->kontak->DbValue = $row['kontak'];
		$this->kdlokasi->DbValue = $row['kdlokasi'];
		$this->kdprop->DbValue = $row['kdprop'];
		$this->kdkota->DbValue = $row['kdkota'];
		$this->kdkec->DbValue = $row['kdkec'];
		$this->alamatp->DbValue = $row['alamatp'];
		$this->kdpos->DbValue = $row['kdpos'];
		$this->telpp->DbValue = $row['telpp'];
		$this->faxp->DbValue = $row['faxp'];
		$this->emailp->DbValue = $row['emailp'];
		$this->webp->DbValue = $row['webp'];
		$this->medsos->DbValue = $row['medsos'];
		$this->kdjenis->DbValue = $row['kdjenis'];
		$this->kdproduknafed->DbValue = $row['kdproduknafed'];
		$this->kdproduknafed2->DbValue = $row['kdproduknafed2'];
		$this->kdproduknafed3->DbValue = $row['kdproduknafed3'];
		$this->pproduk->DbValue = $row['pproduk'];
		$this->kdexport->DbValue = $row['kdexport'];
		$this->nexport->DbValue = $row['nexport'];
		$this->kdskala->DbValue = $row['kdskala'];
		$this->kdkategori->DbValue = $row['kdkategori'];
		$this->omzet_saat_ini->DbValue = $row['omzet_saat_ini'];
		$this->omzet_stl_6bln->DbValue = $row['omzet_stl_6bln'];
		$this->omzet_stl_1thn->DbValue = $row['omzet_stl_1thn'];
		$this->omzet_stl_2thn->DbValue = $row['omzet_stl_2thn'];
		$this->kapasitas_saat_ini->DbValue = $row['kapasitas_saat_ini'];
		$this->kapasitas_stl_6bln->DbValue = $row['kapasitas_stl_6bln'];
		$this->kapasitas_stl_1thn->DbValue = $row['kapasitas_stl_1thn'];
		$this->kapasitas_stl_2thn->DbValue = $row['kapasitas_stl_2thn'];
		$this->created_at->DbValue = $row['created_at'];
		$this->user_created_by->DbValue = $row['user_created_by'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->user_updated_by->DbValue = $row['user_updated_by'];
		$this->jpeserta->DbValue = $row['jpeserta'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`idp` = @idp@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('idp', $row) ? $row['idp'] : NULL;
		else
			$val = $this->idp->OldValue !== NULL ? $this->idp->OldValue : $this->idp->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@idp@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_perusahaanlist.php";
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
		if ($pageName == "t_perusahaanview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_perusahaanedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_perusahaanadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_perusahaanlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_perusahaanview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_perusahaanview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_perusahaanadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_perusahaanadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_perusahaanedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_perusahaanedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("t_perusahaanadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_perusahaanadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_perusahaandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "idp:" . JsonEncode($this->idp->CurrentValue, "number");
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
		if ($this->idp->CurrentValue != NULL) {
			$url .= "idp=" . urlencode($this->idp->CurrentValue);
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
			if (Param("idp") !== NULL)
				$arKeys[] = Param("idp");
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
				$this->idp->CurrentValue = $key;
			else
				$this->idp->OldValue = $key;
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
		$this->namap->setDbValue($rs->fields('namap'));
		$this->idp->setDbValue($rs->fields('idp'));
		$this->kontak->setDbValue($rs->fields('kontak'));
		$this->kdlokasi->setDbValue($rs->fields('kdlokasi'));
		$this->kdprop->setDbValue($rs->fields('kdprop'));
		$this->kdkota->setDbValue($rs->fields('kdkota'));
		$this->kdkec->setDbValue($rs->fields('kdkec'));
		$this->alamatp->setDbValue($rs->fields('alamatp'));
		$this->kdpos->setDbValue($rs->fields('kdpos'));
		$this->telpp->setDbValue($rs->fields('telpp'));
		$this->faxp->setDbValue($rs->fields('faxp'));
		$this->emailp->setDbValue($rs->fields('emailp'));
		$this->webp->setDbValue($rs->fields('webp'));
		$this->medsos->setDbValue($rs->fields('medsos'));
		$this->kdjenis->setDbValue($rs->fields('kdjenis'));
		$this->kdproduknafed->setDbValue($rs->fields('kdproduknafed'));
		$this->kdproduknafed2->setDbValue($rs->fields('kdproduknafed2'));
		$this->kdproduknafed3->setDbValue($rs->fields('kdproduknafed3'));
		$this->pproduk->setDbValue($rs->fields('pproduk'));
		$this->kdexport->setDbValue($rs->fields('kdexport'));
		$this->nexport->setDbValue($rs->fields('nexport'));
		$this->kdskala->setDbValue($rs->fields('kdskala'));
		$this->kdkategori->setDbValue($rs->fields('kdkategori'));
		$this->omzet_saat_ini->setDbValue($rs->fields('omzet_saat_ini'));
		$this->omzet_stl_6bln->setDbValue($rs->fields('omzet_stl_6bln'));
		$this->omzet_stl_1thn->setDbValue($rs->fields('omzet_stl_1thn'));
		$this->omzet_stl_2thn->setDbValue($rs->fields('omzet_stl_2thn'));
		$this->kapasitas_saat_ini->setDbValue($rs->fields('kapasitas_saat_ini'));
		$this->kapasitas_stl_6bln->setDbValue($rs->fields('kapasitas_stl_6bln'));
		$this->kapasitas_stl_1thn->setDbValue($rs->fields('kapasitas_stl_1thn'));
		$this->kapasitas_stl_2thn->setDbValue($rs->fields('kapasitas_stl_2thn'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->user_created_by->setDbValue($rs->fields('user_created_by'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->user_updated_by->setDbValue($rs->fields('user_updated_by'));
		$this->jpeserta->setDbValue($rs->fields('jpeserta'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// namap
		// idp
		// kontak
		// kdlokasi
		// kdprop
		// kdkota
		// kdkec
		// alamatp
		// kdpos
		// telpp
		// faxp
		// emailp
		// webp
		// medsos
		// kdjenis
		// kdproduknafed
		// kdproduknafed2
		// kdproduknafed3
		// pproduk
		// kdexport
		// nexport
		// kdskala
		// kdkategori
		// omzet_saat_ini
		// omzet_stl_6bln
		// omzet_stl_1thn
		// omzet_stl_2thn
		// kapasitas_saat_ini
		// kapasitas_stl_6bln
		// kapasitas_stl_1thn
		// kapasitas_stl_2thn
		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jpeserta
		// namap

		$this->namap->ViewValue = $this->namap->CurrentValue;
		$this->namap->ViewCustomAttributes = "";

		// idp
		$this->idp->ViewValue = $this->idp->CurrentValue;
		$arwrk = [];
		$arwrk[1] = $this->namap->CurrentValue;
		$this->idp->ViewValue = $this->idp->displayValue($arwrk);
		$this->idp->ViewCustomAttributes = "";

		// kontak
		$this->kontak->ViewValue = $this->kontak->CurrentValue;
		$this->kontak->ViewCustomAttributes = "";

		// kdlokasi
		$curVal = strval($this->kdlokasi->CurrentValue);
		if ($curVal != "") {
			$this->kdlokasi->ViewValue = $this->kdlokasi->lookupCacheOption($curVal);
			if ($this->kdlokasi->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdlokasi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdlokasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdlokasi->ViewValue = $this->kdlokasi->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdlokasi->ViewValue = $this->kdlokasi->CurrentValue;
				}
			}
		} else {
			$this->kdlokasi->ViewValue = NULL;
		}
		$this->kdlokasi->ViewCustomAttributes = "";

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

		// alamatp
		$this->alamatp->ViewValue = $this->alamatp->CurrentValue;
		$this->alamatp->ViewCustomAttributes = "";

		// kdpos
		$this->kdpos->ViewValue = $this->kdpos->CurrentValue;
		$this->kdpos->ViewCustomAttributes = "";

		// telpp
		$this->telpp->ViewValue = $this->telpp->CurrentValue;
		$this->telpp->ViewCustomAttributes = "";

		// faxp
		$this->faxp->ViewValue = $this->faxp->CurrentValue;
		$this->faxp->ViewCustomAttributes = "";

		// emailp
		$this->emailp->ViewValue = $this->emailp->CurrentValue;
		$this->emailp->ViewCustomAttributes = "";

		// webp
		$this->webp->ViewValue = $this->webp->CurrentValue;
		$this->webp->ViewCustomAttributes = "";

		// medsos
		$this->medsos->ViewValue = $this->medsos->CurrentValue;
		$this->medsos->ViewCustomAttributes = "";

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

		// omzet_saat_ini
		$this->omzet_saat_ini->ViewValue = $this->omzet_saat_ini->CurrentValue;
		$this->omzet_saat_ini->ViewCustomAttributes = "";

		// omzet_stl_6bln
		$this->omzet_stl_6bln->ViewValue = $this->omzet_stl_6bln->CurrentValue;
		$this->omzet_stl_6bln->ViewCustomAttributes = "";

		// omzet_stl_1thn
		$this->omzet_stl_1thn->ViewValue = $this->omzet_stl_1thn->CurrentValue;
		$this->omzet_stl_1thn->ViewCustomAttributes = "";

		// omzet_stl_2thn
		$this->omzet_stl_2thn->ViewValue = $this->omzet_stl_2thn->CurrentValue;
		$this->omzet_stl_2thn->ViewCustomAttributes = "";

		// kapasitas_saat_ini
		$this->kapasitas_saat_ini->ViewValue = $this->kapasitas_saat_ini->CurrentValue;
		$this->kapasitas_saat_ini->ViewCustomAttributes = "";

		// kapasitas_stl_6bln
		$this->kapasitas_stl_6bln->ViewValue = $this->kapasitas_stl_6bln->CurrentValue;
		$this->kapasitas_stl_6bln->ViewCustomAttributes = "";

		// kapasitas_stl_1thn
		$this->kapasitas_stl_1thn->ViewValue = $this->kapasitas_stl_1thn->CurrentValue;
		$this->kapasitas_stl_1thn->ViewCustomAttributes = "";

		// kapasitas_stl_2thn
		$this->kapasitas_stl_2thn->ViewValue = $this->kapasitas_stl_2thn->CurrentValue;
		$this->kapasitas_stl_2thn->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// user_created_by
		$this->user_created_by->ViewValue = $this->user_created_by->CurrentValue;
		$this->user_created_by->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// user_updated_by
		$this->user_updated_by->ViewValue = $this->user_updated_by->CurrentValue;
		$this->user_updated_by->ViewCustomAttributes = "";

		// jpeserta
		$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
		$this->jpeserta->ViewCustomAttributes = "";

		// namap
		$this->namap->LinkCustomAttributes = "";
		$this->namap->HrefValue = "";
		$this->namap->TooltipValue = "";

		// idp
		$this->idp->LinkCustomAttributes = "";
		$this->idp->HrefValue = "";
		$this->idp->TooltipValue = "";

		// kontak
		$this->kontak->LinkCustomAttributes = "";
		$this->kontak->HrefValue = "";
		$this->kontak->TooltipValue = "";

		// kdlokasi
		$this->kdlokasi->LinkCustomAttributes = "";
		$this->kdlokasi->HrefValue = "";
		$this->kdlokasi->TooltipValue = "";

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

		// alamatp
		$this->alamatp->LinkCustomAttributes = "";
		$this->alamatp->HrefValue = "";
		$this->alamatp->TooltipValue = "";

		// kdpos
		$this->kdpos->LinkCustomAttributes = "";
		$this->kdpos->HrefValue = "";
		$this->kdpos->TooltipValue = "";

		// telpp
		$this->telpp->LinkCustomAttributes = "";
		$this->telpp->HrefValue = "";
		$this->telpp->TooltipValue = "";

		// faxp
		$this->faxp->LinkCustomAttributes = "";
		$this->faxp->HrefValue = "";
		$this->faxp->TooltipValue = "";

		// emailp
		$this->emailp->LinkCustomAttributes = "";
		$this->emailp->HrefValue = "";
		$this->emailp->TooltipValue = "";

		// webp
		$this->webp->LinkCustomAttributes = "";
		$this->webp->HrefValue = "";
		$this->webp->TooltipValue = "";

		// medsos
		$this->medsos->LinkCustomAttributes = "";
		$this->medsos->HrefValue = "";
		$this->medsos->TooltipValue = "";

		// kdjenis
		$this->kdjenis->LinkCustomAttributes = "";
		$this->kdjenis->HrefValue = "";
		$this->kdjenis->TooltipValue = "";

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

		// kdexport
		$this->kdexport->LinkCustomAttributes = "";
		$this->kdexport->HrefValue = "";
		$this->kdexport->TooltipValue = "";

		// nexport
		$this->nexport->LinkCustomAttributes = "";
		$this->nexport->HrefValue = "";
		$this->nexport->TooltipValue = "";

		// kdskala
		$this->kdskala->LinkCustomAttributes = "";
		$this->kdskala->HrefValue = "";
		$this->kdskala->TooltipValue = "";

		// kdkategori
		$this->kdkategori->LinkCustomAttributes = "";
		$this->kdkategori->HrefValue = "";
		$this->kdkategori->TooltipValue = "";

		// omzet_saat_ini
		$this->omzet_saat_ini->LinkCustomAttributes = "";
		$this->omzet_saat_ini->HrefValue = "";
		$this->omzet_saat_ini->TooltipValue = "";

		// omzet_stl_6bln
		$this->omzet_stl_6bln->LinkCustomAttributes = "";
		$this->omzet_stl_6bln->HrefValue = "";
		$this->omzet_stl_6bln->TooltipValue = "";

		// omzet_stl_1thn
		$this->omzet_stl_1thn->LinkCustomAttributes = "";
		$this->omzet_stl_1thn->HrefValue = "";
		$this->omzet_stl_1thn->TooltipValue = "";

		// omzet_stl_2thn
		$this->omzet_stl_2thn->LinkCustomAttributes = "";
		$this->omzet_stl_2thn->HrefValue = "";
		$this->omzet_stl_2thn->TooltipValue = "";

		// kapasitas_saat_ini
		$this->kapasitas_saat_ini->LinkCustomAttributes = "";
		$this->kapasitas_saat_ini->HrefValue = "";
		$this->kapasitas_saat_ini->TooltipValue = "";

		// kapasitas_stl_6bln
		$this->kapasitas_stl_6bln->LinkCustomAttributes = "";
		$this->kapasitas_stl_6bln->HrefValue = "";
		$this->kapasitas_stl_6bln->TooltipValue = "";

		// kapasitas_stl_1thn
		$this->kapasitas_stl_1thn->LinkCustomAttributes = "";
		$this->kapasitas_stl_1thn->HrefValue = "";
		$this->kapasitas_stl_1thn->TooltipValue = "";

		// kapasitas_stl_2thn
		$this->kapasitas_stl_2thn->LinkCustomAttributes = "";
		$this->kapasitas_stl_2thn->HrefValue = "";
		$this->kapasitas_stl_2thn->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// user_created_by
		$this->user_created_by->LinkCustomAttributes = "";
		$this->user_created_by->HrefValue = "";
		$this->user_created_by->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

		// user_updated_by
		$this->user_updated_by->LinkCustomAttributes = "";
		$this->user_updated_by->HrefValue = "";
		$this->user_updated_by->TooltipValue = "";

		// jpeserta
		$this->jpeserta->LinkCustomAttributes = "";
		$this->jpeserta->HrefValue = "";
		$this->jpeserta->TooltipValue = "";

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

		// namap
		$this->namap->EditAttrs["class"] = "form-control";
		$this->namap->EditCustomAttributes = "";
		if (!$this->namap->Raw)
			$this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
		$this->namap->EditValue = $this->namap->CurrentValue;
		$this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

		// idp
		$this->idp->EditAttrs["class"] = "form-control";
		$this->idp->EditCustomAttributes = "";
		$this->idp->EditValue = $this->idp->CurrentValue;
		$arwrk = [];
		$arwrk[1] = $this->namap->CurrentValue;
		$this->idp->EditValue = $this->idp->displayValue($arwrk);
		$this->idp->ViewCustomAttributes = "";

		// kontak
		$this->kontak->EditAttrs["class"] = "form-control";
		$this->kontak->EditCustomAttributes = "";
		if (!$this->kontak->Raw)
			$this->kontak->CurrentValue = HtmlDecode($this->kontak->CurrentValue);
		$this->kontak->EditValue = $this->kontak->CurrentValue;
		$this->kontak->PlaceHolder = RemoveHtml($this->kontak->caption());

		// kdlokasi
		$this->kdlokasi->EditAttrs["class"] = "form-control";
		$this->kdlokasi->EditCustomAttributes = "";

		// kdprop
		$this->kdprop->EditAttrs["class"] = "form-control";
		$this->kdprop->EditCustomAttributes = "";

		// kdkota
		$this->kdkota->EditAttrs["class"] = "form-control";
		$this->kdkota->EditCustomAttributes = "";

		// kdkec
		$this->kdkec->EditAttrs["class"] = "form-control";
		$this->kdkec->EditCustomAttributes = "";

		// alamatp
		$this->alamatp->EditAttrs["class"] = "form-control";
		$this->alamatp->EditCustomAttributes = "";
		$this->alamatp->EditValue = $this->alamatp->CurrentValue;
		$this->alamatp->PlaceHolder = RemoveHtml($this->alamatp->caption());

		// kdpos
		$this->kdpos->EditAttrs["class"] = "form-control";
		$this->kdpos->EditCustomAttributes = "";
		if (!$this->kdpos->Raw)
			$this->kdpos->CurrentValue = HtmlDecode($this->kdpos->CurrentValue);
		$this->kdpos->EditValue = $this->kdpos->CurrentValue;
		$this->kdpos->PlaceHolder = RemoveHtml($this->kdpos->caption());

		// telpp
		$this->telpp->EditAttrs["class"] = "form-control";
		$this->telpp->EditCustomAttributes = "";
		if (!$this->telpp->Raw)
			$this->telpp->CurrentValue = HtmlDecode($this->telpp->CurrentValue);
		$this->telpp->EditValue = $this->telpp->CurrentValue;
		$this->telpp->PlaceHolder = RemoveHtml($this->telpp->caption());

		// faxp
		$this->faxp->EditAttrs["class"] = "form-control";
		$this->faxp->EditCustomAttributes = "";
		if (!$this->faxp->Raw)
			$this->faxp->CurrentValue = HtmlDecode($this->faxp->CurrentValue);
		$this->faxp->EditValue = $this->faxp->CurrentValue;
		$this->faxp->PlaceHolder = RemoveHtml($this->faxp->caption());

		// emailp
		$this->emailp->EditAttrs["class"] = "form-control";
		$this->emailp->EditCustomAttributes = "";
		if (!$this->emailp->Raw)
			$this->emailp->CurrentValue = HtmlDecode($this->emailp->CurrentValue);
		$this->emailp->EditValue = $this->emailp->CurrentValue;
		$this->emailp->PlaceHolder = RemoveHtml($this->emailp->caption());

		// webp
		$this->webp->EditAttrs["class"] = "form-control";
		$this->webp->EditCustomAttributes = "";
		if (!$this->webp->Raw)
			$this->webp->CurrentValue = HtmlDecode($this->webp->CurrentValue);
		$this->webp->EditValue = $this->webp->CurrentValue;
		$this->webp->PlaceHolder = RemoveHtml($this->webp->caption());

		// medsos
		$this->medsos->EditAttrs["class"] = "form-control";
		$this->medsos->EditCustomAttributes = "";
		if (!$this->medsos->Raw)
			$this->medsos->CurrentValue = HtmlDecode($this->medsos->CurrentValue);
		$this->medsos->EditValue = $this->medsos->CurrentValue;
		$this->medsos->PlaceHolder = RemoveHtml($this->medsos->caption());

		// kdjenis
		$this->kdjenis->EditAttrs["class"] = "form-control";
		$this->kdjenis->EditCustomAttributes = "";

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

		// kdexport
		$this->kdexport->EditAttrs["class"] = "form-control";
		$this->kdexport->EditCustomAttributes = "";

		// nexport
		$this->nexport->EditAttrs["class"] = "form-control";
		$this->nexport->EditCustomAttributes = "";
		$this->nexport->EditValue = $this->nexport->CurrentValue;
		$this->nexport->PlaceHolder = RemoveHtml($this->nexport->caption());

		// kdskala
		$this->kdskala->EditAttrs["class"] = "form-control";
		$this->kdskala->EditCustomAttributes = "";

		// kdkategori
		$this->kdkategori->EditAttrs["class"] = "form-control";
		$this->kdkategori->EditCustomAttributes = "";

		// omzet_saat_ini
		$this->omzet_saat_ini->EditAttrs["class"] = "form-control";
		$this->omzet_saat_ini->EditCustomAttributes = "";
		if (!$this->omzet_saat_ini->Raw)
			$this->omzet_saat_ini->CurrentValue = HtmlDecode($this->omzet_saat_ini->CurrentValue);
		$this->omzet_saat_ini->EditValue = $this->omzet_saat_ini->CurrentValue;
		$this->omzet_saat_ini->PlaceHolder = RemoveHtml($this->omzet_saat_ini->caption());

		// omzet_stl_6bln
		$this->omzet_stl_6bln->EditAttrs["class"] = "form-control";
		$this->omzet_stl_6bln->EditCustomAttributes = "";
		if (!$this->omzet_stl_6bln->Raw)
			$this->omzet_stl_6bln->CurrentValue = HtmlDecode($this->omzet_stl_6bln->CurrentValue);
		$this->omzet_stl_6bln->EditValue = $this->omzet_stl_6bln->CurrentValue;
		$this->omzet_stl_6bln->PlaceHolder = RemoveHtml($this->omzet_stl_6bln->caption());

		// omzet_stl_1thn
		$this->omzet_stl_1thn->EditAttrs["class"] = "form-control";
		$this->omzet_stl_1thn->EditCustomAttributes = "";
		if (!$this->omzet_stl_1thn->Raw)
			$this->omzet_stl_1thn->CurrentValue = HtmlDecode($this->omzet_stl_1thn->CurrentValue);
		$this->omzet_stl_1thn->EditValue = $this->omzet_stl_1thn->CurrentValue;
		$this->omzet_stl_1thn->PlaceHolder = RemoveHtml($this->omzet_stl_1thn->caption());

		// omzet_stl_2thn
		$this->omzet_stl_2thn->EditAttrs["class"] = "form-control";
		$this->omzet_stl_2thn->EditCustomAttributes = "";
		$this->omzet_stl_2thn->EditValue = $this->omzet_stl_2thn->CurrentValue;
		$this->omzet_stl_2thn->ViewCustomAttributes = "";

		// kapasitas_saat_ini
		$this->kapasitas_saat_ini->EditAttrs["class"] = "form-control";
		$this->kapasitas_saat_ini->EditCustomAttributes = "";
		if (!$this->kapasitas_saat_ini->Raw)
			$this->kapasitas_saat_ini->CurrentValue = HtmlDecode($this->kapasitas_saat_ini->CurrentValue);
		$this->kapasitas_saat_ini->EditValue = $this->kapasitas_saat_ini->CurrentValue;
		$this->kapasitas_saat_ini->PlaceHolder = RemoveHtml($this->kapasitas_saat_ini->caption());

		// kapasitas_stl_6bln
		$this->kapasitas_stl_6bln->EditAttrs["class"] = "form-control";
		$this->kapasitas_stl_6bln->EditCustomAttributes = "";
		if (!$this->kapasitas_stl_6bln->Raw)
			$this->kapasitas_stl_6bln->CurrentValue = HtmlDecode($this->kapasitas_stl_6bln->CurrentValue);
		$this->kapasitas_stl_6bln->EditValue = $this->kapasitas_stl_6bln->CurrentValue;
		$this->kapasitas_stl_6bln->PlaceHolder = RemoveHtml($this->kapasitas_stl_6bln->caption());

		// kapasitas_stl_1thn
		$this->kapasitas_stl_1thn->EditAttrs["class"] = "form-control";
		$this->kapasitas_stl_1thn->EditCustomAttributes = "";
		if (!$this->kapasitas_stl_1thn->Raw)
			$this->kapasitas_stl_1thn->CurrentValue = HtmlDecode($this->kapasitas_stl_1thn->CurrentValue);
		$this->kapasitas_stl_1thn->EditValue = $this->kapasitas_stl_1thn->CurrentValue;
		$this->kapasitas_stl_1thn->PlaceHolder = RemoveHtml($this->kapasitas_stl_1thn->caption());

		// kapasitas_stl_2thn
		$this->kapasitas_stl_2thn->EditAttrs["class"] = "form-control";
		$this->kapasitas_stl_2thn->EditCustomAttributes = "";
		if (!$this->kapasitas_stl_2thn->Raw)
			$this->kapasitas_stl_2thn->CurrentValue = HtmlDecode($this->kapasitas_stl_2thn->CurrentValue);
		$this->kapasitas_stl_2thn->EditValue = $this->kapasitas_stl_2thn->CurrentValue;
		$this->kapasitas_stl_2thn->PlaceHolder = RemoveHtml($this->kapasitas_stl_2thn->caption());

		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jpeserta

		$this->jpeserta->EditAttrs["class"] = "form-control";
		$this->jpeserta->EditCustomAttributes = "";
		$this->jpeserta->EditValue = $this->jpeserta->CurrentValue;
		$this->jpeserta->PlaceHolder = RemoveHtml($this->jpeserta->caption());

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
					$doc->exportCaption($this->namap);
					$doc->exportCaption($this->kontak);
					$doc->exportCaption($this->kdlokasi);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdkec);
					$doc->exportCaption($this->alamatp);
					$doc->exportCaption($this->kdpos);
					$doc->exportCaption($this->telpp);
					$doc->exportCaption($this->faxp);
					$doc->exportCaption($this->emailp);
					$doc->exportCaption($this->webp);
					$doc->exportCaption($this->medsos);
					$doc->exportCaption($this->kdjenis);
					$doc->exportCaption($this->kdproduknafed);
					$doc->exportCaption($this->kdproduknafed2);
					$doc->exportCaption($this->kdproduknafed3);
					$doc->exportCaption($this->pproduk);
					$doc->exportCaption($this->kdexport);
					$doc->exportCaption($this->nexport);
					$doc->exportCaption($this->kdskala);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->omzet_saat_ini);
					$doc->exportCaption($this->omzet_stl_6bln);
					$doc->exportCaption($this->omzet_stl_1thn);
					$doc->exportCaption($this->omzet_stl_2thn);
					$doc->exportCaption($this->kapasitas_saat_ini);
					$doc->exportCaption($this->kapasitas_stl_6bln);
					$doc->exportCaption($this->kapasitas_stl_1thn);
					$doc->exportCaption($this->kapasitas_stl_2thn);
					$doc->exportCaption($this->jpeserta);
				} else {
					$doc->exportCaption($this->namap);
					$doc->exportCaption($this->kontak);
					$doc->exportCaption($this->kdlokasi);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdkec);
					$doc->exportCaption($this->kdpos);
					$doc->exportCaption($this->telpp);
					$doc->exportCaption($this->faxp);
					$doc->exportCaption($this->emailp);
					$doc->exportCaption($this->webp);
					$doc->exportCaption($this->medsos);
					$doc->exportCaption($this->kdjenis);
					$doc->exportCaption($this->kdproduknafed);
					$doc->exportCaption($this->kdproduknafed2);
					$doc->exportCaption($this->kdproduknafed3);
					$doc->exportCaption($this->pproduk);
					$doc->exportCaption($this->kdexport);
					$doc->exportCaption($this->nexport);
					$doc->exportCaption($this->kdskala);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->omzet_saat_ini);
					$doc->exportCaption($this->omzet_stl_6bln);
					$doc->exportCaption($this->omzet_stl_1thn);
					$doc->exportCaption($this->omzet_stl_2thn);
					$doc->exportCaption($this->kapasitas_saat_ini);
					$doc->exportCaption($this->kapasitas_stl_6bln);
					$doc->exportCaption($this->kapasitas_stl_1thn);
					$doc->exportCaption($this->kapasitas_stl_2thn);
					$doc->exportCaption($this->jpeserta);
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
						$doc->exportField($this->namap);
						$doc->exportField($this->kontak);
						$doc->exportField($this->kdlokasi);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdkec);
						$doc->exportField($this->alamatp);
						$doc->exportField($this->kdpos);
						$doc->exportField($this->telpp);
						$doc->exportField($this->faxp);
						$doc->exportField($this->emailp);
						$doc->exportField($this->webp);
						$doc->exportField($this->medsos);
						$doc->exportField($this->kdjenis);
						$doc->exportField($this->kdproduknafed);
						$doc->exportField($this->kdproduknafed2);
						$doc->exportField($this->kdproduknafed3);
						$doc->exportField($this->pproduk);
						$doc->exportField($this->kdexport);
						$doc->exportField($this->nexport);
						$doc->exportField($this->kdskala);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->omzet_saat_ini);
						$doc->exportField($this->omzet_stl_6bln);
						$doc->exportField($this->omzet_stl_1thn);
						$doc->exportField($this->omzet_stl_2thn);
						$doc->exportField($this->kapasitas_saat_ini);
						$doc->exportField($this->kapasitas_stl_6bln);
						$doc->exportField($this->kapasitas_stl_1thn);
						$doc->exportField($this->kapasitas_stl_2thn);
						$doc->exportField($this->jpeserta);
					} else {
						$doc->exportField($this->namap);
						$doc->exportField($this->kontak);
						$doc->exportField($this->kdlokasi);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdkec);
						$doc->exportField($this->kdpos);
						$doc->exportField($this->telpp);
						$doc->exportField($this->faxp);
						$doc->exportField($this->emailp);
						$doc->exportField($this->webp);
						$doc->exportField($this->medsos);
						$doc->exportField($this->kdjenis);
						$doc->exportField($this->kdproduknafed);
						$doc->exportField($this->kdproduknafed2);
						$doc->exportField($this->kdproduknafed3);
						$doc->exportField($this->pproduk);
						$doc->exportField($this->kdexport);
						$doc->exportField($this->nexport);
						$doc->exportField($this->kdskala);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->omzet_saat_ini);
						$doc->exportField($this->omzet_stl_6bln);
						$doc->exportField($this->omzet_stl_1thn);
						$doc->exportField($this->omzet_stl_2thn);
						$doc->exportField($this->kapasitas_saat_ini);
						$doc->exportField($this->kapasitas_stl_6bln);
						$doc->exportField($this->kapasitas_stl_1thn);
						$doc->exportField($this->kapasitas_stl_2thn);
						$doc->exportField($this->jpeserta);
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
		$table = 't_perusahaan';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_perusahaan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['idp'];

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
		$table = 't_perusahaan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['idp'];

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
		$table = 't_perusahaan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['idp'];

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
		if(isset($_GET["x_kdproduknafed"]) && !empty($_GET["x_kdproduknafed"])){
			$filter = preg_replace('/`kdproduknafed` = \''.StripSlashes(@$_GET["x_kdproduknafed"]).'\'/','`kdproduknafed` = \''.StripSlashes(@$_GET["x_kdproduknafed"]).'\' OR `kdproduknafed2` = \''.StripSlashes(@$_GET["x_kdproduknafed"]).'\' OR `kdproduknafed3` = \''.StripSlashes(@$_GET["x_kdproduknafed"]).'\'',$filter); 
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

		$jp = ExecuteScalar("SELECT COUNT(1) FROM `t_peserta` WHERE `t_peserta`.`idp` = '".$this->idp->CurrentValue."'");
		$this->jpeserta->ViewValue = $jp;
		if (CurrentPage()->PageID <> "list" ){
			$this->jpeserta->Visible = (CurrentPage()->RowType <> ROWTYPE_SEARCH);
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>