<template>
  <div class="form-page">
    <div class="form-container">
      <h2>Offer a Product Swap</h2>

      <div v-if="loading" class="loading">Loading...</div>

      <form v-else @submit.prevent="handleSubmit">
        <div class="form-group">
          <label for="item_from_id">Select Your Item for Swap</label>
          <select id="item_from_id" v-model="form.item_from_id" required>
            <option value="">-- Select an item --</option>
            <option v-for="item in myItems" :key="item.id" :value="item.id">
              {{ item.translations?.[0]?.name || "Untitled" }} - ${{
                item.price
              }}
            </option>
          </select>
        </div>

        <div v-if="error" class="error-message">{{ error }}</div>

        <div class="form-buttons">
          <button type="submit" :disabled="submitting">
            {{ submitting ? "Offering..." : "Offer Swap" }}
          </button>
          <router-link to="/items" class="btn back-btn">Back</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import api from "../utils/api";

const router = useRouter();
const route = useRoute();

const form = ref({
  item_from_id: "",
  item_to_id: route.params.id,
});

const myItems = ref([]);
const error = ref("");
const loading = ref(true);
const submitting = ref(false);

const fetchMyItems = async () => {
  try {
    const response = await api.get("/my-items");
    myItems.value = response.data;
  } catch (err) {
    error.value = "Failed to load your items";
    console.error(err);
  } finally {
    loading.value = false;
  }
};

const handleSubmit = async () => {
  error.value = "";
  submitting.value = true;

  try {
    await api.post("/trades", {
      item_from_id: form.value.item_from_id,
      item_to_id: form.value.item_to_id,
    });

    alert("Trade offer sent successfully!");
    router.push("/items");
  } catch (err) {
    error.value = err.response?.data?.message || "Failed to create trade offer";
  } finally {
    submitting.value = false;
  }
};

onMounted(() => {
  fetchMyItems();
});
</script>
