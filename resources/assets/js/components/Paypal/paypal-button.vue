<template>
  <div>
    <!-- <div id="paypal-button-container" @click="createOrder()"></div> -->
    <button
      class="btn btn-success btn-block"
      v-show="isConfirm"
      @click="createOrder(total, saveBooking)"
    >Confirm Checkout</button>
    <div
      id="paypal-button-container"
      v-show="!isConfirm && total > 0"
    ></div>
  </div>
</template>

<script>
 import { mapActions } from 'vuex' 
export default {
  props: ["url", "saveBooking", "total"],
  data() {
    return {
      isConfirm: true
    };
  },
  mounted() {
    // Do something
  },

  methods: {
    ...mapActions('shopping', ['setConfirmCheckout']),
    createOrder(total, saveBooking) {
      this.setConfirmCheckout(true)
      this.isConfirm = false;
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
                    // 'X-CSRF-TOKEN': csrf
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
        .render("#paypal-button-container");
    }
  }
};
</script>

