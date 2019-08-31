import Vuex from 'vuex'
import Vue from 'vue'
import shopping from './modules/shopping'
import ticketOnline from './modules/ticketOnline'

Vue.use(Vuex)
const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
    modules: {
        shopping,
        ticketOnline
    },
    strict: debug
})