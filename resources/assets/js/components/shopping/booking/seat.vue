<template>
    <div class="root">
        <button 
            :title="seat.ticketName"
            :disabled="!seat.status"
            :class="{'btn btn-primary mr-1 mt-1': seat.status, 'btn btn-danger mr-1 mt-1': !seat.status || seat.booked}"
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

<style>
    .root {
        display: inline;
    }
</style>

