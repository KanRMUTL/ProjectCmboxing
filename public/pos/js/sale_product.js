$(document).ready(function(){
    var total = 0

    $('.delete').click(
        function()
        {
            console.log(55)
            $(this).parents().remove();
        }
    ) 

    $('#confirm').click(
        function(){
            $.ajax({
                method: "GET",
                url: "get_product",
                data: {barcode: $("#barcode").val()},
                dataType: 'json',
                success: function(product){
                    if(!chkProduct(product)){ // ถ้ายังไม่มีสินค้าอยู่ในรายการ
                        var open_tag = "<tr class='product_list'>"
                        var pro_id = "<td class='product_id'>" + product.id + "</td>"
                        var pro_name = "<td>" +product.name+ "</td>"
                        var pro_pirce = "<td class='price'>"+ product.price +"</td>"
                        var pro_amount = "<td class='amount'>" + 1 + "</td>"
                        var pro_total = "<td class='total'>" + (product.price * 1) + "</td>"
                        var del = "<td clas='delete'><a class='btn btn-danger'><i class='fa fa-trash fa-lg'></i></a></td>"
                        var close_tag = "</tr>"
                        $('tbody').append(open_tag + pro_id + pro_name + pro_pirce + pro_amount + pro_total + del + close_tag)
                        calTotal(parseInt(product.price))
                    }
                    
                }
            })
        })

        $('#sale').click(
            function()
            {
                var product = {}
                var product_id = []
                var product_amount = []
                var index = 0
                
                $('.product_list').each(
                    function()
                    {
                        var p_id = $(this).find('.product_id').html() 
                        var p_amount = $(this).find('.amount').html() 
                        product.id = p_id
                        product.amount = p_amount
                        product_id.push(p_id)
                        product_amount.push(p_amount)
                    }
                )
                
                $.ajax({
                    method: "GET",
                    url: "checkbill",
                    data: {
                        product_id: product_id,
                        amount: product_amount,
                        total: total
                    },
                    dataType: 'json',
                    success: function(data){
                        console.log(data)
                    }
                })
            }   
        )
        

    function calTotal(price)
    {
        total += price
        $('#total').html("รวมทั้งสิ้น " + total + " บาท")
    }

    function chkProduct(product)
    {
        var result = false;
        $('.product_list').each(
            function()
            {
                if($(this).find('.product_id').html() == product.id){ // มีสินค้านี้อยู่ในรายการ
                    var amount = $(this).find('.amount').html()
                    var new_amount = parseInt(amount) + 1
                    $(this).find('.amount').html(new_amount)
                    $(this).find('.total').html(product.price * new_amount)
                    result = true
                    calTotal(parseInt(product.price))
                }
            }
        )
        return result;
    }

   

    
})