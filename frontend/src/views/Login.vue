<template>
  <div class="auth-page">
    <div class="auth-container">
      <h2>Login</h2>
      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" v-model="form.username" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            v-model="form.password"
            required
          />
        </div>

        <div v-if="error" class="error-message">{{ error }}</div>

        <button type="submit" :disabled="loading">
          {{ loading ? "Logging in..." : "Login" }}
        </button>

        <p class="auth-link">
          Don't have an account?
          <router-link to="/register">Register here</router-link>
        </p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";

const router = useRouter();
const authStore = useAuthStore();

const form = ref({
  username: "",
  password: "",
});

const error = ref("");
const loading = ref(false);

const handleLogin = async () => {
  error.value = "";
  loading.value = true;

  try {
    await authStore.login(form.value);
    router.push("/account");
  } catch (err) {
    error.value = err.response?.data?.message || "Invalid credentials";
  } finally {
    loading.value = false;
  }
};
</script>
