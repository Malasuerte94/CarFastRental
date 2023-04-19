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
            title: 'How many time zones are there in all?',
            value: 'Given a 24-hour day and 360 degrees of longitude around the Earth',
            category: 'Despre Mașini'
          },
          {
            title: 'How long is a day and year on Venus?',
            value: 'Venus takes 224.7 Earth days to complete one orbit around the Sun.',
            category: 'Despre Mașini'
          },
          {
            title: 'What animal smells like popcorn?',
            value: 'Binturongs smell like popcorn.',
            category: 'Despre Cont'

          },
          {
            title: 'How many time zones are there in all?',
            value: 'Given a 24-hour day and 360 degrees of longitude around the Earth',
            category: 'Despre Mașini'
          },
          {
            title: 'How long is a day and year on Venus?',
            value: 'Venus takes 224.7 Earth days to complete one orbit around the Sun.',
            category: 'Despre Mașini'
          },
        {
            title: 'What animal smells like popcorn?',
            value: 'Binturongs smell like popcorn.',
            category: 'Despre Cont'
          }
        ]
    }
  }
}
</script>
