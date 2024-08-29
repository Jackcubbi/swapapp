<footer>
  <div class="container">
    <div class="footer-columns">
      <ul class="footer-menu">
        <li><a href="index.php">Главная</a></li>
        <li><a href="items.php">Товары</a></li>
        <form method="post" action="change_language.php">
          <select name="language" onchange="this.form.submit()">
            <option value="ru" <?php echo isset($_SESSION['lang']) && $_SESSION['lang'] == 'ru' ? 'selected' : ''; ?>>Русский</option>
            <option value="en" <?php echo isset($_SESSION['lang']) && $_SESSION['lang'] == 'en' ? 'selected' : ''; ?>>English</option>
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

      <div class="">&copy; 2024 Обмен товарами. Все права защищены.</div>
    </div>
  </div>
</footer>


<!-- Подключаем файл scripts.js -->
<script src="public/js/scripts.js"></script>
</body>

</html>