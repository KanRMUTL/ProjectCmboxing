<template>
  <div>
    <div class="row justify-content-center pt-5 mt-5">
      <div class="col-md-12 heading-section ftco-animate text-center fadeInUp ftco-animated">
        <h2 class="mb-4">My Course</h2>
      </div>
    </div>
    <table class="table table-hover">
      <thead class="thead-primary">
        <tr class="text-center">
          <th>Trainer</th>
          <th>Course name</th>
          <th>Register time</th>
          <th>Started When</th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="text-center bg-overay"
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
                <span class="nomargin">{{course.trainerName}}</span>
                <p>{{ course.trainerDetail }}</p>
              </div>
            </div>
          </td>

          <td
            class="text-center"
            data-th="course-name"
          >
            <span
              class="badge badge-primary"
              style="font-size: 120%;"
            >
              {{course.courseName}}
            </span>
          </td>

          <td class="text-center"><span>{{course.created_at | dateFormat}}</span></td>

          <td class="text-center"><span>{{course.start_course | dateFormat}}</span></td>
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
