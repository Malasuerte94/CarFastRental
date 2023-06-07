<template>
    <div class="homepage">
        <div class="homepage-hero">
            <Suspense>
                <HeroBanner />
                <template #fallback>
                    <fallback :height="230" />
                </template>
            </Suspense>
            <div>
            <Suspense>
                <FeatureIconTitle />
                <template #fallback>
                    <fallback :height="90" />
                </template>
            </Suspense>
            <Spacer />
            <SearchFrom />
            </div>
        </div>
        <Suspense>
            <Faq />
            <template #fallback>
                <fallback :height="390" />
            </template>
        </Suspense>
        <Spacer />
        <Suspense>
            <CtaPhone />
            <template #fallback>
                <fallback :height="390" />
            </template>
        </Suspense>
    </div>
</template>

<script>
import FeatureCards from "./FeatureCards";
import HeroBanner from "./HeroBanner";
import SearchFrom from "./SearchFrom";
import FeatureIconTitle from "./FeatureIconTitle";
import CtaPhone from "./CtaPhone";
import Faq from "./Faq";

export default {
    name: "Homepage",
    components: {
        HeroBanner,
        FeatureCards,
        SearchFrom,
        FeatureIconTitle,
        CtaPhone,
        Faq,
    },
    data() {
        return {
            loading: false,
        };
    },
    mounted() {
        this.loading = false;
    },
};
</script>
