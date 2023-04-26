import VueRouter from "vue-router";
import Basket from './basket/Basket';
import Products from "./layout/Products";
import Bookable from "./bookable/Bookable";
import Review from "./review/Review";
import Homepage from "./layout/Homepage";

const routes = [
    {
        path: "/",
        component: Homepage,
        name: "home",
    },
    {
        path: "/cars",
        component: Products,
        name: "products",
    },
    {
        path: "/car/:id",
        component: Bookable,
        name: "bookable",
    },
    {
        path: "/review/:id",
        component: Review,
        name: "review",
    },
    {
        path: "/basket",
        component: Basket,
        name: "basket",
    },
    {
        path: "/auth/login",
        component: require("./auth/Login").default,
        name: "login",
    },
    {
        path: "/auth/register",
        component: require("./auth/Register").default,
        name: "register",
    }

];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;
