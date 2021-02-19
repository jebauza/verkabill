import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';

// Pages
import Login from '../views/auth/Login';
import Register from '../views/auth/Register';
import Logout from '../views/auth/Logout';
import Dashboard from '../views/dashboard/Dashboard';
import NotFound from '../views/layouts/NotFound';

/* function accessVerification(to, from, next, permission) {
    const authUser = JSON.parse(sessionStorage.getItem('authUser'));
    if (authUser) {
        const userPermissions = JSON.parse(sessionStorage.getItem('listPermissionsByAuthUser'));
        if (userPermissions.includes(permission)) {
            next();
        } else {
            next(from.path != '/' ? from.path : '/home');
        }
    }
} */

/* const accessVerification = (to, from, next) => {
    if (store.getters.isAuthenticated && ['login', 'register'].includes(to.name)) {
        next('/dashboard');
    } else if (to.name !== 'login' && to.name !== 'register') {
        next('/login');
    } else {
        next();
    }
} */

const ifNotAuthenticated = (to, from, next) => {
    if (!store.getters.isAuthenticated) {
        next();
        return;
    }
    next('/');
}

const ifAuthenticated = (to, from, next) => {
    if (store.getters.isAuthenticated) {
        next();
        return;
    }
    next('/login');
}

// Routes
const routes = [{
        path: '/login',
        name: 'login',
        component: Login,
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/logout',
        name: 'logout',
        component: Logout,
        beforeEnter: ifAuthenticated
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: ifAuthenticated
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
];


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes
});