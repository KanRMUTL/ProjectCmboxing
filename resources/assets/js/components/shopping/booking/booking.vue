<template>
  <section id="booking">

    <div class="row justify-content-center pt-5 mt-5">
      <div class="col-md-7 heading-section ftco-animate text-center fadeInUp ftco-animated">
        <h2 class="mb-4">Booking</h2>
      </div>
    </div>
    <div :class="{'col-md-12': id != 0, 'col-md-12': id == 0}">
      <div class="row justify-content-center">
        <div class="col-md-5 col-lg-3 col-xs-2 col-4">
          <div class="form-group">
            <label
              class="input-group-addon"
              for="inlineFormInputGroup"
            >Select Date</label>
            <input
              autofocus
              type="date"
              v-model="dateSearch"
              class="form-control"
              id="inlineFormInputGroup"
              :min="min"
            >
          </div>
          <div class="form-group">
            <input
              value="Search"
              class="btn btn-primary btn-block"
              @click="searchSeat"
            >
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div :class="{'seatSelection col-md-12 col-lg-12': id != 0, 'seatSelection col-md-12': id == 0}">
        <div class="row">
          <div class="col-md-12">
            <div class="seatRow">
              <seat
                v-for="(seat, index) in seats"
                v-if="index <= 79"
                :key="index"
                :limitRow="20"
                :seat="seat"
                :col="'col-md-12'"
                :onBooked="onBooked"
                :realIndex="index"
                :fakeIndex="index"
              />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-6">
            <div class="seatRow">
              <seat
                v-for="(seat, index) in seats"
                v-if="index > 79 && index <= 109"
                :key="index"
                :limitRow="10"
                :seat="seat"
                :col="'col-md-12'"
                :onBooked="onBooked"
                :realIndex="index"
                :fakeIndex="index"
              />
            </div>
          </div>

          <div class="col-md-6 col-6">
            <div class="seatRow">
              <seat
                v-for="(seat, index) in seats"
                v-if="index > 109 && index <= 139"
                :key="index"
                :limitRow="10"
                :seat="seat"
                :col="'col-md-12'"
                :onBooked="onBooked"
                :realIndex="index"
                :fakeIndex="index"
              />
            </div>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-4 col-4">
            <div class="seatRow">
              <seat
                v-for="(seat, index) in seats"
                v-if="index > 139 && index <= 184"
                :key="index"
                :limitRow="3"
                :seat="seat"
                :col="'col-md-12'"
                :onBooked="onBooked"
                :realIndex="index"
                :fakeIndex="index - 2"
              />
            </div>
          </div>

          <div class="col-md-4 col-4">
            <img
              src="/shopping/img/topview.jpg"
              style="width: 100%; height: 96%;"
            />
          </div>

          <div class="col-md-4 col-4">
            <div class="seatRow">
              <seat
                v-for="(seat, index) in seats"
                v-if="index > 184 && index <= 229"
                :key="index"
                :limitRow="3"
                :seat="seat"
                :col="'col-md-12'"
                :onBooked="onBooked"
                :realIndex="index"
                :fakeIndex="index - 2"
              />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="seatRow">
              <seat
                v-for="(seat, index) in seats"
                v-if="index > 229 && index <= 259"
                :key="index"
                :limitRow="15"
                :seat="seat"
                :col="'col-md-12'"
                :onBooked="onBooked"
                :realIndex="index"
                :fakeIndex="index - 5"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div
        class="col-md-3 col-sm-4"
        id="booking-detail"
      >
        <booking-detail
          v-if="id != 0"
          :bookDetail="bookDetails"
          :total="getTotal"
          :dateVisit="dateSearch"
          :userId="id"
          :searchSeat="searchSeat"
          :clearData="clearData"
        />
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: ["id"],
  mounted() {
    this.getSeat();
  },

  data() {
    return {
      min: this.today(),
      dateSearch: this.today(),
      seats: [],
      bookDetails: [],
      total: 0
    };
  },

  methods: {
    today() {
      // หา วัน เดือน ปี แล้วเอามาต่อ string
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, "0");
      var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
      var yyyy = today.getFullYear();

      today = yyyy + "-" + mm + "-" + dd;
      return today;
    },

    getSeat() {
      axios.get("/api/booking").then(response => {
        this.seats = response.data.seat;
        // console.log(response.data)
      });
    },

    searchSeat() {
      this.clearData();
      axios
        .post("/api/booking/search", { dateSearch: this.dateSearch })
        .then(response => {
          this.seats = response.data.seat;
          // console.log(response.data.date)
        });
    },

    onBooked(index) {
      if (!this.getConfirmCheckout) {
        if (this.id != 0) {
          var currentSeat = this.seats[index];
          currentSeat.booked == 1
            ? this.bookDetails.splice(this.bookDetails.indexOf(currentSeat), 1)
            : this.bookDetails.push(this.seats[index]);
          this.seats[index].booked = currentSeat.booked == 1 ? 0 : 1;
        } else {
          swal({
            icon: "warning",
            title: "Please login for booking"
          });
        }
      }
    },

    clearData() {
      this.bookDetails = [];
      this.total = 0;
    }
  },

  computed: {
    ...mapGetters("shopping", ["getConfirmCheckout"]),
    getTotal() {
      var total = 0;
      if (this.bookDetails.length > 0) {
        for (var i = 0; i < this.bookDetails.length; i++) {
          total += parseInt(this.bookDetails[i].price);
        }
      }
      return (this.total = total);
    }
  }
};
</script>

<style>
@media (max-width: 576px) {
  #booking-detail {
    width: 50%;
  }
}
@media (max-width: 768px) {
  #booking,
  header,
  header div,
  header div nav,
  header div nav .container {
    width: 1100px !important;
    position: block;
  }
  #mainNav {
    position: fixed;
  }
}

.seatSelection {
  text-align: center;
  padding: 5px;
  margin: 15px;
}

.seatsReceipt {
  text-align: center;
}

.seatNumber {
  display: inline;
  padding: 10px;
  background-color: #5c86eb;
  color: #fff;
  border-radius: 5px;
  cursor: default;
  height: 25px;
  width: 25px;
  line-height: 25px;
  text-align: center;
}

.seatEndRow {
  display: flex;
  padding: 10px;
  background-color: #5c86eb;
  color: #fff;
  border-radius: 5px;
  cursor: default;
  height: 25px;
  width: 25px;
  line-height: 25px;
  text-align: center;
}

.seatRow {
  padding: 10px;
}

.seatSelected {
  background-color: lightgreen;
  color: black;
}

.seatUnavailable {
  background-color: gray;
}

.seatRowNumber {
  clear: none;
  display: inline;
}

.hidden {
  display: none;
}

.seatsAmount {
  max-width: 2em;
}
</style>
