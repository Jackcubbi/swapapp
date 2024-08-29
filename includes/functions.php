<?php
function isLoggedIn()
{
  return isset($_SESSION['user_id']);
}

function redirect($url)
{
  header("Location: $url");
  exit;
}

function getUserById($db, $user_id)
{
  $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->execute([$user_id]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}


//Language Loading function
function loadLanguage($lang = 'ru')
{
  $file = __DIR__ . "/languages/{$lang}.php";
  if (file_exists($file)) {
    return include $file;
  }
  // Если файл не найден, используем английский язык по умолчанию
  return include __DIR__ . '/languages/ru.php';
}
