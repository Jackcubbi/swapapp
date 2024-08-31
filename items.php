<?php
include 'config/db.php';
include 'includes/header.php';

$stmt = $db->query("SELECT items.*, users.username FROM items JOIN users ON items.user_id = users.id");
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
            <h3><?= $item['name']; ?></h3>
            <p><?= __('price'); ?>: $<?= $item['price']; ?></p>
            <p><?= $item['description']; ?></p>
            <p>Продавец: <?= $item['username']; ?></p>

            <a href="trade.php?item_id=<?= $item['id']; ?>" class="trade-btn"><?= __('swap_offer'); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>