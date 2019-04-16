<template>
    <div>
        <h1>My Course</h1>
        <table class="table table-hover">
            <thead>
            <tr class="bg-info text-white">
                <th>Started When</th>
                <th>Course name</th>
                <th>Trainer</th>
                <th>Register time</th>
            </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(course, index) in courses"
                    :key="index"
                    :class="{'table-info': index % 2 == 0}"
                >   
                <td>{{course.start_course}}</td>
                <td>{{course.courseName}}</td>
                <td>{{course.trainerName}}</td>
                <td>{{course.created_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['id'],

    mounted() {
        this.getMyCourse()
    },

    data() {
        return {
            courses: []
        }
    },

    methods: {
        getMyCourse() {
            axios.get('/api/registerCourse/' + this.id)
            .then(res => this.courses = res.data)
        }
    }
}
</script>

