<template>
    <nav class="navbar-mobile">
        <div class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'home' }">
                    <img class="nav-icon"
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2012/240/iconmonstr-home-7.png" />
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'products' }">
                    <img class="nav-icon"
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2016/240/iconmonstr-car-2.png" />
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'register' }">
                    <img class="nav-icon"
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2012/240/iconmonstr-magnifier-6.png" />
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'basket' }">
                         <img class="nav-icon"
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2013/240/iconmonstr-shopping-cart-2.png" />
                        <span v-if="itemsInBasket" class="badge badge-secondary">{{
                            itemsInBasket
                        }}</span>
                    </router-link>
                </li>

                <li class="nav-item" v-if="!isLoggedIn">
                    <router-link :to="{ name: 'login' }" class="nav-link">
                        <img class="nav-icon"
                            src="https://cdns.iconmonstr.com/wp-content/releases/preview/2012/240/iconmonstr-user-6.png" />
                    </router-link>
                </li>

                <li class="nav-item" v-if="isLoggedIn">
                    <a class="nav-link" href="#" @click.prevent="logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</template>


<script>
export default {
    name: 'NavMobile',
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
