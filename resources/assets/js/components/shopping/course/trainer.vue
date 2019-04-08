<template>
    <div class="row justify-content-md-center">
        <div class="col-md-12"><h3>Our trainer</h3></div>
       <div class="card-group col-md-3 m-4 p-0" v-for="(trainer, index) in trainers" :key="index">
        <div class="card">
            <img class="card-img-top" :src="'/shopping/img/trainer/'+trainer.img" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">{{trainer.name}}</h5>
            <p class="card-text">{{trainer.detail}}</p>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['trainers'],

    data() {
        return {
            
        }
    },
    methods:{
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

<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style>