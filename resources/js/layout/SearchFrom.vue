<template>
    <Suspense>
        <div class="container search-form">
            <StockSimple :search-only="true" />
        </div>
        <template #fallback>
            <Fallback :height="240" />
        </template>
    </Suspense>
</template>

<script>
import Fallback from "./Fallback/Fallback.vue";
import StockSimple from "../bookable/StockSimple.vue";
export default {
    name: "SearchFrom",
    components: {
        StockSimple,
        Fallback,
    },
};
</script>
