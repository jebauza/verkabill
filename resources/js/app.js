require('./bootstrap');
window.Vue = require('vue').default;


import store from './store';
import router from './router';

// SweetAlert2 - Biblioteca para ventanas emergentes
import Swal from 'sweetalert2';
window.Swal = Swal;

// ElementUI - Biblioteca para interfaz de usuario
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en';
Vue.use(ElementUI, { locale });

// Vuesax - Biblioteca para interfaz de usuario
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
Vue.use(Vuesax, {
    // options here
});

// EventBus - Biblioteca para la comunicación entre componentes
export const EventBus = new Vue();
window.EventBus = EventBus;


// Components
Vue.component('App', require('./views/App').default);


if (localStorage.getItem('access_token')) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
}

const app = new Vue({
    el: '#app',
    router,
    store
});
