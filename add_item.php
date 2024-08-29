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

  $stmt = $db->prepare("INSERT INTO items (user_id, name, description, price, image) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$_SESSION['user_id'], $name, $description, $price, $image]);

  redirect('items.php');
} ?>

<?php include 'includes/header.php'; ?>

<h2><?= __('add_product'); ?></h2>
<form class="add-item" method="POST" enctype="multipart/form-data">
  <label for="name"><?= __('product_title'); ?>:</label>
  <input type="text" name="name" required>

  <label for="description"><?= __('description'); ?>:</label>
  <textarea name="description" required></textarea>

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