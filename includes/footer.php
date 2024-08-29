<footer>
  <div class="container">
    <div class="footer-columns">
      <ul class="footer-menu">
        <li><a href=" index.php"><?= __('main_page'); ?></a></li>
        <li><a href="items.php"><?= __('products'); ?></a></li>
        <form action="change_language.php" method="POST">
          <select name="lang" onchange="this.form.submit()">
            <option value="ru" <?= $GLOBALS['lang']->getLocale() === 'ru' ? 'selected' : ''; ?>>Русский</option>
            <option value="en" <?= $GLOBALS['lang']->getLocale() === 'en' ? 'selected' : ''; ?>>English</option>
            <!-- Добавьте другие языки по мере необходимости -->
          </select>
        </form>
      </ul>
      <div class="footer-user-menu">


      </div>
      <div class="footer-privacy-menu">


      </div>
      <div class="socials">
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>
        <a href="#">Instagram</a>
      </div>

      <div class="">&copy; <?= '2020 - ' . date("Y") . ' ' . __('all_rights_reserved'); ?></div>
    </div>
  </div>
</footer>


<!-- Подключаем файл scripts.js -->
<script src="public/js/scripts.js"></script>
</body>

</html>