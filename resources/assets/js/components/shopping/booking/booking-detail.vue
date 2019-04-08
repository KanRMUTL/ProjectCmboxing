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
        <button class="btn btn-success">Pay</button>
    </div>
</template>

<script>
export default {
    props:['bookDetail', 'total'],

    mounted() {

    },

    methods: {

    },

    filters: {
        moneyFormat: function(Price) {
            return new Intl.NumberFormat("en-IN", {
                maximumSignificantDigits: 3
            }).format(Price);
        }
    }
}
</script>
