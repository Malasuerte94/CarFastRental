<template>
  <div>
    <success v-if="success">Congratulations on your purchase!</success>
    <div class="row" v-else>
      <div class="col-md-8" v-if="itemsInBasket">
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="first_name">First names</label>
            <input
              v-model="customer.first_name"
              type="text"
              class="form-control"
              name="first_name"
              :class="[{ 'is-invalid': errorFor('customer.first_name') }]"
            />
          </div>
          <div class="col-md-6 form-group">
            <label for="last_name">Last name</label>
            <input
              v-model="customer.last_name"
              type="text"
              class="form-control"
              name="last_name"
              :class="[{ 'is-invalid': errorFor('customer.last_name') }]"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="email">Email</label>
            <input
              v-model="customer.email"
              type="text"
              class="form-control"
              name="email"
              :class="[{ 'is-invalid': errorFor('customer.email') }]"
            />
          </div>
          <div class="col-md-6 form-group">
            <label for="phone">Phone</label>
            <input
              v-model="customer.phone"
              type="phone"
              class="form-control"
              name="phone"
              :class="[{ 'is-invalid': errorFor('customer.phone') }]"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="street">Street</label>
            <input
              v-model="customer.street"
              type="text"
              class="form-control"
              name="street"
              :class="[{ 'is-invalid': errorFor('customer.street') }]"
            />
          </div>
          <div class="col-md-6 form-group">
            <label for="city">City</label>
            <input
              v-model="customer.city"
              type="text"
              class="form-control"
              name="city"
              :class="[{ 'is-invalid': errorFor('customer.city') }]"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="country">Country</label>
            <input
              v-model="customer.country"
              type="text"
              class="form-control"
              name="country"
              :class="[{ 'is-invalid': errorFor('customer.country') }]"
            />
          </div>
          <div class="col-md-4 form-group">
            <label for="state">State</label>
            <input
              v-model="customer.state"
              type="text"
              class="form-control"
              name="state"
              :class="[{ 'is-invalid': errorFor('customer.state') }]"
            />
          </div>
          <div class="col-md-2 form-group">
            <label for="zip">Zip</label>
            <input
              v-model="customer.zip"
              type="text"
              class="form-control"
              name="zip"
              :class="[{ 'is-invalid': errorFor('customer.zip') }]"
            />
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-md-12 form-group">
            <button
              type="submit"
              class="btn btn-lg btn-primary btn-block"
              @click.prevent="book"
              :disabled="loading"
            >
              Book now!
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-8" v-else>
        <div class="jumbotron jumbotron-fluid text-center">
          <h1>Empty</h1>
        </div>
      </div>

      <div class="col-md-4">
        <div class="d-flex justify-content-between">
          <h6 class="text-uppercase text-secondary font-weight-bolder">
            Your Cart
          </h6>
          <h6 class="badge badge-secondary text-uppercase">
            <span v-if="itemsInBasket"> Items {{ itemsInBasket }} </span>
            <span v-else>Empty</span>
          </h6>
        </div>

        <transition-group name="fade" tag="div">
          <div v-for="item in basket" :key="item.bookable.id">
            <div class="pt-2 pb-2 border-top d-flex justify-content-between">
              <span
                ><router-link
                  :to="{ name: 'bookable', params: { id: item.bookable.id } }"
                >
                  {{ item.bookable.title }}</router-link
                ></span
              >
              <span class="font-weight-bold"> ${{ item.price.total }} </span>
            </div>

            <div
                v-for="(extra, index) in item.price.extra[0]"
                :key="index"
                class="pt-2 pb-2 border-top border-bottom d-flex justify-content-between text-secondary"
                >
                <span>{{ extra.multiplier }} {{ extra.label }} x ${{ extra.value }}</span>
                <span>{{ extra.operation }} {{ extra.value_type }}{{ extra.total }}</span>
            </div>

            <div class="pt-2 pb-2 d-flex justify-content-between">
              <span>From {{ item.dates.from }}</span>
              <span>To {{ item.dates.to }}</span>
            </div>

            <div class="pt-2 pb-2 text-right">
              <button
                @click.prevent="
                  $store.dispatch('removeFromBasket', item.bookable.id)
                "
                class="btn btn-sm btn-outline-secondary"
              >
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </div>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import validationErrors from "./../shared/mixins/validationErrors";

export default {
  mixins: [validationErrors],
  data() {
    return {
      customer: {
        first_name: null,
        last_name: null,
        email: null,
        phone: null,
        street: null,
        city: null,
        country: null,
        state: null,
        zip: null,
      },
      loading: false,
      bookingAttempted: false,
    };
  },
  computed: {
    ...mapGetters(["itemsInBasket"]),
    ...mapState({
      basket: (state) => state.basket.items,
    }),
    success() {
      return !this.loading && 0 === this.itemsInBasket && this.bookingAttempted;
    },
  },
  methods: {
    async book() {
      this.loading = true;
      this.bookingAttempted = false;
      this.errors = null;
      try {
        await axios.post(`/api/checkout`, {
          customer: this.customer,
          bookings: this.basket.map((basketItem) => ({
            bookable_id: basketItem.bookable.id,
            from: basketItem.dates.from,
            to: basketItem.dates.to,
          })),
        });
        this.$store.dispatch("clearBasket");
      } catch (error) {
        this.errors = error.response && error.response.data.errors;
      }
      this.loading = false;
      this.bookingAttempted = true;
    },
  },
};
</script>

<style scoped>
h6.badge {
  font-size: 100%;
}
a {
  color: black;
}
</style>
