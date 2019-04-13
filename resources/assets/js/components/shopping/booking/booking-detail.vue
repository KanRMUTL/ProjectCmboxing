<template>
    <div>
        <div class="list-group col-md-4">
            <button type="button" class="list-group-item list-group-item-action active">
                Booking Detail
            </button>
            <button 
                type="button" 
                class="list-group-item list-group-item-action"
                v-for="(detail, index) in bookDetail"
                :key="index"
            >
                {{ detail.ticketName +  '&emsp;Seat : ' + detail.seatName + '&emsp;Price&emsp;'}}
                {{ detail.price | moneyFormat }}
            </button>
            <button type="button" class="list-group-item list-group-item-action active">
               Total is {{ total | moneyFormat }} ฿
            </button>
        </div>
        <button 
            class="btn btn-success" 
            @click="saveBooking"
            :disabled="bookDetail.length == 0"
        >
        Pay
        </button>
    </div>
</template>

<script>
export default {
    props:[
        'bookDetail', 
        'total', 
        'dateVisit', 
        'userId', 
        'searchSeat',
        'clearData'
    ],

    data() {
        return{
            saleDetail : {
                ringside:{
                    ticketId: 2,
                    amount : 0,
                    total: 0
                },
                vip:{
                    ticketId: 3,
                    amount : 0,
                    total: 0
                },
        }
        }
        
    },

    mounted() {

    },

    methods: {
        saveBooking() {
            this.prepareSaleDetail()
            var data = {
                dateVisit: this.dateVisit,
                bookDetail: this.bookDetail,
                saleDetail: this.saleDetail,
                total: this.total,
                userId: this.userId
            }
            axios.post('/api/booking', data)
            .then(
                response => {
                    if(response.status == 200) {
                        swal({
                            icon: 'success',
                            title: 'Booking Complete' 
                        })
                    }
                }
            )

            this.clearData()
            this.searchSeat()
        },

        prepareSaleDetail()
        {
            for(var key in this.bookDetail)
            {
                // console.log(this.bookDetail[key])
                if(this.bookDetail[key].ticketId == 2) { // Ringside
                    this.saleDetail.ringside.amount += 1
                    this.saleDetail.ringside.total += Number(this.bookDetail[key].price)
                }
                if(this.bookDetail[key].ticketId == 3) { // Ringside
                    this.saleDetail.vip.amount += 1
                    this.saleDetail.vip.total += Number(this.bookDetail[key].price)
                }
            }
        }
    },

    filters: {
        moneyFormat: function(Price) {
            return new Intl.NumberFormat("en-IN", {
                maximumSignificantDigits: 3
            }).format(Price);
        },
    }
}
</script>
