<template>
    <div>

        <div class="modal fade" id="ticket-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">CM Boxing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Visit Day : {{ ticketDetail.visit | formatDate}} </h5>
                <hr>
                <h5>Seat</h5>
               
                <div>
                    Ringside: 
                    <span
                        v-for="(ringside,index) in seat.ringside" 
                        :key="index"
                        class="badge badge-primary mt-1"
                    >
                        {{ringside}}
                    </span>
                    <span v-if="seat.ringside.length == 0" class="badge badge-secondary mt-1">
                        Non selected
                    </span>
                </div>
                <div>
                    VIP: 
                    <span
                        v-for="(vip,index) in seat.vip" 
                        :key="index"
                        class="badge badge-primary mt-1"
                    >
                        {{vip}}
                    </span>
                    <span v-if="seat.vip.length == 0" class="badge badge-secondary mt-1">
                        Non selected
                    </span>
                </div>
                <hr>
                <div class="ticket-status">
                    <span class="badge badge-secondary" v-if="!ticketDetail.status">Expire</span>
                    <span class="badge badge-success" v-if="ticketDetail.status">Active</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">OK</button>
            </div>
            </div>
        </div>
        </div>

    </div>
</template>

<script>
export default {
    props: ['ticketDetail', 'tickets', 'seat'],

    mounted() {
       
    },

    data() {
        return {
            
        }
    },

    methods: {
        
    },

    filters: {
         formatDate(value) {
            let current_datetime = new Date(value)
            let formatted_date = current_datetime.getDate() + "/" + (current_datetime.getMonth() + 1) + "/" + current_datetime.getFullYear()
            return formatted_date
      }
    },

    computed: {

    }
}
</script>

<style>
.ticket-status{
    text-align: center;
}
.ticket-status span {
    font-size: 170%;
}
</style>
