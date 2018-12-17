<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Chart</h1>
    <div id="chart" style="width:50%;">
        <canvas id="mycanvas"></canvas>
    </div>
    <button id="find">Find</a>
    <script src="/js/chart.js"></script>
    <script src="/js/jquery.js"></script>
    <script>
        $(document).ready(function () {

            $('#find').click(function(){
                $.ajax({
                    url: "http://127.0.0.1/chart/data",
                    method: 'GET',
                    success: function (data) {
                        console.log(data);
                        var total = []
                        var customer = []

                        for (var i in data) {
                            total.push(data[i].total)
                            customer.push(data[i].customer_name)
                        }
                        total.push(0)
                        
                        var chartData = {
                            labels: customer,
                            datasets:[
                                {
                                    label: 'Money',
                                    backgroundColor: '#36a2eb',
                                    borderColor:'green',
                                    data: total
                                }
                            ]
                        }

                        var ctx = $('#mycanvas')

                        var barGraph = new Chart(ctx,{
                            type: 'bar',
                            data: chartData
                        })
                    }
                })
            })
            
        })
    </script>
</body>

</html>