<template>
    <nav class="navbar navbar-expand-lg bg-white border-bottom navbar-light">
        <router-link class="navbar-brand mr-auto" :to="{ name: 'home' }">Bookings</router-link>
        <ul class="navbar-nav">
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'basket' }">
                    Basket
                    <span v-if="itemsInBasket" class="badge badge-secondary">{{
                        itemsInBasket
                    }}</span>
                </router-link>
            </li>

            <li class="nav-item" v-if="!isLoggedIn">
                <router-link :to="{ name: 'register' }" class="nav-link">Register</router-link>
            </li>

            <li class="nav-item" v-if="!isLoggedIn">
                <router-link :to="{ name: 'login' }" class="nav-link">Sign-in</router-link>
            </li>

            <li class="nav-item" v-if="isLoggedIn">
                <a class="nav-link" href="#" @click.prevent="logout">Logout</a>
            </li>
        </ul>
    </nav>
</template>


<script>
export default {
    name: 'NavDesktop',
    data() {
        return {
        }
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
