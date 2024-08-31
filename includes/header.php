<?php
include_once 'functions.php';
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
  <title><?= __('welcome'); ?></title>
</head>

<body>
  <header class="page-header">
    <div class="container">
      <nav>
        <ul class="main-menu">

          <div class="left-menu">
            <li><a href=" index.php"><?= __('main_page'); ?></a></li>
            <li><a href="items.php"><?= __('products'); ?></a></li>
          </div>

          <?php echo __('welcome'); ?>

          <div class="right-menu">
            <?php if (isset($_SESSION['user_id'])): ?>
              <li><a href="account.php"><?= __('my_account'); ?></a></li>
              <li>
                <a href="logout.php" class="logout-btn"
                  data-title="<?= __('exit_alert'); ?>""
                  data-yes=" <?= __('yes_button'); ?>"
                  data-no="<?= __('no_button'); ?>">
                  <?= __('logout'); ?>
                </a>
              </li>
            <?php else: ?>
              <li><a href="login.php"><?= __('login'); ?></a></li>
              <li><a href="register.php"><?= __('register'); ?></a></li>
            <?php endif; ?>
          </div>
        </ul>
      </nav>
    </div>
  </header>