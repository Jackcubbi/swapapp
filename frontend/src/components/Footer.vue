<template>
  <footer>
    <div class="container">
      <div class="footer-columns">
        <ul class="footer-menu column">
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/items">Products</router-link></li>
        </ul>

        <div class="socials column">
          <a href="#">Facebook</a>
          <a href="#">Twitter</a>
          <a href="#">Instagram</a>
        </div>

        <div class="rights column">
          &copy; 2020 - {{ new Date().getFullYear() }} SwapApp - Product swap
          platform. All rights reserved.
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup></script>
