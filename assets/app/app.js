import Vue from 'vue'

import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.devtools = true;

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    if(requiresAuth) {
        if (store.getters.authenticated()) {
            next();
        } else {
            next('/login');
        }
    } else {
        next();
    }
});

new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App)
});
