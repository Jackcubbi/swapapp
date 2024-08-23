<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Получаем ID товара из POST-запроса
  $id = $_POST['id'];

  // Убедитесь, что ID присутствует и является числом
  if (isset($id) && is_numeric($id)) {
    // Удаляем товар из базы данных
    $stmt = $db->prepare("DELETE FROM items WHERE id = ? AND user_id = ?");
    $result = $stmt->execute([$id, $_SESSION['user_id']]);

    if ($result) {
      echo 'success';
    } else {
      echo 'error';
    }
  } else {
    echo 'error';
  }
}
