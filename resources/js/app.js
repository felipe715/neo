require('./bootstrap');
import HomePage from "../js/pages/HomePage";
import {router} from "./routes.js";
import VueTheMask from 'vue-the-mask';

window.Vue = require('vue');
window.Vue.use(VueTheMask);

const app = new Vue({
    el: '#app',
    router,
    components:{
        HomePage,
    }
});
