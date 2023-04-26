<template>
    <Transition name="fade">
    <div class="loader">
        <lottie-animation class="spinner" ref="anim" :loop="true"
            :animationData="require('/storage/uploads/car_loading.json')" />
    </div>
    </Transition>
</template>
<script>
import LottieAnimation from 'lottie-web-vue'
export default {
    name: 'Loader',
    components: { LottieAnimation },
}
</script>
