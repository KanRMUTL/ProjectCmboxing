<template>
    <div>
          <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title" id="exampleModalLabel">จัดการสินค้า</h3>
                        </div><!-- End Header -->
                        <!-- Body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">ชื่อสินค้า</label>
                                    <input type="text" class="form-control" id="name" v-model="product.name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="barcode">บาร์โค้ด</label>
                                    <input type="number" class="form-control" id="barcode" v-model="product.barcode">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="unit">หน่วยเรียก</label>
                                    <input type="text" class="form-control" id="unit" v-model="product.unit">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="amount">จำนวนคงเหลือ</label>
                                    <input type="number" class="form-control" id="amount" v-model="product.amount">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="price">ราคา</label>
                                    <input type="number" class="form-control" id="price" v-model="product.price">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="price">รูปสินค้า</label>
                                    <input type="file" class="form-control" id="file" ref="file" v-on:change="handleFileUpload()">
                                </div>
                            </div>
                        </div>  <!-- End Body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="save()">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>  <!-- End Modal -->
    </div>
</template>

<script>
export default {
    props:['product','refresh'],
    
    mounted() {
    },

    data() {
        return {
            file: ''
        }
    },

    methods: {
        addProduct() {
            let formData = new FormData();

            formData.append('name', this.product.name);
            formData.append('price', this.product.price);
            formData.append('file', this.file);
            formData.append('barcode', this.product.barcode);
            formData.append('amount', this.product.amount);
            formData.append('unit', this.product.unit);
            
            axios.post( '/api/product',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                }
              }
            )
            .then( res => {  
                this.refresh()
                this.clearData()
            })
            .catch(function(e){
                console.log(e);
            });

        },

        handleFileUpload(){
             try { this.file = this.$refs.file.files[0]; }
             catch (e) {}
        },

        updateProduct() {
            let formData = new FormData();

            formData.append('name', this.product.name);
            formData.append('price', this.product.price);
            formData.append('file', this.file);
            formData.append('barcode', this.product.barcode);
            formData.append('amount', this.product.amount);
            formData.append('unit', this.product.unit);
            
            axios.post('/api/product/' + this.product.id,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                }
            }) 
            .then(res => { 
                this.clearData() 
                this.refresh()
            })
            .catch(function(e) {console.log(e)})
        },

        save() {
            if(this.product.modalStatus == 1)
            {
                this.addProduct();
            }
            else
            {
                this.updateProduct();
            }
            this.refresh();
            swal("บันทึกข้อมูลสินค้าเรียบร้อย", "", "success");
        },

           clearData() {
            this.product.id = 0;
            this.product.name = '';
            this.product.price = '';
            this.product.barcode = '';
            this.product.amount = '';
            this.product.unit = '';
            document.getElementById('file').value = '';
        },

    }
}
</script>

