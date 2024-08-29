<?php

// init_translation.php
require 'vendor/autoload.php'; // Connecting the Composer autoloader

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

// Initializing the translator
$lang = new Translator('ru'); // Язык по умолчанию
$lang->addLoader('array', new ArrayLoader());
$lang->addResource('array', include 'includes/languages/en.php', 'en');
$lang->addResource('array', include 'includes/languages/ru.php', 'ru');

// Add the translator to global variables if needed
$GLOBALS['lang'] = $lang;
