<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
  $stmt->execute([$username, $password, $email]);

  header('Location: login.php');
} ?>

<?php include 'includes/header.php'; ?>

<h2>Регистрация</h2>
<form method="POST">
  <label for="username">Имя пользователя:</label>
  <input type="text" name="username" required>

  <label for="email">Email:</label>
  <input type="email" name="email" required>

  <label for="password">Пароль:</label>
  <input type="password" name="password" required>

  <button type="submit">Зарегистрироваться</button>
</form>

<?php include 'includes/footer.php'; ?>