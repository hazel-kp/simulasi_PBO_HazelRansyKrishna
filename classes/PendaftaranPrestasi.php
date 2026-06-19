<?php
require_once 'Pendaftaran.php';

/**
 * Class PendaftaranPrestasi
 * Implementasi untuk jalur pendaftaran Prestasi
 * 
 * @package Pendaftaran
 */
class PendaftaranPrestasi extends Pendaftaran {
    
    /**
     * Properti tambahan khusus jalur Prestasi
     */
    private $jenisPrestasi;
    private $tingkatPrestasi;
    
    /**
     * Constructor untuk jalur Prestasi
     * 
     * @param int $id_pendaftaran
     * @param string $nama_calon
     * @param string $asal_sekolah
     * @param float $nilai_ujian
     * @param float $biayaPendaftaranDasar
     * @param string $jenisPrestasi
     * @param string $tingkatPrestasi
     */
    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $jenisPrestasi, $tingkatPrestasi) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->jenisPrestasi = $jenisPrestasi;
        $this->tingkatPrestasi = $tingkatPrestasi;
    }
    
    /**
     * Implementasi method abstrak hitungTotalBiaya untuk Prestasi
     * Biaya total = Biaya dasar - diskon berdasarkan tingkat prestasi
     * 
     * @return float
     */
    public function hitungTotalBiaya() {
        $diskon = 0;
        
        // Diskon berdasarkan tingkat prestasi
        switch ($this->tingkatPrestasi) {
            case 'Internasional':
                $diskon = 0.50; // Diskon 50%
                break;
            case 'Nasional':
                $diskon = 0.30; // Diskon 30%
                break;
            case 'Provinsi':
                $diskon = 0.20; // Diskon 20%
                break;
            case 'Kota':
                $diskon = 0.10; // Diskon 10%
                break;
            default:
                $diskon = 0.05; // Diskon 5%
        }
        
        $potongan = $this->biayaPendaftaranDasar * $diskon;
        return $this->biayaPendaftaranDasar - $potongan;
    }
    
    /**
     * Implementasi method abstrak tampilkanInfoJalur untuk Prestasi
     * 
     * @return string
     */
    public function tampilkanInfoJalur() {
        return "Prestasi - {$this->jenisPrestasi} (Tingkat {$this->tingkatPrestasi})";
    }
    
    /**
     * Method Query Spesifik: Mendapatkan semua data pendaftaran jalur Prestasi
     * 
     * @param Database $db Instance database
     * @return array Array data pendaftaran Prestasi
     */
    public function getDaftarPrestasi($db) {
        $sql = "SELECT 
                    id_pendaftaran,
                    nama_calon,
                    asal_sekolah,
                    nilai_ujian,
                    biaya_pendaftaran_dasar,
                    jalur_pendaftaran,
                    pilihan_prodi,
                    lokasi_kampus,
                    jenis_prestasi,
                    tingkat_prestasi
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Prestasi'
                ORDER BY 
                    FIELD(tingkat_prestasi, 'Internasional', 'Nasional', 'Provinsi', 'Kota'),
                    id_pendaftaran DESC";
        
        return $db->fetchAll($sql);
    }
    
    /**
     * Method tambahan: Mendapatkan data Prestasi berdasarkan tingkat
     * 
     * @param Database $db Instance database
     * @param string $tingkat Tingkat prestasi (Internasional, Nasional, Provinsi, Kota)
     * @return array
     */
    public function getDaftarPrestasiByTingkat($db, $tingkat) {
        $sql = "SELECT 
                    id_pendaftaran,
                    nama_calon,
                    asal_sekolah,
                    nilai_ujian,
                    jenis_prestasi,
                    tingkat_prestasi,
                    pilihan_prodi
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Prestasi' 
                AND tingkat_prestasi = ?
                ORDER BY nilai_ujian DESC";
        
        return $db->fetchAll($sql, [$tingkat]);
    }
    
    /**
     * Method tambahan: Mendapatkan statistik Prestasi per tingkat
     * 
     * @param Database $db Instance database
     * @return array
     */
    public function getStatistikPrestasi($db) {
        $sql = "SELECT 
                    tingkat_prestasi,
                    COUNT(*) as jumlah,
                    AVG(nilai_ujian) as rata_rata_nilai,
                    GROUP_CONCAT(DISTINCT jenis_prestasi) as jenis_prestasi_list
                FROM tabel_pendaftaran 
                WHERE jalur_pendaftaran = 'Prestasi'
                GROUP BY tingkat_prestasi
                ORDER BY 
                    FIELD(tingkat_prestasi, 'Internasional', 'Nasional', 'Provinsi', 'Kota')";
        
        return $db->fetchAll($sql);
    }
    
    // ============================================
    // GETTER & SETTER UNTUK PROPERTI TAMBAHAN
    // ============================================
    
    public function getJenisPrestasi() {
        return $this->jenisPrestasi;
    }
    
    public function setJenisPrestasi($jenisPrestasi) {
        $this->jenisPrestasi = $jenisPrestasi;
    }
    
    public function getTingkatPrestasi() {
        return $this->tingkatPrestasi;
    }
    
    public function setTingkatPrestasi($tingkatPrestasi) {
        $this->tingkatPrestasi = $tingkatPrestasi;
    }
}