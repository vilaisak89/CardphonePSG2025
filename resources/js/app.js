import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './Router';
import Menu from './Components/Menu.vue';
import Company from './Components/Company.vue';
import Deparment from './Components/Deparment.vue';
import Cardtype from './Components/Cardtype.vue';
import Cardprice from './Components/Cardprice.vue';
import Employee from './Components/Employee.vue';
import Pagination from './Components/Pagination.vue';

import { createPinia } from 'pinia';
const pinia = createPinia();

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Cleave from 'vue-cleave-component';

const app = createApp(App);
app.use(Cleave);
app.use(VueSweetalert2);
app.component('Employee', Employee);
app.component('Cardprice', Cardprice);
app.component('Cardtype', Cardtype);
app.component('Deparment', Deparment);
app.component('Company', Company);
app.component('Menu', Menu);
app.component('Pagination', Pagination);
app.use(router);
app.use(pinia);
app.mount('#app-vue');
