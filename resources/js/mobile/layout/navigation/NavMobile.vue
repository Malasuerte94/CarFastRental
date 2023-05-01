<template>
    <SwipeBottomNavigation
        @modalOpen="openModal($event)"
        class="navbar-mobile"
        :options="menu"
        v-model="selected"
    >
        <template #icon="{ props }">
            <i :class="props.icon"></i>
        </template>
        <template #title="{ props }">
            <b>{{ props.title }}</b>
        </template>
    </SwipeBottomNavigation>
    <transition v-if="openedModal" name="fade">
        <div class="overlay"></div>
    </transition>
    <transition name="page-slide">
        <Login v-if="openedModal == 'login'" />
    </transition>
</template>

<script>
import { SwipeBottomNavigation } from "vue-navigation-advanced";
import Login from "C:/wamp64/www/bookcar/resources/js/auth/Login";
import "vue-navigation-advanced/dist/style.css";
export default {
    name: "NavMobile",
    components: {
        SwipeBottomNavigation,
        Login,
    },
    data() {
        return {
            selected: null,
            modalOpen: null,
            menu: [
                {
                    id: 1,
                    icon: "fas fa-home",
                    title: "Home",
                    path: { name: "home" },
                },
                {
                    id: 2,
                    icon: "fas fa-car",
                    title: "Products",
                    path: { name: "products" },
                },
                {
                    id: 3,
                    icon: "fas fa-search",
                    title: "Search",
                    path: { name: "register" },
                },
                {
                    id: 4,
                    icon: "fas fa-shopping-cart",
                    title: "Basket",
                    path: { name: "basket" },
                },
                {
                    id: 5,
                    icon: "fas fa-user",
                    title: "Login",
                    path: { name: "login" },
                    modal: true,
                    modalName: "login",
                },
            ],
        };
    },
    props: {
        itemsInBasket: {
            type: Number,
            default: 0,
        },
        isLoggedIn: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        openModal(modalName) {
            if(!modalName) {
                this.modalOpen = null
                return
            }
            if(!this.menu.find((item) => item.modalName === modalName)) {
                throw new Error(`Modal with name ${modalName} not found`)
            }
            if(modalName == this.openedModal) {
                this.openedModal = this.selected = null
                return
            }
            this.modalOpen = modalName
        },
    },
    computed: {
        openedModal: {
            get() {
                return this.modalOpen
                    ? this.menu.find((item) => item.modalName === this.modalOpen)
                        ?.modalName
                    : null;
            },
            set(value) {
                this.modalOpen = Boolean(value);
            },
        },
    }
};
</script>
