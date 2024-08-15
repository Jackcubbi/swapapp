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
  $image = $_FILES['image']['name'];

  // Сохранение изображения
  move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);

  $stmt = $db->prepare("INSERT INTO items (user_id, name, description, image) VALUES (?, ?, ?, ?)");
  $stmt->execute([$_SESSION['user_id'], $name, $description, $image]);

  redirect('items.php');
}
?>

<?php include 'includes/header.php'; ?>

<h2>Добавить товар</h2>
<form method="POST" enctype="multipart/form-data">
  <label for="name">Название:</label>
  <input type="text" name="name" required>

  <label for="description">Описание:</label>
  <textarea name="description" required></textarea>

  <label for="image">Изображение:</label>
  <input type="file" name="image" required>

  <button type="submit">Добавить товар</button>
</form>

<?php include 'includes/footer.php'; ?>