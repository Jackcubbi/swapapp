<template>
  <div class="form-page">
    <div class="form-container">
      <h2>Add Product</h2>

      <form @submit.prevent="handleSubmit">
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
          <label for="image">Picture</label>
          <input
            type="file"
            id="image"
            @change="handleImageChange"
            accept="image/*"
            required
          />
        </div>

        <div v-if="error" class="error-message">{{ error }}</div>

        <div class="form-buttons">
          <button type="submit" :disabled="loading">
            {{ loading ? "Adding..." : "Add Product" }}
          </button>
          <router-link to="/account" class="btn back-btn">Back</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../utils/api";

const router = useRouter();

const form = ref({
  name: "",
  description: "",
  price: "",
  image: null,
});

const error = ref("");
const loading = ref(false);

const handleImageChange = (event) => {
  form.value.image = event.target.files[0];
};

const handleSubmit = async () => {
  error.value = "";
  loading.value = true;

  try {
    const formData = new FormData();
    formData.append("name", form.value.name);
    formData.append("description", form.value.description);
    formData.append("price", form.value.price);
    if (form.value.image) {
      formData.append("image", form.value.image);
    }

    await api.post("/items", formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });

    router.push("/account");
  } catch (err) {
    error.value = err.response?.data?.message || "Failed to add item";
  } finally {
    loading.value = false;
  }
};
</script>
