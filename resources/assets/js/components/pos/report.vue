<template>
  <div>
    <div class="box-body no-padding">

      <div class="row">

        <div class="col-md-2">
          <div class="input-group">
            <span class="input-group-addon">เริ่มต้น</span>
            <input
              type="date"
              class="form-control"
              v-model="start"
            >
          </div>
        </div>

        <div class="col-md-2 offset-md-2">
          <div class="input-group">
            <span class="input-group-addon">สิ้นสุด</span>
            <input
              type="date"
              class="form-control"
              v-model="end"
            >
          </div>
        </div>

        <div class="col-md-2 offset-md-2">
          <button
            class="btn btn-primary"
            @click="searchBills()"
          >ค้นหา</button>
        </div>

      </div>
      <p></p>
      <table class="table table-striped table-hover center mt-2">
        <tbody>
          <tr>
            <td>รหัสการขาย</td>
            <td>ยอดรวม</td>
            <td>เวลา</td>
            <td>ผู้ขาย</td>
            <td>รายละเอียด</td>
            <td>ออกรายงาน</td>
          </tr>
          <tr
            v-for="bill in bills"
            :key="bill.id"
            @click="getSaleDetail(bill)"
            data-toggle="modal"
            data-target=".bd-example-modal-lg"
          >
            <td v-text="bill.id"></td>
            <td>{{bill.total | moneyFormat}}</td>
            <td>{{bill.created_at | dateTimeFormat}}</td>
            <td v-text="fullname(bill)"></td>
            <td>
              <button class="btn btn-primary">รายละเอียด</button>
            </td>
            <td>
              <a :href="'/stock/bill/' + bill.id" target="_blank" class="btn btn-primary">ออกรายงาน</a>
            </td>
          </tr>
        </tbody>
      </table>
      <a :href="'/stock/allbills/' + start + '/' + end" target="_blank" class="btn btn-primary btn-block">ออกรายงาน</a>
      <!-- Modal -->
      <div
        class="modal fade bd-example-modal-lg"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h3>รายละเอียดการขาย</h3>
            </div>
            <div class="modal-body">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>สินค้า</th>
                    <th class="img-col">รูปภาพ</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>รวม</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="saleDetail in saleDetails"
                    :key="saleDetail.id"
                  >
                    <td v-text="saleDetail.name"></td>
                    <td><img
                        :src="'/pos/product/'+saleDetail.img"
                        alt=""
                      ></td>
                    <td v-text="saleDetail.price | moneyFormat"></td>
                    <td v-text="saleDetail.amount"></td>
                    <td>{{saleDetail.total | moneyFormat}}</td>
                  </tr>

                  <tr class="table-success">
                    <th
                      colspan="4"
                      align="center"
                    >ทั้งหมด</th>
                    <th>{{saleDetailsTotal | moneyFormat}}</th>
                  </tr>
                </tbody>
              </table>
            </div>
              
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-primary"
                data-dismiss="modal"
              >OK</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import mixin from "../mixin";
export default {
  mixins: [mixin],

  mounted() {
    this.searchBills();

    $("#myModal").on("shown.bs.modal", function() {
      $("#myInput").trigger("focus");
    });
  },

  data() {
    return {
      start: moment()
        .startOf("week")
        .add("d", 1)
        .format("YYYY-MM-DD"),
      end: moment()
        .endOf("week")
        .add("d", 1)
        .format("YYYY-MM-DD"),
      bills: [],
      saleDetails: [],
      saleDetailsTotal: 0,
      bill: {
        id: 0,
        total: 0,
        created_at: 0,
        firstname: "",
        lastname: ""
      }
    };
  },

  methods: {
    getBills() {
      axios.get("/api/report").then(res => {
        this.bills = res.data;
      });
    },

    searchBills() {
      var data = {
        start: this.start,
        end: this.end
      };
      axios.post("/api/report", data).then(res => {
        this.bills = res.data;
      });
    },
    getSaleDetail(bill) {
      axios.get("/api/report/" + bill.id).then(res => {
        this.saleDetails = res.data;
        this.saleDetailsTotal = bill.total;
      });
    },
    showDateTime(dateTime) {
      var d = new Date(dateTime);
      var day = d.getDay();
      var m = d.getMonth();
      var y = d.getFullYear();
      var h = d.getHours();
      var minutes = d.getMinutes();
      var sec = d.getSeconds();
      return day + "/" + m + "/" + y + " " + h + ":" + minutes + ":" + sec;
    },

    fullname(bill) {
      return bill.firstname + "    " + bill.lastname;
    }
  },

  filters: {
    dateTimeFormat: function(value) {
      return moment(value).format("DD/MM/YYYY  h:mm:ss");
    }
  }
};
</script>
<style>
.img-col {
  width: 15%;
  padding: 0 5% 0 5%;
}
th {
  width: 20%;
}
img {
  width: 100%;
}
</style>