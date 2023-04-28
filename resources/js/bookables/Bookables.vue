<template>
    <div class="container bookables-page">
        <Filters />
        <transition-group name="list" tag="div">
        <div class="bookables-grid" v-for="row in rows" :key="'row' + row">
            <div class="bookable-card" v-for="(bookable, column) in bookablesInRow(row)" :key="'row' + row + column">
                <bookable-list-item v-bind="bookable"></bookable-list-item>
            </div>
            <div class="col p-1" v-for="p in placehodersInRow(row)" :key="'placeholder' + p + row"></div>
        </div>
        </transition-group>
    </div>
</template>

<script>
import BookableListItem  from './BookableListItem'
import Filters from './Filters'
import BookableService from "./../services/bookableService";

export default {
    components: {
        BookableListItem,
        Filters,
    },
    data() {
        return {
            bookables: null,
            columns: 3,
        };
    },
    async created() {
        let url = "/api/bookables"
        if (this.$route.query) {
            url = "/api/bookables/search"
        }
        let bookablesExtracted = await BookableService.getBookables(url, this.$route.query);
        this.bookables = bookablesExtracted.data.data
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
    }
}
</script>
