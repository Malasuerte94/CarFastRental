<template>
  <div class="container p-0">
    <HeroBanner/>
    <FeatureCards/>
  </div>
</template>

<script>
import FeatureCards from './FeatureCards.vue';
import HeroBanner from './HeroBanner.vue';

export default {
    components: { HeroBanner, FeatureCards },
    name: 'Homepage',
    data() {
        return {
        }
    },
}
</script>
