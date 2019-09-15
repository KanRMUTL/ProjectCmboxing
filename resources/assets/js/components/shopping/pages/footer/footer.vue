<template>
  <div class="footer">
    <div class="container">
      <div class="row">
        <!-- Recent News -->
        <div class="col-md-6 col-sm-6 ">
          <div class="heading-footer">
            <h2>Useful Links</h2>
          </div>
          <ul class="list-unstyled link-list">
            <li><a href="/">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="/booking">Booking</a><i class="fa fa-angle-right"></i></li>
            <li><a href="/about">About us</a><i class="fa fa-angle-right"></i></li>
            <li><a href="/location">Location</a><i class="fa fa-angle-right"></i></li>
            <li><a href="/courses">Training Muaythai</a><i class="fa fa-angle-right"></i></li>
          </ul>
        </div>
        <!-- End Recent list -->

        <!-- Recent Blog Entries -->
        <div class="col-md-6 col-sm-6 ">
          <div class="heading-footer">
            <h2>Contact Us</h2>
          </div>
          <ul class="list-unstyled thumb-list">
            <li>
              <div class="overflow-h">

                <div class="row">
                  <div class="col-md-1">
                    <a
                      href="#"
                      target="_empty"
                    ><i class="fa top-social fa-phone"></i></a>
                  </div>
                  <div class="col-md-10">
                    <a>
                      {{ webDetail.phone }}
                    </a>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-1">
                    <a
                      href="#"
                      target="_empty"
                    ><i class="fa top-social fa-envelope"></i></a>
                  </div>
                  <div class="col-md-10">
                    <a>
                      {{ webDetail.email }}
                    </a>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-1">
                    <a
                      href="#"
                      target="_empty"
                    ><i class="fa top-social fa-facebook"></i>
                    </a>
                  </div>
                  <div class="col-md-10">
                    <a :href="webDetail.facebook">
                      Chiangmai Boxing Stadium Offcial
                    </a>
                  </div>
                </div>

              </div>
            </li>
          </ul>
        </div>
        <!-- End Recent Blog Entries -->

       
      </div>
    </div>
    <!--/container -->
  </div>
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
   
   mounted () {
        this.getWebdetail();
   },
};
</script>
