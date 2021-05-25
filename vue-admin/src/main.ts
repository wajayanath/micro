 import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

axios.defaults.baseURL = 'http://admin.test/api/admin';
axios.defaults.headers['Authorization'] =  `Bearer ${localStorage.getItem('token')}`;

createApp(App).use(store).use(router).mount('#app')
