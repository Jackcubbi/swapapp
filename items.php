<?php
include 'config/db.php';
include 'includes/header.php';

// Получение текущего языка из сессии или куки
$currentLang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ru';

// Обновленный SQL-запрос
$stmt = $db->prepare("
    SELECT items.*, users.username, items_lang.name, items_lang.description
    FROM items
    JOIN users ON items.user_id = users.id
    JOIN items_lang ON items.id = items_lang.item_id AND items_lang.language = ?
");
$stmt->execute([$currentLang]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>


<section class="products">
  <div class="container">
    <div class="items-container">
      <h2><?= __('products_list'); ?></h2>
      <ul>
        <?php foreach ($items as $item): ?>
          <li>
            <?php if (empty($item['image'])) : ?>
              <img src="public/images/no-image.gif" alt="no-image">
            <?php else : ?>
              <img src="uploads/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" width="100">
            <?php endif; ?>
            <h3><?= htmlspecialchars($item['name']); ?></h3>
            <p><?= __('price'); ?>: $<?= htmlspecialchars($item['price']); ?></p>
            <p><?= htmlspecialchars($item['description']); ?></p>
            <p><?= __('seller'); ?>: <?= htmlspecialchars($item['username']); ?></p>

            <a href="trade.php?item_id=<?= $item['id']; ?>" class="trade-btn"><?= __('swap_offer'); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>