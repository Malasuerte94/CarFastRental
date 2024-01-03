<template>
    <div class="container feature-icon-title">
        <h4 class="hidden">
            {{ $store.state.settings.settings.feature_icons_title.value }}
        </h4>
        <div class="content">
            <div class="feature-card" v-for="featureCard in featureCardIcons" :key="featureCard.id">
                <div class="feature-card-header">
                    <img :src="featureCard.icon"/>
                    <h3 class="feature-card-title">{{ featureCard.title }}</h3>
                </div>
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
