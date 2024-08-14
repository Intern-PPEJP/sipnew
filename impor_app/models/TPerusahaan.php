<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for t_perusahaan
 */
class TPerusahaan extends DbTable
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
    public $idp;
    public $namap;
    public $kontak;
    public $kdlokasi;
    public $alamatp;
    public $kdprop;
    public $kdkota;
    public $kdkec;
    public $kdpos;
    public $telpp;
    public $faxp;
    public $emailp;
    public $webp;
    public $medsos;
    public $kdproduknafed;
    public $kdproduknafed2;
    public $kdproduknafed3;
    public $pproduk;
    public $kdskala;
    public $kdjenis;
    public $kdexport;
    public $nexport;
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
    public $hscode;
    public $imp;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 't_perusahaan';
        $this->TableName = 't_perusahaan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`t_perusahaan`";
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

        // idp
        $this->idp = new DbField('t_perusahaan', 't_perusahaan', 'x_idp', 'idp', '`idp`', '`idp`', 3, 11, -1, false, '`idp`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->idp->IsAutoIncrement = true; // Autoincrement field
        $this->idp->IsPrimaryKey = true; // Primary key field
        $this->idp->Sortable = true; // Allow sort
        $this->idp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->idp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idp->Param, "CustomMsg");
        $this->Fields['idp'] = &$this->idp;

        // namap
        $this->namap = new DbField('t_perusahaan', 't_perusahaan', 'x_namap', 'namap', '`namap`', '`namap`', 200, 150, -1, false, '`namap`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->namap->Sortable = true; // Allow sort
        $this->namap->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->namap->Param, "CustomMsg");
        $this->Fields['namap'] = &$this->namap;

        // kontak
        $this->kontak = new DbField('t_perusahaan', 't_perusahaan', 'x_kontak', 'kontak', '`kontak`', '`kontak`', 200, 100, -1, false, '`kontak`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kontak->Sortable = true; // Allow sort
        $this->kontak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kontak->Param, "CustomMsg");
        $this->Fields['kontak'] = &$this->kontak;

        // kdlokasi
        $this->kdlokasi = new DbField('t_perusahaan', 't_perusahaan', 'x_kdlokasi', 'kdlokasi', '`kdlokasi`', '`kdlokasi`', 3, 11, -1, false, '`kdlokasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdlokasi->Sortable = true; // Allow sort
        $this->kdlokasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdlokasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdlokasi->Param, "CustomMsg");
        $this->Fields['kdlokasi'] = &$this->kdlokasi;

        // alamatp
        $this->alamatp = new DbField('t_perusahaan', 't_perusahaan', 'x_alamatp', 'alamatp', '`alamatp`', '`alamatp`', 201, 65535, -1, false, '`alamatp`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->alamatp->Sortable = true; // Allow sort
        $this->alamatp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamatp->Param, "CustomMsg");
        $this->Fields['alamatp'] = &$this->alamatp;

        // kdprop
        $this->kdprop = new DbField('t_perusahaan', 't_perusahaan', 'x_kdprop', 'kdprop', '`kdprop`', '`kdprop`', 3, 11, -1, false, '`kdprop`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdprop->Sortable = true; // Allow sort
        $this->kdprop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdprop->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdprop->Param, "CustomMsg");
        $this->Fields['kdprop'] = &$this->kdprop;

        // kdkota
        $this->kdkota = new DbField('t_perusahaan', 't_perusahaan', 'x_kdkota', 'kdkota', '`kdkota`', '`kdkota`', 3, 11, -1, false, '`kdkota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdkota->Sortable = true; // Allow sort
        $this->kdkota->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkota->Param, "CustomMsg");
        $this->Fields['kdkota'] = &$this->kdkota;

        // kdkec
        $this->kdkec = new DbField('t_perusahaan', 't_perusahaan', 'x_kdkec', 'kdkec', '`kdkec`', '`kdkec`', 3, 7, -1, false, '`kdkec`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdkec->Sortable = true; // Allow sort
        $this->kdkec->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkec->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkec->Param, "CustomMsg");
        $this->Fields['kdkec'] = &$this->kdkec;

        // kdpos
        $this->kdpos = new DbField('t_perusahaan', 't_perusahaan', 'x_kdpos', 'kdpos', '`kdpos`', '`kdpos`', 200, 10, -1, false, '`kdpos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdpos->Sortable = true; // Allow sort
        $this->kdpos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdpos->Param, "CustomMsg");
        $this->Fields['kdpos'] = &$this->kdpos;

        // telpp
        $this->telpp = new DbField('t_perusahaan', 't_perusahaan', 'x_telpp', 'telpp', '`telpp`', '`telpp`', 200, 100, -1, false, '`telpp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->telpp->Sortable = true; // Allow sort
        $this->telpp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->telpp->Param, "CustomMsg");
        $this->Fields['telpp'] = &$this->telpp;

        // faxp
        $this->faxp = new DbField('t_perusahaan', 't_perusahaan', 'x_faxp', 'faxp', '`faxp`', '`faxp`', 200, 100, -1, false, '`faxp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->faxp->Sortable = true; // Allow sort
        $this->faxp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->faxp->Param, "CustomMsg");
        $this->Fields['faxp'] = &$this->faxp;

        // emailp
        $this->emailp = new DbField('t_perusahaan', 't_perusahaan', 'x_emailp', 'emailp', '`emailp`', '`emailp`', 200, 100, -1, false, '`emailp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->emailp->Sortable = true; // Allow sort
        $this->emailp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->emailp->Param, "CustomMsg");
        $this->Fields['emailp'] = &$this->emailp;

        // webp
        $this->webp = new DbField('t_perusahaan', 't_perusahaan', 'x_webp', 'webp', '`webp`', '`webp`', 200, 100, -1, false, '`webp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->webp->Sortable = true; // Allow sort
        $this->webp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->webp->Param, "CustomMsg");
        $this->Fields['webp'] = &$this->webp;

        // medsos
        $this->medsos = new DbField('t_perusahaan', 't_perusahaan', 'x_medsos', 'medsos', '`medsos`', '`medsos`', 200, 100, -1, false, '`medsos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->medsos->Sortable = true; // Allow sort
        $this->medsos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->medsos->Param, "CustomMsg");
        $this->Fields['medsos'] = &$this->medsos;

        // kdproduknafed
        $this->kdproduknafed = new DbField('t_perusahaan', 't_perusahaan', 'x_kdproduknafed', 'kdproduknafed', '`kdproduknafed`', '`kdproduknafed`', 200, 10, -1, false, '`kdproduknafed`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdproduknafed->Sortable = true; // Allow sort
        $this->kdproduknafed->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdproduknafed->Param, "CustomMsg");
        $this->Fields['kdproduknafed'] = &$this->kdproduknafed;

        // kdproduknafed2
        $this->kdproduknafed2 = new DbField('t_perusahaan', 't_perusahaan', 'x_kdproduknafed2', 'kdproduknafed2', '`kdproduknafed2`', '`kdproduknafed2`', 200, 10, -1, false, '`kdproduknafed2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdproduknafed2->Sortable = true; // Allow sort
        $this->kdproduknafed2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdproduknafed2->Param, "CustomMsg");
        $this->Fields['kdproduknafed2'] = &$this->kdproduknafed2;

        // kdproduknafed3
        $this->kdproduknafed3 = new DbField('t_perusahaan', 't_perusahaan', 'x_kdproduknafed3', 'kdproduknafed3', '`kdproduknafed3`', '`kdproduknafed3`', 200, 10, -1, false, '`kdproduknafed3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdproduknafed3->Sortable = true; // Allow sort
        $this->kdproduknafed3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdproduknafed3->Param, "CustomMsg");
        $this->Fields['kdproduknafed3'] = &$this->kdproduknafed3;

        // pproduk
        $this->pproduk = new DbField('t_perusahaan', 't_perusahaan', 'x_pproduk', 'pproduk', '`pproduk`', '`pproduk`', 201, 65535, -1, false, '`pproduk`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->pproduk->Sortable = true; // Allow sort
        $this->pproduk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pproduk->Param, "CustomMsg");
        $this->Fields['pproduk'] = &$this->pproduk;

        // kdskala
        $this->kdskala = new DbField('t_perusahaan', 't_perusahaan', 'x_kdskala', 'kdskala', '`kdskala`', '`kdskala`', 3, 11, -1, false, '`kdskala`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdskala->Sortable = true; // Allow sort
        $this->kdskala->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdskala->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdskala->Param, "CustomMsg");
        $this->Fields['kdskala'] = &$this->kdskala;

        // kdjenis
        $this->kdjenis = new DbField('t_perusahaan', 't_perusahaan', 'x_kdjenis', 'kdjenis', '`kdjenis`', '`kdjenis`', 3, 11, -1, false, '`kdjenis`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdjenis->Sortable = true; // Allow sort
        $this->kdjenis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdjenis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdjenis->Param, "CustomMsg");
        $this->Fields['kdjenis'] = &$this->kdjenis;

        // kdexport
        $this->kdexport = new DbField('t_perusahaan', 't_perusahaan', 'x_kdexport', 'kdexport', '`kdexport`', '`kdexport`', 3, 11, -1, false, '`kdexport`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdexport->Sortable = true; // Allow sort
        $this->kdexport->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdexport->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdexport->Param, "CustomMsg");
        $this->Fields['kdexport'] = &$this->kdexport;

        // nexport
        $this->nexport = new DbField('t_perusahaan', 't_perusahaan', 'x_nexport', 'nexport', '`nexport`', '`nexport`', 201, 65535, -1, false, '`nexport`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->nexport->Sortable = true; // Allow sort
        $this->nexport->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nexport->Param, "CustomMsg");
        $this->Fields['nexport'] = &$this->nexport;

        // kdkategori
        $this->kdkategori = new DbField('t_perusahaan', 't_perusahaan', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, false, '`kdkategori`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdkategori->Sortable = true; // Allow sort
        $this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kdkategori->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdkategori->Param, "CustomMsg");
        $this->Fields['kdkategori'] = &$this->kdkategori;

        // omzet_saat_ini
        $this->omzet_saat_ini = new DbField('t_perusahaan', 't_perusahaan', 'x_omzet_saat_ini', 'omzet_saat_ini', '`omzet_saat_ini`', '`omzet_saat_ini`', 200, 100, -1, false, '`omzet_saat_ini`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->omzet_saat_ini->Sortable = true; // Allow sort
        $this->omzet_saat_ini->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->omzet_saat_ini->Param, "CustomMsg");
        $this->Fields['omzet_saat_ini'] = &$this->omzet_saat_ini;

        // omzet_stl_6bln
        $this->omzet_stl_6bln = new DbField('t_perusahaan', 't_perusahaan', 'x_omzet_stl_6bln', 'omzet_stl_6bln', '`omzet_stl_6bln`', '`omzet_stl_6bln`', 200, 100, -1, false, '`omzet_stl_6bln`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->omzet_stl_6bln->Sortable = true; // Allow sort
        $this->omzet_stl_6bln->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->omzet_stl_6bln->Param, "CustomMsg");
        $this->Fields['omzet_stl_6bln'] = &$this->omzet_stl_6bln;

        // omzet_stl_1thn
        $this->omzet_stl_1thn = new DbField('t_perusahaan', 't_perusahaan', 'x_omzet_stl_1thn', 'omzet_stl_1thn', '`omzet_stl_1thn`', '`omzet_stl_1thn`', 200, 100, -1, false, '`omzet_stl_1thn`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->omzet_stl_1thn->Sortable = true; // Allow sort
        $this->omzet_stl_1thn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->omzet_stl_1thn->Param, "CustomMsg");
        $this->Fields['omzet_stl_1thn'] = &$this->omzet_stl_1thn;

        // omzet_stl_2thn
        $this->omzet_stl_2thn = new DbField('t_perusahaan', 't_perusahaan', 'x_omzet_stl_2thn', 'omzet_stl_2thn', '`omzet_stl_2thn`', '`omzet_stl_2thn`', 200, 100, -1, false, '`omzet_stl_2thn`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->omzet_stl_2thn->Sortable = true; // Allow sort
        $this->omzet_stl_2thn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->omzet_stl_2thn->Param, "CustomMsg");
        $this->Fields['omzet_stl_2thn'] = &$this->omzet_stl_2thn;

        // kapasitas_saat_ini
        $this->kapasitas_saat_ini = new DbField('t_perusahaan', 't_perusahaan', 'x_kapasitas_saat_ini', 'kapasitas_saat_ini', '`kapasitas_saat_ini`', '`kapasitas_saat_ini`', 200, 100, -1, false, '`kapasitas_saat_ini`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapasitas_saat_ini->Sortable = true; // Allow sort
        $this->kapasitas_saat_ini->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapasitas_saat_ini->Param, "CustomMsg");
        $this->Fields['kapasitas_saat_ini'] = &$this->kapasitas_saat_ini;

        // kapasitas_stl_6bln
        $this->kapasitas_stl_6bln = new DbField('t_perusahaan', 't_perusahaan', 'x_kapasitas_stl_6bln', 'kapasitas_stl_6bln', '`kapasitas_stl_6bln`', '`kapasitas_stl_6bln`', 200, 100, -1, false, '`kapasitas_stl_6bln`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapasitas_stl_6bln->Sortable = true; // Allow sort
        $this->kapasitas_stl_6bln->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapasitas_stl_6bln->Param, "CustomMsg");
        $this->Fields['kapasitas_stl_6bln'] = &$this->kapasitas_stl_6bln;

        // kapasitas_stl_1thn
        $this->kapasitas_stl_1thn = new DbField('t_perusahaan', 't_perusahaan', 'x_kapasitas_stl_1thn', 'kapasitas_stl_1thn', '`kapasitas_stl_1thn`', '`kapasitas_stl_1thn`', 200, 100, -1, false, '`kapasitas_stl_1thn`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapasitas_stl_1thn->Sortable = true; // Allow sort
        $this->kapasitas_stl_1thn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapasitas_stl_1thn->Param, "CustomMsg");
        $this->Fields['kapasitas_stl_1thn'] = &$this->kapasitas_stl_1thn;

        // kapasitas_stl_2thn
        $this->kapasitas_stl_2thn = new DbField('t_perusahaan', 't_perusahaan', 'x_kapasitas_stl_2thn', 'kapasitas_stl_2thn', '`kapasitas_stl_2thn`', '`kapasitas_stl_2thn`', 200, 100, -1, false, '`kapasitas_stl_2thn`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapasitas_stl_2thn->Sortable = true; // Allow sort
        $this->kapasitas_stl_2thn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapasitas_stl_2thn->Param, "CustomMsg");
        $this->Fields['kapasitas_stl_2thn'] = &$this->kapasitas_stl_2thn;

        // created_at
        $this->created_at = new DbField('t_perusahaan', 't_perusahaan', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, false, '`created_at`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->created_at->Sortable = true; // Allow sort
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_at->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->created_at->Param, "CustomMsg");
        $this->Fields['created_at'] = &$this->created_at;

        // user_created_by
        $this->user_created_by = new DbField('t_perusahaan', 't_perusahaan', 'x_user_created_by', 'user_created_by', '`user_created_by`', '`user_created_by`', 200, 100, -1, false, '`user_created_by`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->user_created_by->Sortable = true; // Allow sort
        $this->user_created_by->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->user_created_by->Param, "CustomMsg");
        $this->Fields['user_created_by'] = &$this->user_created_by;

        // updated_at
        $this->updated_at = new DbField('t_perusahaan', 't_perusahaan', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, false, '`updated_at`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->updated_at->Sortable = true; // Allow sort
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->updated_at->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->updated_at->Param, "CustomMsg");
        $this->Fields['updated_at'] = &$this->updated_at;

        // user_updated_by
        $this->user_updated_by = new DbField('t_perusahaan', 't_perusahaan', 'x_user_updated_by', 'user_updated_by', '`user_updated_by`', '`user_updated_by`', 200, 100, -1, false, '`user_updated_by`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->user_updated_by->Sortable = true; // Allow sort
        $this->user_updated_by->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->user_updated_by->Param, "CustomMsg");
        $this->Fields['user_updated_by'] = &$this->user_updated_by;

        // hscode
        $this->hscode = new DbField('t_perusahaan', 't_perusahaan', 'x_hscode', 'hscode', '`hscode`', '`hscode`', 201, 65535, -1, false, '`hscode`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->hscode->Sortable = true; // Allow sort
        $this->hscode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hscode->Param, "CustomMsg");
        $this->Fields['hscode'] = &$this->hscode;

        // imp
        $this->imp = new DbField('t_perusahaan', 't_perusahaan', 'x_imp', 'imp', '`imp`', '`imp`', 16, 4, -1, false, '`imp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->imp->Nullable = false; // NOT NULL field
        $this->imp->Required = true; // Required field
        $this->imp->Sortable = true; // Allow sort
        $this->imp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->imp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->imp->Param, "CustomMsg");
        $this->Fields['imp'] = &$this->imp;
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
            $this->idp->setDbValue($conn->lastInsertId());
            $rs['idp'] = $this->idp->DbValue;
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
            if (array_key_exists('idp', $rs)) {
                AddFilter($where, QuotedName('idp', $this->Dbid) . '=' . QuotedValue($rs['idp'], $this->idp->DataType, $this->Dbid));
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
        $this->idp->DbValue = $row['idp'];
        $this->namap->DbValue = $row['namap'];
        $this->kontak->DbValue = $row['kontak'];
        $this->kdlokasi->DbValue = $row['kdlokasi'];
        $this->alamatp->DbValue = $row['alamatp'];
        $this->kdprop->DbValue = $row['kdprop'];
        $this->kdkota->DbValue = $row['kdkota'];
        $this->kdkec->DbValue = $row['kdkec'];
        $this->kdpos->DbValue = $row['kdpos'];
        $this->telpp->DbValue = $row['telpp'];
        $this->faxp->DbValue = $row['faxp'];
        $this->emailp->DbValue = $row['emailp'];
        $this->webp->DbValue = $row['webp'];
        $this->medsos->DbValue = $row['medsos'];
        $this->kdproduknafed->DbValue = $row['kdproduknafed'];
        $this->kdproduknafed2->DbValue = $row['kdproduknafed2'];
        $this->kdproduknafed3->DbValue = $row['kdproduknafed3'];
        $this->pproduk->DbValue = $row['pproduk'];
        $this->kdskala->DbValue = $row['kdskala'];
        $this->kdjenis->DbValue = $row['kdjenis'];
        $this->kdexport->DbValue = $row['kdexport'];
        $this->nexport->DbValue = $row['nexport'];
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
        $this->hscode->DbValue = $row['hscode'];
        $this->imp->DbValue = $row['imp'];
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

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->idp->CurrentValue : $this->idp->OldValue;
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
                $this->idp->CurrentValue = $keys[0];
            } else {
                $this->idp->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('idp', $row) ? $row['idp'] : null;
        } else {
            $val = $this->idp->OldValue !== null ? $this->idp->OldValue : $this->idp->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@idp@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("tperusahaanlist");
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
        if ($pageName == "tperusahaanview") {
            return $Language->phrase("View");
        } elseif ($pageName == "tperusahaanedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "tperusahaanadd") {
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
                return "TPerusahaanView";
            case Config("API_ADD_ACTION"):
                return "TPerusahaanAdd";
            case Config("API_EDIT_ACTION"):
                return "TPerusahaanEdit";
            case Config("API_DELETE_ACTION"):
                return "TPerusahaanDelete";
            case Config("API_LIST_ACTION"):
                return "TPerusahaanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "tperusahaanlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("tperusahaanview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("tperusahaanview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "tperusahaanadd?" . $this->getUrlParm($parm);
        } else {
            $url = "tperusahaanadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("tperusahaanedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("tperusahaanadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("tperusahaandelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "idp:" . JsonEncode($this->idp->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->idp->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->idp->CurrentValue);
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
            if (($keyValue = Param("idp") ?? Route("idp")) !== null) {
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
                $this->idp->CurrentValue = $key;
            } else {
                $this->idp->OldValue = $key;
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
        $this->idp->setDbValue($row['idp']);
        $this->namap->setDbValue($row['namap']);
        $this->kontak->setDbValue($row['kontak']);
        $this->kdlokasi->setDbValue($row['kdlokasi']);
        $this->alamatp->setDbValue($row['alamatp']);
        $this->kdprop->setDbValue($row['kdprop']);
        $this->kdkota->setDbValue($row['kdkota']);
        $this->kdkec->setDbValue($row['kdkec']);
        $this->kdpos->setDbValue($row['kdpos']);
        $this->telpp->setDbValue($row['telpp']);
        $this->faxp->setDbValue($row['faxp']);
        $this->emailp->setDbValue($row['emailp']);
        $this->webp->setDbValue($row['webp']);
        $this->medsos->setDbValue($row['medsos']);
        $this->kdproduknafed->setDbValue($row['kdproduknafed']);
        $this->kdproduknafed2->setDbValue($row['kdproduknafed2']);
        $this->kdproduknafed3->setDbValue($row['kdproduknafed3']);
        $this->pproduk->setDbValue($row['pproduk']);
        $this->kdskala->setDbValue($row['kdskala']);
        $this->kdjenis->setDbValue($row['kdjenis']);
        $this->kdexport->setDbValue($row['kdexport']);
        $this->nexport->setDbValue($row['nexport']);
        $this->kdkategori->setDbValue($row['kdkategori']);
        $this->omzet_saat_ini->setDbValue($row['omzet_saat_ini']);
        $this->omzet_stl_6bln->setDbValue($row['omzet_stl_6bln']);
        $this->omzet_stl_1thn->setDbValue($row['omzet_stl_1thn']);
        $this->omzet_stl_2thn->setDbValue($row['omzet_stl_2thn']);
        $this->kapasitas_saat_ini->setDbValue($row['kapasitas_saat_ini']);
        $this->kapasitas_stl_6bln->setDbValue($row['kapasitas_stl_6bln']);
        $this->kapasitas_stl_1thn->setDbValue($row['kapasitas_stl_1thn']);
        $this->kapasitas_stl_2thn->setDbValue($row['kapasitas_stl_2thn']);
        $this->created_at->setDbValue($row['created_at']);
        $this->user_created_by->setDbValue($row['user_created_by']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->user_updated_by->setDbValue($row['user_updated_by']);
        $this->hscode->setDbValue($row['hscode']);
        $this->imp->setDbValue($row['imp']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // idp

        // namap

        // kontak

        // kdlokasi

        // alamatp

        // kdprop

        // kdkota

        // kdkec

        // kdpos

        // telpp

        // faxp

        // emailp

        // webp

        // medsos

        // kdproduknafed

        // kdproduknafed2

        // kdproduknafed3

        // pproduk

        // kdskala

        // kdjenis

        // kdexport

        // nexport

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

        // hscode

        // imp

        // idp
        $this->idp->ViewValue = $this->idp->CurrentValue;
        $this->idp->ViewCustomAttributes = "";

        // namap
        $this->namap->ViewValue = $this->namap->CurrentValue;
        $this->namap->ViewCustomAttributes = "";

        // kontak
        $this->kontak->ViewValue = $this->kontak->CurrentValue;
        $this->kontak->ViewCustomAttributes = "";

        // kdlokasi
        $this->kdlokasi->ViewValue = $this->kdlokasi->CurrentValue;
        $this->kdlokasi->ViewValue = FormatNumber($this->kdlokasi->ViewValue, 0, -2, -2, -2);
        $this->kdlokasi->ViewCustomAttributes = "";

        // alamatp
        $this->alamatp->ViewValue = $this->alamatp->CurrentValue;
        $this->alamatp->ViewCustomAttributes = "";

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

        // kdproduknafed
        $this->kdproduknafed->ViewValue = $this->kdproduknafed->CurrentValue;
        $this->kdproduknafed->ViewCustomAttributes = "";

        // kdproduknafed2
        $this->kdproduknafed2->ViewValue = $this->kdproduknafed2->CurrentValue;
        $this->kdproduknafed2->ViewCustomAttributes = "";

        // kdproduknafed3
        $this->kdproduknafed3->ViewValue = $this->kdproduknafed3->CurrentValue;
        $this->kdproduknafed3->ViewCustomAttributes = "";

        // pproduk
        $this->pproduk->ViewValue = $this->pproduk->CurrentValue;
        $this->pproduk->ViewCustomAttributes = "";

        // kdskala
        $this->kdskala->ViewValue = $this->kdskala->CurrentValue;
        $this->kdskala->ViewValue = FormatNumber($this->kdskala->ViewValue, 0, -2, -2, -2);
        $this->kdskala->ViewCustomAttributes = "";

        // kdjenis
        $this->kdjenis->ViewValue = $this->kdjenis->CurrentValue;
        $this->kdjenis->ViewValue = FormatNumber($this->kdjenis->ViewValue, 0, -2, -2, -2);
        $this->kdjenis->ViewCustomAttributes = "";

        // kdexport
        $this->kdexport->ViewValue = $this->kdexport->CurrentValue;
        $this->kdexport->ViewValue = FormatNumber($this->kdexport->ViewValue, 0, -2, -2, -2);
        $this->kdexport->ViewCustomAttributes = "";

        // nexport
        $this->nexport->ViewValue = $this->nexport->CurrentValue;
        $this->nexport->ViewCustomAttributes = "";

        // kdkategori
        $this->kdkategori->ViewValue = $this->kdkategori->CurrentValue;
        $this->kdkategori->ViewValue = FormatNumber($this->kdkategori->ViewValue, 0, -2, -2, -2);
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

        // hscode
        $this->hscode->ViewValue = $this->hscode->CurrentValue;
        $this->hscode->ViewCustomAttributes = "";

        // imp
        $this->imp->ViewValue = $this->imp->CurrentValue;
        $this->imp->ViewValue = FormatNumber($this->imp->ViewValue, 0, -2, -2, -2);
        $this->imp->ViewCustomAttributes = "";

        // idp
        $this->idp->LinkCustomAttributes = "";
        $this->idp->HrefValue = "";
        $this->idp->TooltipValue = "";

        // namap
        $this->namap->LinkCustomAttributes = "";
        $this->namap->HrefValue = "";
        $this->namap->TooltipValue = "";

        // kontak
        $this->kontak->LinkCustomAttributes = "";
        $this->kontak->HrefValue = "";
        $this->kontak->TooltipValue = "";

        // kdlokasi
        $this->kdlokasi->LinkCustomAttributes = "";
        $this->kdlokasi->HrefValue = "";
        $this->kdlokasi->TooltipValue = "";

        // alamatp
        $this->alamatp->LinkCustomAttributes = "";
        $this->alamatp->HrefValue = "";
        $this->alamatp->TooltipValue = "";

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

        // kdskala
        $this->kdskala->LinkCustomAttributes = "";
        $this->kdskala->HrefValue = "";
        $this->kdskala->TooltipValue = "";

        // kdjenis
        $this->kdjenis->LinkCustomAttributes = "";
        $this->kdjenis->HrefValue = "";
        $this->kdjenis->TooltipValue = "";

        // kdexport
        $this->kdexport->LinkCustomAttributes = "";
        $this->kdexport->HrefValue = "";
        $this->kdexport->TooltipValue = "";

        // nexport
        $this->nexport->LinkCustomAttributes = "";
        $this->nexport->HrefValue = "";
        $this->nexport->TooltipValue = "";

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

        // hscode
        $this->hscode->LinkCustomAttributes = "";
        $this->hscode->HrefValue = "";
        $this->hscode->TooltipValue = "";

        // imp
        $this->imp->LinkCustomAttributes = "";
        $this->imp->HrefValue = "";
        $this->imp->TooltipValue = "";

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

        // idp
        $this->idp->EditAttrs["class"] = "form-control";
        $this->idp->EditCustomAttributes = "";
        $this->idp->EditValue = $this->idp->CurrentValue;
        $this->idp->ViewCustomAttributes = "";

        // namap
        $this->namap->EditAttrs["class"] = "form-control";
        $this->namap->EditCustomAttributes = "";
        if (!$this->namap->Raw) {
            $this->namap->CurrentValue = HtmlDecode($this->namap->CurrentValue);
        }
        $this->namap->EditValue = $this->namap->CurrentValue;
        $this->namap->PlaceHolder = RemoveHtml($this->namap->caption());

        // kontak
        $this->kontak->EditAttrs["class"] = "form-control";
        $this->kontak->EditCustomAttributes = "";
        if (!$this->kontak->Raw) {
            $this->kontak->CurrentValue = HtmlDecode($this->kontak->CurrentValue);
        }
        $this->kontak->EditValue = $this->kontak->CurrentValue;
        $this->kontak->PlaceHolder = RemoveHtml($this->kontak->caption());

        // kdlokasi
        $this->kdlokasi->EditAttrs["class"] = "form-control";
        $this->kdlokasi->EditCustomAttributes = "";
        $this->kdlokasi->EditValue = $this->kdlokasi->CurrentValue;
        $this->kdlokasi->PlaceHolder = RemoveHtml($this->kdlokasi->caption());

        // alamatp
        $this->alamatp->EditAttrs["class"] = "form-control";
        $this->alamatp->EditCustomAttributes = "";
        $this->alamatp->EditValue = $this->alamatp->CurrentValue;
        $this->alamatp->PlaceHolder = RemoveHtml($this->alamatp->caption());

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

        // kdpos
        $this->kdpos->EditAttrs["class"] = "form-control";
        $this->kdpos->EditCustomAttributes = "";
        if (!$this->kdpos->Raw) {
            $this->kdpos->CurrentValue = HtmlDecode($this->kdpos->CurrentValue);
        }
        $this->kdpos->EditValue = $this->kdpos->CurrentValue;
        $this->kdpos->PlaceHolder = RemoveHtml($this->kdpos->caption());

        // telpp
        $this->telpp->EditAttrs["class"] = "form-control";
        $this->telpp->EditCustomAttributes = "";
        if (!$this->telpp->Raw) {
            $this->telpp->CurrentValue = HtmlDecode($this->telpp->CurrentValue);
        }
        $this->telpp->EditValue = $this->telpp->CurrentValue;
        $this->telpp->PlaceHolder = RemoveHtml($this->telpp->caption());

        // faxp
        $this->faxp->EditAttrs["class"] = "form-control";
        $this->faxp->EditCustomAttributes = "";
        if (!$this->faxp->Raw) {
            $this->faxp->CurrentValue = HtmlDecode($this->faxp->CurrentValue);
        }
        $this->faxp->EditValue = $this->faxp->CurrentValue;
        $this->faxp->PlaceHolder = RemoveHtml($this->faxp->caption());

        // emailp
        $this->emailp->EditAttrs["class"] = "form-control";
        $this->emailp->EditCustomAttributes = "";
        if (!$this->emailp->Raw) {
            $this->emailp->CurrentValue = HtmlDecode($this->emailp->CurrentValue);
        }
        $this->emailp->EditValue = $this->emailp->CurrentValue;
        $this->emailp->PlaceHolder = RemoveHtml($this->emailp->caption());

        // webp
        $this->webp->EditAttrs["class"] = "form-control";
        $this->webp->EditCustomAttributes = "";
        if (!$this->webp->Raw) {
            $this->webp->CurrentValue = HtmlDecode($this->webp->CurrentValue);
        }
        $this->webp->EditValue = $this->webp->CurrentValue;
        $this->webp->PlaceHolder = RemoveHtml($this->webp->caption());

        // medsos
        $this->medsos->EditAttrs["class"] = "form-control";
        $this->medsos->EditCustomAttributes = "";
        if (!$this->medsos->Raw) {
            $this->medsos->CurrentValue = HtmlDecode($this->medsos->CurrentValue);
        }
        $this->medsos->EditValue = $this->medsos->CurrentValue;
        $this->medsos->PlaceHolder = RemoveHtml($this->medsos->caption());

        // kdproduknafed
        $this->kdproduknafed->EditAttrs["class"] = "form-control";
        $this->kdproduknafed->EditCustomAttributes = "";
        if (!$this->kdproduknafed->Raw) {
            $this->kdproduknafed->CurrentValue = HtmlDecode($this->kdproduknafed->CurrentValue);
        }
        $this->kdproduknafed->EditValue = $this->kdproduknafed->CurrentValue;
        $this->kdproduknafed->PlaceHolder = RemoveHtml($this->kdproduknafed->caption());

        // kdproduknafed2
        $this->kdproduknafed2->EditAttrs["class"] = "form-control";
        $this->kdproduknafed2->EditCustomAttributes = "";
        if (!$this->kdproduknafed2->Raw) {
            $this->kdproduknafed2->CurrentValue = HtmlDecode($this->kdproduknafed2->CurrentValue);
        }
        $this->kdproduknafed2->EditValue = $this->kdproduknafed2->CurrentValue;
        $this->kdproduknafed2->PlaceHolder = RemoveHtml($this->kdproduknafed2->caption());

        // kdproduknafed3
        $this->kdproduknafed3->EditAttrs["class"] = "form-control";
        $this->kdproduknafed3->EditCustomAttributes = "";
        if (!$this->kdproduknafed3->Raw) {
            $this->kdproduknafed3->CurrentValue = HtmlDecode($this->kdproduknafed3->CurrentValue);
        }
        $this->kdproduknafed3->EditValue = $this->kdproduknafed3->CurrentValue;
        $this->kdproduknafed3->PlaceHolder = RemoveHtml($this->kdproduknafed3->caption());

        // pproduk
        $this->pproduk->EditAttrs["class"] = "form-control";
        $this->pproduk->EditCustomAttributes = "";
        $this->pproduk->EditValue = $this->pproduk->CurrentValue;
        $this->pproduk->PlaceHolder = RemoveHtml($this->pproduk->caption());

        // kdskala
        $this->kdskala->EditAttrs["class"] = "form-control";
        $this->kdskala->EditCustomAttributes = "";
        $this->kdskala->EditValue = $this->kdskala->CurrentValue;
        $this->kdskala->PlaceHolder = RemoveHtml($this->kdskala->caption());

        // kdjenis
        $this->kdjenis->EditAttrs["class"] = "form-control";
        $this->kdjenis->EditCustomAttributes = "";
        $this->kdjenis->EditValue = $this->kdjenis->CurrentValue;
        $this->kdjenis->PlaceHolder = RemoveHtml($this->kdjenis->caption());

        // kdexport
        $this->kdexport->EditAttrs["class"] = "form-control";
        $this->kdexport->EditCustomAttributes = "";
        $this->kdexport->EditValue = $this->kdexport->CurrentValue;
        $this->kdexport->PlaceHolder = RemoveHtml($this->kdexport->caption());

        // nexport
        $this->nexport->EditAttrs["class"] = "form-control";
        $this->nexport->EditCustomAttributes = "";
        $this->nexport->EditValue = $this->nexport->CurrentValue;
        $this->nexport->PlaceHolder = RemoveHtml($this->nexport->caption());

        // kdkategori
        $this->kdkategori->EditAttrs["class"] = "form-control";
        $this->kdkategori->EditCustomAttributes = "";
        $this->kdkategori->EditValue = $this->kdkategori->CurrentValue;
        $this->kdkategori->PlaceHolder = RemoveHtml($this->kdkategori->caption());

        // omzet_saat_ini
        $this->omzet_saat_ini->EditAttrs["class"] = "form-control";
        $this->omzet_saat_ini->EditCustomAttributes = "";
        if (!$this->omzet_saat_ini->Raw) {
            $this->omzet_saat_ini->CurrentValue = HtmlDecode($this->omzet_saat_ini->CurrentValue);
        }
        $this->omzet_saat_ini->EditValue = $this->omzet_saat_ini->CurrentValue;
        $this->omzet_saat_ini->PlaceHolder = RemoveHtml($this->omzet_saat_ini->caption());

        // omzet_stl_6bln
        $this->omzet_stl_6bln->EditAttrs["class"] = "form-control";
        $this->omzet_stl_6bln->EditCustomAttributes = "";
        if (!$this->omzet_stl_6bln->Raw) {
            $this->omzet_stl_6bln->CurrentValue = HtmlDecode($this->omzet_stl_6bln->CurrentValue);
        }
        $this->omzet_stl_6bln->EditValue = $this->omzet_stl_6bln->CurrentValue;
        $this->omzet_stl_6bln->PlaceHolder = RemoveHtml($this->omzet_stl_6bln->caption());

        // omzet_stl_1thn
        $this->omzet_stl_1thn->EditAttrs["class"] = "form-control";
        $this->omzet_stl_1thn->EditCustomAttributes = "";
        if (!$this->omzet_stl_1thn->Raw) {
            $this->omzet_stl_1thn->CurrentValue = HtmlDecode($this->omzet_stl_1thn->CurrentValue);
        }
        $this->omzet_stl_1thn->EditValue = $this->omzet_stl_1thn->CurrentValue;
        $this->omzet_stl_1thn->PlaceHolder = RemoveHtml($this->omzet_stl_1thn->caption());

        // omzet_stl_2thn
        $this->omzet_stl_2thn->EditAttrs["class"] = "form-control";
        $this->omzet_stl_2thn->EditCustomAttributes = "";
        if (!$this->omzet_stl_2thn->Raw) {
            $this->omzet_stl_2thn->CurrentValue = HtmlDecode($this->omzet_stl_2thn->CurrentValue);
        }
        $this->omzet_stl_2thn->EditValue = $this->omzet_stl_2thn->CurrentValue;
        $this->omzet_stl_2thn->PlaceHolder = RemoveHtml($this->omzet_stl_2thn->caption());

        // kapasitas_saat_ini
        $this->kapasitas_saat_ini->EditAttrs["class"] = "form-control";
        $this->kapasitas_saat_ini->EditCustomAttributes = "";
        if (!$this->kapasitas_saat_ini->Raw) {
            $this->kapasitas_saat_ini->CurrentValue = HtmlDecode($this->kapasitas_saat_ini->CurrentValue);
        }
        $this->kapasitas_saat_ini->EditValue = $this->kapasitas_saat_ini->CurrentValue;
        $this->kapasitas_saat_ini->PlaceHolder = RemoveHtml($this->kapasitas_saat_ini->caption());

        // kapasitas_stl_6bln
        $this->kapasitas_stl_6bln->EditAttrs["class"] = "form-control";
        $this->kapasitas_stl_6bln->EditCustomAttributes = "";
        if (!$this->kapasitas_stl_6bln->Raw) {
            $this->kapasitas_stl_6bln->CurrentValue = HtmlDecode($this->kapasitas_stl_6bln->CurrentValue);
        }
        $this->kapasitas_stl_6bln->EditValue = $this->kapasitas_stl_6bln->CurrentValue;
        $this->kapasitas_stl_6bln->PlaceHolder = RemoveHtml($this->kapasitas_stl_6bln->caption());

        // kapasitas_stl_1thn
        $this->kapasitas_stl_1thn->EditAttrs["class"] = "form-control";
        $this->kapasitas_stl_1thn->EditCustomAttributes = "";
        if (!$this->kapasitas_stl_1thn->Raw) {
            $this->kapasitas_stl_1thn->CurrentValue = HtmlDecode($this->kapasitas_stl_1thn->CurrentValue);
        }
        $this->kapasitas_stl_1thn->EditValue = $this->kapasitas_stl_1thn->CurrentValue;
        $this->kapasitas_stl_1thn->PlaceHolder = RemoveHtml($this->kapasitas_stl_1thn->caption());

        // kapasitas_stl_2thn
        $this->kapasitas_stl_2thn->EditAttrs["class"] = "form-control";
        $this->kapasitas_stl_2thn->EditCustomAttributes = "";
        if (!$this->kapasitas_stl_2thn->Raw) {
            $this->kapasitas_stl_2thn->CurrentValue = HtmlDecode($this->kapasitas_stl_2thn->CurrentValue);
        }
        $this->kapasitas_stl_2thn->EditValue = $this->kapasitas_stl_2thn->CurrentValue;
        $this->kapasitas_stl_2thn->PlaceHolder = RemoveHtml($this->kapasitas_stl_2thn->caption());

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

        // hscode
        $this->hscode->EditAttrs["class"] = "form-control";
        $this->hscode->EditCustomAttributes = "";
        $this->hscode->EditValue = $this->hscode->CurrentValue;
        $this->hscode->PlaceHolder = RemoveHtml($this->hscode->caption());

        // imp
        $this->imp->EditAttrs["class"] = "form-control";
        $this->imp->EditCustomAttributes = "";
        $this->imp->EditValue = $this->imp->CurrentValue;
        $this->imp->PlaceHolder = RemoveHtml($this->imp->caption());

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
                    $doc->exportCaption($this->idp);
                    $doc->exportCaption($this->namap);
                    $doc->exportCaption($this->kontak);
                    $doc->exportCaption($this->kdlokasi);
                    $doc->exportCaption($this->alamatp);
                    $doc->exportCaption($this->kdprop);
                    $doc->exportCaption($this->kdkota);
                    $doc->exportCaption($this->kdkec);
                    $doc->exportCaption($this->kdpos);
                    $doc->exportCaption($this->telpp);
                    $doc->exportCaption($this->faxp);
                    $doc->exportCaption($this->emailp);
                    $doc->exportCaption($this->webp);
                    $doc->exportCaption($this->medsos);
                    $doc->exportCaption($this->kdproduknafed);
                    $doc->exportCaption($this->kdproduknafed2);
                    $doc->exportCaption($this->kdproduknafed3);
                    $doc->exportCaption($this->pproduk);
                    $doc->exportCaption($this->kdskala);
                    $doc->exportCaption($this->kdjenis);
                    $doc->exportCaption($this->kdexport);
                    $doc->exportCaption($this->nexport);
                    $doc->exportCaption($this->kdkategori);
                    $doc->exportCaption($this->omzet_saat_ini);
                    $doc->exportCaption($this->omzet_stl_6bln);
                    $doc->exportCaption($this->omzet_stl_1thn);
                    $doc->exportCaption($this->omzet_stl_2thn);
                    $doc->exportCaption($this->kapasitas_saat_ini);
                    $doc->exportCaption($this->kapasitas_stl_6bln);
                    $doc->exportCaption($this->kapasitas_stl_1thn);
                    $doc->exportCaption($this->kapasitas_stl_2thn);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->user_created_by);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->user_updated_by);
                    $doc->exportCaption($this->hscode);
                    $doc->exportCaption($this->imp);
                } else {
                    $doc->exportCaption($this->idp);
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
                    $doc->exportCaption($this->kdproduknafed);
                    $doc->exportCaption($this->kdproduknafed2);
                    $doc->exportCaption($this->kdproduknafed3);
                    $doc->exportCaption($this->kdskala);
                    $doc->exportCaption($this->kdjenis);
                    $doc->exportCaption($this->kdexport);
                    $doc->exportCaption($this->kdkategori);
                    $doc->exportCaption($this->omzet_saat_ini);
                    $doc->exportCaption($this->omzet_stl_6bln);
                    $doc->exportCaption($this->omzet_stl_1thn);
                    $doc->exportCaption($this->omzet_stl_2thn);
                    $doc->exportCaption($this->kapasitas_saat_ini);
                    $doc->exportCaption($this->kapasitas_stl_6bln);
                    $doc->exportCaption($this->kapasitas_stl_1thn);
                    $doc->exportCaption($this->kapasitas_stl_2thn);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->user_created_by);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->user_updated_by);
                    $doc->exportCaption($this->imp);
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
                        $doc->exportField($this->idp);
                        $doc->exportField($this->namap);
                        $doc->exportField($this->kontak);
                        $doc->exportField($this->kdlokasi);
                        $doc->exportField($this->alamatp);
                        $doc->exportField($this->kdprop);
                        $doc->exportField($this->kdkota);
                        $doc->exportField($this->kdkec);
                        $doc->exportField($this->kdpos);
                        $doc->exportField($this->telpp);
                        $doc->exportField($this->faxp);
                        $doc->exportField($this->emailp);
                        $doc->exportField($this->webp);
                        $doc->exportField($this->medsos);
                        $doc->exportField($this->kdproduknafed);
                        $doc->exportField($this->kdproduknafed2);
                        $doc->exportField($this->kdproduknafed3);
                        $doc->exportField($this->pproduk);
                        $doc->exportField($this->kdskala);
                        $doc->exportField($this->kdjenis);
                        $doc->exportField($this->kdexport);
                        $doc->exportField($this->nexport);
                        $doc->exportField($this->kdkategori);
                        $doc->exportField($this->omzet_saat_ini);
                        $doc->exportField($this->omzet_stl_6bln);
                        $doc->exportField($this->omzet_stl_1thn);
                        $doc->exportField($this->omzet_stl_2thn);
                        $doc->exportField($this->kapasitas_saat_ini);
                        $doc->exportField($this->kapasitas_stl_6bln);
                        $doc->exportField($this->kapasitas_stl_1thn);
                        $doc->exportField($this->kapasitas_stl_2thn);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->user_created_by);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->user_updated_by);
                        $doc->exportField($this->hscode);
                        $doc->exportField($this->imp);
                    } else {
                        $doc->exportField($this->idp);
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
                        $doc->exportField($this->kdproduknafed);
                        $doc->exportField($this->kdproduknafed2);
                        $doc->exportField($this->kdproduknafed3);
                        $doc->exportField($this->kdskala);
                        $doc->exportField($this->kdjenis);
                        $doc->exportField($this->kdexport);
                        $doc->exportField($this->kdkategori);
                        $doc->exportField($this->omzet_saat_ini);
                        $doc->exportField($this->omzet_stl_6bln);
                        $doc->exportField($this->omzet_stl_1thn);
                        $doc->exportField($this->omzet_stl_2thn);
                        $doc->exportField($this->kapasitas_saat_ini);
                        $doc->exportField($this->kapasitas_stl_6bln);
                        $doc->exportField($this->kapasitas_stl_1thn);
                        $doc->exportField($this->kapasitas_stl_2thn);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->user_created_by);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->user_updated_by);
                        $doc->exportField($this->imp);
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
