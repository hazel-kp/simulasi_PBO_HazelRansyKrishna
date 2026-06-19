<?php
/**
 * File koneksi database menggunakan PDO
 * Digunakan untuk semua operasi database dalam aplikasi
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'pendaftaran_db'; // Ganti dengan nama database Anda
    private $username = 'root';          // Ganti dengan username database Anda
    private $password = '';              // Ganti dengan password database Anda
    private $charset = 'utf8mb4';
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ];
    
    private $connection = null;
    private static $instance = null;
    
    /**
     * Private constructor untuk Singleton Pattern
     * Mencegah pembuatan objek dari luar
     */
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            $this->connection = new PDO($dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            // Log error atau tampilkan pesan yang aman
            error_log("Koneksi database gagal: " . $e->getMessage());
            die("Maaf, terjadi kesalahan pada sistem. Silakan coba lagi nanti.");
        }
    }
    
    /**
     * Mendapatkan instance singleton dari Database
     * 
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Mendapatkan koneksi PDO
     * 
     * @return PDO
     */
    public function getConnection() {
        return $this->connection;
    }
    
    /**
     * Mencegah cloning object
     */
    private function __clone() {}
    
    /**
     * Mencegah unserialize object
     */
    private function __wakeup() {}
    
    /**
     * Menjalankan query SELECT dan mengembalikan semua hasil
     * 
     * @param string $sql Query SQL
     * @param array $params Parameter untuk prepared statement
     * @return array Hasil query
     */
    public function fetchAll($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error fetchAll: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Menjalankan query SELECT dan mengembalikan satu baris
     * 
     * @param string $sql Query SQL
     * @param array $params Parameter untuk prepared statement
     * @return array|false Satu baris hasil query
     */
    public function fetchOne($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error fetchOne: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Menjalankan query INSERT, UPDATE, DELETE
     * 
     * @param string $sql Query SQL
     * @param array $params Parameter untuk prepared statement
     * @return int Jumlah baris yang terpengaruh
     */
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Error execute: " . $e->getMessage());
            return 0;
        }
    }
    
    /**
     * Menjalankan query INSERT dan mengembalikan ID terakhir
     * 
     * @param string $sql Query SQL
     * @param array $params Parameter untuk prepared statement
     * @return string|false ID terakhir atau false jika gagal
     */
    public function insertAndGetId($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error insertAndGetId: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Memulai transaksi
     * 
     * @return bool
     */
    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }
    
    /**
     * Commit transaksi
     * 
     * @return bool
     */
    public function commit() {
        return $this->connection->commit();
    }
    
    /**
     * Rollback transaksi
     * 
     * @return bool
     */
    public function rollback() {
        return $this->connection->rollBack();
    }
    
    /**
     * Mendapatkan ID terakhir yang diinsert
     * 
     * @return string
     */
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
    
    /**
     * Quote string untuk keamanan (jika diperlukan)
     * 
     * @param string $string String yang akan di-quote
     * @return string
     */
    public function quote($string) {
        return $this->connection->quote($string);
    }
}

// ============================================
// FUNGSI GLOBAL UNTUK KEMUDAHAN AKSES
// ============================================

/**
 * Mendapatkan koneksi PDO langsung
 * 
 * @return PDO
 */
function getDBConnection() {
    return Database::getInstance()->getConnection();
}

/**
 * Mendapatkan instance Database
 * 
 * @return Database
 */
function getDB() {
    return Database::getInstance();
}