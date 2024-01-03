<template>
    <div class="hero-banner" v-if="products" aria-label="Hero Header">
        <div v-for="(product, index) in products" :key="product.id">
            <div class="hero-container" v-if="banner === index">
                <div class="features">
                    <div class="car-feature-hero" v-for="(feature, key) in product.features" :key="key">
                        <img
                            class="car-feature-icon-hero"
                            :src="feature.feature_icon"
                            alt=""
                        />
                        <span class="car-feature-value-hero">{{ feature.value }}</span>
                    </div>
                </div>
                <img :src="product.image" class="card-img mb-2" />
                <router-link :to="{ name: 'bookable', params: { id: product.id } }">
                    <h2 class="hero-title" :data-text="product.title">{{ product.title }}</h2>
                    <span class="hero-price">De la {{ product.price }} LEI</span>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import SettingsService from "./../services/settingsService";

export default {
    name: 'HeroBanner',
    data() {
      return {
        banner: 1,
      };
    },
    async setup() {
          let products = await SettingsService.getHeroProducts()
          return { products: products.data.data }
    }
}
</script>
