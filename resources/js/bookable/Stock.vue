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
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="from">From</label>
        <input
          type="date"
          name="from"
          class="form-control form-control-sm"
          placeholder="Start Date"
          v-model="from"
          @keyup.enter="check"
          :class="[{ 'is-invalid': errorFor('from') }]"
        />
        <v-errors :errors="errorFor('from')"></v-errors>
      </div>
      <div class="form-group col-md-6">
        <label for="to">To</label>
        <input
          type="date"
          name="to"
          class="form-control form-control-sm"
          placeholder="End Date"
          v-model="to"
          @keyup.enter="check"
          :class="[{ 'is-invalid': errorFor('to') }]"
        />
        <v-errors :errors="errorFor('to')"></v-errors>
      </div>
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
      loading: false,
      status: null,
    };
  },
  methods: {
    async check() {
      this.loading = true;
      this.errors = null;

      this.$store.dispatch("setLastSearch", {
        from: this.from,
        to: this.to,
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