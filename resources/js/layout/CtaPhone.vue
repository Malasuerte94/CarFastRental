<template>
    <div class="cta-phone">
        <div class="cta-phone-box">
            <h4 class="cta-phone-title">Ne puteți contacta telefonic la</h4>
            <div class="cta-phone-buttons">
                <div class="cta-phone-element">
                    <a href="tel:0747729446">
                        <i class="fas fa-phone-alt"></i>
                        <span>0747729446</span>
                    </a>
                </div>
                <div class="cta-phone-element">
                    <a href="tel:0756245243">
                        <i class="fas fa-phone-alt"></i>
                        <span>0756245243</span>
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
            contactData: [
                {
                    icon: '',
                    phone: 'Trebuie sa aveti cel putin 21 de ani pentru a inchiria un autoturism si sa aveti permisul de conducere de cel putin un an.',
                },
                {
                    icon: 'Care este vârstă minima pentru a putea închiria un autoturism?',
                    phone: 'Trebuie sa aveti cel putin 21 de ani pentru a inchiria un autoturism si sa aveti permisul de conducere de cel putin un an.',
                },
            ]
        }
    }
}
</script>
