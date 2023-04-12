<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weigh-bolder pt-6">
            Perioadă închiriere
        </h6>
        <div class="booking_selector booking_label">
            <div class="booking_icon_actions">
                <span class="icon_collapse"><i class="fa fa-calendar-alt"></i></span>
            </div>
            <div class="booking_form_actions">
                De la <span class="data_pickup">{{ from | dateformating }}</span> până
                la
                <span class="data_pickup">{{ to | dateformating }}</span>
            </div>
            <div class="booking_form_dropdown">
                <span @click="
                    collapseDateSelector.booking_date =
                    !collapseDateSelector.booking_date
                " :class="[{ 'arrow-down': collapseDateSelector.booking_date }]" class="button_collapse"><i
                        class="fa fa-arrow-down"></i></span>
            </div>
        </div>

        <transition name="fadeHeight">
            <div v-if="collapseDateSelector.booking_date" class="booking_selector m-2 p-2">
                <div>

                        <label for="fromDate">Ridicare la Data și Ora</label>
                        <date-picker name="fromDate" class="custom-date-time-picker mb-2" v-model="fromDate" type="date"
                            valueType="format" time-title-format="DD-MM-YYYY" @keyup.enter="check"
                            :class="[{ 'is-invalid': errorFor('fromDate') }]" :disabled-date="notBeforeToday"></date-picker>
                        <date-picker name="fromTime" class="custom-date-time-picker" v-model="fromTime" type="time"
                            valueType="format" :time-picker-options="{
                                start: '00:00',
                                step: '00:30',
                                end: '23:30',
                                format: 'HH:mm',
                            }" time-title-format="HH:mm" @keyup.enter="check"
                            :class="[{ 'is-invalid': errorFor('fromTime') }]" :disabled-date="notBeforeToday"></date-picker>
                        <v-errors :errors="errorFor('fromTime')"></v-errors>

                </div>
                <div>
                        <label for="to">Returnare la Data și Ora</label>
                        <date-picker name="to" class="custom-date-time-picker mb-2" v-model="toDate" type="date"
                            valueType="format" time-title-format="DD-MM-YYYY" :disabled-date="notBeforeDayBooked" holder="End Date"
                            @keyup.enter="check" :class="[{ 'is-invalid': errorFor('to') }]"></date-picker>
                        <date-picker name="to" class="custom-date-time-picker" v-model="toTime" type="time"
                            valueType="format" :time-picker-options="{
                                start: '00:00',
                                step: '00:30',
                                end: '23:30',
                                format: 'HH:mm',
                            }" time-title-format="HH:mm" :disabled-date="notBeforeDayBooked" holder="End Date"
                            @keyup.enter="check" :class="[{ 'is-invalid': errorFor('to') }]"></date-picker>
                        <v-errors :errors="errorFor('to')"></v-errors>
                </div>
            </div>
        </transition>

        <h6 class="text-uppercase text-secondary font-weigh-bolder pt-3">
            Ridicare & Returnare
        </h6>
        <div class="booking_selector booking_label">
            <div class="booking_icon_actions">
                <span class="icon_collapse"><i class="fa fa-map-pin"></i></span>
            </div>
            <div class="booking_form_actions">
                De la:
                <span class="data_pickup">{{ pickupAndReturnText(pickup) }}</span>
                la:
                <span class="data_pickup">{{ pickupAndReturnText(retour) }}</span>
            </div>
            <div class="booking_form_dropdown">
                <span @click="
                    collapseDateSelector.booking_address =
                    !collapseDateSelector.booking_address
                " :class="[{ 'arrow-down': collapseDateSelector.booking_address }]" class="button_collapse"><i
                        class="fa fa-arrow-down"></i></span>
            </div>
        </div>

        <transition name="fadeHeight">
            <div v-if="collapseDateSelector.booking_address" class="booking_selector m-2 p-2">

                    <div>
                       <label for="pickup">Ridicare la Data și Ora</label>
                        <select name="pickup" class="form-control" v-model="pickup">
                            <option v-for="option in pickupAndReturnPoints" v-bind:value="option.id" :key="option.id">
                                {{ option.name }}
                            </option>
                        </select>
                    </div>


                    <div>
                        <label for="retour">Returnare la Data și Ora</label>
                        <select name="retour" class="form-control" v-model="retour">
                            <option v-for="option in pickupAndReturnPoints" v-bind:value="option.id" :key="option.id">
                                {{ option.name }}
                            </option>
                        </select>
                    </div>

            </div>
        </transition>

        <div class="form-row mt-4">
            <button class="btn btn-secondary btn-block" :disabled="loading">
                <span v-if="!loading">Check</span>
                <span v-if="loading"><i class="fas fa-circle-notch fa-spin"></i> Checking...</span>
            </button>
        </div>
        <h6 class="text-uppercase text-secondary font-weigh-bolder">
            <transition>
                <span v-if="noStock" class="text-danger">[Not in stock!]</span>
            </transition>
            <transition>
                <span v-if="hasStock" class="text-success">[Available]</span>
            </transition>
        </h6>
    </div>
