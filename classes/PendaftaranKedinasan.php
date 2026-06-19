<?php
require_once 'Pendaftaran.php';

/**
 * Class PendaftaranKedinasan
 * Implementasi untuk jalur pendaftaran Kedinasan
 * 
 * @package Pendaftaran
 */
class PendaftaranKedinasan extends Pendaftaran {
    
    /**
     * Properti tambahan khusus jalur Kedinasan
     */
    private $skIkatanDinas;
    private $instansiSponsor;
    
    /**
     * Constructor untuk jalur Kedinasan
     * 
     * @param int $id_pendaftaran
     * @param string $nama_calon
     * @param string $asal_sekolah
     * @param float $nilai_ujian
     * @param float $biayaPendaftaranDasar
     * @param string $skIkatanDinas
     * @param string $instansiSponsor
     */
    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $skIkatanDinas, $instansiSponsor) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->skIkatanDinas = $skIkatanDinas;
        $this->instansiSponsor = $instansiSponsor;
    }
    
    /**
     * Implementasi method abstrak hitungTotalBiaya untuk Kedinasan
     * Biaya total = Biaya dasar + biaya administrasi khusus + biaya asuransi
     * 
     * @return float
     */
    public function hitungTotalBiaya() {
        $biayaAdministrasi = 50000; // Biaya administrasi khusus kedinasan
        $biayaAsuransi = 25000;      // Biaya asuransi kesehatan
        return $this->biayaPendaftaranDasar + $biayaAdministrasi + $biayaAsuransi;
    }
    
    /**
     * Implementasi method abstrak tampilkanInfoJalur untuk Kedinasan
     * 
     * @return string
     */
    public function tampilkanInfoJalur() {
        return "Kedinasan - {$this->instansiSponsor} (SK: {$this->skIkatanDinas})";
    }
    
    /**
     * Method Query Spesifik: Mendapatkan semua data pendaftaran jalur Kedinasan
     * 
     * @param Database $db Instance database
     * @return array Array data pendaftaran Kedinasan
     */
    public function getDaftarKedinasan($db) {
        $sql = "SELECT 
                    id_pendaftaran,
                    nama_calon,
                    asal_sekolah,
                    nilai_ujian,
                    biaya_pendaftaran_dasar,
                    jalur_pendaftaran,
                    pilihan_prodi,
                    lokasi_kampus,
                    sk_ikatan_dinas,
                    instansi_sponsor
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Kedinasan'
                ORDER BY instansi_sponsor, id_pendaftaran DESC";
        
        return $db->fetchAll($sql);
    }
    
    /**
     * Method tambahan: Mendapatkan data Kedinasan berdasarkan instansi
     * 
     * @param Database $db Instance database
     * @param string $instansi Nama instansi sponsor
     * @return array
     */
    public function getDaftarKedinasanByInstansi($db, $instansi) {
        $sql = "SELECT 
                    id_pendaftaran,
                    nama_calon,
                    asal_sekolah,
                    nilai_ujian,
                    sk_ikatan_dinas,
                    instansi_sponsor,
                    pilihan_prodi
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Kedinasan' 
                AND instansi_sponsor = ?
                ORDER BY nilai_ujian DESC";
        
        return $db->fetchAll($sql, [$instansi]);
    }
    
    /**
     * Method tambahan: Mendapatkan statistik Kedinasan per instansi
     * 
     * @param Database $db Instance database
     * @return array
     */
    public function getStatistikKedinasan($db) {
        $sql = "SELECT 
                    instansi_sponsor,
                    COUNT(*) as jumlah_pendaftar,
                    AVG(nilai_ujian) as rata_rata_nilai,
                    MIN(nilai_ujian) as nilai_terendah,
                    MAX(nilai_ujian) as nilai_tertinggi,
                    GROUP_CONCAT(sk_ikatan_dinas) as daftar_sk
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Kedinasan'
                GROUP BY instansi_sponsor
                ORDER BY jumlah_pendaftar DESC";
        
        return $db->fetchAll($sql);
    }
    
    /**
     * Method tambahan: Validasi SK Ikatan Dinas
     * 
     * @return bool
     */
    public function validasiSK() {
        // Format SK: SK-XXX/YYYY (contoh: SK-001/2026)
        $pattern = '/^SK-\d{3}\/\d{4}$/';
        return preg_match($pattern, $this->skIkatanDinas) === 1;
    }
    
    // ============================================
    // GETTER & SETTER UNTUK PROPERTI TAMBAHAN
    // ============================================
    
    public function getSkIkatanDinas() {
        return $this->skIkatanDinas;
    }
    
    public function setSkIkatanDinas($skIkatanDinas) {
        $this->skIkatanDinas = $skIkatanDinas;
    }
    
    public function getInstansiSponsor() {
        return $this->instansiSponsor;
    }
    
    public function setInstansiSponsor($instansiSponsor) {
        $this->instansiSponsor = $instansiSponsor;
    }
}