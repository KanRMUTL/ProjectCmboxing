<template>
    <div>
      <h3 align="center">My Ticket</h3>
      <table class="table table-hover">
        <thead>
          <tr class="bg-info text-white">
            <th>Visit Day</th>
            <th>Detail</th>
            <th>Created</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="(ticketDetail,index) in ticketDetails"
            :class="{'table-info': index % 2 == 0}"
          >
            <td>{{ ticketDetail.visit | formatDate }}</td>
            <td>
              <span class="badge badge-primary" v-for="detail in ticketDetail.detail">
                {{ detail.amount + " * " + detail.name }}
              </span>
            </td>
            
            <td>{{ ticketDetail.created_at | formatDate }}</td>
            <td>
              <span class="badge badge-secondary" v-if="!ticketDetail.status">Expire</span>
              <span class="badge badge-success" v-if="ticketDetail.status">Active</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</template>

<script>
export default {
    props: ['id'],

    mounted() {
        this.getAllTicket();
    },

    data() {
        return {
            tickets: [],
            ticketDetails: []
        }
    },

    methods: {
        getAllTicket() {
            axios.get('/api/booking/' + this.id)
            .then(
                res => {
                    this.tickets = res.data.tickets
                    this.ticketDetails = res.data.ticketDetails
                }
            )
        }
    },

    filters: {
      formatDate(value) {
        let current_datetime = new Date(value)
        let formatted_date = current_datetime.getDate() + "/" + (current_datetime.getMonth() + 1) + "/" + current_datetime.getFullYear()
        return formatted_date
      }
  }
}
</script>

<style>
  .badge {
    margin-right: 5px;
    font-size: 100%;
  }
</style>