</template>

<style scoped>
label {
    font-size: 0.7rem;
    text-transform: uppercase;
    font-weight: bolder;
}

.is-invalid {
    border-color: brown;
    background-image: none;
}
</style>

<script>
import { is422 } from "./../shared/utils/response";
import validationErrors from "./../shared/mixins/validationErrors";

export default {
    mixins: [validationErrors],
    props: {
        bookableId: [String, Number],
    },
    data() {
        return {
            fromDate: null,
            fromTime: null,
            toTime: null,
            toDate: null,
            from: this.$store.state.lastSearch.from || null,
            to: this.$store.state.lastSearch.to || null,
            pickup: this.$store.state.lastSearch.pickup || null,
            retour: this.$store.state.lastSearch.retour || null,
            loading: false,
            status: null,
            collapseDateSelector: {
                booking_date: false,
                booking_address: false,
            },
            pickupAndReturnPoints: null,
        };
    },
    created() {
        this.loading = true;
        axios
            .get(`/api/pickup-and-return-points`)
            .then((response) => (this.pickupAndReturnPoints = response.data.data))
            .then(() => (this.loading = false));
    },
    methods: {
        async check() {
            //this.collapseDateSelector.booking_date = false;
            //this.collapseDateSelector.booking_address = false;
            this.loading = true;
            this.errors = null;

            this.$store.dispatch("setLastSearch", {
                from: this.from,
                to: this.to,
                pickup: this.pickup,
                retour: this.retour,
            });

            try {
                this.status = (
                    await axios.get(
                        `/api/bookables/${this.bookableId}/stock?from=${this.from}&to=${this.to}`
                    )
                ).status;
                this.$emit("stock", this.hasStock);
            } catch (err) {
                if (is422(err)) {
                    this.errors = err.response.data.errors;
                }
                this.status = err.response.status;
                this.$emit("stock", this.hasStock);
            }

            this.loading = false;
        },
        notBeforeToday(date) {
            return date < new Date();
        },
        notBeforeDayBooked(date) {
            return date < new Date(this.from);
        },
        pickupAndReturnText(id) {
            if (this.pickup && !this.loading) {
                return this.pickupAndReturnPoints.find((item) => item.id == id).name;
            }
        },
        setDatePickup() {
            this.from = this.fromDate + ' ' + this.fromTime;
            this.check();
        },
    },
    computed: {
        hasErrors() {
            return 422 === this.status && this.errors !== null;
        },
        hasStock() {
            return 200 === this.status;
        },
        noStock() {
            return 404 === this.status;
        },
    },
    watch: {
        fromDate() {
            this.setDatePickup();
        },
        fromTime() {
            this.setDatePickup();
        },
        toTime() {
            this.setDatePickup();
        },
        toDate() {
            this.setDatePickup();
        },
        pickup() {
            this.check();
        },
        retour() {
            this.check();
        },
    },
};
</script>
