<template>
     <v-row class="nav-bar">
       <v-col cols="auto">
         <img src="/storage/assets/logo.png" alt="" class="nav-logo">
       </v-col>
       <v-col cols="6">
         <v-row>
           <v-col class="nav-item" v-for="(item, index) in menu" :key="index">
             <router-link :to="{ name: item.path.name }" class="nav-link">{{ item.title }}</router-link>
           </v-col>
         </v-row>
       </v-col>
       <v-col cols="auto" class="header-action-buttons">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.029 13h2.971l-.266 1h-2.992l.287-1zm.863-3h2.812l.296-1h-2.821l-.287 1zm-.576 2h4.387l.297-1h-4.396l-.288 1zm-11.816 6c-.828 0-1.5.672-1.5 1.5 0 .829.672 1.5 1.5 1.5s1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm6.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm8-16.5l-.743 2h-1.929l-3.474 12h-11.239l-4.615-11h14.812l-2.541 9h2.102l3.432-12h4.195z"/></svg>
         <span class="divider-header"></span>
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z"/></svg>
       </v-col>
    </v-row>
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
