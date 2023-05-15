<template>
    <div class="fallback-loading" :style="{ height: height + 'px' }">
        <Vue3Lottie class="spinner" ref="anim" :loop="true"
            :animationData="require('/storage/uploads/loading.json')" />
    </div>
</template>

<script>
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'

export default {
    name: 'Fallback',
    components: { Vue3Lottie },
    props: {
        height: {
            type: Number,
            default: '10px',
        },
    },

}
</script>
