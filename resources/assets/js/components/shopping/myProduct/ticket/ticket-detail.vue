<template>
    <div>
        <div class="modal fade" id="ticket-detail-modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ticket">
                    <div class="ticket__content">
                        <h5 class="modal-title" id="exampleModalCenterTitle">CM Boxing</h5>
                        <h5 class="visit-day">Visit Day : {{ ticketDetail.visit | formatDate}} </h5>
                        <div>
                            Ringside:
                            <span v-for="(ringside,index) in seat.ringside" :key="index"
                                class="badge badge-primary mt-1">
                                {{ringside}}
                            </span>
                            <span v-if="seat.ringside.length == 0" class="badge badge-secondary mt-1">
                                Non selected
                            </span>
                        </div>
                        <div>
                            VIP:
                            <span v-for="(vip,index) in seat.vip" :key="index" class="badge badge-primary mt-1">
                                {{vip}}
                            </span>
                            <span v-if="seat.vip.length == 0" class="badge badge-secondary mt-1">
                                Non selected
                            </span>
                        </div>
                        <p class="ticket__text">Ticket
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex' 
    export default {
        props: ['ticketDetail', 'tickets', 'seat'],

        methods: {
            ...mapActions(['setConfirmCheckout'])
        },

        computed: {
            ...mapGetters(['getConfirmCheckout'])
        },
        filters: {
            formatDate(value) {
                let current_datetime = new Date(value)
                let formatted_date = current_datetime.getDate() + "/" + (current_datetime.getMonth() + 1) + "/" + current_datetime.getFullYear()
                return formatted_date
            }
        },
    }
</script>

<style lang="scss" scoped>
h5{
    color: #000 !important;
}
    .ticket-status {
        text-align: center;
    }

    .ticket-status span {
        font-size: 170%;
    }
    .modal-content {
        border: 0 solid;
    }
    .modal-title,
    .visit-day {
        text-align: center;
        margin-bottom: 3%;
    }

    .ticket {
        position: relative;
        box-sizing: border-box;
        width: 300px;
        height: 450px;
        margin: 150px auto 0;
        padding: 20px;
        border-radius: 10px;
        background: #FBFBFB;
        box-shadow: 2px 2px 15px 0px #AB9B0D;

        &:before,
        &:after {
            content: '';
            position: absolute;
            left: 5px;
            height: 6px;
            width: 290px;
        }

        &:before {
            top: -5px;
            background: radial-gradient(circle, transparent, transparent 50%, #FBFBFB 50%, #FBFBFB 100%) -7px -8px / 16px 16px repeat-x,
        }

        &:after {
            bottom: -5px;
            background: radial-gradient(circle, transparent, transparent 50%, #FBFBFB 50%, #FBFBFB 100%) -7px -2px / 16px 16px repeat-x,
        }
    }

    .ticket__content {
        box-sizing: border-box;
        height: 100%;
        width: 100%;
        border: 6px solid #D8D8D8;
        padding: 6%;
    }

    .ticket__text {
        width: 323px;
        font-family: 'Helvetica', 'Arial', sans-serif;
        font-size: 3rem;
        font-weight: 900;
        text-transform: uppercase;
        color: #efefef;
        transform: translate(-25px, 25px) rotate(-55deg);
    }
</style>