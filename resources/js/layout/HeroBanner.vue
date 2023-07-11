<template>
    <Splide class="hero-banner" v-if="products"
        :options="{ rewind: false, arrows: false, pagination: false, type: 'loop' }" aria-label="Hero Header">
        <SplideSlide v-for="product in products" :key="product.id">
            <div class="hero-container">
                wa
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
        </SplideSlide>
    </Splide>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import SettingsService from "./../services/settingsService";

export default {
    name: 'HeroBanner',
    components: { Splide, SplideSlide },
    async setup() {
        let products = await SettingsService.getHeroProducts()
        return { products: products.data.data }
    }
}
</script>
