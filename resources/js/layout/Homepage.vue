<template>
    <v-container class="homepage">
        <Suspense>
            <SimpleBanner />
            <template #fallback>
                <fallback :height="230" />
            </template>
        </Suspense>
        <SearchFrom />
        <div>
          <Suspense>
              <FeatureIconTitle />
              <template #fallback>
                  <fallback :height="90" />
              </template>
          </Suspense>
          <Spacer />
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
    </v-container>
</template>

<script>
import FeatureCards from "./FeatureCards";
import SearchFrom from "./SearchFrom";
import FeatureIconTitle from "./FeatureIconTitle";
import CtaPhone from "./CtaPhone";
import Faq from "./Faq";
import SimpleBanner from "./SimpleBanner.vue";

export default {
    name: "Homepage",
    components: {
        SimpleBanner,
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
