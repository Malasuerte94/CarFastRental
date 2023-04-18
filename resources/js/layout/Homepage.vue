<template>
  <div class="container p-0">
    <loader v-if="loading" />
    <HeroBanner />
    <SearchFrom />
    <FeatureCards />
  </div>
</template>

<script>
import FeatureCards from "./FeatureCards";
import HeroBanner from "./HeroBanner";
import SearchFrom from "./SearchFrom";

export default {
  name: "Homepage",
  components: { HeroBanner, FeatureCards, SearchFrom },
  data() {
    return {
      loading: true,
    };
  },
  mounted() {
  },
};
</script>
