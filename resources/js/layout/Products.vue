<template>
  <v-container>
    <div class="products">
        <loader v-if="loading" />
        <Bookables />
    </div>
  </v-container>
</template>

<script>
import Bookables from '../bookables/Bookables'

export default {
    name: 'Products',
    components: { Bookables },
    data() {
        return {
            loading: true
        }
    },
    mounted() {
        this.loading = false;
    },
}
</script>
