<template>
  <div v-if="loading">Loading...</div>
  <div v-else class="adjectives-row">
    <div
      class="adjective-single text-center"
      v-for="(adjective, index) in adjectives"
      :key="index"
    >
      <img
        class="rounded-circle m-auto"
        width="50px"
        height="50px"
        :src="adjective.adjective.icon"
      />
      <span>{{ adjective.adjective.name }} : {{ adjective.value }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    bookableId: [String, Number],
  },
  data() {
    return {
      loading: false,
      adjectives: null,
    };
  },
  created() {
    this.loading = true;
    axios
      .get(`/api/bookables/${this.bookableId}/adjectives`)
      .then((response) => (this.adjectives = response.data.data))
      .then(() => (this.loading = false));
  },
};
</script>
