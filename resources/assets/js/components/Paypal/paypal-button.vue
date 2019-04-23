<template>
        <div>
                <!-- <div id="paypal-button-container" @click="createOrder()"></div> -->
                <button class="btn btn-success btn-block" v-show="isConfirm" @click="createOrder(total, saveBooking)">Confirm Checkout</button>
                <div id="paypal-button-container"></div>
        </div>
</template>

<script>
export default {
        props : ['url', 'saveBooking', 'total'],
        data() {
                return{
                isConfirm: true
                }
        },
        mounted() {
                // var csrf = document.getElementsByTagName('meta')[1].getAttribute('content')
                // this.renderPaypalBtn()
                
        },

        methods:{
                createOrder(total , saveBooking) {
                        this.isConfirm = false;
                        paypal.Buttons({
                         createOrder: function(data, actions) {
                        // Set up the transaction
                                return actions.order.create({
                                        purchase_units: [{
                                        amount: {
                                                value: total
                                        }
                                        }]
                                });
                        },
                        onApprove: function(data, actions) {
                                // console.table(data)
                                return actions.order.capture().then(function(details) {
                                        try{
                                                return fetch('/api/payment', {
                                                        method: 'post',
                                                        headers: {
                                                        'content-type': 'application/json',
                                                        // 'X-CSRF-TOKEN': csrf
                                                        },
                                                        body: JSON.stringify({
                                                        orderID: data.orderID
                                                        })
                                                })
                                                .then(data => { saveBooking();} );
                                        } catch(e) {
                                                // console.log(e)
                                        }

                                });
                        }
                        }).render('#paypal-button-container');  
                        
                }
        }

}
</script>

