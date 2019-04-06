<template>
    <div>
        <h1 align="center">Booking</h1>
        <div class="col-md-3">
            <label for="dateSearch">Select Date</label>
            <input type="date" id="dateSearch" v-model="dateSearch" class="form-control">
            <button @click="searchSeat" class="btn btn-success">Search</button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="seatRow">
                    <button 
                        v-for="(g1, index) in groups1"
                        :key="index"
                        :title="g1.ticketName"
                        :disabled="!g1.status"
                        :class="{'btn btn-primary mr-1 mt-1': g1.status, 'btn btn-danger mr-1 mt-1': !g1.status}"
                    >
                    {{ g1.seatName }}
                    </button>
                </div>
            </div>
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
            dateSearch: '',
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
                ticket_id: '',
                status: ''
            },
        }
    },

    methods: {
        getSeat() {
            axios.get('/api/booking').then(
              response=>{
                this.groups1 = response.data.seats_group_1;
                this.groups2 = response.data.seats_group_2;
                this.groups3 = response.data.seats_group_3;
                this.groups4 = response.data.seats_group_4;
                this.groups5 = response.data.seats_group_5;
                this.groups6 = response.data.seats_group_6;
                // console.log(response.data)
              }
            )
        }, 

        searchSeat() {
            axios.post('/api/booking/search', {dateSearch: this.dateSearch})
            .then(
                response => {
                    this.groups1 = response.data.seats_group_1;
                    this.groups2 = response.data.seats_group_2;
                    this.groups3 = response.data.seats_group_3;
                    this.groups4 = response.data.seats_group_4;
                    this.groups5 = response.data.seats_group_5;
                    this.groups6 = response.data.seats_group_6;
                    console.log(response.data.date)
                }
            )
        }
    },
}
</script>

