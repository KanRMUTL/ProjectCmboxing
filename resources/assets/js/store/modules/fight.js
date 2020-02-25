import fightApi from '../../api/fight'
const state = {
    fights: null,
    fight:null
}
const mutations = {
    setFights: (state, payload) => state.fights = payload
}
const actions = {
     setFights: async({commit}) => {
          var fights = await fightApi.get()
          commit('setFights', fights.data)
     }
}
const getters = {
     
}

export default {
     namespaced: true,
     state,
     mutations,
     actions,
     getters
}