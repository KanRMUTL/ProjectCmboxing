<template>
    <div>
        <div class="modal fade" id="ticket-detail-modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ticket">
                    <div class="ticket__content">
                        <img id="logo" src="shopping/img/Logo.png">
                        <h5 class="modal-title" id="exampleModalCenterTitle">CM Boxing Stadium</h5>
                        <h5 class="visit-day">Visit: {{ ticket.visit }}</h5>
                        <div class="seat-detail">
                            Ringside:
                            <b
                                v-for="(seat, index) in ticket.sale_ticket_detail" 
                                v-if="seat.ticket_id == 2" 
                                :key="index"
                            >
                                <span 
                                    class="badge badge-success mt-1 mr-1" 
                                    v-for="(seat, index) in ticket.seat_register" 
                                    :key="index">
                                   {{ seat.name }}
                                </span>
                            </b>
                            <span class="badge badge-secondary mt-1" v-else>
                             Non selected
                            </span>
                        </div>
                        <div class="seat-detail">
                            VIP:
                           <b
                                v-for="(seat, index) in ticket.sale_ticket_detail" 
                                v-if="seat.ticket_id == 3" 
                                :key="index"
                            >
                                <span class="badge badge-success mt-1 mr-1" v-for="(seat, index) in ticket.seat_register" :key="index">
                                   {{ seat.name }}
                                </span>
                            </b>
                            <span class="badge badge-secondary mt-1" v-else>
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
    import { mapState } from 'vuex'
    export default {
        data() {
            return {
                ticketType: ['Grandstand', 'Ringside', 'VIP']
            }
        },
        computed: {
            ...mapState('ticketOnline',{
                ticket: state => state.ticket
            })  
        },
        
    }
</script>

<style lang="scss" scoped>
    #logo {
        width: 50px;
        display: block;
        margin: 0 auto;
    }
    #exampleModalCenterTitle{
        font-size: 1.8em;
    }

    .seat-detail{
        font-size: 1.2em;
    }
    .seat-detail span{
        font-size: 1em;
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
        text-align: left;
        margin-bottom: 7%;
        font-size: 1.3em;

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