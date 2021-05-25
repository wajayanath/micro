import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Layout from '../pages/Layout.vue'
import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/Register.vue'

const routes: Array<RouteRecordRaw> = [
    {path: '/login', component: Login},
    {path: '/register', component: Register},
  {
    path: '/',
    component: Layout,
      children: [
          { path: '', component: Home }
      ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
