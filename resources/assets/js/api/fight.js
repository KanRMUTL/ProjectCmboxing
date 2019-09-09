import repository from './repository'

const resource = "/fight"

export default {
     get: async () => await repository.get(`${resource}`),
     store: async (data) => await repository.post(`${resource}`, data),
     show: async (id) => await repository.get((`${resource}/${id}`)),
     update: async (data, id) => await repository.patch((`${resource}/${id}`, data))

}