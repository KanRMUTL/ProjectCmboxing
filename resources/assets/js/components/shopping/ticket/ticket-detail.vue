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
                <hr>
                <h5>Seat</h5>
               
                <div v-if="seat.ringside != null">
                    Ringside: 
                    <span
                        v-for="(ringside,index) in seat.ringside" 
                        :key="index"
                        class="badge badge-primary mt-1"
                    >
                        {{ringside}}
                    </span>
                </div>
                <div v-if="seat.vip != []">
                    VIP: 
                    <span
                        v-for="(vip,index) in seat.vip" 
                        :key="index"
                        class="badge badge-primary mt-1"
                    >
                        {{vip}}
                    </span>
                </div>
                <hr>
                    <span class="badge badge-secondary" v-if="!ticketDetail.status">Expire</span>
                    <span class="badge badge-success" v-if="ticketDetail.status">Active</span>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
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

