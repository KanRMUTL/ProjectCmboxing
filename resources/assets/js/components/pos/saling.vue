<template>
  <div>
    <div class="row">
      <div class="col-md-3 mb-5">
        <div class="input-group">
          <span class="input-group-addon">บาร์โค้ดสินค้า</span>
          <input type="text" class="form-control" id="barcode" placeholder="บาร์โค้ดสินค้า" v-model="barcode">
          <span class="input-group-addon" v-on:click="showProduct()" v-show="barcode.length > 0"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>
    
    <br/>

      <div class="box box-info">
        <div class="box-body table-responsive">
          <table class="table table-striped center">
            <tbody>
              <tr>
                <td>รหัสสินค้า</td>
                <td>ชื่อสินค้า</td>
                <td>ราคา</td>
                <td style="widtd: 15%;">จำนวน</td>
                <td>รวม</td>
                <td>ลบ</td>
              </tr>
              <tr v-for="(product, index) in products" :key="product.id">
                <td>{{product.id}}</td>
                <td>{{product.name}}</td>
                <td>{{product.price}}</td>
                <td>
                  <button v-on:click="reduceAmount(index)" :disabled="product.cart==0" class="btn btn-primary cart">-</button>
                  {{product.cart}}
                  <button v-on:click="addAmount(index)" class="btn btn-primary cart">+</button>
                </td>
                <td>{{ product.total | moneyFormat }}</td>
                <td>
                  <button class="btn btn-danger" @click="deleteProduct(index)">ลบ</button>
                </td>
                <!-- {{ sumTotal += product.total }} -->
              </tr>
              <tr v-show="SumTotal > 0">
                <td colspan="4"></td>
                <td class="total">รวมทั้งสิ้น {{ SumTotal | moneyFormat }} บาท</td>
                <td><a class="btn btn-success" id="sale" @click="saleProduct()">ขาย</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  props: ["id"],
  mounted() {
    console.log("Saling Component mounted.");
  },
  data() {
    return {
      barcode: "123456789123",
      products: [],
      product: {
        id: 0,
        barcode: "",
        name: "",
        price: 0
      },
      sumTotal: 0
    };
  },
  methods: {
   

    showProduct() {
      var product;
      var add = true; // ตัวแปรเช็คว่าจะให้เพิ่มหรือไม่

      axios.get("/api/saling/" + this.barcode)
      .then(response => {
        product = response.data[0];

        if(product != undefined) { // ถ้ามีสินค้า
          if (this.checkAmount(product)) {
            //ถ้าสินค้าเหลือ
            for (var i = 0; i < this.products.length; i++) {
              if (this.products[i].id == product.id) {
                // ถ้ามีสินค้าอยู่แล้วให้เพิ่มจำนวนไม่ต้องเพิ่มรายการ
                this.addAmount(i);
                add = false;
              }
            }
            if (add) {
              product.cart = 1;
              this.products.push(product);
            }
          } else {
            swal("สินค้าไม่เพียงพอ", "", "warning");
          }
        } else {
          swal({
            'icon': 'warning',
            'title': 'ไม่มีสินค้าในระบบ'
          })
        }
      });
      this.barcode = '';
    },

    saleProduct() {
      if (this.products.length != 0) {
        axios
          .post("/api/saling", {
            id: this.id,
            products: this.products,
            sumTotal: this.sumTotal
          })
          .then(response => {
            swal(
              "บันทึกการขายสินค้าสำเร็จ",
              "ราคาทั้งหมด " + this.moneyFormat(this.sumTotal)   + " บาท",
              "success"
            );
            this.clearProduct();
          });
      } else {
        swal(
          "ไม่สามารถบันทึกการขายได้",
          "กรุณาเพิ่มรายการสินค้าก่อนทำการขาย",
          "warning"
        );
      }
    },

    clearProduct() {
      this.products = [];
      this.sumTotal = 0;
    },

    checkAmount(product) {
      if (product.amount <= 0) {
        return false;
      }
      return true;
    },

    setDetailProduct(index, amount) {
      this.products[index].amount = parseInt(amount);
      this.products[index].total = amount * this.products[index].price;
    },

    addAmount(index) {
      var cart = this.products[index].cart;
      var amount = this.products[index].amount;
      if(cart == amount || amount == 0)
      {
        swal("สินค้าไม่เพียงพอ", "", "warning");
      }
      else
      {
        this.products[index].cart++;
        this.caltotal(index);
      }
    },

    reduceAmount(index) {
      this.products[index].cart--;
      this.caltotal(index);
    },

    caltotal(index) {
      this.products[index].total = this.products[index].price * this.products[index].cart;
    },

    moneyFormat(money) {
      return new Intl.NumberFormat("en-IN", {
        maximumSignificantDigits: 3
      }).format(money);
    },

    deleteProduct(index) {
      this.products.splice(index, 1);
    }
  },

  computed: {
    SumTotal() {
      this.i = 0;
      this.sumTotal = 0;
      for (this.i; this.i < this.products.length; this.i++) {
        this.sumTotal += parseInt(this.products[this.i].total);
      }
      return this.sumTotal;
    },
  },

  filters: {
        moneyFormat: function(Price) {
            return new Intl.NumberFormat("en-IN", {
                maximumSignificantDigits: 3
            }).format(Price);
        }
    }
};
</script>

<style>
  td {
    width: 16.66%;
  }
  .cart {
    font-weight: 600;
    font-size: 80%;
    padding: 3px 6px
  }

  .total {
      color: #2d64cf;
      font-size: 24px;
      font-weight: 600;
  }
</style>
