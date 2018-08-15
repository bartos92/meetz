import Vue from 'vue'
import Vuex from "vuex";
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(Vuex);
Vue.use(VueAxios, axios);

export default new Vuex.Store({
    strict: true,
    state: {
        token: localStorage.getItem('token') != null ? localStorage.getItem('token') : false
    },
    actions: {
        login(context, payload) {
            $.post('/user/get-token', payload).then(function (response) {
                localStorage.setItem('token', response.token);
                context.commit('setToken', response.token);
            });
        }
    },
    mutations: {
        setToken(state, payload) {
            state.token = payload;
        }
    },
    getters: {
        authenticated: state => () => state.token !== false,
    },
    modules: {

    },
});
