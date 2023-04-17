<template>
    <div class="container search-form" v-if="!loading">
        <StockSimple :search-only="true" />
    </div>
    <span v-else>Loading</span>
</template>

<script>
import StockSimple from '../bookable/StockSimple.vue';
export default {
    name: 'SearchFrom',
    components: {
        StockSimple,
    },
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
