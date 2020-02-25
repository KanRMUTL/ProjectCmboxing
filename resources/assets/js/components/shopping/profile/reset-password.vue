<template>
  <div>
     <div class="row justify-content-center pt-5 mt-5">
      <div class="col-md-12 heading-section ftco-animate text-center fadeInUp ftco-animated">
        <h2 class="mb-4">Reset Password</h2>
      </div>
    </div>
    <form
      class="form-horizontal col-md-6 "
      method="post"
      @submit="resetPassword"
    >

      <div class="form-group">
        <div class="cols-sm-10">
          <div class="input-group">
            <input
              v-model="form.oldPassword"
              type="password"
              class="form-control"
              name="password"
              id="oldpassword"
              placeholder="Enter Current Password"
              required
            >
          </div>
          <div class="invalid-feedback">
            {{ errors.get('oldPassword') }}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="cols-sm-10">
          <div class="input-group">
           <input
              v-model="form.password"
              type="password"
              class="form-control"
              name="password"
              id="password"
              placeholder="Enter new Password"
              required
            >
          </div>
          <div class="invalid-feedback">
            {{ errors.get('password') }}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="cols-sm-10">
          <div class="input-group">
            <input
              v-model="form.password_confirmation"
              type="password"
              class="form-control"
              name="confirm"
              id="confirm"
              placeholder="Confirm your Password"
              required
            >
          </div>
          <div class="invalid-feedback">
            {{ errors.get('password_confirmation') }}
          </div>
        </div>
      </div>

      <div class="form-group ">
        <button
          type="submit"
          class="btn btn-primary text-center btn-block"
        >Reset Password</button>
      </div>

    </form>
  </div>
</template>
<script>
import mixin from "./../../mixin";
export default {
  mixins: [mixin],

  props: ["id"],

  data() {
    return {
      form: {
        oldPassword: "",
        password: "",
        password_confirmation: ""
      }
    };
  },

  methods: {
    resetPassword(e) {
      e.preventDefault();
      axios
        .post("/api/passwordreset/" + this.id, this.form)
        .then(res => {
          res.data.status == false
            ? swal(res.data.message, "Please try again", "warning")
            : swal("Reset your password success", "", "success").then(
                setTimeout(function() {
                  window.location = "/";
                }, 3500)
              );
        })
        .catch(error => {
          this.errors.record(error.response.data);
          this.errors.warning("Can't reset your password", "please try again");
        });
    }
  }
};
</script>
<style>
.invalid-feedback {
  display: block;
}
form {
  margin: 0 auto;
  margin-top: 8px;
}
h3 {
  margin-top: 10px;
  text-align: center;
}
</style>

