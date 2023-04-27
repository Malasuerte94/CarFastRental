<template>
    <div class="cta-phone">
        <div class="cta-phone-box">
            <h4 class="cta-phone-title">{{ settings.settings.cta_phone_icon.value }}</h4>
            <div class="cta-phone-buttons">
                <div class="cta-phone-element">
                    <a :href="'tel:'+settings.settings.cta_phone_number.value">
                        <i class="fas fa-phone-alt"></i>
                        <span>{{ settings.settings.cta_phone_number.value }}</span>
                    </a>
                </div>
                <div class="cta-phone-element">
                    <a :href="'tel:'+settings.settings.cta_phone_number_2.value">
                        <i class="fas fa-phone-alt"></i>
                        <span>{{ settings.settings.cta_phone_number_2.value }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'CtaPhone',
    data() {
        return {
            settings: this.$store.state.settings,
        }
    }
}
</script>
