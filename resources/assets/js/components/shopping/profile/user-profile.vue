<template>
  <div>
    <div class="row">
      <div class="col-md-12 main-login main-center pt-5 mt-5">

        <form
          class="form-horizontal"
          method="post"
          @submit="update"
        >
          <div class="row justify-content-md-center mt-3">
            <div class="avatar">
              <img
                :src="'/images/userImg/' + customer.img"
                class="img-circle"
              >
              <h3 class="title mt-2">
                {{ fullname }}
              </h3>
            </div>

          </div>

          <div class="row">
           
            <div class="form-group col-md-6">
              <label class="cols-sm-2 control-label">Username</label>
              <div class="cols-md-6">
                <div class="input-group">
                  <span class="input-group-addon"><i
                      class="fa fa-user fa"
                      aria-hidden="true"
                    ></i></span>
                  <input
                    type="text"
                    class="form-control"
                    v-model="customer.username"
                    disabled
                  >
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label class="cols-sm-2 control-label">First Name</label>
              <div class="cols-md-6">
                <div class="input-group">
                  <span class="input-group-addon"><i
                      class="fa fa-user fa"
                      aria-hidden="true"
                    ></i></span>
                  <input
                    type="text"
                    class="form-control"
                    v-model="customer.firstname"
                  >

                </div>
                <div class="invalid-feedback">
                  {{errors.get('firstname')}}
                </div>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label class="cols-sm-2 control-label">Last Name</label>
              <div class="cols-md-6">
                <div class="input-group">
                  <span class="input-group-addon"><i
                      class="fa fa-user fa"
                      aria-hidden="true"
                    ></i></span>
                  <input
                    type="text"
                    class="form-control"
                    v-model="customer.lastname"
                  >
                </div>
                <div class="invalid-feedback">
                  {{errors.get('lastname')}}
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="cols-sm-2 control-label">Email</label>
                <div class="cols-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i
                        class="fa fa-envelope fa"
                        aria-hidden="true"
                      ></i></span>
                    <input
                      type="text"
                      class="form-control"
                      v-model="customer.email"
                    >
                  </div>
                  <div class="invalid-feedback">
                    {{errors.get('email')}}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="cols-sm-2 control-label">Phone</label>
                <div class="cols-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i
                        class="fa fa-phone fa-lg"
                        aria-hidden="true"
                      ></i></span>
                    <input
                      type="number"
                      class="form-control"
                      v-model="customer.phone_number"
                    >
                  </div>
                  <div class="invalid-feedback">
                    {{errors.get('phone_number')}}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="cols-sm-2 control-label">Address</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <textarea
                  id="address"
                  class="form-control"
                  rows="5"
                  v-model="customer.address"
                ></textarea>
              </div>
               <div class="invalid-feedback">
                {{errors.get('address')}}
                </div>
            </div>
          </div>

          <div class="form-group ">
            <button
              type="submit"
              class="btn btn-primary btn-block text-center"
            >Update</button>
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

  name: "user-profile",

  mounted() {
    this.getDetail();
  },

  data() {
    return {
      customer: {
        id: this.id,
        firstname: "",
        lastname: "",
        username: "",
        email: "",
        phone_number: "",
        address: "",
        img: "",
        password: "",
        role: ""
      },
      fullname: ""
    };
  },

  methods: {
    getDetail() {
      axios.get("/api/customer/" + this.id).then(res => {
        this.customer = res.data;
        this.fullname = this.customer.firstname + "\t" + this.customer.lastname;
      });
    },

    update(e) {
      e.preventDefault();
      axios
        .post("/api/customer/" + this.id, this.customer)
        .then(res => {
          swal("Update Profile Complete", "", "success");
        })
        .catch(error => {
          this.errors.record(error.response.data);
          swal("Please Check Your Input", "", "warning");
        });
    }
  }
};
</script>

<style>
.invalid-feedback {
  display: block;
}
</style>


