<template>
  <div>
    <div :id="id"></div>
  </div>
</template>

<script>
export default {
  props: ["total", "id"],
  data() {
    return {
      
    };
  },
  mounted() {
    this.createOrder(this.total, this.id)
  },

  methods: {
    createOrder(total, id) {
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
            return actions.order.capture().then(
               function(details) {
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
                         //    saveOrder();
                         });
                    } catch (e) {
                         // console.log(e)
                    }
               });
          }
        })
        .render('#'+id);
    }
  }
};
</script>

