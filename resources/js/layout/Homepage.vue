<template>
    <div class="container p-0">
        <Suspense>
           <HeroBanner />
           <template #fallback>
                <Fallback :height="230" />
           </template>
        </Suspense>

        <div class="title-no-container">
            <h4>
                {{ settings.settings.feature_icons_title.value }}
            </h4>
        </div>

        <Suspense>
           <FeatureIconTitle />
           <template #fallback>
                <Fallback :height="90" />
           </template>
        </Suspense>

        <Spacer/>

        <SearchFrom />

        <div class="title-no-container">
            <h4>
                {{ settings.settings.home_faq_title.value }}
            </h4>
        </div>
        <Faq />
        <Spacer/>
        <CtaPhone />
    </div>
</template>

<script>
import FeatureCards from "./FeatureCards";
import HeroBanner from "./HeroBanner";
import Fallback from "./Fallback/Fallback";
import SearchFrom from "./SearchFrom";
import FeatureIconTitle from "./FeatureIconTitle";
import CtaPhone from "./CtaPhone";
import Faq from "./Faq";

export default {
    name: "Homepage",
    components: { HeroBanner, Fallback, FeatureCards, SearchFrom, FeatureIconTitle, CtaPhone, Faq},
    data() {
        return {
            loading: false,
            settings: this.$store.state.settings,
        };
    },
    mounted() {
        this.loading = false;
    },
};
</script>
