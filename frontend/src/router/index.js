import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";

const routes = [
  {
    path: "/",
    name: "Home",
    component: () => import("../views/Home.vue"),
  },
  {
    path: "/login",
    name: "Login",
    component: () => import("../views/Login.vue"),
  },
  {
    path: "/register",
    name: "Register",
    component: () => import("../views/Register.vue"),
  },
  {
    path: "/items",
    name: "Items",
    component: () => import("../views/Items.vue"),
  },
  {
    path: "/account",
    name: "Account",
    component: () => import("../views/Account.vue"),
    meta: { requiresAuth: true },
  },
  {
    path: "/items/add",
    name: "AddItem",
    component: () => import("../views/AddItem.vue"),
    meta: { requiresAuth: true },
  },
  {
    path: "/items/:id/edit",
    name: "EditItem",
    component: () => import("../views/EditItem.vue"),
    meta: { requiresAuth: true },
  },
  {
    path: "/items/:id/trade",
    name: "Trade",
    component: () => import("../views/Trade.vue"),
    meta: { requiresAuth: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();

  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next("/login");
  } else if (
    (to.name === "Login" || to.name === "Register") &&
    authStore.isAuthenticated
  ) {
    next("/");
  } else {
    next();
  }
});

export default router;
