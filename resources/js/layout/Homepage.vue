<template>
  <div class="container p-0">
    <HeroBanner/>
    <SearchFrom/>
    <FeatureCards/>
  </div>
</template>

<script>
import FeatureCards from './FeatureCards';
import HeroBanner from './HeroBanner';
import SearchFrom from './SearchFrom';
export default {
    components: { HeroBanner, FeatureCards, SearchFrom },
    name: 'Homepage',
    data() {
        return {
        }
    },
}
</script>
