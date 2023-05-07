<template>
    <div class="product-page">
        <div class="col-lg-12 p-0">
            <div class="row">
                <div class="col-md-8 p-0">
                    <div class="main-car">
                        <div class="text-center">
                                <div class="car-bg">
                                    <img
                                        :src="bookable.main_image"
                                        class="card-img"
                                    />
                                </div>
                                <h2>{{ bookable.title }} - {{ bookable.year }}</h2>
                                <article class="product-content mt-2 mb-2">
                                    {{ bookable.description }}
                                    <adjective-list
                                    class="pt-2"
                                    :bookable-id="this.$route.params.id"
                                ></adjective-list>
                                </article>
                        </div>
                    </div>
                </div>
                <div class="container col-md-4 pb-4 pt-4">
                    <Suspense>
                        <stock-simple
                            :bookable-id="this.$route.params.id"
                            @stock="checkPrice($event)"
                        />
                        <template #fallback>
                            <fallback :height="390" />
                        </template>
                    </Suspense>

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
                        Seems like you've added this item to basket already, if
                        you want to change datest remove from the basket first.
                    </div>
                </div>
            </div>
        </div>
        <review-list
            class="col-lg-12 p-0"
            :bookable-id="this.$route.params.id"
        ></review-list>
    </div>
</template>

<script>
import ReviewList from "./ReviewList";
import PriceBreakdown from "./PriceBreakdown";
import AdjectiveList from "./AdjectiveList";

import { mapState } from "vuex";
import StockSimple from "./StockSimple.vue";
import BookableService from "./../services/bookableService";

export default {
    components: {
        ReviewList,
        PriceBreakdown,
        AdjectiveList,
        StockSimple,
    },
    data() {
        return {
            bookable: null,
            loading: false,
            price: null,
            collapseAdjectives: false,
        };
    },
    async created() {
        this.loading = true;
        let bookableExtracted = await BookableService.getBookable(
            this.$route.params.id
        );
        this.bookable = bookableExtracted.data.data;
        this.loading = false;
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
                let priceExtracted = await BookableService.getPrice(
                    this.bookable.id,
                    this.lastSearch.fromDate,
                    this.lastSearch.fromTime,
                    this.lastSearch.toDate,
                    this.lastSearch.toTime
                );
                this.price = priceExtracted.data.data;
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
