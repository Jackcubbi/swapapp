<?php
include 'config/db.php';
include 'includes/functions.php';

if (!isLoggedIn()) {
  header('Location: login.php');
  exit();
}

$itemId = $_GET['item_id'];

// Получаем информацию о товаре
$stmt = $db->prepare("SELECT * FROM items WHERE id = ? AND user_id = ?");
$stmt->execute([$itemId, $_SESSION['user_id']]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
  echo "Товар не найден или у вас нет доступа к его редактированию.";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $item['image']; // Оставляем старое изображение

  // Если было загружено новое изображение, обновляем его
  if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
  }

  // Обновляем товар в базе данных
  $stmt = $db->prepare("UPDATE items SET name = ?, description = ?, price = ?, image = ? WHERE id = ? AND user_id = ?");
  $stmt->execute([$name, $description, $price, $image, $itemId, $_SESSION['user_id']]);

  redirect('account.php');
}
?>

<?php include 'includes/header.php'; ?>

<h2>Редактировать товар</h2>
<form class="edit-item" method="POST" enctype="multipart/form-data">
  <label for="name">Название:</label>
  <input type="text" name="name" value="<?= $item['name']; ?>" required>

  <label for="description">Описание:</label>
  <textarea name="description" required><?= $item['description']; ?></textarea>

  <label for="price">Цена:</label>
  <input type="number" name="price" value="<?= $item['price']; ?>" step="0.01" min="0" required>

  <label for="image">Изображение (оставьте пустым, если не хотите менять):</label>
  <input type="file" name="image">

  <div class="edit-buttons">
    <button type="submit">Обновить товар</button>
    <a class="back-btn" href="account.php">Назад</a>
  </div>
</form>

<?php include 'includes/footer.php'; ?>