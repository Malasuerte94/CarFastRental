<template>
    <div class="container faq-box">
        <div>
            <h4>
                {{ $store.state.settings.settings.home_faq_title.value }}
            </h4>
        </div>
        <div class="accordion">
             <v-expansion-panels>
                <v-expansion-panel
                    v-for="(question, index) in faqs"
                    :key="index"
                    :title="question.title"
                    :text="question.answer"
                />
            </v-expansion-panels>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
import settingsService from "../services/settingsService";
export default {
    name: "Faq",
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
};
</script>
