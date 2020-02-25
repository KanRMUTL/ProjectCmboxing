import repository from './repository'

const resource = "/saleTicketOnline"

export default {
     get:  async (data) => {
          // ?start=2018-08-19&end=2019-08-25'
          return await repository.get(`${resource}?start=${data.start}&end=${data.end}`)
     }
}