<?php

class Database
{
    private static ?Database $instance = null;
    private mysqli $connection;

    private string $host;
    private int    $port;
    private string $user;
    private string $pass;
    private string $db;

    private function __construct(
        string $host = '',
        int    $port = 4000,
        string $user = '',
        string $pass = '',
        string $db   = ''
    ) {
        $this->host = $host ?: (getenv('TIDB_HOST') ?: '');
        $this->port = $port ?: (int)(getenv('TIDB_PORT') ?: 4000);
        $this->user = $user ?: (getenv('TIDB_USER') ?: '');
        $this->pass = $pass ?: (getenv('TIDB_PASS') ?: '');
        $this->db   = $db   ?: (getenv('TIDB_DB')   ?: '');

        $this->connect();
    }

    public static function getInstance(
        string $host = '',
        int    $port = 4000,
        string $user = '',
        string $pass = '',
        string $db   = ''
    ): self {
        if (self::$instance === null) {
            self::$instance = new self($host, $port, $user, $pass, $db);
        }
        return self::$instance;
    }

    private function connect(): void
    {
        $mysqli = mysqli_init();

        if (!$mysqli) {
            throw new RuntimeException('mysqli_init() gagal.');
        }

        mysqli_ssl_set($mysqli, null, null, null, null, null);

        $connected = mysqli_real_connect(
            $mysqli,
            $this->host,
            $this->user,
            $this->pass,
            $this->db,
            $this->port,
            null,
            MYSQLI_CLIENT_SSL
        );

        if (!$connected) {
            throw new RuntimeException(
                'Koneksi ke TiDB Cloud gagal: ' . mysqli_connect_error()
            );
        }

        $mysqli->set_charset('utf8mb4');
        $this->connection = $mysqli;
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    public function query(string $sql, string $types = '', array $params = []): array
    {
        $stmt = $this->prepare($sql, $types, $params);
        $result = $stmt->get_result();

        if ($result === false) {
            throw new RuntimeException('Gagal mengambil result: ' . $stmt->error);
        }

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $stmt->close();
        return $rows;
    }

    public function execute(string $sql, string $types = '', array $params = []): int
    {
        $stmt = $this->prepare($sql, $types, $params);
        $stmt->close();
        return $stmt->affected_rows;
    }

    public function lastInsertId(): int
    {
        return (int) $this->connection->insert_id;
    }

    public function beginTransaction(): void
    {
        $this->connection->begin_transaction();
    }

    public function commit(): void
    {
        $this->connection->commit();
    }

    public function rollback(): void
    {
        $this->connection->rollback();
    }

    private function prepare(string $sql, string $types, array $params): mysqli_stmt
    {
        $stmt = $this->connection->prepare($sql);

        if ($stmt === false) {
            throw new RuntimeException('Prepare gagal: ' . $this->connection->error);
        }

        if ($types !== '' && count($params) > 0) {
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new RuntimeException('Execute gagal: ' . $stmt->error);
        }

        return $stmt;
    }

    public function close()
    {
        $this->connection->close();
        self::$instance = null;
    }

    private function __clone() {}
    public function __wakeup()
    {
        throw new RuntimeException('Singleton tidak bisa di-unserialize.');
    }
}