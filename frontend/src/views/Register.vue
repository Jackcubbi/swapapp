<template>
  <div class="auth-page">
    <div class="auth-container">
      <h2>Register</h2>
      <form @submit.prevent="handleRegister">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" v-model="form.username" required />
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="form.email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            v-model="form.password"
            required
            minlength="8"
          />
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input
            type="password"
            id="password_confirmation"
            v-model="form.password_confirmation"
            required
          />
        </div>

        <div v-if="error" class="error-message">{{ error }}</div>

        <button type="submit" :disabled="loading">
          {{ loading ? "Registering..." : "Register" }}
        </button>

        <p class="auth-link">
          Already have an account?
          <router-link to="/login">Login here</router-link>
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
  email: "",
  password: "",
  password_confirmation: "",
});

const error = ref("");
const loading = ref(false);

const handleRegister = async () => {
  if (form.value.password !== form.value.password_confirmation) {
    error.value = "Passwords do not match";
    return;
  }

  error.value = "";
  loading.value = true;

  try {
    await authStore.register(form.value);
    router.push("/account");
  } catch (err) {
    console.error("Registration error:", err);
    console.error("Response:", err.response);
    error.value =
      err.response?.data?.message || err.message || "Registration failed";
  } finally {
    loading.value = false;
  }
};
</script>
