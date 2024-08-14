<?php

namespace PHPMaker2021\import_ppei;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for data_master
 */
class DataMaster extends DbTable
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
    public $dipindahkan;
    public $id;
    public $kdpelat;
    public $Email_Address;
    public $Nama_Lengkap;
    public $Nomor_Handphone;
    public $Jenis_Kelamin;
    public $Tempat_Lahir;
    public $Tanggal_Lahir;
    public $Alamat_Tinggal;
    public $Provinsi;
    public $Kabupaten_Kota;
    public $Jabatan_di_Perusahaan;
    public $Pendidikan;
    public $Nama_Perusahaan_Instansi;
    public $Contact_Person_Perusahaan;
    public $Telepon_Kantor;
    public $_Email;
    public $Website;
    public $Alamat_Kantor;
    public $Provinsi2;
    public $Kabupaten_Kota2;
    public $ID_Sosial_Media;
    public $Kategori_perusahaan;
    public $Jenis_Usaha;
    public $Skala_Perusahaan;
    public $Kategori_Produk;
    public $Produk_Perusahaan;
    public $HS_Code_Product;
    public $Omset_Perusahaan;
    public $Kapasitas_Produksi;
    public $Pengalaman_Ekspor;
    public $ekspor_ke_negara_mana;
    public $mengikuti_pelatihan_sebelumnya;
    public $pelatihan_apa_dimana;
    public $mendapatkan_informasi;
    public $harapkan_dari_pelatihan;
    public $data_diisi_benar;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'data_master';
        $this->TableName = 'data_master';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`data_master`";
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

        // dipindahkan
        $this->dipindahkan = new DbField('data_master', 'data_master', 'x_dipindahkan', 'dipindahkan', '`dipindahkan`', '`dipindahkan`', 16, 1, -1, false, '`dipindahkan`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->dipindahkan->Nullable = false; // NOT NULL field
        $this->dipindahkan->Sortable = true; // Allow sort
        $this->dipindahkan->DataType = DATATYPE_BOOLEAN;
        $this->dipindahkan->Lookup = new Lookup('dipindahkan', 'data_master', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->dipindahkan->OptionCount = 2;
        $this->dipindahkan->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->dipindahkan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dipindahkan->Param, "CustomMsg");
        $this->Fields['dipindahkan'] = &$this->dipindahkan;

        // id
        $this->id = new DbField('data_master', 'data_master', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // kdpelat
        $this->kdpelat = new DbField('data_master', 'data_master', 'x_kdpelat', 'kdpelat', '`kdpelat`', '`kdpelat`', 200, 25, -1, false, '`kdpelat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdpelat->Sortable = true; // Allow sort
        $this->kdpelat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdpelat->Param, "CustomMsg");
        $this->Fields['kdpelat'] = &$this->kdpelat;

        // Email_Address
        $this->Email_Address = new DbField('data_master', 'data_master', 'x_Email_Address', 'Email_Address', '`Email_Address`', '`Email_Address`', 201, 65535, -1, false, '`Email_Address`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Email_Address->Sortable = true; // Allow sort
        $this->Email_Address->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Email_Address->Param, "CustomMsg");
        $this->Fields['Email_Address'] = &$this->Email_Address;

        // Nama_Lengkap
        $this->Nama_Lengkap = new DbField('data_master', 'data_master', 'x_Nama_Lengkap', 'Nama_Lengkap', '`Nama_Lengkap`', '`Nama_Lengkap`', 201, 65535, -1, false, '`Nama_Lengkap`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Nama_Lengkap->Sortable = true; // Allow sort
        $this->Nama_Lengkap->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nama_Lengkap->Param, "CustomMsg");
        $this->Fields['Nama_Lengkap'] = &$this->Nama_Lengkap;

        // Nomor_Handphone
        $this->Nomor_Handphone = new DbField('data_master', 'data_master', 'x_Nomor_Handphone', 'Nomor_Handphone', '`Nomor_Handphone`', '`Nomor_Handphone`', 201, 65535, -1, false, '`Nomor_Handphone`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Nomor_Handphone->Sortable = true; // Allow sort
        $this->Nomor_Handphone->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nomor_Handphone->Param, "CustomMsg");
        $this->Fields['Nomor_Handphone'] = &$this->Nomor_Handphone;

        // Jenis_Kelamin
        $this->Jenis_Kelamin = new DbField('data_master', 'data_master', 'x_Jenis_Kelamin', 'Jenis_Kelamin', '`Jenis_Kelamin`', '`Jenis_Kelamin`', 201, 65535, -1, false, '`Jenis_Kelamin`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Jenis_Kelamin->Sortable = true; // Allow sort
        $this->Jenis_Kelamin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jenis_Kelamin->Param, "CustomMsg");
        $this->Fields['Jenis_Kelamin'] = &$this->Jenis_Kelamin;

        // Tempat_Lahir
        $this->Tempat_Lahir = new DbField('data_master', 'data_master', 'x_Tempat_Lahir', 'Tempat_Lahir', '`Tempat_Lahir`', '`Tempat_Lahir`', 201, 65535, -1, false, '`Tempat_Lahir`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Tempat_Lahir->Sortable = true; // Allow sort
        $this->Tempat_Lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Tempat_Lahir->Param, "CustomMsg");
        $this->Fields['Tempat_Lahir'] = &$this->Tempat_Lahir;

        // Tanggal_Lahir
        $this->Tanggal_Lahir = new DbField('data_master', 'data_master', 'x_Tanggal_Lahir', 'Tanggal_Lahir', '`Tanggal_Lahir`', '`Tanggal_Lahir`', 201, 65535, -1, false, '`Tanggal_Lahir`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Tanggal_Lahir->Sortable = true; // Allow sort
        $this->Tanggal_Lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Tanggal_Lahir->Param, "CustomMsg");
        $this->Fields['Tanggal_Lahir'] = &$this->Tanggal_Lahir;

        // Alamat_Tinggal
        $this->Alamat_Tinggal = new DbField('data_master', 'data_master', 'x_Alamat_Tinggal', 'Alamat_Tinggal', '`Alamat_Tinggal`', '`Alamat_Tinggal`', 201, 65535, -1, false, '`Alamat_Tinggal`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Alamat_Tinggal->Sortable = true; // Allow sort
        $this->Alamat_Tinggal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Alamat_Tinggal->Param, "CustomMsg");
        $this->Fields['Alamat_Tinggal'] = &$this->Alamat_Tinggal;

        // Provinsi
        $this->Provinsi = new DbField('data_master', 'data_master', 'x_Provinsi', 'Provinsi', '`Provinsi`', '`Provinsi`', 201, 65535, -1, false, '`Provinsi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Provinsi->Sortable = true; // Allow sort
        $this->Provinsi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Provinsi->Param, "CustomMsg");
        $this->Fields['Provinsi'] = &$this->Provinsi;

        // Kabupaten_Kota
        $this->Kabupaten_Kota = new DbField('data_master', 'data_master', 'x_Kabupaten_Kota', 'Kabupaten_Kota', '`Kabupaten_Kota`', '`Kabupaten_Kota`', 201, 65535, -1, false, '`Kabupaten_Kota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kabupaten_Kota->Sortable = true; // Allow sort
        $this->Kabupaten_Kota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kabupaten_Kota->Param, "CustomMsg");
        $this->Fields['Kabupaten_Kota'] = &$this->Kabupaten_Kota;

        // Jabatan_di_Perusahaan
        $this->Jabatan_di_Perusahaan = new DbField('data_master', 'data_master', 'x_Jabatan_di_Perusahaan', 'Jabatan_di_Perusahaan', '`Jabatan_di_Perusahaan`', '`Jabatan_di_Perusahaan`', 201, 65535, -1, false, '`Jabatan_di_Perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Jabatan_di_Perusahaan->Sortable = true; // Allow sort
        $this->Jabatan_di_Perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jabatan_di_Perusahaan->Param, "CustomMsg");
        $this->Fields['Jabatan_di_Perusahaan'] = &$this->Jabatan_di_Perusahaan;

        // Pendidikan
        $this->Pendidikan = new DbField('data_master', 'data_master', 'x_Pendidikan', 'Pendidikan', '`Pendidikan`', '`Pendidikan`', 201, 65535, -1, false, '`Pendidikan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Pendidikan->Sortable = true; // Allow sort
        $this->Pendidikan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Pendidikan->Param, "CustomMsg");
        $this->Fields['Pendidikan'] = &$this->Pendidikan;

        // Nama_Perusahaan_Instansi
        $this->Nama_Perusahaan_Instansi = new DbField('data_master', 'data_master', 'x_Nama_Perusahaan_Instansi', 'Nama_Perusahaan_Instansi', '`Nama_Perusahaan_Instansi`', '`Nama_Perusahaan_Instansi`', 201, 65535, -1, false, '`Nama_Perusahaan_Instansi`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Nama_Perusahaan_Instansi->Sortable = true; // Allow sort
        $this->Nama_Perusahaan_Instansi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nama_Perusahaan_Instansi->Param, "CustomMsg");
        $this->Fields['Nama_Perusahaan_Instansi'] = &$this->Nama_Perusahaan_Instansi;

        // Contact_Person_Perusahaan
        $this->Contact_Person_Perusahaan = new DbField('data_master', 'data_master', 'x_Contact_Person_Perusahaan', 'Contact_Person_Perusahaan', '`Contact_Person_Perusahaan`', '`Contact_Person_Perusahaan`', 201, 65535, -1, false, '`Contact_Person_Perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Contact_Person_Perusahaan->Sortable = true; // Allow sort
        $this->Contact_Person_Perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Contact_Person_Perusahaan->Param, "CustomMsg");
        $this->Fields['Contact_Person_Perusahaan'] = &$this->Contact_Person_Perusahaan;

        // Telepon_Kantor
        $this->Telepon_Kantor = new DbField('data_master', 'data_master', 'x_Telepon_Kantor', 'Telepon_Kantor', '`Telepon_Kantor`', '`Telepon_Kantor`', 201, 65535, -1, false, '`Telepon_Kantor`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Telepon_Kantor->Sortable = true; // Allow sort
        $this->Telepon_Kantor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Telepon_Kantor->Param, "CustomMsg");
        $this->Fields['Telepon_Kantor'] = &$this->Telepon_Kantor;

        // Email
        $this->_Email = new DbField('data_master', 'data_master', 'x__Email', 'Email', '`Email`', '`Email`', 201, 65535, -1, false, '`Email`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->_Email->Sortable = true; // Allow sort
        $this->_Email->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_Email->Param, "CustomMsg");
        $this->Fields['Email'] = &$this->_Email;

        // Website
        $this->Website = new DbField('data_master', 'data_master', 'x_Website', 'Website', '`Website`', '`Website`', 201, 65535, -1, false, '`Website`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Website->Sortable = true; // Allow sort
        $this->Website->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Website->Param, "CustomMsg");
        $this->Fields['Website'] = &$this->Website;

        // Alamat_Kantor
        $this->Alamat_Kantor = new DbField('data_master', 'data_master', 'x_Alamat_Kantor', 'Alamat_Kantor', '`Alamat_Kantor`', '`Alamat_Kantor`', 201, 65535, -1, false, '`Alamat_Kantor`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Alamat_Kantor->Sortable = true; // Allow sort
        $this->Alamat_Kantor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Alamat_Kantor->Param, "CustomMsg");
        $this->Fields['Alamat_Kantor'] = &$this->Alamat_Kantor;

        // Provinsi2
        $this->Provinsi2 = new DbField('data_master', 'data_master', 'x_Provinsi2', 'Provinsi2', '`Provinsi2`', '`Provinsi2`', 201, 65535, -1, false, '`Provinsi2`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Provinsi2->Sortable = true; // Allow sort
        $this->Provinsi2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Provinsi2->Param, "CustomMsg");
        $this->Fields['Provinsi2'] = &$this->Provinsi2;

        // Kabupaten_Kota2
        $this->Kabupaten_Kota2 = new DbField('data_master', 'data_master', 'x_Kabupaten_Kota2', 'Kabupaten_Kota2', '`Kabupaten_Kota2`', '`Kabupaten_Kota2`', 201, 65535, -1, false, '`Kabupaten_Kota2`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Kabupaten_Kota2->Sortable = true; // Allow sort
        $this->Kabupaten_Kota2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kabupaten_Kota2->Param, "CustomMsg");
        $this->Fields['Kabupaten_Kota2'] = &$this->Kabupaten_Kota2;

        // ID_Sosial_Media
        $this->ID_Sosial_Media = new DbField('data_master', 'data_master', 'x_ID_Sosial_Media', 'ID_Sosial_Media', '`ID_Sosial_Media`', '`ID_Sosial_Media`', 201, 65535, -1, false, '`ID_Sosial_Media`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ID_Sosial_Media->Sortable = true; // Allow sort
        $this->ID_Sosial_Media->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID_Sosial_Media->Param, "CustomMsg");
        $this->Fields['ID_Sosial_Media'] = &$this->ID_Sosial_Media;

        // Kategori_perusahaan
        $this->Kategori_perusahaan = new DbField('data_master', 'data_master', 'x_Kategori_perusahaan', 'Kategori_perusahaan', '`Kategori_perusahaan`', '`Kategori_perusahaan`', 201, 65535, -1, false, '`Kategori_perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Kategori_perusahaan->Sortable = true; // Allow sort
        $this->Kategori_perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kategori_perusahaan->Param, "CustomMsg");
        $this->Fields['Kategori_perusahaan'] = &$this->Kategori_perusahaan;

        // Jenis_Usaha
        $this->Jenis_Usaha = new DbField('data_master', 'data_master', 'x_Jenis_Usaha', 'Jenis_Usaha', '`Jenis_Usaha`', '`Jenis_Usaha`', 201, 65535, -1, false, '`Jenis_Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Jenis_Usaha->Sortable = true; // Allow sort
        $this->Jenis_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jenis_Usaha->Param, "CustomMsg");
        $this->Fields['Jenis_Usaha'] = &$this->Jenis_Usaha;

        // Skala_Perusahaan
        $this->Skala_Perusahaan = new DbField('data_master', 'data_master', 'x_Skala_Perusahaan', 'Skala_Perusahaan', '`Skala_Perusahaan`', '`Skala_Perusahaan`', 201, 65535, -1, false, '`Skala_Perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Skala_Perusahaan->Sortable = true; // Allow sort
        $this->Skala_Perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Skala_Perusahaan->Param, "CustomMsg");
        $this->Fields['Skala_Perusahaan'] = &$this->Skala_Perusahaan;

        // Kategori_Produk
        $this->Kategori_Produk = new DbField('data_master', 'data_master', 'x_Kategori_Produk', 'Kategori_Produk', '`Kategori_Produk`', '`Kategori_Produk`', 201, 65535, -1, false, '`Kategori_Produk`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Kategori_Produk->Sortable = true; // Allow sort
        $this->Kategori_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kategori_Produk->Param, "CustomMsg");
        $this->Fields['Kategori_Produk'] = &$this->Kategori_Produk;

        // Produk_Perusahaan
        $this->Produk_Perusahaan = new DbField('data_master', 'data_master', 'x_Produk_Perusahaan', 'Produk_Perusahaan', '`Produk_Perusahaan`', '`Produk_Perusahaan`', 201, 65535, -1, false, '`Produk_Perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Produk_Perusahaan->Sortable = true; // Allow sort
        $this->Produk_Perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Produk_Perusahaan->Param, "CustomMsg");
        $this->Fields['Produk_Perusahaan'] = &$this->Produk_Perusahaan;

        // HS_Code_Product
        $this->HS_Code_Product = new DbField('data_master', 'data_master', 'x_HS_Code_Product', 'HS_Code_Product', '`HS_Code_Product`', '`HS_Code_Product`', 201, 65535, -1, false, '`HS_Code_Product`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->HS_Code_Product->Sortable = true; // Allow sort
        $this->HS_Code_Product->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HS_Code_Product->Param, "CustomMsg");
        $this->Fields['HS_Code_Product'] = &$this->HS_Code_Product;

        // Omset_Perusahaan
        $this->Omset_Perusahaan = new DbField('data_master', 'data_master', 'x_Omset_Perusahaan', 'Omset_Perusahaan', '`Omset_Perusahaan`', '`Omset_Perusahaan`', 201, 65535, -1, false, '`Omset_Perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Omset_Perusahaan->Sortable = true; // Allow sort
        $this->Omset_Perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Omset_Perusahaan->Param, "CustomMsg");
        $this->Fields['Omset_Perusahaan'] = &$this->Omset_Perusahaan;

        // Kapasitas_Produksi
        $this->Kapasitas_Produksi = new DbField('data_master', 'data_master', 'x_Kapasitas_Produksi', 'Kapasitas_Produksi', '`Kapasitas_Produksi`', '`Kapasitas_Produksi`', 201, 65535, -1, false, '`Kapasitas_Produksi`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Kapasitas_Produksi->Sortable = true; // Allow sort
        $this->Kapasitas_Produksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kapasitas_Produksi->Param, "CustomMsg");
        $this->Fields['Kapasitas_Produksi'] = &$this->Kapasitas_Produksi;

        // Pengalaman_Ekspor
        $this->Pengalaman_Ekspor = new DbField('data_master', 'data_master', 'x_Pengalaman_Ekspor', 'Pengalaman_Ekspor', '`Pengalaman_Ekspor`', '`Pengalaman_Ekspor`', 201, 65535, -1, false, '`Pengalaman_Ekspor`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Pengalaman_Ekspor->Sortable = true; // Allow sort
        $this->Pengalaman_Ekspor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Pengalaman_Ekspor->Param, "CustomMsg");
        $this->Fields['Pengalaman_Ekspor'] = &$this->Pengalaman_Ekspor;

        // ekspor_ke_negara_mana
        $this->ekspor_ke_negara_mana = new DbField('data_master', 'data_master', 'x_ekspor_ke_negara_mana', 'ekspor_ke_negara_mana', '`ekspor_ke_negara_mana`', '`ekspor_ke_negara_mana`', 201, 65535, -1, false, '`ekspor_ke_negara_mana`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ekspor_ke_negara_mana->Sortable = true; // Allow sort
        $this->ekspor_ke_negara_mana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ekspor_ke_negara_mana->Param, "CustomMsg");
        $this->Fields['ekspor_ke_negara_mana'] = &$this->ekspor_ke_negara_mana;

        // mengikuti_pelatihan_sebelumnya
        $this->mengikuti_pelatihan_sebelumnya = new DbField('data_master', 'data_master', 'x_mengikuti_pelatihan_sebelumnya', 'mengikuti_pelatihan_sebelumnya', '`mengikuti_pelatihan_sebelumnya`', '`mengikuti_pelatihan_sebelumnya`', 201, 65535, -1, false, '`mengikuti_pelatihan_sebelumnya`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->mengikuti_pelatihan_sebelumnya->Sortable = true; // Allow sort
        $this->mengikuti_pelatihan_sebelumnya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->mengikuti_pelatihan_sebelumnya->Param, "CustomMsg");
        $this->Fields['mengikuti_pelatihan_sebelumnya'] = &$this->mengikuti_pelatihan_sebelumnya;

        // pelatihan_apa_dimana
        $this->pelatihan_apa_dimana = new DbField('data_master', 'data_master', 'x_pelatihan_apa_dimana', 'pelatihan_apa_dimana', '`pelatihan_apa_dimana`', '`pelatihan_apa_dimana`', 201, 65535, -1, false, '`pelatihan_apa_dimana`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->pelatihan_apa_dimana->Sortable = true; // Allow sort
        $this->pelatihan_apa_dimana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pelatihan_apa_dimana->Param, "CustomMsg");
        $this->Fields['pelatihan_apa_dimana'] = &$this->pelatihan_apa_dimana;

        // mendapatkan_informasi
        $this->mendapatkan_informasi = new DbField('data_master', 'data_master', 'x_mendapatkan_informasi', 'mendapatkan_informasi', '`mendapatkan_informasi`', '`mendapatkan_informasi`', 201, 65535, -1, false, '`mendapatkan_informasi`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->mendapatkan_informasi->Sortable = true; // Allow sort
        $this->mendapatkan_informasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->mendapatkan_informasi->Param, "CustomMsg");
        $this->Fields['mendapatkan_informasi'] = &$this->mendapatkan_informasi;

        // harapkan_dari_pelatihan
        $this->harapkan_dari_pelatihan = new DbField('data_master', 'data_master', 'x_harapkan_dari_pelatihan', 'harapkan_dari_pelatihan', '`harapkan_dari_pelatihan`', '`harapkan_dari_pelatihan`', 201, 65535, -1, false, '`harapkan_dari_pelatihan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->harapkan_dari_pelatihan->Sortable = true; // Allow sort
        $this->harapkan_dari_pelatihan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->harapkan_dari_pelatihan->Param, "CustomMsg");
        $this->Fields['harapkan_dari_pelatihan'] = &$this->harapkan_dari_pelatihan;

        // data_diisi_benar
        $this->data_diisi_benar = new DbField('data_master', 'data_master', 'x_data_diisi_benar', 'data_diisi_benar', '`data_diisi_benar`', '`data_diisi_benar`', 201, 65535, -1, false, '`data_diisi_benar`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->data_diisi_benar->Sortable = true; // Allow sort
        $this->data_diisi_benar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->data_diisi_benar->Param, "CustomMsg");
        $this->Fields['data_diisi_benar'] = &$this->data_diisi_benar;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`data_master`";
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
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
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
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
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
        $this->dipindahkan->DbValue = $row['dipindahkan'];
        $this->id->DbValue = $row['id'];
        $this->kdpelat->DbValue = $row['kdpelat'];
        $this->Email_Address->DbValue = $row['Email_Address'];
        $this->Nama_Lengkap->DbValue = $row['Nama_Lengkap'];
        $this->Nomor_Handphone->DbValue = $row['Nomor_Handphone'];
        $this->Jenis_Kelamin->DbValue = $row['Jenis_Kelamin'];
        $this->Tempat_Lahir->DbValue = $row['Tempat_Lahir'];
        $this->Tanggal_Lahir->DbValue = $row['Tanggal_Lahir'];
        $this->Alamat_Tinggal->DbValue = $row['Alamat_Tinggal'];
        $this->Provinsi->DbValue = $row['Provinsi'];
        $this->Kabupaten_Kota->DbValue = $row['Kabupaten_Kota'];
        $this->Jabatan_di_Perusahaan->DbValue = $row['Jabatan_di_Perusahaan'];
        $this->Pendidikan->DbValue = $row['Pendidikan'];
        $this->Nama_Perusahaan_Instansi->DbValue = $row['Nama_Perusahaan_Instansi'];
        $this->Contact_Person_Perusahaan->DbValue = $row['Contact_Person_Perusahaan'];
        $this->Telepon_Kantor->DbValue = $row['Telepon_Kantor'];
        $this->_Email->DbValue = $row['Email'];
        $this->Website->DbValue = $row['Website'];
        $this->Alamat_Kantor->DbValue = $row['Alamat_Kantor'];
        $this->Provinsi2->DbValue = $row['Provinsi2'];
        $this->Kabupaten_Kota2->DbValue = $row['Kabupaten_Kota2'];
        $this->ID_Sosial_Media->DbValue = $row['ID_Sosial_Media'];
        $this->Kategori_perusahaan->DbValue = $row['Kategori_perusahaan'];
        $this->Jenis_Usaha->DbValue = $row['Jenis_Usaha'];
        $this->Skala_Perusahaan->DbValue = $row['Skala_Perusahaan'];
        $this->Kategori_Produk->DbValue = $row['Kategori_Produk'];
        $this->Produk_Perusahaan->DbValue = $row['Produk_Perusahaan'];
        $this->HS_Code_Product->DbValue = $row['HS_Code_Product'];
        $this->Omset_Perusahaan->DbValue = $row['Omset_Perusahaan'];
        $this->Kapasitas_Produksi->DbValue = $row['Kapasitas_Produksi'];
        $this->Pengalaman_Ekspor->DbValue = $row['Pengalaman_Ekspor'];
        $this->ekspor_ke_negara_mana->DbValue = $row['ekspor_ke_negara_mana'];
        $this->mengikuti_pelatihan_sebelumnya->DbValue = $row['mengikuti_pelatihan_sebelumnya'];
        $this->pelatihan_apa_dimana->DbValue = $row['pelatihan_apa_dimana'];
        $this->mendapatkan_informasi->DbValue = $row['mendapatkan_informasi'];
        $this->harapkan_dari_pelatihan->DbValue = $row['harapkan_dari_pelatihan'];
        $this->data_diisi_benar->DbValue = $row['data_diisi_benar'];
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

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
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
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("datamasterlist");
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
        if ($pageName == "datamasterview") {
            return $Language->phrase("View");
        } elseif ($pageName == "datamasteredit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "datamasteradd") {
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
                return "DataMasterView";
            case Config("API_ADD_ACTION"):
                return "DataMasterAdd";
            case Config("API_EDIT_ACTION"):
                return "DataMasterEdit";
            case Config("API_DELETE_ACTION"):
                return "DataMasterDelete";
            case Config("API_LIST_ACTION"):
                return "DataMasterList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "datamasterlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("datamasterview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("datamasterview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "datamasteradd?" . $this->getUrlParm($parm);
        } else {
            $url = "datamasteradd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("datamasteredit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("datamasteradd", $this->getUrlParm($parm));
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
        return $this->keyUrl("datamasterdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id->CurrentValue);
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
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
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
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
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
        $this->dipindahkan->setDbValue($row['dipindahkan']);
        $this->id->setDbValue($row['id']);
        $this->kdpelat->setDbValue($row['kdpelat']);
        $this->Email_Address->setDbValue($row['Email_Address']);
        $this->Nama_Lengkap->setDbValue($row['Nama_Lengkap']);
        $this->Nomor_Handphone->setDbValue($row['Nomor_Handphone']);
        $this->Jenis_Kelamin->setDbValue($row['Jenis_Kelamin']);
        $this->Tempat_Lahir->setDbValue($row['Tempat_Lahir']);
        $this->Tanggal_Lahir->setDbValue($row['Tanggal_Lahir']);
        $this->Alamat_Tinggal->setDbValue($row['Alamat_Tinggal']);
        $this->Provinsi->setDbValue($row['Provinsi']);
        $this->Kabupaten_Kota->setDbValue($row['Kabupaten_Kota']);
        $this->Jabatan_di_Perusahaan->setDbValue($row['Jabatan_di_Perusahaan']);
        $this->Pendidikan->setDbValue($row['Pendidikan']);
        $this->Nama_Perusahaan_Instansi->setDbValue($row['Nama_Perusahaan_Instansi']);
        $this->Contact_Person_Perusahaan->setDbValue($row['Contact_Person_Perusahaan']);
        $this->Telepon_Kantor->setDbValue($row['Telepon_Kantor']);
        $this->_Email->setDbValue($row['Email']);
        $this->Website->setDbValue($row['Website']);
        $this->Alamat_Kantor->setDbValue($row['Alamat_Kantor']);
        $this->Provinsi2->setDbValue($row['Provinsi2']);
        $this->Kabupaten_Kota2->setDbValue($row['Kabupaten_Kota2']);
        $this->ID_Sosial_Media->setDbValue($row['ID_Sosial_Media']);
        $this->Kategori_perusahaan->setDbValue($row['Kategori_perusahaan']);
        $this->Jenis_Usaha->setDbValue($row['Jenis_Usaha']);
        $this->Skala_Perusahaan->setDbValue($row['Skala_Perusahaan']);
        $this->Kategori_Produk->setDbValue($row['Kategori_Produk']);
        $this->Produk_Perusahaan->setDbValue($row['Produk_Perusahaan']);
        $this->HS_Code_Product->setDbValue($row['HS_Code_Product']);
        $this->Omset_Perusahaan->setDbValue($row['Omset_Perusahaan']);
        $this->Kapasitas_Produksi->setDbValue($row['Kapasitas_Produksi']);
        $this->Pengalaman_Ekspor->setDbValue($row['Pengalaman_Ekspor']);
        $this->ekspor_ke_negara_mana->setDbValue($row['ekspor_ke_negara_mana']);
        $this->mengikuti_pelatihan_sebelumnya->setDbValue($row['mengikuti_pelatihan_sebelumnya']);
        $this->pelatihan_apa_dimana->setDbValue($row['pelatihan_apa_dimana']);
        $this->mendapatkan_informasi->setDbValue($row['mendapatkan_informasi']);
        $this->harapkan_dari_pelatihan->setDbValue($row['harapkan_dari_pelatihan']);
        $this->data_diisi_benar->setDbValue($row['data_diisi_benar']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // dipindahkan

        // id

        // kdpelat

        // Email_Address

        // Nama_Lengkap

        // Nomor_Handphone

        // Jenis_Kelamin

        // Tempat_Lahir

        // Tanggal_Lahir

        // Alamat_Tinggal

        // Provinsi

        // Kabupaten_Kota

        // Jabatan_di_Perusahaan

        // Pendidikan

        // Nama_Perusahaan_Instansi

        // Contact_Person_Perusahaan

        // Telepon_Kantor

        // Email

        // Website

        // Alamat_Kantor

        // Provinsi2

        // Kabupaten_Kota2

        // ID_Sosial_Media

        // Kategori_perusahaan

        // Jenis_Usaha

        // Skala_Perusahaan

        // Kategori_Produk

        // Produk_Perusahaan

        // HS_Code_Product

        // Omset_Perusahaan

        // Kapasitas_Produksi

        // Pengalaman_Ekspor

        // ekspor_ke_negara_mana

        // mengikuti_pelatihan_sebelumnya

        // pelatihan_apa_dimana

        // mendapatkan_informasi

        // harapkan_dari_pelatihan

        // data_diisi_benar

        // dipindahkan
        if (ConvertToBool($this->dipindahkan->CurrentValue)) {
            $this->dipindahkan->ViewValue = $this->dipindahkan->tagCaption(1) != "" ? $this->dipindahkan->tagCaption(1) : "Yes";
        } else {
            $this->dipindahkan->ViewValue = $this->dipindahkan->tagCaption(2) != "" ? $this->dipindahkan->tagCaption(2) : "No";
        }
        $this->dipindahkan->ViewCustomAttributes = "";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // kdpelat
        $this->kdpelat->ViewValue = $this->kdpelat->CurrentValue;
        $this->kdpelat->ViewCustomAttributes = "";

        // Email_Address
        $this->Email_Address->ViewValue = $this->Email_Address->CurrentValue;
        $this->Email_Address->ViewCustomAttributes = "";

        // Nama_Lengkap
        $this->Nama_Lengkap->ViewValue = $this->Nama_Lengkap->CurrentValue;
        $this->Nama_Lengkap->ViewCustomAttributes = "";

        // Nomor_Handphone
        $this->Nomor_Handphone->ViewValue = $this->Nomor_Handphone->CurrentValue;
        $this->Nomor_Handphone->ViewCustomAttributes = "";

        // Jenis_Kelamin
        $this->Jenis_Kelamin->ViewValue = $this->Jenis_Kelamin->CurrentValue;
        $this->Jenis_Kelamin->ViewCustomAttributes = "";

        // Tempat_Lahir
        $this->Tempat_Lahir->ViewValue = $this->Tempat_Lahir->CurrentValue;
        $this->Tempat_Lahir->ViewCustomAttributes = "";

        // Tanggal_Lahir
        $this->Tanggal_Lahir->ViewValue = $this->Tanggal_Lahir->CurrentValue;
        $this->Tanggal_Lahir->ViewCustomAttributes = "";

        // Alamat_Tinggal
        $this->Alamat_Tinggal->ViewValue = $this->Alamat_Tinggal->CurrentValue;
        $this->Alamat_Tinggal->ViewCustomAttributes = "";

        // Provinsi
        $this->Provinsi->ViewValue = $this->Provinsi->CurrentValue;
        $this->Provinsi->ViewCustomAttributes = "";

        // Kabupaten_Kota
        $this->Kabupaten_Kota->ViewValue = $this->Kabupaten_Kota->CurrentValue;
        $this->Kabupaten_Kota->ViewCustomAttributes = "";

        // Jabatan_di_Perusahaan
        $this->Jabatan_di_Perusahaan->ViewValue = $this->Jabatan_di_Perusahaan->CurrentValue;
        $this->Jabatan_di_Perusahaan->ViewCustomAttributes = "";

        // Pendidikan
        $this->Pendidikan->ViewValue = $this->Pendidikan->CurrentValue;
        $this->Pendidikan->ViewCustomAttributes = "";

        // Nama_Perusahaan_Instansi
        $this->Nama_Perusahaan_Instansi->ViewValue = $this->Nama_Perusahaan_Instansi->CurrentValue;
        $this->Nama_Perusahaan_Instansi->ViewCustomAttributes = "";

        // Contact_Person_Perusahaan
        $this->Contact_Person_Perusahaan->ViewValue = $this->Contact_Person_Perusahaan->CurrentValue;
        $this->Contact_Person_Perusahaan->ViewCustomAttributes = "";

        // Telepon_Kantor
        $this->Telepon_Kantor->ViewValue = $this->Telepon_Kantor->CurrentValue;
        $this->Telepon_Kantor->ViewCustomAttributes = "";

        // Email
        $this->_Email->ViewValue = $this->_Email->CurrentValue;
        $this->_Email->ViewCustomAttributes = "";

        // Website
        $this->Website->ViewValue = $this->Website->CurrentValue;
        $this->Website->ViewCustomAttributes = "";

        // Alamat_Kantor
        $this->Alamat_Kantor->ViewValue = $this->Alamat_Kantor->CurrentValue;
        $this->Alamat_Kantor->ViewCustomAttributes = "";

        // Provinsi2
        $this->Provinsi2->ViewValue = $this->Provinsi2->CurrentValue;
        $this->Provinsi2->ViewCustomAttributes = "";

        // Kabupaten_Kota2
        $this->Kabupaten_Kota2->ViewValue = $this->Kabupaten_Kota2->CurrentValue;
        $this->Kabupaten_Kota2->ViewCustomAttributes = "";

        // ID_Sosial_Media
        $this->ID_Sosial_Media->ViewValue = $this->ID_Sosial_Media->CurrentValue;
        $this->ID_Sosial_Media->ViewCustomAttributes = "";

        // Kategori_perusahaan
        $this->Kategori_perusahaan->ViewValue = $this->Kategori_perusahaan->CurrentValue;
        $this->Kategori_perusahaan->ViewCustomAttributes = "";

        // Jenis_Usaha
        $this->Jenis_Usaha->ViewValue = $this->Jenis_Usaha->CurrentValue;
        $this->Jenis_Usaha->ViewCustomAttributes = "";

        // Skala_Perusahaan
        $this->Skala_Perusahaan->ViewValue = $this->Skala_Perusahaan->CurrentValue;
        $this->Skala_Perusahaan->ViewCustomAttributes = "";

        // Kategori_Produk
        $this->Kategori_Produk->ViewValue = $this->Kategori_Produk->CurrentValue;
        $this->Kategori_Produk->ViewCustomAttributes = "";

        // Produk_Perusahaan
        $this->Produk_Perusahaan->ViewValue = $this->Produk_Perusahaan->CurrentValue;
        $this->Produk_Perusahaan->ViewCustomAttributes = "";

        // HS_Code_Product
        $this->HS_Code_Product->ViewValue = $this->HS_Code_Product->CurrentValue;
        $this->HS_Code_Product->ViewCustomAttributes = "";

        // Omset_Perusahaan
        $this->Omset_Perusahaan->ViewValue = $this->Omset_Perusahaan->CurrentValue;
        $this->Omset_Perusahaan->ViewCustomAttributes = "";

        // Kapasitas_Produksi
        $this->Kapasitas_Produksi->ViewValue = $this->Kapasitas_Produksi->CurrentValue;
        $this->Kapasitas_Produksi->ViewCustomAttributes = "";

        // Pengalaman_Ekspor
        $this->Pengalaman_Ekspor->ViewValue = $this->Pengalaman_Ekspor->CurrentValue;
        $this->Pengalaman_Ekspor->ViewCustomAttributes = "";

        // ekspor_ke_negara_mana
        $this->ekspor_ke_negara_mana->ViewValue = $this->ekspor_ke_negara_mana->CurrentValue;
        $this->ekspor_ke_negara_mana->ViewCustomAttributes = "";

        // mengikuti_pelatihan_sebelumnya
        $this->mengikuti_pelatihan_sebelumnya->ViewValue = $this->mengikuti_pelatihan_sebelumnya->CurrentValue;
        $this->mengikuti_pelatihan_sebelumnya->ViewCustomAttributes = "";

        // pelatihan_apa_dimana
        $this->pelatihan_apa_dimana->ViewValue = $this->pelatihan_apa_dimana->CurrentValue;
        $this->pelatihan_apa_dimana->ViewCustomAttributes = "";

        // mendapatkan_informasi
        $this->mendapatkan_informasi->ViewValue = $this->mendapatkan_informasi->CurrentValue;
        $this->mendapatkan_informasi->ViewCustomAttributes = "";

        // harapkan_dari_pelatihan
        $this->harapkan_dari_pelatihan->ViewValue = $this->harapkan_dari_pelatihan->CurrentValue;
        $this->harapkan_dari_pelatihan->ViewCustomAttributes = "";

        // data_diisi_benar
        $this->data_diisi_benar->ViewValue = $this->data_diisi_benar->CurrentValue;
        $this->data_diisi_benar->ViewCustomAttributes = "";

        // dipindahkan
        $this->dipindahkan->LinkCustomAttributes = "";
        $this->dipindahkan->HrefValue = "";
        $this->dipindahkan->TooltipValue = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // kdpelat
        $this->kdpelat->LinkCustomAttributes = "";
        $this->kdpelat->HrefValue = "";
        $this->kdpelat->TooltipValue = "";

        // Email_Address
        $this->Email_Address->LinkCustomAttributes = "";
        $this->Email_Address->HrefValue = "";
        $this->Email_Address->TooltipValue = "";

        // Nama_Lengkap
        $this->Nama_Lengkap->LinkCustomAttributes = "";
        $this->Nama_Lengkap->HrefValue = "";
        $this->Nama_Lengkap->TooltipValue = "";

        // Nomor_Handphone
        $this->Nomor_Handphone->LinkCustomAttributes = "";
        $this->Nomor_Handphone->HrefValue = "";
        $this->Nomor_Handphone->TooltipValue = "";

        // Jenis_Kelamin
        $this->Jenis_Kelamin->LinkCustomAttributes = "";
        $this->Jenis_Kelamin->HrefValue = "";
        $this->Jenis_Kelamin->TooltipValue = "";

        // Tempat_Lahir
        $this->Tempat_Lahir->LinkCustomAttributes = "";
        $this->Tempat_Lahir->HrefValue = "";
        $this->Tempat_Lahir->TooltipValue = "";

        // Tanggal_Lahir
        $this->Tanggal_Lahir->LinkCustomAttributes = "";
        $this->Tanggal_Lahir->HrefValue = "";
        $this->Tanggal_Lahir->TooltipValue = "";

        // Alamat_Tinggal
        $this->Alamat_Tinggal->LinkCustomAttributes = "";
        $this->Alamat_Tinggal->HrefValue = "";
        $this->Alamat_Tinggal->TooltipValue = "";

        // Provinsi
        $this->Provinsi->LinkCustomAttributes = "";
        $this->Provinsi->HrefValue = "";
        $this->Provinsi->TooltipValue = "";

        // Kabupaten_Kota
        $this->Kabupaten_Kota->LinkCustomAttributes = "";
        $this->Kabupaten_Kota->HrefValue = "";
        $this->Kabupaten_Kota->TooltipValue = "";

        // Jabatan_di_Perusahaan
        $this->Jabatan_di_Perusahaan->LinkCustomAttributes = "";
        $this->Jabatan_di_Perusahaan->HrefValue = "";
        $this->Jabatan_di_Perusahaan->TooltipValue = "";

        // Pendidikan
        $this->Pendidikan->LinkCustomAttributes = "";
        $this->Pendidikan->HrefValue = "";
        $this->Pendidikan->TooltipValue = "";

        // Nama_Perusahaan_Instansi
        $this->Nama_Perusahaan_Instansi->LinkCustomAttributes = "";
        $this->Nama_Perusahaan_Instansi->HrefValue = "";
        $this->Nama_Perusahaan_Instansi->TooltipValue = "";

        // Contact_Person_Perusahaan
        $this->Contact_Person_Perusahaan->LinkCustomAttributes = "";
        $this->Contact_Person_Perusahaan->HrefValue = "";
        $this->Contact_Person_Perusahaan->TooltipValue = "";

        // Telepon_Kantor
        $this->Telepon_Kantor->LinkCustomAttributes = "";
        $this->Telepon_Kantor->HrefValue = "";
        $this->Telepon_Kantor->TooltipValue = "";

        // Email
        $this->_Email->LinkCustomAttributes = "";
        $this->_Email->HrefValue = "";
        $this->_Email->TooltipValue = "";

        // Website
        $this->Website->LinkCustomAttributes = "";
        $this->Website->HrefValue = "";
        $this->Website->TooltipValue = "";

        // Alamat_Kantor
        $this->Alamat_Kantor->LinkCustomAttributes = "";
        $this->Alamat_Kantor->HrefValue = "";
        $this->Alamat_Kantor->TooltipValue = "";

        // Provinsi2
        $this->Provinsi2->LinkCustomAttributes = "";
        $this->Provinsi2->HrefValue = "";
        $this->Provinsi2->TooltipValue = "";

        // Kabupaten_Kota2
        $this->Kabupaten_Kota2->LinkCustomAttributes = "";
        $this->Kabupaten_Kota2->HrefValue = "";
        $this->Kabupaten_Kota2->TooltipValue = "";

        // ID_Sosial_Media
        $this->ID_Sosial_Media->LinkCustomAttributes = "";
        $this->ID_Sosial_Media->HrefValue = "";
        $this->ID_Sosial_Media->TooltipValue = "";

        // Kategori_perusahaan
        $this->Kategori_perusahaan->LinkCustomAttributes = "";
        $this->Kategori_perusahaan->HrefValue = "";
        $this->Kategori_perusahaan->TooltipValue = "";

        // Jenis_Usaha
        $this->Jenis_Usaha->LinkCustomAttributes = "";
        $this->Jenis_Usaha->HrefValue = "";
        $this->Jenis_Usaha->TooltipValue = "";

        // Skala_Perusahaan
        $this->Skala_Perusahaan->LinkCustomAttributes = "";
        $this->Skala_Perusahaan->HrefValue = "";
        $this->Skala_Perusahaan->TooltipValue = "";

        // Kategori_Produk
        $this->Kategori_Produk->LinkCustomAttributes = "";
        $this->Kategori_Produk->HrefValue = "";
        $this->Kategori_Produk->TooltipValue = "";

        // Produk_Perusahaan
        $this->Produk_Perusahaan->LinkCustomAttributes = "";
        $this->Produk_Perusahaan->HrefValue = "";
        $this->Produk_Perusahaan->TooltipValue = "";

        // HS_Code_Product
        $this->HS_Code_Product->LinkCustomAttributes = "";
        $this->HS_Code_Product->HrefValue = "";
        $this->HS_Code_Product->TooltipValue = "";

        // Omset_Perusahaan
        $this->Omset_Perusahaan->LinkCustomAttributes = "";
        $this->Omset_Perusahaan->HrefValue = "";
        $this->Omset_Perusahaan->TooltipValue = "";

        // Kapasitas_Produksi
        $this->Kapasitas_Produksi->LinkCustomAttributes = "";
        $this->Kapasitas_Produksi->HrefValue = "";
        $this->Kapasitas_Produksi->TooltipValue = "";

        // Pengalaman_Ekspor
        $this->Pengalaman_Ekspor->LinkCustomAttributes = "";
        $this->Pengalaman_Ekspor->HrefValue = "";
        $this->Pengalaman_Ekspor->TooltipValue = "";

        // ekspor_ke_negara_mana
        $this->ekspor_ke_negara_mana->LinkCustomAttributes = "";
        $this->ekspor_ke_negara_mana->HrefValue = "";
        $this->ekspor_ke_negara_mana->TooltipValue = "";

        // mengikuti_pelatihan_sebelumnya
        $this->mengikuti_pelatihan_sebelumnya->LinkCustomAttributes = "";
        $this->mengikuti_pelatihan_sebelumnya->HrefValue = "";
        $this->mengikuti_pelatihan_sebelumnya->TooltipValue = "";

        // pelatihan_apa_dimana
        $this->pelatihan_apa_dimana->LinkCustomAttributes = "";
        $this->pelatihan_apa_dimana->HrefValue = "";
        $this->pelatihan_apa_dimana->TooltipValue = "";

        // mendapatkan_informasi
        $this->mendapatkan_informasi->LinkCustomAttributes = "";
        $this->mendapatkan_informasi->HrefValue = "";
        $this->mendapatkan_informasi->TooltipValue = "";

        // harapkan_dari_pelatihan
        $this->harapkan_dari_pelatihan->LinkCustomAttributes = "";
        $this->harapkan_dari_pelatihan->HrefValue = "";
        $this->harapkan_dari_pelatihan->TooltipValue = "";

        // data_diisi_benar
        $this->data_diisi_benar->LinkCustomAttributes = "";
        $this->data_diisi_benar->HrefValue = "";
        $this->data_diisi_benar->TooltipValue = "";

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

        // dipindahkan
        $this->dipindahkan->EditCustomAttributes = "";
        $this->dipindahkan->EditValue = $this->dipindahkan->options(false);
        $this->dipindahkan->PlaceHolder = RemoveHtml($this->dipindahkan->caption());

        // id
        $this->id->EditAttrs["class"] = "form-control";
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // kdpelat
        $this->kdpelat->EditAttrs["class"] = "form-control";
        $this->kdpelat->EditCustomAttributes = "";
        if (!$this->kdpelat->Raw) {
            $this->kdpelat->CurrentValue = HtmlDecode($this->kdpelat->CurrentValue);
        }
        $this->kdpelat->EditValue = $this->kdpelat->CurrentValue;
        $this->kdpelat->PlaceHolder = RemoveHtml($this->kdpelat->caption());

        // Email_Address
        $this->Email_Address->EditAttrs["class"] = "form-control";
        $this->Email_Address->EditCustomAttributes = "";
        $this->Email_Address->EditValue = $this->Email_Address->CurrentValue;
        $this->Email_Address->PlaceHolder = RemoveHtml($this->Email_Address->caption());

        // Nama_Lengkap
        $this->Nama_Lengkap->EditAttrs["class"] = "form-control";
        $this->Nama_Lengkap->EditCustomAttributes = "";
        $this->Nama_Lengkap->EditValue = $this->Nama_Lengkap->CurrentValue;
        $this->Nama_Lengkap->PlaceHolder = RemoveHtml($this->Nama_Lengkap->caption());

        // Nomor_Handphone
        $this->Nomor_Handphone->EditAttrs["class"] = "form-control";
        $this->Nomor_Handphone->EditCustomAttributes = "";
        $this->Nomor_Handphone->EditValue = $this->Nomor_Handphone->CurrentValue;
        $this->Nomor_Handphone->PlaceHolder = RemoveHtml($this->Nomor_Handphone->caption());

        // Jenis_Kelamin
        $this->Jenis_Kelamin->EditAttrs["class"] = "form-control";
        $this->Jenis_Kelamin->EditCustomAttributes = "";
        $this->Jenis_Kelamin->EditValue = $this->Jenis_Kelamin->CurrentValue;
        $this->Jenis_Kelamin->PlaceHolder = RemoveHtml($this->Jenis_Kelamin->caption());

        // Tempat_Lahir
        $this->Tempat_Lahir->EditAttrs["class"] = "form-control";
        $this->Tempat_Lahir->EditCustomAttributes = "";
        $this->Tempat_Lahir->EditValue = $this->Tempat_Lahir->CurrentValue;
        $this->Tempat_Lahir->PlaceHolder = RemoveHtml($this->Tempat_Lahir->caption());

        // Tanggal_Lahir
        $this->Tanggal_Lahir->EditAttrs["class"] = "form-control";
        $this->Tanggal_Lahir->EditCustomAttributes = "";
        $this->Tanggal_Lahir->EditValue = $this->Tanggal_Lahir->CurrentValue;
        $this->Tanggal_Lahir->PlaceHolder = RemoveHtml($this->Tanggal_Lahir->caption());

        // Alamat_Tinggal
        $this->Alamat_Tinggal->EditAttrs["class"] = "form-control";
        $this->Alamat_Tinggal->EditCustomAttributes = "";
        $this->Alamat_Tinggal->EditValue = $this->Alamat_Tinggal->CurrentValue;
        $this->Alamat_Tinggal->PlaceHolder = RemoveHtml($this->Alamat_Tinggal->caption());

        // Provinsi
        $this->Provinsi->EditAttrs["class"] = "form-control";
        $this->Provinsi->EditCustomAttributes = "";
        if (!$this->Provinsi->Raw) {
            $this->Provinsi->CurrentValue = HtmlDecode($this->Provinsi->CurrentValue);
        }
        $this->Provinsi->EditValue = $this->Provinsi->CurrentValue;
        $this->Provinsi->PlaceHolder = RemoveHtml($this->Provinsi->caption());

        // Kabupaten_Kota
        $this->Kabupaten_Kota->EditAttrs["class"] = "form-control";
        $this->Kabupaten_Kota->EditCustomAttributes = "";
        if (!$this->Kabupaten_Kota->Raw) {
            $this->Kabupaten_Kota->CurrentValue = HtmlDecode($this->Kabupaten_Kota->CurrentValue);
        }
        $this->Kabupaten_Kota->EditValue = $this->Kabupaten_Kota->CurrentValue;
        $this->Kabupaten_Kota->PlaceHolder = RemoveHtml($this->Kabupaten_Kota->caption());

        // Jabatan_di_Perusahaan
        $this->Jabatan_di_Perusahaan->EditAttrs["class"] = "form-control";
        $this->Jabatan_di_Perusahaan->EditCustomAttributes = "";
        $this->Jabatan_di_Perusahaan->EditValue = $this->Jabatan_di_Perusahaan->CurrentValue;
        $this->Jabatan_di_Perusahaan->PlaceHolder = RemoveHtml($this->Jabatan_di_Perusahaan->caption());

        // Pendidikan
        $this->Pendidikan->EditAttrs["class"] = "form-control";
        $this->Pendidikan->EditCustomAttributes = "";
        $this->Pendidikan->EditValue = $this->Pendidikan->CurrentValue;
        $this->Pendidikan->PlaceHolder = RemoveHtml($this->Pendidikan->caption());

        // Nama_Perusahaan_Instansi
        $this->Nama_Perusahaan_Instansi->EditAttrs["class"] = "form-control";
        $this->Nama_Perusahaan_Instansi->EditCustomAttributes = "";
        $this->Nama_Perusahaan_Instansi->EditValue = $this->Nama_Perusahaan_Instansi->CurrentValue;
        $this->Nama_Perusahaan_Instansi->PlaceHolder = RemoveHtml($this->Nama_Perusahaan_Instansi->caption());

        // Contact_Person_Perusahaan
        $this->Contact_Person_Perusahaan->EditAttrs["class"] = "form-control";
        $this->Contact_Person_Perusahaan->EditCustomAttributes = "";
        $this->Contact_Person_Perusahaan->EditValue = $this->Contact_Person_Perusahaan->CurrentValue;
        $this->Contact_Person_Perusahaan->PlaceHolder = RemoveHtml($this->Contact_Person_Perusahaan->caption());

        // Telepon_Kantor
        $this->Telepon_Kantor->EditAttrs["class"] = "form-control";
        $this->Telepon_Kantor->EditCustomAttributes = "";
        $this->Telepon_Kantor->EditValue = $this->Telepon_Kantor->CurrentValue;
        $this->Telepon_Kantor->PlaceHolder = RemoveHtml($this->Telepon_Kantor->caption());

        // Email
        $this->_Email->EditAttrs["class"] = "form-control";
        $this->_Email->EditCustomAttributes = "";
        $this->_Email->EditValue = $this->_Email->CurrentValue;
        $this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

        // Website
        $this->Website->EditAttrs["class"] = "form-control";
        $this->Website->EditCustomAttributes = "";
        $this->Website->EditValue = $this->Website->CurrentValue;
        $this->Website->PlaceHolder = RemoveHtml($this->Website->caption());

        // Alamat_Kantor
        $this->Alamat_Kantor->EditAttrs["class"] = "form-control";
        $this->Alamat_Kantor->EditCustomAttributes = "";
        $this->Alamat_Kantor->EditValue = $this->Alamat_Kantor->CurrentValue;
        $this->Alamat_Kantor->PlaceHolder = RemoveHtml($this->Alamat_Kantor->caption());

        // Provinsi2
        $this->Provinsi2->EditAttrs["class"] = "form-control";
        $this->Provinsi2->EditCustomAttributes = "";
        $this->Provinsi2->EditValue = $this->Provinsi2->CurrentValue;
        $this->Provinsi2->PlaceHolder = RemoveHtml($this->Provinsi2->caption());

        // Kabupaten_Kota2
        $this->Kabupaten_Kota2->EditAttrs["class"] = "form-control";
        $this->Kabupaten_Kota2->EditCustomAttributes = "";
        $this->Kabupaten_Kota2->EditValue = $this->Kabupaten_Kota2->CurrentValue;
        $this->Kabupaten_Kota2->PlaceHolder = RemoveHtml($this->Kabupaten_Kota2->caption());

        // ID_Sosial_Media
        $this->ID_Sosial_Media->EditAttrs["class"] = "form-control";
        $this->ID_Sosial_Media->EditCustomAttributes = "";
        $this->ID_Sosial_Media->EditValue = $this->ID_Sosial_Media->CurrentValue;
        $this->ID_Sosial_Media->PlaceHolder = RemoveHtml($this->ID_Sosial_Media->caption());

        // Kategori_perusahaan
        $this->Kategori_perusahaan->EditAttrs["class"] = "form-control";
        $this->Kategori_perusahaan->EditCustomAttributes = "";
        $this->Kategori_perusahaan->EditValue = $this->Kategori_perusahaan->CurrentValue;
        $this->Kategori_perusahaan->PlaceHolder = RemoveHtml($this->Kategori_perusahaan->caption());

        // Jenis_Usaha
        $this->Jenis_Usaha->EditAttrs["class"] = "form-control";
        $this->Jenis_Usaha->EditCustomAttributes = "";
        $this->Jenis_Usaha->EditValue = $this->Jenis_Usaha->CurrentValue;
        $this->Jenis_Usaha->PlaceHolder = RemoveHtml($this->Jenis_Usaha->caption());

        // Skala_Perusahaan
        $this->Skala_Perusahaan->EditAttrs["class"] = "form-control";
        $this->Skala_Perusahaan->EditCustomAttributes = "";
        $this->Skala_Perusahaan->EditValue = $this->Skala_Perusahaan->CurrentValue;
        $this->Skala_Perusahaan->PlaceHolder = RemoveHtml($this->Skala_Perusahaan->caption());

        // Kategori_Produk
        $this->Kategori_Produk->EditAttrs["class"] = "form-control";
        $this->Kategori_Produk->EditCustomAttributes = "";
        $this->Kategori_Produk->EditValue = $this->Kategori_Produk->CurrentValue;
        $this->Kategori_Produk->PlaceHolder = RemoveHtml($this->Kategori_Produk->caption());

        // Produk_Perusahaan
        $this->Produk_Perusahaan->EditAttrs["class"] = "form-control";
        $this->Produk_Perusahaan->EditCustomAttributes = "";
        $this->Produk_Perusahaan->EditValue = $this->Produk_Perusahaan->CurrentValue;
        $this->Produk_Perusahaan->PlaceHolder = RemoveHtml($this->Produk_Perusahaan->caption());

        // HS_Code_Product
        $this->HS_Code_Product->EditAttrs["class"] = "form-control";
        $this->HS_Code_Product->EditCustomAttributes = "";
        $this->HS_Code_Product->EditValue = $this->HS_Code_Product->CurrentValue;
        $this->HS_Code_Product->PlaceHolder = RemoveHtml($this->HS_Code_Product->caption());

        // Omset_Perusahaan
        $this->Omset_Perusahaan->EditAttrs["class"] = "form-control";
        $this->Omset_Perusahaan->EditCustomAttributes = "";
        $this->Omset_Perusahaan->EditValue = $this->Omset_Perusahaan->CurrentValue;
        $this->Omset_Perusahaan->PlaceHolder = RemoveHtml($this->Omset_Perusahaan->caption());

        // Kapasitas_Produksi
        $this->Kapasitas_Produksi->EditAttrs["class"] = "form-control";
        $this->Kapasitas_Produksi->EditCustomAttributes = "";
        $this->Kapasitas_Produksi->EditValue = $this->Kapasitas_Produksi->CurrentValue;
        $this->Kapasitas_Produksi->PlaceHolder = RemoveHtml($this->Kapasitas_Produksi->caption());

        // Pengalaman_Ekspor
        $this->Pengalaman_Ekspor->EditAttrs["class"] = "form-control";
        $this->Pengalaman_Ekspor->EditCustomAttributes = "";
        $this->Pengalaman_Ekspor->EditValue = $this->Pengalaman_Ekspor->CurrentValue;
        $this->Pengalaman_Ekspor->PlaceHolder = RemoveHtml($this->Pengalaman_Ekspor->caption());

        // ekspor_ke_negara_mana
        $this->ekspor_ke_negara_mana->EditAttrs["class"] = "form-control";
        $this->ekspor_ke_negara_mana->EditCustomAttributes = "";
        $this->ekspor_ke_negara_mana->EditValue = $this->ekspor_ke_negara_mana->CurrentValue;
        $this->ekspor_ke_negara_mana->PlaceHolder = RemoveHtml($this->ekspor_ke_negara_mana->caption());

        // mengikuti_pelatihan_sebelumnya
        $this->mengikuti_pelatihan_sebelumnya->EditAttrs["class"] = "form-control";
        $this->mengikuti_pelatihan_sebelumnya->EditCustomAttributes = "";
        $this->mengikuti_pelatihan_sebelumnya->EditValue = $this->mengikuti_pelatihan_sebelumnya->CurrentValue;
        $this->mengikuti_pelatihan_sebelumnya->PlaceHolder = RemoveHtml($this->mengikuti_pelatihan_sebelumnya->caption());

        // pelatihan_apa_dimana
        $this->pelatihan_apa_dimana->EditAttrs["class"] = "form-control";
        $this->pelatihan_apa_dimana->EditCustomAttributes = "";
        $this->pelatihan_apa_dimana->EditValue = $this->pelatihan_apa_dimana->CurrentValue;
        $this->pelatihan_apa_dimana->PlaceHolder = RemoveHtml($this->pelatihan_apa_dimana->caption());

        // mendapatkan_informasi
        $this->mendapatkan_informasi->EditAttrs["class"] = "form-control";
        $this->mendapatkan_informasi->EditCustomAttributes = "";
        $this->mendapatkan_informasi->EditValue = $this->mendapatkan_informasi->CurrentValue;
        $this->mendapatkan_informasi->PlaceHolder = RemoveHtml($this->mendapatkan_informasi->caption());

        // harapkan_dari_pelatihan
        $this->harapkan_dari_pelatihan->EditAttrs["class"] = "form-control";
        $this->harapkan_dari_pelatihan->EditCustomAttributes = "";
        $this->harapkan_dari_pelatihan->EditValue = $this->harapkan_dari_pelatihan->CurrentValue;
        $this->harapkan_dari_pelatihan->PlaceHolder = RemoveHtml($this->harapkan_dari_pelatihan->caption());

        // data_diisi_benar
        $this->data_diisi_benar->EditAttrs["class"] = "form-control";
        $this->data_diisi_benar->EditCustomAttributes = "";
        $this->data_diisi_benar->EditValue = $this->data_diisi_benar->CurrentValue;
        $this->data_diisi_benar->PlaceHolder = RemoveHtml($this->data_diisi_benar->caption());

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
                    $doc->exportCaption($this->dipindahkan);
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->kdpelat);
                    $doc->exportCaption($this->Email_Address);
                    $doc->exportCaption($this->Nama_Lengkap);
                    $doc->exportCaption($this->Nomor_Handphone);
                    $doc->exportCaption($this->Jenis_Kelamin);
                    $doc->exportCaption($this->Tempat_Lahir);
                    $doc->exportCaption($this->Tanggal_Lahir);
                    $doc->exportCaption($this->Alamat_Tinggal);
                    $doc->exportCaption($this->Provinsi);
                    $doc->exportCaption($this->Kabupaten_Kota);
                    $doc->exportCaption($this->Jabatan_di_Perusahaan);
                    $doc->exportCaption($this->Pendidikan);
                    $doc->exportCaption($this->Nama_Perusahaan_Instansi);
                    $doc->exportCaption($this->Contact_Person_Perusahaan);
                    $doc->exportCaption($this->Telepon_Kantor);
                    $doc->exportCaption($this->_Email);
                    $doc->exportCaption($this->Website);
                    $doc->exportCaption($this->Alamat_Kantor);
                    $doc->exportCaption($this->Provinsi2);
                    $doc->exportCaption($this->Kabupaten_Kota2);
                    $doc->exportCaption($this->ID_Sosial_Media);
                    $doc->exportCaption($this->Kategori_perusahaan);
                    $doc->exportCaption($this->Jenis_Usaha);
                    $doc->exportCaption($this->Skala_Perusahaan);
                    $doc->exportCaption($this->Kategori_Produk);
                    $doc->exportCaption($this->Produk_Perusahaan);
                    $doc->exportCaption($this->HS_Code_Product);
                    $doc->exportCaption($this->Omset_Perusahaan);
                    $doc->exportCaption($this->Kapasitas_Produksi);
                    $doc->exportCaption($this->Pengalaman_Ekspor);
                    $doc->exportCaption($this->ekspor_ke_negara_mana);
                    $doc->exportCaption($this->mengikuti_pelatihan_sebelumnya);
                    $doc->exportCaption($this->pelatihan_apa_dimana);
                    $doc->exportCaption($this->mendapatkan_informasi);
                    $doc->exportCaption($this->harapkan_dari_pelatihan);
                    $doc->exportCaption($this->data_diisi_benar);
                } else {
                    $doc->exportCaption($this->dipindahkan);
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->kdpelat);
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
                        $doc->exportField($this->dipindahkan);
                        $doc->exportField($this->id);
                        $doc->exportField($this->kdpelat);
                        $doc->exportField($this->Email_Address);
                        $doc->exportField($this->Nama_Lengkap);
                        $doc->exportField($this->Nomor_Handphone);
                        $doc->exportField($this->Jenis_Kelamin);
                        $doc->exportField($this->Tempat_Lahir);
                        $doc->exportField($this->Tanggal_Lahir);
                        $doc->exportField($this->Alamat_Tinggal);
                        $doc->exportField($this->Provinsi);
                        $doc->exportField($this->Kabupaten_Kota);
                        $doc->exportField($this->Jabatan_di_Perusahaan);
                        $doc->exportField($this->Pendidikan);
                        $doc->exportField($this->Nama_Perusahaan_Instansi);
                        $doc->exportField($this->Contact_Person_Perusahaan);
                        $doc->exportField($this->Telepon_Kantor);
                        $doc->exportField($this->_Email);
                        $doc->exportField($this->Website);
                        $doc->exportField($this->Alamat_Kantor);
                        $doc->exportField($this->Provinsi2);
                        $doc->exportField($this->Kabupaten_Kota2);
                        $doc->exportField($this->ID_Sosial_Media);
                        $doc->exportField($this->Kategori_perusahaan);
                        $doc->exportField($this->Jenis_Usaha);
                        $doc->exportField($this->Skala_Perusahaan);
                        $doc->exportField($this->Kategori_Produk);
                        $doc->exportField($this->Produk_Perusahaan);
                        $doc->exportField($this->HS_Code_Product);
                        $doc->exportField($this->Omset_Perusahaan);
                        $doc->exportField($this->Kapasitas_Produksi);
                        $doc->exportField($this->Pengalaman_Ekspor);
                        $doc->exportField($this->ekspor_ke_negara_mana);
                        $doc->exportField($this->mengikuti_pelatihan_sebelumnya);
                        $doc->exportField($this->pelatihan_apa_dimana);
                        $doc->exportField($this->mendapatkan_informasi);
                        $doc->exportField($this->harapkan_dari_pelatihan);
                        $doc->exportField($this->data_diisi_benar);
                    } else {
                        $doc->exportField($this->dipindahkan);
                        $doc->exportField($this->id);
                        $doc->exportField($this->kdpelat);
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
    	$this->Jenis_Kelamin->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Tanggal_Lahir->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Provinsi->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Jabatan_di_Perusahaan->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Pendidikan->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Kabupaten_Kota->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Provinsi2->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Kabupaten_Kota2->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Kategori_perusahaan->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Jenis_Usaha->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Skala_Perusahaan->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Kategori_Produk->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->Pengalaman_Ekspor->ViewAttrs["class"] = "bg-warning text-warning";
    	$this->mendapatkan_informasi->ViewAttrs["class"] = "bg-warning text-warning";
    	if($this->dipindahkan->CurrentValue == 1){ // sudah dipindahkan
    		$this->dipindahkan->CellAttrs["style"]  = "background-color: #feffcb";
    	}
    /*
    	if(@$_GET["p"] == 'insertdata' ) {
            $cekpindah = ExecuteScalar("SELECT COUNT(1) FROM `data_master` WHERE dipindahkan = 0");
            if($cekpindah > 0){
            	$ambil_idp = ExecuteScalar("SELECT idp FROM `t_perusahaan` WHERE imp = 1 AND namap LIKE '".$this->Nama_Perusahaan_Instansi."'");
        		$myResult = ExecuteUpdate("INSERT INTO `t_peserta`(`nama`, `idp`, `tlahir`, `alamat`, `telp`, `email`, `kdprop`, `kdkota`, `kdsex`, `hp`, `kdjabat`, `kdpend`, `harapan`, `kdinformasi`, `created_at`, `imp`) VALUES('".$this->."',)");
        	}
        }
    */
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
