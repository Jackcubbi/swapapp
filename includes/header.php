<?php

include 'functions.php';

if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
}

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
$translations = loadLanguage($lang);
?>



<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Подключаем библиотеку SweetAlert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <title>Обмен товарами</title>
</head>

<body>
  <header class="page-header">
    <div class="container">
      <nav>
        <ul class="main-menu">

          <div class="left-menu">
            <li><a href=" index.php">
                <?= $translations['main_page']; ?>
              </a></li>
            <li><a href="items.php">Товары</a></li>
          </div>

          <?php echo $translations['welcome']; ?>

          <div class="right-menu">
            <?php if (isset($_SESSION['user_id'])): ?>
              <li><a href="account.php">Личный кабинет</a></li>
              <li><a href="logout.php" class="logout-btn">Выход</a></li>
            <?php else: ?>
              <li><a href="login.php">Вход</a></li>
              <li><a href="register.php">Регистрация</a></li>
            <?php endif; ?>
          </div>

        </ul>
      </nav>
    </div>
  </header>