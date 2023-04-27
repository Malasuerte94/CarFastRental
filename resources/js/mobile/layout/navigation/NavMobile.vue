<template>
    <SwipeBottomNavigation class="navbar-mobile" :options="menu" v-model="selected">
        <template #icon="{ props }">
            <i :class="props.icon"></i>
        </template>
        <template #title="{ props }">
            <b>{{ props.title }}</b>
        </template>
    </SwipeBottomNavigation>
</template>

<script>
import { SwipeBottomNavigation } from "bottom-navigation-vue";
import "bottom-navigation-vue/dist/style.css";
export default {
    name: "NavMobile",
    components: {
        SwipeBottomNavigation,
    },
    data() {
        return {
            selected: null,
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
};
</script>
