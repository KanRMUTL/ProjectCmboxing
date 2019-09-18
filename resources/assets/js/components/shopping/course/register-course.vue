<template>
  <div>

    <div class="row">
      <div class="col-md-6 m-4 p-0">
        <h5>1. Your Course</h5>
        <div class="card">
          <div class="card-header">
            <h4>{{ course.name }}</h4>
          </div>
          <div class="card-body">
            <p class="card-text">{{ course.detail }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 m-4 p-0">
        <h5>2. Started when</h5>
        <input
          type="date"
          :min="startCourse"
          class="form-control"
          v-model="startCourse"
        >
      </div>
    </div>

    <div class="row justify-content-md-center">
      <div class="col-md-12">
        <h5>3. Choose trainer</h5>
      </div>
      <div
        class="card-group col-md-3 m-4 p-0"
        v-for="(trainer, index) in trainers"
        :key="index"
      >
        <div class="card">
          <img
            class="card-img-top"
            :src="'/shopping/img/trainer/'+trainer.img"
            alt="Card image cap"
          >
          <div class="card-body">
            <label
              class="radio"
              @click="onTrainerClick(trainer)"
            >
              <h5 class="card-title">{{trainer.name}}</h5>
              <input
                type="radio"
                name="trainer"
              >
              <span class="checkround"></span>
            </label>
            <hr>
            <p class="card-text">{{trainer.detail}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-md-center">

      <div class="col-md-4">
        <button
          class="btn btn-general btn-white btn-block"
          @click="createOrder(parseInt(course.price), register)"
          v-show="showCheckoutBtn"
        >
          <i class="fa fa-paypal"></i> Checkout
        </button>
      </div>

    </div>
    <div class="row justify-content-md-center">
      <div
        id="paypal-button"
        class="col-md-4"
      ></div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["course", "trainers", "userId", "price"],

  mounted() {
    $(".your-checkbox").prop("indeterminate", true);

    $("#myModal").on("shown.bs.modal", function() {
      $("#myInput").trigger("focus");
    });
  },

  data() {
    return {
      trainerSelected: [],
      startCourse: moment().format('YYYY-MM-DD'),
      showCheckoutBtn: true
    };
  },

  methods: {
    onTrainerClick(trainer) {
      this.trainerSelected = trainer;
    },

    register() {
      let data = {
        userId: this.userId,
        courseId: this.course.id,
        startCourse: this.startCourse,
        trainerId: this.trainerSelected.id
      };
      axios.post("/api/registerCourse", data).then(res => {
        swal({
          title: "Register Complete",
          icon: "success"
        }).then(setTimeout(()=>{
          window.location = `/course/${this.userId}`
        }, 3000));
      });
    },

    createOrder(total, register) {
      this.showCheckoutBtn = false;
      paypal
        .Buttons({
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [
                {
                  amount: {
                    value: total
                  }
                }
              ]
            });
          },
          onApprove: function(data, actions) {
            // console.table(data)
            return actions.order.capture().then(function(details) {
              try {
                return fetch("/api/payment", {
                  method: "post",
                  headers: {
                    "content-type": "application/json"
                  },
                  body: JSON.stringify({
                    orderID: data.orderID
                  })
                }).then(data => {
                  register();
                });
              } catch (e) {
                // console.log(e)
              }
            });
          }
        })
        .render("#paypal-button");
    }
  }
};
</script>

<style>
/* The radio */
.radio {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 20px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.radio input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkround {
  position: absolute;
  top: 6px;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #fff;
  border-color: #1d79f1;
  border-style: solid;
  border-width: 2px;
  border-radius: 50%;
}

/* When the radio button is checked, add a blue background */
.radio input:checked ~ .checkround {
  background-color: #fff;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkround:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.radio input:checked ~ .checkround:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.radio .checkround:after {
  left: 2px;
  top: 2px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #1d79f1;
}

/* The check */
.check {
  display: block;
  position: relative;
  padding-left: 25px;
  margin-bottom: 12px;
  padding-right: 15px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.check input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 3px;
  left: 0;
  height: 18px;
  width: 18px;
  background-color: #fff;
  border-color: #1d79f1;
  border-style: solid;
  border-width: 2px;
}

/* When the checkbox is checked, add a blue background */
.check input:checked ~ .checkmark {
  background-color: #fff;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.check input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.check .checkmark:after {
  left: 5px;
  top: 1px;
  width: 5px;
  height: 10px;
  border: solid;
  border-color: #1d79f1;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

.cust-btn {
  margin-bottom: 10px;
  background-color: #1d79f1;
  border-width: 2px;
  border-color: #1d79f1;
  color: #fff;
}
.cust-btn:hover {
  border-color: #1d79f1;
  background-color: #fff;
  color: #1d79f1;
  border-radius: 20px;
  transform-style: 2s;
}
</style>
