<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" @click="showModal">
            เพิ่มสินค้า
        </button>
        <p></p>
       <div class="row">
           <div class=" col-md-12">
               <div class="box box-info">
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-hover center">
                            <tbody class="center">
                            <tr class="center">
                                <td>ชื่อสินค้า</td>
                                <td class="img-col">รูปภาพ</td>
                                <td>ราคา</td>
                                <td>บาร์โค้ด</td>
                                <td>คงเหลือ</td>
                                <td>จัดการ</td>
                            </tr>
                            <tr v-for="(product, index) in products" :key="index">
                                <td v-text="product.name"></td>
                                <td><img :src="'/pos/product/' + product.img"></td>
                                <td v-text="product.price"></td>
                                <td v-text="product.barcode"></td>
                                <td v-text="product.amount +' '+ product.unit"></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"  data-target="#modal" @click="getProductDetail(product)">
                                        แก้ไข
                                    </button>
                                    <button type="button" class="btn btn-danger"  @click="deleteProduct(product.id)">
                                        ลบ
                                    </button>
                                </td>
                            </tr> 
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div id="edit-product"> -->
                <edit-product :product="product" :refresh="getAllProduct"/>
            <!-- </div> -->
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getAllProduct();
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    },

    data() {
        return {
            products: [],
            product: {
                id: '',
                name: '',
                img: '',
                price: '',
                barcode: '',
                amount: '',
                unit: '',
                modalStatus: 1,
                img: ''                
            },
           
        }
    },

    methods: {
        getAllProduct() {
            axios.get('/api/product').then(
              response=>{
                this.products = response.data;
              }
            )
        },

        deleteProduct(id){
            swal({
                title: "ยืนยัน",
                text: "คุณต้องการลบสินค้าดังกล่าวหรือไม่",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/api/product/'+id)
                    .then(function(){ 
                            swal({
                                title: "ลบสินค้าเรียบร้อย", 
                                icon: "success",
                            });
                    })
                    .catch(function(e) {console.log(e)});
                    this.getAllProduct();
                }
            });
        },
        
        showModal() {
            if(!this.product.modalStatus) {
                this.product.modalStatus = 1
                this.clearData() 
            }
        },

        clearData() {
            this.product.id = 0;
            this.product.name = '';
            this.product.price = '';
            this.product.barcode = '';
            this.product.amount = '';
            this.product.unit = '';
        },

        getProductDetail(product){
            this.product.modalStatus = 0;
            this.product.id = product.id;
            this.product.name = product.name;
            this.product.price = product.price;
            this.product.barcode = product.barcode;
            this.product.amount = product.amount;
            this.product.unit = product.unit;
        },

    },
}
</script>

<style>
 .img-col {
     width: 10%;
 }

 img {
     width: 100%;
 }
</style>
