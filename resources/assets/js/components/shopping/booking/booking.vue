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
                        v-for="(seat, index) in seats"
                        :key="index"
                        :title="seat.ticketName"
                        :disabled="!seat.status"
                        :class="{'btn btn-primary mr-1 mt-1': seat.status, 'btn btn-danger mr-1 mt-1': !seat.status || seat.booked}"
                        @click="onBooked(index)"
                    >
                    {{ seat.seatName }}
                    </button>
                </div>
            </div>
        </div>
         
        <booking-detail
            :bookDetail="bookDetails"
            :total="getTotal"
        />
    </div>
</template>

<script>
export default {
    mounted() {
        this.getSeat();
    },

    data() {
        return {
            dateSearch: this.today(),
            seats: [],
            bookDetails: [],
            total: 0
        }
    },

    methods: {

        today() {  // หา วัน เดือน ปี แล้วเอามาต่อ string
            var today = new Date();  
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' +  dd;
            return today;
        },

        getSeat() {
            axios.get('/api/booking').then(
              response=>{
                this.seats = response.data.seat
                // console.log(response.data)
              }
            )
        }, 

        searchSeat() {
            axios.post('/api/booking/search', {dateSearch: this.dateSearch})
            .then(
                response => {
                    this.seats = response.data.seat
                    // console.log(response.data.date)
                }
            )
        },

        onBooked(index) {
            var currentSeat = this.seats[index]
            currentSeat.booked == 1? this.bookDetails.splice(this.bookDetails.indexOf(currentSeat), 1): this.bookDetails.push(this.seats[index])  
            this.seats[index].booked = currentSeat.booked == 1? 0: 1;
        },
        
    },

    computed: {
            getTotal() {
                var total = 0
                if(this.bookDetails.length >  0){
                    for(var i = 0; i < this.bookDetails.length; i++)
                    {
                        total += parseInt(this.bookDetails[i].price)
                    }
                }
                return this.total = total;
                
            }
        }
}
</script>

<style>
 .seatRow .btn{
     font-size: 75%;
 }
</style>
