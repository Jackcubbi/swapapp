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
function __($message)
{
  if (isset($GLOBALS['lang'])) {
    return $GLOBALS['lang']->trans($message);
  } else {
    return $message; // Вернуть исходное сообщение, если переводчик не инициализирован
  }
}

function setLanguage($lang)
{
  $_SESSION['lang'] = $lang;
  include 'init_translation.php'; // Перезагрузить переводчик с новым языком
}
