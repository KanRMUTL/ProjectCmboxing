var ctx = $('.canvas');
var barGraph = []
var chartData = []

// ----------------- Chart Start ------------------
  // กำหนดช่วงเวลา
  var before = $('#before').val()
  var after = $('#after').val()
  var time = {
    before: before,
    after: after
  }

  //  CSRF
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // POST
  $.ajax({
    url: '/api/total',
    type: 'GET',
    data: time,
    dataType: 'json',
    success: function (data) {
      var total = []
      var zone_name = []
      for (var i in data) {
        total.push(data[i].total)
        zone_name.push(data[i].zone_name)
      }
      total.push(0)
      chartData = {
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

      barGraph = new Chart(ctx, {
        type: 'bar',
        responsive: true,
        data: chartData,
        options: {
          title: {
            display: true,
            text: 'ยอดลูกค้าแต่ละโซน',
            fontSize: 25
          },
          scales: {
            yAxes: [{
              labelString: 'y'
            }]
          }
        }
      })
    }
  });


// ----------- แบ่งตามยอดขาย -------------
$('#sale-total').click(function () {
  barGraph.destroy();
  // กำหนดช่วงเวลา
  var before = $('#before').val()
  var after = $('#after').val()
  var time = {
    before: before,
    after: after
  }

  //  CSRF
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // POST
  $.ajax({
    url: '/api/total',
    type: 'GET',
    data: time,
    dataType: 'json',
    success: function (data) {
      var total = []
      var zone_name = []
      for (var i in data) {
        total.push(data[i].total)
        zone_name.push(data[i].zone_name)
      }
      total.push(0)
      chartData = {
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

      barGraph = new Chart(ctx, {
        type: 'bar',
        responsive: true,
        data: chartData,
        options: {
          title: {
            display: true,
            text: 'ยอดขายของแต่ละโซน',
            fontSize: 25
          },
          scales: {
            yAxes: [{
              labelString: 'y'
            }]
          }
        }
      })
    }
  });
})

// ----------- แบ่งตามจำนวนลูกค้า -------------
$('#sale-amount').click(function () {
  barGraph.destroy();
  // กำหนดช่วงเวลา
  var before = $('#before').val()
  var after = $('#after').val()
  var time = {
    before: before,
    after: after
  }

  //  CSRF
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // POST
  $.ajax({
    url: '/api/customer',
    type: 'GET',
    data: time,
    dataType: 'json',
    success: function (data) {
      var total = []
      var zone_name = []
      for (var i in data) {
        total.push(data[i].total)
        zone_name.push(data[i].zone_name)
      }
      total.push(0)
      chartData = {
        labels: zone_name,
        datasets: [
          {
            label: 'จำนวนลูกค้า(คน)',
            backgroundColor: 'rgba(66, 146, 244, 0.6)',
            borderWidth: 1,
            borderHoverColor: 'rgba(66, 146, 244, 1)',
            borderColor: 'rgba(66, 146, 244, 1)',
            data: total
          }
        ]
      }

      barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
          title: {
            display: true,
            text: 'ยอดลูกค้าแต่ละโซน',
            fontSize: 25
          }
        }
      })
    }
  });
})


// ----------- แบ่งตามประเภทบัตร -------------
$('#sale-ticket').click(function () {
  barGraph.destroy();
  // กำหนดช่วงเวลา
  var before = $('#before').val()
  var after = $('#after').val()
  var time = {
    before: before,
    after: after
  }

  //  CSRF
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // POST
  $.ajax({
    url: '/api/ticket',
    type: 'GET',
    data: time,
    dataType: 'json',
    success: function (data) {
      var total = []
      var ticket_name = []
      for (var i in data) {
        total.push(data[i].total)
        ticket_name.push(data[i].ticket_name)
      }
      total.push(0)
      chartData = {
        labels: ticket_name,
        datasets: [
          {
            label: 'จำนวนบัตรที่ขายได้ ',
            backgroundColor: 'rgba(66, 146, 244, 0.6)',
            borderWidth: 1,
            borderHoverColor: 'rgba(66, 146, 244, 1)',
            borderColor: 'rgba(66, 146, 244, 1)',
            data: total
          }
        ]
      }


      barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
          title: {
            display: true,
            text: 'ยอดขายแบ่งตามประเภทบัตร',
            fontSize: 25
          }
        }
      })
    }
  });
})


