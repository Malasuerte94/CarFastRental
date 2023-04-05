<template>
  <div>
    <h6 class="text-uppercase text-secondary font-weigh-bolder">
      Price Breakdown
    </h6>
    <div
      v-for="(days, price) in price.breakdown"
      :key="price"
      class="pt-2 pb-2 border-top border-bottom d-flex justify-content-between"
    >
      <span>{{ days }} Days x ${{ price }}</span>
      <span>${{ days * price }}</span>
    </div>
    <div
      v-for="(extra, index) in extras"
      :key="index"
      class="pt-2 pb-2 border-top border-bottom d-flex justify-content-between"
    >
      <span>{{ extra.multiplier }} {{ extra.label }} x ${{ extra.value }}</span>
      <span>{{ extra.operation }} {{ extra.value_type }}{{ extra.total }}</span>
    </div>
    <div class="pt-2 font-weight-bolder d-flex justify-content-between">
      <span>Total</span>
      <span>${{ price.total }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    price: Object,
    },
  computed: {
    extras() {
      return this.price.extra[0];
    },
  },
};
</script>
