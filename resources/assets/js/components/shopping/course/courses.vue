<template>
    <div>
        <h1>Training Muay Thai</h1>
        Our MuayThai Course
        <div class="row justify-content-md-center">
            <div class="card col-md-3 m-4 p-0" v-for="(course, index) in courses" :key="index">
                <div class="card-header">
                    <h4>{{ course.name }}</h4>
                    <span class="badge badge-success">{{ course.price | coursePrice }}฿</span>
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
    props: ['courseSelect', 'changeShowIndex'],

    mounted() {
        this.getAllCourse();
    },

    data() {
        return {
            courses: [],
            course: {
                id: '',
                name: '',
                price: '',
                detail:''
            },
            
        }
    },
    methods:{
        getAllCourse()
        {
            axios.get('/api/course').then(
                response => {
                    this.courses = response.data
                }
            )
        }, 

        onRegisterClick(course) {
            this.courseSelect(course)
            this.changeShowIndex()
        }
        
    },

    filters:{
        coursePrice(value){
            return new Intl.NumberFormat("en-IN", {
                maximumSignificantDigits: 3
            }).format(value);
        }
    }
   


}
</script>

