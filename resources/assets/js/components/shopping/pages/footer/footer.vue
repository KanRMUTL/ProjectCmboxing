<template>
  <div class="footer">
    <div class="container">
      <div class="row">
        <!-- Recent News -->
        <div class="col-md-4 col-sm-6 ">
          <div class="heading-footer">
            <h2>Useful Links</h2>
          </div>
          <ul class="list-unstyled link-list">
            <li><a href="/">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="/about">About us</a><i class="fa fa-angle-right"></i></li>
            <li><a href="/booking">Booking</a><i class="fa fa-angle-right"></i></li>
            <li><a href="/courses">Training Muaythai</a><i class="fa fa-angle-right"></i></li>
          </ul>
        </div>
        <!-- End Recent list -->

        <!-- Recent Blog Entries -->
        <div class="col-md-4 col-sm-6 ">
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

        <!-- Latest Tweets -->
        <div class="col-md-4 col-sm-6">
          <div class="card map p-2">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.9180670916057!2d98.98038551538194!3d18.801804365418594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3a93abd71e55%3A0x43c8fac502001a10!2sChiangmai+Boxing+Stadium!5e0!3m2!1sth!2sth!4v1558955967888!5m2!1sth!2sth"
              frameborder="0"
              style="border:0; height: 200px;"
              allowfullscreen
            ></iframe>
          </div>
        </div>
        <!-- End Latest Tweets -->
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
