require('./bootstrap');
window.Vue = require('vue').default;


/* Components */
Vue.component('login', require('./views/auth/login').default);
Vue.component('app', require('./views/App').default);



import store from './store';
import router from './router';



if (localStorage.getItem('access_token')) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
}

const app = new Vue({
    el: '#app',
    router,
    store
});