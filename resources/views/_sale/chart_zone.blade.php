@extends('layouts.adminlte')
@section('title','กราฟรายงานการขายบัตร')
@section('header','กราฟรายงานการขายบัตรแต่ละโซน')

@section('content')

<div class="chart" style="width: 60%; margin: 0 auto;">
  <canvas class="canvas"></canvas>
</div>

@section('script')
<script src="/js/chart.js"></script>
<script src="/js/jquery.js"></script>
<script>
  $.ajax({
    url: "http://127.0.0.1/chart/zone/data",
    method: 'GET',
    success: function (data) {
      console.log(data);
      var total = []
      var zone_name = []

      for (var i in data) {
        total.push(data[i].total)
        zone_name.push(data[i].zone_name)
      }
      total.push(0)

      var chartData = {
        labels: zone_name,
        datasets: [
          {
            label: 'ยอดขายที่ผ่านมา',
            backgroundColor: 'rgba(255, 99, 132, 0.6)',
            borderWidth: 1,
            borderHoverColor: 'rgba(255, 99, 132, 1)',
            borderColor: 'rgba(255, 99, 132, 1)',
            data: total
          }
        ]
      }

      var ctx = $('.canvas')

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartData,
          options:{title:{
            display: true,
            text:'ยอดขายที่ผ่านมาของแต่ละโซน',
            fontSize: 25
          }
        }
      })
    }
  })
</script>
@endsection
@endsection()