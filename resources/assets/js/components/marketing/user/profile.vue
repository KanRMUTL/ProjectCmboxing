<template>
  <div>
    <div class="container">

      <div class="row">

        <!-- edit form column -->
        <div class="col-md-9 personal-info">

          <div class="row">
            <div class="col">
              <img
                :src="'/images/userImg/'+user.img"
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
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">ที่อยู่</label>
              <div class="col-lg-8">
                <textarea
                  class="form-control"
                  v-model="user.address"
                ></textarea>
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
export default {
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
      formData.append("phoneNumber", this.user.phone_number);
      formData.append("address", this.user.address);
      formData.append("idCard", this.user.id_card);
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
        })
      
    },

     handleFileUpload(){
          try { this.file = this.$refs.file.files[0]; }
          catch (e) {}
    },
  }
};
</script>