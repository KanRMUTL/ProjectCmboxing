<template>
  <div>

    <div class="row justify-content-center pt-5 mt-5">
      <div class="col-md-12 heading-section ftco-animate text-center fadeInUp ftco-animated">
        <h2 class="mb-4">Our Muay Thai Course</h2>
      </div>
    </div>

    <table class="table">
      <thead class="thead-primary">
        <tr class="text-center">
          <th>Visit Day</th>
          <th>Detail</th>
          <th>Created</th>
          <th>Status</th>
          <th>View</th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="text-center bg-overay"
          v-for="(ticketDetail, index) in ticketDetails"
          :key="index"
          @click="sendDataToTicketDetail(ticketDetail)"
          data-toggle="modal"
          data-target="#ticket-detail-modal"
        >
          <td>
            <span class="trainer">{{ ticketDetail.visit | formatDate }}</span>
          </td>
          <td>
            <span class="trainer">
              <span
                class="badge badge-primary"
                v-for="(detail, index) in ticketDetail.detail"
                :key="index"
              >
                {{ detail.amount + " * " + detail.name }}
              </span>
            </span>
          </td>

          <td>
            <span class="trainer">{{ ticketDetail.created_at | formatDate }}</span>
          </td>
          <td>
            <span class="trainer">
            <span
              class="badge badge-secondary"
              v-if="!ticketDetail.status"
            >Expire</span>
            <span
              class="badge badge-success"
              v-if="ticketDetail.status"
            >Active</span>
            </span>
          </td>
          <td class="text-center">
            <span class="trainer">
            <button class="btn btn-warning btn-sm"><i class="icon icon-search"></i></button>
            </span>
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