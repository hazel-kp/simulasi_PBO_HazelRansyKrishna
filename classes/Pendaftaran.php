<?php
/**
 * Abstract Class Pendaftaran
 * 
 * Merupakan class induk untuk semua jalur pendaftaran
 * Menggunakan enkapsulasi dengan properti protected
 * 
 * @package Pendaftaran
 * @abstract
 */
abstract class Pendaftaran {
    
    /**
     * Properti/Atribut Terenkapsulasi (Protected)
     * Dipetakan dari kolom tabel database
     */
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar;
    
    /**
     * Constructor untuk menginisialisasi properti
     * 
     * @param int $id_pendaftaran ID pendaftaran dari database
     * @param string $nama_calon Nama calon mahasiswa
     * @param string $asal_sekolah Asal sekolah calon
     * @param float $nilai_ujian Nilai ujian calon
     * @param float $biayaPendaftaranDasar Biaya dasar pendaftaran
     */
    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar) {
        $this->id_pendaftaran = $id_pendaftaran;
        $this->nama_calon = $nama_calon;
        $this->asal_sekolah = $asal_sekolah;
        $this->nilai_ujian = $nilai_ujian;
        $this->biayaPendaftaranDasar = $biayaPendaftaranDasar;
    }
    
    /**
     * Method abstrak untuk menghitung total biaya pendaftaran
     * Harus diimplementasikan oleh class anak
     * 
     * @return float Total biaya yang harus dibayar
     */
    abstract public function hitungTotalBiaya();
    
    /**
     * Method abstrak untuk menampilkan informasi jalur pendaftaran
     * Harus diimplementasikan oleh class anak
     * 
     * @return string Informasi jalur pendaftaran
     */
    abstract public function tampilkanInfoJalur();
    
    // ============================================
    // GETTER METHODS (Untuk akses properti protected)
    // ============================================
    
    /**
     * Mendapatkan ID pendaftaran
     * 
     * @return int
     */
    public function getIdPendaftaran() {
        return $this->id_pendaftaran;
    }
    
    /**
     * Mendapatkan nama calon
     * 
     * @return string
     */
    public function getNamaCalon() {
        return $this->nama_calon;
    }
    
    /**
     * Mendapatkan asal sekolah
     * 
     * @return string
     */
    public function getAsalSekolah() {
        return $this->asal_sekolah;
    }
    
    /**
     * Mendapatkan nilai ujian
     * 
     * @return float
     */
    public function getNilaiUjian() {
        return $this->nilai_ujian;
    }
    
    /**
     * Mendapatkan biaya pendaftaran dasar
     * 
     * @return float
     */
    public function getBiayaPendaftaranDasar() {
        return $this->biayaPendaftaranDasar;
    }
    
    // ============================================
    // SETTER METHODS (Untuk mengubah properti)
    // ============================================
    
    /**
     * Mengubah ID pendaftaran
     * 
     * @param int $id_pendaftaran
     * @return void
     */
    public function setIdPendaftaran($id_pendaftaran) {
        $this->id_pendaftaran = $id_pendaftaran;
    }
    
    /**
     * Mengubah nama calon
     * 
     * @param string $nama_calon
     * @return void
     */
    public function setNamaCalon($nama_calon) {
        $this->nama_calon = $nama_calon;
    }
    
    /**
     * Mengubah asal sekolah
     * 
     * @param string $asal_sekolah
     * @return void
     */
    public function setAsalSekolah($asal_sekolah) {
        $this->asal_sekolah = $asal_sekolah;
    }
    
    /**
     * Mengubah nilai ujian
     * 
     * @param float $nilai_ujian
     * @return void
     */
    public function setNilaiUjian($nilai_ujian) {
        $this->nilai_ujian = $nilai_ujian;
    }
    
    /**
     * Mengubah biaya pendaftaran dasar
     * 
     * @param float $biayaPendaftaranDasar
     * @return void
     */
    public function setBiayaPendaftaranDasar($biayaPendaftaranDasar) {
        $this->biayaPendaftaranDasar = $biayaPendaftaranDasar;
    }
    
    // ============================================
    // METHOD TAMBAHAN (Non-Abstract)
    // ============================================
    
    /**
     * Mendapatkan status kelulusan berdasarkan nilai ujian
     * 
     * @return string Status kelulusan
     */
    public function getStatusKelulusan() {
        if ($this->nilai_ujian >= 80) {
            return "Lulus dengan Predikat Sangat Baik";
        } elseif ($this->nilai_ujian >= 70) {
            return "Lulus dengan Predikat Baik";
        } elseif ($this->nilai_ujian >= 60) {
            return "Lulus dengan Predikat Cukup";
        } else {
            return "Tidak Lulus";
        }
    }
    
    /**
     * Menampilkan informasi lengkap pendaftaran
     * 
     * @return string Informasi lengkap
     */
    public function tampilkanInfoLengkap() {
        $info = "========================================\n";
        $info .= "ID Pendaftaran    : " . $this->id_pendaftaran . "\n";
        $info .= "Nama Calon        : " . $this->nama_calon . "\n";
        $info .= "Asal Sekolah      : " . $this->asal_sekolah . "\n";
        $info .= "Nilai Ujian       : " . $this->nilai_ujian . "\n";
        $info .= "Status            : " . $this->getStatusKelulusan() . "\n";
        $info .= "Biaya Dasar       : Rp " . number_format($this->biayaPendaftaranDasar, 0, ',', '.') . "\n";
        $info .= "Total Biaya       : Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "\n";
        $info .= "Jalur Pendaftaran : " . $this->tampilkanInfoJalur() . "\n";
        $info .= "========================================\n";
        return $info;
    }
    
    /**
     * Magic method untuk representasi string
     * 
     * @return string
     */
    public function __toString() {
        return $this->tampilkanInfoLengkap();
    }
}