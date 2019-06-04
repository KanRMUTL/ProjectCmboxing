<template>

  <div class="row">

    <div class="card col-md-4"  v-for="ticket in tickets" :key="ticket.id">
      <a href="#"><img
          class="card-img-top"
          :src="'/shopping/img/ticket/' + ticket.img"
          alt=""
        ></a>
      <div class="card-body text-center">
        <div class="card-title">
          {{ ticket.name }}
        </div>
        <strong>{{ ticket.price | moneyFormat }} ฿</strong>
        <br>
        <button class="btn btn-general btn-white" role="button" @click="goToBuy(ticket)">
          <i class="fa fa-cart-pay"></i> Buy Ticket
        </button>
      </div>
    </div>
    
  </div>

</template>

<script>
import mixin from '../../../mixin'

export default {
  mixins: [mixin],

  mounted() {
    this.getTickets();
  },

  data() {
    return {
      tickets: [],
      ticket: {
        id: "",
        img: "",
        name: "",
        price: ""
      },
      ticketSelected: []
    };
  },

  methods: {
    getTickets() {
      axios
        .get("/api/getTicket")
        .then(res => {
          this.tickets = res.data.tickets;
        })
        .catch(function(e) {
          console.log(e);
        });
    },

    goToBuy(ticket) {
      window.location.href = "/saleticket/" + ticket.id;
    }
  },

  computed: {
    name() {
      return this.data 
    }
  },
};
</script>

