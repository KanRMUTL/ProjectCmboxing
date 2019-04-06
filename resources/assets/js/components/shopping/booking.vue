<template>
    <div>
        <h1 align="center">Booking</h1>
        <div class="seatSelection col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="seatRow">
                        <div v-for="(g1, index) in groups1" :key="index">
                            <div  :id="'VIP_'+g1.name" role="checkbox" :value="g1.price" aria-checked="false"
                                focusable="true" tabindex="-1" class="seatNumber" >
                                {{g1.name}}
                            </div>
                        </div>
                        <!-- <br v-if="index == 19 || index == 39 || index ==59">
                        <br v-if="index == 19 || index == 39 || index ==59"> -->
                    </div>
                </div>
            </div>  <!-- End row -->
        </div>
        <div class="seatsReceipt col-lg-2">
            <p><strong>Selected Seats: <span class="seatsAmount">0 </span></strong> <button id="btnClear" class="btn">Clear</button></p>
            <ul id="seatsList" class="nav nav-stacked"></ul>

        </div>

        <div class="checkout col-lg-offset-6">
            <span>Subtotal: CA$</span><span class="txtSubTotal">0.00</span><br /><button id="btnCheckout" name="btnCheckout" class="btn btn-primary"> Check out </button>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getSeat();
    },

    data() {
        return {
            groups1: [],        
            groups2: [],       
            groups3: [],      
            groups4: [],     
            groups5: [],    
            groups6: [],
            group1: {
                group: 0,
                id: 0,
                name: '',
                price: 0,
                ticket_id: ''
            }
        }
    },

    methods: {
        getSeat()
        {
            axios.get('/api/booking').then(
              response=>{
                this.groups1 = response.data.seats_group_1;
                this.groups2 = response.data.seats_group_1;
                this.groups3 = response.data.seats_group_1;
                this.groups4 = response.data.seats_group_1;
                this.groups5 = response.data.seats_group_1;
                this.groups6 = response.data.seats_group_1;
                console.log(response.data)
              }
            )
        }
    },
}
</script>