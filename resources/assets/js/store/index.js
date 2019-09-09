import Vuex from 'vuex'
import Vue from 'vue'
import shopping from './modules/shopping'
import ticketOnline from './modules/ticketOnline'
import fight from './modules/fight'

Vue.use(Vuex)
const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
    modules: {
        shopping,
        ticketOnline,
        fight
    },
    strict: debug
})