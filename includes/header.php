<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/styles.css">
  <title>Обмен товарами</title>
</head>

<body>
  <header class="page-header">
    <div class="container">
      <nav>
        <ul class="main-menu">
          <div class="left-menu">
            <li><a href=" index.php">Главная</a></li>
            <li><a href="items.php">Товары</a></li>
          </div>
          <div class="right-menu">
            <?php if (isset($_SESSION['user_id'])): ?>
              <li><a href="add_item.php">Добавить товар</a></li>
              <li><a href="logout.php">Выход</a></li>
            <?php else: ?>
              <li><a href="login.php">Вход</a></li>
              <li><a href="register.php">Регистрация</a></li>
            <?php endif; ?>
          </div>
        </ul>
      </nav>
    </div>
  </header>