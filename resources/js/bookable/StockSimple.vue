<template>
    <div class="stock-simple" v-if="!loadingData">
        <h6 class="text-uppercase text-secondary font-weigh-bolder pt-6">
            Perioadă închiriere
        </h6>
        <transition name="fadeHeight">
        <div class="booking_selector rounded p-2">
            <div class="booking_icon_actions">
                <span class="icon_collapse"><i class="fa fa-calendar-alt"></i></span>
            </div>
            <div>
                <label for="fromDate">Ridicare la Data și Ora</label>
                <date-picker name="fromDate" class="custom-date-time-picker mb-2" width="300" v-model="fromDate" type="date"
                    valueType="format" time-title-format="DD-MM-YYYY" @keyup.enter="check"
                    :class="[{ 'is-invalid': errorFor('fromDate') }]" :disabled-date="notBeforeToday"></date-picker>
                <date-picker name="fromTime" class="custom-date-time-picker" v-model="fromTime" type="time"
                    valueType="format" :time-picker-options="{
                        start: '00:00',
                        step: '00:30',
                        end: '23:30',
                        format: 'HH:mm',
                    }" time-title-format="HH:mm" @keyup.enter="check" :class="[{ 'is-invalid': errorFor('fromTime') }]"
                    :disabled-date="notBeforeToday"></date-picker>
            </div>
            <div>
                <label for="to">Returnare la Data și Ora</label>
                <date-picker name="to" class="custom-date-time-picker mb-2" v-model="toDate" type="date" valueType="format"
                    time-title-format="DD-MM-YYYY" :disabled-date="notBeforeDayBooked" holder="End Date"
                    @keyup.enter="check" :class="[{ 'is-invalid': errorFor('toDate') }]"></date-picker>
                <date-picker name="to" class="custom-date-time-picker" v-model="toTime" type="time" valueType="format"
                    :time-picker-options="{
                        start: '00:00',
                        step: '00:30',
                        end: '23:30',
                        format: 'HH:mm',
                    }" time-title-format="HH:mm" :disabled-date="notBeforeDayBooked" holder="End Date"
                    @keyup.enter="check" :class="[{ 'is-invalid': errorFor('toTime') }]"></date-picker>
            </div>
        </div>
        </transition>
        <v-errors class="text-center" :errors="errorFor('fromDate')" />
        <v-errors class="text-center" :errors="errorFor('fromTime')" />
        <v-errors class="text-center" :errors="errorFor('toDate')" />
        <v-errors class="text-center" :errors="errorFor('toTime')" />

        <h6 class="text-uppercase text-secondary font-weigh-bolder pt-3">
            Ridicare & Returnare
        </h6>

        <transition name="fadeHeight">
            <div class="booking_selector rounded p-2">
                <div class="booking_icon_actions">
                    <span class="icon_collapse"><i class="fa fa-map-pin"></i></span>
                </div>
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

        <div class="booking_details mt-2">
            <div class="">
                De la <span class="data_pickup">{{ from | dateformating }}</span> până
                la
                <span class="data_pickup">{{ to | dateformating }}</span>
            </div>
            <div class="booking_form_actions">
                De la:
                <span class="data_pickup">{{ pickupAndReturnText(pickup) }}</span>
                la:
                <span class="data_pickup">{{ pickupAndReturnText(retour) }}</span>
            </div>
        </div>

        <div class="form-row mt-4">
            <button @click="check" class="btn btn-secondary btn-block" :disabled="loading">
                <span v-if="!loading">Check</span>
                <span v-if="loading"><i class="fas fa-circle-notch fa-spin"></i> Checking...</span>
            </button>
        </div>

        <h6 class="text-uppercase text-secondary font-weigh-bolder text-center mt-2">
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
    border: solid 1px rgb(145, 16, 16);
    border-radius: 5px;
}
</style>

<script>
import { is422 } from "./../shared/utils/response";
import validationErrors from "./../shared/mixins/validationErrors";
import BookableService from "./../services/bookableService";

export default {
    mixins: [validationErrors],
    props: {
        bookableId: [String, Number],
    },
    data() {
        return {
            fromDate: this.$store.state.lastSearch.fromDate || null,
            fromTime: this.$store.state.lastSearch.fromTime || null,
            toTime: this.$store.state.lastSearch.toTime || null,
            toDate: this.$store.state.lastSearch.toDate || null,
            pickup: this.$store.state.lastSearch.pickup || null,
            retour: this.$store.state.lastSearch.retour || null,
            loading: false,
            loadingData: true,
            status: null,
            pickupAndReturnPoints: null,
        };
    },
    created() {
        this.loadingData = true;
        BookableService.getPickupAndReturnOptions().then((response) => (this.pickupAndReturnPoints = response.data.data)).then(() => (this.loadingData = false));
    },
    methods: {
        async check() {
            this.loading = true;
            this.errors = null;

            this.$store.dispatch("setLastSearch", {
                fromDate: this.fromDate,
                fromTime: this.fromTime,
                toDate: this.toDate,
                toTime: this.toTime,
                pickup: this.pickup,
                retour: this.retour,
            });

            try {
                let checker = await BookableService.getStockStatus(this.bookableId, this.fromDate, this.fromTime, this.toDate, this.toTime);
                this.status = checker.status;
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
            return date < new Date(this.fromDate);
        },
        pickupAndReturnText(id) {
            if (this.pickup) {
                return this.pickupAndReturnPoints.find((item) => item.id == id).name;
            }
        }
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
        to() {
            return this.toDate + ' ' + this.toTime;
        },
        from() {
            return this.fromDate + ' ' + this.fromTime;
        },
    },
    watch: {
        fromDate() {
            this.check();
        },
        fromTime() {
            this.check();
        },
        toTime() {
            this.check();
        },
        toDate() {
            this.check();
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
