<template>
  <div>
    <form
      class="form-horizontal"
      method="post"
      @submit="resetPassword"
    >

      <div class="form-group">
        <label
          for="oldpassword"
          class="cols-sm-2 control-label"
        >Password</label>
        <div class="cols-sm-10">
          <div class="input-group">
            <span class="input-group-addon"><i
                class="fa fa-lock fa-lg"
                aria-hidden="true"
              ></i></span>
            <input
              v-model="form.oldPassword"
              type="password"
              class="form-control"
              name="password"
              id="oldpassword"
              placeholder="Enter your Password"
              required
            >
          </div>
          <div class="invalid-feedback">
            {{ errors.get('oldPassword') }}
          </div>
        </div>
      </div>

      <div class="form-group">
        <label
          for="password"
          class="cols-sm-2 control-label"
        >New Password</label>
        <div class="cols-sm-10">
          <div class="input-group">
            <span class="input-group-addon"><i
                class="fa fa-lock fa-lg"
                aria-hidden="true"
              ></i></span>
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
        <label
          for="confirm"
          class="cols-sm-2 control-label"
        >Confirm Password</label>
        <div class="cols-sm-10">
          <div class="input-group">
            <span class="input-group-addon"><i
                class="fa fa-lock fa-lg"
                aria-hidden="true"
              ></i></span>
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
          class="btn btn-general btn-white text-center"
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
</style>

