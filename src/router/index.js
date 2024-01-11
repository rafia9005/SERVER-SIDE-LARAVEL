import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import Login from "../views/auth/Login.vue";
import Register from "../views/auth/Register.vue";
import DashboardView from "../views/DashboardView.vue";
import Logout from "../views/auth/Logout.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeView,
        },
        {
            path: "/login",
            name: "Login Front End",
            component: Login,
        },
        {
            path: "/register",
            name: "Register Front End",
            component: Register,
        },
        {
            path: "/logout",
            name: "Logout Front End",
            component: Logout,
        },
        {
            path: "/dashboard",
            name: "Dashboard Front End",
            component: DashboardView,
        },
    ],
});

router.beforeEach((to, from, next) => {
    document.title = to.name;
    next();
});

export default router;
