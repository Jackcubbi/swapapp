<?php
include 'config/db.php';
include 'includes/functions.php';

if (!isLoggedIn()) {
  header('Location: login.php');
  exit();
}

// Получаем ID текущего пользователя
$userId = $_SESSION['user_id'];

// Получаем все товары, добавленные текущим пользователем
$stmt = $db->prepare("SELECT * FROM items WHERE user_id = ?");
$stmt->execute([$userId]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>

<h2>Мои товары</h2>
<section class="my-products items-container">
  <div class="container">
    <div class="account-menu">
      <div class="add-item">
        <a href="add_item.php">Добавить товар</a>
      </div>
    </div>
    <ul>
      <?php foreach ($items as $item): ?>
        <li>
          <img src="uploads/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" width="100">
          <h3><?= $item['name']; ?></h3>
          <p>Цена: $<?= $item['price']; ?></p>
          <p><?= $item['description']; ?></p>
          <a href="edit_item.php?item_id=<?= $item['id']; ?>">Редактировать</a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php include 'includes/footer.php'; ?>