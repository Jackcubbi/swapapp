<?php
include 'config/db.php';
include_once 'includes/functions.php';

// Проверка, чтобы пользователь был залогинен
if (!isLoggedIn()) {
  header('Location: login.php');
  exit();
}

// Получаем ID текущего пользователя
$userId = $_SESSION['user_id'];

// Получаем текущий язык из сессии или куки
$currentLang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ru';

// Получаем все товары, добавленные текущим пользователем
$stmt = $db->prepare("
    SELECT items.id, items.image, items.price, items_lang.name, items_lang.description
    FROM items
    JOIN items_lang ON items.id = items_lang.item_id AND items_lang.language = ?
    WHERE items.user_id = ?
");
$stmt->execute([$currentLang, $userId]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>


<section class="my-products">
  <div class="container">
    <div class="my-account">
      <h2><?= __('my_products'); ?></h2>
      <div class="account-menu">
        <div class="add-item">
          <a href="add_item.php"><?= __('add_product'); ?></a>
        </div>
      </div>
      <div class="items-container">
        <ul>
          <?php foreach ($items as $item): ?>
            <li class="item-card">
              <img src="uploads/<?= $item['image']; ?>" alt="<?= htmlspecialchars($item['name']); ?>" width="100">
              <h3><?= htmlspecialchars($item['name']); ?></h3>
              <p><?= __('price'); ?>: €<?= htmlspecialchars($item['price']); ?></p>
              <p><?= htmlspecialchars($item['description']); ?></p>
              <a href="edit_item.php?item_id=<?= $item['id']; ?>"><?= __('edit'); ?></a>

              <!-- Иконка удаления -->
              <button class="delete-btn" data-id="<?= $item['id']; ?>">
                <i class="fas fa-trash-alt"></i>
              </button>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>