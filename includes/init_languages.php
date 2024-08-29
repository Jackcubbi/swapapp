<?php

// init_translation.php
require 'vendor/autoload.php'; // Connecting the Composer autoloader

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

// Установка языка по умолчанию
$defaultLang = 'ru'; // Язык по умолчанию

if (isset($_SESSION['lang'])) {
  $defaultLang = $_SESSION['lang'];
} elseif (isset($_COOKIE['lang'])) {
  $defaultLang = $_COOKIE['lang'];
}

// Инициализация переводчика
$lang = new Translator($defaultLang);
$lang->addLoader('array', new ArrayLoader());
$lang->addResource('array', include 'includes/languages/ru.php', 'ru');
$lang->addResource('array', include 'includes/languages/en.php', 'en');

// Сохранение переводчика в глобальной переменной
$GLOBALS['lang'] = $lang;
