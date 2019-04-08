<template>
<div>
    <courses 
        :courseSelect="courseSelect" 
        :changeShowIndex="changeShowIndex" 
        v-show="showIndex" />
    <trainer 
        :trainers="trainers"
        v-show="showIndex" />
    <register-course 
        :userId="id"
        :course="courseSelected"
        :trainers="trainers"
        v-show="!showIndex" />
</div>
</template>

<script>
export default {
    props:['id'],
    mounted() {
        this.getAllTrainer();
    },

    data() {
        return {
            courseSelected:[],
            trainers : [],
            showIndex: 1
        }
    },

    methods: {
        courseSelect(course) {  
            this.courseSelected = course
        },

        changeShowIndex() {
            this.showIndex =  this.showIndex == 1? 0: 1
        },

        getAllTrainer()
        {
            axios.get('/api/trainer').then(
                response => {
                    this.trainers = response.data;
                    console.log(this.trainers)
                }
            )
        }, 

    }

    
}
</script>

