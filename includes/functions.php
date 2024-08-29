<?php
include_once 'init_languages.php';


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
function __($key)
{
  return $GLOBALS['lang']->trans($key);
}
