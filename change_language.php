<?php
include 'functions.php';

if (isset($_POST['lang'])) {
  $lang = $_POST['lang'];
  setLanguage($lang);
}

header('Location: ' . $_SERVER['HTTP_REFERER']); // Перенаправление обратно на предыдущую страницу
exit();
