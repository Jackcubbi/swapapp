<?php
include 'config/db.php';
include 'includes/header.php'; ?>

<!-- Hero Section with Full Page Slider -->
<section class="hero">
  <div class="container">
    <div class="slider">
      <div class="slide slide1">
        <div class="slide-content">
          <h1>Обменивайте товары с легкостью</h1>
          <p>Присоединяйтесь к тысячам пользователей, обменивающих товары по всему миру.</p>
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="items.php" class="btn">Посмотреть товары</a>
          <?php else: ?>
            <a href="register.php" class="btn">Начать сейчас</a>
          <?php endif; ?>
        </div>
      </div>
      <div class="slide slide2">
        <div class="slide-content">
          <h1>Надежные и безопасные сделки</h1>
          <p>Мы обеспечиваем безопасность всех обменов на нашей платформе.</p>
          <a href="items.php" class="btn">Посмотреть товары</a>
        </div>
      </div>
      <div class="slide slide3">
        <div class="slide-content">
          <h1>Удобный интерфейс</h1>
          <p>Обменивайте свои товары легко и быстро с нашего сайта.</p>
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="items.php" class="btn">Посмотреть товары</a>
          <?php else: ?>
            <a href="login.php" class="btn">Войти</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="slider-navigation">
      <span class="nav-dot" data-slide="1"></span>
      <span class="nav-dot" data-slide="2"></span>
      <span class="nav-dot" data-slide="3"></span>
    </div>
  </div>
</section>
<?php include 'includes/footer.php'; ?>