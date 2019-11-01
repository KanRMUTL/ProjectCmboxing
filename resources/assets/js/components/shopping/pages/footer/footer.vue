<template>
  <footer class="ftco-footer ftco-section img">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">

        <div class="col-lg-6 col-md-6">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Usefull Links</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><a href="/"><span class="icon icon-chevron-right"></span><span class="text">Home</span></a></li>
                <li><a href="/booking"><span class="icon icon-chevron-right"></span><span class="text">Booking</span></a></li>
                <li><a href="/about"><span class="icon icon-chevron-right"></span><span class="text">About us</span></a></li>
                <li><a href="/location"><span class="icon icon-chevron-right"></span><span class="text">Location</span></a></li>
                <li><a href="/courses"><span class="icon icon-chevron-right"></span><span class="text">Training Muaythai</span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 ">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Contact Us</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{ webDetail.phone }}</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{ webDetail.email }}</span></a></li>
                <li><a :href="webDetail.facebook"><span class="icon icon-facebook-square"></span><span class="text">Chiangmai Boxing Stadium Offcial</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      webDetail: []
    };
  },

  methods: {
    getWebdetail() {
      axios.get("/api/webdetail").then(res => {
        this.webDetail = res.data;
      });
    }
  },

  mounted() {
    this.getWebdetail();
  }
};
</script>
