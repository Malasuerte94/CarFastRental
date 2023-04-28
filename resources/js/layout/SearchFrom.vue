<template>
    <Suspense>
        <div class="container search-form">
            <StockSimple :search-only="true" />
        </div>
        <template #fallback>
            <fallback :height="240" />
        </template>
    </Suspense>
</template>

<script>
import StockSimple from "../bookable/StockSimple.vue";
export default  {
    name: "SearchFrom",
    components: {
        StockSimple,
    },
};
</script>
