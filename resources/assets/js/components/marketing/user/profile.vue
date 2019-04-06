<template>
    <div>
        <div class="container">
    
	<div class="row">
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Username</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" v-model="user.username" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">ชื่อ</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" v-model="user.firstname">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">นามสกุล</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" v-model="user.lastname">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label" >หมายเลขบัตรประชาชน</label>
            <div class="col-lg-8">
              <input class="form-control" type="number" v-model="user.id_card">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label" >Email</label>
            <div class="col-lg-8">
              <input class="form-control" type="email" v-model="user.email">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">เบอร์ติดต่อ</label>
            <div class="col-lg-8">
              <input class="form-control" type="number" v-model="user.phone_number">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">เบอร์ติดต่อ</label>
            <div class="col-lg-8">
              <textarea class="form-control" v-model="user.address"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-8 col-md-offset-3  ">
              <span class="btn btn-primary btn-block" @click="updateUser">บันทึก</span>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
    </div>
</template>
<script>
export default {
    props: ['id'],
    mounted() {
      this.getUserDetail();
    },

    data() {
        return {
            user: []
        }
    },

    methods: {
      getUserDetail() {
        axios.get('/api/user/'+this.id).then(
          response =>{
            this.user = response.data[0];
          }
        );
      },

      updateUser(){
        var data = {
          firstname: this.user.firstname,
          lastname: this.user.lastname,
          email: this.user.email,
          phoneNumber: this.user.phone_number,
          address: this.user.address,
          idCard: this.user.id_card
        }
        axios.put('/api/user/'+this.id, data).then(
          response =>{
            swal({
              title: "อัพเดทข้อมูลเรียบร้อย",
              icon : 'success'
            })
          }
        )
      }
    }
}
</script>