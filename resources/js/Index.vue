<template>
    <div class="page">
        <NavMobile
            :itemsInBasket="itemsInBasket"
            :isLoggedIn="isLoggedIn"
            v-if="$isMobile()"
        />
        <NavDesktop v-else />
        <router-view class="main-page" v-slot="{ Component }">
            <transition name="page-slide" mode="out-in">
                <component :is="Component" v-cloak />
            </transition>
        </router-view>
    </div>
</template>

<script>
import NavDesktop from "./desktop/layout/navigation/NavDesktop.vue";
import NavMobile from "./mobile/layout/navigation/NavMobile.vue";
import settingsService from "./services/settingsService";
import { mapState, mapGetters } from "vuex";
import axios from 'axios';

export default {
    name: "Index",
    components: { NavDesktop, NavMobile },
    data() {
        return {
            lastSearch: this.$store.state.lastSearch,
        };
    },
    computed: {
        ...mapState({
            isLoggedIn: "isLoggedIn",
        }),
        ...mapGetters({
            itemsInBasket: "itemsInBasket",
        }),
    },
    created() {
        this.getSettings();
    },
    methods: {
        async getSettings() {
            try {
                let extracted = await settingsService.getSettings();
                this.$store.dispatch("setSettings", {
                    settings: extracted.data.data,
                });
            } catch (error) {
                console.log(error);
            }
        },
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
