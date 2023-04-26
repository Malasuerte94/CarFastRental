<template>
    <div v-if="!loading" class="container faq-box">
    <div class="accordion">
        <div
            v-for="(question, index) in faqs"
            :key="question.title"
        >
            <div
                class="accordion__item"
                @click="handleAccordion(index)"
            >
                <span :class="[
                    'accordion__title',
                    {
                        active: question.isExpanded,
                    },
                ]">{{ question.title }}</span>
            </div>
            <Collapse
                as="div"
                :when="question.isExpanded"
                class="faq-content"
            >
                <p>
                    {{ question.answer }}
                </p>
            </Collapse>
        </div>
    </div>
    </div>
</template>

<script>
import { reactive } from "vue";
import { Collapse } from "vue-collapsed";
import settingsService from "../services/settingsService";
export default {
    name: "Faq",
    components: {
        Collapse,
    },
    data() {
        return {
            loading: true,
            faqs: null,
        };
    },
    async created() {
        let extracted = await settingsService.getFaqs();
        extracted = extracted.data.data;

        this.faqs = reactive(
            extracted.map(({ category, id, order, title, value }, index) => ({
                title: title,
                answer: value,
                isExpanded: index === 2, // Initial values, display expanded on mount
            }))
        );

        this.loading = false;
    },
    methods: {
        handleAccordion(selectedIndex) {
            this.faqs.forEach((_, index) => {
                this.faqs[index].isExpanded =
                    index === selectedIndex
                        ? !this.faqs[index].isExpanded
                        : false;
            });
        },
    },
    watch: {
        faqs: function (newVal, oldVal) {
            this.$emit("loaded");
        },
    },
};
</script>
