<template>
    <div>

        <div class="row">
            <div class="col-md-3 m-4 p-0"> 
                <h5>1.Your Course</h5>
                <div class="card">
                    <div class="card-header">
                        <h4>{{ course.name }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ course.detail }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-4 p-0">
                <h5>2.Started whern</h5>
                <input type="date" class="form-control" v-model="startCourse">
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-12"><h5>Choose trainer</h5></div>
            <div class="card-group col-md-3 m-4 p-0" v-for="(trainer, index) in trainers" :key="index">
                <div class="card">
                    <img class="card-img-top" :src="'/shopping/img/trainer/'+trainer.img" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{trainer.name}}</h5>
                        <p class="card-text">{{trainer.detail}}</p>
                        <input type="radio" name="trainer" @click="onTrainerClick(trainer)">
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-2 col-md-offset-10">
                <button class="btn btn-success" @click="register">Register</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['course','trainers','userId'],

    mounted() {
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    },
    data() {
        return {
            trainerSelected: [],
            startCourse: '',
        }
    },

    methods: {
       onTrainerClick(trainer) {
           this.trainerSelected = trainer
       },

       register() {
           let data = {
               userId: this.userId,
               courseId: this.course.id,
               startCourse: this.startCourse,
               trainerId: this.trainerSelected.id
           }
           axios.post('/api/registerCourse', data).then(
               res => {
                   swal({
                       title: 'Register Complete',
                       icon: 'success'
                   });
               }
           )
       },
    }
}
</script>

