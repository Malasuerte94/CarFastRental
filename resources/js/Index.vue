<template>
  <div class="page">
    <NavMobile :itemsInBasket="itemsInBasket" :isLoggedIn="isLoggedIn" v-if="$isMobile()" />
    <NavDesktop v-else />
    <router-view></router-view>
  </div>
</template>

<script>
import NavDesktop from './desktop/layout/navigation/NavDesktop.vue';
import NavMobile from './mobile/layout/navigation/NavMobile.vue';
import { mapState, mapGetters } from "vuex";

export default {
  components: { NavDesktop, NavMobile },
  data() {
    return {
      lastSearch: this.$store.state.lastSearch,
    };
  },
  computed: {
    ...mapState({
      lastSearchComputed: "lastSearch",
      isLoggedIn: "isLoggedIn",
    }),
    ...mapGetters({
      itemsInBasket: "itemsInBasket",
    }),
    },
  methods: {
    async logout() {
      try {
        axios.post("/logout");
        this.$store.dispatch("logout");
      } catch (error) {
        this.$store.dispatch("logout");
      }
    },
  },
};
</script>
