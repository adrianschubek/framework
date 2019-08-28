<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Database;

use Framework\Logger\Logger;
use PDO;

/** Datenbankverbindung
 * @package Framework\Database
 */
class Database
{
    private $db;
    private $logger;

    /** Verbinde mit Datenbank
     * @param string $dbhost
     * @param string $dbname
     * @param string $dbuser
     * @param string $dbpass
     * @param Logger $logger
     */
    public function __construct(Logger $logger, string $dbhost = null, string $dbname = null, string $dbuser = null, string $dbpass = null)
    {
        $pdo = new PDO(sprintf("mysql:host=%s;dbname=%s;charset=utf8",
            $dbhost ?? cfg("db.host"),
            $dbname ?? cfg("db.name")
        ),
            $dbuser ?? cfg("db.user"),
            $dbpass ?? cfg("db.pass")
        );
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db = $pdo;
        $this->logger = $logger;
    }

    /**
     * @return PDO
     */
    public function connection(): PDO
    {
        return $this->db;
    }

    public function query(string $statement, array $params = [])
    {
        $stmt = $this->db->prepare($statement);
        if (!$stmt->execute($params)) {
            return false;
        }
        if ($stmt->rowCount() === 0) {
            return false;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}