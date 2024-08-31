<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
  $selected_lang = $_POST['lang'];

  // Установка выбранного языка в сессию
  $_SESSION['lang'] = $selected_lang;

  // Также сохраняем язык в куки на один год
  setcookie('lang', $selected_lang, time() + (365 * 24 * 60 * 60), '/');

  // Перенаправляем пользователя обратно на предыдущую страницу
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit();
}
