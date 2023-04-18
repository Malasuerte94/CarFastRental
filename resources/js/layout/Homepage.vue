<template>
    <div class="container p-0">
        <loader v-if="loading" />
        <HeroBanner />
        <FeatureIconTitle />
        <SearchFrom />
        <FeatureCards />
         <vue-whatsapp-widget phoneNumber="+40746464272"/>
    </div>
</template>

<script>
import FeatureCards from "./FeatureCards";
import HeroBanner from "./HeroBanner";
import SearchFrom from "./SearchFrom";
import FeatureIconTitle from "./FeatureIconTitle";
import VueWhatsappWidget from 'vue-whatsapp-widget'

export default {
    name: "Homepage",
    components: { HeroBanner, FeatureCards, SearchFrom, FeatureIconTitle, VueWhatsappWidget},
    data() {
        return {
            loading: true,
        };
    },
    mounted() {
        this.loading = false;
    },
};
</script>
