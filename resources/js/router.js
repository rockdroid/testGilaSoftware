import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Pages
import NotFound from './views/NotFound'
import Login from './views/Login'
import Logout from './views/Logout'
import Home from './views/Home'
import Dashboard from './views/Dashboard'
import productList from './components/products/List'
import newProduct from './components/products/New'
import register from './components/user/Register'

// Routes
const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                requiresVisitor: true,
            }
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout,
            meta: {
                requiresAuth: true,
            }
        },
        {
            name: 'productList',
            path: '/product',
            component: productList,
            meta: {
                requiresAuth: true,
            }
        },
        {
            name: 'register',
            path: '/register',
            component: register,
            meta: {
                requiresVisitor: true,
            }
        },
        {
            name: 'newProduct',
            path: '/add',
            component: newProduct,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/404',
            name: '404',
            component: NotFound,
        },
        {
            path: '*',
            redirect: '/404',
        },
    ],
});

export default router