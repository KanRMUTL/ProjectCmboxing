<template>
    <div class="root">
        <button 
            :title="seat.ticketName"
            :disabled="!seat.status"
            :class="{'btn btn-primary mr-1 mt-1': seat.status, 'btn btn-booked mr-1 mt-1': !seat.status || seat.booked}"
            @click="onBooked(realIndex)"
        >
            {{ seat.seatName }}
        </button>
        <br v-if="(fakeIndex + 1) %  limitRow == 0">
    </div>
</template>

<script>
export default {
    props : [
        'seat',
        'limitRow',
        'col',
        'fakeIndex',
        'realIndex',
        'onBooked'
    ]
}
</script>

<style scoped>
    .root {
        display: inline;
    }
    .btn {
        padding: 0.4rem .7rem;
            font-size: 62%;
        }
</style>

