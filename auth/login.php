<?php
require_once __DIR__ . '/../config/auth.php';

if (auth_check()) {
    header('Location: /account');
    exit;
}

$error  = '';
$next   = $_GET['next'] ?? '/account';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    $user = auth_attempt($email, $password);
    if ($user) {
        auth_login($user);
        header('Location: ' . $next);
        exit;
    }
    $error = 'Invalid email or password.';
}

$page_title  = 'Login — TGModz';
$page_desc   = 'Log in to your TGModz account to access your orders and downloads.';
$active_page = 'home';
require __DIR__ . '/../includes/head.php';
?>
<body>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<section class="auth-section">
  <div class="container">
    <div class="auth-box">
      <div class="auth-header">
        <div class="auth-logo">TG<span>Modz</span></div>
        <h1>Sign In</h1>
        <p>Access your orders and downloads</p>
      </div>

      <?php if ($error): ?>
        <div class="auth-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" class="auth-form">
        <label>Email Address
          <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                 required autocomplete="email" placeholder="you@example.com">
        </label>
        <label>Password
          <input type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
        </label>
        <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">Sign In</button>
      </form>

      <div class="auth-footer">
        Don't have an account? <a href="/auth/register?next=<?= urlencode($next) ?>">Create one</a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
