<template>
  <section class="products">
    <div class="container">
      <h2>Products List</h2>

      <div v-if="loading" class="loading">Loading...</div>

      <div v-else-if="error" class="error-message">{{ error }}</div>

      <div v-else class="items-container">
        <ItemCard v-for="item in items" :key="item.id" :item="item">
          <template #actions>
            <router-link
              v-if="authStore.isAuthenticated"
              :to="`/items/${item.id}/trade`"
              class="btn trade-btn"
            >
              Offer Swap
            </router-link>
          </template>
        </ItemCard>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../utils/api";
import ItemCard from "../components/ItemCard.vue";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();
const items = ref([]);
const loading = ref(true);
const error = ref("");

const fetchItems = async () => {
  try {
    loading.value = true;
    const response = await api.get("/items");
    items.value = response.data;
  } catch (err) {
    error.value = "Failed to load items";
    console.error(err);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchItems();
});
</script>
