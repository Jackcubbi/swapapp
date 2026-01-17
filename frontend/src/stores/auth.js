import { defineStore } from "pinia";
import { ref, computed } from "vue";
import api from "../utils/api";

export const useAuthStore = defineStore("auth", () => {
  const storedUser = localStorage.getItem("user");
  const user = ref(
    storedUser && storedUser !== "undefined" ? JSON.parse(storedUser) : null,
  );
  const token = ref(localStorage.getItem("token") || null);

  const isAuthenticated = computed(() => !!token.value);

  async function login(credentials) {
    try {
      const response = await api.post("/login", credentials);
      user.value = response.data.user;
      token.value = response.data.token;
      localStorage.setItem("user", JSON.stringify(response.data.user));
      localStorage.setItem("token", response.data.token);
      return response.data;
    } catch (error) {
      throw error;
    }
  }

  async function register(userData) {
    try {
      const response = await api.post("/register", userData);
      user.value = response.data.user;
      token.value = response.data.token;
      localStorage.setItem("user", JSON.stringify(response.data.user));
      localStorage.setItem("token", response.data.token);
      return response.data;
    } catch (error) {
      throw error;
    }
  }

  async function logout() {
    try {
      await api.post("/logout");
    } catch (error) {
      console.error("Logout error:", error);
    } finally {
      user.value = null;
      token.value = null;
      localStorage.removeItem("user");
      localStorage.removeItem("token");
    }
  }

  return {
    user,
    token,
    isAuthenticated,
    login,
    register,
    logout,
  };
});
