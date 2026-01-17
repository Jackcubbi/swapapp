<template>
  <section class="my-products">
    <div class="container">
      <div class="my-account">
        <h2>My Products</h2>

        <div class="account-menu">
          <router-link to="/items/add" class="btn add-item-btn">
            Add Product
          </router-link>
        </div>

        <div v-if="loading" class="loading">Loading...</div>

        <div v-else-if="error" class="error-message">{{ error }}</div>

        <div v-else class="items-container">
          <ItemCard v-for="item in items" :key="item.id" :item="item">
            <template #actions>
              <div class="item-actions-row">
                <router-link
                  :to="`/items/${item.id}/edit`"
                  class="btn edit-btn"
                >
                  Edit
                </router-link>
                <button @click="deleteItem(item.id)" class="btn delete-btn">
                  Delete
                </button>
              </div>
            </template>
          </ItemCard>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../utils/api";
import ItemCard from "../components/ItemCard.vue";

const items = ref([]);
const loading = ref(true);
const error = ref("");

const fetchMyItems = async () => {
  try {
    loading.value = true;
    const response = await api.get("/my-items");
    items.value = response.data;
  } catch (err) {
    error.value = "Failed to load your items";
    console.error(err);
  } finally {
    loading.value = false;
  }
};

const deleteItem = async (id) => {
  if (!confirm("Are you sure you want to delete this item?")) return;

  try {
    await api.delete(`/items/${id}`);
    items.value = items.value.filter((item) => item.id !== id);
  } catch (err) {
    if (err.response?.status === 422) {
      alert("Cannot delete item that is part of a trade");
    } else {
      alert("Failed to delete item");
    }
  }
};

onMounted(() => {
  fetchMyItems();
});
</script>
