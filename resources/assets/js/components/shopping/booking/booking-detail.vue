<template>
  <!-- <div class="row justify-content-center" style="margin-top: 20px">
        <div class="card">
            <div class="card-header total">
                Booking Detail
            </div>
            <ul class="list-group list-group-flush">
            

            <li class="list-group-item detail" v-if="bookDetail.length > 0">
                Ringside: 
                <span 
                    class="badge badge-pill badge-primary mr-1 mb-1"
                    style="font-size: 90%"
                    v-for="(detail, index) in bookDetail"
                    v-if="detail.ticketId == 2"
                    :key="index"
                >{{ detail.seatName}} </span>
            </li>

            <li class="list-group-item detail" v-if="bookDetail.length > 0">
                VIP: 
                <span 
                    class="badge badge-pill badge-primary mr-1 mb-1"
                    style="font-size: 90%; background-color: #ecbc18;"
                    v-for="(detail, index) in bookDetail"
                    v-if="detail.ticketId == 3"
                    :key="index"
                >{{ detail.seatName}} </span>
            </li>

            <li class="list-group-item total">
               Total : {{ total | moneyFormat }} ฿
            </li>

            </ul>
            
        </div>
         <div class="input-group-item mt-2" v-if="total > 0">
            <paypal-button 
                :url="'/api/booking'" 
                :saveBooking="saveBooking" 
                :total="total"
            />
         </div> 
    </div> -->
  <div
    class="package-program ftco-animate fadeInUp ftco-animated"
    v-if="total > 0"
  >
    <div class="text mt-4">
      <h3 class="price">Booking Detail</h3>
      <h5
        class="pt-2"
        v-if="bookDetail.length > 0"
      >Ringside</h5>
      <span
        class="badge badge-pill badge-primary mr-1 mb-1"
        style="font-size: 90%"
        v-for="(detail, index) in bookDetail"
        v-if="detail.ticketId == 2"
        :key="index"
      >{{ detail.seatName}} </span>

      <h5
        class="pt-2"
        v-if="bookDetail.length > 0"
      >VIP</h5>
      <span
        class="badge badge-pill badge-primary mr-1 mb-1"
        style="font-size: 90%; background-color: #ecbc18;"
        v-for="(detail, index) in bookDetail"
        v-if="detail.ticketId == 3"
        :key="index"
      >{{ detail.seatName}} </span>
      <div class="d-flex mt-4 ">
        <p class="price float-right">{{ total | moneyFormat }} ฿</p>
      </div>
      <paypal-button
        :url="'/api/booking'"
        :saveBooking="saveBooking"
        :total="total"
      />
    </div>
  </div>
</template>

<script>
import mixin from "../../mixin";

export default {
  mixins: [mixin],

  props: [
    "bookDetail",
    "total",
    "dateVisit",
    "userId",
    "searchSeat",
    "clearData"
  ],

  data() {
    return {
      saleDetail: {
        ringside: {
          ticketId: 2,
          amount: 0,
          total: 0
        },
        vip: {
          ticketId: 3,
          amount: 0,
          total: 0
        },
        confirmCheckout: false
      }
    };
  },

  mounted() {},

  methods: {
    saveBooking() {
      this.prepareSaleDetail();
      var data = {
        dateVisit: this.dateVisit,
        bookDetail: this.bookDetail,
        saleDetail: this.saleDetail,
        total: this.total,
        userId: this.userId
      };
      axios.post("/api/booking", data).then(response => {
        if (response.status == 200) {
          swal({
            icon: "success",
            title: "Booking Complete"
          }).then(function() {
            window.location = "/booking/1";
          });
        }
      });

      this.clearData();
      this.searchSeat();
    },

    changePaypal() {
      this.confirmCheckout = true;
    },

    prepareSaleDetail() {
      for (var key in this.bookDetail) {
        // console.log(this.bookDetail[key])
        if (this.bookDetail[key].ticketId == 2) {
          // Ringside
          this.saleDetail.ringside.amount += 1;
          this.saleDetail.ringside.total += Number(this.bookDetail[key].price);
        }
        if (this.bookDetail[key].ticketId == 3) {
          // Ringside
          this.saleDetail.vip.amount += 1;
          this.saleDetail.vip.total += Number(this.bookDetail[key].price);
        }
      }
    }
  }
};
</script>

<style>
.card {
  width: 100%;
}

.total {
  color: #2d15e4;
  font-size: 125%;
  font-weight: 600;
  line-height: 1;
  text-align: center;
}
.detail {
  color: #2d15e4;
  font-size: 110%;
  font-weight: 600;
  line-height: 1;
}
</style>
