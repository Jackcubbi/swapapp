<template>
  <div class="item-card">
    <img
      :src="itemImage"
      :alt="item.translations?.[0]?.name || 'Item'"
      @error="handleImageError"
    />
    <h3>{{ item.translations?.[0]?.name || "Untitled" }}</h3>
    <p class="price">Price: ${{ item.price }}</p>
    <p class="description">
      {{ item.translations?.[0]?.description || "No description" }}
    </p>
    <p class="seller" v-if="item.user">Seller: {{ item.user.username }}</p>

    <div class="item-actions">
      <slot name="actions"></slot>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from "vue";

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
});

const imageError = ref(false);

const itemImage = computed(() => {
  if (imageError.value || !props.item.image) {
    return "/no-image.png";
  }
  return `http://localhost:8000/storage/${props.item.image}`;
});

const handleImageError = () => {
  imageError.value = true;
};
</script>
