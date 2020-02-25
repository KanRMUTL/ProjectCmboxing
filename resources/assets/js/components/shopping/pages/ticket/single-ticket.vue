<template>
  <div>
     <div class="row justify-content-center pt-5 mt-5">
      <div class="col-md-12 heading-section ftco-animate text-center fadeInUp ftco-animated">
        <h2 class="mb-4">Buy Ticket</h2>
      </div>
    </div>

    <div class="wrapper row">
      <div class="preview col-md-12 col-lg-6">
          <div class="tab-pane active">
            <img
              :src="'/shopping/img/ticket/' + ticket.img"
              style="width:100%"
            ></div>
      </div>

      <div class="col-md-12 col-lg-6">
        <h3 class="text-golden">{{ ticket.name }}</h3>
        <p class="">Thank you for buy ticket from our, please input date visited, quantity of ticket and confirm payment.</p>
        <h5>Price: <span>{{ moneyFormat(ticket.price) }} ฿</span></h5>

        <div class="col-md-12 col-lg-7 form-group">
          <label class="input-group-addon" for="date">Date of visit</label>
          <input
            type="date"
            id="date"
            :min="dateVisit"
            class="form-control"
            placeholder="Quantity"
            v-model="dateVisit"
            :disabled="getConfirmCheckout"
          >
        </div>
        <div class="col-md-12 col-lg-7 form-group">
          <label class="input-group-addon" for="quantity">Quantity</label>
          <input
            type="number"
            id="quantity"
            class="form-control"
            placeholder="Quantity"
            v-model="quantity"
            :disabled="getConfirmCheckout"
          >
        </div>
        <div class="col-md-12 col-lg-7 col-md-7 form-group">
          <div class="input-group-addon">Total</div>
          <input
            type="text"
            class="form-control"
            placeholder="Total"
            disabled
            :value="moneyFormat(showTotal)"
          >
        </div>

        <div class="col-md-12 col-lg-7 col-md-7 action">
          <div class="title-but">
            <paypal-button-ticket
              :total="ticket.price"
              :saveBooking="saveBooking"
            />
          </div>
        </div>

      </div>
    </div>

  </div>
</template>

<script>
import mixin from '../../../mixin'
import { mapGetters } from 'vuex' 
export default {
  mixins: [mixin],
  
  props: ["id", "title"],

  mounted() {
    this.showTicket();
  },

  data() {
    return {
      ticket: [],
      dateVisit: moment().format('YYYY-MM-DD'),
      quantity: 1,
      total: 0,
      saleDetail: {
        ticket: {
          ticketId: this.id,
          amount: 0,
          total: 0
        }
      }
    };
  },

  methods: {
    showTicket() {
      axios.get("/api/showTicket/" + this.id).then(res => {
        this.ticket = res.data.ticket;
        this.total = Number(this.ticket.price);
      });
    },

    saveBooking() {
      this.prepareSaleDetail();
      var data = {
        userId: this.title,
        dateVisit: this.dateVisit,
        saleDetail: this.saleDetail,
        total: this.total
      };
      axios.post("/api/booking", data).then(response => {
        if (response.status == 200) {
            swal({
              icon: "success",
              title: "Booking Complete"
            }).then(function(){
              window.location = "/booking/1"
            })
        }
      });
    },

    prepareSaleDetail() {
      this.saleDetail.ticket = {
        amount: this.quantity,
        total: this.total,
        ticketId: this.id
      };
    }
  },

  computed: {
    ...mapGetters('shopping', ['getConfirmCheckout']),
    showTotal() {
      if (this.quantity <= 0) {
        this.quantity = 1;
      }
      this.total = this.quantity * this.ticket.price;
      return this.total;
    }
  }
};
</script>

<style>
.input-group {
  padding: 1% 0 1% 0;
}
</style>


