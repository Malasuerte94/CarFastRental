<template>
    <div class="feature-cards" v-if="!loading">
        <div class="feature-card">
            <div class="feature-card-header">
                <i class="fas fa-utensils"></i>
                <h3 class="feature-card-title">Sofer Aditional</h3>
            </div>
            <div class="feature-card-content">
                <p class="feature-card-description">La noi ai încă un șofer adițional gratuit!</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-card-header">
                <i class="fas fa-utensils"></i>
                <h3 class="feature-card-title">Rovinieta</h3>
            </div>
            <div class="feature-card-content">
                <p class="feature-card-description">Rovinieta, asigurare, casco, le avem pe toate!</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-card-header">
                <i class="fas fa-utensils"></i>
                <h3 class="feature-card-title">Flota</h3>
            </div>
            <div class="feature-card-content">
                <p class="feature-card-description">La noi ai încă un șofer adițional gratuit!</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-card-header">
                <i class="fas fa-utensils"></i>
                <h3 class="feature-card-title">Digitalizat</h3>
            </div>
            <div class="feature-card-content">
                <p class="feature-card-description">Știm ca nu vrei să stai la cozi, poți online!</p>
            </div>
        </div>
    </div>
    <span v-else>Loading</span>
</template>

<script>

export default {
    name: 'FeatureCards',
    data() {
        return {
            loading: false,
            products: null,
        }
    },
    methods: {

    }
}
</script>
