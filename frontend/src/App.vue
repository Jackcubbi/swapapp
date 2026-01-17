<template>
  <div id="app">
    <Header v-if="!isAuthPage" />
    <main class="main-content">
      <router-view />
    </main>
    <Footer v-if="!isAuthPage" />
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";

const route = useRoute();

const isAuthPage = computed(() => {
  return route.path === "/login" || route.path === "/register";
});
</script>

<style lang="scss">
#app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.main-content {
  flex: 1;
}
</style>
