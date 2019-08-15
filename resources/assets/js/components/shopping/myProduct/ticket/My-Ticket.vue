<template>
  <div>

    <div class="row title-bar" style="padding: 0;">
      <div class="col-md-12">
        <h1
          class="wow fadeInUp"
          style="visibility: visible; animation-name: fadeInUp; font-size: 200%;"
        >My Ticket</h1>
        <div class="heading-border"></div>
       
      </div>
    </div>

    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <th class="text-center">Visit Day</th>
          <th class="text-center">Detail</th>
          <th class="text-center">Created</th>
          <th class="text-center">Status</th>
          <th class="text-center">View</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(ticketDetail, index) in ticketDetails"
          :key="index"
          @click="sendDataToTicketDetail(ticketDetail)"
          data-toggle="modal"
          data-target="#ticket-detail-modal"
        >
          <td class="text-center">{{ ticketDetail.visit | formatDate }}</td>
          <td class="text-center">
            <span
              class="badge badge-primary"
              v-for="(detail, index) in ticketDetail.detail"
              :key="index"
            >
              {{ detail.amount + " * " + detail.name }}
            </span>
          </td>

          <td class="text-center">{{ ticketDetail.created_at | formatDate }}</td>
          <td class="text-center">
            <span
              class="badge badge-secondary"
              v-if="!ticketDetail.status"
            >Expire</span>
            <span
              class="badge badge-success"
              v-if="ticketDetail.status"
            >Active</span>
          </td>
          <td class="text-center">
            <button class="btn btn-warning btn-sm"><i class="fa fa-search"></i></button>
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
  props: ["id"],

  mounted() {
    this.getAllTicket();

    $("#myModal").on("shown.bs.modal", function() {
      $("#myInput").trigger("focus");
    });
  },

  data() {
    return {
      tickets: [],
      ticketDetails: [],
      ticketDetail: [],
      seat: {
        ringside: [],
        vip: []
      }
    };
  },

  methods: {
    getAllTicket() {
      axios.get("/api/booking/" + this.id).then(res => {
        this.tickets = res.data.tickets;
        this.ticketDetails = res.data.ticketDetails;
      });
    },

    sendDataToTicketDetail(ticketDetail) {
      this.clearSeat();
      this.ticketDetail = ticketDetail;
      this.setDataToSeat(ticketDetail);
    },

    setDataToSeat(ticketDetail) {
      for (var key in ticketDetail.seat) {
        if (ticketDetail.seat[key].ticketId == 2) {
          this.seat.ringside.push(ticketDetail.seat[key].seatName);
        }
        if (ticketDetail.seat[key].ticketId == 3) {
          this.seat.vip.push(ticketDetail.seat[key].seatName);
        }
      }
    },

    clearSeat() {
      this.seat = {
        ringside: [],
        vip: []
      };
    }
  },

  filters: {
    formatDate(value) {
      let current_datetime = new Date(value);
      let formatted_date =
        current_datetime.getDate() +
        "/" +
        (current_datetime.getMonth() + 1) +
        "/" +
        current_datetime.getFullYear();
      return formatted_date;
    }
  }
};
</script>

<style>
.badge {
  margin-right: 5px;
  font-size: 100%;
}
</style>