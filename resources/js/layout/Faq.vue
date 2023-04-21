<template>
    <div v-if="!loading" class="container faq-box">
        <VueFaqAccordion
            :items="faqs"
        />
    </div>
</template>

<script>
import VueFaqAccordion from 'vue-faq-accordion'
import settingsService from '../services/settingsService'
export default {
    name: 'Faq',
    components: {
        VueFaqAccordion
    },
    data() {
        return {
            loading: true,
            faqs: null,
        }
    },
    async mounted() {
        let extracted = await settingsService.getFaqs();
        this.faqs = extracted.data.data;
        this.loading = false;
    },
    watch: {
        faqs: function (newVal, oldVal) {
            this.$emit('loaded');
        }
    }
}
</script>
