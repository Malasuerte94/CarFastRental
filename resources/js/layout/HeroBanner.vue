<template>
    <Splide class="hero-banner" v-if="!loading"
        :options="{ rewind: false, arrows: false, pagination: false, type: 'loop' }" aria-label="Hero Header">
        <SplideSlide v-for="product in products" :key="product.id">
            <div class="hero-container">
                <img :src="product.image" class="card-img mb-2" />
                <router-link :to="{ name: 'bookable', params: { product } }">
                    <h2 class="hero-title" :data-text="product.title">{{ product.title }}</h2>
                    <span class="hero-price">De la {{ product.price }} LEI</span>
                </router-link>
            </div>
        </SplideSlide>
    </Splide>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import SettingsService from "./../services/settingsService";
export default {
    name: 'HeroBanner',
    components: { Splide, SplideSlide },
    data() {
        return {
            loading: true,
            products: null,
        }
    },
    async mounted() {
        let productsExtracted = await SettingsService.getHeroProducts();
        this.products = productsExtracted.data.data;
        this.loading = false;
    },
    watch: {
        products: function (newVal, oldVal) {
            this.$emit('loaded');
        }
    }
}
</script>
