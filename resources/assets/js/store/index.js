import Vuex from 'vuex'
import Vue from 'vue'
import shopping from './shopping'
Vue.use(Vuex)
const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
    modules: {
        shopping
    },
    strict: debug
})