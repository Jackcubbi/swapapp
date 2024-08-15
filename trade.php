<?php
include 'config/db.php';
include 'includes/functions.php';

if (!isLoggedIn()) {
  redirect('login.php');
}

$item_to_id = $_GET['item_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $item_from_id = $_POST['item_from_id'];

  $stmt = $db->prepare("INSERT INTO trades (item_from_id, item_to_id) VALUES (?, ?)");
  $stmt->execute([$item_from_id, $item_to_id]);

  redirect('items.php');
}

$stmt = $db->prepare("SELECT * FROM items WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>

<h2>Предложить обмен</h2>
<form method="POST">
  <label for="item_from_id">Выберите свой товар для обмена:</label>
  <select name="item_from_id" required>
    <?php foreach ($user_items as $item): ?>
      <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit">Предложить обмен</button>
</form>

<?php include 'includes/footer.php'; ?>