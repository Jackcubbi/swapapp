<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Получаем ID товара из POST-запроса
  $itemId = $_POST['id'];

  // Убедимся, что ID присутствует и является числом
  if (isset($itemId) && is_numeric($itemId)) {
    // Проверяем, не участвует ли товар в обмене
    $stmt = $db->prepare("SELECT COUNT(*) FROM trades WHERE id = ?");
    $stmt->execute([$itemId]);
    $tradeCount = $stmt->fetchColumn();

    if ($tradeCount > 0) {
      // Если товар участвует в обмене, вернём сообщение об ошибке
      echo 'in_trade';
    } else {
      // Если товар не участвует в обмене, удаляем его
      $stmt = $db->prepare("DELETE FROM items WHERE id = ? AND user_id = ?");
      $result = $stmt->execute([$itemId, $_SESSION['user_id']]);

      if ($result) {
        echo 'success';
      } else {
        echo 'error';
      }
    }
  } else {
    echo 'error';
  }
}
