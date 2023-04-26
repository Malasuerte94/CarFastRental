<template>
    <div v-if="!loading" class="container feature-icon-title">
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
    data() {
        return {
            loading: true,
            featureCardIcons: null,
        }
    },
    async mounted() {
        let extracted = await settingsService.getFeatureCardIcons();
        this.featureCardIcons = extracted.data.data;
        this.loading = false;
    },
    watch: {
        featureCardIcons: function (newVal, oldVal) {
            this.$emit('loaded');
        }
    }
}
</script>
