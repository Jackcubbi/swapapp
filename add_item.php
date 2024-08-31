<?php
include 'config/db.php';
include 'includes/functions.php';

if (!isLoggedIn()) {
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $_FILES['image']['name'];

  // Сохранение изображения
  move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);

  // Сохранение товара без перевода (основная запись)
  // Вставка данных в таблицу items
  $stmt = $db->prepare("INSERT INTO items (user_id, price, image) VALUES (?, ?, ?)");
  $stmt->execute([$_SESSION['user_id'], $price, $image]);
  $itemId = $db->lastInsertId();

  // Сохранение переводов
  $languages = ['en', 'ru']; // Доступные языки
  foreach ($languages as $langCode) {
    $name = $_POST['name_' . $langCode];
    $description = $_POST['description_' . $langCode];

    if (!empty($name) && !empty($description)) {
      $stmt = $db->prepare("INSERT INTO items_lang (item_id, language, name, description) VALUES (?, ?, ?, ?)");
      $stmt->execute([$itemId, $langCode, $name, $description]);
    }
  }

  redirect('items.php');
} ?>

<?php include 'includes/header.php'; ?>

<h2><?= __('add_product'); ?></h2>

<form class="add-item" method="POST" enctype="multipart/form-data">

  <!-- Выбор языка -->
  <label for="languageSelect"><?= __('select_language'); ?>:</label>
  <select id="languageSelect">
    <option value="ru">Русский</option>
    <option value="en">English</option>
    <!-- Добавьте другие языки, если необходимо -->
  </select>

  <!-- Поля для ввода названия и описания на разных языках -->
  <div id="fields-container">
    <!-- RU -->
    <div class="language-fields" data-lang="ru">
      <label for="name_ru"><?= __('product_title'); ?> (Русский):</label>
      <input type="text" name="name_ru">
      <label for="description_ru"><?= __('description'); ?> (Русский):</label>
      <textarea name="description_ru"></textarea>
    </div>
    <!-- EN -->
    <div class="language-fields" data-lang="en" style="display: none;">
      <label for="name_en"><?= __('product_title'); ?> (English):</label>
      <input type="text" name="name_en" required>
      <label for="description_en"><?= __('description'); ?> (English):</label>
      <textarea name="description_en" required></textarea>
    </div>

  </div>

  <label for="price"><?= __('price'); ?> €:</label>
  <input type="number" name="price" step="0.01" min="0" required>

  <label for="image"><?= __('picture'); ?>:</label>
  <input type="file" name="image" required>

  <div class="add-buttons">
    <button type="submit"><?= __('add_product'); ?></button>
    <a class="back-btn" href="account.php"><?= __('back'); ?></a>
  </div>
</form>

<?php include 'includes/footer.php'; ?>