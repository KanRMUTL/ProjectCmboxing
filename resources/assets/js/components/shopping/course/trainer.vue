<template>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-2">
        <div class="col-md-7 heading-section text-center">
          <h3 class="mb-4">Our Trainer</h3>
        </div>
      </div>
      <div class="row">
        <div
          class="col-lg-6 d-flex"
          v-for="(trainer, index) in trainers"
          :key="index"
        >
          <div class="coach d-sm-flex align-items-stretch">
            <div
              class="img"
              :style="`background-image: url(/shopping/img/trainer/${trainer.img}); height: 500px;`"
            ></div>
            <div class="text py-4 px-5">
              <h3><a href="#">{{ trainer.name }}</a></h3>
              <p>&emsp;{{ trainer.detail }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  props: ["trainers"],

  data() {
    return {};
  },
  methods: {
    getAllTrainer() {
      axios.get("/api/trainer").then(response => {
        this.trainers = response.data;
      });
    }
  }
};
</script>

<style type="text/css">
/* Chart.js */
@-webkit-keyframes chartjs-render-animation {
  from {
    opacity: 0.99;
  }
  to {
    opacity: 1;
  }
}
@keyframes chartjs-render-animation {
  from {
    opacity: 0.99;
  }
  to {
    opacity: 1;
  }
}
.chartjs-render-monitor {
  -webkit-animation: chartjs-render-animation 0.001s;
  animation: chartjs-render-animation 0.001s;
}
.center {
  text-align: center;
}
</style>