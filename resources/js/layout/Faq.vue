<template>
    <div class="container faq-box">
        <VueFaqAccordion
            :items="myItems"
        />
    </div>
</template>

<script>
import VueFaqAccordion from 'vue-faq-accordion'
export default {
    name: 'Faq',
    components: {
        VueFaqAccordion
    },
    data () {
    return {
      myItems: [
          {
            title: 'Care este vârstă minima pentru a putea închiria un autoturism?',
            value: 'Trebuie sa aveti cel putin 21 de ani pentru a inchiria un autoturism si sa aveti permisul de conducere de cel putin un an.',
            category: 'Generale'
          },
          {
            title: 'Se poate adăuga un șofer adițional serviciului de închiriere?',
            value: 'Autoturismul inchiriat este asigurat doar pentru persoana care este titulara contractului. Daca alta persoana intentioneaza sa conduca, acea persoana trebuie mentionata in contractul de inchiriere la momentul ridicării autoturismului.',
            category: 'Generale'
          },
          {
            title: 'Exista o limită de kilometri?',
            value: 'NafiRent a Car nu impune o limita de kilometri, beneficiați gratuit de acest serviciu.',
            category: 'Generale'

          },
          {
            title: 'Ce documente sunt necesare pentru a putea închiria un autoturism?',
            value: 'Aveți nevoie de un act de identitate sau pașaport si de permisul de conducere.',
            category: 'Generale'
          },
        ]
    }
  }
}
</script>
