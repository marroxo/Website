<?php
require_once __DIR__ . '/config.php';

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                DB_HOST, DB_PORT, DB_NAME);
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            http_response_code(503);
            die('<h1>Database connection failed</h1><p>Please check your database config in <code>config/config.php</code></p>');
        }
    }
    return $pdo;
}

// ── Helpers ──────────────────────────────────────────────────────────────────

function db_row(string $sql, array $params = []): ?array {
    $st = db()->prepare($sql);
    $st->execute($params);
    $r = $st->fetch();
    return $r ?: null;
}

function db_rows(string $sql, array $params = []): array {
    $st = db()->prepare($sql);
    $st->execute($params);
    return $st->fetchAll();
}

function db_insert(string $sql, array $params = []): string {
    db()->prepare($sql)->execute($params);
    return db()->lastInsertId();
}

function db_exec(string $sql, array $params = []): int {
    $st = db()->prepare($sql);
    $st->execute($params);
    return $st->rowCount();
}
