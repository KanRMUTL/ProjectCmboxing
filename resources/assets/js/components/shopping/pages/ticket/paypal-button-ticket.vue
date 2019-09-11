<template>
  <div>
    <button
      class="btn btn-general btn-white btn-block"
      role="button"
      @click="confirmed()"
      v-show="!confirm"
    >
      <i class="fa fa-paypal"></i> Confirm
    </button>
    <div id="paypal-button" v-show="confirm"></div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  props: ["total", "saveBooking"],

  data() {
    return {
      confirm: false
    };
  },

  methods: {
    ...mapActions('shopping',['setConfirmCheckout']),

    confirmed() {
      this.confirm = true;
      this.createOrder(this.total, this.id, this.saveBooking);
      this.setConfirmCheckout(MediaStreamTrackAudioSourceNode)
    },

    createOrder(total, id, saveBooking) {
      paypal
        .Buttons({
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [
                {
                  amount: {
                    value: total
                  }
                }
              ]
            });
          },
          onApprove: function(data, actions) {
            // console.table(data)
            return actions.order.capture().then(function(details) {
              try {
                return fetch("/api/payment", {
                  method: "post",
                  headers: {
                    "content-type": "application/json"
                  },
                  body: JSON.stringify({
                    orderID: data.orderID
                  })
                }).then(data => {
                  saveBooking();
                });
              } catch (e) {
                // console.log(e)
              }
            });
          }
        })
        .render("#paypal-button");
    }
  }
};
</script>

