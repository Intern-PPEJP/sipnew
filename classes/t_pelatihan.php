<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_pelatihan
 */
class t_pelatihan extends DbTable
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
	public $idpelat;
	public $kdpelat;
	public $kdjudul;
	public $kdkursil;
	public $revisi;
	public $tgl_terbit;
	public $pilihan_iso;
	public $tawal;
	public $takhir;
	public $tglpel;
	public $kdprop;
	public $kdkota;
	public $kdkec;
	public $ketua;
	public $sekretaris;
	public $bendahara;
	public $anggota2;
	public $widyaiswara;
	public $jenisevaluasi;
	public $created_at;
	public $user_created_by;
	public $updated_at;
	public $user_updated_by;
	public $jenispel;
	public $kdkategori;
	public $kerjasama;
	public $dana;
	public $biaya;
	public $coachingprogr;
	public $area;
	public $periode_awal;
	public $periode_akhir;
	public $tahapan;
	public $namaberkas;
	public $instruktur;
	public $nmou;
	public $nmou2;
	public $statuspel;
	public $ket;
	public $tempat;
	public $jpeserta;
	public $jml_hari;
	public $targetpes;
	public $target_peserta;
	public $durasi1;
	public $durasi2;
	public $rid;
	public $real_peserta;
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
	public $produk;
	public $bbio;
	public $bbio2;
	public $bbio3;
	public $bbio4;
	public $bbio5;
	public $Tahun;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_pelatihan';
		$this->TableName = 't_pelatihan';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_pelatihan`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// idpelat
		$this->idpelat = new DbField('t_pelatihan', 't_pelatihan', 'x_idpelat', 'idpelat', '`idpelat`', '`idpelat`', 3, 11, -1, FALSE, '`idpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idpelat->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idpelat->IsPrimaryKey = TRUE; // Primary key field
		$this->idpelat->IsForeignKey = TRUE; // Foreign key field
		$this->idpelat->Sortable = TRUE; // Allow sort
		$this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idpelat'] = &$this->idpelat;

		// kdpelat
		$this->kdpelat = new DbField('t_pelatihan', 't_pelatihan', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 20, -1, FALSE, '`kdpelat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdpelat->IsForeignKey = TRUE; // Foreign key field
		$this->kdpelat->Nullable = FALSE; // NOT NULL field
		$this->kdpelat->Required = TRUE; // Required field
		$this->kdpelat->Sortable = TRUE; // Allow sort
		$this->fields['kdpelat'] = &$this->kdpelat;

		// kdjudul
		$this->kdjudul = new DbField('t_pelatihan', 't_pelatihan', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, FALSE, '`EV__kdjudul`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->kdjudul->IsForeignKey = TRUE; // Foreign key field
		$this->kdjudul->Required = TRUE; // Required field
		$this->kdjudul->Sortable = FALSE; // Allow sort
		$this->kdjudul->Lookup = new Lookup('kdjudul', 't_judul', FALSE, 'kdjudul', ["judul","","",""], [], ["x_kdkursil","x_revisi"], [], [], [], [], '`judul` ASC', '');
		$this->fields['kdjudul'] = &$this->kdjudul;

		// kdkursil
		$this->kdkursil = new DbField('t_pelatihan', 't_pelatihan', 'x_kdkursil', 'kdkursil', '`kdkursil`', '`kdkursil`', 200, 12, -1, FALSE, '`kdkursil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kdkursil->Sortable = TRUE; // Allow sort
		$this->kdkursil->Lookup = new Lookup('kdkursil', 't_juduldetail', FALSE, 'kdkursil', ["kdkursil","revisi","tgl_terbit",""], ["x_kdjudul"], [], ["kdjudul"], ["x_kdjudul"], ["revisi","tgl_terbit"], ["x_revisi","x_tgl_terbit"], '', '');
		$this->fields['kdkursil'] = &$this->kdkursil;

		// revisi
		$this->revisi = new DbField('t_pelatihan', 't_pelatihan', 'x_revisi', 'revisi', '`revisi`', '`revisi`', 200, 2, -1, FALSE, '`revisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revisi->Sortable = TRUE; // Allow sort
		$this->fields['revisi'] = &$this->revisi;

		// tgl_terbit
		$this->tgl_terbit = new DbField('t_pelatihan', 't_pelatihan', 'x_tgl_terbit', 'tgl_terbit', '`tgl_terbit`', CastDateFieldForLike("`tgl_terbit`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_terbit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_terbit->Sortable = TRUE; // Allow sort
		$this->tgl_terbit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_terbit'] = &$this->tgl_terbit;

		// pilihan_iso
		$this->pilihan_iso = new DbField('t_pelatihan', 't_pelatihan', 'x_pilihan_iso', 'pilihan_iso', '`pilihan_iso`', '`pilihan_iso`', 200, 25, -1, FALSE, '`pilihan_iso`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pilihan_iso->Required = TRUE; // Required field
		$this->pilihan_iso->Sortable = TRUE; // Allow sort
		$this->pilihan_iso->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pilihan_iso->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->pilihan_iso->Lookup = new Lookup('pilihan_iso', 't_pelatihan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->pilihan_iso->OptionCount = 2;
		$this->fields['pilihan_iso'] = &$this->pilihan_iso;

		// tawal
		$this->tawal = new DbField('t_pelatihan', 't_pelatihan', 'x_tawal', 'tawal', '`tawal`', CastDateFieldForLike("`tawal`", 0, "DB"), 135, 19, 0, FALSE, '`tawal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tawal->Required = TRUE; // Required field
		$this->tawal->Sortable = TRUE; // Allow sort
		$this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tawal'] = &$this->tawal;

		// takhir
		$this->takhir = new DbField('t_pelatihan', 't_pelatihan', 'x_takhir', 'takhir', '`takhir`', CastDateFieldForLike("`takhir`", 0, "DB"), 135, 19, 0, FALSE, '`takhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->takhir->Required = TRUE; // Required field
		$this->takhir->Sortable = TRUE; // Allow sort
		$this->takhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['takhir'] = &$this->takhir;

		// tglpel
		$this->tglpel = new DbField('t_pelatihan', 't_pelatihan', 'x_tglpel', 'tglpel', 'NULL', 'NULL', 12, 65530, -1, FALSE, 'NULL', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpel->IsCustom = TRUE; // Custom field
		$this->tglpel->Sortable = FALSE; // Allow sort
		$this->fields['tglpel'] = &$this->tglpel;

		// kdprop
		$this->kdprop = new DbField('t_pelatihan', 't_pelatihan', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, FALSE, '`kdprop`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdprop->IsForeignKey = TRUE; // Foreign key field
		$this->kdprop->Required = TRUE; // Required field
		$this->kdprop->Sortable = TRUE; // Allow sort
		$this->kdprop->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdprop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdprop->Lookup = new Lookup('kdprop', 't_prop', FALSE, 'kdprop', ["prop","","",""], [], ["x_kdkota"], [], [], [], [], '`prop` ASC', '');
		$this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdprop'] = &$this->kdprop;

		// kdkota
		$this->kdkota = new DbField('t_pelatihan', 't_pelatihan', 'x_kdkota', 'kdkota', '`kdkota`', '`kdkota`', 3, 11, -1, FALSE, '`kdkota`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkota->IsForeignKey = TRUE; // Foreign key field
		$this->kdkota->Required = TRUE; // Required field
		$this->kdkota->Sortable = TRUE; // Allow sort
		$this->kdkota->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkota->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkota->Lookup = new Lookup('kdkota', 't_kota', FALSE, 'kdkota', ["kota","","",""], ["x_kdprop"], ["x_kdkec"], ["kdprop"], ["x_kdprop"], [], [], '`kota` ASC', '');
		$this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkota'] = &$this->kdkota;

		// kdkec
		$this->kdkec = new DbField('t_pelatihan', 't_pelatihan', 'x_kdkec', 'kdkec', '`kdkec`', '`kdkec`', 3, 11, -1, FALSE, '`EV__kdkec`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkec->Sortable = TRUE; // Allow sort
		$this->kdkec->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkec->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkec->Lookup = new Lookup('kdkec', 't_kec', FALSE, 'kdkec', ["kec","","",""], ["x_kdkota"], [], ["kdkota"], ["x_kdkota"], [], [], '`kec` ASC', '');
		$this->kdkec->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkec'] = &$this->kdkec;

		// ketua
		$this->ketua = new DbField('t_pelatihan', 't_pelatihan', 'x_ketua', 'ketua', '`ketua`', '`ketua`', 200, 40, -1, FALSE, '`ketua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ketua->Required = TRUE; // Required field
		$this->ketua->Sortable = TRUE; // Allow sort
		$this->ketua->Lookup = new Lookup('ketua', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['ketua'] = &$this->ketua;

		// sekretaris
		$this->sekretaris = new DbField('t_pelatihan', 't_pelatihan', 'x_sekretaris', 'sekretaris', '`sekretaris`', '`sekretaris`', 200, 40, -1, FALSE, '`sekretaris`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sekretaris->Required = TRUE; // Required field
		$this->sekretaris->Sortable = TRUE; // Allow sort
		$this->sekretaris->Lookup = new Lookup('sekretaris', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['sekretaris'] = &$this->sekretaris;

		// bendahara
		$this->bendahara = new DbField('t_pelatihan', 't_pelatihan', 'x_bendahara', 'bendahara', '`bendahara`', '`bendahara`', 200, 40, -1, FALSE, '`bendahara`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bendahara->Required = TRUE; // Required field
		$this->bendahara->Sortable = TRUE; // Allow sort
		$this->bendahara->Lookup = new Lookup('bendahara', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['bendahara'] = &$this->bendahara;

		// anggota2
		$this->anggota2 = new DbField('t_pelatihan', 't_pelatihan', 'x_anggota2', 'anggota2', '`anggota2`', '`anggota2`', 200, 40, -1, FALSE, '`anggota2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->anggota2->Required = TRUE; // Required field
		$this->anggota2->Sortable = TRUE; // Allow sort
		$this->anggota2->Lookup = new Lookup('anggota2', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->fields['anggota2'] = &$this->anggota2;

		// widyaiswara
		$this->widyaiswara = new DbField('t_pelatihan', 't_pelatihan', 'x_widyaiswara', 'widyaiswara', '`widyaiswara`', '`widyaiswara`', 3, 11, -1, FALSE, '`widyaiswara`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->widyaiswara->Sortable = TRUE; // Allow sort
		$this->widyaiswara->Lookup = new Lookup('widyaiswara', 'vt_pegawai', FALSE, 'id_peg', ["nama","","",""], [], [], [], [], [], [], '`nama` ASC', '');
		$this->widyaiswara->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['widyaiswara'] = &$this->widyaiswara;

		// jenisevaluasi
		$this->jenisevaluasi = new DbField('t_pelatihan', 't_pelatihan', 'x_jenisevaluasi', 'jenisevaluasi', '`jenisevaluasi`', '`jenisevaluasi`', 200, 25, -1, FALSE, '`jenisevaluasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenisevaluasi->Nullable = FALSE; // NOT NULL field
		$this->jenisevaluasi->Required = TRUE; // Required field
		$this->jenisevaluasi->Sortable = TRUE; // Allow sort
		$this->jenisevaluasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenisevaluasi'] = &$this->jenisevaluasi;

		// created_at
		$this->created_at = new DbField('t_pelatihan', 't_pelatihan', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// user_created_by
		$this->user_created_by = new DbField('t_pelatihan', 't_pelatihan', 'x_user_created_by', 'user_created_by', '`user_created_by`', '`user_created_by`', 200, 100, -1, FALSE, '`user_created_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_created_by->Sortable = TRUE; // Allow sort
		$this->fields['user_created_by'] = &$this->user_created_by;

		// updated_at
		$this->updated_at = new DbField('t_pelatihan', 't_pelatihan', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// user_updated_by
		$this->user_updated_by = new DbField('t_pelatihan', 't_pelatihan', 'x_user_updated_by', 'user_updated_by', '`user_updated_by`', '`user_updated_by`', 200, 100, -1, FALSE, '`user_updated_by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_updated_by->Sortable = TRUE; // Allow sort
		$this->fields['user_updated_by'] = &$this->user_updated_by;

		// jenispel
		$this->jenispel = new DbField('t_pelatihan', 't_pelatihan', 'x_jenispel', 'jenispel', '`jenispel`', '`jenispel`', 16, 2, -1, FALSE, '`jenispel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenispel->Required = TRUE; // Required field
		$this->jenispel->Sortable = TRUE; // Allow sort
		$this->jenispel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenispel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenispel->Lookup = new Lookup('jenispel', 't_pelatihan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenispel->OptionCount = 11;
		$this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenispel'] = &$this->jenispel;

		// kdkategori
		$this->kdkategori = new DbField('t_pelatihan', 't_pelatihan', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, FALSE, '`kdkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkategori->Required = TRUE; // Required field
		$this->kdkategori->Sortable = TRUE; // Allow sort
		$this->kdkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', FALSE, 'kdkategori', ["kategori","","",""], [], ["x_kerjasama"], [], [], [], [], '`kdkategori` ASC', '');
		$this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkategori'] = &$this->kdkategori;

		// kerjasama
		$this->kerjasama = new DbField('t_pelatihan', 't_pelatihan', 'x_kerjasama', 'kerjasama', '`kerjasama`', '`kerjasama`', 3, 11, -1, FALSE, '`kerjasama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kerjasama->Required = TRUE; // Required field
		$this->kerjasama->Sortable = TRUE; // Allow sort
		$this->kerjasama->Lookup = new Lookup('kerjasama', 't_perusahaan', FALSE, 'idp', ["namap","","",""], ["x_kdkategori"], [], ["kdkategori"], ["x_kdkategori"], [], [], '`namap` ASC', '');
		$this->kerjasama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kerjasama'] = &$this->kerjasama;

		// dana
		$this->dana = new DbField('t_pelatihan', 't_pelatihan', 'x_dana', 'dana', '`dana`', '`dana`', 200, 25, -1, FALSE, '`dana`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->dana->Sortable = TRUE; // Allow sort
		$this->dana->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->dana->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->dana->Lookup = new Lookup('dana', 't_pelatihan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->dana->OptionCount = 4;
		$this->fields['dana'] = &$this->dana;

		// biaya
		$this->biaya = new DbField('t_pelatihan', 't_pelatihan', 'x_biaya', 'biaya', '`biaya`', '`biaya`', 5, 22, -1, FALSE, '`biaya`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->biaya->Required = TRUE; // Required field
		$this->biaya->Sortable = TRUE; // Allow sort
		$this->biaya->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['biaya'] = &$this->biaya;

		// coachingprogr
		$this->coachingprogr = new DbField('t_pelatihan', 't_pelatihan', 'x_coachingprogr', 'coachingprogr', '`coachingprogr`', '`coachingprogr`', 200, 1, -1, FALSE, '`coachingprogr`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->coachingprogr->Required = TRUE; // Required field
		$this->coachingprogr->Sortable = TRUE; // Allow sort
		$this->coachingprogr->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->coachingprogr->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->coachingprogr->Lookup = new Lookup('coachingprogr', 't_pelatihan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->coachingprogr->OptionCount = 2;
		$this->fields['coachingprogr'] = &$this->coachingprogr;

		// area
		$this->area = new DbField('t_pelatihan', 't_pelatihan', 'x_area', 'area', '`area`', '`area`', 200, 100, -1, FALSE, '`area`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->area->Required = TRUE; // Required field
		$this->area->Sortable = TRUE; // Allow sort
		$this->fields['area'] = &$this->area;

		// periode_awal
		$this->periode_awal = new DbField('t_pelatihan', 't_pelatihan', 'x_periode_awal', 'periode_awal', '`periode_awal`', '`periode_awal`', 2, 4, -1, FALSE, '`periode_awal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->periode_awal->Required = TRUE; // Required field
		$this->periode_awal->Sortable = TRUE; // Allow sort
		$this->fields['periode_awal'] = &$this->periode_awal;

		// periode_akhir
		$this->periode_akhir = new DbField('t_pelatihan', 't_pelatihan', 'x_periode_akhir', 'periode_akhir', '`periode_akhir`', '`periode_akhir`', 2, 4, -1, FALSE, '`periode_akhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->periode_akhir->Required = TRUE; // Required field
		$this->periode_akhir->Sortable = TRUE; // Allow sort
		$this->periode_akhir->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['periode_akhir'] = &$this->periode_akhir;

		// tahapan
		$this->tahapan = new DbField('t_pelatihan', 't_pelatihan', 'x_tahapan', 'tahapan', '`tahapan`', '`tahapan`', 2, 3, -1, FALSE, '`tahapan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tahapan->Required = TRUE; // Required field
		$this->tahapan->Sortable = TRUE; // Allow sort
		$this->tahapan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tahapan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->tahapan->Lookup = new Lookup('tahapan', 't_tahapan', FALSE, 'kdtahapan', ["Tahapan","","",""], [], [], [], [], [], [], '', '');
		$this->fields['tahapan'] = &$this->tahapan;

		// namaberkas
		$this->namaberkas = new DbField('t_pelatihan', 't_pelatihan', 'x_namaberkas', 'namaberkas', '`namaberkas`', '`namaberkas`', 200, 255, -1, TRUE, '`namaberkas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->namaberkas->Sortable = TRUE; // Allow sort
		$this->fields['namaberkas'] = &$this->namaberkas;

		// instruktur
		$this->instruktur = new DbField('t_pelatihan', 't_pelatihan', 'x_instruktur', 'instruktur', 'kdpelat', 'kdpelat', 200, 20, -1, FALSE, 'kdpelat', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->instruktur->IsCustom = TRUE; // Custom field
		$this->instruktur->Sortable = TRUE; // Allow sort
		$this->fields['instruktur'] = &$this->instruktur;

		// nmou
		$this->nmou = new DbField('t_pelatihan', 't_pelatihan', 'x_nmou', 'nmou', '`nmou`', '`nmou`', 200, 255, -1, FALSE, '`nmou`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nmou->Sortable = TRUE; // Allow sort
		$this->fields['nmou'] = &$this->nmou;

		// nmou2
		$this->nmou2 = new DbField('t_pelatihan', 't_pelatihan', 'x_nmou2', 'nmou2', '`nmou2`', '`nmou2`', 200, 255, -1, FALSE, '`nmou2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nmou2->Sortable = TRUE; // Allow sort
		$this->fields['nmou2'] = &$this->nmou2;

		// statuspel
		$this->statuspel = new DbField('t_pelatihan', 't_pelatihan', 'x_statuspel', 'statuspel', '`statuspel`', '`statuspel`', 16, 2, -1, FALSE, '`statuspel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->statuspel->Required = TRUE; // Required field
		$this->statuspel->Sortable = TRUE; // Allow sort
		$this->statuspel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->statuspel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->statuspel->Lookup = new Lookup('statuspel', 't_pelatihan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->statuspel->OptionCount = 6;
		$this->statuspel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['statuspel'] = &$this->statuspel;

		// ket
		$this->ket = new DbField('t_pelatihan', 't_pelatihan', 'x_ket', 'ket', '`ket`', '`ket`', 201, 65535, -1, FALSE, '`ket`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ket->Sortable = TRUE; // Allow sort
		$this->fields['ket'] = &$this->ket;

		// tempat
		$this->tempat = new DbField('t_pelatihan', 't_pelatihan', 'x_tempat', 'tempat', '`tempat`', '`tempat`', 201, 65535, -1, FALSE, '`tempat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->tempat->Sortable = FALSE; // Allow sort
		$this->fields['tempat'] = &$this->tempat;

		// jpeserta
		$this->jpeserta = new DbField('t_pelatihan', 't_pelatihan', 'x_jpeserta', 'jpeserta', '(SELECT COUNT(1) FROM `t_pp` WHERE `t_pp`.`kdpelat` = `t_pelatihan`.`kdpelat`)', '(SELECT COUNT(1) FROM `t_pp` WHERE `t_pp`.`kdpelat` = `t_pelatihan`.`kdpelat`)', 20, 21, -1, FALSE, '(SELECT COUNT(1) FROM `t_pp` WHERE `t_pp`.`kdpelat` = `t_pelatihan`.`kdpelat`)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jpeserta->IsCustom = TRUE; // Custom field
		$this->jpeserta->Sortable = FALSE; // Allow sort
		$this->jpeserta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jpeserta'] = &$this->jpeserta;

		// jml_hari
		$this->jml_hari = new DbField('t_pelatihan', 't_pelatihan', 'x_jml_hari', 'jml_hari', '`jml_hari`', '`jml_hari`', 3, 3, -1, FALSE, '`jml_hari`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_hari->Sortable = TRUE; // Allow sort
		$this->jml_hari->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jml_hari'] = &$this->jml_hari;

		// targetpes
		$this->targetpes = new DbField('t_pelatihan', 't_pelatihan', 'x_targetpes', 'targetpes', '`targetpes`', '`targetpes`', 3, 3, -1, FALSE, '`targetpes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes->Sortable = FALSE; // Allow sort
		$this->targetpes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes'] = &$this->targetpes;

		// target_peserta
		$this->target_peserta = new DbField('t_pelatihan', 't_pelatihan', 'x_target_peserta', 'target_peserta', '`target_peserta`', '`target_peserta`', 201, 65535, -1, FALSE, '`target_peserta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->target_peserta->Sortable = TRUE; // Allow sort
		$this->fields['target_peserta'] = &$this->target_peserta;

		// durasi1
		$this->durasi1 = new DbField('t_pelatihan', 't_pelatihan', 'x_durasi1', 'durasi1', '`durasi1`', '`durasi1`', 200, 50, -1, FALSE, '`durasi1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->durasi1->Sortable = TRUE; // Allow sort
		$this->fields['durasi1'] = &$this->durasi1;

		// durasi2
		$this->durasi2 = new DbField('t_pelatihan', 't_pelatihan', 'x_durasi2', 'durasi2', '`durasi2`', '`durasi2`', 200, 50, -1, FALSE, '`durasi2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->durasi2->Sortable = TRUE; // Allow sort
		$this->fields['durasi2'] = &$this->durasi2;

		// rid
		$this->rid = new DbField('t_pelatihan', 't_pelatihan', 'x_rid', 'rid', '`rid`', '`rid`', 3, 11, -1, FALSE, '`rid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rid->Sortable = TRUE; // Allow sort
		$this->rid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rid'] = &$this->rid;

		// real_peserta
		$this->real_peserta = new DbField('t_pelatihan', 't_pelatihan', 'x_real_peserta', 'real_peserta', '`real_peserta`', '`real_peserta`', 3, 3, -1, FALSE, '`real_peserta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->real_peserta->Sortable = TRUE; // Allow sort
		$this->real_peserta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['real_peserta'] = &$this->real_peserta;

		// independen
		$this->independen = new DbField('t_pelatihan', 't_pelatihan', 'x_independen', 'independen', '`independen`', '`independen`', 3, 3, -1, FALSE, '`independen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->independen->Sortable = TRUE; // Allow sort
		$this->independen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['independen'] = &$this->independen;

		// swasta_k
		$this->swasta_k = new DbField('t_pelatihan', 't_pelatihan', 'x_swasta_k', 'swasta_k', '`swasta_k`', '`swasta_k`', 3, 3, -1, FALSE, '`swasta_k`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->swasta_k->Sortable = TRUE; // Allow sort
		$this->swasta_k->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['swasta_k'] = &$this->swasta_k;

		// swasta_m
		$this->swasta_m = new DbField('t_pelatihan', 't_pelatihan', 'x_swasta_m', 'swasta_m', '`swasta_m`', '`swasta_m`', 3, 3, -1, FALSE, '`swasta_m`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->swasta_m->Sortable = TRUE; // Allow sort
		$this->swasta_m->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['swasta_m'] = &$this->swasta_m;

		// swasta_b
		$this->swasta_b = new DbField('t_pelatihan', 't_pelatihan', 'x_swasta_b', 'swasta_b', '`swasta_b`', '`swasta_b`', 3, 3, -1, FALSE, '`swasta_b`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->swasta_b->Sortable = TRUE; // Allow sort
		$this->swasta_b->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['swasta_b'] = &$this->swasta_b;

		// bumn
		$this->bumn = new DbField('t_pelatihan', 't_pelatihan', 'x_bumn', 'bumn', '`bumn`', '`bumn`', 3, 3, -1, FALSE, '`bumn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bumn->Sortable = TRUE; // Allow sort
		$this->bumn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bumn'] = &$this->bumn;

		// koperasi
		$this->koperasi = new DbField('t_pelatihan', 't_pelatihan', 'x_koperasi', 'koperasi', '`koperasi`', '`koperasi`', 3, 3, -1, FALSE, '`koperasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->koperasi->Sortable = TRUE; // Allow sort
		$this->koperasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['koperasi'] = &$this->koperasi;

		// pns
		$this->pns = new DbField('t_pelatihan', 't_pelatihan', 'x_pns', 'pns', '`pns`', '`pns`', 3, 3, -1, FALSE, '`pns`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pns->Sortable = TRUE; // Allow sort
		$this->pns->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pns'] = &$this->pns;

		// pt_dosen
		$this->pt_dosen = new DbField('t_pelatihan', 't_pelatihan', 'x_pt_dosen', 'pt_dosen', '`pt_dosen`', '`pt_dosen`', 3, 3, -1, FALSE, '`pt_dosen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pt_dosen->Sortable = TRUE; // Allow sort
		$this->pt_dosen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pt_dosen'] = &$this->pt_dosen;

		// pt_mhs
		$this->pt_mhs = new DbField('t_pelatihan', 't_pelatihan', 'x_pt_mhs', 'pt_mhs', '`pt_mhs`', '`pt_mhs`', 3, 3, -1, FALSE, '`pt_mhs`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pt_mhs->Sortable = TRUE; // Allow sort
		$this->pt_mhs->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pt_mhs'] = &$this->pt_mhs;

		// jk_l
		$this->jk_l = new DbField('t_pelatihan', 't_pelatihan', 'x_jk_l', 'jk_l', '`jk_l`', '`jk_l`', 3, 3, -1, FALSE, '`jk_l`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jk_l->Sortable = TRUE; // Allow sort
		$this->jk_l->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jk_l'] = &$this->jk_l;

		// jk_p
		$this->jk_p = new DbField('t_pelatihan', 't_pelatihan', 'x_jk_p', 'jk_p', '`jk_p`', '`jk_p`', 3, 3, -1, FALSE, '`jk_p`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jk_p->Sortable = TRUE; // Allow sort
		$this->jk_p->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jk_p'] = &$this->jk_p;

		// usia_k45
		$this->usia_k45 = new DbField('t_pelatihan', 't_pelatihan', 'x_usia_k45', 'usia_k45', '`usia_k45`', '`usia_k45`', 3, 3, -1, FALSE, '`usia_k45`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->usia_k45->Sortable = TRUE; // Allow sort
		$this->usia_k45->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['usia_k45'] = &$this->usia_k45;

		// usia_b45
		$this->usia_b45 = new DbField('t_pelatihan', 't_pelatihan', 'x_usia_b45', 'usia_b45', '`usia_b45`', '`usia_b45`', 3, 3, -1, FALSE, '`usia_b45`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->usia_b45->Sortable = TRUE; // Allow sort
		$this->usia_b45->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['usia_b45'] = &$this->usia_b45;

		// produk
		$this->produk = new DbField('t_pelatihan', 't_pelatihan', 'x_produk', 'produk', '`produk`', '`produk`', 201, 65535, -1, FALSE, '`produk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->produk->Sortable = TRUE; // Allow sort
		$this->fields['produk'] = &$this->produk;

		// bbio
		$this->bbio = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio', 'bbio', '`bbio`', '`bbio`', 200, 255, -1, TRUE, '`bbio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bbio->Sortable = TRUE; // Allow sort
		$this->fields['bbio'] = &$this->bbio;

		// bbio2
		$this->bbio2 = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio2', 'bbio2', '`bbio2`', '`bbio2`', 200, 255, -1, TRUE, '`bbio2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bbio2->Sortable = TRUE; // Allow sort
		$this->fields['bbio2'] = &$this->bbio2;

		// bbio3
		$this->bbio3 = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio3', 'bbio3', '`bbio3`', '`bbio3`', 200, 255, -1, TRUE, '`bbio3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bbio3->Sortable = TRUE; // Allow sort
		$this->fields['bbio3'] = &$this->bbio3;

		// bbio4
		$this->bbio4 = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio4', 'bbio4', '`bbio4`', '`bbio4`', 200, 255, -1, TRUE, '`bbio4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bbio4->Sortable = TRUE; // Allow sort
		$this->fields['bbio4'] = &$this->bbio4;

		// bbio5
		$this->bbio5 = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio5', 'bbio5', '`bbio5`', '`bbio5`', 200, 255, -1, TRUE, '`bbio5`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bbio5->Sortable = TRUE; // Allow sort
		$this->fields['bbio5'] = &$this->bbio5;

		// Tahun
		$this->Tahun = new DbField('t_pelatihan', 't_pelatihan', 'x_Tahun', 'Tahun', '(YEAR(tawal))', '(YEAR(tawal))', 20, 4, -1, FALSE, '(YEAR(tawal))', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tahun->IsCustom = TRUE; // Custom field
		$this->Tahun->Sortable = TRUE; // Allow sort
		$this->Tahun->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Tahun'] = &$this->Tahun;
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
		if ($this->getCurrentMasterTable() == "t_judul") {
			if ($this->kdjudul->getSessionValue() != "")
				$masterFilter .= "`kdjudul`=" . QuotedValue($this->kdjudul->getSessionValue(), DATATYPE_STRING, "DB");
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
		if ($this->getCurrentMasterTable() == "t_judul") {
			if ($this->kdjudul->getSessionValue() != "")
				$detailFilter .= "`kdjudul`=" . QuotedValue($this->kdjudul->getSessionValue(), DATATYPE_STRING, "DB");
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
	public function sqlMasterFilter_t_judul()
	{
		return "`kdjudul`='@kdjudul@'";
	}

	// Detail filter
	public function sqlDetailFilter_t_judul()
	{
		return "`kdjudul`='@kdjudul@'";
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
		if ($this->getCurrentDetailTable() == "cv_historipeserta") {
			$detailUrl = $GLOBALS["cv_historipeserta"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_kdpelat=" . urlencode($this->kdpelat->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "cv_historiinstruktur") {
			$detailUrl = $GLOBALS["cv_historiinstruktur"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_kdpelat=" . urlencode($this->kdpelat->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "t_jadwalpel") {
			$detailUrl = $GLOBALS["t_jadwalpel"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_idpelat=" . urlencode($this->idpelat->CurrentValue);
			$detailUrl .= "&fk_kdjudul=" . urlencode($this->kdjudul->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_pelatihanlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_pelatihan`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, NULL AS `tglpel`, kdpelat AS `instruktur`, (SELECT COUNT(1) FROM `t_pp` WHERE `t_pp`.`kdpelat` = `t_pelatihan`.`kdpelat`) AS `jpeserta`, (YEAR(tawal)) AS `Tahun` FROM " . $this->getSqlFrom();
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
			"SELECT *, NULL AS `tglpel`, kdpelat AS `instruktur`, (SELECT COUNT(1) FROM `t_pp` WHERE `t_pp`.`kdpelat` = `t_pelatihan`.`kdpelat`) AS `jpeserta`, (YEAR(tawal)) AS `Tahun`, (SELECT `judul` FROM `t_judul` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`kdjudul` = `t_pelatihan`.`kdjudul` LIMIT 1) AS `EV__kdjudul` FROM `t_pelatihan`" .
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`tawal` ASC";
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

			// Get insert id if necessary
			$this->idpelat->setDbValue($conn->insert_ID());
			$rs['idpelat'] = $this->idpelat->DbValue;
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

		// Cascade Update detail table 'cv_historipeserta'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['kdpelat']) && $rsold['kdpelat'] != $rs['kdpelat'])) { // Update detail field 'kdpelat'
			$cascadeUpdate = TRUE;
			$rscascade['kdpelat'] = $rs['kdpelat'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["cv_historipeserta"]))
				$GLOBALS["cv_historipeserta"] = new cv_historipeserta();
			$rswrk = $GLOBALS["cv_historipeserta"]->loadRs("t_pp.kdpelat = " . QuotedValue($rsold['kdpelat'], DATATYPE_STRING, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'kdhistori';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["cv_historipeserta"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["cv_historipeserta"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["cv_historipeserta"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'cv_historiinstruktur'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['kdpelat']) && $rsold['kdpelat'] != $rs['kdpelat'])) { // Update detail field 'kdpelat'
			$cascadeUpdate = TRUE;
			$rscascade['kdpelat'] = $rs['kdpelat'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["cv_historiinstruktur"]))
				$GLOBALS["cv_historiinstruktur"] = new cv_historiinstruktur();
			$rswrk = $GLOBALS["cv_historiinstruktur"]->loadRs("t_instrukturpelatihan.kdpelat = " . QuotedValue($rsold['kdpelat'], DATATYPE_STRING, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'ipid';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["cv_historiinstruktur"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["cv_historiinstruktur"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["cv_historiinstruktur"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 't_jadwalpel'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['idpelat']) && $rsold['idpelat'] != $rs['idpelat'])) { // Update detail field 'idpelat'
			$cascadeUpdate = TRUE;
			$rscascade['idpelat'] = $rs['idpelat'];
		}
		if ($rsold && (isset($rs['kdjudul']) && $rsold['kdjudul'] != $rs['kdjudul'])) { // Update detail field 'kdjudul'
			$cascadeUpdate = TRUE;
			$rscascade['kdjudul'] = $rs['kdjudul'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["t_jadwalpel"]))
				$GLOBALS["t_jadwalpel"] = new t_jadwalpel();
			$rswrk = $GLOBALS["t_jadwalpel"]->loadRs("`idpelat` = " . QuotedValue($rsold['idpelat'], DATATYPE_NUMBER, 'DB') . " AND " . "`kdjudul` = " . QuotedValue($rsold['kdjudul'], DATATYPE_STRING, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'idjadwal';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["t_jadwalpel"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["t_jadwalpel"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["t_jadwalpel"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'idpelat';
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

		// Cascade delete detail table 'cv_historipeserta'
		if (!isset($GLOBALS["cv_historipeserta"]))
			$GLOBALS["cv_historipeserta"] = new cv_historipeserta();
		$rscascade = $GLOBALS["cv_historipeserta"]->loadRs("t_pp.kdpelat = " . QuotedValue($rs['kdpelat'], DATATYPE_STRING, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["cv_historipeserta"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["cv_historipeserta"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["cv_historipeserta"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'cv_historiinstruktur'
		if (!isset($GLOBALS["cv_historiinstruktur"]))
			$GLOBALS["cv_historiinstruktur"] = new cv_historiinstruktur();
		$rscascade = $GLOBALS["cv_historiinstruktur"]->loadRs("t_instrukturpelatihan.kdpelat = " . QuotedValue($rs['kdpelat'], DATATYPE_STRING, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["cv_historiinstruktur"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["cv_historiinstruktur"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["cv_historiinstruktur"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 't_jadwalpel'
		if (!isset($GLOBALS["t_jadwalpel"]))
			$GLOBALS["t_jadwalpel"] = new t_jadwalpel();
		$rscascade = $GLOBALS["t_jadwalpel"]->loadRs("`idpelat` = " . QuotedValue($rs['idpelat'], DATATYPE_NUMBER, "DB") . " AND " . "`kdjudul` = " . QuotedValue($rs['kdjudul'], DATATYPE_STRING, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["t_jadwalpel"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["t_jadwalpel"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["t_jadwalpel"]->Row_Deleted($dtlrow);
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
		$this->idpelat->DbValue = $row['idpelat'];
		$this->kdpelat->DbValue = $row['kdpelat'];
		$this->kdjudul->DbValue = $row['kdjudul'];
		$this->kdkursil->DbValue = $row['kdkursil'];
		$this->revisi->DbValue = $row['revisi'];
		$this->tgl_terbit->DbValue = $row['tgl_terbit'];
		$this->pilihan_iso->DbValue = $row['pilihan_iso'];
		$this->tawal->DbValue = $row['tawal'];
		$this->takhir->DbValue = $row['takhir'];
		$this->tglpel->DbValue = $row['tglpel'];
		$this->kdprop->DbValue = $row['kdprop'];
		$this->kdkota->DbValue = $row['kdkota'];
		$this->kdkec->DbValue = $row['kdkec'];
		$this->ketua->DbValue = $row['ketua'];
		$this->sekretaris->DbValue = $row['sekretaris'];
		$this->bendahara->DbValue = $row['bendahara'];
		$this->anggota2->DbValue = $row['anggota2'];
		$this->widyaiswara->DbValue = $row['widyaiswara'];
		$this->jenisevaluasi->DbValue = $row['jenisevaluasi'];
		$this->created_at->DbValue = $row['created_at'];
		$this->user_created_by->DbValue = $row['user_created_by'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->user_updated_by->DbValue = $row['user_updated_by'];
		$this->jenispel->DbValue = $row['jenispel'];
		$this->kdkategori->DbValue = $row['kdkategori'];
		$this->kerjasama->DbValue = $row['kerjasama'];
		$this->dana->DbValue = $row['dana'];
		$this->biaya->DbValue = $row['biaya'];
		$this->coachingprogr->DbValue = $row['coachingprogr'];
		$this->area->DbValue = $row['area'];
		$this->periode_awal->DbValue = $row['periode_awal'];
		$this->periode_akhir->DbValue = $row['periode_akhir'];
		$this->tahapan->DbValue = $row['tahapan'];
		$this->namaberkas->Upload->DbValue = $row['namaberkas'];
		$this->instruktur->DbValue = $row['instruktur'];
		$this->nmou->DbValue = $row['nmou'];
		$this->nmou2->DbValue = $row['nmou2'];
		$this->statuspel->DbValue = $row['statuspel'];
		$this->ket->DbValue = $row['ket'];
		$this->tempat->DbValue = $row['tempat'];
		$this->jpeserta->DbValue = $row['jpeserta'];
		$this->jml_hari->DbValue = $row['jml_hari'];
		$this->targetpes->DbValue = $row['targetpes'];
		$this->target_peserta->DbValue = $row['target_peserta'];
		$this->durasi1->DbValue = $row['durasi1'];
		$this->durasi2->DbValue = $row['durasi2'];
		$this->rid->DbValue = $row['rid'];
		$this->real_peserta->DbValue = $row['real_peserta'];
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
		$this->produk->DbValue = $row['produk'];
		$this->bbio->Upload->DbValue = $row['bbio'];
		$this->bbio2->Upload->DbValue = $row['bbio2'];
		$this->bbio3->Upload->DbValue = $row['bbio3'];
		$this->bbio4->Upload->DbValue = $row['bbio4'];
		$this->bbio5->Upload->DbValue = $row['bbio5'];
		$this->Tahun->DbValue = $row['Tahun'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['namaberkas']) ? [] : [$row['namaberkas']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->namaberkas->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->namaberkas->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['bbio']) ? [] : [$row['bbio']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bbio->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bbio->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['bbio2']) ? [] : [$row['bbio2']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bbio2->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bbio2->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['bbio3']) ? [] : [$row['bbio3']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bbio3->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bbio3->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['bbio4']) ? [] : [$row['bbio4']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bbio4->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bbio4->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['bbio5']) ? [] : [$row['bbio5']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bbio5->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bbio5->oldPhysicalUploadPath() . $oldFile);
		}
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
			return "t_pelatihanlist.php";
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
		if ($pageName == "t_pelatihanview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_pelatihanedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_pelatihanadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_pelatihanlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_pelatihanview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pelatihanview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_pelatihanadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_pelatihanadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_pelatihanedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pelatihanedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("t_pelatihanadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pelatihanadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_pelatihandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "t_judul" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_kdjudul=" . urlencode($this->kdjudul->CurrentValue);
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
		$this->kdkursil->setDbValue($rs->fields('kdkursil'));
		$this->revisi->setDbValue($rs->fields('revisi'));
		$this->tgl_terbit->setDbValue($rs->fields('tgl_terbit'));
		$this->pilihan_iso->setDbValue($rs->fields('pilihan_iso'));
		$this->tawal->setDbValue($rs->fields('tawal'));
		$this->takhir->setDbValue($rs->fields('takhir'));
		$this->tglpel->setDbValue($rs->fields('tglpel'));
		$this->kdprop->setDbValue($rs->fields('kdprop'));
		$this->kdkota->setDbValue($rs->fields('kdkota'));
		$this->kdkec->setDbValue($rs->fields('kdkec'));
		$this->ketua->setDbValue($rs->fields('ketua'));
		$this->sekretaris->setDbValue($rs->fields('sekretaris'));
		$this->bendahara->setDbValue($rs->fields('bendahara'));
		$this->anggota2->setDbValue($rs->fields('anggota2'));
		$this->widyaiswara->setDbValue($rs->fields('widyaiswara'));
		$this->jenisevaluasi->setDbValue($rs->fields('jenisevaluasi'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->user_created_by->setDbValue($rs->fields('user_created_by'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->user_updated_by->setDbValue($rs->fields('user_updated_by'));
		$this->jenispel->setDbValue($rs->fields('jenispel'));
		$this->kdkategori->setDbValue($rs->fields('kdkategori'));
		$this->kerjasama->setDbValue($rs->fields('kerjasama'));
		$this->dana->setDbValue($rs->fields('dana'));
		$this->biaya->setDbValue($rs->fields('biaya'));
		$this->coachingprogr->setDbValue($rs->fields('coachingprogr'));
		$this->area->setDbValue($rs->fields('area'));
		$this->periode_awal->setDbValue($rs->fields('periode_awal'));
		$this->periode_akhir->setDbValue($rs->fields('periode_akhir'));
		$this->tahapan->setDbValue($rs->fields('tahapan'));
		$this->namaberkas->Upload->DbValue = $rs->fields('namaberkas');
		$this->instruktur->setDbValue($rs->fields('instruktur'));
		$this->nmou->setDbValue($rs->fields('nmou'));
		$this->nmou2->setDbValue($rs->fields('nmou2'));
		$this->statuspel->setDbValue($rs->fields('statuspel'));
		$this->ket->setDbValue($rs->fields('ket'));
		$this->tempat->setDbValue($rs->fields('tempat'));
		$this->jpeserta->setDbValue($rs->fields('jpeserta'));
		$this->jml_hari->setDbValue($rs->fields('jml_hari'));
		$this->targetpes->setDbValue($rs->fields('targetpes'));
		$this->target_peserta->setDbValue($rs->fields('target_peserta'));
		$this->durasi1->setDbValue($rs->fields('durasi1'));
		$this->durasi2->setDbValue($rs->fields('durasi2'));
		$this->rid->setDbValue($rs->fields('rid'));
		$this->real_peserta->setDbValue($rs->fields('real_peserta'));
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
		$this->produk->setDbValue($rs->fields('produk'));
		$this->bbio->Upload->DbValue = $rs->fields('bbio');
		$this->bbio2->Upload->DbValue = $rs->fields('bbio2');
		$this->bbio3->Upload->DbValue = $rs->fields('bbio3');
		$this->bbio4->Upload->DbValue = $rs->fields('bbio4');
		$this->bbio5->Upload->DbValue = $rs->fields('bbio5');
		$this->Tahun->setDbValue($rs->fields('Tahun'));
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
		// kdkursil
		// revisi
		// tgl_terbit
		// pilihan_iso
		// tawal
		// takhir
		// tglpel
		// kdprop
		// kdkota
		// kdkec
		// ketua
		// sekretaris
		// bendahara
		// anggota2
		// widyaiswara
		// jenisevaluasi
		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jenispel
		// kdkategori
		// kerjasama
		// dana
		// biaya
		// coachingprogr
		// area
		// periode_awal
		// periode_akhir
		// tahapan
		// namaberkas
		// instruktur
		// nmou
		// nmou2
		// statuspel
		// ket
		// tempat
		// jpeserta
		// jml_hari
		// targetpes
		// target_peserta
		// durasi1
		// durasi2
		// rid
		// real_peserta
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
		// produk
		// bbio
		// bbio2
		// bbio3
		// bbio4
		// bbio5
		// Tahun
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

		// kdkursil
		$this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
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
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = FormatDateTime($rswrk->fields('df3'), 0);
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
		$this->revisi->ViewValue = $this->revisi->CurrentValue;
		$this->revisi->ViewCustomAttributes = "";

		// tgl_terbit
		$this->tgl_terbit->ViewValue = $this->tgl_terbit->CurrentValue;
		$this->tgl_terbit->ViewValue = FormatDateTime($this->tgl_terbit->ViewValue, 0);
		$this->tgl_terbit->ViewCustomAttributes = "";

		// pilihan_iso
		if (strval($this->pilihan_iso->CurrentValue) != "") {
			$this->pilihan_iso->ViewValue = $this->pilihan_iso->optionCaption($this->pilihan_iso->CurrentValue);
		} else {
			$this->pilihan_iso->ViewValue = NULL;
		}
		$this->pilihan_iso->ViewCustomAttributes = "";

		// tawal
		$this->tawal->ViewValue = $this->tawal->CurrentValue;
		$this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
		$this->tawal->ViewCustomAttributes = "";

		// takhir
		$this->takhir->ViewValue = $this->takhir->CurrentValue;
		$this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
		$this->takhir->ViewCustomAttributes = "";

		// tglpel
		$this->tglpel->ViewValue = $this->tglpel->CurrentValue;
		$this->tglpel->CellCssStyle .= "text-align: right;";
		$this->tglpel->ViewCustomAttributes = 'style=text-align:center';

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
		$this->ketua->ViewValue = $this->ketua->CurrentValue;
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

		// sekretaris
		$this->sekretaris->ViewValue = $this->sekretaris->CurrentValue;
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

		// bendahara
		$this->bendahara->ViewValue = $this->bendahara->CurrentValue;
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

		// anggota2
		$this->anggota2->ViewValue = $this->anggota2->CurrentValue;
		$curVal = strval($this->anggota2->CurrentValue);
		if ($curVal != "") {
			$this->anggota2->ViewValue = $this->anggota2->lookupCacheOption($curVal);
			if ($this->anggota2->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->anggota2->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->anggota2->ViewValue = $this->anggota2->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->anggota2->ViewValue = $this->anggota2->CurrentValue;
				}
			}
		} else {
			$this->anggota2->ViewValue = NULL;
		}
		$this->anggota2->ViewCustomAttributes = "";

		// widyaiswara
		$this->widyaiswara->ViewValue = $this->widyaiswara->CurrentValue;
		$curVal = strval($this->widyaiswara->CurrentValue);
		if ($curVal != "") {
			$this->widyaiswara->ViewValue = $this->widyaiswara->lookupCacheOption($curVal);
			if ($this->widyaiswara->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_peg`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->widyaiswara->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->widyaiswara->ViewValue = $this->widyaiswara->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->widyaiswara->ViewValue = $this->widyaiswara->CurrentValue;
				}
			}
		} else {
			$this->widyaiswara->ViewValue = NULL;
		}
		$this->widyaiswara->ViewCustomAttributes = "";

		// jenisevaluasi
		$this->jenisevaluasi->ViewValue = $this->jenisevaluasi->CurrentValue;
		$this->jenisevaluasi->ViewCustomAttributes = "";

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

		// dana
		if (strval($this->dana->CurrentValue) != "") {
			$this->dana->ViewValue = $this->dana->optionCaption($this->dana->CurrentValue);
		} else {
			$this->dana->ViewValue = NULL;
		}
		$this->dana->ViewCustomAttributes = "";

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

		// namaberkas
		if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
			$this->namaberkas->ViewValue = $this->namaberkas->Upload->DbValue;
		} else {
			$this->namaberkas->ViewValue = "";
		}
		$this->namaberkas->ViewCustomAttributes = "";

		// instruktur
		$this->instruktur->ViewValue = $this->instruktur->CurrentValue;
		$this->instruktur->ViewCustomAttributes = "";

		// nmou
		$this->nmou->ViewValue = $this->nmou->CurrentValue;
		$this->nmou->ViewCustomAttributes = "";

		// nmou2
		$this->nmou2->ViewValue = $this->nmou2->CurrentValue;
		$this->nmou2->ViewCustomAttributes = "";

		// statuspel
		if (strval($this->statuspel->CurrentValue) != "") {
			$this->statuspel->ViewValue = $this->statuspel->optionCaption($this->statuspel->CurrentValue);
		} else {
			$this->statuspel->ViewValue = NULL;
		}
		$this->statuspel->ViewCustomAttributes = "";

		// ket
		$this->ket->ViewValue = $this->ket->CurrentValue;
		$this->ket->ViewCustomAttributes = "";

		// tempat
		$this->tempat->ViewValue = $this->tempat->CurrentValue;
		$this->tempat->ViewCustomAttributes = "";

		// jpeserta
		$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
		$this->jpeserta->CellCssStyle .= "text-align: right;";
		$this->jpeserta->ViewCustomAttributes = "";

		// jml_hari
		$this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
		$this->jml_hari->ViewCustomAttributes = "";

		// targetpes
		$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
		$this->targetpes->CellCssStyle .= "text-align: right;";
		$this->targetpes->ViewCustomAttributes = "";

		// target_peserta
		$this->target_peserta->ViewValue = $this->target_peserta->CurrentValue;
		$this->target_peserta->ViewCustomAttributes = "";

		// durasi1
		$this->durasi1->ViewValue = $this->durasi1->CurrentValue;
		$this->durasi1->ViewCustomAttributes = "";

		// durasi2
		$this->durasi2->ViewValue = $this->durasi2->CurrentValue;
		$this->durasi2->ViewCustomAttributes = "";

		// rid
		$this->rid->ViewValue = $this->rid->CurrentValue;
		$this->rid->ViewCustomAttributes = "";

		// real_peserta
		$this->real_peserta->ViewValue = $this->real_peserta->CurrentValue;
		$this->real_peserta->ViewCustomAttributes = "";

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

		// produk
		$this->produk->ViewValue = $this->produk->CurrentValue;
		$this->produk->ViewCustomAttributes = "";

		// bbio
		if (!EmptyValue($this->bbio->Upload->DbValue)) {
			$this->bbio->ViewValue = $this->bbio->Upload->DbValue;
		} else {
			$this->bbio->ViewValue = "";
		}
		$this->bbio->ViewCustomAttributes = "";

		// bbio2
		if (!EmptyValue($this->bbio2->Upload->DbValue)) {
			$this->bbio2->ViewValue = $this->bbio2->Upload->DbValue;
		} else {
			$this->bbio2->ViewValue = "";
		}
		$this->bbio2->ViewCustomAttributes = "";

		// bbio3
		if (!EmptyValue($this->bbio3->Upload->DbValue)) {
			$this->bbio3->ViewValue = $this->bbio3->Upload->DbValue;
		} else {
			$this->bbio3->ViewValue = "";
		}
		$this->bbio3->ViewCustomAttributes = "";

		// bbio4
		if (!EmptyValue($this->bbio4->Upload->DbValue)) {
			$this->bbio4->ViewValue = $this->bbio4->Upload->DbValue;
		} else {
			$this->bbio4->ViewValue = "";
		}
		$this->bbio4->ViewCustomAttributes = "";

		// bbio5
		if (!EmptyValue($this->bbio5->Upload->DbValue)) {
			$this->bbio5->ViewValue = $this->bbio5->Upload->DbValue;
		} else {
			$this->bbio5->ViewValue = "";
		}
		$this->bbio5->ViewCustomAttributes = "";

		// Tahun
		$this->Tahun->ViewValue = $this->Tahun->CurrentValue;
		$this->Tahun->ViewCustomAttributes = "";

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

		// kdkursil
		$this->kdkursil->LinkCustomAttributes = "";
		$this->kdkursil->HrefValue = "";
		$this->kdkursil->TooltipValue = "";

		// revisi
		$this->revisi->LinkCustomAttributes = "";
		$this->revisi->HrefValue = "";
		$this->revisi->TooltipValue = "";

		// tgl_terbit
		$this->tgl_terbit->LinkCustomAttributes = "";
		$this->tgl_terbit->HrefValue = "";
		$this->tgl_terbit->TooltipValue = "";

		// pilihan_iso
		$this->pilihan_iso->LinkCustomAttributes = "";
		$this->pilihan_iso->HrefValue = "";
		$this->pilihan_iso->TooltipValue = "";

		// tawal
		$this->tawal->LinkCustomAttributes = "";
		$this->tawal->HrefValue = "";
		$this->tawal->TooltipValue = "";

		// takhir
		$this->takhir->LinkCustomAttributes = "";
		$this->takhir->HrefValue = "";
		$this->takhir->TooltipValue = "";

		// tglpel
		$this->tglpel->LinkCustomAttributes = "";
		$this->tglpel->HrefValue = "";
		$this->tglpel->TooltipValue = "";

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

		// sekretaris
		$this->sekretaris->LinkCustomAttributes = "";
		$this->sekretaris->HrefValue = "";
		$this->sekretaris->TooltipValue = "";

		// bendahara
		$this->bendahara->LinkCustomAttributes = "";
		$this->bendahara->HrefValue = "";
		$this->bendahara->TooltipValue = "";

		// anggota2
		$this->anggota2->LinkCustomAttributes = "";
		$this->anggota2->HrefValue = "";
		$this->anggota2->TooltipValue = "";

		// widyaiswara
		$this->widyaiswara->LinkCustomAttributes = "";
		$this->widyaiswara->HrefValue = "";
		$this->widyaiswara->TooltipValue = "";

		// jenisevaluasi
		$this->jenisevaluasi->LinkCustomAttributes = "";
		$this->jenisevaluasi->HrefValue = "";
		$this->jenisevaluasi->TooltipValue = "";

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

		// dana
		$this->dana->LinkCustomAttributes = "";
		$this->dana->HrefValue = "";
		$this->dana->TooltipValue = "";

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

		// namaberkas
		$this->namaberkas->LinkCustomAttributes = "";
		if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
			$this->namaberkas->HrefValue = GetFileUploadUrl($this->namaberkas, $this->namaberkas->htmlDecode($this->namaberkas->Upload->DbValue)); // Add prefix/suffix
			$this->namaberkas->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport())
				$this->namaberkas->HrefValue = FullUrl($this->namaberkas->HrefValue, "href");
		} else {
			$this->namaberkas->HrefValue = "";
		}
		$this->namaberkas->ExportHrefValue = $this->namaberkas->UploadPath . $this->namaberkas->Upload->DbValue;
		$this->namaberkas->TooltipValue = "";

		// instruktur
		$this->instruktur->LinkCustomAttributes = "";
		$this->instruktur->HrefValue = "";
		$this->instruktur->TooltipValue = "";

		// nmou
		$this->nmou->LinkCustomAttributes = "";
		$this->nmou->HrefValue = "";
		$this->nmou->TooltipValue = "";

		// nmou2
		$this->nmou2->LinkCustomAttributes = "";
		$this->nmou2->HrefValue = "";
		$this->nmou2->TooltipValue = "";

		// statuspel
		$this->statuspel->LinkCustomAttributes = "";
		$this->statuspel->HrefValue = "";
		$this->statuspel->TooltipValue = "";

		// ket
		$this->ket->LinkCustomAttributes = "";
		$this->ket->HrefValue = "";
		$this->ket->TooltipValue = "";

		// tempat
		$this->tempat->LinkCustomAttributes = "";
		$this->tempat->HrefValue = "";
		$this->tempat->TooltipValue = "";

		// jpeserta
		$this->jpeserta->LinkCustomAttributes = "";
		$this->jpeserta->HrefValue = "";
		$this->jpeserta->TooltipValue = "";

		// jml_hari
		$this->jml_hari->LinkCustomAttributes = "";
		$this->jml_hari->HrefValue = "";
		$this->jml_hari->TooltipValue = "";

		// targetpes
		$this->targetpes->LinkCustomAttributes = "";
		$this->targetpes->HrefValue = "";
		$this->targetpes->TooltipValue = "";

		// target_peserta
		$this->target_peserta->LinkCustomAttributes = "";
		$this->target_peserta->HrefValue = "";
		$this->target_peserta->TooltipValue = "";

		// durasi1
		$this->durasi1->LinkCustomAttributes = "";
		$this->durasi1->HrefValue = "";
		$this->durasi1->TooltipValue = "";

		// durasi2
		$this->durasi2->LinkCustomAttributes = "";
		$this->durasi2->HrefValue = "";
		$this->durasi2->TooltipValue = "";

		// rid
		$this->rid->LinkCustomAttributes = "";
		$this->rid->HrefValue = "";
		$this->rid->TooltipValue = "";

		// real_peserta
		$this->real_peserta->LinkCustomAttributes = "";
		$this->real_peserta->HrefValue = "";
		$this->real_peserta->TooltipValue = "";

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

		// produk
		$this->produk->LinkCustomAttributes = "";
		$this->produk->HrefValue = "";
		$this->produk->TooltipValue = "";

		// bbio
		$this->bbio->LinkCustomAttributes = "";
		if (!EmptyValue($this->bbio->Upload->DbValue)) {
			$this->bbio->HrefValue = GetFileUploadUrl($this->bbio, $this->bbio->htmlDecode($this->bbio->Upload->DbValue)); // Add prefix/suffix
			$this->bbio->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->bbio->HrefValue = FullUrl($this->bbio->HrefValue, "href");
		} else {
			$this->bbio->HrefValue = "";
		}
		$this->bbio->ExportHrefValue = $this->bbio->UploadPath . $this->bbio->Upload->DbValue;
		$this->bbio->TooltipValue = "";

		// bbio2
		$this->bbio2->LinkCustomAttributes = "";
		if (!EmptyValue($this->bbio2->Upload->DbValue)) {
			$this->bbio2->HrefValue = GetFileUploadUrl($this->bbio2, $this->bbio2->htmlDecode($this->bbio2->Upload->DbValue)); // Add prefix/suffix
			$this->bbio2->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->bbio2->HrefValue = FullUrl($this->bbio2->HrefValue, "href");
		} else {
			$this->bbio2->HrefValue = "";
		}
		$this->bbio2->ExportHrefValue = $this->bbio2->UploadPath . $this->bbio2->Upload->DbValue;
		$this->bbio2->TooltipValue = "";

		// bbio3
		$this->bbio3->LinkCustomAttributes = "";
		if (!EmptyValue($this->bbio3->Upload->DbValue)) {
			$this->bbio3->HrefValue = GetFileUploadUrl($this->bbio3, $this->bbio3->htmlDecode($this->bbio3->Upload->DbValue)); // Add prefix/suffix
			$this->bbio3->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->bbio3->HrefValue = FullUrl($this->bbio3->HrefValue, "href");
		} else {
			$this->bbio3->HrefValue = "";
		}
		$this->bbio3->ExportHrefValue = $this->bbio3->UploadPath . $this->bbio3->Upload->DbValue;
		$this->bbio3->TooltipValue = "";

		// bbio4
		$this->bbio4->LinkCustomAttributes = "";
		if (!EmptyValue($this->bbio4->Upload->DbValue)) {
			$this->bbio4->HrefValue = GetFileUploadUrl($this->bbio4, $this->bbio4->htmlDecode($this->bbio4->Upload->DbValue)); // Add prefix/suffix
			$this->bbio4->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->bbio4->HrefValue = FullUrl($this->bbio4->HrefValue, "href");
		} else {
			$this->bbio4->HrefValue = "";
		}
		$this->bbio4->ExportHrefValue = $this->bbio4->UploadPath . $this->bbio4->Upload->DbValue;
		$this->bbio4->TooltipValue = "";

		// bbio5
		$this->bbio5->LinkCustomAttributes = "";
		if (!EmptyValue($this->bbio5->Upload->DbValue)) {
			$this->bbio5->HrefValue = GetFileUploadUrl($this->bbio5, $this->bbio5->htmlDecode($this->bbio5->Upload->DbValue)); // Add prefix/suffix
			$this->bbio5->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->bbio5->HrefValue = FullUrl($this->bbio5->HrefValue, "href");
		} else {
			$this->bbio5->HrefValue = "";
		}
		$this->bbio5->ExportHrefValue = $this->bbio5->UploadPath . $this->bbio5->Upload->DbValue;
		$this->bbio5->TooltipValue = "";

		// Tahun
		$this->Tahun->LinkCustomAttributes = "";
		$this->Tahun->HrefValue = "";
		$this->Tahun->TooltipValue = "";

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

		// kdkursil
		$this->kdkursil->EditAttrs["class"] = "form-control";
		$this->kdkursil->EditCustomAttributes = "";
		if (!$this->kdkursil->Raw)
			$this->kdkursil->CurrentValue = HtmlDecode($this->kdkursil->CurrentValue);
		$this->kdkursil->EditValue = $this->kdkursil->CurrentValue;
		$this->kdkursil->PlaceHolder = RemoveHtml($this->kdkursil->caption());

		// revisi
		$this->revisi->EditAttrs["class"] = "form-control";
		$this->revisi->EditCustomAttributes = "";
		if (!$this->revisi->Raw)
			$this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
		$this->revisi->EditValue = $this->revisi->CurrentValue;
		$this->revisi->PlaceHolder = RemoveHtml($this->revisi->caption());

		// tgl_terbit
		$this->tgl_terbit->EditAttrs["class"] = "form-control";
		$this->tgl_terbit->EditCustomAttributes = "";
		$this->tgl_terbit->EditValue = FormatDateTime($this->tgl_terbit->CurrentValue, 8);
		$this->tgl_terbit->PlaceHolder = RemoveHtml($this->tgl_terbit->caption());

		// pilihan_iso
		$this->pilihan_iso->EditAttrs["class"] = "form-control";
		$this->pilihan_iso->EditCustomAttributes = "";
		$this->pilihan_iso->EditValue = $this->pilihan_iso->options(TRUE);

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

		// tglpel
		$this->tglpel->EditAttrs["class"] = "form-control";
		$this->tglpel->EditCustomAttributes = "";
		$this->tglpel->EditValue = $this->tglpel->CurrentValue;
		$this->tglpel->PlaceHolder = RemoveHtml($this->tglpel->caption());

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
		if (!$this->ketua->Raw)
			$this->ketua->CurrentValue = HtmlDecode($this->ketua->CurrentValue);
		$this->ketua->EditValue = $this->ketua->CurrentValue;
		$this->ketua->PlaceHolder = RemoveHtml($this->ketua->caption());

		// sekretaris
		$this->sekretaris->EditAttrs["class"] = "form-control";
		$this->sekretaris->EditCustomAttributes = "";
		if (!$this->sekretaris->Raw)
			$this->sekretaris->CurrentValue = HtmlDecode($this->sekretaris->CurrentValue);
		$this->sekretaris->EditValue = $this->sekretaris->CurrentValue;
		$this->sekretaris->PlaceHolder = RemoveHtml($this->sekretaris->caption());

		// bendahara
		$this->bendahara->EditAttrs["class"] = "form-control";
		$this->bendahara->EditCustomAttributes = "";
		if (!$this->bendahara->Raw)
			$this->bendahara->CurrentValue = HtmlDecode($this->bendahara->CurrentValue);
		$this->bendahara->EditValue = $this->bendahara->CurrentValue;
		$this->bendahara->PlaceHolder = RemoveHtml($this->bendahara->caption());

		// anggota2
		$this->anggota2->EditAttrs["class"] = "form-control";
		$this->anggota2->EditCustomAttributes = "";
		if (!$this->anggota2->Raw)
			$this->anggota2->CurrentValue = HtmlDecode($this->anggota2->CurrentValue);
		$this->anggota2->EditValue = $this->anggota2->CurrentValue;
		$this->anggota2->PlaceHolder = RemoveHtml($this->anggota2->caption());

		// widyaiswara
		$this->widyaiswara->EditAttrs["class"] = "form-control";
		$this->widyaiswara->EditCustomAttributes = "";
		$this->widyaiswara->EditValue = $this->widyaiswara->CurrentValue;
		$this->widyaiswara->PlaceHolder = RemoveHtml($this->widyaiswara->caption());

		// jenisevaluasi
		$this->jenisevaluasi->EditAttrs["class"] = "form-control";
		$this->jenisevaluasi->EditCustomAttributes = "";
		if (!$this->jenisevaluasi->Raw)
			$this->jenisevaluasi->CurrentValue = HtmlDecode($this->jenisevaluasi->CurrentValue);
		$this->jenisevaluasi->EditValue = $this->jenisevaluasi->CurrentValue;
		$this->jenisevaluasi->PlaceHolder = RemoveHtml($this->jenisevaluasi->caption());

		// created_at
		// user_created_by
		// updated_at
		// user_updated_by
		// jenispel

		$this->jenispel->EditAttrs["class"] = "form-control";
		$this->jenispel->EditCustomAttributes = "";
		if (strval($this->jenispel->CurrentValue) != "") {
			$this->jenispel->EditValue = $this->jenispel->optionCaption($this->jenispel->CurrentValue);
		} else {
			$this->jenispel->EditValue = NULL;
		}
		$this->jenispel->ViewCustomAttributes = "";

		// kdkategori
		$this->kdkategori->EditAttrs["class"] = "form-control";
		$this->kdkategori->EditCustomAttributes = "";

		// kerjasama
		$this->kerjasama->EditAttrs["class"] = "form-control";
		$this->kerjasama->EditCustomAttributes = "";
		$this->kerjasama->EditValue = $this->kerjasama->CurrentValue;
		$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

		// dana
		$this->dana->EditAttrs["class"] = "form-control";
		$this->dana->EditCustomAttributes = "";
		$this->dana->EditValue = $this->dana->options(TRUE);

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

		// namaberkas
		$this->namaberkas->EditAttrs["class"] = "form-control";
		$this->namaberkas->EditCustomAttributes = "";
		if (!EmptyValue($this->namaberkas->Upload->DbValue)) {
			$this->namaberkas->EditValue = $this->namaberkas->Upload->DbValue;
		} else {
			$this->namaberkas->EditValue = "";
		}
		if (!EmptyValue($this->namaberkas->CurrentValue))
				$this->namaberkas->Upload->FileName = $this->namaberkas->CurrentValue;

		// instruktur
		$this->instruktur->EditAttrs["class"] = "form-control";
		$this->instruktur->EditCustomAttributes = "";
		if (!$this->instruktur->Raw)
			$this->instruktur->CurrentValue = HtmlDecode($this->instruktur->CurrentValue);
		$this->instruktur->EditValue = $this->instruktur->CurrentValue;
		$this->instruktur->PlaceHolder = RemoveHtml($this->instruktur->caption());

		// nmou
		$this->nmou->EditAttrs["class"] = "form-control";
		$this->nmou->EditCustomAttributes = "";
		if (!$this->nmou->Raw)
			$this->nmou->CurrentValue = HtmlDecode($this->nmou->CurrentValue);
		$this->nmou->EditValue = $this->nmou->CurrentValue;
		$this->nmou->PlaceHolder = RemoveHtml($this->nmou->caption());

		// nmou2
		$this->nmou2->EditAttrs["class"] = "form-control";
		$this->nmou2->EditCustomAttributes = "";
		if (!$this->nmou2->Raw)
			$this->nmou2->CurrentValue = HtmlDecode($this->nmou2->CurrentValue);
		$this->nmou2->EditValue = $this->nmou2->CurrentValue;
		$this->nmou2->PlaceHolder = RemoveHtml($this->nmou2->caption());

		// statuspel
		$this->statuspel->EditAttrs["class"] = "form-control";
		$this->statuspel->EditCustomAttributes = "";
		$this->statuspel->EditValue = $this->statuspel->options(TRUE);

		// ket
		$this->ket->EditAttrs["class"] = "form-control";
		$this->ket->EditCustomAttributes = "";
		$this->ket->EditValue = $this->ket->CurrentValue;
		$this->ket->PlaceHolder = RemoveHtml($this->ket->caption());

		// tempat
		$this->tempat->EditAttrs["class"] = "form-control";
		$this->tempat->EditCustomAttributes = "";
		$this->tempat->EditValue = $this->tempat->CurrentValue;
		$this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

		// jpeserta
		$this->jpeserta->EditAttrs["class"] = "form-control";
		$this->jpeserta->EditCustomAttributes = "";
		$this->jpeserta->EditValue = $this->jpeserta->CurrentValue;
		$this->jpeserta->PlaceHolder = RemoveHtml($this->jpeserta->caption());

		// jml_hari
		$this->jml_hari->EditAttrs["class"] = "form-control";
		$this->jml_hari->EditCustomAttributes = "";
		$this->jml_hari->EditValue = $this->jml_hari->CurrentValue;
		$this->jml_hari->PlaceHolder = RemoveHtml($this->jml_hari->caption());

		// targetpes
		$this->targetpes->EditAttrs["class"] = "form-control";
		$this->targetpes->EditCustomAttributes = "";
		$this->targetpes->EditValue = $this->targetpes->CurrentValue;
		$this->targetpes->PlaceHolder = RemoveHtml($this->targetpes->caption());

		// target_peserta
		$this->target_peserta->EditAttrs["class"] = "form-control";
		$this->target_peserta->EditCustomAttributes = "";
		$this->target_peserta->EditValue = $this->target_peserta->CurrentValue;
		$this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

		// durasi1
		$this->durasi1->EditAttrs["class"] = "form-control";
		$this->durasi1->EditCustomAttributes = "";
		if (!$this->durasi1->Raw)
			$this->durasi1->CurrentValue = HtmlDecode($this->durasi1->CurrentValue);
		$this->durasi1->EditValue = $this->durasi1->CurrentValue;
		$this->durasi1->PlaceHolder = RemoveHtml($this->durasi1->caption());

		// durasi2
		$this->durasi2->EditAttrs["class"] = "form-control";
		$this->durasi2->EditCustomAttributes = "";
		if (!$this->durasi2->Raw)
			$this->durasi2->CurrentValue = HtmlDecode($this->durasi2->CurrentValue);
		$this->durasi2->EditValue = $this->durasi2->CurrentValue;
		$this->durasi2->PlaceHolder = RemoveHtml($this->durasi2->caption());

		// rid
		$this->rid->EditAttrs["class"] = "form-control";
		$this->rid->EditCustomAttributes = "";
		$this->rid->EditValue = $this->rid->CurrentValue;
		$this->rid->PlaceHolder = RemoveHtml($this->rid->caption());

		// real_peserta
		$this->real_peserta->EditAttrs["class"] = "form-control";
		$this->real_peserta->EditCustomAttributes = "";
		$this->real_peserta->EditValue = $this->real_peserta->CurrentValue;
		$this->real_peserta->PlaceHolder = RemoveHtml($this->real_peserta->caption());

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

		// produk
		$this->produk->EditAttrs["class"] = "form-control";
		$this->produk->EditCustomAttributes = "maxlength='300'";
		$this->produk->EditValue = $this->produk->CurrentValue;
		$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

		// bbio
		$this->bbio->EditAttrs["class"] = "form-control";
		$this->bbio->EditCustomAttributes = "";
		if (!EmptyValue($this->bbio->Upload->DbValue)) {
			$this->bbio->EditValue = $this->bbio->Upload->DbValue;
		} else {
			$this->bbio->EditValue = "";
		}
		if (!EmptyValue($this->bbio->CurrentValue))
				$this->bbio->Upload->FileName = $this->bbio->CurrentValue;

		// bbio2
		$this->bbio2->EditAttrs["class"] = "form-control";
		$this->bbio2->EditCustomAttributes = "";
		if (!EmptyValue($this->bbio2->Upload->DbValue)) {
			$this->bbio2->EditValue = $this->bbio2->Upload->DbValue;
		} else {
			$this->bbio2->EditValue = "";
		}
		if (!EmptyValue($this->bbio2->CurrentValue))
				$this->bbio2->Upload->FileName = $this->bbio2->CurrentValue;

		// bbio3
		$this->bbio3->EditAttrs["class"] = "form-control";
		$this->bbio3->EditCustomAttributes = "";
		if (!EmptyValue($this->bbio3->Upload->DbValue)) {
			$this->bbio3->EditValue = $this->bbio3->Upload->DbValue;
		} else {
			$this->bbio3->EditValue = "";
		}
		if (!EmptyValue($this->bbio3->CurrentValue))
				$this->bbio3->Upload->FileName = $this->bbio3->CurrentValue;

		// bbio4
		$this->bbio4->EditAttrs["class"] = "form-control";
		$this->bbio4->EditCustomAttributes = "";
		if (!EmptyValue($this->bbio4->Upload->DbValue)) {
			$this->bbio4->EditValue = $this->bbio4->Upload->DbValue;
		} else {
			$this->bbio4->EditValue = "";
		}
		if (!EmptyValue($this->bbio4->CurrentValue))
				$this->bbio4->Upload->FileName = $this->bbio4->CurrentValue;

		// bbio5
		$this->bbio5->EditAttrs["class"] = "form-control";
		$this->bbio5->EditCustomAttributes = "";
		if (!EmptyValue($this->bbio5->Upload->DbValue)) {
			$this->bbio5->EditValue = $this->bbio5->Upload->DbValue;
		} else {
			$this->bbio5->EditValue = "";
		}
		if (!EmptyValue($this->bbio5->CurrentValue))
				$this->bbio5->Upload->FileName = $this->bbio5->CurrentValue;

		// Tahun
		$this->Tahun->EditAttrs["class"] = "form-control";
		$this->Tahun->EditCustomAttributes = "";
		$this->Tahun->EditValue = $this->Tahun->CurrentValue;
		$this->Tahun->PlaceHolder = RemoveHtml($this->Tahun->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->jpeserta->CurrentValue))
				$this->jpeserta->Total += $this->jpeserta->CurrentValue; // Accumulate total
			if (is_numeric($this->targetpes->CurrentValue))
				$this->targetpes->Total += $this->targetpes->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->jpeserta->CurrentValue = $this->jpeserta->Total;
			$this->jpeserta->ViewValue = $this->jpeserta->CurrentValue;
			$this->jpeserta->CellCssStyle .= "text-align: right;";
			$this->jpeserta->ViewCustomAttributes = "";
			$this->jpeserta->HrefValue = ""; // Clear href value
			$this->targetpes->CurrentValue = $this->targetpes->Total;
			$this->targetpes->ViewValue = $this->targetpes->CurrentValue;
			$this->targetpes->CellCssStyle .= "text-align: right;";
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
					$doc->exportCaption($this->idpelat);
					$doc->exportCaption($this->kdpelat);
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->tgl_terbit);
					$doc->exportCaption($this->pilihan_iso);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdkec);
					$doc->exportCaption($this->ketua);
					$doc->exportCaption($this->sekretaris);
					$doc->exportCaption($this->bendahara);
					$doc->exportCaption($this->anggota2);
					$doc->exportCaption($this->widyaiswara);
					$doc->exportCaption($this->jenisevaluasi);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->biaya);
					$doc->exportCaption($this->coachingprogr);
					$doc->exportCaption($this->area);
					$doc->exportCaption($this->periode_awal);
					$doc->exportCaption($this->periode_akhir);
					$doc->exportCaption($this->tahapan);
					$doc->exportCaption($this->namaberkas);
					$doc->exportCaption($this->instruktur);
					$doc->exportCaption($this->statuspel);
					$doc->exportCaption($this->ket);
					$doc->exportCaption($this->jpeserta);
					$doc->exportCaption($this->real_peserta);
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
					$doc->exportCaption($this->produk);
					$doc->exportCaption($this->bbio);
					$doc->exportCaption($this->bbio2);
					$doc->exportCaption($this->bbio3);
					$doc->exportCaption($this->bbio4);
					$doc->exportCaption($this->bbio5);
				} else {
					$doc->exportCaption($this->kdjudul);
					$doc->exportCaption($this->kdkursil);
					$doc->exportCaption($this->revisi);
					$doc->exportCaption($this->tgl_terbit);
					$doc->exportCaption($this->pilihan_iso);
					$doc->exportCaption($this->tawal);
					$doc->exportCaption($this->takhir);
					$doc->exportCaption($this->kdprop);
					$doc->exportCaption($this->kdkota);
					$doc->exportCaption($this->kdkec);
					$doc->exportCaption($this->ketua);
					$doc->exportCaption($this->sekretaris);
					$doc->exportCaption($this->bendahara);
					$doc->exportCaption($this->anggota2);
					$doc->exportCaption($this->widyaiswara);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->biaya);
					$doc->exportCaption($this->coachingprogr);
					$doc->exportCaption($this->area);
					$doc->exportCaption($this->periode_awal);
					$doc->exportCaption($this->periode_akhir);
					$doc->exportCaption($this->tahapan);
					$doc->exportCaption($this->instruktur);
					$doc->exportCaption($this->jpeserta);
					$doc->exportCaption($this->Tahun);
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
						$doc->exportField($this->idpelat);
						$doc->exportField($this->kdpelat);
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->revisi);
						$doc->exportField($this->tgl_terbit);
						$doc->exportField($this->pilihan_iso);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdkec);
						$doc->exportField($this->ketua);
						$doc->exportField($this->sekretaris);
						$doc->exportField($this->bendahara);
						$doc->exportField($this->anggota2);
						$doc->exportField($this->widyaiswara);
						$doc->exportField($this->jenisevaluasi);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->biaya);
						$doc->exportField($this->coachingprogr);
						$doc->exportField($this->area);
						$doc->exportField($this->periode_awal);
						$doc->exportField($this->periode_akhir);
						$doc->exportField($this->tahapan);
						$doc->exportField($this->namaberkas);
						$doc->exportField($this->instruktur);
						$doc->exportField($this->statuspel);
						$doc->exportField($this->ket);
						$doc->exportField($this->jpeserta);
						$doc->exportField($this->real_peserta);
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
						$doc->exportField($this->produk);
						$doc->exportField($this->bbio);
						$doc->exportField($this->bbio2);
						$doc->exportField($this->bbio3);
						$doc->exportField($this->bbio4);
						$doc->exportField($this->bbio5);
					} else {
						$doc->exportField($this->kdjudul);
						$doc->exportField($this->kdkursil);
						$doc->exportField($this->revisi);
						$doc->exportField($this->tgl_terbit);
						$doc->exportField($this->pilihan_iso);
						$doc->exportField($this->tawal);
						$doc->exportField($this->takhir);
						$doc->exportField($this->kdprop);
						$doc->exportField($this->kdkota);
						$doc->exportField($this->kdkec);
						$doc->exportField($this->ketua);
						$doc->exportField($this->sekretaris);
						$doc->exportField($this->bendahara);
						$doc->exportField($this->anggota2);
						$doc->exportField($this->widyaiswara);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->biaya);
						$doc->exportField($this->coachingprogr);
						$doc->exportField($this->area);
						$doc->exportField($this->periode_awal);
						$doc->exportField($this->periode_akhir);
						$doc->exportField($this->tahapan);
						$doc->exportField($this->instruktur);
						$doc->exportField($this->jpeserta);
						$doc->exportField($this->Tahun);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
//				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->kdjudul, '');
				$doc->exportAggregate($this->kdkursil, '');
				$doc->exportAggregate($this->revisi, '');
				$doc->exportAggregate($this->tgl_terbit, '');
				$doc->exportAggregate($this->pilihan_iso, '');
				$doc->exportAggregate($this->tawal, '');
				$doc->exportAggregate($this->takhir, '');
				$doc->exportAggregate($this->kdprop, '');
				$doc->exportAggregate($this->kdkota, '');
				$doc->exportAggregate($this->kdkec, '');
				$doc->exportAggregate($this->ketua, '');
				$doc->exportAggregate($this->sekretaris, '');
				$doc->exportAggregate($this->bendahara, '');
				$doc->exportAggregate($this->anggota2, '');
				$doc->exportAggregate($this->widyaiswara, '');
				$doc->exportAggregate($this->jenispel, '');
				$doc->exportAggregate($this->kdkategori, '');
				$doc->exportAggregate($this->kerjasama, '');
				$doc->exportAggregate($this->biaya, '');
				$doc->exportAggregate($this->coachingprogr, '');
				$doc->exportAggregate($this->area, '');
				$doc->exportAggregate($this->periode_awal, '');
				$doc->exportAggregate($this->periode_akhir, '');
				$doc->exportAggregate($this->tahapan, '');
				$doc->exportAggregate($this->instruktur, '');
				$doc->exportAggregate($this->jpeserta, 'TOTAL');
				$doc->exportAggregate($this->Tahun, '');
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
		if ($fldparm == 'namaberkas') {
			$fldName = "namaberkas";
			$fileNameFld = "namaberkas";
		} elseif ($fldparm == 'bbio') {
			$fldName = "bbio";
			$fileNameFld = "bbio";
		} elseif ($fldparm == 'bbio2') {
			$fldName = "bbio2";
			$fileNameFld = "bbio2";
		} elseif ($fldparm == 'bbio3') {
			$fldName = "bbio3";
			$fileNameFld = "bbio3";
		} elseif ($fldparm == 'bbio4') {
			$fldName = "bbio4";
			$fileNameFld = "bbio4";
		} elseif ($fldparm == 'bbio5') {
			$fldName = "bbio5";
			$fileNameFld = "bbio5";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->idpelat->CurrentValue = $ar[0];
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 't_pelatihan';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_pelatihan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['idpelat'];

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
		$table = 't_pelatihan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['idpelat'];

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
		$table = 't_pelatihan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['idpelat'];

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
		if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){
			if(isset($_GET["th"]) && !empty($_GET["th"])){
				$panitia = "YEAR(tawal) = ".$_GET["th"]." AND (ketua = ".$_GET["pegid"]." OR sekretaris = ".$_GET["pegid"]." OR bendahara = ".$_GET["pegid"].")";
			} else {
				$panitia = "ketua = ".$_GET["pegid"]." OR sekretaris = ".$_GET["pegid"]." OR bendahara = ".$_GET["pegid"]."";
			} 
			AddFilter($filter, $panitia);
		} 
		if(@$_GET["h"] == "rpt"){
			if($_GET["bulan"] == $_GET["bulan2"]){
				$caribulan = " AND month(tawal) = '".$_GET["bulan"]."'";
			} else {
				$caribulan = " AND (month(tawal) >= ".$_GET["bulan"]." AND month(tawal) <= ".$_GET["bulan2"].")";
			}
			AddFilter($filter, "YEAR(tawal) = ".$_GET["tahun"].$caribulan." AND statuspel IN (5,6)");
		}
		AddFilter($filter, "statuspel != 5"); // status batal tidak tampil
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		if(!isset($_GET["pegid"])){ 
			if($this->Tahun->AdvancedSearch->SearchValue == "")
			$this->Tahun->AdvancedSearch->SearchValue = date("Y"); // Search value
		}
	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
		$this->_SqlOrderBy = '`tawal` ASC, `takhir` ASC';
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

		$kdpelat = $rsnew["kdjudul"];
		$kdpelat .= "L"; // perbaikan kode D dan L 
		$kdpelat .= $rsnew["tawal"];
		$pelatarray = array(1 => 'A', 'B', 'C', 'D');
		$arraykey = 0;
		do {
			$arraykey++;
			$newkdpelat = $kdpelat . $pelatarray[$arraykey];
			$checknewpelat = ExecuteScalar("SELECT COUNT(1) FROM t_pelatihan WHERE kdpelat = '".$newkdpelat."'");
			$numpelat = $checknewpelat;
		} while($numpelat > 0);
		$kdpelat = $newkdpelat;
		$rsnew["kdpelat"] = $kdpelat;

		//$this->setWarningMessage($kdpelat);
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
		$hinst = ExecuteScalar("SELECT COUNT(1) FROM `t_instrukturpelatihan` WHERE `kdpelat` = '".$this->kdpelat->CurrentValue."'");
		if($hinst > 0){
			$my_sql = mysql_query("SELECT b.bioid,b.nama FROM `t_instrukturpelatihan` a INNER JOIN `t_biointruktur` b ON a.bioid = b.bioid WHERE a.kdpelat = '".$this->kdpelat->CurrentValue."'");
			$no = 1;
			$this->instruktur->CurrentValue = "";
			while($rd = mysql_fetch_array($my_sql)){
				$this->instruktur->CurrentValue .= $no.". ".$rd["nama"]."<br>";
				$no++;
			}
		} else {
			$this->instruktur->CurrentValue = "";
		}
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

		if(strtotime($this->tawal->CurrentValue) == strtotime($this->takhir->CurrentValue)){
			$tgl = $this->tawal->ViewValue;
		} else {
			$bln_tawal = date("n",strtotime($this->tawal->CurrentValue));
			$bln_takhir = date("n",strtotime($this->takhir->CurrentValue));
			if($bln_tawal == $bln_takhir){
				$tgl = date("j",strtotime($this->tawal->CurrentValue)) . "-" . CSFormatTanggal(date("j-m-Y",strtotime($this->takhir->CurrentValue)), false, false, false);
			} else { // bulan berbeda
				$tgl = CSFormatTanggal(date("j-m-Y",strtotime($this->tawal->CurrentValue)), false, false, true, true) . " - " . CSFormatTanggal(date("j-m-Y",strtotime($this->takhir->CurrentValue)), false, false, true, true);
			}
		}
		$this->tglpel->ViewValue = $tgl;
		if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){
			if($this->ketua->CurrentValue == $_GET["pegid"]){
				$this->ketua->ViewValue = "Ketua";
			} else if($this->sekretaris->CurrentValue == $_GET["pegid"]){
				$this->ketua->ViewValue = "Sekretaris";
			} else if($this->bendahara->CurrentValue == $_GET["pegid"]){
				$this->ketua->ViewValue = "Bendahara";
			}
		}
		if($this->getCurrentMasterTable() == "t_rpdiklat"){ // jd detail table
		} else {
			$this->biaya->ViewValue = CSFormatRupiah($this->biaya->ViewValue);
		}

		//$jp = ExecuteScalar("SELECT COUNT(1) FROM `t_pp` WHERE `t_pp`.`kdpelat` = '".$this->kdpelat->CurrentValue."'");
		//$this->jpeserta->ViewValue = $jp;

		if (CurrentPage()->PageID == "list" ){
			if($this->targetpes->CurrentValue < 1 && $this->jenispel->CurrentValue == 1){
				$datarencana = ExecuteScalar("SELECT targetpes FROM `t_rpdiklat` WHERE rpdid = ".$this->rid->CurrentValue);

				//$this->targetpes->ViewValue = $datarencana;
				if($datarencana>0)
				Execute("UPDATE t_pelatihan SET targetpes=".$datarencana." WHERE idpelat = ".$this->idpelat->CurrentValue);
			}
		} else {
			$this->jpeserta->Visible = (CurrentPage()->RowType <> ROWTYPE_SEARCH);
			$this->tglpel->ViewValue = 11;
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>