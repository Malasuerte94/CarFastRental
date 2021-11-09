<template>
  <div>
    <h6 class="text-uppercase text-secondary font-weigh-bolder">
      Check Stock
      <transition>
        <span v-if="noStock" class="text-danger">[Not in stock!]</span>
      </transition>
      <transition>
        <span v-if="hasStock" class="text-success">[Available]</span>
      </transition>
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
        <span
          @click="
            collapseDateSelector.booking_date =
              !collapseDateSelector.booking_date
          "
          :class="[{ 'arrow-down': collapseDateSelector.booking_date }]"
          class="button_collapse"
          ><i class="fa fa-arrow-down"></i
        ></span>
      </div>
    </div>

    <transition name="fade">
      <div
        v-if="collapseDateSelector.booking_date"
        class="row booking_selector m-2 p-2"
      >
        <div class="row">
          <div class="form-group col-md-12">
            <label for="from">Ridicare la Data și Ora</label>
            <date-picker
              name="from"
              class="custom-date-time-picker"
              v-model="from"
              type="datetime"
              valueType="format"
              :time-picker-options="{
                start: '00:00',
                step: '00:30',
                end: '23:30',
                format: 'HH:mm',
              }"
              time-title-format="DD-MM-YYYY HH:mm"
              @keyup.enter="check"
              :class="[{ 'is-invalid': errorFor('from') }]"
              :disabled-date="notBeforeToday"
            ></date-picker>
            <v-errors :errors="errorFor('from')"></v-errors>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="to">Returnare la Data și Ora</label>
            <date-picker
              name="to"
              class="custom-date-time-picker"
              v-model="to"
              type="datetime"
              valueType="format"
              :time-picker-options="{
                start: '00:00',
                step: '00:30',
                end: '23:30',
                format: 'HH:mm',
              }"
              time-title-format="DD-MM-YYYY HH:mm"
              :disabled-date="notBeforeDayBooked"
              holder="End Date"
              @keyup.enter="check"
              :class="[{ 'is-invalid': errorFor('to') }]"
            ></date-picker>
            <v-errors :errors="errorFor('to')"></v-errors>
          </div>
        </div>
      </div>
    </transition>

    <div class="booking_selector booking_label">
      <div class="booking_icon_actions">
        <span class="icon_collapse"><i class="fa fa-map-pin"></i></span>
      </div>
      <div class="booking_form_actions">
        Pick up:
        <span class="data_pickup">{{ pickupAndReturnText(pickup) }}</span>
        Returnare:
        <span class="data_pickup">{{ pickupAndReturnText(retour) }}</span>
      </div>
      <div class="booking_form_dropdown">
        <span
          @click="
            collapseDateSelector.booking_address =
              !collapseDateSelector.booking_address
          "
          :class="[{ 'arrow-down': collapseDateSelector.booking_address }]"
          class="button_collapse"
          ><i class="fa fa-arrow-down"></i
        ></span>
      </div>
    </div>

    <transition name="fade">
      <div
        v-if="collapseDateSelector.booking_address"
        class="row booking_selector m-2 p-2"
      >
        <div class="row">
          <div class="form-group col-md-12">
            <label for="pickup">Ridicare la Data și Ora</label>
            <select name="pickup" class="form-control" v-model="pickup">
              <option
                v-for="option in pickupAndReturnPoints"
                v-bind:value="option.id"
                :key="option.id"
              >
                {{ option.name }}
              </option>
            </select>
            <v-errors :errors="errorFor('from')"></v-errors>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="return">Returnare la Data și Ora</label>
            <select name="return" class="form-control" v-model="retour">
              <option
                v-for="option in pickupAndReturnPoints"
                v-bind:value="option.id"
                :key="option.id"
              >
                {{ option.name }}
              </option>
            </select>
            <v-errors :errors="errorFor('to')"></v-errors>
          </div>
        </div>
      </div>
    </transition>

    <div class="form-row mt-4">
      <button
        class="btn btn-secondary btn-block"
        @click="check"
        :disabled="loading"
      >
        <span v-if="!loading">Check</span>
        <span v-if="loading"
          ><i class="fas fa-circle-notch fa-spin"></i> Checking...</span
        >
      </button>
    </div>
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
      from: this.$store.state.lastSearch.from || null,
      to: this.$store.state.lastSearch.to || null,
      pickup: this.$store.state.lastSearch.pickup || null,
      retour: this.$store.state.lastSearch.return || null,
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
      this.loading = true;
      this.errors = null;

      this.$store.dispatch("setLastSearch", {
        from: this.from,
        to: this.to,
        pickup: this.pickup,
        return: this.retour,
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
      if (this.pickup) {
        return this.pickupAndReturnPoints.find((item) => item.id == id).name;
      }
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
};
</script>