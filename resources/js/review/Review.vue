<template>
  <div>
    <success v-if="success">You've left a review, thank you very much!</success>
    <fatal-error v-if="error"></fatal-error>
    <div v-if="!success && !error" class="row">
      <div :class="[{ 'col-md-4': twoColumns }, { 'd-none': oneColumn }]">
        <div class="card">
          <div class="card-body">
            <div v-if="loading">Loading...</div>
            <div v-if="hasBooking">
              <p>
                Stayed at
                <router-link
                  :to="{
                    name: 'bookable',
                    params: { id: booking.bookable.bookable_id },
                  }"
                  >{{ booking.bookable.title }}</router-link
                >
              </p>
              <p>From {{ booking.from }} to {{ booking.to }}</p>
            </div>
          </div>
        </div>
      </div>
      <div :class="[{ 'col-md-8': twoColumns }, { 'col-md-12': oneColumn }]">
        <div v-if="loading">Loading...</div>
        <div v-else>
          <div v-if="alreadyReviewed">
            <h3>You've already left a review for this booking!</h3>
          </div>
          <div v-else>
            <div class="form-group">
              <label for="" class="text-muted"
                >Select the star rating (1 is worst - 5 is best)</label
              >
              <star-rating class="fa-3x" v-model="review.rating"></star-rating>
            </div>
            <div class="form-group">
              <label for="content" class="text-muted"
                >Describe your experience with</label
              >
              <textarea
                name="content"
                cols="30"
                rows="10"
                class="form-control"
                :class="[{ 'is-invalid': errorFor('content') }]"
                v-model="review.content"
              >
              </textarea>
              <v-errors :errors="errorFor('content')"></v-errors>
            </div>
            <button
              @click.prevent="submit"
              :disabled="sending"
              class="btn tn-lg btn-primary btn-block"
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { is404, is422 } from "./../shared/utils/response";
import validationErrors from "./../shared/mixins/validationErrors";
import ReviewService from '../services/reviewService';
export default {
  mixins: [validationErrors],
  data() {
    return {
      review: {
        id: null,
        rating: 5,
        content: null,
      },
      existingReview: null,
      loading: false,
      booking: null,
      error: false,
      sending: false,
      success: false
    };
  },
  async created() {
    this.review.id = this.$route.params.id;
    this.loading = true;

    try {
      this.existingReview = (await ReviewService.getReview(this.review.id).data.data);
    } catch (err) {
      if (is404(err)) {
        try {
          this.booking = (await ReviewService.getBookableReview(this.review.id).data.data);
        } catch (err) {
          this.error = !is404(err);
        }
      } else {
        this.error = true;
      }
    }

    this.loading = false;
  },
  computed: {
    alreadyReviewed() {
      return this.hasReview || !this.booking;
    },
    hasReview() {
      return this.existingReview !== null;
    },
    hasBooking() {
      return this.booking !== null;
    },
    oneColumn() {
      return !this.loading && this.alreadyReviewed;
    },
    twoColumns() {
      return this.loading || !this.alreadyReviewed;
    },
  },
  methods: {
    submit() {
      this.sending = true;
      this.errors = null;
      this.success =false;

      ReviewService.postBookableReview(this.review)
        .then((response) => {
            this.success = 201 === response.status;
        })
        .catch((err) => {
          if (is422(err)) {
            const errors = err.response.data.errors;
            if (errors["content"] && 1 === _.size(errors)) {
              this.errors = errors;
              return;
            }
          }
          this.error = true;
        })
        .then(() => (this.sending = false));
    },
  },
};
</script>
