<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];

  // Удаляем товар из базы данных
  $stmt = $db->prepare("DELETE FROM items WHERE id = ? AND user_id = ?");
  $result = $stmt->execute([$id, $_SESSION['user_id']]);

  if ($result) {
    echo 'success';
  } else {
    echo 'error';
  }
}
