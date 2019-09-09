<template>
  <div class="row">
      <div
        v-for="(fight, index) in fights.data"
        :key="index"
        class="card col-md-6 col-sm-12"
      >
       <div class="card-body text-center">
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
  }
};
</script>

