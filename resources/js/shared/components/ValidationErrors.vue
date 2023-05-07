<template>
    <div>
        <v-alert
            v-for="(error, index) in errors"
            variant="outlined"
            type="warning"
            prominent
            border="top"
            density="compact"
            :key="key(index)"
        >
            {{ error }}
        </v-alert>
    </div>
</template>

<script>
export default {
    props: ["errors"],
    methods: {
        key(index) {
            return `validation_error_${index}_${Math.random()}`;
        },
    },
};
</script>


<style scoped>
.invalid-feedback {
    display: block;
}
</style>
