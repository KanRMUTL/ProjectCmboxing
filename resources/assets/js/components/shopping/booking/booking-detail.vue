<template>
    <div class="row justify-content-center" style="margin-top: 20px">
        <div class="card" style="width:100%;">
            <div class="card-header total">
                Booking Detail
            </div>
            <ul class="list-group list-group-flush">
            

            <li class="list-group-item detail" v-if="bookDetail.length > 0">
                Ringside: 
                <span 
                    class="badge badge-pill badge-primary mr-1 mb-1"
                    style="font-size: 90%"
                    v-for="(detail, index) in bookDetail"
                    v-if="detail.ticketId == 2"
                    :key="index"
                >{{ detail.seatName}} </span>
            </li>

            <li class="list-group-item detail" v-if="bookDetail.length > 0">
                VIP: 
                <span 
                    class="badge badge-pill badge-primary mr-1 mb-1"
                    style="font-size: 90%; background-color: #ecbc18;"
                    v-for="(detail, index) in bookDetail"
                    v-if="detail.ticketId == 3"
                    :key="index"
                >{{ detail.seatName}} </span>
            </li>

            <li class="list-group-item total">
               Total : {{ total | moneyFormat }} ฿
            </li>
            </ul>
            
        </div>
        <div class="input-group mt-2">
            <button 
                class="btn btn-success btn-block" 
                @click="saveBooking"
                :disabled="bookDetail.length == 0"
            >
            Checkout
            </button>
        </div>
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

<style>
    .total {
        color: #2d15e4;
        font-size: 125%;
        font-weight: 600;
        line-height: 1;
        text-align: center;
    }
    .detail {
        color:#2d15e4;
        font-size: 110%;
        font-weight: 600;
        line-height: 1;
    }
    
</style>
