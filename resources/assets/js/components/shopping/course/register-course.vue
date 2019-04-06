<template>
    <div>
       

                        <div class="row">
                            <div class="card col-md-3 m-4 p-0">
                                <div class="card-header">
                                    <h4>{{ course.name }}</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ course.detail }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="date" v-model="courseStart">
                            </div>
                        </div>
<!--                             
                        <div class="row justify-content-md-center">
                            <div class="col-md-12"><h3>Our trainer</h3></div>
                            <div class="card-group col-md-3 m-4 p-0" v-for="(trainer, index) in trainers" :key="index">
                                <div class="card">
                                    <img class="card-img-top" :src="'/shopping/img/trainer/'+trainer.img" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{trainer.name}}</h5>
                                        <p class="card-text">{{trainer.detail}}</p>
                                        <input type="radio" @click="onTrainerClick(trainer)">
                                    </div>
                                </div>
                            </div>
                        </div> -->

               
    </div>
</template>

<script>
export default {
    props:['course'],

    mounted() {
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    },
    data() {
        return {
            trainerSelected: [],
            courseStart: '',
        }
    },

    methods: {
       
    }
}
</script>

