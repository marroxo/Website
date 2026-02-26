<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
}

function auth_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function auth_check(): bool {
    return !empty($_SESSION['user']);
}

function auth_login(array $user): void {
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id'    => $user['id'],
        'email' => $user['email'],
        'name'  => $user['name'],
    ];
}

function auth_logout(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 86400,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

function auth_register(string $email, string $password, string $name = ''): array {
    $email = strtolower(trim($email));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['error' => 'Invalid email address.'];
    }
    if (strlen($password) < 8) {
        return ['error' => 'Password must be at least 8 characters.'];
    }
    $existing = db_row("SELECT id FROM users WHERE email = ?", [$email]);
    if ($existing) {
        return ['error' => 'An account with that email already exists.'];
    }
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $id   = db_insert("INSERT INTO users (email, password_hash, name) VALUES (?,?,?)",
        [$email, $hash, trim($name)]);
    return ['id' => $id, 'email' => $email, 'name' => trim($name)];
}

function auth_attempt(string $email, string $password): ?array {
    $email = strtolower(trim($email));
    $user  = db_row("SELECT * FROM users WHERE email = ? AND is_guest = 0", [$email]);
    if (!$user || !password_verify($password, $user['password_hash'])) {
        return null;
    }
    return $user;
}

// ── Guest account (for checkout without registration) ────────────────────────
function auth_ensure_guest(string $email): array {
    $email = strtolower(trim($email));
    $user  = db_row("SELECT * FROM users WHERE email = ?", [$email]);
    if (!$user) {
        $id   = db_insert("INSERT INTO users (email, is_guest) VALUES (?,1)", [$email]);
        $user = db_row("SELECT * FROM users WHERE id = ?", [$id]);
    }
    return $user;
}
