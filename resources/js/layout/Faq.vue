<template>
    <div class="container faq-box">
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
    async setup() {
        const faqs = reactive([]);
        const extracted = await settingsService.getFaqs();
        extracted.data.data.forEach(({ category, id, order, title, value }) => {
            faqs.push({
                title: title,
                answer: value,
                isExpanded: false,
            });
        });
        return { faqs };
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
    }
};
</script>
