<template>
    <div>
        <div v-if="loading">
            <h1>Data is loading ... </h1>
        </div>
        <div v-else>
            <div class="row" v-for="row in rows" :key="'row' + row">
                <div class="col d-flex align-items-stretch p-1" v-for="(bookable, column) in bookablesInRow(row)" :key="'row' + row + column">
                    <bookable-list-item v-bind="bookable"></bookable-list-item>
                </div>
                <div class="col p-1" v-for="p in placehodersInRow(row)" :key="'placeholder' + p + row"></div>
            </div>
        </div>
    </div>
</template>




<script>
import BookableListItem  from './BookableListItem'

export default {
    components: {
        BookableListItem
    },
    data() {
        return {
            bookables: null,
            loading: false,
            columns: 3,
        };
    },
    computed: {
        rows() {
            return this.bookables === null ? 0 : Math.ceil(this.bookables.length / this.columns);
        }
    },
    methods: {
        bookablesInRow(row) {
            return this.bookables.slice((row - 1) * this.columns, row * this.columns);
        },
        placehodersInRow(row) {
            return this.columns - this.bookablesInRow(row).length;
        }
    },
    created(){
        this.loading = true;
        const request = axios
        .get("/api/bookables")
        .then(response => {
            this.bookables = response.data.data;
            this.loading = false;
        });

    },

}
</script>