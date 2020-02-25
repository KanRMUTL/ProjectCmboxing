<template>
  <div>
    <div class="row">

      <div class="col-md-2">
        <div class="input-group">
          <span class="input-group-addon">เริ่มต้น</span>
          <input
            type="date"
            class="form-control"
            v-model="start"
          >
        </div>
      </div>

      <div class="col-md-2 offset-md-2">
        <div class="input-group">
          <span class="input-group-addon">สิ้นสุด</span>
          <input
            type="date"
            class="form-control"
            v-model="end"
          >
        </div>
      </div>

      <div class="col-md-2 offset-md-2">
        <button
          class="btn btn-primary"
          @click="searchCourse"
        >ค้นหา</button>
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-body table-responsive">
            <table class="table table-striped table-hover center">
              <tbody>
                <tr>
                  <td>ชื่อคอร์ส</td>
                  <td>ชื่อลูกค้า</td>
                  <td>เบอร์โทรศัพท์ลูกค้า</td>
                  <td>ชื่อครูฝึก</td>
                  <td>วันที่ลงทะเบียน</td>
                  <td>วันที่เริ่มเรียน</td>
                </tr>
                <tr
                  v-for="(course, index) in courses"
                  :key="index"
                >
                  <td v-text="course.course_name"></td>
                  <td v-text="course.userFullname"></td>
                  <td v-text="course.phone_number"></td>
                  <td v-text="course.trainer_name"></td>
                  <td>{{ course.created_at | dateFormat}}</td>
                  <td>{{ course.start_course | dateFormat}}</td>
                </tr>
              </tbody>
            </table>
            <a class="btn btn-block btn-primary" :href="'/course/' + start + '/' + end " target="_blank">ออกรายงาน</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.searchCourse();
  },

  data() {
    return {
      start: moment()
        .startOf("week")
        .add("d", 1)
        .format("YYYY-MM-DD"),
      end: moment()
        .endOf("week")
        .add("d", 1)
        .format("YYYY-MM-DD"),
      courses: []
    };
  },

  methods: {
    searchCourse() {
      var data = {
        start: this.start,
        end: this.end
      };
      axios.post("/api/report_registerCourse", data).then(res => {
        res.data.forEach(item => {
          item.userFullname = item.user_firstname + "  " + item.user_lastname;
          this.courses.push(item);
        });
           this.courses = res.data;
      });
    }
  },

  filters: {
    dateFormat: function(value) {
      return moment(value).format("DD/MM/YYYY");
    },
  }
};
</script>

