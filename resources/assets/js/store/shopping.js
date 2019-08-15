const state = {
     confirmCheckout : false
}
const mutations = {
     confirmCheckout: (state, payload) => {  
          state.confirmCheckout = payload
     }
}
const actions = {
     setConfirmCheckout: ({commit}, payload) => commit('confirmCheckout', payload)
}
const getters = {
     getConfirmCheckout: (state) => state.confirmCheckout
}

export default {
     state,
     mutations,
     actions,
     getters
}