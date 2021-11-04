<template>
  <div style="padding: 1.25rem">
    <div v-if="loading">Loading...</div>
    <div v-else class="row">
      <div
        class="
          col-md-12 col-lg-4
          d-flex
          justify-content-center
          text-center
          flex-column
          p-2
        "
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
      .then(
        (response) => (
          (this.adjectives = response.data.data),
          console.log(response.data.data)
        )
      )
      .then(() => (this.loading = false));
  },
};
</script>