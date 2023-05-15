<template>
    <Transition name="fade">
    <div class="loader">
        <Vue3Lottie class="spinner" ref="anim" :loop="true"
            :animationData="require('/storage/uploads/loading.json')" />
    </div>
    </Transition>
</template>
<script>
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'

export default {
    name: 'Loader',
    components: { Vue3Lottie },
}
</script>
