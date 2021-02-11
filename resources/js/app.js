require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import VueRouter from 'vue-router';
import router from './router';
import Navbar from './components/Navbar.vue';
import VueResizeText from 'vue-resize-text';
import Loading from 'vue-loading-overlay';
import VModal from 'vue-js-modal';
import axios from 'axios';
import 'vue-loading-overlay/dist/vue-loading.css';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faChevronLeft, faHome, faSearch, faBell, faUser } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import './app.css';
import Button from './components/elements/Button.vue'

library.add(faChevronLeft, faHome, faSearch, faBell, faUser)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('Navbar', Navbar)
Vue.component('Loading', Loading)
Vue.component('btn', Button)

Vue.use(VueRouter)
Vue.use(VueResizeText)
Vue.use(VModal, { dialog: true })

axios.defaults.headers.common['Authentication'] = 'Bearer ' + localStorage.getItem('access_token');

const app = new Vue({
    el: '#app',
    router,
    components: {
        App, Navbar
    },
    created() {
        // console.log('new vue app');
    }
});