<template>
  <div class="row">
    <h3 class="box-title">{{ header }}</h3>
    <div class="box-body">
      <table class="table table-striped table-hover center mt-2">
        <tbody>
          <tr>
            <td><strong>ประเภทบัตร</strong></td>
            <td><strong>จำนวนบัตร</strong></td>
            <td><strong>ประเภทการขาย</strong></td>
            <td><strong>ยอดรวม</strong></td>
            <td><strong>นำเข้าสนาม</strong></td>
            <td><strong>วันที่ขาย</strong></td>
          </tr>
          <tr
            v-for="item in incomeDetail"
            :key="item.id"
          >
            <td>{{ item.ticket_name}}</td>
            <td>{{ item.amount }}</td>
            <td>{{ item.sale_type_name }}</td>
            <td>{{ item.total }}</td>
            <td>{{ item.income }}</td>
            <td>{{ item.date_formated }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
     props : ['incomeDetail', 'header'],
}
</script>

