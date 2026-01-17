<template>
  <div>
    <section class="hero">
      <div class="hero-content">
        <h1>Swap Items with Ease</h1>
        <p>Join thousands of users exchanging goods worldwide.</p>
        <router-link v-if="authStore.isAuthenticated" to="/items" class="btn">
          View Products
        </router-link>
        <router-link v-else to="/register" class="btn"> Start Now </router-link>
      </div>
    </section>
  </div>
</template>

<script setup>
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();
</script>
