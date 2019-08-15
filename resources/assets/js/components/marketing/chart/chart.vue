<template>
  <div class="container">

    <div class="row">

      <div class="col-md-3 align-self-center">
        <div class="input-group">
          <span class="input-group-addon">เริ่มต้น</span>
          <input
            type="date"
            class="form-control"
            v-model="start"
          >
        </div>
      </div>

      <div class="col-md-3  align-self-center">
        <div class="input-group">
          <span class="input-group-addon">สิ้นสุด</span>
          <input
            type="date"
            class="form-control"
            v-model="end"
          >
        </div>
      </div>

      <div class="col-md-3  align-self-center">
        <div class="input-group">
          <select
            type="date"
            class="form-control"
            v-model="type"
          >
            <option
              value="2"
              selected
            >ข้อมูลการขายบัตรแต่ละประเภท</option>
            <option value="3">จำนวนบัตรที่ขายได้</option>
            <option
              value="1"
              v-show="id == 1"
            >ข้อมูลการขายบัตรของแต่ละโซน</option>
          </select>
        </div>
      </div>

      <div class="col-md-3 align-self-center">
        <button
          class="btn btn-primary"
          @click="search()"
        >ค้นหา</button>
      </div>

    </div>

      <canvas id="chart"></canvas>

  </div>
</template>

<script>
export default {
  props: ["id"],
  mounted() {
    this.geTicketSaling();
  },

  data() {
    return {
      barGraph: [],
      start: moment()
        .startOf("week")
        .add("d", 1)
        .format("YYYY-MM-DD"),
      end: moment()
        .endOf("week")
        .add("d", 1)
        .format("YYYY-MM-DD"),
      type: 2
    };
  },

  methods: {
    getZoneSaling() {
      axios
        .post("/api/zoneSalingChart", {
          start: this.start,
          end: this.end
        })
        .then(res => {
          var data = res.data;
          this.createChart(
            data.labels,
            data.total,
            "รายงานการขายบัตรของแต่ละโซน",
            "รายได้(บาท)"
          );
        });
    },

    geTicketSaling() {
      axios
        .post("/api/ticketSalingChart", {
          start: this.start,
          end: this.end,
          id: this.id
        })
        .then(res => {
          var data = res.data;
          this.createChart(
            data.labels,
            data.total,
            "ข้อมูลการขายบัตรแต่ละประเภท",
            "รายได้(บาท)"
          );
        });
    },

    getTicketAmountSaling() {
      axios
        .post("/api/ticketAmountSalingChart", {
          start: this.start,
          end: this.end,
          id: this.id
        })
        .then(res => {
          var data = res.data;
          this.createChart(
            data.labels,
            data.total,
            "จำนวนบัตรที่ขายได้",
            "จำนวน(ใบ)"
          );
        });
    },

    search() {
      this.barGraph.destroy();
      if (this.type == 1) {
        this.getZoneSaling();
      }
      if (this.type == 2) {
        this.geTicketSaling();
      }
      if (this.type == 3) {
        this.getTicketAmountSaling();
      }
    },

    createChart(labels, total, header, barName) {
      var ctx = document.getElementById("chart").getContext("2d");
      this.barGraph = new Chart(ctx, {
        type: "bar",
        responsive: true,
        data: {
          labels: labels,
          datasets: [
            {
              label: barName,
              backgroundColor: "rgba(255, 99, 132, 0.5)",
              borderWidth: 1,
              borderColor: "rgba(255, 99, 132, 0.8)",
              data: total
            }
          ]
        },
        options: {
          title: {
            display: true,
            text: header,
            fontSize: 25
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true
                }
              }
            ]
          }
        }
      });
    }
  }
};
</script>

<style>
#box {
  width: 800px;
  height: 600px;
  margin: 0 auto;
}

#chart {
  height: 800px;
}
</style>
