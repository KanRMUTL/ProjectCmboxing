<template>

  <div class="row">
    <div
      v-for="ticket in tickets"
      :key="ticket.id"
      class="col-md-4 col-sm-6 desc-comp-offer wow fadeInUp"
      data-wow-delay="0.4s"
    >
      <div class="desc-comp-offer-cont">
        <div class="thumbnail-blogs">
          <img
            :src="'/shopping/img/ticket/' + ticket.img"
            class="img-fluid"
          >
        </div>
        <h3>{{ ticket.name }}</h3>

        <div class="col-md-10">
          <p>{{ ticket.price }} ฿</p>
        </div>
        <div class="col-md-2">
          <paypal-button-ticket
               :id="'ticket' + ticket.name"
               :total="ticket.price"
          />
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
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
      }
    };
  },

  methods: {
    getTickets() {
      axios
        .get("/api/getTicket")
          //  .then(res => {
          //    console.log(res);
          //  })
        .then(res => {
          this.tickets = res.data.tickets;
        })
        .catch(function(e) {
          console.log(e);
        });
    }
  }
};
</script>

