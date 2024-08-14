<?php

namespace PHPMaker2021\import_ppei;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "data_master" => \DI\create(DataMaster::class),
    "customexport" => \DI\create(Customexport::class),
    "diklatkerjasama" => \DI\create(Diklatkerjasama::class),
    "diklatpusat" => \DI\create(Diklatpusat::class),
    "audittrail" => \DI\create(Audittrail::class),
    "dm_ecp" => \DI\create(DmEcp::class),
    "petri" => \DI\create(Petri::class),
    "real_keu_pelatihan" => \DI\create(RealKeuPelatihan::class),
    "real_prog" => \DI\create(RealProg::class),
    "real_pst_jk" => \DI\create(RealPstJk::class),
    "dm_pesertaecp" => \DI\create(DmPesertaecp::class),
    "t_agama" => \DI\create(TAgama::class),
    "t_area" => \DI\create(TArea::class),
    "t_bagian" => \DI\create(TBagian::class),
    "t_bahasa" => \DI\create(TBahasa::class),
    "t_bidang" => \DI\create(TBidang::class),
    "t_biointruktur" => \DI\create(TBiointruktur::class),
    "t_coaching" => \DI\create(TCoaching::class),
    "t_coachingtahapan" => \DI\create(TCoachingtahapan::class),
    "t_cp" => \DI\create(TCp::class),
    "t_ecp" => \DI\create(TEcp::class),
    "t_evafas" => \DI\create(TEvafas::class),
    "t_evakhir" => \DI\create(TEvakhir::class),
    "t_evakunjlap" => \DI\create(TEvakunjlap::class),
    "t_evaluasi" => \DI\create(TEvaluasi::class),
    "t_evaluasifas" => \DI\create(TEvaluasifas::class),
    "t_evapant" => \DI\create(TEvapant::class),
    "t_evasis" => \DI\create(TEvasis::class),
    "t_export" => \DI\create(TExport::class),
    "t_faskur" => \DI\create(TFaskur::class),
    "t_hari" => \DI\create(THari::class),
    "t_informasi" => \DI\create(TInformasi::class),
    "t_instrukturpelatihan" => \DI\create(TInstrukturpelatihan::class),
    "t_jabatan" => \DI\create(TJabatan::class),
    "t_jadwalpel" => \DI\create(TJadwalpel::class),
    "t_jadwalwebinar" => \DI\create(TJadwalwebinar::class),
    "t_jdiklat" => \DI\create(TJdiklat::class),
    "t_jenis" => \DI\create(TJenis::class),
    "t_judul" => \DI\create(TJudul::class),
    "t_juduldetail" => \DI\create(TJuduldetail::class),
    "t_kat_produk" => \DI\create(TKatProduk::class),
    "t_kategori" => \DI\create(TKategori::class),
    "t_kec" => \DI\create(TKec::class),
    "t_kota" => \DI\create(TKota::class),
    "t_kota_old" => \DI\create(TKotaOld::class),
    "t_kurikulum" => \DI\create(TKurikulum::class),
    "t_lokasi" => \DI\create(TLokasi::class),
    "t_negara" => \DI\create(TNegara::class),
    "t_pcp" => \DI\create(TPcp::class),
    "t_pegawai" => \DI\create(TPegawai::class),
    "t_pelatihan" => \DI\create(TPelatihan::class),
    "t_pendidikan" => \DI\create(TPendidikan::class),
    "t_perusahaan" => \DI\create(TPerusahaan::class),
    "t_peserta" => \DI\create(TPeserta::class),
    "t_pp" => \DI\create(TPp::class),
    "t_preposttest" => \DI\create(TPreposttest::class),
    "t_produk" => \DI\create(TProduk::class),
    "t_produknafed" => \DI\create(TProduknafed::class),
    "t_prop" => \DI\create(TProp::class),
    "t_pweb" => \DI\create(TPweb::class),
    "t_repeserta" => \DI\create(TRepeserta::class),
    "t_rkcoaching" => \DI\create(TRkcoaching::class),
    "t_rkwebinar" => \DI\create(TRkwebinar::class),
    "t_rpdiklat" => \DI\create(TRpdiklat::class),
    "t_rpkerjasama" => \DI\create(TRpkerjasama::class),
    "t_rwpekerjaan" => \DI\create(TRwpekerjaan::class),
    "t_rwpendd" => \DI\create(TRwpendd::class),
    "t_rwtraining" => \DI\create(TRwtraining::class),
    "t_sex" => \DI\create(TSex::class),
    "t_skala" => \DI\create(TSkala::class),
    "t_table" => \DI\create(TTable::class),
    "t_tahapan" => \DI\create(TTahapan::class),
    "t_tahun" => \DI\create(TTahun::class),
    "t_userlevelpermissions" => \DI\create(TUserlevelpermissions::class),
    "t_userlevels" => \DI\create(TUserlevels::class),
    "v_faskurdetail" => \DI\create(VFaskurdetail::class),
    "v_japel" => \DI\create(VJapel::class),
    "v_kerjasama" => \DI\create(VKerjasama::class),
    "v_kurikulum" => \DI\create(VKurikulum::class),
    "v_realuniv" => \DI\create(VRealuniv::class),
    "v_rencanakerjasama" => \DI\create(VRencanakerjasama::class),
    "v_targetreal" => \DI\create(VTargetreal::class),
    "vt_pegawai" => \DI\create(VtPegawai::class),
    "vt_pelatihan" => \DI\create(VtPelatihan::class),
    "vt_peserta" => \DI\create(VtPeserta::class),
    "t_users" => \DI\create(TUsers::class),
    "data_convert" => \DI\create(DataConvert::class),
    "Perusahaan" => \DI\create(Perusahaan::class),
    "Peserta" => \DI\create(Peserta::class),
    "pelpes" => \DI\create(Pelpes::class),
];
