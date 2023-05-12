<template>
    <v-container class="nav-bar">
     <v-row class="navbar">
            <v-col class="nav-item" v-for="(item, index) in menu" :key="index">
                <router-link :to="{ name: item.path.name }" class="nav-link">{{ item.title }}</router-link>
            </v-col>
    </v-row>
    </v-container>
</template>


<script>
export default {
    name: 'NavDesktop',
    data() {
        return {
            selected: null,
            modalOpen: null,
            menu: [
                {
                    id: 1,
                    icon: "mdi mdi-home",
                    title: "Home",
                    path: { name: "home" },
                },
                {
                    id: 2,
                    icon: "mdi mdi-car-select",
                    title: "Products",
                    path: { name: "products" },
                },
                {
                    id: 3,
                    icon: "mdi mdi-magnify",
                    title: "Search",
                    path: { name: "register" },
                },
                {
                    id: 4,
                    icon: "mdi mdi-cart-outline",
                    title: "Basket",
                    path: { name: "basket" },
                },
                {
                    id: 5,
                    icon: "mdi mdi-account-arrow-right-outline",
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
}
</script>
