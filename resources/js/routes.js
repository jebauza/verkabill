import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

// Pages
import NotFound from './components/layouts/NotFound';
import Login from './components/auth/Login';
import Logout from './components/auth/Logout';
import Dashboard from './components/dashboard/Dashboard';

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

// Routes
export const routes = [{
        path: '/login',
        name: 'login',
        component: Login,
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
];

export default new Router({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes
});
