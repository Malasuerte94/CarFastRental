<template>
    <div v-if="loading">Loading...</div>
    <div v-else class="adjectives-row">
        <div
            class="adjective-single text-center"
            v-for="(adjective, index) in adjectives"
            :key="index"
        >
            <img
                class="rounded-circle m-auto"
                width="50px"
                height="50px"
                :src="adjective.adjective.icon"
            />
            <span>{{ adjective.adjective.name }} : {{ adjective.value }}</span>
        </div>
    </div>
</template>

<script>
import BookableService from "./../services/bookableService";
export default {
    props: {
        bookableId: [String, Number],
    },
    data() {
        return {
            loading: false,
            adjectives: null,
        };
    },
    async created() {
        this.loading = true;
        let response = await BookableService.getBookableAdjectives(
            this.bookableId
        );
        this.adjectives = response.data.data;
        this.loading = false;
    },
};
</script>
