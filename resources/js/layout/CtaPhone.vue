<template>
    <div class="cta-phone">
        <div class="cta-phone-box">
            <h4 class="cta-phone-title">
                {{ settings.settings.cta_phone_icon.value }}
            </h4>
            <div class="cta-phone-buttons">
                <v-btn variant="outlined" prepend-icon="mdi-check-circle">
                    {{ settings.settings.cta_phone_number.value }}
                </v-btn>
                <v-btn variant="outlined" prepend-icon="mdi-check-circle">
                    {{ settings.settings.cta_phone_number_2.value }}
                </v-btn>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CtaPhone",
    data() {
        return {
            settings: this.$store.state.settings,
        };
    },
};
</script>
