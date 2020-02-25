<template>
    <div>
    <div class="row">

      <div class="col-md-2">
        <div class="input-group">
          <span class="input-group-addon">เริ่มต้น</span>
          <input
            type="date"
            class="form-control"
            v-model="rang.start"
          >
        </div>
      </div>

      <div class="col-md-2 offset-md-2">
        <div class="input-group">
          <span class="input-group-addon">สิ้นสุด</span>
          <input
            type="date"
            class="form-control"
            v-model="rang.end"
          >
        </div>
      </div>

      <div class="col-md-2 offset-md-2">
        <button
          class="btn btn-primary"
          @click="setTickets(rang)"
        >ค้นหา</button>
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-body table-responsive">
            <table class="table table-striped table-hover center">
              <tbody>
                <tr>
                  <td>รหัสการขาย</td>
                  <td>ชื่อลูกค้า</td>
                  <td>ยอดขาย</td>
                  <td>วันที่เข้ามาชมมวย</td>
                  <td>วันที่ซื้อ</td>
                </tr>
                <tr 
                  v-for="(ticket, index) in tickets" 
                  :key="index" 
                  @click="setTicketSelected(ticket)"
                  data-toggle="modal" 
                  data-target="#ticket-detail-modal"
                >
                  <td>{{ticket.id}}</td>
                  <td>{{`${ticket.firstname}   ${ticket.lastname}`}}</td>
                  <td class="right">{{ ticket.total }}</td>
                  <td>{{ ticket.visit | dateFormat }}</td>
                  <td>{{ ticket.created_at | dateFormat }}</td>
                </tr>
              </tbody>
            </table>
            <a :href="reportLink" target="_blank" class="btn btn-block btn-primary">ออกรายงาน</a>
          </div>
        </div>
      </div>
    </div>
    <ticket-online-detail/>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import axios from 'axios'

export default {
  data() {
    return {
      rang: {
         start: moment()
        .startOf("week")
        .add("d", 1)
        .format("YYYY-MM-DD"),
      end: moment()
        .endOf("week")
        .add("d", 1)
        .format("YYYY-MM-DD"),
      }
    }
  },
  mounted () {
    this.setTickets(this.rang)
  },
  methods: {
    ...mapActions('ticketOnline', {
      setTickets: 'setTickets',
      setTicketSelected: 'setTicketSelected'
    })
  },  
  computed: {
    ...mapState('ticketOnline',{
      tickets: state => state.tickets,
      ticketSelected: state => state.ticket
    }),
    reportLink(){
      return `saleTicketOnline/${this.rang.start}/${this.rang.end}`
    }
  },
  filters: {
    dateFormat: function(value) {
      return moment(value).format("DD/MM/YYYY");
    }
  }
}
</script>

<style>

</style>