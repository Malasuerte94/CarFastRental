<template>
    <div class="stock-simple mb-8">
        <h4 v-if="searchOnly" class="pt-6 hidden">
            {{ settings.settings.home_search_title.value }}
        </h4>
        <h4 v-else>Perioadă închiriere</h4>
        <transition name="list">
            <v-card class="box-dates">
            <div
                class="booking_selector"
                :class="[{ 'search-only': searchOnly, 'flex-col': !searchOnly }]"
            >     <div class="mx-input-dates">
                    <v-select
                        v-model="pickup"
                        :items="pickupAndReturnPoints"
                        :rules="[v => !!v || 'Item is required']"
                        :item-value="v => v.id"
                        :item-title="v => v.name"
                        label="Punct Ridicare"
                        required
                    />
                  </div>
                  <div class="mx-input-dates">
                      <label class="mx-label" for="fromDate">Dată ridicare</label>
                      <date-picker
                          lang="ro"
                          placeholder="..."
                          name="fromDate"
                          class="custom-date-time-picker"
                          width="300"
                          v-model:value="fromDate"
                          type="date"
                          valueType="format"
                          title-format="dd, d MMM YYYY"
                          time-title-format="dd, d MMM YYYY"
                          @keyup.enter="check"
                          :class="[{ 'is-invalid': errorFor('fromDate') }]"
                          :disabled-date="notBeforeToday"
                          :append-to-body="false"
                      />
                  </div>
                  <div class="mx-input-dates">
                      <label class="mx-label" for="fromDate">Oră ridicare</label>
                        <date-picker
                            :append-to-body="false"
                            :show-second="false"
                            placeholder="..."
                            name="fromTime"
                            class="custom-date-time-picker"
                            v-model:value="fromTime"
                            type="time"
                            valueType="HH:mm:ss"
                            :time-picker-options="{
                                start: '00:00',
                                step: '00:30',
                                end: '23:30',
                                format: 'HH:mm',
                            }"
                            format="HH:mm"
                            time-title-format="HH:mm"
                            @keyup.enter="check"
                            :class="[{ 'is-invalid': errorFor('fromTime') }]"
                        />
                  </div>
              <div class="mx-input-dates">
                    <label class="mx-label" for="date-return">Dată returnare</label>
                    <date-picker
                        :append-to-body="false"
                        placeholder="..."
                        name="date-return"
                        class="custom-date-time-picker"
                        v-model:value="toDate"
                        type="date"
                        valueType="format"
                        time-title-format="DD-MM-YY"
                        :disabled-date="notBeforeDayBooked"
                        holder="End Date"
                        @keyup.enter="check"
                        :class="[{ 'is-invalid': errorFor('toDate') }]"
                    />
              </div>
              <div class="mx-input-dates">
                <label class="mx-label" for="time-return">Oră returnare</label>
                    <date-picker
                        :append-to-body="false"
                        valueType="HH:mm:ss"
                        placeholder="..."
                        name="time-return"
                        class="custom-date-time-picker"
                        v-model:value="toTime"
                        type="time"
                        :time-picker-options="{
                            start: '00:00',
                            step: '00:30',
                            end: '23:30',
                            format: 'HH:mm',
                        }"
                        format="HH:mm"
                        time-title-format="HH:mm"
                        holder="End Date"
                        @keyup.enter="check"
                        :class="[{ 'is-invalid': errorFor('toTime') }]"
                    />
              </div>
              <div class="mx-input-dates">
                <v-select
                    v-model="retour"
                    :items="pickupAndReturnPoints"
                    :rules="[v => !!v || 'Item is required']"
                    :item-value="v => v.id"
                    :item-title="v => v.name"
                    label="Punct Returnare"
                    required
                />
              </div>
              <template v-if="searchOnly">
                <div class="search-button" :class="[{ active: showSearchButton }]">
                  <v-btn class="special-search" @click="check" block :disabled="loading || !showSearchButton">
                    <span v-if="!loading">Caută...</span>
                    <span v-if="loading"
                    ><i class="fas fa-circle-notch fa-spin"></i>
                            Verificăm...</span
                    >
                  </v-btn>
                </div>
              </template>
            </div>
            </v-card>
        </transition>
        <v-errors class="text-center" :errors="errorFor('fromDate')" />
        <v-errors class="text-center" :errors="errorFor('fromTime')" />
        <v-errors class="text-center" :errors="errorFor('toDate')" />
        <v-errors class="text-center" :errors="errorFor('toTime')" />

        <template v-if="!searchOnly">
            <div class="booking_details mt-2">
                <div class="">
                    De la
                    <span class="data_pickup">{{ $formatDate(from) }}</span>
                    până la
                    <span class="data_pickup">{{ $formatDate(to) }}</span>
                </div>
                <div class="booking_form_actions">
                    De la:
                    <span class="data_pickup">{{
                        pickupAndReturnText(pickup)
                    }}</span>
                    la:
                    <span class="data_pickup">{{
                        pickupAndReturnText(retour)
                    }}</span>
                </div>
            </div>

            <div class="mt-4">
                <button
                    @click="check"
                    class="btn btn-secondary btn-block main-check-button"
                    :disabled="loading"
                >
                    <span v-if="!loading">Check</span>
                    <span v-if="loading"
                        ><i class="fas fa-circle-notch fa-spin"></i>
                        Checking...</span
                    >
                </button>
            </div>

            <h6
                class="text-uppercase text-secondary font-weigh-bolder text-center mt-2"
            >
                <transition>
                    <span v-if="noStock" class="text-danger"
                        >[Not in stock!]</span
                    >
                </transition>
                <transition>
                    <span v-if="hasStock" class="text-success"
                        >[Available]</span
                    >
                </transition>
            </h6>
        </template>
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
        searchOnly: {
            type: Boolean,
            default: false,
        },
    },
    async setup(props) {
        const response = await BookableService.getPickupAndReturnOptions();
        const pickupAndReturnPoints = response.data.data;
        return {
            pickupAndReturnPoints,
        };
    },
    data() {
        return {
            fromDate: this.$store.state.lastSearch.fromDate || null,
            fromTime: this.$store.state.lastSearch.fromTime || null,
            toTime: this.$store.state.lastSearch.toTime || null,
            toDate: this.$store.state.lastSearch.toDate || null,
            pickup: this.$store.state.lastSearch.pickup || null,
            retour: this.$store.state.lastSearch.retour || null,
            settings: this.$store.state.settings,
            loading: false,
            loadingData: true,
            status: null,
        };
    },
    methods: {
        async check() {
            this.$store.dispatch("setLastSearch", {
                fromDate: this.fromDate,
                fromTime: this.fromTime,
                toDate: this.toDate,
                toTime: this.toTime,
                pickup: this.pickup,
                retour: this.retour,
            });

            if (this.searchOnly && this.showSearchButton) {
                this.$router.push({
                    path: "cars",
                    query: {
                        fromDate: this.fromDate,
                        fromTime: this.fromTime,
                        toDate: this.toDate,
                        toTime: this.toTime,
                    },
                });
                return;
            }

            this.loading = true;
            this.errors = null;

            try {
                let checker = await BookableService.getStockStatus(
                    this.bookableId,
                    this.fromDate,
                    this.fromTime,
                    this.toDate,
                    this.toTime
                );
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
                return this.pickupAndReturnPoints.find((item) => item.id == id)
                    .name;
            }
        },
        searchOrCheck() {
            if (!this.searchOnly) {
                this.check();
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
            return this.toDate + " " + this.toTime;
        },
        from() {
            return this.fromDate + " " + this.fromTime;
        },
        showSearchButton() {
            return this.fromDate && this.fromTime && this.toDate && this.toTime;
        },
    },
    watch: {
        fromDate() {
            this.searchOrCheck();
        },
        fromTime() {
            this.searchOrCheck();
        },
        toTime() {
            this.searchOrCheck();
        },
        toDate() {
            this.searchOrCheck();
        },
        pickup() {
            this.searchOrCheck();
        },
        retour() {
            this.searchOrCheck();
        },
    },
};
</script>
