<template>
  <div class="container">
       <h1 class="text-center">เปลี่ยนรหัสผ่าน</h1>
    <div class="row">
      <div class="col-md-12 personal-info">
           <form @submit="resetPassword" class="form-horizontal" role="form">
               <div class="form-group">
                    <label class="col-lg-3 control-label">รหัสผ่านเก่า</label>
                    <div class="col-lg-8">
                         <input type="password" class="form-control" v-model="form.oldPassword">
                         <div class="invalid-feedback">
                              {{errors.get('oldPassword')}}
                         </div>
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-lg-3 control-label">รหัสผ่านใหม่</label>
                    <div class="col-lg-8">
                         <input type="password" class="form-control" v-model="form.password">
                         <div class="invalid-feedback">
                              {{errors.get('password')}}
                         </div>
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-lg-3 control-label">ยืนยันรหัสผ่านใหม่</label>
                    <div class="col-lg-8">
                         <input type="password" class="form-control" v-model="form.password_confirmation">
                         <div class="invalid-feedback">
                              {{errors.get('password_confirmation')}}
                         </div>
                    </div>
               </div>
               <div class="form-group">
                     <label class="col-lg-3 control-label"></label>
                    <button type="submit" class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
               </div>
           </form>
      </div>
    </div>
  </div>
</template>

<script>
import mixin from "../../mixin";

export default {
  mixins: [mixin],

  props: ["id"],

  data() {
       return {
            form: {
                 oldPassword: '',
                 password: '',
                 password_confirmation: ''
            }
       }
  },

  methods: {
       resetPassword(e) {
          e.preventDefault()
          axios.post('/api/passwordreset/' + this.id , this.form)
          .then(res => {
               console.log(res.data)
               res.data.status == false 
               ? swal(res.data.message, 'กรุณาป้อนรหัสผ่านเก่าให้ถูกต้อง', 'warning') 
               : swal('เปลี่ยนรหัสผ่านสำเร็จ', '','success').then(window.location = '/dashboard')
          })
          .catch(error => {
               this.errors.record(error.response.data)
               this.errors.warning('ไม่สามารถเปลี่ยนรหัสผ่านได้', 'กรุณาลองใหม่อีกครั้ง')
          })
       }
  },
};
</script>
