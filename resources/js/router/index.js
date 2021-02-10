import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';

// Pages
import NotFound from '../views/layouts/NotFound';
/* import Login from '../views/auth/Login';*/
import Logout from '../views/auth/Logout';
import Dashboard from '../views/dashboard/Dashboard';

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
const routes = [
    /* {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter: ifNotAuthenticated
        },*/
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



    /* {
        path: '/404',
        name: '404',
        component: NotFound,
    }, */
    {
        path: '*',
        // redirect: '/404',
        component: NotFound,
    },
];


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes
});