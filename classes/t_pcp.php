<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_pcp
 */
class t_pcp extends DbTable
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
	public $rkid;
	public $nama_peserta;
	public $email_add;
	public $handphone;
	public $namap;
	public $tahun_berdiri;
	public $alamat;
	public $alamat_prod;
	public $kategori_produk;
	public $kategori_produk2;
	public $kategori_produk3;
	public $produk;
	public $merek_dagang;
	public $jenis_perusahaan;
	public $kapasitas_produksi;
	public $omset;
	public $website;
	public $fb;
	public $ig;
	public $sosmed_lain;
	public $jml_pegawai;
	public $jml_pegawai2;
	public $jml_pegawai_tidaktetap;
	public $legalitas;
	public $legalitas_lain;
	public $f_npwp;
	public $f_nib;
	public $f_siup;
	public $f_tdp;
	public $f_lain;
	public $sertifikat;
	public $sertifikat_lain;
	public $f_sertifikat;
	public $alat_promosi;
	public $promosi_lain;
	public $f_kartunama;
	public $f_brosur;
	public $f_katalog;
	public $f_profile;
	public $tahun_ecp;
	public $wilayah_ecp;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_pcp';
		$this->TableName = 't_pcp';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_pcp`";
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
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('t_pcp', 't_pcp', 'x_id', 'id', '`id`', '`id`', 3, 10, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->IsForeignKey = TRUE; // Foreign key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// rkid
		$this->rkid = new DbField('t_pcp', 't_pcp', 'x_rkid', 'rkid', '`rkid`', '`rkid`', 3, 10, -1, FALSE, '`rkid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rkid->IsForeignKey = TRUE; // Foreign key field
		$this->rkid->Nullable = FALSE; // NOT NULL field
		$this->rkid->Required = TRUE; // Required field
		$this->rkid->Sortable = TRUE; // Allow sort
		$this->rkid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rkid'] = &$this->rkid;

		// nama_peserta
		$this->nama_peserta = new DbField('t_pcp', 't_pcp', 'x_nama_peserta', 'nama_peserta', '`nama_peserta`', '`nama_peserta`', 200, 100, -1, FALSE, '`nama_peserta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_peserta->Nullable = FALSE; // NOT NULL field
		$this->nama_peserta->Required = TRUE; // Required field
		$this->nama_peserta->Sortable = TRUE; // Allow sort
		$this->fields['nama_peserta'] = &$this->nama_peserta;

		// email_add
		$this->email_add = new DbField('t_pcp', 't_pcp', 'x_email_add', 'email_add', '`email_add`', '`email_add`', 200, 100, -1, FALSE, '`email_add`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->email_add->Sortable = TRUE; // Allow sort
		$this->fields['email_add'] = &$this->email_add;

		// handphone
		$this->handphone = new DbField('t_pcp', 't_pcp', 'x_handphone', 'handphone', '`handphone`', '`handphone`', 200, 50, -1, FALSE, '`handphone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->handphone->Sortable = TRUE; // Allow sort
		$this->fields['handphone'] = &$this->handphone;

		// namap
		$this->namap = new DbField('t_pcp', 't_pcp', 'x_namap', 'namap', '`namap`', '`namap`', 200, 150, -1, FALSE, '`namap`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->namap->Required = TRUE; // Required field
		$this->namap->Sortable = TRUE; // Allow sort
		$this->namap->Lookup = new Lookup('namap', 't_pcp', FALSE, 'namap', ["namap","","",""], [], [], [], [], [], [], '`namap` ASC', '');
		$this->fields['namap'] = &$this->namap;

		// tahun_berdiri
		$this->tahun_berdiri = new DbField('t_pcp', 't_pcp', 'x_tahun_berdiri', 'tahun_berdiri', '`tahun_berdiri`', '`tahun_berdiri`', 2, 4, -1, FALSE, '`tahun_berdiri`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tahun_berdiri->Sortable = TRUE; // Allow sort
		$this->tahun_berdiri->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tahun_berdiri'] = &$this->tahun_berdiri;

		// alamat
		$this->alamat = new DbField('t_pcp', 't_pcp', 'x_alamat', 'alamat', '`alamat`', '`alamat`', 201, 65535, -1, FALSE, '`alamat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamat->Sortable = TRUE; // Allow sort
		$this->fields['alamat'] = &$this->alamat;

		// alamat_prod
		$this->alamat_prod = new DbField('t_pcp', 't_pcp', 'x_alamat_prod', 'alamat_prod', '`alamat_prod`', '`alamat_prod`', 201, 65535, -1, FALSE, '`alamat_prod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamat_prod->Sortable = TRUE; // Allow sort
		$this->fields['alamat_prod'] = &$this->alamat_prod;

		// kategori_produk
		$this->kategori_produk = new DbField('t_pcp', 't_pcp', 'x_kategori_produk', 'kategori_produk', '`kategori_produk`', '`kategori_produk`', 200, 100, -1, FALSE, '`kategori_produk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kategori_produk->Sortable = TRUE; // Allow sort
		$this->kategori_produk->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kategori_produk->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kategori_produk->Lookup = new Lookup('kategori_produk', 't_kat_produk', FALSE, 'Kategori_Produk', ["Kategori_Produk","","",""], [], [], [], [], [], [], '`Kategori_Produk` ASC', '');
		$this->fields['kategori_produk'] = &$this->kategori_produk;

		// kategori_produk2
		$this->kategori_produk2 = new DbField('t_pcp', 't_pcp', 'x_kategori_produk2', 'kategori_produk2', '`kategori_produk2`', '`kategori_produk2`', 200, 100, -1, FALSE, '`kategori_produk2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kategori_produk2->Sortable = TRUE; // Allow sort
		$this->kategori_produk2->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kategori_produk2->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kategori_produk2->Lookup = new Lookup('kategori_produk2', 't_kat_produk', FALSE, 'Kategori_Produk', ["Kategori_Produk","","",""], [], [], [], [], [], [], '`Kategori_Produk` ASC', '');
		$this->fields['kategori_produk2'] = &$this->kategori_produk2;

		// kategori_produk3
		$this->kategori_produk3 = new DbField('t_pcp', 't_pcp', 'x_kategori_produk3', 'kategori_produk3', '`kategori_produk3`', '`kategori_produk3`', 200, 100, -1, FALSE, '`kategori_produk3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kategori_produk3->Sortable = TRUE; // Allow sort
		$this->kategori_produk3->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kategori_produk3->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kategori_produk3->Lookup = new Lookup('kategori_produk3', 't_kat_produk', FALSE, 'Kategori_Produk', ["Kategori_Produk","","",""], [], [], [], [], [], [], '`Kategori_Produk` ASC', '');
		$this->fields['kategori_produk3'] = &$this->kategori_produk3;

		// produk
		$this->produk = new DbField('t_pcp', 't_pcp', 'x_produk', 'produk', '`produk`', '`produk`', 200, 255, -1, FALSE, '`produk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->produk->Sortable = TRUE; // Allow sort
		$this->fields['produk'] = &$this->produk;

		// merek_dagang
		$this->merek_dagang = new DbField('t_pcp', 't_pcp', 'x_merek_dagang', 'merek_dagang', '`merek_dagang`', '`merek_dagang`', 200, 100, -1, FALSE, '`merek_dagang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->merek_dagang->Sortable = TRUE; // Allow sort
		$this->fields['merek_dagang'] = &$this->merek_dagang;

		// jenis_perusahaan
		$this->jenis_perusahaan = new DbField('t_pcp', 't_pcp', 'x_jenis_perusahaan', 'jenis_perusahaan', '`jenis_perusahaan`', '`jenis_perusahaan`', 200, 50, -1, FALSE, '`jenis_perusahaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis_perusahaan->Sortable = TRUE; // Allow sort
		$this->fields['jenis_perusahaan'] = &$this->jenis_perusahaan;

		// kapasitas_produksi
		$this->kapasitas_produksi = new DbField('t_pcp', 't_pcp', 'x_kapasitas_produksi', 'kapasitas_produksi', '`kapasitas_produksi`', '`kapasitas_produksi`', 200, 255, -1, FALSE, '`kapasitas_produksi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kapasitas_produksi->Sortable = TRUE; // Allow sort
		$this->fields['kapasitas_produksi'] = &$this->kapasitas_produksi;

		// omset
		$this->omset = new DbField('t_pcp', 't_pcp', 'x_omset', 'omset', '`omset`', '`omset`', 200, 100, -1, FALSE, '`omset`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->omset->Sortable = TRUE; // Allow sort
		$this->fields['omset'] = &$this->omset;

		// website
		$this->website = new DbField('t_pcp', 't_pcp', 'x_website', 'website', '`website`', '`website`', 200, 100, -1, FALSE, '`website`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->website->Sortable = TRUE; // Allow sort
		$this->fields['website'] = &$this->website;

		// fb
		$this->fb = new DbField('t_pcp', 't_pcp', 'x_fb', 'fb', '`fb`', '`fb`', 200, 100, -1, FALSE, '`fb`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fb->Sortable = TRUE; // Allow sort
		$this->fields['fb'] = &$this->fb;

		// ig
		$this->ig = new DbField('t_pcp', 't_pcp', 'x_ig', 'ig', '`ig`', '`ig`', 200, 50, -1, FALSE, '`ig`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ig->Sortable = TRUE; // Allow sort
		$this->fields['ig'] = &$this->ig;

		// sosmed_lain
		$this->sosmed_lain = new DbField('t_pcp', 't_pcp', 'x_sosmed_lain', 'sosmed_lain', '`sosmed_lain`', '`sosmed_lain`', 200, 100, -1, FALSE, '`sosmed_lain`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sosmed_lain->Sortable = TRUE; // Allow sort
		$this->fields['sosmed_lain'] = &$this->sosmed_lain;

		// jml_pegawai
		$this->jml_pegawai = new DbField('t_pcp', 't_pcp', 'x_jml_pegawai', 'jml_pegawai', '`jml_pegawai`', '`jml_pegawai`', 200, 6, -1, FALSE, '`jml_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jml_pegawai->Sortable = TRUE; // Allow sort
		$this->jml_pegawai->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jml_pegawai->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jml_pegawai->Lookup = new Lookup('jml_pegawai', 't_pcp', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jml_pegawai->OptionCount = 5;
		$this->fields['jml_pegawai'] = &$this->jml_pegawai;

		// jml_pegawai2
		$this->jml_pegawai2 = new DbField('t_pcp', 't_pcp', 'x_jml_pegawai2', 'jml_pegawai2', '`jml_pegawai2`', '`jml_pegawai2`', 200, 200, -1, FALSE, '`jml_pegawai2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_pegawai2->Sortable = TRUE; // Allow sort
		$this->fields['jml_pegawai2'] = &$this->jml_pegawai2;

		// jml_pegawai_tidaktetap
		$this->jml_pegawai_tidaktetap = new DbField('t_pcp', 't_pcp', 'x_jml_pegawai_tidaktetap', 'jml_pegawai_tidaktetap', '`jml_pegawai_tidaktetap`', '`jml_pegawai_tidaktetap`', 200, 200, -1, FALSE, '`jml_pegawai_tidaktetap`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jml_pegawai_tidaktetap->Sortable = TRUE; // Allow sort
		$this->fields['jml_pegawai_tidaktetap'] = &$this->jml_pegawai_tidaktetap;

		// legalitas
		$this->legalitas = new DbField('t_pcp', 't_pcp', 'x_legalitas', 'legalitas', '`legalitas`', '`legalitas`', 200, 25, -1, FALSE, '`legalitas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->legalitas->Sortable = TRUE; // Allow sort
		$this->legalitas->Lookup = new Lookup('legalitas', 't_pcp', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->legalitas->OptionCount = 5;
		$this->fields['legalitas'] = &$this->legalitas;

		// legalitas_lain
		$this->legalitas_lain = new DbField('t_pcp', 't_pcp', 'x_legalitas_lain', 'legalitas_lain', '`legalitas_lain`', '`legalitas_lain`', 200, 255, -1, FALSE, '`legalitas_lain`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->legalitas_lain->Sortable = TRUE; // Allow sort
		$this->fields['legalitas_lain'] = &$this->legalitas_lain;

		// f_npwp
		$this->f_npwp = new DbField('t_pcp', 't_pcp', 'x_f_npwp', 'f_npwp', '`f_npwp`', '`f_npwp`', 200, 255, -1, TRUE, '`f_npwp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_npwp->Sortable = TRUE; // Allow sort
		$this->fields['f_npwp'] = &$this->f_npwp;

		// f_nib
		$this->f_nib = new DbField('t_pcp', 't_pcp', 'x_f_nib', 'f_nib', '`f_nib`', '`f_nib`', 200, 255, -1, TRUE, '`f_nib`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_nib->Sortable = TRUE; // Allow sort
		$this->fields['f_nib'] = &$this->f_nib;

		// f_siup
		$this->f_siup = new DbField('t_pcp', 't_pcp', 'x_f_siup', 'f_siup', '`f_siup`', '`f_siup`', 200, 255, -1, TRUE, '`f_siup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_siup->Sortable = TRUE; // Allow sort
		$this->fields['f_siup'] = &$this->f_siup;

		// f_tdp
		$this->f_tdp = new DbField('t_pcp', 't_pcp', 'x_f_tdp', 'f_tdp', '`f_tdp`', '`f_tdp`', 200, 255, -1, TRUE, '`f_tdp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_tdp->Sortable = TRUE; // Allow sort
		$this->fields['f_tdp'] = &$this->f_tdp;

		// f_lain
		$this->f_lain = new DbField('t_pcp', 't_pcp', 'x_f_lain', 'f_lain', '`f_lain`', '`f_lain`', 200, 255, -1, TRUE, '`f_lain`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_lain->Sortable = TRUE; // Allow sort
		$this->fields['f_lain'] = &$this->f_lain;

		// sertifikat
		$this->sertifikat = new DbField('t_pcp', 't_pcp', 'x_sertifikat', 'sertifikat', '`sertifikat`', '`sertifikat`', 200, 25, -1, FALSE, '`sertifikat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->sertifikat->Sortable = TRUE; // Allow sort
		$this->sertifikat->Lookup = new Lookup('sertifikat', 't_pcp', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->sertifikat->OptionCount = 11;
		$this->fields['sertifikat'] = &$this->sertifikat;

		// sertifikat_lain
		$this->sertifikat_lain = new DbField('t_pcp', 't_pcp', 'x_sertifikat_lain', 'sertifikat_lain', '`sertifikat_lain`', '`sertifikat_lain`', 200, 255, -1, FALSE, '`sertifikat_lain`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sertifikat_lain->Sortable = TRUE; // Allow sort
		$this->fields['sertifikat_lain'] = &$this->sertifikat_lain;

		// f_sertifikat
		$this->f_sertifikat = new DbField('t_pcp', 't_pcp', 'x_f_sertifikat', 'f_sertifikat', '`f_sertifikat`', '`f_sertifikat`', 200, 255, -1, TRUE, '`f_sertifikat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_sertifikat->Sortable = TRUE; // Allow sort
		$this->f_sertifikat->UploadMultiple = TRUE;
		$this->f_sertifikat->Upload->UploadMultiple = TRUE;
		$this->f_sertifikat->UploadMaxFileCount = 0;
		$this->fields['f_sertifikat'] = &$this->f_sertifikat;

		// alat_promosi
		$this->alat_promosi = new DbField('t_pcp', 't_pcp', 'x_alat_promosi', 'alat_promosi', '`alat_promosi`', '`alat_promosi`', 200, 50, -1, FALSE, '`alat_promosi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->alat_promosi->Sortable = TRUE; // Allow sort
		$this->alat_promosi->Lookup = new Lookup('alat_promosi', 't_pcp', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->alat_promosi->OptionCount = 5;
		$this->fields['alat_promosi'] = &$this->alat_promosi;

		// promosi_lain
		$this->promosi_lain = new DbField('t_pcp', 't_pcp', 'x_promosi_lain', 'promosi_lain', '`promosi_lain`', '`promosi_lain`', 200, 255, -1, FALSE, '`promosi_lain`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->promosi_lain->Sortable = TRUE; // Allow sort
		$this->fields['promosi_lain'] = &$this->promosi_lain;

		// f_kartunama
		$this->f_kartunama = new DbField('t_pcp', 't_pcp', 'x_f_kartunama', 'f_kartunama', '`f_kartunama`', '`f_kartunama`', 200, 255, -1, TRUE, '`f_kartunama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_kartunama->Sortable = TRUE; // Allow sort
		$this->fields['f_kartunama'] = &$this->f_kartunama;

		// f_brosur
		$this->f_brosur = new DbField('t_pcp', 't_pcp', 'x_f_brosur', 'f_brosur', '`f_brosur`', '`f_brosur`', 200, 255, -1, TRUE, '`f_brosur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_brosur->Sortable = TRUE; // Allow sort
		$this->fields['f_brosur'] = &$this->f_brosur;

		// f_katalog
		$this->f_katalog = new DbField('t_pcp', 't_pcp', 'x_f_katalog', 'f_katalog', '`f_katalog`', '`f_katalog`', 200, 255, -1, TRUE, '`f_katalog`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_katalog->Sortable = TRUE; // Allow sort
		$this->fields['f_katalog'] = &$this->f_katalog;

		// f_profile
		$this->f_profile = new DbField('t_pcp', 't_pcp', 'x_f_profile', 'f_profile', '`f_profile`', '`f_profile`', 200, 255, -1, TRUE, '`f_profile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->f_profile->Sortable = TRUE; // Allow sort
		$this->fields['f_profile'] = &$this->f_profile;

		// tahun_ecp
		$this->tahun_ecp = new DbField('t_pcp', 't_pcp', 'x_tahun_ecp', 'tahun_ecp', '`tahun_ecp`', '`tahun_ecp`', 2, 4, -1, FALSE, '`tahun_ecp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tahun_ecp->Sortable = TRUE; // Allow sort
		$this->tahun_ecp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tahun_ecp'] = &$this->tahun_ecp;

		// wilayah_ecp
		$this->wilayah_ecp = new DbField('t_pcp', 't_pcp', 'x_wilayah_ecp', 'wilayah_ecp', '`wilayah_ecp`', '`wilayah_ecp`', 200, 100, -1, FALSE, '`wilayah_ecp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->wilayah_ecp->Required = TRUE; // Required field
		$this->wilayah_ecp->Sortable = TRUE; // Allow sort
		$this->fields['wilayah_ecp'] = &$this->wilayah_ecp;
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
		if ($this->getCurrentMasterTable() == "excp") {
			if ($this->rkid->getSessionValue() != "")
				$masterFilter .= "t_rkcoaching.rkid=" . QuotedValue($this->rkid->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "excp") {
			if ($this->rkid->getSessionValue() != "")
				$detailFilter .= "`rkid`=" . QuotedValue($this->rkid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_excp()
	{
		return "t_rkcoaching.rkid=@rkid@";
	}

	// Detail filter
	public function sqlDetailFilter_excp()
	{
		return "`rkid`=@rkid@";
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
		if ($this->getCurrentDetailTable() == "t_ecp") {
			$detailUrl = $GLOBALS["t_ecp"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "t_pcplist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_pcp`";
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
		$this->rkid->DbValue = $row['rkid'];
		$this->nama_peserta->DbValue = $row['nama_peserta'];
		$this->email_add->DbValue = $row['email_add'];
		$this->handphone->DbValue = $row['handphone'];
		$this->namap->DbValue = $row['namap'];
		$this->tahun_berdiri->DbValue = $row['tahun_berdiri'];
		$this->alamat->DbValue = $row['alamat'];
		$this->alamat_prod->DbValue = $row['alamat_prod'];
		$this->kategori_produk->DbValue = $row['kategori_produk'];
		$this->kategori_produk2->DbValue = $row['kategori_produk2'];
		$this->kategori_produk3->DbValue = $row['kategori_produk3'];
		$this->produk->DbValue = $row['produk'];
		$this->merek_dagang->DbValue = $row['merek_dagang'];
		$this->jenis_perusahaan->DbValue = $row['jenis_perusahaan'];
		$this->kapasitas_produksi->DbValue = $row['kapasitas_produksi'];
		$this->omset->DbValue = $row['omset'];
		$this->website->DbValue = $row['website'];
		$this->fb->DbValue = $row['fb'];
		$this->ig->DbValue = $row['ig'];
		$this->sosmed_lain->DbValue = $row['sosmed_lain'];
		$this->jml_pegawai->DbValue = $row['jml_pegawai'];
		$this->jml_pegawai2->DbValue = $row['jml_pegawai2'];
		$this->jml_pegawai_tidaktetap->DbValue = $row['jml_pegawai_tidaktetap'];
		$this->legalitas->DbValue = $row['legalitas'];
		$this->legalitas_lain->DbValue = $row['legalitas_lain'];
		$this->f_npwp->Upload->DbValue = $row['f_npwp'];
		$this->f_nib->Upload->DbValue = $row['f_nib'];
		$this->f_siup->Upload->DbValue = $row['f_siup'];
		$this->f_tdp->Upload->DbValue = $row['f_tdp'];
		$this->f_lain->Upload->DbValue = $row['f_lain'];
		$this->sertifikat->DbValue = $row['sertifikat'];
		$this->sertifikat_lain->DbValue = $row['sertifikat_lain'];
		$this->f_sertifikat->Upload->DbValue = $row['f_sertifikat'];
		$this->alat_promosi->DbValue = $row['alat_promosi'];
		$this->promosi_lain->DbValue = $row['promosi_lain'];
		$this->f_kartunama->Upload->DbValue = $row['f_kartunama'];
		$this->f_brosur->Upload->DbValue = $row['f_brosur'];
		$this->f_katalog->Upload->DbValue = $row['f_katalog'];
		$this->f_profile->Upload->DbValue = $row['f_profile'];
		$this->tahun_ecp->DbValue = $row['tahun_ecp'];
		$this->wilayah_ecp->DbValue = $row['wilayah_ecp'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$this->f_npwp->OldUploadPath = "berkas/legalitas_ecp/";
		$oldFiles = EmptyValue($row['f_npwp']) ? [] : [$row['f_npwp']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_npwp->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_npwp->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_nib->OldUploadPath = "berkas/legalitas_ecp/";
		$oldFiles = EmptyValue($row['f_nib']) ? [] : [$row['f_nib']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_nib->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_nib->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_siup->OldUploadPath = "berkas/legalitas_ecp/";
		$oldFiles = EmptyValue($row['f_siup']) ? [] : [$row['f_siup']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_siup->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_siup->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_tdp->OldUploadPath = "berkas/legalitas_ecp/";
		$oldFiles = EmptyValue($row['f_tdp']) ? [] : [$row['f_tdp']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_tdp->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_tdp->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_lain->OldUploadPath = "berkas/legalitas_ecp/";
		$oldFiles = EmptyValue($row['f_lain']) ? [] : [$row['f_lain']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_lain->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_lain->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_sertifikat->OldUploadPath = "berkas/sertifikat_ecp/";
		$oldFiles = EmptyValue($row['f_sertifikat']) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $row['f_sertifikat']);
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_sertifikat->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_sertifikat->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_kartunama->OldUploadPath = "berkas/promosi_ecp/";
		$oldFiles = EmptyValue($row['f_kartunama']) ? [] : [$row['f_kartunama']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_kartunama->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_kartunama->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_brosur->OldUploadPath = "berkas/promosi_ecp/";
		$oldFiles = EmptyValue($row['f_brosur']) ? [] : [$row['f_brosur']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_brosur->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_brosur->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_katalog->OldUploadPath = "berkas/promosi_ecp/";
		$oldFiles = EmptyValue($row['f_katalog']) ? [] : [$row['f_katalog']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_katalog->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_katalog->oldPhysicalUploadPath() . $oldFile);
		}
		$this->f_profile->OldUploadPath = "berkas/promosi_ecp/";
		$oldFiles = EmptyValue($row['f_profile']) ? [] : [$row['f_profile']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->f_profile->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->f_profile->oldPhysicalUploadPath() . $oldFile);
		}
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
			return "t_pcplist.php";
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
		if ($pageName == "t_pcpview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_pcpedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_pcpadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_pcplist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_pcpview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pcpview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_pcpadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_pcpadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_pcpedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pcpedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("t_pcpadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_pcpadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("t_pcpdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "excp" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_rkid=" . urlencode($this->rkid->CurrentValue);
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
		$this->rkid->setDbValue($rs->fields('rkid'));
		$this->nama_peserta->setDbValue($rs->fields('nama_peserta'));
		$this->email_add->setDbValue($rs->fields('email_add'));
		$this->handphone->setDbValue($rs->fields('handphone'));
		$this->namap->setDbValue($rs->fields('namap'));
		$this->tahun_berdiri->setDbValue($rs->fields('tahun_berdiri'));
		$this->alamat->setDbValue($rs->fields('alamat'));
		$this->alamat_prod->setDbValue($rs->fields('alamat_prod'));
		$this->kategori_produk->setDbValue($rs->fields('kategori_produk'));
		$this->kategori_produk2->setDbValue($rs->fields('kategori_produk2'));
		$this->kategori_produk3->setDbValue($rs->fields('kategori_produk3'));
		$this->produk->setDbValue($rs->fields('produk'));
		$this->merek_dagang->setDbValue($rs->fields('merek_dagang'));
		$this->jenis_perusahaan->setDbValue($rs->fields('jenis_perusahaan'));
		$this->kapasitas_produksi->setDbValue($rs->fields('kapasitas_produksi'));
		$this->omset->setDbValue($rs->fields('omset'));
		$this->website->setDbValue($rs->fields('website'));
		$this->fb->setDbValue($rs->fields('fb'));
		$this->ig->setDbValue($rs->fields('ig'));
		$this->sosmed_lain->setDbValue($rs->fields('sosmed_lain'));
		$this->jml_pegawai->setDbValue($rs->fields('jml_pegawai'));
		$this->jml_pegawai2->setDbValue($rs->fields('jml_pegawai2'));
		$this->jml_pegawai_tidaktetap->setDbValue($rs->fields('jml_pegawai_tidaktetap'));
		$this->legalitas->setDbValue($rs->fields('legalitas'));
		$this->legalitas_lain->setDbValue($rs->fields('legalitas_lain'));
		$this->f_npwp->Upload->DbValue = $rs->fields('f_npwp');
		$this->f_nib->Upload->DbValue = $rs->fields('f_nib');
		$this->f_siup->Upload->DbValue = $rs->fields('f_siup');
		$this->f_tdp->Upload->DbValue = $rs->fields('f_tdp');
		$this->f_lain->Upload->DbValue = $rs->fields('f_lain');
		$this->sertifikat->setDbValue($rs->fields('sertifikat'));
		$this->sertifikat_lain->setDbValue($rs->fields('sertifikat_lain'));
		$this->f_sertifikat->Upload->DbValue = $rs->fields('f_sertifikat');
		$this->alat_promosi->setDbValue($rs->fields('alat_promosi'));
		$this->promosi_lain->setDbValue($rs->fields('promosi_lain'));
		$this->f_kartunama->Upload->DbValue = $rs->fields('f_kartunama');
		$this->f_brosur->Upload->DbValue = $rs->fields('f_brosur');
		$this->f_katalog->Upload->DbValue = $rs->fields('f_katalog');
		$this->f_profile->Upload->DbValue = $rs->fields('f_profile');
		$this->tahun_ecp->setDbValue($rs->fields('tahun_ecp'));
		$this->wilayah_ecp->setDbValue($rs->fields('wilayah_ecp'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// rkid
		// nama_peserta
		// email_add
		// handphone
		// namap
		// tahun_berdiri
		// alamat
		// alamat_prod
		// kategori_produk
		// kategori_produk2
		// kategori_produk3
		// produk
		// merek_dagang
		// jenis_perusahaan
		// kapasitas_produksi
		// omset
		// website
		// fb
		// ig
		// sosmed_lain
		// jml_pegawai
		// jml_pegawai2
		// jml_pegawai_tidaktetap
		// legalitas
		// legalitas_lain
		// f_npwp
		// f_nib
		// f_siup
		// f_tdp
		// f_lain
		// sertifikat
		// sertifikat_lain
		// f_sertifikat
		// alat_promosi
		// promosi_lain
		// f_kartunama
		// f_brosur
		// f_katalog
		// f_profile
		// tahun_ecp
		// wilayah_ecp
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// rkid
		$this->rkid->ViewValue = $this->rkid->CurrentValue;
		$this->rkid->ViewValue = FormatNumber($this->rkid->ViewValue, 0, -2, -2, -2);
		$this->rkid->ViewCustomAttributes = "";

		// nama_peserta
		$this->nama_peserta->ViewValue = $this->nama_peserta->CurrentValue;
		$this->nama_peserta->ViewCustomAttributes = "";

		// email_add
		$this->email_add->ViewValue = $this->email_add->CurrentValue;
		$this->email_add->ViewCustomAttributes = "";

		// handphone
		$this->handphone->ViewValue = $this->handphone->CurrentValue;
		$this->handphone->ViewCustomAttributes = "";

		// namap
		$this->namap->ViewValue = $this->namap->CurrentValue;
		$arwrk = [];
		$arwrk[1] = $this->namap->CurrentValue;
		$this->namap->ViewValue = $this->namap->displayValue($arwrk);
		$this->namap->ViewCustomAttributes = "";

		// tahun_berdiri
		$this->tahun_berdiri->ViewValue = $this->tahun_berdiri->CurrentValue;
		$this->tahun_berdiri->ViewValue = FormatNumber($this->tahun_berdiri->ViewValue, 0, -2, -2, -2);
		$this->tahun_berdiri->ViewCustomAttributes = "";

		// alamat
		$this->alamat->ViewValue = $this->alamat->CurrentValue;
		$this->alamat->ViewCustomAttributes = "";

		// alamat_prod
		$this->alamat_prod->ViewValue = $this->alamat_prod->CurrentValue;
		$this->alamat_prod->ViewCustomAttributes = "";

		// kategori_produk
		$curVal = strval($this->kategori_produk->CurrentValue);
		if ($curVal != "") {
			$this->kategori_produk->ViewValue = $this->kategori_produk->lookupCacheOption($curVal);
			if ($this->kategori_produk->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->kategori_produk->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kategori_produk->ViewValue = $this->kategori_produk->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kategori_produk->ViewValue = $this->kategori_produk->CurrentValue;
				}
			}
		} else {
			$this->kategori_produk->ViewValue = NULL;
		}
		$this->kategori_produk->ViewCustomAttributes = "";

		// kategori_produk2
		$curVal = strval($this->kategori_produk2->CurrentValue);
		if ($curVal != "") {
			$this->kategori_produk2->ViewValue = $this->kategori_produk2->lookupCacheOption($curVal);
			if ($this->kategori_produk2->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->kategori_produk2->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kategori_produk2->ViewValue = $this->kategori_produk2->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kategori_produk2->ViewValue = $this->kategori_produk2->CurrentValue;
				}
			}
		} else {
			$this->kategori_produk2->ViewValue = NULL;
		}
		$this->kategori_produk2->ViewCustomAttributes = "";

		// kategori_produk3
		$curVal = strval($this->kategori_produk3->CurrentValue);
		if ($curVal != "") {
			$this->kategori_produk3->ViewValue = $this->kategori_produk3->lookupCacheOption($curVal);
			if ($this->kategori_produk3->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Kategori_Produk`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->kategori_produk3->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kategori_produk3->ViewValue = $this->kategori_produk3->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kategori_produk3->ViewValue = $this->kategori_produk3->CurrentValue;
				}
			}
		} else {
			$this->kategori_produk3->ViewValue = NULL;
		}
		$this->kategori_produk3->ViewCustomAttributes = "";

		// produk
		$this->produk->ViewValue = $this->produk->CurrentValue;
		$this->produk->ViewCustomAttributes = "";

		// merek_dagang
		$this->merek_dagang->ViewValue = $this->merek_dagang->CurrentValue;
		$this->merek_dagang->ViewCustomAttributes = "";

		// jenis_perusahaan
		$this->jenis_perusahaan->ViewValue = $this->jenis_perusahaan->CurrentValue;
		$this->jenis_perusahaan->ViewCustomAttributes = "";

		// kapasitas_produksi
		$this->kapasitas_produksi->ViewValue = $this->kapasitas_produksi->CurrentValue;
		$this->kapasitas_produksi->ViewCustomAttributes = "";

		// omset
		$this->omset->ViewValue = $this->omset->CurrentValue;
		$this->omset->ViewCustomAttributes = "";

		// website
		$this->website->ViewValue = $this->website->CurrentValue;
		$this->website->ViewCustomAttributes = "";

		// fb
		$this->fb->ViewValue = $this->fb->CurrentValue;
		$this->fb->ViewCustomAttributes = "";

		// ig
		$this->ig->ViewValue = $this->ig->CurrentValue;
		$this->ig->ViewCustomAttributes = "";

		// sosmed_lain
		$this->sosmed_lain->ViewValue = $this->sosmed_lain->CurrentValue;
		$this->sosmed_lain->ViewCustomAttributes = "";

		// jml_pegawai
		if (strval($this->jml_pegawai->CurrentValue) != "") {
			$this->jml_pegawai->ViewValue = $this->jml_pegawai->optionCaption($this->jml_pegawai->CurrentValue);
		} else {
			$this->jml_pegawai->ViewValue = NULL;
		}
		$this->jml_pegawai->ViewCustomAttributes = "";

		// jml_pegawai2
		$this->jml_pegawai2->ViewValue = $this->jml_pegawai2->CurrentValue;
		$this->jml_pegawai2->ViewCustomAttributes = "";

		// jml_pegawai_tidaktetap
		$this->jml_pegawai_tidaktetap->ViewValue = $this->jml_pegawai_tidaktetap->CurrentValue;
		$this->jml_pegawai_tidaktetap->ViewCustomAttributes = "";

		// legalitas
		if (strval($this->legalitas->CurrentValue) != "") {
			$this->legalitas->ViewValue = new OptionValues();
			$arwrk = explode(",", strval($this->legalitas->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++)
				$this->legalitas->ViewValue->add($this->legalitas->optionCaption(trim($arwrk[$ari])));
		} else {
			$this->legalitas->ViewValue = NULL;
		}
		$this->legalitas->ViewCustomAttributes = "";

		// legalitas_lain
		$this->legalitas_lain->ViewValue = $this->legalitas_lain->CurrentValue;
		$this->legalitas_lain->ViewCustomAttributes = "";

		// f_npwp
		$this->f_npwp->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_npwp->Upload->DbValue)) {
			$this->f_npwp->ViewValue = $this->f_npwp->Upload->DbValue;
		} else {
			$this->f_npwp->ViewValue = "";
		}
		$this->f_npwp->ViewCustomAttributes = "";

		// f_nib
		$this->f_nib->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_nib->Upload->DbValue)) {
			$this->f_nib->ViewValue = $this->f_nib->Upload->DbValue;
		} else {
			$this->f_nib->ViewValue = "";
		}
		$this->f_nib->ViewCustomAttributes = "";

		// f_siup
		$this->f_siup->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_siup->Upload->DbValue)) {
			$this->f_siup->ViewValue = $this->f_siup->Upload->DbValue;
		} else {
			$this->f_siup->ViewValue = "";
		}
		$this->f_siup->ViewCustomAttributes = "";

		// f_tdp
		$this->f_tdp->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_tdp->Upload->DbValue)) {
			$this->f_tdp->ViewValue = $this->f_tdp->Upload->DbValue;
		} else {
			$this->f_tdp->ViewValue = "";
		}
		$this->f_tdp->ViewCustomAttributes = "";

		// f_lain
		$this->f_lain->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_lain->Upload->DbValue)) {
			$this->f_lain->ViewValue = $this->f_lain->Upload->DbValue;
		} else {
			$this->f_lain->ViewValue = "";
		}
		$this->f_lain->ViewCustomAttributes = "";

		// sertifikat
		if (strval($this->sertifikat->CurrentValue) != "") {
			$this->sertifikat->ViewValue = new OptionValues();
			$arwrk = explode(",", strval($this->sertifikat->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++)
				$this->sertifikat->ViewValue->add($this->sertifikat->optionCaption(trim($arwrk[$ari])));
		} else {
			$this->sertifikat->ViewValue = NULL;
		}
		$this->sertifikat->ViewCustomAttributes = "";

		// sertifikat_lain
		$this->sertifikat_lain->ViewValue = $this->sertifikat_lain->CurrentValue;
		$this->sertifikat_lain->ViewCustomAttributes = "";

		// f_sertifikat
		$this->f_sertifikat->UploadPath = "berkas/sertifikat_ecp/";
		if (!EmptyValue($this->f_sertifikat->Upload->DbValue)) {
			$this->f_sertifikat->ViewValue = $this->f_sertifikat->Upload->DbValue;
		} else {
			$this->f_sertifikat->ViewValue = "";
		}
		$this->f_sertifikat->ViewCustomAttributes = "";

		// alat_promosi
		if (strval($this->alat_promosi->CurrentValue) != "") {
			$this->alat_promosi->ViewValue = new OptionValues();
			$arwrk = explode(",", strval($this->alat_promosi->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++)
				$this->alat_promosi->ViewValue->add($this->alat_promosi->optionCaption(trim($arwrk[$ari])));
		} else {
			$this->alat_promosi->ViewValue = NULL;
		}
		$this->alat_promosi->ViewCustomAttributes = "";

		// promosi_lain
		$this->promosi_lain->ViewValue = $this->promosi_lain->CurrentValue;
		$this->promosi_lain->ViewCustomAttributes = "";

		// f_kartunama
		$this->f_kartunama->UploadPath = "berkas/promosi_ecp/";
		if (!EmptyValue($this->f_kartunama->Upload->DbValue)) {
			$this->f_kartunama->ViewValue = $this->f_kartunama->Upload->DbValue;
		} else {
			$this->f_kartunama->ViewValue = "";
		}
		$this->f_kartunama->ViewCustomAttributes = "";

		// f_brosur
		$this->f_brosur->UploadPath = "berkas/promosi_ecp/";
		if (!EmptyValue($this->f_brosur->Upload->DbValue)) {
			$this->f_brosur->ViewValue = $this->f_brosur->Upload->DbValue;
		} else {
			$this->f_brosur->ViewValue = "";
		}
		$this->f_brosur->ViewCustomAttributes = "";

		// f_katalog
		$this->f_katalog->UploadPath = "berkas/promosi_ecp/";
		if (!EmptyValue($this->f_katalog->Upload->DbValue)) {
			$this->f_katalog->ViewValue = $this->f_katalog->Upload->DbValue;
		} else {
			$this->f_katalog->ViewValue = "";
		}
		$this->f_katalog->ViewCustomAttributes = "";

		// f_profile
		$this->f_profile->UploadPath = "berkas/promosi_ecp/";
		if (!EmptyValue($this->f_profile->Upload->DbValue)) {
			$this->f_profile->ViewValue = $this->f_profile->Upload->DbValue;
		} else {
			$this->f_profile->ViewValue = "";
		}
		$this->f_profile->ViewCustomAttributes = "";

		// tahun_ecp
		$this->tahun_ecp->ViewValue = $this->tahun_ecp->CurrentValue;
		$this->tahun_ecp->ViewCustomAttributes = "";

		// wilayah_ecp
		$this->wilayah_ecp->ViewValue = $this->wilayah_ecp->CurrentValue;
		$this->wilayah_ecp->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// rkid
		$this->rkid->LinkCustomAttributes = "";
		$this->rkid->HrefValue = "";
		$this->rkid->TooltipValue = "";

		// nama_peserta
		$this->nama_peserta->LinkCustomAttributes = "";
		$this->nama_peserta->HrefValue = "";
		$this->nama_peserta->TooltipValue = "";

		// email_add
		$this->email_add->LinkCustomAttributes = "";
		$this->email_add->HrefValue = "";
		$this->email_add->TooltipValue = "";

		// handphone
		$this->handphone->LinkCustomAttributes = "";
		$this->handphone->HrefValue = "";
		$this->handphone->TooltipValue = "";

		// namap
		$this->namap->LinkCustomAttributes = "";
		$this->namap->HrefValue = "";
		$this->namap->TooltipValue = "";

		// tahun_berdiri
		$this->tahun_berdiri->LinkCustomAttributes = "";
		$this->tahun_berdiri->HrefValue = "";
		$this->tahun_berdiri->TooltipValue = "";

		// alamat
		$this->alamat->LinkCustomAttributes = "";
		$this->alamat->HrefValue = "";
		$this->alamat->TooltipValue = "";

		// alamat_prod
		$this->alamat_prod->LinkCustomAttributes = "";
		$this->alamat_prod->HrefValue = "";
		$this->alamat_prod->TooltipValue = "";

		// kategori_produk
		$this->kategori_produk->LinkCustomAttributes = "";
		$this->kategori_produk->HrefValue = "";
		$this->kategori_produk->TooltipValue = "";

		// kategori_produk2
		$this->kategori_produk2->LinkCustomAttributes = "";
		$this->kategori_produk2->HrefValue = "";
		$this->kategori_produk2->TooltipValue = "";

		// kategori_produk3
		$this->kategori_produk3->LinkCustomAttributes = "";
		$this->kategori_produk3->HrefValue = "";
		$this->kategori_produk3->TooltipValue = "";

		// produk
		$this->produk->LinkCustomAttributes = "";
		$this->produk->HrefValue = "";
		$this->produk->TooltipValue = "";

		// merek_dagang
		$this->merek_dagang->LinkCustomAttributes = "";
		$this->merek_dagang->HrefValue = "";
		$this->merek_dagang->TooltipValue = "";

		// jenis_perusahaan
		$this->jenis_perusahaan->LinkCustomAttributes = "";
		$this->jenis_perusahaan->HrefValue = "";
		$this->jenis_perusahaan->TooltipValue = "";

		// kapasitas_produksi
		$this->kapasitas_produksi->LinkCustomAttributes = "";
		$this->kapasitas_produksi->HrefValue = "";
		$this->kapasitas_produksi->TooltipValue = "";

		// omset
		$this->omset->LinkCustomAttributes = "";
		$this->omset->HrefValue = "";
		$this->omset->TooltipValue = "";

		// website
		$this->website->LinkCustomAttributes = "";
		$this->website->HrefValue = "";
		$this->website->TooltipValue = "";

		// fb
		$this->fb->LinkCustomAttributes = "";
		$this->fb->HrefValue = "";
		$this->fb->TooltipValue = "";

		// ig
		$this->ig->LinkCustomAttributes = "";
		$this->ig->HrefValue = "";
		$this->ig->TooltipValue = "";

		// sosmed_lain
		$this->sosmed_lain->LinkCustomAttributes = "";
		$this->sosmed_lain->HrefValue = "";
		$this->sosmed_lain->TooltipValue = "";

		// jml_pegawai
		$this->jml_pegawai->LinkCustomAttributes = "";
		$this->jml_pegawai->HrefValue = "";
		$this->jml_pegawai->TooltipValue = "";

		// jml_pegawai2
		$this->jml_pegawai2->LinkCustomAttributes = "";
		$this->jml_pegawai2->HrefValue = "";
		$this->jml_pegawai2->TooltipValue = "";

		// jml_pegawai_tidaktetap
		$this->jml_pegawai_tidaktetap->LinkCustomAttributes = "";
		$this->jml_pegawai_tidaktetap->HrefValue = "";
		$this->jml_pegawai_tidaktetap->TooltipValue = "";

		// legalitas
		$this->legalitas->LinkCustomAttributes = "";
		$this->legalitas->HrefValue = "";
		$this->legalitas->TooltipValue = "";

		// legalitas_lain
		$this->legalitas_lain->LinkCustomAttributes = "";
		$this->legalitas_lain->HrefValue = "";
		$this->legalitas_lain->TooltipValue = "";

		// f_npwp
		$this->f_npwp->LinkCustomAttributes = "";
		$this->f_npwp->HrefValue = "";
		$this->f_npwp->ExportHrefValue = $this->f_npwp->UploadPath . $this->f_npwp->Upload->DbValue;
		$this->f_npwp->TooltipValue = "";

		// f_nib
		$this->f_nib->LinkCustomAttributes = "";
		$this->f_nib->HrefValue = "";
		$this->f_nib->ExportHrefValue = $this->f_nib->UploadPath . $this->f_nib->Upload->DbValue;
		$this->f_nib->TooltipValue = "";

		// f_siup
		$this->f_siup->LinkCustomAttributes = "";
		$this->f_siup->HrefValue = "";
		$this->f_siup->ExportHrefValue = $this->f_siup->UploadPath . $this->f_siup->Upload->DbValue;
		$this->f_siup->TooltipValue = "";

		// f_tdp
		$this->f_tdp->LinkCustomAttributes = "";
		$this->f_tdp->HrefValue = "";
		$this->f_tdp->ExportHrefValue = $this->f_tdp->UploadPath . $this->f_tdp->Upload->DbValue;
		$this->f_tdp->TooltipValue = "";

		// f_lain
		$this->f_lain->LinkCustomAttributes = "";
		$this->f_lain->HrefValue = "";
		$this->f_lain->ExportHrefValue = $this->f_lain->UploadPath . $this->f_lain->Upload->DbValue;
		$this->f_lain->TooltipValue = "";

		// sertifikat
		$this->sertifikat->LinkCustomAttributes = "";
		$this->sertifikat->HrefValue = "";
		$this->sertifikat->TooltipValue = "";

		// sertifikat_lain
		$this->sertifikat_lain->LinkCustomAttributes = "";
		$this->sertifikat_lain->HrefValue = "";
		$this->sertifikat_lain->TooltipValue = "";

		// f_sertifikat
		$this->f_sertifikat->LinkCustomAttributes = "";
		$this->f_sertifikat->HrefValue = "";
		$this->f_sertifikat->ExportHrefValue = $this->f_sertifikat->UploadPath . $this->f_sertifikat->Upload->DbValue;
		$this->f_sertifikat->TooltipValue = "";

		// alat_promosi
		$this->alat_promosi->LinkCustomAttributes = "";
		$this->alat_promosi->HrefValue = "";
		$this->alat_promosi->TooltipValue = "";

		// promosi_lain
		$this->promosi_lain->LinkCustomAttributes = "";
		$this->promosi_lain->HrefValue = "";
		$this->promosi_lain->TooltipValue = "";

		// f_kartunama
		$this->f_kartunama->LinkCustomAttributes = "";
		$this->f_kartunama->HrefValue = "";
		$this->f_kartunama->ExportHrefValue = $this->f_kartunama->UploadPath . $this->f_kartunama->Upload->DbValue;
		$this->f_kartunama->TooltipValue = "";

		// f_brosur
		$this->f_brosur->LinkCustomAttributes = "";
		$this->f_brosur->HrefValue = "";
		$this->f_brosur->ExportHrefValue = $this->f_brosur->UploadPath . $this->f_brosur->Upload->DbValue;
		$this->f_brosur->TooltipValue = "";

		// f_katalog
		$this->f_katalog->LinkCustomAttributes = "";
		$this->f_katalog->HrefValue = "";
		$this->f_katalog->ExportHrefValue = $this->f_katalog->UploadPath . $this->f_katalog->Upload->DbValue;
		$this->f_katalog->TooltipValue = "";

		// f_profile
		$this->f_profile->LinkCustomAttributes = "";
		$this->f_profile->HrefValue = "";
		$this->f_profile->ExportHrefValue = $this->f_profile->UploadPath . $this->f_profile->Upload->DbValue;
		$this->f_profile->TooltipValue = "";

		// tahun_ecp
		$this->tahun_ecp->LinkCustomAttributes = "";
		$this->tahun_ecp->HrefValue = "";
		$this->tahun_ecp->TooltipValue = "";

		// wilayah_ecp
		$this->wilayah_ecp->LinkCustomAttributes = "";
		$this->wilayah_ecp->HrefValue = "";
		$this->wilayah_ecp->TooltipValue = "";

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
		$this->id->ViewCustomAttributes = "";

		// rkid
		$this->rkid->EditAttrs["class"] = "form-control";
		$this->rkid->EditCustomAttributes = "";
		if ($this->rkid->getSessionValue() != "") {
			$this->rkid->CurrentValue = $this->rkid->getSessionValue();
			$this->rkid->ViewValue = $this->rkid->CurrentValue;
			$this->rkid->ViewValue = FormatNumber($this->rkid->ViewValue, 0, -2, -2, -2);
			$this->rkid->ViewCustomAttributes = "";
		} else {
			$this->rkid->EditValue = $this->rkid->CurrentValue;
			$this->rkid->PlaceHolder = RemoveHtml($this->rkid->caption());
		}

		// nama_peserta
		$this->nama_peserta->EditAttrs["class"] = "form-control";
		$this->nama_peserta->EditCustomAttributes = "";
		if (!$this->nama_peserta->Raw)
			$this->nama_peserta->CurrentValue = HtmlDecode($this->nama_peserta->CurrentValue);
		$this->nama_peserta->EditValue = $this->nama_peserta->CurrentValue;
		$this->nama_peserta->PlaceHolder = RemoveHtml($this->nama_peserta->caption());

		// email_add
		$this->email_add->EditAttrs["class"] = "form-control";
		$this->email_add->EditCustomAttributes = "";
		if (!$this->email_add->Raw)
			$this->email_add->CurrentValue = HtmlDecode($this->email_add->CurrentValue);
		$this->email_add->EditValue = $this->email_add->CurrentValue;
		$this->email_add->PlaceHolder = RemoveHtml($this->email_add->caption());

		// handphone
		$this->handphone->EditAttrs["class"] = "form-control";
		$this->handphone->EditCustomAttributes = "";
		if (!$this->handphone->Raw)
			$this->handphone->CurrentValue = HtmlDecode($this->handphone->CurrentValue);
		$this->handphone->EditValue = $this->handphone->CurrentValue;
		$this->handphone->PlaceHolder = RemoveHtml($this->handphone->caption());

		// namap
		$this->namap->EditAttrs["class"] = "form-control";
		$this->namap->EditCustomAttributes = "";
		if (!$this->namap->Raw)
			$this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
		$this->namap->EditValue = $this->namap->CurrentValue;
		$this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

		// tahun_berdiri
		$this->tahun_berdiri->EditAttrs["class"] = "form-control";
		$this->tahun_berdiri->EditCustomAttributes = "";
		$this->tahun_berdiri->EditValue = $this->tahun_berdiri->CurrentValue;
		$this->tahun_berdiri->PlaceHolder = RemoveHtml($this->tahun_berdiri->caption());

		// alamat
		$this->alamat->EditAttrs["class"] = "form-control";
		$this->alamat->EditCustomAttributes = "";
		$this->alamat->EditValue = $this->alamat->CurrentValue;
		$this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

		// alamat_prod
		$this->alamat_prod->EditAttrs["class"] = "form-control";
		$this->alamat_prod->EditCustomAttributes = "";
		$this->alamat_prod->EditValue = $this->alamat_prod->CurrentValue;
		$this->alamat_prod->PlaceHolder = RemoveHtml($this->alamat_prod->caption());

		// kategori_produk
		$this->kategori_produk->EditAttrs["class"] = "form-control";
		$this->kategori_produk->EditCustomAttributes = "";

		// kategori_produk2
		$this->kategori_produk2->EditAttrs["class"] = "form-control";
		$this->kategori_produk2->EditCustomAttributes = "";

		// kategori_produk3
		$this->kategori_produk3->EditAttrs["class"] = "form-control";
		$this->kategori_produk3->EditCustomAttributes = "";

		// produk
		$this->produk->EditAttrs["class"] = "form-control";
		$this->produk->EditCustomAttributes = "";
		if (!$this->produk->Raw)
			$this->produk->CurrentValue = HtmlDecode($this->produk->CurrentValue);
		$this->produk->EditValue = $this->produk->CurrentValue;
		$this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

		// merek_dagang
		$this->merek_dagang->EditAttrs["class"] = "form-control";
		$this->merek_dagang->EditCustomAttributes = "";
		if (!$this->merek_dagang->Raw)
			$this->merek_dagang->CurrentValue = HtmlDecode($this->merek_dagang->CurrentValue);
		$this->merek_dagang->EditValue = $this->merek_dagang->CurrentValue;
		$this->merek_dagang->PlaceHolder = RemoveHtml($this->merek_dagang->caption());

		// jenis_perusahaan
		$this->jenis_perusahaan->EditAttrs["class"] = "form-control";
		$this->jenis_perusahaan->EditCustomAttributes = "";
		if (!$this->jenis_perusahaan->Raw)
			$this->jenis_perusahaan->CurrentValue = HtmlDecode($this->jenis_perusahaan->CurrentValue);
		$this->jenis_perusahaan->EditValue = $this->jenis_perusahaan->CurrentValue;
		$this->jenis_perusahaan->PlaceHolder = RemoveHtml($this->jenis_perusahaan->caption());

		// kapasitas_produksi
		$this->kapasitas_produksi->EditAttrs["class"] = "form-control";
		$this->kapasitas_produksi->EditCustomAttributes = "";
		if (!$this->kapasitas_produksi->Raw)
			$this->kapasitas_produksi->CurrentValue = HtmlDecode($this->kapasitas_produksi->CurrentValue);
		$this->kapasitas_produksi->EditValue = $this->kapasitas_produksi->CurrentValue;
		$this->kapasitas_produksi->PlaceHolder = RemoveHtml($this->kapasitas_produksi->caption());

		// omset
		$this->omset->EditAttrs["class"] = "form-control";
		$this->omset->EditCustomAttributes = "";
		if (!$this->omset->Raw)
			$this->omset->CurrentValue = HtmlDecode($this->omset->CurrentValue);
		$this->omset->EditValue = $this->omset->CurrentValue;
		$this->omset->PlaceHolder = RemoveHtml($this->omset->caption());

		// website
		$this->website->EditAttrs["class"] = "form-control";
		$this->website->EditCustomAttributes = "";
		if (!$this->website->Raw)
			$this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
		$this->website->EditValue = $this->website->CurrentValue;
		$this->website->PlaceHolder = RemoveHtml($this->website->caption());

		// fb
		$this->fb->EditAttrs["class"] = "form-control";
		$this->fb->EditCustomAttributes = "";
		if (!$this->fb->Raw)
			$this->fb->CurrentValue = HtmlDecode($this->fb->CurrentValue);
		$this->fb->EditValue = $this->fb->CurrentValue;
		$this->fb->PlaceHolder = RemoveHtml($this->fb->caption());

		// ig
		$this->ig->EditAttrs["class"] = "form-control";
		$this->ig->EditCustomAttributes = "";
		if (!$this->ig->Raw)
			$this->ig->CurrentValue = HtmlDecode($this->ig->CurrentValue);
		$this->ig->EditValue = $this->ig->CurrentValue;
		$this->ig->PlaceHolder = RemoveHtml($this->ig->caption());

		// sosmed_lain
		$this->sosmed_lain->EditAttrs["class"] = "form-control";
		$this->sosmed_lain->EditCustomAttributes = "";
		if (!$this->sosmed_lain->Raw)
			$this->sosmed_lain->CurrentValue = HtmlDecode($this->sosmed_lain->CurrentValue);
		$this->sosmed_lain->EditValue = $this->sosmed_lain->CurrentValue;
		$this->sosmed_lain->PlaceHolder = RemoveHtml($this->sosmed_lain->caption());

		// jml_pegawai
		$this->jml_pegawai->EditAttrs["class"] = "form-control";
		$this->jml_pegawai->EditCustomAttributes = "";
		$this->jml_pegawai->EditValue = $this->jml_pegawai->options(TRUE);

		// jml_pegawai2
		$this->jml_pegawai2->EditAttrs["class"] = "form-control";
		$this->jml_pegawai2->EditCustomAttributes = "";
		if (!$this->jml_pegawai2->Raw)
			$this->jml_pegawai2->CurrentValue = HtmlDecode($this->jml_pegawai2->CurrentValue);
		$this->jml_pegawai2->EditValue = $this->jml_pegawai2->CurrentValue;
		$this->jml_pegawai2->PlaceHolder = RemoveHtml($this->jml_pegawai2->caption());

		// jml_pegawai_tidaktetap
		$this->jml_pegawai_tidaktetap->EditAttrs["class"] = "form-control";
		$this->jml_pegawai_tidaktetap->EditCustomAttributes = "";
		if (!$this->jml_pegawai_tidaktetap->Raw)
			$this->jml_pegawai_tidaktetap->CurrentValue = HtmlDecode($this->jml_pegawai_tidaktetap->CurrentValue);
		$this->jml_pegawai_tidaktetap->EditValue = $this->jml_pegawai_tidaktetap->CurrentValue;
		$this->jml_pegawai_tidaktetap->PlaceHolder = RemoveHtml($this->jml_pegawai_tidaktetap->caption());

		// legalitas
		$this->legalitas->EditCustomAttributes = "";
		$this->legalitas->EditValue = $this->legalitas->options(FALSE);

		// legalitas_lain
		$this->legalitas_lain->EditAttrs["class"] = "form-control";
		$this->legalitas_lain->EditCustomAttributes = "";
		if (!$this->legalitas_lain->Raw)
			$this->legalitas_lain->CurrentValue = HtmlDecode($this->legalitas_lain->CurrentValue);
		$this->legalitas_lain->EditValue = $this->legalitas_lain->CurrentValue;
		$this->legalitas_lain->PlaceHolder = RemoveHtml($this->legalitas_lain->caption());

		// f_npwp
		$this->f_npwp->EditAttrs["class"] = "form-control";
		$this->f_npwp->EditCustomAttributes = "";
		$this->f_npwp->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_npwp->Upload->DbValue)) {
			$this->f_npwp->EditValue = $this->f_npwp->Upload->DbValue;
		} else {
			$this->f_npwp->EditValue = "";
		}
		if (!EmptyValue($this->f_npwp->CurrentValue))
				$this->f_npwp->Upload->FileName = $this->f_npwp->CurrentValue;

		// f_nib
		$this->f_nib->EditAttrs["class"] = "form-control";
		$this->f_nib->EditCustomAttributes = "";
		$this->f_nib->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_nib->Upload->DbValue)) {
			$this->f_nib->EditValue = $this->f_nib->Upload->DbValue;
		} else {
			$this->f_nib->EditValue = "";
		}
		if (!EmptyValue($this->f_nib->CurrentValue))
				$this->f_nib->Upload->FileName = $this->f_nib->CurrentValue;

		// f_siup
		$this->f_siup->EditAttrs["class"] = "form-control";
		$this->f_siup->EditCustomAttributes = "";
		$this->f_siup->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_siup->Upload->DbValue)) {
			$this->f_siup->EditValue = $this->f_siup->Upload->DbValue;
		} else {
			$this->f_siup->EditValue = "";
		}
		if (!EmptyValue($this->f_siup->CurrentValue))
				$this->f_siup->Upload->FileName = $this->f_siup->CurrentValue;

		// f_tdp
		$this->f_tdp->EditAttrs["class"] = "form-control";
		$this->f_tdp->EditCustomAttributes = "";
		$this->f_tdp->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_tdp->Upload->DbValue)) {
			$this->f_tdp->EditValue = $this->f_tdp->Upload->DbValue;
		} else {
			$this->f_tdp->EditValue = "";
		}
		if (!EmptyValue($this->f_tdp->CurrentValue))
				$this->f_tdp->Upload->FileName = $this->f_tdp->CurrentValue;

		// f_lain
		$this->f_lain->EditAttrs["class"] = "form-control";
		$this->f_lain->EditCustomAttributes = "";
		$this->f_lain->UploadPath = "berkas/legalitas_ecp/";
		if (!EmptyValue($this->f_lain->Upload->DbValue)) {
			$this->f_lain->EditValue = $this->f_lain->Upload->DbValue;
		} else {
			$this->f_lain->EditValue = "";
		}
		if (!EmptyValue($this->f_lain->CurrentValue))
				$this->f_lain->Upload->FileName = $this->f_lain->CurrentValue;

		// sertifikat
		$this->sertifikat->EditCustomAttributes = "";
		$this->sertifikat->EditValue = $this->sertifikat->options(FALSE);

		// sertifikat_lain
		$this->sertifikat_lain->EditAttrs["class"] = "form-control";
		$this->sertifikat_lain->EditCustomAttributes = "";
		if (!$this->sertifikat_lain->Raw)
			$this->sertifikat_lain->CurrentValue = HtmlDecode($this->sertifikat_lain->CurrentValue);
		$this->sertifikat_lain->EditValue = $this->sertifikat_lain->CurrentValue;
		$this->sertifikat_lain->PlaceHolder = RemoveHtml($this->sertifikat_lain->caption());

		// f_sertifikat
		$this->f_sertifikat->EditAttrs["class"] = "form-control";
		$this->f_sertifikat->EditCustomAttributes = "";
		$this->f_sertifikat->UploadPath = "berkas/sertifikat_ecp/";
		if (!EmptyValue($this->f_sertifikat->Upload->DbValue)) {
			$this->f_sertifikat->EditValue = $this->f_sertifikat->Upload->DbValue;
		} else {
			$this->f_sertifikat->EditValue = "";
		}
		if (!EmptyValue($this->f_sertifikat->CurrentValue))
				$this->f_sertifikat->Upload->FileName = $this->f_sertifikat->CurrentValue;

		// alat_promosi
		$this->alat_promosi->EditCustomAttributes = "";
		$this->alat_promosi->EditValue = $this->alat_promosi->options(FALSE);

		// promosi_lain
		$this->promosi_lain->EditAttrs["class"] = "form-control";
		$this->promosi_lain->EditCustomAttributes = "";
		if (!$this->promosi_lain->Raw)
			$this->promosi_lain->CurrentValue = HtmlDecode($this->promosi_lain->CurrentValue);
		$this->promosi_lain->EditValue = $this->promosi_lain->CurrentValue;
		$this->promosi_lain->PlaceHolder = RemoveHtml($this->promosi_lain->caption());

		// f_kartunama
		$this->f_kartunama->EditAttrs["class"] = "form-control";
		$this->f_kartunama->EditCustomAttributes = "";
		$this->f_kartunama->UploadPath = "berkas/promosi_ecp/";
		if (!EmptyValue($this->f_kartunama->Upload->DbValue)) {
			$this->f_kartunama->EditValue = $this->f_kartunama->Upload->DbValue;
		} else {
			$this->f_kartunama->EditValue = "";
		}
		if (!EmptyValue($this->f_kartunama->CurrentValue))
				$this->f_kartunama->Upload->FileName = $this->f_kartunama->CurrentValue;

		// f_brosur
		$this->f_brosur->EditAttrs["class"] = "form-control";
		$this->f_brosur->EditCustomAttributes = "";
		$this->f_brosur->UploadPath = "berkas/promosi_ecp/";
		if (!EmptyValue($this->f_brosur->Upload->DbValue)) {
			$this->f_brosur->EditValue = $this->f_brosur->Upload->DbValue;
		} else {
			$this->f_brosur->EditValue = "";
		}
		if (!EmptyValue($this->f_brosur->CurrentValue))
				$this->f_brosur->Upload->FileName = $this->f_brosur->CurrentValue;

		// f_katalog
		$this->f_katalog->EditAttrs["class"] = "form-control";
		$this->f_katalog->EditCustomAttributes = "";
		$this->f_katalog->UploadPath = "berkas/promosi_ecp/";
		if (!EmptyValue($this->f_katalog->Upload->DbValue)) {
			$this->f_katalog->EditValue = $this->f_katalog->Upload->DbValue;
		} else {
			$this->f_katalog->EditValue = "";
		}
		if (!EmptyValue($this->f_katalog->CurrentValue))
				$this->f_katalog->Upload->FileName = $this->f_katalog->CurrentValue;

		// f_profile
		$this->f_profile->EditAttrs["class"] = "form-control";
		$this->f_profile->EditCustomAttributes = "";
		$this->f_profile->UploadPath = "berkas/promosi_ecp/";
		if (!EmptyValue($this->f_profile->Upload->DbValue)) {
			$this->f_profile->EditValue = $this->f_profile->Upload->DbValue;
		} else {
			$this->f_profile->EditValue = "";
		}
		if (!EmptyValue($this->f_profile->CurrentValue))
				$this->f_profile->Upload->FileName = $this->f_profile->CurrentValue;

		// tahun_ecp
		$this->tahun_ecp->EditAttrs["class"] = "form-control";
		$this->tahun_ecp->EditCustomAttributes = "";
		$this->tahun_ecp->EditValue = $this->tahun_ecp->CurrentValue;
		$this->tahun_ecp->PlaceHolder = RemoveHtml($this->tahun_ecp->caption());

		// wilayah_ecp
		$this->wilayah_ecp->EditAttrs["class"] = "form-control";
		$this->wilayah_ecp->EditCustomAttributes = "";
		if (!$this->wilayah_ecp->Raw)
			$this->wilayah_ecp->CurrentValue = HtmlDecode($this->wilayah_ecp->CurrentValue);
		$this->wilayah_ecp->EditValue = $this->wilayah_ecp->CurrentValue;
		$this->wilayah_ecp->PlaceHolder = RemoveHtml($this->wilayah_ecp->caption());

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
					$doc->exportCaption($this->nama_peserta);
					$doc->exportCaption($this->email_add);
					$doc->exportCaption($this->handphone);
					$doc->exportCaption($this->namap);
					$doc->exportCaption($this->tahun_berdiri);
					$doc->exportCaption($this->alamat);
					$doc->exportCaption($this->alamat_prod);
					$doc->exportCaption($this->kategori_produk);
					$doc->exportCaption($this->kategori_produk2);
					$doc->exportCaption($this->kategori_produk3);
					$doc->exportCaption($this->produk);
					$doc->exportCaption($this->merek_dagang);
					$doc->exportCaption($this->jenis_perusahaan);
					$doc->exportCaption($this->kapasitas_produksi);
					$doc->exportCaption($this->omset);
					$doc->exportCaption($this->website);
					$doc->exportCaption($this->fb);
					$doc->exportCaption($this->ig);
					$doc->exportCaption($this->sosmed_lain);
					$doc->exportCaption($this->jml_pegawai);
					$doc->exportCaption($this->jml_pegawai2);
					$doc->exportCaption($this->jml_pegawai_tidaktetap);
					$doc->exportCaption($this->legalitas);
					$doc->exportCaption($this->legalitas_lain);
					$doc->exportCaption($this->f_npwp);
					$doc->exportCaption($this->f_nib);
					$doc->exportCaption($this->f_siup);
					$doc->exportCaption($this->f_tdp);
					$doc->exportCaption($this->f_lain);
					$doc->exportCaption($this->sertifikat);
					$doc->exportCaption($this->sertifikat_lain);
					$doc->exportCaption($this->f_sertifikat);
					$doc->exportCaption($this->alat_promosi);
					$doc->exportCaption($this->promosi_lain);
					$doc->exportCaption($this->f_kartunama);
					$doc->exportCaption($this->f_brosur);
					$doc->exportCaption($this->f_katalog);
					$doc->exportCaption($this->f_profile);
					$doc->exportCaption($this->tahun_ecp);
					$doc->exportCaption($this->wilayah_ecp);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->rkid);
					$doc->exportCaption($this->nama_peserta);
					$doc->exportCaption($this->email_add);
					$doc->exportCaption($this->handphone);
					$doc->exportCaption($this->namap);
					$doc->exportCaption($this->tahun_berdiri);
					$doc->exportCaption($this->alamat_prod);
					$doc->exportCaption($this->kategori_produk);
					$doc->exportCaption($this->kategori_produk2);
					$doc->exportCaption($this->kategori_produk3);
					$doc->exportCaption($this->produk);
					$doc->exportCaption($this->merek_dagang);
					$doc->exportCaption($this->jenis_perusahaan);
					$doc->exportCaption($this->kapasitas_produksi);
					$doc->exportCaption($this->omset);
					$doc->exportCaption($this->website);
					$doc->exportCaption($this->fb);
					$doc->exportCaption($this->ig);
					$doc->exportCaption($this->sosmed_lain);
					$doc->exportCaption($this->jml_pegawai);
					$doc->exportCaption($this->jml_pegawai2);
					$doc->exportCaption($this->jml_pegawai_tidaktetap);
					$doc->exportCaption($this->legalitas);
					$doc->exportCaption($this->legalitas_lain);
					$doc->exportCaption($this->f_npwp);
					$doc->exportCaption($this->f_nib);
					$doc->exportCaption($this->f_siup);
					$doc->exportCaption($this->f_tdp);
					$doc->exportCaption($this->f_lain);
					$doc->exportCaption($this->sertifikat);
					$doc->exportCaption($this->sertifikat_lain);
					$doc->exportCaption($this->f_sertifikat);
					$doc->exportCaption($this->alat_promosi);
					$doc->exportCaption($this->promosi_lain);
					$doc->exportCaption($this->f_kartunama);
					$doc->exportCaption($this->f_brosur);
					$doc->exportCaption($this->f_katalog);
					$doc->exportCaption($this->f_profile);
					$doc->exportCaption($this->tahun_ecp);
					$doc->exportCaption($this->wilayah_ecp);
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
						$doc->exportField($this->nama_peserta);
						$doc->exportField($this->email_add);
						$doc->exportField($this->handphone);
						$doc->exportField($this->namap);
						$doc->exportField($this->tahun_berdiri);
						$doc->exportField($this->alamat);
						$doc->exportField($this->alamat_prod);
						$doc->exportField($this->kategori_produk);
						$doc->exportField($this->kategori_produk2);
						$doc->exportField($this->kategori_produk3);
						$doc->exportField($this->produk);
						$doc->exportField($this->merek_dagang);
						$doc->exportField($this->jenis_perusahaan);
						$doc->exportField($this->kapasitas_produksi);
						$doc->exportField($this->omset);
						$doc->exportField($this->website);
						$doc->exportField($this->fb);
						$doc->exportField($this->ig);
						$doc->exportField($this->sosmed_lain);
						$doc->exportField($this->jml_pegawai);
						$doc->exportField($this->jml_pegawai2);
						$doc->exportField($this->jml_pegawai_tidaktetap);
						$doc->exportField($this->legalitas);
						$doc->exportField($this->legalitas_lain);
						$doc->exportField($this->f_npwp);
						$doc->exportField($this->f_nib);
						$doc->exportField($this->f_siup);
						$doc->exportField($this->f_tdp);
						$doc->exportField($this->f_lain);
						$doc->exportField($this->sertifikat);
						$doc->exportField($this->sertifikat_lain);
						$doc->exportField($this->f_sertifikat);
						$doc->exportField($this->alat_promosi);
						$doc->exportField($this->promosi_lain);
						$doc->exportField($this->f_kartunama);
						$doc->exportField($this->f_brosur);
						$doc->exportField($this->f_katalog);
						$doc->exportField($this->f_profile);
						$doc->exportField($this->tahun_ecp);
						$doc->exportField($this->wilayah_ecp);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->rkid);
						$doc->exportField($this->nama_peserta);
						$doc->exportField($this->email_add);
						$doc->exportField($this->handphone);
						$doc->exportField($this->namap);
						$doc->exportField($this->tahun_berdiri);
						$doc->exportField($this->alamat_prod);
						$doc->exportField($this->kategori_produk);
						$doc->exportField($this->kategori_produk2);
						$doc->exportField($this->kategori_produk3);
						$doc->exportField($this->produk);
						$doc->exportField($this->merek_dagang);
						$doc->exportField($this->jenis_perusahaan);
						$doc->exportField($this->kapasitas_produksi);
						$doc->exportField($this->omset);
						$doc->exportField($this->website);
						$doc->exportField($this->fb);
						$doc->exportField($this->ig);
						$doc->exportField($this->sosmed_lain);
						$doc->exportField($this->jml_pegawai);
						$doc->exportField($this->jml_pegawai2);
						$doc->exportField($this->jml_pegawai_tidaktetap);
						$doc->exportField($this->legalitas);
						$doc->exportField($this->legalitas_lain);
						$doc->exportField($this->f_npwp);
						$doc->exportField($this->f_nib);
						$doc->exportField($this->f_siup);
						$doc->exportField($this->f_tdp);
						$doc->exportField($this->f_lain);
						$doc->exportField($this->sertifikat);
						$doc->exportField($this->sertifikat_lain);
						$doc->exportField($this->f_sertifikat);
						$doc->exportField($this->alat_promosi);
						$doc->exportField($this->promosi_lain);
						$doc->exportField($this->f_kartunama);
						$doc->exportField($this->f_brosur);
						$doc->exportField($this->f_katalog);
						$doc->exportField($this->f_profile);
						$doc->exportField($this->tahun_ecp);
						$doc->exportField($this->wilayah_ecp);
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
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'f_npwp') {
			$fldName = "f_npwp";
			$fileNameFld = "f_npwp";
		} elseif ($fldparm == 'f_nib') {
			$fldName = "f_nib";
			$fileNameFld = "f_nib";
		} elseif ($fldparm == 'f_siup') {
			$fldName = "f_siup";
			$fileNameFld = "f_siup";
		} elseif ($fldparm == 'f_tdp') {
			$fldName = "f_tdp";
			$fileNameFld = "f_tdp";
		} elseif ($fldparm == 'f_lain') {
			$fldName = "f_lain";
			$fileNameFld = "f_lain";
		} elseif ($fldparm == 'f_sertifikat') {
			$fldName = "f_sertifikat";
			$fileNameFld = "f_sertifikat";
		} elseif ($fldparm == 'f_kartunama') {
			$fldName = "f_kartunama";
			$fileNameFld = "f_kartunama";
		} elseif ($fldparm == 'f_brosur') {
			$fldName = "f_brosur";
			$fileNameFld = "f_brosur";
		} elseif ($fldparm == 'f_katalog') {
			$fldName = "f_katalog";
			$fileNameFld = "f_katalog";
		} elseif ($fldparm == 'f_profile') {
			$fldName = "f_profile";
			$fileNameFld = "f_profile";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->id->CurrentValue = $ar[0];
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
		$table = 't_pcp';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_pcp';

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
		$table = 't_pcp';

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
		$table = 't_pcp';

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
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);
		//$lastElement = end(preg_split('/,/', $this->legalitas->ViewValue));

		$this->legalitas->ViewValue = str_replace('Lainnya', $this->legalitas_lain->ViewValue, $this->legalitas->ViewValue);
		$this->sertifikat->ViewValue = str_replace('Lainnya', $this->sertifikat_lain->ViewValue, $this->sertifikat->ViewValue);
		$this->alat_promosi->ViewValue = str_replace('LAINNYA', $this->promosi_lain->ViewValue, $this->alat_promosi->ViewValue);
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>