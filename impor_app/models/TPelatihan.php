<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for t_pelatihan
 */
class TPelatihan extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

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
    public $kdkursil;
    public $revisi;
    public $tgl_terbit;
    public $pilihan_iso;
    public $tawal;
    public $takhir;
    public $ketua;
    public $bendahara;
    public $sekretaris;
    public $anggota2;
    public $widyaiswara;
    public $kdprop;
    public $kdkota;
    public $kdkec;
    public $jenispel;
    public $jenisevaluasi;
    public $kdkategori;
    public $kerjasama;
    public $dana;
    public $biaya;
    public $tempat;
    public $target_peserta;
    public $durasi1;
    public $durasi2;
    public $coachingprogr;
    public $area;
    public $periode_awal;
    public $periode_akhir;
    public $tahapan;
    public $namaberkas;
    public $nmou;
    public $nmou2;
    public $statuspel;
    public $ket;
    public $jml_hari;
    public $targetpes;
    public $created_at;
    public $user_created_by;
    public $updated_at;
    public $user_updated_by;
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

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 't_pelatihan';
        $this->TableName = 't_pelatihan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`t_pelatihan`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // idpelat
        $this->idpelat = new DbField('t_pelatihan', 't_pelatihan', 'x_idpelat', 'idpelat', '`idpelat`', '`idpelat`', 3, 11, -1, false, '`idpelat`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->idpelat->IsAutoIncrement = true; // Autoincrement field
        $this->idpelat->IsPrimaryKey = true; // Primary key field
        $this->idpelat->Sortable = true; // Allow sort
        $this->idpelat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->idpelat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idpelat->Param, "CustomMsg");
        $this->Fields['idpelat'] = &$this->idpelat;

        // kdpelat
        $this->kdpelat = new DbField('t_pelatihan', 't_pelatihan', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 20, -1, false, '`kdpelat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdpelat->Nullable = false; // NOT NULL field
        $this->kdpelat->Required = true; // Required field
        $this->kdpelat->Sortable = true; // Allow sort
        $this->kdpelat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdpelat->Param, "CustomMsg");
        $this->Fields['kdpelat'] = &$this->kdpelat;

        // kdjudul
        $this->kdjudul = new DbField('t_pelatihan', 't_pelatihan', 'x_kdjudul', 'kdjudul', '`kdjudul`', '`kdjudul`', 200, 9, -1, false, '`kdjudul`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdjudul->Sortable = true; // Allow sort
        $this->kdjudul->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdjudul->Param, "CustomMsg");
        $this->Fields['kdjudul'] = &$this->kdjudul;

        // kdkursil
        $this->kdkursil = new DbField('t_pelatihan', 't_pelatihan', 'x_kdkursil', 'kdkursil', '`kdkursil`', '`kdkursil`', 200, 12, -1, false, '`kdkursil`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdkursil->Sortable = true; // Allow sort
        $this->kdkursil->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkursil->Param, "CustomMsg");
        $this->Fields['kdkursil'] = &$this->kdkursil;

        // revisi
        $this->revisi = new DbField('t_pelatihan', 't_pelatihan', 'x_revisi', 'revisi', '`revisi`', '`revisi`', 200, 2, -1, false, '`revisi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->revisi->Sortable = true; // Allow sort
        $this->revisi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->revisi->Param, "CustomMsg");
        $this->Fields['revisi'] = &$this->revisi;

        // tgl_terbit
        $this->tgl_terbit = new DbField('t_pelatihan', 't_pelatihan', 'x_tgl_terbit', 'tgl_terbit', '`tgl_terbit`', CastDateFieldForLike("`tgl_terbit`", 0, "DB"), 135, 19, 0, false, '`tgl_terbit`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_terbit->Sortable = true; // Allow sort
        $this->tgl_terbit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl_terbit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_terbit->Param, "CustomMsg");
        $this->Fields['tgl_terbit'] = &$this->tgl_terbit;

        // pilihan_iso
        $this->pilihan_iso = new DbField('t_pelatihan', 't_pelatihan', 'x_pilihan_iso', 'pilihan_iso', '`pilihan_iso`', '`pilihan_iso`', 200, 25, -1, false, '`pilihan_iso`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pilihan_iso->Sortable = true; // Allow sort
        $this->pilihan_iso->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pilihan_iso->Param, "CustomMsg");
        $this->Fields['pilihan_iso'] = &$this->pilihan_iso;

        // tawal
        $this->tawal = new DbField('t_pelatihan', 't_pelatihan', 'x_tawal', 'tawal', '`tawal`', CastDateFieldForLike("`tawal`", 0, "DB"), 135, 19, 0, false, '`tawal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tawal->Sortable = true; // Allow sort
        $this->tawal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tawal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tawal->Param, "CustomMsg");
        $this->Fields['tawal'] = &$this->tawal;

        // takhir
        $this->takhir = new DbField('t_pelatihan', 't_pelatihan', 'x_takhir', 'takhir', '`takhir`', CastDateFieldForLike("`takhir`", 0, "DB"), 135, 19, 0, false, '`takhir`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->takhir->Sortable = true; // Allow sort
        $this->takhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->takhir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->takhir->Param, "CustomMsg");
        $this->Fields['takhir'] = &$this->takhir;

        // ketua
        $this->ketua = new DbField('t_pelatihan', 't_pelatihan', 'x_ketua', 'ketua', '`ketua`', '`ketua`', 200, 40, -1, false, '`ketua`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ketua->Sortable = true; // Allow sort
        $this->ketua->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ketua->Param, "CustomMsg");
        $this->Fields['ketua'] = &$this->ketua;

        // bendahara
        $this->bendahara = new DbField('t_pelatihan', 't_pelatihan', 'x_bendahara', 'bendahara', '`bendahara`', '`bendahara`', 200, 40, -1, false, '`bendahara`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bendahara->Sortable = true; // Allow sort
        $this->bendahara->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bendahara->Param, "CustomMsg");
        $this->Fields['bendahara'] = &$this->bendahara;

        // sekretaris
        $this->sekretaris = new DbField('t_pelatihan', 't_pelatihan', 'x_sekretaris', 'sekretaris', '`sekretaris`', '`sekretaris`', 200, 40, -1, false, '`sekretaris`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sekretaris->Sortable = true; // Allow sort
        $this->sekretaris->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sekretaris->Param, "CustomMsg");
        $this->Fields['sekretaris'] = &$this->sekretaris;

        // anggota2
        $this->anggota2 = new DbField('t_pelatihan', 't_pelatihan', 'x_anggota2', 'anggota2', '`anggota2`', '`anggota2`', 200, 40, -1, false, '`anggota2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->anggota2->Sortable = true; // Allow sort
        $this->anggota2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->anggota2->Param, "CustomMsg");
        $this->Fields['anggota2'] = &$this->anggota2;

        // widyaiswara
        $this->widyaiswara = new DbField('t_pelatihan', 't_pelatihan', 'x_widyaiswara', 'widyaiswara', '`widyaiswara`', '`widyaiswara`', 3, 11, -1, false, '`widyaiswara`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->widyaiswara->Sortable = true; // Allow sort
        $this->widyaiswara->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->widyaiswara->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->widyaiswara->Param, "CustomMsg");
        $this->Fields['widyaiswara'] = &$this->widyaiswara;

        // kdprop
        $this->kdprop = new DbField('t_pelatihan', 't_pelatihan', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, false, '`kdprop`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdprop->Sortable = true; // Allow sort
        $this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdprop->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdprop->Param, "CustomMsg");
        $this->Fields['kdprop'] = &$this->kdprop;

        // kdkota
        $this->kdkota = new DbField('t_pelatihan', 't_pelatihan', 'x_kdkota', 'kdkota', '`kdkota`', '`kdkota`', 3, 11, -1, false, '`kdkota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdkota->Sortable = true; // Allow sort
        $this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkota->Param, "CustomMsg");
        $this->Fields['kdkota'] = &$this->kdkota;

        // kdkec
        $this->kdkec = new DbField('t_pelatihan', 't_pelatihan', 'x_kdkec', 'kdkec', '`kdkec`', '`kdkec`', 3, 11, -1, false, '`kdkec`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdkec->Sortable = true; // Allow sort
        $this->kdkec->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkec->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkec->Param, "CustomMsg");
        $this->Fields['kdkec'] = &$this->kdkec;

        // jenispel
        $this->jenispel = new DbField('t_pelatihan', 't_pelatihan', 'x_jenispel', 'jenispel', '`jenispel`', '`jenispel`', 16, 2, -1, false, '`jenispel`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jenispel->Sortable = true; // Allow sort
        $this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jenispel->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jenispel->Param, "CustomMsg");
        $this->Fields['jenispel'] = &$this->jenispel;

        // jenisevaluasi
        $this->jenisevaluasi = new DbField('t_pelatihan', 't_pelatihan', 'x_jenisevaluasi', 'jenisevaluasi', '`jenisevaluasi`', '`jenisevaluasi`', 200, 25, -1, false, '`jenisevaluasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jenisevaluasi->Nullable = false; // NOT NULL field
        $this->jenisevaluasi->Required = true; // Required field
        $this->jenisevaluasi->Sortable = true; // Allow sort
        $this->jenisevaluasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jenisevaluasi->Param, "CustomMsg");
        $this->Fields['jenisevaluasi'] = &$this->jenisevaluasi;

        // kdkategori
        $this->kdkategori = new DbField('t_pelatihan', 't_pelatihan', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, false, '`kdkategori`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdkategori->Sortable = true; // Allow sort
        $this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkategori->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkategori->Param, "CustomMsg");
        $this->Fields['kdkategori'] = &$this->kdkategori;

        // kerjasama
        $this->kerjasama = new DbField('t_pelatihan', 't_pelatihan', 'x_kerjasama', 'kerjasama', '`kerjasama`', '`kerjasama`', 3, 11, -1, false, '`kerjasama`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kerjasama->Sortable = true; // Allow sort
        $this->kerjasama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kerjasama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kerjasama->Param, "CustomMsg");
        $this->Fields['kerjasama'] = &$this->kerjasama;

        // dana
        $this->dana = new DbField('t_pelatihan', 't_pelatihan', 'x_dana', 'dana', '`dana`', '`dana`', 200, 25, -1, false, '`dana`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dana->Sortable = true; // Allow sort
        $this->dana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dana->Param, "CustomMsg");
        $this->Fields['dana'] = &$this->dana;

        // biaya
        $this->biaya = new DbField('t_pelatihan', 't_pelatihan', 'x_biaya', 'biaya', '`biaya`', '`biaya`', 5, 22, -1, false, '`biaya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->biaya->Sortable = true; // Allow sort
        $this->biaya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->biaya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->biaya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->biaya->Param, "CustomMsg");
        $this->Fields['biaya'] = &$this->biaya;

        // tempat
        $this->tempat = new DbField('t_pelatihan', 't_pelatihan', 'x_tempat', 'tempat', '`tempat`', '`tempat`', 201, 65535, -1, false, '`tempat`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->tempat->Sortable = true; // Allow sort
        $this->tempat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tempat->Param, "CustomMsg");
        $this->Fields['tempat'] = &$this->tempat;

        // target_peserta
        $this->target_peserta = new DbField('t_pelatihan', 't_pelatihan', 'x_target_peserta', 'target_peserta', '`target_peserta`', '`target_peserta`', 201, 65535, -1, false, '`target_peserta`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->target_peserta->Sortable = true; // Allow sort
        $this->target_peserta->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->target_peserta->Param, "CustomMsg");
        $this->Fields['target_peserta'] = &$this->target_peserta;

        // durasi1
        $this->durasi1 = new DbField('t_pelatihan', 't_pelatihan', 'x_durasi1', 'durasi1', '`durasi1`', '`durasi1`', 200, 50, -1, false, '`durasi1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->durasi1->Sortable = true; // Allow sort
        $this->durasi1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->durasi1->Param, "CustomMsg");
        $this->Fields['durasi1'] = &$this->durasi1;

        // durasi2
        $this->durasi2 = new DbField('t_pelatihan', 't_pelatihan', 'x_durasi2', 'durasi2', '`durasi2`', '`durasi2`', 200, 50, -1, false, '`durasi2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->durasi2->Sortable = true; // Allow sort
        $this->durasi2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->durasi2->Param, "CustomMsg");
        $this->Fields['durasi2'] = &$this->durasi2;

        // coachingprogr
        $this->coachingprogr = new DbField('t_pelatihan', 't_pelatihan', 'x_coachingprogr', 'coachingprogr', '`coachingprogr`', '`coachingprogr`', 200, 1, -1, false, '`coachingprogr`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->coachingprogr->Sortable = true; // Allow sort
        $this->coachingprogr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->coachingprogr->Param, "CustomMsg");
        $this->Fields['coachingprogr'] = &$this->coachingprogr;

        // area
        $this->area = new DbField('t_pelatihan', 't_pelatihan', 'x_area', 'area', '`area`', '`area`', 200, 100, -1, false, '`area`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->area->Sortable = true; // Allow sort
        $this->area->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->area->Param, "CustomMsg");
        $this->Fields['area'] = &$this->area;

        // periode_awal
        $this->periode_awal = new DbField('t_pelatihan', 't_pelatihan', 'x_periode_awal', 'periode_awal', '`periode_awal`', '`periode_awal`', 2, 4, -1, false, '`periode_awal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->periode_awal->Sortable = true; // Allow sort
        $this->periode_awal->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->periode_awal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->periode_awal->Param, "CustomMsg");
        $this->Fields['periode_awal'] = &$this->periode_awal;

        // periode_akhir
        $this->periode_akhir = new DbField('t_pelatihan', 't_pelatihan', 'x_periode_akhir', 'periode_akhir', '`periode_akhir`', '`periode_akhir`', 2, 4, -1, false, '`periode_akhir`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->periode_akhir->Sortable = true; // Allow sort
        $this->periode_akhir->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->periode_akhir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->periode_akhir->Param, "CustomMsg");
        $this->Fields['periode_akhir'] = &$this->periode_akhir;

        // tahapan
        $this->tahapan = new DbField('t_pelatihan', 't_pelatihan', 'x_tahapan', 'tahapan', '`tahapan`', '`tahapan`', 2, 3, -1, false, '`tahapan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tahapan->Sortable = true; // Allow sort
        $this->tahapan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->tahapan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tahapan->Param, "CustomMsg");
        $this->Fields['tahapan'] = &$this->tahapan;

        // namaberkas
        $this->namaberkas = new DbField('t_pelatihan', 't_pelatihan', 'x_namaberkas', 'namaberkas', '`namaberkas`', '`namaberkas`', 200, 255, -1, false, '`namaberkas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->namaberkas->Sortable = true; // Allow sort
        $this->namaberkas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->namaberkas->Param, "CustomMsg");
        $this->Fields['namaberkas'] = &$this->namaberkas;

        // nmou
        $this->nmou = new DbField('t_pelatihan', 't_pelatihan', 'x_nmou', 'nmou', '`nmou`', '`nmou`', 200, 255, -1, false, '`nmou`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nmou->Sortable = true; // Allow sort
        $this->nmou->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nmou->Param, "CustomMsg");
        $this->Fields['nmou'] = &$this->nmou;

        // nmou2
        $this->nmou2 = new DbField('t_pelatihan', 't_pelatihan', 'x_nmou2', 'nmou2', '`nmou2`', '`nmou2`', 200, 255, -1, false, '`nmou2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nmou2->Sortable = true; // Allow sort
        $this->nmou2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nmou2->Param, "CustomMsg");
        $this->Fields['nmou2'] = &$this->nmou2;

        // statuspel
        $this->statuspel = new DbField('t_pelatihan', 't_pelatihan', 'x_statuspel', 'statuspel', '`statuspel`', '`statuspel`', 16, 2, -1, false, '`statuspel`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->statuspel->Sortable = true; // Allow sort
        $this->statuspel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->statuspel->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->statuspel->Param, "CustomMsg");
        $this->Fields['statuspel'] = &$this->statuspel;

        // ket
        $this->ket = new DbField('t_pelatihan', 't_pelatihan', 'x_ket', 'ket', '`ket`', '`ket`', 201, 65535, -1, false, '`ket`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ket->Sortable = true; // Allow sort
        $this->ket->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket->Param, "CustomMsg");
        $this->Fields['ket'] = &$this->ket;

        // jml_hari
        $this->jml_hari = new DbField('t_pelatihan', 't_pelatihan', 'x_jml_hari', 'jml_hari', '`jml_hari`', '`jml_hari`', 3, 3, -1, false, '`jml_hari`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jml_hari->Sortable = true; // Allow sort
        $this->jml_hari->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jml_hari->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jml_hari->Param, "CustomMsg");
        $this->Fields['jml_hari'] = &$this->jml_hari;

        // targetpes
        $this->targetpes = new DbField('t_pelatihan', 't_pelatihan', 'x_targetpes', 'targetpes', '`targetpes`', '`targetpes`', 3, 3, -1, false, '`targetpes`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->targetpes->Sortable = true; // Allow sort
        $this->targetpes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->targetpes->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->targetpes->Param, "CustomMsg");
        $this->Fields['targetpes'] = &$this->targetpes;

        // created_at
        $this->created_at = new DbField('t_pelatihan', 't_pelatihan', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, false, '`created_at`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->created_at->Sortable = true; // Allow sort
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_at->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->created_at->Param, "CustomMsg");
        $this->Fields['created_at'] = &$this->created_at;

        // user_created_by
        $this->user_created_by = new DbField('t_pelatihan', 't_pelatihan', 'x_user_created_by', 'user_created_by', '`user_created_by`', '`user_created_by`', 200, 100, -1, false, '`user_created_by`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->user_created_by->Sortable = true; // Allow sort
        $this->user_created_by->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->user_created_by->Param, "CustomMsg");
        $this->Fields['user_created_by'] = &$this->user_created_by;

        // updated_at
        $this->updated_at = new DbField('t_pelatihan', 't_pelatihan', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, false, '`updated_at`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->updated_at->Sortable = true; // Allow sort
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->updated_at->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->updated_at->Param, "CustomMsg");
        $this->Fields['updated_at'] = &$this->updated_at;

        // user_updated_by
        $this->user_updated_by = new DbField('t_pelatihan', 't_pelatihan', 'x_user_updated_by', 'user_updated_by', '`user_updated_by`', '`user_updated_by`', 200, 100, -1, false, '`user_updated_by`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->user_updated_by->Sortable = true; // Allow sort
        $this->user_updated_by->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->user_updated_by->Param, "CustomMsg");
        $this->Fields['user_updated_by'] = &$this->user_updated_by;

        // rid
        $this->rid = new DbField('t_pelatihan', 't_pelatihan', 'x_rid', 'rid', '`rid`', '`rid`', 3, 11, -1, false, '`rid`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rid->Sortable = true; // Allow sort
        $this->rid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rid->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rid->Param, "CustomMsg");
        $this->Fields['rid'] = &$this->rid;

        // real_peserta
        $this->real_peserta = new DbField('t_pelatihan', 't_pelatihan', 'x_real_peserta', 'real_peserta', '`real_peserta`', '`real_peserta`', 3, 3, -1, false, '`real_peserta`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->real_peserta->Sortable = true; // Allow sort
        $this->real_peserta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->real_peserta->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->real_peserta->Param, "CustomMsg");
        $this->Fields['real_peserta'] = &$this->real_peserta;

        // independen
        $this->independen = new DbField('t_pelatihan', 't_pelatihan', 'x_independen', 'independen', '`independen`', '`independen`', 3, 3, -1, false, '`independen`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->independen->Sortable = true; // Allow sort
        $this->independen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->independen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->independen->Param, "CustomMsg");
        $this->Fields['independen'] = &$this->independen;

        // swasta_k
        $this->swasta_k = new DbField('t_pelatihan', 't_pelatihan', 'x_swasta_k', 'swasta_k', '`swasta_k`', '`swasta_k`', 3, 3, -1, false, '`swasta_k`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->swasta_k->Sortable = true; // Allow sort
        $this->swasta_k->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->swasta_k->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->swasta_k->Param, "CustomMsg");
        $this->Fields['swasta_k'] = &$this->swasta_k;

        // swasta_m
        $this->swasta_m = new DbField('t_pelatihan', 't_pelatihan', 'x_swasta_m', 'swasta_m', '`swasta_m`', '`swasta_m`', 3, 3, -1, false, '`swasta_m`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->swasta_m->Sortable = true; // Allow sort
        $this->swasta_m->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->swasta_m->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->swasta_m->Param, "CustomMsg");
        $this->Fields['swasta_m'] = &$this->swasta_m;

        // swasta_b
        $this->swasta_b = new DbField('t_pelatihan', 't_pelatihan', 'x_swasta_b', 'swasta_b', '`swasta_b`', '`swasta_b`', 3, 3, -1, false, '`swasta_b`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->swasta_b->Sortable = true; // Allow sort
        $this->swasta_b->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->swasta_b->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->swasta_b->Param, "CustomMsg");
        $this->Fields['swasta_b'] = &$this->swasta_b;

        // bumn
        $this->bumn = new DbField('t_pelatihan', 't_pelatihan', 'x_bumn', 'bumn', '`bumn`', '`bumn`', 3, 3, -1, false, '`bumn`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bumn->Sortable = true; // Allow sort
        $this->bumn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bumn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bumn->Param, "CustomMsg");
        $this->Fields['bumn'] = &$this->bumn;

        // koperasi
        $this->koperasi = new DbField('t_pelatihan', 't_pelatihan', 'x_koperasi', 'koperasi', '`koperasi`', '`koperasi`', 3, 3, -1, false, '`koperasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->koperasi->Sortable = true; // Allow sort
        $this->koperasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->koperasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->koperasi->Param, "CustomMsg");
        $this->Fields['koperasi'] = &$this->koperasi;

        // pns
        $this->pns = new DbField('t_pelatihan', 't_pelatihan', 'x_pns', 'pns', '`pns`', '`pns`', 3, 3, -1, false, '`pns`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pns->Sortable = true; // Allow sort
        $this->pns->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pns->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pns->Param, "CustomMsg");
        $this->Fields['pns'] = &$this->pns;

        // pt_dosen
        $this->pt_dosen = new DbField('t_pelatihan', 't_pelatihan', 'x_pt_dosen', 'pt_dosen', '`pt_dosen`', '`pt_dosen`', 3, 3, -1, false, '`pt_dosen`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pt_dosen->Sortable = true; // Allow sort
        $this->pt_dosen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pt_dosen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pt_dosen->Param, "CustomMsg");
        $this->Fields['pt_dosen'] = &$this->pt_dosen;

        // pt_mhs
        $this->pt_mhs = new DbField('t_pelatihan', 't_pelatihan', 'x_pt_mhs', 'pt_mhs', '`pt_mhs`', '`pt_mhs`', 3, 3, -1, false, '`pt_mhs`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pt_mhs->Sortable = true; // Allow sort
        $this->pt_mhs->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pt_mhs->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pt_mhs->Param, "CustomMsg");
        $this->Fields['pt_mhs'] = &$this->pt_mhs;

        // jk_l
        $this->jk_l = new DbField('t_pelatihan', 't_pelatihan', 'x_jk_l', 'jk_l', '`jk_l`', '`jk_l`', 3, 3, -1, false, '`jk_l`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jk_l->Sortable = true; // Allow sort
        $this->jk_l->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jk_l->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jk_l->Param, "CustomMsg");
        $this->Fields['jk_l'] = &$this->jk_l;

        // jk_p
        $this->jk_p = new DbField('t_pelatihan', 't_pelatihan', 'x_jk_p', 'jk_p', '`jk_p`', '`jk_p`', 3, 3, -1, false, '`jk_p`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jk_p->Sortable = true; // Allow sort
        $this->jk_p->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jk_p->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jk_p->Param, "CustomMsg");
        $this->Fields['jk_p'] = &$this->jk_p;

        // usia_k45
        $this->usia_k45 = new DbField('t_pelatihan', 't_pelatihan', 'x_usia_k45', 'usia_k45', '`usia_k45`', '`usia_k45`', 3, 3, -1, false, '`usia_k45`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->usia_k45->Sortable = true; // Allow sort
        $this->usia_k45->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->usia_k45->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->usia_k45->Param, "CustomMsg");
        $this->Fields['usia_k45'] = &$this->usia_k45;

        // usia_b45
        $this->usia_b45 = new DbField('t_pelatihan', 't_pelatihan', 'x_usia_b45', 'usia_b45', '`usia_b45`', '`usia_b45`', 3, 3, -1, false, '`usia_b45`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->usia_b45->Sortable = true; // Allow sort
        $this->usia_b45->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->usia_b45->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->usia_b45->Param, "CustomMsg");
        $this->Fields['usia_b45'] = &$this->usia_b45;

        // produk
        $this->produk = new DbField('t_pelatihan', 't_pelatihan', 'x_produk', 'produk', '`produk`', '`produk`', 201, 65535, -1, false, '`produk`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->produk->Sortable = true; // Allow sort
        $this->produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk->Param, "CustomMsg");
        $this->Fields['produk'] = &$this->produk;

        // bbio
        $this->bbio = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio', 'bbio', '`bbio`', '`bbio`', 200, 255, -1, false, '`bbio`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bbio->Sortable = true; // Allow sort
        $this->bbio->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bbio->Param, "CustomMsg");
        $this->Fields['bbio'] = &$this->bbio;

        // bbio2
        $this->bbio2 = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio2', 'bbio2', '`bbio2`', '`bbio2`', 200, 255, -1, false, '`bbio2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bbio2->Sortable = true; // Allow sort
        $this->bbio2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bbio2->Param, "CustomMsg");
        $this->Fields['bbio2'] = &$this->bbio2;

        // bbio3
        $this->bbio3 = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio3', 'bbio3', '`bbio3`', '`bbio3`', 200, 255, -1, false, '`bbio3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bbio3->Sortable = true; // Allow sort
        $this->bbio3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bbio3->Param, "CustomMsg");
        $this->Fields['bbio3'] = &$this->bbio3;

        // bbio4
        $this->bbio4 = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio4', 'bbio4', '`bbio4`', '`bbio4`', 200, 255, -1, false, '`bbio4`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bbio4->Sortable = true; // Allow sort
        $this->bbio4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bbio4->Param, "CustomMsg");
        $this->Fields['bbio4'] = &$this->bbio4;

        // bbio5
        $this->bbio5 = new DbField('t_pelatihan', 't_pelatihan', 'x_bbio5', 'bbio5', '`bbio5`', '`bbio5`', 200, 255, -1, false, '`bbio5`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bbio5->Sortable = true; // Allow sort
        $this->bbio5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bbio5->Param, "CustomMsg");
        $this->Fields['bbio5'] = &$this->bbio5;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
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
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
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
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
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
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
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
    public function applyUserIDFilters($filter)
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
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
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
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->idpelat->setDbValue($conn->lastInsertId());
            $rs['idpelat'] = $this->idpelat->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('idpelat', $rs)) {
                AddFilter($where, QuotedName('idpelat', $this->Dbid) . '=' . QuotedValue($rs['idpelat'], $this->idpelat->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->idpelat->DbValue = $row['idpelat'];
        $this->kdpelat->DbValue = $row['kdpelat'];
        $this->kdjudul->DbValue = $row['kdjudul'];
        $this->kdkursil->DbValue = $row['kdkursil'];
        $this->revisi->DbValue = $row['revisi'];
        $this->tgl_terbit->DbValue = $row['tgl_terbit'];
        $this->pilihan_iso->DbValue = $row['pilihan_iso'];
        $this->tawal->DbValue = $row['tawal'];
        $this->takhir->DbValue = $row['takhir'];
        $this->ketua->DbValue = $row['ketua'];
        $this->bendahara->DbValue = $row['bendahara'];
        $this->sekretaris->DbValue = $row['sekretaris'];
        $this->anggota2->DbValue = $row['anggota2'];
        $this->widyaiswara->DbValue = $row['widyaiswara'];
        $this->kdprop->DbValue = $row['kdprop'];
        $this->kdkota->DbValue = $row['kdkota'];
        $this->kdkec->DbValue = $row['kdkec'];
        $this->jenispel->DbValue = $row['jenispel'];
        $this->jenisevaluasi->DbValue = $row['jenisevaluasi'];
        $this->kdkategori->DbValue = $row['kdkategori'];
        $this->kerjasama->DbValue = $row['kerjasama'];
        $this->dana->DbValue = $row['dana'];
        $this->biaya->DbValue = $row['biaya'];
        $this->tempat->DbValue = $row['tempat'];
        $this->target_peserta->DbValue = $row['target_peserta'];
        $this->durasi1->DbValue = $row['durasi1'];
        $this->durasi2->DbValue = $row['durasi2'];
        $this->coachingprogr->DbValue = $row['coachingprogr'];
        $this->area->DbValue = $row['area'];
        $this->periode_awal->DbValue = $row['periode_awal'];
        $this->periode_akhir->DbValue = $row['periode_akhir'];
        $this->tahapan->DbValue = $row['tahapan'];
        $this->namaberkas->DbValue = $row['namaberkas'];
        $this->nmou->DbValue = $row['nmou'];
        $this->nmou2->DbValue = $row['nmou2'];
        $this->statuspel->DbValue = $row['statuspel'];
        $this->ket->DbValue = $row['ket'];
        $this->jml_hari->DbValue = $row['jml_hari'];
        $this->targetpes->DbValue = $row['targetpes'];
        $this->created_at->DbValue = $row['created_at'];
        $this->user_created_by->DbValue = $row['user_created_by'];
        $this->updated_at->DbValue = $row['updated_at'];
        $this->user_updated_by->DbValue = $row['user_updated_by'];
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
        $this->bbio->DbValue = $row['bbio'];
        $this->bbio2->DbValue = $row['bbio2'];
        $this->bbio3->DbValue = $row['bbio3'];
        $this->bbio4->DbValue = $row['bbio4'];
        $this->bbio5->DbValue = $row['bbio5'];
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

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->idpelat->CurrentValue : $this->idpelat->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->idpelat->CurrentValue = $keys[0];
            } else {
                $this->idpelat->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('idpelat', $row) ? $row['idpelat'] : null;
        } else {
            $val = $this->idpelat->OldValue !== null ? $this->idpelat->OldValue : $this->idpelat->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@idpelat@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("tpelatihanlist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "tpelatihanview") {
            return $Language->phrase("View");
        } elseif ($pageName == "tpelatihanedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "tpelatihanadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "TPelatihanView";
            case Config("API_ADD_ACTION"):
                return "TPelatihanAdd";
            case Config("API_EDIT_ACTION"):
                return "TPelatihanEdit";
            case Config("API_DELETE_ACTION"):
                return "TPelatihanDelete";
            case Config("API_LIST_ACTION"):
                return "TPelatihanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "tpelatihanlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("tpelatihanview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("tpelatihanview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "tpelatihanadd?" . $this->getUrlParm($parm);
        } else {
            $url = "tpelatihanadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("tpelatihanedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("tpelatihanadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("tpelatihandelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "idpelat:" . JsonEncode($this->idpelat->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->idpelat->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->idpelat->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
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
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("idpelat") ?? Route("idpelat")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->idpelat->CurrentValue = $key;
            } else {
                $this->idpelat->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->idpelat->setDbValue($row['idpelat']);
        $this->kdpelat->setDbValue($row['kdpelat']);
        $this->kdjudul->setDbValue($row['kdjudul']);
        $this->kdkursil->setDbValue($row['kdkursil']);
        $this->revisi->setDbValue($row['revisi']);
        $this->tgl_terbit->setDbValue($row['tgl_terbit']);
        $this->pilihan_iso->setDbValue($row['pilihan_iso']);
        $this->tawal->setDbValue($row['tawal']);
        $this->takhir->setDbValue($row['takhir']);
        $this->ketua->setDbValue($row['ketua']);
        $this->bendahara->setDbValue($row['bendahara']);
        $this->sekretaris->setDbValue($row['sekretaris']);
        $this->anggota2->setDbValue($row['anggota2']);
        $this->widyaiswara->setDbValue($row['widyaiswara']);
        $this->kdprop->setDbValue($row['kdprop']);
        $this->kdkota->setDbValue($row['kdkota']);
        $this->kdkec->setDbValue($row['kdkec']);
        $this->jenispel->setDbValue($row['jenispel']);
        $this->jenisevaluasi->setDbValue($row['jenisevaluasi']);
        $this->kdkategori->setDbValue($row['kdkategori']);
        $this->kerjasama->setDbValue($row['kerjasama']);
        $this->dana->setDbValue($row['dana']);
        $this->biaya->setDbValue($row['biaya']);
        $this->tempat->setDbValue($row['tempat']);
        $this->target_peserta->setDbValue($row['target_peserta']);
        $this->durasi1->setDbValue($row['durasi1']);
        $this->durasi2->setDbValue($row['durasi2']);
        $this->coachingprogr->setDbValue($row['coachingprogr']);
        $this->area->setDbValue($row['area']);
        $this->periode_awal->setDbValue($row['periode_awal']);
        $this->periode_akhir->setDbValue($row['periode_akhir']);
        $this->tahapan->setDbValue($row['tahapan']);
        $this->namaberkas->setDbValue($row['namaberkas']);
        $this->nmou->setDbValue($row['nmou']);
        $this->nmou2->setDbValue($row['nmou2']);
        $this->statuspel->setDbValue($row['statuspel']);
        $this->ket->setDbValue($row['ket']);
        $this->jml_hari->setDbValue($row['jml_hari']);
        $this->targetpes->setDbValue($row['targetpes']);
        $this->created_at->setDbValue($row['created_at']);
        $this->user_created_by->setDbValue($row['user_created_by']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->user_updated_by->setDbValue($row['user_updated_by']);
        $this->rid->setDbValue($row['rid']);
        $this->real_peserta->setDbValue($row['real_peserta']);
        $this->independen->setDbValue($row['independen']);
        $this->swasta_k->setDbValue($row['swasta_k']);
        $this->swasta_m->setDbValue($row['swasta_m']);
        $this->swasta_b->setDbValue($row['swasta_b']);
        $this->bumn->setDbValue($row['bumn']);
        $this->koperasi->setDbValue($row['koperasi']);
        $this->pns->setDbValue($row['pns']);
        $this->pt_dosen->setDbValue($row['pt_dosen']);
        $this->pt_mhs->setDbValue($row['pt_mhs']);
        $this->jk_l->setDbValue($row['jk_l']);
        $this->jk_p->setDbValue($row['jk_p']);
        $this->usia_k45->setDbValue($row['usia_k45']);
        $this->usia_b45->setDbValue($row['usia_b45']);
        $this->produk->setDbValue($row['produk']);
        $this->bbio->setDbValue($row['bbio']);
        $this->bbio2->setDbValue($row['bbio2']);
        $this->bbio3->setDbValue($row['bbio3']);
        $this->bbio4->setDbValue($row['bbio4']);
        $this->bbio5->setDbValue($row['bbio5']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

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

        // ketua

        // bendahara

        // sekretaris

        // anggota2

        // widyaiswara

        // kdprop

        // kdkota

        // kdkec

        // jenispel

        // jenisevaluasi

        // kdkategori

        // kerjasama

        // dana

        // biaya

        // tempat

        // target_peserta

        // durasi1

        // durasi2

        // coachingprogr

        // area

        // periode_awal

        // periode_akhir

        // tahapan

        // namaberkas

        // nmou

        // nmou2

        // statuspel

        // ket

        // jml_hari

        // targetpes

        // created_at

        // user_created_by

        // updated_at

        // user_updated_by

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

        // idpelat
        $this->idpelat->ViewValue = $this->idpelat->CurrentValue;
        $this->idpelat->ViewCustomAttributes = "";

        // kdpelat
        $this->kdpelat->ViewValue = $this->kdpelat->CurrentValue;
        $this->kdpelat->ViewCustomAttributes = "";

        // kdjudul
        $this->kdjudul->ViewValue = $this->kdjudul->CurrentValue;
        $this->kdjudul->ViewCustomAttributes = "";

        // kdkursil
        $this->kdkursil->ViewValue = $this->kdkursil->CurrentValue;
        $this->kdkursil->ViewCustomAttributes = "";

        // revisi
        $this->revisi->ViewValue = $this->revisi->CurrentValue;
        $this->revisi->ViewCustomAttributes = "";

        // tgl_terbit
        $this->tgl_terbit->ViewValue = $this->tgl_terbit->CurrentValue;
        $this->tgl_terbit->ViewValue = FormatDateTime($this->tgl_terbit->ViewValue, 0);
        $this->tgl_terbit->ViewCustomAttributes = "";

        // pilihan_iso
        $this->pilihan_iso->ViewValue = $this->pilihan_iso->CurrentValue;
        $this->pilihan_iso->ViewCustomAttributes = "";

        // tawal
        $this->tawal->ViewValue = $this->tawal->CurrentValue;
        $this->tawal->ViewValue = FormatDateTime($this->tawal->ViewValue, 0);
        $this->tawal->ViewCustomAttributes = "";

        // takhir
        $this->takhir->ViewValue = $this->takhir->CurrentValue;
        $this->takhir->ViewValue = FormatDateTime($this->takhir->ViewValue, 0);
        $this->takhir->ViewCustomAttributes = "";

        // ketua
        $this->ketua->ViewValue = $this->ketua->CurrentValue;
        $this->ketua->ViewCustomAttributes = "";

        // bendahara
        $this->bendahara->ViewValue = $this->bendahara->CurrentValue;
        $this->bendahara->ViewCustomAttributes = "";

        // sekretaris
        $this->sekretaris->ViewValue = $this->sekretaris->CurrentValue;
        $this->sekretaris->ViewCustomAttributes = "";

        // anggota2
        $this->anggota2->ViewValue = $this->anggota2->CurrentValue;
        $this->anggota2->ViewCustomAttributes = "";

        // widyaiswara
        $this->widyaiswara->ViewValue = $this->widyaiswara->CurrentValue;
        $this->widyaiswara->ViewValue = FormatNumber($this->widyaiswara->ViewValue, 0, -2, -2, -2);
        $this->widyaiswara->ViewCustomAttributes = "";

        // kdprop
        $this->kdprop->ViewValue = $this->kdprop->CurrentValue;
        $this->kdprop->ViewValue = FormatNumber($this->kdprop->ViewValue, 0, -2, -2, -2);
        $this->kdprop->ViewCustomAttributes = "";

        // kdkota
        $this->kdkota->ViewValue = $this->kdkota->CurrentValue;
        $this->kdkota->ViewValue = FormatNumber($this->kdkota->ViewValue, 0, -2, -2, -2);
        $this->kdkota->ViewCustomAttributes = "";

        // kdkec
        $this->kdkec->ViewValue = $this->kdkec->CurrentValue;
        $this->kdkec->ViewValue = FormatNumber($this->kdkec->ViewValue, 0, -2, -2, -2);
        $this->kdkec->ViewCustomAttributes = "";

        // jenispel
        $this->jenispel->ViewValue = $this->jenispel->CurrentValue;
        $this->jenispel->ViewValue = FormatNumber($this->jenispel->ViewValue, 0, -2, -2, -2);
        $this->jenispel->ViewCustomAttributes = "";

        // jenisevaluasi
        $this->jenisevaluasi->ViewValue = $this->jenisevaluasi->CurrentValue;
        $this->jenisevaluasi->ViewCustomAttributes = "";

        // kdkategori
        $this->kdkategori->ViewValue = $this->kdkategori->CurrentValue;
        $this->kdkategori->ViewValue = FormatNumber($this->kdkategori->ViewValue, 0, -2, -2, -2);
        $this->kdkategori->ViewCustomAttributes = "";

        // kerjasama
        $this->kerjasama->ViewValue = $this->kerjasama->CurrentValue;
        $this->kerjasama->ViewValue = FormatNumber($this->kerjasama->ViewValue, 0, -2, -2, -2);
        $this->kerjasama->ViewCustomAttributes = "";

        // dana
        $this->dana->ViewValue = $this->dana->CurrentValue;
        $this->dana->ViewCustomAttributes = "";

        // biaya
        $this->biaya->ViewValue = $this->biaya->CurrentValue;
        $this->biaya->ViewValue = FormatNumber($this->biaya->ViewValue, 2, -2, -2, -2);
        $this->biaya->ViewCustomAttributes = "";

        // tempat
        $this->tempat->ViewValue = $this->tempat->CurrentValue;
        $this->tempat->ViewCustomAttributes = "";

        // target_peserta
        $this->target_peserta->ViewValue = $this->target_peserta->CurrentValue;
        $this->target_peserta->ViewCustomAttributes = "";

        // durasi1
        $this->durasi1->ViewValue = $this->durasi1->CurrentValue;
        $this->durasi1->ViewCustomAttributes = "";

        // durasi2
        $this->durasi2->ViewValue = $this->durasi2->CurrentValue;
        $this->durasi2->ViewCustomAttributes = "";

        // coachingprogr
        $this->coachingprogr->ViewValue = $this->coachingprogr->CurrentValue;
        $this->coachingprogr->ViewCustomAttributes = "";

        // area
        $this->area->ViewValue = $this->area->CurrentValue;
        $this->area->ViewCustomAttributes = "";

        // periode_awal
        $this->periode_awal->ViewValue = $this->periode_awal->CurrentValue;
        $this->periode_awal->ViewValue = FormatNumber($this->periode_awal->ViewValue, 0, -2, -2, -2);
        $this->periode_awal->ViewCustomAttributes = "";

        // periode_akhir
        $this->periode_akhir->ViewValue = $this->periode_akhir->CurrentValue;
        $this->periode_akhir->ViewValue = FormatNumber($this->periode_akhir->ViewValue, 0, -2, -2, -2);
        $this->periode_akhir->ViewCustomAttributes = "";

        // tahapan
        $this->tahapan->ViewValue = $this->tahapan->CurrentValue;
        $this->tahapan->ViewValue = FormatNumber($this->tahapan->ViewValue, 0, -2, -2, -2);
        $this->tahapan->ViewCustomAttributes = "";

        // namaberkas
        $this->namaberkas->ViewValue = $this->namaberkas->CurrentValue;
        $this->namaberkas->ViewCustomAttributes = "";

        // nmou
        $this->nmou->ViewValue = $this->nmou->CurrentValue;
        $this->nmou->ViewCustomAttributes = "";

        // nmou2
        $this->nmou2->ViewValue = $this->nmou2->CurrentValue;
        $this->nmou2->ViewCustomAttributes = "";

        // statuspel
        $this->statuspel->ViewValue = $this->statuspel->CurrentValue;
        $this->statuspel->ViewValue = FormatNumber($this->statuspel->ViewValue, 0, -2, -2, -2);
        $this->statuspel->ViewCustomAttributes = "";

        // ket
        $this->ket->ViewValue = $this->ket->CurrentValue;
        $this->ket->ViewCustomAttributes = "";

        // jml_hari
        $this->jml_hari->ViewValue = $this->jml_hari->CurrentValue;
        $this->jml_hari->ViewValue = FormatNumber($this->jml_hari->ViewValue, 0, -2, -2, -2);
        $this->jml_hari->ViewCustomAttributes = "";

        // targetpes
        $this->targetpes->ViewValue = $this->targetpes->CurrentValue;
        $this->targetpes->ViewValue = FormatNumber($this->targetpes->ViewValue, 0, -2, -2, -2);
        $this->targetpes->ViewCustomAttributes = "";

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

        // rid
        $this->rid->ViewValue = $this->rid->CurrentValue;
        $this->rid->ViewValue = FormatNumber($this->rid->ViewValue, 0, -2, -2, -2);
        $this->rid->ViewCustomAttributes = "";

        // real_peserta
        $this->real_peserta->ViewValue = $this->real_peserta->CurrentValue;
        $this->real_peserta->ViewValue = FormatNumber($this->real_peserta->ViewValue, 0, -2, -2, -2);
        $this->real_peserta->ViewCustomAttributes = "";

        // independen
        $this->independen->ViewValue = $this->independen->CurrentValue;
        $this->independen->ViewValue = FormatNumber($this->independen->ViewValue, 0, -2, -2, -2);
        $this->independen->ViewCustomAttributes = "";

        // swasta_k
        $this->swasta_k->ViewValue = $this->swasta_k->CurrentValue;
        $this->swasta_k->ViewValue = FormatNumber($this->swasta_k->ViewValue, 0, -2, -2, -2);
        $this->swasta_k->ViewCustomAttributes = "";

        // swasta_m
        $this->swasta_m->ViewValue = $this->swasta_m->CurrentValue;
        $this->swasta_m->ViewValue = FormatNumber($this->swasta_m->ViewValue, 0, -2, -2, -2);
        $this->swasta_m->ViewCustomAttributes = "";

        // swasta_b
        $this->swasta_b->ViewValue = $this->swasta_b->CurrentValue;
        $this->swasta_b->ViewValue = FormatNumber($this->swasta_b->ViewValue, 0, -2, -2, -2);
        $this->swasta_b->ViewCustomAttributes = "";

        // bumn
        $this->bumn->ViewValue = $this->bumn->CurrentValue;
        $this->bumn->ViewValue = FormatNumber($this->bumn->ViewValue, 0, -2, -2, -2);
        $this->bumn->ViewCustomAttributes = "";

        // koperasi
        $this->koperasi->ViewValue = $this->koperasi->CurrentValue;
        $this->koperasi->ViewValue = FormatNumber($this->koperasi->ViewValue, 0, -2, -2, -2);
        $this->koperasi->ViewCustomAttributes = "";

        // pns
        $this->pns->ViewValue = $this->pns->CurrentValue;
        $this->pns->ViewValue = FormatNumber($this->pns->ViewValue, 0, -2, -2, -2);
        $this->pns->ViewCustomAttributes = "";

        // pt_dosen
        $this->pt_dosen->ViewValue = $this->pt_dosen->CurrentValue;
        $this->pt_dosen->ViewValue = FormatNumber($this->pt_dosen->ViewValue, 0, -2, -2, -2);
        $this->pt_dosen->ViewCustomAttributes = "";

        // pt_mhs
        $this->pt_mhs->ViewValue = $this->pt_mhs->CurrentValue;
        $this->pt_mhs->ViewValue = FormatNumber($this->pt_mhs->ViewValue, 0, -2, -2, -2);
        $this->pt_mhs->ViewCustomAttributes = "";

        // jk_l
        $this->jk_l->ViewValue = $this->jk_l->CurrentValue;
        $this->jk_l->ViewValue = FormatNumber($this->jk_l->ViewValue, 0, -2, -2, -2);
        $this->jk_l->ViewCustomAttributes = "";

        // jk_p
        $this->jk_p->ViewValue = $this->jk_p->CurrentValue;
        $this->jk_p->ViewValue = FormatNumber($this->jk_p->ViewValue, 0, -2, -2, -2);
        $this->jk_p->ViewCustomAttributes = "";

        // usia_k45
        $this->usia_k45->ViewValue = $this->usia_k45->CurrentValue;
        $this->usia_k45->ViewValue = FormatNumber($this->usia_k45->ViewValue, 0, -2, -2, -2);
        $this->usia_k45->ViewCustomAttributes = "";

        // usia_b45
        $this->usia_b45->ViewValue = $this->usia_b45->CurrentValue;
        $this->usia_b45->ViewValue = FormatNumber($this->usia_b45->ViewValue, 0, -2, -2, -2);
        $this->usia_b45->ViewCustomAttributes = "";

        // produk
        $this->produk->ViewValue = $this->produk->CurrentValue;
        $this->produk->ViewCustomAttributes = "";

        // bbio
        $this->bbio->ViewValue = $this->bbio->CurrentValue;
        $this->bbio->ViewCustomAttributes = "";

        // bbio2
        $this->bbio2->ViewValue = $this->bbio2->CurrentValue;
        $this->bbio2->ViewCustomAttributes = "";

        // bbio3
        $this->bbio3->ViewValue = $this->bbio3->CurrentValue;
        $this->bbio3->ViewCustomAttributes = "";

        // bbio4
        $this->bbio4->ViewValue = $this->bbio4->CurrentValue;
        $this->bbio4->ViewCustomAttributes = "";

        // bbio5
        $this->bbio5->ViewValue = $this->bbio5->CurrentValue;
        $this->bbio5->ViewCustomAttributes = "";

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

        // anggota2
        $this->anggota2->LinkCustomAttributes = "";
        $this->anggota2->HrefValue = "";
        $this->anggota2->TooltipValue = "";

        // widyaiswara
        $this->widyaiswara->LinkCustomAttributes = "";
        $this->widyaiswara->HrefValue = "";
        $this->widyaiswara->TooltipValue = "";

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

        // jenispel
        $this->jenispel->LinkCustomAttributes = "";
        $this->jenispel->HrefValue = "";
        $this->jenispel->TooltipValue = "";

        // jenisevaluasi
        $this->jenisevaluasi->LinkCustomAttributes = "";
        $this->jenisevaluasi->HrefValue = "";
        $this->jenisevaluasi->TooltipValue = "";

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

        // tempat
        $this->tempat->LinkCustomAttributes = "";
        $this->tempat->HrefValue = "";
        $this->tempat->TooltipValue = "";

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
        $this->namaberkas->HrefValue = "";
        $this->namaberkas->TooltipValue = "";

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

        // jml_hari
        $this->jml_hari->LinkCustomAttributes = "";
        $this->jml_hari->HrefValue = "";
        $this->jml_hari->TooltipValue = "";

        // targetpes
        $this->targetpes->LinkCustomAttributes = "";
        $this->targetpes->HrefValue = "";
        $this->targetpes->TooltipValue = "";

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
        $this->bbio->HrefValue = "";
        $this->bbio->TooltipValue = "";

        // bbio2
        $this->bbio2->LinkCustomAttributes = "";
        $this->bbio2->HrefValue = "";
        $this->bbio2->TooltipValue = "";

        // bbio3
        $this->bbio3->LinkCustomAttributes = "";
        $this->bbio3->HrefValue = "";
        $this->bbio3->TooltipValue = "";

        // bbio4
        $this->bbio4->LinkCustomAttributes = "";
        $this->bbio4->HrefValue = "";
        $this->bbio4->TooltipValue = "";

        // bbio5
        $this->bbio5->LinkCustomAttributes = "";
        $this->bbio5->HrefValue = "";
        $this->bbio5->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // idpelat
        $this->idpelat->EditAttrs["class"] = "form-control";
        $this->idpelat->EditCustomAttributes = "";
        $this->idpelat->EditValue = $this->idpelat->CurrentValue;
        $this->idpelat->ViewCustomAttributes = "";

        // kdpelat
        $this->kdpelat->EditAttrs["class"] = "form-control";
        $this->kdpelat->EditCustomAttributes = "";
        if (!$this->kdpelat->Raw) {
            $this->kdpelat->CurrentValue = HtmlDecode($this->kdpelat->CurrentValue);
        }
        $this->kdpelat->EditValue = $this->kdpelat->CurrentValue;
        $this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

        // kdjudul
        $this->kdjudul->EditAttrs["class"] = "form-control";
        $this->kdjudul->EditCustomAttributes = "";
        if (!$this->kdjudul->Raw) {
            $this->kdjudul->CurrentValue = HtmlDecode($this->kdjudul->CurrentValue);
        }
        $this->kdjudul->EditValue = $this->kdjudul->CurrentValue;
        $this->kdjudul->PlaceHolder = RemoveHtml($this->kdjudul->caption());

        // kdkursil
        $this->kdkursil->EditAttrs["class"] = "form-control";
        $this->kdkursil->EditCustomAttributes = "";
        if (!$this->kdkursil->Raw) {
            $this->kdkursil->CurrentValue = HtmlDecode($this->kdkursil->CurrentValue);
        }
        $this->kdkursil->EditValue = $this->kdkursil->CurrentValue;
        $this->kdkursil->PlaceHolder = RemoveHtml($this->kdkursil->caption());

        // revisi
        $this->revisi->EditAttrs["class"] = "form-control";
        $this->revisi->EditCustomAttributes = "";
        if (!$this->revisi->Raw) {
            $this->revisi->CurrentValue = HtmlDecode($this->revisi->CurrentValue);
        }
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
        if (!$this->pilihan_iso->Raw) {
            $this->pilihan_iso->CurrentValue = HtmlDecode($this->pilihan_iso->CurrentValue);
        }
        $this->pilihan_iso->EditValue = $this->pilihan_iso->CurrentValue;
        $this->pilihan_iso->PlaceHolder = RemoveHtml($this->pilihan_iso->caption());

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

        // ketua
        $this->ketua->EditAttrs["class"] = "form-control";
        $this->ketua->EditCustomAttributes = "";
        if (!$this->ketua->Raw) {
            $this->ketua->CurrentValue = HtmlDecode($this->ketua->CurrentValue);
        }
        $this->ketua->EditValue = $this->ketua->CurrentValue;
        $this->ketua->PlaceHolder = RemoveHtml($this->ketua->caption());

        // bendahara
        $this->bendahara->EditAttrs["class"] = "form-control";
        $this->bendahara->EditCustomAttributes = "";
        if (!$this->bendahara->Raw) {
            $this->bendahara->CurrentValue = HtmlDecode($this->bendahara->CurrentValue);
        }
        $this->bendahara->EditValue = $this->bendahara->CurrentValue;
        $this->bendahara->PlaceHolder = RemoveHtml($this->bendahara->caption());

        // sekretaris
        $this->sekretaris->EditAttrs["class"] = "form-control";
        $this->sekretaris->EditCustomAttributes = "";
        if (!$this->sekretaris->Raw) {
            $this->sekretaris->CurrentValue = HtmlDecode($this->sekretaris->CurrentValue);
        }
        $this->sekretaris->EditValue = $this->sekretaris->CurrentValue;
        $this->sekretaris->PlaceHolder = RemoveHtml($this->sekretaris->caption());

        // anggota2
        $this->anggota2->EditAttrs["class"] = "form-control";
        $this->anggota2->EditCustomAttributes = "";
        if (!$this->anggota2->Raw) {
            $this->anggota2->CurrentValue = HtmlDecode($this->anggota2->CurrentValue);
        }
        $this->anggota2->EditValue = $this->anggota2->CurrentValue;
        $this->anggota2->PlaceHolder = RemoveHtml($this->anggota2->caption());

        // widyaiswara
        $this->widyaiswara->EditAttrs["class"] = "form-control";
        $this->widyaiswara->EditCustomAttributes = "";
        $this->widyaiswara->EditValue = $this->widyaiswara->CurrentValue;
        $this->widyaiswara->PlaceHolder = RemoveHtml($this->widyaiswara->caption());

        // kdprop
        $this->kdprop->EditAttrs["class"] = "form-control";
        $this->kdprop->EditCustomAttributes = "";
        $this->kdprop->EditValue = $this->kdprop->CurrentValue;
        $this->kdprop->PlaceHolder = RemoveHtml($this->kdprop->caption());

        // kdkota
        $this->kdkota->EditAttrs["class"] = "form-control";
        $this->kdkota->EditCustomAttributes = "";
        $this->kdkota->EditValue = $this->kdkota->CurrentValue;
        $this->kdkota->PlaceHolder = RemoveHtml($this->kdkota->caption());

        // kdkec
        $this->kdkec->EditAttrs["class"] = "form-control";
        $this->kdkec->EditCustomAttributes = "";
        $this->kdkec->EditValue = $this->kdkec->CurrentValue;
        $this->kdkec->PlaceHolder = RemoveHtml($this->kdkec->caption());

        // jenispel
        $this->jenispel->EditAttrs["class"] = "form-control";
        $this->jenispel->EditCustomAttributes = "";
        $this->jenispel->EditValue = $this->jenispel->CurrentValue;
        $this->jenispel->PlaceHolder = RemoveHtml($this->jenispel->caption());

        // jenisevaluasi
        $this->jenisevaluasi->EditAttrs["class"] = "form-control";
        $this->jenisevaluasi->EditCustomAttributes = "";
        if (!$this->jenisevaluasi->Raw) {
            $this->jenisevaluasi->CurrentValue = HtmlDecode($this->jenisevaluasi->CurrentValue);
        }
        $this->jenisevaluasi->EditValue = $this->jenisevaluasi->CurrentValue;
        $this->jenisevaluasi->PlaceHolder = RemoveHtml($this->jenisevaluasi->caption());

        // kdkategori
        $this->kdkategori->EditAttrs["class"] = "form-control";
        $this->kdkategori->EditCustomAttributes = "";
        $this->kdkategori->EditValue = $this->kdkategori->CurrentValue;
        $this->kdkategori->PlaceHolder = RemoveHtml($this->kdkategori->caption());

        // kerjasama
        $this->kerjasama->EditAttrs["class"] = "form-control";
        $this->kerjasama->EditCustomAttributes = "";
        $this->kerjasama->EditValue = $this->kerjasama->CurrentValue;
        $this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

        // dana
        $this->dana->EditAttrs["class"] = "form-control";
        $this->dana->EditCustomAttributes = "";
        if (!$this->dana->Raw) {
            $this->dana->CurrentValue = HtmlDecode($this->dana->CurrentValue);
        }
        $this->dana->EditValue = $this->dana->CurrentValue;
        $this->dana->PlaceHolder = RemoveHtml($this->dana->caption());

        // biaya
        $this->biaya->EditAttrs["class"] = "form-control";
        $this->biaya->EditCustomAttributes = "";
        $this->biaya->EditValue = $this->biaya->CurrentValue;
        $this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
        if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue)) {
            $this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -2, -2, -2);
        }

        // tempat
        $this->tempat->EditAttrs["class"] = "form-control";
        $this->tempat->EditCustomAttributes = "";
        $this->tempat->EditValue = $this->tempat->CurrentValue;
        $this->tempat->PlaceHolder = RemoveHtml($this->tempat->caption());

        // target_peserta
        $this->target_peserta->EditAttrs["class"] = "form-control";
        $this->target_peserta->EditCustomAttributes = "";
        $this->target_peserta->EditValue = $this->target_peserta->CurrentValue;
        $this->target_peserta->PlaceHolder = RemoveHtml($this->target_peserta->caption());

        // durasi1
        $this->durasi1->EditAttrs["class"] = "form-control";
        $this->durasi1->EditCustomAttributes = "";
        if (!$this->durasi1->Raw) {
            $this->durasi1->CurrentValue = HtmlDecode($this->durasi1->CurrentValue);
        }
        $this->durasi1->EditValue = $this->durasi1->CurrentValue;
        $this->durasi1->PlaceHolder = RemoveHtml($this->durasi1->caption());

        // durasi2
        $this->durasi2->EditAttrs["class"] = "form-control";
        $this->durasi2->EditCustomAttributes = "";
        if (!$this->durasi2->Raw) {
            $this->durasi2->CurrentValue = HtmlDecode($this->durasi2->CurrentValue);
        }
        $this->durasi2->EditValue = $this->durasi2->CurrentValue;
        $this->durasi2->PlaceHolder = RemoveHtml($this->durasi2->caption());

        // coachingprogr
        $this->coachingprogr->EditAttrs["class"] = "form-control";
        $this->coachingprogr->EditCustomAttributes = "";
        if (!$this->coachingprogr->Raw) {
            $this->coachingprogr->CurrentValue = HtmlDecode($this->coachingprogr->CurrentValue);
        }
        $this->coachingprogr->EditValue = $this->coachingprogr->CurrentValue;
        $this->coachingprogr->PlaceHolder = RemoveHtml($this->coachingprogr->caption());

        // area
        $this->area->EditAttrs["class"] = "form-control";
        $this->area->EditCustomAttributes = "";
        if (!$this->area->Raw) {
            $this->area->CurrentValue = HtmlDecode($this->area->CurrentValue);
        }
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
        $this->tahapan->EditValue = $this->tahapan->CurrentValue;
        $this->tahapan->PlaceHolder = RemoveHtml($this->tahapan->caption());

        // namaberkas
        $this->namaberkas->EditAttrs["class"] = "form-control";
        $this->namaberkas->EditCustomAttributes = "";
        if (!$this->namaberkas->Raw) {
            $this->namaberkas->CurrentValue = HtmlDecode($this->namaberkas->CurrentValue);
        }
        $this->namaberkas->EditValue = $this->namaberkas->CurrentValue;
        $this->namaberkas->PlaceHolder = RemoveHtml($this->namaberkas->caption());

        // nmou
        $this->nmou->EditAttrs["class"] = "form-control";
        $this->nmou->EditCustomAttributes = "";
        if (!$this->nmou->Raw) {
            $this->nmou->CurrentValue = HtmlDecode($this->nmou->CurrentValue);
        }
        $this->nmou->EditValue = $this->nmou->CurrentValue;
        $this->nmou->PlaceHolder = RemoveHtml($this->nmou->caption());

        // nmou2
        $this->nmou2->EditAttrs["class"] = "form-control";
        $this->nmou2->EditCustomAttributes = "";
        if (!$this->nmou2->Raw) {
            $this->nmou2->CurrentValue = HtmlDecode($this->nmou2->CurrentValue);
        }
        $this->nmou2->EditValue = $this->nmou2->CurrentValue;
        $this->nmou2->PlaceHolder = RemoveHtml($this->nmou2->caption());

        // statuspel
        $this->statuspel->EditAttrs["class"] = "form-control";
        $this->statuspel->EditCustomAttributes = "";
        $this->statuspel->EditValue = $this->statuspel->CurrentValue;
        $this->statuspel->PlaceHolder = RemoveHtml($this->statuspel->caption());

        // ket
        $this->ket->EditAttrs["class"] = "form-control";
        $this->ket->EditCustomAttributes = "";
        $this->ket->EditValue = $this->ket->CurrentValue;
        $this->ket->PlaceHolder = RemoveHtml($this->ket->caption());

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

        // created_at
        $this->created_at->EditAttrs["class"] = "form-control";
        $this->created_at->EditCustomAttributes = "";
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, 8);
        $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

        // user_created_by
        $this->user_created_by->EditAttrs["class"] = "form-control";
        $this->user_created_by->EditCustomAttributes = "";
        if (!$this->user_created_by->Raw) {
            $this->user_created_by->CurrentValue = HtmlDecode($this->user_created_by->CurrentValue);
        }
        $this->user_created_by->EditValue = $this->user_created_by->CurrentValue;
        $this->user_created_by->PlaceHolder = RemoveHtml($this->user_created_by->caption());

        // updated_at
        $this->updated_at->EditAttrs["class"] = "form-control";
        $this->updated_at->EditCustomAttributes = "";
        $this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, 8);
        $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

        // user_updated_by
        $this->user_updated_by->EditAttrs["class"] = "form-control";
        $this->user_updated_by->EditCustomAttributes = "";
        if (!$this->user_updated_by->Raw) {
            $this->user_updated_by->CurrentValue = HtmlDecode($this->user_updated_by->CurrentValue);
        }
        $this->user_updated_by->EditValue = $this->user_updated_by->CurrentValue;
        $this->user_updated_by->PlaceHolder = RemoveHtml($this->user_updated_by->caption());

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
        $this->produk->EditCustomAttributes = "";
        $this->produk->EditValue = $this->produk->CurrentValue;
        $this->produk->PlaceHolder = RemoveHtml($this->produk->caption());

        // bbio
        $this->bbio->EditAttrs["class"] = "form-control";
        $this->bbio->EditCustomAttributes = "";
        if (!$this->bbio->Raw) {
            $this->bbio->CurrentValue = HtmlDecode($this->bbio->CurrentValue);
        }
        $this->bbio->EditValue = $this->bbio->CurrentValue;
        $this->bbio->PlaceHolder = RemoveHtml($this->bbio->caption());

        // bbio2
        $this->bbio2->EditAttrs["class"] = "form-control";
        $this->bbio2->EditCustomAttributes = "";
        if (!$this->bbio2->Raw) {
            $this->bbio2->CurrentValue = HtmlDecode($this->bbio2->CurrentValue);
        }
        $this->bbio2->EditValue = $this->bbio2->CurrentValue;
        $this->bbio2->PlaceHolder = RemoveHtml($this->bbio2->caption());

        // bbio3
        $this->bbio3->EditAttrs["class"] = "form-control";
        $this->bbio3->EditCustomAttributes = "";
        if (!$this->bbio3->Raw) {
            $this->bbio3->CurrentValue = HtmlDecode($this->bbio3->CurrentValue);
        }
        $this->bbio3->EditValue = $this->bbio3->CurrentValue;
        $this->bbio3->PlaceHolder = RemoveHtml($this->bbio3->caption());

        // bbio4
        $this->bbio4->EditAttrs["class"] = "form-control";
        $this->bbio4->EditCustomAttributes = "";
        if (!$this->bbio4->Raw) {
            $this->bbio4->CurrentValue = HtmlDecode($this->bbio4->CurrentValue);
        }
        $this->bbio4->EditValue = $this->bbio4->CurrentValue;
        $this->bbio4->PlaceHolder = RemoveHtml($this->bbio4->caption());

        // bbio5
        $this->bbio5->EditAttrs["class"] = "form-control";
        $this->bbio5->EditCustomAttributes = "";
        if (!$this->bbio5->Raw) {
            $this->bbio5->CurrentValue = HtmlDecode($this->bbio5->CurrentValue);
        }
        $this->bbio5->EditValue = $this->bbio5->CurrentValue;
        $this->bbio5->PlaceHolder = RemoveHtml($this->bbio5->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
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
                    $doc->exportCaption($this->ketua);
                    $doc->exportCaption($this->bendahara);
                    $doc->exportCaption($this->sekretaris);
                    $doc->exportCaption($this->anggota2);
                    $doc->exportCaption($this->widyaiswara);
                    $doc->exportCaption($this->kdprop);
                    $doc->exportCaption($this->kdkota);
                    $doc->exportCaption($this->kdkec);
                    $doc->exportCaption($this->jenispel);
                    $doc->exportCaption($this->jenisevaluasi);
                    $doc->exportCaption($this->kdkategori);
                    $doc->exportCaption($this->kerjasama);
                    $doc->exportCaption($this->dana);
                    $doc->exportCaption($this->biaya);
                    $doc->exportCaption($this->tempat);
                    $doc->exportCaption($this->target_peserta);
                    $doc->exportCaption($this->durasi1);
                    $doc->exportCaption($this->durasi2);
                    $doc->exportCaption($this->coachingprogr);
                    $doc->exportCaption($this->area);
                    $doc->exportCaption($this->periode_awal);
                    $doc->exportCaption($this->periode_akhir);
                    $doc->exportCaption($this->tahapan);
                    $doc->exportCaption($this->namaberkas);
                    $doc->exportCaption($this->nmou);
                    $doc->exportCaption($this->nmou2);
                    $doc->exportCaption($this->statuspel);
                    $doc->exportCaption($this->ket);
                    $doc->exportCaption($this->jml_hari);
                    $doc->exportCaption($this->targetpes);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->user_created_by);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->user_updated_by);
                    $doc->exportCaption($this->rid);
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
                    $doc->exportCaption($this->idpelat);
                    $doc->exportCaption($this->kdpelat);
                    $doc->exportCaption($this->kdjudul);
                    $doc->exportCaption($this->kdkursil);
                    $doc->exportCaption($this->revisi);
                    $doc->exportCaption($this->tgl_terbit);
                    $doc->exportCaption($this->pilihan_iso);
                    $doc->exportCaption($this->tawal);
                    $doc->exportCaption($this->takhir);
                    $doc->exportCaption($this->ketua);
                    $doc->exportCaption($this->bendahara);
                    $doc->exportCaption($this->sekretaris);
                    $doc->exportCaption($this->anggota2);
                    $doc->exportCaption($this->widyaiswara);
                    $doc->exportCaption($this->kdprop);
                    $doc->exportCaption($this->kdkota);
                    $doc->exportCaption($this->kdkec);
                    $doc->exportCaption($this->jenispel);
                    $doc->exportCaption($this->jenisevaluasi);
                    $doc->exportCaption($this->kdkategori);
                    $doc->exportCaption($this->kerjasama);
                    $doc->exportCaption($this->dana);
                    $doc->exportCaption($this->biaya);
                    $doc->exportCaption($this->durasi1);
                    $doc->exportCaption($this->durasi2);
                    $doc->exportCaption($this->coachingprogr);
                    $doc->exportCaption($this->area);
                    $doc->exportCaption($this->periode_awal);
                    $doc->exportCaption($this->periode_akhir);
                    $doc->exportCaption($this->tahapan);
                    $doc->exportCaption($this->namaberkas);
                    $doc->exportCaption($this->nmou);
                    $doc->exportCaption($this->nmou2);
                    $doc->exportCaption($this->statuspel);
                    $doc->exportCaption($this->jml_hari);
                    $doc->exportCaption($this->targetpes);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->user_created_by);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->user_updated_by);
                    $doc->exportCaption($this->rid);
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
                    $doc->exportCaption($this->bbio);
                    $doc->exportCaption($this->bbio2);
                    $doc->exportCaption($this->bbio3);
                    $doc->exportCaption($this->bbio4);
                    $doc->exportCaption($this->bbio5);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

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
                        $doc->exportField($this->ketua);
                        $doc->exportField($this->bendahara);
                        $doc->exportField($this->sekretaris);
                        $doc->exportField($this->anggota2);
                        $doc->exportField($this->widyaiswara);
                        $doc->exportField($this->kdprop);
                        $doc->exportField($this->kdkota);
                        $doc->exportField($this->kdkec);
                        $doc->exportField($this->jenispel);
                        $doc->exportField($this->jenisevaluasi);
                        $doc->exportField($this->kdkategori);
                        $doc->exportField($this->kerjasama);
                        $doc->exportField($this->dana);
                        $doc->exportField($this->biaya);
                        $doc->exportField($this->tempat);
                        $doc->exportField($this->target_peserta);
                        $doc->exportField($this->durasi1);
                        $doc->exportField($this->durasi2);
                        $doc->exportField($this->coachingprogr);
                        $doc->exportField($this->area);
                        $doc->exportField($this->periode_awal);
                        $doc->exportField($this->periode_akhir);
                        $doc->exportField($this->tahapan);
                        $doc->exportField($this->namaberkas);
                        $doc->exportField($this->nmou);
                        $doc->exportField($this->nmou2);
                        $doc->exportField($this->statuspel);
                        $doc->exportField($this->ket);
                        $doc->exportField($this->jml_hari);
                        $doc->exportField($this->targetpes);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->user_created_by);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->user_updated_by);
                        $doc->exportField($this->rid);
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
                        $doc->exportField($this->idpelat);
                        $doc->exportField($this->kdpelat);
                        $doc->exportField($this->kdjudul);
                        $doc->exportField($this->kdkursil);
                        $doc->exportField($this->revisi);
                        $doc->exportField($this->tgl_terbit);
                        $doc->exportField($this->pilihan_iso);
                        $doc->exportField($this->tawal);
                        $doc->exportField($this->takhir);
                        $doc->exportField($this->ketua);
                        $doc->exportField($this->bendahara);
                        $doc->exportField($this->sekretaris);
                        $doc->exportField($this->anggota2);
                        $doc->exportField($this->widyaiswara);
                        $doc->exportField($this->kdprop);
                        $doc->exportField($this->kdkota);
                        $doc->exportField($this->kdkec);
                        $doc->exportField($this->jenispel);
                        $doc->exportField($this->jenisevaluasi);
                        $doc->exportField($this->kdkategori);
                        $doc->exportField($this->kerjasama);
                        $doc->exportField($this->dana);
                        $doc->exportField($this->biaya);
                        $doc->exportField($this->durasi1);
                        $doc->exportField($this->durasi2);
                        $doc->exportField($this->coachingprogr);
                        $doc->exportField($this->area);
                        $doc->exportField($this->periode_awal);
                        $doc->exportField($this->periode_akhir);
                        $doc->exportField($this->tahapan);
                        $doc->exportField($this->namaberkas);
                        $doc->exportField($this->nmou);
                        $doc->exportField($this->nmou2);
                        $doc->exportField($this->statuspel);
                        $doc->exportField($this->jml_hari);
                        $doc->exportField($this->targetpes);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->user_created_by);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->user_updated_by);
                        $doc->exportField($this->rid);
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
                        $doc->exportField($this->bbio);
                        $doc->exportField($this->bbio2);
                        $doc->exportField($this->bbio3);
                        $doc->exportField($this->bbio4);
                        $doc->exportField($this->bbio5);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
