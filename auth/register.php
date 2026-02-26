<?php
require_once __DIR__ . '/../config/auth.php';

if (auth_check()) {
    header('Location: /account');
    exit;
}

$error  = '';
$next   = $_GET['next'] ?? '/account';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm']  ?? '');

    if ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $result = auth_register($email, $password, $name);
        if (isset($result['error'])) {
            $error = $result['error'];
        } else {
            auth_login($result);
            header('Location: ' . $next);
            exit;
        }
    }
}

$page_title  = 'Create Account — TGModz';
$page_desc   = 'Create your TGModz account to track your orders and access your downloads anytime.';
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
        <h1>Create Account</h1>
        <p>Track your orders and access downloads anytime</p>
      </div>

      <?php if ($error): ?>
        <div class="auth-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" class="auth-form">
        <label>Display Name <span class="opt">(optional)</span>
          <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                 autocomplete="name" placeholder="GamerTag">
        </label>
        <label>Email Address
          <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                 required autocomplete="email" placeholder="you@example.com">
        </label>
        <label>Password
          <input type="password" name="password" required autocomplete="new-password"
                 placeholder="Min. 8 characters" minlength="8">
        </label>
        <label>Confirm Password
          <input type="password" name="confirm" required autocomplete="new-password"
                 placeholder="Repeat password" minlength="8">
        </label>
        <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">Create Account</button>
      </form>

      <div class="auth-footer">
        Already have an account? <a href="/auth/login?next=<?= urlencode($next) ?>">Sign in</a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
