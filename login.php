<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    header('Location: account.php');
  } else {
    $error = "Неправильное имя пользователя или пароль";
  }
} ?>

<?php include 'includes/header.php'; ?>

<h2><?= __('login'); ?></h2>
<form method="POST">
  <label for="username"><?= __('username'); ?>:</label>
  <input type="text" name="username" required>

  <label for="password"><?= __('password'); ?>:</label>
  <input type="password" name="password" required>

  <button type="submit"><?= __('login'); ?></button>
  <?php if (isset($error)) {
    echo "<p>$error</p>";
  } ?>
</form>

<?php include 'includes/footer.php'; ?>