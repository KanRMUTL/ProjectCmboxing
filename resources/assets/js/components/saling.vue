<template>
<div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="exampleInputEmail1" >บาร์โค้ด</label>
            <input type="text" class="form-control" id="barcode" v-model="barcode">  
        </div>
            <div class="col-md-3">
            <a id="confirm" class="btn btn-success" v-on:click="showProduct()">OK</a>
        </div>
    </div>
  <div class="box">
    <div class="box-body no-padding">
      <table class="table table-striped" style="text-align:center;">
        <tbody style="text-align:center;">
          <tr style="text-align:center;">
            <td>รหัสสินค้า</td>
            <td>ชื่อสินค้า</td>
            <td>ราคา</td>
            <td style="widtd: 15%;">จำนวน</td>
            <td>รวม</td>
            <td>ลบ</td>
          </tr>
          <tr v-for="(product, index) in products">
            <td>{{product.id}}</td>
            <td>{{product.name}}</td>
            <td>{{product.price}}</td>
            <td>
              <button v-on:click="reduceAmount(index)">-</button>
              {{product.amount}}
              <button v-on:click="addAmount(index)">+</button>
            </td>
            <td>{{product.total}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <h1 id="total">
    รวมทั้งสิ้น 0 บาท
  </h1>
  <br>
  <a class="btn btn-primary" id="sale">ขาย</a>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Saling Component mounted.')
            this.getAllProduct();
        },
        data(){
          return {
            barcode : "123456789123",
            products: [],
            product:{
              id: 0,
              barcode: '',
              name: '',
              price:0
            },
                        
          }
        },
        methods: {
            getAllProduct(){
              axios.get('/api/saling').then(
                response=>{
                  console.log(response)
                }
              )
            },

            showProduct(){
              axios.get('/api/saling/' + this.barcode).then(
                response=>{
                  console.log(response.data)
                  this.products.push(response.data[0]);
                }
              )
            },

            setDetailProduct(index, amount)
            {
              this.products[index].amount = parseInt(amount);
              this.products[index].total = amount * this.products[index].price
            },

            addAmount(index){
              this.products[index].amount = this.products[index].amount+1;
              console.log(this.products[index].amount);
              this.caltotal(index);
            }, 

            reduceAmount(index){
              this.products[index].amount--;
              this.caltotal(index);
            }, 

            caltotal(index)
            {
              this.products[index].total = this.products[index].price * this.products[index].amount
            }

        },


    }
</script>
