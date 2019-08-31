import ticket from '../../api/ticketOnline'

const state = {
     tickets: [],
     ticket: []
}

const mutations = {
     setTickets: (state, payload) => {
          state.tickets = payload
     },
     setTicketSelected: (state, payload) => {
          state.ticket = payload
     }
}

const actions = {
     setTickets: async ({commit},payload) => {
          const tickets =  await ticket.get(payload)
          await commit('setTickets', tickets.data)
     },
     setTicketSelected: ({commit}, payload) => {
          commit('setTicketSelected', payload)
     }
}

export default {
     namespaced: true,
     state,
     mutations,
     actions
}