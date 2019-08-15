<template>
  <div id="cart">
    <div
      class="row title-bar"
      style="padding: 0;"
    >
      <div class="col-md-12">
        <h1
          class="wow fadeInUp"
          style="visibility: visible; animation-name: fadeInUp; font-size: 200%;"
        >
          My Course
        </h1>
        <div class="heading-border"></div>

      </div>
    </div>
    <table class="table table-hover" >
      <thead>
        <tr>
          <th class="text-center">Trainer</th>
          <th class="text-center">Course name</th>
          <th class="text-center">Register time</th>
          <th class="text-center">Started When</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(course, index) in courses"
          :key="index"
        >
          <td
            data-th="trainer"
            class="text-center"
            style="width: 50%"
          >
            <div class="row">
              <div class="col-sm-2 hidden-xs">
                <img
                  :src="'/shopping/img/trainer/' + course.trainerImg"
                  class="img-responsive"
                  style="width:100%"
                >
              </div>
              <div class="col-sm-10 prod-desc">
                <h6 class="nomargin">{{course.trainerName}}</h6>
                <p>{{ course.trainerDetail }}</p>
              </div>
            </div>
          </td>

          <td class="text-center" data-th="course-name">
            <span class="badge badge-primary" style="font-size: 120%;">
              {{course.courseName}}
            </span>
          </td>

          <td class="text-center">{{course.created_at | dateFormat}}</td>

          <td class="text-center">{{course.start_course | dateFormat}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["id"],

  mounted() {
    this.getMyCourse();
  },

  data() {
    return {
      courses: []
    };
  },

  methods: {
    getMyCourse() {
      axios
        .get("/api/registerCourse/" + this.id)
        .then(res => (this.courses = res.data));
    }
  },

  filters: {
    dateFormat: function(value) {
      return moment(value).format("DD/MM/YYYY");
    }
  }
};
</script>

<style>
  td {
      vertical-align: middle !important;
  }
</style>
