<template>
  <div class="row">
    <div
      class="col-md-6 col-sm-12 mb-2"
      v-for="(fight, index) in fights.data"
      :key="index"
    >
      <div class="card">
        <div
          class="card-body text-center"
          style="background-color:#f1b81e; padding-top: 11px; padding-bottom: 9px; color: #fff"
        >
          <i class="fa fa-calendar fa-lg"></i><h5 class="card-title" style="color: #fff; font-size: 1.2em;">  {{ fight.day | dateFormat }}</h5>
        </div>
         <img
          class="card-img-top"
          :src="`/shopping/img/fight/${fight.img}`"
          alt=""
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  mounted() {
    this.setFights();
  },
  methods: {
    ...mapActions("fight", {
      setFights: "setFights"
    })
  },
  computed: {
    ...mapState("fight", {
      fights: state => state.fights
    })
  },
  filters: {
      dateFormat: function(value) {
          return moment(value).format('DD/MM/YYYY');
      }
  }
}
</script>

