<template>
  <div class="row">
    <div class="row">
      <div class="col-md-8 pb-4">
        <div class="card main-car shadow p-3 mb-5 bg-white rounded">
          <div class="card-body text-center">
            <div v-if="!loading">
              <img :src="bookable.main_image" class="card-img" />
              <h2>{{ bookable.title }}</h2>
              <hr />
              <article>{{ bookable.description }}</article>
              <adjective-list
                :class="[{ 'adjectives-row-active': collapseAdjectives }]"
                :bookable-id="this.$route.params.id"
              ></adjective-list>
              <div class="btn_parent_collapse_adjectives">
                <span
                  @click="collapseAdjectives = !collapseAdjectives"
                  :class="[{ 'arrow-down': collapseAdjectives }]"
                  class="button_collapse_adjectives"
                  ><i class="fa fa-arrow-down"></i
                ></span>
              </div>
            </div>
            <div v-else>Loading ...</div>
          </div>
        </div>
      </div>
      <div class="col-md-4 pb-4">
        <stock
          :bookable-id="this.$route.params.id"
          @stock="checkPrice($event)"
        ></stock>
        <transition name="fade">
          <price-breakdown
            v-if="price"
            :price="price"
            class="mb-4 mt-4"
          />
        </transition>

        <transition name="fade">
          <button
            class="btn btn-outline-secondary btn-block"
            v-if="price"
            @click.prevent="addToBasket"
            :disabled="inBasketAlready"
          >
            Book Now
          </button>
        </transition>

        <transition name="fade">
          <button
            class="mt-2 btn btn-outline-secondary btn-block"
            v-if="inBasketAlready"
            @click.prevent="removeFromBasket"
          >
            Remove from cart
          </button>
        </transition>

        <div v-if="inBasketAlready" class="mt-4 text-muted warning">
          Seems like you've added this item to basket already, if you want to
          change datest remove from the basket first.
        </div>
      </div>
    </div>
    <review-list :bookable-id="this.$route.params.id"></review-list>
  </div>
</template>

<script>
import Stock from "./Stock";
import ReviewList from "./ReviewList";
import PriceBreakdown from "./PriceBreakdown";
import AdjectiveList from "./AdjectiveList";

import { mapState } from "vuex";

export default {
  components: {
    Stock,
    ReviewList,
    PriceBreakdown,
    AdjectiveList,
  },
  data() {
    return {
      bookable: null,
      loading: false,
      price: null,
      collapseAdjectives: false,
    };
  },
  created() {
    this.loading = true;
    axios.get(`/api/bookables/${this.$route.params.id}`).then((response) => {
      this.bookable = response.data.data;
      this.loading = false;
    });
  },
  computed: {
    ...mapState({
      lastSearch: "lastSearch",
    }),
    inBasketAlready() {
      if (null === this.bookable) {
        return false;
      }
      return this.$store.getters.inBasketAlready(this.bookable.id);
    },
  },
  methods: {
    async checkPrice(hasStock) {
      if (!hasStock) {
        this.price = null;
        return;
      }
      try {
        this.price = (
          await axios.get(
            `/api/bookables/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`
          )
        ).data.data;
      } catch (err) {
        this.price = null;
      }
    },
    addToBasket() {
      this.$store.dispatch("addToBasket", {
        bookable: this.bookable,
        price: this.price,
        dates: this.lastSearch,
      });
    },
    removeFromBasket() {
      this.$store.dispatch("removeFromBasket", this.bookable.id);
    },
  },
};
</script>

<style scoped>
.warning {
  font-size: 0.75rem;
}
</style>
