<?php
require_once 'Pendaftaran.php';

/**
 * Class PendaftaranReguler
 * Implementasi untuk jalur pendaftaran Reguler
 * 
 * @package Pendaftaran
 */
class PendaftaranReguler extends Pendaftaran {
    
    /**
     * Properti tambahan khusus jalur Reguler
     */
    private $pilihanProdi;
    private $lokasiKampus;
    
    /**
     * Constructor untuk jalur Reguler
     * 
     * @param int $id_pendaftaran
     * @param string $nama_calon
     * @param string $asal_sekolah
     * @param float $nilai_ujian
     * @param float $biayaPendaftaranDasar
     * @param string $pilihanProdi
     * @param string $lokasiKampus
     */
    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $pilihanProdi, $lokasiKampus) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
    }
    
    /**
     * Implementasi method abstrak hitungTotalBiaya untuk Reguler
     * Biaya total = Biaya dasar (tanpa tambahan)
     * 
     * @return float
     */
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar;
    }
    
    /**
     * Implementasi method abstrak tampilkanInfoJalur untuk Reguler
     * 
     * @return string
     */
    public function tampilkanInfoJalur() {
        return "Reguler - Prodi: {$this->pilihanProdi}, Kampus: {$this->lokasiKampus}";
    }
    
    /**
     * Method Query Spesifik: Mendapatkan semua data pendaftaran jalur Reguler
     * 
     * @param Database $db Instance database
     * @return array Array data pendaftaran Reguler
     */
    public function getDaftarReguler($db) {
        $sql = "SELECT 
                    id_pendaftaran,
                    nama_calon,
                    asal_sekolah,
                    nilai_ujian,
                    biaya_pendaftaran_dasar,
                    jalur_pendaftaran,
                    pilihan_prodi,
                    lokasi_kampus
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Reguler'
                ORDER BY id_pendaftaran DESC";
        
        return $db->fetchAll($sql);
    }
    
    /**
     * Method tambahan: Mendapatkan data Reguler dengan filter nilai minimum
     * 
     * @param Database $db Instance database
     * @param float $minNilai Nilai minimum (opsional)
     * @return array
     */
    public function getDaftarRegulerByNilai($db, $minNilai = 0) {
        $sql = "SELECT 
                    id_pendaftaran,
                    nama_calon,
                    asal_sekolah,
                    nilai_ujian,
                    biaya_pendaftaran_dasar,
                    pilihan_prodi,
                    lokasi_kampus
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Reguler' 
                AND nilai_ujian >= ?
                ORDER BY nilai_ujian DESC";
        
        return $db->fetchAll($sql, [$minNilai]);
    }
    
    /**
     * Method tambahan: Mendapatkan statistik Reguler per program studi
     * 
     * @param Database $db Instance database
     * @return array
     */
    public function getStatistikRegulerPerProdi($db) {
        $sql = "SELECT 
                    pilihan_prodi,
                    COUNT(*) as jumlah,
                    AVG(nilai_ujian) as rata_rata_nilai,
                    MIN(nilai_ujian) as nilai_terendah,
                    MAX(nilai_ujian) as nilai_tertinggi
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Reguler'
                GROUP BY pilihan_prodi
                ORDER BY jumlah DESC";
        
        return $db->fetchAll($sql);
    }
    
    // ============================================
    // GETTER & SETTER UNTUK PROPERTI TAMBAHAN
    // ============================================
    
    public function getPilihanProdi() {
        return $this->pilihanProdi;
    }
    
    public function setPilihanProdi($pilihanProdi) {
        $this->pilihanProdi = $pilihanProdi;
    }
    
    public function getLokasiKampus() {
        return $this->lokasiKampus;
    }
    
    public function setLokasiKampus($lokasiKampus) {
        $this->lokasiKampus = $lokasiKampus;
    }
}