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
            v-for="(ticketDetail, index) in ticketDetails"
            :class="{'table-info': index % 2 == 0}"
            :key="index"
            @click="sendDataToTicketDetail(ticketDetail)"
            data-toggle="modal" 
            data-target="#ticket-detail-modal"
          >
            <td>{{ ticketDetail.visit | formatDate }}</td>
            <td>
              <span 
                class="badge badge-primary" 
                v-for="(detail, index) in ticketDetail.detail"
                :key="index"
              >
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

      <ticket-detail 
        :ticketDetail="ticketDetail" 
        :tickets="tickets"
        :seat="seat"
      />

    </div>
</template>

<script>
export default {
    props: ['id'],

    mounted() {
        this.getAllTicket();

        $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
})
    },

    data() {
        return {
            tickets: [],
            ticketDetails: [],
            ticketDetail:[],
            seat: {
                ringside: [],
                vip: []
            },
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
        },

        sendDataToTicketDetail(ticketDetail) {
          this.clearSeat()
          this.ticketDetail = ticketDetail;
          this.setDataToSeat(ticketDetail)
        },

        setDataToSeat(ticketDetail) {
            for(var key in ticketDetail.seat) {
                if(ticketDetail.seat[key].ticketId == 2) {
                    this.seat.ringside.push(ticketDetail.seat[key].seatName)
                }
                if(ticketDetail.seat[key].ticketId == 3) {
                    this.seat.vip.push(ticketDetail.seat[key].seatName)
                }
            }
        },

        clearSeat() {
          this.seat = {
                ringside: [],
                vip: []
            }
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