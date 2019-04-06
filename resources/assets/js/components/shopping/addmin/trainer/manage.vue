<template>
    <div>
        <form class="was-validated">
            <div class="row mt-4">
                <div class="col-md-6 form-group">
                    <label for="name">ชื่อครูสอนมวยไทย</label>
                    <input type="text" class="form-control" id="name" v-model="trainer.name">
                </div>
                     <div class="col-md-6 form-group">
                         <label for="img"></label>
                         <input type="file" class="form-control" id="img" @change="onFileSelected" >
                     </div>
                <div class="col-md-12 form-group">
                    <label for="detail">รายละเอียด</label>
                    <textarea class="form-control" id="detail" v-model="trainer.detail"></textarea>
                </div>
                <div class="col-md-offset-4 col-md-6">
                    <span class="btn btn-primary btn-block" @click="save">บันทึก</span>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return{
            trainer :{
                name: '',
                img: '',
                detail: ''
            }
        }
    },

    methods: {
        onFileSelected(event){
            this.trainer.img = event.target.files[0]
        },

        save(){
            this.insertTrainer()
        },  

        insertTrainer(){
            const fd = new FormData();
            fd.append('image', this.trainer.img, this.trainer.img.name)
            var data = {
                name: this.trainer.name,
                img: this.trainer.img,
                detail: this.trainer.detail
            }
            axios.post('/api/trainer', data).then(
                res => {
                    console.log(res)
                }
            )
        }

    }
}
</script>

