<template>
  <div style="padding: 1.25rem">
    <h6 class="text-uppercase text-secondary font-weight-bolder pt-4">
      Review List
    </h6>
    <div v-if="loading">Loading...</div>
    <div v-else>
      <div
        class="border-bottom"
        v-for="(review, index) in reviews"
        :key="index"
      >
        <div class="row pt-4">
          <div class="col-md-6">Ene Catalin</div>
          <div class="col-md-6 d-flex justify-content-end">
            <star-rating :value="review.rating"></star-rating>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            {{ $formatDate(review.created_at)}}
          </div>
        </div>
        <div class="row pb-4 pt-4">
          <div class="col-md-12">
            {{ review.content }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ReviewService from '../services/reviewService';
export default {
  props: {
    bookableId: [String, Number],
  },
  data() {
    return {
      loading: false,
      reviews: null,
    };
  },
  created() {
    this.loading = true;
    ReviewService.getBookableReviews(this.bookableId)
      .then((response) => (this.reviews = response.data.data))
      .then(() => (this.loading = false));
  },
};
</script>
