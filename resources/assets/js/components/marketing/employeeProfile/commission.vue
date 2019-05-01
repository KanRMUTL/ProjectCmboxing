<template>
<div class="row">
  <div class="box-body">
    <table class="table table-striped table-hover center mt-2">
      <tbody>
        <tr>
          <td><strong>ประเภทบัตร</strong></td>
          <td><strong>จำนวนบัตร</strong></td>
          <td><strong>ค่าคอมมิชชั่น</strong></td>
          <td><strong>วันที่ขาย</strong></td>
        </tr>
        <tr v-for="item in commissionDetail" :key="item.id">
             <td>{{ item.ticket_name }}</td>
             <td>{{ item.amount }}</td>
             <td>{{ item.commission }}</td>
             <td>{{ item.date_formated }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
export default {
  props: ["commissionDetail"]
};
</script>

<style>
     .box-body{
          margin-top: 2%;
     }
</style>

