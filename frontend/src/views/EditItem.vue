<template>
  <div class="form-page">
    <div class="form-container">
      <h2>Edit Product</h2>

      <div v-if="loading" class="loading">Loading...</div>

      <form v-else @submit.prevent="handleSubmit">
        <div class="form-group">
          <label for="name">Product Title</label>
          <input type="text" id="name" v-model="form.name" required />
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea
            id="description"
            v-model="form.description"
            required
            rows="5"
          ></textarea>
        </div>

        <div class="form-group">
          <label for="price">Price ($)</label>
          <input
            type="number"
            id="price"
            v-model="form.price"
            step="0.01"
            min="0"
            required
          />
        </div>

        <div class="form-group">
          <label for="image">Picture (leave blank to keep current)</label>
          <input
            type="file"
            id="image"
            @change="handleImageChange"
            accept="image/*"
          />
        </div>

        <div v-if="error" class="error-message">{{ error }}</div>

        <div class="form-buttons">
          <button type="submit" :disabled="updating">
            {{ updating ? "Updating..." : "Update Product" }}
          </button>
          <router-link to="/account" class="btn back-btn">Back</router-link>
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
  name: "",
  description: "",
  price: "",
  image: null,
});

const error = ref("");
const loading = ref(true);
const updating = ref(false);

const fetchItem = async () => {
  try {
    const response = await api.get(`/items/${route.params.id}`);
    const item = response.data;
    form.value = {
      name: item.translations?.[0]?.name || "",
      description: item.translations?.[0]?.description || "",
      price: item.price,
      image: null,
    };
  } catch (err) {
    error.value = "Failed to load item";
    console.error(err);
  } finally {
    loading.value = false;
  }
};

const handleImageChange = (event) => {
  form.value.image = event.target.files[0];
};

const handleSubmit = async () => {
  error.value = "";
  updating.value = true;

  try {
    const formData = new FormData();
    formData.append("name", form.value.name);
    formData.append("description", form.value.description);
    formData.append("price", form.value.price);
    formData.append("_method", "PUT");

    if (form.value.image) {
      formData.append("image", form.value.image);
    }

    await api.post(`/items/${route.params.id}`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });

    router.push("/account");
  } catch (err) {
    error.value = err.response?.data?.message || "Failed to update item";
  } finally {
    updating.value = false;
  }
};

onMounted(() => {
  fetchItem();
});
</script>
