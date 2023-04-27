<template>
    <div class="container feature-icon-title">
        <div class="feature-card" v-for="featureCard in featureCardIcons" :key="featureCard.id">
            <div class="feature-card-header">
                <img :src="featureCard.icon"/>
                <h3 class="feature-card-title">{{ featureCard.title }}</h3>
            </div>
        </div>
    </div>
</template>

<script>
import settingsService from '../services/settingsService';

export default {
    name: 'FeatureIconTitle',
    async setup() {
        let featureCardIcons = await settingsService.getFeatureCardIcons()
        return { featureCardIcons: featureCardIcons.data.data }
    }
}
</script>
