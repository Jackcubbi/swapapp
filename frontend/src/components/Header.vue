<template>
  <header class="page-header" :class="{ 'is-sticky': isSticky }">
    <div class="container">
      <nav>
        <ul class="main-menu">
          <div class="left-menu">
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/items">Products</router-link></li>
          </div>
          <div class="right-menu">
            <li v-if="authStore.isAuthenticated">
              <router-link to="/account">My Account</router-link>
            </li>
            <li v-if="authStore.isAuthenticated">
              <button @click="handleLogout" class="logout-btn">Logout</button>
            </li>
            <li v-else>
              <router-link to="/login">Login</router-link>
            </li>
            <li v-if="!authStore.isAuthenticated">
              <router-link to="/register">Register</router-link>
            </li>
          </div>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();
const router = useRouter();
const isSticky = ref(false);

const handleScroll = () => {
  isSticky.value = window.pageYOffset > 100;
};

const handleLogout = async () => {
  if (confirm("Are you sure you want to logout?")) {
    await authStore.logout();
    router.push("/login");
  }
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>
