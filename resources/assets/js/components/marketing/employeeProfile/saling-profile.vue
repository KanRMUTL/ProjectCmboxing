<template>
  <div>
  
    <div class="col-md-12 divider">
        <div class="col-md-12 search-box">
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-addon">เริ่มต้น</span>
            <input type="date" class="form-control" v-model="start" >
          </div>
        </div>

        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-addon">สิ้นสุด</span>
            <input  type="date" class="form-control" v-model="end" >
          </div>
        </div>

        <div class="col-md-3 offset-md-1">
            <button class="btn btn-primary" @click="searchSalingProfile">ค้นหา</button>
        </div>
        </div>
      <div class="text-center">
      <div class="col-xs-12 col-sm-3 emphasis">
        <h4><strong>ค่าคอมมิชชั่นพนักงาน</strong></h4>
        <h2><strong>{{empCommission.total | moneyFormat}}</strong></h2>
        <h4><strong>บาท</strong></h4>
        <button
          class="btn btn-success btn-block"
          @click="setEmpCommission"
        ><span class="fa fa-list"></span>&emsp;ดูข้อมูล</button>
      </div>
      <div class="col-xs-12 col-sm-3 emphasis">
        <h4><strong>ค่าคอมมิชชั่นไกด์</strong></h4>
        <h2><strong>{{guideCommission.total | moneyFormat}}</strong></h2>
        <h4><strong>บาท</strong></h4>
        <button class="btn btn-danger btn-block" @click="setGuideCommission"><span class="fa fa-list"></span>&emsp;ดูข้อมูล</button>
      </div>
      <div class="col-xs-12 col-sm-3 emphasis">
        <h4><strong>รายได้นำเข้าสนาม</strong></h4>
        <h2><strong>{{incomes.total | moneyFormat}}</strong></h2>
        <h4><strong>บาท</strong></h4>
        <button class="btn btn-primary btn-block"  @click="setIncomeDetail"><span class="fa fa-list"></span>&emsp;ดูข้อมูล</button>
      </div>
      <div class="col-xs-12 col-sm-3 emphasis">
        <h4><strong>จำนวนบัตรทั้งหมด</strong></h4>
        <h2><strong>{{countTicket}}</strong></h2>
        <h4><strong>ใบ</strong></h4>
        <button class="btn btn-warning btn-block"  @click="setSalingDetail"><span class="fa fa-list"></span>&emsp;ดูข้อมูล</button>
      </div>
    </div>
    <div class="col-md-12">
      <commission :commissionDetail="commissionDetail" v-show="detail=='commission'"/>
      <income :incomeDetail="incomes.list" v-show="detail=='income'"/>
      <saling-detail :salingDetail="salingDetail" v-show="detail=='saling'"/>
    </div>
  </div>
  </div>
</template>

<script>
export default {
  props: ["id"],

  mounted() {
    this.getSalingProfile();
  },

  data() {
    return {
      start: '',
      end: '', 
      detail: '',
      incomes: [],
      empCommission: [],
      guideCommission: [],
      commissionDetail: [],
      salingDetail: [],
      countTicket: 0
    };
  },

  methods: {
    getSalingProfile() {
      axios.get("/api/userProfile/" + this.id).then(res => {
        this.incomes = res.data.income;
        this.empCommission = res.data.commission.emp;
        this.guideCommission = res.data.commission.guide;
        this.countTicket = res.data.countTicket[0]['total'] == null? 0 : res.data.countTicket[0]['total']
        this.salingDetail = res.data.saling;
      });
    },

    searchSalingProfile() {
      var data = {
        start: this.start,
        end: this.end
      }
      axios.post("/api/userProfile/" + this.id, data).then(res => {
        this.incomes = res.data.income;
        this.empCommission = res.data.commission.emp;
        this.guideCommission = res.data.commission.guide;
        this.countTicket = res.data.countTicket[0]['total'] == null? 0 : res.data.countTicket[0]['total']
        this.salingDetail = res.data.saling;
      });
      this.detail = ''
    },

    setEmpCommission() {
      this.commissionDetail = this.empCommission.list;
      this.detail = 'commission'
    }, 

    setGuideCommission() {
      this.commissionDetail = this.guideCommission.list;
      this.detail = 'commission'
    },

    setIncomeDetail() {
      this.detail = 'income'
    },
    
    setSalingDetail() {
      this.detail = 'saling'
    }
  },

  filters: {
    moneyFormat: function(Price) {
      return new Intl.NumberFormat("en-IN", {
        maximumSignificantDigits: 3
      }).format(Price);
    }
  }
};
</script>


<style>
  .search-box{
    margin : 5px 5px;
  }
</style>

