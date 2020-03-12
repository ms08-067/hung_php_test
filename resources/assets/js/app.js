import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
// import Hello from './views/Hello'
// import Home from './views/Home'


console.log("adasdas");
const app = new Vue({
    el: '#app',
    components: { App },
});