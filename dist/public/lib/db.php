<?php

/**
 * SQLite3 Database class
 */
class DatabaseSQLite3 {
    protected $dbFile;
    protected $db;
    protected $encryptionKey;
    protected $sqliteVersion;

    /**
     * Class constructor.
     * @param string $dbFile  Database file path.
     * @param string $encryptionKey  Optional encryption key.
     * @return void
     */
    public function __construct($dbFile, $encryptionKey='') {
        $this->dbFile = $dbFile;
        $this->encryptionKey = $encryptionKey;
        $this->sqliteVersion = SQLite3::version();
    }

    /**
     * Open database for usage.
     * @param boolean $rw  Whether to open the database in READWRITE mode.
     * @return void
     */
    public function open($rw=FALSE) {
        if (is_object($this->db)) return $this->db;

        $flag = (!$rw) ? SQLITE3_OPEN_READONLY : SQLITE3_OPEN_READWRITE;

        $this->db = new SQLite3($this->dbFile, $flag, $this->encryptionKey);
    }

    /**
     * Close database.
     * @return void
     */
    public function close() {
        if (!is_object($this->db)) return FALSE;

        $this->db->close();
    }

    /**
     * Query the database.
     * @param string $query  Query to execute.
     * @param array $values  Query values.
     * @return array  Query results.
     */
    public function query($query, $values=array()) {
        if (!is_object($this->db)) return FALSE;

        $stmt = $this->db->prepare($query);
        foreach ($values as $v) {
            $stmt->bindValue($v[0], $v[1], $v[2]);
        }

        $result = $stmt->execute();

        $dump = array();
        while ($row = $result->fetchArray(TRUE)) {
            $dump[] = $row;
        }

        $stmt->close();

        return $dump;
    }

    /**
     * Query the database for a single row.
     * @param string $query  Query to execute.
     * @param array $values  Query values.
     * @return array  Query result.
     */
    public function querySingle($query, $values=array()) {
        if (!is_object($this->db)) return FALSE;

        $result = $this->query($query, $values);

        if (count($result) < 1) {
            return array();
        }

        return $result[0];
    }

    /**
     * Write changes to the database.
     * @param mixed $query  Query to execute.
     * @param mixed $values  Query values.
     * @return boolean  Whether the query was executed successfully.
     */
    public function write($query, $values=array()) {
        if (!is_object($this->db)) return FALSE;

        $stmt = $this->db->prepare($query);

        foreach ($values as $v) {
            $stmt->bindValue($v[0], $v[1], $v[2]);
        }

        return $stmt->execute();
    }
}
