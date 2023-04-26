<template>
    <div class="container search-form">
        <StockSimple :search-only="true" />
    </div>
</template>

<script>
import StockSimple from '../bookable/StockSimple.vue';
export default {
    name: 'SearchFrom',
    components: {
        StockSimple,
    },
}
</script>
