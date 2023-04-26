<template>
    <div class="card w-100">
        <div class="card-body">
            <div class="car-details">
                <div class="img-box">
                    <img :src="main_image" class="card-img mb-2" />
                </div>
                <div class="car-title">
                    <router-link :to="{ name: 'bookable', params: { id } }">
                        <h5 class="car-name">{{ title }}</h5>
                        <div class="car-year">{{ year }}</div>
                    </router-link>
                </div>
            </div>
            <div class="car-features">
                <div class="car-feature" v-for="(feature, key) in features" :key="key">
                        <img
                            class="car-feature-icon"
                            :src="feature.feature_icon"
                            alt=""
                        />
                        <span class="car-feature-value">{{ feature.value }}</span>
                </div>
            </div>
            <div class="car-cta">
                <div class="car-price">{{ price }} lei<span>/zi</span></div>
                <div @click="$router.push({name:'bookable',params:{id}})" class="car-button">Detalii</div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        title: String,
        description: String,
        year: String,
        id: Number,
        main_image: String,
        price: Number,
        features: Array,
    },
};
</script>


