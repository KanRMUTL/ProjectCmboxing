<template>
  <div>
    <div
      class="row title-bar"
      style="padding: 0px;"
    >
      <div class="col-md-12">
        <h1
          class="wow fadeInUp"
          style="visibility: visible; animation-name: fadeInUp; font-size: 200%;"
        >
          Our MuayThai Course
        </h1>
         <div class="heading-border"></div>
      </div>
    </div>
    <h3 class="center"></h3>
    <div class="row justify-content-md-center">
      <div
        class="card col-md-3 m-4 p-0"
        v-for="(course, index) in courses"
        :key="index"
      >
        <div class="card-header">
          <div class="row">
            <div class="col-md-9">
              <h4>{{ course.name }}</h4>
            </div>
            <div class="col-md-2">
              <span class="badge badge-success">{{ course.price | coursePrice }}฿</span>
            </div>
          </div>
        </div>
        <div class="card-body">
          <p class="card-text">{{ course.detail }}</p>
          <button
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#modal"
            @click="onRegisterClick(course)"
          >
            Register Course
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["courseSelect", "changeShowIndex", "userId"],

  mounted() {
    this.getAllCourse();
  },

  data() {
    return {
      courses: [],
      course: {
        id: "",
        name: "",
        price: "",
        detail: ""
      }
    };
  },
  methods: {
    getAllCourse() {
      axios.get("/api/course").then(response => {
        this.courses = response.data;
      });
    },

    onRegisterClick(course) {
      if (this.userId != 0) {
        this.courseSelect(course);
        this.changeShowIndex();
      } else {
        swal({
          icon: "warning",
          title: "Please login for register course"
        });
      }
    }
  },

  filters: {
    coursePrice(value) {
      return new Intl.NumberFormat("en-IN", {
        maximumSignificantDigits: 3
      }).format(value);
    }
  }
};
</script>

<style>
.badge {
  font-size: 80%;
}
.center {
  text-align: center;
}
</style>

