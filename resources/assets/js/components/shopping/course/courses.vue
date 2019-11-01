<template>
  <div>
    <div class="row justify-content-center pt-3">
      <div class="col-md-12 heading-section ftco-animate text-center fadeInUp ftco-animated">
        <h2 class="mb-4">Our Muay Thai Course</h2>
      </div>
    </div>

    <div class="row justify-content-center">
      <div
        class="col-md-4 col-sm-6"
        v-for="(course, index) in courses"
        :key="index"
      >
        <div class="package-program ftco-animate fadeInUp ftco-animated">
          <div class="img" style="background-image: url(/shopping/img/about/course_cover.jpg);"></div>
          <div class="text mt-4">
            <h3 class="price">{{ course.name }}</h3>
            <p class="pt-2">
              {{ course.detail }}
            </p>

            <div class="d-flex mt-4 ">
              <p class="price">{{ course.price | coursePrice }}฿</p>
              <p class="btn-custom float-right">
                <a href="#" @click="onRegisterClick(course)">Enroll Now</a>
              </p>
            </div>
          </div>
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

