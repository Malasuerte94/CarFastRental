<template>
  <div class="card w-100">
    <div class="card-body">
      <img :src="main_image" class="card-img mb-2" />
      <router-link :to="{ name: 'bookable', params: { id } }">
        <h5 class="card-title">{{ title }}</h5>
      </router-link>

      <p class="card-text">{{ description }}</p>
    </div>
  </div>
</template>


<script>
export default {
  props: { title: String, description: String, id: Number, main_image: String },
};
</script>


