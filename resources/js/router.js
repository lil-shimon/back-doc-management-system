import Vue from "vue";
import VueRouter from "vue-router";

import Documentlist from "./components/DocumentlistComponent.vue";
import Documentform from "./components/DocumentformComponent.vue";
import Setting from "./components/SettingComponent.vue";
import Documentpreview from "./components/DocumentpreviewComponent.vue";
import Login from "./components/Login.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/doc-list",
        component: Documentlist,
        name: "list",
        meta: { requiresAuth: true }
    },
    {
        path: "/create-doc",
        component: Documentform,
        name: "form",
        meta: { requiresAuth: true }
    },
    {
        path: "/setting",
        component: Setting,
        name: "setting",
        meta: { requiresAuth: true }
    },
    {
        path: "/preview",
        component: Documentpreview,
        name: "preview",
        meta: { requiresAuth: true }
    },
    { path: "/login", component: Login, name: "login" },
    { path: "/", component: Login, name: "login" }
];

const router = new VueRouter({
    mode: "history",
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!localStorage.getItem("jwt-token")) {
            next({
                name: "login",
                query: { redirect: to.fullPath }
            });
        } else {
            axios
                .post("/api/auth/me", res => {
                    this.state.user = res.data;
                    this.state.isLogin = true;
                })
                .catch(error => {
                    // axios.post("/api/auth/refresh");
                    next({ name: "login" });
                });
            next();
        }
    } else {
        next();
    }
});

export default router;
