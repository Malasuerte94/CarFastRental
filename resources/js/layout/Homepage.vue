<template>
    <div class="container p-0">
        <loader v-if="loading" />
        <HeroBanner />
        <div class="title-no-container">
            <h4>Rezervă acum și beneficiezi de</h4>
        </div>
        <FeatureIconTitle />
        <Spacer/>
        <SearchFrom />
        <div class="title-no-container">
            <h4>
                Întrebări frecvente
            </h4>
        </div>
        <Faq />
        <Spacer/>
        <CtaPhone />
        <vue-whatsapp-widget phoneNumber="+40746464272"/>
    </div>
</template>

<script>
import FeatureCards from "./FeatureCards";
import HeroBanner from "./HeroBanner";
import SearchFrom from "./SearchFrom";
import FeatureIconTitle from "./FeatureIconTitle";
import VueWhatsappWidget from 'vue-whatsapp-widget'
import CtaPhone from "./CtaPhone";
import Faq from "./Faq";

export default {
    name: "Homepage",
    components: { HeroBanner, FeatureCards, SearchFrom, FeatureIconTitle, VueWhatsappWidget, Faq, CtaPhone},
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
