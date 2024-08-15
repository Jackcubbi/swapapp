<?php
include 'config/db.php';
include 'includes/header.php';

$stmt = $db->query("SELECT items.*, users.username FROM items JOIN users ON items.user_id = users.id");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Список товаров</h2>
<ul>
  <?php foreach ($items as $item): ?>
    <li>
      <img src="uploads/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" width="100">
      <h3><?= $item['name']; ?></h3>
      <p><?= $item['description']; ?></p>
      <p>Продавец: <?= $item['username']; ?></p>
      <a href="trade.php?item_id=<?= $item['id']; ?>">Предложить обмен</a>
    </li>
  <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>