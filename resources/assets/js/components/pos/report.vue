<template>
    <div>
        <div class="box-body no-padding">
        <table class="table table-striped" style="text-align:center;">
          <tbody style="text-align:center;">
            <tr style="text-align:center;">
              <td>รหัสการขาย</td>
              <td>ยอดรวม</td>
              <td>เวลา</td>
              <td>ผู้ขาย</td>
              <td>รายละเอียด</td>
            </tr>
            <tr v-for="bill in bills" :key="bill.id">
                <td v-text="bill.id"></td>
                <td v-text="moneyFormat(bill.total)"></td>
                <td v-text="showDateTime(bill.created_at)"></td>
                <td v-text="fullname(bill)"></td>
                <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" @click="getSaleDetail(bill)">รายละเอียด</button>
                </td>
            </tr>
          </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                 <th>ราคา</th>
                                 <th>จำนวน</th>
                                 <th>รวม</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr v-for="saleDetail in saleDetails">
                                 <td v-text="saleDetail.name"></td>
                                 <td v-text="moneyFormat(saleDetail.price)"></td>
                                 <td v-text="saleDetail.amount"></td>
                                 <td v-text="moneyFormat(saleDetail.total)"></td>
                             </tr>
                             <tr class="table-success">
                                <th colspan="3" align="center">ทั้งหมด</th>
                                <th v-text="moneyFormat(saleDetailsTotal)"></th>
                             </tr>
                         </tbody>
                     </table>
                </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
        </div>

      </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getBills();

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })

    },
    data() {
        return {
            bills: [],
            saleDetails: [],
            saleDetailsTotal: 0,
            bill: {
                id: 0,
                total: 0,
                created_at: 0,
                firstname: '',
                lastname:''
            }
        }
    },

    methods: {
        getBills() {
            axios.get('/api/report').then(
                response=>{
                    this.bills = response.data;
                }
            );
        },

        getSaleDetail(bill){
            axios.get('/api/report/'+bill.id).then(
                response=>{
                    this.saleDetails = response.data;
                    this.saleDetailsTotal = bill.total;
                    console.log(this.saleDetails);
                }
            );
        },
        showDateTime(dateTime){
            var d = new Date(dateTime);
            var day = d.getDay();
            var m = d.getMonth();
            var y = d.getFullYear();
            var h = d.getHours();
            var minutes = d.getMinutes();
            var sec = d.getSeconds();
            return day + '/' + m + '/' + y + ' ' + h + ':' + minutes + ':' + sec;
        },

        moneyFormat(money) {
        return new Intl.NumberFormat("en-IN", {
            maximumSignificantDigits: 3
        }).format(money);
        },

        fullname(bill){
            return bill.firstname + '    ' + bill.lastname;
        },
    },

    computed: {
        
    },
}
</script>