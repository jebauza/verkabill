require('./bootstrap');
window.Vue = require('vue').default;


import store from './store';
import router from './router';


/* Components */
Vue.component('App', require('./views/App').default);


if (localStorage.getItem('access_token')) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
}

const app = new Vue({
    el: '#app',
    router,
    store
});