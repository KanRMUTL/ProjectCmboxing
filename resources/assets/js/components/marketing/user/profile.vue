<template>
  <div>
    <div class="container">

      <div class="row">

        <!-- edit form column -->
        <div class="col-md-1"></div>
        <div class="col-md-9  personal-info">

          <div class="row">
            <div class="col">
              <img
                :src="'/images/userImg/' + user.img"
                class="img-circle img-responsive"
                style="width: 20%; margin: 0 auto; margin-bottom: 8px;"
              >
            </div>
          </div>

          <form
            class="form-horizontal"
            role="form"
          >
            <div class="form-group">
              <label class="col-lg-3 control-label">Username</label>
              <div class="col-lg-8">
                <input
                  class="form-control"
                  type="text"
                  v-model="user.username"
                  disabled
                >
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">ชื่อ</label>
              <div class="col-lg-8">
                <input
                  class="form-control"
                  type="text"
                  v-model="user.firstname"
                >
                <div class="invalid-feedback">
                  {{this.errors.get('firstname')}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">นามสกุล</label>
              <div class="col-lg-8">
                <input
                  class="form-control"
                  type="text"
                  v-model="user.lastname"
                >
                <div class="invalid-feedback">
                  {{this.errors.get('lastname')}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">หมายเลขบัตรประชาชน</label>
              <div class="col-lg-8">
                <input
                  class="form-control"
                  type="number"
                  v-model="user.id_card"
                >
                <div class="invalid-feedback">
                  {{this.errors.get('id_card')}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email</label>
              <div class="col-lg-8">
                <input
                  class="form-control"
                  type="email"
                  v-model="user.email"
                >
                <div class="invalid-feedback">
                  {{this.errors.get('email')}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">เบอร์ติดต่อ</label>
              <div class="col-lg-8">
                <input
                  class="form-control"
                  type="number"
                  v-model="user.phone_number"
                >
                <div class="invalid-feedback">
                  {{this.errors.get('phone_number')}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">ที่อยู่</label>
              <div class="col-lg-8">
                <textarea
                  class="form-control"
                  v-model="user.address"
                ></textarea>
                <div class="invalid-feedback">
                  {{this.errors.get('address')}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">รูปประจำตัว</label>
              <div class="col-lg-8">
               <input type="file" class="form-control" id="file" ref="file" v-on:change="handleFileUpload()">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8 col-md-offset-3  ">
                <span
                  class="btn btn-primary btn-block"
                  @click="updateUser"
                >บันทึก</span>
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
import mixin from '../../mixin'

export default {
  mixins: [mixin],

  props: ["id"],
  
  mounted() {
    this.getUserDetail();
  },

  data() {
    return {
      user: [],
      file: ''
    };
  },

  methods: {
    getUserDetail() {
      axios.get("/api/user/" + this.id).then(response => {
        this.user = response.data[0];
      });
    },

    updateUser() {
      let formData = new FormData();

      formData.append("firstname", this.user.firstname);
      formData.append("lastname", this.user.lastname);
      formData.append("email", this.user.email);
      formData.append("phone_number", this.user.phone_number);
      formData.append("address", this.user.address);
      formData.append("id_card", this.user.id_card);
      formData.append('img', this.file);

      axios
        .post("/api/user/" + this.id, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          document.getElementById('file').value = '';
          this.getUserDetail();
          swal({
            title: "อัพเดทข้อมูลเรียบร้อย",
            icon: "success"
          });
          this.errors.clear()
        })
        .catch(error => {
          this.errors.record(error.response.data)
          this.errors.warning('ไม่สามารถบันทึกข้อมูลได้', 'กรุณาลองใหม่อีกครั้ง')
        })
      
    },

     handleFileUpload(){
          try { this.file = this.$refs.file.files[0]; }
          catch (e) {}
    },
  }
};
</script>