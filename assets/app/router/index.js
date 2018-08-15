import Vue from 'vue'
import Router from 'vue-router'
import List from '../components/content/List.vue'
import New from '../components/content/New.vue'
import Login from '../components/content/Login.vue'

Vue.use(Router);



export default new Router({
    routes: [
        {
            path: '/list',
            name: 'List',
            component: List
        },
        {
            path: '/new',
            name: 'New',
            component: New,
            meta: { requiresAuth: true },
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
    ]
})
