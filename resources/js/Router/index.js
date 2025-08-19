import { createWebHistory, createRouter } from 'vue-router';

import Home from "../Pages/Home.vue";
import Cardplan from '../Pages/Cardplan.vue';
import Cardpurchases from '../Pages/Cardpurchases.vue'
import Setting from "../Pages/Setting.vue";
import Login from "../Pages/Login.vue";
import Register from "../Pages/Register.vue";
import { useStore } from "../Store/Auth";

//create meddleware from = /login, to = /
const authMiddleware = (to, from, next) => {
    const token = localStorage.getItem('web_token');
    const user = localStorage.getItem('web_user');
    const store = useStore();

    if (token){
        // If have token in localstorage save to pinia
        store.set_token(token);
        store.set_user(user);
        next();
    } else {
        // If don't have token
        next({
            path:'/login',
            replace: true
        })
    }
}

export const routes = [
    {
        path:'/',
        redirect:'/home',
    },
    {
        name: 'home',
        path: '/home',
        component: Home,
        meta:{
            middleware: [authMiddleware]
        }
    },
    {
        name: 'cardplan',
        path: '/cardplan',
        component: Cardplan,
        meta:{
            middleware: [authMiddleware]
        }
    },
    {
        name: 'cardpurchases',
        path: '/cardpurchases',
        component: Cardpurchases,
        meta:{
            middleware: [authMiddleware]
        }
    },
    {
        name: 'setting',
        path: '/setting',
        component: Setting,
        meta:{
            middleware: [authMiddleware]
        }
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior () {
        window.scrollTo(0,0)
    }
});

router.beforeEach((to,from,next)=>{  
    const token = localStorage.getItem('web_token');
    if(to.meta.middleware){
        to.meta.middleware.forEach(middleware=>middleware(to,from,next))
    } else {
        if(to.path == '/login' || to.path == '/'){
            if(token){
                next({
                    path:'/home',
                    replace: true
                })
            } else {
                next();
            }
        } else {
            next();
        }
    }
});

export default router;