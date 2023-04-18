<template>
    <div class="container bookables-page" v-if="!loading">
        <div class="filters">
            <div>SUV</div>
            <div>Truck</div>
            <div>Van</div>
            <div>Car</div>
        </div>
        <div class="bookables-grid" v-for="row in rows" :key="'row' + row">
            <div class="bookable-card" v-for="(bookable, column) in bookablesInRow(row)" :key="'row' + row + column">
                <bookable-list-item v-bind="bookable"></bookable-list-item>
            </div>
            <div class="col p-1" v-for="p in placehodersInRow(row)" :key="'placeholder' + p + row"></div>
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
            loading: true,
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
    created() {
        let url = "/api/bookables"

        if (this.$route.query) {
            url = "/api/bookables/search"
        }

        axios
        .get(url, this.$route.query)
        .then(response => {
            this.bookables = response.data.data;
            this.loading = false;
        });

    },

}
</script>
